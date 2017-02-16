<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Auth
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$elxis_root = str_replace('/administrator/includes', '', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));
require($elxis_root.'/configuration.php');

if (!defined('_MOS_ELXIS_INCLUDED')) {
	require($elxis_root.'/includes/Core/loader.php');
}

session_name(md5($mosConfig_live_site));
session_start();
//restore some session variables
if (!isset($my)) {
	$my = new mosUser( $database );
}

$my->id = mosGetParam( $_SESSION, 'session_user_id', '' );
$my->username = mosGetParam( $_SESSION, 'session_username', '' );
$my->usertype = mosGetParam( $_SESSION, 'session_usertype', '' );
$my->gid = mosGetParam( $_SESSION, 'session_gid', '' );
$my->allowed = mosGetParam( $_SESSION, 'session_allowed', '' );

$session_id = mosGetParam( $_SESSION, 'session_id', '' );
$logintime = mosGetParam( $_SESSION, 'session_logintime', '' );

if ($session_id != md5( $my->id.$my->username.$my->usertype.$logintime )) {
	mosRedirect($mosConfig_live_site);
	die();
}
?>