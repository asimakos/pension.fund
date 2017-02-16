<?php 
/**
* @ Version: $Id: alanguage.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Language
* @ Author: Ioannis Sannos
* @ E-mail: datahell@elxis.org
* @ URL: http://www.elxis.org
* @ Description: Elxis Admin Language
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class ElxisLang {

	public $alang = 'english';
	public $deflang = 'english';


	public function __construct () {
		global $mosConfig_absolute_path, $alang;

		if (@file_exists( $mosConfig_absolute_path.'/administrator/language/'.$alang.'/'.$alang.'.php')) {
			$this->alang = $alang;
		} else {
			$this->alang = $this->defaultLang();
		}
	}


	/*
	change $dir to /language to display frontend languages
	change to anything other to display custom components languages in folders
	*/
	public function displayLangs( $dir = "/administrator/language/" ) {
		global $mosConfig_absolute_path, $fmanager;

		//list of installed languages
		$elangs = array();
		$langpath = $fmanager->PathName( $mosConfig_absolute_path.$dir );

		if ($handle = @opendir( $langpath )) {
			while (($node = @readdir($handle)) !== false) {
	        	if ($node!="." && $node!="..") {
    	        	if ((is_dir($langpath.$node)) && (file_exists($langpath.$node.SEP.$node.'.php'))){
	    	     		array_push($elangs, $node);
            	    }
            	}
        	}
    	}
		return $elangs;
	}


	public function defaultLang() {
		global $mosConfig_alang;
		return $mosConfig_alang;
	}


	public function changeLang($mylang) {
		if ($mylang != '') {
			$elangs = $this->displayLangs();

			if (in_array($mylang, $elangs)) {
				@setcookie("elxis_alang", "", time()-2593000, "/");
				@setcookie("elxis_alang", $mylang, time()+2592000, "/");
    			$this->alang = $mylang;
			}
		}
	}


	public function getLang() {
		global $mosConfig_absolute_path;

		if (isset($_COOKIE['elxis_alang'])) {
			$nowlang = trim(strip_tags($_COOKIE['elxis_alang']));
			if (@file_exists($mosConfig_absolute_path.'/administrator/language/'.$nowlang.'/'.$nowlang.'.php')) {
				$this->alang = $nowlang;
	    	} else {
		    	$this->alang = $this->defaultLang();
				@setcookie("elxis_alang", "", time()-2593000, "/");
				@setcookie("elxis_alang", $this->alang, time()+2592000, "/");
		    }
		} else {
			$this->alang = $this->defaultLang();
			@setcookie("elxis_alang", $this->alang, time()+2592000, "/");
		}
	}

}

?>