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
* @description: Greek Gemini Language File
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//filemanager/ftp
define('_GEM_UNKN_ERR', 'Άγνωστο σφάλμα');
define('_GEM_CNOT_UPFTP', 'Δε στάθηκε δυνατή η αποστολή του αρχείου στο διακομιστή FTP.');
define('_GEM_CNOT_CONFTP', 'Δε στάθηκε δυνατή η σύνδεση με το διακομιστή FTP.');
define('_GEM_FCPERM_UPFILE', 'Αποτυχία αλλαγής αδειών χρήσης του σταλθέντος αρχείου.');
define('_GEM_FMOVE_UPFILE', 'Αποτυχία μετακίνησης του σταλθέντος αρχείου στον κατάλογο προορισμού.');
define('_GEM_CNOT_COPYF', 'Δε στάθηκε δυνατή η αντιγραφή του αρχείου.');
//translator
define('_GEM_TRNOTHING', 'Δεν υπάρχει τίποτα για μετάφραση!');
define('_GEM_TRINV_INOUT', 'Άκυρο ζεύγος γλώσσας εισόδου/εξόδου');
define('_GEM_CNOT_CRFILE', 'Αδυναμία δημιουργίας απαιτούμενου αρχείου');
define('_GEM_MUST_WRITE', 'πρέπει να είναι εγγράψιμο!');
define('_GEM_CNOT_TRANS', 'Αδυναμία μετάφρασης!');
//Content Legend (/includes/Core/elxis.php function ContentLegend)
define('_GEM_PUBLISHED_PEND', 'Δημοσιευμένο αλλά σε <u>Αναμονή</u>');
define('_GEM_PUBLISHED_CURRENT', 'Δημοσιευμένο και είναι <u>Τρέχον</u>');
define('_GEM_PUBLISHED_EXPIRED', 'Δημοσιευμένο, αλλά έχει <u>Λήξει</u>');
define('_GEM_PUBLISHED_NOT', 'Μη Δημοσιευμένο');
define('_GEM_TOGGLE_STATE', 'Κάντε κλικ σε ένα εικονίδιο για να αλλάξετε τη κατάστασή του.');
define('_GEM_PENDING', 'Σε αναμονή');
define('_GEM_VISIBLE', 'Ορατό');
define('_GEM_INVISIBLE', 'Μη Ορατό');
///include/core/elxisp.php function sortIcon
define('_GEM_SORT_NONE', 'Άλλαξε σε Καμία');
define('_GEM_SORT_ASC', 'Άλλαξε σε Αύξουσα');
define('_GEM_SORT_DESC', 'Άλλαξε σε Φθίνουσα');
//date format
define('_GEM_DATE_FORMLC', "%A, %d %B %Y"); //Note: Uses PHP's strftime Command Format
define('_GEM_DATE_FORMLC2', "%A, %d %B %Y %H:%M");
//elxis.php
define('_GEM_YES', "Ναι");
define('_GEM_NO','Όχι');
define('_GEM_NONE','Κανένα');
define('_GEM_LEFT','Αριστερά');
define('_GEM_RIGHT','Δεξιά');
define('_GEM_CENTER','Κέντρο');
define('_GEM_CANCEL','Ακύρωση');
define('_GEM_NO_PARAMS','Δεν υπάρχουν Παράμετροι γι\' αυτό το αντικείμενο');
define('_GEM_PUBL_ITEM','Αποδημοσίευση Αντικειμένου');
define('_GEM_UNPUBL_ITEM','Δημοσίευση Αντικειμένου');
define('_GEM_WRITABLE','Εγγράψιμο');
define('_GEM_UNWRITABLE','Μη Εγγράψιμο');
define('_GEM_PARNAV','Γονικό παράθυρο με πλοήγηση φυλλομετρητή');
define('_GEM_NEWNAV','Νέο παράθυρο με πλοήγηση φυλλομετρητή');
define('_GEM_NEWNONAV','Νέο Παράθυρο χωρίς πλοήγηση φυλλομετρητή');
// components/com_weblinks/weblinks.class.php
define('_GEM_WEBLINK_TITLE','Πρέπει να δωθεί ένας τίτλος στον σύνδεσμό σας.');
define('_GEM_WEBLINK_EXIST','Υπάρχει ήδη σύνδεσμος με αυτό το όνομα, παρακαλώ προσπαθήστε ξανά επιλέγοντας άλλο όνομα.');
//New User Account from Administration
define('_NEW_USER_MESSAGE_SUBJECT','Λεπτομέρειες Νέου Χρήστη.');
define('_NEW_USER_MESSAGE','Γεια σου %s,
Έχεις προστεθεί σα μέλος στο %s  από έναν Διαχειριστή.
Αυτό το email περιέχει το ψευδώνυμο και το συνθηματικό για να συνδεθείς στο %s:
Ψευδώνυμο - %s 
Συνθηματικό - %s 
Παρακαλούμε μην απαντήσεις σε αυτό το μήνυμα καθώς δημιουργείται αυτόματα και εξυπηρετεί μόνο πληροφοριακούς σκοπούς');
//2006.4
//User registration
define('_GEM_REGWARN_NAME','Παρακαλούμε εισάγετε το Όνομά σας.');
define('_GEM_REGWARN_UNAME','Παρακαλούμε εισάγετε ένα Ψευδώνυμο.');
define('_GEM_REGWARN_MAIL','Παρακαλούμε εισάγετε μία έγκυρη διεύθυνση Email.');
define('_GEM_REGWARN_INUSE','Το Ψευδώνυμο/Κωδικός Πρόσβασης χρησιμοποιείται ήδη. Παρακαλούμε επιλέξτε κάποιο άλλο.');
define('_GEM_REGWARN_EMAIL_INUSE', 'Αυτό το e-mail χρησιμοποιείται ήδη. Αν ξεχάσατε τον Κωδικό Πρόσβασής σας, κάντε κλικ στο "Υπενθύμιση Κωδικού Πρόσβασης" και θα σας σταλεί ένας νέος.');
define('_GEM_VALID_AZ09',"Παρακαλούμε εισάγετε ένα έγκυρο %s.  Χωρίς κενά, με περισσότερους από %d χαρακτήρες και να περιέχει μόνο κάποιους από τους χαρακτήρες 0-9,a-z,A-Z");

//2008
define('_GEM_RTL', 0);

?>
