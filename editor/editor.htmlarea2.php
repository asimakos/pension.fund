<?php 
/** 
* @ Version: $Id: editor.htmlarea2.php 1878 2008-01-25 21:26:29Z datahell $
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


function initEditor() {
	global $mosConfig_live_site;
?>
<script language="JavaScript1.2" type="text/JavaScript1.2">
<!--
_editor_url = '<?php echo $mosConfig_live_site; ?>/editor/htmlarea2/';          // URL to htmlarea files
var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }

if (win_ie_ver >= 5.5) {
	document.write('<scr' + 'ipt src="' +_editor_url+ 'editor.js"');
	document.write(' language="Javascript1.2"></scr' + 'ipt>');
} else {
	document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>');
}

/** Wrapper around the editor specific update function in JavaScript
*/
function updateEditorContents( editorName, newValue ) {
	editor_setHTML( editorName, newValue );
}
//-->
</script>
<?php
}

function editorArea( $name, $content, $hiddenField, $width, $height, $col, $row ) {
?>
	<textarea name="<?php echo $hiddenField; ?>" id="<?php echo $hiddenField; ?>" cols="<?php echo $col; ?>" rows="<?php echo $row; ?>" style="width:<?php echo $width; ?>; height:<?php echo $height; ?>"><?php echo $content; ?></textarea>
	<script language="JavaScript1.2" defer="defer">
	<!--
	editor_generate('<?php echo $hiddenField ?>');
	//-->
	</script>
<?php
}

function getEditorContents( $editorArea, $hiddenField ) {
}
?>