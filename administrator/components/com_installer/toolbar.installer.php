<?php 
/**
* @version: $Id: toolbar.installer.php 60 2010-06-13 09:46:43Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info [AT] elxis [DOT] org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


require_once($mainframe->getPath('toolbar_html'));

switch ($task) {
	case 'new': TOOLBAR_installer::_NEW(); break;
	case 'updates': TOOLBAR_installer::_UPDATES(); break;
	default:
	    $element = mosGetParam( $_REQUEST, 'element', '' );
	    if ($element == 'component' || $element == 'module' || $element == 'mambot') {
			TOOLBAR_installer::_DEFAULT2();
		} elseif ($element == 'bridge') {
			TOOLBAR_installer::_DEFAULT3();
		} else {
			TOOLBAR_installer::_DEFAULT();
		}
	break;
}

?>