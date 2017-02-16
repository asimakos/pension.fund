<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Components Installer
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//ensure user has access to this function
if ( !$acl->acl_check( 'administration', 'install', 'users', $my->usertype, $element . 's', 'all' ) ) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once( $mainframe->getPath('installer_html', 'component'));

HTML_installer::showInstallForm( $adminLanguage->A_CMP_INST_INSCO, $option, 'component', '', dirname(__FILE__) );
?>
<table class="content">
<?php
writableCell('tmpr');
writableCell('administrator/components');
writableCell('components');
?>
</table>
<?php 

$edcbrowser = new edcbrowser('component');
$edcbrowser->run();

showInstalledComponents($option);


/****************************************/
/* PREPARE TO SHOW INSTALLED COMPONENTS */
/****************************************/
function showInstalledComponents( $option ) {
	global $database, $mainframe, $adminLanguage, $fmanager;

	$database->setQuery("SELECT * FROM #__components WHERE parent = '0' AND iscore = '0' ORDER BY name");
	$rows = $database->loadObjectList();

	//Read the component dir to find components
	$componentBaseDir = $fmanager->PathName($mainframe->getCfg('absolute_path'). SEP. 'administrator' . SEP . 'components' );
	$componentDirs = $fmanager->listFolders($componentBaseDir);

	$n = count($rows);
	if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
	for ($i = 0; $i < $n; $i++) {
	    $row =& $rows[$i];

		$dirName = $componentBaseDir . $row->option;
		$xmlFilesInDir = $fmanager->listFiles($dirName, '.xml$');
		if (!$xmlFilesInDir) { continue; }

		foreach ($xmlFilesInDir as $xmlfile) {
			$xmlDoc = simplexml_load_file($dirName.SEP.$xmlfile, 'SimpleXMLElement');
			if (!$xmlDoc) { continue; }
			if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
				if ($xmlDoc->getName() != 'mosinstall') { continue; }
			}
			$attrs =  $xmlDoc->attributes();
			if (!$attrs) { continue; }
			if (!isset($attrs['type']) || ($attrs['type'] != 'component')) { continue; }
			if (isset($attrs['version'])) {
				$row->elxisversion = intval(substr($attrs['version'], 0, strlen($attrs['version'])-strlen(strstr($attrs['version'], '.'))));
			} else {
				$row->elxisversion = 0;
			}

			$row->creationdate = isset($xmlDoc->creationDate) ? (string)$xmlDoc->creationDate : $adminLanguage->A_UNKNOWN;
			$row->author = isset($xmlDoc->author) ? (string)$xmlDoc->author : $adminLanguage->A_UNKNOWN;
			$row->copyright = isset($xmlDoc->copyright) ? (string)$xmlDoc->copyright : '';
			$row->authorEmail = isset($xmlDoc->authorEmail) ? (string)$xmlDoc->authorEmail : '';
			$row->authorUrl = isset($xmlDoc->authorUrl) ? (string)$xmlDoc->authorUrl : '';
			$row->version = isset($xmlDoc->version) ? (string)$xmlDoc->version : '';
			$row->mosname = eUTF::utf8_strtolower( eUTF::utf8_str_replace( " ", "_", $row->name ) );
			unset($xmlDoc);
		}
	}

	HTML_component::showInstalledComponents($rows, $option);
}

?>