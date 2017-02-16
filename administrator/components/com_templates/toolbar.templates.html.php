<?php 
/**
* @version: $Id: toolbar.templates.html.php 2596 2010-03-24 20:19:28Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Templates
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_templates {
	static public function _DEFAULT($client) {
    global $adminLanguage;
		mosMenuBar::startTable();
		if (($client=="admin") || ( $client=="login")) {
			mosMenuBar::custom('publish', 'publish.png', 'publish_f2.png', $adminLanguage->A_DEFAULT, true);
			mosMenuBar::spacer();
		} else {
			mosMenuBar::makeDefault();
			mosMenuBar::spacer();
			mosMenuBar::assign();
			mosMenuBar::spacer();
		}
		mosMenuBar::addNew();
		mosMenuBar::spacer();
		mosMenuBar::editHtml('edit_source');
		mosMenuBar::spacer();
		mosMenuBar::editCssX('edit_css');
		mosMenuBar::spacer();
		mosMenuBar::customX('edit_params', 'edit.png', 'edit_f2.png', $adminLanguage->A_EDIT, true);
		mosMenuBar::spacer();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
		mosMenuBar::help('elxis.templates.main');
        mosMenuBar::spacer();
        mosMenuBar::wiki('Templates_Manager');
		mosMenuBar::endTable();
	}
 	static public function _VIEW() {
		mosMenuBar::startTable();
		mosMenuBar::back();
		mosMenuBar::endTable();
	}

	static public function _EDIT_SOURCE() {
		mosMenuBar::startTable();
		mosMenuBar::save('save_source');
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help('elxis.templates.edithtml');
		mosMenuBar::endTable();
	}

	static public function _EDIT_PARAMS() {
		mosMenuBar::startTable();
		mosMenuBar::save('save_params');
		mosMenuBar::spacer();
		mosMenuBar::apply('apply_params');
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::wiki('Template_parameters');
		mosMenuBar::endTable();
	}

	static public function _EDIT_CSS(){
		mosMenuBar::startTable();
		mosMenuBar::save('save_css');
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help('elxis.templates.editcss');
		mosMenuBar::endTable();
	}

	static public function _ASSIGN(){
	  global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::save( 'save_assign', $adminLanguage->A_SAVE );
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.templates.assign' );
		mosMenuBar::endTable();
	}

	static public function _POSITIONS(){
		mosMenuBar::startTable();
		mosMenuBar::save('save_positions');
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help('elxis.templates.modules');
		mosMenuBar::endTable();
	}
}
?>
