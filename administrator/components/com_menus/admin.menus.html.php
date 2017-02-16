<?php 
/**
* @version: $Id: admin.menus.html.php 62 2010-06-13 15:11:23Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org All rights reserved
* @package: Elxis
* @subpackage: Component Menus
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_menusections {

    /************************/
    /* HTML LIST MENU ITEMS */
    /************************/
	static public function showMenusections( $rows, $pageNav, $search, $levellist, $menutype, $option ) {
		global $my, $adminLanguage, $mosConfig_live_site;

        mosCommonHTML::loadOverlib();
?>
		<script type="text/javascript">
		function eAccess( cid, access ) {
            if (document.getElementById) {
                var acc = document.getElementById(access).value;
			} else if (document.all) {
				var acc = document.all[access].value;
            } else if (document.layers) {
                var acc = document.layers[access].value;
            }
            window.location = "index2.php?option=com_menus&menutype=<?php echo $menutype; ?>&task=setaccess&access="+acc+"&sid="+cid;
		}
		</script>
        <script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_menus/menus.js"></script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="menus">
                <?php echo $adminLanguage->A_CMP_MU_MANAGER; ?> <span class="small"<?php echo (_GEM_RTL) ? ' dir="rtl"' : ''; ?>>[ <?php echo $menutype; ?> ]</span>
			</th>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_CMP_MU_MXLVLS; ?></td>
			<td>
                <?php echo $levellist; ?>
			</td>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_SEARCH; ?>:</td>
			<td>
                <input type="text" name="search" value="<?php echo $search; ?>" class="inputbox" />
			</td>
		</tr>
		<?php
		if ( $menutype == 'mainmenu' ) {
			?>
			<tr>
				<td style="text-align:<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>; color: #ff0000; font-weight: normal;" colspan="5" nowrap="nowrap">
                    <?php echo $adminLanguage->A_CMP_MU_CANTDEL; ?><br />
                    <span style="color: #000000;"><?php echo $adminLanguage->A_CMP_MU_MANHOME; ?></span>
				</td>
			</tr>
			<?php
		} else if ( $menutype == 'systemmenu' ) {
		?>
			<tr>
				<td style="text-align:<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>;" colspan="5">
                    <span style="color: #ff0000; font-weight: normal;"><?php echo $adminLanguage->A_CMP_MU_DONTDEL; ?></span>
				</td>
			</tr>
		<?php 
		}
		?>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20">
                <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
			</th>
			<th class="title"><?php echo $adminLanguage->A_CMP_MU_MITEM; ?></th>
			<th><?php echo $adminLanguage->A_PUBLISHED; ?></th>
			<th colspan="2"><?php echo $adminLanguage->A_REORDER; ?></th>
			<th width="50" nowrap="nowrap"><?php echo $adminLanguage->A_ORDER; ?></th>
			<th width="1%">
                <a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )">
                    <img src="images/filesave.png" border="0" width="16" height="16" alt="<?php echo $adminLanguage->A_SAVEORDER; ?>" />
                </a>
			</th>
			<th><?php echo $adminLanguage->A_ACCESS; ?></th>
			<th><?php echo $adminLanguage->A_ITEMID; ?></th>
			<th class="title"><?php echo $adminLanguage->A_TYPE; ?></th>
			<th><?php echo $adminLanguage->A_CID; ?></th>
			<th class="title"><?php echo $adminLanguage->A_LANGUAGE; ?></th>			
		</tr>
	    <?php
		$k = 0;
		$i = 0;
		$n = count( $rows );
		foreach ($rows as $row) {
			$access = mosCommonHTML::AccessProcessing( $row, $i );
			$accesswin_list = mosAdminMenus::Access($row);
			$checked = mosCommonHTML::CheckedOutProcessing( $row, $i );

			$img = $row->published ? 'publish_g.png' : 'publish_x.png';
            $alt = $row->published ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
			?>
			<tr class="row<?php echo $k; ?>">
				<td align="center" style="text-align: center;"><?php echo $i + 1 + $pageNav->limitstart; ?></td>
				<td><?php echo $checked; ?></td>
				<td nowrap="nowrap">
				<?php
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					echo $row->treename;
				} else {
					$link = 'index2.php?option=com_menus&menutype='. $row->menutype .'&task=edit&id='. $row->id . '&hidemainmenu=1&type=' . $row->type2; //For Help Screens to work
					?>
					<a href="<?php echo $link; ?>"><?php echo $row->treename; ?></a>
					<?php
				}
				?>
				</td>
				<td align="center" style="text-align: center;">
                    <div id="menustatus<?php echo $i; ?>">
					   <a href="javascript:void(0);" title="<?php echo $alt; ?>" 
                       onclick="changeMenuState('<?php echo $i; ?>', '<?php echo $row->id; ?>', '<?php echo ($row->published) ? 0 : 1; ?>');">
                       <img src="images/<?php echo $img; ?>" border="0" alt="<?php echo $alt; ?>" /></a>
                    </div>
				</td>
				<td style="text-align:<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>;">
                    <?php echo $pageNav->orderUpIcon( $i ); ?>
				</td>
				<td style="text-align:<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>;">
                    <?php echo $pageNav->orderDownIcon( $i, $n ); ?>
				</td>
				<td align="center" style="text-align: center;" colspan="2">
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="inputbox" style="text-align: center;" />
				</td>
				<td align="center" style="text-align: center;">
				<?php echo $access; ?>
				<div id="accesswin<?php echo $i; ?>" style="display:none; position:absolute;" class="filter">
                    <div class="filtertop"><strong><?php echo $adminLanguage->A_ACCESS; ?></strong></div>
                    <?php echo $accesswin_list; ?>
                    <div class="filterbottom">
                        <input type="button" class="button" onclick="javascript:eAccess('<?php echo $row->id; ?>', 'access<?php echo $row->id; ?>');" name="submit<?php echo $i; ?>" value="<?php echo $adminLanguage->A_SAVE; ?>" /> &nbsp; 
                        <input type="button" class="button" onclick="javascript:hideLayer('accesswin<?php echo $i; ?>');" name="close<?php echo $i; ?>" value="<?php echo $adminLanguage->A_CLOSE; ?>" />
                    </div>
                </div>
				</td>
				<td align="center" style="text-align: center;"><?php echo $row->id; ?></td>
				<td>
				<?php
				echo mosToolTip( $row->descrip, '', 280, 'tooltip.png', $row->type, $row->edit );
				?>
				</td>
				<td align="center" style="text-align: center;"><?php echo $row->componentid; ?></td>
                <td>
				<?php 
                if (trim($row->language) != '') {
                    $clangs = explode(',',$row->language);
                    if (count($clangs) > 5) {
                        echo count($clangs).' '.$adminLanguage->A_MENU_LANGUAGES;
                    } else {
                        foreach ($clangs as $clang) {
                            if (trim($clang) != '') {
                                echo '<img src="'.$mosConfig_live_site.'/language/'.$clang.'/'.$clang.'.gif" alt="'.$clang.'" title="'.$clang.'" border="0" /> ';
                            }
                        }
                    }
 				} else {
 				   echo '<img src="images/flag_un.gif" alt="'.$adminLanguage->A_ALL.'" title="'.$adminLanguage->A_ALL.'" border="0" />';
                }
                ?>
                </td>
		    </tr>
			<?php
			$k = 1 - $k;
			$i++;
		}
		?>
		</table>

		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="menutype" value="<?php echo $menutype; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
<?php 
	}


	/**************************/
	/* HTML ADD NEW MENU ITEM */
	/**************************/
	static public function addMenuItem(&$cid, $menutype, $option, $menu_types) {
		global $adminLanguage;

        mosCommonHTML::loadOverlib();
?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="menus"><?php echo $adminLanguage->A_NEW.' '.$adminLanguage->A_CMP_MU_MITEM; ?></th>
		</tr>
		</table>

        <table class="adminform">
        <tr>
            <td width="50%" valign="top">
<?php 
		$q = 0;
		foreach ($menu_types as $menu_type) {
			echo '<fieldset style="border: 1px solid #777777;">'."\n";
			echo '<legend style="font-weight: bold;">'.$menu_type['title']."</legend>\n";
			if ($menu_type['items'] && (count($menu_type['items']) > 0)) {
				echo '<table class="adminform">'."\n";
				$k = 0;
				$i = 0;
				foreach ($menu_type['items'] as $row) {
					$link = 'index2.php?option=com_menus&amp;menutype='.$menutype.'&amp;task=edit&amp;hidemainmenu=1&amp;type='.$row->type;
					echo '<tr class="row'.$k.'">'."\n";
					echo '<td width="20">'."\n";
                    echo '<input type="radio" id="cb'.$i.'" name="type" value="'.$row->type.'" onclick="isChecked(this.checked);" />'."\n";
					echo "</td>\n";
					echo '<td><a href="'.$link.'">'.$row->name."</a></td>\n";
					echo '<td style="text-align: center;" width="20">'."\n";
					echo mosToolTip($row->descrip, $row->name, 250);
					echo "</td>\n</tr>\n";
					$k = 1 - $k;
					$i++;
				}
				echo "</table>\n";
			}
			echo "</fieldset>\n";
			
			if ($q == 2) {
            	echo "</td>\n";
            	echo '<td width="50%" valign="top">'."\n";
			}
			$q++;
		}
?>
            </td>
        </tr>
        <tr><td colspan="2"><?php echo $adminLanguage->A_CMP_MU_NSMTG; ?></td></tr>
        </table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="menutype" value="<?php echo $menutype; ?>" />
		<input type="hidden" name="task" value="edit" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
<?php 
	}


	/*****************************/
	/* HTML MOVE MENU ITEMS FORM */
	/*****************************/
	static public function moveMenu( $option, $cid, $MenuList, $items, $menutype  ) {
		global $adminLanguage;
?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th><?php echo $adminLanguage->A_CMP_MU_MOVEITS; ?></th>
		</tr>
		</table>

		<table class="adminform">
        <tr>
            <th width="30%"><?php echo $adminLanguage->A_CMP_MU_MOVEMEN; ?>:</th>
            <th><?php echo $adminLanguage->A_CMP_MU_BEINMOV; ?>:</th>
        </tr>
		<tr>
			<td valign="top">
                <?php echo $MenuList; ?>
			</td>
			<td valign="top">
                <ol>
                <?php 
                foreach ( $items as $item ) {
                    echo '<li>'.$item->name.'</li>'._LEND;
                }
                ?>
                </ol>
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="boxchecked" value="1" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="menutype" value="<?php echo $menutype; ?>" />
		<?php
		foreach ( $cid as $id ) {
			echo '<input type="hidden" name="cid[]" value="'.$id.'" />'._LEND;
		}
		?>
		</form>
<?php 
	}


	/*****************************/
	/* HTML COPY MENU ITEMS FORM */
	/*****************************/
	static public function copyMenu( $option, $cid, $MenuList, $items, $menutype  ) {
		global $adminLanguage;
?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th><?php echo $adminLanguage->A_CMP_MU_COPYITS; ?></th>
		</tr>
		</table>

		<table class="adminform">
        <tr>
            <th width="30%"><?php echo $adminLanguage->A_CMP_MU_COPYMEN; ?>:</th>
            <th><?php echo $adminLanguage->A_CMP_MU_BCOPIED; ?>:</th>
        </tr>
		<tr>
			<td valign="top">
                <?php echo $MenuList; ?>
			</td>
			<td valign="top">
                <ol>
                <?php 
                foreach ( $items as $item ) {
                    echo '<li>'.$item->name.'</li>'._LEND;
                }
                ?>
                </ol>
            </td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="menutype" value="<?php echo $menutype; ?>" />
		<?php
		foreach ( $cid as $id ) {
			echo '<input type="hidden" name="cid[]" value="'.$id.'" />'._LEND;
		}
		?>
		</form>
<?php 
	}
}

?>