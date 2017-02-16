<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @description: Greek user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_greek {

	public $_ON_NEW_CONTENT = "Ένα νέο άρθρο συντάχθηκε από τον χρήστη [ %s ] με τίτλο [ %s ] για την ενότητα [ %s ] και τη κατηγορία [ %s ]";
	public $_E_COMMENTS = 'Σχόλια';
	public $_DATE = 'Ημερομηνία';
	public $_E_SUBCONWAIT = 'Υποβληθέντα άρθρα σε αναμονή έγκρισης:';
	public $_E_CONTENTSUB = 'Υποβολή περιεχομένου';
	public $_MAIL_SUB = 'Υποβλήθηκε από χρήστη';
	public $_E_HI = 'Γειά';
	public $_E_NEWSUBBY = "Έγινε μία νέα υποβολή από το χρήστη %s";
	public $_E_TYPESUB = 'Τύπος υποβολής:';
	public $_E_TITLE = 'Τίτλος';
	public $_E_LOGINAPPR = 'Συνδεθείτε στην διαχείριση της ιστοσελίδας σας για να δείτε και να εγκρίνετε αυτή την υποβολή.';
	public $_E_DONTRESPOND = 'Παρακαλούμε μην απαντήσετε σε αυτό το μήνυμα καθώς δημιουργήθηκε αυτόματα και εξυπηρετεί μόνο πληροφοριακούς σκοπούς.';
	public $_E_NEWPASS_SUB = "Νέος Κωδικός Πρόσβασης για τον χρήστη %s";
	public $_E_RPASS_NADMIN = "Ο χρήστης %s υπέβαλε την φόρμα υπενθύμισης κωδικού πρόσβασης. Ένας νέος κωδικός πρόσβασης δημιουργήθηκε και στάλθηκε στο χρήστη. 
	Αν δεν επιθυμείτε να λαμβάνετε ειδοποιήσεις για τέτοιες ενέργειες αλλάξτε την τιμή της παραμέτρου USERS_RPASSMAIL στο SoftDisk σε Όχι.";
	public $_E_SEND_SUB = "Λεπτομέρειες λογαριασμού για τον %s στο %s";
	public $_ASEND_MSG = "Γεια σου %s,

Ένας νέος χρήστης εγγράφηκε στο %s.
Αυτό το μήνυμα περιέχει τις πληροφορίες του:

Όνομα - %s
e-mail - %s
Κωδικός Πρόσβασης - %s

Παρακαλούμε μην απαντήσεις σε αυτό το μήνυμα καθώς δημιουργείται αυτόματα και εξυπηρετεί μόνο πληροφοριακούς σκοπούς.";
	public $_NEW_MESSAGE = 'Έχει έλθει ένα νέο ιδιωτικό μήνυμα';
	public $_NEW_PRMSGF = "Έχετε ένα νέο ιδιωτικό μήνυμα από τον %s";
	public $_LOG_READMSG = 'Παρακαλώ συνδεθείτε στην κονσόλα διαχείρισης για να διαβάσετε αυτό το μήνυμα.';
	public $_SUBCON_APPRNTF = 'Ειδοποίηση έγκρισης υποβληθέντος άρθρου';
	public $_SUBCON_ATAPPR = 'Το υποβληθέν περιεχόμενό σας στο %s εγκρίθηκε.';
	public $_SECTION = 'Ενότητα';
	public $_CATEGORY = 'Κατηγορία';

	//elxis 2008.1
	public $_MANAPPROVE = 'Προκειμένου ο νέος χρήστης να μπορέσει να συνδεθεί θα πρέπει να εγκρίνετε χειροκίνητα την εγγραφή του!';
	public $_ACCUNBLOCK = "Ο λογαριασμός σας στο %s ενεργοποιήθηκε από έναν διαχειριστή του ιστότοπου. Μπορείτε τώρα να συνδεθείτε ως %s";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'Ειδοποίηση νέου σχολίου';
	public $_E_NEWCOMBYTITLE = "Ένα νέο σχόλιο καταχωρήθηκε από τον %s σε ένα άρθρο σας με τίτλο %s";
    public $_E_COMSTAYUNPUB = 'Αυτό το σχόλιο θα παραμείνει μη-δημοσιευμένο εώς ότου εσείς ή ένας υπερδιαχειριστής το δημοσιεύσει.';
    public $_E_ACCEXPDATE = 'Ημερομηνία λήξης λογαριασμού';

	public function __cosntruct() {
	}

}

?>