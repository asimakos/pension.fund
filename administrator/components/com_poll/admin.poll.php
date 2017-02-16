<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Poll
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
		| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_poll' ))) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$cid 	= mosGetParam( $_REQUEST, 'cid', array(0) );
if (!is_array( $cid )) {
	$cid = array(0);
}

//in order to work direct edit poll link with register_globals off
$id = mosGetParam( $_REQUEST, 'id', '0' );

switch( $task ) {
	case 'new':
		editPoll( 0 );
		break;
	case 'edit':
		editPoll( $cid[0] );
		break;
	case 'editA':
		editPoll( $id );
		break;
	case 'save':
		savePoll();
		break;
	case 'remove':
		removePoll( $cid );
		break;
	case 'publish':
		publishPolls( $cid, 1 );
		break;
	case 'unpublish':
		publishPolls( $cid, 0 );
		break;
	case 'cancel':
		cancelPoll();
		break;
	case 'ajaxpub':
        ajaxpublishPoll();
        break;
	case 'ajaxlock':
        ajaxlockPoll();
        break;
    case 'setaccess':
        $access = intval(mosGetParam( $_REQUEST, 'access', 29 ));
        $sid = intval(mosGetParam( $_REQUEST, 'sid', 0));
		pollAccess( $sid, $access );
		break;
	case 'validate':
	   validateSEO();
	break;
	case 'suggest':
	   suggestSEO();
	break;
	default:
		showPolls( $option );
		break;
}


/****************************/
/* PREPARE TO DISPLAY POLLS */
/****************************/
function showPolls( $option ) {
	global $database, $mainframe, $mosConfig_list_limit, $mosConfig_pub_langs, $adminLanguage;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );
    $filter_lang = trim( strtolower(mosGetParam( $_REQUEST, 'filter_lang', '' )));

    $formfilters = array(
        'filter_lang' => $filter_lang
    );

    if ( $filter_lang != '' ) {
		$filter = "\n WHERE ((p.language LIKE '%$filter_lang%') OR (p.language IS NULL))";
	} else {
	    $filter = '';
	}

	$database->setQuery( "SELECT COUNT(*) FROM #__polls".$filter );
	$total = $database->loadResult();

	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

    $query = "SELECT p.*, g.name AS groupname FROM #__polls p"
    ."\n INNER JOIN #__core_acl_aro_groups g ON g.group_id = p.access"
    .$filter;
    $database->setQuery( $query, '#__', $pageNav->limit, $pageNav->limitstart );
	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

    if ($rows) {
        foreach ($rows as $row) {
            if ($row->checked_out) {
                $database->setQuery("SELECT name FROM #__users WHERE id = '$row->checked_out'", '#__', 1, 0);
                $row->editor = $database->loadResult();
            } else {
                $row->editor = null;
            }
            $database->setQuery("SELECT COUNT(id) FROM #__poll_data WHERE pollid='$row->id' AND text <> ''");
            $row->numoptions = intval($database->loadResult());
        }
    }

    // get list of enabled languages for dropdown filter
    $plangs[] = mosHTML::makeOption( '',$adminLanguage->A_ALL_LANGS );
    $publs = explode(',', $mosConfig_pub_langs);
    foreach ($publs as $publ) {
        $plangs[] = mosHTML::makeOption( $publ, $publ );
    }
	$lists['flangs'] = mosHTML::selectList( $plangs, 'filter_lang', 'class="selectbox" size="1" dir="ltr" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_lang );

	HTML_poll::showPolls( $rows, $pageNav, $lists, $formfilters );
}


/****************************/
/* PREPARE TO ADD/EDIT POLL */
/****************************/
function editPoll( $uid=0 ) {
	global $database, $my, $adminLanguage;

	$row = new mosPoll( $database );
	// load the row from the db table
	$row->load( $uid );

	// fail if checked out not by 'me'
	if ($row->checked_out && $row->checked_out <> $my->id) {
		mosRedirect( 'index2.php?option=com_poll', $adminLanguage->A_CMP_POL_TPOL ." ". $row->title ." ". $adminLanguage->A_ISCEDITANADM );
	}

	$options = array();

	if ($uid) {
		$row->checkout( $my->id );
		$database->setQuery("SELECT id, text FROM #__poll_data WHERE pollid='$uid' ORDER BY id");
		$options = $database->loadObjectList();
	} else {
		$row->lag = 3600*24;
	}

	// get selected pages
	if ( $uid ) {
		$database->setQuery( "SELECT menuid AS value FROM #__poll_menu WHERE pollid='$row->id'" );
		$lookup = $database->loadObjectList();
	} else {
		$lookup = array( mosHTML::makeOption( 0, $adminLanguage->A_ALL ) );
	}

	// build the html select list
	$lists['select'] = mosAdminMenus::MenuLinks( $lookup, 1, 1 );
    // build the html multiple select list for language selection
    $lists['languages']	= mosAdminMenus::SelectLanguages( 'languages', $row->language, $adminLanguage->A_ALL_LANGS );
	// build the html select list for the group access
	$lists['access'] = mosAdminMenus::Access( $row );
	// build the html radio buttons for lock status
	$lists['locked'] = mosHTML::yesnoRadioList( 'locked', '', $row->locked);
	// build the html radio buttons for published
	$lists['published'] = mosHTML::yesnoRadioList( 'published', 'class="inputbox"', $row->published );

	HTML_poll::editPoll($row, $options, $lists );
}


/*************/
/* SAVE POLL */
/*************/
function savePoll() {
	global $database, $my, $mainframe;

    foreach ($_POST['languages'] as $xlang) {
    	if (trim($xlang) == '') { $newlangs = ''; }
    }
    if (!isset($newlangs)) {
    	$newlangs = implode(',', $_POST['languages']);
    }
    $_POST['language'] = $newlangs;

	// save the poll parent information
	$row = new mosPoll( $database );
	if (!$row->bind( $_POST )) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>"._LEND;
		exit();
	}
	$isNew = ($row->id == 0);

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
    $seo = new seovs('com_poll', '', $row->seotitle);
    $seo->id = intval($row->id);
    $seoval = $seo->validate();
    if (!$seoval) {
		echo "<script type=\"text/javascript\">alert('".$seo->message."'); window.history.go(-1);</script>"._LEND;
		exit();
    }

	if (!$row->check()) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>"._LEND;
		exit();
	}

	if (!$row->store()) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>"._LEND;
		exit();
	}

    if ($row->id == 0 || $row->id == '') { //solves problems with postgres
        $database->setQuery( "SELECT id FROM #__polls WHERE title='$row->title'");
        $row->id = intval($database->loadResult());
    }

	$row->checkin();

	//save the poll options
	$options = mosGetParam( $_POST, 'polloption', array() );
	foreach ($options as $i=>$text) {
		//'slash' the options
		if (!get_magic_quotes_gpc()) {
			$text = addslashes( $text );
		}
        if (trim($text) == '') { //postgres compatibility
            $what = 'NULL';
        } else {
            $what = "'$text'";
        }
		if ($isNew) {
			$database->setQuery( "INSERT INTO #__poll_data (pollid,text) VALUES ($row->id,$what)" );
			$database->query();
		} else {
			$database->setQuery( "UPDATE #__poll_data SET text=$what WHERE id='$i' AND pollid='$row->id'" );
			$database->query();
		}
	}

	//update the menu visibility
	$selections = mosGetParam( $_POST, 'selections', array() );
	$database->setQuery( "DELETE FROM #__poll_menu WHERE pollid='$row->id'" );
	$database->query();

	for ($i=0, $n=count($selections); $i < $n; $i++) {
		$database->setQuery( "INSERT INTO #__poll_menu (pollid,menuid) VALUES ($row->id, $selections[$i])" );
		$database->query();
	}

	mosRedirect( 'index2.php?option=com_poll' );
}


/*****************/
/* REMOVE A POLL */
/*****************/
function removePoll( $cid ) {
	global $database;
	$msg = '';
	for ($i=0, $n=count($cid); $i < $n; $i++) {
		$poll = new mosPoll( $database );
		if (!$poll->delete( $cid[$i] )) {
			$msg .= $poll->getError();
		}
	}
	mosRedirect( 'index2.php?option=com_poll', $msg );
}


/*****************************************/
/* PUBLISH / UNPUBLISH ONE OR MORE POLLS */
/*****************************************/
function publishPolls( $cid=null, $publish=1 ) {
	global $database, $my, $adminLanguage;

	$catid = mosGetParam( $_POST, 'catid', array(0) );

	if (!is_array( $cid ) || count( $cid ) < 1) {
		$action = $publish ? $adminLanguage->A_PUBLISH : $adminLanguage->A_UNPUBLISH;
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_SELITEMTO ." ". $action ."\"); window.history.go(-1);</script>\n";
		exit();
	}

	$cids = implode( ',', $cid );

	$query = "UPDATE #__polls SET published='$publish'"
	. "\n WHERE id IN ($cids)"
	. "\n AND ( checked_out=0 OR ( checked_out='$my->id' ) )"
	;
	$database->setQuery( $query );
	if (!$database->query()) {
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosPoll( $database );
		$row->checkin( $cid[0] );
	}
	mosRedirect( 'index2.php?option=com_poll' );
}


/********************/
/* CANCEL EDIT POLL */
/********************/
function cancelPoll() {
	global $database;
	$row = new mosPoll( $database );
	$row->bind( $_POST );
	$row->checkin();
	mosRedirect( 'index2.php?option=com_poll' );
}


/*************************************/
/* PUBLISH/UNPUBLISH POLL USING AJAX */
/*************************************/
function ajaxpublishPoll() {
    global $database, $my, $adminLanguage;

    $elem = intval(mosGetParam($_REQUEST, 'elem', 0));
    $id = intval(mosGetParam($_REQUEST, 'id', 0));
    $state = intval(mosGetParam($_REQUEST, 'state', 0));

    if (!$id) {
        echo '<img src="../includes/js/ThemeOffice/warning.png" width="16" height="16" border="0" title="'.$adminLanguage->A_ERROR.': Invalid Item id" />'._LEND;
        exit();
    }

    $error = 0;
	$database->setQuery( "UPDATE #__polls SET published='$state' WHERE id='$id' AND (checked_out=0 OR (checked_out='".$my->id."'))");
	if (!$database->query()) { $error = 1; }

    if ($error) { $state = $state ? 0 : 1; }
    $img = $state ? 'publish_g.png' : 'publish_x.png';
    $alt = $state ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
?>
	<a href="javascript:;" 
    onclick="changePollState('<?php echo $elem; ?>', '<?php echo $id; ?>', '<?php echo ($state) ? 0 : 1; ?>');" title="<?php echo $alt; ?>">
	<img src="images/<?php echo $img; ?>" border="0" alt="<?php echo $alt; ?>" /></a>
<?php 
    exit();
}


/*******************************/
/* LOCK/UNLOCK POLL USING AJAX */
/*******************************/
function ajaxlockPoll() {
    global $database, $my, $adminLanguage;

    $elem = intval(mosGetParam($_REQUEST, 'elem', 0));
    $id = intval(mosGetParam($_REQUEST, 'id', 0));
    $state = intval(mosGetParam($_REQUEST, 'state', 0));

    if (!$id) {
        echo '<img src="../includes/js/ThemeOffice/warning.png" width="16" height="16" border="0" title="'.$adminLanguage->A_ERROR.': Invalid Item id" />'._LEND;
        exit();
    }

    $error = 0;
	$database->setQuery( "UPDATE #__polls SET locked='$state' WHERE id='$id' AND (checked_out=0 OR (checked_out='".$my->id."'))");
	if (!$database->query()) { $error = 1; }

    if ($error) { $state = $state ? 0 : 1; }
    $img = $state ? 'tick.png' : 'publish_x.png';
    $alt = $state ? $adminLanguage->A_CMP_POL_LOCK : $adminLanguage->A_CMP_POL_UNLOCK;
?>
	<a href="javascript:;" 
    onclick="changePollLock('<?php echo $elem; ?>', '<?php echo $id; ?>', '<?php echo ($state) ? 0 : 1; ?>');" title="<?php echo $alt; ?>">
	<img src="images/<?php echo $img; ?>" border="0" alt="<?php echo $alt; ?>" /></a>
<?php 
    exit();
}


/*************************/
/* SET ACCESS FOR A POLL */
/*************************/
function pollAccess( $uid, $access ) {
	global $database, $my;

	$row = new mosPoll( $database );
	$row->load( $uid );
	if ($row->id && (!$row->checked_out || ($row->checked_out == $my->id))) {
	   $row->access = $access;
	   if ( $row->check() ) {
	       $row->store();
	    }
	}
	mosRedirect( 'index2.php?option=com_poll' );
}


/**********************/
/* VALIDATE SEO TITLE */
/**********************/
function validateSEO() {
    global $mainframe;

    $coid = intval(mosGetParam($_POST, 'coid', 0));    
    $seotitle = eUTF::utf8_trim(mosGetParam($_POST, 'seotitle', ''));

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
    $seo = new seovs('com_poll', '', $seotitle);
    $seo->id = $coid;
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
    $cotitle = mosGetParam($_POST, 'cotitle', '');

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
    $seo = new seovs('com_poll', $cotitle);
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