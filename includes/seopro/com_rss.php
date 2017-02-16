<?php 
/**
* @ Version: $Id: com_rss.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Elxis SEO PRO
* @ Author: Ioannis Sannos (datahell)
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @ Description: SEO map for component RSS.
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


/*********************/
/* GENERATE SEO LINK */
/*********************/
function seogen_com_rss($link) { //string is a sorted URL
	global $mosConfig_live_site;

	if (trim($link) == '') { return ''; }
	$vars = array();
	$vars['option'] = 'com_rss';
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
		case 'live_bookmark': //normally never used
			return $mosConfig_live_site.'/'.$link;
		break;
		default:
			if (isset($vars['feed'])) { //index.php?option=com_rss&feed=xx&no_html=1
				$vfeeds = array( 'RSS0.91', 'RSS1.0', 'RSS2.0', 'OPML', 'ATOM0.3' ); //PIE0.1, MBOX, HTML, JS removed
				if (!in_array($vars['feed'], $vfeeds)) { $vars['feed'] = 'RSS2.0'; }
			} else {
				$vars['feed'] = 'RSS2.0';
			}
			$seofeed = strtolower($vars['feed']);
			$seofeed = str_replace('\.', '', $seofeed);
			return $mosConfig_live_site.'/rss/'.$seofeed.'.xml';
		break;
	}
}


/********************/
/* RESTORE SEO LINK */
/********************/
function seores_com_rss($seolink='') {
	$seolink = urldecode($seolink);
    $seolink = trim(preg_replace('/(&amp;)/', '&', $seolink));
	$link = preg_split('/[\?]/', $seolink);

	$QUERY_STRING = array();

	$_GET['option'] = 'com_rss';
	$_REQUEST['option'] = 'com_rss';
	$QUERY_STRING[] = 'option=com_rss';

	$parts = preg_split('/[\/]/', $link[0]);

	if (isset($parts[1])) {
		$seotitle = htmlspecialchars(preg_replace('/(\.xml)$/', '', $parts[1]));
		$vfeeds = array( 'rss091', 'rss10', 'rss20', 'opml', 'atom03' ); //PIE0.1, MBOX, HTML, JS removed
		if (!in_array($seotitle, $vfeeds)) { $seotitle = 'rss20'; }
	} else {
		$seotitle = 'rss20';
	}

	switch ($seotitle) {
		case 'rss091': $feed = 'RSS.91'; break;
		case 'rss10': $feed = 'RSS1.0'; break;
		case 'opml': $feed = 'OPML'; break;
		case 'atom03': $feed = 'ATOM0.3'; break;
		case 'rss20': default: $feed = 'RSS2.0'; break;
	}

	$_GET['feed'] = $feed;
	$_REQUEST['feed'] = $feed;
	$QUERY_STRING[] = 'feed='.$feed;

	$_GET['no_html'] = 1;
	$_REQUEST['no_html'] = 1;
	$QUERY_STRING[] = 'no_html=1';

    $qs = '';
    if (count($QUERY_STRING) > 0) { $qs = implode('&',$QUERY_STRING); }
	if (trim($link[1]) != '') { $qs .= ($qs == '') ? $link[1] : '&'.$link[1]; }

    $_SERVER['QUERY_STRING'] = $qs;
	$_SERVER['REQUEST_URI'] = ($qs != '') ? '/index2.php?'.$qs : '/index2.php';
}

?>