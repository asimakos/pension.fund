<?php 
/**
* @ Version: $Id: com_banners.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Elxis SEO PRO
* @ Author: Ioannis Sannos (datahell)
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @ Description: SEO map for component banners.
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


/*********************/
/* GENERATE SEO LINK */
/*********************/
function seogen_com_banners($link) { //string is a sorted URL
	global $database, $mosConfig_live_site;

	if (trim($link) == '') { return ''; }
	$vars = array();
	$vars['option'] = 'com_banners';
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

    //index.php?option=com_banners&task=click&bid=xx --> banners/bid.html
    if ($vars['task'] == 'click') {
		if (isset($vars['bid'])) {
			return $mosConfig_live_site.'/banners/'.intval($vars['bid']).'.html';
		}
        return $mosConfig_live_site.'/banners/0.html';
    }

	return $mosConfig_live_site.'/banners/';
}


/********************/
/* RESTORE SEO LINK */
/********************/
function seores_com_banners($seolink='') {
	global $database, $lang;

	$seolink = urldecode($seolink);
    $seolink = trim(preg_replace('/(&amp;)/', '&', $seolink));
	$link = preg_split('/[\?]/', $seolink);

	$QUERY_STRING = array();

	$_GET['option'] = 'com_banners';
	$_REQUEST['option'] = 'com_banners';
	$QUERY_STRING[] = 'option=com_banners';

	/* banners/bid.html */
	$parts = preg_split('/[\/]/', $link[0], -1, PREG_SPLIT_NO_EMPTY);

	$ok = 0;
	if (isset($parts[1])) {
		$bid = intval(preg_replace('/(\.html)$/', '', $parts[1]));
		if ($bid) {
			$_GET['task'] = 'click';
            $_REQUEST['task'] = 'click';
            $QUERY_STRING[] = 'task=click';		
			
            $_GET['bid'] = $bid;
            $_REQUEST['bid'] = $bid;
            $QUERY_STRING[] = 'bid='.$bid;	
		}
	}

    $qs = '';
    if (count($QUERY_STRING) > 0) { $qs = implode('&',$QUERY_STRING); }
	if (trim($link[1]) != '') { $qs .= ($qs == '') ? $link[1] : '&'.$link[1]; }

    $_SERVER['QUERY_STRING'] = $qs;
	$_SERVER['REQUEST_URI'] = ($qs != '') ? '/index.php?'.$qs : '/index.php';
}

?>