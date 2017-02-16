<?php 
/**
* @version: $Id: toolbar.messages.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Messages
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_messages {
	static public function _VIEW() {
    global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::customX('reply', 'restore.png', 'restore_f2.png', $adminLanguage->A_CMP_MSS_REPLY, false );
		mosMenuBar::spacer();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::endTable();
	}

	static public function _EDIT() {
	  global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::save( 'save', $adminLanguage->A_CMP_MSS_SEND );
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.messages.new' );
		mosMenuBar::endTable();
	}

	static public function _CONFIG() {
		mosMenuBar::startTable();
		mosMenuBar::save( 'saveconfig' );
		mosMenuBar::spacer();
		mosMenuBar::cancel( 'cancelconfig' );
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.messages.conf' );
		mosMenuBar::endTable();
	}

	static public function _DEFAULT() {
		mosMenuBar::startTable();
		mosMenuBar::addNewX();
		mosMenuBar::spacer();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.messages.inbox' );
		mosMenuBar::endTable();
	}
}
?>
