<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ilias Antonopoulos
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Greek Gemini Language File
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//filemanager/ftp
DEFINE('_GEM_UNKN_ERR', 'Άγνωστο σφάλμα');
DEFINE('_GEM_CNOT_UPFTP', 'Δε στάθηκε δυνατή η αποστολή του αρχείου στο διακομιστή FTP.');
DEFINE('_GEM_CNOT_CONFTP', 'Δε στάθηκε δυνατή η σύνδεση με το διακομιστή FTP.');
DEFINE('_GEM_FCPERM_UPFILE', 'Αποτυχία αλλαγής αδειών χρήσης του σταλθέντος αρχείου.');
DEFINE('_GEM_FMOVE_UPFILE', 'Αποτυχία μετακίνησης του σταλθέντος αρχείου στον κατάλογο προορισμού.');
DEFINE('_GEM_CNOT_COPYF', 'Δε στάθηκε δυνατή η αντιγραφή του αρχείου.');
//translator
DEFINE('_GEM_TRNOTHING', 'Δεν υπάρχει τίποτα για μετάφραση!');
DEFINE('_GEM_TRINV_INOUT', 'Άκυρο ζεύγος γλώσσας εισόδου/εξόδου');
DEFINE('_GEM_CNOT_CRFILE', 'Αδυναμία δημιουργίας απαιτούμενου αρχείου');
DEFINE('_GEM_MUST_WRITE', 'πρέπει να είναι εγγράψιμο!');
DEFINE('_GEM_CNOT_TRANS', 'Αδυναμία μετάφρασης!');
//Content Legend (/includes/Core/elxis.php function ContentLegend)
DEFINE('_GEM_PUBLISHED_PEND', 'Δημοσιευμένο αλλά σε <u>Αναμονή</u>');
DEFINE('_GEM_PUBLISHED_CURRENT', 'Δημοσιευμένο και είναι <u>Τρέχον</u>');
DEFINE('_GEM_PUBLISHED_EXPIRED', 'Δημοσιευμένο, αλλά έχει <u>Λήξει</u>');
DEFINE('_GEM_PUBLISHED_NOT', 'Μη Δημοσιευμένο');
DEFINE('_GEM_TOGGLE_STATE', 'Κάντε κλικ σε ένα εικονίδιο για να αλλάξετε τη κατάστασή του.');
DEFINE('_GEM_PENDING', 'Σε αναμονή');
DEFINE('_GEM_VISIBLE', 'Ορατό');
DEFINE('_GEM_INVISIBLE', 'Μη Ορατό');
///include/core/elxisp.php function sortIcon
DEFINE('_GEM_SORT_NONE', 'Άλλαξε σε Καμία');
DEFINE('_GEM_SORT_ASC', 'Άλλαξε σε Αύξουσα');
DEFINE('_GEM_SORT_DESC', 'Άλλαξε σε Φθίνουσα');
//date format
DEFINE('_GEM_DATE_FORMLC', "%A, %d %B %Y"); //Note: Uses PHP's strftime Command Format
DEFINE('_GEM_DATE_FORMLC2', "%A, %d %B %Y %H:%M");
//elxis.php
DEFINE('_GEM_YES', "Ναι");
DEFINE('_GEM_NO','Όχι');
DEFINE('_GEM_NONE','Κανένα');
DEFINE('_GEM_LEFT','Αριστερά');
DEFINE('_GEM_RIGHT','Δεξιά');
DEFINE('_GEM_CENTER','Κέντρο');
DEFINE('_GEM_CANCEL','Ακύρωση');
DEFINE('_GEM_NO_PARAMS','Δεν υπάρχουν Παράμετροι γι\' αυτό το αντικείμενο');
DEFINE('_GEM_PUBL_ITEM','Αποδημοσίευση Αντικειμένου');
DEFINE('_GEM_UNPUBL_ITEM','Δημοσίευση Αντικειμένου');
DEFINE('_GEM_WRITABLE','Εγγράψιμο');
DEFINE('_GEM_UNWRITABLE','Μη Εγγράψιμο');
DEFINE('_GEM_PARNAV','Γονικό παράθυρο με πλοήγηση φυλλομετρητή');
DEFINE('_GEM_NEWNAV','Νέο παράθυρο με πλοήγηση φυλλομετρητή');
DEFINE('_GEM_NEWNONAV','Νέο Παράθυρο χωρίς πλοήγηση φυλλομετρητή');
// components/com_weblinks/weblinks.class.php
DEFINE('_GEM_WEBLINK_TITLE','Πρέπει να δωθεί ένας τίτλος στον σύνδεσμό σας.');
DEFINE('_GEM_WEBLINK_EXIST','Υπάρχει ήδη σύνδεσμος με αυτό το όνομα, παρακαλώ προσπαθήστε ξανά επιλέγοντας άλλο όνομα.');
//New User Account from Administration
DEFINE('_NEW_USER_MESSAGE_SUBJECT','Λεπτομέρειες Νέου Χρήστη.');
DEFINE('_NEW_USER_MESSAGE','Γεια σου %s,
Έχεις προστεθεί σα μέλος στο %s  από έναν Διαχειριστή.
Αυτό το email περιέχει το ψευδώνυμο και το συνθηματικό για να συνδεθείς στο %s:
Ψευδώνυμο - %s 
Συνθηματικό - %s 
Παρακαλούμε μην απαντήσεις σε αυτό το μήνυμα καθώς δημιουργείται αυτόματα και εξυπηρετεί μόνο πληροφοριακούς σκοπούς');
//2006.4
//User registration
DEFINE('_GEM_REGWARN_NAME','Παρακαλούμε εισάγετε το Όνομά σας.');
DEFINE('_GEM_REGWARN_UNAME','Παρακαλούμε εισάγετε ένα Ψευδώνυμο.');
DEFINE('_GEM_REGWARN_MAIL','Παρακαλούμε εισάγετε μία έγκυρη διεύθυνση Email.');
DEFINE('_GEM_REGWARN_INUSE','Το Ψευδώνυμο/Κωδικός Πρόσβασης χρησιμοποιείται ήδη. Παρακαλούμε επιλέξτε κάποιο άλλο.');
DEFINE('_GEM_REGWARN_EMAIL_INUSE', 'Αυτό το e-mail χρησιμοποιείται ήδη. Αν ξεχάσατε τον Κωδικό Πρόσβασής σας, κάντε κλικ στο "Υπενθύμιση Κωδικού Πρόσβασης" και θα σας σταλεί ένας νέος.');
DEFINE('_GEM_VALID_AZ09',"Παρακαλούμε εισάγετε ένα έγκυρο %s.  Χωρίς κενά, με περισσότερους από %d χαρακτήρες και να περιέχει μόνο κάποιους από τους χαρακτήρες 0-9,a-z,A-Z");

//2008
DEFINE('_GEM_RTL', 0);

?>
