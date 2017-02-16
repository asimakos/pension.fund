<?php 
/**
* @version: $Id: staticcache.php 2490 2009-09-08 17:06:08Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Cache
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Elxis static cache
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class staticCache {

	private $option = '';
	private $task = '';
	private $enable = 0;
	private $cfile = '';
	private $generate = 0;
	private $cache_time = 3600;
	private $getfromcache = 0;


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
		global $mainframe, $my, $option, $task;

		$this->option = strtolower($option);
		if (($this->option != '') && !preg_match('/^(com\_)/', $this->option)) { $this->option = 'com_'.$this->option; }
		$this->task = $task;
		if (!defined('_ELXIS_ADMIN') && !$my->id && ($mainframe->getCfg('sef') == 2)) {
			$this->enable = 1;
			$this->cache_time = (int)$mainframe->getCfg('cachetime');
			$this->checktasks();
		}
	}


	/****************************************/
	/* ENABLE/DISABLE CACHE PER OPTION/TASK */
	/****************************************/
	private function checktasks() {
		global $database;

		$is_enabled = 1;
		switch ($this->option) {
			case 'com_contact':
				if (mosGetParam($_POST, 'op', '') == 'sendmail') { $is_enabled = 0; }
			break;
			case 'com_login':
			case 'com_rss':
			case 'com_search':
			case 'com_banners':
				$is_enabled = 0;
			break;
			case 'com_poll':
				if ($this->task == 'vote') { $is_enabled = 0; }
			break;
			case 'com_registration':
				if (in_array(strtolower($this->task), array('sendnewpass', 'saveregistration', 'activate'))) { $is_enabled = 0; }
			break;
			case 'com_newsfeeds': //always enable if enabled
			case 'com_wrapper':
			break;
			case 'com_user':
				if (!in_array(strtolower($this->task), array('profile', 'list'))) { $is_enabled = 0; }
			break;
			case 'com_weblinks':
				if (in_array($this->task, array('new', 'edit', 'save'))) { $is_enabled = 0; }
			break;
			case 'com_frontpage':
			case 'com_content':
				if (in_array($this->task, array('subcontent', 'new', 'edit', 'emailsend', 'vote', 'pubcomment', 'delcomment', 'addcomment'))) {
					$is_enabled = 0;
				}
			break;
			case 'com_eblog':
				/* index2 only, no need to explude: 
				addcomment, delcomment, delete, validate, suggest, media, deletemedia, uploadmedia, addextra, save, saveconfig
				*/
				if (in_array($this->task, array('cpanel', 'new', 'edit', 'config'))) {
					$is_enabled = 0;
				}
			break;
			default:
				$is_enabled = 0;
				if ($this->option != '') { //Search Softdisk
					$query = "SELECT id, sdvalue FROM #__softdisk WHERE sdsection='STATICCACHE' AND sdname='".strtoupper($this->option)."'";
					$database->setQuery($query, '#__', 1, 0);
					$row = $database->loadRow();
					if ($row) {
						$is_enabled = 1;
						if (trim($row['sdvalue']) != '') {
							$arr = explode(',',trim($row['sdvalue']));
							if ($arr && (count($arr) > 0)) {
								if (in_array($this->task, $arr)) { $is_enabled = 0; }
							}
						}
					}
				}
			break;
		}
		$this->enable = $is_enabled;
	}


	/**********************/
	/* PREPARE CACHE PATH */
	/**********************/
	public function preparepath() {
		global $mainframe, $my;

		if (!$this->enable) { return; }
		if (isset($_GET['mosmsg'])) { $this->enable = 0; return; }
		if (isset($_GET['page'])) { $this->enable = 0; return; }

		$URI = $this->request_uri();
		if (preg_match('/(\/)cache(\/)static/i', $URI)) { $this->enable = 0; return; }
		$URI = preg_replace('/^(\/)/', '', $URI);

		$seolink = sefRelToAbs($URI);
		$seoURI = str_replace($mainframe->getCfg('live_site').'/', '', $seolink);

		$parts = parse_url($seoURI);
		if (isset($parts['query']) && ($parts['query'] != '')) {
			if ($parts['query'] == 'cacheregen') {
				$seoURI = isset($parts['path']) ? $parts['path'] : '';
			} else {
				$this->enable = 0; return;
			}
		}
		unset($parts);
		if ($seoURI == 'index.php') { $seoURI = 'index.html'; }	
		if (preg_match('/(\.php)$/i', $seoURI)) { $this->enable = 0; return; }

		//extra security
		$clean = preg_replace('/[\@]|[\?]|[\.]{2}/', '', preg_replace('/[^-a-z0-9.\/_]/i', '', $seoURI));
		if ($clean != $seoURI) { $this->enable = 0; return; }

		$staticBase = $mainframe->getCfg('cachepath').'/static/';

		$isdir = (($seoURI == '') || preg_match('/(\/)$/', $seoURI)) ? 1 : 0;
		if ($isdir) {
			if (!file_exists($staticBase.$seoURI)){ mkdir($staticBase.$seoURI, 0755, true); }
			$this->cfile = $staticBase.$seoURI.'index.html';
		} else {
			$this->cfile = $staticBase.$seoURI;
			$cdir = dirname($this->cfile).'/';
			if (!file_exists($cdir)){ mkdir($cdir, 0755, true); }
		}

		if ($this->cfile == '') { $this->enable = 0; return; }
		if (!file_exists($this->cfile)) { $this->generate = 1; return; }
		if (time() - filemtime($this->cfile) < $this->cache_time) {
			$this->getfromcache = 1;
		} else {
			$this->generate = 1;
		}

		$this->forcegenerate();
	}


	/********************************/
	/* FORCED REGENERATION OF CACHE */
	/********************************/
	private function forcegenerate() {
		if (!$this->enable) { return; }
		if ($this->generate) { return; }
		if (isset($_GET['cacheregen']) || isset($_POST['cacheregen'])) {
			$this->generate = 1;
			$this->getfromcache = 0;
		}
	}


	/*******************/
	/* GET FROM CACHE? */
	/*******************/ 
	public function checkread() {
		if (!$this->enable) { return false; }
		return $this->getfromcache ? true : false;
	}


	/***********************/
	/* INCLUDE CACHED PAGE */
	/***********************/
	public function loadCache() {
		if (!$this->enable) { return; }
		if (function_exists('ini_get') && is_callable('ini_get')) {
			if (ini_get('short_open_tag')) {
				echo file_get_contents($this->cfile);
			} else {
				include($this->cfile);
			}
		} else {
			//If you have short_tags open enabled comment the line bellow
			include($this->cfile);
			//If you have short_tags open enabled un-comment the line bellow
			//echo file_get_contents($this->cfile);			
		}
	}


	/*******************/
	/* GENERATE CACHE? */
	/*******************/
	public function checkwrite() {
		if (!$this->enable) { return false; }
		return $this->generate ? true : false;
	}


	/********************************/
	/* WRITE PAGE CONTENTS IN CACHE */
	/********************************/
	public function writeCache() {
		if (!$this->enable) { return; }
		if ($this->generate) {
			$this->writeToFile($this->cfile, ob_get_contents());
		}
	}


	/*****************/
	/* WRITE TO FILE */
	/*****************/
	private function writeToFile($fileName,$content) {
		$handle = fopen($fileName,'w');
		if ($handle) {
			fwrite($handle,$content);
			fclose($handle);
		}
	}


	/*********************/
	/* GET REQUESTED URI */
	/*********************/
	private function request_uri() {
		if (isset($_SERVER['REQUEST_URI'])) {
			$uri = $_SERVER['REQUEST_URI'];
		} else {
			if (isset($_SERVER['argv'])) {
				$uri = $_SERVER['PHP_SELF'].'?'.$_SERVER['argv'][0];
			} else {
				$uri = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
			}
		}
		return $uri;
	}

}

?>