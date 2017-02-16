<?php 
/**
* @version: $Id$
* @copyright: (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Administration Templates / Magnet
* @author: Ioannis Sannos (datahell)
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @description: Magnet is an administration template for Elxis 2008/2009.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//$tstart = mosProfiler::getmicrotime();
//if (!defined(_GEM_RTL)) { define('_GEM_RTL', 0); }
$rtl = (_GEM_RTL == 1) ? ' dir="rtl"' : '';
echo '<?xml version="1.0" encoding="UTF-8"?>'._LEND;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $adminLanguage->A_XML_LANGUAGE; ?>" xml:lang="<?php echo $adminLanguage->A_XML_LANGUAGE; ?>"<?php echo $rtl; ?>>
<head>
<title><?php echo $mainframe->getPageTitle().' - '.$adminLanguage->A_ADMINISTRATION; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="Generator" content="Elxis - (C) Copyright 2006-<?php echo date('Y'); ?> Elxis.org.  All rights reserved." />
<meta name="Author" content="Elxis Team" />
<link rel="stylesheet" href="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/templates/admin/magnet/css/template_css<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/templates/admin/magnet/css/theme<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.css" type="text/css" />
<!--[if IE]>
<link rel="stylesheet" href="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/templates/admin/magnet/css/ie.css" type="text/css" />
<![endif]-->
<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/includes/js/JSCookMenu.js"></script>
<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/includes/js/ThemeOffice/theme<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.js"></script>
<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/includes/js/elxis.js"></script>
<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/includes/js/prototype.js"></script>
<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/includes/js/ajax_new.js"></script>
<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/includes/js/logout.js"></script>
<?php 
if (($mainframe->_head['custom']) && (count($mainframe->_head['custom']) > 0)) {
	foreach ($mainframe->_head['custom'] as $chtml) {
		echo $chtml."\n";
	}
}
include_once($mainframe->getCfg('absolute_path').'/editor/editor.php');
initEditor();

if ((isset($_REQUEST['option'])) && ($_REQUEST['option'] == 'com_access')) {
    echo '<script type="text/javascript" src="'.$mainframe->getCfg('live_site').'/administrator/includes/js/DynamicOptionList.js"></script>'._LEND;
    $loadinit = "initDynamicOptionLists(); ";
} else { $loadinit = ''; }
?>
</head>
<body onload="<?php echo $loadinit; ?>MM_preloadImages('images/help_f2.png','images/archive_f2.png','images/back_f2.png','images/cancel_f2.png','images/delete_f2.png','images/edit_f2.png','images/new_f2.png','images/preview_f2.png','images/publish_f2.png','images/save_f2.png','images/unarchive_f2.png','images/unpublish_f2.png','images/upload_f2.png')">
<div id="elx_overlay" style="display:none;"></div>
<div id="aLogoutBox" class="elx_lightbox" style="display:none;"></div>
<div id="wrapper">
    <div id="header">
    	<div id="elxis">
        <img src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/templates/admin/magnet/images/header_text2.jpg" alt="Elxis <?php echo $adminLanguage->A_ADMINISTRATION; ?>" border="0" /> 
        	<?php 
            if ((!isset($_REQUEST['hidemainmenu'])) || ($_REQUEST['hidemainmenu'] =='0')) {
            	echo '<div id="topheader">'._LEND;
            	mosLoadAdminModule( 'alanguage' );
            	echo ' <a href="javascript:void(0);" onclick="javascript: showLightBox(\'aLogoutBox\');" title="'.$adminLanguage->A_LOGOUT.' '.$my->username.'"><img src="images/exit.png" border="0" alt="'.$adminLanguage->A_LOGOUT.'" align="top" /></a>'._LEND;
                echo "</div>\n";
            }
            ?>
        </div>
    </div>
</div>
<?php if (!mosGetParam( $_REQUEST, 'hidemainmenu', 0 )) { ?>
	<table class="menubar" width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td class="menubackgr"><?php mosLoadAdminModule( 'fullmenu' ); ?></td>
			<td class="menubackgr" align="<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>">
				<div id="wrapper1">
					<a href="index2.php?option=com_admin&task=help" title="<?php echo $adminLanguage->A_HELP; ?>">
						<img src="images/help22.png" border="0" alt="<?php echo $adminLanguage->A_HELP; ?>" align="texttop" />
					</a>
					<?php mosLoadAdminModules( 'header', 2 ); ?>
				</div>
			</td>
			<td class="menubackgr" style="width: 15px;">&nbsp;</td>
		</tr>
	</table>
<?php } ?>
<table class="menubar" width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="menudottedline" width="40%">
    		<?php mosLoadAdminModule( 'pathway' ); ?>
		</td>
		<td class="menudottedline" align="<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>">
			<?php mosLoadAdminModule( 'toolbar' ); ?> 
		</td>
		<td class="menudottedline" width="10">&nbsp;</td>
	</tr>
	<tr>
		<td class="curve_out" colspan="3">&nbsp;</td>
	</tr>
</table>

<?php mosLoadAdminModule( 'mosmsg' ); ?>
<div align="center">
	<div class="main">
		<table width="100%" border="0">
		<tr>
			<td valign="middle" align="center">
			<?php 
			//Show list of items to edit or delete or create new
			if ($path = $mainframe->getPath('admin')) {
				require($path);
			} else {
				echo '<img src="images/logo.png" border="0" alt="Elxis Logo" /><br />';
			}
			?>
			</td>
		</tr>
		</table>
	</div>
</div>

<table width="99%" border="0">
	<tr>
		<td align="center">
		<?php 
		global $_VERSION;
		if (!preg_match('/elXis/i', $_VERSION->COPYRIGHT)) { die ('E'.'L'.'X'.'I'.'S L'.'IC'.'EN'.'SE '.'V'.'IO'.'LA'.'T'.'IO'.'N!'); }
		echo '<div class="smallgrey" align="center">'._LEND;
		echo 'Powered by <a href="http://www.elxis.org" title="Elxis CMS" target="_blank">Elxis</a> ';
		echo 'v'.$_VERSION->RELEASE.'.'.$_VERSION->DEV_LEVEL.' - Open Source CMS<br />'._LEND;
		echo $_VERSION->COPYURL;
		echo "</div>\n";
		/*
		include ($mosConfig_absolute_path.'/includes/footer.php');
		echo '<div class="smallgrey">';
		$tend = mosProfiler::getmicrotime();
		$totaltime = ($tend - $tstart);
		printf ($adminLanguage->A_GENERATE_TIME, $totaltime);
		echo '</div>';
		*/
		?>
		</td>
	</tr>
</table>
<?php mosLoadAdminModules( 'debug' ); ?>
</body>
</html>