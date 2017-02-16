<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. all rights reserved.
* @package: Elxis
* @subpackage: Administration
* @author: Ioannis Sannos (datahell)
* @email: datahell [at] elxis [dot] org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: This page allows you to cloak administration login page.
* @usage: 
Rename index.php to whatever you wish (ie mysecretlogin.php)
Rename this file to index.php
To login to the administration area type in the URL: http://www.mysite.com/mysecretlogin.php
*/

/** Set flag that this is a parent file */
define( '_VALID_MOS', 1 );
define( '_ELXIS_ADMIN', 1 );

require_once( '../includes/Core/security.php' );

if (!file_exists( '../configuration.php' )) {
	header( 'Location: ../installation/index.php' );
	exit();
}

require_once( '../configuration.php' );
require_once( '../includes/Core/loader.php' );

$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix, $mosConfig_dbtype );
$database->debug( $mosConfig_debug );
$acl = new gacl_api();

// mainframe is an API workhorse, lots of 'core' interaction routines
$mainframe = new mosMainFrame( $database, $option, '..', true );

header( 'Content-type: text/html; charset=utf-8' );
header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
header( 'Cache-Control: no-store, no-cache, must-revalidate' );
header( 'Cache-Control: post-check=0, pre-check=0', false );
header( 'Pragma: no-cache' );

initGzip();

$path = $mainframe->getCfg('absolute_path').'/administrator/templates/login/';

if (file_exists($path.$mainframe->getLoginScreen().'/hidden.php')) {
    require_once( $path.$mainframe->getLoginScreen().'/hidden.php' );
} else if (file_exists($path.'econnect/hidden.php')) {
    require_once( $path.'econnect/hidden.php' );
} else {
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $adminLanguage->A_XML_LANGUAGE; ?>" xml:lang="<?php echo $adminLanguage->A_XML_LANGUAGE; ?>">
    <head>
        <title><?php echo $mainframe->getCfg('sitename').' :: '.$adminLanguage->A_ADMINISTRATION; ?></title>
        <meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
        <meta name="Generator" content="Elxis - Copyright (C) 2006-<?php echo date('Y'); ?> Elxis.org. All rights reserved." />
        <meta name="robots" content="noindex,nofollow" />
        <style type="text/css">
            body {
                margin: 0;
                color : #000000;
                background-color: #FFFFFF;
                font-family: Tahoma, Verdana, sans-serif;
                font-size: 0.9em;
            }
            a {
                color: #951F23;
                text-decoration: none;
            }
            a:hover, a:active {
                text-decoration : underline;
            }
            .container {
                width: 100%;
                text-align: center;
                margin-top: 50px;
            }
            .small, a.small {
                font-family: Verdana, Tahoma, sans-serif;
                font-size: 0.7em;
            }
            h2 {
                font-family: sans-serif, Verdana, Tahoma;
                font-size: 1.3em;
                font-weight: bold;
                color: #B50825;
                margin: 0;
                padding: 4px;
            }
            .logincloak {
                width: 500px;
                padding: 20px;
                margin: 10px 0 50px 0;
                padding-left: 45px;
                border: 1px solid #B50825;
                background: #FFF8E0 url('images/32X32/important.png') no-repeat;
                background-position: 10px; 
            }
        </style>
    </head>
    <body>
        <div id="container" class="container">
			<a href="<?php echo $mainframe->getCfg('live_site'); ?>" target="_self" title="<?php echo $mainframe->getCfg('sitename'); ?>">
                <img src="../images/logo.png" border="0" alt="<?php echo $mainframe->getCfg('sitename'); ?>" />
            </a><br /><br />
            <h2><?php echo $mainframe->getCfg('sitename'); ?></h2>
            <div align="center">
                <div class="logincloak">
                    <strong><?php echo $adminLanguage->A_LOGIN_CLOAK; ?></strong><br />
                    <?php echo $adminLanguage->A_LOGIN_CLOAKD; ?>
                </div>
            </div>
            <span class="small">
                <a href="http://www.elxis.org" target="_blank" title="Powered by Elxis CMS">Elxis CMS</a> &copy; 2006-<?php echo date('Y'); ?><br />
                <?php echo $adminLanguage->A_COMP_ADMIN_LICENSE; ?> 
                <a href="http://www.gnu.org/copyleft/gpl.html" target="_blank" title="GNU/GPL">GNU/GPL</a>
            </span>
        </div>
    </body>
    </html>
<?php 
}
doGzip();

//close FTP connection if we used it
$fmanager->closeFTP();
?>