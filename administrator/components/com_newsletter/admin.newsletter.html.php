<?php 
/**
* @version: 1.3
* @copyright: Copyright (C) 2008-2010 Is Open Source. All rights reserved.
* @package: Elxis
* @subpackage: Component NewsLetter
* @author: Ioannis Sannos (Is Open Source)
* @link: http://www.isopensource.com
* @email: info@isopensource.com
* @license: http://creativecommons.org/licenses/by-sa/3.0/ Creative Commons Attribution-Share Alike 3.0
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class newsletterBH {
	
	/****************************/
	/* NEWSLETTER CONTROL PANEL */
	/****************************/
	static public function cpanel() {
		global $newsletter, $adminLanguage;

		$datetxt = (date('Y') > 2008) ? '2008-'.date('Y') : '2008';
?>
		<table width="100%" cellspacing="4" cellpadding="0" border="0">
			<tr>
				<td valign="top">
				<table class="adminheading">
				<tr>
					<th class="massemail">IOS :: <?php echo $newsletter->lng->NEWSLETTER; ?></th>
				</tr>
				</table>
				<br />

				<table cellspacing="10" cellpadding="4" border="0">
				<tr>
					<td valign="top" align="center">
                    <a href="index2.php?option=com_newsletter&amp;task=config&amp;hidemainmenu=1" title="<?php echo $newsletter->lng->CONFIGURE; ?>">
                        <img src="<?php echo $newsletter->aurl; ?>/images/config.png" alt="<?php echo $newsletter->lng->CONFIGURE; ?>" border="0" />
                    </a><br />
                    <?php echo $newsletter->lng->CONFIGURE; ?>
                	</td>
					<td valign="top" align="center">
                    <a href="index2.php?option=com_newsletter&task=subscribers" title="<?php echo $newsletter->lng->SUBSCRIBERS; ?>">
                        <img src="<?php echo $newsletter->aurl; ?>/images/subscribers.png" alt="<?php echo $newsletter->lng->SUBSCRIBERS; ?>" border="0" />
                    </a><br />
                    <?php echo $newsletter->lng->SUBSCRIBERS; ?>
                	</td>
					<td valign="top" align="center">
                    <a href="index2.php?option=com_newsletter&amp;task=newsletters" title="<?php echo $newsletter->lng->NEWSLETTERS; ?>">
                        <img src="<?php echo $newsletter->aurl; ?>/images/newsletters.png" alt="<?php echo $newsletter->lng->NEWSLETTERS; ?>" border="0" />
                    </a><br />
                    <?php echo $newsletter->lng->NEWSLETTERS; ?>
					</td>
                </tr>
                <tr>
					<td valign="top" align="center">
                    <a href="index3.php?option=com_newsletter&amp;task=export&amp;hidemainmenu=1" title="<?php echo $newsletter->lng->EXPORTSUB; ?>" target="_blank">
                        <img src="<?php echo $newsletter->aurl; ?>/images/export.png" alt="<?php echo $newsletter->lng->EXPORTSUB; ?>" border="0" />
                    </a><br />
                    <?php echo $newsletter->lng->EXPORT; ?>
                	</td>
					<td valign="top" align="center">
                    <a href="index2.php?option=com_newsletter&amp;task=import" title="<?php echo $newsletter->lng->IMPORTSUB; ?>">
                        <img src="<?php echo $newsletter->aurl; ?>/images/import.png" alt="<?php echo $newsletter->lng->IMPORTSUB; ?>" border="0" />
                    </a><br />
                    <?php echo $newsletter->lng->IMPORT; ?>
                	</td>
					<td valign="top" align="center">
                    <a href="http://www.isopensource.com" title="Is Open Source - Web hosting, services and software" target="_blank">
                        <img src="<?php echo $newsletter->aurl; ?>/images/isopensource.jpg" alt="Is Open Source" border="0" />
                    </a><br />
                    Is Open Source
					</td>
				</tr>
                </table>
				</td>
				<td valign="top" width="250">
				<strong><?php echo $newsletter->lng->NEWSLETTER; ?></strong><br /><br />
				<p align="justify">Component IOS NewsLetter is a newsletter component for Elxis 2008.x. Users can subscribe to your mailing 
				list from front-end and receive mail notifications you sent from back-end. You can send mail messages in 
				plain text and/or html format. You can send messages in user's preferable language. Sending e-mail messages to people 
				they never subscribe to your mailing list is illegal and those messages are considered as SPAM messages. Use this 
				component to inform your subscribers about your site's new additions and critical information and do not use it as a SPAM tool.</p><br />

				<?php echo $adminLanguage->A_VERSION; ?>: <strong><?php echo $newsletter->version; ?></strong><br />
				Copyright: &copy; <?php echo $datetxt; ?> <a href="http://www.isopensource.com" title="Is Open source (IOS)" target="_blank">Is Open Source</a>. All rights reserved.<br />
				License: <a href="http://creativecommons.org/licenses/by-sa/3.0/" title="Attribution-Share Alike 3.0" target="_blank">Creative Commons Attribution-Share Alike 3.0 Unported</a><br />
				<?php echo $adminLanguage->A_AUTHOR; ?>: <strong>Ioannis Sannos (IOS)</strong>
				</td>
				<td valign="top" align="center" width="320">
					<img src="<?php echo $newsletter->aurl; ?>/images/newsletter.jpg" border="0" alt="<?php echo $newsletter->lng->NEWSLETTER; ?>" /><br />
					<a href="http://www.isopensource.com" title="<?php echo $newsletter->lng->NEWSLETTER; ?> by IOS" target="_blank">Is Open Source</a> 
					&copy; <?php echo $datetxt; ?>. All rights reserved.
				</td>
			</tr>
		</table>
<?php 	
	}


	/********************/
	/* HTML EDIT CONFIG */
	/********************/
	static public function editConfig($lists) {
		global $newsletter, $adminLanguage, $mainframe;

?>
		<form name="adminForm" action="index2.php" method="post">
		<table class="adminheading">
		<tr>
			<th class="massemail"><?php echo $newsletter->lng->NEWSLETTER.' : '.$newsletter->lng->CONFIGURE; ?></th>
		</tr>
		</table>

        <form action="index3.php" method="post" name="adminForm">
        <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
            <tr>
                <th width="20%">&nbsp;</th>
                <th width="25%">&nbsp;</th>
                <th width="55%"><?php echo $adminLanguage->A_HELP; ?></th>
            </tr>
            <tr class="row0">
                <td><?php echo $newsletter->lng->SUBSCRIBE; ?></td>
                <td><?php echo $lists['can_subscribe']; ?></td>
                <td><?php echo $newsletter->lng->CANSUBSCRIBED; ?></td>
            </tr>
            <tr class="row1">
                <td><?php echo $newsletter->lng->EMAILVALID; ?></td>
                <td><?php echo mosHTML::yesnoRadioList('CFG_VALIDATE_EMAIL', '', $newsletter->cfg->get('VALIDATE_EMAIL')); ?></td>
                <td><?php echo $newsletter->lng->EMAILVALIDD; ?></td>
            </tr>
            <tr class="row0">
                <td valign="top"><?php echo $adminLanguage->A_LANGUAGE; ?></td>
                <td>
					<?php 
					$clangs = trim($newsletter->cfg->get('LANGS'));
					if ($clangs != '') {
						$currentLangs = explode(',',$clangs);
					} else {
						$currentLangs = array();
					}

					$pubLangs = explode(',',$mainframe->getCfg('pub_langs'));
					foreach ($pubLangs as $plang) {
						$checked = (in_array($plang, $currentLangs)) ? ' checked="checked"' : '';
						echo '<input type="checkbox" name="CFG_LANGS[]" value="'.$plang.'"'.$checked.' /> '.$newsletter->translatedLang($plang).'<br />';
					}
					?></td>
                <td><?php echo $newsletter->lng->LANGSD; ?></td>
            </tr>
            <tr class="row1">
                <td><?php echo $newsletter->lng->EXCLUDEDTLDS; ?></td>
                <td><input type="text" name="CFG_EXTLDS" value="<?php echo $newsletter->cfg->get('EXTLDS'); ?>" class="inputbox" dir="ltr" size="40" /></td>
                <td><?php echo $newsletter->lng->EXCLUDEDTLDSD; ?></td>
            </tr>
            <tr class="row0">
                <td><?php echo $newsletter->lng->EXCLUDEDDOMS; ?></td>
                <td><input type="text" name="CFG_EXDOMAINS" value="<?php echo $newsletter->cfg->get('EXDOMAINS'); ?>" class="inputbox" dir="ltr" size="40" /></td>
                <td><?php echo $newsletter->lng->EXCLUDEDDOMSD; ?></td>
            </tr>
            <tr class="row1">
                <td><?php echo $newsletter->lng->ALLOWEDTLDS; ?></td>
                <td><input type="text" name="CFG_ONLYTLDS" value="<?php echo $newsletter->cfg->get('ONLYTLDS'); ?>" class="inputbox" dir="ltr" size="40" /></td>
                <td><?php echo $newsletter->lng->ALLOWEDTLDSD; ?></td>
            </tr>
            <tr class="row0">
                <td><?php echo $newsletter->lng->ALLOWEDDOMS; ?></td>
                <td><input type="text" name="CFG_ONLYDOMAINS" value="<?php echo $newsletter->cfg->get('ONLYDOMAINS'); ?>" class="inputbox" dir="ltr" size="40" /></td>
                <td><?php echo $newsletter->lng->ALLOWEDDOMSD; ?></td>
            </tr>
            <tr class="row1">
                <td><?php echo $newsletter->lng->ONEPERREC; ?></td>
                <td><?php echo mosHTML::yesnoRadioList('CFG_ONEPERREC', '', $newsletter->cfg->get('ONEPERREC')); ?></td>
                <td><?php echo $newsletter->lng->ONEPERRECD; ?></td>
            </tr>
            <tr class="row0">
                <td><?php echo $newsletter->lng->RECPERSTEP; ?></td>
                <td><?php echo $lists['recperstep']; ?></td>
                <td><?php echo $newsletter->lng->RECPERSTEPD; ?></td>
            </tr>
            <tr class="row1">
                <td><?php echo $adminLanguage->A_MENU_STATISTICS; ?></td>
                <td><?php echo mosHTML::yesnoRadioList('CFG_SHOWSTATS', '', $newsletter->cfg->get('SHOWSTATS')); ?></td>
                <td><?php echo $newsletter->lng->SHOWSTATSD; ?></td>
            </tr>
            <tr class="row0">
                <td><?php echo $newsletter->lng->SENDERNAME; ?></td>
                <td><input type="text" name="CFG_SENDERNAME" value="<?php echo $newsletter->cfg->get('SENDERNAME'); ?>" class="inputbox" dir="ltr" size="40" autocomplete="off" /></td>
                <td></td>
            </tr>
            <tr class="row1">
                <td><?php echo $newsletter->lng->SENDEREMAIL; ?></td>
                <td><input type="text" name="CFG_SENDERMAIL" value="<?php echo $newsletter->cfg->get('SENDERMAIL'); ?>" class="inputbox" dir="ltr" size="40" autocomplete="off" /></td>
                <td></td>
            </tr>
            <tr class="row0">
                <td><?php echo $newsletter->lng->SENDMETHOD; ?></td>
                <td><?php echo $lists['sendmethod']; ?></td>
                <td></td>
            </tr>
            <tr class="row1">
                <td><?php echo $newsletter->lng->READCONFIRM; ?></td>
                <td><?php echo mosHTML::yesnoRadioList('CFG_READCONFIRM', '', $newsletter->cfg->get('READCONFIRM')); ?></td>
                <td></td>
            </tr>
            <tr class="row0">
                <td><?php echo $newsletter->lng->ADDREPLYTO; ?></td>
                <td><?php echo mosHTML::yesnoRadioList('CFG_REPLYTO', '', $newsletter->cfg->get('REPLYTO')); ?></td>
                <td><?php echo $newsletter->lng->ADDREPLYTOD; ?></td>
            </tr>
            <tr class="row1">
                <td><?php echo $newsletter->lng->SENDMAILPATH; ?></td>
                <td><input type="text" name="CFG_SENDMAILPATH" value="<?php echo $newsletter->cfg->get('SENDMAILPATH'); ?>" class="inputbox" dir="ltr" size="40" /></td>
                <td><?php echo $newsletter->lng->SENDMAILPATHD; ?></td>
            </tr>
            <tr class="row0">
                <td><?php echo $newsletter->lng->SMTPHOST; ?></td>
                <td><input type="text" name="CFG_SMTPHOST" value="<?php echo $newsletter->cfg->get('SMTPHOST'); ?>" class="inputbox" dir="ltr" size="40" autocomplete="off" /></td>
                <td></td>
            </tr>
            <tr class="row1">
                <td><?php echo $newsletter->lng->SMTPPORT; ?></td>
                <td><input type="text" name="CFG_SMTPPORT" value="<?php echo $newsletter->cfg->get('SMTPPORT'); ?>" class="inputbox" dir="ltr" size="4" /></td>
                <td></td>
            </tr>
            <tr class="row0">
                <td><?php echo $newsletter->lng->SECURESMTP; ?></td>
                <td><?php echo $lists['smtpsecure']; ?></td>
				<td></td>
            </tr>
            <tr class="row1">
                <td><?php echo $newsletter->lng->SMTPAUTH; ?></td>
                <td><?php echo mosHTML::yesnoRadioList('CFG_SMTPAUTH', '', $newsletter->cfg->get('SMTPAUTH')); ?></td>
                <td></td>
            </tr>
            <tr class="row0">
                <td><?php echo $newsletter->lng->SMTPUSER; ?></td>
                <td><input type="text" name="CFG_SMTPUSER" value="<?php echo $newsletter->cfg->get('SMTPUSER'); ?>" class="inputbox" dir="ltr" size="40" autocomplete="off" /></td>
                <td></td>
            </tr>
            <tr class="row1">
                <td><?php echo $newsletter->lng->SMTPPASS; ?></td>
                <td><input type="password" name="CFG_SMTPPASS" value="<?php echo $newsletter->cfg->get('SMTPPASS'); ?>" class="inputbox" dir="ltr" size="40" autocomplete="off" /></td>
                <td></td>
            </tr>
            <tr class="row0">
                <td><?php echo $newsletter->lng->SHOWCOPYRIGHT; ?></td>
                <td><?php echo mosHTML::yesnoRadioList('CFG_SHOWCOPYRIGHT', '', $newsletter->cfg->get('SHOWCOPYRIGHT')); ?></td>
                <td><?php echo $newsletter->lng->SHOWCOPYRIGHTD; ?></td>
            </tr>
        </table>
        <input type="hidden" name="option" value="com_newsletter" />
        <input type="hidden" name="task" value="" />
    	</form>

<?php 
	}


	/*************************/
	/* HTML LIST SUBSCRIBERS */
	/*************************/
	static public function listSubscribers($rows, $pageNav, $lists, $formfilters=array()) {
		global $newsletter, $adminLanguage, $mainframe;
		
		$textdir = (_GEM_RTL == 1) ? 'right' : 'left';
?>

		<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/components/com_newsletter/includes/iosnlajax.js"></script>

		<form name="adminForm" action="index2.php" method="post">
		<table class="adminheading">
		<tr>
			<th class="massemail"><?php echo $newsletter->lng->NEWSLETTER.' : '.$newsletter->lng->SUBSCRIBERS; ?></th>
		</tr>
		</table>

		<table class="adminlist" summary="List of existing newsletter subscribers">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
			<th class="title"><?php echo $adminLanguage->A_NAME; ?></th>
			<th class="title"><?php echo $adminLanguage->A_MAIL; ?></th>
			<th align="<?php echo $textdir; ?>">
                <?php echo $adminLanguage->A_GROUP; ?>
                <a href="javascript:void(null);" onclick="javascript:showLayer('selectgroup');">
                <?php 
                echo '<img src=';
                echo ($formfilters['filter_group'] != '') ? '"images/downarrow3.png" title="'.$adminLanguage->A_FILTERED.'"' : '"images/downarrow2.png" title="'.$adminLanguage->A_FILTER.'"';
                echo 'border="0" />';
                ?>
                </a>
                <div id="selectgroup" style="display:none; position:absolute;" class="filter">
                    <div class="filtertop"><?php echo $adminLanguage->A_FILTERGROUP; ?></div>
                    <?php echo $lists['subgroups']; ?>
                    <div class="filterbottom">
                        <a href="javascript:void(0);" onclick="javascript:hideLayer('selectgroup');" style="color: #888888;"><?php echo $adminLanguage->A_CLOSE; ?></a>
                    </div>
			     </div>
			</th>
			<th><?php echo $newsletter->lng->CONFIRMED; ?></th>
			<th class="title"><?php echo $adminLanguage->A_USERNAME; ?></th>
			<th class="title"><?php echo $adminLanguage->A_DATE; ?></th>
			<th><?php echo $adminLanguage->A_LANGUAGE; ?></th>
		</tr>
<?php 
		$k = 0;
		for ($i=0; $i<count($rows); $i++) {
			$row = $rows[$i];

			$img = $row->confirmed ? 'tick.png' : 'publish_x.png';
			$task = $row->confirmed ? 'unpublish' : 'publish';
			$alt = $row->confirmed ? $newsletter->lng->CONFIRMED : $newsletter->lng->UNCONFIRMED;
?>

			<tr class="row<?php echo $k; ?>">
				<td align="center"><?php echo $pageNav->rowNumber($i); ?></td>
				<td><input type="checkbox" id="cb<?php echo $i; ?>" name="cid[]" value="<?php echo $row->sid; ?>" onclick="isChecked(this.checked);" /></td>
				<td><a href="index2.php?option=com_newsletter&task=editA&sid=<?php echo $row->sid; ?>&hidemainmenu=1" title="<?php echo $adminLanguage->A_EDIT; ?>">
					<?php echo $row->subname.' '.$row->subsurname; ?>
				</a>
				</td>
				<td><?php echo $row->subemail; ?></td>
				<td><?php echo (trim($row->subgroup) != '') ? $row->subgroup : $adminLanguage->A_NONE; ?></td>
				<td align="center">
                    <div id="subscribertatus<?php echo $i; ?>">
                        <a href="javascript: void(null);" onclick="changeNLState('<?php echo $i; ?>', '<?php echo $row->sid; ?>', '<?php echo ($row->confirmed) ? 0 : 1; ?>');" title="<?php echo $alt; ?>">
                        <img src="images/<?php echo $img; ?>" border="0" alt="<?php echo $alt; ?>" /></a>
                    </div>
				</td>
				<td><?php echo ($row->username && (trim($row->username) != '')) ? $row->username : $newsletter->lng->GUEST; ?></td>
				<td><?php echo eLOCALE::strftime_os(_GEM_DATE_FORMLC, $row->subtime); ?></td>
				<td align="center"><?php echo (trim($row->sublang) == '') ? $newsletter->lng->ANYLANG : $newsletter->translatedLang($row->sublang); ?></td>
			</tr>
<?php 
			$k = 1 - $k;
		}
?>

		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="com_newsletter" />
		<input type="hidden" name="task" value="subscribers" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>

<?php 
	}


	/****************************/
	/* HTML ADD/EDIT SUBSCRIBER */
	/****************************/
	static public function editSubscriber($row, $lists) {
		global $newsletter, $adminLanguage, $mainframe;
?>

		<script type="text/javascript">
		/* <![CDATA[ */
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			if (form.subname.value == '') {
				alert( "<?php echo $newsletter->lng->NAMEEMPTY; ?>" );
			} else if (form.subsurname.value == ''){
                alert( "<?php echo $newsletter->lng->SURNAMEEMPTY; ?>" );
			} else if (!filter.test(form.subemail.value)) {
				alert("<?php echo $newsletter->lng->PROVALIDEMAIL; ?>");
			} else {
				submitform( pressbutton );
			}
		}
		/* ]]> */
		</script>

		<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/components/com_newsletter/includes/iosnlajax.js" charset="utf-8"></script>

		<form name="adminForm" action="index3.php" method="post">
		<table class="adminheading">
		<tr>
			<th class="massemail"><?php echo $newsletter->lng->SUBSCRIBERS; ?> : 
                <?php echo $row->sid ? $adminLanguage->A_EDIT : $adminLanguage->A_NEW; ?>
			</th>
		</tr>
		</table>

		<table cellspacing="0" cellpadding="0" class="adminform">
		<tr>
			<th colspan="2" class="title"><?php echo $adminLanguage->A_DETAILS; ?></th>
		</tr>
		<tr>
			<td width="200"><?php echo $newsletter->lng->NAME; ?></td>
			<td>
                <input class="inputbox" type="text" size="40" name="subname" id="subname" value="<?php echo $row->subname; ?>" maxlength="60" />
			</td>
		</tr>
		<tr>
			<td><?php echo $newsletter->lng->SURNAME; ?></td>
			<td>
                <input class="inputbox" type="text" size="40" name="subsurname" id="subsurname" value="<?php echo $row->subsurname; ?>" maxlength="60" />
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_USER; ?></td>
			<td>
				<?php echo $lists['userid']; ?> &nbsp; 
				<a href="javascript:void(0)" onclick="iosnluserdata();" title="<?php echo $newsletter->lng->GETUSERDATA; ?>">
					<?php echo $newsletter->lng->GETUSERDATA; ?>
				</a>
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_EMAIL; ?></td>
			<td>
                <input type="text" size="40" name="subemail" id="subemail" value="<?php echo $row->subemail; ?>" maxlength="80" class="inputbox" />
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_GROUP; ?></td>
			<td>
				<?php echo $lists['subgroups']; ?> &nbsp; 
				<?php echo $adminLanguage->A_NEW; ?>: 
				<input type="text" name="newsubgroup" value="" maxlength="80" class="inputbox" />
			</td>
		</tr>
		<tr>
			<td><?php echo $newsletter->lng->CONFIRMED; ?></td>
			<td>
                <?php echo mosHTML::yesnoRadioList('confirmed', '', $row->confirmed); ?>
			</td>
		</tr>
<?php 
		if (trim($row->confirmcode) != '') {
?>
		<tr>
			<td><?php echo $newsletter->lng->CONFCODE; ?></td>
			<td><strong><?php echo $row->confirmcode; ?></strong></td>
		</tr>
<?php 
	}
?>

		<tr>
			<td><?php echo $newsletter->lng->RECIEVEIN; ?></td>
			<td>
			<select name="sublang" class="selectbox" title="<?php echo $adminLanguage->A_LANGUAGE; ?>">
			<?php 
			if (trim($newsletter->cfg->get('LANGS')) == '') {
				echo '<option value="" selected="selected">'.$newsletter->lng->ANYLANG."</option>\n";
			} else {
				$sel = (trim($row->sublang) == '') ? ' selected="selected"' : '';
				echo '<option value=""'.$sel.'>'.$newsletter->lng->ANYLANG."</option>\n";
				$nlangs = explode(',', trim($newsletter->cfg->get('LANGS')));
				foreach ($nlangs as $nlang) {
					$sel = (trim($row->sublang) == $nlang) ? ' selected="selected"' : '';
					echo '<option value="'.$nlang.'"'.$sel.'>'.$newsletter->translatedLang($nlang).'</option>'._LEND;
				}
				unset($nlangs);			
			}
			?>
			</select>
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_DATE; ?></td>
			<td><?php echo eLOCALE::strftime_os(_GEM_DATE_FORMLC, $row->subtime); ?></td>
		</tr>
		</table>
		<input type="hidden" name="subtime" value="<?php echo $row->subtime; ?>" />
		<input type="hidden" name="confirmcode" value="<?php echo $row->confirmcode; ?>" />
		<input type="hidden" name="sid" value="<?php echo intval($row->sid); ?>" />
		<input type="hidden" name="option" value="com_newsletter" />
		<input type="hidden" name="task" value="" />
		</form>
<?php 
	}


	/********************************/
	/* HTML IMPORT SUBSCRIBERS FORM */
	/********************************/
	static public function importSubscribers() {
		global $newsletter, $adminLanguage;
?>

		<script type="text/javascript">
		function nlimportelxis() {
			var purl = 'index3.php?option=com_newsletter&task=importelxis';
			popupWindow(purl, '<?php echo $newsletter->lng->IMPORTELXUS; ?>', '350', '200', 'no');
		}
		</script>

		<form name="adminForm" action="index3.php" method="post" enctype="multipart/form-data">
		<table class="adminheading">
		<tr>
			<th class="massemail"><?php echo $newsletter->lng->NEWSLETTER.' : '.$newsletter->lng->IMPORTSUB; ?></th>
		</tr>
		</table>

		<table class="adminform" summary="Import newsletter subscribers for backup file">
		<tr>
			<th colspan="2"><?php echo $newsletter->lng->IMPORTSUB; ?></th>
			<th width="30%"><?php echo $newsletter->lng->IMPORTELXUS; ?></th>
		</tr>
		<tr>
			<td colspan="2"><?php echo $newsletter->lng->IMPORTD; ?><br />
			<?php echo $newsletter->lng->IMPORTCUSTOM; ?><br /><br />
			<span style="font-weight: bold; color: green;">userid,name,surname,e-mail,language,group</span><br /><br />
			<?php echo $newsletter->lng->IMPORTGIDL; ?>
			</td>
			<td rowspan="4" valign="top" align="center">
				<fieldset>
				<legend style="font-weight: bold;"><?php echo $newsletter->lng->IMPORTELXUS; ?></legend>
				<?php echo $newsletter->lng->IMPORTELXUSD; ?><br /><br />
				<input type="button" name="elximport" value="<?php echo $newsletter->lng->IMPORTELXUS; ?>" class="button" onclick="nlimportelxis();" />
				</fieldset>
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_FILE; ?></td>
			<td><input type="file" name="backupfile" value="" /></td>
		</tr>
		<tr>
			<td colspan="2">
			<input type="checkbox" name="checkmail" checked="checked" /> <?php echo $newsletter->lng->IMPORTUNIQUE; ?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="hidden" name="option" value="com_newsletter" />
				<input type="hidden" name="task" value="doimport" />
				<input type="submit" name="subimport" value="<?php echo $newsletter->lng->IMPORT; ?>" class="button" />
			</td>
		</tr>
		</table>
		</form>
<?php 
	}


	/*************************/
	/* HTML LIST NEWSLETTERS */
	/*************************/
	static public function listMessages($rows, $pageNav) {
		global $newsletter, $adminLanguage, $mainframe;
?>

		<script type="text/javascript">
			function nlpreview(id, s) {
				var purl = '<?php echo $newsletter->aurl; ?>/includes/preview.php?id='+id+'&s='+s;
				popupWindow(purl, '<?php echo $adminLanguage->A_PREVIEW; ?>', '700', '400', 'yes');
			}
		</script>

		<form name="adminForm" action="index2.php" method="post">
		<table class="adminheading">
		<tr>
			<th class="massemail"><?php echo $newsletter->lng->NEWSLETTERS; ?></th>
		</tr>
		</table>

		<table class="adminlist" summary="List of existing newsletter subscribers">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" /></th>
			<th class="title"><?php echo $newsletter->lng->SUBJECT; ?></th>
			<th><?php echo $newsletter->lng->PLAINTEXT; ?></th>
			<th><?php echo $newsletter->lng->TEXTHTML; ?></th>
			<th><?php echo $newsletter->lng->HTMLFILE; ?></th>
			<th><?php echo $newsletter->lng->RECIPIENTS; ?></th>
			<th class="title"><?php echo $newsletter->lng->LASTSENT; ?></th>
			<th><?php echo $adminLanguage->A_LANGUAGE; ?></th>
		</tr>

<?php 
		$k = 0;
		for ($i=0; $i<count($rows); $i++) {
			$row = $rows[$i];
?>

			<tr class="row<?php echo $k; ?>">
				<td align="center"><?php echo $pageNav->rowNumber($i); ?></td>
				<td><input type="checkbox" id="cb<?php echo $i; ?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" /></td>
				<td><a href="index2.php?option=com_newsletter&task=editnlA&id=<?php echo $row->id; ?>&hidemainmenu=1" title="<?php echo $adminLanguage->A_EDIT; ?>">
					<?php echo (eUTF::utf8_strlen($row->subject) > 40) ?  eUTF::utf8_substr($row->subject, 0, 37).'...' : $row->subject; ?>
				</a>
				</td>
				<td align="center">
					<?php 
					if (trim($row->textplain) != '') {
						echo '<a href="javascript:void(0);" title="'.$adminLanguage->A_PREVIEW.'" onclick="nlpreview('.$row->id.', 1);">';
						echo '<img src="'.$newsletter->aurl.'/images/viewmag.png" alt="'.$adminLanguage->A_PREVIEW.'" border="0" /> '._LEND;
						echo "</a>\n";
					} else {
						echo '<img src="images/publish_x.png" alt="'.$newsletter->lng->PLAINTEXT.'" border="0" />'._LEND;
					}
					?>
				</td>
				<td align="center">
					<?php 
					if (trim($row->texthtml) != '') {
						echo '<a href="javascript:void(0);" title="'.$adminLanguage->A_PREVIEW.'" onclick="nlpreview('.$row->id.', 2);">';
						echo '<img src="'.$newsletter->aurl.'/images/viewmag.png" alt="'.$adminLanguage->A_PREVIEW.'" border="0" /> '._LEND;
						echo "</a>\n";
					} else {
						echo '<img src="images/publish_x.png" alt="'.$newsletter->lng->TEXTHTML.'" border="0" />'._LEND;
					}
					?>
				</td>
				<td align="center">
					<?php 
					if (trim($row->htmlfile) != '') {
						echo '<a href="javascript:void(0);" title="'.$adminLanguage->A_PREVIEW.' '.$row->htmlfile.'" onclick="nlpreview('.$row->id.', 3);">';
						echo '<img src="'.$newsletter->aurl.'/images/viewmag.png" alt="'.$adminLanguage->A_PREVIEW.' '.$row->htmlfile.'" border="0" /> '._LEND;
						echo "</a>\n";
					} else {
						echo '<img src="images/publish_x.png" alt="'.$newsletter->lng->HTMLFILE.'" border="0" />'._LEND;
					}
					?>
				</td>
				<td align="center"><?php echo $row->recipients; ?></td>
				<td><?php
				if (($row->lastsent == '0') || (!is_numeric($row->lastsent))) {
					echo $adminLanguage->A_NEVER;
				} else {
					echo eLOCALE::strftime_os(_GEM_DATE_FORMLC, $row->lastsent);
				}
				?></td>
				<td align="center"><?php echo (trim($row->msglang) == '') ? $newsletter->lng->ANYLANG : $newsletter->translatedLang($row->msglang); ?></td>
			</tr>
<?php 
			$k = 1 - $k;
		}
?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="com_newsletter" />
		<input type="hidden" name="task" value="newsletters" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
<?php 
	}


	/****************************/
	/* HTML ADD/EDIT NEWSLETTER */
	/****************************/
	static public function editNewsletter($row, $lists) {
		global $newsletter, $adminLanguage, $mainframe;
		
		mosMakeHtmlSafe($row, ENT_QUOTES, 'texthtml');
?>

		<script type="text/javascript">
		/* <![CDATA[ */
		function nlpreview(id, s) {
			if (id == '0') {
				alert('<?php echo $newsletter->lng->FIRSTSAVEPR; ?>');
			} else {
				var purl = '<?php echo $newsletter->aurl; ?>/includes/preview.php?id='+id+'&s='+s;
				popupWindow(purl, '<?php echo $adminLanguage->A_PREVIEW; ?>', '700', '400', 'yes');
			}
		}

		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancelnl') {
				submitform(pressbutton);
				return;
			}

			if (form.subject.value == '') {
				alert( "<?php echo $newsletter->lng->SUBJECTEMPTY; ?>" );
			} else {
				<?php getEditorContents('editor1', 'htmltext'); ?>
				submitform( pressbutton );
			}
		}
		/* ]]> */
		</script>

		<form name="adminForm" action="index3.php" method="post">
		<table class="adminheading">
		<tr>
			<th class="massemail"><?php echo $newsletter->lng->NEWSLETTER; ?> : 
                <?php echo $row->id ? $adminLanguage->A_EDIT : $adminLanguage->A_NEW; ?>
			</th>
		</tr>
		</table>

		<table cellspacing="0" cellpadding="0" class="adminform">
		<tr>
			<th colspan="2" class="title"><?php echo $adminLanguage->A_DETAILS; ?></th>
		</tr>
		<tr>
			<td width="200"><?php echo $newsletter->lng->SUBJECT; ?></td>
			<td>
                <input type="text" class="inputbox" size="60" name="subject" id="subject" value="<?php echo $row->subject; ?>" maxlength="180" />
			</td>
		</tr>
		<tr>
			<td width="200"><?php echo $adminLanguage->A_LANGUAGE; ?></td>
			<td><?php echo $lists['msglang']; ?></td>
		</tr>
		<tr>
			<td valign="top">
				<?php 
				echo $newsletter->lng->HTMLFILE."\n";
				if (trim($row->htmlfile) != '') {
					echo ' &nbsp; <a href="javascript:void(0);" title="'.$adminLanguage->A_PREVIEW.'" onclick="nlpreview('.$row->id.', 3);">';
					echo '<img src="'.$newsletter->aurl.'/images/viewmag.png" alt="'.$adminLanguage->A_PREVIEW.'" border="0" /> '._LEND;
					echo "</a>\n";
				}				
				?>
			</td>
            <td>
				<?php echo $lists['htmlfile']; ?> 
				<?php echo $newsletter->lng->HTMLFILED; ?>
			</td>
		</tr>
		<tr>
			<td valign="top">
				<?php 
				echo $newsletter->lng->PLAINTEXT."\n";
				if (trim($row->textplain) != '') {
					echo ' &nbsp; <a href="javascript:void(0);" title="'.$adminLanguage->A_PREVIEW.'" onclick="nlpreview('.$row->id.', 1);">';
					echo '<img src="'.$newsletter->aurl.'/images/viewmag.png" alt="'.$adminLanguage->A_PREVIEW.'" border="0" /> '._LEND;
					echo "</a>\n";
				}
				?>
			</td>
			<td>
                <textarea class="text_area" name="textplain" id="textplain" cols="90" rows="10"><?php echo $row->textplain; ?></textarea>
			</td>
		</tr>
		<tr>
			<td valign="top">
				<?php 
				echo $newsletter->lng->TEXTHTML."\n";
				if (trim($row->htmltext) != '') {
					echo ' &nbsp; <a href="javascript:void(0);" title="'.$adminLanguage->A_PREVIEW.'" onclick="nlpreview('.$row->id.', 2);">';
					echo '<img src="'.$newsletter->aurl.'/images/viewmag.png" alt="'.$adminLanguage->A_PREVIEW.'" border="0" /> '._LEND;
					echo "</a>\n";
				}
				?>
			</td>
			<td>
			<?php
				editorArea('editor1', $row->texthtml, 'texthtml', '600', '400', '90', '20' );
			?>
			</td>
		</tr>
		</table>
		<input type="hidden" name="lastsent" value="<?php echo $row->lastsent; ?>" />
		<input type="hidden" name="recipients" value="<?php echo intval($row->recipients); ?>" />
		<input type="hidden" name="id" value="<?php echo intval($row->id); ?>" />
		<input type="hidden" name="option" value="com_newsletter" />
		<input type="hidden" name="task" value="" />
		</form>

<?php 
	}


	/***************************/
	/* SEND NEWSLETTER OPTIONS */
	/***************************/
	static public function sendNewsletter($row, $recipients, $lists) {
		global $newsletter, $adminLanguage, $mainframe;
?>

		<script type="text/javascript">
		/* <![CDATA[ */
		function openSender(id) {
			var form = document.adminForm;
			if (form.force.checked == true) {
				var forced = 1;
			} else {
				var forced = 0;
			}

			var selObj = document.getElementById('mailformat');
			var format = selObj.options[selObj.selectedIndex].value;

			var grpObj = document.getElementById('subgroup');
			var subgroup = grpObj.options[grpObj.selectedIndex].value;

			var purl = '<?php echo $newsletter->aurl; ?>/includes/sender.php?id='+id+'&forced='+forced+'&format='+format+'&subgroup='+subgroup;
			popupWindow(purl, '<?php echo $newsletter->lng->SENDNEWSLETTER; ?>', '450', '250', 'no');
		}
		/* ]]> */
		</script>

		<form name="adminForm" action="index3.php" method="post">
		<table class="adminheading">
		<tr>
			<th class="massemail"><?php echo $newsletter->lng->SENDNEWSLETTER; ?></th>
		</tr>
		</table>

		<table cellspacing="0" cellpadding="0" class="adminform">
		<tr>
			<th colspan="3" class="title"><?php echo $newsletter->lng->NEWSLETTER; ?></th>
		</tr>
		<tr>
			<td width="200"><?php echo $newsletter->lng->SUBJECT; ?></td>
			<td width="500"><?php echo $row->subject; ?></td>
			<td rowspan="5" valign="top">
			<?php 
				echo $newsletter->lng->SUBSTOTAL.': <strong>'.$recipients['total']."</strong><br />\n";
				if (count($recipients['langs']) > 0) {
					foreach ($recipients['langs'] as $lng => $value) {
						$xlang = $newsletter->translatedLang($lng);
						echo sprintf($newsletter->lng->SUBSCRIBERSIN, $xlang).': <strong>'.$value."</strong><br />\n";
					}
				}
			?>
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_LANGUAGE; ?></td>
			<td><?php echo $newsletter->translatedLang($row->msglang); ?></td>
		</tr>
		<tr>
			<td><?php echo $newsletter->lng->MAILFORMAT; ?></td>
			<td>
			<select name="mailformat" id="mailformat" class="selectbox">
			<?php 
			$isPlain = (trim($row->textplain) != '') ? 1 : 0;
			$isHtml = ((trim($row->htmlfile) != '') || (trim($row->texthtml) != '')) ? 1 : 0;

			if ($isPlain && $isHtml) {
				echo '<option value="1">'.$newsletter->lng->PLAINTEXT."</option>\n";
				echo '<option value="2">'.$newsletter->lng->TEXTHTML."</option>\n";
				echo '<option value="3" selected="selected">'.$newsletter->lng->PLAINTEXT." + ".$newsletter->lng->TEXTHTML."</option>\n";
			} else if ($isPlain) {
				echo '<option value="1" selected="selected">'.$newsletter->lng->PLAINTEXT."</option>\n";
			} else if ($isHtml) {
				echo '<option value="2" selected="selected">'.$newsletter->lng->TEXTHTML."</option>\n";
			}
			?>
			</select>
			</td>
		</tr>
		<tr>
		<td colspan="2">
			<input type="checkbox" name="force" id="force" value="1" /> <?php echo $newsletter->lng->FORCESEND; ?>
		</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_GROUP; ?></td>
			<td><?php echo $lists['subgroups']; ?></td>
		</tr>
		<tr>
			<td colspan="2" align="center" style="text-align: center;">
				<br />
				<input type="hidden" name="id" value="<?php echo intval($row->id); ?>" />
				<input type="hidden" name="option" value="com_newsletter" />
				<input type="hidden" name="task" value="dosend" />				
				<input type="button" name="sendnow" class="button" value="<?php echo $newsletter->lng->SENDNOW; ?>" onclick="openSender('<?php echo intval($row->id); ?>');" />
				<br /><br />
			</td>
		</tr>
		</table>
		</form>
		
<?php 
	}

}

?>