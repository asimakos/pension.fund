<?php 
/**
* @ Version: $Id: mod_newsflash.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Module NewsFlash
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


require_once( $mainframe->getPath( 'front_html', 'com_content') );

global $my, $mosConfig_shownoauth, $mosConfig_offset, $acl, $lang;

//Disable edit ability icon
$access = new stdClass();
$access->canAdd = 0;
$access->canEdit = 0;
$access->canEditOwn = 0;
$access->canPublish = 0;
$access->gid = $my->gid; //trick to fix cache

$now = date( 'Y-m-d H:i:s', time() + ($mosConfig_offset * 3600) );

$catid = intval( $params->get( 'catid' ) );
$style = $params->get( 'style', 'flash' );
$image = $params->get( 'image' );
$readmore = $params->get( 'readmore' );
$items = intval($params->get( 'items', 1));
if (!$items) { $items = 1; }
$moduleclass_sfx = $params->get( 'moduleclass_sfx' );
$params->set( 'intro_only', 1 );
$params->set( 'hide_author', 1 );
$params->set( 'hide_createdate', 1 );
$params->set( 'hide_modifydate', 1 );

$noauth = !$mainframe->getCfg( 'shownoauth' );

if (($style == 'flash') || ($style == 'random') || ($style == '')) {
	$randfunc = $database->_resource->random;
	$orderby = "\n ORDER BY ".$randfunc;
	$items = 1;
} else {
	$orderby = "\n ORDER BY a.ordering";
}
$query = "SELECT a.id, a.introtext, a.maintext, a.images, a.attribs, a.title, a.seotitle,"
."\n a.state, cc.seotitle AS catseotitle, s.seotitle AS secseotitle"
."\n FROM #__content a"
."\n INNER JOIN #__categories cc ON cc.id = a.catid"
."\n INNER JOIN #__sections s ON s.id = a.sectionid"
."\n WHERE a.state = '1'"
. ( $noauth ? "\n AND a.access IN (".$my->allowed.") AND cc.access IN (".$my->allowed.") AND s.access IN (".$my->allowed.")" : '' )
."\n AND (a.publish_up = '1979-12-19 00:00:00' OR a.publish_up <= '". $now ."') "
."\n AND (a.publish_down = '2060-01-01 00:00:00' OR a.publish_down >= '". $now ."')"
."\n AND ((a.language IS NULL) OR (a.language LIKE '%$lang%'))"
."\n AND ((cc.language IS NULL) OR (cc.language LIKE '%$lang%'))"
."\n AND ((s.language IS NULL) OR (s.language LIKE '%$lang%'))"
."\n AND a.catid='$catid'"
."\n AND cc.published = '1'"
."\n AND s.published = '1'"
.$orderby;
$database->setQuery( $query, '#__', $items, 0 );
$rows = $database->loadObjectList();
$numrows = count( $rows );

if ($numrows) {
    switch ($style) {
        case 'horiz':
            echo '<table class="moduletable'.$moduleclass_sfx.'">'._LEND;
            echo '<tr>'._LEND;
            foreach ($rows as $row) {
                $row->text = $row->introtext;
                $row->groups = '';
                $row->readmore = (trim($row->maintext) == '') ? $readmore : 0;
                $row->metadesc 	= '';
                $row->metakey 	= '';
                $row->access 	= '29';
                $row->created 	= '';
                $row->modified 	= '';
                echo '<td>'._LEND;
                HTML_content::show( $row, $params, $access, 0, 'com_content' );
                echo '</td>'._LEND;
            }
            echo '</tr>'._LEND.'</table>'._LEND;
        break;
        case 'vert':
            foreach ($rows as $row) {
                $row->text = $row->introtext;
                $row->groups = '';
                $row->readmore = (trim($row->maintext) == '') ? $readmore : 0;
                $row->metadesc 	= '';
                $row->metakey 	= '';
                $row->access 	= '29';
                $row->created 	= '';
                $row->modified 	= '';
                HTML_content::show( $row, $params, $access, 0, 'com_content' );
            }
        break;
        case 'flash':
        case 'random':
        default:
            $row = $rows[0];
            $row->text = $row->introtext;
            $row->groups = '';
            $row->readmore = (trim($row->maintext) == '') ? $readmore : 0;
            $row->metadesc 	= '';
            $row->metakey 	= '';
            $row->access 	= '29';
            $row->created 	= '';
            $row->modified 	= '';
            HTML_content::show( $row, $params, $access, 0, 'com_content' );
        break;
    }
}

?>