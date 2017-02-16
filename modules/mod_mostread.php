<?php 
/**
* @ Version: $Id: mod_mostread.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Module MostRead
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $mosConfig_offset, $mosConfig_live_site, $lang, $mosConfig_sef, $my;

$type = intval( $params->get( 'type', 1 ) );
$count = intval( $params->get( 'count', 5 ) );
$catid = trim( $params->get( 'catid' ) );
$secid = trim( $params->get( 'secid' ) );
$show_front	= $params->get( 'show_front', 1 );
$class_sfx = $params->get( 'moduleclass_sfx' );

$now = date( 'Y-m-d H:i:s', time()+$mosConfig_offset*60*60 );

$noauth = !$mainframe->getCfg( 'shownoauth' );

//select between Content Items, Autonomous pages or both
switch ( $type ) {
	case 2: //Autonomous pages
        $query = "SELECT a.id, a.title, a.seotitle FROM #__content a"
		. "\n WHERE a.state = '1' AND a.sectionid = '0'"
		. "\n AND ( a.publish_up = '1979-12-19 00:00:00' OR a.publish_up <= '". $now ."' )"
		. "\n AND ( a.publish_down = '2060-01-01 00:00:00' OR a.publish_down >= '". $now ."' )"
		. "\n AND ((a.language IS NULL) OR (a.language LIKE '%$lang%'))"
    	. ( $noauth ? "\n AND a.access IN (".$my->allowed.")" : '' )
		. "\n ORDER BY a.hits DESC";
		$database->setQuery( $query, '#__', $count, 0 );
		$rows = $database->loadObjectList();	
		break;
	case 3: //Both
		$query = "SELECT a.id, a.title, a.seotitle, a.sectionid, cc.seotitle AS seocat, cc.access AS catacc,"
		."\n cc.published AS catpub, s.seotitle AS seosec, s.access AS secacc, s.published AS secpub" 
		."\n FROM #__content a"
		."\n LEFT JOIN #__content_frontpage f ON f.content_id = a.id"
		."\n LEFT JOIN #__categories cc ON cc.id = a.catid"
		."\n LEFT JOIN #__sections s ON s.id = a.sectionid"
		."\n WHERE a.state = '1'"
		."\n AND ( a.publish_up = '1979-12-19 00:00:00' OR a.publish_up <= '". $now ."' )"
		."\n AND ( a.publish_down = '2060-01-01 00:00:00' OR a.publish_down >= '". $now ."' )"
		."\n AND ((a.language IS NULL) OR (a.language LIKE '%$lang%'))"
		."\n AND ((cc.language IS NULL) OR (cc.language LIKE '%$lang%'))"
		."\n AND ((s.language IS NULL) OR (s.language LIKE '%$lang%'))"
    	.( $noauth ? "\n AND a.access IN (".$my->allowed.")" : '' )
		.( $catid ? "\n AND ( a.catid IN ( $catid ) )" : '' )
		.( $secid ? "\n AND ( a.sectionid IN ( $secid ) )" : '' )
		.( $show_front == '0' ? "\n AND f.content_id IS NULL" : '' )
		."\n ORDER BY a.hits DESC";
		$database->setQuery( $query, '#__', $count, 0 );
		$xrows = $database->loadObjectList();

        $myaccess = explode(',',$my->allowed);
		$rows = array();
		if ($xrows) {
            foreach ($xrows as $xrow ) {
                if (($xrow->catpub == 1 || $xrow->catpub == '') &&  ($xrow->secpub == 1 || $xrow->secpub == '') && (in_array($xrow->catacc, $myaccess) || ($xrow->catacc == '') || !$noauth) && (in_array($xrow->secacc, $myaccess) || ($xrow->secacc == '') || !$noauth)) {
					$rows[] = $xrow;
				}
			}
		}
		unset($xrows);
		break;
	case 1: //Content Items only
	default:
		$query = "SELECT a.id, a.title, a.seotitle, a.sectionid, a.catid, cc.seotitle AS seocat, s.seotitle AS seosec"
		."\n FROM #__content a"
		."\n LEFT JOIN #__content_frontpage f ON f.content_id = a.id"
		."\n INNER JOIN #__categories cc ON cc.id = a.catid"
		."\n INNER JOIN #__sections s ON s.id = a.sectionid"
		."\n WHERE a.state = '1' AND a.sectionid > '0'"
		."\n AND ( a.publish_up = '1979-12-19 00:00:00' OR a.publish_up <= '". $now ."' )"
		."\n AND ( a.publish_down = '2060-01-01 00:00:00' OR a.publish_down >= '". $now ."' )"
		."\n AND ((a.language IS NULL) OR (a.language LIKE '%$lang%'))"
		."\n AND ((cc.language IS NULL) OR (cc.language LIKE '%$lang%'))"
		."\n AND ((s.language IS NULL) OR (s.language LIKE '%$lang%'))"
    	.( $noauth ? "\n AND a.access IN (".$my->allowed.")" : '' )
    	.( $noauth ? "\n AND cc.access IN (".$my->allowed.")" : '' )
    	.( $noauth ? "\n AND s.access IN (".$my->allowed.")" : '' )
		.( $catid ? "\n AND ( a.catid IN (". $catid .") )" : '' )
		.( $secid ? "\n AND ( a.sectionid IN (". $secid .") )" : '' )
		.( $show_front == "0" ? "\n AND f.content_id IS NULL" : '' )
		."\n AND cc.published = '1'"
		."\n AND s.published = '1'"
		."\n ORDER BY a.hits DESC";
		$database->setQuery( $query, '#__', $count, 0 );
		$rows = $database->loadObjectList();
		break;
}


if ($rows) {
    if ($mosConfig_sef != 2) {
        //needed to reduce queries used by getItemid for Content Items
        if ( ( $type == 1 ) || ( $type == 3 ) ) {
    	   $bs = $mainframe->getBlogSectionCount();
    	   $bc = $mainframe->getBlogCategoryCount();
    	   $gbs = $mainframe->getGlobalBlogSectionCount();
        }
    }

    echo '<ul class="mostread'.$class_sfx.'">'._LEND;
	foreach ( $rows as $row ) {
        $_Itemid = 0;
        $seolink = '';
        //get Itemid
		switch ( $type ) {
		case 2:
            if ($mosConfig_sef != 2) {
                $query = "SELECT id FROM #__menu WHERE type = 'content_typed' AND componentid = '".$row->id."'";
                $database->setQuery( $query, '#__', 1, 0 );
                $_Itemid = intval($database->loadResult());
            }
			$seolink = $row->seotitle.'.html';
			break;
		case 3:
            if ($mosConfig_sef != 2) {
                if ( $row->sectionid ) {
                    $_Itemid = $mainframe->getItemid( $row->id, 0, 0, $bs, $bc, $gbs );
                } else {
                    $query = "SELECT id FROM #__menu WHERE type = 'content_typed' AND componentid = '".$row->id."'";
                    $database->setQuery( $query, '#__', 1, 0 );
                    $_Itemid = intval($database->loadResult());
                }
			}
			if ( $row->sectionid ) {
                $seolink = $row->seosec.'/'.$row->seocat.'/'.$row->seotitle.'.html';
            } else {
                $seolink = $row->seotitle.'.html';
            }
			break;
		case 1:
		default:
            if ($mosConfig_sef != 2) {
                $_Itemid = $mainframe->getItemid( $row->id, 0, 0, $bs, $bc, $gbs );
			}
			$seolink = $row->seosec.'/'.$row->seocat.'/'.$row->seotitle.'.html';
			break;
		}

		//Blank itemid checker for SEF
		if (!$_Itemid) {
			$xItemid = '';
		} else {
			$xItemid = '&Itemid='.$_Itemid;
		}

		$link = sefRelToAbs('index.php?option=com_content&task=view&id='.$row->id.$xItemid, $seolink);
		?>
		<li class="latestnews<?php echo $class_sfx; ?>">
			<a href="<?php echo $link; ?>" class="mostread<?php echo $class_sfx; ?>" title="<?php echo $row->title; ?>"><?php echo $row->title; ?></a>
		</li>
<?php 
	}
    echo '</ul>'._LEND;
}

?>