<?php 
/**
* @version: 1.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Templates / its-elxis3
* @author: Ivan Trebjesanin (jazzman)
* @link: http://www.trebjesanin.com
* @email: ivan@trebjesanin.com
* @description: ITS-Elxis-3 is a 3-column layout template with collapsible left and right columns.
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
    <link href="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/templates/its-elxis3/css/template_css<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.css" rel="stylesheet" type="text/css" media="all" />     
<?php 
    $its_s1 = mosCountModules('left');
	$its_s2 = mosCountModules('right') + mosCountModules('newsflash');
	$its_m1 = (_GEM_RTL) ? 'right': 'left';
	$its_m2 = (_GEM_RTL) ? 'left': 'right';	
	if (($its_s1 > 0) && ($its_s2 == 0)) {
		echo '<style type="text/css">div#side1 { margin-'.$its_m1.':-200px; } div#shadow { margin-'.$its_m2.':200px; }</style>'."\n";
	} elseif (($its_s1 == 0) && ($its_s2 > 0)) {
		echo '<style type="text/css">div#side2 { margin-'.$its_m1.':-200px; } div#shadow { margin-'.$its_m2.':200px; }</style>'."\n";
	} elseif (($its_s1 > 0) && ($its_s2 > 0)) {
		echo '<style type="text/css">div#side1 { margin-'.$its_m1.':-400px; } div#side2 { margin-'.$its_m1.':-200px; } div#shadow {margin-'.$its_m2.':400px; }</style>'."\n";
	}
	unset($its_m1, $its_m2);
?>
	<!--[if IE 6]>
	<link href="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/templates/its-elxis3/css/ie6<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.css" rel="stylesheet" type="text/css" media="all" />
	<![endif]-->
	<!--[if IE 7]>
	<link href="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/templates/its-elxis3/css/ie7<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.css" rel="stylesheet" type="text/css" media="all" />
	<![endif]-->
    <?php if ( $my->id ) { initEditor(); } ?>
</head>

<body<?php echo $mainframe->onLoad(); ?>>
	<div id="container">
		<div id="header">
			<div id="hin">
				<div id="lh">
					<a href="<?php echo sefRelToAbs('index.php'); ?>" title="<?php echo $mainframe->getCfg('sitename'); ?>" >
						<span style="display: none;"><?php echo $mainframe->getCfg('sitename'); ?></span>
					</a>
				</div>
				<div id="rh">
					<?php mosLoadModules('user9',-1); ?>
					<?php mosLoadModules('language',-1); ?>
				</div>
			</div>
			<div id="subhead">
				<?php elxloadmodule('mod_search',-1); ?>
				<?php mosLoadModules('top',-1); ?>
			</div>
		</div>

		<div id="main">
			<div id="shadow">
				<div id="content">
					<div id="pathway">
						<?php mospathway(); ?>
					</div>
					<?php if(mosCountModules('user1')>0 || mosCountModules('user2')>0) { ?>
					<div id="topmod">
						<?php mosLoadModules('user1',-2); ?>
						<?php mosLoadModules('user2',-2); ?> 
					</div>
					<?php /* THIS NEEDS CHECKING */ ?>
					<?php } else { mosLoadModules('header',-2); } ?>

					<?php mosmainbody(); ?>

					<?php mosLoadModules('bottom',-2); ?>
				</div>
			</div>
		</div>
		<?php if ($its_s1 > 0) { ?>
		<div id="side1">
			<div id="sin1">
				<?php mosLoadModules('left',-2); ?>
			</div>
		</div>
		<?php } ?>
		<?php if ($its_s2 > 0) { ?>
		<div id="side2">
			<div id="sin2">
				<?php mosLoadModules('newsflash', -2); ?>
				<?php mosLoadModules('right',-2); ?>
			</div>
		</div>
		<?php } ?>
    	<?php if(mosCountModules('user3')>0 || mosCountModules('user3')>0 || mosCountModules('user3')>0) { ?>
    	<div id="botmod">
        	<?php mosLoadModules('user3',-2); ?>
        	<?php mosLoadModules('user4',-2); ?>
        	<?php mosLoadModules('user5',-2); ?>
    	</div>
    	<?php } ?>
	</div>
	<div id="footer">
		<div id="fin"><?php include($mainframe->getCfg('absolute_path').'/includes/footer.php'); ?></div>
	</div>
</body>
</html>
