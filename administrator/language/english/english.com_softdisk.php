<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ioannis Sannos
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: English language for component softdisk
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CORE = 'Core';
public $A_ASTATS = 'Administration Statistics';
public $A_VALUE = 'Value';
public $A_LASTMOD = 'Last modified';
public $A_OS = 'Operating System';
public $A_ELXIS_VERSION = 'Elxis version';
public $A_SELECT = 'Select';
public $NOEDITSYS = 'You are not allowed to edit system entries';
public $A_RESTORE = 'Restore';
public $SOFTDISK_HELP = 'SoftDisk is a virtual storage area for variables and parameters of any kind.<br />
  	You can add new or edit/delete existing SoftDisk\'s entries except the ones labeled as owned by the system. 
	Also entries marked as "Undeletable" can only be edited. For naming SoftDisk\'s sections and value names 
	you are only allowed to use <strong>capital latin letters, digits and underscore (_)</strong>.';
public $YCNOTEDITP = 'You can not edit parameter';
public $UNDELETABLE = 'Undeletable';
public $SOFTENTRYEXIST = 'There is already a SoftDisk entry with that name!';
public $INVSECTNAME = 'Invalid section name!';
public $INVNAME = 'Invalid name!';
public $INVEMAIL = 'Supplied value is not a valid email address!';
public $INVURL = 'Supplied value is not a valid URL!';
public $INVDEC = 'Supplied value is not a decimal number!';
public $INVTSTAMP = 'Supplied value is not a valid UNIX timestamp!';
public $UPSYSTEM = 'Update system';
public $A_USERPROFILE = 'User profile';
public $UPROF_WEBSITE = 'Website';
public $UPROF_AIM = 'AIM';
public $UPROF_YIM = 'YIM';
public $UPROF_MSN = 'MSN';
public $UPROF_ICQ = 'ICQ';
public $UPROF_EMAIL = 'E-mail';
public $UPROF_PHONE = 'Phone';
public $UPROF_MOBILE = 'Cell phone';
public $UPROF_BIRTHDATE = 'Birth date';
public $UPROF_GENDER = 'Gender';
public $UPROF_LOCATION = 'Location';
public $UPROF_OCCUPATION = 'Occupation';
public $UPROF_SIGNATURE = 'Signature';
public $UPROF_ARTICLES = 'Number of articles';
public $UPROF_USERGROUP = 'User group';
public $UPROF_RANDUSERS = 'Display random users in profile page';
public $USERS_RPASSMAIL = 'Notify administrators on password remind submition';
public $SUBMIT_CATEGORIES = 'Categories that is allowed content submission (suggested). If empty all are allowed. (Categories IDs, comma separated)';
public $SUBMIT_SECTIONS = 'Sections that is allowed content submission (suggested). If empty all are allowed. (Sections IDs, comma separated)';
public $REG_AGREE = 'Registration agreement autonomous page ID. Zero (0) to disable. For language specific agreement create a SoftDisk entry at section USERS for each language named REG_AGREE_LANGUAGE-HERE of type Integer';
public $A_WEBLINKS = 'Weblinks';
public $TOP_WEBLINK = 'Controls the display or not, of the module Top Weblinks inside component weblinks';
public $A_USERSLIST = 'Users list';
public $ULIST_ONLINE = 'Online status';
public $ULIST_USERNAME = 'Username';
public $ULIST_NAME = 'Name';
public $ULIST_REGDATE = 'Registration date';
public $ULIST_PREFLANG = 'Preferable language';
public $STATICCACHE = 'Static cache';

}

?>