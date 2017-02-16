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
* @description: Extends search to content categories
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onSearch', 'botSearchCategories' );

/**
* The sql must return the following fields that are used in a common display
* routine: href, title, section, created, text, browsernav
* @param string Target search string
* @param string mathcing option, exact|any|all
* @param string ordering option, newest|oldest|popular|alpha|category
*/
function botSearchCategories( $text, $phrase='', $ordering='' ) {
	global $database, $my, $lang, $_MAMBOTS;

	//check if param query has previously been processed
	if ( !isset($_MAMBOTS->_search_bot_params['categories']) ) {
		//load bot params info
		$query = "SELECT params FROM #__mambots WHERE element = 'categories.searchbot' AND folder = 'search'";
		$database->setQuery( $query, '#__', 1, 0 );
		$database->loadObject($mambot);

		$_MAMBOTS->_search_bot_params['categories'] = $mambot;
	}

	$mambot = $_MAMBOTS->_search_bot_params['categories'];	

	$params = new mosParameters( $mambot->params );
	$limit = $params->def( 'search_limit', 30 );

	$text = eUTF::utf8_trim( $text );
	if ( $text == '' ) { return array(); }

	switch ( $ordering ) {
		case 'alpha':
			$order = 'a.name ASC';
		break;
		case 'category':
		case 'popular':
		case 'newest':
		case 'oldest':
		default:
			$order = 'a.name DESC';
		break;
	}

	$idjoin = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 's.id::VARCHAR' : 's.id';

	$query = "SELECT a.name AS title, a.description AS text, '' AS created, '2' AS browsernav,"
	. "\n s.id AS secid, a.id AS catid, m.id AS menuid, m.type AS menutype,"
	. "\n ".$database->_resource->Concat('s.seotitle', "'/'", 'a.seotitle', "'/'")." AS seolink"
	. "\n FROM #__categories a"
	. "\n INNER JOIN #__sections s ON ".$idjoin." = a.section"
	. "\n LEFT JOIN #__menu m ON m.componentid = a.id"
	. "\n WHERE ( a.name LIKE '%$text%'"
	. "\n OR a.title LIKE '%$text%'"
	. "\n OR a.description LIKE '%$text%' )"
	. "\n AND a.published = '1'"
	. "\n AND s.published = '1'"
	. "\n AND a.access IN (".$my->allowed.")"
	. "\n AND s.access IN (".$my->allowed.")"
	. "\n AND ( m.type = 'content_section' OR m.type = 'content_blog_section'"
	. "\n OR m.type = 'content_category' OR m.type = 'content_blog_category')"
	. "\n AND ((a.language IS NULL) OR (a.language LIKE '%$lang%'))"
	. "\n AND ((s.language IS NULL) OR (s.language LIKE '%$lang%'))"
	. "\n ORDER BY $order";
	$database->setQuery( $query, '#__', $limit, 0 );
	$rows = $database->loadObjectList();

	$count = count($rows);
	for ($i = 0; $i < $count; $i++) {
		if ( $rows[$i]->menutype == 'content_category' ) {
			$rows[$i]->href = 'index.php?option=com_content&task=category&sectionid='.$rows[$i]->secid.'&id='.$rows[$i]->catid.'&Itemid='.$rows[$i]->menuid;
			$rows[$i]->section 	= _E_CATEGORY_LIST;
		}
		if ( $rows[$i]->menutype == 'content_blog_category' ) {
			$rows[$i]->href = 'index.php?option=com_content&task=blogcategory&id='.$rows[$i]->catid.'&Itemid='.$rows[$i]->menuid;
			$rows[$i]->section 	= _E_CATEGORY_BLOG;
		}
		$rows[$i]->hits = 1;
	}

	return $rows;
}

?>