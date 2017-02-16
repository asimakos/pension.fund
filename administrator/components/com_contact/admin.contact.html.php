<?php 
/**
* @version: $Id: admin.contact.html.php 55 2010-06-13 08:57:20Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Contact
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_contact {


	/**********************/
	/* HTML SHOW CONTACTS */
	/**********************/
	static public function showContacts( &$rows, &$pageNav, $search, $option, &$lists, $formfilters=array() ) {
		global $my, $adminLanguage;

		mosCommonHTML::loadOverlib();
		$align = (_GEM_RTL) ? 'right' : 'left';
?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="contact"><?php echo $adminLanguage->A_CMP_CCT_MNGER; ?></th>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_FILTER; ?>:</td>
			<td>
				<input type="text" name="search" value="<?php echo $search; ?>" class="inputbox" onchange="document.adminForm.submit();" />
			</td>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20" class="title">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
			</th>
			<th class="title"><?php echo $adminLanguage->A_NAME; ?></th>
			<th><?php echo $adminLanguage->A_PUBLISHED; ?></th>
			<th colspan="2"><?php echo $adminLanguage->A_REORDER; ?></th>
			<th align="<?php echo $align; ?>">
			<?php echo $adminLanguage->A_CATEGORY; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectcategory')">
            <?php 
            echo '<img src=';
            echo ($formfilters['catid'] > 0) ? '"images/downarrow3.png" title="'.$adminLanguage->A_FILTERED.'"' : '"images/downarrow2.png" title="'.$adminLanguage->A_FILTER.'"';
            echo ' border="0" />';
            ?>
            </a>
            <div id="selectcategory" style="display:none; position:absolute;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_FILTERCATEGORY; ?></div>
                <?php echo $lists['catid'];?>
                <div class="filterbottom">
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selectcategory');" style="color: #888888;"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			</div>
			</th>
			<th class="title"><?php echo $adminLanguage->A_LINKTOUSER; ?></th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$link = 'index2.php?option=com_contact&task=editA&hidemainmenu=1&id='. $row->id;
			$img = $row->published ? 'tick.png' : 'publish_x.png';
			$task = $row->published ? 'unpublish' : 'publish';
			$alt = $row->published ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
			$checked = mosCommonHTML::CheckedOutProcessing( $row, $i );
			$row->cat_link 	= 'index2.php?option=com_categories&section=com_contact_details&task=editA&hidemainmenu=1&id='. $row->catid;
			$row->user_link	= 'index2.php?option=com_users&task=editA&hidemainmenu=1&id='. $row->user_id;
			?>
			<tr class="row<?php echo $k; ?>">
				<td><?php echo $pageNav->rowNumber( $i ); ?></td>
				<td><?php echo $checked; ?></td>
				<td><?php
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					echo $row->name;
				} else {
					?>
					<a href="<?php echo $link; ?>" title="<?php echo $adminLanguage->A_CMP_CCT_EDITCT; ?>"><?php echo $row->name; ?></a>
				<?php 
				}
				?></td>
				<td align="center" style="text-align:center;">
				<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')" title="<?php echo $alt; ?>">
				<img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" /></a></td>
				<td align="<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>"><?php echo $pageNav->orderUpIcon( $i, ( $row->catid == @$rows[$i-1]->catid ) ); ?></td>
				<td align="<?php echo $align; ?>"><?php echo $pageNav->orderDownIcon( $i, $n, ( $row->catid == @$rows[$i+1]->catid ) ); ?></td>
				<td>
					<a href="<?php echo $row->cat_link; ?>" title="<?php echo $adminLanguage->A_CMP_CCT_EDITCAT; ?>"><?php echo $row->category; ?></a>
				</td>
				<td>
                	<a href="<?php echo $row->user_link; ?>" title="<?php echo $adminLanguage->A_EDITUSER; ?>"><?php echo $row->user; ?></a>
                </td>
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


	/*************************/
	/* HTML ADD/EDIT CONTACT */
	/*************************/
	static public function editContact( &$row, &$lists, $option, &$params ) {
		global $mosConfig_live_site, $adminLanguage;

		if ($row->image == '') {
			$row->image = 'blank.png';
		}

		$tabs = new mosTabs(0);

		mosMakeHtmlSafe( $row, ENT_QUOTES, 'misc' );
		mosCommonHTML::loadOverlib();
?>
		<script type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			//do field validation
			if ( form.name.value == "" ) {
				alert( "<?php echo $adminLanguage->A_ALERT_VALIDATE_NAME; ?>" );
			} else if (trim(form.seotitle.value) == ""){
                alert( "<?php echo $adminLanguage->A_SEOTEMPTY; ?>" );
			} else if ( form.catid.value == 0 ) {
				alert( "<?php echo $adminLanguage->A_PLSSELECTCAT; ?>" );
			} else {
				submitform( pressbutton );
			}
		}
		
		function gotouser( id ) {
			var form = document.adminForm;
			form.id.value = id;
			submitform( 'user' );
		}
		</script>
		<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_contact/contactajax.js"></script>

		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th class="contact"><?php echo $adminLanguage->A_CONTACT; ?>: 
            <small><?php echo $row->id ? $adminLanguage->A_EDIT : $adminLanguage->A_NEW;?></small>
			</th>
		</tr>
		</table>

		<table width="100%">
		<tr>
			<td width="60%" valign="top">
				<table width="100%" class="adminform">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_CMP_CCT_DETAILS; ?></th>
				<tr>
				<tr>
					<td width="30%"><?php echo $adminLanguage->A_CATEGORY; ?>:</td>
					<td><?php echo $lists['catid']; ?></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_LINKTOUSER; ?>:</td>
					<td><?php echo $lists['user_id']; ?></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_NAME; ?>:</td>
					<td><input class="inputbox" type="text" name="name" size="50" maxlength="100" value="<?php echo $row->name; ?>" /></td>
				</tr>
                <tr>
                    <td valign="top"><?php echo $adminLanguage->A_SEOTITLE; ?>:</td>
                    <td>
                        <input name="seotitle" id="seotitle" type="text" dir="ltr" class="inputbox" value="<?php echo $row->seotitle; ?>" size="30" maxlength="100" />
                        <?php echo mosToolTip($adminLanguage->A_SEOTHELP); ?><br />
                        <a href="javascript:void(null);" onclick="suggestContactSEO()"><?php echo $adminLanguage->A_SEOTSUG; ?></a> &nbsp; | &nbsp; 
                        <a href="javascript:void(null);" onclick="validateContactSEO()"><?php echo $adminLanguage->A_SEOTVAL; ?></a><br />
                        <div id="valseo" style="height: 20px;"></div>
                    </td>
                </tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_CCT_PSITION; ?>:</td>
					<td><input class="inputbox" type="text" name="con_position" size="50" maxlength="50" value="<?php echo $row->con_position; ?>" /></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_EMAIL; ?>:</td>
					<td><input class="inputbox" type="text" name="email_to" dir="ltr" size="50" maxlength="100" value="<?php echo $row->email_to; ?>" /></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_CCT_STRET; ?>:</td>
					<td><input class="inputbox" type="text" name="address" size="50" value="<?php echo $row->address; ?>" /></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_CCT_TOWN; ?>:</td>
					<td><input class="inputbox" type="text" name="suburb" size="50" maxlength="50" value="<?php echo $row->suburb;?>" /></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_CCT_STATE; ?>:</td>
					<td><input class="inputbox" type="text" name="state" size="50" maxlength="20" value="<?php echo $row->state;?>" /></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_CCT_COUNTRY; ?>:</td>
					<td><input class="inputbox" type="text" name="country" size="50" maxlength="50" value="<?php echo $row->country;?>" /></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_CCT_ZIP; ?>:</td>
					<td><input class="inputbox" type="text" dir="ltr" name="postcode" size="25" maxlength="10" value="<?php echo $row->postcode; ?>" /></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_CCT_PHONE; ?>:</td>
					<td><input class="inputbox" type="text" dir="ltr" name="telephone" size="25" maxlength="25" value="<?php echo $row->telephone; ?>" /></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_CCT_FAX; ?>:</td>
					<td><input class="inputbox" type="text" dir="ltr" name="fax" size="25" maxlength="25" value="<?php echo $row->fax; ?>" /></td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_CMP_CCT_MISINFO; ?>:</td>
					<td><textarea name="misc" rows="5" cols="50" class="text_area"><?php echo $row->misc; ?></textarea></td>
				</tr>
				<tr>
				</table>

			</td>
			<td width="40%" valign="top">
				<?php
				$tabs->startPane("content-pane");
				$tabs->startTab($adminLanguage->A_PUBLISHING,"publish-page");
				?>
				<table width="100%" class="adminform">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_PUBLISHINGINFO; ?></th>
				<tr>
				<tr>
					<td width="20%" align="right"><?php echo $adminLanguage->A_CMP_CCT_SITDEFT; ?>:</td>
					<td><?php echo $lists['default_con']; ?></td>
				</tr>
				<tr>
					<td valign="top" align="right"><?php echo $adminLanguage->A_PUBLISHED; ?>:</td>
					<td><?php echo $lists['published']; ?></td>
				</tr>
				<tr>
					<td valign="top" align="right"><?php echo $adminLanguage->A_ORDERING; ?>:</td>
					<td><?php echo $lists['ordering']; ?></td>
				</tr>
				<tr>
					<td valign="top" align="right"><?php echo $adminLanguage->A_ACCESS; ?>:</td>
					<td><?php echo $lists['access']; ?></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				</table>
				<?php
				$tabs->endTab();
				$tabs->startTab($adminLanguage->A_IMAGES,"images-page");
				?>
				<table width="100%" class="adminform">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_IMAGEINFO; ?></th>
				<tr>
				<tr>
					<td align="left" width="20%"><?php echo $adminLanguage->A_IMAGE; ?>:</td>
					<td align="left"><?php echo $lists['image']; ?></td>
				</tr>
				<tr>
					<td></td>
					<td>
					<script language="javascript" type="text/javascript">
					if (document.forms[0].image.options.value!=''){
						jsimg='../images/stories/' + getSelectedValue( 'adminForm', 'image' );
					} else {
						jsimg='../images/M_images/blank.png';
					}
					document.write('<img src=' + jsimg + ' name="imagelib" width="100" height="100" border="2" alt="<?php echo $adminLanguage->A_PREVIEW; ?>" />');
					</script>
					</td>
				</tr>
				</table>
				<?php
				$tabs->endTab();
				$tabs->startTab($adminLanguage->A_PARAMETERS,"params-page");
				?>
				<table class="adminform">
				<tr>
					<th><?php echo $adminLanguage->A_PARAMETERS; ?></th>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_CCT_PARAM; ?><br /><br /></td>
				</tr>
				<tr>
					<td><?php echo $params->render(); ?></td>
				</tr>
				</table>
				<?php
				$tabs->endTab();
				$tabs->startTab($adminLanguage->A_EXTRAFIELDS, "extra-page");
                ?>
                <table class="adminform">
				<tr>
					<th><?php echo $adminLanguage->A_EXTRAFIELDS; ?></th>
				</tr>
				<tr>
					<td><?php 
                        if (eUTF::utf8_trim($lists['extra']) !== '') {
                            echo $lists['extra'];
                    ?>
					<br /><br />
					<input class="button" type="button" value="<?php echo $adminLanguage->A_CMP_CCT_CHEXTRA; ?>" onclick="javascript: gotouser( '<?php echo $row->user_id; ?>' )">
                    <?php 
                        } else {
                            echo $adminLanguage->A_CMP_CCT_NOEXTRA;
                        }
                        ?>
                    </td>
				</tr>
                </table>
                <?php 
                $tabs->endTab();
				$tabs->endPane();
				?>
			</td>
		</tr>
		</table>

		<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/includes/js/overlib_mini.js"></script>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="id" value="<?php echo intval($row->id); ?>" />
		<input type="hidden" name="task" value="" />
		</form>
<?php 
	}
}
?>