<?php 
/** 
* @ Version: $Id: editor.php 1878 2008-01-25 21:26:29Z datahell $
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


if (!defined( '_MOS_EDITOR_INCLUDED' )) {
	$_MAMBOTS->loadBotGroup( 'editors' );
	$_MAMBOTS->loadBotGroup( 'editors-xtd' );

	function initEditor() {
		global $_MAMBOTS;

		$results = $_MAMBOTS->trigger( 'onInitEditor' );
		foreach ($results as $result) {
		    if (trim($result)) {
		        echo $result;
			}
		}
	}
	function getEditorContents( $editorArea, $hiddenField ) {
		global $_MAMBOTS;

		$results = $_MAMBOTS->trigger( 'onGetEditorContents', array( $editorArea, $hiddenField ) );
		foreach ($results as $result) {
		    if (trim($result)) {
		        echo $result;
			}
		}
	}
	// just present a textarea
	function editorArea( $name, $content, $hiddenField, $width, $height, $col, $row ) {
		global $_MAMBOTS;

		$results = $_MAMBOTS->trigger( 'onEditorArea', array( $name, $content, $hiddenField, $width, $height, $col, $row ) );
		foreach ($results as $result) {
		    if (trim($result)) {
		        echo $result;
			}
		}
	}
	define( '_MOS_EDITOR_INCLUDED', 1 );
}
?>