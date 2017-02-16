<?php 
/**
* @version: $Id: content_blog_category.class.php 2527 2009-09-29 10:55:48Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Menus
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Creates a menu item that links to a blog category
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class content_blog_category {

	/*********************************/
	/* PREPARE TO ADD/EDIT MENU ITEM */
	/*********************************/
	static public function edit( &$uid, $menutype, $option ) {
		global $database, $my, $mainframe, $adminLanguage;

		$menu = new mosMenu( $database );
		$menu->load( $uid );

		//fail if checked out not by 'me'
		if ($menu->checked_out && $menu->checked_out <> $my->id) {
			echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_CMP_MU_THMOD.' '.$menu.' '.$adminLanguage->A_ISCEDITANADM."'); document.location.href='index2.php?option=$option'</script>\n";
			exit();
		}

		$pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;
		$ora = (in_array($database->_resource->databaseType, array('oci8', 'oci8po', 'oci805', 'oracle'))) ? 1 : 0;
		if ($pg) {
			$scol = 's.id::VARCHAR';
		} else if ($ora) {
			$scol = 'TO_CHAR(s.id)';	
		} else {
			$scol = 's.id';
		}

		if ($uid) {
			$menu->checkout( $my->id );
			//get previously selected Categories
			$params = new mosParameters( $menu->params );
			$catids = $params->def( 'categoryid', '' );
			if ( $catids ) {
				$query = "SELECT c.id AS value, c.section AS id, ".$database->_resource->Concat( 's.title', '\' / \'', 'c.title')." AS text"
				. "\n FROM #__sections s"
				. "\n INNER JOIN #__categories c ON c.section = ".$scol
				. "\n WHERE s.scope = 'content'"
				. "\n AND c.id IN (".$catids.")"
				. "\n ORDER BY s.name, c.name";
				$database->setQuery( $query );
				$lookup = $database->loadObjectList();
			} else {
				$lookup 		= '';
			}
		} else {
			$menu->type 		= 'content_blog_category';
			$menu->menutype 	= $menutype;
			$menu->ordering 	= 9999;
			$menu->parent 		= intval( mosGetParam( $_POST, 'parent', 0 ) );
			$menu->published 	= 1;
			$lookup 			= '';
			$menu->language 	= null;
		}

		//build the html select list for category
		$rows[] = mosHTML::makeOption( '', $adminLanguage->A_ALL_CATEGORIES2 );
		$query = "SELECT c.id AS value, c.section AS id, ".$database->_resource->Concat( 's.title', '\' / \'', 'c.title')." AS text"
		. "\n FROM #__sections s"
		. "\n INNER JOIN #__categories c ON c.section = ".$scol
		. "\n WHERE s.scope = 'content'"
		. "\n ORDER BY s.name, c.name";
		$database->setQuery( $query );
		$rows = array_merge($rows, $database->loadObjectList());
		$category = mosHTML::selectList( $rows, 'catid[]', 'class="selectbox" size="10" multiple="multiple"', 'value', 'text', $lookup );
		$lists['categoryid']= $category;

		//build the html select list for ordering
		$lists['ordering'] 	= mosAdminMenus::Ordering( $menu, $uid );
		//build the html select list for the group access
		$lists['access'] 	= mosAdminMenus::Access( $menu );
		//build the html select list for paraent item
		$lists['parent'] 	= mosAdminMenus::Parent( $menu );
		//build published button option
		$lists['published'] = mosAdminMenus::Published( $menu );
		//build the url link output
		$lists['link'] 		= mosAdminMenus::Link( $menu, $uid );
        //build the html multiple select list for language selection
        $lists['languages']	= mosAdminMenus::SelectLanguages( 'languages', $menu->language, $adminLanguage->A_ALL_LANGS );

		//get params definitions
		$params = new mosParameters( $menu->params, $mainframe->getPath( 'menu_xml', $menu->type ), 'menu' );

		/* chipjack: passing $sectCatList (categories) instead of $slist (sections) */
		content_blog_category_html::edit( $menu, $lists, $params, $option );
	}


    /******************/
    /* SAVE MENU ITEM */
    /******************/
	static public function saveMenu( $option, $task ) {
		global $database, $adminLanguage;

		$params = mosGetParam( $_POST, 'params', '' );
		$catids	= mosGetParam( $_POST, 'catid', array() );
		$catid	= implode( ',', $catids );

        foreach ($_POST['languages'] as $xlang) {
    	   if (trim($xlang) == '') { $newlangs = ''; }
        }
        if (!isset($newlangs)) {
        	$newlangs = implode(',', $_POST['languages']);
        }
        $_POST['language'] = $newlangs;

		$params[categoryid]	= $catid;
		if (is_array( $params )) {
		    $txt = array();
		    foreach ($params as $k=>$v) {
			   $txt[] = "$k=$v";
			}
			$_POST['params'] = mosParameters::textareaHandling( $txt );
		}

		$row = new mosMenu( $database );

		if (!$row->bind( $_POST )) {
			echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}

		if (count($catids)==1 && $catids[0]!="") {
			$row->link = eUTF::utf8_str_replace("id=0","id=".$catids[0],$row->link);
			$row->componentid = $catids[0];
		}

		if (!$row->check()) {
			echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}
		if (!$row->store()) {
			echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}
		$row->checkin();
		$row->updateOrder( "menutype='$row->menutype' AND parent='$row->parent'" );

		$msg = $adminLanguage->A_CMP_MU_MSGITSAV;
		switch ( $task ) {
			case 'apply':
				mosRedirect( 'index2.php?option='.$option.'&menutype='.$row->menutype.'&task=edit&id='.$row->id, $msg );
			break;
			case 'save':
			default:
				mosRedirect( 'index2.php?option='.$option.'&menutype='.$row->menutype, $msg );
			break;
		}
	}
} 
?>