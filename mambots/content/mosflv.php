<?php 
/**
* @version: $Id: mosflv.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2007-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Bots/Content
* @author: Ioannis Sannos (datahell)
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Displays FLV videos in content
* @usage:
* Default values: {mosflv}pathtofile/filename.flv{/mosflv}
* Size customization: {mosflv width=width_in_px & height=height_in_pixels}pathtofile/filename.flv{/mosflv}
* @examples:
* {mosflv}myvideo.flv{/mosflv}
* {mosflv}http://www.mysite.com/media/myvideo.flv{/mosflv}
* {mosflv width=200&height=180}/images/videos/myvideo.flv{/mosflv}
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onPrepareContent', 'botMosFLV' );


/**************/
/* MOSFLV BOT */
/**************/
function botMosFLV( $published, &$row, $params, $page=0 ) {
	global $database, $_MAMBOTS;

	//check if we need to proceed further
	if ( strpos( $row->text, 'mosflv' ) === false ) { return true; }

    $regex = "#{mosflv\s*.*?}(.*?){/mosflv}#s";

    if (!$published) {
    	$row->text = preg_replace( $regex, '', $row->text );
    	return;
    }

	$matches = array();
	preg_match_all( $regex, $row->text, $matches, PREG_SET_ORDER );

	//check if param query has previously been processed
	if ( !isset($_MAMBOTS->_content_bot_params['mosflv']) ) {
		//load bot params info
		$query = "SELECT params FROM #__mambots WHERE element = 'mosflv' AND folder = 'content'";
		$database->setQuery( $query, '#__', 1, 0);
		$database->loadObject($mambot);

		$_MAMBOTS->_content_bot_params['mosflv'] = $mambot;
	}

	$mambot = $_MAMBOTS->_content_bot_params['mosflv'];

	$params = new mosParameters( $mambot->params );

    $GLOBALS["botFLVWidth"] = $params->get('width', 320);
    $GLOBALS["botFLVHeight"] = $params->get('height', 260);

    $row->text = preg_replace_callback( $regex, 'botMosFLV_replacer', $row->text );

    unset( $GLOBALS['botFLVWidth'] );
    unset( $GLOBALS['botFLVHeight'] );

	return true;
}


/*******************/
/* MOSFLV REPLACER */
/*******************/
function botMosFLV_replacer( &$matches ) {
	global $mosConfig_live_site;

	//$file can be any path or url
    $file = trim($matches[1]);
    //make sure file is an flv video
	if	(!preg_match('/([\.]flv)$/', $file)) {
	    $code = '';
	} else {
        $endflv=strpos($matches[0], '}');
        $arguments=substr($matches[0], 8, $endflv-8);

        $arguments=str_replace("&nbsp;", " ", $arguments);
        $arguments=str_replace("&gt;", ">", $arguments);
        $arguments=str_replace("&lt;", "<", $arguments);
        $arguments=str_replace("&amp;", "&", $arguments);
        parse_str( $arguments, $args );
        //Width
        if ( @$args['width'] && is_numeric(@$args['width'])) {
            $width = $args['width'];
        } else { 
            $width = $GLOBALS["botFLVWidth"];
        }
        //Height
        if ( @$args['height'] && is_numeric(@$args['height'])) {
            $height = $args['height'];
        } else { 
            $height = $GLOBALS["botFLVHeight"];
        }

        $video = $mosConfig_live_site.'/mambots/content/flv/flvplayer.swf?file='.$file.'&autoStart=false';

	    $code .= "<div class=\"flvvideo\"><object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\""
        ." codebase=\"http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0\""
        ." type=\"application/x-shockwave-flash\""
	    ." width=\"".$width."\" height=\"".$height."\""
	    ." wmode=\"transparent\" data=\"".$video."\">"._LEND
        ."<param name=\"quality\" value=\"high\" />"._LEND
	    ."<param name=\"movie\" value=\"".$video."\">"._LEND
	    ."<param name=\"wmode\" value=\"transparent\">"._LEND
	    ."<embed src=\"".$video."\" quality=\"high\" width=\"".$width."\" height=\"".$height."\""
        ." name=\"flvplayer\" align=\"middle\" type=\"application/x-shockwave-flash\""
        ." pluginspage=\"http://www.macromedia.com/go/getflashplayer\" />"._LEND
	    ."</object></div>"._LEND;

	   return $code; 
	}
}

?>