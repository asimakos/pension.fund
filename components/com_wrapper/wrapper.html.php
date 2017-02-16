<?php 
/** 
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Wrapper
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_wrapper {

    /************************/
    /* HTML DISPLAY WRAPPER */
    /************************/
	static public function displayWrap( $row, &$params, &$menu ) {
?>
		<script type="text/javascript">
		<!--
		<?php echo $row['load']._LEND; ?>
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
		<div class="contentpane<?php echo $params->get( 'pageclass_sfx' ); ?>">
		<?php 
		if ( $params->get( 'page_title' ) ) {
			?>
			<h1 class="componentheading<?php echo $params->get( 'pageclass_sfx' ); ?>">
			    <?php echo $params->get('header'); ?>
			</h1>
			<?php
		}
		?>
		<iframe 
		id="blockrandom"
		src="<?php echo $row['url']; ?>" 
		width="<?php echo $params->get( 'width' ); ?>" 
		height="<?php echo $params->get( 'height' ); ?>" 
		scrolling="<?php echo $params->get( 'scrolling' ); ?>" 
		align="top"
		frameborder="0"
		class="wrapper<?php echo $params->get( 'pageclass_sfx' ); ?>">
		<?php echo _CMN_IFRAMES; ?>
		</iframe>

		</div>
		<?php 
		mosHTML::BackButton( $params );
	}
}

?>