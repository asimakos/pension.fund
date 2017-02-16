<?php 
/**
* @version: $Id: admin.categories.php 42 2010-06-08 15:17:42Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Categories
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


require_once( $mainframe->getPath( 'admin_html' ) );

$section = mosGetParam( $_REQUEST, 'section', 'content' );
$cid = mosGetParam( $_REQUEST, 'cid', array(0) );
if (!is_array( $cid )) { $cid = array(0); }
$id = intval(mosGetParam( $_REQUEST, 'id', '0' ));

switch ($task) {
	case 'new':
		editCategory( 0, $section );
	break;
	case 'edit':
		editCategory( intval( $cid[0] ) );
	break;
	case 'editA':
		editCategory( intval( $id ) );
	break;
	case 'moveselect':
		moveCategorySelect( $option, $cid, $section );
	break;
	case 'movesave':
		moveCategorySave( $cid, $section );
	break;
	case 'copyselect':
		copyCategorySelect( $option, $cid, $section );
	break;
	case 'copysave':
		copyCategorySave( $cid, $section );
	break;
	case 'go2menu':
	case 'go2menuitem':
	case 'menulink':
	case 'save':
	case 'apply':
		saveCategory( $task );
	break;
	case 'remove':
		removeCategories( $section, $cid );
	break;
	case 'publish':
		publishCategories( $section, $id, $cid, 1 );
	break;
	case 'unpublish':
		publishCategories( $section, $id, $cid, 0 );
	break;
	case 'ajaxpub':
        ajaxpublishCat();
    break;
	case 'cancel':
		cancelCategory();
	break;
	case 'orderup':
		orderCategory( $cid[0], -1 );
	break;
	case 'orderdown':
		orderCategory( $cid[0], 1 );
	break;
    case 'setaccess':
        $access = mosGetParam( $_REQUEST, 'access', 29 );
        $sid = mosGetParam( $_REQUEST, 'sid', $cid[0] );
		accessMenu( $sid, $access, $section );
	break;
	case 'saveorder':
		saveOrder( $cid, $section );
	break;
	case 'validate':
        validateSEO();
	break;
	case 'suggest':
	   suggestSEO();
	break;
	default:
		showCategories( $section, $option );
	break;
}


/*******************************************************/
/* PREPARE TO DISPLAY LIST OF CATEGORIES FOR A SECTION */
/*******************************************************/
function showCategories( $section, $option ) {
	global $database, $mainframe, $mosConfig_list_limit, $mosConfig_pub_langs, $adminLanguage;

	$sectionid = $mainframe->getUserStateFromRequest( "sectionid{$option}{$section}", 'sectionid', 0 );
	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$section}limitstart", 'limitstart', 0 );
    $filter_lang = trim( strtolower(mosGetParam( $_REQUEST, 'filter_lang', '' )));

	$pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;
	$ora = in_array($database->_resource->databaseType, array('oci8', 'oci805', 'oci8po', 'oracle')) ? 1 : 0;

    //in order to work 'filtered by' icons with register_globals off
    $formfilters = array(
        'sectionid' => $sectionid,
        'filter_lang' => $filter_lang
    );

	$section_name 	= '';
	$content_add 	= '';
	$content_join 	= '';
	$order 			= "\n ORDER BY c.ordering, c.name";
	if (intval( $section ) > 0) {
		$table = 'content';

		$query = "SELECT name FROM #__sections WHERE id='$section'";
		$database->setQuery( $query );
		$section_name = $database->loadResult();
		$section_name = 'Content: '. $section_name;
		$where 	= "\n WHERE c.section='$section'";
		$type 	= 'content';
	} else if (strpos( $section, 'com_' ) === 0) {
		$table = substr( $section, 4 );

		$query = "SELECT name FROM #__components WHERE link='option=$section'";
		$database->setQuery( $query );
		$section_name = $database->loadResult();
		$where 	= "\n WHERE c.section='$section'";
		$type 	= 'other';
		// special handling for contact component
		if ( $section == 'com_contact_details' ) {
			$section_name 	= 'Contact';
		}
		$section_name = 'Component: '. $section_name;
	} else {
		$table = $section;
		$where = "\n WHERE c.section='$section'";
		$type = 'other';
	}

	//get the total number of records
	$query = "SELECT COUNT(*) FROM #__categories WHERE section='$section'";
	$database->setQuery( $query );
	$total = $database->loadResult();

	//allows for viewing of all content categories
	if ( $section == 'content' ) {
		$table = 'content';
		$content_add = ", z.title AS section_name, z.language AS section_lang";
		if ($pg) {
			$content_join = "\n LEFT JOIN #__sections z ON z.id::VARCHAR = c.section";
		} else {
			$content_join = "\n LEFT JOIN #__sections z ON z.id = c.section";
		}
		$where = "\n WHERE c.section NOT LIKE '%com_%'";
		$order = "\n ORDER BY c.section, c.ordering, c.name";
		$section_name = 'All Content';
		//get the total number of records
		if ($pg) {
			$database->setQuery("SELECT COUNT(c.id) FROM #__categories c INNER JOIN #__sections s ON s.id::VARCHAR = c.section");
		} else if ($ora) {
			$database->setQuery("SELECT COUNT(c.id) FROM #__categories c INNER JOIN #__sections s ON TO_CHAR(s.id) = c.section");
		} else {
			$database->setQuery("SELECT COUNT(c.id) FROM #__categories c INNER JOIN #__sections s ON s.id = c.section");
		}
		$total = $database->loadResult();
		$type = 'content';
	}

	//used by filter
	$filter = '';
	if ( $sectionid > 0 ) {
		$filter .= "\n AND c.section = '$sectionid'";
	}
    if ( $filter_lang != '' ) {
		$filter .= "\n AND ((c.language LIKE '%$filter_lang%') OR (c.language IS NULL))";
	}

	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	if ($ora) {
		$query = "SELECT c.*, c.checked_out AS checked_out_contact_category, g.name AS groupname, "
		."(SELECT COUNT(DISTINCT checked_out) FROM #__".$table." s2 WHERE s2.catid = c.id AND s2.checked_out > 0) AS orachecked_out "
		.$content_add
		."\n FROM #__categories c"
		."\n LEFT JOIN #__core_acl_aro_groups g ON g.group_id = c.access"
		.$content_join
		.$where
		.$filter
		."\n AND c.published != -2"
		."\n GROUP BY c.id, c.title, c.name, c.ordering, c.image,"
		."\n c.section, c.image_position, c.description, c.published,"
		."\n c.checked_out, c.checked_out_time, c.editor, c.access, c.count, c.language,"
    	."\n c.parent_id, c.params, c.seotitle, g.name";
    	if ( $section == 'content' ) { $query .= ", z.title, z.language"; }
    	$query .= $order;
	} else {
		$query = "SELECT c.*, c.checked_out AS checked_out_contact_category, g.name AS groupname, u.name AS editor, "
		."COUNT(DISTINCT s2.checked_out) AS checked_out"
		.$content_add
		."\n FROM #__categories c"
		."\n LEFT JOIN #__users u ON u.id = c.checked_out"
		."\n LEFT JOIN #__core_acl_aro_groups g ON g.group_id = c.access"
		."\n LEFT JOIN #__".$table." s2 ON s2.catid = c.id AND s2.checked_out > 0"
		.$content_join
		.$where
		.$filter
		."\n AND c.published != -2";

		if ($pg) {
			$query .= "\n GROUP BY c.id, c.title, c.name, c.ordering, c.image,"
			. "\n c.section, c.image_position, c.description, c.published,"
			. "\n c.checked_out, c.checked_out_time, c.editor, c.access, c.count, c.language,"
    		. "\n c.parent_id, c.params, c.seotitle, g.name, u.name";
    		if ( $section == 'content' ) { $query .= ", z.title, z.language"; }
		} else {
			$query .= "\n GROUP BY c.id";
		}
		$query .= $order;
	}

	$database->setQuery( $query, '#__', $pageNav->limit, $pageNav->limitstart );
	$rows = $database->loadObjectList();

	if ($ora) {
		if ($rows) {
			foreach ($rows as $row) {
				if (isset($row->checked_out)) { unset($row->checked_out); }
				$row->checked_out = $row->orachecked_out;
				unset($row->orachecked_out);
				if (intval($row->checked_out)) {
					$database->setQuery("SELECT name FROM #__users WHERE id = '".$row->checked_out."'", '#__', 1, 0);
					$row->editor = $database->loadResult();
				} else {
					$row->editor = null;	
				}
			}
		}
	}

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}

	$count = count( $rows );
	//number of Active Items
	for ( $i = 0; $i < $count; $i++ ) {
		$query = "SELECT COUNT(id) FROM #__content WHERE catid = '".$rows[$i]->id."' AND state <> '-2'";
		$database->setQuery( $query );
		$active = $database->loadResult();
		$rows[$i]->active = $active;
	}
	//number of Trashed Items
	for ( $i = 0; $i < $count; $i++ ) {
		$query = "SELECT COUNT(id) FROM #__content WHERE catid = '".$rows[$i]->id."' AND state = '-2'";
		$database->setQuery( $query );
		$trash = $database->loadResult();
		$rows[$i]->trash = $trash;
	}

	//get list of sections for dropdown filter
	$javascript = 'onchange="document.adminForm.submit();"';
	$lists['sectionid']	= mosAdminMenus::SelectSection( 'sectionid', $sectionid, $javascript, 'ordering', $adminLanguage->A_ALL_SECTIONS );

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

	categories_html::show( $rows, $section, $section_name, $pageNav, $lists, $type, $formfilters, $simpleview );
}


/********************************/
/* PREPARE TO ADD/EDIT CATEGORY */
/********************************/
function editCategory( $uid=0, $section='' ) {
	global $database, $my, $adminLanguage;

	$type = mosGetParam( $_REQUEST, 'type', '' );
	$redirect = mosGetParam( $_REQUEST, 'section', 'content' );
	if (is_numeric($redirect) && ($redirect > 0)) { $redirect = 'content'; }

	$row = new mosCategory( $database );
	$row->load( $uid );

	//fail if checked out not by 'me'
	if ($row->checked_out && ($row->checked_out != $my->id)) {
		mosRedirect( 'index2.php?option=categories&section='.$row->section, $adminLanguage->A_CMP_CAT_MESGE." ".$row->title." ".$adminLanguage->A_ISCEDITANADM );
	}

	if ($uid) {
		$row->checkout( $my->id );
		//code for Link Menu
		if ( $row->section > 0 ) {
			$query = "SELECT * FROM #__menu WHERE componentid = '".$row->id."'"
			."\n AND ( type = 'content_archive_category' OR type = 'content_blog_category' OR type = 'content_category' )";
			$database->setQuery( $query );
			$menus = $database->loadObjectList();
			$count = count( $menus );
			for( $i = 0; $i < $count; $i++ ) {
				switch ( $menus[$i]->type ) {
					case 'content_category':
						$menus[$i]->type = $adminLanguage->A_CMP_CAT_TABLE ;
					break;
					case 'content_blog_category':
						$menus[$i]->type = $adminLanguage->A_CMP_CAT_BLOG ;
					break;
					case 'content_archive_category':
						$menus[$i]->type = $adminLanguage->A_CMP_CAT_BLOGAR ;
					break;
                }
			}
		} else {
			$menus = array();
		}
	} else { //new record
		$row->section = $section;
		$row->published = 1;
		$menus = NULL;
	}

	//make order list
	$order = array();
	$database->setQuery( "SELECT COUNT(*) FROM #__categories WHERE section='$row->section'" );
	$max = intval( $database->loadResult() ) + 1;

	for ($i=1; $i < $max; $i++) {
		$order[] = mosHTML::makeOption( $i );
	}

	//build the html select list for sections
	if ( $section == 'content' ) {
		$query = "SELECT id AS value, title AS text FROM #__sections WHERE scope='content' ORDER BY ordering";
		$database->setQuery( $query );
		$sections = $database->loadObjectList();
		$lists['section'] = mosHTML::selectList( $sections, 'section', 'class="selectbox" size="1"', 'value', 'text' );;
	} else {
		if ( $type == 'other' ) {
			$section_name = 'N/A';
		} elseif (is_int($row->section)) {
			$temp = new mosSection( $database );
			$temp->load( $row->section );
			$section_name = $temp->name;
		} else {
			$section_name = $row->section;
		}
		$lists['section'] = '<input type="hidden" name="section" value="'. $row->section .'" />'. $section_name;
	}

	//build the html select list for category types
	$types[] = mosHTML::makeOption( '', $adminLanguage->A_CMP_CAT_SELTYPE );
	if ($row->section == 'com_contact_details') {
		$types[] = mosHTML::makeOption( 'contact_category_table', $adminLanguage->A_MENUS_CCTCATBL );
	} else
	if ($row->section == 'com_newsfeeds') {
		$types[] = mosHTML::makeOption( 'newsfeed_category_table', $adminLanguage->A_MENUS_NFDCATBL );
	} else
	if ($row->section == 'com_weblinks') {
		$types[] = mosHTML::makeOption( 'weblink_category_table', $adminLanguage->A_MENUS_WBLCATBL );
	} else {
		$types[] = mosHTML::makeOption( 'content_category', $adminLanguage->A_MENUS_CNTCNTBL );
		$types[] = mosHTML::makeOption( 'content_blog_category', $adminLanguage->A_MENUS_CNTCTBLG );
		$types[] = mosHTML::makeOption( 'content_archive_category', $adminLanguage->A_MENUS_CNTCTARBLG );
	} // if
	$lists['link_type'] = mosHTML::selectList( $types, 'link_type', 'class="selectbox" size="1"', 'value', 'text' );;

	//build the html select list for ordering
	$query = "SELECT ordering AS value, title AS text FROM #__categories WHERE section = '$row->section' ORDER BY ordering";

	//ordering for new categories
	if (trim($row->ordering) == '') { $row->ordering = '99'; }
	$lists['ordering'] = mosAdminMenus::SpecificOrdering( $row, $uid, $query, '0', $adminLanguage->A_NEW_ITEM_LAST);

	//build the select list for the image positions
	$active =  ( $row->image_position ? $row->image_position : 'left' );
	$lists['image_position'] = mosAdminMenus::Positions( 'image_position', $active, NULL, 0, 0 );
	//Imagelist
	$lists['image'] = mosAdminMenus::Images( 'image', $row->image, NULL, NULL, $adminLanguage->A_SELECT_IMAGE );
	//build the html select list for the group access
	$lists['access'] = mosAdminMenus::Access( $row );
	//build the html radio buttons for published
	$lists['published'] = mosHTML::yesnoRadioList( 'published', 'class="inputbox"', $row->published );
	//build the html select list for menu selection
	$lists['menuselect'] = mosAdminMenus::MenuSelect( );
    //build the html multiple select list for language selection
    $lists['languages']	= mosAdminMenus::SelectLanguages( 'languages', $row->language, $adminLanguage->A_ALL_LANGS );

 	categories_html::edit( $row, $lists, $redirect, $menus );
}


/*****************/
/* SAVE CATEGORY */
/*****************/
function saveCategory( $task ) {
	global $database, $adminLanguage, $mainframe;

	$menu = mosGetParam( $_POST, 'menu', 'mainmenu' );
	$menuid	= mosGetParam( $_POST, 'menuid', 0 );
	$redirect = mosGetParam( $_POST, 'redirect', '' );
	$oldtitle = mosGetParam( $_POST, 'oldtitle', null );

    foreach ($_POST['languages'] as $xlang) {
    	if (trim($xlang) == '') { $newlangs = ''; }
    }
    if (!isset($newlangs)) {
    	$newlangs = implode(',', $_POST['languages']);
    }
    $_POST['language'] = $newlangs;
    
	$row = new mosCategory( $database );
	if (!$row->bind( $_POST )) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
    $seo = new seovs('com_categories', '', $row->seotitle);
    $seo->id = intval($row->id);
    $seo->section = $row->section; //section id (content) or section name (ie com_weblinks)
    $seoval = $seo->validate();
    if (!$seoval) {
    	$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_SEOTITLE.": ".$seo->message."'); window.history.go(-1);</script>"._LEND;
		exit();
    }

	if (!$row->check()) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}

	if (!$row->store()) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}
	$row->checkin();

	$row->updateOrder( "section='$row->section'" );

	if ( $oldtitle ) {
		if ($oldtitle != $row->title) {
			$database->setQuery( "UPDATE #__menu SET name='$row->title' WHERE name='$oldtitle' AND type='content_category'" );
			$database->query();
		}
	}

	// Update Section Count
	if ($row->section != 'com_contact_details' &&
		$row->section != 'com_newsfeeds' &&
        $row->section != 'com_weblinks' && 
        is_integer($row->section)) {
		$query = "UPDATE #__sections SET count=count+1 WHERE id = '$row->section'";
		$database->setQuery( $query );
	}

	if (!$database->query()) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}

	switch ( $task ) {
		case 'go2menu':
			mosRedirect( 'index2.php?option=com_menus&menutype='. $menu );
			break;

		case 'go2menuitem':
			mosRedirect( 'index2.php?option=com_menus&menutype='. $menu .'&task=edit&hidemainmenu=1&id='. $menuid );
			break;

		case 'menulink':
			menuLink( $row->id );
			break;

		case 'apply':
			$msg = $adminLanguage->A_CMP_CAT_CHSAVED;
			mosRedirect( 'index2.php?option=com_categories&section='. $redirect .'&task=editA&hidemainmenu=1&id='. $row->id, $msg );
			break;

			case 'save':
		default:
			$msg = $adminLanguage->A_CMP_CAT_CATSVED;
			mosRedirect( 'index2.php?option=com_categories&section='. $redirect, $msg );
			break;
	}
}


/**
* Deletes one or more categories from the categories table
* @param string The name of the category section
* @param array An array of unique category id numbers
*/
function removeCategories( $section, $cid ) {
	global $database, $adminLanguage;

	if (count( $cid ) < 1) {
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_CMP_CAT_DELETE."'); window.history.go(-1);</script>\n";
		exit();
	}
	$cids = implode( ',', $cid );

	//Get Section ID prior to removing Category, in order to update counts
	//$database->setQuery( "SELECT section FROM #__categories WHERE id IN ($cids)" );
	//$secid = $database->loadResult();

	if (intval( $section ) > 0) {
		$table = 'content';
	} else if (strpos( $section, 'com_' ) === 0) {
		$table = substr( $section, 4 );
	} else {
		$table = $section;
	}

	$query = "SELECT c.id, c.name, COUNT(s.catid) AS numcat FROM #__categories c"
	."\n LEFT JOIN #__".$table." s ON s.catid=c.id"
	."\n WHERE c.id IN ($cids) GROUP BY c.id, c.name";
	$database->setQuery( $query );
	if (!($rows = $database->loadObjectList())) {
    	echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
    	exit();
	}

	$err = array();
	$cid = array();
	foreach ($rows as $row) {
		if ($row->numcat == 0) {
			$cid[] = $row->id;
		} else {
			$err[] = $row->name;
		}
	}

	if (count( $cid )) {
		$cids = implode( ',', $cid );
		$database->setQuery( "DELETE FROM #__categories WHERE id IN ($cids)" );
		if (!$database->query()) {
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
			exit();
        }
	}

	if (count( $err )) {
		$cids = implode( "\', \'", $err );
		$msg = $adminLanguage->A_CMP_CAT_CATEGS.": ". $cids ." ".$adminLanguage->A_CMP_CAT_CANNREM;
		mosRedirect( 'index2.php?option=com_categories&section='. $section, $msg );
	}

	mosRedirect( 'index2.php?option=com_categories&section='. $section );
}

/**
* Publishes or Unpublishes one or more categories
* @param string The name of the category section
* @param integer A unique category id (passed from an edit form)
* @param array An array of unique category id numbers
* @param integer 0 if unpublishing, 1 if publishing
* @param string The name of the current user
*/
function publishCategories( $section, $categoryid=null, $cid=null, $publish=1 ) {
	global $database, $my, $adminLanguage;

	if (!is_array( $cid )) {
		$cid = array();
	}
	if ($categoryid) {
		$cid[] = $categoryid;
	}

	if (count( $cid ) < 1) {
		$action = $publish ? 'publish' : 'unpublish';
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_CMP_CAT_SELECT." ".$action."'); window.history.go(-1);</script>\n";
		exit();
	}

	$cids = implode( ',', $cid );

	$query = "UPDATE #__categories SET published='".$publish."'"
	."\n WHERE id IN (".$cids.") AND (checked_out=0 OR (checked_out='".$my->id."'))";
	$database->setQuery( $query );
	if (!$database->query()) {
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosCategory( $database );
		$row->checkin( $cid[0] );
	}

	mosRedirect( 'index2.php?option=com_categories&section='. $section );
}


/*******************************************/
/* PUBLISH / UNPUBLISH CATEGORY USING AJAX */
/*******************************************/
function ajaxpublishCat() {
    global $database, $my, $adminLanguage;

    $elem = intval(mosGetParam($_REQUEST, 'elem', 0));
    $id = intval(mosGetParam($_REQUEST, 'id', 0));
    $state = intval(mosGetParam($_REQUEST, 'state', 0));

    if (!$id) {
        echo '<img src="../includes/js/ThemeOffice/warning.png" width="16" height="16" border="0" title="'.$adminLanguage->A_ERROR.': Invalid Category id" />'._LEND;
        exit();
    }

    $error = 0;
	$database->setQuery( "UPDATE #__categories SET published='$state' WHERE id='$id' AND (checked_out=0 OR (checked_out='".$my->id."'))");
	if (!$database->query()) { $error = 1; }

    if ($error) { $state = $state ? 0 : 1; }
    $img = $state ? 'publish_g.png' : 'publish_x.png';
    $alt = $state ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
?>
	<a href="javascript:void(0);" 
    onclick="changeCategoryState('<?php echo $elem; ?>', '<?php echo $id; ?>', '<?php echo ($state) ? 0 : 1; ?>');" title="<?php echo $alt; ?>">
	<img src="images/<?php echo $img; ?>" border="0" alt="<?php echo $alt; ?>" /></a>
<?php 
    exit();
}


/************************/
/* CANCEL EDIT CATEGORY */
/************************/
function cancelCategory() {
	global $database;

	$redirect = mosGetParam( $_POST, 'redirect', '' );

	$row = new mosCategory( $database );
	$row->bind( $_POST );
	$row->checkin();
	mosRedirect( 'index2.php?option=com_categories&section='.$redirect );
}

/**
* Moves the order of a record
* @param integer The increment to reorder by
*/
function orderCategory( $uid, $inc ) {
	global $database;

	$row = new mosCategory( $database );
	$row->load( $uid );
	$row->move( $inc, "section='$row->section'" );
	mosRedirect( 'index2.php?option=com_categories&section='. $row->section );
}


/********************************************/
/* PREPARE TO SELECT CATEGORIES TO BE MOVED */
/********************************************/
function moveCategorySelect( $option, $cid, $sectionOld ) {
	global $database, $adminLanguage;
	$redirect = mosGetParam( $_POST, 'section', 'content' );;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_SELITEMMOV."'); window.history.go(-1);</script>\n";
		exit();
	}

	//query to list selected categories
	$cids = implode( ',', $cid );
	$query = "SELECT a.name, a.section FROM #__categories a WHERE a.id IN ( ". $cids ." )";
	$database->setQuery( $query );
	$items = $database->loadObjectList();

	//query to list items from categories
	$query = "SELECT a.title FROM #__content a WHERE a.catid IN ( ". $cids ." ) ORDER BY a.catid, a.title";
	$database->setQuery( $query );
	$contents = $database->loadObjectList();

	//query to choose section to move to
	$query = "SELECT a.name AS text, a.id AS value FROM #__sections a WHERE a.published = '1' ORDER BY a.name";
	$database->setQuery( $query );
	$sections = $database->loadObjectList();

	//build the html select list
	$SectionList = mosHTML::selectList( $sections, 'sectionmove', 'class="inputbox" size="10"', 'value', 'text', null );

	categories_html::moveCategorySelect( $option, $cid, $SectionList, $items, $sectionOld, $contents, $redirect );
}


/*************************/
/* SAVE MOVED CATEGORIES */
/*************************/
function moveCategorySave( $cid, $sectionOld ) {
	global $database, $adminLanguage, $mainframe;

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
	$sectionMove = mosGetParam( $_REQUEST, 'sectionmove', '' );
	$cids = implode( ',', $cid );
	$total = count( $cid );

    $database->setQuery("SELECT id, seotitle FROM #__categories WHERE id IN (".$cids.")");
    $rows = $database->loadRowList();

    for ($i=0; $i<count($rows); $i++) {
        $row = $rows[$i];
        $id = $row['id'];
        $seotitle = $row['seotitle'];

        $seo = new seovs('com_categories', '', $seotitle);
        $seo->id = $id;
        $seo->section = $sectionMove;
        $seoval = $seo->validate();
        if (!$seoval) {
            $random = rand(1000, 9999);
            $seotitle = $seotitle.'-'.$random;
        }

        $query = "UPDATE #__categories SET section = '".$sectionMove."', seotitle='".$seotitle."' WHERE id='$id'";
        $database->setQuery( $query );
        if (!$database->query()) {
            echo "<script type=\"text/javascript\">alert('". $database->getErrorMsg() ."'); window.history.go(-1);</script>\n";
            exit();
        }
    }

	$query = "UPDATE #__content SET sectionid = '".$sectionMove."' WHERE catid IN ( ".$cids." )";
	$database->setQuery( $query );
	if ( !$database->query() ) {
		echo "<script type=\"text/javascript\">alert('". $database->getErrorMsg() ."'); window.history.go(-1);</script>\n";
		exit();
	}
	$sectionNew = new mosSection ( $database );
	$sectionNew->load( $sectionMove );

	$msg = $total.' '.$adminLanguage->A_CMP_CAT_MOVEDTO.' '.$sectionNew->name;
	mosRedirect( 'index2.php?option=com_categories&section='.$sectionOld, $msg );
}


/*********************************************/
/* PREPARE TO SELECT CATEGORIES TO BE COPIED */
/*********************************************/
function copyCategorySelect( $option, $cid, $sectionOld ) {
	global $database, $adminLanguage;

	$redirect = mosGetParam( $_POST, 'section', 'content' );;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_SELITEMMOV."'); window.history.go(-1);</script>\n";
		exit();
	}

	//query to list selected categories
	$cids = implode( ',', $cid );
	$query = "SELECT a.name, a.section FROM #__categories a WHERE a.id IN ( ". $cids ." )";
	$database->setQuery( $query );
	$items = $database->loadObjectList();

	//query to list items from categories
	$query = "SELECT a.title, a.id FROM #__content a WHERE a.catid IN ( ". $cids ." ) ORDER BY a.catid, a.title";
	$database->setQuery( $query );
	$contents = $database->loadObjectList();

	//query to choose section to move to
	$query = "SELECT a.name AS text, a.id AS value FROM #__sections a WHERE a.published = '1' ORDER BY a.name";
	$database->setQuery( $query );
	$sections = $database->loadObjectList();

	//build the html select list
	$SectionList = mosHTML::selectList( $sections, 'sectionmove', 'class="selectbox" size="10"', 'value', 'text', null );

	categories_html::copyCategorySelect( $option, $cid, $SectionList, $items, $sectionOld, $contents, $redirect );
}


/************************/
/* SAVE COPIED CATEGORY */
/************************/
function copyCategorySave( $cid, $sectionOld ) {
	global $database, $adminLanguage, $mainframe;

	$sectionMove = mosGetParam( $_REQUEST, 'sectionmove', '' );
	$contentid = mosGetParam( $_REQUEST, 'item', '' );
	$total = count( $contentid  );

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');

	$category = new mosCategory ( $database );
	foreach( $cid as $id ) {
		$category->load( $id );
		$category->id = NULL;
		$category->title = $adminLanguage->A_CMP_CAT_COPYOF.' '.$category->title;
		$category->name = $adminLanguage->A_CMP_CAT_COPYOF.' '.$category->name;
		$category->section = $sectionMove;

        $seo = new seovs('com_categories', '', $category->seotitle);
        $seo->id = intval($category->id);
        $seo->section = $sectionMove;
        $seoval = $seo->validate();
        if (!$seoval) {
            $random = rand(1000, 9999);
            $category->seotitle = $category->seotitle.'-'.$random;
        }

		if (!$category->check()) {
			echo "<script type=\"text/javascript\">alert('".$category->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}

		if (!$category->store()) {
			echo "<script type=\"text/javascript\">alert('".$category->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}
		$category->checkin();
		//stores original catid
		$newcatids[]["old"] = $id;
		//pulls new catid
		$newcatids[]["new"] = $category->id;
	}

	$content = new mosContent ( $database );
	foreach( $contentid as $id) {
		$content->load( $id );
		$content->id = NULL;
		$content->sectionid = $sectionMove;
		$content->hits = 0;
		foreach( $newcatids as $newcatid ) {
			if ( $content->catid == $newcatid["old"] ) {
				$content->catid = $newcatid["new"];
			}
		}
		if (!$content->check()) {
			echo "<script type=\"text/javascript\">alert('".$content->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}

		if (!$content->store()) {
			echo "<script type=\"text/javascript\">alert('".$content->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}
		$content->checkin();
	}

	$sectionNew = new mosSection ( $database );
	$sectionNew->load( $sectionMove );

	$msg = $total.' '.$adminLanguage->A_CMP_CAT_COPDTO.' '.$sectionNew->name;
	mosRedirect( 'index2.php?option=com_categories&section='. $sectionOld, $msg );
}

/**
* changes the access level of a record
* @param integer The increment to reorder by
*/
function accessMenu( $uid, $access, $section ) {
	global $database;

	$row = new mosCategory( $database );
	$row->load( $uid );
	$row->access = $access;

	if ( !$row->check() ) {
		return $row->getError();
	}
	if ( !$row->store() ) {
		return $row->getError();
	}

	mosRedirect( 'index2.php?option=com_categories&section='. $section );
}

function menuLink( $id ) {
	global $database, $adminLanguage;

	$category = new mosCategory( $database );
	$category->bind( $_POST );
	$category->checkin();

	$redirect	= mosGetParam( $_POST, 'redirect', '' );
	$menu 		= mosGetParam( $_POST, 'menuselect', '' );
	$name 		= mosGetParam( $_POST, 'link_name', '' );
	$sectionid	= mosGetParam( $_POST, 'sectionid', '' );
	$type 		= mosGetParam( $_POST, 'link_type', '' );

	switch ( $type ) {
		case 'content_category':
			$link 		= 'index.php?option=com_content&task=category&sectionid='.$sectionid .'&id='. $id;
			$menutype	= $adminLanguage->A_MENUS_CNTCNTBL;
			break;

		case 'content_blog_category':
			$link 		= 'index.php?option=com_content&task=blogcategory&id='.$id;
			$menutype	= $adminLanguage->A_MENUS_CNTCTBLG;
			break;

		case 'content_archive_category':
			$link 		= 'index.php?option=com_content&task=archivecategory&id='.$id;
			$menutype	= $adminLanguage->A_MENUS_CNTCTARBLG;
			break;

		case 'contact_category_table':
			$link 		= 'index.php?option=com_contact&catid='.$id;
			$menutype	= $adminLanguage->A_MENUS_CCTCATBL;
			break;

		case 'newsfeed_category_table':
			$link 		= 'index.php?option=com_newsfeeds&catid='.$id;
			$menutype	= $adminLanguage->A_MENUS_NFDCATBL;
			break;

		case 'weblink_category_table':
			$link 		= 'index.php?option=com_weblinks&catid='.$id;
			$menutype	= $adminLanguage->A_MENUS_WBLCATBL;
			break;

		default:;
	}

	$row 				= new mosMenu( $database );
	$row->menutype 		= $menu;
	$row->name 			= $name;
	$row->type 			= $type;
	$row->published		= 1;
	$row->componentid	= $id;
	$row->link			= $link;
	$row->ordering		= 9999;

	if (!$row->check()) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}
	if (!$row->store()) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}
	$row->checkin();
	$row->updateOrder( "menutype='". $menu ."'" );

	$msg = $name .' ( '. $menutype .' ) '.$adminLanguage->A_CMP_SEC_INMENU.': '. $menu .' '.$adminLanguage->A_CMP_CNT_SUCCSS;
	mosRedirect( 'index2.php?option=com_categories&section='. $redirect .'&task=editA&hidemainmenu=1&id='. $id, $msg );
}

function saveOrder( &$cid, $section ) {
	global $database, $adminLanguage;

	$total		= count( $cid );
	$order 		= mosGetParam( $_POST, 'order', array(0) );
	$conditions = array();

    //update ordering values
	for($i=0; $i < $total; $i++) {
		$database->setQuery("SELECT id, ordering, section FROM #__categories WHERE id='".$cid[$i]."'", '#__', 1, 0);
		$row = $database->loadRow(); 
		if ($row && ($row['ordering'] != $order[$i])) {
			$database->setQuery("UPDATE #__categories SET ordering='".intval($order[$i])."' WHERE id=".$row['id']);
			$database->query();
	        //remember to updateOrder this group
	        $condition = "section='".$row['section']."'";
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
			$row = new mosCategory( $database );
			$row->load( $cond[0] );
			$row->updateOrder( $cond[1] );
			unset($row);
		}
	}

	$msg = $adminLanguage->A_NEWORDERSAVED;
	mosRedirect( 'index2.php?option=com_categories&section='.$section, $msg );
}


/**********************/
/* VALIDATE SEO TITLE */
/**********************/
function validateSEO() {
    global $mainframe, $adminLanguage;

    $coid = intval(mosGetParam($_POST, 'coid', 0));
    $cosec = trim(mosGetParam($_POST, 'cosec', ''));
    if ($cosec == '') {
        echo $adminLanguage->A_INVALID.' '.$adminLanguage->A_SECTION;
        exit();
    }
    $seotitle = eUTF::utf8_trim(mosGetParam($_POST, 'seotitle', ''));

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
    $seo = new seovs('com_categories', '', $seotitle);
    $seo->id = $coid;
    $seo->section = $cosec; //section id (content) or section name (ie com_weblinks)
    $seo->validate();
    echo $seo->message;
    exit();
}


/*********************/
/* SUGGEST SEO TITLE */
/*********************/
function suggestSEO() {
    global $mainframe;

    $coid = intval(mosGetParam($_POST, 'coid', 0));
    $cosec = trim(mosGetParam($_POST, 'cosec', ''));
    $cotitle = mosGetParam($_POST, 'cotitle', '');

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
    $seo = new seovs('com_categories', $cotitle);
    $seo->id = $coid;
    $seo->section = $cosec;
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