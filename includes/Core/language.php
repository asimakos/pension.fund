<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Language
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @description: Elxis Language
* @license: http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class ElxisLang {

	public $lang = 'english';
	public $deflang = 'english';


	public function __construct () {
		global $mosConfig_absolute_path, $lang;

		if (@file_exists( $mosConfig_absolute_path.'/language/'.$lang.'/'.$lang.'.php')) {
			$this->lang = $lang;
		} else {
			$this->lang = $this->defaultLang();
		}
	}


	/*
	change $dir to anything other to display custom components languages in folders
	ie /components/custom_component/languages/
	*/
	public function displayLangs( $dir = "/language/" ) {
		global $mosConfig_absolute_path, $fmanager, $mosConfig_pub_langs;

		//list of installed languages
		$elangs = array();
		$langpath = $fmanager->PathName( $mosConfig_absolute_path.$dir );
		$publangs = explode(',', $mosConfig_pub_langs);

		if ($handle = @opendir( $langpath )) {
			while (($node = @readdir($handle)) !== false) {
        		if ($node!="." && $node!="..") {
            		if ((is_dir($langpath.$node)) && (file_exists($langpath.$node.'/'.$node.'.php')) && (in_array($node, $publangs))){
                 		array_push($elangs, $node);
                	}
            	}
        	}
    	}
		return $elangs;
	}

	public function defaultLang() {
		global $mosConfig_lang;
		return $mosConfig_lang;
	}

	public function changeLang($mylang) {
		if ($mylang != '') {
			$elangs = $this->displayLangs();

			if (in_array($mylang, $elangs)) {
				@setcookie("elxis_lang", "", time()-2593000, "/");
				@setcookie("elxis_lang", $mylang, time()+2592000, "/");
    			$this->lang = $mylang;
			}
		}
	}

	public function getLang() {
		global $mosConfig_absolute_path, $mosConfig_sef;

		$i2 = (preg_match('/index2\.php/i', $_SERVER['PHP_SELF'])) ? 1 : 0;
		if (($mosConfig_sef == 2) && !$i2) {
		    $this->lang = $this->defaultLang();
			@setcookie("elxis_lang", "", time()-2593000, "/");
			@setcookie("elxis_lang", $this->lang, time()+2592000, "/");
		} else if (isset($_COOKIE['elxis_lang'])) {
			$nowlang = trim(strip_tags($_COOKIE['elxis_lang']));
			if (@file_exists($mosConfig_absolute_path.'/language/'.$nowlang.'/'.$nowlang.'.php')) {
				$this->lang = $nowlang;
	    	} else {
		    	$this->lang = $this->defaultLang();
				@setcookie("elxis_lang", "", time()-2593000, "/");
				@setcookie("elxis_lang", $this->lang, time()+2592000, "/");
	    	}
		} else {
			$this->lang = $this->defaultLang();
			@setcookie("elxis_lang", $this->lang, time()+2592000, "/");
		}
	}


    /*****************************************/
    /* REDIRECT USER TO HIS BROWSER LANGUAGE */
    /*****************************************/
	public function toBrowserLang() {
		global $mosConfig_sef, $mosConfig_live_site, $option, $mosConfig_pub_langs;

		if (!isset($_SESSION['elxbrowserlang'])) {
			if (!strstr($mosConfig_pub_langs,',')) { $_SESSION['elxbrowserlang'] = $this->lang; return; }
			if ($this->is_spider()) { $_SESSION['elxbrowserlang'] = $this->lang; return; }
			if (($option == '') || ($option == 'com_frontpage')) {
				$detected_lang = $this->detectBrowserLang();
				$_SESSION['elxbrowserlang'] = $detected_lang;
				if ($detected_lang != $this->lang) {
					if ($mosConfig_sef == 2) {
						$isoc = eLOCALE::elxis_iso639($detected_lang);
						$rLink = $mosConfig_live_site.'/'.$isoc.'/';
					} else {
						$rLink = $mosConfig_live_site.'/index.php?mylang='.$detected_lang;
					}
					header('Location: '.$rLink);
					exit();
				}
			}
		}
	}


	/************************************/
	/* CHECK IF VISITOR IS A WEB SPIDER */
	/************************************/
	private function is_spider() {
		$isspider = false;
		if (isset($_SERVER['HTTP_USER_AGENT']) && (trim($_SERVER['HTTP_USER_AGENT']) != '')) {
			$user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
			$bots = array('ask jeeves', 'alexa', 'googlebot', 'yahoo', 'slurp', 'froogle', 
			'inktomi', 'looksmart', 'teoma', 'crawler', 'msnbot', 'tecnoseek');
			foreach ($bots as $bot) {
				if (strstr($user_agent,$bot)) { $isspider = true; break; }
			}
		}
		return $isspider;
	}


    /************************/
    /* DETECT USER LANGUAGE */
    /************************/
    private function detectBrowserLang() {
    	global $mosConfig_absolute_path, $mosConfig_pub_langs;

        $lcodes = $this->getLangCodes();
        $flang = $this->lang;
        $found = 0;

        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $_AL = strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']);
            foreach($lcodes as $key => $val) { //Try to detect Primary language if several languages are accepted
                if (strpos($_AL, $key)===0) { $flang = $val; $found = 1; break; }
            }
            if (!$found) { //Try to detect any language if not yet detected.
            	foreach($lcodes as $key => $val) {
                	if (strpos($_AL, $key)!==false) { $flang = $val; $found = 1; break; }
            	}
            }
        }

        if (!$found && isset($_SERVER['HTTP_USER_AGENT'])) {
            $_UA = strtolower($_SERVER['HTTP_USER_AGENT']);
            foreach($lcodes as $key => $val) {
                //if (preg_match("/[[( ]{$key}[;,_-)]/",$_UA)) {
                if (preg_match("/(".$key."\;)/",$_UA)) { $flang = $val; $found = 1; break; }
            }
        }

		//If language does not exist, check if is a part of a language family 
		//and if yes, return mother language if exist. Else return english.
		if (!file_exists($mosConfig_absolute_path.'/language/'.$flang.'/'.$flang.'.php')) {
			$k = preg_split('/\_/', $flang);
			if (file_exists($mosConfig_absolute_path.'/language/'.$k[0].'/'.$k[0].'.php')) {
				$flang = $k[0];
			} else {
				$flang = $this->lang;
			}
		}

		return (in_array($flang, explode(',',$mosConfig_pub_langs))) ? $flang : $this->lang;
    }


    /****************************/
    /* GET LANGUAGES CODE ARRAY */
    /****************************/
    private function getLangCodes() {
        $a_languages = array(
        'ab' => 'abkhazian',
        'aa' => 'afar',
    	'af-z' => 'afrikaans',
    	'af' => 'afrikaans',
    	'sq-al' => 'albanian',
		'sq' => 'albanian',
		'am' => 'amharic',
		'ar-dz' => 'arabic_algeria',
		'ar-bh' => 'arabic_bahrain',
    	'ar-eg' => 'arabic_egypt',
    	'ar-iq' => 'arabic_iraq',
    	'ar-jo' => 'arabic_jordan',
    	'ar-kw' => 'arabic_kuwait',
    	'ar-lb' => 'arabic_lebanon',
    	'ar-ly' => 'arabic_libya',
    	'ar-MA' => 'arabic_morocco',
    	'ar-om' => 'arabic_oman',
    	'ar-qa' => 'arabic_qatar',
    	'ar-sa' => 'arabic_saudiarabia',
    	'ar-sy' => 'arabic_syria',
    	'ar-tn' => 'arabic_tunisia',
    	'ar-ae' => 'arabic_uae',
    	'ar-ye' => 'arabic_YE',
    	'ar' => 'arabic',
    	'hy-am' => 'armenian',
    	'hy' => 'armenian',
    	'az-cyrl-az' => 'azeri',
    	'az-latn-az' => 'azeri_latin',
    	'az-az' => 'azeri',
    	'az' => 'azeri',
    	'eu-es' => 'basque',
    	'eu' => 'basque',
    	'be-by' => 'belarusian',
    	'be' => 'belarusian',
    	'bn-in' => 'bengali',
        'bn' => 'bengali',
        'bs-latn-ba' => 'bosnian',
        'bs-ba' => 'bosnian',
        'bs' => 'bosnian',
        'bg-bg' => 'bulgarian',
        'bg' => 'bulgarian',
        'ca-es' => 'catalan',
        'ca' => 'catalan',
		'zh-Hant' => 'chinese_traditional',
		'zh-Hans' => 'chinese_simplified',
        'zh-hk' => 'chinese_hongkong',
        'zh-mo' => 'chinese_macau',
        //'zh-cn' => 'chinese',
        'zh-sg' => 'chinese_singapore',
        'zh-tw' => 'chinese_taiwan',
        'zh' => 'chinese',
        'hr-ba' => 'croatian',
        'hr' => 'croatian',
        'cs-cz' => 'czech',
        'cs' => 'czech',
        'da-dk' => 'danish',
        'da' => 'danish',
        'dv-mv' => 'divehi',
        'dv' => 'divehi',
        'nl-be' => 'dutch_belgium',
        'nl-nl' => 'dutch',
        'nl' => 'dutch',
		'en-au' => 'english_australia',
		'en-bz' => 'english_belize',
		'en-ca' => 'english_canada',
		'en-ie' => 'english_ireland',
		'en-jm' => 'english_jamaica',
		'en-nz' => 'english_newzealang',
		'en-ph' => 'english_philippines',
		'en-za' => 'english_southafrica',
		'en-tt' => 'english_trinidad',
		'en-us' => 'english_usa',
		'en-gb' => 'english',
		'en' => 'english',
		'et-ee' => 'estonian',
		'et' => 'estonian',
		'eo' => 'esperanto',
        'fo-fo' => 'faeroese',
        'fo' => 'faeroese',
        'fa-ir' => 'persian',
        'fa' => 'persian',
		'fi-fi' => 'finnish',
		'fi' => 'finnish',
		'fj' => 'fijian',
		'fr-be' => 'french_belgium',
		'fr-ca' => 'french_canada',
		'fr-fr' => 'french',
		'fr-lu' => 'french_luxemburg',
		'fr-mc' => 'french_monaco',
		'fr-ch' => 'french_switzerland',
		'fr' => 'french',
		'mk-mk' => 'fyrom',
		'mk' => 'fyrom',
		'gl-es' => 'galician',
		'gl' => 'galician',
		'ka' => 'georgian',
		'de-at' => 'german_austria',
		'de-de' => 'german',
		'de-li' => 'german_liechtenstein',
		'de-lu' => 'german_luxembourg',
		'de-ch' => 'german_switzerland',
		'de' => 'german',
		'el-gr' => 'greek',
		'el-cy' => 'greek',
		'el' => 'greek',
		'kl' => 'greenlandic',
    	'gu-in' => 'gujarati',
    	'gu' => 'gujarati',
    	'he-il' => 'hebrew',
    	'he' => 'hebrew',
    	'hi-in' => 'hindi',
    	'hi' => 'hindi',
    	'hu-hu' => 'hungarian',
    	'hu' => 'hungarian',
    	'is-is' => 'icelandic',
    	'is' => 'icelandic',
    	'id-id' => 'indonesian',
    	'id' => 'indonesian',
    	'ga' => 'irish',
    	'it-it' => 'italian',
    	'it-ch' => 'italian_switzerland',
    	'it' => 'italian',
    	'ja-jp' => 'japanese',
    	'ja' => 'japanese',
    	'kn-in' => 'kannada',
    	'kn' => 'kannada',
    	'kk-kz' => 'kazakh',
    	'kk' => 'kazakh',
    	'kok-in' => 'konkani',
    	'kok' => 'konkani',
    	'ko-kr' => 'korean',
    	'ko' => 'korean',
    	'ku' => 'kurdish',
    	'ky-kg' => 'kyrgyz',
    	'ky' => 'kyrgyz',
    	'lv-lv' => 'latvian',
    	'lv' => 'latvian',
    	'lt-LT' => 'lithuanian',
    	'lt' => 'lithuanian',
    	'lb' => 'luxembourgish',
    	'ms-bn' => 'malay_brunei',
    	'ms-my' => 'malay_malaysia',
    	'ms' => 'malay',
    	'ml-in' => 'malayalam',
    	'ml' => 'malayalam',
    	'mt-mt' => 'maltese',
    	'mt' => 'maltese',
    	'mi-NZ' => 'maori',
    	'mi' => 'maori',
    	'mr-in' => 'marathi',
    	'mr' => 'marathi',
    	'mn-mn' => 'mongolian',
    	'mn' => 'mongolian',
    	'ne' => 'nepali',
    	'nso' => 'nothern_sotho',
    	'nb-no' => 'norwegian',
    	'nn-no' => 'norwegian_nynorsk',
    	'nb' => 'norwegian',
    	'pl-pl' => 'polish',
    	'pl' => 'polish',
    	'pt-br' => 'portuguese_brazil',
    	'pt-pt' => 'portuguese',
    	'pt' => 'portuguese',
    	'pa-in' => 'punjabi',
    	'pa' => 'punjabi',
    	'quz-bo' => 'quechua_bolivia',
    	'quz-ec' => 'quechua_equador',
    	'quz-pe' => 'quechua_peru',
		'ro-ro' => 'romanian',
		'ro' => 'romanian',
		'ru-ru' => 'russian',
		'ru' => 'russian',
		'smn-fi' => 'sami_inari',
		'smj-no' => 'sami_lule',
		'smj-se' => 'sami_lule',
		'se-fi' => 'sami_northern',
		'se-no' => 'sami_northern',
		'se-se' => 'sami_northern',
		'sms-fi' => 'sami_skolt',
		'sma-no' => 'sami_southern',
		'sma-se' => 'sami_southern',
		'sa-in' => 'sanskrit',
		'sa' => 'sanskrit',
		'sr-cyrl-cs' => 'srpski',
		'sr-cyrl-ba' => 'srpski',
		'sr-latn-cs' => 'serbian',
		'sr-latn-ba' => 'serbian',
		'rs' => 'srpski',
		'sr' => 'serbian',
		'rs' => 'serbian',
		'sk-sk' => 'slovak',
		'sk' => 'slovak',
		'sl-si' => 'slovenian',
		'sl' => 'slovenian',
		'es-ar' => 'spanish_argentina',
		'es-bo' => 'spanish_bolivia',
		'es-cl' => 'spanish_chile',
		'es-cr' => 'spanish_costarica',
		'es-do' => 'spanish_dominican',
		'es-ec' => 'spanish_equador',
		'es-sv' => 'spanish_elsalvador',
		'es-gt' => 'spanish_guatemala',
		'es-hn' => 'spanish_honduras',
		'es-es' => 'spanish',
		'es-mx' => 'spanish_mexico',
		'es-ni' => 'spanish_nicaragua',
		'es-pa' => 'spanish_panama',
		'es-py' => 'spanish_paraguay',
		'es-pe' => 'spanish_peru',
		'es-pr' => 'spanish_puertorico',
		'es-uy' => 'spanish_uruguay',
		'es-ve' => 'spanish_venezuela',
		'es' => 'spanish',
		'sw-ke' => 'swahili',
		'sw' => 'swahili',
		'sv-se' => 'swedish',
		'sv-fi' => 'swedish_finland',
		'sv' => 'swedish',
		'syr-sy' => 'syriac',
		'ta-in' => 'tamil',
		'ta' => 'tamil',
		'tt-ru' => 'tatar',
		'tt' => 'tatar',
		'te-in' => 'telegu',
		'te' => 'telegu',
		'tr-tr' => 'turkish',
		'tr' => 'turkish',
		'uk-ua' => 'ukrainian',
		'uk' => 'ukrainian',
		'ur-pk' => 'urdu',
		'ur' => 'urdu',
		'uz-cyrl-uz' => 'uzbek',
		'uz-latn-uz' => 'uzbek_latin',
		'uz-uz' => 'uzbek',
		'uz' => 'uzbek',
		'vi-vn' => 'vietnamese',
		'vi' => 'vietnamese',
		'cy-gb' => 'welsh',
		'cy' => 'welsh',
		'xh-za' => 'xhosa',
		'xh' => 'xhosa',
		'zu-za' => 'zulu',
		'zu' => 'zulu'
        );
        return $a_languages;
    }

}

?>
