<?php 
/**
* @version: $Id: toolbar.users.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Users
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_users {

	//Draws the menu to edit a user
	static public function _EDIT() {
		global $id, $adminLanguage;

		mosMenuBar::startTable();
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
		mosMenuBar::help( 'elxis.users.edit' );
		mosMenuBar::endTable();
	}

	static public function _EXTRA() {
        //global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::addNewX('editExtra');
		mosMenuBar::spacer();
		mosMenuBar::editListX('editExtra');
		mosMenuBar::spacer();
		mosMenuBar::deleteList('','removeExtra');
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.users.extra' );
		mosMenuBar::endTable();
	}

	//Draws the menu to edit an extra field
	static public function _EDITEXTRA() {
		global $id, $adminLanguage;

		mosMenuBar::startTable();
		mosMenuBar::save('saveExtra');
		mosMenuBar::spacer();
		mosMenuBar::apply('applyExtra');
		mosMenuBar::spacer();
		if ( $id ) {
			// for existing content items the button is renamed `close`
			mosMenuBar::cancel( 'cancelExtra', $adminLanguage->A_CLOSE );
		} else {
			mosMenuBar::cancel('cancelExtra');
		}
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.users.extra' );
		mosMenuBar::endTable();
	}

	static public function _DEFAULT() {
        global $adminLanguage;
		mosMenuBar::startTable();
//		mosMenuBar::addNewX();
		mosMenuBar::customX( 'new', 'add_user.png', 'add_user_f2.png', $adminLanguage->A_NEW, false );
		mosMenuBar::spacer();
		mosMenuBar::editListX();
		mosMenuBar::spacer();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
        mosMenuBar::custom( 'logout', 'cancel.png', 'cancel_f2.png', '&nbsp;'. $adminLanguage->A_CMP_USS_FLGOUT );
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.users.main' );
                mosMenuBar::spacer();
                mosMenuBar::wiki( 'User_Manager' );
		mosMenuBar::endTable();
	}
}
?>
