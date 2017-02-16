<?php 
/**
* @version: $Id: mod_random_image.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Module Random Image
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


global $mainframe;

$type 	= $params->get('type', 'jpg');
$folder = $params->get('folder');
$link 	= $params->get('link');
$width 	= $params->get('width');
$height = $params->get('height');
$moduleclass_sfx = $params->get( 'moduleclass_sfx' );

$abspath_folder = $mainframe->getCfg('absolute_path').'/'.$folder;
$the_array = array();
$the_image = array();

if (is_dir($abspath_folder)) {
	if ($handle = @opendir($abspath_folder)) {
		while (false !== ($file = @readdir($handle))) {
			if ($file != '.' && $file != '..') {
				if (preg_match("/\.(jpg|gif|png|jpeg)$/i", $file)) { $the_array[] = $file; }
			}
		}
	}
	@closedir($handle);

	if (count($the_array) > 0) {
		foreach ($the_array as $img) {
			if (!is_dir($abspath_folder.'/'.$img)) {
				if ($type != '') {
					if (preg_match("/\.".$type."$/i", $img)) { $the_image[] = $img; }
				} else {
					$the_image[] = $img;
				}
			}
		}
	}

	if (count($the_image) == 0) {
		echo _E_NOIMAGES.'<br />'._LEND;
		return;
	} else {
		$i = count($the_image);
		$random = mt_rand(0, $i - 1);
		$image_name = $the_image[$random];
		$i = $abspath_folder . '/'. $image_name;
		$size = getimagesize ($i);
		if ($width == '') {
			$width = 100;
		}
		if ($height == '') {
			$coeff = $size[0]/$size[1];
			$height = (int) ($width/$coeff);
		}
		$image = $mainframe->getCfg('ssl_live_site').'/'.$folder.'/'.$image_name;
	}
  	?>
 	<div align="center"> 	
 	<?php 
  	if ($link) {
  	?>
        <a href="<?php echo $link; ?>" target="_self" title="<?php echo $image_name; ?>">
        <?php
  	}
  	?>
 	<img src="<?php echo $image; ?>" border="0" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="<?php echo $image_name; ?>" /><br />
 	<?php 
  	if ($link) {
        ?>
        </a>
  	    <?php
  	}
  	?>
 	</div>
  	<?php
}
?>