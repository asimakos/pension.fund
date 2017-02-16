<?php

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $_VERSION;
if (version_compare($_VERSION->RELEASE.'.'.$_VERSION->DEV_LEVEL, '2009.2') >= 0) {
	$modulessl_url = $mainframe->getCfg('ssl_live_site');
} else {
	$module_ssl = 0;
	$modulessl_url = $mainframe->getCfg('live_site');
	if (isset($_SERVER['HTTPS'])) {
		if (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == 1)) { $module_ssl = 1; }
	}
	if (isset($_SERVER['SERVER_PORT']) && ($_SERVER['SERVER_PORT'] == 443)) { $module_ssl = 1; }
	if ($module_ssl == 1) { $modulessl_url = preg_replace('@^(http\:)@i', 'https:', $modulessl_url); }
	unset($module_ssl);
}
$module_url = $modulessl_url.'/modules/mod_codaslider/';
$imagefolder = $modulessl_url.'/images/stories/codaslider/';


//get all params

$autoscroll = $params->get('autoscroll');
$imagewidth = $params->get('imagewidth');
$imageheight = $params->get('imageheight');
$thumbwidth = $params->get('thumbwidth');
$thumbheight = $params->get('thumbheight');


function get_content($id=null){

	global $mosConfig_dbprefix;

	$sql = "SELECT * FROM ".$mosConfig_dbprefix."content WHERE id =".(int)$id." LIMIT 1";
	$result = mysql_query($sql);
	
	if(mysql_num_rows($result) < 1)
		return false;
		
	$row = mysql_fetch_array($result);
	return $row;

}


$slides = array();

$j=0;
for($i=1; $i<=10; $i++){

	if($params->get('slide'.$i) == 1){
		
		$j++;

		if($params->get('contentid'.$i)){
		
			global $mosConfig_sef;
		
			$row = get_content($params->get('contentid'.$i));

			$slides[$j]['title'] = $row['title'];
			$slides[$j]['description'] = $row['introtext'];
			$slides[$j]['thumb'] = $params->get('thumb'.$i);
			$slides[$j]['image'] = $params->get('image'.$i);
			$slides[$j]['content'] = $params->get('content'.$i);
			$slides[$j]['link'] = $params->get('link'.$i);
			$slides[$j]['linktarget'] = $params->get('linktarget'.$i);
			
		}else{
		
			$slides[$j]['title'] = $params->get('title'.$i);
			$slides[$j]['description'] = $params->get('description'.$i);
			$slides[$j]['thumb'] = $params->get('thumb'.$i);
			$slides[$j]['image'] = $params->get('image'.$i);
			$slides[$j]['content'] = $params->get('content'.$i);
			$slides[$j]['link'] = $params->get('link'.$i);
			$slides[$j]['linktarget'] = $params->get('linktarget'.$i);
		
		}

	}

}

?>

	<?php if(!empty($slides)): ?>

	<link rel="stylesheet" type="text/css" href="<?php echo $module_url; ?>style.css" />

	<style  type="text/css">
	
		.slider-wrap { width: <?php echo $params->get('imagewidth'); ?>px; }
		.stripViewer { width: <?php echo $params->get('imagewidth'); ?>px; height: <?php echo $params->get('imageheight'); ?>px; }
		.stripViewer .panelContainer .panel { width: <?php echo $params->get('imagewidth'); ?>px; }
		#movers-row div	{ width: <?php echo $params->get('thumbwidth'); ?>px; }
	
	</style>

	<script type="text/javascript" src="<?php echo $module_url; ?>js/jquery-1.2.6.min.js"></script>
	<script type="text/javascript" src="<?php echo $module_url; ?>js/jquery-easing-1.3.pack.js"></script>
	<script type="text/javascript" src="<?php echo $module_url; ?>js/jquery-easing-compatibility.1.2.pack.js"></script>
	<script type="text/javascript" src="<?php echo $module_url; ?>js/coda-slider.1.1.1.pack.js"></script>
	<script type="text/javascript" src="<?php echo $module_url; ?>js/script.js"></script>
	
	<script type="text/javascript">
	
		var autoscroll = <?php echo $params->get('autoscroll'); ?>;
		var autoscrollTime = <?php echo $params->get('autoscrolltime'); ?>;
		
	</script>
	
	

	<div class="slider-wrap" style="width: <?php echo $params->get('imagewidth'); ?>">
		<div id="main-photo-slider" class="csw">
			<div class="panelContainer">

				<?php for($i=1; $i<=count($slides); $i++): ?>

				<div class="panel" title="<?php echo $slides[$i]['title']; ?>">
					<div class="wrapper">
						<img src="<?php echo $imagefolder.$slides[$i]['image']; ?>" alt="coda slider" />
						<div class="photo-meta-data">
							<?php echo $slides[$i]['description']; ?>
							<?php if(!empty($slides[$i]['link'])): ?>
							<a href="<?php echo $slides[$i]['link']; ?>" target="<?php echo $slides[$i]['linktarget']; ?>"><?php echo _READ_MORE; ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>		
				
				<?php endfor; ?>

			</div>
		</div>

		<?php for($i=1; $i<=count($slides); $i++): ?>
		
		<?php if($i == 1): ?>
		
		<a href="#<?php echo $i; ?>" class="cross-link active-thumb"><img src="<?php echo $imagefolder.$slides[$i]['thumb']; ?>" class="nav-thumb" alt="temp-thumb" /></a>
		
		<?php endif; ?>
		
		<?php if($i == 2): ?>
		<div id="movers-row">
		<?php endif; ?>
		
		<?php if($i > 1): ?>
		<div><a href="#<?php echo $i; ?>" class="cross-link"><img src="<?php echo $imagefolder.$slides[$i]['thumb']; ?>" class="nav-thumb" alt="temp-thumb" /></a></div>
		<?php endif; ?>
		
		<?php endfor; ?>
		
		<?php if($i > 1): ?>
		</div>
		<?php endif; ?>

	</div>
	
	<?php endif; //end of !empty slides ?>
