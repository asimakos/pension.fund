<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org All rights reserved
* @package: Elxis
* @subpackage: Component Menus
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Creates a menu item that links to a bridge
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class bridge_menu {

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

		if ($uid) {
			$menu->checkout( $my->id );
		} else {
			$menu->type = 'bridge';
			$menu->menutype = $menutype;
			$menu->browserNav = 0;
			$menu->ordering = 9999;
			$menu->parent = intval( mosGetParam( $_POST, 'parent', 0 ) );
			$menu->published = 1;
			$menu->language = null;
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
		//build the bridge link output

        if (!file_exists($mainframe->getCfg('absolute_path').'/administrator/components/com_bridge/config.bridge.php')) {
			echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_CMP_MU_BRINOINS."'); document.location.href='index2.php?option=$option'</script>\n";
			exit();
        }
        require_once($mainframe->getCfg('absolute_path').'/administrator/components/com_bridge/config.bridge.php');
        require_once($mainframe->getCfg('absolute_path').'/administrator/components/com_bridge/bridge.class.php' );

        $eBRI = new elxisBridge;
        $actives = $eBRI->bridges;
        
        if ($uid) { $nowlink = $menu->link; }
        if (count($actives) > 0) {
            foreach($actives as $active) {
                $link = 'index.php?option=com_bridge&brid='.$active['registry'];
                $gefyres[] = mosHTML::makeOption($link, $active['bridge'] );
                if(!isset($nowlink)) { $nowlink = $link; }
            }
            $lists['bridges'] = mosHTML::selectList( $gefyres, 'link', 'class="selectbox" size="1" dir="ltr"', 'value', 'text', $nowlink );
        } else {
			echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_CMP_MU_NOPUBBRI."'); document.location.href='index2.php?option=$option'</script>\n";
			exit();
        }

	    //build the html multiple select list for language selection
	    $lists['languages']	= mosAdminMenus::SelectLanguages( 'languages', $menu->language, $adminLanguage->A_ALL_LANGS );

		//get params definitions
		$params = new mosParameters( $menu->params, $mainframe->getPath( 'menu_xml', $menu->type ), 'menu' );

		bridge_menu_html::edit( $menu, $lists, $params, $option );
	}
}

?>