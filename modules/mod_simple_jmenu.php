<?php
/**
* @version 1.0 $
* @package SimpleJMenu
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
	* Utility function for writing a menu link
	*/

function generateLink($mitem)
{
	// Get access to the globals
	global $mosConfig_live_site;
	// Initialize the link value
	$link = $mitem->link;

    switch ($mitem->type) {
		case 'component':
			$link = '{$mosConfig_live_site}/{$link}';
			break;


    	default:
			$link = sefRelToAbs($link);
	}
	// Return the generated link
	return $link;
}



// Generate the query to retrieve the menu

global $database, $my, $cur_template, $Itemid, $lang;

$query = "SELECT * FROM #__menu "
	. "\n WHERE menutype = '". $params->get( 'menu' ) ."' "
    . "\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
    . "\n AND access IN( " . $my->allowed . " ) "
	. "\n AND published = '1' "
	. "\n AND parent = 0 "
	. "\n ORDER BY '". $params->get( 'order' ) ."' ASC ";

// Execute the query
$database->setQuery( $query );

// Retrieve the object list
$parent_items = $database->loadObjectList( );

// Generate the query to retrieve the submenu

$query = "SELECT * FROM #__menu "
	. "\n WHERE menutype = '". $params->get( 'menu' ) ."' "
    . "\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
    . "\n AND access IN( " . $my->allowed . " ) "
	. "\n AND published = '1' "
	. "\n AND parent <> 0 "
	. "\n ORDER BY '". $params->get( 'order' ) ."' ASC ";

// Execute the query
$database->setQuery( $query );

// Retrieve the object list
$child_items = $database->loadObjectList( );

// load the patTemplate library
require_once( $mosConfig_absolute_path . '/includes/patTemplate/patTemplate.php' );

// create the template
$tmpl =& patFactory::createTemplate( '', false, false );

// set the path to look for html files
$tmpl->setRoot( dirname( __FILE__ ) . '/simple_jmenu' );

$tmpl->readTemplatesFromInput( 'default.html' );
// Insert the path info
$tmpl->addVar('simple_jmenu', 'MODULE_PATH', "{$mosConfig_live_site}/modules/simple_jmenu");
// Populate the main level
for ($i=0;$i<sizeof($parent_items);$i++) {
	// Retrieve the menu item
	$parent_item = $parent_items[$i];
	// Clear the subitem template
	$tmpl->clearTemplate('menu_subsection');
	// Initialize the sub item flag
	$bSubItemIncluded = false;
	// Initialize the sub item selected flag
	$bSubItemSelected = false;
	// Loop through and populate subitems
	foreach ($child_items as $child_item) {
		// Check to see if this is a sub item of this parent
		if ($child_item->parent == $parent_item->id) {
			// Insert the name variable
			$tmpl->addVar('menu_subsection', 'MENU_ITEM_NAME', $child_item->name);
			// Insert the name variable
			$tmpl->addVar('menu_subsection', 'MENU_ITEM_LINK', generateLink($child_item));
			// We have at least one sub item
			$bSubItemIncluded = true;

			// Check if this sub item is selected
			if (stristr($_SERVER['REQUEST_URI'], $child_item->link)) {
				// Item is active
				$bSubItemSelected = true;
			}
			// Add this subsection
			$tmpl->parseTemplate('menu_subsection', 'a');
		}
	}
	// Determine the class of menu item
	if ($bSubItemIncluded) {
		// Determine is we should expand this menu
		if (stristr($_SERVER['REQUEST_URI'], $parent_item->link) || $bSubItemSelected) {
			// Active menu
			$tmpl->addVar('menu_section', 'SECTION_CLASS', 'expanded');
			// Show the sub menu
			$tmpl->addVar('menu_section', 'SUBSECTION_DISPLAY', 'block');
		} else {
			// Contracted menu
			$tmpl->addVar('menu_section', 'SECTION_CLASS', 'contracted');
			// Hide the sub menu
			$tmpl->addVar('menu_section', 'SUBSECTION_DISPLAY', 'none');
		}
	} else {
		$tmpl->addVar('menu_section', 'SECTION_CLASS', 'nosub');
	}
	// Insert the id
	$tmpl->addVar('menu_section', 'MENU_ITEM_ID', $parent_item->id);
	// Insert the name variable
	$tmpl->addVar('menu_section', 'MENU_ITEM_NAME', $parent_item->name);
	// Insert the name variable
	$tmpl->addVar('menu_section', 'MENU_ITEM_LINK', generateLink($parent_item));
	// Determine if this is the last menu section
	if ($i == (sizeof($parent_items) - 1)) {
		// Set this to the bottom style (removes the underline)
		$tmpl->addVar('menu_section', '_BOTTOM', '_bottom');
	}
	// Add this subsection
	$tmpl->parseTemplate('menu_section', 'a');
}

$tmpl->displayParsedTemplate( 'simple_jmenu' );


?>