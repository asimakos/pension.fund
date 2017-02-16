<?php
/** 
* @ Version: $Id: editor.wysiwygpro.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Editor
* @ Author: Elxis Team
* @ E-mail: info@elxis.org
* @ URL: http://www.elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
?>
<script type="text/javascript"> 
<!--
/** Wrapper around the editor specific update function in JavaScript
*/
function updateEditorContents( editorName, newValue ) {
	wp_send_to_html( 'editorName' );
}
//-->
</script>
<?php
function initEditor() {
	global $mosConfig_live_site;
}

function editorArea( $name, $content, $hiddenField, $width, $height, $col, $row ) {
	global $mosConfig_absolute_path;

	$content = str_replace("&lt;", "<", $content);
	$content = str_replace("&gt;", ">", $content);
	$content = str_replace("&amp;", "&", $content);
	$content = str_replace("&nbsp;", " ", $content);
	$content = str_replace("&quot;", "\"", $content);

	// include the config file and editor class:
	include_once ($mosConfig_absolute_path.'/editor/wysiwygpro/config.php');
	include_once ($mosConfig_absolute_path.'/editor/wysiwygpro/editor_class.php');

	// create a new instance of the wysiwygPro class:
	$name = new wysiwygPro();

	$name->set_name($hiddenField);

	if ($hiddenField=='maintext') {
		$name->subsequent(true);
	}

	$name->usep(true);

	// insert some HTML
	$name->set_code($content);

	// print the editor to the browser:
	$name->print_editor('100%', intval($height));

}

function getEditorContents( $editorArea, $hiddenField ) {
?>

submit_form();

<?php
}
?>