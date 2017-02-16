<?php 
/**
* @version: $Id: toolbar.media.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Media
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_media {

	static public function _DEFAULT() {
		global $adminLanguage;
		mosMenuBar::startTable();
		//mosMenuBar::custom('upload','upload.png','upload_f2.png',$adminLanguage->A_UPLOAD, false);
		//mosMenuBar::spacer();
		//mosMenuBar::custom('newdir','new.png','new_f2.png',$adminLanguage->A_CREATE, false);
		//mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.mediamanager' );
                mosMenuBar::spacer();
                mosMenuBar::wiki( 'Media_Manager' );
		mosMenuBar::endTable();
	}
}

?>
