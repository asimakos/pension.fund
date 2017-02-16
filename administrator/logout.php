<?php 
/**
* @version: $Id: logout.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Administration Logout
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$logouttime = time() + ($mosConfig_offset * 3600);
$currentDate = date('Y-m-d H:i:s', $logouttime);

if (isset($_SESSION['session_user_id']) && $_SESSION['session_user_id']!="") {
	$database->setQuery( "UPDATE #__users SET lastvisitdate='".$currentDate."' WHERE id='".$_SESSION['session_user_id']."'");
	if (!$database->query()) {
        echo $database->stderr();
	}
}

if (isset($_SESSION['session_id']) && $_SESSION['session_id']!="") {
	$database->setQuery( "DELETE FROM #__session WHERE session_id='".$_SESSION['session_id']."'");
	if (!$database->query()) {
		echo $database->stderr();
	}
}

$name = "";
$fullname = "";
$id = "";
$session_id = "";

session_unregister( "session_id" );
session_unregister( "session_user_id" );
session_unregister( "session_username" );
session_unregister( "session_usertype" );
session_unregister( "session_logintime" );
session_unregister( "session_allowed" );

if (session_is_registered( "session_id" )) {
	session_destroy();
}
if (session_is_registered( "session_user_id" )) {
	session_destroy();
}
if (session_is_registered( "session_username" )) {
	session_destroy();
}
if (session_is_registered( "session_usertype" )) {
	session_destroy();
}
if (session_is_registered( "session_logintime" )) {
	session_destroy();
}
if (session_is_registered( "session_allowed" )) {
	session_destroy();
}
mosRedirect( $mosConfig_live_site );
?>