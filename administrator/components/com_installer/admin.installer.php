<?php 
/**
* @version: $Id: admin.installer.php 28 2010-06-02 20:39:33Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


require_once($mainframe->getPath('admin_html'));
require_once($mainframe->getPath('class'));
require_once($mainframe->getCfg('absolute_path').'/administrator/components/com_installer/edcbrowser.php');

/* EDC Browser AJAX call */
if ($task == 'listpackages') {
	$edcbrowser = new edcbrowser();
	$edcbrowser->run($task);
	return;
}

$element = mosGetParam($_REQUEST, 'element', '');
$client = mosGetParam($_REQUEST, 'client', '');
$path = $mainframe->getCfg('absolute_path').'/administrator/components/com_installer/'.$element.'/'.$element.'.php';

//ensure user has access to this function
if (!$acl->acl_check( 'administration', 'install', 'users', $my->usertype, $element.'s', 'all')) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

// map the element to the required derived class
$classMap = array(
    'component' => 'mosInstallerComponent',
    'language' => 'mosInstallerLanguage',
    'mambot' => 'mosInstallerMambot',
    'module' => 'mosInstallerModule',
    'template' => 'mosInstallerTemplate',
    'bridge' => 'mosInstallerBridge'
);

if (array_key_exists ($element, $classMap)) {
	require_once($mainframe->getPath('installer_class', $element));

	switch ($task) {
		case 'uploadfile':
		    uploadPackage($classMap[$element], $option, $element, $client);
		break;
		case 'installfromdir':
			installFromDirectory($classMap[$element], $option, $element, $client);
		break;
		case 'installfromdir2':
			installFromDirectory2($classMap[$element], $option, $element, $client);
		break;
		case 'installfromedc':
			installFromEDC($classMap[$element], $option, $element, $client);
		break;
		case 'remove':
		    removeElement($classMap[$element], $option, $element, $client);
		break;
		case 'updates':
			checkUpdates($classMap[$element], $option, $element, $client);
		break;
		default:
			$path = $mainframe->getCfg('absolute_path').'/administrator/components/com_installer/'.$element.'/'.$element.'.php';
			if (file_exists( $path )) {
				require $path;
			} else {
				echo $adminLanguage->A_CMP_INS_NF.' ['.$element.']';
			}
		break;
	}
} else {
	echo $adminLanguage->A_CMP_INS_NA.' ['.$element.']';
}


/******************************/
/* UPLOAD AND INSTALL PACKAGE */
/******************************/
function uploadPackage( $installerClass, $option, $element, $client ) {
	global $mainframe, $adminLanguage, $fmanager;

	$installer = new $installerClass();

	//Check if file uploads are enabled
	if (!(bool)ini_get('file_uploads')) {
		HTML_installer::showInstallMessage( $adminLanguage->A_CMP_INS_EFU,
			$adminLanguage->A_CMP_INS_ERTL, $installer->returnTo( $option, $element, $client ) );
		exit();
	}

	//Check that the zlib is available
	if(!extension_loaded('zlib')) {
		HTML_installer::showInstallMessage( $adminLanguage->A_CMP_INS_ERZL, 
        $adminLanguage->A_CMP_INS_ERTL, $installer->returnTo( $option, $element, $client ) );
		exit();
	}

	$userfile = mosGetParam( $_FILES, 'userfile', null );

	if (!$userfile) {
		HTML_installer::showInstallMessage( $adminLanguage->A_CMP_INS_ERNF, $adminLanguage->A_CMP_INS_ERUM,
			$installer->returnTo( $option, $element, $client ), $installer->getNotices());
		exit();
	}

    $dest = $fmanager->PathName($mainframe->getCfg('absolute_path').SEP.'tmpr').$userfile['name'];
    $resultdir = $fmanager->upload( $userfile['tmp_name'], $dest );

	if ($resultdir != false) {
		if (!$installer->upload( $userfile['name'] )) {
			HTML_installer::showInstallMessage( $installer->getAllErrors(),
                $adminLanguage->A_CMP_INS_UPTL .$element. $adminLanguage->A_CMP_INS_UPE1,
				$installer->returnTo( $option, $element, $client ), $installer->getNotices() );
		}
		$ret = $installer->install();

		HTML_installer::showInstallMessage( $installer->getAllErrors(),
            $adminLanguage->A_CMP_INS_UPTL.$element.' - '.($ret ? $adminLanguage->A_CMP_INS_SUCC : $adminLanguage->A_CMP_INS_ERFL),
			$installer->returnTo( $option, $element, $client ), $installer->getNotices() );
            cleanupInstall( $userfile['name'], $installer->unpackDir() );
	} else {
		HTML_installer::showInstallMessage( $msg, $adminLanguage->A_CMP_INS_UPTL.$element. $adminLanguage->A_CMP_INS_UPE2,
			$installer->returnTo( $option, $element, $client ), $installer->getNotices() );
	}
}


/**********************************/
/* INSTALL PACKAGE FROM DIRECTORY */
/**********************************/
function installFromDirectory( $installerClass, $option, $element, $client) {
	global $adminLanguage, $fmanager;

	$userfile = mosGetParam($_REQUEST, 'userfile', '');

	if (!$userfile) {
		$element = (trim($element) == '') ? 'module' : $element;
		mosRedirect('index2.php?option='.$option.'&element='.$element, $adminLanguage->A_CMP_INS_SDIR);
	}

	$installer = new $installerClass();

	$path = $fmanager->PathName($userfile);
	if (!is_dir( $path )) {
		$path = dirname($path);
	}

	$ret = $installer->install($path);
	HTML_installer::showInstallMessage($installer->getAllErrors(), $adminLanguage->A_CMP_INS_UPNW.$element.' - '.($ret ? $adminLanguage->A_CMP_INS_SUCC : $adminLanguage->A_CMP_INS_ER),
		$installer->returnTo($option, $element, $client), $installer->getNotices());
}


/****************************************/
/* INSTALL PACKAGE FROM DIRECTORY (EDC) */
/****************************************/
function installFromDirectory2( $installerClass, $option, $element, $client) {
	global $adminLanguage, $fmanager, $mainframe;

	$packdir = trim(base64_decode(mosGetParam($_GET, 'packdir', '')));
	$userfile = $mainframe->getCfg('absolute_path').'/tmpr/'.$packdir.'/';

	if (($packdir == '') || !file_exists($userfile) || !is_dir($userfile)) {
		$element = (trim($element) == '') ? 'module' : $element;
		mosRedirect('index2.php?option='.$option.'&element='.$element, $adminLanguage->A_CMP_INS_SDIR);
	}

	$installer = new $installerClass();
	$path = $fmanager->PathName($userfile);
	if (!is_dir($path)) { $path = dirname($path); }
	$ret = $installer->install($path);
	$fmanager->deleteFolder($userfile);

	if (preg_match('/\//', $packdir)) { //clean tmpr as the installation file was in a sub-directory
		$dirsindir = $fmanager->listFolders($mainframe->getCfg('absolute_path').'/tmpr/', '', false, true);
    	if ($dirsindir && (count($dirsindir) >0)) {
        	foreach ($dirsindir as $ddir) { $fmanager->deleteFolder($ddir); }
    	}
	}

	HTML_installer::showInstallMessage($installer->getAllErrors(), $adminLanguage->A_CMP_INS_UPNW.$element.' - '.($ret ? $adminLanguage->A_CMP_INS_SUCC : $adminLanguage->A_CMP_INS_ER),
		$installer->returnTo($option, $element, $client), $installer->getNotices());
}

/***********************************************/
/* INSTALL PACKAGE FROM ELXIS DOWNLOADS CENTER */
/***********************************************/
function installFromEDC($installerClass, $option, $element, $client) {
	global $adminLanguage, $fmanager;

	$id = intval(mosGetParam($_REQUEST, 'id', 0));

	if ($id < 1) {
		$element = (trim($element) == '') ? 'module' : $element;
		mosRedirect('index2.php?option='.$option.'&element='.$element, $adminLanguage->A_CMP_INS_SDIR );
	}
	$edcbrowser = new edcbrowser();
	$edcbrowser->run('installfromedc');
	exit();
}


/********************/
/* UNISTALL PACKAGE */
/********************/
function removeElement($installerClass, $option, $element, $client) {
	global $adminLanguage;

	$cid = mosGetParam( $_REQUEST, 'cid', array(0) );
	if (!is_array( $cid )) {
	    $cid = array(0);
	}

	$installer = new $installerClass();
	$result = false;
	if ($cid[0]) {
	    $result = $installer->uninstall( $cid[0], $option, $client );
	}

	$msg = $installer->getError();

	mosRedirect( $installer->returnTo( $option, $element, $client ), $result ? $adminLanguage->A_CMP_INS_SUCC . $msg : $adminLanguage->A_CMP_INS_ERFL . ' ' . $msg );
}


/*********************/
/* CHECK FOR UPDATES */
/*********************/
function checkUpdates($installerClass, $option, $element, $client) {

	$edc = new edcbrowser($element, $client);
	$rows = $edc->run('updates');
	$errormsg = $edc->geterrormsg();
	unset($edc);

	HTML_installer::showUpdates($rows, $element, $client, $errormsg);

/*
echo '<pre style="text-align: left;">'."\n";

print_r($rows);

echo "</pre>\n";


	echo '<div style="text-align: left;">';
	echo 'installer class: '.$installerClass.'<br />';
	echo 'option: '.$option.'<br />';
	echo 'element: '.$element.'<br />';
	echo 'client: '.$client.'<br />';
	echo "</div>\n";

*/

	//	HTML_installer::showInstallMessage( $msg, $adminLanguage->A_CMP_INS_UPTL.$element. $adminLanguage->A_CMP_INS_UPE2,
	//		$installer->returnTo( $option, $element, $client ), $installer->getNotices() );
	
}

?>