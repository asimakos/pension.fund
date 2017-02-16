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
* @description: Greek language for component admin
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CADMIN_CLEAR_RES = 'Καθαρισμός Αποτελεσμάτων';
public $A_COMP_ADMIN_TITLE = 'Πίνακας Ελέγχου';
public $A_COMP_ADMIN_INFO = 'Πληροφορίες';
public $A_COMP_ADMIN_SYSTEM = 'Πληροφορίες Συστήματος';
public $A_COMP_ADMIN_PHP_BUILT_ON = 'Η PHP τρέχει στο:';
public $A_COMP_ADMIN_DB = 'Έκδοση Βάσης Δεδομένων:';
public $A_COMP_ADMIN_PHP_VERSION = 'Έκδοση PHP:';
public $A_COMP_ADMIN_SERVER = 'Web Server:';
public $A_COMP_ADMIN_SERVER_TO_PHP = 'Διασύνδεση Web Server με PHP:';
public $A_COMP_ADMIN_AGENT = 'Περιηγητής:';
public $A_COMP_ADMIN_SETTINGS = 'Σχετικές Ρυθμίσεις της PHP:';
public $A_COMP_ADMIN_MODE = 'Safe Mode:';
public $A_COMP_ADMIN_BASEDIR = 'Open basedir:';
public $A_COMP_ADMIN_ERRORS = 'Εμφάνιση Σφαλμάτων:';
public $A_COMP_ADMIN_OPEN_TAGS = 'Short Open Tags:';
public $A_COMP_ADMIN_FILE_UPLOADS = 'Ανέβασμα Αρχείων:';
public $A_COMP_ADMIN_QUOTES = 'Magic Quotes:';
public $A_COMP_ADMIN_REG_GLOBALS = 'Register Globals:';
public $A_COMP_ADMIN_OUTPUT_BUFF = 'Output Buffering:';
public $A_COMP_ADMIN_S_SAVE_PATH = 'Session save path:';
public $A_COMP_ADMIN_S_AUTO_START = 'Session auto start:';
public $A_COMP_ADMIN_XML = 'Ενεργοποιημένη XML:';
public $A_COMP_ADMIN_ZLIB = 'Ενεργοποιημένη Zlib:';
public $A_COMP_ADMIN_DISABLED = 'Απενεργοποιημένες Λειτουργίες:';
public $A_COMP_ADMIN_WYSIWYG = 'Κειμενογράφος WYSIWYG:';
public $A_COMP_ADMIN_CONF_FILE = 'Αρχείο Ρυθμίσεων:';
public $A_COMP_ADMIN_PHP_INFO = 'Πληροφορίες για τη PHP';
public $A_COMP_ADMIN_DIR_PERM = 'Δικαιώματα Καταλόγων';
public $A_COMP_ADMIN_FOR_ALL = 'Για να λειτουργεί σωστά το Elxis, θα πρέπει όλοι οι ακόλουθοι κατάλογοι να είναι <u>εγγράψιμοι</u>:';
public $A_COMP_ADMIN_CREDITS = 'Εύσημα';
public $A_COMP_ADMIN_APP = 'Εφαρμογή';
public $A_COMP_ADMIN_LICENSE = 'Άδεια Χρήσης';
public $A_COMP_ADMIN_CALENDAR = 'Ημερολόγιο';
public $A_COMP_ADMIN_PUB_DOMAIN = 'Public Domain';
public $A_COMP_ADMIN_ICONS = 'Εικονίδια';
public $A_COMP_ADMIN_INDEX = 'Περιεχόμενα';
public $A_COMP_ADMIN_OPEN_NEW_WIN = 'Άνοιγμα σε νέο παράθυρο';
public $A_COMP_ADMIN_SITE_PREVIEW = 'Προεπισκόπηση Ιστότοπου';
public $A_COMP_ADMIN_PERMISSIONS = 'Δικαιώματα';
public $A_COMP_ALERT_NO_LINK = 'Δεν υπάρχουν σύνδεσμοι που να σχετίζονται με αυτό το αντικείμενο';
public $A_COPY_REGUNREGISTERED = 'Η εγκατάσταση του Elxis σας δεν έχει δηλωθεί!<br />Παρακαλούμε δηλώστε την πηγαίνοντας στα Εργαλεία -> Δήλωση Elxis';
//Tools
public $A_CMP_ADMIN_TTITLE = 'Εργαλεία Elxis';
public $A_CMP_ADMIN_TTOOLS = 'Εργαλεία';
public $A_CMP_ADMIN_TINSTTOOLS = 'Εγκατεστημένα Εργαλεία';
public $A_CMP_ADMIN_RUNTOOL = 'Εκτέλεση Εργαλείου';
public $A_CMP_ADMIN_DESCR = '<strong>Καλώς ήρθατε στα εργαλεία του Elxis</strong><br /><br />
Τα εργαλεία είναι μικρές χρηστικές εφαρμογές.<br /><br />Κάποια μπορεί να επηρεάζουν τη λειτουργία του Elxis, όπως 
ο Καθαρισμός Προχείρου και η Διόρθωση Γλώσσας. Άλλα, είναι ανεξάρτητα όπως ο Υπολογιστής και το Organizer.<br /><br />
Μπορείτε να προσθέσετε επιπλέον εργαλεία. Εργαλεία που πιστεύετε ότι θα σας βοηθήσουν στη καθημερινή χρήση του Elxis.<br />
Τα εργαλεία είναι διαθέσιμα μόνο στο περιβάλλον της διαχείρισης.';
public $A_SESSIONDUR = 'Διάρκεια συνεδρίας';
public $A_WISHLOUT = 'Θέλετε πραγματικά να αποσυνδεθείτε;';

}

?>
