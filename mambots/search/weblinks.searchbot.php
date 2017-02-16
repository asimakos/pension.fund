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
* @description: Extends search to weblinks items
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onSearch', 'botSearchWeblinks' );

/**
* The sql must return the following fields that are used in a common display
* routine: href, title, section, created, text, browsernav
* @param string Target search string
* @param string mathcing option, exact|any|all
* @param string ordering option, newest|oldest|popular|alpha|category
*/
function botSearchWeblinks( $text, $phrase='', $ordering='' ) {
	global $database, $my, $lang, $_MAMBOTS;

	//check if param query has previously been processed
	if ( !isset($_MAMBOTS->_search_bot_params['weblinks']) ) {
		//load bot params info
		$query = "SELECT params FROM #__mambots WHERE element = 'weblinks.searchbot' AND folder = 'search'";
		$database->setQuery( $query, '#__', 1, 0);
		$database->loadObject($mambot);	

		$_MAMBOTS->_search_bot_params['weblinks'] = $mambot;
	}

	$mambot = $_MAMBOTS->_search_bot_params['weblinks'];	

	$params = new mosParameters( $mambot->params );
	$limit = $params->def( 'search_limit', 30 );

	$text = eUTF::utf8_trim( $text );
	if ($text == '') { return array(); }
	$section = _WEBLINKS_TITLE;

	$wheres = array();
	switch ($phrase) {
		case 'exact':
			$wheres2 = array();
			
			$wheres2[] = "LOWER(a.url) LIKE '%$text%'";
			$wheres2[] = "LOWER(a.description) LIKE '%$text%'";
			$wheres2[] = "LOWER(a.title) LIKE '%$text%'";			
			$where = '(' . implode( ') OR (', $wheres2 ) . ')';
		break;
		case 'all':
		case 'any':
		default:
			$words 	= explode( ' ', $text );
			$wheres = array();
			foreach ($words as $word) {
				$wheres2 = array();
		  	    $wheres2[] 	= "LOWER(a.url) LIKE '%$word%'";
			    $wheres2[] 	= "LOWER(a.description) LIKE '%$word%'";
			    $wheres2[] 	= "LOWER(a.title) LIKE '%$word%'";			    
				$wheres[] 	= implode( ' OR ', $wheres2 );
			}
			$where 	= '(' . implode( ($phrase == 'all' ? ') AND (' : ') OR ('), $wheres ) . ')';
		break;
	}	

	switch ( $ordering ) {
		case 'oldest':
			$order = 'a.date ASC';
		break;
		case 'popular':
			$order = 'a.hits DESC';
		break;
		case 'alpha':
			$order = 'a.title ASC';
		break;
		case 'category':
			$order = 'b.title ASC, a.title ASC';
		break;
		case 'newest':
		default:
			$order = 'a.date DESC';
		break;
	}

	$query = "SELECT a.title AS title, a.description AS text, a.date AS created,"
	. "\n ".$database->_resource->Concat("'".$section."'", "' / '", 'b.title')." AS section,"
	. "\n '1' AS browsernav, a.url AS href, '' AS seolink, a.hits"
	. "\n FROM #__weblinks a"
	. "\n INNER JOIN #__categories b ON b.id = a.catid"
	. "\n WHERE ($where)"
	. "\n AND a.published = '1'"
	. "\n AND b.published = '1'"
	. "\n AND b.access IN (".$my->allowed.")"
	. "\n AND ((a.language IS NULL) OR (a.language LIKE '%$lang%'))"
	. "\n ORDER BY $order";
	$database->setQuery( $query, '#__', $limit, 0 );
	$rows = $database->loadObjectList();

	return $rows;
}

?>