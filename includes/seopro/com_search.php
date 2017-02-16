<?php 
/**
* @ Version: $Id: com_search.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Elxis SEO PRO
* @ Author: Ioannis Sannos (datahell)
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @ Description: SEO map for component search
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


/*********************/
/* GENERATE SEO LINK */
/*********************/
function seogen_com_search($link) {
	global $mosConfig_live_site;

    return $mosConfig_live_site.'/search.html';
}


/********************/
/* RESTORE SEO LINK */
/********************/
function seores_com_search($seolink='') {
	global $database, $lang;

	$seolink = urldecode($seolink);
    $seolink = trim(preg_replace('/(&amp;)/', '&', $seolink));
	$link = preg_split('/[\?]/', $seolink);
	$itemsyn = intval(mosGetParam( $_SESSION, 'itemsyn', 0 ));

	$QUERY_STRING = array();
	$_GET['option'] = 'com_search';
	$_REQUEST['option'] = 'com_search';
	$QUERY_STRING[] = 'option=com_search';

	if (!$itemsyn) {
    	$query = "SELECT id FROM #__menu WHERE link = 'index.php?option=com_search' AND published='1'"
		."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))";
    	$database->setQuery($query, '#__', 1, 0);
    	$_Itemid = intval($database->loadResult());
	} else {
		$_Itemid = $itemsyn;
	}

	if ($_Itemid) {
		$_GET['Itemid'] = $_Itemid;
		$_REQUEST['Itemid'] = $_Itemid;
		$QUERY_STRING[] = 'Itemid='.$_Itemid;
	} else {
		if (isset($_POST['Itemid'])) {
			$_GET['Itemid'] = intval($_POST['Itemid']);
			$_REQUEST['Itemid'] = intval($_POST['Itemid']);
			$QUERY_STRING[] = 'Itemid='.intval($_POST['Itemid']);
		}
	}

    $qs = '';
    if (count($QUERY_STRING) > 0) { $qs = implode('&',$QUERY_STRING); }
	if (trim($link[1]) != '') { $qs .= ($qs == '') ? $link[1] : '&'.$link[1]; }

    $_SERVER['QUERY_STRING'] = $qs;
	$_SERVER['REQUEST_URI'] = ($qs != '') ? '/index.php?'.$qs : '/index.php';
}

?>