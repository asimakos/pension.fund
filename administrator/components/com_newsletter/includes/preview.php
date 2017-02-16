<?php 
/**
* @version: 1.1
* @copyright: Copyright (C) 2008-2009 Is Open Source. All rights reserved.
* @package: Elxis
* @subpackage: Component NewsLetter
* @author: Ioannis Sannos (Is Open Source)
* @link: http://www.isopensource.com
* @email: info@isopensource.com
* @license: http://creativecommons.org/licenses/by-sa/3.0/ Creative Commons Attribution-Share Alike 3.0
* Elxis CMS is a Free Software
*/


define('_VALID_MOS', 1);
define('_ELXIS_ADMIN', 1);


$elxis_root = str_replace( '/administrator/components/com_newsletter/includes', '', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));
require_once($elxis_root.'/administrator/includes/auth.php');

$rtl = (_GEM_RTL) ? ' dir="rtl"' : '';

$id = intval(mosGetParam($_GET, 'id', 0));
$s = intval(mosGetParam($_GET, 's', 0)); //1: plain text, 2: html text, 3: html file

if ((!$id) || (!$s)) { die('You are not allowed to access this resource!'); }

$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix, $mosConfig_dbtype );
$database->debug(0);

if ($s === 1) {
	$database->setQuery("SELECT id, textplain FROM #__iosnl_messages WHERE id='".$id."'", '#__', 1, 0);
	$row = $database->loadRow();
	if (!$row) { die('You are not allowed to access this resource!'); }
	if (!headers_sent()) {
		header('Content-type: text/plain; charset: utf-8');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0', false);
		header('Pragma: no-cache');
	}
	echo $row['textplain'];
} elseif ($s === 2) {
	$database->setQuery("SELECT id, subject, texthtml FROM #__iosnl_messages WHERE id='".$id."'", '#__', 1, 0);
	$row = $database->loadRow();
	if (!$row) { die('You are not allowed to access this resource!'); }
	if (!headers_sent()) {
		header('Content-type: text/html; charset: utf-8');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0', false);
		header('Pragma: no-cache');
	}
?>
	<html lang="<?php echo $adminLanguage->A_XML_LANGUAGE; ?>"<?php echo $rtl; ?>>
	<head>
		<title><?php echo $row['subject']; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="Generator" content="Elxis - (C) Copyright 2006-<?php echo date('Y'); ?> Elxis.org.  All rights reserved." />
	</head>
	<body style="background-color:#FFFFFF; margin: 0; padding: 0;">
		<?php echo $row['texthtml']; ?>
	</body>
	</html>

<?php 
} elseif ($s === 3) {
	$database->setQuery("SELECT id, subject, htmlfile FROM #__iosnl_messages WHERE id='".$id."'", '#__', 1, 0);
	$row = $database->loadRow();
	if (!$row) { die('You are not allowed to access this resource!'); }
	if (trim($row['htmlfile']) == '') { die('HTML file not set'); }
	if (!file_exists($mosConfig_absolute_path.'/administrator/components/com_newsletter/htmlfiles/'.$row['htmlfile'])) {
		die('HTML file does not exist'); 
	}
	if (!headers_sent()) {
		header('Content-type: text/html; charset: utf-8');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: post-check=0, pre-check=0', false);
		header('Pragma: no-cache');
	}
?>
	<html lang="<?php echo $adminLanguage->A_XML_LANGUAGE; ?>"<?php echo $rtl; ?>>
	<head>
		<title><?php echo $row['subject']; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="Generator" content="Elxis - (C) Copyright 2006-<?php echo date('Y'); ?> Elxis.org.  All rights reserved." />
	</head>
	<body style="background-color:#FFFFFF; margin: 0; padding: 0;">
		<?php include($mosConfig_absolute_path.'/administrator/components/com_newsletter/htmlfiles/'.$row['htmlfile']); ?>
	</body>
	</html>
<?php 
} else {
	die('You are not allowed to access this resource!');
}

?>