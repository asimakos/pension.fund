<?php 
/**
* @version: $Id: user.html.php 2566 2009-11-05 06:52:12Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component User
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_user {


    /****************/
    /* WELCOME USER */
    /****************/
	static public function frontpage(&$access, $Itemid_ud=0, $Itemid_ul=0) {
	    global $my;
?>
        <h1><?php echo _E_WELCOME; ?></h1>
        <p><?php echo _E_WELCOME_DESC; ?></p>
        <br />

<?php 
		$mlink = 'index.php?option=com_user';
		if ($my->id && $access->canViewProfOwn) {
		    echo '<a href="'.sefRelToAbs($mlink.'&Itemid='.$Itemid_ul.'&task=profile&uid='.$my->id, 'members/'.$my->username.'.html').'" title="'._E_VIEW_PROFILE.'">'._E_VIEW_PROFILE.'</a> &nbsp; '._LEND;
		}
		if ($my->id && $access->canEditOwn) {
		  echo '<a href="'.sefRelToAbs($mlink.'&Itemid='.$Itemid_ud.'&task=UserDetails', 'members/edit-profile.html').'" title="'._E_EDIT_PROFILE.'">'._E_EDIT_PROFILE.'</a> &nbsp; '._LEND;
        }
        if ($access->canViewProf) {
		    echo '<a href="'.sefRelToAbs($mlink.'&Itemid='.$Itemid_ul.'&task=list', 'members/').'" title="'._E_MEMBERS_LIST.'">'._E_MEMBERS_LIST.'</a>'._LEND;
        }
        echo '<br />'._LEND;
	}


    /******************/
    /* HTML EDIT USER */
    /******************/
	static public function userEdit($row, $option, $submitvalue, &$lists, &$access, $enprof) {
        global $Itemid;
        
        $tabs = new mosTabs( 0 );
?>
        <script type="text/javascript">
        /* <![CDATA[ */
		function submitbutton() {
			var form = document.mosUserForm;
			var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");

			if (form.name.value == "") {
				alert( "<?php echo _GEM_REGWARN_NAME; ?>" );
			} else if (form.username.value == "") {
				alert( "<?php echo _GEM_REGWARN_UNAME; ?>" );
			} else if (r.exec(form.username.value) || form.username.value.length < 3) {
				alert( "<?php printf( _GEM_VALID_AZ09, _USERNAME, 4 ); ?>" );
			} else if (form.email.value == "") {
				alert( "<?php echo _GEM_REGWARN_MAIL; ?>" );
			} else if ((form.password.value != "") && (form.password.value != form.verifyPass.value)){
				alert( "<?php echo _E_REGWARN_VPASS2; ?>" );
			} else if (r.exec(form.password.value)) {
				alert( "<?php printf( _GEM_VALID_AZ09, _PASSWORD, 4 ); ?>" );
			<?php 
			if (count($lists['reqs'])>0) {
			     foreach ($lists['reqs'] as $req ) {
			         echo '} else if (form.'.$req.'.value == "") {'._LEND;
			         echo 'alert(\''._E_REQFIELDS_EMPTY.'\');'._LEND;
			     }
			}
			?>
			} else {
				form.submit();
			}
		}

        function focusBox(el) {
            var item = eval("document.mosUserForm."+el);
            item.style.backgroundColor = "#FDFFE4";
            item.style.color = "#333333";
        }

        function blurBox(el) {
            var item = eval("document.mosUserForm."+el);
            item.style.backgroundColor = "";
            item.style.color = "";
        }
        /* ]]> */
        </script>

        <div id="euserprofile">
        <h1><?php echo _E_EDIT_PROFILE; ?></h1>
        <form action="<?php echo sefRelToAbs('index.php'); ?>" method="post" name="mosUserForm" enctype="multipart/form-data">
            <?php 
            $tabs->startPane("userdata-pane");
			$tabs->startTab(_E_BASICINFO, "basicinfo-page");
			?>
            <table cellpadding="2" cellspacing="0" border="0" width="100%">
            <tr>
                <td><?php echo _EMAIL_YOUR_NAME; ?></td>
                <td><input class="inputbox" type="text" name="name" value="<?php echo $row->name; ?>" maxlength="50" onfocus="focusBox('name');" onblur="blurBox('name');" /></td>
            </tr>
            <tr>
                <td><?php echo _CMN_EMAIL; ?>:</td>
                <td><input class="inputbox" type="text" name="email" dir="ltr" value="<?php echo $row->email; ?>" maxlength="80" onfocus="focusBox('email');" onblur="blurBox('email');" /></td>
            </tr>
            <tr>
                <td><?php echo _USERNAME; ?>:</td>
                <td><?php echo $row->username; ?></td>
            </tr>
            <tr>
                <td><?php echo _PASSWORD; ?>:</td>
                <td><input class="inputbox" type="password" name="password" dir="ltr" value="" maxlength="40" onfocus="focusBox('password');" onblur="blurBox('password');" /></td>
            </tr>
            <tr>
                <td><?php echo _E_VERIFY_PASS; ?>:</td>
                <td><input class="inputbox" type="password" name="verifyPass" dir="ltr" maxlength="40" onfocus="focusBox('verifyPass');" onblur="blurBox('verifyPass');" /></td>
            </tr>
            <tr>
                <td><?php echo _E_PREFLANG; ?>:</td>
                <td><?php echo $lists['preflang']; ?></td>
            </tr>
            <tr>
                <td><?php echo _E_ACCOUNT_EXPDATE; ?>:</td>
                <td><?php echo ($row->expires == '2060-01-01 00:00:00') ? _ELANG_NEVER : mosFormatDate($row->expires); ?></td>
            </tr>
            <tr>
                <td valign="top"><?php echo _E_AVATAR; ?>:</td>
                <td valign="top"><?php echo $lists['avatar']; ?><br />
                	<script type="text/javascript">
                	/* <![CDATA[ */
					if (document.mosUserForm.avatar.options.value!=''){
					  jsimg='images/avatars/' + getSelectedValue( 'mosUserForm', 'avatar' );
					} else {
					  jsimg='images/avatars/noavatar.png';
					}
					document.write('<img src=' + jsimg + ' name="imagelib" width="100" height="100" border="1" title="<?php echo _E_AVATAR; ?> 100x100 pixel" />');
					/* ]]> */
					</script>
                </td>
            </tr>
            <?php if ($access->uploadAvatar) { ?>
            <tr>
                <td valign="top"><?php echo _E_UPLOADNEW; ?>:</td>
                <td><input type="file" name="upavatar" class="inputbox" onfocus="focusBox('upavatar');" onblur="blurBox('upavatar');" /></td>
            </tr>
            <?php } ?>
            </table>

            <?php 
			$tabs->endTab();
			$tabs->startTab(_E_ADDINFO, "addinfo-page");
			?>

            <table cellpadding="2" cellspacing="0" border="0" width="100%">
            <?php 
            if ($enprof['UPROF_WEBSITE']) {
            ?>
            <tr>
                <td width="150"><?php echo _E_WEBSITE; ?>:</td>
                <td><input type="text" name="website" class="inputbox" dir="ltr" size="40" maxlength="120" value="<?php echo $row->website; ?>" onfocus="focusBox('website');" onblur="blurBox('website');" /></td>
            </tr>
            <?php 
            }
            if ($enprof['UPROF_AIM']) {
            ?>
            <tr>
                <td width="150">AIM:</td>
                <td><input type="text" name="aim" class="inputbox" dir="ltr" maxlength="80" value="<?php echo $row->aim; ?>" onfocus="focusBox('aim');" onblur="blurBox('aim');" /></td>
            </tr>
            <?php 
            }
            if ($enprof['UPROF_YIM']) {
            ?>
            <tr>
                <td width="150">YIM:</td>
                <td><input type="text" name="yim" class="inputbox" dir="ltr" maxlength="80" value="<?php echo $row->yim; ?>" onfocus="focusBox('yim');" onblur="blurBox('yim');" /></td>
            </tr>
            <?php 
            }
            if ($enprof['UPROF_MSN']) {
            ?>
            <tr>
                <td width="150">MSN:</td>
                <td><input type="text" name="msn" class="inputbox" dir="ltr" maxlength="80" value="<?php echo $row->msn; ?>" onfocus="focusBox('msn');" onblur="blurBox('msn');" /></td>
            </tr>
            <?php 
            }
            if ($enprof['UPROF_ICQ']) {
            ?>
            <tr>
                <td width="150">ICQ:</td>
                <td><input type="text" name="icq" class="inputbox" dir="ltr" maxlength="60" value="<?php echo $row->icq; ?>" onfocus="focusBox('icq');" onblur="blurBox('icq');" /></td>
            </tr>
            <?php 
            }
            if ($enprof['UPROF_PHONE']) {
            ?>
            <tr>
                <td width="150"><?php echo _CONTACT_TELEPHONE; ?>:</td>
                <td><input type="text" name="phone" class="inputbox" dir="ltr" maxlength="30" value="<?php echo $row->phone; ?>" onfocus="focusBox('phone');" onblur="blurBox('phone');" /></td>
            </tr>
            <?php 
            }
            if ($enprof['UPROF_MOBILE']) {
            ?>
            <tr>
                <td width="150"><?php echo _CONTACT_MOBILE; ?></td>
                <td><input type="text" name="mobile" class="inputbox" dir="ltr" maxlength="30" value="<?php echo $row->mobile; ?>" onfocus="focusBox('mobile');" onblur="blurBox('mobile');" /></td>
            </tr>
            <?php 
            }
            if ($enprof['UPROF_BIRTHDATE']) {
                if (trim($row->birthdate) != '') {
                    $bparts = explode('-', $row->birthdate);
                    $byear = sprintf("%04d", intval($bparts[0]));
                    $bmonth = sprintf("%02d", intval($bparts[1]));
                    $bday = sprintf("%02d", intval($bparts[2]));
                } else {
                    $byear = (date('Y') - 25);
                    $bmonth = '01';
                    $bday = '01';
                }
            ?>
            <tr>
                <td width="150"><?php echo _E_BIRTHDATE; ?>:</td>
                <td>
                    <select name="bday" class="inputbox" dir="ltr" onfocus="focusBox('bday');" onblur="blurBox('bday');">
                    <?php 
                    for ($d = 1; $d < 32; $d++) {
                        $sel = ($d == $bday) ? ' selected' : '';
                        echo '<option value="'.sprintf("%02d", $d).'"'.$sel.'>'.sprintf("%02d", $d).'</option>'._LEND;
                    }
                    ?>
                    </select> 
                    <?php echo mosHTML::monthSelectList( 'bmonth', 'class="inputbox" onfocus="focusBox(\'bmonth\');" onblur="blurBox(\'bmonth\');"', $bmonth ); ?> 
                    <select name="byear" class="inputbox" dir="ltr" onfocus="focusBox('byear');" onblur="blurBox('byear');">
                    <?php 
                    for ($y = (date('Y') - 100); $y < (date('Y') - 9); $y++) {
                        $sel = ($y == $byear) ? ' selected' : '';
                        echo '<option value="'.$y.'"'.$sel.'>'.$y.'</option>'._LEND;
                    }
                    ?>
                    </select>
                </td>
            </tr>
            <?php 
            }
            if ($enprof['UPROF_GENDER']) {
            ?>
            <tr>
                <td width="150"><?php echo _E_GENDER; ?></td>
                <td><select name="gender" class="inputbox" onfocus="focusBox('gender');" onblur="blurBox('gender');">
                    <option value="MALE"<?php echo ($row->gender == 'MALE') ? ' selected="selected"' : ''; ?>><?php echo _E_MALE; ?></option>
                    <option value="FEMALE"<?php echo ($row->gender == 'FEMALE') ? ' selected="selected"' : ''; ?>><?php echo _E_FEMALE; ?></option>
                </select>
                </td>
            </tr>
            <?php 
            }
            if ($enprof['UPROF_LOCATION']) {
            ?>
            <tr>
                <td width="150"><?php echo _E_LOCATION; ?></td>
                <td><input type="text" name="location" class="inputbox" size="40" maxlength="120" value="<?php echo $row->location; ?>" onfocus="focusBox('location');" onblur="blurBox('location');" /></td>
            </tr>
            <?php 
            }
            if ($enprof['UPROF_OCCUPATION']) {
            ?>
            <tr>
                <td width="150"><?php echo _E_OCCUPATION; ?></td>
                <td><input type="text" name="occupation" class="inputbox" size="40" maxlength="120" value="<?php echo $row->occupation; ?>" onfocus="focusBox('occupation');" onblur="blurBox('occupation');" /></td>
            </tr>
            <?php 
            }
            if ($enprof['UPROF_SIGNATURE']) {
            ?>
            <tr>
                <td width="150"><?php echo _E_SIGNATURE; ?></td>
                <td><textarea name="signature" cols="30" rows="3" class="text_area" onfocus="focusBox('signature');" onblur="blurBox('signature');"><?php echo $row->signature; ?></textarea></td>
            </tr>
            <?php 
            }
            ?>
            <tr><td colspan="2"><?php echo $lists['extra']; ?></td></tr>
            <tr><td colspan="2"><i><?php echo _E_FIELDS_REQUIRED; ?></i></td></tr>
            </table>

			<?php 
			$tabs->endTab();
			$tabs->endPane();
			?>

            <div class="clear"></div>
            <p align="center">
                <input class="button" type="button" value="<?php echo $submitvalue; ?>" onclick="submitbutton()" />
            </p>
            <input type="hidden" name="username" value="<?php echo $row->username; ?>" />
            <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="task" value="saveUserEdit" />
            <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
        </form>
        </div>
<?php
    }


    /*******************/
    /* HTML LIST USERS */
    /*******************/
	static public function list_Users(&$rows, $total, $softlist, $access, $order, $page=0, $maxpage=0) {
	   global $Itemid, $mosConfig_sef, $mosConfig_absolute_path, $my, $mosConfig_offset;
?>

		<h1 class="componentheading"><?php echo _E_MEMBERS_LIST; ?></h1>

		<p><?php printf(_E_WEHAVEREG, $total); ?><br />
		<?php echo _E_CLTOGGLORD; ?></p>
		<div align="<?php echo (_GEM_RTL) ? 'left': 'right'; ?>" class="small"><?php echo _PN_PAGE.' <strong>'.($page+1).'</strong> '._PN_OF.' <strong>'.($maxpage + 1).'</strong>'; ?></div>

		<table width="100%" cellpadding="5" cellspacing="0" border="0" class="contentpaneopen">
		<tr>
			<?php 
			if ($softlist['ULIST_ONLINE']) {
				$slink = HTML_user::makesortLink('time', $order, $page);
				$hlink = sefRelToAbs('index.php?option=com_user&task=list&Itemid='.$Itemid.'&'.$slink, 'members/?'.$slink);
				$active = (($order == 'ona') || ($order == 'ond')) ? ' id="activecolumn"' : '';
				echo '<th align="center"'.$active.'><a href="'.$hlink.'" title="'._ORDER_DROPDOWN.'">'._E_STATUS.'</a></th>'._LEND;
			}
			if ($softlist['ULIST_USERNAME']) {
				$slink = HTML_user::makesortLink('username', $order, $page);
				$hlink = sefRelToAbs('index.php?option=com_user&task=list&Itemid='.$Itemid.'&'.$slink, 'members/?'.$slink);
				$active = (($order == 'ua') || ($order == 'ud')) ? ' id="activecolumn"' : '';
				echo '<th'.$active.'><a href="'.$hlink.'" title="'._ORDER_DROPDOWN.'">'._USERNAME.'</a></th>'._LEND;
			}
			if ($softlist['ULIST_NAME']) {
				$slink = HTML_user::makesortLink('name', $order, $page);
				$hlink = sefRelToAbs('index.php?option=com_user&task=list&Itemid='.$Itemid.'&'.$slink, 'members/?'.$slink);
				$active = (($order == 'na') || ($order == 'nd')) ? ' id="activecolumn"' : '';
				echo '<th'.$active.'><a href="'.$hlink.'" title="'._ORDER_DROPDOWN.'">'._CMN_NAME.'</a></th>'._LEND;
			}
			if ($softlist['ULIST_PREFLANG']) {
				$slink = HTML_user::makesortLink('preflang', $order, $page);
				$hlink = sefRelToAbs('index.php?option=com_user&task=list&Itemid='.$Itemid.'&'.$slink, 'members/?'.$slink);
				$active = (($order == 'pla') || ($order == 'pld')) ? ' id="activecolumn"' : '';
				echo '<th align="center"'.$active.'><a href="'.$hlink.'" title="'._ORDER_DROPDOWN.'">'._E_LANGUAGE.'</a></th>'._LEND;
			}
			if ($softlist['ULIST_GENDER']) {
				$slink = HTML_user::makesortLink('gender', $order, $page);
				$hlink = sefRelToAbs('index.php?option=com_user&task=list&Itemid='.$Itemid.'&'.$slink, 'members/?'.$slink);
				$active = (($order == 'ga') || ($order == 'gd')) ? ' id="activecolumn"' : '';
				echo '<th align="center"'.$active.'><a href="'.$hlink.'" title="'._ORDER_DROPDOWN.'">'._E_GENDER.'</a></th>'._LEND;
			}
			if ($softlist['ULIST_USERGROUP']) {
				$slink = HTML_user::makesortLink('usertype', $order, $page);
				$hlink = sefRelToAbs('index.php?option=com_user&task=list&Itemid='.$Itemid.'&'.$slink, 'members/?'.$slink);
				$active = (($order == 'uta') || ($order == 'utd')) ? ' id="activecolumn"' : '';
				echo '<th'.$active.'><a href="'.$hlink.'" title="'._ORDER_DROPDOWN.'">'._E_USERGROUP.'</a></th>'._LEND;
			}
			if ($softlist['ULIST_LOCATION']) {
				$slink = HTML_user::makesortLink('location', $order, $page);
				$hlink = sefRelToAbs('index.php?option=com_user&task=list&Itemid='.$Itemid.'&'.$slink, 'members/?'.$slink);
				$active = (($order == 'la') || ($order == 'ld')) ? ' id="activecolumn"' : '';
				echo '<th'.$active.'><a href="'.$hlink.'" title="'._ORDER_DROPDOWN.'">'._E_LOCATION.'</a></th>'._LEND;
			}
			if ($softlist['ULIST_OCCUPATION']) {
				$slink = HTML_user::makesortLink('occupation', $order, $page);
				$hlink = sefRelToAbs('index.php?option=com_user&task=list&Itemid='.$Itemid.'&'.$slink, 'members/?'.$slink);
				$active = (($order == 'oa') || ($order == 'od')) ? ' id="activecolumn"' : '';
				echo '<th'.$active.'><a href="'.$hlink.'" title="'._ORDER_DROPDOWN.'">'._E_OCCUPATION.'</a></th>'._LEND;
			}
			if ($softlist['ULIST_WEBSITE']) {
				$slink = HTML_user::makesortLink('website', $order, $page);
				$hlink = sefRelToAbs('index.php?option=com_user&task=list&Itemid='.$Itemid.'&'.$slink, 'members/?'.$slink);
				$active = (($order == 'wa') || ($order == 'wd')) ? ' id="activecolumn"' : '';
				echo '<th align="center"'.$active.'><a href="'.$hlink.'" title="'._ORDER_DROPDOWN.'">'._E_WEBSITE.'</a></th>'._LEND;
			}
			if ($softlist['ULIST_EMAIL']) {
				$slink = HTML_user::makesortLink('email', $order, $page);
				$hlink = sefRelToAbs('index.php?option=com_user&task=list&Itemid='.$Itemid.'&'.$slink, 'members/?'.$slink);
				$active = (($order == 'ea') || ($order == 'ed')) ? ' id="activecolumn"' : '';
				echo '<th align="center"'.$active.'><a href="'.$hlink.'" title="'._ORDER_DROPDOWN.'">'._CMN_EMAIL.'</a></th>'._LEND;
			}
			if ($softlist['ULIST_PHONE']) {
				$slink = HTML_user::makesortLink('phone', $order, $page);
				$hlink = sefRelToAbs('index.php?option=com_user&task=list&Itemid='.$Itemid.'&'.$slink, 'members/?'.$slink);
				$active = (($order == 'pha') || ($order == 'phd')) ? ' id="activecolumn"' : '';
				echo '<th'.$active.'><a href="'.$hlink.'" title="'._ORDER_DROPDOWN.'">'._CONTACT_TELEPHONE.'</a></th>'._LEND;
			}
			if ($softlist['ULIST_MOBILE']) {
				$slink = HTML_user::makesortLink('mobile', $order, $page);
				$hlink = sefRelToAbs('index.php?option=com_user&task=list&Itemid='.$Itemid.'&'.$slink, 'members/?'.$slink);
				$active = (($order == 'moa') || ($order == 'mod')) ? ' id="activecolumn"' : '';
				echo '<th'.$active.'><a href="'.$hlink.'" title="'._ORDER_DROPDOWN.'">'._CONTACT_MOBILE.'</a></th>'._LEND;
			}
			if ($softlist['ULIST_REGDATE']) {
				$slink = HTML_user::makesortLink('registerdate', $order, $page);
				$hlink = sefRelToAbs('index.php?option=com_user&task=list&Itemid='.$Itemid.'&'.$slink, 'members/?'.$slink);
				$active = (($order == 'ra') || ($order == 'rd')) ? ' id="activecolumn"' : '';
				echo '<th'.$active.'><a href="'.$hlink.'" title="'._ORDER_DROPDOWN.'">'._E_REGDATE.'</a></th>'._LEND;
			}
			if ($softlist['ULIST_BIRTHDATE']) {
				$slink = HTML_user::makesortLink('birthdate', $order, $page);
				$hlink = sefRelToAbs('index.php?option=com_user&task=list&Itemid='.$Itemid.'&'.$slink, 'members/?'.$slink);
				$active = (($order == 'ba') || ($order == 'bd')) ? ' id="activecolumn"' : '';
				echo '<th align="center"'.$active.'><a href="'.$hlink.'" title="'._ORDER_DROPDOWN.'">'._E_AGE.'</a></th>'._LEND;
			}
			if ($softlist['ULIST_MSN']) {
				$slink = HTML_user::makesortLink('msn', $order, $page);
				$hlink = sefRelToAbs('index.php?option=com_user&task=list&Itemid='.$Itemid.'&'.$slink, 'members/?'.$slink);
				$active = (($order == 'ma') || ($order == 'md')) ? ' id="activecolumn"' : '';
				echo '<th align="center"'.$active.'><a href="'.$hlink.'" title="'._ORDER_DROPDOWN.'">MSN</a></th>'._LEND;
			}
			if ($softlist['ULIST_AIM']) {
				$slink = HTML_user::makesortLink('aim', $order, $page);
				$hlink = sefRelToAbs('index.php?option=com_user&task=list&Itemid='.$Itemid.'&'.$slink, 'members/?'.$slink);
				$active = (($order == 'aa') || ($order == 'ad')) ? ' id="activecolumn"' : '';
				echo '<th align="center"'.$active.'><a href="'.$hlink.'" title="'._ORDER_DROPDOWN.'">AIM</a></th>'._LEND;
			}
			if ($softlist['ULIST_YIM']) {
				$slink = HTML_user::makesortLink('yim', $order, $page);
				$hlink = sefRelToAbs('index.php?option=com_user&task=list&Itemid='.$Itemid.'&'.$slink, 'members/?'.$slink);
				$active = (($order == 'ya') || ($order == 'yd')) ? ' id="activecolumn"' : '';
				echo '<th align="center"'.$active.'><a href="'.$hlink.'" title="'._ORDER_DROPDOWN.'">YIM</a></th>'._LEND;
			}
			if ($softlist['ULIST_ICQ']) {
				$slink = HTML_user::makesortLink('icq', $order, $page);
				$hlink = sefRelToAbs('index.php?option=com_user&task=list&Itemid='.$Itemid.'&'.$slink, 'members/?'.$slink);
				$active = (($order == 'ia') || ($order == 'id')) ? ' id="activecolumn"' : '';
				echo '<th align="center"'.$active.'><a href="'.$hlink.'" title="'._ORDER_DROPDOWN.'">ICQ</a></th>'._LEND;
			}
			?>
		</tr>
		<?php 
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row =& $rows[$i];
			$link = 'index.php?option=com_user&amp;task=profile&amp;Itemid='.$Itemid.'&amp;uid='. $row->id;
            if (trim($row->avatar) == '') { $row->avatar = 'noavatar.png'; }
            $now = time() + ($mosConfig_offset * 3600);
			?>
			<tr class="sectiontableentry<?php echo ($k+1); ?>">
				<?php 
				if ($softlist['ULIST_ONLINE']) {					
					echo '<td align="center">';
					echo ($row->ip != '') ? '<img src="images/M_images/rating_star.png" title="online" alt="online" />' : '<img src="images/M_images/rating_star_blank.png" title="offline" alt="offline" />';
					echo '</td>'._LEND;
				}
				if ($softlist['ULIST_USERNAME']) {
					$t = '<img src=\\\'images/avatars/'.$row->avatar.'\\\' />';
					$t .= (($row->ip != '') && ($my->gid == 25)) ? '<br />IP: '.$row->ip : '';
					if (($row->time != '') && ($my->gid == 25)) {
						$s = ($now - intval($row->time));
						$m = floor($s/60);
						$t .= '<br />'._E_TIME.': '.sprintf('%02d',$m).':'.sprintf('%02d',intval($s - ($m * 60)));
					}
					$href = ($access->canViewProf) ? sefRelToAbs($link, 'members/'.$row->username.'.html') : 'javascript:void(0);';
				?>
					<td><a href="<?php echo $href; ?>" title="<?php echo _E_VIEW_PROFILE; ?>" onmouseover="this.T_TITLE='<?php echo $row->username; ?>';this.T_WIDTH=104;this.T_TEXTALIGN='center';return escape('<?php echo $t; ?>')">
					<?php echo $row->username; ?></a>
					</td>
				<?php 
				}
				if ($softlist['ULIST_NAME']) {
					echo '<td>'.$row->name.'</td>'._LEND;
				}
				if ($softlist['ULIST_PREFLANG']) {
					echo '<td align="center">';
					if (($row->preflang != '') && (file_exists($mosConfig_absolute_path.'/language/'.$row->preflang.'/'.$row->preflang.'.gif'))) {
						echo '<img src="language/'.$row->preflang.'/'.$row->preflang.'.gif" alt="'.$row->preflang.'" title="'.$row->preflang.'" border="0" />';
					}
					echo '</td>'._LEND;
				}
				if ($softlist['ULIST_GENDER']) {
                    $genderimg = ($row->gender == 'FEMALE') ? '<img src="images/M_images/female.png" border="0" alt="'._E_FEMALE.'" title="'._E_FEMALE.'" />' : '<img src="images/M_images/male.png" border="0" alt="'._E_MALE.'" title="'._E_MALE.'" />';
					echo '<td align="center">'.$genderimg.'</td>'._LEND;
				}
				if ($softlist['ULIST_USERGROUP']) {
					echo '<td>'.$row->usertype.'</td>'._LEND;
				}
				if ($softlist['ULIST_LOCATION']) {
					echo '<td>'.$row->location.'</td>'._LEND;
				}
				if ($softlist['ULIST_OCCUPATION']) {
					echo '<td>'.$row->occupation.'</td>'._LEND;
				}
				if ($softlist['ULIST_WEBSITE']) {
					echo '<td align="center">';
                    if (preg_match('/^(http\:\/\/)/', $row->website)) {
                        echo '<a href="'.$row->website.'" title="'.$row->website.'" target="_blank"><img src="includes/js/ThemeOffice/globe1.png" border="0" alt="'._E_WEBSITE.'" /></a>';
                    }
                    echo '</td>'._LEND;
				}
				if ($softlist['ULIST_EMAIL']) {
					echo '<td align="center"><a href="mailto:'.$row->email.'" title="'.$row->email.'"><img src="images/M_images/emailButton.png" border="0" alt="'._CMN_EMAIL.'" /></a></td>'._LEND;
				}
				if ($softlist['ULIST_PHONE']) {
					echo '<td>'.$row->phone.'</td>'._LEND;
				}
				if ($softlist['ULIST_MOBILE']) {
					echo '<td>'.$row->mobile.'</td>'._LEND;
				}
				if ($softlist['ULIST_REGDATE']) {
					echo '<td>'.mosFormatDate( $row->registerdate, '%a, %d %b %Y').'</td>'._LEND;
				}
                if ($softlist['ULIST_BIRTHDATE']) {
					echo '<td align="center">';
					if (trim($row->birthdate) != '') {
						$bparts = @preg_split('-', $row->birthdate);
                    	$byear = intval($bparts[0]);
                    	echo ($byear > 1900) ? (date('Y') - $byear) : '';
                    }
                    echo '</td>'._LEND;
                }
				if ($softlist['ULIST_MSN']) {
					echo '<td align="center">';
					if ($row->msn != '') {
						echo '<a href="http://members.msn.com/'.$row->msn.'" title="MSN '._E_USER_PROFILE.'" target="_blank"><img src="images/M_images/msn.png" border="0" alt="MSN" /></a>';
					}
					echo '</td>'._LEND;
				}
				if ($softlist['ULIST_AIM']) {
					echo '<td align="center">';
					if ($row->aim != '') {
						echo '<a href="aim:goim?screenname='.$row->aim.'&message=Hi" title="'.$row->aim.'"><img src="images/M_images/aim.png" border="0" alt="AIM" /></a>';
					}
					echo '</td>'._LEND;
				}
				if ($softlist['ULIST_YIM']) {
					echo '<td align="center">';
					if ($row->yim != '') {
						echo '<a href="http://edit.yahoo.com/config/send_webmesg?.target='.$row->yim.'" title="'.$row->yim.'" target="_blank"><img src="images/M_images/yim.png" border="0" alt="YIM" /></a>';
					}
					echo '</td>'._LEND;
				}
				if ($softlist['ULIST_ICQ']) {
					echo '<td align="center">';
					if ($row->icq != '') {
						echo '<a href="http://www.icq.com/whitepages/about_me.php?uin='.$row->icq.'" title="ICQ '._E_USER_PROFILE.'" target="_blank"><img src="images/M_images/icq.png" border="0" alt="ICQ" /></a>';
					}
					echo '</td>'._LEND;
				}
				?>
			</tr>
			<?php 
			$k = 1 - $k;
		}
		?>
		</table>

		<script type="text/javascript" src="administrator/includes/js/wz_tooltip<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.js"></script>

		<?php 
		if ($maxpage > 0) {
			$linkbase = 'index.php?option=com_user&task=list&Itemid='.$Itemid;
			$seobase = 'members/';
			$mark = '?';
			if ($order != 'ua') {
				$linkbase .= '&order='.$order;
				$seobase .= '?order='.$order;
				$mark = '&';
			}

			$textdir = (_GEM_RTL) ? ' dir="rtl"' : '';
			echo '<div class="sectiontablefooter">'._LEND;
			if ($page >0) {
				if (($page - 1) > 0) {
					$prseo = $seobase.$mark.'page='.($page - 1);
				} else {
					$prseo = $seobase;	
				}
				echo '<a title="'._PN_START.'" class="pagenav" href="'.sefRelToAbs($linkbase, $seobase).'"'.$textdir.'>&lt;&lt; '._PN_START.'</a> '._LEND;
				echo '<a title="'._CMN_PREV.'" class="pagenav" href="'.sefRelToAbs($linkbase.'&page='.($page - 1), $prseo).'"'.$textdir.'>&lt; '._CMN_PREV.'</a> '._LEND;
			} else {
				echo '<span'.$textdir.' class="pagenav">&lt;&lt; '._PN_START.'</span> '._LEND;
				echo '<span'.$textdir.' class="pagenav">&lt; '._CMN_PREV.'</span> '._LEND;
			}
			echo '&nbsp;&nbsp;<span'.$textdir.' class="pagenav"><strong>'.($page + 1).'</strong></span>&nbsp;&nbsp; '._LEND;
            if ($page < $maxpage) {
                echo '<a href="'.sefRelToAbs($linkbase.'&page='.($page + 1), $seobase.$mark.'page='.($page + 1)).'"'.$textdir.' class="pagenav" title="'._CMN_NEXT.'">'._CMN_NEXT.' &gt;</a> '._LEND;
                echo '<a href="'.sefRelToAbs($linkbase.'&page='.$maxpage, $seobase.$mark.'page='.$maxpage).'"'.$textdir.' class="pagenav" title="'._PN_END.'">'._PN_END.' &gt;&gt;</a>'._LEND;
            } else {
                echo '<span'.$textdir.' class="pagenav">'._CMN_NEXT.' &gt;</span> '._LEND;
                echo '<span'.$textdir.' class="pagenav">'._PN_END.' &gt;&gt;</span>'._LEND;
            }
			echo '</div>'._LEND;
		}
    }


	/********************/
	/* CREATE SORT LINK */
	/********************/
	static private function makesortLink($col, $corder='ua', $page=0) {
		switch ($col) {
			case 'name': $norder = ($corder == 'na') ? 'nd': 'na'; break;
			case 'email': $norder = ($corder == 'ea') ? 'ed': 'ea'; break;
			case 'usertype': $norder = ($corder == 'uta') ? 'utd': 'uta'; break;
			case 'registerdate': $norder = ($corder == 'ra') ? 'rd': 'ra'; break;
			case 'preflang': $norder = ($corder == 'pla') ? 'pld': 'pla'; break;
			//case 'avatar': $norder = ($corder == 'ava') ? 'avd': 'ava'; break;
			case 'website': $norder = ($corder == 'wa') ? 'wd': 'wa'; break;
			case 'aim': $norder = ($corder == 'aa') ? 'ad': 'aa'; break;
			case 'yim': $norder = ($corder == 'ya') ? 'yd': 'ya'; break;
			case 'msn': $norder = ($corder == 'ma') ? 'md': 'ma'; break;
			case 'icq': $norder = ($corder == 'ia') ? 'id': 'ia'; break;
			case 'phone': $norder = ($corder == 'pha') ? 'phd': 'pha'; break;
			case 'mobile': $norder = ($corder == 'moa') ? 'mod': 'moa'; break;
			case 'birthdate': $norder = ($corder == 'ba') ? 'bd': 'ba'; break;
			case 'gender': $norder = ($corder == 'ga') ? 'gd': 'ga'; break;
			case 'location': $norder = ($corder == 'la') ? 'ld': 'la'; break;
			case 'occupation': $norder = ($corder == 'oa') ? 'od': 'oa'; break;
			case 'time': $norder = ($corder == 'ona') ? 'ond': 'ona'; break;
			case 'username': default: $norder = ($corder == 'ua') ? 'ud': 'ua'; break;
		}
		return ($page >0) ? 'page='.$page.'&order='.$norder : 'order='.$norder;
	}


    /*********************/
    /* HTML VIEW PROFILE */
    /*********************/
    static public function viewProfile( &$row, $option, &$lists, $enprof, $blog ) {
    	global $my, $access, $Itemid;
    	
    	$tabs = new mosTabs( 0 );
?>
        <div id="vuserprofile">
        <h1><?php echo _E_USER_PROFILE.': '.$row->username; ?></h1>

        <?php 
        $tabs->startPane("userdata-pane");
		$tabs->startTab(_E_BASICINFO, "basicinfo-page");
		?>
		<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
            <tr>
                <td valign="top">
                    <table width="100%" cellpadding="2" cellspacing="0" border="0" align="center" class="contentpane">
                    <tr>
                        <td><strong><?php echo _CMN_NAME; ?>:</strong></td>
                        <td><?php echo $row->name; ?></td>
                    </tr>
                    <?php 
                    if ($enprof['UPROF_USERGROUP']) {
                    ?>
                    <tr>
                        <td><strong><?php echo _E_USERGROUP; ?>:</strong></td>
                        <td><?php echo $row->usertype; ?></td>
                    </tr>
                    <?php 
                    }
                    ?>
                    <tr>
                        <td><strong><?php echo _E_REGDATE; ?>:</strong></td>
                        <td><?php echo mosFormatDate($row->registerdate); ?></td>
                    </tr>
                    <tr>
                        <td><strong><?php echo _E_PREFLANG; ?>:</strong></td>
                        <td><?php echo $row->preflang; ?></td>
                    </tr>
                    <?php 
                    if ($enprof['UPROF_WEBSITE'] && ($row->website != '')) {
                    ?>
                    <tr>
                        <td><strong><?php echo _E_WEBSITE; ?>:</strong></td>
                        <td><?php 
                        if (preg_match('/^(http\:\/\/)/', $row->website)) {
                            echo '<a href="'.$row->website.'" target="_blank">'.$row->website.'</a>';
                        }
                        ?></td>
                    </tr>
                    <?php 
                    }
                    if ($blog) {
                    ?>
                    <tr>
                        <td><strong>Blog:</strong></td>
                        <td><?php echo '<a href="'.$blog->link.'" title="'.$blog->title.'">'.$blog->title.'</a>';
                        ?></td>
                    </tr>
                    <?php 
                    }
                    if ($enprof['UPROF_OCCUPATION'] && (trim($row->occupation) != '')) {
                    ?>
                    <tr>
                        <td><strong><?php echo _E_OCCUPATION; ?>:</strong></td>
                        <td><?php echo $row->occupation; ?></td>
                    </tr>
                    <?php 
                    }
                    if ($enprof['UPROF_ARTICLES']) {
                    ?>
                    <tr>
                        <td><strong><?php echo _E_NUM_ARTICLES; ?>:</strong></td>
                        <td><?php echo $lists['numarticles']; ?></td>
                    </tr>
                    <?php 
                    }
                    if ($my->gid == 25) {
?>
                    <tr>
                        <td><strong><?php echo _E_ACCOUNT_EXPDATE; ?>:</strong></td>
                        <td><?php echo ($row->expires == '2060-01-01 00:00:00') ? _ELANG_NEVER : mosFormatDate($row->expires); ?></td>
                    </tr>
<?php 
                    }
                    if ($enprof['UPROF_SIGNATURE'] && (trim($row->signature) != '')) {
                    ?>
                    <tr>
                        <td colspan="2"><div class="profile_signature"><?php echo $row->signature; ?></div></td>
                    </tr>
                    <?php 
                    }
                    ?>
                    </table>                
                </td>
                <td width="120" valign="top" align="center">
                    <div id="useravatar"><?php 
                        $genderimg = '';
                        if ($enprof['UPROF_GENDER']) {
                            $genderimg = ($row->gender == 'FEMALE') ? '<img src="images/M_images/female.png" border="0" align="absmiddle" alt="'._E_FEMALE.'" title="'._E_FEMALE.'" />' : '<img src="images/M_images/male.png" border="0" align="absmiddle" alt="'._E_MALE.'" title="'._E_MALE.'" />';
                        }
                        if (trim($row->avatar) == '') { $row->avatar = 'noavatar.png'; }
                        echo '<img src="images/avatars/'.$row->avatar.'" alt="'._E_AVATAR.' '.$row->username.'" title="'._E_AVATAR.' '.$row->username.'" />'; 
                        ?><div id="useravatarname"><?php echo $row->username; ?> <?php echo $genderimg; ?></div>
                        <?php 
                        if ($enprof['UPROF_BIRTHDATE'] && (trim($row->birthdate) != '')) {
                            $bparts = @preg_split('-', $row->birthdate);
                            $byear = intval($bparts[0]);
                            if ($byear > 1900) {
                                $userage = date('Y') - $byear;
                                echo _E_AGE.': '.$userage;
                            }
                        }
                        ?>
                    </div>
                </td>
            </tr>
		</table>
<?php 
        $tabs->endTab();

        $showtab = $enprof['UPROF_EMAIL'] + $enprof['UPROF_AIM'] + $enprof['UPROF_YIM'] + $enprof['UPROF_MSN'] +
        $enprof['UPROF_ICQ'] + $enprof['UPROF_PHONE'] + $enprof['UPROF_MOBILE'] + $enprof['UPROF_LOCATION'];

        if ($showtab > 0) {
        $tabs->startTab(_CONTACT_TITLE, "contactinfo-page");
?>
        <table width="100%" cellpadding="2" cellspacing="0" border="0" align="center" class="contentpane">
            <?php 
            if ($enprof['UPROF_EMAIL']) {
            ?>
            <tr>
                <td><strong><?php echo _CMN_EMAIL; ?>:</strong></td>
                <td><a href="mailto:<?php echo $row->email; ?>"><?php echo $row->email; ?></a></td>
            </tr>
            <?php 
            }
            if ($enprof['UPROF_AIM'] && ($row->aim != '')) {
            ?>
            <tr>
                <td><strong>AIM:</strong></td>
                <td><a href="aim:goim?screenname=<?php echo $row->aim; ?>&message=Hi"><?php echo $row->aim; ?></a></td>
            </tr>
            <?php 
            }
            if ($enprof['UPROF_YIM'] && ($row->yim != '')) {
            ?>
            <tr>
                <td><strong>YIM:</strong></td>
                <td><a href="http://edit.yahoo.com/config/send_webmesg?.target=<?php echo $row->yim; ?>" target="_blank"><?php echo $row->yim; ?></a></td>
            </tr>
            <?php 
            }
            if ($enprof['UPROF_MSN'] && ($row->msn != '')) {
            ?>
            <tr>
                <td><strong>MSN:</strong></td>
                <td><a href="http://members.msn.com/<?php echo $row->msn; ?>" target="_blank"><?php echo $row->msn; ?></a></td>
            </tr>
            <?php 
            }
            if ($enprof['UPROF_ICQ'] && ($row->icq != '')) {
            ?>
            <tr>
                <td><strong>ICQ:</strong></td>
                <td><a href="http://www.icq.com/whitepages/about_me.php?uin=<?php echo $row->icq; ?>" target="_blank"><?php echo $row->icq; ?></a></td>
            </tr>
            <?php 
            }
            if ($enprof['UPROF_PHONE'] && ($row->phone != '')) {
            ?>
            <tr>
                <td><strong><?php echo _CONTACT_TELEPHONE; ?>:</strong></td>
                <td><?php echo $row->phone; ?></td>
            </tr>
            <?php 
            }
            if ($enprof['UPROF_MOBILE'] && ($row->mobile != '')) {
            ?>
            <tr>
                <td><strong><?php echo _CONTACT_MOBILE; ?></strong></td>
                <td><?php echo $row->mobile; ?></td>
            </tr>
            <?php 
            }
            if ($enprof['UPROF_LOCATION'] && ($row->location != '')) {
            ?>
            <tr>
                <td><strong><?php echo _E_LOCATION; ?>:</strong></td>
                <td><?php echo $row->location; ?></td>
            </tr>
            <?php 
            }
            ?>
        </table>

<?php 
        $tabs->endTab();
		}

        if ($lists['extra'] != '') {
            $tabs->startTab(_E_ADDINFO, "addinfo-page");
?>
            <table width="100%" cellpadding="2" cellspacing="0" border="0" align="center" class="contentpane">
                <?php echo $lists['extra']; ?>
            </table>
        <?php 
            $tabs->endTab();
        }
        $tabs->endPane();
        ?>
        <div class="clear"></div>

        <p align="center">
        <?php 
		if ($access->canViewProf) {
		?>
			<a href="<?php echo sefRelToAbs('index.php?option=com_user&task=list&Itemid='.$Itemid, 'members/'); ?>" target="_self" title="<?php echo _E_MEMBERS_LIST; ?>"><?php echo _E_MEMBERS_LIST; ?></a>
		<?php 
		}
		if ($my->id == $row->id) {
            echo ' &nbsp; <a href="'.sefRelToAbs('index.php?option=com_user&task=UserDetails&Itemid='.$Itemid, 'members/edit-profile.html').'" target="_self" title="'._E_EDIT_PROFILE.'">'._E_EDIT_PROFILE.'</a>'._LEND;
		}
		?>
		</p>

<?php 
        if ($enprof['UPROF_RANDUSERS']) {
            echo '<h2>'._E_RANDOMUSERS.'</h2>'._LEND;
            elxLoadModule('mod_random_profile', -1);
        }
        echo '</div>'._LEND;
    }

}
?>