<?php 
/**
* @ Version: $Id: com_poll.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Elxis SEO PRO
* @ Author: Ioannis Sannos (datahell)
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @ Description: SEO map for component poll.
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


/*********************/
/* GENERATE SEO LINK */
/*********************/
function seogen_com_poll($link) { //string is a sorted URL
	global $database, $mosConfig_live_site;

	if (trim($link) == '') { return ''; }
	$vars = array();
	$vars['option'] = 'com_poll';
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

    //index.php?option=com_poll&task=results&id=xx(&Itemid=yy) ---> polls/poll-name.html (results page)
    if ($vars['task'] == 'results') {
		if (isset($vars['id'])) {
			$query = "SELECT seotitle FROM #__polls"
			."\n WHERE id='".intval($vars['id'])."' AND published='1'";
			$database->setQuery($query, '#__', 1, 0);
			$seotitle = $database->loadResult();
			if ($seotitle && ($seotitle != '')) {
				return $mosConfig_live_site.'/polls/'.$seotitle.'.html';
			}
		}
        return $mosConfig_live_site.'/polls/';
    } else if ($vars['task'] == 'vote') { //poll form submition
		return $mosConfig_live_site.'/polls/vote.html';
	} else {
	   return $mosConfig_live_site.'/polls/';
	}
}


/********************/
/* RESTORE SEO LINK */
/********************/
function seores_com_poll($seolink='') {
	global $database, $lang;

	$seolink = urldecode($seolink);
    $seolink = trim(preg_replace('/(&amp;)/', '&', $seolink));
	$link = preg_split('/[\?]/', $seolink);
	$itemsyn = intval(mosGetParam( $_SESSION, 'itemsyn', 0 ));

	$QUERY_STRING = array();

	$_GET['option'] = 'com_poll';
	$_REQUEST['option'] = 'com_poll';
	$QUERY_STRING[] = 'option=com_poll';

    $ok = 0;
	if ($link[0] == 'polls/vote.html') {
        $_GET['task'] = 'vote';
        $_REQUEST['task'] = 'vote';
        $QUERY_STRING[] = 'task=vote';

        $query = "SELECT id FROM #__menu WHERE link='index.php?option=com_poll' AND published='1'"
        ."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))";
        $database->setQuery($query, '#__', 1, 0);
        $_Itemid = intval($database->loadResult());
        if (!$_Itemid && isset($_POST['Itemid'])) { $_Itemid = intval($_POST['Itemid']); }

        $_GET['Itemid'] = $_Itemid;
        $_REQUEST['Itemid'] = $_Itemid;
        $QUERY_STRING[] = 'Itemid='.$_Itemid;
        $ok = 1;
	}

	if (!$ok) {
		$_GET['task'] = 'results';
        $_REQUEST['task'] = 'results';
        $QUERY_STRING[] = 'task=results';

	    /* polls/seotitle.html */
        $parts = preg_split('/[\/]/', $link[0], -1, PREG_SPLIT_NO_EMPTY);
        $id = 0;
        if (isset($parts[1])) {
            $seotitle = htmlspecialchars(preg_replace('/(\.html)$/', '', $parts[1]));
            if (($seotitle != '') && ($seotitle != $parts[1])) {
                //index.php?option=com_poll&task=results&id=xx&Itemid=yy
                $database->setQuery("SELECT id FROM #__polls WHERE seotitle='$seotitle' AND published='1'", '#__', 1, 0);
                $id = intval($database->loadResult());
            }
            if (!$id) { pageNotFound(); }
        }
        $_GET['id'] = $id;
        $_REQUEST['id'] = $id;
        $QUERY_STRING[] = 'id='.$id;
        $_Itemid = 0;
        if ($id) {
            $database->setQuery("SELECT menuid FROM #__poll_menu WHERE pollid='$id' AND menuid <> '0'", '#__', 1, 0);
            $_Itemid = intval($database->loadResult());
        }
        if (!$_Itemid) {
        	if (!$itemsyn) {
            	$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_poll'"
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
	}

    $qs = '';
    if (count($QUERY_STRING) > 0) { $qs = implode('&',$QUERY_STRING); }
	if (trim($link[1]) != '') { $qs .= ($qs == '') ? $link[1] : '&'.$link[1]; }

    $_SERVER['QUERY_STRING'] = $qs;
	$_SERVER['REQUEST_URI'] = ($qs != '') ? '/index.php?'.$qs : '/index.php';
}

?>