<?php 
/**
* @ Version: $Id: toolbar.access.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Access
* @ Author: Ioannis Sannos
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


require_once( $mainframe->getPath( 'toolbar_html' ) );

switch ( $task ) {
	case 'new':
    case 'edit':
		TOOLBAR_access::_NEW();
		break;
    case 'editperms':
        TOOLBAR_access::_PERMS();
        break;
	default:
		TOOLBAR_access::_DEFAULT();
		break;
}
?>