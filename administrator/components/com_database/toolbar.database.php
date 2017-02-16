<?php
/**
* @ Version: $Id: toolbar.database.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Component Database
* @ Author: Ioannis Sannos
* @ URL: http://www.elxis.org
* @ E-mail: datahell@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


require_once( $mainframe->getPath( 'toolbar_html' ) );

switch ($task){
    
    case 'backup':
		TOOLBAR_database::_BACKUP();
    break;
    case 'monitor':
    case 'browse':
    case 'structure':
		TOOLBAR_database::_OTHER();
	break;
	default:
		TOOLBAR_database::_DEFAULT();
	break;
}
?>