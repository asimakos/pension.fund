<?php
/**
* @version: $Id: pollwindow.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: PopUps
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @description: Popup window for polls preview
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

/** Set flag that this is a parent file */
define( "_VALID_MOS", 1 );
/** Mostly used to tell loader to include adminLanguage */
define( '_ELXIS_ADMIN', 1 );

$elxis_root = str_replace('/administrator/popups', '', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));
require_once($elxis_root.'/administrator/includes/auth.php');

$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix, $mosConfig_dbtype );
$database->debug( $mosConfig_debug );

$pollid = intval(mosGetParam( $_REQUEST, 'pollid', 0 ));

$database->setQuery( "SELECT title FROM #__polls WHERE id='".$pollid."'", '#__', 1, 0);
$title = $database->loadResult();

$database->setQuery( "SELECT text FROM #__poll_data WHERE pollid='".$pollid."' ORDER BY id" );
$options = $database->loadResultArray();

$iso = preg_split( '/\=/', _ISO );
$rtl = (_GEM_RTL == 1) ? ' dir="rtl"' : '';
$tpl = mosGetParam( $_REQUEST, 't', '' );

$cssfile = 'template_css.css';
if ((_GEM_RTL == 1) && file_exists($mosConfig_absolute_path.'/templates/'.$tpl.'/css/template_css-rtl.css')) {
	$cssfile = 'template_css-rtl.css';
}

echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>'._LEND;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $adminLanguage->A_XML_LANGUAGE; ?>" xml:lang="<?php echo $adminLanguage->A_XML_LANGUAGE; ?>"<?php echo $rtl; ?>>
<head>
<title><?php echo $adminLanguage->A_POLLPREVIEW; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $iso[1]; ?>" />
<meta name="Generator" content="Elxis - (C) Copyright 2006-<?php echo date('Y'); ?> Elxis.org.  All rights reserved." />
<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site; ?>/includes/standard<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $mosConfig_live_site; ?>/templates/<?php echo $tpl; ?>/css/<?php echo $cssfile; ?>" />
</head>
<body>
<form name="pollpreview">
<div id="pollresultstable" class="contentpane">
	<h3 class="sectiontableheader">
		<img border="0" align="bottom" alt="poll" src="<?php echo $mosConfig_live_site; ?>/components/com_poll/images/poll.png" /> 
		<?php echo $title; ?>
	</h3>
	<ul class="polltable">
	<?php 
	if ($options) {
		$k = 0;
    	foreach ($options as $text) {
			if ($text <> '') {
    ?>
			<li class="row<?php echo $k; ?>">
				<input type="radio" name="poll" value="<?php echo $text; ?>" />
				<?php echo $text; ?>
			</li>

	<?php 
			$k = 1 - $k;
        	}
		}
	}
	?>
	<ul>
	<div class="clear"></div>
	<div align="center">
        <input type="button" name="submit" value="<?php echo $adminLanguage->A_VOTE; ?>" class="button" /> &nbsp;
        <input type="button" name="result" value="<?php echo $adminLanguage->A_RESULTS; ?>" class="button" /><br /><br />
	    <a href="javascript:void(null);" onclick="javascript:window.close();"><?php echo $adminLanguage->A_CLOSE; ?></a>
	</div>
</div>
</form>
</body>
</html>