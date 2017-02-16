<?php
/**
* @version: $Id: toolbar.massmail.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component MassMail
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_massmail {
	/**
	* Draws the menu for a New Contact
	*/
	static public function _DEFAULT() {
    global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::custom('send', 'publish.png', 'publish_f2.png', $adminLanguage->A_CMP_MM_SEND, false);
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.users.massmail' );
		mosMenuBar::endTable();
	}
}
?>
