<?php 
/** 
* @version: $Id: poll.php 68 2010-06-27 13:08:46Z sannosi $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Poll
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
   
if (($mosConfig_access == '1') | ($mosConfig_access == '3')) {
	//if is a guest find public frontend group name
	if ( $my->usertype == '' ) { 
	    $usertype = eUTF::utf8_strtolower($acl->get_group_name('29'));
	} else {
	    $usertype = eUTF::utf8_strtolower($my->usertype);
	}
	// ensure user is allowed to view this component
	if (!($acl->acl_check( 'action', 'view', 'users', $usertype, 'components', 'all' ) || 
	    $acl->acl_check( 'action', 'view', 'users', $usertype, 'components', 'com_poll' ))) {
            mosRedirect( 'index.php', _NOT_AUTH );
	}
}

$mainframe->setPageTitle(_POLL_POLLS);

require_once( $mainframe->getPath( 'front_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$polls_graphwidth 	= 200;
$polls_barheight 	= 2;
$polls_maxcolors 	= 5;
$polls_barcolor 	= 0;

$poll = new mosPoll( $database );

$id = intval(mosGetParam( $_REQUEST, 'id', 0 ));
if (!$id) { $id = intval(mosGetParam( $_POST, 'id', 0 )); }

switch ($task) {
	case 'vote':
		pollAddVote( $id );
		break;
	default:
		pollresult( $id );
		break;
}


/************/
/* ADD VOTE */
/************/
function pollAddVote( $uid ) {
	global $database, $Itemid, $lang, $my, $mainframe;

	$sessionCookieName = md5('site'.$mainframe->getCfg('live_site'));
	$sessioncookie = mosGetParam( $_REQUEST, $sessionCookieName, '' );

    $mainframe->setMetaTag( 'description', _POLL_POLLS.', '.$mainframe->getCfg('sitename'));
    
	//if (!$sessioncookie) {
	//	elxError(_E_ALERT_ENABLED, 1);
	//	return;
	//}

	$poll = new mosPoll( $database );
	if (!$poll->load( $uid )) {
		elxError(_PAGE_NOFOUND, 1);
		return;
	}

	$myarr = explode(',',$my->allowed);
	if (!in_array($poll->access, $myarr)) {
		elxError(_NOT_AUTH, 1);
		return;
	}

    if ($poll->locked) {
		elxError(_POLL_LOCKALERT, 1);
		return;
    }

	//check if user has allready vote based on cookie
	$cookiename = 'voted'.$poll->id;
	$voted = intval(mosGetParam( $_COOKIE, $cookiename, 0 ));

	if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND $_SERVER['HTTP_X_FORWARDED_FOR']!="") {
		$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else if (isset($_SERVER['REMOTE_ADDR']) AND $_SERVER['REMOTE_ADDR']!="") {
		$ipaddress = $_SERVER['REMOTE_ADDR'];
	} else {
		$ipaddress = '';
	}

	//check if user has allready vote based on ip address
	if (!$voted) {
		if (strlen($ipaddress) > 7) {
			$lagstamp = time() - intval($poll->lag);
			$checkdate = date('Y-m-d H:i:s', $lagstamp);

			$query = "SELECT COUNT(id) FROM #__poll_date"
			."\n WHERE poll_id='$poll->id' AND ipaddress='$ipaddress' AND date > '$checkdate'";
			$database->setQuery($query);
			$counter = intval($database->loadResult());
			if ($counter > 0) { //oops a cheater!
				$voted = 1;
				@setcookie( $cookiename, '1', time()+$poll->lag, '/' );
			}
		}
	}

    if ($voted) {
		elxError(_ALREADY_VOTE, 0);
		return;
    }

	$voteid = intval(mosGetParam( $_POST, 'voteid', 0 ));
	if (!$voteid) {
		elxError(_E_NO_SELECTION, 0);
		return;
	}

	@setcookie( $cookiename, '1', time()+$poll->lag, '/' );

	$database->setQuery( "UPDATE #__poll_data SET hits=hits + 1 WHERE pollid='$poll->id' AND id='$voteid'");
	$database->query();

	$database->setQuery( "UPDATE #__polls SET voters=voters + 1 WHERE id='$poll->id'");
	$database->query();

	$now = date('Y-m-d H:i:s');
	$database->setQuery( "INSERT INTO #__poll_date VALUES ('0', '$now', '$voteid', '$poll->id', '$ipaddress')");
	$database->query();

	echo '<h1>'._POLL_POLLS.'</h1>'._LEND;
	echo '<p>'._THANKS.'</p>'._LEND;
	echo '<a href="'.sefRelToAbs( 'index.php?option=com_poll&task=results&id='. $uid , 'polls/'.$poll->seotitle.'.html').'" title="'._BUTTON_RESULTS.'">';
	echo $poll->title.'</a> ('._BUTTON_RESULTS.')<br />'._LEND;
	echo '<div class="back_button"><a href="javascript:history.go(-1);" title="'._BACK.'">'._BACK.'</a></div>'._LEND;
	echo '<br /><br />'._LEND;
}


/***********************************/
/* PREPARE TO DISPLAY POLL RESULTS */
/***********************************/
function pollresult( $uid ) {
	global $database, $Itemid, $mainframe, $lang, $my;

	$poll = new mosPoll( $database );
	$poll->load( $uid );

	if (empty($poll->title)) {
		$poll->id = 0;
		$poll->title = _E_SELECT_POLL;
	}

    if ($poll->language != '') {
        $plangs = explode(',', $poll->language);
        if (!in_array($lang, $plangs)) {
            $poll->id = 0;
            $poll->title = _E_SELECT_POLL;
        }
    }

	$first_vote = '';
	$last_vote = '';
	if ($poll->id) {
		$database->setQuery("SELECT date FROM #__poll_date WHERE poll_id='$poll->id' ORDER BY date ASC", '#__', 1, 0);
		$mindate = $database->loadResult();
		$database->setQuery("SELECT date FROM #__poll_date WHERE poll_id='$poll->id' ORDER BY date DESC", '#__', 1, 0);
		$maxdate = $database->loadResult();

		if ($mindate && $maxdate) {
			$first_vote = mosFormatDate( $mindate, _GEM_DATE_FORMLC2 );
			$last_vote = mosFormatDate( $maxdate, _GEM_DATE_FORMLC2 );
		}

		if (in_array($database->_resource->databaseType, array('oci8', 'oci8po', 'oci805', 'oracle'))) {
			$query = "SELECT id, text, hits FROM #__poll_data WHERE pollid='$poll->id' AND TRIM(text) IS NOT NULL ORDER BY id ASC";
		} else {
			$query = "SELECT id, text, hits FROM #__poll_data WHERE pollid='$poll->id' AND text <> '' ORDER BY id ASC";
		}
        $database->setQuery( $query );
        $votes = $database->loadObjectList();
    } else { $votes = null; }

	$query = "SELECT id, title FROM #__polls WHERE published=1 AND ((language LIKE '%$lang%') OR (language IS NULL)) ORDER BY id";
	$database->setQuery( $query );
	$polls = $database->loadObjectList();

	reset( $polls );

    //Validate Itemid
    $query = "SELECT id FROM #__menu WHERE link='index.php?option=com_poll' AND published='1'"
    ."\n AND access IN (".$my->allowed.") AND ((language LIKE '%".$lang."%') OR (language IS NULL))";
    $database->setQuery($query);
    $itemids = $database->loadResultArray();
    $val = 0;
    if (count($itemids)) {
        if (!in_array($Itemid, $itemids)) {
            $Itemid = $itemids[0];
            $GLOBALS['Itemid'] = $itemids[0];
        }
        $val = 1;
    }

	$pollist = '';
	for ($i=0; $i<count( $polls ); $i++ ) {
		$k = $polls[$i]->id;
		$t = $polls[$i]->title;
		$pollist .= '<a href="'.sefRelToAbs('index.php?option=com_poll&task=results&id='.$k.'&Itemid='.$Itemid).'" ';
		$pollist .= 'title="'.$t.'">';
		$pollist .= ($k == $poll->id) ? '<strong>'.$t.'</strong>' : $t;
		$pollist .= '</a><br />'._LEND;
    }
    if ($pollist == '') { $pollist = _POLL_NOPOLLS; }

	// Adds parameter handling
	$menu = new mosMenu( $database );
	$menu->load( $Itemid );

    if (!$val) {
        $menu->name = ($poll->id) ? $poll->title : _POLL_POLLS;
    }

	$params = new mosParameters( $menu->params );
	$params->def( 'page_title', 1 );
	$params->def( 'pageclass_sfx', '' );
	$params->def( 'back_button', $mainframe->getCfg( 'back_button' ) );
	$params->def( 'header', $menu->name );

    $metaKeys = array(_POLL_POLLS, 'poll', 'gallup', 'results');
    if ($votes) {
        foreach ($votes as $vote) {
            if ($vote->text != '') {
                $k = preg_replace("/([0-9\$\~\`\&\#\*\@\"\'\/\|\-\+\=\_])/", '', $vote->text);
                if (trim($k) != '') {
                    $metaKeys[] = $vote->text;
                }
            }
        }
    }

	$mainframe->SetPageTitle($poll->title.' - '._POLL_TITLE);
    $mainframe->setMetaTag( 'description', _POLL_TITLE.', '.$poll->title.', '.$mainframe->getCfg('sitename'));
    $mainframe->setMetaTag( 'keywords', implode(', ', $metaKeys) );

	poll_html::showResults( $poll, $votes, $first_vote, $last_vote, $pollist, $params );
}

?>
