<?php 
/** 
* @version: $Id: login.php 39 2010-06-07 18:36:03Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: System Templates
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info [at] elxis [dot] org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/


define('_VALID_MOS', 1);
session_start();

$elxis_root = str_replace( '/includes/systemplates', '', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));
require_once($elxis_root.'/includes/Core/security.php');
require_once ($elxis_root.'/configuration.php');
unset($elxis_root);

if ($mosConfig_offline != 2) { //only if site is available for super admins
	header('Location: '.$mosConfig_live_site);
	exit();
}

if (!isset($_POST['username']) || !isset($_POST['passwd'])) {
	header('Location: '.$mosConfig_live_site);
	exit();
}

require_once($mosConfig_absolute_path.'/includes/Core/loader.php');

$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix, $mosConfig_dbtype );
$database->debug(0);
$acl = new gacl_api();

require_once($mosConfig_absolute_path.'/includes/sef.php');
require_once($mosConfig_absolute_path.'/includes/frontend.php');

$option = strtolower(strval(mosGetParam($_REQUEST, 'option', 'login')));
$Itemid = intval(trim(mosGetParam($_REQUEST, 'Itemid', 0)));

$mainframe = new mosMainFrame($database, $option, $mosConfig_absolute_path);
$mainframe->initSession();

/******************************************************/

$username = trim(mosGetParam($_POST, 'username', ''));
$username = $database->getEscaped($username);
$passwd = md5(trim(mosGetParam($_POST, 'passwd', '')));

if (!$username || !$passwd) {
	$mainframe->checkSendHeaders();
	echo '<script type="text/javascript">alert(\''._LOGIN_INCOMPLETE.'\'); window.history.go(-1);</script>'."\n";
	exit();
}

$database->setQuery("SELECT id, gid, block, usertype, expires FROM #__users WHERE username='".$username."' AND password='".$passwd."'", '#__', 1, 0);
$row = $database->loadRow();

if (!$row) {
	$mainframe->checkSendHeaders();
	echo '<script type="text/javascript">alert(\''._LOGIN_INCORRECT.'\'); window.history.go(-1);</script>'."\n";
	exit();
}

if ($row['block'] == 1) {
	$mainframe->checkSendHeaders();
	echo '<script type="text/javascript">alert(\''._LOGIN_BLOCKED.'\'); window.history.go(-1);</script>'."\n";
	exit();
}

if (trim($row['expires']) <= date('Y-m-d H:i:s')) {
	$database->setQuery("UPDATE #__users SET block='1' WHERE id='".$row['id']."'");
	$database->query();
	$mainframe->checkSendHeaders();
	echo '<script type="text/javascript">alert(\''._E_ACCOUNT_EXPIRED.'\'); window.history.go(-1);</script>'."\n";
	exit();
}

if ($row['gid'] != 25) {
	$mainframe->checkSendHeaders();
	echo '<script type="text/javascript">alert(\'Only super administrators can login!\'); window.history.go(-1);</script>'."\n";
	exit();
}

$grp = $acl->getAroGroup($row['id']);
$usertype = $grp->name;

$session =& $mainframe->_session;
$session->username = $username;
$session->guest = 0;
$session->userid = intval( $row['id'] );
$session->usertype = $usertype;
$session->gid = intval($row['gid']);
$session->allowed = implode(',', $mainframe->allowedGroups($session->gid));
$session->update();

$currentDate = date("Y-m-d H:i:s");
$database->setQuery("UPDATE #__users SET lastvisitdate='".$currentDate."' WHERE id='".$session->userid."'");
$database->query();

mosRedirect($mosConfig_live_site);

?>