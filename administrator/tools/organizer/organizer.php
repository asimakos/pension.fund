<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools/Elxis Organizer
* @author: Ioannis Sannos
* @email: datahell@elxis.org
* @link: http://www.elxis.org
* @description: Organizer keeps your contacts, notes, bookmarks and appointments.
* @note: Elxis Organizer is based on PHP Organizer by www.jeroenwijering.com (mail@jeroenwijering.com)
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$subtask = mosGetParam( $_REQUEST, 'subtask', 'not' );
$act = mosGetParam( $_REQUEST, 'act', '' );

//global $mosConfig_absolute_path, $mosConfig_live_site;
$GLOBALS['orgbase'] = $mosConfig_absolute_path.'/administrator/tools/organizer/';
$GLOBALS['orgurl'] = $mosConfig_live_site.'/administrator/index2.php?option=com_admin&task=tools&tname=organizer';

//Organizer language
global $alang;
if (file_exists( $GLOBALS['orgbase'].'language'.SEP.$alang.'.php')) {
    include_once( $GLOBALS['orgbase'].'language'.SEP.$alang.'.php' );
} else {
    include_once( $GLOBALS['orgbase'].'language'.SEP.'english.php' );
}

switch ($subtask) {
	case 'app':
	organ::org_appointments( $act );
	break;
	case 'boo':
	organ::org_bookmarks( $act );
	break;
	case 'con':
	organ::org_contacts( $act );
	break;
	default:
	case 'not':
	organ::org_notes( $act );
	break;
}



class organ {

	static private function chopline($str) { 
		return preg_replace("/\r?\n$|\r[^\n]$/", "", $str);
	}


	/******************/
	/* ADD JS SLASHES */
	/******************/
	static private function addjsslashes($str) {
		$pattern = array( "/\\\\/", "/\n/", "/\r/", "/\"/", "/\'/", "/&/", "/</", "/>/" );
		$replace = array( "\\\\\\\\", "\\n", "\\r", "\\\"", "\\'", "\\x26", "\\x3C", "\\x3E" );
		return preg_replace($pattern, $replace, $str);
	}


	/****************************/
	/* CREATE NON EXISTING FILE */
	/****************************/
	static private function checkfile($file) {
    	global $fmanager;

    	$ret = true;
    	if (!file_exists($file)) {
        	$buffer = "<?php \n";
        	$buffer .= "defined( \"_VALID_MOS\" ) or die( \"Restricted Access\" );\n";
        	$buffer .= "?>\n";
        	if (!$fmanager->createFile($file, $buffer)) { $ret = false; }
    	}
    	return $ret;
	}


	/*********/
	/* NOTES */
	/*********/
	static public function org_notes( $act='' ) { 
		global $orgbase, $orgurl, $adminLanguage, $my, $fmanager;
	

		if ($_POST) { extract($_POST, EXTR_PREFIX_SAME, "post_"); }
		if ($_GET) { extract($_GET, EXTR_PREFIX_SAME, "get_"); }

		$file = $fmanager->PathName($orgbase.'data').'notes.php';
    	organ::checkfile( $file );

		$n = 0;
		$list = array();

		$fp = @fopen($file, "r");
		$q = 0;
		while (!feof($fp)) {
		    if ($q <3) { 
		       $phpstuff = fgets($fp, 1024);
		       $q++;
		    } else {
			    $time = fgets($fp, 1024);
			    $user = fgets($fp, 1024);
			    $text = fgets($fp, 9999);

			    if ($time && $user && $text) {
				    $list[$n][0]= organ::chopline($time);
				    $list[$n][1]= organ::chopline($user);
				    $list[$n][2]= stripcslashes(organ::chopline($text));
				    $n++;
		    	}
	    	}
		}
		@fclose($fp);

		if($act == "del") {
		  	$nr = mosGetParam( $_REQUEST, 'nr', '' );
			array_splice($list, $nr, 1); 
		}
	
		if($act == "add") {
			$s = sizeof($list);
			$list[$s][0] = time();
			$list[$s][1] = $my->username;
			$list[$s][2] = stripcslashes($newtext);
		}
	
		if($act == "edit") {
			$list[$nr][0] = time();
			$list[$nr][1] = $my->username;
			$list[$nr][2] = stripcslashes($newtext);
		}

		array_multisort($list);

		if($act != '') {
			$buffer = "<?php \n";
        	$buffer .= "defined( \"_VALID_MOS\" ) or die( \"Restricted Access\" );\n";
        	$buffer .= "?>\n";

        	for ($i=0; $i<sizeof($list); $i++) {
            	$buffer .= $list[$i][0]."\n";
	  			$buffer .= $list[$i][1]."\n";
	  			$buffer .= organ::addjsslashes($list[$i][2])."\n";
	  		}
	  		if(!$fmanager->writeFile( $file, $buffer )) {
	  	    	$msg = $fmanager->last_error();
	  	    	mosRedirect( 'index2.php?option=com_admin&task=tools&tname=organizer&subtask=not', $msg );
	  		}
	  		mosRedirect( 'index2.php?option=com_admin&task=tools&tname=organizer&subtask=not' );
	  		exit();
		}
		?>

	<script type="text/javascript">
    function switchform(n) {
        switch (n) {
        <?php for ($i = 0; $i < sizeof($list); $i++) { ?>
            case <?php echo $i ?>:
                document.frm.nr.value = '<?php echo $i; ?>';
                document.frm.newtext.value = '<?php echo organ::addjsslashes($list[$i][2]); ?>';
				document.frm.newtext.focus();
                break;
        <?php } ?>
        }
    }

    function add() {
        document.frm.action = "index2.php?option=com_admin&task=tools&tname=organizer&subtask=not&act=add";
		document.frm.submit();
    }

    function edit() {
        document.frm.action = "index2.php?option=com_admin&task=tools&tname=organizer&subtask=not&act=edit";
        if(document.frm.nr.value == "-1") {
			alert('<?php echo _ORG_NOCHANADD; ?>'); 
		} else {
        	document.frm.submit();
		}
    }
	</script>

<table class="adminlist">
<tr>
	<td width="25%" align="center"><b><?php echo _ORG_NOTES; ?></b></td>
	<td width="25%" align="center"><a href="index2.php?option=com_admin&task=tools&tname=organizer&subtask=app"><b><?php echo _ORG_APPOINTMENTS; ?></b></a></td>
	<td width="25%" align="center"><a href="index2.php?option=com_admin&task=tools&tname=organizer&subtask=con"><b><?php echo _ORG_CONTACTS; ?></b></a></td>
	<td width="25%" align="center"><a href="index2.php?option=com_admin&task=tools&tname=organizer&subtask=boo"><b><?php echo _ORG_BOOKMARKS; ?></b></a></td>
</tr>
</table>
<br />

<table class="adminlist">
<tr>
	<th width="200"><?php echo $adminLanguage->A_DATE; ?></th>
	<th><?php echo $adminLanguage->A_AUTHOR; ?></th>
	<th ><?php echo _ORG_CURNOTES; ?></th>
	<th width="160"><?php echo _ORG_ACTIONS; ?></th>
</tr>

<?php
$k = 0;
for ($i=sizeof($list)-1; $i>=0; $i--) {
	echo '<tr class=\'row'.$k.'\'>'._LEND;
	echo '<td>'.eLOCALE::strftime_os ("%A, %d %B %Y %H:%M", $list[$i][0]).'</td>'._LEND;
	echo '<td>'.$list[$i][1].'</td>'._LEND;
	echo '<td>'.nl2br(htmlspecialchars($list[$i][2])).'</td>'._LEND;
	echo "<td><a href=javascript:switchform($i)>".$adminLanguage->A_EDIT."</a> | ";
	echo "<a href=\"index2.php?option=com_admin&task=tools&tname=organizer&subtask=not&act=del&nr=".$i."\">";
	echo $adminLanguage->A_DELETE.'</a></td></tr>'._LEND;
$k = 1-$k;
}
?>
<tr>
	<td colspan="4">&nbsp;</td>
</tr>
</table>

<form name="frm" method="post">
<input type="hidden" name="nr" value="-1" />
<table class="adminform">
<tr>
	<th class="row" colspan="2"><?php echo _ORG_ADDNOTE; ?></th>
</tr>
<tr>
	<td valign="top"><?php echo _ORG_NOTE; ?>:</td>
	<td><textarea rows="5" name="newtext" style="width:340px;" class="inputbox"></textarea></td>
</tr>
<tr>
    <td colspan="2" style="text-align:center; height:40px;">
     <input type="button" class="button" name="btn1" value="<?php echo $adminLanguage->A_ADD; ?>" onclick="javascript:add();" /> 
     &nbsp;  <input type="button" class="button" name="btn2" value="<?php echo _ORG_CHANGE; ?>" onclick="javascript:edit();" />
      </td>
</tr>
</table>
</form>
<?php
}


/****************/
/* APPOINTMENTS */
/****************/
static public function org_appointments( $act='' ) {
	global $orgbase, $orgurl, $adminLanguage, $fmanager;

	if ($_POST) { extract($_POST, EXTR_PREFIX_SAME, "post_"); }
	if ($_GET) { extract($_GET, EXTR_PREFIX_SAME, "get_"); }

    $file = $fmanager->PathName($orgbase.'data').'appointments.php';
    organ::checkfile( $file );

	$n = 0;
	$list = array();

    $fp = @fopen($file, "r");
	$q = 0;
	while (!feof($fp)) {
	    if ($q <3) { 
	       $phpstuff = fgets($fp, 1024);
	       $q++;
	    } else {
		    $time = fgets($fp, 1024);
		    $place = fgets($fp, 1024);
		    $event = fgets($fp, 1024);

		    if ($time && $event) {
			    $list[$n][0]= organ::chopline($time);
			    $list[$n][1]= stripcslashes(organ::chopline($place));
			    $list[$n][2]= stripcslashes(organ::chopline($event));
			    $list[$n][3]= $n;
			    $n++;
		    }
	    }
	}
	@fclose($fp);

	if($act == "del") {
		$nr = mosGetParam( $_REQUEST, 'nr', '' );
		array_splice($list, $nr, 1);
	}
	
	if($act == "add") {
		$s = sizeof($list);
		$da = preg_split("/\//",stripcslashes($newdate));
		$ta = preg_split("/\:/",stripcslashes($newtime));
		$list[$s][0] = mktime($ta[0],$ta[1],0,$da[1],$da[0],$da[2]);
		$list[$s][1] = stripcslashes($newplace);
		$list[$s][2] = stripcslashes($newevent);
		$list[$s][3] = $s;
	}

	if($act != '') {
        $buffer = "<?php \n";
        $buffer .= "defined( \"_VALID_MOS\" ) or die( \"Restricted Access\" );\n";
        $buffer .= "?>\n";

        for ($i=0; $i<sizeof($list); $i++) {
            $buffer .= $list[$i][0]."\n";
	  		$buffer .= organ::addjsslashes($list[$i][1])."\n";
	  		$buffer .= organ::addjsslashes($list[$i][2])."\n";
	  	}
	  	if(!$fmanager->writeFile( $file, $buffer )) {
	  	    $msg = $fmanager->last_error();
	  	    mosRedirect( 'index2.php?option=com_admin&task=tools&tname=organizer&subtask=app', $msg );
	  	}
	  	mosRedirect('index2.php?option=com_admin&task=tools&tname=organizer&subtask=app');
	}

	// birthday functionality from here
	$birthdayPlace = _ORG_BIRTHDAY;
	$file = $fmanager->PathName($orgbase.'data').'contacts.php';

	$n = 0;
	$birthdays = array();
	$thisyear = date('Y',time());

	$fp = @fopen($file, "r");
	$q = 0;
	while (!feof($fp)) {
	    if ($q <3) {
	       $phpstuff = fgets($fp, 1024);
	       $q++;
	    } else {
            $name = fgets($fp, 1024);
            $address = fgets($fp, 1024);
            $phone = fgets($fp, 1024);
            $email = fgets($fp, 1024);
            $birthday = fgets($fp, 1024);
            $cat = fgets($fp, 1024);
            if ($name && $cat) {
                $birthdays[$n] = preg_split("/\//",$birthday);
		
                // these lines are for correcting the +1 jump between december - januari
                if (date('m',time()) >= 11 && $birthdays[$n][1] < 02) {
                    $thisyear = date('Y',time())+1;
                } else {
                    $thisyear = date('Y',time());
                }
                $birthdays[$n][0] = mktime(0,0,0,$birthdays[$n][1],$birthdays[$n][0],$thisyear);
                $birthdays[$n][1] = htmlspecialchars($birthdayPlace);
                $birthdays[$n][2] = $name.' '. _ORG_TURNS.' '.($thisyear-$birthdays[$n][2]);
                $birthdays[$n][3] = "birthday";
                $n++;
            }
		}
	}
	@fclose($fp);

	for($i=0; $i<sizeof($birthdays); $i++) {
		if ($birthdays[$i][0] < time()+2600000 && $birthdays[$i][0] > time()-900000) {
			array_push($list, $birthdays[$i]);
		}
	}
	array_multisort($list);
?>

<table class="adminlist">
<tr>
	<td width="25%" align="center"><a href="index2.php?option=com_admin&task=tools&tname=organizer&subtask=not"><b><?php echo _ORG_NOTES; ?></b></a></td>
	<td width="25%" align="center"><b><?php echo _ORG_APPOINTMENTS; ?></b></td>
	<td width="25%" align="center"><a href="index2.php?option=com_admin&task=tools&tname=organizer&subtask=con"><b><?php echo _ORG_CONTACTS; ?></b></a></td>
	<td width="25%" align="center"><a href="index2.php?option=com_admin&task=tools&tname=organizer&subtask=boo"><b><?php echo _ORG_BOOKMARKS; ?></b></a></td>
</tr>
</table>
<br />
	<table class="adminlist">
	<tr>
		<th width="25%" align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>"><?php echo $adminLanguage->A_DATE; ?></th>
		<th colspan="2" width="60%" align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>"><?php echo _ORG_FUTUREAPP; ?></th>
		<th width="15%" align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>"><?php echo _ORG_ACTIONS; ?></th>
	</tr>
<?php
$k = 0;
	for ($i=0; $i<sizeof($list); $i++) {
		if ( $list[$i][0] >= time() ) {
			echo "<tr class=row$k>"._LEND;
			echo "<td valign=top>".date("d/m/y H:i (D)", $list[$i][0])."</td>";
			echo "<td>".$list[$i][1]."</td>";
			echo "<td>".$list[$i][2]."</td><td>";
			if($list[$i][3] !== "birthday") {
				echo "<a href=\"index2.php?option=com_admin&task=tools&tname=organizer&subtask=app&act=del&nr=".$list[$i][3]."\">";
				echo $adminLanguage->A_DELETE.'</a>';
			}
			echo "</td></tr>";
		}
	$k = 1-$k;
	}
?>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<th width="25%" align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>"><?php echo $adminLanguage->A_DATE; ?></th>
		<th colspan="2" width="60%" align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>"><?php echo _ORG_PASTAPP; ?></th>
		<th width="15%" align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>"><?php echo _ORG_ACTIONS; ?></th>
	</tr>
	<?php
	$k = 0;
	for ($i=sizeof($list)-1; $i>=0; $i--) {
		if ( $list[$i][0] <= time() ) {
			echo "<tr class=row$k>"._LEND;
			echo "<td>".date("d/m/y H:i (D)", $list[$i][0])."</td>"._LEND;
			echo "<td>".$list[$i][1]."</td>"._LEND;
			echo "<td>".$list[$i][2]."</td><td>";
			if($list[$i][3] !== "birthday") {
				echo "<a href=\"index2.php?option=com_admin&task=tools&tname=organizer&subtask=app&act=del&nr=".$list[$i][3]."\">";
				echo $adminLanguage->A_DELETE.'</a>';
			}
			echo "</td></tr>"._LEND;
		}
	$k = 1-$k;
	}
	?>
	<tr><td colspan="4">&nbsp;</td></tr>
	</table>

	<form name="frm" method="post" action="index2.php?option=com_admin&task=tools&tname=organizer&subtask=app&act=add">
	<table class="adminform">
	<tr><th colspan="4"><?php echo _ORG_ADDAPP; ?></th></tr>
	<tr>
        <td><?php echo $adminLanguage->A_DATE; ?>:</td>
        <td colspan="2">
	    <input name="newdate" dir="ltr" class="inputbox" maxlength="10" style="width:133px;" value="<?php echo date("d/m/Y",time()); ?>" />
	    <input name="newtime" dir="ltr" class="inputbox" maxlength="5" style="width:103px;" value="<?php echo date("H:i",time()); ?>" /></td>
    </tr>
	<tr>
        <td><?php echo _ORG_PLACE; ?>:</td>
        <td colspan="2"><input name="newplace" class="inputbox" maxlength="60" /></td>
    </tr>
	<tr>
        <td><?php echo _ORG_EVENT; ?>:</td>
        <td colspan="2"><input name="newevent" class="inputbox" size="60" maxlength="250" /></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:center; height:40px;">
        <input type="button" class="button" name="btn1" value="<?php echo $adminLanguage->A_ADD; ?>" onclick="javascript:document.frm.submit()" /> 
        </td>
    </tr>
	</table>
	</form>
<?php 
	}


/************/
/* CONTACTS */
/************/
static public function org_contacts( $act='' ) {
	global $orgbase, $orgurl, $adminLanguage, $fmanager;

	if ($_POST) { extract($_POST, EXTR_PREFIX_SAME, "post_"); }
	if ($_GET) { extract($_GET, EXTR_PREFIX_SAME, "get_"); }

	$file = $fmanager->PathName($orgbase.'data').'contacts.php';
    organ::checkfile( $file );

    $n = 0;
    $list = array();

    $fp = @fopen($file, "r");
    $q = 0;
    while (!feof($fp)) {
	    if ($q <3) { 
	       $phpstuff = fgets($fp, 1024);
	       $q++;
	    } else {
            $name = fgets($fp, 1024);
            $address = fgets($fp, 1024);
            $phone = fgets($fp, 1024);
            $email = fgets($fp, 1024);
            $birthday = fgets($fp, 1024);
            $cat = fgets($fp, 1024);
            if ($name && $cat) {
                $list[$n][0]= stripcslashes(organ::chopline($name));
                $list[$n][1]= stripcslashes(organ::chopline($address));
    	        $list[$n][2]= stripcslashes(organ::chopline($phone));
                $list[$n][3]= stripcslashes(organ::chopline($email));
                $list[$n][4]= stripcslashes(organ::chopline($birthday));
                $list[$n][5]= stripcslashes(organ::chopline($cat));
                $n++;
            }
        }
    }
    @fclose($fp);


	if($act == "del") {
		$nr = mosGetParam( $_REQUEST, 'nr', '' );
		array_splice($list, $nr, 1);
	}

    if($act == "add") {
    	$s = sizeof($list);
    	$list[$s][0]= stripcslashes($newname);
    	$list[$s][1]= stripcslashes($newaddress);
    	$list[$s][2]= stripcslashes($newphone);
    	$list[$s][3]= stripcslashes($newemail);
    	$list[$s][4]= stripcslashes($newbirthday);
    	if ($newcat == "") {
            $list[$s][5] = stripcslashes($selcat);
        } else {
            $list[$s][5]= stripcslashes($newcat);
        }
    }

    if($act == "edit") {
    	$list[$nr][0] = stripcslashes($newname);
    	$list[$nr][1] = stripcslashes($newaddress);
    	$list[$nr][2] = stripcslashes($newphone);
    	$list[$nr][3] = stripcslashes($newemail);
    	$list[$nr][4]= stripcslashes($newbirthday);
    	if ($newcat == "") {
            $list[$nr][5] = stripcslashes($selcat);
        } else {
            $list[$nr][5]= stripcslashes($newcat);
        }
    }
	
    $catlist = array();
    $catlist[0] = $list[0][5];

    for($i=0; $i<sizeof($list); $i++) {
    	$found = true;
    	for($j=0; $j<sizeof($catlist); $j++) {
    		if ($list[$i][5] == $catlist[$j]) {
    			$found = false;
            }
        }
    	if( $found == true) { 
    		$catlist[sizeof($catlist)] = $list[$i][5];
        }
    }
		
    array_multisort($list);
    sort($catlist);

    if($act !='') {
        $buffer = "<?php \n";
        $buffer .= "defined( \"_VALID_MOS\" ) or die( \"Restricted Access\" );\n";
        $buffer .= "?>\n";
        
    	for ($i=0; $i<sizeof($list); $i++) {
      		$buffer .= organ::addjsslashes($list[$i][0])."\n";
      		$buffer .= organ::addjsslashes($list[$i][1])."\n";
      		$buffer .= organ::addjsslashes($list[$i][2])."\n";
      		$buffer .= organ::addjsslashes($list[$i][3])."\n";
      		$buffer .= organ::addjsslashes($list[$i][4])."\n";
      		$buffer .= organ::addjsslashes($list[$i][5])."\n"; 
    	}
	  	if(!$fmanager->writeFile( $file, $buffer )) {
	  	    $msg = $fmanager->last_error();
	  	    mosRedirect( 'index2.php?option=com_admin&task=tools&tname=organizer&subtask=con', $msg );
	  	}
	  	mosRedirect( 'index2.php?option=com_admin&task=tools&tname=organizer&subtask=con' );
	  	exit();
    }
?>
    <script type="text/javascript">
    function switchform(n) {
    	switch (n) {
    	<?php for ($i = 0; $i < sizeof($list); $i++) { ?>
    		case <?php echo $i ?>:
    		document.frm.nr.value = '<?php echo $i; ?>';
    		document.frm.newname.value = '<?php echo $list[$i][0]; ?>';
    		document.frm.newaddress.value = '<?php echo $list[$i][1]; ?>';
    		document.frm.newphone.value = '<?php echo organ::addjsslashes($list[$i][2]); ?>';
    		document.frm.newemail.value = '<?php echo organ::addjsslashes($list[$i][3]); ?>';
    		document.frm.newbirthday.value = '<?php echo organ::addjsslashes($list[$i][4]); ?>';
    		document.frm.newcat.value = '<?php echo $list[$i][5]; ?>';
    		break;
    	<?php } ?>
    	}
    	document.frm.newname.focus();
    }
	
    function add() {
    	document.frm.action = "index2.php?option=com_admin&task=tools&tname=organizer&subtask=con&act=add";
    	document.frm.submit();
    }
    
    function edit() {
    	document.frm.action = "index2.php?option=com_admin&task=tools&tname=organizer&subtask=con&act=edit";
    	if(document.frm.nr.value == "-1") {
    		alert('<?php echo _ORG_NOCHANADD; ?>'); 
    	} else {
    		document.frm.submit();
        }
    }
    </script>

<table class="adminlist">
<tr>
	<td width="25%" align="center"><a href="index2.php?option=com_admin&task=tools&tname=organizer&subtask=not"><b><?php echo _ORG_NOTES; ?></b></a></td>
	<td width="25%" align="center"><a href="index2.php?option=com_admin&task=tools&tname=organizer&subtask=app"><b><?php echo _ORG_APPOINTMENTS; ?></b></a></td>
	<td width="25%" align="center"><b><?php echo _ORG_CONTACTS; ?></b></td>
	<td width="25%" align="center"><a href="index2.php?option=com_admin&task=tools&tname=organizer&subtask=boo"><b><?php echo _ORG_BOOKMARKS; ?></b></a></td>
</tr>
</table>
<br />
	<table class="adminlist">
<?php
    for ($j=0; $j<sizeof($catlist); $j++) {
?>
        <tr>
            <th align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>"><?php echo _ORG_CONTACTS.': '.$catlist[$j]; ?></th>
            <th width="300" align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>"><?php if ($j==0) { echo _ORG_ACTIONS; } ?></th>
        </tr>
<?php 
    	$n=0;
    	$k=0;
    	for ($i=0; $i<sizeof($list); $i++) {
    		if($list[$i][5] == $catlist[$j]) {
    			$n++;
    			echo "<tr class=row$k>";
    			echo "<td>".$list[$i][0]."</td>";
    			echo "<td><a href=javascript:switchform($i)>".$adminLanguage->A_DETAILS."</a> | ";
    			echo "<a href=\"index2.php?option=com_admin&task=tools&tname=organizer&subtask=con&act=del&nr=".$i."\">";
                echo $adminLanguage->A_DELETE."</a>";
    			if ($list[$i][3] != "") {
                    echo " | <a href=\"mailto:".$list[$i][3]."\">".$adminLanguage->A_EMAIL."</a>";
                }
    			echo "</td></tr>";
            }
        $k = 1-$k;        
        }
    }
?>
    <tr>
        <td colspan="2">&nbsp;</td>
    </table>

    <form name="frm" method="post">
    <input type="hidden" name="nr" value="-1" />
    <table class="adminform">
    <tr>
        <th colspan="3"><?php echo _ORG_ADDCONTACT; ?></th>
    </tr>
    <tr>
        <td><?php echo $adminLanguage->A_NAME; ?>:</td>
        <td colspan="2"><input type="text" class="inputbox" name="newname" size="50" /></td>
    </tr>
    <tr>
        <td><?php echo _ORG_ADDRESS; ?>:<br />&nbsp;</td>
        <td colspan="2"><textarea rows="2" class="inputbox" name="newaddress"></textarea></td>
    </tr>
    <tr>
        <td><?php echo _ORG_PHONE; ?>:</td>
        <td colspan="2"><input type="text" dir="ltr" class="inputbox" name="newphone" /></td>
    </tr>
    <tr>
        <td><?php echo $adminLanguage->A_EMAIL; ?>:</td>
        <td colspan="2"><input type="text" dir="ltr" class="inputbox" name="newemail" size="50" /></td>
    </tr>
    <tr>
        <td><?php echo _ORG_BIRTHDAY; ?>:</td>
        <td colspan="2"><input type="text" dir="ltr" name="newbirthday"  class="inputbox" /> &nbsp; dd/mm/yyyy</td>
    </tr>
    <tr>
        <td><?php echo $adminLanguage->A_CATEGORY; ?>:</td>
        <td colspan="2">
        <select name="selcat" class="inputbox">
        <?php
        for ($i=0; $i<sizeof($catlist); $i++) {
        	echo"<option>".$catlist[$i]."</option>\n";
        }
        ?>
        </select></td>
    </tr>
    <tr>
        <td><?php echo _ORG_NEWCATEG; ?>:</td>
        <td colspan="2"><input type="text" class="inputbox" name="newcat"></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:center; height:40px;">
        <input type="button" class="button" name="btn1" value="<?php echo $adminLanguage->A_ADD; ?>" onclick="javascript:add()" /> &nbsp;
        <input type="button" class="button" name="btn2" value="<?php echo _ORG_CHANGE; ?>" onclick="javascript:edit()" /> &nbsp;
        <input type="button" class="button" name="btn3" value="<?php echo _ORG_CLEAR; ?>" onclick="javascript:document.frm.reset()" /> 
        </td>
    </tr>
    </table>   
</form>
<?php 
}


/*************/
/* BOOKMARKS */
/*************/
static public function org_bookmarks( $act='' ) {
	global $orgbase, $orgurl, $adminLanguage, $fmanager;

	if ($_POST) { extract($_POST, EXTR_PREFIX_SAME, "post_"); }
	if ($_GET) { extract($_GET, EXTR_PREFIX_SAME, "get_"); }

	$file = $fmanager->PathName($orgbase.'data').'bookmarks.php';
    organ::checkfile( $file );

    $n = 0;
    $list = array();

    $fp = @fopen($file, "r");
    $q = 0;

	while (!feof($fp)) {
	    if ($q <3) { 
	       $phpstuff = fgets($fp, 1024);
	       $q++;
	    } else {
            $url = fgets($fp, 1024);
            $cat = fgets($fp, 1024);
            if ($cat && $url) {
                $list[$n][0]= organ::chopline($url);
                $list[$n][1]= organ::chopline($cat);
                $n++;
            }
        }
    }
    @fclose($fp);

    if($act == "del") {
        $nr = mosGetParam( $_REQUEST, 'nr', '' );
    	array_splice($list, $nr, 1);
    }
	
    if($act == "add") {
    	$s = sizeof($list);
    	$list[$s][0] = stripcslashes($newurl);
    	if ($newcat == "") { 
    		$list[$s][1] = stripcslashes($selcat);
    	} else { 
    		$list[$s][1] = stripcslashes($newcat);
        }
    }

    $catlist = array();
    $catlist[0] = $list[0][1];

    for($i=0; $i<sizeof($list); $i++) {
    	$found = true;
    	for($j=0; $j<sizeof($catlist); $j++) {
    		if ($list[$i][1] == $catlist[$j]) {
    			$found = false;
            }
        }
    	if( $found == true) { 
    		$catlist[sizeof($catlist)] = $list[$i][1];
        }
    }

    array_multisort($list);
    sort($catlist);

    if($act != '') {
        $buffer = "<?php \n";
        $buffer .= "defined( \"_VALID_MOS\" ) or die( \"Restricted Access\" );\n";
        $buffer .= "?>\n";

        for ($i=0; $i<sizeof($list); $i++) {
            $buffer .= $list[$i][0]."\n";
	  		$buffer .= $list[$i][1]."\n";
	  	}
	  	if(!$fmanager->writeFile( $file, $buffer )) {
	  	    $msg = $fmanager->last_error();
	  	    mosRedirect( 'index2.php?option=com_admin&task=tools&tname=organizer&subtask=boo', $msg );
	  	}
	  	mosRedirect( 'index2.php?option=com_admin&task=tools&tname=organizer&subtask=boo' );
	  	exit;
	}
?>

<table class="adminlist">
<tr>
	<td width="25%" align="center"><a href="index2.php?option=com_admin&task=tools&tname=organizer&subtask=not"><b><?php echo _ORG_NOTES; ?></b></a></td>
	<td width="25%" align="center"><a href="index2.php?option=com_admin&task=tools&tname=organizer&subtask=app"><b><?php echo _ORG_APPOINTMENTS; ?></b></a></td>
	<td width="25%" align="center"><a href="index2.php?option=com_admin&task=tools&tname=organizer&subtask=con"><b><?php echo _ORG_CONTACTS; ?></b></a></td>
	<td width="25%" align="center"><b><?php echo _ORG_BOOKMARKS; ?></b></td>
</tr>
</table>
<br />

<table class="adminlist">
    <?php
    for ($j=0; $j<sizeof($catlist); $j++) {
    ?>
        <tr>
            <th width="50">#</th>
            <th align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>"><?php echo _ORG_BOOKMARKS.': '.$catlist[$j]; ?></th>
    	   <th width="200" align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>"><?php if($j ==0) { echo _ORG_ACTIONS; } ?></th>
        </tr>
    <?php 
    	$n=0;
    	$k=0;
    	for ($i=0; $i<sizeof($list); $i++) {
    		if($list[$i][1] == $catlist[$j]) {
    			$n++;
    			echo "<tr class=row$k>";
    			echo "<td align=\"center\">".$n."</td>";
    			echo "<td><a href=\"".$list[$i][0]."\" target=\"_blank\">".$list[$i][0]."</td>";
    			echo "<td><a href=\"index2.php?option=com_admin&task=tools&tname=organizer&subtask=boo&act=del&nr=".$i."\">";
                echo $adminLanguage->A_DELETE.'</a></td></tr>';
            }
        $k = 1-$k;
        } 
    	echo "<tr><td colspan=3>&nbsp;</td></tr>";
    }
?>
</table>
<form name="frm" method="post" action="index2.php?option=com_admin&task=tools&tname=organizer&subtask=boo&act=add">
<table class="adminform">
<tr>
    <th colspan="2"><?php echo _ORG_ADDBKMARK; ?></th>
</tr>
<tr>
    <td><?php echo $adminLanguage->A_URL; ?>:</td>
    <td><input type="text" name="newurl" dir="ltr" value="http://" class="inputbox" size="50" /></td>
</tr>
<tr>
    <td><?php echo $adminLanguage->A_CATEGORY; ?>:</td>
    <td><select name="selcat" class="inputbox">
    <?php
    for ($i=0; $i<sizeof($catlist); $i++) {
    	echo"<option>".$catlist[$i]."</option>\n";
    }
    ?>
    </select></td>
</tr>
<tr>
    <td><?php echo _ORG_NEWCATEG; ?>:</td>
    <td><input type="text" class="inputbox" name="newcat" /></td>
</tr>
<tr>
   <td colspan="2" style="text-align:center; height:40px;">
   <input type="button" class="button" name="btn1" value="<?php echo $adminLanguage->A_ADD; ?>" onclick="javascript:document.frm.submit()" />
   </td>
</tr>
</table>
</form>
<?php 
}

} //organ class end

?>