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
* @description: Greek language for component media
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_ME_RELPATH = 'Σχετική διαδρομή';
public $A_CMP_ME_PMOUSEVD = 'Τοποθετήστε τον κέρσορα πάνω από το εικονίδιο ενός αρχείου για να δείτε πληροφορίες για αυτό';
public $A_CMP_ME_RENAME = 'Μετονομασία';
public $A_CMP_ME_COPYTO = 'Αντιγραφή σε';
public $A_CMP_ME_NEWFOL = 'Νέος φάκελος';
public $A_CMP_ME_NEWFIL = 'Νέο αρχείο';
public $A_CMP_ME_OPEN = 'Άνοιγμα';
public $A_CMP_ME_VTHUMBS = 'Προβολή μικρογραφιών';
public $A_CMP_ME_VICONS = 'Προβολή εικονιδίων';
public $A_CMP_ME_DBCLOP = 'Διπλό κλικ για άνοιγμα του:';
public $A_CMP_ME_DIRNEX = 'Δεν υπάρχει κατάλογος <strong>%s</strong> !';
public $A_CMP_ME_FILNEX = 'Δεν υπάρχει αρχείο με όνομα <strong>%s</strong> !';
public $A_CMP_ME_PERMS = 'Άδειες χρήσης';
public $A_CMP_ME_MODIF = 'Τροποποιήθηκε';
public $A_CMP_ME_ACCESSED = 'Κλήθηκε';
public $A_CMP_ME_DOWNZIP = 'Λήψη ως συμπιεσμένο αρχείο zip';
public $A_CMP_ME_DODOWN = 'Θέλετε να κατεβάσετε τον φάκελο';
public $A_CMP_ME_ASZIP = 'ως zip;';
public $A_CMP_ME_EXTHERE = 'Αποσυμπίεση εδώ';
public $A_CMP_ME_SELFNIMG = 'Το επιλεγμένο αρχείο δεν είναι εικόνα!';
public $A_CMP_ME_FSELFCL = 'Επιλέξτε πρώτα ένα αρχείο πατώντας πάνω του';
public $A_CMP_ME_RENEWFN = 'Μετονομασία - Εισάγετε το νέο όνομα:';
public $A_CMP_ME_EXFINAME = 'Υπάρχει ήδη ένα αρχείο με όνομα %s !';
public $A_CMP_ME_EXFONAME = 'Υπάρχει ήδη ένας κατάλογος με όνομα %s !';
public $A_CMP_ME_FIRENTO = 'Το αρχείο <strong>"%s"</strong> μετονομάστηκε σε <strong>"%s"</strong>';
public $A_CMP_ME_FORENTO = 'Ο κατάλογος <strong>"%s"</strong> μετονομάστηκε σε <strong>"%s"</strong>';
public $A_CMP_ME_RENFAIL = 'Η μετονομασία απέτυχε!';
public $A_CMP_ME_ALLFIFODEL = 'Όλα τα αρχεία/κατάλογοι σε αυτό τον φάκελο θα διαγραφούν!';
public $A_CMP_ME_DELQUEST = 'Διαγραφή του "%s";';
public $A_CMP_ME_FIDELSUC = 'Το αρχείο διαγράφηκε επιτυχώς';
public $A_CMP_ME_FODELSUC = 'Ο κατάλογος διαγράφηκε επιτυχώς';
public $A_CMP_ME_DELFAIL = 'Η διαγραφή απέτυχε!';
public $A_CMP_ME_COPYTOFO = 'Αντιγραφή στον φάκελο:';
public $A_CMP_ME_SRCNEX = 'Το πηγαίο αρχείο δεν υπάρχει!';
public $A_CMP_ME_SRCISDIR = 'Η πηγή είναι κατάλογος! Δεν μπορείτε να αντιγράψετε καταλόγους.';
public $A_CMP_ME_EXFIINDIR = 'Υπάρχει ήδη ένα αρχείο με όνομα <strong>%s</strong> στον κατάλογο %s';
public $A_CMP_ME_FICOPYSUC = 'Το αρχείο <strong>%s</strong> αντιγράφηκε επιτυχώς στον κατάλογο %s';
public $A_CMP_ME_FICOPYSUC2 = 'Το αρχείο <strong>%s</strong> αντιγράφηκε επιτυχώς στον κατάλογο %s ως <strong>%s</strong>';
public $A_CMP_ME_FICOPYFAIL = 'Δεν στάθηκε δυνατή η αντιγραφή του <strong>%s</strong> στον κατάλογο %s';
public $A_CMP_ME_NEWFONAME = 'Εισάγετε το όνομα του νέου καταλόγου:';
public $A_CMP_ME_CHPERMS = 'Αλλαγή αδειών χρήσης';
public $A_CMP_ME_SIZE = 'Μέγεθος';
public $A_CMP_ME_DIMS = 'Διαστάσεις';
public $A_CMP_ME_NAMENEWFO = 'Πρέπει να δώσετε ένα όνομα στο νέο φάκελο!';
public $A_CMP_ME_FOCRESUC = 'Ο κατάλογος <strong>%s</strong> δημιουργήθηκε επιτυχώς';
public $A_CMP_ME_CNCRNEWFO = 'Δεν στάθηκε δυνατή η δημιουργία του νέου φακέλου!';
public $A_CMP_ME_INVPERMS = 'Άκυρες άδειες χρήσης!';
public $A_CMP_ME_PERMCHSUC = 'Η άδειες του αρχείου άλλαξαν επιτυχώς σε <strong>%s</strong>';
public $A_CMP_ME_CHMODFAIL = 'Η αλλαγή αδειών χρήσης απέτυχε!';
public $A_CMP_ME_SELFIUP = 'Επιλέξτε ένα αρχείο για αποστολή';
public $A_CMP_ME_SELFNFLV = 'Το επιλεγμένο αρχείο δεν είναι flash video (flv)!';
public $A_CMP_ME_PLAY = 'Αναπαραγωγή';
public $A_CMP_ME_SELFNMP3 = 'Το επιλεγμένο αρχείο δεν είναι mp3!';
public $A_CMP_ME_EXTRZIP = 'Αποσυμπίεση Zip';
public $A_CMP_ME_EXTRCUFO = 'Αποσυμπίεση όλων των αρχείων του %s στον τρέχον φάκελο;';
public $A_CMP_ME_FINOZIP = 'Το αρχείο <strong>%s</strong> δεν είναι zip!';
public $A_CMP_ME_UNERREXT = 'Παρουσιάστηκε ένα αναπάντεχο σφάλμα κατά την αποσυμπίεση!';
public $A_CMP_ME_FIEXTRD = 'αρχεία αποσυμπιέστηκαν.';
public $A_CMP_ME_REFVIEW = 'Ανανεώστε τη σελίδα για να τα δείτε';
public $A_CMP_ME_DOWNLOAD = 'Λήψη';
public $A_CMP_ME_TODOWNCL = 'Για να κατεβάσετε αυτό το αρχείο πατήστε στο όνομά του κάτω από το εικονίδιό του.';
public $A_CMP_ME_RESIZE = 'Αλλαγή μεγέθους';
public $A_CMP_ME_FINORES = 'Δεν είναι δυνατή η αλλαγή μεγέθους του επιλεγμένου αρχείου!';
public $A_CMP_ME_RESTO = 'Αλλαγή σε';
public $A_CMP_ME_KEEPRAT = 'Διατήρηση αναλογιών';
public $A_CMP_ME_BASEWID = 'Με βάση το πλάτος της εικόνας';
public $A_CMP_ME_INVWNIMG = 'Άκυρο πλάτος για τη νέα εικόνα!';
public $A_CMP_ME_INVHNIMG = 'Άκυρο ύψος για τη νέα εικόνα!';
public $A_CMP_ME_IMGRESSUC = 'Το μέγεθος της εικόνας άλλαξε επιτυχώς!';
public $A_CMP_ME_CNOTRESIMG = 'Δε στάθηκε δυνατή η αλλαγή μεγέθους της εικόνας!';
public $A_CMP_ME_IE6UPGRADE = '<strong>Χρησιμοποιείτε Internet Explorer 6!</strong> Παρακαλούμε κάντε αναβάθμιση σε IE7 ή χρησιμοποιήστε <a href="http://www.mozilla.com" target="_blank">Firefox</a>.'; 
public $A_CMP_ME_USEFIREFOX = 'Για τέλεια απόδοση παρακαλούμε χρησιμοποιήστε <a href="http://www.mozilla.com" target="_blank">Firefox</a>.';
public $A_CMP_ME_WATERMARK = 'Υδατογράφημα';
public $A_CMP_ME_CNOTWATERF = 'Δεν μπορείτε να τοποθετήσετε υδατογράφημα σε αυτό το αρχείο!';
public $A_CMP_ME_TEXT = 'Κείμενο';
public $A_CMP_ME_FONT = 'Γραμματοσειρά';
public $A_CMP_ME_OPACITY = 'Διαφάνεια';
public $A_CMP_ME_WATERPOS = 'Θέση υδατογραφίας';
public $A_CMP_ME_XAXIS = 'Άξονας-X';
public $A_CMP_ME_YAXIS = 'Άξονας-Ψ';
public $A_CMP_ME_COLOR = 'Χρώμα';
public $A_CMP_ME_IMGQUAL = 'Ποιότητα εικόνας';
public $A_CMP_ME_SAVEAS = 'Αποθήκευση ως...';
public $A_CMP_ME_BLACK = 'Μαύρο';
public $A_CMP_ME_WHITE = 'Άσπρο';
public $A_CMP_ME_RED = 'Κόκκινο';
public $A_CMP_ME_BLUE = 'Μπλε';
public $A_CMP_ME_ORANGE = 'Πορτοκαλί';
public $A_CMP_ME_YELLOW = 'Κίτρινο';
public $A_CMP_ME_GREEN = 'Πράσινο';
public $A_CMP_ME_GRAY = 'Γκρι';
public $A_CMP_ME_LGRAY = 'Ανοιχτό γκρι';
public $A_CMP_ME_SHADOW = 'Σκιά';
public $A_CMP_ME_NOSHADOW = 'Χωρίς σκιά';
public $A_CMP_ME_NEWFDIFOLD = 'Το νέο όνομα αρχείου έχει διαφορετική επέκταση από το αρχικό!';
public $A_CMP_ME_OVERIMGNEX = 'Η εικόνα υπερκάλυψης δεν υπάρχει!';
public $A_CMP_ME_WATERGENSUC = 'Το υδατογράφημα δημιουργήθηκε επιτυχώς.<br />Κλείστε αυτό το παράθυρο και ανανεώστε το διαχειριστή πολυμέσων για να δείτε τη νέα εικόνα.';
public $A_CMP_ME_CNOTGENWAT = '<strong>Δε στάθηκε δυνατή η δημιουργία του υδατογραφήματος!</strong><br />Αυτή η λειτουργία απαιτεί τις βιβλιοθήκες GD και FreeType της PHP.';


/* OLD STUFF (most of them will be removed) */
public $A_CMP_ME_MEMANG = 'Διαχειριστής Πολυμέσων';
public $A_CMP_ME_DIR = 'Φάκελος';
public $A_CMP_ME_UP = 'Επάνω';
public $A_CMP_ME_UPLOAD = 'Αποστολή Αρχείου';
public $A_CMP_ME_MAXSIZE = 'Μέγιστο Μέγεθος';
public $A_CMP_ME_CODE = 'Κώδικας HTML';
public $A_CMP_ME_CDIR = 'Δημιουργία Φακέλου';
public $A_CMP_ME_NOIMG = 'Δεν βρέθηκαν εικόνες';
public $A_CMP_ME_PROBL = 'Πρόβλημα Ρυθμίσεων';
public $A_CMP_ME_EXIST = 'δεν υπάρχει.';
public $A_CMP_ME_ALT_CODE = 'Κώδικας HTML';
public $A_CMP_ME_INSERT = 'Εισάγετε εδώ το κείμενό σας';
public $A_CMP_ME_DELFILE = 'Διαγραφή αρχείου: ';
public $A_CMP_ME_QMARK = ';';
public $A_CMP_ME_DELAL01 = 'Υπάρχουν ';
public $A_CMP_ME_DELAL02 = ' αρχεία/φάκελοι στο ';
public $A_CMP_ME_DELAL03 = '. \n\nΠαρακαλούμε διαγράψτε όλα τα αρχεία/φακέλους στο ';
public $A_CMP_ME_DELAL04 = ' πρώτα.';
public $A_CMP_ME_DELFOL = 'Διαγραφή φακέλου: ';
public $A_CMP_ME_LINKTO = 'Σύνδεσμος προς';
public $A_CMP_ME_CLIP = 'Αντιγραφή στο clipboard';
public $A_CMP_ME_CLIPSOR = 'Αυτή η λειτουργία είναι διαθέσιμη μόνο για Internet Explorer';
public $A_CMP_ME_VALFTYPES = 'Έγκυροι τύποι αρχείων';
public $A_CMP_ME_VIDEO = 'Βίντεο';
public $A_CMP_ME_AUDIO = 'Ήχος';
public $A_CMP_ME_OTHER = 'Άλλοι';
public $A_CMP_ME_NOHACK = 'ΌΧΙ ΖΑΒΟΛΙΕΣ ΠΑΡΑΚΑΛΩ';
public $A_CMP_ME_DIRSMO = 'Σε SAFE MODE δεν επιτρέπεται η δημιουργία φακέλων, καθώς αυτό μπορεί να δημιουργήσει προβλήματα.';
public $A_CMP_ME_ALPHA = 'Το όνομα του φακέλου, πρέπει να περιέχει μόνο λατινικούς αλφαριθμητικούς χαρακτήρες χωρίς κενά.';
public $A_CMP_ME_NTEMP = 'Αδυναμία διαγραφής: δεν είναι κενό!';
public $A_CMP_ME_FAILED = 'Η αποστολή αρχείου απέτυχε. Το αρχείο υπάρχει ήδη';
public $A_CMP_ME_ONLY = 'Επιτρέπεται η αποστολή αρχείων μόνο των τύπων εικόνας, ήχου, βίντεο ή κειμένου';
public $A_CMP_ME_UPFAIL = 'Η αποστολή αρχείου ΑΠΕΤΥΧΕ';
public $A_CMP_ME_UPCOMP = 'Η αποστολή αρχείου ολοκληρώθηκε';
public $A_CMP_ME_DELSUC = 'Το Πολυμέσο διαγράφηκε επιτυχώς';
public $A_CMP_ME_DELCNOT = 'Δεν στάθηκε δυνατή η διαγραφή του πολυμέσου';
public $A_CMP_ME_ATTENTION = 'ΠΡΟΣΟΧΗ';
public $A_CMP_ME_DELALL = 'Διαγραφή φακέλου ΚΑΙ περιεχομένων';

}

?>
