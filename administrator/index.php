<?php 
/**
* @version: $Id: index.php 2519 2009-09-28 06:57:21Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Administration
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

/** Set flag that this is a parent file */
define( '_VALID_MOS', 1 );
define( '_ELXIS_ADMIN', 1 );


$elxis_root = str_replace('/administrator', '', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));
require_once($elxis_root.'/includes/Core/security.php');

if (!file_exists($elxis_root.'/configuration.php')) {
	header('Location: ../installation/index.php');
	exit();
}

require_once($elxis_root.'/configuration.php');
require_once($elxis_root.'/includes/Core/loader.php');

$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix, $mosConfig_dbtype );
$database->debug( $mosConfig_debug );
$acl = new gacl_api();

//mainframe is an API workhorse, lots of 'core' interaction routines
$mainframe = new mosMainFrame( $database, $option, '..', true );

header( 'Content-type: text/html; charset=utf-8' );
header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );

//Rename login page feature
$x = preg_split('/\//', $_SERVER['PHP_SELF']);
$y = count($x) -1;
define('_FORM_ACTION', $x[$y]);

if (isset( $_POST['submit'] )) {
	/** escape and trim to minimise injection of malicious sql */
	$usrname	= $database->getEscaped( trim( mosGetParam( $_POST, 'usrname', '' ) ) );
	$pass 		= $database->getEscaped( trim( mosGetParam( $_POST, 'pass', '' ) ) );

	if (!$pass) {
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_ALERT_ENTER_PASSWORD."'); document.location.href='"._FORM_ACTION."';</script>\n";
	} else {
		$pass = md5( $pass );
	}

    $query = "SELECT COUNT(*) FROM #__core_acl_access_lists"
    ."\n WHERE aco_section = 'administration' AND aco_value = 'login'"
    ."\n AND aro_section = 'users'";
	$database->setQuery( $query );
	$count = intval($database->loadResult());

	if ( $count < 1 ) {
		echo "<script type=\"text/javascript\">alert(\"".$adminLanguage->A_LOGIN_NOGROUPS."\"); window.history.go(-1);</script>\n";
		exit();
    }

	$database->setQuery("SELECT COUNT(*) FROM #__users WHERE gid='25' AND block='0' AND expires > '".date('Y-m-d H:i:s')."'");
	$count2 = intval( $database->loadResult() );
	if ( $count2 < 1 ) {
		echo "<script type=\"text/javascript\">alert(\"".$adminLanguage->A_LOGIN_NOADMINS."\"); window.history.go(-1);</script>\n";
		exit();
	}

	$database->setQuery("SELECT * FROM #__users WHERE username='".$usrname."' AND block='0' AND expires > '".date('Y-m-d H:i:s')."'");
	$my = null;
	$database->loadObject($my);

    require_once($mosConfig_absolute_path.'/administrator/tools/lrecorder/recorder.class.php');

	/** find the user group (or groups in the future) */
	if (@$my->id) {
    	$grp            = $acl->getAroGroup( $my->id );
    	$my->gid        = $grp->group_id;
    	$my->usertype   = $grp->name;
    	$my->allowed	= implode(',', $mainframe->allowedGroups($my->gid));
    
		if (strcmp( $my->password, $pass )
		|| !$acl->acl_check( 'administration', 'login', 'users', $my->usertype )) {
			echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_ALERT_INCORRECT."'); document.location.href='"._FORM_ACTION."';</script>\n";
			exit();
		}

		session_name( md5( $mosConfig_live_site ) );
		session_start();

		$logintime 	= time() + ($mosConfig_offset * 3600);
		$session_id = md5( $my->id.$my->username.$my->usertype.$logintime );

		if (@getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
			$ip = getenv("REMOTE_ADDR");
		} else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'],"unknown")) {
			$ip = $_SERVER['REMOTE_ADDR'];
		} else {
			$ip = '';
		}

		$query = "INSERT INTO #__session"
		."\n (username, time, session_id, guest, userid, usertype, gid, allowed, ip) VALUES "
		."('$my->username', '$logintime', '$session_id', '0', '$my->id', '$my->usertype', '$my->gid', '$my->allowed', '$ip')";
		$database->setQuery( $query );
		if (!$database->query()) {
			echo $database->stderr();
		}

		$_SESSION['session_id'] 		= $session_id;
		$_SESSION['session_user_id'] 	= $my->id;
		$_SESSION['session_username'] 	= $my->username;
		$_SESSION['session_usertype'] 	= $my->usertype;
		$_SESSION['session_gid'] 		= $my->gid;
		$_SESSION['session_allowed'] 	= $my->allowed;
		$_SESSION['session_logintime'] 	= $logintime;
		$_SESSION['session_userstate'] 	= array();
		$_SESSION['session_ip'] 		= $ip;

		session_write_close();
		$rec = new elxisLRecorder();
		$rec->record($usrname, 's');

		/** cannot using mosredirect as this stuffs up the cookie in IIS */
		echo "<script type=\"text/javascript\">document.location.href='index2.php';</script>\n";
		exit();
	} else {
		$rec = new elxisLRecorder();
		$rec->record($usrname, 'f');

		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_ALERT_INCORRECT_TRY."'); document.location.href='"._FORM_ACTION."';</script>\n";
		exit();
	}
} else {
	initGzip();
	$tplparams = new mosParameters($mainframe->getLSParams());
	$path = $mainframe->getCfg('absolute_path').'/administrator/templates/login/'.$mainframe->getLoginScreen().'/index.php';
	require_once( $path );
	doGzip();
}
  
//close FTP connection if we used it
$fmanager->closeFTP();
?>
