<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: TinyMCE/Auth
* @author: Ioannis Sannos ( datahell@elxis.org )
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Authentication check for TinyMCE editor
*/


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

if (!isset($elxis_root)) {
    $elxis_root = str_replace( '/mambots/editors/tinymce/jscripts/tiny_mce', '', str_replace( DIRECTORY_SEPARATOR, '/', dirname(__FILE__) ) );
}

@require_once( $elxis_root . '/configuration.php' );

if (!defined( '_MOS_ELXIS_INCLUDED' )) {
	require( $elxis_root . '/includes/Core/loader.php' );
}

$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix, $mosConfig_dbtype );

$sessionCookieName = md5( $mosConfig_live_site );
session_name( $sessionCookieName );
session_start();
	
$loggedBack = true;

for ($q=1; $q<7; $q++) {
    switch($q) {
        case 1:
        if (count($_SESSION) == 0) {
            $loggedBack = false;
            break 2;
        }
        break 1;
        case 2:
        if (!isset($_SESSION['session_id']) || strlen($_SESSION['session_id']) < 32) {
            $loggedBack = false;
            break 2;
        }
        break 1;
        case 3:
        if (!isset($_SESSION['session_user_id']) || $_SESSION['session_user_id'] == 0) {
            $loggedBack = false;
            break 2;
        }
        break 1;
        case 4:
        if (!isset($_SESSION['session_username']) || $_SESSION['session_username'] == '') {
            $loggedBack = false;
            break 2;
        }
        break 1;
        case 5:
        if (!isset($_SESSION['session_usertype']) || strlen($_SESSION['session_usertype']) == 0) {
            $loggedBack = false;
            break 2;
        }
        break 1;
        case 6:
        if (!isset($_SESSION['session_allowed']) || !preg_match('/30/', $_SESSION['session_allowed']) || !preg_match('/18/', $_SESSION['session_allowed'])) {
            $loggedBack = false;
            break 2;
        }
        break 1;
        default:
        break;
    }
}

if ($loggedBack) {
	if (!isset( $my )) {
		$my = new mosUser( $database );
	}
	$my->id = mosGetParam( $_SESSION, 'session_user_id', '' );
	$my->username = mosGetParam( $_SESSION, 'session_username', '' );
	$my->usertype = mosGetParam( $_SESSION, 'session_usertype', '' );
	$my->gid = mosGetParam( $_SESSION, 'session_gid', '' );
    $my->allowed = mosGetParam( $_SESSION, 'session_allowed', '' );
	$session_id = mosGetParam( $_SESSION, 'session_id', '' );
	$logintime = mosGetParam( $_SESSION, 'session_logintime', '' );
} else {
    @session_destroy();
	$sessionCookieName = md5( 'site'.$mosConfig_live_site );
	$sessioncookie = mosGetParam( $_COOKIE, $sessionCookieName, null );
	$session_id = md5($sessioncookie . $_SERVER['REMOTE_ADDR']);
}

$acl = new gacl_api();

if ( !$my ) { //frontend
	$mainframe = new mosMainFrame( $database, 'content', $elxis_root );
	$mainframe->initSession();
	$my = $mainframe->getUser();
	$my->allowed = implode(',', $mainframe->allowedGroups($my->gid));
}

if ( trim($my->usertype) == '' ) {
	$usertype = eUTF::utf8_strtolower($acl->get_group_name('29'));
} else {
	$usertype = eUTF::utf8_strtolower($my->usertype);
}

if (!($acl->acl_check( 'action', 'add', 'users', $usertype, 'content', 'all' ) || 
	$acl->acl_check( 'action', 'edit', 'users', $usertype, 'content', 'all' ) || 
	$acl->acl_check( 'action', 'edit', 'users', $usertype, 'content', 'own' ))) {
		die('You are not allowed to access this resource');
}

?>