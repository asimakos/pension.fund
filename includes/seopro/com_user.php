<?php 
/**
* @ Version: $Id: com_user.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Elxis SEO PRO
* @ Author: Ioannis Sannos (datahell)
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @ Description: SEO map for component user.
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


/*********************/
/* GENERATE SEO LINK */
/*********************/
function seogen_com_user($link) { //string is a sorted URL
	global $database, $mosConfig_live_site;

	if (trim($link) == '') { return ''; }
	$vars = array();
	$vars['option'] = 'com_user';
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
		case 'list': //index.php?option=com_user&task=list&Itemid=xx
			return $mosConfig_live_site.'/members/';
		break;
		case 'UserDetails': //index.php?option=com_user&task=UserDetails&Itemid=xx
			return $mosConfig_live_site.'/members/edit-profile.html';
		break;
		case 'profile': //index.php?option=com_user&Itemid=xx&task=profile&uid=yy;
			$uid = intval($vars['uid']);
			$database->setQuery("SELECT username FROM #__users WHERE id='$uid'", '#__', 1, 0);
			if($res = $database->loadResult()) {
				return $mosConfig_live_site.'/members/'.$res.'.html';
			} else {
				return $mosConfig_live_site.'/members/';
			}
		break;
		case 'CheckIn': //index.php?option=com_user&task=CheckIn&Itemid=xx
			return $mosConfig_live_site.'/members/checkin.html';
		break;
		default: //index.php?option=com_user&Itemid=xx
			return $mosConfig_live_site.'/members/users-main.html';
		break;
	}
}


/********************/
/* RESTORE SEO LINK */
/********************/
function seores_com_user($seolink='') {
	global $database, $lang;

	$seolink = urldecode($seolink);
    $seolink = trim(preg_replace('/(&amp;)/', '&', $seolink));
	$link = preg_split('/[\?]/', $seolink);
	$itemsyn = intval(mosGetParam( $_SESSION, 'itemsyn', 0 ));

	$QUERY_STRING = array();

	$_GET['option'] = 'com_user';
	$_REQUEST['option'] = 'com_user';
	$QUERY_STRING[] = 'option=com_user';

	$url = 'index.php?option=com_user';
	if ($link[0] == 'members/users-main.html') {
		$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_user' AND published='1'"
		."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))";
	} else if ($link[0] == 'members/edit-profile.html') {
		$_GET['task'] = 'UserDetails';
		$_REQUEST['task'] = 'UserDetails';
		$QUERY_STRING[] = 'task=UserDetails';
	
		$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_user&task=UserDetails' AND published='1'"
		."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))";
	} else if ($link[0] == 'members/') { //members list
		$_GET['task'] = 'list';
		$_REQUEST['task'] = 'list';
		$QUERY_STRING[] = 'task=list';

		$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_user&task=list' AND published='1'"
		."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))";
	} else if ($link[0] == 'members/checkin.html') { //checkin
		$_GET['task'] = 'CheckIn';
		$_REQUEST['task'] = 'CheckIn';
		$QUERY_STRING[] = 'task=CheckIn';
	
		$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_user&task=CheckIn' AND published='1'"
		."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))";
	} else {
		$parts = preg_split('/[\/]/', $link[0]);

		$ok = 0;
		if (isset($parts[1]) && ($parts[1] != '')) {
			$uid = 0;
			$username = htmlspecialchars(preg_replace('/(\.html)$/', '', $parts[1]));
			if (($username != '') && ($username != $parts[1])) {
				$database->setQuery("SELECT id FROM #__users WHERE username='$username' AND block='0'");
				$uid = intval($database->loadResult());

				$_GET['task'] = 'profile';
				$_REQUEST['task'] = 'profile';
				$QUERY_STRING[] = 'task=profile';
					
				$_GET['uid'] = $uid;
				$_REQUEST['uid'] = $uid;
				$QUERY_STRING[] = 'uid='.$uid;

				$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_user&task=list' AND published='1'"
				."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))";
				$ok = 1;
			}
			if (!$uid) { pageNotFound(); }
		}

		if (!$ok) {
			$_GET['task'] = 'list';
			$_REQUEST['task'] = 'list';
			$QUERY_STRING[] = 'task=list';

			$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_user&task=list' AND published='1'"
			."\n AND ((language LIKE '%$lang%') OR (language IS NULL))";
		}
	}

	if (!$itemsyn) {
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