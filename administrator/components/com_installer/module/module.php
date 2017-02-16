<?php 
/**
* @version: $Id: module.php 2607 2010-03-28 10:54:06Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Modules Installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


// ensure user has access to this function
if (!$acl->acl_check( 'administration', 'install', 'users', $my->usertype, $element.'s', 'all')) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once($mainframe->getPath('installer_html', 'module'));

HTML_installer::showInstallForm($adminLanguage->A_CMP_INST_NWMDL, $option, 'module', '', dirname(__FILE__));
?>
<table class="content">
<?php
writableCell('tmpr');
writableCell('administrator/modules');
writableCell('modules');
?>
</table>

<?php 

$edcbrowser = new edcbrowser('module');
$edcbrowser->run();

showInstalledModules($option);

/*************************************/
/* PREPARE TO SHOW INSTALLED MODULES */
/*************************************/
function showInstalledModules( $_option ) {
	global $database, $mainframe, $adminLanguage, $fmanager;

	$filter = mosGetParam( $_POST, 'filter', '' );
	$select[] = mosHTML::makeOption('', $adminLanguage->A_CMP_INST_ALLC);
	$select[] = mosHTML::makeOption('0', $adminLanguage->A_CMP_INST_STMDL);
	$select[] = mosHTML::makeOption('1', $adminLanguage->A_CMP_INST_ADMDL);
	$lists['filter'] = mosHTML::selectList( $select, 'filter', 'class="selectbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $filter );
	if ($filter == NULL) {
		$and = '';
	} else if (!$filter) {
		$and = "\n AND client_id = '0'";
	} else if ($filter) {
		$and = "\n AND client_id = '1'";
	}

	$database->setQuery( "SELECT id, module, client_id FROM #__modules"
		. "\n WHERE module LIKE 'mod_%' AND iscore='0'"
		. $and
		. "\n GROUP BY id, module, client_id"
		. "\n ORDER BY client_id, module"
	);
	$rows = $database->loadObjectList();

	$n = count( $rows );
	if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
	for ($i = 0; $i < $n; $i++) {
	    $row =& $rows[$i];

		// path to module directory
		if ($row->client_id == "1"){
			$moduleBaseDir	= $fmanager->PathName( $fmanager->PathName($mainframe->getCfg('absolute_path')).'administrator'.SEP.'modules' );
		} else {
			$moduleBaseDir	= $fmanager->PathName( $fmanager->PathName($mainframe->getCfg('absolute_path')).'modules' );
		}

		// xml file for module
		$xmlfile = $moduleBaseDir . $row->module .".xml";

		if (file_exists($xmlfile)) {
			$xmlDoc = simplexml_load_file($xmlfile, 'SimpleXMLElement');
			if (!$xmlDoc) { continue; }
			if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
				if ($xmlDoc->getName() != 'mosinstall') { continue; }
			}
			$attrs =  $xmlDoc->attributes();
			if (!$attrs) { continue; }
			if (!isset($attrs['type']) || ($attrs['type'] != 'module')) { continue; }
			if (isset($attrs['version'])) {
				$row->elxisversion = intval(substr($attrs['version'], 0, strlen($attrs['version'])-strlen(strstr($attrs['version'], '.'))));
			} else {
				$row->elxisversion = 0;
			}

			$row->creationdate = isset($xmlDoc->creationDate) ? (string)$xmlDoc->creationDate : '';
			$row->author = isset($xmlDoc->author) ? (string)$xmlDoc->author : $adminLanguage->A_UNKNOWN;
			$row->copyright = isset($xmlDoc->copyright) ? (string)$xmlDoc->copyright : '';
			$row->authorEmail = isset($xmlDoc->authorEmail) ? (string)$xmlDoc->authorEmail : '';
			$row->authorUrl = isset($xmlDoc->authorUrl) ? (string)$xmlDoc->authorUrl : '';
			$row->version = isset($xmlDoc->version) ? (string)$xmlDoc->version : '';
			unset($xmlDoc);
    	}
	}

	HTML_module::showInstalledModules($rows, $_option, $xmlfile, $lists);
}

?>