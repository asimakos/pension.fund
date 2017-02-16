<?php 
/**
* @version: $Id: admin.frontpage.php 42 2010-06-08 15:17:42Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Frontpage
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//ensure user has access to this function
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
		| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_frontpage' ))) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

//call
require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$task = mosGetParam( $_REQUEST, 'task', array(0) );
$cid = mosGetParam( $_POST, 'cid', array(0) );
if (!is_array( $cid )) {
	$cid = array(0);
}

switch ($task) {
	case 'publish':
		changeFrontPage( $cid, 1, $option );
		break;
	case 'unpublish':
		changeFrontPage( $cid, 0, $option );
		break;
	case 'ajaxpub':
	    ajaxchangeFront();
        break;
	case 'archive':
		changeFrontPage( $cid, -1, $option );
		break;
	case 'remove':
		removeFrontPage( $cid, $option );
		break;
	case 'orderup':
		orderFrontPage( $cid[0], -1, $option );
		break;
	case 'orderdown':
		orderFrontPage( $cid[0], 1, $option );
		break;
	case 'saveorder':
		saveOrder( $cid );
		break;
    case 'setaccess':
        $access = mosGetParam( $_REQUEST, 'access', 29 );
        $sid = mosGetParam( $_REQUEST, 'sid', $cid[0] );
		accessMenu( $sid, $access );
		break;
	default:
		viewFrontPage( $option );
		break;
}


/**************************************/
/* PREPARE TO DISPLAY FRONTPAGE ITEMS */
/**************************************/
function viewFrontPage( $option ) {
	global $database, $mainframe, $mosConfig_list_limit, $mosConfig_pub_langs, $adminLanguage;

	$catid 				= $mainframe->getUserStateFromRequest( "catid{$option}", 'catid', 0 );
	$filter_authorid 	= $mainframe->getUserStateFromRequest( "filter_authorid{$option}", 'filter_authorid', 0 );
	$filter_sectionid 	= $mainframe->getUserStateFromRequest( "filter_sectionid{$option}", 'filter_sectionid', 0 );
	$limit 		= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );
	$search 	= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
	$search 	= $database->getEscaped( eUTF::utf8_trim( eUTF::utf8_strtolower( $search ) ) );
    $filter_lang = trim( strtolower(mosGetParam( $_REQUEST, 'filter_lang', '' )));

    //in order to work 'filtered by' icons with register_globals off
    $formfilters = array(
        'catid' => $catid,
        'filter_authorid' => $filter_authorid,
        'filter_sectionid' => $filter_sectionid,
        'filter_lang' => $filter_lang
    );

	$where = array(
	   "c.state >= 0"
	);

	//used by filter
	if ( $filter_sectionid > 0 ) {
		$where[] = "c.sectionid = '$filter_sectionid'";
	}
	if ( $catid > 0 ) {
		$where[] = "c.catid = '$catid'";
	}
	if ( $filter_authorid > 0 ) {
		$where[] = "c.created_by = '$filter_authorid'";
	}
	if ( $filter_lang != '' ) {
		$where[] = "((c.language LIKE '%$filter_lang%') OR (c.language IS NULL))";
	}
	if ($search) {
		$where[] = "LOWER(c.title) LIKE '%$search%'";
	}

	$dbpg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;
	$dbora = in_array($database->_resource->databaseType, array('oci8', 'oci805', 'oci8po', 'oracle')) ? 1 : 0;
	
	//get the total number of records
	$query = "SELECT COUNT(*) FROM #__content c"
	. "\n INNER JOIN #__categories cc ON cc.id = c.catid";
	if ($dbpg) {
		$query .= "\n INNER JOIN #__sections s ON CAST(s.id AS VARCHAR)= cc.section AND s.scope='content'";
	} else if ($dbora) {
		$query .= "\n INNER JOIN #__sections s ON TO_CHAR(s.id) = cc.section AND s.scope='content'";
	} else {
		$query .= "\n INNER JOIN #__sections s ON s.id = cc.section AND s.scope='content'";
	}
	$query .= "\n INNER JOIN #__content_frontpage f ON f.content_id = c.id"
	. (count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' )
    ;
	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	$query = "SELECT c.*, g.name AS groupname, cc.name, cc.language AS category_lang, s.name AS sect_name, u.name AS editor, f.ordering AS fpordering, v.name AS author"
	. "\n FROM #__content c"
	. "\n INNER JOIN #__categories cc ON cc.id = c.catid";
	if ($dbpg) {
		$query .= "\n INNER JOIN #__sections s ON CAST(s.id AS VARCHAR) = cc.section AND s.scope='content'";
	} else if ($dbora) {
		$query .= "\n INNER JOIN #__sections s ON TO_CHAR(s.id) = cc.section AND s.scope='content'";
	} else {
		$query .= "\n INNER JOIN #__sections s ON s.id = cc.section AND s.scope='content'";
	}
	$query .= "\n INNER JOIN #__content_frontpage f ON f.content_id = c.id"
	. "\n INNER JOIN #__core_acl_aro_groups g ON g.group_id = c.access"
	. "\n LEFT JOIN #__users u ON u.id = c.checked_out"
	. "\n LEFT JOIN #__users v ON v.id = c.created_by"
	. (count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : "")
	. "\n ORDER BY f.ordering";
	$database->setQuery( $query, '#__', $pageNav->limit, $pageNav->limitstart );

	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	//get list of categories for dropdown filter
	$query = "SELECT cc.id AS value, cc.title AS text, cc.section FROM #__categories cc";
	if ($dbpg) {
		$query .= "\n INNER JOIN #__sections s ON CAST(s.id AS VARCHAR)=cc.section";
	} else if ($dbora) {
		$query .= "\n INNER JOIN #__sections s ON TO_CHAR(s.id) = cc.section";
	} else {
		$query .= "\n INNER JOIN #__sections s ON s.id=cc.section";
	}
	$query .= "\n ORDER BY s.ordering, cc.ordering";
	$categories[] = mosHTML::makeOption( '0', $adminLanguage->A_ALL_CATEGORIES );
	$database->setQuery( $query );
	$categories = array_merge( $categories, $database->loadObjectList() );
	$lists['catid'] = mosHTML::selectList( $categories, 'catid', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $catid );

	//get list of sections for dropdown filter
	$javascript = 'onchange="document.adminForm.submit();"';
	$lists['sectionid']	= mosAdminMenus::SelectSection( 'filter_sectionid', $filter_sectionid, $javascript );

	//get list of Authors for dropdown filter
	$query = "SELECT c.created_by AS value, u.name AS text"
	. "\n FROM #__content c"
	. "\n INNER JOIN #__sections s ON s.id = c.sectionid"
	. "\n LEFT JOIN #__users u ON u.id = c.created_by"
	. "\n WHERE c.state <> '-1'"
	. "\n AND c.state <> '-2'"
	. "\n GROUP BY c.created_by, u.name"
	. "\n ORDER BY u.name";
	$authors[] = mosHTML::makeOption( '0', $adminLanguage->A_ALL_AUTHORS );
	$database->setQuery( $query );
	$authors = array_merge( $authors, $database->loadObjectList() );
	$lists['authorid']	= mosHTML::selectList( $authors, 'filter_authorid', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $filter_authorid );

    //get list of enabled languages for dropdown filter
    $plangs[] = mosHTML::makeOption( '',$adminLanguage->A_ALL_LANGS );
    $publs = explode(',', $mosConfig_pub_langs);
    foreach ($publs as $publ) {
        $plangs[] = mosHTML::makeOption( $publ, $publ );
    }
	$lists['flangs'] = mosHTML::selectList( $plangs, 'filter_lang', 'class="inputbox" size="1" dir="ltr" onchange="document.adminForm.submit();"', 'value', 'text', $filter_lang );

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

	HTML_content::showList( $rows, $search, $pageNav, $option, $lists, $formfilters, $simpleview );
}


/********************************/
/* CHANGE FRONTPAGE ITEMS STATE */
/********************************/
function changeFrontPage( $cid=null, $state=0, $option ) {
	global $database, $my, $adminLanguage, $mainframe;

	if (count( $cid ) < 1) {
		$action = $publish == 1 ? $adminLanguage->A_PUBLISH : ($publish == -1 ? $adminLanguage->A_ARCHIVE : $adminLanguage->A_UNPUBLISH);
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_SELITEMTO ." ". $action ."\"); window.history.go(-1);</script>\n";
		exit();
	}

	$cids = implode( ',', $cid );

	$query = "UPDATE #__content SET state='".$state."' WHERE id IN ($cids) AND (checked_out=0 OR (checked_out='$my->id'))";
	$database->setQuery( $query );
	if (!$database->query()) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosContent( $database );
		$row->checkin( $cid[0] );
	}

	mosRedirect('index2.php?option='.$option);
}


/**********************/
/* AJAX CHANGE STATUS */
/**********************/
function ajaxchangeFront() {
    global $database, $my, $adminLanguage;

    $elem = intval(mosGetParam($_REQUEST, 'elem', 0));
    $id = intval(mosGetParam($_REQUEST, 'id', 0));
    $state = intval(mosGetParam($_REQUEST, 'state', 0));

    if (!$id) {
        echo '<img src="../includes/js/ThemeOffice/warning.png" width="16" height="16" border="0" title="'.$adminLanguage->A_ERROR.': Invalid Item id" />'._LEND;
        exit();
    }

    $error = 0;
	$database->setQuery( "UPDATE #__content SET state='".$state."' WHERE id='".$id."' AND (checked_out=0 OR (checked_out='".$my->id."'))");
	if (!$database->query()) { $error = 1; }

    if ($error) { $state = $state ? 0 : 1; }
    $img = $state ? 'publish_g.png' : 'publish_x.png';
    $alt = $state ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
?>
	<a href="javascript: void(0);" 
    onclick="changeFrontState('<?php echo $elem; ?>', '<?php echo $id; ?>', '<?php echo ($state) ? 0 : 1; ?>');">
	<img src="images/<?php echo $img; ?>" width="12" height="12" border="0" title="<?php echo $alt; ?>" /></a>
<?php 
    exit();
}


function removeFrontPage( &$cid, $option ) {
	global $database, $adminLanguage, $mainframe;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_CMP_CNT_SELIDEL ."\"); window.history.go(-1);</script>\n";
		exit();
	}
	$fp = new mosFrontPage( $database );
	foreach ($cid as $id) {
		if (!$fp->delete( $id )) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$fp->getError()."');</script>\n";
			exit();
		}
		$obj = new mosContent( $database );
		$obj->load( $id );
		$obj->mask = 0;
		if (!$obj->store()) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$fp->getError()."');</script>\n";
			exit();
		}
	}
	$fp->updateOrder();

	mosRedirect( "index2.php?option=$option" );
}

/**
* Moves the order of a record
* @param integer The increment to reorder by
*/
function orderFrontPage( $uid, $inc, $option ) {
	global $database;

	$fp = new mosFrontPage( $database );
	$fp->load( $uid );
	$fp->move( $inc );

	mosRedirect( "index2.php?option=$option" );
}

/**
* @param integer The id of the content item
* @param integer The new access level
* @param string The URL option
*/
function accessMenu( $uid, $access ) {
	global $database;

	$row = new mosContent( $database );
	$row->load( $uid );
	$row->access = $access;

	if ( !$row->check() ) {
		return $row->getError();
	}
	if ( !$row->store() ) {
		return $row->getError();
	}

	mosRedirect( 'index2.php?option=com_frontpage' );
}

function saveOrder( &$cid ) {
	global $database, $adminLanguage, $mainframe;

	$total = count( $cid );
	$order = mosGetParam( $_POST, 'order', array(0) );

	for( $i=0; $i < $total; $i++ ) {
		$query = "UPDATE #__content_frontpage SET ordering='".$order[$i]."' WHERE content_id = '".$cid[$i]."'";
		$database->setQuery( $query );
		if (!$database->query()) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
			exit();
		}

		//update ordering
		$row = new mosFrontPage( $database );
		$row->load( $cid[$i] );	
		$row->updateOrder();
		unset($row);
	}

	$msg = $adminLanguage->A_NEWORDERSAVED;
	mosRedirect( 'index2.php?option=com_frontpage', $msg );
}
?>