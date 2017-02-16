<?php 
/**
* @ Version: $Id: mosimage.btn.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Bots/Editors-xtd
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @ Description: MosImage Button. Returns a three element array of ( imageName, textToInsert, tooltip )
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onCustomEditorButton', 'botMosImageButton' );

function botMosImageButton() {
    $tip = 'Inserts mosimage mambot images<br>';
    $tip .= '<b>Usage:</b><br>';
    $tip .= '{mosimage}';

	return array( 'mosimage.png', '{mosimage}', $tip );
}

?>