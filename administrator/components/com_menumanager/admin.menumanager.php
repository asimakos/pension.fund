<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Menu Manager
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!($acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_menumanager' ) || $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'all' ))) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );

$menu = mosGetParam( $_GET, 'menu', '' );
$task = mosGetParam( $_REQUEST, 'task', array(0) );
$type = mosGetParam( $_POST, 'type', '' );
$cid = mosGetParam( $_POST, 'cid', '' );

switch ($task) {
	case 'new':
		editMenu( $option, '' );
	break;
	case 'edit':
		if ( !$menu ) { $menu = $cid[0]; }
		editMenu( $option, $menu );
	break;
	case 'savemenu':
		saveMenu();
	break;
	case 'deleteconfirm':
		deleteconfirm( $option, $cid[0] );
	break;
	case 'deletemenu':
		deleteMenu( $option, $cid, $type );
	break;
	case 'copyconfirm':
		copyConfirm( $option, $cid[0] );
	break;
	case 'copymenu':
		copyMenu( $option, $cid, $type );
	break;
	case 'cancel':
		cancelMenu( $option );
	break;
	default:
	   showMenu( $option );
	break;
}


/*************************************/
/* PREPARE LIST OF MENUMANAGER ITEMS */
/*************************************/
function showMenu( $option ) {
	global $database, $mainframe, $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{". $option ."}limitstart", 'limitstart', 0 );

	$menuTypes = mosAdminMenus::menutypes();
	$total = count( $menuTypes );
	$i = 0;

	$menus = array();
	foreach ( $menuTypes as $a ) {
		$menus[$i] = new stdClass();
		$menus[$i]->type = $a;

		//query to get number of modules for menutype
		$query = "SELECT COUNT( id ) FROM #__modules WHERE module = 'mod_mainmenu' AND params LIKE '%$a%'";
		$database->setQuery( $query );
		$modules = $database->loadResult();

		if ( !$modules ) { $modules = '-'; }
		$menus[$i]->modules = $modules;
		$i++;
	}

	//Query to get published menu item counts
	$query = "SELECT menutype, COUNT( menutype ) AS num FROM #__menu"
	."\n WHERE published = '1' GROUP BY menutype ORDER BY menutype";
	$database->setQuery( $query );
	$published = $database->loadObjectList();

	//Query to get unpublished menu item counts
	$query = "SELECT menutype, COUNT( menutype ) AS num FROM #__menu"
	."\n WHERE published = '0' GROUP BY menutype ORDER BY menutype";
	$database->setQuery( $query );
	$unpublished = $database->loadObjectList();

	//Query to get trash menu item counts
	$query = "SELECT menutype, COUNT( menutype ) AS num FROM #__menu"
	."\n WHERE published = '-2' GROUP BY menutype ORDER BY menutype";
	$database->setQuery( $query );
	$trash = $database->loadObjectList();

	for( $i = 0; $i < $total; $i++ ) {
		//adds published count
		foreach ( $published as $count ) {
			if ( $menus[$i]->type == $count->menutype ) {
				$menus[$i]->published = $count->num;
			}
		}
		if ( @!$menus[$i]->published ) {
			$menus[$i]->published = '-';
		}
		//adds unpublished count
		foreach ( $unpublished as $count ) {
			if ( $menus[$i]->type == $count->menutype ) {
				$menus[$i]->unpublished = $count->num;
			}
		}
		if ( @!$menus[$i]->unpublished ) {
			$menus[$i]->unpublished = '-';
		}
		//adds trash count
		foreach ( $trash as $count ) {
			if ( $menus[$i]->type == $count->menutype ) {
				$menus[$i]->trash = $count->num;
			}
		}
		if ( @!$menus[$i]->trash ) {
			$menus[$i]->trash = '-';
		}
	}

	require_once( $GLOBALS['mosConfig_absolute_path'].'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	HTML_menumanager::show( $option, $menus, $pageNav );
}


/****************************************/
/* PREPARE TO ADD/EDIT MENUMANAGER ITEM */
/****************************************/
function editMenu( $option, $menu ) {
	global $database;

	if( $menu ) {
		$row = new stdClass();
		$row->menutype = $menu;
	} else {
		$row = new mosModule( $database );
		//setting default values
		$row->menutype = '';
		$row->iscore = 0;
		$row->published = 0;
		$row->position = 'left';
		$row->module = 'mod_mainmenu';
	}

	HTML_menumanager::edit( $row, $option );
}


/******************/
/* SAVE MENU ITEM */
/******************/
function saveMenu() {
	global $database, $adminLanguage, $mainframe;

	$menutype = mosGetParam( $_POST, 'menutype', '' );
	$old_menutype = mosGetParam( $_POST, 'old_menutype', '' );
	$new = intval(mosGetParam($_POST, 'new', 1));

	//block to stop renaming of 'mainmenu' menutype
	if ((($old_menutype == 'mainmenu') && ($menutype != 'mainmenu')) || (($old_menutype == 'systemmenu') && ($menutype != 'systemmenu'))) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_CMP_MMA_CANTREN."'); window.history.go(-1);</script>\n";
		exit();
	}

	//check for unique menutype for new menus
	$database->setQuery("SELECT params FROM #__modules WHERE module = 'mod_mainmenu'");
	$menus = $database->loadResultArray();

	foreach ( $menus as $menu ) {
		$params = mosParseParams( $menu );
		if ( $params->menutype == $menutype ) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_CMP_MMA_UNIQUE."'); window.history.go(-1);</script>\n";
			exit();
		}
	}

	switch ( $new ) {
		case 1: 
            //create a new module for the new menu
			$row = new mosModule($database);
			$row->bind( $_POST );

			$row->params = 'menutype='. $menutype;

			//check then store data in db
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
			$row->updateOrder( "position='". $row->position ."'" );

			//module assigned to show on All pages by default
			$query = "INSERT INTO #__modules_menu VALUES ( '".$row->id."', '0' )";
			$database->setQuery( $query );
			if ( !$database->query() ) {
				$mainframe->checkSendHeaders();
				echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
				exit();
			}

			$msg = $adminLanguage->A_CMP_MMA_CREATED.' [ '. $menutype .' ]';
		break;
		default:
            //change menutype being of all mod_mainmenu modules calling old menutype
			$query = "SELECT id FROM #__modules"
			."\n WHERE module = 'mod_mainmenu' AND params LIKE '%$old_menutype%'";
			$database->setQuery( $query );
			$modules = $database->loadResultArray();

			foreach ( $modules as $module ) {
				$row = new mosModule( $database );
				$row->load( $module );

				$save = 0;
				$params = mosParseParams( $row->params );
				if ( $params->menutype == $old_menutype ) {
					$params->menutype 	= $menutype;
					$save 				= 1;
				}

				//save changes to module 'menutype' param
				if ($save) {
					$txt = array();
					foreach ( $params as $k=>$v) {
						$txt[] = "$k=$v";
					}
					$row->params = implode( "\n", $txt );

					//check then store data in db
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
				}
			}

            //change menutype of all menuitems using old menutype
			if ( $menutype <> $old_menutype ) {
				$query = "UPDATE #__menu SET menutype = '$menutype' WHERE menutype = '$old_menutype'";
				$database->setQuery( $query );
				$database->query();
			}

			$msg = $adminLanguage->A_CMP_MMA_UPDATED;
			break;
	}

	mosRedirect( 'index2.php?option=com_menumanager', $msg );
}


/**************************/
/* PREPARE TO DELETE MENU */
/**************************/
function deleteConfirm( $option, $type ) {
	global $database, $adminLanguage, $mainframe;

	if (($type == 'mainmenu') || ($type == 'systemmenu')) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".addslashes($adminLanguage->A_CMP_MMA_ALCDEL)."'); window.history.go(-1);</script>\n";
		exit();
	}

	//list of menu items to delete
	$query = "SELECT name, id FROM #__menu WHERE menutype IN ( '$type' ) ORDER BY name";
	$database->setQuery( $query );
	$items = $database->loadObjectList();

	//list of modules to delete
	$query = "SELECT id FROM #__modules WHERE module = 'mod_mainmenu' AND params LIKE '%$type%'";
	$database->setQuery( $query );
	$mods = $database->loadResultArray();

	foreach ( $mods as $module ) {
		$row = new mosModule( $database );
		$row->load( $module );

		$params = mosParseParams( $row->params );
		if ( $params->menutype == $type ) {
			$mid[] = $module;
		}
	}

	@$mids = implode( ',', $mid );

	$query = "SELECT id, title FROM #__modules WHERE id IN ( $mids )";
	$database->setQuery( $query );
	@$modules = $database->loadObjectList();

	HTML_menumanager::showDelete( $option, $type, $items, $modules );
}


/****************/
/* DELETE MENUS */
/****************/
function deleteMenu( $option, $cid, $type ) {
	global $database, $adminLanguage, $mainframe;

	if (($type == 'mainmenu') || ($type == 'systemmenu')) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".addslashes($adminLanguage->A_CMP_MMA_ALCDEL). "'); window.history.go(-1);</script>\n";
		exit();
	}

	$mids = mosGetParam( $_POST, 'mids', 0 );
	if ( is_array( $mids ) ) {
		$mids = implode( ',', $mids );
	}
	//delete menu items
	$database->setQuery("DELETE FROM #__menu WHERE id IN ( $mids )");
	if ( !$database->query() ) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('". $database->getErrorMsg() ."');</script>\n";
		exit();
	}

	if ( is_array( $cid ) ) {
		$cids = implode( ',', $cid );
	} else {
		$cids = $cid;
	}

	//checks whether any modules to delete
	if ( $cids ) {
		//delete modules
		$database->setQuery( "DELETE FROM #__modules WHERE id IN ( $cids )" );
		if ( !$database->query() ) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('". $database->getErrorMsg() ."'); window.history.go(-1);</script>\n";
			exit();
		}
		//delete all module entires in mos_modules_menu
		$database->setQuery( "DELETE FROM #__modules_menu WHERE moduleid IN ( ".$cids." )" );
		if ( !$database->query() ) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\"> alert('". $database->getErrorMsg() ."');</script>\n";
			exit();
		}

		//reorder modules after deletion
		$mod = new mosModule( $database );
		$mod->ordering = 0;
		$mod->updateOrder( "position='left'" );
		$mod->updateOrder( "position='right'" );
	}

	mosRedirect( 'index2.php?option='.$option, $adminLanguage->A_CMP_MMA_DELETED );
}


/*************************/
/* PREPARE TO COPY ITEMS */
/*************************/
function copyConfirm( $option, $type ) {
	global $database;

	//Content Items query
	$query = "SELECT name, id FROM #__menu WHERE menutype IN ( '".$type."' ) ORDER BY name";
	$database->setQuery( $query );
	$items = $database->loadObjectList();

	HTML_menumanager::showCopy( $option, $type, $items );
}


/*************/
/* COPY MENU */
/*************/
function copyMenu( $option, $cid, $type ) {
	global $database, $adminLanguage, $mainframe;

	$menu_name = mosGetParam( $_POST, 'menu_name', $adminLanguage->A_CMP_MMA_NEWMENU );
	$module_name = mosGetParam( $_POST, 'module_name', $adminLanguage->A_CMP_MMA_NEWMODU );

	//check for unique menutype for new menu copy
	$database->setQuery("SELECT params FROM #__modules WHERE module = 'mod_mainmenu'");
	$menus = $database->loadResultArray();
	foreach ( $menus as $menu ) {
		$params = mosParseParams( $menu );
		if ( $params->menutype == $menu_name ) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_CMP_MMA_UNIQUE."'); window.history.go(-1);</script>\n";
			exit();
		}
	}

	//copy the menu items
	$mids 		= mosGetParam( $_POST, 'mids', '' );
	$total 		= count( $mids );
	$copy 		= new mosMenu( $database );
	$original 	= new mosMenu( $database );
	sort( $mids );
	$a_ids 		= array();

	foreach( $mids as $mid ) {
        $database->setQuery("SELECT language FROM #__menu WHERE id='$mid'", '#__', 1, 0);
        $mlang = $database->loadResult();

		$original->load( $mid );
		$copy 			= $original;
		$copy->id 		= NULL;
		$copy->parent 	= $a_ids[$original->parent];
		$copy->menutype = $menu_name;
        $copy->language = $mlang;

		if (!$copy->check()) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$copy->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}
		if (!$copy->store()) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$copy->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}
		$a_ids[$original->id] = $copy->id;
	}

	//create the module copy
	$row = new mosModule( $database );
	$row->load( 0 );
	$row->title 	= $module_name;
	$row->iscore 	= 0;
	$row->published = 1;
	$row->position 	= 'left';
	$row->module 	= 'mod_mainmenu';
	$row->params 	= 'menutype='. $menu_name;

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
	$row->updateOrder( "position='". $row->position ."'" );
	//module assigned to show on All pages by default
	$query = "INSERT #__modules_menu VALUES ( '$row->id', '0' )";
	$database->setQuery( $query );
	if ( !$database->query() ) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}

	$msg = $adminLanguage->A_CMP_MMA_COPYOF." `".$type."` ".$adminLanguage->A_CMP_MMA_CONSIST." ".$total." ".$adminLanguage->A_ITEMS;
	mosRedirect( 'index2.php?option='.$option, $msg );
}


/********************/
/* CANCEL EDIT MENU */
/********************/
function cancelMenu( $option ) {
	mosRedirect( 'index2.php?option='.$option.'&task=view' );
}

?>