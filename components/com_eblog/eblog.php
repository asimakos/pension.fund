<?php 
/** 
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component eBlog
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$usertype = ($my->usertype == '') ? eUTF::utf8_strtolower($acl->get_group_name('29')) : eUTF::utf8_strtolower($my->usertype);
if (($mainframe->getCfg('access') == '1') | ($mainframe->getCfg('access') == '3')) {
	if (!($acl->acl_check( 'action', 'view', 'users', $usertype, 'components', 'all' ) ||  
	    $acl->acl_check( 'action', 'view', 'users', $usertype, 'components', 'com_eblog' ))) {
	    	mosRedirect( 'index.php', _NOT_AUTH );
	}
}

$access = new stdClass();
if (!$my->id) {
	$access->canViewProfOwn = 0;
	$access->canViewProf = $acl->acl_check('action', 'view', 'users', $usertype, 'profile', 'all');
} else {
	$access->canViewProf = $acl->acl_check( 'action', 'view', 'users', $usertype, 'profile', 'all' );
	if ($access->canViewProf == 1) {
		$access->canViewProfOwn = 1;
	} else {
		$access->canViewProfOwn = $acl->acl_check( 'action', 'view', 'users', $usertype, 'profile', 'own');
	}
}


require_once($mainframe->getCfg('absolute_path').'/components/com_eblog/eblog.class.php');
require_once($mainframe->getCfg('absolute_path').'/components/com_eblog/eblog.html.php');


class eBlogFront {

	public $lng = null; //language object
	public $year = '2008'; //used for archive
	public $month = '09'; //used for archive
	public $day = '01'; //used for archive
	public $task = 'browse';
	public $url = '';
	private $path = '';
	private $id = 0; //requested article
	private $_config = null; //blog settings (object)


	/***************/
	/* CONSTRUCTOR */
	/***************/
	public function __construct() {
		$this->task = trim(mosGetParam($_REQUEST, 'task', ''));
		$this->id = intval(mosGetParam($_REQUEST, 'id', 0));
		$this->_getConfig();
	}


	/***********************************/
	/* GET SELECTED BLOG CONFIGURATION */
	/***********************************/
	private function _getConfig() {
		global $mainframe, $database, $Itemid;

		$this->path = $mainframe->getCfg('absolute_path').'/components/com_eblog';
		$this->url = $mainframe->getCfg('live_site').'/components/com_eblog';
		$this->loadLanguage();

		$blogid = intval(mosGetParam($_REQUEST, 'blogid', 0));
		if ($blogid) {
			$backlink = sefRelToAbs('index.php?option=com_eblog&Itemid='.$Itemid, 'eblog/');
			$row = new eBlogSettings($database);
			$row->load($blogid);
			if (($row) && (intval($row->blogid) > 0)) {
				$this->_config = new stdClass();
				$this->_config->blogid = $row->blogid;
				$this->_config->title = $row->title;
				$this->_config->seotitle = $row->seotitle;
				$this->_config->slogan = $row->slogan;
				$this->_config->ownerid = $row->ownerid;
				$this->_config->showtags = intval($row->showtags);
				$this->_config->cssfile = $row->cssfile;
				if (($row->cssfile == '') || !file_exists($this->path.'/css/'.$row->cssfile)) {
					$this->_config->cssfile = 'eblog.css';	
				}
				$this->_config->rtlcssfile = $row->rtlcssfile;
				if (($row->rtlcssfile == '') || !file_exists($this->path.'/css/'.$row->rtlcssfile)) {
					$this->_config->rtlcssfile = $this->_config->cssfile;	
				}
				$this->_config->allowcomments = intval($row->allowcomments);
				$this->_config->canconfig = intval($row->canconfig);
				$this->_config->numposts = intval($row->numposts);
				if ($this->_config->numposts < 1) { $this->_config->numposts = 10; }
				$this->_config->canupload = intval($row->canupload);
				$this->_config->mediasize = intval($row->mediasize);
				$this->_config->footerarchive = intval($row->footerarchive);
				$this->_config->showownertop = intval($row->showownertop);
				$this->_config->published = intval($row->published);
				$this->_config->share = intval($row->share);
				if (!$this->_config->published) {
					$this->_config = null;
					mosRedirect($backlink, 'Invalid blog!');
					return;
				}

				if ($row->params != '') {
					$lines = explode("\n", $row->params);
					if ($lines) {
						foreach ($lines as $line) {
							$line = trim($line);
							if ($line != '') {
								$parts = preg_split('/\=/', $line, 2);
								if ($parts && (count($parts) == 2)) {
									$k = trim($parts[0]);
									if (!isset($this->_config->$k)) { $this->_config->$k = trim($parts[1]); }
								}
								unset($parts);
							}
						}
					}
				}

				$query = "SELECT name, username, email, avatar FROM #__users WHERE id='".$row->ownerid."' AND block='0'";
				$database->setQuery($query, '#__', 1, 0);
				$database->loadObject($owner);
				if (!$owner) {
					$this->_config = null;
					mosRedirect($backlink, 'Invalid blog!');
					return;
				}
				$this->_config->ownername = $owner->name;
				$this->_config->owneruname = $owner->username;
				$this->_config->owneremail = $owner->email;
				$this->_config->owneravatar = $owner->avatar;
				if (trim($owner->avatar) == '') { $this->_config->owneravatar = 'noavatar.png'; }
			}
		}
	}


	/***********************/
	/* LOAD EBLOG LANGUAGE */
	/***********************/
	private function loadLanguage() {
		global $mainframe, $lang;

		if (file_exists($this->path.'/language/'.$lang.'.php')) {
			require_once ($this->path.'/language/'.$lang.'.php');
		} else if (file_exists($this->path.'/language/'.$mainframe->getCfg('lang').'.php')) {
			require_once ($this->path.'/language/'.$mainframe->getCfg('lang').'.php');
		} else {
			require_once ($this->path.'/language/english.php');
		}
		$this->lng = new eBlogLang();
	}


	/**********************************/
	/* GET BLOG CONFIGURTION VARIABLE */
	/**********************************/
	public function getCV($var='') {
		if (($var != '') && isset($this->_config->$var)) { return $this->_config->$var; }
		return false;
	}


	/********************/
	/* RUN FOREST, RUN! */
	/********************/
	public function run() {
		switch ($this->task) {
			case 'addcomment': //index2.php post action
				$this->addComment();
			break;
			case 'removenotif': //index2.php post action
				$this->stopnotifications();
			break;
			case 'delcomment':
				$this->deleteComment(); //index2.php get url
			break;
			case 'tags':
				$this->importHeadData();
				$this->searchTags();
			break;
			case 'cpanel':
				$this->importHeadData();
				$this->controlPanel();
			break;
			case 'new':
			case 'edit':
				$this->importHeadData();
				$this->editPost();
			break;
			case 'save':
				$this->savePost(); //index2.php post action
			break;
			case 'delete':
				$this->deletePost(); //index2.php get url
			break;
			case 'validate': //index2.php post ajax
        		$this->validateSEO();
			break;
			case 'suggest': //index2.php post ajax
	   			$this->suggestSEO();
			break;
			case 'media':
				$this->importHeadData();
				$this->browseMedia(); //index2.php get url popup
			break;
			case 'deletemedia':
				$this->deleteMedia(); //index2.php get url popup
			break;
			case 'uploadmedia':
				$this->uploadMedia(); //index2.php form post popup
			break;
			case 'addextra': //index2.php get url popup
				$this->importHeadData();
				eBlogFHTML::addExtra();
			break;
			case 'config':
				$this->importHeadData();
				$this->blogConfig();
			break;
			case 'saveconfig':
				$this->saveConfig(); //form post to index2.php
			break;
			case 'archive':
				$this->importHeadData();
				$this->getArchive();
			break;
			case 'dayposts':
				$this->importHeadData();
				$this->getDayPosts();
			break;
			case 'show':
				$this->importHeadData();
				$this->getArticle();
			break;
			case 'browse':
				$this->importHeadData();
				$this->getBlog();
			break;
			case 'list':
			default:
				$this->importHeadData();
				$this->listBlogs();
			break;
		}
	}


	/*************************************/
	/* PREPARE TO DISPLAY REQUESTED BLOG */
	/*************************************/
	private function getBlog() {
		global $database, $lang, $mainframe;

		$query = "SELECT b.* FROM #__eblog b"
		."\n WHERE b.blogid='".$this->getCV('blogid')."' AND b.published='1'"
		."\n AND ((b.language IS NULL) OR (b.language LIKE '%".$lang."%'))"
		."\n ORDER BY b.dateadded DESC";
		$database->setQuery($query, '#__', $this->getCV('numposts'), 0);
		$rows = $database->loadObjectlist();

		$metaKeys = array();

		if ($rows) {
			$c = count($rows);
			$cpa = ceil(16/$c); //keywords per article

			for ($i=0; $i < $c; $i++) {
				$row = $rows[$i];
				$mks = explode(',', $row->tags);
				for($q=0; $q < count($mks); $q++) {
					if ($q >= $cpa) { break; }
					$mk = eUTF::utf8_trim($mks[$q]);
					array_push($metaKeys, eUTF::utf8_trim($mk));
				}

				$database->setQuery("SELECT COUNT(cid) FROM #__comments WHERE origin='0' AND articleid='".$row->id."' AND published='1'");
				$row->numcomments = intval($database->loadResult());
			}
		}

		$metaKeys[] = 'blog';

		if (count($metaKeys) < 10) {
			$metaKeys[] = $this->getCV('ownername');
			$metaKeys[] = $this->getCV('owneruname');
		}

		$metaDesc = '';
		if (trim($this->getCV('slogan')) != '') {
			$metaDesc = strip_tags($this->getCV('slogan'));
			$pat = "/([\']|[\&]|[\"]|[\$]|[\#]|[\<]|[\>]|[\*]|[\%]|[\~]|[\`]|[\^]|[\|]|[\{]|[\}]|[\\\])/";
			$metaDesc = preg_replace($pat, '', $metaDesc);
		}
		if ($metaDesc == '') {
			$metaDesc = $this->getCV('title').'. '._WRITTEN_BY.' '.$this->getCV('ownername');
		}

		$mainframe->setPageTitle($this->getCV('title'));
		$mainframe->setMetaTag('description', $metaDesc );
		$mainframe->setMetaTag('keywords', implode(', ', $metaKeys));
		$mainframe->setMetaTag('author', $this->getCV('ownername'));

		eBlogFHTML::showBlog($rows);
	}


	/****************************************/
	/* PREPARE TO DISPLAY REQUESTED ARTICLE */
	/****************************************/
	private function getArticle() {
		global $database, $lang, $mainframe;

		$query = "SELECT b.* FROM #__eblog b"
		."\n WHERE b.id='".$this->id."' AND b.blogid='".$this->getCV('blogid')."' AND b.published='1'"
		."\n AND ((b.language IS NULL) OR (b.language LIKE '%".$lang."%'))";
		$database->setQuery($query, '#__', 1, 0);
		$database->loadObject($row);

		if (!$row) {
			eBlogFHTML::blogError($this->lng->ARTNOFOUND);
			return;	
		}

		$row->hits += 1;
		$database->setQuery("UPDATE #__eblog SET hits='".$row->hits."' WHERE id='".$this->id."'");
		$database->query();

		$query = "SELECT c.*, u.username, u.avatar FROM #__comments c"
		."\n LEFT JOIN #__users u ON u.id=c.userid"
		."\n WHERE c.origin='0' AND c.articleid='".$row->id."' AND published='1'"
		."\n ORDER BY c.ctimestamp ASC";
		$database->setQuery($query);
		$comments = $database->loadObjectlist();

		$row->numcomments = count($comments);

		$query = "SELECT id, title, seotitle FROM #__eblog"
		."\n WHERE id <>'".$this->id."' AND blogid='".$this->getCV('blogid')."' AND published='1'"
		."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
		."\n AND dateadded > '".$row->dateadded."' ORDER BY dateadded ASC";
		$database->setQuery($query, '#__', 1, 0);
		$next = $database->loadRow();

		$query = "SELECT id, title, seotitle FROM #__eblog"
		."\n WHERE id <>'".$this->id."' AND blogid='".$this->getCV('blogid')."' AND published='1'"
		."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
		."\n AND dateadded < '".$row->dateadded."' ORDER BY dateadded DESC";
		$database->setQuery($query, '#__', 1, 0);
		$previous = $database->loadRow();

    	//Automatic Meta tags
		$metaKeys = array();
		if (trim($row->tags) != '') {
			$mks = explode(',', $row->tags);
			foreach ($mks as $mk) {
				array_push($metaKeys, eUTF::utf8_trim($mk));
			}
		}

		$metaKeys[] = $this->getCV('ownername');
		if (count($metaKeys) < 10) {
			$pat = "/([\']|[\!]|[\;]|[\(]|[\)]|[\"]|[\$]|[\#]|[\<]|[\>]|[\*]|[\%]|[\~]|[\`]|[\^]|[\|]|[\{]|[\}]|[\\\])/";
			$t = preg_replace($pat, '', $row->title); 
			$mks = explode(' ', $t);
			foreach ($mks as $mk) {
				$ti = eUTF::utf8_trim($mk);
				if (eUTF::utf8_strlen($ti) > 3) { array_push($metaKeys, $ti); }
			}
		}
		if (count($metaKeys) < 10) {
			$metaKeys[] = 'blog';
			$metaKeys[] = $this->getCV('owneruname');
		}

		$mainframe->setPageTitle($row->title.' - '.$this->getCV('title'));
		$mainframe->setMetaTag('description', $row->title.'. '.$this->getCV('title'));
		$mainframe->setMetaTag('keywords', implode(', ', $metaKeys));
		$mainframe->setMetaTag('author', $this->getCV('ownername'));

		eBlogFHTML::showArticle($row, $comments, $previous, $next);
	}


	/***********************************/
	/* PREPARE TO DISPLAY BLOG ARCHIVE */
	/***********************************/
	private function getArchive() {
		global $database, $lang, $mainframe;

		$month = intval(mosGetParam($_REQUEST, 'month', date('Ym')));
		$y = ''.date('Y').'';
		$m = ''.date('m').'';
		if (($month > 200806) && ($month < intval((date('Ym') + 1)))) {
			$mstring = ''.$month.'';
			$y = substr($mstring, 0, 4);
			$m = substr($mstring, 4, 2);
		}
		if ($m > 12 ) { $m = '01'; }
		if (!checkdate($m, 15, $y)) {
			eBlogFHTML::blogError($this->lng->INVDATE);
			return;	
		}
		$this->year = $y;
		$this->month = $m;

		$pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;

		$query = "SELECT COUNT(b.id) FROM #__eblog b WHERE b.blogid='".$this->getCV('blogid')."' AND b.published='1'";
		if ($pg) {
			$query .= "\n AND EXTRACT(YEAR FROM(b.dateadded)) = '".$this->year."'"
			."\n AND EXTRACT(MONTH FROM(b.dateadded)) = '".$this->month."'";
		} else {
			$query .= "\n AND b.dateadded LIKE ('".$this->year."-".$this->month."%')";
		}
		$query .= "\n AND ((b.language IS NULL) OR (b.language LIKE '%".$lang."%'))";
		$database->setQuery($query);
		$total = intval($database->loadResult());

		if ($mainframe->getCfg('sef') == 2) {
			$page = intval(mosGetParam($_REQUEST, 'page', 0));
			if ($page < 1) { $page = 0; }
			$limitstart = ($page * 10);
		} else {
    		$limitstart = intval(mosGetParam($_REQUEST, 'limitstart', 0));
    		if ($limitstart < 0) { $limitstart = 0; }
		}
		if ($total <= 10) { $limitstart = 0; }

		require_once($mainframe->getCfg('absolute_path').'/includes/pageNavigation.php');
		$pageNav = new mosPageNav($total, $limitstart, 10);

		$query = "SELECT b.* FROM #__eblog b WHERE b.blogid='".$this->getCV('blogid')."' AND b.published='1'";
		if ($pg) {
			$query .= "\n AND EXTRACT(YEAR FROM(b.dateadded)) = '".$this->year."'"
			."\n AND EXTRACT(MONTH FROM(b.dateadded)) = '".$this->month."'";
		} else {
			$query .= "\n AND b.dateadded LIKE ('".$this->year."-".$this->month."%')";
		}
		$query .= "\n AND ((b.language IS NULL) OR (b.language LIKE '%".$lang."%'))"
		."\n ORDER BY b.dateadded DESC";
		$database->setQuery($query, '#__', $pageNav->limit, $pageNav->limitstart);
		$rows = $database->loadObjectList();

		$metaKeys = array();
		$metaKeys[] = $this->translatedMonth($this->month).' '.$this->year;

		if ($rows) {
			$c = count($rows);
			$cpa = ceil(20/$c); //keywords per article

			for ($i=0; $i < $c; $i++) {
				$row = $rows[$i];
				$mks = explode(',', $row->tags);
				for($q=0; $q < count($mks); $q++) {
					if ($q >= $cpa) { break; }
					$mk = eUTF::utf8_trim($mks[$q]);
					array_push($metaKeys, eUTF::utf8_trim($mk));
				}

				$database->setQuery("SELECT COUNT(cid) FROM #__comments WHERE origin='0' AND articleid='".$row->id."' AND published='1'");
				$row->numcomments = intval($database->loadResult());
			}
		}
		$metaKeys[] = 'blog';

		if (count($metaKeys) < 16) {
			$metaKeys[] = $this->getCV('ownername');
			$metaKeys[] = $this->getCV('owneruname');
		}

		$dstr = $this->year.'-'.$this->month.'-15 12:00:00';
		$fdate = mosFormatDate($dstr, "%B %Y", 0);
		$metaDesc = sprintf($this->lng->METADESCDAY,  $fdate, $this->getCV('title'));

		$pgtitle = $fdate.' - '.$this->getCV('title');
		$total_pages = ceil($pageNav->total / $pageNav->limit);
		if ($total_pages > 1) {
			$this_page = ceil(($pageNav->limitstart+1) / $pageNav->limit);
			if ($this_page > $total_pages) { $this_page = $total_pages; }	
			if ($this_page > 1) { $pgtitle .= ' ('._PN_PAGE.' '.$this_page.')'; }
		}

		$mainframe->setPageTitle($pgtitle);
		$mainframe->setMetaTag('description', $metaDesc );
		$mainframe->setMetaTag('keywords', implode(', ', $metaKeys));
		$mainframe->setMetaTag('author', $this->getCV('ownername'));

		eBlogFHTML::showBlog($rows, $pageNav);
	}


	/*************************************/
	/* PREPARE TO DISPLAY BLOG DAY POSTS */
	/*************************************/
	private function getDayPosts() {
		global $database, $lang, $mainframe;

		$day = intval(mosGetParam($_REQUEST, 'day', date('Ymd')));
		$y = ''.date('Y').'';
		$m = ''.date('m').'';
		$d = ''.date('d').'';
		if (($day > 20080601) && ($day < intval((date('Ymd') + 1)))) {
			$mstring = ''.$day.'';
			$y = substr($mstring, 0, 4);
			$m = substr($mstring, 4, 2);
			$d = substr($mstring, -2);
		}
		if ($m > 12 ) { $m = '01'; }
		if ($d > 31 ) { $d = '01'; }
		
		if (!checkdate($m, $d, $y)) {
			eBlogFHTML::blogError($this->lng->INVDATE);
			return;	
		}
		$this->year = $y;
		$this->month = $m;
		$this->day = $d;

		$pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;

		$query = "SELECT b.* FROM #__eblog b WHERE b.blogid='".$this->getCV('blogid')."' AND b.published='1'";
		if ($pg) {
			$query .= "\n AND EXTRACT(YEAR FROM(b.dateadded)) = '".$this->year."'"
			."\n AND EXTRACT(MONTH FROM(b.dateadded)) = '".$this->month."'"
			."\n AND EXTRACT(DAY FROM(b.dateadded)) = '".$this->day."'";
		} else {
			$query .= "\n AND b.dateadded LIKE ('".$this->year."-".$this->month."-".$this->day."%')";
		}
		$query .= "\n AND ((b.language IS NULL) OR (b.language LIKE '%".$lang."%'))"
		."\n ORDER BY b.dateadded DESC";
		$database->setQuery($query);
		$rows = $database->loadObjectlist();

		$metaKeys = array();
		$metaKeys[] = $this->translatedMonth($this->month).' '.$this->year;

		if ($rows) {
			$c = count($rows);
			$cpa = ceil(20/$c); //keywords per article

			for ($i=0; $i < $c; $i++) {
				$row = $rows[$i];
				$mks = explode(',', $row->tags);
				for($q=0; $q < count($mks); $q++) {
					if ($q >= $cpa) { break; }
					$mk = eUTF::utf8_trim($mks[$q]);
					array_push($metaKeys, eUTF::utf8_trim($mk));
				}

				$database->setQuery("SELECT COUNT(cid) FROM #__comments WHERE origin='0' AND articleid='".$row->id."' AND published='1'");
				$row->numcomments = intval($database->loadResult());
			}
		}
		$metaKeys[] = 'blog';

		if (count($metaKeys) < 16) {
			$metaKeys[] = $this->getCV('ownername');
			$metaKeys[] = $this->getCV('owneruname');
		}

		$dstr = $this->year.'-'.$this->month.'-'.$this->day.' 12:00:00';
		$fdate = mosFormatDate($dstr, "%A %d %B %Y", 0);
		$metaDesc = sprintf($this->lng->METADESCDAY,  $fdate, $this->getCV('title'));
		$mainframe->setPageTitle($fdate.' - '.$this->getCV('title'));
		$mainframe->setMetaTag('description', $metaDesc );
		$mainframe->setMetaTag('keywords', implode(', ', $metaKeys));
		$mainframe->setMetaTag('author', $this->getCV('ownername'));

		eBlogFHTML::showBlog($rows);
	}


	/*****************************/
	/* PREPARE TO LIST ALL BLOGS */
	/*****************************/
	private function listBlogs() {
		global $database, $mainframe;

		$query = "SELECT b.blogid, b.title, b.seotitle, b.ownerid, u.name, u.username"
		."\n FROM #__eblog_settings b"
		."\n LEFT JOIN #__users u ON u.id = b.ownerid"
		."\n WHERE b.published='1' AND u.block='0'"
		."\n ORDER BY b.title ASC";
		$database->setQuery($query);
		$blogs = $database->loadObjectList();
		
		$keys = array();
		if ($blogs) {
			foreach ($blogs as $blog) {
				$database->setQuery("SELECT COUNT(id) FROM #__eblog WHERE blogid='".$blog->blogid."' AND published='1'");
				$blog->posts = intval($database->loadResult());
				$keys = array_merge($keys, explode(' ', $blog->title));
			}
		}

		$metaKeys = array();
		$metaKeys[] = 'blog';
		if (count($keys) > 0) {
			$pat = "([\']|[\!]|[\;]|[\(]|[\)]|[\"]|[\$]|[\#]|[\<]|[\>]|[\*]|[\%]|[\~]|[\`]|[\^]|[\|]|[\{]|[\}]|[\\\])";
			foreach ($keys as $key) {
				$key = eUTF::utf8_strtolower(eUTF::utf8_trim(preg_replace($pat, '', $key))); 
				if ((eUTF::utf8_strlen($key) > 3) && (!in_array($key, $metaKeys))) {
					$metaKeys[] = $key;
				}
			}
		}

		if (count($metaKeys) < 10) {
			$metaKeys[] = $this->lng->COMMENTS;
			$metaKeys[] = $this->lng->TAGS;
			$metaKeys[] = 'elxis blog';
		}

		$title = sprintf($this->lng->USERBLOGSAT, $mainframe->getCfg('sitename'));

		$mainframe->setPageTitle($title);
		$mainframe->setMetaTag('description', $title );
		$mainframe->setMetaTag('keywords', implode(', ', $metaKeys));
		
		eBlogFHTML::listBlogs($blogs);
	}


	/************************************/
	/* IMPORT NEEDED CSS AND JAVASCRIPT */
	/************************************/
	private function importHeadData() {
		global $mainframe;

		$cssfile = (_GEM_RTL) ? $this->getCV('rtlcssfile') : $this->getCV('cssfile');
		$mainframe->addCustomHeadTag('<link href="'.$mainframe->secureURL($this->url).'/css/'.$cssfile.'" rel="stylesheet" type="text/css" media="all" />');

		if (($this->task == 'new') || ($this->task == 'edit')) {
			if ($mainframe->getCfg('sef') != 2) {
				$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.$mainframe->getCfg('ssl_live_site').'/administrator/includes/js/ajax_new.js"></script>');   
			}
			$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.$mainframe->secureURL($this->url).'/js/eblogajax.js"></script>');
		}

		if ($this->getCV('share') == '1') { //e-mailit
			if (in_array($this->task, array('archive', 'dayposts', 'show', 'browse'))) {
				$extra = ($this->getCV('emailit') != '') ? '?id='.$this->getCV('emailit') : '';
				$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.$mainframe->secureURL('http://www.e-mailit.com/bookmark.php').$extra.'" charset="UTF-8"></script>');
			}
		}
	}


	/*****************************/
	/* GET USER LIST MENU ITEMID */
	/*****************************/
	public function uListItemid() {
		global $mainframe, $database, $Itemid, $lang;

        $_Itemid = $Itemid;
        if ($mainframe->getCfg('sef') != '2') {
            $query = "SELECT id FROM #__menu WHERE link='index.php?option=com_user&task=list'"
			."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
            $database->setQuery($query, '#__', 1, 0);
            $_Itemid = intval($database->loadResult());
            if (!$_Itemid) { $_Itemid = $Itemid; }
        }
        return $_Itemid;
    }


	/***************/
	/* ADD COMMENT */
	/***************/
	private function addComment() {
		global $database, $my, $Itemid, $mainframe;

    	if ($mainframe->getCfg('captcha')) {
        	$code = $this->getEncString(trim(mosGetParam($_POST, 'code', '')));
        	if ($code != $_SESSION['captcha']) {
				$mainframe->checkSendHeaders();
				echo "<script type=\"text/javascript\">alert('"._E_INV_SECCODE."'); window.history.go(-1);</script>\n";
				exit();
	   		}
    	}

		$articleid = intval(mosGetParam($_POST, 'articleid', 0));

		$noseflink = 'index.php?option=com_eblog&task=browse&blogid='.$this->getCV('blogid').'&Itemid='.$Itemid;
		$seflink = 'eblog/'.$this->getCV('seotitle').'/';
		$backlink = sefRelToAbs($noseflink, $seflink);

		$query = "SELECT seotitle FROM #__eblog WHERE blogid='".$this->getCV('blogid')."' AND id='".$articleid."' AND published='1'";
		$database->setQuery($query, '#__', 1, 0);
		$article_seotitle = $database->loadResult();
		if (!$article_seotitle || ($article_seotitle == '')) { mosRedirect($backlink, $this->lng->ARTNOFOUND); }

		$noseflink = 'index.php?option=com_eblog&task=show&blogid='.$this->getCV('blogid').'&id='.$articleid.'&Itemid='.$Itemid;
		$seflink = 'eblog/'.$this->getCV('seotitle').'/'.$article_seotitle.'.html';
		$backlink = sefRelToAbs($noseflink, $seflink);

    	if (($this->getCV('allowcomments') == 0) || (($this->getCV('allowcomments') == 1) && (!$my->id))) {
			mosRedirect($backlink, $this->lng->NALLPOSTCOM);
		}

    	$commessage = eUTF::utf8_trim(mosGetParam($_POST, 'commessage', ''));
		$commessage = strip_tags($commessage);
		$pat = "#([\']|[\"]|[\$]|[\#]|[\<]|[\>]|[\*]|[\%]|[\~]|[\`]|[\^]|[\|]|[\\\])#u";
		$commessage = preg_replace($pat, '', $commessage);     
    	if ($commessage == '') { mosRedirect($backlink, $this->lng->MUSTWRITEMSG); }
		//convert URLs to links:
		$commessage = preg_replace("#[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]#","<a href=\"\\0\">\\0</a>", $commessage);

    	$com = new mosComments($database);
    	$com->load('0');
    	$com->origin = '0';
    	$com->articleid = $articleid;
    	$com->cmessage = $commessage; //htmlspecialchars($commessage, ENT_COMPAT, "UTF-8");
		$com->published = '1';
		$com->notify = (intval(mosGetParam($_POST, 'comnotify', 0)) == 1) ? '1' : '0';

		//flood protection
		$timelimit = time() + ($mainframe->getCfg('offset') * 3600) - 30;
		$where = ($my->id) ? " ((userid='".$my->id."') OR (ipaddress='".$com->ipaddress."'))" : " ipaddress='".$com->ipaddress."'";
		$database->setQuery("SELECT COUNT(cid) FROM #__comments WHERE".$where." AND ctimestamp > '".$timelimit."'");
		if (intval($database->loadResult())) { mosRedirect($backlink, $this->lng->WAITRETRY); }

		if ($my->id) {
			$database->setQuery("SELECT name, email FROM #__users WHERE id='".$my->id."'", '#__', 1, 0);
    		$usr = $database->loadRow();
    		$com->author = $usr['name'];
    		$com->email = $usr['email'];
    	} else {
    		$comauthor = eUTF::utf8_trim(mosGetParam( $_REQUEST, 'comauthor', ''));
    		$com->author = htmlspecialchars(strip_tags($comauthor), ENT_COMPAT, "UTF-8");
    		if ($com->author == '') { mosRedirect($backlink, _GEM_REGWARN_NAME); }

    		$comemail = trim(mosGetParam($_POST, 'comemail', ''));
			if ((trim($comemail == '')) || (preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $comemail )==false)) {
				mosRedirect($backlink, _GEM_REGWARN_MAIL);
			}
			$com->email = $comemail;
    	}

		if (!$com->check()) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$com->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}
		$com->store();

		$mainframe->newcommentnotify($com, $backlink);

		mosRedirect($backlink, $this->lng->COMADDSUC);
	}


	/********************************/
	/* STOP RECIEVING NOTIFICATIONS */
	/********************************/
	private function stopnotifications() {
		global $database, $my, $Itemid, $mainframe;

		$articleid = intval(mosGetParam($_POST, 'articleid', 0));

		$noseflink = 'index.php?option=com_eblog&task=browse&blogid='.$this->getCV('blogid').'&Itemid='.$Itemid;
		$seflink = 'eblog/'.$this->getCV('seotitle').'/';
		$backlink = sefRelToAbs($noseflink, $seflink);

		$query = "SELECT seotitle FROM #__eblog WHERE blogid='".$this->getCV('blogid')."' AND id='".$articleid."' AND published='1'";
		$database->setQuery($query, '#__', 1, 0);
		$article_seotitle = $database->loadResult();
		if (!$article_seotitle || ($article_seotitle == '')) { mosRedirect($backlink, $this->lng->ARTNOFOUND); }

		$noseflink = 'index.php?option=com_eblog&task=show&blogid='.$this->getCV('blogid').'&id='.$articleid.'&Itemid='.$Itemid;
		$seflink = 'eblog/'.$this->getCV('seotitle').'/'.$article_seotitle.'.html';
		$backlink = sefRelToAbs($noseflink, $seflink);

    	if (($this->getCV('allowcomments') == 0) || (($this->getCV('allowcomments') == 1) && (!$my->id))) {
			mosRedirect($backlink, $this->lng->NALLPOSTCOM);
		}

		if ($my->id) {
			$database->setQuery("SELECT email FROM #__users WHERE id='".$my->id."'", '#__', 1, 0);
    		$email = $database->loadResult();
			$query = "UPDATE #__comments SET notify=0"
			."\n WHERE origin=0 AND articleid=".$articleid." AND published=1"
			."\n AND notify=1 AND ((userid=".$my->id.") OR (email='".$email."'))";
			$database->setQuery($query);
			$database->query();
    	} else {
    		$email = trim(mosGetParam($_POST, 'notifemail', ''));
			if ((trim($email == '')) || (preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $email)==false)) {
				mosRedirect($backlink, _GEM_REGWARN_MAIL);
			}
			$query = "UPDATE #__comments SET notify=0"
			."\n WHERE origin=0 AND articleid=".$articleid." AND published=1"
			."\n AND notify=1 AND userid=0 AND email='".$email."'";
			$database->setQuery($query);
			$database->query();
    	}
    	
		$msg = defined('_E_EMAILNOTIFSTOP') ? _E_EMAILNOTIFSTOP : 'E-mail notifications stopped for this article';
    	mosRedirect($backlink, $msg);
	}


	/******************/
	/* DELETE COMMENT */
	/******************/
	private function deleteComment() {
		global $database, $my, $Itemid;

		$noseflink = 'index.php?option=com_eblog&task=browse&blogid='.$this->getCV('blogid').'&Itemid='.$Itemid;
		$seflink = 'eblog/'.$this->getCV('seotitle').'/';
		$backlink = sefRelToAbs($noseflink, $seflink);		

		$articleid = intval(mosGetParam($_GET, 'id', 0)); //article id
		if (!$articleid) { mosRedirect($backlink, $this->lng->ARTNOFOUND); }

		$fullAccess = 0;
		if ($my->id && (($my->id == $this->getCV('ownerid')) || ($my->gid == 25))) { $fullAccess = 1; }
		if (!$fullAccess) {	mosRedirect($backlink, $this->lng->NALLPERFACT); }

		$query = "SELECT seotitle FROM #__eblog WHERE blogid='".$this->getCV('blogid')."' AND id='".$articleid."' AND published='1'";
		$database->setQuery($query, '#__', 1, 0);
		$article_seotitle = $database->loadResult();
		if (!$article_seotitle || ($article_seotitle == '')) { mosRedirect($backlink, $this->lng->ARTNOFOUND); }

		$noseflink = 'index.php?option=com_eblog&task=show&blogid='.$this->getCV('blogid').'&id='.$articleid.'&Itemid='.$Itemid;
		$seflink = 'eblog/'.$this->getCV('seotitle').'/'.$article_seotitle.'.html';
		$backlink = sefRelToAbs($noseflink, $seflink);

		$cid = intval(mosGetParam($_GET, 'cid', 0)); //comment id

		$query = "DELETE FROM #__comments WHERE cid = '".$cid."' AND origin = '0' AND articleid = '".$articleid."'";
		$database->setQuery($query);
		$database->query();

		mosRedirect($backlink);
	}


	/**********************************************/
	/* SEARCH TAGS AND PREPARE TO DISPLAY RESULTS */
	/**********************************************/
	private function searchTags() {
		global $database, $Itemid, $lang, $mainframe;

		$tag = eUTF::utf8_strtolower(urldecode(mosGetParam($_REQUEST, 'tag', '')));
		$pat = "([\']|[\!]|[\;]|[\(]|[\)]|[\"]|[\$]|[\#]|[\<]|[\>]|[\*]|[\%]|[\~]|[\`]|[\^]|[\|]|[\{]|[\}]|[\\\])";
		$tag = eUTF::utf8_trim(preg_replace($pat, '', $tag));

		$rows = null;
		if ($tag != '') {
			if (preg_match('/mysql/i', $database->_resource->databaseType)) {
				$where = "AND LOWER(tags) LIKE '%".$tag."%'";
			} else {
				$where = "AND tags LIKE '%".$tag."%'";
			}

			$query = "SELECT id, title, seotitle, dateadded FROM #__eblog"
			."\n WHERE blogid='".$this->getCV('blogid')."' AND published='1' ".$where
			."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
			."\n ORDER BY dateadded DESC";
			$database->setQuery($query, '#__', 50, 0);
			$rows = $database->loadObjectList();
		}

		$metaKeys = array();
		$title = ($tag != '') ? $tag : $this->lng->UNKNOWNTAG;
		$metaKeys[] = $title;
		$metaDesc = sprintf($this->lng->POSTSTAGASAT, $title, $this->getCV('title'));
		$metaDesc .= '. '._WRITTEN_BY.' '.$this->getCV('ownername');
		$title .= ' - '.$this->getCV('title');
		$metaKeys[] = $this->lng->TAGS;
		$metaKeys[] = 'blog';
		$metaKeys[] = $this->getCV('ownername');
		$metaKeys[] = $this->getCV('owneruname');

		$mainframe->setPageTitle($title);
		$mainframe->setMetaTag('description', $metaDesc );
		$mainframe->setMetaTag('keywords', implode(', ', $metaKeys));
		$mainframe->setMetaTag('author', $this->getCV('ownername'));

		eBlogFHTML::tagResults($tag, $rows);
	}


	/*********************************/
	/* PREPARE TO SHOW CONTROL PANEL */
	/*********************************/
	private function controlPanel() {
		global $my, $Itemid, $database, $mainframe;

		$noseflink = 'index.php?option=com_eblog&task=browse&blogid='.$this->getCV('blogid').'&Itemid='.$Itemid;
		$seflink = 'eblog/'.$this->getCV('seotitle').'/';
		$backlink = sefRelToAbs($noseflink, $seflink);		

		if (!$my->id || ($my->id != $this->getCV('ownerid'))) { mosRedirect($backlink, _NOT_AUTH); }

		$showall = intval(mosGetParam($_REQUEST, 'showall', 0));
		$query = "SELECT id, title, seotitle, dateadded, language, hits, published FROM #__eblog"
		."\n WHERE blogid='".$this->getCV('blogid')."'"
		."\n ORDER BY dateadded DESC";
		if ($showall) {
			$database->setQuery($query);
		} else {
			$database->setQuery($query, '#__', 30, 0);
		}
		$rows = $database->loadObjectList();

		$mainframe->setPageTitle($this->lng->CPANEL.' - '.$this->getCV('title'));
		$mainframe->setMetaTag('description', $this->lng->MANBLOG );
		$mainframe->setMetaTag('keywords', 'blog, control panel, manage, posts, elxis blog');
		$mainframe->setMetaTag('author', $this->getCV('ownername'));

		eBlogFHTML::showCPanel($rows, $showall);
	}


	/****************************/
	/* PREPARE TO ADD/EDIT POST */
	/****************************/
	private function editPost() {
		global $database, $my, $Itemid, $mainframe;

		$noseflink = 'index.php?option=com_eblog&task=browse&blogid='.$this->getCV('blogid').'&Itemid='.$Itemid;
		$seflink = 'eblog/'.$this->getCV('seotitle').'/';
		$backlink = sefRelToAbs($noseflink, $seflink);

		$fullAccess = 0;
		if ($my->id && ($my->id == $this->getCV('ownerid'))) { $fullAccess = 1; }
		if (!$fullAccess) {	mosRedirect($backlink, _NOT_AUTH); }

		$id = intval(mosGetParam($_REQUEST, 'id', 0));
		$row = new eBlogdb($database);
		if ($id) {
			$row->load($id);
		}

		$title = ($id) ? $this->lng->EDITPOST : $this->lng->NEWPOST;
		$mainframe->setPageTitle($title);
		$mainframe->setMetaTag('description', $this->lng->MANBLOG );
		$mainframe->setMetaTag('keywords', 'edit post, blog, control panel, manage, posts, elxis blog');
		$mainframe->setMetaTag('author', $this->getCV('ownername'));

		eBlogFHTML::editPost($row);
	}


	/*************/
	/* SAVE POST */
	/*************/
	private function savePost() {
		global $database, $Itemid, $my, $mainframe;

		$noseflink = 'index.php?option=com_eblog&task=browse&blogid='.$this->getCV('blogid').'&Itemid='.$Itemid;
		$seflink = 'eblog/'.$this->getCV('seotitle').'/';
		$backlink = sefRelToAbs($noseflink, $seflink);

		$fullAccess = 0;
		if ($my->id && ($my->id == $this->getCV('ownerid'))) { $fullAccess = 1; }
		if (!$fullAccess) {	mosRedirect($backlink, _NOT_AUTH); }

		if (isset($_POST['alllangs'])) {
			$_POST['language'] = '';
		} else if (isset($_POST['postlang'])) {
			$_POST['language'] = @implode(',', $_POST['postlang']);
		} else {
			$_POST['language'] = '';
		}

		$row = new eBlogdb($database);
		if (!$row->bind($_POST)) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}

		if (trim($row->title) == '') {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('"._E_WARNTITLE."'); window.history.go(-1);</script>\n";
			exit();
		}

		if (trim($row->blogtext) == '') {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('"._E_REQFIELDS_EMPTY.": "._E_INTRO."'); window.history.go(-1);</script>\n";
			exit();
		}
		
		$row->published = ''.intval($row->published).'';

    	require_once($this->path.'/eblogseovs.class.php');
    	$seo = new eblogseovs('post', '', $row->seotitle);
    	$seo->id = intval($row->id);
    	$seoval = $seo->validate();
    	if (!$seoval) {
    		$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$this->lng->SEOTITLE.": ".$seo->message."'); window.history.go(-1);</script>"._LEND;
			exit();
    	}

		$row->tags = eUTF::utf8_strtolower($row->tags);

		$isNew = intval($row->id) ? 0 : 1;
		if ($isNew) {
			$row->hits = '0';
			$at = time() + ($mainframe->getCfg('offset') * 3600);
			$row->dateadded = date('Y-m-d H:i:s', $at);
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

		//fix language
		$database->setQuery("UPDATE #__eblog SET language=NULL WHERE language=''");
		$database->query();

		$noseflink = 'index.php?option=com_eblog&task=cpanel&blogid='.$this->getCV('blogid').'&Itemid='.$Itemid;
		$seflink = 'eblog/'.$this->getCV('seotitle').'/cpanel.html';
		$backlink = sefRelToAbs($noseflink, $seflink);

		mosRedirect($backlink, _E_ITEM_SAVED);
	}


	/***************/
	/* DELETE POST */
	/***************/
	private function deletePost() {
		global $database, $my, $Itemid;

		$noseflink = 'index.php?option=com_eblog&task=browse&blogid='.$this->getCV('blogid').'&Itemid='.$Itemid;
		$seflink = 'eblog/'.$this->getCV('seotitle').'/';
		$backlink = sefRelToAbs($noseflink, $seflink);		

		$articleid = intval(mosGetParam($_GET, 'id', 0));
		if (!$articleid) { mosRedirect($backlink, $this->lng->ARTNOFOUND); }

		$fullAccess = 0;
		if ($my->id && ($my->id == $this->getCV('ownerid'))) { $fullAccess = 1; }
		if (!$fullAccess) {	mosRedirect($backlink, $this->lng->NALLPERFACT); }

		$query = "DELETE FROM #__eblog WHERE id='".$articleid."' AND blogid='".$this->getCV('blogid')."'";
		$database->setQuery($query);
		if ($database->query()) {
			$query = "DELETE FROM #__comments WHERE origin='0' AND articleid='".$articleid."'";
			$database->setQuery($query);
			$database->query();
		}

		/* 
		redirect owner to cpanel 
		if super admin deleted the post (future feature) he will be redirected to the blog start page 
		*/
		if ($my->id == $this->getCV('ownerid')) {
			$noseflink = 'index.php?option=com_eblog&task=cpanel&blogid='.$this->getCV('blogid').'&Itemid='.$Itemid;
			$seflink = 'eblog/'.$this->getCV('seotitle').'/cpanel.html';
			$backlink = sefRelToAbs($noseflink, $seflink);	
		}

		mosRedirect($backlink);
	}


	/*****************************/
	/* VALIDATE SEO TITLE (AJAX) */
	/*****************************/
	private function validateSEO() {
    	$coid = intval(mosGetParam($_POST, 'coid', 0));
    	$seotitle = eUTF::utf8_trim(mosGetParam($_POST, 'seotitle', ''));

    	require_once($this->path.'/eblogseovs.class.php');
    	$seo = new eblogseovs('post', '', $seotitle);
    	$seo->id = $coid;
    	$seo->validate();
    	echo $seo->message;
    	exit();
	}


	/****************************/
	/* SUGGEST SEO TITLE (AJAX) */
	/****************************/
	private function suggestSEO() {
    	$coid = intval(mosGetParam($_POST, 'coid', 0));
    	$cotitle = eUTF::utf8_trim(mosGetParam($_POST, 'cotitle', ''));

    	require_once($this->path.'/eblogseovs.class.php');
    	$seo = new eblogseovs('post', $cotitle);
    	$seo->id = $coid;
    	$sname = $seo->suggest();

    	if (@ob_get_length() > 0) { @ob_end_clean(); }
    	@header('Content-Type: text/plain; Charset: utf-8');
    	if ($sname) {
        	echo '|1|'.$sname;
    	} else {
        	echo '|0|'.$seo->message;
    	}
    	exit();
	}


	/******************************/
	/* PREPARE BLOG CONFIGURATION */
	/******************************/
	private function blogConfig() {
		global $my, $Itemid, $mainframe, $fmanager;

		$noseflink = 'index.php?option=com_eblog&task=browse&blogid='.$this->getCV('blogid').'&Itemid='.$Itemid;
		$seflink = 'eblog/'.$this->getCV('seotitle').'/';
		$backlink = sefRelToAbs($noseflink, $seflink);

		$fullAccess = 0;
		if ($my->id && ($my->id == $this->getCV('ownerid'))) { $fullAccess = 1; }
		if (!$fullAccess) {	mosRedirect($backlink, _NOT_AUTH); }

		$noseflink = 'index.php?option=com_eblog&task=cpanel&blogid='.$this->getCV('blogid').'&Itemid='.$Itemid;
		$seflink = 'eblog/'.$this->getCV('seotitle').'/cpanel.html';
		$backlink = sefRelToAbs($noseflink, $seflink);

		if (!$this->getCV('canconfig')) { mosRedirect($backlink, $this->lng->NALLPERFACT); }

		$lists = array();
		$lists['showtags'] = mosHTML::yesnoRadioList('cfg_showtags', 'class="eblog-inputbox"', $this->getCV('showtags'));

		$cfiles = array();
		$cssfiles = $fmanager->listFiles($this->path.'/css/', '\.css');
		if (count($cssfiles) > 0) {
			foreach ($cssfiles as $cssfile) {
				$cfiles[] = mosHTML::makeOption($cssfile, $cssfile);
			}
		}

		$lists['cssfile'] = mosHTML::selectList($cfiles, 'cfg_cssfile', 'class="eblog-inputbox" size="1" title="CSS" dir="ltr"', 'value', 'text', $this->getCV('cssfile'));
		$lists['rtlcssfile'] = mosHTML::selectList($cfiles, 'cfg_rtlcssfile', 'class="eblog-inputbox" size="1" title="RTL CSS" dir="ltr"', 'value', 'text', $this->getCV('rtlcssfile'));

		$allcoms = array();
		$allcoms[] = mosHTML::makeOption('0', $this->lng->NOTALLOWED);
		$allcoms[] = mosHTML::makeOption('1', $this->lng->REGUSERS);
		$allcoms[] = mosHTML::makeOption('2', $this->lng->ALLOWEDALL);
		$lists['allowcomments'] = mosHTML::selectList($allcoms, 'cfg_allowcomments', 'class="eblog-inputbox" size="1"', 'value', 'text', $this->getCV('allowcomments'));
		unset($allcoms);

		$lists['footerarchive'] = mosHTML::yesnoRadioList('cfg_footerarchive', 'class="eblog-inputbox"', $this->getCV('footerarchive'));
		$lists['showownertop'] = mosHTML::yesnoRadioList('cfg_showownertop', 'class="eblog-inputbox"', $this->getCV('showownertop'));

		$shares = array();
		$shares[] = mosHTML::makeOption('0', _GEM_NO);
		$shares[] = mosHTML::makeOption('1', 'e-mailit');
		$shares[] = mosHTML::makeOption('2', 'AddThis');
		$lists['share'] = mosHTML::selectList($shares, 'cfg_share', 'class="eblog-inputbox" size="1"', 'value', 'text', $this->getCV('share'));
		unset($shares);

		$mainframe->setPageTitle($this->lng->CPANEL.' - '.$this->getCV('title'));
		$mainframe->setMetaTag('description', $this->lng->MANBLOG );
		$mainframe->setMetaTag('keywords', 'config, blog, control panel, manage, posts, elxis blog');
		$mainframe->setMetaTag('author', $this->getCV('ownername'));

		eBlogFHTML::blogConfig($lists);
	}


	/**********************/
	/* SAVE BLOG SETTINGS */
	/**********************/
	private function saveConfig() {
		global $my, $Itemid, $database;

		$noseflink = 'index.php?option=com_eblog&task=browse&blogid='.$this->getCV('blogid').'&Itemid='.$Itemid;
		$seflink = 'eblog/'.$this->getCV('seotitle').'/';
		$backlink = sefRelToAbs($noseflink, $seflink);

		$fullAccess = 0;
		if ($my->id && ($my->id == $this->getCV('ownerid'))) { $fullAccess = 1; }
		if (!$fullAccess) {	mosRedirect($backlink, _NOT_AUTH); }

		$noseflink = 'index.php?option=com_eblog&task=cpanel&blogid='.$this->getCV('blogid').'&Itemid='.$Itemid;
		$seflink = 'eblog/'.$this->getCV('seotitle').'/cpanel.html';
		$backlink = sefRelToAbs($noseflink, $seflink);

		$pat = "([\"]|[\#]|[\<]|[\>]|[\*]|[\~]|[\`]|[\^]|[\|]|[\\\])";

		$cfg = new eBlogSettings($database);
		$cfg->load($this->getCV('blogid'));

		$cfgtitle = mosGetParam($_POST, 'cfg_title', '');
		$cfg->title = eUTF::utf8_trim(preg_replace($pat, '', $cfgtitle));
		if ($cfg->title == '') { mosRedirect($backlink, $this->lng->TITLENOEMPTY); }

		$cfg->showtags = ''.intval(mosGetParam($_POST, 'cfg_showtags', 0)).'';
		$cfg->cssfile = trim(mosGetParam($_POST, 'cfg_cssfile', ''));
		if (($cfg->cssfile == '') || !preg_match('/(\.css)$/i', $cfg->cssfile)) {
			mosRedirect($backlink, 'Invalid CSS file!');
		}
		$cfg->rtlcssfile = trim(mosGetParam($_POST, 'cfg_rtlcssfile', ''));
		if (($cfg->rtlcssfile == '') || !preg_match('/(\.css)$/i', $cfg->rtlcssfile)) {
			mosRedirect($backlink, 'Invalid RTL CSS file!');
		}
		$cfg->slogan = eUTF::utf8_trim(stripslashes($_POST['cfg_slogan']));
		$cfg->allowcomments = ''.intval(mosGetParam($_POST, 'cfg_allowcomments', 0)).'';
		$cfg->numposts = ''.intval(mosGetParam($_POST, 'cfg_numposts', 10)).'';
		$cfg->showownertop = ''.intval(mosGetParam($_POST, 'cfg_showownertop', 1)).'';
		$cfg->footerarchive = ''.intval(mosGetParam($_POST, 'cfg_footerarchive', 1)).'';
		$cfg->share = ''.intval(mosGetParam($_POST, 'cfg_share', 1)).'';

		$cfg_p_emailit = mosGetParam($_POST, 'cfg_params_emailit', '');
		$cfg_p_emailit = trim(preg_replace($pat, '', $cfg_p_emailit));
		$cfg_p_addthis = mosGetParam($_POST, 'cfg_params_addthis', '');
		$cfg_p_addthis = trim(preg_replace($pat, '', $cfg_p_addthis));

		$cfg->params = 'emailit='.$cfg_p_emailit."\n".'addthis='.$cfg_p_addthis;

		$cfg->store();
		mosRedirect($backlink, _E_USRDET_SAVED);
	}


	/************************************/
	/* PERPARE TO LIST USER MEDIA FILES */
	/************************************/
	private function browseMedia() {
		global $mainframe, $my, $fmanager;

		$fullAccess = 0;
		if ($my->id && ($my->id == $this->getCV('ownerid'))) {
			if ($this->getCV('canupload')) { $fullAccess = 1; }
		}

		$mainframe->setPageTitle($this->lng->MEDIAMAN);

		if (!$fullAccess) {
			elxError(_NOT_AUTH);
			return;
		}

		$basedir = $mainframe->getCfg('absolute_path').'/images/userfiles';
		$dirok = 1;
		if (!is_dir($basedir.'/'.$my->id.'/') | !file_exists($basedir.'/'.$my->id.'/')) {
			$dirok = @mkdir($basedir.'/'.$my->id.'/', 0777);
			$fmanager->createFile($basedir.'/'.$my->id.'/index.html');
		}

		if (!$dirok) {
			$msg = sprintf($this->lng->FOLDERCNOTCR, '/images/userfiles/'.$my->id.'/');
			elxError($msg);
			return;
		}
		$images = array();
		$i = 0;
		$totalsize = 0;
		$files = $fmanager->listFiles($basedir.'/'.$my->id.'/');
		if (count($files) > 0) {
			$validExts = array('jpg', 'jpeg', 'gif', 'png');
			clearstatcache();
			foreach ($files as $file) {
				if (!is_dir($file) && ($file != '.') && ($file != '..')) {
					$ext = $fmanager->FileExt($file);
					if (in_array($ext, $validExts)) {
						$images[$i]['file'] = $file;
						$fs = filesize($basedir.'/'.$my->id.'/'.$file);
						$images[$i]['size'] = round($fs/1000, 2);
						$s = getimagesize($basedir.'/'.$my->id.'/'.$file);
						$images[$i]['dim'] = $s[0].' x '.$s[1];
						$totalsize += $fs;
						$i++;
					}
				}
			}
		}
		$totalsize = round($totalsize/1000, 2);
		$t = intval(mosGetParam($_REQUEST, 't', 0)); //thumbnails or list
		eBlogFHTML::browseMedia($images, $t, $totalsize);
	}


	/**************************/
	/* DELETE USER MEDIA FILE */
	/**************************/
	private function deleteMedia() {
		global $mainframe, $my, $fmanager, $Itemid;

		$fullAccess = 0;
		if ($my->id && ($my->id == $this->getCV('ownerid'))) {
			$fullAccess = ($this->getCV('canupload')) ? 1 : 0;
		}

		if (!$fullAccess) {
			elxError(_NOT_AUTH);
			return;
		}

		$f = base64_decode(trim(mosGetParam($_GET, 'f', '')));
		$f = str_replace('..', '', $f);
		$f = str_replace('/', '', $f);

		$basedir = $mainframe->getCfg('absolute_path').'/images/userfiles';
		$validExts = array('jpg', 'jpeg', 'gif', 'png');
		if (($f != '') && file_exists($basedir.'/'.$my->id.'/'.$f)) {
			$ext = $fmanager->FileExt($f);
			if (in_array($ext, $validExts)) {
				$fmanager->deleteFile($basedir.'/'.$my->id.'/'.$f);
			}
		}
	
		$backLink = $mainframe->getCfg('live_site').'/index2.php?option=com_eblog&task=media&blogid='.$this->getCV('blogid').'&Itemid='.$Itemid;
		mosRedirect($backLink);
	}


	/*********************/
	/* UPLOAD MEDIA FILE */
	/*********************/
	private function uploadMedia() {
		global $mainframe, $my, $fmanager, $Itemid;

		$fullAccess = 0;
		if ($my->id && ($my->id == $this->getCV('ownerid'))) {
			$fullAccess = ($this->getCV('canupload')) ? 1 : 0;
		}

		if (!$fullAccess) {
			elxError(_NOT_AUTH);
			return;
		}

		$totalsize = 0;
		$mydir = $mainframe->getCfg('absolute_path').'/images/userfiles/'.$my->id.'/';
		$files = $fmanager->listFiles($mydir);
		if (count($files) > 0) {
			clearstatcache();
			foreach ($files as $file) {
				if (!is_dir($file) && ($file != '.') && ($file != '..')) {
					$fs = filesize($mydir.$file);
					$totalsize += $fs;
				}
			}
		}

		$available = ($this->getCV('mediasize') * 1024) - $totalsize;
    	$validFileTypes = array('gif', 'jpg', 'jpeg', 'png');
    	$upfile = $_FILES['upfile'];

        if (($upfile['name'] != '') && ($upfile['size'] <= $available)) {
			$source = $upfile['tmp_name'];
			if (in_array($fmanager->fileExt($upfile['name']), $validFileTypes)) {
				$destfile = eUTF::utf8_strtolower(eUTF::utf8_str_replace(' ', '_', $upfile['name']));
				$fmanager->upload($source, $mydir.$destfile);
			}
		}

		$t = intval(mosGetParam($_POST, 't', 0));
		$backLink = $mainframe->getCfg('live_site').'/index2.php?option=com_eblog&task=media&blogid='.$this->getCV('blogid').'&Itemid='.$Itemid.'&t='.$t;
		mosRedirect($backLink);
	}


	/**********************/
	/* GET ARCHIVE MONTHS */
	/**********************/
	public function archiveMonths() {
		global $database, $lang;

		$query = "SELECT dateadded FROM #__eblog"
		."\n WHERE blogid='".$this->getCV('blogid')."' AND published='1' AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
		."\n  ORDER BY dateadded DESC";
		$database->setQuery($query);
		$postdates = $database->loadResultArray();

		$months = array();
		if ($postdates) {
			for ($i=0; $i<count($postdates); $i++) {
				$postdate = $postdates[$i];
				$sp = preg_split('/\-/', $postdate);
				$k = $sp[0].$sp[1];
				if (!isset($months[$k])) {
					$months[$k]['year'] = $sp[0];
					$months[$k]['month'] = $sp[1];
				}
			}
		}
		return $months;
	}


	/****************************/
	/* TRANSALE A LANGUAGE NAME */
	/****************************/
	public function translatedLang($tlang) {
		$tlangx = strtoupper($tlang);
		if (isset($this->lng->$tlangx)) { return $this->lng->$tlangx; }
		return $tlang;
	}


	/********************************/
	/* RETURN TRANSLATED MONTH NAME */
	/********************************/
	public function translatedMonth($m) {
		switch (intval($m)) {
			case 1: return _JAN; break;
			case 2: return _FEB; break;	
			case 3: return _MAR; break;	
			case 4: return _APR; break;	
			case 5: return _MAY; break;	
			case 6: return _JUN; break;	
			case 7: return _JUL; break;	
			case 8: return _AUG; break;	
			case 9: return _SEP; break;	
			case 10: return _OCT; break;	
			case 11: return _NOV; break;	
			case 12: return _DEC; break;
			default: return ''; break;	
		}
	}


	/************************************/
	/* GET ENCRYPTED STRING FOR CAPTCHA */
	/************************************/
	private function getEncString($string='') {
		global $mainframe;

		$enc = $string.date('Ymd').$mainframe->getCfg('secret');
    	if (isset($_SERVER['HTTP_USER_AGENT'])) { $enc .= $_SERVER['HTTP_USER_AGENT']; }
    	if (isset($_SERVER['REMOTE_ADDR'])) { $enc .= $_SERVER['REMOTE_ADDR']; }
    	return md5($enc);
	}

}


$eblog = new eBlogFront();
$eblog->run();
unset($eblog);

?>