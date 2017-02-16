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
* @ Description: English language for Defender tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


DEFINE ('_DEFL_CONFIG', 'Elxis Defender Configuration');
DEFINE ('_DEFL_CONFPERMSUCC', 'Defender configuration file permissions set successfully to');
DEFINE ('_DEFL_CONFPERMNO', 'Could not make writable Defender configuration file');
DEFINE ('_DEFL_LOGSPERMSUCC', 'Defender logs directory permissions set successfully to');
DEFINE ('_DEFL_LOGSPERMNO', 'Could not make writable Defender logs directory');
DEFINE ('_DEFL_ENABLEDESC', 'Enable Defender or not (make sure /administrator/tools/defender/logs directory is writable before enable)');
DEFINE ('_DEFL_PROTVARS', 'Protected Variables');
DEFINE ('_DEFL_PROTVARSD', 'Select type of variables to be protected (default: REQUEST)');
DEFINE ('_DEFL_LOGATTACKS', 'Log Attacks');
DEFINE ('_DEFL_LOGATTACKSD', 'If enabled, Defender will create and log a report for every attack');
DEFINE ('_DEFL_MAILALERT', 'Mail Alert');
DEFINE ('_DEFL_MAILALERTD', 'If enabled, Defender will send an E-mail alert for every attack');
DEFINE ('_DEFL_MAILADDR', 'Notification e-mail address');
DEFINE ('_DEFL_SITEOFFFOR', 'Site Offline for');
DEFINE ('_DEFL_SECONDS', 'seconds');
DEFINE ('_DEFL_SITEOFFD', 'After an attack turn site offline for X seconds. 0 to disable');
DEFINE ('_DEFL_BLOCKIP', 'Block IP');
DEFINE ('_DEFL_BLOCKIPD', 'Block attacker IP address. Note that Defender will block anyone considered as attacker, even yourself!');
DEFINE ('_DEFL_FILTERS', 'Filters');
DEFINE ('_DEFL_FILTHELP', '<b>Elxis Defender is useless withour filters.</b><br />
	To add a new filter, type the word or phrase that you want to filter-out in the add field and click <b>Add</b>.<br />
	Dont bother to write in uppercase or lowercase.<br />
	Press <b>DEL</b> to remove a filter from the List.<br />
	If you are familiar with Apache\'s <b>mod_Security</b> keep in mind that Elxis Defender functions more or less in the same way, 
	when adding filters.<br />
	When finished, click <b>Save</b> to save Defender configuration and filters.<br />');
DEFINE ('_DEFL_SLOWDOWNT', 'Slow-down Time');
DEFINE ('_DEFL_SLOWDOWN', 'The use of the Defender makes Elxis run slower than usual. 
	Adding too many filters may increase php execution time too much. We advise you not to add more than 15 filters but 
	we also prompt you to experiment on this as it depends on the Website and the Server. 
	Call an except for help if you are facing difficulties. 
	Our lab-tests showed slow-down time from <b>0.1 to 27 msec</b> depending on the number of filters (from 10 up to 30) 
	and input variables that the Defender had to deal with (from normal browsing, to submiting large articles via POST or GET method).');
DEFINE ('_DEFL_EXAMPLEFIL', 'Example Filters');
DEFINE ('_DEFL_DEFCONFIS', 'Defender configuration file is');
DEFINE ('_DEFL_DEFLOGSIS', 'Defender logs directory is');
DEFINE ('_DEFL_MAKEWRITE', 'Make it writable');
DEFINE ('_DEFL_CONFSAVESUCC', 'Defender configuration saved successfully!');
DEFINE ('_DEFL_CONFSAVENO', 'Could not save Defender configuration!');
DEFINE ('_DEFL_ERRONEFILT', 'Error: You must add at least one filter!');
DEFINE ('_DEFL_ENCKEY', 'Encryption Key');
DEFINE ('_DEFL_ENCKEYD', 'Used to encrypt logged information. Key length must be between 8 and 32 characters. Delete all logged information before changing the encryption key!');
DEFINE ('_DEFL_ERRENCKEY', 'Error: Encryption key length must be between 8 and 32 characters');
DEFINE ('_DEFL_ENABLEDEF', 'Enable Defender');
DEFINE ('_DEFL_DISABLEDEF', 'Disable Defender');
DEFINE ('_DEFL_VIEWLOGS', 'View Logs');
DEFINE ('_DEFL_CLEARLOGS', 'Clear Logs');
DEFINE ('_DEFL_VIEWBLOCK', 'View Blocked IPs');
DEFINE ('_DEFL_CLEARBLOCK', 'Clear Blocked IPs');
DEFINE ('_DEFL_DEFENDER', 'Elxis Defender');
DEFINE ('_DEFL_LOGSCLEARED', 'Logs cleared');
DEFINE ('_DEFL_CNOTCLLOGS', 'Could not clear logs. Make sure file is writable.');
DEFINE ('_DEFL_BLOCKCLEARED', 'All blocked IP address deleted successfully');
DEFINE ('_DEFL_CNOTCLBLOCK', 'Count not clear blocked IP Addresses. Make sure file is writable.');
DEFINE ('_DEFL_SUBMITALERT', 'Submiting filters while the Defender is enabled, will be considered as an attack! Please first disable Defender, make your changes and re-enable it');
DEFINE ('_DEFL_GEOLOCATE', 'Geo Locate');
DEFINE ('_DEFL_PERMSUCC', 'Permissions changed to');
DEFINE ('_DEFL_PERMFAIL', 'Could not change permissions of');
DEFINE ('_DEFL_ADDIP', 'Add IP');
DEFINE ('_DEFL_DELETEIP', 'Delete IP');
DEFINE ('_DEFL_BLOCKEDIPS', 'Blocked IPs');
DEFINE ('_DEFL_IPRANGES', 'IP Ranges');
DEFINE ('_DEFL_ADDRANGE', 'Add IP range');
DEFINE ('_DEFL_DELRANGE', 'Delete IP range');
DEFINE ('_DEFL_RANGEHELP', 'To block an entire network, internet provider or even a country Defender gives 
you the option to add IP ranges. Each range consist of 2 parts seperated with undescore (_). The first part 
is the start ip address and the second the end ip address. Defender will block any ip between these 2 values.');
DEFINE ('_DEFL_RANGEEXAMPLES', 'Usage examples');
DEFINE ('_DEFL_BLOCKFROM', 'will block IPs from');
DEFINE ('_DEFL_BLOCKTO', 'to');
DEFINE ('_DEFL_ALLOWIPS', 'Allowed IP addresses');
DEFINE ('_DEFL_ALLOWIPSD', 'If enabled you will be able to set the IP addresses that will be only allowed to access backend and/or frontend site');
DEFINE ('_DEFL_FRONTBACK', 'Frontend and Admin.');
DEFINE ('_DEFL_ALLOWDIS', 'Allowed IPs is disabled');
DEFINE ('_DEFL_ONLACCADM', 'Only the IP addresses bellow have access to Administration');
DEFINE ('_DEFL_ONLACCSAD', 'Only the IP addresses bellow have access to Site Frontend and Administration');

?>
