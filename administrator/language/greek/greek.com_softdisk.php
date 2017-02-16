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
* @description: Greek language for component softdisk
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CORE = 'Πυρήνας';
public $A_ASTATS = 'Στατιστικά Διαχείρισης';
public $A_VALUE = 'Τιμή';
public $A_LASTMOD = 'Τελευταία τροποποίηση';
public $A_OS = 'Λειτουργικό Σύστημα';
public $A_ELXIS_VERSION = 'Έκδοση Elxis';
public $A_SELECT = 'Επιλέξτε';
public $NOEDITSYS = 'Δεν επιτρέπεται η επεξεργασία εγγραφών του Συστήματος';
public $A_RESTORE = 'Επαναφορά';
public $SOFTDISK_HELP = 'Το SoftDisk είναι μία εικονική αποθήκη μεταβλητών και παραμέτρων κάθε είδους.<br />
Μπορείτε να προσθέτετε νέες ή να επεξεργάζεστε/διαγράφετε υπάρχουσες εγγραφές στο SoftDisk εκτός από αυτές που εμφανίζονται ότι 
ανήκουν στο σύστημα. Επίσης τις σημειωμένες ως "Μη-Διαγράψιμες" εγγραφές μπορείτε μόνο να τις επεξεργαστείτε. Για την ονοματοδοσία 
των τομέων και των ονομάτων των μεταβλητών μπορείτε μόνο να χρησιμοποιείτε <strong>κεφαλαίους λατινικούς χαρακτήρες, ψηφία και κάτω παύλα (_)</strong>.';
public $YCNOTEDITP = 'Δεν μπορείτε να επεξεργαστείτε αυτή την παράμετρο';
public $UNDELETABLE = 'Μη διαγράψιμο';
public $SOFTENTRYEXIST = 'Υπάρχει ήδη μία εγγραφή στο SoftDisk με αυτό το όνομα!';
public $INVSECTNAME = 'Άκυρο όνομα τομέα!';
public $INVNAME = 'Άκυρο όνομα!';
public $INVEMAIL = 'Η παρεχόμενη τιμή δεν αντιστοιχεί σε μία έγκυρη διεύθυνση e-mail!';
public $INVURL = 'Η παρεχόμενη τιμή δεν αντιστοιχεί σε μία έγκυρη URL!';
public $INVDEC = 'Η παρεχόμενη τιμή δεν αντιστοιχεί σε έναν έγκυρο δεκαδικό αριθμό!';
public $INVTSTAMP = 'Η παρεχόμενη τιμή δεν αντιστοιχεί σε έγκυρο χρόνο UNIX!';
public $UPSYSTEM = 'Ενημέρωση συστήματος';
public $A_USERPROFILE = 'Προφίλ χρήστη';
public $UPROF_WEBSITE = 'Ιστοσελίδα';
public $UPROF_AIM = 'AIM';
public $UPROF_YIM = 'YIM';
public $UPROF_MSN = 'MSN';
public $UPROF_ICQ = 'ICQ';
public $UPROF_EMAIL = 'E-mail';
public $UPROF_PHONE = 'Τηλέφωνο';
public $UPROF_MOBILE = 'Κινητό τηλέφωνο';
public $UPROF_BIRTHDATE = 'Ημερομηνία γέννησης';
public $UPROF_GENDER = 'Φύλο';
public $UPROF_LOCATION = 'Τοποθεσία';
public $UPROF_OCCUPATION = 'Επάγγελμα';
public $UPROF_SIGNATURE = 'Υπογραφή';
public $UPROF_ARTICLES = 'Αριθμός άρθρων';
public $UPROF_USERGROUP = 'Ομάδα χρήστη';
public $UPROF_RANDUSERS = 'Εμφάνιση τυχαίων χρηστών στη σελίδα προφίλ';
public $USERS_RPASSMAIL = 'Ειδοποίηση διαχειριστών σε υποβολή υπενθύμισης κωδικού';
public $SUBMIT_CATEGORIES = 'Κατηγορίες στις οποίες επιτρέπεται η υποβολή περιεχομένου (προτεινόμενες). Αν κενό επιτρέπεται σε όλες. (ID κατηγοριών χωρισμένα με κόμμα)';
public $SUBMIT_SECTIONS = 'Ενότητες στις οποίες επιτρέπεται η υποβολή περιεχομένου (προτεινόμενες). Αν κενό επιτρέπεται σε όλες. (ID ενοτήτων χωρισμένα με κόμμα)';
public $REG_AGREE = 'Κωδικός αυτόνομης σελίδας για Όρους εγγραφής. Μηδέν (0) για απενεργοποίηση. Για όρους ανάλογα με τη γλώσσα δημιουργήστε για κάθε γλώσσα μία εγγραφή στο SoftDisk στον τομέα ΧΡΗΣΤΕΣ με όνομα REG_AGREE_ΓΛΩΣΣΑ-ΕΔΩ τύπου Ακεραίου';
public $A_WEBLINKS = 'Συνδέσεις';
public $TOP_WEBLINK = 'Ορίζει την εμφάνιση ή όχι του module Top Weblinks εντός του component Weblinks';
public $A_USERSLIST = 'Κατάλογος χρηστών';
public $ULIST_ONLINE = 'Κατάσταση σύνδεσης';
public $ULIST_USERNAME = 'Ψευδώνυμο';
public $ULIST_NAME = 'Όνομα';
public $ULIST_REGDATE = 'Ημερομηνία εγγραφής';
public $ULIST_PREFLANG = 'Γλώσσα προτίμησης';
public $STATICCACHE = 'Στατική μνήμη';

}

?>