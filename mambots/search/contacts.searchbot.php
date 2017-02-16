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
* @description: Extends search to contacts items
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onSearch', 'botSearchContacts' );

/**
* The sql must return the following fields that are used in a common display
* routine: href, title, section, created, text, browsernav
* @param string Target search string
* @param string mathcing option, exact|any|all
* @param string ordering option, newest|oldest|popular|alpha|category
*/
function botSearchContacts( $text, $phrase='', $ordering='' ) {
	global $database, $my;

     $text = eUTF::utf8_trim( $text );
     if ($text == '') { return array(); }

	$section = _CONTACT_TITLE;

	switch ( $ordering ) {
		case 'alpha':
			$order = 'a.name ASC';
		break;
		case 'category':
			$order = 'b.title ASC, a.name ASC';
		break;
		case 'popular':
		case 'newest':
		case 'oldest':
		default:
			$order = 'a.name DESC';
		break;
	}

	$database->setQuery("SELECT id FROM #__menu WHERE link LIKE 'index.php?option=com_contact%' ORDER BY LENGTH(link)");
	$citemid = intval($database->loadResult());

	$query = "SELECT a.name AS title,"
    . "\n ".$database->_resource->Concat('a.name', "', '", 'a.con_position', 'a.misc')." AS text,"
	. "\n '' AS created,"
    . "\n ".$database->_resource->Concat("'".$section."'", "' / '", 'b.title')." AS section,"
	. "\n '2' AS browsernav,"
    . "\n ".$database->_resource->Concat("'index.php?option=com_contact&task=view&Itemid=$citemid&contact_id='", 'a.id')." AS href,"
	. "\n ".$database->_resource->Concat("'contact/'", 'b.seotitle', "'/'", 'a.seotitle', "'.html'")." AS seolink, '1' AS hits"
	. "\n FROM #__contact_details a"
	. "\n INNER JOIN #__categories b ON b.id = a.catid AND b.access IN (".$my->allowed.")"
	. "\n WHERE ( a.name LIKE '%$text%'"
	. "\n OR a.misc LIKE '%$text%'"
	. "\n OR a.con_position LIKE '%$text%'"
	. "\n OR a.address LIKE '%$text%'"
	. "\n OR a.suburb LIKE '%$text%'"
	. "\n OR a.state LIKE '%$text%'"
	. "\n OR a.country LIKE '%$text%'"
	. "\n OR a.postcode LIKE '%$text%'"
	. "\n OR a.telephone LIKE '%$text%'"
	. "\n OR a.fax LIKE '%$text%' )"
	. "\n AND a.published = '1' AND a.access IN (".$my->allowed.")"
	. "\n AND b.published = '1' AND b.access IN (".$my->allowed.")"
	. "\n ORDER BY $order";
	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	return $rows;
}

?>