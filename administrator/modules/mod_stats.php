<?php 
/**
* @ Version: $Id: mod_stats.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Module Stats
* @ Author: Elxis Team
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $adminLanguage;

$query = "SELECT menutype, COUNT(id) AS numitems FROM #__menu WHERE published = '1' GROUP BY menutype";
$database->setQuery( $query );
$rows = $database->loadObjectList();
?>
<table class="adminlist">
	<tr>
		<th class="title"><?php echo $adminLanguage->A_MENU; ?></th>
		<th class="title"><?php echo $adminLanguage->A_NB.' '.$adminLanguage->A_MENU_ITEMS; ?></th>
	</tr>
<?php
foreach ($rows as $row) {
	$link = 'index2.php?option=com_menus&amp;menutype='.$row->menutype;
	?>
	<tr>
		<td><a href="<?php echo $link; ?>"><?php echo $row->menutype; ?></a></td>
		<td>
            <?php echo $row->numitems; ?>
		</td>
	</tr>
<?php
}
?>
</table>
