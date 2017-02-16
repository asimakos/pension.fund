<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


/******************************************/
/* DISPLAY CAPTURE OUTPUT OF MAIN ELEMENT */
/******************************************/ 
function mosMainBody() {
	$mosmsg = mosGetParam( $_REQUEST, 'mosmsg', '' );
	if (!get_magic_quotes_gpc()) {
		$mosmsg = addslashes( $mosmsg );
	}

	$popMessages = false;
	if ($mosmsg && !$popMessages) {
		echo _LEND.'<div class="message">'.$mosmsg.'</div>'._LEND;
	}
	echo $GLOBALS['_MOS_OPTION']['buffer'];
	if ($mosmsg && $popMessages) {
		echo _LEND.'<script type="text/javascript">alert(\''.$mosmsg.'\');</script>'._LEND;
	}
}


/********************/
/* LOAD A COMPONENT */
/********************/
function mosLoadComponent( $name ) {
	global $mainframe, $database;

	include( $mainframe->getCfg( 'absolute_path' ).'/components/com_'.$name.'/'.$name.'.php' );
}


/**********************/
/* INITIALIZE MODULES */
/**********************/
function &initModules() {
	global $database, $my, $Itemid, $lang;

	if (!isset( $GLOBALS['_MOS_MODULES'] )) {
		$query = "SELECT m.id, m.title, m.module, m.position, m.content, m.showtitle, m.params, m.language"
		."\n FROM #__modules m, #__modules_menu mm"
		."\n WHERE m.published='1' AND m.access IN (".$my->allowed.") AND m.client_id='0'"
		."\n AND ((m.language IS NULL) OR (m.language LIKE '%".$lang."%'))"
		."\n AND mm.moduleid=m.id"
		."\n AND ((mm.menuid = '0') OR (mm.menuid = '".$Itemid."'))"
		."\n ORDER BY m.ordering";
		$database->setQuery( $query );
		$modules = $database->loadObjectList();

        if ($modules) {
		    foreach ($modules as $module) {
                $GLOBALS['_MOS_MODULES'][$module->position][] = $module;
            }
		}
	}
	return $GLOBALS['_MOS_MODULES'];
}


/***********************************/
/* COUNT TEMPLATE POSITION MODULES */
/***********************************/
function mosCountModules( $position='left' ) {
	$modules = initModules();
	if (isset( $GLOBALS['_MOS_MODULES'][$position] )) {
	    return count( $GLOBALS['_MOS_MODULES'][$position] );
	} else {
		return 0;
	}
}


/*****************************/
/* LOAD A POSITION'S MODULES */
/*****************************/
/* style: 0=normal, 1=horiz, -1=no wrapper */
function mosLoadModules( $position='left', $style=0 ) {
	global $mainframe, $database, $my, $Itemid;

	$tp = intval(mosGetParam($_GET, 'tp', 0));
	if ($tp) {
	    echo '<div style="background-color:#eeeeee;margin:2px;padding:10px;border:1px solid #f00;color:#700;">'.$position.'</div>'._LEND;
		return;
	}
	$style = intval( $style );
	$cache = mosCache::getCache('com_content');

	require_once($mainframe->getCfg('absolute_path').'/includes/frontend.html.php');

	$allModules = initModules();
	if (isset( $GLOBALS['_MOS_MODULES'][$position] )) {
	    $modules = $GLOBALS['_MOS_MODULES'][$position];
	} else {
		$modules = array();
	}

	if (count( $modules ) < 1) {
		$style = 0;
	}
	if ($style == 1) {
		echo '<table cellspacing="1" cellpadding="0" border="0" width="100%" style="style-1">'._LEND;
		echo '<tr>'._LEND;
	}

	$prepend = ($style == 1) ? '<td valign="top">'._LEND : '';
	$postpend = ($style == 1) ? '</td>'._LEND : '';

	$count = 1;
	foreach ($modules as $module) {
		$module = elxTransModTitle($module);
		$params = new mosParameters( $module->params );

		echo $prepend;
		if ((substr($module->module,0,4))=='mod_') {
			if (($params->get('cache') == 1) && ($mainframe->getCfg('caching') == 1)) {
				$cache->call('modules_html::module2', $module, $params, $Itemid, $style );
			} else {
				modules_html::module2($module, $params, $Itemid, $style, $count);
			}
		} else {
			if (($params->get('cache') == 1) && ($mainframe->getCfg('caching') == 1)) {
				$cache->call('modules_html::module', $module, $params, $Itemid, $style );
			} else {
				modules_html::module($module, $params, $Itemid, $style);
			}
		}
		echo $postpend;
		$count++;
	}
	if ($style == 1) {
		echo '</tr></table>'._LEND;
	}
}


/**********************/
/* LOAD SINGLE MODULE */
/**********************/
/*
@name: module name, ie mod_banners
@style: 0=normal, 1=horiz, -1=no wrapper 
*/
function elxLoadModule( $name='', $style=-1 ) {
	global $mainframe, $database, $my, $lang, $Itemid;

	$tp = intval(mosGetParam($_GET, 'tp', 0));
	if ($tp) {
	    echo '<div style="background-color:#eeeeee;margin:2px;padding:10px;border:1px solid #f00;color:#700;">'.$name.'</div>'._LEND;
		return;
	}
	$style = intval( $style );
	$cache = mosCache::getCache('com_content');

	require_once($mainframe->getCfg('absolute_path').'/includes/frontend.html.php' );

	$query = "SELECT id, title, module, position, content, showtitle, params, language FROM #__modules"
	."\n WHERE module='".$name."' AND published='1' AND access IN (".$my->allowed.") AND client_id='0'"
	."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
	$database->setQuery($query, '#__', 1, 0);
	if (!$database->loadObject($module)) { return; }

	$module = elxTransModTitle($module);

	$params = new mosParameters( $module->params );

	if ((substr($module->module,0,4))=='mod_') {
		if (($params->get('cache') == 1) && ($mainframe->getCfg('caching') == 1)) {
			$cache->call('modules_html::module2', $module, $params, $Itemid, $style );
		} else {
			modules_html::module2( $module, $params, $Itemid, $style, '1' );
		}
	} else {
		if (($params->get('cache') == 1) && ($mainframe->getCfg('caching') == 1)) {
			$cache->call('modules_html::module', $module, $params, $Itemid, $style );
		} else {
			modules_html::module( $module, $params, $Itemid, $style );
		}
	}
}


/**************************/
/* TRANSLATE MODULE TITLE */
/**************************/
function elxTransModTitle($mod) {
	global $my;

	if (defined('_ELXIS_ADMIN')) { return $mod; }
	if (trim($mod->language) != '') { return $mod; }

	switch ($mod->module) {
		case 'mod_poll':
			$mod->title = _POLL_POLLS;
		break;
		case 'mod_login':
			$mod->title = ($my->id) ? _E_USER_PROFILE : _USER_LOGIN;
		break;
		case 'mod_rssfeed':
			$mod->title = (defined('_E_SYNDICATE')) ? _E_SYNDICATE : $mod->title;
		break;
		case 'mod_latestnews':
			$mod->title = (defined('_E_LATESTNEWS')) ? _E_LATESTNEWS : $mod->title;
		break;
		case 'mod_stats':
			$mod->title = (defined('_E_STATISTICS')) ? _E_STATISTICS : $mod->title;
		break;
		case 'mod_whosonline':
			$mod->title = (defined('_E_WHOSONLINE')) ? _E_WHOSONLINE : $mod->title;
		break;
		case 'mod_mostread':
			$mod->title = _E_MOST_POPULAR;
		break;
		case 'mod_templatechooser':
			$mod->title = (defined('_E_CHOOSETEMP')) ? _E_CHOOSETEMP : $mod->title;
		break;
		case 'mod_archive':
			$mod->title = _CMN_ARCHIVE;
		break;
		case 'mod_sections':
			$mod->title = (defined('_E_SECTIONS')) ? _E_SECTIONS : $mod->title;
		break;		
		case 'mod_newsflash':
			$mod->title = _NEWSFLASH_BOX;
		break;
		case 'mod_related_items':
			$mod->title = _E_RELLINKS;
		break;
		case 'mod_search':
			$mod->title = _E_SEARCH;
		break;
		case 'mod_random_image':
			$mod->title = (defined('_E_RANDOMIMG')) ? _E_RANDOMIMG : $mod->title;
		break;
		case 'mod_banners':
			$mod->title = (defined('_E_BANNERS')) ? _E_BANNERS : $mod->title;
		break;
		case 'mod_language':
			$mod->title = _E_LANGUAGE;
		break;
		case 'mod_random_profile':
			$mod->title = _E_RANDOMUSERS;
		break;
		case 'mod_mainmenu':
			switch (trim(strtolower($mod->title))) {
				case 'user menu': $mod->title = _UMENU_TITLE; break;
				case 'main menu': $mod->title = _MAINMENU_BOX; break;
				default: break;
			}
		break;
		default:
		break;
	}
	return $mod;
}


/***********************/
/* ASSEMBLES HEAD TAGS */
/***********************/
function mosShowHead() {
	global $database, $option, $my, $mainframe, $_VERSION, $lang, $mosConfig_favicon;

	$task = mosGetParam( $_REQUEST, 'task', '' );
    if (($_VERSION->PRODUCT != 'E'.'l'.'x'.'i'.'s') || (!preg_match('/eLxiS/i', $_VERSION->COPYRIGHT))) { die (); }

    $meta = $mainframe->_head['meta'];
    $md = 0;
    $mk = 0;
	for ($i = 0; $i < count($meta); $i++) {
	    $p0 = $meta[$i][0];
	    $p1 = $meta[$i][1];

		if ($p0 == 'description') {
		    $md = 1;
            if ($p1 == '') { $mainframe->appendMetaTag('description', $mainframe->getCfg('MetaDesc')); }
		} else if ($p0 == 'keywords') {
		    $mk = 1;
            if ($p1 == '') { $mainframe->appendMetaTag('keywords', $mainframe->getCfg('MetaKeys')); }
		}
	}
	if (!$md) { $mainframe->addMetaTag('description', $mainframe->getCfg('MetaDesc')); }
	if (!$mk) { $mainframe->addMetaTag('keywords', $mainframe->getCfg('MetaKeys')); }

	$mainframe->addMetaTag('Generator', $_VERSION->PRODUCT.' - '.$_VERSION->COPYRIGHT);
	$mainframe->addMetaTag('robots', 'index, follow');

	$rtl = (_GEM_RTL) ? '-rtl' : '';
	$beforeCustom = array();
	if ($mainframe->getCfg('sef')) {
		$beforeCustom[] = '<base href="'.$mainframe->getCfg('ssl_live_site').'/" />';
	}
	$beforeCustom[] = '<link href="'.$mainframe->getCfg('ssl_live_site').'/includes/standard'.$rtl.'.css" rel="stylesheet" type="text/css" media="all" />';
	if ($mainframe->getCfg('sef') == 2) {
		$beforeCustom[] = '<script type="text/javascript" src="'.$mainframe->getCfg('ssl_live_site').'/administrator/includes/js/ajax_new.js"></script>';   
	}
	$beforeCustom[] = '<script type="text/javascript" src="'.$mainframe->getCfg('ssl_live_site').'/includes/js/elxis.js"></script>';

	echo $mainframe->getHead($beforeCustom);

	//support for Firefox Live Bookmarks ability for site syndication
	$database->setQuery("SELECT id FROM #__components WHERE name = 'Syndicate'", '#__', 1, 0);
	$id = $database->loadResult();

	//load the row from the db table
	$row = new mosComponent( $database );
	$row->load( $id );

	//get params definitions
	$params = new mosParameters( $row->params, $mainframe->getPath( 'com_xml', $row->option ), 'component' );

	$live_bookmark = $params->get( 'live_bookmark', 0 );
	if ( $live_bookmark ) {
		//custom bookmark file name
		$bookmark_file = $params->get( 'bookmark_file', $live_bookmark );
		$multilingual = intval($params->get('multilingual', 0));
		if ($multilingual) {
			$bookmark_file = str_replace('.xml', '-'.$lang.'.xml', $bookmark_file);
		}
		$link_file = $mainframe->getCfg('live_site').'/cache/'.$bookmark_file;
		$filename = $mainframe->getCfg('absolute_path').'/cache/'.$bookmark_file;

		$cache = $params->get( 'cache', 1 );
		$cache_time = $params->get( 'cache_time', 3600 );
		$title = $params->def('title', $mainframe->getCfg('sitename'));

		// checks to see if cache file exists, to determine whether to create a new one
		if (!file_exists($filename) || (( time() - filemtime( $filename )) > $cache_time )) {
			$tempTask = $task;
			$task = 'live_bookmark';

			//sets bookmark feed type
			$_GET['feed'] = str_replace( '.xml', '', $live_bookmark );

			//loads rss component to create bookmark file
			require_once( $mainframe->getCfg('absolute_path').'/components/com_rss/rss.php' );
			$task = $tempTask;
		}
		echo '<link rel="alternate" type="application/rss+xml" title="'.$title.'" href="'.$link_file.'" />'._LEND;
	}

	//favorites icon
	if (($mainframe->getCfg('favicon') == '') || 
		!file_exists($mainframe->getCfg('absolute_path').'/images/'.$mainframe->getCfg('favicon'))) {
		$icon = $mainframe->getCfg('ssl_live_site').'/images/favicon.ico';		
	} else {
		$icon = $mainframe->getCfg('ssl_live_site').'/images/'.$mainframe->getCfg('favicon');		
	}
    echo '<link rel="shortcut icon" href="'.$icon.'" />'._LEND;
}

?>