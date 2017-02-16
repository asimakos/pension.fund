<?php 
/**
* @version: $Id: loggedajax.php 2545 2009-10-02 16:36:20Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Modules / Logged
* @author: Ioannis Sannos (Elxis Team)
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/


define('_VALID_MOS', 1);
define('_ELXIS_ADMIN', 1);
$elxis_root = str_replace('/administrator/modules/mod_logged', '', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));

require_once($elxis_root.'/includes/Core/security.php');
if (!file_exists($elxis_root.'/configuration.php')) { exit('Configuration file not found!'); }
require_once($elxis_root.'/configuration.php');
$mosConfig_gzip = '0';
require_once($elxis_root.'/includes/Core/loader.php');
require_once($mosConfig_absolute_path."/administrator/includes/admin.php");

$database = new database($mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix, $mosConfig_dbtype);
$database->debug($mosConfig_debug);
$acl = new gacl_api();

require_once($mosConfig_absolute_path.'/includes/sef.php');
session_name(md5($mosConfig_live_site));
session_start();

$mainframe = new mosMainFrame($database, $option, $elxis_root, true);

$task = trim(mosGetParam($_REQUEST, 'task', '' ) );
$mosmsg = trim(strip_tags(mosGetParam($_REQUEST, 'mosmsg', '')));

//restore some session variables
$my = new mosUser( $database );
$my->id = mosGetParam( $_SESSION, 'session_user_id', '' );
$my->username = mosGetParam( $_SESSION, 'session_username', '' );
$my->usertype = mosGetParam( $_SESSION, 'session_usertype', '' );
$my->gid = mosGetParam( $_SESSION, 'session_gid', '' );
$my->allowed = mosGetParam( $_SESSION, 'session_allowed', '' );

$session_id = mosGetParam( $_SESSION, 'session_id', '' );
$logintime = mosGetParam( $_SESSION, 'session_logintime', '' );

//check against db record of session
if ($session_id == md5( $my->id.$my->username.$my->usertype.$logintime )) {
	$database->setQuery( "SELECT * FROM #__session WHERE session_id='".$session_id."'"
	." AND username = '".$database->getEscaped($my->username)."' AND userid = ".intval($my->id));
	if (!$result = $database->query()) { echo $database->stderr(); }
	if ($database->getNumRows($result) <> 1) { exit('You are not allowed to access this page'); }
} else {
	exit('You are not allowed to access this page');
}


header('Content-type: text/html; charset=utf-8');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');



class modloggedbackajax {
	
	private $totalrows = 0;
	private $limit = 10;
	private $limitstart = 0;
	private $page = 0;
	private $totalpages = 0;
	private $users = array();
	private $task = '';
	private $robots = 0;


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct($task='') {
		$this->task = trim(htmlspecialchars($task));
		$this->loadLanguage();
		$this->robots = intval(mosGetParam($_SESSION, 'modlogrobots', 0));
		if ($this->robots < 0) { $this->robots = 0; }		
		if ($this->task == 'mlloadpage') {
			$this->gettotal();
		}
	}


	/*******************/
	/* EXECUTE MODULE */
	/******************/
	public function runmod() {
		switch($this->task) {
			case 'mlloadpage':
				$users = $this->getonline();
				$this->populatelist($users);
			break;
			case 'mlipdetails':
				$this->ipdetails();
			break;
			case 'mlchangerobots':
				$this->togglerobots();
			break;
			default:
				echo 'Invalid request';
			break;
		}
	}


	/**********************************************/
	/* A VERY SIMPLE METHOD TO DETECT SOME ROBOTS */
	/**********************************************/
	private function detectrobot($ip) {
		if ($ip == '') { return ''; }
		if (function_exists('gethostbyaddr') && is_callable('gethostbyaddr')) {
			$hostname = gethostbyaddr($ip);
			if (!$hostname) { return ''; }
			if (preg_match("/googlebot/i", $hostname)) { return 'Google Bot'; }
			if (preg_match('/search\.msn\.com$/i', $hostname) || preg_match('/msnbot/i', $hostname)) { return 'MSN Bot'; }
			if (preg_match('/search\.live\.com$/i', $hostname)) { return 'Live.com'; }
			if (preg_match('/crawl\.yahoo/i', $hostname) || preg_match('/yahoo\.com$/i', $hostname)) { return 'Yahoo!'; }
			if (preg_match('/alexa\.com$/i', $hostname)) { return 'Alexa'; }
		}
		return '';
	}


	/******************************/
	/* POPULATE ONLINE USERS LIST */
	/******************************/
	private function populatelist($users) {
		global $adminLanguage, $mainframe, $acl, $my;

		$canManageUsers = $acl->acl_check('administration', 'manage', 'users', $my->usertype, 'components', 'all');
		if (!$canManageUsers) {
			$canManageUsers = $acl->acl_check('administration', 'manage', 'users', $my->usertype, 'components', 'com_users');
		}
		$myarr = explode(',', $my->allowed);
?>

		<table class="adminlist">
<?php 
		$k = 0;
		for ($i=0; $i<count($users); $i++) {
			$user = $users[$i];

			if ($this->robots && ($user['username'] == '') && ($user['userid'] == 0)) {
				$rname = $this->detectrobot($user['ip']);
				if ($rname != '') {
					$user['username'] = $rname;
					$user['usertype'] = 'Robot';
				}
			}

			if (($user['userid'] > 0) && ($canManageUsers) && in_array($user['gid'], $myarr)) {
				$link = 'index2.php?option=com_users&task=editA&hidemainmenu=1&id='.$user['userid'];
				$name = '<a href="'.$link.'" title="'.$adminLanguage->A_EDITUSER.'">'.$user['username'].'</a>';
			} else {
				$name = ($user['username'] != '') ? $user['username'] : MODLOG_VISITOR;
			}
?>
		<tr class="row<?php echo $k; ?>">
			<td><?php echo ($this->page * $this->limit) + $i + 1; ?></td>
			<td>
			<div id="ipdetails<?php echo $i; ?>"></div>
			<?php 
			if ($user['ip'] != '') {
				echo '<a href="javascript:void(null);" onclick="modlogipdetails(\''.$user['ip'].'\', '.$i.');" title="'.MODLOG_CLVIEWIPD.'" id="ipdetlink'.$i.'">'.$user['ip'].'</a>';
			}
			?>	
			</td>
			<td><?php echo $name; ?></td>
			<td><?php echo (trim($user['usertype']) != '') ? $user['usertype'] : $adminLanguage->A_VISITORS; ?></td>
			<td>
<?php 
				$dur = (time() + ($mainframe->getCfg('offset') * 3600) - $user['time']);
				$larray = array();
        		if ($dur > 60) {
            		$minutes = floor($dur/60);
            		if ($minutes > 1) {
                		$larray[] = $minutes.' '.$adminLanguage->A_MINUTES;
            		} else {
                		$larray[] = '1 '.$adminLanguage->A_MINUTE;
            		}
            		$dur = ($dur - ($minutes*60));
        		}
        		if ($dur >0) { $larray[] = $dur.' '.$adminLanguage->A_SECONDS; }
        		$lastact = implode(', ', $larray);
        		if ($lastact == '') { $lastact = '0 '.$adminLanguage->A_SECONDS; }
        		echo '<acronym title="'.$adminLanguage->A_TPASS_LASTACT.'">'.$lastact.'</acronym>';
?>
			</td>
			<td>
<?php
			if (($user['userid'] > 0) && ($canManageUsers) && in_array($user['gid'], $myarr)) {
?>
			<a href="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/index2.php?option=com_users&task=flogout&id=<?php echo $user['userid']; ?>" title="<?php echo $adminLanguage->A_FORCELOGOUT; ?>">
				<img src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/images/publish_x.png" width="12" height="12" border="0" alt="<?php echo $adminLanguage->A_FORCELOGOUT; ?>" />
			</a>
<?php 
			}
?>
			</td>
		</tr>
<?php 
			$k = 1 - $k;
		}
?>
		</table>
<?php 
	}



	/*************************************/
	/* GET VISITORS + LOGGED USERS TOTAL */
	/*************************************/
	private function gettotal() {
		global $database;

		$database->setQuery("SELECT ip FROM #__session GROUP BY ip");
		$ips = $database->loadResultArray();
		$this->totalrows = ($ips) ? count($ips) : 0;

		if ($this->totalrows > 0) {
			$this->totalpages = ceil($this->totalrows / $this->limit);	
			$this->page = (int)mosGetParam($_POST, 'page', 0);
			if ($this->page > ($this->totalpages - 1)) { $this->page = ($this->totalpages - 1); }
			if ($this->page < 1) { $this->page = 0; }
			$this->limitstart = $this->page * $this->limit;
			if ($this->totalrows <= $this->limit) { $this->limitstart = 0; }
		}
	}


	/*******************************/
	/* GET ONLINE USERS + VISITORS */
	/*******************************/
	private function getonline() {
		global $database;

		if ($this->totalrows < 1) { return array(); }

		$database->setQuery("SELECT username, time, userid, usertype, gid, ip FROM #__session GROUP BY ip ORDER BY time DESC", '#__', $this->limit, $this->limitstart);
		$users = $database->loadRowList();

		return $this->enrichuserdata($users);
	}
	
			
	/********************/
	/* ENRICH USER DATA */
	/********************/	
	private function enrichuserdata($users) {
		global $database;

		if (!$users) { return array(); }
		$database->setQuery("SELECT username, userid, usertype, gid, ip FROM #__session WHERE userid != 0 GROUP BY userid");
		$logged = $database->loadRowList('ip');
		if ($logged) {
			for($i=0; $i<count($users); $i++) {
				if ($users[$i]['userid'] == '0') { //update logged in users data
					$ip = $users[$i]['ip'];
					if (isset($logged[$ip])) {
						$users[$i]['username'] = $logged[$ip]['username'];
						$users[$i]['usertype'] = $logged[$ip]['usertype'];
						$users[$i]['gid'] = $logged[$ip]['gid'];
						$users[$i]['userid'] = $logged[$ip]['userid'];
					}
				}
			}
		}
		return $users;
	}
			

	/************************/
	/* LOAD MODULE LANGUAGE */
	/************************/
	private function loadLanguage() {
		global $alang, $mainframe;

		$base = $mainframe->getCfg('absolute_path').'/administrator/modules/mod_logged';
		if (file_exists($base.'/'.$alang.'.php')) {
			require_once($base.'/'.$alang.'.php');
		} elseif (file_exists($base.'/'.$mainframe->getCfg('alang').'.php')) {
			require_once($base.'/'.$mainframe->getCfg('alang').'.php');
		} else {
			require_once($base.'/english.php');
		}
	}


	/***************************/
	/* GET COUNTRY BY HOSTNAME */
	/***************************/
	private function getcountrybyhost($hostname='') {
		if ($hostname != '') {
    		$slices = preg_split('/\./',$hostname, -1, PREG_SPLIT_NO_EMPTY);
    		if ($slices && is_array($slices) && (count($slices) > 1)) {
    			$tld = strtolower(array_pop($slices));
    			switch ($tld) {
    				case 'gr': return 'Greece (GR)'; break;
    				case 'de': return 'Germany (DE)'; break;
    				case 'fr': return 'France (FR)'; break;
    				case 'it': return 'Italy (IT)'; break;
    				case 'ru': return 'Russia (RU)'; break;
    				case 'uk': return 'Ukrain (UK)'; break;
    				case 'pt': return 'Portugal (PT)'; break;
    				case 'es': return 'Spain (ES)'; break;
    				case 'uk': return 'United Kingdom (UK)'; break;
    				case 'us': return 'U.S.A. (US)'; break;
    				case 'pl': return 'Polland (PL)'; break;
    				case 'tr': return 'Turkey (TR)'; break;
    				case 'cn': return 'China (CN)'; break;
    				case 'in': return 'India (IN)'; break;
    				case 'ir': return 'Iran (IR)'; break;
    				case 'cz': return 'Chezh (CZ)'; break;
    				case 'be': return 'Belgium (BE)'; break;
    				case 'il': return 'Israel (IL)'; break;
    				case 'bg': return 'Bulgaria (BG)'; break;
    				case 'eg': return 'Egypt (EG)'; break;
    				case 'nl': return 'Holland (NL)'; break;
    				case 'br': return 'Brazil (BR)'; break;
    				case 'ar': return 'Argentina (AR)'; break;
    				case 'ro': return 'Romania (RO)'; break;
    			}
			}
		}
		return '';
	}


	/**********************/
	/* GET DETAILS FOR IP */
	/**********************/
	private function ipdetails() {
    	global $mainframe, $adminLanguage;	

    	$ip = trim(mosGetParam($_POST, 'ip', ''));
    	if (($ip == '') || (strlen($ip) < 9)) { echo 'Invalid ip address!'; return; }

		$rnd = rand(10000,99999);

    	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/snoopy.class.php');
    	$snoopy = new Snoopy;
    	$snoopy->maxlength = 80000;
    	$snoopy->maxredirs = 0;
    	$snoopy->read_timeout =	15;
    	$snoopy->timed_out = true;
    	$snoopy->_fp_timeout = 15;
    	$snoopy->_submit_method = 'GET';
    	$request_url = 'http://api.hostip.info/get_html.php?ip='.$ip.'&position=true&rnd='.$rnd;
    	$snoopy->fetchtext($request_url);
    	$sn_res = $snoopy->results;
    	$sn_err = trim($snoopy->error);

  		$geo = array();
  		$geo['ip'] = $ip;
  		$geo['hostname'] = '';
  		$geo['error'] = '';
  		$geo['country'] = '';
  		$geo['city'] = '';
  		$geo['latitude'] = '';
  		$geo['longitude'] = '';

    	if (($sn_err != '') || (!preg_match('/200/i', $snoopy->response_code)) || !$sn_res) {
        	$geo['error'] = $adminLanguage->A_ERROR;
		} else {
			if (function_exists('gethostbyaddr') && is_callable('gethostbyaddr')) { $geo['hostname'] = gethostbyaddr($ip); }
        	$sn_res = str_replace('\r\n', '\n', $sn_res);
        	$lines = explode("\n", $sn_res);
        	if (($lines) && (count($lines) > 0)) {
        		$i = 0;
        		foreach ($lines as $line) {
        			$line = trim($line);
        			if ($line == '') {
						if ($geo['hostname'] != '') { $geo['country'] = $this->getcountrybyhost($geo['hostname']); }
						continue;
					}
        			if (preg_match('/private/i', $line) || preg_match('/unknown/i', $line)) { continue; }
        			if (preg_match('/^Country/i', $line)) {
        				$parts = preg_split('/\:/', $line);
        				if ($parts && (count($parts) == 2)) { $geo['country'] = trim($parts[1]); }
        			} elseif (preg_match('/^City/i', $line)) {
        				$parts = preg_split('/\:/', $line);
        				if ($parts && (count($parts) == 2)) { $geo['city'] = trim($parts[1]); }
        			} elseif (preg_match('/^Latitude/i', $line)) {
        				$parts = preg_split('/\:/', $line);
        				if ($parts && (count($parts) == 2)) { $geo['latitude'] = trim($parts[1]); }
        			} elseif (preg_match('/^Longitude/i', $line)) {
        				$parts = preg_split('/\:/', $line);
        				if ($parts && (count($parts) == 2)) { $geo['longitude'] = trim($parts[1]); }
        			}

        			if (($geo['country'] == '') && ($geo['hostname'] != '')) {
						$geo['country'] = $this->getcountrybyhost($geo['hostname']);
					}
        		}
        	}
    	}

		if ($geo['error'] == '') {
			$imgtitle = ($geo['country'] != '') ? $geo['country'] : 'Unknown/Local';
			echo '<table cellspacing="0" cellpadding="0" border="0" width="100%">'."\n";
			echo '<tr><td width="30" style="border: none;"><img src="http://api.hostip.info/flag.php?ip='.$geo['ip'].'" alt="'.$imgtitle.'" title="'.$imgtitle.' - Data provided by hostip.info" width="28" height="18" /></td>'._LEND;
			echo '<td style="border: none;">'."\n";
			echo $geo['ip'];
			if ($geo['hostname'] != '') {
				$len = strlen($geo['hostname']);
				echo "<br />\n";
				echo ($len > 20) ? '<span dir="ltr" title="'.$geo['hostname'].'" style="cursor: pointer;">'.substr($geo['hostname'], 0, 17).'...</span>' : $geo['hostname'];
			}
			if ($geo['country'] != '') { echo "<br />\n".$geo['country']; }
			if ($geo['city'] != '') { echo "<br />\n".$geo['city']; }
			if (($geo['latitude'] != '') && ($geo['longitude'] != '')) {
				echo "<br />\n";
				echo '<a href="http://maps.google.com/?ie=UTF8&ll='.$geo['latitude'].','.$geo['longitude'].'&spn=0.192782,0.308647&t=h&z=12" target="blank" title="'.MODLOG_LOCATEONMAP.'">Google maps</a>'._LEND;
			}
			echo "</td></tr>\n";
			echo "</table>\n";
		} else {
			echo $geo['ip'].' <strong>'.$geo['error'].'</strong>';
		}
	}


	/**********************************/
	/* TOGGLE ROBOTS DETECTION ON/OFF */
	/**********************************/
	private function togglerobots() {
		$rbon = intval(mosGetParam($_POST, 'rbon', 0));
		if ($rbon < 0) { $rbon = 0; }
		$oldrobots = $this->robots;
		$_SESSION['modlogrobots'] = $rbon;
		$this->robots = $rbon;

		$align = (_GEM_RTL) ? 'right' : 'left';
		echo MODLOG_DETECTROBOTS.': ';
		if ($this->robots) {
            echo '<span style="font-weight: bold; padding: 1px 3px;">'.MODLOG_ON.'</span> '._LEND;
            echo '<a href="javascript:void(null);" onclick="modlogrobots(0);" title="'.MODLOG_OFF.'" style="font-weight: bold; padding: 1px 3px;">'.MODLOG_OFF.'</a>'._LEND;
		} else {
            echo '<a href="javascript:void(null);" onclick="modlogrobots(1);" title="'.MODLOG_ON.'" style="font-weight: bold; padding: 1px 3px;">'.MODLOG_ON.'</a> '._LEND;
            echo '<span style="font-weight: bold; padding: 1px 3px;">'.MODLOG_OFF.'</span>'._LEND;
		}
		if ($this->robots && ($oldrobots == 0)) {
			echo '<span style="padding: 1px 3px; color: #C27A08;">'.MODLOG_NEEDREFRPG."</span>\n";
		}
	}

}


$modloggeda = new modloggedbackajax($task);
$modloggeda->runmod();
unset($modloggeda);

exit();

?>