<?php 
/**
* @version: $Id: contentwindow.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: PopUps
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @description: Popup window for previewing content items
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

/** Set flag that this is a parent file */
define( '_VALID_MOS', 1 );
/** Mostly used to tell loader to include adminLanguage */
define( '_ELXIS_ADMIN', 1 );

$elxis_root = str_replace('/administrator/popups', '', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));
require_once($elxis_root.'/administrator/includes/auth.php');

$iso = preg_split('/\=/', _ISO );
$rtl = (_GEM_RTL == 1) ? ' dir="rtl"' : '';
$tpl = mosGetParam($_REQUEST, 't', '');

$cssfile = 'template_css.css';
if ((_GEM_RTL == 1) && file_exists($mosConfig_absolute_path.'/templates/'.$tpl.'/css/template_css-rtl.css')) {
	$cssfile = 'template_css-rtl.css';
}

echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>'._LEND;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $adminLanguage->A_XML_LANGUAGE; ?>" xml:lang="<?php echo $adminLanguage->A_XML_LANGUAGE; ?>"<?php echo $rtl; ?>>
<head>
	<title><?php echo $adminLanguage->A_CONTENTPREVIEW; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $iso[1]; ?>" />
	<meta name="Generator" content="Elxis - (C) Copyright 2006-<?php echo date('Y'); ?> Elxis.org.  All rights reserved." />
	<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site; ?>/includes/standard<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site; ?>/templates/<?php echo $tpl; ?>/css/<?php echo $cssfile; ?>" />
	<script type="text/javascript">
		var form = window.opener.document.adminForm;
		var title = form.title.value;
		var alltext = form.introtext.value;
		if (form.fulltext) {
			alltext += form.fulltext.value;
		}

		// do the images
		var temp = new Array();
		for (var i=0, n=form.imagelist.options.length; i < n; i++) {
			value = form.imagelist.options[i].value;
			parts = value.split( '|' );

			temp[i] = '<img src="../../images/stories/' + parts[0] + '" align="' + parts[1] + '" border="' + parts[3] + '" alt="' + parts[2] + '" hspace="6" />';
		}

		var temp2 = alltext.split( '{mosimage}' );
		var alltext = temp2[0];

		for (var i=0, n=temp2.length-1; i < n; i++) {
			alltext += temp[i] + temp2[i+1];
		}
	</script>
</head>
<body style="background-color:#FFFFFF;">
	<h1 class="contentheading"><script type="text/javascript">document.write(title);</script></h1>
	<div>
		<script type="text/javascript">document.write(alltext);</script>
	</div>
	<div class="clear"></div><br />
	<div align="center">
		<a href="javascript:void(null);" onclick="javascript:window.close();"><?php echo $adminLanguage->A_CLOSE; ?></a> &nbsp; 
		<a href="javascript:void(null);" onclick="window.print(); return false;"><?php echo $adminLanguage->A_PRINT; ?></a>
	</div>
</body>
</html>