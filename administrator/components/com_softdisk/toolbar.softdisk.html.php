<?php 
/**
* @version: $Id: toolbar.softdisk.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component SoftDisk
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_SOFTDISK {

	static public function _DEFAULT() {
	    global $mosConfig_live_site, $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::addNewX();
		mosMenuBar::spacer();
		mosMenuBar::editListX();
		mosMenuBar::spacer();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
		//mosMenuBar::onclick('expandingWindow(\''.$mosConfig_live_site.'/administrator/index3.php?option=com_softdisk&task=help\');return false', 'help.png', 'help_f2.png', $adminLanguage->A_HELP);
		mosMenuBar::help( 'elxis.softdisk' );
		mosMenuBar::spacer();
        mosMenuBar::custom('updatesystem', 'apply.png', 'apply_f2.png', $adminLanguage->UPSYSTEM, false);
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	static public function _EDIT() {
	    mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::cancel();
        mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.softdisk.edit' );
		mosMenuBar::endTable();
	}

}

?>
