<?php 
/**
* @version: $Id: mod_login.php 66 2010-06-15 19:46:11Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Module Login
* @url: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


if (!class_exists('modElxisLogin')) {
	class modElxisLogin {

		private $showname = 1;
		private $greeting = 0;
		private $msglogout = 0;
		private $logout = '';
		private $pretext = '';
		private $login = '';
		private $msglogin = 0;
		private $posttext = '';


		/*********************/
		/* MAGIC CONSTRUCTOR */
		/*********************/
		public function __construct($params) {
			$this->showname = (int)$params->def('name', 1);
			$this->greeting = (int)$params->def('greeting', 0);
			$this->msglogout = (int)$params->def('logout_message', 0);
			$this->logout = trim($params->def('logout', ''));
			
			$this->pretext = $params->get('pretext');
			$this->login = trim($params->def('login', ''));
			$this->msglogin = (int)$params->def('login_message', 0);
			$this->posttext = $params->get('posttext');
		}


		/******************/
		/* EXECUTE MODULE */
		/******************/
		public function bladerunner() {
			global $my;
			
			if ($my->id) {
				$this->loggeduser();
			} else {
				$this->visitor();
			}
		}


		/*********************/
		/* GET REQUESTED URI */
		/*********************/
		private function requesteduri() {
			if (!isset($_SERVER['REQUEST_URI'])) {
				$_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'];
				$_SERVER['REQUEST_URI'] .= isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : '';
			}
			return $_SERVER['REQUEST_URI'];
		}


		/*************************************/
		/* LOGOUT SCREEN FOR LOGGED-IN USERS */
		/*************************************/
		private function loggeduser() {
			global $database, $my, $mainframe, $Itemid, $lang;

    		$database->setQuery("SELECT name, avatar FROM #__users WHERE id='".$my->id."'", '#__', 1, 0);
			$urow = $database->loadRow();
			if (!$urow) { return; } //just in case...

    		$name = ($this->showname) ? $urow['name'] : $my->username;
			$avatar = 'noavatar.png';
    		if ((trim($urow['avatar']) != '') && (file_exists($mainframe->getCfg('absolute_path').'/images/avatars/'.$urow['avatar']))) {
				$avatar = $urow['avatar'];
			}

    		$database->setQuery("SELECT id FROM #__menu WHERE link='index.php?option=com_user&task=list' AND published='1'", '#__', 1, 0);
			$_Itemid = intval($database->loadResult());
			if (!$_Itemid) { $_Itemid = $Itemid; }

    		$profLink = sefRelToAbs('index.php?option=com_user&task=profile&Itemid='.$_Itemid.'&uid='.$my->id, 'members/'.$my->username.'.html');

			if ($this->logout == '') {
				if ($mainframe->getCfg('sef') == 2) {
					$isoc = eLOCALE::elxis_iso639($lang);
					$this->logout = ($lang != $mainframe->getCfg('lang')) ? $mainframe->getCfg('live_site').'/'.$isoc.'/login.html' : $mainframe->getCfg('live_site').'/login.html';
					unset($isoc);
				} else {
					$req = $this->requesteduri();
					$uri = parse_url($mainframe->getCfg('live_site'));
					if (isset($uri['path']) && ($uri['path'] != '')) {
						$req = preg_replace('@^('.$uri['path'].')@', '', $req);
					}
					$req = preg_replace('@^(\/)@', '', $req);
					$this->logout = sefRelToAbs($req);
					if (!preg_match('/^(http)/i', $this->logout)) {
						$this->logout = $mainframe->getCfg('live_site').'/'.preg_replace('/^(\/)/', '', $this->logout);
					}
				}
			}
?>

    		<script type="text/javascript">
			/* <![CDATA[ */
			function userlogout() {
				try { document.logoutform.onsubmit(); }
				catch(e){}
				document.logoutform.submit();
			}
			/* ]]> */
			</script>

			<form action="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/index.php?option=logout" method="post" name="logoutform">
				<div class="userlogin">
					<img src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/images/avatars/<?php echo $avatar; ?>" width="50" height="50" border="0" alt="<?php echo $name; ?>" title="<?php echo $name; ?>" /> 
            		<?php echo ($this->greeting) ? _E_HI.', <strong>'.$name.'</strong>' : '<strong>'.$name.'</strong>'; ?><br />
					<a href="<?php echo $profLink; ?>" title="<?php echo _E_VIEW_PROFILE; ?>"><?php echo _E_VIEW_PROFILE; ?></a><br />
					<a href="javascript:void(null);" onclick="javascript:userlogout();" title="<?php echo _BUTTON_LOGOUT; ?>"><?php echo _BUTTON_LOGOUT; ?></a>
				</div>
				<input type="hidden" name="op2" value="logout" />
				<input type="hidden" name="return" value="<?php echo $this->logout; ?>" />
				<input type="hidden" name="message" value="<?php echo $this->msglogout; ?>" />
			</form>
<?php 
		}


		/*****************************/
		/* LOGIN SCREEN FOR VISITORS */
		/*****************************/
		private function visitor() {
			global $mainframe, $Itemid, $database, $lang;

			$rand = rand(120, 989);
			if ($mainframe->getCfg('sef') != 2) {
    			$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_registration&task=lostPassword'"
				."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
				$database->setQuery($query, '#__', 1, 0);
    			$_Itemid = intval($database->loadResult());
				if (!$_Itemid) { $_Itemid = $Itemid; }

    			$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_registration&task=register'"
				."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
    			$database->setQuery($query, '#__', 1, 0);
    			$_Itemid2 = intval($database->loadResult());
				if (!$_Itemid2) { $_Itemid2 = $Itemid; }
			} else {
				$_Itemid = $Itemid;
				$_Itemid2 = $Itemid;
			}

			$action = sefRelToAbs('index.php');
			if (!preg_match('/^(http)/i', $action)) {
				$action = $mainframe->getCfg('live_site').'/'.preg_replace('/^(\/)/', '', $action);
			}
			$action = $mainframe->secureURL($action);

			if ($this->login == '') {
				$req = $this->requesteduri();
				$uri = parse_url($mainframe->getCfg('live_site'));
				if (isset($uri['path']) && ($uri['path'] != '')) {
					$req = preg_replace('@^('.$uri['path'].')@', '', $req);
				}
				$req = preg_replace('@^(\/)@', '', $req);
				$this->login = sefRelToAbs($req);
				if (!preg_match('/^(http)/i', $this->login)) {
					$this->login = $mainframe->getCfg('ssl_live_site').'/'.preg_replace('/^(\/)/', '', $this->login);
				}
			}
?>

			<form action="<?php echo $action; ?>" method="post" name="loginform" >
			<div class="userlogin">
        		<?php echo (trim($this->pretext) != '') ? '<span class="pretext">'.$this->pretext.'</span>'._LEND : ''; ?>
				<label for="username<?php echo $rand; ?>"><?php echo _USERNAME; ?>:</label>
        		<input type="text" name="username" id="username<?php echo $rand; ?>" dir="ltr" class="inputbox" size="10" title="<?php echo _USERNAME; ?>" /><br />
				<label for="passwd<?php echo $rand; ?>"><?php echo _PASSWORD; ?>:</label>
				<input type="password" name="passwd" id="passwd<?php echo $rand; ?>" dir="ltr" class="inputbox" size="10" title="<?php echo _PASSWORD; ?>" /><br />
				<input type="checkbox" name="remember" id="remember<?php echo $rand; ?>" value="yes" title="<?php echo _REMEMBER_ME; ?>" /> 
				<label for="remember<?php echo $rand; ?>"><?php echo _REMEMBER_ME; ?></label><br />
        		<input type="hidden" name="option" value="login" />
        		<input type="hidden" name="op2" value="login" />
        		<input type="hidden" name="return" value="<?php echo $this->login; ?>" />
        		<input type="hidden" name="message" value="<?php echo $this->msglogin; ?>" />
        		<input type="submit" name="Submit" class="button" value="<?php echo _BUTTON_LOGIN; ?>" title="<?php echo _BUTTON_LOGIN; ?>" /><br />
				<div class="lostpass">
        			<a href="<?php echo sefRelToAbs('index.php?option=com_registration&task=lostPassword&Itemid='.$_Itemid, 'registration/lost-password.html'); ?>" title="<?php echo _LOST_PASSWORD; ?>" >
            			<?php echo _E_LOSTPASS; ?>
        			</a>
        		</div>
<?php 
        		if (intval($mainframe->getCfg('allowUserRegistration')) > 0) {
?>
				<div class="caccount"><?php echo _NO_ACCOUNT; ?> 
		    		<a href="<?php echo sefRelToAbs('index.php?option=com_registration&task=register&Itemid='.$_Itemid2, 'registration/register.html'); ?>" title="<?php echo _E_REGISTRATION; ?>">
						<?php echo _CREATE_ACCOUNT; ?>
					</a>
				</div>
<?php 
        		}
        		
        		echo (trim($this->posttext) != '') ? '<span class="posttext">'.$this->posttext.'</span>'._LEND : '';
?>
			</div>
			</form>

<?php 
			if (_GEM_RTL == 1) { echo "<div style=\"clear:both;\"></div>\n"; }
		}

	}
}


$modelxlogin = new modElxisLogin($params);
$modelxlogin->bladerunner();
unset($modelxlogin);

?>