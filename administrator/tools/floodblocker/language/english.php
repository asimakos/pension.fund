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
* @ Description: English language for FloodBlocker tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


DEFINE ('_FLOODL_CONFIG', 'FloodBlocker Configuration');
DEFINE ('_FLOODL_CONFPERMSUCC', 'FloodBlocker configuration file permissions set successfully to');
DEFINE ('_FLOODL_CONFPERMNO', 'Could not make writable FloodBlocker configuration file');
DEFINE ('_FLOODL_LOGSPERMSUCC', 'FloodBlocker logs directory permissions set successfully to');
DEFINE ('_FLOODL_LOGSPERMNO', 'Could not make writable FloodBlocker logs directory');
DEFINE ('_FLOODL_INVINTER', 'Invalid Cron Interval!');
DEFINE ('_FLOODL_INVTIME', 'Invalid Logs timeout!');
DEFINE ('_FLOODL_ONEPAIR', 'You must give at least one valid interval-limit pair!');
DEFINE ('_FLOODL_CONFSAVESUCC', 'FloodBlocker configuration file saved successfully!');
DEFINE ('_FLOODL_CONFSAVENO', 'Could not save FloodBlocker configuration file!');
DEFINE ('_FLOODL_ENABLEDESC', 'Enable flood protection or not (make sure /tools/floodblocker/logs directory is writable before enable)');
DEFINE ('_FLOODL_CRONINT', 'Cron interval');
DEFINE ('_FLOODL_CRONINTDESC', 'Cron execution interval in seconds. 1800 secs (30 mins) by default');
DEFINE ('_FLOODL_LOGSTIME', 'Logs timeout');
DEFINE ('_FLOODL_LOGSTIMEDESC', 'After how many seconds to consider logs file as old? By default the files will consider as old after 7200 secs (2 hours)');
DEFINE ('_FLOODL_FLOODRULES', 'FloodBlocker Rules');
DEFINE ('_FLOODL_INTSECS', 'Interval (seconds)');
DEFINE ('_FLOODL_LIMREQS', 'Limit (requests)');
DEFINE ('_FLOODL_FLOODCONFIS', 'FloodBlocker configuration file is');
DEFINE ('_FLOODL_FLOODLOGSIS', 'FloodBlocker logs directory is');
DEFINE ('_FLOODL_MAKEWRITE', 'Make it writable');
DEFINE ('_FLOODL_PAIRSDESC', 'An associative array of {INTERVAL} => {LIMIT} format, 
	where {LIMIT} is the number of possible requests during {INTERVAL} seconds. 
	Use as many pairs as you wish. Indicatory rules:<br>
	&nbsp; &nbsp; - rule 1: 10=>10 (maximum 10 requests in 10 secs)<br>
	&nbsp; &nbsp; - rule 2: 60=>30 (maximum 30 requests in 60 secs)<br>
	&nbsp; &nbsp; - rule 3: 300=>50 (maximum 50 requests in 300 secs)<br>
	&nbsp; &nbsp; - rule 4: 3600=>200 (maximum 200 requests in 1 hour)<br><br>
	6 Rules maximum');
DEFINE ('CX_LFLOODBD', 'FloodBlocker prevents flood attacks on your Elxis site.');

?>
