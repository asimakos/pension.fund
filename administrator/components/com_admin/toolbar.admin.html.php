<?php 
/**
* @version: $Id: toolbar.admin.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Admin
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

class TOOLBAR_admin {
	static public function _SYSINFO() {
		mosMenuBar::startTable();
		mosMenuBar::help('elxis.system.info');
		mosMenuBar::endTable();
	}
	/**
	* Draws the menu for a New category
	*/
	static public function _CPANEL() {
		mosMenuBar::startTable();
		mosMenuBar::help('elxis.cpanel');
		mosMenuBar::spacer();
		mosMenuBar::wiki();
		mosMenuBar::endTable();
	}
	/**
	* Draws the menu for a New category
	*/
	static public function _DEFAULT() {
		mosMenuBar::startTable();
		//mosMenuBar::help( 'elxis.system.info' );
		mosMenuBar::endTable();
	}
}

?>