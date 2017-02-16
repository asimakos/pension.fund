<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Module Sections
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Displays links to sections using blog output
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!function_exists('modSections')) {
    function modSections($params, $myallowed, $lang) {
        global $mainframe, $database, $Itemid;

        $count = intval( $params->get( 'count', 20 ) );
        $dispformat = $params->get( 'format', 'blog' );
        $noauth = !$mainframe->getCfg( 'shownoauth' );
        $tnow = time() + $mainframe->getCfg('offset') * 3600;

		$pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;

        if ($database->_resource->databaseType == 'mysql') { //speed up
            $qpd = "\n AND UNIX_TIMESTAMP(b.publish_up) <= '$tnow'"
            ."\n AND (b.publish_down = '2060-01-01 00:00:00' OR UNIX_TIMESTAMP(b.publish_down) >= '$tnow')";
        } else {
            $now = date( 'Y-m-d H:i:s', $tnow );
            $qpd =	"\n AND ( b.publish_up = '1979-12-19 00:00:00' OR b.publish_up <= '$now' )"
            . "\n AND ( b.publish_down = '2060-01-01 00:00:00' OR b.publish_down >= '$now' )";
        }

        $query = "SELECT a.id AS id, a.title AS title, a.seotitle, COUNT(b.id) as cnt"
        . "\n FROM #__sections a"
        . "\n LEFT JOIN #__content b ON a.id=b.sectionid"
        . ($noauth ? "\n AND b.access IN (".$myallowed.")" : "" )
        .$qpd
        . "\n WHERE a.scope='content'"
        . "\n AND a.published='1'"
        . "\n AND ((a.language LIKE '%$lang%') OR (a.language IS NULL))"
        . ($noauth ? "\n AND a.access IN (".$myallowed.")" : "" )
        . ($pg ? "\n GROUP BY a.id, a.title, a.seotitle, a.ordering" : "\n GROUP BY a.id" )
        . "\n HAVING COUNT(b.id)>0"
        . "\n ORDER BY a.ordering";
        $database->setQuery( $query, '#__', $count, 0 );
        $rows = $database->loadObjectList();

        if ($rows) {
            if ($mainframe->getCfg('sef') != 2) {
                $bs = $mainframe->getBlogSectionCount();
                $bc = $mainframe->getBlogCategoryCount();
                $gbs = $mainframe->getGlobalBlogSectionCount();
            }
            echo '<ul>'._LEND;
            foreach ($rows as $row) {
                $_Itemid = $Itemid;
                if ($mainframe->getCfg('sef') != 2) {
                    $_Itemid = $mainframe->getItemid( $row->id, 0, 0, $bs, $bc, $gbs );
                }
                $seolink = ($dispformat == 'table') ? $row->seotitle.'/' : 'blog/'.$row->seotitle.'/';
                $task = ($dispformat == 'table') ? 'section' : 'blogsection';
                echo '<li><a href="'.sefRelToAbs('index.php?option=com_content&task='.$task.'&id='.$row->id.'&Itemid='.$_Itemid, $seolink).'" title="'.$row->title.'">'.$row->title.'</a></li>'._LEND;
            }
            echo '</ul>'._LEND;
        }
    }
}

global $lang, $my;
$cache =& mosCache::getCache('com_content');
$cache->call('modSections', $params, $my->allowed, $lang);

?>