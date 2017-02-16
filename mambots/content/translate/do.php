<?php 
/** 
* @version: $Id: do.php 64 2010-06-15 16:19:45Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Bots/Content
* @author: Elxis Team (Ioannis Sannos)
* @email: info [AT] elxis [DOT] org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/


define('_VALID_MOS', 1);
session_start();

$elxis_root = str_replace( '/mambots/content/translate', '', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));
require_once($elxis_root.'/includes/Core/security.php');
require_once ($elxis_root.'/configuration.php');
unset($elxis_root);

if ($mosConfig_offline > 0) { die(); }

require_once($mosConfig_absolute_path.'/includes/Core/loader.php');

$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix, $mosConfig_dbtype );
$database->debug(0);
$acl = new gacl_api();

require_once($mosConfig_absolute_path.'/includes/sef.php');
require_once($mosConfig_absolute_path.'/includes/frontend.php');

$option = strtolower(strval(mosGetParam($_REQUEST, 'option', 'com_content')));
$Itemid = intval(trim(mosGetParam($_REQUEST, 'Itemid', 0)));

$mainframe = new mosMainFrame($database, $option, $mosConfig_absolute_path);
$mainframe->initSession();
$my = $mainframe->getUser();

require_once($mosConfig_absolute_path.'/includes/Core/access.control.php');

/******************************************************/

$pat = "#([\']|[\!]|[\(]|[\)]|[\;]|[\"]|[\$]|[\#]|[\<]|[\>]|[\*]|[\%]|[\~]|[\`]|[\^]|[\|]|[\{]|[\}]|[\\\])#u";
$artid = (int)mosGetParam($_GET, 'artid', 0);
$fromlang = mosGetParam($_GET, 'fromlang', '');
$fromlang = trim(preg_replace($pat, '', $fromlang));
$tolang = mosGetParam($_GET, 'tolang', '');
$tolang = trim(preg_replace($pat, '', $tolang));

if ($fromlang == '') { die('ERROR::Invalid source language'); }
if ($tolang == '') { die('ERROR:Invalid translation language'); }

$pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;
$ora = (in_array($database->_resource->databaseType, array ('oci8', 'oci805', 'oci8po', 'oracle'))) ? 1 : 0;
$now = date('Y-m-d H:i:s', time() + $mainframe->getCfg('offset') * 3600);

$query = "SELECT * FROM #__content WHERE id='".$artid."'"
."\n AND (state = '1' OR state = '-1')"
."\n AND (publish_up = '1979-12-19 00:00:00' OR publish_up <= '".$now."')"
."\n AND (publish_down = '2060-01-01 00:00:00' OR publish_down >= '".$now."')"
."\n AND access IN (".$my->allowed.")";
$database->setQuery($query, '#__', 1, 0);
$database->loadObject($row);
if (!$row) { die('ERROR:Requested article not found'); }

$row->text = $row->introtext.$row->maintext;

//process the bots
//process the bots
$params = new mosParameters($row->attribs);
$params->set('intro_only', 0);
$params->def('back_button', $mainframe->getCfg('back_button'));
if ($row->sectionid == 0) {
	$params->set('item_navigation', 0);
} else {
	$params->set('item_navigation', $mainframe->getCfg('item_navigation'));
}
$params->def('post_comments', 0);
$params->def('link_titles', $mainframe->getCfg('link_titles'));
$params->def('author', !$mainframe->getCfg('hideAuthor'));
$params->def('createdate', !$mainframe->getCfg('hideCreateDate'));
$params->def('modifydate', !$mainframe->getCfg('hideModifyDate'));
$params->def('print', !$mainframe->getCfg('hidePrint'));
$params->def('rtf', !$mainframe->getCfg('hideRtf'));
$params->def('pdf', !$mainframe->getCfg('hidePdf'));
$params->def('email', !$mainframe->getCfg('hideEmail'));
$params->def('rating', $mainframe->getCfg('vote'));
$params->def('icons', $mainframe->getCfg('icons'));
$params->def('readmore', $mainframe->getCfg('readmore'));
$params->def('comments', 0);
$params->def('image', 1);
$params->def('section', 0);
$params->def('section_link', 0);
$params->def('category', 0);
$params->def('category_link', 0);
$params->def('introtext', 1);
$params->def('pageclass_sfx', '');
$params->def('textclass_sfx', '');
$params->def('item_title', 1);
$params->def('url', 1);

$_MAMBOTS->loadBotGroup('content');
$_MAMBOTS->trigger('onPrepareContent', array(&$row, $params, 0), true);
		
require_once($mainframe->getCfg('absolute_path').'/administrator/includes/translator.class.php');
$metafrasi = new translator();

$lang1 = $metafrasi->elxisToGoogle($fromlang);
$lang2 = $metafrasi->elxisToGoogle($tolang);
if ($lang1 === false) { die('ERROR:Invalid source language'); }
if ($lang2 === false) { die('ERROR:Invalid translation language'); }

$translation = $metafrasi->translate($row->text, $lang1, $lang2);

if ($translation === false) {
	echo 'ERROR:'.$metafrasi->geterror();
} else {
	echo $translation;
}

?>