<?php 
/**
* @version: 1.1
* @copyright: Copyright (C) 2008-2009 Is Open Source. All rights reserved.
* @package: Elxis
* @subpackage: Component NewsLetter
* @author: Ioannis Sannos (Is Open Source)
* @link: http://www.isopensource.com
* @email: info@isopensource.com
* @license: http://creativecommons.org/licenses/by-sa/3.0/ Creative Commons Attribution-Share Alike 3.0
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


function com_uninstall() {
	global $database, $mainframe, $fmanager;

	$oradrivers = array('oci8', 'oci805', 'oci8po', 'oracle');
	if (in_array($database->_resource->databaseType, $oradrivers)) {
		$tbl1 = strtoupper($database->_table_prefix.'iosnl_subscribers');
		$tbl2 = strtoupper($database->_table_prefix.'iosnl_messages');
	} else {
		$tbl1 = $database->_table_prefix.'iosnl_subscribers';
		$tbl2 = $database->_table_prefix.'iosnl_messages';
	}

	$dict = NewDataDictionary($database->_resource);
	$sql = $dict->DropTableSQL($tbl1);
	$database->_resource->Execute($sql[0]);

	$sql2 = $dict->DropTableSQL($tbl2);
	$database->_resource->Execute($sql2[0]);

	$adir = $mainframe->getCfg('absolute_path').'/administrator/components/com_newsletter';

	$hfiles = $fmanager->listFiles($adir.'/htmlfiles/', 'html');
	if ($hfiles && (count($hfiles) > 0)) {
		foreach ($hfiles as $hfile) {
			if (($hfile != 'index.html') && ($hfile != 'elxis-news.html') && ($hfile != 'elxis-news2.html')) {
				$fmanager->deleteFile($adir.'/htmlfiles/'.$hfile);
			}
		}
	}
	
	$seoext = $mainframe->getCfg('absolute_path').'/includes/seopro/com_newsletter.php';
	if (file_exists($seoext)) { $fmanager->deleteFile($seoext); }
		
}

?>