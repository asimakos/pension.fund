<?php 
/**
* @version: $Id: admin.typedcontent.php 42 2010-06-08 15:17:42Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Types Content
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


require_once( $mainframe->getPath( 'admin_html' ) );

$id = mosGetParam( $_REQUEST, 'id', '' );
$cid = mosGetParam( $_POST, 'cid', array(0) );
if (!is_array( $cid )) {
	$cid = array(0);
}


switch ( $task ) {
	case 'cancel':
		cancel( $option );
		break;
	case 'new':
		edit( 0, $option );
		break;
	case 'edit':
		edit( $id, $option );
		break;
	case 'editA':
		edit( $cid[0], $option );
		break;
	case 'go2menu':
	case 'go2menuitem':
	case 'resethits':
	case 'menulink':
	case 'save':
	case 'apply':
		save( $option, $task );
		break;
	case 'remove':
		trash( $cid, $option );
		break;
	case 'publish':
		changeState( $cid, 1 );
		break;
	case 'unpublish':
		changeState( $cid, 0 );
		break;
	case 'ajaxpublish':
        ajaxchangeState();
        break;
    case 'setaccess':
        $access = mosGetParam( $_REQUEST, 'access', 29 );
        $sid = mosGetParam( $_REQUEST, 'sid', '' );
		changeAccess( $sid, $access, $option );
		break;
	case 'saveorder':
		saveOrder( $cid );
		break;
	case 'translate':
		translateItem( $cid[0], $option );
		break;
    case 'dotranslate':
    	$id = (int)mosGetParam($_POST, 'id', 0);
		dotranslateItem($id, $option);
		break;
	case 'suggestseotitle':
	   suggestSEOtitle();
	   break;
	case 'valseotitle':
		validateSEOtitle();
		break;
	default:
		view( $option );
		break;
}


/************************************/
/* PREPARE TO LIST AUTONOMOUS PAGES */
/************************************/
function view( $option ) {
	global $database, $mainframe, $mosConfig_list_limit, $adminLanguage, $mosConfig_pub_langs;

	$filter_authorid 	= $mainframe->getUserStateFromRequest( "filter_authorid{$option}", 'filter_authorid', 0 );
	$order 				= $mainframe->getUserStateFromRequest( "zorder", 'zorder', 'c.ordering DESC' );
	$limit 				= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart 		= $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );
	$search 			= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
	$search 			= $database->getEscaped( eUTF::utf8_trim( eUTF::utf8_strtolower( $search ) ) );
    $filter_lang        = trim( strtolower(mosGetParam( $_REQUEST, 'filter_lang', '' )));

    //in order to work 'filtered by' icons with register_globals off
    $formfilters = array(
        'filter_authorid' => $filter_authorid,
        'filter_lang' => $filter_lang
    );

	//used by filter
	if ( $search ) {
		$search_query = "\n AND ( LOWER( c.title ) LIKE '%$search%' OR LOWER( c.seotitle ) LIKE '%$search%' )";
	} else {
		$search_query = '';
	}

	$filter = '';
	if ( $filter_authorid > 0 ) {
		$filter .= "\n AND c.created_by = '$filter_authorid'";
	}
		if ( $filter_lang != '' ) {
		$filter .= "\n AND ((c.language LIKE '%$filter_lang%') OR (c.language IS NULL))";
	}

	//get the total number of records
	$query = "SELECT COUNT(*) FROM #__content c"
	. "\n WHERE c.sectionid = '0' AND c.catid = '0'"
	. "\n AND c.state <> '-2'"
	. $filter
	;
	$database->setQuery( $query );
	$total = $database->loadResult();
	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	$query = "SELECT c.*, g.name AS groupname, u.name AS editor, z.name AS creator"
	. "\n FROM #__content c"
	. "\n LEFT JOIN #__core_acl_aro_groups g ON g.group_id = c.access"
	. "\n LEFT JOIN #__users u ON u.id = c.checked_out"
	. "\n LEFT JOIN #__users z ON z.id = c.created_by"
	. "\n WHERE c.sectionid = '0'"
	. "\n AND c.catid = '0'"
	. "\n AND c.state <> '-2'"
	. $search_query
	. $filter
	. "\n ORDER BY ".$order
	;

	$database->setQuery( $query, '#__', $pageNav->limit, $pageNav->limitstart );
	$rows = $database->loadObjectList();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	$count = count( $rows );
	for( $i = 0; $i < $count; $i++ ) {
		$query = "SELECT COUNT( id )"
		. "\n FROM #__menu"
		. "\n WHERE componentid = ". $rows[$i]->id
		. "\n AND type = 'content_typed'"
		. "\n AND published <> '-2'"
		;
		$database->setQuery( $query );
		$rows[$i]->links = $database->loadResult();
	}

	$ordering[] = mosHTML::makeOption( 'c.ordering ASC', $adminLanguage->A_ORDERING.' '.$adminLanguage->A_CMP_TDC_ASC );
	$ordering[] = mosHTML::makeOption( 'c.ordering DESC', $adminLanguage->A_ORDERING.' '.$adminLanguage->A_CMP_TDC_DSC );
	$ordering[] = mosHTML::makeOption( 'c.id ASC', 'ID '.$adminLanguage->A_CMP_TDC_ASC );
	$ordering[] = mosHTML::makeOption( 'c.id DESC', 'ID '.$adminLanguage->A_CMP_TDC_DSC );
	$ordering[] = mosHTML::makeOption( 'c.title ASC', $adminLanguage->A_TITLE.' '.$adminLanguage->A_CMP_TDC_ASC );
	$ordering[] = mosHTML::makeOption( 'c.title DESC', $adminLanguage->A_TITLE.' '.$adminLanguage->A_CMP_TDC_DSC );
	$ordering[] = mosHTML::makeOption( 'c.created ASC', $adminLanguage->A_DATE.' '.$adminLanguage->A_CMP_TDC_ASC );
	$ordering[] = mosHTML::makeOption( 'c.created DESC', $adminLanguage->A_DATE.' '.$adminLanguage->A_CMP_TDC_DSC );
	$ordering[] = mosHTML::makeOption( 'z.name ASC', $adminLanguage->A_AUTHOR.' '.$adminLanguage->A_CMP_TDC_ASC );
	$ordering[] = mosHTML::makeOption( 'z.name DESC', $adminLanguage->A_AUTHOR.' '.$adminLanguage->A_CMP_TDC_DSC );
	$ordering[] = mosHTML::makeOption( 'c.state ASC', $adminLanguage->A_PUBLISHED.' '.$adminLanguage->A_CMP_TDC_ASC );
	$ordering[] = mosHTML::makeOption( 'c.state DESC', $adminLanguage->A_PUBLISHED.' '.$adminLanguage->A_CMP_TDC_DSC );
	$ordering[] = mosHTML::makeOption( 'c.access ASC', $adminLanguage->A_ACCESS.' '.$adminLanguage->A_CMP_TDC_ASC );
	$ordering[] = mosHTML::makeOption( 'c.access DESC', $adminLanguage->A_ACCESS.' '.$adminLanguage->A_CMP_TDC_DSC );
	$javascript = 'onchange="document.adminForm.submit();"';
	$lists['order'] = mosHTML::selectList( $ordering, 'zorder', 'class="selectbox" size="1"'. $javascript, 'value', 'text', $order );

	//get list of Authors for dropdown filter
	$query = "SELECT c.created_by AS value, u.name AS text"
	. "\n FROM #__content c"
	. "\n LEFT JOIN #__users u ON u.id = c.created_by"
	. "\n WHERE c.sectionid = 0"
	. "\n GROUP BY c.created_by, u.name"
	. "\n ORDER BY u.name"
	;
	$authors[] = mosHTML::makeOption( '0', $adminLanguage->A_ALL_AUTHORS );
	$database->setQuery( $query );
	$authors = array_merge( $authors, $database->loadObjectList() );
	$lists['authorid']	= mosHTML::selectList( $authors, 'filter_authorid', 'class="selectbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_authorid );

    //get list of enabled languages for dropdown filter
    $plangs[] = mosHTML::makeOption( '',$adminLanguage->A_ALL_LANGS );
    $publs = explode(',', $mosConfig_pub_langs);
    foreach ($publs as $publ) {
        $plangs[] = mosHTML::makeOption( $publ, $publ );
    }
	$lists['flangs'] = mosHTML::selectList( $plangs, 'filter_lang', 'class="selectbox" size="1" dir="ltr" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_lang );

    if (isset($_POST['simpleview'])) {
        $simpleview = intval($_POST['simpleview']) ? 1 : 0;
        if ((isset($_COOKIE['simpleview'])) && ($simpleview != $_COOKIE['simpleview'])) {
            @setcookie('simpleview', $simpleview, time()+2592000);
        }
    } else if (isset($_COOKIE['simpleview'])) {
        $simpleview = intval($_COOKIE['simpleview']) ? 1 : 0;
    } else {
        $simpleview = 0;
    }

    if (!isset($_COOKIE['simpleview'])) {
        @setcookie('simpleview', $simpleview, time()+2592000);
    }

	HTML_typedcontent::showContent( $rows, $pageNav, $option, $search, $lists, $formfilters, $simpleview );
}


/***************************************/
/* PREPARE TO ADD/EDIT AUTONOMOUS PAGE */
/***************************************/
function edit( $uid, $option ) {
	global $database, $my, $mainframe, $adminLanguage;

	$row = new mosContent( $database );

	//fail if checked out not by 'me'
	if ($row->checked_out && $row->checked_out <> $my->id) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_THEMODULE ." ". $row->title ." ". $adminLanguage->A_ISCEDITANADM ."\"); document.location.href='index2.php?option=$option'</script>\n";
		exit();
	}

	$lists = array();

	if ($uid) {
		//load the row from the db table
		$row->load( $uid );
		$row->checkout( $my->id );
		if (trim( $row->images )) {
			$row->images = explode( "\n", $row->images );
		} else {
			$row->images = array();
		}
		if (trim( $row->publish_down ) == "2060-01-01 00:00:00") {
			$row->publish_down = $adminLanguage->A_NEVER;
		}

		$query = "SELECT name from #__users WHERE id=$row->created_by";
		$database->setQuery( $query );
		$row->creator = $database->loadResult();

		$query = "SELECT name from #__users WHERE id=$row->modified_by";
		$database->setQuery( $query );
		$row->modifier = $database->loadResult();

		//get list of links to this item
		$and = "\n AND componentid = ". $row->id;
		$menus = mosAdminMenus::Links2Menu( 'content_typed', $and );
	} else {
		//initialise values for a new item
		$row->version = 0;
		$row->state = 1;
		$row->images = array();
		$row->publish_up = date( "Y-m-d", time() );
		$row->publish_down = $adminLanguage->A_NEVER;
		$row->sectionid = 0;
		$row->catid = 0;
		$row->creator = '';
		$row->modifier = '';
		$row->ordering = 0;
 		$row->hits = 0;
		$row->language = '';
		$menus = array();
	}

	//calls function to read image from directory
	$pathA = $mainframe->getCfg('absolute_path').'/images/stories';
	$pathL = $mainframe->getCfg('live_site').'/images/stories';
	$images = array();
	$folders = array();
	$folders[] = mosHTML::makeOption( '/' );
	mosAdminMenus::ReadImages( $pathA, '/', $folders, $images );
	//list of folders in images/stories/
	$lists['folders'] 			= mosAdminMenus::GetImageFolders( $folders, $pathL );
	//list of images in specfic folder in images/stories/
	$lists['imagefiles']		= mosAdminMenus::GetImages( $images, $pathL );
	//list of saved images
	$lists['imagelist'] 		= mosAdminMenus::GetSavedImages( $row, $pathL );

	//build list of users
	$active = ( intval( $row->created_by ) ? intval( $row->created_by ) : $my->id );
	$lists['created_by'] 		= mosAdminMenus::UserSelect( 'created_by', $active );
	//build the select list for the image positions
	$lists['_align'] 			= mosAdminMenus::Positions( '_align' );
	//build the html select list for the group access
	$lists['access'] 			= mosAdminMenus::Access( $row );
	//build the html select list for menu selection
	$lists['menuselect']		= mosAdminMenus::MenuSelect( );
    //build the html multiple select list for language selection
    $lists['languages']			= mosAdminMenus::SelectLanguages( 'languages', $row->language, $adminLanguage->A_ALL_LANGS );

	//build the select list for the image caption alignment
	$lists['_caption_align'] 	= mosAdminMenus::Positions( '_caption_align' );
	//build the select list for the image caption position
	$pos[] = mosHTML::makeOption( 'bottom', $adminLanguage->A_BOTTOM );
	$pos[] = mosHTML::makeOption( 'top', $adminLanguage->A_TOP );
	$lists['_caption_position'] = mosHTML::selectList( $pos, '_caption_position', 'class="selectbox" size="1"', 'value', 'text' );
	
	
	//get params definitions
	$params = new mosParameters( $row->attribs, $mainframe->getPath( 'com_xml', 'com_typedcontent' ), 'component' );

	HTML_typedcontent::edit( $row, $images, $lists, $params, $option, $menus );
}


/************************/
/* SAVE AUTONOMOUS PAGE */
/************************/
function save( $option, $task ) {
	global $database, $my, $adminLanguage, $mainframe;

	$menu 		= mosGetParam( $_POST, 'menu', 'mainmenu' );
	$menuid		= mosGetParam( $_POST, 'menuid', 0 );

    foreach ($_POST['languages'] as $xlang) {
    	if (trim($xlang) == '') { $newlangs = ''; }
    }
    if (!isset($newlangs)) {
    	$newlangs = implode(',', $_POST['languages']);
    }
    $_POST['language'] = $newlangs;

	$row = new mosContent( $database );
	if (!$row->bind( $_POST )) {
		$mainframe->checkSendHeaders();
		echo '<script type="text/javascript">alert(\''.$row->getError().'\'); window.history.go(-1);</script>'._LEND;
		exit();
	}

	if ($row->id) {
		$row->modified = date( 'Y-m-d H:i:s' );
		$row->modified_by = $my->id;
	} else {
		$row->created = date( 'Y-m-d H:i:s' );
		$row->created_by = $my->id;
	}
	if (eUTF::utf8_trim( $row->publish_down ) == $adminLanguage->A_NEVER) {
		$row->publish_down = '2060-01-01 00:00:00';
	}

    $row->seotitle = eUTF::utf8_trim($row->seotitle);
    if ($row->seotitle == '') {
    	$mainframe->checkSendHeaders();
		echo '<script type="text/javascript">alert(\''.$adminLanguage->A_SEOTEMPTY.'\'); window.history.go(-1);</script>'._LEND;
		exit();
	}

    if (!eUTF::utf8_isASCII($row->seotitle)) {
    	$mainframe->checkSendHeaders();
		echo '<script type="text/javascript">alert(\''.$adminLanguage->A_SEOTITLE.': '.$adminLanguage->A_INVALID.'\'); window.history.go(-1);</script>'._LEND;
		exit();
	}

    $seotitle2 = preg_replace("/[^a-z0-9-_]/", '', $row->seotitle);
    if ($seotitle2 != $row->seotitle) {
    	$mainframe->checkSendHeaders();
		echo '<script type="text/javascript">alert(\''.$adminLanguage->A_SEOTITLE.': '.$adminLanguage->A_INVALID.'\'); window.history.go(-1);</script>'._LEND;
		exit();
	}

    $extra = ($row->id) ? "AND id <> '$row->id'" : '';
    $database->setQuery("SELECT COUNT(*) FROM #__content WHERE seotitle='".$row->seotitle."'".$extra);
    $c = intval($database->loadResult());
	if ($c) {
		$mainframe->checkSendHeaders();
		echo '<script type="text/javascript">alert(\''.$adminLanguage->A_INVALID.', '.$adminLanguage->A_SEOTEXIST.'\'); window.history.go(-1);</script>'._LEND;
		exit();
	}

	if (trim($row->metadesc) == '') { $row->metadesc = $row->title; }
	if (trim($row->metakey) == '') { $row->metakey = eUTF::utf8_str_replace(' ', ', ', $row->title); }

	//Save Parameters
	$params = mosGetParam( $_POST, 'params', '' );
	if (is_array( $params )) {
		$txt = array();
		foreach ( $params as $k=>$v) {
			$txt[] = "$k=$v";
		}
		$row->attribs = implode( "\n", $txt );
	}

	//code cleaner for xhtml transitional compliance
	$row->introtext = eUTF::utf8_str_replace( '<br>', '<br />', $row->introtext );
	$row->state = mosGetParam( $_REQUEST, 'published', 0 );

	if (!$row->check()) {
		$mainframe->checkSendHeaders();
		echo '<script type="text/javascript">alert(\''.$row->getError().'\'); window.history.go(-1);</script>'._LEND;
		exit();
	}
	if (!$row->store()) {
		$mainframe->checkSendHeaders();
		echo '<script type="text/javascript">alert(\''.$row->getError().'\'); window.history.go(-1);</script>'._LEND;
		exit();
	}
	$row->checkin();

	switch ( $task ) {
		case 'go2menu':
			mosRedirect( 'index2.php?option=com_menus&menutype='. $menu );
		break;
		case 'go2menuitem':
			mosRedirect( 'index2.php?option=com_menus&menutype='. $menu .'&task=edit&hidemainmenu=1&id='. $menuid );
		break;
		case 'menulink':
			menuLink( $option, $row->id );
		break;
		case 'resethits':
			resethits( $option, $row->id );
		break;
		case 'save':
			$msg = $adminLanguage->A_CMP_TDC_SAVED;
			mosRedirect( 'index2.php?option='. $option, $msg );
		break;
		case 'apply':
		default:
			$msg = $adminLanguage->A_CMP_TDC_CHANG_SAVED;
			mosRedirect( 'index2.php?option='. $option .'&task=edit&hidemainmenu=1&id='. $row->id, $msg );
		break;
	}
}


/*************************/
/* TRASH AUTONOMOUS PAGE */
/*************************/
function trash( &$cid, $option ) {
	global $database, $mainframe, $adminLanguage;

	$total = count( $cid );
	if ( $total < 1) {
		$mainframe->checkSendHeaders();
		echo '<script type="text/javascript">alert(\''.$adminLanguage->A_CMP_TDC_SELIDEL.'\'); window.history.go(-1);</script>'._LEND;
		exit();
	}

	$state = '-2';
	$ordering = '0';
	//seperate contentids
	$cids = implode( ',', $cid );
	$query = "UPDATE #__content SET state = '". $state ."', ordering = '". $ordering ."'"
	. "\n WHERE id IN ( ". $cids ." )";
	$database->setQuery( $query );
	if ( !$database->query() ) {
		$mainframe->checkSendHeaders();
		echo '<script type="text/javascript">alert(\''.$database->getErrorMsg().'\'); window.history.go(-1);</script>'._LEND;
		exit();
	}

	$msg = $total ." ". $adminLanguage->A_ITEMSTRASHED;
	mosRedirect( 'index2.php?option='. $option, $msg );
}


/*********************************/
/* CHANGE AUTONOMOUS PAGES STATE */
/*********************************/
function changeState( $cid=null, $state=0 ) {
	global $database, $my, $adminLanguage, $mainframe;

	if (count( $cid ) < 1) {
		$action = $state == 1 ? $adminLanguage->A_PUBLISH : ($state == -1 ? $adminLanguage->A_MENU_ARCHIVE : $adminLanguage->A_UNPUBLISHED );
		$mainframe->checkSendHeaders();
		echo '<script type="text/javascript">alert(\''.$adminLanguage->A_SELITEMTO.' '.$action.'\'); window.history.go(-1);</script>'._LEND;
		exit();
	}

	$total = count ( $cid );
	$cids = implode( ',', $cid );

	$database->setQuery( "UPDATE #__content SET state='$state'"
	."\n WHERE id IN ($cids) AND (checked_out=0 OR (checked_out='$my->id'))"
	);
	if (!$database->query()) {
		$mainframe->checkSendHeaders();
		echo '<script type="text/javascript">alert(\''.$database->getErrorMsg().'\'); window.history.go(-1);</script>'._LEND;
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosContent( $database );
		$row->checkin( $cid[0] );
	}

	if ( $state == "1" ) {
		$msg = $total ." ". $adminLanguage->A_CMP_TDC_PUBLSHED;
	} else if ( $state == "0" ) {
		$msg = $total ." ". $adminLanguage->A_CMP_TDC_ITSUUNP;
	}
	mosRedirect( 'index2.php?option=com_typedcontent', $msg );
	exit();
}


/*********************/
/* AJAX CHANGE STATE */
/*********************/
function ajaxchangeState() {
	global $database, $my, $adminLanguage;

    $elem = intval(mosGetParam($_REQUEST, 'elem', 0));
    $id = intval(mosGetParam($_REQUEST, 'id', 0));
    $state = intval(mosGetParam($_REQUEST, 'state', 0));

    if (!$id) {
        echo '<img src="../includes/js/ThemeOffice/warning.png" width="16" height="16" border="0" title="'.$adminLanguage->A_ERROR.': Invalid Item id" />'._LEND;
        exit();
    }

    $error = 0;
	$database->setQuery( "UPDATE #__content SET state='$state' WHERE id='$id' AND (checked_out=0 OR (checked_out='".$my->id."'))");
	if (!$database->query()) { $error = 1; }

    if (!$error) {
	   $row = new mosContent( $database );
	   $row->checkin( $id );
	}

    if ($error) { $state = $state ? 0 : 1; }
    $img = $state ? 'publish_g.png' : 'publish_x.png';
    $alt = $state ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
?>
	<a href="javascript: void(0);" 
    onclick="changeTypedState('<?php echo $elem; ?>', '<?php echo $id; ?>', '<?php echo ($state) ? 0 : 1; ?>');">
	<img src="images/<?php echo $img; ?>" width="12" height="12" border="0" title="<?php echo $alt; ?>" /></a>
<?php 
    exit();
}


/*********************************/
/* CHANGE AUTONOMOUS PAGE ACCESS */
/*********************************/
function changeAccess( $id, $access, $option  ) {
	global $database;

	$row = new mosContent( $database );
	$row->load( $id );
	$row->access = $access;

	if ( !$row->check() ) {
		return $row->getError();
	}
	if ( !$row->store() ) {
		return $row->getError();
	}

	mosRedirect( 'index2.php?option='. $option );
}


/**************/
/* RESET HITS */
/**************/
function resethits( $option, $id ) {
	global $database, $adminLanguage;

	$row = new mosContent($database);
	$row->Load( $id );
	$row->hits = "0";
	$row->store();
	$row->checkin();

	$msg = $adminLanguage->A_CMP_TDC_RSTHTCNT;
	mosRedirect( 'index2.php?option='. $option .'&task=edit&hidemainmenu=1&id='. $row->id, $msg );
}


/***********************************/
/* CANCEL ADD/EDIT AUTONOMOUS PAGE */
/***********************************/
function cancel( $option ) {
	global $database;

	$row = new mosContent( $database );
	$row->bind( $_POST );
	$row->checkin();
	mosRedirect( 'index2.php?option='. $option );
}


/**********************************/
/* CREATE MENU LINK AND SEO ENTRY */
/**********************************/
function menuLink( $option, $id ) {
	global $database, $adminLanguage, $mainframe;

	$menu = mosGetParam( $_POST, 'menuselect', '' );
	$link = mosGetParam( $_POST, 'link_name', '' );

	$row 				= new mosMenu( $database );
	$row->menutype 		= $menu;
	$row->name 			= $link;
	$row->type 			= 'content_typed';
	$row->published		= 1;
	$row->componentid	= $id;
	$row->link			= 'index.php?option=com_content&task=view&id='. $id;
	$row->ordering		= 9999;

	if (!$row->check()) {
		$mainframe->checkSendHeaders();
		echo '<script type="text/javascript">alert(\''.$row->getError().'\'); window.history.go(-1);</script>'._LEND;
		exit();
	}
	if (!$row->store()) {
		$mainframe->checkSendHeaders();
		echo '<script type="text/javascript">alert(\''.$row->getError().'\'); window.history.go(-1);</script>'._LEND;
		exit();
	}
	$row->checkin();
	$row->updateOrder( "menutype='$row->menutype' AND parent='$row->parent'" );

	$msg = $link ." ". $adminLanguage->A_CMP_TDC_INMENU  .": ". $menu ." ". $adminLanguage->A_CMP_TDC_SUCCSS;
	mosRedirect( 'index2.php?option='. $option .'&task=edit&hidemainmenu=1&id='. $id, $msg );
	exit();
}


function go2menu() {
	global $database;

	//checkin content
	$row = new mosContent( $database );
	$row->bind( $_POST );
	$row->checkin();

	$menu = mosGetParam( $_POST, 'menu', 'mainmenu' );

	mosRedirect( 'index2.php?option=com_menus&menutype='. $menu );
}


function go2menuitem() {
	global $database;

	//checkin content
	$row = new mosContent( $database );
	$row->bind( $_POST );
	$row->checkin();

	$menu 	= mosGetParam( $_POST, 'menu', 'mainmenu' );
	$id		= mosGetParam( $_POST, 'menuid', 0 );

	mosRedirect( 'index2.php?option=com_menus&menutype='.$menu.'&task=edit&hidemainmenu=1&id='.$id );
}


/**************/
/* SAVE ORDER */
/**************/
function saveOrder( &$cid ) {
	global $database, $adminLanguage, $mainframe;

	$total		= count( $cid );
	$order 		= mosGetParam( $_POST, 'order', array(0) );
	$conditions = array();

    //update ordering values
	for($i=0; $i < $total; $i++) {
		$database->setQuery("SELECT id, catid, ordering FROM #__content WHERE id='".$cid[$i]."'", '#__', 1, 0);
		$row = $database->loadRow();
		if ($row && ($row['ordering'] != $order[$i])) {
			$database->setQuery("UPDATE #__content SET ordering='".intval($order[$i])."' WHERE id=".$row['id']);
			$database->query();
	        //remember to updateOrder this group
	        $condition = "catid='".$row['catid']."' AND state >= 0";
	        $found = false;
	        if ($conditions) {
	        	foreach ($conditions as $cond) {
	            	if ($cond[1] == $condition) { $found = true; break; }
	        	}
	        }
	        if (!$found) { $conditions[] = array($row['id'], $condition); }
		}
		unset($row);
	}

	//execute updateOrder for each group
	if ($conditions) {
		foreach ($conditions as $cond) {
			$row = new mosContent( $database );
			$row->load( $cond[0] );
			$row->updateOrder( $cond[1] );
			unset($row);
		}
	}

	$msg = $adminLanguage->A_NEWORDERSAVED;
	mosRedirect( 'index2.php?option=com_typedcontent', $msg );
}


/***********************/
/* PREPARE TRANSLATION */
/***********************/
function translateItem( $cid, $option ) {
	global $database, $adminLanguage, $mainframe;

	if ((trim($cid) == '' ) || ( $cid == 0 )) {
		$mainframe->checkSendHeaders();
		echo '<script type="text/javascript">alert(\''.$adminLanguage->A_CMP_TDC_TRSELITEM.'\'); window.history.go(-1);</script>'._LEND;
		exit();
	}

	//load the row from the db table
	$database->setQuery("SELECT id, title, language FROM #__content WHERE id=".$cid."", '#__', 1, 0);
	$row = $database->loadRow();
	if (!$row) {
		$mainframe->checkSendHeaders();
		echo '<script type="text/javascript">alert(\''.$adminLanguage->A_CMP_TDC_TRSELITEM.'\'); window.history.go(-1);</script>'._LEND;
		exit();
	}

	$initLang = $mainframe->getCfg('lang');
	if (trim($row['language']) != '') {
		if (preg_match('#\,#', $row['language'])) {
			$parts = preg_split('#\,#', trim($row['language']), 2, PREG_SPLIT_NO_EMPTY);
			$initLang = trim($parts[0]);
		} else {
			$initLang = trim($row['language']);
		}
	}

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/translator.class.php');
    $metafrasi = new translator();
    $alllangs = $metafrasi->supportedLanguages();
    unset($metafrasi);

	HTML_typedcontent::tranlate_Item($option, $alllangs, $initLang, $row);
}


/***************************/
/* TRANSLATE AND SAVE ITEM */
/***************************/
function dotranslateItem($cid, $option) {
    global $database, $adminLanguage, $my, $mainframe;

    $langfrom = mosGetParam($_POST, 'langfrom', '');
    $langto = mosGetParam($_POST, 'langto', '');
	if (($langfrom == '') || ($langto == '')) {
    	echo '<script type="text/javascript">alert(\''._GEM_TRINV_INOUT.'\'); window.history.go(-1);</script>'."\n";
    	exit();
	}

    $database->setQuery("SELECT * FROM #__content WHERE id='".$cid."'", '#__', 1, 0);
    $database->loadObject($item);
    if (!$item) {
    	echo "<script type=\"text/javascript\">alert(\"".$adminLanguage->A_CMP_TDC_TRITMNOTF."\"); window.history.go(-2);</script>"._LEND;
    	exit();
    }

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/translator.class.php');
    $metafrasi = new translator();

	$retIntro = $metafrasi->translate($item->introtext, $langfrom, $langto);
	if ($retIntro === false) {
    	echo '<script type="text/javascript">alert(\''.$metafrasi->geterror().'\'); window.history.go(-2);</script>'."\n";
    	exit();
	}

    $retMain = $item->maintext;
    if (trim($item->maintext) != '') {
		$retMain = $metafrasi->translate($item->maintext, $langfrom, $langto);
	}

	$retTitle = $metafrasi->translate($item->title, $langfrom, $langto);
	if ($retTitle === false) {
    	echo '<script type="text/javascript">alert(\''.$metafrasi->geterror().'\'); window.history.go(-2);</script>'."\n";
    	exit();
	}

	$itemLang = $item->language;
    $elxlang = $metafrasi->googleToElxis($langto);
    if ($elxlang !== false) {
    	$plangs = preg_split('/\,/', $mainframe->getCfg('pub_langs'));
    	if ($plangs && in_array($elxlang, $plangs)) {
    		$itemLang = $elxlang;
    	} else {
    		$itemLang = $item->language;
    	}
    }
    unset($metafrasi);

	$seotitle = $item->seotitle.'-'.$langto;
	$database->setQuery("SELECT COUNT(id) FROM #__content WHERE seotitle='".$seotitle."'");
	$c = (int)$database->loadResult();
	if ($c > 0) {
		$seotitle = $item->seotitle.'-'.$langto.'-'.rand(1,999);
	}

    $metaKey = preg_replace('/[\s]/', ', ', $retTitle);
    $nowdate = date('Y-m-d H:i:s');

    $row = new mosContent($database);
    $row->id 				= NULL;
    $row->sectionid 		= $item->sectionid;
	$row->catid 			= $item->catid;
	$row->hits 				= '0';
	$row->ordering			= '0';
	$row->title 			= $retTitle;
	$row->seotitle 			= $seotitle;
	$row->introtext 		= $retIntro;
	$row->maintext 			= $retMain;
	$row->state 			= $item->state;
	$row->mask 				= $item->mask;
	$row->created 			= $nowdate;
	$row->created_by 		= $my->id;
	$row->created_by_alias 	= NULL;
	$row->modified 			= $nowdate;
	$row->modified_by 		= $my->id;
	$row->checked_out 		= '0';
	$row->checked_out_time 	= '1979-12-19 00:00:00';
	$row->publish_up 		= $nowdate;
	$row->publish_down 		= '2060-01-01 00:00:00';
	$row->images 			= $item->images;
	$row->urls 			    = $item->urls;
	$row->attribs 			= $item->attribs;
	$row->version 			= '1';
	$row->parentid 			= $item->parentid;
	$row->metakey 			= $metaKey;
	$row->metadesc 			= $retTitle.' '.$item->metadesc;
	$row->access 			= $item->access;
	$row->language 			= $itemLang;

	if (!$row->check()) {
		$mainframe->checkSendHeaders();
		echo '<script type="text/javascript">alert(\''.$row->getError().'\'); window.history.go(-2);</script>'._LEND;
		exit();
	}
	if (!$row->store()) {
		$mainframe->checkSendHeaders();
		echo '<script type="text/javascript">alert(\''.$row->getError().'\'); window.history.go(-2);</script>'._LEND;
		exit();
	}
	$row->updateOrder( "catid='". $row->catid ."' AND state >= 0" );

    $msg = $adminLanguage->A_CMP_TDC_TROKSAVED;
    mosRedirect('index2.php?option='.$option, $msg);
}


/**********************/
/* VALIDATE SEO TITLE */
/**********************/
function validateSEOtitle() {
    global $mainframe;

    $coid = intval(mosGetParam($_POST, 'coid', 0));
    $seotitle = eUTF::utf8_trim(mosGetParam($_POST, 'seotitle', ''));

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
    $seo = new seovs('com_typedcontent', '', $seotitle);
    $seo->id = $coid;
    $seo->validate();
    echo $seo->message;
    exit();
}


/*********************/
/* SUGGEST SEO TITLE */
/*********************/
function suggestSEOtitle() {
    global $mainframe;

    $coid = intval(mosGetParam($_POST, 'coid', 0));
    $cotitle = mosGetParam($_POST, 'cotitle', '');

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
    $seo = new seovs('com_typedcontent', $cotitle);
    $seo->id = $coid;
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
