<?php 
/**
* @version: $Id: toolbar.contact.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Contact
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_contact {
	/**
	* Draws the menu for a New Contact
	*/
	static public function _EDIT() {
		global $id, $adminLanguage;
		
		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::spacer();
		if ( $id ) {
			// for existing content items the button is renamed `close`
			mosMenuBar::cancel( 'cancel', $adminLanguage->A_CLOSE );
		} else {
			mosMenuBar::cancel();
		}
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.contactmanager.edit' );
		mosMenuBar::endTable();
	}

	static public function _DEFAULT() {
		mosMenuBar::startTable();
		mosMenuBar::publish();
		mosMenuBar::spacer();
		mosMenuBar::unpublish();
		mosMenuBar::spacer();
		mosMenuBar::addNewX();
		mosMenuBar::spacer();
		mosMenuBar::editListX();
		mosMenuBar::spacer();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.contactmanager.main' );
		mosMenuBar::endTable();
	}
}
?>
