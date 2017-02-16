<?php 
/**
* @ Version: $Id: toolbar.users.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Component User
* @ Author: Elxis Team
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


require_once( $mainframe->getPath( 'toolbar_html' ) );

switch ( $task ) {
	case 'new':
	case 'edit':
	case 'editA':
		TOOLBAR_users::_EDIT();
		break;

    case 'extra':
    case 'cancelExtra':
    case 'saveExtra':
		TOOLBAR_users::_EXTRA();
		break;

	case 'editExtra':
	case 'editExtraA':
		TOOLBAR_users::_EDITEXTRA();
		break;

	default:
		TOOLBAR_users::_DEFAULT();
		break;
}
?>