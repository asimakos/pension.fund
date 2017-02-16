<?php 
/**
* @version: $Id: toolbar.access.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Access
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_access {

	static public function _NEW() {
		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.access.edit' );
		mosMenuBar::endTable();
	}

	static public function _PERMS() {
		mosMenuBar::startTable();
		mosMenuBar::deleteList( '','removeperm' );
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.access.permissions' );
		mosMenuBar::endTable();
	}        


	static public function _DEFAULT() {
    global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::addNewX( 'new', $adminLanguage->A_NEW, 'add_group.png', 'add_group_f2.png' );
		mosMenuBar::spacer();
		mosMenuBar::editListX('edit', $adminLanguage->A_CMP_ACC_TEDITGR );
		mosMenuBar::spacer();
		mosMenuBar::deleteList( $adminLanguage->A_CMP_ACC_TGUPALD, 'remove', $adminLanguage->A_DELETE, 'delete_group.png', 'delete_group_f2.png' ); 
		mosMenuBar::spacer();
		mosMenuBar::editListX('editperms', $adminLanguage->A_CMP_ACC_TEDITPR );
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.access.main' );
                mosMenuBar::spacer();
                mosMenuBar::wiki( 'Access_Manager_(ACL)' );
		mosMenuBar::endTable();
	}
}
?>
