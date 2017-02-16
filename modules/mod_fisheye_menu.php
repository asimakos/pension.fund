<?php

// FishEye Menu Module for Elxis CMS 
// Author: Ivan Trebješanin 
// http://www.elxis-srbija.org
// Based on jquery(http://www.jquery.com) and interface element for jQuery (http://interface.eyecon.ro)
// Copyright 2008 Ivan Trebješanin
// License http://www.gnu.org/copyleft/gpl.html GNU/GPL


/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$fmenu_align 		= $params->get( 'fmenu_align' );
$fmenu_itemwidth 		= $params->get( 'fmenu_itemwidth' );
$fmenu_itemmaxwidth 		= $params->get( 'fmenu_itemmaxwidth' );
$fmenu_proximity 		= $params->get( 'fmenu_proximity' );
$txtcolor		= $params->get( 'txtcolor' );
$fontsize		= $params->get( 'fontsize' );

$menu_status1 	= $params->get( 'menu_status1' );
$menu_img1 		= $params->get( 'menu_img1' );
$menu_url1 		= $params->get( 'menu_url1' );
$menu_txt1 		= $params->get( 'menu_txt1' );

$menu_status2 	= $params->get( 'menu_status2' );
$menu_img2		= $params->get( 'menu_img2' );
$menu_url2 		= $params->get( 'menu_url2' );
$menu_txt2 		= $params->get( 'menu_txt2' );

$menu_status3 	= $params->get( 'menu_status3' );
$menu_img3		= $params->get( 'menu_img3' );
$menu_url3 		= $params->get( 'menu_url3' );
$menu_txt3 		= $params->get( 'menu_txt3' );

$menu_status4 	= $params->get( 'menu_status4' );
$menu_img4		= $params->get( 'menu_img4' );
$menu_url4 		= $params->get( 'menu_url4' );
$menu_txt4 		= $params->get( 'menu_txt4' );

$menu_status5 	= $params->get( 'menu_status5' );
$menu_img5		= $params->get( 'menu_img5' );
$menu_url5 		= $params->get( 'menu_url5' );
$menu_txt5 		= $params->get( 'menu_txt5' );

$menu_status6 	= $params->get( 'menu_status6' );
$menu_img6		= $params->get( 'menu_img6' );
$menu_url6 		= $params->get( 'menu_url6' );
$menu_txt6 		= $params->get( 'menu_txt6' );

$menu_status7 	= $params->get( 'menu_status7' );
$menu_img7		= $params->get( 'menu_img7' );
$menu_url7 		= $params->get( 'menu_url7' );
$menu_txt7 		= $params->get( 'menu_txt7' );

global $mainframe;
?>

<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/modules/fisheye/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/modules/fisheye/js/iutil.js"></script>
<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/modules/fisheye/js/fisheye.js"></script>

<div class="clear"></div>
<div id="fisheye" class="fisheye" style="text-align: center; height: 100px; position: relative;">
		<div  class="fisheyeContainter" style="height: 50px; left: -76px; position: absolute; top: 0px;">
		<?php if ($menu_status1==1) { ?>
			<a href="<?php echo $menu_url1 ?>" class="fisheyeItem" style="text-align: center;	color: #000;	font-weight: bold; text-decoration: none; width: <?php echo $fmenu_itemwidth; ?>px;	position: absolute;	display: block;	top: 0px;">
				<span style="positon: absolute; display: none; color:<?php echo $txtcolor ?>;font-size:<?php echo $fontsize ?>;"><?php echo $menu_txt1 ?></span>
        <img alt="" style="behavior: url('<?php echo $mainframe->getCfg('live_site'); ?>/modules/fisheye/png.htc');	border: none;	margin: 0 auto 5px auto; width: 100%;" src="<?php echo $mainframe->getCfg('live_site'); ?>/modules/fisheye/images/<?php echo $menu_img1 ?>" width="<?php echo $fmenu_itemwidth; ?>"/>
			</a>
			<?php } else { ?>
			<?php } ?>
			
			<?php if ($menu_status2==1) { ?>
			<a href="<?php echo $menu_url2 ?>" class="fisheyeItem" style="text-align: center;	color: #000;	font-weight: bold; text-decoration: none; width: <?php echo $fmenu_itemwidth; ?>px;	position: absolute;	display: block;	top: 0;">
				<span style="positon: absolute; display: none; color:<?php echo $txtcolor ?>;font-size:<?php echo $fontsize ?>;"><?php echo $menu_txt2 ?></span>
        <img alt="" style="behavior: url('<?php echo $mainframe->getCfg('live_site'); ?>/modules/fisheye/png.htc');	border: none;	margin: 0 auto 5px auto; width: 100%;" src="<?php echo $mainframe->getCfg('live_site'); ?>/modules/fisheye/images/<?php echo $menu_img2 ?>" width="30"/>
			</a>
			<?php } else { ?>
			<?php } ?>
			
			<?php if ($menu_status3==1) { ?>
			<a href="<?php echo $menu_url3 ?>" class="fisheyeItem" style="text-align: center;	color: #000;	font-weight: bold; text-decoration: none; width: <?php echo $fmenu_itemwidth; ?>px;	position: absolute;	display: block;	top: 0;">
				<span style="positon: absolute; display: none; color:<?php echo $txtcolor ?>;font-size:<?php echo $fontsize ?>;"><?php echo $menu_txt3 ?></span>
        <img alt="" style="behavior: url('<?php echo $mainframe->getCfg('live_site'); ?>/modules/fisheye/png.htc');	border: none; margin: 0 auto 5px auto; width: 100%;" src="<?php echo $mainframe->getCfg('live_site'); ?>/modules/fisheye/images/<?php echo $menu_img3 ?>" width="<?php echo $fmenu_itemwidth; ?>"/>
			</a>
			<?php } else { ?>
			<?php } ?>
			
			<?php if ($menu_status4==1) { ?>
			<a href="<?php echo $menu_url4 ?>" class="fisheyeItem" style="text-align: center;	color: #000;	font-weight: bold; text-decoration: none; width: <?php echo $fmenu_itemwidth; ?>px;	position: absolute;	display: block;	top: 0;">
				<span style="positon: absolute; display: none; color:<?php echo $txtcolor ?>;font-size:<?php echo $fontsize ?>;"><?php echo $menu_txt4 ?></span>
        <img alt="" style="behavior: url('<?php echo $mainframe->getCfg('live_site'); ?>/modules/fisheye/png.htc');	border: none; margin: 0 auto 5px auto; width: 100%;" src="<?php echo $mainframe->getCfg('live_site'); ?>/modules/fisheye/images/<?php echo $menu_img4 ?>" width="<?php echo $fmenu_itemwidth; ?>"/>
			</a>
			<?php } else { ?>
			<?php } ?>
			
			<?php if ($menu_status5==1) { ?>
			<a href="<?php echo $menu_url5 ?>" class="fisheyeItem" style="text-align: center;	color: #000;	font-weight: bold; text-decoration: none; width: <?php echo $fmenu_itemwidth; ?>px;	position: absolute;	display: block;	top: 0;">
			<span style="positon: absolute; display: none; color:<?php echo $txtcolor ?>;font-size:<?php echo $fontsize ?>;"><?php echo $menu_txt5 ?></span>
				<img alt="" style="behavior: url('<?php echo $mainframe->getCfg('live_site'); ?>/modules/fisheye/png.htc');	border: none; margin: 0 auto 5px auto; width: 100%;" src="<?php echo $mainframe->getCfg('live_site'); ?>/modules/fisheye/images/<?php echo $menu_img5 ?>" width="<?php echo $fmenu_itemwidth; ?>"/>
			</a>
			<?php } else { ?>
			<?php } ?>
			
			<?php if ($menu_status6==1) { ?>
			<a href="<?php echo $menu_url6 ?>" class="fisheyeItem" style="text-align: center;	color: #000;	font-weight: bold; text-decoration: none; width: <?php echo $fmenu_itemwidth; ?>px;	position: absolute;	display: block;	top: 0;">
			<span style="positon: absolute; display: none; color:<?php echo $txtcolor ?>;font-size:<?php echo $fontsize ?>;"><?php echo $menu_txt6 ?></span>
				<img alt="" style="behavior: url('<?php echo $mainframe->getCfg('live_site'); ?>/modules/fisheye/png.htc');	border: none;	margin: 0 auto 5px auto; width: 100%;" src="<?php echo $mainframe->getCfg('live_site'); ?>/modules/fisheye/images/<?php echo $menu_img6 ?>" width="<?php echo $fmenu_itemwidth; ?>"/>
			</a>
			<?php } else { ?>
			<?php } ?>
			
			<?php if ($menu_status7==1) { ?>
			<a href="<?php echo $menu_url7 ?>" class="fisheyeItem" style="text-align: center;	color: #000;	font-weight: bold; text-decoration: none; width: <?php echo $fmenu_itemwidth; ?>px;	position: absolute;	display: block;	top: 0;">
			<span style="positon: absolute; display: none; color:<?php echo $txtcolor ?>;font-size:<?php echo $fontsize ?>;"><?php echo $menu_txt7 ?></span>
				<img alt="" style="behavior: url('<?php echo $mainframe->getCfg('live_site'); ?>/modules/fisheye/png.htc'); border: none; margin: 0 auto 5px auto; width: 100%;" src="<?php echo $mainframe->getCfg('live_site'); ?>/modules/fisheye/images/<?php echo $menu_img7 ?>" width="<?php echo $fmenu_itemwidth; ?>"/>
			</a>
			<?php } else { ?>
			<?php } ?>
			
			<script type="text/javascript">
	
			$(document).ready(
				function()
				{
					$('#fisheye').Fisheye(
						{
						maxWidth: <?php echo $fmenu_itemmaxwidth ?>,
						items: 'a',
						itemsText: 'span',
						container: '.fisheyeContainter',
						itemWidth: <?php echo $fmenu_itemwidth ?>,
						proximity: <?php echo $fmenu_proximity ?>,
						alignment : 'left',
						halign : '<?php echo $fmenu_align ?>'
						}
					)
				}
			);

		</script>
		</div>
</div>
<div class="clear"></div>
