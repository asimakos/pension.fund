<?php 
/**
* @version: $Id: toolbar.installer.html.php 60 2010-06-13 09:46:43Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

class TOOLBAR_installer
{
	static public function _DEFAULT()	{
		mosMenuBar::startTable();
		mosMenuBar::help( 'elxis.installer.lang' );
		mosMenuBar::endTable();
	}

	static public function _DEFAULT3()	{
		mosMenuBar::startTable();
		mosMenuBar::help( 'elxis.installer.bridge' );
		mosMenuBar::endTable();
	}

	static public function _DEFAULT2()	{
	  global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::deleteList( '', 'remove', $adminLanguage->A_CMP_INST_UNINSTALL );
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.installer.cmm' );
		mosMenuBar::endTable();
	}

	static public function _NEW()	{
		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::endTable();
	}

	static public function _UPDATES() {
		mosMenuBar::startTable();
		mosMenuBar::wiki('EDC_installer');
		mosMenuBar::endTable();
	}

}
?>
