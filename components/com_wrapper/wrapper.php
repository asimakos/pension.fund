<?php 
/** 
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Wrapper
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
	    $acl->acl_check( 'action', 'view', 'users', $usertype, 'components', 'com_wrapper' ))) {
		mosRedirect( 'index.php', _NOT_AUTH );
	}
}

require_once($mainframe->getPath('front_html'));


/***************************/
/* PREPARE TO SHOW WRAPPER */
/***************************/
function showWrap() {
	global $database, $Itemid, $mainframe, $my, $lang;

    $query = "SELECT COUNT(id) FROM #__menu WHERE id='".$Itemid."' AND published='1' AND access IN (".$my->allowed.")"
    ."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%')) AND type='wrapper'";
    $database->setQuery($query);
    $counter = intval($database->loadResult());
    if (!$counter) {
        elxError(_PAGE_NOFOUND, 1);
        return;
    }

	$menu = new mosMenu( $database );
	$menu->load( $Itemid );

	$params = new mosParameters( $menu->params );
	$params->def( 'back_button', $mainframe->getCfg('back_button'));
	$params->def( 'scrolling', 'auto' );
	$params->def( 'page_title', '1' );
	$params->def( 'pageclass_sfx', '' );
	$params->def( 'header', $menu->name );
	$params->def( 'height', '500' );
	$params->def( 'height_auto', '1' );
	$params->def( 'width', '100%' );
	$params->def( 'add', '1' );
	$url = $params->def('url', '');

    $row = array();
	if ( $params->get( 'add' ) ) {
		// adds 'http://' if none is set	
		if ( !strstr( $url, 'http' ) && !strstr( $url, 'https' ) ) {
			$row['url'] = 'http://'. $url;
		} else {
			$row['url'] = $url;
		}
	} else {
		$row['url'] = $url;
	}

	// auto height control
	if ( $params->def( 'height_auto' ) ) {
		$row['load'] = 'window.onload = iFrameHeight;';
	} else {
		$row['load'] = '';
	}

    $mainframe->setPageTitle($menu->name);
    $mainframe->setMetaTag('description', $params->get('header').', '.$mainframe->getCfg('sitename'));
	HTML_wrapper::displayWrap( $row, $params, $menu );
}

showWrap();

?>