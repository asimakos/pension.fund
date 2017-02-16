<?php 
/**
* @version: 1.0
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Templates / ekebic
* @author: Dejan Viduka (kebic)
* @link: http://www.viduka.info
* @email: dejan@viduka.info
* @description: eKebic a template for Elxis 2009.0 by Dejan Viduka.
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
<link href="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/templates/ekebic/css/template_css<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.css" rel="stylesheet" type="text/css" media="all" />
<?php 
if ($my->id) { initEditor(); }

$extracss = array();
$cntmods = mosCountModules('user5') + mosCountModules('user6') + mosCountModules('user7') + mosCountModules('user8');
if ($cntmods == 0) { $extracss[] = '#header2{ display: none; }'; }
$cntmods = mosCountModules('user1') + mosCountModules('user2') + mosCountModules('user3') + mosCountModules('user4');
if ($cntmods == 0) { $extracss[] = '#dno{ display: none; }'; }
if (mosCountModules('left') == 0) { $extracss[] = '.tkol{ width: 705px; }'; $extracss[] = '.lkol{ display: none; }'; }
if ((mosCountModules('right') + mosCountModules('newsflash')) == 0) { $extracss[] = '.tkol{ width: 705px; }'; $extracss[] = '.rkol{ display: none; }'; }
if ((mosCountModules('left') == 0) && (mosCountModules('right') == 0) && (mosCountModules('newsflash') == 0)) {
	$extracss[] = '.tkol{ width:920px; }'; $extracss[] = '.lkol{ display:none; }'; $extracss[] = '.rkol{ display:none; }';
}
if (count($extracss) > 0) {
	echo '<style type="text/css">'."\n";
	echo implode("\n", $extracss);
	echo "\n</style>\n";
}
unset($cntmods, $extracss);
?>
<!--[if IE]>
<link href="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/templates/ekebic/css/ie<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.css" rel="stylesheet" type="text/css" media="all" />
<![endif]-->
</head>

<body<?php echo $mainframe->onLoad(); ?>>
<div id="okvir" align="center">
	<div id="header">
		<a href="<?php echo sefRelToAbs('index.php'); ?>" title="<?php echo $mainframe->getCfg('sitename'); ?>" class="logo">
			<span style="display: none;"><?php echo $mainframe->getCfg('sitename'); ?></span>
		</a>
		<div class="navigacija">
			<div id="top_menu">
				<?php mosLoadModules('top', -2); ?>
			</div>
		</div>
		<div class="pretraga">
			<?php elxLoadModule('mod_search', -2); ?>
		</div>
		<div class="put">
			<?php mosPathWay(); ?>
		</div>
		<div class="zastava">
			<?php elxLoadModule('mod_language', -2); ?>
		</div>
	</div>

	<div id="header2">
		<div class="top1"></div>
		<div class="top2">
			<div class="user5">
				<?php mosLoadModules('user5', -2); ?>
			</div>
			<div class="user6">
				<?php mosLoadModules('user6', -2); ?>
			</div>
            <div class="user7">
				<?php mosLoadModules('user7', -2); ?>
			</div>
            <div class="user8">
				<?php mosLoadModules('user8', -2); ?>
			</div>
			<br style="clear: both; line-height: 0;" />
		</div>
		<div class="top3"></div>
	</div>

	<div id="main">
		<div class="telo1"></div>
		<div class="telo2">
			<div class="tkol">
				<div class="baner">
					<?php mosLoadModules('banner', -2 ); ?>
					<?php mosLoadModules('header', -2 ); ?>
				</div>
				<?php mosMainBody(); ?>
			</div>
			<div class="lkol">
				<?php mosLoadModules('left', -2); ?>
			</div>
			<div class="dkol">
				<?php mosLoadModules('newsflash', -2); ?>
				<?php mosLoadModules('right', -2); ?>
			</div>
			<br style="clear: both; line-height: 0;" />
		</div>
		<div class="telo3"></div>
	</div>

	<div id="dno">
		<div class="dno1"></div>
		<div class="dno2">
			<div class="user1">
				<?php mosLoadModules('user1', -2); ?>
			</div>
			<div class="user2">
				<?php mosLoadModules('user2', -2); ?>
			</div>
			<div class="user3">
				<?php mosLoadModules('user3', -2); ?>
			</div>
			<div class="user4">
				<?php mosLoadModules('user4', -2); ?>
			</div>
			<br style="clear: both; line-height: 0;" />
		</div>
        <div class="dno3"></div>
	</div>

	<div id="footer">
		<div class="copyright"><?php include($mainframe->getCfg('absolute_path').'/includes/footer.php'); ?></div>
	</div>
</div>
</body>
</html>