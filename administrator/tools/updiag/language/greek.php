<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Elxis Team
* @translator: Ioannis Sannos
* @translator URL: http://www.elxis.org
* @translator E-mail: info@elxis.org
* @description: Greek language for Updiag tool
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class updiagLang {

	public $UPDATE = 'Ενημέρωση';
	public $CHVERS = 'Έλεγχος έκδοσης';
	public $CNOTGETELXD = 'Δεν στάθηκε δυνατή η λήψη δεδομένων από το elxis.org';
	public $INVXML = 'Λήφθηκε ένα άκυρο αρχείο XML. Δεν είναι δυνατή η εμφάνιση των πληροφοριών που ζητήσατε.';
	public $SIZE = 'Μέγεθος';
	public $MORE = 'Περισσότερα';
	public $DOWNLOAD = 'Λήψη';
	public $INSELXVER = 'Εγκατεστημένη έκδοση Elxis';
	public $CURRENT = 'Τρέχουσα';
	public $OUTDATED = 'Ξεπερασμένη!';
	public $NEWVERAV = 'Υπάρχει διαθέσιμη μία νεότερη έκδοση του Elxis. Παρακαλούμε αναβαθμίστε την εγκατάστασή σας το συντομότερο δυνατό.';
	public $CHPATCHES = 'Έλεγχος πακέτων ενημέρωσης';
	public $NOPATCHES = 'Δεν υπάρχουν διαθέσιμα πακέτα ενημέρωσης για την έκδοση Elxis που χρησιμοποιείτε';
	public $PROSUPPORT = 'Επαγγελματική υποστήριξη';
	public $NEWS = 'Νέα/Ειδήσεις';
	public $MAINTENANCE = 'Συντήρηση';
	public $REMOTEERR1 = 'Άκυρη αίτηση';
	public $REMOTEERR2 = 'Δεν στάθηκε δυνατή η λήψη της λίστας των scripts';
	public $REMOTEERR3 = 'Δεν βρέθηκαν scripts';
	public $REMOTEERR4 = 'Το αρχείο που ζητήσατε είναι κενό';
	public $REMOTEERR5 = 'Δεν στάθηκε δυνατή η λήψη της λίστας των αρχείων hash';
	public $REMOTEERR6 = 'Δεν βρέθηκαν αρχεία hash';
	public $REMOTEERR7 = 'Δεν στάθηκε δυνατή η λήψη του αρχείου που ζητήσατε!';
	public $UNERROR = 'Άγνωστο σφάλμα';
	public $PROVCODE = 'Παρέχει κώδικα για αναβάθμιση του Elxis από την έκδοση';
	public $TOVERSION = 'στην έκδοση';
	public $INSTALLED = 'Εγκατεστημένο';
	public $REQFEXISTS = 'Το αρχείο που ζητήσατε υπάρχει ήδη!';
	public $FILDOWNSUC = 'Το αρχείο λήφθηκε επιτυχώς!';
	public $DFORRUNSCR = 'Μην ξεχάσετε να εκτελέσετε αυτό το script σε περίπτωση που επιθυμείτε την ενημέρωση του εγκατεστημένου Elxis σας';
	public $CNOTCPDFIL = 'Δε στάθηκε δυνατή η αντιγραφή του ληφθέντος αρχείου στον κατάλογο προορισμού.';
	public $PLCHSCRPERM = 'Παρακαλώ ελέγξτε τις άδειες χρήσης του καταλόγου /administrator/tools/updiag/data/scripts';
	public $PLCHSCRPERM2 = 'Παρακαλώ ελέγξτε τις άδειες χρήσης του καταλόγου /administrator/tools/updiag/data/hashes';
	public $EXECUTE = 'Εκτέλεση';
	public $SCRNOTEX = 'Το script που ζητήσατε δεν υπάρχει!';
	public $FSCHECK = 'Έλεγχος συστήματος αρχείων';
	public $HIDEHELP = 'Απόκρυψη βοήθειας';
	public $NORMAL = 'Κανονικό';
	public $EXTENDED = 'Εκτεταμένο';
	public $FULL = 'Πλήρης';
	public $NOHASHFOUND = 'Δε βρέθηκαν αρχεία hash';
	public $INVHFILE = 'Άκυρο αρχείο hash!';
	public $SHFELXVER = 'Το επιλεγμένο αρχείο hash αντιστοιχεί σε παλαιότερη έκδοση του Elxis από τη δική σας!';
	public $FNOTEXIST = 'Το αρχείο δεν υπάρχει';
	public $WARNING = 'Προειδοποίηση';
	public $FNEEDUP = 'Το αρχείο χρειάζεται ενημέρωση';
	public $SITUP2D = 'Η ιστοσελίδα είναι ενημερωμένη!';
	public $FOUND = 'Βρέθηκαν';
	public $OUTFUP = 'μη-ενημερωμένα αρχεία. Παρακαλώ κάντε αναβάθμιση!';
	public $CHFINUS = 'Έλεγχος της κατάστασης ενημέρωσης της ιστοσελίδας με χρήση του <b>%s</b> ως πηγή';
	public $NEWRELEASES = 'Νέες κυκλοφορίες';
	public $NONEWREL = 'Δεν υπάρχουν νέες κυκλοφορίες';
	public $PRICE = 'Τιμή';
	public $LICENSE = 'Άδεια χρήσης';
	public $SECURITY = 'Ασφάλεια';
	public $INSTPATH = 'Διαδρομή εγκατάστασης';
	public $CREDITS = 'Εύσημα';
	public $ALERT = 'Συναγερμός';
	public $FSECALWA = 'Βρέθηκαν <b>%d</b> συναγερμοί και προειδοποιήσεις ασφαλείας';
	public $ELXINPAS = 'Η εγκατάσταση του Elxis σας, πέρασε επιτυχώς το βασικό έλεγχο ασφαλείας';
	public $HOME = 'Αρχική';
	public $UPDSPAG = 'Αρχική σελίδα Updiag';
	public $UPDWELC = 'Καλώς ήρθατε στο <b>Updiag</b>, το εργαλείο διάγνωσης και αναβάθμισης του Elxis.';
	public $STARTMORE = 'Οι περισσότερες λειτουργίες του Updiag απαιτούν απομακρυσμένη σύνδεση στον ιστότοπο 
	elxis.org. Συνεπώς, πρέπει να έχετε μία ανοικτή σύνδεση από την ιστοσελίδα σας προς το διαδύκτιο προκειμένου 
	αυτές οι λειτουργίες να δουλέψουν. Επιλέξτε ένα αντικείμενο από το μενού της κορυφής για πλοήγηση.';
	public $BASCHECKS = 'Βασικοί Έλεγχοι <small>(πατήστε σε ένα εικονίδιο για εκτέλεση)</small>';
	public $FILEREMSUC = 'Το αρχείο διαγράφηκε επιτυχώς!';
	public $CNREMSFILE = 'Δε στάθηκε δυνατή η διαγραφή του επιλεγμένου αρχείου! Ελέγξτε τις άδειες χρήσης του αρχείου.';
	public $HASHNOTEX = 'Το hash που ζητήσατε δεν υπάρχει!';
	public $DNHASHFLS = 'Λήψη αρχείων hash';
	public $BUY = 'Αγορά';
	public $DOWNLTIME = 'Χρόνος λήψης';
	public $DOWNLSPEED = 'Ταχύτητα λήψης';
	

	public function __construct() {
	}

}

define('CX_LUPDIAGD', 'Βοηθά να ενημερώσετε τον ιστότοπό σας, ενημερώνει για νέες κυκλοφορίες του Elxis, εκδόσεις και patches και παρέχει λειτουργίες ασφαλείας και διάγνωσης.');

?>