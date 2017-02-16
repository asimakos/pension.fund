<?php 
/**
* @version: $Id: sef.php 37 2010-06-06 20:02:00Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Elxis SEO
* @author: Ioannis Sannos (datahell)
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @description: Generates search engines friendly URLs
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!isset($_SERVER['REQUEST_URI'])) {
    $_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'];
    $_SERVER['REQUEST_URI'] .= isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : '';
}

if ($mosConfig_sef && !defined('_ELXIS_ADMIN')) { sefParseUrl(); }


/****************************/
/* PARSE A SEF FORMATED URL */
/****************************/
function sefParseUrl() {
    global $mosConfig_sef;

    //prevent globals overwrite via REQUEST_URI
    if (preg_match('/(\b)GLOBALS|_REQUEST|_SERVER|_ENV|_COOKIE|_GET|_POST|_FILES|_SESSION(\b)/i', $_SERVER['REQUEST_URI']) > 0) {
        die('Invalid Request');
    }

    if ($mosConfig_sef == 2) { //Elxis SEO pro
		seoParseUrl();
    } else {
    	sefstdParseUrl();
    }
}


/*********************/
/* SEO PRO PARSE URL */
/*********************/
function seoParseUrl() {
	global $mosConfig_absolute_path, $mosConfig_live_site;

    $seolink = preg_replace('/^([\/])/', '', $_SERVER['REQUEST_URI']);
	$livesite = parse_url($mosConfig_live_site);
	if (isset($livesite['path']) && ($livesite['path'] != '')) { //site is in sub-directory
		$livesite['path'] = preg_replace('/^([\/])/', '', $livesite['path']);
		$livesite['path'] = preg_replace('/([\/])$/', '', $livesite['path']).'/';
		$seolink = preg_replace('#^('.$livesite['path'].')#', '', $seolink);
	}
	$sLink = preg_split('/[\?]/', $seolink);
	$parts = preg_split('/[\/]/', $sLink[0]);

	if (isset($parts[0]) && ($parts[0] != '')) {
		$lp = (eLOCALE::iso639_elxis($parts[0]) != '') ? 1 : 0;
		if ($lp) {
			$k = $parts[0];
			array_shift($parts);
			$seolink = preg_replace('/^('.$k.'\/)/', '', $seolink);
			unset($k);
		}
	}

	$seobase = $mosConfig_absolute_path.'/includes/seopro';
	$parts[0] = (isset($parts[0]) && ($parts[0] != '')) ? htmlspecialchars($parts[0]) : '';

	if ($parts[0] == 'members') {
		require_once($seobase.'/com_user.php');
		seores_com_user($seolink);
	} else if ($parts[0] == 'links') {
		require_once($seobase.'/com_weblinks.php');
		seores_com_weblinks($seolink);
	} else if ($parts[0] == 'contact') {
		require_once($seobase.'/com_contact.php');
		seores_com_contact($seolink);
	} else if ($parts[0] == 'feeds') {
		require_once($seobase.'/com_newsfeeds.php');
		seores_com_newsfeeds($seolink);
	} else if ($parts[0] == 'registration') {
		require_once($seobase.'/com_registration.php');
		seores_com_registration($seolink);
	} else if ($parts[0] == 'rss') {
		require_once($seobase.'/com_rss.php');
		seores_com_rss($seolink);
	} else if ($parts[0] == 'polls') {
		require_once($seobase.'/com_poll.php');
		seores_com_poll($seolink);
	} else if ($parts[0] == 'banners') {
		require_once($seobase.'/com_banners.php');
		seores_com_banners($seolink);
	} else if ($parts[0] == 'eblog') {
		require_once($seobase.'/com_eblog.php');
		seores_com_eblog($seolink);
	} else if ($parts[0] == 'ext') {
		require_once($seobase.'/com_wrapper.php');
		seores_com_wrapper($seolink);
	} else if ($parts[0] == 'search.html') {
		require_once($seobase.'/com_search.php');
		seores_com_search($seolink);
	} else if (($parts[0] == 'login.html') || ($parts[0] == 'logout.html')) {
		require_once($seobase.'/com_login.php');
		seores_com_login($seolink);
    } else if (preg_match('/(.html)$/', $parts[0] )) { //autonomous page
		require_once($seobase.'/com_content.php');
		seores_com_content($seolink);
	} else if (($parts[0] == 'sitemap') || ($parts[0] == 'google.xml') || ($parts[0] == 'urllist.txt') || preg_match('/google\-(.*?)\.xml/', $parts[0])) {
		//special seo for component Sitemap
		if (!file_exists($seobase.'/com_sitemap.php')) { pageNotFound(); }
		require_once($seobase.'/com_sitemap.php');
		seores_com_sitemap($seolink);
	} else if ($parts[0] == 'directory') { //special seo for component EDir
		if (!file_exists($seobase.'/com_edir.php')) { pageNotFound(); }
		require_once($seobase.'/com_edir.php');
		seores_com_edir($seolink);
	} else if ($parts[0] == 'gallery') { //special seo for component IOS Gallery
		if (!file_exists($seobase.'/com_gallery.php')) { pageNotFound(); }
		require_once($seobase.'/com_gallery.php');
		seores_com_gallery($seolink);
	} else if ($parts[0] == 'eshop') { //special seo for component IOS eshop
		if (!file_exists($seobase.'/com_eshop.php')) { pageNotFound(); }
		require_once($seobase.'/com_eshop.php');
		seores_com_eshop($seolink);
	} else if ($parts[0] == 'reservations') { //special seo for component IOS reservations
		if (!file_exists($seobase.'/com_reservations.php')) { pageNotFound(); }
		require_once($seobase.'/com_reservations.php');
		seores_com_reservations($seolink);
	} else if ($parts[0] == 'newsletter') { //special seo for component IOS newsletter
		if (!file_exists($seobase.'/com_newsletter.php')) { pageNotFound(); }
		require_once($seobase.'/com_newsletter.php');
		seores_com_newsletter($seolink);
	} else if ($parts[0] == 'downloads') { //special seo for component IOS downloads
		if (!file_exists($seobase.'/com_downloads.php')) { pageNotFound(); }
		require_once($seobase.'/com_downloads.php');
		seores_com_downloads($seolink);
	} else if ($parts[0] == 'events') { //special seo for component Event Calendar
		if (!file_exists($seobase.'/com_eventcalendar.php')) { pageNotFound(); }
		require_once($seobase.'/com_eventcalendar.php');
		seores_com_eventcalendar($seolink);
	} else if ($parts[0] == 'arthrology') { //special seo for component Arthrology
		if (!file_exists($seobase.'/com_arthrology.php')) { pageNotFound(); }
		require_once($seobase.'/com_arthrology.php');
		seores_com_arthrology($seolink);
	} else if ($parts[0] == 'qpassport') { //special seo for component qPassport
		if (!file_exists($seobase.'/com_qpassport.php')) { pageNotFound(); }
		require_once($seobase.'/com_qpassport.php');
		seores_com_qpassport($seolink);
	} else if ($parts[0] == 'eforum') { //special seo for component eforum
		if (!file_exists($seobase.'/com_eforum.php')) { pageNotFound(); }
		require_once($seobase.'/com_eforum.php');
		seores_com_eforum($seolink);
	} else if ($parts[0] == 'webtv') { //special seo for component Web TV
		if (!file_exists($seobase.'/com_webtv.php')) { pageNotFound(); }
		require_once($seobase.'/com_webtv.php');
		seores_com_webtv($seolink);
	} else {
		//CHECK CONTENT
		$level1C = array('blog', 'archive', 'vote.html', 'submitted-content');
		$seosecs = getSEOsections('content');
		$level1C = array_merge($level1C, $seosecs);
		if (in_array($parts[0], $level1C)) {
			require_once($seobase.'/com_content.php');
			seores_com_content($seolink);
			if (isset($_SESSION['itemsyn'])) { unset($_SESSION['itemsyn']); }
			return;
		}

        $seobase = $mosConfig_absolute_path.'/includes/seopro/';
        if (preg_match('/^(com_)/', $parts[0] ) && file_exists($seobase.$parts[0].'.php')) { //third party component
            require_once($seobase.$parts[0].'.php');
            $func = 'seores_'.$parts[0];
            if (function_exists($func)) {
                $func($seolink);
                if (isset($_SESSION['itemsyn'])) { unset($_SESSION['itemsyn']); }
                return;
            }
        }

        //ERROR 404 EXTENDED CHECK
        if (!preg_match('/\,/', $seolink)) { //not a basic SEF URL
        	if (!file_exists($mosConfig_absolute_path.'/'.$parts[0]) && !is_dir($mosConfig_absolute_path.'/'.$parts[0].'/')) {
        		pageNotFound();
        	}
        }

		sefstdParseUrl();
	}
	if (isset($_SESSION['itemsyn'])) { unset($_SESSION['itemsyn']); }
}


/********************/
/* GET SEO SECTIONS */
/********************/
function getSEOsections($scope='content') {
	global $database;

    $database->setQuery("SELECT seotitle FROM #__sections WHERE scope='$scope' AND ((seotitle != '') OR (seotitle IS NOT NULL))");
    return $database->loadResultArray();    
}


/****************************************/
/* PARSE A SEF FORMATED URL THE OLD WAY */
/****************************************/
function sefstdParseUrl() {

	$url_array = explode("/", $_SERVER['REQUEST_URI']);

	/**
	* Content
	* http://www.domain.com/$option/$task/$sectionid/$id/$Itemid/$limit/$limitstart
	*/
	if (in_array("content", $url_array)) {

		$uri = explode("content/", $_SERVER['REQUEST_URI']);
		$option = "com_content";
		$_GET['option'] = $option;
		$_REQUEST['option'] = $option;
		$pos = array_search ("content", $url_array);

		// $option/$task/$sectionid/$id/$Itemid/$limit/$limitstart
		if (isset($url_array[$pos+6]) && ($url_array[$pos+6] != '')) {
			$task = $url_array[$pos+1];
			$sectionid = $url_array[$pos+2];
			$id = $url_array[$pos+3];
			$Itemid = $url_array[$pos+4];
			$limit = $url_array[$pos+5];
			$limitstart = $url_array[$pos+6];
			$_GET['task'] = $task;
			$_REQUEST['task'] = $task;
			$_GET['sectionid'] = $sectionid;
			$_REQUEST['sectionid'] = $sectionid;
			$_GET['id'] = $id;
			$_REQUEST['id'] = $id;
			$_GET['Itemid'] = $Itemid;
			$_REQUEST['Itemid'] = $Itemid;
			$_GET['limit'] = $limit;
			$_REQUEST['limit'] = $limit;
			$_GET['limitstart'] = $limitstart;
			$_REQUEST['limitstart'] = $limitstart;
			$QUERY_STRING = "option=com_content&task=$task&sectionid=$sectionid&id=$id&Itemid=$Itemid&limit=$limit&limitstart=$limitstart";
			// $option/$task/$id/$Itemid/$limit/$limitstart
		} else if (isset($url_array[$pos+5]) && ($url_array[$pos+5] != '')) {
			$task = $url_array[$pos+1];
			$id = $url_array[$pos+2];
			$Itemid = $url_array[$pos+3];
			$limit = $url_array[$pos+4];
			$limitstart = $url_array[$pos+5];
			$_GET['task'] = $task;
			$_REQUEST['task'] = $task;
			$_GET['id'] = $id;
			$_REQUEST['id'] = $id;
			$_GET['Itemid'] = $Itemid;
			$_REQUEST['Itemid'] = $Itemid;
			$_GET['limit'] = $limit;
			$_REQUEST['limit'] = $limit;
			$_GET['limitstart'] = $limitstart;
			$_REQUEST['limitstart'] = $limitstart;
			$QUERY_STRING = "option=com_content&task=$task&id=$id&Itemid=$Itemid&limit=$limit&limitstart=$limitstart";
			// $option/$task/$sectionid/$id/$Itemid
		} else if (!(isset($url_array[$pos+5]) && ($url_array[$pos+5] != '')) && isset($url_array[$pos+4]) && ($url_array[$pos+4] != '')) {
			$task = $url_array[$pos+1];
			$sectionid = $url_array[$pos+2];
			$id = $url_array[$pos+3];
			$Itemid = $url_array[$pos+4];
			$_GET['task'] = $task;
			$_REQUEST['task'] = $task;
			$_GET['sectionid'] = $sectionid;
			$_REQUEST['sectionid'] = $sectionid;
			$_GET['id'] = $id;
			$_REQUEST['id'] = $id;
			$_GET['Itemid'] = $Itemid;
			$_REQUEST['Itemid'] = $Itemid;
			$QUERY_STRING = "option=com_content&task=$task&sectionid=$sectionid&id=$id&Itemid=$Itemid";
			// $option/$task/$id/$Itemid
		} else if (!(isset($url_array[$pos+4]) && ($url_array[$pos+4] != '')) && (isset($url_array[$pos+3]) && ($url_array[$pos+3] != ''))) {
			$task = $url_array[$pos+1];
			$id = $url_array[$pos+2];
			$Itemid = $url_array[$pos+3];
			$_GET['task'] = $task;
			$_REQUEST['task'] = $task;
			$_GET['id'] = $id;
			$_REQUEST['id'] = $id;
			$_GET['Itemid'] = $Itemid;
			$_REQUEST['Itemid'] = $Itemid;
			$QUERY_STRING = "option=com_content&task=$task&id=$id&Itemid=$Itemid";
			// $option/$task/$id
		} else if (!(isset($url_array[$pos+3]) && ($url_array[$pos+3] != '')) && (isset($url_array[$pos+2]) && ($url_array[$pos+2] != ''))) {
			$task = $url_array[$pos+1];
			$id = $url_array[$pos+2];
			$_GET['task'] = $task;
			$_REQUEST['task'] = $task;
			$_GET['id'] = $id;
			$_REQUEST['id'] = $id;
			$QUERY_STRING = "option=com_content&task=$task&id=$id";
			// $option/$task
		} else if (!(isset($url_array[$pos+2]) && ($url_array[$pos+2] != '')) && (isset($url_array[$pos+1]) && ($url_array[$pos+1] != ''))) {
			$task = $url_array[$pos+1];
			$_GET['task'] = $task;
			$_REQUEST['task'] = $task;
			$QUERY_STRING = "option=com_content&task=$task";
		}

		$_SERVER['QUERY_STRING'] = $QUERY_STRING;
		$REQUEST_URI = $uri[0]."index.php?".$QUERY_STRING;
		$_SERVER['REQUEST_URI'] = $REQUEST_URI;
	}

    if (in_array("component", $url_array)) {
		$uri = explode("component/", $_SERVER['REQUEST_URI']);
		$uri_array = explode("/", $uri[1]);
		$QUERY_STRING = '';

		foreach($uri_array as $value) {
			$temp = explode(",", $value);
			if (isset($temp[0]) && $temp[0]!="" && isset($temp[1]) && $temp[1]!="") {
				$_GET[$temp[0]] = $temp[1];
				$_REQUEST[$temp[0]] = $temp[1];
				$QUERY_STRING .= $temp[0]=="option" ? "$temp[0]=$temp[1]" : "&$temp[0]=$temp[1]";
			}
		}

		$_SERVER['QUERY_STRING'] = $QUERY_STRING;
		$REQUEST_URI = $uri[0]."index.php?".$QUERY_STRING;
		$_SERVER['REQUEST_URI'] = $REQUEST_URI;
	}
}


/******************/
/* CREATE SEF URL */
/******************/
function sefRelToAbs( $string, $seolink='' ) {
	global $mosConfig_live_site, $mosConfig_sef, $mosConfig_absolute_path, $database, $lang, $mosConfig_lang;

	if ($mosConfig_sef == 2) {
		$isoc = eLOCALE::elxis_iso639($lang);
		if ($seolink != '') {
			return ($lang != $mosConfig_lang) ? $mosConfig_live_site.'/'.$isoc.'/'.$seolink : $mosConfig_live_site.'/'.$seolink;
		}
        if (($string == 'index.php') || ($string == '')) {
        	return ($lang != $mosConfig_lang) ? $mosConfig_live_site.'/'.$isoc.'/' : $mosConfig_live_site.'/';
        }

		$seobase = $mosConfig_absolute_path.'/includes/seopro';
		$string = urldecode($string);
		$string = preg_replace('/(&amp;)/', '&', $string);

        preg_match('/option\=(.*?)([\&]|$)/s', $string, $matches);
        if (isset($matches[1]) && preg_match('/com\_/', $matches[1])) {
            $_option = strtolower($matches[1]);
        } else {
            $x = sefstdRelToAbs($string);
            return $x;
        }

		if ($_option == 'com_frontpage') {
			return ($lang != $mosConfig_lang) ? $mosConfig_live_site.'/'.$isoc.'/' : $mosConfig_live_site.'/';
        } else if ($_option == 'com_user') {
			require_once($seobase.'/com_user.php');
			$x = seogen_com_user($string);
			return ($lang != $mosConfig_lang) ? str_replace($mosConfig_live_site, $mosConfig_live_site.'/'.$isoc, $x) : $x;
		} else if ($_option == 'com_weblinks') {
			require_once($seobase.'/com_weblinks.php');
			$x = seogen_com_weblinks($string);
			return ($lang != $mosConfig_lang) ? str_replace($mosConfig_live_site, $mosConfig_live_site.'/'.$isoc, $x) : $x;
		} else if ($_option == 'com_contact') {
			require_once($seobase.'/com_contact.php');
			$x = seogen_com_contact($string);
			return ($lang != $mosConfig_lang) ? str_replace($mosConfig_live_site, $mosConfig_live_site.'/'.$isoc, $x) : $x;
		} else if ($_option == 'com_newsfeeds') {
			require_once($seobase.'/com_newsfeeds.php');
			$x = seogen_com_newsfeeds($string);
			return ($lang != $mosConfig_lang) ? str_replace($mosConfig_live_site, $mosConfig_live_site.'/'.$isoc, $x) : $x;
		} else if ($_option == 'com_registration') {
			require_once($seobase.'/com_registration.php');
			$x = seogen_com_registration($string);
			return ($lang != $mosConfig_lang) ? str_replace($mosConfig_live_site, $mosConfig_live_site.'/'.$isoc, $x) : $x;
		} else if ($_option == 'com_login') {
			require_once($seobase.'/com_login.php');
			$x = seogen_com_login($string);
			return ($lang != $mosConfig_lang) ? str_replace($mosConfig_live_site, $mosConfig_live_site.'/'.$isoc, $x) : $x;
		} else if ($_option == 'com_rss') {
			require_once($seobase.'/com_rss.php');
			$x = seogen_com_rss($string);
			return ($lang != $mosConfig_lang) ? str_replace($mosConfig_live_site, $mosConfig_live_site.'/'.$isoc, $x) : $x;
		} else if ($_option == 'com_poll') {
			require_once($seobase.'/com_poll.php');
			$x = seogen_com_poll($string);
			return ($lang != $mosConfig_lang) ? str_replace($mosConfig_live_site, $mosConfig_live_site.'/'.$isoc, $x) : $x;
		} else if ($_option == 'com_banners') {
			require_once($seobase.'/com_banners.php');
			$x = seogen_com_banners($string);
			return ($lang != $mosConfig_lang) ? str_replace($mosConfig_live_site, $mosConfig_live_site.'/'.$isoc, $x) : $x;
		} else if ($_option == 'com_eblog') {
			require_once($seobase.'/com_eblog.php');
			$x = seogen_com_eblog($string);
			return ($lang != $mosConfig_lang) ? str_replace($mosConfig_live_site, $mosConfig_live_site.'/'.$isoc, $x) : $x;
		} else if ($_option == 'com_wrapper') {
			require_once($seobase.'/com_wrapper.php');
			$x = seogen_com_wrapper($string);
			return ($lang != $mosConfig_lang) ? str_replace($mosConfig_live_site, $mosConfig_live_site.'/'.$isoc, $x) : $x;
		} else if ($_option == 'com_search') {
			require_once($seobase.'/com_search.php');
			$x = seogen_com_search($string);
			return ($lang != $mosConfig_lang) ? str_replace($mosConfig_live_site, $mosConfig_live_site.'/'.$isoc, $x) : $x;
		} else if ($_option == 'com_content') {
			require_once($seobase.'/com_content.php');
			$x = seogen_com_content($string);
			return ($lang != $mosConfig_lang) ? str_replace($mosConfig_live_site, $mosConfig_live_site.'/'.$isoc, $x) : $x;
		}

        //third party components (start with their name com_... )
        if (file_exists($seobase.'/'.$_option.'.php')) {
            require_once($seobase.'/'.$_option.'.php');
            $func = 'seogen_'.$_option;
            if (function_exists($func)) {
                $x = $func($string);
                return ($lang != $mosConfig_lang) ? str_replace($mosConfig_live_site, $mosConfig_live_site.'/'.$isoc, $x) : $x;
            }
        } 

        $x = sefstdRelToAbs($string);
        return $x;
	} else {
		$x = sefstdRelToAbs($string);
		return $x;
	}
}


/***************************/
/* CREATE STANDARD SEF URL */
/***************************/
function sefstdRelToAbs( $string ) {
	global $mosConfig_live_site, $mosConfig_sef, $lang, $mosConfig_lang;

	if ($mosConfig_sef && !preg_match("/^(([^:\/?#]+):)/i",$string) && !strcasecmp(substr($string,0,9),"index.php")) {
		// Replace all &amp; with &
		$string = str_replace( '&amp;', '&', $string );

		//Home
		if ($string == 'index.php') { $string=''; }

		$sefstring = '';
		if ( (preg_match("/option\=com_content/i",$string) || preg_match("/option\=content/",$string) ) && !preg_match("/task\=new/",$string) && !preg_match("/task\=edit/",$string) ) {

			/*
			Content
			index.php?option=com_content&task=$task&sectionid=$sectionid&id=$id&Itemid=$Itemid&limit=$limit&limitstart=$limitstart
			*/
			$sefstring .= "content/";
			if (preg_match("/\&task\=/i",$string)) {
				$temp = preg_split("/\&task\=/", $string);
				$temp = preg_split("/\&/", $temp[1]);
				$sefstring .= $temp[0]."/";
			}
			if (preg_match("/\&sectionid\=/i",$string)) {
				$temp = preg_split("/\&sectionid\=/", $string);
				$temp = preg_split("/\&/", $temp[1]);
				$sefstring .= intval($temp[0])."/";
			}
			if (preg_match("/\&id\=/i",$string)) {
				$temp = preg_split("/\&id\=/", $string);
				$temp = preg_split("/\&/", $temp[1]);
				$sefstring .= intval($temp[0])."/";
			}
			if (preg_match("/\&Itemid\=/i",$string)) {
				$temp = preg_split("/\&Itemid\=/", $string);
				$temp = preg_split("/\&/", $temp[1]);
				$sefstring .= intval($temp[0])."/";
			}
			if (preg_match("/\&limit\=/i",$string)) {
				$temp = preg_split("/\&limit\=/", $string);
				$temp = preg_split("/\&/", $temp[1]);
				$sefstring .= intval($temp[0])."/";
			}
			if (preg_match("/\&limitstart\=/i",$string)) {
				$temp = preg_split("/\&limitstart\=/", $string);
				$temp = preg_split("/\&/", $temp[1]);
				$sefstring .= intval($temp[0])."/";
			}
			$string = $sefstring;
		} else if (preg_match("/option\=com\_/i",$string) && !preg_match("/option\=com\_registration/i",$string) && !preg_match("/task\=new/i",$string) && !preg_match("/task\=edit/i",$string)) {
			/*
			Components
			index.php?option=com_xxxx&...
			*/
			$sefstring = 'component/';
			$temp = preg_split("/\?/", $string);
			$temp = preg_split("/\&/", $temp[1]);
			foreach($temp as $key => $value) {
				$sefstring .= $value."/";
			}
			$string = str_replace( '=', ',', $sefstring );
		}

		$string = str_replace( '&', '&amp;', $string );
		$string = $mosConfig_live_site.'/'.$string;
		if ($mosConfig_sef == 2) { //for components with no seo pro extension
			$isoc = eLOCALE::elxis_iso639($lang);
			$string = ($lang != $mosConfig_lang) ? str_replace($mosConfig_live_site, $mosConfig_live_site.'/'.$isoc, $string) : $string;
		}
		return $string;
	} else {
	    $string = str_replace( '&amp;', '&', $string ); //xhtml compatibility
	    $string = str_replace( '&', '&amp;', $string ); //xhtml compatibility
		return $string;
	}
}


/******************************/
/* PAGE NOT FOUND (ERROR 404) */
/******************************/
function pageNotFound() {
    global $mosConfig_absolute_path;

    @ob_end_clean();
    @header('HTTP/1.0 404 Not Found');
    if (!defined('_ELXIS_SYSALERT')) { define('_ELXIS_SYSALERT', 5); }
	include($mosConfig_absolute_path.'/includes/systemplates/router.php');
	exit();
}

?>