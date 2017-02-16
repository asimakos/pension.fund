<?php 
/**
* @version: 1.0
* @copyright: Copyright (C) 2009-2010 ks-net.gr. All rights reserved.
* @package: Elxis
* @subpackage: Templates / Eros
* @author: Kostas stathopoulos (ks-net)
* @link: http://www.ks-net.gr
* @email: info@ks-net.gr
* @description: Ks-Eros template for Elxis 2008.x/2009.x created by Kostas stathopoulos (ks-net).
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
<link href="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/templates/ks-eros/css/template_css<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.css" rel="stylesheet" type="text/css" media="all" />
<?php if ( $my->id ) { initEditor(); } ?>
<?php 
/*
REMOVE THIS COMMENT TO ENABLE LYTEBOX
<link  href="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/templates/ks-eros/lytebox/lytebox.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/templates/ks-eros/lytebox/lytebox.js"></script>
*/
?>
<!--[if lt IE 7]>
    <style type="text/css" media="screen">
    #incol {width:100%;}
    .modfpg-container{width:98%;}
    #path, ul.mainlevel {margin-top:-3px;}
    </style>
<![endif]-->
</head>
<body<?php echo method_exists($mainframe, 'onLoad') ? $mainframe->onLoad() : ''; ?>>
<div id="lbg">
	<div id="rbg">
		<div id="header">
			<div id="logo-text">
				<h1>
					<a href="<?php echo sefRelToAbs('index.php') ?>" title="<?php echo $mainframe->getCfg('sitename'); ?>">
						<?php echo $mainframe->getCfg('sitename'); ?>
					</a>
				</h1>
				<h2>Ks-Eros template for elxis 2008/2009</h2>
			</div>
			<div id="head-right-container">
            	<div id="langwrap"><?php elxLoadModule('mod_language', -2); ?></div>
            	<div id="search"><?php elxLoadModule('mod_search', -2); ?></div>
			</div>
			<div id="path"><?php mospathway(); ?></div>
		</div>
		<!-- end header -->
		<div id="nav">
		<?php if (mosCountModules('top') > 0) { ?>
			<div class="navigation">
				<?php mosLoadModules('top', -2); ?>
			</div> 
		<?php } ?>
		</div>

		<div id="wrapper">
			<div id="content">
				<div id="incol">
				<?php if (mosCountModules('newsflash') > 0 ) { ?>
					<div id="newsflashes">
						<?php mosLoadModules('newsflash', -2); ?>
					</div>
				<?php } ?>
				<?php if (mosCountModules('header') > 0) { ?>
					<div id="position_top">
						<?php mosLoadModules('header', -2); ?>
					</div>
				<?php } ?>
				<?php if ((mosCountModules('user1') > 0) OR (mosCountModules('user2') > 0)) { ?>
					<div id="content_top_wrapper">
						<div id="content_user1">
							<?php mosLoadModules('user1', -2); ?>
						</div>
						<div id="content_user2">
							<?php mosLoadModules('user2', -2); ?>
						</div>
					</div>
				<?php } ?>
				<?php mosMainBody(); ?>
				<?php if (mosCountModules('inset') > 0) { ?>
					<div id="inset">
						<?php mosLoadModules('inset', -2); ?>
					</div>
				<?php } ?>
				</div>
				<!--incol end -->
			</div>
			<!--content end -->
		</div>
		<!-- wrapper end -->

		<div id="rcol">
			<div class="in">
				<?php mosLoadModules('left', -2); ?>
			</div>
		</div>
		<!-- rcol end -->

		<div id="lcol">    
			<div class="in">              
				<?php mosLoadModules('user3', -2); ?>
				<?php mosLoadModules('right', -2); ?>
				<?php if (mosCountModules('banner') > 0) { ?>
				<div align="center">
					<?php mosLoadModules('banner', -2); ?>
				</div>
				<?php } ?>
			</div>
		</div>
		<!-- lcol end -->

		<?php if (mosCountModules('bottom') > 0) { ?>
		<div id="bottomwrap">
			<?php mosLoadModules('bottom', -2); ?>
        </div>
    	<?php } ?>

		<div id="footer">
		<?php if ((mosCountModules('user4') > 0) OR (mosCountModules('user5') > 0) OR (mosCountModules('user6') > 0)) { ?>
			<div id="moduser-footer">
				<div class="footeruser">
					<?php mosLoadModules('user4', -2); ?>
				</div>
				<div class="footeruser">
					<?php mosLoadModules('user5', -2); ?>
				</div>
			</div>
		<?php } ?>
		<?php if (mosCountModules('footer') > 0) { ?>
			<div class="modfooter">
				<?php mosLoadModules('footer', -2); ?>
			</div>
		<?php } ?>

		<?php include_once($mainframe->getCfg('absolute_path').'/includes/footer.php'); ?>
		</div>
		<!-- end footer -->
		<div id="bottomcontainer-wrap">
			<div id="bottomcontainer">
				<div class="bottomlinks">
					Ks-Eros Theme by <a href="http://www.ks-net.gr" >ks-net.gr</a>
				</div>
				<div class="bottomimg">
					<a href="http://validator.w3.org/check?uri=referer" target="_blank" title="Valid XHTML 1.0 Transitional">
						<img src="templates/ks-eros/images/html-valid.gif" alt="Valid XHTML 1.0 Transitional" height="15" width="80" />
					</a>
					<a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank" title="Valid CSS">
						<img  src="templates/ks-eros/images/css-valid.png" alt="Valid CSS" height="15" width="80" />
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!--bg columns -->
<!-- Ks-Eros elxis 2008.x, 2009.x template from kostas stathopoulos(ks-net) http://ks-net.gr -->
</body>
</html>