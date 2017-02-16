<?php 
/**
* @version: $Id: banners.php 2577 2010-01-11 21:05:13Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Banners
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @note (Ioannis Sannos): No access control for this component
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$bid = intval( mosGetParam( $_REQUEST, 'bid', 0 ) );
$task	= mosGetParam( $_REQUEST, "task", '' );
switch($task) {
	case 'click':
	clickbanner( $bid );
	break;
	default:
	viewbanner();
	break;
}


/********************/
/* DISPLAY A BANNER */
/********************/
function viewbanner() {
	global $database, $mainframe;

	$database->setQuery( "SELECT COUNT(*) FROM #__banner WHERE showbanner=1" );
	$numrows = intval($database->loadResult());
	if (!$numrows) { return; }

	if ($numrows > 1) {
		mt_srand( (double) microtime()*1000000 );
		$bannum = mt_rand( 0, --$numrows );
	} else {
		$bannum = 0;
	}

	$database->setQuery( "SELECT * FROM #__banner WHERE showbanner=1", '#__', $bannum, 0 );

	$banner = null;
	if ($database->loadObject( $banner )) {
		$database->setQuery( "UPDATE #__banner SET impmade=impmade+1 WHERE bid='$banner->bid'" );
		if (!$database->query()) { return; }
		$banner->impmade++;

		if ($numrows > 0) {
			// Check if this impression is the last one and print the banner
			if ($banner->imptotal == $banner->impmade) {
                $query = "UPDATE #__banner SET showbanner='0' WHERE bid='$banner->bid'";
				$database->setQuery($query);
				if (!$database->query()) { return; }
			}

			if (trim( $banner->custombannercode )) {
				echo $banner->custombannercode;
			} else if (preg_match('/(\.bmp|\.gif|\.jpg|\.jpeg|\.png)$/i', $banner->imageurl)) {
				$imageurl = $mainframe->getCfg('ssl_live_site').'/images/banners/'.$banner->imageurl;

		        if( $banner->targetbanner==1 ) {
                    $targetbanner = '_blank';
                } else {
                    $targetbanner = '_top';
                }
				echo '<a href="'.sefRelToAbs('index.php?option=com_banners&task=click&bid='.$banner->bid, 'banners/'.$banner->bid.'.html').'" target="'.$targetbanner.'" title="'.$banner->name.'">';
                echo '<img src="'.$imageurl.'" border="0" alt="'.$banner->name.'" /></a>'._LEND;
			} else if (preg_match('/(\.swf)$/i', $banner->imageurl)) {
				$imageurl = $mainframe->getCfg('live_site').'/images/banners/'.$banner->imageurl;
                echo '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" border="2" id="flashbanner" align="middle">'._LEND;
                echo '<param name="allowScriptAccess" value="sameDomain" />'._LEND;
                echo '<param name="allowFullScreen" value="false" />'._LEND;
                echo '<param name="movie" value="'.$imageurl.'" />'._LEND;
                echo '<param name="quality" value="high" />'._LEND;
                echo '<embed src="'.$imageurl.'" quality="high" name="flashbanner" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />'._LEND;
                echo '</object>'._LEND;
			}
		}
	}
}


/**********************************/
/* REDIRECT CLICKS TO CORRECT URL */
/**********************************/
function clickbanner( $bid  ) {
	global $database, $mainframe;

	require_once($mainframe->getPath('class'));
	$row = new mosBanner($database);
	$row->load($bid);
	if ($row->clickurl == '') { pageNotFound(); }
	$row->clicks();

	if (!preg_match('/^(http)/i', $row->clickurl )) {
		$clickurl = 'http://'.$row->clickurl;
	} else {
		$clickurl = $row->clickurl;
	}
	mosRedirect( $clickurl );
} 
?>