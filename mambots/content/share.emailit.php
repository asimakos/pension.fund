<?php 
/** 
* @version: $Id: share.emailit.php 30 2010-06-05 16:58:46Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Bots/Content
* @author: Elxis Team
* @email: info [AT] elxis [DOT] org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


$_MAMBOTS->registerFunction('onContentIcons', 'shareEmailit');

/**********************/
/* E-MAILIT SHARE BOT */
/**********************/
function shareEmailit($published, &$row, $params, $page=0) {
	global $database, $mainframe;

    if (!$published) { return ''; }
	if ($params->get('popup', 0) == 1) { return ''; }
	if (isset($_SERVER['SCRIPT_NAME'])) {
		if (preg_match('/index2/i', $_SERVER['SCRIPT_NAME'])) { return ''; }
	} else if (isset($_SERVER['PHP_SELF'])) {
		if (preg_match('/index2/i', $_SERVER['PHP_SELF'])) { return ''; }
	}
    $ishow = intval($params->get('emailit', 2));
	if ($ishow == 0) { return ''; }
	$id = $row->id;

    if (!defined('SHARE_EMAILIT_GSHOW')) {
		$query = "SELECT params FROM #__mambots WHERE element = 'share.emailit' AND folder = 'content'";
		$database->setQuery($query, '#__', 1, 0);
		$mparams = $database->loadResult();
		if (!$mparams) { $mparams = ''; }

		$xparams = new mosParameters($mparams);
		define('SHARE_EMAILIT_GSHOW', intval($xparams->get('globalshow', 1)));
	}

	if (($ishow == 2) && (SHARE_EMAILIT_GSHOW == 0)) { return ''; }

	if (!defined('EMAILIT_JS_LOADED')) {
		$sslurl = $mainframe->secureURL('http://www.e-mailit.com/');
		$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.$sslurl.'bookmark.php" charset="UTF-8"></script>');
		define('EMAILIT_JS_LOADED', 1);
	}

	$out = '<a id="emailit'.$id.'" href="javascript:void(null);" onclick="javascript:AlertMsg(\'url[]\'); return false;" onmouseover="link_hover(\'emailit'.$id.'\',\'url[]\')" onmouseout="link_hout(\'emailit'.$id.'\')">'."\n";
	$out .= '<img src="'.$mainframe->getCfg('ssl_live_site').'/images/M_images/emailit.png" alt="share" align="middle" style="border:0;" />'."\n";
	$out .= "</a> \n";

	return $out;
}

?>