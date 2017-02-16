<?php 
/**
* @version: $Id: eblog.searchbot.php 2494 2009-09-12 08:27:05Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Bots/Search
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Extends search to eblog posts
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction('onSearch', 'botSearchEblog');


/*********************************/
/* PERFORM SEARCH ON EBLOG POSTS */
/*********************************/
function botSearchEblog($text, $phrase='', $ordering='') {
	global $database, $mainframe, $lang, $_MAMBOTS;

	//check if param query has previously been processed
	if (!isset($_MAMBOTS->_search_bot_params['eblog'])) {
		//load mambot params info
		$query = "SELECT params FROM #__mambots WHERE element = 'eblog.searchbot' AND folder = 'search'";
		$database->setQuery($query, '#__', 1, 0);
		$database->loadObject($mambot);
		$_MAMBOTS->_search_bot_params['eblog'] = $mambot;
	}

	$mambot = $_MAMBOTS->_search_bot_params['eblog'];	

	$params = new mosParameters($mambot->params);
	$limit = (int)$params->def('search_limit', 30);
	if ($limit < 10) { $limit = 30; }

	$_SESSION['searchword'] = $text;
	$now = date("Y-m-d H:i:s", time() + ($mainframe->getCfg('offset') * 3600));

	$text = eUTF::utf8_trim($text);
	if ($text == '') { return array(); }

	$wheres = array();
	switch ($phrase) {
		case 'exact':
			$wheres2 = array();
			$wheres2[] = "LOWER(a.title) LIKE '%".$text."%'";
			$wheres2[] = "LOWER(a.blogtext) LIKE '%".$text."%'";
			$wheres2[] = "LOWER(a.tags) LIKE '%".$text."%'";
			$where = '('.implode( ') OR (', $wheres2 ).')';
			break;
		case 'all':
		case 'any':
		default:
			$words = explode( ' ', $text );
			$wheres = array();
			foreach ($words as $word) {
				$wheres2 = array();
				$wheres2[] = "LOWER(a.title) LIKE '%".$word."%'";
				$wheres2[] = "LOWER(a.blogtext) LIKE '%".$word."%'";
				$wheres2[] = "LOWER(a.tags) LIKE '%".$word."%'";
				$wheres[] = implode(' OR ', $wheres2);
			}
			$where = '('.implode( ($phrase == 'all' ? ') AND (' : ') OR ('), $wheres ).')';
			break;
	}

	switch ($ordering) {
		case 'oldest':
			$order = 'a.dateadded ASC';
		break;
		case 'popular':
			$order = 'a.hits DESC';
		break;
		case 'alpha':
			$order = 'a.title ASC';
		break;
		case 'category':
			$order = 's.title ASC, a.title ASC';
		break;
		case 'newest':
		default:
			$order = 'a.dateadded DESC';
		break;
	}

	$sql = "SELECT a.title AS title, a.dateadded AS created, a.blogtext AS text, s.title AS section,"
	."\n ".$database->_resource->Concat("'index.php?option=com_eblog&task=show&blogid='",'s.blogid',"'&id='",'a.id')." AS href,"
	."\n ".$database->_resource->Concat("'eblog/'", 's.seotitle', "'/'", 'a.seotitle', "'.html'")." AS seolink,"
	."\n '2' AS browsernav"
	."\n FROM #__eblog a"
	."\n LEFT JOIN #__eblog_settings s ON s.blogid = a.blogid"
	."\n WHERE (".$where.")"
	."\n AND a.published = '1' AND s.published = '1'"
	."\n AND ((a.language IS NULL) OR (a.language LIKE '%".$lang."%'))"
	."\n ORDER BY ".$order;
	$database->setQuery($sql, '#__', $limit, 0);
	return $database->loadObjectList();
}

?>