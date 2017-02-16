<?php 
/**
* @version: $Id: toolbar.frontpage.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Frontpage
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_FrontPage {
	static public function _DEFAULT() {
	  global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::publishList();
		mosMenuBar::spacer();
		mosMenuBar::unpublishList();
		mosMenuBar::spacer();
		mosMenuBar::archiveList();
		mosMenuBar::spacer();
		mosMenuBar::custom('remove','delete.png','delete_f2.png',$adminLanguage->A_REMOVE, true);
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.frontpage' );
		mosMenuBar::endTable();
	}
}
?>
