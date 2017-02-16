<?php

/* 
** Easy Slider module v.1.2 for Elxis CMS
** Copyright (C) 2011 www.osw.gr - All rights reserved.
** Licence GNU/GPL
**
** Based on jQuery plugin written by Alen Grakalic (http://cssglobe.com/post/5780/easy-slider-17-numeric-navigation-jquery-slider)
*/ 

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $_VERSION;
if (version_compare($_VERSION->RELEASE.'.'.$_VERSION->DEV_LEVEL, '2009.2') >= 0) {
	$easy_sslurl = $mainframe->getCfg('ssl_live_site');
} else {
	$easy_ssl = 0;
	$easy_sslurl = $mainframe->getCfg('live_site');
	if (isset($_SERVER['HTTPS'])) {
		if (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == 1)) { $easy_ssl = 1; }
	}
	if (isset($_SERVER['SERVER_PORT']) && ($_SERVER['SERVER_PORT'] == 443)) { $easy_ssl = 1; }
	if ($easy_ssl == 1) { $easy_sslurl = preg_replace('@^(http\:)@i', 'https:', $easy_sslurl); }
	unset($easy_ssl);
}
$easy_url = $easy_sslurl.'/modules/mod_easyslider'; 

global $mainframe;

$easy_bgcolor = $params->get( 'easy_bgcolor', 'transparent' );
if ($easy_bgcolor == 'transparent') { ($filtered_easy_bgcolor = 'transparent'); }
else { $filtered_easy_bgcolor = preg_replace("/[^a-f,A-F,0-9,#]/", "", $easy_bgcolor); }

$easy_num_slides = (int)($params->get( 'easy_num_slides','3' ));

$easy_width = (int)$params->get( 'easy_width', 190 );
if ($easy_width < 100) { $easy_width = 100; }
if ($easy_width > 970) { $easy_width = 970; }

$easy_height = (int)$params->get( 'easy_height', 260 );
if ($easy_height < 50) { $easy_height = 50; }
if ($easy_height > 600) { $easy_height = 600; }

$easy_speed = $params->get( 'easy_speed', '800' );

$easy_pause = $params->get( 'easy_pause', '2000' );

$rtl = (_GEM_RTL == 1) ? '-rtl' : '';

$easy_list = array();
$easy_list[1]=$params->get('easy_list1','0');
$easy_list[2]=$params->get('easy_list2','0');
$easy_list[3]=$params->get('easy_list3','0');
$easy_list[4]=$params->get('easy_list4','0');
$easy_list[5]=$params->get('easy_list5','0');
$easy_list[6]=$params->get('easy_list6','0');
$easy_list[7]=$params->get('easy_list7','0');
$easy_list[8]=$params->get('easy_list8','0');
$easy_list[9]=$params->get('easy_list9','0');
$easy_list[10]=$params->get('easy_list10','0');
$easy_list[11]=$params->get('easy_list11','0');
$easy_list[12]=$params->get('easy_list12','0');

$easy_image = array();
$easy_image[1]=$params->get('easy_image1','-1');
$easy_image[2]=$params->get('easy_image2','-1');
$easy_image[3]=$params->get('easy_image3','-1');
$easy_image[4]=$params->get('easy_image4','-1');
$easy_image[5]=$params->get('easy_image5','-1');
$easy_image[6]=$params->get('easy_image6','-1');
$easy_image[7]=$params->get('easy_image7','-1');
$easy_image[8]=$params->get('easy_image8','-1');
$easy_image[9]=$params->get('easy_image9','-1');
$easy_image[10]=$params->get('easy_image10','-1');
$easy_image[11]=$params->get('easy_image11','-1');
$easy_image[12]=$params->get('easy_image12','-1');

$easy_alt = array();
$easy_alt[1]=$params->get('easy_alt1','');
$easy_alt[2]=$params->get('easy_alt2','');
$easy_alt[3]=$params->get('easy_alt3','');
$easy_alt[4]=$params->get('easy_alt4','');
$easy_alt[5]=$params->get('easy_alt5','');
$easy_alt[6]=$params->get('easy_alt6','');
$easy_alt[7]=$params->get('easy_alt7','');
$easy_alt[8]=$params->get('easy_alt8','');
$easy_alt[9]=$params->get('easy_alt9','');
$easy_alt[10]=$params->get('easy_alt10','');
$easy_alt[11]=$params->get('easy_alt11','');
$easy_alt[12]=$params->get('easy_alt12','');

$easy_title = array();
$easy_title[1]=$params->get('easy_title1','');
$easy_title[2]=$params->get('easy_title2','');
$easy_title[3]=$params->get('easy_title3','');
$easy_title[4]=$params->get('easy_title4','');
$easy_title[5]=$params->get('easy_title5','');
$easy_title[6]=$params->get('easy_title6','');
$easy_title[7]=$params->get('easy_title7','');
$easy_title[8]=$params->get('easy_title8','');
$easy_title[9]=$params->get('easy_title9','');
$easy_title[10]=$params->get('easy_title10','');
$easy_title[11]=$params->get('easy_title11','');
$easy_title[12]=$params->get('easy_title12','');

$easy_text = array();
$easy_text[1]=$params->get('easy_text1','');
$easy_text[2]=$params->get('easy_text2','');
$easy_text[3]=$params->get('easy_text3','');
$easy_text[4]=$params->get('easy_text4','');
$easy_text[5]=$params->get('easy_text5','');
$easy_text[6]=$params->get('easy_text6','');
$easy_text[7]=$params->get('easy_text7','');
$easy_text[8]=$params->get('easy_text8','');
$easy_text[9]=$params->get('easy_text9','');
$easy_text[10]=$params->get('easy_text10','');
$easy_text[11]=$params->get('easy_text11','');
$easy_text[12]=$params->get('easy_text12','');

$easy_link = array();
$easy_link[1]=$params->get('easy_link1','');
$easy_link[2]=$params->get('easy_link2','');
$easy_link[3]=$params->get('easy_link3','');
$easy_link[4]=$params->get('easy_link4','');
$easy_link[5]=$params->get('easy_link5','');
$easy_link[6]=$params->get('easy_link6','');
$easy_link[7]=$params->get('easy_link7','');
$easy_link[8]=$params->get('easy_link8','');
$easy_link[9]=$params->get('easy_link9','');
$easy_link[10]=$params->get('easy_link10','');
$easy_link[11]=$params->get('easy_link11','');
$easy_link[12]=$params->get('easy_link12','');

$easy_target = array();
$easy_target[1]=$params->get('easy_target1','self');
$easy_target[2]=$params->get('easy_target2','self');
$easy_target[3]=$params->get('easy_target3','self');
$easy_target[4]=$params->get('easy_target4','self');
$easy_target[5]=$params->get('easy_target5','self');
$easy_target[6]=$params->get('easy_target6','self');
$easy_target[7]=$params->get('easy_target7','self');
$easy_target[8]=$params->get('easy_target8','self');
$easy_target[9]=$params->get('easy_target9','self');
$easy_target[10]=$params->get('easy_target10','self');
$easy_target[11]=$params->get('easy_target11','self');
$easy_target[12]=$params->get('easy_target12','self');

$easy_conimgwidth = array();
$easy_conimgwidth[1]=(int)$params->get('easy_conimgwidth1','130');
$easy_conimgwidth[2]=(int)$params->get('easy_conimgwidth2','130');
$easy_conimgwidth[3]=(int)$params->get('easy_conimgwidth3','130');
$easy_conimgwidth[4]=(int)$params->get('easy_conimgwidth4','130');
$easy_conimgwidth[5]=(int)$params->get('easy_conimgwidth5','130');
$easy_conimgwidth[6]=(int)$params->get('easy_conimgwidth6','130');
$easy_conimgwidth[7]=(int)$params->get('easy_conimgwidth7','130');
$easy_conimgwidth[8]=(int)$params->get('easy_conimgwidth8','130');
$easy_conimgwidth[9]=(int)$params->get('easy_conimgwidth9','130');
$easy_conimgwidth[10]=(int)$params->get('easy_conimgwidth10','130');
$easy_conimgwidth[11]=(int)$params->get('easy_conimgwidth11','130');
$easy_conimgwidth[12]=(int)$params->get('easy_conimgwidth12','130');

if ($easy_conimgwidth[$easy_i] > $easy_width) { $easy_conimgwidth[$easy_i] = $easy_width; }

$esid = 1;

if (!defined('EASYJSCSS')) { ?>

<script type="text/javascript" src="<?php echo $easy_url; ?>/jquery.js"></script>
<script type="text/javascript" src="<?php echo $easy_url; ?>/easySlider1.7.js"></script>
<script type="text/javascript">
/* <![CDATA[ */
var header = document.getElementsByTagName("head")[0];
var csslink = document.createElement("link");
csslink.setAttribute("rel", "stylesheet");
csslink.setAttribute("type", "text/css");
csslink.setAttribute("href", "<?php echo $easy_url; ?>/easyslider<?php echo $rtl; ?>.css");
csslink.setAttribute("media", "all");
header.appendChild(csslink);
/* ]]> */
</script>

<?php define('EASYJSCSS', 1); } 
else {
$esid = $esid + 1;
}?>

<script type="text/javascript">
      jQuery.noConflict();
      jQuery(document).ready(function($){  
      $(document).ready(function(){	
		  $("#easy_slider<?php echo $esid; ?>").easySlider({
			prevId: 'prevBtn',
      nextId: 'nextBtn',
			vertical: <?php echo (intval($params->get('easy_orientation',0)) === 1) ? 'true' : 'false'; ?>,
			speed: <?php echo $easy_speed; ?>,				
      auto: <?php echo (intval($params->get('easy_auto',0)) === 1) ? 'true' : 'false'; ?>,
      pause: <?php echo $easy_pause; ?>,
      continuous: <?php echo (intval($params->get('easy_continuous',0)) === 1) ? 'true' : 'false'; ?>,
      numeric: <?php echo (intval($params->get('easy_numeric',0)) === 1) ? 'true' : 'false'; ?>,
      controlsShow:	<?php echo (intval($params->get('easy_ctrlshow',0)) === 1) ? 'true' : 'false'; ?>
		});
	});   
});      
</script>  

<div id="easy_slider<?php echo $esid; ?>" style="background-color: <?php echo $filtered_easy_bgcolor; ?>; width: <?php echo $easy_width; ?>px; height: <?php echo $easy_height; ?>px; overflow: hidden;">

   <ul style="margin: 0; padding: 0; list-style: none;">	     
    
      <?php for ($easy_i=1; $easy_i<=$easy_num_slides; $easy_i++) { ?>
  
    <!-- List -->
		  <?php if ($easy_list[$easy_i] == '1') { ?>
			<li style="width: <?php echo $easy_width; ?>px; height: <?php echo $easy_height; ?>px; margin: 0; padding: 0; list-style: none; overflow: hidden;">
        
    <!-- Only Title -->
        <?php if ((trim($easy_title[$easy_i]) != '') && (trim($easy_link[$easy_i]) == '')) { ?>
        <div class="easy_title"><?php echo $easy_title[$easy_i]; ?></div>
        <?php } ?>  
        
    <!-- Title with Link on -->
        <?php if ((trim($easy_title[$easy_i]) != '') && (trim($easy_link[$easy_i]) != '')) { ?>
        <div class="easy_title"><a href="<?php echo $easy_link[$easy_i]; ?>" target="_<?php echo $easy_target[$easy_i]; ?>" title="<?php echo $easy_title[$easy_i]; ?>"><?php echo $easy_title[$easy_i]; ?></a></div>
        <?php } ?>
        
    <!-- Image and Text -->
        <?php if ((trim($easy_image[$easy_i]) != '-1') && (trim($easy_text[$easy_i]) != '')) { ?>
        <div class="easy_wrapper">
        <div class="easy_img" style="width: <?php echo ($easy_conimgwidth[$easy_i]); ?>px;">
        <img src="<?php echo $mainframe->getCfg('live_site'); ?>/images/easyslider/<?php echo $easy_image[$easy_i]; ?>" title="<?php echo $easy_alt[$easy_i]; ?>" alt="<?php echo $easy_alt[$easy_i]; ?>" />
        </div>
        <div class="easy_text" style="width: <?php echo ($easy_width - $easy_conimgwidth[$easy_i]); ?>px;"><?php echo $easy_text[$easy_i]; ?>
        <?php if (trim($easy_link[$easy_i]) != '') { ?>
        <p class="easy_link"><a href="<?php echo $easy_link[$easy_i]; ?>" target="_<?php echo $easy_target[$easy_i]; ?>" title="<?php echo _READ_MORE; ?>"><?php echo _READ_MORE; ?></a></p>
        <?php } ?>
        </div>
        </div>
        <?php } ?>
        
    <!-- Only Text -->
        <?php if ((trim($easy_image[$easy_i]) == '-1') && (trim($easy_text[$easy_i]) != '')) { ?>    
        <div class="easy_fulltext"><?php echo $easy_text[$easy_i]; ?>
        <?php if (trim($easy_link[$easy_i]) != '') { ?>
        <p class="easy_link"><a href="<?php echo $easy_link[$easy_i]; ?>" target="_<?php echo $easy_target[$easy_i]; ?>" title="<?php echo _READ_MORE; ?>"><?php echo _READ_MORE; ?></a></p>
        <?php } ?>
        </div>   
        <?php } ?> 

    <!-- Only Image with Link on -->
        <!-- Case A: Alternate text defined -->
        <?php if ((trim($easy_image[$easy_i]) != '-1') && (trim($easy_text[$easy_i]) == '') && (trim($easy_link[$easy_i]) != '') && (trim($easy_alt[$easy_i]) != '')) { ?>
        <div class="easy_img" style="width: <?php echo $easy_conimgwidth[$easy_i]; ?>px;">
        <a href="<?php echo $easy_link[$easy_i]; ?>" target="_<?php echo $easy_target[$easy_i]; ?>" title="<?php echo $easy_alt[$easy_i]; ?>"><img src="<?php echo $mainframe->getCfg('live_site'); ?>/images/easyslider/<?php echo $easy_image[$easy_i]; ?>" title="<?php echo $easy_alt[$easy_i]; ?>" alt="<?php echo $easy_alt[$easy_i]; ?>" /></a>
        </div>
        <?php } ?>
        
        <!-- Case B: Alternate text not defined -->
        <?php if ((trim($easy_image[$easy_i]) != '-1') && (trim($easy_text[$easy_i]) == '') && (trim($easy_link[$easy_i]) != '') && (trim($easy_alt[$easy_i]) == '')) { ?>
        <div class="easy_img" style="width: <?php echo $easy_conimgwidth[$easy_i]; ?>px;">
        <a href="<?php echo $easy_link[$easy_i]; ?>" target="_<?php echo $easy_target[$easy_i]; ?>" title="<?php echo _READ_MORE; ?>"><img src="<?php echo $mainframe->getCfg('live_site'); ?>/images/easyslider/<?php echo $easy_image[$easy_i]; ?>" title="<?php echo _READ_MORE; ?>" alt="<?php echo _READ_MORE; ?>" /></a>
        </div>
        <?php } ?>
        
    <!-- Only Image without Link on -->
        <?php if ((trim($easy_image[$easy_i]) != '-1') && (trim($easy_text[$easy_i]) == '') && (trim($easy_link[$easy_i]) == '')) { ?>
        <div class="easy_img" style="width: <?php echo $easy_conimgwidth[$easy_i]; ?>px;">
        <img src="<?php echo $mainframe->getCfg('live_site'); ?>/images/easyslider/<?php echo $easy_image[$easy_i]; ?>" title="<?php echo $easy_alt[$easy_i]; ?>" alt="<?php echo $easy_alt[$easy_i]; ?>" />
        </div>
        <?php } ?> 
			</li>
			<?php } ?>
					
	  <?php } ?> 
	  
	  </ul>
   				
</div>
