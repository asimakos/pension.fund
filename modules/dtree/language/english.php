<?php
/*********************************************

*
**** ATTENTION: THIS FILE IS UTF-8 ENCODED! *****
*
*********************************************/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//MODULE XML PARAMS
if (defined('_ELXIS_ADMIN')) {
    define('CX_01a', 'Menutype');  
	define('CX_01', 'List of menus to display (comma separated)Menu');
    define('CX_02', '[Choose from]');
    define('CX_03', 'List of menus (not used, for reference only!)');
    define('CX_04', 'Base');
    define('CX_05', 'What should be used as the base of each menu tree? Options: first, menu, module, site, text');
    define('CX_06', 'first');
    define('CX_07', 'menu');
    define('CX_08', 'module');
    define('CX_09', 'site');
    define('CX_10', 'text');
    define('CX_11', 'Basetext');
    define('CX_12', 'If Base=text, specify the text to use');
    define('CX_13', 'Separator');
    define('CX_14', 'By default a moduleheading is shown (if Show title=yes in the module config), it can be set to other HTML code');
    define('CX_15', 'openAll');
    define('CX_16', 'By default a menu tree is shown with all folders closed, except the one of the selected node. With this parameter all folders are open. Overrides closeSameLevel');
    define('CX_true', 'True');
    define('CX_false', 'False');
    define('CX_17', 'useSelection');
    define('CX_18', 'Nodes can be selected(highlighted).');
    define('CX_19', 'useLines');
    define('CX_20', 'Tree is drawn with lines.');
    define('CX_21', 'useIcons');
    define('CX_22', 'Tree is drawn with icons.');
    define('CX_23', 'useStatusText');
    define('CX_24', 'Displays node names in the statusbar instead of the url.');
    define('CX_25', 'closeSameLevel');
    define('CX_26', 'Only one node within a parent can be expanded at the same time.');

}
?>