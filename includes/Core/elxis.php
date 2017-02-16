<?php 
/**
* @version: $Id: elxis.php 55 2010-06-13 08:57:20Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Core
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Elxis Core
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


define( '_MOS_ELXIS_INCLUDED', 1 );

//@set_magic_quotes_runtime( 0 ); //deprecated in php 5.3

if (@$mosConfig_error_reporting === 0) {
	error_reporting( 0 );
} else if (@$mosConfig_error_reporting > 0) {
	error_reporting( $mosConfig_error_reporting );
}

$local_backup_path = $mosConfig_absolute_path.'/administrator/backups';
$media_path = $mosConfig_absolute_path.'/media/';
$image_path = $mosConfig_absolute_path.'/images/stories';
$image_size = 100;

require_once( $mosConfig_absolute_path.'/includes/version.php' );
require_once( $mosConfig_absolute_path.'/includes/Core/database.php' );
require_once( $mosConfig_absolute_path.'/includes/Core/gacl.class.php' );
require_once( $mosConfig_absolute_path.'/includes/Core/gacl_api.class.php' );
require_once( $mosConfig_absolute_path.'/includes/phpmailer/class.phpmailer.php' );
require_once( $mosConfig_absolute_path.'/includes/Core/elxisxml.php' );
require_once( $mosConfig_absolute_path.'/includes/phpInputFilter/class.inputfilter.php' );

/**
 * Task routing class
 * @package Elxis
 * @abstract
 */
class mosAbstractTasker {
	/** @var array An array of the class methods to call for a task */
	public $taskMap = null;
	/** @var string The name of the default task */
	public $defaultTask = null;
	/** @var string The name of the current task*/
	public $task = null;
	/** @var array An array of the class methods*/
	public $_methods = null;
	/** @var string A url to redirect to */
	public $_redirect = null;
	/** @var string A message about the operation of the task */
	public $_message = null;

	/**
	 * Constructor
	 */
	function mosAbstractTasker() {
		$taskMap = array();
		$this->_methods = array();
		foreach (get_class_methods( get_class( $this ) ) as $method) {
			$this->_methods[] = strtolower( $method );
		}
		$this->_redirect = '';
		$this->_message = '';
	}
	/**
	 * Set a URL to redirect the browser to
	 * @param string A URL
	 */
	function setRedirect( $url, $msg = null ) {
		$this->_redirect = $url;
		if ($msg !== null) {
			$this->_message = $msg;
		}
	}
	/**
	 * Redirects the browser
	 */
	function redirect() {
		if ($this->_redirect) {
			mosRedirect( $this->_redirect, $this->_message );
		}
	}
	/**
	 * Register (map) a task to a method in the class
	 * @param string The task
	 * @param string The name of the method in the derived class to perform for this task
	 */
	function registerTask( $task, $method ) {
		if (in_array( strtolower( $method ), $this->_methods )) {
			$this->taskMap[$task] = $method;
		} else {
			$this->methodNotFound( $method );
		}
	}
	/**
	 * Register the default task to perfrom if a mapping is not found
	 * @param string The name of the method in the derived class to perform if the task is not found
	 */
	function registerDefaultTask( $method ) {
		$this->registerTask( '__default', $method );
	}
	/**
	 * Perform a task by triggering a method in the derived class
	 * @param string The task to perform
	 * @return mixed The value returned by the function
	 */
	function performTask( $task ) {
		$this->task = $task;

		if (isset( $this->taskMap[$task] )) {
			return call_user_func( array( &$this, $this->taskMap[$task] ) );
		} else if (isset( $this->taskMap['__default'] )) {
			return call_user_func( array( &$this, $this->taskMap['__default'] ) );
		} else {
			return $this->taskNotFound( $task );
		}
	}
	/**
	 * Get the last task that was to be performed
	 * @return string The task that was or is being performed
	 */
	function getTask() {
		return $this->task;
	}
	/**
	 * Basic method if the task is not found
	 * @param string The task
	 * @return null
	 */
	function taskNotFound( $task ) {
		echo 'Task ' . $task . ' not found';
		return null;
	}
	/**
	 * Basic method if the registered method is not found
	 * @param string The name of the method in the derived class
	 * @return null
	 */
	function methodNotFound( $name ) {
		echo 'Method ' . $name . ' not found';
		return null;
	}
}



class mosCache {

	/* GET OBJECT CACHE */
	static public function &getCache(  $group=''  ) {
		global $mosConfig_absolute_path, $mosConfig_caching, $mosConfig_cachepath, $mosConfig_cachetime, $lang;

		require_once( $mosConfig_absolute_path.'/includes/Cache/Lite/Function.php' );

		$options = array(
		'cacheDir' => $mosConfig_cachepath.'/',
		'caching' => $mosConfig_caching,
		'defaultGroup' => $group,
		'lifeTime' => $mosConfig_cachetime,
		'cacheLang' => $lang
		);
		$cache = new Cache_Lite_Function( $options );
		return $cache;
	}

	/* CLEAN CACHE */
	static public function cleanCache( $group=false ) {
		global $mosConfig_caching;
		if ($mosConfig_caching) {
			$cache = mosCache::getCache( $group );
			$cache->clean( $group );
		}
	}
}


/*
* Elxis Mainframe class
* Provides many supporting API functions
*/
class mosMainFrame {

	/** @public database Internal database class pointer */
	public $_db=null;
	/** @public object An object of configuration variables */
	public $_config=null;
	/** @public object An object of path variables */
	public $_path=null;
	/** @public mosSession The current session */
	public $_session=null;
	/** @public string The current template */
	public $_template=null;
	/** @private string The current template parameters (2009.1) */
	private $_template_params = null;
	/** @public string The current administration login screen */
	public $_loginscreen=null;
	/** @private string The current login screen parameters (2009.1) */
	private $_loginscreen_params = null;
	/** @public array An array to hold global user state within a session */
	public $_userstate=null;
	/** @public array An array of page meta information */
	public $_head=null;
	/** @public string Custom html string to append to the pathway */
	public $_custom_pathway=null;
	/** @private array An array of javascript to append to the body onLoad attribute */
	private $_bodyonload=array();
	private $SSL = false;


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct( &$db, $option, $basePath, $isAdmin=false ) {
		$this->_db =& $db;
		$this->SSL = $this->detectSSL();
		$this->_setConfig( $basePath );
		$this->_setTemplate( $isAdmin );
		$this->_setAdminPaths( $option, $this->getCfg( 'absolute_path' ) );
		if (isset( $_SESSION['session_userstate'] )) {
			$this->_userstate =& $_SESSION['session_userstate'];
		} else {
			$this->_userstate = null;
		}
		$this->_head = array();
		$this->_head['title'] = $GLOBALS['mosConfig_sitename'];
		$this->_head['meta'] = array();
		$this->_head['custom'] = array();
	}


	/******************/
	/* SET PAGE TITLE */
	/******************/
	public function setPageTitle( $title=null ) {
		$title = eUTF::utf8_trim(htmlspecialchars($title));
		$this->_head['title'] = ($title != '') ? $title : $this->getCfg('sitename');
	}


	/****************/
	/* ADD META TAG */
	/****************/
	public function addMetaTag( $name, $content, $prepend='', $append='' ) {
	    $name = eUTF::utf8_trim( htmlspecialchars( $name ) );
	    $content = eUTF::utf8_trim( htmlspecialchars( $content ) );
	    $prepend = eUTF::utf8_trim( $prepend );
	    $append = eUTF::utf8_trim( $append );
		$this->_head['meta'][] = array( $name, $content, $prepend, $append );
	}


	/*******************/
	/* APPEND META TAG */
	/*******************/
	public function appendMetaTag( $name, $content ) {
		$name = eUTF::utf8_trim( htmlspecialchars( $name ) );
		$n = count( $this->_head['meta'] );
		for ($i = 0; $i < $n; $i++) {
			if ($this->_head['meta'][$i][0] == $name) {
				$content = eUTF::utf8_trim( htmlspecialchars( $content ) );
				if ( $content ) {
					if ( !$this->_head['meta'][$i][1] ) {
						$this->_head['meta'][$i][1] = $content;
					} else {
						$this->_head['meta'][$i][1] = $content .', '. $this->_head['meta'][$i][1];
					}
				}
				return;
			}
		}
		$this->addMetaTag($name , $content);
    }


    /****************************/
    /* SET / OVERWRITE META TAG */
    /****************************/
	public function setMetaTag( $name, $content ) {
		$name = eUTF::utf8_trim( htmlspecialchars( $name ) );
		$n = count( $this->_head['meta'] );
		for ($i = 0; $i < $n; $i++) {
			if ($this->_head['meta'][$i][0] == $name) {
				$content = eUTF::utf8_trim( htmlspecialchars( $content ) );
				if ( $content ) {
					if ( !$this->_head['meta'][$i][1] ) {
						$this->_head['meta'][$i][1] = $content;
					}
				}
				return;
			}
		}
		$this->addMetaTag( $name , $content );
    }


	/********************/
	/* PREPEND META TAG */
	/********************/
	public function prependMetaTag( $name, $content ) {
	    $name = eUTF::utf8_trim( htmlspecialchars( $name ) );
	    $n = count( $this->_head['meta'] );
	    for ($i = 0; $i < $n; $i++) {
	        if ($this->_head['meta'][$i][0] == $name) {
			    $content = eUTF::utf8_trim( htmlspecialchars( $content ) );
				$this->_head['meta'][$i][1] = $content . $this->_head['meta'][$i][1];
				return;
			}
		}
		$this->addMetaTag( $name, $content );
	}


	/*************************************/
	/* ADD CUSTOM HTML TO THE HEAD BLOCK */
	/*************************************/
	public function addCustomHeadTag($html) {
		$this->_head['custom'][] = trim( $html );
	}


	/***************************************/
	/* ADD JS TO THE BODY ONLOAD ATTRIBUTE */
	/***************************************/
	public function addonLoad($js) {
		$this->_bodyonload[] = trim($js);
	}


	/*******************/
	/* GET BODY ONLOAD */
	/*******************/
	public function onLoad() {
		if (!$this->_bodyonload) { return ''; }
		$arr = array();
	    foreach ($this->_bodyonload as $js) {
	    	if (!preg_match('/(\;)$/', $js)) { $js .= ';'; }
	    	array_push($arr, $js);
		}
		return ' onload="'.implode(' ', $arr).'"';
	}


	/***************************************/
	/* CHECK IF PAGE WAS REQUESTED VIA SSL */
	/***************************************/
	public function detectSSL() {
		if (isset($_SERVER['HTTPS'])) {
			if (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == 1)) { return true; }
		}
		if (isset($_SERVER['SERVER_PORT']) && ($_SERVER['SERVER_PORT'] == 443)) { return true; }
		return false;
	}


	/********************************/
	/* GET THE SSL VERSION OF A URL */
	/********************************/
	public function secureURL($url='', $force=false) {
		if (!preg_match('@^(http\:)@i', $url)) { return $url; }
		if (!$this->SSL && !$force) { return $url; }
		return preg_replace('@^(http\:)@i', 'https:', $url);
	}


	/************/
	/* GET HEAD */
	/************/
	public function getHead($beforeCustom=array()) {
	    $head = array();
	    $head[] = '<title>'.$this->_head['title'].'</title>';
	    foreach ($this->_head['meta'] as $meta) {
	        if ($meta[2]) {
	            $head[] = $meta[2];
			}
	        $head[] = '<meta name="'.$meta[0].'" content="'.$meta[1].'" />';
	        if ($meta[3]) {
	            $head[] = $meta[3];
			}
		}
		if (is_array($beforeCustom) && (count($beforeCustom) > 0)) {
			foreach ($beforeCustom as $bc) {
				$head[] = $bc;
			}
		}
	    foreach ($this->_head['custom'] as $html) {
	        $head[] = $html;
		}
		return implode( _LEND, $head )._LEND;
	}


	/******************/
	/* GET PAGE TITLE */
	/******************/
	public function getPageTitle() {
	    return $this->_head['title'];
	}


	public function getCustomPathWay() {
	    return $this->_custom_pathway;
	}


	public function appendPathWay( $html ) {
		$this->_custom_pathway[] = $html;
	}


	/***********************************/
	/* GET USER STATE VARIABLE'S VALUE */
	/***********************************/
	public function getUserState( $var_name ) {
		if (is_array( $this->_userstate )) {
			return mosGetParam( $this->_userstate, $var_name, null );
		} else {
			return null;
		}
	}


	/**
	* Gets the value of a user state variable
	* @param string The name of the user state variable
	* @param string The name of the variable passed in a request
	* @param string The default value for the variable if not found
	*/
	public function getUserStateFromRequest( $var_name, $req_name, $var_default=null ) {
		if (is_array( $this->_userstate )) {
			if (isset( $_REQUEST[$req_name] )) {
				$this->setUserState( $var_name, $_REQUEST[$req_name] );
			} else if (!isset( $this->_userstate[$var_name] )) {
				$this->setUserState( $var_name, $var_default );
			}
			return $this->_userstate[$var_name];
		} else {
			return null;
		}
	}

	/**
	* Sets the value of a user state variable
	* @param string The name of the variable
	* @param string The value of the variable
	*/
	public function setUserState( $var_name, $var_value ) {
		if (is_array( $this->_userstate )) {
			$this->_userstate[$var_name] = $var_value;
		}
	}
	

	/***************************/
	/* INITIALISE USER SESSION */
	/***************************/
	public function initSession() {
		global $mosConfig_offset;

		$session =& $this->_session;
		$session = new mosSession( $this->_db );
		$session->purge(intval( $this->getCfg( 'lifetime' ) ));
		$sessionCookieName = md5( 'site'.$GLOBALS['mosConfig_live_site'] );
		$sessioncookie = mosGetParam( $_COOKIE, $sessionCookieName, null );
		$usercookie = mosGetParam( $_COOKIE, 'usercookie', null );

		$curtime = time() + ($mosConfig_offset * 3600);
		if ($session->load( md5( $sessioncookie.$_SERVER['REMOTE_ADDR'] ))) {
			$session->time = $curtime;
			$session->update();
		} else {
			$session->generateId();
			$session->guest = 1;
			$session->username = '';
			$session->time = $curtime;
			$session->gid = 29;
			$session->allowed = 29;
			$session->getIP();

			if (!$session->insert()) {
				die( $session->getError() );
			}

			setcookie( $sessionCookieName, $session->getCookie(), $curtime + 43200, '/' );

			if ($usercookie) {
				//Remember me cookie exists. Login with usercookie info.
				$this->login($usercookie['username'], $usercookie['password']);
			}
		}
	}

	/*
	get backend groups
	returns an array of backend groups
	*/
	public function backGroups() {
		global $acl;
		$backgroups = array();
		//$allbgroups = $acl->get_group_parents( '25', 'ARO', 'RECURSE_INCL' );
		$allbgroups = $acl->get_group_children( '30', 'ARO', 'RECURSE' );
		foreach ($allbgroups as $allbgroup => $v) {
			if ($v == 17 || $v== 28 || $v==30) {
				continue;
			} else {
				array_push($backgroups, $v);
			}
		}
	return $backgroups;
	}

	/*
	get frontend groups
	returns an array of frontend groups
	*/
	public function frontGroups() {
		global $acl;
		$frontgroups = array();
		$fgroups = $acl->get_group_children('29', 'ARO', 'RECURSE' );
		array_push($fgroups, '29');
		foreach ($fgroups as $fgroup => $v) {
			if ($v == 17 || $v== 28) {
				continue;
			} else {
				array_push($frontgroups, $v);
			}
		}
	return $frontgroups;
	}


	/*********************************/
	/* GET ALLOWED GROUPS FOR A USER */
	/*********************************/
	public function allowedGroups($groupid=29) {
		global $acl;

		$allowedgroups = array();
		$backgroups = $this->backGroups();
		/** if user belongs to a backend group he can access all items for frontend groups **/
		if (in_array($groupid, $backgroups)) {
			$allowedgroups = $this->frontGroups();
			if ($groupid == 25) {
				$mygroups = $backgroups;
				array_push($mygroups, '30');
			} else if ($groupid == 24) {
				$mygroups = array();
				foreach ($backgroups as $backgroup) {
					if ($backgroup != '25') { $mygroups[] = $backgroup; }
				}
				array_push($mygroups, '30');
			} else {
				$mygroups = $acl->get_group_parents( $groupid, 'ARO', 'RECURSE_INCL' );
			}
		} else {
			$mygroups = $acl->get_group_parents( $groupid, 'ARO', 'RECURSE_INCL' );
		}

		if (isset($mygroups)) {
			foreach ($mygroups as $mygroup => $v) {
				if ($v == 17 || $v== 28) {
					continue;
				} else {
					array_push($allowedgroups, $v);
				}
			}
		}

		if ($groupid != 29) {
			$parentgroup = $acl->get_group_parent_id($groupid);
			if (!in_array($parentgroup, $allowedgroups)) { array_push($allowedgroups, $parentgroup); }
		}
		return $allowedgroups;
	}


	/****************************/
	/* SEND HEADERS IF NOT SENT */
	/****************************/
	public function checkSendHeaders() {
		if (!headers_sent()) {
    		header( 'Content-type: text/html; charset=utf-8' );
    		header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
    		header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
    		header( 'Cache-Control: no-store, no-cache, must-revalidate' );
    		header( 'Cache-Control: post-check=0, pre-check=0', false );
    		header( 'Pragma: no-cache' );			
		}
	}


	/********************/
	/* LOGIN VALIDATION */
	/********************/
	public function login($username=null,$passwd=null) {
		global $acl;

		$usercookie = mosGetParam( $_COOKIE, 'usercookie', '' );
		$sessioncookie = mosGetParam( $_COOKIE, 'sessioncookie', '' );
		if (!$username || !$passwd) {
			$username = eUTF::utf8_trim( mosGetParam( $_POST, 'username', '' ) );
			$passwd = eUTF::utf8_trim( mosGetParam( $_POST, 'passwd', '' ) );
			$passwd = md5( $passwd );
			$bypost = 1;
		}
		$remember = trim( mosGetParam( $_POST, 'remember', '' ) );

		if (!$username || !$passwd) {
			$this->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert(\""._LOGIN_INCOMPLETE."\"); window.history.go(-1);</script>"._LEND;
			exit();
		} else {
		    $username = $this->_db->getEscaped($username);
			$this->_db->setQuery( "SELECT id, gid, block, usertype, expires FROM #__users WHERE username='$username' AND password='$passwd'");
			$row = null;
			if ($this->_db->loadObject($row)) {
				if ($row->block == 1) {
					$this->checkSendHeaders();
					echo "<script type=\"text/javascript\">alert(\""._LOGIN_BLOCKED."\"); window.history.go(-1);</script>"._LEND;
					exit();
				}

				//account expiration control
				if (trim($row->expires) <= date('Y-m-d H:i:s')) {
					$this->_db->setQuery("UPDATE #__users SET block='1' WHERE id='".$row->id."'");
					$this->_db->query();
					$this->checkSendHeaders();
					echo "<script type=\"text/javascript\">alert(\""._E_ACCOUNT_EXPIRED."\"); window.history.go(-1);</script>"._LEND;
					exit();
				}

				//fudge the group stuff
				$grp = $acl->getAroGroup( $row->id );
				$row->usertype = $grp->name;

				$session =& $this->_session;
				$session->username = $username;
				$session->guest = 0;
				$session->userid = intval( $row->id );
				$session->usertype = $row->usertype;
				$session->gid = intval( $row->gid );
				$session->allowed = implode(',', $this->allowedGroups($session->gid));
				//$session->getIP(); //we already know the ip
				$session->update();

				$currentDate = date("Y-m-d H:i:s");
				$query = "UPDATE #__users SET lastvisitdate='".$currentDate."' WHERE id='".$session->userid."'";
				$this->_db->setQuery($query);
				if (!$this->_db->query()) {
					die($this->_db->stderr(true));
				}

				if ($remember=="yes") {
					$lifetime = time() + 365*24*3600;
					setcookie( "usercookie[username]", $username, $lifetime, "/" );
					setcookie( "usercookie[password]", $passwd, $lifetime, "/" );
				}
				mosCache::cleanCache();
			} else {
				if (isset($bypost)) {
					$this->checkSendHeaders();
					echo "<script type=\"text/javascript\">alert(\""._LOGIN_INCORRECT."\"); window.history.go(-1);</script>"._LEND;
				} else {
					$this->logout();
					mosRedirect("index.php");
				}
				exit();
			}
		}
	}


	/**********************************/
	/* LOGOUT USER (set to anonymous) */
	/**********************************/
	public function logout() {
		global $mosConfig_offset, $mosConfig_lifetime;

		mosCache::cleanCache();
		$session = &$this->_session;

		$session->username = '';
		$session->guest = 1;
		$session->userid = '';
		$session->usertype = '';
		$session->gid = 29;
		$session->allowed = 29;
		$session->update();

		$lifetime = time() + ($mosConfig_offset * 3600) - $mosConfig_lifetime;
		setcookie( "usercookie[username]", " ", $lifetime, "/" );
		setcookie( "usercookie[password]", " ", $lifetime, "/" );
		setcookie( "usercookie", " ", $lifetime, "/" );
		@session_destroy();
	}


	/**********************************************/
	/* CURRENT USER OBJECT WITH INFO FROM SESSION */
	/**********************************************/
	public function getUser() {
		$user = new mosUser( $this->_db );
		$user->id = intval( $this->_session->userid );
		$user->username = $this->_session->username;
		$user->usertype = $this->_session->usertype;
		$user->gid = intval( $this->_session->gid );
		$user->allowed = $this->_session->allowed;
		return $user;
	}

	/**
	* Loads the configuration.php file and assigns values to the internal variable
	* @param string The base path from which to load the configuration file
	*/
	public function _setConfig( $basePath='.' ) {
		$this->_config = new stdClass();

		require($basePath.'/configuration.php');

		$this->_config->offline 			= $mosConfig_offline;
		$this->_config->host 				= $mosConfig_host;
		$this->_config->user 				= $mosConfig_user;
		$this->_config->password 			= $mosConfig_password;
		$this->_config->db 					= $mosConfig_db;
		$this->_config->dbprefix 			= $mosConfig_dbprefix;
		$this->_config->dbtype 				= $mosConfig_dbtype;
		$this->_config->lang 				= $mosConfig_lang;
		$this->_config->pub_langs 			= $mosConfig_pub_langs;
		$this->_config->alang 				= $mosConfig_alang;
		$this->_config->absolute_path 		= $mosConfig_absolute_path;
		$this->_config->live_site 			= $mosConfig_live_site;
		$this->_config->ssl_live_site 		= $this->secureURL($mosConfig_live_site);
		$this->_config->sitename 			= $mosConfig_sitename;
		$this->_config->shownoauth 			= $mosConfig_shownoauth;
		$this->_config->useractivation 		= $mosConfig_useractivation;
		$this->_config->uniquemail 			= $mosConfig_uniquemail;
		$this->_config->offline_message 	= $mosConfig_offline_message;
		$this->_config->error_message 		= $mosConfig_error_message;
		$this->_config->lifetime 			= $mosConfig_lifetime;
		$this->_config->MetaDesc 			= $mosConfig_MetaDesc;
		$this->_config->MetaKeys 			= $mosConfig_MetaKeys;
		$this->_config->debug 				= $mosConfig_debug;
		$this->_config->vote 				= $mosConfig_vote;
		$this->_config->hideAuthor 			= $mosConfig_hideAuthor;
		$this->_config->hideCreateDate 		= $mosConfig_hideCreateDate;
		$this->_config->hideModifyDate 		= $mosConfig_hideModifyDate;
		$this->_config->hideRtf 			= $mosConfig_hideRtf;
		$this->_config->hidePdf 			= $mosConfig_hidePdf;
		$this->_config->hidePrint 			= $mosConfig_hidePrint;
		$this->_config->hideEmail 			= $mosConfig_hideEmail;
		$this->_config->enable_log_items 	= $mosConfig_enable_log_items;
		$this->_config->enable_log_searches = $mosConfig_enable_log_searches;
		$this->_config->enable_stats 		= $mosConfig_enable_stats;
		$this->_config->sef 				= $mosConfig_sef;
		$this->_config->vote 				= $mosConfig_vote;
		$this->_config->hideModifyDate 		= $mosConfig_hideModifyDate;
		$this->_config->multipage_toc 		= $mosConfig_multipage_toc;
		$this->_config->allowUserRegistration 	= $mosConfig_allowUserRegistration;
		$this->_config->error_reporting 		= $mosConfig_error_reporting;
		$this->_config->link_titles 		= $mosConfig_link_titles;
		$this->_config->list_limit 			= $mosConfig_list_limit;
		$this->_config->caching 			= $mosConfig_caching;
		$this->_config->cachepath 			= $mosConfig_cachepath;
		$this->_config->cachetime 			= $mosConfig_cachetime;
		$this->_config->mailer 				= $mosConfig_mailer;
		$this->_config->mailfrom 			= $mosConfig_mailfrom;
		$this->_config->fromname 			= $mosConfig_fromname;
		$this->_config->smtpauth 			= $mosConfig_smtpauth;
		$this->_config->smtpuser 			= $mosConfig_smtpuser;
		$this->_config->smtppass 			= $mosConfig_smtppass;
		$this->_config->smtphost 			= $mosConfig_smtphost;
		$this->_config->back_button 		= $mosConfig_back_button;
		$this->_config->item_navigation 	= $mosConfig_item_navigation;
		$this->_config->secret 				= $mosConfig_secret;
		$this->_config->readmore 			= $mosConfig_readmore;
		$this->_config->hits 				= $mosConfig_hits;
		$this->_config->comments 			= $mosConfig_comments;
		$this->_config->icons 				= $mosConfig_icons;
		$this->_config->ftp 				= $mosConfig_ftp;
		$this->_config->ftp_host 			= $mosConfig_ftp_host;
		$this->_config->ftp_user 			= $mosConfig_ftp_user;
		$this->_config->ftp_pass 			= $mosConfig_ftp_pass;
		$this->_config->ftp_port 			= $mosConfig_ftp_port;
		$this->_config->ftp_root 			= $mosConfig_ftp_root;
		$this->_config->access     			= $mosConfig_access;
        $this->_config->captcha     		= $mosConfig_captcha;
        $this->_config->offset				= $mosConfig_offset;
        $this->_config->favicon				= $mosConfig_favicon;
        $this->_config->static_cache		= $mosConfig_static_cache;

		if (@$mosConfig_error_reporting === 0) {
			error_reporting( 0 );
		} else if (@$mosConfig_error_reporting > 0) {
			error_reporting( $mosConfig_error_reporting );
		}
	}


	/**********************************************/
	/* RETURN GLOBAL CONFIGURATION VARIABLE VALUE */
	/**********************************************/
	public function getCfg($varname) {
		return (isset($this->_config->$varname)) ? $this->_config->$varname : null;
	}


	/****************/
	/* SET TEMPLATE */
	/****************/
	public function _setTemplate($isAdmin=false) {
		global $Itemid;

		if ($isAdmin) {
			$this->_db->setQuery("SELECT template, params FROM #__templates_menu WHERE client_id='1' AND menuid='0'", '#__', 1, 0);
			$tplrow = $this->_db->loadRow();
			$this->_template = $tplrow['template'];
			$this->_template_params = $tplrow['params'];
			if (!file_exists($this->getCfg('absolute_path').'/administrator/templates/admin/'.$this->_template.'/index.php')) {
				$this->_template = 'magnet';
				$this->_template_params = null;
			}
			unset($tplrow);
			$this->_db->setQuery("SELECT template, params FROM #__templates_menu WHERE client_id='2' AND menuid='0'", '#__', 1, 0);
			$tplrow = $this->_db->loadRow();
			$cur_loginscreen = $tplrow['template'];
			$cur_logparams = $tplrow['params'];
			if (!file_exists($this->getCfg('absolute_path').'/administrator/templates/login/'.$cur_loginscreen.'/index.php')) {
				$cur_loginscreen = 'olympus';
				$cur_logparams = null;
			}
			$this->_loginscreen = $cur_loginscreen;
			$this->_loginscreen_params = $cur_logparams;
		} else {
			$usertpl = 0;
			$cur_template = '';
			$mos_user_template = mosGetParam($_COOKIE, 'mos_user_template', '');
			$mos_change_template = mosGetParam($_REQUEST, 'mos_change_template', $mos_user_template);
			if (($mos_change_template != '') AND (strpos($mos_change_template,'..') == false) AND (strpos($mos_change_template,':') == false)) {
				$curtime = time() + ($this->getCfg('offset') * 3600);
				if (file_exists($this->getCfg('absolute_path').'/templates/'.$mos_change_template.'/index.php')) {
					$usertpl = 1;
					$cur_template = $mos_change_template;
					setcookie("mos_user_template", $mos_change_template, $curtime + intval($this->getCfg('lifetime')));
				} else {
					setcookie("mos_user_template", "", $curtime - (intval($this->getCfg('lifetime')) + 900));
				}
			}
			if ($usertpl && ($cur_template != '')) {
				$this->_db->setQuery("SELECT params FROM #__templates_menu WHERE client_id='0' AND template='".$cur_template."'", '#__', 1, 0);
				$cur_tplparams = $this->_db->loadResult();
				$this->_template = $cur_template;
				$this->_template_params = $cur_tplparams;
			} else {
				$found = 0;
				if (isset($Itemid) && (intval($Itemid) > 0)) { //Assigned template
					$this->_db->setQuery("SELECT template, params FROM #__templates_menu WHERE client_id='0' AND menuid='".$Itemid."'", '#__', 1, 0);
					$tplrow = $this->_db->loadRow();
					if ($tplrow) {
						$found = 1;
						$cur_template = $tplrow['template'];
						$cur_tplparams = $tplrow['params'];
					}
				}
				if (!$found) { //default template
					$this->_db->setQuery( "SELECT template, params FROM #__templates_menu WHERE client_id='0' AND menuid='0'", '#__', 1, 0);
					$tplrow = $this->_db->loadRow();
					$cur_template = $tplrow['template'];
					$cur_tplparams = $tplrow['params'];
				}
			}
			$this->_template = $cur_template;
			$this->_template_params = $cur_tplparams;
		}
	}


	/* GET CURRENT TEMPLATE */
	public function getTemplate() {
		return $this->_template;
	}

	/* GET TEMPLATE PARAMETERS */
	public function getTplParams() {
		return $this->_template_params;
	}

	/* GET LOGIN SCREEN */
	public function getLoginScreen() {
		return $this->_loginscreen;
	}

	/* GET LOGIN SCREEN PARAMS */
	public function getLSParams() {
		return $this->_loginscreen_params;
	}


	/**
	* Determines the paths for including engine and menu files
	* @param string The current option used in the url
	* @param string The base path from which to load the configuration file
	*/
	public function _setAdminPaths( $option, $basePath='.' ) {
		$option = strtolower( $option );
		$this->_path = new stdClass();

		$prefix = substr( $option, 0, 4 );
		if ($prefix != 'com_') {
			// ensure backward compatibility with existing links
			$name = $option;
			$option = 'com_'.$option;
		} else {
			$name = substr( $option, 4 );
		}
		// components
		if (file_exists( "$basePath/templates/$this->_template/components/$name.html.php" )) {
			$this->_path->front = "$basePath/components/$option/$name.php";
			$this->_path->front_html = "$basePath/templates/$this->_template/components/$name.html.php";
		} else if (file_exists( "$basePath/components/$option/$name.php" )) {
			$this->_path->front = "$basePath/components/$option/$name.php";
			$this->_path->front_html = "$basePath/components/$option/$name.html.php";
		}
		if (file_exists( "$basePath/administrator/components/$option/admin.$name.php" )) {
			$this->_path->admin = "$basePath/administrator/components/$option/admin.$name.php";
			$this->_path->admin_html = "$basePath/administrator/components/$option/admin.$name.html.php";
		}
		if (file_exists( "$basePath/administrator/components/$option/toolbar.$name.php" )) {
			$this->_path->toolbar = "$basePath/administrator/components/$option/toolbar.$name.php";
			$this->_path->toolbar_html = "$basePath/administrator/components/$option/toolbar.$name.html.php";
			$this->_path->toolbar_default = "$basePath/administrator/includes/toolbar.html.php";
		}
		if (file_exists( "$basePath/components/$option/$name.class.php" )) {
			$this->_path->class = "$basePath/components/$option/$name.class.php";
		} else if (file_exists( "$basePath/administrator/components/$option/$name.class.php" )) {
			$this->_path->class = "$basePath/administrator/components/$option/$name.class.php";
		} else if (file_exists( "$basePath/includes/$name.php" )) {
			$this->_path->class = "$basePath/includes/$name.php";
		}
		if (file_exists("$basePath/administrator/components/$option/admin.$name.php" )) {
			$this->_path->admin = "$basePath/administrator/components/$option/admin.$name.php";
			$this->_path->admin_html = "$basePath/administrator/components/$option/admin.$name.html.php";
		} else {
			$this->_path->admin = "$basePath/administrator/components/com_admin/admin.admin.php";
			$this->_path->admin_html = "$basePath/administrator/components/com_admin/admin.admin.html.php";
		}
	}


	/*********************/
	/* GET A STORED PATH */
	/*********************/
	public function getPath( $varname, $option='' ) {
		if ($option) {
			$temp = $this->_path;
			$this->_setAdminPaths($option, $this->getCfg('absolute_path'));
		}

		$result = null;
		if (isset( $this->_path->$varname )) {
			$result = $this->_path->$varname;
		} else {
			switch ($varname) {
				case 'com_xml':
				$name = substr($option, 4);
				$path = $this->getCfg('absolute_path').'/administrator/components/'.$option.'/'.$name.'.xml';
				if (file_exists($path)) {
					$result = $path;
				} else {
					$path = $this->getCfg('absolute_path').'/components/'.$option.'/'.$name.'.xml';
					if (file_exists($path)) { $result = $path;}
				}
				break;
				case 'mod0_xml': //Site modules
					if ($option == '') {
						$path = $this->getCfg('absolute_path').'/modules/custom.xml';
					} else {
						$path = $this->getCfg('absolute_path').'/modules/'.$option.'.xml';
					}
					if (file_exists( $path )) {	$result = $path; }
				break;
				case 'mod1_xml': //admin modules
					if ($option == '') {
						$path = $this->getCfg('absolute_path').'/administrator/modules/custom.xml';
					} else {
						$path = $this->getCfg('absolute_path').'/administrator/modules/'.$option.'.xml';
					}
					if (file_exists( $path )) { $result = $path; }
				break;
				case 'bot_xml': //Site bots
					$path = $this->getCfg('absolute_path').'/mambots/'.$option.'.xml';
					if (file_exists( $path )) { $result = $path; }
				break;
				case 'menu_xml':
					$path = $this->getCfg('absolute_path').'/administrator/components/com_menus/'.$option.'/'.$option.'.xml';
					if (file_exists( $path )) { $result = $path; }
				break;
				case 'installer_html':
					$path = $this->getCfg('absolute_path').'/administrator/components/com_installer/'.$option.'/'.$option.'.html.php';
					if (file_exists( $path )) { $result = $path; }
				break;
				case 'installer_class':
					$path = $this->getCfg('absolute_path').'/administrator/components/com_installer/'.$option.'/'.$option.'.class.php';
					if (file_exists( $path )) { $result = $path; }
				break;
			}
		}
		if ($option) { $this->_path = $temp; }
		return $result;
	}


	/**
	* Detects a 'visit'
	*
	* This function updates the agent and domain table hits for a particular
	* visitor.  The user agent is recorded/incremented if this is the first visit.
	* A cookie is set to mark the first visit.
	*/
	public function detect() {
		global $mosConfig_enable_stats;
		if ($mosConfig_enable_stats == 1) {
			if (mosGetParam( $_COOKIE, 'mosvisitor', 0 )) {
				return;
			}
			setcookie( "mosvisitor", "1" );

			if (phpversion() <= "4.2.1") {
				$agent = getenv( "HTTP_USER_AGENT" );
				$domain = gethostbyaddr( getenv( "REMOTE_ADDR" ) );
			} else {
				$agent = $_SERVER['HTTP_USER_AGENT'];
				$domain = gethostbyaddr( $_SERVER['REMOTE_ADDR'] );
			}

			$browser = mosGetBrowser( $agent );

			$this->_db->setQuery( "SELECT COUNT(*) FROM #__stats_agents WHERE agent='$browser' AND type='0'" );
			if ($this->_db->loadResult()) {
				$this->_db->setQuery( "UPDATE #__stats_agents SET hits=(hits+1) WHERE agent='$browser' AND type='0'" );
			} else {
				$this->_db->setQuery( "INSERT INTO #__stats_agents (agent,type) VALUES ('$browser','0')" );
			}
			$this->_db->query();

			$os = mosGetOS( $agent );

			$this->_db->setQuery( "SELECT COUNT(*) FROM #__stats_agents WHERE agent='$os' AND type='1'" );
			if ($this->_db->loadResult()) {
				$this->_db->setQuery( "UPDATE #__stats_agents SET hits=(hits+1) WHERE agent='$os' AND type='1'" );
			} else {
				$this->_db->setQuery( "INSERT INTO #__stats_agents (agent,type) VALUES ('$os','1')" );
			}
			$this->_db->query();

			// tease out the last element of the domain
			$tldomain = split( "\.", $domain );
			$tldomain = $tldomain[count( $tldomain )-1];

			if (is_numeric( $tldomain )) {
				$tldomain = "Unknown";
			}

			$this->_db->setQuery( "SELECT COUNT(*) FROM #__stats_agents WHERE agent='$tldomain' AND type='2'" );
			if ($this->_db->loadResult()) {
				$this->_db->setQuery( "UPDATE #__stats_agents SET hits=(hits+1) WHERE agent='$tldomain' AND type='2'" );
			} else {
				$this->_db->setQuery( "INSERT INTO #__stats_agents (agent,type) VALUES ('$tldomain','2')" );
			}
			$this->_db->query();
		}
	}


	/*******************************/
	/* GET ITEMID FOR CONTENT ITEM */
	/*******************************/
	public function getItemid( $id, $typed=1, $link=1, $bs=1, $bc=1, $gbs=1 ) {
		global $Itemid;

		$_Itemid = 0;
		if (!$_Itemid && $typed) {
			//Search for link to autonomous page
			$this->_db->setQuery( "SELECT id FROM #__menu WHERE type='content_typed'"
			."\n AND published='1' AND link='index.php?option=com_content&task=view&id=$id'" );
			$_Itemid = intval($this->_db->loadResult());
		}

		if (!$_Itemid && $link) {
			//Search for content item link
			$this->_db->setQuery( "SELECT id FROM #__menu WHERE type='content_item_link'"
			."\n AND published='1' AND link='index.php?option=com_content&task=view&id=".$id."'" );
			$_Itemid = intval($this->_db->loadResult());
		}

		if (!$_Itemid) {
			//Search in content categories
			$this->_db->setQuery( "SELECT m.id FROM #__menu m"
			."\n LEFT JOIN #__categories c ON m.componentid=c.id"
			."\n WHERE m.type='content_category' AND m.published='1' AND c.id='".$id."'" );
			$_Itemid = intval($this->_db->loadResult());
		}

		if (!$_Itemid) {
			//Search in content sections
			$this->_db->setQuery( "SELECT m.id FROM #__menu m"
			."\n LEFT JOIN #__sections s ON m.componentid=s.id"
			."\n WHERE m.type='content_section' AND m.published='1' AND s.id='".$id."'" );
			$_Itemid = intval($this->_db->loadResult());
		}

		if (!$_Itemid && $bc) {
			//Search in specific blog category
			$this->_db->setQuery( "SELECT m.id FROM #__content i"
			."\n LEFT JOIN #__categories c ON i.catid=c.id"
			."\n LEFT JOIN #__menu m ON m.componentid=c.id"
			."\n WHERE m.type='content_blog_category' AND m.published='1' AND i.id='".$id."'" );
			$_Itemid = intval($this->_db->loadResult());
		}

		if (!$_Itemid && $bs) {
			//Search in specific blog section
			$this->_db->setQuery( "SELECT m.id FROM #__content i"
			."\n LEFT JOIN #__sections s ON i.sectionid=s.id"
			."\n LEFT JOIN #__menu m ON m.componentid=s.id"
			."\n WHERE m.type='content_blog_section' AND m.published='1' AND i.id='".$id."'" );
			$_Itemid = intval($this->_db->loadResult());
		}

		if (!$_Itemid && $gbs) {
			//Search in global blog section
			$this->_db->setQuery( "SELECT id FROM #__menu"
			."\n WHERE type='content_blog_section' AND published='1' AND componentid='0'" );
			$_Itemid = intval($this->_db->loadResult());
		}

		if (!$_Itemid) {
			//Search in global blog category
			$this->_db->setQuery( "SELECT id FROM #__menu"
			."\n WHERE type='content_blog_category' AND published='1' AND componentid='0'" );
			$_Itemid = intval($this->_db->loadResult());
		}

		if ($_Itemid) {
			return $_Itemid;
		} else {
			return $Itemid;
		}
	}


	/**
	* @return number of Published Blog Sections
	*/
	public function getBlogSectionCount() {
		$query = "SELECT COUNT( m.id ) FROM #__content i"
		."\n LEFT JOIN #__sections s ON i.sectionid=s.id"
		."\n LEFT JOIN #__menu m ON m.componentid=s.id "
		."\n WHERE m.type='content_blog_section' AND m.published='1'";
		$this->_db->setQuery( $query );
		$count = $this->_db->loadResult();
		return $count;
	}

	/**
	* @return number of Published Blog Categories
	*/
	public function getBlogCategoryCount() {
		$query = "SELECT COUNT( m.id ) FROM #__content i"
		."\n LEFT JOIN #__categories c ON i.catid=c.id"
		."\n LEFT JOIN #__menu m ON m.componentid=c.id "
		."\n WHERE m.type='content_blog_category' AND m.published='1'";
		$this->_db->setQuery( $query );
		$count = $this->_db->loadResult();
		return $count;
	}

	/**
	* @return number of Published Global Blog Sections
	*/
	public function getGlobalBlogSectionCount( ) {
		$query = "SELECT COUNT( id ) FROM #__menu WHERE type='content_blog_section' AND published='1' AND componentid=0";
		$this->_db->setQuery( $query );
		$count = $this->_db->loadResult();
		return $count;
	}

	/**
	* @return number of Static Content
	*/
	public function getStaticContentCount( ) {
		$query = "SELECT COUNT( id ) FROM #__menu WHERE type='content_typed' AND published='1'";
		$this->_db->setQuery( $query );
		$count = $this->_db->loadResult();
		return $count;
	}

	/**
	* @return number of Content Item Links
	*/
	public function getContentItemLinkCount( ) {
		$query = "SELECT COUNT( id ) FROM #__menu WHERE type='content_item_link' AND published='1'";
		$this->_db->setQuery( $query );
		$count = $this->_db->loadResult();
		return $count;
	}


	/*************************************/
	/* SEND NOTIFICATIONS ON NEW COMMENT */
	/*************************************/
	public function newcommentnotify($com, $postlink='', $posttitle='') {
		global $database;

		if (!is_object($com) || !($com instanceof mosComments)) { return; }
		if ($com->published == 0) { return; }

		if ($posttitle == '') {
			if ($com->origin == 0) {
				$database->setQuery("SELECT title FROM #__eblog WHERE id=".$com->articleid."", '#__', 1, 0);
				$posttitle = $database->loadResult();
			} elseif ($com->origin == 1) {
				$database->setQuery("SELECT title FROM #__content WHERE id=".$com->articleid."", '#__', 1, 0);
				$posttitle = $database->loadResult();
			}
		}

		$query = "SELECT author, email FROM #__comments"
		."\n WHERE origin=".$com->origin." AND articleid=".$com->articleid.""
		."\n AND published=1 AND notify=1 AND email<>'".$com->email."'"
		."\n GROUP BY email";
		$database->setQuery($query);
		$rows = $database->loadRowList();
		if (!$rows) { return; }

		//backwards compatibility
		if (!defined('_E_NEWCOMMENT')) { define ('_E_NEWCOMMENT', 'New comment'); }
		if (!defined('_E_NEWCOMSARWATCH')) {
			define('_E_NEWCOMSARWATCH', "A comment has been submitted to an article you are watching by %s");
		}

		$subject = _E_NEWCOMMENT;
		if ($posttitle != '') {
			$pat = '#([\']|[\!]|[\(]|[\)]|[\;]|[\"]|[\$]|[\#]|[\<]|[\>]|[\*]|[\%]|[\~]|[\`]|[\^]|[\|]|[\{]|[\}]|[\\\])#u';
			$subject .= ': '.eUTF::utf8_trim(preg_replace($pat, '', $posttitle));
		}

		$commonmsg = sprintf(_E_NEWCOMSARWATCH, $com->author)."\n\n";
		$commonmsg .= "---------------------------------------------\n";
		$commonmsg .= _E_COMMENT.":\n";
		$commonmsg .= nl2br(strip_tags($com->cmessage))."\n";
		$commonmsg .= "---------------------------------------------\n\n";
		if ($postlink != '') {
			if (!preg_match('/^(http)/i', $postlink)) {
				$postlink = $this->getCfg('live_site').'/'.preg_replace('/^(\/)/', '', $postlink);
			}
			$commonmsg .= _E_URL.': '.$postlink."\n";
		}
		$commonmsg .= _E_DONTRESPOND."\n\n";
		$commonmsg .= $this->getCfg('sitename')."\n";
		$commonmsg .= $this->getCfg('live_site');

		foreach ($rows as $row) {
			$message = _E_HI.' '.$row['author'].",\n";
			$message .= $commonmsg;
			mosMail($this->getCfg('mailfrom'), $this->getCfg('fromname'), $row['email'], $subject, $message);
		}
	}


	/********************/
	/* MAKE STRING SAFE */
	/********************/
	public function makesafe($string='', $strict=0) {
		if ($string == '') { return $string; }
		if ($strict) {
			$pat = "#([\']|[\!]|[\(]|[\)]|[\;]|[\"]|[\$]|[\#]|[\<]|[\>]|[\*]|[\%]|[\~]|[\`]|[\^]|[\|]|[\{]|[\}]|[\\\])#u";
		} else {
			$pat = "#([\']|[\"]|[\$]|[\#]|[\<]|[\>]|[\*]|[\%]|[\~]|[\`]|[\^]|[\|]|[\{]|[\}]|[\\\])#u";
		}
		$s = eUTF::utf8_trim(preg_replace($pat, '', $string));
		return $s;
	}

}

/**
* Component database table class
*/
class mosComponent extends mosDBTable {
	/** @var int Primary key */
	public $id=null;
	/** @var string */
	public $name=null;
	/** @var string */
	public $link=null;
	/** @var int */
	public $menuid=null;
	/** @var int */
	public $parent=null;
	/** @var string */
	public $admin_menu_link=null;
	/** @var string */
	public $admin_menu_alt=null;
	/** @var string */
	public $option=null;
	/** @var string */
	public $ordering=null;
	/** @var string */
	public $admin_menu_img=null;
	/** @var int */
	public $iscore=null;
	/** @var string */
	public $params=null;

	/**
	* @param database A database connector object
	*/
	public function mosComponent( &$db ) {
		$this->mosDBTable( '#__components', 'id', $db );
	}
}

/**
* Utility class for all HTML drawing classes
*/
class mosHTML {
	static public function makeOption( $value, $text='' ) {
		$obj = new stdClass;
		$obj->value = $value;
		$obj->text = eUTF::utf8_trim( $text ) ? $text : $value;
		return $obj;
	}


	static public function writableCell( $folder ) {
		$align = (_GEM_RTL) ? 'right' : 'left';
		echo '<tr>';
  		echo '<td class="item">'.$folder.'/</td>';
  		echo '<td align="'.$align.'">';
  		echo is_writable( "../$folder" ) ? '<span style="font-weight: bold; color: green;">'._GEM_WRITABLE.'</span>' : '<span style="font-weight: bold; color: red;">'._GEM_UNWRITABLE.'</span>';
  		echo '</td>';
		echo '</tr>'._LEND;
	}

	/**
	* Generates an HTML select list
	* @param array An array of objects
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param string The name of the object variable for the option value
	* @param string The name of the object variable for the option text
	* @param mixed The key that is selected
	* @returns string HTML for the select list
	*/
	static public function selectList( &$arr, $tag_name, $tag_attribs, $key, $text, $selected=NULL ) {
		reset( $arr );
		$fieldtitle =  ($tag_attribs == '') ? ' title="'.$tag_name.'"' : '';
        if (!preg_match('/id\=/i', $x)) {
            $html = '<select name="'.$tag_name.'" id="'.$tag_name.'"'.$fieldtitle.' '.$tag_attribs.'>'._LEND;
        } else {
            $html = '<select name="'.$tag_name.'"'.$fieldtitle.' '.$tag_attribs.'>'._LEND;
        }
		for ($i=0, $n=count( $arr ); $i < $n; $i++ ) {
			$k = $arr[$i]->$key;
			$t = $arr[$i]->$text;
			$id = isset($arr[$i]->id) ? $arr[$i]->id : 0;

			$extra = '';
			$extra .= $id ? " id=\"" . $arr[$i]->id . "\"" : '';
			if (is_array( $selected )) {
				foreach ($selected as $obj) {
					$k2 = $obj->$key;
					if ($k == $k2) {
						$extra .= " selected=\"selected\"";
						break;
					}
				}
			} else {
				$extra .= ($k == $selected ? " selected=\"selected\"" : '');
			}
			$html .= '<option value="'.$k.'"'.$extra.'>'.$t.'</option>'._LEND;
		}
		$html .= '</select>'._LEND;
		return $html;
	}

	/**
	* Writes a select list of integers
	* @param int The start integer
	* @param int The end integer
	* @param int The increment
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @param string The printf format to be applied to the number
	* @returns string HTML for the select list
	*/
	static public function integerSelectList( $start, $end, $inc, $tag_name, $tag_attribs, $selected, $format="" ) {
		$start = intval( $start );
		$end = intval( $end );
		$inc = intval( $inc );
		$arr = array();
		for ($i=$start; $i <= $end; $i+=$inc) {
			$fi = $format ? sprintf( "$format", $i ) : "$i";
			$arr[] = mosHTML::makeOption( $fi, $fi );
		}

		$tag_attribs = ($tag_attribs == '') ? 'dir="ltr"' : $tag_attribs.' dir="ltr"';
		return mosHTML::selectList( $arr, $tag_name, $tag_attribs, 'value', 'text', $selected );
	}


	/**
	* Writes a select list of month names based on Language settings
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @returns string HTML for the select list values
	* Used only in frontend (?)
	*/
	static public function monthSelectList( $tag_name, $tag_attribs, $selected ) {
		$arr = array(
		mosHTML::makeOption( '01', _JAN ),
		mosHTML::makeOption( '02', _FEB ),
		mosHTML::makeOption( '03', _MAR ),
		mosHTML::makeOption( '04', _APR ),
		mosHTML::makeOption( '05', _MAY ),
		mosHTML::makeOption( '06', _JUN ),
		mosHTML::makeOption( '07', _JUL ),
		mosHTML::makeOption( '08', _AUG ),
		mosHTML::makeOption( '09', _SEP ),
		mosHTML::makeOption( '10', _OCT ),
		mosHTML::makeOption( '11', _NOV ),
		mosHTML::makeOption( '12', _DEC )
		);

		return mosHTML::selectList( $arr, $tag_name, $tag_attribs, 'value', 'text', $selected );
	}

	/**
	* Generates an HTML select list from a tree based query list
	* @param array Source array with id and parent fields
	* @param array The id of the current list item
	* @param array Target array.  May be an empty array.
	* @param array An array of objects
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param string The name of the object variable for the option value
	* @param string The name of the object variable for the option text
	* @param mixed The key that is selected
	* @returns string HTML for the select list
	*/
	static public function treeSelectList( &$src_list, $src_id, $tgt_list, $tag_name, $tag_attribs, $key, $text, $selected ) {

		// establish the hierarchy of the menu
		$children = array();
		// first pass - collect children
		foreach ($src_list as $v ) {
			$pt = $v->parent;
			$list = @$children[$pt] ? $children[$pt] : array();
			array_push( $list, $v );
			$children[$pt] = $list;
		}
		// second pass - get an indent list of the items
		$ilist = mosTreeRecurse( 0, '', array(), $children );

		// assemble menu items to the array
		$this_treename = '';
		foreach ($ilist as $item) {
			if ($this_treename) {
				if ($item->id != $src_id && strpos( $item->treename, $this_treename ) === false) {
					$tgt_list[] = mosHTML::makeOption( $item->id, $item->treename );
				}
			} else {
				if ($item->id != $src_id) {
					$tgt_list[] = mosHTML::makeOption( $item->id, $item->treename );
				} else {
					$this_treename = "$item->treename/";
				}
			}
		}
		// build the html select list
		return mosHTML::selectList( $tgt_list, $tag_name, $tag_attribs, $key, $text, $selected );
	}

	/**
	* Writes a yes/no select list
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @returns string HTML for the select list values
	*/
	static public function yesnoSelectList( $tag_name, $tag_attribs, $selected, $yes=_GEM_YES, $no=_GEM_NO ) {
		$arr = array(
		mosHTML::makeOption( '0', $no ),
		mosHTML::makeOption( '1', $yes ),
		);

		return mosHTML::selectList( $arr, $tag_name, $tag_attribs, 'value', 'text', $selected );
	}

	/**
	* Generates an HTML radio list
	* @param array An array of objects
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @param string The name of the object variable for the option value
	* @param string The name of the object variable for the option text
	* @returns string HTML for the select list
	*/
	static public function radioList( &$arr, $tag_name, $tag_attribs, $selected=null, $key='value', $text='text' ) {
		reset( $arr );
		$html = "";
		for ($i=0, $n=count( $arr ); $i < $n; $i++ ) {
			$k = $arr[$i]->$key;
			$t = $arr[$i]->$text;
			$id = isset($arr[$i]->id) ? $arr[$i]->id : 0;

			$extra = '';
			$extra .= $id ? " id=\"" . $arr[$i]->id . "\"" : '';
			if (is_array( $selected )) {
				foreach ($selected as $obj) {
					$k2 = $obj->$key;
					if ($k == $k2) {
						$extra .= " selected=\"selected\"";
						break;
					}
				}
			} else {
				$extra .= ($k == $selected ? " checked=\"checked\"" : '');
			}
			$html .= "\n\t<input type=\"radio\" name=\"$tag_name\" value=\"".$k."\"$extra $tag_attribs />" . $t;
		}
		$html .= "\n";
		return $html;
	}

	/**
	* Writes a yes/no radio list
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @returns string HTML for the radio list
	*/
	static public function yesnoRadioList( $tag_name, $tag_attribs, $selected, $yes=_GEM_YES, $no=_GEM_NO ) {
		$arr = array(
		mosHTML::makeOption( '0', $no, true ),
		mosHTML::makeOption( '1', $yes, true )
		);
		return mosHTML::radioList( $arr, $tag_name, $tag_attribs, $selected );
	}

	/**
	* @param int The row index
	* @param int The record id
	* @param boolean
	* @param string The name of the form element
	* @return string
	*/
	static public function idBox( $rowNum, $recId, $checkedOut=false, $name='cid' ) {
		if ( $checkedOut ) {
			return '';
		} else {
			return '<input type="checkbox" id="cb'.$rowNum.'" name="'.$name.'[]" value="'.$recId.'" onclick="isChecked(this.checked);" />';
		}
	}


	static public function sortIcon( $base_href, $field, $state='none' ) {
		global $mainframe;

		$alts = array('none' => _GEM_SORT_NONE, 'asc' => _GEM_SORT_ASC, 'desc' => _GEM_SORT_DESC);

		$next_state = 'asc';
		if ($state == 'asc') {
			$next_state = 'desc';
		} else if ($state == 'desc') {
			$next_state = 'none';
		}

		$html = '<a href="'.$base_href.'&amp;field='.$field.'&amp;order='.$next_state.'" title="'.$alts[$next_state].'">';
		$html .= '<img src="'.$mainframe->getCfg('ssl_live_site').'/images/M_images/sort_$state.png" border="0" alt="'.$alts[$next_state].'" />';
		$html .= '</a>';
		return $html;
	}


	/***********************/
	/* WRITES CLOSE BUTTON */
	/***********************/
	public static function CloseButton( &$params, $hide_js=NULL ) {
		if ( $params->get( 'popup' ) && !$hide_js ) { //displays close button in Pop-up window
?>
			<div align="center" style="margin-top: 30px; margin-bottom: 30px;">
                <a href="javascript:window.close();" title="<?php echo _PROMPT_CLOSE; ?>"><?php echo _PROMPT_CLOSE; ?></a>
			</div>
<?php 
		}
	}


	/**********************/
	/* WRITES BACK BUTTON */
	/**********************/
	static public function BackButton ( &$params, $hide_js=NULL ) {
		if ( $params->get( 'back_button' ) && !$params->get( 'popup' ) && !$hide_js) {
	?>
			<div class="back_button"><a href="javascript:history.go(-1);" title="<?php echo _BACK; ?>"><?php echo _BACK; ?></a></div>
	<?php 
		}
	}


	/**
	* Cleans text of all formating and scripting code
	*/
	static public function cleanText (&$text) {
		$text = preg_replace( "'<script[^>]*>.*?</script>'si", '', $text );
		$text = preg_replace( '/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is', '\2 (\1)', $text );
		$text = preg_replace( '/<!--.+?-->/', '', $text );
		$text = preg_replace( '/{.+?}/', '', $text );
		$text = preg_replace( '/&nbsp;/', ' ', $text );
		$text = preg_replace( '/&amp;/', ' ', $text );
		$text = preg_replace( '/&quot;/', ' ', $text );
		$text = strip_tags( $text );
		$text = htmlspecialchars( $text );
		return $text;
	}


	/*********************/
	/* WRITES PRINT ICON */
	/*********************/
	static public function PrintIcon( &$row, &$params, $hide_js, $link, $status=NULL ) {
		if ( $params->get( 'print' )  && !$hide_js ) {
			if ( !$status ) {
				$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';
			}

			if ( $params->get( 'icons' ) ) {
				$image = mosAdminMenus::ImageCheck( 'printButton.png', '/images/M_images/', NULL, NULL, _CMN_PRINT );
			} else {
				$image = _ICON_SEP .'&nbsp;'. _CMN_PRINT. '&nbsp;'. _ICON_SEP;
			}

			if ( $params->get( 'popup' ) && !$hide_js ) {
				echo '<a href="javascript:void(0);" onclick="javascript:window.print(); return false" title="'._CMN_PRINT.'">'._LEND;
				echo $image._LEND;
				echo '</a> '._LEND;
			} else {
				echo '<a href="javascript:void(0);" onclick="javascript:window.open(\''.$link.'\', \'PrintWindow\', \''.$status.'\');" title="'._CMN_PRINT.'">'._LEND;
				echo $image._LEND;
				echo '</a> '._LEND;
			}
		}
	}


	/**********************************/
	/* WRITES AN ELXIS WIKI ICON-LINK */
	/**********************************/
	public static function elxiswiki($page='', $icon='') {
		global $mainframe;

		$page = preg_replace('/^(\/)/', '', $page);
		if ($icon == '') {
			$icon = $mainframe->getCfg('ssl_live_site').'/administrator/images/16X16/wiki16.png';
		}
		$title = 'Elxis Wiki';
		if ($page != '') {
			$title .= ' - '.str_replace('_', ' ', $page);
		}
		echo '<a href="http://wiki.elxis.org/wiki/'.$page.'" target="_blank" title="'.$title.'">';
		echo '<img src="'.$icon.'" alt="'.$title.'" border="0" />';
		echo "</a>\n";
	}


	/**************************************/
	/* SIMPLE JAVASCRIPT E-MAIL CLOACKING */
	/**************************************/
	function emailCloaking( $mail, $mailto=1, $text='', $email=1 ) {
		// convert text
		$mail 		= mosHTML::encoding_converter( $mail );
		// split email by @ symbol
		$mail		= explode( '@', $mail );
		$mail_parts	= explode( '.', $mail[1] );
		// random number
		$rand	= rand( 1, 100000 );

		$replacement = "\n<script type=\"text/javascript\">\n";
		$replacement .= "<!-- \n";
		$replacement .= "var prefix = '&#109;a' + 'i&#108;' + '&#116;o'; \n";
		$replacement .= "var path = 'hr' + 'ef' + '='; \n";
		$replacement .= "var addy". $rand ." = '". @$mail[0] ."' + '&#64;' + '". implode( "' + '&#46;' + '", $mail_parts ) ."'; \n";
		if ( $mailto ) {
			//special handling when mail text is different from mail addy
			if ( $text ) {
				if ( $email ) {
					// convert text
					$text 	= mosHTML::encoding_converter( $text );
					// split email by @ symbol
					$text 	= explode( '@', $text );
					$text_parts	= explode( '.', $text[1] );
					$replacement 	.= "var addy_text". $rand ." = '". @$text[0] ."' + '&#64;' + '". implode( "' + '&#46;' + '", @$text_parts ) ."'; \n";
				} else {
					$text 	= mosHTML::encoding_converter( $text );
					$replacement 	.= "var addy_text". $rand ." = '". $text ."';\n";
				}
				$replacement .= "document.write( '<a ' + path + '\'' + prefix + ':' + addy". $rand ." + '\'>' ); \n";
				$replacement .= "document.write( addy_text". $rand ." ); \n";
				$replacement .= "document.write( '<\/a>' ); \n";
			} else {
				$replacement .= "document.write( '<a ' + path + '\'' + prefix + ':' + addy". $rand ." + '\'>' ); \n";
				$replacement .= "document.write( addy". $rand ." ); \n";
				$replacement .= "document.write( '<\/a>' ); \n";
			}
		} else {
			$replacement 	.= "document.write( addy". $rand ." ); \n";
		}
		$replacement .= "//--> \n";
		$replacement .= "</script> \n";
		//$replacement .= "<noscript> \n"; //If it is inside elements such as p is xhtml invalid
		//$replacement .= _CLOAKING;
		//$replacement .= "\n</noscript> \n";

		return $replacement;
	}

	function encoding_converter( $text ) {
		// replace vowels with character encoding
		$text 	= eUTF::utf8_str_replace( 'a', '&#97;', $text );
		$text 	= eUTF::utf8_str_replace( 'e', '&#101;', $text );
		$text 	= eUTF::utf8_str_replace( 'i', '&#105;', $text );
		$text 	= eUTF::utf8_str_replace( 'o', '&#111;', $text );
		$text	= eUTF::utf8_str_replace( 'u', '&#117;', $text );

		return $text;
	}


	/************************************************************/
	/* RETURN EXTRA FIELD AS HTML FOR USE IN FORMS (old method) */
	/************************************************************/
	static public function xfieldForm ( $id, $name, $options=array(), $value=array(), $type='text', $ronly='0', $halign='1', $maxlength='50', $attrs='', $req='0' ) {
		if ( $ronly == 1 ) { $ronly = ' readonly'; } else { $ronly = ''; }
		if ( $halign == 0 ) { $hal = '<br />'; } else { $hal = ''; }
		if (!is_array($value)) { $value = array($value); }

        $out = '';
    	switch ($type) {
            case 'select':
                $out .= '<span '.$attrs.'>'.$name;
                $out .= ($req == 1) ? '*: </span>' : ': </span>';
                $out .= '<select name="efield['.$id.']" title="'.$name.'" class="selectbox"'.$ronly.'>'._LEND;
                for ($i=0; $i<20; $i++) {
                    if ($options[$i]) {
                        if ($options[$i] == $value[0]) { $chk = "  selected=\"selected\""; } else { $chk = ''; }
                        $out .= "<option value=\"".$options[$i]."\"".$chk.">".$options[$i]."</option>"._LEND;
                    }
                }
                $out .= "</select>"._LEND;
            break;
    
            case 'radio':
                $out .= '<span '.$attrs.'>'.$name;
                $out .= ($req == 1) ? '*: </span>' : ': </span>';
                $out .= $hal;
                for ($i=0; $i<20; $i++) {
                    if ($options[$i]) {
                        if ($options[$i] == $value[0]) { $chk = " checked=\"checked\""; } else { $chk = ''; }
                        $out .= "<input type=\"radio\" name=\"efield[".$id."]\" class=\"inputbox\" value=\"".$options[$i]."\"".$chk."".$ronly." />".$options[$i]." ".$hal._LEND;
                    }
                }
            break;
            case 'checkbox':
                $out .= '<span '.$attrs.'>'.$name;
                $out .= ($req == 1) ? '*: </span>' : ': </span>';
                $out .= $hal;
                for ($i=0; $i<20; $i++) {
                    if ($options[$i]) {
                        if (in_array($options[$i], $value)) { $chk = " checked=\"checked\""; } else { $chk = ''; }
                        $out .= "<input type=\"checkbox\" name=\"efield[".$id."][]\" class=\"inputbox\" value=\"".$options[$i]."\"".$chk."".$ronly." />".$options[$i]." ".$hal._LEND;
                    }
                }
                //the following is required to grab checkbox extraid if user has deselect all boxes
                $out .= "<input type=\"hidden\" name=\"efieldhidden[".$id."]\" value=\"".$id."\" />"._LEND;
            break;
            case 'hidden':
                if (defined( '_ELXIS_ADMIN' )) {
                    $out .= '<span '.$attrs.'>'.$name;
                    $out .= ($req == 1) ? '*: </span>' : ': </span>';                
                    $out .= "<input type=\"text\" name=\"efield[".$id."]\" class=\"inputbox\" value=\"".$value[0]."\" maxlength=\"".$maxlength."\"".$ronly." /> <em>hidden</em>"._LEND;
                } else {
                    $out .= "<input type=\"hidden\" name=\"efield[".$id."]\" value=\"".$value[0]."\" />"._LEND;
                }
            break;
            case 'text':
            default:
                $out .= '<span '.$attrs.'>'.$name;
                $out .= ($req == 1) ? '*: </span>' : ': </span>';
                $out .= "<input type=\"text\" name=\"efield[".$id."]\" title=\"".$name."\" class=\"inputbox\" value=\"".$value[0]."\" maxlength=\"".$maxlength."\"".$ronly." id=\"req".$id."\" />"._LEND;
            break;
        }
        return $out;
    }


	/*************************************************************/
	/* RETURN EXTRA FIELD AS ARRAY FOR USE IN FORMS (new method) */
	/*************************************************************/
	static public function xfieldFormArray( $id, $name, $options=array(), $value=array(), $type='text', $ronly='0', $halign='1', $maxlength='50', $java='', $req='0' ) {
		if ( $ronly == 1 ) { $ronly = ' readonly="readonly"'; } else { $ronly = ''; }
		if ( trim($java) != '' ) { $java = ' '.$java; }
		if ( $halign == 0 ) { $hal = '<br />'; } else { $hal = ''; }
		if (!is_array($value)) { $value = array($value); }

        $out = array();
    	switch ($type) {
            case 'select':
                $out['title'] = ($req) ? $name.'*' : $name;
                $html = '<select name="efield['.$id.']" title="'.$name.'" class="selectbox"'.$ronly.$java.'>'._LEND;
                for ($i=0; $i<20; $i++) {
                    if ($options[$i]) {
                        if ($options[$i] == $value[0]) { $chk = ' selected="selected"'; } else { $chk = ''; }
                        $html .= '<option value="'.$options[$i].'"'.$chk.'>'.$options[$i].'</option>'._LEND;
                    }
                }
                $html .= '</select>'._LEND;
                $out['html'] = $html;
            break;
            case 'radio':
                $out['title'] = ($req) ? $name.'*' : $name;
                $html = '';
                for ($i=0; $i<20; $i++) {
                    if ($options[$i]) {
                        if ($options[$i] == $value[0]) { $chk = ' checked="checked"'; } else { $chk = ''; }
                        $html .= '<input type="radio" name="efield['.$id.']" title="'.$options[$i].'" class="inputbox" value="'.$options[$i].'"'.$chk.$ronly.$java.' />'.$options[$i].' '.$hal._LEND;
                    }
                }
                $out['html'] = $html;
            break;
            case 'checkbox':
                $out['title'] = ($req) ? $name.'*' : $name;
                $html = '';
                for ($i=0; $i<20; $i++) {
                    if ($options[$i]) {
                        if (in_array($options[$i], $value)) { $chk = ' checked="checked"'; } else { $chk = ''; }
                        $html .= '<input type="checkbox" name="efield['.$id.'][]" title="'.$options[$i].'" class="inputbox" value="'.$options[$i].'"'.$chk.$ronly.$java.' />'.$options[$i].' '.$hal._LEND;
                    }
                }
                //the following is required to grab checkbox extraid if user has deselect all boxes
                $html .= '<input type="hidden" name="efieldhidden['.$id.']" value="'.$id.'" />'._LEND;
                $out['html'] = $html;
            break;
            case 'hidden':
                if (defined( '_ELXIS_ADMIN' )) {
                    $out['title'] = ($req) ? $name.'*' : $name;
                    $out['html'] = '<input type="text" name="efield['.$id.']" class="inputbox" value="'.$value[0].'" maxlength="'.$maxlength.'"'.$ronly.' /> <em>hidden</em>'._LEND;
                } else {
                    $out['title'] = '';
                    $out['html'] = '<input type="hidden" name="efield['.$id.']" value="'.$value[0].'" />'._LEND;
                }
            break;
            case 'text':
            default:
                $out['title'] = ($req) ? $name.'*' : $name;
                $out['html'] = '<input type="text" name="efield['.$id.']" title="'.$name.'" class="inputbox" value="'.$value[0].'" maxlength="'.$maxlength.'"'.$ronly.$java.' id="req'.$id.'" />'._LEND;
            break;
        }
        return $out;
    }

}


/*********************************/
/* CATEGORY DATABASE TABLE CLASS */
/*********************************/
class mosCategory extends mosDBTable {

	public $id=null;
	public $parent_id=null;
	public $title=null;
	public $name=null;
	public $image=null;
	public $section=null;
	public $image_position=null;
	public $description=null;
	public $published=null;
	public $checked_out=null;
	public $checked_out_time=null;
	public $ordering=null;
	public $access=29;
	public $params=null;
	public $language='';
	public $seotitle=null;


	/***************/
	/* CONSTRUCTOR */
	/***************/
	public function __construct( &$db ) {
		$this->mosDBTable( '#__categories', 'id', $db );
	}


	/*************/
	/* CHECK ROW */
	/*************/
	public function check() {
		global $mainframe;

		$this->title = $mainframe->makesafe($this->title);
		$this->name = $mainframe->makesafe($this->name);

		//check for valid name
		if (trim( $this->title ) == '') {
			$this->_error = "Category must contain a title.";
			return false;
		}
		if (trim( $this->name ) == '') {
			$this->_error = "Category must have a name.";
			return false;
		}

		if (trim( $this->seotitle ) == '') {
			$this->_error = "Category must have a SEO title.";
			return false;
		}

		//check for existing name
		$this->_db->setQuery( "SELECT id FROM #__categories WHERE ((name='".$this->name."') OR (seotitle='".$this->seotitle."')) AND section='".$this->section."'");

		$xid = intval( $this->_db->loadResult() );
		if ($xid && $xid != intval( $this->id )) {
			$this->_error = "There is a category already with that name, please try again.";
			return false;
		}
		return true;
	}
}


/**
* Section database table class
*/
class mosSection extends mosDBTable {
	/** @var int Primary key */
	public $id=null;
	/** @var string The menu title for the Section (a short name)*/
	public $title=null;
	/** @var string The full name for the Section*/
	public $name=null;
	/** @var string */
	public $image=null;
	/** @var string */
	public $scope=null;
	/** @var int */
	public $image_position=null;
	/** @var string */
	public $description=null;
	/** @var boolean */
	public $published=null;
	/** @var boolean */
	public $checked_out=null;
	/** @var time */
	public $checked_out_time=null;
	/** @var int */
	public $ordering=null;
	/** @var int */
	public $access=29;
	/** @var string */
	public $params='';
	/** @var string */
	public $language='';
	/** @var string */
	public $seotitle=null;

	/***************/
	/* CONSTRUCTOR */
	/***************/
	public function __construct( &$db ) {
		$this->mosDBTable( '#__sections', 'id', $db );
	}


	/*************/
	/* CHECK ROW */
	/*************/
	public function check() {
		global $mainframe;

		$this->title = $mainframe->makesafe($this->title);
		$this->name = $mainframe->makesafe($this->name);

		// check for valid name
		if (trim( $this->title ) == '') {
			$this->_error = "Section must contain a title.";
			return false;
		}
		if (trim( $this->name ) == '') {
			$this->_error = "Section must have a name.";
			return false;
		}
		// check for existing name
		$this->_db->setQuery( "SELECT id FROM #__sections WHERE name='$this->name' AND scope='$this->scope'");

		$xid = intval( $this->_db->loadResult() );
		if ($xid && $xid != intval( $this->id )) {
			$this->_error = "There is a section already with that name, please try again.";
			return false;
		}
		return true;
	}
}

/**
* Content database table class
*/
class mosContent extends mosDBTable {
	/** @var int Primary key */
	public $id=null;
	/** @var string */
	public $title=null;
	/** @var string */
	public $seotitle=null;
	/** @var string */
	public $introtext=null;
	/** @var string */
    public $maintext=null;
	/** @var int */
	public $state=null;
	/** @var int The id of the category section*/
	public $sectionid=null;
	/** @var int DEPRECATED */
	public $mask=null;
	/** @var int */
	public $catid=null;
	/** @var datetime */
	public $created=null;
	/** @var int User id*/
	public $created_by=null;
	/** @var string An alias for the author*/
	public $created_by_alias=null;
	/** @var datetime */
	public $modified=null;
	/** @var int User id*/
	public $modified_by=null;
	/** @var boolean */
	public $checked_out=null;
	/** @var time */
	public $checked_out_time=null;
	/** @var datetime */
	public $frontpage_up=null;
	/** @var datetime */
	public $frontpage_down=null;
	/** @var datetime */
	public $publish_up=null;
	/** @var datetime */
	public $publish_down=null;
	/** @var string */
	public $images=null;
	/** @var string */
	public $urls=null;
	/** @var string */
	public $attribs=null;
	/** @var int */
	public $version=null;
	/** @var int */
	public $parentid=null;
	/** @var int */
	public $ordering=null;
	/** @var string */
	public $metakey=null;
	/** @var string */
	public $metadesc=null;
	/** @var int */
	public $access=29;
	/** @var int */
	public $hits=null;
	/** @var string */
	public $language=null;

	/**
	* @param database A database connector object
	*/
	public function __construct(&$db) {
		$this->mosDBTable( '#__content', 'id', $db );
	}

	/**
	 * Validation and filtering
	 */
	public function check() {
		// filter malicious code
		$ignoreList = array( 'introtext', 'maintext' );
		$this->filter( $ignoreList );

		/*
		TODO: This filter is too rigorous,
		need to implement more configurable solution
		// specific filters
		$iFilter = new InputFilter( null, null, 1, 1 );
		$this->introtext = trim( $iFilter->process( $this->introtext ) );
		$this->maintext =  trim( $iFilter->process( $this->maintext ) );
		*/
		if (trim( str_replace( '&nbsp;', '', $this->maintext ) ) == '') { //not needed utf8
			$this->maintext = '';
		}

		$this->created = trim($this->created);
		if ($this->created == '') { $this->created = date('Y-m-d H:i:s'); }
		$this->publish_down = trim($this->publish_down);
		$this->publish_up = trim($this->publish_up);
		if (strlen($this->created) < 19) {
			$this->created = substr($this->created, 0, 10).' '.date('H:i:s');
		}
		if (strlen($this->publish_down) < 19) {
			$dtime = (strlen($this->created) == 19) ? substr($this->created, -8) : '00:00:01';
			$this->publish_down = substr($this->publish_down, 0, 10).' '.$dtime;
		}
		if (strlen($this->publish_up) < 19) {
			$dtime = (strlen($this->created) == 19) ? substr($this->created, -8) : '00:00:01';
			$this->publish_up = substr($this->publish_up, 0, 10).' '.$dtime;
		}
		return true;
	}

	/**
	* Converts record to XML
	* @param boolean Map foreign keys to text values
	*/
	function toXML( $mapKeysToText=false ) {
		global $database;

		if ($mapKeysToText) {
			$query = 'SELECT name FROM #__sections WHERE id='.$this->sectionid;
			$database->setQuery( $query );
			$this->sectionid = $database->loadResult();

			$query = 'SELECT name FROM #__categories WHERE id='.$this->catid;
			$database->setQuery( $query );
			$this->catid = $database->loadResult();

			$query = 'SELECT name FROM #__users WHERE id='.$this->created_by;
			$database->setQuery( $query );
			$this->created_by = $database->loadResult();
		}

		return parent::toXML( $mapKeysToText );
	}
}


/******************************************/
/* SUBMITTED CONTENT DATABASE TABLE CLASS */
/******************************************/
class elxSubContent extends mosDBTable {

	public $id=null;
	public $title=null;
	public $seotitle=null;
	public $introtext=null;
    public $maintext=null;
	public $scope='content';
	public $sectionid=null;
	public $catid=null;
	public $created=null;
	public $created_by=null;
	public $metakey=null;
	public $metadesc=null;
	public $access=29;
	public $language=null;
	public $comments=null;


	public function __construct( &$db ) {
		global $my;
		$this->mosDBTable( '#__submitted_content', 'id', $db );
		if (!$this->id) {
			$this->created = date('Y-m-d H:i:s');
			$this->created_by = $my->id;
		}
	}

	public function check() {
		// filter malicious code
		$ignoreList = array( 'introtext', 'maintext' );
		$this->filter( $ignoreList );

		if (trim( $this->title ) == '') {
			$this->_error = (defined('_ELXIS_ADMIN')) ? 'Article must contain a title' : _E_WARNTITLE;
			return false;
		}
		if (trim( $this->seotitle ) == '') {
			$this->_error = 'SEO title can not be empty!';
			return false;
		}
		if (!$this->sectionid || !$this->catid) {
			$this->_error = 'You must provide a section/category!';
			return false;
		}
		return true;
	}
}


/**
* Menu database table class
*/
class mosMenu extends mosDBTable {
	/** @var int Primary key */
	public $id=null;
	/** @var string */
	public $menutype=null;
	/** @var string */
	public $name=null;
	/** @var string */
	public $link=null;
	/** @var int */
	public $type=null;
	/** @var int */
	public $published=null;
	/** @var int */
	public $componentid=null;
	/** @var int */
	public $parent=null;
	/** @var int */
	public $sublevel=null;
	/** @var int */
	public $ordering=null;
	/** @var boolean */
	public $checked_out=null;
	/** @var datetime */
	public $checked_out_time=null;
	/** @var boolean */
	public $pollid=null;
	/** @var string */
	public $browserNav=null;
	/** @var int */
	public $access=29;
	/** @var int */
	public $utaccess=null;
	/** @var string */
	public $params=null;
	/** @var string */
	public $language=null;
	/** @var string */
	public $seotitle=null;

	/**************/
	/* CONTRUCTOR */
	/**************/
	public function __construct( &$db ) {
		$this->mosDBTable( '#__menu', 'id', $db );
	}


	/*************/
	/* CHECK ROW */
	/*************/
	public function check() {
		global $mainframe;

		$this->name = $mainframe->makesafe($this->name);
		if (trim($this->name) == '') {
			$this->_error = "Menu name can not be empty.";
			return false;
		}
		return true;
	}
}


/************************/
/* USERS DB TABLE CLASS */
/************************/
class mosUser extends mosDBTable {

	public $id=null;
	public $name=null;
	public $username=null;
	public $email=null;
	public $password=null;
	public $usertype=null;
	public $block=null;
	public $sendemail=null;
	public $gid=18;
	public $registerdate=null;
	public $lastvisitdate=null;
	public $activation=null;
	public $params=null;
	public $extrafields=null;
	public $preflang=null;
	public $avatar=null;
	public $website=null;
	public $aim=null;
	public $yim=null;
	public $msn=null;
	public $icq=null;
	public $phone=null;
	public $mobile=null;
	public $birthdate=null;
	public $gender='MALE';
	public $location=null;
	public $occupation=null;
	public $signature=null;
	public $expires=null;


	/**
	* @param database A database connector object
	*/
	public function __construct( &$database ) {
        global $mosConfig_lang;
		$this->mosDBTable('#__users', 'id', $database);
		if (!intval($this->id)) { $this->preflang = $mosConfig_lang; $this->expires = '2060-01-01 00:00:00'; }
	}


	 /**********************/
	 /* VALIDATE USER DATA */
	 /**********************/
	public function check() {
		global $mosConfig_uniquemail, $my, $mainframe;

		$this->name = $mainframe->makesafe($this->name, 1);
		$this->username = $mainframe->makesafe($this->username, 1);
		$this->phone = $mainframe->makesafe($this->phone, 1);
		$this->mobile = $mainframe->makesafe($this->mobile, 1);
		$this->location = $mainframe->makesafe($this->location);
		$this->occupation = $mainframe->makesafe($this->occupation);
		$this->signature = $mainframe->makesafe($this->signature);

		if (eUTF::utf8_trim( $this->name ) == '') {
			$this->_error = _GEM_REGWARN_NAME;
			return false;
		}

		if (trim( $this->username ) == '') {
			$this->_error = _GEM_REGWARN_UNAME;
			return false;
		}

        if (defined('_ELXIS_ADMIN')) {
            global $adminLanguage;
            $usrname = $adminLanguage->A_USERNAME;
            $passd = $adminLanguage->A_PASSWORD;
        } else {
            $usrname = _USERNAME;
            $passd = _PASSWORD;
        }

        $ultrim = strlen(trim($this->username));
        if (($ultrim < 4) || ($ultrim > 25) || !preg_match('/^([0-9a-zA-Z])+$/', $this->username)) {
            $this->_error = sprintf( html_entity_decode(_GEM_VALID_AZ09), html_entity_decode($usrname), 4 );
            return false;
        }

        $pltrim = strlen(trim($this->password));
        if (($pltrim < 6) || ($pltrim > 50) || !preg_match('/^([0-9a-zA-Z])+$/', $this->password)) {
            $this->_error = sprintf( html_entity_decode(_GEM_VALID_AZ09), html_entity_decode($passd), 6 );
            return false;
        }

        $seoInvalid = array('edit-profile', 'checkin', 'users-main');
        if (in_array($this->username, $seoInvalid)) {
            $this->_error = 'Requested username is not acceptable by the SEO system';
            return false;
        }

		if ((trim($this->email) == '') || (preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $this->email )==false)) {
			$this->_error = _GEM_REGWARN_MAIL;
			return false;
		}

		// check for existing username
		$lowuser = strtolower($this->username);
		$this->_db->setQuery( "SELECT id FROM #__users WHERE LOWER(username)='$lowuser' AND id!='$this->id'");
		$xid = intval( $this->_db->loadResult() );
		if ($xid && $xid != intval( $this->id )) {
			$this->_error = _GEM_REGWARN_INUSE;
			return false;
		}

		if ($mosConfig_uniquemail) { //check for existing email
			$this->_db->setQuery( "SELECT id FROM #__users WHERE email='$this->email' AND id!='$this->id'");
			$xid = intval( $this->_db->loadResult() );
			if ($xid && $xid != intval( $this->id )) {
				$this->_error = _GEM_REGWARN_EMAIL_INUSE;
				return false;
			}
		}

		//ensure user group is valid
		if ((!$my->id) && ($this->gid != 18)) {
			$this->_error = 'Forbiden user group!';
			return false;
		}
		if ($my->id) {
			$myarr = explode(',',$my->allowed);
			if (!in_array($this->gid, $myarr)) {
				$this->_error = 'Forbiden user group!';
				return false;
			}
		}

		return true;
	}


	public function store( $updateNulls=false ) {
		global $acl, $migrate;
		$section_value = 'users';

		$k = $this->_tbl_key;
		$key =  $this->$k;

		if( $key && !$migrate) {
			// existing record
			$ret = $this->_db->updateObject( $this->_tbl, $this, $this->_tbl_key, $updateNulls );
			// syncronise ACL
			// single group handled at the moment
			// trivial to expand to multiple groups
			$groups = $acl->get_object_groups( $section_value, $this->$k, 'ARO' );
			$acl->del_group_object( $groups[0], $section_value, $this->$k, 'ARO' );
			$acl->add_group_object( $this->gid, $section_value, $this->$k, 'ARO' );

			$object_id = $acl->get_object_id( $section_value, $this->$k, 'ARO' );
			$acl->edit_object( $object_id, $section_value, $this->_db->getEscaped( $this->name ), $this->$k, 0, 0, 'ARO' );
		} else {
			// new record
			$ret = $this->_db->insertObject( $this->_tbl, $this, $this->_tbl_key );

			// syncronise ACL
			$acl->add_object( $section_value, $this->_db->getEscaped( $this->name ), $this->$k, 0, 0, 'ARO' );
			$acl->add_group_object( $this->gid, $section_value, $this->$k, 'ARO' );
		}

		if( !$ret ) {
			$this->_error = strtolower(get_class( $this ))."::store failed " . $this->_db->getErrorMsg();
			return false;
		} else {
			return true;
		}
	}


	public function delete( $oid=null ) {
		global $acl;

		$k = $this->_tbl_key;
		if ($oid) {
			$this->$k = intval( $oid );
		}
		$aro_id = $acl->get_object_id( 'users', $this->$k, 'ARO' );
		
		//Elxis Note: uncommended inorder to delete user from aro tables also
		$acl->del_object( $aro_id, 'ARO', true ); 

		$this->_db->setQuery( "DELETE FROM $this->_tbl WHERE $this->_tbl_key = '".$this->$k."'" );

		if ($this->_db->query()) {
			// cleanup related data

			// :: private messaging
			$this->_db->setQuery( "DELETE FROM #__messages_cfg WHERE user_id='".$this->$k."'" );
			if (!$this->_db->query()) {
				$this->_error = $this->_db->getErrorMsg();
				return false;
			}
			$this->_db->setQuery( "DELETE FROM #__messages WHERE user_id_to='".$this->$k."'" );
			if (!$this->_db->query()) {
				$this->_error = $this->_db->getErrorMsg();
				return false;
			}

			return true;
		} else {
			$this->_error = $this->_db->getErrorMsg();
			return false;
		}
	}
}


/***************************/
/* TEMPLATE DB TABLE CLASS */
/***************************/
class mosTemplate extends mosDBTable {

	public $id=null;
	public $cur_template=null;
	public $col_main=null;


	public function mosTemplate( &$database ) {
		$this->mosDBTable( '#__templates', 'id', $database );
	}
}


/***************************/
/* COMMENTS DB TABLE CLASS */
/***************************/
class mosComments extends mosDBTable {

	public $cid = null;
	/* origin: 0: eblog, 1: elxis content item, 2 or greater: third party component */
	public $origin = null;
	public $articleid = null;
	public $cmessage = null;
	public $ctimestamp = null;
	public $ipaddress = null;
	public $userid = null;
	public $author = null;
	public $email = null;
	public $published = 1;
	public $notify = null;


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct(&$database) {
		global $my, $mainframe;

		$this->mosDBTable( '#__comments', 'cid', $database );
		if (!$this->cid) {
			$this->ctimestamp = time() + ($mainframe->getCfg('offset') * 3600);
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && strpos($_SERVER['HTTP_X_FORWARDED_FOR'],',')) {
				$tmp = explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);
				$this->ipaddress = $tmp[0];
			} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$this->ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$this->ipaddress = $_SERVER['REMOTE_ADDR'];
			}
			$this->userid = intval($my->id);
		}
	}


	/********************/
	/* CHECK INPUT DATA */
	/********************/
	public function check() {
		global $mainframe;

		$this->author = $mainframe->makesafe($this->author);

		if (!intval($this->articleid)) {
			$this->_error = 'The article you try to comment does not exist!';
			return false;	
		}
		if (trim($this->cmessage == '')) {
			$this->_error = 'You should write a comment!';
			return false;
		}
		if (eUTF::utf8_trim( $this->author ) == '') {
			$this->_error = _GEM_REGWARN_NAME;
			return false;
		}
		if ((trim($this->email) == '') || (preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $this->email )==false)) {
			$this->_error = _GEM_REGWARN_MAIL;
			return false;
		}
		return true;
	}
}


/**
* Utility function to return a value from a named array or a specified default
*/
define( "_MOS_NOTRIM", 0x0001 );
define( "_MOS_ALLOWHTML", 0x0002 );
define( "_MOS_ALLOWRAW", 0x0004 );
function mosGetParam( &$arr, $name, $def=null, $mask=0 ) {
	if (isset( $arr[$name] )) {
		if (is_array($arr[$name])) foreach ($arr[$name] as $key=>$element) mosGetParam ($arr[$name], $key, $def, $mask);
		else {
			if (!($mask&_MOS_NOTRIM)) $arr[$name] = eUTF::utf8_trim( $arr[$name] );
			if (!is_numeric( $arr[$name] )) {
				if (!($mask&_MOS_ALLOWHTML)) $arr[$name] = strip_tags( $arr[$name] );
				if (!($mask&_MOS_ALLOWRAW)) {
					if (is_numeric($def)) $arr[$name] = intval($arr[$name]);
				}
			}
		}
		return $arr[$name];
	} else {
		return $def;
	}
}

/**
* Strip slashes from strings or arrays of strings
* @param value the input string or array
*/
function mosStripslashes(&$value)
{
	$ret = '';
    if (is_string($value)) {
		$ret = stripslashes($value);
	} else {
	    if (is_array($value)) {
	        $ret = array();
	        while (list($key,$val) = each($value)) {
	            $ret[$key] = mosStripslashes($val);
	        } // while
	    } else {
	        $ret = $value;
		} // if
	} // if
    return $ret;
} // mosStripSlashes

/**
* Copy the named array content into the object as properties
* only existing properties of object are filled. when undefined in hash, properties wont be deleted
* @param array the input array
* @param obj byref the object to fill of any class
* @param string
* @param boolean
*/
function mosBindArrayToObject( $array, &$obj, $ignore='', $prefix=NULL, $checkSlashes=true ) {
	if (!is_array( $array ) || !is_object( $obj )) {
		return (false);
	}

	foreach (get_object_vars($obj) as $k => $v) {
		if( substr( $k, 0, 1 ) != '_' ) {			// internal attributes of an object are ignored
			if (strpos( $ignore, $k) === false) {
				if ($prefix) {
					$ak = $prefix . $k;
				} else {
					$ak = $k;
				}
				if (isset($array[$ak])) {
					$obj->$k = ($checkSlashes && get_magic_quotes_gpc()) ? mosStripslashes( $array[$k] ) : $array[$k];
				}
			}
		}
	}

	return true;
}


/********************/
/* REDIRECT BROWSER */
/********************/
function mosRedirect( $url, $msg='' ) {
	global $mainframe, $lang;
	
	$iFilter = new InputFilter();
	$url = $iFilter->process( $url );
	$msg = $iFilter->process( $msg );

	if ($iFilter->badAttributeValue( array( 'href', $url ))) {
		$url = $mainframe->getCfg('live_site');
	}

	if (!defined('_ELXIS_ADMIN')) {
		if (!(stripos($url, 'http://') === 0) && !(stripos($url, 'https://') === 0)) {
			if (($mainframe->getCfg('sef') == 2) && ($url == 'index.php')) { $url = ''; }
		
			if (($mainframe->getCfg('sef') == 2) && ($lang != $mainframe->getCfg('lang'))) {
				$isoL = eLOCALE::elxis_iso639($lang);
				if (($isoL != '') && (!preg_match('/^('.$isoL.'\/)/', $url))) {
					$url = $mainframe->getCfg('live_site').'/'.$isoL.'/'.$url;
				} else {
					$url = $mainframe->getCfg('live_site').'/'.$url;
				}
			} else if ($mainframe->getCfg('sef') == 2) {
				$url = $mainframe->getCfg('live_site').'/'.$url;
			}
		}
	}

	if (trim($msg)) {
	 	if (strpos( $url, '?' )) {
			$url .= '&mosmsg='.urlencode( $msg );
		} else {
			$url .= '?mosmsg='.urlencode( $msg );
		}
	}

	if (headers_sent()) {
		echo '<script type="text/javascript">document.location.href="'.$url.'";</script>'._LEND;
	} else {
		@ob_end_clean();
		header( "Location: $url" );
	}
	exit();
}


function mosTreeRecurse( $id, $indent, $list, &$children, $maxlevel=9999, $level=0, $type=1 ) {
	if (@$children[$id] && $level <= $maxlevel) {
		foreach ($children[$id] as $v) {
			$id = $v->id;
			$subsymbol = (_GEM_RTL) ? '&#8747;' : 'L';
			if ( $type ) {
				$pre 	= '<sup>'.$subsymbol.'</sup>&nbsp;';
				$spacer = '.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			} else {
				$pre 	= '- ';
				$spacer = '&nbsp;&nbsp;';
			}

			if ( $v->parent == 0 ) {
				$txt 	= $v->name;
			} else {
				$txt 	= $pre . $v->name;
			}
			$pt = $v->parent;
			$list[$id] = $v;
			$list[$id]->treename = "$indent$txt";
			$list[$id]->children = count( @$children[$id] );
			$list = mosTreeRecurse( $id, $indent . $spacer, $list, $children, $maxlevel, $level+1, $type );
		}
	}
	return $list;
}

/**
* Function to strip additional / or \ in a path name
* @param string The path
* @param boolean Add trailing slash
*/
//ELXIS: USE fmanager PathName

function mosPathName($p_path,$p_addtrailingslash = true) {
	$retval = "";

	$isWin = (substr(PHP_OS, 0, 3) == 'WIN');

	if ($isWin)	{
		$retval = str_replace( '/', '\\', $p_path );
		if ($p_addtrailingslash) {
			if (substr( $retval, -1 ) != '\\') {
				$retval .= '\\';
			}
		}
		// Remove double \\
		$retval = str_replace( '\\\\', '\\', $retval );
	} else {
		$retval = str_replace( '\\', '/', $p_path );
		if ($p_addtrailingslash) {
			if (substr( $retval, -1 ) != '/') {
				$retval .= '/';
			}
		}
		// Remove double //
		$retval = str_replace('//','/',$retval);
	}

	return $retval;
}

/**
* Class mosMambot
*/
class mosMambot extends mosDBTable {
	/** @var int */
	public $id=null;
	/** @public varchar */
	public $name=null;
	/** @public varchar */
	public $element=null;
	/** @public varchar */
	public $folder=null;
	/** @public tinyint unsigned */
	public $access=29;
	/** @public int */
	public $ordering=null;
	/** @public tinyint */
	public $published=null;
	/** @public tinyint */
	public $iscore=null;
	/** @public tinyint */
	public $client_id=null;
	/** @public int unsigned */
	public $checked_out=null;
	/** @public datetime */
	public $checked_out_time=null;
	/** @public text */
	public $params=null;

	function mosMambot( &$db ) {
		$this->mosDBTable( '#__mambots', 'id', $db );
	}
}

/**
* Module database table class
*/
class mosModule extends mosDBTable {
	/** @public int Primary key */
	public $id=null;
	/** @public string */
	public $title=null;
	/** @public string */
	public $showtitle=null;
	/** @public int */
	public $content=null;
	/** @public int */
	public $ordering=null;
	/** @public string */
	public $position=null;
	/** @public boolean */
	public $checked_out=null;
	/** @public time */
	public $checked_out_time=null;
	/** @public boolean */
	public $published=null;
	/** @public string */
	public $module=null;
	/** @public int */
	public $numnews=null;
	/** @public int */
	public $access=29;
	/** @public string */
	public $params=null;
	/** @public string */
	public $iscore=null;
	/** @public string */
	public $client_id=null;
	/** @public string */
	public $language=null;

	/**
	* @param database A database connector object
	*/
	function mosModule( &$db ) {
		$this->mosDBTable( '#__modules', 'id', $db );
	}
	// overloaded check function
	function check() {
		// check for valid name
		if (eUTF::utf8_trim( $this->title ) == '') {
			$this->_error = "Your Module must contain a title.";
			return false;
		}

		// limitation has been removed
		// check for existing title
		//$this->_db->setQuery( "SELECT id FROM #__modules"
		//. "\nWHERE title='$this->title'"
		//);
		// check for module of same name
		//$xid = intval( $this->_db->loadResult() );
		//if ($xid && $xid != intval( $this->id )) {
		//	$this->_error = "There is a module already with that name, please try again.";
		//	return false;
		//}
		return true;
	}
}

/**
* Session database table class
*/
class mosSession extends mosDBTable {
	/** @public int Primary key */
	public $session_id=null;
	/** @public string */
	public $time=null;
	/** @public string */
	public $userid=null;
	/** @public string */
	public $usertype=null;
	/** @public string */
	public $username=null;
	/** @public time */
	public $gid=null;
	/** @public string */
	public $allowed = null;
	/** @public int */
	public $guest=null;
	/** @public string */
	public $_session_cookie=null;
	/** @public string */
	public $ip = null;

	/**
	* @param database A database connector object
	*/
	function mosSession( &$db ) {
		$this->mosDBTable( '#__session', 'session_id', $db );
	}

	function insert() {
		$ret = $this->_db->insertObject( $this->_tbl, $this );

		if( !$ret ) {
			$this->_error = strtolower(get_class( $this ))."::store failed <br />" . $this->_db->stderr();
			return false;
		} else {
			return true;
		}
	}

	function update( $updateNulls=false ) {
		if ( !$this->guest ) { $this->guest = '0'; } //Note: changed from NULL to '0'
		$ret = $this->_db->updateObject( $this->_tbl, $this, 'session_id', $updateNulls );
		if( !$ret ) {
			$this->_error = strtolower(get_class( $this ))."::store failed <br />" . $this->_db->stderr();
			return false;
		} else {
			return true;
		}
	}

	function generateId() {
		$failsafe = 20;
		$randnum = 0;
		while ($failsafe--) {
			$randnum = md5( uniqid( microtime(), 1 ) );
			if ($randnum != "") {
				$cryptrandnum = md5( $randnum );
				$this->_db->setQuery( "SELECT $this->_tbl_key FROM $this->_tbl WHERE $this->_tbl_key='".MD5($randnum)."'" );
				if(!$result = $this->_db->query()) {
					die( $this->_db->stderr( true ));
					// todo: handle gracefully
				}
				if ($this->_db->getNumRows($result) == 0) {
					break;
				}
			}
		}
		$this->_session_cookie = $randnum;
		$this->session_id = md5( $randnum.$_SERVER['REMOTE_ADDR'] );
	}


	/******************/
	/* GET IP ADDRESS */
	/******************/
	//Notice: Don't use HTTP_X_FORWARDED_FOR as it can be spoofed
	function getIP() {
		if (@getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
			$ip = getenv("REMOTE_ADDR");
		} else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'],"unknown")) {
			$ip = $_SERVER['REMOTE_ADDR'];
		} else {
			$ip = '';
		}
		$this->ip = $ip;
	}


	function getCookie() {
		return $this->_session_cookie;
	}

	function purge( $inc=900 ) {
		global $mosConfig_offset;

		$past = time() + ($mosConfig_offset * 3600) - $inc;
		$pg = (preg_match('/postgre/i', $this->_db->_resource->databaseType)) ? 1 : 0;
		if ($pg) {
			$query = "DELETE FROM ".$this->_tbl." WHERE (time < ".$past."::VARCHAR)";
		} else {
			$query = "DELETE FROM ".$this->_tbl." WHERE (time < ".$past.")";
		}
		$this->_db->setQuery($query);

		return $this->_db->query();
	}
}


function mosObjectToArray($p_obj) {
	$retarray = null;
	if(is_object($p_obj)) {
		$retarray = array();
		foreach (get_object_vars($p_obj) as $k => $v) {
			if(is_object($v)) {
				$retarray[$k] = mosObjectToArray($v);
			} else {
				$retarray[$k] = $v;
			}
		}
	}
	return $retarray;
}
/**
* Checks the user agent string against known browsers
*/
function mosGetBrowser( $agent ) {
	require( "includes/agent_browser.php" );

	if (preg_match( "/msie[\/\sa-z]*([\d\.]*)/i", $agent, $m )
	&& !preg_match( "/webtv/i", $agent )
	&& !preg_match( "/omniweb/i", $agent )
	&& !preg_match( "/opera/i", $agent )) {
		// IE
		return "MS Internet Explorer $m[1]";
	} else if (preg_match( "/netscape.?\/([\d\.]*)/i", $agent, $m )) {
		// Netscape 6.x, 7.x ...
		return "Netscape $m[1]";
	} else if ( preg_match( "/mozilla[\/\sa-z]*([\d\.]*)/i", $agent, $m )
	&& !preg_match( "/gecko/i", $agent )
	&& !preg_match( "/compatible/i", $agent )
	&& !preg_match( "/opera/i", $agent )
	&& !preg_match( "/galeon/i", $agent )
	&& !preg_match( "/safari/i", $agent )) {
		// Netscape 3.x, 4.x ...
		return "Netscape $m[2]";
	} else {
		// Other
		$found = false;
		foreach ($browserSearchOrder as $key) {
			if (preg_match( "/$key.?\/([\d\.]*)/i", $agent, $m )) {
				$name = "$browsersAlias[$key] $m[1]";
				return $name;
				break;
			}
		}
	}
	return 'Unknown';
}

/**
* Checks the user agent string against known operating systems
*/
function mosGetOS( $agent ) {
	require( "includes/agent_os.php" );

	foreach ($osSearchOrder as $key) {
		if (preg_match( "/$key/i", $agent )) {
			return $osAlias[$key];
			break;
		}
	}
	return 'Unknown';
}

/**
* @param string SQL with ordering As value and 'name field' AS text
* @param integer The length of the truncated headline
*/
function mosGetOrderingList( $sql, $chop='30' ) {
	global $database;

	if (defined ('_ELXIS_ADMIN')) {
    	global $adminLanguage;
        $firstmsg = $adminLanguage->A_FIRST;
        $lastmsg = $adminLanguage->A_LAST;
    } else {
    	$firstmsg = 'first';
        $lastmsg = 'last';
    }
    
	$order = array();
	$database->setQuery( $sql );
	if (!($orders = $database->loadObjectList())) {
		if ($database->getErrorNum()) {
			echo $database->stderr();
			return false;
		} else {
			$order[] = mosHTML::makeOption( 1, $firstmsg );
			return $order;
		}
	}
	$order[] = mosHTML::makeOption( 0, '0 '.$firstmsg );
	for ($i=0, $n=count( $orders ); $i < $n; $i++) {

        if (eUTF::utf8_strlen($orders[$i]->text) > $chop) {
        	$text = eUTF::utf8_substr($orders[$i]->text,0,$chop)."...";
        } else {
        	$text = $orders[$i]->text;
        }

		$order[] = mosHTML::makeOption( $orders[$i]->value, $orders[$i]->value.' ('.$text.')' );
	}
	$order[] = mosHTML::makeOption( $orders[$i-1]->value+1, ($orders[$i-1]->value+1).' '.$lastmsg );

	return $order;
}

/**
* Makes a variable safe to display in forms
* Object parameters that are non-string, array, object or start with underscore
* will be converted
* @param object An object to be parsed
* @param int The optional quote style for the htmlspecialchars function
* @param string array An optional single field name or array of field names not to be parsed (eg, for a textarea)
*/
function mosMakeHtmlSafe( &$mixed, $quote_style=ENT_QUOTES, $exclude_keys='' ) {
	if (is_object( $mixed )) {
		foreach (get_object_vars( $mixed ) as $k => $v) {
			if (is_array( $v ) || is_object( $v ) || $v == NULL || substr( $k, 1, 1 ) == '_' ) {
				continue;
			}
			if (is_string( $exclude_keys ) && $k == $exclude_keys) {
				continue;
			} else if (is_array( $exclude_keys ) && in_array( $k, $exclude_keys )) {
				continue;
			}
			$mixed->$k = htmlspecialchars( $v, $quote_style );
		}
	}
}

/**
* Checks whether a menu option is within the users access level
* @param int Item id number
* @param string The menu option
* @param int The users group ID number
* @param database A database connector object
* @return boolean True if the visitor's group at least equal to the menu access
*/
function mosMenuCheck( $Itemid, $menu_option, $task, $gid ) {
	global $database, $my;
	$dblink="index.php?option=$menu_option";
	if ($Itemid!="" && $Itemid!=0) {
		$database->setQuery( "SELECT access FROM #__menu WHERE id='$Itemid'" );
	} else {
		if ($task != '') {
    		$task = $database->getEscaped($task);
			$dblink.="&task=$task";
		}
		$database->setQuery( "SELECT access FROM #__menu WHERE link like '$dblink%' GROUP BY access" );
	}
	$results = $database->loadObjectList();
	$access = 1;
	$allowedgroups = explode(',', $my->allowed);
	foreach ($results as $result) {
        if (!in_array($result->access, $allowedgroups)) {
            $access = 0;
        }
	}
    return $access;
}

/**
* Returns formated date according to current local and adds time offset
* @param string date in datetime format
* @param string format optional format for strftime
* @param offset time offset if different than global one
* @returns formated date
*/
function mosFormatDate($date, $format='', $offset='') {
	global $mosConfig_offset;

	if ($format == '') { $format = _GEM_DATE_FORMLC; } //%Y-%m-%d %H:%M:%S
	if ($offset == '') { $offset = $mosConfig_offset; }
	if ($date && preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})[\s]([0-9]{2}):([0-9]{2}):([0-9]{2})$/", $date, $regs)) {
		$date = mktime( $regs[4], $regs[5], $regs[6], $regs[2], $regs[3], $regs[1] );
		$date = $date > -1 ? eLOCALE::strftime_os( $format, $date + ($offset*60*60) ) : '-';
	}
	return $date;
}


/***************************/
/* CHECK DATETIME VALIDITY */
/***************************/
function checkDateTime($dateTime='') {
    if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $dateTime, $matches)) {
        if (checkdate($matches[2], $matches[3], $matches[1])) { return true; }
    }
    return false;
}


/**
* Returns current date according to current local and time offset
* @param string format optional format for strftime
* @returns current date
*/
function mosCurrentDate( $format="" ) {
	global $mosConfig_offset;

	if ($format=="") { $format = _GEM_DATE_FORMLC; }
	$date = eLOCALE::strftime_os( $format, time() + ($mosConfig_offset*3600) );
	return $date;
}


/********************/
/* WRITES A TOOLTIP */
/********************/
function mosToolTip($tooltip, $title='', $width='', $image='tooltip.png', $text='', $href='javascript:void(null);') {
	global $mainframe;

	$tooltip = str_replace('\'','\\\'',str_replace('\\\'','\'',$tooltip));
	$title = str_replace('\'','\\\'',str_replace('\\\'','\'',$title));
	if ($width) { $width = ', WIDTH, \''.$width .'\''; }
	if ($title) { $title = ', CAPTION, \'&nbsp; &nbsp;'.$title .'\''; }
	if (!$text ) {
		$image = $mainframe->getCfg('ssl_live_site').'/includes/js/ThemeOffice/'. $image;
		$text = '<img src="'.$image.'" border="0" alt="'.$title.'" />';
	} else {
		$text = str_replace('\'','\\\'',str_replace('\\\'','\'',$text));
	}
	$style = 'style="text-decoration: none; color: #333333;"';

	if ( $href ) { $style = ''; }
	$isrtl = (_GEM_RTL) ? 'LEFT' : 'RIGHT';
	$tip = "<a href=\"". $href ."\" onmouseover=\"return overlib('".$tooltip."'". $title .", BELOW, ". $isrtl.$width .");\" onmouseout=\"return nd();\" ". $style .">". $text ."</a>";
	return $tip;
}


/**
* Utility function to provide Warning Icons
* @param string Warning text
* @param string Box title
* @returns HTML code for Warning
*/
function mosWarning($warning, $title='Elxis Warning') {
	global $mainframe;

	$isrtl = (_GEM_RTL) ? 'LEFT' : 'RIGHT';
	$warning = str_replace('\'','\\\'',str_replace('\\\'','\'',$warning));
	$title = str_replace('\'','\\\'',str_replace('\\\'','\'',$title));
	$tip = "<a href=\"javascript:void(null);\" onmouseover=\"return overlib('".$warning."', CAPTION, ' &nbsp; ".$title."', BELOW, ".$isrtl.");\" onmouseout=\"return nd();\"><img src=\"" .$mainframe->getCfg('ssl_live_site')."/includes/js/ThemeOffice/warning.png\" border=\"0\" alt=\"".$title."\" /></a>";
	return $tip;
}

function mosCreateGUID(){
	srand((double)microtime()*1000000);
	$r = rand ;
	$u = uniqid(getmypid() . $r . (double)microtime()*1000000,1);
	$m = md5 ($u);
	return($m);
}

function mosCompressID( $ID ){
	return(base64_encode(pack("H*",$ID)));
}

function mosExpandID( $ID ) {
	return ( implode(unpack("H*",base64_decode($ID)), '') );
}


/************************/
/* PAGE GENERATION TIME */
/************************/
class mosProfiler {

	public $start=0;
	public $prefix='';

	public function mosProfiler($prf='') {
		self::$start = self::getmicrotime();
		self::$prefix = $prf;
	}

	static public function mark( $label ) {
		return sprintf ( "\n<div class=\"profiler\">".self::$prefix." %.3f ".$label."</div>", self::getmicrotime() - self::$start );
	}

	static public function getmicrotime() {
		list($usec, $sec) = explode(" ",microtime());
		return ((float)$usec + (float)$sec);
	}
}


/**
* Function to create a mail object for futher use (uses phpMailer)
* @param string From e-mail address
* @param string From name
* @param string E-mail subject
* @param string Message body
* @return object Mail object
*/
function mosCreateMail( $from='', $fromname='', $subject, $body, $lang='english' ) {
	global $mosConfig_absolute_path, $mosConfig_sendmail;
	global $mosConfig_smtpauth, $mosConfig_smtpuser;
	global $mosConfig_smtppass, $mosConfig_smtphost;
	global $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_mailer;

	$mail = new mosPHPMailer();

	$mail->PluginDir = $mosConfig_absolute_path.'/includes/phpmailer/';
	$mail->SetLanguage( $lang, $mosConfig_absolute_path.'/includes/phpmailer/language/' );
	$mail->CharSet 	= 'UTF-8';
	$mail->IsMail();
	$mail->From 	= $from ? $from : $mosConfig_mailfrom;
	$mail->FromName = $fromname ? $fromname : $mosConfig_fromname;
	$mail->Mailer 	= $mosConfig_mailer;

	// Add smtp values if needed
	if ( $mosConfig_mailer == 'smtp' ) {
		$mail->SMTPAuth = $mosConfig_smtpauth;
		$mail->Username = $mosConfig_smtpuser;
		$mail->Password = $mosConfig_smtppass;
		$mail->Host 	= $mosConfig_smtphost;
	} else

	// Set sendmail path
	if ( $mosConfig_mailer == 'sendmail' ) {
		if (isset($mosConfig_sendmail))
			$mail->Sendmail = $mosConfig_sendmail;
	} // if

	$mail->Subject 	= $subject;
	$mail->Body 	= $body;

	return $mail;
}

/**
* Mail function (uses phpMailer)
* @param string From e-mail address
* @param string From name
* @param string/array Recipient e-mail address(es)
* @param string E-mail subject
* @param string Message body
* @param boolean false = plain text, true = HTML
* @param string/array CC e-mail address(es)
* @param string/array BCC e-mail address(es)
* @param string/array Attachment file name(s)
* @param string/array Reply-to e-mail address
* @param string/array Reply-to name
*/
function mosMail($from, $fromname, $recipient, $subject, $body, $mode=0, $cc=NULL, $bcc=NULL, $attachment=NULL, $replyto=NULL, $replytoname=NULL, $lang='english' ) {
	global $mosConfig_debug;
	$mail = mosCreateMail( $from, $fromname, $subject, $body, $lang );

	// activate HTML formatted emails
	if ( $mode ) {
		$mail->IsHTML(true);
	}

	if( is_array($recipient) ) {
		foreach ($recipient as $to) {
			$mail->AddAddress($to);
		}
	} else {
		$mail->AddAddress($recipient);
	}
	if (isset($cc)) {
	    if( is_array($cc) )
	        foreach ($cc as $to) $mail->AddCC($to);
	    else
	        $mail->AddCC($cc);
	}
	if (isset($bcc)) {
	    if( is_array($bcc) )
	        foreach ($bcc as $to) $mail->AddBCC($to);
	    else
	        $mail->AddBCC($bcc);
	}
    if ($attachment) {
        if ( is_array($attachment) )
            foreach ($attachment as $fname) $mail->AddAttachment($fname);
        else
            $mail->AddAttachment($attachment);
    } // if
    if ($replyto) {
        if ( is_array($replyto) ) {
        	reset($replytoname);
            foreach ($replyto as $to) {
            	$toname = ((list($key, $value) = each($replytoname))
				? $value : "");
            	$mail->AddReplyTo($to, $toname);
            }
        } else
            $mail->AddReplyTo($replyto, $replytoname);
    }
	$mailssend = $mail->Send();

	if( $mosConfig_debug ) {
		//$mosDebug->message( "Mails send: $mailssend");
	}
	if( $mail->error_count > 0 ) {
		//$mosDebug->message( "The mail message $fromname <$from> about $subject to $recipient <b>failed</b><br /><pre>$body</pre>", false );
		//$mosDebug->message( "Mailer Error: " . $mail->ErrorInfo . "" );
	}
	return $mailssend;
} // mosMail

/**
* Initialise GZIP
*/
function initGzip() {
	global $mosConfig_gzip, $do_gzip_compress;
	$do_gzip_compress = FALSE;
	
	//zlib.output_compression and ob_gzhandler don't get along well so we'll check to make
	//that zlib.output_compression is not enable in the php.ini before turning on ob_gzhandler
	if ( $mosConfig_gzip == 1 && function_exists('ini_get') && is_callable('ini_get') && (int)ini_get('zlib.output_compression') != 1 ) {
		$phpver = phpversion();
		$useragent = mosGetParam( $_SERVER, 'HTTP_USER_AGENT', '' );
		$canZip = mosGetParam( $_SERVER, 'HTTP_ACCEPT_ENCODING', '' );

		if ( $phpver >= '4.0.4pl1' &&
				( strpos($useragent,'compatible') !== false ||
				  strpos($useragent,'Gecko')      !== false
				)
		   ) {
			if ( extension_loaded('zlib') ) {
				ob_start( 'ob_gzhandler' );
				return;
			}
		} else if ( $phpver > '4.0' ) {
			if ( strpos($canZip,'gzip') !== false ) {
				if (extension_loaded( 'zlib' )) {
					$do_gzip_compress = TRUE;
					ob_start();
					ob_implicit_flush(0);
					header('Content-Encoding: gzip');
					return;
				}
			}
		}
	}
	ob_start();
}

/**
* Perform GZIP
*/
function doGzip() {
	global $do_gzip_compress;
	if ( $do_gzip_compress ) {
		/**
		*Borrowed from php.net!
		*/
		$gzip_contents = ob_get_contents();
		ob_end_clean();

		$gzip_size = strlen($gzip_contents);
		$gzip_crc = crc32($gzip_contents);

		$gzip_contents = gzcompress($gzip_contents, 9);
		$gzip_contents = substr($gzip_contents, 0, strlen($gzip_contents) - 4);

		echo "\x1f\x8b\x08\x00\x00\x00\x00\x00";
		echo $gzip_contents;
		echo pack('V', $gzip_crc);
		echo pack('V', $gzip_size);
	} else {
		if (ob_get_length() > 0) { ob_end_flush(); }
	}
}

/**
* Random password generator
* @return password
*/
function mosMakePassword() {
	$salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$len = strlen($salt);
	$makepass="";
	mt_srand(10000000*(double)microtime());
	for ($i = 0; $i < 8; $i++)
	$makepass .= $salt[mt_rand(0,$len - 1)];
	return $makepass;
}

if (!function_exists('html_entity_decode')) {
	/**
	* html_entity_decode function for backward compatability in PHP
	* @param string
	* @param string
	*/
	function html_entity_decode ($string, $opt = ENT_COMPAT) {

		$trans_tbl = get_html_translation_table (HTML_ENTITIES);
		$trans_tbl = array_flip ($trans_tbl);

		if ($opt & 1) { // Translating single quotes
		// Add single quote to translation table;
		// doesn't appear to be there by default
		$trans_tbl["&apos;"] = "'";
		}

		if (!($opt & 2)) { // Not translating double quotes
		// Remove double quote from translation table
		unset($trans_tbl["&quot;"]);
		}

		return strtr ($string, $trans_tbl);
	}
}


/* Plugin handler */
class mosMambotHandler {

	/** @public array An array of functions in event groups */
	public $_events=null;
	/** @public array An array of lists */
	public $_lists=null;
	/** @public array An array of mambots */
	public $_bots=null;
	/** @public int Index of the mambot being loaded */
	public $_loading=null;


	public function __construct() {
		$this->_events = array();
	}

	/**
	* Loads all the bot files for a particular group
	* @param string The group name, relates to the sub-directory in the mambots directory
	*/
	function loadBotGroup( $group ) {
		global $database, $my, $mosConfig_absolute_path;
		global $_MAMBOTS;

		$group = trim( $group );
		$database->setQuery( "SELECT folder, element, published, ".$database->_resource->Concat('folder',"'/'",'element')." AS lookup"
		."\n FROM #__mambots"
		."\n WHERE published > 0 AND access IN (".$my->allowed.") AND folder='".$group."' ORDER BY ordering");
		if (!($bots = $database->loadObjectList())) {
			return false;
		}
		$n = count( $bots);
		for ($i = 0; $i < $n; $i++) {
			$path = $mosConfig_absolute_path.'/mambots/'.$bots[$i]->folder.'/'.$bots[$i]->element.'.php';
			if (file_exists( $path )) {
				$this->_loading = count( $this->_bots );
				$this->_bots[] = $bots[$i];
				require_once( $path );
				$this->_loading = null;
			}
		}
		return true;
	}


	/**
	* Registers a function to a particular event group
	* @param string The event name
	* @param string The function name
	*/
	public function registerFunction( $event, $function ) {
		$this->_events[$event][] = array( $function, $this->_loading );
	}

	/**
	* Makes a option for a particular list in a group
	* @param string The group name
	* @param string The list name
	* @param string The value for the list option
	* @param string The text for the list option
	*/
	function addListOption( $group, $listName, $value, $text='' ) {
		$this->_lists[$group][$listName][] = mosHTML::makeOption( $value, $text );
	}
	/**
	* @param string The group name
	* @param string The list name
	* @return array
	*/
	function getList( $group, $listName ) {
		return $this->_lists[$group][$listName];
	}
	/**
	* Calls all functions associated with an event group
	* @param string The event name
	* @param array An array of arguments
	* @param boolean True is unpublished bots are to be processed
	* @return array An array of results from each function call
	*/
	function trigger( $event, $args=null, $doUnpublished=false ) {
		$result = array();

		if ($args === null) {
			$args = array();
		}
		if ($doUnpublished) {
			// prepend the published argument
			array_unshift( $args, null );
		}
		if (isset( $this->_events[$event] )) {
			foreach ($this->_events[$event] as $func) {
				if (function_exists( $func[0] )) {
					if ($doUnpublished) {
						$args[0] = $this->_bots[$func[1]]->published;
						$result[] = call_user_func_array( $func[0], $args );
					} else if ($this->_bots[$func[1]]->published) {
						$result[] = call_user_func_array( $func[0], $args );
					}
				}
			}
		}
		return $result;
	}

	/**
	* Same as trigger but only returns the first event and
	* allows for a variable argument list
	* @param string The event name
	* @return array The result of the first function call
	*/
	function call( $event ) {
		$doUnpublished=false;

		$args = func_get_args();
		array_shift( $args );

		if (isset( $this->_events[$event] )) {
			foreach ($this->_events[$event] as $func) {
				if (function_exists( $func[0] )) {
					if ($this->_bots[$func[1]]->published) {
						return call_user_func_array( $func[0], $args );
					}
				}
			}
		}
		return null;
	}
}

/**
* Tab Creation handler
* @package Elxis
* @author Phil Taylor
* @ Ajax Tabs by Ioannis Sannos
*/
class mosTabs {
	/** @public int Use cookies */
	public $useCookies = 0;

	/**
	* Constructor
	* Includes files needed for displaying tabs and sets cookie options
	* @param int useCookies, if set to 1 cookie will hold last used tab between page refreshes
	*/
	public function __construct($useCookies=0) {
		global $mainframe;

		$isrtl = (_GEM_RTL) ? '-rtl' : '';
		echo "<link id=\"luna-tab-style-sheet\" type=\"text/css\" rel=\"stylesheet\" href=\"".$mainframe->getCfg('ssl_live_site'). "/includes/js/tabs/tabpane".$isrtl.".css\" />";
		echo "<script type=\"text/javascript\" src=\"".$mainframe->getCfg('ssl_live_site')."/includes/js/tabs/tabpane.js\"></script>";
		$this->useCookies = $useCookies;
	}


	/**
	* creates a tab pane and creates JS obj
	* @param string The Tab Pane Name
	*/
	function startPane($id){
		echo "<div class=\"tab-page\" id=\"".$id."\">";
		echo "<script type=\"text/javascript\">\n";
		echo "var tabPane1 = new WebFXTabPane( document.getElementById( \"".$id."\" ), ".$this->useCookies." )\n";
		echo "</script>\n";
	}

	//Ends Tab Pane
	function endPane() {
		echo "</div>\n";
	}

	/*
	* Creates a tab with title text and starts that tabs page
	* @param tabText - This is what is displayed on the tab
	* @param paneid - This is the parent pane to build this tab on
	*/
	function startTab( $tabText, $paneid ) {
		echo "<div class=\"tab-page\" id=\"".$paneid."\">\n";
		echo "<h2 class=\"tab\">".$tabText."</h2>\n";
		echo "<script type=\"text/javascript\">\n";
		echo "tabPane1.Task= \"\";\n";
		echo "tabPane1.addTabPage( document.getElementById( \"".$paneid."\" ) );\n";
		echo "</script>\n";
	}

	//Ends a tab page
	function endTab() {
		echo "</div>\n";
	}

	/*
	* Creates a tab with title text and starts that tabs page
	* @param tabText - This is what is displayed on the tab
	* @param paneid - This is the parent pane to build this tab on
	* @param aTask - This is the javascript function that initializes Ajax
	*/
	function startAjaxTab( $tabText, $paneid, $aTask='' ) {
		echo "<div class=\"tab-page\" id=\"".$paneid."\">\n";
		echo "<h2 class=\"tab\">".$tabText."</h2>\n";
		echo "<script type=\"text/javascript\">\n";
		echo "tabPane1.Task= \"".$aTask."\";\n";
		echo "tabPane1.addTabPage( document.getElementById( \"".$paneid."\" ) );\n";
		echo "</script>\n";
		echo "<div id=\"ajaxTab".$paneid."\">\n";
	}

	//Ends a tab page
	function endAjaxTab() {
		echo "</div></div>\n";
	}

}


//Common HTML Output Files
class mosAdminMenus {

	//build the select list for Menu Ordering
	static public function Ordering( &$row, $id ) {
		global $database;

		if ( $id ) {
			$order = mosGetOrderingList( "SELECT ordering AS value, name AS text FROM #__menu"
			. "\n WHERE menutype='". $row->menutype ."' AND parent='". $row->parent ."' AND published != '-2'"
			. "\n ORDER BY ordering");
			$ordering = mosHTML::selectList( $order, 'ordering', 'class="selectbox" size="1"', 'value', 'text', intval( $row->ordering ) );
		} else {
            $ordering = '<input type="hidden" name="ordering" value="'. $row->ordering .'" />';
            if (defined ('_ELXIS_ADMIN')) {
                global $adminLanguage;
                $ordering .= $adminLanguage->A_NEW_ITEM_LAST;
            } else {
                $ordering .= _CMN_NEW_ITEM_LAST;
            }
		}
		return $ordering;
	}

	//build the select list for access level
	static public function Access( &$row ) {
        global $acl, $my;

		//ensure user can't add group higher than themselves
		$my_groups = $acl->get_object_groups( 'users', $my->id, 'ARO' );
		if (is_array( $my_groups ) && count( $my_groups ) > 0) {
			$ex_groups = $acl->get_group_children( $my_groups[0], 'ARO', 'RECURSE' );
		} else {
			$ex_groups = array();
		}

		$gtree = $acl->get_group_children_tree( null, 'USERS', false );
		//remove users 'above' me
		$i = 0;
		while ($i < count( $gtree )) {
			if (in_array( $gtree[$i]->value, $ex_groups )) {
				array_splice( $gtree, $i, 1 );
			} else {
				$i++;
			}
		}

        /*
        if not in backend brunch he can not use backend groups
        so remove backend groups if user's group is not a backend group
        */
        $backgroups = $acl->get_group_parents( '25', 'ARO', 'RECURSE' );
        array_push($backgroups, 25);
        if ( !in_array( $my->gid, $backgroups )) {
        	$q = 0;
            while ($q < count( $gtree )) {
                if (in_array( $gtree[$q]->value, $backgroups )) {
                    array_splice( $gtree, $q, 1 );
                } else {
                    $q++;
                }
            }
        }

        if (defined('_ELXIS_ADMIN')) {
            global $adminLanguage;
            $tagtitle = $adminLanguage->A_ACCESS;
        } else {
            $tagtitle = _E_ACCESS_LEVEL;
        }
		$access = mosHTML::selectList( $gtree, 'access', 'id="access'.$row->id.'" class="selectbox" size="8" dir="ltr" title="'.$tagtitle.'"', 'value', 'text', intval( $row->access ) );
		return $access;
	}


	//build the select list for parent item
	static public function Parent( &$row ) {
		global $database;

		// get a list of the menu items
		$query = "SELECT * FROM #__menu WHERE menutype='".$row->menutype."' AND published <> -2 ORDER BY ordering";
		$database->setQuery( $query );
		$mitems = $database->loadObjectList();

		// establish the hierarchy of the menu
		$children = array();
		// first pass - collect children
		foreach ( $mitems as $v ) {
			$pt = $v->parent;
			$list = @$children[$pt] ? $children[$pt] : array();
			array_push( $list, $v );
			$children[$pt] = $list;
		}
		// second pass - get an indent list of the items
		$list = mosTreeRecurse( 0, '', array(), $children, 9999, 0, 0 );

		//assemble menu items to the array
		$mitems = array();
		
		if (defined ('_ELXIS_ADMIN')) {
			global $adminLanguage;
			$mitems[] = mosHTML::makeOption( '0', $adminLanguage->A_TOP );
		} else {
			$mitems[] = mosHTML::makeOption( '0', _CMN_TOP );
		}
		
		$this_treename = '';
		foreach ( $list as $item ) {
			if ( $this_treename ) {
				if ( $item->id != $row->id && eUTF::utf8_strpos( $item->treename, $this_treename ) === false) {
					$mitems[] = mosHTML::makeOption( $item->id, $item->treename );
				}
			} else {
				if ( $item->id != $row->id ) {
					$mitems[] = mosHTML::makeOption( $item->id, $item->treename );
				} else {
					$this_treename = "$item->treename/";
				}
			}
		}
		$parent = mosHTML::selectList( $mitems, 'parent', 'class="selectbox" size="1"', 'value', 'text', $row->parent );
		return $parent;
	}

	//build a radio button option for published state
	static public function Published( &$row ) {
		$published = mosHTML::yesnoRadioList( 'published', 'class="inputbox"', $row->published );
		return $published;
	}

	//build the link/url of a menu item
	static public function Link( &$row, $id, $link=NULL ) {
		if ( $id ) {
			if ( $link ) {
				$link = $row->link;
			} else {
				$link = $row->link .'&amp;Itemid='. $row->id;
			}
		} else {
			$link = NULL;
		}
		return $link;
	}

	//build the select list for target window
	static public function Target( &$row ) {
		$click[] = mosHTML::makeOption( '0', _GEM_PARNAV );
		$click[] = mosHTML::makeOption( '1', _GEM_NEWNAV );
		$click[] = mosHTML::makeOption( '2', _GEM_NEWNONAV );
		$target = mosHTML::selectList( $click, 'browserNav', 'class="selectbox" size="4"', 'value', 'text', intval( $row->browserNav ) );
		return $target;
	}

	//build the multiple select list for Menu Links/Pages
	static public function MenuLinks( &$lookup, $all=NULL, $none=NULL ) {
		global $database;

		// get a list of the menu items
		$database->setQuery( "SELECT * FROM #__menu"
		. "\n WHERE type != 'separator' AND link NOT LIKE '%tp:/%' AND published = '1'"
		. "\n ORDER BY menutype, parent, ordering");
		$mitems = $database->loadObjectList();
		$mitems_temp = $mitems;

		// establish the hierarchy of the menu
		$children = array();
		// first pass - collect children
		foreach ( $mitems as $v ) {
			$id = $v->id;
			$pt = $v->parent;
			$list = @$children[$pt] ? $children[$pt] : array();
			array_push( $list, $v );
			$children[$pt] = $list;
		}
		// second pass - get an indent list of the items
		$list = mosTreeRecurse( intval( $mitems[0]->parent ), '', array(), $children, 9999, 0, 0 );

		// Code that adds menu name to Display of Page(s)
		$text_count = "0";
		$mitems_spacer = $mitems_temp[0]->menutype;
		foreach ($list as $list_a) {
			foreach ($mitems_temp as $mitems_a) {
				if ($mitems_a->id == $list_a->id) {
					// Code that inserts the blank line that seperates different menus
					if ($mitems_a->menutype <> $mitems_spacer) {
						$list_temp[] = mosHTML::makeOption( -999, '----' );
						$mitems_spacer = $mitems_a->menutype;
					}
					$text = $mitems_a->menutype." | ".$list_a->treename;
					$list_temp[] = mosHTML::makeOption( $list_a->id, $text );
					if ( eUTF::utf8_strlen($text) > $text_count) {
						$text_count = eUTF::utf8_strlen($text);
					}
				}
			}
		}
		$list = $list_temp;

		$mitems = array();
		if ( $all ) {
			// prepare an array with 'all' as the first item
			if (defined ('_ELXIS_ADMIN')) {
				global $adminLanguage;
				$mitems[] = mosHTML::makeOption( 0, $adminLanguage->A_ALL );
			} else {
				$mitems[] = mosHTML::makeOption( 0, _E_ALL );
			}
			// adds space, in select box which is not saved
			$mitems[] = mosHTML::makeOption( -999, '----' );
		}
		if ( $none ) {
			// prepare an array with 'all' as the first item
			$mitems[] = mosHTML::makeOption( -999, _GEM_NONE );
			// adds space, in select box which is not saved
			$mitems[] = mosHTML::makeOption( -999, '----' );
		}
		// append the rest of the menu items to the array
		foreach ($list as $item) {
			$mitems[] = mosHTML::makeOption( $item->value, $item->text );
		}
		$pages = mosHTML::selectList( $mitems, 'selections[]', 'class="selectbox" size="26" multiple="multiple"', 'value', 'text', $lookup );
		return $pages;
	}


	/************************/
	/* CATEGORY SELECT LIST */
	/************************/
	static public function Category( &$menu, $id, $javascript='' ) {
		global $database;

		$pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;
		$ora = (in_array($database->_resource->databaseType, array('oci8', 'oci8po', 'oci805', 'oracle'))) ? 1 : 0;
		if ($pg) {
			$query = "SELECT c.id AS value, c.section AS id, ".$database->_resource->Concat('s.title', "' / '", 'c.title')." AS text"
			. "\n FROM #__sections s INNER JOIN #__categories c ON c.section = s.id::VARCHAR"
			. "\n WHERE s.scope = 'content' ORDER BY s.name, c.name";
		} else if ($ora) {
			$query = "SELECT c.id AS value, c.section AS id, ".$database->_resource->Concat('s.title', "' / '", 'c.title')." AS text"
			. "\n FROM #__sections s INNER JOIN #__categories c ON c.section = TO_CHAR(s.id)"
			. "\n WHERE s.scope = 'content' ORDER BY s.name, c.name";
		} else {
			$query = "SELECT c.id AS value, c.section AS id, ".$database->_resource->Concat('s.title', "' / '", 'c.title')." AS text"
			. "\n FROM #__sections s INNER JOIN #__categories c ON c.section = s.id"
			. "\n WHERE s.scope = 'content' ORDER BY s.name, c.name";
		}
		$database->setQuery( $query );
		$rows = $database->loadObjectList();

		$category = '';
		if ( $id ) {
			foreach ( $rows as $row ) {
				if ( $row->value == $menu->componentid ) { $category = $row->text; }
			}
			$category .= '<input type="hidden" name="componentid" value="'. $menu->componentid .'" />';
			$category .= '<input type="hidden" name="link" value="'. $menu->link .'" />';
		} else {
			$category = mosHTML::selectList( $rows, 'componentid', 'class="selectbox" size="10"'.$javascript, 'value', 'text' );
			$category .= '<input type="hidden" name="link" value="" />';
		}
		return $category;
	}


	//build the select list to choose a section
	static public function Section( &$menu, $id, $all=0 ) {
		global $database;

		$query = "SELECT s.id AS value, s.id AS id, s.title AS text FROM #__sections s"
		."\n WHERE s.scope = 'content' ORDER BY s.name";
		$database->setQuery( $query );
		if ( $all ) {
			if (defined ('_ELXIS_ADMIN')) {
				global $adminLanguage;
				$rows[] = mosHTML::makeOption( 0, $adminLanguage->A_ALL_SECTIONS );
			} else {
				$rows[] = mosHTML::makeOption( 0, _SEL_SECTION );
			}
			$rows = array_merge( $rows, $database->loadObjectList() );
		} else {
			$rows = $database->loadObjectList();
		}

		if ( $id ) {
			foreach ( $rows as $row ) {
				if ( $row->value == $menu->componentid ) {
					$section = $row->text;
				}
			}
			$section .= '<input type="hidden" name="componentid" value="'. $menu->componentid .'" />';
			$section .= '<input type="hidden" name="link" value="'. $menu->link .'" />';
		} else {
			$section = mosHTML::selectList( $rows, 'componentid', 'class="selectbox" size="10"', 'value', 'text' );
			$section .= '<input type="hidden" name="link" value="" />';
		}
		return $section;
	}


	/*************************/
	/* COMPONENT SELECT LIST */
	/*************************/
	static public function Component( &$menu, $id ) {
		global $database;

		$ora = (in_array($database->_resource->databaseType, array('oci8', 'oci8po', 'oci805', 'oracle'))) ? 1 : 0;
		if ($ora) {
			$query = "SELECT c.id AS value, c.name AS text, c.link FROM #__components c WHERE c.link IS NOT NULL ORDER BY c.name";
		} else {
			$query = "SELECT c.id AS value, c.name AS text, c.link FROM #__components c WHERE c.link <> '' ORDER BY c.name";
		}
		$database->setQuery( $query );
		$rows = $database->loadObjectList( );

		if ($id) {
			//existing component, just show name
			foreach ( $rows as $row ) {
				if ( $row->value == $menu->componentid ) { $component = $row->text; }
			}
			$component .= '<input type="hidden" name="componentid" value="'. $menu->componentid .'" />';
		} else {
			$component = mosHTML::selectList( $rows, 'componentid', 'class="selectbox" size="10" dir="ltr"', 'value', 'text' );
		}
		return $component;
	}


	/**********************/
	/* GET COMPONENT NAME */
	/**********************/
	static public function ComponentName( &$menu, $id ) {
		global $database;

		$ora = (in_array($database->_resource->databaseType, array('oci8', 'oci8po', 'oci805', 'oracle'))) ? 1 : 0;
		if ($ora) {
			$query = "SELECT c.id AS value, c.name AS text, c.link FROM #__components c WHERE c.link IS NOT NULL ORDER BY c.name";
		} else {
			$query = "SELECT c.id AS value, c.name AS text, c.link FROM #__components c WHERE c.link <> '' ORDER BY c.name";
		}
		$database->setQuery( $query );
		$rows = $database->loadObjectList();

		$component = 'Component';
		foreach ( $rows as $row ) {
			if ( $row->value == $menu->componentid ) { $component = $row->text; break; }
		}
		return $component;
	}


	/*********************/
	/* IMAGE SELECT LIST */
	/*********************/
	static public function Images( $name, &$active, $javascript=NULL, $directory=NULL ) {
		global $mainframe, $fmanager;

		if (defined ('_ELXIS_ADMIN')) {
        	global $adminLanguage;
        	$selimg = $adminLanguage->A_SELECT_IMAGE;
        } else { 
        	$selimg = '- '._E_SELIMAGE.' -';
        }

        if ( !$directory ) { $directory = '/images/stories'; }
		if ( !$javascript ) {
			$javascript = "onchange=\"javascript:if (document.forms[0].image.options[selectedIndex].value!='') {document.imagelib.src='../".$directory."/' + document.forms[0].image.options[selectedIndex].value} else {document.imagelib.src='../images/blank.png'}\"";
		}

		$imageFiles = $fmanager->listFiles($mainframe->getCfg('absolute_path').$directory);
		$images = array(  mosHTML::makeOption( '', $selimg ) );
		if ($imageFiles) {
			foreach ($imageFiles as $file) {
				if (preg_match('/((\.bmp)|(\.gif)|(\.jpg)|(\.png)|(\.jpeg))$/i', $file)) {
					$images[] = mosHTML::makeOption($file);
				}
			}
		}
		$images = mosHTML::selectList( $images, $name, 'class="selectbox" size="1" dir="ltr" '. $javascript, 'value', 'text', $active );
		return $images;
	}


	//build the select list for Ordering of a specified Table
	static public function SpecificOrdering( &$row, $id, $query, $neworder=0, $text = '' ) {
		global $database;

        /*
		if ( $neworder ) {
			$text = _CMN_NEW_ITEM_FIRST;
		} else {
			$text = _CMN_NEW_ITEM_LAST;
		}
        */
		if ( $id ) {
			$order = mosGetOrderingList( $query );
			$ordering = mosHTML::selectList( $order, 'ordering', 'class="selectbox" size="1"', 'value', 'text', intval( $row->ordering ) );
		} else {
			$ordering = '<input type="hidden" name="ordering" value="'. $row->ordering .'" />'. $text;
		}
		return $ordering;
	}

	//Select list of active users
	static public function UserSelect( $name, $active, $nouser=0, $javascript=NULL, $order='name' ) {
		global $database, $my;

		$query = "SELECT id AS value, name AS text FROM #__users WHERE block = '0' AND expires > '".date('Y-m-d H:i:s')."' ORDER BY ".$order;
		$database->setQuery( $query );
		if ( $nouser ) {
			if (defined ('_ELXIS_ADMIN')) {
        		global $adminLanguage;	  
				$users[] = mosHTML::makeOption('0', '- '.$adminLanguage->A_NO_USER.' -');
			} else {
				$users[] = mosHTML::makeOption('0', '- No User -');
			}
			$users = array_merge( $users, $database->loadObjectList() );
		} else {
			$users = $database->loadObjectList();
		}

		$users = mosHTML::selectList( $users, $name, 'class="selectbox" size="1" '. $javascript, 'value', 'text', $active );

		return $users;
	}

	//Select list of positions - generally used for location of images
	static public function Positions( $name, $active=NULL, $javascript=NULL, $none=1, $center=1, $left=1, $right=1 ) {
		if ( $none ) {
			$pos[] = mosHTML::makeOption( '', _GEM_NONE );
		}
		if ( $center ) {
			$pos[] = mosHTML::makeOption( 'center', _GEM_CENTER );
		}
		if ( $left ) {
			$pos[] = mosHTML::makeOption( 'left', _GEM_LEFT );
		}
		if ( $right ) {
			$pos[] = mosHTML::makeOption( 'right', _GEM_RIGHT );
		}
		$positions = mosHTML::selectList( $pos, $name, 'class="selectbox" size="1"'. $javascript, 'value', 'text', $active );
		
		return $positions;
	}


	/****************************************/
	/* COMPONENTS CATEGORIES ACTIVE LIST    */
	/* also used in frontend (com_weblinks) */
	/****************************************/
	static public function ComponentCategory( $name, $section, $active=NULL, $javascript=NULL, $order='ordering', $size=1, $sel_cat=1 ) {
		global $database, $my;

		if (defined ('_ELXIS_ADMIN')) {
        	global $adminLanguage;
        	$selcatmsg = $adminLanguage->A_ALL_CATEGORIES;
            $createcatmsg = $adminLanguage->A_CREATE_CAT;
            $redLink = 'index2.php?option=com_categories&section='.$section;
            $where = '';
        } else {
        	$selcatmsg = _SEL_CATEGORY;
            $createcatmsg = _NO_CATEGORIES;
            $redLink = sefRelToAbs('index.php');
            $where = " AND access IN (".$my->allowed.")";
        }

		$query = "SELECT id AS value, name AS text FROM #__categories"
		. "\n WHERE section = '".$section."' AND published = '1'".$where
		. "\n ORDER BY ".$order;
		$database->setQuery( $query );
		if ( $sel_cat ) {
			$categories[] = mosHTML::makeOption( '0', $selcatmsg );
			$categories = array_merge( $categories, $database->loadObjectList() );
		} else {
			$categories = $database->loadObjectList();
		}

		if ( count( $categories ) < 1 ) { mosRedirect( $redLink, $createcatmsg ); }

		$category = mosHTML::selectList( $categories, $name, 'class="selectbox" size="'. $size .'" '. $javascript, 'value', 'text', $active );
		return $category;
	}


	//Select list of active sections
	static public function SelectSection( $name, $active=NULL, $javascript=NULL, $order='ordering', $allmsg='- All Sections -' ) {
		global $database;

		$categories[] = mosHTML::makeOption( '0', $allmsg );
		$query = "SELECT id AS value, title AS text FROM #__sections WHERE published = '1' ORDER BY ".$order;
		$database->setQuery( $query );
		$sections = array_merge( $categories, $database->loadObjectList() );

		$category = mosHTML::selectList( $sections, $name, 'class="selectbox" size="1" '. $javascript, 'value', 'text', $active );

		return $category;
	}

	//Select list of menu items for a specific menu
	static public function Links2Menu( $type, $and ) {
		global $database;

		$query = "SELECT * FROM #__menu WHERE type = '".$type."'"
		."\n AND published = '1'"
		. $and;
		$database->setQuery( $query );
		$menus = $database->loadObjectList();

		return $menus;
	}


	/*********************************/
	/* CREATE A SELECT LIST OF MENUS */
	/*********************************/
	static public function MenuSelect( $name='menuselect', $javascript=NULL ) {
		global $database;

		$database->setQuery("SELECT params FROM #__modules WHERE module = 'mod_mainmenu'");
		$menus = $database->loadObjectList();
		$total = count( $menus );
		$menuselect = array();
		for( $i = 0; $i < $total; $i++ ) {
			$menuselect[$i] = new stdClass();
			$params = mosParseParams( $menus[$i]->params );
			$menuselect[$i]->value = $params->menutype;
			$menuselect[$i]->text = $params->menutype;
		}

		//sort array of objects
		SortArrayObjects($menuselect, 'text', 1);
		$menus = mosHTML::selectList($menuselect, $name, 'class="selectbox" size="10" '. $javascript, 'value', 'text');

		return $menus;
	}


	/**
	* Internal function to recursive scan the media manager directories
	* @param string Path to scan
	* @param string root path of this folder
	* @param array  Value array of all existing folders
	* @param array  Value array of all existing images
	* ALPHA: USED IF FRONTEND ALSO
	*/
	static public function ReadImages( $imagePath, $folderPath, &$folders, &$images ) {
	  	global $fmanager;
	  	$imgFiles = $fmanager->listFiles( $imagePath );
	  	$imgFolders = $fmanager->listFolders( $imagePath.'/' );
		$imgAll = array_merge($imgFiles, $imgFolders);

		foreach ($imgAll as $file) {
			$ff_ = $folderPath . $file .'/';
			$ff = $folderPath . $file;
			$i_f = $imagePath .'/'. $file;

			if ( is_dir( $i_f ) && $file <> '.svn' ) {
				$folders[] = mosHTML::makeOption( $ff_ );
				mosAdminMenus::ReadImages( $i_f, $ff_, $folders, $images );
			} else if (preg_match('/((\.bmp)|(\.gif)|(\.jpg)|(\.png)|(\.jpeg))$/i', $file) && is_file($i_f)) {
				//remove leading leading /
				$imageFile = substr( $ff, 1 );
				$images[$folderPath][] = mosHTML::makeOption( $imageFile, $file );
			}
		}
	}

	static public function GetImageFolders( &$folders, $path ) {
		$javascript = "onchange=\"changeDynaList( 'imagefiles', folderimages, document.adminForm.folders.options[document.adminForm.folders.selectedIndex].value, 0, 0);  previewImage( 'imagefiles', 'view_imagefiles', '$path/' );\"";
		$getfolders = mosHTML::selectList( $folders, 'folders', 'class="selectbox" size="1" dir="ltr" '. $javascript, 'value', 'text', '/' );
		return $getfolders;
	}

	static public function GetImages( &$images, $path ) {
		if ( !isset($images['/'] ) ) {
			$images['/'][] = mosHTML::makeOption( '' );
		}

		//$javascript	= "onchange=\"previewImage( 'imagefiles', 'view_imagefiles', '$path/' )\" onfocus=\"previewImage( 'imagefiles', 'view_imagefiles', '$path/' )\"";
		$javascript	= "onchange=\"previewImage( 'imagefiles', 'view_imagefiles', '$path/' )\"";
		$getimages	= mosHTML::selectList( $images['/'], 'imagefiles', 'class="selectbox" size="10" dir="ltr" multiple="multiple" '. $javascript , 'value', 'text', null );

		return $getimages;
	}

	static public function GetSavedImages( &$row, $path ) {
		$images2 = array();
		foreach( $row->images as $file ) {
			$temp = explode( '|', $file );
			if( strrchr($temp[0], '/') ) {
				$filename = eUTF::utf8_substr( strrchr($temp[0], '/' ), 1 );
			} else {
				$filename = $temp[0];
			}
			$images2[] = mosHTML::makeOption( $file, $filename );
		}
		//$javascript	= "onchange=\"previewImage( 'imagelist', 'view_imagelist', '$path/' ); showImageProps( '$path/' ); \" onfocus=\"previewImage( 'imagelist', 'view_imagelist', '$path/' )\"";
		$javascript	= "onchange=\"previewImage( 'imagelist', 'view_imagelist', '$path/' ); showImageProps( '$path/' ); \"";
		$imagelist 	= mosHTML::selectList( $images2, 'imagelist', 'class="selectbox" size="10" dir="ltr" '. $javascript, 'value', 'text' );

		return $imagelist;
	}


    /********************************/
    /* MULTIPLE LANGUAGES SELECTION */
    /********************************/
	static public function SelectLanguages( $name='language', $inlangs, $alt='- All languages -' ) {    
		global $mosConfig_pub_langs;

        $langs = explode(',', $inlangs); //convert input language string to array
        $plangs = explode(',', $mosConfig_pub_langs); //published languages
        if (defined('_ELXIS_ADMIN')) {
            global $adminLanguage;
            $tagtitle = $adminLanguage->A_LANGUAGE;
        } else {
            $tagtitle = _E_LANGUAGE;
        }
		$sellangs = '<select name="'.$name.'[]" size="5" class="selectbox" multiple="multiple" dir="ltr" title="'.$tagtitle.'">'._LEND;
        $sellangs .= '<option value=""';
	    if ( trim($inlangs) == '' ) { $sellangs .= ' selected="selected"'; }
        $sellangs .= '>'.$alt.'</option>'._LEND;

		foreach ( $plangs as $plang ) {
	    	$sellangs .= '<option value="'.$plang.'"';
			if ( trim($inlangs) != '' ) {    
				 if (in_array($plang, $langs)) { $sellangs .= ' selected="selected"'; }
            }
	        $sellangs .= '>'.$plang.'</option>'._LEND;
        }
        $sellangs .= '</select>'._LEND;
		return $sellangs;
	}


	/**
	* Checks to see if an image exists in the current templates image directory
 	* if it does it loads this image.  Otherwise the default image is loaded.
	* Also can be used in conjunction with the menulist param to create the chosen image
	* load the default or use no image
	*/
	public static function ImageCheck( $file, $directory='/images/M_images/', $param=NULL, $param_directory='/images/M_images/', $alt=NULL, $name='image', $type=1, $align='middle' ) {
		global $mainframe;

		if ($param) {
			$image = $mainframe->getCfg('ssl_live_site').$param_directory.$param;
			if ($type) {
				$image = '<img src="'.$image.'" align="'.$align.'" alt="'.$alt.'" title="'.$alt.'" name="'.$name.'" border="0" />';
			}
		} else if ( $param == -1 ) {
			$image = '';
		} else {
			$cur_template = $mainframe->getTemplate();
			if (file_exists($mainframe->getCfg('absolute_path').'/templates/'.$cur_template.'/images/'.$file)) {
				$image = $mainframe->getCfg('ssl_live_site').'/templates/'.$cur_template.'/images/'.$file;
			} else {
				//outputs only path to image
				$image = $mainframe->getCfg('ssl_live_site').$directory.$file;
			}

			//outputs actual html <img> tag
			if ($type) {
				$image = '<img src="'.$image.'" alt="'.$alt.'" title="'.$alt.'" align="'.$align.'" name="'.$name.'" border="0" />';
			}
		}
		return $image;
	}


	/**
	* Checks to see if an image exists in the current templates image directory
 	* if it does it loads this image.  Otherwise the default image is loaded.
	* Also can be used in conjunction with the menulist param to create the chosen image
	* load the default or use no image
	*/
	public static function ImageCheckAdmin($file, $directory='/administrator/images/', $param=NULL, $param_directory='/administrator/images/', $alt=NULL, $name=NULL, $type=1, $align='middle' ) {
		global $mainframe;

		if ($param) {
			$image = $mainframe->getCfg('ssl_live_site'). $param_directory.$param;
			if ($type) {
				$image = '<img src="'.$image.'" align="'.$align.'" alt="'.$alt.'" title="'.$alt.'" name="'.$name.'" border="0" />';
			}
		} else if ($param == -1) {
			$image = '';
		} else {
			$cur_template = $mainframe->getTemplate();
			if ( file_exists($mainframe->getCfg('absolute_path').'/administrator/templates/admin/'.$cur_template.'/images/'.$file)) {
				$image = $mainframe->getCfg('ssl_live_site') .'/administrator/templates/admin/'.$cur_template.'/images/'.$file;
			} else {
				$image = $mainframe->getCfg('ssl_live_site'). $directory . $file;
			}
			// outputs actual html <img> tag
			if ( $type ) {
				$image = '<img src="'.$image.'" alt="'.$alt.'" title="'.$alt.'" align="'.$align.'" name="'.$name.'" border="0" />';
			}
		}
		return $image;
	}

	static public function menutypes() {
		global $database;

		$database->setQuery("SELECT params FROM #__modules WHERE module = 'mod_mainmenu' ORDER BY title");
		$modMenus = $database->loadObjectList();

		$database->setQuery("SELECT menutype FROM #__menu GROUP BY menutype ORDER BY menutype");
		$menuMenus = $database->loadObjectList();

		$menuTypes = '';
		foreach ( $modMenus as $modMenu ) {
			$check = 1;
			mosMakeHtmlSafe( $modMenu) ;
			$modParams 	= mosParseParams( $modMenu->params );
			$menuType 	= @$modParams->menutype;
			if (!$menuType) {
				$menuType = 'mainmenu';
			}

			// stop duplicate menutype being shown
			if ( !is_array( $menuTypes) ) {
				// handling to create initial entry into array
				$menuTypes[] = $menuType;
			} else {
				$check = 1;
				foreach ( $menuTypes as $a ) {
					if ( $a == $menuType ) {
						$check = 0;
					}
				}
				if ( $check ) {
					$menuTypes[] = $menuType;
				}
			}

		}
		// add menutypes from mos_menu
		foreach ( $menuMenus as $menuMenu ) {
			$check = 1;
			foreach ( $menuTypes as $a ) {
				if ( $a == $menuMenu->menutype ) {
					$check = 0;
				}
			}
			if ( $check ) {
				$menuTypes[] = $menuMenu->menutype;
			}
		}
		// sorts menutypes
		asort( $menuTypes );

		return $menuTypes;
	}

	//loads files required for menu items
	static public function menuItem( $item ) {
		global $mosConfig_absolute_path;
        
        if (trim($item != '')) {
    		$path = $mosConfig_absolute_path .'/administrator/components/com_menus/'. $item .'/';
    		@include_once( $path . $item .'.class.php' );
    		@include_once( $path . $item .'.menu.html.php' );
    	}
	}
}


class mosCommonHTML {

	static public function ContentLegend() {
?>
		<table cellspacing="0" cellpadding="4" border="0" align="center">
		<tr>
			<td align="center"><img src="images/publish_y.png" border="0" alt="<?php echo _GEM_PENDING; ?>" title="<?php echo _GEM_PENDING; ?>" /></td>
			<td align="center"><?php echo _GEM_PUBLISHED_PEND; ?> |</td>
			<td align="center"><img src="images/publish_g.png" border="0" alt="<?php echo _GEM_VISIBLE; ?>" title="<?php echo _GEM_VISIBLE; ?>" /></td>
			<td align="center"><?php echo _GEM_PUBLISHED_CURRENT; ?> |</td>
			<td align="center"><img src="images/publish_r.png" border="0" alt="<?php echo _GEM_INVISIBLE; ?>" title="<?php echo _GEM_INVISIBLE; ?>" /></td>
			<td align="center"><?php echo _GEM_PUBLISHED_EXPIRED; ?> |</td>
			<td align="center"><img src="images/publish_x.png" border="0" alt="<?php echo _GEM_INVISIBLE; ?>" title="<?php echo _GEM_INVISIBLE; ?>" /></td>
			<td align="center"><?php echo _GEM_PUBLISHED_NOT; ?></td>
		</tr>
		<tr>
			<td colspan="8" align="center"><?php echo _GEM_TOGGLE_STATE; ?></td>
		</tr>
		</table>
<?php 
	}


	static public function menuLinksContent( &$menus ) {
	  global $adminLanguage; //loaded only in backend
?>
		<script type="text/javascript">
		<!--
		function go2( pressbutton, menu, id ) {
			var form = document.adminForm;

			if (pressbutton == 'go2menu') {
				form.menu.value = menu;
				submitform( pressbutton );
				return;
			}

			if (pressbutton == 'go2menuitem') {
				form.menu.value 	= menu;
				form.menuid.value 	= id;
				submitform( pressbutton );
				return;
			}
		}
		//-->
		</script>
<?php 
		foreach( $menus as $menu ) {
?>
			<tr>
				<td colspan="2"><hr /></td>
			</tr>
			<tr>
				<td width="90" valign="top"><?php echo $adminLanguage->A_MENU; ?></td>
				<td>
				<a href="javascript:go2( 'go2menu', '<?php echo $menu->menutype; ?>' );" title="Go to Menu"><?php echo $menu->menutype; ?></a>
				</td>
			</tr>
			<tr>
				<td width="90" valign="top"><?php echo $adminLanguage->A_LINKNAME; ?></td>
				<td>
				<strong><a href="javascript:go2( 'go2menuitem', '<?php echo $menu->menutype; ?>', '<?php echo $menu->id; ?>' );" title="Go to Menu Item">
				<?php echo $menu->name; ?></a></strong>
				</td>
			</tr>
			<tr>
				<td width="90" valign="top"><?php echo $adminLanguage->A_STATE; ?></td>
				<td>
				<?php
				switch ( $menu->published ) {
					case -2:
						echo '<span style="color:red;">'.$adminLanguage->A_TRASHED.'</span>';
						break;
					case 0:
						echo $adminLanguage->A_UNPUBLISHED;
						break;
					case 1:
					default:
						echo '<span style="color:green;">'.$adminLanguage->A_PUBLISHED.'</span>';
						break;
				}
				?>
				</td>
			</tr>
<?php
		}
?>
		<input type="hidden" name="menu" value="" />
		<input type="hidden" name="menuid" value="" />
		<?php
	}

	static public function menuLinksSecCat( &$menus ) {
	  global $adminLanguage; //used only in backend
?>
		<script type="text/javascript">
		<!--
		function go2( pressbutton, menu, id ) {
			var form = document.adminForm;

			if (pressbutton == 'go2menu') {
				form.menu.value = menu;
				submitform( pressbutton );
				return;
			}

			if (pressbutton == 'go2menuitem') {
				form.menu.value 	= menu;
				form.menuid.value 	= id;
				submitform( pressbutton );
				return;
			}
		}
		//-->
		</script>
		<?php
		foreach( $menus as $menu ) {
			?>
			<tr>
				<td colspan="2"><hr/></td>
			</tr>
			<tr>
				<td width="90" valign="top"><?php echo $adminLanguage->A_MENU; ?></td>
				<td>
				<a href="javascript:go2( 'go2menu', '<?php echo $menu->menutype; ?>' );" title="Go to Menu"><?php echo $menu->menutype; ?></a>
				</td>
			</tr>
			<tr>
				<td width="90" valign="top"><?php echo $adminLanguage->A_TYPE; ?></td>
				<td><?php echo $menu->type; ?></td>
			</tr>
			<tr>
				<td width="90" valign="top"><?php echo $adminLanguage->A_ITEMNAME; ?></td>
				<td>
				<b><a href="javascript:go2( 'go2menuitem', '<?php echo $menu->menutype; ?>', '<?php echo $menu->id; ?>' );" title="Go to Menu Item">
				<?php echo $menu->name; ?></a></b>
				</td>
			</tr>
			<tr>
				<td width="90" valign="top"><?php echo $adminLanguage->A_STATE; ?></td>
				<td>
				<?php
				switch ( $menu->published ) {
					case -2:
						echo '<span style="color:red;">'.$adminLanguage->A_TRASHED.'</span>';
						break;
					case 0:
						echo $adminLanguage->A_UNPUBLISHED;
						break;
					case 1:
					default:
						echo '<span style="color:green;">'.$adminLanguage->A_PUBLISHED.'</span>';
						break;
				}
				?>
				</td>
			</tr>
			<?php
		}
		?>
		<input type="hidden" name="menu" value="" />
		<input type="hidden" name="menuid" value="" />
		<?php
	}

	static public function checkedOut( &$row, $overlib=1 ) {
		$hover = '';
		if ( $overlib ) {
			$date 				= mosFormatDate( $row->checked_out_time, '%A, %d %B %Y' );
			$time				= mosFormatDate( $row->checked_out_time, '%H:%M' );
			$checked_out_text 	= '<table>';
			$checked_out_text 	.= '<tr><td>'. $row->editor .'</td></tr>';
			$checked_out_text 	.= '<tr><td>'. $date .'</td></tr>';
			$checked_out_text 	.= '<tr><td>'. $time .'</td></tr>';
			$checked_out_text 	.= '</table>';
			$isrtl = (_GEM_RTL) ? 'LEFT' : 'RIGHT';
			$hover = ' onmouseover="return overlib(\''. $checked_out_text .'\', CAPTION, \'Checked Out\', BELOW, '.$isrtl.');" onmouseout="return nd();"';
		}
		$checked = '<img src="images/checked_out.png"'.$hover.' />';
		return $checked;
	}


	/**********************/
	/* LOAD OVERLIB FILES */
	/**********************/
	public static function loadOverlib() {
		global $mainframe;
?>
		<script type="text/javascript" src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/includes/js/overlib_mini.js"></script>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
<?php 
	}


	/***********************/
	/* LOAD CALENDAR FILES */
	/***********************/
	public static function loadCalendar() {
		global $mainframe;

		if (defined('elxcalincl')) { return; }
		define('elxcalincl', 1);
		$lng = (defined('_ELXIS_ADMIN')) ? $GLOBALS['alang'] : $GLOBALS['lang'];
		$lh = 1;
		if (headers_sent() || (ob_get_length() > 0)) { $lh = 0; }
		if (!file_exists($mainframe->getCfg('absolute_path').'/includes/js/calendar/lang/calendar-'.$lng.'.js')) { $lng = 'english'; }
		$baseurl = $mainframe->getCfg('ssl_live_site').'/includes/js/calendar';
		if ($lh === 0) {
			echo '<script type="text/javascript">document.write(\'<link rel="stylesheet" type="text/css" media="all" href="'.$baseurl.'/calendar-mos.css" />\');</script>'."\n";
			echo '<script type="text/javascript" src="'.$baseurl.'/calendar.js"></script>'."\n";
			echo '<script type="text/javascript" src="'.$baseurl.'/lang/calendar-'.$lng.'.js"></script>'."\n";
		} else {
			$mainframe->addCustomHeadTag('<link rel="stylesheet" type="text/css" media="all" href="'.$baseurl.'/calendar-mos.css" />');
			$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.$baseurl.'/calendar.js"></script>');
			$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.$baseurl.'/lang/calendar-'.$lng.'.js" charset="utf-8"></script>');
		}
	}


	public static function AccessProcessing( &$row, $i ) {
        global $acl;

        if ($row->access == 29) {
            $color_access = 'style="color: green;"';
        } else {
            $backgroups = $acl->get_group_parents( '25', 'ARO', 'RECURSE' );
            array_push($backgroups, 25);        
            if (in_array($row->access, $backgroups)) {
                $color_access = 'style="color: red;"';
            } else {
                $color_access = 'style="color: orange;"';
            }
        }

 		$href = '<a href="javascript: void(null);" onclick="javascript:showLayer(\'accesswin'.$i.'\')" '. $color_access .'>'.$row->groupname.'</a>';
		return $href;
	}


	static public function CheckedOutProcessing( &$row, $i ) {
		global $my;

		if ( $row->checked_out ) {
			$checked = mosCommonHTML::checkedOut( $row );
		} else {
			$checked = mosHTML::idBox( $i, $row->id, ($row->checked_out && $row->checked_out != $my->id ) );
		}

		return $checked;
	}

	static public function PublishedProcessing( &$row, $i, $pubmsg='Published', $unpubmsg='Unpublished' ) {
		$img 	= $row->published ? 'publish_g.png' : 'publish_x.png';
		$task 	= $row->published ? 'unpublish' : 'publish';
		$alt 	= $row->published ? $pubmsg : $unpubmsg;
		$action	= $row->published ? _GEM_UNPUBL_ITEM : _GEM_PUBL_ITEM;

		$href = '<a href="javascript: void(null);" onclick="return listItemTask(\'cb'. $i .'\',\''. $task .'\')" title="'. $action .'">
		<img src="images/'.$img.'" border="0" alt="'.$alt.'" /></a>';
		return $href;
	}
}

//Sorts an Array of objects
function SortArrayObjects_cmp( &$a, &$b ) {
	global $csort_cmp;

	if ( $a->$csort_cmp['key'] > $b->$csort_cmp['key'] ) {
		return $csort_cmp['direction'];
	}

	if ( $a->$csort_cmp['key'] < $b->$csort_cmp['key'] ) {
		return -1 * $csort_cmp['direction'];
	}
	return 0;
}

/**
* Sorts an Array of objects
* sort_direction [1 = Ascending] [-1 = Descending]
*/
function SortArrayObjects( &$a, $k, $sort_direction=1 ) {
	global $csort_cmp;

	$csort_cmp = array (
		'key' => $k,
		'direction' => $sort_direction
	);

	usort( $a, 'SortArrayObjects_cmp' );
	unset( $csort_cmp );
}


/**********************************/
/* SEND MAIL TO ADMIN (front-end) */
/**********************************/
function mosSendAdminMail( $adminName, $adminEmail, $email, $type, $title, $author, $plang='' ) {
	global $mosConfig_live_site, $_VERSION, $mosConfig_sitename;

	$curdate = date('Y-m-d H:i:s');
	if ($_VERSION->PRODUCT != 'E'.'l'.'x'.'i'.'s') { die(); }

	$prlang = new prefLang();
	$prlang->load($plang);

	$subject = $prlang->lng->_MAIL_SUB.' '.$type;

	$message = $prlang->lng->_E_HI." ".$adminName.",\n";
	$message .= sprintf($prlang->lng->_E_NEWSUBBY, $author)."\n";
	$message .= $prlang->lng->_E_TYPESUB." ".$type."\n";
	$message .= $prlang->lng->_E_TITLE.": ".$title."\n";
	$message .= $prlang->lng->_DATE.":". mosFormatDate($curdate)."\n";
	$message .= $prlang->lng->_E_LOGINAPPR."\n";
	$message .= $mosConfig_live_site."/administrator/\n\n";
	$message .= $prlang->lng->_E_DONTRESPOND."\n\n\n\n";
	$message .= "----------------------------------------------\n";
	$message .= $mosConfig_sitename."\n";
	$message .= $_VERSION->PRODUCT .' '. $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL .' [ '.$_VERSION->CODENAME .' ]';

	mosMail($mosConfig_mailfrom, $mosConfig_fromname, $adminEmail, $subject, $message);
}


//Includes pathway file
function mosPathWay() {
	global $mosConfig_absolute_path;

    $Itemid = intval(mosGetParam($_REQUEST,'Itemid',0));
    require($mosConfig_absolute_path.'/includes/pathway.php');
}


/***************************************************/
/* DISPLAYS NOT AUTHORIZED MESSAGE (FRONTEND ONLY) */
/***************************************************/
function mosNotAuth() {
	global $my;

    echo '<p class="elxerror">'._LEND;
    echo '<span style="font-weight: bold; font-size: 1.5em; line-height: 1.8em;">'._ELX_ERROR.'</span><br />'._LEND;
	echo _NOT_AUTH._LEND;
	if ($my->gid !=29) {
		echo "<br />"._HIGHER_ACCESS;
	} else if ($my->id < 1) {
		echo "<br />"._DO_LOGIN;
	}
	echo '<br /><br />'._LEND;
	echo '</p>'._LEND;
	echo '<div class="back_button"><a href="javascript:history.go(-1);" title="'._BACK.'">'._BACK.'</a></div>'._LEND;
}


/****************************************/
/* GENERAL ERROR SCREEN (FRONTEND ONLY) */
/****************************************/
function elxError($errormsg='', $error=1, $customTitle='', $customImage='warning48.png') { //customImage: deprecated
    if ($customTitle != '') {
        $title = $customTitle;
    } else {
        $title = ($error) ? _ELX_ERROR : _ELX_WARNING;
    }
    $cssclass = ($error) ? 'elxerror' : 'elxwarning';

    echo '<p class="'.$cssclass.'">'._LEND;
    echo '<span style="font-weight: bold; font-size: 1.5em; line-height: 1.8em;">'.$title.'</span><br />'._LEND;
	echo ($errormsg != '') ? $errormsg : _GEM_UNKN_ERR;
	echo '<br /><br />'._LEND;
	echo '</p>'._LEND;
	if ($error) {
		echo '<div class="back_button"><a href="javascript:history.go(-1);" title="'._BACK.'">'._BACK.'</a></div>'._LEND;
	}
}


/**
* Replaces &amp; with & for xhtml compliance
* Needed to handle unicode conflicts due to unicode conflicts
*/
function ampReplace( $text ) {
	$text = eUTF::utf8_str_replace( '&#', '*-*', $text );
	$text = eUTF::utf8_str_replace( '&amp;', '&', $text );
	$text = eUTF::utf8_str_replace( '&', '&amp;', $text );
	$text = eUTF::utf8_str_replace( '*-*', '&#', $text );
	return $text;
}


/**
 * Function to convert array to integer values
 */
function mosArrayToInts( &$array, $default=null ) {
	if (is_array( $array )) {
		$n = count( $array );
		for ($i = 0; $i < $n; $i++) {
			$array[$i] = intval( $array[$i] );
		}
	} else {
		if (is_null( $default )) {
			return array();
		} else {
			return array( $default );
		}
	}
}


/* 
BENCHMARK
Description: CountS time taken in msec for a code block to be executed
usage:
start counter: $tstart = microtime();
....code block here....
Time taken: $dt = stopBenchmark($tstart, microtime());
*/
function stopBenchmark($start, $end) {
	$starttime = explode(' ', $start);
	$endtime = explode(' ', $end);
	$total_time = $endtime[0] + $endtime[1] - ($starttime[1] + $starttime[0]);
	$total_time = $total_time * 1000;
	return $total_time;
}

// ----- NO MORE CLASSES OR FUNCTIONS PASSED THIS POINT -----
// Post class declaration initialisations
// some version of PHP don't allow the instantiation of classes
// before they are defined

/** @global mosPlugin $_MAMBOTS */
$_MAMBOTS = new mosMambotHandler();

?>