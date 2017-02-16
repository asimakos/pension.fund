<?php 
/**
* @version: $Id: toolbar.trash.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Trash
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_Trash {
	static public function _DEFAULT() {
    global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::custom('restoreconfirm','restore.png','restore_f2.png',$adminLanguage->A_CMP_TRSH_REST, true);
		mosMenuBar::spacer();
		mosMenuBar::custom('deleteconfirm','delete.png','delete_f2.png',$adminLanguage->A_DELETE, true);
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.trashmanager' );
                mosMenuBar::spacer();
                mosMenuBar::wiki( 'Trash_Manager' );
		mosMenuBar::endTable();
	}

	static public function _DELETE() {
		mosMenuBar::startTable();
		mosMenuBar::cancel();
		mosMenuBar::endTable();
	}

	static public function _SETTINGS() {
		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::back();
		mosMenuBar::endTable();
	}
}
?>
