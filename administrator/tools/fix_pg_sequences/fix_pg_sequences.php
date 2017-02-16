<?php 
/**
* @version: $Id: fix_pg_sequences.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Ioannis Sannos
* @email: datahell@elxis.org
* @link: http://www.elxis.org
* @description: Fixes PostgreSQL sequences
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $database, $mosConfig_dbprefix, $mosConfig_absolute_path, $alang, $mosConfig_dbtype;

$fixpgseqbase = $mosConfig_absolute_path.'/administrator/tools/fix_pg_sequences/';

if (file_exists( $fixpgseqbase.'language'.SEP.$alang.'.php')) {
    include_once( $fixpgseqbase.'language'.SEP.$alang.'.php' );
} else {
    include_once( $fixpgseqbase.'language'.SEP.'english.php' );
}

$seqerr = false;

//If PostgreSQL fix sequences
if (preg_match('/postgre/i', strtolower($mosConfig_dbtype))) {
    //get sequences
    $query = "SELECT relname FROM pg_class WHERE relkind='S' AND relname LIKE '".$mosConfig_dbprefix."%';";
    $rs = $database->_resource->Execute( $query );

    if (is_object($rs) && $rs->RecordCount() > 0) {
        $pg_seqs = array();
        while ($row = $rs->FetchRow()) {
            array_push($pg_seqs, $row[0]);
        }
    } else {
        $pg_seqs = array(
            $mosConfig_dbprefix.'banner_bid_seq',
            $mosConfig_dbprefix.'bannerclient_cid_seq', 
            $mosConfig_dbprefix.'bannerfinish_bid_seq', 
            $mosConfig_dbprefix.'categories_id_seq', 
            $mosConfig_dbprefix.'components_id_seq', 
            $mosConfig_dbprefix.'contact_details_id_seq', 
            $mosConfig_dbprefix.'content_id_seq', 
            $mosConfig_dbprefix.'core_acl_access_lists_list_id_seq', 
            $mosConfig_dbprefix.'core_acl_aro_aro_id_seq', 
            $mosConfig_dbprefix.'core_acl_aro_groups_group_id_seq', 
            $mosConfig_dbprefix.'core_acl_aro_sections_section_id_seq', 
            $mosConfig_dbprefix.'mambots_id_seq', 
            $mosConfig_dbprefix.'menu_id_seq', 
            $mosConfig_dbprefix.'messages_message_id_seq', 
            $mosConfig_dbprefix.'modules_id_seq', 
            $mosConfig_dbprefix.'newsfeeds_id_seq', 
            $mosConfig_dbprefix.'poll_data_id_seq', 
            $mosConfig_dbprefix.'poll_date_id_seq', 
            $mosConfig_dbprefix.'polls_id_seq', 
            $mosConfig_dbprefix.'sections_id_seq', 
            $mosConfig_dbprefix.'template_positions_id_seq', 
            $mosConfig_dbprefix.'users_extra_extraid_seq', 
            $mosConfig_dbprefix.'users_id_seq', 
            $mosConfig_dbprefix.'weblinks_id_seq'
        );
    }

    //get tables
    $pg_tables = $database->_resource->MetaTables();
    
    $seqs=0;
    if ($pg_tables) {
        foreach ($pg_tables as $pg_table) {
            if (!preg_match('/^'.$mosConfig_dbprefix.'/i', $pg_table)) {
                continue;
            }
            $pg_keys = $database->_resource->MetaPrimaryKeys( $pg_table );
            if ($pg_keys) {
                foreach ($pg_keys as $pg_key) {
                    //build possible sequence
                    $pg_pseq = $pg_table.'_'.$pg_key.'_seq';
                    //if is a real requence
                    if (in_array($pg_pseq, $pg_seqs)) {
                        //select column max value
                        $query = 'SELECT MAX("'.$pg_key.'") FROM '.$pg_table.';';
                        $next_val = intval($database->_resource->GetOne($query));
                        if ($next_val == 0) { $next_val = 1; }
                        $sql = "SELECT setval('".$pg_pseq."', ".$next_val.");";
                        @pg_exec($database->_resource->_connectionID, "$sql"); //native postgres function
                        $seqs++;
                    }
                }
            }
        }
    }
} else {
	$seqerr = _TFIXPGS_ONLYPG; 
}

?>
<table class="adminlist">
	<tr>
		<th class="title"><?php echo _TFIXPGS_FPGSEQ; ?></th>
	</tr>
	<tr>
		<td style="text-align:center; height:160px;">
		<img src="images/asterisk.png" border="0"><br /><br /><br />
		<?php 
		if (!$seqerr) {
			echo '<img src="images/tick.png" border="0" alt="OK" /> '._TFIXPGS_FOUND.' <strong>'.$seqs.'</strong> '._TFIXPGS_APPLIED.'<br />';
		} else {
			echo '<br /><br /><span style="color: #ff0000"><strong>'.$seqerr.'</strong></span><br />';
		}
		?>
	   </td>
	</tr>
</table>