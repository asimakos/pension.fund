<?php 
/** 
* @version: $Id: index2.php 36 2010-06-06 19:03:20Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Elxis
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

require_once('includes/Core/security.php');


define('_VALID_MOS', 1);
session_start();

require_once('configuration.php');
$mosConfig_gzip = '0'; //gzip makes seo title suggestion feature to stop working
if (file_exists($mosConfig_absolute_path.'/installation/index.php')) {
	if (!defined('_ELXIS_SYSALERT')) { define('_ELXIS_SYSALERT', 3); }
	if (!defined('_ELXIS_SYSALERT_MSG')) { define('_ELXIS_SYSALERT_MSG', 'Please delete the <strong>installation</strong> folder.'); }
	include($mosConfig_absolute_path.'/includes/systemplates/router.php');
	exit();
}

require_once( $mosConfig_absolute_path.'/includes/Core/loader.php' );

$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix, $mosConfig_dbtype );
$database->debug( $mosConfig_debug );
$acl = new gacl_api();

if ($mosConfig_offline == 2) {
	$sysalert = true;
	$mosConfig_offline = 1;
	$GLOBALS['mosConfig_offline'] = 1;
	$scook = md5( 'site'.$mosConfig_live_site);
	if (isset($_COOKIE[$scook])) {
		$sesid = md5($_COOKIE[$scook].$_SERVER['REMOTE_ADDR']);
		$database->setQuery("SELECT COUNT(*) FROM #__session WHERE session_id='$sesid' AND gid='25'");
		if (intval($database->loadResult()) > 0) {
			$mosConfig_offline = 0;
			$GLOBALS['mosConfig_offline'] = 0;
			$sysalert = false;
		}
	}
	if ($sysalert) { define('_ELXIS_SYSALERT', 2); }
	unset($sysalert);
}

if ($mosConfig_offline == 1) {
	if (!defined('_ELXIS_SYSALERT')) { define('_ELXIS_SYSALERT', 1); }
	include($mosConfig_absolute_path.'/includes/systemplates/router.php');
	exit();
}

require_once( $mosConfig_absolute_path.'/includes/sef.php' );
require_once ($mosConfig_absolute_path.'/includes/frontend.php');

//retrieve some expected url (or form) arguments
$option 	= strtolower(strval(mosGetParam( $_REQUEST, 'option', '' )));
$no_html 	= intval(mosGetParam( $_REQUEST, 'no_html', 0 ));
$Itemid 	= intval(trim( mosGetParam( $_REQUEST, 'Itemid', 0 )));
$act 		= strval(mosGetParam( $_REQUEST, 'act', '' ));
$do_pdf 	= intval(mosGetParam( $_REQUEST, 'do_pdf', 0 ));
$do_rtf 	= intval(mosGetParam( $_REQUEST, 'do_rtf', 0 ));

//mainframe is an API workhorse, lots of 'core' interaction routines
$mainframe = new mosMainFrame( $database, $option, '.' );

$mainframe->initSession();
if ($option == 'login') {
	$mainframe->login();
	mosRedirect('index.php');
} else if ($option == 'logout') {
	$mainframe->logout();
	mosRedirect( 'index.php' );
}

// get the information about the current user from the sessions table
$my = $mainframe->getUser();

//Elxis Access Control System
@require_once($mainframe->getCfg('absolute_path').'/includes/Core/access.control.php' );

$mainframe->detect();
$gid = intval( $my->gid );

if ( $do_pdf == 1 ) {
	include ($mainframe->getCfg('absolute_path').'/includes/pdf.php');
	exit();
}
if ( $do_rtf == 1 ) {
	include ($mainframe->getCfg('absolute_path').'/includes/rtf.php');
	exit();
}

$cur_template = $mainframe->getTemplate();

//precapture the output of the component
require_once($mainframe->getCfg('absolute_path').'/editor/editor.php' );

ob_start();
if ($path = $mainframe->getPath( 'front' )) {
	$task = mosGetParam( $_REQUEST, 'task', '' );
	$ret = mosMenuCheck( $Itemid, $option, $task, $gid );
	if ($ret) {
		require_once( $path );
	} else {
		mosNotAuth();
	}
} else {
    @header('HTTP/1.0 404 Not Found');
	echo _NOT_EXIST;
}
$_MOS_OPTION['buffer'] = ob_get_contents();
if (ob_get_length() > 0) { ob_end_clean(); }

initGzip();

if(!headers_sent()) {
    header( 'Content-type: text/html; charset=utf-8' );
    header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
    header( "Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT" );
    header( "Cache-Control: no-store, no-cache, must-revalidate" );
    header( "Cache-Control: post-check=0, pre-check=0", false );
    header( "Pragma: no-cache" );
}

// start basic HTML
if ( $no_html == 0 ) {
	// needed to seperate the ISO number from the language file constant _ISO
	$iso = preg_split( '/\=/', _ISO );

	$rtl = '';
	$tempcss = 'template_css.css';
	if (_GEM_RTL) {
		$rtl = ' dir="rtl"';
		if (file_exists($mainframe->getCfg('absolute_path').'/templates/'.$cur_template.'/css/template_css-rtl.css')) {
			$tempcss = 'template_css-rtl.css';
		}
	}
	//xml prolog
	echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>'._LEND;
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo _LANGUAGE; ?>" xml:lang="<?php echo _LANGUAGE; ?>"<?php echo $rtl; ?>>
	<head>
		<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
	    <?php echo $mainframe->getHead(); ?>
        <link rel="stylesheet" href="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/includes/standard<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.css" type="text/css" media="all" />
        <link rel="stylesheet" href="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/templates/<?php echo $cur_template; ?>/css/<?php echo $tempcss; ?>" type="text/css" media="all" />
		<link rel="shortcut icon" href="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/images/favicon.ico" />
		<script src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/includes/js/elxis.js" type="text/javascript"></script>
		<meta name="robots" content="noindex, nofollow" />
	</head>
	<body class="contentpane"<?php echo $mainframe->onLoad(); ?>>
	   <?php mosMainBody(); ?>
	</body>
	</html>
	<?php
} else {
	mosMainBody();
}
doGzip();
//close FTP connection if we used it
$fmanager->closeFTP();

?>