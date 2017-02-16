<?php
/**
* @version: 1.0
* @copyright: Copyright (C) 2009 Andrew Campball. All rights reserved.
* @package: Elxis
* @subpackage: Component AkForms
* @author: Andrej Kmabalov
* @author e-mail: ACampball@yandex.ru
* @description: Greek language for component AkForms (Τranslation: Nikos Vlachtsis)
* @license: GPL
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class akFormLanguage {

	public $COPYRIGHT = "Component <strong>AkForms</strong>. Developer Anrej Kambalov.";

	public $_CHECKED = 'ελέγχθηκε';
	public $_SELECTED = 'επιλέξτε';

	/************************************/
	/* Административная часть           */
	/************************************/
	public $GENERALSETS           = 'Γενικά';
	public $CFG_MAXFILESIZE = 'Μέγεθος Αρχείου';
	public $CFG_MAXFILESIZED = 'Μέγιστο μέγεθος εικόνων που ανεβάσθηκαν';
	public $SHOWCOPYRIGHT = 'Εμφάνιση πνευματικών δικαιωμάτων';
	public $SHOWCOPYRIGHTD = 'Εμφάνιση μηνύματος περί πνευματικών δικαιωμάτων στο κάτω μέρος της σελίδας';

	public $A_FORMS               = 'Φόρμες';
	public $A_NAME                = 'Όνομα';
	public $A_EMAILS              = 'E-mail';
	public $A_EMAILSD             = 'Κατάλογος E-mail (χωρισμένων με κόμμα) όπου θα αποσταλεί το περιεχόμενο της φόρμας.';
	public $A_DESCRIPTION         = 'Περιγραφή';
	public $A_CSS_TEXT            = 'CSS-style';
	public $A_CAPTCHA             = 'Χρήση εικόνων ασφαλείας';

	public $A_FIELDS              = 'Πεδία';
	public $A_FIELD_LABEL         = 'Τίτλος';
	public $A_FIELD_TYPE          = 'Είδος πεδίου';
	public $A_FIELD_NOTNULL       = 'Απαιτείται';
	public $A_FIELD_HIDE          = 'Κρυφό';
	public $A_FIELD_CLASS         = 'Πεδίο CSS-class';
	public $A_FIELD_STYLE         = 'Πεδίο CSS-style';
	public $A_FIELD_HEIGHT        = 'Ύψος πεδίου';
	public $A_FIELD_READONLY      = 'Μόνο ανάγνωση';
	public $A_FIELD_WOLABEL       = 'Χωρίς τίτλο';
	public $A_FIELD_SUPPORT_EXT   = 'Επιτρεπόμενες επεκτάσεις αρχείων (χωρισμένες με κόμμα)';

	public $A_FIELD_ADD_OPTION    = 'Προσθέστε επιλογή για';

	public $A_FIELD_DEFVALUE      = 'Τιμή εξ ορισμού';
	public $A_FIELD_MAXLENGTH     = 'Μέγιστο μήκος';
	public $A_FIELD_OPTIONSFOR    = 'Προτιμήσεις για';

	/* Сообщения */
	public $EMSG_EMPTY_NAME      = 'Ο τίτλος δεν μπορεί να είναι κενός';
	public $EMSG_1OPTVLEAST      = 'Μία τουλάχιστον επιλογή πρέπει να επιλεχθεί';
	public $EMSG_1OPTLEAST       = 'Πρέπει να επιλέξετε τουλάχιστον μία επιλογή';
	public $EMSG_EMPTY_LABEL     = 'Ο τίτλος δεν πρέπει να είναι κενός';
	public $EMSG_MAXFILESIZE     = 'Το μέγεθος αρχείου δεν μπορεί να υπερβεί τα %s Kb';
	public $EMSG_UNSUPPORTIMAGE  = "Μη επιτρεπτό είδος αρχείου.";


	/************************************/
	/* Пользовательская часть           */
	/************************************/
	public $ERR_FIELD_EMPTY         = 'Το πεδίο %s δεν πρέπει να είναι κενό';

	public $SEND_SUCCESS            = 'Ευχαριστούμε! Τα δεδομένα σας απεστάλησαν επιτυχώς.';

	public $ERR_NO_PARAMS           = 'Μη ορισμένες παράμετροι';
	public $ERR_UPLOAD_FILE         = 'Επαληθεύθηκε ένα λάθος κατά την διαδικασία φόρτωσης ενός αρχείου στον server';
	public $ERR_SEND_MAIL           = 'Λυπούμεθα! Το λάθος έγινε κατά την αποστολή.';
	public $ERR_MOVE_FILE           = 'Ένα λάθος έγινε κατά την μεταφορά ενός αρχείου σε ένα φάκελο';

	public $MSG_TITLE               = 'Μήνυμα του ιστότοπου';

	/************************************/
	/* v 1.2                            */
	/************************************/

	public $COPY_SUFFIX             = 'Αντιγραφή';
	public $EXPORT_FORM             = 'Εξαγωγή';
	public $IMPORT_FORM             = 'Εισαγωγή';
	public $SQL_FILED_TIP           = 'Για να επιλέξετε δεδομένα από τον πίνακα τα δύο πεδία με τα ονόματα: ΤΙΜΗ και ΚΕΙΜΕΝΟ. <br/> Παράδειγμα: SELECT id AS value, name AS text FROM #_tablename';

	/************************************/
	/* v 1.3                            */
	/************************************/
	public $MAIL_SUBJECT            = 'Θέμα μηνύματος';
	public $SEND_COPY               = 'Αποστολή αντιγράφου';
	public $ONSUCCESS               = 'Η επιτυχής μετάδοση';
	public $BOTTON_SEND_TEXT        = 'Κείμενο πλήκτρο "Αποστολή"';
	public $PRE_TEXT_MESSAGE        = 'Κείμενο για αντιγραφή μηνύματος';
	public $IMPORT_FROM_TEXT        = 'Εισαγωγή από το κείμενο';
	public $SAVE_POSTED_DATA        = 'Εκτός από τα δεδομένα βάσης δεδομένων αποστέλλονται';
	public $A_DATA                  = 'Δεδομένα';
	public $FOLDER_FILES            = 'Κατάλογος για την αποθήκευση αρχείων';
	public $CREATE_FOLDER_FILES     = 'Δημιουργήστε, εάν δεν υπάρχουν';

	/************************************/
	/* v 1.4                            */
	/************************************/
	public $SELECT_DESC             = 'Κάθε επιλογή πρέπει να είναι σε ξεχωριστή γραμμή.';
	public $VALSELECT_DESC          = 'Αξία του κειμένου χωρίζεται από ένα "=". Παράδειγμα: 1=One.';
	public $WHERE_INCLUDE           = 'Για να συμπεριλάβετε ένα πεδίο';
	public $WHERE_INCLUDE_ARR       = array(0 => 'Παντού', 1 => 'Μόνο η βάση', 2 => 'Μόνο με το ταχυδρομείο');
	public $TITLE_IN_VALUES         = 'Τίτλος Δεδομένων';
	public $TITLE_IN_VALUESD        = 'Χρησιμοποιήστε το ακίνητο ως μια κεφαλίδα πίνακα με τα δεδομένα που αποστέλλονται';
	public $FILTER_IN_VALUES        = 'Φιλτράρισμα δεδομένων';
	public $FILTER_IN_VALUESD       = 'Χρησιμοποιήστε αυτό το πεδίο για να φιλτράρετε τον πίνακα με τα δεδομένα που αποστέλλονται';
	public $VALUE_FILTER            = 'Φίλτρο';
	public $A_FORM                  = 'Μορφή';
	public $FORM_DATA_STATUS        = 'Κατάσταση δεδομένων';
	public $BOT_NOTIFY              = 'Bot akForms - δεν έχει εγκατασταθεί';

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