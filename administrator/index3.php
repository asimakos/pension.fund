<?php 
/**
* @ Version: $Id: index3.php 1878 2008-01-25 21:26:29Z datahell $
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

require_once( '../includes/Core/security.php' );

if (!file_exists( '../configuration.php' )) {
	header( "Location: ../installation/index.php" );
	exit();
}

require_once( '../configuration.php' );
$mosConfig_gzip = '0'; //gzip makes SEO title suggestion feature to stop working
require_once( '../includes/Core/loader.php' );
require_once( $mosConfig_absolute_path . "/administrator/includes/admin.php" );

$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix, $mosConfig_dbtype );
$database->debug( $mosConfig_debug );
$acl = new gacl_api();

require_once( $mosConfig_absolute_path.'/includes/sef.php' );

// must start the session before we create the mainframe object
session_name( md5( $mosConfig_live_site ) );
session_start();

// mainframe is an API workhorse, lots of 'core' interaction routines
$mainframe = new mosMainFrame( $database, $option, '..', true );

// initialise some common request directives
$task = trim( mosGetParam( $_REQUEST, 'task', '' ) );
$act = trim( strtolower( mosGetParam( $_REQUEST, 'act', '' ) ) );
$section = trim( mosGetParam( $_REQUEST, 'section', '' ) );
$mosmsg = trim( strip_tags( mosGetParam( $_REQUEST, 'mosmsg', '' ) ) );
$no_html = strtolower( trim( mosGetParam( $_REQUEST, 'no_html', '' ) ) );


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
	echo '<script language="javascript" type="text/javascript">document.location.href=\'index.php\'</script>'._LEND;
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

$rtl = (_GEM_RTL == 1) ? ' dir="rtl"' : '';
echo '<?xml version="1.0" encoding="UTF-8"?>'._LEND;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $adminLanguage->A_XML_LANGUAGE; ?>" xml:lang="<?php echo $adminLanguage->A_XML_LANGUAGE; ?>"<?php echo $rtl; ?>>
<head>
<title><?php echo $mosConfig_sitename; ?> - <?php echo $adminLanguage->A_ADMINISTRATION; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="Generator" content="Elxis - (C) Copyright 2006-<?php echo date('Y'); ?> Elxis.org.  All rights reserved." />
<link rel="stylesheet" type="text/css" href="templates/admin/<?php echo $mainframe->getTemplate(); ?>/css/template_css<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.css" />
<link rel="stylesheet" type="text/css" href="templates/admin/<?php echo $mainframe->getTemplate(); ?>/css/theme<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.css" />
<script language="javascript" type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/includes/js/JSCookMenu.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/includes/js/ThemeOffice/theme<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/includes/js/elxis.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/includes/js/prototype.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/includes/js/ajax_new.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/includes/js/logout.js"></script>
</head>
<body>
<?php
if ($mosmsg) {
	if (!get_magic_quotes_gpc()) { $mosmsg = addslashes( $mosmsg ); }
	echo "\n<script language=\"javascript\" type=\"text/javascript\">alert('".$mosmsg."');</script>";
}

//Show list of items to edit or delete or create new
if ($path = $mainframe->getPath( 'admin' )) {
	require $path;
} else {
?>
      <img src="images/logo.png" border="0" alt="Elxis CMS" title="Elxis CMS" />&nbsp; <br />
<?php 
}
?>

</body>
</html>
<?php 
doGzip();
//close FTP connection if we used it
$fmanager->closeFTP();

?>