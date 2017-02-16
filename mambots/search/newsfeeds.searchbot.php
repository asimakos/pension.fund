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
* @description: Extends search to newsfeeds items
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onSearch', 'botSearchNewsfeedslinks' );

/**
* The sql must return the following fields that are used in a common display
* routine: href, title, section, created, text, browsernav
* @param string Target search string
* @param string mathcing option, exact|any|all
* @param string ordering option, newest|oldest|popular|alpha|category
*/
function botSearchNewsfeedslinks( $text, $phrase='', $ordering='' ) {
	global $database, $my, $lang, $_MAMBOTS;

	//check if param query has previously been processed
	if ( !isset($_MAMBOTS->_search_bot_params['newsfeeds']) ) {
		//load bot params info
		$query = "SELECT params FROM #__mambots WHERE element = 'newsfeeds.searchbot' AND folder = 'search'";
		$database->setQuery( $query, '#__', 1, 0 );
		$database->loadObject($mambot);		

		$_MAMBOTS->_search_bot_params['newsfeeds'] = $mambot;
	}

	$mambot = $_MAMBOTS->_search_bot_params['newsfeeds'];	

	$params = new mosParameters( $mambot->params );
	$limit = $params->def( 'search_limit', 30 );

	$text = eUTF::utf8_trim( $text );
	if ($text == '') { return array(); }

	$wheres = array();
	switch ($phrase) {
		case 'exact':
			$wheres2 = array();
			$wheres2[] = "LOWER(a.name) LIKE '%$text%'";
			$wheres2[] = "LOWER(a.link) LIKE '%$text%'";
			$where = '(' . implode( ') OR (', $wheres2 ) . ')';
			break;
		case 'all':
		case 'any':
		default:
			$words = explode( ' ', $text );
			$wheres = array();
			foreach ($words as $word) {
				$wheres2 = array();
		  	    $wheres2[] = "LOWER(a.name) LIKE '%$word%'";
			    $wheres2[] = "LOWER(a.link) LIKE '%$word%'";
				$wheres[] = implode( ' OR ', $wheres2 );
			}
			$where = '(' . implode( ($phrase == 'all' ? ') AND (' : ') OR ('), $wheres ) . ')';
			break;
	}

	switch ( $ordering ) {
		case 'alpha':
			$order = 'a.name ASC';
		break;
		case 'category':
			$order = 'b.title ASC, a.name ASC';
		break;
		case 'oldest':
		case 'popular':
		case 'newest':
		default:
			$order = 'a.name ASC';
		break;
	}

	$query = "SELECT a.name AS title, a.link AS text, '' AS created,"
	. "\n ".$database->_resource->Concat("'"._E_NEWS."'", "'/'", 'b.title')." AS section,"
	. "\n '1' AS browsernav,"
	. "\n ".$database->_resource->Concat("'index.php?option=com_newsfeeds&task=view&feedid='",'a.id')." AS href,"
	. "\n ".$database->_resource->Concat("'feeds/'", 'b.seotitle', "'/'", 'a.seotitle', "'.html'")." AS seolink, '1' AS hits"
	. "\n FROM #__newsfeeds a"
	. "\n INNER JOIN #__categories b ON b.id = a.catid"
	. "\n WHERE ( $where )"
	. "\n AND a.published = '1'"
	. "\n AND b.published = '1'"
	. "\n AND b.access IN (".$my->allowed.")"
	. "\n AND ((b.language IS NULL) OR (b.language LIKE '%$lang%'))"
	. "\n ORDER BY $order";
	$database->setQuery( $query, '#__', $limit, 0 );
	$rows = $database->loadObjectList();

	return $rows;
}

?>