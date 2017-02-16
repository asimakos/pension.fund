<?php 
/** 
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Weblinks
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if ( $my->usertype == '' ) { 
	$usertype = eUTF::utf8_strtolower($acl->get_group_name('29'));
} else {
	$usertype = eUTF::utf8_strtolower($my->usertype);
}

if (($mosConfig_access == '1') | ($mosConfig_access == '3')) {
	// ensure user is allowed to view this component
	if (!($acl->acl_check( 'action', 'view', 'users', $usertype, 'components', 'all' ) || 
	    $acl->acl_check( 'action', 'view', 'users', $usertype, 'components', 'com_weblinks' ))) {
		mosRedirect( 'index.php', _NOT_AUTH );
	}
}

$canAdd = $acl->acl_check( 'action', 'add', 'users', $usertype, 'weblinks', 'all' );

/** load the html drawing class */
require_once( $mainframe->getPath( 'front_html' ) );
require_once( $mainframe->getPath( 'class' ) );
$mainframe->setPageTitle( _WEBLINKS_TITLE );

$task = trim( mosGetParam( $_REQUEST, 'task', "" ) );
$id = intval( mosGetParam( $_REQUEST, 'id', 0 ) );
$catid = intval( mosGetParam( $_REQUEST, 'catid', 0 ) );

switch ($task) {
	case 'new':
	editWebLink( 0, $canAdd );
	break;

	case 'edit': //disabled until permissions system can handle it
	editWebLink( 0, $canAdd );
	break;

	case 'save':
	saveWebLink( $canAdd );
	break;

	case 'cancel':
	cancelWebLink( $canAdd );
	break;

	case 'view':
	showItem( $id, $catid );
	break;

	default:
	listWeblinks( $catid, $canAdd );
	break;
}


/*************************************/
/* DISPLAY WEBLINKS CATEGORIES/ITEMS */
/*************************************/
function listWeblinks( $catid, $canAdd=0 ) {
	global $mainframe, $database, $my, $Itemid, $lang;

    $dbmy = preg_match('/mysql/i', $database->_resource->databaseType);

	/* Query to retrieve all categories that belong under the web links section and that are published for the chosen language. */
	/* I did not found a better way to work arround with Postgres and Oracle */
    if (!$dbmy) {
        $query = "SELECT cc.name, cc.id as catid, cc.seotitle, COUNT(a.id) AS numlinks FROM #__categories cc"
            . "\n LEFT JOIN #__weblinks a ON a.catid = cc.id"
            . "\n WHERE a.published='1' AND a.approved='1' AND cc.section='com_weblinks'"
            . "\n AND cc.published='1' AND cc.access IN (".$my->allowed.")"
            . "\n AND ((a.language IS NULL) OR (a.language LIKE '%".$lang."%'))"
            . "\n AND ((cc.language IS NULL) OR (cc.language LIKE '%".$lang."%'))"
            . "\n GROUP BY cc.id, cc.name, cc.ordering, cc.seotitle";
    } else {
        $query = "SELECT cc.*, cc.id AS catid, COUNT(a.id) AS numlinks FROM #__categories cc"
            . "\n LEFT JOIN #__weblinks a ON a.catid = cc.id"
            . "\n WHERE a.published='1' AND a.approved='1' AND cc.section='com_weblinks'"
            . "\n AND cc.published='1' AND cc.access IN (".$my->allowed.")"
            . "\n AND ((a.language IS NULL) OR (a.language LIKE '%".$lang."%'))"
            . "\n AND ((cc.language IS NULL) OR (cc.language LIKE '%".$lang."%'))"
            . "\n GROUP BY cc.id";
    }
	$query .= "\n ORDER BY cc.ordering";

	$database->setQuery( $query );
	$categories = $database->loadObjectList();

	if ($catid) {
		//url links info for category
		$query = "SELECT id, url, title, description, date, hits, params, screenshot FROM #__weblinks"
		."\n WHERE catid = '".$catid."' AND published='1' AND approved='1' AND archived=0"
		."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
		."\n ORDER BY ordering";
		$database->setQuery( $query );
		$rows = $database->loadObjectList();

		//current category info
		$query = "SELECT name, description, image, image_position, seotitle FROM #__categories"
		."\n WHERE id = '".$catid."'"
		."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
		."\n AND published = '1'";
		$database->setQuery( $query );
		$database->loadObject($currentcat);
	} else {
		$rows = array();
		$currentcat = new stdClass();
	}

	//check if you should display module "Top Weblink"
	$database->setQuery("SELECT sdvalue FROM #__softdisk WHERE sdname='TOP_WEBLINK' AND sdsection='WEBLINKS'", '#__', 1, 0);
	$topweblink = intval($database->loadResult());

	//Parameters
	$menu = new mosMenu($database);
	$menu->load( $Itemid );
	$params = new mosParameters( $menu->params );
	$params->def( 'pageclass_sfx', '' );
	$params->def( 'lastmodified', 1 );
	$params->def( 'hits', $mainframe->getCfg( 'hits' ) );
	$params->def( 'item_description', 1 );
	$params->def( 'other_cat_section', 1 );
	$params->def( 'other_cat', 1 );
	$params->def( 'description', 1 );
	$params->def( 'description_text', _E_WEBLINKS_DESC );
	$params->def( 'image', '-1' );
	$params->def( 'weblink_icons', '' );
	$params->def( 'image_align', 'right' );
	$params->def( 'back_button', $mainframe->getCfg( 'back_button' ) );
	$params->def( 'sshots', 0 );
	$params->def( 'topweblink', $topweblink);

	if ($catid) {
		$params->set( 'type', 'category' );
	} else {
		$params->set( 'type', 'section' );
	}
	
	//page description
	$currentcat->descrip = '';
	if (isset($currentcat->description) &&  ($currentcat->description  <> '')) {
		$currentcat->descrip = $currentcat->description;
	} else if ( !$catid ) {
		// show description
		if ( $params->get( 'description' ) ) {
			$currentcat->descrip = $params->get( 'description_text' );
		}
	}

	// page image
	$currentcat->img = '';
	$path = $mainframe->getCfg('live_site').'/images/stories/';
	
	if (isset($currentcat->image) &&  ($currentcat->image  != '')) {
		$currentcat->img = $path . $currentcat->image;
		$currentcat->align = $currentcat->image_position;
	} else if ( !$catid ) {
		if ( $params->get( 'image' ) <> -1 ) {
			$currentcat->img = $path . $params->get( 'image' );
			$currentcat->align = $params->get( 'image_align' );
		}
	}

	// page header
	$currentcat->header = '';
	if (isset($currentcat->name) &&  ($currentcat->name  != '')) {
		$currentcat->header = $currentcat->name;
	} else {
		$currentcat->header = _WEBLINKS_TITLE;
	}

    $metakeys = array();
    if (isset($currentcat->name) &&  ($currentcat->name  != '')) {
    	$metaTitle = _WEBLINKS_TITLE.' '.$currentcat->name;
    	$metaDesc = (trim($currentcat->description) != '') ? $currentcat->description : $currentcat->name.' '._WEBLINKS_TITLE;
		$metakeys[] = $currentcat->name;
		if ($rows) {
			for ($q=0; $q<count($rows); $q++) {
				if ($q > 4) { break; }
				$metaDesc .= ', '.$rows[$q]->title;
				if (eUTF::utf8_strlen($rows[$q]->title) < 20) { $metakeys[] = $rows[$q]->title; }
			}
		}
    } else {
    	$metaTitle = _WEBLINKS_TITLE;
    	$metaDesc = _WEBLINKS_TITLE;
    	$metakeys[] = _WEBLINKS_TITLE;
    }
    $metaDesc .= ', '.$mainframe->getCfg('sitename');

    if ($lang != 'english') { $metakeys[] = 'links'; $metakeys[] = 'weblinks'; }

    $mainframe->setPageTitle($metaTitle);
    $mainframe->setMetaTag('description', strip_tags($metaDesc));
    $mainframe->setMetaTag('keywords', implode(', ',$metakeys));

	HTML_weblinks::displaylist( $categories, $rows, $catid, $currentcat, $params, $canAdd );
}


/*************************/
/* REDIRECT TO A WEBLINK */
/*************************/
function showItem ( $id, $catid ) {
	global $database;

	//Record the hit
	$database->setQuery("UPDATE #__weblinks SET hits = hits + 1 WHERE id = '".$id."' AND published='1' AND approved='1'");
	$database->query();

	$database->setQuery( "SELECT url FROM #__weblinks WHERE id = '".$id."' AND published='1' AND approved='1'", '#__', 1, 0 );
	$url = $database->loadResult();

	if ($url) { mosRedirect ($url); }
	listWeblinks( $catid );
}


/*******************************************/
/* ADD / EDIT WEBLINK (currently only add) */
/*******************************************/
function editWebLink( $id, $canAdd=0 ) {
	global $database, $my, $mainframe, $Itemid;

	$mainframe->setPageTitle( _E_SUBMIT_LINK );
    $mainframe->setMetaTag('description', _E_SUBMIT_LINK.' '.$mainframe->getCfg('sitename'));
    $mainframe->setMetaTag('keywords', _E_WEBLINK.', submit, '._E_SECTION.', '._E_URL.', link, '._E_SCREENSHOT);

	if (!$canAdd) {
		elxError(_E_WEBLINKNA, 0);
		return;
	}

	$row = new mosWeblink( $database );
	$row->load( $id );

	if ($row->checked_out && ($row->checked_out != $my->id)) {
		$redLink = sefRelToAbs('index.php?option=com_weblinks&Itemid='.$Itemid, 'links/');
		mosRedirect($redLink, _E_THEWEBLINK.' '.$row->title.' '._ELANG_EDITANOTHER);
	}

	if ($id) {
		$row->checkout( $my->id );
	} else {
		//initialise new record
		$row->published = 0;
		$row->approved 	= 0;
		$row->ordering 	= 0;
	}

	//build list of categories
	$lists['catid'] = mosAdminMenus::ComponentCategory( 'catid', 'com_weblinks', intval( $row->catid ), 'title="'._E_SECTION.'"' );

	//build the html multiple select list for language selection
    $lists['languages']	= mosAdminMenus::SelectLanguages( 'languages', $row->language, '- '._E_ALL_LANGUAGES.' -' );

	HTML_weblinks::editWeblink( $row, $lists );
}


/*******************/
/* CANCEL ADD/EDIT */
/*******************/
function cancelWebLink( $canAdd=0 ) {
	global $database, $mainframe;

	if (!$canAdd) {
		elxError(_E_WEBLINKNA, 0);
		return;
	}

	$id = intval(mosGetParam( $_POST, 'id', 0 ));
	if ($id) {
		$row = new mosWeblink( $database );
		$row->id = $id;
		$row->checkin();
	}
	$Itemid = intval(mosGetParam( $_POST, 'Returnid', 0 ));
	$redLink = ($mainframe->getCfg('sef') == 2) ? 'links/' : 'index.php?Itemid='.$Itemid;
	mosRedirect( $redLink );
}


/****************/
/* SAVE WEBLINK */
/****************/
function saveWeblink( $canAdd=0 ) {
	global $database, $my, $mainframe;

	if (!$canAdd) {
		elxError(_E_WEBLINKNA, 0);
		return;
	}

    foreach ($_POST['languages'] as $xlang) {
    	if (trim($xlang) == '') { $newlangs = ''; }
    }
    if (!isset($newlangs)) {
    	$newlangs = implode(',', $_POST['languages']);
    }
    $_POST['language'] = $newlangs;

	$row = new mosWeblink( $database );
	if (!$row->bind( $_POST, "approved published" )) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>"._LEND;
		exit();
	}
	$isNew = $row->id < 1;

	$row->date = date( "Y-m-d H:i:s" );
	if (!$row->check()) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>"._LEND;
		exit();
	}
	if (!$row->store()) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>"._LEND;
		exit();
	}
	$row->checkin();

	/** Notify admins */
	$database->setQuery( "SELECT email, name, preflang FROM #__users WHERE gid='25' AND sendemail = '1' AND block='0'" );
	if(!$database->query()) {
		echo $database->stderr( true );
		return;
	}

	$adminRows = $database->loadObjectList();
	if ($adminRows) {
		foreach( $adminRows as $adminRow) {
			mosSendAdminMail($adminRow->name, $adminRow->email, "", "Weblink", $row->title, $my->username, $adminRow->preflang );
		}
	}

	$msg = $isNew ? _THANK_SUB : '';
	$Itemid = mosGetParam( $_POST, 'Returnid', '' );

	$redLink = ($mainframe->getCfg('sef') == 2) ? 'links/' : 'index.php?option=com_weblinks&Itemid='.$Itemid;
	mosRedirect( $redLink, $msg );
}

?>