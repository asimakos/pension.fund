<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Messages
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$task = trim( mosGetParam( $_REQUEST, 'task', null ) );
$cid = mosGetParam( $_REQUEST, 'cid', array( 0 ) );
if (!is_array( $cid )) {
	$cid = array ( 0 );
}

switch ($task) {
	case 'view':
		viewMessage( $cid[0] );
	break;
	case 'new':
		newMessage( NULL, NULL );
	break;
	case 'reply':
		newMessage( mosGetParam( $_REQUEST, 'userid', 0 ), mosGetParam( $_REQUEST, 'subject', '' ));
	break;
	case 'save':
		saveMessage();
	break;
	case 'remove':
		removeMessage( $cid );
	break;
	case 'config':
		editConfig();
	break;
	case 'saveconfig':
		saveConfig();
	break;
	default:
		showMessages( $option );
	break;
}


/**************************/
/* PREPARE TO EDIT CONFIG */
/**************************/
function editConfig() {
	global $database, $my;

	$database->setQuery( "SELECT cfg_name, cfg_value FROM #__messages_cfg WHERE user_id='".$my->id."'" );
	$data = $database->loadObjectList( 'cfg_name' );

	$vars = array();
	$vars['lock'] = mosHTML::yesnoSelectList( "vars[lock]", 'class="selectbox" size="1"', @$data['lock']->cfg_value );
	$vars['mail_on_new'] = mosHTML::yesnoSelectList( "vars[mail_on_new]", 'class="selectbox" size="1"', @$data['mail_on_new']->cfg_value );

	HTML_messages::editConfig( $vars );

}


/***************/
/* SAVE CONFIG */
/***************/
function saveConfig() {
	global $database, $my, $adminLanguage;

	$database->setQuery( "DELETE FROM #__messages_cfg WHERE user_id='".$my->id."'" );
	$database->query();

	$vars = mosGetParam( $_POST, 'vars', array() );
	foreach ($vars as $k=>$v) {
		$v = $database->getEscaped( $v );
		$database->setQuery( "INSERT INTO #__messages_cfg (user_id,cfg_name,cfg_value) VALUES ('$my->id','$k','$v')");
		$database->query();
	}
	mosRedirect( 'index2.php?option=com_messages', $adminLanguage->A_SETTSUCSAVED );
}


/*******************************/
/* PREPARE COMPOSE NEW MESSAGE */
/*******************************/
function newMessage($user, $subject) {
	global $database, $mainframe, $my, $acl, $adminLanguage;

	//get available backend user groups
	$gids = $acl->get_group_children( '30', 'ARO', 'RECURSE' );
	$gids = implode( ',', $gids );

	//get list of usernames
	$recipients = array( mosHTML::makeOption( '0', $adminLanguage->A_SELECTUSER ) );
	$database->setQuery( "SELECT id AS value, username AS text FROM #__users WHERE gid IN (".$gids.") ORDER BY name" );
	$recipients = array_merge( $recipients, $database->loadObjectList() );

	$recipientslist = mosHTML::selectList($recipients, 'user_id_to', 'class="selectbox" size="1" dir="ltr"', 'value', 'text', $user);
	HTML_messages::newMessage($recipientslist, $subject );
}


/****************/
/* SAVE MESSAGE */
/****************/
function saveMessage() {
	global $database, $mainframe, $my;

	$row = new mosMessage( $database );
	if (!$row->bind( $_POST )) {
		echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}

	if (!$row->send()) { mosRedirect( 'index2.php?option=com_messages', $row->getError()); }
	mosRedirect( "index2.php?option=com_messages" );
}


/****************************/
/* PREPARE TO SHOW MESSAGES */
/****************************/
function showMessages( $option ) {
	global $database, $mainframe, $my, $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );
	$search = $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
	$search = $database->getEscaped( eUTF::utf8_trim( eUTF::utf8_strtolower( $search ) ) );

	$wheres = array();
	$wheres[] = " a.user_id_to='$my->id'";

	if (isset($search) && $search!= "") {
		$wheres[] = "(u.username LIKE '%$search%' OR email LIKE '%$search%' OR u.name LIKE '%$search%' OR subject LIKE '%$search%')";
	}

	$database->setQuery( "SELECT COUNT(*) FROM #__messages a"
	."\n INNER JOIN #__users u ON u.id = a.user_id_from"
	.($wheres ? " WHERE " . implode( " AND ", $wheres ) : "" )
	);
	$total = $database->loadResult();

	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$query = "SELECT a.*, u.name AS user_from FROM #__messages a"
	." INNER JOIN #__users u ON u.id = a.user_id_from"
	.($wheres ? " WHERE ".implode( " AND ", $wheres ) : "" )
	." ORDER BY a.date_time DESC";
	$database->setQuery( $query, '#__', $pageNav->limit, $pageNav->limitstart );
	
	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	HTML_messages::showMessages( $rows, $pageNav, $search, $option );
}


/***************************/
/* PREPARE TO VIEW MESSAGE */
/***************************/
function viewMessage( $uid='0' ) {
	global $database, $my, $acl;

	$row = null;
	$query = "SELECT a.*, u.name AS user_from FROM #__messages a"
	."\n INNER JOIN #__users u ON u.id = a.user_id_from"
	."\n WHERE a.message_id='".$uid."' AND a.user_id_to='".$my->id."'"
	."\n ORDER BY a.date_time DESC";
	$database->setQuery($query, '#__', 1, 0);
	$database->loadObject( $row );

	if ($row) {
		$database->setQuery( "UPDATE #__messages SET state='1' WHERE message_id='$uid'" );
		$database->query();
	}
	HTML_messages::viewMessage( $row );
}


/*******************/
/* DELETE MESSAGES */
/*******************/
function removeMessage( $cid ) {
	global $database, $adminLanguage, $mosConfig_list_limit;

	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_CMP_CNT_SELIDEL ."\"); window.history.go(-1);</script>\n";
		exit();
	}
	if (count( $cid )) {
		$cids = implode( ',', $cid );
		$database->setQuery( "DELETE FROM #__messages WHERE message_id IN ($cids)" );
		if (!$database->query()) {
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
			exit();
		}
	}

	$limit = intval( mosGetParam( $_REQUEST, 'limit', $mosConfig_list_limit ) );
	$limitstart	= intval( mosGetParam( $_REQUEST, 'limitstart', 0 ) );
	mosRedirect( 'index2.php?option=com_messages&limit='.$limit.'&limitstart='.$limitstart );
}

?>