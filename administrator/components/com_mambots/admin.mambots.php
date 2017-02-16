<?php 
/**
* @version: $Id: admin.mambots.php 42 2010-06-08 15:17:42Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Bots
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//ensure user has access to this function
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'mambots', 'all' ) 
| $acl->acl_check( 'administration', 'install', 'users', $my->usertype, 'mambots', 'all' ))) {
        mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );

$client = mosGetParam( $_REQUEST, 'client', '' );
$cid = mosGetParam( $_POST, 'cid', array(0) );
if (!is_array( $cid )) { $cid = array(0); }
$id = intval(mosGetParam( $_REQUEST, 'id', '0' ));

switch ( $task ) {
	case 'new':
	case 'edit':
		editMambot( $option, $cid[0], $client );
	break;
	case 'editA':
		editMambot( $option, $id, $client );
	break;
	case 'save':
	case 'apply':
		saveMambot( $option, $client, $task );
	break;
    case 'remove':
        removeMambot( $cid, $option, $client );
    break;
	case 'cancel':
		cancelMambot( $option, $client );
	break;
	case 'publish':
	case 'unpublish':
		publishMambot( $cid, ($task == 'publish'), $option, $client );
	break;
	case 'ajaxpub':
	    ajaxpubBot();
    break;
	case 'orderup':
	case 'orderdown':
		orderMambot( $cid[0], ($task == 'orderup' ? -1 : 1), $option, $client );
	break;
    case 'setaccess':
        $access = mosGetParam( $_REQUEST, 'access', 29 );
        $sid = mosGetParam( $_REQUEST, 'sid', $cid[0] );
		accessMenu( $sid, $access, $option, $client );
	break;
	case 'saveorder':
		saveOrder( $cid );
	break;
	default:
		viewMambots( $option, $client );
	break;
}


/***************************/
/* PREPARE TO LIST MAMBOTS */
/***************************/
function viewMambots( $option, $client ) {
	global $database, $mainframe, $mosConfig_list_limit, $adminLanguage;

	$limit 			= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart 	= $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );
	$filter_type	= $mainframe->getUserStateFromRequest( "filter_type{$option}{$client}", 'filter_type', 0 );
	$search 		= $mainframe->getUserStateFromRequest( "search{$option}{$client}", 'search', '' );
	$search 		= $database->getEscaped( eUTF::utf8_trim( eUTF::utf8_strtolower( $search ) ) );

    $formfilters = array(
        'filter_type' => $filter_type
    );

	if ($client == 'admin') {
		$where[] = "m.client_id = '1'";
		$client_id = 1;
	} else {
		$where[] = "m.client_id = '0'";
		$client_id = 0;
	}

	// used by filter
	if ( $filter_type ) {
		$where[] = "m.folder = '$filter_type'";
	}
	if ( $search ) {
		$where[] = "LOWER( m.name ) LIKE '%$search%'";
	}

	// get the total number of records
	$query = "SELECT COUNT(*) FROM #__mambots m ". ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' );
	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	$query = "SELECT m.*, u.name AS editor, g.name AS groupname FROM #__mambots m"
	. "\n LEFT JOIN #__users u ON u.id = m.checked_out"
	. "\n LEFT JOIN #__core_acl_aro_groups g ON g.group_id = m.access"
	. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' )
	//. "\n GROUP BY m.id"
	. "\n ORDER BY m.folder ASC, m.ordering ASC, m.name ASC";
	
	$database->setQuery( $query, '#__', $pageNav->limit, $pageNav->limitstart );
	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	// get list of Positions for dropdown filter
	$query = "SELECT folder AS value, folder AS text FROM #__mambots"
	."\n WHERE client_id = '$client_id' GROUP BY folder ORDER BY folder";
	$types[] = mosHTML::makeOption( '0', $adminLanguage->A_ALL_TYPES );
	$database->setQuery( $query );
	$types = array_merge( $types, $database->loadObjectList() );
	$lists['type']	= mosHTML::selectList( $types, 'filter_type', 'class="selectbox" size="1" dir="ltr" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_type );

	HTML_modules::showMambots( $rows, $client, $pageNav, $option, $lists, $search, $formfilters );
}


/**
* Saves the module after an edit form submit
*/
function saveMambot( $option, $client, $task ) {
	global $database, $adminLanguage, $mainframe;

	$params = mosGetParam( $_POST, 'params', '' );
	if (is_array( $params )) {
		$txt = array();
		foreach ($params as $k=>$v) {
			$txt[] = "$k=$v";
		}

 		$_POST['params'] = mosParameters::textareaHandling( $txt );
	}

	$row = new mosMambot( $database );
	if (!$row->bind( $_POST )) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
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
	if ($client == 'admin') {
		$where = "client_id='1'";
	} else {
		$where = "client_id='0'";
	}
	$row->updateOrder( "folder='$row->folder' AND ordering > -10000 AND ordering < 10000 AND ($where)" );

	switch ( $task ) {
		case 'apply':
			$msg = $adminLanguage->A_CMP_MBT_SCHANG.': '. $row->name;
			mosRedirect( 'index2.php?option='. $option .'&client='. $client .'&task=editA&hidemainmenu=1&id='. $row->id, $msg );

		case 'save':
		default:
			$msg = $adminLanguage->A_CMP_MBT_SAVED.': '. $row->name;
			mosRedirect( 'index2.php?option='. $option .'&client='. $client, $msg );
			break;
	}
}


/************************/
/* PREPARE ADD/EDIT BOT */
/************************/
function editMambot( $option, $uid, $client ) {
	global $database, $my, $mainframe, $adminLanguage, $fmanager;

	$lists = array();
	$row = new mosMambot($database);
	$row->load( $uid );

	//fail if checked out not by 'me'
	if ($row->checked_out && $row->checked_out <> $my->id) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_THEMODULE ." ". $row->title ." ". $adminLanguage->A_ISCEDITANADM ."\"); document.location.href='index2.php?option=$option'</script>\n";
		exit();
	}

	if ($client == 'admin') {
		$where = "client_id='1'";
	} else {
		$where = "client_id='0'";
	}

	//get list of groups
	if ($row->access == 99 || $row->client_id == 1) {
		$lists['access'] = $adminLanguage->A_ADMINISTRATOR.'<input type="hidden" name="access" value="99" />';
	} else {
		//build the html select list for the group access
		$lists['access'] = mosAdminMenus::Access( $row );
	}

	if ($uid) {
		$row->checkout( $my->id );

	    if ( $row->ordering > -10000 && $row->ordering < 10000 ) {
			//build the html select list for ordering
			$query = "SELECT ordering AS value, name AS text FROM #__mambots"
			. "\n WHERE folder='$row->folder' AND published > 0"
			. "\n AND $where"
			. "\n AND ordering > -10000"
			. "\n AND ordering < 10000"
			. "\n ORDER BY ordering";
			$order = mosGetOrderingList( $query );
			$lists['ordering'] = mosHTML::selectList( $order, 'ordering', 'class="selectbox" size="1"', 'value', 'text', intval( $row->ordering ) );
		} else {
			$lists['ordering'] = '<input type="hidden" name="ordering" value="'. $row->ordering .'" />' . $adminLanguage->A_CMP_MBT_TMCR;
		}
		$lists['folder'] = '<input type="hidden" name="folder" value="'. $row->folder .'" />'. $row->folder;

		if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
		$xmlfile = $mainframe->getCfg('absolute_path').'/mambots/'.$row->folder.'/'.$row->element.'.xml';
		$xmlDoc = simplexml_load_file($xmlfile, 'SimpleXMLElement');
		if ($xmlDoc) {
			$ok = true;
			if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
				if ($xmlDoc->getName() != 'mosinstall') { $ok = false; }
			}
			if ($ok) {
				$attrs =  $xmlDoc->attributes();
				if ($attrs) {
					if (isset($attrs['type']) && ($attrs['type'] == 'mambot')) {
						$row->description = isset($xmlDoc->description) ? trim($xmlDoc->description) : '';
					}
				}
			}
		}
		unset($xmlDoc);
	} else {
		$row->folder 		= '';
		$row->ordering 		= 999;
		$row->published 	= 1;
		$row->description 	= '';

		$folders = $fmanager->listFolders( $mainframe->getCfg('absolute_path').'/mambots/' );
		$folders2 = array();
		foreach ($folders as $folder) {
		    if (is_dir( $mainframe->getCfg('absolute_path').'/mambots/'.$folder ) && ( $folder <> 'svn' ) ) {
		        $folders2[] = mosHTML::makeOption( $folder );
			}
		}
		$lists['folder'] = mosHTML::selectList( $folders2, 'folder', 'class="selectbox" size="1" dir="ltr"', 'value', 'text', null );
		$lists['ordering'] = '<input type="hidden" name="ordering" value="'. $row->ordering .'" />' . $adminLanguage->A_NEW_ITEM_LAST;
	}

	$lists['published'] = mosHTML::yesnoRadioList( 'published', 'class="inputbox"', $row->published );

	//get params definitions
	$params = new mosParameters( $row->params, $mainframe->getPath( 'bot_xml', $row->folder.'/'.$row->element ), 'mambot' );

	HTML_modules::editMambot( $row, $lists, $params, $option );
}


/***************/
/* DELETE BOTS */
/***************/
function removeMambot( &$cid, $option, $client ) {
	global $database, $my, $adminLanguage, $mainframe;

	if (count( $cid ) < 1) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_CMP_MBT_SMDEL ."\"); window.history.go(-1);</script>\n";
		exit();
	}

	mosRedirect( 'index2.php?option=com_installer&element=mambot&client='.$client.'&task=remove&cid[]='. $cid[0] );
}


/*************************/
/* PUBLISH/UNPUBLISH BOT */
/*************************/
function publishMambot( $cid=null, $publish=1, $option, $client ) {
	global $database, $my, $adminLanguage, $mainframe;

    if (trim($publish) == '') { $publish = '0'; }
	if (count( $cid ) < 1) {
		$action = $publish ? $adminLanguage->A_PUBLISH : $adminLanguage->A_UNPUBLISH;
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_CMP_MBT_TO ." ". $action ."\"); window.history.go(-1);</script>\n";
		exit();
	}

	$cids = implode( ',', $cid );

	$query = "UPDATE #__mambots SET published='".$publish."'"
	."\n WHERE id IN (".$cids.") AND (checked_out=0 OR (checked_out='".$my->id."'))";
	$database->setQuery( $query );
	if (!$database->query()) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosMambot( $database );
		$row->checkin( $cid[0] );
	}

	mosRedirect( 'index2.php?option='.$option.'&client='.$client );
}


/******************************/
/* AJAX PUBLISH/UNPUBLISH BOT */
/******************************/
function ajaxpubBot() {
    global $database, $my, $adminLanguage;

    $elem = intval(mosGetParam($_REQUEST, 'elem', 0));
    $id = intval(mosGetParam($_REQUEST, 'id', 0));
    $state = intval(mosGetParam($_REQUEST, 'state', 0));

    if (!$id) {
        echo '<img src="../includes/js/ThemeOffice/warning.png" width="16" height="16" border="0" alt="'.$adminLanguage->A_ERROR.': Invalid Bot id" title="'.$adminLanguage->A_ERROR.': Invalid Bot id" />'._LEND;
        exit();
    }

    $error = 0;
	$database->setQuery( "UPDATE #__mambots SET published='$state' WHERE id='$id' AND (checked_out=0 OR (checked_out='".$my->id."'))");
	if (!$database->query()) { $error = 1; }

    if ($error) { $state = $state ? 0 : 1; }
    $img = $state ? 'publish_g.png' : 'publish_x.png';
    $alt = $state ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
?>
	<a href="javascript: void(0);" 
    onclick="changeBotState('<?php echo $elem; ?>', '<?php echo $id; ?>', '<?php echo ($state) ? 0 : 1; ?>');" title="<?php echo $alt; ?>">
	<img src="images/<?php echo $img; ?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" /></a>
<?php 
    exit();
}


/*******************/
/* CANCEL EDIT BOT */
/*******************/
function cancelMambot( $option, $client ) {
	global $database;

	$row = new mosMambot( $database );
	$row->bind( $_POST );
	$row->checkin();

	mosRedirect( 'index2.php?option='.$option.'&client='.$client );
}


/****************/
/* RE-ORDER BOT */
/****************/
function orderMambot( $uid, $inc, $option, $client ) {
	global $database;

	$where = ($client == 'admin') ? "client_id='1'" : "client_id='0'";
	$row = new mosMambot( $database );
	$row->load( $uid );
	$row->move( $inc, "folder='$row->folder' AND ordering > -10000 AND ordering < 10000 AND $where"  );

	mosRedirect( 'index2.php?option='.$option );
}


/******************/
/* SET BOT ACCESS */
/******************/
function accessMenu( $uid, $access, $option, $client ) {
	global $database;

	$row = new mosMambot( $database );
	$row->load( $uid );
	$row->access = $access;

	if ( !$row->check() ) {
		return $row->getError();
	}
	if ( !$row->store() ) {
		return $row->getError();
	}

	mosRedirect( 'index2.php?option='.$option );
}


/******************/
/* SAVE BOT ORDER */
/******************/
function saveOrder( &$cid ) {
	global $database, $adminLanguage, $mainframe;

	$total		= count( $cid );
	$order 		= mosGetParam($_POST, 'order', array(0));
	$conditions = array();

    //update ordering values
	for($i=0; $i < $total; $i++) {
		$database->setQuery("SELECT id, folder, ordering, client_id FROM #__mambots WHERE id='".$cid[$i]."'", '#__', 1, 0);
		$row = $database->loadRow();
		if ($row && ($row['ordering'] != $order[$i])) {
			$database->setQuery("UPDATE #__mambots SET ordering='".intval($order[$i])."' WHERE id=".$row['id']);
			$database->query();
	        //remember to updateOrder this group
	        $condition = "folder='".$row['folder']."' AND ordering > -10000 AND ordering < 10000 AND client_id='".$row['client_id']."'";
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
			$row = new mosMambot( $database );
			$row->load( $cond[0] );
			$row->updateOrder( $cond[1] );
			unset($row);
		}
	}

	mosRedirect( 'index2.php?option=com_mambots', $adminLanguage->A_NEWORDERSAVED );
}
?>