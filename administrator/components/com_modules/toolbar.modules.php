<?php 
/**
* @ Version: $Id: toolbar.modules.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Component Modules
* @ Author: Ioannis Sannos
* @ Author-URL: http://www.elxis.org
* @ Author-Email: datahell@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


require_once( $mainframe->getPath( 'toolbar_html' ) );
switch ($task) {
	case 'editA':
	case 'edit':
		$cid = mosGetParam( $_POST, 'cid', 0 );
		if ( !is_array( $cid ) ){
			$mid = mosGetParam( $_POST, 'id', 0 );
		} else {
			$mid = $cid[0];
		}
		$published = 0;
		if ( $mid ) {
			$query = "SELECT published FROM #__modules WHERE id='$mid'";
			$database->setQuery( $query );
			$published = $database->loadResult();
		}
		$database->setQuery( "SELECT template FROM #__templates_menu WHERE client_id='0' AND menuid='0'", '#__', 1, 0);
		$cur_templateFront = $database->loadResult();
		TOOLBAR_modules::_EDIT( $cur_templateFront, $published );
	break;
	case 'new':
		TOOLBAR_modules::_NEW();
	break;
	default:
		TOOLBAR_modules::_DEFAULT();
	break;
}
?>