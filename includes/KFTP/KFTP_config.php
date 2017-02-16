<?php

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/*===== GLOBAL OPTIONS ===== */

define('KFTP_UseSocks', false  );                                // Try to use the sockets or stream emplementation (NOT stable).
define('KFTP_AntiIdleTime',10);                                 // Idle time before "anti-idle" use.
define('KFTP_AnonymousLogin','anonymous');                      // default anonymous login.
define('KFTP_AnonymousPass','unknown@anonymous.com');          // default anonymous pass.
define('KFTP_ConnectionRetry',2);                              // Max connexion retry.
define('KFTP_DefaultPASV', true);                              // Use or not PASSIVE mode.
define('KFTP_OnError_Default', KFTP_BreakOnError);              // Default comportement on error in recursive functions.
define('KFTP_OR_Default', KFTP_OR_Overwrite);                   // Default Overwriting Rule. Fastest is KFTP_OR_Overwrite
                                                                // because no check is needed).
define('KFTP_KeepRemoteTime', true);                            // Copy remote modification time to local remote file
                                                                // on download. (can't be used on upload and on all fxp
                                                                // transfers).

$GLOBALS['KFTP_Conf']['Tmp_Dir']='';                            // Temp directory : path where to store temporary
                                                                // files and cache files. If null, then use system
                                                                // temp dir.
$GLOBALS['KFTP_Conf']['Connection_TimeOut']= 30;                // Connection timeout.
$GLOBALS['KFTP_Conf']['Use_Cache']= true ;                      // Use or not the remote directory cache (really
                                                                // important if you use Overwrite Rules).
$GLOBALS['KFTP_Conf']['Cache_Dir_Time']=600;                    // Maximum time a directory will be cached.
$GLOBALS['KFTP_Conf']['Dirs_Mode']=0755;                        // Mode for local directory make.

$GLOBALS['KFTP_Conf']['Ascii_File_Types']=array(                // List file types for automatic ASCII transfer
    '1ST', // "ReadMe" file
    'ASP', // ASP Script
    'BAT', // BATCH Script
    'C', // C/C++ Code
    'CFM', // CFM Script
    'CONF', // Config file
    'CPP', // C/C++ Code
    'CSS', // Cascading Style Sheet
    'CSV', // CSV file
    'DHTML', // DHTML file
    'H', // C/C++ Code
    'HTM', // HTML file
    'HTML', // HTML file
    'INC', // Include file
    'INI', // Config file
    'JS', // Javascript file
    'LOG', // LOG file
    'M3U', // Playlist
    'NFO', // Info file
    'PAS', // Pascal Code
    'PATCH', // Patch Code
    'PHP', // PHP Script
    'PHP3', // PHP3 Script
    'PL', // PERL Script
    'PERL', // PERL Script
    'QMAIL', // Qmail file
    'SH', // SH Script
    'SHTML', // Secure HTML file
    'SQL', // SQL Script
    'TCL', // TCL Script
    'TXT', // Text file
    'VBS', // Visual Basic Script
    'XHTML', // XHTML File
    'XML' // XML File
    );

/*===== STREAM and SOCKET SPECIFIC OPTIONS ===== */

define('KFTP_Auto_PASV_Switch', true );                         // Auto switch PASSIVE mode if transfer failed.
                                                                // Usefull for "FXP negociation", and if user forgot
                                                                // to configure it.
define('KFTP_Force_LocalIP', false);                            // You can force the local IP for non passive transfert ;
                                                                // it is usefull if you're behind a router which doesn't
                                                                // or can't (because of SSL) correct it on the fly.
define('KFTP_Force_MinPort', 49152);                            // You can force a port range for non passive transfert ;
define('KFTP_Force_MaxPort', 65535);                            // it is usefull if your firewall or router doesn't or
                                                                // can't (because of SSL) open it on the fly.
define('KFTP_Remember_Transfert_Type', true );                  // Allow "type" caching : if the last transfer already use
                                                                // the type asked, then ignore this request.
                                                                // Maybe this don't work on some servers.

?>