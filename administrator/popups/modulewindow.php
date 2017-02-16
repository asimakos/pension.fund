<?php 
/**
* @version: $Id: modulewindow.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: PopUps
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @description: Popup window for modules preview
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

/** Set flag that this is a parent file */
define('_VALID_MOS', 1);
/** Mostly used to tell loader to include adminLanguage */
define('_ELXIS_ADMIN', 1);

$elxis_root = str_replace('/administrator/popups', '', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));
require_once($elxis_root.'/administrator/includes/auth.php');

$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix, $mosConfig_dbtype );
$database->debug( $mosConfig_debug );

$title = mosGetParam($_REQUEST, 'title', 0);

$database->setQuery( "SELECT * FROM #__modules WHERE title='".$title."'" );
$row = null;
$database->loadObject( $row );

$pat= "src=images";
$replace= "src=../../images";
$pat2="\\\\'";
$replace2="'";
$content = preg_replace('/src\=images/i', '/src\=\.\.\/\.\.\/images/i', $row->content);
$content = preg_replace('/\\\'/', '\'', $content);
$title = preg_replace('/\\\'/', '\'', $row->title);

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
	<title><?php echo $adminLanguage->A_MODULEPREVIEW; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $iso[1]; ?>" />
	<meta name="Generator" content="Elxis - (C) Copyright 2006-<?php echo date('Y'); ?> Elxis.org.  All rights reserved." />
	<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site; ?>/includes/standard<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site; ?>/templates/<?php echo $tpl; ?>/css/<?php echo $cssfile; ?>" />

	<script type="text/javascript">
		<!--
		var content = window.opener.document.adminForm.content.value;
		var title = window.opener.document.adminForm.title.value;

		content = content.replace('#', '');
		title = title.replace('#', '');
		content = content.replace('src=images', 'src=../../images');
		content = content.replace('src=images', 'src=../../images');
		title = title.replace('src=images', 'src=../../images');
		content = content.replace('src=images', 'src=../../images');
		title = title.replace('src=\"images', 'src=\"../../images');
		content = content.replace('src=\"images', 'src=\"../../images');
		title = title.replace('src=\"images', 'src=\"../../images');
		content = content.replace('src=\"images', 'src=\"../../images');
		//-->
	</script>
</head>

<body style="background-color: #FFFFFF;">
	<div class="moduletable">
		<h3><script type="text/javascript">document.write(title);</script></h3>
		<script type="text/javascript">document.write(content);</script>
	</div>
	<div class="clear"></div><br />
	<div align="center">
		<a href="javascript:void(0);" onclick="javascript:window.close();" title="<?php echo $adminLanguage->A_CLOSE; ?>"><?php echo $adminLanguage->A_CLOSE; ?></a>
	</div>
</body>
</html>