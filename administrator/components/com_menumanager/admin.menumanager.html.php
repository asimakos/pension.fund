<?php 
/**
* @version: $Id: admin.menumanager.html.php 57 2010-06-13 09:22:00Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Menu Manager
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_menumanager {


    /******************************************/
    /* HTML DISPLAY LIST OF MENUMANAGER ITEMS */
    /******************************************/
	static public function show ( $option, $menus, $pageNav ) {
		global $mainframe, $adminLanguage;
?>
		<script type="text/javascript">
		function menu_listItemTask( id, task, option ) {
			var f = document.adminForm;
			cb = eval( 'f.' + id );
			if (cb) {
				cb.checked = true;
				submitbutton(task);
			}
			return false;
		}
		</script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="menus"><?php echo $adminLanguage->A_CMP_MMA_MANAG; ?></th>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20"></th>
			<th class="title"><?php echo $adminLanguage->A_CMP_MMA_NAME; ?></th>
			<th><?php echo $adminLanguage->A_CMP_MMA_MITE; ?></th>
			<th><?php echo $adminLanguage->A_NB; ?> <?php echo $adminLanguage->A_PUBLISHED; ?></th>
			<th><?php echo $adminLanguage->A_NB; ?> <?php echo $adminLanguage->A_UNPUBLISHED; ?></th>
			<th><?php echo $adminLanguage->A_NBTRASH; ?></th>
			<th><?php echo $adminLanguage->A_NB; ?> <?php echo $adminLanguage->A_MENU_MODULES; ?></th>
		</tr>
		<?php 
		$k = 0;
		$i = 0;
		$start = 0;
		if ($pageNav->limitstart) { $start = $pageNav->limitstart; }
		$count = count($menus)-$start;
		if ($pageNav->limit) {
			if ($count > $pageNav->limit) {
				$count = $pageNav->limit;
			}
		}
		for ($m = $start; $m < $start+$count; $m++) {
			$menu = $menus[$m];
			$link = 'index2.php?option=com_menumanager&task=edit&hidemainmenu=1&menu='.$menu->type;
			$linkA = 'index2.php?option=com_menus&menutype='.$menu->type;
?>
			<tr class="row<?php echo $k; ?>">
				<td align="center" width="20" style="text-align:center;">
				<?php echo $i + 1 + $pageNav->limitstart; ?>
				</td>
				<td width="20" align="center" style="text-align:center;">
				<input type="radio" id="cb<?php echo $i; ?>" name="cid[]" value="<?php echo $menu->type; ?>" onclick="isChecked(this.checked); " />
				</td>
				<td>
                    <a href="<?php echo $link; ?>" title="<?php echo $adminLanguage->A_CMP_MMA_EDMN; ?>"><?php echo $menu->type; ?></a>
				</td>
				<td align="center" style="text-align:center;">
				<a href="<?php echo $linkA; ?>" title="<?php echo $adminLanguage->A_CMP_MMA_EDMITS; ?>">
				<img src="<?php echo $mainframe->getCfg('live_site'); ?>/includes/js/ThemeOffice/mainmenu.png" border="0" /></a>
				</td>
				<td align="center" style="text-align:center;"><?php echo $menu->published; ?></td>
				<td align="center" style="text-align:center;"><?php echo $menu->unpublished; ?></td>
				<td align="center" style="text-align:center;"><?php echo $menu->trash; ?></td>
				<td align="center" style="text-align:center;"><?php echo $menu->modules; ?></td>
			</tr>
			<?php
			$k = 1 - $k;
			$i++;
		}
		?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
		<?php
	}


    /**********************************/
    /* HTML ADD/EDIT MENUMANAGER ITEM */
    /**********************************/
	static public function edit ( &$row, $option ) {
		global $mainframe, $adminLanguage;

		$new = ($row->menutype != '') ? 0 : 1;
?>
		<script type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;

			if (pressbutton == 'savemenu') {
				if ( form.menutype.value == '' ) {
					alert( "<?php echo $adminLanguage->A_CMP_MMA_ENTER; ?>" );
					form.menutype.focus();
					return;
				}
				<?php
				if ( $new ) {
					?>
					if ( form.title.value == '' ) {
						alert( "<?php echo $adminLanguage->A_CMP_MMA_ENTEMN; ?>" );
						form.title.focus();
						return;
					}
					<?php
				}
				?>
				submitform( 'savemenu' );
			} else {
				submitform( pressbutton );
			}
		}
		</script>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="menus">
			<?php echo $adminLanguage->A_CMP_MMA_DETAIL; ?>
			</th>
		</tr>
		</table>

		<table class="adminform">
		<tr style="height: 45px;">
			<td width="100" align="left" style="text-align:left;">
			<b><?php echo $adminLanguage->A_CMP_MMA_NAME; ?>:</b>
			</td>
			<td>
			<input type="text" name="menutype" dir="ltr" class="inputbox" size="30" value="<?php echo isset( $row->menutype ) ? $row->menutype : ''; ?>" />
			<?php 
			$tip = $adminLanguage->A_CMP_MMA_TIP01;
			echo mosToolTip( $tip );
			?>
			</td>
		</tr>
		<?php
		if ( $new ) {
			?>
			<tr>
				<td width="100" align="left" style="text-align:left;" valign="top">
				<strong><?php echo $adminLanguage->A_TITLE; ?> <?php echo $adminLanguage->A_MODULE; ?>:</strong>
				</td>
				<td>
				<input type="text" name="title" dir="ltr" class="inputbox" size="30" value="<?php echo $row->title ? $row->title : '';?>" />
				<?php
				$tip = $adminLanguage->A_CMP_MMA_TIP02;
				echo mosToolTip( $tip );
				?>
				<br /><br /><br />
				<strong><?php echo $adminLanguage->A_CMP_MMA_TXT01; ?></strong>
				</td>
			</tr>
			<?php
		}
		?>
		<tr>
			<td colspan="2"></td>
		</tr>
		</table>
		<br /><br />
		<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/includes/js/overlib_mini.js"></script>
		<?php
		if ( $new ) {
			?>
			<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
			<input type="hidden" name="iscore" value="<?php echo $row->iscore; ?>" />
			<input type="hidden" name="published" value="<?php echo $row->published; ?>" />
			<input type="hidden" name="position" value="<?php echo $row->position; ?>" />
			<input type="hidden" name="module" value="mod_mainmenu" />
			<input type="hidden" name="params" value="<?php echo $row->params; ?>" />
			<?php
		}
		?>

		<input type="hidden" name="new" value="<?php echo $new; ?>" />
		<input type="hidden" name="old_menutype" value="<?php echo $row->menutype; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="savemenu" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
	<?php 
	}


    /*********************************/
	/* HTML MENU DELETE CONFIRMATION */
	/*********************************/
	static public function showDelete( $option, $type, $items, $modules ) {
        global $adminLanguage;
?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th><?php echo $adminLanguage->A_CMP_MMA_DEL.': '.$type; ?></th>
		</tr>
		</table>

		<table class="adminform">
		<tr>
			<td width="3%"></td>
			<td valign="top">
			<?php
			if ( $modules ) {
			?>
				<strong><?php echo $adminLanguage->A_CMP_MMA_MODULE_DEL; ?>:</strong><br />
				<ol>
				<?php 
				foreach ( $modules as $module ) {
				?>
					<li><span style="color: #000066; font-weight: bold;"><?php echo $module->title; ?></span></li>
					<input type="hidden" name="cid[]" value="<?php echo $module->id; ?>" />
				<?php 
				}
				?>
				</ol>
			<?php 
			}
			?>
			</td>
			<td valign="top">
                <strong><?php echo $adminLanguage->A_CMP_MMA_ITEMS_DEL; ?>:</strong><br />
                <ol>
                <?php 
                foreach ( $items as $item ) {
                ?>
				    <li><span style="color: #000066;"><?php echo $item->name; ?></span></li>
				    <input type="hidden" name="mids[]" value="<?php echo $item->id; ?>" />
				<?php 
                }
                ?>
                </ol>
            </td>
			<td>
                <?php echo $adminLanguage->A_CMP_MMA_WILL.' '.$adminLanguage->A_CMP_MMA_WILL2; ?><br /><br /><br />
                <div style="border: 1px dotted gray; width: 70px; padding: 10px; margin-<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>: 100px;">
                    <a class="toolbar" href="javascript:if (confirm('<?php echo $adminLanguage->A_CMP_MMA_YOU_SURE; ?>')){ submitbutton('deletemenu');}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('remove','','images/delete_f2.png',1);">
                    <img name="remove" src="images/delete.png" alt="<?php echo $adminLanguage->A_DELETE; ?>" border="0" align="middle" />
                    &nbsp;<?php echo $adminLanguage->A_DELETE; ?></a>
                </div>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="type" value="<?php echo $type; ?>" />
		<input type="hidden" name="boxchecked" value="1" />
		</form>
		<?php
	}


	/**************************/
	/* HTML COPY CONFIRMATION */
	/**************************/
	static public function showCopy( $option, $type, $items ) {
		global $adminLanguage;
?>
		<script type="text/javascript">
		function submitbutton(pressbutton) {
			if (pressbutton == 'copymenu') {
				if ( document.adminForm.menu_name.value == '' ) {
					alert("<?php echo $adminLanguage->A_CMP_MMA_NAMEMENU; ?>");
					return;
				} else if ( document.adminForm.module_name.value == '' ) {
					alert( "<?php echo $adminLanguage->A_CMP_MMA_ENNMNEWM; ?>" );
					return;
				} else {
					submitform( 'copymenu' );
				}
			} else {
				submitform( pressbutton );
			}
		}
		</script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th><?php echo $adminLanguage->A_CMP_MMA_COPY; ?></th>
		</tr>
		</table>

		<table class="adminform">
		<tr>
			<td width="3%"></td>
			<td valign="top">
                <strong><?php echo $adminLanguage->A_CMP_MMA_NEW; ?>:</strong><br />
                <input class="inputbox" type="text" dir="ltr" name="menu_name" size="30" value="" /><br /><br /><br />
                <strong><?php echo $adminLanguage->A_CMP_MMA_MODNEW; ?>:</strong><br />
                <input class="inputbox" type="text" dir="ltr" name="module_name" size="30" value="" />
                <br /><br />
			</td>
			<td valign="top">
                <strong><?php echo $adminLanguage->A_CMP_MMA_COPIED; ?>:</strong><br />
                <span style="color: #000066; font-weight: bold;"><?php echo $type; ?></span><br /><br />
                <strong><?php echo $adminLanguage->A_CMP_MMA_ITMSCOP; ?>:</strong><br />
                <ol>
                <?php 
                foreach ( $items as $item ) {
				?>
                    <li><span style="color: #000066;"><?php echo $item->name; ?></span></li>
                    <input type="hidden" name="mids[]" value="<?php echo $item->id; ?>" />
                <?php 
                }
                ?>
                </ol>
            </td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="type" value="<?php echo $type; ?>" />
		</form>
		<?php
	}
}

?>