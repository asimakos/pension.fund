<?php 
/**
* @version: $Id: admin.config.php 2294 2009-03-05 21:11:46Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Config
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!$acl->acl_check( 'administration', 'config', 'users', $my->usertype )) {
    global $adminLanguage;
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

class mosConfig extends mosDBTable {

	public $config_offline=null;
	public $config_host=null;
	public $config_user=null;
	public $config_password=null;
	public $config_db=null;
    public $config_dbtype=null;
	public $config_dbprefix=null;
	public $config_alang=null;
	public $config_lang=null;
	public $config_pub_langs=null;
	public $config_path=null;
	public $config_live_site=null;
	public $config_sitename=null;
	public $config_auth=null;
	public $config_lifetime=null;
	public $config_offline_message=null;
	public $config_error_message=null;
	public $config_useractivation=null;
	public $config_uniquemail=null;
	public $config_metadesc=null;
	public $config_metakeys=null;
	public $config_debug=0;
	public $config_locale=null;
	public $config_offset=null;
	public $config_hideauthor=null;
	public $config_hidecreate=null;
	public $config_hidemodify=null;
	public $config_hidertf=null;
	public $config_hidepdf=null;
	public $config_hideprint=null;
	public $config_hideemail=null;
	public $config_enable_log_items=null;
	public $config_enable_log_searches=null;
	public $config_enable_stats=null;
	public $config_sef=0;
	public $config_vote=0;
	public $config_gzip=0;
	public $config_multipage_toc=0;
	public $config_allowUserRegistration=0;
	public $config_error_reporting=0;
	public $config_link_titles=0;
	public $config_list_limit=0;
	public $config_caching=0;
	public $config_static_cache=0;
	public $config_cachepath=null;
	public $config_cachetime=null;
	public $config_mailer=null;
	public $config_mailfrom=null;
	public $config_fromname=null;
	public $config_sendmail='/usr/sbin/sendmail';
	public $config_smtpauth=0;
	public $config_smtpuser=null;
	public $config_smtppass=null;
	public $config_smtphost=null;
	public $config_back_button=0;
	public $config_item_navigation=0;
	public $config_secret=null;
	public $config_readmore=1;
	public $config_hits=1;
	public $config_comments=1;
	public $config_icons=1;
	public $config_favicon=null;
	public $config_fileperms='0644';
	public $config_dirperms='0755';
	public $config_helpurl='';
	public $config_ftp=0;
	public $config_ftphost='ftp.mysite.com';
	public $config_ftpuser='';
	public $config_ftppass='';
	public $config_ftpport='21';
	public $config_ftproot='';
	public $config_access='0';
	public $config_captcha='0';
	protected $_alias=null;


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
		$this->_alias = array(
		'config_offline'				=>'mosConfig_offline',
		'config_host'					=>'mosConfig_host',
		'config_user'					=>'mosConfig_user',
		'config_password'				=>'mosConfig_password',
		'config_db'						=>'mosConfig_db',
		'config_dbtype'					=>'mosConfig_dbtype',
		'config_dbprefix'				=>'mosConfig_dbprefix',
		'config_lang'					=>'mosConfig_lang',
		'config_pub_langs'				=>'mosConfig_pub_langs',
		'config_alang'					=>'mosConfig_alang',
		'config_path'					=>'mosConfig_absolute_path',
		'config_live_site'				=>'mosConfig_live_site',
		'config_sitename'				=>'mosConfig_sitename',
		'config_auth'					=>'mosConfig_shownoauth',
		'config_useractivation'			=>'mosConfig_useractivation',
		'config_uniquemail'				=>'mosConfig_uniquemail',
		'config_offline_message'		=>'mosConfig_offline_message',
		'config_error_message'			=>'mosConfig_error_message',
		'config_debug' 					=>'mosConfig_debug',
		'config_lifetime'				=>'mosConfig_lifetime',
		'config_metadesc'				=>'mosConfig_MetaDesc',
		'config_metakeys'				=>'mosConfig_MetaKeys',
		'config_locale'					=>'mosConfig_locale',
		'config_offset'					=>'mosConfig_offset',
		'config_hideauthor'				=>'mosConfig_hideAuthor',
		'config_hidecreate'				=>'mosConfig_hideCreateDate',
		'config_hidemodify'				=>'mosConfig_hideModifyDate',
		'config_hidertf'				=>'mosConfig_hideRtf',
		'config_hidepdf'				=>'mosConfig_hidePdf',
		'config_hideprint'				=>'mosConfig_hidePrint',
		'config_hideemail'				=>'mosConfig_hideEmail',
		'config_enable_log_items'		=>'mosConfig_enable_log_items',
		'config_enable_log_searches'	=>'mosConfig_enable_log_searches',
		'config_enable_stats' 			=>'mosConfig_enable_stats',
		'config_sef'					=>'mosConfig_sef',
		'config_vote'					=>'mosConfig_vote',
		'config_gzip'					=>'mosConfig_gzip',
		'config_multipage_toc'			=>'mosConfig_multipage_toc',
		'config_allowUserRegistration'	=>'mosConfig_allowUserRegistration',
		'config_link_titles'			=>'mosConfig_link_titles',
		'config_error_reporting'		=>'mosConfig_error_reporting',
		'config_list_limit'				=>'mosConfig_list_limit',
		'config_caching'				=>'mosConfig_caching',
		'config_static_cache'           =>'mosConfig_static_cache',
		'config_cachepath'				=>'mosConfig_cachepath',
		'config_cachetime'				=>'mosConfig_cachetime',
		'config_mailer' 				=>'mosConfig_mailer',
		'config_mailfrom' 				=>'mosConfig_mailfrom',
		'config_fromname' 				=>'mosConfig_fromname',
		'config_sendmail' 				=>'mosConfig_sendmail',
		'config_smtpauth' 				=>'mosConfig_smtpauth',
		'config_smtpuser' 				=>'mosConfig_smtpuser',
		'config_smtppass' 				=>'mosConfig_smtppass',
		'config_smtphost' 				=>'mosConfig_smtphost',
		'config_back_button' 			=>'mosConfig_back_button',
		'config_item_navigation' 		=>'mosConfig_item_navigation',
		'config_secret' 				=>'mosConfig_secret',
		'config_readmore' 				=>'mosConfig_readmore',
		'config_hits' 					=>'mosConfig_hits',
		'config_comments' 				=>'mosConfig_comments',
		'config_icons' 					=>'mosConfig_icons',
		'config_favicon' 				=>'mosConfig_favicon',
		'config_fileperms' 				=>'mosConfig_fileperms',
		'config_dirperms' 				=>'mosConfig_dirperms',
		'config_helpurl' 				=>'mosConfig_helpurl',
		'config_ftp' 				    =>'mosConfig_ftp',
		'config_ftphost' 				=>'mosConfig_ftp_host',
		'config_ftpuser' 				=>'mosConfig_ftp_user',
		'config_ftppass' 				=>'mosConfig_ftp_pass',
		'config_ftpport' 				=>'mosConfig_ftp_port',
		'config_ftproot' 				=>'mosConfig_ftp_root',
		'config_access' 				=>'mosConfig_access',
		'config_captcha'                =>'mosConfig_captcha'
		);
	}

	public function getVarText() {
		$txt = '';
		foreach ($this->_alias as $k=>$v) {
			$txt .= "\$$v = '".addslashes( $this->$k )."';\n";
		}
		return $txt;
	}

	public function bindGlobals() {
		foreach ($this->_alias as $k=>$v) {
			if (isset($GLOBALS[$v])) { $this->$k = $GLOBALS[$v]; }
		}
	}
}


require_once(str_replace('\\','/',dirname(__FILE__)).'/admin.config.html.php');
$confightml = new HTML_config();


switch ($task) {
	case 'checkftp': //index3.php AJAX
		checkftpconfig();
	break;
	case 'apply':
	case 'save':
		saveconfig($task);
	break;
	case 'cancel':
		mosRedirect('index2.php');
	break;
	default:
		showconfig($confightml, $database, $option);
	break;
}


/**************************/
/* PREPARE TO SHOW CONFIG */
/**************************/
function showconfig($confightml, &$database, $option) {
	global $database, $mosConfig_absolute_path, $adminLanguage, $elxis_language, $mosConfig_pub_langs;

	$row = new mosConfig();
	$row->bindGlobals();

	// compile list of the languages
	$langs = array();
	$alangs = array();
    $publangs = explode(',', $mosConfig_pub_langs);
	$menuitems = array();

	//frontend languages
	$langs1 = $elxis_language->displayLangs( '/language/');
	foreach ($langs1 as $lang1x) {
    	$langs[] = mosHTML::makeOption( $lang1x );
    }

    //backend languages
    $alangs1 = $elxis_language->displayLangs();
	foreach ($alangs1 as $alangx) {
    	$alangs[] = mosHTML::makeOption( $alangx );
    }

	//sort list of languages
	sort($langs);
	reset($langs);
	sort($alangs);
	reset($alangs);

	//compile list of the editors
	$query = "SELECT id AS value, name AS text FROM #__mambots"
	."\n WHERE folder='editors' AND published >= 0 ORDER BY ordering, name";
	$database->setQuery( $query );
	$edits = $database->loadObjectList();

	$query = "SELECT id FROM #__mambots WHERE folder='editors' AND published = 1";
	$database->setQuery( $query, '#__', 1, 0 );
	$editor = $database->loadResult();

	$lists = array();
	//build the html select list
	$lists['editor'] = mosHTML::selectList( $edits, 'editor', 'class="selectbox" size="1"', 'value', 'text', $editor );

	//build the html select list
	$lists['lang'] = mosHTML::selectList( $langs, 'config_lang', 'class="selectbox" size="1" dir="ltr"', 'value', 'text', $row->config_lang );

	//adminLanguage select language
	$lists['alang'] = mosHTML::selectList( $alangs, 'config_alang', 'class="selectbox" size="1" dir="ltr"', 'value', 'text', $row->config_alang );

	//make a generic -24 - 24 list
    $i = -24;
    while ($i < 24.5) {
        $k = ($i > 0) ? '+'.$i : $i;
        $timeoffset[] = mosHTML::makeOption( $i, $k );
        $i = $i + 0.5;
    }

	//get list of menuitems
	$query = "SELECT id AS value, name AS text FROM #__menu"
	. "\n WHERE (type='content_section' OR type='components' OR type='content_typed')"
	. "\n AND published=1 AND access=29 ORDER BY name";
	$database->setQuery( $query );
	$menuitems = array_merge( $menuitems, $database->loadObjectList() );

	$show_hide = array(
		mosHTML::makeOption( 1, $adminLanguage->A_COMP_CONF_HIDE ),
		mosHTML::makeOption( 0, $adminLanguage->A_COMP_CONF_SHOW ),
	);

	$show_hide_r = array(
		mosHTML::makeOption( 0, $adminLanguage->A_COMP_CONF_HIDE ),
		mosHTML::makeOption( 1, $adminLanguage->A_COMP_CONF_SHOW ),
	);

	$list_length = array(
		mosHTML::makeOption( 5, 5 ),
		mosHTML::makeOption( 10, 10 ),
		mosHTML::makeOption( 15, 15 ),
		mosHTML::makeOption( 20, 20 ),
		mosHTML::makeOption( 25, 25 ),
		mosHTML::makeOption( 30, 30 ),
		mosHTML::makeOption( 50, 50 ),
	);

	$errors = array(
		mosHTML::makeOption( -1, $adminLanguage->A_COMP_CONF_DEFAULT ),
		mosHTML::makeOption( 0, $adminLanguage->A_NONE ),
		mosHTML::makeOption( E_ERROR|E_WARNING|E_PARSE, $adminLanguage->A_COMP_CONF_SIMPLE ),
		mosHTML::makeOption( E_ALL , $adminLanguage->A_COMP_CONF_MAX )
	);

	$mailer = array(
		mosHTML::makeOption( 'mail', $adminLanguage->A_COMP_CONF_MAIL_FC, true ),
		mosHTML::makeOption( 'sendmail', $adminLanguage->A_COMP_CONF_SEND, true ),
		mosHTML::makeOption( 'smtp', $adminLanguage->A_COMP_CONF_SMTP, true )
	);

	//build the html select lists
	$lists['useftp'] = mosHTML::yesnoRadioList( 'config_ftp', 'class="inputbox"', $row->config_ftp );
	$offoptions = array(
		mosHTML::makeOption( '0', $adminLanguage->A_NO ),
		mosHTML::makeOption( '1', $adminLanguage->A_YES ),
		mosHTML::makeOption( '2', $adminLanguage->A_COMP_CONF_OFFEX )
	);
	$lists['offline'] = mosHTML::selectList( $offoptions, 'config_offline', 'class="selectbox" size="1"', 'value', 'text', $row->config_offline );
	$lists['auth'] 					= mosHTML::yesnoRadioList( 'config_auth', 'class="inputbox"', $row->config_auth );

	$useractiv =  array(
		mosHTML::makeOption('0', $adminLanguage->A_C_CONF_NOACT),
		mosHTML::makeOption('1', $adminLanguage->A_C_CONF_EMACT),
		mosHTML::makeOption('2', $adminLanguage->A_C_CONF_MANACT)
	);
	$lists['useractivation'] = mosHTML::selectList($useractiv, 'config_useractivation', 'class="selectbox" size="1"', 'value', 'text', $row->config_useractivation);

	$lists['uniquemail'] 			= mosHTML::yesnoRadioList( 'config_uniquemail', 'class="inputbox"',	$row->config_uniquemail );

	$lists['allowuserregistration'] = mosHTML::yesnoRadioList( 'config_allowUserRegistration', 'class="inputbox"',	$row->config_allowUserRegistration );
	$lists['debug'] 				= mosHTML::yesnoRadioList( 'config_debug', 'class="inputbox"', $row->config_debug );
	$lists['offset'] 				= mosHTML::selectList( $timeoffset, 'config_offset', 'class="selectbox" size="1" dir="ltr"', 'value', 'text', $row->config_offset );
	$lists['hideauthor'] 			= mosHTML::RadioList( $show_hide, 'config_hideauthor', 'class="inputbox"', $row->config_hideauthor, 'value', 'text' );
	$lists['hidecreate'] 			= mosHTML::RadioList( $show_hide, 'config_hidecreate', 'class="inputbox"', $row->config_hidecreate, 'value', 'text' );
	$lists['hidemodify'] 			= mosHTML::RadioList( $show_hide, 'config_hidemodify', 'class="inputbox"', $row->config_hidemodify, 'value', 'text' );
	$lists['hidertf'] 			    = mosHTML::RadioList( $show_hide, 'config_hidertf', 'class="inputbox"', $row->config_hidertf, 'value', 'text' );
	if (is_writable( $mosConfig_absolute_path.'/tmpr/' )) {
		$lists['hidepdf'] 			= mosHTML::RadioList( $show_hide, 'config_hidepdf', 'class="inputbox"', $row->config_hidepdf, 'value', 'text' );
	} else {
		$lists['hidepdf'] 			= '<input type="hidden" name="config_hidepdf" value="1" /><strong>'.$adminLanguage->A_YES.'</strong>';
	}
	$lists['hideprint'] 			= mosHTML::RadioList( $show_hide, 'config_hideprint', 'class="inputbox"', $row->config_hideprint, 'value', 'text' );
	$lists['hideemail'] 			= mosHTML::RadioList( $show_hide, 'config_hideemail', 'class="inputbox"', $row->config_hideemail, 'value', 'text' );
	$lists['log_items']	 			= mosHTML::yesnoRadioList( 'config_enable_log_items', 'class="inputbox"', $row->config_enable_log_items );
	$lists['log_searches'] 			= mosHTML::yesnoRadioList( 'config_enable_log_searches', 'class="inputbox"', $row->config_enable_log_searches );
	$lists['enable_stats'] 			= mosHTML::yesnoRadioList( 'config_enable_stats', 'class="inputbox"', $row->config_enable_stats );
	$sefoptions = array(
		mosHTML::makeOption('0', $adminLanguage->A_NO),
		mosHTML::makeOption('1', $adminLanguage->A_COMP_CONF_SEOBASIC),
		mosHTML::makeOption('2', $adminLanguage->A_COMP_CONF_SEOPRO)
	);
	$lists['sef'] = mosHTML::selectList( $sefoptions, 'config_sef', 'class="selectbox" size="1"', 'value', 'text', $row->config_sef );
	$lists['vote'] 					= mosHTML::RadioList( $show_hide_r, 'config_vote', 'class="inputbox"', $row->config_vote, 'value', 'text' );
	$lists['gzip'] 					= mosHTML::yesnoRadioList( 'config_gzip', 'class="inputbox"', $row->config_gzip );
	$lists['multipage_toc'] 		= mosHTML::RadioList( $show_hide_r, 'config_multipage_toc', 'class="inputbox"', $row->config_multipage_toc, 'value', 'text' );
	$lists['error_reporting'] 		= mosHTML::selectList( $errors, 'config_error_reporting', 'class="selectbox" size="1"', 'value', 'text', $row->config_error_reporting );
	$lists['link_titles'] 			= mosHTML::yesnoRadioList( 'config_link_titles', 'class="inputbox"', $row->config_link_titles );
	$lists['mailer'] 				= mosHTML::selectList( $mailer, 'config_mailer', 'class="inputbox" size="1"', 'value', 'text', $row->config_mailer );
	$lists['smtpauth'] 				= mosHTML::yesnoRadioList( 'config_smtpauth', 'class="inputbox"', $row->config_smtpauth );
	$lists['list_length'] 			= mosHTML::selectList( $list_length, 'config_list_limit', 'class="selectbox" size="1" dir="ltr"', 'value', 'text', ( $row->config_list_limit ? $row->config_list_limit : 50 ) );
	$lists['back_button'] 			= mosHTML::RadioList( $show_hide_r, 'config_back_button', 'class="inputbox"', $row->config_back_button, 'value', 'text');
	$lists['item_navigation'] 		= mosHTML::RadioList( $show_hide_r, 'config_item_navigation', 'class="inputbox"', $row->config_item_navigation, 'value', 'text');
	$lists['readmore'] 				= mosHTML::RadioList( $show_hide_r, 'config_readmore', 'class="inputbox"', $row->config_readmore, 'value', 'text');
	$lists['hits'] 					= mosHTML::RadioList( $show_hide_r, 'config_hits', 'class="inputbox"', $row->config_hits, 'value', 'text');
	$lists['comments'] 				= mosHTML::RadioList( $show_hide_r, 'config_comments', 'class="inputbox"', $row->config_comments, 'value', 'text');
	$lists['icons'] 				= mosHTML::RadioList( $show_hide_r, 'config_icons', 'class="inputbox"', $row->config_icons, 'value', 'text');
	$lists['captcha'] 				= mosHTML::yesnoRadioList( 'config_captcha', 'class="inputbox"', $row->config_captcha );

	$cacheoptions = array(
		mosHTML::makeOption('0', $adminLanguage->A_NO),
		mosHTML::makeOption('1', $adminLanguage->A_C_CONF_STDCACHE),
		mosHTML::makeOption('2', $adminLanguage->A_C_CONF_STATCACHE)
	);

	if ($row->config_static_cache) {
		$selcache = 2;
	} elseif ($row->config_caching) {
		$selcache = 1;
	} else {
		$selcache = 0;
	}
	$lists['cache'] = mosHTML::selectList($cacheoptions, 'config_cache', 'class="selectbox" size="1" onchange="checkseopro()"', 'value', 'text', $selcache);

	$locales = array(
		mosHTML::makeOption( '', '- '.$adminLanguage->A_COMP_CONF_AUTOSEL.' -' ),
		mosHTML::makeOption( 'english', 'english (for windows)'),
		mosHTML::makeOption( 'az_AZ.utf8', 'az_AZ.utf8'),
		mosHTML::makeOption( 'ar_EG.utf8', 'ar_EG.utf8'),
		mosHTML::makeOption( 'ar_LB.utf8', 'ar_LB.utf8'),
		mosHTML::makeOption( 'eu_ES.utf8', 'eu_ES.utf8'),
		mosHTML::makeOption( 'bg_BG.utf8', 'bg_BG.utf8'),
		mosHTML::makeOption( 'ca_ES.utf8', 'ca_ES.utf8'),
		mosHTML::makeOption( 'zh_CN.utf8', 'zh_CN.utf8'),
		mosHTML::makeOption( 'zh_TW.utf8', 'zh_TW.utf8'),
		mosHTML::makeOption( 'hr_HR.utf8', 'hr_HR.utf8'),
		mosHTML::makeOption( 'cs_CZ.utf8', 'cs_CZ.utf8'),
		mosHTML::makeOption( 'da_DK.utf8', 'da_DK.utf8'),
		mosHTML::makeOption( 'nl_NL.utf8', 'nl_NL.utf8'),
		mosHTML::makeOption( 'et_EE.utf8', 'et_EE.utf8'),
		mosHTML::makeOption( 'en_GB.utf8', 'en_GB.utf8'),
		mosHTML::makeOption( 'en_GB.utf-8', 'en_GB.utf-8 DEBIAN/BSD'),
		mosHTML::makeOption( 'en_US.utf8', 'en_US.utf8'),
		mosHTML::makeOption( 'en_US.utf-8', 'en_US.utf-8 DEBIAN/BSD'),
		mosHTML::makeOption( 'en_AU.utf8', 'en_AU.utf8'),
		mosHTML::makeOption( 'en_IE.utf8', 'en_IE.utf8'),
		mosHTML::makeOption( 'fa_IR.utf8', 'fa_IR.utf8'),
		mosHTML::makeOption( 'fi_FI.utf8', 'fi_FI.utf8'),
		mosHTML::makeOption( 'fr_FR.utf8', 'fr_FR.utf8'),
		mosHTML::makeOption( 'fr_FR.utf-8', 'fr_FR.utf-8 DEBIAN/BSD'),
		mosHTML::makeOption( 'gl_ES.utf8', 'gl_ES.utf8'),
		mosHTML::makeOption( 'de_DE.utf8', 'de_DE.utf8'),
		mosHTML::makeOption( 'de_DE.utf-8', 'de_DE.utf-8 DEBIAN/BSD'),
		mosHTML::makeOption( 'el_GR.utf8', 'el_GR.utf8'),
		mosHTML::makeOption( 'el_GR.utf-8', 'el_GR.utf-8 DEBIAN/BSD'),
		mosHTML::makeOption( 'he_IL.utf8', 'he_IL.utf8'),
		mosHTML::makeOption( 'hu_HU.utf8', 'hu_HU.utf8'),
		mosHTML::makeOption( 'is_IS.utf8', 'is_IS.utf8'),
		mosHTML::makeOption( 'ga_IE.utf8', 'ga_IE.utf8'),
		mosHTML::makeOption( 'it_IT.utf8', 'it_IT.utf8'),
		mosHTML::makeOption( 'it_IT.utf-8', 'it_IT.utf-8 DEBIAN/BSD'),
		mosHTML::makeOption( 'ja_JP.utf8', 'ja_JP.utf8'),
		mosHTML::makeOption( 'ko_KR.utf8', 'ko_KR.utf8'),
		mosHTML::makeOption( 'lv_LV.utf8', 'lv_LV.utf8'),
		mosHTML::makeOption( 'lt_LT.utf8', 'lt_LT.utf8'),
		mosHTML::makeOption( 'mk_MK.utf8', 'mk_MK.utf8'),
		mosHTML::makeOption( 'ms_MY.utf8', 'ms_MY.utf8'),
		mosHTML::makeOption( 'no_NO.utf8', 'no_NO.utf8'),
		mosHTML::makeOption( 'nn_NO.utf8', 'nn_NO.utf8'),
		mosHTML::makeOption( 'pl_PL.utf8', 'pl_PL.utf8'),
		mosHTML::makeOption( 'pt_PT.utf8', 'pt_PT.utf8'),
		mosHTML::makeOption( 'pt_BR.utf8', 'pt_BR.utf8'),
		mosHTML::makeOption( 'ro_RO.utf8', 'ro_RO.utf8'),
		mosHTML::makeOption( 'ru_RU.utf8', 'ru_RU.utf8'),
		mosHTML::makeOption( 'sk_SK.utf8', 'sk_SK.utf8'),
		mosHTML::makeOption( 'sl_SI.utf8', 'sl_SI.utf8'),
		mosHTML::makeOption( 'sr_CS.utf8', 'sr_CS.utf8'),
		mosHTML::makeOption( 'rs_SR.utf8', 'rs_SR.utf8'),
		mosHTML::makeOption( 'es_ES.utf8', 'es_ES.utf8'),
		mosHTML::makeOption( 'es_ES.utf-8', 'es_ES.utf-8 DEBIAN/BSD'),
		mosHTML::makeOption( 'es_MX.utf8', 'es_MX.utf8'),
		mosHTML::makeOption( 'sv_SE.utf8', 'sv_SE.utf8'),
		mosHTML::makeOption( 'sv_FI.utf8', 'sv_FI.utf8'),
		mosHTML::makeOption( 'ta_IN.utf8', 'ta_IN.utf8'),
		mosHTML::makeOption( 'tr_TR.utf8', 'tr_TR.utf8'),
		mosHTML::makeOption( 'uk_UA.utf8', 'uk_UA.utf8'),
		mosHTML::makeOption( 'vi_VN.utf8', 'vi_VN.utf8'),
		mosHTML::makeOption( 'wa_BE.utf8', 'wa_BE.utf8')
	);
	$lists['locale'] = mosHTML::selectList( $locales, 'config_locale', 'class="selectbox" size="1" dir="ltr"', 'value', 'text', $row->config_locale );

    $accesssystem = array(
        mosHTML::makeOption('0', _GEM_NONE ),
		mosHTML::makeOption('1', $adminLanguage->A_COMP_CONF_CORECOMPS),
		mosHTML::makeOption('2', $adminLanguage->A_COMP_CONF_3RDCOMPS),
		mosHTML::makeOption('3', $adminLanguage->A_COMP_CONF_ALLCOMPS)
    );
	$lists['frontaccess'] = mosHTML::selectList( $accesssystem, 'config_access', 'class="selectbox" size="1"', 'value', 'text', $row->config_access );

	$dbtypes = array(
		mosHTML::makeOption( 'ado', 'ADO (generic)'),
		mosHTML::makeOption( 'borland_ibase', 'Borland (Interbase 6.5+)' ),
		mosHTML::makeOption( 'db2', 'DB2' ),
		mosHTML::makeOption( 'odbc_db2', 'DB2 (ODBC)' ),
		mosHTML::makeOption( 'firebird', 'Firebird' ),
		mosHTML::makeOption( 'fbsql', 'Frontbase' ),
		mosHTML::makeOption( 'informix', 'Informix (generic)' ),
		mosHTML::makeOption( 'informix72', 'Informix  7.2-' ),
		mosHTML::makeOption( 'ibase', 'Interbase 6+' ),
		mosHTML::makeOption( 'ldap', 'LDAP' ),
		mosHTML::makeOption( 'access', 'Microsoft Access/Jet' ),
		mosHTML::makeOption( 'ado_access', 'Microsoft Access/Jet (ADO)' ),
		mosHTML::makeOption( 'mssql', 'Microsoft SQL Server 7+' ),
		mosHTML::makeOption( 'ado_mssql', 'Microsoft SQL Server (ADO)' ),
		mosHTML::makeOption( 'odbc_mssql', 'Microsoft SQL (ODBC)' ),
		mosHTML::makeOption( 'mssqlpo', 'Microsoft SQL (portable)' ),
		mosHTML::makeOption( 'vfp', 'Microsoft Visual FoxPro' ),
		mosHTML::makeOption( 'mysql', 'MySQL' ),
		mosHTML::makeOption( 'mysqli', 'MySQL(i) w/transactions' ),
		mosHTML::makeOption( 'mysqlt', 'MySQL(t) w/transactions' ),
		mosHTML::makeOption( 'maxsql', 'MaxSQL' ),
		mosHTML::makeOption( 'netezza', 'Netezza' ),
		mosHTML::makeOption( 'odbc', 'ODBC (generic)' ),
		mosHTML::makeOption( 'odbtp', 'ODBTP (generic)' ),
		mosHTML::makeOption( 'odbtp_unicode', 'ODBTP (unicode)' ),
		mosHTML::makeOption( 'oracle', 'Oracle 7' ),
		mosHTML::makeOption( 'oci805', 'Oracle 8.0.5' ),
		mosHTML::makeOption( 'oci8', 'Oracle 8/9' ),
		mosHTML::makeOption( 'odbc_oracle', 'Oracle (ODBC)' ),
		mosHTML::makeOption( 'oci8po', 'Oracle 8/9 (portable)' ),
		mosHTML::makeOption( 'pdo', 'PDO (generic)' ),
		mosHTML::makeOption( 'postgres', 'PostgreSQL (generic)' ),
		mosHTML::makeOption( 'postgres64', 'PostgreSQL 6.4-' ),
		mosHTML::makeOption( 'postgres7', 'PostgreSQL 7' ),
		mosHTML::makeOption( 'postgres8', 'PostgreSQL 8' ),
		mosHTML::makeOption( 'sapdb', 'SAP DB' ),
		mosHTML::makeOption( 'sqlite', 'SQLite' ),
		mosHTML::makeOption( 'sqlitepo', 'SQLite (portable)' ),
		mosHTML::makeOption( 'sybase', 'Sybase' ),
		mosHTML::makeOption( 'sybase_ase', 'Sybase ASE' ),
		mosHTML::makeOption( 'sqlanywhere', 'Sybase SQL Anywhere' )
	);
		
	$lists['dbtype'] = mosHTML::selectList( $dbtypes, 'config_dbtype', 'class="selectbox" size="1" dir="ltr"', 'value', 'text', $row->config_dbtype );
	$confightml->showconfig( $row, $lists, $option );
}


function saveconfig( $task ) {
	global $database, $mosConfig_absolute_path, $adminLanguage, $fmanager, $my;

	//CSRF prevention
	$tokname = 'token'.$my->id;
	if (!isset($_POST[$tokname]) || !isset($_SESSION[$tokname]) || ($_POST[$tokname] != $_SESSION[$tokname])) {
		die('Detected CSRF attack! Someone is forging your requests.');
	}

	$config_cache = (int)mosGetParam($_POST, 'config_cache', 0);
	if ($config_cache == 2) {
		$_POST['config_static_cache'] = 1;
		$_POST['config_caching'] = 0;
	} elseif ($config_cache == 1) {
		$_POST['config_static_cache'] = 0;
		$_POST['config_caching'] = 1;
	} else {
		$_POST['config_static_cache'] = 0;
		$_POST['config_caching'] = 0;
	}
	unset($config_cache);

	$row = new mosConfig();
	if (!$row->bind($_POST)) {
		mosRedirect("index2.php", $row->getError());
	}

	$editor = intval(mosGetParam($_POST, 'editor', 0));
	if ($editor > 0) {
		$query = "UPDATE #__mambots SET published = 0 WHERE published >= 0 AND folder='editors'";
		$database->setQuery( $query );
		$database->query() or die( $database->getErrorMsg() );

		$query = "UPDATE #__mambots SET published = 1 WHERE id = $editor";
		$database->setQuery( $query );
		$database->query() or die( $database->getErrorMsg() );
	}

	$config = "<?php \n";
	$config .= "/*\n";
	$config .= "Elxis CMS global configuration file\n";
	$config .= "Last saved on ".date('Y-m-d H:i:s')." by ".$my->username."\n";
	$config .= "Copyright elxis.org 2006-".date('Y')."\n";
	$config .= "*/\n\n";
	$config .= $row->getVarText();
	$config .= "\n?>";

	$fname = $mosConfig_absolute_path.'/configuration.php';
    $enable_write = (int)mosGetParam($_POST,'enable_write',0);
	$oldperms = fileperms($fname);
    
	if ($enable_write) { $fmanager->spChmod($fname, '0666'); }

	if ($fmanager->writeFile($fname, $config)) {
		if ($enable_write) {
			$fmanager->spChmod($fname, '0666');
		} else {
			if (mosGetParam($_POST,'disable_write',0)) {
				$fmanager->spChmod($fname, '0644'); //444 generates problems if the owner is "nobody"
			}
		}

		$msg = $adminLanguage->A_COMP_CONF_UPDATED;

	    //apply file and directory permissions if requested by user
	    $applyFilePerms = mosGetParam($_POST,'applyFilePerms',0) && $row->config_fileperms!='';
	    $applyDirPerms = mosGetParam($_POST,'applyDirPerms',0) && $row->config_dirperms!='';
	    if ($applyFilePerms || $applyDirPerms) {
	        $mosrootfiles = array(
	            'administrator',
	            'bridges',
	            'cache',
	            'components',
	            'editor',
	            'help',
	            'images',
	            'includes',
	            'language',
	            'mambots',
	            'media',
	            'modules',
	            'templates',
	            'tmpr',
	            'configuration.php',
	            'index.php',
	            'index2.php'
	        );
	        $filemode = NULL;
	        if ($applyFilePerms) { $filemode = $row->config_fileperms; }
	        $dirmode = NULL;
	        if ($applyDirPerms) { $dirmode = $row->config_dirperms; }
			foreach ($mosrootfiles as $file) {
				$fmanager->eChmodRecursive($mosConfig_absolute_path.'/'.$file, $filemode, $dirmode, false);
			}
		}

		switch ( $task ) {
			case 'apply':
				mosRedirect('index2.php?option=com_config&hidemainmenu=1', $msg);
			break;
			case 'save':
			default:
				mosRedirect('index2.php', $msg);
			break;
		}

	} else {
		if ($enable_write) { $fmanager->spChmod($fname, '0666'); }
		mosRedirect('index2.php', $fmanager->last_error());
	}
}


function checkftpconfig() {
	global $mainframe;

	if (trim($mainframe->getCfg('ftp_host')) == '') {
		$msg = "<span style=\"font-weight: bold; color: red;\">*** FAILED! ***</span><br />\n";
		$msg .= 'FTP server is empty';
	} else if (trim($mainframe->getCfg('ftp_user')) == '') {
		$msg = "<span style=\"font-weight: bold; color: red;\">*** FAILED! ***</span><br />\n";
		$msg .= 'FTP user is empty';
	} else if (trim($mainframe->getCfg('ftp_pass')) == '') {
		$msg = "<span style=\"font-weight: bold; color: red;\">*** FAILED! ***</span><br />\n";
		$msg .= 'FTP password is empty';
	} else if (trim($mainframe->getCfg('ftp_port')) == '') {
		$msg = "<span style=\"font-weight: bold; color: red;\">*** FAILED! ***</span><br />\n";
		$msg .= 'FTP port is empty';
	} else if (trim($mainframe->getCfg('ftp_root')) == '') {
		$msg = "<span style=\"font-weight: bold; color: red;\">*** FAILED! ***</span><br />\n";
		$msg .= 'FTP root directory is empty';
	} else {
		require_once ($mainframe->getCfg('absolute_path').'/includes/KFTP/KFTP.php');
        $cftp = new KFTP($mainframe->getCfg('ftp_host'), $mainframe->getCfg('ftp_port'), $mainframe->getCfg('ftp_user'), $mainframe->getCfg('ftp_pass'));
    	if (!$cftp->connected) { $cftp->connect(); }
    	if (!$cftp->connected) {
    		$msg = "<span style=\"font-weight: bold; color: red;\">*** FAILED! ***</span><br />\n";
    		$msg .= _GEM_CNOT_CONFTP;
    	} else {
			$rfiles = $cftp->readdir($mainframe->getCfg('ftp_root'));
			if ($rfiles && is_array($rfiles) && isset($rfiles['files']['configuration.php']) && isset($rfiles['files']['index2.php'])) {
				$msg = "<span style=\"font-weight: bold; color: green;\">*** SUCCESS! ***</span><br />\n";
				$msg .= 'Elxis installation found. Your FTP settings are correct.';
			} else {
				$msg = "<span style=\"font-weight: bold; color: #FF9900;\">*** FAILED - WRONG ELXIS ROOT! ***</span><br />\n";
				$msg .= "Elxis connected successfully to an FTP server but Elxis installation not found.<br />\n";
				$msg .= "Please check <strong>FTP root</strong> setting in Elxis global configuration!\n";
			}
			$cftp->close();
    	}
	}
	echo $msg;
}

?>