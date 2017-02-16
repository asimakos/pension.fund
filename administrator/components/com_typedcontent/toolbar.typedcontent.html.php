<?php 
/**
* @version: $Id: toolbar.typedcontent.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Typed Content
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

class TOOLBAR_typedcontent {
	static public function _EDIT( ) {
		mosMenuBar::startTable();
		mosMenuBar::preview( 'contentwindow', true );
		mosMenuBar::spacer();
		mosMenuBar::media_manager();
		mosMenuBar::spacer();
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::apply();
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.staticcontent.edit' );
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
		mosMenuBar::startTable();
		mosMenuBar::addNewX();
		mosMenuBar::spacer();
		mosMenuBar::editListX( 'editA' );
		mosMenuBar::spacer();
		mosMenuBar::publishList();
		mosMenuBar::spacer();
		mosMenuBar::unpublishList();
		mosMenuBar::spacer();
		mosMenuBar::translate();
		mosMenuBar::spacer();
		mosMenuBar::trash();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.staticcontent' );
                mosMenuBar::spacer();
                mosMenuBar::wiki( 'Autonomous_Pages_Manager' );
		mosMenuBar::endTable();
	}
}
?>
