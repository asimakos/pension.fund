<?php 
/**
* @version: $Id: iremover.php 2493 2009-09-10 05:35:18Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Elxis CMS Installer
* @author: Ioannis Sannos (datahell)
* @email: datahell@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Removes Elxis installation folder
*/

define('_VALID_MOS', 1);
header('content-type: text/html; charset: utf-8');

$elxis_root = str_replace( '/includes', '', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));
$idir = $elxis_root.'/installation/';
if (!file_exists($idir) || !is_dir($idir)) { die('INSTALLATION DIR NOT FOUND!'); }
if (!file_exists($elxis_root.'/configuration.php') || filesize($elxis_root.'/configuration.php') < 10) {
	die('ELXIS INSTALLATION IS INCOMPLETE OR THE CONFIGURATION FILE IS EMPTY!');
}
require_once($elxis_root.'/configuration.php');
unset($elxis_root);

if ($mosConfig_offline == 1) { die('SITE OFFLINE'); }

$idir = $mosConfig_absolute_path.'/installation/';
if (!file_exists($idir) || !is_dir($idir)) { die('INSTALLATION DIR NOT FOUND!'); }
if (!file_exists($idir.'tmpconfig.php')) { die('TEMPORARY CONFIGURATION FILE NOT FOUND!'); }

$t = filemtime($idir.'tmpconfig.php');

if (time() > (filemtime($idir.'tmpconfig.php') + 1200)) {
	die('YOU ARE ALLOWED TO REMOVE THE INSTALLATION FOLDER WITHIN 20 MINUTES SINCE ELXIS INSTALLATION IS COMPLETE.');
}

/** CONNECT TO FTP SERVER **/
function connectftp($ftp, $ftp_host, $ftp_user, $ftp_pass, $ftp_port, $ftp_root) {
	if (!function_exists('ftp_connect') || !is_callable('ftp_connect')) { return false; }
	if (!$ftp) { return false; }
	if ($ftp_host == '') { return false; }
	if (trim($ftp_user) == '') { return false; }
	if (trim($ftp_pass) == '') { return false; }
	if (intval($ftp_port) == 0) { return false; }
	if ($ftp_root == '') { return false; }

	$conn_id = @ftp_connect($ftp_host, $ftp_port, 20);
	$login_result = @ftp_login($conn_id, $ftp_user, $ftp_pass);
	if ((!$conn_id) || (!$login_result)) { return false; }
	if (!@ftp_chdir($conn_id, $ftp_root)) { @ftp_close($conn_id); return false; }
	$files = @ftp_nlist($conn_id,".");
	if (!$files || !is_array($files) || (count($files) == 0)) {
		@ftp_close($conn_id);
		return false;
	}
	if (in_array('configuration.php', $files) && in_array('index2.php', $files)) {
		return $conn_id;
	} else {
		return false;
	}
}


/** DISCONNECT FROM FTP SERVER **/
function disconnectftp($conn_id) {
	@ftp_close($conn_id);
}


/** RECURSIVELY DELETE FOLDER **/
function rdeletedir($dir, $ftpcon=false) {
    if (!file_exists($dir)) { return true; }
    $current_dir = @opendir($dir);
    while ($entryname = readdir($current_dir)) {
    	if (($entryname != '.') && ($entryname != '..')) {
    		if (is_dir($dir.$entryname)) {
    			rdeletedir($dir.$entryname.'/', $ftpcon);
    		} else {
    			deleteFile($dir.$entryname, $ftpcon);
    		}
    	}
    }
    closedir($current_dir);
    $ret = @rmdir($dir);
    if (!$ret) {
		if ($ftpcon) {
			$fdir = FTPpath($dir);
    		$ret = @ftp_rmdir($ftpcon,$fdir);
    	}
    }
    return $ret;
}


/** DELETE FILE **/
function deleteFile($file, $ftpcon=false) {
	$ret = @unlink($file);
	if (!$ret) {
		if ($ftpcon) {
			$ffile = FTPpath($file);
        	$ret = @ftp_delete($ftpcon,$ffile);
        }
	}
	return $ret;
}


/** GET FTP PATH **/
function FTPpath($path) {
	global $mosConfig_absolute_path, $mosConfig_ftp_root;

    $diff = str_replace(str_replace(DIRECTORY_SEPARATOR, '/', $mosConfig_absolute_path), '', str_replace( DIRECTORY_SEPARATOR, '/', $path));
	return $mosConfig_ftp_root.$diff; 
}


$ftpcon = connectftp($mosConfig_ftp, $mosConfig_ftp_host, $mosConfig_ftp_user, $mosConfig_ftp_pass, $mosConfig_ftp_port, $mosConfig_ftp_root);

rdeletedir($idir, $ftpcon);

if ($ftpcon) { disconnectftp($ftpcon); }

if (!file_exists($idir)) {
	echo 'Installation folder deleted successfully!';
} else {
	echo 'Could not delete installation folder!';
}

?>