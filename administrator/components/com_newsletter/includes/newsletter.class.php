<?php 
/**
* @version: 1.2
* @copyright: Copyright (C) 2008-2009 Is Open Source. All rights reserved.
* @package: Elxis
* @subpackage: Component NewsLetter
* @author: Ioannis Sannos (Is Open Source)
* @link: http://www.isopensource.com
* @email: info@isopensource.com
* @license: http://creativecommons.org/licenses/by-sa/3.0/ Creative Commons Attribution-Share Alike 3.0
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $_VERSION;
if (($_VERSION->RELEASE == '2008') && ($_VERSION->DEV_LEVEL == '0')) {
	global $mosConfig_offset;
	$mainframe->_config->offset = $mosConfig_offset;
}

if (!defined('IOSNLETTERBASE')) {
	if ($_VERSION->RELEASE > 2008) {
		define('IOSNLETTERBASE', 'newsletter');
	} else {
		define('IOSNLETTERBASE', 'com_newsletter');
	}
}

class iosNewsLetter {

	public $version = '1.2';
	public $url = '';
	public $aurl = '';
	public $path = '';
	public $apath = '';
	public $lng; //language object
	public $cfg = null; //config object


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
		global $mainframe;

		$this->url = $mainframe->getCfg('live_site').'/components/com_newsletter';
		$this->aurl = $mainframe->getCfg('live_site').'/administrator/components/com_newsletter';
		$this->path = $mainframe->getCfg('absolute_path').'/components/com_newsletter';
		$this->apath = $mainframe->getCfg('absolute_path').'/administrator/components/com_newsletter';
		$this->loadConfig();
		$this->loadLanguage();
	}


	/*******************************/
	/*LOAD COMPONENT CONFIGURATION */
	/*******************************/
	private function loadConfig() {
		require_once($this->apath.'/config.newsletter.php');
		$this->cfg = new newsletterConfig();
	}


	/***********************/
	/* LOAD EBLOG LANGUAGE */
	/***********************/
	private function loadLanguage() {
		global $mainframe;

		$curlang = (defined('_ELXIS_ADMIN')) ? $GLOBALS['alang'] : $GLOBALS['lang'];
		if (file_exists($this->apath.'/language/'.$curlang.'.php')) {
			require_once($this->apath.'/language/'.$curlang.'.php');
		} else if (file_exists($this->apath.'/language/'.$mainframe->getCfg('lang').'.php')) {
			require_once($this->apath.'/language/'.$mainframe->getCfg('lang').'.php');
		} else {
			require_once($this->apath.'/language/english.php');
		}
		$this->lng = new newsletterLang();
	}


	/****************************/
	/* TRANSALE A LANGUAGE NAME */
	/****************************/
	public function translatedLang($tlang) {
		$tlangx = strtoupper($tlang);
		if (isset($this->lng->$tlangx)) { return $this->lng->$tlangx; }
		return $tlang;
	}

}


class iosnlSubdb extends mosDBTable {

	public $sid = null;
	public $userid = '0';
	public $subname = null;
	public $subsurname = null;
	public $subemail = null;
	public $confirmed = '0';
	public $subtime = null;
	public $sublang = null;
	public $confirmcode = null;
	public $subgroup = null;

	public function __construct(&$db) {
		global $mainframe;

		$this->mosDBTable( '#__iosnl_subscribers', 'sid', $db);
		if (!$this->sid) {
			$this->subtime = time() + ($mainframe->getCfg('offset') * 3600);
		}
	}

}


class iosnlMsgdb extends mosDBTable {

	public $id = null;
	public $subject = null;
	public $textplain = null;
	public $texthtml = null;
	public $htmlfile = null;
	public $recipients = '0';
	public $lastsent = '1979-12-19 00:00:00';
	public $msglang= null;

	public function __construct(&$db) {
		$this->mosDBTable( '#__iosnl_messages', 'id', $db);
	}

}

?>