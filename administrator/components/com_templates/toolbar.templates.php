<?php 
/**
* @version: $Id: toolbar.templates.php 2596 2010-03-24 20:19:28Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Templates
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


require_once( $mainframe->getPath( 'toolbar_html' ) );
$client = mosGetParam( $_REQUEST, 'client', '' );

switch ($task) {
	case "view":
		TOOLBAR_templates::_VIEW();
	break;
	case "edit_source":
		TOOLBAR_templates::_EDIT_SOURCE();
	break;
	case "edit_css":
		TOOLBAR_templates::_EDIT_CSS();
	break;
	case 'edit_params':
	case 'edit_paramsa':
		TOOLBAR_templates::_EDIT_PARAMS();
	break;
	case "assign":
		TOOLBAR_templates::_ASSIGN();
	break;
	case "positions":
		TOOLBAR_templates::_POSITIONS();
	break;
	default:
		TOOLBAR_templates::_DEFAULT($client);
	break;
}

?>