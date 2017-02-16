<?php 
/**
* @ Version: $Id: toolbar.poll.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Component Poll
* @ Author: Elxis Team
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


require_once( $mainframe->getPath( 'toolbar_html' ) );

switch ($task) {
	case 'new':
		TOOLBAR_poll::_NEW();
		break;

	case 'edit':
		$cid = mosGetParam( $_REQUEST, 'cid', array(0) );
		if (!is_array( $cid )) {
			$cid = array(0);
		}

		$database->setQuery( "SELECT published FROM #__polls WHERE id='$cid[0]'" );
		$published = $database->loadResult();

		$cur_template = $mainframe->getTemplate();
		
		TOOLBAR_poll::_EDIT( $cid[0], $cur_template );
		break;

	case 'editA':
		$id = mosGetParam( $_REQUEST, 'id', 0 );
		
		$database->setQuery( "SELECT published FROM #__polls WHERE id='$id'" );
		$published = $database->loadResult();

		$cur_template = $mainframe->getTemplate();
		
		TOOLBAR_poll::_EDIT( $id, $cur_template );
		break;

	default:
		TOOLBAR_poll::_DEFAULT();
		break;
}
?>