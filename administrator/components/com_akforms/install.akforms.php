<?php
/**
* @version: 1.0
* @package: Component AkForms
* @author: Andrew Campoball
* @email: ACampball@yandex.ru
* @link:
* @license: GPL
* @copyright: (C) 2009 Andrew Campball. All rights reserved.
* @description: AkForms component for Elxis CMS.
*****************************************************************************/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


function com_install() {
	global $database, $mainframe, $fmanager;

	$dir = $mainframe->getCfg('absolute_path').'/components/com_akforms';
	$adir = $mainframe->getCfg('absolute_path').'/administrator/components/com_akforms';

    if (file_exists($mainframe->getCfg('absolute_path').'/includes/adodb/adodb-xmlschema03.inc.php')) {
    	require_once($mainframe->getCfg('absolute_path').'/includes/adodb/adodb-xmlschema03.inc.php');
    	$schemafile = $adir.'/schema/schema03.xml';
    } else {
    	require_once($mainframe->getCfg('absolute_path').'/includes/adodb/adodb-xmlschema.inc.php');
    	$schemafile = $adir.'/schema/schema.xml';
    }

    $schema = new adoSchema($database->_resource);
    $schema->ContinueOnError(true);
    $schema->SetPrefix($mainframe->getCfg('dbprefix'));
    $schema->ParseSchema($schemafile);
    $schema->ExecuteSchema();

    $database->setQuery("UPDATE #__components SET admin_menu_img = '../administrator/components/com_akforms/images/forms16.png' WHERE admin_menu_link='option=com_akforms'");
    $database->query();

	$seosource = $adir.'/includes/seopro.com_akforms.php';
	$seodest = $mainframe->getCfg('absolute_path').'/includes/seopro/com_akforms.php';

	$seook = 1;
	if (!file_exists($seodest)) {
		$seook = $fmanager->copyFile($seosource, $seodest);
	}

	echo '<div style="background-color: #edfae0; border: 1px dashed #4f8a16; color: #4f8a16; font-weight: bold; font-size: 16px; padding: 10px; margin: 20px;">Component AkForm installed successfully!</div>'._LEND;
	if (!$seook) {
		echo '<div style="border: 1px dashed #CC0000; margin: 20px; padding: 10px; background-color: #fbe3e3; color: #CC0000;">'._LEND;
		echo 'Could not copy <strong>SEO PRO extension</strong> (seopro.com_akforms.php) to folder <strong>includes/seopro/</strong><br />'._LEND;
		echo 'You must manually copy and paste the file to the includes/seopro/ directory and rename it to <strong>com_akforms.php</strong>'._LEND;
		echo "</div>\n";
	}

}

?>