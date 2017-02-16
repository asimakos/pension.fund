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


class newsletterFH {


	/**************/
	/* HTML FORMS */
	/**************/
	static public function htmlForms($cansub=0, $stats=array()) {
		global $newsletter;

		self::htmlStart();
		echo '<h2 class="iosnl_h2">'.$newsletter->lng->NEWSLMAILLIST."</h2>\n";
		echo '<noscript class="iosnl_noscript">'.$newsletter->lng->JSDISABLED.'</noscript>'._LEND;

		if ($cansub) {
			self::subscriptionForm();
		} else {
			$msg = $newsletter->cfg->get('CAN_SUBSCRIBE') ? $newsletter->lng->SUBLOGIN : $newsletter->lng->SUBNALLOWED;
			echo "<p class=\"iosnl_status\">".$msg."</p>\n";
		}

		self::unsubscribeForm();
		self::showStats($stats);
		self::copyright();
		self::htmlEnd();
	}


	/********************/
	/* HTML SHOW STATUS */
	/********************/
	static public function showStatus() {
		global $newsletter, $mainframe, $Itemid;

		$s  = intval(mosGetParam($_GET, 's', 0));
		switch($s) {
			case 1:
				$pagetitle = $newsletter->lng->SUBCONFIRM;
				$msg = $newsletter->lng->THANKSUB."<br />\n".$newsletter->lng->CONFLINKSENT;
			break;
			case 2:
				$pagetitle = $newsletter->lng->SUBCOMPLETE;
				$msg = $newsletter->lng->SUBCOMPLETED;
			break;
			case 3:
				$pagetitle = $newsletter->lng->CONFFAILED;
				$msg = $newsletter->lng->CONFFAILEDD;
			break;
			case 4:
				$pagetitle = $newsletter->lng->UNSUBCONFIRM;
				$msg = $newsletter->lng->RCONFLINKSENT;
			break;
			case 5:
				$pagetitle = $newsletter->lng->UNSUBCOMPLETE;
				$msg = $newsletter->lng->UNSUBCOMPLETED;
			break;
			case 6:
				$pagetitle = $newsletter->lng->CONFFAILED;
				$msg = $newsletter->lng->RCONFFAILEDD;
			break;
			default:
				$pagetitle = $newsletter->lng->NEWSLETTER;
				$msg = $newsletter->lng->NOTHSPECIAL;
			break;
		}
		
		$mainframe->setPageTitle($pagetitle.' - '.$newsletter->lng->NEWSLETTER);

		$metaKeys = array();
		$metaKeys[] = $newsletter->lng->NEWSLETTER;
		$metaKeys[] = $newsletter->lng->SUBSCRIBE;
		$metaKeys[] = $newsletter->lng->UNSUBSCRIBE;
		$metaKeys[] = 'mailing list';
		$metaKeys[] = _CMN_EMAIL;
		$metaKeys[] = 'e-mail notifications';
		$metaKeys[] = 'news letter';
		$metaKeys[] = 'bulk messages';
		$metaKeys[] = $newsletter->lng->NAME;
		$metaKeys[] = $newsletter->lng->SURNAME;
		$metaKeys[] = 'isopensource';

		$mainframe->setMetaTag('description', $newsletter->lng->NEWSLMAILLIST.'. '.$pagetitle);
		$mainframe->setMetaTag('keywords', implode(', ', $metaKeys));

		$link = sefRelToAbs('index.php?option=com_newsletter&Itemid='.$Itemid, IOSNLETTERBASE.'/');

		self::htmlStart();
		echo '<h2 class="iosnl_h2">'.$pagetitle."</h2>\n";
		echo "<p class=\"iosnl_status\">".$msg."<br /><br />\n";
		echo '<a href="'.$link.'" title="'.$newsletter->lng->NEWSLETTER.'" class="iosnl_link">'.$newsletter->lng->NEWSLETTER."</a><br />\n";
		echo $mainframe->getCfg('sitename')."\n";
		echo "</p>\n";

		self::htmlEnd();
	}


	/*******************************/
	/* SHOW HTML SUBSCRIPTION FORM */
	/*******************************/
	private static function subscriptionForm() {
		global $Itemid, $lang, $newsletter, $mainframe;

		self::importSubJS();
?>
		<div style="clear: both; margin-top: 20px;">&nbsp;</div>
		<form name="nlsubscribeform" method="post" action="<?php echo $mainframe->getCfg('live_site'); ?>/index2.php" style="margin: 0; padding: 0;">
		<fieldset class="iosnl_fset">
			<legend class="iosnl_leg"><?php echo $newsletter->lng->SUBLEWSL; ?></legend> 
			<div class="iosnl_subinfo">
				<?php 
				echo $newsletter->lng->SUBINFO;
				if ($newsletter->cfg->get('VALIDATE_EMAIL')) {
					echo ' '.$newsletter->lng->SUBEMAILVAL;
				}
				?>
			</div>
			<ul>
			<li>
			<label for="nlname" class="iosnl_lbl"><?php echo $newsletter->lng->NAME; ?></label>
			<input type="text" name="nlname" id="nlname" value="" class="iosnl_textbox" title="<?php echo $newsletter->lng->NAME; ?>" maxlength="60" />
			</li>
			<li>
			<label for="nlsurname" class="iosnl_lbl"><?php echo $newsletter->lng->SURNAME; ?></label>
			<input type="text" name="nlsurname" id="nlsurname" value="" class="iosnl_textbox" title="<?php echo $newsletter->lng->SURNAME; ?>" maxlength="60" />
			</li>
			<li>
			<label for="nlemail" class="iosnl_lbl"><?php echo _CMN_EMAIL; ?></label>
			<input type="text" name="nlemail" id="nlemail" value="" class="iosnl_textbox" title="<?php echo _CMN_EMAIL; ?>" maxlength="80" dir="ltr" />
			</li>

<?php 
		if (trim($newsletter->cfg->get('LANGS')) == '') {
			echo '<input type="hidden" name="nllang" id="nllang" value="" />'._LEND;
		} else {
			$nlangs = explode(',', trim($newsletter->cfg->get('LANGS')));
			if (count($nlangs) == 1) {
				echo '<input type="hidden" name="nllang" id="nllang" value="'.$nlangs[0].'" />'._LEND;
			} else {
?>
			<li>
			<label for="nllang" class="iosnl_lbl"><?php echo $newsletter->lng->RECIEVEIN; ?></label>
			<select name="nllang" id="nllang" class="iosnl_selbox" title="<?php echo _E_LANGUAGE; ?>">
				<option value="" selected="selected"><?php echo $newsletter->lng->ANYLANG; ?></option>
				<?php 
				foreach ($nlangs as $nlang) {
					echo '<option value="'.$nlang.'">'.$newsletter->translatedLang($nlang).'</option>'._LEND;
				}
				?>
			</select>
			</li>
<?php 
			}
			unset($nlangs);
		}
		
		$f = rand(1, 20);
		$s = rand(10, 40);
		$sum = ($f + $s);
?>
			<li>
			<label for="nlsum" class="iosnl_lbl"><?php echo $newsletter->lng->SECCODE; ?></label>
			<span class="iosnl_security"><?php echo $f.' + '.$s; ?> =</span> 
			<input type="text" name="nlsum" id="nlsum" value="" class="iosnl_textbox" title="<?php echo $newsletter->lng->SECCODE; ?>" maxlength="4" size="4" dir="ltr" />
			</li>
			</ul>
			<input type="hidden" name="option" value="com_newsletter" />
			<input type="hidden" name="task" value="subscribe" />
			<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
			<input type="hidden" name="mylang" value="<?php echo $lang; ?>" />
			<input type="hidden" name="nlencsum" value="<?php echo md5($mainframe->getCfg('secret').$sum); ?>" />
			<div class="iosnl_subcon">
				<input type="button" name="subscribe" value="<?php echo $newsletter->lng->SUBSCRIBE; ?>" class="iosnl_button" onclick="nlsubscribe();" />
			</div>
		</fieldset>
		</form>

<?php 
	}


	/*********************************/
	/* SHOW HTML UNSUBSCRIPTION FORM */
	/*********************************/
	private static function unsubscribeForm() {
		global $Itemid, $lang, $newsletter, $mainframe;

		self::importUnsubJS();
?>
		<div style="clear: both; margin-top: 20px;">&nbsp;</div>
		<form name="nlunsubscribeform" method="post" action="<?php echo $mainframe->getCfg('live_site'); ?>/index2.php" style="margin: 0; padding: 0;">
		<fieldset class="iosnl_fset">
			<legend class="iosnl_leg"><?php echo $newsletter->lng->UNSUBLEWSL; ?></legend> 
			<div class="iosnl_subinfo"><?php echo $newsletter->lng->UNSUBINFO; ?></div>
			<ul>
			<li>
			<label for="nlemail" class="iosnl_lbl"><?php echo _CMN_EMAIL; ?></label>
			<input type="text" name="nlemail" id="nlemail" value="" class="iosnl_textbox" title="<?php echo _CMN_EMAIL; ?>" maxlength="80" dir="ltr" />
			</li>
<?php 
		$f = rand(1, 20);
		$s = rand(10, 40);
		$sum = ($f + $s);
?>
			<li>
			<label for="nlsum" class="iosnl_lbl"><?php echo $newsletter->lng->SECCODE; ?></label>
			<span class="iosnl_security"><?php echo $f.' + '.$s; ?> =</span> 
			<input type="text" name="nlsum" id="nlsum" value="" class="iosnl_textbox" title="<?php echo $newsletter->lng->SECCODE; ?>" maxlength="4" size="4" dir="ltr" />
			</li>
			</ul>
			<input type="hidden" name="option" value="com_newsletter" />
			<input type="hidden" name="task" value="unsubscribe" />
			<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
			<input type="hidden" name="mylang" value="<?php echo $lang; ?>" />
			<input type="hidden" name="nlencsum" value="<?php echo md5($mainframe->getCfg('secret').$sum); ?>" />
			<div class="iosnl_subcon">
				<input type="button" name="unsubscribe" value="<?php echo $newsletter->lng->UNSUBSCRIBE; ?>" class="iosnl_button" onclick="nlunsubscribe();" />
			</div>
		</fieldset>
		</form>
<?php 
	}


	/******************************/
	/* SHOW NEWSLETTER STATISTICS */
	/******************************/
	static private function showStats($stats=array()) {
		global $newsletter;

		if (!$stats || (count($stats) == 0)) { return; }
		$dir = _GEM_RTL ? ' dir="rtl"' : '';
?>
		<div style="clear: both; margin-top: 20px;">&nbsp;</div>

		<h2 class="iosnl_h2"><?php echo $newsletter->lng->STATISTICS; ?></h2>
		<p class="iosnl_status">
		<?php 
		echo $newsletter->lng->SUBSTOTAL.': <strong'.$dir.'>'.$stats['subscribers']."</strong><br />\n";
		if (($stats['lastsub'] != '') && ($stats['lastsubtime'] > 0)) {
			echo $newsletter->lng->LASTSUBSCRIBER.': <span'.$dir.'><strong'.$dir.'>'.$stats['lastsub'].'</strong>';
			echo ' - '.eLOCALE::strftime_os(_GEM_DATE_FORMLC, $stats['lastsubtime'])."</span><br />\n";
		}
		echo $newsletter->lng->TOTALSENT.': <strong'.$dir.'>'.$stats['totalsent']."</strong><br />\n";
		echo $newsletter->lng->LASTSENT.': <strong'.$dir.'>';
		if ($stats['lastsent'] == 0) {
			echo _ELANG_NEVER;
		} else {
			echo eLOCALE::strftime_os(_GEM_DATE_FORMLC2, $stats['lastsent']);
		}
		echo "</strong><br />\n";	
		?>
		</p>
<?php 
	}


	/*********************/
	/* COPYRIGHT MESSAGE */
	/*********************/
	static private function copyright() {
		global $newsletter;

		if (!$newsletter->cfg->get('SHOWCOPYRIGHT')) { return; }
		
		$txtdate = (date('Y') > 2008) ? '2008-'.date('Y') : '2008';
?>
		<div style="clear: both; margin-top: 40px; font-size: 11px; color: #888; font-family: tahoma, verdana, serif; text-align: center;">
			Powered by <strong>IOS NewsLetter</strong> for <a href="http://www.elxis.org/" title="Elxis open source cms" class="iosnl_link_copy">Elxis CMS</a><br />
			Copyright &copy;<?php echo $txtdate; ?> <a href="http://www.isopensource.com/" title="Is Open Source - Web hosting, services and software" class="iosnl_link_copy">Is Open Source</a>. All rights reserved.
		</div>
<?php 		
	}


	/************************************/
	/* JAVASCRIPT FOR SUBSCRIPTION FORM */
	/************************************/
	static private function importSubJS() {
		global $newsletter;
?>
		<script type="text/javascript">
		/* <![CDATA[ */
		function nlsubscribe() {
			var form = document.nlsubscribeform;
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

			if (form.nlname.value == '') {
				alert('<?php echo $newsletter->lng->NAMEEMPTY; ?>');
				form.nlname.focus();
			} else if (form.nlsurname.value == '') {
				alert('<?php echo $newsletter->lng->SURNAMEEMPTY; ?>');
				form.nlsurname.focus();
			} else if (!filter.test(form.nlemail.value)) {
				alert('<?php echo $newsletter->lng->PROVALIDEMAIL; ?>');
				form.nlemail.focus();
			} else if (form.nlsum.value == '') {
				alert('<?php echo $newsletter->lng->SECCODEWRONG; ?>');
				form.nlsum.focus();
			} else {
				try {
					form.onsubmit();
				}
				catch(e){}
				form.submit();
			}
		}
		/* ]]> */
		</script>
<?php 
	}


	/**************************************/
	/* JAVASCRIPT FOR UNSUBSCRIPTION FORM */
	/**************************************/
	static private function importUnsubJS() {
		global $newsletter;
?>

		<script type="text/javascript">
		/* <![CDATA[ */
		function nlunsubscribe() {
			var form = document.nlunsubscribeform;
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

			if (!filter.test(form.nlemail.value)) {
				alert('<?php echo $newsletter->lng->PROVALIDEMAIL; ?>');
				form.nlemail.focus();
			} else if (form.nlsum.value == '') {
				alert('<?php echo $newsletter->lng->SECCODEWRONG; ?>');
				form.nlsum.focus();
			} else {
				try {
					form.onsubmit();
				}
				catch(e){}
				form.submit();
			}
		}
		/* ]]> */
		</script>
<?php 
	}


	private function htmlStart() {
		echo '<!-- start of newsletter by isopensource.com -->'."\n";
		echo '<div id="iosnewsletter">'."\n";
	}


	private function htmlEnd() {
		echo "</div>\n";
		echo '<!-- end of newsletter by isopensource.com -->'."\n";
	}

}

?>