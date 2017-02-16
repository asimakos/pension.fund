<?php 
/** 
* @version: $Id: newsfeeds.php 2577 2010-01-11 21:05:13Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component NewsFeeds
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (($mosConfig_access == '1') | ($mosConfig_access == '3')) {
	//if is a guest find public frontend group name
	if ( $my->usertype == '' ) { 
		$usertype = eUTF::utf8_strtolower($acl->get_group_name('29'));
	} else {
		$usertype = eUTF::utf8_strtolower($my->usertype);
	}
	// ensure user is allowed to view this component
	if (!($acl->acl_check( 'action', 'view', 'users', $usertype, 'components', 'all' ) || 
		$acl->acl_check( 'action', 'view', 'users', $usertype, 'components', 'com_newsfeeds' ))) {
		mosRedirect( 'index.php', _NOT_AUTH );
	}
}

require_once( $mainframe->getPath( 'front_html' ) );

$feedid = intval( mosGetParam( $_REQUEST ,'feedid', 0 ) );
$catid = intval( mosGetParam( $_REQUEST ,'catid', 0 ) );

switch( $task ) {
	case 'view':
		showFeed( $feedid );
	break;
	default:
		listFeeds( $catid );
	break;
}


/*********************/
/* LIST FEED SOURCES */
/*********************/
function listFeeds( $catid ) {
	global $mainframe, $database, $my, $Itemid, $lang;
//$database->_resource->debug = true;
    //get all categories
	$query = "SELECT c.*, c.id AS catid FROM #__categories c WHERE c.published='1' AND c.section='com_newsfeeds'"
    ."\n AND ((c.language IS NULL) OR (c.language LIKE '%".$lang."%'))"
    ."\n AND c.access IN (".$my->allowed.")"
	."\n ORDER BY c.ordering";
	$database->setQuery( $query );
	$categories = $database->loadObjectList();

    //count newsfeeds and validate catid (current category)
    $catid_i = -1;
    $count = count( $categories );
    for ($i=0; $i<$count; $i++) {
        $category = &$categories[$i];

        if ($category->id == $catid) { $catid_i = $i; }
        $database->setQuery("SELECT COUNT(id) FROM #__newsfeeds WHERE published='1' AND catid='$category->id'");
        $category->numlinks = intval($database->loadResult());
    }

    if ($catid_i < 0) { $catid = 0; } //reset invalid category

	//try to fix wrong Itemid
	if ($catid) {
    	$query = "SELECT id FROM #__menu"
    	."\n WHERE link='index.php?option=com_newsfeeds&catid=".$catid."' AND published='1'"
		."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
    	."\n AND access IN (".$my->allowed.")";
    	$database->setQuery($query, '#__', 1, 0);
    	$_Itemid = intval($database->loadResult());
    	if ($_Itemid && ($_Itemid != $Itemid)) { $Itemid = $_Itemid; $GLOBALS['Itemid'] = $_Itemid; }
	} else {
    	$query = "SELECT id FROM #__menu"
    	."\n WHERE link='index.php?option=com_newsfeeds' AND published='1'"
		."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
    	."\n AND access IN (".$my->allowed.")";
    	$database->setQuery($query, '#__', 1, 0);
    	$_Itemid = intval($database->loadResult());
    	if ($_Itemid && ($Itemid != $_Itemid)) { $Itemid = $_Itemid; $GLOBALS['Itemid'] = $_Itemid; }
	}

	if ( $catid ) {
		//url links info for category
		$query = "SELECT * FROM #__newsfeeds WHERE catid = '".$catid."' AND published='1' ORDER BY ordering";
		$database->setQuery( $query );
		$rows = $database->loadObjectList();

		$currentcat = $categories[$catid_i]; //current category info
	} else {
		$rows = array();
		$currentcat = new stdClass();
	}

	// Parameters
	$menu = new mosMenu( $database );
	$menu->load( $Itemid );
	$params = new mosParameters( $menu->params );

	$params->def( 'page_title', 1 );
	$params->def( 'header', $menu->name );
	$params->def( 'pageclass_sfx', '' );
	$params->def( 'headings', 1 );
	$params->def( 'back_button', $mainframe->getCfg( 'back_button' ) );
	$params->def( 'description_text', '' );
	$params->def( 'image', -1 );
	$params->def( 'image_align', 'right' );
	$params->def( 'other_cat_section', 1 );
	//Category List Display control
	$params->def( 'other_cat', 1 );
	$params->def( 'cat_description', 1 );
	$params->def( 'cat_items', 1 );
	//Table Display control
	$params->def( 'headings', 1 );
	$params->def( 'name', 1 );
	$params->def( 'articles', '1' );
	$params->def( 'link', '1' );

	if ( $catid ) {
		$params->set( 'type', 'category' );
	} else {
		$params->set( 'type', 'section' );
	}

	//page description
	$currentcat->descrip = '';
	if (isset($currentcat->description) && ($currentcat->description <> '')) {
		$currentcat->descrip = $currentcat->description;
	} else if ( !$catid ) {
		//show description
		if ( $params->get( 'description' ) ) {
			$currentcat->descrip = $params->get( 'description_text' );
		}
	}

	//page image
	$currentcat->img = '';
	$path = $mainframe->getCfg('live_site').'/images/stories/';
	if (isset($currentcat->image) && ($currentcat->image <> '')) {
		$currentcat->img = $path.$currentcat->image;
		$currentcat->align = $currentcat->image_position;
	} else if ( !$catid ) {
		if ( $params->get( 'image' ) <> -1 ) {
			$currentcat->img = $path.$params->get( 'image' );
			$currentcat->align = $params->get( 'image_align' );
		}
	}

	//page header
	$currentcat->header = '';
	if (isset($currentcat->name) && ($currentcat->name <> '')) {
		$currentcat->header = $currentcat->name;
	} else {
		$currentcat->header = (trim($params->get('header')) != '') ? $params->get('header') : $menu->name;
	}

    $metaKeys = array('feeds', 'rss', 'xml');
    $metaDesc = $currentcat->header;
    if ($rows) {
    	foreach ($rows as $row) {
    		$metaDesc .= ', '.$row->name;
    		$metaKeys[] = $row->name;
    	}
    }
    $metaDesc .= ', '.$mainframe->getCfg('sitename');

    $mainframe->setPageTitle($currentcat->header);
    $mainframe->setMetaTag('description', $metaDesc);
    $mainframe->setMetaTag('keywords', implode(', ',$metaKeys));

	HTML_newsfeed::displaylist( $categories, $rows, $catid, $currentcat, $params );
}


/***************************/
/* PREPARE TO DISPLAY FEED */
/***************************/
function showFeed($feedid) {
	global $database, $mainframe, $Itemid, $my;

	require_once($mainframe->getCfg('absolute_path').'/includes/simplepie/simplepie.php');
	require_once($mainframe->getCfg('absolute_path').'/includes/simplepie/idn/idna_convert.class.php');
	
	//Adds parameter handling
	$menu = new mosMenu($database);
	$menu->load($Itemid);
	$params = new mosParameters($menu->params);
	$params->def('page_title', 1);
	$params->def('header', $menu->name);
	$params->def('pageclass_sfx', '');
	$params->def('back_button', $mainframe->getCfg('back_button'));
	//Feed Display control
	$params->def('feed_image', 1);
	$params->def('feed_descr', 1);
	$params->def('item_descr', 1);
	$params->def('word_count', 0); //deprecated
	//2009.0
	$params->def('subscribe_links', 1);
	$params->def('share_links', 1);

	if (!$params->get('page_title')) { $params->set('header', ''); }

	$and = ($feedid) ? "\n AND f.id='".$feedid."'" : '';
	$query = "SELECT f.name, f.link, f.numarticles, f.cache_time, c.title FROM #__newsfeeds f"
	."\n LEFT JOIN #__categories c ON c.id = f.catid"
	."\n WHERE f.published='1' AND f.checked_out='0'"
    ."\n AND c.published='1' AND c.section='com_newsfeeds' AND c.access IN (".$my->allowed.")"
	.$and
	."\n ORDER BY f.ordering";
	$database->setQuery( $query );
	$newsfeeds = $database->loadObjectList();

	$pathname = '';
    if ($feedid && $newsfeeds) {
        $metaTitle = $newsfeeds[0]->name;
        $pathname = $newsfeeds[0]->name;
        if ($params->get('header')) { $metaTitle .= ' - '.$params->get('header'); }
    } else if ($newsfeeds) {
        $metaTitle = $newsfeeds[0]->title;
        if ($params->get('header')) { $metaTitle .= ' - '.$params->get('header'); }
    } else {
	    $metaTitle = $menu->name;
	}

	$metaKeys = array();
    $keys = explode(' ', $metaTitle);
    if ($keys) {
    	foreach ($keys as $key) {
    		if (eUTF::utf8_strlen($key) > 3) { $metaKeys[] = $key; }
    	}
    }
    array_push($metaKeys, _E_NEWS, 'rss feeds', 'xml feeds', 'delicious', 'blinklist', 'technorati');
    $metaKeys = array_unique($metaKeys);

    $mainframe->setPageTitle($metaTitle);
    $mainframe->setMetaTag('description', $metaTitle.', '.$mainframe->getCfg('sitename'));
    $mainframe->setMetaTag('keywords', implode(', ',$metaKeys));

	$spbaseURL = $mainframe->getCfg('ssl_live_site').'/includes/simplepie/';

	$mainframe->addCustomHeadTag('<link href="'.$spbaseURL.'extra/spelxis.css" rel="stylesheet" type="text/css" media="all" />');
	$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.$spbaseURL.'extra/spelxis.js" charset="utf-8"></script>');
	//$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.$spbaseURL.'extra/sleight.js"></script>');
	//$mainframe->addCustomHeadTag('<link href="'.$spbaseURL.'extra/sIFR-screen.css" rel="stylesheet" type="text/css" media="screen" />');
	//$mainframe->addCustomHeadTag('<link href="'.$spbaseURL.'extra/sIFR-print.css" rel="stylesheet" type="text/css" media="print" />');
	//$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.$spbaseURL.'extra/sifr-config.js"></script>');
	//$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.$spbaseURL.'extra/sifr.js"></script>');

	if ($pathname != '') { $mainframe->appendPathWay(' : '.$pathname); }
	unset($pathname, $spbaseURL, $metaKeys, $metaTitle);

	HTML_newsfeed::showNewsfeeds($newsfeeds, $params);
}

?>