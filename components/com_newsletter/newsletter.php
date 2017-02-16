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


require_once($mainframe->getCfg('absolute_path').'/administrator/components/com_newsletter/includes/newsletter.class.php');
$newsletter = new iosNewsLetter();

require_once($mainframe->getCfg('absolute_path').'/components/com_newsletter/newsletter.html.php');


class newsletterF {

	private $task = '';

	public function __construct() {
		$this->task = htmlspecialchars(trim(mosGetParam($_REQUEST, 'task', '')));
	}


	/********************/
	/* RUN FOREST, RUN! */
	/********************/
	public function run() {
		switch ($this->task) {
			case 'subscribe':
				$this->subscribe(); //index2.php post
			break;
			case 'confirm';
				$this->importHeadData();
				$this->confirm();
			break;
			case 'unsubscribe':
				$this->unsubscribe(); //index2.php post
			break;
			case 'rconfirm':
				$this->importHeadData();
				$this->rconfirm();
			break;
			case 'status':
				$this->importHeadData();
				newsletterFH::showStatus();
			break;
			case 'newsletter':
			default:
				$this->importHeadData();
				$this->subscribeForm();
			break;
		}
	}


	/************************************/
	/* IMPORT NEEDED CSS AND JAVASCRIPT */
	/************************************/
	private function importHeadData() {
		global $mainframe, $newsletter;

		$cssfile = (_GEM_RTL) ? 'newsletter-rtl.css' : 'newsletter.css';
		$mainframe->addCustomHeadTag('<link href="'.$newsletter->url.'/css/'.$cssfile.'" rel="stylesheet" type="text/css" media="all" />');
		$ie6 = '<!--[if lte IE 7]><link href="'.$newsletter->url.'/css/ie6.css" rel="stylesheet" type="text/css" media="all" /><![endif]-->';
		$mainframe->addCustomHeadTag($ie6);
	}


	/**********************************/
	/* PREPARE TO SHOW SUBSCRIBE FORM */
	/**********************************/
	private function subscribeForm() {
		global $my, $database, $newsletter, $mainframe;

		switch ($newsletter->cfg->get('CAN_SUBSCRIBE')) {
			case 2:	$cansub = 1; break;
			case 1: $cansub = ($my->id) ? 1 : 0; break;
			case 0:	default: $cansub = 0; break;
		}

		$stats = array();
		if ($newsletter->cfg->get('SHOWSTATS')) {
			$database->setQuery("SELECT COUNT(sid) FROM #__iosnl_subscribers WHERE confirmed='1'");
			$stats['subscribers'] = intval($database->loadResult());

			$stats['totalsent'] = 0;
			$database->setQuery("SELECT recipients FROM #__iosnl_messages");
			$recs = $database->loadResultArray();
			if ($recs && (count($recs) > 0)) {
				foreach ($recs as $rec) { $stats['totalsent'] += intval($rec); }
			}

			$stats['lastsent'] = 0;
			$database->setQuery("SELECT lastsent FROM #__iosnl_messages ORDER BY lastsent ASC", '#__', 1, 0);
			$lastsent = $database->loadResult();
			if ($lastsent) {
				$stats['lastsent'] = $lastsent;
			}

			$stats['lastsub'] = '';
			$stats['lastsubtime'] = 0;
			$database->setQuery("SELECT subname, subsurname, subtime FROM #__iosnl_subscribers WHERE confirmed='1' ORDER BY subtime DESC", '#__', 1, 0);
			$sub = $database->loadRow();
			if ($sub) {
				$stats['lastsub'] = $sub['subname'].' '.$sub['subsurname'];
				$stats['lastsubtime'] = $sub['subtime'];
			}
		}

		$mainframe->setPageTitle($newsletter->lng->NEWSLETTER);

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

		$desc = $newsletter->lng->NEWSLMAILLIST.'. '.$newsletter->lng->SUBLEWSL.', '.$newsletter->lng->RECIEVEIN.' '.$newsletter->lng->ANYLANG;

		$mainframe->setMetaTag('description', $desc);
		$mainframe->setMetaTag('keywords', implode(', ', $metaKeys));
		$mainframe->setMetaTag('author', $mainframe->getCfg('fromname'));

		newsletterFH::htmlForms($cansub, $stats);
	}


	/******************/
	/* SUBSCRIBE USER */
	/******************/
	private function subscribe() {
		global $newsletter, $mainframe, $database, $my, $Itemid;

		switch ($newsletter->cfg->get('CAN_SUBSCRIBE')) {
			case 2:	$cansub = 1; break;
			case 1: $cansub = ($my->id) ? 1 : 0; break;
			case 0:	default: $cansub = 0; break;
		}

		if (!$cansub) {
			$msg = $newsletter->cfg->get('CAN_SUBSCRIBE') ? $newsletter->lng->SUBLOGIN : $newsletter->lng->SUBNALLOWED;
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$msg."'); window.history.go(-1);</script>\n";
			exit();
		}

		$patterns = array('/\$/', '/\#/', '/\^/', '/\'/', '/\"/', '/\&/', '/\`/', '/\</', '/\>/', '/\*/', '/\|/', '/\\\/');

		$nlname = eUTF::utf8_trim(mosGetParam($_POST, 'nlname', ''));
		$nlname = preg_replace($patterns, '', $nlname);
		$nlname = htmlspecialchars($nlname);
		if (($nlname == '') || (eUTF::utf8_strlen($nlname) < 3) || (eUTF::utf8_strlen($nlname) > 60)) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$newsletter->lng->NAMEEMPTY."'); window.history.go(-1);</script>\n";
			exit();
		}

		$nlsurname = eUTF::utf8_trim(mosGetParam($_POST, 'nlsurname', ''));
		$nlsurname = preg_replace($patterns, '', $nlsurname);
		$nlsurname = htmlspecialchars($nlsurname);
		if (($nlsurname == '') || (eUTF::utf8_strlen($nlsurname) < 3) || (eUTF::utf8_strlen($nlsurname) > 60)) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$newsletter->lng->SURNAMEEMPTY."'); window.history.go(-1);</script>\n";
			exit();
		}

		$nlsum = intval(mosGetParam($_POST, 'nlsum', 0));
		$nlencsum = trim(mosGetParam($_POST, 'nlencsum', ''));
		if (md5($mainframe->getCfg('secret').$nlsum) != $nlencsum) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$newsletter->lng->SECCODEWRONG."'); window.history.go(-1);</script>\n";
			exit();
		}

    	$nlemail = trim(mosGetParam($_POST, 'nlemail', ''));
		if ((trim($nlemail == '')) || (preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $nlemail )==false)) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$newsletter->lng->PROVALIDEMAIL."'); window.history.go(-1);</script>\n";
			exit();
		}

		if (trim($newsletter->cfg->get('LANGS')) == '') {
			$nllang = '';
		} else {
			$nllang = htmlspecialchars(trim(mosGetParam($_POST, 'nllang', '')));
			if ($nllang != '') {
				$xlangs = explode(',', trim($newsletter->cfg->get('LANGS')));
				if (!in_array($nllang, $xlangs)) { $nllang = ''; }
			}
		}

		//check if e-mail already exists
		$database->setQuery("SELECT COUNT(sid) FROM #__iosnl_subscribers WHERE subemail = '".$nlemail."'");
		$c = intval($database->loadResult());
		if ($c) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$newsletter->lng->EMAILEXISTS."'); window.history.go(-1);</script>\n";
			exit();
		}

		$parts = preg_split('/\@/', $nlemail);
		$domain = strtolower($parts[1]);
		if (trim($newsletter->cfg->get('ONLYTLDS')) != '') {
			$tlds = explode(',', trim($newsletter->cfg->get('ONLYTLDS')));
			$ok = 0;
			foreach ($tlds as $tld) {
				if (preg_match('/('.$tld.')$/i', $domain)) { $ok = 1; break; }
			}
			if (!$ok) {
				$mainframe->checkSendHeaders();
				echo "<script type=\"text/javascript\">alert('".$newsletter->lng->NOTACCDOM."'); window.history.go(-1);</script>\n";
				exit();
			}
			unset($tlds);
		}

		if (trim($newsletter->cfg->get('ONLYDOMAINS')) != '') {
			$doms = explode(',', trim($newsletter->cfg->get('ONLYDOMAINS')));
			if (!in_array($domain, $doms)) {
				$mainframe->checkSendHeaders();
				echo "<script type=\"text/javascript\">alert('".$newsletter->lng->NOTACCDOM."'); window.history.go(-1);</script>\n";
				exit();				
			}
			unset($doms);
		}

		if (trim($newsletter->cfg->get('EXTLDS')) != '') {
			$tlds = explode(',', trim($newsletter->cfg->get('EXTLDS')));
			$ok = 1;
			foreach ($tlds as $tld) {
				if (preg_match('/('.$tld.')$/i', $domain)) { $ok = 0; break; }
			}
			if (!$ok) {
				$mainframe->checkSendHeaders();
				echo "<script type=\"text/javascript\">alert('".$newsletter->lng->NOTACCDOM."'); window.history.go(-1);</script>\n";
				exit();
			}
		}

		if (trim($newsletter->cfg->get('EXDOMAINS')) != '') {
			$doms = explode(',', trim($newsletter->cfg->get('EXDOMAINS')));
			if (in_array($domain, $doms)) {
				$mainframe->checkSendHeaders();
				echo "<script type=\"text/javascript\">alert('".$newsletter->lng->NOTACCDOM."'); window.history.go(-1);</script>\n";
				exit();				
			}
		}

		$now = time() + ($mainframe->getCfg('offset') * 3600);
		//flood protection
		$database->setQuery("SELECT subtime FROM #__iosnl_subscribers ORDER BY subtime DESC",'#__', 1, 0);
		$subtime = intval($database->loadResult());
		if ($subtime) {
			if ($subtime > ($now - 20)) {
				$mainframe->checkSendHeaders();
				echo "<script type=\"text/javascript\">alert('".$newsletter->lng->FLOODWAIT."'); window.history.go(-1);</script>\n";
				exit();
			}
		}

		$salt = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$len = strlen($salt);
		$confirmcode = '';
		mt_srand(10000000*(double)microtime());
		for ($i = 0; $i < 16; $i++) {
			$confirmcode .= $salt[mt_rand(0,$len - 1)];
		}

		$row = new iosnlSubdb($database);
		$row->userid = ''.intval($my->id).'';
		$row->subname = $nlname;
		$row->subsurname = $nlsurname;
		$row->subemail = $nlemail;
		$row->confirmed = $newsletter->cfg->get('VALIDATE_EMAIL') ? '0' : '1';
		$row->subtime = $now;
		$row->sublang = ($nllang == '') ?  null : $nllang;
		$row->confirmcode = $newsletter->cfg->get('VALIDATE_EMAIL') ? $confirmcode : null;
		$row->subgroup = null;

		$row->store();

		if ($newsletter->cfg->get('VALIDATE_EMAIL')) {
			$confLink = sefRelToAbs('index.php?option=com_newsletter&task=confirm&c='.$confirmcode.'&Itemid='.$Itemid, IOSNLETTERBASE.'/confirm.html?c='.$confirmcode);
			if (!preg_match('/^(http)/i', $confLink)) {
				$confLink = preg_replace('/^(\/)/', '', $confLink);
				$confLink = $mainframe->getCfg('_live_site').'/'.$confLink;
			}
			$confLink = str_replace('&amp;', '&', $confLink);

			$subject = $newsletter->lng->NEWSLSUBNTF;

			$mailbody = $newsletter->lng->DEAR.' '.$nlname.' '.$nlsurname.",\r\n";
			$mailbody .= $newsletter->lng->THANKSUB."\r\n";
			$mailbody .= $newsletter->lng->SUBCOMPVISIT."\r\n\r\n";
			$mailbody .= $confLink."\r\n\r\n";
			$mailbody .= $newsletter->lng->NEVERSUBIGN."\r\n\r\n";
			$mailbody .= $newsletter->lng->GREETINGS.",\r\n";
			$mailbody .= $mainframe->getCfg('sitename')."\r\n";
			$mailbody .= $mainframe->getCfg('live_site')."\r\n";
			@mosMail($mainframe->getCfg('mailfrom'), $mainframe->getCfg('fromname'), $nlemail, $subject, $mailbody);
		}

		$s = $newsletter->cfg->get('VALIDATE_EMAIL') ? 1 : 2;

		$redLink = sefRelToAbs('index.php?option=com_newsletter&task=status&Itemid='.$Itemid.'&s='.$s, IOSNLETTERBASE.'/status.html?s='.$s);
		mosRedirect($redLink);
	}


	/********************/
	/* UNSUBSCRIBE USER */
	/********************/
	private function unsubscribe() {
		global $newsletter, $mainframe, $database, $Itemid;

		$nlsum = intval(mosGetParam($_POST, 'nlsum', 0));
		$nlencsum = trim(mosGetParam($_POST, 'nlencsum', ''));
		if (md5($mainframe->getCfg('secret').$nlsum) != $nlencsum) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$newsletter->lng->SECCODEWRONG."'); window.history.go(-1);</script>\n";
			exit();
		}

    	$nlemail = trim(mosGetParam($_POST, 'nlemail', ''));
		if ((trim($nlemail == '')) || (preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $nlemail )==false)) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$newsletter->lng->PROVALIDEMAIL."'); window.history.go(-1);</script>\n";
			exit();
		}

		//check if e-mail exists
		$database->setQuery("SELECT sid, subname, subsurname FROM #__iosnl_subscribers WHERE subemail = '".$nlemail."' AND confirmed='1'");
		$database->loadObject($row);
		if (!$row) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$newsletter->lng->MAILNFOUND."'); window.history.go(-1);</script>\n";
			exit();
		}

		if ($newsletter->cfg->get('VALIDATE_EMAIL')) {
			$salt = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$len = strlen($salt);
			$confirmcode = '';
			mt_srand(10000000*(double)microtime());
			for ($i = 0; $i < 16; $i++) {
				$confirmcode .= $salt[mt_rand(0,$len - 1)];
			}

			$database->setQuery("UPDATE #__iosnl_subscribers SET confirmcode = '".$confirmcode."' WHERE sid='".$row->sid."'");
			$database->query();

			$rconfLink = sefRelToAbs('index.php?option=com_newsletter&task=rconfirm&c='.$confirmcode.'&Itemid='.$Itemid, IOSNLETTERBASE.'/rconfirm.html?c='.$confirmcode);
			if (!preg_match('/^(http)/i', $rconfLink)) {
				$rconfLink = preg_replace('/^(\/)/', '', $rconfLink);
				$rconfLink = $mainframe->getCfg('_live_site').'/'.$rconfLink;
			}
			$rconfLink = str_replace('&amp;', '&', $rconfLink);

			$subject = $newsletter->lng->UNSUBCONFIRM;

			$mailbody = $newsletter->lng->DEAR.' '.$row->subname.' '.$row->subsurname.",\r\n";
			$mailbody .= $newsletter->lng->WISHUNSCLICK."\r\n\r\n";
			$mailbody .= $rconfLink."\r\n\r\n";
			$mailbody .= $newsletter->lng->UNSUBINGORE."\r\n\r\n";
			$mailbody .= $newsletter->lng->GREETINGS.",\r\n";
			$mailbody .= $mainframe->getCfg('sitename')."\r\n";
			$mailbody .= $mainframe->getCfg('live_site')."\r\n";
			@mosMail($mainframe->getCfg('mailfrom'), $mainframe->getCfg('fromname'), $nlemail, $subject, $mailbody);
		} else {
			$database->setQuery("DELETE FROM #__iosnl_subscribers WHERE sid='".$row->sid."'");
			$database->query();
		}

		$s = $newsletter->cfg->get('VALIDATE_EMAIL') ? 4 : 5;

		$redLink = sefRelToAbs('index.php?option=com_newsletter&task=status&Itemid='.$Itemid.'&s='.$s, IOSNLETTERBASE.'/status.html?s='.$s);
		mosRedirect($redLink);
	}


	/************************/
	/* CONFIRM SUBSCRIPTION */
	/************************/
	private function confirm() {
		global $database, $Itemid;

		$c = htmlspecialchars(trim(mosGetParam($_GET, 'c', '')));

		$ok = 0;
		if ($c != '') {
			$database->setQuery("SELECT sid FROM #__iosnl_subscribers WHERE confirmed='0' AND confirmcode='".$c."'", '#__', 1, 0);
			$sid = intval($database->loadResult());
			if ($sid > 0) {
				$database->setQuery("UPDATE #__iosnl_subscribers SET confirmed='1', confirmcode = NULL WHERE sid='".$sid."'");
				$database->query();
				$ok = 1;
			}
		}

		$s = $ok ? 2 : 3;
		$redLink = sefRelToAbs('index.php?option=com_newsletter&task=status&Itemid='.$Itemid.'&s='.$s, IOSNLETTERBASE.'/status.html?s='.$s);
		mosRedirect($redLink);
	}


	/**************************/
	/* CONFIRM UNSUBSCRIPTION */
	/**************************/
	private function rconfirm() {
		global $database, $Itemid;

		$c = htmlspecialchars(trim(mosGetParam($_GET, 'c', '')));

		$ok = 0;
		if ($c != '') {
			$database->setQuery("SELECT sid FROM #__iosnl_subscribers WHERE confirmed='1' AND confirmcode='".$c."'", '#__', 1, 0);
			$sid = intval($database->loadResult());
			if ($sid > 0) {
				$database->setQuery("DELETE FROM #__iosnl_subscribers WHERE sid='".$sid."'");
				$database->query();
				$ok = 1;
			}
		}

		$s = $ok ? 5 : 6;
		$redLink = sefRelToAbs('index.php?option=com_newsletter&task=status&Itemid='.$Itemid.'&s='.$s, IOSNLETTERBASE.'/status.html?s='.$s);
		mosRedirect($redLink);
	}

}


$letterF = new newsletterF();
$letterF->run();
unset($letterF);

?>