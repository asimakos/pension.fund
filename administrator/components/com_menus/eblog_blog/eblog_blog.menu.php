<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org All rights reserved
* @package: Elxis
* @subpackage: Component Menus
* @author: Ioannis Sannos (Elxis Team)
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Creates a menu item that links to a published eBlog blog
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


mosAdminMenus::menuItem( $type );

switch ( $task ) {
	case 'eblog_blog':
		//this is the new item, ie, the same name as the menu `type`
		eblog_blog_menu::edit( 0, $menutype, $option );
	break;
	case 'edit':
		eblog_blog_menu::edit( $cid[0], $menutype, $option );
	break;
	case 'save':
	case 'apply':
		saveMenu( $option, $task );
	break;
}
?>