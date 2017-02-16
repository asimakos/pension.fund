<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component MassMail
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//ensure user has access to this function
if (!($acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'all' ) 
    | $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_massmail' ))) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );

switch ($task) {
	case 'send':
		sendMail();
	break;
	case 'cancel':
		mosRedirect( 'index2.php' );
	break;
	default:
		messageForm( $option );
	break;
}

function messageForm( $option ) {
	global $acl, $adminLanguage;

	$gtree = array( 
        mosHTML::makeOption( 0, $adminLanguage->A_CMP_MM_ALL )
	);

	//get list of groups
	$lists = array();
	$gtree = array_merge( $gtree, $acl->get_group_children_tree( null, 'USERS', false ) );
	$lists['gid'] = mosHTML::selectList( $gtree, 'mm_group', 'class="selectbox" size="10" dir="ltr"', 'value', 'text', 0 );

	HTML_massmail::messageForm( $lists, $option );
}

function sendMail() {
	global $database, $my, $acl, $adminLanguage, $mainframe, $elxis_language;

	$mode = intval(mosGetParam( $_POST, 'mm_mode', 0 ));
	$subject = mosGetParam( $_POST, 'mm_subject', '' );
	$gou = intval(mosGetParam( $_POST, 'mm_group', 0));
	$recurse = mosGetParam( $_POST, 'mm_recurse', 'NO_RECURSE' );

    //pulls message inoformation either in text or html format
	if ( $mode ) {
		$message_body = $_POST['mm_message'];
	} else {
		$message_body = mosGetParam( $_POST, 'mm_message', '' );
	}
	$message_body = stripslashes( $message_body );

	if (!$message_body || !$subject || $gou === null) {
		mosRedirect( "index2.php?option=com_massmail", $adminLanguage->A_CMP_MM_FILL );
	}

    $gwhere = '';
    if ($gou && ($recurse == 'RECURSE')) {
        $to = $acl->get_group_children($gou, 'ARO', $recurse);
        array_push($to, $gou);
        $gwhere = "\n AND gid IN (".implode( ',', $to ).")";
    } else if ($gou) {
        $gwhere = "\n AND gid = '".$gou."'";
    }

	//Get all users email and group except for senders
	$query = "SELECT email FROM #__users WHERE id != '".$my->id."' AND block = '0'"
	.$gwhere;
	$database->setQuery( $query );
	$rows = $database->loadResultArray();

    if ($rows) {
	   //Build e-mail message format
	   $message_header = $adminLanguage->A_CMP_MM_MFROM.' '.$mainframe->getCfg('sitename')._LEND._LEND;
	   $message_header .= $adminLanguage->A_CMP_MM_MESS.': ';
	   $message = $message_header . $message_body;
	   $subject = stripslashes( $subject);

	   //Send email
	   foreach ($rows as $xemail) {
			mosMail($mainframe->getCfg('mailfrom'), $mainframe->getCfg('fromname'), $xemail, $subject, $message, $mode, NULL, NULL, NULL, NULL, NULL, $elxis_language->alang  );
		}
	}

	$msg = $adminLanguage->A_CMP_MM_SENT.' '.count( $rows ).' '.$adminLanguage->A_CMP_MM_USERS;
    mosRedirect( 'index2.php?option=com_massmail', $msg );
}
?>