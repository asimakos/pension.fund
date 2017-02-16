<?php 
/**
* @version: $Id: admin.banners.html.php 55 2010-06-13 08:57:20Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Banners
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_banners {

	/*********************/
	/* HTML SHOW BANNERS */
	/*********************/
	static public function showBanners( &$rows, &$pageNav, $option, &$lists, $formfilters=array() ) {
		global $my, $adminLanguage, $mosConfig_live_site;

        mosCommonHTML::loadOverlib();
        $textdir = (_GEM_RTL == 1) ? 'right' : 'left';
		?>

        <script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_banners/bannersajax.js"></script>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="banner"><?php echo $adminLanguage->A_CMP_BANN_MANAGER; ?></th>
		</tr>
		</table>

   		<table class="adminlist">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
			<th align="<?php echo $textdir; ?>" nowrap="nowrap"><?php echo $adminLanguage->A_CMP_BANN_NAME; ?></th>
			<th align="<?php echo $textdir; ?>">
            <?php echo $adminLanguage->A_CMP_BANN_CLIENTNM; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectclient')">
            <?php 
            echo '<img src=';
            echo ($formfilters['filter_cid'] > 0) ? '"images/downarrow3.png" alt="'.$adminLanguage->A_FILTERED.'"' : '"images/downarrow2.png" alt="'.$adminLanguage->A_FILTER.'"';
            echo ' border="0" />';
            ?>
            </a>
            <div id="selectclient" style="display:none; position:absolute;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_FILTER; ?></div>
                <?php echo $lists['cid']; ?>
                <div class="filterbottom">
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selectclient');" style="color: #888888;"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			 </div>
            </th>
			<th><?php echo $adminLanguage->A_PUBLISH; ?></th>
			<th><?php echo $adminLanguage->A_CMP_BANN_IMPRESSMADE; ?></th>
			<th><?php echo $adminLanguage->A_CMP_BANN_IMPRESSLEFT; ?></th>
			<th><?php echo $adminLanguage->A_CMP_BANN_CLICKS; ?></th>
			<th><?php echo $adminLanguage->A_CMP_BANN_CLICKS2; ?></th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];

			$row->id = $row->bid;
			$link = 'index2.php?option=com_banners&task=editA&hidemainmenu=1&id='. $row->id;

   			$impleft = $row->imptotal - $row->impmade;

            if (intval($row->imptotal) == 0) {
                $impleft  = $adminLanguage->A_CMP_BANN_UNLIM;
            } else {
                $impleft = $row->imptotal - $row->impmade;
               	if( $impleft < 0 ) { $impleft  = '0'; }
            }

			if ($row->impmade != 0) {
				$percentClicks = substr(100 * $row->clicks/$row->impmade, 0, 5);
			} else {
				$percentClicks = 0;
			}

			$img = $row->showbanner ? 'publish_g.png' : 'publish_x.png';
			$alt = $row->showbanner ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;

			$checked = mosCommonHTML::CheckedOutProcessing( $row, $i );
			?>
			<tr class="row<?php echo $k; ?>">
		  		<td align="center" style="text-align:center;"><?php echo $pageNav->rowNumber( $i ); ?></td>
		 		<td align="center" style="text-align:center;"><?php echo $checked; ?></td>
		 		<td align="<?php echo $textdir; ?>">
				<?php
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
			  		echo $row->name;
				} else {
					?>
					<a href="<?php echo $link; ?>" title="<?php echo $adminLanguage->A_CMP_BANN_EDITBANNER; ?>">
						<?php echo $row->name; ?>
					</a>
					<?php
				}
				?>
				</td>
				<td><?php echo $row->client; ?></td>
				<td align="center" style="text-align:center;">
                    <div id="banstatus<?php echo $i; ?>">
					   <a href="javascript:void(0);" title="<?php echo $alt; ?>" 
                       onclick="changeBannerState('<?php echo $i; ?>', '<?php echo $row->bid; ?>', '<?php echo ($row->showbanner) ? 0 : 1; ?>');">
                       <img src="images/<?php echo $img; ?>" border="0" alt="<?php echo $alt; ?>" /></a>
                    </div>
				</td>
				<td align="center" style="text-align:center;"><?php echo $row->impmade; ?></td>
				<td align="center" style="text-align:center;"><?php echo $impleft; ?></td>
				<td align="center" style="text-align:center;"><?php echo $row->clicks; ?></td>
				<td align="center" style="text-align:center;"><?php echo $percentClicks; ?></td>
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


	/*****************************/
	/* HTML ADD/EDIT BANNER FORM */
	/*****************************/
	static public function bannerForm( &$_row, &$lists, $_option ) {
		global $adminLanguage;

		mosMakeHtmlSafe( $_row, ENT_QUOTES, 'custombannercode' );
		$textdir = (_GEM_RTL == 1) ? 'right' : 'left';
?>
		<script type="text/javascript">
		/* <![CDATA[ */
		function changeDisplayImage() {
			if (document.adminForm.imageurl.value !='') {
				document.adminForm.imagelib.src='../images/banners/' + document.adminForm.imageurl.value;
			} else {
				document.adminForm.imagelib.src='images/blank.png';
			}
		}
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			//do field validation
			if (form.name.value == "") {
				alert( "<?php echo $adminLanguage->A_CMP_BANN_PROVIDE; ?>" );
			} else if (getSelectedValue('adminForm','cid') < 1) {
				alert( "<?php echo $adminLanguage->A_CMP_BANN_SELCL; ?>" );
			} else if (!getSelectedValue('adminForm','imageurl')) {
				alert( "<?php echo $adminLanguage->A_CMP_BANN_SELECTIMAGE; ?>" );
			} else if (form.clickurl.value == "") {
				alert( "<?php echo $adminLanguage->A_CMP_BANN_FILLURL; ?>" );
			} else {
				submitform( pressbutton );
			}
		}
   		/* ]]> */
		</script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="banner">
				<?php echo $adminLanguage->A_CMP_BANN_BANNER; ?>: 
				<small><?php echo $_row->cid ? $adminLanguage->A_EDIT : $adminLanguage->A_NEW; ?></small>
			</th>
		</tr>
		</table>

		<table class="adminForm">
		<tr>
			<th colspan="2"><?php echo $adminLanguage->A_DETAILS; ?></th>
		</tr>
		<tr>
			<td width="20%"><?php echo $adminLanguage->A_CMP_BANN_NAME; ?>:</td>
			<td width="80%">
				<input type="text" name="name" class="inputbox" value="<?php echo $_row->name; ?>" />
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_CMP_BANN_BANCL; ?>:</td>
			<td align="<?php echo $textdir; ?>">
            	<?php echo $lists['cid']; ?>
            </td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_CMP_BANN_PURCSED; ?></td>
			<?php
            if ($_row->imptotal == "0") {
  				$unlimited = ' checked="checked"';
  		  		$_row->imptotal="";
			} else {
 		  		$unlimited = '';
			}
			?>
			<td>
            <input class="inputbox" type="text" dir="ltr" name="imptotal" size="12" maxlength="11" value="<?php echo $_row->imptotal; ?>" /> 
            <?php echo $adminLanguage->A_CMP_BANN_UNLIM; ?> 
            <input type="checkbox" name="unlimited"<?php echo $unlimited; ?> />
            </td>
		</tr>
		<tr>
			<td valign="top"><?php echo $adminLanguage->A_CMP_BANN_IMAGE; ?></td>
			<td align="<?php echo $textdir; ?>">
				<?php echo $lists['imageurl']; ?>
            </td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_CMP_BANN_SHOW; ?></td>
			<td>
				<?php echo $lists['showbanner']; ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_CMP_BANN_CURL; ?></td>
			<td>
				<input type="text" name="clickurl" dir="ltr" class="inputbox" size="50" maxlength="200" value="<?php echo $_row->clickurl; ?>" />
            </td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_CMP_BANN_TARG; ?></td>
			<td>
				<?php echo $lists['targetbanner']; ?>
			</td>
		</tr>
		<tr>
			<td valign="top"><?php echo $adminLanguage->A_CMP_BANN_CUST; ?></td>
			<td>
				<textarea class="text_area" dir="ltr" cols="70" rows="5" name="custombannercode"><?php echo $_row->custombannercode; ?></textarea>
            </td>
		</tr>
		<tr >
			<td valign="top" align="<?php echo (_GEM_RTL)? 'left' : 'right'; ?>">
				<?php echo $adminLanguage->A_CMP_BANN_CLICKS; ?><br />
				<input name="reset_hits" type="button" class="button" value="<?php echo $adminLanguage->A_CMP_BANN_RESET; ?>" onclick="submitbutton('resethits');">
			</td>
			<td colspan="2"><?php echo $_row->clicks; ?></td>
		</tr>
		<tr>
			<td colspan="3"></td>
		</tr>
		<tr>
        	<td valign="top"><?php echo $adminLanguage->A_CMP_BANN_IMAGE; ?></td>
			<td valign="top">
			<?php 
			if (preg_match("/swf/i", $_row->imageurl)) {
			?>
				<img src="images/blank.png" name="imagelib" alt="img" />
			<?php 
			} elseif (preg_match("/gif|jpg|png|jpeg/i", $_row->imageurl)) {
				?>
				<img src="../images/banners/<?php echo $_row->imageurl; ?>" name="imagelib" alt="banner" />
			<?php
			} else {
			?>
				<img src="images/blank.png" name="imagelib" alt="blank" />
			<?php 
			}
			?>
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $_option; ?>" />
		<input type="hidden" name="bid" value="<?php echo $_row->bid; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="impmade" value="<?php echo $_row->impmade; ?>" />
		</form>
		<?php
	}
}


class HTML_bannerClient {


	/*******************************/
	/* HTML DISPLAY BANNER CLIENTS */
	/*******************************/
	static public function showClients( &$rows, &$pageNav, $option ) {
		global $my, $adminLanguage;

		mosCommonHTML::loadOverlib();
		$textdir = (_GEM_RTL == 1) ? 'right' : 'left';
?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="banner"><?php echo $adminLanguage->A_CMP_BANN_CLMAN; ?></th>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20" align="center"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20">
            	<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
            </th>
			<th align="<?php echo $textdir; ?>"><?php echo $adminLanguage->A_CMP_BANN_CLIENTNM; ?></th>
			<th align="center"><?php echo $adminLanguage->A_CMP_BANN_CLIENTIDS; ?></th>
			<th align="<?php echo $textdir; ?>"><?php echo $adminLanguage->A_CONTACT; ?></th>
			<th align="center"><?php echo $adminLanguage->A_CMP_BANN_NOACT; ?></th>
		</tr>
        <?php 
        $k = 0;
        for ($i=0, $n=count( $rows ); $i < $n; $i++) {
            $row = &$rows[$i];

            $row->id = $row->cid;
            $link = 'index2.php?option=com_banners&task=editclientA&hidemainmenu=1&id='. $row->id;
            $checked = mosCommonHTML::CheckedOutProcessing( $row, $i );
            ?>
			<tr class="row<?php echo $k; ?>">
				<td align="center" style="text-align:center;"><?php echo $pageNav->rowNumber( $i ); ?></td>
				<td><?php echo $checked; ?></td>
				<td>
				<?php 
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					echo $row->name;
				} else {
				?>
					<a href="<?php echo $link; ?>" title="<?php echo $adminLanguage->A_EDIT; ?>"><?php echo $row->name; ?></a>
				<?php
				}
				?>
				</td>
				<td align="center" style="text-align:center;"><?php echo $row->cid; ?></td>
				<td><?php echo $row->contact; ?></td>
				<td align="center" style="text-align:center;"><?php echo $row->bid; ?></td>
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


	/*******************************/
	/* HTML ADD/EDIT BANNER CLIENT */
	/*******************************/
	static public function bannerClientForm( &$row, $option ) {
        global $adminLanguage;

		mosMakeHtmlSafe( $row, ENT_QUOTES, 'extrainfo' );
?>
		<script type="text/javascript">
		<!--
		function submitbutton(pressbutton) {
			var form = document.adminForm;
	   		if (pressbutton == 'cancelclient') {
		  		submitform( pressbutton );
		  		return;
			}
			//do field validation
			if (form.name.value == "") {
				alert( "<?php echo $adminLanguage->A_CMP_BANN_FCLNA; ?>" );
			} else if (form.contact.value == "") {
				alert( "<?php echo $adminLanguage->A_CMP_BANN_FCONA; ?>" );
			} else if (form.email.value == "") {
				alert( "<?php echo $adminLanguage->A_CMP_BANN_FCOEM; ?>" );
			} else {
				submitform( pressbutton );
			}
		}
		//-->
		</script>

		<table class="adminheading">
		<tr>
			<th class="banner">
				<?php echo $adminLanguage->A_CMP_BANN_BANCL; ?>: 
				<small><?php echo $row->cid ? $adminLanguage->A_EDIT : $adminLanguage->A_NEW;?></small>
			</th>
		</tr>
		</table>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminForm">
		<tr>
			<th colspan="2"><?php echo $adminLanguage->A_DETAILS; ?></th>
		</tr>
		<tr>
			<td width="20%"><?php echo $adminLanguage->A_CMP_BANN_CLIENTNM; ?>:</td>
			<td>
            	<input type="text" name="name" class="inputbox" size="30" maxlength="60" value="<?php echo $row->name; ?>" />
            </td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_CMP_BANN_CONA; ?>:</td>
			<td>
            	<input type="text" name="contact" class="inputbox" size="30" maxlength="60" value="<?php echo $row->contact; ?>" />
            </td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_CMP_BANN_COEM; ?>:</td>
			<td>
            	<input type="text" name="email" dir="ltr" class="inputbox" size="30" maxlength="60" value="<?php echo $row->email; ?>" />
            </td>
		</tr>
		<tr>
			<td valign="top"><?php echo $adminLanguage->A_CMP_BANN_EXTRA; ?>:</td>
			<td>
            	<textarea name="extrainfo" class="text_area" cols="60" rows="10"><?php echo str_replace('&','&amp;',$row->extrainfo); ?></textarea>
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="cid" value="<?php echo $row->cid; ?>" />
		<input type="hidden" name="task" value="" />
		</form>
<?php 
	}
}
?>