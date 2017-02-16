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
* @description: Extends search to content sections
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onSearch', 'botSearchSections' );

/**
* The sql must return the following fields that are used in a common display
* routine: href, title, section, created, text, browsernav
* @param string Target search string
* @param string mathcing option, exact|any|all
* @param string ordering option, newest|oldest|popular|alpha|category
*/
function botSearchSections( $text, $phrase='', $ordering='' ) {
    global $database, $my, $lang, $_MAMBOTS;

	//check if param query has previously been processed
	if ( !isset($_MAMBOTS->_search_bot_params['sections']) ) {
		//load bot params info
		$query = "SELECT params FROM #__mambots WHERE element = 'sections.searchbot' AND folder = 'search'";
		$database->setQuery( $query, '#__', 1, 0 );
		$database->loadObject($mambot);		

		$_MAMBOTS->_search_bot_params['sections'] = $mambot;
	}

	$mambot = $_MAMBOTS->_search_bot_params['sections'];	

	$params = new mosParameters( $mambot->params );
	$limit = $params->def( 'search_limit', 30 );

    $text = eUTF::utf8_trim( $text );
	if ($text == '') { return array(); }

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

	$query = "SELECT a.name AS title, a.description AS text, '' AS created, '2' AS browsernav,"
	. "\n a.id AS secid, m.id AS menuid, m.type AS menutype,"
	. "\n ".$database->_resource->Concat('a.seotitle', "'/'")." AS seolink"
	. "\n FROM #__sections a"
	. "\n LEFT JOIN #__menu m ON m.componentid = a.id"
	. "\n WHERE ( a.name LIKE '%$text%'"
	. "\n OR a.title LIKE '%$text%'"
	. "\n OR a.description LIKE '%$text%' )"
	. "\n AND a.published = '1'"
	. "\n AND a.access IN (".$my->allowed.")"
	. "\n AND ((a.language IS NULL) OR (a.language LIKE '%$lang%'))"
	. "\n AND ( m.type = 'content_section' OR m.type = 'content_blog_section' )"
	. "\n ORDER BY $order";
	$database->setQuery( $query, '#__', $limit, 0 );
	$rows = $database->loadObjectList();

	$count = count( $rows );
	for ( $i = 0; $i < $count; $i++ ) {
		if ( $rows[$i]->menutype == 'content_section' ) {
			$rows[$i]->href 	= 'index.php?option=com_content&task=section&id='.$rows[$i]->secid.'&Itemid='.$rows[$i]->menuid;
			$rows[$i]->section 	= _E_SECTION_LIST;
		}
		if ( $rows[$i]->menutype == 'content_blog_section' ) {
			$rows[$i]->href 	= 'index.php?option=com_content&task=blogsection&id='.$rows[$i]->secid.'&Itemid='.$rows[$i]->menuid;
			$rows[$i]->section 	= _E_SECTION_BLOG;
		}
		$rows[$i]->hits = 1;
	}
	return $rows;
}

?>