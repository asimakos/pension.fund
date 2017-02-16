<?php 
/**
* @version: $Id: language.php 2259 2009-02-05 20:59:44Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Languages Installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $adminLanguage;
//ensure user has access to this function
if ( !$acl->acl_check( 'administration', 'install', 'users', $my->usertype, $element . 's', 'all' ) ) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

$client = mosGetParam( $_REQUEST, 'client', '' );

switch ( $client ) {
    case 'admin':
    $backlink = '<a href="index2.php?option=com_languages&task=viewalangs">'.$adminLanguage->A_CMP_INST_BKLM.'</a>';
    break;
    default:
    $backlink = '<a href="index2.php?option=com_languages">'.$adminLanguage->A_CMP_INST_BKLM.'</a>';    
    break;
}

/********************************************/
/* PREPARE TO SHOW LANGUAGES FORM INSTALLER */
/********************************************/
HTML_installer::showInstallForm( $adminLanguage->A_CMP_INST_NWLA. ' <span class="small">[ '.($client == 'admin' ? $adminLanguage->A_ADMINISTRATOR : $adminLanguage->A_SITE ) .' ]</span>', $option, 'language', $client, dirname(__FILE__), $backlink );

?>
<table class="content">
<?php
writableCell('tmpr');
writableCell('language');
writableCell('administrator/language');
?>
</table>

<?php 

$edcbrowser = new edcbrowser('language');
$edcbrowser->run();

?>