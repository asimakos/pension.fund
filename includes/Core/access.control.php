<?php 
/**
* @ Version: $Id$
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Access Control System
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @ Author: Ioannis Sannos (datahell@elxis.org)
* @ Notes: Core component access is managed inside components. 
* If requested component is not a core component then access to the component is managed from this file.
* mosConfig_access values= 0: None (no restrictions), 1: Core components, 2: 3rd party components, 3: All components
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


switch ( $mosConfig_access ) {
	case '0':
	case '1':
	break;
	case '2':
	case '3':
		$ac_comps = coreComps();
		$ac_option = getOptName ($option);
		if(!in_array($ac_option, $ac_comps)) {
			if ( $my->usertype == '' ) { 
				$usertype = eUTF::utf8_strtolower($acl->get_group_name('29'));
			} else {
				$usertype = eUTF::utf8_strtolower($my->usertype);
			}
			if (!($acl->acl_check( 'action', 'view', 'users', $usertype, 'components', 'all' ) || 
				$acl->acl_check( 'action', 'view', 'users', $usertype, 'components', $ac_option ))) {
				mosRedirect( $mosConfig_live_site, _NOT_AUTH );
				exit();
			}
		}
	break;
	default:
	die('Access Control System Error!<br>Contact site administrator or Elxis personel for support.');
	break;
}

function getOptName ($option) {
	if (!preg_match('/^(com\_)/', $option)) {
		return 'com_'.$option;
	}
	return $option;
}

function coreComps() {
	$ccomps = array(
		'com_contact',
		'com_content',
		'com_frontpage',
		'com_login',
		'com_messages',
		'com_newsfeeds',
		'com_poll',
		'com_registration',
		'com_search',
		'com_user',
		'com_weblinks',
		'com_wrapper'
	);
	return $ccomps;
}

?>