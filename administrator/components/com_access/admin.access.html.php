<?php 
/**
* @version: $Id: admin.access.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Access
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_access {

    /***************************/
    /* HTML DISPLAY ARO GROUPS */
    /***************************/
	static public function show_ARO_groups ( &$rows, $option, &$formated_groups ) {
		global $adminLanguage, $mosConfig_live_site;
		?>
 		<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/includes/js/ajax.js"></script>
 		<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/includes/js/edit_group.js"></script>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th class="access"><?php echo $adminLanguage->A_MENU_ACCSMANG; ?> <span class="small">[<?php echo $adminLanguage->A_CMP_ACC_GROUP; ?>]</span></th>
		</tr>
		</table>
		<div id="ajaxMessage"></div>
		<table width="100%">
		<tr>
		<td valign="top" width="60%">
		<table class="adminlist" id="elxis_groups">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20"></th>
			<th><?php echo $adminLanguage->A_NAME; ?></th>
			<th align="center"><?php echo $adminLanguage->A_NB; ?> <?php echo $adminLanguage->A_CMP_ACC_GRUSR; ?></th>
			<th align="center"><?php echo $adminLanguage->A_CMP_ACC_BCKASS; ?></th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = $rows[$i];
			?>
			<tr class="row<?php echo $k; ?>">
				<td align="center"><?php echo $i+1; ?></td>
				<td><?php echo mosHTML::idBox( $i, $row->id ); ?></td>
				<td>
            		<div>
            		<a href="javascript:void(0);" id="group<?php echo $row->id; ?>" title="<?php echo $adminLanguage->A_CMP_ACC_PHREN; ?>">
					<?php echo $row->name; ?></a>
            		</div>
				</td>
				<td align="center"><?php echo $row->numusers; ?></td>
				<td align="center">
				<?php echo $row->backgroup ? '<img src="images/tick.png" border="0" />': '<img src="images/publish_x.png" border="0" />'; ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>
		</td>
        <td valign="top">
			<table class="adminlist">
				<tr>
					<th><?php echo $adminLanguage->A_CMP_ACC_GRHIE; ?></th>
		        </tr>
		        <tr>
		          <td>
                <?php 
                $isrtl = (_GEM_RTL) ? '-rtl' : '';
                foreach ($formated_groups as $fgroup) {
                	echo "<div style=\"line-height: 19px; vertical-align:top; font-size:12px; font-family:tahoma;\">";
                	$fgroup = preg_replace("/\'-/","<img src='images/aro_corn_sm".$isrtl.".gif' align=\"top\" />", $fgroup);
                	$fgroup = preg_replace("/\|-/","<img src=\"images/aro_corn_big".$isrtl.".gif\" align=\"top\" />", $fgroup);
                	$fgroup = preg_replace("/\|/","<img src=\"images/aro_line".$isrtl.".gif\" align=\"top\" />", $fgroup);	  
                	echo($fgroup);
                	echo "</div>\n";
                }     
                ?>
                  </td>
		        </tr>
		    </table>
		</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
		<?php
	}


    /***************************/
    /* HTML ADD/EDIT ARO GROUP */
    /***************************/
	static public function Edit_ARO_group( &$rows, $grid, $grname, $lists, $formated_groups, $option ) {
		global $my, $acl, $adminLanguage;
		?>
		<script type="text/javascript">
		<!--
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");

			// do field validation
			if (trim(form.name.value) == "") {
				alert( "<?php echo $adminLanguage->A_CMP_ACC_GGRNM; ?>" );
			} else if (form.parent_group.value == "17") {
				alert( "<?php echo $adminLanguage->A_CMP_ACC_GGNSO; ?>" );
			} else if (form.parent_group.value == "28") {
				alert( "<?php echo $adminLanguage->A_CMP_ACC_GGNSO; ?>" );
			} else {
				submitform( pressbutton );
			}
		}
		//-->
		</script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="user">
			<?php echo $adminLanguage->A_CMP_ACC_MANG; ?>: <small><?php echo $grid ? $adminLanguage->A_EDIT.' '.$grname.'' : $adminLanguage->A_ADD; ?></small>
			</th>
		</tr>
		</table>

		<table width="100%">
		<tr>
			<td width="60%" valign="top">
				<table class="adminform">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_CMP_ACC_GDTL; ?></th>
				</tr>
				<tr>
					<td width="100"><?php echo $adminLanguage->A_CMP_ACC_GNAME; ?>:</td>
					<td><input type="text" name="name" class="inputbox" size="40" value="<?php echo $grname; ?>" /></td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_CMP_ACC_PRGR; ?>:</td>
					<td><?php echo $lists['parent_groups']; ?></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				</table>
			</td>
			<td width="40%" valign="top">
				<table class="adminform">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_CMP_ACC_EXUG; ?></th>
				</tr>
				<tr>
                    <td><?php 
                    foreach ($formated_groups as $fgroup) {
                    	$isrtl = (_GEM_RTL)? '-rtl' : '';
                        echo "<div style=\"line-height: 19px; vertical-align:top; font-size: 1em; font-family:tahoma, verdana, arial;\">";
                        $fgroup = preg_replace("/\'-/","<img src=\"images/aro_corn_sm".$isrtl.".gif\" align=\"top\" />", $fgroup);
                        $fgroup = preg_replace("/\|-/","<img src=\"images/aro_corn_big".$isrtl.".gif\" align=\"top\" />", $fgroup);
                        $fgroup = preg_replace("/\|/","<img src=\"images/aro_line".$isrtl.".gif\" align=\"top\" />", $fgroup);	  
                        echo($fgroup);
                        echo "</div>"._LEND;
                    }
                    ?></td>
                </tr>
				</table>
			</td>
		</tr>
		</table>
		<input type="hidden" name="group_id" value="<?php echo $grid; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		</form>
		<?php
	}


    /*************************/
    /* HTML EDIT PERMISSIONS */
    /*************************/
    static public function edit_perms( $grid, $grname, $grpid, &$rows, &$comps, $option ) {
        global $adminLanguage;
?>

<script type="text/javascript" id="perms">
var pItem = new DynamicOptionList("aco_section","aco_value","axo_section","axo_value");
pItem.forValue("action").addOptionsTextValue("<?php echo $adminLanguage->A_ADD; ?>","add","<?php echo $adminLanguage->A_EDIT; ?>","edit","<?php echo $adminLanguage->A_PUBLISH; ?>","publish","<?php echo $adminLanguage->A_CMP_ACC_VIEW; ?>","view","<?php echo $adminLanguage->A_CMP_ACC_UPLOAD; ?>","upload");
pItem.forValue("action").forValue("add").addOptionsTextValue("<?php echo $adminLanguage->A_CMP_ACC_CONTENT; ?>","content");
pItem.forValue("action").forValue("add").forValue("content").addOptionsTextValue("<?php echo $adminLanguage->A_ALL; ?>","all");
pItem.forValue("action").forValue("add").addOptionsTextValue("<?php echo $adminLanguage->A_LINKS; ?>","weblinks");
pItem.forValue("action").forValue("add").forValue("weblinks").addOptionsTextValue("<?php echo $adminLanguage->A_ALL; ?>","all");
pItem.forValue("action").forValue("edit").addOptionsTextValue("<?php echo $adminLanguage->A_CMP_ACC_CONTENT; ?>","content");
pItem.forValue("action").forValue("edit").forValue("content").addOptionsTextValue("<?php echo $adminLanguage->A_ALL; ?>","all", "<?php echo $adminLanguage->A_CMP_ACC_OWN; ?>","own");
pItem.forValue("action").forValue("edit").addOptionsTextValue("<?php echo $adminLanguage->A_CMP_ACC_PROF; ?>","profile");
pItem.forValue("action").forValue("edit").forValue("profile").addOptionsTextValue("<?php echo $adminLanguage->A_ALL; ?>","all", "<?php echo $adminLanguage->A_CMP_ACC_OWN; ?>","own");
pItem.forValue("action").forValue("publish").addOptionsTextValue("<?php echo $adminLanguage->A_CMP_ACC_CONTENT; ?>","content");
pItem.forValue("action").forValue("publish").forValue("content").addOptionsTextValue("<?php echo $adminLanguage->A_ALL; ?>","all", "<?php echo $adminLanguage->A_CMP_ACC_OWN; ?>", "own");
pItem.forValue("action").forValue("view").addOptionsTextValue("<?php echo $adminLanguage->A_MENU_COMPONENTS; ?>","components","<?php echo $adminLanguage->A_CMP_ACC_PROF; ?>","profile");
pItem.forValue("action").forValue("upload").addOptionsTextValue("<?php echo $adminLanguage->A_CMP_ACC_FILES; ?>","files");
pItem.forValue("action").forValue("upload").forValue("files").addOptionsTextValue("<?php echo $adminLanguage->A_ALL; ?>","all", "<?php echo $adminLanguage->A_IMAGES; ?>", "images", "<?php echo $adminLanguage->A_CMP_ACC_AVATARS; ?>", "avatars");

<?php 
foreach ( $comps as $comp ) {
    echo "pItem.forValue(\"action\").forValue(\"view\").forValue(\"components\").addOptionsTextValue(\"$comp\",\"$comp\");\n";
}
?>
pItem.forValue("action").forValue("view").forValue("profile").addOptionsTextValue("<?php echo $adminLanguage->A_ALL; ?>","all", "<?php echo $adminLanguage->A_CMP_ACC_OWN; ?>", "own");
pItem.forValue("administration").addOptionsTextValue("<?php echo $adminLanguage->A_LOGIN; ?>","login");
pItem.forValue("administration").addOptionsTextValue("<?php echo $adminLanguage->A_MENU_GC; ?>","config");
pItem.forValue("administration").addOptionsTextValue("<?php echo $adminLanguage->A_CMP_ACC_MANAGE; ?>","manage");
pItem.forValue("administration").forValue("manage").addOptionsTextValue("<?php echo $adminLanguage->A_MENU_COMPONENTS; ?>","components");
<?php 
foreach ( $comps as $comp ) {
    echo "pItem.forValue(\"administration\").forValue(\"manage\").forValue(\"components\").addOptionsTextValue(\"$comp\",\"$comp\");\n";
}
?>
pItem.forValue("administration").addOptionsTextValue("<?php echo $adminLanguage->A_MENU_INSTALL; ?>","install");
pItem.forValue("administration").forValue("install").addOptionsTextValue("<?php echo $adminLanguage->A_TEMPLATES; ?>","templates","<?php echo $adminLanguage->A_MENU_LANGUAGES; ?>","languages","<?php echo $adminLanguage->A_MENU_MODULES; ?>","modules","<?php echo $adminLanguage->A_MENU_MAMBOTS; ?>","mambots","<?php echo $adminLanguage->A_MENU_COMPONENTS; ?>","components","<?php echo $adminLanguage->A_BRIDGES; ?>","bridges","<?php echo $adminLanguage->A_TOOLS; ?>","tools");
pItem.forValue("administration").forValue("install").forValue("templates").addOptionsTextValue("<?php echo $adminLanguage->A_ALL; ?>","all");
pItem.forValue("administration").forValue("install").forValue("languages").addOptionsTextValue("<?php echo $adminLanguage->A_ALL; ?>","all");
pItem.forValue("administration").forValue("install").forValue("modules").addOptionsTextValue("<?php echo $adminLanguage->A_ALL; ?>","all");
pItem.forValue("administration").forValue("install").forValue("mambots").addOptionsTextValue("<?php echo $adminLanguage->A_ALL; ?>","all");
pItem.forValue("administration").forValue("install").forValue("components").addOptionsTextValue("<?php echo $adminLanguage->A_ALL; ?>","all");
pItem.forValue("administration").forValue("install").forValue("bridges").addOptionsTextValue("<?php echo $adminLanguage->A_ALL; ?>","all");
pItem.forValue("administration").forValue("install").forValue("tools").addOptionsTextValue("<?php echo $adminLanguage->A_ALL; ?>","all");
pItem.forValue("administration").addOptionsTextValue("<?php echo $adminLanguage->A_EDIT; ?>","edit");
pItem.forValue("administration").forValue("edit").addOptionsTextValue("<?php echo $adminLanguage->A_MENU_MODULES; ?>","modules","<?php echo $adminLanguage->A_MENU_MAMBOTS; ?>","mambots","<?php echo $adminLanguage->A_MENU_COMPONENTS; ?>","components","<?php echo $adminLanguage->A_BRIDGES; ?>","bridges","<?php echo $adminLanguage->A_TOOLS; ?>","tools");
pItem.forValue("administration").forValue("edit").forValue("modules").addOptionsTextValue("<?php echo $adminLanguage->A_ALL; ?>","all");
pItem.forValue("administration").forValue("edit").forValue("mambots").addOptionsTextValue("<?php echo $adminLanguage->A_ALL; ?>","all");
pItem.forValue("administration").forValue("edit").forValue("bridges").addOptionsTextValue("<?php echo $adminLanguage->A_ALL; ?>","all");
pItem.forValue("administration").forValue("edit").forValue("tools").addOptionsTextValue("<?php echo $adminLanguage->A_ALL; ?>","all");

<?php 
foreach ( $comps as $comp ) {
    echo "pItem.forValue(\"administration\").forValue(\"edit\").forValue(\"components\").addOptionsTextValue(\"$comp\",\"$comp\");\n";
}
?>
pItem.forValue("administration").forValue("edit").addOptionsTextValue("<?php echo $adminLanguage->A_CMP_ACC_USERP; ?>","user properties");
pItem.forValue("administration").forValue("edit").forValue("user properties").addOptionsTextValue("block_user","block_user");
pItem.forValue("workflow").addOptionsTextValue("email_events","email_events");
</script>

        <table class="adminheading">
        <tr>
    		<th class="access"><?php echo $adminLanguage->A_MENU_ACCSMANG; ?> <span class="small">[ <?php echo $adminLanguage->A_CMP_ACC_PRMFOR; ?> <?php echo $grname; ?> ]</span></th>
        </tr>
        </table>

        <form action="index2.php" method="post" name="adminForm">
    	<table class="adminlist">
    	<tr>
    	   <th></th>
    	   <th><?php echo $adminLanguage->A_CMP_ACC_ACO; ?></th>
    	   <th><?php echo $adminLanguage->A_CMP_ACC_ACOV; ?></th>
    	   <th><?php echo $adminLanguage->A_CMP_ACC_AXO; ?></th>
    	   <th><?php echo $adminLanguage->A_CMP_ACC_AXOV; ?></th>
    	</tr>

		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row 	= &$rows[$i];
			?>
			<tr class="row<?php echo $k; ?>">
			    <td align="center"><?php echo mosHTML::idBox( $i, $row->list_id ); ?></td>
                <td align="center"><?php echo $row->aco_section; ?></td>
                <td align="center"><?php echo $row->aco_value; ?></td>
                <td align="center"><?php echo $row->axo_section; ?></td>
                <td align="center"><?php echo $row->axo_value; ?></td>
    	</tr>
		<?php
			$k = 1 - $k;
		}
    	?>
    	</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="grid" value="<?php echo $grid; ?>" />
		</form>

		<br /><br />
        <form name="permForm" id="permForm" method="POST">
        <table class="adminheading">
        <tr>
    		<th class="access"><?php echo $adminLanguage->A_CMP_ACC_ADNP; ?></th>
        </tr>
        </table>
    	<table class="adminlist">
    	<tr>
    	   <th><?php echo $adminLanguage->A_CMP_ACC_ACO; ?></th>
    	   <th><?php echo $adminLanguage->A_CMP_ACC_ACOV; ?></th>
    	   <th><?php echo $adminLanguage->A_CMP_ACC_ARO; ?></th>
    	   <th><?php echo $adminLanguage->A_CMP_ACC_AROV; ?></th>
    	   <th><?php echo $adminLanguage->A_CMP_ACC_AXO; ?></th>
    	   <th><?php echo $adminLanguage->A_CMP_ACC_AXOV; ?></th>
    	   <th>&nbsp;</th>
    	</tr>
		<tr>
            <td align="center">
            <select name="aco_section" class="inputbox">
                <option value="" selected="selected"><?php echo $adminLanguage->A_CMP_ACC_SEL; ?></option>
                <option value="action"><?php echo $adminLanguage->A_CMP_ACC_ACT; ?></option>
                <option value="administration"><?php echo $adminLanguage->A_CMP_ACC_ADM; ?></option>
                <option value="workflow"><?php echo $adminLanguage->A_CMP_ACC_WKF; ?></option>
            </select>
            </td>
            <td align="center"><select name="aco_value" class="inputbox"><script type="text/javascript">pItem.printOptions("aco_value")</script></select></td>
            <td align="center"><?php echo $adminLanguage->A_USERS; ?></td>                      	
            <td align="center"><?php echo eUTF::utf8_strtolower( $grname ); ?></td>
            <td align="center"><select name="axo_section" class="inputbox"><script type="text/javascript">pItem.printOptions("axo_section")</script></td>                      	
            <td align="center"><select name="axo_value" class="inputbox"><script type="text/javascript">pItem.printOptions("axo_value")</script></td>
            <td><input type="submit" name="addperm" value="<?php echo $adminLanguage->A_ADD; ?>" class="button" />
    	</tr>
        </table>
        <input type="hidden" name="option" value="<?php echo $option; ?>" />
        <input type="hidden" name="aro_section" value="users" />
        <input type="hidden" name="aro_value" value="<?php echo $grname; ?>" />
        <input type="hidden" name="task" value="addperm" />
        <input type="hidden" name="grid" value="<?php echo $grid; ?>" />
        <br />
        </form>
<?php 
    }
}

?>