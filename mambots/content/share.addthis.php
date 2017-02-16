<?php 
/** 
* @version: $Id: share.addthis.php 30 2010-06-05 16:58:46Z sannosi $
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


$_MAMBOTS->registerFunction('onContentIcons', 'shareAddThis');

/*********************/
/* ADDTHIS SHARE BOT */
/*********************/
function shareAddThis($published, &$row, $params, $page=0) {
	global $database, $mainframe;

    if (!$published) { return ''; }
	if ($params->get('popup', 0) == 1) { return ''; }
	if (isset($_SERVER['SCRIPT_NAME'])) {
		if (preg_match('/index2/i', $_SERVER['SCRIPT_NAME'])) { return ''; }
	} else if (isset($_SERVER['PHP_SELF'])) {
		if (preg_match('/index2/i', $_SERVER['PHP_SELF'])) { return ''; }
	}
    $ishow = intval($params->get('addthis', 2));
	if ($ishow == 0) { return ''; }

    if (!defined('SHARE_ADDTHIS_USER')) {
		$query = "SELECT params FROM #__mambots WHERE element = 'share.addthis' AND folder = 'content'";
		$database->setQuery($query, '#__', 1, 0);
		$mparams = $database->loadResult();
		if (!$mparams) { $mparams = ''; }

		$xparams = new mosParameters($mparams);
		define('SHARE_ADDTHIS_USER', trim($xparams->get('username', '')));
		define('SHARE_ADDTHIS_GSHOW', intval($xparams->get('globalshow', 1)));
	}

	if (($ishow == 2) && (SHARE_ADDTHIS_GSHOW == 0)) { return ''; }

	if (SHARE_ADDTHIS_USER != '') {
		$str_uname1 = '&amp;username='.SHARE_ADDTHIS_USER;
		$str_uname2 = '#username='.SHARE_ADDTHIS_USER;
	} else {
		$str_uname1 = '';
		$str_uname2 = '';
	}

	$out = '<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250'.$str_uname1.'">'."\n";
	$out .= '<img src="'.$mainframe->getCfg('ssl_live_site').'/images/M_images/addthis.gif" alt="share" align="middle" style="border:0;" />'."\n";
	$out .= "</a> \n";
	if (!defined('ADDTHIS_JS_LOADED')) {
		$out .= '<script type="text/javascript" src="'.$mainframe->secureURL('http://s7.addthis.com/').'js/250/addthis_widget.js'.$str_uname2.'"></script>'."\n";
		define('ADDTHIS_JS_LOADED', 1);
	}
	return $out;
}

?>