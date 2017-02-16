<?php 
/**
* @version: $Id: toolbar.statistics.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Statistics
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_statistics {
	static public function _SEARCHES() {
		mosMenuBar::startTable();
		mosMenuBar::help( 'elxis.stats.searches' );
		mosMenuBar::endTable();
	}
}
?>
