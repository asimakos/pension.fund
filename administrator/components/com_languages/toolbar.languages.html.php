<?php
/**
* @version: $Id: toolbar.languages.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Languages
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_languages {
	static public function _DEFAULT() {
		mosMenuBar::startTable();
		mosMenuBar::publishList();
		mosMenuBar::spacer();
		mosMenuBar::unpublishList();
		mosMenuBar::spacer();
		mosMenuBar::makeDefault();
		mosMenuBar::spacer();
		mosMenuBar::addNew();
		mosMenuBar::spacer();
		mosMenuBar::editListX( 'edit_source' );
		mosMenuBar::spacer();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.languages.site' );
		mosMenuBar::endTable();
	}
	
	
	static public function _VIEWADMIN() {
		mosMenuBar::startTable();
		mosMenuBar::makeDefault('adefault');
		mosMenuBar::spacer();
		mosMenuBar::addNew('anew');
		mosMenuBar::spacer();
		mosMenuBar::deleteList('','aremove');
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.languages.admin' );
		mosMenuBar::endTable();
	}	

	
	static public function _NEW() {
		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::endTable();
	}

	static public function _EDIT_SOURCE(){
		mosMenuBar::startTable();
		mosMenuBar::save( 'save_source' );
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.languages.edit' );
		mosMenuBar::endTable();
	}

}
?>
