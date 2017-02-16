<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: PARACOM Software
* @link: http://www.elxis.cz
* @email: info@elxis.cz
* @description: Czech language for component weblinks
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_WBL_MANAGER = 'Weblinks Manager';
public $A_CMP_WBL_APPROVED = 'Approved';
public $A_CMP_WBL_MUSTTITLE = 'Weblink item must have a title';
public $A_CMP_WBL_MUSTCATEG = 'You must select a category.';
public $A_CMP_WBL_YMHURL = 'You must have a URL.';
public $A_CMP_WBL_WEBLNK = 'Weblink';
public $A_CMP_WBL_MUSTURL = 'Screenshot';
public $A_CMP_WBL_SSHOTDESC = 'Use only if there is no available screenshot on the Internet for this link.';
public $A_CMP_WBL_EDITCAT = 'Edit Category';
public $A_CMP_WBL_EDITWL = 'Edit Weblinks';
public $A_CMP_WBL_SCRNO = 'Don\'t show screenshot';
public $A_CMP_WBL_SCRLOC = 'Use a local image';
public $A_CMP_WBL_SCRINT = 'Load new image from Internet';
public $A_CMP_WBL_COPYDESC = "Click the following buttons to get weblink screenshots from the available web sources. 
	If this option is enabled, after saving, the weblink's screenshot will be copied to your screenshots (images/screenshots/) directory.";
public $A_CMP_WBL_SCRRECFROM = 'Screenshot received from';
public $A_CMP_WBL_INVSOURCE = 'Detected invalid source';
public $A_CMP_WBL_INVURL = 'Detected invalid weblink URL';
public $A_CMP_WBL_DIRNOWRITE = 'Directory images/screenshots/ is not writable. Screenshot can not be saved!';
public $A_CMP_WBL_NOTCLICKED = 'You haven\'t clicked anything yet';

}

?>