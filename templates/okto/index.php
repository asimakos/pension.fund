<?php
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Templates / Okto
* @author: Ioannis Sannos (datahell)
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @description: Okto is a template for Elxis CMS generation 2008/2009 created by Ioannis Sannos (Elxis Team).
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$iso = explode( '=', _ISO );
echo '<?xml version="1.0" encoding="'.$iso[1].'"?' .'>'._LEND;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo _LANGUAGE; ?>" xml:lang="<?php echo _LANGUAGE; ?>"<?php echo (_GEM_RTL) ? ' dir="rtl"' : ''; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php mosShowHead(); ?>
<?php echo '<link href="'.$mainframe->getCfg('live_site').'/modules/dsmenu/dsmenu_h.css" rel="stylesheet" type="text/css" />'; ?>
<link href="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_css<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.css" rel="stylesheet" type="text/css" media="all" />
<?php if ( $my->id ) { initEditor(); } ?>
</head>
<body<?php echo $mainframe->onLoad(); ?>>
<div id="container">
	<div id="mainwrap">
		<div id="oktoheader">
			<div id="headright">
				<!-- module Search loaded without template position -->
				<?php elxLoadModule('mod_search', -2); ?>
				<!-- module Language loaded without template position -->
				<?php elxLoadModule('mod_language', -2); ?>
			</div>
		</div>

		<?php if (mosCountModules('top') > 0) { ?>
			<!-- top menu -->
			<div class="navigation">
			<?php mosLoadModules('top', -2); ?>
			</div>
		<?php } ?>

		<!-- pathway -->
		<div class="pathway">
			<?php mospathway(); ?>
		</div>

		<div id="main-body">
			<div id="sitecontent">
			<?php if (mosCountModules('header') > 0) { ?>
				<div id="position_top">
					<?php mosLoadModules('header', -2); ?>
				</div>
			<?php } ?>

			<?php
				if (mosCountModules('user1') >= 1 OR mosCountModules('user2') >= 1 ) {
			?>
				<div id="content_top_wrapper">
					<div id="content_user1">
					<?php mosLoadModules('user1', -2); ?>
					</div>
					<div id="content_user2">
					<?php mosLoadModules('user2', -2); ?>
					</div>
				</div>
			<?php
			}
			?>

				<div class="inside">
					<?php mosMainBody();?>
				</div>
			</div>

			<div id="leftcolumn">
				<div class="inside-col">
					<?php mosLoadModules('left', -2); ?>
					<?php mosLoadModules('user3', -2); ?>
				</div>
			</div>
		</div>

		<div id="rightcolumn">
			<div class="inside-col">
				<?php mosLoadModules('newsflash', -2); ?>
				<?php mosLoadModules('banner', -2); ?>
				<?php mosLoadModules('right', -2); ?>
				<br>
				<?php include_once($mainframe->getCfg('absolute_path').'/includes/clock.php'); ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>

	<div align="center">
    <?php mosLoadModules('footer', -2); ?>
	<?php include_once($mainframe->getCfg('absolute_path').'/includes/footer.php'); ?>
	</div>
</div>
</body>
</html>