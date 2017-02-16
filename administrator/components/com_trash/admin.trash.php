<?php 
/**
* @version: $Id: admin.trash.php 2527 2009-09-29 10:55:48Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Trash
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//ensure user has access to this function
if (!($acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_trash' ))) {
    mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class', 'com_frontpage' ) );

$task = mosGetParam( $_REQUEST, 'task', array(0) );
$cid = mosGetParam( $_POST, 'cid', array(0) );
$mid = mosGetParam( $_POST, 'mid', array(0) );
if ( !is_array( $cid ) ) {
	$cid = array(0);
}

switch ($task) {
	case "deleteconfirm":
	viewdeleteTrash( $cid, $mid, $option );
	break;
	case "delete":
	deleteTrash( $cid, $option );
	break;
	case "restoreconfirm":
	viewrestoreTrash( $cid, $mid, $option );
	break;
	case "restore":
	restoreTrash( $cid, $option );
	break;
	default:
	viewTrash( $option );
	break;
}


/*******************************/
/* PREPARE TO LIST TRASH ITEMS */
/*******************************/
function viewTrash( $option ) {
	global $database, $mainframe, $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{". $option ."}limitstart", 'limitstart', 0 );
	$limit2 = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit2', $mosConfig_list_limit );
	$limitstart2 = $mainframe->getUserStateFromRequest( "view{". $option ."}limitstart", 'limitstart2', 0 );

	$pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;

	//get the total number of content
	$query = "SELECT COUNT(*) FROM #__content c"
	."\n LEFT JOIN #__categories cc ON cc.id = c.catid";
	if ($pg) {
		$query .= "\n LEFT JOIN #__sections s ON s.id::VARCHAR = cc.section AND s.scope='content'";
	} else {
		$query .= "\n LEFT JOIN #__sections s ON s.id = cc.section AND s.scope='content'";
	}
	$query .= "\n WHERE c.state = '-2'";
	$database->setQuery( $query );
	$total_content = $database->loadResult();

	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
	$pageNav_content = new mosPageNav( $total_content, $limitstart, $limit );

	//Query content items
	$query = "SELECT c.*, g.name AS groupname, cc.name AS catname, s.name AS sectname"
	."\n FROM #__content c"
	."\n LEFT JOIN #__categories cc ON cc.id = c.catid";
	if ($pg) {
		$query .= "\n LEFT JOIN #__sections s ON s.id::VARCHAR = cc.section AND s.scope='content'";
	} else {
		$query .= "\n LEFT JOIN #__sections s ON s.id = cc.section AND s.scope='content'";
	}
	$query .= "\n INNER JOIN #__core_acl_aro_groups g ON g.group_id = c.access"
	."\n LEFT JOIN #__users u ON u.id = c.checked_out"
	."\n WHERE c.state = '-2'"
	."\n ORDER BY s.name, cc.name, c.title";
	$database->setQuery( $query, '#__', $pageNav_content->limit, $pageNav_content->limitstart );
	$contents = $database->loadObjectList();

	$query = "SELECT COUNT(*) FROM #__menu m"
	."\n LEFT JOIN #__users u ON u.id = m.checked_out"
	."\n WHERE m.published = '-2'";
	$database->setQuery( $query );
	$total_menu = $database->loadResult();

	$pageNav_menu = new mosPageNav( $total_menu, $limitstart2, $limit2, '2' );

	//Query menu items
	$query = "SELECT m.* FROM #__menu m"
	."\n LEFT JOIN #__users u ON u.id = m.checked_out"
	."\n WHERE m.published = '-2'"
	."\n ORDER BY m.menutype, m.ordering, m.ordering, m.name";
	$database->setQuery( $query, '#__', $pageNav_menu->limit, $pageNav_menu->limitstart );
	$menus = $database->loadObjectList();

	foreach ( $contents as $i=>$content) {
	    if ( ( $content->sectionid == 0 ) AND ( $content->catid == 0 ) ) {
	        $contents[$i]->sectname = 'Typed Content';
	    }
	}
	HTML_trash::showList( $option, $contents, $menus, $pageNav_content, $pageNav_menu );
}


/*********************************/
/* PREPARE TO DELETE THASH ITEMS */
/*********************************/
function viewdeleteTrash( $cid, $mid, $option ) {
	global $database, $mainframe;

	//seperate contentids
	$cids = implode( ',', $cid );
	$mids = implode( ',', $mid );

	if ( $cids ) {
		//Content Items query
		$query = "SELECT title AS name FROM #__content WHERE id IN (".$cids.") ORDER BY title";
		$database->setQuery( $query );
		$items = $database->loadObjectList();
		$id = $cid;
		$type = "content";
	} else if ( $mids ) {
		//Menu Items query
		$query = "SELECT name FROM #__menu WHERE id IN (".$mids.") ORDER BY name";
		$database->setQuery( $query );
		$items = $database->loadObjectList();
		$id = $mid;
		$type = "menu";
	}

	HTML_trash::showDelete( $option, $id, $items, $type );
}


/**********************/
/* DELETE TRASH ITEMS */
/**********************/
function deleteTrash( $cid, $option ) {
	global $database, $mainframe, $adminLanguage;

	$type = mosGetParam( $_POST, 'type', array(0) );
	$total = count( $cid );

	if ( $type == "content" ) {
		$obj = new mosContent( $database );
		$fp = new mosFrontPage( $database );
		foreach ( $cid as $id ) {
			$id = intval( $id );
			$obj->delete( $id );
			$fp->delete( $id );
			$database->setQuery("DELETE FROM #__comments WHERE articleid='".$id."' AND origin = '1'");
			$database->query();
		}
	} else if ( $type == "menu" ) {
		$obj = new mosMenu( $database );
		foreach ( $cid as $id ) {
			$id = intval( $id );
			$obj->delete( $id );
		}
	}

	mosRedirect( 'index2.php?option='.$option, $total.' '.$adminLanguage->A_CMP_TRSH_SUCDEL );
}


/**********************************/
/* PREPARE TO RESTORE THASH ITEMS */
/**********************************/
function viewrestoreTrash( $cid, $mid, $option ) {
	global $database, $mainframe;

	$cids = implode( ',', $cid );
	$mids = implode( ',', $mid );

	if ( $cids ) {
		//Content Items query
		$query = "SELECT title AS name FROM #__content WHERE id IN (".$cids.") ORDER BY title";
		$database->setQuery( $query );
		$items = $database->loadObjectList();
		$id = $cid;
		$type = "content";
	} else if ( $mids ) {
		//Menu Items query
		$query = "SELECT name FROM #__menu WHERE id IN (".$mids.") ORDER BY name";
		$database->setQuery( $query );
		$items = $database->loadObjectList();
		$id = $mid;
		$type = "menu";
	}

	HTML_trash::showRestore( $option, $id, $items, $type );
}


/***********************/
/* RESTORE TRASH ITEMS */
/***********************/
function restoreTrash( $cid, $option ) {
	global $database, $adminLanguage;
	$type = mosGetParam( $_POST, 'type', array(0) );

	$total = count( $cid );

	//restores to an unpublished state
	$state = "0";
	$ordering = '9999';
	//seperate contentids
	$cids = implode( ',', $cid );

	if ( $type == "content" ) {
		$query = "UPDATE #__content SET state = '".$state."', ordering = '".$ordering."' WHERE id IN ( ".$cids." )";
	} else if ( $type == "menu" ) {
		$query = "UPDATE #__menu SET published = '".$state."', ordering = '9999' WHERE id IN ( ".$cids." )";
	}
	$database->setQuery( $query );
	if (!$database->query()) {
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}

	mosRedirect( 'index2.php?option='.$option, $total.' '.$adminLanguage->A_CMP_TRSH_SUCRES );
}

?>