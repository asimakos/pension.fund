<?php 
/**
* @version: $Id: component_item_link.class.php 2498 2009-09-15 16:43:29Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org All rights reserved
* @package: Elxis
* @subpackage: Component Menus
* @author: Elxis Team
* @link: http://www.elxis.org
* @emil: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Creates a menu item that links to a component item
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class component_item_link_menu {

    /*********************************/
    /* PREPARE TO ADD/EDIT MENU ITEM */
    /*********************************/
	static public function edit( &$uid, $menutype, $option ) {
		global $database, $my, $mainframe, $adminLanguage;

		$menu = new mosMenu( $database );
		$menu->load( $uid );
	
		//fail if checked out not by 'me'
		if ($menu->checked_out && $menu->checked_out <> $my->id) {
			echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_CMP_MU_THMOD.' '.$menu.' '.$adminLanguage->A_ISCEDITANADM."'); document.location.href='index2.php?option=$option'</script>\n";
			exit();
		}
	
		if ( $uid ) {
			$menu->checkout( $my->id );
		} else {
			$menu->type = 'component_item_link';
			$menu->menutype = $menutype;
			$menu->browserNav = 0;
			$menu->ordering = 9999;
			$menu->parent = intval( mosGetParam( $_POST, 'parent', 0 ) );
			$menu->published = 1;
			$menu->language = null;
		}
	
		if ( $uid ) {
			$temp = explode( '&Itemid=', $menu->link );
			$query = "SELECT name FROM #__menu WHERE link = '".$temp[0]."'";
			$database->setQuery( $query );
			$components = $database->loadResult();
			$lists['components'] =  $components;
			$lists['components'] .= '<input type="hidden" name="link" value="'.$menu->link.'" />';
		} else {
			$query = "SELECT ".$database->_resource->Concat( 'link', '\'&amp;Itemid=\'', 'id' )." AS value, name AS text"
			."\n FROM #__menu"
            ."\n WHERE published = '1' AND type = 'components' ORDER BY menutype, name";
			$database->setQuery( $query );
			$components = $database->loadObjectList( );
	
			//Create a list of links
			$lists['components'] = mosHTML::selectList( $components, 'link', 'class="selectbox" size="10"', 'value', 'text', '' );
		}
	
		//build html select list for target window
		$lists['target'] 	= mosAdminMenus::Target( $menu );
		//build the html select list for ordering
		$lists['ordering'] 	= mosAdminMenus::Ordering( $menu, $uid );
		//build the html select list for the group access
		$lists['access'] 	= mosAdminMenus::Access( $menu );
		//build the html select list for paraent item
		$lists['parent'] 	= mosAdminMenus::Parent( $menu );
		//build published button option
		$lists['published'] = mosAdminMenus::Published( $menu );
		//build the url link output
		$lists['link'] 		= mosAdminMenus::Link( $menu, $uid, 1 );
	    //build the html multiple select list for language selection
	    $lists['languages']	= mosAdminMenus::SelectLanguages( 'languages', $menu->language, $adminLanguage->A_ALL_LANGS );

		//get params definitions
		$params = new mosParameters( $menu->params, $mainframe->getPath( 'menu_xml', $menu->type ), 'menu' );
	
		component_item_link_menu_html::edit( $menu, $lists, $params, $option );
	}
} 
?>