<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Syndicate
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_syndicate {

	static public function settings( $option, &$params, $id ) {
		global $mainframe, $adminLanguage;

?>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="syndicate"><?php echo $adminLanguage->A_CMP_SYN_SETGS; ?></th>
		</tr>
		</table>

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

		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<input type="hidden" name="name" value="Syndicate" />
		<input type="hidden" name="admin_menu_link" value="option=com_syndicate" />
		<input type="hidden" name="admin_menu_alt" value="Manage Syndication Settings" />
		<input type="hidden" name="option" value="com_syndicate" />
		<input type="hidden" name="admin_menu_img" value="js/ThemeOffice/component.png" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/includes/js/overlib_mini.js"></script>
<?php 
	}
}

?>