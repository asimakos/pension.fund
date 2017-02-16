<?php 
/**
* @version: $Id: mod_random_profile.php 2577 2010-01-11 21:05:13Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Module Random Profile
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!function_exists('random_profiler')) {
    function random_profiler($profstyle, $numshow='2', $showgender='0', $showage='0', $showrealname='0') {
        global $my, $database, $mainframe, $Itemid;

        $query = "SELECT id, name, username, usertype, preflang, avatar, gender, birthdate, registerdate"
        ."\n FROM #__users WHERE block='0' AND expires > '".date('Y-m-d H:i:s')."'"
        ."\n ORDER BY ".$database->_resource->random;
        $database->setQuery($query, '#__', $numshow, '0');
        $rows = $database->loadObjectList();

        $avURLbase = $mainframe->getCfg('ssl_live_site').'/images/avatars/';
        $avABSbase = $mainframe->getCfg('absolute_path').'/images/avatars/';

        $_Itemid = $Itemid;
        if ($mainframe->getCfg('sef') != '2') {
            $query2 = "SELECT id FROM #__menu WHERE link='index.php?option=com_user&task=list' AND published='1'";
            $database->setQuery($query2, '#__', 1, 0);
            $_Itemid = intval($database->loadResult());
            if (!$_Itemid) { $_Itemid = $Itemid; }
        }

        $profLINK = 'index.php?option=com_user&task=profile&Itemid='.$_Itemid;

        if ($rows) {
            for ($i=0; $i<count($rows); $i++) {
                $row = &$rows[$i];

                $seolink = 'members/'.$row->username.'.html';
                $avatar = (trim($row->avatar) == '') ? 'noavatar.png' : $row->avatar;
                if (!file_exists($avABSbase.$avatar)) { $avatar = 'noavatar.png'; }
                $name = ($showrealname) ? $row->name : $row->username;
                $genimg = ($row->gender == 'FEMALE') ? 'female.png' : 'male.png';

                if ($profstyle == 'extended') {
                    echo '<div class="avatarbox">'._LEND;
                    echo '<div id="useravatar">';
                    if ($my->id) {
                        echo '<a href="'.sefRelToAbs($profLINK.'&uid='.$row->id, $seolink ).'" title="'._E_VIEW_PROFILE.': '.$row->username.'">';
                    }
                    echo '<img src="'.$avURLbase.$avatar.'" alt="'.$row->username.'" title="'.$row->username.'" />';
                    if ($my->id) {
                        echo '</a>';
                    }
                    echo _LEND;
                    echo '<div id="useravatarname">'.$name;
                    if ($showgender) {
                        echo ' <img src="'.$mainframe->getCfg('ssl_live_site').'/images/M_images/'.$genimg.'" border="0" align="absmiddle" />';
                    }
                    if (($showage) && (trim($row->birthdate) != '')) {
                        $bdate = preg_split('/\-/', $row->birthdate);
                        $byear = intval($bdate[0]);
                        if ($byear > 1900) {
                            echo ' ('.(date('Y') - $byear).')';
                        }
                    }
                    echo '</div>'._LEND;
                    echo '</div>'._LEND;
                    echo '<b>'.$row->username.'</b><br />'._LEND;
                    echo $row->name.'<br />'._LEND;
                    echo $row->usertype.'<br />'._LEND;
                    echo mosFormatDate( $row->registerdate, '%d %B %Y' ).'<br />'._LEND;
                    echo $row->preflang;
                    echo '</div>'._LEND;

                } else {
                    echo '<div id="useravatar">';
                    if ($my->id) {
                        echo '<a href="'.sefRelToAbs($profLINK.'&uid='.$row->id, $seolink).'" title="'._E_VIEW_PROFILE.': '.$row->username.'">';
                    }
                    echo '<img src="'.$avURLbase.$avatar.'" alt="'.$row->username.'" title="'.$row->username.'" />';
                    if ($my->id) {
                        echo '</a>';
                    }
                    echo _LEND;
                    echo '<div id="useravatarname">'.$name;
                    if ($showgender) {
                        echo ' <img src="'.$mainframe->getCfg('ssl_live_site').'/images/M_images/'.$genimg.'" border="0" align="absmiddle" />';
                    }
                    if (($showage) && (trim($row->birthdate) != '')) {
                        $bdate = preg_split('/\-/', $row->birthdate);
                        $byear = intval($bdate[0]);
                        if ($byear > 1900) {
                            echo ' ('.(date('Y') - $byear).')';
                        }
                    }
                    echo '</div>'._LEND;
                    echo '</div>'._LEND;
                }
            }
        }
    }
}

$profstyle = $params->get( 'profstyle', 'compact' );
$numshow = intval($params->get( 'numshow', '2' ));
$showgender = intval($params->get( 'showgender', '0' ));
$showage = intval($params->get( 'showage', '0' ));
$showrealname = intval($params->get( 'showrealname', '0' ));

random_profiler($profstyle, $numshow, $showgender, $showage, $showrealname);

?>