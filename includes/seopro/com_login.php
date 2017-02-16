<?php 
/**
* @version: $Id: com_login.php 2558 2009-10-07 17:25:24Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Elxis SEO PRO
* @author: Ioannis Sannos (datahell)
* @link: http://www.elxis.org
* @email: info@elxis.org
* @lLicense: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: SEO map for component login.
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


/*********************/
/* GENERATE SEO LINK */
/*********************/
function seogen_com_login($link) {
	global $mosConfig_live_site, $my;

	if (trim($link) == '') { return ''; }
	//index.php?option=com_login&Itemid=xx
    if (isset($my) && ($my->id)) {
        return $mosConfig_live_site.'/logout.html';
    } else {
        return $mosConfig_live_site.'/login.html';
    }
}


/********************/
/* RESTORE SEO LINK */
/********************/
function seores_com_login($seolink='') {
	global $database, $lang;

	$seolink = urldecode($seolink);
    $seolink = trim(preg_replace('/(&amp;)/', '&', $seolink));
	$link = preg_split('/[\?]/', $seolink);
	$itemsyn = intval(mosGetParam( $_SESSION, 'itemsyn', 0 ));

	$QUERY_STRING = array();
	$_GET['option'] = 'com_login';
	$_REQUEST['option'] = 'com_login';
	$QUERY_STRING[] = 'option=com_login';

	if (!$itemsyn) {
    	$where = '';
    	if (preg_match('/login/', $seolink)) {
        	$where = "\n AND access = '29'"; //even 0 is better than not allowed...
    	} else {
    		$where = "\n AND access != '29'";
    	}

    	$query = "SELECT id FROM #__menu WHERE link = 'index.php?option=com_login' AND published='1'"
		."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))"
    	.$where;
    	$database->setQuery($query, '#__', 1, 0);
    	$_Itemid = intval($database->loadResult());
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