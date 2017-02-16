<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component MassMail
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_massmail {

	static public function messageForm( &$lists, $option ) {
    	global $adminLanguage;
?>
		<script type="text/javascript">
			function submitbutton(pressbutton) {
				var form = document.adminForm;
				if (pressbutton == 'cancel') {
					submitform( pressbutton );
					return;
				}
				// do field validation
				if (form.mm_subject.value == ""){
					alert( "<?php echo $adminLanguage->A_CMP_MM_SUBJECT; ?>" );
				} else if (getSelectedValue('adminForm','mm_group') < 0){
					alert( "<?php echo $adminLanguage->A_CMP_MM_GROUP; ?>" );
				} else if (form.mm_message.value == ""){
					alert( "<?php echo $adminLanguage->A_CMP_MM_MESSAGE; ?>" );
				} else {
					submitform( pressbutton );
				}
			}
		</script>

		<form action="index2.php" name="adminForm" method="post">
		<table class="adminheading">
		<tr>
			<th class="massemail"><?php echo $adminLanguage->A_CMP_MM_MAIL; ?></th>
		</tr>
		</table>

		<table class="adminform">
		<tr>
			<th colspan="2"><?php echo $adminLanguage->A_DETAILS; ?></th>
		</tr>
		<tr>
			<td width="200" valign="top"><?php echo $adminLanguage->A_CMP_MM_GROUP; ?>:</td>
			<td>
				<?php echo $lists['gid']; ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_CMP_MM_CHILD; ?>:</td>
			<td>
				<input type="checkbox" name="mm_recurse" value="RECURSE" />
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_CMP_MM_HTML; ?>:</td>
			<td>
				<input type="checkbox" name="mm_mode" value="1" />
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_CMP_MM_SUB; ?>:</td>
			<td>
				<input class="inputbox" type="text" name="mm_subject" value="" size="70" maxlength="100" />
			</td>
		</tr>
		<tr>
			<td valign="top"><?php echo $adminLanguage->A_CMP_MM_MESS; ?>:</td>
			<td>
				<textarea cols="100" rows="15" name="mm_message" class="text_area"></textarea>
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		</form>
<?php 
	}
}
?>