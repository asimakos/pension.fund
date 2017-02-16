<?php 
/**
* @version: $Id: toolbar.sections.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Sections
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_sections {

	/**
	* Draws the menu for Editing an existing category
	*/
	static public function _EDIT() {
		global $id, $adminLanguage;

		mosMenuBar::startTable();
		mosMenuBar::media_manager();
		mosMenuBar::spacer();
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
		mosMenuBar::help( 'elxis.sections.edit' );
		mosMenuBar::endTable();
	}

	/**
	* Draws the menu for Copying existing sections
	* @param int The published state (to display the inverse button)
	*/
	static public function _COPY() {
		mosMenuBar::startTable();
		mosMenuBar::save( 'copysave' );
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.sections.copy' );
		mosMenuBar::endTable();
	}

	/**
	* Draws the menu for Editing an existing category
	*/
	static public function _DEFAULT(){
    global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::publishList();
		mosMenuBar::spacer();
		mosMenuBar::unpublishList();
		mosMenuBar::spacer();
		mosMenuBar::addNewX();
		mosMenuBar::spacer();
		mosMenuBar::customX( 'copyselect', 'copy.png', 'copy_f2.png', $adminLanguage->A_COPY, true );
		mosMenuBar::spacer();
		mosMenuBar::editListX();
		mosMenuBar::spacer();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.sections' );
                mosMenuBar::spacer();
                mosMenuBar::wiki( 'Sections_Manager' );
		mosMenuBar::endTable();
	}
}
?>
