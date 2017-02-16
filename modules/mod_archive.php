<?php 
/**
* @version: $Id: mod_archive.php 2562 2009-10-09 20:48:48Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Module Archive
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $lang, $mainframe;

$count = intval( $params->def( 'count', 10 ) );
$moduleclass_sfx = $params->get( 'moduleclass_sfx' ); 
$now = date( 'Y-m-d H:i:s', time() + $mainframe->getCfg('offset') * 3600);

$noauth = !$mainframe->getCfg('shownoauth');
$oradrivers = array('oci8', 'oci8po', 'oci805', 'oracle');
$dbt = $mainframe->getCfg('dbtype');

if (in_array($dbt, $oradrivers)) {
    $query = "SELECT TO_CHAR(created, 'MM') AS created_month, created, id, sectionid, title, TO_CHAR(created, 'YYYY') AS created_year"
    ."\n FROM #__content"
    ."\n WHERE state='-1' AND sectionid > '0'"
    ."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
    .($noauth ? "\n AND access IN (".$my->allowed.")" : '')
    ."\n ORDER BY created_year DESC, created_month DESC";
} else if (preg_match('/postgre/i', $dbt)) {
    $query = "SELECT DISTINCT ON (created_year, created_month) EXTRACT(month FROM created) AS created_month, created, id, sectionid, title, EXTRACT(year FROM created) AS created_year"
    ."\n FROM #__content"
    ."\n WHERE state='-1' AND sectionid > '0'"
    ."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
    .( $noauth ? "\n AND access IN (".$my->allowed.")" : '' )
    ."\n ORDER BY created_year DESC, created_month DESC";
} else {
    $query = "SELECT MONTH(created) AS created_month, created, id, sectionid, title, YEAR(created) AS created_year"
    ."\n FROM #__content"
    ."\n WHERE state='-1' AND sectionid > '0'"
    ."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
    .( $noauth ? "\n AND access IN (".$my->allowed.")" : '' )
    ."\n GROUP BY created_year, created_month"
    ."\n ORDER BY created_year DESC, created_month DESC";
}
$database->setQuery($query, '#__', $count, 0);
$rows = $database->loadObjectList();

if ($rows) {
	$used = array();
    echo '<ul>'._LEND;
    foreach ($rows as $row) {
		$d = $row->created_year.$row->created_month;
		if (in_array($d, $used)) { continue; }
		array_push($used, $d);
		$created_month = mosFormatDate( $row->created, "%m" );
		$month_name = mosFormatDate( $row->created, "%B" );
		$created_year = mosFormatDate( $row->created, "%Y" );
		$link = sefRelToAbs( 'index.php?option=com_content&task=archivecategory&year='.$created_year.'&month='.$created_month.'&module=1', 'archive/'.$created_year.$created_month.'/?module=1' );
		$text = $month_name.', '.$created_year;
?>
		<li>
			<a href="<?php echo $link; ?>" title="<?php echo $text; ?>"><?php echo $text; ?></a>
		</li>
<?php
    }
	echo '</ul>'._LEND;
}
?>
