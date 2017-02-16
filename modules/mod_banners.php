<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Module Banners
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Module support appearence of multiple banners
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$clientids = $params->get( 'banner_cids', '' );
$numshow = intval($params->get( 'numshow', '1' ));
$mbUnique = intval($params->get( 'mbUnique', '0' ));
$numperrow = intval($params->get( 'numperrow', '0' ));
$moduleclass_sfx = $params->get( 'moduleclass_sfx' );
$numshow = ($numshow < 1) ? 1 : $numshow;

$cookString = '';
$where4 = '';
if( $mbUnique == 1 ) {
	if( !isset($_COOKIE['mb_tracker'])) {	
		@setcookie( 'mb_tracker', '0');
	} else {
        $ck = @urldecode($_COOKIE['mb_tracker']);
        if (preg_match("/^[0-9\,]+$/", $ck)) {
            $varr = array();
            $carrs = explode(',',$ck);
            foreach ($carrs as $carr) {
                if (intval($carr) >= 0) { array_push($varr, $carr); }
            }
            if (count($varr) > 0) {
                $cookString = implode(',',$varr);
                $where4 = "\n AND bid NOT IN(". $cookString. ")";
		    }
		}
	}
}

$banner = null;
$where = ( $clientids != '' )  ? "\n AND cid IN ($clientids)" : '';

$query = "SELECT COUNT(*) FROM #__banner WHERE showbanner = '1'"
. $where
. $where4;
$database->setQuery( $query );
$numrows = $database->loadResult();

$query = "SELECT * FROM #__banner WHERE showbanner = '1'"
. $where
. $where4
."\n ORDER BY ".$database->_resource->random;
$database->setQuery( $query, '#__', $numshow, 0 );

if( $numrows < $numshow ) {
	$reset = 1;
	$numleft = $numshow - $numrows;
	$activerows = '0';

	foreach( $database->loadObjectlist() as $loopitem ) {
		$activerows .= ','.$loopitem->bid;
	}
		
	$where2 = "\n AND bid NOT IN (". $activerows .")";

	$query = "SELECT * FROM #__banner WHERE showbanner = '1'"
	. $where
	. $where2
	."\n ORDER BY ".$database->_resource->random;
	$database->setQuery( $query, '#__', $numleft, 0 );
	
	foreach( $database->loadObjectlist() as $loopitem ) {
		$activerows .= ','.$loopitem->bid;
	}
	
	$where3 = "\n AND bid IN (". $activerows .")";
	
	$query = "SELECT * FROM #__banner WHERE showbanner = '1'"
	. $where
	. $where3
	."\n ORDER BY ".$database->_resource->random;
	$database->setQuery( $query );
}

if( $mbUnique == 1 ) {
	if( $reset != 1 ) {
		$blist = $cookString;
	}
}

if( $numperrow != '0' ) {
	$rowcount = '0';
	echo '<table width="100%" border="0" cellspacing="0" cellpadding="0">'._LEND;
}

if(!isset($rowcount)) { $rowcount='0'; }

foreach ($database->loadObjectlist() as $banner) {
	if (( $numperrow > 0) && ($rowcount == '0' || $rowcount == $numperrow )) {
		echo '<tr>'._LEND;
		$rowcount = '0';
	} else if ($rowcount == '0' || $rowcount == $numperrow ) {
		$rowcount = '0';
	}
	
	if( $numperrow > 0 ) { echo '<td align="center">'._LEND; }

	if( $mbUnique == 1 ) {
		$blist .= ','.$banner->bid;
	}

	$database->setQuery("UPDATE #__banner SET impmade = impmade + 1 WHERE bid = '$banner->bid'");
	$database->query();
	$banner->impmade++;

	// Check if this impression is the last one and print the banner
	if (($banner->imptotal > 0) && ($banner->impmade >= $banner->imptotal)) {
        $database->setQuery("UPDATE #__banner SET showbanner='0' WHERE bid='$banner->bid'");
		$database->query();
	}

	if (trim($banner->custombannercode) != '') {
		echo $banner->custombannercode;
	} else if (preg_match('/(\.bmp|\.gif|\.jpg|\.jpeg|\.png)$/i', $banner->imageurl)) {
		$imageurl = $mainframe->getCfg('ssl_live_site').'/images/banners/'. $banner->imageurl;
		$link = sefRelToAbs( 'index.php?option=com_banners&task=click&bid='.$banner->bid, 'banners/'.$banner->bid.'.html' );
		if( $banner->targetbanner==1 ) {
            $targetbanner='_blank';
        } else {
            $targetbanner='_self';
        }
    	echo '<a href="'.$link.'" target="'.$targetbanner.'" title="'.$banner->name.'"><img src="'.$imageurl.'" border="0" alt="'.$banner->name.'" /></a>'._LEND;
	} else if (preg_match('/(\.swf)$/i', $banner->imageurl)) {
		$imageurl = $mainframe->getCfg('ssl_live_site').'/images/banners/'.$banner->imageurl;
		echo '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" border="5">'._LEND;
		echo '<param name="movie" value="'.$imageurl.'">'._LEND;
        echo '<embed src="'.$imageurl.'" loop="false" pluginspage="http://www.macromedia.com/go/get/flashplayer" type="application/x-shockwave-flash"></embed>'._LEND;
        echo '</object>'._LEND;
	}
	if( $numperrow != '0' ) {
		echo '</td>'._LEND;
		$rowcount++;
	}
	if (($numperrow > 0) && ($rowcount == $numperrow)) {
		echo '</tr>'._LEND;
	}
}

if( $numperrow > 0 ) {
	echo '</tr>'._LEND;
	echo '</table>'._LEND;
}

if( $mbUnique == 1 ) {
	if( $blist{0} != '0') { $zero = '0'; }
	@setcookie( 'mb_tracker', $zero.$blist );
}

?>
