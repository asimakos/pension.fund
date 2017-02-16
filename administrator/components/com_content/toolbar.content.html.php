<?php 
/**
* @version: $Id: toolbar.content.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Content
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_content {
	static public function _EDIT($sub=0) {
		global $id, $adminLanguage;

		mosMenuBar::startTable();
		mosMenuBar::preview( 'contentwindow', true );
		mosMenuBar::spacer();
		mosMenuBar::media_manager();
		mosMenuBar::spacer();
		
		if (!$sub) {
            mosMenuBar::save();
            mosMenuBar::spacer();
            mosMenuBar::apply();
            mosMenuBar::spacer();
            if ( $id ) {
                //for existing content items the button is renamed `close`
                mosMenuBar::cancel( 'cancel', $adminLanguage->A_CLOSE );
            } else {
                mosMenuBar::cancel();
            }
		} else {
            mosMenuBar::save('savesub');
            mosMenuBar::spacer();
            mosMenuBar::apply('applysub');
            mosMenuBar::spacer();
            mosMenuBar::cancel('cancelsub');
		}
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.content.edit' );
		mosMenuBar::endTable();
	}

	static public function _ARCHIVE() {
       global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::unarchiveList();
		mosMenuBar::spacer();
		mosMenuBar::custom( 'remove', 'delete.png', 'delete_f2.png', $adminLanguage->A_TRASH, false );
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.content.archive' );
		mosMenuBar::endTable();
	}

	static public function _MOVE() {
       global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::custom( 'movesectsave', 'save.png', 'save_f2.png', $adminLanguage->A_SAVE, false );
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.content.copymove' );
		mosMenuBar::endTable();
	}

	static public function _COPY() {
       global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::custom( 'copysave', 'save.png', 'save_f2.png', $adminLanguage->A_SAVE, false );
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.content.copymove' );
		mosMenuBar::endTable();
	}


	static public function _TRANSLATE() {
	    global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::custom('dotranslate', 'translate.png', 'translate_f2.png', $adminLanguage->A_TRANSLATE, false );
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.content.translate' );
		mosMenuBar::endTable();
    }

	static public function _DEFAULT() {
       global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::addNewX();
		mosMenuBar::spacer();
		mosMenuBar::editListX( 'editA' );
		mosMenuBar::spacer();
		mosMenuBar::publishList();
		mosMenuBar::spacer();
		mosMenuBar::unpublishList();
		mosMenuBar::spacer();
		mosMenuBar::customX( 'movesect', 'move.png', 'move_f2.png', $adminLanguage->A_MOVE );
		mosMenuBar::spacer();
		mosMenuBar::customX( 'copy', 'copy.png', 'copy_f2.png', $adminLanguage->A_COPY );
		mosMenuBar::spacer();
		mosMenuBar::translate();
		mosMenuBar::spacer();
		mosMenuBar::archiveList();
		mosMenuBar::spacer();
		mosMenuBar::trash();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.content' );
		mosMenuBar::endTable();
	}
	
	static public function _TREE() {
		mosMenuBar::startTable();
		mosMenuBar::help( 'elxis.content.tree' );
		mosMenuBar::endTable();
	}


	static public function _SUBMITTED() {
        global $adminLanguage;

		mosMenuBar::startTable();
		mosMenuBar::editList( 'editsub' );
		mosMenuBar::spacer();
		mosMenuBar::deleteListX( '', 'removesub');
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.content.submitted' );
		mosMenuBar::endTable();
	}

}
?>
