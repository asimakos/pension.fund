<?php 
/**
* @version: 2009.1
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component eBlog
* @author: Elxis Team
* @translator: Ioannis Sannos
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Greek language for component eBlog
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class eBlogLang {


	public $ELXISBLOG = 'Ιστολόγιο Elxis';
	public $TAGS = 'Ετικέτες';
	public $UNKNOWNTAG = 'Άγνωστη ετικέτα';
	public $PERMLINK = 'Μόνιμος σύνδεσμος';
	public $COMMENTS = 'Σχόλια';
	public $COMMENT = 'Σχόλιο';
	public $NOCOMMENTS = 'Δεν υπάρχουν σχόλια.';
	PUBLIC $MUSTLOGTOCOM = 'Για να σχολιάσετε πρέπει πρώτα να συνδεθείτε.';
	public $POSTCOMMENT = 'Ανάρτηση σχολίου';
	public $YOURCOMMENT = 'Το σχόλιό σας';
	public $NALLPOSTCOM = 'Δεν σας επιτρέπετε η ανάρτηση σχολίων!';
	public $MUSTWRITEMSG = 'Πρέπει να γράψετε ένα μήνυμα!';
	public $COMADDSUC = 'Το σχόλιό σας προστέθηκε επιτυχώς!';
	public $WAITRETRY = 'Παρακαλούμε ξαναπροσπαθήστε μετά από μερικά δευτερόλεπτα!';
	public $NALLPERFACT = 'Δεν σας επιτρέπεται αυτή η ενέργεια!';
	public $ARTNOFOUND = 'Το άρθρο που ζητήσατε δεν βρέθηκε!';
	public $POSTSTAGASAT = "Άρθρα με ετικέτα %s στο %s";
	public $ARCHIVES = 'Αρχείο';
	public $USERBLOGSAT = "Ιστολόγιο χρηστών στο %s";
	public $USERBLOGS = 'Ιστολόγιο χρηστών';
	public $THEREAREBLOGS = "Υπάρχουν %s ιστολόγια διαθέσιμα"; //s: number of available blogs
	public $POSTS = 'Άρθρα';

	//control panel
	public $CPANEL = 'Πίνακας ελέγχου';
	public $MANBLOG = 'Διαχειριστείτε το ιστολόγιό σας';
	public $ALLPOSTS = 'Όλα τα άρθρα';
	public $LATESTPOSTS = "Τα τελευταία %s άρθρα";
	public $SETTINGS = 'Ρυθμίσεις';
	public $CSSFILE = 'Αρχείο CSS';
	public $RTLCSSFILE = 'Αρχείο CSS RTL';
	public $COMMENTARY = 'Σχολιασμός';
	public $NOTALLOWED = 'Δεν επιτρέπεται';
	public $REGUSERS = 'Εγγεγραμένοι χρήστες';
	public $ALLOWEDALL = 'Επιτρέπεται σε όλους';
	public $POSTSNUMBER = 'Αριθμός άρθρων';
	public $POSTSNUMBERD = 'Αριθμός πιο πρόσφατων άρθρων προς εμφάνιση στην αρχική σελίδα του ιστολογίου.';
	public $SHOWTAGSD = 'Επιλέξτε αν επιθυμείτε να εμφανίζονται ετικέτες κάτω από τα άρθρα.';
	public $CSSFILED = 'Φύλλο μορφοποίησης του ιστολόγιού σας. Το CSS φροντίζει την μορφοποίηση του κειμένου, χρωμμάτων και την όλη εμφάνιση του ιστολόγιού σας.';
	public $RTLCSSFILED = 'Φύλλο μορφοποίησης του ιστολόγιού σας για γλώσσες με κατεύθυνση γραφής από Δεξιά Προς Αριστερά όπως τα Περσικά και τα Εβραϊκά.';
	public $OPTION = 'Επιλογή';
	public $VALUE = 'Τιμή';
	public $HELP = 'Βοήθεια';
	public $NEWPOST = 'Νέο άρθρο';
	public $EDITPOST = 'Επεξεργασία άρθρου';
	public $TITLENOEMPTY = 'Ο τίτλος δεν μπορεί να είναι κενός!';
	public $FOLDERCNOTCR = "Ο κατάλογος %s δεν στάθηκε δυνατό να δημιουργηθεί!"; //%s: folder name
	public $DIMENSIONS = 'Διαστάσεις (Π x Υ)';
	public $SIZEKB = 'Μέγεθος (KB)';
	public $LISTVIEW = 'Προβολή λίστας';
	public $THUMBSVIEW = 'Προβολή μικρογραφιών';
	public $UPLOAD = 'Αποστολή';
	public $UPLOADIMG = 'Αποστολή εικόνας';
	public $MEDIAMAN = 'Διαχειριστής πολυμέσων';
	public $YOUTUBEVIDEO = 'Βίντεο YouTube';
	public $GOOGLEVIDEO = 'Βίντεο Google';
	public $YAHOOVIDEO = 'Βίντεο Yahoo';
	public $COMSEPTAGS = 'Ετικέτες χωρισμένες με κόμμα';
	public $SLOGAN = 'Σλόγκαν';
	public $SLOGAND = 'Σλόγκαν προς εμφάνιση στην κορυφή του ιστολόγιού σας. Μπορείτε να γράψετε html.';
	public $SHOWOWNER = 'Εμφάνιση ιδιοκτήτη';
	public $SHOWOWNERD = 'Εμφάνιση ονόματος ιδιοκτήτη στην κορυφή του ιστολόγιου;';
	public $SHOWARCHIVE = 'Εμφάνιση αρχείου';
	public $SHOWARCHIVED = 'Εμφάνιση αρχείου μηνών στο κάτω τμήμα του ιστολόγιου;';

	//SEO titles
	public $SEOTITLE = 'Τίτλος SEO';
	public $SEOTITLEEMPTY = 'Ο τίτλος SEO δεν μπορεί να είναι κενός!';
	public $INVALID = 'Άκυρος';
	public $VALID = 'Έγκυρος';
	public $SEOTEXIST = 'Ο τίτλος SEO υπάρχει ήδη!';
	public $SEOTLARGER = 'Δοκιμάστε έναν μεγαλύτερο τίτλο!';
	public $SEOTHELP = 'Μπορείτε μόνο να χρησιμοποιήσετε μικρούς λατινικούς χαρακτήρες, αριθμούς, κάτω και μεσαίες παύλες. Ο τίτλος SEO πρέπει να είναι μοναδικός! Προσπαθείτε να εισάγετε μοναδικούς και με νόημα τίτλους SEO.';
	public $SEOTSUG = 'Προτεινόμενος τίτλος SEO';
	public $SEOTVAL = 'Επικύρωση τίτλου SEO';

	//languages names
	public $ARMENIAN = 'Αρμένικα';
	public $BOZNIAN = 'Βοσνιακά';
	public $BRAZILIAN = 'Βραζιλιάνικα';
	public $BULGARIAN = 'Βουλγάρικα';
	public $CREOLE = 'Κρεολέ (Αϊτή)';
	public $CROATIAN = 'Κροατικά';
	public $DANISH = 'Δανέζικα';
	public $ENGLISH = 'Αγγλικά';
	public $FRENCH = 'Γαλλικά';
	public $GERMAN = 'Γερμανικά';
	public $GREEK = 'Ελληνικά';
	public $INDONESIAN = 'Ινδονησιακά';
	public $ITALIAN = 'Ιταλικά';
	public $JAPANESE = 'Ιαπωνικά';
	public $LATVIAN = 'Λεττονικά';
	public $LITHUANIAN = 'Λιθουανικά';
	public $PERSIAN = 'Περσικά';
	public $POLISH = 'Πολωνικά';
	public $RUSSIAN = 'Ρωσσικά';
	public $SERBIAN = 'Σέρβικα';
	public $SPANISH = 'Ισπανικά';
	public $SRPSKI = 'Κυριλικά Σερβικά';
	public $TURKISH = 'Τουρκικά';
	public $VIETNAMESE = 'Βιετναμέζικα';

	//backend
	public $BLOGINFO = 'Πληροφορίες ιστολογίου';
	public $CANCONFIGD = 'Επιλέξτε αν επιθυμείτε ο ιδιοκτήτης του ιστολόγιου να μπορεί να αλλάζει τις ρυθμίσεις του blog από το δημόσιο τμήμα';
	public $CANUPLOADD = 'Επιλέξτε αν επιθυμείτε ο ιδιοκτήτης του ιστολόγιου να μπορεί να ανεβάζει αρχεία πολυμέσων.';
	public $BLOGOWNMDIR = 'Κατάλογος πολυμέσων ιδιοκτήτη ιστολογίου';
	public $EXISTING = 'Υπάρχει';
	public $NONEXISTING = 'Δεν υπάρχει';
	public $SIZEKBD = 'Συνολικό επιτρεπόμενο μέγεθος αποσταλθέντων αρχείων για αυτόν το χρήστη σε KB. Η προκαθορισμένη τιμή είναι 2000 (2MB).';
	public $BLOGOWNER = 'Ιδιοκτήτης ιστολογίου';
	public $UPLOADDIR = 'Κατάλογος αποστολής';
	public $UPLOADEDFILES = 'Σταλθέντα αρχεία';
	public $USEDSPACE = 'Χρήση χώρου';
	public $LASTPOST = 'Τελευταίο άρθρο';
	public $LASTPOSTDATE = 'Ημερομηνία τελ. άρθρου';
	public $NOTSETYET = 'Δεν ορίστηκε ακόμα';
	public $UNOTALLUPLOADF = 'Δεν επιτρέπεται η αποστολή αρχείων στο χρήστη.';

	//elxis 2009.1
	public $INVDATE = 'Η ημερομηνία που επιλέξατε είναι άκυρη.';
	public $METADESCDAY = "Άρθρα για %s στο %s"; //Posts for DATE on EBLOG_TITLE
	public $NOPOSTSFDATE = 'Δεν βρέθηκαν άρθρα για αυτή την ημερομηνία.';
	public $SHAREPOST = 'Μοιραστείτε αυτό το άρθρο';


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
	}

}

?>