<?php 
/** 
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Login
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $database, $Itemid, $my, $mainframe, $lang;

if (($mainframe->getCfg('access') == '1') | ($mainframe->getCfg('access') == '3')) {
	//if is a guest find public frontend group name
	if ( $my->usertype == '' ) { 
		$usertype = eUTF::utf8_strtolower($acl->get_group_name('29'));
	} else {
		$usertype = eUTF::utf8_strtolower($my->usertype);
	}
	// ensure user is allowed to view this component
	if (!($acl->acl_check( 'action', 'view', 'users', $usertype, 'components', 'all' ) || 
		$acl->acl_check( 'action', 'view', 'users', $usertype, 'components', 'com_login' ))) {
		mosRedirect( 'index.php', _NOT_AUTH );
		exit();
	}
}

require_once($mainframe->getPath('front_html'));

//check if you have a valid Itemid
$_Itemid = intval($Itemid);
$itemok = 0;
if ($_Itemid) {
    $database->setQuery("SELECT COUNT(id) FROM #__menu WHERE id='$_Itemid' AND link = 'index.php?option=com_login' AND published='1'");
    $itemok = intval($database->loadResult()) ? 1 : 0;
}

//if invalid try to find a valid one
if (!$itemok) {
    $where = ($mainframe->getCfg('shownoauth')) ? '' : "\n AND access IN (".$my->allowed.")";
    $query = "SELECT id FROM #__menu WHERE link = 'index.php?option=com_login' AND published='1'"
	."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
    .$where;
    $database->setQuery($query, '#__', 1, 0);
    $_Itemid2 = intval($database->loadResult());
    if ($_Itemid2) {
        $_Itemid = $_Itemid2;
        $itemok = 1;
    }
}

$menu = new mosMenu( $database );
$menu->load( $_Itemid );
$params = new mosParameters( $menu->params );

$params->def( 'page_title', 1 );

if (!$itemok) {
    $params->def( 'header_login', _BUTTON_LOGIN );
    $params->def( 'header_logout', _BUTTON_LOGOUT );
} else {
    $params->def( 'header_login', $menu->name );
    $params->def( 'header_logout', $menu->name );
}

$params->def( 'pageclass_sfx', '' );
$params->def( 'back_button', $mainframe->getCfg( 'back_button' ) );
$params->def( 'login', $mainframe->getCfg('live_site'));
$params->def( 'logout', $mainframe->getCfg('live_site'));
$params->def( 'login_message', 0 );
$params->def( 'logout_message', 0 );
$params->def( 'description_login', 1 );
$params->def( 'description_logout', 1 );
$params->def( 'description_login_text', _LOGIN_DESCRIPTION );
$params->def( 'description_logout_text', _LOGOUT_DESCRIPTION );
$params->def( 'image_login', 'key.jpg' );
$params->def( 'image_logout', 'key.jpg' );
$params->def( 'image_login_align', 'right' );
$params->def( 'image_logout_align', 'right' );
$params->def( 'registration', $mainframe->getCfg( 'allowUserRegistration' ) );

$image_login = '';
$image_logout = '';
if ( $params->get( 'image_login' ) <> -1 ) {
	$image = $mainframe->getCfg('ssl_live_site').'/images/stories/'.$params->get( 'image_login' );
	$image_login = '<img src="'.$image.'" align="'.$params->get( 'image_login_align' ).'" hspace="10" alt="'._BUTTON_LOGIN.'" title="'._BUTTON_LOGIN.'" />';
}
if ( $params->get( 'image_logout' ) <> -1 ) {
	$image = $mainframe->getCfg('ssl_live_site').'/images/stories/'.$params->get( 'image_logout' );
	$image_logout = '<img src="'.$image.'" align="'.$params->get( 'image_logout_align' ).'" hspace="10" alt="'._BUTTON_LOGOUT.'" title="'._BUTTON_LOGIN.'" />';
}

$keys = array();
$keys[] = _BUTTON_LOGIN;
$keys[] = _BUTTON_LOGOUT;
$keys[] = _USERNAME;
$keys[] = _PASSWORD;
if ($lang != 'english') {
    $keys[] = 'login';
    $keys[] = 'logout';
    $keys[] = 'user';
}

$mainframe->SetMetaTag('keywords', implode(', ',$keys));

if ( $my->id ) {
    $mainframe->setPageTitle($params->get( 'header_logout' ));
    $mainframe->setMetaTag('description', _BUTTON_LOGOUT.' '.$mainframe->getCfg('sitename'));
	loginHTML::logoutpage( $params, $image_logout );
} else {

	if ($mainframe->getCfg('sef') != 2) {
    	$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_registration&task=lostPassword'"
		."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%$lang%'))";
    	$database->setQuery($query, '#__', 1, 0);
    	$Itemidlp = intval($database->loadResult());
		if (!$Itemidlp) { $Itemidlp = $Itemid; }

    	$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_registration&task=register'"
		."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%$lang%'))";
    	$database->setQuery($query, '#__', 1, 0);
    	$Itemidr = intval($database->loadResult());
		if (!$Itemidr) { $Itemidr = $Itemid; }
	} else {
		$Itemidlp = $Itemid;
		$Itemidr = $Itemid;
	}

    $mainframe->setPageTitle($params->get( 'header_login' ));
    $mainframe->setMetaTag('description', _USER_LOGIN.' '.$mainframe->getCfg('sitename'));
	loginHTML::loginpage( $params, $image_login, $Itemidlp, $Itemidr );
}

?>