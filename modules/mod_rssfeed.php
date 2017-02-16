<?php 
/**
* @ Version: $Id: mod_rssfeed.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Module RSS Feeds
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $mainframe, $lang;

$text = $params->get( 'text' );
$moduleclass_sfx = $params->get( 'moduleclass_sfx', '' );
$rss091 = intval($params->get( 'rss091', 1 ));
$rss10 = intval($params->get( 'rss10', 1 ));
$rss20 = intval($params->get( 'rss20', 1 ));
$atom = intval($params->get( 'atom', 1 ));
$opml = intval($params->get( 'opml', 1 ));
$rss091_image = $params->get( 'rss091_image', '' );
$rss10_image = $params->get( 'rss10_image', '' );
$rss20_image = $params->get( 'rss20_image', '' );
$atom_image = $params->get( 'atom_image', '' );
$opml_image = $params->get( 'opml_image', '' );
$t_path = $mainframe->getCfg('live_site').'/templates/'.$mainframe->getTemplate().'/images/';
$d_path = $mainframe->getCfg('live_site').'/images/M_images/';

$isoL = '';
if (($mainframe->getCfg('sef') == 2) && ($lang != $mainframe->getCfg('lang'))) {
	$isoL = eLOCALE::elxis_iso639($lang);
	if ($isoL != '') { $isoL = '/'.$isoL; }
}
?>

<div class="syndicate<?php echo $moduleclass_sfx; ?>">
<?php 
if ( $text ) {
	?>
	<div align="center" class="syndicate_text<?php echo $moduleclass_sfx; ?>">
	   <?php echo $text; ?>
	</div>
<?php 
}

if ( $rss091 ) {
	$img = mosAdminMenus::ImageCheck( 'rss091.gif', '/images/M_images/', $rss091_image, '/images/M_images/', 'RSS 0.91' );
	if ($mainframe->getCfg('sef') == 2) {
		$link = $mainframe->getCfg('live_site').$isoL.'/rss/rss091.xml';
	} else {
		$link = $mainframe->getCfg('live_site').'/index2.php?option=com_rss&amp;feed=RSS0.91&amp;no_html=1';
	}
	?>
	<div align="center">
	   <a href="<?php echo $link; ?>" title="RSS 0.91"><?php echo $img; ?></a>
	</div>
<?php 
}

if ( $rss10 ) {
	$img = mosAdminMenus::ImageCheck( 'rss10.gif', '/images/M_images/', $rss10_image, '/images/M_images/', 'RSS 1.0' );
	if ($mainframe->getCfg('sef') == 2) {
		$link = $mainframe->getCfg('live_site').$isoL.'/rss/rss10.xml';
	} else {
		$link = $mainframe->getCfg('live_site').'/index2.php?option=com_rss&amp;feed=RSS1.0&amp;no_html=1';
	}
?>
	<div align="center">
        <a href="<?php echo $link; ?>" title="RSS 1.0"><?php echo $img; ?></a>
	</div>
<?php 
}

if ( $rss20 ) {
	$img = mosAdminMenus::ImageCheck( 'rss20.gif', '/images/M_images/', $rss20_image, '/images/M_images/', 'RSS 2.0' );
	if ($mainframe->getCfg('sef') == 2) {
		$link = $mainframe->getCfg('live_site').$isoL.'/rss/rss20.xml';
	} else {
		$link = $mainframe->getCfg('live_site').'/index2.php?option=com_rss&amp;feed=RSS2.0&amp;no_html=1';
	}
?>
	<div align="center">
        <a href="<?php echo $link; ?>" title="RSS 2.0"><?php echo $img; ?></a>
	</div>
<?php 
}

if ( $atom ) {
	$img = mosAdminMenus::ImageCheck( 'atom03.gif', '/images/M_images/', $atom_image, '/images/M_images/', 'ATOM 0.3' );
	if ($mainframe->getCfg('sef') == 2) {
		$link = $mainframe->getCfg('live_site').$isoL.'/rss/atom03.xml';
	} else {
		$link = $mainframe->getCfg('live_site').'/index2.php?option=com_rss&amp;feed=ATOM0.3&amp;no_html=1';
	}
	?>
	<div align="center">
        <a href="<?php echo $link; ?>" title="ATOM 0.3"><?php echo $img; ?></a>
	</div>
<?php 
}

if ( $opml ) {
	$img = mosAdminMenus::ImageCheck( 'opml.png', '/images/M_images/', $opml_image, '/images/M_images/', 'OPML' );
	if ($mainframe->getCfg('sef') == 2) {
		$link = $mainframe->getCfg('live_site').$isoL.'/rss/opml.xml';
	} else {
		$link = $mainframe->getCfg('live_site').'/index2.php?option=com_rss&amp;feed=OPML&amp;no_html=1';
	}
?>
	<div align="center">
        <a href="<?php echo $link; ?>" title="OPML"><?php echo $img; ?></a>
	</div>
<?php 
}
?>
</div>
