<?php 
/** 
* @version: $Id: error404.php 39 2010-06-07 18:36:03Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: System Templates
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info [at] elxis [dot] org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


global $mosConfig_live_site, $mosConfig_sitename, $mosConfig_offline_message, $mosConfig_sef, $database, $lang;

$imgdir = $mosConfig_live_site.'/includes/systemplates/templates/images/';
$homelink = ($mosConfig_sef == 2) ? sefRelToAbs('index.php') : $mosConfig_live_site;

$query = "SELECT id FROM #__menu WHERE published='1' AND parent='0' AND access='29'"
."\n AND link='index.php?option=com_search' AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
$database->setQuery($query, '#__', 1, 0);
$searchid = (int)$database->loadResult();

$query = "SELECT id, name, link FROM #__menu WHERE ((menutype='mainmenu') OR (menutype='topmenu'))"
."\n AND published='1' AND parent='0' AND access='29' AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
."\n ORDER BY menutype DESC, ordering ASC";
$database->setQuery($query, '#__', 20, 0);
$rows = $database->loadRowList();
?>

<div class="maincontainer">
	<div style="margin: 0; padding: 0;">
		<img src="<?php echo $imgdir; ?>/box_top.png" alt="top" border="0" />
	</div>
    <div class="maininner">
		<h1 class="offline"><?php echo _ELX_ERROR; ?> 404</h1>
		<p class="subtitle">
			<?php echo _E_PAGE_NOTFOUND; ?><br />
			 <span style="color: #489d36;"><?php echo $_SERVER['REQUEST_URI'] ; ?></span>
		</p>
		<div style="margin: 20px 0; padding:0;">
			<div style="margin: 0; padding: 0; width: 280px; float: <?php echo (_GEM_RTL == 1) ? 'right' : 'left'; ?>;">
				<a href="<?php echo $homelink; ?>" title="<?php echo $mosConfig_sitename; ?>"><?php echo _E_RETURNHOME; ?></a>
			</div>
			<div style="margin: 0; padding: 0; width: 270px; float: <?php echo (_GEM_RTL == 1) ? 'right' : 'left'; ?>;">

			<?php 
			if ($searchid > 0) {
?>
				<form name="searchform" action="<?php echo sefRelToAbs('index.php', 'search.html'); ?>" method="post" style="margin: 0; padding: 0;">
				<input type="text" name="searchword" title="<?php echo _E_SEARCH_KEYWORD; ?>" class="searchbox" />
				<input type="hidden" name="option" value="search" />
				<input type="hidden" name="Itemid" value="<?php echo $searchid; ?>" />
				<input type="submit" name="searchbutton" title="<?php echo _E_SEARCH; ?>" value="<?php echo _E_SEARCH; ?>" class="sbutton" />
				</form>
<?php 
			}
?>
			</div>
			<div style="clear: both;"></div>
		</div>

<?php 
	if ($rows) {
    	$unique = array();
        echo '<div class="visittitle">'._E_VISITURLS."</div>\n";
		echo '<table cellspacing="0" cellpadding="0" border="0" width="100%">'."\n";
		$i = 0;
		foreach ($rows as $row) {
			if (in_array($row['link'], $unique)) { continue; } //show only unique links
			$unique[] = $row['link'];
			if ($i == 0) { echo "<tr>\n"; }
            echo '<td><a href="'.sefRelToAbs($row['link'].'&Itemid='.$row['id']).'" title="'.$row['name'].'">'.$row['name']."</a></td>\n";
            if ($i == 2) {
				echo "</tr>\n";
				$i = 0;
			} else {
            	$i++;
            }
        }
        if ($i > 0) {
        	$r = 3 - $i;
        	echo str_repeat('<td>&nbsp;</td>', $r);
        	echo "</tr>\n";
        }
		echo "</table><br /><br />\n";
	}
?>
		<div style="clear: both;"></div>
		<div class="signature">
			<a href="<?php echo $mosConfig_live_site; ?>" title="<?php echo $mosConfig_sitename; ?>"><?php echo $mosConfig_sitename; ?></a>
		</div>
    </div>
	<div style="margin: 0; padding: 0;">
		<img src="<?php echo $imgdir; ?>/box_bottom.png" alt="bottom" border="0" />
	</div>
</div>