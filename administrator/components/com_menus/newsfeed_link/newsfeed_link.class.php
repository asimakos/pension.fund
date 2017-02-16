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
* @description: Creates a menu item that links to a newsfeed item
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class newsfeed_link_menu {


    /*********************************/
    /* PREPARE TO ADD/EDIT MENU ITEM */
    /*********************************/
	static public function edit( &$uid, $menutype, $option ) {
		global $database, $my, $mainframe, $mosConfig_absolute_path, $adminLanguage;

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
			$menu->type = 'newsfeed_link';
			$menu->menutype = $menutype;
			$menu->browserNav = 0;
			$menu->ordering = 9999;
			$menu->parent = intval( mosGetParam( $_POST, 'parent', 0 ) );
			$menu->published = '1';
			$menu->language = null;
		}

		if ( $uid ) {
			$temp = explode( 'feedid=', $menu->link );
			$query = "SELECT a.name, c.title AS category FROM #__newsfeeds a"
			."\n INNER JOIN #__categories c ON a.catid = c.id"
			."\n WHERE a.id = '".$temp[1]."'";
			$database->setQuery( $query, '#__', 1, 0 );
			$newsfeed = $database->loadRow();

			//outputs item name, category & section instead of the select list
			$lists['newsfeed'] = '
			<table width="100%">
			<tr>
				<td width="20%">'.$adminLanguage->A_CMP_MU_ITEM.':</td>
				<td>'.$newsfeed['name'].'</td>
			</tr>
			<tr>
				<td>'.$adminLanguage->A_POSITION.':</td>
				<td>'.$newsfeed['category'].'</td>
			</tr>
			</table>';
			$lists['newsfeed'] .= '<input type="hidden" name="newsfeed_link" value="'.$temp[1].'" />';
			$newsfeeds = '';
		} else {
            $query = "SELECT a.id AS value, ".$database->_resource->Concat( 'c.title', '\' - \'', 'a.name' )." AS text, a.catid"
			."\n FROM #__newsfeeds a"
			."\n INNER JOIN #__categories c ON a.catid = c.id"
			."\n WHERE a.published = '1'"
			."\n ORDER BY a.catid, a.name";
			$database->setQuery( $query );
			$newsfeeds = $database->loadObjectList( );

			//Create a list of links
			$lists['newsfeed'] = mosHTML::selectList( $newsfeeds, 'newsfeed_link', 'class="selectbox" size="10"', 'value', 'text', '' );
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
		$lists['link'] 		= mosAdminMenus::Link( $menu, $uid );
	    //build the html multiple select list for language selection
	    $lists['languages']	= mosAdminMenus::SelectLanguages( 'languages', $menu->language, $adminLanguage->A_ALL_LANGS );

		//get params definitions
		$params = new mosParameters( $menu->params, $mainframe->getPath( 'menu_xml', $menu->type ), 'menu' );

		newsfeed_link_menu_html::edit( $menu, $lists, $params, $option, $newsfeeds );
	}
}

?>