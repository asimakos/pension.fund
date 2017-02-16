<?php 
/**
* @ Version: $Id: editor.xstandard.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006 GoUp Inc.
* @ Package: Elxis
* @ Subpackage: Editor
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Code was initially based on Mambo (www.mamboserver.com)
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
?>
<script type="text/javascript"> 
<!--
/** Wrapper around the editor specific update function in JavaScript
*/
function updateEditorContents( editorName, newValue ) {
	//TODO: correct call
}
//-->
</script>
<?php

function initEditor() {
}

function editorArea( $name, $content, $hiddenField, $width, $height, $col, $row ) {
?>
<object classid="clsid:0EED7206-1661-11D7-84A3-00606744831D" id="<?php echo $name; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>">
<param name="Value" value="<?php echo $content; ?>" />
</object>
<input type="hidden" name="<?php echo $hiddenField; ?>" id="<?php echo $hiddenField; ?>" value="" />
<?php
}

function getEditorContents( $editorArea, $hiddenfield ) {
?>
	document.getElementById('<?php echo $editorArea ; ?>').EscapeUNICODE = true;
	document.getElementById('<?php echo $hiddenfield ; ?>').value = document.getElementById('<?php echo $editorArea ; ?>').value;
<?php
}
?>
