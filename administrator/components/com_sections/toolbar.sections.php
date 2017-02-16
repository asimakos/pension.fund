<?php 
/**
* @ Version: $Id: toolbar.sections.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Component Sections
* @ Author: Elxis Team
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


require_once( $mainframe->getPath( 'toolbar_html' ) );

switch ( $task ){
	case 'new':
	case 'edit':
	case 'editA':
		TOOLBAR_sections::_EDIT();
		break;

	case 'copyselect':
		TOOLBAR_sections::_COPY();
		break;

	default:
		TOOLBAR_sections::_DEFAULT();
		break;
}
?>