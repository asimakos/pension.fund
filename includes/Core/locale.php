<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Locale
* @author: Ioannis Sannos
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Sets Elxis Enviroment Locale
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class eLOCALE {


	/*********************/
	/* SET SYSTEM LOCALE */
	/*********************/
    static function set_locale($lang = 'english') {
        global $mosConfig_locale;

        //unix locales per language
        $unixlocales = array (
			'afar' => array('aa_DJ.UTF8@euro', 'aa_DJ.UTF8', 'aa_DJ.UTF-8'),
			'abkhazian' => array('ab_GE.UTF8@euro', 'ab_GE.UTF8', 'ab_GE.UTF-8'),
			'afrikaans' => array('af_ZA.UTF8@euro', 'af_ZA.UTF8', 'af_ZA.UTF-8'),
			'albanian' => array('sq_AL.UTF8@euro', 'sq_AL.UTF8', 'sq_AL.UTF-8'),
			'arabic' => array('ar_SA.UTF8', 'ar_AE.UTF8', 'ar_EG.UTF8', 'ar_SA.UTF-8', 'ar_AE.UTF-8', 'ar_EG.UTF-8'),
			'arabic_YE' => array('ar_YE.UTF8@euro', 'ar_YE.UTF8', 'ar_YE.UTF-8'),
			'arabic_algeria' => array('ar_DZ.UTF8@euro', 'ar_DZ.UTF8', 'ar_DZ.UTF-8'),
			'arabic_bahrain' => array('ar_BH.UTF8@euro', 'ar_BH.UTF8', 'ar_BH.UTF-8'),
			'arabic_egypt' => array('ar_EG.UTF8@euro', 'ar_EG.UTF8', 'ar_EG.UTF-8'),
			'arabic_iraq' => array('ar_IQ.UTF8@euro', 'ar_IQ.UTF8', 'ar_IQ.UTF-8'),
			'arabic_jordan' => array('ar_JO.UTF8@euro', 'ar_JO.UTF8', 'ar_JO.UTF-8'),
			'arabic_kuwait' => array('ar_KW.UTF8@euro', 'ar_KW.UTF8', 'ar_KW.UTF-8'),
			'arabic_lebanon' => array('ar_LB.UTF8@euro', 'ar_LB.UTF8', 'ar_LB.UTF-8'),
			'arabic_libya' => array('ar_LY.UTF8@euro', 'ar_LY.UTF8', 'ar_LY.UTF-8'),
			'arabic_morocco' => array('ar_MA.UTF8@euro', 'ar_MA.UTF8', 'ar_MA.UTF-8'),
			'arabic_oman' => array('ar_OM.UTF8@euro', 'ar_OM.UTF8', 'ar_OM.UTF-8'),
			'arabic_qatar' => array('ar_QA.UTF8@euro', 'ar_QA.UTF8', 'ar_QA.UTF-8'),
			'arabic_saudiarabia' => array('ar_SA.UTF8@euro', 'ar_SA.UTF8', 'ar_SA.UTF-8'),
			'arabic_syria' => array('ar_SY.UTF8@euro', 'ar_SY.UTF8', 'ar_SY.UTF-8'),
			'arabic_tunisia' => array('ar_TN.UTF8@euro', 'ar_TN.UTF8', 'ar_TN.UTF-8'),
			'arabic_uae' => array('ar_AE.UTF8@euro', 'ar_AE.UTF8', 'ar_AE.UTF-8'),
			'armenian' => array('hy_AM.UTF8@euro', 'hy_AM.UTF8', 'hy_AM.UTF-8'),
			'azeri' => array('az_Cyrl_AZ.UTF8', 'az_AZ.UTF8', 'az_Cyrl_AZ.UTF-8'),
			'azeri_latin' => array('az_Latn_AZ.UTF8', 'en_US.UTF8', 'az_Latn_AZ.UTF-8'),
			'basque' => array('eu_ES.UTF8@euro', 'eu_ES.UTF8', 'eu_ES.UTF-8'),
			'belarusian' => array('be_BY.UTF8@euro', 'be_BY.UTF8', 'be_BY.UTF-8'),
			'bengali' => array('bn_IN.UTF8@euro', 'bn_IN.UTF8', 'bn_IN.UTF-8'),
			'bosnian' => array('bs_BA.UTF8@euro', 'bs_BA@UTF8', 'bs_BA.UTF-8'),
			'bosnian_latin' => array('bs_Latn_BA.UTF8', 'en_US.UTF8', 'bs_Latn_BA.UTF-8'),
			'brazilian' => array('pt_BR.UTF8@euro', 'pt_BR.UTF8', 'pt_PT.UTF8', 'pt_BR.UTF-8'),
			'bulgarian' => array('bg_BG.UTF8@euro', 'bg_BG.UTF8', 'bg_BG.UTF-8'),
			'catalan' => array('ca_ES.UTF8@euro', 'ca_ES.UTF8', 'ca_ES.UTF-8'),
			//'chinese' => array('zh_CN.UTF8@euro', 'zh_CN.UTF8', 'zh_CN.UTF-8'),
			'chinese_traditional' => array('zh_TW.UTF8', 'zh_TW.UTF-8', 'zh_CN.UTF8', 'zh_CN.UTF-8', 'en_US.UTF8', 'en_US.UTF-8'),
			'chinese_simplified' => array('zh_CN.UTF8', 'zh_CN.UTF-8', 'zh_TW.UTF8', 'zh_TW.UTF-8', 'en_US.UTF8', 'en_US.UTF-8'),
			'chinese_hongkong' => array('zh_HK.UTF8@euro', 'zh_HK.UTF8', 'zh_CN.UTF8', 'zh_HK.UTF-8'),
			'chinese_macau' => array('zh_MO.UTF8@euro', 'zh_MO.UTF8', 'zh_CN.UTF8', 'zh_MO.UTF-8'),
			'chinese_singapore' => array('zh_SG.UTF8@euro', 'zh_SG.UTF8', 'zh_CN.UTF8', 'zh_SG.UTF-8'),
			'chinese_taiwan' => array('zh_TW.UTF8@euro', 'zh_TW.UTF8', 'zh_CN.UTF8', 'zh_TW.UTF-8'),
			'creole' => array('ht_HT.UTF8', 'fr_FR.UTF8', 'ht_HT.UTF-8'),
			'croatian' => array('hr_HR.UTF8@euro', 'hr_HR.UTF8', 'hr_BA.UTF8@euro', 'hr_BA.UTF8', 'hr_HR.UTF-8'),
			'cypriotic' => array('el_CY.UTF8@euro', 'el_CY.UTF8', 'el_GR.UTF8', 'el_CY.UTF-8', 'el_GR.UTF-8'),
			'czech' => array('cs_CZ.UTF8@euro', 'cs_CZ.UTF8', 'cs_CZ.UTF-8'),
			'danish' => array('da_DK.UTF8@euro', 'da_DK.UTF8', 'da_DK.UTF-8'),
			'dari' => array('da_AF.UTF8@euro', 'da_AF.UTF8', 'fa_IR.UTF8', 'da_AF.UTF-8'),
			'divehi' => array('dv_MV.UTF8@euro', 'dv_MV.UTF8', 'dv_MV.UTF-8'),
			'dutch' => array('nl_NL.UTF8@euro', 'nl_NL.UTF8', 'nl_NL.UTF-8'),
			'dutch_belgium' => array('nl_BE.UTF8@euro', 'nl_BE.UTF8', 'nl_NL.UTF8', 'nl_BE.UTF-8'),
			'english' => array('en_GB.UTF8', 'en_US.UTF8', 'en_GB.UTF-8', 'en_US.UTF-8', 'en_GB', 'en'),
			'english_australia' => array('en_AU.UTF8@euro', 'en_AU.UTF8', 'en_US.UTF8', 'en_AU.UTF-8'),
			'english_belize' => array('en_BZ.UTF8@euro', 'en_BZ.UTF8', 'en_US.UTF8', 'en_BZ.UTF-8'),
			'english_canada' => array('en_CA.UTF8@euro', 'en_CA.UTF8', 'en_US.UTF8', 'en_CA.UTF-8'),
			'english_ireland' => array('en_IE.UTF8@euro', 'en_IE.UTF8', 'en_US.UTF8', 'en_IE.UTF-8'),
			'english_jamaica' => array('en_JM.UTF8@euro', 'en_JM.UTF8', 'en_US.UTF8', 'en_JM.UTF-8'),
			'english_newzealang' => array('en_NZ.UTF8@euro', 'en_NZ.UTF8', 'en_US.UTF8', 'en_NZ.UTF-8'),
			'english_philippines' => array('en_PH.UTF8@euro', 'en_PH.UTF8', 'en_US.UTF8', 'en_PH.UTF-8'),
			'english_southafrica' => array('en_ZA.UTF8@euro', 'en_ZA.UTF8', 'en_US.UTF8', 'en_ZA.UTF-8'),
			'english_trinidad' => array('en_TT.UTF8@euro', 'en_TT.UTF8', 'en_US.UTF8', 'en_TT.UTF-8'),
			'english_usa' => array('en_US.UTF8@euro', 'en_US.UTF8', 'en_US.UTF-8'),
			'estonian' => array('et_EE.UTF8@euro', 'et_EE.UTF8', 'et_EE.UTF-8'),
			'faeroese' => array('fo_FO.UTF8@euro', 'fo_FO.UTF8', 'fo_FO.UTF-8'),
			'farsi' => array('fa_IR.UTF8@euro', 'fa_IR.UTF8', 'fa_IR.UTF-8'),
			'finnish' => array('fi_FI.UTF8@euro', 'fi_FI.UTF8', 'fi_FI.UTF-8'),
			'french' => array('fr_FR.UTF8@euro', 'fr_FR.UTF8', 'fr_FR.UTF-8'),
			'french_belgium' => array('fr_BE.UTF8@euro', 'fr_BE.UTF8', 'fr_FR.utf8', 'fr_BE.UTF-8'),
			'french_canada' => array('fr_CA.UTF8@euro', 'fr_CA.UTF8', 'fr_FR.utf8', 'fr_CA.UTF-8'),
			'french_luxemburg' => array('fr_LU.UTF8@euro', 'fr_LU.UTF8', 'fr_FR.utf8', 'fr_LU.UTF-8'),
			'french_monaco' => array('fr_MC.UTF8@euro', 'fr_MC.UTF8', 'fr_FR.utf8', 'fr_MC.UTF-8'),
			'french_switzerland' => array('fr_CH.UTF8@euro', 'fr_CH.UTF8', 'fr_FR.utf8', 'fr_CH.UTF-8'),
			'fyrom' => array('mk_MK.UTF8@euro', 'mk_MK.UTF8', 'mk_MK.UTF-8'),
			'galician' => array('gl_ES.UTF8@euro', 'gl_ES.UTF8', 'es_ES.UTF8', 'gl_ES.UTF-8'),
			'german' => array('de_DE.UTF8@euro', 'de_DE.UTF8', 'de_DE.UTF-8'),
			'german_austria' => array('de_AT.UTF8@euro', 'de_AT.UTF8', 'de_DE.UTF8', 'de_AT.UTF-8'),
			'german_liechtenstein' => array('de_LI.UTF8@euro', 'de_LI.UTF8', 'de_DE.UTF8', 'de_LI.UTF-8'),
			'german_luxembourg' => array('de_LU.UTF8@euro', 'de_LU.UTF8', 'de_DE.UTF8', 'de_LU.UTF-8'),
			'german_switzerland' => array('de_CH.UTF8@euro', 'de_CH.UTF8', 'de_DE.UTF8', 'de_CH.UTF-8'),
			'greek' => array('el_GR.UTF8@euro', 'el_GR.UTF8', 'el_GR.UTF-8'),
			'greek_cyprus' => array('el_CY.UTF8@euro', 'el_CY.UTF8', 'el_GR.UTF8', 'el_CY.UTF-8'),
			'gujarati' => array('gu_IN.UTF8@euro', 'gu_IN.UTF8', 'gu_IN.UTF-8'),
			'haitian_creole' => array('ht_HT.UTF8', 'fr_FR.UTF8', 'ht_HT.UTF-8'),
			'hebrew' => array('he_IL.UTF8@euro', 'he_IL.UTF8', 'he_IL.UTF-8'),
			'hindi' => array('hi_IN.UTF8@euro', 'hi_IN.UTF8', 'hi_IN.UTF-8'),
			'hungarian' => array('hu_HU.UTF8@euro', 'hu_HU.UTF8', 'hu_HU.UTF-8'),
			'icelandic' => array('is_IS.UTF8@euro', 'is_IS.UTF8', 'is_IS.UTF-8'),
			'indonesian' => array('id_ID.UTF8@euro', 'id_ID.UTF8', 'id_ID.UTF-8'),
			'irish' => array('ga_IE.UTF8@euro', 'ga_IE.utf8', 'ga_IE.UTF-8'),
			'italian' => array('it_IT.UTF8@euro', 'it_IT.UTF8', 'it_IT.UTF-8'),
			'italian_switzerland' => array('it_CH.UTF8@euro', 'it_CH.UTF8', 'it_IT.UTF8', 'it_CH.UTF-8'),
			'japanese' => array('ja_JP.UTF8@euro', 'ja_JP.UTF8', 'ja_JP.UTF-8'),
			'kannada' => array('kn_IN.UTF8@euro', 'kn_IN.UTF8', 'kn_IN.UTF-8'),
			'kazakh' => array('kk_KZ.UTF8@euro', 'kk_KZ.UTF8', 'kk_KZ.UTF-8'),
			'konkani' => array('kok_IN.UTF8@euro', 'kok_IN.UTF8', 'kok_IN.UTF-8'),
			'korean' => array('ko_KR.UTF8@euro', 'ko_KR.UTF8', 'ko_KR.UTF-8'),
			'kyrgyz' => array('ky_KG.UTF8@euro', 'ky_KG.UTF8', 'ky_KG.UTF-8'),
			'latvian' => array('lv_LV.UTF8@euro', 'lv_LV.UTF8', 'lv_LV.UTF-8'),
			'lithuanian' => array('lt_LT.UTF8@euro', 'lt_LT.UTF8', 'lt_LT.UTF-8'),
			'malay' => array('ms_MY.UTF8@euro', 'ms_MY.UTF8', 'ms_MY.UTF-8'),
			'malay_brunei' => array('ms_BN.UTF8@euro', 'ms_BN.UTF8', 'ms_MY.UTF8', 'ms_BN.UTF-8'),
			'malayalam' => array('ml_IN.UTF8@euro', 'ml_IN.UTF8', 'ml_IN.UTF-8'),
			'maltese' => array('mt_MT.UTF8@euro', 'mt_MT.UTF8', 'mt_MT.UTF-8'),
			'maori' => array('mi_NZ.UTF8@euro', 'mi_NZ.UTF8', 'mi_NZ.UTF-8'),
			'marathi' => array('mr_IN.UTF8@euro', 'mr_IN.UTF8', 'mr_IN.UTF-8'),
			'mexican' => array('es_MX.UTF8@euro', 'es_MX.UTF8', 'es_ES.UTF8', 'es_MX.UTF-8'),
			'mongolian' => array('mn_MN.UTF8@euro', 'mn_MN.UTF8', 'mn_MN.UTF-8'),
			'norwegian' => array('nb_NO.UTF8@euro', 'nb_NO.UTF8', 'no_NO.UTF8', 'nb_NO.UTF-8'),
			'norwegian_nynorsk' => array('nn_NO.UTF8@euro', 'nn_NO.UTF8', 'no_NO.UTF8', 'nn_NO.UTF-8'),
			'pashto' => array('pa_AF.UTF8@euro', 'pa_AF.UTF8', 'fa_IR.UTF8', 'pa_AF.UTF-8'),
			'persian' => array('fa_IR.UTF8@euro', 'fa_IR.UTF8', 'fa_IR.UTF-8'),
			'polish' => array('pl_PL.UTF8@euro', 'pl_PL.UTF8', 'pl_PL.UTF-8'),
			'portuguese' => array('pt_PT.UTF8@euro', 'pt_PT.UTF8', 'pt_PT.UTF-8'),
			'portuguese_brazil' => array('pt_BR.UTF8@euro', 'pt_BR.UTF8', 'pt_PT.UTF8', 'pt_BR.UTF-8'),
			'punjabi' => array('pa_IN.UTF8@euro', 'pa_IN.UTF8', 'pa_IN.UTF-8'),
			'quechua_bolivia' => array('quz_BO.UTF8@euro', 'quz_BO.UTF8', 'quz_BO.UTF-8'),
			'quechua_equador' => array('quz_EC.UTF8@euro', 'quz_EC.UTF8', 'quz_EC.UTF-8'),
			'quechua_peru' => array('quz_PE.UTF8@euro', 'quz_PE.UTF8', 'quz_PE.UTF-8'),
			'romanian' => array('ro_RO.UTF8@euro', 'ro_RO.UTF8', 'ro_RO.UTF-8'),
			'russian' => array('ru_RU.UTF8@euro', 'ru_RU.UTF8', 'ru_RU.UTF-8'),
			'sami_inari' => array('smn_FI.UTF8@euro', 'smn_FI.UTF8', 'smn_FI.UTF-8'),
			'sami_lule' => array('smj_SE.UTF8@euro', 'smj_SE.UTF8', 'smj_NO.UTF8', 'smj_SE.UTF-8', 'smj_NO.UTF-8'),
			'sami_northern' => array('se_SE.UTF8', 'se_NO.UTF8', 'se_FI.UTF8', 'se_FI.UTF-8', 'se_NO.UTF-8'),
			'sami_skolt' => array('sms_FI.UTF8', 'sms_FI.UTF-8'),
			'sami_southern' => array('sma_SE.UTF8', 'sma_NO.UTF8', 'sma_SE.UTF-8', 'sma_NO.UTF-8'),
			'sanskrit' => array('sa_IN.UTF8@euro', 'sa_IN.UTF8', 'sa_IN.UTF-8'),
			'serbian' => array('sr_RS.UTF8@latin', 'sr_Latn_CS.UTF8', 'sr_Latn_CS@UTF8', 'sr_Latn_RS.UTF8', 'sr_Latn_RS@UTF8', 'en_US.UTF8', 'en_US.UTF-8'),
			'srpski' => array('sr_Cyrl_CS.UTF8', 'sr_RS.utf8', 'sr_CS.UTF8', 'sr_Cyrl_CS@UTF-8'),
			'slovak' => array('sk_SK.UTF8@euro', 'sk_SK.UTF8', 'sk_SK.UTF-8'),
			'slovenian' => array('sl_SI.UTF8@euro', 'sl_SI.UTF8', 'sl_SI.UTF-8'),
			'spanish' => array('es_ES.UTF8@euro', 'es_ES.UTF8', 'es_ES.UTF-8'),
			'spanish_argentina' => array('es_AR.UTF8@euro', 'es_AR.UTF8', 'es_ES.UTF8', 'es_AR.UTF-8'),
			'spanish_bolivia' => array('es_BO.UTF8@euro', 'es_BO.UTF8', 'es_ES.UTF8', 'es_BO.UTF-8'),
			'spanish_chile' => array('es_CL.UTF8@euro', 'es_CL.UTF8', 'es_ES.UTF8', 'es_CL.UTF-8'),
			'spanish_costarica' => array('es_CR.UTF8@euro', 'es_CR.UTF8', 'es_ES.UTF8', 'es_CR.UTF-8'),
			'spanish_dominican' => array('es_DO.UTF8@euro', 'es_DO.UTF8', 'es_ES.UTF8', 'es_DO.UTF-8'),
			'spanish_elsalvador' => array('es_SV.UTF8@euro', 'es_SV.UTF8', 'es_ES.UTF8', 'es_SV.UTF-8'),
			'spanish_equador' => array('es_EC.UTF8@euro', 'es_EC.UTF8', 'es_ES.UTF8', 'es_EC.UTF-8'),
			'spanish_guatemala' => array('es_GT.UTF8@euro', 'es_GT.UTF8', 'es_ES.UTF8', 'es_GT.UTF-8'),
			'spanish_honduras' => array('es_HN.UTF8@euro', 'es_HN.UTF8', 'es_ES.UTF8', 'es_HN.UTF-8'),
			'spanish_mexico' => array('es_MX.UTF8@euro', 'es_MX.UTF8', 'es_ES.UTF8', 'es_MX.UTF-8'),
			'spanish_nicaragua' => array('es_NI.UTF8@euro', 'es_NI.UTF8', 'es_ES.UTF8', 'es_NI.UTF-8'),
			'spanish_panama' => array('es_PA.UTF8@euro', 'es_PA.UTF8', 'es_ES.UTF8', 'es_PA.UTF-8'),
			'spanish_paraguay' => array('es_PY.UTF8@euro', 'es_PY.UTF8', 'es_ES.UTF8', 'es_PY.UTF-8'),
			'spanish_peru' => array('es_PE.UTF8@euro', 'es_PE.UTF8', 'es_ES.UTF8', 'es_PE.UTF-8'),
			'spanish_puertorico' => array('es_PR.UTF8@euro', 'es_PR.UTF8', 'es_ES.UTF8', 'es_PR.UTF-8'),
			'spanish_uruguay' => array('es_UY.UTF8@euro', 'es_UY.UTF8', 'es_ES.UTF8', 'es_UY.UTF-8'),
			'spanish_venezuela' => array('es_VE.UTF8@euro', 'es_VE.UTF8', 'es_ES.UTF8', 'es_VE.UTF-8'),
			'swahili' => array('sw_KE.UTF8@euro', 'sw_KE.UTF8', 'sw_KE.UTF-8'),
			'swedish' => array('sv_SE.UTF8@euro', 'sv_SE.UTF8', 'sv_SE.UTF-8'),
			'swedish_finland' => array('sv_FI.UTF8@euro', 'sv_FI.UTF8', 'sv_FI.UTF-8'),
			'syriac' => array('syr_SY.UTF8@euro', 'syr_SY.UTF8', 'syr_SY.UTF-8'),
			'tamil' => array('ta_IN.UTF8@euro', 'ta_IN.UTF8', 'ta_IN.UTF-8'),
			'tatar' => array('tt_RU.UTF8@euro', 'tt_RU.UTF8', 'tt_RU.UTF-8'),
			'telegu' => array('te_IN.UTF8@euro', 'te_IN.UTF8', 'te_IN.UTF-8'),
			//'turkish' => array('tr_TR.UTF8', 'tr_TR.UTF-8'), //PHP 5.2 bug with Turkish locale
			'turkish' => array( 'en_GB.UTF8', 'en_US.UTF8', 'en_GB.UTF-8', 'en_US.UTF-8', 'en'),
			'ukrainian' => array('uk_UA.UTF8@euro', 'uk_UA.UTF8', 'uk_UA.UTF-8'),
			'urdu' => array('ur_PK.UTF8@euro', 'ur_PK.UTF8', 'ur_PK.UTF-8'),
			'uzbek' => array('uz_Cyrl_UZ.UTF8', 'uz_UZ.UTF8', 'uz_Cyrl_UZ.UTF-8'),
			'uzbek_latin' => array('uz_Latn_UZ.UTF8', 'en_US.UTF8', 'uz_Latn_UZ.UTF-8'),
			'vietnamese' => array('vi_VN.UTF8@euro', 'vi_VN.UTF8', 'vi_VN.UTF-8'),
			'walloon' => array('wa_BE.UTF8@euro', 'wa_BE.UTF8', 'wa_BE.UTF-8'),
			'welsh' => array('cy_GB.UTF8@euro', 'cy_GB.UTF8', 'cy_GB.UTF-8'),
			'xhosa' => array('xh_ZA.UTF8@euro', 'xh_ZA.UTF8', 'xh_ZA.UTF-8'),
			'zulu' => array('zu_ZA.UTF8@euro', 'zu_ZA.UTF8', 'zu_ZA.UTF-8')  	
        );

        //Windows locale is set always to english
        $winlocales = array (
            'english' => array ('english', 'eng')
        );

        $os = strtoupper(substr(php_uname(), 0, 3));

		if (phpversion() >= '5.1.0') {
			$tz = @date_default_timezone_get();
			date_default_timezone_set($tz);
		}

        if (trim($mosConfig_locale) == '') {
        //switch to auto locale selection
        	if ( $os == 'WIN') {
        		setlocale (LC_COLLATE, $winlocales['english']);
        		setlocale (LC_CTYPE, $winlocales['english']);
        		setlocale (LC_TIME, $winlocales['english']);	
        	} else if (array_key_exists( $lang, $unixlocales)) {
        	//if lang is a registered Elxis language  
            	setlocale (LC_COLLATE, $unixlocales[$lang]);
            	setlocale (LC_CTYPE, $unixlocales[$lang]);
            	setlocale (LC_TIME, $unixlocales[$lang]);
            } else { 
            	setlocale (LC_COLLATE, $unixlocales['english']);
            	setlocale (LC_CTYPE, $unixlocales['english']);
            	setlocale (LC_TIME, $unixlocales['english']);
        	}
        } else {
            //manual locale selection
        	setlocale (LC_COLLATE, $mosConfig_locale);
        	setlocale (LC_CTYPE, $mosConfig_locale);
        	setlocale (LC_TIME, $mosConfig_locale);
        }
    }


    /********************************/
    /* STRFTIME SUPPORT FOR WINDOWS */
    /********************************/
    static function strftime_os($format, $ts = null) {
		if( strtoupper(substr(php_uname(), 0, 3)) == 'WIN' ) {
			if (!$ts) { $ts = time(); }
			$mapping = array(
				'%C' => sprintf("%02d", date("Y", $ts) / 100),
				'%D' => '%m/%d/%y',
				'%e' => sprintf("%' 2d", date("j", $ts)),
				'%h' => '%b',
				'%n' => "\n",
				'%r' => date("h:i:s", $ts) . " %p",
				'%R' => date("H:i", $ts),
				'%t' => "\t",
				'%T' => '%H:%M:%S',
				'%u' => ($w = date("w", $ts)) ? $w : 7
			);
			$format = str_replace( array_keys($mapping), array_values($mapping), $format );
		}
		return strftime($format, $ts);
	}


	/******************************************/
	/*ELXIS TO ISO639 CONVERTER (AND REVERSE) */
	/******************************************/
	static public function elxis_iso639 ($lang = 'english', $reverse=0) {
		$elxisL = array (
			'afar' => 'aa',
			'abkhazian' => 'ab',
			'afrikaans' => 'af',
			'albanian' => 'sq',
			'arabic' => 'ar',
			'arabic_YE' => 'ar-YE',
			'arabic_algeria' => 'ar-DZ',
			'arabic_bahrain' => 'ar-BH',
			'arabic_egypt' => 'ar-EG',
			'arabic_iraq' => 'ar-IQ',
			'arabic_jordan' => 'ar-JO',
			'arabic_kuwait' => 'ar-KW',
			'arabic_lebanon' => 'ar-LB',
			'arabic_libya' => 'ar-LY',
			'arabic_morocco' => 'ar-MA',
			'arabic_oman' => 'ar-OM',
			'arabic_qatar' => 'ar-QA',
			'arabic_saudiarabia' => 'ar-SA',
			'arabic_syria' => 'ar-SY',
			'arabic_tunisia' => 'ar-TN',
			'arabic_uae' => 'ar-AE',
			'armenian' => 'hy',
			'azeri' => 'az',
			'azeri_latin' => 'az-Latn-AZ',
			'basque' => 'eu',
			'belarusian' => 'be',
			'bengali' => 'bn',
			'bosnian' => 'bs',
			'bosnian_latin' => 'bs-Latn-BA',
			'brazilian' => 'pt-BR', //alias of portuguese_brazil
			'bulgarian' => 'bg',
			'catalan' => 'ca',
			//'chinese' => 'zh',
			'chinese_traditional' => 'zh-Hant',
			'chinese_simplified' => 'zh-Hans',
			'chinese_hongkong' => 'zh-HK',
			'chinese_macau' => 'zh-MO',
			'chinese_singapore' => 'zh-SG',
			'chinese_taiwan' => 'zh_TW',
			'creole' => 'ht',
			'croatian' => 'hr',
			//'cypriotic' => 'el-CY', //alias of greek_cyprus
			'czech' => 'cs',
			'danish' => 'da',
			'dari' => 'da-AF',
			'divehi' => 'dv',
			'dutch' => 'nl',
			'dutch_belgium' => 'nl-BE',
			'english' => 'en',
			'english_australia' => 'en-AU',
			'english_belize' => 'en-BZ',
			'english_canada' => 'en-CA',
			'english_ireland' => 'en-IE',
			'english_jamaica' => 'en-JM',
			'english_newzealang' => 'en-NZ',
			'english_philippines' => 'en-PH',
			'english_southafrica' => 'en-ZA',
			'english_trinidad' => 'en-TT',
			'english_usa' => 'en-US',
			'estonian' => 'et',
			'faeroese' => 'fo',
			//'farsi' => 'fa', //alias of persian
			'finnish' => 'fi',
			'french' => 'fr',
			'french_belgium' => 'fr-BE',
			'french_canada' => 'fr-CA',
			'french_luxemburg' => 'fr-LU',
			'french_monaco' => 'fr-MC',
			'french_switzerland' => 'fr-CH',
			'fyrom' => 'mk',
			'galician' => 'gl',
			'german' => 'de',
			'german_austria' => 'de-AT',
			'german_liechtenstein' => 'de-LI',
			'german_luxembourg' => 'de-LU',
			'german_switzerland' => 'de-CH',
			'greek' => 'el',
			'greek_cyprus' => 'el-CY',
			'gujarati' => 'gu',
			'hebrew' => 'he',
			'hindi' => 'hi',
			'hungarian' => 'hu',
			'icelandic' => 'is',
			'indonesian' => 'id',
			'irish' => 'ga-IE',
			'italian' => 'it',
			'italian_switzerland' => 'it-CH',
			'japanese' => 'ja',
			'kannada' => 'kn',
			'kazakh' => 'kk',
			'konkani' => 'kok',
			'korean' => 'ko',
			'kyrgyz' => 'ky',
			'latvian' => 'lv', 
			'lithuanian' => 'lt',
			'malay' => 'ms', 
			'malay_brunei' => 'ms-BN',
			'malayalam' => 'ml',
			'maltese' => 'mt',
			'maori' => 'mi',
			'marathi' => 'mr',
			'mexican' => 'es-MX', //alias of spanish_mexico
			'mongolian' => 'mn',
			'norwegian' => 'nb',
			'norwegian_nynorsk' => 'nn',
			'pashto' => 'pa',
			'persian' => 'fa',
			'polish' => 'pl',
			'portuguese' => 'pt',
			//'portuguese_brazil' => 'pt-BR',
			'punjabi' => 'pa',
			'quechua_bolivia' => 'quz-BO',
			'quechua_equador' => 'quz-EC',
			'quechua_peru' => 'quz-PE',
			'romanian' => 'ro',
			'russian' => 'ru',
			'sami_inari' => 'smn-FI',
			'sami_lule' => 'smj-SE',
			'sami_lule' => 'smj-NO',
			'sami_northern' => 'se',
			'sami_northern' => 'se-NO',
			'sami_skolt' => 'sms-FI',
			'sami_southern' => 'sma-SE',
			'sami_southern' => 'sma-NO',
			'sanskrit' => 'sa-IN',
			'serbian' => 'sr',
			'srpski' => 'rs',
			'slovak' => 'sk',
			'slovenian' => 'sl',
			'spanish' => 'es',
			'spanish_argentina' => 'es-AR',
			'spanish_bolivia' => 'es-BO',
			'spanish_chile' => 'es-CL',
			'spanish_costarica' => 'es-CR',
			'spanish_dominican' => 'es-DO',
			'spanish_elsalvador' => 'es-SV',
			'spanish_equador' => 'es-EC',
			'spanish_guatemala' => 'es-GT',
			'spanish_honduras' => 'es-HN',
			//'spanish_mexico' => 'es-MX',
			'spanish_nicaragua' => 'es-NI',
			'spanish_panama' => 'es-PA',
			'spanish_paraguay' => 'es-PY',
			'spanish_peru' => 'es-PE',
			'spanish_puertorico' => 'es-PR',
			'spanish_uruguay' => 'es-UY',
			'spanish_venezuela' => 'es-VE',
			'swahili' => 'sw',
			'swedish' => 'sv',
			'swedish_finland' => 'sv-FI',
			'syriac' => 'syr',
			'tamil' => 'ta',
			'tatar' => 'tt',
			'telegu' => 'te',
			'turkish' => 'tr',
			'ukrainian' => 'uk',
			'urdu' => 'ur',
			'uzbek' => 'uz',
			'uzbek_latin' => 'uz-Latn-UZ',
			'vietnamese' => 'vi',
			'walloon' => 'wa',
			'welsh' => 'cy',
			'xhosa' => 'xh',
			'zulu' => 'zu'
		);

		if ($reverse) {
			$arr = array_keys($elxisL, $lang);
			return ($arr && (count($arr) > 0)) ? $arr[0] : '';
		} else {
			return (isset($elxisL[$lang])) ? $elxisL[$lang] : '';
		}
	}


	/**************************************/
	/* ISO639 TO ELXIS LANGUAGE CONVERTER */
	/**************************************/
	static public function iso639_elxis ($iso = 'en') {
		return eLOCALE::elxis_iso639($iso, 1);
	}

}

?>
