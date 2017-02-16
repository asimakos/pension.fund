<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: eConnect login screen
* @author: Elxis Team
* @email: info [at] elxis [dot] org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


include($mainframe->getCfg('absolute_path').'/administrator/templates/login/econnect/helper.php');

$econ_rtlsfx = (_GEM_RTL == 1)  ? '-rtl' : '';
$econ_dir = (_GEM_RTL == 1) ? 'right' : 'left';

$tstart = mosProfiler::getmicrotime();
$rtl = (defined('_GEM_RTL') && (_GEM_RTL == 1)) ? ' dir="rtl"' : '';
if (!defined('_FORM_ACTION')) { define('_FORM_ACTION', 'index.php'); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $adminLanguage->A_XML_LANGUAGE; ?>" xml:lang="<?php echo $adminLanguage->A_XML_LANGUAGE; ?>"<?php echo $rtl; ?>>
<head>
<title><?php echo $mainframe->getCfg('sitename').' - '.$adminLanguage->A_ADMINISTRATION; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="Generator" content="Elxis CMS (C) Copyright 2006-<?php echo date('Y'); ?> Elxis.org. All rights reserved." />
<meta name="robots" content="noindex, nofollow" />
<link rel="stylesheet" href="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/administrator/templates/login/econnect/css/template_css.css" type="text/css" media="all" />
</head>
<body>
<div id="container">
<div class="wrapform">

	<div class="cloak_box">
		<h3 class="connect_title<?php echo $econ_rtlsfx; ?>"><?php echo $adminLanguage->A_ADMINISTRATION; ?></h3>
		<div class="cloak_title"><?php echo $adminLanguage->A_LOGIN_CLOAK; ?></div>
		<p><?php echo $adminLanguage->A_LOGIN_CLOAKD; ?></p>
	</div>

	<div class="lang_box">
		<h3 class="connect_language"><?php echo $adminLanguage->A_LANGUAGE; ?></h3>
		<div class="current_lang">
			<img src="<?php echo econnect_flag($alang); ?>" alt="<?php echo $alang; ?>" border="0" align="top" /> <?php echo econnect_langname($alang); ?>
		</div>
		<div class="picklang_box">
<?php
	    $adLangs = $elxis_language->displayLangs();
	    asort($adLangs);
		foreach ($adLangs as $langx) {
			$langname = econnect_langname($langx);
	        echo '<a href="'._FORM_ACTION.'?mylang='.$langx.'" title="'.$langname.'" class="langlink'.$econ_rtlsfx.'">';
	        echo '<img src="'.econnect_flag($langx).'" border="0" alt="'.$langx.'" align="top" />'."</a>\n";
	    }
?>
			<div style="clear: both;"></div>
		</div>
	</div>
	<div style="clear: both;"></div>
</div>

<?php
/*
    <div class="cloak-title"><?php echo $adminLanguage->A_LOGIN_CLOAK; ?></div>
    <div class="cloak-desc"><?php echo $adminLanguage->A_LOGIN_CLOAKD; ?></div>
    <div class="flags">
	<?php
	    $adLangs = $elxis_language->displayLangs();
	    $flgdir = '/administrator/templates/login/olympus/images/flags/';
		foreach ($adLangs as $langx) {
	        echo '<a href="index.php?mylang='.$langx.'" title="'.$langx.'">';
			if (file_exists($mosConfig_absolute_path.$flgdir.$langx.'.png')) {                        
	            echo '<img src="'.$mosConfig_live_site.$flgdir.$langx.'.png" border="0" alt="'.$langx.'" />';
	        } else {
				echo $langx;
			}
			echo '</a> '._LEND;
	    }
	?>
	</div>
*/
?>

<div id="footer">
	<div style="padding: 0; width: 450px; margin: 0 auto;">
		<a href="http://www.elxis.org/" title="Elxis CMS" class="footer_link" onmouseover="switchimg(1);" onmouseout="switchimg(0);">
			<img id="elxislogo" src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/administrator/templates/login/econnect/images/elxis_off.png" border="0" alt="Elxis CMS" align="<?php echo $econ_dir; ?>" /> 
			Powered by Elxis open source CMS.<br />
			Copyright (c) 2006-<?php echo date('Y'); ?> elxis.org. All rights reserved.
		</a>
	</div>
</div>
</div>
</body>
</html>