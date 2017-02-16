<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Elxis SEO PRO
* @author: Ioannis Sannos (datahell)
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: SEO map for component weblinks.
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


/*********************/
/* GENERATE SEO LINK */
/*********************/
function seogen_com_weblinks($link) { //string is a sorted URL
	global $database, $mosConfig_live_site;

	if (trim($link) == '') { return ''; }
	$vars = array();
	$vars['option'] = 'com_weblinks';
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
		case 'new':
		case 'edit': //index.php?option=com_weblinks&task=new&Itemid=xx
			return $mosConfig_live_site.'/links/add-link.html';
		break;
		case 'view': //index.php?option=com_weblinks&task=view&catid=xx&id=yy
			if (isset($vars['catid']) && isset($vars['id'])) {
				$database->setQuery("SELECT seotitle FROM #__categories WHERE section='com_weblinks' AND id='".intval($vars['catid'])."'", '#__', 1, 0);
				$seotitle = $database->loadResult();
				if ($seotitle && (trim($seotitle) != '')) {
					return $mosConfig_live_site.'/links/'.$seotitle.'/'.intval($vars['id']).'.html';
				}
			}
			return $mosConfig_live_site.'/'.$link;
		break;
		case '':
		default:
			if (isset($vars['catid'])) { //index.php?option=com_weblinks&catid=xx&Itemid=yy
				$database->setQuery("SELECT seotitle FROM #__categories WHERE section='com_weblinks' AND id='".intval($vars['catid'])."'", '#__', 1, 0);
				$seotitle = $database->loadResult();
				if ($seotitle && (trim($seotitle) != '')) {
					return $mosConfig_live_site.'/links/'.$seotitle.'/';
				} else {
					return $mosConfig_live_site.'/'.$link;
				}
			} else { //index.php?option=com_weblinks&Itemid=xx
				return $mosConfig_live_site.'/links/';
			}
		break;
	}
}


/********************/
/* RESTORE SEO LINK */
/********************/
function seores_com_weblinks($seolink='') {
	global $database, $lang;

	$seolink = urldecode($seolink);
    $seolink = trim(preg_replace('/(&amp;)/', '&', $seolink));
	$link = preg_split('/[\?]/', $seolink);
	$itemsyn = intval(mosGetParam( $_SESSION, 'itemsyn', 0 ));

	$QUERY_STRING = array();

	$_GET['option'] = 'com_weblinks';
	$_REQUEST['option'] = 'com_weblinks';
	$QUERY_STRING[] = 'option=com_weblinks';

	if ($link[0] == 'links/add-link.html') {
		$_GET['task'] = 'new';
		$_REQUEST['task'] = 'new';
		$QUERY_STRING[] = 'task=new';

		$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_weblinks&task=new' AND published='1'"
		."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))";

	} else if ($link[0] == 'links/') {
		$_GET['task'] = 'list';
		$_REQUEST['task'] = 'list';
		$QUERY_STRING[] = 'task=list';

		$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_weblinks' AND published='1'"
		."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))";

	} else {
		$parts = preg_split('/[\/]/', $link[0]);
		if (isset($parts[2]) && ($parts[2] != '')) {
			if (!preg_match('/(\.html)$/', $parts[2])) { pageNotFound(); }
			$id = intval(preg_replace('/(\.html)$/', '', $parts[2]));
			if ($id) {
				$_GET['id'] = $id;
				$_REQUEST['id'] = $id;
				$QUERY_STRING[] = 'id='.$id;

				$_GET['task'] = 'view';
				$_REQUEST['task'] = 'view';
				$QUERY_STRING[] = 'task=view';
			} else {
				pageNotFound();
			}
		}

		$catid = 0;
		if (isset($parts[1])) {
			$seotitle = htmlspecialchars($parts[1]);
			if ($seotitle != '') {
				$database->setQuery("SELECT id FROM #__categories WHERE seotitle='".$seotitle."' AND section='com_weblinks'");
				$catid = intval($database->loadResult());

				$_GET['catid'] = $catid;
				$_REQUEST['catid'] = $catid;
				$QUERY_STRING[] = 'catid='.$catid;
			}
			if (!$catid) { pageNotFound(); }
		}

		if ($catid) { //category link check
			$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_weblinks&catid=".$catid."' AND published='1'"
			."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
			$database->setQuery($query, '#__', 1, 0);
			$_Itemid = intval($database->loadResult());
			if (!$_Itemid) {
				$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_weblinks' AND published='1'"
				."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
			}
		} else {
			$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_weblinks' AND published='1'"
			."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
		}
	}

	if ($itemsyn) { $_Itemid = $itemsyn; }
	if (isset($_Itemid) && ($_Itemid > 0)) {
		$Itemid = $_Itemid;
	} else {
		$database->setQuery($query, '#__', 1, 0);
		$Itemid = intval($database->loadResult());
	}

	$_GET['Itemid'] = $Itemid;
	$_REQUEST['Itemid'] = $Itemid;
	$QUERY_STRING[] = 'Itemid='.$Itemid;

    $qs = '';
    if (count($QUERY_STRING) > 0) { $qs = implode('&',$QUERY_STRING); }
	if (trim($link[1]) != '') { $qs .= ($qs == '') ? $link[1] : '&'.$link[1]; }

    $_SERVER['QUERY_STRING'] = $qs;
	$_SERVER['REQUEST_URI'] = ($qs != '') ? '/index.php?'.$qs : '/index.php';
}

?>