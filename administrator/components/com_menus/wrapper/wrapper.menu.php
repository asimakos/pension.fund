<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org All rights reserved
* @package: Elxis
* @subpackage: Component Menus
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Creates a menu item to display a wrapped page
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


mosAdminMenus::menuItem( $type );

switch ( $task ) {
	case 'wrapper':
		//this is the new item, ie, the same name as the menu `type`
		wrapper_menu::edit( 0, $menutype, $option );
	break;
	case 'edit':
		wrapper_menu::edit( $cid[0], $menutype, $option );
	break;
	case 'save':
	case 'apply':
		wrapper_menu::saveMenu( $option, $task );
	break;
	case 'validate':
	   wrapper_menu::validate();
	break;
	case 'suggest':
	   wrapper_menu::suggest();
	break;
}

?>