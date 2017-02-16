<?php 
/**
* @ Version: $Id: mod_latest.php 1878 2008-01-25 21:26:29Z datahell $
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

$query = "SELECT a.id, a.sectionid, a.title, a.created, u.name, a.created_by_alias, a.created_by"
. "\n FROM #__content a"
. "\n LEFT JOIN #__users u ON u.id=a.created_by"
. "\n WHERE a.state <> '-2'"
. "\n ORDER BY a.created DESC"
;
$database->setQuery( $query, '#__', 10, 0 );
$rows = $database->loadObjectList();
?>

<table class="adminlist">
<tr>
    <th colspan="3"><?php echo $adminLanguage->A_LATESTADDED; ?></th>
</tr>
<?php
foreach ($rows as $row) {
	if ( $row->sectionid == 0 ) {
		$link = 'index2.php?option=com_typedcontent&amp;task=edit&amp;hidemainmenu=1&amp;id='. $row->id;
	} else {
		$link = 'index2.php?option=com_content&amp;task=edit&amp;hidemainmenu=1&amp;id='. $row->id;
	}

	if ( $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_users' ) || 
	   $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'all' )) {
		if ( $row->created_by_alias ) {
			$author = $row->created_by_alias;
		} else {
			$linkA 	= 'index2.php?option=com_users&task=editA&amp;hidemainmenu=1&id='. $row->created_by;
			$author = '<a href="'. $linkA .'" title="'.$adminLanguage->A_EDITUSER.'">'. htmlspecialchars( $row->name, ENT_QUOTES ) .'</a>';
		}
	} else {
		if ( $row->created_by_alias ) {
			$author = $row->created_by_alias;
		} else {
			$author = htmlspecialchars( $row->name, ENT_QUOTES );
		}
	}
	?>
	<tr>
		<td>
			<a href="<?php echo $link; ?>"><?php echo htmlspecialchars($row->title, ENT_QUOTES); ?></a>
		</td>
		<td><?php echo $row->created; ?></td>
		<td><?php echo $author; ?></td>
	</tr>
	<?php
}
?>
</table>
