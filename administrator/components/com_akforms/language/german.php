<?php
/**
* @version: 1.
* @copyright: Copyright (C) 2009 Andrew Campball. All rights reserved.
* @package: Elxis
* @subpackage: Component AkForms
* @author: Andrej Kmabalov
* @author e-mail: ACampball@yandex.ru
* @description: Russian language for component AkForms
* @license: GPL
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещен.' );


class akFormLanguage {

	public $COPYRIGHT = "Компонент <strong>AkForms</strong>. Разработчик - Андрей Камбалов.";

	public $_CHECKED = 'ausgewählt';
	public $_SELECTED = 'ausgewählt';

	/************************************/
	/* Административная часть           */
	/************************************/
	public $GENERALSETS           = 'Grundeinstellungen';
	public $CFG_MAXFILESIZE = 'Volume Bild';
	public $CFG_MAXFILESIZED = 'Maximale Größe der hochgeladenen Bilder';
	public $SHOWCOPYRIGHT = 'Show Urheberrecht';
	public $SHOWCOPYRIGHTD = 'Show Copyright-Meldung am unteren Rand der Seite?';

	public $A_FORMS               = 'Forms';
	public $A_NAME                = 'Titel';
	public $A_EMAILS              = 'E-mail';
	public $A_EMAILSD             = 'Liste E-Mail (durch Kommas getrennt), die an das Formular gesendet werden.';
	public $A_DESCRIPTION         = 'Beschreibung';
	public $A_CSS_TEXT            = 'CSS-Stile';
	public $A_CAPTCHA             = 'Verwenden Sie den Bestätigungs-Code';

	public $A_FIELDS              = 'Field';
	public $A_FIELD_LABEL         = 'Titel';
	public $A_FIELD_TYPE          = 'Feld Typ';
	public $A_FIELD_NOTNULL       = 'Obligatorisch';
	public $A_FIELD_HIDE          = 'Verstecktes Feld';
	public $A_FIELD_CLASS         = 'CSS-Klasse Feld';
	public $A_FIELD_STYLE         = 'CSS-Stil Feld';
	public $A_FIELD_HEIGHT        = 'Line-height';
	public $A_FIELD_READONLY      = 'Read-only';
	public $A_FIELD_WOLABEL       = 'Kein Titel';
	public $A_FIELD_SUPPORT_EXT   = 'Erlaubte Dateiendungen (durch Kommas getrennt)';

	public $A_FIELD_ADD_OPTION    = 'Hinzufügen einer Option auf';

	public $A_FIELD_DEFVALUE      = 'Default-Wert';
	public $A_FIELD_MAXLENGTH     = 'Maximale Länge';
	public $A_FIELD_OPTIONSFOR    = 'Voreinstellungen für';

	/* Сообщения */
	public $EMSG_EMPTY_NAME      = 'Der Titel darf nicht leer sein';
	public $EMSG_1OPTVLEAST      = 'Mindestens eine Option muss ausgewählt werden';
	public $EMSG_1OPTLEAST       = 'Sie müssen mindestens eine Option';
	public $EMSG_EMPTY_LABEL     = 'Titel darf nicht leer sein';
	public $EMSG_MAXFILESIZE     = 'Dateigröße nicht überschreiten sollte %s KB';
	public $EMSG_UNSUPPORTIMAGE  = "Unerlaubte Dateiformat.";


	/************************************/
	/* Пользовательская часть           */
	/************************************/
	public $ERR_FIELD_EMPTY         = 'Feld %s darf nicht leer sein';

	public $SEND_SUCCESS            = 'Vielen Dank! Ihre Daten erfolgreich gesendet.';

	public $ERR_NO_PARAMS           = 'Undefined Parameter';
	public $ERR_UPLOAD_FILE         = 'Fehler beim Laden einer Datei auf dem Server';
	public $ERR_SEND_MAIL           = 'Sorry! Beim Senden der Fehler auftrat.';
	public $ERR_MOVE_FILE           = 'Fehler beim Verschieben einer Datei in einen Ordner';

	public $MSG_TITLE               = 'Nachricht von der Website';

	/************************************/
	/* v 1.2                            */
	/************************************/

	public $COPY_SUFFIX             = 'Kopieren';
	public $EXPORT_FORM             = 'Export';
	public $IMPORT_FORM             = 'Import';
	public $SQL_FILED_TIP           = 'So wählen Sie Daten aus der Tabelle auf den beiden Feldern mit den Namen angeben: Wert und Text <br/> Zum Beispiel.: SELECT id AS value, name AS text FROM #_tablename';

	/************************************/
	/* v 1.3                            */
	/************************************/
	public $MAIL_SUBJECT            = 'Betreff';
	public $SEND_COPY               = 'Senden Sie eine Kopie';
	public $ONSUCCESS               = 'Die erfolgreiche Übertragung';
	public $BOTTON_SEND_TEXT        = 'Text Schaltfläche "Senden"';
	public $PRE_TEXT_MESSAGE        = 'Text für Nachricht kopieren';
	public $IMPORT_FROM_TEXT        = 'Import von Text';
	public $SAVE_POSTED_DATA        = 'Speichern in der Datenbank gesendeten Daten';
	public $A_DATA                  = 'Daten';
	public $FOLDER_FILES            = 'Verzeichnis zum Speichern von Dateien';
	public $CREATE_FOLDER_FILES     = 'Erstellen Sie falls nicht vorhanden';

	/************************************/
	/* v 1.4                            */
	/************************************/
	public $SELECT_DESC             = 'Jede Option muss in einer separaten Zeile stehen.';
	public $VALSELECT_DESC          = 'Wert der Text wird durch ein "=" getrennt. Beispiel: 1 = Eins.';
	public $WHERE_INCLUDE           = 'Um ein Feld';
	public $WHERE_INCLUDE_ARR       = array(0 => 'Überall', 1 => 'Nur die Basis', 2 => 'Nur in der Mail');
	public $TITLE_IN_VALUES         = 'Titel Data';
	public $TITLE_IN_VALUESD        = 'Verwenden Sie die Eigenschaft als Tisch-Header mit den gesendeten Daten';
	public $FILTER_IN_VALUES        = 'Filtern von Daten';
	public $FILTER_IN_VALUESD       = 'Verwenden Sie dieses Feld auf den Tisch Filter mit den gesendeten Daten';
	public $VALUE_FILTER            = 'Filter';
	public $A_FORM                  = 'Form';
	public $FORM_DATA_STATUS        = 'Status Daten';
	public $BOT_NOTIFY              = 'Bot akForms - nicht installiert';

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