<?php 
/**
* @ Version: $Id: security.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Security
* @ Author: Ioannis Sannos
* @ E-mail: datahell@elxis.org
* @ URL: http://www.elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

//fix to address the globals overwrite problem in php versions < 4.4.1
$protect_globals = array('_REQUEST', '_GET', '_POST', '_COOKIE', '_FILES', '_SERVER', '_ENV', 'GLOBALS', '_SESSION');
foreach ($protect_globals as $global) {
    if ( in_array($global , array_keys($_REQUEST)) ||
         in_array($global , array_keys($_GET))     ||
         in_array($global , array_keys($_POST))    ||
         in_array($global , array_keys($_COOKIE))  ||
         in_array($global , array_keys($_FILES))) {
        die("Invalid Request.");
    }
}

if (in_array( 'globals', array_keys( array_change_key_case( $_REQUEST, CASE_LOWER ) ) ) ) {
	die( 'Global variable hack attempted.' );
}
if (in_array( '_post', array_keys( array_change_key_case( $_REQUEST, CASE_LOWER ) ) ) ) {
	die( 'Post variable hack attempted.' );
}

/* CRLF INJECTION/HTTP RESPONSE SPLIT */
$pat='((\%0d)|(\%0a)|(\\\r)|(\\\n))';
if (isset($_SERVER['QUERY_STRING'])) {
    if (preg_match("/$pat/", $_SERVER['QUERY_STRING'])) {
    	die( 'Possible CRLF injection/HTTP response split.' );
    }
}
if (isset($_COOKIE)) {
    if (preg_match("/$pat/", serialize($_COOKIE))) {
    	die( 'Possible CRLF injection/HTTP response split.' );
    }
}
unset($pat);

/* FLOOD PROTECTION */
$elxis_root1 = str_replace( '/includes/Core', '', str_replace( DIRECTORY_SEPARATOR, '/', dirname(__FILE__) ) );
require_once( $elxis_root1."/includes/floodblocker.class.php");
$fldblock = new FloodBlocker();
if ((!$fldblock->init_error) && ($fldblock->floodblock_enabled)) {
    if (!$fldblock->CheckFlood()) {
        die ( 'ELXIS FLOOD PROTECTION. Too many requests! Please try again later.' );
    }
}

/* ELXIS DEFENDER */
require_once( $elxis_root1."/administrator/tools/defender/defender.class.php");
$defender = new ElxisDefender();
if ((!$defender->init_error) && ($defender->enabled)) {
    if (!$defender->valid) {
        die ( 'ELXIS DEFENDER. Security settings blocked your request.' );
    }
}

unset($elxis_root1);

?>