<?php 
/**
* @version: $Id: com_eblog.php 2544 2009-10-02 07:48:57Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Elxis SEO PRO
* @author: Ioannis Sannos (datahell)
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: SEO map for component eBlog.
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


/*********************/
/* GENERATE SEO LINK */
/*********************/
function seogen_com_eblog($link) { //string is a sorted URL
	global $database, $mosConfig_live_site, $lang;

	if (trim($link) == '') { return ''; }
	$vars = array();
	$vars['option'] = 'com_eblog';
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
		case 'tags': //index.php?option=com_eblog&task=tags&blogid=XX&Itemid=YY&tag=ZZ
			if (isset($vars['blogid']) && isset($vars['tag'])) {
				$database->setQuery("SELECT seotitle FROM #__eblog_settings WHERE blogid='".intval($vars['blogid'])."'", '#__', 1, 0);
				$seotitle = $database->loadResult();
				if ($seotitle && (trim($seotitle) != '')) {
					return $mosConfig_live_site.'/eblog/'.$seotitle.'/tags/'.trim($vars['tag']).'.html';
				}
			}
			return $mosConfig_live_site.'/eblog/';
		break;
		case 'cpanel': //index.php?option=com_eblog&task=cpanel&blogid=XX&Itemid=YY
			if (isset($vars['blogid'])) {
				$database->setQuery("SELECT seotitle FROM #__eblog_settings WHERE blogid='".intval($vars['blogid'])."'", '#__', 1, 0);
				$seotitle = $database->loadResult();
				if ($seotitle && (trim($seotitle) != '')) {
					return $mosConfig_live_site.'/eblog/'.$seotitle.'/cpanel.html';
				}
			}
			return $mosConfig_live_site.'/eblog/';
		break;
		case 'new': //index.php?option=com_eblog&task=new&blogid=XX&Itemid=YY
		case 'edit': //index.php?option=com_eblog&task=edit&blogid=XX&id=ZZ&Itemid=YY
			if (isset($vars['blogid'])) {
				$database->setQuery("SELECT seotitle FROM #__eblog_settings WHERE blogid='".intval($vars['blogid'])."'", '#__', 1, 0);
				$seotitle = $database->loadResult();
				if ($seotitle && (trim($seotitle) != '')) {
					if ($vars['task'] == 'new') {
						return $mosConfig_live_site.'/eblog/'.$seotitle.'/new.html';
					} else {
						$id = isset($vars['id']) ? intval($vars['id']) : 0;
						return $mosConfig_live_site.'/eblog/'.$seotitle.'/edit.html?id='.$id;
					}
				}
			}
			return $mosConfig_live_site.'/eblog/';
		break;
		case 'config': //index.php?option=com_eblog&task=config&blogid=XX&Itemid=YY
			if (isset($vars['blogid'])) {
				$database->setQuery("SELECT seotitle FROM #__eblog_settings WHERE blogid='".intval($vars['blogid'])."'", '#__', 1, 0);
				$seotitle = $database->loadResult();
				if ($seotitle && (trim($seotitle) != '')) {
					return $mosConfig_live_site.'/eblog/'.$seotitle.'/config.html';
				}
			}
			return $mosConfig_live_site.'/eblog/';
		break;
		case 'archive': //index.php?option=com_eblog&task=archive&month=ZZ&blogid=XX&Itemid=YY
			if (isset($vars['blogid'])) {
				$database->setQuery("SELECT seotitle FROM #__eblog_settings WHERE blogid='".intval($vars['blogid'])."'", '#__', 1, 0);
				$seotitle = $database->loadResult();
				if ($seotitle && (trim($seotitle) != '')) {
					if (isset($vars['month']) && (intval($vars['month']) > 200806)) {
						return $mosConfig_live_site.'/eblog/'.$seotitle.'/'.intval($vars['month']).'/';
					} else {
						return $mosConfig_live_site.'/eblog/'.$seotitle.'/'.date('Ym').'/';
					}
				
				}
			}
			return $mosConfig_live_site.'/eblog/';	
		break;
		case 'dayposts': //index.php?option=com_eblog&task=dayposts&day=ZZ&blogid=XX&Itemid=YY
			if (isset($vars['blogid'])) {
				$database->setQuery("SELECT seotitle FROM #__eblog_settings WHERE blogid='".intval($vars['blogid'])."'", '#__', 1, 0);
				$seotitle = $database->loadResult();
				if ($seotitle && (trim($seotitle) != '')) {
					if (isset($vars['day']) && (intval($vars['day']) > 20080601)) {
						return $mosConfig_live_site.'/eblog/'.$seotitle.'/'.intval($vars['day']).'/';
					} else {
						return $mosConfig_live_site.'/eblog/'.$seotitle.'/'.date('Ymd').'/';
					}
				}
			}
			return $mosConfig_live_site.'/eblog/';	
		break;
		case 'show': //index.php?option=com_eblog&task=show&blogid=XX&id=ZZ&Itemid=YY
			if (isset($vars['blogid'])) {
				$database->setQuery("SELECT seotitle FROM #__eblog_settings WHERE blogid='".intval($vars['blogid'])."'", '#__', 1, 0);
				$seotitle = $database->loadResult();
				if ($seotitle && (trim($seotitle) != '')) {
					$id = isset($vars['id']) ? intval($vars['id']) : 0;
					$database->setQuery("SELECT seotitle FROM #__eblog WHERE blogid='".intval($vars['blogid'])."' AND id='".$id."'", '#__', 1, 0);
					$postseo = $database->loadResult();
					if ($postseo && (trim($postseo) != '')) {
						return $mosConfig_live_site.'/eblog/'.$seotitle.'/'.$postseo.'.html';
					} else {
						return $mosConfig_live_site.'/eblog/'.$seotitle.'/';
					}
				}
			}
			return $mosConfig_live_site.'/eblog/';
		break;
		case 'browse': //index.php?option=com_eblog&task=browse&blogid=XX&Itemid=YY
			if (isset($vars['blogid'])) {
				$database->setQuery("SELECT seotitle FROM #__eblog_settings WHERE blogid='".intval($vars['blogid'])."'", '#__', 1, 0);
				$seotitle = $database->loadResult();
				if ($seotitle && (trim($seotitle) != '')) {
					return $mosConfig_live_site.'/eblog/'.$seotitle.'/';
				}
			}
			return $mosConfig_live_site.'/eblog/';
		break;
		case 'list':
		default: //index.php?option=com_eblog&Itemid=YY
			return $mosConfig_live_site.'/eblog/';
		break;
	}
	return $mosConfig_live_site.'/eblog/';
}


/********************/
/* RESTORE SEO LINK */
/********************/
function seores_com_eblog($seolink='') {
	global $database, $lang;

	$seolink = urldecode($seolink);
    $seolink = trim(preg_replace('/(&amp;)/', '&', $seolink));
	$link = preg_split('/[\?]/', $seolink);
	$itemsyn = intval(mosGetParam( $_SESSION, 'itemsyn', 0 ));

	$QUERY_STRING = array();

	$_GET['option'] = 'com_eblog';
	$_REQUEST['option'] = 'com_eblog';
	$QUERY_STRING[] = 'option=com_eblog';

	$parts = preg_split('/[\/]/', $link[0], -1, PREG_SPLIT_NO_EMPTY);

	if (!isset($parts[1])) {
		$_GET['task'] = 'list';
		$_REQUEST['task'] = 'list';
		$QUERY_STRING[] = 'task=list';

		if (!$itemsyn) {
            $query = "SELECT id FROM #__menu WHERE link='index.php?option=com_eblog'"
			."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
			$database->setQuery($query, '#__', 1, 0);
			$_Itemid = intval($database->loadResult());
		} else {
			$_Itemid = $itemsyn;
		}
        
		$_GET['Itemid'] = $_Itemid;
        $_REQUEST['Itemid'] = $_Itemid;
        $QUERY_STRING[] = 'Itemid='.$_Itemid;
		$ok = 1;
	} else {
		$blogseo = htmlspecialchars($parts[1]);
		$database->setQuery("SELECT blogid FROM #__eblog_settings WHERE seotitle='".$blogseo."'",'#__', 1, 0);
		$blogid = intval($database->loadResult());
		if (!$blogid) {	pageNotFound(); }

		$_GET['blogid'] = $blogid;
		$_REQUEST['blogid'] = $blogid;
		$QUERY_STRING[] = 'blogid='.$blogid;		

		if (!$itemsyn) {
			//check for direct link to blog
            $query = "SELECT id FROM #__menu WHERE link='index.php?option=com_eblog&task=browse&blogid=".$blogid."'"
			."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
			$database->setQuery($query, '#__', 1, 0);
			$_Itemid = intval($database->loadResult());
			if (!$_Itemid) {
            	$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_eblog'"
				."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
				$database->setQuery($query, '#__', 1, 0);
				$_Itemid = intval($database->loadResult());
			}
		} else {
			$_Itemid = $itemsyn;
		}

		$_GET['Itemid'] = $_Itemid;
        $_REQUEST['Itemid'] = $_Itemid;
        $QUERY_STRING[] = 'Itemid='.$_Itemid;

		$ok = 0;
		//now find the task and the other variables...
		if (!isset($parts[2])) { //eblog/blogseo/
			$_GET['task'] = 'browse';
			$_REQUEST['task'] = 'browse';
			$QUERY_STRING[] = 'task=browse';
			$ok = 1;
		}
		
		if (!$ok && isset($parts[2]) && ($parts[2] == 'tags')) { //eblog/blogseo/tags/tag.html
			$_GET['task'] = 'tags';
			$_REQUEST['task'] = 'tags';
			$QUERY_STRING[] = 'task=tags';

			if (isset($parts[3]) && preg_match('/(.html)$/', $parts[3] )) {
				$tag = htmlspecialchars(preg_replace('/(\.html)$/', '', $parts[3]), ENT_QUOTES);
				$_GET['tag'] = $tag;
				$_REQUEST['tag'] = $tag;
				$QUERY_STRING[] = 'tag='.$tag;
				$ok = 1;
			} else {
				pageNotFound();
			}
		}

		if (!$ok && isset($parts[2]) && ($parts[2] == 'cpanel.html')) { //eblog/blogseo/cpanel.html
			$_GET['task'] = 'cpanel';
			$_REQUEST['task'] = 'cpanel';
			$QUERY_STRING[] = 'task=cpanel';
			$ok = 1;
		}

		if (!$ok && isset($parts[2]) && ($parts[2] == 'new.html')) { //eblog/blogseo/new.html
			$_GET['task'] = 'new';
			$_REQUEST['task'] = 'new';
			$QUERY_STRING[] = 'task=new';
			$ok = 1;
		}

		if (!$ok && isset($parts[2]) && ($parts[2] == 'edit.html')) { //eblog/blogseo/edit.html?id=XX
			$_GET['task'] = 'edit';
			$_REQUEST['task'] = 'edit';
			$QUERY_STRING[] = 'task=edit';
			//$id is already a $_GET var
			$ok = 1;
		}

		if (!$ok && isset($parts[2]) && ($parts[2] == 'config.html')) { //eblog/blogseo/config.html
			$_GET['task'] = 'config';
			$_REQUEST['task'] = 'config';
			$QUERY_STRING[] = 'task=config';
			$ok = 1;
		}

		if (!$ok && isset($parts[2]) && preg_match('/(.html)$/', $parts[2])) { //eblog/blogseo/seotitle.html
			$_GET['task'] = 'show';
			$_REQUEST['task'] = 'show';
			$QUERY_STRING[] = 'task=show';

			$seotitle = htmlspecialchars(preg_replace('/(\.html)$/', '', $parts[2]), ENT_QUOTES);
			$database->setQuery("SELECT id FROM #__eblog WHERE blogid='".$blogid."' AND seotitle='".$seotitle."'", '#__', 1, 0);
			$id = intval($database->loadResult());
			if (!$id) {	pageNotFound(); }

			$_GET['id'] = $id;
			$_REQUEST['id'] = $id;
			$QUERY_STRING[] = 'id='.$id;
			$ok = 1;
		}

		if (!$ok && isset($parts[2]) && is_numeric($parts[2]) && (strlen($parts[2]) == 8)) { //eblog/blogseo/day/
			$day = intval($parts[2]);
			if (($day < 20080701) || ($day > intval(date('Ymd')))) {
				pageNotFound();
			}
			$_GET['task'] = 'dayposts';
			$_REQUEST['task'] = 'dayposts';
			$QUERY_STRING[] = 'task=dayposts';

			$_GET['day'] = $day;
			$_REQUEST['day'] = $day;
			$QUERY_STRING[] = 'day='.$day;
			$ok = 1;
		}

		if (!$ok && isset($parts[2]) && is_numeric($parts[2])) { //eblog/blogseo/month/
			$month = intval($parts[2]);
			if (($month < 200807) || ($month > intval(date('Ym')))) {
				pageNotFound();
			}
			$_GET['task'] = 'archive';
			$_REQUEST['task'] = 'archive';
			$QUERY_STRING[] = 'task=archive';

			$_GET['month'] = $month;
			$_REQUEST['month'] = $month;
			$QUERY_STRING[] = 'month='.$month;
			$ok = 1;
		}
	}

    $qs = '';
    if (count($QUERY_STRING) > 0) { $qs = implode('&',$QUERY_STRING); }
	if (trim($link[1]) != '') { $qs .= ($qs == '') ? $link[1] : '&'.$link[1]; }

    $_SERVER['QUERY_STRING'] = $qs;
	$_SERVER['REQUEST_URI'] = ($qs != '') ? '/index.php?'.$qs : '/index.php';
}

?>