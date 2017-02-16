<?php 
/**
* @version: $Id: admin.content.php 42 2010-06-08 15:17:42Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Content
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//ensure user has access to this function
if (!($acl->acl_check( 'action', 'edit', 'users', $my->usertype, 'content', 'all' ) 
    || $acl->acl_check( 'action', 'add', 'users', $my->usertype, 'content', 'all' ))) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );

$sectionid = mosGetParam( $_REQUEST, 'sectionid', 0 );
$id = mosGetParam($_REQUEST, 'id', '');
$cid = mosGetParam( $_POST, 'cid', array(0) );
if (!is_array( $cid )) {
	$cid = array(0);
}

switch ($task) {
	case 'clean_cache':
		mosCache::cleanCache( 'com_content' );
		mosRedirect( 'index2.php', $adminLanguage->A_CMP_CNT_CCHECL );
	break;
	case 'new':
		editContent( 0, $sectionid, $option );
	break;
	case 'edit':
		editContent( $id, $sectionid, $option );
	break;
	case 'editA':
		editContent( $cid[0], '', $option );
	break;
	case 'go2menu':
	case 'go2menuitem':
	case 'resethits':
	case 'menulink':
	case 'apply':
	case 'save':
	case 'applysub':
	case 'savesub':	
		mosCache::cleanCache( 'com_content' );
		saveContent( $sectionid, $task );
	break;
	case 'remove':
		removeContent( $cid, $sectionid, $option );
	break;
	case 'removesub':
		removeSubContent( $cid );
	break;
	case 'publish':
		changeContent( $cid, 1, $option );
	break;
	case 'unpublish':
		changeContent( $cid, 0, $option );
	break;
	case 'archive':
		changeContent( $cid, -1, $option );
	break;
	case 'unarchive':
		changeContent( $cid, 0, $option );
    break;
	case 'ajaxpub':
        ajaxchangeContent();
    break;
	case 'toggle_frontpage':
		toggleFrontPage( $cid, $sectionid, $option );
	break;
	case 'ajaxfront':
	   ajaxToggleFront();
	break;
	case 'cancel':
		cancelContent();
	break;
	case 'cancelsub':
		cancelSubContent();
	break;
	case 'orderup':
		orderContent( $cid[0], -1, $option );
	break;
	case 'orderdown':
		orderContent( $cid[0], 1, $option );
	break;
	case 'showarchive':
		viewArchive( $sectionid, $option );
	break;
	case 'movesect':
		moveSection( $cid, $sectionid, $option );
	break;
	case 'movesectsave':
		moveSectionSave( $cid, $sectionid, $option );
	break;
	case 'copy':
		copyItem( $cid, $sectionid, $option );
	break;
	case 'copysave':
		copyItemSave( $cid, $sectionid, $option );
	break;
    case 'setaccess':
        $access = mosGetParam( $_REQUEST, 'access', 29 );
        $sid = mosGetParam( $_REQUEST, 'sid', $cid[0] );
		accessMenu( $sid, $access, $option );
	break;
	case 'saveorder':
		saveOrder( $cid );
	break;
	case 'tree':
		viewTree( $option );
	break;
	case 'edittree':
		editTree();
	break;
	case 'translate':
		translateItem( $cid[0], $option );
	break;
    case 'dotranslate':
    	$id = (int)mosGetParam($_POST, 'id', 0);
		dotranslateItem($id, $option);
	break;
	case 'subcontent':
	   submittedContent();
	break;
	case 'editsub':
		editSubContent( $cid[0] );
	break;
	case 'validate':
        validateSEO();
	break;
	case 'suggest':
	   suggestSEO();
	break;
	default:
		viewContent( $sectionid, $option );
	break;
}


/*********************************/
/* PREPARE TO SHOW CONTENT ITEMS */
/*********************************/
function viewContent( $sectionid, $option ) {
	global $database, $mainframe, $mosConfig_list_limit, $adminLanguage, $mosConfig_pub_langs;

	$catid 				= $mainframe->getUserStateFromRequest( "catid{$option}{$sectionid}", 'catid', 0 );
	$filter_authorid 	= $mainframe->getUserStateFromRequest( "filter_authorid{$option}{$sectionid}", 'filter_authorid', 0 );
	$filter_sectionid 	= $mainframe->getUserStateFromRequest( "filter_sectionid{$option}{$sectionid}", 'filter_sectionid', 0 );
	$limit 				= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart 		= $mainframe->getUserStateFromRequest( "view{$option}{$sectionid}limitstart", 'limitstart', 0 );
	$search 			= $mainframe->getUserStateFromRequest( "search{$option}{$sectionid}", 'search', '' );
	$search 			= $database->getEscaped( eUTF::utf8_trim( eUTF::utf8_strtolower( $search ) ) );
	$redirect 			= $sectionid;
	$filter 			= ''; //getting a undefined variable error
    $filter_lang = trim( strtolower(mosGetParam( $_REQUEST, 'filter_lang', '' )));
    $filter_pub = intval(mosGetParam( $_REQUEST, 'filter_pub', -3 ));

    //in order to work 'filtered by' icons with register_globals off
    $formfilters = array(
        'catid' => $catid,
        'filter_authorid' => $filter_authorid,
        'filter_sectionid' => $filter_sectionid,
        'filter_lang' => $filter_lang,
        'filter_pub' => $filter_pub
    );

	$pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;
	$ora = (in_array($database->_resource->databaseType, array ('oci8', 'oci805', 'oci8po', 'oracle'))) ? 1 : 0;

	if ( $sectionid == 0 ) {
		//used to show All content items
		if ($pg) {
			$where = array("c.state >= 0", "c.catid=cc.id", "cc.section=s.id::VARCHAR", "s.scope='content'");
		} else if ($ora) {
			$where = array("c.state >= 0", "c.catid=cc.id", "cc.section=TO_CHAR(s.id)", "s.scope='content'");
		} else {
			$where = array("c.state >= 0", "c.catid=cc.id", "cc.section=s.id", "s.scope='content'");
		}
		$order = "\n ORDER BY s.title, c.catid, cc.ordering, cc.title, c.ordering";
		$all = 1;
		if ($filter_sectionid > 0) {
		    $filter = "\n WHERE cc.section=$filter_sectionid";
		}
		$section = new stdClass();
		$section->title = $adminLanguage->A_ALLCONTENTITEMS;
		$section->id = 0;
	} else {
		if ($pg) {
			$where = array("c.state >= 0", "c.catid=cc.id", "cc.section=s.id::VARCHAR", "s.scope='content'", "c.sectionid='$sectionid'");
		} else if ($ora) {
			$where = array("c.state >= 0", "c.catid=cc.id", "cc.section=TO_CHAR(s.id)", "s.scope='content'", "c.sectionid='$sectionid'");
		} else {
			$where = array("c.state >= 0", "c.catid=cc.id", "cc.section=s.id", "s.scope='content'", "c.sectionid='$sectionid'");
		}
		$order = "\n ORDER BY cc.ordering, cc.title, c.ordering";
		$all = NULL;
		if ($pg) {
			$filter = "\n WHERE cc.section = '".$sectionid."::VARCHAR'";
		} else if ($ora) {
			$filter = "\n WHERE cc.section = TO_CHAR(".$sectionid.")";
		} else {
			$filter = "\n WHERE cc.section = '$sectionid'";
		}
		$section = new mosSection( $database );
		$section->load( $sectionid );
	}

	//used by filter
	if ( $filter_pub > -3 ) {
		$where[] = "c.state = '$filter_pub'";
	}
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
	if ( $search ) {
		$where[] = "LOWER( c.title ) LIKE '%$search%'";
	}

	//get the total number of records
	$database->setQuery( "SELECT count(*) FROM #__content c, #__categories cc, #__sections s"
	. (count( $where ) ? "\nWHERE " . implode( ' AND ', $where ) : "")
	);
	$total = $database->loadResult();
	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

   	$query = "SELECT c.*, g.name AS groupname, cc.name, cc.language AS category_lang, u.name AS editor,"
	."\n f.content_id AS frontpage, s.title AS section_name, v.name AS author FROM #__categories cc, #__sections s, #__content c"
	. "\n LEFT JOIN #__core_acl_aro_groups g ON g.group_id = c.access"
	. "\n LEFT JOIN #__users u ON u.id = c.checked_out"
	. "\n LEFT JOIN #__users v ON v.id = c.created_by"
	. "\n LEFT JOIN #__content_frontpage f ON f.content_id = c.id"
	. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' )
    .$order;

	$database->setQuery( $query, '#__', $pageNav->limit, $pageNav->limitstart );
	$rows = $database->loadObjectList();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	//get list of categories for dropdown filter
	$query = "SELECT cc.id AS value, cc.title AS text, cc.section FROM #__categories cc";
	if ($pg) {
		$query .= "\n INNER JOIN #__sections s ON s.id::VARCHAR=cc.section";
	} else if ($ora) {
		$query .= "\n INNER JOIN #__sections s ON TO_CHAR(s.id)=cc.section";
	} else {
		$query .= "\n INNER JOIN #__sections s ON s.id=cc.section";
	}
	$query .= $filter
	."\n ORDER BY s.ordering, cc.ordering";
	$lists['catid'] = filterCategory( $query, $catid );

	//get list of sections for dropdown filter
	$javascript = 'onchange="document.adminForm.submit();"';
	$lists['sectionid']	= mosAdminMenus::SelectSection( 'filter_sectionid', $filter_sectionid, $javascript, 'ordering', $adminLanguage->A_ALL_SECTIONS );

	//get list of Authors for dropdown filter
	$query = "SELECT c.created_by AS value, u.name AS text FROM #__content c"
	. "\n INNER JOIN #__sections s ON s.id = c.sectionid"
	. "\n LEFT JOIN #__users u ON u.id = c.created_by"
	. "\n WHERE c.state <> '-1'"
	. "\n AND c.state <> '-2'"
	. "\n GROUP BY c.created_by, u.name"
	. "\n ORDER BY u.name";

	$authors[] = mosHTML::makeOption( '0', $adminLanguage->A_ALL_AUTHORS );

	$database->setQuery( $query );
    $authors = array_merge( $authors, $database->loadObjectList() );
	$lists['authorid']	= mosHTML::selectList( $authors, 'filter_authorid', 'class="selectbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_authorid );

    // get list of enabled languages for dropdown filter
    $plangs[] = mosHTML::makeOption( '',$adminLanguage->A_ALL_LANGS );
    $publs = explode(',', $mosConfig_pub_langs);
    foreach ($publs as $publ) {
        $plangs[] = mosHTML::makeOption( $publ, $publ );
    }
	$lists['flangs'] = mosHTML::selectList( $plangs, 'filter_lang', 'class="selectbox" size="1" dir="ltr" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_lang );

	//get list of publish status for dropdown filter
	$published[] = mosHTML::makeOption( '-3', $adminLanguage->A_ALL );
	$published[] = mosHTML::makeOption( '0', $adminLanguage->A_UNPUBLISHED );
	$published[] = mosHTML::makeOption( '1', $adminLanguage->A_PUBLISHED );
	$lists['pubstatus'] = mosHTML::selectList( $published, 'filter_pub', 'class="selectbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_pub );

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

	HTML_content::showContent( $rows, $section, $lists, $search, $pageNav, $all, $redirect, $formfilters, $simpleview );
}


/**********************************/
/* PREPARE TO SHOW ARCHIVED ITEMS */
/**********************************/
function viewArchive( $sectionid, $option ) {
	global $database, $mainframe, $mosConfig_list_limit, $mosConfig_pub_langs, $adminLanguage;

	$catid 				= $mainframe->getUserStateFromRequest( "catidarc{$option}{$sectionid}", 'catid', 0 );
	$limit 				= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart 		= $mainframe->getUserStateFromRequest( "viewarc{$option}{$sectionid}limitstart", 'limitstart', 0 );
	$filter_authorid 	= $mainframe->getUserStateFromRequest( "filter_authorid{$option}{$sectionid}", 'filter_authorid', 0 );
	$filter_sectionid 	= $mainframe->getUserStateFromRequest( "filter_sectionid{$option}{$sectionid}", 'filter_sectionid', 0 );
	$search 			= $mainframe->getUserStateFromRequest( "searcharc{$option}{$sectionid}", 'search', '' );
	$search 			= $database->getEscaped( eUTF::utf8_trim( eUTF::utf8_strtolower( $search ) ) );
	$redirect 			= $sectionid;
    $filter_lang = trim( strtolower(mosGetParam( $_REQUEST, 'filter_lang', '' )));

    //in order to work 'filtered by' icons with register_globals off
    $formfilters = array(
        'catid' => $catid,
        'filter_authorid' => $filter_authorid,
        'filter_lang' => $filter_lang
    );

	$pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;
	$ora = (in_array($database->_resource->databaseType, array ('oci8', 'oci805', 'oci8po', 'oracle'))) ? 1 : 0;

	if ( $sectionid == 0 ) {
		if ($pg) {
			$where = array("c.state = -1", "c.catid=cc.id", "cc.section=s.id::VARCHAR", "s.scope='content'");
			$filter = "\n , #__sections s WHERE s.id::VARCHAR = c.section";
		} else if ($ora) {
			$where = array("c.state = -1", "c.catid=cc.id", "cc.section=TO_CHAR(s.id)", "s.scope='content'");
			$filter = "\n , #__sections s WHERE TO_CHAR(s.id) = c.section";
		} else {
			$where = array("c.state = -1", "c.catid=cc.id", "cc.section=s.id", "s.scope='content'");
			$filter = "\n , #__sections s WHERE s.id = c.section";
		}
		$all = 1;
	} else {
		if ($pg) {
			$where = array("c.state = -1", "c.catid=cc.id", "cc.section=s.id::VARCHAR", "s.scope='content'", "c.sectionid='$sectionid'");
		} else if ($ora) {
			$where = array("c.state = -1", "c.catid=cc.id", "cc.section=TO_CHAR(s.id)", "s.scope='content'", "c.sectionid='$sectionid'");
		} else {
			$where = array("c.state = -1", "c.catid=cc.id", "cc.section=s.id", "s.scope='content'", "c.sectionid='$sectionid'");
		}
		$filter = "\n WHERE section = '$sectionid'";
		$all = NULL;
	}

	// used by filter
	if ( $filter_sectionid > 0 ) {
		$where[] = "c.sectionid = '$filter_sectionid'";
	}
	if ( $filter_authorid > 0 ) {
		$where[] = "c.created_by = '$filter_authorid'";
	}
	if ($catid > 0) {
		$where[] = "c.catid='$catid'";
	}
    if ( $filter_lang != '' ) {
		$where[] = "((c.language LIKE '%$filter_lang%') OR (c.language IS NULL))";
	}
	if ($search) {
		$where[] = "LOWER(c.title) LIKE '%$search%'";
	}

	//get the total number of records
	$query = "SELECT COUNT(*)"
	. "FROM #__content c, #__categories cc, #__sections s"
	. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' )
	;
	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$query = "SELECT c.*, g.name AS groupname, cc.name, cc.language AS category_lang, v.name AS author FROM #__categories cc, #__sections s, #__content c"
	."\n LEFT JOIN #__core_acl_aro_groups g ON g.group_id = c.access"
	."\n LEFT JOIN #__users v ON v.id = c.created_by"
	.( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' )
	."\n ORDER BY c.catid, c.ordering";

	$database->setQuery( $query, '#__', $pageNav->limit, $pageNav->limitstart );
	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return;
	}

	//get list of categories for dropdown filter
	$query = "SELECT c.id AS value, c.title AS text FROM #__categories c"
	.$filter
	."\n ORDER BY c.ordering";
	$lists['catid'] = filterCategory( $query, $catid );

	//get list of sections for dropdown filter
	$javascript = 'onchange="document.adminForm.submit();"';
	$lists['sectionid']	= mosAdminMenus::SelectSection( 'filter_sectionid', $filter_sectionid, $javascript, 'ordering', $adminLanguage->A_ALL_SECTIONS );

	$section = new mosSection( $database );
	$section->load( $sectionid );

	//get list of Authors for dropdown filter
	$query = "SELECT c.created_by AS value, u.name AS text FROM #__content c";
	if ($pg) {
		$query .= "\n INNER JOIN #__sections s ON s.id::VARCHAR = c.sectionid::VARCHAR";
	} else {
		$query .= "\n INNER JOIN #__sections s ON s.id = c.sectionid";
	}
	$query .= "\n LEFT JOIN #__users u ON u.id = c.created_by"
	."\n WHERE c.state = '-1'"
	."\n GROUP BY c.created_by, u.name"
	."\n ORDER BY u.name";
	$authors[] = mosHTML::makeOption( '0', $adminLanguage->A_ALL_AUTHORS );
	$database->setQuery( $query );
	$authors = array_merge( $authors, $database->loadObjectList() );
	$lists['authorid']	= mosHTML::selectList( $authors, 'filter_authorid', 'class="selectbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_authorid );

    // get list of enabled languages for dropdown filter
    $plangs[] = mosHTML::makeOption( '', $adminLanguage->A_ALL_LANGS );
    $publs = explode(',', $mosConfig_pub_langs);
    foreach ($publs as $publ) {
        $plangs[] = mosHTML::makeOption( $publ, $publ );
    }
	$lists['flangs'] = mosHTML::selectList( $plangs, 'filter_lang', 'class="selectbox" size="1" dir="ltr" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_lang );

	HTML_content::showArchive( $rows, $section, $lists, $search, $pageNav, $option, $all, $redirect, $formfilters );
}


/********************************************/
/* PREPARE TO DISPLAY CONTENT LANGUAGE TREE */
/********************************************/
function viewTree( $option ) {
	global $database, $mosConfig_pub_langs, $adminLanguage;

    $filter_lang = trim( strtolower(mosGetParam( $_REQUEST, 'filter_lang', '' )));
    $pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;
	$ora = (in_array($database->_resource->databaseType, array ('oci8', 'oci805', 'oci8po', 'oracle'))) ? 1 : 0;

	//used to show All content items
	if ($pg) {
		$where = array("c.catid=cc.id", "cc.section=s.id::VARCHAR", "s.scope='content'");
	} else if ($ora) {
		$where = array("c.catid=cc.id", "cc.section=TO_CHAR(s.id)", "s.scope='content'");
	} else {
		$where = array("c.catid=cc.id", "cc.section=s.id", "s.scope='content'");
	}
	$order = "\n ORDER BY s.title, c.catid, cc.ordering, cc.title, c.ordering";

	//used by filter
	if ( $filter_lang != '' ) {
		$where[] = "((s.language IS NULL) OR (s.language LIKE '%$filter_lang%'))";
 		$where[] = "((cc.language IS NULL) OR (cc.language LIKE '%$filter_lang%'))";
  		$where[] = "((c.language IS NULL) OR (c.language LIKE '%$filter_lang%'))";
	}

   	$query = "SELECT c.*, cc.id AS cat_id, cc.title AS cat_title, cc.language AS cat_lang, cc.published AS cat_pub,"
	. "\n s.id AS sec_id, s.title AS sec_title, s.language AS sec_lang, s.published AS sec_pub"
	. "\n FROM #__categories cc, #__sections s, #__content c"
	. ( count( $where ) ? "\nWHERE " . implode( ' AND ', $where ) : '' )
    .$order;

	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

    //get list of enabled languages for dropdown filter
    $plangs[] = mosHTML::makeOption( '',$adminLanguage->A_ALL_LANGS );
    $publs = explode(',', $mosConfig_pub_langs);
    foreach ($publs as $publ) {
        $plangs[] = mosHTML::makeOption( $publ, $publ );
    }
	$lists['flangs'] = mosHTML::selectList( $plangs, 'filter_lang', 'class="selectbox" size="1" dir="ltr" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_lang );

	HTML_content::showTree( $rows, $filter_lang, $lists );
}


/*************************/
/* EDIT TREE ITEM (AJAX) */
/*************************/
function editTree() {
	global $database, $my, $adminLanguage;

    if(isset($_GET['itype']) && isset($_GET['updateNode']) && isset($_GET['newValue'])){

		$itype = mosGetParam( $_GET, 'itype', '' );
		$updateNode = intval( mosGetParam( $_GET, 'updateNode', '' ));
        $newValue = eUTF::utf8_trim( mosGetParam( $_GET, 'newValue', '' ));
        $newValue = eUTF::utf8_rtrim($newValue);

        if (trim($newValue == '')) { $errTree = $adminLanguage->A_CMP_CNT_NULLVAL; }

        switch ($itype) {
            case 'section':
            $query = "UPDATE #__sections";
            break;
            case 'category':
            $query = "UPDATE #__categories";
            break;
            case 'item':
            $query = "UPDATE #__content";
            break;
            default:
            $errTree = $adminLanguage->A_CMP_CNT_INCCTP;
            break;
        }

    } else { $errTree = $adminLanguage->A_CMP_CNT_CLDNFETCH; }

    if (!isset($errTree)) {
        $query .= " SET title = '".$newValue."' WHERE id = '".$updateNode."'";
        $query .= " AND ((checked_out=0) OR (checked_out='".$my->id."'))";

        $database->setQuery( $query );
        if (!$database->query()) {
            $errTree = $database->getErrorMsg();
        }
    }
    echo '<div class=\'ajaxbox\'>';
    echo '<b>' . $adminLanguage->A_CMP_CNT_MFS . '</b><br>';
    if (!isset($errTree)) {
        
        switch ($itype) {
            case 'category':
            $langtype = $adminLanguage->A_CATEGORY;
            break;
            case 'section':
            $langtype = $adminLanguage->A_SECTION;
            break;
            default:
            case 'item':
            $langtype = $adminLanguage->A_CMP_CNT_CONTITEM;
            break;        
        }

        echo $langtype.' ' . $adminLanguage->A_CMP_CNT_WID .' '.$updateNode;
        echo ' ' . $adminLanguage->A_CMP_CNT_RNMTO . ': '.$newValue;
    } else { echo '<span style="font-weight: bold; color: #ff0000;">' .$adminLanguage->A_ERROR . ':</span> '.$errTree; }
    echo '</div>';
}


/********************************/
/* PREPARE TO EDIT CONTENT ITEM */
/********************************/
function editContent( $uid=0, $sectionid=0, $option ) {
	global $database, $my, $mainframe, $adminLanguage, $acl;

	$redirect = mosGetParam( $_POST, 'redirect', '' );
	if ( !$redirect ) {
		$redirect = $sectionid;
	}

	//load the row from the db table
	$row = new mosContent( $database );
	$row->load( $uid );

	if ($uid) {
		$sectionid = $row->sectionid;
		if ($row->state < 0) {
			mosRedirect( 'index2.php?option=com_content&sectionid='. $row->sectionid, $adminLanguage->A_CMP_CNT_CANNOT );
		}
	}

	$caneditall = $acl->acl_check('action', 'edit', 'users', $my->usertype, 'content', 'all');
	$caneditown = $acl->acl_check('action', 'edit', 'users', $my->usertype, 'content', 'own');
	$canaddall = $acl->acl_check('action', 'add', 'users', $my->usertype, 'content', 'all');
	if ($uid) {
		if (!$caneditall) {
			if (!$caneditown) {
				mosRedirect('index2.php?option=com_content&sectionid='.$row->sectionid, 'You dont have permission to edit content items!');
			} else if ($caneditown && ($my->id != $row->created_by)) {
				mosRedirect('index2.php?option=com_content&sectionid='.$row->sectionid, 'You dont have permission to edit content items that are not yours!');
			}
		}
	} else {
		if (!$canaddall) {
			mosRedirect('index2.php?option=com_content&sectionid='.$row->sectionid, 'You dont have permission to add content items!');
		}
	}
	unset($caneditall, $caneditown, $canaddall);

	if ( $sectionid == 0 ) {
		$where = "\n WHERE section NOT LIKE '%com_%'";
	} else {
		$where = "\n WHERE section='$sectionid'";
	}

	// get the type name - which is a special category
	 if ($row->sectionid){
		$database->setQuery( "SELECT name FROM #__sections WHERE id='$row->sectionid'", '#__', 1, 0 );
		$section = $database->loadResult();
		$contentSection = $section;
	} else {
		$query = "SELECT name FROM #__sections WHERE id=$sectionid";
		$database->setQuery( "SELECT name FROM #__sections WHERE id='$sectionid'", '#__', 1, 0 );
		$section = $database->loadResult();
		$contentSection = $section;
	}

	// fail if checked out not by 'me'
	if ($row->checked_out && $row->checked_out <> $my->id) {
		mosRedirect( 'index2.php?option=com_content', $adminLanguage->A_CMP_CNT_THMODULIS .' '. $row->title .' '. $adminLanguage->A_ISCEDITANADM );
	}

	if ($uid) {
		$row->checkout( $my->id );
		if (trim( $row->images )) {
			$row->images = explode( "\n", $row->images );
		} else {
			$row->images = array();
		}

 		$row->created = mosFormatDate( $row->created, $adminLanguage->A_CMP_CNT_DROWCRED );
		$row->modified = mosFormatDate( $row->modified, $adminLanguage->A_CMP_CNT_DROWMOD );
		$row->publish_up = mosFormatDate( $row->publish_up, $adminLanguage->A_CMP_CNT_DROWPUB );

  	    if (trim( $row->publish_down ) == '2060-01-01 00:00:00') {
			$row->publish_down = $adminLanguage->A_CMP_CNT_PBLINEV;
		}

		$database->setQuery( "SELECT name FROM #__users WHERE id='$row->created_by'", '#__', 1, 0 );
		$row->creator = $database->loadResult();

		$database->setQuery( "SELECT name FROM #__users WHERE id='$row->modified_by'", '#__', 1, 0 );
		$row->modifier = $database->loadResult();

		$database->setQuery( "SELECT content_id FROM #__content_frontpage WHERE content_id=$row->id", '#__', 1, 0 );
		$row->frontpage = intval($database->loadResult());

		// get list of links to this item
		$and = "\n AND componentid = ". $row->id;
		$menus = mosAdminMenus::Links2Menu( 'content_item_link', $and );
	} else {
		$row->sectionid 	= $sectionid;
		$row->version 		= 0;
		$row->state 		= 1;
		$row->ordering 		= 0;
		$row->images 		= array();
		$row->publish_up 	= date( $adminLanguage->A_CMP_CNT_DPUBLISHUP, time() );
		//$row->publish_up 	= date( $adminLanguage->A_CMP_CNT_DPUBLISHUP, time() + $mosConfig_offset * 60 * 60 );
		$row->publish_down 	= $adminLanguage->A_CMP_CNT_PBLINEV;
		$row->catid 		= NULL;
		$row->creator 		= '';
		$row->modifier 		= '';
		$row->frontpage 	= 0;
		$row->language    = '';
		$menus = array();
	}

	$javascript = "onchange=\"changeDynaList( 'catid', sectioncategories, document.adminForm.sectionid.options[document.adminForm.sectionid.selectedIndex].value, 0, 0);\"";

	$query = "SELECT s.id AS value, s.title AS text FROM #__sections s ORDER BY s.ordering";
	$database->setQuery( $query );
	if ( $sectionid == 0 ) {
		$sections[] = mosHTML::makeOption( '-1', $adminLanguage->A_CMP_CNT_SLSECTN );
		$sections = array_merge( $sections, $database->loadObjectList() );
		$lists['sectionid'] = mosHTML::selectList( $sections, 'sectionid', 'class="selectbox" size="1" '. $javascript, 'value', 'text' );
	} else {
        $intval = intval( $row->sectionid);
        $dbLoadObjectList = $database->loadObjectList();
        $lists['sectionid'] = mosHTML::selectList( $dbLoadObjectList, 'sectionid', 'class="selectbox" size="1" '. $javascript, 'value', 'text', $intval );
	}

	$sections = $database->loadObjectList();

	$sectioncategories = array();
	$sectioncategories[-1] = array();
	$sectioncategories[-1][] = mosHTML::makeOption( '-1', $adminLanguage->A_CMP_CNT_SELCAT );
	foreach($sections as $section) {
		$sectioncategories[$section->value] = array();
		$query = "SELECT id AS value, name AS text FROM #__categories"
		."\n WHERE section='$section->value' ORDER BY ordering";
		$database->setQuery( $query );
		$rows2 = $database->loadObjectList();
			foreach($rows2 as $row2) {
			$sectioncategories[$section->value][] = mosHTML::makeOption( $row2->value, $row2->text );
		}
	}

 	//get list of categories
  	if ( !$row->catid && !$row->sectionid ) {
 		$categories[] 	= mosHTML::makeOption( '-1', $adminLanguage->A_CMP_CNT_SELCAT );
 		$lists['catid'] = mosHTML::selectList( $categories, 'catid', 'class="selectbox" size="1"', 'value', 'text' );
  	} else {
 		$query = "SELECT id AS value, name AS text FROM #__categories"
 		. $where
 		. "\n ORDER BY ordering";
 		$database->setQuery( $query );
 		$categories[] 		= mosHTML::makeOption( '-1', $adminLanguage->A_CMP_CNT_SELCAT );
 		$categories 		= array_merge( $categories, $database->loadObjectList() );
 		$lists['catid'] 	= mosHTML::selectList( $categories, 'catid', 'class="selectbox" size="1"', 'value', 'text', intval( $row->catid ) );
  	}

	//build the html select list for ordering
	$query = "SELECT ordering AS value, title AS text FROM #__content"
	. "\n WHERE catid='$row->catid' AND state >= 0 ORDER BY ordering";
	$lists['ordering'] = mosAdminMenus::SpecificOrdering( $row, $uid, $query, 1 );

	//calls function to read image from directory
	$pathA 		= $mainframe->getCfg('absolute_path').'/images/stories';
	$pathL 		= $mainframe->getCfg('live_site').'/images/stories';
	$images 	= array();
	$folders 	= array();
	$folders[] 	= mosHTML::makeOption( '/' );
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
	//build the select list for the image position alignment
	$lists['_align'] 			= mosAdminMenus::Positions( '_align' );
	//build the select list for the image caption alignment
	$lists['_caption_align'] 	= mosAdminMenus::Positions( '_caption_align' );
	//build the html select list for the group access
	$lists['access'] 			= mosAdminMenus::Access( $row );
	//build the html select list for menu selection
	$lists['menuselect']		= mosAdminMenus::MenuSelect( );
    //build the html multiple select list for language selection
    $lists['languages']			= mosAdminMenus::SelectLanguages( 'languages', $row->language, $adminLanguage->A_ALL_LANGS );

	//build the select list for the image caption position
	$pos[] = mosHTML::makeOption( 'bottom', $adminLanguage->A_BOTTOM );
	$pos[] = mosHTML::makeOption( 'top', $adminLanguage->A_TOP );
	$lists['_caption_position'] = mosHTML::selectList( $pos, '_caption_position', 'class="selectbox" size="1"', 'value', 'text' );

    if (trim($row->urls) != '') {
        $parts = preg_split('/[\n]/', $row->urls, -1, PREG_SPLIT_NO_EMPTY);
    } else {
        $parts = array();
    }
    for ($i=0; $i<5; $i++) {
        $x = 'title'.($i + 1);
        $y = 'link'.($i + 1);
        if (isset($parts[$i]) && ($parts[$i] != '')) {
            $l = preg_split('/[\|]/', $parts[$i], 2);
        } else {
            $l = array('', '');
        }
        $lists[$x] = $l[0];
        $lists[$y] = $l[1];
    }

	//get params definitions
	$params = new mosParameters( $row->attribs, $mainframe->getPath( 'com_xml', 'com_content' ), 'component' );

	HTML_content::editContent( $row, $contentSection, $lists, $sectioncategories, $images, $params, $option, $redirect, $menus );
}


/*********************/
/* SAVE CONTENT ITEM */
/*********************/
function saveContent( $sectionid, $task ) {
	global $database, $my, $mainframe, $adminLanguage, $_VERSION, $acl;

	//CSRF prevention
	$tokname = 'token'.$my->id;
	if (!isset($_POST[$tokname]) || !isset($_SESSION[$tokname]) || ($_POST[$tokname] != $_SESSION[$tokname])) {
		die('Detected CSRF attack! Someone is forging your requests.');
	}

	$menu 	= mosGetParam( $_POST, 'menu', 'mainmenu' );
	$menuid	= mosGetParam( $_POST, 'menuid', 0 );

    foreach ($_POST['languages'] as $xlang) {
    	if (trim($xlang) == '') { $newlangs = ''; }
    }
    if (!isset($newlangs)) {
    	$newlangs = implode(',', $_POST['languages']);
    }
    $_POST['language'] = $newlangs;

    $title1 = eUTF::utf8_trim(mosGetParam($_POST, 'title1', ''));
    $link1 = trim(mosGetParam($_POST, 'link1', ''));
    $title2 = eUTF::utf8_trim(mosGetParam($_POST, 'title2', ''));
    $link2 = trim(mosGetParam($_POST, 'link2', ''));
    $title3 = eUTF::utf8_trim(mosGetParam($_POST, 'title3', ''));
    $link3 = trim(mosGetParam($_POST, 'link3', ''));
    $title4 = eUTF::utf8_trim(mosGetParam($_POST, 'title4', ''));
    $link4 = trim(mosGetParam($_POST, 'link4', ''));
    $title5 = eUTF::utf8_trim(mosGetParam($_POST, 'title5', ''));
    $link5 = trim(mosGetParam($_POST, 'link5', ''));

    $exturls = '';
    if (($title1 != '') && ($link1 != '')) { $exturls .= $title1."|".$link1."\n"; }
    if (($title2 != '') && ($link2 != '')) { $exturls .= $title2."|".$link2."\n"; }
    if (($title3 != '') && ($link3 != '')) { $exturls .= $title3."|".$link3."\n"; }
    if (($title4 != '') && ($link4 != '')) { $exturls .= $title4."|".$link4."\n"; }
    if (($title5 != '') && ($link5 != '')) { $exturls .= $title5."|".$link5."\n"; }
    $_POST['urls'] = $exturls;

	$row = new mosContent( $database );
	if (!$row->bind( $_POST )) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
    $seo = new seovs('com_content', '', $row->seotitle);
    $seo->id = intval($row->id);
    $seo->catid = intval($row->catid);
    $seoval = $seo->validate();
    if (!$seoval) {
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_SEOTITLE.": ".$seo->message."'); window.history.go(-1);</script>"._LEND;
		exit();
    }

    $isNew = ( $row->id < 1 );
	if ($isNew) {
		$row->created 		= $row->created ? mosFormatDate( $row->created, $adminLanguage->A_CMP_CNT_DROWCRED, -$mainframe->getCfg('offset')) : date( $adminLanguage->A_CMP_CNT_DATEFORMAT );
		$row->created_by 	= $row->created_by ? $row->created_by : $my->id;
	} else {
		$row->modified 		= date( $adminLanguage->A_CMP_CNT_DATEFORMAT );
		$row->modified_by 	= $my->id;
		$row->created 		= $row->created ? mosFormatDate( $row->created, $adminLanguage->A_CMP_CNT_DROWCRED, -$mainframe->getCfg('offset')) : date( $adminLanguage->A_CMP_CNT_DATEFORMAT );
		$row->created_by 	= $row->created_by ? $row->created_by : $my->id;
	}

	if (eUTF::utf8_strlen(eUTF::utf8_trim( $row->publish_up )) <= 10) {
  		$row->publish_up .= " ".date('H:i').":00";
	}
	$row->publish_up = mosFormatDate($row->publish_up, $adminLanguage->A_CMP_CNT_DROWPUB, -$mainframe->getCfg('offset') );

	if (eUTF::utf8_trim( $row->publish_down ) == $adminLanguage->A_CMP_CNT_PBLINEV) {
		$row->publish_down = "2060-01-01 00:00:00";
	}

	$meta = $row->title;
	if (($row->metadesc == '') || ($row->metadesc == '')) {
		if ($row->sectionid > 0) {
			if (preg_match('/postgre/i', $database->_resource->databaseType)) {
				$onid = 's.id::VARCHAR = c.section';
			} elseif (in_array($database->_resource->databaseType, array ('oci8', 'oci805', 'oci8po', 'oracle'))) {
				$onid = 'TO_CHAR(s.id) = c.section';
			} else {
				$onid = 's.id = c.section';
			}

			$querymeta = "SELECT c.title AS cattitle, s.title AS sectitle FROM #__categories c"
			."\n LEFT JOIN #__sections s ON ".$onid
			."\n WHERE c.id='".$row->catid."'";
			$database->setQuery($querymeta, '#__', 1, 0);
			$metarow = $database->loadRow();
			if ($metarow) { $meta .= ' '.$metarow['cattitle'].' '.$metarow['sectitle']; }
		}
	}

	if (trim($row->metadesc) == '') { $row->metadesc = $meta; }
	if (trim($row->metakey) == '') { $row->metakey = eUTF::utf8_str_replace(' ', ', ', $meta); }

	$params = mosGetParam( $_POST, 'params', '' );
	if (is_array( $params )) {
		$txt = array();
		foreach ( $params as $k=>$v) {
			$txt[] = "$k=$v";
		}
		$row->attribs = implode( "\n", $txt );
	}


	$canpuball = $acl->acl_check('action', 'publish', 'users', $my->usertype, 'content', 'all');
	$canpubown = $acl->acl_check('action', 'publish', 'users', $my->usertype, 'content', 'own');
	$canpublish = 0;
	if (!$canpuball) {
		if ($canpubown && ($row->created_by == $my->id)) {
			$canpublish = (int)mosGetParam($_REQUEST, 'published', 0);
		}
	} else {
		$canpublish = (int)mosGetParam($_REQUEST, 'published', 0);
	}

	$row->state = ''.$canpublish.'';

	//code cleaner for xhtml transitional compliance
	$row->introtext = eUTF::utf8_str_replace( '<br>', '<br />', $row->introtext );
	$row->maintext 	= eUTF::utf8_str_replace( '<br>', '<br />', $row->maintext );

 	//remove <br /> take being automatically added to empty maintext
 	$length	= eUTF::utf8_strlen( $row->maintext ) < 9;
 	$search = strstr( $row->maintext, '<br />');
 	if ( $length && $search ) {
 		$row->maintext = NULL;
 	}

 	if (!$row->check()) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>"._LEND;
		exit();
	}
	$row->version++;
	if (!$row->store()) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>"._LEND;
		exit();
	}

	//manage frontpage items
	require_once( $mainframe->getPath( 'class', 'com_frontpage' ) );
	$fp = new mosFrontPage( $database );

	if (mosGetParam( $_REQUEST, 'frontpage', 0 )) {

		//toggles go to first place
		if (!$fp->load( $row->id )) {
			// new entry
			$database->setQuery( "INSERT INTO #__content_frontpage VALUES ('$row->id','1')" );
			if (!$database->query()) {
				echo "<script type=\"text/javascript\">alert('".$database->stderr()."');</script>\n";
				exit();
			}
			$fp->ordering = 1;
		}
	} else {
		// no frontpage mask
		if (!$fp->delete( $row->id )) {
			$msg .= $fp->stderr();
		}
		$fp->ordering = 0;
	}
	$fp->updateOrder();

	$row->checkin();
	$row->updateOrder( "catid='$row->catid' AND state >= 0" );

	$redirect = mosGetParam( $_POST, 'redirect', $sectionid );
	switch ( $task ) {
		case 'go2menu':
			mosRedirect( 'index2.php?option=com_menus&menutype='.$menu );
			break;
		case 'go2menuitem':
			mosRedirect( 'index2.php?option=com_menus&menutype='.$menu.'&task=edit&hidemainmenu=1&id='.$menuid );
			break;
		case 'menulink':
			menuLink( $redirect, $row->id );
			break;
		case 'resethits':
			resethits( $redirect, $row->id );
			break;
        case 'applysub':
        case 'savesub':
            $sub = intval(mosGetParam($_POST, 'sub', 0));
            $database->setQuery("DELETE FROM #__submitted_content WHERE id='".$sub."'");
            $database->query();

			//notify user
			if ($row->created_by != $my->id) {
				$database->setQuery( "SELECT email, preflang FROM #__users WHERE id='".$row->created_by."' AND block ='0'", '#__', 1, 0 );
				$recipient = $database->loadRowList();

				if ($recipient) {
					$prlang = new prefLang();
					$prlang->load($recipient['preflang']);

					$database->setQuery( "SELECT title FROM #__section WHERE id='".$row->sectionid."' AND scope='content'", '#__', 1, 0 );
					$sec = $database->loadResult();

					$database->setQuery( "SELECT title FROM #__categories WHERE id='".$row->catid."' AND section='".$row->sectionid."'", '#__', 1, 0 );
					$cat = $database->loadResult();

					$message = '<strong>'.sprintf($prLang->_SUBCON_ATAPPR, $mainframe->getCfg('sitename'))."</strong><br /><br />\r\n";
					$message .= $prLang->_E_TITLE.': '.$row->title."<br />\r\n";
					if ($sec) {
						$message .= $prLang->_SECTION.': '.$sec."<br />\r\n";
					}
					if ($cat) {
						$message .= $prLang->_CATEGORY.': '.$cat."<br />\r\n";
					}
					$message .= $prlang->lng->_DATE.": ".$row->created."<br />\r\n";
					$message .= '<a href="'.$mainframe->getCfg('live_site').'">'.$mainframe->getCfg('sitename').'</a>';
					$message .= "<br /><br /><br /><br />\r\n";
					$message .= '<small>Generated by '.$_VERSION->PRODUCT.' '.$_VERSION->RELEASE.'.'.$_VERSION->DEV_LEVEL.' ('.$_VERSION->CODENAME.')</small>';
					$message .= "<br />\r\n";
					$message .= '<small>'.$_VERSION->COPYRIGHT.'</small><br />';

					mosMail($mosConfig_mailfrom, $mosConfig_fromname, $recipient['email'], $prlang->lng->_SUBCON_APPRNTF, $message, 1);
				}
			}

            $msg = $adminLanguage->A_CMP_CNT_SAVTRANS;
            if ($task == 'applysub') {
                mosRedirect( 'index2.php?option=com_content&sectionid='.$row->sectionid.'&task=edit&hidemainmenu=1&id='.$row->id, $msg );
            } else {
                mosRedirect( 'index2.php?option=com_content&task=subcontent', $msg );
            }
        break;
		case 'apply':
			$msg = $adminLanguage->A_SSCHITEM .': '. $row->title;
			mosRedirect( 'index2.php?option=com_content&sectionid='. $redirect .'&task=edit&hidemainmenu=1&id='. $row->id, $msg );
		case 'save':
		default:
			$msg = $adminLanguage->A_SSAVITEM .': '. $row->title;
			mosRedirect( 'index2.php?option=com_content&sectionid='. $redirect, $msg );
			break;
	}
}


/**********************/
/* AJAX CHANGE STATUS */
/**********************/
function ajaxchangeContent() {
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

    if ($error) { $state = $state ? 0 : 1; }
    $img = $state ? 'publish_g.png' : 'publish_x.png';
    $alt = $state ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
?>
	<a href="javascript: void(0);" 
    onclick="changeContentState('<?php echo $elem; ?>', '<?php echo $id; ?>', '<?php echo ($state) ? 0 : 1; ?>');" title="<?php echo $alt; ?>">
	<img src="images/<?php echo $img; ?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" /></a>
<?php 
    exit();
}


/**
* Changes the state of one or more content pages
* @param string The name of the category section
* @param integer A unique category id (passed from an edit form)
* @param array An array of unique category id numbers
* @param integer 0 if unpublishing, 1 if publishing
* @param string The name of the current user
*/
function changeContent( $cid=null, $state=0, $option ) {
	global $database, $my, $adminLanguage;

	if (count( $cid ) < 1) {
		$action = $state == 1 ? 'publish' : ($state == -1 ? $adminLanguage->A_ARCHIVE : $adminLanguage->A_UNPUBLISH);
		echo "<script type=\"text/javascript\">alert('". $adminLanguage->A_SELITEMTO ." ". $action ."'); window.history.go(-1);</script>\n";
		exit();
	}

	$total = count ( $cid );
	$cids = implode( ',', $cid );

	$database->setQuery( "UPDATE #__content SET state='$state'"
	."\n WHERE id IN ($cids) AND (checked_out=0 OR (checked_out='".$my->id."'))"
	);
	if (!$database->query()) {
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosContent( $database );
		$row->checkin( $cid[0] );
	}

	$redirect = mosGetParam( $_POST, 'redirect', $row->sectionid );
	$task = mosGetParam( $_POST, 'returntask', '' );

	if ( $state == "-1" ) {
		$msg = $total ." ". $adminLanguage->A_CMP_CNT_ARCHVED;
	} else if ( $state == "1" ) {
		$msg = $total ." ". $adminLanguage->A_CMP_CNT_PUBLSHED;
	} else if (( $state == "0" ) && ( $task == 'showarchive' )) {
		$msg = $total ." ". $adminLanguage->A_CMP_CNT_ITSUUNA;
	} else if ( $state == "0" ) {
		$msg = $total ." ". $adminLanguage->A_CMP_CNT_ITSUUNP;
	}

	if ( $task ) {
		$task = '&task='.$task;
	} else {
		$task = '';
	}

	mosRedirect( 'index2.php?option='. $option . $task .'&sectionid='. $redirect, $msg );
}

/**
* Changes the state of one or more content pages
* @param string The name of the category section
* @param integer A unique category id (passed from an edit form)
* @param array An array of unique category id numbers
* @param integer 0 if unpublishing, 1 if publishing
* @param string The name of the current user
*/
function toggleFrontPage( $cid, $section, $option ) {
	global $database, $my, $mainframe, $adminLanguage;

	if (count( $cid ) < 1) {
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_CMP_CNT_SELITOG ."\"); window.history.go(-1);</script>\n";
		exit();
	}

	$msg = '';
	require_once( $mainframe->getPath( 'class', 'com_frontpage' ) );

	$fp = new mosFrontPage( $database );
	foreach ($cid as $id) {
		//toggles go to first place
		if ($fp->load( $id )) {
			if (!$fp->delete( $id )) {
				$msg .= $fp->stderr();
			}
			$fp->ordering = 0;
		} else {
			//new entry
			$database->setQuery( "INSERT INTO #__content_frontpage VALUES ('$id','0')" );
			if (!$database->query()) {
				echo "<script type=\"text/javascript\">alert('".$database->stderr()."');</script>\n";
				exit();
			}
			$fp->ordering = 0;
		}
		$fp->updateOrder();
	}

	mosRedirect( 'index2.php?option='. $option .'&sectionid='. $section, $msg );
}


/*************************/
/* AJAX TOGGLE FRONTPAGE */
/*************************/
function ajaxToggleFront() {
	global $database, $mainframe, $adminLanguage;

    $elem = intval(mosGetParam($_REQUEST, 'elem', 0));
    $id = intval(mosGetParam($_REQUEST, 'id', 0));
    $state = intval(mosGetParam($_REQUEST, 'state', 0));

    if (!$id) {
        echo '<img src="../includes/js/ThemeOffice/warning.png" width="16" height="16" border="0" title="'.$adminLanguage->A_ERROR.': Invalid Item id" />'._LEND;
        exit();
    }

    $error = 0;
	require_once( $mainframe->getPath( 'class', 'com_frontpage' ) );

	$fp = new mosFrontPage( $database );
	if ($fp->load( $id )) {
		if (!$fp->delete( $id )) { $error = 1; }
		$fp->ordering = 0;
	} else {
		$database->setQuery( "INSERT INTO #__content_frontpage VALUES ('$id','0')" );
		if (!$database->query()) { $error = 1; }
		$fp->ordering = 0;
	}
	$fp->updateOrder();

    if ($error) { $state = $state ? 0 : 1; }
    $img = $state ? 'tick.png' : 'publish_x.png';
    $alt = $state ? $adminLanguage->A_YES : $adminLanguage->A_NO;
?>
	<a href="javascript: void(0);" onclick="changeFrontState('<?php echo $elem; ?>', '<?php echo $id; ?>', '<?php echo ($state) ? 0 : 1; ?>');">
	<img src="images/<?php echo $img; ?>" width="12" height="12" border="0" title="<?php echo $alt; ?>" /></a>
<?php 
    exit();
}


/**************************/
/* REMOVE CONTENT ITEM(S) */
/**************************/
function removeContent( &$cid, $sectionid, $option ) {
	global $database, $adminLanguage, $acl, $my;

	$total = count( $cid );
	if ( $total < 1) {
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_CMP_CNT_SELIDEL ."\"); window.history.go(-1);</script>"._LEND;
		exit();
	}

	$caneditall = $acl->acl_check('action', 'edit', 'users', $my->usertype, 'content', 'all');
	$caneditown = $acl->acl_check('action', 'edit', 'users', $my->usertype, 'content', 'own'); 
	if (!($caneditall || $caneditown)) {
		echo "<script type=\"text/javascript\">alert('You need edit permission to perform this action!'); window.history.go(-1);</script>"._LEND;
		exit();
	}

	$state = '-2';
	$ordering = '0';
	//seperate contentids
	$cids = implode( ',', $cid );
	$query = "UPDATE #__content SET state = '". $state ."', ordering = '". $ordering ."'"
	. "\n WHERE id IN ( ". $cids ." )";
	$database->setQuery( $query );
	if (!$database->query()) {
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>"._LEND;
		exit();
	}

	$msg = $total.' '.$adminLanguage->A_ITEMSTRASHED;
	$return = mosGetParam( $_POST, 'returntask', '' );
	mosRedirect( 'index2.php?option='. $option .'&task='. $return .'&sectionid='. $sectionid, $msg );
}


/********************/
/* CANCEL EDIT ITEM */
/********************/
function cancelContent() {
	global $database;

	$row = new mosContent( $database );
	$row->bind( $_POST );
	$row->checkin();

	$redirect = mosGetParam( $_POST, 'redirect', 0 );
	mosRedirect( 'index2.php?option=com_content&sectionid='. $redirect );
}

/**
* Moves the order of a record
* @param integer The increment to reorder by
*/
function orderContent( $uid, $inc, $option ) {
	global $database;

	$row = new mosContent( $database );
	$row->load( $uid );
	$row->move( $inc, "catid='$row->catid' AND state >= 0" );

	$redirect = mosGetParam( $_POST, 'redirect', $row->sectionid );
	mosRedirect( 'index2.php?option='. $option .'&sectionid='. $redirect );
}


/**************************************************/
/* PREPARE TO MOVE ITEM TO OTHER SECTION/CATEGORY */
/**************************************************/
function moveSection( $cid, $sectionid, $option ) {
	global $database, $adminLanguage;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_SELITEMMOV ."\"); window.history.go(-1);</script>\n";
		exit();
	}
	$pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;
	$ora = (in_array($database->_resource->databaseType, array ('oci8', 'oci805', 'oci8po', 'oracle'))) ? 1 : 0;

	//seperate contentids
	$cids = implode( ',', $cid );
	//Content Items query
	$database->setQuery("SELECT title FROM #__content WHERE id IN (".$cids.") ORDER BY title");
	$items = $database->loadResultArray();

	$query = "SELECT ".$database->_resource->Concat( 's.id',"','", 'c.id' )." AS value,"
    . "\n ".$database->_resource->Concat( 's.name', "' / '", 'c.name' )." AS text"
	. "\n FROM #__sections s";
	if ($pg) {
		$query .= "\n INNER JOIN #__categories c ON c.section = s.id::VARCHAR";
	} else if ($ora) {
		$query .= "\n INNER JOIN #__categories c ON c.section = TO_CHAR(s.id)";
	} else {
		$query .= "\n INNER JOIN #__categories c ON c.section = s.id";
	}
	$query .= "\n WHERE s.scope = 'content'"
	. "\n ORDER BY s.name, c.name";
	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	//build the html select list
	$sectCatList = mosHTML::selectList( $rows, 'sectcat', 'class="selectbox" size="8"', 'value', 'text', null );

	HTML_content::moveSection( $cid, $sectCatList, $option, $sectionid, $items );
}


/********************/
/* SAVE MOVED ITEMS */
/********************/
function moveSectionSave( &$cid, $sectionid, $option ) {
	global $database, $my, $adminLanguage, $mosConfig_absolute_path;

	$sectcat = mosGetParam( $_POST, 'sectcat', '' );
	list( $newsect, $newcat ) = explode( ',', $sectcat );

	if (!$newsect && !$newcat ) {
		mosRedirect( "index.php?option=com_content&sectionid=".$sectionid, $adminLanguage->A_CMP_CNT_ERROCCRD );
	}

    require_once($mosConfig_absolute_path.'/administrator/includes/seovs.class.php');

	$database->setQuery( "SELECT name FROM #__sections WHERE id = '$newsect'", '#__', 1, 0);
	$section = $database->loadResult();

	$database->setQuery( "SELECT name FROM #__categories WHERE id = '$newcat'", '#__', 1, 0);
	$category = $database->loadResult();

	$total = count( $cid );
	$cids = implode( ',', $cid );

	$row = new mosContent( $database );

	//update old orders - put existing items in last place
	foreach ($cid as $id) {
		$row->load( intval( $id ) );
		$row->ordering = 0;
		$row->store();
		$row->updateOrder( "catid='$row->catid' AND state >= 0" );
	}

	$query = "UPDATE #__content SET sectionid = '$newsect', catid='$newcat'"
	."\n WHERE id IN ($cids)"
	."\n AND ( checked_out='0' OR ( checked_out='". $my->id ."') )";
	$database->setQuery( $query );
	if ( !$database->query() ) {
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	//update new orders - put items in last place, also update seotitles
	foreach ($cid as $id) {
		$row->load(intval( $id ));
		$row->ordering = 0;

        $seotitle = $row->seotitle;
        $seo = new seovs('com_content', '', $seotitle);
        $seo->id = $row->id;
        $seo->catid = $row->catid;
        $seoval = $seo->validate();
        if (!$seoval) { //reset and retry
            $seo->message = '';
            $seo->code = 0;
            $seotitle = $row->seotitle.'-2';
            $seoval = $seo->validate();
            if (!$seoval) {
                $seotitle = $row->seotitle.'-'.rand(1000, 9999);
            }
        }
        $row->seotitle = $seotitle;
		$row->store();
		$row->updateOrder( "catid='".$row->catid."' AND state >= 0" );
	}

	$msg = $total.' '. $adminLanguage->A_CMP_CNT_MOVD.': '.$section.', '.$adminLanguage->A_CATEGORY.': '.$category;
	mosRedirect( 'index2.php?option='. $option .'&sectionid='. $sectionid, $msg );
}


/***************************/
/* PREPARE TO COPY AN ITEM */
/***************************/
function copyItem( $cid, $sectionid, $option ) {
	global $database, $adminLanguage;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_SELITEMMOV ."\"); window.history.go(-1);</script>\n";
		exit();
	}
	$pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;
	$ora = (in_array($database->_resource->databaseType, array ('oci8', 'oci805', 'oci8po', 'oracle'))) ? 1 : 0;

	//seperate contentids
	$cids = implode( ',', $cid );
	//Content Items query
	$database->setQuery("SELECT title FROM #__content WHERE id IN (".$cids.") ORDER BY title");
	$items = $database->loadResultArray();

	//Section & Category query
	$query = "SELECT ".$database->_resource->Concat( 's.id', "','", 'c.id' )." AS value,"
    ."\n ".$database->_resource->Concat( 's.name', "' / '", 'c.name' )." AS text"
	."\n FROM #__sections s";
	if ($pg) {
		$query .= "\n INNER JOIN #__categories c ON c.section = s.id::VARCHAR";
	} else if ($ora) {
		$query .= "\n INNER JOIN #__categories c ON c.section = TO_CHAR(s.id)";
	} else {
		$query .= "\n INNER JOIN #__categories c ON c.section = s.id";
	}
	$query .= "\n WHERE s.scope='content'"
	."\n ORDER BY s.name, c.name";
	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	//build the html select list
	$sectCatList = mosHTML::selectList( $rows, 'sectcat', 'class="selectbox" size="10"', 'value', 'text', NULL );

	HTML_content::copySection( $option, $cid, $sectCatList, $sectionid, $items );
}


/*********************/
/* SAVE COPIED ITEMS */
/*********************/
function copyItemSave( $cid, $sectionid, $option ) {
	global $database, $my, $adminLanguage, $mainframe;

	$sectcat = mosGetParam( $_POST, 'sectcat', '' );
	//seperate sections and categories from selection
	$sectcat = explode(',', $sectcat);
	list( $newsect, $newcat ) = $sectcat;

	if ( !$newsect && !$newcat ) {
		mosRedirect( "index2.php?option=com_content&sectionid=".$sectionid, $adminLanguage->A_CMP_CNT_ERROCCRD );
	}
	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');

	//find section name
	$database->setQuery( "SELECT name FROM #__sections WHERE id = '$newsect'", '#__', 1, 0 );
	$section = $database->loadResult();

	//find category name
	$database->setQuery("SELECT name FROM #__categories WHERE id = '$newcat'", '#__', 1, 0 );
	$category = $database->loadResult();

	$total = count( $cid );
	for ( $i = 0; $i < $total; $i++ ) {
		$row = new mosContent( $database );

		//main query
		$database->setQuery("SELECT * FROM #__content WHERE id = '".$cid[$i]."'", '#__', 1, 0);
		$database->loadObject($item);

        $seotitle = $item->seotitle;
        $seo = new seovs('com_content', '', $item->seotitle);
        $seo->id = $item->id;
        $seo->catid = $newcat;
        $seoval = $seo->validate();
        if (!$seoval) {
            for ($w=2; $w<21; $w++) {
                $seo = new seovs('com_content', '', $item->seotitle.'-'.$w);
                $seo->id = $item->id;
                $seo->catid = $newcat;
                $seoval = $seo->validate();
                if ($seoval) {
                    $seotitle = $item->seotitle.'-'.$w;
                    break;
                }
            }
        }

		$row->id 				= NULL;
		$row->sectionid 		= $newsect;
		$row->catid 			= $newcat;
		$row->hits 				= '0';
		$row->ordering			= '0';
		$row->title 			= $item->title;
		$row->seotitle 		    = $seotitle;
		$row->introtext 		= $item->introtext;
		$row->maintext 			= $item->maintext;
		$row->state 			= $item->state;
		$row->mask 				= $item->mask;
		$row->created 			= date('Y-m-d H:i:s');
		$row->created_by 		= $my->id;
		$row->created_by_alias 	= NULL;
		$row->modified 			= date('Y-m-d H:i:s');
		$row->modified_by 		= $my->id;
		$row->checked_out 		= $my->id;
		$row->checked_out_time 	= date('Y-m-d H:i:s');
		$row->frontpage_up 		= $item->frontpage_up;
		$row->frontpage_down 	= $item->frontpage_down;
		$row->publish_up 		= $item->publish_up;
		$row->publish_down 		= $item->publish_down;
		$row->images 			= $item->images;
		$row->attribs 			= $item->attribs;
		$row->urls 			    = $item->urls;
		$row->version 			= '1';
		$row->parentid 			= $item->parentid;
		$row->metakey 			= $item->metakey;
		$row->metadesc 			= $item->metadesc;
		$row->access 			= $item->access;
		$row->language 			= $item->language;

		if (!$row->check()) {
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()." ".$row->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}
		if (!$row->store()) {
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()." ".$row->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}
		$row->updateOrder( "catid='".$row->catid."' AND state >= 0" );
	}

	$msg = $total.' '.$adminLanguage->A_CMP_CNT_COPED.': '.$section.', '.$adminLanguage->A_CATEGORY.': '.$category;
	mosRedirect( 'index2.php?option='. $option .'&sectionid='.$sectionid, $msg );
}


/**
* Function to reset Hit count of a content item
* PT
*/
function resethits( $redirect, $id ) {
	global $database, $adminLanguage;

	$row = new mosContent($database);
	$row->Load($id);
	$row->hits = "0";
	$row->store();
	$row->checkin();

	$msg = $adminLanguage->A_CMP_CNT_RSTHTCNT.' '.$row->title;
	mosRedirect( 'index2.php?option=com_content&sectionid='. $redirect .'&task=edit&hidemainmenu=1&id='. $id, $msg );
}

/**
* @param integer The id of the content item
* @param integer The new access level
* @param string The URL option
*/
function accessMenu( $uid, $access, $option ) {
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

	$redirect = mosGetParam( $_POST, 'redirect', $row->sectionid );

	mosRedirect( 'index2.php?option='. $option .'&sectionid='. $redirect );
}

function filterCategory( $query, $active=NULL ) {
	global $database, $adminLanguage;

	$categories[] = mosHTML::makeOption( '0', $adminLanguage->A_ALL_CATEGORIES );
	$database->setQuery( $query );
	$categories = array_merge( $categories, $database->loadObjectList() );

	$category = mosHTML::selectList( $categories, 'catid', 'class="selectbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $active );

	return $category;
}

function menuLink( $redirect, $id ) {
	global $database, $adminLanguage;

	$menu = mosGetParam( $_POST, 'menuselect', '' );
	$link = mosGetParam( $_POST, 'link_name', '' );

	$row = new mosMenu( $database );
	$row->menutype 		= $menu;
	$row->name 			= $link;
	$row->type 			= 'content_item_link';
	$row->published		= 1;
	$row->componentid	= $id;
	$row->link			= 'index.php?option=com_content&task=view&id='. $id;
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
	$row->updateOrder( "menutype='$row->menutype' AND parent='$row->parent'" );

    $msg = $link.' '. $adminLanguage->A_CMP_CNT_INMENU .': '.$menu.' '.$adminLanguage->A_CMP_CNT_SUCCSS;
	mosRedirect( 'index2.php?option=com_content&sectionid='. $redirect .'&task=edit&hidemainmenu=1&id='. $id, $msg );
}

function go2menu() {
	$menu = mosGetParam( $_POST, 'menu', 'mainmenu' );

	mosRedirect( 'index2.php?option=com_menus&menutype='. $menu );
}

function go2menuitem() {
	$menu 	= mosGetParam( $_POST, 'menu', 'mainmenu' );
	$id		= mosGetParam( $_POST, 'menuid', 0 );

	mosRedirect( 'index2.php?option=com_menus&menutype='. $menu .'&task=edit&hidemainmenu=1&id='. $id );
}

function saveOrder( &$cid ) {
	global $database, $adminLanguage;

	$total		= count( $cid );
	$order 		= mosGetParam( $_POST, 'order', array(0) );
	$redirect 	= mosGetParam( $_POST, 'redirect', 0 );
	$rettask	= mosGetParam( $_POST, 'returntask', '' );
	$conditions = array();

    //update ordering values
	for($i=0; $i < $total; $i++) {
		$database->setQuery("SELECT id, ordering, catid FROM #__content WHERE id='".$cid[$i]."'", '#__', 1, 0);
		$row = $database->loadRow(); 
		if ($row && ($row['ordering'] != $order[$i])) {
			$database->setQuery("UPDATE #__content SET ordering='".intval($order[$i])."' WHERE id=".$row['id']);
			$database->query();
	        //remember to updateOrder this group
	        $condition = "catid='".$row['catid']."' AND state>=0";
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
			$row = new mosContent($database);
			$row->load( $cond[0] );
			$row->updateOrder( $cond[1] );
			unset($row);
		}
	}

	$msg = $adminLanguage->A_NEWORDERSAVED;
	switch ( $rettask ) {
		case 'showarchive':
			mosRedirect( 'index2.php?option=com_content&task=showarchive&sectionid='. $redirect, $msg );
			break;

		default:
			mosRedirect( 'index2.php?option=com_content&sectionid='. $redirect, $msg );
			break;
	}
}


/*****************************/
/* PREPARE TO TRANSLATE ITEM */
/*****************************/
function translateItem($cid, $option) {
	global $database, $adminLanguage, $mainframe;

	if ((trim($cid) == '' ) || ( $cid == 0 )) {
		echo "<script type=\"text/javascript\">alert(\"".$adminLanguage->A_CMP_CNT_TRSELITEM."\"); window.history.go(-1);</script>"._LEND;
		exit();
	}

	//load the row from the db table
	$database->setQuery("SELECT id, title, language FROM #__content WHERE id=".$cid."", '#__', 1, 0);
	$row = $database->loadRow();
	if (!$row) {
		echo "<script type=\"text/javascript\">alert(\"".$adminLanguage->A_CMP_CNT_TRSELITEM."\"); window.history.go(-1);</script>"._LEND;
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

	HTML_content::tranlate_Item($option, $alllangs, $initLang, $row);
}


/***************************/
/* TRANSLATE AND SAVE ITEM */
/***************************/
function dotranslateItem($cid, $option) {
	global $database, $adminLanguage, $mainframe, $my;

    $langfrom = mosGetParam($_POST, 'langfrom', '');
    $langto = mosGetParam($_POST, 'langto', '');
	if (($langfrom == '') || ($langto == '')) {
    	echo '<script type="text/javascript">alert(\''._GEM_TRINV_INOUT.'\'); window.history.go(-1);</script>'."\n";
    	exit();
	}

    $database->setQuery("SELECT * FROM #__content WHERE id='".$cid."'", '#__', 1, 0);
    $database->loadObject($item);
    if (!$item) {
    	echo "<script type=\"text/javascript\">alert(\"".$adminLanguage->A_CMP_CNT_TRITMNOTF."\"); window.history.go(-2);</script>"._LEND;
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

    $row = new mosContent( $database );
    $row->id 				= NULL;
    $row->sectionid 		= $item->sectionid;
	$row->catid 			= $item->catid;
	$row->hits 				= '0';
	$row->ordering			= '0';
	$row->title 			= $retTitle.' ('.$langto.')';
	$row->seotitle 		    = $seotitle;
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
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-2);</script>"._LEND;
		exit();
	}
	if (!$row->store()) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-2);</script>"._LEND;
		exit();
	}
	$row->updateOrder( "catid='".$row->catid."' AND state >= 0" );

	$msg = $adminLanguage->A_CMP_CNT_TROKSAVED;
    mosRedirect( 'index2.php?option='.$option.'&sectionid='.$row->sectionid, $msg );
}



/******************************************/
/* PREPARE TO LIST USER SUBMITTED CONTENT */
/******************************************/
function submittedContent() {
	global $database, $mainframe, $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

	//get the total number of records
	$database->setQuery( "SELECT COUNT(*) FROM #__submitted_content WHERE scope='content'");
	$total = intval($database->loadResult());

	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

    $query = "SELECT s.id, s.title, s.seotitle, s.sectionid, s.catid, s.created, s.created_by, s.language,"
    ."\n u.name AS author, se.title AS section, c.title AS category, c.language AS category_lang"
    ."\n FROM #__submitted_content s"
    ."\n LEFT JOIN #__users u ON u.id=s.created_by"
    ."\n LEFT JOIN #__sections se ON se.id=s.sectionid"
    ."\n LEFT JOIN #__categories c ON c.id=s.catid"
    ."\n WHERE s.scope='content' AND se.scope='content'"
    ."\n ORDER BY s.created DESC";

	$database->setQuery( $query, '#__', $pageNav->limit, $pageNav->limitstart );
	$rows = $database->loadObjectList();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	HTML_content::viewSubContent( $rows, $pageNav );
}


/*************************************/
/* PREPARE TO EDIT SUBMITTED CONTENT */
/*************************************/
function editSubContent($uid) {
	global $database, $my, $mainframe, $adminLanguage, $mosConfig_offset;

	//load the row from the db table
	$database->setQuery("SELECT * FROM #__submitted_content WHERE id='$uid' AND scope='content'", '#__', 1, 0);
	$database->loadObject($subrow);
	if (!$subrow) {
        mosRedirect( 'index2.php?option=com_content&task=subcontent', 'Requested item not found!' );
	}

	$row = new mosContent( $database );
	$row->load(0);

    $row->title = $subrow->title;
    $row->seotitle = $subrow->seotitle;
    $row->introtext = $subrow->introtext;
    $row->maintext = $subrow->maintext;
    $row->sectionid = $subrow->sectionid;
    $row->catid = $subrow->catid;
    $row->created = $subrow->created;
    $row->created_by = $subrow->created_by;
    $row->metakey = $subrow->metakey;
    $row->metadesc = $subrow->metadesc;
    $row->access = $subrow->access;
    $row->language = $subrow->language;
    $row->hits = 0;
    $row->comments = $subrow->comments;

	//get the type name - which is a special category
	$database->setQuery("SELECT name FROM #__sections WHERE id='$row->sectionid'", '#__', 1, 0);
	$contentSection = $database->loadResult();

    $row->images = array();
    $row->created = mosFormatDate( $row->created, $adminLanguage->A_CMP_CNT_DROWCRED );
    $row->modified = mosFormatDate( date('Y-m-d H:i:s'), $adminLanguage->A_CMP_CNT_DROWMOD );
    $row->publish_up = mosFormatDate( date('Y-m-d H:i:s'), $adminLanguage->A_CMP_CNT_DROWPUB );
    $row->publish_down = $adminLanguage->A_CMP_CNT_PBLINEV;

	$database->setQuery("SELECT name FROM #__users WHERE id='$row->created_by'", '#__', 1, 0 );
	$row->creator = $database->loadResult();

	$database->setQuery("SELECT name FROM #__users WHERE id='$my->id'", '#__', 1, 0 );
	$row->modifier = $database->loadResult();
	$row->version = 0;
	$row->state = 1;
	$row->ordering = 0;	
	$row->frontpage = 0;
    $menus = array();

	$javascript = "onchange=\"changeDynaList( 'catid', sectioncategories, document.adminForm.sectionid.options[document.adminForm.sectionid.selectedIndex].value, 0, 0);\"";

	$database->setQuery("SELECT s.id AS value, s.title AS text FROM #__sections s ORDER BY s.ordering");
    $sections = $database->loadObjectList();
    $lists['sectionid'] = mosHTML::selectList( $sections, 'sectionid', 'class="selectbox" size="1" '. $javascript, 'value', 'text', intval( $row->sectionid) );

	$sectioncategories 	= array();
	$sectioncategories[-1] = array();
	$sectioncategories[-1][] = mosHTML::makeOption( '-1', $adminLanguage->A_CMP_CNT_SELCAT );
	foreach($sections as $section) {
		$sectioncategories[$section->value] = array();
		$query = "SELECT id AS value, name AS text FROM #__categories"
		. "\n WHERE section='$section->value' ORDER BY ordering";
		$database->setQuery( $query );
		$rows2 = $database->loadObjectList();
			foreach($rows2 as $row2) {
			$sectioncategories[$section->value][] = mosHTML::makeOption( $row2->value, $row2->text );
		}
	}

 	//get list of categories
 	$query = "SELECT id AS value, name AS text FROM #__categories"
    ."\n WHERE section='$row->sectionid' ORDER BY ordering";
 	$database->setQuery( $query );
 	$categories[] 	= mosHTML::makeOption( '-1', $adminLanguage->A_CMP_CNT_SELCAT );
 	$categories 	= array_merge( $categories, $database->loadObjectList() );
 	$lists['catid'] = mosHTML::selectList( $categories, 'catid', 'class="selectbox" size="1"', 'value', 'text', intval( $row->catid ) );

	//build the html select list for ordering
	$query = "SELECT ordering AS value, title AS text FROM #__content"
	. "\n WHERE catid='$row->catid' AND state >= 0 ORDER BY ordering";
	$lists['ordering'] = mosAdminMenus::SpecificOrdering( $row, $uid, $query, 1 );

	//calls function to read image from directory
	$pathA 		= $mainframe->getCfg('absolute_path').'/images/stories';
	$pathL 		= $mainframe->getCfg('live_site').'/images/stories';
	$images 	= array();
	$folders 	= array();
	$folders[] 	= mosHTML::makeOption( '/' );
	mosAdminMenus::ReadImages( $pathA, '/', $folders, $images );

	//list of folders in images/stories/
	$lists['folders'] = mosAdminMenus::GetImageFolders( $folders, $pathL );
	//list of images in specfic folder in images/stories/
	$lists['imagefiles'] = mosAdminMenus::GetImages( $images, $pathL );
	//list of saved images
	$lists['imagelist'] = mosAdminMenus::GetSavedImages( $row, $pathL );
	//build list of users
	$lists['created_by'] = mosAdminMenus::UserSelect( 'created_by', $row->created_by );
	//build the select list for the image position alignment
	$lists['_align'] = mosAdminMenus::Positions( '_align' );
	//build the select list for the image caption alignment
	$lists['_caption_align'] = mosAdminMenus::Positions( '_caption_align' );
	//build the html select list for the group access
	$lists['access'] = mosAdminMenus::Access( $row );
	//build the html select list for menu selection
	$lists['menuselect'] = mosAdminMenus::MenuSelect( );
    //build the html multiple select list for language selection
    $lists['languages'] = mosAdminMenus::SelectLanguages( 'languages', $row->language, $adminLanguage->A_ALL_LANGS );

	//build the select list for the image caption position
	$pos[] = mosHTML::makeOption( 'bottom', $adminLanguage->A_BOTTOM );
	$pos[] = mosHTML::makeOption( 'top', $adminLanguage->A_TOP );
	$lists['_caption_position'] = mosHTML::selectList( $pos, '_caption_position', 'class="selectbox" size="1"', 'value', 'text' );

	//get params definitions
	$params = new mosParameters( $row->attribs, $mainframe->getPath( 'com_xml', 'com_content' ), 'component' );

	HTML_content::editContent( $row, $contentSection, $lists, $sectioncategories, $images, $params, 'com_content', 0, $menus, $uid );
}


/*********************************/
/* CANCEL EDIT SUBMITTED CONTENT */
/*********************************/
function cancelSubContent( ) {
	mosRedirect( 'index2.php?option=com_content&task=subcontent' );
}


/*********************************/
/* DELETE USER SUBMITTED CONTENT */
/*********************************/
function removeSubContent( &$cid ) {
	global $database;

	$total = count( $cid );
	if ( $total < 1) {
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_CMP_CNT_SELIDEL ."\"); window.history.go(-1);</script>"._LEND;
		exit();
	}

	$cids = implode(',', $cid);
	$database->setQuery("DELETE FROM #__submitted_content WHERE id IN (".$cids.")");
	if ( !$database->query() ) {
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>"._LEND;
		exit();
	}
	mosRedirect( 'index2.php?option=content&task=subcontent', $msg );
}


/**********************/
/* VALIDATE SEO TITLE */
/**********************/
function validateSEO() {
    global $mainframe;

    $coid = intval(mosGetParam($_POST, 'coid', 0));
    $cocatid = intval(mosGetParam($_POST, 'cocatid', 0));
    $seotitle = eUTF::utf8_trim(mosGetParam($_POST, 'seotitle', ''));

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
    $seo = new seovs('com_content', '', $seotitle);
    $seo->id = $coid;
    $seo->catid = $cocatid;
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
    $cocatid = intval(mosGetParam($_POST, 'cocatid', 0));
    $cotitle = mosGetParam($_POST, 'cotitle', '');

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
    $seo = new seovs('com_content', $cotitle);
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