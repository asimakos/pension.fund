<?php 
/**
* @version: $Id: admin.menus.php 62 2010-06-13 15:11:23Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org All rights reserved
* @package: Elxis
* @subpackage: Component Menus
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


require_once( $mainframe->getPath( 'admin_html' ) );

$id 		= intval( mosGetParam( $_GET, 'id', 0 ) );
$type 		= mosGetParam( $_REQUEST, 'type', false );
$menutype 	= mosGetParam( $_REQUEST, 'menutype', 'mainmenu' );
$task 		= mosGetParam( $_REQUEST, 'task', '' );
$access 	= mosGetParam( $_POST, 'access', '' );
$utaccess	= mosGetParam( $_POST, 'utaccess', '' );
$ItemName	= mosGetParam( $_POST, 'ItemName', '' );
$menu 		= mosGetParam( $_POST, 'menu', '' );
$cid 		= mosGetParam( $_POST, 'cid', array(0) );

$path = $fmanager->PathName($mosConfig_absolute_path .'/administrator/components/com_menus/');

if (!is_array( $cid )) {
	$cid = array(0);
}

switch ($task) {
	case 'new':
		addMenuItem( $cid, $menutype, $option, $task );
	break;
	case 'edit':
		$cid[0]	= ( $id ? $id : $cid[0] );
		$menu = new mosMenu( $database );
		if ($cid[0]) {
			$menu->load( $cid[0] );
		} else {
			$menu->type = $type;
		}

		if ( $menu->type ) {
			$type = $menu->type;
			require( $path . $menu->type .SEP. $menu->type .'.menu.php' );
		}
	break;
	case 'save':
	case 'apply':
		require( $path.$type.SEP.$type.'.menu.php' );
	break;
	case 'publish':
	case 'unpublish':
		if ($msg = publishMenuSection( $cid, ($task == 'publish') )) {
			// proceed no further if the menu item can't be published
			mosRedirect( 'index2.php?option=com_menus&menutype='. $menutype, $msg );
		} else {
			mosRedirect( 'index2.php?option=com_menus&menutype='. $menutype );
		}
	break;
	case 'ajaxpub':
		ajaxpublishMenu();
	break;
	case 'remove':
		if ($msg = TrashMenusection( $cid )) {
			mosRedirect( 'index2.php?option=com_menus&menutype='. $menutype, $msg );
		} else {
			mosRedirect( 'index2.php?option=com_menus&menutype='. $menutype );
		}
	break;
	case 'cancel':
		cancelMenu( $option );
	break;
	case 'orderup':
		orderMenu( $cid[0], -1, $option );
	break;
	case 'orderdown':
		orderMenu( $cid[0], 1, $option );
	break;
    case 'setaccess':
        $access = mosGetParam( $_REQUEST, 'access', 29 );
        $sid = mosGetParam( $_REQUEST, 'sid', $cid[0] );
		accessMenu( $sid, $access, $option, $menutype );
	break;
	case 'movemenu':
		moveMenu( $option, $cid, $menutype );
	break;
	case 'movemenusave':
		moveMenuSave( $option, $cid, $menu, $menutype );
	break;
	case 'copymenu':
		copyMenu( $option, $cid, $menutype );
	break;
	case 'copymenusave':
		copyMenuSave( $option, $cid, $menu, $menutype );
	break;
	case 'cancelcopymenu':
	case 'cancelmovemenu':
		viewMenuItems( $menutype, $option );
	break;
	case 'saveorder':
		saveOrder( $cid, $menutype );
	break;
    case 'viewseotitle':
        viewSEOtitle();
    break;
	default:
		$type = trim( mosGetParam( $_REQUEST, 'type', null ) );
		if ($type) {
			//adding a new item - type selection form
			require( $path.$type.SEP.$type.'.menu.php' );
		} else {
			viewMenuItems( $menutype, $option );
		}
	break;
}


/******************************/
/* PREPARE TO LIST MENU ITEMS */
/******************************/
function viewMenuItems( $menutype, $option ) {
	global $database, $mainframe, $mosConfig_list_limit, $adminLanguage, $xmlLanguage;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart$menutype", 'limitstart', 0 );
	$levellimit = $mainframe->getUserStateFromRequest( "view{$option}limit$menutype", 'levellimit', 10 );
	$search = $mainframe->getUserStateFromRequest( "search{$option}$menutype", 'search', '' );

    $where = "m.menutype='$menutype'";

	if ($search) {
		$search = $database->getEscaped( eUTF::utf8_trim( eUTF::utf8_strtolower( $search ) ) );
		$query = "SELECT m.id FROM #__menu m"
		."\n WHERE ".$where." AND LOWER(m.name) LIKE '%".$search."%'";
		$database->setQuery( $query );
		$search_rows = $database->loadResultArray();
	}

	$query = "SELECT m.*, u.name AS editor, g.name AS groupname, c.publish_up, c.publish_down, com.name AS com_name"
	."\n FROM #__menu m"
	."\n LEFT JOIN #__users u ON u.id = m.checked_out"
	."\n LEFT JOIN #__core_acl_aro_groups g ON g.group_id = m.access"
	."\n LEFT JOIN #__content c ON c.id = m.componentid AND m.type='content_typed'"
	."\n LEFT JOIN #__components com ON com.id = m.componentid AND m.type='components'"
	."\n WHERE $where"
	."\n AND m.published != '-2'"
	."\n ORDER BY parent,ordering";
	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	//establish the hierarchy of the menu
	$children = array();
	//first pass - collect children
	foreach ($rows as $v ) {
		$pt = $v->parent;
		$list = @$children[$pt] ? $children[$pt] : array();
		array_push( $list, $v );
		$children[$pt] = $list;
	}
	//second pass - get an indent list of the items
	$list = mosTreeRecurse( 0, '', array(), $children, max( 0, $levellimit-1 ) );

	//eventually only pick out the searched items.
	if ($search) {
		$list1 = array();
		foreach ($search_rows as $sid ) {
			foreach ($list as $item) {
				if ($item->id == $sid) {
					$list1[] = $item;
				}
			}
		}
		//replace full list with found items
		$list = $list1;
	}

	$total = count( $list );

	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$levellist = mosHTML::integerSelectList( 1, 20, 1, 'levellimit', 'size="1" onchange="document.adminForm.submit();"', $levellimit );

	//slice out elements based on limits
	$list = array_slice( $list, $pageNav->limitstart, $pageNav->limit );

	$i = 0;
	foreach ( $list as $mitem ) {
		$edit = '';
    switch ( $mitem->type ) {
			case 'separator':
			case 'component_item_link':
			break;
			case 'url':
				if (preg_match('/index.php\?/i', $mitem->link ) ) {
					if (!preg_match('/Itemid\=/i', $mitem->link ) ) {
						$mitem->link .= '&Itemid='. $mitem->id;
					}
				}
			break;
			case 'newsfeed_link':
				$edit = 'index2.php?option=com_newsfeeds&task=edit&hidemainmenu=1A&id='.$mitem->componentid;
				$list[$i]->descrip 	= $adminLanguage->A_CMP_MU_EDNEWSF;
				$mitem->link .= '&Itemid='. $mitem->id;
			break;
			case 'contact_item_link':
				$edit = 'index2.php?option=com_contact&task=editA&hidemainmenu=1&id='.$mitem->componentid;
				$list[$i]->descrip 	= $adminLanguage->A_CMP_MU_EDCONTA;
				$mitem->link .= '&Itemid='. $mitem->id;
			break;
			case 'content_item_link':
				$edit = 'index2.php?option=com_content&task=edit&hidemainmenu=1&id='.$mitem->componentid;
				$list[$i]->descrip 	= $adminLanguage->A_CMP_MU_EDCONTE;
			break;
			case 'content_typed':
				$edit = 'index2.php?option=com_typedcontent&task=edit&hidemainmenu=1&id='.$mitem->componentid;
				$list[$i]->descrip 	= $adminLanguage->A_CMP_MU_EDSTCONTE;
			break;
			default:
				$mitem->link .= '&Itemid='.$mitem->id;
			break;
		}
		$list[$i]->type2 = $mitem->type; //For Help Screens to work. Get the 'type' field from table #__menu
		$list[$i]->link = $mitem->link;
		$list[$i]->edit = $edit;
		$i++;
	}

	$i = 0;
	foreach ( $list as $row ) {
		//pulls name and description from menu type xml
		$row = ReadMenuXML( $row->type, $row->com_name );
		$list[$i]->type = $xmlLanguage->get($row[0]);
		if (!isset($list[$i]->descrip)) { $list[$i]->descrip = $xmlLanguage->get($row[1]); }
		$i++;
	}
	HTML_menusections::showMenusections( $list, $pageNav, $search, $levellist, $menutype, $option );
}


/********************************/
/* PREPARE TO ADD NEW MENU ITEM */
/********************************/
function addMenuItem( &$cid, $menutype, $option, $task ) {
	global $mainframe, $xmlLanguage, $fmanager, $adminLanguage;

	$types = array();

	//list of directories
	$dirs = $fmanager->listFolders($fmanager->PathName($mainframe->getCfg('absolute_path').'/administrator/components/com_menus'));

	//load files for menu types
	$i = 0;
	foreach ($dirs as $dir) {
		//needed within menu type .php files
		$type = $dir;
		$dir = $mainframe->getCfg('absolute_path').SEP.'administrator'.SEP.'components'.SEP.'com_menus'.SEP.$dir.SEP;
		if ( is_dir( $dir ) ) {
			$files = $fmanager->listFiles( $dir, ".\.menu\.php$" );
			foreach ($files as $file) {
				require_once( $dir.$file );
				$types[$i] = new stdClass();
				$types[$i]->type = $type;
				$i++;
			}
		}
	}

	$i = 0;
	foreach ($types as $type) {
		//pulls name and description from menu type xml
		$row = ReadMenuXML( $type->type );
		$types[$i]->name = $xmlLanguage->get($row[0]);
		$types[$i]->descrip = $xmlLanguage->get($row[1]);
		$types[$i]->group = $row[2];
		$i++;
	}

	//sort array of objects alphabetically by name of menu type
	SortArrayObjects( $types, 'name', 1 );

	$menu_types = array(
		'content' => array('title' => $adminLanguage->A_MENU_CONTENT, 'items' => array()),
		'archive' => array('title' => $adminLanguage->A_MENU_ARCHIVE, 'items' => array()),
		'link' => array('title' => $adminLanguage->A_LINKS, 'items' => array()),
		'component' => array('title' => $adminLanguage->A_MENU_COMPONENTS, 'items' => array()),
		'other' => array('title' => $adminLanguage->A_MISCEL, 'items' => array())
	);

	foreach ($types as $type) {
		if (preg_match('/archive/', $type->type)) {
			$menu_types['archive']['items'][] = $type;
		} else if (strstr($type->group, 'Content')) {
			$menu_types['content']['items'][] = $type;
		} else if (strstr($type->group, 'Component')) {
			$menu_types['component']['items'][] = $type;
		} else if (strstr( $type->group, 'Link')) {
			$menu_types['link']['items'][] = $type;
		} else if (strstr( $type->group, 'Other') || !$type->group) {
			$menu_types['other']['items'][] = $type;
		}
	}

	HTML_menusections::addMenuItem($cid, $menutype, $option, $menu_types);
}


/*********************/
/* GENERIC SAVE MENU */
/*********************/
function saveMenu( $option, $task='save' ) {
	global $database, $adminLanguage, $mainframe;

    foreach ($_POST['languages'] as $xlang) {
    	if (trim($xlang) == '') { $newlangs = ''; }
    }
    if (!isset($newlangs)) {
        $newlangs = implode(',', $_POST['languages']);
    }
    $_POST['language'] = $newlangs;

	$params = mosGetParam( $_POST, 'params', '' );
	if (is_array( $params )) {
	    $txt = array();
	    foreach ($params as $k=>$v) {
	        $txt[] = "$k=$v";
		}
		$_POST['params'] = mosParameters::textareaHandling( $txt );
	}

	$row = new mosMenu( $database );

	if (!$row->bind( $_POST )) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}

    if ($row->type == 'wrapper') {
        require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
        $seo = new seovs('com_wrapper', '', $row->seotitle);
        $seo->Itemid = intval($row->id);
        $seoval = $seo->validate();
        if (!$seoval) {
			echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_SEOTITLE.': '.$seo->message."'); window.history.go(-1);</script>"._LEND;
			exit();
        }    
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
	$row->updateOrder( "menutype='$row->menutype' AND parent='$row->parent'" );

	$msg = $adminLanguage->A_CMP_MU_MSGITSAV;
	switch ( $task ) {
		case 'apply':
			mosRedirect( 'index2.php?option='.$option.'&menutype='.$row->menutype.'&task=edit&id='.$row->id.'&hidemainmenu=1', $msg );
			break;

		case 'save':
		default:
			mosRedirect( 'index2.php?option='.$option.'&menutype='.$row->menutype, $msg );
			break;
	}
}


/**
* Publishes or Unpublishes one or more menu sections
* @param database A database connector object
* @param string The name of the category section
* @param array An array of id numbers
* @param integer 0 if unpublishing, 1 if publishing
*/
function publishMenuSection( $cid=null, $publish=1 ) {
	global $database, $mosConfig_absolute_path, $adminLanguage;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		return $adminLanguage->A_SELITEMTO.' '. ($publish ? $adminLanguage->A_PUBLISH : $adminLanguage->A_UNPUBLISH);
	}

	$menu = new mosMenu( $database );
    
	if (!$publish) { $publish = '0'; }

	foreach ($cid as $id) {
		$menu->load( $id );
		$menu->published = $publish;

		if (!$menu->check()) {
			return $menu->getError();
		}
		if (!$menu->store()) {
			return $menu->getError();
		}

		if ($menu->type) {
			$database = &$database;
			$task = $publish ? 'publish' : 'unpublish';
			require( $mosConfig_absolute_path.'/administrator/components/com_menus/'.$menu->type.'/'.$menu->type.'.menu.php' );
		}
	}
	return null;
}


/********************************************/
/* PUBLISH / UNPUBLISH MENU ITEM USING AJAX */
/********************************************/
function ajaxpublishMenu() {
    global $database, $my, $adminLanguage;

    $elem = intval(mosGetParam($_REQUEST, 'elem', 0));
    $id = intval(mosGetParam($_REQUEST, 'id', 0));
    $state = intval(mosGetParam($_REQUEST, 'state', 0));

    if (!$id) {
        echo '<img src="../includes/js/ThemeOffice/warning.png" width="16" height="16" border="0" title="'.$adminLanguage->A_ERROR.': Invalid Item id" />'._LEND;
        exit();
    }

    $error = 0;
	$database->setQuery( "UPDATE #__menu SET published='$state' WHERE id='$id' AND (checked_out=0 OR (checked_out='".$my->id."'))");
	if (!$database->query()) { $error = 1; }

    if ($error) { $state = $state ? 0 : 1; }
    $img = $state ? 'publish_g.png' : 'publish_x.png';
    $alt = $state ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
?>
	<a href="javascript:;" 
    onclick="changeMenuState('<?php echo $elem; ?>', '<?php echo $id; ?>', '<?php echo ($state) ? 0 : 1; ?>');" title="<?php echo $alt; ?>">
	<img src="images/<?php echo $img; ?>" border="0" alt="<?php echo $alt; ?>" /></a>
<?php 
    exit();
}


/****************************/
/* SEND MENU ITEMS TO TRASH */
/****************************/
function TrashMenuSection( $cid=NULL ) {
	global $database, $adminLanguage;

	$cids = implode( ',', $cid );
	$query = "UPDATE #__menu SET published = '-2', ordering = '0' WHERE id IN ( ".$cids." )";
	$database->setQuery( $query );
	if ( !$database->query() ) {
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}

	$total = count( $cid );
	$msg = $total.' '.$adminLanguage->A_ITEMSTRASHED;
	return $msg;
}


/*************************/
/* CANCEL EDIT MENU ITEM */
/*************************/
function cancelMenu( $option ) {
	global $database;

	$menu = new mosMenu( $database );
	$menu->bind( $_POST );
	$menuid = mosGetParam( $_POST, 'menuid', 0 );
	if ( $menuid ) {
		$menu->id = $menuid;
	}
	$menu->checkin();

	mosRedirect( 'index2.php?option='.$option.'&menutype='.$menu->menutype );
}


/**********************/
/* RE-ORDER MENU ITEM */
/**********************/
function orderMenu( $uid, $inc, $option ) {
	global $database;

	$row = new mosMenu( $database );
	$row->load( $uid );
	$row->move( $inc, "menutype='".$row->menutype."' AND parent='".$row->parent."'" );

	mosRedirect( 'index2.php?option='.$option.'&menutype='.$row->menutype );
}


/************************/
/* SET MENU ITEM ACCESS */
/************************/
function accessMenu( $uid, $access, $option, $menutype ) {
	global $database;

	$menu = new mosMenu( $database );
	$menu->load( $uid );
	$menu->access = $access;

	if (!$menu->check()) {
		return $menu->getError();
	}
	if (!$menu->store()) {
		return $menu->getError();
	}

	mosRedirect( 'index2.php?option='.$option.'&menutype='.$menutype );
}


/******************************/
/* PREPARE TO MOVE MENU ITEMS */
/******************************/
function moveMenu( $option, $cid, $menutype ) {
	global $database, $adminLanguage;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_SELITEMMOV."'); window.history.go(-1);</script>\n";
		exit();
	}

	//query to list selected menu items
	$cids = implode( ',', $cid );
	$database->setQuery("SELECT name FROM #__menu WHERE id IN ( ".$cids." )");
	$items = $database->loadObjectList();

	//query to choose menu
	$database->setQuery("SELECT params FROM #__modules WHERE module = 'mod_mainmenu' ORDER BY title");
	$modparams = $database->loadResultArray();

	foreach ( $modparams as $modparam) {
		$params = mosParseParams( $modparam );
		//adds menutype to array
		$type = trim( @$params->menutype );
		$menu[] = mosHTML::makeOption( $type, $type );
	}

	//build the html select list
	$MenuList = mosHTML::selectList( $menu, 'menu', 'class="selectbox" size="10"', 'value', 'text', null );

	HTML_menusections::moveMenu( $option, $cid, $MenuList, $items, $menutype );
}


/****************************************/
/* ADD DESCENDANTS TO LIST OF MENU ID'S */
/****************************************/
function addDescendants($id, &$cid) {
	global $database;

    $database->setQuery("SELECT id FROM #__menu WHERE parent=$id");
    $rows = $database->loadObjectList();
    if ($database->getErrorNum()) {
		echo "<script type=\"text/javascript\">alert('". $database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
    }
	foreach ($rows as $row) {
		$found = false;
		foreach ($cid as $idx)
			if ($idx == $row->id) {
				$found = true;
				break;
			}
		if (!$found) $cid[] = $row->id;
		addDescendants($row->id, $cid);
	}
}


/*************************/
/* SAVE MOVED MENU ITEMS */
/*************************/
function moveMenuSave( $option, $cid, $menu, $menutype ) {
	global $database, $my, $adminLanguage;

	//dd all decendants to the list
	foreach ($cid as $id) { addDescendants($id, $cid); }

	$row = new mosMenu( $database );
	$ordering = 1000000;
	$firstroot = 0;
	foreach ($cid as $id) {
		$row->load( $id );

		//is it moved together with his parent?
		$found = false;
		if ($row->parent != 0)
	        foreach ($cid as $idx)
	            if ($idx == $row->parent) {
	                $found = true;
	                break;
	            }
		if (!$found) {
			$row->parent = 0;
			$row->ordering = $ordering++;
			if (!$firstroot) { $firstroot = $row->id; }
		}

		$row->menutype = $menu;
		if ($row->parent == null) { $row->parent = '0'; }
	    if ( !$row->store() ) {
	        echo "<script type=\"text/javascript\">alert('". $database->getErrorMsg() ."'); window.history.go(-1);</script>\n";
	        exit();
	    }
	}

	if ($firstroot) {
		$row->load( $firstroot );
		$row->updateOrder( "menutype='".$row->menutype."' AND parent='".$row->parent."'" );
	}

	$msg = count($cid).' '.$adminLanguage->A_CMP_MU_MOVEDTO.' '.$menu;
	mosRedirect( 'index2.php?option='.$option.'&menutype='.$menutype, $msg );
}


/******************************/
/* PREPARE TO COPY MENU ITEMS */
/******************************/
function copyMenu( $option, $cid, $menutype ) {
	global $database, $adminLanguage;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_SELITEMMOV."'); window.history.go(-1);</script>\n";
		exit();
	}

	//query to list selected menu items
	$cids = implode( ',', $cid );
	$database->setQuery("SELECT name FROM #__menu WHERE id IN ( ".$cids." )");
	$items = $database->loadObjectList();

	$menuTypes = mosAdminMenus::menutypes();

	foreach ( $menuTypes as $menuType ) {
		$menu[] = mosHTML::makeOption( $menuType, $menuType );
	}

	//build the html select list
	$MenuList = mosHTML::selectList( $menu, 'menu', 'class="selectbox" size="10"', 'value', 'text', null );

	HTML_menusections::copyMenu( $option, $cid, $MenuList, $items, $menutype );
}


/**************************/
/* SAVE COPIED MENU ITEMS */
/**************************/
function copyMenuSave( $option, $cid, $menu, $menutype ) {
	global $database, $adminLanguage;

	$curr = new mosMenu( $database );
	$cidref = array();
	foreach( $cid as $id ) {
		$curr->load( $id );
		$curr->id = NULL;
		if ( !$curr->store() ) {
			echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}
		$cidref[] = array($id, $curr->id);
	}
	foreach ( $cidref as $ref ) {
		$curr->load( $ref[1] );
		if ($curr->parent!=0) {
			$found = false;
			foreach ( $cidref as $ref2 )
				if ($curr->parent == $ref2[0]) {
					$curr->parent = $ref2[1];
					$found = true;
					break;
				}
			if (!$found && $curr->menutype!=$menu) { $curr->parent = 0; }
		}
		$curr->menutype = $menu;
		$curr->ordering = '9999';
		if ( !$curr->store() ) {
			echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}
		$curr->updateOrder( "menutype='".$curr->menutype."' AND parent='".$curr->parent."'" );
	}
	$msg = count( $cid ).' '.$adminLanguage->A_CMP_MU_COPITO.' '.$menu;
	mosRedirect( 'index2.php?option='.$option.'&menutype='.$menutype, $msg );
}


/************************/
/* READ MENU'S XML FILE */
/************************/
function ReadMenuXML($type, $component=-1) {
	global $mainframe;

	if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
	$xmlfile = $mainframe->getCfg('absolute_path').'/administrator/components/com_menus/'.$type.'/'.$type.'.xml';
	$xmlDoc = simplexml_load_file($xmlfile, 'SimpleXMLElement');
	$name = '';
	$descrip = '';
	$group = '';
	if ($xmlDoc) {
		$ok = true;
		if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
			if ($xmlDoc->getName() != 'mosinstall') { $ok = false; }
		}
		if ($ok) {
			$attrs =  $xmlDoc->attributes();
			if ($attrs) {
				if (isset($attrs['type']) && (((string)$attrs['type'] == 'component') || ((string)$attrs['type'] == 'menu'))) {
					$name = isset($xmlDoc->name) ? eUTF::utf8_trim((string)$xmlDoc->name) : '';
					$descrip = isset($xmlDoc->description) ? eUTF::utf8_trim((string)$xmlDoc->description) : '';
					$group = isset($xmlDoc->group) ? eUTF::utf8_trim((string)$xmlDoc->group) : '';
				}
			}
		}
	}

	if (($component <> -1 ) && ($name == 'Component')) { $name .= ' - '.$component; }
	$row = array($name, $descrip, $group);
	return $row;
}


/*************************/
/* SAVE MENU ITEMS ORDER */
/*************************/
function saveOrder($cid, $menutype) {
	global $database, $adminLanguage;

	$total		= count($cid);
	$order 		= mosGetParam( $_POST, 'order', array(0) );
	$conditions = array();

    //update ordering values
	for($i=0; $i < $total; $i++) {
		$database->setQuery("SELECT id, ordering, menutype, parent FROM #__menu WHERE id='".$cid[$i]."'", '#__', 1, 0);
		$row = $database->loadRow(); 
		if ($row && ($row['ordering'] != $order[$i])) {
			$database->setQuery("UPDATE #__menu SET ordering='".intval($order[$i])."' WHERE id=".$row['id']);
			$database->query();
	        //remember to updateOrder this group
	        $condition = "menutype='".$row['menutype']."' AND parent='".$row['parent']."' AND published >= 0";
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
			$row = new mosMenu( $database );
			$row->load( $cond[0] );
			$row->updateOrder( $cond[1] );
			unset($row);
		}
	}

	$msg = $adminLanguage->A_NEWORDERSAVED;
	mosRedirect( 'index2.php?option=com_menus&menutype='.$menutype, $msg );
}


/************************************/
/* DISPLAY CONTENT SEO TITLE (AJAX) */
/************************************/
function viewSEOtitle() {
    global $database;

    $conid = intval(mosGetParam($_POST, 'conid', 0));
    if ($conid) {
        $database->setQuery("SELECT seotitle FROM #__content WHERE id='$conid'", '#__', 1, 0);
        echo $database->loadResult();
    }
    exit();
}

?>