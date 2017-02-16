<?php 
/**
* @ Version: $Id: floodblocker.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Ioannis Sannos
* @ E-mail: datahell@elxis.org
* @ URL: http://www.elxis.org
* @ Description: Floodblocker prevents flood attacks on an Elxis site
* @ License: http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $mosConfig_absolute_path, $adminLanguage, $fmanager, $alang;

function FloodCheckPairs( $interval='0', $limit = '0') {
    $interval = intval($interval);
    $limit = intval($limit);
    if (($interval > 0) && ($limit > 0)) {
        return true;
    } else {
        return false;
    }
}

$floodbase = $mosConfig_absolute_path.'/administrator/tools/floodblocker/';

if (file_exists($mosConfig_absolute_path.'/administrator/tools/floodblocker/language/'.$alang.'.php')) {
    require_once($mosConfig_absolute_path.'/administrator/tools/floodblocker/language/'.$alang.'.php');
} else {
    require_once($mosConfig_absolute_path.'/administrator/tools/floodblocker/language/english.php');
}

//Make FloodBlocker configuration file writable
if (isset($_POST['writeconf'])) {
    if ($fmanager->spChmod($floodbase.'config.php', '0666')) {
        $floodmsg = _FLOODL_CONFPERMSUCC.' 666';
    } else {
        $floodmsg = _FLOODL_CONFPERMNO;
    }
}

//Make FloodBlocker logs dir writable
if (isset($_POST['writelogs'])) {
    if ($fmanager->spChmod($floodbase.'logs/', '0777')) {
        $floodmsg = _FLOODL_LOGSPERMSUCC.' 777';
    } else {
        $floodmsg = _FLOODL_LOGSPERMNO;
    }
}

//Save FloodBlocker configuration file
if (isset($_POST['savebutton'])) {

    $arr = '';
    $fld_enabled = intval($_POST['fld_enabled']);
    $fld_interval = intval($_POST['fld_interval']);
    $fld_timeout = intval($_POST['fld_timeout']);

    if ($fld_interval == '0') {
        $floodmsg = $adminLanguage->A_ERROR.': '._FLOODL_INVINTER;
    } else if ($fld_timeout == '0') {
        $floodmsg = $adminLanguage->A_ERROR.': '._FLOODL_INVTIME;
    } else {
        for ($i=1; $i<7; $i++) {
            $xi = 'fld_rules'.$i.'_int';
            $xl = 'fld_rules'.$i.'_lim';
            if (FloodCheckPairs( $_POST[$xi], $_POST[$xl])) {
                $arr .= $_POST[$xi].'=>'.$_POST[$xl].', ';
            }
        }
        if (strlen($arr) < 5) {
            $floodmsg = $adminLanguage->A_ERROR.': '._FLOODL_ONEPAIR;
        }
    }

    if (!isset($floodmsg)) {
        $arr = rtrim($arr);
        $arr = preg_replace('/[\,]$/', '', $arr);
        
        $data = "<?php \n\n";
        $data .= '$fconf_enabled = '.$fld_enabled.";\n";
        $data .= '$fconf_interval = '.$fld_interval.";\n";
        $data .= '$fconf_timeout = '.$fld_timeout.";\n";
        $data .= '$fconf_rules = array('.$arr.");\n\n";
        $data .= '?>';
        
        if ($fmanager->writeFile($floodbase.'config.php', $data)) {
            $floodmsg = _FLOODL_CONFSAVESUCC;
        } else {
            $floomsg = _FLOODL_CONFSAVENO;
        }
    }
}

include( $floodbase.'config.php');

$r_intervals = array();
$r_limits = array();

if ( count( $fconf_rules ) > 0 ) {
    foreach ($fconf_rules as $key => $val) {
        array_push( $r_intervals, intval($key) );
        array_push( $r_limits, intval($val) );
    }
}

for ($i=0; $i<6; $i++) {
    if (!isset($r_intervals[$i]) || ($r_intervals[$i] == '0')) {
        $r_intervals[$i] = '';
    }
    if (!isset($r_limits[$i]) || ($r_limits[$i] == '0')) {
        $r_limits[$i] = '';
    }
}

if(isset($floodmsg)) {
    echo '<div class="ajaxbox">'.$floodmsg.'</div><br />'._LEND;
}

?>

<form name="formsave" id="formsave" method="POST" action="index2.php">
<table class="adminlist">
	<tr>
		<th class="title" colspan="3"><?php echo _FLOODL_CONFIG; ?></th>
	</tr>
	<tr>
	    <td width="120"><?php echo $adminLanguage->A_ENABLED; ?></td>
        <td width="120">
            <?php echo $adminLanguage->A_YES; ?>: 
            <input type="radio" name="fld_enabled" value="1"<?php echo ( $fconf_enabled ) ? ' checked="checked"' : ''; ?> /> 
            <?php echo $adminLanguage->A_NO; ?>: 
            <input type="radio" name="fld_enabled" value="0"<?php echo ( $fconf_enabled ) ? '' : ' checked="checked"'; ?> />
        </td>
        <td><?php echo _FLOODL_ENABLEDESC; ?></td>
	</tr>
	<tr>
	    <td><?php echo _FLOODL_CRONINT; ?></td>
        <td><input type="text" name="fld_interval" dir="ltr" size="6" maxlength="6" class="inputbox" value="<?php echo $fconf_interval; ?>" /></td>
        <td><?php echo _FLOODL_CRONINTDESC; ?></td>
	</tr>
	<tr>
	    <td><?php echo _FLOODL_LOGSTIME; ?></td>
        <td><input type="text" name="fld_timeout" dir="ltr" size="6" maxlength="6" class="inputbox" value="<?php echo $fconf_timeout; ?>" /></td>
        <td><?php echo _FLOODL_LOGSTIMEDESC; ?></td>
	</tr>
	<tr>
        <td colspan="2">
            <fieldset>
                <legend><b><?php echo _FLOODL_FLOODRULES; ?></b></legend>
                <table cellpadding="0" cellspacing="0" border="0" class="adminlist">
                    <tr>
                        <td><?php echo _FLOODL_INTSECS ;?></td>
                        <td></td>
                        <td><?php echo _FLOODL_LIMREQS; ?></td>
                    </tr>
                    <tr>
                        <td align="center"><input type="text" name="fld_rules1_int" dir="ltr" size="6" maxlength="6" class="inputbox" value="<?php echo $r_intervals[0]; ?>" /></td>
                        <td align="center">&raquo;</td>
                        <td align="center"><input type="text" name="fld_rules1_lim" dir="ltr" size="6" maxlength="6" class="inputbox" value="<?php echo $r_limits[0]; ?>" /></td>
                    </tr>
                    <tr>
                        <td align="center"><input type="text" name="fld_rules2_int" dir="ltr" size="6" maxlength="6" class="inputbox" value="<?php echo $r_intervals[1]; ?>" /></td>
                        <td align="center">&raquo;</td>
                        <td align="center"><input type="text" name="fld_rules2_lim" dir="ltr" size="6" maxlength="6" class="inputbox" value="<?php echo $r_limits[1]; ?>" /></td>
                    </tr>
                    <tr>
                        <td align="center"><input type="text" name="fld_rules3_int" dir="ltr" size="6" maxlength="6" class="inputbox" value="<?php echo $r_intervals[2]; ?>" /></td>
                        <td align="center">&raquo;</td>
                        <td align="center"><input type="text" name="fld_rules3_lim" dir="ltr" size="6" maxlength="6" class="inputbox" value="<?php echo $r_limits[2]; ?>" /></td>
                    </tr>
                    <tr>
                        <td align="center"><input type="text" name="fld_rules4_int" dir="ltr" size="6" maxlength="6" class="inputbox" value="<?php echo $r_intervals[3]; ?>" /></td>
                        <td align="center">&raquo;</td>
                        <td align="center"><input type="text" name="fld_rules4_lim" dir="ltr" size="6" maxlength="6" class="inputbox" value="<?php echo $r_limits[3]; ?>" /></td>
                    </tr>
                    <tr>
                        <td align="center"><input type="text" name="fld_rules5_int" dir="ltr" size="6" maxlength="6" class="inputbox" value="<?php echo $r_intervals[4]; ?>" /></td>
                        <td align="center">&raquo;</td>
                        <td align="center"><input type="text" name="fld_rules5_lim" dir="ltr" size="6" maxlength="6" class="inputbox" value="<?php echo $r_limits[4]; ?>" /></td>
                    </tr>
                    <tr>
                        <td align="center"><input type="text" name="fld_rules6_int" dir="ltr" size="6" maxlength="6" class="inputbox" value="<?php echo $r_intervals[5]; ?>" /></td>
                        <td align="center">&raquo;</td>
                        <td align="center"><input type="text" name="fld_rules6_lim" dir="ltr" size="6" maxlength="6" class="inputbox" value="<?php echo $r_limits[5]; ?>" /></td>
                    </tr>
                </table>
            </fieldset>
        </td>
        <td valign="top"><?php echo _FLOODL_PAIRSDESC; ?></td>
	</tr>
    <tr>
        <td colspan="3" align="center">
            <input type="submit" class="button" name="savebutton" value="<?php echo $adminLanguage->A_SAVE; ?>" />
        </td>
    </tr>
</table>
<input type="hidden" name="option" value="com_admin" />
<input type="hidden" name="task" value="tools" />
<input type="hidden" name="tname" value="floodblocker" />
</form>
<br /><br />

<table class="adminform">
<tr>
    <td>
        <?php 
        if (is_writable( $floodbase.'config.php')) {
            $writeconf = '<span style="font-weight:bold; color:green">'.$adminLanguage->A_WRITABLE.'</span>';
            $makewrite = 0;
        } else {
            $writeconf = '<span style="font-weight:bold; color:red">'.$adminLanguage->A_UNWRITABLE.'</span>';
            $makewrite = 1;
        }
        echo _FLOODL_FLOODCONFIS.' '.$writeconf;

        if ($makewrite) { 
        ?>
            <form name="formwrite" id="formwrite" method="POST" action="index2.php">
                <input type="submit" class="button" name="writeconf" value="<?php echo _FLOODL_MAKEWRITE; ?>" />
                <input type="hidden" name="option" value="com_admin" />
                <input type="hidden" name="task" value="tools" />
                <input type="hidden" name="tname" value="floodblocker" />
            </form><br />
        <?php } ?>
    </td>
</tr>
    <?php 
    if (is_writable( $floodbase.'logs/')) {
        $writelogs = '<span style="font-weight:bold; color:green;">'.$adminLanguage->A_WRITABLE.'</span>';
        $makewrite = 0;
    } else {
        $writelogs = '<span style="font-weight:bold; color:red;">'.$adminLanguage->A_UNWRITABLE.'</span>';
        $makewrite = 1;
    }
?>
<tr>
    <td>
        <?php echo _FLOODL_FLOODLOGSIS.' '.$writelogs;
        if ($makewrite) { 
        ?>
            <form name="formwrite2" id="formwrite2" method="POST" action="index2.php">
                <input type="submit" class="button" name="writelogs" value="<?php echo _FLOODL_MAKEWRITE; ?>" />
                <input type="hidden" name="option" value="com_admin" />
                <input type="hidden" name="task" value="tools" />
                <input type="hidden" name="tname" value="floodblocker" />
            </form><br />
        <?php } ?>
    </td>
</tr>
</table>