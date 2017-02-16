<?php 
/**
* @version: $Id: admin.users.php 2527 2009-09-29 10:55:48Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Users
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!($acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'all' ) | 
    $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_users' ))) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$task = trim( mosGetParam( $_REQUEST, 'task', null ) );
$cid = mosGetParam( $_REQUEST, 'cid', array( 0 ) );
if (!is_array( $cid )) {
	$cid = array ( 0 );
}

//in order to work direct edit user link with register_globals off
$id = mosGetParam( $_REQUEST, 'id', '0' );

switch ($task) {
	case 'new':
	editUser( 0, $option);
	break;
	case 'edit':
	editUser( intval( $cid[0] ), $option );
	break;
	case 'editA':
	editUser( $id, $option );
	break;
	case 'save':
	case 'apply':
 	saveUser( $option, $task );
	break;
	case 'remove':
	removeUsers( $cid, $option );
	break;
	case 'block':
	changeUserBlock( $cid, 1 );
	break;
	case 'unblock':
	changeUserBlock( $cid, 0 );
	break;
	case 'logout':
	logoutUser( $cid, $option, $task );
	break;
	case 'flogout':
	logoutUser( $id, $option, $task );
	break;
	case 'cancel':
	cancelUser( $option );
	break;
	case 'contact':
	$contact_id = mosGetParam( $_POST, 'contact_id', '' );
	mosRedirect( 'index2.php?option=com_contact&task=editA&id='. $contact_id );
	break;
    case 'extra':
    case 'cancelExtra':
    showExtra( $option );
    break;
	case 'newExtra':
	editExtra( 0, $option);
	break;
	case 'editExtra':
	editExtra( intval( $cid[0] ), $option );
	break;
	case 'editExtraA':
	editExtra( $id, $option );
	break;
	case 'saveExtra':
	case 'applyExtra':
 	saveExtra( $option, $task );
	break;
	case 'removeExtra':
	removeExtra( $cid, $option );
	break;
	case "publish":
	publishExtra( $cid, 1, $option);
	break;
	case "unpublish":
	publishExtra( $cid, 0, $option);
	break;
	case 'orderup':
	orderExtra( $cid[0], -1, $option );
	break;
	case 'orderdown':
	orderExtra( $cid[0], 1, $option );
	break;
	default:
	showUsers( $option );
	break;
}


function showUsers( $option ) {
	global $database, $mainframe, $my, $acl, $adminLanguage;

	$filter_type	= $mainframe->getUserStateFromRequest("filter_type{$option}", 'filter_type', 0 );
	$filter_logged	= $mainframe->getUserStateFromRequest("filter_logged{$option}", 'filter_logged', 0 );
	$filter_enabled	= intval($mainframe->getUserStateFromRequest("filter_enabled{$option}", 'filter_enabled', -1));
	$filter_expired	= intval($mainframe->getUserStateFromRequest("filter_expired{$option}", 'filter_expired', -1));
	$limit 			= $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mainframe->getCfg('list_limit'));
	$limitstart 	= $mainframe->getUserStateFromRequest("view{$option}limitstart", 'limitstart', 0 );
	$search 		= $mainframe->getUserStateFromRequest("search{$option}", 'search', '' );
	$search 		= $database->getEscaped( eUTF::utf8_trim( eUTF::utf8_strtolower( $search ) ) );
	$where 			= array();
    
    //in order to work 'filtered by' icons with register_globals off
    $formfilters = array(
        'filter_type' => $filter_type,
        'filter_logged' => $filter_logged,
        'filter_enabled' => $filter_enabled,
        'filter_expired' => $filter_expired
    );
    
	if (isset( $search ) && $search!= "") {
		$where[] = "(a.username LIKE '%$search%' OR a.email LIKE '%$search%' OR a.name LIKE '%$search%')";
	}

	if ($filter_type) {
	   $where[] = "a.usertype = '$filter_type'";
	}	

    switch ($filter_enabled) {
        case 0: $where[] = "a.block = '0'"; break;
        case 1: $where[] = "a.block = '1'"; break;
        default: break;
    }

    switch ($filter_expired) {
        case 0: $where[] = "a.expires < '".date('Y-m-d H:i:s')."'"; break;
        case 1: $where[] = "a.expires > '".date('Y-m-d H:i:s')."'"; break;
        default: break;
    }

	if ($filter_logged == 1) {
		$where[] = "s.userid = a.id";
	} else if ($filter_logged == 2) {
		$where[] = "s.userid IS NULL";
	}

	$pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;

	// exclude any child group id's for this user
	$pgids = $acl->get_group_children( $my->gid, 'ARO', 'RECURSE' );
	if (is_array( $pgids ) && count( $pgids ) > 0) {
		$where[] = "(a.gid NOT IN (" . implode( ',', $pgids ) . "))";
	}

	$query = "SELECT COUNT(a.id) FROM #__users a";

	if ($filter_logged == 1 || $filter_logged == 2) {
		$query .= "\n INNER JOIN #__session s ON s.userid = a.id";
	}

	$query .= (count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : '');
	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$idjoin = ($pg) ? 'aro.value = a.id::VARCHAR' : 'aro.value = a.id';
	$query = "SELECT DISTINCT a.*, g.name AS groupname FROM #__users a"
	."\n INNER JOIN #__core_acl_aro aro ON ".$idjoin
	."\n INNER JOIN #__core_acl_groups_aro_map gm ON gm.aro_id = aro.aro_id"
	."\n INNER JOIN #__core_acl_aro_groups g ON g.group_id = gm.group_id";

	if ($filter_logged == 1 || $filter_logged == 2) {
		$query .= "\n INNER JOIN #__session s ON s.userid = a.id";
	}
	$query .= (count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : "");

	$database->setQuery($query, '#__', $pageNav->limit, $pageNav->limitstart);
	$rows = $database->loadObjectList();

	if ($database->getErrorNum()) {
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."');</script>\n";
		return false;
	}

	for ($i = 0; $i < count($rows); $i++) {
		$row = &$rows[$i];
		$database->setQuery("SELECT COUNT(userid) FROM #__session WHERE userid = '".intval($row->id)."'");
		$row->loggedin = $database->loadResult();
	}

	//create list of user activation status
	$actstatus[] = mosHTML::makeOption('-1', '- '.$adminLanguage->A_CMP_USS_ALL.' -');
	$actstatus[] = mosHTML::makeOption('0', $adminLanguage->A_CMP_USS_ENBLD);
	$actstatus[] = mosHTML::makeOption('1', $adminLanguage->A_CMP_USS_BLCKD);
	$lists['enabled'] = mosHTML::selectList( $actstatus, 'filter_enabled', 'class="selectbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $filter_enabled);

	//create list of user account expiration status
	$expstatus[] = mosHTML::makeOption('-1', '- '.$adminLanguage->A_CMP_USS_ALL.' -');
	$expstatus[] = mosHTML::makeOption('0', $adminLanguage->A_USERS_ACCEXPIRED);
	$expstatus[] = mosHTML::makeOption('1', $adminLanguage->A_USERS_ACCNACTIVE);
	$lists['expired'] = mosHTML::selectList($expstatus, 'filter_expired', 'class="selectbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $filter_expired);

	//get list of Groups for dropdown filter
	$query = "SELECT name AS value, name AS text FROM #__core_acl_aro_groups"
	."\n WHERE name != 'ROOT' AND name != 'USERS'";
	$types[] = mosHTML::makeOption( '0', '- '.$adminLanguage->A_ALL.' -' );
	$database->setQuery( $query );
	$types = array_merge( $types, $database->loadObjectList() );
	$lists['type'] = mosHTML::selectList( $types, 'filter_type', 'class="selectbox" size="1" dir="ltr" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_type);

	// get list of Log Status for dropdown filter
	$logged[] = mosHTML::makeOption(0, '- '.$adminLanguage->A_CMP_USS_ALL.' -');
	$logged[] = mosHTML::makeOption(1, $adminLanguage->A_CMP_USS_LOGIN);
	$lists['logged'] = mosHTML::selectList( $logged, 'filter_logged', 'class="selectbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_logged);

	HTML_users::showUsers($rows, $pageNav, $search, $option, $lists, $formfilters);
}


/************************/
/* PREPARE TO EDIT USER */
/************************/
function editUser( $uid='0', $option='users' ) {
	global $database, $my, $acl, $adminLanguage, $mosConfig_pub_langs, $mosConfig_lang;

	$row = new mosUser( $database );
	$row->load( $uid );
	if ( $uid ) {
		$query = "SELECT * FROM #__contact_details WHERE user_id='". $row->id ."'";
		$database->setQuery( $query );
		$contact = $database->loadObjectList();
	} else {
		$contact = NULL;
		$row->block = 0;
	}
    if (trim($row->preflang) == '') { $row->preflang == $mosConfig_lang; }
    
	//Elxis advanced check: Check if user has enough previleges to edit selected user
	if ( !$acl->allow_edit( $my->gid, $row->gid, 'EDITUSER' ) ) {
		mosRedirect( 'index2.php?option=com_users', $adminLanguage->A_NOT_AUTH );
	}

	/*
    get user's extra fields in an array
    $extrafields: extraid1=value1\value2\...|extraid2=value1\value2\...|...
    normaly only one value per extraid except in case the field is a checkbox where can have 
    multiple values seperated with forward slashes (/)
	*/
    $usrfields = explode("|", $row->extrafields);

	//$ufields is an array having as key the extraid and value the extra field value for the selected user
	$ufields = array();
	foreach ($usrfields as $usrfield) {
		$uf = preg_split("/[\=]/", $usrfield, 2);
		$ufid = intval($uf[0]); //if invalid then extraid=0
        $ufval = preg_split('/[\/]+/', $uf[1], -1, PREG_SPLIT_NO_EMPTY);
        if ( count($ufval) < 1 ) { $ufval = array(''); }

		if (($ufid != 0) && ($ufid != '')) {
			$ufields[$ufid] = $ufval;
		}
	}

	//get system published extra fields
	$query = "SELECT * FROM #__users_extra WHERE published='1' ORDER BY ordering, name";
	$database->setQuery( $query );
	$fields = $database->loadObjectList();
	
	$lists['extra'] = '';
	$lists['reqs'] = array(); //list of required fields elements

	if (count($fields) > 0 ) {
        $attrs = "style=\"width:140px; float:left;\"";
    	for ($q=0; $q<count($fields); $q++) {
    		$field = &$fields[$q];
    		$ckid = $field->extraid;

    		if ($ufields[$ckid]) {
    			$fvals = $ufields[$ckid];
    		} else {
    			$fvals = explode("|", $field->defvalue);
    		}
            $options = explode("|", $field->eoptions);
            
            $req = 0;
            if ($field->etype == 'text' && $field->required == '1') {
                $req = 1;
                $lists['reqs'][] = 'req'.$field->extraid;
            }

    	   $lists['extra'] .= mosHTML::xfieldForm( $field->extraid, $field->name, $options, $fvals, $field->etype, $field->readonly, $field->halign, $field->maxlength, $attrs, $req);
    	   $lists['extra'] .= '<br /><br />';
    	}
    } else {
        $lists['extra'] = '<br />'.$adminLanguage->A_CMP_USS_NOEXTRA.'<br /><br />';
    }

    if ( $row->gid == 25 ) {
		$lists['gid'] = '<input type="hidden" name="gid" value="'.$my->gid.'" /><b>'. $adminLanguage->A_SUPER_ADMIN .'</b>';
	} else if ( $my->gid == 24 && $row->gid == 24 ) {
		$lists['gid'] = '<input type="hidden" name="gid" value="'.$my->gid.'" /><b>'. $adminLanguage->A_ADMINISTRATOR .'</b>';
	} else {
		// ensure user can't add group higher than themselves
		$my_groups = $acl->get_object_groups( 'users', $my->id, 'ARO' );
		if (is_array( $my_groups ) && count( $my_groups ) > 0) {
			$ex_groups = $acl->get_group_children( $my_groups[0], 'ARO', 'RECURSE' );
		} else {
			$ex_groups = array();
		}
		$gtree = $acl->get_group_children_tree( null, 'USERS', false );        

		//remove users 'above' me
		$i = 0;
		while ($i < count( $gtree )) {
			if (in_array( $gtree[$i]->value, $ex_groups )) {
				array_splice( $gtree, $i, 1 );
			} else {
				$i++;
			}
		}

		$lists['gid'] = mosHTML::selectList( $gtree, 'gid', 'size="10" dir="ltr"', 'value', 'text', $row->gid );
	}

	//build the html select list
	$lists['block'] = mosHTML::yesnoRadioList( 'block', 'class="inputbox" size="1"', $row->block );
	//build the html select list
	$lists['sendemail'] = mosHTML::yesnoRadioList( 'sendemail', 'class="inputbox" size="1"', $row->sendemail );

    //User's preferable language
    $plangs = explode(',', $mosConfig_pub_langs);
	$lists['preflang'] = '<select name="preflang" class="selectbox dir="ltr"">'._LEND;
	foreach ( $plangs as $plang ) {
	   $sel = ($plang == $row->preflang) ? ' selected' : '';
	   $lists['preflang'] .= '<option value="'.$plang.'"'.$sel.'>'.$plang.'</option>'._LEND;
    }
    $lists['preflang'] .= '</select>'._LEND;

	//avatar
    $javascript = "onchange=\"javascript:if (document.forms[0].avatar.options[selectedIndex].value!='') {document.imagelib.src='../images/avatars/' + document.forms[0].avatar.options[selectedIndex].value} else {document.imagelib.src='../images/avatars/noavatar.png'}\"";
	$lists['avatar'] = mosAdminMenus::Images( 'avatar', $row->avatar, $javascript, '/images/avatars' );

    $gens = array();
    $gens[] = mosHTML::makeOption( 'MALE',$adminLanguage->A_CMP_USS_MALE );
    $gens[] = mosHTML::makeOption( 'FEMALE',$adminLanguage->A_CMP_USS_FEMALE );
    $lists['gender'] = mosHTML::selectList( $gens, 'gender', 'class="inputbox"', 'value', 'text', $row->gender );

    if (trim($row->birthdate) != '') {
        $bparts = explode('-', $row->birthdate);
        $lists['byear'] = sprintf("%04d", intval($bparts[0]));
        $lists['bmonth'] = sprintf("%02d", intval($bparts[1]));
        $lists['bday'] = sprintf("%02d", intval($bparts[2]));
    } else {
        $lists['byear'] = '';
        $lists['bmonth'] = '';
        $lists['bday'] = '';
    }

    //call softdisk
    $database->setQuery("SELECT sdname, sdvalue FROM #__softdisk WHERE sdsection='USERPROFILE' AND sdname LIKE 'UPROF_%'");
    $srows = $database->loadRowList();

    $enprof = array();
    if ($srows) {
        foreach ($srows as $srow) {
            $sdname = $srow['sdname'];
            $enprof[$sdname]= intval($srow['sdvalue']);
        }
    }

	HTML_users::edituser( $row, $contact, $lists, $option, $uid, $enprof );
}


/*************/
/* SAVE USER */
/*************/
function saveUser( $option, $task ) {
	global $database, $my, $adminLanguage, $fmanager, $mainframe;

	//CSRF prevention
	$tokname = 'token'.$my->id;
	if (!isset($_POST[$tokname]) || !isset($_SESSION[$tokname]) || ($_POST[$tokname] != $_SESSION[$tokname])) {
		die('Detected CSRF attack! Someone is forging your requests.');
	}

    $efields = mosGetParam( $_POST, 'efield', null );
    $extrafields = '';

    //check if empty checkboxes exist
    $ckboxes = mosGetParam( $_POST, 'efieldhidden', null );
    if ($ckboxes) {
        foreach ($ckboxes as $ckbox) {
            //if ckbox is empty
            if (!array_key_exists($ckbox, $efields)) {
                $efields[$ckbox] = '';
            }
        }
    }
    
    if (count($efields) >0 ) {
    	foreach ($efields as $efld => $val ) {
        	if (is_array($efld)) { $efld = $efld[0]; } //checkbox

        	$extrafields .= $efld.'=';

        	if (is_array($val)) {
            	foreach ($val as $vl) {
                	$vl = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\{\}\[\]\\\|\/\"\']+/", "", $vl);
                	$extrafields .= $vl.'/';
            	}
        	} else {
            	$val = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\{\}\[\]\\\|\/\"\']+/", "", $val);
            	$extrafields .= $val;
        	}

        	//strip out any trailing forward slashes
        	$extrafields = preg_replace("/[\/]$/", "", $extrafields);        
        	$extrafields .= '|';
    	}
    	//strip out any trailing vertical slashes
    	$extrafields = preg_replace("/[\|]$/", "", $extrafields);     
    }

    $_POST['extrafields'] = $extrafields;

    //birth date
    $birtdate = '';
    $byear = intval(mosGetParam( $_POST, 'byear', 0));
    $bmonth = intval(mosGetParam( $_POST, 'bmonth', 0));
    $bday = intval(mosGetParam( $_POST, 'bday', 0));
    if ($byear && $bmonth && $bday) {
        if (($bmonth < 13) && ($bday < 32) && ($byear < date('Y')) && ($byear > 1900)) {
            $birthdate = sprintf("%04d", $byear).'-'.sprintf("%02d", $bmonth).'-'.sprintf("%02d", $bday);
        }
    }
    $_POST['birthdate'] = $birthdate;

	$row = new mosUser( $database );
	if (!$row->bind($_POST)) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>"._LEND;
		exit();
	}

    $row->website = preg_replace("/[\`\#\$\%\^\*\<\>\{\}\\\|\"\']+/", "", $row->website);
    if (!preg_match('/^(http\:\/\/)/', $row->website)) { $row->website = ''; }
    if (trim($row->signature != '')) {
        $row->signature = preg_replace("/[\`\#\$\%\^\*\<\>\{\}\\\|\"\']+/", "", $row->signature);
        $row->signature = mosHTML::cleanText($row->signature);
        $row->signature = eUTF::utf8_substr($row->signature, 0, 255);
    }
    $row->location = mosHTML::cleanText($row->location);
    $row->occupation = mosHTML::cleanText($row->occupation);
    $row->phone = preg_replace("/[^0-9-\s]/", '', $row->phone);
    $row->mobile = preg_replace("/[^0-9-\s]/", '', $row->mobile);
    if (intval($row->icq) < 1) { $row->icq = ''; }

	$isNew = ($row->id) ? 0 : 1;
	$pwd = '';
	$sendUnblockMail = 0;

	//MD5 hash convert passwords
	if ($isNew) {
		// new user stuff
		if ($row->password == '') {
			$pwd = mosMakePassword();
			$row->password = md5( $pwd );
		} else {
			$pwd = $row->password;
			$row->password = md5( $row->password );
		}
		$row->registerdate = date('Y-m-d H:i:s');
	} else {
		//existing user stuff
		if ($row->password == '') {
			$database->setQuery("SELECT password FROM #__users WHERE id='".$row->id."'", '#__', 1, 0);
			$row->password = $database->loadResult();
		} else {
			$row->password = md5( $row->password );
		}

		if ($mainframe->getCfg('useractivation') == '2') {
			$database->setQuery("SELECT block FROM #__users WHERE id='".$row->id."'", '#__', 1, 0);
			$oldblock = intval($database->loadResult());
			if (($oldblock == 1) && ($row->block == 0)) { $sendUnblockMail = 1; }
		}
	}

	if ($row->gid == 25) {
		$row->expires = '2060-01-01 00:00:00';
	} elseif (eUTF::utf8_trim($row->expires) == $adminLanguage->A_NEVER) {
		$row->expires = '2060-01-01 00:00:00';
	} else {
		$parts = preg_split("/[\s]+/",eUTF::utf8_trim($row->expires));
		$is_valid_date = false;
		if (isset($parts[0]) && (strlen($parts[0]) == 10)) {
			$parts2 = preg_split("/[\-]+/",$parts[0]);
			if ($parts2 && (count($parts2) == 3) && (intval($parts2[0]) > 1960) && (intval($parts2[0]) < 2060)) {
				$is_valid_date = checkdate(intval($parts2[1]), intval($parts2[2]), intval($parts2[0]));
				if ($is_valid_date) {
					$row->expires = intval($parts2[0]).'-'.sprintf("%02d", intval($parts2[1])).'-'.sprintf("%02d", intval($parts2[2])).' 00:00:00';
				}
			}
		}
		if (!$is_valid_date) { $row->expires = '2060-01-01 00:00:00'; }
		unset($parts, $is_valid_date);
	}
	if ($row->expires < date('Y-m-d H:i:s')) { $row->block = '1'; }

	//save usertype to usetype column
	$database->setQuery("SELECT name FROM #__core_acl_aro_groups WHERE group_id = '".$row->gid."'", '#__', 1, 0);
	$usertype = $database->loadResult();
	$row->usertype = $usertype;

	if (!$row->check()) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-2);</script>"._LEND;
		exit();
	}
	if (!$row->store()) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-2);</script>"._LEND;
		exit();
	}
	$row->checkin();

    $newavatar = 0;
    if ( isset($_FILES['upavatar']) && is_array($_FILES['upavatar'])) {
        $file = $_FILES['upavatar'];

        $avname = eUTF::utf8_strtolower($file['name']);
        $avname = preg_replace("/[\s]/", "_", $avname);
        $lowfilename = $row->id.'_'.$avname;
        $avatarsdir = $mainframe->getCfg('absolute_path').'/images/avatars';
        $ext = $fmanager->FileExt($lowfilename);
        $valid_exts = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($ext, $valid_exts)) {
            if (file_exists($mainframe->getCfg('absolute_path').'/images/avatars/'.$lowfilename)) {
                $lowfilename = $row->id.'_'.time().'.'.$ext;
            }
            if ($fmanager->upload( $file['tmp_name'], $avatarsdir.'/'.$lowfilename )) {
                $fmanager->spChmod( $avatarsdir.'/'.$lowfilename, '0666' );
                if (resize_image($avatarsdir.'/'.$lowfilename, '100', '100')) { 
                    $newavatar = 1;
                    $row->avatar = $lowfilename;
                }
            }
        }
    }

    if ($newavatar) {
        $database->setQuery("UPDATE #__users SET avatar='$lowfilename' WHERE id='$row->id' AND username='$row->username'");
        $database->query();
    }

	//update the ACL
	if ( !$isNew ) {
		$database->setQuery("SELECT aro_id FROM #__core_acl_aro WHERE value='$row->id'");
		$aro_id = $database->loadResult();

		$query = "UPDATE #__core_acl_groups_aro_map SET group_id = '$row->gid' WHERE aro_id = '$aro_id'";
		$database->setQuery( $query );
		$database->query() or die( $database->stderr() );
	}

	// for new users, email username and password
	if ($isNew) {
		$subject = _NEW_USER_MESSAGE_SUBJECT;
        $expdate = ($row->expires == '2060-01-01 00:00:00') ? $adminLanguage->A_NEVER : mosFormatDate($row->expires, _GEM_DATE_FORMLC);
		$message = sprintf(_NEW_USER_MESSAGE, $row->name, $mainframe->getCfg('sitename'), $mainframe->getCfg('live_site'), $row->username, $pwd );
		$message .= "\n\n".$adminLanguage->A_USERS_EXPDATE.': '.$expdate."\n\n\n";
		$message .= $mainframe->getCfg('fromname').",\n";
		$message .= $mainframe->getCfg('live_site');
		if ($mainframe->getCfg('mailfrom') != '' && $mainframe->getCfg('fromname') != '') {
			$adminName = $mainframe->getCfg('fromname');
			$adminEmail = $mainframe->getCfg('mailfrom');
		} else {
			$database->setQuery("SELECT name, email FROM #__users WHERE gid='25' AND block='0' AND sendemail='1'", '#__', 1, 0);
			$database->loadObject($arow);
			$adminName = $arow->name;
			$adminEmail = $arow->email;
		}
		mosMail($adminEmail, $adminName, $row->email, $subject, $message);
	} else if ($sendUnblockMail) {
		$prlang = new prefLang();
        $prlang->load($row->preflang);

        $expdate = ($row->expires == '2060-01-01 00:00:00') ? $adminLanguage->A_NEVER : mosFormatDate($row->expires, _GEM_DATE_FORMLC);
		$subject = sprintf($prlang->lng->_E_SEND_SUB, $row->name, $mainframe->getCfg('sitename'));
		$subject = html_entity_decode($subject, ENT_QUOTES);
		$message = sprintf($prlang->lng->_ACCUNBLOCK, $mainframe->getCfg('sitename'), $row->username)."\n\n";
		$message .= $prlang->lng->_E_ACCEXPDATE.': '.$expdate."\n\n\n";
		$message .= $mainframe->getCfg('fromname').",\n";
		$message .= $mainframe->getCfg('live_site');
		$message = html_entity_decode($message, ENT_QUOTES);
        mosMail($mainframe->getCfg('mailfrom'), $mainframe->getCfg('fromname'), $row->email, $subject, $message);
	}

	switch ( $task ) {
		case 'apply':
			$msg = $adminLanguage->A_CMP_USS_SUCCH.': '. $row->name;
			mosRedirect('index2.php?option=com_users&task=editA&hidemainmenu=1&id='.$row->id, $msg);
		break;
		case 'save':
		default:
			$msg = $adminLanguage->A_CMP_USS_SUCUSR.': '. $row->name;
			mosRedirect('index2.php?option=com_users', $msg);
		break;
	}
}


/******************/
/* GET GD VERSION */
/******************/
function getGDversion() {
    if (!extension_loaded('gd')) { return 0; }
    //use gd_info()
    if (function_exists('gd_info')) {
        $ver_info = @gd_info();
        preg_match('/\d/', $ver_info['GD Version'], $match);
        return $match[0];
    }
    //use phpinfo()
    @ob_start();
    @phpinfo(8);
    $info = @ob_get_contents();
    @ob_end_clean();
    $info = stristr($info, 'gd version');
    preg_match('/\d/', $info, $match);
    return $match[0];
}


/*******************************/
/* RESIZE A JPEG/PNG/GIF IMAGE */
/*******************************/
function resize_image($src_file, $width=100, $height=100) {
    global $fmanager;

	$width = (int)$width;
	$height = (int)$height;
	if ($width < 1) { $width = 100; }
	if ($height < 1) { $height = 100; }

    $dest_file = $src_file;
    $imginfo = @getimagesize($src_file);
    if (!$imginfo) { return false; }
	if (!in_array($imginfo[2], array(1, 2, 3))) { return false; }

 	if (($imginfo[2] == 2) && function_exists('imagecreatefromjpeg')) { //JPG
		$src_img = imagecreatefromjpeg($src_file);
		if (!$src_img){ return false;}
		$dst_img = imagecreatetruecolor($width, $height);
		imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $width, $height, $imginfo[0], $imginfo[1]);
		imagejpeg($dst_img, $dest_file, 80);
		@imagedestroy($src_img);
		@imagedestroy($dst_img);
	} else if (($imginfo[2] == 3) && function_exists('imagecreatefrompng')) { //PNG
		$src_img = imagecreatefrompng($src_file);
		$dst_img = imagecreatetruecolor($width, $height);
		imagealphablending($dst_img, true);
		imagesavealpha($dst_img, true);
		$trans_color = imagecolorallocatealpha($dst_img, 0, 0, 0, 127);
		@imagefill($dst_img, 0, 0, $trans_color);
		imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $width, $height, $imginfo[0], $imginfo[1]);
		imagepng($dst_img, $dest_file, 5);
		@imagedestroy($src_img);
		@imagedestroy($dst_img);
	} else if (($imginfo[2] == 1) && function_exists('imagecreatefromgif')) { //GIF
		$src_img = imagecreatefromgif($src_file);
		$dst_img = imagecreatetruecolor($width, $height);
		imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $width, $height, $imginfo[0], $imginfo[1]);
		imagegif($dst_img, $dest_file);
		@imagedestroy($src_img);
		@imagedestroy($dst_img);
	} else {
		return false;
	}

    $fmanager->spChmod($dest_file, '0666');
    $imginfo = @getimagesize($dest_file);
    if ($imginfo == null) { return false; } else { return true; }
}


/********************/
/* CANCEL EDIT USER */
/********************/
function cancelUser( $option ) {
	mosRedirect( 'index2.php?option='. $option .'&task=view' );
}


/******************/
/* DELETE USER(S) */
/******************/
function removeUsers( $cid, $option ) {
	global $database, $acl, $my, $adminLanguage, $mainframe;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_CMP_CNT_SELIDEL ."\"); window.history.go(-1);</script>\n";
		exit();
	}

	if ( count( $cid ) ) {
		$obj = new mosUser( $database );
		foreach ($cid as $id) {
			//check for a super admin ... can't delete them
			$groups 	= $acl->get_object_groups( 'users', $id, 'ARO' );
			//$this_group = strtolower( $acl->get_group_name( $groups[0], 'ARO' ) ); //gets the group name	
			$this_group = $groups[0]; //gets the group id
			if ($this_group == '25') {
				$msg = $adminLanguage->A_CMP_USS_CANNOT;
 			} else if ( $id == $my->id ){
 				$msg = $adminLanguage->A_CMP_USS_CANNYO;
 			//} else if ( ( $this_group == 'administrator' ) && ( $my->gid == 24 ) ){ 				
 			} else if ( !$acl->allow_edit( $my->gid, $this_group, 'DELETEUSER' )) {
 				$msg = $adminLanguage->A_CMP_USS_CANNUS;
			} else {
				$obj->delete($id);
				$msg = $obj->getError();
			}
		}
	}

	mosRedirect( 'index2.php?option='. $option, $msg );
}


/***********************/
/* BLOCK/UNBLOCK USERS */
/***********************/
function changeUserBlock($cid=null, $block=1) {
	global $database, $my, $adminLanguage, $mainframe;

	if (count($cid) < 1) {
		$action = $block ? 'block' : 'unblock';
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_SELITEMTO ." ". $action ."\"); window.history.go(-1);</script>\n";
		exit();
	}

	$cids = implode(',', $cid);

	$query = "UPDATE #__users SET block='$block' WHERE id IN (".$cids.")";
	$database->setQuery( $query );
	if (!$database->query()) {
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}

	if (($mainframe->getCfg('useractivation') == '2') && ($block == 0)) {
    	$database->setQuery("SELECT name, username, email, preflang FROM #__users WHERE id IN (".$cids.") AND gid='18'");
    	$newusers = $database->loadRowList();

		if ($newusers) {
			$prlang = new prefLang();
        	foreach ($newusers as $nu) {
        		$prlang->load($nu['preflang']);
				$subject = sprintf($prlang->lng->_E_SEND_SUB, $nu['name'], $mainframe->getCfg('sitename'));
				$subject = html_entity_decode($subject, ENT_QUOTES);
				$message = sprintf($prlang->lng->_ACCUNBLOCK, $mainframe->getCfg('sitename'), $nu['username'])."\n\n";
				$message .= $mainframe->getCfg('fromname').",\n";
				$message .= $mainframe->getCfg('live_site');
				$message = html_entity_decode($message, ENT_QUOTES);
            	mosMail($mainframe->getCfg('mailfrom'), $mainframe->getCfg('fromname'), $nu['email'], $subject, $message);
        	}
    	}
	}
	mosRedirect('index2.php?option=com_users');
}


/**********************/
/* FORCE LOGOUT USERS */
/**********************/
function logoutUser( $cid=null, $option, $task ) {
	global $database, $my, $adminLanguage;

	$cids = $cid;
	if (is_array($cid)) {
		if (count($cid) < 1) {
			mosRedirect( 'index2.php?option='. $option, $adminLanguage->A_CMP_USS_SLUSER );
		}
		$cids = implode(',', $cid);
	}

	$database->setQuery("DELETE FROM #__session WHERE userid IN (".$cids.")");
	$database->query();

	switch ( $task ) {
		case 'flogout':
			mosRedirect( 'index2.php', $database->getErrorMsg() );
		break;
		default:
			mosRedirect( 'index2.php?option='. $option, $database->getErrorMsg() );
		break;
	}
}


function is_email($email){
	$rBool=false;
	if(preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $email)){ $rBool=true; }
	return $rBool;
}


/********************************/
/* PREPARE TO SHOW EXTRA FIELDS */
/********************************/
function showExtra( $option ) {
	global $database, $mainframe, $mosConfig_list_limit;

    $limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
    $limitstart = $mainframe->getUserStateFromRequest( "viewban{$option}limitstart", 'limitstart', 0 );

    //get the total number of records
    $database->setQuery( "SELECT COUNT(*) FROM #__users_extra" );
    $total = $database->loadResult();

    require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
    $pageNav = new mosPageNav( $total, $limitstart, $limit );

    $query = "SELECT * FROM #__users_extra ORDER BY ordering, name";
    $database->setQuery( $query, '#__', $pageNav->limit, $pageNav->limitstart );

    if(!$result = $database->query()) {
        echo $database->stderr();
        return;
    }
    $rows = $database->loadObjectList();

    HTML_users::showExtra( $rows, $pageNav, $option );
}


    //edit extra field
    function editExtra( $eid='0', $option='users' ) {
        global $database, $my, $adminLanguage;

	   $row = new mosUsersExtra( $database );
        // load the row from the db table
        $row->load( $eid );

        if (!$eid) {
            // do stuff for new records
            $row->etype = 'text';
            $row->maxlength = '50';
            $row->ordering = 0;
            $row->required = 0;
            $row->published = 1;
            $row->registration = 1;
            $row->profile = 1;
            $row->readonly = 0;
            $row->halign = 1;
        }

        //will be used for switching layers
        $row->eftype = $row->etype;

        // build the html select list for ordering
        $query = "SELECT a.ordering AS value, a.name AS text FROM #__users_extra a ORDER BY a.ordering";
        $lists['ordering'] = mosAdminMenus::SpecificOrdering( $row, $eid, $query, 1 );

        // make the select list for the extra field type
        $typos[] = mosHTML::makeOption( 'text', 'text' );
        $typos[] = mosHTML::makeOption( 'select', 'select' );
        $typos[] = mosHTML::makeOption( 'radio', 'radio' );
        $typos[] = mosHTML::makeOption( 'checkbox', 'checkbox' );
        $typos[] = mosHTML::makeOption( 'hidden', 'hidden' );

        $javascript = 'onchange="switchoptions();"';
        $lists['etype'] = mosHTML::selectList( $typos, 'etype', 'class="selectbox" size="1" dir="ltr" '.$javascript.'' , 'value', 'text', $row->etype );        
        
        // build the html select list
        $lists['required'] = mosHTML::yesnoRadioList( 'required', 'class="inputbox"', $row->required );
        // build the html select list
        $lists['published'] = mosHTML::yesnoRadioList( 'published', 'class="inputbox"', $row->published );
        // build the html select list
        $lists['registration'] = mosHTML::yesnoRadioList( 'registration', 'class="inputbox"', $row->registration );
        // build the html select list
        $lists['profile'] = mosHTML::yesnoRadioList( 'profile', 'class="inputbox"', $row->profile );
        // build the html select list
        $lists['readonly'] = mosHTML::yesnoRadioList( 'readonly', 'class="inputbox"', $row->readonly );
        // make the select list for the extra field options alignment (radio/checkbox)
        $horalign[] = mosHTML::makeOption( '0', $adminLanguage->A_CMP_USS_VERTICAL );
        $horalign[] = mosHTML::makeOption( '1', $adminLanguage->A_CMP_USS_HORIZONT );
        $lists['halign'] = mosHTML::selectList( $horalign, 'halign', 'class="inputbox" size="1"' , 'value', 'text', $row->halign );        
  
        //get extra fields options
        $eoptions = explode('|', $row->eoptions);
        //get extra fields defvalues
        $dvalues = explode('|', $row->defvalue);
        
        $lists['soptions'] = '';
        $lists['roptions'] = '';
        $lists['coptions'] = '';
        for ($i=0; $i<20; $i++) {
            //if ($row->etype != 'text') {
            if (($row->etype != 'text') && ($row->etype != 'hidden')) {
                if ($eoptions[$i]) {
                    $val = $eoptions[$i];
                    if (in_array($eoptions[$i], $dvalues)) { 
                        $chk = 'checked'; 
                    } else {
                        $chk = '';
                    }
                } else {
                    $val = '';
                    $chk = '';
                }
            } else {
                if ($i == '0') {
                    $val = $dvalues[0];
                    $chk = 'checked';
                } else {
                    $val = '';
                    $chk = '';
                }
            }
            $lists['soptions'] .= '<input type="text" name="soption[]" value="'.$val.'" /> '.$adminLanguage->A_SELECTED.': 
            <input type="radio" name="sdefault" value="'.$i.'" '.$chk.' /><br />';
            $lists['roptions'] .= '<input type="text" name="roption[]" value="'.$val.'" /> '.$adminLanguage->A_SELECTED.': 
            <input type="radio" name="rdefault" value="'.$i.'" '.$chk.' /><br />';
            $lists['coptions'] .= '<input type="text" name="coption[]" value="'.$val.'" /> '.$adminLanguage->A_CMP_USS_CHECKED.': 
            <input type="checkbox" name="cdefault[]" value="'.$i.'" '.$chk.' /><br />';
        }
        $row->defvalue = $dvalues[0];

        //build preview
        if ($row->readonly == 1) { $ronly = " readonly"; } else { $ronly = ""; }
        if ($row->halign == 1) { $hal = ""; } else { $hal = "<br>"; }
        
        $lists['preview'] = $row->name;
        $lists['preview'] .= ($row->required) ? '*: ' : ': ';
        switch ($row->etype) {
            case 'select':
                $lists['preview'] .= "<select name=\"preview\"".$ronly.">"._LEND;
                for ($i=0; $i<20; $i++) {
                    if ($eoptions[$i]) {
                        if (in_array($eoptions[$i], $dvalues)) { $chk = ' selected'; } else { $chk = ''; }
                        $lists['preview'] .= "<option value=\"".$eoptions[$i]."\"".$chk.">".$eoptions[$i]."</option>"._LEND;
                    }
                }
                $lists['preview'] .= "</select>"._LEND;
            break;
            case 'radio':
                $lists['preview'] .= $hal;
                for ($i=0; $i<20; $i++) {
                    if ($eoptions[$i]) {
                        if (in_array($eoptions[$i], $dvalues)) { $chk = ' checked'; } else { $chk = ''; }
                        $lists['preview'] .= "<input type=\"radio\" name=\"preview\" value=\"".$eoptions[$i]."\"".$chk."".$ronly." />".$eoptions[$i]." ".$hal._LEND;
                    }
                }
            break;
            case 'checkbox':
                $lists['preview'] .= $hal;
                for ($i=0; $i<20; $i++) {
                    if ($eoptions[$i]) {
                        if (in_array($eoptions[$i], $dvalues)) { $chk = ' checked'; } else { $chk = ''; }
                        $lists['preview'] .= "<input type=\"checkbox\" name=\"preview\" value=\"".$eoptions[$i]."\"".$chk."".$ronly." />".$eoptions[$i]." ".$hal._LEND;
                    }
                }
            break;
            case 'hidden':
            default:
                $lists['preview'] .= "<input type=\"text\" name=\"preview\" value=\"".$row->defvalue."\" maxlength=\"".$row->maxlength."\"".$ronly." /> <i>".$adminLanguage->A_CMP_USS_HIDDEN."</i>"._LEND;
            break; 
            case 'text':
            default:
                $lists['preview'] .= "<input type=\"text\" name=\"preview\" value=\"".$row->defvalue."\" maxlength=\"".$row->maxlength."\"".$ronly." />"._LEND;
            break;        
        
        }
        HTML_users::editExtra( $row, $lists, $option );
	}


    //saves or apply changes in extra fields
    function saveExtra( $option, $task ) {
	global $database, $adminLanguage;

    $row = new mosUsersExtra( $database );
    
    $eopts = '';
    $dvalue = '';

    //case select
    if ($_POST['etype'] == 'select') {
        foreach ( $_POST['soption'] as $sopt ) {
            if (trim($sopt) <> '') {
                //remove invalid characters
                $sopt = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\{\}\[\]\\\|\/\"\']+/", "", $sopt);
                $eopts .= $sopt.'|';
            }
        }
        //strip out any trailing vertical slashes
        $eopts = preg_replace("/[\|]$/", "", $eopts);

        $dx = $_POST['sdefault'];
        $dvalue = $_POST['soption'][$dx];
        $dvalue = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\{\}\[\]\\\|\/\"\']+/", "", $dvalue);
        
        if ((trim($eopts) == '') || (trim($dvalue) == '')) {
            echo "<script type=\"text/javascript\">alert(\"".$adminLanguage->A_CMP_USS_1OPTVLEAST."\"); window.history.go(-1);</script>\n";
            exit();
        }
    }
    //case radio
    else if ($_POST['etype'] == 'radio') {
        foreach ( $_POST['roption'] as $ropt ) {
            if (trim($ropt) <> '') {
                //remove invalid characters
                $ropt = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\{\}\[\]\\\|\/\"\']+/", "", $ropt);
                $eopts .= $ropt.'|';
            }
        }
        //strip out any trailing vertical slashes
        $eopts = preg_replace("/[\|]$/", "", $eopts);

        $dx = $_POST['rdefault'];
        $dvalue = $_POST['roption'][$dx];
        $dvalue = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\{\}\[\]\\\|\/\"\']+/", "", $dvalue);
        
        if ((trim($eopts) == '') || (trim($dvalue) == '')) {
            echo "<script type=\"text/javascript\">alert(\"".$adminLanguage->A_CMP_USS_1OPTVLEAST."\"); window.history.go(-1);</script>\n";
            exit();
        }
    }
    //case checkbox
    else if ($_POST['etype'] == 'checkbox') {
        foreach ( $_POST['coption'] as $copt ) {
            if (trim($copt) <> '') {
                //remove invalid characters
                $copt = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\{\}\[\]\\\|\/\"\']+/", "", $copt);
                $eopts .= $copt.'|';
            }
        }
        //strip out any trailing vertical slashes
        $eopts = preg_replace("/[\|]$/", "", $eopts);

        //cdefault is an array
        $cdefs = $_POST['cdefault'];
        
        if (count($cdefs) > 0) {
            foreach ($cdefs as $cdef) {
                $ddd = $_POST['coption'][$cdef];
                $ddd = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\{\}\[\]\\\|\/\"\']+/", "", $ddd);
                $dvalue .= $ddd.'|';
            }
            //strip out any trailing vertical slashes
            $dvalue = preg_replace("/[\|]$/", "", $dvalue);
        }
        if (trim($eopts) == '') {
            echo "<script type=\"text/javascript\">alert(\"".$adminLanguage->A_CMP_USS_1OPTLEAST."\"); window.history.go(-1);</script>\n";
            exit();
        }

    }
    //case hidden
    else if ($_POST['etype'] == 'hidden') {
        $dvalue = $_POST['hidvalue'];
        $dvalue = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\{\}\[\]\\\|\/\"\']+/", "", $dvalue);
    }
    //case text
    else {
        $dvalue = $_POST['defvalue'];
        $dvalue = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\{\}\[\]\\\|\/\"\']+/", "", $dvalue);
    }

    $_POST['eoptions'] = $eopts;
    $_POST['defvalue'] = $dvalue;
	
	if (!$row->bind( $_POST )) {
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}
	if (!$row->check()) {
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-2);</script>\n";
		exit();
	}
	if (!$row->store()) {
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-2);</script>\n";
		exit();
	}
	$row->checkin();
	$row->updateOrder();

	switch ( $task ) {
		case 'applyExtra':
		$msg = $adminLanguage->A_CMP_USS_EXTRASAVED.': '. $row->name;
		mosRedirect( 'index2.php?option=com_users&task=editExtraA&hidemainmenu=1&id='. $row->extraid, $msg );
        break;
		case 'saveExtra':
		default:
		$msg = $adminLanguage->A_CMP_USS_EXTRASAVED.': '. $row->name;
		mosRedirect( 'index2.php?option=com_users&task=extra', $msg );
		break;
	}
}


/*************************/
/* REMOVE EXTRA FIELD(S) */
/*************************/
function removeExtra( &$cid, $option ) {
	global $database, $adminLanguage, $mainframe;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_ALERT_SELECT_DELETE ."\"); window.history.go(-1);</script>\n";
		exit();
	}
	if (count( $cid )) {
		$cids = implode( ',', $cid );
		$database->setQuery("DELETE FROM #__users_extra WHERE extraid IN (".$cids.")");
		if (!$database->query()) {
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
			exit();
		}
	}
	mosRedirect( 'index2.php?option='. $option .'&task=extra' );
}


/***************************/
/* (UN)PUBLISH EXTRA FIELD */
/***************************/
function publishExtra( $cid, $publish=1 ) {
	global $database, $my, $adminLanguage, $mainframe;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		$action = $publish ? $adminLanguage->A_PUBLISH : $adminLanguage->A_UNPUBLISH;
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_SELITEMTO." ".$action."'); window.history.go(-1);</script>\n";
		exit();
	}

	$cids = implode( ',', $cid );

	$database->setQuery( "UPDATE #__users_extra SET published='".$publish."' WHERE extraid IN (".$cids.")" );
	if (!$database->query()) {
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosUsersExtra( $database );
		$row->checkin($cid[0]);
	}
	mosRedirect( 'index2.php?option=com_users&task=extra' );
}


/************************/
/* RE-ORDER EXTRA FIELD */
/************************/
function orderExtra( $id, $inc, $option ) {
	global $database;

	$limit = mosGetParam( $_REQUEST, 'limit', 0 );
	$limitstart = mosGetParam( $_REQUEST, 'limitstart', 0 );
    
	$row = new mosUsersExtra( $database );
	$row->load( $id );
	$row->move( $inc );

	mosRedirect( 'index2.php?option='.$option.'&task=extra' );
}

?>