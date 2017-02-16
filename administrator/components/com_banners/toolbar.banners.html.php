<?php 
/**
* @version: $Id: toolbar.banners.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Banners
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_banners {
	/**
	* Draws the menu for to Edit a banner
	*/
	static public function _EDIT() {
		global $id, $adminLanguage;
		
		mosMenuBar::startTable();
		mosMenuBar::media_manager( 'banners' );
		mosMenuBar::spacer();
		mosMenuBar::save();
		mosMenuBar::spacer();
		if ( $id ) {
			// for existing content items the button is renamed `close`
			mosMenuBar::cancel( 'cancel', $adminLanguage->A_CLOSE );
		} else {
			mosMenuBar::cancel();
		}
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.banners.edit' );
		mosMenuBar::endTable();
	}
	static public function _DEFAULT() {
		mosMenuBar::startTable();
		mosMenuBar::publishList();
		mosMenuBar::unpublishList();
		mosMenuBar::media_manager( 'banners' );
		mosMenuBar::addNewX();
		mosMenuBar::editListX();
		mosMenuBar::deleteList();
		mosMenuBar::help( 'elxis.banners' );
		mosMenuBar::endTable();
	}
}


class TOOLBAR_bannerClient {
	/**
	* Draws the menu for to Edit a client
	*/
	static public function _EDIT() {
		global $id, $adminLanguage;
		
		mosMenuBar::startTable();
		mosMenuBar::save( 'saveclient' );
		mosMenuBar::spacer();
		if ( $id ) {
			// for existing content items the button is renamed `close`
			mosMenuBar::cancel( 'cancelclient', $adminLanguage->A_CLOSE );
		} else {
			mosMenuBar::cancel( 'cancelclient' );
		}
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.banners.client.edit' );
		mosMenuBar::endTable();
	}
	/**
	* Draws the default menu
	*/
	static public function _DEFAULT() {
		mosMenuBar::startTable();
		mosMenuBar::addNewX( 'newclient' );
		mosMenuBar::spacer();
		mosMenuBar::editListX( 'editclient' );
		mosMenuBar::spacer();
		mosMenuBar::deleteList( '', 'removeclients' );
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.banners.client' );
		mosMenuBar::endTable();
	}
}
?>
