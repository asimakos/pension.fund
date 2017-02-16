<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org All rights reserved
* @package: Elxis
* @subpackage: Component Menus
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Creates a menu item to a system URL
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class system_menu {

	/****************************************/
	/* PREPARE TO ADD/EDIT SYSTEM MENU ITEM */
	/****************************************/
	static public function edit( &$uid, $menutype, $option ) {
		global $database, $my, $mainframe, $mosConfig_absolute_path, $adminLanguage;

		$menu = new mosMenu( $database );
		$menu->load( $uid );

		//fail if checked out not by 'me'
		if ($menu->checked_out && $menu->checked_out <> $my->id) {
			echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_CMP_MU_THMOD.' '.$menu.' '.$adminLanguage->A_ISCEDITANADM."'); document.location.href='index2.php?option=$option'</script>\n";
			exit();
		}

		$systemLinks = system_menu::getsysLinks();
		if ($uid) {
			$menu->checkout( $my->id );
			$lists['shortlink'] = $menu->link;
			foreach ($systemLinks as $sLink) {
				if ($sLink[1] == $menu->link) {
					$lists['shortlink'] = '<strong>'.$sLink[0].'</strong><br />'.$menu->link;
					break;
				}
			}
		} else {
			$menu->type = 'system';
			$menu->menutype = $menutype;
			$menu->browserNav = 0;
			$menu->ordering = 9999;
			$menu->parent = intval( mosGetParam( $_POST, 'parent', 0 ) );
			$menu->published = '1';
			$menu->language = '';

			//build html select list for system link
			$mitems[] = mosHTML::makeOption( '', $adminLanguage->A_CMP_MU_SELLINK);
			foreach ($systemLinks as $key => $val) {
				$mitems[] = mosHTML::makeOption( $key, $val[0] );
			}
			$lists['shortlink'] = mosHTML::selectList( $mitems, 'shortlink', 'class="selectbox" size="1" onchange="javascript:makesyslink();"', 'value', 'text', '' );
		}

		//build the html select list for ordering
		$lists['ordering'] 	= mosAdminMenus::Ordering( $menu, $uid );
		//build the html select list for the group access
		$lists['access'] 	= mosAdminMenus::Access( $menu );
		//build the html select list for paraent item
		$lists['parent'] 	= mosAdminMenus::Parent( $menu );
		//build published button option
		$lists['published'] = mosAdminMenus::Published( $menu );
	    //build the html multiple select list for language selection
	    $lists['languages']	= mosAdminMenus::SelectLanguages( 'languages', $menu->language, $adminLanguage->A_ALL_LANGS );

		//get params definitions
		$params = new mosParameters( $menu->params, $mainframe->getPath( 'menu_xml', $menu->type ), 'menu' );

		system_menu_html::edit( $menu, $lists, $params, $option, $systemLinks );
	}


	/********************/
	/* GET SYSTEM LINKS */
	/********************/
	static private function getsysLinks() {
		global $adminLanguage;

		//component registration
		$syslinks['lostPassword'] = array($adminLanguage->A_CMP_MU_PASSR, 'index.php?option=com_registration&task=lostPassword');
		$syslinks['register'] = array($adminLanguage->A_CMP_MU_UREG, 'index.php?option=com_registration&task=register');
		$syslinks['saveRegistration'] = array($adminLanguage->A_CMP_MU_REGCOMP, 'index.php?option=com_registration&task=saveRegistration');
		$syslinks['activate'] = array($adminLanguage->A_CMP_MU_ACCACT, 'index.php?option=com_registration&task=activate');
		//login
		$syslinks['login'] = array($adminLanguage->A_LOGIN, 'index.php?option=com_login');
		//user features
		$syslinks['UserDetails'] = array($adminLanguage->A_CMP_MU_EDPROF, 'index.php?option=com_user&task=UserDetails');
		$syslinks['subcontent'] = array($adminLanguage->A_SUB_CONTENT, 'index.php?option=com_content&task=subcontent');
		$syslinks['subwebLink'] = array($adminLanguage->A_CMP_MU_SUBWEBL, 'index.php?option=com_weblinks&task=new');
		$syslinks['checkin'] = array($adminLanguage->A_CMP_MU_CHECKIN, 'index.php?option=com_user&task=CheckIn');
		$syslinks['userslist'] = array($adminLanguage->A_CMP_MU_USERLIST, 'index.php?option=com_user&task=list');
		//polls
		$syslinks['polls'] = array($adminLanguage->A_CMP_MU_POLLS, 'index.php?option=com_poll');
		//contacts
		$syslinks['contacts'] = array($adminLanguage->A_CONTACT, 'index.php?option=com_contact');
		//content
		$syslinks['vote'] = array($adminLanguage->A_VOTE, 'index.php?option=com_content&task=vote');
		return $syslinks;
	}

}
?>