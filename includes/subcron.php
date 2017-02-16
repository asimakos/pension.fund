<?php 
/** 
* @version: $Id: subcron.php 2329 2009-04-09 20:36:13Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Elxis
* @author: Ioannis Sannos
* @email: datahell@elxis.org
* @link: http://www.elxis.org
* @description: Cron file for users account expiration control
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

/*
Set this file to be executed once or twice per day using Cron Jobs.
*/


define('_VALID_MOS', 1);

$elxis_root = str_replace( '/includes', '', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));
require_once($elxis_root.'/configuration.php');
unset($elxis_root);

header('content-type: text/plain; charset: utf-8');

if ($mosConfig_offline == 1) { die('SITE OFFLINE'); }

/** make mail headers **/
function makemailheaders($tomail='', $toname='') {
	global $mosConfig_fromname, $mosConfig_mailfrom;

    $headers = 'MIME-Version: 1.0'."\r\n";
	$headers .= 'Content-type: text/plain; charset=utf-8; format=flowed'."\r\n";
	$headers .= 'Content-Transfer-Encoding: 8bit'."\r\n";
    if ($tomail != '') {
        if ($toname != '') {
        	$headers .= "To: =?UTF-8?B?".base64_encode($toname)."?= <".$tomail.'>'."\r\n";
        } else {
        	$headers .= 'To: <'.$tomail.'>'."\r\n";
        }
    }
    $headers .= "From: =?UTF-8?B?".base64_encode($mosConfig_fromname)."?= <".$mosConfig_mailfrom.">"."\r\n";
    $headers .= 'Reply-To: <'.$mosConfig_mailfrom.'>'."\r\n";
    $headers .= 'X-Priority: 3'."\r\n";
    $headers .= 'X-MSMail-Priority: Normal'."\r\n";
    $headers .= "X-Mailer: Elxis CMS\r\n";
	return $headers;
}

/** DATABASE CONNECTION **/
require_once($mosConfig_absolute_path.'/includes/adodb/adodb.inc.php');
$db = ADONewConnection($mosConfig_dbtype);

$csdrivers = array('postgres', 'postgres64', 'postgres7', 'postgres8', 'oci8', 'oci805', 'oci8po', 'oracle', 'ibase');
if (in_array($mosConfig_dbtype, $csdrivers)) { $db->charSet = 'utf8'; }
$oradrivers = array('oci8', 'oci805', 'oci8po', 'oracle');
if (in_array($mosConfig_dbtype, $oradrivers)) {
	$db->NLS_DATE_FORMAT = 'RRRR-MM-DD HH24:MI:SS';
	$con = $db->Connect($mosConfig_host, $mosConfig_user, $mosConfig_password);
} else {
    $con = $db->Connect($mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db);
}
if (preg_match('/mysql/', $mosConfig_dbtype)) { $db->Execute('SET NAMES utf8'); }

if (!$con || !$db->IsConnected()) {
    $message = "Elxis subscriptions CRON file located at ".$mosConfig_sitename." could not get connected to the site database!\r\n";
    $message .= "This tool is used to automatically check users account expiration.\r\n";
    $message .= "If the problem persists please take the necessary actions to fix it.\r\n\r\n";
	$message .= "Date: ".date('Y-m-d H:i:s')." (Y-m-d H:i:s)\r\n";
    $message .= "Web site name: ".$mosConfig_sitename."\r\n";
    $message .= "Web site URL: ".$mosConfig_live_site."\r\n\r\n\r\n";
	$message .= "Elxis account expiration control by Elxis Team (www.elxis.org).";    	

	$headers = makemailheaders($mosConfig_mailfrom, $mosConfig_fromname);
	$subject = 'Could not connect to database - Elxis CRON';
	@mail($mosConfig_mailfrom, $subject, $message, $headers);
    exit();
}

/** search for just expired subscriptions **/
$query = "SELECT id, name, username, email, expires FROM ".$mosConfig_dbprefix."users WHERE block='0' AND expires < '".date('Y-m-d H:i:s')."'";
$rs = $db->Execute($query);
if (is_object($rs) && $rs->RecordCount() > 0) {
    while ($row = $rs->FetchRow()) {
    	$uquery = "UPDATE ".$mosConfig_dbprefix."users SET block='1' WHERE id='".$row['id']."'";
    	$db->Execute($uquery);

    	$message = 'Dear '.$row['name'].",\r\n";
    	$message .= "Your user account at ".$mosConfig_sitename." has been expired.\r\n";
    	$message .= "Account username: ".$row['username']."\r\n";
    	$message .= "User Id: ".$row['id']."\r\n";
    	$message .= "Expiration date: ".strftime("%a, %d %B %Y", strtotime($row['expires']))."\r\n";
    	$message .= "Please contact the site administrator to renew your account.\r\n\r\n";
    	$message .= "Regards,\r\n";
    	$message .= $mosConfig_sitename."\r\n";
    	$message .= $mosConfig_live_site;

		$headers = makemailheaders($row['email'], $row['name']);
		$subject = 'Your account has been expired!';
		//uncomment the line bellow if you use a UTF-8 encoded subject
		//$subject = "=?UTF-8?B?".base64_encode($subject)."?=\r\n"; 
		@mail($row['email'], $subject, $message, $headers);
    }
}

$db->Close();

?>