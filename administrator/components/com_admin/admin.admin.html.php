<?php 
/**
* @version: $Id: admin.admin.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Admin
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_admin_misc {

	static public function controlPanel() {
	    global $mainframe, $adminLanguage;
?>
		<table class="adminheading" border="0">
		<tr>
			<th class="cpanel"><?php echo $adminLanguage->A_COMP_ADMIN_TITLE; ?></th>
		</tr>
		</table>
		<?php
		$path = $mainframe->getCfg('absolute_path').'/administrator/templates/admin/'.$mainframe->getTemplate().'/cpanel.php';
		if (file_exists( $path )) {
		    require $path;
		} else {
		    echo '<br />';
			mosLoadAdminModules( 'cpanel', 1 );
		}
	}


	static private function get_php_setting($val) {
		$r =  (ini_get($val) == '1' ? 1 : 0);
		return $r ? 'ON' : 'OFF';
	}


	static private function get_server_software() {
		if (isset($_SERVER['SERVER_SOFTWARE'])) {
			return $_SERVER['SERVER_SOFTWARE'];
		} else if (($sf = getenv('SERVER_SOFTWARE'))) {
			return $sf;
		} else {
			return 'n/a';
		}
	}


	static public function system_info( $version ) {
		global $mainframe, $database, $adminLanguage;

		$width = 400; // width of 100%
		$tabs = new mosTabs(0);
?>

		<table class="adminheading">
		<tr>
			<th class="info"><?php echo $adminLanguage->A_COMP_ADMIN_INFO; ?></th>
		</tr>
		</table>

		<?php
		$tabs->startPane("sysinfo");
		$tabs->startTab($adminLanguage->A_MENU_SYSTEM_INFO,"system-page");
		?>
		<table class="adminform">
		<tr>
			<th colspan="2"><?php echo $adminLanguage->A_COMP_ADMIN_SYSTEM; ?></th>
		</tr>
		<tr>
			<td valign="top" width="250"><strong><?php echo $adminLanguage->A_COMP_ADMIN_PHP_BUILT_ON; ?></strong></td>
			<td><?php echo php_uname(); ?></td>
		</tr>
		<tr>
			<td><b><?php echo $adminLanguage->A_COMP_ADMIN_DB; ?></b></td>
			<td><?php
            echo $mainframe->getCfg('dbtype').' ';
			$v = $database->_resource->ServerInfo();
			echo $v['description'];
            echo ' ('.$adminLanguage->A_VERSION.': '.$v['version'].')';
            ?></td>
		</tr>
		<tr>
			<td><b><?php echo $adminLanguage->A_COMP_ADMIN_PHP_VERSION; ?></b></td>
			<td><?php echo phpversion(); ?></td>
		</tr>
		<tr>
			<td><b><?php echo $adminLanguage->A_COMP_ADMIN_SERVER; ?></b></td>
			<td><?php echo HTML_admin_misc::get_server_software(); ?></td>
		</tr>
		<tr>
			<td><b><?php echo $adminLanguage->A_COMP_ADMIN_SERVER_TO_PHP; ?></b></td>
			<td><?php echo php_sapi_name(); ?></td>
		</tr>
		<tr>
			<td><b><?php echo $adminLanguage->A_VERSION; ?></b></td>
			<td><?php echo $version; ?></td>
		</tr>
		<tr>
			<td><b><?php echo $adminLanguage->A_COMP_ADMIN_AGENT; ?></b></td>
			<td><?php echo $_SERVER['HTTP_USER_AGENT']; ?></td>
		</tr>
		<tr>
			<td valign="top"><b><?php echo $adminLanguage->A_COMP_ADMIN_SETTINGS; ?></b></td>
			<td>
				<table cellspacing="1" cellpadding="1" border="0">
				<tr>
					<td><?php echo $adminLanguage->A_COMP_ADMIN_MODE; ?></td>
					<td><?php echo HTML_admin_misc::get_php_setting('safe_mode'); ?></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_COMP_ADMIN_BASEDIR; ?></td>
					<td><?php echo (($ob = ini_get('open_basedir')) ? $ob : 'none'); ?></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_COMP_ADMIN_ERRORS; ?></td>
					<td><?php echo HTML_admin_misc::get_php_setting('display_errors'); ?></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_COMP_ADMIN_OPEN_TAGS; ?></td>
					<td><?php echo HTML_admin_misc::get_php_setting('short_open_tag'); ?></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_COMP_ADMIN_FILE_UPLOADS; ?></td>
					<td><?php echo HTML_admin_misc::get_php_setting('file_uploads'); ?></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_COMP_ADMIN_QUOTES; ?></td>
					<td><?php echo HTML_admin_misc::get_php_setting('magic_quotes_gpc'); ?></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_COMP_ADMIN_REG_GLOBALS; ?></td>
					<td><?php echo HTML_admin_misc::get_php_setting('register_globals'); ?></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_COMP_ADMIN_OUTPUT_BUFF; ?></td>
					<td><?php echo HTML_admin_misc::get_php_setting('output_buffering'); ?></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_COMP_ADMIN_S_SAVE_PATH; ?></td>
					<td><?php echo (($sp=ini_get('session.save_path')) ? $sp:'none'); ?></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_COMP_ADMIN_S_AUTO_START; ?></td>
					<td>
					<?php echo intval( ini_get( 'session.auto_start' ) ); ?>
					</td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_COMP_ADMIN_XML; ?></td>
					<td><?php echo extension_loaded('xml')? $adminLanguage->A_YES : $adminLanguage->A_NO; ?></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_COMP_ADMIN_ZLIB; ?></td>
					<td><?php echo extension_loaded('zlib') ? $adminLanguage->A_YES : $adminLanguage->A_NO; ?></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_COMP_ADMIN_DISABLED; ?></td>
					<td><?php echo ($df = ini_get('disable_functions')) ? $df : 'none' ; ?></td>
				</tr>
				<?php
				$query = "SELECT name FROM #__mambots WHERE folder='editors' AND published='1'";
				$database->setQuery( $query, '#__', 1, 0 );
				$editor = $database->loadResult();
				?>
				<tr>
					<td><?php echo $adminLanguage->A_COMP_ADMIN_WYSIWYG; ?></td>
					<td><?php echo $editor; ?></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top"><strong><?php echo $adminLanguage->A_COMP_ADMIN_CONF_FILE; ?></strong></td>
			<td align="left" dir="ltr"><?php
			$cf = file($mainframe->getCfg('absolute_path').'/configuration.php' );
			foreach ($cf as $k=>$v) {
				if (preg_match('/mosConfig\_user/i', $v)) {
					$cf[$k] = '$mosConfig_user = \'xxxxxx\';';
				} else if (preg_match('/mosConfig\_password/i', $v)) {
					$cf[$k] = '$mosConfig_password = \'xxxxxx\';';
				} else if (preg_match('/mosConfig\_db/i', $v)) {
					$cf[$k] = '$mosConfig_db = \'xxxxxx\';';
				} else if (preg_match('/mosConfig_ftp\_user/i', $v)) {
					$cf[$k] = '$mosConfig_ftp_user = \'xxxxxx\';';
				} else if (preg_match('/mosConfig\_ftp\_pass/i', $v)) {
					$cf[$k] = '$mosConfig_ftp_pass = \'xxxxxx\';';
				} else if (preg_match('/\<\?php/i', $v)) {
					$cf[$k] = '&lt;?php';
				}
			}
			echo implode( "<br />", $cf );
			?></td>
		</tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_COMP_ADMIN_PHP_INFO,"php-page");
		?>
		<table class="adminform">
		<tr>
			<th colspan="2"><?php echo $adminLanguage->A_COMP_ADMIN_PHP_INFO; ?></th>
		</tr>
		<tr>
			<td>
			<?php
			ob_start();
			phpinfo(INFO_GENERAL | INFO_CONFIGURATION | INFO_MODULES);
			$phpinfo = ob_get_contents();
			ob_end_clean();
			preg_match_all('#<body[^>]*>(.*)</body>#siU', $phpinfo, $output);
			$output = preg_replace('#<table#', '<table class="adminlist" align="center"', $output[1][0]);
			$output = preg_replace('#(\w),(\w)#', '\1, \2', $output);
			$output = preg_replace('#border="0" cellpadding="3" width="600"#', 'border="0" cellspacing="1" cellpadding="4" width="95%"', $output);
			$output = preg_replace('#<hr />#', '', $output);
			echo $output;
			?>
			</td>
		</tr>
		</table>
		<?php
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_COMP_ADMIN_PERMISSIONS,"perms");
		?>
		<table class="adminform">
        <tr>
            <th colspan="2"><?php echo $adminLanguage->A_COMP_ADMIN_DIR_PERM; ?></th>
        </tr>
        <tr>
            <td><strong><?php echo $adminLanguage->A_COMP_ADMIN_FOR_ALL; ?></strong>
<?php 
mosHTML::writableCell( 'administrator/backups' );
mosHTML::writableCell( 'administrator/components' );
mosHTML::writableCell( 'administrator/modules' );
mosHTML::writableCell( 'administrator/templates/admin' );
mosHTML::writableCell( 'administrator/templates/login' );
mosHTML::writableCell( 'cache' );
mosHTML::writableCell( 'components' );
mosHTML::writableCell( 'images' );
mosHTML::writableCell( 'images/avatars' );
mosHTML::writableCell( 'images/banners' );
mosHTML::writableCell( 'images/stories' );
mosHTML::writableCell( 'language' );
mosHTML::writableCell( 'mambots' );
mosHTML::writableCell( 'mambots/content' );
mosHTML::writableCell( 'mambots/search' );
mosHTML::writableCell( 'media' );
mosHTML::writableCell( 'modules' );
mosHTML::writableCell( 'templates' );
mosHTML::writableCell( 'tmpr' );
?>
            </td>
        </tr>
        </table>
<?php 
		$tabs->endTab();
		$tabs->endPane();
	}


	static public function ListComponents() {
		global $adminLanguage;
		mosLoadAdminModule( 'components' );
	}


	/**************************/
	/* HTML DISPLAY HELP PAGE */
	/**************************/
	static public function help() {
		global $mosConfig_live_site, $adminLanguage, $mosConfig_helpurl;

		$helpurl = $mosConfig_helpurl;
		$fullhelpurl = $helpurl.'/index2.php?option=com_content&amp;task=findkey&amp;pop=1&amp;keyref=';

		$helpsearch = mosGetParam( $_REQUEST, 'helpsearch', '' );
		$page = mosGetParam( $_REQUEST, 'page', 'elxis.whatsnew.html' );
		$toc = getHelpToc( $helpsearch );

		if (!preg_match( '/(\.html)$/i', $page )) {
			$page .= '.xml';
		}
		?>
		<style type="text/css">
		.helpIndex {
			border: 0px;
			width: 95%;
			height: 100%;
			padding: 0px 5px 0px 10px;
			overflow: auto;
		}

		.helpFrame {
			border-left: 0px solid #222;
			border-right: none;
			border-top: none;
			border-bottom: none;
			height: 700px;
			padding: 0px 5px 0px 10px;
		}
		</style>
		<form name="adminForm">
		<table class="adminform" border="1">
		<tr>
			<th colspan="2" class="title"><?php echo $adminLanguage->A_HELP; ?></th>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%">
				<tr>
					<td>
					<b><?php echo $adminLanguage->A_SEARCH; ?>:</b>
					<input type="hidden" name="option" value="com_admin" />
					<input type="text" name="helpsearch" value="<?php echo $helpsearch; ?>" class="inputbox" />
					<input type="submit" value="<?php echo $adminLanguage->A_GO; ?>" class="button" />
					<input type="button" value="<?php echo $adminLanguage->A_CADMIN_CLEAR_RES; ?>" class="button" onclick="f=document.adminForm;f.helpsearch.value='';f.submit();" />
					</td>
					<td style="text-align:<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>;">
					<?php
					if ($helpurl) {
					?>
					<a href="<?php echo $fullhelpurl; ?>elxis.glossary" target="helpFrame"><?php echo $adminLanguage->A_MENU_GLOSSARY; ?></a>
					|
					<a href="<?php echo $fullhelpurl; ?>elxis.credits" target="helpFrame"><?php echo $adminLanguage->A_COMP_ADMIN_CREDITS; ?></a>
					|
					<a href="<?php echo $fullhelpurl; ?>elxis.support" target="helpFrame"><?php echo $adminLanguage->A_MENU_SUPPORT; ?></a>
					<?php
					} else {
					?>
					<a href="<?php echo HTML_admin_misc::gethelpfile('elxis.glossary.html'); ?>" target="helpFrame"><?php echo $adminLanguage->A_MENU_GLOSSARY; ?></a>
					|
					<a href="<?php echo HTML_admin_misc::gethelpfile('elxis.credits.html'); ?>" target="helpFrame"><?php echo $adminLanguage->A_COMP_ADMIN_CREDITS; ?></a>
					|
					<a href="<?php echo HTML_admin_misc::gethelpfile('elxis.support.html'); ?>" target="helpFrame"><?php echo $adminLanguage->A_MENU_SUPPORT; ?></a>
					<?php
					}
					?>
					|
					<a href="http://www.gnu.org/copyleft/gpl.html" target="helpFrame"><?php echo $adminLanguage->A_COMP_ADMIN_LICENSE; ?></a>
					|
					<a href="<?php echo $mosConfig_live_site; ?>/administrator/index2.php?option=com_admin&task=sysinfo&no_html=1" target="helpFrame"><?php echo $adminLanguage->A_MENU_SYSTEM_INFO; ?></a>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr valign="top">
			<td width="25%" valign="top">
				<strong><?php echo $adminLanguage->A_COMP_ADMIN_INDEX; ?></strong>
				<div class="helpIndex">
				<?php
				foreach ($toc as $k => $v) {
					if ($helpurl) {
						echo '&#149; <a href="'.$fullhelpurl.urlencode( $k ).'" target="helpFrame">'.$v.'</a><br />';
					} else {
						echo '&#149; <a href="'.HTML_admin_misc::gethelpfile($k).'" target="helpFrame">'.$v.'</a><br />';
					}
				}
				?>
				<br />
				</div>
			</td>
			<td valign="top">
				<iframe name="helpFrame" width="100%" src="<?php echo HTML_admin_misc::gethelpfile($page); ?>" class="helpFrame" frameborder="0"></iframe>
			</td>
		</tr>
		</table>

		<input type="hidden" name="task" value="help" />
		</form>
		<?php
	}


    /****************/
	/* PREVIEW SITE */
	/****************/
	static public function preview( $tp=0 ) {
	    global $mainframe, $adminLanguage;
	    $tp = intval( $tp );
?>

		<table class="adminform">
		<tr>
			<th width="50%" class="title">
                <?php echo $adminLanguage->A_COMP_ADMIN_SITE_PREVIEW; ?>
			</th>
			<th style="text-align:<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>;">
                <a href="<?php echo $mainframe->getCfg('live_site').'/index.php?tp='.$tp; ?>" target="_blank">
                    <?php echo $adminLanguage->A_COMP_ADMIN_OPEN_NEW_WIN; ?>
                </a>
			</th>
		</tr>
		<tr>
			<td valign="top" colspan="2">
                <iframe name="previewFrame" src="<?php echo $mainframe->getCfg('live_site').'/index.php?tp='.$tp; ?>" style="border: 0; width: 95%; height: 600px; padding: 0 5px 0 10px;"></iframe>
			</td>
		</tr>
		</table>
		<?php
	}


    /************************/
    /* PROMPT LOGOUT (AJAX) */
    /************************/
	static public function promptLogout() {
        global $adminLanguage, $database, $mainframe, $my, $_VERSION;

        $database->setQuery("SELECT name, avatar FROM #__users WHERE id='$my->id'", '#__', 1, 0);
        $row = $database->loadRow();

        $intime = intval($_SESSION['session_logintime']);
        $dur = (time() + ($mainframe->getCfg('offset') * 3600) - $intime);

        if ($_VERSION->PRODUCT != 'E'.'l'.'x'.'is') { die ('E'.'l'.'x'.'is '.'Li'.'c'.'en'.'s'.'e '.'v'.'i'.'ol'.'at'.'io'.'n!'); }
        $larray = array();
        if ($dur > 3600) {
            $hours = floor($dur/3600);
            if ($hours > 1) {
                array_push($larray, $hours.' '.$adminLanguage->A_HOURS);
            } else {
                array_push($larray, '1 '.$adminLanguage->A_HOUR);
            }
            $dur = ($dur - ($hours*3600));
        }
        if ($dur > 60) {
            $minutes = floor($dur/60);
            if ($minutes > 1) {
                array_push($larray, $minutes.' '.$adminLanguage->A_MINUTES);
            } else {
                array_push($larray, '1 '.$adminLanguage->A_MINUTE);
            }
            $dur = ($dur - ($minutes*60));
        }
        if ($dur >0) {
            array_push($larray, $dur.' '.$adminLanguage->A_SECONDS);
        }
        $logtime = implode(', ', $larray);

        if (!preg_match('/eLxis/i', $_VERSION->COPYRIGHT)) { die ('E'.'l'.'x'.'is '.'L'.'ic'.'en'.'se '.'v'.'io'.'la'.'ti'.'on!'); }
        if (($row['avatar'] != '') && file_exists($mainframe->getCfg('absolute_path').'/images/avatars/'.$row['avatar'])) {
            $img = $mainframe->getCfg('live_site').'/images/avatars/'.$row['avatar'];
        } else {
            $img = $mainframe->getCfg('live_site').'/images/avatars/noavatar.png';
        }
		?>

        <img class="elx_lightclose" src="images/close_sq16.png" onclick="javascript: hideLightBox('aLogoutBox');" alt="<?php echo $adminLanguage->A_CLOSE; ?>" title="<?php echo $adminLanguage->A_CLOSE; ?>" border="0" />
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td>
				<img src="<?php echo $img; ?>" title="<?php echo $my->username; ?>" class="elx_logoutprofimg" /><br />
				<strong><?php echo $row['name']; ?></strong>
			</td>
        </tr>
        <tr>
            <td>
				<?php echo $adminLanguage->A_SESSIONDUR; ?>: <?php echo $logtime; ?><br /><br />
				<strong><?php echo $adminLanguage->A_WISHLOUT; ?></strong>
            </td>
        </tr>
        <tr>
            <td><br />
            <a href="index2.php?option=logout" title="<?php echo $adminLanguage->A_LOGOUT.' '.$my->username; ?>"><img src="images/exit.png" border="0" alt="<?php echo $adminLanguage->A_LOGOUT.' '.$my->username; ?>" /></a> &nbsp; &nbsp;
            <a href="javascript:void(0);" onclick="javascript: hideLightBox('aLogoutBox');" title="<?php echo $adminLanguage->A_CANCEL; ?>"><img src="images/close22.png" border="0" alt="<?php echo $adminLanguage->A_CANCEL; ?>" /></a> 
            </td>
        </tr>
        </table>
		<?php 
		exit();
    }


    /**************************/
    /* FORMS URL TO HELP FILE */
    /**************************/
    static private function gethelpfile($helpfile) {
        global $mainframe, $alang;

        if (file_exists($mainframe->getCfg('absolute_path').'/help/'.$alang.'/'.$helpfile)) {
            $helpurl = $mainframe->getCfg('live_site').'/help/'.$alang.'/'.$helpfile;
        } else {
            $helpurl = $mainframe->getCfg('live_site').'/help/english/'.$helpfile;
        }
        return $helpurl;
    }

}


/**********************************/
/* COMPILE HELP TABLE OF CONTENTS */
/**********************************/
function getHelpTOC( $helpsearch ) {
	global $mainframe, $fmanager, $alang;

	$helpurl = mosGetParam( $GLOBALS, 'mosConfig_helpurl', '' );
    $engDir = $mainframe->getCfg('absolute_path').SEP.'help'.SEP.'english'.SEP;
    $langDir = $mainframe->getCfg('absolute_path').SEP.'help'.SEP.$alang.SEP;

	$files = $fmanager->listFiles( $engDir, '\.xml$|\.html$' );
	require_once($mainframe->getCfg('absolute_path').'/includes/domit/xml_domit_lite_include.php');
	$toc = array();

	foreach ($files as $file) {
        $hfile = (file_exists($langDir.$file)) ? $langDir.$file : $engDir.$file;
        $buffer = file_get_contents( $hfile );
		if (preg_match( '#<title>(.*?)</title>#', $buffer, $m )) {
			$title = eUTF::utf8_trim( $m[1] );
			if ($title) {
				if ($helpurl) {
					//strip the extension
					$file = preg_replace( '#\.xml$|\.html$#', '', $file );
				}
		        if ($helpsearch) {
		            if (eUTF::utf8_strpos( strip_tags( $buffer ), $helpsearch ) !== false) {
				    	$toc[$file] = $title;
					}
				} else {
				    $toc[$file] = $title;
				}
			}
		}
	}
    asort( $toc );
	return $toc;
}
?>
