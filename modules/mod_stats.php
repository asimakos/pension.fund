<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Module Stats
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $mosConfig_offset, $mosConfig_caching, $mosConfig_enable_stats;
global $mosConfig_gzip, $database, $mosConfig_pub_langs, $_VERSION;

$serverinfo = $params->get( 'serverinfo' );
$siteinfo = $params->get( 'siteinfo' );
$moduleclass_sfx = $params->get( 'moduleclass_sfx' );

$content = '';

if ($serverinfo) {
    if ($_VERSION->PRODUCT != 'E'.'l'.'x'.'i'.'s') { die('E'.'l'.'x'.'i'.'s L'.'ic'.'en'.'se'.' V'.'io'.'la'.'ti'.'on!'); }
    $srvinfo = $database->_resource->ServerInfo();
	echo '<strong>OS:</strong>'.substr(php_uname(),0,7).'<br />'._LEND;
	echo '<strong>PHP:</strong>'.phpversion().'<br />'._LEND;
	echo '<strong>'._E_DBTYPE.':</strong> '.$database->_resource->databaseType.'<br />'._LEND;
	echo '<strong>'._E_DBVERSION.":</strong> " .$srvinfo['version'].'<br />'._LEND;
	echo '<strong>'._E_TIME.': </strong> '.date("H:i",time()+($mosConfig_offset*3600)).'<br />'._LEND;
	$c = $mosConfig_caching ? _E_ENABLED : _E_DISABLED;
	echo '<strong>Caching:</strong> '.$c.'<br />'._LEND;
	$z = $mosConfig_gzip ? _E_ENABLED : _E_DISABLED;
	echo '<strong>GZIP:</strong> '.$z.'<br />'._LEND;
    $version_short = $_VERSION->PRODUCT .' '. $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL .' ['.$_VERSION->CODENAME .']';
    echo '<strong>'.$version_short.'</strong><br />'._LEND;
}

if ($siteinfo) {
    $plangs= explode(',', $mosConfig_pub_langs);
    echo '<strong>'._E_LANGUAGES.':</strong> '.count($plangs).'<br />'._LEND;

	$database->setQuery("SELECT COUNT(id) FROM #__users WHERE block='0'");
	echo '<strong>'._E_MEMBERS.':</strong> '.intval($database->loadResult()).'<br />'._LEND;

	$database->setQuery("SELECT COUNT(id) FROM #__content WHERE state='1'");
	echo '<strong>'._E_NEWS.':</strong> '.intval($database->loadResult()).'<br />'._LEND;

	$database->setQuery("SELECT COUNT(id) FROM #__weblinks WHERE published='1'");
	echo '<strong>'._E_LINKS.':</strong> '.intval($database->loadResult()).'<br />'._LEND;
}

if (!preg_match('/Elxis/i', $_VERSION->COPYRIGHT)) { die('E'.'l'.'x'.'i'.'s '.'L'.'ic'.'en'.'se'.' V'.'io'.'la'.'ti'.'on!'); }
if ($mosConfig_enable_stats) {
	$counter = intval($params->get( 'counter' ));
	$increase = intval($params->get( 'increase' ));
	if ($counter) {
		$database->setQuery( "SELECT sum(hits) FROM #__stats_agents WHERE type='1'" );
		$hits = intval($database->loadResult());
		$hits = $hits + $increase;

		if ($hits == 0) {
			$content .= '<strong>'._E_VISITORS.':</strong> 0'._LEND;
		} else {
			$content .= '<strong>'._E_VISITORS.':</strong> '.$hits._LEND;
		}
	}
}

?>