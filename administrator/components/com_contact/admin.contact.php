<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Contact
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//ensure user has access to this function
global $adminLanguage;
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
		| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_contact' ))) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$id = mosGetParam( $_GET, 'id', 0 );
$cid = mosGetParam( $_POST, 'cid', array(0) );
if (!is_array( $cid )) {
	$cid = array(0);
}

switch ($task) {
	case 'new':
		editContact( '0', $option);
	break;
	case 'edit':
		editContact( $cid[0], $option );
	break;
	case 'editA':
		editContact( $id, $option );
	break;
	case 'save':
		saveContact( $option );
		break;
	case 'remove':
		removeContacts( $cid, $option );
	break;
	case 'publish':
		changeContact( $cid, 1, $option );
	break;
	case 'user':
    	$id = mosGetParam( $_POST, 'id', '' );
    	mosRedirect( 'index2.php?option=com_users&task=editA&id='.$id.'&hidemainmenu=1' );
	break;
	case 'unpublish':
		changeContact( $cid, 0, $option );
	break;
	case 'orderup':
		orderContacts( $cid[0], -1, $option );
	break;
	case 'orderdown':
		orderContacts( $cid[0], 1, $option );
	break;
	case 'cancel':
        cancelContact();
	break;
	case 'validate':
        validateContSEO();
	break;
	case 'suggest':
	   suggestContSEO();
	break;
	default:
		showContacts( $option );
	break;
}


/*******************************/
/* PREPARE TO DISPLAY CONTACTS */
/*******************************/
function showContacts( $option ) {
	global $database, $mainframe, $mosConfig_list_limit;

	$catid = $mainframe->getUserStateFromRequest( "catid{$option}", 'catid', 0 );
	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );
	$search = $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
	$search = $database->getEscaped( eUTF::utf8_trim( eUTF::utf8_strtolower( $search ) ) );

    //in order to work 'filtered by' icons with register_globals off
    $formfilters = array( 'catid' => $catid );

	$wherex = array();
	if ($search != '') {
		$wherex[] = "cd.name LIKE '%$search%'";
	}
	if ($catid) {
		$wherex[] = "cd.catid = '$catid'";
	}

	$where = '';
	if (count($wherex) > 0) {
		$where = "\n WHERE ". implode( ' AND ', $wherex );
	}

	//get the total number of records
	$database->setQuery("SELECT COUNT(*) FROM #__contact_details cd".$where);
	$total = intval($database->loadResult());

	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$ora = in_array($database->_resource->databaseType, array('oci8', 'oci805', 'oci8po', 'oracle')) ? 1 : 0;
	$asuser = ($ora) ? 'xuser' : 'user';
	
	//get the subset (based on limits) of required records
	$query = "SELECT cd.*, cc.title AS category, u.name AS ".$asuser.", v.name AS editor"
	."\n FROM #__contact_details cd"
	."\n LEFT JOIN #__categories cc ON cc.id = cd.catid"
	."\n LEFT JOIN #__users u ON u.id = cd.user_id"
	."\n LEFT JOIN #__users v ON v.id = cd.checked_out"
	.$where
	."\n ORDER BY cd.catid, cd.ordering, cd.name ASC";		
	$database->setQuery($query, '#__', $pageNav->limit, $pageNav->limitstart);
	$rows = $database->loadObjectList();

	if ($ora && $rows) {
		foreach ($rows as $row) {
			$row->user = $row->xuser;
			unset($row->xuser);
		}
	}

	//build list of categories
	$javascript = 'onchange="document.adminForm.submit();"';
	$lists['catid'] = mosAdminMenus::ComponentCategory( 'catid', 'com_contact_details', intval( $catid ), $javascript );

	HTML_contact::showcontacts( $rows, $pageNav, $search, $option, $lists, $formfilters );
}


/*******************************/
/* PREPARE TO ADD/EDIT CONTACT */
/*******************************/
function editContact( $id, $option ) {
	global $database, $my, $mainframe;

	$row = new mosContact( $database );
	$row->load( $id );
	if ($id) {
		$row->checkout($my->id);
	} else {
		$row->imagepos = 'top';
		$row->ordering = 0;
		$row->published = 1;
	}
	$lists = array();

	//build the html select list for ordering
	$query = "SELECT ordering AS value, name AS text FROM #__contact_details"
	. "\n WHERE published >= 0 AND catid = '".$row->catid."'"
	. "\n ORDER BY ordering";
	$lists['ordering'] = mosAdminMenus::SpecificOrdering( $row, $id, $query, 1 );

	//build list of users
	$lists['user_id'] = mosAdminMenus::UserSelect( 'user_id', $row->user_id, 1 );
	//build list of categories
	$lists['catid'] = mosAdminMenus::ComponentCategory( 'catid', 'com_contact_details', intval( $row->catid ) );
	//build the html select list for images
	$lists['image'] = mosAdminMenus::Images( 'image', $row->image );
	//build the html select list for the group access
	$lists['access'] = mosAdminMenus::Access( $row );
	//build the html radio buttons for published
	$lists['published'] = mosHTML::yesnoradioList( 'published', '', $row->published );
	//build the html radio buttons for default
	$lists['default_con'] = mosHTML::yesnoradioList( 'default_con', '', $row->default_con );

    //EXTRA USER FIELDS (only if contact is linked to a user)
    $lists['extra'] = '';
    if ($id) {
		$database->setQuery("SELECT extrafields FROM #__users WHERE id='".$row->user_id."'", '#__', 1, 0);
		$extrafields = $database->loadResult();
    	$usrfields = explode("|", $extrafields);

    	if (is_array($usrfields) && (count($usrfields) > 0)) {
		//$ufields is an array having as key the extraid and value the extra field value for the selected user
		$ufields = array();
		foreach ($usrfields as $usrfield) {
			$uf = preg_split("/[\=]/", $usrfield, 2);
			$ufid = intval($uf[0]); //if invalid then extraid=0
        	$ufval = preg_split('/[\/]+/', $uf[1], -1, PREG_SPLIT_NO_EMPTY);
        	if ( count($ufval) < 1 ) { $ufval = array(''); }

			if (($ufid != 0) && ($ufid != '')) {
				$ufields[$ufid] = $ufval;
			}
		}

    	$query = "SELECT extraid, name FROM #__users_extra WHERE published='1' ORDER BY ordering ASC";
		$database->setQuery( $query );
		$exxs = $database->loadObjectList();
	
    		for ($i = 0; $i<count($exxs); $i++) {
				$exx = &$exxs[$i];
				$eid = $exx->extraid;
				if ( isset($ufields[$eid]) && eUTF::utf8_trim($ufields[$eid][0]) != '' ) {
					$lists['extra'] .= '<strong>'.$exx->name.':</strong> '.implode(', ', $ufields[$eid]).'<br />';
				}
			}
		}
	}

	//get params definitions
	$file = $mainframe->getCfg('absolute_path').'/administrator/components/com_contact/contact_items.xml';
	$params = new mosParameters( $row->params, $file, 'component' );

	HTML_contact::editcontact( $row, $lists, $option, $params );
}


/****************/
/* SAVE CONTACT */
/****************/
function saveContact( $option ) {
	global $database, $adminLanguage, $mainframe;

	$row = new mosContact( $database );
	if (!$row->bind( $_POST )) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}

	//save params
	$params = mosGetParam( $_POST, 'params', '' );
	if (is_array( $params )) {
		$txt = array();
		foreach ( $params as $k=>$v) {
			$txt[] = "$k=$v";
		}
		$row->params = implode( "\n", $txt );
	}

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
    $seo = new seovs('com_contact', '', $row->seotitle);
    $seo->id = intval($row->id);
    $seo->catid = intval($row->catid);
    $seoval = $seo->validate();
    if (!$seoval) {
    	$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_SEOTITLE.": ".$seo->message."'); window.history.go(-1);</script>"._LEND;
		exit();
    }

	//pre-save checks
	if (!$row->check()) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}

	//save the changes
	if (!$row->store()) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}
	$row->checkin();
	$row->updateOrder();
	if ($row->default_con) {
		$database->setQuery( "UPDATE #__contact_details SET default_con='0' WHERE id <> $row->id AND default_con='1'" );
		$database->query();
	}

	mosRedirect( "index2.php?option=$option" );
}


/*******************/
/* DELETE CONTACTS */
/*******************/
function removeContacts( &$cid, $option ) {
	global $database, $mainframe;

	if (count( $cid )) {
		$cids = implode( ',', $cid );
		$database->setQuery( "DELETE FROM #__contact_details WHERE id IN ($cids)" );
		if (!$database->query()) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
			exit();
		}
	}

	mosRedirect( "index2.php?option=$option" );
}


/*************************/
/* CHANGE CONTACTS STATE */
/*************************/
function changeContact( $cid=null, $state=0, $option ) {
	global $database, $my, $adminLanguage, $mainframe;

	if (count( $cid ) < 1) {
		$action = $state == 1 ? $adminLanguage->A_PUBLISH : $adminLanguage->A_UNPUBLISH;
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_CMP_CCT_SELCREC." ".$action."'); window.history.go(-1);</script>\n";
		exit();
	}

	$cids = implode( ',', $cid );

	$database->setQuery( "UPDATE #__contact_details SET published='$state'"
	."\n WHERE id IN ($cids) AND (checked_out=0 OR (checked_out='$my->id'))");
	if (!$database->query()) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosContact( $database );
		$row->checkin( intval( $cid[0] ) );
	}

	mosRedirect( "index2.php?option=$option" );
}


/***************************/
/* MOVE/RE-ORDER A CONTACT */
/***************************/
function orderContacts( $uid, $inc, $option ) {
	global $database;
	
	$row = new mosContact( $database );
	$row->load( $uid );
	$row->move( $inc, "published >= 0" );

	mosRedirect( "index2.php?option=$option" );
}


/***********************/
/* CANCEL EDIT CONTACT */
/***********************/
function cancelContact() {
	global $database;
	
	$row = new mosContact( $database );
	$row->bind( $_POST );
	$row->checkin();

	mosRedirect('index2.php?option=com_contact');
}


/**********************/
/* VALIDATE SEO TITLE */
/**********************/
function validateContSEO() {
    global $mainframe, $adminLanguage;

    $coid = intval(mosGetParam($_POST, 'coid', 0));
    $cocatid = intval(mosGetParam($_POST, 'cocatid', 0));
    $seotitle = eUTF::utf8_trim(mosGetParam($_POST, 'seotitle', ''));

    if (!$cocatid) {
        echo $adminLanguage->A_INVALID.', '.$adminLanguage->A_PLSSELECTCAT;
        exit();
    }

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
    $seo = new seovs('com_contact', '', $seotitle);
    $seo->id = $coid;
    $seo->catid = $cocatid;
    $seo->validate();
    echo $seo->message;
    exit();
}


/*********************/
/* SUGGEST SEO TITLE */
/*********************/
function suggestContSEO() {
    global $mainframe;

    $coid = intval(mosGetParam($_POST, 'coid', 0));
    $cocatid = intval(mosGetParam($_POST, 'cocatid', 0));
    $cotitle = eUTF::utf8_trim(mosGetParam($_POST, 'cotitle', ''));

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
    $seo = new seovs('com_contact', $cotitle);
    $seo->id = $coid;
    $seo->catid = $cocatid;
    $sname = $seo->suggest();

    @ob_end_clean();
    @header('Content-Type: text/plain; Charset: utf-8');
    if ($sname) {
        echo '|1|'.$sname;
    } else {
        echo '|0|'.$seo->message;
    }
    exit();
}
	   
?>