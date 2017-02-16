<?php 
/** 
* @version: $Id: router.php 39 2010-06-07 18:36:03Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: System Templates
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info [at] elxis [dot] org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


if (!defined('_ELXIS_SYSALERT')) { define('_ELXIS_SYSALERT', 3); }

if(!headers_sent()) {
    header('Content-type: text/html; charset=utf-8');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');
}

/*
_ELXIS_SYSALERT
1: offline
2: offline login
3: error
4: database error
5: error 404
*/

global $mosConfig_absolute_path;

require_once($mosConfig_absolute_path.'/includes/systemplates/common.php');

systpl_loadlanguage();
$system_template = systpl_template();
systpl_htmlstart();
include($mosConfig_absolute_path.'/includes/systemplates/templates/'.$system_template.'.php');
systpl_htmlend();

exit();

?>