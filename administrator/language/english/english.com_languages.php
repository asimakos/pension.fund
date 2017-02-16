<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ioannis Sannos
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: English language for component languages
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_LNG_EDSR = 'edit source';
public $A_CMP_LNG_PLNG = 'Published Language';
public $A_CMP_LNG_UNPLNG = 'Unpublished Language';
public $A_CMP_LNG_DEFLNG = 'Default Language';
public $A_CMP_LNG_EDITOR = 'Language Editor';
public $A_CMP_LNG_THE = 'File '; //'The' file... in Greek, German etc
public $A_CMP_LNG_MADF = 'Selected language is already the default language!';
public $A_CMP_LNG_NMADF = 'You can not make default a non-published language!';
public $A_CMP_LNG_LAPUB = 'This language is already published!';
public $A_CMP_LNG_UNPDEF = 'You cannot unpublish the default language!';
public $A_CMP_LNG_ANPDEF = 'Selected language is already unpublished!';
public $A_CMP_LNG_CANNOT = 'You can not delete language in use.';
public $A_CMP_LNG_OPFLED = 'Operation failed: No language specified.';
public $A_CMP_LNG_UPDATED = 'Configuration successfully updated!';
public $A_CMP_LNG_MSURE = '<strong>Error!</strong> Make sure that configuration.php is writeable.';
public $A_CMP_LNG_REMENG = 'You can not remove English language';
public $A_CMP_LNG_NTOPEN = 'Operation Failed: Could not open';
public $A_CMP_LNG_FLDEMP = 'Operation failed: Content empty.';
public $A_CMP_LNG_FLDNOT = 'Operation failed: The file is not writable.';
public $A_CMP_LNG_FLDWRT = 'Operation failed: Failed to open file for writing.';
public $A_CMP_LNG_FLAG = 'Flag';

}

?>
