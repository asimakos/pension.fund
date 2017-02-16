<?php 
/**
* @ Version: $Id: mod_popular.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Module Latest
* @ Author: Elxis Team
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $adminLanguage;

$query = "SELECT a.hits, a.id, a.sectionid, a.title, a.created, u.name"
."\n FROM #__content a"
."\n LEFT JOIN #__users u ON u.id=a.created_by"
."\n WHERE a.state <> '-2'"
."\n ORDER BY a.hits DESC"
;
$database->setQuery( $query, '#__', 10, 0 );
$rows = $database->loadObjectList();
?>

<table class="adminlist">
<tr>
	<th class="title"><?php echo $adminLanguage->A_MOSTPOPULARITEMS; ?></th>
	<th class="title"><?php echo $adminLanguage->A_CREATED; ?></th>
	<th class="title"><?php echo $adminLanguage->A_HITS; ?></th>
</tr>
<?php
foreach ($rows as $row) {
	if ( $row->sectionid == 0 ) {
		$link = 'index2.php?option=com_typedcontent&amp;task=edit&amp;hidemainmenu=1&amp;id='.$row->id;
	} else {
		$link = 'index2.php?option=com_content&amp;task=edit&amp;hidemainmenu=1&amp;id='.$row->id;
	}
	?>
	<tr>
		<td><a href="<?php echo $link; ?>"><?php echo htmlspecialchars($row->title, ENT_QUOTES); ?></a></td>
		<td><?php echo $row->created; ?></td>
		<td><?php echo $row->hits; ?></td>
	</tr>
	<?php
}
?>
</table>
