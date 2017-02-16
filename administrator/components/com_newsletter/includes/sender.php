<?php 
/** 
* @version: 1.1
* @copyright: Copyright (C) 2008-2009 Is Open Source. All rights reserved.
* @package: Elxis
* @subpackage: Component NewsLetter
* @author: Ioannis Sannos (Is Open Source)
* @email: info@isopensource.com
* @link: http://www.isopensource.com
* @license: http://creativecommons.org/licenses/by-nc-sa/3.0/ Creative Commons Attribution 3.0
* Elxis CMS is a Free Software
*/

define('_VALID_MOS', 1);
define('_ELXIS_ADMIN', 1);


$elxis_root = str_replace( '/administrator/components/com_newsletter/includes', '', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));
require_once($elxis_root.'/administrator/includes/auth.php');

$id = intval(mosGetParam($_GET, 'id', 0));
$format = intval(mosGetParam($_GET, 'format', 0)); //1: plain, 2: html, 3: plain + html
$forced = intval(mosGetParam($_GET, 'forced', 0));
$subgroup = eUTF::utf8_trim(mosGetParam($_GET, 'subgroup', ''));

if ((!$id) || (!$format)) { die('You are not allowed to access this resource!'); }

$database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix, $mosConfig_dbtype );
$database->debug(0);

$database->setQuery("SELECT subject, msglang FROM #__iosnl_messages WHERE id='".$id."'", '#__', 1, 0);
$msg = $database->loadRow();
if (!$msg) { die('Invalid message!'); }

$andwhere = ($forced) ? '' : " AND ((sublang='".$row['msglang']."') OR (sublang='') OR (sublang IS NULL))";
$andwhere2 = ($subgroup != '') ? " AND subgroup='".$subgroup."'" : '';

$database->setQuery("SELECT COUNT(sid) FROM #__iosnl_subscribers WHERE confirmed='1'".$andwhere.$andwhere2);
$recipients = intval($database->loadResult());
if (!$recipients) { die('No valid recipients found!'); }

global $alang;
if (file_exists($elxis_root.'/administrator/components/com_newsletter/language/'.$alang.'.php')) {
	require_once($elxis_root.'/administrator/components/com_newsletter/language/'.$alang.'.php');
} else if (file_exists($elxis_root.'/administrator/components/com_newsletter/language/'.$mosConfig_alang.'.php')) {
	require_once($elxis_root.'/administrator/components/com_newsletter/language/'.$mosConfig_alang.'.php');
} else {
	require_once($elxis_root.'/administrator/components/com_newsletter/language/english.php');
}
$iosnlLang = new newsletterLang();

require_once($elxis_root.'/administrator/components/com_newsletter/config.newsletter.php');
$iosnlCfg = new newsletterConfig();

$steps = ceil($recipients/$iosnlCfg->get('RECPERSTEP'));
unset($iosnlCfg);

if (!headers_sent()) {
	header('Content-type: text/html; charset: utf-8');
	header('Cache-Control: no-store, no-cache, must-revalidate');
	header('Cache-Control: post-check=0, pre-check=0', false);
	header('Pragma: no-cache');
}

$nlaURL = $mosConfig_live_site.'/administrator/components/com_newsletter/includes/jsprogressbar';
$reqURL = $mosConfig_live_site.'/administrator/index3.php?option=com_newsletter&task=ajaxsend&id='.$id.'&format='.$format.'&forced='.$forced.'&subgroup='.$subgroup;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $adminLanguage->A_XML_LANGUAGE; ?>" xml:lang="<?php echo $adminLanguage->A_XML_LANGUAGE; ?>">
<head>
	<title><?php echo $iosnlLang->SENDNEWSLETTER.' : '. $row['subject']; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Generator" content="Elxis - (C) Copyright 2006-<?php echo date('Y'); ?> Elxis.org.  All rights reserved." />
	<meta name="Author" content="Elxis Team" />
	<script type="text/javascript" src="<?php echo $nlaURL; ?>/prototype.js"></script>
	<script type="text/javascript" src="<?php echo $nlaURL; ?>/jsProgressBarHandler.js"></script>
	<script type="text/javascript">
		/* <![CDATA[ */
			if (!JS_BRAMUS) { var JS_BRAMUS = new Object(); }

			JS_BRAMUS.jsProgressBarAjaxHandler = Class.create();

			JS_BRAMUS.jsProgressBarAjaxHandler.prototype = {

				activeRequestCount			: 0,
				totalRequestCount			: 0,

				initialize					: function() {

						Ajax.Responders.register({
							onCreate: function() {
								this.activeRequestCount++;
								this.totalRequestCount++;
							}.bind(this),
							onComplete: function() {
								this.activeRequestCount--;
								myJsProgressBarHandler.setPercentage(
									'progress',
									parseInt((this.totalRequestCount - this.activeRequestCount) / this.totalRequestCount * 100)
								);
							}.bind(this)
						});
<?php 
						for ($i=0; $i < $steps; $i++) {
							$c = $i+1;
?>
						new Ajax.Updater('sendstatus', '<?php echo $reqURL; ?>&step=<?php echo $c; ?>', {
							parameters: { text: "call<?php echo $c; ?>", sleep: <?php echo $c * 3000; ?> }
						});
<?php 	
						}
?>
				}
			}

			function initProgressBarAjaxHandler() { myJsProgressBarAjaxHandler = new JS_BRAMUS.jsProgressBarAjaxHandler(); }
			Event.observe(window, 'load', initProgressBarAjaxHandler, false);

		/* ]]> */
	</script>

	<style type="text/css">
		a:link { text-decoration : none; color : #3366cc; border: 0px;}
		a:active { text-decoration : underline; color : #3366cc; border: 0px;}
		a:visited { text-decoration : none; color : #3366cc; border: 0px;}
		a:hover { text-decoration : underline; color : #ff5a00; border: 0px;}
		img { padding: 0px; margin: 0px; border: none;}
		body {
			margin : 0 auto;
			width:100%;
			font-family: Tahoma, Verdana, Serif;
			color: #40454b;
			font-size: 12px;
			text-align:center;
		}
		body h1 {
			font-size:14px;
			font-weight:bold;
			color:#CC0000;
			padding:5px;
			margin-left:10px;
			border-bottom:solid;
			border-bottom-width:1px;
			border-bottom-color:#333333;
		}
		#iosbar {
			margin : 0 auto;
			width:100%;
			margin:20px;
		}
	</style>
</head>
<body>
	<div style="margin : 0 auto; text-align:left;" >
		<h1>IOS - <?php echo $iosnlLang->NEWSLETTER; ?></h1>
		<div id="iosbar">
			<p><span style="color:#006600;font-weight:bold;"><?php echo sprintf($iosnlLang->SENDMSGSWAIT, $recipients); ?></span></p>
			<p><span class="progressBar percentImage1" id="progress">0%</span></p>
			<div>
				<p id="sendstatus"><?php echo $iosnlLang->PLEASEWAIT; ?></p>
			</div>
		</div>
	</div>
</body>
</html>