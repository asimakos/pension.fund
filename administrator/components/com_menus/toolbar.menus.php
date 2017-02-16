<?php 
/**
* @ Version: $Id: toolbar.menus.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org All rights reserved
* @ Package: Elxis
* @ Subpackage: Component Menus
* @ Author: Elxis Team
* @ URL: http://www.elxis.org
* @ Email: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


require_once( $mainframe->getPath( 'toolbar_html' ) );
require_once( $mainframe->getPath( 'toolbar_default' ) );

switch ($task) {
	case 'new':
		TOOLBAR_menus::_NEW();
		break;

	case 'movemenu':
		TOOLBAR_menus::_MOVEMENU();
		break;

	case 'copymenu':
		TOOLBAR_menus::_COPYMENU();
		break;

	case 'edit':
		$cid 	= mosGetParam( $_POST, 'cid', array(0) );
		if (!is_array( $cid )) {
			$cid = array(0);
		}
		$path 	= $mosConfig_absolute_path .'/administrator/components/com_menus/';	

		if ( $cid[0] ) {
			global $database;
			$query = "SELECT type FROM #__menu WHERE id = $cid[0]";
			$database->setQuery( $query, '#__', 1, 0);
			$type = $database->loadResult();
			$item_path  = $path . $type . SEP . $type .'.menubar.php';
			
			if ( $type ) {
				if ( file_exists( $item_path  ) ) {
					require_once( $item_path  );
				} else {
					TOOLBAR_menus::_EDIT($type);
				}
			} else {
				echo $database->stderr();
			}
		} else {
			$type 		= mosGetParam( $_REQUEST, 'type', null );
			$item_path  = $path . $type . SEP . $type .'.menubar.php';
			
			if ( $type ) {
				if ( file_exists( $item_path ) ) {
					require_once( $item_path  );
				} else {
					TOOLBAR_menus::_EDIT($type);
				}
			} else {
				TOOLBAR_menus::_EDIT($type);
			}
		}
		break;

	default:
		$type 		= trim( mosGetParam( $_REQUEST, 'type', null ) );
		$item_path  = $path . $type . SEP . $type .'.menubar.php';
		
		if ( $type ) {
			if ( file_exists( $item_path ) ) {
				require_once( $item_path );
			} else {
				TOOLBAR_menus::_DEFAULT();
			}
		} else {
			TOOLBAR_menus::_DEFAULT();
		}
		break;
}
?>