<?php 
/**
* @ Version: $Id: mod_unread.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Module Unread
* @ Author: Elxis Team
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $adminLanguage, $my;

$database->setQuery( "SELECT COUNT(*) FROM #__messages WHERE state='0' AND user_id_to='".$my->id."'" );
$unread = intval($database->loadResult());

if ($unread) {
	echo '<strong>'.$unread.'</strong> <a href="index2.php?option=com_messages" title="'.$adminLanguage->A_MAIL.' - '.$adminLanguage->A_NEW.'"><img src="images/mail.png" border="0" title="'.$adminLanguage->A_MAIL.'" align="middle" /></a>'._LEND;
} else {
    echo $unread.' <a href="index2.php?option=com_messages" title="'.$adminLanguage->A_MAIL.'"><img src="images/nomail.png" border="0" title="'.$adminLanguage->A_MAIL.'" align="middle" /></a>'._LEND;
}
?>