<?php
/**
* @version: 1.0
* @package: Component AkForms
* @author: Andrew Campball
* @email: ACampball@yandex.ru
* @link:
* @license: GNU/GPL
* @copyright: (C) 2009 Andrew Campball. All rights reserved.
* @description: AkForms component for Elxis CMS.
*****************************************************************************/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


function com_uninstall() {
	global $database, $mainframe, $fmanager;

	$dbtables = array('akforms', 'akform_items', 'akform_values', 'akforms_groups', 'akforms_langs');
	$oradrivers = array('oci8', 'oci805', 'oci8po', 'oracle');
	$isoracle = (in_array($database->_resource->databaseType, $oradrivers)) ? 1 : 0;

	$dict = NewDataDictionary($database->_resource);

	foreach ($dbtables as $dbtable) {
		$tbl = $database->_table_prefix.$dbtable;
		if ($isoracle) { $tbl = strtoupper($tbl); }
		$sql = $dict->DropTableSQL($tbl);
		$database->_resource->Execute($sql[0]);
		unset($sql, $tbl);
	}

	$dir = $mainframe->getCfg('absolute_path').'/components/com_akforms';

	$fmanager->deleteFolder($dir.'/files/');

	$seoext = $mainframe->getCfg('absolute_path').'/includes/seopro/com_akforms.php';
	if (file_exists($seoext)) { $fmanager->deleteFile($seoext); }
}

?>