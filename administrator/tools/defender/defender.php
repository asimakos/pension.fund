<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools/Defender
* @author: Ioannis Sannos
* @email: datahell@elxis.org
* @link: http://www.elxis.org
* @description: Defender protects your Elxis site against XSS and SQL injection attacks. It is also an IP blocker tool.
* @license: http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


define('_DEFENDER', 1);

global $mosConfig_absolute_path, $mosConfig_mailfrom, $mosConfig_dbprefix, $mosConfig_db, $adminLanguage, $fmanager, $alang;

$defbase = $mosConfig_absolute_path.'/administrator/tools/defender';

if (file_exists($defbase.'/language/'.$alang.'.php')) {
    require_once($defbase.'/language/'.$alang.'.php');
} else {
    require_once($defbase.'/language/english.php');
}

require_once($defbase.'/defender.functions.php');

$action = mosGetParam($_REQUEST, 'act', false);

//Save Defender configuration file
if (isset($_POST['savebutton'])) {
	$defmsg = defender_save();
}

//make something writable
if (isset($_POST['makewrite'])) {
    $defmsg = defender_write($_POST['makewrite']);
}

include( $defbase.'/config.php' );
if (!isset($dconf_allowedip)) { $dconf_allowedip = 0; } //compatibility with previous version

if (isset($_GET['denable'])) {
	$denable = intval($_GET['denable']);
	if (defender_enable($denable)) {
        $defmsg = _DEFL_CONFSAVESUCC;
        $dconf_enabled = $denable;
    } else {
        $defmsg = _DEFL_CONFSAVENO;
    }
}

?>
<style type="text/css">
.buttonDel {
	border: 1px solid #555555;
	color: #FFFFFF;
	background: #FF0000;
	font-weight: bold;
	margin-right: 5px;
}
.buttonAdd {
    border: 1px solid #555555;
	color: #FFFFFF;
	background: #21930E;
	font-weight: bold;
	margin-left: 5px;
}
td.fred {
    color: #FF0000;
}
a.defbutton, a.defbutton:active {
	background-color: #EEEEEE;
	text-decoration : none;
	text-align: center;
	font-weight: bold;
	color: #333333;  
	border: 1px solid #666666;
	padding: 4px 2px 4px 2px;
	margin: 2px;
	width: 96px;
	display: block;
}

a.defbutton:hover {
	background-color: #BBBBBB;
	color: #ffffff;
}
</style>

<script type="text/javascript">
function submitDbutton(pressbutton) {
	submitDform(pressbutton);
}
function submitDform(pressbutton){
	try {
		document.formsave.onsubmit();
		}
	catch(e){}
	document.formsave.submit();
}
</script>

<?php 
defender_menu($dconf_enabled);

if ($action) {
	switch ($action) {
		case 'viewlogs':
			defender_viewLogs($dconf_key);
		break;
		case 'clearlogs':
			$defmsg = (defender_clearLogs()) ? _DEFL_LOGSCLEARED : _DEFL_CNOTCLLOGS;
			$action = false; //to continue running in the same page
		break;
		case 'viewblocked':
			defender_viewBlocked($dconf_key);
		break;
		case 'clearblocked':
			$defmsg = (defender_clearBlocked()) ? _DEFL_BLOCKCLEARED : _DEFL_CNOTCLBLOCK;
			$action = false; //to continue running in the same page
		break;
		case 'addip':
		    $ip = mosGetParam($_POST, 'ip', '');
			defender_addIP($ip, $dconf_key);
		break;
		case 'deleteip':
		    $ip = mosGetParam($_POST, 'ip', '');
			defender_deleteIP($ip, $dconf_key);
		break;
		case 'addrange':
		    $range = mosGetParam($_POST, 'range', '');
			defender_addRange($range, $dconf_key);
		break;
		case 'deleterange':
		    $range = mosGetParam($_POST, 'range', '');
			defender_deleteRange($range, $dconf_key);
		break;
		case 'allowedips':
		  defender_allowedips($dconf_allowedip, $dconf_key);
		break;
		case 'addallip':
		    $ip = mosGetParam($_POST, 'ip', '');
			defender_addallIP($ip, $dconf_key, $dconf_allowedip);
		break;
		case 'deleteallip':
		    $ip = mosGetParam($_POST, 'ip', '');
			defender_deleteallIP($ip, $dconf_key, $dconf_allowedip);
		break;
		default:
            $action = false;
		break;
	}
}

if (!$action) {
?>

<form name="formsave" id="formsave" method="POST" action="index2.php">
<input type="hidden" name="savebutton" value="<?php echo $adminLanguage->A_SAVE; ?>" />
<input type="hidden" name="option" value="com_admin" />
<input type="hidden" name="task" value="tools" />
<input type="hidden" name="tname" value="defender" />
<table class="adminlist">
	<tr>
		<th class="title" colspan="3"><?php echo _DEFL_CONFIG; ?></th>
	</tr>
    <tr>
        <td colspan="3">
        <?php 
        if(isset($defmsg)) {
            echo '<br /><div class="ajaxbox">'.$defmsg.'</div><br />';
        }
        ?>
        </td>
    </tr>
	<tr>
	    <td width="120"><?php echo $adminLanguage->A_ENABLED; ?></td>
        <td width="160">
            <?php echo $adminLanguage->A_YES; ?>: 
            <input type="radio" name="fld_enabled" value="1"<?php echo ( $dconf_enabled ) ? ' checked="checked"' : ''; ?> /> 
            <?php echo $adminLanguage->A_NO; ?>: 
            <input type="radio" name="fld_enabled" value="0"<?php echo ( $dconf_enabled ) ? '' : ' checked="checked"'; ?> />
        </td>
        <td><?php echo _DEFL_ENABLEDESC; ?></td>
	</tr>
	<tr>
	    <td><?php echo _DEFL_LOGATTACKS; ?></td>
        <td>
            <?php echo $adminLanguage->A_YES; ?>: 
            <input type="radio" name="fld_log" value="1"<?php echo ( $dconf_log ) ? ' checked="checked"' : ''; ?> /> 
            <?php echo $adminLanguage->A_NO; ?>: 
            <input type="radio" name="fld_log" value="0"<?php echo ( $dconf_log ) ? '' : ' checked="checked"'; ?> />
        </td>
        <td><?php echo _DEFL_LOGATTACKSD; ?></td>
	</tr>
	<tr>
	    <td><?php echo _DEFL_PROTVARS; ?></td>
        <td>
            <select size="1" name="fld_protvars" dir="ltr" class="inputbox">
                <option value=""<?php if ($dconf_protvars == '') { echo ' selected="selected"'; } ?>><?php echo $adminLanguage->A_ALL; ?></option>
                <option value="_REQUEST"<?php if ($dconf_protvars == '_REQUEST') { echo ' selected="selected"'; } ?>>REQUEST</option>
                <option value="_POST"<?php if ($dconf_protvars == '_POST') { echo ' selected="selected"'; } ?>>POST</option>
                <option value="_GET"<?php if ($dconf_protvars == '_GET') { echo ' selected="selected"'; } ?>>GET</option>
                <option value="_COOKIE"<?php if ($dconf_protvars == '_COOKIE') { echo ' selected="selected"'; } ?>>COOKIE</option>
            </select>
        </td>
        <td><?php echo _DEFL_PROTVARSD; ?></td>
	</tr>
	<tr>
	    <td><?php echo _DEFL_MAILALERT; ?></td>
        <td>
            <?php echo $adminLanguage->A_YES; ?>: 
            <input type="radio" name="fld_mail" value="1"<?php echo ( $dconf_mail ) ? ' checked="checked"' : ''; ?> /> 
            <?php echo $adminLanguage->A_NO; ?>: 
            <input type="radio" name="fld_mail" value="0"<?php echo ( $dconf_mail ) ? '' : ' checked="checked"'; ?> />
        </td>
        <td><?php echo _DEFL_MAILALERTD; ?></td>
	</tr>
	<tr>
	    <td><?php echo $adminLanguage->A_MAIL; ?></td>
        <td><input type="text" name="fld_mailaddress" dir="ltr" size="25" maxlength="60" class="inputbox" value="<?php echo $dconf_mailaddress; ?>" /></td>
        <td><?php echo _DEFL_MAILADDR; ?> (<?php echo $mosConfig_mailfrom; ?>)</td>
	</tr>
	<tr>
	    <td><?php echo _DEFL_SITEOFFFOR; ?></td>
        <td><input type="text" name="fld_siteoff" dir="ltr" size="6" maxlength="4" class="inputbox" value="<?php echo $dconf_siteoff; ?>" /> <?php echo _DEFL_SECONDS; ?></td>
        <td><?php echo _DEFL_SITEOFFD; ?></td>
	</tr>
	<tr>
	    <td><?php echo _DEFL_BLOCKIP; ?></td>
        <td>
            <?php echo $adminLanguage->A_YES; ?>: 
            <input type="radio" name="fld_blockip" value="1"<?php echo ( $dconf_blockip ) ? ' checked="checked"' : ''; ?> />
            <?php echo $adminLanguage->A_NO; ?>: 
            <input type="radio" name="fld_blockip" value="0"<?php echo ( $dconf_blockip ) ? '' : ' checked="checked"'; ?> />
        </td>
        <td><?php echo _DEFL_BLOCKIPD; ?></td>
	</tr>
	<tr>
	    <td><?php echo _DEFL_ENCKEY; ?></td>
        <td><input type="password" name="fld_key" dir="ltr" size="25" maxlength="32" class="inputbox" value="<?php echo $dconf_key; ?>" /></td>
        <td><?php echo _DEFL_ENCKEYD; ?></td>
	</tr>
	<tr>
	    <td><?php echo _DEFL_ALLOWIPS; ?></td>
        <td>
            <select name="fld_allowedip" class="inputbox">
                <option value="0"<?php if (!$dconf_allowedip) { echo ' selected="selected"'; } ?>><?php echo $adminLanguage->A_NO; ?></option>
                <option value="1"<?php if ($dconf_allowedip == '1') { echo ' selected="selected"'; } ?>><?php echo $adminLanguage->A_ADMINISTRATION; ?></option>
                <option value="2"<?php if ($dconf_allowedip == '2') { echo ' selected="selected"'; } ?>><?php echo _DEFL_FRONTBACK; ?></option>
            </select>
        </td>
        <td><?php echo _DEFL_ALLOWIPSD; ?></td>
	</tr>
	<tr>
        <td colspan="2" valign="top">
            <fieldset>
                <legend><strong><?php echo _DEFL_FILTERS; ?></strong></legend>
                <table cellpadding="0" cellspacing="0" border="0" class="adminlist">
                    <tr>
                        <td align="center">
                            <script type="text/javascript" src="tools/defender/mta.js"></script>
                            <form>
                            <textarea name="fld_filters" dir="ltr" id="filters" class="mta" delim="X,X"><?php 
                            if (count($dconf_filters) >0) {
                                $filters = implode('X,X', $dconf_filters);
                                echo stripslashes($filters);
                            }
                            ?></textarea>
                            </form>
                            <script type="text/javascript">var mta = new MTA('mta','inputbox','buttonDel','buttonAdd');</script>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </td>
        <td valign="top">
            <h3><?php echo $adminLanguage->A_HELP; ?></h3>
            <?php echo _DEFL_FILTHELP; ?><br />
            <strong><u><?php echo _DEFL_SLOWDOWNT; ?></u></strong><br />
            <div align="justify"><?php echo _DEFL_SLOWDOWN; ?></div><br /><br />
            <strong><u><?php echo _DEFL_EXAMPLEFIL; ?></u></strong><br />
            <table width="100%" cellspacing="0" cellpadding="0" border="0" dir="ltr">
            <tr>
                <td class="fred">SELECT UNION</td><td class="fred">UNION SELECT</td><td class="fred">BENCHMARK(</td><td class="fred">ASCII(</td><td class="fred">SUBSTRING(</td>
            </tr>
            <tr>
                <td>CONCAT(</td><td>CONCAT (</td><td>CONCAT_WS</td><td class="fred">CHAR(</td><td>INNER JOIN</td>
            </tr>
            <tr>
                <td class="fred">FROM <?php echo $mosConfig_dbprefix; ?></td><td>&#039; OR &#039;</td><td>&quot; OR &quot;</td><td>INSERT(</td><td>INSERT (</td>
            </tr>
            <tr>
                <td>LEFT JOIN</td><td>RIGHT JOIN</td><td>JOIN <?php echo $mosConfig_dbprefix; ?></td><td>SELECT *</td><td>FIELD(</td>
            </tr>
            <tr>
                <td>DROP <?php echo $mosConfig_dbprefix; ?></td><td class="fred">alert(</td><td>alert (</td><td>SUBSTRING_INDEX(</td><td>FIND_IN_SET(</td>
            </tr>
            <tr>
                <td>DROP <?php echo $mosConfig_db; ?></td><td class="fred">SELECT IF</td><td class="fred"><?php echo $mosConfig_db.'.'.$mosConfig_dbprefix; ?></td><td class="fred">mosConfig_</td><td>ADODB</td>
            </tr>
            <tr>
                <td>ENCODE(</td><td>MD5(</td><td class="fred">UNION ALL</td><td>&#039;--</td><td>/**/</td>
            </tr>
            </table>
        </td>
	</tr>
    <tr>
        <td colspan="3" align="center">
        <?php 
		$s_href = "javascript:if (".$dconf_enabled." == 1){ alert('"._DEFL_SUBMITALERT."');}else{submitDbutton('tools')}";
		$s_alt = $adminLanguage->A_SAVE;
		$s_icon = 'save.png';
		?>
		<a class="defbutton" href="<?php echo $s_href;?>" title="<?php echo $s_alt; ?>">
		<img name="<?php echo $task; ?>" src="images/<?php echo $s_icon; ?>" border="0" align="middle" alt="<?php echo $s_alt; ?>" /><br />
        <?php echo $s_alt; ?></a>
        </td>
    </tr>
</table>
</form>
<br /><br />

<table class="adminform">
<tr>
    <td>
        <?php 
        if (is_writable( $defbase.'/config.php')) {
            $writeconf = '<span style="font-weight:bold; color:green;">'.$adminLanguage->A_WRITABLE.'</span>';
            $makewrite = 0;
        } else {
            $writeconf = '<span style="font-weight:bold; color:red;">'.$adminLanguage->A_UNWRITABLE.'</span>';
            $makewrite =1;
        }
        echo _DEFL_DEFCONFIS.' '.$writeconf;
        if ($makewrite) { 
        ?>
            <form name="formwrite" id="formwrite" method="POST" action="index2.php">
                <input type="submit" class="button" name="writeconf" value="<?php echo _DEFL_MAKEWRITE; ?>" />
                <input type="hidden" name="option" value="com_admin" />
                <input type="hidden" name="task" value="tools" />
                <input type="hidden" name="tname" value="defender" />
                <input type="hidden" name="makewrite" value="conf" />
            </form><br />
        <?php } ?>
    </td>
</tr>
<tr>
    <td>
        <?php 
        if (is_writable( $defbase.'/logs/ip.txt')) {
            $writeconf = '<span style="font-weight:bold; color:green;">'.$adminLanguage->A_WRITABLE.'</span>';
            $makewrite = 0;
        } else {
            $writeconf = '<span style="font-weight:bold; color:red;">'.$adminLanguage->A_UNWRITABLE.'</span>';
            $makewrite =1;
        }
        echo '/administrator/tools/defender/logs/ip.txt '.$adminLanguage->A_IS.' '.$writeconf;
        if ($makewrite) { 
        ?>
            <form name="formwriteip" id="formwriteip" method="POST" action="index2.php">
                <input type="submit" class="button" name="writeip" value="<?php echo _DEFL_MAKEWRITE; ?>" />
                <input type="hidden" name="option" value="com_admin" />
                <input type="hidden" name="task" value="tools" />
                <input type="hidden" name="tname" value="defender" />
                <input type="hidden" name="makewrite" value="ip" />
            </form><br />
        <?php } ?>
    </td>
</tr>
<tr>
    <td>
        <?php 
        if (is_writable( $defbase.'/logs/log.txt')) {
            $writeconf = '<span style="font-weight:bold; color:green;">'.$adminLanguage->A_WRITABLE.'</span>';
            $makewrite = 0;
        } else {
            $writeconf = '<span style="font-weight:bold; color:red;">'.$adminLanguage->A_UNWRITABLE.'</span>';
            $makewrite =1;
        }
        echo '/administrator/tools/defender/logs/log.txt '.$adminLanguage->A_IS.' '.$writeconf;
        if ($makewrite) { 
        ?>
            <form name="formwritelog" id="formwritelog" method="POST" action="index2.php">
                <input type="submit" class="button" name="writelog" value="<?php echo _DEFL_MAKEWRITE; ?>" />
                <input type="hidden" name="option" value="com_admin" />
                <input type="hidden" name="task" value="tools" />
                <input type="hidden" name="tname" value="defender" />
                <input type="hidden" name="makewrite" value="log" />
            </form><br />
        <?php } ?>
    </td>
</tr>
<tr>
    <td>
        <?php 
        if (is_writable( $defbase.'/logs/offline.txt')) {
            $writeconf = '<span style="font-weight:bold; color:green;">'.$adminLanguage->A_WRITABLE.'</span>';
            $makewrite = 0;
        } else {
            $writeconf = '<span style="font-weight:bold; color:red;">'.$adminLanguage->A_UNWRITABLE.'</span>';
            $makewrite =1;
        }
        echo '/administrator/tools/defender/logs/offline.txt '.$adminLanguage->A_IS.' '.$writeconf;
        if ($makewrite) { 
        ?>
            <form name="formwriteoff" id="formwriteoff" method="POST" action="index2.php">
                <input type="submit" class="button" name="writeoff" value="<?php echo _DEFL_MAKEWRITE; ?>" />
                <input type="hidden" name="option" value="com_admin" />
                <input type="hidden" name="task" value="tools" />
                <input type="hidden" name="tname" value="defender" />
                <input type="hidden" name="makewrite" value="off" />
            </form><br />
        <?php } ?>
    </td>
</tr>
<tr>
    <td>
        <?php 
        if (is_writable( $defbase.'/logs/range.txt')) {
            $writeconf = '<span style="font-weight:bold; color:green">'.$adminLanguage->A_WRITABLE.'</span>';
            $makewrite = 0;
        } else {
            $writeconf = '<span style="font-weight:bold; color:red">'.$adminLanguage->A_UNWRITABLE.'</span>';
            $makewrite =1;
        }
        echo '/administrator/tools/defender/logs/range.txt '.$adminLanguage->A_IS.' '.$writeconf;
        if ($makewrite) { 
        ?>
            <form name="formwriterange" id="formwriterange" method="POST" action="index2.php">
                <input type="submit" class="button" name="writerange" value="<?php echo _DEFL_MAKEWRITE; ?>" />
                <input type="hidden" name="option" value="com_admin" />
                <input type="hidden" name="task" value="tools" />
                <input type="hidden" name="tname" value="defender" />
                <input type="hidden" name="makewrite" value="range" />
            </form><br />
        <?php } ?>
    </td>
</tr>
<tr>
    <td>
        <?php 
        if (is_writable( $defbase.'/logs/lastmail.txt')) {
            $writeconf = '<span style="font-weight:bold; color:green">'.$adminLanguage->A_WRITABLE.'</span>';
            $makewrite = 0;
        } else {
            $writeconf = '<span style="font-weight:bold; color:red">'.$adminLanguage->A_UNWRITABLE.'</span>';
            $makewrite =1;
        }
        echo '/administrator/tools/defender/logs/lastmail.txt '.$adminLanguage->A_IS.' '.$writeconf;
        if ($makewrite) { 
        ?>
            <form name="formwritelast" id="formwritelast" method="POST" action="index2.php">
                <input type="submit" class="button" name="writelast" value="<?php echo _DEFL_MAKEWRITE; ?>" />
                <input type="hidden" name="option" value="com_admin" />
                <input type="hidden" name="task" value="tools" />
                <input type="hidden" name="tname" value="defender" />
                <input type="hidden" name="makewrite" value="last" />
            </form><br />
        <?php } ?>
    </td>
</tr>
    <?php 
    if (is_writable( $defbase.'/logs/')) {
        $writelogs = '<span style="font-weight:bold; color:green">'.$adminLanguage->A_WRITABLE.'</span>';
        $makewrite = 0;
    } else {
        $writelogs = '<span style="font-weight:bold; color:red">'.$adminLanguage->A_UNWRITABLE.'</span>';
        $makewrite =1;
    }
?>
<tr>
    <td>
        <?php echo _DEFL_DEFLOGSIS.' '.$writelogs;
        if ($makewrite) { 
        ?>
            <form name="formwrite2" id="formwrite2" method="POST" action="index2.php">
                <input type="submit" class="button" name="writelogs" value="<?php echo _DEFL_MAKEWRITE; ?>" />
                <input type="hidden" name="option" value="com_admin" />
                <input type="hidden" name="task" value="tools" />
                <input type="hidden" name="tname" value="defender" />
                <input type="hidden" name="makewrite" value="logs" />
            </form><br />
        <?php } ?>
    </td>
</tr>
</table>

<?php 
} //telos an oxi action

?>
