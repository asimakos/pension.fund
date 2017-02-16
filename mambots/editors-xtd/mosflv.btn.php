<?php 
/** 
* @ Version: $Id: mosflv.btn.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Bots/Editors-xtd
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @ Description: MosFLV Button. Returns a three element array of ( imageName, textToInsert, tooltip )
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onCustomEditorButton', 'botMosFLVButton' );

function botMosFLVButton() {
    $tip = 'You can have as input an absolute or relative path to an FLV video file or even a URL. You may also set the video size.<br>';
    $tip .= '<b>Examples:</b><br />';
    $tip .= '{mosflv}/images/videos/myvideo.flv{/mosflv}<br>';
    $tip .= '{mosflv}http://www.mysite.com/media/myvideo.flv{/mosflv}<br>';
    $tip .= '{mosflv width=320&height=280}myvideo.flv{/mosflv}';

	return array( 'mosflv.png', '{mosflv}path_to_flv_video.flv{/mosflv}', $tip );
}

?>