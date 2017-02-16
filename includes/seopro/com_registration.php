<?php 
/**
* @ Version: $Id: com_registration.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Elxis SEO PRO
* @ Author: Ioannis Sannos (datahell)
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @ Description: SEO map for component registration.
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


/*********************/
/* GENERATE SEO LINK */
/*********************/
function seogen_com_registration($link) {
	global $database, $mosConfig_live_site;

	if (trim($link) == '') { return ''; }
	$vars = array();
	$vars['option'] = 'com_registration';
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
		case 'lostPassword': //index.php?option=com_registration&task=lostPassword
			return $mosConfig_live_site.'/registration/lost-password.html';
		break;
		case 'saveRegistration': //index.php?option=com_registration&task=saveRegistration (form submission)
			return $mosConfig_live_site.'/registration/registration-complete.html';
		break;
		case 'register': //index.php?option=com_registration&task=register
			return $mosConfig_live_site.'/registration/register.html';
		break;
		case 'activate': //index.php?option=com_registration&task=activate&activation=xxxx
		    return $mosConfig_live_site.'/registration/activate.html?activation='.$vars['activation'];
		break;
		default:
			return $mosConfig_live_site.'/registration/';
		break;
	}
}


/********************/
/* RESTORE SEO LINK */
/********************/
function seores_com_registration($seolink='') {
	global $database, $lang;

	$seolink = urldecode($seolink);
    $seolink = trim(preg_replace('/(&amp;)/', '&', $seolink));
	$link = preg_split('/[\?]/', $seolink);
	$itemsyn = intval(mosGetParam( $_SESSION, 'itemsyn', 0 ));

	$QUERY_STRING = array();
	$_GET['option'] = 'com_registration';
	$_REQUEST['option'] = 'com_registration';
	$QUERY_STRING[] = 'option=com_registration';

	$t = '';
	if ($link[0] == 'registration/register.html') {
		$_GET['task'] = 'register';
		$_REQUEST['task'] = 'register';
		$QUERY_STRING[] = 'task=register';
		$t = 'register';
	} else if ($link[0] == 'registration/activate.html') {
		$_GET['task'] = 'activate';
		$_REQUEST['task'] = 'activate';
		$QUERY_STRING[] = 'task=activate';
		$t = 'activate';
	} else if ($link[0] == 'registration/lost-password.html') {
		$_GET['task'] = 'lostPassword';
		$_REQUEST['task'] = 'lostPassword';
		$QUERY_STRING[] = 'task=lostPassword';
		$t = 'lostPassword';
	} else if ($link[0] == 'registration/registration-complete.html') { //form submission
		$_GET['task'] = 'saveRegistration';
		$_REQUEST['task'] = 'saveRegistration';
		$QUERY_STRING[] = 'task=saveRegistration';
		$t = 'saveRegistration';
	} else {
		$t = 'register';
	}

	if ($t != '') {
		if (!$itemsyn) {
			$query = "SELECT id FROM #__menu WHERE link = 'index.php?option=com_registration&task=".$t."' AND published='1'"
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
			$_POST['Itemid'] = $_Itemid; //form submission overwrite
		}
	}

    $qs = '';
    if (count($QUERY_STRING) > 0) { $qs = implode('&',$QUERY_STRING); }
	if (trim($link[1]) != '') { $qs .= ($qs == '') ? $link[1] : '&'.$link[1]; }

    $_SERVER['QUERY_STRING'] = $qs;
	$_SERVER['REQUEST_URI'] = ($qs != '') ? '/index.php?'.$qs : '/index.php';
}

?>