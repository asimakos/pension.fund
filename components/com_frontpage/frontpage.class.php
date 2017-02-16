<?php 
/**
* @ Version: $Id: frontpage.class.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Frontpage
* @ Author: Elxis Team
* @ E-mail: info@elxis.org
* @ URL: http://www.elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class mosFrontPage extends mosDBTable {

	public $content_id=null;
	public $ordering=null;


	function mosFrontPage( &$db ) {
		$this->mosDBTable( '#__content_frontpage', 'content_id', $db );
	}
}

?>