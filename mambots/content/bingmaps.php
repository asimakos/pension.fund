<?php
/**
* @ Bingmaps bot for Elxis CMS
* @ Version: 1.0
* @ Copyright: Copyright (C) 2012 osw.gr
* @ Package: Elxis
* @ Subpackage: Mambots/Content
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @ Description: Displays embedded Bing Maps into Elxis content
* @ Author: Nikos Vlachtsis 
* @ AuthorURL: www.osw.gr
* @ General Usage: {bingmaps}latitude_longitude,zoom,width,height,info{/bingmaps}
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

$_MAMBOTS->registerFunction('onPrepareContent', 'elxbingmaps');

function elxbingmaps($published, &$row, $params, $page=0 ) {

global $mainframe, $_MAMBOTS, $_VERSION;

	$regex = "#{bingmaps}(.*?),(.*?),(.*?),(.*?),(.*?){/bingmaps}#s";

	if ( !$published ) {
		$row->text = preg_replace( $regex, '', $row->text );
		return;
	}
	
	if (!defined('BOTBINGMAPSSSLURL')) {
    	if (version_compare($_VERSION->RELEASE.'.'.$_VERSION->DEV_LEVEL, '2009.2', '>=')) {
    		define('BOTBINGMAPSSSLURL', $mainframe->getCfg('ssl_live_site'));
    	} else {
    		define('BOTBINGMAPSSSLURL', $mainframe->getCfg('live_site'));
    	}
    }
	
	if (!defined('BINGMAPSCSS')) {
  $headcss = '<link rel="stylesheet" type="text/css" href="'.BOTBINGMAPSSSLURL.'/mambots/content/bingmaps/bingmaps.css" media="all" />';
  $mainframe->addCustomHeadTag($headcss);

   define('BINGMAPSCSS', 1);
	}

	$row->text = preg_replace_callback( $regex, 'elxbingmaps_replacer', $row->text );
	return true;
}

/************/
/* REPLACER */
/************/
function elxbingmaps_replacer ( &$matches ) {

  /* Parameters */ 
  
  /* Location Coordinates (Latitude and Longitude) */
  if (isset($matches[1])) {
  $bingmaps_coords = $matches[1];
  $bingmaps_coords = preg_replace('/^0-9\-\.\,\_$/', "", $bingmaps_coords);
  }
  
  /* Zoom Level*/
  $bingmaps_zoom = $matches[2];
  $bingmaps_zoom = preg_replace('/^0-9$/', "", $bingmaps_zoom);
  if ($bingmaps_zoom == '') { $bingmaps_zoom = 16; }
    
  /* Map Width */ 
  $bingmaps_width = $matches[3];
  $bingmaps_width = preg_replace('/^0-9$/', "", $bingmaps_width);
  if ($bingmaps_width == '') { $bingmaps_width = 400; }
  if ($bingmaps_width < 400) { $bingmaps_width = 400; }
  $infowidth = (($bingmaps_width - 37).'px;');
    
  /* Map Height */  
  $bingmaps_height = $matches[4];
  $bingmaps_height = preg_replace('/^0-9$/', "", $bingmaps_height);
  if ($bingmaps_height == '') { $bingmaps_height = 200; }
  if ($bingmaps_height < 200) { $bingmaps_height = 200; }
  
  /* Location Info */
  if (isset($matches[5]) && (trim($matches[5]) != '')) {
		$bingmaps_info = eUTF::utf8_trim($matches[5]);
	}

$out .= "<div>\n";   
$out .= "<iframe width=\"$bingmaps_width\" height=\"$bingmaps_height\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"http://dev.virtualearth.net/embeddedMap/v1/ajax/aerial?zoomLevel=$bingmaps_zoom&amp;center=$bingmaps_coords&amp;pushpins=$bingmaps_coords\"></iframe>\n";
$out .= "<div class=\"infoloc\" style=\"width:$infowidth\">$bingmaps_info</div>\n";
$out .= "</div>\n";  
    return $out;
}

?>
