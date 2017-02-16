<?php 
/**
* @ Version: $Id: toolbar.menumanager.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Component Menu Manager
* @ Author: Ioannis Sannos
* @ Author-URL: http://www.elxis.org
* @ Author-Email: datahell@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


require_once( $mainframe->getPath( 'toolbar_html' ) );

$act = mosGetParam( $_REQUEST, 'act', '' );
if ($act) {
	$task = $act;
}

switch ($task) {
	case "new":
	case "edit":
		TOOLBAR_menumanager::_NEWMENU();
		break;

	case "copyconfirm":
		TOOLBAR_menumanager::_COPYMENU();
		break;

	case "deleteconfirm":
		TOOLBAR_menumanager::_DELETE();
		break;

	default:
		TOOLBAR_menumanager::_DEFAULT();
		break;
}
?>