<?php 
/**
* @ Version: 2008.0
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Elxis Team
* @ Translator: Ioannis Sannos
* @ Translator URL: http://www.elxis.org
* # Translator E-mail: info@elxis.org
* @ Description: English language for Chmod tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


define('_CMOD_CHMOD', 'Change mode');
define('_CMOD_PATH', 'Path');
define('_CMOD_MSGSERVER', 'Message from Server');
define('_CMOD_PATHNOTEXIST', 'Path does not exist!');
define('_CMOD_PATHNOTELXIS', 'Given path does not belong to Elxis!');
define('_CMOD_NOTALLOWED1', 'You are not allowed to change mode to');
define('_CMOD_NOTALLOWED2FI', 'to a file.<br>Problems will occur accessing the file.');
define('_CMOD_NOTALLOWED2FO', 'to a folder.<br>Problems will occur accessing the folder.');
define('_CMOD_CHMODSUCC', 'Mode changed successfully to');
define('_CMOD_CHMODCNOT', 'Could not change mode to');
define('_CMOD_ONLYUNIX', 'Αvailable only for UNIX');
define('_CMOD_LOAD', 'Load');
define('_CMOD_CHMODTO', 'Chmod to');
define('_CMOD_OWNER', 'Owner');
define('_CMOD_READ', 'Read');
define('_CMOD_WRITE', 'Write');
define('_CMOD_EXECUTE', 'Execute');
define('_CMOD_USER', 'user');
define('_CMOD_GROUP', 'group');
define('_CMOD_WORLD', 'world');
define('_CMOD_SHOWHELP', 'Show Help');
define('_CMOD_HIDEHELP', 'Hide Help');
define('_CMOD_HELPTEXT', 'Write the full path to an existing Elxis file or folder. 
	Press Load if you want to see the existing permissions and owner for the given path. 
	Change mode to the given path by pressing the CHMOD button. Feature available only for Unix systems.
	<br /><br />We recommend you using the following permissions:<br />
	writable folders: 0777, unwritable folders: 0755, writable files: 0666, unwritable files: 0644');

?>
