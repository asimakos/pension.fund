<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools/Change mode
* @author: Ioannis Sannos
* @email: datahell@elxis.org
* @link: http://www.elxis.org
* @description: Change mode to a file or folder
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $mainframe, $alang, $fmanager;

$chmodbase = $mainframe->getCfg('absolute_path').'/administrator/tools/chmod/';

if (file_exists( $chmodbase.'language/'.$alang.'.php')) {
    include_once( $chmodbase.'language/'.$alang.'.php' );
} else {
    include_once( $chmodbase.'language/english.php' );
}

if (isset($_POST['submit'])) { 
    $upath = mosGetParam( $_POST, 'fifopath', '' );
    $umode = mosGetParam( $_POST, 'mode', '' );

    $isdir = is_dir($upath) ? true : false;
    $upath = $fmanager->PathName($upath, $isdir);

    echo '<strong>'._CMOD_MSGSERVER.'</strong><br />';
    
    if (!file_exists($upath)) { die(_CMOD_PATHNOTEXIST); }
    if (!$fmanager->isElxisPath($upath)) {
        die( _CMOD_PATHNOTELXIS.'<br />'._CMOD_PATH.': '.$upath);
    }

    if ($umode < '1') {
        die( _CMOD_NOTALLOWED1.' <strong>'.$umode.'</strong>');
    }

    if ($fmanager->spChmod( $upath, $umode )) {
        die( _CMOD_CHMODSUCC.' '.$umode );
    } else {
        die( _CMOD_CHMODCNOT.' '.$upath );
    }

}

if (isset($_POST['fifopath'])) {
    if (file_exists($_POST['fifopath'])) {
        $fifopath = $_POST['fifopath'];
    } else {
        $fifopath = $mainframe->getCfg('absolute_path');
    }
} else {
    $fifopath = $mainframe->getCfg('absolute_path');
}

$isdir = is_dir($fifopath) ? true : false;
$fifopath = $fmanager->PathName($fifopath, $isdir);
$mode = substr(sprintf('%o', fileperms($fifopath)), -4);
$flags = octdec($mode);
?>

<script type="text/javascript">
function savePerms() {
	var f = document.formCHMOD;
		var perms = 0;
		if (f.fpur.checked) perms += 400;
		if (f.fpuw.checked) perms += 200;
		if (f.fpue.checked) perms += 100;
		if (f.fpgr.checked) perms += 40;
		if (f.fpgw.checked) perms += 20;
		if (f.fpge.checked) perms += 10;
		if (f.fpwr.checked) perms += 4;
		if (f.fpww.checked) perms += 2;
		if (f.fpwe.checked) perms += 1;
		f.mode.value = '0'+''+perms;
}
</script>
<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/includes/js/ajax_new.js"></script>
<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/tools/chmod/chmod.js"></script>

<form name="formCHMOD" id="formCHMOD" method="POST" action="index2.php">
<table class="adminlist">
	<tr>
		<th class="title"><?php echo _CMOD_CHMOD; ?></th>
	</tr>
	<tr>
        <td>
        <?php echo _CMOD_PATH; ?>: <input type="text" id="fifopath" name="fifopath" dir="ltr" class="inputbox" size="90" value="<?php echo $fifopath; ?>" />
        <input type="submit" class="button" name="fifoload" value="<?php echo _CMOD_LOAD; ?>" onclick="document.formCHMOD.submit();" /> 
        <input type="hidden" name="option" value="com_admin" />
        <input type="hidden" name="task" value="tools" />
        <input type="hidden" name="tname" value="chmod" />
        <input type="button" class="button" name="help" value="<?php echo _CMOD_SHOWHELP; ?>" onclick="showLayer('help');" /> 
        </td>
	</tr>
    <tr>
        <td>
        <?php echo _CMOD_OWNER; ?>: 
        <?php 
        if (!preg_match("/^(WIN)/", strtoupper(php_uname('s')))) {
            echo '<strong>'.$fmanager->getFileOwner($fifopath).'</strong>';
		} else { echo '<em>'._CMOD_ONLYUNIX.'</em>'; }
        ?>
        </td>
    </tr>
    <tr>
        <td>
		<?php echo _CMOD_CHMODTO; ?>: <input class="text_area" type="text" dir="ltr" readonly="readonly" id="mode" name="mode" size="4" value="<?php echo $mode; ?>"/>
        </td>
    </tr>
	<tr>
	   <td>
	        <table cellpadding="0" cellspacing="0" border="0" class="adminform" style="width:350px;">
	            <tr>
	                <td width="70"><?php echo _CMOD_READ; ?>:</td>
	                <td><input type="checkbox" id="fpur" name="fpur" value="1" onclick="savePerms()"<?php if ($flags & 0400) echo ' checked="checked"'; ?> /></td>
	                <td><?php echo _CMOD_USER; ?></td>
	                <td><input type="checkbox" id="fpgr" name="fpgr" value="1" onclick="savePerms()"<?php if ($flags & 040) echo ' checked="checked"'; ?> /></td>
	                <td><?php echo _CMOD_GROUP; ?></td>
	                <td><input type="checkbox" id="fpwr" name="fpwr" value="1" onclick="savePerms()"<?php if ($flags & 04) echo ' checked="checked"'; ?> /></td>
	                <td><?php echo _CMOD_WORLD; ?></td>
	            </tr>
	            <tr>
	                <td width="70"><?php echo _CMOD_WRITE; ?>:</td>
	                <td><input type="checkbox" id="fpuw" name="fpuw" value="1" onclick="savePerms()"<?php if ($flags & 0200) echo ' checked="checked"'; ?> /></td>
	                <td><?php echo _CMOD_USER; ?></td>
	                <td><input type="checkbox" id="fpgw" name="fpgw" value="1" onclick="savePerms()"<?php if ($flags & 020) echo ' checked="checked"'; ?> /></td>
	                <td><?php echo _CMOD_GROUP; ?></td>
	                <td><input type="checkbox" id="fpww" name="fpww" value="1" onclick="savePerms()"<?php if ($flags & 02) echo ' checked="checked"'; ?> /></td>
	                <td><?php echo _CMOD_WORLD; ?></td>
	            </tr>
	            <tr>
	                <td width="70"><?php echo _CMOD_EXECUTE; ?>:</td>
	                <td><input type="checkbox" id="fpue" name="fpue" value="1" onclick="savePerms()"<?php if ($flags & 0100) echo ' checked="checked"'; ?> /></td>
	                <td><?php echo _CMOD_USER; ?></td>
	                <td><input type="checkbox" id="fpge" name="fpge" value="1" onclick="savePerms()"<?php if ($flags & 010) echo ' checked="checked"'; ?> /></td>
	                <td><?php echo _CMOD_GROUP; ?></td>
	                <td><input type="checkbox" id="fpwe" name="fpwe" value="1" onclick="savePerms()"<?php if ($flags & 01) echo ' checked="checked"'; ?> /></td>
	                <td><?php echo _CMOD_WORLD; ?></td>
	            </tr>
            </table>
	   </td>
	</tr>
	<tr>	
	    <td>
        <input type="button" class="button" name="submit" value="CHMOD" onclick="doit(); return false;" ondblclick="doit(); return false;" />
        </td>
	</tr>
</table>
</form>
<br /><br />
<div id="ajaxMessage" class="ajaxbox"></div>
<br /><br />
<div id="help" class="ajaxbox" style="display:none;"><?php echo _CMOD_HELPTEXT; ?><br /><br />
<input type="button" class="button" name="hide" value="<?php echo _CMOD_HIDEHELP; ?>" onclick="hideLayer('help');" />
</div>