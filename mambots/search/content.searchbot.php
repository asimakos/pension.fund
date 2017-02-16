<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Bots/Search
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Extends search to content items
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onSearch', 'botSearchContent' );

/**
* The sql must return the following fields that are used in a common display
* routine: href, title, section, created, text, browsernav
* @param string Target search string
* @param string mathcing option, exact|any|all
* @param string ordering option, newest|oldest|popular|alpha|category
*/
function botSearchContent( $text, $phrase='', $ordering='' ) {
	global $my, $database, $mosConfig_absolute_path, $mosConfig_offset, $lang, $_MAMBOTS;

	//check if param query has previously been processed
	if ( !isset($_MAMBOTS->_search_bot_params['content']) ) {
		//load mambot params info
		$query = "SELECT params FROM #__mambots WHERE element = 'content.searchbot' AND folder = 'search'";
		$database->setQuery( $query, '#__', 1, 0 );
		$database->loadObject($mambot);

		$_MAMBOTS->_search_bot_params['content'] = $mambot;
	}

	$mambot = $_MAMBOTS->_search_bot_params['content'];	

	$params = new mosParameters( $mambot->params );
	$limit = $params->def( 'search_limit', 30 );

	$_SESSION['searchword'] = $text;
	$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*3600 );

	$text = eUTF::utf8_trim( $text );
	if ($text == '') { return array(); }

	$wheres = array();
	switch ($phrase) {
		case 'exact':
			$wheres2 = array();
			$wheres2[] = "LOWER(a.title) LIKE '%$text%'";
			$wheres2[] = "LOWER(a.introtext) LIKE '%$text%'";
			$wheres2[] = "LOWER(a.maintext) LIKE '%$text%'";
			$wheres2[] = "LOWER(a.metakey) LIKE '%$text%'";
			$wheres2[] = "LOWER(a.metadesc) LIKE '%$text%'";
			$where = '(' . implode( ') OR (', $wheres2 ) . ')';
			break;
		case 'all':
		case 'any':
		default:
			$words = explode( ' ', $text );
			$wheres = array();
			foreach ($words as $word) {
				$wheres2 = array();
				$wheres2[] = "LOWER(a.title) LIKE '%$word%'";
				$wheres2[] = "LOWER(a.introtext) LIKE '%$word%'";
				$wheres2[] = "LOWER(a.maintext) LIKE '%$word%'";
				$wheres2[] = "LOWER(a.metakey) LIKE '%$word%'";
				$wheres2[] = "LOWER(a.metadesc) LIKE '%$word%'";
				$wheres[] = implode( ' OR ', $wheres2 );
			}
			$where = '(' . implode( ($phrase == 'all' ? ') AND (' : ') OR ('), $wheres ) . ')';
			break;
	}

	$morder = '';
	switch ($ordering) {
		case 'oldest':
			$order = 'a.created ASC';
		break;
		case 'popular':
			$order = 'a.hits DESC';
		break;
		case 'alpha':
			$order = 'a.title ASC';
		break;
		case 'category':
			$order = 'b.title ASC, a.title ASC';
			$morder = 'a.title ASC';
		break;
		case 'newest':
		default:
			$order = 'a.created DESC';
		break;
	}

    //search content items
	$sql = "SELECT a.title AS title,"
	. "\n a.created AS created,"
	//. "\n ".$database->_resource->Concat('a.introtext','a.maintext')." AS text," //maintext if null creates problems
	. "\n a.introtext AS text,"
	. "\n ".$database->_resource->Concat('u.title',"'/'",'b.title')." AS section,"
	. "\n ".$database->_resource->Concat("'index.php?option=com_content&task=view&id='",'a.id')." AS href,"
	. "\n ".$database->_resource->Concat('u.seotitle', "'/'", 'b.seotitle', "'/'", 'a.seotitle', "'.html'")." AS seolink, a.hits,"
	. "\n '2' AS browsernav"
	. "\n FROM #__content a"
	. "\n INNER JOIN #__categories b ON b.id=a.catid AND b.access IN (".$my->allowed.")"
	. "\n LEFT JOIN #__sections u ON u.id = a.sectionid"
	. "\n WHERE ( $where )"
	. "\n AND a.state = '1' AND a.access IN (".$my->allowed.")"
	. "\n AND u.published = '1' AND u.access IN (".$my->allowed.")"
	. "\n AND b.published = '1' AND b.access IN (".$my->allowed.")"
	. "\n AND ( a.publish_up = '1979-12-19 00:00:00' OR a.publish_up <= '$now' )"
	. "\n AND ( a.publish_down = '2060-01-01 00:00:00' OR a.publish_down >= '$now' )"
	. "\n AND ((a.language IS NULL) OR (a.language LIKE '%$lang%'))"
	. "\n AND ((b.language IS NULL) OR (b.language LIKE '%$lang%'))"
    . "\n AND ((u.language IS NULL) OR (u.language LIKE '%$lang%'))"
	. "\n ORDER BY $order";
	$database->setQuery( $sql, '#__', $limit, 0 );
	$list = $database->loadObjectList();

	//search typed content
	$database->setQuery( "SELECT a.title AS title, a.created AS created, a.introtext AS text,"
    . "\n ".$database->_resource->Concat("'index.php?option=com_content&task=view&id='",'a.id',"'&Itemid='",'m.id')." AS href, a.hits,"
	. "\n ".$database->_resource->Concat('a.seotitle', "'.html'")." AS seolink,"
	. "\n '2' as browsernav, '"._E_AUTONOMOUSPG."' AS section"
	. "\n FROM #__content a"
	. "\n LEFT JOIN #__menu m ON m.componentid = a.id"
	. "\n WHERE ($where)"
	. "\n AND a.state='1' AND a.access IN (".$my->allowed.") AND m.type='content_typed'"
	. "\n AND ( a.publish_up = '1979-12-19 00:00:00' OR a.publish_up <= '$now' )"
	. "\n AND ( a.publish_down = '2060-01-01 00:00:00' OR a.publish_down >= '$now' )"
    . "\n AND ((a.language IS NULL) OR (a.language LIKE '%$lang%'))"
    . "\n AND ((m.language IS NULL) OR (m.language LIKE '%$lang%'))"
	. "\n ORDER BY ".($morder ? $morder : $order)."", '#__', $limit, 0);
	$list2 = $database->loadObjectList();

	//search archived content
	$database->setQuery( "SELECT a.title AS title, a.created AS created, a.introtext AS text,"
	. "\n ".$database->_resource->Concat( "'"._E_ARCHIVED.": '", 'u.title', "'/'", 'b.title')." AS section,"
	. "\n ".$database->_resource->Concat("'index.php?option=com_content&task=view&id='", 'a.id')." AS href,"
	. "\n ".$database->_resource->Concat('u.seotitle', "'/'", 'b.seotitle', "'/'", 'a.seotitle', "'.html'")." AS seolink, a.hits,"
	. "\n '2' AS browsernav"
	. "\n FROM #__content a"
	. "\n INNER JOIN #__categories b ON b.id=a.catid AND b.access IN (".$my->allowed.")"
	. "\n LEFT JOIN #__sections u ON u.id = a.sectionid"
	. "\n WHERE ( $where )"
	. "\n AND a.state = '-1' AND a.access IN (".$my->allowed.")"
	. "\n AND b.published = '1' AND b.access IN (".$my->allowed.")"
	. "\n AND u.published = '1' AND u.access IN (".$my->allowed.")"
	. "\n AND ( a.publish_up = '1979-12-19 00:00:00' OR a.publish_up <= '$now' )"
	. "\n AND ( a.publish_down = '2060-01-01 00:00:00' OR a.publish_down >= '$now' )"
    . "\n AND ((a.language IS NULL) OR (a.language LIKE '%$lang%'))"
    . "\n AND ((b.language IS NULL) OR (b.language LIKE '%$lang%'))"
    . "\n AND ((u.language IS NULL) OR (u.language LIKE '%$lang%'))"
	. "\n ORDER BY $order", '#__', $limit, 0);
	$list3 = $database->loadObjectList();

	$result = array();
	if ($list) { $result = array_merge($result, $list); }
	if ($list2) { $result = array_merge($result, $list2); }
	if ($list3) { $result = array_merge($result, $list3); }
	return $result;
}

?>