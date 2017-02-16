<?php 
/**
* @ Version: $Id: mod_wrapper.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Module Wrapper
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$params->def('url', '');
$params->def('scrolling', 'auto');
$params->def('height', '200');
$params->def('height_auto', '0');
$params->def('width', '100%');
$params->def('add', '1');

$url = $params->get('url');
if ( $params->get( 'add' ) ) {
	if ( !strstr( $url, 'http' ) && !strstr( $url, 'https' ) ) {
		$url = 'http://'. $url;
	}
}

//auto height control
if ( $params->get( 'height_auto' ) ) {
    $load = 'onload="iFrameHeight();"';
} else {
	$load = '';
}

if (strlen($url) > 10) {
?>
<script type="text/javascript">
<!--
function iFrameHeight() {
	var h = 0;
	if ( !document.all ) {
		h = document.getElementById('blockrandom').contentDocument.height;
		document.getElementById('blockrandom').style.height = h + 60 + 'px';
	} else if( document.all ) {
		h = document.frames('blockrandom').document.body.scrollHeight;
		document.all.blockrandom.style.height = h + 20 + 'px';
	}
}
//-->
</script>
<iframe 
<?php echo $load; ?> 
id="blockrandom" 
src="<?php echo $url; ?>" 
width="<?php echo $params->get('width'); ?>" 
height="<?php echo $params->get('height'); ?>" 
scrolling="<?php echo $params->get('scrolling'); ?>" 
align="top" 
frameborder="0" 
class="wrapper<?php echo $params->get('pageclass_sfx'); ?>">
</iframe>
<?php 
} 
?>