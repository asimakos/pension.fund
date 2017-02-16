<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component eBlog
* @author: Ioannis Sannos (Elxis Team)
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Component eBlog back-end
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );



class eblogtoolbar  {

	static public function _DEFAULT() {
		mosMenuBar::startTable();
		mosMenuBar::publish();
		mosMenuBar::spacer();
		mosMenuBar::unpublish();
		mosMenuBar::spacer();
		mosMenuBar::addNewX();
		mosMenuBar::spacer();
		mosMenuBar::editListX();
		mosMenuBar::spacer();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
		mosMenuBar::help('elxis.eblog');
		mosMenuBar::endTable();
	}

	static public function _NEW() {
		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::apply();
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.eblog.edit' );
		mosMenuBar::endTable();
	}

	static public function _EDIT() {
	  global $adminLanguage;

		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::apply();
		mosMenuBar::spacer();
		mosMenuBar::cancel( 'cancel', $adminLanguage->A_CLOSE );
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.eblog.edit' );
		mosMenuBar::endTable();
	}
}


switch ($task) {
	case 'new':
		eblogtoolbar::_NEW();
	break;
	case 'edit':
	case 'editA':
		eblogtoolbar::_EDIT();
	break;
	default:
		eblogtoolbar::_DEFAULT();
	break;
}

?>