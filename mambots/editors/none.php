<?php 
/**
* @ Version: $Id: none.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Bots/Editors - No WYSIWYG Editor
* @ URL: http://www.elxis.org
* @ Email: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @ Description: No WYSIWYG Editor - javascript initialisation
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onInitEditor', 'botNoEditorInit' );
$_MAMBOTS->registerFunction( 'onGetEditorContents', 'botNoEditorGetContents' );
$_MAMBOTS->registerFunction( 'onEditorArea', 'botNoEditorEditorArea' );


function botNoEditorInit() {
	return <<<EOD
<script type="text/javascript">
	function insertAtCursor(myField, myValue) {
		if (document.selection) {
			// IE support
			myField.focus();
			sel = document.selection.createRange();
			sel.text = myValue;
		} else if (myField.selectionStart || myField.selectionStart == '0') {
			// MOZILLA/NETSCAPE support
			var startPos = myField.selectionStart;
			var endPos = myField.selectionEnd;
			myField.value = myField.value.substring(0, startPos)
				+ myValue
				+ myField.value.substring(endPos, myField.value.length);
		} else {
			myField.value += myValue;
		}
	}
</script>
EOD;
}
/**
* No WYSIWYG Editor - copy editor contents to form field
* @param string The name of the editor area
* @param string The name of the form field
*/
function botNoEditorGetContents( $editorArea, $hiddenField ) {
	return <<<EOD
EOD;
}
/**
* No WYSIWYG Editor - display the editor
* @param string The name of the editor area
* @param string The content of the field
* @param string The name of the form field
* @param string The width of the editor area
* @param string The height of the editor area
* @param int The number of columns for the editor area
* @param int The number of rows for the editor area
*/
function botNoEditorEditorArea( $name, $content, $hiddenField, $width, $height, $col, $row ) {
	global $mosConfig_live_site, $_MAMBOTS;

    $width = intval($width) ? $width : '500'; //no percentage values
    $height = intval($height) ? $height : '200'; //no percentage values

	$results = $_MAMBOTS->trigger( 'onCustomEditorButton' );
	$buttons = array();
	foreach ($results as $result) {
	    $buttons[] = '<img src="'.$mosConfig_live_site.'/mambots/editors-xtd/'.$result[0].'" onclick="insertAtCursor( document.adminForm.'.$hiddenField.', \''.$result[1].'\' )" />';
	}
	$buttons = implode( "", $buttons );

	return <<<EOD
<textarea name="$hiddenField" id="$hiddenField" cols="$col" rows="$row" style="width:{$width}px; height:{$height}px;">$content</textarea>
<br />$buttons
EOD;
}
?>