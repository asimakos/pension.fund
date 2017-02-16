<?php 
/**
* @ Version: $Id: com_wrapper.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Elxis SEO PRO
* @ Author: Ioannis Sannos (datahell)
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @ Description: SEO map for component Wrapper.
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


/*********************/
/* GENERATE SEO LINK */
/*********************/
function seogen_com_wrapper($link) {
	global $mosConfig_live_site, $database;

	if (trim($link) == '') { return ''; }
	//index.php?option=com_wrapper&Itemid=xx
	$vars = array();
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

	if (isset($vars['itemid'])) {
        $_Itemid = intval($vars['itemid']);
        if ($_Itemid) {
            $database->setQuery("SELECT seotitle FROM #__menu WHERE id='$_Itemid' AND published='1'", '#__', 1, 0);
            $seotitle = $database->loadResult();
            if ($seotitle && ($seotitle != '')) {
                return $mosConfig_live_site.'/ext/'.$seotitle.'.html'; 
            }
        }
    }
    return sefstdRelToAbs($link);
}


/********************/
/* RESTORE SEO LINK */
/********************/
function seores_com_wrapper($seolink='') {
	global $database, $lang;

	$seolink = urldecode($seolink);
    $seolink = trim(preg_replace('/(&amp;)/', '&', $seolink));
	$link = preg_split('/[\?]/', $seolink);
	$itemsyn = intval(mosGetParam( $_SESSION, 'itemsyn', 0 ));

	$QUERY_STRING = array();
	$_GET['option'] = 'com_wrapper';
	$_REQUEST['option'] = 'com_wrapper';
	$QUERY_STRING[] = 'option=com_wrapper';

	if (!$itemsyn) {
    	$_Itemid = 0;
		$parts = preg_split('/[\/]/', $link[0]);
    	if (isset($parts[1])) {
			$seotitle = htmlspecialchars(preg_replace('/(\.html)$/', '', $parts[1]));
			if (($seotitle != '') && ($seotitle != $parts[1])) {
            	$query = "SELECT id FROM #__menu WHERE seotitle = '$seotitle' AND published='1'"
            	."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))";
            	$database->setQuery($query, '#__', 1, 0);
            	$_Itemid = intval($database->loadResult());
        	}
    	}
    	if (!$_Itemid) { pageNotFound(); }
    } else {
    	$_Itemid = $itemsyn;
    }

	$_GET['Itemid'] = $_Itemid;
	$_REQUEST['Itemid'] = $_Itemid;
	$QUERY_STRING[] = 'Itemid='.$_Itemid;

    $qs = '';
    if (count($QUERY_STRING) > 0) { $qs = implode('&',$QUERY_STRING); }
	if (trim($link[1]) != '') { $qs .= ($qs == '') ? $link[1] : '&'.$link[1]; }

    $_SERVER['QUERY_STRING'] = $qs;
	$_SERVER['REQUEST_URI'] = ($qs != '') ? '/index.php?'.$qs : '/index.php';
}

?>