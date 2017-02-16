<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org All rights reserved
* @package: Elxis
* @subpackage: Component Menus
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Creates a menu item to display a wrapped page
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class wrapper_menu_html {

    /***********************************/
    /* HTML ADD/EDIT WRAPPER MENU ITEM */
    /***********************************/
	static public function edit( &$menu, &$lists, &$params, $option ) {
		global $mainframe, $adminLanguage;
?>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/includes/js/overlib_mini.js"></script>
		<script type="text/javascript">
		function submitbutton(pressbutton) {
			if ( pressbutton == 'cancel' ) {
				submitform( pressbutton );
				return;
			}
			var form = document.adminForm;
			if ( form.name.value == "" ) {
				alert( '<?php echo $adminLanguage->A_CMP_MU_TMHTITL; ?>' );
			} else if (trim(form.seotitle.value) == ""){
                alert( "<?php echo $adminLanguage->A_SEOTEMPTY; ?>" );
			} else {
				<?php
				if ( !$menu->id ) {
					?>
					if (form.url.value == "") {
						alert( '<?php echo $adminLanguage->A_CMP_MU_WRURL; ?>' );
					} else {
						submitform(pressbutton);
					}
					<?php
				} else {
					?>
					submitform(pressbutton);
					<?php
				}
				?>
			}
		}
		</script>
        <script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/components/com_menus/menus.js"></script>

		<table class="adminheading">
		<tr>
			<th>
            <?php 
                echo $adminLanguage->A_CMP_MU_MITEM.' &raquo; '.$adminLanguage->A_CMP_MU_MIWRAP.' &raquo; ';
                echo ($menu->id) ? $adminLanguage->A_EDIT : $adminLanguage->A_ADD;
            ?>
            </th>
		</tr>
		</table>

		<form action="index2.php" method="post" name="adminForm">
		<table width="100%" cellspacing="0" cellpadding="0" border="0">
		<tr valign="top">
			<td width="50%">
				<table class="adminform">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_DETAILS; ?></th>
				</tr>
				<tr>
					<td width="25%"><?php echo $adminLanguage->A_NAME; ?>:</td>
					<td>
                        <input type="text" name="name" size="30" maxlength="100" class="inputbox" value="<?php echo $menu->name; ?>" />
					</td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_SEOTITLE; ?>:</td>
					<td>
                        <input type="text" id="seotitle" name="seotitle" dir="ltr" size="30" maxlength="100" class="inputbox" value="<?php echo $menu->seotitle; ?>" /> 
                        <?php echo mosToolTip($adminLanguage->A_SEOTHELP); ?><br />
                        <a href="javascript:void(0);" onclick="suggestSEO()"><?php echo $adminLanguage->A_SEOTSUG; ?></a> &nbsp; | &nbsp; 
                        <a href="javascript:void(0);" onclick="validateSEO()"><?php echo $adminLanguage->A_SEOTVAL; ?></a><br />
                        <div id="valseo" style="height: 20px;"></div>                    
                    </td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_MU_WRLINK; ?>:</td>
					<td>
                        <input class="inputbox" type="text" name="url" dir="ltr" size="50" maxlength="250" value="<?php echo @$menu->url; ?>" />
					</td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_URL; ?>:</td>
					<td>
                        <?php echo $lists['link']; ?>
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
			<td width="50%">
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
<?php 
	}
}

?>