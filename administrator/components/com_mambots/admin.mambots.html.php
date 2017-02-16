<?php 
/**
* @version: $Id: admin.mambots.html.php 56 2010-06-13 09:19:34Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Bots
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_modules {


	/*********************/
	/* HTML LIST MAMBOTS */
	/*********************/
	static public function showMambots( &$rows, $client, &$pageNav, $option, &$lists, $search, $formfilters=array() ) {
		global $my, $adminLanguage, $mosConfig_live_site;

		mosCommonHTML::loadOverlib();
?>
		<script type="text/javascript">
		/* <![CDATA[ */
		function eAccess( cid, access ) {
            if (document.getElementById) {
                var acc = document.getElementById(access).value;
			} else if (document.all) {
				var acc = document.all[access].value;
            } else if (document.layers) {
                var acc = document.layers[access].value;
            }
            window.location = "index2.php?option=com_mambots&client=<?php echo $client; ?>&task=setaccess&access="+acc+"&sid="+cid;
		}
		/* ]]> */
		</script>
		<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_mambots/mambotsajax.js"></script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="modules">
			<?php echo $adminLanguage->A_CMP_MBT_MANAGER; ?> <span class="small">[ <?php echo $client == 'admin' ? $adminLanguage->A_ADMINISTRATOR : $adminLanguage->A_SITE; ?> ]</span>
			</th>
			<td align="right" nowrap="nowrap">
				<?php echo $adminLanguage->A_FILTER; ?>:
			</td>
			<td>
			<input type="text" name="search" value="<?php echo $search; ?>" class="inputbox" onchange="document.adminForm.submit();" />
			</td>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
			</th>
			<th class="title"><?php echo $adminLanguage->A_CMP_MBT_NAME; ?></th>
			<th><?php echo $adminLanguage->A_PUBLISHED; ?></th>
			<th colspan="2" nowrap="nowrap"><?php echo $adminLanguage->A_REORDER; ?></th>
			<th align="<?php echo (_GEM_RTL)? 'left': 'right'; ?>"><?php echo $adminLanguage->A_ORDER; ?></th>
			<th align="<?php echo (_GEM_RTL)? 'right': 'left'; ?>">
				<a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )" title="<?php echo $adminLanguage->A_SAVEORDER; ?>">
					<img src="images/filesave.png" border="0" width="16" height="16" alt="<?php echo $adminLanguage->A_SAVEORDER; ?>" />
				</a>
			</th>
			<th><?php echo $adminLanguage->A_ACCESS; ?></th>
			<th class="title"><?php echo $adminLanguage->A_TYPE; ?>
            <a href="javascript:;" onclick="javascript:showLayer('selecttype')">
            <?php 
            echo '<img src=';
            echo (($formfilters['filter_type'] != '0') && (trim($formfilters['filter_type']) != '')) ? '"images/downarrow3.png" title="'.$adminLanguage->A_FILTERED.'"' : '"images/downarrow2.png" title="'.$adminLanguage->A_FILTER.'"';
            echo ' border="0" />';
            ?>
            </a>
            <div id="selecttype" style="display:none; position:absolute;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_FILTERTYPE; ?></div>
                <?php echo $lists['type'];?>
                <div class="filterbottom">
                    <a href="javascript:;" onclick="javascript:hideLayer('selecttype');" style="color: #888888;"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			</div>
			</th>
			<th class="title"><?php echo $adminLanguage->A_FILE; ?></th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row 	= &$rows[$i];

			$link = 'index2.php?option=com_mambots&client='. $client .'&task=editA&hidemainmenu=1&id='. $row->id;

			$access = mosCommonHTML::AccessProcessing( $row, $i );
            $accesswin_list = mosAdminMenus::Access($row);
			$checked = mosCommonHTML::CheckedOutProcessing( $row, $i );

			$img = $row->published ? 'publish_g.png' : 'publish_x.png';
			$alt = $row->published ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
			?>
			<tr class="row<?php echo $k; ?>">
				<td><?php echo $pageNav->rowNumber( $i ); ?></td>
				<td>
					<?php echo $checked; ?>
				</td>
				<td>
				<?php
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					echo $row->name;
				} else {
					?>
					<a href="<?php echo $link; ?>"><?php echo $row->name; ?></a>
					<?php
				}
				?>
				</td>
				<td align="center" style="text-align:center;">
                    <div id="botstatus<?php echo $i; ?>">
                        <a href="javascript: void(0);" onclick="changeBotState('<?php echo $i; ?>', '<?php echo $row->id; ?>', '<?php echo ($row->published) ? 0 : 1; ?>');" title="<?php echo $alt; ?>">
                        <img src="images/<?php echo $img; ?>" border="0" alt="<?php echo $alt; ?>" /></a>
                    </div>
				</td>
		   		<td style="text-align:<?php echo (_GEM_RTL)? 'left': 'right'; ?>;">
					<?php echo $pageNav->orderUpIcon( $i, ($row->folder == @$rows[$i-1]->folder && $row->ordering > -10000 && $row->ordering < 10000) ); ?>
				</td>
				<td style="text-align:<?php echo (_GEM_RTL)? 'right': 'left'; ?>;">
					<?php echo $pageNav->orderDownIcon( $i, $n, ($row->folder == @$rows[$i+1]->folder && $row->ordering > -10000 && $row->ordering < 10000) ); ?>
				</td>
				<td align="center" colspan="2" style="text-align:center;">
					<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="inputbox" style="text-align: center;" />
				</td>
				<td align="center" style="text-align:center;">
				<?php echo $access;?>
				<div id="accesswin<?php echo $i; ?>" style="display:none; position:absolute;" class="filter">
                    <div class="filtertop"><b><?php echo $adminLanguage->A_ACCESS; ?></b></div>
                    <?php echo $accesswin_list; ?>
                    <div class="filterbottom">
                        <input type="button" class="button" onclick="javascript:eAccess('<?php echo $row->id; ?>', 'access<?php echo $row->id; ?>');" name="submit<?php echo $i; ?>" value="<?php echo $adminLanguage->A_SAVE; ?>" /> &nbsp; 
                        <input type="button" class="button" onclick="javascript:hideLayer('accesswin<?php echo $i; ?>');" name="close<?php echo $i; ?>" value="<?php echo $adminLanguage->A_CLOSE; ?>" />
                    </div>
                </div>
				</td>
				<td><?php echo $row->folder; ?></td>
				<td><?php echo $row->element; ?></td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>

		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="client" value="<?php echo $client; ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
<?php
	}


	/*****************/
	/* HTML EDIT BOT */
	/*****************/
	static public function editMambot( &$row, &$lists, &$params, $option ) {
		global $mosConfig_live_site, $adminLanguage;

		$row->nameA = '';
		if ( $row->id ) {
			$row->nameA = '<span class="small">[ '. $row->name .' ]</span>';
		}
?>
		
		<script type="text/javascript">
		function submitbutton(pressbutton) {
			if (pressbutton == "cancel") {
				submitform(pressbutton);
				return;
			}
			// validation
			var form = document.adminForm;
			if (form.name.value == "") {
				alert( "<?php echo $adminLanguage->A_CMP_MBT_HNAM; ?>" );
			} else if (form.element.value == "") {
				alert( "<?php echo $adminLanguage->A_CMP_MBT_MHNAM; ?>" );
			} else {
				submitform(pressbutton);
			}
		}
		</script>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>

		<table class="adminheading">
		<tr>
			<th class="mambots">
				<?php echo $adminLanguage->A_MENU_SITE_MAMBOTS; ?>:
				<small><?php echo $row->id ? $adminLanguage->A_EDIT : $adminLanguage->A_NEW; ?></small>
				<?php echo $row->nameA; ?>
			</th>
		</tr>
		</table>

		<form action="index2.php" method="post" name="adminForm">
		<table cellspacing="0" cellpadding="0" width="100%">
		<tr valign="top">
			<td width="50%" valign="top">
				<table class="adminform">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_CMP_MBT_DETAILS; ?></th>
				<tr>
				<tr>
					<td width="100"><?php echo $adminLanguage->A_NAME; ?>:</td>
					<td>
						<input class="inputbox" type="text" name="name" size="35" value="<?php echo $row->name; ?>" />
					</td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_CMP_MBT_FOLDER; ?>:</td>
					<td>
						<?php echo $lists['folder']; ?>
					</td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_CMP_MBT_MFILE; ?>:</td>
					<td>
						<input class="inputbox" type="text" name="element" dir="ltr" size="35" value="<?php echo $row->element; ?>" />.php
					</td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_CMP_MBT_ORDER; ?>:</td>
					<td>
						<?php echo $lists['ordering']; ?>
					</td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_ACCESSLEVEL; ?>:</td>
					<td>
						<?php echo $lists['access']; ?>
					</td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_PUBLISHED; ?>:</td>
					<td>
						<?php echo $lists['published']; ?>
					</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_DESCRIPTION; ?>:</td>
					<td>
						<?php echo $row->description; ?>
					</td>
				</tr>
				</table>
			</td>
			<td width="50%">
				<table class="adminform">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_PARAMETERS; ?></th>
				<tr>
				<tr>
					<td>
					<?php
					if ( $row->id ) {
						echo $params->render();
					} else {
						echo '<em>'.$adminLanguage->A_NO.' '.$adminLanguage->A_PARAMETERS.'</em>';
					}
					?>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="client" value="<?php echo $row->client_id; ?>" />
		<input type="hidden" name="task" value="" />
		</form>
		<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/includes/js/overlib_mini.js"></script>
<?php 
	}
}

?>