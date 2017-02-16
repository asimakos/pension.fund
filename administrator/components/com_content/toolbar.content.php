<?php 
/**
* @ Version: $Id: toolbar.content.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Component Content
* @ Author: Ioannis Sannos
* @ URL: http://www.elxis.org
* @ E-mail: datahell@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


require_once( $mainframe->getPath( 'toolbar_html' ) );

switch ($task) {
	case 'new':
	case 'new_content_typed':
	case 'new_content_section':
	case 'edit':
	case 'editA':
	case 'edit_content_typed':
		TOOLBAR_content::_EDIT(0);
	break;
	case 'editsub':
	   TOOLBAR_content::_EDIT(1);
	break;
	case 'showarchive':
		TOOLBAR_content::_ARCHIVE();
		break;
	case 'movesect':
		TOOLBAR_content::_MOVE();
		break;
	case 'copy':
		TOOLBAR_content::_COPY();
		break;
	case 'translate':
		TOOLBAR_content::_TRANSLATE();
		break;
	case 'dotranslate':
		break;
	case 'tree':
		TOOLBAR_content::_TREE();
		break;
	case 'subcontent':
		TOOLBAR_content::_SUBMITTED();
		break;
	default:
		TOOLBAR_content::_DEFAULT();
		break;
}
?>