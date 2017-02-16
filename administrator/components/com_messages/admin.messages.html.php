<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Messages
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_messages {


	/*************************/
	/* HTML DISPLAY MESSAGES */
	/*************************/
	static public function showMessages( &$rows, $pageNav, $search, $option ) {
		global $adminLanguage;
?>
		<form action="index2.php" method="post" name="adminForm">
			<table class="adminheading">
			<tr>
				<th class="inbox"><?php echo $adminLanguage->A_CMP_MSS_PRIVM; ?></th>
				<td nowrap="nowrap">
					<?php echo $adminLanguage->A_SEARCH; ?>: 
					<input type="text" name="search" value="<?php echo $search;?>" class="inputbox" onchange="document.adminForm.submit();" />
				</td>
			</tr>
			</table>

			<table class="adminlist">
			<tr>
				<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
				<th width="40" class="title">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
				</th>
				<th class="title"><?php echo $adminLanguage->A_CMP_MSS_SUBJE; ?></th>
				<th class="title"><?php echo $adminLanguage->A_CMP_MSS_FROM; ?></th>
				<th class="title"><?php echo $adminLanguage->A_DATE; ?></th>
				<th class="title"><?php echo $adminLanguage->A_CMP_MSS_READ; ?></th>
			</tr>
		<?php 
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row =& $rows[$i];
		?>
    		<tr class="row<?php echo $k; ?>">
			<td align="center"><?php echo $i+1+$pageNav->limitstart; ?></td>
			<td><?php echo mosHTML::idBox( $i, $row->message_id ); ?></td>
			<td>
				<a href="javascript:void(0);" onclick="hideMainMenu(); return listItemTask('cb<?php echo $i;?>','view')"><?php echo $row->subject; ?></a>
				<?php echo (intval( $row->state ) == "1") ? '' : ' <strong>'.$adminLanguage->A_NEW.'</strong>'; ?>
			</td>
			<td><?php echo $row->user_from; ?></td>
			<td><?php echo mosFormatDate($row->date_time, _GEM_DATE_FORMLC2); ?></td>
			<td><?php 
				if (intval( $row->state ) == "1") {
					echo $adminLanguage->A_CMP_MSS_READ;
				} else {
					echo '<span style="color:#ff0000; font-weight: bold;">'.$adminLanguage->A_CMP_MSS_UNREAD.'</span>';
				}
			?></td>
			</tr>
		<?php 
			$k = 1 - $k;
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


	/********************/
	/* HTML EDIT CONFIG */
	/********************/
	static public function editConfig($vars) {
    	global $adminLanguage;
?>

		<script type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'saveconfig') {
				if (confirm ("<?php echo $adminLanguage->A_CMP_MSS_SURE; ?>")) {
					submitform( pressbutton );
				}
			} else {
				document.location.href = 'index2.php?option=com_messages';
			}
		}
		</script>

		<table class="adminheading">
			<tr>
				<th class="msgconfig"><?php echo $adminLanguage->A_CMP_MSS_PMCONF; ?></th>
			</tr>
		</table><br />

		<form action="index2.php" method="post" name="adminForm">
			<fieldset>
			<legend><?php echo $adminLanguage->A_CMP_MSS_GNRAL; ?></legend>
			<table class="adminform">
			<tr>
				<td width="20%"><?php echo $adminLanguage->A_CMP_MSS_LINBX; ?></td>
				<td><?php echo $vars['lock']; ?></td>
			</tr>
			<tr>
				<td><?php echo $adminLanguage->A_CMP_MSS_MAILME; ?></td>
				<td><?php echo $vars['mail_on_new']; ?></td>
			</tr>
			</table>
			<input type="hidden" name="option" value="com_messages" />
			<input type="hidden" name="task" value="" />
			</fieldset>
		</form>

	<?php 
	}


	/*********************/
	/* HTML VIEW MESSAGE */
	/*********************/
	static public function viewMessage( $row ) {
    	global $adminLanguage;
?>
		<table class="adminheading">
		<tr>
			<th class="inbox"><?php echo $adminLanguage->A_CMP_MSS_VWPM; ?></th>
		</tr>
		</table>

		<form action="index2.php" method="post" name="adminForm">
			<table class="adminform">
			<tr>
				<td width="120"><?php echo $adminLanguage->A_CMP_MSS_FROM; ?>:</td>
				<td style="background-color: #ffffff;"><?php echo $row->user_from; ?></td>
			</tr>
			<tr>
				<td><?php echo $adminLanguage->A_CMP_MSS_POSTD; ?>:</td>
				<td style="background-color: #ffffff;"><?php echo mosFormatDate($row->date_time, _GEM_DATE_FORMLC2); ?></td>
			</tr>
			<tr>
				<td><?php echo $adminLanguage->A_CMP_MSS_SUBJE; ?>:</td>
				<td style="background-color: #ffffff;"><strong><?php echo $row->subject; ?></strong></td>
			</tr>
			<tr>
				<td><?php echo $adminLanguage->A_CMP_MSS_MSSG; ?>:</td>
				<td style="background-color: #ffffff;"><?php echo htmlspecialchars( $row->message ); ?></td>
			</tr>
		</table>
		<input type="hidden" name="option" value="com_messages" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="1" />
		<input type="hidden" name="cid[]" value="<?php echo $row->message_id; ?>" />
		<input type="hidden" name="userid" value="<?php echo $row->user_id_from; ?>" />
		<input type="hidden" name="subject" value="Re: <?php echo $row->subject; ?>" />
		<input type="hidden" name="hidemainmenu" value="0" />
	</form>
<?php 
	}


	/****************************/
	/* HTML COMPOSE NEW MESSAGE */
	/****************************/
	static public function newMessage($recipientslist, $subject ) {
		global $my, $adminLanguage;
?>
		<script type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			//do field validation
			if (getSelectedValue('adminForm','user_id_to') < 1) {
				alert( "<?php echo $adminLanguage->A_CMP_MSS_APRVRE; ?>" );
			} else if (form.subject.value == "") {
				alert( "<?php echo $adminLanguage->A_CMP_MSS_APRVSB; ?>" );
			} else if (form.message.value == "") {
				alert( "<?php echo $adminLanguage->A_CMP_MSS_APRVME; ?>" );
			} else {
				submitform( pressbutton );
			}
		}
		</script>

		<table class="adminheading">
		<tr>
			<th class="outbox"><?php echo $adminLanguage->A_CMP_MSS_NEWPM; ?></th>
		</tr>
		</table>

		<form action="index2.php" method="post" name="adminForm">
			<table class="adminform">
			<tr>
				<td width="150"><?php echo $adminLanguage->A_CMP_MSS_TORCP; ?>:</td>
				<td><?php echo $recipientslist; ?></td>
			</tr>
			<tr>
				<td><?php echo $adminLanguage->A_CMP_MSS_SUBJE; ?>:</td>
				<td>
					<input type="text" name="subject" size="80" maxlength="100" class="inputbox" value="<?php echo $subject; ?>" />
				</td>
			</tr>
			<tr>
				<td><?php echo $adminLanguage->A_CMP_MSS_MSSG; ?>:</td>
				<td>
					<textarea name="message" style="width:90%" rows="20" class="text_area"></textarea>
				</td>
			</tr>
			</table>
			<input type="hidden" name="user_id_from" value="<?php echo $my->id; ?>" />
			<input type="hidden" name="option" value="com_messages" />
			<input type="hidden" name="task" value="" />
		</form>
<?php 
	}
}

?>