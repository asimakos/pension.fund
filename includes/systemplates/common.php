<?php 
/** 
* @version: $Id: common.php 39 2010-06-07 18:36:03Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: System Templates
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info [at] elxis [dot] org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


/****************************/
/* DETECT AND LOAD LANGUAGE */
/****************************/
function systpl_loadlanguage() {
	global $mosConfig_lang, $mosConfig_absolute_path;

	if (isset($_GLOBALS['lang'])) {
		$elxislang = $_GLOBALS['lang'];
	}else if (isset($_GLOBALS['alang'])) {
		$elxislang = $_GLOBALS['alang'];
	} elseif (isset($_GET['mylang'])) {
		$elxislang = $_GET['mylang'];
	} elseif (isset($_COOKIE['elxis_lang'])) {
		$elxislang = $_COOKIE['elxis_lang'];
	} else {
		$elxislang = $mosConfig_lang;
	}

	if (!defined('_LANGUAGE')) {
		if (file_exists($mosConfig_absolute_path.'/language/'.$elxislang.'/'.$elxislang.'.php')) {
			require_once($mosConfig_absolute_path.'/language/'.$elxislang.'/'.$elxislang.'.php');
		} elseif (file_exists($mosConfig_absolute_path.'/language/'.$mosConfig_lang.'/'.$mosConfig_lang.'.php')) {
			require_once($mosConfig_absolute_path.'/language/'.$mosConfig_lang.'/'.$mosConfig_lang.'.php');
		} else {
			require_once($mosConfig_absolute_path.'/language/english/english.php');
		}
	}

	if (!defined('_GEM_RTL')) {
		if (file_exists($mosConfig_absolute_path.'/language/'.$elxislang.'/'.$elxislang.'.gemini.php')) {
			require_once($mosConfig_absolute_path.'/language/'.$elxislang.'/'.$elxislang.'.gemini.php');
		} elseif (file_exists($mosConfig_absolute_path.'/language/'.$mosConfig_lang.'/'.$mosConfig_lang.'.gemini.php')) {
			require_once($mosConfig_absolute_path.'/language/'.$mosConfig_lang.'/'.$mosConfig_lang.'.gemini.php');
		} else {
			require_once($mosConfig_absolute_path.'/language/'.$mosConfig_lang.'/'.$mosConfig_lang.'.gemini.php');
		}
	}

	if (!defined('ELX_SYSTPL_OFFLINE')) {
		include($mosConfig_absolute_path.'/includes/systemplates/language.php');
	}
}


/************************/
/* GET PAGE'S META DATA */
/************************/
function systpl_pgmeta() {
	global $mosConfig_sitename;

	switch (_ELXIS_SYSALERT) {
		case 1: return array(ELX_SYSTPL_OFFLINE.' - '.$mosConfig_sitename, ELX_SYSTPL_OFFLINED); break;
		case 2: return array(ELX_SYSTPL_OFFLINE.' - '.$mosConfig_sitename, ELX_SYSTPL_OFFLINED); break;
		case 4: return array(_ELX_ERROR.' - '.$mosConfig_sitename, ELX_SYSTPL_ERRDBD); break;
		case 5: return array(_ELX_ERROR.' 404 - '.$mosConfig_sitename, _E_PAGE_NOTFOUND); break;
		case 3: default: return array(_ELX_ERROR.' - '.$mosConfig_sitename, ELX_SYSTPL_ERRD); break;
	}
}


/***********************/
/* GET SYSTEM TEMPLATE */
/***********************/
function systpl_template() {
	switch (_ELXIS_SYSALERT) {
		case 1: return 'offline'; break;
		case 2: return 'offline_login'; break;
		case 4: return 'error'; break; //database error
		case 5: return 'error404'; break;
		case 3: default: return 'error'; break;
	}
}


/*************************************************/
/* START HTML (MOSTLY HEAD) FOR SYSTEM TEMPLATES */
/*************************************************/
function systpl_htmlstart() {
	global $mosConfig_live_site;

	if (_GEM_RTL == 1) {
		$cssfile = $mosConfig_live_site.'/includes/systemplates/templates/css/system-rtl.css';
	} else {
		$cssfile = $mosConfig_live_site.'/includes/systemplates/templates/css/system.css';
	}
	$pgmeta = systpl_pgmeta();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo _LANGUAGE; ?>" xml:lang="<?php echo _LANGUAGE; ?>"<?php echo (_GEM_RTL) ? ' dir="rtl"' : ''; ?>>
<head>
<title><?php echo $pgmeta[0]; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo $pgmeta[1]; ?>" />
<meta name="Generator" content="Elxis - Copyright (C) 2006-<?php echo date('Y'); ?> Elxis.org. All rights reserved." />
<meta name="robots" content="index, follow" />
<link rel="shortcut icon" href="<?php echo $mosConfig_live_site; ?>/images/favicon.ico" />
<link href="<?php echo $cssfile; ?>" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<?php 
}


/**********************************/
/* HTML HEAD FOR SYSTEM TEMPLATES */
/**********************************/
function systpl_htmlend() {
?>
<div class="elxiscopyright">
	Powered by <a href="http://www.elxis.org/" title="Elxis CMS">Elxis</a> - Open Source CMS.<br />
	Copyright (C) 2006-<?php echo date('Y'); ?> <a href="http://www.elxis.org" title="Elxis Team">elxis.org</a>. All rights reserved.
</div>
</body>
</html>
<?php 
}

?>