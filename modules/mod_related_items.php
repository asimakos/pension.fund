<?php 
/**
* @ Version: $Id: mod_related_items.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Module Related Items
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $option, $task, $my, $lang, $mosConfig_offset, $mosConfig_sef, $Itemid, $mainframe;

$id = intval( mosGetParam( $_REQUEST, 'id', 0 ) );

if ($option == 'com_content' && $task == 'view' && $id) {
	$database->setQuery("SELECT metakey FROM #__content WHERE id='$id'", '#__', 1, 0);
	if ($metakey = eUTF::utf8_trim($database->loadResult())) {
		$keys = explode(',', $metakey);
		$likes = array();
		foreach ($keys as $key) {
			$key = eUTF::utf8_trim( $key );
			if ($key) {
				$likes[] = $database->getEscaped( $key );
			}
		}

		if (count( $likes )) {
            $now = date( 'Y-m-d H:i:s', time() + $mosConfig_offset * 3600 );
			$query = "SELECT a.id, a.title, a.seotitle, cc.seotitle AS seosec, cc.access AS catacc,"
            ."\n s.access AS secacc, s.seotitle AS seosec, cc.published AS catpub, s.published AS secpub"
			."\n FROM #__content a"
			."\n LEFT JOIN #__categories cc ON cc.id = a.catid"
			."\n LEFT JOIN #__sections s ON s.id = a.sectionid"
			. "\n WHERE a.id != '$id' AND a.state='1' AND a.access IN (".$my->allowed.")"
            . "\n AND ((a.language IS NULL) OR (a.language LIKE '%$lang%'))"
			. "\n AND ( a.metakey LIKE '%".implode( "%' OR a.metakey LIKE '%", $likes )."%')"
			. "\n AND ( a.publish_up = '1979-12-19 00:00:00' OR a.publish_up <= '$now' )"
			. "\n AND ( a.publish_down = '2060-01-01 00:00:00' OR a.publish_down >= '$now' )";
			$database->setQuery( $query );
			$xrows = $database->loadObjectList();

            $myaccess = explode(',',$my->allowed);
            $related = array();
            if ($xrows) {
                foreach ($xrows as $xrow ) {
                    if (($xrow->catpub == 1 || $xrow->catpub == '') &&  ($xrow->secpub == 1 || $xrow->secpub == '') && (in_array($xrow->catacc, $myaccess) || ($xrow->catacc == '')) && (in_array($xrow->secacc, $myaccess) || ($xrow->secacc == ''))) {
					   $related[] = $xrow;
				    }
                }
            }
            unset($xrows);

			if (count($related)) {
				echo '<ul>'._LEND;
				foreach ($related as $item) {
				    $_Itemid = $Itemid;
				    $seolink = '';
					if ($mosConfig_sef == 2) {
                        if (($item->seosec != '') && ($item->seocat != '') && ($item->seotitle != '')) {
                            $seolink = $item->seosec.'/'.$item->seocat.'/'.$item->seotitle.'.html';
                        } else if ($row->seotitle != '') {
                            $seolink = $item->seotitle.'.html';
                        }
					} else {
                        $_Itemid = $mainframe->getItemid($item->id);
					}
					$link = sefRelToAbs('index.php?option=com_content&task=view&id='.$item->id.'&Itemid='.$Itemid, $seolink);
					echo '<li><a href="'.$link.'" title="'.$item->title.'">'.$item->title.'</a></li>'._LEND;
				}
				echo '</ul>'._LEND;
			}
		}
	}
}
?>