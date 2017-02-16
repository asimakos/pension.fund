<?php 
/**
* @version: $Id: toolbar.menus.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org All rights reserved
* @package: Elxis
* @subpackage: Component Menus
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_menus {
	/**
	* Draws the menu for a New top menu item
	*/
	static public function _NEW()	{
		global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::customX( 'edit', 'next.png', 'next_f2.png', $adminLanguage->A_NEXT, true );
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.menus.new' );
		mosMenuBar::endTable();
	}

	/**
	* Draws the menu to Move Menut Items
	*/
	static public function _MOVEMENU()	{
		global $adminLanguage;
		mosMenuBar::startTable();
        mosMenuBar::custom( 'movemenusave', 'move.png', 'move_f2.png', $adminLanguage->A_MOVE, false );
		mosMenuBar::spacer();
		mosMenuBar::cancel( 'cancelmovemenu' );
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.menus.move' );
		mosMenuBar::endTable();
	}

	/**
	* Draws the menu to Move Menut Items
	*/
	static public function _COPYMENU()	{
		global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::custom( 'copymenusave', 'copy.png', 'copy_f2.png', $adminLanguage->A_COPY, false );
		mosMenuBar::spacer();
		mosMenuBar::cancel( 'cancelcopymenu' );
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.menus.copy' );
		mosMenuBar::endTable();
	}

	/**
	* Draws the menu to edit a menu item
	*/
	static public function _EDIT($type) {
		global $id, $adminLanguage;
        $hs='';

		if ( !$id ) {
			$cid = mosGetParam( $_POST, 'cid', array(0) );
			$id = $cid[0];
		}
		$menutype 	= mosGetParam( $_REQUEST, 'menutype', 'mainmenu' );

		mosMenuBar::startTable();
		if ( !$id ) {
			$link = 'index2.php?option=com_menus&menutype='. $menutype .'&task=new&hidemainmenu=1';
			mosMenuBar::back( $adminLanguage->A_BACK, $link );
			mosMenuBar::spacer();
		}
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::apply();
		mosMenuBar::spacer();
		if ( $id ) {
			// for existing content items the button is renamed `close`
			mosMenuBar::cancel( 'cancel', $adminLanguage->A_CLOSE );
		} else {
			mosMenuBar::cancel();
		}
		mosMenuBar::spacer();
		//Displays the right help screen based on the
		//$type parameter
    switch ($type){
		case 'content_blog_category': //Blog - Content Category 
		    $hs='elxis.menus.content_blog_category';
		    break;
		case 'content_archive_category': //Blog - Content Category Archive 
		    $hs='elxis.menus.content_archive_category';
		    break;
		case 'content_blog_section': //Blog - Content Section 
		    $hs='elxis.menus.content_blog_section';
		    break;
		case 'content_archive_section': //Blog - Content Section Archive 
		    $hs='elxis.menus.content_archive_section';
		    break;
		case 'content_item_link': //Link - Content Item 
		    $hs='elxis.menus.content_item_link';
		    break;
		case 'content_typed': //Link - Static Content 
		    $hs='elxis.menus.content_typed';
		    break;
		case 'content_category': //Table - Content Category 
		    $hs='elxis.menus.content_category';
		    break;
		case 'content_section': //Table - Content Section 
		    $hs='elxis.menus.content_section';
		    break;
		case 'components': //Component
		    $hs='elxis.menus.components';
		    break;
		case 'component_item_link': //Link - Component Item 
		    $hs='elxis.menus.component_item_link';
		    break;
		case 'contact_item_link': //Link - Contact Item
		    $hs='elxis.menus.contact_item_link';
		    break;
		case 'newsfeed_link': //Link - Newsfeed
		    $hs='elxis.menus.newsfeed_link';
		    break;
		case 'contact_category_table': //Table - Contact Category
			$hs='elxis.menus.contact_category_table';
		    break;
		case 'newsfeed_category_table': //Table - Newsfeed Category
		    $hs='elxis.menus.newsfeed_category_table';
		    break;
		case 'weblink_category_table': //Table - Weblink Category
		    $hs='elxis.menus.weblink_category_table';
		    break;
		case 'url': //Link - URL
		    $hs='elxis.menus.url';
		    break;
		case 'separator':
		    $hs='elxis.menus.separator';
		    break;
		case 'wrapper':
		    $hs='elxis.menus.wrapper';
		    break;
		case 'bridge':
		    $hs='elxis.menus.bridge';
		    break;
		case 'system':
		    $hs='elxis.menus.system';
		    break;
		default:
		    $hs='default';
		    break;
		}
		mosMenuBar::help( $hs );  
    //mosMenuBar::help( 'elxis.menus.edit' );
		mosMenuBar::endTable();
	}

	static public function _DEFAULT() {
		global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::addNewX();
		mosMenuBar::spacer();
		mosMenuBar::editListX();
		mosMenuBar::spacer();
		mosMenuBar::publishList();
		mosMenuBar::spacer();
		mosMenuBar::unpublishList();
		mosMenuBar::spacer();
		mosMenuBar::customX( 'movemenu', 'move.png', 'move_f2.png', $adminLanguage->A_MOVE, true );
		mosMenuBar::spacer();
		mosMenuBar::customX( 'copymenu', 'copy.png', 'copy_f2.png', $adminLanguage->A_COPY, true );
		mosMenuBar::spacer();
		mosMenuBar::trash();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.menus' );
		mosMenuBar::endTable();
	}
}
?>
