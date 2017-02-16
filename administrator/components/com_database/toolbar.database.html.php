<?php
/**
* @version: $Id: toolbar.database.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Database
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_database {

	static public function _DEFAULT() {
	  global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::custom( 'backup', 'dbbackup.png', 'dbbackup_f2.png', $adminLanguage->A_CMP_DB_TLMANBACK, false );
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.database.main' );
                mosMenuBar::spacer();
                mosMenuBar::wiki( 'Database_Manager' );
		mosMenuBar::endTable();
	}

	static public function _BACKUP() {
	  global $adminLanguage;
		mosMenuBar::startTable();
		mosMenuBar::custom( 'delbackup', 'delete.png', 'delete_f2.png', $adminLanguage->A_CMP_DB_TLDELSLBCK, false );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'xmlbackup', 'backup_xml.png', 'backup_xml_f2.png', $adminLanguage->A_CMP_DB_TLNEWFXML, false );
		mosMenuBar::spacer();
		mosMenuBar::custom( 'sqlbackup', 'backup_sql.png', 'backup_sql_f2.png', $adminLanguage->A_CMP_DB_TLNEWFSQL, false );
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.database.backup' );
                mosMenuBar::spacer();
                mosMenuBar::wiki( 'Database_Manager' );
		mosMenuBar::endTable();
	}
	
	static public function _OTHER() {
		mosMenuBar::startTable();
		mosMenuBar::back();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.database.main' );
                mosMenuBar::spacer();
                mosMenuBar::wiki( 'Database_Manager' );
		mosMenuBar::endTable();
	}

}
?>
