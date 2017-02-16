<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org All rights reserved
* @package: Elxis
* @subpackage: Component Menus
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Creates a menu item to a system URL
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class system_menu_html {


	/************************************/
	/* HTML ADD/EDIT URL MENU ITEM FORM */
	/************************************/
	static public function edit( $menu, $lists, $params, $option, $systemLinks ) {
		global $mainframe, $adminLanguage;
?>
		<script type="text/javascript">
		function makesyslink() {
			var form = document.adminForm;
			var val = trim(getSelectedValue('adminForm', 'shortlink'));
			if (val == '') {
				form.link.value = '';
			}
			<?php 
			foreach ($systemLinks as $key => $val) {
				echo ' else if (val == \''.$key.'\') {'._LEND;
				echo 'form.link.value = \''.$val[1].'\';'._LEND;
				echo '}'._LEND;
			}
			?>
		}
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			if (trim(form.name.value) == "") {
				alert( "<?php echo $adminLanguage->A_CMP_MU_LNKHNAME; ?>" );
			} else if (trim(form.link.value) == "") {
				alert( "<?php echo $adminLanguage->A_CMP_MU_MSLINK; ?>" );
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
                <?php echo $adminLanguage->A_CMP_MU_MITEM.' : '.$adminLanguage->A_CMP_MU_SYSLINK; ?>
			</th>
		</tr>
		</table>

		<table width="100%">
		<tr>
			<td width="60%" valign="top">
				<table class="adminform">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_DETAILS; ?></th>
				</tr>
				<tr>
					<td colspan="2"><?php echo $adminLanguage->A_CMP_MU_SYSLINKD; ?></td>
				</tr>
				<tr>
					<td width="25%"><?php echo $adminLanguage->A_NAME; ?>:</td>
					<td>
                        <input type="text" name="name" class="inputbox" size="50" maxlength="150" value="<?php echo $menu->name; ?>" />
					</td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_LINK; ?>:</td>
					<td>
						<?php echo $lists['shortlink']; ?>
					</td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_PARITEM; ?>:</td>
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
					<td><?php echo $adminLanguage->A_PUBLISHED; ?>:</td>
					<td>
                        <?php echo $lists['published']; ?>
					</td>
				</tr>
				</table>
			</td>
			<td width="40%" valign="top">
				<table class="adminform">
				<tr>
					<th><?php echo $adminLanguage->A_PARAMETERS; ?></th>
				</tr>
				<tr>
					<td>
                        <?php echo $params->render(); ?>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="id" value="<?php echo $menu->id; ?>" />
		<input type="hidden" name="menutype" value="<?php echo $menu->menutype; ?>" />
		<input type="hidden" name="type" value="<?php echo $menu->type; ?>" />
		<input type="hidden" name="link" value="<?php echo $menu->link; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
		<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/includes/js/overlib_mini.js"></script>
<?php 
	}
}
?>