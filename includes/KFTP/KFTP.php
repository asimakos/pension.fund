<?php

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// --------------------------------------------------------------------------------------
// KioobFTP Class : FTP access interface
//
// This class allow easy use of FTP and FXP functions.
//
// There is 3 implementations of the class :
// - Classic : using the FTP extension. => less powerfull but more stable.
// - Socket : using the Socket experimental extension. => powerfull but low stability.
// - Stream : using the Stream PHP 5 functions. => powerfull and rather stable.
//
// The "Classic" implementation is limited by FTP extension possibility : hidden files
// are not visibles, FXP transfers is not possibles, and before PHP 4.3 resume are not
// possibles.
//
// author : Olivier BONVALET / bool@boolsite.net
//
// actual version : v0.8.2
//
// --------------------------------------------------------------------------------------


/* Define some constants ========================================= */
/* == you should not change its ! ================================ */

define('KFTP_Version','0.8.2');                                     // Class version

// Constants for Verbose mode
define('KFTP_Verbose',false);
define('KFTP_Quiet'  ,true);

define('KFTP_InfiniteRecurs',-1);                                   // Infinite recurse level (for functions deltree,
                                                                    // downloaddir, uploaddir, Xdownloaddir, etc).

// Constants

// Flags for readdir()
define('KFTP_AcceptPredict',1);                                     // Allow readdir to return a predicted content.
define('KFTP_NoCache',2);                                           // Force readdir to ask list to the server.


// Constants for recursive operations
define('KFTP_OnError_LookSettings',false);
define('KFTP_ContinueOnError',1);
define('KFTP_BreakOnError',2);

// Overwrite rules
define('KFTP_OR_LookSettings',false);
define('KFTP_OR_Overwrite',1);
define('KFTP_OR_Skip',2);
//define('KFTP_OR_Rename',3);                                       // actually not supported
define('KFTP_OR_Resume',4);
define('KFTP_OR_OverwriteIfNewer',5);
define('KFTP_OR_OverwriteIfDifferentSize',6);
define('KFTP_OR_OverwriteIfDifferentSizeOrNewer',7);


// Synchronization option, for non common files
define('KFTP_Synchro_Ignore',1);
define('KFTP_Synchro_Transfer',2);
define('KFTP_Synchro_Erase',3);

// if the PHP's extension FTP is not loaded, we definite constants
if(!defined('FTP_ASCII')) define('FTP_ASCII',1);                    // Ascii/text transfer mode
if(!defined('FTP_TEXT')) define('FTP_TEXT',FTP_ASCII);

if(!defined('FTP_BINARY')) define('FTP_BINARY',2);                  // Binary/image transfer mode
if(!defined('FTP_IMAGE')) define('FTP_IMAGE',FTP_BINARY);

define('FTP_AUTO',5);                                               // Automatic transfer mode

// Time precision constants
define('KFTP_TimPrec_NotFound',false);
define('KFTP_TimPrec_Hour',1);
define('KFTP_TimPrec_Day',2);

// Operating system constants
define('KFTP_OS_Unix','u');
define('KFTP_OS_Windows','w');
define('KFTP_OS_Mac','m');

// this option is used to allow the error tracking in the class
ini_set('track_errors',1);

$GLOBALS['KFTP_Conf']=array();

// this function try to determine the local operating system, to ascii file conversion
function KFTP_Detect_Local_OS(){
    $path=getcwd();$len=strlen($path);

    if($len>=3 and $path{1}===':')
        return KFTP_OS_Windows;

    if(!function_exists('posix_uname'))
        return KFTP_OS_Unix;

    $uname=posix_uname();
    if(is_array($uname) and isset($uname['sysname'])
        and strpos('mac',strtolower($uname['sysname']))!==false)
            return KFTP_OS_Mac;

    return KFTP_OS_Unix;
    }

$GLOBALS['KFTP_Conf']['Local_OS']=KFTP_Detect_Local_OS();

// Before PHP 4.3 the ASCII transfer under Win32 doesn't work
// properly (a BINARY transfer is done). So, we'll simulate it.

$GLOBALS['KFTP_Conf']['Simul_Ascii']= ($GLOBALS['KFTP_Conf']['Local_OS']===KFTP_OS_Windows and phpversion()<'4.3');

// Before PHP 4.2, we have to determine the path where scripts
// are to allow there inclusion.

$GLOBALS['KFTP_Conf']['Path']= dirname(__FILE__);

// List of new line codes, depending of the operating system
$GLOBALS['KFTP_Conf']['New_Line']=array(
    // the order is very important for str_replace
    KFTP_OS_Windows => "\r\n",
    KFTP_OS_Unix => "\n",
    KFTP_OS_Mac => "\r",
    );

// List names of transfer modes
$GLOBALS['KFTP_Conf']['Transfer_Name']=array(
    FTP_ASCII => 'ASCII',
    FTP_BINARY => 'BINARY',
    FTP_AUTO => 'AUTO',
    );

// Set rawlist parser model
$GLOBALS['KFTP_Conf']['Rawlist_Model']=array(
    'is_dir'=>false,
    'permission'=>false,
    'sub_dir'=>false,
    'group'=>false,
    'domain'=>false,
    'owner'=>false,
    'size'=>false,
    'date'=>false,
    'time'=>false,
    'time_precision'=>false,
    );


/* Load the config file ========================================== */

require_once $GLOBALS['KFTP_Conf']['Path'].'/KFTP_config.php';

//bypass open_basedir restriction (added by Ioannis Sannos for Elxis 2008.1)
if (isset($_GLOBALS['mosConfig_absolute_path']) && ($_GLOBALS['mosConfig_absolute_path'] != '')) {
	$GLOBALS['KFTP_Conf']['Tmp_Dir'] = str_replace('\\', '/', $_GLOBALS['mosConfig_absolute_path'].'/tmpr/');
} else { //elxis installation (mosConfig_absolute_path has not yet been set)
	$elxis_root = str_replace( '/includes/KFTP', '', str_replace( DIRECTORY_SEPARATOR, '/', dirname(__FILE__) ) );
	$GLOBALS['KFTP_Conf']['Tmp_Dir'] = $elxis_root.'/tmpr/';
	unset($elxis_root);
}


if (!$GLOBALS['KFTP_Conf']['Tmp_Dir']) {
    $tmp=tempnam(false,'kftp');
    unlink($tmp);
    $tmp=dirname($tmp);
    if($tmp==='\\') {
        $tmp=@$_ENV['TEMP'];
    }
    $GLOBALS['KFTP_Conf']['Tmp_Dir']=$tmp.'/KFTP'; //ELXIS NOTE: needs backslash for windows
}
if (!is_dir($GLOBALS['KFTP_Conf']['Tmp_Dir'])) {
    if (!@mkdir($GLOBALS['KFTP_Conf']['Tmp_Dir'])) {
      //  trigger_error('KFTP : can\'t initialize temp directory "'.$GLOBALS['KFTP_Conf']['Tmp_Dir'].'" : '.@$php_errormsg);
    }
}

/* Load the BasicKFTP implementation ============================= */

$GLOBALS['KFTP_Conf']['implementation']='Classic';
if(KFTP_UseSocks) {
    if (function_exists('stream_socket_client')) {
        $GLOBALS['KFTP_Conf']['implementation']='Stream';
    } elseif (function_exists('socket_create')) {
        $GLOBALS['KFTP_Conf']['implementation']='Socket';
    }
}

require_once 'KFTP_Basic_'.$GLOBALS['KFTP_Conf']['implementation'].'.php';


/* Load KFTP ===================================================== */

require_once 'KFTP_Main.php';

?>