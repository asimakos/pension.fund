<?php 
/**
* @version: $Id: toolbar.menumanager.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Menu Manager
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_menumanager {
	/**
	* Draws the menu for the Menu Manager
	*/
	static public function _DEFAULT() {
        global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::addNewX();
		mosMenuBar::spacer();
		mosMenuBar::editListX();
		mosMenuBar::spacer();
        mosMenuBar::customX( 'copyconfirm', 'copy.png', 'copy_f2.png', $adminLanguage->A_COPY, true );
		mosMenuBar::spacer();
        mosMenuBar::customX( 'deleteconfirm', 'delete.png', 'delete_f2.png', $adminLanguage->A_DELETE, true );
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.menumanager' );
		mosMenuBar::endTable();
	}

	/**
	* Draws the menu to delete a menu
	*/
	static public function _DELETE() {
		mosMenuBar::startTable();
		mosMenuBar::cancel( );
		mosMenuBar::endTable();
	}

	/**
	* Draws the menu to create a New menu
	*/
	static public function _NEWMENU()	{
        global $adminLanguage;
		mosMenuBar::startTable();
        mosMenuBar::custom( 'savemenu', 'save.png', 'save_f2.png', $adminLanguage->A_SAVE, false );
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.menumanager.new' );
		mosMenuBar::endTable();
	}

	/**
	* Draws the menu to create a New menu
	*/
	static public function _COPYMENU()	{
    	global $adminLanguage;
		mosMenuBar::startTable();
        mosMenuBar::custom( 'copymenu', 'copy.png', 'copy_f2.png', $adminLanguage->A_COPY, false );
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.menumanager.copy' );
		mosMenuBar::endTable();
	}

}
?>
