<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2009. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Ioannis Sannos
* @email: datahell@elxis.org
* @link: http://www.elxis.org
* @description: Tools FixLanguage transforms language empty values to null values
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $database, $mainframe, $alang;

$fixlbase = $mainframe->getCfg('absolute_path').'/administrator/tools/fix_language/';
//FIX LANGUAGE language
if (file_exists( $fixlbase.'language'.SEP.$alang.'.php')) {
    include_once( $fixlbase.'language'.SEP.$alang.'.php' );
} else {
    include_once( $fixlbase.'language'.SEP.'english.php' );
}

$alltables = $database->_resource->MetaTables('TABLES');
$tables = array();
$found = array();
foreach ($alltables as $table) {
    if (preg_match('/^'.$database->_table_prefix.'/i', $table)) {
        if ($cols = $database->_resource->MetaColumns( $table )) {
            foreach ($cols as $col) {
                if (strtolower($col->name) == 'language') {
                    $tables[] = $table;
                    $database->setQuery("SELECT COUNT(*) FROM $table WHERE language=''");
                    if ($fnd = intval($database->loadResult())) {
                        $database->setQuery( "UPDATE $table SET language=NULL WHERE language=''" );
                        $database->query();
                    }
                    $found[] = $fnd;
                }
            }
        }
    }
}

?>
<table class="adminlist">
	<tr>
		<th class="title" width="30"><?php echo _TFIXL_NR; ?></th>
		<th class="title" width="250"><?php echo _TFIXL_TABLE; ?></th>
		<th align="center" width="140"><?php echo _TFIXL_FIXCOMMIT; ?></th>
		<th class="title"><?php echo _TFIXL_STATUS; ?></th>
	</tr>
<?php 
$k = 0;
for ($i=0; $i<count($tables); $i++) {
	echo '<tr class="row'.$k.'">';
	echo '<td>'.($i+1).'</td>';
	echo '<td>'.$tables[$i].'</td>';
	echo '<td align="center">'.$found[$i].'</td>';
	echo '<td>&nbsp; <img src="images/tick.png" border="0" alt="OK" /></td>';
	echo '</tr>'._LEND;
	$k = 1 - $k;
}
?>
</table>
