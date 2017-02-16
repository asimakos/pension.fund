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
* @description: Creates a menu item that links to a content item
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class content_item_link_menu {

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
			$menu->type = 'content_item_link';
			$menu->menutype = $menutype;
			$menu->browserNav = 0;
			$menu->ordering = 9999;
			$menu->parent = intval( mosGetParam( $_POST, 'parent', 0 ) );
			$menu->published = 1;
			$menu->language = null;
		}

		if ( $uid ) {
			$link = 'javascript:submitbutton( \'redirect\' );';

			$temp = explode( 'id=', $menu->link );
			 $query = "SELECT a.title, c.name AS category, s.name AS section"
			. "\n FROM #__content a"
			. "\n LEFT JOIN #__categories c ON a.catid = c.id"
			. "\n LEFT JOIN #__sections s ON a.sectionid = s.id"
			. "\n WHERE a.id = '".$temp[1]."'";
			$database->setQuery( $query, '#__', 1, 0 );
			$content = $database->loadRow();

			//outputs item name, category & section instead of the select list
			$lists['content'] = '
			<table width="100%">
			<tr>
				<td width="20%">'.$adminLanguage->A_CMP_MU_ITEM.':</td>
				<td><a href="'.$link.'" title="'.$adminLanguage->A_CMP_MU_EDCOI.'">'.$content['title'].'</a></td>
			</tr>
			<tr>
				<td>'.$adminLanguage->A_CATEGORY.':'.'</td>
				<td>'.$content['category'].'</td>
			</tr>
			<tr>
				<td>'.$adminLanguage->A_SECTION.':'.'</td>
				<td>'.$content['section'].'</td>
			</tr>
			</table>';

			$contents = '';
			$lists['content'] .= '<input type="hidden" name="content_item_link" value="'. $temp[1] .'" />';
		} else {
			$query = "SELECT a.id AS value, a.title AS text, a.sectionid, a.catid, c.title AS category, s.title AS section"
			."\n FROM #__content a"
			."\n INNER JOIN #__categories c ON a.catid = c.id"
			."\n INNER JOIN #__sections s ON a.sectionid = s.id"
			."\n WHERE a.state = '1' AND s.scope = 'content'"
			."\n ORDER BY a.sectionid, a.catid, a.title";
			$database->setQuery( $query );
			$contents = $database->loadObjectList();

			foreach ( $contents as $content ) {
				$value = $content->value;
				$text = $content->section." / ".$content->category." / ".$content->text."&nbsp;&nbsp;";

				$temp[] = mosHTML::makeOption( $value, $text );
				$contents = $temp;
			}

			//Create a list of links
			$lists['content'] = mosHTML::selectList( $contents, 'content_item_link', 'class="selectbox" size="15"', 'value', 'text', '' );
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

		content_item_link_menu_html::edit( $menu, $lists, $params, $option, $contents );
	}


    /*********************************/
    /* REDIRECT TO EDIT CONTENT ITEM */
    /*********************************/
	static public function redirect( $id ) {
		global $database;

	    foreach ($_POST['languages'] as $xlang) {
	    	if (trim($xlang) == '') { $newlangs = ''; }
	    }
	    if (!isset($newlangs)) {
	    	$newlangs = implode(',', $_POST['languages']);
	    }
	    $_POST['language'] = $newlangs;

		$menu = new mosMenu( $database );
		$menu->bind( $_POST );
		$menuid = mosGetParam( $_POST, 'menuid', 0 );
		if ( $menuid ) {
			$menu->id = $menuid;
		}
		$menu->checkin();

		mosRedirect( 'index2.php?option=com_content&task=edit&id='.$id );
	}
}

?>