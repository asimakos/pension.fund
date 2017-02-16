<?php
/**
* @version: 1.0
* @copyright: Copyright (C) 2009 Andrew Campball. All rights reserved.
* @package: Elxis
* @subpackage: Component AkForms
* @author: Francesco Venuti
* @author e-mail: amigamerlin@gmail.com
* @description: Italian  language for component AkForms
* @license: GPL
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class akFormLanguage {

	public $COPYRIGHT = "Componente <strong>AkForms</strong>. Sviluppato da Anrej Kambalov.";

	public $_CHECKED = 'Controllato';
	public $_SELECTED = 'Selezionato';

	/************************************/
	/* Административная часть           */
	/************************************/
	public $GENERALSETS           = 'Generale';
	public $CFG_MAXFILESIZE = 'Dimensioni File';
	public $CFG_MAXFILESIZED = 'Dimensioni massime in kb delle immagini che è possibile uploadare';
	public $SHOWCOPYRIGHT = 'Mostra copyright';
	public $SHOWCOPYRIGHTD = 'Mostra messaggio di copyright in fondo alla pagina';

	public $A_FORMS               = 'Forms';
	public $A_NAME                = 'Nome';
	public $A_EMAILS              = 'E-mail';
	public $A_EMAILSD             = 'Elenco delle E-mail (separate da virgola) alle quali verrà spedito il contenuto dei form.';
	public $A_DESCRIPTION         = 'Descrizione';
	public $A_CSS_TEXT            = 'CSS-style';
	public $A_CAPTCHA             = 'Usa Captcha';

	public $A_FIELDS              = 'Campi';
	public $A_FIELD_LABEL         = 'Titolo';
	public $A_FIELD_TYPE          = 'Tipo campo';
	public $A_FIELD_NOTNULL       = 'Necessario';
	public $A_FIELD_HIDE          = 'Nascosto';
	public $A_FIELD_CLASS         = 'Campo CSS-class';
	public $A_FIELD_STYLE         = 'Campo CSS-style';
	public $A_FIELD_HEIGHT        = 'Altezza Campo';
	public $A_FIELD_READONLY      = 'Solo Lettura';
	public $A_FIELD_WOLABEL       = 'Nessun titolo';
	public $A_FIELD_SUPPORT_EXT   = 'Estensioni di file permessi (separati da virgole)';

	public $A_FIELD_ADD_OPTION    = 'Aggiungi un\'opzione a';

	public $A_FIELD_DEFVALUE      = 'Valore di Default';
	public $A_FIELD_MAXLENGTH     = 'Lunghezza Massma ';
	public $A_FIELD_OPTIONSFOR    = 'Impostazioni per ';

	/* Сообщения */
	public $EMSG_EMPTY_NAME      = 'Il titolo non può essere vuoto';
	public $EMSG_1OPTVLEAST      = 'Almeno un\'opzione deve essere selezionata';
	public $EMSG_1OPTLEAST       = 'Devi selezionare almeno un\'opzione ';
	public $EMSG_EMPTY_LABEL     = 'Il titolo non deve essere vuoto';
	public $EMSG_MAXFILESIZE     = 'Le dimensioni massime non possono eccedere %s Kb';
	public $EMSG_UNSUPPORTIMAGE  = "Formato di file non autorizzato.";


	/************************************/
	/* Пользовательская часть           */
	/************************************/
	public $ERR_FIELD_EMPTY         = 'Campo %s non può essere vuoto';

	public $SEND_SUCCESS            = 'Grazie! I tuoi dati sono stati trasmessi con successo.';

	public $ERR_NO_PARAMS           = 'Parametro Indefinito';
	public $ERR_UPLOAD_FILE         = 'Si è verificato un errore durante il caricamento di un file sul server';
	public $ERR_SEND_MAIL           = 'Scusa, si è verificato l\'errore durante la trasmissione.';
	public $ERR_MOVE_FILE           = 'Si è verificato un errore muovendo il file in una cartella';

	public $MSG_TITLE               = 'Messaggio dal sito';

	/************************************/
	/* v 1.2                            */
	/************************************/

	public $COPY_SUFFIX             = 'Copia';
	public $EXPORT_FORM             = 'Export';
	public $IMPORT_FORM             = 'Importa';
	public $SQL_FILED_TIP           = 'Per selezionare i dati dalla tabella per specificare i due campi con i nomi: VALUE e TEXT <br/> Per esempio.: SELECT id AS value, name AS text FROM #_tablename';

	/************************************/
	/* v 1.3                            */
	/************************************/
	public $MAIL_SUBJECT            = 'Oggetto del messaggio';
	public $SEND_COPY               = 'Invia una copia';
	public $ONSUCCESS               = 'Trasmissione di successo';
	public $BOTTON_SEND_TEXT        = 'Testo pulsante "Invia"';
	public $PRE_TEXT_MESSAGE        = 'Testo per il copia del messaggio';
	public $IMPORT_FROM_TEXT        = 'Importa da testo';
	public $SAVE_POSTED_DATA        = 'Salva nei dati inviati database';
	public $A_DATA                  = 'Data';
	public $FOLDER_FILES            = 'Directory per archiviare i file';
	public $CREATE_FOLDER_FILES     = 'Creare se non esiste';

	/************************************/
	/* v 1.4                            */
	/************************************/
	public $SELECT_DESC             = 'Ogni opzione deve essere su una linea separata.';
	public $VALSELECT_DESC          = 'Valore del testo è separato da un "=". Esempio: 1=One.';
	public $WHERE_INCLUDE           = 'Per includere un campo';
	public $WHERE_INCLUDE_ARR       = array(0 => 'Ovunque', 1 => 'Solo la base', 2 => 'Solo nella mail');
	public $TITLE_IN_VALUES         = 'Titolo di dati';
	public $TITLE_IN_VALUESD        = 'Utilizzare la proprietà come intestazione tabella con i dati inviati';
	public $FILTER_IN_VALUES        = 'Filtrare i dati';
	public $FILTER_IN_VALUESD       = 'Utilizzare questo campo per filtrare la tabella con i dati inviati';
	public $VALUE_FILTER            = 'Filtro';
	public $A_FORM                  = 'Forma';
	public $FORM_DATA_STATUS        = 'Dati di stato';
	public $BOT_NOTIFY              = 'Bot akForms - non installato';

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