<?php 
/**
* @version: $Id: mosimage.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Bots/Content - mosImage
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Image Bot
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onPrepareContent', 'botMosImage' );


/****************/
/* BOT MOSIMAGE */
/****************/
function botMosImage( $published, &$row, $params, $page=0 ) {
	global $database, $_MAMBOTS;

	//check if we need to proceed further
	if ( strpos( $row->text, 'mosimage' ) === false ) {
		return true;
	}

 	//expression to search for
	$regex = '/{mosimage\s*.*?}/i';

	//check if we need to proceed further (2)
	if (!$published || !$params->get( 'image' )) {
		$row->text = preg_replace( $regex, '', $row->text );
		return true;
	}

	//find all instances of mambot and put in $matches
	preg_match_all( $regex, $row->text, $matches );

	$count = count( $matches[0] );

 	//bot only processes if there are any instances of the bot in the text
 	if ( $count ) {
		//check if param query has previously been processed
		if ( !isset($_MAMBOTS->_content_bot_params['mosimage']) ) {
			//load bot params info
			$query = "SELECT params FROM #__mambots WHERE element = 'mosimage' AND folder = 'content'";
			$database->setQuery( $query, '#__', 1, 0);
			$database->loadObject($mambot);

			$_MAMBOTS->_content_bot_params['mosimage'] = $mambot;
		}

		$mambot = $_MAMBOTS->_content_bot_params['mosimage'];

	 	$params = new mosParameters( $mambot->params );

	 	$params->def( 'padding' );
	 	$params->def( 'margin' );
	 	$params->def( 'link', 0 );

		$images = processImages( $row, $params );

		//store some vars in globals to access from the replacer
		$GLOBALS['botMosImageCount'] 	= 0;
		$GLOBALS['botMosImageParams'] 	=& $params;
		$GLOBALS['botMosImageArray'] 	=& $images;
		//$GLOBALS['botMosImageArray'] 	=& $combine;

		//perform the replacement
		$row->text = preg_replace_callback( $regex, 'botMosImage_replacer', $row->text );

		unset( $GLOBALS['botMosImageCount'] );
		unset( $GLOBALS['botMosImageMask'] );
		unset( $GLOBALS['botMosImageArray'] );

		return true;
	} 	
}


/**********************/
/* PROCESS BOT IMAGES */
/**********************/
function processImages ( &$row, &$params ) {
	global $mainframe;

	$images = array();

	//split on \n the images fields into an array
	$row->images = explode( "\n", $row->images );
	$total = count( $row->images );

	$start = 0;
	for ( $i = $start; $i < $total; $i++ ) {
		$img = trim( $row->images[$i] );

		//split on pipe the attributes of the image
		if ( $img ) {
			$attrib = explode( '|', trim( $img ) );
			$i_path = $attrib[0];//path from /images/stories
			$i_align = (isset($attrib[1]) && ($attrib[1] != '')) ? $attrib[1] : ''; //image alignment (left, right, center)
			$i_title = (isset($attrib[2]) && ($attrib[2] != '')) ? htmlspecialchars($attrib[2]) : $attrib[0]; //image alt (and title)
			$i_border = isset($attrib[3]) ? intval($attrib[3]) : '0'; //image border in pixel
			$i_caption = (isset($attrib[4]) && ($attrib[4] != '')) ? htmlspecialchars($attrib[4]) : ''; //image caption
			$i_border = ($i_caption != '') ? '0' : $i_border; //remove border if caption used
			if (isset($attrib[5])) { //caption position (top, bottom)
				$i_captionpos = ($attrib[5] == 'top') ? 'top' : 'bottom';
			} else {
				$i_captionpos = 'bottom';
			}
			$i_captionalign = (isset($attrib[6]) && ($attrib[6] != '')) ? $attrib[6] : ''; //caption alignment (left, right, center)
			$i_captionwidth = isset($attrib[7]) ? intval($attrib[7]) : '0'; //caption width in pixel
			$width = ($i_captionwidth) ? 'width: '.$i_captionwidth.'px;' : '';

			//image size attibutes
			$size = '';
			if ( function_exists( 'getimagesize' ) ) {
				$size 	= @getimagesize($mainframe->getCfg('absolute_path').'/images/stories/'.$i_path);
				if (is_array( $size )) {
					$size = ' width="'.$size[0].'" height="'.$size[1].'"';
				}
			}

			//assemble the <img> tag
			$image = '<img src="'.$mainframe->getCfg('ssl_live_site').'/images/stories/'.$i_path.'"'.$size;
			if ( $i_caption == '') { //no aligment variable - if caption detected
				$image .= ($i_align != '') ? ' align="'.$i_align.'"' : '';
			}
			$image .=' hspace="6" alt="'.$i_title.'" title="'.$i_title.'" border="'.$i_border.'" />';

			//assemble caption - if caption detected
			if ( $i_caption != '' ) {
				$caption = '<div class="mosimage_caption" style="'.$width;
				if ($i_captionalign != '') {
					$caption .= ' text-align: '.$i_captionalign.';" align="'.$i_captionalign.'">';
				} else {
					$caption .= '">';
				}
				$caption .= $i_caption;
				$caption .='</div>';
			}

			//final output
			if ( $i_caption != '' ) {
				$img = '<div class="mosimage" style="border-width: '.$i_border.'px;';
				if ($i_align != '') {
					$img .= ' float: '.$i_align.';';
				}
				$img .= ' margin: '.intval($params->def( 'margin' )).'px; padding: '.intval($params->def( 'padding' )).'px; '.$width.'" align="center">';
				//display caption in top position
				if ( $i_captionpos == 'top' ) { $img .= $caption; }
				$img .= $image;				
				//display caption in bottom position
				if ( $i_captionpos == 'bottom' ) { $img .= $caption; }
				$img .='</div>';
			} else {
				$img = $image;
			}

			$images[] = $img;
		}
	}
	return $images;
}


function botMosImage_replacer( &$matches ) {
	$i = $GLOBALS['botMosImageCount']++;
	
	return @$GLOBALS['botMosImageArray'][$i];
}

?>