<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component eBlog
* @author: Ioannis Sannos (Elxis Team)
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Component eBlog back-end
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
		| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_eblog' ))) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}


require_once($mainframe->getCfg('absolute_path').'/administrator/components/com_eblog/admin.eblog.html.php');
require_once($mainframe->getCfg('absolute_path').'/components/com_eblog/eblog.class.php');


class eBlogBack {

	private $task = '';
	private $path = '';
	public $lng;


	public function __construct() {
		global $mainframe;

		$this->task = mosGetParam($_REQUEST, 'task', '');
		$this->path = $mainframe->getCfg('absolute_path').'/components/com_eblog';
		$this->loadLanguage();
	}


	/***********************/
	/* LOAD EBLOG LANGUAGE */
	/***********************/
	private function loadLanguage() {
		global $mainframe, $alang;

		if (file_exists($this->path.'/language/'.$alang.'.php')) {
			require_once($this->path.'/language/'.$alang.'.php');
		} else if (file_exists($this->path.'/language/'.$mainframe->getCfg('alang').'.php')) {
			require_once($this->path.'/language/'.$mainframe->getCfg('alang').'.php');
		} else {
			require_once($this->path.'/language/english.php');
		}
		$this->lng = new eBlogLang();
	}


	public function run() {
		switch ($this->task) {
			case 'new':
				$this->editBlog(0);
			break;
			case 'edit':
				$cid = mosGetParam($_POST, 'cid', array(0));
				$this->editBlog($cid[0]);
			break;
			case 'editA':
				$blogid = intval(mosGetParam($_REQUEST, 'blogid', 0));
				$this->editBlog($blogid);
			break;
			case 'save':
				$this->saveBlog(0);
			break;
			case 'apply':
				$this->saveBlog(1);
			break;
			case 'cancel':
				mosRedirect('index2.php?option=com_eblog');
			break;
			case 'remove':
				$cid = mosGetParam($_POST, 'cid', array(0));
				$this->deleteBlog($cid[0]);
			break;
			case 'publish':
				$cid = mosGetParam($_POST, 'cid', array(0));
				$this->publishBlog($cid, 1);
			break;
			case 'unpublish':
				$cid = mosGetParam($_POST, 'cid', array(0));
				$this->publishBlog($cid, 0);
			break;
			case 'ajaxpub':
				$this->ajaxpubBlog();
			break;
			case 'suggest':
				$this->suggest();
			break;
			case 'validate':
				$this->validate();
			break;
			case 'list':
			default:
				$this->listBlogs();
			break;
		}
	}


	/*************************/
	/* PREPARE TO LIST BLOGS */
	/*************************/
	private function listBlogs() {
		global $database, $mainframe;

		$limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mainframe->getCfg('list_limit'));
		$limitstart = $mainframe->getUserStateFromRequest("viewcom_ebloglimitstart", 'limitstart', 0);

		$database->setQuery("SELECT COUNT(*) FROM #__eblog_settings");
		$total = $database->loadResult();

		require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
		$pageNav = new mosPageNav( $total, $limitstart, $limit );
	
		$query = "SELECT b.blogid, b.title, b.seotitle, b.ownerid, b.published, u.name, u.username"
		."\n FROM #__eblog_settings b"
		."\n LEFT JOIN #__users u ON u.id = b.ownerid"
		//."\n WHERE u.block='0'"
		."\n ORDER BY b.title ASC";
		$database->setQuery( $query, '#__', $pageNav->limit, $pageNav->limitstart );
		$rows = $database->loadObjectList();

		if ($rows) {
			foreach ($rows as $row) {
				$database->setQuery("SELECT COUNT(id) FROM #__eblog WHERE blogid='".$row->blogid."'");
				$row->posts = intval($database->loadResult());
			}
		}

		eBlogBHTML::listBlogs($rows, $pageNav);
	}


	/************************/
	/* PREPARE TO EDIT BLOG */
	/************************/
	private function editBlog($blogid=0) {
		global $database, $fmanager, $mainframe, $my, $adminLanguage;

		$row = new eBlogSettings($database);
		$row->load($blogid);

		if (!$row) {
			$row->posts = 0;
			$row->comments = 0;
			$row->totalfiles = 0;
			$row->totalsize = 0;
			$row->lastpost = '-';
			$row->lastpostdate = $adminLanguage->A_NEVER;
			$row->emailit = '';
			$row->addthis = '';
		} else {
			$database->setQuery("SELECT COUNT(id) FROM #__eblog WHERE blogid='".$blogid."'");
			$row->posts = intval($database->loadResult());

			$query = "SELECT COUNT(c.cid) FROM #__comments c"
			."\n LEFT JOIN #__eblog b ON b.id = c.articleid"
			."\n LEFT JOIN #__eblog_settings s ON s.blogid = b.blogid"
			."\n WHERE c.origin='0' AND s.blogid='".$blogid."'";
			$database->setQuery($query);
			$row->comments = intval($database->loadResult());

			$dirok = 0;
			if ($row->canupload) {
				$basedir = $mainframe->getCfg('absolute_path').'/images/userfiles';
				$dirok = 1;
				if (!is_dir($basedir.'/'.$row->ownerid.'/') | !file_exists($basedir.'/'.$row->ownerid.'/')) {
					$dirok = @mkdir($basedir.'/'.$row->ownerid.'/', 0777);
					$fmanager->createFile($basedir.'/'.$row->ownerid.'/index.html');
				}
			}

			$totalfiles = 0;
			$totalsize = 0;
			if ($dirok) {
				$files = $fmanager->listFiles($basedir.'/'.$row->ownerid.'/');
				if (count($files) > 0) {
					clearstatcache();
					foreach ($files as $file) {
						if (!is_dir($file) && ($file != '.') && ($file != '..')) {
							if ($file != 'index.html') {
								$totalfiles++;
								$fs = filesize($basedir.'/'.$row->ownerid.'/'.$file);
								$totalsize += $fs;
							}
						}
					}
				}
			}
			$row->totalfiles = $totalfiles;
			$row->totalsize = $totalsize;

			if ($row->params != '') {
				$lines = explode("\n", $row->params);
				if ($lines) {
					foreach ($lines as $line) {
						$line = trim($line);
						if ($line != '') {
							$parts = preg_split('/\=/', $line, 2);
							if ($parts && (count($parts) == 2)) {
								$k = trim($parts[0]);
								if (!isset($row->$k)) { $row->$k = trim($parts[1]); }
							}
							unset($parts);
						}
					}
				}
			}

			$database->setQuery("SELECT title, dateadded FROM #__eblog WHERE blogid='".$blogid."' ORDER BY dateadded DESC", '#__', 1, 0);
			$last = $database->loadRow();
			if ($last) {
				$row->lastpost = $last['title'];
				$row->lastpostdate = mosFormatDate($last['dateadded']);
			} else {
				$row->lastpost = '-';
				$row->lastpostdate = $adminLanguage->A_NEVER;				
			}
		}

		$lists = array();

		$active = intval( $row->ownerid ) ? intval( $row->ownerid ) : $my->id;
		$lists['ownerid'] = mosAdminMenus::UserSelect('ownerid', $active);
		$lists['showtags'] = mosHTML::yesnoRadioList('showtags', 'class="inputbox"', $row->showtags);
		$lists['canconfig'] = mosHTML::yesnoRadioList('canconfig', 'class="inputbox"', $row->canconfig);
		$lists['canupload'] = mosHTML::yesnoRadioList('canupload', 'class="inputbox"', $row->canupload);
		$lists['footerarchive'] = mosHTML::yesnoRadioList('footerarchive', 'class="inputbox"', $row->footerarchive);
		$lists['showownertop'] = mosHTML::yesnoRadioList('showownertop', 'class="inputbox"', $row->showownertop);
		//$lists['numposts']
		$lists['published'] = mosHTML::yesnoRadioList('published', 'class="inputbox"', $row->published);
		$shares = array();
		$shares[] = mosHTML::makeOption('0', _GEM_NO);
		$shares[] = mosHTML::makeOption('1', 'e-mailit');
		$shares[] = mosHTML::makeOption('2', 'AddThis');
		$lists['share'] = mosHTML::selectList($shares, 'share', 'class="selectbox" size="1"', 'value', 'text', $row->share);
		unset($shares);
		$allcoms = array();
		$allcoms[] = mosHTML::makeOption('0', $this->lng->NOTALLOWED);
		$allcoms[] = mosHTML::makeOption('1', $this->lng->REGUSERS);
		$allcoms[] = mosHTML::makeOption('2', $this->lng->ALLOWEDALL);
		$lists['allowcomments'] = mosHTML::selectList($allcoms, 'allowcomments', 'class="selectbox" size="1"', 'value', 'text', $row->allowcomments);

		$cfiles = array();
		$cssfiles = $fmanager->listFiles($this->path.'/css/', '\.css');
		if (count($cssfiles) > 0) {
			foreach ($cssfiles as $cssfile) {
				$cfiles[] = mosHTML::makeOption($cssfile, $cssfile);
			}
		}

		$lists['cssfile'] = mosHTML::selectList($cfiles, 'cssfile', 'class="selectbox" size="1" title="CSS" dir="ltr"', 'value', 'text', $row->cssfile);
		$lists['rtlcssfile'] = mosHTML::selectList($cfiles, 'rtlcssfile', 'class="selectbox" size="1" title="RTL CSS" dir="ltr"', 'value', 'text', $row->rtlcssfile);

		eBlogBHTML::editBlog($row, $lists);
	}


	/**************/
	/* SAVE BLOG  */
	/**************/
	private function saveBlog($apply=0) {
		global $database, $my, $adminLanguage, $mainframe, $fmanager;

		$row = new eBlogSettings($database);
		if (!$row->bind($_POST)) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}

		$pat = "/([\"]|[\#]|[\<]|[\>]|[\*]|[\~]|[\`]|[\^]|[\|]|[\\\])/";
		$row->title = eUTF::utf8_trim(preg_replace($pat, '', $row->title));
		if ($row->title == '') {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$this->lng->TITLENOEMPTY."'); window.history.go(-1);</script>\n";
			exit();
		}

		if (($row->cssfile == '') || !preg_match('/(\.css)$/i', $row->cssfile)) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('Invalid CSS file!'); window.history.go(-1);</script>\n";
			exit();
		}

		if (($row->rtlcssfile == '') || !preg_match('/(\.css)$/i', $row->rtlcssfile)) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('Invalid RTL CSS file!'); window.history.go(-1);</script>\n";
			exit();
		}

		if (!intval($row->ownerid)) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('Invalid blog owner!'); window.history.go(-1);</script>\n";
			exit();
		}

		if ($row->canupload && (intval($row->mediasize) < 10)) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('Please give more upload space to user'); window.history.go(-1);</script>\n";
			exit();
		}

		$cfg_p_emailit = mosGetParam($_POST, 'emailit', '');
		$cfg_p_emailit = trim(preg_replace($pat, '', $cfg_p_emailit));
		$cfg_p_addthis = mosGetParam($_POST, 'addthis', '');
		$cfg_p_addthis = trim(preg_replace($pat, '', $cfg_p_addthis));
		$row->params = 'emailit='.$cfg_p_emailit."\n".'addthis='.$cfg_p_addthis;

    	require_once($this->path.'/eblogseovs.class.php');
    	$seo = new eblogseovs('blog', '', $row->seotitle);
    	$seo->blogid = intval($row->blogid);
    	$seoval = $seo->validate();
		if (!$seoval) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_SEOTITLE.": ".$seo->message."'); window.history.go(-1);</script>"._LEND;
			exit();
    	}

		if ($row->canupload) {
			$basedir = $mainframe->getCfg('absolute_path').'/images/userfiles';
			if (!is_dir($basedir.'/'.$row->ownerid.'/') | !file_exists($basedir.'/'.$row->ownerid.'/')) {
				$dirok = @mkdir($basedir.'/'.$row->ownerid.'/', 0777);
				if ($dirok) {
					$fmanager->createFile($basedir.'/'.$row->ownerid.'/index.html');
				}
			}
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

		if ($apply == 1) {
			mosRedirect('index2.php?option=com_eblog&task=editA&hidemainmenu=1&blogid='.$row->blogid, $adminLanguage->A_SETTSUCSAVED);
		} else {
			mosRedirect('index2.php?option=com_eblog', $adminLanguage->A_SETTSUCSAVED);
		}
	}


	/****************/
	/* DELETE EBLOG */
	/****************/
	private function deleteBlog($blogid) {
		global $database;

		//delete blog
		$database->setQuery("DELETE FROM #__eblog_settings WHERE blogid='".$blogid."'");
		if (!$database->query()) {
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
			exit();
		}

		//delete comments
		$query = "SELECT cid FROM #__comments c "
		."\n LEFT JOIN #__eblog b ON b.id = c.articleid"
		."\n WHERE c.origin='0' AND b.blogid='".$blogid."'";
		$database->setQuery($query);
		$coms = $database->loadResultArray();
		if ($coms && (count($coms) > 0)) {
			$strcoms = implode(',', $coms);
			$database->setQuery("DELETE FROM #__comments WHERE origin='0' AND cid IN (".$strcoms.")");
			$database->query();
		} 

		//delete posts
		$database->setQuery("DELETE FROM #__eblog WHERE blogid='".$blogid."'");
		$database->query();

		mosRedirect('index2.php?option=com_eblog');
	}


	/*****************************/
	/* PUBLISH/UNPUBLISH BLOG(S) */
	/*****************************/
	protected function publishBlog($cid=null, $publish=1) {
		global $database, $my, $adminLanguage;

		if (!is_array( $cid )) { $cid = array(); }
		if (count( $cid ) < 1) {
			$action = $publish ? 'publish' : 'unpublish';
			echo "<script type=\"text/javascript\">alert('Please select a blog to ".$action."'); window.history.go(-1);</script>\n";
			exit();
		}

		$cids = implode( ',', $cid );
		$database->setQuery("UPDATE #__eblog_settings SET published='".$publish."' WHERE blogid IN (".$cids.")");
		if (!$database->query()) {
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
			exit();
		}
		mosRedirect('index2.php?option=com_eblog');
	}


	/*********************************/
	/* PUBLISH/UNPUBLISH BLOG (AJAX) */
	/*********************************/
	protected function ajaxpubBlog() {
    	global $database, $adminLanguage, $mainframe;

    	$elem = intval(mosGetParam($_REQUEST, 'elem', 0));
    	$blogid = intval(mosGetParam($_REQUEST, 'blogid', 0));
    	$state = intval(mosGetParam($_REQUEST, 'state', 0));

    	if (!$blogid) {
        	echo '<img src="'.$mainframe->getCfg('live_site').'/includes/js/ThemeOffice/warning.png" width="16" height="16" border="0" title="'.$adminLanguage->A_ERROR.': Invalid Blog id" />'._LEND;
        	exit();
    	}

    	$error = 0;
		$database->setQuery( "UPDATE #__eblog_settings SET published='".$state."' WHERE blogid='".$blogid."'");
		if (!$database->query()) { $error = 1; }

    	if ($error) { $state = $state ? 0 : 1; }
    	$img = $state ? 'tick.png' : 'publish_x.png';
    	$alt = $state ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
?>
		<a href="javascript: void(0);" onclick="changeBlogState('<?php echo $elem; ?>', '<?php echo $blogid; ?>', '<?php echo ($state) ? 0 : 1; ?>');">
		<img src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/images/<?php echo $img; ?>" width="12" height="12" border="0" title="<?php echo $alt; ?>" /></a>
<?php 
    	exit();
}


	/***************************/
	/* VALIDATE BLOG SEO TITLE */
	/***************************/
	protected function validate() {
		$blogid = intval(mosGetParam($_POST, 'blogid', 0));
		$seotitle = eUTF::utf8_trim(mosGetParam($_POST, 'seotitle', ''));

		require_once($this->path.'/eblogseovs.class.php');
    	$seo = new eblogseovs('blog', '', $seotitle);
    	$seo->blogid = intval($blogid);
    	$seo->validate();
    	echo $seo->message;
    	exit();
	}


	/**************************/
	/* SUGGEST BLOG SEO TITLE */
	/**************************/
	protected function suggest() {
   		$blogid = intval(mosGetParam($_POST, 'blogid', 0));
   		$cotitle = mosGetParam($_POST, 'cotitle', '');

    	require_once($this->path.'/eblogseovs.class.php');
    	$seo = new eblogseovs('blog', $cotitle);
    	$seo->blogid = intval($blogid);
    	$sname = $seo->suggest();

		if (ob_get_length() > 0) { ob_end_clean(); }
    	@header('Content-Type: text/plain; Charset: utf-8');
    	if ($sname) {
        	echo '|1|'.$sname;
    	} else {
        	echo '|0|'.$seo->message;
    	}
    	exit();
	}

}


$eblogb = new eBlogBack();
$eblogb->run();
unset($eblogb);

?>
