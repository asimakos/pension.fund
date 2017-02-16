<?php 
/**
* @ Version: $Id: index2.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Administration
* @ Author: Elxis Team
* @ E-mail: info@elxis.org
* @ URL: http://www.elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/


define( '_VALID_MOS', 1 );
define( '_ELXIS_ADMIN', 1 );

$elxis_root = str_replace('/administrator', '', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));
require_once($elxis_root.'/includes/Core/security.php');

if (!file_exists($elxis_root.'/configuration.php' )) {
	header("Location: ../installation/index.php");
	exit();
}

require_once($elxis_root.'/configuration.php');
require_once($elxis_root.'/includes/Core/loader.php');
require_once($mosConfig_absolute_path.'/administrator/includes/admin.php');

$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix, $mosConfig_dbtype );
$database->debug( $mosConfig_debug );
$acl = new gacl_api();

require_once( $mosConfig_absolute_path.'/includes/sef.php' );

//must start the session before we create the mainframe object
session_name( md5( $mosConfig_live_site ) );
session_start();

//mainframe is an API workhorse, lots of 'core' interaction routines
$mainframe = new mosMainFrame( $database, $option, '..', true );

//initialise some common request directives
$task = mosGetParam( $_REQUEST, 'task', '' );
$act = strtolower( mosGetParam( $_REQUEST, 'act', '' ) );
$section = mosGetParam( $_REQUEST, 'section', '' );
$no_html = strtolower( mosGetParam( $_REQUEST, 'no_html', '' ) );

if ($option == 'logout') {
	require 'logout.php';
	exit();
}

//restore some session variables
$my = new mosUser( $database );
$my->id = mosGetParam( $_SESSION, 'session_user_id', '' );
$my->username = mosGetParam( $_SESSION, 'session_username', '' );
$my->usertype = mosGetParam( $_SESSION, 'session_usertype', '' );
$my->gid = mosGetParam( $_SESSION, 'session_gid', '' );
$my->allowed = mosGetParam( $_SESSION, 'session_allowed', '' );
$session_id = mosGetParam( $_SESSION, 'session_id', '' );
$logintime = mosGetParam( $_SESSION, 'session_logintime', '' );

//check against db record of session
if ($session_id == md5( $my->id.$my->username.$my->usertype.$logintime )) {
	$database->setQuery( "SELECT * FROM #__session WHERE session_id='".$session_id."'"
	." AND username = '".$database->getEscaped( $my->username )."'"
	." AND userid = ".intval( $my->id )
	);
	if (!$result = $database->query()) {
		echo $database->stderr();
	}
	if ($database->getNumRows( $result ) <> 1) {
		echo '<script language="javascript" type="text/javascript">document.location.href=\'index.php\'</script>'._LEND;
		exit();
	}
} else {
	echo '<script language="javascript" type="text/javascript">document.location.href=\''.$mosConfig_live_site.'/administrator/index.php\'</script>'._LEND;
	exit();
}

//update session timestamp
$current_time = time() + ($mosConfig_offset * 3600);
$database->setQuery( "UPDATE #__session SET time='".$current_time."' WHERE session_id='".$session_id."'");
$database->query();

//timeout old sessions
$past = $current_time - intval($mosConfig_lifetime);
$database->setQuery( "DELETE FROM #__session WHERE time < '".$past."'" );
$database->query();

//start the html output
if ($no_html) {
	if ($path = $mainframe->getPath( "admin" )) {
		require $path;
	}
	exit();
}

initGzip();
header( 'Content-type: text/html; charset=utf-8' );
header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );

$tplparams = new mosParameters($mainframe->getTplParams());
$path = $mosConfig_absolute_path."/administrator/templates/admin/".$mainframe->getTemplate()."/index.php";
require_once( $path );

doGzip();
//close FTP connection if we used it
$fmanager->closeFTP();
?>