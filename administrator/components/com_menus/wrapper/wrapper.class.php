<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org All rights reserved
* @package: Elxis
* @subpackage: Component Menus
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Creates a menu item to display a wrapped page
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class wrapper_menu {


    /****************************/
    /* PREPARE TO ADD/EDIT ITEM */
    /****************************/
	static public function edit( &$uid, $menutype, $option ) {
		global $database, $my, $mainframe, $adminLanguage;

		$menu = new mosMenu( $database );
		$menu->load( $uid );

		//fail if checked out not by 'me'
		if ($menu->checked_out && $menu->checked_out <> $my->id) {
			echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_CMP_MU_THMOD.' '.$menu.' '.$adminLanguage->A_ISCEDITANADM."'); document.location.href='index2.php?option=$option'</script>"._LEND;
			exit();
		}
		if ( $uid ) {
			$menu->checkout( $my->id );
		} else {
			$menu->type = 'wrapper';
			$menu->menutype = $menutype;
			$menu->ordering = 9999;
			$menu->parent = intval( mosGetParam( $_POST, 'parent', 0 ) );
			$menu->published = 1;
			$menu->link = 'index.php?option=com_wrapper';
			$menu->language = null;
		}

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
		if ( $uid ) {
			$menu->url = $params->def( 'url', '' );
		}
		wrapper_menu_html::edit( $menu, $lists, $params, $option );
	}


    /*************/
    /* SAVE ITEM */
    /*************/
	static public function saveMenu( $option, $task ) {
		global $database, $adminLanguage, $mainframe;

		$params = mosGetParam( $_POST, 'params', '' );
		$params[url] = mosGetParam( $_POST, 'url', '' );

		if (is_array( $params )) {
		    $txt = array();
		    foreach ($params as $k=>$v) {
			   $txt[] = "$k=$v";
			}
 			$_POST['params'] = mosParameters::textareaHandling( $txt );
		}

	    foreach ($_POST['languages'] as $xlang) {
	    	if (trim($xlang) == '') { $newlangs = ''; }
	    }
	    if (!isset($newlangs)) {
	    	$newlangs = implode(',', $_POST['languages']);
	    }
	    $_POST['language'] = $newlangs;

		$row = new mosMenu( $database );

		if (!$row->bind( $_POST )) {
			echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>"._LEND;
			exit();
		}

        require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
        $seo = new seovs('com_wrapper', '', $row->seotitle);
        $seo->Itemid = intval($row->id);
        $seoval = $seo->validate();
        if (!$seoval) {
			echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_SEOTITLE.': '.$seo->message."'); window.history.go(-1);</script>"._LEND;
			exit();
        }

		if (!$row->check()) {
			echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>"._LEND;
			exit();
		}

		if (!$row->store()) {
			echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>"._LEND;
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


    /*********************/
    /* SUGGEST SEO TITLE */
    /*********************/
    static public function suggest() {
        global $mainframe;

        $coid = intval(mosGetParam($_POST, 'coid', 0));
        $cotitle = mosGetParam($_POST, 'cotitle', '');

        require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
        $seo = new seovs('com_wrapper', $cotitle);
        $seo->Itemid = $coid;
        $sname = $seo->suggest();

        @ob_end_clean();
        @header('Content-Type: text/plain; Charset: utf-8');
        if ($sname) {
            echo '|1|'.$sname;
        } else {
            echo '|0|'.$seo->message;
        }
        exit();
    }


    /**********************/
    /* VALIDATE SEO TITLE */
    /**********************/
    static public function validate() {
        global $mainframe;

        $coid = intval(mosGetParam($_POST, 'coid', 0));    
        $costitle = eUTF::utf8_trim(mosGetParam($_POST, 'costitle', ''));

        require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
        $seo = new seovs('com_wrapper', '', $costitle);
        $seo->Itemid = $coid;
        $seo->validate();
        echo $seo->message;
        exit();
    }

}

?>