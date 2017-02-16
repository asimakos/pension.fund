<?php 
/**
* @version: $Id: mambot.php 2607 2010-03-28 10:54:06Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Bots Installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if ( !$acl->acl_check( 'administration', 'install', 'users', $my->usertype, $element . 's', 'all' ) ) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once( $mainframe->getPath( 'installer_html', 'mambot' ) );

HTML_installer::showInstallForm( $adminLanguage->A_CMP_INST_INMT, $option, 'mambot', '', dirname(__FILE__) );
?>
<table class="content">
<?php
writableCell('tmpr');
writableCell('mambots');
writableCell('mambots/content');
writableCell('mambots/search');
?>
</table>
<?php 

$edcbrowser = new edcbrowser('mambot');
$edcbrowser->run();

showInstalledMambots( $option );

/**********************************/
/* PREPARE TO SHOW INSTALLED BOTS */
/**********************************/
function showInstalledMambots($_option) {
	global $database, $mainframe, $fmanager, $adminLanguage;

	$database->setQuery( "SELECT id, name, folder, element, client_id FROM #__mambots"
	."\n WHERE iscore='0' ORDER BY folder, name");
	$rows = $database->loadObjectList();

	$botBaseDir	= $fmanager->PathName( $fmanager->PathName($mainframe->getCfg('absolute_path')).'mambots');

	$id = 0;
	$n = count($rows);
	if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
	for ($i = 0; $i < $n; $i++) {
	    $row =& $rows[$i];
		//xml file for bot
		$xmlfile = $botBaseDir.$row->folder.SEP.$row->element.'.xml';

		if (file_exists($xmlfile)) {
			$xmlDoc = simplexml_load_file($xmlfile, 'SimpleXMLElement');
			if (!$xmlDoc) { continue; }
			if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
				if ($xmlDoc->getName() != 'mosinstall') { continue; }
			}
			$attrs =  $xmlDoc->attributes();
			if (!$attrs) { continue; }

			if (!isset($attrs['type']) || ($attrs['type'] != 'mambot')) { continue; }
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
		}
	}

	HTML_mambot::showInstalledMambots($rows, $_option, $id, $xmlfile );
}

?>