<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Trash
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_trash { 

	/*************************/
	/* HTML LIST TRASH ITEMS */
	/*************************/
	static public function showList( $option, $contents, $menus, $pageNav_content, $pageNav_menu ) {
		global $my, $adminLanguage;

		$tabs = new mosTabs(0);
?>
		<script type="text/javascript">
		<!--
		function checkAll_xtd ( n ) {
			var f = document.adminForm;
			var c = f.toggle1.checked;
			var n2 = 0;
			for ( i=0; i < n; i++ ) {
				cb = eval( 'f.cb1' + i );
				if (cb) {
					cb.checked = c;
					n2++;
				}
			}
			if (c) {
				document.adminForm.boxchecked.value = n2;
			} else {
				document.adminForm.boxchecked.value = 0;
			}
		}
		//-->
		</script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="trash"><?php echo $adminLanguage->A_MENU_TRASH_MANAGE; ?></th>
		</tr>
		</table>

		<?php
		$tabs->startPane("content-pane");
		$tabs->startTab($adminLanguage->A_CMP_TRSH_ITEMS, "content_items");
		?>
		<h2 align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>"><?php echo $adminLanguage->A_CMP_TRSH_ITEMS; ?></h2>
		<table class="adminlist" width="90%">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $contents );?>);" />
			</th>
			<th class="title"><?php echo $adminLanguage->A_TITLE; ?></th>
			<th><?php echo $adminLanguage->A_SECTION; ?></th>
			<th><?php echo $adminLanguage->A_CATEGORY; ?></th>
			<th><?php echo $adminLanguage->A_ID; ?></th>
		</tr>
		<?php 
		$k = 0;
		$i = 0;
		$n = count( $contents );
		foreach ( $contents as $row ) {
			?>
			<tr class="row<?php echo $k; ?>">
				<td align="center"><?php echo $i + 1 + $pageNav_content->limitstart; ?></td>
				<td align="center"><?php echo mosHTML::idBox( $i, $row->id ); ?></td>
				<td nowrap="nowrap"><?php echo $row->title; ?></td>
				<td align="center"><?php echo $row->sectname; ?></td>
				<td align="center"><?php echo $row->catname; ?></td>
				<td align="center"><?php echo $row->id; ?> </td>
			</tr>
			<?php
			$k = 1 - $k;
			$i++;
		}
		?>
		</table>
		<?php echo $pageNav_content->getListFooter(); ?>
		<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_CMP_MMA_MITE, "menu_items");
		?>
		<h2 align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>"><?php echo $adminLanguage->A_CMP_MMA_MITE; ?></h2>
		<table class="adminlist" width="90%">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20">
				<input type="checkbox" name="toggle1" value="" onclick="checkAll_xtd(<?php echo count( $menus );?>);" />
			</th>
			<th class="title"><?php echo $adminLanguage->A_TITLE; ?></th>
			<th><?php echo $adminLanguage->A_MENU; ?></th>
			<th><?php echo $adminLanguage->A_TYPE; ?></th>
			<th><?php echo $adminLanguage->A_ID; ?></th>
		</tr>
		<?php
		$k = 0;
		$i = 0;
		$n = count( $menus );
		foreach ( $menus as $row ) {
			?>
			<tr class="row<?php echo $k; ?>">
				<td align="center"><?php echo $i + 1 + $pageNav_menu->limitstart; ?></td>
				<td align="center">
					<input type="checkbox" id="cb1<?php echo $i; ?>" name="mid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" />
				</td>
				<td nowrap="nowrap"><?php echo $row->name; ?></td>
				<td align="center"><?php echo $row->menutype; ?></td>
				<td align="center"><?php echo $row->type; ?></td>
				<td align="center"><?php echo $row->id; ?></td>
			</tr>
			<?php 
			$k = 1 - $k;
			$i++;
		}
		?>
		</table>
		<?php echo $pageNav_menu->getListFooter(); ?>
		<?php
		$tabs->endTab();
		$tabs->endPane();
		?>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}


	/*********************************/
	/* HTML DELETE CONFIRMATION PAGE */
	/*********************************/
	static public function showDelete( $option, $cid, $items, $type ) {
        global $adminLanguage;
?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th><?php echo $adminLanguage->A_CMP_TRSH_DELITEMS; ?></th>
		</tr>
		</table>

		<table class="adminform">
		<tr>
			<td width="3%"></td>
			<td valign="top" width="20%">
				<strong><?php echo $adminLanguage->A_CMP_TRSH_NBITEMS; ?>:</strong><br />
				<span style="font-weight: bold; color: #000066;"><?php echo count( $cid ); ?></span><br /><br />
			</td>
			<td valign="top" width="25%">
				<strong><?php echo $adminLanguage->A_CMP_TRSH_ITEMDEL; ?>:</strong><br />
			<?php
			echo '<ol>'._LEND;
			foreach ( $items as $item ) {
				echo '<li>'.$item->name.'</li>'._LEND;
			}
			echo '</ol>'._LEND;
			?>
			</td>
			<td valign="top">
				<?php echo $adminLanguage->A_CMP_TRSH_THISW; ?> 
				<span style="font-weight: bold; color: #FF0000;"><?php echo $adminLanguage->A_CMP_TRSH_PERMDEL; ?></span><br />
				<?php echo $adminLanguage->A_CMP_TRSH_THESE; ?><br /><br /><br />
				<div style="border: 1px dotted gray; width: 70px; padding: 10px; margin-<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>: 50px;">
					<a class="toolbar" href="javascript:if (confirm('<?php echo $adminLanguage->A_CMP_TRSH_YOUSURE; ?>')){ submitbutton('delete');}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('remove','','images/delete_f2.png',1);">
				 	<img name="remove" src="images/delete.png" alt="<?php echo $adminLanguage->A_DELETE; ?>" border="0" align="middle" />
					&nbsp;<?php echo $adminLanguage->A_DELETE; ?>
					</a>
				</div>
			</td>
		</tr>
		</table>
		<br /><br />

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="1" />
		<input type="hidden" name="type" value="<?php echo $type; ?>" />
		<?php 
		foreach ($cid as $id) {
			echo '<input type="hidden" name="cid[]" value="'.$id.'" />'._LEND;
		}
		?>
		</form>
		<?php
	}


	/****************************************/
	/* SHOW RESTORE TRASH CONFIRMATION PAGE */
	/****************************************/
	static public function showRestore( $option, $cid, $items, $type ) {
        global $adminLanguage;
?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th><?php echo $adminLanguage->A_CMP_TRSH_RESTORE; ?></th>
		</tr>
		</table>

		<table class="adminform">
		<tr>
			<td width="3%"></td>
			<td valign="top" width="20%">
				<strong><?php echo $adminLanguage->A_CMP_TRSH_NUMBER; ?>:</strong><br />
				<span style="font-weight: bold; color: #000066;"><?php echo count( $cid ); ?></span><br /><br />
			</td>
			<td valign="top" width="25%">
				<strong><?php echo $adminLanguage->A_CMP_TRSH_ITEMRST; ?>:</strong><br />
			<?php
			echo '<ol>'._LEND;
			foreach ( $items as $item ) {
				echo '<li>'.$item->name.'</li>'._LEND;
			}
			echo '</ol>'._LEND;
			?>
			</td>
			 <td valign="top">
			 	<?php echo $adminLanguage->A_CMP_TRSH_THISW; ?> 
				 <span style="font-weight: bold; color: #FF0000;"><?php echo $adminLanguage->A_CMP_TRSH_REST; ?></span> 
				 <?php echo $adminLanguage->A_CMP_TRSH_RETURN; ?><br /><br /><br />
				 <div style="border: 1px dotted gray; width: 80px; padding: 10px; margin-<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>: 50px;">
				 	<a class="toolbar" href="javascript:if (confirm('<?php echo $adminLanguage->A_CMP_TRSH_AREYOU; ?>')){ submitbutton('restore');}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('restore','','images/restore_f2.png',1);">
					<img name="restore" src="images/restore.png" alt="<?php echo $adminLanguage->A_CMP_TRSH_REST; ?>" border="0" align="middle" />
					&nbsp;<?php echo $adminLanguage->A_CMP_TRSH_REST; ?>
					</a>
				</div>
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="sectionid" value="<?php echo $sectionid; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="1" />
		<input type="hidden" name="type" value="<?php echo $type; ?>" />
		<?php 
		foreach ($cid as $id) {
			echo '<input type="hidden" name="cid[]" value="'.$id.'" />'._LEND;
		}
		?>
		</form>
<?php 
	}
}
?>