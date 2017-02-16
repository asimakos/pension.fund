<?php 
/**
* @ Version: $Id: mospage.btn.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Bots/Editors-xtd
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @ Description: MosPage Button. Returns a three element array of ( imageName, textToInsert, tooltip )
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onCustomEditorButton', 'botMosPageButton' );

function botMosPageButton() {
    $tip = 'Inserts a page break. You may also set the page title and/or the heading<br>';
    $tip .= '<b>Examples:</b><br>';
    $tip .= '{mospagebreak}<br>';
    $tip .= '{mospagebreak title=The first page}<br>';
    $tip .= '{mospagebreak heading=The first page&amp;title=The page title}';

	return array( 'mospage.png', '{mospagebreak}', $tip );
}

?>