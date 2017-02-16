<?php 
/**
* @ Version: $Id: mod_online.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Modules / Online
* @ Author: Elxis Team
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $adminLanguage;

$database->setQuery("SELECT userid FROM #__session WHERE userid != 0 GROUP BY userid");
$users_num = count($database->loadResultArray());

$database->setQuery("SELECT COUNT(session_id) FROM #__session WHERE userid = 0 GROUP BY ip");
$visitors_num = count($database->loadResultArray());

$online_num = $users_num + $visitors_num;

echo '<span title="'.$adminLanguage->A_USERSONLINE.'"><strong>'.$online_num.'</strong> ('.$users_num.'/'.$visitors_num.') <img src="images/users.png" border="0" align="top" alt="'.$adminLanguage->A_USERSONLINE.'" /></span>'._LEND;

?>