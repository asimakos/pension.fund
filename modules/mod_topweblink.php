<?php 
/**
* @ Version: $Id: mod_topweblink.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Module Top Weblink
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!function_exists('mod_topweblinks')) {
	function mod_topweblinks($method=0, $filtercat=1, $modscreen=1, $moddesc=0, $moddate=1) {
        global $my, $database, $lang, $option, $mosConfig_offset, $mosConfig_absolute_path;

		if (file_exists($mosConfig_absolute_path.'/modules/mod_topweblink/'.$lang.'.php')) {
			require_once ($mosConfig_absolute_path.'/modules/mod_topweblink/'.$lang.'.php');
		} else {
			require_once($mosConfig_absolute_path.'/modules/mod_topweblink/english.php');
		}

		if ($option != 'com_weblinks') {
			$filtercat = 0; $catid = 0;
		} else {
			$catid = intval( mosGetParam($_REQUEST, 'catid', 0));
			if (!$catid) { $filtercat = 0; }
		}

		if ($method == 0) { //all time - hits
			$query = "SELECT a.*, c.seotitle FROM #__weblinks a"
			."\n LEFT JOIN #__categories c ON c.id = a.catid"
			."\n WHERE a.published = '1' AND a.approved = '1'"
			."\n AND ((a.language IS NULL) OR (a.language LIKE '%$lang%'))";
			if ($filtercat) {
				$query .= "\n AND a.catid = '".$catid."'";
			}
			$query .= "\n AND c.published = '1'"
			."\n AND c.access IN (".$my->allowed.")"
			."\n AND ((c.language IS NULL) OR (c.language LIKE '%$lang%'))"
			."\n ORDER BY a.hits DESC";
			$database->setQuery($query, '#__', 1, 0);
			$database->loadObject($row);
		}

		if ($method == 1) { //all time - hits/day
			$query = "SELECT a.id, a.hits, a.date FROM #__weblinks a"
			."\n LEFT JOIN #__categories c ON c.id = a.catid"
			."\n WHERE a.published = '1' AND a.approved = '1'"
			."\n AND ((a.language IS NULL) OR (a.language LIKE '%$lang%'))";
			if ($filtercat) {
				$query .= "\n AND a.catid = '".$catid."'";
			}
			$query .= "\n AND c.published = '1'"
			."\n AND c.access IN (".$my->allowed.")"
			."\n AND ((c.language IS NULL) OR (c.language LIKE '%$lang%'))";
			$database->setQuery($query);
			$rows = $database->loadObjectList();

			$id = 0;
			$pc = 0;
			if ($rows) {
				$now = time() + ($mosConfig_offset * 3600);
				foreach ($rows as $xrow) {	
					$k = ($xrow->hits * 86400)/($now - strtotime($xrow->date));
					if ($k > $pc) { $pc = $k; $id = $xrow->id; }
				}
			}
			$pc = round($pc, 2);
			$row = null;
			if ($id) {
				$query = "SELECT a.*, c.seotitle FROM #__weblinks a"
				."\n LEFT JOIN #__categories c ON c.id = a.catid WHERE a.id = '".$id."'";
				$database->setQuery($query, '#__', 1, 0);
				$database->loadObject($row);
			}
		}

		if ($method == 2) { //last month - hits
			$pts = mktime(0, 0, 0, date('m')-1, 1, date('Y'));
			$pte = mktime(23, 59, 59, date('m')-1, date('t', $pts), date('Y'));
			$lmonthstart = date('Y-m-d H:i:s', $pts);
			$lmonthend = date('Y-m-d H:i:s', $pte);

			$query = "SELECT a.*, c.seotitle FROM #__weblinks a"
			."\n LEFT JOIN #__categories c ON c.id = a.catid"
			."\n WHERE a.published = '1' AND a.approved = '1'"
			."\n AND ((a.language IS NULL) OR (a.language LIKE '%$lang%'))";
			if ($filtercat) {
				$query .= "\n AND a.catid = '".$catid."'";
			}
			$query .= "\n AND c.published = '1'"
			."\n AND a.date > '".$lmonthstart."' AND a.date < '".$lmonthend."'"
			."\n AND c.access IN (".$my->allowed.")"
			."\n AND ((c.language IS NULL) OR (c.language LIKE '%$lang%'))"
			."\n ORDER BY a.hits DESC";
			$database->setQuery($query, '#__', 1, 0);
			$database->loadObject($row);
		}

		if ($method == 3) { //last month - hits/day
			$pts = mktime(0, 0, 0, date('m')-1, 1, date('Y'));
			$pte = mktime(23, 59, 59, date('m')-1, date('t', $pts), date('Y'));
			$lmonthstart = date('Y-m-d H:i:s', $pts);
			$lmonthend = date('Y-m-d H:i:s', $pte);

			$query = "SELECT a.id, a.hits, a.date FROM #__weblinks a"
			."\n LEFT JOIN #__categories c ON c.id = a.catid"
			."\n WHERE a.published = '1' AND a.approved = '1'"
			."\n AND ((a.language IS NULL) OR (a.language LIKE '%$lang%'))";
			if ($filtercat) {
				$query .= "\n AND a.catid = '".$catid."'";
			}
			$query .= "\n AND c.published = '1'"
			."\n AND a.date > '".$lmonthstart."' AND a.date < '".$lmonthend."'"
			."\n AND c.access IN (".$my->allowed.")"
			."\n AND ((c.language IS NULL) OR (c.language LIKE '%$lang%'))";
			$database->setQuery($query);
			$rows = $database->loadObjectList();

			$id = 0;
			$pc = 0;
			if ($rows) {
				$now = time() + ($mosConfig_offset * 3600);
				foreach ($rows as $xrow) {	
					$k = ($xrow->hits * 86400)/($now - strtotime($xrow->date));
					if ($k > $pc) { $pc = $k; $id = $xrow->id; }
				}
			}
			$pc = round($pc, 2);
			$row = null;
			if ($id) {
				$query = "SELECT a.*, c.seotitle FROM #__weblinks a"
				."\n LEFT JOIN #__categories c ON c.id = a.catid WHERE a.id = '".$id."'";
				$database->setQuery($query, '#__', 1, 0);
				$database->loadObject($row);
			}
		}

		if ($method == 4) { //latest added
			$query = "SELECT a.*, c.seotitle FROM #__weblinks a"
			."\n LEFT JOIN #__categories c ON c.id = a.catid"
			."\n WHERE a.published = '1' AND a.approved = '1'"
			."\n AND ((a.language IS NULL) OR (a.language LIKE '%$lang%'))";
			if ($filtercat) {
				$query .= "\n AND a.catid = '".$catid."'";
			}
			$query .= "\n AND c.published = '1'"
			."\n AND c.access IN (".$my->allowed.")"
			."\n AND ((c.language IS NULL) OR (c.language LIKE '%$lang%'))"
			."\n ORDER BY a.date DESC";
			$database->setQuery($query, '#__', 1, 0);
			$database->loadObject($row);
		}

		if ($row) {
			$link = sefRelToAbs( 'index.php?option=com_weblinks&task=view&catid='.$row->catid.'&id='.$row->id, 'links/'.$row->seotitle.'/'.$row->id.'.html');
			$linkStart = '<a href="'.$link.'" target="_blank" title="'.$row->title.'">';
			$linkEnd = '</a>';
			$img = (trim($row->screenshot) != '') ? $row->screenshot : 'ss_not_available.jpg';
			$align = (_GEM_RTL) ? 'right' : 'left';

			switch ($method) {
				case 0:
					$modtitle = CX_TOPWL_TOPLINK;
					$explanation = ($filtercat) ? CX_TOPWL_CATATH : CX_TOPWL_GLOATH;
				break;
				case 1:
					$modtitle = CX_TOPWL_TOPLINK;
					$explanation = ($filtercat) ? CX_TOPWL_CATATHD : CX_TOPWL_GLOATHD;
				break;
				case 2:
					$modtitle = CX_TOPWL_TOPLINK;
					$explanation = ($filtercat) ? CX_TOPWL_CATPMH : CX_TOPWL_GLOPMH;
				break;
				case 3:
					$modtitle = CX_TOPWL_TOPLINK;
					$explanation = ($filtercat) ? CX_TOPWL_CATPMHD : CX_TOPWL_GLOPMHD;
				break;
				case 4:
					$modtitle = CX_TOPWL_LATLINK;
					$explanation = ($filtercat) ? CX_TOPWL_CATLADD : CX_TOPWL_GLOLADD;
				break;
			}

			echo '<div id="topweblink">'._LEND;
			echo '<h3>'.$modtitle.'</h3>'._LEND;
			echo $explanation.'<br />'._LEND;

            if ($modscreen > 0) {
            	$tw = ($modscreen == 1) ? 60 : 120;
            	$th = ($modscreen == 1) ? 45 : 90;
				echo $linkStart;
				echo '<img src="images/screenshots/'.$img.'" align="'.$align.'" width="'.$tw.'" height="'.$th.'" alt="'.$row->title.'" title="'.$row->title.'" />';
				echo $linkEnd._LEND;
			}

			echo $linkStart.$row->title.$linkEnd.'<br />'._LEND;
			if ($moddesc) {
				echo '<span id="topweblink-desc">'.$row->description.'</span><br />'._LEND;
			}
			echo '<span id="topweblink-hits">'._E_HITS.': ';
			echo (($method == 1) || ($method == 3)) ? $pc.' / '.CX_TOPWL_DAY : $row->hits;
			echo '</span>'._LEND;
			if ($moddate) {
				echo '<br />'._LEND;
				echo '<span id="topweblink-date" title="'._LAST_UPDATED.'">'.mosFormatDate($row->date).'</span>'._LEND;
			}	
			echo '<div class="clear"></div>'._LEND;
			echo '</div>'._LEND;
		}
    }
}

$method = intval($params->get( 'method', 0 ));
$filtercat = intval($params->get( 'filtercat', 1 ));
$modscreen = intval($params->get( 'modscreen', 1 ));
$moddesc = intval($params->get( 'moddesc', 0 ));
$moddate = intval($params->get( 'moddate', 1 ));

mod_topweblinks($method, $filtercat, $modscreen, $moddesc, $moddate);

?>