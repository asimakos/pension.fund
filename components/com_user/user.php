<?php 
/**
* @version: $Id: user.php 2562 2009-10-09 20:48:48Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component User
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if ( $my->usertype == '' ) {
	$usertype = eUTF::utf8_strtolower($acl->get_group_name('29'));
} else {
	$usertype = eUTF::utf8_strtolower($my->usertype);
}

if (($mosConfig_access == '1') | ($mosConfig_access == '3')) {
	if (!($acl->acl_check( 'action', 'view', 'users', $usertype, 'components', 'all' ) || 
	    $acl->acl_check( 'action', 'view', 'users', $usertype, 'components', 'com_user' ))) {
		mosRedirect( 'index.php', _NOT_AUTH );
	}
}

$access = new stdClass();

if (!$my->id) { //admin can set visitors to see users profiles!
	$access->canEdit = 0;
	$access->canEditOwn = 0;
	$access->uploadAvatar = 0;
	$access->canViewProfOwn = 0;
	$access->canViewProf = $acl->acl_check( 'action', 'view', 'users', $usertype, 'profile', 'all' );
} else {
	$access->canEdit = $acl->acl_check( 'action', 'edit', 'users', $usertype, 'profile', 'all' );
	$access->canEditOwn = $acl->acl_check( 'action', 'edit', 'users', $usertype, 'profile', 'own' );
	$access->canViewProf = $acl->acl_check( 'action', 'view', 'users', $usertype, 'profile', 'all' );
	$access->uploadAvatar = 0;
	if ($acl->acl_check( 'action', 'upload', 'users', $usertype, 'files', 'all' )) {
    	$access->uploadAvatar = 1;
	} elseif ($acl->acl_check( 'action', 'upload', 'users', $usertype, 'files', 'images' )) {
    	$access->uploadAvatar = 1;
	} elseif ($acl->acl_check( 'action', 'upload', 'users', $usertype, 'files', 'avatars' )) {
    	$access->uploadAvatar = 1;
	}

	if ($access->canViewProf == 1) {
		$access->canViewProfOwn = 1;
	} else {
		$access->canViewProfOwn = $acl->acl_check( 'action', 'view', 'users', $usertype, 'profile', 'own' );
	}
}

require_once ( $mainframe->getPath( 'front_html' ) );
$task = mosGetParam( $_REQUEST, 'task' );

switch( $task ) {
	case 'UserDetails':
	userEdit( $option, $my->id, _E_UPDATE );
	break;
	case 'saveUserEdit':
	userSave( $option, $my->id );
	break;
	case 'CheckIn':
	CheckIn( $my->id, $access, $option );
	break;
	case 'profile':
	profile( intval( mosGetParam( $_REQUEST, 'uid', 0 )), $option );
	break;
	case 'list':
	listUsers( $option );
	break;
	default:
	usersFrontpage($access);
	break;
}


/***************************/
/* PREPARE USERS FRONTPAGE */
/***************************/
function usersFrontpage($access) {
    global $mainframe, $database, $lang, $my;

	$mainframe->setPageTitle(_E_USERSAREA);
    /* Check if visitors can see members list */
	if (!$my->id && !$access->canViewProf) {
		echo '<h1>'._E_USERSAREA.'</h1>'._LEND;
		mosNotAuth();
		return;
	}

    $query = "SELECT id FROM #__menu"
    ."\n WHERE link='index.php?option=com_user&task=UserDetails'"
    ."\n AND published='1'"
	."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))"
    ."\n AND access IN (".$my->allowed.")";
    $database->setQuery($query, '#__', 1, 0);
    $Itemid_ud = intval($database->loadResult());

    $query2 = "SELECT id FROM #__menu"
    ."\n WHERE link='index.php?option=com_user&task=list'"
    ."\n AND published='1'"
	."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))"
    ."\n AND access IN (".$my->allowed.")";
    $database->setQuery($query2, '#__', 1, 0);
    $Itemid_ul = intval($database->loadResult());

    $keys = preg_split('/[\s]/',_E_USERSAREA);
    if ($lang != 'english') { $keys[] = 'users list'; $keys[] = 'area'; $keys[] = 'members list'; }

    $mainframe->setMetaTag( 'description', _E_USERSAREA.' '.$GLOBALS['mosConfig_sitename'] );
    $mainframe->setMetaTag( 'keywords', implode(', ', $keys) );

    HTML_user::frontpage($access, $Itemid_ud, $Itemid_ul);
}


/************************/
/* PREPARE TO EDIT USER */
/************************/
function userEdit( $option, $uid, $submitvalue) {
	global $database, $access, $mosConfig_pub_langs, $mainframe;

    if (($uid == 0) || (!$access->canEdit && !$access->canEditOwn)) {
		mosNotAuth();
		return;
    }

	$row = new mosUser( $database );
	$row->load( $uid );
	$row->orig_password = $row->password;

	//EXTRA FIELDS
	$lists['extra'] = '';
	$lists['reqs'] = array(); //list of required fields elements

	if ( $access->canViewProfOwn ) {
	    $usrfields = explode("|", $row->extrafields);
		//$ufields is an array having as key the extraid and value the extra field value for the selected user
		$ufields = array();
		if ($usrfields && count($usrfields > 0)) {
			foreach ($usrfields as $usrfield) {
				$uf = preg_split("/[\=]/", $usrfield, 2);
				$ufid = intval($uf[0]); //if invalid then extraid=0
				$ufval = preg_split('/[\/]+/', $uf[1], -1, PREG_SPLIT_NO_EMPTY);
	        	if ( count($ufval) < 1 ) { $ufval = array(''); }
				if (($ufid != 0) && ($ufid != '')) {
					$ufields[$ufid] = $ufval;
				}
			}
		}

        $query = "SELECT * FROM #__users_extra WHERE published='1' AND profile='1' ORDER BY ordering ASC";
        $database->setQuery( $query );
        $fields = $database->loadObjectList();

        if (count($fields) > 0 ) {
        	$float = (_GEM_RTL) ? 'right' : 'left';
            $attrs = 'style="width:150px; float:'.$float.';"';
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
        }
	}

    //User's preferable language
    $plangs = explode(',', $mosConfig_pub_langs);
	$lists['preflang'] = '<select name="preflang" dir="ltr" class="selectbox" onfocus="focusBox(\'preflang\');" onblur="blurBox(\'preflang\');">'._LEND;
	foreach ( $plangs as $plang ) {
	   $sel = ($plang == $row->preflang) ? ' selected' : '';
	   $lists['preflang'] .= '<option value="'.$plang.'"'.$sel.'>'.$plang.'</option>'._LEND;
    }
    $lists['preflang'] .= '</select>'._LEND;

	//avatar
	if (trim($row->avatar) == '') { $row->avatar = 'noavatar.png'; }
    $javascript = "onfocus=\"focusBox('avatar');\" onblur=\"blurBox('avatar');\" onchange=\"javascript:if (document.mosUserForm.avatar.options[selectedIndex].value!='') {document.imagelib.src='images/avatars/' + document.mosUserForm.avatar.options[selectedIndex].value} else {document.imagelib.src='images/avatars/noavatar.png'}\"";
	$lists['avatar'] = userAvatars( 'avatar', $row->avatar, $javascript );

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

    $mainframe->setPageTitle(_E_EDIT_PROFILE);
    $mainframe->setMetaTag( 'description', _E_EDIT_YDETAILS.' '.$GLOBALS['mosConfig_sitename'] );
    $mainframe->setMetaTag( 'keywords', _E_USER_PROFILE.', '._E_EDIT_PROFILE );
	HTML_user::userEdit( $row, $option, $submitvalue, $lists, $access, $enprof );
}


/**********************/
/* GET USER'S AVATARS */
/**********************/
function userAvatars( $name, &$active, $javascript=NULL ) {
	global $mosConfig_absolute_path, $fmanager, $my;

	if ( !$javascript ) {
		$javascript = "onchange=\"javascript:if (document.mosUserForm.avatar.options[selectedIndex].value!='') {document.imagelib.src='images/avatars/' + document.mosUserForm.avatar.options[selectedIndex].value} else {document.imagelib.src='images/avatars/noavatar.png'}\"";
	}
	$imageFiles = $fmanager->listFiles( $mosConfig_absolute_path.'/images/avatars' );
	$avatars = array(mosHTML::makeOption('', _E_SELIMAGE));
	foreach ( $imageFiles as $file ) {
		if (preg_match('/\.(gif|jpg|png|jpeg)$/i', $file)) {
			if (preg_match('/^'.$my->id.'\_/', $file)) {
				$avatars[] = mosHTML::makeOption( $file );
			}
		}
	}
	$avatars[] = mosHTML::makeOption( 'noavatar.png' );
	$avatars = mosHTML::selectList( $avatars, $name, 'class="selectbox" dir="ltr" size="1" '.$javascript, 'value', 'text', $active );
	return $avatars;
}


/*************************/
/* PREPARE TO LIST USERS */
/*************************/
function listUsers( $option) {
	global $database, $mainframe, $my, $access, $Itemid, $lang;

    $mainframe->setPageTitle(_E_MEMBERS_LIST);

    //can view users list?
	if ( !$access->canViewProf ) {
	   mosNotAuth();
	   return;
	}

	$database->setQuery("SELECT COUNT(id) FROM #__users WHERE block='0' AND expires > '".date('Y-m-d H:i:s')."'");
	$total = intval($database->loadResult());

    //call softdisk
    $database->setQuery("SELECT sdname, sdvalue FROM #__softdisk WHERE sdsection='USERSLIST' AND sdname LIKE 'ULIST_%'");
    $srows = $database->loadRowList();

    $softlist = array();
    if ($srows) {
        foreach ($srows as $srow) {
            $sdname = $srow['sdname'];
            $softlist[$sdname]= intval($srow['sdvalue']);
        }
    }

    $page = intval(mosGetParam($_REQUEST, 'page', 0));
    if ($page < 1) { $page = 0; }
    
    if ($total == 0) {
		$maxpage = 0;
	} else {
		$maxpage = ceil($total/$mainframe->getCfg('list_limit')) - 1;
	}
    if ($page > $maxpage) { $page = $maxpage; }
    $limit = intval($mainframe->getCfg('list_limit'));
    $limitstart = ($page * $limit);

	$order = trim(mosGetParam($_REQUEST, 'order', ''));
	switch($order) {
		case 'na': $orderby = 'u.name ASC'; break;
		case 'nd': $orderby = 'u.name DESC'; break;
		case 'ea': $orderby = 'u.email ASC'; break;
		case 'ed': $orderby = 'u.email DESC'; break;
		case 'uta': $orderby = 'u.usertype ASC'; break;
		case 'utd': $orderby = 'u.usertype DESC'; break;
		case 'ra': $orderby = 'u.registerdate ASC'; break;
		case 'rd': $orderby = 'u.registerdate DESC'; break;
		case 'pla': $orderby = 'u.preflang ASC'; break;
		case 'pld': $orderby = 'u.preflang DESC'; break;
		//case 'ava': $orderby = 'u.avatar ASC'; break;
		//case 'avd': $orderby = 'u.avatar DESC'; break;
		case 'wa': $orderby = 'u.website ASC'; break;
		case 'wd': $orderby = 'u.website DESC'; break;
		case 'aa': $orderby = 'u.aim ASC'; break;
		case 'ad': $orderby = 'u.aim DESC'; break;
		case 'ya': $orderby = 'u.yim ASC'; break;
		case 'yd': $orderby = 'u.yim DESC'; break;
		case 'ma': $orderby = 'u.msn ASC'; break;
		case 'md': $orderby = 'u.msn DESC'; break;
		case 'ia': $orderby = 'u.icq ASC'; break;
		case 'id': $orderby = 'u.icq DESC'; break;
		case 'pha': $orderby = 'u.phone ASC'; break;
		case 'phd': $orderby = 'u.phone DESC'; break;
		case 'moa': $orderby = 'u.mobile ASC'; break;
		case 'mod': $orderby = 'u.mobile DESC'; break;
		case 'ba': $orderby = 'u.birthdate ASC'; break;
		case 'bd': $orderby = 'u.birthdate DESC'; break;
		case 'ga': $orderby = 'u.gender ASC'; break;
		case 'gd': $orderby = 'u.gender DESC'; break;
		case 'la': $orderby = 'u.location ASC'; break;
		case 'ld': $orderby = 'u.location DESC'; break;
		case 'oa': $orderby = 'u.occupation ASC'; break;
		case 'od': $orderby = 'u.occupation DESC'; break;
		case 'ona': $orderby = 's.time ASC'; break;
		case 'ond': $orderby = 's.time DESC'; break;
		case 'ud': $orderby = 'u.username DESC'; break;
		case 'ua': default: $order = 'ua'; $orderby = 'u.username ASC'; break;
	}

	$pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;
	$ora = (in_array($database->_resource->databaseType, array ('oci8', 'oci805', 'oci8po', 'oracle'))) ? 1 : 0;
	if ($pg || $ora) {
		if ($order == 'ona') { $orderby = 'u.lastvisitdate DESC'; }
		if ($order == 'ond') { $orderby = 'u.lastvisitdate ASC'; }
    	$query = "SELECT u.* FROM #__users u"
		."\n WHERE u.block='0' AND u.expires > '".date('Y-m-d H:i:s')."'"
		."\n ORDER BY ".$orderby;
	} else {
    	$query = "SELECT u.*, s.time, s.ip FROM #__users u"
		."\n LEFT JOIN #__session s ON s.userid = u.id"
		."\n WHERE u.block='0' AND u.expires > '".date('Y-m-d H:i:s')."'"
		."\n GROUP BY u.id"
		."\n ORDER BY ".$orderby;
	}
	$database->setQuery( $query, '#__', $limit, $limitstart );
	$rows = $database->loadObjectList();

	/*
	Ioannis Sannos (datahell): I could not find a better WORKING solution for 
	Postgres and Oracle to remove dublicates (users logged-in both frontend and backend) 
	*/
	if ($pg || $ora) {
		$database->setQuery("SELECT DISTINCT userid, time, ip FROM #__session WHERE userid <> '0'");
		$lrows = $database->loadRowList('userid');
		foreach ($rows as $row) {
			$k = $row->id;
			if (isset($lrows[$k])) {
				$row->time = $lrows[$k]['time'];
				$row->ip = $lrows[$k]['ip'];
				unset($lrows[$k]);
			} else {
				$row->time = '';
				$row->ip = '';
			}
		}
	}

    $keys = preg_split('/[\s]/', _E_MEMBERS_LIST);
    if ($lang != 'english') { $keys[] = 'members'; $keys[] = 'list'; }

    if ($rows) {
        for ($i=0; $i<count($rows); $i++) {
            if ($i > 10) { break; }
            $keys[] = $rows[$i]->username;
            $keys[] = $rows[$i]->name;
        }
    }

    $mainframe->setMetaTag('description', _E_MEMBERS_LIST.' '.$mainframe->getCfg('sitename'));
    $mainframe->setMetaTag('keywords', implode(', ', $keys) );

	HTML_user::list_Users( $rows, $total, $softlist, $access, $order, $page, $maxpage );
}


/***************************/
/* PREPARE TO VIEW PROFILE */
/***************************/
function profile( $uid, $option ) {
	global $database, $access, $my, $mainframe, $lang, $Itemid;

    if ($uid != $my->id) {
        if (!$access->canViewProf) {
            mosNotAuth();
            return;        
        }
    } else {
        if (!$access->canViewProfOwn) {
            mosNotAuth();
            return;
        }
    }

	$row = new mosUser( $database );
	$row->load( $uid );

	if (trim($row->username) == '') {
        elxError(_E_PROF_NOTEXIST);
		return;
	}
	
	//EXTRA USER FIELDS
    $lists['extra'] = '';	
	$usrfields = explode("|", $row->extrafields);
    if ($usrfields && (count($usrfields) > 0)) {
		//$ufields is an array having as key the extraid and value the extra field value for the selected user
		$ufields = array();
		foreach ($usrfields as $usrfield) {
			$uf = preg_split("/[\=]/", $usrfield, 2);
			$ufid = intval($uf[0]); //if invalid then extraid=0
        	$ufval = preg_split('/[\/]+/', $uf[1], -1, PREG_SPLIT_NO_EMPTY);
        	if ( count($ufval) < 1 ) { $ufval = array(''); }

			if (($ufid != 0) && ($ufid != '')) { $ufields[$ufid] = $ufval; }
		}

    	$query = "SELECT extraid, name FROM #__users_extra WHERE published='1'"
    	."\n AND profile='1' AND etype<>'hidden' ORDER BY ordering ASC";
		$database->setQuery( $query );
		$exxs = $database->loadObjectList();

    	for ($i = 0; $i<count($exxs); $i++) {
    		$exx = &$exxs[$i];
			$eid = $exx->extraid;
    		if ( isset($ufields[$eid]) && eUTF::utf8_trim($ufields[$eid][0]) != '' ) {
    			$lists['extra'] .= '<tr><td><strong>'.$exx->name.':</strong></td><td>'.implode(', ', $ufields[$eid]).'</td></tr>'._LEND;
    		}
		}
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

    $lists['numarticles'] = 0;
    if ($enprof['UPROF_ARTICLES']) {
        $database->setQuery("SELECT COUNT(*) FROM #__content WHERE created_by='$uid'");
        $lists['numarticles'] = intval($database->loadResult());
    }

    $keys = preg_split('/[\s]/', _E_USER_PROFILE);
    if ($lang != 'english') { $keys[] = 'user'; $keys[] = 'profile'; }
    $keys[] = $row->username;

	$query = "SELECT blogid, title, seotitle FROM #__eblog_settings WHERE ownerid = '".$row->id."'";
	$database->setQuery($query, '#__', 1, 0);
	$database->loadObject($blog);
	if ($blog) {
		$_Itemid = $Itemid;
		if ($mainframe->getCfg('sef') != 2) {
        	$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_blog&task=browse&blogid=".$blog->blogid."'"
            ."\n AND published='1' AND access IN (".$my->allowed.")"
			."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
            $database->setQuery($query, '#__', 1, 0);
            if (!$_Itemid = intval($database->loadResult())) {
				$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_eblog'"
                ."\n AND published='1' AND access IN (".$my->allowed.")"
				."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
            	$database->setQuery($query, '#__', 1, 0);
            	$_Itemid = intval($database->loadResult());
            }
            if (!$_Itemid) { $_Itemid = $Itemid; }
		}
		$blog->link = sefRelToAbs('index.php?option=com_eblog&task=browse&blogid='.$blog->blogid.'&Itemid='.$_Itemid, 'eblog/'.$blog->seotitle.'/');
	}

    $mainframe->setPageTitle(_E_USER_PROFILE.' '.$row->username);
    $mainframe->setMetaTag( 'description', _E_USER_PROFILE.' '.$row->username.', '.$row->name.', '.$GLOBALS['mosConfig_sitename'] );
    $mainframe->setMetaTag( 'keywords', implode(', ', $keys) );

	HTML_user::viewProfile( $row, $option, $lists, $enprof, $blog );
}


/******************/
/* SAVE USER DATA */
/******************/
function userSave($option, $uid) {
	global $database, $access, $my, $mainframe, $fmanager, $Itemid, $lang;

	$user_id = intval( mosGetParam( $_POST, 'id', 0 ));

	if ($uid == 0 || $user_id == 0 || $user_id <> $uid) {
		mosNotAuth();
		return;
	}

    if (!$access->canEdit && !$access->canEditOwn) {
		mosNotAuth();
		return;
    }

	/*
	We must do some tricks for hidden, unpublished or not showing in profile fields
	Elsewhere we will lose these data!
	*/
	$query = "SELECT extrafields FROM #__users WHERE id='".$uid."'";
	$database->setQuery( $query );
	$xextras = $database->loadResult();
	
	$usrfields = explode("|", $xextras);

	$existing[] = array();	
    if ($usrfields && (count($usrfields) > 0)) {
		foreach ($usrfields as $usrfield) {
			$uf = preg_split("/[\=]/", $usrfield, 2);
			$ufid = intval($uf[0]);
			$existing[$ufid] = $uf[1];
		}
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
    
    $modified = array(); //changed fields
    if ($efields) {
        foreach ($efields as $efld => $val ) {
            if (is_array($efld)) { $efld = $efld[0]; } //checkbox

            $extrafields .= $efld.'=';
    		array_push( $modified, $efld );
		
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

    	//insert fields that have not been edited
    	$exkeys = array_keys($existing);
    	foreach ($exkeys as $exkey) {
    		if (!in_array($exkey, $modified)) {
    			$extrafields .= '|'.$exkey.'='.$existing[$exkey];
    		}
    	}
    }
    
    $_POST['extrafields'] = $extrafields;

    //birthdate
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
	$row->load( $user_id );
	$row->orig_password = $row->password;

	if (!$row->bind( $_POST, "gid usertype" )) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>"._LEND;
		exit();
	}
	mosMakeHtmlSafe($row);

    $row->website = preg_replace("/[\`\#\$\%\^\*\<\>\{\}\\\|\"\']+/", "", $row->website);
	if (!preg_match('/^(http\:\/\/)/', $row->website)) {
		$row->website = (trim($row->website) != '') ? 'http://'.$row->website : '';
	}
    if ($row->aim != '') {
        $row->aim = preg_replace("/[\`\#\$\%\^\*\<\>\{\}\\\|\"\']+/", "", $row->aim);
    }
    if ($row->yim != '') {
        $row->yim = preg_replace("/[\`\#\$\%\^\*\<\>\{\}\\\|\"\']+/", "", $row->yim);
    }
    if ($row->msn != '') {
        $row->msn = preg_replace("/[\`\#\$\%\^\*\<\>\{\}\\\|\"\']+/", "", $row->msn);
    }
    if (intval($row->icq) < 1) { $row->icq = ''; }
    $row->phone = preg_replace("/[^0-9-\s]/", '', $row->phone);
    $row->mobile = preg_replace("/[^0-9-\s]/", '', $row->mobile);
    $row->location = mosHTML::cleanText($row->location);
    $row->occupation = mosHTML::cleanText($row->occupation);
    if (!in_array($row->gender, array('MALE', 'FEMALE'))) { $row->gender = 'MALE'; }
    if (trim($row->signature != '')) {
        $row->signature = preg_replace("/[\`\#\$\%\^\*\<\>\{\}\\\|\"\']+/", "", $row->signature);
        $row->signature = mosHTML::cleanText($row->signature);
        $row->signature = eUTF::utf8_substr($row->signature, 0, 255);
    }

	if(isset($_POST["password"]) && $_POST["password"] != "") {
		if(isset($_POST["verifyPass"]) && ($_POST["verifyPass"] == $_POST["password"])) {
			$row->password = md5($_POST["password"]);
		} else {
			echo "<script type=\"text/javascript\">alert(\""._E_PASS_MATCH."\"); window.history.go(-1);</script>"._LEND;
			exit();
		}
	} else {
		//Restore 'original password'
		$row->password = $row->orig_password;
	}
	if (!$row->check()) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>"._LEND;
		exit();
	}
	unset($row->orig_password); // prevent DB error!!

	if (!$row->store()) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>"._LEND;
		exit();
	}

    if ($access->uploadAvatar) {
        $newavatar = 0;
        if ( isset($_FILES['upavatar']) && is_array($_FILES['upavatar'])) {
            $file = $_FILES['upavatar'];

            $avname = eUTF::utf8_strtolower($file['name']);
            $avname = preg_replace("/[\s]/", "_", $avname);
            $lowfilename = $my->id.'_'.$avname;
            $avatarsdir = $mainframe->getCfg('absolute_path').'/images/avatars';
            $ext = $fmanager->FileExt($lowfilename);
            $valid_exts = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array($ext, $valid_exts)) {
                if (file_exists($mainframe->getCfg('absolute_path').'/images/avatars/'.$lowfilename)) {
                    $lowfilename = $my->id.'_'.time().'.'.$ext;
                }
                if ($fmanager->upload( $file['tmp_name'], $avatarsdir.'/'.$lowfilename )) {
                    $fmanager->spChmod( $avatarsdir.'/'.$lowfilename, '0666' );
					$newavatar = 1;
                    $isize = getimagesize($avatarsdir.'/'.$lowfilename);
                    if (($isize[0] != 100) || ($isize[1] != 100)) {
                    	if (!resize_image($avatarsdir.'/'.$lowfilename, '100', '100')) {
                    		$newavatar = 0;
                    	}
                    }
                }
            }
        }

        if ($newavatar) {
            $database->setQuery("UPDATE #__users SET avatar='$lowfilename' WHERE id='$my->id' AND username='$row->username'");
            $database->query();
        }
    }

	if ($access->canViewProfOwn) {
		if ($mainframe->getCfg('sef') != 2) {
			$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_user&task=list'"
			."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%$lang%'))";
			$database->setQuery($query, '#__', 1, 0);
			$_Itemid = intval($database->loadResult());
			if (!$_Itemid) { $_Itemid = $Itemid; }
			$redLink = 'index.php?option=com_user&task=profile&uid='.$uid.'&Itemid='.$_Itemid;
		} else {
			$redLink = 'members/'.$row->username.'.html';
		}
		mosRedirect ($redLink, _E_USRDET_SAVED);
	} else {
		mosRedirect ('index.php', _E_USRDET_SAVED);
	}
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


/*************************/
/* CHECKIN CHECKED ITEMS */
/*************************/
function CheckIn( $userid, $access, $option ) {
	global $database, $mosConfig_db, $mainframe;

    $mainframe->setPageTitle(_E_CHECKIN);
	if (!($access->canEdit || $access->canEditOwn || $userid > 0)) {
		mosNotAuth();
		return;
	}

	$k = 0;

	echo '<h1>'._E_CHECKIN.'</h1>'._LEND;
	foreach ($database->_resource->MetaTables() as $tn) {
		// only check in the elx_* tables
		if (strpos( $tn, $database->_table_prefix ) !== 0) {
			continue;
		}
		$lf = $database->_resource->MetaColumns($tn);
		$nf = sizeof($lf);

		$checked_out = false;
		$editor = false;
		$checked_out_time = false;
		foreach ($lf as $fname) {
			if ( $fname->name == "checked_out") {
				$checked_out = true;
			} else if ( $fname->name == "editor") {
				$editor = true;
			} else if ( $fname->name == "checked_out_time") {
				$checked_out_time = true;
			}
		}
		if (!$checked_out_time) { $checked_out = false; }

		if ($checked_out) {
			if ($editor) {
				$database->setQuery( "SELECT checked_out, editor FROM $tn WHERE checked_out > 0 AND checked_out=$userid" );
			} else {
				$database->setQuery( "SELECT checked_out FROM $tn WHERE checked_out > 0 AND checked_out=$userid" );
			}
			$res = $database->query();
			$num = $database->getNumRows( $res );

			if ($editor) {
				$database->setQuery( "UPDATE $tn SET checked_out=0, checked_out_time='".date('Y-m-d H:i:s')."', editor=NULL WHERE checked_out > 0" );
			} else {
				$database->setQuery( "UPDATE $tn SET checked_out=0, checked_out_time='".date('Y-m-d H:i:s')."' WHERE checked_out > 0" );
			}
			$res = $database->query();

			if ($res) {
				if ($num > 0) {
					echo '<p>'._E_CHECK_TABLE.': <strong>'.$tn.'</strong><br />'._LEND;
					echo _E_CHECKED_IN.'<strong>'.$num.'</strong>'._CHECKED_IN_ITEMS.'</p>'._LEND;
				}
				$k = 1 - $k;
			}
		}
	}
	echo '<p><strong>'._E_ALL_CHECKED_IN.'</strong></p><br />'._LEND;
}

?>