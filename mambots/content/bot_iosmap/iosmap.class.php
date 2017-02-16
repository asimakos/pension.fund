<?php 
/**
* @version: 1.2
* @copyright: Copyright (C) 2008-2010 Ioannis Sannos. All rights reserved.
* @package: Elxis
* @subpackage: Bots / Bot IOS Map
* @author: Ioannis Sannos
* @link: http://www.isopensource.com
* @email: datahell@elxis.org
* @license: GNU/GPL
* Elxis CMS is a Free Software
* @description: Generates google maps
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.') ;


class iosMap {

	private $imap = 'iosmap';
	private $rnd = 0;
	private $address = '';
	private $title = '';
	private $info = '';
	private $showsidelink = 0;
	private $mMapKey = '';
	public $mMapWidth = 400; 
	public $mMapHeight = 300;
	public $mMapZoom = 13;
	public $mDefColor; //Var Holder of Marker Icon Color Scheme
	//Arrays of Marker Icon Color Scheme
	public $mIconColor = array(
		'PACIFICA'		=>'pacifica',
		'YOSEMITE'		=>'yosemite',
		'MOAB'			=>'moab',
		'GRANITE_PINE'	=>'granitepine',
		'DESERT_SPICE'	=>'desertspice',
		'CABO_SUNSET'	=>'cabosunset',
		'TAHITI_SEA'	=>'tahitisea',
		'POPPY'			=>'poppy',
		'NAUTICA'		=>'nautica',
		'DEEP_JUNGLE'	=>'deepjungle',
		'SLATE'			=>'slate'
	);
	public $mDefStyle; //Var Holder of Marker Icon
	//Arrays of Marker Icon Scheme
	public $mIconStyle = array(
		'FLAG'		=>array(
			'DIR'				=>'flag', 
			'ICON_W'			=>31, 
			'ICON_H'			=>35, 
			'ICON_ANCHR_W'		=>4, 
			'ICON_ANCHR_H'		=>27, 
			'INFO_WIN_ANCHR_W'	=>8, 
			'INFO_WIN_ANCHR_H'	=>3
		),
		'GT_FLAT'	=>array(
			'DIR'				=>'traditionalflat', 
			'ICON_W'			=>34, 
			'ICON_H'			=>35, 
			'ICON_ANCHR_W'		=>9, 
			'ICON_ANCHR_H'		=>23, 
			'INFO_WIN_ANCHR_W'	=>19, 
			'INFO_WIN_ANCHR_H'	=>0
		),
		'GT_PILLOW'	=>array(
			'DIR'				=>'traditionalpillow', 
			'ICON_W'			=>34, 
			'ICON_H'			=>35, 
			'ICON_ANCHR_W'		=>9, 
			'ICON_ANCHR_H'		=>23, 
			'INFO_WIN_ANCHR_W'	=>19, 
			'INFO_WIN_ANCHR_H'	=>0
		),
		'HOUSE'		=>array(
			'DIR'				=>'house', 
			'ICON_W'			=>24, 
			'ICON_H'			=>14, 
			'ICON_ANCHR_W'		=>9, 
			'ICON_ANCHR_H'		=>13, 
			'INFO_WIN_ANCHR_W'	=>9, 
			'INFO_WIN_ANCHR_H'	=>0
		),
		'PIN'		=>array(
			'DIR'				=>'pin', 
			'ICON_W'			=>31, 
			'ICON_H'			=>24, 
			'ICON_ANCHR_W'		=>17, 
			'ICON_ANCHR_H'		=>22, 
			'INFO_WIN_ANCHR_W'	=>17, 
			'INFO_WIN_ANCHR_H'	=>0
		),
		'PUSH_PIN'	=>array(
			'DIR'				=>'pushpin', 
			'ICON_W'			=>40, 
			'ICON_H'			=>41, 
			'ICON_ANCHR_W'		=>7, 
			'ICON_ANCHR_H'		=>38, 
			'INFO_WIN_ANCHR_W'	=>26, 
			'INFO_WIN_ANCHR_H'	=>1
		),
		'STAR'		=>array(
			'DIR'				=>'star', 
			'ICON_W'			=>29, 
			'ICON_H'			=>39, 
			'ICON_ANCHR_W'		=>15, 
			'ICON_ANCHR_H'		=>15, 
			'INFO_WIN_ANCHR_W'	=>19, 
			'INFO_WIN_ANCHR_H'	=>7
		)
	);
	public $mDefControl; //Var Holder of Map Control
	public $mControl = array( 'NONE', 'SMALL_PAN_ZOOM', 'LARGE_PAN_ZOOM', 'SMALL_ZOOM');
	public $mContinuousZoom = false; //Enable/Disable Map Continuous Zooming
	public $mDoubleClickZoom = false; //Enable/Disable Map Double Click Zooming
	public $mScale = true; //Enable/Disable Map Scale (MI/KM)
	public $mInset = false; //Enable/Disable Map Inset
	public $mMapType = false; //Enable/Disable Map Type (Map/Satellite/Hybrid)
	public $maptypedef = ''; //empty, G_SATELLITE_MAP, G_HYBRID_MAP


	/***************/
	/* CONSTRUCTOR */
	/***************/
	public function __construct($mapKey) {
		$this->rnd = rand(1000, 9999);
		$this->imap = 'iosmap'.$this->rnd;
		$this->mMapKey = $mapKey;
		$this->SetMapWidth();
		$this->SetMapHeight();
		$this->SetMapZoom();
		$this->SetMarkerIconColor();
		$this->SetMarkerIconStyle();
		$this->SetMapControl();
	}


	/*****************/
	/* SET ADDRESSES */
	/*****************/
	public function SetAddress($address, $title, $info) {
		$pat = "/([\']|[\"]|[\$]|[\#]|[\<]|[\>]|[\*]|[\%]|[\~]|[\`]|[\^]|[\|]|[\{]|[\}]|[\\\])/";
		$this->address = preg_replace($pat, '', $address);
		$this->title = preg_replace($pat, '', $title);
		$this->info = preg_replace($pat, '', $info);	
	}


	/*****************/
	/* SET MAP WIDTH */
	/*****************/
	public function SetMapWidth($width=300) {
		$this->mMapWidth = $width;
	}


	/****************/
	/* SET MAP ZOOM */
	/****************/
	public function SetMapZoom($zoom=13) {
		$this->mMapZoom = $zoom;
	}


	/******************/
	/* SET MAP HEIGHT */
	/******************/
	public function SetMapHeight($height=300) {
		$this->mMapHeight = $height;
	}


	//Set Marker Icon Color Scheme
	//options('PACIFICA','YOSEMITE','MOAB','GRANITE_PINE','DESERT_SPICE','CABO_SUNSET','TAHITI_SEA','POPPY','NAUTICA','SLATE')
	public function SetMarkerIconColor($colorScheme="PACIFICA") {
		$this->mDefColor = $colorScheme;
	}


	//Set Marker Icon Style Scheme
	//options('FLAG','GT_FLAT','GT_PILLOW','HOUSE','PIN','PUSH_PIN','STAR')
	public function SetMarkerIconStyle($style="GT_FLAT") {
		$this->mDefStyle = $style;
	}


	//Set Map Control
	//options('NONE','SMALL_PAN_ZOOM','LARGE_PAN_ZOOM','SMALL_ZOOM')
	public function SetMapControl($control="SMALL_PAN_ZOOM") {
		$this->mDefControl = $control;
	}


	/****************************/
	/* GENERATE JAVASCRIPT CODE */
	/****************************/
	public function InitJs() {
        $ret = "";
		//show error if misconfigured
		$is_error = $this->CheckConf();
		if ($is_error != '') {
			$ret = $is_error; 
		} else {
			$color = $this->mIconColor[$this->mDefColor];
			$dir = $this->mIconStyle[$this->mDefStyle]['DIR'];

			$icon_w  = $this->mIconStyle[$this->mDefStyle]['ICON_W'];
			$icon_h  = $this->mIconStyle[$this->mDefStyle]['ICON_H'];

			$icon_anchr_w  = $this->mIconStyle[$this->mDefStyle]['ICON_ANCHR_W'];
			$icon_anchr_h  = $this->mIconStyle[$this->mDefStyle]['ICON_ANCHR_H'];

			$info_win_anchr_w  = $this->mIconStyle[$this->mDefStyle]['INFO_WIN_ANCHR_W'];
			$info_win_anchr_h  = $this->mIconStyle[$this->mDefStyle]['INFO_WIN_ANCHR_H'];

			//start of JS SCRIPT		
            $ret .= "<script type=\"text/javascript\">\n";
			$ret .= "if(GBrowserIsCompatible()) { \n";
			$ret .= "	var ".$this->imap." = new GMap2(document.getElementById('".$this->imap."')); \n";
			$ret .= ($this->mContinuousZoom) ? "	".$this->imap.".enableContinuousZoom(); \n" : "";
			$ret .= ($this->mDoubleClickZoom) ? "	".$this->imap.".enableDoubleClickZoom(); \n":"";
			$mapCtrl = "";
			switch ($this->mDefControl) {
				case 'SMALL_PAN_ZOOM': $mapCtrl = $this->imap.".addControl(new GSmallMapControl()); \n"; break;
				case 'LARGE_PAN_ZOOM': $mapCtrl = $this->imap.".addControl(new GLargeMapControl()); \n"; break;
				case 'SMALL_ZOOM': $mapCtrl = $this->imap.".addControl(new GSmallZoomControl()); \n"; break;
				case 'NONE': default:break;
			}
			$ret .= "	".$mapCtrl;


			$ret .= ($this->mScale) ? "	".$this->imap.".addControl(new GScaleControl()); \n":"";
			$ret .= ($this->mMapType) ? "	".$this->imap.".addControl(new GMapTypeControl()); \n":"";
			$ret .= ($this->mInset)	?	"	".$this->imap.".addControl(new GOverviewMapControl()); \n":"";

			$ret .= "	var icon = new GIcon();\n";
			$ret .= "	icon.image = 'http://google.webassist.com/google/markers/$dir/$color.png';\n";
			$ret .= "	icon.shadow = 'http://google.webassist.com/google/markers/$dir/shadow.png';\n";
			$ret .= "	icon.iconSize = new GSize($icon_w,$icon_h);\n";
			$ret .= "	icon.shadowSize = new GSize($icon_w,$icon_h);\n";
			$ret .= "	icon.iconAnchor = new GPoint($icon_anchr_w,$icon_anchr_h);\n";
			$ret .= "	icon.infoWindowAnchor = new GPoint($info_win_anchr_w,$info_win_anchr_h);\n";
			$ret .= "	icon.printImage = 'http://google.webassist.com/google/markers/$dir/$color.gif';\n";
			$ret .= "	icon.mozPrintImage = 'http://google.webassist.com/google/markers/$dir/{$color}_mozprint.png';\n";
			$ret .= "	icon.printShadow = 'http://google.webassist.com/google/markers/$dir/shadow.gif';\n";
			$ret .= "	icon.transparent = 'http://google.webassist.com/google/markers/$dir/{$color}_transparent.png';\n\n";

			$ret .= "var latlng = new GLatLng(".$this->address.");\n"; 
			switch ($this->maptypedef) {
				case 1: $ret .= $this->imap.".setCenter(latlng, ".$this->mMapZoom.", G_SATELLITE_MAP);\n"; break;
				case 2: $ret .= $this->imap.".setCenter(latlng, ".$this->mMapZoom.", G_HYBRID_MAP);\n"; break;
				case 0: default: $ret .= $this->imap.".setCenter(latlng, ".$this->mMapZoom.");\n"; break;
			}
			$ret .= "var marker".$this->rnd." = new GMarker(latlng, icon);\n";
			$ret .= "GEvent.addListener(marker".$this->rnd.", 'click', function() {\n";
			$ret .= "	marker".$this->rnd.".openInfoWindowHtml('".$this->info."');\n";
			$ret .= "});\n";
			$ret .= $this->imap.".addOverlay(marker".$this->rnd.");\n";
			$ret .= "marker".$this->rnd.".openInfoWindowHtml('".$this->info."');\n";
			$ret .= "}\n\n";

			if ($this->showsidelink) {
				$ret .= "function sideClick".$this->rnd."() {\n";
				$ret .= "   if (marker".$this->rnd.") {\n";
				$ret .= "	  marker".$this->rnd.".openInfoWindowHtml('".$this->info."');\n";
				$ret .= "	  ".$this->imap.".setCenter(latlng,".$this->mMapZoom.");\n";
				$ret .= "   } else {\n";
				$ret .= "	  var htstring = '".$this->info."';\n";
				$ret .= "	  var stripped = htstring.replace(/(<([^>]+)>)/ig,'');\n";
				$ret .= "	  alert('Location not found: ' +  stripped);\n";
				$ret .= "   }\n";
				$ret .= "}\n";
			}
			$ret .= "</script>\n";
		}
		return $ret;
	}


	//Generate JS for Map Key
	public function GmapsKey() {
		return "<script type=\"text/javascript\" src=\"http://maps.google.com/maps?file=api&v=2&key=".$this->mMapKey."\"></script>\n";	
	}


	//Generate Links for Address
	public function GetSideClick() {
		if (!$this->showsidelink) { return ''; }
		$out = '<div style="text-align: center; margin: 0 0 5px 0; padding: 3px 0; background-color: #555; font-weight: bold; width: '.$this->mMapWidth.'px;">'."\n"; 
		$out .= '<a href="javascript:void(null);" onclick="sideClick'.$this->rnd.'();" style="color: #FFF; text-decoration: none;">'.$this->title."</a></div>\n";
		return $out;
	}


	//Generate Map Holder/Container
	public function MapHolder() {
		return '<div id="'.$this->imap.'" style="width: '.$this->mMapWidth.'px; height: '.$this->mMapHeight.'px;"></div>'."\n";
	}


	//Generate Unloading Script for Google Map
	public function UnloadMap() {
		return '<script type="text/javascript">window.onunload = function() { GUnload(); }</script>'."\n";
	}


	public function SetShowLink($show=0) {
		$this->showsidelink = (int)$show;
	}


	/***********************/
	/* CHECK CONFIGURATION */
	/***********************/
	private function CheckConf() {
		$ret = "";
		//map height and width
		if (!is_numeric($this->mMapWidth) || !is_numeric($this->mMapHeight)) {
			$ret .= "INVALID MAP WIDTH or HEIGHT!<br />\n";
		}
		//map control
		if (!in_array($this->mDefControl, $this->mControl)) {
			$ret .= "INVALID MAP CONTROL VALUE<br />\n";
		}
		//color
		if (!array_key_exists($this->mDefColor, $this->mIconColor)) {
			$ret .= "INVALID MARKER ICON COLOR<br />\n";
		}
		//style
		if (!array_key_exists($this->mDefStyle, $this->mIconStyle)) {
			$ret .= "INVALID MARKER ICON STYLE<br />\n";
		}
		return $ret;
	}

}

?>