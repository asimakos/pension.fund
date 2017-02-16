<?php 
/** 
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Registration
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_registration {

    /***************************/
    /* LOST PASSWORD HTML FORM */
    /***************************/
	public static function lostPassForm() {
        global $mainframe;
?>
        <script type="text/javascript">
        /* <![CDATA[ */
        function captchaPlayer() {
            window.open('<?php echo $mainframe->getCfg('live_site'); ?>/includes/captcha/listen.php','','width=200,height=100,top=250,left=450,toolbar=no,location=no,resizable=no,menubar=no');
        }

		function submitbutton() {
			var form = document.lostpassform;
			if (form.checkusername.value == '') {
				alert( "<?php echo html_entity_decode(_GEM_REGWARN_UNAME); ?>" );
				form.checkusername.focus();
			} else if (form.confirmEmail.value == '') {
				alert( "<?php echo html_entity_decode(_GEM_REGWARN_MAIL); ?>" );
				form.confirmEmail.focus();
            <?php if ($mainframe->getCfg('captcha')) { ?>
			} else if (form.code.value == '') {
				alert( "<?php echo html_entity_decode(_E_TYPE_SECCODE); ?>" );
				form.code.focus();
            <?php } ?>
			} else {
				form.submit();
			}
		}

        function lostautocoff() {
        	var form = document.lostpassform;
        	form.checkusername.setAttribute("autocomplete", "off");
        	form.checkusername.value = '';
        	form.confirmEmail.setAttribute("autocomplete", "off");
        	form.confirmEmail.value = '';
        }
		/* ]]> */
        </script>
        
        <div id="lostpassword">
        <h1><?php echo _LOST_PASSWORD; ?></h1>
        <p><?php echo _NEW_PASS_DESC; ?></p>

        <form action="<?php echo sefRelToAbs('index.php'); ?>" method="post" name="lostpassform">
        <div class="table">
            <div class="tablerow">
                <div class="tablecell"><?php echo _USERNAME; ?>:</div>
                <div class="tablecell">
                    <input type="text" name="checkusername" dir="ltr" title="<?php echo _USERNAME; ?>" value="" class="inputbox" maxlength="25" />
                </div>
            </div>
            <div class="tablerow">
                <div class="tablecell"><?php echo _EMAIL_PROMPT; ?></div>
                <div class="tablecell">
                    <input type="text" name="confirmEmail" dir="ltr" title="<?php echo _EMAIL_PROMPT; ?>" value="" class="inputbox" maxlength="80" />
                </div>
            </div>
            <?php if ($mainframe->getCfg('captcha')) { ?>
            <div class="tablerow">
                <div class="tablecell"><?php echo _E_SECCODE; ?>:</div>
                <div class="tablecell">
                    <img src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/includes/captcha/captcha.img.php" alt="<?php echo _E_SECCODE; ?>" border="0" /> 
                    <a href="javascript:captchaPlayer('<?php echo $_SESSION['captchasnd']; ?>');" title="spell">
                        <img src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/includes/captcha/speaker.gif" title="speaker" border="0" />
                    </a>
                </div>
            </div>
            <div class="tablerow">
                <div class="tablecell"><?php echo _E_TYPE_SECCODE; ?>:</div>
                <div class="tablecell">
                    <input type="text" name="code" dir="ltr" title="<?php echo _E_SECCODE; ?>" value="" class="inputbox" size="10" maxlength="10" />
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="clear"></div>
        <input type="hidden" name="option" value="com_registration" />
        <input type="hidden" name="task" value="sendNewPass" />
        <input type="button" value="<?php echo _BUTTON_SEND_PASS; ?>" title="<?php echo _BUTTON_SEND_PASS; ?>" class="button" onclick="submitbutton()" />
        </form>
        </div>
<?php
	}


    /**************************/
    /* HTML REGISTRATION FORM */
    /**************************/
	static public function registerForm(&$lists, $agreeid) {
	   global $mainframe, $Itemid;
	   
	   $formAction = sefRelToAbs('index.php', 'registration/registration-complete.html');
?>
        <script type="text/javascript">
        /* <![CDATA[ */
		function submitbutton() {
			var form = document.regform;
			var r = new RegExp("[^A-Za-z0-9]", "i");

			//do field validation
			if (form.name.value == "") {
				alert( "<?php echo html_entity_decode(_GEM_REGWARN_NAME); ?>" );
				form.name.focus();
			} else if (form.username.value == "") {
				alert( "<?php echo html_entity_decode(_GEM_REGWARN_UNAME); ?>" );
				form.username.focus();
			} else if (r.exec(form.username.value) || form.username.value.length < 4) {
				alert( "<?php printf( html_entity_decode(_GEM_VALID_AZ09), html_entity_decode(_USERNAME), 4 ); ?>" );
				form.username.focus();
			} else if (form.email.value == "" ) {
				alert( "<?php echo html_entity_decode(_GEM_REGWARN_MAIL); ?>" );
				form.email.focus();
			} else if (form.password.value.length < 6) {
				alert( "<?php echo html_entity_decode(_REGWARN_PASS); ?>" );
				form.password.focus();
			} else if (form.password2.value == "") {
				alert( "<?php echo html_entity_decode(_E_REGWARN_VPASS1); ?>" );
				form.password2.focus();
			} else if ((form.password.value != "") && (form.password.value != form.password2.value)){
				alert( "<?php echo html_entity_decode(_E_REGWARN_VPASS2); ?>" );
				form.password2.focus();
            <?php if ($mainframe->getCfg('captcha')) { ?>
			} else if (form.code.value == "") {
				alert( "<?php echo html_entity_decode(_E_TYPE_SECCODE); ?>" );
				form.code.focus();
            <?php } ?>
            <?php if ($agreeid) { ?>
            } else if (!form.regagree.checked) {
				alert( "<?php echo html_entity_decode(_E_MUSTC_RAGREE); ?>" );
            <?php } ?>
			} else if (r.exec(form.password.value)) {
				alert( "<?php printf( html_entity_decode(_GEM_VALID_AZ09), html_entity_decode(_PASSWORD), 6 ); ?>" );
				form.password.focus();
			<?php 
			if (count($lists['reqs'])>0) {
			     foreach ($lists['reqs'] as $req ) {
			         echo '} else if (form.'.$req.'.value == "") {'._LEND;
			         echo 'alert(\''._E_REQFIELDS_EMPTY.'\');'._LEND;
			         echo 'form.'.$req.'.focus();'._LEND;
			     }
			}
			?>
			} else {
				form.submit();
			}
		}

        function captchaPlayer() {
            window.open('<?php echo $mainframe->getCfg('live_site'); ?>/includes/captcha/listen.php','','width=200,height=100,top=250,left=450,toolbar=no,location=no,resizable=no,menubar=no');
        }
        function regautocoff() {
        	var form = document.regform;
        	form.name.setAttribute("autocomplete", "off");
        	form.name.value = '';
        	form.username.setAttribute("autocomplete", "off");
        	form.username.value = '';
        	form.email.setAttribute("autocomplete", "off");
        	form.email.value ='';
        	form.password.setAttribute("autocomplete", "off");
        	form.password.value ='';
        	form.password2.setAttribute("autocomplete", "off");
        	form.password2.value ='';
        }
        /* ]]> */
        </script>

        <div id="registrationform">
        <h1><?php echo _E_REGISTRATION; ?></h1>
        <p><?php echo _E_FIELDS_REQUIRED; ?></p>

        <form action="<?php echo $formAction; ?>" method="post" name="regform">
        <div class="table">
            <div class="tablerow">
                <div class="tablecell"><?php echo _CMN_NAME; ?>: *</div>
                <div class="tablecell">
                    <input type="text" name="name" title="<?php echo _CMN_NAME; ?>" value="" class="inputbox" maxlength="50" />
                </div>
            </div>
            <div class="tablerow">
                <div class="tablecell"><?php echo _USERNAME; ?>: *</div>
                <div class="tablecell">
                    <input type="text" name="username" dir="ltr" title="<?php echo _USERNAME; ?>" value="" class="inputbox" maxlength="25" />
                </div>
            </div>
            <div class="tablerow">
                <div class="tablecell"><?php echo _CMN_EMAIL; ?>: *</div>
                <div class="tablecell">
                    <input type="text" name="email" dir="ltr" title="<?php echo _CMN_EMAIL; ?>" value="" class="inputbox" maxlength="80" />
                </div>
            </div>
            <div class="tablerow">
                <div class="tablecell"><?php echo _PASSWORD; ?>: *</div>
                <div class="tablecell">
                    <input type="password" name="password" dir="ltr" title="<?php echo _PASSWORD; ?>" value="" class="inputbox" maxlength="25" />
                </div>
            </div>
            <div class="tablerow">
                <div class="tablecell"><?php echo _E_VERIFY_PASS; ?>: *</div>
                <div class="tablecell">
                    <input type="password" name="password2" dir="ltr" title="<?php echo _E_VERIFY_PASS; ?>" value="" class="inputbox" maxlength="25" />
                </div>
            </div>
<?php 
if ($lists['preflang'] != '') {
	    	echo '<div class="tablerow">'."\n";
            echo '<div class="tablecell">'._E_PREFLANG.": *</div>\n";
            echo '<div class="tablecell">'."\n";
            echo $lists['preflang']."\n";
            echo "</div>\n</div>\n";
} else {
			echo '<input type="hidden" name="preflang" value="'.$mainframe->getCfg('lang').'" />';
}

if (count($lists['extra']) > 0) {
    foreach ($lists['extra'] as $extra) {
        if ($extra['title'] == '') { //hidden field
            echo $extra['html'];
        } else {
?>
            <div class="tablerow">
                <div class="tablecell"><?php echo $extra['title']; ?>:</div>
                <div class="tablecell">
                    <?php echo $extra['html']; ?>
                </div>
            </div>
<?php 
        }
    }
}

if ($mainframe->getCfg('captcha')) {
?>
            <div class="tablerow">
                <div class="tablecell"><?php echo _E_SECCODE; ?>:</div>
                <div class="tablecell">
                    <img src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/includes/captcha/captcha.img.php" alt="<?php echo _E_SECCODE; ?>" title="<?php echo _E_SECCODE; ?>" border="0" /> 
                    <a href="javascript:captchaPlayer('<?php echo $_SESSION['captchasnd']; ?>');" title="spell">
                        <img src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/includes/captcha/speaker.gif" alt="spell" border="0" />
                    </a>
                </div>
            </div>
            <div class="tablerow">
                <div class="tablecell"><?php echo _E_TYPE_SECCODE; ?>: *</div>
                <div class="tablecell">
                    <input type="text" name="code" dir="ltr" title="<?php echo _E_SECCODE; ?>" value="" class="inputbox" size="10" maxlength="10" />
                </div>
            </div>
<?php 
}

if ($agreeid) {
    $status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';
    $link = $mainframe->getCfg('live_site').'/index2.php?option=com_content&task=view&id='.$agreeid.'&Itemid='.$Itemid.'&pop=1';

    echo '<div class="tablerow"><br />'._LEND;
    echo '<input type="checkbox" name="regagree" value="1" /> '._LEND;
	echo '<a href="javascript:void window.open(\''.$link.'\', \'RegistrationAgreement\', \''.$status.'\');" title="'._E_REGAGREE.'">'._LEND;
	echo _E_AGREE_REGTERM._LEND;
	echo '</a><br /><br />'._LEND;
	echo '</div>'._LEND;
}
?>
        </div>
        <div class="clear"></div>
        <input type="hidden" name="id" value="0" />
        <input type="hidden" name="gid" value="0" />
        <input type="hidden" name="option" value="com_registration" />
        <input type="hidden" name="task" value="saveRegistration" />
        <input type="button" value="<?php echo _E_SEND_REG; ?>" title="<?php echo _E_SEND_REG; ?>" class="button" onclick="submitbutton()" />
        </form>
        </div>
<?php 
    }
}

?>