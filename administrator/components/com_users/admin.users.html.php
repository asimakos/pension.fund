<?php 
/**
* @version: $Id: admin.users.html.php 55 2010-06-13 08:57:20Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Users
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_users {

	static public function showUsers( &$rows, $pageNav, $search, $option, $lists, $formfilters=array() ) {
		global $adminLanguage, $mainframe;
?>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="user"><?php echo $adminLanguage->A_MENU_USER_MANAGE; ?></th>
			<td align="<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>" nowrap="nowrap"><?php echo $adminLanguage->A_FILTER; ?>:</td>
			<td>
				<input type="text" name="search" value="<?php echo $search; ?>" class="inputbox" onchange="document.adminForm.submit();" />
			</td>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="2%" class="title"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="3%" class="title">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
			</th>
			<th class="title"><?php echo $adminLanguage->A_NAME; ?></th>
			<th nowrap="nowrap">
            <?php echo $adminLanguage->A_CMP_USS_LOGIN; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectlogged')">
            <?php 
            echo '<img src=';
            echo ( $formfilters['filter_logged'] == '1' )  ? '"images/downarrow3.png" title="'.$adminLanguage->A_FILTERED.'"' : '"images/downarrow2.png" title="'.$adminLanguage->A_FILTER.'"';
            echo 'border="0" />';
            ?>
            </a>
            <div id="selectlogged" style="display:none; position:absolute;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_CMP_USS_FLOGD; ?></div>
                <?php echo $lists['logged']; ?>
                <div class="filterbottom">
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selectlogged');" style="color: #888888"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			</div>
			</th>
			<th>
            <?php echo $adminLanguage->A_CMP_USS_ENBLD; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectenabled')">
            <?php 
            echo '<img src=';
            echo ($formfilters['filter_enabled'] > -1)  ? '"images/downarrow3.png" title="'.$adminLanguage->A_FILTERED.'"' : '"images/downarrow2.png" title="'.$adminLanguage->A_FILTER.'"';
            echo 'border="0" />';
            ?>
            </a>
            <div id="selectenabled" style="display:none; position:absolute;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_CMP_USS_FACST; ?></div>
                <?php echo $lists['enabled']; ?>
                <div class="filterbottom">
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selectenabled');" style="color: #888888"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			</div>
			</th>
			<th class="title" >
            <?php echo $adminLanguage->A_CMP_USS_ID; ?>
			</th>
			<th class="title">
            <?php echo $adminLanguage->A_GROUP; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selecttype')">
            <?php 
            echo '<img src=';
            echo (( $formfilters['filter_type'] != '' ) && ( $formfilters['filter_type'] != '0' )) ? '"images/downarrow3.png" title="'.$adminLanguage->A_FILTERED.'"' : '"images/downarrow2.png" title="'.$adminLanguage->A_FILTER.'"';
            echo 'border="0" />';
            ?>
            </a>
            <div id="selecttype" style="display:none; position:absolute;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_FILTERGROUP; ?></div>
                <?php echo $lists['type'];?>
                <div class="filterbottom">
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selecttype');" style="color: #888888"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			</div>
			</th>
			<th class="title"><?php echo $adminLanguage->A_EMAIL; ?></th>
			<th>
            <?php echo $adminLanguage->A_USERS_EXPDATE; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectexpired')">
            <?php 
            echo '<img src=';
            echo ($formfilters['filter_expired'] > -1) ? '"images/downarrow3.png" title="'.$adminLanguage->A_FILTERED.'"' : '"images/downarrow2.png" title="'.$adminLanguage->A_FILTER.'"';
            echo 'border="0" />';
            ?>
            </a>
            <div id="selectexpired" style="display:none; position:absolute;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_FILTER; ?></div>
                <?php echo $lists['expired']; ?>
                <div class="filterbottom">
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selectexpired');" style="color: #888888"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			</div>
			</th>
			<th class="title"><?php echo $adminLanguage->A_CMP_USS_LSTV; ?></th>
		</tr>
		<?php 
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = $rows[$i];

			$img = $row->block ? 'publish_x.png' : 'tick.png';
			$task = $row->block ? 'unblock' : 'block';
            $alt = $row->block ? $adminLanguage->A_ENABLED : $adminLanguage->A_CMP_USS_BLCKD;
			$link = 'index2.php?option=com_users&amp;task=editA&amp;id='.$row->id.'&amp;hidemainmenu=1';
			?>
			<tr class="row<?php echo $k; ?>">
				<td><?php echo $i+1+$pageNav->limitstart; ?></td>
				<td><?php echo mosHTML::idBox( $i, $row->id ); ?></td>
                <?php $avatarimg = (trim($row->avatar) == '') ? 'noavatar.png' : $row->avatar; ?>
                <td><a href="<?php echo $link; ?>" onmouseover="this.T_TITLE='<?php echo $row->username; ?>';this.T_WIDTH=104;this.T_TEXTALIGN='center';return escape('<img src=\'../images/avatars/<?php echo $avatarimg; ?>\'>')">
                <?php echo $row->name; ?></a></td>
				<td align="center" style="text-align:center;">
				<?php echo $row->loggedin ? '<img src="images/tick.png" width="12" height="12" border="0" alt="" />': ''; ?>
				</td>
				<td align="center" style="text-align:center;">
				<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $task; ?>')">
				<img src="images/<?php echo $img; ?>" width="12" height="12" border="0" title="<?php echo $alt; ?>" /></a>
				</td>
				<td><?php echo $row->username; ?></td>
				<td><?php echo $row->groupname; ?></td>
				<td><a href="mailto:<?php echo $row->email; ?>"><?php echo $row->email; ?></a></td>
				<td nowrap="nowrap" align="center" style="text-align:center;"><?php  
                if ($row->expires == '2060-01-01 00:00:00') {
                    echo $adminLanguage->A_NEVER;
                } else {
                	$spanred = ($row->expires < date('Y-m-d H:i:s')) ? 1 : 0;
                	if ($spanred) {
                    	echo '<span style="color: #990000;">'.mosFormatDate($row->expires, _GEM_DATE_FORMLC).'</span>';
                    } else {
                    	echo mosFormatDate($row->expires, _GEM_DATE_FORMLC);
                    }
                }
                ?></td>
				<td nowrap="nowrap"><?php  
                if ($row->lastvisitdate == '1979-12-19 00:00:00') {
                    echo $adminLanguage->A_NEVER;
                } else {
                    echo mosFormatDate($row->lastvisitdate, $adminLanguage->A_CMP_USS_LVDATE); 
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
		<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/includes/js/wz_tooltip<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.js"></script>
<?php 
	}


    /******************/
    /* HTML EDIT USER */
    /******************/
	static public function edituser( &$row, &$contact, &$lists, $option, $uid, $enprof ) {
		global $my, $acl, $adminLanguage, $mainframe;

		$tabs = new mosTabs(0);
		$canBlockUser = $acl->acl_check('administration', 'edit', 'users', $my->usertype, 'user properties', 'block_user');
        $grname = $acl->get_group_name($row->gid, 'ARO');

        $grname2 = eUTF::utf8_strtolower($grname);
        $canEmailEvents = $acl->acl_check('workflow', 'email_events', 'users', $grname2);
        //CSRF prevention
        $tokname = 'token'.$my->id;
		$mytoken = md5(uniqid(rand(), TRUE));
        $_SESSION[$tokname] = $mytoken;
        
        mosCommonHTML::loadCalendar();
?>
		<script type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");

			// do field validation
			if (trim(form.name.value) == "") {
				alert( "<?php echo $adminLanguage->A_ALERT_VALIDATE_NAME; ?>" );
			} else if (form.username.value == "") {
				alert( "<?php echo $adminLanguage->A_CMP_USS_UMUST; ?>" );
			} else if (r.exec(form.username.value) || form.username.value.length < 3) {
				alert( "<?php echo $adminLanguage->A_CMP_USS_ULOGIN; ?>" );
			} else if (trim(form.email.value) == "") {
				alert( "<?php echo $adminLanguage->A_CMP_USS_MSTEMAIL; ?>" );
			} else if (form.gid.value == "") {
				alert( "<?php echo $adminLanguage->A_CMP_USS_ASSIGN; ?>" );
			} else if (trim(form.password.value) != "" && form.password.value != form.password2.value){
				alert( "<?php echo $adminLanguage->A_CMP_USS_NOMATC; ?>" );
			} else if (form.gid.value == "29") {
				alert( "<?php echo $adminLanguage->A_CMP_USS_PFISNOT; ?>" );
			} else if (form.gid.value == "30") {
				alert( "<?php echo $adminLanguage->A_CMP_USS_PBISNOT; ?>" );
			<?php 
			if (count($lists['reqs'])>0) {
			     foreach ($lists['reqs'] as $req ) {
			         echo '} else if (form.'.$req.'.value == "") {'._LEND;
			         echo 'alert(\''.$adminLanguage->A_CMP_USS_REQFLDSNO.'\');'._LEND;
			     }
			}
			?>
			} else {
				submitform( pressbutton );
			}
		}

		function gotocontact( id ) {
			var form = document.adminForm;
			form.contact_id.value = id;
			submitform( 'contact' );
		}
		</script>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<form action="index3.php" method="post" name="adminForm" enctype="multipart/form-data">
		<table class="adminheading">
		<tr>
			<th class="user">
			<?php echo $adminLanguage->A_USER; ?>: <small><?php echo $row->id ? $adminLanguage->A_EDIT : $adminLanguage->A_ADD; ?></small>
			</th>
		</tr>
		</table>
		<table width="100%">
		<tr>
			<td width="50%" valign="top">
				<table class="adminform">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_CMP_USS_DETAILS; ?></th>
				</tr>
				<tr>
					<td width="150"><?php echo $adminLanguage->A_NAME; ?>:</td>
					<td><input type="text" name="name" class="inputbox" size="40" value="<?php echo $row->name; ?>" /></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_USERNAME; ?>:</td>
					<td><input type="text" name="username" dir="ltr" class="inputbox" size="40" value="<?php echo $row->username; ?>" autocomplete="off" /></td>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_USS_EMAIL; ?>:</td>
					<td><input type="text" name="email" dir="ltr" class="inputbox" size="40" value="<?php echo $row->email; ?>" autocomplete="off" /></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_USS_PASS; ?>:</td>
					<td><input type="password" name="password" dir="ltr" class="inputbox" size="40" value="" autocomplete="off" /></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_USS_VERIFY; ?>:</td>
					<td><input type="password" name="password2" dir="ltr" class="inputbox" size="40" value="" /></td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_GROUP; ?>:</td>
					<td><?php echo $lists['gid']; ?></td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_CMP_USS_PREFLANG; ?>:</td>
					<td><?php echo $lists['preflang']; ?></td>
				</tr>

<?php 
				if ($canBlockUser) {
?>
					<tr>
						<td><?php echo $adminLanguage->A_CMP_USS_BLOCK; ?></td>
						<td><?php echo $lists['block']; ?></td>
					</tr>
					<tr>
						<td valign="top"><?php echo $adminLanguage->A_USERS_EXPDATE; ?></td>
						<td>
							<input type="text" name="expires" id="expires" dir="ltr" class="inputbox" size="25" maxlength="19" value="<?php echo ($row->expires == '2060-01-01 00:00:00') ?  $adminLanguage->A_NEVER : $row->expires; ?>" />
							<input name="setedate" type="reset" class="button" onclick="return showCalendar('expires', 'y-mm-dd');" value="..." />
							<input name="setenever" type="button" class="button" style="background-color: green; color: #FFF;" onclick="document.getElementById('expires').value = '<?php echo $adminLanguage->A_NEVER; ?>';" value="<?php echo $adminLanguage->A_NEVER; ?>" />
<?php 
                			if ($row->expires < date('Y-m-d H:i:s')) {
                    			echo '<br /><span style="color: #990000;" dir="ltr">'.$adminLanguage->A_USERS_ACCEXPIRED.'</span>';
                    		}
?>
						</td>
					</tr>
<?php 
				} else {
?>
					<tr>
						<td valign="top"><?php echo $adminLanguage->A_USERS_EXPDATE; ?></td>
						<td>
							<?php 
                			$spanred = ($row->expires < date('Y-m-d H:i:s')) ? 1 : 0;
                			if ($spanred) {
                    			echo '<span style="color: #990000;" dir="ltr">'.mosFormatDate($row->expires, _GEM_DATE_FORMLC).'</span>';
                    		} else {
                    			echo ($row->expires == '2060-01-01 00:00:00') ?  $adminLanguage->A_NEVER : mosFormatDate($row->expires, _GEM_DATE_FORMLC);
                    		}
							?>
							<input type="hidden" name="expires" id="expires" dir="ltr" value="<?php echo mosFormatDate($row->expires, _GEM_DATE_FORMLC2); ?>" />
						</td>
					</tr>
<?php 
				}
?>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_CMP_USS_AVATAR; ?>:</td>
					<td valign="top"><?php echo $lists['avatar']; ?><br />
					<script type="text/javascript">
					if (document.forms[0].avatar.options.value!=''){
					  jsimg='../images/avatars/' + getSelectedValue( 'adminForm', 'avatar' );
					} else {
					  jsimg='../images/avatars/noavatar.png';
					}
					document.write('<img src=' + jsimg + ' name="imagelib" width="100" height="100" border="1" title="<?php echo $adminLanguage->A_CMP_USS_AVATAR; ?>" />');
					</script>
					<br />
					<?php echo $adminLanguage->A_NEW; ?>: <input type="file" name="upavatar" class="inputbox" />
                    </td>
				</tr>
<?php 
				if ($canEmailEvents) {
					?>
					<tr>
						<td><?php echo $adminLanguage->A_CMP_USS_SUBMI; ?></td>
						<td><?php echo $lists['sendemail']; ?></td>
					</tr>
					<?php
				}

				if ($uid) {
					?>
					<tr>
						<td><?php echo $adminLanguage->A_CMP_USS_REGDATE; ?></td>
						<td><?php echo $row->registerdate; ?></td>
					</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_USS_VISDTE; ?></td>
					<td><?php echo $row->lastvisitdate; ?></td>
				</tr>
					<?php
				}
				?>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				</table>
			</td>
			<td width="50%" valign="top">
			<?php
			$tabs->startPane("contact-pane");
			$tabs->startTab($adminLanguage->A_EXTRAFIELDS, "extra-page");
			?>
			<table class="adminform">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_EXTRAFIELDS; ?></th>
				</tr>
				<tr>
				    <td width="140"><?php 
                    if ($enprof['UPROF_WEBSITE']) {
                        echo '<b>'.$adminLanguage->A_CMP_USS_WEBSITE.'</b>'; 
                    } else {
                        echo $adminLanguage->A_CMP_USS_WEBSITE; 
                    }
                    ?></td>
				    <td><input type="text" name="website" dir="ltr" class="inputbox" size="40" value="<?php echo $row->website; ?>" /></td>
				</tr>
				<tr>
				    <td><?php 
                    if ($enprof['UPROF_AIM']) {
                        echo '<b>'.$adminLanguage->A_CMP_USS_AIM.'</b>'; 
                    } else {
                        echo $adminLanguage->A_CMP_USS_AIM; 
                    }
                    ?></td>
				    <td><input type="text" name="aim" dir="ltr" class="inputbox" maxlength="80" value="<?php echo $row->aim; ?>" /></td>
				</tr>
				<tr>
				    <td><?php 
                    if ($enprof['UPROF_YIM']) {
                        echo '<b>'.$adminLanguage->A_CMP_USS_YIM.'</b>'; 
                    } else {
                        echo $adminLanguage->A_CMP_USS_YIM; 
                    }
                    ?></td>
				    <td><input type="text" name="yim" dir="ltr" class="inputbox" maxlength="80" value="<?php echo $row->yim; ?>" /></td>
				</tr>
				<tr>
				    <td><?php 
                    if ($enprof['UPROF_MSN']) {
                        echo '<b>'.$adminLanguage->A_CMP_USS_MSN.'</b>'; 
                    } else {
                        echo $adminLanguage->A_CMP_USS_MSN; 
                    }
                    ?></td>
				    <td><input type="text" name="msn" dir="ltr" class="inputbox" maxlength="80" value="<?php echo $row->msn; ?>" /></td>
				</tr>
				<tr>
				    <td><?php 
                    if ($enprof['UPROF_ICQ']) {
                        echo '<b>'.$adminLanguage->A_CMP_USS_ICQ.'</b>'; 
                    } else {
                        echo $adminLanguage->A_CMP_USS_ICQ; 
                    }
                    ?></td>
				    <td><input type="text" name="icq" dir="ltr" class="inputbox" maxlength="60" value="<?php echo $row->icq; ?>" /></td>
				</tr>
				<tr>
				    <td><?php 
                    if ($enprof['UPROF_PHONE']) {
                        echo '<b>'.$adminLanguage->A_CMP_USS_PHONE.'</b>'; 
                    } else {
                        echo $adminLanguage->A_CMP_USS_PHONE; 
                    }
                    ?></td>
				    <td><input type="text" name="phone" dir="ltr" class="inputbox" maxlength="30" value="<?php echo $row->phone; ?>" /></td>
				</tr>
				<tr>
				    <td><?php 
                    if ($enprof['UPROF_MOBILE']) {
                        echo '<b>'.$adminLanguage->A_CMP_USS_MOBILE.'</b>'; 
                    } else {
                        echo $adminLanguage->A_CMP_USS_MOBILE; 
                    }
                    ?></td>
				    <td><input type="text" name="mobile" dir="ltr" class="inputbox" maxlength="30" value="<?php echo $row->mobile; ?>" /></td>
				</tr>
				<tr>
				    <td><?php 
                    if ($enprof['UPROF_BIRTHDATE']) {
                        echo '<b>'.$adminLanguage->A_CMP_USS_BIRTHDATE.'</b>'; 
                    } else {
                        echo $adminLanguage->A_CMP_USS_BIRTHDATE; 
                    }
                    ?></td>
				    <td>
                    <?php echo $adminLanguage->A_CMP_USS_YEAR; ?>: 
                    <input type="text" name="byear" dir="ltr" class="inputbox" size="4" maxlength="4" value="<?php echo $lists['byear']; ?>" /> 
                    <?php echo $adminLanguage->A_CMP_USS_MONTH; ?>: 
                    <input type="text" name="bmonth" dir="ltr" class="inputbox" size="2" maxlength="2" value="<?php echo $lists['bmonth']; ?>" /> 
                    <?php echo $adminLanguage->A_CMP_USS_DAY; ?>: 
                    <input type="text" name="bday" dir="ltr" class="inputbox" size="2" maxlength="2" value="<?php echo $lists['bday']; ?>" />
                    </td>
				</tr>
				<tr>
				    <td><?php 
                    if ($enprof['UPROF_GENDER']) {
                        echo '<b>'.$adminLanguage->A_CMP_USS_GENDER.'</b>'; 
                    } else {
                        echo $adminLanguage->A_CMP_USS_GENDER; 
                    }
                    ?></td>
				    <td><?php echo $lists['gender']; ?></td>
				</tr>
				<tr>
				    <td><?php 
                    if ($enprof['UPROF_LOCATION']) {
                        echo '<b>'.$adminLanguage->A_CMP_USS_LOCATION.'</b>'; 
                    } else {
                        echo $adminLanguage->A_CMP_USS_LOCATION; 
                    }
                    ?></td>
				    <td><input type="text" name="location" class="inputbox" size="40" maxlength="120" value="<?php echo $row->location; ?>" /></td>
				</tr>
				<tr>
				    <td><?php 
                    if ($enprof['UPROF_OCCUPATION']) {
                        echo '<b>'.$adminLanguage->A_CMP_USS_OCCUPATION.'</b>'; 
                    } else {
                        echo $adminLanguage->A_CMP_USS_OCCUPATION; 
                    }
                    ?></td>
				    <td><input type="text" name="occupation" class="inputbox" size="40" maxlength="120" value="<?php echo $row->occupation; ?>" /></td>
				</tr>
				<tr>
				    <td><?php 
                    if ($enprof['UPROF_SIGNATURE']) {
                        echo '<b>'.$adminLanguage->A_CMP_USS_SIGNATURE.'</b>'; 
                    } else {
                        echo $adminLanguage->A_CMP_USS_SIGNATURE; 
                    }
                    ?></td>
				    <td><textarea cols="40" rows="3" class="text_area" name="signature"><?php echo $row->signature; ?></textarea></td>
				</tr>
				<tr>
                    <td colspan="2"><?php 
                    echo $adminLanguage->A_CMP_USS_BOLDINDIC.'<br />'; 
                    echo $adminLanguage->A_CMP_USS_ENDISSOFT;
                    ?>
                    <hr /></td>
                </tr>
				<tr>
					<td colspan ="2"><?php echo $lists['extra']; ?></td>
				</tr>
			</table>
			<?php 
			$tabs->endTab();
			$tabs->startTab($adminLanguage->A_CMP_USS_CONTCT, "contact-page");

			if ( !$contact ) {
				?>
				<table class="adminform">
				<tr>
					<th><?php echo $adminLanguage->A_CMP_USS_CONTCT; ?></th>
				</tr>
				<tr>
					<td><br /><?php echo $adminLanguage->A_CMP_USS_NDETL; ?><br />
					<?php echo $adminLanguage->A_DETAILS; ?>: '<?php echo $adminLanguage->A_MENU_COMPONENTS; ?>' -&gt; '<?php echo $adminLanguage->A_CONTACT; ?>' -&gt; '<?php echo $adminLanguage->A_MENU_MANAGE_CONTACTS; ?>'
					<br /><br />
					</td>
				</tr>
				<?php
			} else {
				?>
				<table class="adminform">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_CMP_USS_CONTCT; ?></th>
				</tr>
				<tr>
					<td width="15%"><?php echo $adminLanguage->A_NAME; ?>:</td>
					<td><strong><?php echo $contact[0]->name; ?></strong></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_POSITION; ?>:</td>
					<td><strong><?php echo $contact[0]->con_position; ?></strong></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_USS_PHONE; ?>:</td>
					<td><strong><?php echo $contact[0]->telephone; ?></strong></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_USS_FAX; ?>:</td>
					<td><strong><?php echo $contact[0]->fax; ?></strong></td>
				</tr>
				<tr>
					<td></td>
					<td><strong><?php echo $contact[0]->misc; ?></strong></td>
				</tr>
				<?php
				if ($contact[0]->image) {
					?>
					<tr>
						<td></td>
						<td valign="top">
						<img src="<?php echo $mainframe->getCfg('live_site'); ?>/images/stories/<?php echo $contact[0]->image; ?>" align="middle" alt="<?php echo $adminLanguage->A_CONTACT; ?>" />
						</td>
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan="2">
					<br /><br />
					<input class="button" type="button" value="<?php echo $adminLanguage->A_CMP_USS_CHACONDET; ?>" onclick="javascript: gotocontact( '<?php echo $contact[0]->id; ?>' )" />
					<br /><em>
					'<?php echo $adminLanguage->A_MENU_COMPONENTS; ?> -&gt; <?php echo $adminLanguage->A_CONTACT; ?> -&gt; <?php echo $adminLanguage->A_MENU_MANAGE_CONTACTS; ?>'.
					</em>
					</td>
				</tr>
				<?php
			}
			?>
			</table>
			<?php
			$tabs->endTab();
			$tabs->endPane();
			?>
			</td>
		</tr>
		</table>
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="contact_id" value="" />
		<input type="hidden" name="<?php echo $tokname; ?>" value="<?php echo $mytoken; ?>" autocomplete="off" />
		<?php
		if (!$canEmailEvents) {
			?>
			<input type="hidden" name="sendemail" value="0" />
			<?php
		}
		?>
		</form>
		<?php
	}


	/**************************/
    /* HTML LIST EXTRA FIELDS */
    /**************************/
	static public function showExtra( &$rows, &$pageNav, $option ) {
		global $my, $adminLanguage;

        mosCommonHTML::loadOverlib();
?>
		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th class="user">
			<?php echo $adminLanguage->A_MENU_USER_MANAGE; ?> : <?php echo $adminLanguage->A_EXTRAFIELDS; ?>
			</th>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="2%" class="title"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20" class="title">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
			</th>
			<th class="title"><?php echo $adminLanguage->A_NAME; ?></th>
			<th class="title"><?php echo $adminLanguage->A_TYPE; ?></th>
			<th><?php echo $adminLanguage->A_PUBLISHED; ?></th>
			<th colspan="2"><?php echo $adminLanguage->A_REORDER; ?></th>
			<th><?php echo $adminLanguage->A_CMP_USS_REQUIRED; ?></th>
			<th><?php echo $adminLanguage->A_CMP_USS_PROFILE; ?></th>
			<th><?php echo $adminLanguage->A_CMP_USS_REGISTR; ?></th>
			<th><?php echo $adminLanguage->A_CMP_USS_RONLY; ?></th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];

			$row->id = $row->extraid;
			$link = 'index2.php?option=com_users&task=editExtraA&hidemainmenu=1&id='. $row->id;

			$task = $row->published ? 'unpublish' : 'publish';
			$img = $row->published ? 'publish_g.png' : 'publish_x.png';
			$alt = $row->published ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
            
            $checked = mosCommonHTML::CheckedOutProcessing( $row, $i );		
		?>
		<tr class="row<?php echo $k; ?>">
			<td><?php echo $pageNav->rowNumber( $i ); ?></td>
			<td><?php echo $checked; ?></td>
			<td><a href="<?php echo $link; ?>" title="<?php echo $adminLanguage->A_CMP_BANN_EDITBANNER; ?>">
            <?php echo $row->name; ?></a></td>
			<td><?php echo $row->etype; ?></td>
			<td align="center" style="text-align:center;">
                <a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i; ?>','<?php echo $task; ?>')" title="<?php echo $alt; ?>">
                <img src="images/<?php echo $img; ?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" /></a>
			</td>
			<td align="<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>"><?php echo $pageNav->orderUpIcon( $i ); ?></td>
			<td align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>"><?php echo $pageNav->orderDownIcon( $i, $n ); ?></td>
			<td align="center" style="text-align:center;"><?php 
                echo $row->required ? '<img src="images/tick.png" border="0" alt="'.$adminLanguage->A_YES.'" />' : 
                '<img src="images/publish_x.png" border="0" alt="'.$adminLanguage->A_NO.'" />'; 
            ?></td>
			<td align="center" style="text-align:center;"><?php 
                echo $row->profile ? '<img src="images/tick.png" border="0" alt="'.$adminLanguage->A_YES.'" />': 
                '<img src="images/publish_x.png" border="0" alt="'.$adminLanguage->A_NO.'" />';
            ?></td>
			<td align="center" style="text-align:center;"><?php 
                echo $row->registration ? '<img src="images/tick.png" border="0" alt="'.$adminLanguage->A_YES.'" />': 
                '<img src="images/publish_x.png" border="0" alt="'.$adminLanguage->A_NO.'" />';
            ?></td>
			<td align="center" style="text-align:center;"><?php 
                echo $row->readonly ? '<img src="images/tick.png" border="0" alt="'.$adminLanguage->A_YES.'" />': 
                '<img src="images/publish_x.png" border="0" alt="'.$adminLanguage->A_NO.'" />';
            ?></td>
		</tr>
		<?php
            $k = 1 - $k;
		}
		?>
		</table>
   		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="extra" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
		<?php
	}


	/*****************************/
	/* HTML ADD/EDIT EXTRA FIELD */
	/*****************************/
	static public function editExtra( $row, $lists, $option ) {
        global $adminLanguage;
        mosMakeHtmlSafe( $row, ENT_QUOTES );
        
        $align = (_GEM_RTL) ? 'right' : 'left';
?>
		<script type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;

			if (pressbutton == 'cancelExtra') {
				submitform( pressbutton );
				return;
			}

			//do field validation
			if (form.name.value == '') {
				alert( '<?php echo $adminLanguage->A_CMP_USS_MUSTFNAME; ?>' );
			} else if (form.etype.value == 'text' && form.maxlength.value == 0) {
				alert( '<?php echo $adminLanguage->A_CMP_USS_MAXLENINV; ?>' );
			} else if (form.etype.value == 'text' && form.maxlength.value == '') {
				alert( '<?php echo $adminLanguage->A_CMP_USS_MAXLENINV; ?>' );
			} else if (form.etype.value == 'hidden' && form.hidvalue.value == '') {
				alert( '<?php echo $adminLanguage->A_CMP_USS_HIDMUSTVAL; ?>' );
			} else if (form.etype.value == 'hidden' && form.elements['required'][1].checked == true) {
				alert( '<?php echo $adminLanguage->A_CMP_USS_HIDNOREQ; ?>' );
			} else if (form.etype.value == 'hidden' && form.elements['profile'][1].checked == true) {
				alert( '<?php echo $adminLanguage->A_CMP_USS_HIDNOPROF; ?>' );
			} else {
				submitform( pressbutton );
			}
		}

		function switchoptions() {
	        opt = document.adminForm.etype.selectedIndex;
	        typ = document.adminForm.etype.options[opt].text;	
	        if(document.getElementById) {
	            switch (typ) {
	                case 'text':
	                    document.getElementById('opttext').style.display = '';
	                    document.getElementById('optselect').style.display = 'none';
	                    document.getElementById('optradio').style.display = 'none';
	                    document.getElementById('optcheck').style.display = 'none';
	                    document.getElementById('opthidden').style.display = 'none';
	                break;
	                case 'select':
	                    document.getElementById('opttext').style.display = 'none';
	                    document.getElementById('optselect').style.display = '';
	                    document.getElementById('optradio').style.display = 'none';
	                    document.getElementById('optcheck').style.display = 'none';
	                    document.getElementById('opthidden').style.display = 'none';
	                break;
	                case 'radio':
	                    document.getElementById('opttext').style.display = 'none';
	                    document.getElementById('optselect').style.display = 'none';
	                    document.getElementById('optradio').style.display = '';
	                    document.getElementById('optcheck').style.display = 'none';
	                    document.getElementById('opthidden').style.display = 'none';
	                break;
	                case 'checkbox':
	                    document.getElementById('opttext').style.display = 'none';
	                    document.getElementById('optselect').style.display = 'none';
	                    document.getElementById('optradio').style.display = 'none';
	                    document.getElementById('optcheck').style.display = '';
	                    document.getElementById('opthidden').style.display = 'none';
	                break;
	                case 'hidden':
	                    document.getElementById('opttext').style.display = 'none';
	                    document.getElementById('optselect').style.display = 'none';
	                    document.getElementById('optradio').style.display = 'none';
	                    document.getElementById('optcheck').style.display = 'none';
	                    document.getElementById('opthidden').style.display = '';
	                break;
	                default:
	                break;
	            }
	        }
	    }
		</script>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="edit">
			<?php echo $adminLanguage->A_EXTRAFIELDS; ?>: <small><?php echo $row->extraid ? $adminLanguage->A_EDIT.' [ '.$row->name.' ]' : $adminLanguage->A_NEW; ?></small>
			</th>
		</tr>
		</table>

		<table width="100%">
		<tr>
			<td width="60%" valign="top">
				<table width="100%" class="adminform">
        		<tr>
        			<th colspan="2"><?php echo $adminLanguage->A_DETAILS; ?></th>
        		</tr>
        		<tr>
        			<td><?php echo $adminLanguage->A_NAME; ?></td>
        			<td><input class="inputbox" type="text" size="40" name="name" value="<?php echo $row->name; ?>"></td>
        		</tr>
        		<tr>
        			<td><?php echo $adminLanguage->A_TYPE; ?></td>
        			<td><?php echo $lists['etype']; ?></td>
        		</tr>
        		<tr>
        			<td><?php echo $adminLanguage->A_ORDERING; ?></td>
        			<td><?php echo $lists['ordering']; ?></td>
        		</tr>
        		<tr>
        			<td><?php echo $adminLanguage->A_PUBLISHED; ?>:</td>
        			<td><?php echo $lists['published']; ?></td>
        		</tr>
        		<tr>
        			<td><?php echo $adminLanguage->A_CMP_USS_REQUIRED; ?>:</td>
        			<td><?php echo $lists['required']; ?></td>
        		</tr>
        		<tr>
        			<td><?php echo $adminLanguage->A_CMP_USS_SHOWREG; ?>:</td>
        			<td><?php echo $lists['registration']; ?></td>
        		</tr>
        		<tr>
        			<td><?php echo $adminLanguage->A_CMP_USS_SHOWPROF; ?>:</td>
        			<td><?php echo $lists['profile']; ?></td>
        		</tr>
        		<tr>
        			<td><?php echo $adminLanguage->A_CMP_USS_RONLY; ?>:</td>
        			<td><?php echo $lists['readonly']; ?></td>
        		</tr>
        		<tr>
        			<td><?php echo $adminLanguage->A_CMP_USS_OPTALIGN; ?>:</td>
        			<td><?php echo $lists['halign']; ?></td>
        		</tr>
        		<tr>
        			<td colspan="2"><br /><br />
                    <fieldset style="background-color: #EEEEEE;">
                        <legend><strong><?php echo $adminLanguage->A_PREVIEW; ?></strong></legend>
                        <?php echo $row->extraid ? $lists['preview'] : ''; ?>
                        <br /><br />
                        <em><?php echo $adminLanguage->A_CMP_USS_PREVNOTE; ?></em>
                    </fieldset>
        			</td>
        		</tr>
        		</table>
			</td>
			<td width="40%" valign="top">
			<table width="100%" class="adminform">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_CMP_USS_OPTIONS; ?></th>
				<tr>
				<tr>
				    <td colspan="2">
                    <div id="opttext"<?php echo ($row->eftype == 'text') ? '' : ' style="display:none;"'; ?>>
                    <fieldset>
                        <legend><?php echo $adminLanguage->A_CMP_USS_OPTIONSFOR; ?> Text</legend>
                        <span style="width: 120px; float:<?php echo $align; ?>;"><?php echo $adminLanguage->A_CMP_USS_DEFVAL; ?>:</span> <input type="text" name="defvalue" dir="ltr" value="<?php echo $row->defvalue; ?>"><br>
                        <span style="width: 120px; float:<?php echo $align; ?>;"><?php echo $adminLanguage->A_CMP_USS_MAXLEN; ?>:</span> <input type="text" name="maxlength" dir="ltr" value="<?php echo $row->maxlength; ?>">
                    </fieldset>
                    </div>
                    <div id="opthidden"<?php echo ($row->eftype == 'hidden') ? '' : ' style="display:none"'; ?>>
                    <fieldset>
                        <legend><?php echo $adminLanguage->A_CMP_USS_OPTIONSFOR; ?> Hidden</legend>
                        <span style="width: 120px; float:<?php echo $align; ?>;"><?php echo $adminLanguage->A_CMP_USS_DEFVAL; ?>:</span> <input type="text" name="hidvalue" dir="ltr" value="<?php echo $row->defvalue; ?>"><br>
                    </fieldset>
                    </div>
                    <div id="optselect"<?php echo ($row->eftype == 'select') ? '' : ' style="display:none"'; ?>>
                    <fieldset>
                        <legend><?php echo $adminLanguage->A_CMP_USS_OPTIONSFOR; ?> Select</legend>
                        <?php echo $lists['soptions']; ?>
                    </fieldset>
                    </div>
                    <div id="optradio"<?php echo ($row->eftype == 'radio') ? '' : ' style="display:none"'; ?>>
                    <fieldset>
                        <legend><?php echo $adminLanguage->A_CMP_USS_OPTIONSFOR; ?> Radio</legend>
                        <?php echo $lists['roptions']; ?>
                    </fieldset>
                    </div>
                    <div id="optcheck"<?php echo ($row->eftype == 'checkbox') ? '' : ' style="display:none"'; ?>>
                    <fieldset>
                        <legend><?php echo $adminLanguage->A_CMP_USS_OPTIONSFOR; ?> Checkbox</legend>
                        <?php echo $lists['coptions']; ?>
                    </fieldset>
                    </div>                
                	</td>
                </tr>			
			</table>
			</td>
		</tr>
	   </table>
		<input type="hidden" name="extraid" value="<?php echo $row->extraid; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		</form>
    <?php 
	}
}

?>