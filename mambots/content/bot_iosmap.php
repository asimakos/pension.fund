<?php 
/**
* @version: 1.2
* @copyright: Copyright (C) 2008-2010 Ioannis Sannos. All rights reserved.
* @package: Elxis
* @subpackage: Bots / Bot IOS Map
* @author: Ioannis Sannos
* @link: http://www.isopensource.com
* @email: info@isopensource.com
* @license: GNU/GPL
* Elxis CMS is a Free Software
* @description: Generates google maps
* @example of usage:
* {iosmap title=XXXX&info=yyyy}address{/iosmap}
* title (Optional), the link title below the map for the selected location
* info (Optional), description of the location
* address: a valid google map address using normal address or latitude (i.e. "athens, greece" or "38.070989, 23.766053")
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.') ;


$_MAMBOTS->registerFunction('onPrepareContent', 'botIOSMap') ;


/*********************/
/* MAIN BOT FUNCTION */
/*********************/
function botIOSMap($published, &$row, $params, $page=0) {
	global $database, $_MAMBOTS;

    $regex = "#{iosmap\s*.*?}(.*?){/iosmap}#s";

    if (!$published) {
    	$row->text = preg_replace( $regex, '', $row->text );
    	return;
    }

	if ( strpos( $row->text, 'iosmap' ) === false ) { return true; }

	$matches = array();
	preg_match_all( $regex, $row->text, $matches, PREG_SET_ORDER );

	if ($matches) {
		if (!isset($_MAMBOTS->_content_bot_params['bot_iosmap'])) {
			$query = "SELECT params FROM #__mambots WHERE element = 'bot_iosmap' AND folder = 'content'";
			$database->setQuery( $query, '#__', 1, 0);
			$database->loadObject($mambot);
			$_MAMBOTS->_content_bot_params['bot_iosmap'] = $mambot;
		}

		$mambot = $_MAMBOTS->_content_bot_params['bot_iosmap'];
		$botParams = new mosParameters( $mambot->params );

		foreach ($matches as $match) {
			$address = '';
			$title = '';
			$info = '';			

			if (isset($match[1]) && (trim($match[1]) != '')) {
				$address = eUTF::utf8_trim($match[1]);
			}

			if ($address == '') {
			    $row->text = preg_replace( $regex, '', $row->text );
				return;
			}

			$endbot = eUTF::utf8_strpos($match[0], '}');
			$arguments = eUTF::utf8_substr($match[0], 8, $endbot-8);
			$arguments = eUTF::utf8_str_replace("&nbsp;", " ", $arguments);
			$arguments = eUTF::utf8_str_replace("&amp;", "&", $arguments);
			parse_str( $arguments, $args );

			if (isset($args['title'])) {
				$title = eUTF::utf8_trim($args['title']);
			}
			if (isset($args['info'])) {
				$info = eUTF::utf8_trim($args['info']);
			}

			$maptxt = botIOSMapRun( $botParams, $address, $title, $info );
			$row->text = preg_replace($regex, $maptxt, $row->text, 1);
		}
		return true;
	}
}


/*******************************/
/* GENERATE MAP AND JAVASCRIPT */
/*******************************/
function botIOSMapRun($botParams, $address, $title, $info) {
	global $mosConfig_absolute_path, $mainframe;

	$mapkey = trim($botParams->def('mapkey', ''));
	if ($mapkey == '') { return ''; }

	require_once($mosConfig_absolute_path.'/mambots/content/bot_iosmap/iosmap.class.php');
	$iosm = new iosMap(''.$mapkey.'');

	$iosm->mContinuousZoom = intval($botParams->def('mContinuousZoom', 0)) ? true : false;
	$iosm->mDoubleClickZoom  = intval($botParams->def('mDoubleClickZoom', 0)) ? true : false;
	$iosm->mScale  = intval($botParams->def('mScale', 1)) ? true : false;
	$iosm->mInset  = intval($botParams->def('mInset', 0)) ? true : false;
	$iosm->mMapType  = intval($botParams->def('mMapType', 0)) ? true : false;
	$iosm->maptypedef = intval($botParams->def('maptypedef', 1));

	$mapwidth = intval($botParams->def('mapwidth', 400));
	$mapheight = intval($botParams->def('mapheight', 400));
	$iosm->SetMapWidth($mapwidth);
	$iosm->SetMapHeight($mapheight);

	$mapzoom = intval($botParams->def('mapzoom', 13));
	$iosm->SetMapZoom($mapzoom);

	$showsidelink = intval($botParams->def('showsidelink', 0));
	$iosm->SetShowLink($showsidelink);

	$mapcontrol = $botParams->def('mapcontrol', 'SMALL_PAN_ZOOM');
	$iosm->SetMapControl($mapcontrol);

	$miconstyle = $botParams->def('miconstyle', 'GT_FLAT');
	$iosm->SetMarkerIconStyle($miconstyle);

	$miconcolor = $botParams->def('miconcolor', 'PACIFICA');
	$iosm->SetMarkerIconColor($miconcolor);

	if ($info == '') { $info = $address; }
	if ($title == '') { $title = $address; }

	$iosm->SetAddress($address, $title, $info);

	$mainframe->addCustomHeadTag($iosm->GmapsKey());

	$out = $iosm->MapHolder();
	$out .= $iosm->InitJs();
	$out .= $iosm->GetSideClick();
	$out .= $iosm->UnloadMap();
	unset($iosm);

	return $out;
}

?>