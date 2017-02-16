<?php
/**
* @version: 1.6
* @package: Component AkForms
* @author: Andrew Campoball
* @email: ACampball@yandex.ru
* @link:
* @license: GPL
* @copyright: (C) 2009 Andrew Campball. All rights reserved.
* @description: AkForms component for Elxis CMS.
*****************************************************************************/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class akFormsHTML {

	static public function listForms( $submitted, $saved ) {
		global $formclass, $Itemid, $formclass;

    	if ( $_SESSION["botAkFormMSG"] ) {
	    	echo '<div class="message">'.$_SESSION["botAkFormMSG"].'</div>';
	    	 $_SESSION["botAkFormMSG"] = '';
	    }

?>

		<table width="100%" border="0" class="akftable">
			<tr>
				<th><?php echo $formclass->lng->SUBMITTED_FORMS; ?></th>
				<th><?php echo $formclass->lng->SAVED_FORMS; ?></th>
			</tr>
			<tr>
				<td width="50%" valign="top">
					<table border="0" width="100%" cellspacing="0">
<?php
					foreach ($submitted as $row) {						$linkView = $formclass->secureURL(sefRelToAbs('index.php?option=com_akforms&Itemid='.$Itemid.'&task=view&id='.$row->id));
?>
					<tr>
						<td><?php echo $row->name; ?> <span class="akfsmall">(<?php echo $row->post_date; ?>)</span></td>
						<td width="18" style="text-align:center;">
							<a href="<?php echo $linkView; ?>" title="<?php echo $formclass->lng->_VIEW; ?>">
								<img src="/images/M_images/con_info.png" alt="" />
							</a>
						</td>
					</tr>
		<?php
					}
		?>
					</table>
				</td>
				<td width="50%" valign="top">
					<table border="0" width="100%" cellspacing="0">
<?php
					foreach ($saved as $row) {
						$linkEdit = $formclass->secureURL(sefRelToAbs('index.php?option=com_akforms&Itemid='.$Itemid.'&task=edit&id='.$row->id));
						$linkDelete = $formclass->secureURL(sefRelToAbs('index.php?option=com_akforms&Itemid='.$Itemid.'&task=delete&id='.$row->id));
?>
					<tr>
						<td><?php echo $row->name; ?> <span class="akfsmall">(<?php echo $row->post_date; ?>)</span></td>
						<td width="38" style="text-align:center;">
							<a href="<?php echo $linkEdit; ?>" title="<?php echo $formclass->lng->_EDIT; ?>">
								<img src="/images/M_images/edit.png" alt="" />
							</a>
							<a href="<?php echo $linkDelete; ?>" title="<?php echo $formclass->lng->_DELETE; ?>" onclick="return confirm('<?php echo $formclass->lng->CONFIRM_DELETE; ?>');">
								<img src="/images/M_images/delete.png" alt="" />
							</a>
						</td>
					</tr>
		<?php
					}
		?>
					</table>
				</td>
			</tr>
		</table>
		<?php
	}

	static public function showValue($rows, $lists) {
		global $formclass, $mainframe, $Itemid;

		$linkBack = $formclass->secureURL(sefRelToAbs('index.php?option=com_akforms&Itemid='.$Itemid));

?>
		<div class="back_button"><a href="<?php echo $linkBack; ?>" title="<?php echo _BACK; ?>"><?php echo _BACK; ?></a></div>

		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="akftable">
		<tr>
			<th colspan="2"><?php echo $formclass->lng->A_DATA; ?></th>
		</tr>
		<?php
		$k = 0;
		foreach ($rows as $row) {
		?>
		<tr class="row<?php echo $k; ?>">
        	<td nowrap="nowrap" valign="top"><?php echo $row->field_label; ?></td>
        	<td>
        	<?php
        		if ($row->field_type == 'file') {
        			$files = explode('|', $row->post_value);
					$link = 'index2.php?option=com_akforms&task=download&file='.$files[0].'&name='.$files[1];
					echo '<a href="'.$link.'" title="">'.$files[1].'</a>';
        		} else {
	        		echo $row->post_value;
	        	}
        	?>
        	</td>
        </tr>
        <?php
        	$k = 1 - $k;
        }
        ?>
        </table>
<?php
	}

	static public function editValue($row ) {
		global $formclass, $mainframe;

		$linkBack = $formclass->secureURL(sefRelToAbs('index.php?option=com_akforms&Itemid='.$Itemid));

?>
		<div class="back_button"><a href="<?php echo $linkBack; ?>" title="<?php echo _BACK; ?>"><?php echo _BACK; ?></a></div>

		<div>
			<?php echo $row->text; ?>
        </div>
<?php
	}

}

?>