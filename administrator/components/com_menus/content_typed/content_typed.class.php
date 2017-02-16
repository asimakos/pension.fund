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
* @description: Creates a menu item that links to an autonomous page
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class content_typed_menu {

	/*********************************/
	/* PREPARE TO ADD/EDIT MENU ITEM */
	/*********************************/
	static public function edit( &$uid, $menutype, $option ) {
		global $database, $my, $mainframe, $mosConfig_absolute_path, $adminLanguage;

		$menu = new mosMenu( $database );
		$menu->load( $uid );

		//fail if checked out not by 'me'
		if ($menu->checked_out && $menu->checked_out <> $my->id) {
			echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_CMP_MU_THMOD.' '.$menu.' '.$adminLanguage->A_ISCEDITANADM."'); document.location.href='index2.php?option=$option';</script>"._LEND;
			exit();
		}
		if ( $uid ) {
			$menu->checkout( $my->id );
		} else {
			$menu->type = 'content_typed';
			$menu->menutype = $menutype;
			$menu->browserNav = '0';
			$menu->ordering = 9999;
			$menu->parent = intval( mosGetParam( $_POST, 'parent', 0 ) );
			$menu->published = 1;
			$menu->language = null;
		}

		if ( $uid ) {
			$temp = explode( 'id=', $menu->link );
            $query = "SELECT title, seotitle, id FROM #__content WHERE id = '".$temp[1]."'";
			$database->setQuery( $query, '#__', 1, 0 );
			$content = $database->loadRow();

			//outputs item name, category & section instead of the select list
			$contents = '';
			$link = 'javascript:submitbutton( \'redirect\' );';
			$lists['content'] = '<input type="hidden" name="content_typed" value="'. $temp[1] .'" />';
			$lists['content'] .= '<a href="'. $link .'" title="'.$adminLanguage->A_CMP_TDC_EDSTCNI.'">'. $content['title'].'</a>';

            $lists['seotitle'] = $content['seotitle'];
		} else {
            $query = "SELECT id AS value, title AS text FROM #__content"
			. "\n WHERE state = '1' AND sectionid = '0' AND catid = '0'"
			. "\n ORDER BY id, title"
			;
			$database->setQuery( $query );
			$contents = $database->loadObjectList();

			//Create a list of links
			$lists['content'] = mosHTML::selectList( $contents, 'content_typed', 'class="selectbox" size="10" onclick="viewseotitle(\'content_typed\');"', 'value', 'text', '' );
            $lists['seotitle'] = $adminLanguage->A_CMP_MU_CLVSEO;
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
		content_menu_html::edit( $menu, $lists, $params, $option, $contents );
	}


	static public function redirect( $id ) {
		global $database;

		$menu = new mosMenu( $database );
		$menu->bind( $_POST );
		$menuid = mosGetParam( $_POST, 'menuid', 0 );
		if ( $menuid ) {
			$menu->id = $menuid;
		}
		$menu->checkin();
		mosRedirect( 'index2.php?option=com_typedcontent&task=edit&id='. $id );
	}
}

?>
