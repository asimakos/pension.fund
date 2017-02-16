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
defined( '_DEFENDER' ) or die( 'Direct Access to this location is not allowed.' );


/**********************/
/* DEFENDER TOOL MENU */
/**********************/
function defender_menu($dconf_enabled='1') {
	global $adminLanguage;
?>
	<table class="adminlist">
	<tr>
		<th class="title" colspan="7"><?php echo _DEFL_DEFENDER.' :: '.$adminLanguage->A_MENU; ?></th>
	</tr>
    <tr>
		<td align="center" bgcolor="#CCCCCC">
		<a href="index2.php?option=com_admin&task=tools&tname=defender" target="_self" title="<?php echo _DEFL_DEFENDER; ?>" class="defbutton">
		<img src="tools/defender/images/defender32.png" border="0" alt="<?php echo _DEFL_DEFENDER; ?>" align="middle" />
		<br /><?php echo _DEFL_DEFENDER; ?></a>
		</td>
        <td align="center" bgcolor="#CCCCCC">
        <?php 
        if ($dconf_enabled) {
            $eikona = 'off.png';
            $alt = _DEFL_DISABLEDEF;
            $href = 'index2.php?option=com_admin&task=tools&tname=defender&denable=0';
        } else {
            $eikona = 'on.png';
            $alt = _DEFL_ENABLEDEF;
            $href = 'index2.php?option=com_admin&task=tools&tname=defender&denable=1';
        }
        echo "<a href='".$href."' target='_self' title='".$alt."' class='defbutton'>";
        echo "<img src='tools/defender/images/".$eikona."' border='0' alt='".$alt."' align='middle'>\n";
		echo "<br />".$alt."</a>\n";
        ?>
		</td>
		<td align="center" bgcolor="#CCCCCC">
		<a href="index2.php?option=com_admin&task=tools&tname=defender&act=viewlogs" target="_self" title="<?php echo _DEFL_VIEWLOGS; ?>" class="defbutton">
		<img src="images/edit.png" border="0" alt="<?php echo _DEFL_VIEWLOGS; ?>" align="middle" />
		<br /><?php echo _DEFL_VIEWLOGS; ?></a>
		</td>
		<td align="center" bgcolor="#CCCCCC">
		<a href="index2.php?option=com_admin&task=tools&tname=defender&act=clearlogs" target="_self" title="<?php echo _DEFL_CLEARLOGS; ?>" class="defbutton">
		<img src="images/delete.png" border="0" alt="<?php echo _DEFL_CLEARLOGS; ?>" align="middle" />
		<br /><?php echo _DEFL_CLEARLOGS; ?></a>
		</td>
		<td align="center" bgcolor="#CCCCCC">
		<a href="index2.php?option=com_admin&task=tools&tname=defender&act=viewblocked" target="_self" title="<?php echo _DEFL_VIEWBLOCK; ?>" class="defbutton">
		<img src="images/unpublish.png" border="0" alt="<?php echo _DEFL_VIEWBLOCK; ?>" align="middle" />
		<br /><?php echo _DEFL_VIEWBLOCK; ?></a>
		</td>
		<td align="center" bgcolor="#CCCCCC">
		<a href="index2.php?option=com_admin&task=tools&tname=defender&act=clearblocked" target="_self" title="<?php echo _DEFL_CLEARBLOCK; ?>" class="defbutton">
		<img src="images/delete.png" border="0" alt="<?php echo _DEFL_CLEARBLOCK; ?>" align="middle" />
		<br /><?php echo _DEFL_CLEARBLOCK; ?></a>
		</td>
		<td align="center" bgcolor="#CCCCCC">
		<a href="index2.php?option=com_admin&task=tools&tname=defender&act=allowedips" target="_self" title="<?php echo _DEFL_ALLOWIPS; ?>" class="defbutton">
		<img src="tools/defender/images/hand.png" border="0" alt="<?php echo _DEFL_ALLOWIPS; ?>" align="middle" />
		<br /><?php echo _DEFL_ALLOWIPS; ?></a>
		</td>
    </tr>
	</table>
<?php 
}


/***************************/
/* ENABLE/DISABLE DEFENDER */
/***************************/
function defender_enable( $denable='1' ) {
	global $mainframe, $fmanager;
	
	$denable = intval($denable);
	$defbase = $mainframe->getCfg('absolute_path').'/administrator/tools/defender';

	if ($fp = @fopen($defbase.'/config.php', 'r')) {
	$data = '';
		while(!feof($fp)){
			$buffer = fgets($fp,4096);
			if (strstr($buffer,"\$dconf_enabled")){
				$data .= '$dconf_enabled = '.$denable.";\n";
			} else {
				$data .= $buffer;
			}
		}
		@fclose($fp);
        if ($fmanager->writeFile($defbase.'/config.php', $data)) {
        	return true;
        } else {
        	return false;
        }
	} else { return false; }
}


/*******************************/
/* SAVE DEFENDER CONFIGURATION */
/*******************************/
function defender_save() {
	global $mainframe, $fmanager;

	$defbase = $mainframe->getCfg('absolute_path').'/administrator/tools/defender';

    $fld_enabled = intval($_POST['fld_enabled']);
    $fld_protvars = $_POST['fld_protvars'];
    $fld_log = intval($_POST['fld_log']);
    $fld_mail = intval($_POST['fld_mail']);
    $fld_mailaddress = $_POST['fld_mailaddress'];;
    $fld_siteoff = intval($_POST['fld_siteoff']);
    $fld_blockip = intval($_POST['fld_blockip']);
	$fld_key = $_POST['fld_key'];
    $fld_allowedip = intval($_POST['fld_allowedip']);

    if (!get_magic_quotes_gpc()) {
    	$fld_filters = explode('X,X', addslashes( trim($_POST['fld_filters']) ));
    } else {
    	$fld_filters = explode('X,X', trim($_POST['fld_filters']));
	}

	$arr = '';
	foreach ($fld_filters as $filter) {
	  	$tfilter = trim($filter);
		if ($tfilter != '') {
			$arr .= "'$tfilter', ";
		}
	}

    if (($fld_enabled) && ($arr == '')) {
        $defmsg = _DEFL_ERRONEFILT;
    }
	
	if ((strlen($fld_key) < 8) || (strlen($fld_key) > 32)) {
		$defmsg = _DEFL_ERRENCKEY;
	}

   if (!isset($defmsg)) {
		$arr = rtrim($arr);
        $arr = preg_replace('/[\,]$/', '', $arr);

        $data = "<?php \n\n";
        $data .= "defined( '_DEFENDER' ) or die( 'Direct Access to this location is not allowed.' );\n\n";
        $data .= '$dconf_enabled = '.$fld_enabled.";\n";
        $data .= "\$dconf_protvars = '$fld_protvars';\n";
        $data .= '$dconf_log = '.$fld_log.";\n";
        $data .= '$dconf_mail = '.$fld_mail.";\n";
        $data .= "\$dconf_mailaddress = '$fld_mailaddress';\n";
        $data .= '$dconf_siteoff = '.$fld_siteoff.";\n";
        $data .= '$dconf_blockip = '.$fld_blockip.";\n";
        $data .= '$dconf_allowedip = '.$fld_allowedip.";\n";
        $data .= "\$dconf_key = '$fld_key';\n\n";
		$data .= '$dconf_filters = array('.$arr.');';
        $data .= "\n\n?>";
        
        if ($fmanager->writeFile($defbase.'/config.php', $data)) {
            $defmsg = _DEFL_CONFSAVESUCC;
        } else {
            $defmsg = _DEFL_CONFSAVENO;
        }
    }
	return $defmsg;
}


/**************/
/* CLEAR LOGS */
/**************/
function defender_clearLogs() {
    global $mainframe ,$fmanager;

    $defbase = $mainframe->getCfg('absolute_path').'/administrator/tools/defender';
    if (!is_writable($defbase.'/logs/log.txt')) {
        if (!$fmanager->spChmod($defbase.'/logs/log.txt', '0666')) { return false; }
    }
    if ($fp = @fopen($defbase.'/logs/log.txt', 'w')) {
        @fclose($fp);
        return true;
    }
    return false;
}


/*********************/
/* CLEAR BLOCKED IPS */
/*********************/
function defender_clearBlocked() {
    global $mainframe ,$fmanager;
    
    $defbase = $mainframe->getCfg('absolute_path').'/administrator/tools/defender';
    if (!is_writable($defbase.'/logs/ip.txt')) {
        if (!$fmanager->spChmod($defbase.'/logs/ip.txt', '0666')) { return false; }
    }
    if ($fp = @fopen($defbase.'/logs/ip.txt', 'w')) {
        @fclose($fp);
        return true;
    }
    return false;
}


/* VIEW LOGS */
function defender_viewLogs( $key ) {
	global $mainframe, $fmanager, $adminLanguage;
	
	$defbase = $mainframe->getCfg('absolute_path').'/administrator/tools/defender';

	$rows = array();

	$fp = @fopen($defbase.'/logs/log.txt', 'r');
	while(!feof($fp)){
		$buffer = fgets($fp,4096);
		if (trim($buffer) != '') {
		  	//$x = str_replace('\n', '', $buffer);
		  	$x = preg_replace('/[\\n]$/', '', $buffer);
			$x = akrypto($x, $key);
			$rows[] = unserialize($x);
		}
	}
	@fclose($fp);		
?>
	<table class="adminlist">
	<tr>
		<th class="title" colspan="4"><?php echo _DEFL_VIEWLOGS; ?> (<?php echo intval(count($rows)); ?>)</th>
	</tr>
	<tr>
		<td><b>#</b></td>
		<td><b>IP</b></td>
		<td><b><?php echo $adminLanguage->A_DATE; ?></b></td>
		<td><b><?php echo _DEFL_FILTERS; ?></b></td>
	</tr>
	<?php for ($i=0; $i<count($rows); $i++) { $row = $rows[$i]; ?>
		<tr>
		<td><?php echo ($i+1); ?></td>
		<td>
			<?php
			if (trim($row['0']) != '') {
			  	echo $row['0'].' ';
			  	echo '&nbsp; [<a href="http://network-tools.com/default.asp?prog=lookup&host='.$row['0'].'" target="_blank" title="'._DEFL_GEOLOCATE.' 1">GEO 1</a>] ';
				echo '&nbsp; [<a href="http://www.hostip.info/index.html?spip='.$row['0'].'" target="_blank" title="'._DEFL_GEOLOCATE.' 2">GEO 2</a>] ';
			} else { echo '-'; }
			?>
		</td>
		<td>
			<?php 
			$xdate = date('Y-m-d H:i:s', $row['1']);
			echo mosFormatDate($xdate, '%A, %d %B %Y %H:%M:%S'); ?>
		</td>
		<td><?php echo htmlspecialchars(stripslashes($row['2'])); ?></td>
		</tr>
	<?php } ?>
	</table>
<?php 
}


function defender_viewBlocked($key) {
	global $mainframe, $adminLanguage;

	$defbase = $mainframe->getCfg('absolute_path').'/administrator/tools/defender';

	$fp = @fopen($defbase.'/logs/ip.txt', 'r');
	$data = @fread($fp, filesize($defbase.'/logs/ip.txt'));
	@fclose($fp);
	$rows = array();
	if (trim($data) != '') {
		$rows = unserialize(akrypto($data, $key));
	}

	$fr = @fopen($defbase.'/logs/range.txt', 'r');
	$data2 = @fread($fr, filesize($defbase.'/logs/range.txt'));
	@fclose($fr);
	$ranges = array();
	if (trim($data2) != '') {
		$ranges = unserialize(akrypto($data2, $key));
	}
?>
	<table class="adminlist">
	<tr>
		<th class="title" colspan="4"><?php echo _DEFL_VIEWBLOCK; ?> (<?php echo intval(count($rows)); ?>)</th>
	</tr>
	<tr>
		<td><b><?php echo _DEFL_BLOCKEDIPS; ?>:</b><br />
		<?php
		if (count($rows) >0) {
            for ($i=0; $i<count($rows); $i++) {
                $row = $rows[$i];
                echo '&#149; '.$row.' ';
			  	echo '&nbsp; [<a href="http://network-tools.com/default.asp?prog=lookup&host='.$row.'" target="_blank" title="'._DEFL_GEOLOCATE.' 1">GEO 1</a>] ';
                echo '[<a href="http://www.hostip.info/index.html?spip='.$row.'" target="_blank" title="'._DEFL_GEOLOCATE.' 2">GEO 2</a> - ';
                echo "\n";
		    }
		} else { echo $adminLanguage->A_NONE; }
		?>
		</td>
	</tr>
	<tr>
		<td><b><?php echo _DEFL_IPRANGES; ?>:</b><br />
		<?php
		if (count($ranges) >0) {
            for ($i=0; $i<count($ranges); $i++) {
                $range = $ranges[$i];
                echo '&#149; '.$range.' &nbsp; &nbsp; ';
                echo "\n";
		    }
		} else { echo $adminLanguage->A_NONE; }
		?>
		</td>
	</tr>
	</table>
    <br />
	<table class="adminform">
	<tr>
		<td width="50%">
            <form name="formadd" id="formadd" method="POST" action="index2.php" class="adminform">
                <b><?php echo _DEFL_ADDIP; ?>:</b> <input type="text" dir="ltr" size="20" maxlength="15" name="ip" value="" /> 
                <input type="submit" class="button" name="Submit" value="<?php echo $adminLanguage->A_ADD; ?>" />
                <input type="hidden" name="option" value="com_admin" />
                <input type="hidden" name="task" value="tools" />
                <input type="hidden" name="tname" value="defender" />
                <input type="hidden" name="act" value="addip" />
            </form>
        </td>
		<td>
            <form name="formdel" id="formdel" method="POST" action="index2.php" class="adminform">
                <b><?php echo _DEFL_DELETEIP; ?>:</b> <input type="text" dir="ltr" size="20" maxlength="15" name="ip" value="" /> 
                <input type="submit" class="button" name="Submit" value="<?php echo $adminLanguage->A_DELETE; ?>" />
                <input type="hidden" name="option" value="com_admin" />
                <input type="hidden" name="task" value="tools" />
                <input type="hidden" name="tname" value="defender" />
                <input type="hidden" name="act" value="deleteip" />
            </form>
        </td>
	</tr>
	</table>
	<table class="adminform">
	<tr>
		<td width="50%">
            <form name="formadd" id="formadd" method="POST" action="index2.php" class="adminform">
                <b><?php echo _DEFL_ADDRANGE; ?>:</b> <input type="text" dir="ltr" size="20" maxlength="31" name="range" value="" /> 
                <input type="submit" class="button" name="Submit" value="<?php echo $adminLanguage->A_ADD; ?>" />
                <input type="hidden" name="option" value="com_admin" />
                <input type="hidden" name="task" value="tools" />
                <input type="hidden" name="tname" value="defender" />
                <input type="hidden" name="act" value="addrange" />
            </form>
        </td>
		<td>
            <form name="formdel" id="formdel" method="POST" action="index2.php" class="adminform">
                <b><?php echo _DEFL_DELRANGE; ?>:</b> <input type="text" dir="ltr" size="20" maxlength="31" name="range" value="" /> 
                <input type="submit" class="button" name="Submit" value="<?php echo $adminLanguage->A_DELETE; ?>" />
                <input type="hidden" name="option" value="com_admin" />
                <input type="hidden" name="task" value="tools" />
                <input type="hidden" name="tname" value="defender" />
                <input type="hidden" name="act" value="deleterange" />
            </form>
        </td>
	</tr>
	</table>
	<br />
	<p align="justify">
		<?php 
		echo "<strong>".$adminLanguage->A_HELP."</strong><br />\n";
		echo _DEFL_RANGEHELP."<br /><br />\n"; 
		echo "<strong>"._DEFL_RANGEEXAMPLES.":</strong><br />\n";
		?>
		<font color="#FF9900"><strong>123.34.0.0_123.34.0.255</strong></font> <?php echo _DEFL_BLOCKFROM; ?> 
		<font color="green">123.34.0.0</font> <?php echo _DEFL_BLOCKTO; ?> <font color="#ff0000">123.34.0.255</font><br />
		<font color="#FF9900"><strong>123.34_123.35</strong></font> <?php echo _DEFL_BLOCKFROM; ?> 
		<font color="green">123.34.0.0</font> <?php echo _DEFL_BLOCKTO; ?> <font color="#ff0000">123.35.255.255</font><br />
		<font color="#FF9900"><strong>123.34.0.12_123.34.1</strong></font> <?php echo _DEFL_BLOCKFROM; ?> 
		<font color="green">123.34.0.12</font> <?php echo _DEFL_BLOCKTO; ?> <font color="#ff0000">123.34.1.255</font><br />
		<font color="#FF9900"><strong>123_138</strong></font> <?php echo _DEFL_BLOCKFROM; ?> 
		<font color="green">123.0.0.0</font> <?php echo _DEFL_BLOCKTO; ?> <font color="#ff0000">138.255.255.255</font><br />
	</p>
<?php 
}


/**********************************/
/* ADD IP TO BLOCKED IP ADDRESSES */
/**********************************/
function defender_addIP($ip='', $key) {
    global $mainframe;

    $adderr = 0;
    $long = ip2long($ip);
    if (($long == -1) || ($long == false)) { $adderr = 1; }

	$defbase = $mainframe->getCfg('absolute_path').'/administrator/tools/defender';

	if ($fr = @fopen($defbase.'/logs/ip.txt', 'r')) {
		$data = @fread($fr, filesize($defbase.'/logs/ip.txt'));
		@fclose($fr);	
	} else { $adderr = 1; }

    if (!$adderr) {
	    if (trim($data) != '') {
			$ips = unserialize(akrypto(trim($data), $key));
		} else { $ips = array(); }
        array_push($ips, $ip);
        $newdata = krypto(serialize($ips), $key);
        $fw = @fopen($defbase.'/logs/ip.txt', 'w');
		@fwrite($fw, $newdata);
		@fclose($fw);
		clearstatcache();
    }
    defender_viewBlocked($key);
}


/*******************************/
/* DELETE A BLOCKED IP ADDRESS */
/*******************************/
function defender_deleteIP($ip='', $key) {
    global $mainframe;

    $delerr = 0;
    $long = ip2long($ip);
    if (($long == -1) || ($long == false)) { $delerr = 1; }

	$defbase = $mainframe->getCfg('absolute_path').'/administrator/tools/defender';

	if ($fr = @fopen($defbase.'/logs/ip.txt', 'r')) {
		$data = @fread($fr, filesize($defbase.'/logs/ip.txt'));
		@fclose($fr);	
	} else { $delerr = 1; }

    if (!$delerr) {
	    if (trim($data) != '') {
			$ips = unserialize(akrypto(trim($data), $key));
		} else { $ips = array(); }

        $newips = array();
        if (count($ips) >0) {
            for($i=0; $i<count($ips); $i++) {
                $xip = $ips[$i];
                if ($xip != $ip) { array_push($newips, $xip); }
            }
        }
        $newdata = krypto(serialize($newips), $key);
        $fw = @fopen($defbase.'/logs/ip.txt', 'w');
		@fwrite($fw, $newdata);
		@fclose($fw);
		clearstatcache();
    }
    defender_viewBlocked($key);
}


/************************/
/* VALIDATE AN IP RANGE */
/************************/
function defender_validateRange($range) {
    if(!preg_match('_', $range)) { return false; }

    $r = explode('_', $range);
    if(count($r) != '2') { return false; }

	$s = defender_analyzeIP($r[0]);
	$e = defender_analyzeIP($r[1], 0);

	for ($i= 0; $i<4; $i++) {
		if ($e[$i] < $s[$i]) { return false; }
	}
	return true;
}


/***********************/
/* ANALYZE A RANGED IP */
/***********************/
function defender_analyzeIP($ip, $start=1) {
  	$add = ($start == 1) ? '0': '255';
	$arr = explode('.', $ip);
	$c = count($arr);
	switch ($c) {
	  	case '4':
	  	break;
		case '3':
			array_push($arr, $add);
		break;
		case '2':
			array_push($arr, $add, $add);
		break;
		case '1':
			array_push($arr, $add, $add, $add);
		break;
		default:
			return false;
		break;
	}
	return $arr;
}


/********************/
/* ADD NEW IP RANGE */
/********************/
function defender_addRange($range='', $key) {
    global $mainframe;

    $adderr = 0;
    if (!defender_validateRange($range)) { $adderr = 1; }

	$defbase = $mainframe->getCfg('absolute_path').'/administrator/tools/defender';

	if ($fr = @fopen($defbase.'/logs/range.txt', 'r')) {
		$data = @fread($fr, filesize($defbase.'/logs/range.txt'));
		@fclose($fr);	
	} else { $adderr = 1; }

    if (!$adderr) {
	    if (trim($data) != '') {
			$ranges = unserialize(akrypto(trim($data), $key));
		} else { $ranges = array(); }
        array_push($ranges, $range);
        $newdata = krypto(serialize($ranges), $key);
        $fw = @fopen($defbase.'/logs/range.txt', 'w');
		@fwrite($fw, $newdata);
		@fclose($fw);
		clearstatcache();
    }
    defender_viewBlocked($key);
}


/*******************/
/* DELETE IP RANGE */
/*******************/
function defender_deleteRange($range='', $key) {
    global $mainframe;

    $delerr = 0;
    if (!defender_validateRange($range)) { $delerr = 1; }

	$defbase = $mainframe->getCfg('absolute_path').'/administrator/tools/defender';

	if ($fr = @fopen($defbase.'/logs/range.txt', 'r')) {
		$data = @fread($fr, filesize($defbase.'/logs/range.txt'));
		@fclose($fr);	
	} else { $delerr = 1; }

    if (!$delerr) {
	    if (trim($data) != '') {
			$ranges = unserialize(akrypto(trim($data), $key));
		} else { $ranges = array(); }

        $newranges = array();
        if (count($ranges) >0) {
            for($i=0; $i<count($ranges); $i++) {
                $xrange = $ranges[$i];
                if ($xrange != $range) { array_push($newranges, $xrange); }
            }
        }
        $newdata = krypto(serialize($newranges), $key);
        $fw = @fopen($defbase.'/logs/range.txt', 'w');
		@fwrite($fw, $newdata);
		@fclose($fw);
		clearstatcache();
    }
    defender_viewBlocked($key);
}


/***************************/
/* MAKE LOG FILES WRITABLE */
/***************************/
function defender_write($what='conf') {
    global $mainframe, $fmanager;

    $defbase = $mainframe->getCfg('absolute_path').'/administrator/tools/defender';
    
    $defmsg = 'Invalid Input';
    switch ($what) {
        case 'conf':
            if ($fmanager->spChmod($defbase.'/config.php', '0666')) {
                $defmsg = _DEFL_CONFPERMSUCC.' 666';
            } else { $defmsg = _DEFL_CONFPERMNO; }
        break;
        case 'ip':
            if ($fmanager->spChmod($defbase.'/logs/ip.txt', '0666')) {
                $defmsg = _DEFL_PERMSUCC.' 666';
            } else { $defmsg = _DEFL_PERMFAIL.' ip.txt'; }
        break;
        case 'last':
            if ($fmanager->spChmod($defbase.'/logs/lastmail.txt', '0666')) {
                $defmsg = _DEFL_PERMSUCC.' 666';
            } else { $defmsg = _DEFL_PERMFAIL.' lastmail.txt'; }
        break;
        case 'log':
            if ($fmanager->spChmod($defbase.'/logs/log.txt', '0666')) {
                $defmsg = _DEFL_PERMSUCC.' 666';
            } else { $defmsg = _DEFL_PERMFAIL.' log.txt'; }
        break;
        case 'off':
            if ($fmanager->spChmod($defbase.'/logs/offline.txt', '0666')) {
                $defmsg = _DEFL_PERMSUCC.' 666';
            } else { $defmsg = _DEFL_PERMFAIL.' offline.txt'; }
        break;
        case 'range':
            if ($fmanager->spChmod($defbase.'/logs/range.txt', '0666')) {
                $defmsg = _DEFL_PERMSUCC.' 666';
            } else { $defmsg = _DEFL_PERMFAIL.' range.txt'; }
        break;
        case 'logs':
            if ($fmanager->spChmod($defbase.'/logs/', '0777')) {
                $defmsg = _DEFL_LOGSPERMSUCC.' 777';
            } else { $defmsg = _DEFL_LOGSPERMNO; }
        break;
        default:
        break;
    }
    return $defmsg;
}


/*****************************/
/* VIEW ALLOWED IP ADDRESSES */
/*****************************/
function defender_allowedips($allip, $key='') {
	global $mainframe, $adminLanguage;

	$defbase = $mainframe->getCfg('absolute_path').'/administrator/tools/defender';

	$fp = @fopen($defbase.'/logs/allowed.txt', 'r');
	$data = @fread($fp, filesize($defbase.'/logs/allowed.txt'));
	@fclose($fp);
	$rows = array();
	if (trim($data) != '') {
		$rows = unserialize(akrypto($data, $key));
	}
?>
	<table class="adminlist">
	<tr>
		<th class="title"><?php echo _DEFL_ALLOWIPS; ?> (<?php echo intval(count($rows)); ?>)</th>
	</tr>
	<tr>
		<td>
        <?php 
            switch ($allip) {
                case '1': echo _DEFL_ONLACCADM.':'; break;
                case '2': echo _DEFL_ONLACCSAD.':'; break;
                default: echo _DEFL_ALLOWDIS; break;
            }
        ?>
        <br /><br />
		<?php
		if (count($rows) >0) {
            for ($i=0; $i<count($rows); $i++) {
                $row = $rows[$i];
                echo '&#149; <strong>'.$row.'</strong> &nbsp; &nbsp;';
		    }
		} else { echo '<strong>'.$adminLanguage->A_NONE.'</strong>'; }
		?>
		</td>
	</tr>
	</table>
    <br />
	<table class="adminform">
	<tr>
		<td width="50%">
            <form name="formadd" id="formadd" method="POST" action="index2.php" class="adminform">
                <b><?php echo _DEFL_ADDIP; ?>:</b> <input type="text" dir="ltr" size="20" maxlength="15" name="ip" value="" /> 
                <input type="submit" class="button" name="Submit" value="<?php echo $adminLanguage->A_ADD; ?>" />
                <input type="hidden" name="option" value="com_admin" />
                <input type="hidden" name="task" value="tools" />
                <input type="hidden" name="tname" value="defender" />
                <input type="hidden" name="act" value="addallip" />
            </form>
        </td>
		<td>
            <form name="formdel" id="formdel" method="POST" action="index2.php" class="adminform">
                <b><?php echo _DEFL_DELETEIP; ?>:</b> <input type="text" dir="ltr" size="20" maxlength="15" name="ip" value="" /> 
                <input type="submit" class="button" name="Submit" value="<?php echo $adminLanguage->A_DELETE; ?>" />
                <input type="hidden" name="option" value="com_admin" />
                <input type="hidden" name="task" value="tools" />
                <input type="hidden" name="tname" value="defender" />
                <input type="hidden" name="act" value="deleteallip" />
            </form>
        </td>
	</tr>
	</table>
<?php 
}


/**********************************/
/* ADD IP TO ALLOWED IP ADDRESSES */
/**********************************/
function defender_addallIP($ip='', $key, $allip) {
    global $mainframe, $fmanager;

    $adderr = 0;
    $long = ip2long($ip);
    if (($long == -1) || ($long == false)) { $adderr = 1; }

	$defbase = $mainframe->getCfg('absolute_path').'/administrator/tools/defender';

	if ($fr = @fopen($defbase.'/logs/allowed.txt', 'r')) {
		$data = @fread($fr, filesize($defbase.'/logs/allowed.txt'));
		@fclose($fr);	
	} else { $adderr = 1; }

    if (!$adderr) {
	    if (trim($data) != '') {
			$ips = unserialize(akrypto(trim($data), $key));
		} else { $ips = array(); }
        array_push($ips, $ip);
        $newdata = krypto(serialize($ips), $key);
        $fmanager->writeFile($defbase.'/logs/allowed.txt', $newdata);
		@clearstatcache();
    }
    defender_allowedips($allip, $key);
}


/*******************************/
/* DELETE AN ALLOWED IP ADDRESS */
/*******************************/
function defender_deleteallIP($ip='', $key, $allip) {
    global $mainframe, $fmanager;

    $delerr = 0;
    $long = ip2long($ip);
    if (($long == -1) || ($long == false)) { $delerr = 1; }

	$defbase = $mainframe->getCfg('absolute_path').'/administrator/tools/defender';

	if ($fr = @fopen($defbase.'/logs/allowed.txt', 'r')) {
		$data = @fread($fr, filesize($defbase.'/logs/allowed.txt'));
		@fclose($fr);	
	} else { $delerr = 1; }

    if (!$delerr) {
	    if (trim($data) != '') {
			$ips = unserialize(akrypto(trim($data), $key));
		} else { $ips = array(); }

        $newips = array();
        if (count($ips) >0) {
            for($i=0; $i<count($ips); $i++) {
                $xip = $ips[$i];
                if ($xip != $ip) { array_push($newips, $xip); }
            }
        }
        $newdata = krypto(serialize($newips), $key);
        $fmanager->writeFile($defbase.'/logs/allowed.txt', $newdata);
		@clearstatcache();
    }
    defender_allowedips($allip, $key);
}


/********************/
/* ENCRYPT A STRING */
/********************/
function krypto($str, $ky='') {
	if ($ky == '') { return $str; }
	$ky = str_replace(chr(32), '', $ky);
	if (strlen($ky)<8) { $this->init_error = 1;  return false; }
	$kl = (strlen($ky)<32) ? strlen($ky) : 32;
	$k = array();
	for ($i=0; $i<$kl; $i++) {
		$k[$i] = ord($ky{$i})&0x1F;
	}
	$j=0;
	for ($i=0; $i<strlen($str); $i++) {
		$e = ord($str{$i});
		$str{$i} = ($e&0xE0) ? chr($e^$k[$j]) : chr($e);
		$j++;
		$j= ($j==$kl) ? 0 : $j;
	}
    return base64_encode($str);
}


/********************/
/* DECRYPT A STRING */
/********************/
function akrypto($str, $ky='') {
  	$str= base64_decode($str);
	if ($ky == '') { return $str; }
	$ky = str_replace(chr(32), '', $ky);
	if (strlen($ky)<8) { $this->init_error = 1;  return false; }
	$kl = (strlen($ky)<32) ? strlen($ky) : 32;
	$k = array();
	for ($i=0; $i<$kl; $i++) {
		$k[$i] = ord($ky{$i})&0x1F;
	}
	$j=0;
	for ($i=0; $i<strlen($str); $i++) {
		$e = ord($str{$i});
		$str{$i} = ($e&0xE0) ? chr($e^$k[$j]) : chr($e);
		$j++;
		$j= ($j==$kl) ? 0 : $j;
	}
    return $str;
}

?>