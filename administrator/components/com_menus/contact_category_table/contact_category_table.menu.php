<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org All rights reserved
* @package: Elxis
* @subpackage: Component Menus
* @author: Elxis Team
* @link: http://www.elxis.org
* @emil: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Creates a menu item that links to a contact category
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


mosAdminMenus::menuItem( $type );

switch ($task) {
	case 'contact_category_table':
		//this is the new item, ie, the same name as the menu `type`
		contact_category_table_menu::editCategory( 0, $menutype, $option );
	break;
	case 'edit':
		contact_category_table_menu::editCategory( $cid[0], $menutype, $option );
	break;
	case 'save':
	case 'apply':
		saveMenu( $option, $task );
	break;
}
?>