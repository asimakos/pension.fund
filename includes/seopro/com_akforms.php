<?php
/**
* @version: 1.6
* @package: Component AkForms
* @author: Andrew Campoball
* @email: ACampball@yandex.ru
* @link:
* @license: GPL
* @copyright: (C) 2009 Andrew Campball. All rights reserved.
* @description: AkForms component for Elxis CMS.
*****************************************************************************/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

define('AKFORMS_BASE', 'forms');
/*
if (!defined('AKFORMS_BASE')) {
     global $_VERSION;
     if ($_VERSION->RELEASE.$_VERSION->DEV_LEVEL > '20092') {
		define('AKFORMS_BASE', 'forms');
	} else {
		define('AKFORMS_BASE', 'com_akforms');
	}
}
*/

/*********************/
/* GENERATE SEO LINK */
/*********************/
function seogen_com_akforms($link) { //string is a sorted URL
	global $database, $mosConfig_live_site;

	if (trim($link) == '') { return ''; }
	$vars = array();
	$vars['option'] = 'com_akforms';
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

   return $mosConfig_live_site.'/'.AKFORMS_BASE.'/'.(isset($vars['task']) && $vars['task']!='' ? $vars['task'].'/' : '').(isset($vars['id']) && $vars['id']!='' ? $vars['id'].'.html' : '');
}


/********************/
/* RESTORE SEO LINK */
/********************/
function seores_com_akforms($seolink='') {
	global $database, $lang;

	$seolink = urldecode($seolink);
    $seolink = trim(preg_replace('/(&amp;)/', '&', $seolink));
	$link = preg_split('/[\?]/', $seolink);
	$itemsyn = intval(mosGetParam( $_SESSION, 'itemsyn', 0 ));

	$QUERY_STRING = array();

	$_GET['option'] = 'com_akforms';
	$_REQUEST['option'] = 'com_akforms';
	$QUERY_STRING[] = 'option=com_akforms';

	$parts = preg_split('/[\/]/', $link[0], -1, PREG_SPLIT_NO_EMPTY);
	$ok = 0;
	$cparts = count($parts);

	if ( !$ok && ($cparts == 3) && preg_match('/\.html/i', $parts[2]) ) {
		$id = preg_replace('/(\.html)$/i', '', $parts[2], ENT_QUOTES);

        $_GET['id'] = $id;
        $_REQUEST['id'] = $id;
        $QUERY_STRING[] = 'id='.$id;

        $_GET['task'] = $parts[1];
        $_REQUEST['task'] = $parts[1];
        $QUERY_STRING[] = 'task='.$parts[1];

        $ok = 1;
	}

	if ( !$ok && ($cparts == 2) ) {
        $_GET['task'] = $parts[1];
        $_REQUEST['task'] = $parts[1];
        $QUERY_STRING[] = 'task='.$parts[1];

        $ok = 1;
	}

    if (!$_Itemid) {
    	if (!$itemsyn) {
        	$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_akforms'"
        	."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%$lang%'))";
        	$database->setQuery($query, '#__', 1, 0);
        	$_Itemid = intval($database->loadResult());
        } else {
        	$_Itemid = $itemsyn;
        }
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