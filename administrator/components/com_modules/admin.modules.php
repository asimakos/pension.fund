<?php 
/**
* @version: $Id: admin.modules.php 42 2010-06-08 15:17:42Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Modules
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


// ensure user has access to this function
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'modules', 'all' ) | $acl->acl_check( 'administration', 'install', 'users', $my->usertype, 'modules', 'all' ))) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );

$client = mosGetParam( $_REQUEST, 'client', '' );
$cid = mosGetParam( $_POST, 'cid', array(0) );
$moduleid = mosGetParam( $_REQUEST, 'moduleid', null );
if ($cid[0] == 0 && isset($moduleid) ) {
	$cid[0] = $moduleid;
}

switch ( $task ) {
	case 'copy':
		copyModule( $option, intval( $cid[0] ), $client );
	break;
	case 'new':
		editModule( $option, 0, $client );
	break;
	case 'edit':
		editModule( $option, $cid[0], $client );
	break;
	case 'editA':
	    $id = mosGetParam( $_REQUEST, 'id', 0 );
		editModule( $option, $id, $client );
	break;
	case 'save':
	case 'apply':
		mosCache::cleanCache( 'com_content' );
		saveModule( $option, $client, $task );
	break;
	case 'remove':
		removeModule( $cid, $option, $client );
	break;
	case 'cancel':
		cancelModule( $option, $client );
	break;
	case 'publish':
	case 'unpublish':
		mosCache::cleanCache( 'com_content' );
		publishModule( $cid, ($task == 'publish'), $option, $client );
	break;
	case 'ajaxpub':
		mosCache::cleanCache( 'com_content' );
        ajaxpublishModule();
    break;
	case 'orderup':
	case 'orderdown':
		orderModule( $cid[0], ($task == 'orderup' ? -1 : 1), $option, $client );
	break;
    case 'setaccess':
        $access = mosGetParam( $_REQUEST, 'access', 29 );
        $sid = mosGetParam( $_REQUEST, 'sid', $cid[0] );
		accessMenu( $sid, $access, $option, $client );
	break;
	case 'saveorder':
		saveOrder( $cid, $client );
	break;
	default:
		viewModules( $option, $client );
	break;
}


/***************************/
/* PREPARE TO LIST MODULES */
/***************************/
function viewModules( $option, $client ) {
	global $database, $my, $mainframe, $mosConfig_list_limit, $adminLanguage, $mosConfig_pub_langs;

	$filter_position 	= $mainframe->getUserStateFromRequest( "filter_position{$option}{$client}", 'filter_position', 0 );
	$filter_type	 	= $mainframe->getUserStateFromRequest( "filter_type{$option}{$client}", 'filter_type', 0 );
	$limit 				= $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart 		= $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );
	$search 			= $mainframe->getUserStateFromRequest( "search{$option}{$client}", 'search', '' );
	$search 			= $database->getEscaped( eUTF::utf8_trim( eUTF::utf8_strtolower( $search ) ) );
    $filter_lang        = trim( strtolower(mosGetParam( $_REQUEST, 'filter_lang', '' )));
    $filter_published   = intval(mosGetParam( $_REQUEST, 'filter_published', 0 ));

    //in order to work 'filtered by' icons with register_globals off
    $formfilters = array(
        'filter_position' => $filter_position,
        'filter_type' => $filter_type,
        'filter_lang' => $filter_lang,
        'filter_published' => $filter_published
    );

	if ($client == 'admin') {
		$where[] = "m.client_id = '1'";
		$client_id = 1;
	} else {
		$where[] = "m.client_id = '0'";
		$client_id = 0;
		//filter lang only for site modules
        if ( $filter_lang != '' ) {
            $where[] = "((m.language LIKE '%$filter_lang%') OR (m.language IS NULL))";
        }
	}

	// used by filter
	if ( $filter_position ) {
		$where[] = "m.position = '$filter_position'";
	}
	if ( $filter_type ) {
		$where[] = "m.module = '$filter_type'";
	}
	if ( $filter_published ) {
        $pubval = ($filter_published == '2') ? '0' : '1';
		$where[] = "m.published = '$pubval'";
	}
	if ( $search ) {
		$where[] = "LOWER( m.title ) LIKE '%$search%'";
	}

	//get the total number of records
	$query = "SELECT COUNT(*) FROM #__modules m ". ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' );
	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php');
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	$query = "SELECT m.*, u.name AS editor, g.name AS groupname, MIN(mm.menuid) AS pages"
	. "\n FROM #__modules m"
	. "\n LEFT JOIN #__users u ON u.id = m.checked_out"
	. "\n LEFT JOIN #__core_acl_aro_groups g ON g.group_id = m.access"
	. "\n LEFT JOIN #__modules_menu mm ON mm.moduleid=m.id"
	. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '' );
	if ($database->_resource->databaseType == 'mysql') {
		$query .= "\n GROUP BY m.id";
	} else {
		$query .= "\n GROUP BY m.id, m.title, m.content, m.ordering, m.position, m.module,"
    	. " m.checked_out, m.checked_out_time, m.published, m.numnews, m.access, m.showtitle,"
    	. " m.params, m.iscore, m.client_id, m.language, u.name, g.name";
    }
	$query .= "\n ORDER BY position ASC, ordering ASC";
	$database->setQuery( $query, '#__', $pageNav->limit, $pageNav->limitstart );

	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	//get list of Positions for dropdown filter
	$query = "SELECT t.position AS value, t.position AS text"
	."\n FROM #__template_positions t"
	."\n LEFT JOIN #__modules m ON m.position = t.position"
	."\n WHERE m.client_id = '$client_id'"
	."\n GROUP BY t.position"
	."\n ORDER BY t.position";
	$positions[] = mosHTML::makeOption( '0', $adminLanguage->A_ALL_POSITIONS );
	$database->setQuery( $query );
	$positions = array_merge( $positions, $database->loadObjectList() );
	$lists['position'] = mosHTML::selectList( $positions, 'filter_position', 'class="selectbox" size="1" dir="ltr" onchange="document.adminForm.submit();"', 'value', 'text', "$filter_position" );

	$types[] = mosHTML::makeOption( '0', $adminLanguage->A_ALL_TYPES );

	//get list of Positions for dropdown filter
	$query = "SELECT module AS value, module AS text FROM #__modules"
	."\n WHERE client_id = '$client_id' GROUP BY module ORDER BY module";
	$database->setQuery( $query );
	$types = array_merge( $types, $database->loadObjectList() );
	$lists['type'] = mosHTML::selectList( $types, 'filter_type', 'class="selectbox" size="1" dir="ltr" onchange="document.adminForm.submit();"', 'value', 'text', "$filter_type" );

    if ($client != 'admin') {
        // get list of enabled languages for dropdown filter
        $plangs[] = mosHTML::makeOption( '',$adminLanguage->A_ALL_LANGS );
        $publs = explode(',', $mosConfig_pub_langs);
        foreach ($publs as $publ) {
            $plangs[] = mosHTML::makeOption( $publ, $publ );
        }
        $lists['flangs'] = mosHTML::selectList( $plangs, 'filter_lang', 'class="selectbox" size="1" dir="ltr" onchange="document.adminForm.submit();"', 'value', 'text', $filter_lang );
    }

    $mpubs[] = mosHTML::makeOption( 0 ,$adminLanguage->A_ALL );
    $mpubs[] = mosHTML::makeOption( 1 ,$adminLanguage->A_PUBLISHED );
    $mpubs[] = mosHTML::makeOption( 2 ,$adminLanguage->A_UNPUBLISHED );
    $lists['published'] = mosHTML::selectList( $mpubs, 'filter_published', 'class="selectbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $filter_published );

	HTML_modules::showModules( $rows, $my->id, $client, $pageNav, $option, $lists, $search, $formfilters );
}


/***************/
/* COPY MODULE */
/***************/
function copyModule( $option, $uid, $client ) {
	global $database, $my, $adminLanguage;

	$row = new mosModule( $database );
	$row->load( $uid );
	$row->title = $adminLanguage->A_CMP_MDL_COPYOF.' '.$row->title;
	$row->id = 0;
	$row->iscore = 0;
	$row->published = 0;

	if (!$row->check()) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}
	if (!$row->store()) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}
	$row->checkin();
	if ($client == 'admin') {
		$where = "client_id='1'";
	} else {
		$where = "client_id='0'";
	}
	$row->updateOrder( "position='$row->position' AND ($where)" );

	$database->setQuery( "SELECT menuid FROM #__modules_menu WHERE moduleid='$uid'" );
	$rows = $database->loadResultArray();

	foreach($rows as $menuid) {
		$database->setQuery( "INSERT INTO #__modules_menu VALUES ('$row->id', '$menuid')");
		$database->query();
	}

	$msg = $adminLanguage->A_CMP_MDL_COPIED.' ['. $row->title .']';
	mosRedirect( 'index2.php?option='.$option.'&client='.$client, $msg );
}


/***************/
/* SAVE MODULE */
/***************/
function saveModule( $option, $client, $task ) {
	global $database, $adminLanguage;
    
    if ( $client != 'admin' ) {
        foreach ($_POST['languages'] as $xlang) {
        	if (trim($xlang) == '') { $newlangs = ''; }
        }
        if (!isset($newlangs)) {
        	$newlangs = implode(',', $_POST['languages']);
        }
        $_POST['language'] = $newlangs;
    } else {
        $_POST['language'] = null;
    }

	$params = mosGetParam( $_POST, 'params', '' );
	if (is_array( $params )) {
		$txt = array();
		foreach ($params as $k=>$v) {
			$txt[] = "$k=$v";
		}
		$_POST['params'] = mosParameters::textareaHandling( $txt );
	}

	$row = new mosModule( $database );
	if (!$row->bind( $_POST, 'selections' )) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
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
	if ($client == 'admin') {
		$where = "client_id='1'";
	} else {
		$where = "client_id='0'";
	}
	$row->updateOrder( "position='$row->position' AND ($where)" );

	$menus = mosGetParam( $_POST, 'selections', array() );

	$database->setQuery( "DELETE FROM #__modules_menu WHERE moduleid='$row->id'" );
	$database->query();

	foreach ($menus as $menuid){
		//this check for the blank spaces in the select box that have been added for cosmetic reasons
		if ( $menuid <> "-999" ) {
			$query = "INSERT INTO #__modules_menu (moduleid, menuid) VALUES ('".$row->id."', '".$menuid."')";
			$database->setQuery( $query );
			$database->query();
		}
	}

	switch ( $task ) {
		case 'apply':
			$msg = $adminLanguage->A_CMP_MDL_SSCHMOD.': '.$row->title;
			mosRedirect( 'index2.php?option='.$option.'&client='.$client.'&task=editA&hidemainmenu=1&id='.$row->id, $msg );
			break;

		case 'save':
		default:
			$msg = $adminLanguage->A_CMP_MDL_SSAVMOD.': '.$row->title;
			mosRedirect( 'index2.php?option='.$option.'&client='.$client, $msg );
			break;
	}
}


/******************************/
/* PREPARE TO ADD/EDIT MODULE */
/******************************/
function editModule( $option, $uid, $client ) {
	global $database, $my, $mainframe, $adminLanguage, $xmlLanguage, $alang;

	$lists = array();
	$row = new mosModule( $database );
	//load the row from the db table
	$row->load( $uid );
	//fail if checked out not by 'me'
	if ( $row->checked_out && $row->checked_out <> $my->id ) {
		echo "<script type=\"text/javascript\">alert(\"".$adminLanguage->A_THEMODULE." ".$row->title." ".$adminLanguage->A_ISCEDITANADM ."\"); document.location.href='index2.php?option=$option'</script>\n";
		exit();
	}

	$row->content = htmlspecialchars( eUTF::utf8_str_replace( '&amp;', '&', $row->content ) );

	if ( $uid ) {
		$row->checkout( $my->id );
	}
	//if a new record we must still prime the mosModule object with a default
	//position and the order; also add an extra item to the order list to
	//place the 'new' record in last position if desired
	if ($uid == 0) {
		$row->position = 'left';
		$row->showtitle = true;
		//$row->ordering = $l;
		$row->published = 1;
	}

	if ( $client == 'admin' ) {
		$where = "client_id='1'";
		$lists['client_id'] = 1;
		$path = 'mod1_xml';
	} else {
		$where = "client_id='0'";
		$lists['client_id'] = 0;
		$path = 'mod0_xml';
	}
	$query = "SELECT position, ordering, showtitle, title FROM #__modules"
	."\n WHERE ".$where." ORDER BY ordering";
	$database->setQuery( $query );
	if ( !($orders = $database->loadObjectList()) ) {
		echo $database->stderr();
		return false;
	}

	$ora = (in_array($database->_resource->databaseType, array('oci8', 'oci805', 'oci8po', 'oracle'))) ? 1 : 0;
	if ($ora) {
		$database->setQuery("SELECT position, description FROM #__template_positions WHERE position IS NOT NULL");
	} else {
		$database->setQuery("SELECT position, description FROM #__template_positions WHERE position <> ''");
	}
	//hard code options for now
	$positions = $database->loadObjectList();

	$orders2 = array();
	$pos = array();
	foreach ($positions as $position) {
		$orders2[$position->position] = array();
		$pos[] = mosHTML::makeOption( $position->position, $position->description );
	}

	$l = 0;
	$r = 0;
	for ($i=0, $n=count( $orders ); $i < $n; $i++) {
		$ord = 0;
		if (array_key_exists( $orders[$i]->position, $orders2 )) {
			$ord =count( array_keys( $orders2[$orders[$i]->position] ) ) + 1;
		}

		$orders2[$orders[$i]->position][] = mosHTML::makeOption( $ord, $ord.'::'.addslashes( $orders[$i]->title ) );
	}

	//build the html select list
	$pos_select = 'onchange="changeDynaList(\'ordering\',orders,document.adminForm.position.options[document.adminForm.position.selectedIndex].value, originalPos, originalOrder)"';
	$active = ( $row->position ? $row->position : 'left' );
	$lists['position'] = mosHTML::selectList( $pos, 'position', 'class="selectbox" size="1" dir="ltr" '. $pos_select, 'value', 'text', $active );

	//get selected pages for $lists['selections']
	if ( $uid ) {
		$query = 'SELECT menuid AS value FROM #__modules_menu WHERE moduleid='.$row->id;
		$database->setQuery( $query );
		$lookup = $database->loadObjectList();
	} else {
		$lookup = array( mosHTML::makeOption( 0, $adminLanguage->A_ALL ) );
	}

	if ( $row->access == 999 || $row->client_id == 1 || $lists['client_id'] ) {
		$lists['access'] = $adminLanguage->A_ADMINISTRATOR.'<input type="hidden" name="access" value="999" />';
		$lists['showtitle'] = $adminLanguage->A_CMP_MDL_NA.'<input type="hidden" name="showtitle" value="1" />';
		$lists['selections'] = $adminLanguage->A_CMP_MDL_NA;
	} else {
		if ( $client == 'admin' ) {
			$lists['access'] = $adminLanguage->A_CMP_MDL_NA;
			$lists['selections'] = $adminLanguage->A_CMP_MDL_NA;
		} else {
			$lists['access'] = mosAdminMenus::Access( $row );
			$lists['selections'] = mosAdminMenus::MenuLinks( $lookup, 1, 1 );
		}
		$lists['showtitle'] = mosHTML::yesnoRadioList( 'showtitle', 'class="inputbox"', $row->showtitle );
	}

	//build the html select list for published
	$lists['published'] = mosAdminMenus::Published( $row );

    if ( $client != 'admin' ) {
        //build the html multiple select list for language selection
        $lists['languages']	= mosAdminMenus::SelectLanguages( 'languages', $row->language, $adminLanguage->A_ALL_LANGS );
    }

    $row->description = '';

	//xml file for module
	$xmlfile = $mainframe->getPath($path, $row->module);	

	if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
	$xmlDoc = simplexml_load_file($xmlfile, 'SimpleXMLElement');
	if ($xmlDoc) {
		$ok = true;
		if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
			if ($xmlDoc->getName() != 'mosinstall') { $ok = false; }
		}
		if ($ok) {
			$attrs =  $xmlDoc->attributes();
			if ($attrs) {
				if (isset($attrs['type']) && ($attrs['type'] == 'module')) {
					if (isset($xmlDoc->cxlangdir)) {
						$_LangDir = trim($xmlDoc->cxlangdir);
						if ($_LangDir != '') {
                			if (file_exists($mainframe->getCfg('absolute_path').$_LangDir.'/'.$alang.'.php')) {
                    			require_once($mainframe->getCfg('absolute_path').$_LangDir.'/'.$alang.'.php');
                			} else if (file_exists($mainframe->getCfg('absolute_path').$_LangDir.'/english.php')) {
                    			require_once($mainframe->getCfg('absolute_path').$_LangDir.'/english.php');
                			}
                		}
					}
					$row->description = isset($xmlDoc->description) ? eUTF::utf8_trim($xmlLanguage->get($xmlDoc->description)) : '';
				}
			}
		}
	}
	unset($xmlDoc);

	//get params definitions
	$params = new mosParameters( $row->params, $xmlfile, 'module' );

	HTML_modules::editModule( $row, $orders2, $lists, $params, $option );
}


/******************/
/* DELETE MODULES */
/******************/
function removeModule( &$cid, $option, $client ) {
	global $database, $my, $adminLanguage;

	if (count( $cid ) < 1) {
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_CMP_MDL_SELMODTDEL ."\"); window.history.go(-1);</script>\n";
		exit();
	}

	$cids = implode( ',', $cid );

	$database->setQuery( "SELECT id, module, title, iscore, params FROM #__modules WHERE id IN ($cids)" );
	if (!($rows = $database->loadObjectList())) {
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
        exit();
	}

	$err = array();
	$cid = array();
	foreach ($rows as $row) {
		if ($row->module == '' || $row->iscore == 0) {
			$cid[] = $row->id;
		} else {
			$err[] = $row->title;
		}
		//mod_mainmenu modules only deletable via Menu Manager
		if ( $row->module == 'mod_mainmenu' ) {
			if ( strstr( $row->params, 'mainmenu' ) ) {
				echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_CMP_MDL_YCNDMAIN."'); window.history.go(-1);</script>\n";
				exit();
			}
		}
	}

	if (count( $cid )) {
		$cids = implode( ',', $cid );
		$database->setQuery( "DELETE FROM #__modules WHERE id IN ($cids)" );
		if (!$database->query()) {
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
			exit();
		}
		$database->setQuery( "DELETE from #__modules_menu WHERE moduleid IN ($cids)" );
		if (!$database->query()) {
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."');</script>\n";
			exit();
		}
		$mod = new mosModule( $database );
		$mod->ordering = 0;
		$mod->updateOrder( "position='left'" );
		$mod->updateOrder( "position='right'" );
	}

	if (count( $err )) {
		$cids = addslashes( implode( "', '", $err ) );
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_CMP_MDL_MODULES.": '".$cids."' ".$adminLanguage->A_CMP_MDL_CANNOT."\");</script>\n";
	}

	mosRedirect( 'index2.php?option='. $option .'&client='. $client );
}


/*****************************/
/* PUBLISH/UNPUBLISH MODULES */
/*****************************/
function publishModule( $cid=null, $publish=1, $option, $client ) {
	global $database, $my, $adminLanguage;

    if ( trim($publish) == '') { $publish = '0'; }
	if (count( $cid ) < 1) {
		$action = $publish ? $adminLanguage->A_PUBLISH : $adminLanguage->A_UNPUBLISH;
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_CMP_MDL_SELECT_TO ." ". $action ."\"); window.history.go(-1);</script>\n";
		exit();
	}

	$cids = implode( ',', $cid );

	$query = "UPDATE #__modules SET published='$publish' WHERE id IN ($cids)"
	."\n AND (checked_out=0 OR (checked_out='$my->id'))";
	$database->setQuery( $query );
	if (!$database->query()) {
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosModule( $database );
		$row->checkin( $cid[0] );
	}

	mosRedirect('index2.php?option='.$option.'&client='.$client);
}


/*********************************/
/* AJAX PUBLISH/UNPUBLISH MODULE */
/*********************************/
function ajaxpublishModule() {
    global $database, $my, $adminLanguage;

    $elem = intval(mosGetParam($_REQUEST, 'elem', 0));
    $id = intval(mosGetParam($_REQUEST, 'id', 0));
    $state = intval(mosGetParam($_REQUEST, 'state', 0));

    if (!$id) {
        echo '<img src="../includes/js/ThemeOffice/warning.png" width="16" height="16" border="0" title="'.$adminLanguage->A_ERROR.': Invalid Item id" />'._LEND;
        exit();
    }

    $error = 0;
	$database->setQuery( "UPDATE #__modules SET published='$state' WHERE id='$id' AND (checked_out=0 OR (checked_out='".$my->id."'))");
	if (!$database->query()) { $error = 1; }

    if ($error) { $state = $state ? 0 : 1; }
    $img = $state ? 'publish_g.png' : 'publish_x.png';
    $alt = $state ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
?>
	<a href="javascript: void(0);" 
    onclick="changeModuleState('<?php echo $elem; ?>', '<?php echo $id; ?>', '<?php echo ($state) ? 0 : 1; ?>');">
	<img src="images/<?php echo $img; ?>" width="12" height="12" border="0" title="<?php echo $alt; ?>" /></a>
<?php 
    exit();
}


/**********************/
/* CANCEL EDIT MODULE */
/**********************/
function cancelModule( $option, $client ) {
	global $database;

	$row = new mosModule( $database );
	$row->bind( $_POST, 'selections params' );
	$row->checkin();

	mosRedirect( 'index2.php?option='. $option .'&client='. $client );
}


/*********************/
/* RE-ORDER A MODULE */
/*********************/
function orderModule( $uid, $inc, $option ) {
	global $database;

	$client = mosGetParam( $_POST, 'client', '' );

	$row = new mosModule( $database );
	$row->load( $uid );
	if ($client == 'admin') {
		$where = "client_id='1'";
	} else {
		$where = "client_id='0'";
	}

	$row->move( $inc, "position='$row->position' AND ($where)"  );
	if ( $client ) {
		$client = '&client=admin' ;
	} else {
		$client = '';
	}
	mosRedirect( 'index2.php?option='.$option.'&client='.$client );
}


/*********************/
/* SET MODULE ACCESS */
/*********************/
function accessMenu( $uid, $access, $option, $client ) {
	global $database;

	$row = new mosModule( $database );
	$row->load( $uid );
	$row->access = $access;

	if ( !$row->check() ) {
		return $row->getError();
	}
	if ( !$row->store() ) {
		return $row->getError();
	}
	mosRedirect( 'index2.php?option='. $option .'&client='. $client );
}


/**************/
/* SAVE ORDER */
/**************/
function saveOrder( &$cid, $client ) {
	global $database, $adminLanguage;

	$total		= count( $cid );
	$order 		= mosGetParam( $_POST, 'order', array(0) );
	$conditions = array();

    //update ordering values
	for($i=0; $i < $total; $i++) {
		$database->setQuery("SELECT id, ordering, position, client_id FROM #__modules WHERE id='".$cid[$i]."'", '#__', 1, 0);
		$row = $database->loadRow(); 
		if ($row && ($row['ordering'] != $order[$i])) {
			$database->setQuery("UPDATE #__modules SET ordering='".intval($order[$i])."' WHERE id=".$row['id']);
			$database->query();
	        //remember to updateOrder this group
	        $condition = "position='".$row['position']."' AND client_id='".$row['client_id']."'";
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
			$row = new mosModule( $database );
			$row->load( $cond[0] );
			$row->updateOrder( $cond[1] );
			unset($row);
		}
	}

	$msg = $adminLanguage->A_NEWORDERSAVED;
	mosRedirect( 'index2.php?option=com_modules&client='.$client, $msg );
}

?>