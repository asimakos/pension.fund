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
* @description: English language for component users
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_USS_LOGIN = 'Logged In';
public $A_CMP_USS_ALL = 'All';
public $A_CMP_USS_ID = 'UserID';
public $A_CMP_USS_LSTV = 'Last Visit';
public $A_CMP_USS_ENBLD = 'Enabled';
public $A_CMP_USS_BLCKD = 'Blocked';
public $A_CMP_USS_LVDATE = '%Y-%m-%d %H:%M:%S'; //Last visit Date
public $A_CMP_USS_PFISNOT = 'Please Select another group, as \'Public Frontend\' is not a selectable option';
public $A_CMP_USS_PBISNOT = 'Please Select another group, as \'Public Backend\' is not a selectable option';
public $A_CMP_USS_DETAILS = 'User Details';
public $A_CMP_USS_EMAIL = 'Email';
public $A_CMP_USS_PASS = 'New Password';
public $A_CMP_USS_VERIFY = 'Verify Password';
public $A_CMP_USS_BLOCK = 'Block User';
public $A_CMP_USS_SUBMI = 'Receive Submission Emails';
public $A_CMP_USS_REGDATE = 'Register Date';
public $A_CMP_USS_VISDTE = 'Last Visit Date';
public $A_CMP_USS_CONTCT = 'Contact Information';
public $A_CMP_USS_NDETL = 'No Contact details linked to this User:<br />See \'Components -> Contact -> Manage Contacts\' for details.';
public $A_CMP_USS_SUCCH = 'Successfully Saved changes to User';
public $A_CMP_USS_SUCUSR = 'Successfully Saved User';
public $A_CMP_USS_CANNOT = 'You cannot delete a Super Administrator';
public $A_CMP_USS_CANNYO = 'You cannot delete Yourself!';
public $A_CMP_USS_CANNUS = 'You are not allowed to delete this user';
public $A_CMP_USS_SLUSER = 'Please select a user';
public $A_CMP_USS_FLGOUT = 'Force Logout';
public $A_CMP_USS_UMUST = 'You must provide a user login name.';
public $A_CMP_USS_ULOGIN = 'Your login name contains invalid characters or is too short.';
public $A_CMP_USS_MSTEMAIL = 'You must provide an email address.';
public $A_CMP_USS_ASSIGN = 'You must assign user to a group.';
public $A_CMP_USS_NOMATC = 'Passwords do not match.';
public $A_CMP_USS_FLOGD = 'Filter Logged';
public $A_CMP_USS_FACST = 'Filter Active';
public $A_CMP_USS_PHONE = 'Telephone';
public $A_CMP_USS_FAX = 'Fax';
public $A_CMP_USS_NOEXTRA = 'No Extra User Fields have been set or published';
public $A_CMP_USS_VERTICAL = 'Vertical';
public $A_CMP_USS_HORIZONT = 'Horizontal';
public $A_CMP_USS_CHECKED = 'checked';
public $A_CMP_USS_1OPTVLEAST = 'At least one option and a valid selected option must be given';
public $A_CMP_USS_1OPTLEAST = 'At least one option must be given';
public $A_CMP_USS_EXTRASAVED = 'Extra Field saved successfully';
public $A_CMP_USS_CHACONDET = 'change Contact Details';
public $A_CMP_USS_REQUIRED = 'Required';
public $A_CMP_USS_REGISTR = 'Registration';
public $A_CMP_USS_PROFILE = 'Profile';
public $A_CMP_USS_RONLY = 'Read Only';
public $A_CMP_USS_HIDDEN = 'Hidden';
public $A_CMP_USS_SHOWREG = 'Show in Registration';
public $A_CMP_USS_SHOWPROF = 'Show in Profile';
public $A_CMP_USS_OPTALIGN = 'Options Alignment';
public $A_CMP_USS_PREVNOTE = 'Note: You must save your changes to see the new preview.';
public $A_CMP_USS_OPTIONS = 'Options';
public $A_CMP_USS_OPTIONSFOR = 'Options for';
public $A_CMP_USS_MUSTFNAME = 'You must give the field a name';
public $A_CMP_USS_MAXLENINV = 'Field max length value is invalid';
public $A_CMP_USS_HIDMUSTVAL = 'A hidden field must have a value!';
public $A_CMP_USS_DEFVAL = 'Default value';
public $A_CMP_USS_MAXLEN = 'Max length';
public $A_CMP_USS_REQFLDSNO = 'One or more required fields have not been filled in!';
public $A_CMP_USS_HIDNOREQ = 'A hidden field can not be required!';
public $A_CMP_USS_HIDNOPROF = 'A hidden field can not be shown in profile!';
//2008
public $A_CMP_USS_PREFLANG = 'Preferable language';
public $A_CMP_USS_AVATAR = 'Avatar';
public $A_CMP_USS_WEBSITE = 'Website';
public $A_CMP_USS_AIM = 'AIM';
public $A_CMP_USS_YIM = 'YIM';
public $A_CMP_USS_MSN = 'MSN';
public $A_CMP_USS_ICQ = 'ICQ';
public $A_CMP_USS_MOBILE = 'Cell phone';
public $A_CMP_USS_BIRTHDATE = 'Birth date';
public $A_CMP_USS_GENDER = 'Gender';
public $A_CMP_USS_LOCATION = 'Location';
public $A_CMP_USS_OCCUPATION = 'Occupation';
public $A_CMP_USS_SIGNATURE = 'Signature';
public $A_CMP_USS_MALE = 'Male';
public $A_CMP_USS_FEMALE = 'Female';
public $A_CMP_USS_YEAR = 'Year';
public $A_CMP_USS_MONTH = 'Month';
public $A_CMP_USS_DAY = 'Day';
public $A_CMP_USS_BOLDINDIC = 'Elements in bold are enabled in users profile.';
public $A_CMP_USS_ENDISSOFT = 'You can enable/disable profile elements from SoftDisk.';
//2009
public $A_USERS_EXPDATE = 'Expiration date';
public $A_USERS_ACCEXPIRED = 'Account expired';
public $A_USERS_ACCNACTIVE = 'Account active';

}

?>