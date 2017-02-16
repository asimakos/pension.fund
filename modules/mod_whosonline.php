<?php 
/**
* @ Version: $Id: mod_whosonline.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Module WhoisOnline
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @ Description: Display online Users and/or Guests
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $acl, $mosConfig_sef, $my, $Itemid, $lang;

$showmode = intval($params->get( 'showmode'));
$filtergroups = intval($params->get( 'filtergroups'));
$groupip = intval($params->get( 'groupip'));

$out = '';

if (($showmode == 0) || ($showmode == 2)) {
	if ($groupip) {
		$query1 = "SELECT COUNT(DISTINCT ip) FROM #__session WHERE gid='29'";
	} else {
		$query1 = "SELECT COUNT(session_id) FROM #__session WHERE gid='29'";
	}
	$database->setQuery($query1);
	//$database->setQuery("SELECT COUNT(session_id) FROM #__session WHERE gid='29'");
	$guest_array = intval($database->loadResult());

    $and = ($filtergroups) ? ' AND gid IN ('.$my->allowed.')' : '';
    //MySQL, Oracle, SQL Server, Postgres
    $query2 = "SELECT COUNT(DISTINCT username) FROM #__session WHERE userid<>'0' AND gid <> '29'".$and;
	$database->setQuery($query2);
	$user_array = intval($database->loadResult());

    if (($guest_array > 0) || ($user_array > 0)) {
        $out .= _E_WE_HAVE;
        if ($guest_array == 1) {
            $out .= _E_GUEST_COUNT;
        } else if ($guest_array > 1) {
            $out .= sprintf(_E_GUESTS_COUNT, $guest_array);
        }
        if (($guest_array > 0) && ($user_array > 0)) {
            $out .= ' '._E_AND.' ';
        }
        if ($user_array == 1) {
            $out .= _E_MEMBER_COUNT;
        } else if ($user_array > 1) {
            $out .= sprintf(_E_MEMBERS_COUNT, $user_array);
        }
        $out .= _E_ONLINE;
    }
}

if ($showmode) {
    $and = ($filtergroups) ? ' AND gid IN ('.$my->allowed.')' : '';
	$query = "SELECT DISTINCT username, userid, gid FROM #__session WHERE userid <> '0'".$and;
	$database->setQuery($query);
	$rows = $database->loadObjectList();
	$n = count($rows);

    if ($n && ($out != '')) { $out .= '<br />'._LEND; }
	$viewProf = $acl->acl_check( 'action', 'view', 'users', $my->usertype, 'profile', 'all' );

    $_Itemid = 0;
    if ($viewProf && ($mosConfig_sef != 2)) {
        $query = "SELECT id FROM #__menu WHERE link='index.php?option=com_user&task=list'"
		."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%$lang%'))";
		$database->setQuery($query, '#__', 1, 0);
        $_Itemid = intval($database->loadResult());
    }
    $baselink = 'index.php?option=com_user&task=profile&Itemid=';
    $baselink .= ($_Itemid) ? $_Itemid : $Itemid;

    for ($i=0; $i<$n; $i++) {
        $row = $rows[$i];
		if ($viewProf) {
            $link = $baselink.'&uid='.$row->userid;
            $seolink = 'members/'.$row->username.'.html';
			$out .= '<a href="'.sefRelToAbs($link, $seolink).'" title="'._E_VIEW_PROFILE.'">';
        }
        if (($row->gid == '25') || ($row->gid == '24')) {
            $out .= '<strong>'.$row->username.'</strong>';
        } else {
            $out .= $row->username;
        }
        $out .= ($viewProf) ? '</a>' : '';
        $out .= ($i == ($n-1)) ? '' : ', ';
        $out .= _LEND;
	}	

	if ($out == '') {
		$out = _E_NO_ONLINE;
	}
}

echo '<div>'.$out.'</div>'._LEND;

?>