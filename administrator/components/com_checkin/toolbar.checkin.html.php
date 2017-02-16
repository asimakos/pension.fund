<?php
/**
* @version: $Id: toolbar.checkin.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Checkin
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

class TOOLBAR_checkin {

	static public function _DEFAULT() {
		mosMenuBar::startTable();
		mosMenuBar::help( 'elxis.checkin' );
		mosMenuBar::endTable();
	}
}
?>
