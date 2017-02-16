<?php 
/** 
* @version: $Id: translate.php 30 2010-06-05 16:58:46Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Bots/Content
* @author: Elxis Team (Ioannis Sannos)
* @email: info [AT] elxis [DOT] org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


$_MAMBOTS->registerFunction('onContentIcons', 'metafrasiBox');


/*****************/
/* TRANSLATE BOT */
/*****************/
function metafrasiBox($published, &$row, $params, $page=0) {
	global $database, $mainframe, $lang;

    if (!$published) { return ''; }
	if ($params->get('intro_only', 0) == 1) { return ''; }
	if ($params->get('popup', 0) == 1) { return ''; }
	if (isset($_SERVER['SCRIPT_NAME'])) {
		if (preg_match('/index2/i', $_SERVER['SCRIPT_NAME'])) { return ''; }
	} else if (isset($_SERVER['PHP_SELF'])) {
		if (preg_match('/index2/i', $_SERVER['PHP_SELF'])) { return ''; }
	}

    $ishow = intval($params->get('translate', 2));
	if ($ishow == 0) { return ''; }

    if (!defined('TRANSLATE_GSHOW')) {
		$query = "SELECT params FROM #__mambots WHERE element = 'translate' AND folder = 'content'";
		$database->setQuery($query, '#__', 1, 0);
		$mparams = $database->loadResult();
		if (!$mparams) { $mparams = ''; }

		$xparams = new mosParameters($mparams);
		define('TRANSLATE_GSHOW', intval($xparams->get('globalshow', 1)));
	}

	if (($ishow == 2) && (TRANSLATE_GSHOW == 0)) { return ''; }

	//detect article's language
	$blng = $mainframe->getCfg('lang');
	if (trim($row->language) == '') {
		$lng = $blng;
	} else if (preg_match('/\,/', $row->language)) {
		$parts = preg_split('/\,/', $row->language, -1, PREG_SPLIT_NO_EMPTY);
		if (in_array($blng, $parts)) {
			$lng = $blng;
		} else if (in_array($lang, $parts)) {
			$lng = $lang;
		} else {
			$lng = $parts[0];
		}
	} else {
		$lng = $row->language;
	}

	if (!defined('ELXISMTF_JS_LOADED')) {
		$dirurl = $mainframe->getCfg('ssl_live_site').'/mambots/content/translate/';
		$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.$dirurl.'metafrasi.js" charset="utf-8"></script>');
		$mainframe->addCustomHeadTag('<link href="'.$dirurl.'metafrasi.css" rel="stylesheet" type="text/css" media="all" />');
		define('ELXISMTF_JS_LOADED', 1);
	}

	$out = '<a href="javascript:void(null);" id="mtf'.$row->id.'" onmouseover="metafrasiPop('.$row->id.', \''.$lng.'\', \''.$lang.'\', \''.$mainframe->getCfg('ssl_live_site').'\');">';
	$out .= '<img src="'.$mainframe->getCfg('ssl_live_site').'/mambots/content/translate/translate.png" alt="translate" align="middle" style="border:0;" />'."\n";
	$out .= "</a> \n";

	return $out;
}

?>