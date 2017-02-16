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
* @description: Greek language for component config
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

	public $A_COMP_CONF_OFFLINE = 'Ο Ιστότοπος είναι Εκτός';
	public $A_COMP_CONF_OFFMESSAGE = 'Μήνυμα Ιστότοπου Εκτός';
	public $A_COMP_CONF_TIP_OFFMESSAGE = 'Το μήνυμα που θέλετε να εμφανίζεται όταν ο ιστότοπος είναι εκτός';
	public $A_COMP_CONF_ERR_MESSAGE = 'Μήνυμα Σφάλματος του Συστήματος';
	public $A_COMP_CONF_TIP_ERR_MESSAGE = 'Το μήνυμα που θέλετε να εμφανίζεται όταν το Elxis δεν θα μπορεί να συνδεθεί στη βάση δεδομένων';
	public $A_COMP_CONF_SITE_NAME = 'Όνομα Ιστότοπου';
	public $A_COMP_CONF_UN_LINKS = 'Εμφάνιση των Μη Εγκεκριμένων Συνδέσμων';
	public $A_COMP_CONF_UN_TIP = 'Εάν το θέσετε σε ναι, θα εμφανίζονται οι σύνδεσμοι προς το περιεχόμενο που κανονικά προορίζεται μόνο για τους εγγεγραμμένους χρήστες, ακόμη και στους μη εγγεγραμμένους. Ο χρήστης, θα πρέπει να συνδεθεί για να δει το πλήρες περιεχόμενο.';
	public $A_COMP_CONF_USER_REG = 'Να Επιτρέπεται η Εγγραφή Μελών';
	public $A_COMP_CONF_TIP_USER_REG = 'Εάν το θέσετε σε ναι, οι επισκέπτες μπορούν να εγγραφούν ως μέλη';
	public $A_COMP_CONF_REQ_EMAIL = 'Να Απαιτείται Μοναδικό Email';
	public $A_COMP_CONF_REQTIP = 'Εάν το θέσετε σε ναι, δεν θα επιτρέπεται εγγραφή σε μέλη που δηλώνουν μία υπάρχουσα διεύθυνση email';
	public $A_COMP_CONF_DEBUG = 'Αποσφαλμάτωση Ιστότοπου';
	public $A_COMP_CONF_DEBTIP = 'Εάν το θέσετε σε ναι, εμφανίζονται πληροφορίες αποσφαλμάτωσης και γίνονται ορατά τα σφάλματα της SQL, αν υπάρχουν';
	public $A_COMP_CONF_EDITOR = 'Κειμενογράφος WYSIWYG';
	public $A_COMP_CONF_LENGTH = 'Μήκος Λίστας';
	public $A_COMP_CONF_LENTIP = 'Ορίζει το προκαθορισμένο πλήθος των εγγραφών που εμφανίζουν οι λίστες στον πίνακα διαχείρισης.';
	public $A_COMP_CONF_FAV_ICON = 'Εικονίδιο των Αγαπημένων για τον Ιστότοπο';
	public $A_COMP_CONF_FAVTIP = 'Εάν το αφήσετε κενό, ή το αρχείο που έχετε ορίσει, δεν μπορεί να βρεθεί, θα χρησιμοποιηθεί το προκαθορισμένο εικονίδιο favicon.ico';
	public $A_COMP_CONF_CLINKACC = 'Component συνδεδεμένα στο Σύστημα Πρόσβασης';
	public $A_COMP_CONF_CLACCDESC = 'Επιλέξτε τον τύπο των component στα οποία θέλετε να εφαρμοστεί το Σύστημα Ελέγχου Πρόσβασης στον κυρίως ιστότοπο (Τιμή ACO = view). Συμβουλευτείτε τη βοήθεια αν δεν είστε βέβαιοι.';
	public $A_COMP_CONF_CORECOMPS = 'Component Πυρήνα';
	public $A_COMP_CONF_3RDCOMPS = 'Component τρίτων κατασκευαστών';
	public $A_COMP_CONF_ALLCOMPS = 'Όλα τα Component';
	public $A_COMP_CONF_CAPTCHA = 'Χρήση εικόνων ασφαλείας';
	public $A_COMP_CONF_CAPTCHATIP = 'Ναι, αν θέλετε να εμφανίζονται εικόνες ασφαλείας (Captcha) στις φόρμες του ιστότοπού σας. Υποστηρίζεται και ηχητικός συλλαβισμός των γραμμάτων για διευκόλυνση ανθρώπων με προβλήματα όρασης.';
	public $A_COMP_CONF_LOCALE = 'Εντοπιότητα';
	public $A_COMP_CONF_LANG = 'Προκαθορισμένη γλώσσα του Ιστότοπου';
	public $A_COMP_CONF_ALANG = 'Προκαθορισμένη γλώσσα στο Πίνακα Διαχείρισης';
	public $A_COMP_CONF_TIME_SET = 'Διαφορά Ώρας';
	public $A_COMP_CONF_DATE = 'Σύμφωνα με αυτή τη ρύθμιση, η τρέχουσα ημερομηνία και ώρα είναι';
	public $A_COMP_CONF_LOCAL = 'Εντοπιότητα Χώρας';
	public $A_COMP_CONF_LOCRECOM = 'Σας συνιστούμε να το αφήσετε στην Αυτόματη Επιλογή. Το Elxis θα φορτώσει το κατάλληλο Locale για το λειτουργικό σας σύστημα και τη γλώσσα σας. Τα Windows δεν υποστηρίζουν UTF-8 locales.';
	public $A_COMP_CONF_LOCCHECK = 'Έλεγχος εντοπιότητας';
	public $A_COMP_CONF_LOCCHECK2 = 'Εάν βλέπετε αυτή την ημερομηνία ορθά μορφοποιημένη, τότε το Locale ρυθμίστηκε άψογα για το σύστημα και την γλώσσα σας.<br /><strong>Προσοχή!</strong> Σε περιβάλλον Windows, το Locale τίθεται αυτόματα σε ρυθμίσεις για την Αγγλική γλώσσα.';
	public $A_COMP_CONF_AUTOSEL = 'Αυτόματη Επιλογή';
	public $A_COMP_CONF_CONTROL = '* Οι ακόλουθες παράμετροι, ελέγχουν στοιχεία εμφάνισης στον ιστότοπο *';
	public $A_COMP_CONF_LINK_TITLES = 'Συνδεδεμένοι Τίτλοι';
	public $A_COMP_CONF_LTITLES_TIP = 'Εάν το θέσετε σε ναι, ο τίτλος των αντικειμένων περιεχομένου, θα λειτουργεί και σα σύνδεσμος προς το αντικείμενο';
	public $A_COMP_CONF_MORE_LINK = 'Σύνδεσμος Διαβάστε Περισσότερα';
	public $A_COMP_CONF_MLINK_TIP = 'Εάν το θέσετε σε ναι, θα εμφανίζεται ο σύνδεσμος Διαβάστε Περισσότερα όταν στο αντικείμενο περιεχομένου έχει συμπληρωθεί και το πεδίο Κυρίως Κείμενο';
	public $A_COMP_CONF_RATE_VOTE = 'Αξιολόγηση/Ψηφοφορία Αντικειμένου';
	public $A_COMP_CONF_RVOTE_TIP = 'Εάν το θέσετε σε ναι, θα ενεργοποιηθεί το σύστημα ψηφοφορίας για τα εμφανιζόμενα αντικείμενα περιεχομένου';
	public $A_COMP_CONF_AUTHOR = 'Ονόματα Συγγραφέων';
	public $A_COMP_CONF_AUTHORTIP = 'Εάν το θέσετε σε ναι, θα εμφανίζεται το όνομα του συγγραφέα του άρθρου. Αυτή η γενική ρύθμιση μπορεί να παρακαμφθεί για μεμονωμένα αντικείμενα και μενού';
	public $A_COMP_CONF_CREATED = 'Ημερομηνία και Ώρα Δημιουργίας';
	public $A_COMP_CONF_CREATEDTIP = 'Εάν το θέσετε σε ναι, θα εμφανίζεται η ημερομηνία και η ώρα που δημιουργήθηκε το αντικείμενο. Αυτή η γενική ρύθμιση μπορεί να παρακαμφθεί για μεμονωμένα αντικείμενα και μενού';
	public $A_COMP_CONF_MOD_DATE = 'Ημερομηνία και Ώρα Τροποποίησης';
	public $A_COMP_CONF_MDATETIP = 'Εάν το θέσετε σε ναι, θα εμφανίζεται η ημερομηνία και η ώρα που το αντικείμενο τροποποιήθηκε. Αυτή η γενική ρύθμιση μπορεί να παρακαμφθεί για μεμονωμένα αντικείμενα και μενού';
	public $A_COMP_CONF_HITS = 'Επιτυχίες';
	public $A_COMP_CONF_HITSTIP = 'Εάν το θέσετε σε ναι, θα εμφανίζεται πόσες φορές θεάθηκε το αντικείμενο. Αυτή η γενική ρύθμιση μπορεί να παρακαμφθεί για μεμονωμένα αντικείμενα και μενού';
	public $A_COMP_CONF_PDF = 'Εικονίδιο PDF';
	public $A_COMP_CONF_OPT_MEDIA = 'Η επιλογή δεν είναι διαθέσιμη αν ο κατάλογος /tmpr δεν είναι εγγράψιμος';
	public $A_COMP_CONF_PRINT_ICON = 'Εικονίδιο Εκτύπωσης';
	public $A_COMP_CONF_EMAIL_ICON = 'Εικονίδιο E-mail';
	public $A_COMP_CONF_ICONS = 'Μορφή Εικονιδίων ';
	public $A_COMP_CONF_USE_OR_TEXT = 'Οι σύνδεσμοι Εκτύπωση, PDF, RTF & E-mail μπορούν να εμφανίζονται με τη μορφή Εικονιδίων ή Λεκτικών';
	public $A_COMP_CONF_TBL_CONTENTS = 'Πίνακας Περιεχομένων σε αντικείμενα που περιλαμβάνουν διαχωριστικά σελίδων';
	public $A_COMP_CONF_BACK_BUTTON = 'Πλήκτρο Επιστροφής';
	public $A_COMP_CONF_CONTENT_NAV = 'Πλοήγηση στα Αντικείμενα Περιεχομένου';
	public $A_COMP_CONF_HYPER = 'Χρήση τίτλων σε ρόλο υπερσύνδεσης';
	public $A_COMP_CONF_DBTYPE = 'Τύπος Βάσης Δεδομένων';
	public $A_COMP_CONF_DBWARN = 'Μην το αλλάξετε, εκτός και αν το σύστημά σας υποστηρίζει αυτή τη βάση δεδομένων και έχετε εγκαταταστήσει ένα αντίγραφο των δεδομένων του Elxis σε αυτήν!';
	public $A_COMP_CONF_HOSTNAME = 'Φιλοξενητής';
	public $A_COMP_CONF_DB_PW = 'Συνθηματικό';
	public $A_COMP_CONF_DB_NAME = 'Βάση Δεδομένων';
	public $A_COMP_CONF_DB_PREFIX = 'Πρόθεμα πινάκων';
	public $A_COMP_CONF_NOT_CH = '!! ΜΗΝ ΤΟ ΑΛΛΑΞΕΤΕ, ΕΚΤΟΣ ΚΑΙ ΑΝ Η ΒΑΣΗ ΠΟΥ ΕΧΕΤΕ ΔΗΜΙΟΥΡΓΗΣΕΙ, ΧΡΗΣΙΜΟΠΟΙΕΙ ΣΤΟΥΣ ΠΙΝΑΚΕΣ ΤΟ ΠΡΟΘΕΜΑ ΠΟΥ ΠΡΟΚΕΙΤΑΙ ΝΑ ΟΡΙΣΕΤΕ !!';
	public $A_COMP_CONF_ABS_PATH = 'Απόλυτη Διαδρομή';
	public $A_COMP_CONF_LIVE = 'Ενεργός Ιστότοπος';
	public $A_COMP_CONF_SECRET = 'Μυστική Λέξη';
	public $A_COMP_CONF_GZIP = 'Συμπίεση Σελίδας με GZIP';
	public $A_COMP_CONF_CP_BUFFER = 'Συμπίεση των δεδομένων εξόδου, (εφόσον την υποστηρίζει το περιβάλλον)';
	public $A_COMP_CONF_SESSION_TIME = 'Διάρκεια Ζωής Συνεδρίας';
	public $A_COMP_CONF_SEC = 'δευτ.';
	public $A_COMP_CONF_AUTO_LOGOUT = 'Αυτόματη αποσύνδεση μετά από αυτό το χρονικό διάστημα αδράνειας';
	public $A_COMP_CONF_ERR_REPORT = 'Αναφορά Σφαλμάτων';
	public $A_COMP_CONF_HELP_SERVER = 'Διακομιστής Βοήθειας';
	public $A_COMP_CONF_META_PAGE = 'Σελίδα metadata';
	public $A_COMP_CONF_META_DESC = 'Γενική Meta Περιγραφή του Ιστότοπου';
	public $A_COMP_CONF_META_KEY = 'Γενικές Meta Λέξεις Κλειδιά του Ιστότοπου';
	public $A_COMP_CONF_HPS1 = 'Τοπικά Αρχεία Βοήθειας';
	public $A_COMP_CONF_HPS2 = 'Απομακρυσμένος Εξυπηρετητής Βοήθειας του Elxis';
	public $A_COMP_CONF_HPS3 = 'Επίσημος εξυπηρετητής Βοήθειας του Elxis';
	public $A_COMP_CONF_PERMFLES = 'Επιλέξτε αυτή την επιλογή για να ορίσετε τα δικαιώματα των αρχείων που θα δημιουργηθούν από τώρα και στο εξής';
	public $A_COMP_CONF_PERMDIRS = 'Επιλέξτε αυτή την επιλογή για να ορίσετε τα δικαιώματα των καταλόγων που θα δημιουργηθούν από τώρα και στο εξής';
	public $A_COMP_CONF_NCHMODDIRS = 'Μην CHMOD τους νέους καταλόγους (χρησιμοποίησε τις ρυθμίσεις του εξυπηρετητή)';
	public $A_COMP_CONF_CHAPFLAGS = 'Τσεκάρωντας αυτή την επιλογή το Elxis θα ασκήσει τα επιλεγμένα δικαιώματα σε <em>όλα τα υπάρχοντα αρχεία</em> του ιστότοπου.<br /><strong>ΕΣΦΑΛΜΕΝΗ ΧΡΗΣΗ ΑΥΤΗΣ ΤΗΣ ΔΥΝΑΤΟΤΗΤΑΣ ΜΠΟΡΕΙ ΝΑ ΚΑΤΑΣΤΗΣΕΙ ΤΟΝ ΙΣΤΟΤΟΠΟ ΜΗ ΛΕΙΤΟΥΡΓΙΚΟ!</strong>';
	public $A_COMP_CONF_CHAPDLAGS = 'Τσεκάρωντας αυτή την επιλογή το Elxis θα ασκήσει τα επιλεγμένα δικαιώματα σε <em>όλους τους υπάρχοντες καταλόγους</em> του ιστότοπου.<br /><strong>ΕΣΦΑΛΜΕΝΗ ΧΡΗΣΗ ΑΥΤΗΣ ΤΗΣ ΔΥΝΑΤΟΤΗΤΑΣ ΜΠΟΡΕΙ ΝΑ ΚΑΤΑΣΤΗΣΕΙ ΤΟΝ ΙΣΤΟΤΟΠΟ ΜΗ ΛΕΙΤΟΥΡΓΙΚΟ!</strong>';
	public $A_COMP_CONF_APPEXDIRS = 'Εφαρμογή σε όλους τους υπάρχοντες καταλόγους';
	public $A_COMP_CONF_APPEXFILES = 'Εφαρμογή στα υπάρχοντα αρχεία';
	public $A_COMP_CONF_WORLD = 'Όλοι';
	public $A_COMP_CONF_CHMODNDIRS = 'CHMOD τους νέους καταλόγους';
	public $A_COMP_CONF_MAIL = 'Ταχυδρομητής';
	public $A_COMP_CONF_MAIL_FROM = 'Αποστολή Αλληλογραφίας από';
	public $A_COMP_CONF_MAIL_FROM_NAME = 'Εμφανιζόμενο Όνομα Αποστολέα';
	public $A_COMP_CONF_MAIL_SMTP_AUTH = 'Πιστοποίηση SMTP';
	public $A_COMP_CONF_MAIL_SMTP_USER = 'Χρήστης SMTP';
	public $A_COMP_CONF_MAIL_SMTP_PASS = 'Κωδικός SMTP';
	public $A_COMP_CONF_MAIL_SMTP_HOST = 'Φιλοξενητής SMTP';
	public $A_COMP_CONF_CACHE = 'Προσωρινή Μνήμη';
	public $A_COMP_CONF_CACHE_FOLDER = 'Κατάλογος Προσωρινής Μνήμης';
	public $A_COMP_CONF_CACHE_DIR = 'Ο τρέχων κατάλογος προσωρινής μνήμης είναι';
	public $A_COMP_CONF_CACHE_DIR_UNWRT = 'Ο κατάλογος προσωρινής μνήμης είναι ΜΗ ΕΓΓΡΑΨΙΜΟΣ. Παρακαλούμε, προτού ενεργοποιήσετε τη προσωρινη μνήμη, θέστε τα δικαιώματα αυτού του καταλόγου στη τιμή 777.';
	public $A_COMP_CONF_CACHE_TIME = 'Χρόνος Προσωρινής Αποθήκευσης';
	public $A_COMP_CONF_STATS = 'Στατιστικά';
	public $A_COMP_CONF_STATS_ENABLE = 'Ενεργοποίηση/Απενεργοποιήση συλλογής στατιστικών για τον ιστότοπο';
	public $A_COMP_CONF_STATS_LOG_HITS = 'Καταγραφή των εμφανίσεων του περιεχομένου ανά Ημέρα';
	public $A_COMP_CONF_STATS_WARN_DATA = 'ΠΡΟΕΙΔΟΠΟΙΗΣΗ : Θα συγκεντρώνονται μεγάλα ποσά δεδομένων';
	public $A_COMP_CONF_STATS_LOG_SEARCH = 'Καταγραφή των Λέξεων από την Αναζήτηση';
	public $A_COMP_CONF_SEO_LBL = 'ΒΜΑ (SEO)';
	public $A_COMP_CONF_SEO = 'Βελτιστοποίηση για Μηχανές Αναζήτησης';
	public $A_COMP_CONF_SEO_SEFU = 'URL Φιλικές στις Μηχανές Αναζήτησης';
	public $A_COMP_CONF_SEOBASIC = 'Βασικό SEO';
	public $A_COMP_CONF_SEOPRO = 'Προχωρημένο SEO';
	public $A_COMP_CONF_SEOHELP = "Apache, Lighttpd και IIS. Apache, Lighttpd: μετονομάστε το htaccess.txt σε .htaccess πριν το ενεργοποιήσετε (mod_rewrite ενεργό). IIS: χρησιμοποιήστε το φίλτρο Ionic Isapi Rewriter. Για μέγιστη απόδοση προετοιμάστε το περιεχόμενό σας πριν ενεργοποιήστε το Προχωρημένο SEO. Επιλέξτε το Βασικό SEO αν θέλετε να χρησιμοποιήσετε ένα SEF component τρίτου κατασκευαστή.";
	public $A_COMP_CONF_SERVER = 'Εξυπηρετητής';
	public $A_COMP_CONF_METADATA = 'Meta-Δεδομένα';
	public $A_COMP_CONF_CACHE_TAB = 'Προσωρινή Μνήμη';
	public $A_COMP_CONF_FTP_LBL = 'FTP';
	public $A_COMP_CONF_FTP = 'Ρυθμίσεις FTP';
	public $A_COMP_CONF_FTP_ENB = 'Ενεργοποίηση FTP';
	public $A_COMP_CONF_FTP_HST = 'Φιλοξενητής FTP';
	public $A_COMP_CONF_FTP_HSTTP = 'Πιθανότερο';
	public $A_COMP_CONF_FTP_USR = 'Όνομα χρήστη λογαριασμού FTP';
	public $A_COMP_CONF_FTP_USRTP = 'Πιθανότερο';
	public $A_COMP_CONF_FTP_PAS = 'Κωδικός πρόσβασης λογαριασμού FTP';
	public $A_COMP_CONF_FTP_PRT = 'Θύρα FTP';
	public $A_COMP_CONF_FTP_PRTTP = 'Η προκαθορισμένη τιμή είναι: 21';
	public $A_COMP_CONF_FTP_PTH = 'Διαδρομή από FTP Root';
	public $A_COMP_CONF_FTP_PTHTP = 'Η διαδρομή από το FTP root στην εγκατάσταση του Elxis. Π.χ. /public_html/elxis';
	public $A_COMP_CONF_HIDE = 'Απόκρυψη';
	public $A_COMP_CONF_SHOW = 'Εμφάνιση';
	public $A_COMP_CONF_DEFAULT = 'Προκαθορισμένο του Συστήματος';
	public $A_COMP_CONF_NONE = 'Κανένα';
	public $A_COMP_CONF_SIMPLE = 'Απλό';
	public $A_COMP_CONF_MAX = 'Μέγιστο';
	public $A_COMP_CONF_MAIL_FC = 'Συνάρτηση mail της PHP';
	public $A_COMP_CONF_SEND = 'Χρήση Sendmail';
	public $A_COMP_CONF_SENDP = 'Διαδρομή Sendmail';
	public $A_COMP_CONF_SMTP = 'Χρήση εξυπηρετητή SMTP';
	public $A_COMP_CONF_UPDATED = 'Οι Γενικές Ρυθμίσεις ενημερώθηκαν!';
	public $A_COMP_CONF_ERR_OCC = 'Συνέβει ένα σφάλμα! Δε στάθηκε δυνατό το άνοιγμα του αρχείου ρυθμίσεων για ενημέρωση!';
	public $A_COMP_CONF_READ = 'ανάγνωση';
	public $A_COMP_CONF_WRITE = 'εγγραφή';
	public $A_COMP_CONF_EXEC = 'εκτέλεση';
	public $A_COMP_CONF_FCRE = 'Δημιουργία Αρχείου';
	public $A_COMP_CONF_FPERM = 'Δικαιώματα Αρχείου';
	public $A_COMP_CONF_DCRE = 'Δημιουργία Καταλόγου';
	public $A_COMP_CONF_DPERM = 'Δικαιώματα Καταλόγου';
	public $A_COMP_CONF_OFFEX = 'Ναι (όχι για τους Υπερ-Διαχειριστές)';
	public $A_COMP_CONF_RTF = 'Εικονίδιο RTF';

	//2008.1
	public $A_C_CONF_AC_ACT = 'Ενεργοποίηση Λογαριασμού';
	public $A_C_CONF_NOACT = 'Όχι ενεργοποίηση';
	public $A_C_CONF_EMACT = 'Ενεργοποίηση μέσω e-mail';
	public $A_C_CONF_MANACT = 'Χειροκίνητη ενεργοποίηση';
	public $A_C_CONF_AC_ACTD = 'Επιλέξτε πως θέλετε να ενεργοποιούνται οι νέοι λογαριασμοί. Κατευθείαν, μέσω δεσμού ενεργοποίησης σε e-mail ή χειροκίνητα από το διαχειριστή του ιστότοπου.';

	//2009.0
	public $A_C_CONF_COMMENTS = 'Σχόλια';
	public $A_C_CONF_COMMENTSTIP = 'Εάν το θέσετε σε ναι, θα εμφανίζεται ο αριθμός σχολίων ενός αντικειμένου. Αυτή η γενική ρύθμιση μπορεί να παρακαμφθεί για μεμονωμένα αντικείμενα και μενού';
	public $A_C_CONF_CHKFTP = 'Έλεγχος ρυθμίσεων FTP';
	public $A_C_CONF_STDCACHE = 'Τυπική μνήμη';
	public $A_C_CONF_STATCACHE = 'Στατική μνήμη';
	public $A_C_CONF_CACHED = 'Η Τυπική Μνήμη αποθηκεύει επιμέρους τμήματα της σελίδας ενώ η Στατική ολόκληρη την σελίδα. Η Στατική Μνήμη συστίνεται για ιστότοπους με υψηλό φόρτο επισκεπτών. Για να χρησιμοποιήσετε την Στατική Μνήμη απαιτείται να είναι ενεργοποιημένο το SEO PRO.';
	public $A_C_CONF_SEODIS = 'Το SEO PRO είναι ανενεργό!';

	public function __construct() {	
	}

}

?>