<?php 
/**
* @version: $Id: bridge.php 2259 2009-02-05 20:59:44Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @description: Bridges Installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $adminLanguage;
if ( !$acl->acl_check( 'administration', 'install', 'users', $my->usertype, $element . 's', 'all' ) ) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

global $fmanager;
$client = 'front';
$userfile = mosGetParam( $_REQUEST, 'userfile', dirname( __FILE__ ) );
$userfile = $fmanager->PathName( $userfile );

HTML_installer::showInstallForm( $adminLanguage->A_CMP_INST_INSBR, $option, 'bridge', 'front', $userfile, '<a href="index2.php?option=com_bridge&task=view">'.$adminLanguage->A_CMP_INST_BABR.'</a>');

?>
<table class="content">
<?php
writableCell('tmpr');
writableCell('bridges');
?>
</table>
<?php

$edcbrowser = new edcbrowser('bridge');
$edcbrowser->run();

?>