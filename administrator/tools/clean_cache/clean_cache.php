<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Ioannis Sannos
* @email: datahell@elxis.org
* @link: http://www.elxis.org
* @description: Clean Cache clean cache directory from cached content items and images
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

   
global $alang, $mainframe, $fmanager, $adminLanguage;

mosCache::cleanCache('');
if (file_exists($mainframe->getCfg('cachepath').SEP.'static'.SEP) && is_dir($mainframe->getCfg('cachepath').SEP.'static'.SEP)) {
	$ok1 = $fmanager->deleteFolder($mainframe->getCfg('cachepath').SEP.'static'.SEP);
	if ($ok1) {
		@mkdir($mainframe->getCfg('cachepath').SEP.'static'.SEP, 0755);
	}
}

if (file_exists($mainframe->getCfg('cachepath').SEP.'simplepie'.SEP) && is_dir($mainframe->getCfg('cachepath').SEP.'simplepie'.SEP)) {
	$ok2 = $fmanager->deleteFolder($mainframe->getCfg('cachepath').SEP.'simplepie'.SEP);
	if ($ok2) {
		@mkdir($mainframe->getCfg('cachepath').SEP.'simplepie'.SEP, 0755);
	}
}

$cleancachebase = $mainframe->getCfg('absolute_path').'/administrator/tools/clean_cache/';

if (file_exists($cleancachebase.'language'.SEP.$alang.'.php')) {
    include_once($cleancachebase.'language'.SEP.$alang.'.php');
} else {
    include_once($cleancachebase.'language'.SEP.'english.php');
}

?>
<table class="adminlist">
	<tr>
		<th class="title" colspan="2"><?php echo $adminLanguage->A_MENU_CLEAN_CACHE; ?></th>
	</tr>
	<tr>
		<td align="center" width="60">
			<img src="images/asterisk.png" border="0" alt="Elxis CMS" />
		</td>
		<td valign="top">
			<img src="images/tick.png" border="0" alt="OK" /> <?php echo _TCLEANCACHE_NOTE; ?>
			<?php 
			if (isset($ok1)) {
				$img = $ok1 ? 'tick.png' : 'publish_x.png';
	   			echo '<br /><img src="images/'.$img.'" border="0" alt="static cache" /> Static Cache';
			}
			if (isset($ok2)) {
				$img = $ok2 ? 'tick.png' : 'publish_x.png';
	   			echo '<br /><img src="images/'.$img.'" border="0" alt="simple pie rss" /> Simplepie RSS';
			}
			?>
		</td>
	</tr>
</table>
