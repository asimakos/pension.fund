<?php 
/**
* @version: $Id: components.menu.html.php 2280 2009-02-21 13:26:53Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org All rights reserved
* @package: Elxis
* @subpackage: Component Menus
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Creates a menu item that links to a component
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class components_menu_html {

	/********************************/
	/* HTML ADD/EDIT MENU ITEM FORM */
	/********************************/
	static public function edit( &$menu, &$components, &$lists, &$params, $option ) {
		global $mainframe, $adminLanguage;

		if ( $menu->id ) {
			$title = '[ '. $lists['componentname'] .' ]';
		} else {
			$title = '';
		}
?>

		<script type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			var comp_links = new Array;
			<?php
			foreach ($components as $row) {
				?>
				comp_links[ <?php echo $row->value; ?> ] = 'index.php?<?php echo addslashes( $row->link );?>';
				<?php
			}
			?>
			if ( form.id.value == 0 ) {
				var comp_id = getSelectedValue( 'adminForm', 'componentid' );
				form.link.value = comp_links[comp_id];
			} else {
				form.link.value = comp_links[form.componentid.value];
			}

			if ( trim( form.name.value ) == "" ){
				alert( '<?php echo $adminLanguage->A_CMP_MU_ITEMNAME; ?>' );
			} else if (form.componentid.value == ""){
				alert( '<?php echo $adminLanguage->A_CMP_MU_PLSELCMP; ?>' );
			} else {
				submitform( pressbutton );
			}
		}
		</script>

		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th>
                <?php echo $menu->id ? $adminLanguage->A_EDIT : $adminLanguage->A_ADD; ?> 
                <?php echo $adminLanguage->A_CMP_MU_MITEM.' : '.$adminLanguage->A_CMP_MU_MICOMP; ?> 
                <span class="small"><?php echo $title; ?></span>
			</th>
		</tr>
		</table>

		<table width="100%">
		<tr valign="top">
			<td width="50%">
				<table class="adminform">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_DETAILS; ?></th>
				</tr>
				<tr>
					<td width="20%"><?php echo $adminLanguage->A_NAME; ?></td>
					<td>
                        <input type="text" name="name" class="inputbox" size="50" maxlength="100" value="<?php echo htmlspecialchars( $menu->name, ENT_QUOTES ); ?>" />
					</td>
				</tr>
                <tr>
                    <td valign="top"><?php echo $adminLanguage->A_COMPONENT; ?>:</td>
                    <td>
                        <?php echo $lists['componentid']; ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $adminLanguage->A_URL; ?>:</td>
                    <td>
                        <?php echo $lists['link']; ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $adminLanguage->A_PARITEM; ?></td>
                    <td>
                        <?php echo $lists['parent']; ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top"><?php echo $adminLanguage->A_ORDERING; ?>:</td>
                    <td>
                        <?php echo $lists['ordering']; ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top"><?php echo $adminLanguage->A_LANGUAGE; ?>:</td>
                    <td>
                        <?php echo $lists['languages']; ?>
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
                </table>
			</td>
			<td>
				<table class="adminform">
				<tr>
					<th><?php echo $adminLanguage->A_PARAMETERS; ?></th>
				</tr>
				<tr>
					<td>
					<?php
					if ($menu->id) {
						echo $params->render();
					} else {
                        echo '<strong>'.$adminLanguage->A_CMP_MU_PARAVAI.'</strong>';
					}
					?>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="id" value="<?php echo $menu->id; ?>" />
		<input type="hidden" name="link" value="" />
		<input type="hidden" name="menutype" value="<?php echo $menu->menutype; ?>" />
		<input type="hidden" name="type" value="<?php echo $menu->type; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
		<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/includes/js/overlib_mini.js"></script>
		<?php
	}

}
?>