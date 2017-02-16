<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Modules / Logged
* @author: Ioannis Sannos (Elxis Team)
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');



class modloggedback {
	
	private $totalrows = 0;
	private $limit = 10;
	private $limitstart = 0;
	private $page = 0;
	private $totalpages = 0;
	private $users = array();
	private $robots = 0;

	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
		$this->loadLanguage();
		$this->robots = intval(mosGetParam($_SESSION, 'modlogrobots', 0));
		if ($this->robots < 0) { $this->robots = 0; }
		$this->gettotal();
	}


	/*******************/
	/* EXECUTE MODULE */
	/******************/
	public function runmod() {
		$users = $this->getonline();
		$this->populatelist($users);
	}


	/******************************/
	/* POPULATE ONLINE USERS LIST */
	/******************************/
	private function populatelist($users) {
		global $adminLanguage, $mainframe, $acl, $my;

		$canManageUsers = $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'all' );
		if (!$canManageUsers) {
			$canManageUsers = $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_users' );
		}
		$myarr = explode(',', $my->allowed);
?>

		
	<script type="text/javascript">
	function modlogipdetails(ip,q) {
		var e = document.getElementById('ipdetails'+q);
		e.style.display = "";
    	cpajax.setVar("option", 'com_admin');
    	cpajax.setVar("task", 'mlipdetails');
    	cpajax.setVar("ip", ip);
		document.getElementById('ipdetlink'+q).innerHTML = "";
		document.getElementById('ipdetlink'+q).style.display = "none;";
    	cpajax.requestFile = '<?php echo $mainframe->getCfg('live_site'); ?>/administrator/modules/mod_logged/loggedajax.php';
		cpajax.method = 'POST';
		cpajax.element = 'ipdetails'+q;
		cpajax.onLoading = whenLoadingCPM;
		cpajax.onLoaded = whenLoadedCPM;
		cpajax.onInteractive = whenInteractiveCPM;
		cpajax.runAJAX();
	}


	function whenLoadingCPM2(){
		var e = document.getElementById(cpajax.element);
		e.innerHTML = "<?php echo MODLOG_LOADINGWAIT; ?>";
	}

	function modloggoto(page) {
		page = parseInt(page);
		if (page < 0) { alert('Invalid page!'); return false; }
		var e = document.getElementById('loggedusers');
		e.innerHTML = '';
    	cpajax.setVar("option", 'com_admin');
    	cpajax.setVar("task", 'mlloadpage');
    	cpajax.setVar("page", page);
    	cpajax.requestFile = '<?php echo $mainframe->getCfg('live_site'); ?>/administrator/modules/mod_logged/loggedajax.php';
		cpajax.method = 'POST';
		cpajax.element = 'loggedusers';
		cpajax.onLoading = whenLoadingCPM2;
		cpajax.onLoaded = whenLoadingCPM2;
		cpajax.onInteractive = whenLoadingCPM2;
		cpajax.runAJAX();
	}

	function modlogrobots(on) {
		on = parseInt(on);
		if (on < 0) { alert('Invalid setting!'); return false; }
		var e = document.getElementById('modlogrobots');
		e.innerHTML = '';
    	cpajax.setVar("option", 'com_admin');
    	cpajax.setVar("task", 'mlchangerobots');
    	cpajax.setVar("rbon", on);
    	cpajax.requestFile = '<?php echo $mainframe->getCfg('live_site'); ?>/administrator/modules/mod_logged/loggedajax.php';
		cpajax.method = 'POST';
		cpajax.element = 'modlogrobots';
		cpajax.onLoading = whenLoadingCPM2;
		cpajax.onLoaded = whenLoadingCPM2;
		cpajax.onInteractive = whenLoadingCPM2;
		cpajax.runAJAX();
	}
	</script>

		<table class="adminlist">
		<tr>
			<th><?php echo $adminLanguage->A_LOGGEDUSRS; ?></th>
		</tr>
		<tr>
			<td>
			<?php 
			if ($users) {
				printf(MODLOG_ONLINEUSERS, '<strong>'.$this->totalrows.'</strong>');
				$this->handlerobots();
				$this->pagination();
			} else {
				echo $adminLanguage->A_NORECORDSFOUND;
			}
			?>
			</td>
		</tr>
		</table>

		<div id="loggedusers">
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
				$name = (trim($user['username']) != '') ? $user['username'] : MODLOG_VISITOR;
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
			<a href="index2.php?option=com_users&task=flogout&id=<?php echo $user['userid']; ?>" title="<?php echo $adminLanguage->A_FORCELOGOUT; ?>">
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
		</div>
<?php 
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


	/*************************/
	/* SHOW PAGINATION LINKS */
	/*************************/
	private function pagination() {
		if ($this->totalpages < 2) { return; }
		$align = (_GEM_RTL) ? 'right' : 'left';
		echo '<div style="text-align: '.$align.'; padding: 0; margin: 5px 0 0 0; clear: both;">'._LEND;
		echo MODLOG_PAGES.': ';
		for ($i=0; $i < $this->totalpages; $i++) {
            $page = ($i +1);
            echo '<a href="javascript:void(null);" onclick="modloggoto('.$i.');" title="'.MODLOG_PAGE.' '.$page.'" style="font-weight: bold; padding: 1px 3px;">'.$page.'</a> '._LEND;
        }
		echo '</div>'._LEND;
	}


	/*******************************/
	/* SET ROBOTS DETECTION ON/OFF */
	/*******************************/
	private function handlerobots() {
		$align = (_GEM_RTL) ? 'right' : 'left';
		echo '<div id="modlogrobots" style="text-align: '.$align.'; padding: 0; margin: 5px 0 0 0; clear: both;">'._LEND;
		echo MODLOG_DETECTROBOTS.': ';
		if ($this->robots) {
            echo '<span style="font-weight: bold; padding: 1px 3px;">'.MODLOG_ON.'</span> '._LEND;
            echo '<a href="javascript:void(null);" onclick="modlogrobots(0);" title="'.MODLOG_OFF.'" style="font-weight: bold; padding: 1px 3px;">'.MODLOG_OFF.'</a>'._LEND;
		} else {
            echo '<a href="javascript:void(null);" onclick="modlogrobots(1);" title="'.MODLOG_ON.'" style="font-weight: bold; padding: 1px 3px;">'.MODLOG_ON.'</a> '._LEND;
            echo '<span style="font-weight: bold; padding: 1px 3px;">'.MODLOG_OFF.'</span>'._LEND;
		}
		echo '</div>'._LEND;
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
			$this->page = (int)mosGetParam($_REQUEST, 'page', 0);
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

}

		
$modlogged = new modloggedback();
$modlogged->runmod();
unset($modlogged);

?>