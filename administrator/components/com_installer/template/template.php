<?php 
/**
* @version: $Id: template.php 2259 2009-02-05 20:59:44Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Templates Installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//ensure user has access to this function
if ( !$acl->acl_check( 'administration', 'install', 'users', $my->usertype, $element . 's', 'all' ) ) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

global $fmanager;

$client = mosGetParam( $_REQUEST, 'client', '' );

$userfile = mosGetParam( $_REQUEST, 'userfile', dirname( __FILE__ ) );
$userfile = $fmanager->PathName( $userfile );

switch ( $client ) {
	case 'admin':
	$ititle = $adminLanguage->A_ADMINISTRATOR;
	break;
	case 'login':
	$ititle = $adminLanguage->A_MENU_LOGIN_SCREENS;
	break;
	default:
	$ititle = $adminLanguage->A_SITE;	
	break;
}

/***************************************/
/* PREPARE TO SHOW INSTALLED TEMPLATES */
/***************************************/
HTML_installer::showInstallForm( $adminLanguage->A_CMP_INST_TINS. ' <span class="small">[ '.$ititle.' ]</span>',
	$option, 'template', $client, $userfile,
	'<a href="index2.php?option=com_templates&client='.$client.'">'.$adminLanguage->A_CMP_INST_BATP.'</a>');
?>
<table class="content">
<?php
writableCell('tmpr');
writableCell('administrator/templates/admin');
writableCell('administrator/templates/login');
writableCell('templates');
?>
</table>

<?php 

$edcbrowser = new edcbrowser('template');
$edcbrowser->run();

?>