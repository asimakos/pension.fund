<?php 
/**
* @ Version: $Id: mod_templatechooser.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Module Template Chooser
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $cur_template;

//titlelength can be set in module params
$titlelength = $params->get( 'title_length', 20 );
$preview_height = $params->get( 'preview_height', 90 );
$preview_width = $params->get( 'preview_width', 140 );
$show_preview = $params->get( 'show_preview', 0 );

// Read files from template directory
$template_path = $mosConfig_absolute_path.'/templates';
$templatefolder = @dir( $template_path );
$darray = array();
if ($templatefolder) {
	while ($templatefile = $templatefolder->read()) {
		if (($templatefile != ".") && ($templatefile != "..") && ($templatefile != "svn") && is_dir( $template_path.'/'.$templatefile )) {
			if(strlen($templatefile) > $titlelength) {
				$templatename = substr( $templatefile, 0, $titlelength-3 );
				$templatename .= '...';
			} else {
				$templatename = $templatefile;
			}
			$darray[] = mosHTML::makeOption( $templatefile, $templatename );
		}
	}
	$templatefolder->close();
}

sort( $darray );

// Show the preview image
// Set up JavaScript for instant preview
$onchange = "";
if ($show_preview) {
	$onchange = "showimage();";
?>
<img src="templates/<?php echo $cur_template; ?>/template_thumbnail.png" name="preview" border="1" width="<?php echo $preview_width; ?>" height="<?php echo $preview_height; ?>" alt="<?php echo $cur_template; ?>" />
<script type="text/javascript">
<!--
	function showimage() {
		//if (!document.images) return;
		document.images.preview.src = 'templates/' + getSelectedValue( 'templateform', 'mos_change_template' ) + '/template_thumbnail.png';
	}
	function getSelectedValue( frmName, srcListName ) {
		var form = eval( 'document.' + frmName );
		var srcList = eval( 'form.' + srcListName );

		i = srcList.selectedIndex;
		if (i != null && i > -1) {
			return srcList.options[i].value;
		} else {
			return null;
		}
	}
-->
</script>
<?php
}

//xhtml compatibility
$link = str_replace('&', '&amp;', urldecode($_SERVER['REQUEST_URI']));
?>
<form action="<?php echo $link; ?>" name="templateform" method="post">
<?php
echo mosHTML::selectList( $darray, 'mos_change_template', 'class="selectbox" dir="ltr" onchange="'.$onchange.'"','value', 'text', $cur_template );
?>
<input type="submit" name="subchange_template" class="button" value="<?php echo _CMN_SELECT; ?>" title="Change template"  />
</form>
