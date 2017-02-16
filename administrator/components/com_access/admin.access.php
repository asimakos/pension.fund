<?php 
/**
* @version: $Id: admin.access.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Access
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//ensure user has access to this function
if (!($acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'all' ) || 
    $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_access' ))) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );

$task = trim( mosGetParam( $_REQUEST, 'task', null ) );
$cid = mosGetParam( $_REQUEST, 'cid', array( 0 ) );
if (!is_array( $cid )) {
	$cid = array ( 0 );
}

switch ($task) {
	case 'new':
		editAROgroup( 0, $option);
		break;
	case 'edit':
		editAROgroup( intval( $cid[0] ), $option );
		break;
	case 'save':
		saveAROgroup( $option );
		break;
	case 'remove':
		removeAROgroup( intval( $cid[0] ), $option );
		break;
	case 'rename':
		renameAROgroup();
		break;
	case 'editperms':
        $grid = intval(mosGetParam( $_REQUEST, 'grid', 0));
        $group = (!intval($cid[0])) ? $grid : intval( $cid[0] );
		editPerms( $group, $option );
		break;
	case 'addperm':
		addNEWperm( $option );
		break;
	case 'removeperm':
		removePerm( intval( $cid[0] ), $option );
		break;
	default:
		showAROgroups( $option );
		break;
}


/*********************************/
/* PREPARE TO DISPLAY ARO GROUPS */
/*********************************/
function showAROgroups( $option ) {
	global $database, $acl, $mosConfig_absolute_path;

	//count groups
	$query = "SELECT COUNT(*) FROM #__core_acl_aro_groups"
	. "\n WHERE name != 'ROOT' AND name != 'USERS'";
	$database->setQuery( $query );
	$total = $database->loadResult();

	//get list of Groups
	$query = "SELECT group_id as id, name FROM #__core_acl_aro_groups"
	. "\n WHERE name != 'ROOT' AND name != 'USERS'"
	. "\n ORDER BY lft DESC";
	$database->setQuery( $query );
	$rows = $database->loadObjectList();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	$count = count( $rows );

	//number of (total) Users in each group
	for ( $i = 0; $i < $count; $i++ ) {
		$database->setQuery("SELECT COUNT( id ) FROM #__users WHERE gid='".$rows[$i]->id."'");
		$gusers = $database->loadResult();
		$rows[$i]->numusers = $gusers;
	}

	//check each group if can login to backend
    $query = "SELECT aro_value FROM #__core_acl_access_lists"
    . "\n WHERE aco_section = 'administration' AND aco_value = 'login'"
    . "\n AND aro_section = 'users'";
	$database->setQuery( $query );
	$bgroups = $database->loadResultArray();

	for ( $i = 0; $i < $count; $i++ ) {
		if (in_array( eUTF::utf8_strtolower($rows[$i]->name), $bgroups) ) { //ALLAXA TH FUNCTION PROSOXH ELEGXOS XANA! $rows[$i]['name']
			$rows[$i]->backgroup = '1';
		} else {
			$rows[$i]->backgroup = '0';
		}
	}

	//create ARO tree
	$sorted_groups = $acl->sort_groups();
	$formated_groups = $acl->format_groups($sorted_groups, 'TEXT');

	HTML_access::show_ARO_groups( $rows, $option, $formated_groups );
}


/*
function for renaming ARO group
rgid is the group_id of the group to be renamed and $rname the new group's name
Copyright (C) 2006 Elxis.org
*/
function renameAROgroup() {
	global $database, $acl, $my, $adminLanguage;

	if(isset($_GET['rgid']) && isset($_GET['rname'])) {
        $rgid = mosGetParam( $_GET, 'rgid', '' );
        $rname = eUTF::utf8_trim( mosGetParam( $_GET, 'rname', '' ));
	} else {
		$errGroup = $adminLanguage->A_CMP_ACC_YMSGR;
		$rname = '';	  
	}
	if ( (eUTF::utf8_trim( $rname ) == '' ) || ( !is_numeric( $rgid ) )) {
		$errGroup = $adminLanguage->A_CMP_ACC_YMSGR;  
	}

	//check if the new name already exists
	$lowrname = eUTF::utf8_strtolower($rname);
	$query = "SELECT COUNT(*) FROM #__core_acl_aro_groups WHERE LOWER( name ) = '$lowrname'";
	$database->setQuery( $query );
	$count = intval( $database->loadResult() );
	if ( $count > 0 ) {
		$errGroup = $adminLanguage->A_CMP_ACC_TSAGN. ' '.$rname;	
	}

    //check if user has enough access to rename selected group!
	if (!isset( $errGroup )) {
        if ( !$acl->allow_edit( $my->gid, $rgid, 'RENAME' )) {
            $errGroup = $adminLanguage->A_CMP_ACC_YANARG;
        }
    }

	if (!isset( $errGroup )) {
	  	//find the group's old name
		$oldname = $acl->get_group_name($rgid, 'ARO');

		//update #__core_acl_aro_groups
		$query = "UPDATE #__core_acl_aro_groups SET name= '".$rname."' WHERE group_id = '".$rgid."'";
		$database->setQuery( $query );
        if (!$database->query()) {
            $errGroup = $adminLanguage->A_CMP_ACC_CNUTACL;
        }

		//update #__users
		$query = "UPDATE #__users SET usertype= '".$rname."' WHERE gid = '".$rgid."'";
		$database->setQuery( $query );
        if (!$database->query()) {
            $errGroup = $adminLanguage->A_CMP_ACC_CNUTUS;
        }

        //update #__core_acl_access_lists
		$query = "UPDATE #__core_acl_access_lists SET aro_value= LOWER( '$rname' ) WHERE aro_value = LOWER( '$oldname' )";
		$database->setQuery( $query );
        if (!$database->query()) {
            $errGroup = $adminLanguage->A_CMP_ACC_CNUTCAL;
        }
		//Does table #__usertypes needs also to be updated?
	}

    if (!isset($errGroup)) {
        if ( $my->gid == $rgid ) {
            //force logout, we cannot redirect to login screen because of AJAX
            $query = "DELETE FROM #__session WHERE userid = '$my->id'";
            $database->setQuery( $query );
            $database->query();
            $login_urge = '<span style="font-weight: bold; color: red;">' . $adminLanguage->A_CMP_ACC_YHTLA . '</span>';
        }
    }
    
    echo '<div class="ajaxbox">';
    echo '<strong>' . $adminLanguage->A_CMP_ACC_MFS . '</strong><br />';
    if (!isset($errGroup)) {
        echo $adminLanguage->A_CMP_ACC_UGWID. ' '.$rgid;
        echo ' ' . $adminLanguage->A_CMP_ACC_RNMTO . ': '.$rname;
        if (isset( $login_urge )) { echo '<br>'.$login_urge; }
    } else { echo '<span style="font-weight: bold; color: red;">'.$adminLanguage->A_ERROR.':</span> '.$errGroup; }
    echo '</div><br />'._LEND;
}


/*
add/edit ARO group
Copyright (C) 2006 Elxis.org
*/
function editAROgroup ( $grid='0', $option='com_access' ) {
	global $database, $acl, $my, $adminLanguage;

	$notallowed = array('17', '25', '28', '29', '30' );
	if ( in_array( $grid, $notallowed )) {
		mosRedirect( 'index2.php?option=com_access', $adminLanguage->A_CMP_ACC_YCNEDGR );
		exit();
	}

	if ( $grid != '0' ) {
        //check if user has enough access to edit selected group!
        if ( !$acl->allow_edit( $my->gid, $grid )) {
		  mosRedirect( 'index2.php?option=com_access', $adminLanguage->A_CMP_ACC_YCNEDGR );
		  exit();
        }
	  	//find the group's name
		$grname = $acl->get_group_name($grid, 'ARO');
		//find the parent's group id
		$grpid = $acl->get_group_parent_id($grid, 'ARO');
	} else {
		$grpid = 25;
		$grname = '';
	}

	//get list of Groups (ROOT and USERS included)
	$query = "SELECT group_id as id, name FROM #__core_acl_aro_groups ORDER BY lft DESC";
	$database->setQuery( $query  );
	$rows = $database->loadObjectList();

	//list all parent groups
	$lists['parent_groups']	= mosHTML::selectList( $rows, 'parent_group', 'class="selectbox" size="1" dir="ltr"', 'id', 'name', $grpid );

	//create ARO tree
	$sorted_groups = $acl->sort_groups();
	$formated_groups = $acl->format_groups($sorted_groups, 'TEXT');

	HTML_access::Edit_ARO_group( $rows, $grid, $grname, $lists, $formated_groups, $option );
}


/*
function for saving ARO group
parent_gid is the group_id of the parent group
new_name is the name of the new group
Copyright (C) 2006 Elxis.org
*/
function saveAROgroup( $option ) {
	global $database, $acl, $my, $adminLanguage;

    if ( (!isset($_POST['group_id']) ) || (!isset($_POST['parent_group'])) || (!isset($_POST['name']))) {
		echo "<script type=\"text/javascript\">alert('You must set all required fields'); window.history.go(-1);</script>"._LEND;
		exit();
    }

    $group_id = mosGetParam( $_POST, 'group_id', '' );
    $parent_gid = mosGetParam( $_POST, 'parent_group', '' );
    $newname = eUTF::utf8_trim( strip_tags( mosGetParam( $_POST, 'name', '' )));

	if ($newname == '') {
		echo "<script type=\"text/javascript\">alert('" . $adminLanguage->A_CMP_ACC_YMSPNGR . "'); window.history.go(-1);</script>"._LEND;
		exit();
	}
	if (!is_numeric($parent_gid) || ($parent_gid == 17) || ($parent_gid == 28)) {
		echo "<script type=\"text/javascript\">alert('". $adminLanguage->A_CMP_ACC_IPGR . "'); window.history.go(-1);</script>"._LEND;
		exit();
	}
	if ( $parent_gid == $my->gid ) {
		echo "<script type=\"text/javascript\">alert('" . $adminLanguage->A_CMP_ACC_YCCGPY . "'); window.history.go(-1);</script>"._LEND;
		exit();
	}    

    //can not make a group having as parent one of his children groups!
    $mchils = $acl->get_group_children( $my->gid, 'ARO', 'RECURSE' );

    if ( count( $mchils ) > '0' ) {
        if(in_array( $parent->gid, $mchils )) {
            echo "<script type=\"text/javascript\">alert('" . $adminLanguage->A_CMP_ACC_YCNUSGR . "'); window.history.go(-1);</script>"._LEND;
            exit();
        }
    }

    //if not in backend brunch he can not use backend groups as parents
    $spars = $acl->get_group_parents( '25', 'ARO', 'RECURSE' );
    array_push($spars, '25');
    if ( !in_array( $my->gid, $spars )) {
        if (in_array( $parent_gid, $spars )) {
            echo "<script type=\"text/javascript\">alert('" . $adminLanguage->A_CMP_ACC_YCNUSGR ."'); window.history.go(-1);</script>"._LEND;
            exit();
        }
    }

	//check if the new name already exists
	$andwhere = '';
    if ($group_id != '0') {
        $andwhere = "\n AND group_id != '$group_id'";
    } 

	$lownewname = eUTF::utf8_strtolower($newname);
    $query = "SELECT COUNT(*)"
	."\n FROM #__core_acl_aro_groups"
	."\n WHERE  LOWER( name ) = '".$lownewname."'"
	. $andwhere
	;

    $database->setQuery( $query );
	$count = intval( $database->loadResult() );
	if ( $count > 0 ) {
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_CMP_ACC_TIAGTN."'); window.history.go(-1);</script>"._LEND;
		exit();	
	}

    $msg = '';
    //if add new group
    if ($group_id == '0') {
	   if ( $new_id = $acl->add_group( $newname, $parent_gid, 'ARO' ) ) {
	       $msg .= $adminLanguage->A_CMP_ACC_GADDSUC . ' '.$new_id.'.';
	    } else {
	       $msg .= $adminLanguage->A_CMP_ACC_CNADDNG;
	    }
	} else {
        //update group
        $oldname = $acl->get_group_name( $group_id );
        
        if ( $acl->edit_group( $group_id, $newname, $parent_gid, 'ARO') ) {
            $msg .= $adminLanguage->A_CMP_ACC_THGRP. ' '. $group_id .' ' . $adminLanguage->A_CMP_ACC_UPSUCC;
        } else {
	       $msg .= $adminLanguage->A_CMP_ACC_CNUPGR . ' '.$group_id.'.';
	    }
	}

    if ((isset( $oldname )) && ( $oldname != $newname )) {
		//update table #__users
		$query = "UPDATE #__users SET usertype= '".$newname."' WHERE gid = '".$group_id."'";
		$database->setQuery( $query );
        $database->query();

        //update #__core_acl_access_lists
        $lowoldname = eUTF::utf8_strtolower($oldname);
		$query = "UPDATE #__core_acl_access_lists SET aro_value= LOWER( '$newname' ) WHERE aro_value = '".$lowoldname."'";
		$database->setQuery( $query );
        $database->query();
        
        //he can not edit his group so there is no realy need for the following check
        //but we add it for making some things sure.
        //if this is his group force logout and urge him to login again
        if ( $my->gid == $group_id ) {
            $database->setQuery("DELETE FROM #__session WHERE userid = '$my->id'");
            $database->query();
            mosRedirect( 'index2.php', $adminLanguage->A_CMP_ACC_GESLAG );
        }
        
    }

	//Does table #__usertypes needs also to be updated?
	mosRedirect( 'index2.php?option=com_access', $msg );
}


/*
function for deleting ARO group
delete_gid is the group_id of the group to be deleted
Copyright (C) 2006 Elxis.org
*/
function removeAROgroup( $delete_gid, $option ) {
	global $database, $acl, $my, $adminLanguage;

	if ((trim( $delete_gid ) == '') || ( !is_numeric( $delete_gid ) )) {
		echo "<script type=\"text/javascript\">alert('" . $adminLanguage->A_CMP_ACC_NGSDEL . "'); window.history.go(-1);</script>"._LEND;
		exit();	  
	}

	$notallowed = array('17', '18', '25', '28', '29', '30' );
	if ( in_array( $delete_gid, $notallowed )) {
		mosRedirect( 'index2.php?option=com_access', $adminLanguage->A_CMP_ACC_YCNDELG );
		exit();
	}

    //check if user has enough access to delete selected group!
    if ( !$acl->allow_edit( $my->gid, $delete_gid, 'DELETE' )) {
        mosRedirect( 'index2.php?option='.$option, $adminLanguage->A_CMP_ACC_YANALDG );
	   exit();    
    }
    
    $delname = $acl->get_group_name( $delete_id );
     	
	//delete group
	if ( !$acl->del_group( $delete_gid, 'TRUE', 'ARO' ) ) {
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_CMP_ACC_CNDLGR . "'); window.history.go(-1);</script>"._LEND;
		exit();	  
	}

	$msg = $adminLanguage->A_CMP_ACC_GRSDEL;

	//remove access lists
	$lowdelname = eUTF::utf8_strtolower($delname);
	$database->setQuery( "DELETE FROM #__core_acl_access_lists WHERE aro_value = '".$lowdelname."'" );
    if (!$database->query()) {
        $msg .= ' '.$adminLanguage->A_CMP_ACC_BCNDGP;
    }

	//remove users
	$database->setQuery( 'DELETE FROM #__users WHERE gid='.$delete_gid );
    if (!$database->query()) {
        $msg .= ' '.$adminLanguage->A_CMP_ACC_BCNDUS;
    }

	//Does table #__usertypes needs also to be updated?
	mosRedirect( 'index2.php?option='.$option, $msg );
}


/****************************/
/* PREPARE EDIT GROUP'S ACL */
/****************************/
function editPerms ( $grid='0', $option='com_access' ) {
	global $database, $acl, $my, $adminLanguage;

	if (( trim( $grid ) == '' ) || ( $grid == '0' )) {
	   mosRedirect( 'index2.php?option='.$option, $adminLanguage->A_CMP_ACC_NOGRSEL );
       exit();
	}

    //check if user has enough access to edit selected group permissions!
    if ( !$acl->allow_edit( $my->gid, $grid, 'EDITPERMS' )) {
        mosRedirect( 'index2.php?option='.$option, $adminLanguage->A_CMP_ACC_YCNEDGR );
        exit();    
    }

    //get installed components for add new permission feature
    if (preg_match('/mysql/i', $database->_resource->databaseType)) {
        $query = "SELECT `option` FROM #__components WHERE `option` != '' GROUP BY `option`";
    } else {
        $query = "SELECT option FROM #__components WHERE option != '' GROUP BY option";
    }

    $database->setQuery( $query );
    $icomps = $database->loadResultArray();
    if ($database->getErrorNum()) {
        echo $database->stderr();
	   return false;
	}

    $stcomps = array('all', 'com_content', 'com_statistics', 'com_syndicate', 'com_registration', 'com_user', 'com_templates', 'com_trash', 'com_menumanager', 'com_languages', 'com_softdisk', 'com_database', 'com_banners', 'com_installer', 'com_sections', 'com_categories', 'com_access', 'com_newsflash', 'com_media', 'com_users');
    $comps = array_merge($stcomps, $icomps );
    asort($comps);

  	//find the group's name
	$grname = $acl->get_group_name($grid, 'ARO');
	//find the parent's group id
	$grpid = $acl->get_group_parent_id($grid, 'ARO');

	$lowgrname = eUTF::utf8_strtolower($grname);
    $query = "SELECT * FROM #__core_acl_access_lists"
    ."\n WHERE LOWER( aro_value ) = '".$lowgrname."' ORDER BY aco_section, aco_value";
    $database->setQuery( $query );
    $rows = $database->loadObjectList();

    HTML_access::edit_perms( $grid, $grname, $grpid, $rows, $comps, $option );
}


/**********************/
/* ADD NEW PERMISSION */
/**********************/
function addNEWperm ( $option ) {
	global $database, $acl, $adminLanguage;

    $aco_section = mosGetParam( $_POST, 'aco_section', '' );
    $aco_value = mosGetParam( $_POST, 'aco_value', '' );
    $aro_section = mosGetParam( $_POST, 'aro_section', '' );
    $aro_value = mosGetParam( $_POST, 'aro_value', '' );
    $axo_section = mosGetParam( $_POST, 'axo_section', '' );
    $axo_value = mosGetParam( $_POST, 'axo_value', '' );

	if (( trim( $aco_section ) == '' ) || ( trim( $aco_value ) == '' )) {
        mosRedirect( 'index2.php?option='.$option, 'Invalid ACO!' );
        exit();
	}
	if (( trim( $aro_section ) == '' ) || ( trim( $aro_value ) == '' )) {
        mosRedirect( 'index2.php?option='.$option, 'Invalid ARO!' );
        exit();
	}

    //Check if permission allready exists
    $query = "SELECT COUNT(*)"
	. "\n FROM #__core_acl_access_lists"
	. "\n WHERE aco_section = '$aco_section' AND aco_value = '$aco_value'"
	. "\n AND aro_section = '$aro_section' AND aro_value = '$aro_value'"
	. "\n AND axo_section = '$axo_section' AND axo_value = '$axo_value'";

    /* 
    Ioannis Sannos comments:
    There is a security issue here that is up to Super admin settings.
    If he allows a group to use this component, a user belonging to that group
    may add permissions greater than his to a lower access group (like login in admin area).
    Due to complexity and the large number of permissions combinations 
    we can not add a check mechanism in this. BTW we can not predict super admin's intentions!
    It is Super Admin's responsibility to whom he gives access to this component
    */

    $database->setQuery( $query );
	$count = intval( $database->loadResult() );
	if ( $count > 0 ) {
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_CMP_ACC_PERMEXIST."'); window.history.go(-1);</script>\n";
		exit();
	}

    if (preg_match('/mysql/i', $database->_resource->databaseType)) {
        $database->setQuery( "SELECT MAX(list_id)+1 FROM #__core_acl_access_lists" );
        $insert_id = intval( $database->loadResult() );
	} else {
	    $iquery = "SELECT list_id FROM #__core_acl_access_lists ORDER BY list_id DESC";
        $database->setQuery( $iquery, '#__', 1, 0 );
        $insert_id = intval($database->loadResult())+1;
	}

    $query = "INSERT INTO #__core_acl_access_lists VALUES"
    ."\n ('$insert_id', '$aco_section', '$aco_value', '$aro_section', LOWER('$aro_value'), '$axo_section', '$axo_value')";
	$database->setQuery( $query );
    if ( !$database->query() ) {
        echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
		exit();
    }

	mosRedirect( 'index2.php?option='.$option.'&task=editperms&grid='.intval($_POST['grid']).'&hidemainmenu=1', $adminLanguage->A_CMP_ACC_PERMADD.' '.$aro_value );
}


/*********************/
/* DELETE PERMISSION */
/*********************/
function removePerm ( $pid='0', $option='com_access' ) {
    global $database, $adminLanguage;

    $database->setQuery("DELETE FROM #__core_acl_access_lists WHERE list_id='$pid'");
    if ($database->query()) {
        $msg = $adminLanguage->A_CMP_ACC_PERDSUC;
    } else { $msg = $adminLanguage->A_CMP_ACC_CNDELPER; }

	mosRedirect( 'index2.php?option='.$option.'&task=editperms&grid='.intval($_POST['grid']).'&hidemainmenu=1', $msg );
}

?>