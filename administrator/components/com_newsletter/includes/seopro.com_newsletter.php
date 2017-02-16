<?php 
/**
* @version: 1.3
* @copyright: Copyright (C) 2008-2010 Is Open Source. All rights reserved.
* @package: Elxis
* @subpackage: Component NewsLetter
* @author: Ioannis Sannos (Is Open Source)
* @link: http://www.isopensource.com
* @email: info@isopensource.com
* @license: http://creativecommons.org/licenses/by-sa/3.0/ Creative Commons Attribution-Share Alike 3.0
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!defined('IOSNLETTERBASE')) {
	global $_VERSION;
	if ($_VERSION->RELEASE > 2008) {
		define('IOSNLETTERBASE', 'newsletter');
	} else {
		define('IOSNLETTERBASE', 'com_newsletter');
	}
}

/*********************/
/* GENERATE SEO LINK */
/*********************/
function seogen_com_newsletter($link) { //string is a sorted URL
	global $database, $mosConfig_live_site, $lang;

	if (trim($link) == '') { return ''; }
	$vars = array();
	$vars['option'] = 'com_newsletter';
	$vars['task'] = '';

	$half = preg_split('/[\?]/', $link);
	if (isset($half[1])) {
		$half2 = preg_split('/[\#]/', $half[1]);
		$parts = preg_split('/[\&]/', $half2[0], -1, PREG_SPLIT_NO_EMPTY);
		if (count($parts) >0) {
			foreach ($parts as $part) {
				list($x, $y) = preg_split('/[\=]/', $part, 2);
				$x = strtolower($x);
				$vars[$x] = $y;
			}
		}
	}

	switch ($vars['task']) {
		case 'rconfirm': //index.php?option=com_newsletter&task=rconfirm&c=XX&Itemid=YY
			$extra = isset($vars['c']) ? '?c='.trim($vars['c']) : '';
			return $mosConfig_live_site.'/'.IOSNLETTERBASE.'/rconfirm.html'.$extra;
		break;
		case 'confirm': //index.php?option=com_newsletter&task=confirm&c=XX&Itemid=YY
			$extra = isset($vars['c']) ? '?c='.trim($vars['c']) : '';
			return $mosConfig_live_site.'/'.IOSNLETTERBASE.'/confirm.html'.$extra;
		break;
		case 'status': //index.php?option=com_newsletter&task=status&s=XX&Itemid=YY
			$extra = isset($vars['s']) ? '?s='.intval($vars['s']) : '';
			return $mosConfig_live_site.'/'.IOSNLETTERBASE.'/status.html'.$extra;
		break;
		case 'newsletter':
		default: //index.php?option=com_newsletter&Itemid=YY
			return $mosConfig_live_site.'/'.IOSNLETTERBASE.'/';
		break;
	}
	return $mosConfig_live_site.'/'.IOSNLETTERBASE.'/';
}


/********************/
/* RESTORE SEO LINK */
/********************/
function seores_com_newsletter($seolink='', $register_globals=0) {
	global $database, $lang;

	$seolink = urldecode($seolink);
    $seolink = trim(preg_replace('/(&amp;)/', '&', $seolink));
	$link = preg_split('/[\?]/', $seolink);
	$itemsyn = intval(mosGetParam( $_SESSION, 'itemsyn', 0 ));

	$QUERY_STRING = array();

	$_GET['option'] = 'com_newsletter';
	$_REQUEST['option'] = 'com_newsletter';
	$QUERY_STRING[] = 'option=com_newsletter';

	$parts = preg_split('/[\/]/', $link[0], -1, PREG_SPLIT_NO_EMPTY);

	if (!$itemsyn) {
        $query = "SELECT id FROM #__menu WHERE link='index.php?option=com_newsletter'"
		."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
		$database->setQuery($query, '#__', 1, 0);
		$_Itemid = intval($database->loadResult());
	} else {
		$_Itemid = $itemsyn;
	}

	$_GET['Itemid'] = $_Itemid;
    $_REQUEST['Itemid'] = $_Itemid;
    $QUERY_STRING[] = 'Itemid='.$_Itemid;

	if (!isset($parts[1])) {
		$_GET['task'] = 'newsletter';
		$_REQUEST['task'] = 'newsletter';
		$QUERY_STRING[] = 'task=newsletter';
	} else if ($parts[1] == 'status.html') {
		$_GET['task'] = 'status';
		$_REQUEST['task'] = 'status';
		$QUERY_STRING[] = 'task=status';
	} else if ($parts[1] == 'confirm.html') {
		$_GET['task'] = 'confirm';
		$_REQUEST['task'] = 'confirm';
		$QUERY_STRING[] = 'task=confirm';
	} else if ($parts[1] == 'rconfirm.html') {
		$_GET['task'] = 'rconfirm';
		$_REQUEST['task'] = 'rconfirm';
		$QUERY_STRING[] = 'task=rconfirm';
	} else {
		$_GET['task'] = 'newsletter';
		$_REQUEST['task'] = 'newsletter';
		$QUERY_STRING[] = 'task=newsletter';
	}

    $qs = '';
    if (count($QUERY_STRING) > 0) { $qs = implode('&',$QUERY_STRING); }
	if (trim($link[1]) != '') { $qs .= ($qs == '') ? $link[1] : '&'.$link[1]; }

    $_SERVER['QUERY_STRING'] = $qs;
	$_SERVER['REQUEST_URI'] = ($qs != '') ? '/index.php?'.$qs : '/index.php';
}

?>