<?php 
/**
* @version: 1.2
* @copyright: Copyright (C) 2008-2009 Is Open Source. All rights reserved.
* @package: Elxis
* @subpackage: Component NewsLetter
* @author: Ioannis Sannos (Is Open Source)
* @link: http://www.isopensource.com
* @email: info@isopensource.com
* @license: http://creativecommons.org/licenses/by-sa/3.0/ Creative Commons Attribution-Share Alike 3.0
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


function com_install() {
	global $database, $mainframe, $fmanager;

    $database->setQuery("UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/mail.png' WHERE parent='0' AND name = 'IOS Newsletter'");
    $database->query();
    $database->setQuery("UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/controlpanel.png' WHERE admin_menu_link='option=com_newsletter' AND name='Control Panel'");
    $database->query();
    $database->setQuery("UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/config.png' WHERE admin_menu_link='option=com_newsletter&task=config&hidemainmenu=1' AND name='Configure'");
    $database->query();
    $database->setQuery("UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/users.png' WHERE admin_menu_link='option=com_newsletter&task=subscribers'");
    $database->query();
    $database->setQuery("UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/messaging.png' WHERE admin_menu_link='option=com_newsletter&task=newsletters'");
    $database->query();
    $database->setQuery("UPDATE #__components SET admin_menu_img = 'js/ThemeOffice/restore.png' WHERE admin_menu_link='option=com_newsletter&task=import'");
    $database->query();

	$adir = $mainframe->getCfg('absolute_path').'/administrator/components/com_newsletter';

    if (file_exists($mainframe->getCfg('absolute_path').'/includes/adodb/adodb-xmlschema03.inc.php')) {
    	require_once($mainframe->getCfg('absolute_path').'/includes/adodb/adodb-xmlschema03.inc.php');
    	$schemafile = $adir.'/schema/nlschema03.xml';
    } else {
    	require_once($mainframe->getCfg('absolute_path').'/includes/adodb/adodb-xmlschema.inc.php');
    	$schemafile = $adir.'/schema/nlschema.xml';
    }

    $schema = new adoSchema($database->_resource);
    $schema->ContinueOnError(true);
    $schema->SetPrefix($mainframe->getCfg('dbprefix'));
    $schema->ParseSchema($schemafile);
    $schema->ExecuteSchema();

	$fmanager->spChmod($adir.'/htmlfiles/', '0777');
	$fmanager->spChmod($adir.'/htmlfiles/elxis-news.html', '0666');
	$fmanager->spChmod($adir.'/htmlfiles/elxis-news2.html', '0666');

	$seosource = $adir.'/includes/seopro.com_newsletter.php';
	$seodest = $mainframe->getCfg('absolute_path').'/includes/seopro/com_newsletter.php';

	$seook = 1;
	if (!file_exists($seodest)) {
		$seook = $fmanager->copyFile($seosource, $seodest);
	}

	echo '<div style="background-color: #edfae0; border: 1px dashed #4f8a16; color: #4f8a16; font-weight: bold; font-size: 16px; padding: 10px; margin: 20px;">Component IOS Newsletter installed successfully!</div>'._LEND;
	if (!$seook) {
		echo '<div style="border: 1px dashed #CC0000; margin: 20px; padding: 10px; background-color: #fbe3e3; color: #CC0000;">'._LEND;
		echo 'Could not copy <strong>SEO PRO extension</strong> (seopro.com_newsletter.php) to folder <strong>includes/seopro/</strong><br />'._LEND;
		echo 'You must manually copy and paste the file to the includes/seopro/ directory and rename it to <strong>com_newsletter.php</strong>'._LEND;	
		echo "</div>\n";
	}

}

?>