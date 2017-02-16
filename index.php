<?php 
/** 
* @version: $Id: index.php 36 2010-06-06 19:03:20Z sannosi $
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

if (!file_exists('configuration.php') || (filesize('configuration.php') < 10)) {
	if (file_exists('installation/index.php')) {
		header('Location: installation/index.php');
		exit();
	} else {
		die('configuration.php file not found!');
	}
}

require_once('configuration.php');
if (file_exists($mosConfig_absolute_path.'/installation/index.php')) {
	if (!defined('_ELXIS_SYSALERT')) { define('_ELXIS_SYSALERT', 3); }
	if (!defined('_ELXIS_SYSALERT_MSG')) { define('_ELXIS_SYSALERT_MSG', 'Please delete the <strong>installation</strong> folder.'); }
	include($mosConfig_absolute_path.'/includes/systemplates/router.php');
	exit();
}

require_once($mosConfig_absolute_path.'/includes/Core/loader.php');

$database = new database($mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix, $mosConfig_dbtype);
$database->debug($mosConfig_debug);
$acl = new gacl_api();

if ($mosConfig_offline == 2) {
	$sysalert = true;
	$mosConfig_offline = 1;
	$GLOBALS['mosConfig_offline'] = 1;
	$scook = md5( 'site'.$mosConfig_live_site);
	if (isset($_COOKIE[$scook])) {
		$sesid = md5($_COOKIE[$scook].$_SERVER['REMOTE_ADDR']);
		$database->setQuery("SELECT COUNT(*) FROM #__session WHERE session_id='".$sesid."' AND gid='25'");
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
require_once($mosConfig_absolute_path.'/includes/frontend.php');

/** retrieve some expected url (or form) arguments */
$option = strval(strtolower(mosGetParam($_REQUEST, 'option', '')));
$Itemid = intval(mosGetParam($_REQUEST, 'Itemid', 0));

//redirect to user's browser language on first visit in front-page, comment this if you don't want it
$elxis_language->toBrowserLang();

if ($option == '') {
	if ($Itemid) {
		$query = "SELECT id, link FROM #__menu WHERE menutype='mainmenu'"
		."\n AND id = '".$Itemid."' AND published = '1' AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
		$database->setQuery($query, '#__', 1, 0);
	} else {
		$query = "SELECT id, link FROM #__menu WHERE menutype='mainmenu' AND published='1'"
		."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%')) ORDER BY parent, ordering";
		$database->setQuery($query, '#__', 1, 0);
	}
	$menu = new mosMenu($database);
	if ($database->loadObject($menu)) {	$Itemid = $menu->id; }
	$link = $menu->link;
	if (($pos = strpos( $link, '?' )) !== false) { $link = substr( $link, $pos+1 ). '&Itemid='.$Itemid; }
	parse_str($link, $temp);
	/** this is a patch, need to rework when globals are handled better */
	foreach ($temp as $k=>$v) {
		$GLOBALS[$k] = $v;
		$_REQUEST[$k] = $v;
		if ($k == 'option') { $option = $v; }
	}
}

/** mainframe is an API workhorse, lots of 'core' interaction routines */
$mainframe = new mosMainFrame($database, $option, '.');
$mainframe->initSession();

// checking if we can find the Itemid through the content
if ($option == 'com_content' && $Itemid === 0) {
	$id = intval(mosGetParam($_REQUEST, 'id', 0));
	$Itemid = intval($mainframe->getItemid($id));
}

/** If no Itemid yet, get frontpage's */
if ($Itemid === 0) {
	$query = "SELECT id FROM #__menu WHERE menutype='mainmenu' AND published='1'"
	."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%')) ORDER BY parent, ordering";
	$database->setQuery($query, '#__', 1, 0);
	$Itemid = intval($database->loadResult());
}

/** patch to lessen the impact on templates */
if ($option == 'search') { $option = 'com_search'; }

if ($option == 'login') { //LOGIN
    $mainframe->login();

	if (mosGetParam($_POST, 'message', 0)) {
		$mainframe->checkSendHeaders();
?>
		<script type="text/javascript">alert("<?php echo _LOGIN_SUCCESS; ?>");</script>
<?php 
	}
	$return = strval(mosGetParam($_REQUEST, 'return', NULL));
	if ($return) { mosRedirect($return); } else { mosRedirect('index.php'); }

} else if ($option == 'logout') { //LOGOUT
	$mainframe->logout();
	
	if (mosGetParam($_POST, 'message', 0)) {
		$mainframe->checkSendHeaders();
?>
		<script type="text/javascript">alert("<?php echo _LOGOUT_SUCCESS; ?>");</script>
<?php 
	}
	$return = strval(mosGetParam($_REQUEST, 'return', NULL));
	if ($return) { mosRedirect($return); } else { mosRedirect('index.php'); }
}

/** get the information about the current user from the sessions table */
$my = $mainframe->getUser();

//Elxis Access Control System
require_once($mosConfig_absolute_path.'/includes/Core/access.control.php');
$mainframe->detect(); //detect first visit

//static cache
if ($mosConfig_static_cache == 1) {
	$stcache = new staticCache();
	$stcache->preparepath();

	if ($stcache->checkread()) {
		initGzip();
		$stcache->loadCache();
		doGzip();
		exit();
	}
}

$gid = intval($my->gid); //user group
$cur_template = $mainframe->getTemplate(); //current template

/** @global A place to store information from processing of the component */
$_MOS_OPTION = array();

//precapture the output of the component
require_once($mosConfig_absolute_path.'/editor/editor.php');

ob_start();

if ($path = $mainframe->getPath('front')) {
	$task = strval(mosGetParam($_REQUEST, 'task', ''));
	$ret = mosMenuCheck($Itemid, $option, $task, $gid);
	if ($ret) {
		require_once($path);
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
    header('Content-type: text/html; charset=utf-8');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');
}

//loads template file
if (!file_exists($mosConfig_absolute_path.'/templates/'.$cur_template.'/index.php')) {
	echo _TEMPLATE_WARN.$cur_template;
} else {
	$tplparams = new mosParameters($mainframe->getTplParams());
	require_once($mosConfig_absolute_path.'/templates/'.$cur_template.'/index.php');
}

//displays queries performed for page
if ($mosConfig_debug) {
	echo $database->_ticker.' queries executed';
	echo '<pre>'._LEND;
 	foreach ($database->_log as $k=>$sql) {
 	    echo $k+1 . _LEND . $sql . '<hr />'._LEND;
	}
	echo '</pre>'._LEND;
}

if ($mosConfig_static_cache == 1) {
	if ($stcache->checkwrite()) { $stcache->writeCache(); }
	unset($stcache);
}

doGzip(); 
//close FTP connection if we used it
$fmanager->closeFTP();

?>