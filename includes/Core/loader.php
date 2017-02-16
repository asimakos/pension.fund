<?php 
/**
* @version: $Id: loader.php 2613 2010-04-17 16:00:02Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Loader
* @author: Ioannis Sannos
* @email: info@elxis.org
* @link: http://www.elxis.org
* @description: Elxis loader
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (version_compare("5.1", phpversion(), "<=")) {
	if (function_exists('ini_get') && is_callable('ini_get')) {
		if (!ini_get('date.timezone')) {
			date_default_timezone_set(@date_default_timezone_get());
		}
	}
}

//Load eUTF for UTF-8 string handling
require_once($mosConfig_absolute_path.'/includes/Core/utf8.class.php');

//Load and Initialize FileManager
require_once($mosConfig_absolute_path.'/includes/Core/filemanager.class.php');
$fmanager = new FileManager;

//Load Elxis Core
require_once($mosConfig_absolute_path.'/includes/Core/elxis.php');

//Load Language
if (defined('_ELXIS_ADMIN')) {
	require_once( $mosConfig_absolute_path . '/includes/Core/alanguage.php' );
	$elxis_language = new ElxisLang();
		if (isset($_GET['mylang'])) {
			$elxis_language->changeLang(trim(strip_tags($_GET['mylang'])));
		} else {
			$elxis_language->getLang();
		}
	$alang = $elxis_language->alang;

	require_once( $mosConfig_absolute_path.'/includes/Core/locale.php' );
	eLOCALE::set_locale($alang);

	require_once( $mosConfig_absolute_path.'/administrator/language/'.$alang.'/'.$alang.'.php' );
    require_once( $mosConfig_absolute_path.'/administrator/language/'.$alang.'/'.$alang.'.gemini.php');
	$option = strtolower(mosGetParam($_REQUEST, 'option', ''));
		if ($option == '') { $option = 'com_admin'; }

		if (@file_exists ($mosConfig_absolute_path.'/administrator/language/'.$alang.'/'.$alang.'.'.$option.'.php')) {
			require_once ($mosConfig_absolute_path.'/administrator/language/'.$alang.'/'.$alang.'.'.$option.'.php');
	    } elseif (@file_exists ($mosConfig_absolute_path.'/administrator/language/'.$alang.'/'.$alang.'.com_'.$option.'.php')) {
			require_once ($mosConfig_absolute_path.'/administrator/language/'.$alang.'/'.$alang.'.com_'.$option.'.php');
	    } else {
			require_once ($mosConfig_absolute_path.'/administrator/language/'.$alang.'/'.$alang.'.com_admin.php');
	    }
	$adminLanguage = new adminLanguage();
	require_once ($mosConfig_absolute_path.'/administrator/language/'.$alang.'/'.$alang.'.xml.php');
	$xmlLanguage = new xmlLanguage();
} else {
	require_once( $mosConfig_absolute_path.'/includes/Core/language.php');
	$elxis_language = new ElxisLang();
	if (isset ($_GET['mylang'])) {
		$elxis_language->changeLang(trim(strip_tags($_GET['mylang'])));
	} else {
		$elxis_language->getLang();
	}
	$lang = $elxis_language->lang;

	require_once($mosConfig_absolute_path.'/includes/Core/locale.php');
	eLOCALE::set_locale($lang);

	require_once ($mosConfig_absolute_path.'/language/'.$lang.'/'.$lang.'.php');
	require_once ($mosConfig_absolute_path.'/language/'.$lang.'/'.$lang.'.gemini.php');
	//static cache support
	require_once($mosConfig_absolute_path.'/includes/Core/staticcache.php');
}

require_once($mosConfig_absolute_path.'/includes/Core/preflang.class.php');

?>