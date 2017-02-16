<?php
/**
* @version: $Id$
* @package: Component AkForms
* @author: Andrew Campball
* @email: ACampball@yandex.ru
* @link:
* @license:
* @copyright: (C) 2009 Andrew Campball. All rights reserved.
* @description: AkForms component for Elxis CMS.
*****************************************************************************/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


class akformstoolbar  {

	static public function cpanel() {
		mosMenuBar::startTable();
		mosMenuBar::endTable();
	}

	static public function config() {
		mosMenuBar::startTable();
		mosMenuBar::save('saveconfig');
		mosMenuBar::spacer();
		mosMenuBar::cancel('cancelconfig');
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	static public function forms() {
		global $adminLanguage;

		mosMenuBar::startTable();
		mosMenuBar::custom( 'copyform', 'copy.png', 'copy_f2.png', $adminLanguage->A_COPY );
		mosMenuBar::spacer();
		mosMenuBar::addNewX('newform');
		mosMenuBar::spacer();
		mosMenuBar::deleteList('', 'removeform');
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	static public function editform() {
    	mosMenuBar::startTable();
    	mosMenuBar::save('saveform');
        mosMenuBar::spacer();
    	mosMenuBar::apply('applform');
        mosMenuBar::spacer();
    	mosMenuBar::cancel('cancelform');
		mosMenuBar::spacer();
    	mosMenuBar::endTable();
	}

	static public function fields() {
		global $database, $adminLanguage;

		$database->setQuery('SELECT COUNT(*) FROM #__akforms');
		$cnt = $database->loadResult();

		if ($cnt > 0) {
			mosMenuBar::startTable();
			mosMenuBar::custom( 'forms', 'back.png', 'back_f2.png', 'Forms', false );
			mosMenuBar::spacer();
			mosMenuBar::custom( 'copyfield', 'copy.png', 'copy_f2.png', $adminLanguage->A_COPY );
			mosMenuBar::spacer();
			mosMenuBar::addNewX('newfield');
			mosMenuBar::spacer();
			mosMenuBar::deleteList('', 'removefield');
			mosMenuBar::spacer();
			mosMenuBar::endTable();
		}
	}

	static public function editfield() {
    	mosMenuBar::startTable();
    	mosMenuBar::save('savefield');
        mosMenuBar::spacer();
    	mosMenuBar::apply('applfield');
        mosMenuBar::spacer();
    	mosMenuBar::cancel('cancelfield');
		mosMenuBar::spacer();
    	mosMenuBar::endTable();
	}

	static public function values() {
		global $adminLanguage;

		mosMenuBar::startTable();
		mosMenuBar::custom( 'forms', 'back.png', 'back_f2.png', 'Forms', false );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'unread', 'restore.png', 'restore_f2.png', 'Mark Unread' );
		mosMenuBar::spacer();
		mosMenuBar::deleteList('', 'removedata');
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	static public function viewvalue() {
    	mosMenuBar::startTable();
    	mosMenuBar::back();
		mosMenuBar::spacer();
    	mosMenuBar::endTable();
	}

}

switch ($task) {
	case 'config':
		akformstoolbar::config();
	break;

	/* Формы */
	case 'forms':
		akformstoolbar::forms();
	break;
	case 'newform':
	case 'editform':
		akformstoolbar::editform();
	break;

	/* Поля */
	case 'fields':
		akformstoolbar::fields();
	break;
	case 'newfield':
	case 'editfield':
		akformstoolbar::editfield();
	break;

	/* Данные */
	case 'data':
		akformstoolbar::values();
	break;
	case 'viewdata':
		akformstoolbar::viewvalue();
	break;

	default:
		akformstoolbar::cpanel();
	break;
}

?>