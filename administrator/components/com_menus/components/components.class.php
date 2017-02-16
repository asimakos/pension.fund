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
* @description: Creates a menu item that links to a component
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class components_menu {

	/*********************************/
	/* PREPARE TO ADD/EDIT MENU ITEM */
	/*********************************/
	static public function edit( $uid, $menutype, $option ) {
		global $database, $my, $mainframe, $adminLanguage;

		$menu = new mosMenu( $database );
		$menu->load( $uid );

		$row = new mosComponent( $database );
		//load the row from the db table
		$row->load( $menu->componentid );

		//fail if checked out not by 'me'
		if ( $menu->checked_out && $menu->checked_out <> $my->id ) {
			echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_CMP_MU_THMOD.' '.$menu.' '.$adminLanguage->A_ISCEDITANADM. "'); document.location.href='index2.php?option=$option'</script>\n";
			exit();
		}

		if ( $uid ) {
			$menu->checkout( $my->id );
		} else {
			$menu->type = 'components';
			$menu->menutype = $menutype;
			$menu->browserNav = 0;
			$menu->ordering = 9999;
			$menu->parent = intval( mosGetParam( $_POST, 'parent', 0 ) );
			$menu->published = 1;
			$menu->language = null;
		}

		$ora = (in_array($database->_resource->databaseType, array('oci8', 'oci8po', 'oci805', 'oracle'))) ? 1 : 0;
		if ($ora) {
			$query = "SELECT id AS value, name AS text, link FROM #__components WHERE link IS NOT NULL ORDER BY name";
		} else {
			$query = "SELECT id AS value, name AS text, link FROM #__components WHERE link <> '' ORDER BY name";
		}
		$database->setQuery( $query );
		$components = $database->loadObjectList();

		//build the html select list for section
		$lists['componentid'] = mosAdminMenus::Component( $menu, $uid );
		//componentname
		$lists['componentname'] = mosAdminMenus::ComponentName( $menu, $uid );
		//build the html select list for ordering
		$lists['ordering'] = mosAdminMenus::Ordering( $menu, $uid );
		//build the html select list for the group access
		$lists['access'] = mosAdminMenus::Access( $menu );
		//build the html select list for paraent item
		$lists['parent'] = mosAdminMenus::Parent( $menu );
		//build published button option
		$lists['published'] = mosAdminMenus::Published( $menu );
		//build the url link output
		$lists['link'] = mosAdminMenus::Link( $menu, $uid );
	    //build the html multiple select list for language selection
	    $lists['languages']	= mosAdminMenus::SelectLanguages( 'languages', $menu->language, $adminLanguage->A_ALL_LANGS );

		//get params definitions
		$params = new mosParameters( $menu->params, $mainframe->getPath( 'com_xml', $row->option ), 'component' );

		components_menu_html::edit( $menu, $components, $lists, $params, $option );
	}
}
?>