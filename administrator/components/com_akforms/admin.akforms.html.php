<?php
/**
* @version: 1.7
* @package: Component AkForms
* @author: Andrew Campball
* @email: ACampball@yandex.ru
* @link:
* @license: Not for resale
* @copyright: (C) 2009 Andrew Campball. All rights reserved.
* @description: AkForms component for Elxis CMS.
*****************************************************************************/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


class akFormsHTML {

	/**********************/
	/* SHOW CONTROL PANEL */
	/**********************/
	static public function controlpanel() {
		global $akforms, $adminLanguage, $alang, $mainframe;

		$dir = _GEM_RTL ? 'right' : 'left';
		$linkstyle = "background: transparent url('".$mainframe->getCfg('absolute_path')."/administrator/images/asterisk.png') top ".$dir." no-repeat;";
		$linkstyle .= " padding-".$dir.": 42px; color: #517633; font-size: 24px; text-decoration: none;";

		$picstitle = eUTF::utf8_strtoupper(eUTF::utf8_substr($pedigree->lng->PICTURES, 0, 1)).eUTF::utf8_substr($pedigree->lng->PICTURES, 1);
?>
		<table class="adminheading">
		<tr>
			<td width="550">
				<img src="<?php echo $akforms->aurl; ?>/images/forms48.png" align="center">
				<span style="color: #ff8f00; font-size: 24px; text-decoration: none;">akForms</span>
			</td>
			<td rowspan="2" valign="top">
				<table class="rescpanel" cellspacing="0" cellpadding="0" border="0" width="100%">
					<tr>
						<td valign="top">
							<?php if (!$akforms->bot_installed) {
								echo '<div class="message">'.$akforms->lng->BOT_NOTIFY.'</div>';
							} ?>
							<div class="rescpanel">
								<div class="rescbox">
									<div class="resctitle"><?php echo $adminLanguage->A_MENU_CONFIGURATION; ?></div>
									<a title="<?php echo $adminLanguage->A_MENU_CONFIGURATION; ?>" href="index2.php?option=com_akforms&amp;task=config&amp;hidemainmenu=1">
										<img border="0" alt="<?php echo $adminLanguage->A_MENU_CONFIGURATION; ?>" src="<?php echo $akforms->aurl; ?>/images/config64.png"/>
									</a>
								</div>
							</div>
							<div class="rescpanel">
								<div class="rescbox">
									<div class="resctitle"><?php echo $akforms->lng->A_FORMS; ?></div>
									<a title="<?php echo $akforms->lng->A_FORMS; ?>" href="index2.php?option=com_akforms&amp;task=forms">
										<img border="0" alt="<?php echo $akforms->lng->A_FORMS; ?>" src="<?php echo $akforms->aurl; ?>/images/forms64.png"/>
									</a>
								</div>
							</div>
							<div class="rescpanel">
								<div class="rescbox">
									<div class="resctitle"><?php echo $akforms->lng->A_FIELDS; ?></div>
									<a title="<?php echo $akforms->lng->A_FIELDS; ?>" href="index2.php?option=com_akforms&amp;task=fields">
										<img border="0" alt="<?php echo $akforms->lng->A_FIELDS; ?>" src="<?php echo $akforms->aurl; ?>/images/fields64.png"/>
									</a>
								</div>
							</div>
							<div class="rescpanel">
								<div class="rescbox">
									<div class="resctitle"><?php echo $akforms->lng->A_DATA; ?></div>
									<a title="<?php echo $akforms->lng->A_FIELDS; ?>" href="index2.php?option=com_akforms&amp;task=data">
										<img border="0" alt="<?php echo $akforms->lng->A_DATA; ?>" src="<?php echo $akforms->aurl; ?>/images/data64.png"/>
									</a>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<?php
				if (file_exists($akforms->apath.'/includes/intro_'.$alang.'.php')) {
					include($akforms->apath.'/includes/intro_'.$alang.'.php');
				} else {
					include($akforms->apath.'/includes/intro_russian.php');
				}
				?>
			</td>
		</tr>
		</table>
		<br />
<?php
	}

	/***************************/
	/* HTML CONFIGURATION FORM */
	/***************************/
	static public function showconfig($lists) {
		global $pedigree, $adminLanguage, $mainframe, $akforms;

		mosCommonHTML::loadOverlib();

		$folder_files = $akforms->cfg->get('GFFOLDER_FILES');
		if ( empty($folder_files) ) $folder_files = '/components/com_akforms/files';

		$isWrite = is_writable( $mainframe->getCfg('absolute_path').$folder_files ) ? '<span style="font-weight: bold; color: green;">'._GEM_WRITABLE.'</span>' : '<span style="font-weight: bold; color: red;">'._GEM_UNWRITABLE.'</span>';

?>

		<form name="adminForm" action="index3.php" method="post">
		<table class="adminheading">
		<tr>
			<th style="<?php self::thstyle(); ?>"><?php echo $adminLanguage->A_MENU_CONFIGURATION; ?></th>
		</tr>
		</table>

		<table class="adminlist">
		<tr><th colspan="2"><?php echo $akforms->lng->GENERALSETS; ?></th></tr>
		<tr class="row0">
			<td><?php echo $akforms->lng->FOLDER_FILES; ?></td>
			<td>
				<input type="text" name="CFG_FOLDER_FILES" dir="ltr" value="<?php echo $folder_files; ?>" size="60" class="inputbox" />&nbsp;<?php echo $isWrite; ?>&nbsp;<input type="checkbox" name="create_folder" id="create_folder" value="1" /><label for="create_folder"><?php echo $akforms->lng->CREATE_FOLDER_FILES; ?></label>
			</td>
		</tr>
		<tr class="row1">
			<td><?php echo $akforms->lng->CFG_MAXFILESIZE; ?></td>
			<td>
				<input type="text" name="CFG_MAXFILESIZE" dir="ltr" value="<?php echo $akforms->cfg->get('GFMAXFILESIZE'); ?>" size="10" maxlength="10" class="inputbox" />&nbsp;kb
				<?php echo mosToolTip($akforms->lng->CFG_MAXFILESIZED); ?>
			</td>
		</tr>
		<tr class="row0">
			<td><?php echo $akforms->lng->CFG_EXPIRE; ?></td>
			<td>
				<?php echo $lists['expire_day']; ?>
				<?php echo mosToolTip($akforms->lng->CFG_EXPIRE_D, $akforms->lng->CFG_EXPIRE); ?>
			</td>
		</tr>
		<tr class="row11">
			<td>SSL/TLS</td>
			<td>
				<?php echo mosHTML::yesnoRadioList('CFG_SSL', '', $akforms->cfg->get('SSL', 0)); ?>
			</td>
		</tr>
		<tr class="row0">
			<td><?php echo $akforms->lng->SHOWCOPYRIGHT; ?></td>
			<td><span dir="ltr">
				<?php echo mosHTML::yesnoRadioList('CFG_COPYRIGHT', '',$akforms->cfg->get('COPYRIGHT', 0)); ?>
				</span>
				<?php echo mosToolTip($akforms->lng->SHOWCOPYRIGHTD); ?>
			</td>
		</tr>
		</table>

        <input type="hidden" name="option" value="com_akforms" />
        <input type="hidden" name="task" value="" />
    	</form>
<?php
	}

	/************************/
	/* HTML LIST FORMS      */
	/************************/
	static public function listForms($rows, $lists, $pageNav) {
		global $adminLanguage, $akforms;

		$textdir = (_GEM_RTL == 1) ? 'right' : 'left';
?>
		<script type="text/javascript">
			function getValues(objName) {
		        var arr = new Array();
		        var ret = '';
        		arr = document.getElementsByName(objName);
		        for(var i = 0; i < arr.length; i++) {
            		var obj = document.getElementsByName(objName).item(i);
            		if (obj.checked) ret = ret + ',' + obj.value;
			    }
			    return ret;
			}


			function submitbackup(pressbutton){
			getValues('cid[]');


				document.backupForm.task.value = pressbutton;
				document.backupForm.tid.value  = getValues('cid[]');
				try {
					document.backupForm.onsubmit();
				}
				catch(e){}
				document.backupForm.submit();
			}
		</script>
		<table class="adminheading">
			<tr>
				<th style="<?php self::thstyle(); ?>"><?php echo $akforms->lng->A_FORMS; ?></th>
			</tr>
		</table>
		<table class="adminheading">
			<tr>
				<td align="right">
		            <form action="index2.php" method="post" name="backupForm">
						<a class="toolbar" style="float:right;" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_TO.' '.$akforms->lng->EXPORT_FORM; ?>');}else{submitbackup('export')}" title="<?php echo $akforms->lng->EXPORT_FORM; ?>"><img src="<?php echo $akforms->aurl; ?>/images/export_f2.png" alt="" border="0" onmouseover="this.src='<?php echo $akforms->aurl; ?>/images/export.png';" onmouseout="this.src='<?php echo $akforms->aurl; ?>/images/export_f2.png';" /><br/><div><?php echo $akforms->lng->EXPORT_FORM; ?></div></a>
						<a class="toolbar" style="float:right;" href="index2.php?option=com_akforms&task=import&hidemainmenu=1" title="<?php echo $akforms->lng->IMPORT_FORM; ?>"><img src="<?php echo $akforms->aurl; ?>/images/import_f2.png" alt="" border="0" onmouseover="this.src='<?php echo $akforms->aurl; ?>/images/import.png';" onmouseout="this.src='<?php echo $akforms->aurl; ?>/images/import_f2.png';" /><br/><div><?php echo $akforms->lng->IMPORT_FORM; ?></div></a>
            	    	<input type="hidden" name="option" value="com_akforms" />
		        	    <input type="hidden" name="task" value="" />
		        	    <input type="hidden" name="tid" value="" />
		            </form>
				</td>
			</tr>
		</table>

		<form action="index2.php" method="post" name="adminForm" id="adminForm">
		<table class="adminlist">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20">
                <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
			</th>
			<th class="title"><?php echo $akforms->lng->A_NAME; ?></th>
			<th class="title"><?php echo $akforms->lng->A_DESCRIPTION; ?></th>
			<th width="5%"><?php echo $adminLanguage->A_PUBLISHED; ?></th>
			<th width="5%"><?php echo $adminLanguage->A_CID; ?></th>
			<th><?php echo $akforms->lng->A_FIELDS; ?></th>
			<th><?php echo $akforms->lng->A_DATA; ?></th>
		</tr>
<?php
		$k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$link = 'index2.php?option=com_akforms&task=editform&id='.$row->id.'&hidemainmenu=1';
			$fields = 'index2.php?option=com_akforms&task=fields&fid='.$row->id;
			$values = 'index2.php?option=com_akforms&task=data&fid='.$row->id;

			$task = $row->published ? 'unpublishform' : 'publishform';
			$img = $row->published ? 'publish_g.png' : 'publish_x.png';
			$alt = $row->published ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
?>
			<tr class="row<?php echo $k; ?>">
				<td align="center"><?php echo $i + 1 + $pageNav->limitstart; ?></td>
				<td><input type="checkbox" id="cb<?php echo $i; ?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>
				<td nowrap="nowrap">
					<a href="<?php echo $link; ?>" title="<?php echo $adminLanguage->A_EDIT; ?>"><?php echo $row->name; ?></a>
				</td>
				<td align="left"><?php echo $row->description; ?></td>
				<td align="center" style="text-align:center;">
                	<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i; ?>','<?php echo $task; ?>')" title="<?php echo $alt; ?>">
                	<img src="images/<?php echo $img; ?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" /></a>
				</td>
				<td align="center" style="text-align:center;"><?php echo $row->id; ?></td>
				<td nowrap="nowrap" width="20">
					<a href="<?php echo $fields; ?>" title="<?php echo $adminLanguage->A_EDIT; ?>"><?php echo $adminLanguage->A_EDIT; ?></a>
				</td>
				<td nowrap="nowrap" width="20">
					<a href="<?php echo $values; ?>" title="<?php echo $akforms->lng->A_DATA; ?>"><?php echo $akforms->lng->A_DATA; ?></a>
				</td>
			</tr>
<?php
			$k = 1 - $k;
		}
?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="com_akforms" />
		<input type="hidden" name="task" value="forms" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
<?php
	}

	/*******************************/
	/* HTML FORM ADD/EDIT FORM     */
	/*******************************/
	static public function editForm($row, $lists) {
		global $akforms, $adminLanguage, $mainframe;

		$thtitle = $akforms->lng->A_FORMS.': '.($row->id ? $adminLanguage->A_EDIT : $adminLanguage->A_NEW);
		mosCommonHTML::loadOverlib();

		$_lang = $mainframe->getCfg('lang');
		$pub_lang = explode(',', $mainframe->getCfg('pub_langs'));

		$tabs = new mosTabs(0);
?>
		<script type="text/javascript">
		var newgroup = -1;
		function submitbutton(pressbutton, section) {
			var form = document.adminForm;
			if (pressbutton == 'cancelform') {
				submitform(pressbutton);
				return;
			}

			if (form.name.value == "") {
				alert("<?php echo $akforms->lng->EMSG_EMPTY_NAME; ?>");
				form.name.focus();
			} else {
				submitform(pressbutton);
			}
		}
		jQuery(document).ready(function() {
			jQuery('#grouptable #delgroup').live('click', function() {
				jQuery(this).parent().parent().remove();
			});
			jQuery('#newgroup').click(function() {
				var tr = jQuery('<tr>').append('<td><input class="inputbox" type="text" name="groups[' + newgroup + '][title]" size="90" value="" /></td>')
					.append('<td><input type="radio" name="groups[' + newgroup + '][title_in_value]" value="0" checked="checked" class="inputbox" /><?php echo $adminLanguage->A_NO; ?><input type="radio" name="groups[' + newgroup + '][title_in_value]" value="1"  /><?php echo $adminLanguage->A_YES; ?></td>')
					.append('<td><input type="radio" name="groups[' + newgroup + '][filter_in_value]" value="0" checked="checked" class="inputbox" /><?php echo $adminLanguage->A_NO; ?><input type="radio" name="groups[' + newgroup + '][filter_in_value]" value="1" /><?php echo $adminLanguage->A_YES; ?></td>')
					.append('<td><a href="javascript:void(0);" id="delgroup"><?php echo $akforms->lng->FORM_GROUP_DELETE; ?></a></td>');
				jQuery('#grouptable').append(tr);
				newgroup = newgroup - 1;
			});
		});
		</script>

		<form action="index3.php" method="post" name="adminForm" enctype="multipart/form-data">
		<table class="adminheading">
			<tr>
				<th style="<?php self::thstyle(); ?>"><?php echo $thtitle; ?></th>
			</tr>
		</table>

		<?php
			$tabs->startPane("desc-pane");
			$tabs->startTab($adminLanguage->A_DETAILS, "detail-page" );
		?>
		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
		<tr>
			<th colspan="2"><?php echo $adminLanguage->A_DETAILS; ?></th>
		</tr>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->A_NAME.' - <b>'.ucwords($_lang).'</b>'; ?></td>
        	<td><input class="inputbox" type="text" name="name" size="60" value="<?php echo $row->name; ?>" /></td>
        </tr>
		<?php
		$langname = $lists['title'];
        foreach ($pub_lang as $plang) {
        	if ( $plang != $_lang) {
        ?>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->A_NAME.' - '.ucwords($plang); ?></td>
        	<td><input class="inputbox" type="text" name="langname[<?php echo $plang; ?>]" size="60" value="<?php echo $langname[$plang]->label; ?>" /></td>
        </tr>
        <?php
        	}
        } ?>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->A_EMAILS; ?></td>
        	<td><input class="inputbox" type="text" name="emails" size="60" value="<?php echo $row->emails; ?>" />
        	<?php echo mosToolTip($akforms->lng->A_EMAILSD, $akforms->lng->A_EMAILS); ?>
        	</td>
        </tr>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->A_DESCRIPTION; ?></td>
        	<td><input class="inputbox" type="text" name="description" size="60" maxlen="250" value="<?php echo $row->description; ?>" /></td>
        </tr>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->SEND_COPY; ?></td>
        	<td><?php echo mosHTML::yesnoRadioList('send_copy', '', $row->send_copy ); ?></td>
        </tr>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->SAVE_POSTED_DATA; ?></td>
        	<td><?php echo mosHTML::yesnoRadioList('save_post_data', '', $row->save_post_data ); ?></td>
        </tr>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->ALLOW_SAVE_FORM; ?></td>
        	<td><?php echo mosHTML::yesnoRadioList('allow_save_form', '', $row->allow_save_form ); ?></td>
        </tr>

		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->ALLOW_SEE_SAVEDATA; ?></td>
        	<td><?php echo mosHTML::yesnoRadioList('allow_see_savedata', '', $row->allow_see_savedata ); ?></td>
        </tr>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->ALLOW_SEE_SENDDATA; ?></td>
        	<td><?php echo mosHTML::yesnoRadioList('allow_see_senddata', '', $row->allow_see_senddata ); ?></td>
        </tr>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->ALLOW_SEND_REPEATLY; ?></td>
        	<td><?php echo mosHTML::yesnoRadioList('allow_submit_repeatly', '', $row->allow_submit_repeatly ); ?></td>
        </tr>

		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->A_CAPTCHA; ?></td>
        	<td><?php echo mosHTML::yesnoRadioList('captcha', '', $row->captcha ); ?></td>
        </tr>
		<tr>
        	<td width="15%" nowrap="nowrap" valign="top"><?php echo $akforms->lng->A_CSS_TEXT; ?></td>
        	<td>
            	<textarea name="css_text" class="text_area" cols="45" rows="15" style="width:99%" ><?php echo $row->css_text; ?></textarea><br />
        	</td>
        </tr>
        </table>

        <?php
        	$tabs->endTab();
			$tabs->startTab($akforms->lng->MAIL_SUBJECT, "subject-page" );
			$subject = $lists['subject'];
        ?>
		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
		<tr>
			<th colspan="2"><?php echo $akforms->lng->MAIL_SUBJECT; ?></th>
		</tr>
		<?php foreach ($pub_lang as $lng) {
			if ( $lng == $_lang ) {
			?>
			<tr>
    	    	<td width="15%" nowrap="nowrap"><b><?php echo ucwords($lng); ?></b></td>
	        	<td><input class="inputbox" type="text" name="mail_subject" size="90" maxlen="250" value="<?php echo $row->mail_subject; ?>" /></td>
	        </tr>
			<?php } else { ?>
			<tr>
        		<td width="15%" nowrap="nowrap"><?php echo ucwords($lng); ?></td>
	        	<td><input class="inputbox" type="text" name="subject[<?php echo $lng; ?>]" size="90" value="<?php echo $subject[$lng]->label; ?>" /></td>
    	    </tr>
        	<?php }
	    } ?>
        </table>

        <?php
        	$tabs->endTab();
			$tabs->startTab($akforms->lng->PRE_TEXT_MESSAGE, "pretext-page" );
			$precopy = $lists['precopy'];
        ?>
		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
		<tr>
			<th colspan="2"><?php echo $akforms->lng->PRE_TEXT_MESSAGE; ?></th>
		</tr>
		<?php foreach ($pub_lang as $lng) {
			if ( $lng == $_lang ) {
			?>
			<tr>
    	    	<td width="15%" nowrap="nowrap"><b><?php echo ucwords($lng); ?></b></td>
	        	<td><input class="inputbox" type="text" name="pre_copy_text" size="90" maxlen="250" value="<?php echo $row->pre_copy_text; ?>" /></td>
	        </tr>
			<?php } else { ?>
			<tr>
        		<td width="15%" nowrap="nowrap"><?php echo ucwords($lng); ?></td>
	        	<td><input class="inputbox" type="text" name="precopy[<?php echo $lng; ?>]" size="90" value="<?php echo $precopy[$lng]->label; ?>" /></td>
    	    </tr>
        	<?php }
	    } ?>
        </table>
        <?php
        	$tabs->endTab();
			$tabs->startTab($akforms->lng->BOTTON_SEND_TEXT, "btsend-page" );
			$btsend = $lists['btsend'];
        ?>
		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
		<tr>
			<th colspan="2"><?php echo $akforms->lng->BOTTON_SEND_TEXT; ?></th>
		</tr>
		<?php foreach ($pub_lang as $lng) {
			if ( $lng == $_lang ) {
			?>
			<tr>
    	    	<td width="15%" nowrap="nowrap"><b><?php echo ucwords($lng); ?></b></td>
	        	<td><input class="inputbox" type="text" name="text_button" size="90" maxlen="250" value="<?php echo $row->text_button; ?>" /></td>
	        </tr>
			<?php } else { ?>
			<tr>
        		<td width="15%" nowrap="nowrap"><?php echo ucwords($lng); ?></td>
	        	<td><input class="inputbox" type="text" name="btsend[<?php echo $lng; ?>]" size="90" value="<?php echo $btsend[$lng]->label; ?>" /></td>
    	    </tr>
        	<?php }
	    } ?>
        </table>
        <?php
        	$tabs->endTab();
			$tabs->startTab($akforms->lng->ONSUCCESS, "onsuccess-page" );
			$onsuccess = $lists['onsuccess'];
        ?>
		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
		<tr>
			<th colspan="2"><?php echo $akforms->lng->ONSUCCESS; ?></th>
		</tr>
		<?php foreach ($pub_lang as $lng) {
			if ( $lng == $_lang ) {
			?>
			<tr>
    	    	<td width="5%" nowrap="nowrap" valign="top"><b><?php echo ucwords($lng); ?></b></td>
	        	<td><textarea name="onsuccess" class="text_area" cols="45" rows="5" style="width:99%" ><?php echo $row->onsuccess; ?></textarea></td>
	        </tr>
			<?php } else { ?>
			<tr>
        		<td width="5%" nowrap="nowrap" valign="top"><?php echo ucwords($lng); ?></td>
        		<td><textarea name="aonsuccess[<?php echo $lng; ?>]" class="text_area" cols="45" rows="5" style="width:99%" ><?php echo $onsuccess[$lng]->description; ?></textarea></td>
    	    </tr>
        	<?php }
	    } ?>
        </table>
        <?php
        	$tabs->endTab();
			$tabs->startTab($akforms->lng->FORM_GROUPS, "group-page" );
			$groups = $lists['groups'];
			$k = 0;
        ?>
		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform" id="grouptable">
		<tr>
			<th><?php echo $akforms->lng->FORM_GROUP_TITLE; ?></th>
			<th><?php echo $akforms->lng->TITLE_IN_VALUES; ?> <?php echo mosToolTip($akforms->lng->TITLE_IN_VALUESD); ?></th>
			<th><?php echo $akforms->lng->FILTER_IN_VALUES; ?> <?php echo mosToolTip($akforms->lng->FILTER_IN_VALUESD); ?></th>
			<th><?php echo $akforms->lng->FORM_GROUP_DELETE; ?></th>
		</tr>
		<?php foreach ($groups as $group) { ?>
		<tr class="row<?php echo $k; ?>">
        	<td><input class="inputbox" type="text" name="groups[<?php echo $group->id; ?>][title]" size="90" value="<?php echo $group->title; ?>" /></td>
        	<td><?php echo mosHTML::yesnoRadioList( 'groups['.$group->id.'][title_in_value]', 'class="inputbox"', $group->title_in_value ); ?></td>
        	<td><?php echo mosHTML::yesnoRadioList( 'groups['.$group->id.'][filter_in_value]', 'class="inputbox"', $group->filter_in_value ); ?></td>
        	<td><input type="checkbox" name="groups[<?php echo $group->id; ?>][del]" value="1" /></td>
        </tr>
		<?php
			$k = 1 - $k;
		} ?>
        </table>
		<div colspan="4" style="padding:10px; text-align: center;">
   				<a id="newgroup" class="button" style="background-color: #D5D5D5; padding: 5px;" href="javascript:void(0)" title="<?php echo $akforms->lng->FORM_GROUP_ADD; ?>"><?php echo $akforms->lng->FORM_GROUP_ADD; ?></a>
		</div>
        <?php
        	$tabs->endTab();
			$tabs->endPane();
		?>


		<input type="hidden" name="option" value="com_akforms" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="id" value="<?php echo intval($row->id); ?>" />
		<input type="hidden" name="hidemainmenu" value="1" />
		</form>
<?php
	}

	/*******************************/
	/* HTML FORM IMPORT FORM       */
	/*******************************/
	static public function importForm() {
		global $akforms, $adminLanguage, $mainframe;

		$thtitle = $akforms->lng->A_FORMS.': '.$akforms->lng->IMPORT_FORM;
?>
		<form action="index3.php" method="post" name="adminForm" enctype="multipart/form-data">
		<table class="adminheading">
			<tr>
				<th style="<?php self::thstyle(); ?>"><?php echo $thtitle; ?></th>
			</tr>
		</table>

		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $adminLanguage->A_FILE; ?></td>
        	<td><input class="inputbox" type="file" name="impfile" size="60" value="" /></td>
        </tr>
		<tr>
        	<td colspan="2">
	        	<input class="inputbox" type="submit" value="<?php echo $adminLanguage->A_UPLOAD; ?>" />
	        	<input class="inputbox" type="button" value="<?php echo $adminLanguage->A_CANCEL; ?>" onclick="window.history.go(-1);"/>

        	</td>
        </tr>
        </table>

		<input type="hidden" name="option" value="com_akforms" />
		<input type="hidden" name="task" value="import" />
		<input type="hidden" name="step" value="1" />
		</form>
<?php
	}

	/************************/
	/* HTML LIST FIELDS     */
	/************************/
	static public function listFields($rows, $lists, $pageNav, $formfilters) {
		global $adminLanguage, $akforms, $database;

		$textdir = (_GEM_RTL == 1) ? 'right' : 'left';

		$whereinc = array();
		foreach ($akforms->lng->WHERE_INCLUDE_ARR as $key => $value) {
			$whereinc[] = mosHTML::makeOption($key, $value);
		}

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
            window.location = "index2.php?option=com_akforms&task=setaccessfield&access="+acc+"&id="+cid;
		}
		function eWhereInc( cid, whereinc ) {
            if (document.getElementById) {
                var acc = document.getElementById(whereinc).value;
			} else if (document.all) {
				var acc = document.all[whereinc].value;
            } else if (document.layers) {
                var acc = document.layers[whereinc].value;
            }
            window.location = "index2.php?option=com_akforms&task=setwhereinc&where="+acc+"&id="+cid;
		}
		</script>

		<form action="index2.php" method="get" name="adminForm">
		<table class="adminheading">
			<tr>
				<th style="<?php self::thstyle(); ?>"><?php echo $lists['form_name'].': '.$akforms->lng->A_FIELDS; ?></th>
			</tr>
		</table>
		<div align="right">
			<?php echo $lists['filter_form'];?>
		</div>
		<table class="adminlist">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20">
                <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
			</th>
			<th class="title"><?php echo $akforms->lng->A_FIELD_LABEL; ?></th>
			<th class="title"><?php echo $adminLanguage->A_TYPE; ?></th>
			<th width="10%"><?php echo $akforms->lng->WHERE_INCLUDE; ?></th>
			<th width="10%"><?php echo $adminLanguage->A_ACCESS; ?></th>
			<th width="1px"><?php echo $adminLanguage->A_PUBLISHED; ?></th>
			<th colspan="2" width="1px"><?php echo $adminLanguage->A_REORDER; ?></th>
			<th width="2%"><?php echo $adminLanguage->A_ORDER; ?></th>
			<th width="1%">
				<a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )" title="<?php echo $adminLanguage->A_SAVEORDER; ?>"><img src="images/filesave.png" border="0" width="16" height="16" /></a>
			</th>
			<th class="title" width="10%"><?php echo $adminLanguage->A_LANGUAGE; ?>
	            <a href="javascript:void(0);" onclick="javascript:showLayer('selectlang');">
    	        <?php
        	    echo '<img src=';
            	echo ($formfilters['filter_lang'] != '') ? '"images/downarrow3.png" alt="'.$adminLanguage->A_FILTERED.'" title="'.$adminLanguage->A_FILTERED.'"' : '"images/downarrow2.png" alt="'.$adminLanguage->A_FILTER.'" title="'.$adminLanguage->A_FILTER.'"';
	            echo ' border="0" />';
    	        ?>
        	    </a>
            	<div id="selectlang" style="display:none; position:absolute; <?php echo (_GEM_RTL) ? 'left' : 'right'; ?>:20px;" class="filter">
	                <div class="filtertop"><?php echo $adminLanguage->A_FILTLANG; ?></div>
    	            <?php echo $lists['flangs']; ?>
        	        <div class="filterbottom">
            	        <a href="javascript:void(0);" onclick="javascript:hideLayer('selectlang');" style="color: #888888;"><?php echo $adminLanguage->A_CLOSE; ?></a>
                	</div>
				 </div>
			</th>
		</tr>
<?php
		$k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$link = 'index2.php?option=com_akforms&task=editfield&id='.$row->id.'&fid='.$lists['form_id'].'&hidemainmenu=1';

			$task = $row->published ? 'unpublishfield' : 'publishfield';
			$img = $row->published ? 'publish_g.png' : 'publish_x.png';
			$alt = $row->published ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;

			$access = mosCommonHTML::AccessProcessing( $row, $i );
            $accesswin_list = mosAdminMenus::Access($row);

?>
			<tr class="row<?php echo $k; ?>">
				<td align="center"><?php echo $i + 1 + $pageNav->limitstart; ?></td>
				<td><input type="checkbox" id="cb<?php echo $i; ?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>
				<td nowrap="nowrap">
					<a href="<?php echo $link; ?>" title="<?php echo $adminLanguage->A_EDIT; ?>"><?php echo $row->field_label; ?></a>
				</td>
				<td><?php echo $row->field_type; if ($row->field_type == 'input') echo '('.$row->maxlength.')';?></td>
				<td>
					<a style="color: <?php echo ($row->where_include == 3 ? 'red' : 'green'); ?>;" onclick="javascript:showLayer('whereincwin<?php echo $i; ?>')" href="javascript: void(null);"><?php echo $akforms->lng->WHERE_INCLUDE_ARR[$row->where_include];?></a>
					<div id="whereincwin<?php echo $i; ?>" style="display:none; position:absolute;" class="filter">
    	                <div class="filtertop"><strong><?php echo $akforms->lng->WHERE_INCLUDE; ?></strong></div>
        	            <?php
        	            	echo mosHTML::selectList( $whereinc, 'whereinc'.$row->id, ' class="inputbox" size="10" style="width:100%"', 'value', 'text', $row->where_include );
        	            ?>
            	        <div class="filterbottom">
                	        <input type="button" class="button" onclick="javascript:eWhereInc('<?php echo $row->id; ?>', 'whereinc<?php echo $row->id; ?>');" name="submitinc<?php echo $i; ?>" value="<?php echo $adminLanguage->A_SAVE; ?>" /> &nbsp;
                    	    <input type="button" class="button" onclick="javascript:hideLayer('whereincwin<?php echo $i; ?>');" name="closeinc<?php echo $i; ?>" value="<?php echo $adminLanguage->A_CLOSE; ?>" />
	                    </div>
    	            </div>
				</td>
				<td align="center" style="text-align:center;">
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

				<td style="text-align:center">
                	<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i; ?>','<?php echo $task; ?>')" title="<?php echo $alt; ?>">
                	<img src="images/<?php echo $img; ?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" /></a>
				</td>
				<td style="text-align:<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>" width="1px"><?php echo $pageNav->orderUpIcon( $i, true, 'orderupfield'); ?></td>
				<td style="text-align:<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>" width="1px"><?php echo $pageNav->orderDownIcon( $i, $n, true, 'orderdownfield' ); ?></td>
				<td align="center" style="text-align:center;" colspan="2">
					<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
				</td>
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
		}
?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="com_akforms" />
		<input type="hidden" name="task" value="fields" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
<?php
	}

	/*******************************/
	/* HTML FORM ADD/EDIT FIELD    */
	/*******************************/
	static public function editField($row, $lists) {
		global $akforms, $adminLanguage, $mainframe, $fmanager;

		$thtitle = $lists['form_name'].' - '.$akforms->lng->A_FIELDS.': '.($row->id ? $adminLanguage->A_EDIT : $adminLanguage->A_NEW);
		mosCommonHTML::loadOverlib();

		$tabs = new mosTabs(0);
?>
		<script type="text/javascript">
		function columnLabelString(index) {//0 = A, 1 = B
		var b = (index).toString(26).toUpperCase();   // Radix is 26.
		var c = [];
		for (var i = 0; i < b.length; i++) {
			var x = b.charCodeAt(i);
			if (i <= 0 && b.length > 1) {				   // Leftmost digit is special, where 1 is A.
				x = x - 1;
			}
			if (x <= 57) {								  // x <= '9'.
				c.push(String.fromCharCode(x - 48 + 65)); // x - '0' + 'A'.
			} else {
				c.push(String.fromCharCode(x + 10));
			}
		}
		return c.join("");
	}

		jQuery(document).ready(function() {
			jQuery("#soptions").sortable({ containment: 'parent' });
			jQuery("#roptions").sortable({ containment: 'parent' });
			jQuery("#coptions").sortable({ containment: 'parent' });


			jQuery('#stex-option-ok').bind('click', function(e){
				text2options('soptions', 'soption[]', 'sdefault', '<?php echo $akforms->lng->_SELECTED; ?>', 'radio');
				window.parent.jQuery.modal.close();
			});
			jQuery('#svtex-option-ok').bind('click', function(e){
				text2options('svoptions', 'svoption[]', 'svdefault', '<?php echo $akforms->lng->_SELECTED; ?>', 'radio');
				window.parent.jQuery.modal.close();
			});
			jQuery('#ctex-option-ok').bind('click', function(e){
				text2options('coptions', 'coption[]', 'cdefault', '<?php echo $akforms->lng->_CHECKED; ?>','checkbox');
				window.parent.jQuery.modal.close();
			});
			jQuery('#rtex-option-ok').bind('click', function(e){
				text2options('roptions', 'roption[]', 'rdefault', '<?php echo $akforms->lng->_SELECTED; ?>','radio');
				window.parent.jQuery.modal.close();
			});

			jQuery('span.sort img.delete').live('click', function(e) {
				jQuery(this).parent().remove();
			});

			jQuery("#modal-soptions").click(function(e){
				jQuery('#stex-option-ok').show();
				jQuery('#svtex-option-ok').hide();
				jQuery('#ctex-option-ok').hide();
				jQuery('#rtex-option-ok').hide();
				jQuery('#vselect-desc').hide();
				jQuery('#basic-modal-content').modal({overlayClose:true});
			});

			jQuery("#modal-svoptions").click(function(e){
				jQuery('#svtex-option-ok').show();
				jQuery('#stex-option-ok').hide();
				jQuery('#ctex-option-ok').hide();
				jQuery('#rtex-option-ok').hide();
				jQuery('#vselect-desc').show();
				jQuery('#basic-modal-content').modal({overlayClose:true});
			});

			jQuery("#modal-coptions").click(function(e){
				jQuery('#stex-option-ok').hide();
				jQuery('#ctex-option-ok').show();
				jQuery('#rtex-option-ok').hide();
				jQuery('#svtex-option-ok').hide();
				jQuery('#vselect-desc').hide();
				jQuery('#basic-modal-content').modal({overlayClose:true});
			});

			jQuery("#modal-roptions").click(function(e){
				jQuery('#stex-option-ok').hide();
				jQuery('#ctex-option-ok').hide();
				jQuery('#rtex-option-ok').show();
				jQuery('#svtex-option-ok').hide();
				jQuery('#vselect-desc').hide();
				jQuery('#basic-modal-content').modal({overlayClose:true});
			});

			jQuery('#field_table').fixer({width:580, height:580, fixedrows: 1, fixedcols:1});

			jQuery("#create_table").click(function(e) {
				var rows = parseInt(jQuery('#trow').val());
				var cols = parseInt(jQuery('#tcol').val());

				rows = rows || 1;
				cols = cols || 1;

				jQuery('#opt_table').html('');
				jQuery('#opt_table').append('<table id="field_table" class="field_table"></table>');
				jQuery('#field_table').append('<tbody></tbody>');

				for (r=0; r <= rows; r++) {
					myTr = '<tr>';
					for (c=0; c <= cols; c++) {
						myTr += '<td';
						if (c==0 && r>0 || c>0 && r==0) {
							myTr += ' class="header"';
						}
						if (c>0 && r>0) {
							myTr += ' class="value"';
						}
						myTr += '>';
						if (c==0 && r>0) {
							myTr += r;
						} else if (c>0 && r==0) {
							myTr += columnLabelString(c-1);
						} else if (c>0 && r>0) {
							myTr += '<input type="text" name="table['+r+']['+c+']" value="" />';
						}
						myTr += "</td>";
					}
					myTr += "</tr>";
					jQuery('#field_table tbody').append(myTr);
				}
				jQuery('#field_table').fixer({width:580, height:580, fixedrows: 1, fixedcols:1});
			});
		});

		function submitbutton(pressbutton, section) {
			var form = document.adminForm;
			if (pressbutton == 'cancelform') {
				submitform(pressbutton);
				return;
			}

			if (form.name.value == "") {
				alert("<?php echo $akforms->lng->EMSG_EMPTY_NAME; ?>");
				form.name.focus();
			} else {
				submitform(pressbutton);
			}
		}

		function addoption(e, oname, oname2, otext, otype, oval, oval2){
			var d = jQuery('#'+e);

			var c = jQuery('#'+e+' input:'+otype);
			var i = c.size();

			oval = oval || "";
			oval2 = oval2 || "";

			if (d) {
				if (oname == 'svoption[]') {
					var a = '<span class="sort"><input type="text" name="svoption1[]" value="' + oval + '" />&nbsp;<input type="text" name="svoption2[]" value="' + oval2 + '" /> ' + otext + ': <input type="' + otype + '" name="' + oname2 + '" value="' + i +'" />&nbsp;<img src="/images/M_images/delete.png" class="delete" /></span>';
				} else {
					var a = '<span class="sort"><input type="text" name="' + oname + '" value="' + oval + '" /> ' + otext + ': <input type="' + otype + '" name="' + oname2 + '" value="' + i +'" />&nbsp;<img src="/images/M_images/delete.png" class="delete" /></span>';
				}
                d.append(a);
			}
		}

		function text2options(e, oname, oname2, otext, otype) {
			var $text = jQuery('#option_text').val();
			var $lines = $text.split("\n");

			jQuery('#'+e).html('');

			for (var i = 0; i < $lines.length; i++) {
				var $vals = $lines[i].split("=");
				addoption(e, oname, oname2, otext, otype, $vals[0], $vals[1])
			}
		}

		function switchoptions() {
	        opt = document.adminForm.field_type.selectedIndex;
	        typ = document.adminForm.field_type.options[opt].text;

	        jQuery("#opt div.opt-content").css({'display':'none'});

	        jQuery('#opt' + typ).css({'display':''});

	    }
		</script>

		<div id="basic-modal-content">
			<form action="" method="post" name="textForm">
				<div class="modal-info">
				<div id="select-desc"><?php echo $akforms->lng->SELECT_DESC; ?></div>
				<div id="vselect-desc"><?php echo $akforms->lng->VALSELECT_DESC; ?></div>
				</div>
    	       	<textarea name="option_text" id="option_text" class="text_area" cols="45" rows="14" style="width:98%;" ></textarea><br/><br/>
    	       	<center>
    	       	<a href="#" class='button' style="width: 150px;" id="stex-option-ok">&nbsp;&nbsp;Ok&nbsp;&nbsp;</a>
    	       	<a href="#" class='button' style="width: 150px;" id="svtex-option-ok">&nbsp;&nbsp;Ok&nbsp;&nbsp;</a>
    	       	<a href="#" class='button' style="width: 150px;" id="ctex-option-ok">&nbsp;&nbsp;Ok&nbsp;&nbsp;</a>
    	       	<a href="#" class='button' style="width: 150px;" id="rtex-option-ok">&nbsp;&nbsp;Ok&nbsp;&nbsp;</a>
    	       	&nbsp;<a href="#" class='button' onclick="JavaScript: window.parent.jQuery.modal.close();">&nbsp;Cancel&nbsp;</a></center>
    	    </form>
		</div>

		<form action="index3.php" method="post" name="adminForm" enctype="multipart/form-data">
		<table class="adminheading">
			<tr>
				<th style="<?php self::thstyle(); ?>"><?php echo $thtitle; ?></th>
			</tr>
		</table>
		<?php
		$tabs->startPane("field-pane");
		$tabs->startTab($akforms->lng->GENERALSETS, "general-page" );
		?>

		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
		<tr>
			<th colspan="2"><?php echo $adminLanguage->A_DETAILS; ?></th>
		</tr>
		<tr><td style="vertical-align: top; width:50%;">
		<table>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->A_FIELD_LABEL; ?></td>
        	<td><input class="inputbox" type="text" name="field_label" size="60" value="<?php echo $row->field_label; ?>" /></td>
        </tr>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->A_FIELD_TYPE; ?></td>
        	<td><?php echo $lists['field_type']; ?>
        	</td>
        </tr>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->FORM_GROUP ; ?></td>
        	<td><?php echo $lists['field_group']; ?>
        	</td>
        </tr>
		<tr>
			<td valign="top"><?php echo $adminLanguage->A_LANGUAGE; ?>:</td>
			<td><?php echo $lists['languages']; ?></td>
		</tr>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->A_FIELD_NOTNULL; ?></td>
        	<td><?php echo $lists['isnotnull']; ?>
        	</td>
        </tr>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->A_FIELD_HIDE; ?></td>
        	<td><?php echo $lists['ishide']; ?>
        	</td>
        </tr>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->A_FIELD_READONLY; ?></td>
        	<td><?php echo $lists['readonly']; ?>
        	</td>
        </tr>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->A_FIELD_WOLABEL; ?></td>
        	<td><?php echo $lists['hidelabel']; ?>
        	</td>
        </tr>
		<tr>
			<td valign="top"><?php echo $adminLanguage->A_ORDERING; ?>:</td>
			<td><?php echo $lists['ordering']; ?></td>
		</tr>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->WHERE_INCLUDE; ?></td>
        	<td><?php echo $lists['where_include']; ?>
        	</td>
        </tr>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->A_FIELD_CLASS; ?></td>
        	<td><input class="inputbox" type="text" name="field_class" size="60" value="<?php echo $row->field_class; ?>" /></td>
        </tr>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->A_FIELD_STYLE; ?></td>
        	<td><input class="inputbox" type="text" name="field_style" size="60" value="<?php echo $row->field_style; ?>" /></td>
        </tr>
		<tr>
        	<td width="15%" nowrap="nowrap"><?php echo $akforms->lng->A_FIELD_HEIGHT; ?></td>
        	<td><input class="inputbox" type="text" name="line_height" size="10" value="<?php echo $row->line_height; ?>" /> px</td>
        </tr>
		<tr>
			<td valign="top"><?php echo $adminLanguage->A_ACCESSLEVEL; ?>:</td>
			<td><?php echo $lists['access']; ?></td>
		</tr>
		</table>
		</td>
        <td style="vertical-align: top; width:50%;" id="opt">
        	<div id="optinput"<?php echo ($row->field_type == 'input') ? '' : ' style="display:none;"'; ?> class="opt-content">
            	<fieldset>
                	<legend><?php echo $akforms->lng->A_FIELD_OPTIONSFOR; ?> Input</legend>
                    <span style="width: 120px; float:<?php echo $align; ?>;"><?php echo $akforms->lng->A_FIELD_DEFVALUE; ?>:</span>&nbsp;
                    <input type="text" name="defvalue_inp" dir="ltr" value="<?php echo $row->field_value; ?>"><br>
                    <span style="width: 120px; float:<?php echo $align; ?>;"><?php echo $akforms->lng->A_FIELD_MAXLENGTH; ?>:</span>&nbsp;
                    <input type="text" name="maxlength" dir="ltr" value="<?php echo $row->maxlength; ?>">
                </fieldset>
            </div>
            <div id="opttext"<?php echo ($row->field_type == 'text') ? '' : ' style="display:none"'; ?> class="opt-content">
	            <fieldset>
    	            <legend><?php echo $akforms->lng->A_FIELD_OPTIONSFOR; ?> Text</legend>
	            	<textarea name="defvalue_text" class="text_area" cols="45" rows="15" style="width:99%" ><?php echo $row->field_value; ?></textarea>
	            </fieldset>
            </div>
            <div id="opttextarea"<?php echo ($row->field_type == 'textarea') ? '' : ' style="display:none"'; ?> class="opt-content">
	            <fieldset>
    	            <legend><?php echo $akforms->lng->A_FIELD_OPTIONSFOR; ?> textarea</legend>
    	             <span style="width: 120px; float:<?php echo $align; ?>;"><?php echo $akforms->lng->A_FIELD_DEFVALUE; ?>:</span>&nbsp;<br/>
	            	<textarea name="defvalue_textarea" class="text_area" cols="45" rows="15" style="width:99%" ><?php echo $row->field_value; ?></textarea>
	            </fieldset>
            </div>
            <div id="optfile"<?php echo ($row->field_type == 'file') ? '' : ' style="display:none"'; ?> class="opt-content">
	            <fieldset>
    	            <legend><?php echo $akforms->lng->A_FIELD_OPTIONSFOR; ?> File</legend>
        	        <span style="width: 120px; float:<?php echo $align; ?>;"><?php echo $akforms->lng->A_FIELD_SUPPORT_EXT; ?>:</span>&nbsp;
            	    <input type="text" name="filevalue" dir="ltr" value="<?php echo $row->field_value; ?>"><br>
	            </fieldset>
            </div>
            <div id="opthidden"<?php echo ($row->field_type == 'hidden') ? '' : ' style="display:none"'; ?> class="opt-content">
	            <fieldset>
    	            <legend><?php echo $akforms->lng->A_FIELD_OPTIONSFOR; ?> Hidden</legend>
        	        <span style="width: 120px; float:<?php echo $align; ?>;"><?php echo $akforms->lng->A_FIELD_DEFVALUE; ?>:</span>&nbsp;
            	    <input type="text" name="hidvalue" dir="ltr" value="<?php echo $row->field_value; ?>"><br>
	            </fieldset>
            </div>
            <div id="opttime"<?php echo ($row->field_type == 'time') ? '' : ' style="display:none"'; ?> class="opt-content">
	            <fieldset>
    	            <legend><?php echo $akforms->lng->A_FIELD_OPTIONSFOR; ?> Time</legend>
        	        <span style="width: 120px; float:<?php echo $align; ?>;"><?php echo $akforms->lng->A_FIELD_DEFVALUE; ?>:</span>&nbsp;
            	    <input type="text" name="timevalue" dir="ltr" value="<?php echo $row->field_value; ?>"><br>
	            </fieldset>
            </div>
            <div id="optselect"<?php echo ($row->field_type == 'select') ? '' : ' style="display:none"'; ?> class="opt-content">
    	        <fieldset id="fsoptselect">
        	        <legend><?php echo $akforms->lng->A_FIELD_OPTIONSFOR; ?> Select</legend>
        	        <div class="options">
        	        <span id="soptions">
            	    <?php echo $lists['soptions']; ?>
            	    </span>
            	    </div>
	            </fieldset>
				<center>
					<a onclick="addoption('soptions', 'soption[]', 'sdefault', '<?php echo $akforms->lng->_SELECTED; ?>', 'radio'); return false;" href="#">
						<img width="16" height="16" border="0" align="absmiddle" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/images/new.png">
						<?php echo $akforms->lng->A_FIELD_ADD_OPTION; ?>
					</a>&nbsp;
					<a id="modal-soptions" href="#">
						<img width="16" height="16" border="0" align="absmiddle" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/images/assign.png">
						<?php echo $akforms->lng->IMPORT_FROM_TEXT; ?>
					</a>
				</center>
            </div>

            <div id="optvalselect"<?php echo ($row->field_type == 'valselect') ? '' : ' style="display:none"'; ?> class="opt-content">
    	        <fieldset id="fsoptvalselect">
        	        <legend><?php echo $akforms->lng->A_FIELD_OPTIONSFOR; ?> Select with value</legend>
        	        <div class="options">
        	        <span id="svoptions">
            	    <?php echo $lists['svoptions']; ?>
            	    </span>
            	    </div>
	            </fieldset>
				<center>
					<a onclick="addoption('svoptions', 'svoption[]', 'svdefault', '<?php echo $akforms->lng->_SELECTED; ?>', 'radio'); return false;" href="#">
						<img width="16" height="16" border="0" align="absmiddle" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/images/new.png">
						<?php echo $akforms->lng->A_FIELD_ADD_OPTION; ?>
					</a>&nbsp;
					<a id="modal-svoptions" href="#">
						<img width="16" height="16" border="0" align="absmiddle" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/images/assign.png">
						<?php echo $akforms->lng->IMPORT_FROM_TEXT; ?>
					</a>
				</center>
            </div>

            <div id="optradio"<?php echo ($row->field_type == 'radio') ? '' : ' style="display:none"'; ?> class="opt-content">
    	        <fieldset id="fsoptradio">
        	        <legend><?php echo $akforms->lng->A_FIELD_OPTIONSFOR; ?> Radio</legend>
        	        <div class="options">
        	        <span id="roptions">
            	    <?php echo $lists['roptions']; ?>
            	    </span>
            	    </div>
	            </fieldset>
				<center>
					<a onclick="addoption('roptions', 'roption[]', 'rdefault', '<?php echo $akforms->lng->_SELECTED; ?>', 'radio'); return false;" href="#">
						<img width="16" height="16" border="0" align="absmiddle" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/images/new.png">
						<?php echo $akforms->lng->A_FIELD_ADD_OPTION; ?>
					</a>&nbsp;
					<a id="modal-roptions" href="#">
						<img width="16" height="16" border="0" align="absmiddle" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/images/assign.png">
						<?php echo $akforms->lng->IMPORT_FROM_TEXT; ?>
					</a>
				</center>
            </div>
            <div id="optcheckbox"<?php echo ($row->field_type == 'checkbox') ? '' : ' style="display:none"'; ?> class="opt-content">
    	        <fieldset id="fsoptcheck">
        	        <legend><?php echo $akforms->lng->A_FIELD_OPTIONSFOR; ?> Checkbox</legend>
        	        <div class="options">
        	        <span id="coptions">
            	    <?php echo $lists['coptions']; ?>
            	    </span>
        	        </div>
	            </fieldset>
				<center>
					<a onclick="addoption('coptions', 'coption[]', 'cdefault[]', '<?php echo $akforms->lng->_CHECKED; ?>', 'checkbox'); return false;" href="#">
						<img width="16" height="16" border="0" align="absmiddle" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/images/new.png">
						<?php echo $akforms->lng->A_FIELD_ADD_OPTION; ?>
					</a>&nbsp;
					<a id="modal-coptions" href="#">
						<img width="16" height="16" border="0" align="absmiddle" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/images/assign.png">
						<?php echo $akforms->lng->IMPORT_FROM_TEXT; ?>
					</a>
				</center>
            </div>
            <div id="optsql"<?php echo ($row->field_type == 'sql') ? '' : ' style="display:none"'; ?> class="opt-content">
	            <fieldset>
    	            <legend><?php echo $akforms->lng->A_FIELD_OPTIONSFOR; ?> SQL</legend>
                    <span style="width: 120px; float:<?php echo $align; ?>;"><?php echo $akforms->lng->A_FIELD_DEFVALUE; ?>:</span>&nbsp;
                    <input type="text" name="defvalue_sql" dir="ltr" value="<?php echo $row->field_value; ?>"><br>
                    <span style="display: block; border: 1px solid #CCCCCC; margin: 10px 0; padding: 7px; background-color: #FFFFFF;"><?php echo $akforms->lng->SQL_FILED_TIP; ?></span>
	            	<textarea name="sqlvalue" class="text_area" cols="45" rows="15" style="width:99%" ><?php echo $row->field_list; ?></textarea>
	            </fieldset>
            </div>
            <div id="opttable"<?php echo ($row->field_type == 'table') ? '' : ' style="display:none"'; ?> class="opt-content">
	            <fieldset>
    	            <legend><?php echo $akforms->lng->A_FIELD_OPTIONSFOR; ?> Table</legend>
    	            <div class="toolbar">
    	            	Rows: <?php echo $akforms->getNumList('trow', 1, 65, 1); ?>&nbsp;&nbsp;Cols: <?php echo $akforms->getNumList('tcol', 1, 65, 1); ?>&nbsp;
    	            	<a href="#" id="create_table">
    	            	<img width="16" border="0" align="absmiddle" height="16" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/images/new.png" />&nbsp;Create table
    	            	</a>
    	            	<div style="float:right;">
    	            		<a href="javascript:void(null);" onclick="window.open('<?php echo $akforms->aurl; ?>/doc/field_table.html', 'Formula Functions', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=600,height=400,directories=no,location=no');" title="Formula Functions">
    	            		<img src="/images/M_images/info_blue.gif" width="16" />
    	            		</a>
    	            	</div>
    	            </div>
    	            <div class="options3" id="opt_table">
						<table id="field_table" class="field_table">
                    	<?php
                    	$_rows = explode("|", $row->field_list);

                    	foreach ($_rows as $_r => $_row) {
                    		if ( empty($_row)) { continue; }
                    		$_cols = explode('~', $_row);
							$myTr = '<tr>';
							if ( $_r == 0 ) {
								$myTr .= '<td></td>';
    	                		foreach ($_cols as $_c => $_sell) {
									$myTr .= '<td class="header">'.$akforms->columnLabel2String($_c).'</td>';
								}
								$myTr .= '</tr><tr>';
							}
                    		foreach ($_cols as $_c => $_sell) {
								if ($_c==0) {
									$myTr .= '<td class="header">'.($_r+1).'</td>';
								}

								$myTr .= '<td class="value">';
								$myTr .= '<input type="text" name="table['.$_r.']['.$_c.']" value="'.$_sell.'" />';
								$myTr .= "</td>";
							}
							$myTr .= "</tr>";
							echo $myTr;
                    	}

                    	?>
                    	</table>
                    </div>
	            </fieldset>
            </div>
        </td>
        </tr>
        </table>
<?php
		$tabs->endTab();
		$tabs->startTab($akforms->lng->A_DESCRIPTION, "desc-page" );
		?>
		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
		<tr>
			<th colspan="2"><?php echo $akforms->lng->A_DESCRIPTION; ?></th>
		</tr>
		<tr>
        	<td>
				<textarea name="description" class="text_area" cols="45" rows="10" style="width:99%" ><?php echo $row->description; ?></textarea>
        	</td>
        </tr>
        </table>
        <?php
		$tabs->endTab();
		$tabs->endPane();
		?>

		<input type="hidden" name="option" value="com_akforms" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="id" value="<?php echo intval($row->id); ?>" />
		<input type="hidden" name="form_id" value="<?php echo intval($row->form_id); ?>" />
		<input type="hidden" name="hidemainmenu" value="1" />
		</form>
		<script type="text/javascript" src="<?php echo $akforms->aurl; ?>/js/jquery.simplemodal.min.js"></script>

<?php
	}

	/************************/
	/* HTML LIST VALUES     */
	/************************/
	static public function listValues($rows, $lists, $pageNav, $valfilter) {
		global $adminLanguage, $akforms, $database;

		$textdir = (_GEM_RTL == 1) ? 'right' : 'left';

		$sort_base = "index2.php?option=com_akforms&task=data";
?>

		<form action="index2.php" method="get" name="adminForm">
		<table class="adminheading">
			<tr>
				<th style="<?php self::thstyle(); ?>"><?php echo $lists['form_name'].': '.$akforms->lng->A_DATA; ?></th>
			</tr>
		</table>
		<table class="adminlist">
			<tr>
				<td>
					<?php if (count($lists['field_filter']) > 0) { ?>
					<fieldset id="formFilter">
						<legend><?php echo $akforms->lng->VALUE_FILTER; ?></legend>
						<?php
							foreach ($lists['field_filter'] as $filter) {
								echo $filter->title.'&nbsp;<input name="valfilter['.$filter->id.']" value="'.$valfilter[$filter->id].'" class="inputbox" type="text" size="20" />&nbsp;';
							}
						?>
						<input class="button" type="submit" value="" style="display:none;"/>
					</fieldset>
					<?php } ?>
				</td>
				<td width="10%"><?php echo $akforms->lng->A_FORM."<br/>".$lists['filter_form'];?></td>
			</tr>
		</table>
		<table class="adminlist">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20">
                <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
			</th>
			<th class="title"><?php echo $adminLanguage->A_DATE.' '.$akforms->sortIcon( $sort_base, "post_date");?></th>
			<?php
			$field_title = $lists['field_title'];

			$fields = array();
			foreach ($field_title as $ft) {
				echo '<th class="title">'.$ft->title.'</th>';
				$fields[] = $ft->id;
			}
			?>
			<th class="title"><?php echo $adminLanguage->A_USER.' '.$akforms->sortIcon( $sort_base, "user_id"); ?></th>
		</tr>
<?php
		$k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];

			$link = 'index2.php?option=com_akforms&task=viewdata&unic='.$row->unic.'&hidemainmenu=1';

?>
			<tr class="row<?php echo $k; ?>">
				<td align="center"><?php echo $i + 1 + $pageNav->limitstart; ?></td>
				<td><input type="checkbox" id="cb<?php echo $i; ?>" name="cid[]" value="<?php echo $row->unic; ?>" onclick="isChecked(this.checked);" /></td>
				<td nowrap="nowrap">
					<?php
					if ($row->isread) $img = 'nomail.png'; else $img = 'mail.png';
					?>
					<img src="images/<?php echo $img; ?>" alt="" width="16"/>&nbsp;
					<a href="<?php echo $link; ?>" title=""><?php echo $row->post_date; ?></a>
					<?php
					echo ' ('.($row->istemp ? $akforms->lng->DATA_SAVED :  $akforms->lng->DATA_SUBMITTED).')';
					?>
				</td>
				<?php
				if (count($fields) > 0) {
					$ids = implode(',', $fields);
					$database->setQuery('SELECT i.field_group, v.value FROM #__akform_values v, #__akform_items i
											WHERE v.unic = "'.$row->unic.'" AND v.field_id = i.id AND i.field_group IN ('.$ids.')
											ORDER BY i.ordering');
					$values = $database->loadRowList('field_group');

					foreach ($fields as $field) {
						echo '<td>'.$values[$field]['value'].'</td>';
					}
				}
				?>

				<td><?php echo $row->user_name;?></td>
			</tr>
<?php
			$k = 1 - $k;
		}
?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="com_akforms" />
		<input type="hidden" name="task" value="data" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
<?php
	}

	/*******************************/
	/* HTML VEW DATA               */
	/*******************************/
	static public function showValues($rows, $lists) {
		global $akforms, $adminLanguage, $mainframe;

		$thtitle = $lists['form_name'].' - '.$lists['post_date'].($lists['user_name'] ? ' - '.$lists['user_name'] : '');
		mosCommonHTML::loadOverlib();
?>
		<table class="adminheading">
			<tr>
				<th style="<?php self::thstyle(); ?>"><?php echo $thtitle; ?></th>
			</tr>
		</table>

		<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
		<tr>
			<th colspan="2"><?php echo ($lists['istemp'] ? $akforms->lng->DATA_SAVED :  $akforms->lng->DATA_SUBMITTED); ?></th>
		</tr>
		<?php
		$k = 0;
		foreach ($rows as $row) {
		?>
		<tr class="row<?php echo $k; ?>">
        	<td nowrap="nowrap"><?php echo $row->field_label; ?></td>
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


	/*********************/
	/* TABLE HEADING CSS */
	/*********************/
	static private function thstyle($s='heading') {
		global $akforms;

		$dir = _GEM_RTL ? 'right' : 'left';
		if ($s == 'list') {
			$style = "background: #549d17 url('".$akforms->aurl."/images/thback.gif') top ".$dir." repeat-x;";
			$style .= " color: #000000; border-bottom: 1px solid #3b700e;";
		} else {
			$style = "background: transparent url('".$akforms->aurl."/images/forms48.png') top ".$dir." no-repeat;";
			$style .= " padding-".$dir.": 54px; color: #000000; font-size: 24px;";
		}
		echo $style;
	}

}

?>