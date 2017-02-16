<?php 
/**
* @ Version: $Id: com_newsfeeds.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Elxis SEO PRO
* @ Author: Ioannis Sannos (datahell)
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @ Description: SEO map for component newsfeeds.
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


/*********************/
/* GENERATE SEO LINK */
/*********************/
function seogen_com_newsfeeds($link) { //string is a sorted URL
	global $database, $mosConfig_live_site;

	if (trim($link) == '') { return ''; }
	$vars = array();
	$vars['option'] = 'com_newsfeeds';
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

	//index.php?option=com_newsfeeds&task=view&feedid=xx&Itemid=yy ---> feeds/category/feed.html
    if ($vars['task'] == 'view') {
		if (isset($vars['feedid'])) {
			$query = "SELECT d.seotitle AS seoitem, c.seotitle AS seocat FROM #__newsfeeds d"
			."\n LEFT JOIN #__categories c ON c.id=d.catid"
			."\n WHERE d.id='".intval($vars['feedid'])."' AND d.published='1'"
			."\n AND c.published='1'";
			$database->setQuery($query, '#__', 1, 0);
			$row = $database->loadRow();
			if ($row && ($row['seoitem'] != '') && ($row['seocat'] != '')) {
				return $mosConfig_live_site.'/feeds/'.$row['seocat'].'/'.$row['seoitem'].'.html';
			}
		}
        return sefstdRelToAbs($link);
    }

    //index.php?option=com_newsfeeds&catid=xx&Itemid=yy --> feeds/category/
	if (isset($vars['catid'])) {
		$database->setQuery("SELECT seotitle FROM #__categories WHERE section='com_newsfeeds' AND id='".$vars['catid']."'", '#__', 1, 0);
		$seotitle = $database->loadResult();
		if ($seotitle && (trim($seotitle) != '')) {
			return $mosConfig_live_site.'/feeds/'.$seotitle.'/';
		} else {
			return sefstdRelToAbs($link);
		}
	} else { //index.php?option=com_newsfeeds&Itemid=xx
		return $mosConfig_live_site.'/feeds/';
	}

}


/********************/
/* RESTORE SEO LINK */
/********************/
function seores_com_newsfeeds($seolink='') {
	global $database, $lang;

	$seolink = urldecode($seolink);
    $seolink = trim(preg_replace('/(&amp;)/', '&', $seolink));
	$link = preg_split('/[\?]/', $seolink);
	$itemsyn = intval(mosGetParam( $_SESSION, 'itemsyn', 0 ));

	$QUERY_STRING = array();

	$_GET['option'] = 'com_newsfeeds';
	$_REQUEST['option'] = 'com_newsfeeds';
	$QUERY_STRING[] = 'option=com_newsfeeds';

	/* feeds/seocategory/seotitle.html(?xxx=yyyy) */
	$parts = preg_split('/[\/]/', $link[0], -1, PREG_SPLIT_NO_EMPTY);

	$ok = 0;
	if (isset($parts[2])) {
		$feedname = htmlspecialchars(preg_replace('/(\.html)$/', '', $parts[2]));
		if (($feedname != '') && ($feedname != $parts[2])) {
			//index.php?option=com_newsfeeds&task=view&feedid=xx&Itemid=yy
			$database->setQuery("SELECT id, catid FROM #__newsfeeds WHERE seotitle='$feedname' AND published='1'", '#__', 1, 0);
			$row = $database->loadRow();
			if ($row) {
				$feedid = intval($row['id']);
				$catid = intval($row['catid']);

			    $_GET['task'] = 'view';
                $_REQUEST['task'] = 'view';
                $QUERY_STRING[] = 'task=view';

                $_GET['feedid'] = $feedid;
                $_REQUEST['feedid'] = $feedid;
                $QUERY_STRING[] = 'feedid='.$feedid;

				if (!$itemsyn) {
                	$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_newsfeeds&task=view&id=".$feedid."'"
                	."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%$lang%'))";
                	$database->setQuery($query, '#__', 1, 0);
                	if (!$_Itemid = intval($database->loadResult())) {
				    	$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_newsfeeds&catid=".$catid."'"
                    	."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%$lang%'))";
                    	$database->setQuery($query, '#__', 1, 0);
                    	if (!$_Itemid = intval($database->loadResult())) {
                        	$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_newsfeeds' AND published='1'"
                        	."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))";
                        	$database->setQuery($query, '#__', 1, 0);
                        	$_Itemid = intval($database->loadResult());
                    	}
                	}
                } else {
                	$_Itemid = $itemsyn;
                }
                $_GET['Itemid'] = $_Itemid;
                $_REQUEST['Itemid'] = $_Itemid;
                $QUERY_STRING[] = 'Itemid='.$_Itemid;
                $ok = 1;
			} else {
				pageNotFound();
			}
		}
	}

    if (isset($parts[1]) && !$ok) {
        $seocat = htmlspecialchars($parts[1]);
        $database->setQuery("SELECT id FROM #__categories WHERE seotitle='$seocat' AND section='com_newsfeeds' AND published='1'", '#__', 1, 0);
        $catid = intval($database->loadResult());

        if ($catid) {
            $_GET['catid'] = $catid;
            $_REQUEST['catid'] = $catid;
            $QUERY_STRING[] = 'catid='.$catid;

			if (!$itemsyn) {
				$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_newsfeeds&catid=".$catid."'"
            	."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%$lang%'))";
            	$database->setQuery($query, '#__', 1, 0);
            	if (!$_Itemid = intval($database->loadResult())) {
                	$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_newsfeeds' AND published='1'"
                	."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))";
                	$database->setQuery($query, '#__', 1, 0);
                	$_Itemid = intval($database->loadResult());
            	}
            } else {
            	$_Itemid = $itemsyn;
            }
            $_GET['Itemid'] = $_Itemid;
            $_REQUEST['Itemid'] = $_Itemid;
            $QUERY_STRING[] = 'Itemid='.$_Itemid;
            $ok = 1;
        } else {
        	pageNotFound();
        }
    }

	if (!isset($parts[1]) || !$ok) {
		if (!$itemsyn) {
        	$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_newsfeeds' AND published='1'"
			."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))";
			$database->setQuery($query, '#__', 1, 0);
			$_Itemid = intval($database->loadResult());
		} else {
			$_Itemid = $itemsyn;
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