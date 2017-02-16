<?php 
/**
* @ Version: $Id: preflang.class.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Core
* @ Author: Elxis Team (Ioannis Sannos)
* @ E-mail: info@elxis.org
* @ URL: http://www.elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @ Description: Handles user's preferable language
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang {

	public $preflang = 'english';
	public $deflang = 'english';
	public $abspath = '';
	public $lng = null;


	/********************/
	/* INITIALIZE CLASS */
	/********************/
	public function __construct() {
		global $mainframe;

		$this->deflang = $mainframe->getCfg('lang');
		$this->abspath = $mainframe->getCfg('absolute_path');
	}


	/**********************/
	/* LOAD USER LANGUAGE */
	/**********************/
	public function load($plang='english') {
		if ($plang == '') { $plang = $this->deflang; }

		if (!is_null($this->lng)) {
			if ($this->preflang != $plang) { $this->setLang($plang); }
		} else {
			$this->setLang($plang);
		}
	}


	/**********************************/
	/* LOAD LANGUAGE BASED ON USER ID */
	/**********************************/
	public function loadUserLang($uid='0') {
		global $database;
		$database->setQuery("SELECT preflang FROM #__users WHERE id='".intval($uid)."'", '#__', 1, 0);
		$plang = $database->loadResult();
		if (!$plang) { $plang = $this->deflang; }
		$this->load($plang);
	}


	/****************/
	/* SET LANGUAGE */
	/****************/
	public function setLang($plang) {
		$ok = 0;
		$file = $this->abspath.'/language/'.$plang.'/'.$plang.'.pref.php';
		if (file_exists($file)) { $ok = 1; }
		if (!$ok) {
			$file = $this->abspath.'/administrator/language/'.$plang.'/'.$plang.'.pref.php';
			if (file_exists($file)) { $ok = 1; }
		}
		if (!$ok) {
			$file = $this->abspath.'/language/'.$this->deflang.'/'.$this->deflang.'.pref.php';
			if (file_exists($file)) { $ok = 1; $plang = $this->deflang; }
		}
		if (!$ok) {
			$file = $this->abspath.'/administrator/language/'.$this->deflang.'/'.$this->deflang.'.pref.php';
			if (file_exists($file)) { $ok = 1; $plang = $this->deflang; }
		}
		if (!$ok) {
			$file = $this->abspath.'/language/english/english.pref.php';
			if (file_exists($file)) {
				$ok = 1;
				$plang = 'english';
			} else {
				die('Fatal Error! Could not locate user preferable language package!');
			}
		}
		$this->preflang = $plang;
		require_once($file);
		$cname = 'prefLang_'.$plang;
		if(!class_exists($cname)) {
			die('Fatal Error! '.$plang.' user preferable language package has wrong format!');
		}
		$this->lng = new $cname();
	}
}

?>