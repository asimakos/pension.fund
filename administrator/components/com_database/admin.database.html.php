<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Database
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_database {

	static public function db_panel( $elxtables, &$lists ) {
		global $adminLanguage, $database, $mainframe;

        $tabs = new mosTabs(0);
        mosCommonHTML::loadOverlib();
        $align = (_GEM_RTL) ? 'right' : 'left';
?> 
		<script type="text/javascript">
            function changeBackUp(typ) {
	            if(document.getElementById) {
	                switch (typ) {
	                    case 0:
	                        document.getElementById('backupsql').style.display = 'none';
	                        document.getElementById('backupxml').style.display = '';
	                    break;
	                    case 1:
	                        document.getElementById('backupsql').style.display = '';
	                        document.getElementById('backupxml').style.display = 'none';
	                    break;
	                    default:
	                    break;
	                }
	            }
	        }
		</script>
        <script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/components/com_database/js/dbajax.js"></script>

        <form action="index2.php" method="post" name="adminForm">
		<input type="hidden" name="option" value="com_database" />
		<input type="hidden" name="task" value="" />
		</form>
		<table class="adminheading">
		<tr>
			<th class="database">
    		<?php echo $adminLanguage->A_DATABASEMANAGER; ?> :: <small><?php echo $mainframe->getCfg('db'); ?></small>
			</th>
		</tr>
		</table>
		<table width="100%">
		<tr>
		<td valign="top" width="60%">
		<table class="adminlist" border="1">
		<tr>
			<th><?php echo $adminLanguage->A_NB; ?></th>
 			<th align="<?php echo $align; ?>"><?php echo $adminLanguage->A_CMP_DB_TABNM; ?></th>
 			<th width="80" align="<?php echo $align; ?>"><?php echo $adminLanguage->A_CMP_DB_ACTIONS; ?></th>
		</tr>
		<?php
		$k = 0;
		$i = 1;
   		foreach ($elxtables as $elxtable) {
		?>
			<tr class="row<?php echo $k; ?>">
			<td align="center"><?php echo $i; ?></td>
			<td><a href="index2.php?option=com_database&task=structure&tbl=<?php echo $elxtable; ?>" title="<?php echo $adminLanguage->A_CMP_DB_TDESCR; ?>"><?php echo $elxtable; ?></a></td>
			<td align="center">
            <div id="dbman">
                <div style="float:<?php echo $align; ?>;">
		            <div class="icon">
    			        <a href="index2.php?option=com_database&task=browse&tbl=<?php echo $elxtable; ?>" title="<?php echo $adminLanguage->A_CMP_DB_BROWSE; ?>">
                        <img src="components/com_database/images/view.png" border="0" alt="<?php echo $adminLanguage->A_CMP_DB_BROWSE; ?>" /></a>
            		</div>
            	</div>
                <div style="float:<?php echo $align; ?>;">
		            <div class="icon">
    			        <a href="index2.php?option=com_database&task=structure&tbl=<?php echo $elxtable; ?>" title="<?php echo $adminLanguage->A_CMP_DB_STRUCTURE; ?>">
                        <img src="components/com_database/images/info.png" border="0" alt="<?php echo $adminLanguage->A_CMP_DB_STRUCTURE; ?>" /></a>
            		</div>
            	</div>
            </div>
            </td></tr>
		<?php
            $i++;
    		$k = 1 - $k;
		}
		?>
		</table>
		</td>
        <td valign="top"><?php
		$tabs->startPane('dbpane');
		$tabs->startTab($adminLanguage->A_CMP_DB_INFO,'info-pane');

        HTML_database::show_information();

		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_CMP_DB_DUMPDB, "dump-pane" );
?>
        <table class="adminform">
            <tr>
				<th colspan="2" align="center"><?php echo $adminLanguage->A_CMP_DB_XDUMPDB; ?></th>
		    </tr>
		    <tr>
		        <td><?php echo $adminLanguage->A_CMP_DB_BACTYPE; ?>:</td>
                <td>
                <input type="radio" id="backuptype0"<?php echo (_GEM_RTL) ? ' dir="rtl"' : ''; ?> name="backuptype" value="0" onclick="changeBackUp(0)" checked="checked" /> <?php echo $adminLanguage->A_CMP_DB_XML; ?>
                <input type="radio" id="backuptype1"<?php echo (_GEM_RTL) ? ' dir="rtl"' : ''; ?> name="backuptype" value="1" onclick="changeBackUp(1)" /> <?php echo $adminLanguage->A_CMP_DB_SQL; ?>
                </td>
		    </tr>
		    <tr>
		        <td colspan="2">&nbsp;</td>
		    </tr>
		    <tr>
		        <td colspan="2">
		        <div id="backupxml">
		            <form action="index2.php" method="post" name="adminForm1">
    		        <fieldset>
                        <legend><?php echo $adminLanguage->A_CMP_DB_XCRBACK; ?></legend>
                        <input type="radio" name="data" value="1" checked="checked" /> <?php echo $adminLanguage->A_CMP_DB_XFULL; ?>
                        <input type="radio" name="data" value="0" /> <?php echo $adminLanguage->A_CMP_DB_XSTRUONL; ?><br><br>
                        <input type="radio" name="save" value="1" checked="checked" /> <?php echo $adminLanguage->A_CMP_DB_XSAVSERV; ?>
                        <input type="radio" name="save" value="0" /> <?php echo $adminLanguage->A_CMP_DB_DOWNLD; ?><br><br>
                        <input type="submit" value="<?php echo $adminLanguage->A_CMP_DB_XMLBACK; ?>" class="button" />
                    </fieldset>
                	<input type="hidden" name="option" value="com_database" />
		            <input type="hidden" name="task" value="xmlbackup" />
		            </form>
                </div>
		        <div id="backupsql" style="display:none">
		            <form action="index2.php" method="post" name="adminForm2">
    		        <fieldset>
                        <legend><?php echo $adminLanguage->A_CMP_DB_SCRBACK; ?></legend>
                        <input type="radio" name="data" value="1" checked="checked" /> <?php echo $adminLanguage->A_CMP_DB_SFULL; ?>
                        <input type="radio" name="data" value="0" /> <?php echo $adminLanguage->A_CMP_DB_XSTRUONL; ?> 
                        <input type="radio" name="data" value="2" /> <?php echo $adminLanguage->A_CMP_DB_SDATAONL; ?><br /><br /><br />
                        <strong><?php echo $adminLanguage->A_CMP_DB_SLOCTBL; ?></strong>: 
                        <input type="radio" name="lock_table" value="1" checked="checked" /> <?php echo $adminLanguage->A_YES; ?>
                        <input type="radio" name="lock_table" value="0" /> <?php echo $adminLanguage->A_NO; ?><br /><br />
                        <strong><?php echo $adminLanguage->A_CMP_DB_SFSYNTX; ?></strong>: 
                        <input type="radio" name="full_syntax" value="1" checked="checked" /> <?php echo $adminLanguage->A_YES; ?>
                        <input type="radio" name="full_syntax" value="0" /> <?php echo $adminLanguage->A_NO; ?><br /><br />
                        <strong><?php echo $adminLanguage->A_CMP_DB_SDRTBL; ?></strong>: 
                        <input type="radio" name="drop_table" value="1" checked="checked" /> <?php echo $adminLanguage->A_YES; ?>
                        <input type="radio" name="drop_table" value="0" /> <?php echo $adminLanguage->A_NO; ?><br /><br />
                        <strong><?php echo $adminLanguage->A_CMP_DB_STBLS; ?></strong>: 
                        <input type="radio" name="alltables" value="1" onclick="document.getElementById('listtbl').style.display = 'none';" checked="checked" /> <?php echo $adminLanguage->A_CMP_DB_ATBLS; ?>
                        <input type="radio" name="alltables" value="0" onclick="document.getElementById('listtbl').style.display = '';" /> <?php echo $adminLanguage->A_CMP_DB_SELTBLS; ?>
                        <div id="listtbl" style="display:none">
                            <?php echo $lists['tables']; ?>
                        </div>
                        <br /><br />
                        <input type="radio" name="save" value="1" checked="checked" /> <?php echo $adminLanguage->A_CMP_DB_XSAVSERV; ?>
                        <input type="radio" name="save" value="0" /> <?php echo $adminLanguage->A_CMP_DB_DOWNLD; ?><br /><br />
                        <input type="submit" value="<?php echo $adminLanguage->A_CMP_DB_SQLBACK; ?>" class="button" />
                    </fieldset>
                	<input type="hidden" name="option" value="com_database" />
		            <input type="hidden" name="task" value="sqlbackup" />
		            </form>
                </div>
                </td>
		    </tr>
		</table>
<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_CMP_DB_MAINTEN, "maint-pane" );
?>
        <table class="adminlist">
        <tr>
            <th><?php echo $adminLanguage->A_CMP_DB_MAINTEND; ?></th>
        </tr>
		<tr>
		    <td>
		    &#149; <?php echo $adminLanguage->A_CMP_DB_FRUOPTINCP; ?><br />
		    &#149; <?php echo $adminLanguage->A_CMP_DB_RRERRDBTAB; ?><br /><br />
            <div id="dbman">
                <div style="float:<?php echo $align; ?>;">
		            <div class="iconWide">
    			        <a href="javascript: comdbOptimize();" title="<?php echo $adminLanguage->A_CMP_DB_OPTIM; ?>">
                        <img src="components/com_database/images/db_optimize.png" border="0" alt="<?php echo $adminLanguage->A_CMP_DB_OPTIM; ?>" align="absmiddle" /> <?php echo $adminLanguage->A_CMP_DB_OPTIM; ?></a>
            		</div>
            	</div>
            </div>
            <div style="clear: both;"></div><br />
            <div id="dbman">
                <div style="float:<?php echo $align; ?>;">
		            <div class="iconWide">
    			        <a href="javascript: comdbRepair();" title="<?php echo $adminLanguage->A_CMP_DB_REPAIR; ?>">
                        <img src="components/com_database/images/db_repair.png" border="0" alt="<?php echo $adminLanguage->A_CMP_DB_REPAIR; ?>" align="absmiddle" /> <?php echo $adminLanguage->A_CMP_DB_REPAIR; ?></a>
            		</div>
            	</div>
            </div>
            <div style="clear: both;"></div><br />
            <div id="ajaxdbMessage" style="display: none; background-color: #FFFFFF; margin: 4px 0px 4px 0px; padding: 2px;"></div>
            </td>
		</tr>
        </table>
<?php
		$tabs->endTab();
		$tabs->endPane();
?>    
        </td>
		</tr>
		</table>
<?php 
    }


	/********************************/
	/* HTML VIEW DB TABLE STRUCTURE */
	/********************************/
	static public function table_Structure( $tbl, &$cols ) {
		global $adminLanguage, $database;
?>
		<table class="adminheading">
		<tr>
			<th class="database">
    		<?php echo $adminLanguage->A_DATABASEMANAGER; ?> :: <small><?php echo $adminLanguage->A_CMP_DB_TDESC; ?> [ <?php echo $tbl; ?> ]</small>
			</th>
		</tr>
		</table>
		<table width="100%">
		<tr>
		<td valign="top" width="60%">
		<table class="adminlist" border="1">
		<tr>
			<th><?php echo $adminLanguage->A_NB; ?></th>
 			<th><?php echo $adminLanguage->A_CMP_DB_CLNAME; ?></th>
 			<th><?php echo $adminLanguage->A_CMP_DB_CLTYPE; ?></th>
 			<th><?php echo $adminLanguage->A_CMP_DB_ADOTYPE; ?></th>
 			<th><?php echo $adminLanguage->A_CMP_DB_MAXLEN; ?></th>
		</tr>
		<?php
		$k = 0;
		$i = 1;
		foreach ($cols as $col) { 
			echo '<tr class="row'.$k.'">'._LEND;
			echo '<td align="center">'.$i.'</td>'._LEND;
			echo '<td align="center">'.$col->name.'</td>'._LEND;
			echo '<td align="center">'.$col->type.'</td>'._LEND;
			echo '<td align="center">'.$database->_resource->MetaType($col->type).'</td>'._LEND;
			echo '<td align="center">'.$col->max_length.'</td></tr>'._LEND;
		$i++;
		$k = 1 - $k;
		}
		?>
		</table>
		</td>
        <td valign="top"><?php HTML_database::show_information(); ?></td>
		</tr>
		</table>
		<div align="center">
            <a href="index2.php?option=com_database&task=browse&tbl=<?php echo $tbl; ?>"><?php echo $adminLanguage->A_CMP_DB_BRTBL; ?></a> &nbsp; &nbsp; 
            <a href="index2.php?option=com_database"><?php echo $adminLanguage->A_CMP_DB_BCKDB; ?></a>
        </div>
<?php 
    }


	/*****************************/
	/* SHOW DATABASE INFORMATION */
	/*****************************/
    static private function show_information() {
        global $database, $adminLanguage;
        	
        $srvinfo = $database->_resource->ServerInfo();
?>
        <table class="adminlist">
			<tr>
				<th colspan="2"><?php echo $adminLanguage->A_CMP_DB_INFO; ?></th>
		    </tr>
		    <tr>
                <td><?php echo $adminLanguage->A_CMP_DB_DBTYPE; ?></td>
                <td><?php echo $database->_resource->databaseType; ?></td>
		    </tr>
		    <tr>
				<td><?php echo $adminLanguage->A_CMP_DB_DBDESCR; ?></td>
				<td><?php echo $srvinfo['description']; ?></td>
		    </tr>
		    <tr>
                <td><?php echo $adminLanguage->A_CMP_DB_DBVER; ?></td>
                <td><?php echo $srvinfo['version']; ?></td>
		    </tr>
		    <tr>
                <td><?php echo $adminLanguage->A_CMP_DB_DBHOST; ?></td>
                <td><?php echo $database->_resource->host; ?></td>
		    </tr>
		    <tr>
				<td><?php echo $adminLanguage->A_CMP_DB_DBNAME; ?></td>
				<td><?php echo $database->_resource->database; ?></td>
		    </tr>
		    <tr>
                <td><?php echo $adminLanguage->A_CMP_DB_DBUSER; ?></td>
                <td><?php echo $database->_resource->user; ?></td>
		    </tr>
		    <tr>
                <td><?php echo $adminLanguage->A_CMP_DB_DBERRF; ?></td>
                <td><?php echo $database->_resource->raiseErrorFn; ?></td>
		    </tr>
		    <tr>
                <td><?php echo $adminLanguage->A_CMP_DB_DBDBG; ?></td>
                <td><?php echo $database->_resource->debug ? $adminLanguage->A_YES : $adminLanguage->A_NO; ?></td>
		    </tr>
		</table>
<?php 
    }


	/************************/
	/* HTML BROWSE DB TABLE */
	/************************/
	static public function table_Browse( $tbl, $option ) {
		global $adminLanguage, $database, $mainframe;
?>
		<table class="adminheading">
		<tr>
			<th class="database">
    		<?php echo $adminLanguage->A_DATABASEMANAGER; ?> : <small><?php echo $adminLanguage->A_CMP_DB_BROWSE.' '.$tbl; ?></small>
			</th>
		</tr>
		</table>
		<table width="100%">
		<tr>
		    <td>
            <?php 
            require_once($mainframe->getCfg('absolute_path').'/includes/adodb/tohtml.inc.php');
            $query = "SELECT * FROM $tbl";
            $rs   = $database->_resource->Execute($query);
            rs2html($rs);
            ?>
            </td>
        </tr>
		<tr>
            <td align="center">
                <a href="index2.php?option=com_database&task=structure&tbl=<?php echo $tbl; ?>"><?php echo $adminLanguage->A_CMP_DB_TBLSTR; ?></a> &nbsp; &nbsp; 
                <a href="index2.php?option=com_database"><?php echo $adminLanguage->A_CMP_DB_BCKDB; ?></a>
            </td>
		</tr>
		</table>
	<?php 
    }


	/******************************/
	/* HTML VIEW DATABASE BACKUPS */
	/******************************/
	static public function view_backups( $ret, $option ) {
		global $adminLanguage, $mainframe;

		$align = (_GEM_RTL) ? 'right' : 'left';
?>
		<table class="adminheading">
		<tr>
			<th class="database">
    		<?php echo $adminLanguage->A_DATABASEMANAGER; ?> :: <small><?php echo $adminLanguage->A_CMP_DB_DBBACK ; ?></small>
			</th>
		</tr>
		</table>

        <form action="index2.php" method="post" name="adminForm">
		<table class="adminlist">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20">&nbsp;</th>
			<th align="<?php echo $align; ?>"><?php echo $adminLanguage->A_FILE; ?></th>
			<th align="<?php echo $align; ?>"><?php echo $adminLanguage->A_TYPE; ?></th>
			<th align="<?php echo $align; ?>"><?php echo $adminLanguage->A_CMP_DB_SIZE; ?></th>
			<th align="<?php echo $align; ?>"><?php echo $adminLanguage->A_DATE; ?></th>
		</tr>
        <?php 
        $burl = $mainframe->getCfg('live_site').'/administrator/backups/database/';
        if (count($ret) > 0) {
            $k = 0;
            for ($i=0; $i<count($ret); $i++) {
        ?>
		<tr class="row<?php echo $k; ?>">
			<td width="20"><?php echo $i+1; ?></td>
			<td width="20">
			<input type="checkbox" name="buf[<?php echo $i; ?>]" value="<?php echo $ret[$i]['filename']; ?>" />
			</td>
			<td align="<?php echo $align; ?>"><a href="<?php echo $burl.$ret[$i]['filename']; ?>" target="_blank"><?php echo $ret[$i]['filename']; ?></a></td>
			<td align="<?php echo $align; ?>"><?php echo $ret[$i]['type']; ?></td>
			<td align="<?php echo $align; ?>"><?php echo $ret[$i]['size']; ?></td>
			<td align="<?php echo $align; ?>"><?php echo $ret[$i]['date']; ?></td>
		</tr>
        <?php
            $k = 1 - $k;
            }
        } else {
        ?>
        <tr>
            <td colspan="6" align="center"><?php echo $adminLanguage->A_CMP_DB_NOEXISTS; ?></td>
        </tr>
        <?php
        }
        ?>
        </table>
        <div align="center"><br />
            <?php echo $adminLanguage->A_CMP_DB_FOOTER; ?>
        </div>
        <input type="hidden" name="option" value="com_database" />
		<input type="hidden" name="task" value="" />
		</form>
	<?php 
    }


	/*********************/
    /* INSPECTS DATABASE */
	/*********************/
    static public function DBmonitor( $option ) {
        global $adminLanguage;

        $do = mosGetParam( $_REQUEST, 'do', 'stats' );
?>
		<table class="adminheading">
		<tr>
			<th class="database">
    		<?php echo $adminLanguage->A_DATABASEMANAGER; ?> :: <small><small><?php echo $adminLanguage->A_CMP_DB_DBMONIT; ?> [<?php echo htmlspecialchars($do); ?>]</small></small>
			</th>
		</tr>
		</table>
		<table class="adminlist">
		<tr>
			<td>
			<iframe src="index3.php?option=com_database&task=monexec&do=<?php echo $do; ?>" name="Monitor" id="Monitor" width="100%" height="500" marginwidth="0" marginheight="0" align="top" scrolling="auto" frameborder="0" hspace="0" vspace="0" background="white"></iframe>
            </td>
		</tr>
		</table>
<?php 
    }
}

?>