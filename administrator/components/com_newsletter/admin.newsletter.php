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


if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' ) || 
	$acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_newsletter' ))) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once($mainframe->getCfg('absolute_path').'/administrator/components/com_newsletter/includes/newsletter.class.php');
$newsletter = new iosNewsLetter();

require_once($mainframe->getCfg('absolute_path').'/administrator/components/com_newsletter/admin.newsletter.html.php');


class newsletterB {
	
	private $task = '';


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
		$this->task = htmlspecialchars(trim(mosGetParam($_REQUEST, 'task', '')));
	}


	/********************/
	/* RUN FOREST, RUN! */
	/********************/
	public function run() {
		switch ($this->task) {
			case 'new':
				$this->editSubscriber(0);
			break;
			case 'edit':
				$cid = mosGetParam($_POST, 'cid', array(0));
				$this->editSubscriber($cid[0]);
			break;
			case 'editA':
				$sid = intval(mosGetParam($_REQUEST, 'sid', 0));
				$this->editSubscriber($sid);
			break;
			case 'save':
				$this->saveSubscriber();
			break;
			case 'cancel':
				mosRedirect('index2.php?option=com_newsletter&task=subscribers');
			break;
			case 'remove':
				$this->removeSubscribers();
			break;
			case 'publish':
				$this->confirmSubscribers(1);
			break;
			case 'unpublish':
				$this->confirmSubscribers(0);
			break;
			case 'ajaxconfirm': //AJAX
				$this->ajaxconfirm();
			break;
			case 'config':
				$this->configure();
			break;
			case 'saveconfig':
				$this->saveConfig();
			break;
			case 'cancelconfig':
				mosRedirect('index2.php?option=com_newsletter');
			break;
			case 'subscribers':
				$this->subscribers();
			break;
			case 'export':
				$this->exportSubscribers();
			break;
			case 'import';
				newsletterBH::importSubscribers();
			break;
			case 'doimport':
				$this->doimport();
			break;
			case 'importelxis':
				$this->importelxis();
			break;
			case 'newsletters':
				$this->newsletters();
			break;
			case 'userdata': //AJAX
				$this->getUserData();
			break;
			case 'newnl':
				$this->editNewsletter(0);
			break;
			case 'editnl':
				$cid = mosGetParam($_POST, 'cid', array(0));
				$this->editNewsletter($cid[0]);
			break;
			case 'editnlA':
				$id = intval(mosGetParam($_REQUEST, 'id', 0));
				$this->editNewsletter($id);
			break;
			case 'cancelnl':
				mosRedirect('index2.php?option=com_newsletter&task=newsletters');
			break;
			case 'savenl':
				$this->saveNewsletter();
			break;
			case 'deletenl':
				$this->deleteNewsletter();
			break;
			case 'copy':
				$this->copyNewsletter();
			break;
			case 'send':
				$this->sendNewsletter();
			break;
			case 'ajaxsend':
				$this->ajaxSend(); //AJAX - Send newsletter
			break;
			case 'upload': //index3.php, popup/POST
				$this->uploadHTMLFile();
			break;
			default:
				newsletterBH::cpanel();
			break;
		}
	}


	/*********************************/
	/* PREPARE TO SHOW CONFIGURATION */
	/*********************************/
	private function configure() {
		global $newsletter, $adminLanguage;
		
		$lists = array();

		$list = array();
    	$list[] = mosHTML::makeOption(0, $adminLanguage->A_NONE);
    	$list[] = mosHTML::makeOption(1, $newsletter->lng->REGUSERS);
    	$list[] = mosHTML::makeOption(2, $newsletter->lng->EVERYONE);
    	$lists['can_subscribe'] = mosHTML::selectList($list, 'CFG_CAN_SUBSCRIBE', 'class="selectbox" size="1"', 'value', 'text', $newsletter->cfg->get('CAN_SUBSCRIBE'));
    	unset($list);

		$list = array();
    	$list[] = mosHTML::makeOption(1, 1);
    	$list[] = mosHTML::makeOption(5, 5);
    	$list[] = mosHTML::makeOption(10, 10);
    	$list[] = mosHTML::makeOption(20, 20);
    	$list[] = mosHTML::makeOption(30, 30);
    	$list[] = mosHTML::makeOption(40, 40);
    	$list[] = mosHTML::makeOption(50, 50);
    	$list[] = mosHTML::makeOption(60, 60);
    	$list[] = mosHTML::makeOption(70, 70);
    	$list[] = mosHTML::makeOption(80, 80);
    	$list[] = mosHTML::makeOption(90, 90);
    	$list[] = mosHTML::makeOption(100, 100);
    	$list[] = mosHTML::makeOption(120, 120);
    	$list[] = mosHTML::makeOption(150, 150);
    	$list[] = mosHTML::makeOption(200, 200);
    	$lists['recperstep'] = mosHTML::selectList($list, 'CFG_RECPERSTEP', 'class="selectbox" size="1"', 'value', 'text', $newsletter->cfg->get('RECPERSTEP'));
    	unset($list);

		$list = array();
    	$list[] = mosHTML::makeOption('mail', 'PHP mail');
    	$list[] = mosHTML::makeOption('smtp', 'SMTP');
    	$list[] = mosHTML::makeOption('qmail', 'qMail');
    	$list[] = mosHTML::makeOption('sendmail', 'Sendmail');
    	$lists['sendmethod'] = mosHTML::selectList($list, 'CFG_SENDMETHOD', 'class="selectbox" size="1"', 'value', 'text', $newsletter->cfg->get('SENDMETHOD'));
    	unset($list);

		$list = array();
    	$list[] = mosHTML::makeOption('', $adminLanguage->A_NO);
    	$list[] = mosHTML::makeOption('ssl', 'SSL');
    	$list[] = mosHTML::makeOption('tls', 'TLS');
    	$lists['smtpsecure'] = mosHTML::selectList($list, 'CFG_SMTPSECURE', 'class="selectbox" size="1"', 'value', 'text', $newsletter->cfg->get('SMTPSECURE'));
    	unset($list);
    	


		newsletterBH::editConfig($lists);
	}


	/**********************/
	/* SAVE CONFIGURATION */
	/**********************/
	private function saveConfig() {
		global $fmanager, $newsletter, $adminLanguage, $mainframe;

		$CAN_SUBSCRIBE = intval(mosGetParam($_POST, 'CFG_CAN_SUBSCRIBE', 0));
		$VALIDATE_EMAIL = intval(mosGetParam($_POST, 'CFG_VALIDATE_EMAIL', 1));
		$SHOWSTATS = intval(mosGetParam($_POST, 'CFG_SHOWSTATS', 0));
		$ONEPERREC = intval(mosGetParam($_POST, 'CFG_ONEPERREC', 0));
		$RECPERSTEP = intval(mosGetParam($_POST, 'CFG_RECPERSTEP', 50));
		if ($RECPERSTEP < 1) { $RECPERSTEP = 50; }

		$READCONFIRM = intval(mosGetParam($_POST, 'CFG_READCONFIRM', 0));
		$SMTPAUTH = intval(mosGetParam($_POST, 'CFG_SMTPAUTH', 0));
		$REPLYTO = intval(mosGetParam($_POST, 'CFG_REPLYTO', 1));
		$SMTPPORT = intval(mosGetParam($_POST, 'CFG_SMTPPORT', 25));

		$SENDERNAME = eUTF::utf8_trim(mosGetParam($_POST, 'CFG_SENDERNAME', ''));
		$SENDERMAIL = eUTF::utf8_trim(mosGetParam($_POST, 'CFG_SENDERMAIL', ''));
		if ($SENDERNAME == '') { $SENDERNAME = $mainframe->getCfg('fromname'); }
		if ($SENDERMAIL == '') { $SENDERMAIL = $mainframe->getCfg('mailfrom'); }

		$SENDMETHOD = mosGetParam($_POST, 'CFG_SENDMETHOD', 'mail');
		$SENDMAILPATH = trim(mosGetParam($_POST, 'CFG_SENDMAILPATH', '/usr/sbin/sendmail'));
		$SMTPHOST = trim(mosGetParam($_POST, 'CFG_SMTPHOST', 'localhost'));
		$SMTPSECURE = trim(mosGetParam($_POST, 'CFG_SMTPSECURE', ''));
		$SMTPUSER = trim(mosGetParam($_POST, 'CFG_SMTPUSER', ''));
		$SMTPPASS = trim(mosGetParam($_POST, 'CFG_SMTPPASS', ''));
		$SHOWCOPYRIGHT = intval(mosGetParam($_POST, 'CFG_SHOWCOPYRIGHT', 1));

		$cfglangs = '';
		if (isset($_POST['CFG_LANGS']) && is_array($_POST['CFG_LANGS'])) {
			if (count($_POST['CFG_LANGS']) > 0) {
				$cfglangs = implode(',',$_POST['CFG_LANGS']);
			}
		}

		$extlds = trim(mosGetParam($_POST, 'CFG_EXTLDS', ''));
		$cfg_extlds = '';
		if ($extlds != '') {
			$arr = explode(',', $extlds);
			$tmparr = array();
			if ($arr && (count($arr) > 0)) {
				foreach ($arr as $ar) { array_push($tmparr, trim($ar)); }
				$cfg_extlds = implode(',',$tmparr);
			}
			unset ($arr, $tmparr);
		}

		$extdoms = trim(mosGetParam($_POST, 'CFG_EXDOMAINS', ''));
		$cfg_exdoms = '';
		if ($extdoms != '') {
			$arr = explode(',', $extdoms);
			$tmparr = array();
			if ($arr && (count($arr) > 0)) {
				foreach ($arr as $ar) { array_push($tmparr, trim($ar)); }
				$cfg_exdoms = implode(',',$tmparr);
			}
			unset ($arr, $tmparr);
		}

		$otlds = trim(mosGetParam($_POST, 'CFG_ONLYTLDS', ''));
		$cfg_otlds = '';
		if ($otlds != '') {
			$arr = explode(',', $otlds);
			$tmparr = array();
			if ($arr && (count($arr) > 0)) {
				foreach ($arr as $ar) { array_push($tmparr, trim($ar)); }
				$cfg_otlds = implode(',',$tmparr);
			}
			unset ($arr, $tmparr);
		}

		$odoms = trim(mosGetParam($_POST, 'CFG_ONLYDOMAINS', ''));
		$cfg_odoms = '';
		if ($odoms != '') {
			$arr = explode(',', $odoms);
			$tmparr = array();
			if ($arr && (count($arr) > 0)) {
				foreach ($arr as $ar) { array_push($tmparr, trim($ar)); }
				$cfg_odoms = implode(',',$tmparr);
			}
			unset ($arr, $tmparr);
		}

		$out = '<?php '."\n\n";
		$out .= '/* NewsLetter configuration - Created by Is Open Source (isopensource.com) */'."\n";
		$out .= '/* Last saved on '.date('Y-m-d H:i:s').' */'."\n\n";
		$out .= 'defined(\'_VALID_MOS\') or die(\'Direct Access to this location is not allowed.\');'."\n\n";
		$out .= "class newsletterConfig {\n\n";
		$out .= 'protected $CAN_SUBSCRIBE = '.$CAN_SUBSCRIBE.';'."\n";
		$out .= 'protected $VALIDATE_EMAIL = '.$VALIDATE_EMAIL.';'."\n";
		$out .= 'protected $LANGS = \''.$cfglangs.'\';'."\n";
		$out .= 'protected $EXTLDS = \''.$cfg_extlds.'\';'."\n";
		$out .= 'protected $EXDOMAINS = \''.$cfg_exdoms.'\';'."\n";
		$out .= 'protected $ONLYTLDS = \''.$cfg_otlds.'\';'."\n";
		$out .= 'protected $ONLYDOMAINS = \''.$cfg_odoms.'\';'."\n";
		$out .= 'protected $SHOWSTATS = '.$SHOWSTATS.';'."\n";
		$out .= 'protected $RECPERSTEP = '.$RECPERSTEP.';'."\n";
		$out .= 'protected $ONEPERREC = '.$ONEPERREC.';'."\n";
		$out .= 'protected $SENDERNAME = \''.$SENDERNAME.'\';'."\n";
		$out .= 'protected $SENDERMAIL = \''.$SENDERMAIL.'\';'."\n";
		$out .= 'protected $SENDMETHOD = \''.$SENDMETHOD.'\';'."\n";
		$out .= 'protected $READCONFIRM = '.$READCONFIRM.';'."\n";
		$out .= 'protected $REPLYTO = '.$REPLYTO.';'."\n";
		$out .= 'protected $SENDMAILPATH = \''.$SENDMAILPATH.'\';'."\n";
		$out .= 'protected $SMTPHOST = \''.$SMTPHOST.'\';'."\n";
		$out .= 'protected $SMTPPORT = '.$SMTPPORT.';'."\n";
		$out .= 'protected $SMTPSECURE = \''.$SMTPSECURE.'\';'."\n";
		$out .= 'protected $SMTPAUTH = '.$SMTPAUTH.';'."\n";
		$out .= 'protected $SMTPUSER = \''.$SMTPUSER.'\';'."\n";
		$out .= 'protected $SMTPPASS = \''.$SMTPPASS.'\';'."\n";
		$out .= 'protected $SHOWCOPYRIGHT = '.$SHOWCOPYRIGHT.';'."\n\n";
		$out .= "public function __construct() {\n";
		$out .= "}\n\n";
		$out .= 'public function get($v=\'\') {'."\n";
		$out .= "\t".'if ($v != \'\') {'."\n";
		$out .= "\t\t".'if (isset($this->$v)) { return $this->$v; }'."\n";
		$out .= "\t}\n";
		$out .= "\t".'return \'\';'."\n";
		$out .= "}\n";
		$out .= "}\n\n";
		$out .= '?>';

		$cfgfile = $newsletter->apath.'/config.newsletter.php';
		$ok = $fmanager->writeFile($cfgfile, $out);
		$msg = $ok ? $adminLanguage->A_SETTSUCSAVED : $newsletter->lng->CNOTSAVESETS;

		mosRedirect('index2.php?option=com_newsletter', $msg);
	}


	/*******************************/
	/* PREPARE TO LIST SUBSCRIBERS */
	/*******************************/
	private function subscribers() {
		global $database, $mainframe, $adminLanguage;

    	$filter_group = eUTF::utf8_trim(mosGetParam($_REQUEST, 'filter_group', ''));
		$formfilters = array('filter_group' => $filter_group);

		$limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mainframe->getCfg('list_limit'));
		$limitstart = $mainframe->getUserStateFromRequest("viewcom_iosnllimitstart", 'limitstart', 0);

		$where = ($filter_group != '') ? "\n WHERE s.subgroup='".$filter_group."'" : '';

		$database->setQuery("SELECT COUNT(s.sid) FROM #__iosnl_subscribers s".$where);
		$total = $database->loadResult();

		require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
		$pageNav = new mosPageNav($total, $limitstart, $limit);

		$query = "SELECT s.*, u.username FROM #__iosnl_subscribers s"
		."\n LEFT JOIN #__users u ON u.id=s.userid"
		.$where
		."\n ORDER BY s.subname ASC";
		$database->setQuery($query, '#__', $pageNav->limit, $pageNav->limitstart);
		$rows = $database->loadObjectList();

		$query = "SELECT subgroup FROM #__iosnl_subscribers WHERE ((subgroup IS NOT NULL) AND (subgroup != '')) GROUP BY subgroup ORDER BY subgroup ASC";
		$database->setQuery($query);
		$groups = $database->loadResultArray();

		$lists = array();
		$subgroups = array();
		$subgroups[] = mosHTML::makeOption('', $adminLanguage->A_ALL);

		if ($groups && (count($groups) > 0)) {
			foreach ($groups as $grp) {
				$subgroups[] = mosHTML::makeOption($grp, $grp);
			}
		}
		$lists['subgroups'] = mosHTML::selectList($subgroups, 'filter_group', 'class="selectbox" size="1" dir="ltr" onchange="document.adminForm.submit();"', 'value', 'text', $filter_group);

		newsletterBH::listSubscribers($rows, $pageNav, $lists, $formfilters);
	}


	/******************************/
	/* PREPARE TO EDIT SUBSCRIBER */
	/******************************/
	private function editSubscriber($id) {
		global $database, $mainframe, $newsletter, $adminLanguage;

		$row = new iosnlSubdb($database);
		$row->load($id);

		if (!$row) {
			$row->subtime = time() + ($mainframe->getCfg('offset') * 3600);
		}

		$lists = array();
		$users[] = mosHTML::makeOption('0', $newsletter->lng->GUEST);
		$database->setQuery("SELECT id AS value, username AS text FROM #__users WHERE block='0' ORDER BY username ASC");

		$users = array_merge($users, $database->loadObjectList());
		$lists['userid'] = mosHTML::selectList($users, 'userid', 'id="userid" class="selectbox" size="1" dir="ltr"', 'value', 'text', $row->userid);

		$subgroups = array();
		$subgroups[] = mosHTML::makeOption('', $adminLanguage->A_NONE);

		$query = "SELECT subgroup FROM #__iosnl_subscribers WHERE ((subgroup IS NOT NULL) AND (subgroup != '')) GROUP BY subgroup ORDER BY subgroup ASC";
		$database->setQuery($query);
		$groups = $database->loadResultArray();

		if ($groups && (count($groups) > 0)) {
			foreach ($groups as $grp) {
				$subgroups[] = mosHTML::makeOption($grp, $grp);
			}
		}
		$lists['subgroups'] = mosHTML::selectList($subgroups, 'subgroup', 'class="selectbox" size="1" dir="ltr"', 'value', 'text', $row->subgroup);

		newsletterBH::editSubscriber($row, $lists);
	}


	/*******************/
	/* SAVE SUBSCRIBER */
	/*******************/
	private function saveSubscriber() {
		global $database, $newsletter, $mainframe;

		$row = new iosnlSubdb($database);
		if (!$row->bind( $_POST )) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}

		$pat = "/([\"]|[\#]|[\<]|[\>]|[\*]|[\~]|[\`]|[\^]|[\|]|[\\\])/";
		$row->subname = eUTF::utf8_trim(preg_replace($pat, '', $row->subname));
		if ($row->subname == '') {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$newsletter->lng->NAMEEMPTY."'); window.history.go(-1);</script>\n";
			exit();
		}

		$row->subsurname = eUTF::utf8_trim(preg_replace($pat, '', $row->subsurname));
		if ($row->subsurname == '') {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$newsletter->lng->SURNAMEEMPTY."'); window.history.go(-1);</script>\n";
			exit();
		}

    	$row->subemail = trim($row->subemail);
		if (($row->subemail == '') || (preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $row->subemail)==false)) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$newsletter->lng->PROVALIDEMAIL."'); window.history.go(-1);</script>\n";
			exit();
		}

		$database->setQuery("SELECT COUNT(sid) FROM #__iosnl_subscribers WHERE sid <> '".$row->sid."' AND subemail='".$row->subemail."'");
		$c = intval($database->loadResult());
		if ($c > 0) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$newsletter->lng->EMAILEXISTS."'); window.history.go(-1);</script>\n";
			exit();
		}

		$newsubgroup = eUTF::utf8_trim(mosGetParam($_POST, 'newsubgroup', ''));
		if ($newsubgroup != '') {
			$row->subgroup = preg_replace($pat, '', $newsubgroup);
		}

		if (!$row->check()) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}

		if (!$row->store()) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}

		mosRedirect('index2.php?option=com_newsletter&task=subscribers');
	}


	/************************/
	/* DELETE SUBSCRIBER(S) */
	/************************/
	private function removeSubscribers() {
		global $database, $mainframe;

		$cid = mosGetParam($_REQUEST, 'cid', array(0));
		if (!is_array( $cid )) { $cid = array(0); }
		if (count($cid) > 0) {
			$cids = implode( ',', $cid );
			$database->setQuery("DELETE FROM #__iosnl_subscribers WHERE sid IN (".$cids.")");
			if (!$database->query()) {
				$mainframe->checkSendHeaders();
				echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
				exit();
			}
		}
		mosRedirect('index2.php?option=com_newsletter&task=subscribers');
	}


	/*****************************/
	/* (UN)CONFIRM SUBSCRIBER(S) */
	/*****************************/
	private function confirmSubscribers($con=1) {
		global $database, $adminLanguage, $mainframe;

		$cid = mosGetParam($_REQUEST, 'cid', array(0));
		if (!is_array( $cid )) { $cid = array(0); }

		if (count($cid) < 1) {
			$action = $publish ? 'confirm' : 'ununconfirm';
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_SELITEMTO." ".$action."'); window.history.go(-1);</script>\n";
			exit();
		}

		$cids = implode( ',', $cid );

		$extra = ($con == 1) ? ", confirmcode=''" : "";
    	$query = "UPDATE #__iosnl_subscribers SET confirmed='".$con."'".$extra." WHERE sid IN (".$cids.")";
		$database->setQuery($query);
		if (!$database->query()) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
			exit();
		}
		mosRedirect('index2.php?option=com_newsletter&task=subscribers');
	}


	/*********************************************/
	/* CONFIRM / UNCONFIRM SUBSCRIBER USING AJAX */
	/*********************************************/
	private function ajaxconfirm() {
    	global $database, $my, $adminLanguage;

    	$elem = intval(mosGetParam($_REQUEST, 'elem', 0));
    	$id = intval(mosGetParam($_REQUEST, 'id', 0));
    	$state = intval(mosGetParam($_REQUEST, 'state', 0));

    	if (!$id) {
        	echo '<img src="../includes/js/ThemeOffice/warning.png" width="16" height="16" border="0" title="'.$adminLanguage->A_ERROR.': Invalid Subscriber id" />'._LEND;
        	exit();
   	 	}

    	$error = 0;
    	$extra = ($state == 1) ? ", confirmcode=''" : "";
		$database->setQuery("UPDATE #__iosnl_subscribers SET confirmed='".$state."'".$extra." WHERE sid='".$id."'");
		if (!$database->query()) { $error = 1; }

    	if ($error) { $state = $state ? 0 : 1; }
    	$img = $state ? 'tick.png' : 'publish_x.png';
		$alt = $state ? $newsletter->lng->CONFIRMED : $newsletter->lng->UNCONFIRMED;
?>
		<a href="javascript:void(0);" 
    	onclick="changeNLState('<?php echo $elem; ?>', '<?php echo $id; ?>', '<?php echo ($state) ? 0 : 1; ?>');" title="<?php echo $alt; ?>">
		<img src="images/<?php echo $img; ?>" border="0" alt="<?php echo $alt; ?>" /></a>
<?php 
    	exit();
	}


	/**********************/
	/* EXPORT SUBSCRIBERS */
	/**********************/
	private function exportSubscribers() {
		global $database;

		$database->setQuery("SELECT userid, subname, subsurname, subemail, sublang, subgroup FROM #__iosnl_subscribers");
		$rows = $database->loadRowList();
		
		$buffer = '';
		if ($rows) {
			foreach ($rows as $row) {
				$buffer .= $row['userid'].','.$row['subname'].','.$row['subsurname'].','.$row['subemail'].','.$row['sublang'].','.$row['subgroup']."\r\n";
			}
		}

		if (ob_get_length() > 0) { ob_end_clean(); }
		$bkfile = 'ios_newsletter_backup_'.date('YmdHis').'.txt';
		@header("Cache-Control: "); //leave blank to avoid IE errors
		@header("Pragma: "); //leave blank to avoid IE errors
  		@header("Content-Type: application/force-download; charset:utf-8");
		@header("Content-Disposition: attachment; filename=".$bkfile);
		echo $buffer;
		exit();
	}


	/***************************************/
	/* IMPORT SUBSCRIBERS FROM BACKUP FILE */
	/***************************************/
	private function doimport() {
		global $fmanager, $mainframe, $database, $newsletter;

		$uploaded = 0;
		if (isset($_FILES['backupfile'])) {
			$upfile = $_FILES['backupfile'];
        	if ($upfile['name'] != '') {
				$source = $upfile['tmp_name'];
				if ($fmanager->fileExt($upfile['name']) == 'txt') {
					$k = rand(1000, 9999);
					$destfile = $mainframe->getCfg('absolute_path').'/tmpr/bk'.$k.'.txt';
					$uploaded = $fmanager->upload($source, $destfile);
				}
			}
		}

		$founded = 0;
		$imported = 0;

		if ($uploaded) {
			$checkmail = isset($_POST['checkmail']) ? 1 : 0;
			$ctime = time() + ($mainframe->getCfg('offset') * 3600);
			$fp = fopen($destfile, "r");
			while (!feof($fp)) {
				$line = fgets($fp, 4096);
				if (!preg_match('/\,/', $line)) { continue; }
				$parts = explode(',', $line);

				if (count($parts) != 6) { continue; }
				if (!preg_match('/\@/', $parts[3])) { continue; }
				$founded++;
				if ($checkmail) {
					$database->setQuery("SELECT COUNT(sid) FROM #__iosnl_subscribers WHERE subemail='".trim($parts[3])."'");
					$c = intval($database->loadResult());
					if ($c > 0) { continue; }
				}

				$query = "INSERT INTO #__iosnl_subscribers VALUES"
				."\n (NULL, '".intval($parts[0])."', '".eUTF::utf8_trim($parts[1])."', '".eUTF::utf8_trim($parts[2])."', "
				."\n '".trim($parts[3])."', '1', '".$ctime."', '".trim($parts[4])."', NULL, '".eUTF::utf8_trim($parts[5])."')";
				$database->setQuery($query);
				$imp = $database->query();
				if ($imp) { $imported++; }				
			}
			fclose($fp);
			$fmanager->deleteFile($destfile);
		}

		$msg = sprintf($newsletter->lng->IMPORTEDSUBS, $founded, $imported);

		mosRedirect('index2.php?option=com_newsletter&task=import', $msg);
	}


	/************************************/
	/* IMPORT ELXIS USERS TO NEWSLETTER */
	/************************************/
	private function importelxis() {
		global $database, $newsletter, $adminLanguage;
		
		$found = 0;
		$imported = 0;

		$database->setQuery("SELECT id, name, email, registerdate, preflang FROM #__users WHERE block='0'");
		$rows = $database->loadRowList();
		if ($rows && (count($rows) > 0)) {
			$checklang = 0;
			if ($newsletter->cfg->get('LANGS') != '') {
				$larray = explode(',',$newsletter->cfg->get('LANGS'));
				if (count($larray) > 1) { $checklang = 1; }
			} else {
				$larray = array();
			}
			foreach ($rows as $row) {
				$found++;
				$database->setQuery("SELECT COUNT(sid) FROM #__iosnl_subscribers WHERE subemail='".$row['email']."'");
				$c = intval($database->loadResult());
				if (!$c) {
					$aname = preg_split('/\s/', $row['name'], 2, PREG_SPLIT_NO_EMPTY);
					if (is_array($aname) && (count($aname) == 2) && (trim($aname[1]) != '')) {
						$name = $aname[0];
						$surname = $aname[1];
					} else {
						$name = $row['name'];
						$surname = '';
					}
					
					$utime = strtotime($row['registerdate']);
					$ulang = '';
					if ($checklang && (trim($row['preflang']) != '')) {
						if (in_array($row['preflang'], $larray)) { $ulang = $row['preflang']; }
					}

					if ($ulang != '') {
						$query = "INSERT INTO #__iosnl_subscribers VALUES"
						."\n (NULL, '".$row['id']."', '".$name."', '".$surname."', '".$row['email']."', '1', '".$utime."', '".$ulang."', NULL, NULL)";
					} else {
						$query = "INSERT INTO #__iosnl_subscribers VALUES"
						."\n (NULL, '".$row['id']."', '".$name."', '".$surname."', '".$row['email']."', '1', '".$utime."', NULL, NULL, NULL)";
					}
					$database->setQuery($query);
					$imp = $database->query();
					if ($imp) { $imported++; }
				}
			}
		}

		echo '<strong>'.$newsletter->lng->IMPORTELXUS."</strong><br /><br />\n";
		printf($newsletter->lng->FOUNDELXUIMP, '<strong>'.$found.'</strong>', '<strong>'.$imported.'</strong>');
		echo '<div style="text-align: center; margin-top: 30px;">'._LEND;
		echo '<a href="javascript:void(null);" onclick="javascript:window.close();">'.$adminLanguage->A_CLOSE."</a>\n";
		echo "</div>\n";
	}


	/************************/
	/* GET USER DATA (AJAX) */
	/************************/
	private function getUserData() {
   		global $database;

		$userid = intval(mosGetParam($_POST, 'userid', 0));
		$name = '';
		$surname = '';
		$email = '';		

   		$database->setQuery("SELECT name, email FROM #__users WHERE id='".$userid."' AND block='0'", '#__', 1, 0);
   		$row = $database->loadRow();
   		if ($row) {
   			$name = eUTF::utf8_trim($row['name']);
   			$surname = '';
   			$parts = preg_split('/\s/', $name, 2);
   			if ($parts && (count($parts == 2)) && ($parts[1] != '')) {
   				$name = $parts[0];
   				$surname = $parts[1];
   			}
   			$email = $row['email'];
   		}

		if (ob_get_length() > 0) { ob_end_clean(); }
    	@header('Content-Type: text/plain; Charset: utf-8');
		if ($email != '') {
        	echo '|1|'.$name.'|'.$surname.'|'.$email;
    	} else {
        	echo '|0|Invalid user';
    	}
    	exit();
	}


	/*******************************/
	/* PREPARE TO LIST NEWSLETTERS */
	/*******************************/
	private function newsletters() {
		global $database, $mainframe;

		$limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mainframe->getCfg('list_limit'));
		$limitstart = $mainframe->getUserStateFromRequest("viewcom_iosnllimitstart", 'limitstart', 0);

		$database->setQuery("SELECT COUNT(id) FROM #__iosnl_messages");
		$total = $database->loadResult();
		
		require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
		$pageNav = new mosPageNav($total, $limitstart, $limit);
	
		$query = "SELECT * FROM #__iosnl_messages ORDER BY subject ASC";
		$database->setQuery($query, '#__', $pageNav->limit, $pageNav->limitstart);
		$rows = $database->loadObjectList();

		newsletterBH::listMessages($rows, $pageNav);
	}


	/*******************************/
	/* PREPARE ADD/EDIT NEWSLETTER */
	/*******************************/
	private function editNewsletter($id) {
		global $database, $mainframe, $newsletter, $fmanager;

		$row = new iosnlMsgdb($database);
		$row->load($id);

		if (!$row) {
			$row->recipients = 0;
			$row->lastsent = '0';
			$row->msglang = $mainframe->getCfg('lang');
			$row->htmlfile = '';
		}

		$lists = array();
		$xlangs = array();
		$plangs = explode(',',$mainframe->getCfg('pub_langs'));
		foreach ($plangs as $plang) {
			$xlangs[] = mosHTML::makeOption($plang, $newsletter->translatedLang($plang));
		}
		$lists['msglang'] = mosHTML::selectList($xlangs, 'msglang', 'id="msglang" class="selectbox" size="1" dir="ltr"', 'value', 'text', $row->msglang);

		$htmlfiles = $fmanager->listFiles($newsletter->apath.'/htmlfiles', '\.html');

		$hfiles = array();
		$hfiles[] = mosHTML::makeOption('', $newsletter->lng->SELECTFILE);
		if ($htmlfiles && (count($htmlfiles) > 0)) {
			foreach ($htmlfiles as $htmlfile) {
				if ($htmlfile != 'index.html') {
					$hfiles[] = mosHTML::makeOption($htmlfile, $htmlfile);
				}
			}
		}
		$lists['htmlfile'] = mosHTML::selectList($hfiles, 'htmlfile', 'id="htmlfile" class="selectbox" size="1" dir="ltr"', 'value', 'text', $row->htmlfile);

		newsletterBH::editNewsletter($row, $lists);
	}


	/*******************/
	/* SAVE NEWSLETTER */
	/*******************/
	private function saveNewsletter() {
		global $database, $newsletter, $mainframe;

		$row = new iosnlMsgdb($database);
		if (!$row->bind( $_POST )) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}

		$pat = "/([\"]|[\#]|[\<]|[\>]|[\*]|[\~]|[\`]|[\^]|[\|]|[\\\])/";
		$row->subject = eUTF::utf8_trim(preg_replace($pat, '', $row->subject));
		if ($row->subject == '') {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$newsletter->lng->SUBJECTEMPTY."'); window.history.go(-1);</script>\n";
			exit();
		}

		if ((trim($row->textplain) == '') && (trim($row->texthtml) == '') && ($row->htmlfile == '')) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$newsletter->lng->NEWSLNEMPTY."'); window.history.go(-1);</script>\n";
			exit();
		}

		if (!$row->check()) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}

		if (!$row->store()) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}

		mosRedirect('index2.php?option=com_newsletter&task=newsletters');
	}


	/************************/
	/* DELETE NEWSLETTER(S) */
	/************************/
	private function deleteNewsletter() {
		global $database, $mainframe;

		$cid = mosGetParam($_REQUEST, 'cid', array(0));
		if (!is_array( $cid )) { $cid = array(0); }
		if (count($cid) > 0) {
			$cids = implode(',', $cid);
			$database->setQuery("DELETE FROM #__iosnl_messages WHERE id IN (".$cids.")");
			if (!$database->query()) {
				$mainframe->checkSendHeaders();
				echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
				exit();
			}
		}
		mosRedirect('index2.php?option=com_newsletter&task=newsletters');
	}


	/**********************/
	/* COPY NEWSLETTER(S) */
	/**********************/
	private function copyNewsletter() {
		global $database, $mainframe, $newsletter;

		$cid = mosGetParam($_REQUEST, 'cid', array(0));
		if (!is_array( $cid )) { $cid = array(0); }
		if (count($cid) > 0) {
			foreach ($cid as $id) {
				$row = new iosnlMsgdb($database);
				$row->load($id);
				if (!$row->id) { continue; }

				$row->id = null;
				$row->subject .= ' ('.$newsletter->lng->THECOPY.')';
				$row->store();
				unset($row);
			}
		}
		mosRedirect('index2.php?option=com_newsletter&task=newsletters');
	}


	/***************************/
	/* SEND NEWSLETTER OPTIONS */
	/***************************/
	private function sendNewsletter() {
		global $database, $mainframe, $newsletter, $adminLanguage;

		$cid = mosGetParam($_REQUEST, 'cid', array(0));
		if (!is_array( $cid )) { $cid = array(0); }
		$id = intval($cid[0]);
		if (!$id) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('Please select a Newsletter to send!'); window.history.go(-1);</script>\n";
			exit();
		}

		$row = new iosnlMsgdb($database);
		$row->load($id);

		$recipients = array();
		$database->setQuery("SELECT COUNT(sid) FROM #__iosnl_subscribers WHERE confirmed='1'");
		$recipients['total'] = intval($database->loadResult());
		$recipients['langs'] = array();

		if (trim($newsletter->cfg->get('LANGS')) != '') {
			$xlangs = explode(',', $newsletter->cfg->get('LANGS'));
			if ($xlangs && (count($xlangs) > 0)) {
				foreach ($xlangs as $xlang) {
					$query = "SELECT COUNT(sid) FROM #__iosnl_subscribers"
					."\n WHERE confirmed='1' AND ((sublang = '') OR (sublang IS NULL) OR (sublang='".$xlang."'))";
					$database->setQuery($query);
					$recipients['langs'][$xlang] = intval($database->loadResult());
				}
			}
		}

		$query = "SELECT subgroup FROM #__iosnl_subscribers WHERE ((subgroup IS NOT NULL) AND (subgroup != '')) GROUP BY subgroup ORDER BY subgroup ASC";
		$database->setQuery($query);
		$groups = $database->loadResultArray();

		$lists = array();
		$subgroups = array();
		$subgroups[] = mosHTML::makeOption('', $adminLanguage->A_ALL);

		if ($groups && (count($groups) > 0)) {
			foreach ($groups as $grp) {
				$subgroups[] = mosHTML::makeOption($grp, $grp);
			}
		}
		$lists['subgroups'] = mosHTML::selectList($subgroups, 'subgroup', 'id="subgroup" class="selectbox" size="1" dir="ltr"', 'value', 'text', '');

		newsletterBH::sendNewsletter($row, $recipients, $lists);
	}


	/*************************/
	/* SEND MAILS USING AJAX */
	/*************************/
	private function ajaxSend() {
		global $database, $newsletter, $mainframe;

		$id = intval(mosGetParam($_GET, 'id', 0));
		$format = intval(mosGetParam($_GET, 'format', 3)); //1: plain, 2: html, 3: plain + html
		$forced = intval(mosGetParam($_GET, 'forced', 0));
		$step = intval(mosGetParam($_GET, 'step', 1));
		$subgroup = eUTF::utf8_trim(mosGetParam($_GET, 'subgroup', ''));

		$database->setQuery("SELECT * FROM #__iosnl_messages WHERE id='".$id."'", '#__', 1, 0);
		$msg = $database->loadRow();
		if (!$msg) { die('Invalid message!'); }

		$andwhere = ($forced) ? '' : " AND ((sublang='".$row['msglang']."') OR (sublang='') OR (sublang IS NULL))";
		$andwhere2 = ($subgroup != '') ? " AND subgroup='".$subgroup."'" : '';

		$database->setQuery("SELECT COUNT(sid) FROM #__iosnl_subscribers WHERE confirmed='1'".$andwhere.$andwhere2);
		$total = intval($database->loadResult());
		if (!$total) { die('No valid recipients found!'); }

		$steps = ceil($total/$newsletter->cfg->get('RECPERSTEP'));
		$lstart = ($newsletter->cfg->get('RECPERSTEP') * ($step - 1));

		$isLastStep = 0;
		if ($step == $steps) {
			$isLastStep = 1;
		} elseif ($step > $steps) {
			die($newsletter->lng->DISPATCHCOM);
		}

		$query = "SELECT subname, subsurname, subemail FROM #__iosnl_subscribers WHERE confirmed='1'".$andwhere.$andwhere2;
		$database->setQuery($query, '#__', $newsletter->cfg->get('RECPERSTEP'), $lstart);
		$rows = $database->loadRowList();
		if (!$rows) {
			die('No recipients found!');
		}

		require_once($newsletter->apath.'/includes/class.phpmailer.php');
		$mailer = new IOSPHPMailer();
		$mailer->CharSet = 'utf-8';
		$mailer->Subject = $msg['subject'];
		$mailer->From = $newsletter->cfg->get('SENDERMAIL');
		$mailer->FromName = $newsletter->cfg->get('SENDERNAME');
		$mailer->Sendmail = ($newsletter->cfg->get('SENDMAILPATH') != '') ? $newsletter->cfg->get('SENDMAILPATH') : '/usr/sbin/sendmail';

		switch ($newsletter->cfg->get('SENDMETHOD')) {
			case 'sendmail': $mailer->IsSendmail(); break;
			case 'smtp':
			$mailer->IsSMTP();
			$mailer->Host = $newsletter->cfg->get('SMTPHOST');
			$mailer->Port = $newsletter->cfg->get('SMTPPORT');
			$mailer->SMTPSecure = $newsletter->cfg->get('SMTPSECURE');

			if ($newsletter->cfg->get('SMTPAUTH')) {
				$mailer->SMTPAuth = true;
				$mailer->Username = $newsletter->cfg->get('SMTPUSER');
				$mailer->Password = $newsletter->cfg->get('SMTPPASS');
			} else {
				$mailer->SMTPAuth = false;
				$mailer->Username = '';
				$mailer->Password = '';
			}
			break;
			case 'qmail': $mailer->IsQmail(); break;
			case 'mail': default: $mailer->IsMail(); break;
		}

		$mailer->SingleTo = $newsletter->cfg->get('ONEPERREC') ? true : false;
		$mailer->ConfirmReadingTo = $newsletter->cfg->get('READCONFIRM') ? $newsletter->cfg->get('SENDERMAIL') : '';

		if ($format === 1) {
			$mailer->IsHTML(false);
    		$mailer->Body = $msg['textplain'];
			$mailer->AltBody = '';
		} else {
			$mailer->IsHTML(true);

			$ok = 0;
			if ($msg['htmlfile'] != '') {
				if (preg_match('/(\.html)$/i', $msg['htmlfile'])) {
					if (file_exists($newsletter->apath.'/htmlfiles/'.$msg['htmlfile'])) {
						$body  = $mailer->getFile($newsletter->apath.'/htmlfiles/'.$msg['htmlfile']);
						$body = preg_replace("/\\\/i",'',$body);
						$mailer->MsgHTML($body);
						$ok = 1;
					}
				}
			}
			if (!$ok) {
				if (trim($msg['texthtml']) == '') { die('No message to send!'); }
				$mailer->MsgHTML($msg['texthtml']);
			}
			$mailer->AltBody = ($format === 2) ? '' : $msg['textplain'];
		}

		foreach ($rows as $row) {
			$rname = trim($row['subsurname'] != '') ? $row['subname'].' '.$row['subsurname'] : $row['subname'];
			$mailer->AddAddress($row['subemail'], $rname);
		}

		if ($newsletter->cfg->get('REPLYTO')) {
			$mailer->AddReplyTo($newsletter->cfg->get('SENDERMAIL'), $newsletter->cfg->get('SENDERNAME'));
		}

		if (!$mailer->Send()) {
			$result = $mailer->ErrorInfo;
			$success = 0;
		} else {
			$tillnow = count($rows) + ($newsletter->cfg->get('RECPERSTEP') * ($step - 1));
			$result = sprintf($newsletter->lng->MSGOFSENT, $tillnow, $total);
			$success = 1;
		}
		$mailer->ClearAddresses();
		$mailer->ClearAttachments();
		unset($mailer);

		if ($success) {
			$c = intval($msg['recipients']) + count($rows);
			$ls = time() + ($mainframe->getCfg('offset') * 3600);
			$database->setQuery("UPDATE #__iosnl_messages SET recipients = '".$c."', lastsent = '".$ls."' WHERE id='".$id."'");
			$database->query();
		}

		echo (!$success) ? '<span style="color: #CC0000;">'.$result.'</span>' : $result;
		if ($isLastStep) {
			echo "<br />".$newsletter->lng->DISPATCHCOM."\n";
		}
		exit();
	}


	/*************************/
	/* SHOW/UPLOAD HTML FILE */
	/*************************/
	private function uploadHTMLFile() {
		global $newsletter, $adminLanguage, $fmanager;
		
		$message = '';
		if (isset($_POST['submitup']) && isset($_FILES['nlfile'])) {
			$dir = $newsletter->apath.'/htmlfiles';
			$userfile = $_FILES['nlfile'];
			if (is_uploaded_file($userfile['tmp_name'])) {
				if ($fmanager->fileExt($userfile['name']) == 'html') {
					if ($userfile['type'] == 'text/html') {
						$destfile = eUTF::utf8_strtolower(eUTF::utf8_str_replace(' ', '_', $userfile['name']));
						if (file_exists($dir.'/'.$destfile)) {
							$destfile = rand(1000, 9999).'_'.$destfile;
						}
						$ok = $fmanager->upload($userfile['tmp_name'], $dir.'/'.$destfile);
						if ($ok) {
							$fmanager->spChmod($dir.'/'.$destfile, '0666');
							$message = $adminLanguage->A_ALERT_UPLOAD_SUC.' ('.$destfile.')';
						} else {
							$message = $adminLanguage->A_ALERT_UPLOAD_FAILED.' ('.$destfile.')';
						}
					}
				}
			}
		}

		if ($message != '') {
			echo '<p><strong>'.$message.'</strong></p>';
		}
?>

		<form name="nlupload" action="index3.php" method="post" enctype="multipart/form-data">
			<p><?php echo $newsletter->lng->UPHTMLTEMP; ?></p>
			<?php echo $adminLanguage->A_FILE; ?>: 
			<input type="file" name="nlfile" value="" /><br />
			<input type="hidden" name="option" value="com_newsletter" />
			<input type="hidden" name="task" value="upload" />
			<input type="hidden" name="hidemainmenu" value="1" />
			<div align="center" style="margin-top: 20px;">
				<input type="submit" name="submitup" value="<?php echo $adminLanguage->A_UPLOAD; ?>" class="button" />
			</div>
		</form>

<?php 		
	}

}


$letterB = new newsletterB();
$letterB->run();
unset($letterB);

?>