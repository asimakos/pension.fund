<?php 
/**
* @ Version: $I$
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Module Toolbar
* @ Author: Elxis Team
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


require_once( $mosConfig_absolute_path.'/administrator/includes/menubar.html.php' );

if ($path = $mainframe->getPath( "toolbar" )) {
	include_once( $path );
}
?>