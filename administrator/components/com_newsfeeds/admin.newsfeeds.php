<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Newsfeeds
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//ensure user has access to this function
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
		| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_newsfeeds' ))) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$task = mosGetParam( $_REQUEST, 'task', array(0) );
$cid = mosGetParam( $_POST, 'cid', array(0) );
$id = intval(mosGetParam( $_GET, 'id', 0 ));
if (!is_array( $cid )) {
	$cid = array(0);
}

switch ($task) {

	case 'new':
		editNewsFeed( 0, $option );
	break;
	case 'edit':
		editNewsFeed( $cid[0], $option );
	break;
	case 'editA':
		editNewsFeed( $id, $option );
	break;
	case 'save':
		saveNewsFeed( $option );
	break;
	case 'publish':
		publishNewsFeeds( $cid, 1, $option );
	break;
	case 'unpublish':
		publishNewsFeeds( $cid, 0, $option );
	break;
	case 'ajaxpub':
	    ajaxpubFeeds();
    break;
	case 'remove':
		removeNewsFeeds( $cid, $option );
	break;
	case 'cancel':
		cancelNewsFeed();
	break;
	case 'orderup':
		orderNewsFeed( $cid[0], -1 );
	break;
	case 'orderdown':
		orderNewsFeed( $cid[0], 1 );
	break;
	case 'validate':
        validateFeedSEO();
	break;
	case 'suggest':
	   suggestFeedSEO();
	break;
	default:
		showNewsFeeds( $option );
	break;
}


/*****************************/
/* PREPARE TO LIST NEWSFEEDS */
/*****************************/
function showNewsFeeds( $option ) {
	global $database, $mainframe, $mosConfig_list_limit;

	$catid = $mainframe->getUserStateFromRequest( "catid{$option}", 'catid', 0 );
	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

    $formfilters = array( 'catid' => $catid );

	//get the total number of records
	$where = ($catid)? "\n WHERE a.catid='$catid'" : '';
	$database->setQuery("SELECT COUNT(*) FROM #__newsfeeds a".$where);
	$total = $database->loadResult();

	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	//get the subset (based on limits) of required records
	$query = "SELECT a.*, c.name AS catname, u.name AS editor"
	."\n FROM #__newsfeeds a"
	."\n LEFT JOIN #__categories c ON c.id = a.catid"
	."\n LEFT JOIN #__users u ON u.id = a.checked_out"
	.$where
	."\n ORDER BY a.ordering";
	$database->setQuery( $query, '#__', $pageNav->limit, $pageNav->limitstart );

	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	//build list of categories
	$javascript = 'onchange="document.adminForm.submit();"';
	$lists['category'] = mosAdminMenus::ComponentCategory( 'catid', $option, $catid, $javascript );

	HTML_newsfeeds::showNewsFeeds( $rows, $lists, $pageNav, $option, $formfilters );
}


/********************************/
/* PREPARE TO ADD/EDIT NEWSFEED */
/********************************/
function editNewsFeed( $id, $option ) {
	global $database, $my;

	$catid = intval( mosGetParam( $_REQUEST, 'catid', 0 ) );

	$row = new mosNewsFeed( $database );
	$row->load( $id );

	if ($id) {
		$row->checkout( $my->id );
	} else {
		$row->ordering = 0;
		$row->numarticles = 5;
		$row->cache_time = 3600;
		$row->published = 1;
	}

	//build the html select list for ordering
	$query = "SELECT ordering AS value, name AS text FROM #__newsfeeds ORDER BY ordering";
	$lists['ordering'] = mosAdminMenus::SpecificOrdering( $row, $id, $query, 1 );
	//build list of categories
	$lists['category'] = mosAdminMenus::ComponentCategory( 'catid', $option, intval( $row->catid ) );
	//build the html select list
	$lists['published'] = mosHTML::yesnoRadioList( 'published', 'class="inputbox"', $row->published );

	HTML_newsfeeds::editNewsFeed( $row, $lists, $option );
}


/*****************/
/* SAVE NEWSFEED */
/*****************/
function saveNewsFeed( $option ) {
	global $database, $my, $adminLanguage, $mainframe;

	$row = new mosNewsFeed( $database );
	if (!$row->bind( $_POST )) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
    $seo = new seovs('com_newsfeeds', '', $row->seotitle);
    $seo->id = intval($row->id);
    $seo->catid = intval($row->catid);
    $seoval = $seo->validate();
    if (!$seoval) {
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_SEOTITLE.": ".$seo->message."'); window.history.go(-1);</script>"._LEND;
		exit();
    }

	if (!$row->check()) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}

	if (!$row->store()) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}
	$row->checkin();
	$row->updateOrder();

	mosRedirect( 'index2.php?option='. $option, $adminLanguage->A_CMP_NFE_SAVEDSUC );
}


/***************************/
/* PUBLISH/UNPUBLISH FEEDS */
/***************************/
function publishNewsFeeds( $cid, $publish, $option ) {
	global $database, $adminLanguage, $my;

	if (count( $cid ) < 1) {
		$action = $publish ? $adminLanguage->A_PUBLISH : $adminLanguage->A_UNPUBLISH;
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_CMP_MDL_SELECT_TO ." ". $action ."\"); window.history.go(-1);</script>\n";
		exit();
	}

	$cids = implode( ',', $cid );

	$query = "UPDATE #__newsfeeds SET published='".$publish."' WHERE id IN ($cids)"
	."\n AND ( checked_out=0 OR checked_out='$my->id' )";
	$database->setQuery( $query );
	if (!$database->query()) {
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosNewsFeed( $database );
		$row->checkin( $cid[0] );
	}
	mosRedirect( 'index2.php?option='. $option );
}


/*******************************/
/* AJAX PUBLISH/UNPUBLISH FEED */
/*******************************/
function ajaxpubFeeds() {
    global $database, $my, $adminLanguage;

    $elem = intval(mosGetParam($_REQUEST, 'elem', 0));
    $id = intval(mosGetParam($_REQUEST, 'id', 0));
    $state = intval(mosGetParam($_REQUEST, 'state', 0));

    if (!$id) {
        echo '<img src="../includes/js/ThemeOffice/warning.png" width="16" height="16" border="0" title="'.$adminLanguage->A_ERROR.': Invalid Item id" />'._LEND;
        exit();
    }

    $error = 0;
	$database->setQuery( "UPDATE #__newsfeeds SET published='$state' WHERE id='$id' AND (checked_out=0 OR (checked_out='".$my->id."'))");
	if (!$database->query()) { $error = 1; }

    if ($error) { $state = $state ? 0 : 1; }
    $img = $state ? 'tick.png' : 'publish_x.png';
    $alt = $state ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
?>
	<a href="javascript: void(0);" 
    onclick="changeFeedState('<?php echo $elem; ?>', '<?php echo $id; ?>', '<?php echo ($state) ? 0 : 1; ?>');">
	<img src="images/<?php echo $img; ?>" width="12" height="12" border="0" title="<?php echo $alt; ?>" /></a>
<?php 
    exit();
}


/********************/
/* DELETE NEWSFEEDS */
/********************/
function removeNewsFeeds( &$cid, $option ) {
	global $database, $adminLanguage;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_CMP_CNT_SELIDEL ."\"); window.history.go(-1);</script>\n";
		exit();
	}
	if (count( $cid )) {
		$cids = implode( ',', $cid );
		$query = "DELETE FROM #__newsfeeds WHERE id IN ($cids) AND checked_out='0'";
		$database->setQuery( $query );
		if (!$database->query()) {
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
			exit();
		}
	}

	mosRedirect( 'index2.php?option='. $option );
}


/************************/
/* CANCEL EDIT NEWSFEED */
/************************/
function cancelNewsFeed() {
	global $database;

	$row = new mosNewsFeed( $database );
	$row->bind( $_POST );
	$row->checkin();
	mosRedirect( 'index2.php?option=com_newsfeeds' );
}


/*********************/
/* RE-ORDER NEWSFEED */
/*********************/
function orderNewsFeed( $id, $inc) {
	global $database;

	$limit = intval(mosGetParam( $_REQUEST, 'limit', 0 ));
	$limitstart = intval(mosGetParam( $_REQUEST, 'limitstart', 0 ));
	$catid = intval(mosGetParam( $_REQUEST, 'catid', 0 ));

	$row = new mosNewsFeed( $database );
	$row->load( $id );
	$row->move( $inc );

	mosRedirect( 'index2.php?option=com_newsfeeds' );
}


/**********************/
/* VALIDATE SEO TITLE */
/**********************/
function validateFeedSEO() {
    global $mainframe, $adminLanguage;

    $coid = intval(mosGetParam($_POST, 'coid', 0));
    $cocatid = intval(mosGetParam($_POST, 'cocatid', 0));
    $seotitle = eUTF::utf8_trim(mosGetParam($_POST, 'seotitle', ''));

    if (!$cocatid) {
        echo $adminLanguage->A_INVALID.', '.$adminLanguage->A_PLSSELECTCAT;
        exit();
    }

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
    $seo = new seovs('com_newsfeeds', '', $seotitle);
    $seo->id = $coid;
    $seo->catid = $cocatid;
    $seo->validate();
    echo $seo->message;
    exit();
}


/*********************/
/* SUGGEST SEO TITLE */
/*********************/
function suggestFeedSEO() {
    global $mainframe;

    $coid = intval(mosGetParam($_POST, 'coid', 0));
    $cocatid = intval(mosGetParam($_POST, 'cocatid', 0));
    $cotitle = mosGetParam($_POST, 'cotitle', '');

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
    $seo = new seovs('com_newsfeeds', $cotitle);
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