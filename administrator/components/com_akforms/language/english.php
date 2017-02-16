<?php
/**
* @version: 1.0
* @copyright: Copyright (C) 2009 Andrew Campball. All rights reserved.
* @package: Elxis
* @subpackage: Component AkForms
* @author: Andrej Kmabalov
* @author e-mail: ACampball@yandex.ru
* @description: English language for component AkForms
* @license: GPL
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещен.' );


class akFormLanguage {

	public $COPYRIGHT = "Component <strong>AkForms</strong>. Developer Anrej Kambalov.";

	public $_CHECKED = 'cheked';
	public $_SELECTED = 'select';

	/************************************/
	/* Административная часть           */
	/************************************/
	public $GENERALSETS           = 'General';
	public $CFG_MAXFILESIZE = 'File size';
	public $CFG_MAXFILESIZED = 'Maximum size of uploaded images';
	public $SHOWCOPYRIGHT = 'Show copyright';
	public $SHOWCOPYRIGHTD = 'Show copyright message at the bottom of the page';

	public $A_FORMS               = 'Forms';
	public $A_NAME                = 'Name';
	public $A_EMAILS              = 'E-mail';
	public $A_EMAILSD             = 'List E-mail (separated by commas) that will be sent to the form content.';
	public $A_DESCRIPTION         = 'Description';
	public $A_CSS_TEXT            = 'CSS-style';
	public $A_CAPTCHA             = 'Use Captcha';

	public $A_FIELDS              = 'Fields';
	public $A_FIELD_LABEL         = 'Title';
	public $A_FIELD_TYPE          = 'Field type';
	public $A_FIELD_NOTNULL       = 'Requires';
	public $A_FIELD_HIDE          = 'Hidden';
	public $A_FIELD_CLASS         = 'Field CSS-class';
	public $A_FIELD_STYLE         = 'Field CSS-style';
	public $A_FIELD_HEIGHT        = 'Field height';
	public $A_FIELD_READONLY      = 'Read-only';
	public $A_FIELD_WOLABEL       = 'No title';
	public $A_FIELD_SUPPORT_EXT   = 'Allowed file extensions (separated by commas)';

	public $A_FIELD_ADD_OPTION    = 'Add an option to';

	public $A_FIELD_DEFVALUE      = 'Default value';
	public $A_FIELD_MAXLENGTH     = 'Maximum length';
	public $A_FIELD_OPTIONSFOR    = 'Preferences for';

	/* Сообщения */
	public $EMSG_EMPTY_NAME      = 'The title must not be empty';
	public $EMSG_1OPTVLEAST      = 'At least one option must be selected';
	public $EMSG_1OPTLEAST       = 'You must select at least one option';
	public $EMSG_EMPTY_LABEL     = 'Title must not be empty';
	public $EMSG_MAXFILESIZE     = 'File size should not exceed %s Kb';
	public $EMSG_UNSUPPORTIMAGE  = "Unauthorized file format.";


	/************************************/
	/* Пользовательская часть           */
	/************************************/
	public $ERR_FIELD_EMPTY         = 'Field %s must not be empty';

	public $SEND_SUCCESS            = 'Thank you! Your data sent successfully.';

	public $ERR_NO_PARAMS           = 'Undefined parameters';
	public $ERR_UPLOAD_FILE         = 'An error occurred while loading a file on the server';
	public $ERR_SEND_MAIL           = 'Sorry! While sending the error occurred.';
	public $ERR_MOVE_FILE           = 'Error occurred when moving a file to a folder';

	public $MSG_TITLE               = 'Message from the site';

	/************************************/
	/* v 1.2                            */
	/************************************/

	public $COPY_SUFFIX             = 'Copy';
	public $EXPORT_FORM             = 'Export';
	public $IMPORT_FORM             = 'Import';
	public $SQL_FILED_TIP           = 'To select data from table to specify the two fields with the names: VALUE and TEXT. <br/> For example: SELECT id AS value, name AS text FROM #_tablename';

	/************************************/
	/* v 1.3                            */
	/************************************/
	public $MAIL_SUBJECT            = 'Mail subject';
	public $SEND_COPY               = 'Send a copy';
	public $ONSUCCESS               = 'OnSuccess message';
	public $BOTTON_SEND_TEXT        = 'Text "Send" button';
	public $PRE_TEXT_MESSAGE        = 'Text for message copy';
	public $IMPORT_FROM_TEXT        = 'Import from text';
	public $SAVE_POSTED_DATA        = 'Save in database data sent';
	public $A_DATA                  = 'Data';
	public $FOLDER_FILES            = 'Directory for storing files';
	public $CREATE_FOLDER_FILES     = 'Create if not exist';

	/************************************/
	/* v 1.4                            */
	/************************************/
	public $SELECT_DESC             = 'Each option must be on a separate line.';
	public $VALSELECT_DESC          = 'Value of the text is separated by an "=". Example: 1=One.';
	public $WHERE_INCLUDE           = 'Where include a field';
	public $WHERE_INCLUDE_ARR       = array(0 => 'Everywhere', 1 => 'Only the base', 2 => 'Only in the mail');
	public $TITLE_IN_VALUES         = 'Title data';
	public $TITLE_IN_VALUESD        = 'Use the property as a table header with the data sent';
	public $FILTER_IN_VALUES        = 'Filter data';
	public $FILTER_IN_VALUESD       = 'Use this field to filter the table with the data sent';
	public $VALUE_FILTER            = 'Filter';
	public $A_FORM                  = 'Form';
	public $FORM_DATA_STATUS        = 'Status data';
	public $BOT_NOTIFY              = 'Bot akForms - not installed';

	/************************************/
	/* v 1.6                            */
	/************************************/
	public $FORM_GROUPS             = 'Data groups';
	public $FORM_GROUP              = 'Data group';
	public $FORM_GROUP_TITLE        = 'Group title';
	public $FORM_GROUP_DELETE       = 'Delete group';
	public $FORM_GROUP_ADD          = 'Add group';

	public $INVALID_FORM_ID         = 'Incorrect code form';

	public $ALLOW_SAVE_FORM         = 'Allow save form';
	public $ALLOW_SEE_SAVEDATA      = 'Allow viewing of saved data';
	public $ALLOW_SEE_SENDDATA      = 'Allow review of data sent';
	public $ALLOW_SEND_REPEATLY     = 'Allow to submit the form repeatly';

	public $FORM_DATA_SAVED         = 'Data forms are stored';
	public $CFG_EXPIRE              = 'The storage time of the stored data (days)';
	public $CFG_EXPIRE_D     		= 'Determines how much data is stored will be stored.';

	public $SUBMITTED_FORMS   		= 'Submitted forms';
	public $SAVED_FORMS     		= 'Saved forms';

	public $_VIEW                   = 'View';
	public $_EDIT                   = 'Edit';
	public $_DELETE                 = 'Delete';

	public $CONFIRM_DELETE          = 'Are you sure you want to delete?';

	/************************************/
	/* v 1.7                            */
	/************************************/
	public $DATA_SAVED              = 'Saved data';
	public $DATA_SUBMITTED          = 'Submitted data';

	public function __construct() {
	}

}

?>