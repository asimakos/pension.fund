<?php 
/**
* @version: $Id: admin.banners.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Banners
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//ensure user has access to this function
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' ) || $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_banners' ))) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$cid = mosGetParam( $_REQUEST, 'cid', array(0) );
if (!is_array( $cid )) {
	$cid = array(0);
}
$id = mosGetParam( $_REQUEST, 'id', '0' );

switch ($task) {
	case 'newclient':
	editBannerClient( 0, $option );
	break;
	case 'editclient':
	editBannerClient( $cid[0], $option );
	break;
	case 'editclientA':
	editBannerClient( $id, $option );
	break;
	case 'saveclient':
	saveBannerClient( $option );
	break;
	case 'removeclients':
	removeBannerClients( $cid, $option );
	break;
	case 'cancelclient':
	cancelEditClient( $option );
	break;
	case 'listclients':
	viewBannerClients( $option );
	break;
	// BANNER EVENTS
	case 'new':
	editBanner( null, $option);
	break;
	case 'cancel':
	cancelEditBanner( $option);
	break;
	case 'save':
	case 'resethits':
	saveBanner( $task );
	break;
	case 'edit':
	editBanner( $cid[0], $option);
	break;
	case 'editA':
	editBanner( $id, $option );
	break;
	case 'remove':
	removeBanner( $cid, $option);
	break;
	case 'publish':
	publishBanner( $cid,1,$option);
	break;
	case 'unpublish':
	publishBanner( $cid, 0, $option);
	break;
	case 'ajaxpub':
    ajaxpublishBan();
    break;
	default:
	viewBanners( $option );
	break;
}


/***************************/
/* PREPARE TO VIEW BANNERS */
/***************************/
function viewBanners( $option ) {
	global $database, $mainframe, $mosConfig_list_limit, $adminLanguage;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "viewban{$option}limitstart", 'limitstart', 0 );
    $filter_cid = intval(mosGetParam( $_REQUEST, 'filter_cid', 0 ));
	
    $formfilters = array( 'filter_cid' => $filter_cid );

    $where = ($filter_cid) ? " WHERE b.cid='$filter_cid'" : '';

	//get the total number of records
	$database->setQuery( "SELECT COUNT(*) FROM #__banner b".$where);
	$total = $database->loadResult();

	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	$query = "SELECT b.bid, b.imptotal, b.impmade, b.clicks, b.showbanner, b.checked_out, b.name,"
	."\n u.name AS editor, c.name AS client FROM #__banner b"
	."\n LEFT JOIN #__users u ON u.id = b.checked_out"
	."\n LEFT JOIN #__bannerclient c ON c.cid = b.cid".$where;

	$database->setQuery($query, '#__', $pageNav->limit, $pageNav->limitstart);
	if(!$result = $database->query()) {
		echo $database->stderr();
		return;
	}
	$rows = $database->loadObjectList();

	$clients[] = mosHTML::makeOption( '0', $adminLanguage->A_ALL );
	$database->setQuery( "SELECT cid AS value, name AS text FROM #__bannerclient ORDER BY name" );
    $clients = array_merge( $clients, $database->loadObjectList() );

	$lists['cid'] = mosHTML::selectList( $clients, 'filter_cid', 'class="selectbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $filter_cid );

	HTML_banners::showBanners( $rows, $pageNav, $option, $lists, $formfilters );
}


/******************************/
/* PREPARE TO ADD/EDIT BANNER */
/******************************/
function editBanner( $bannerid, $option ) {
	global $database, $mainframe, $my, $adminLanguage;

	$lists = array();

	$row = new mosBanner($database);
	if ( !$bannerid ) {
		$row->load('0');
	} else {
		$row->load( $bannerid );
		$row->checkout( $my->id );
	}

	//Build Client select list
	$database->setQuery("SELECT cid as value, name as text FROM #__bannerclient");
	if (!$database->query()) {
		echo $database->stderr();
		return;
	}

	$clientlist[] = mosHTML::makeOption( '0', $adminLanguage->A_CMP_BANN_SELCL );
	$clientlist = array_merge( $clientlist, $database->loadObjectList() );
	$lists['cid'] = mosHTML::selectList( $clientlist, 'cid', 'class="selectbox" size="1"','value', 'text', $row->cid);

	//Imagelist
	$javascript = 'dir="ltr" onchange="changeDisplayImage();"';
	$directory = SEP.'images'.SEP.'banners';
	$lists['imageurl'] = mosAdminMenus::Images( 'imageurl', $row->imageurl, $javascript, $directory );

	//make the select list for the image positions
	$yesno[] = mosHTML::makeOption( '0', $adminLanguage->A_NO );
    $yesno[] = mosHTML::makeOption( '1', $adminLanguage->A_YES );
  	$lists['showbanner'] = mosHTML::selectList( $yesno, 'showbanner', 'class="selectbox" size="1"' , 'value', 'text', $row->showbanner );

	//make the select list for link target
	$targetlist[] = mosHTML::makeOption( '0', _GEM_PARNAV );
	$targetlist[] = mosHTML::makeOption( '1', _GEM_NEWNAV );
	$lists['targetbanner'] = mosHTML::selectList( $targetlist, 'targetbanner', 'class="selectbox" size="1"' , 'value', 'text', $row->targetbanner );

	HTML_banners::bannerForm( $row, $lists, $option );
}


/***************/
/* SAVE BANNER */
/***************/
function saveBanner( $task ) {
	global $database, $adminLanguage, $mainframe;

	$row = new mosBanner($database);
    if ($_POST['imptotal'] == '') { $_POST['imptotal'] = '0'; }
    if ($_POST['clicks'] == '') { $_POST['clicks'] = '0'; }
    if ($_POST['checked_out'] == '') { $_POST['checked_out'] = '0'; }
    if (isset($_POST['unlimited'])) { $_POST['imptotal'] = '0'; }
    if (intval($_POST['imptotal']) > 0) {
        if (intval($_POST['imptotal']) <= intval($_POST['impmade'])) {
            $_POST['showbanner'] = '0';
        }
    }

	$msg = $adminLanguage->A_CMP_BANN_MSGSA;
	if ( $task == 'resethits' ) {
		$row->clicks = 0;
		$msg = $adminLanguage->A_CMP_BANN_MSGRC;
	}
	if (!$row->bind( $_POST )) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}
	if (!$row->check()) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}
	if (!$row->store()) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}
	$row->checkin();

	mosRedirect( 'index2.php?option=com_banners', $msg );
}


/**********************/
/* CANCEL EDIT BANNER */
/**********************/
function cancelEditBanner() {
	global $database;

	$row = new mosBanner($database);
	$row->bind( $_POST );
	$row->checkin();

	mosRedirect( 'index2.php?option=com_banners' );
}


/******************/
/* PUBLISH BANNER */
/******************/
function publishBanner( $cid, $publish=1 ) {
	global $database, $my, $adminLanguage, $mainframe;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		$action = $publish ? 'publish' : 'unpublish';
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_SELITEMTO." ".$action."'); window.history.go(-1);</script>\n";
		exit();
	}

	$cids = implode( ',', $cid );

    $query = "UPDATE #__banner SET showbanner='$publish'"
	."\n WHERE bid IN ($cids) AND (checked_out=0 OR (checked_out='$my->id'))";
    if ($publish == 1) {
	   $query .= "\n AND (imptotal=0 OR (imptotal>impmade))";
    }
    $database->setQuery($query);

	if (!$database->query()) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosBanner( $database );
		$row->checkin( $cid[0] );
	}
	mosRedirect( 'index2.php?option=com_banners' );
}


/*****************************************/
/* PUBLISH / UNPUBLISH BANNER USING AJAX */
/*****************************************/
function ajaxpublishBan() {
    global $database, $my, $adminLanguage;

    $elem = intval(mosGetParam($_REQUEST, 'elem', 0));
    $id = intval(mosGetParam($_REQUEST, 'id', 0));
    $state = intval(mosGetParam($_REQUEST, 'state', 0));

    if (!$id) {
        echo '<img src="../includes/js/ThemeOffice/warning.png" width="16" height="16" border="0" title="'.$adminLanguage->A_ERROR.': Invalid Banner id" />'._LEND;
        exit();
    }

    $error = 0;
	$database->setQuery( "UPDATE #__banner SET showbanner='$state' WHERE bid='$id' AND (checked_out=0 OR (checked_out='".$my->id."'))");
	if (!$database->query()) { $error = 1; }

    if ($error) { $state = $state ? 0 : 1; }
    $img = $state ? 'publish_g.png' : 'publish_x.png';
    $alt = $state ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
?>
	<a href="javascript:void(0);" 
    onclick="changeBannerState('<?php echo $elem; ?>', '<?php echo $id; ?>', '<?php echo ($state) ? 0 : 1; ?>');" title="<?php echo $alt; ?>">
	<img src="images/<?php echo $img; ?>" border="0" alt="<?php echo $alt; ?>" /></a>
<?php 
    exit();
}


/******************/
/* DELETE BANNERS */
/******************/
function removeBanner( $cid ) {
	global $database, $mainframe;

	if (count( $cid )) {
		$cids = implode( ',', $cid );
		$database->setQuery( "DELETE FROM #__banner WHERE bid IN ($cids)" );
		if (!$database->query()) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		}
	}
	mosRedirect( 'index2.php?option=com_banners' );
}


/**********************************/
/* PREPARE TO VIEW BANNER CLIENTS */
/**********************************/
function viewBannerClients( $option ) {
	global $database, $mainframe, $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "viewcli{$option}limitstart", 'limitstart', 0 );

	//get the total number of records
	$database->setQuery( "SELECT COUNT(*) FROM #__bannerclient" );
	$total = $database->loadResult();

	require_once( $GLOBALS['mosConfig_absolute_path'].'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	$query = "SELECT a.cid, a.name, a.contact, a.checked_out, a.checked_out_time, u.name AS editor FROM #__bannerclient a"
	."\n LEFT JOIN #__users u ON u.id = a.checked_out"
	."\n GROUP BY a.cid, a.name, a.contact, a.email, a.extrainfo, a.checked_out, a.checked_out_time, a.editor, u.name";
	$database->setQuery($query, '#__', $pageNav->limit, $pageNav->limitstart);

	if(!$result = $database->query()) {
		echo $database->stderr();
		return;
	}
	$rows = $database->loadObjectList();

    if (count($rows) > 0) {
        for ($i=0; $i < count($rows); $i++) {
            $row = &$rows[$i];
            $database->setQuery("SELECT count(bid) FROM #__banner WHERE cid='$row->cid' AND showbanner='1'");
            $rows[$i]->bid = intval($database->loadResult());
        }
    }

	HTML_bannerClient::showClients($rows, $pageNav, $option);
}


/*************************************/
/* PREPARE TO ADD/EDIT BANNER CLIENT */
/*************************************/
function editBannerClient( $clientid, $option ) {
	global $database, $my, $adminLanguage;

	$row = new mosBannerClient($database);
	$row->load($clientid);

	//fail if checked out not by 'me'
	if ($row->checked_out && ($row->checked_out <> $my->id)) {
		mosRedirect( 'index2.php?option='.$option.'&task=listclients', 'Client [ '.$row->name.' ] '.$adminLanguage->A_ISCEDITANADM );
	}

	if ($clientid) { //existing record
		$row->checkout( $my->id );
	} else {
		$row->published = 0;
		$row->approved = 0;
	}

	HTML_bannerClient::bannerClientForm( $row, $option );
}


/**********************/
/* SAVE BANNER CLIENT */
/**********************/
function saveBannerClient( $option ) {
	global $database, $mainframe;

	$row = new mosBannerClient( $database );
	if (!$row->bind( $_POST )) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}
	if (!$row->check()) {
		mosRedirect( "index2.php?option=$option&task=editclient&cid[]=$row->id", $database->getErrorMsg() );
	}
	if (!$row->store()) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}
	$row->checkin();

	mosRedirect( "index2.php?option=$option&task=listclients" );
}


/**********************/
/* CANCEL EDIT CLIENT */
/**********************/
function cancelEditClient( $option ) {
	global $database;
	$row = new mosBannerClient( $database );
	$row->bind( $_POST );
	$row->checkin();
	mosRedirect( 'index2.php?option='.$option.'&task=listclients' );
}


/*************************/
/* DELETE BANNER CLIENTS */
/*************************/
function removeBannerClients( $cid, $option ) {
	global $database, $adminLanguage, $mainframe;

	for ($i = 0; $i < count($cid); $i++) {
		$query = "SELECT COUNT(bid) FROM #__banner WHERE cid='".$cid[$i]."'";
		$database->setQuery($query);

		if(($count = $database->loadResult()) == null) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
			exit();
		}
		if (intval($count) > 0) {
			mosRedirect( "index2.php?option=$option&task=listclients", $adminLanguage->A_CMP_BANN_DELCL );
		} else {
			$query="DELETE FROM #__bannerclient WHERE cid='".$cid[$i]."'";
			$database->setQuery($query);
			$database->query();
		}
	}
	mosRedirect('index2.php?option='.$option.'&task=listclients');
}

?>