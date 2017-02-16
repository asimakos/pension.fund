<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Syndicate
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


// ensure user has access to this function
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' ) | 
    $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_syndicate' ) | 
    $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_contact' ))) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );


switch ($task) {
	case 'save':
		saveSyndicate( $option );
	break;
	case 'cancel':
		cancelSyndicate();
	break;
	default:
		showSyndicate( $option );
	break;
}


/*******************************************/
/* PREPARE TO DISPLAY SYNDICATION SETTINGS */
/*******************************************/
function showSyndicate( $option ) {
	global $database, $mainframe, $mosConfig_list_limit;

	$database->setQuery( "SELECT id FROM #__components WHERE name = 'Syndicate'", '#__', 1, 0 );
	$id = $database->loadResult();

	$row = new mosComponent( $database );
	$row->load( $id );

	//get params definitions
	$params = new mosParameters( $row->params, $mainframe->getPath( 'com_xml', $row->option ), 'component' );

	HTML_syndicate::settings( $option, $params, $id );
}


/*****************************/
/* SAVE SYNDICATION SETTINGS */
/*****************************/
function saveSyndicate( $option ) {
	global $database, $adminLanguage, $mainframe;

	$params = mosGetParam( $_POST, 'params', '' );
	if (is_array( $params )) {
	    $txt = array();
	    foreach ($params as $k=>$v) {
	        $txt[] = "$k=$v";
		}
		$_POST['params'] = mosParameters::textareaHandling( $txt );
	}

	$id = mosGetParam( $_POST, 'id', '17' );
	$row = new mosComponent( $database );
	$row->load( $id );

	if (!$row->bind( $_POST )) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()." ".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}

	if (!$row->check()) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()." ".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}
	if (!$row->store()) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()." ".$row->getError()."'); window.history.go(-1);</script>\n";
		exit();
	}

	mosRedirect( 'index2.php?option='.$option, $adminLanguage->A_SETTSUCSAVED );
}


/***************************/
/* CANCEL EDIT SYNDICATION */
/***************************/
function cancelSyndicate() {
	mosRedirect( 'index2.php' );
}
?>