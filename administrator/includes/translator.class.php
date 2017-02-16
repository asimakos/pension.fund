<?php 
/**
* @version: $Id: translator.class.php 24 2010-05-30 11:08:05Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Translator
* @author: Ioannis Sannos (datahell)
* @link: http://www.elxis.org
* @email: datahell [at] elxis [dot] org
* @license: http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
* Elxis CMS is a Free Software
* @description: Translates given text using google's online translation service.
* @update 28/10/2007: Removed url translation due to babelfish restrictions, added google, new translation mechanism
* @update 30/05/2010: Translation now uses the Google's API.
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


class translator {

    private $last_error = '';


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
    public function __construct() {
        global $_VERSION;        

		if (($_VERSION->PRODUCT != 'E'.'l'.'x'.'i'.'s') || (!preg_match('/e'.'LX'.'iS/i', $_VERSION->COPYRIGHT))) { die(); } 
    }


	/******************/
	/* TRANSLATE TEXT */
	/******************/
    public function translate($text, $from, $to) {
    	global $mainframe;

		if ($text == '') {
            $this->last_error = _GEM_TRNOTHING;
            return false;
		}

		if (($from == '') || ($to == '')) {
			$this->last_error = _GEM_TRINV_INOUT;
		    return false;			
		}

		$langs = $this->supportedLanguages();
		if (!isset($langs[$from])) {
			$this->last_error = _GEM_TRINV_INOUT;
		    return false;
		}
		if (!isset($langs[$to])) {
			$this->last_error = _GEM_TRINV_INOUT;
		    return false;
		}
		unset($langs);

		if (!function_exists('curl_init') || !is_callable('curl_init')) {
            $this->last_error = 'CURL functions are not available in your system. Translation can not continue.';
            return false;
		}
		
		if (!function_exists('json_decode')) { //PHP 5.2+
            $this->last_error = 'Function json_decode is not available in your system and therefor translation can not continue. json_decode requires PHP 5.2 or greater.';
            return false;
		}

		$url = 'http://ajax.googleapis.com/ajax/services/language/translate';
		$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '192.168.0.1';
		$headers = array();
		$headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
		$text = urlencode($text);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_ENCODING, "UTF-8");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_REFERER, $mainframe->getCfg('live_site'));
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'v=1.0&q='.$text.'&hl='.$from.'&userip='.$ip.'&langpair='.$from.'%7C'.$to);
		curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		$result = curl_exec($ch);
		curl_close($ch);
		$json = json_decode($result);

		if (!$json) {
            $this->last_error = _GEM_CNOT_TRANS;
            return false;
        }
        
        if ($json->responseStatus != 200) {
			if ($json->responseDetails != '') {
				$this->last_error = $json->responseDetails;
			} else {
				$this->last_error = _GEM_CNOT_TRANS;
			}
            return false;
        }

		if ($json->responseData->translatedText != '') {
			return $json->responseData->translatedText;
		} else {
            $this->last_error = _GEM_CNOT_TRANS;
            return false;
		}
    }


	/*******************************************/
	/* CONVERT ELXIS LANGUAGE NAME TO GOOGLE'S */
	/*******************************************/
	public function elxisToGoogle($elxlang='english') {
		if ($elxlang == '') { return false; }
		$glangs = $this->supportedLanguages();
		foreach ($glangs as $lkey => $lval) {
			if ($lval[0] == $elxlang) { return $lkey; }
		}
		return false;
	}


	/*******************************************/
	/* CONVERT ELXIS LANGUAGE NAME TO GOOGLE'S */
	/*******************************************/
	public function googleToElxis($glang='en') {
		if ($glang == '') { return false; }
		$glangs = $this->supportedLanguages();
		foreach ($glangs as $lkey => $lval) {
			if ($lkey == $glang) { return $lval[0]; }
		}
		return false;
	}


	/*******************************************/
	/* GET ALL SUPPORTED TRANSLATION LANGUAGES */
	/*******************************************/
	public function supportedLanguages() {
		$langs = array(
			'af' => array('afrikanns', 'Afrikaans'),
			'sq' => array('albanian', 'Albanian'),
			'am' => array('amharic', 'Amharic'),
			'ar' => array('arabic', 'Arabic'),
			'hy' => array('armenian', 'Armenian'),
			'az' => array('azeri', 'Azerbaijani'),
			'eu' => array('basque', 'Basque'),
			'be' => array('belarusian', 'Belarusian'),
			'bn' => array('bengali', 'Bengali'),
			'bh' => array('bihari', 'bihari'),
			'bg' => array('bulgarian', 'Bulgarian'),
			'my' => array('burmese', 'Burmese'),
			'ca' => array('catalan', 'Catalan'),
			'chr' => array('cherokee', 'Cherokee'),
			'zh' => array('chinese', 'Chinese'),
			'zh-CN' => array('chinese_simplified', 'Chinese Simplified'),
			'zh-TW' => array('chinese_traditional', 'Chinese Traditional'),
			'hr' => array('croatian', 'Croatian'),
			'cs' => array('czech', 'Czech'),
			'da' => array('danish', 'Danish'),
			'dv' => array('dhivehi', 'Dhivehi'),
			'nl' => array('dutch', 'Dutch'),  
			'en' => array('english', 'English'),
			'eo' => array('esperanto', 'Esperanto'),
			'et' => array('estonian', 'Estonian'),
			'tl' => array('filipino', 'Filipino'),
			'fi' => array('finnish', 'Finnish'),
			'fr' => array('french', 'French'),
			'gl' => array('galician', 'Galician'),
			'ka' => array('georgian', 'Georgian'),
			'de' => array('german', 'German'),
			'el' => array('greek', 'Greek'),
			'gn' => array('guarani', 'Guarani'),
			'gu' => array('gujarati', 'Gujarati'),
			'iw' => array('hebrew', 'Hebrew'),
			'hi' => array('hindi', 'Hindi'),
			'hu' => array('hungarian', 'Hungarian'),
			'is' => array('icelandic', 'Icelandic'),
			'id' => array('indonesian', 'Indonesian'),
			'iu' => array('inuktitut', 'Inuktitut'),
			'ga' => array('irish', 'Irish'),
			'it' => array('italian', 'Italian'),
			'ja' => array('japanese', 'Japanese'),
			'kn' => array('kannada', 'Kannada'),
			'kk' => array('kazakh', 'Kazakh'),
			'km' => array('khmer', 'Khmer'),
			'ko' => array('korean', 'Korean'),
			'ku' => array('kurdish', 'Kurdish'),
			'ky' => array('kyrgyz', 'Kyrgyz'),
			'lo' => array('laothian', 'Laothian'),
			'lv' => array('latvian', 'Latvian'),
			'lt' => array('lithuanian', 'Lithuanian'),
			'ms' => array('malay', 'Malay'),
			'ml' => array('malayalam', 'Malayalam'),
			'mt' => array('maltese', 'Maltese'),
			'mr' => array('marathi', 'Marathi'),
			'mn' => array('mongolian', 'Mongolian'),
			'ne' => array('nepali', 'Nepali'),
			'no' => array('norwegian', 'Norwegian'),
			'or' => array('oriya', 'Oriya'),
			'ps' => array('pashto', 'Pashto'),
			'fa' => array('persian', 'Persian'),
			'pl' => array('polish', 'Polish'),
			'pt-PT' => array('portuguese', 'Portuguese'),
			'pa' => array('punjabi', 'Punjabi'),
			'ro' => array('romanian', 'Romanian'),
			'ru' => array('russian', 'Russian'),
			'sa' => array('sanskrit', 'Sanskrit'),
			'sr' => array('serbian', 'Serbian'),
			'sd' => array('sindhi', 'Sindhi'),
			'si' => array('sinhalese', 'Sinhalese'),
			'mk' => array('fyrom', 'Slavo-macedonian'),
			'sk' => array('slovak', 'Slovak'),
			'sl' => array('slovenian', 'Slovenian'),
			'es' => array('spanish', 'Spanish'),
			'sw' => array('swahili', 'Swahili'),
			'sv' => array('swedish', 'Swedish'),
			'tg' => array('tajik', 'Tajik'),
			'ta' => array('tamil', 'Tamil'),
			'tl' => array('tagalog', 'Tagalog'),
			'te' => array('telugu', 'Telugu'),
			'th' => array('thai', 'Thai'),
			'bo' => array('tibetan', 'Tibetan'),
			'tr' => array('turkish', 'Turkish'),
			'uk' => array('ukrainian', 'Ukrainian'),
			'ur' => array('urdu', 'Urdu'),
			'uz' => array('uzbek', 'Uzbek'),
			'ug' => array('uighur', 'Uighur'),
			'vi' => array('vietnamese', 'Vietnamese'),
			'cy' => array('welsh', 'Welsh'),
			'yi' => array('yiddish', 'Yiddish')
		);
		return $langs;
	}


	/******************************/
	/* GET THE LAST ERROR MESSAGE */
	/******************************/
    public function geterror() {
        return $this->last_error;
    }

}

?>