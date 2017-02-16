<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Weblinks
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
		| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_weblinks' ))) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$cid = mosGetParam( $_POST, 'cid', array(0) );
$id = intval(mosGetParam( $_REQUEST, 'id', '0' ));

switch ($task) {
	case 'new':
		editWeblink( $option, 0 );
	break;
	case 'edit':
		editWeblink( $option, $cid[0] );
	break;
	case 'editA':
		editWeblink( $option, $id );
	break;
	case 'save':
	case 'apply':
		saveWeblink($task);
	break;
	case 'remove':
		removeWeblinks( $cid );
	break;
	case 'publish':
		publishWeblinks( $cid, 1, $option );
	break;
	case 'unpublish':
		publishWeblinks( $cid, 0, $option );
	break;
	case 'ajaxpub':
		ajaxpublishWeb();
	break;
	case 'approve':
	break;
	case 'cancel':
		cancelWeblink();
	break;
	case 'orderup':
		orderWeblinks( $cid[0], -1, $option );
	break;
	case 'orderdown':
		orderWeblinks( $cid[0], 1, $option );
	break;
    case 'ajaxscr':
        ajaxScreenshot();
    break;
	default:
		showWeblinks( $option );
	break;
}


/****************************/
/* PREPARE TO LIST WEBLINKS */
/****************************/
function showWeblinks( $option ) {
	global $database, $mainframe, $mosConfig_list_limit, $mosConfig_pub_langs, $adminLanguage;

	$catid = $mainframe->getUserStateFromRequest( "catid{$option}", 'catid', 0 );
	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );
	$search = $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
	$search = $database->getEscaped( eUTF::utf8_trim( eUTF::utf8_strtolower( $search ) ) );
    $filter_lang = trim( strtolower(mosGetParam( $_REQUEST, 'filter_lang', '' )));

    $formfilters = array(
        'catid' => $catid,
        'filter_lang' => $filter_lang
    );

	$where = array();

	if ($catid > 0) {
		$where[] = "a.catid='$catid'";
	}
	if ($search) {
		$where[] = "LOWER(a.title) LIKE '%$search%'";
	}
    if ( $filter_lang != '' ) {
		$where[] = "((a.language LIKE '%$filter_lang%') OR (a.language IS NULL))";
	}

	//get the total number of records
	$database->setQuery( "SELECT count(*) FROM #__weblinks a"
		. (count( $where ) ? "\n WHERE ".implode( ' AND ', $where ) : "")
	);
	$total = $database->loadResult();

	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$query = "SELECT a.*, cc.name AS category, cc.language AS category_lang, u.name AS editor"
	."\n FROM #__weblinks a"
	."\n LEFT JOIN #__categories cc ON cc.id = a.catid"
	."\n LEFT JOIN #__users u ON u.id = a.checked_out"
	.( count( $where ) ? "\n WHERE ".implode( ' AND ', $where ) : "")
	."\n ORDER BY a.catid, a.ordering";
	$database->setQuery( $query, '#__', $pageNav->limit, $pageNav->limitstart );

	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	//build list of categories
	$javascript = 'onchange="document.adminForm.submit();"';
	$lists['catid'] = mosAdminMenus::ComponentCategory( 'catid', $option, intval( $catid ), $javascript );

    //get list of enabled languages for dropdown filter
    $plangs[] = mosHTML::makeOption( '',$adminLanguage->A_ALL_LANGS );
    $publs = explode(',', $mosConfig_pub_langs);
    foreach ($publs as $publ) {
        $plangs[] = mosHTML::makeOption( $publ, $publ );
    }
	$lists['flangs'] = mosHTML::selectList( $plangs, 'filter_lang', 'class="selectbox" size="1" dir="ltr" onchange="document.adminForm.submit();"', 'value', 'text', $filter_lang );

	HTML_weblinks::showWeblinks( $option, $rows, $lists, $search, $pageNav, $formfilters );
}


/*******************************/
/* PREPARE TO ADD/EDIT WEBLINK */
/*******************************/
function editWeblink( $option, $id ) {
	global $database, $my, $mainframe, $adminLanguage;

	$lists = array();

	$row = new mosWeblink( $database );
	//load the row from the db table
	$row->load( $id );

	//fail if checked out not by 'me'
	if ($row->checked_out && $row->checked_out <> $my->id) {
		mosRedirect( 'index2.php?option='.$option, $adminLanguage->A_THEMODULE.' '.$row->title.' '.$adminLanguage->A_ISCEDITANADM );
	}

	if ($id) {
		$row->checkout( $my->id );
	} else {
		$row->published = 1;
		$row->approved = 1;
		$row->order = 0;
		$row->catid = intval(mosGetParam( $_POST, 'catid', 0 ));
	}

	//build the html select list for ordering
	$query = "SELECT ordering AS value, title AS text FROM #__weblinks"
	."\n WHERE catid='$row->catid' ORDER BY ordering";
	$lists['ordering'] = mosAdminMenus::SpecificOrdering( $row, $id, $query, 1 );

	//build list of categories
	$lists['catid'] = mosAdminMenus::ComponentCategory( 'catid', $option, intval( $row->catid ) );
	//build the html select list
	$lists['approved'] = mosHTML::yesnoRadioList( 'approved', 'class="inputbox"', $row->approved );
	//build the html select list
	$lists['published'] = mosHTML::yesnoRadioList( 'published', 'class="inputbox"', $row->published );
	//Imagelist
	$lists['image'] = mosAdminMenus::Images( 'image', $row->screenshot, NULL , '/images/screenshots' );
    //build the html multiple select list for language selection
    $lists['languages']	= mosAdminMenus::SelectLanguages( 'languages', $row->language, $adminLanguage->A_ALL_LANGS );

	$file = $mainframe->getCfg('absolute_path').'/administrator/components/com_weblinks/weblinks_item.xml';
	$params = new mosParameters( $row->params, $file, 'component' );

	HTML_weblinks::editWeblink( $row, $lists, $params, $option, $webscreens );
}


/****************/
/* SAVE WEBLINK */
/****************/
function saveWeblink($task='save') {
	global $database, $my, $mainframe, $fmanager;

    foreach ($_POST['languages'] as $xlang) {
    	if (trim($xlang) == '') { $newlangs = ''; }
    }
    if (!isset($newlangs)) {
    	$newlangs = implode(',', $_POST['languages']);
    }
    $_POST['language'] = $newlangs;

if ($_POST['imgsel'] == '1') {
	$_POST['screenshot'] = $_POST['image'];
} else if ($_POST['imgsel'] == '2') {
    require_once ($mainframe->getCfg('absolute_path').'/administrator/includes/snoopy.class.php');
	$snoopy = new Snoopy;
    $snoopy->maxlength = 80000;
    $snoopy->maxredirs = 1;
    $snoopy->read_timeout =	15;
	$snoopy->timed_out = true;
	$snoopy->_fp_timeout = 15;

	$snoopy->fetch($_POST['webscreen']);
	$tmpfname = tempnam($mainframe->getCfg('absolute_path').'/images/screenshots/', 'ss_');

    //use file manager
    $newfname = preg_replace('/(.tmp)$/', '.jpeg', $tmpfname); //mostly windows
    if (!preg_match('/([\.]jpeg)$/', $newfname)) { $newfname .= '.jpeg'; } //unix fix

    $fmanager->createFile($newfname, $snoopy->results, false);
    $fmanager->deleteFile($tmpfname);

    $_POST['screenshot'] = basename($newfname);
} else { $_POST['screenshot'] = ''; }

	$row = new mosWeblink( $database );
	if (trim($_POST['ordering']) == '') { $_POST['ordering'] = '99'; }

	if (!$row->bind( $_POST )) {
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

	$row->date = date( "Y-m-d H:i:s" );
	if (!$row->check()) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}
	if (!$row->store()) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}
	$row->checkin();
	$row->updateOrder( "catid='$row->catid'" );

	if ($task == 'apply') {
		mosRedirect('index2.php?option=com_weblinks&task=editA&hidemainmenu=1&id='.$row->id);
	} else {
		mosRedirect('index2.php?option=com_weblinks');
	}
}


/*******************/
/* DELETE WEBLINKS */
/*******************/
function removeWeblinks( $cid ) {
	global $database, $adminLanguage;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_ALERT_SELECT_DELETE ."\"); window.history.go(-1);</script>\n";
		exit();
	}
	if (count( $cid )) {
		$cids = implode( ',', $cid );
		$database->setQuery( "DELETE FROM #__weblinks WHERE id IN ($cids)" );
		if (!$database->query()) {
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
			exit();
		}
	}

	mosRedirect( 'index2.php?option=com_weblinks' );
}


/******************************/
/* PUBLISH/UNPUBLISH WEBLINKS */
/******************************/
function publishWeblinks( $cid=null, $publish=1,  $option ) {
	global $database, $my, $adminLanguage;

	$catid = mosGetParam( $_POST, 'catid', array(0) );

	if (!is_array( $cid ) || count( $cid ) < 1) {
		$action = $publish ? 'publish' : 'unpublish';
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_SELITEMTO ." ". $action ."\"); window.history.go(-1);</script>\n";
		exit;
	}

	$cids = implode( ',', $cid );

	$database->setQuery( "UPDATE #__weblinks SET published='$publish'"
		. "\nWHERE id IN ($cids) AND (checked_out=0 OR (checked_out='$my->id'))"
	);
	if (!$database->query()) {
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosWeblink( $database );
		$row->checkin( $cid[0] );
	}
	mosRedirect( "index2.php?option=$option" );
}


/************************/
/* AJAX PUBLISH WEBLINK */
/************************/
function ajaxpublishWeb() {
    global $database, $my, $adminLanguage;

    $elem = intval(mosGetParam($_REQUEST, 'elem', 0));
    $id = intval(mosGetParam($_REQUEST, 'id', 0));
    $state = intval(mosGetParam($_REQUEST, 'state', 0));

    if (!$id) {
        echo '<img src="../includes/js/ThemeOffice/warning.png" width="16" height="16" border="0" title="'.$adminLanguage->A_ERROR.': Invalid Item id" />'._LEND;
        exit();
    }

    $error = 0;
	$database->setQuery( "UPDATE #__weblinks SET published='$state' WHERE id='$id' AND (checked_out=0 OR (checked_out='".$my->id."'))");
	if (!$database->query()) { $error = 1; }

    if ($error) { $state = $state ? 0 : 1; }
    $img = $state ? 'publish_g.png' : 'publish_x.png';
    $alt = $state ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
?>
	<a href="javascript: void(0);" 
    onclick="changeWebState('<?php echo $elem; ?>', '<?php echo $id; ?>', '<?php echo ($state) ? 0 : 1; ?>');">
	<img src="images/<?php echo $img; ?>" width="12" height="12" border="0" title="<?php echo $alt; ?>" /></a>
<?php 
    exit();
}


/*********************/
/* RE-ORDER WEBLINKS */
/*********************/
function orderWeblinks( $uid, $inc, $option ) {
	global $database;

	$row = new mosWeblink( $database );
	$row->load( $uid );
	$row->move( $inc, "published >= 0" );

	mosRedirect( "index2.php?option=$option" );
}


/***********************/
/* CANCEL EDIT WEBLINK */
/***********************/
function cancelWeblink() {
	global $database;

	$row = new mosWeblink( $database );
	$row->bind( $_POST );
	$row->checkin();
	mosRedirect( 'index2.php?option=com_weblinks' );
}


/********************/
/* FETCH SCREENSHOT */
/********************/
function ajaxScreenshot() {
    global $mainframe, $adminLanguage;

    $SCR_SUBMIT = intval(mosGetParam( $_REQUEST, 'SCR_SUBMIT', '0' ));
    $SCR_URL = trim(mosGetParam( $_REQUEST, 'SCR_URL', '' ));

    if (($SCR_SUBMIT < 1) || ($SCR_SUBMIT >6)) {
        die($adminLanguage->A_CMP_WBL_INVSOURCE);
    }
    if ((strlen($SCR_URL) <12) || (!preg_match('/^(http)/i', $SCR_URL)) || (!preg_match('/\./', $SCR_URL))) {
        die($adminLanguage->A_CMP_WBL_INVURL);
    }

    if (!$SCR_SUBMIT) { die($adminLanguage->A_CMP_WBL_INVSOURCE); }

    $wflag = is_writable($mainframe->getCfg('absolute_path').'/images/screenshots/');
    require_once ($mainframe->getCfg('absolute_path').'/administrator/includes/snoopy.class.php');
	$snoopy = new Snoopy;
    $snoopy->maxlength = 100000;
    $snoopy->maxredirs = 1;
    $snoopy->read_timeout =	15;
	$snoopy->timed_out = true;
	$snoopy->_fp_timeout = 15;

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/screenshot.class.php');

    $screen = new getscreenshot($SCR_URL,$SCR_SUBMIT, $snoopy);
    $scr_shot = $screen->screenshot();

    if ($scr_shot) {
        echo $scr_shot."<br />\n";
        echo $adminLanguage->A_CMP_WBL_SCRRECFROM." <b>".$screen->proname."</b><br />\n";
        if ($wflag == true) { 
            echo '<input type="hidden" name="webscreen" value="'.$screen->imgurl.'" />';
            echo "\n";
        } else {
            echo $adminLanguage->A_CMP_WBL_DIRNOWRITE;
        }
    } else {
        echo '<img src="'.$mainframe->getCfg('live_site').'/administrator/images/ss_not_available.jpg" border="0" title="not available" /><br />';
    }
    exit();
}

?>