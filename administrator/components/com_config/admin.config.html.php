<?php 
/**
* @version: $Id: admin.config.html.php 2294 2009-03-05 21:11:46Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Config
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_config {

	public function showconfig( &$row, &$lists, $option) {
		global $mainframe, $adminLanguage, $my;

        //CSRF prevention
        $tokname = 'token'.$my->id;
		$mytoken = md5(uniqid(rand(), TRUE));
        $_SESSION[$tokname] = $mytoken;

		$tabs = new mosTabs(1);
?>
		<script type="text/javascript">
		/* <![CDATA[ */
	        function saveFilePerms() {
				var f = document.adminForm;
				if (f.filePermsMode0.checked)
					f.config_fileperms.value = '';
				else {
					var perms = 0;
		        	if (f.filePermsUserRead.checked) perms += 400;
					if (f.filePermsUserWrite.checked) perms += 200;
					if (f.filePermsUserExecute.checked) perms += 100;
					if (f.filePermsGroupRead.checked) perms += 40;
					if (f.filePermsGroupWrite.checked) perms += 20;
					if (f.filePermsGroupExecute.checked) perms += 10;
					if (f.filePermsWorldRead.checked) perms += 4;
					if (f.filePermsWorldWrite.checked) perms += 2;
					if (f.filePermsWorldExecute.checked) perms += 1;
					f.config_fileperms.value = '0'+''+perms;
				}
	        }
	        function changeFilePermsMode(mode) {
	            if(document.getElementById) {
	                switch (mode) {
	                    case 0:
	                        document.getElementById('filePermsValue').style.display = 'none';
	                        document.getElementById('filePermsTooltip').style.display = '';
	                        document.getElementById('filePermsFlags').style.display = 'none';
	                    break;
	                    default:
	                        document.getElementById('filePermsValue').style.display = '';
	                        document.getElementById('filePermsTooltip').style.display = 'none';
	                        document.getElementById('filePermsFlags').style.display = '';
	                    break;
	                }
	            }
				saveFilePerms();
	        }
	        function saveDirPerms() {
				var f = document.adminForm;
				if (f.dirPermsMode0.checked)
					f.config_dirperms.value = '';
				else {
					var perms = 0;
		        	if (f.dirPermsUserRead.checked) perms += 400;
					if (f.dirPermsUserWrite.checked) perms += 200;
					if (f.dirPermsUserSearch.checked) perms += 100;
					if (f.dirPermsGroupRead.checked) perms += 40;
					if (f.dirPermsGroupWrite.checked) perms += 20;
					if (f.dirPermsGroupSearch.checked) perms += 10;
					if (f.dirPermsWorldRead.checked) perms += 4;
					if (f.dirPermsWorldWrite.checked) perms += 2;
					if (f.dirPermsWorldSearch.checked) perms += 1;
					f.config_dirperms.value = '0'+''+perms;
				}
	        }
	        function changeDirPermsMode(mode) {
	            if(document.getElementById) {
	                switch (mode) {
	                    case 0:
	                        document.getElementById('dirPermsValue').style.display = 'none';
	                        document.getElementById('dirPermsTooltip').style.display = '';
	                        document.getElementById('dirPermsFlags').style.display = 'none';
	                        break;
	                    default:
	                        document.getElementById('dirPermsValue').style.display = '';
	                        document.getElementById('dirPermsTooltip').style.display = 'none';
	                        document.getElementById('dirPermsFlags').style.display = '';
	                }
	            }
				saveDirPerms();
	        }

	        function changeHelpSrv(srv) {
	            if(document.getElementById) {
	                switch (srv) {
	                    case 0:
	                        document.getElementById('helpsrvurl').style.display = 'none';
	                        document.adminForm.config_helpurl.value = '';
	                    break;
	                    case 1:
	                        document.getElementById('helpsrvurl').style.display = '';
	                        document.adminForm.config_helpurl.value = '<?php echo $row->config_helpurl; ?>';
	                        document.adminForm.config_helpurl.focus();
	                    break;
	                    case 2:
	                        document.getElementById('helpsrvurl').style.display = '';
	                        document.adminForm.config_helpurl.value = 'http://help.elxis.org';
	                    break;
	                    default:
	                    break;
	                }
	            }
	        }

			var ftpajax = new sack();
			function whenLoadingftp(){
				var e = document.getElementById(ftpajax.element);
				e.innerHTML = "<img src='images/loading.gif' border='0' />";
			}
			function checkftp() {
				var e = document.getElementById('ftpstatus');
				e.style.display = "";
				ftpajax.setVar("option", 'com_config');
				ftpajax.setVar("task", 'checkftp');
				ftpajax.requestFile = "index3.php";
				ftpajax.method = 'GET';
				ftpajax.element = 'ftpstatus';
				ftpajax.onLoading = whenLoadingftp;
				ftpajax.onLoaded = whenLoadingftp;
				ftpajax.onInteractive = whenLoadingftp;
				ftpajax.runAJAX();
			}

			function checkseopro() {
				var seoObj = document.getElementById('config_sef');
				var seoval = seoObj.options[seoObj.selectedIndex].value;
				var cacheObj = document.getElementById('config_cache');
				var cacheval = cacheObj.options[cacheObj.selectedIndex].value;
				if ((cacheval == '2') && (seoval != '2')) {
					document.getElementById('cachewarn').innerHTML = '<?php echo $adminLanguage->A_C_CONF_SEODIS; ?>';
				} else {
					document.getElementById('cachewarn').innerHTML = '';
				}
			}
        /* ]]> */
		</script>
		<form action="index3.php" method="post" name="adminForm">
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
	    <table cellpadding="1" cellspacing="1" border="0" width="100%">
		<tr>
	        <td width="250">
				<table class="adminheading">
					<tr><th nowrap="nowrap" class="config"><?php echo $adminLanguage->A_MENU_GC; ?></th></tr>
				</table>
			</td>
	        <td width="270">
	            <span class="componentheading">configuration.php <?php echo $adminLanguage->A_CMP_LNG_IS; ?> :
			 	<?php echo is_writable($mainframe->getCfg('absolute_path').'/configuration.php' ) ? '<span style="font-weight: bold; color: green;">'. $adminLanguage->A_WRITABLE .'</span>' : '<span style="font-weight: bold; color: red;">'. $adminLanguage->A_UNWRITABLE .'</span>' ?>
			</span>
			</td>
<?php
	        if (mosIsChmodable($mainframe->getCfg('absolute_path').'/configuration.php')) {
	            if (is_writable($mainframe->getCfg('absolute_path').'/configuration.php')) {
?>
	        <td>
	            <input type="checkbox" id="disable_write" name="disable_write" value="1" />
	            <label for="disable_write"><?php echo $adminLanguage->A_MKUNWRAFSV; ?></label>
	        </td>
<?php
	            } else {
?>
	        <td>
	            <input type="checkbox" id="enable_write" name="enable_write" value="1" />
	            <label for="enable_write"><?php echo $adminLanguage->A_MKOV_UNWRAFSV; ?></label>
	        </td>
<?php
	            }
	        }
?>
	    </tr>
	    </table>
<?php
		$tabs->startPane("configPane");
		$tabs->startTab($adminLanguage->A_SITE,"site-page");
?>
		<table class="adminform">
		<tr>
			<td width="185"><?php echo $adminLanguage->A_COMP_CONF_OFFLINE; ?>:</td>
			<td><?php echo $lists['offline']; ?></td>
		</tr>
		<tr>
			<td valign="top"><?php echo $adminLanguage->A_COMP_CONF_OFFMESSAGE; ?>:</td>
			<td><textarea class="text_area" cols="60" rows="2" style="width:500px; height:40px;" name="config_offline_message"><?php echo $row->config_offline_message; ?></textarea><?php
				$tip = $adminLanguage->A_COMP_CONF_TIP_OFFMESSAGE;
				echo mosToolTip( $tip );
			?></td>
		</tr>
		<tr>
			<td valign="top"><?php echo $adminLanguage->A_COMP_CONF_ERR_MESSAGE; ?>:</td>
			<td><textarea class="text_area" cols="60" rows="2" style="width:500px; height:40px;" name="config_error_message"><?php echo htmlspecialchars($row->config_error_message, ENT_QUOTES); ?></textarea><?php
				$tip = $adminLanguage->A_COMP_CONF_TIP_ERR_MESSAGE;
				echo mosToolTip( $tip );
			?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_SITE_NAME; ?>:</td>
			<td><input class="inputbox" type="text" name="config_sitename" size="50" value="<?php echo $row->config_sitename; ?>" /></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_CLINKACC; ?>:</td>
			<td>
				<?php echo $lists['frontaccess']; ?>
				<?php echo mosToolTip($adminLanguage->A_COMP_CONF_CLACCDESC); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_CAPTCHA; ?>:</td>
			<td>
				<?php echo $lists['captcha']; ?> 
				<?php echo mosToolTip($adminLanguage->A_COMP_CONF_CAPTCHATIP); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_UN_LINKS; ?>:</td>
			<td>
				<?php echo $lists['auth']; ?> 
				<?php echo mosToolTip($adminLanguage->A_COMP_CONF_UN_TIP); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_USER_REG; ?>:</td>
			<td>
				<?php echo $lists['allowuserregistration']; ?> 
				<?php echo mosToolTip($adminLanguage->A_COMP_CONF_TIP_USER_REG); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_C_CONF_AC_ACT; ?>:</td>
			<td>
				<?php echo $lists['useractivation']; ?> 
				<?php echo mosToolTip($adminLanguage->A_C_CONF_AC_ACTD); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_REQ_EMAIL; ?>:</td>
			<td>
				<?php echo $lists['uniquemail']; ?> 
				<?php echo mosToolTip($adminLanguage->A_COMP_CONF_REQTIP); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_DEBUG; ?>:</td>
			<td>
				<?php echo $lists['debug']; ?>
				<?php echo mosToolTip($adminLanguage->A_COMP_CONF_DEBTIP); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_EDITOR; ?>:</td>
			<td><?php echo $lists['editor']; ?></td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_LENGTH; ?>:</td>
			<td>
				<?php echo $lists['list_length']; ?> 
				<?php echo mosToolTip($adminLanguage->A_COMP_CONF_LENTIP); ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_FAV_ICON; ?>:</td>
			<td>
				<input class="inputbox" type="text" name="config_favicon" dir="ltr" size="20" value="<?php echo $row->config_favicon; ?>" />
				<?php echo mosToolTip($adminLanguage->A_COMP_CONF_FAVTIP, $adminLanguage->A_COMP_CONF_FAV_ICON); ?>			
			</td>
		</tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_COMP_CONF_LOCALE, "Locale-page" );
		?>
		<table class="adminform">
		<tr>
			<td width="185"><?php echo $adminLanguage->A_COMP_CONF_LANG; ?>:</td>
			<td><?php echo $lists['lang']; ?>
            <input type="hidden" name="config_pub_langs" value="<?php echo $mainframe->getCfg('pub_langs'); ?>" /></td>
		</tr>
        <tr>
			<td width="185"><?php echo $adminLanguage->A_COMP_CONF_ALANG; ?>:</td>
			<td>
			<?php echo $lists['alang']; ?>
			</td>
		</tr>
		<tr>
			<td width="185"><?php echo $adminLanguage->A_COMP_CONF_TIME_SET; ?>:</td>
			<td>
			<?php echo $lists['offset']; ?>
<?php 
			$tip = $adminLanguage->A_COMP_CONF_DATE .': '. mosCurrentDate(_GEM_DATE_FORMLC2);
			if (phpversion() >= 5.1) {
				$tip .= ', TimeZone: '.@date_default_timezone_get();	
			}
			echo mosToolTip($tip);
?>			</td>
		</tr>
		<tr>
			<td width="185"><?php echo $adminLanguage->A_COMP_CONF_LOCAL; ?>:</td>
			<td><?php 
            echo $lists['locale'];
			echo mosToolTip( $adminLanguage->A_COMP_CONF_LOCRECOM );           
            ?>
            </td>
		</tr>
		<tr>
			<td width="185"><?php echo $adminLanguage->A_COMP_CONF_LOCCHECK; ?>:</td>
			<td><?php 
            echo eLOCALE::strftime_os ("%A %d %B %Y", mktime (0, 0, 0, date('m'), date('d'), date('Y')));
            echo ' &nbsp; ';
			echo mosToolTip( $adminLanguage->A_COMP_CONF_LOCCHECK2 ); 
            ?>
            </td>
		</tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_MENU_CONTENT, "content-page" );
		?>
		<table class="adminform">
		<tr>
			<td colspan="2"><?php echo $adminLanguage->A_COMP_CONF_CONTROL; ?><br /><br /></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_LINK_TITLES; ?>:</td>
			<td width="100%"><?php echo $lists['link_titles'].' '.mosToolTip( $adminLanguage->A_COMP_CONF_LTITLES_TIP ); ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_MORE_LINK; ?>:</td>
			<td><?php echo $lists['readmore'].' '.mosToolTip( $adminLanguage->A_COMP_CONF_MLINK_TIP ); ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_RATE_VOTE; ?>:</td>
			<td><?php echo $lists['vote'].' '.mosToolTip($adminLanguage->A_COMP_CONF_RVOTE_TIP); ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_AUTHOR; ?>:</td>
			<td><?php echo $lists['hideauthor'].' '.mosToolTip($adminLanguage->A_COMP_CONF_AUTHORTIP); ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_CREATED; ?>:</td>
			<td><?php echo $lists['hidecreate'].' '.mosToolTip($adminLanguage->A_COMP_CONF_CREATEDTIP); ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_MOD_DATE; ?>:</td>
			<td><?php echo $lists['hidemodify'].' '.mosToolTip($adminLanguage->A_COMP_CONF_MDATETIP); ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_HITS; ?>:</td>
			<td><?php echo $lists['hits'].' '.mosToolTip($adminLanguage->A_COMP_CONF_HITSTIP); ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_C_CONF_COMMENTS; ?>:</td>
			<td><?php echo $lists['comments'].' '.mosToolTip($adminLanguage->A_C_CONF_COMMENTSTIP); ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_RTF; ?>:</td>
			<td><?php echo $lists['hidertf']; ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_PDF; ?>:</td>
			<td><?php echo $lists['hidepdf']; ?> 
			<?php if (!is_writable($mainframe->getCfg('absolute_path').'/tmpr/' )) { echo mosToolTip( $adminLanguage->A_COMP_CONF_OPT_MEDIA ); } ?>
			</td>		
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_PRINT_ICON; ?>:</td>
			<td><?php echo $lists['hideprint']; ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_EMAIL_ICON; ?>:</td>
			<td><?php echo $lists['hideemail']; ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_ICONS; ?>:</td>
			<td><?php echo $lists['icons'].' '.mosToolTip( $adminLanguage->A_COMP_CONF_USE_OR_TEXT ); ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_TBL_CONTENTS; ?>:</td>
			<td><?php echo $lists['multipage_toc']; ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_BACK_BUTTON; ?>:</td>
			<td><?php echo $lists['back_button']; ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_CONTENT_NAV; ?></td>
			<td><?php echo $lists['item_navigation']; ?></td>
		</tr>
		</table>
<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_COMP_CONF_DB_NAME, "db-page" );
?>
		<table class="adminform">
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_DBTYPE; ?>:</td>
			<td width="100%"><?php echo $lists['dbtype']; ?> 
            <?php echo mosWarning( $adminLanguage->A_COMP_CONF_DBWARN, $adminLanguage->A_WARNING ); ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_HOSTNAME; ?>:</td>
			<td><input class="inputbox" type="text" name="config_host" dir="ltr" size="25" value="<?php echo $row->config_host; ?>" /></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_USERNAME; ?>:</td>
			<td><input class="inputbox" type="text" name="config_user" dir="ltr" size="25" value="<?php echo $row->config_user; ?>" /></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_DB_PW; ?>:</td>
			<td><input class="inputbox" type="password" name="config_password" dir="ltr" size="25" value="<?php echo $row->config_password; ?>" /></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_DB_NAME; ?>:</td>
			<td><input class="inputbox" type="text" name="config_db" dir="ltr" size="25" value="<?php echo $row->config_db; ?>" /></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_DB_PREFIX; ?>:</td>
			<td>
            <input class="inputbox" type="text" name="config_dbprefix" dir="ltr" size="10" value="<?php echo $row->config_dbprefix; ?>" />
			&nbsp;<?php echo mosWarning( $adminLanguage->A_COMP_CONF_NOT_CH, $adminLanguage->A_WARNING ); ?>
			</td>
		</tr>
		</table>
<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_COMP_CONF_SERVER, "server-page" );
?>
		<table class="adminform">
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_ABS_PATH; ?>:</td>
			<td width="100%"><strong><?php echo $row->config_path; ?></strong></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_LIVE; ?>:</td>
			<td><strong><?php echo $row->config_live_site; ?></strong></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_SECRET; ?>:</td>
			<td><strong><?php echo $row->config_secret; ?></strong></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_GZIP; ?>:</td>
			<td>
            <?php echo $lists['gzip']; ?> 
			<?php echo mosToolTip( $adminLanguage->A_COMP_CONF_CP_BUFFER ); ?>
			</td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_SESSION_TIME; ?>:</td>
			<td>
			<input class="inputbox" type="text" name="config_lifetime" size="10" dir="ltr" value="<?php echo $row->config_lifetime; ?>" />
			&nbsp;<?php echo $adminLanguage->A_COMP_CONF_SEC; ?>&nbsp;
			<?php echo mosToolTip( $adminLanguage->A_COMP_CONF_AUTO_LOGOUT ); ?>
			</td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_ERR_REPORT; ?>:</td>
			<td><?php echo $lists['error_reporting']; ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_HELP_SERVER; ?>:</td>
			<td>
			<fieldset>
            <legend><?php echo $adminLanguage->A_COMP_CONF_HELP_SERVER; ?></legend>
            <input type="radio" id="helpsrv0" name="helpsrv" value="0" onclick="changeHelpSrv(0)"<?php if (!$row->config_helpurl) echo ' checked="checked"'; ?>/> <?php echo $adminLanguage->A_COMP_CONF_HPS1; ?>
            <input type="radio" id="helpsrv1" name="helpsrv" value="1" onclick="changeHelpSrv(1)"<?php if ($row->config_helpurl) echo ' checked="checked"'; ?>/> <?php echo $adminLanguage->A_COMP_CONF_HPS2; ?>
            <input type="radio" id="helpsrv2" name="helpsrv" value="2" onclick="changeHelpSrv(2)"/> <?php echo $adminLanguage->A_COMP_CONF_HPS3; ?>
            <div id="helpsrvurl"<?php if (!$row->config_helpurl) { echo ' style="display:none"'; } ?>>
            <input class="inputbox" type="text" name="config_helpurl" dir="ltr" size="50" value="<?php echo $row->config_helpurl; ?>" />
            </div>
            </fieldset>
            </td>
		</tr>
		<tr>
<?php
	$mode = 0;
	$flags = 0644;
	if ($row->config_fileperms!='') {
		$mode = 1;
		$flags = octdec($row->config_fileperms);
	}
?>
			<td valign="top" nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_FCRE; ?></td>
	        <td>
	            <fieldset><legend><?php echo $adminLanguage->A_COMP_CONF_FPERM; ?></legend>
	                <table cellpadding="1" cellspacing="1" border="0">
	                    <tr>
	                        <td><input type="radio" id="filePermsMode0" name="filePermsMode" value="0" onclick="changeFilePermsMode(0)"<?php if (!$mode) echo ' checked="checked"'; ?>/></td>
	                        <td><label for="filePermsMode0"><?php echo $adminLanguage->A_DONTCHMODNFL; ?></label></td>
	                    </tr>
	                    <tr>
	                        <td><input type="radio" id="filePermsMode1" name="filePermsMode" value="1" onclick="changeFilePermsMode(1)"<?php if ($mode) echo ' checked="checked"'; ?>/></td>
	                        <td>
								<label for="filePermsMode1"><?php echo $adminLanguage->A_CHMODNEWFLS; ?></label>
								<span id="filePermsValue"<?php if (!$mode) echo ' style="display:none"'; ?>>
								<?php echo $adminLanguage->A_TO; ?>: <input class="inputbox" type="text" readonly="readonly" dir="ltr" name="config_fileperms" size="4" value="<?php echo $row->config_fileperms; ?>"/>
								</span>
								<span id="filePermsTooltip"<?php if ($mode) echo ' style="display:none"'; ?>>
								&nbsp;<?php echo mosToolTip($adminLanguage->A_COMP_CONF_PERMFLES); ?>
								</span>
							</td>
	                    </tr>
						<tr id="filePermsFlags"<?php if (!$mode) echo ' style="display:none"'; ?>>
	                        <td>&nbsp;</td>
	                        <td>
	                            <table cellpadding="0" cellspacing="1" border="0">
	                                <tr>
	                                    <td style="padding: 0px;"><?php echo $adminLanguage->A_USER;?>:</td>
	                                    <td style="padding: 0px;"><input type="checkbox" id="filePermsUserRead" name="filePermsUserRead" value="1" onclick="saveFilePerms()"<?php if ($flags & 0400) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding: 0px;"><label for="filePermsUserRead"><?php echo $adminLanguage->A_COMP_CONF_READ;?></label></td>
	                                    <td style="padding: 0px;"><input type="checkbox" id="filePermsUserWrite" name="filePermsUserWrite" value="1" onclick="saveFilePerms()"<?php if ($flags & 0200) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding: 0px;"><label for="filePermsUserWrite"><?php echo $adminLanguage->A_COMP_CONF_WRITE;?></label></td>
	                                    <td style="padding: 0px;"><input type="checkbox" id="filePermsUserExecute" name="filePermsUserExecute" value="1" onclick="saveFilePerms()"<?php if ($flags & 0100) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding: 0px;" colspan="3"><label for="filePermsUserExecute"><?php echo $adminLanguage->A_COMP_CONF_EXEC;?></label></td>
	                                </tr>
	                                <tr>
	                                    <td style="padding: 0px;"><?php echo $adminLanguage->A_GROUP; ?>:</td>
	                                    <td style="padding: 0px;"><input type="checkbox" id="filePermsGroupRead" name="filePermsGroupRead" value="1" onclick="saveFilePerms()"<?php if ($flags & 040) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding: 0px;"><label for="filePermsGroupRead"><?php echo $adminLanguage->A_COMP_CONF_READ;?></label></td>
	                                    <td style="padding: 0px;"><input type="checkbox" id="filePermsGroupWrite" name="filePermsGroupWrite" value="1" onclick="saveFilePerms()"<?php if ($flags & 020) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding: 0px;"><label for="filePermsGroupWrite"><?php echo $adminLanguage->A_COMP_CONF_WRITE;?></label></td>
	                                    <td style="padding: 0px;"><input type="checkbox" id="filePermsGroupExecute" name="filePermsGroupExecute" value="1" onclick="saveFilePerms()"<?php if ($flags & 010) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding: 0px;" width="70"><label for="filePermsGroupExecute"><?php echo $adminLanguage->A_COMP_CONF_EXEC;?></label></td>
										<td><input type="checkbox" id="applyFilePerms" name="applyFilePerms" value="1"/></td>
	                                    <td nowrap="nowrap">
											<label for="applyFilePerms">
												<?php echo $adminLanguage->A_COMP_CONF_APPEXFILES; ?>
												&nbsp;<?php
												echo mosWarning( $adminLanguage->A_COMP_CONF_CHAPFLAGS ); ?>
											</label>
										</td>
	                                </tr>
	                                <tr>
	                                    <td style="padding: 0px;"><?php echo $adminLanguage->A_COMP_CONF_WORLD; ?>:</td>
	                                    <td style="padding: 0px;"><input type="checkbox" id="filePermsWorldRead" name="filePermsWorldRead" value="1" onclick="saveFilePerms()"<?php if ($flags & 04) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding: 0px;"><label for="filePermsWorldRead"><?php echo $adminLanguage->A_COMP_CONF_READ; ?></label></td>
	                                    <td style="padding: 0px;"><input type="checkbox" id="filePermsWorldWrite" name="filePermsWorldWrite" value="1" onclick="saveFilePerms()"<?php if ($flags & 02) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding: 0px;"><label for="filePermsWorldWrite"><?php echo $adminLanguage->A_COMP_CONF_WRITE; ?></label></td>
	                                    <td style="padding: 0px;"><input type="checkbox" id="filePermsWorldExecute" name="filePermsWorldExecute" value="1" onclick="saveFilePerms()"<?php if ($flags & 01) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding: 0px;" colspan="4"><label for="filePermsWorldExecute"><?php echo $adminLanguage->A_COMP_CONF_EXEC; ?></label></td>
	                                </tr>
	                            </table>
	                        </td>
	                    </tr>
	                </table>
	            </fieldset>
	        </td>
	    </tr>
	    <tr>
<?php
	$mode = 0;
	$flags = 0755;
	if ($row->config_dirperms!='') {
		$mode = 1;
		$flags = octdec($row->config_dirperms);
	}
?>
			<td valign="top" nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_DCRE; ?>:</td>
	        <td>
	            <fieldset><legend><?php echo $adminLanguage->A_COMP_CONF_DPERM; ?></legend>
	                <table cellpadding="1" cellspacing="1" border="0">
	                    <tr>
	                        <td><input type="radio" id="dirPermsMode0" name="dirPermsMode" value="0" onclick="changeDirPermsMode(0)"<?php if (!$mode) echo ' checked="checked"'; ?>/></td>
	                        <td><label for="dirPermsMode0"><?php echo $adminLanguage->A_COMP_CONF_NCHMODDIRS; ?></label></td>
	                    </tr>
	                    <tr>
	                        <td><input type="radio" id="dirPermsMode1" name="dirPermsMode" value="1" onclick="changeDirPermsMode(1)"<?php if ($mode) echo ' checked="checked"'; ?>/></td>
	                        <td>
								<label for="dirPermsMode1"><?php echo $adminLanguage->A_COMP_CONF_CHMODNDIRS; ?></label>
								<span id="dirPermsValue"<?php if (!$mode) echo ' style="display:none"'; ?>>
   							    <?php echo $adminLanguage->A_TO; ?>: <input class="inputbox" type="text" readonly="readonly" dir="ltr" name="config_dirperms" size="4" value="<?php echo $row->config_dirperms; ?>"/>
								</span>
								<span id="dirPermsTooltip"<?php if ($mode) echo ' style="display:none"'; ?>>
								&nbsp;<?php echo mosToolTip($adminLanguage->A_COMP_CONF_PERMDIRS); ?>
								</span>
							</td>
	                    </tr>
	                    <tr id="dirPermsFlags"<?php if (!$mode) echo ' style="display:none"'; ?>>
	                        <td>&nbsp;</td>
	                        <td>
	                            <table cellpadding="1" cellspacing="0" border="0">
	                                <tr>
	                                    <td style="padding: 0px;"><?php echo $adminLanguage->A_USER; ?>:</td>
	                                    <td style="padding: 0px;"><input type="checkbox" id="dirPermsUserRead" name="dirPermsUserRead" value="1" onclick="saveDirPerms()"<?php if ($flags & 0400) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding: 0px;"><label for="dirPermsUserRead"><?php echo $adminLanguage->A_COMP_CONF_READ; ?></label></td>
	                                    <td style="padding: 0px;"><input type="checkbox" id="dirPermsUserWrite" name="dirPermsUserWrite" value="1" onclick="saveDirPerms()"<?php if ($flags & 0200) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding: 0px;"><label for="dirPermsUserWrite"><?php echo $adminLanguage->A_COMP_CONF_WRITE; ?></label></td>
	                                    <td style="padding: 0px;"><input type="checkbox" id="dirPermsUserSearch" name="dirPermsUserSearch" value="1" onclick="saveDirPerms()"<?php if ($flags & 0100) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding: 0px;" colspan="3"><label for="dirPermsUserSearch"><?php echo $adminLanguage->A_SEARCH; ?></label></td>
	                                </tr>
	                                <tr>
	                                    <td style="padding: 0px;"><?php echo $adminLanguage->A_GROUP; ?>:</td>
	                                    <td style="padding: 0px;"><input type="checkbox" id="dirPermsGroupRead" name="dirPermsGroupRead" value="1" onclick="saveDirPerms()"<?php if ($flags & 040) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding: 0px;"><label for="dirPermsGroupRead"><?php echo $adminLanguage->A_COMP_CONF_READ; ?></label></td>
	                                    <td style="padding: 0px;"><input type="checkbox" id="dirPermsGroupWrite" name="dirPermsGroupWrite" value="1" onclick="saveDirPerms()"<?php if ($flags & 020) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding: 0px;"><label for="dirPermsGroupWrite"><?php echo $adminLanguage->A_COMP_CONF_WRITE; ?></label></td>
	                                    <td style="padding: 0px;"><input type="checkbox" id="dirPermsGroupSearch" name="dirPermsGroupSearch" value="1" onclick="saveDirPerms()"<?php if ($flags & 010) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding: 0px;" width="70"><label for="dirPermsGroupSearch"><?php echo $adminLanguage->A_SEARCH; ?></label></td>
										<td><input type="checkbox" id="applyDirPerms" name="applyDirPerms" value="1"/></td>
	                                    <td nowrap="nowrap">
											<label for="applyDirPerms">
												<?php echo $adminLanguage->A_COMP_CONF_APPEXDIRS; ?>
												&nbsp;<?php
												echo mosWarning( $adminLanguage->A_COMP_CONF_CHAPDLAGS );?>
											</label>
										</td>
	                                </tr>
	                                <tr>
	                                    <td style="padding: 0px;"><?php echo $adminLanguage->A_COMP_CONF_WORLD; ?>:</td>
	                                    <td style="padding: 0px;"><input type="checkbox" id="dirPermsWorldRead" name="dirPermsWorldRead" value="1" onclick="saveDirPerms()"<?php if ($flags & 04) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding: 0px;"><label for="dirPermsWorldRead"><?php echo $adminLanguage->A_COMP_CONF_READ; ?></label></td>
	                                    <td style="padding: 0px;"><input type="checkbox" id="dirPermsWorldWrite" name="dirPermsWorldWrite" value="1" onclick="saveDirPerms()"<?php if ($flags & 02) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding: 0px;"><label for="dirPermsWorldWrite"><?php echo $adminLanguage->A_COMP_CONF_WRITE; ?></label></td>
	                                    <td style="padding: 0px;"><input type="checkbox" id="dirPermsWorldSearch" name="dirPermsWorldSearch" value="1" onclick="saveDirPerms()"<?php if ($flags & 01) echo ' checked="checked"'; ?>/></td>
	                                    <td style="padding: 0px;" colspan="3"><label for="dirPermsWorldSearch"><?php echo $adminLanguage->A_SEARCH; ?></label></td>
	                                </tr>
	                            </table>
	                        </td>
	                    </tr>
	                </table>
	            </fieldset>
	        </td>
	      </tr>
		</table>
<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_COMP_CONF_METADATA, "metadata-page" );
?>
		<table class="adminform">
		<tr>
			<td valign="top" nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_META_DESC;?>:</td>
			<td width="100%"><textarea class="text_area" cols="50" rows="3" style="width: 500px; height: 50px;" name="config_metadesc"><?php echo $row->config_metadesc; ?></textarea></td>
		</tr>
		<tr>
			<td valign="top" nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_META_KEY;?>:</td>
			<td><textarea class="text_area" cols="50" rows="3" style="width: 500px; height: 50px;" name="config_metakeys"><?php echo $row->config_metakeys; ?></textarea></td>
		</tr>
		</table>
<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_MAIL, "mail-page" );
?>
		<table class="adminform">
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_MAIL;?>:</td>
			<td width="100%"><?php echo $lists['mailer']; ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_MAIL_FROM; ?>:</td>
			<td><input class="inputbox" type="text" name="config_mailfrom" dir="ltr" size="25" value="<?php echo $row->config_mailfrom; ?>" /></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_MAIL_FROM_NAME; ?>:</td>
			<td><input class="inputbox" type="text" name="config_fromname" size="25" value="<?php echo $row->config_fromname; ?>" /></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_SENDP; ?>:</td>
			<td><input class="inputbox" type="text" name="config_sendmail" dir="ltr" size="50" value="<?php echo $row->config_sendmail; ?>" /></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_MAIL_SMTP_AUTH; ?>:</td>
			<td><?php echo $lists['smtpauth']; ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_MAIL_SMTP_USER; ?>:</td>
			<td><input class="inputbox" type="text" name="config_smtpuser" dir="ltr" size="15" value="<?php echo $row->config_smtpuser; ?>" /></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_MAIL_SMTP_PASS;?>:</td>
			<td><input class="inputbox" type="password" name="config_smtppass" dir="ltr" size="12" value="<?php echo $row->config_smtppass; ?>" /></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_MAIL_SMTP_HOST;?>:</td>
			<td><input class="inputbox" type="text" name="config_smtphost" dir="ltr" size="20" value="<?php echo $row->config_smtphost; ?>" /></td>
		</tr>
		</table>
<?php 
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_COMP_CONF_CACHE_TAB, "cache-page" );
?>
		<table class="adminform" border="0" width="100%">
<?php 
		if (is_writeable($row->config_cachepath)) {
?>
			<tr>
				<td width="20%"><?php echo $adminLanguage->A_COMP_CONF_CACHE; ?>:</td>
				<td>
					<?php echo $lists['cache']; ?> 
					<?php echo mosToolTip($adminLanguage->A_C_CONF_CACHED); ?> &nbsp; 
					<span id="cachewarn" style="font-weight: bold; color: #FF0000;">
					<?php 
					if (($mainframe->getCfg('static_cache') == 1) && ($mainframe->getCfg('sef') != 2)) {
						echo $adminLanguage->A_C_CONF_SEODIS;
					}
					?>
					</span>
				</td>
			</tr>
<?php 
		}
?>
		<tr>
			<td width="20%"><?php echo $adminLanguage->A_COMP_CONF_CACHE_FOLDER; ?>:</td>
			<td>
			<input class="inputbox" type="text" name="config_cachepath" dir="ltr" size="50" value="<?php echo $row->config_cachepath; ?>" />
<?php
			if (is_writeable($row->config_cachepath)) {
				echo mosToolTip( $adminLanguage->A_COMP_CONF_CACHE_DIR ." <strong>". $adminLanguage->A_WRITABLE ."</strong>");
			} else {
				echo mosWarning( $adminLanguage->A_COMP_CONF_CACHE_DIR_UNWRT );
			}
?>			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_COMP_CONF_CACHE_TIME; ?>:</td>
			<td><input class="inputbox" type="text" name="config_cachetime" dir="ltr" size="5" value="<?php echo $row->config_cachetime; ?>" /> <?php echo $adminLanguage->A_COMP_CONF_SEC;?></td>
		</tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_MENU_STATISTICS, "stats-page" );
		?>
		<table class="adminform">
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_STATS; ?>:</td>
			<td nowrap="nowrap"><?php echo $lists['enable_stats']; ?></td>
			<td width="100%"><?php echo mostooltip( $adminLanguage->A_COMP_CONF_STATS_ENABLE ); ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_STATS_LOG_HITS; ?>:</td>
			<td><?php echo $lists['log_items']; ?></td>
			<td><span class="error"><?php echo mosWarning( $adminLanguage->A_COMP_CONF_STATS_WARN_DATA ); ?></span></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_STATS_LOG_SEARCH; ?>:</td>
			<td><?php echo $lists['log_searches']; ?></td>
			<td>&nbsp;</td>
		</tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_COMP_CONF_SEO_LBL, "seo-page" );
		?>
		<table class="adminform">
		<tr>
			<td nowrap="nowrap"><strong><?php echo $adminLanguage->A_COMP_CONF_SEO; ?></strong></td>
			<td width="100%">&nbsp;</td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_SEO_SEFU; ?>:</td>
			<td><?php echo $lists['sef']; ?> 
			<span class="error"><?php echo mosWarning( $adminLanguage->A_COMP_CONF_SEOHELP ); ?></span>
			</td>
		</tr>
		</table>
        <?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_COMP_CONF_FTP_LBL, "ftp-page" );
		?>
		<table class="adminform">
		<tr>
			<td nowrap="nowrap"><strong><?php echo $adminLanguage->A_COMP_CONF_FTP; ?></strong></td>
			<td width="100%">&nbsp;</td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_FTP_ENB; ?>:</td>
			<td><?php echo $lists['useftp']; ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_FTP_HST; ?>:</td>
			<td><input class="inputbox" type="text" name="config_ftphost" dir="ltr" size="25" value="<?php echo $row->config_ftphost; ?>" /> 
            <?php 
            $fhost = 'ftp.'.preg_replace('/^(www\.)/', '', $_SERVER['HTTP_HOST']);
            echo mosToolTip( $adminLanguage->A_COMP_CONF_FTP_HSTTP. ': '.$fhost ); 
            ?>
            </td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_FTP_USR; ?>:</td>
			<td><input class="inputbox" type="text" name="config_ftpuser" dir="ltr" size="25" value="<?php echo $row->config_ftpuser; ?>" /> 
            <?php 
            if (strtoupper(substr(PHP_OS, 0, 3)) != 'WIN') {
                $owner = @fileowner($mainframe->getCfg('absolute_path'));
                if (function_exists('posix_getpwuid')) {
                	$owner = @posix_getpwuid($owner);
                	$owner = $owner['name'];
                } else {
                	$owner = 'Unknown';
                }
                echo mosToolTip( $adminLanguage->A_COMP_CONF_FTP_USRTP.': '.$owner );
            }
            ?>
            </td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_FTP_PAS; ?>:</td>
			<td><input class="inputbox" type="password" name="config_ftppass" dir="ltr" size="25" value="<?php echo $row->config_ftppass; ?>" /></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_FTP_PRT; ?>:</td>
			<td><input class="inputbox" type="text" name="config_ftpport" dir="ltr" size="5" value="<?php echo $row->config_ftpport; ?>" /> 
			<?php echo mosToolTip( $adminLanguage->A_COMP_CONF_FTP_PRTTP ); ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_COMP_CONF_FTP_PTH; ?>:</td>
			<td><input class="inputbox" type="text" name="config_ftproot" dir="ltr" size="30" value="<?php echo $row->config_ftproot; ?>" /> 
			<?php echo mosToolTip( $adminLanguage->A_COMP_CONF_FTP_PTHTP ); ?></td>
		</tr>
		<tr>
			<td nowrap="nowrap" valign="top">
				<a href="javascript:void(null);" onclick="checkftp();"><?php echo $adminLanguage->A_C_CONF_CHKFTP; ?></a>
			</td>
			<td>
				<div id="ftpstatus"></div>
			</td>
		</tr>
		</table>
<?php 
		$tabs->endTab();
		$tabs->endPane();
?>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="config_path" value="<?php echo $row->config_path; ?>" />
		<input type="hidden" name="config_live_site" value="<?php echo $row->config_live_site; ?>" />
		<input type="hidden" name="config_secret" value="<?php echo $row->config_secret; ?>" />
		<input type="hidden" name="<?php echo $tokname; ?>" value="<?php echo $mytoken; ?>" autocomplete="off" />
		<input type="hidden" name="task" value="" />
		</form>
		<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/includes/js/overlib_mini.js"></script>
<?php
	}

}

?>