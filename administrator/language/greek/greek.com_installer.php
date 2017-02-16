<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ioannis Sannos
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Greek language for component intsaller
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_INS_SDIR = 'Παρακαλώ, επιλέξτε έναν κατάλογο';
public $A_CMP_INS_UPF = 'Αποστολή Πακέτου';
public $A_CMP_INS_PF = 'Πακέτο εγκατάστασης';
public $A_CMP_INS_UFI = "Αποστολή Αρχείου &amp; Εγκατάσταση";
public $A_CMP_INS_FDIR = 'Εγκατάσταση από κατάλογο';
public $A_CMP_INS_IDIR = 'Κατάλογος Εγκατάστασης';
public $A_CMP_INS_DOIN = 'Εγκατάσταση';
public $A_CMP_INS_CONT = 'Συνέχεια ...';
public $A_CMP_INS_NF = "Δεν βρέθηκε Εγκαταστάτης για το στοιχείο ";
public $A_CMP_INS_NA = "Δεν υπάρχει διαθέσιμος Εγκαταστάτης για το στοιχείο";
public $A_CMP_INS_EFU = "Ο εγκαταστάτης δε δύναται να συνεχίσει πριν την ενεργοποίηση της αποστολής αρχείων. Παρακαλώ, χρησιμοποιήστε τη μέθοδο εγκατάστασης από κατάλογο.";
public $A_CMP_INS_ERTL = 'Εγκαταστάτης - Σφάλμα';
public $A_CMP_INS_ERZL = "Ο εγκαταστάτης δε δύναται να συνεχίσει πριν την εγκατάσταση του zlib";
public $A_CMP_INS_ERNF = 'Δεν επιλέχθηκε φάκελος';
public $A_CMP_INS_ERUM = 'Αποστολή νέου module - σφάλμα';
public $A_CMP_INS_UPTL = 'Αποστολή ';
public $A_CMP_INS_UPE1 = ' - Αποστολή Απέτυχε';
public $A_CMP_INS_UPE2 = ' -  Σφάλμα Αποστολής';
public $A_CMP_INS_SUCC = 'Επιτυχής';
public $A_CMP_INS_ER = 'Σφάλμα';
public $A_CMP_INS_ERFL = 'Απέτυχε';
public $A_CMP_INS_UPNW = 'Αποστολή νέου ';
public $A_CMP_INS_FP = 'Αποτυχία αλλαγής αδείας χρήσης του σταλθέντος αρχείου.';
public $A_CMP_INS_FM = 'Αποτυχία μετακίνησης σταλθέντος αρχείου στον κατάλογο <code>/media</code>.';
public $A_CMP_INS_FW = 'Η αποστολή απέτυχε, ο καταλόγος <code>/media</code> δεν είναι εγγράψιμος.';
public $A_CMP_INS_FE = 'Η αποστολή απέτυχε, ο καταλόγος <code>/media</code> δεν υφίσταται.';
public $A_CMP_INST_ERUNR = 'Μη ανακτήσιμο σφάλμα';
public $A_CMP_INST_EREXT = 'Σφάλμα αποσυμπίεσης';
public $A_CMP_INST_ERMXM = 'ΣΦΑΛΜΑ: Δε βρέθηκε αρχείο εγκατάστασης XML του Elxis στο πακέτο';
public $A_CMP_INST_ERXML = 'ΣΦΑΛΜΑ: Δε βρέθηκε αρχείο εγκατάστασης XML στο πακέτο';
public $A_CMP_INST_ERNFN = 'Δε δόθηκε όνομα αρχείου';
public $A_CMP_INST_ERVLD = 'δεν είναι έγκυρο αρχείο εγκατάστασης του Elxis';
public $A_CMP_INST_ERINC = 'Η μέθοδος εγκατάστασης δε μπορεί να κληθεί από μία κλάση';
public $A_CMP_INST_ERUIC = 'Η μέθοδος απεγκατάστασης δε μπορεί να κληθεί από μία κλάση';
public $A_CMP_INST_ERIFN = 'Δε βρέθηκε αρχείο εγκατάστασης';
public $A_CMP_INST_ERSXM = 'Το αρχείο εγκατάστασης XML δεν είναι για';
public $A_CMP_INST_ERCDR = 'Αποτυχία δημιουργίας καταλόγου';
public $A_CMP_INST_FNOTE = 'δεν υπάρχει!';
public $A_CMP_INST_TAFC = 'Υπάρχει ήδη ένα αρχείο με αυτό το όνομα';
public $A_CMP_INST_AYIT = '- Προσπαθείτε να εγκαταστήσετε το ίδιο CMT δεύτερη φορά;';
public $A_CMP_INST_FCPF = 'Αποτυχία αντιγραφής του αρχείου';
public $A_CMP_INST_CPTO = 'προς';
public $A_CMP_INST_UNINSTALL = 'Απεγκατάσταση';
public $A_CMP_INST_CUDIR = 'Ένα άλλο component χρησημοποιεί ήδη τον κατάλογο';
public $A_CMP_INST_SQLER = 'Σφάλμα SQL';
public $A_CMP_INST_CCPHP = 'Δεν είναι δυνατή η αντιγραφή του PHP αρχείου εγκατάστασης.';
public $A_CMP_INST_CCUNPHP = 'Δεν είναι δυνατή η αντιγραφή του PHP αρχείου απεγκατάστασης.';
public $A_CMP_INST_UNERR = 'Απεγκατάσταση -  σφάλμα';
public $A_CMP_INST_THCOM = 'Component';
public $A_CMP_INST_ISCOR = 'είναι component του πυρήνα και δεν μπορεί να απεγκατασταθεί.<br />Εάν δε θέλετε να το χρησιμοποιήσετε μπορείτε να το αποδημοσιεύσετε';
public $A_CMP_INST_XMLINV = 'Άκυρο Αρχείο XML';
public $A_CMP_INST_OFEMP = 'Πεδίο Επιλογών άδειο, τα αρχεία δε μπορούν να μετακινηθούν';
public $A_CMP_INST_INCOM = 'Εγκατεστημένα Components';
public $A_CMP_INST_CURRE = 'Ήδη Εγκατεστημένα';
public $A_CMP_INST_MENL = 'Σύνδεσμος Μενού Component';
public $A_CMP_INST_AUURL = 'URL Συγγραφέα';
public $A_CMP_INST_NCOMP = 'Δεν υπάρχουν εγκατεστημένα custom components';
public $A_CMP_INST_INSCO = 'Εγκατάσταση νέου Component';
public $A_CMP_INST_DELE = 'Διαγραφή';
public $A_CMP_INST_LIDE = 'Κενό ID γλώσσας, αδύνατη η διαγραφή των αρχείων';
public $A_CMP_INST_ALL = 'όλα';
public $A_CMP_INST_BKLM = 'Επιστροφή στο Διαχειριστή Γλωσσών';
public $A_CMP_INST_NWLA = 'Εγκατάσταση νέας Γλώσσας';
public $A_CMP_INST_NFMM = 'Κανένα αρχείο δεν έχει σήμανση αρχείου bot';
public $A_CMP_INST_MAMB = 'Το bot';
public $A_CMP_INST_AXST = 'υπάρχει ήδη!';
public $A_CMP_INST_IOID = 'Άκυρο ID αντικειμένου';
public $A_CMP_INST_FFEM = 'Πεδίο Φακέλου άδειο, αδύνατη η αφαίρεση των αρχείων';
public $A_CMP_INST_DXML = 'Διαγραφή Αρχείου XML';
public $A_CMP_INST_ICMO = 'είναι στοιχείο του πυρήνα και δε μπορεί να απεγκατασταθεί.<br />Εάν δε θέλετε να το χρησιμοποιήσετε μπορείτε να το αποδημοσιεύσετε.';
public $A_CMP_INST_IMBT = 'Εγκατεστημένα bots';
public $A_CMP_INST_OMBT = 'Εμφανίζονται μόνο τα bots που επιτρέπεται να διαγραφούν - κάποια bots του πυρήνα δεν μπορούν να διαγραφούν.';
public $A_CMP_INST_MBT = 'bot';
public $A_CMP_INST_MTYP = 'Τύπος';
public $A_CMP_INST_NMBT = 'Δεν έχουν εγκατασταθεί custom bots εκτός πυρήνα.';
public $A_CMP_INST_INMT = 'Εγκατάσταση Νέου bot';
public $A_CMP_INST_UCTP = 'Άγνωστος τύπος πελάτη';
public $A_CMP_INST_NFMD = 'Κανένα αρχείο δεν έχει σήμανση αρχείου module';
public $A_CMP_INST_MODULE = 'Module';
public $A_CMP_INST_ICMDL = 'είναι module πυρήνα, και δε μπορεί να απεγκατασταθεί.<br />Εάν δε θέλετε να το χρησιμοποιήσετε μπορείτε να το αποδημοσιεύσετε';
public $A_CMP_INST_IMDL = 'Εγκατεστημένα Modules';
public $A_CMP_INST_OMDL = 'Εμφανίζονται μόνο τα Modules που επιτρέπεται να διαγραφούν - κάποια Module του πυρήνα δε μπορούν να διαγραφούν.';
public $A_CMP_INST_MDLF = 'Αρχείο Module';
public $A_CMP_INST_NMDL = 'Δεν έχουν εγκατασταθεί custom Modules';
public $A_CMP_INST_NWMDL = 'Εγκατάσταση Νέου Module';
public $A_CMP_INST_ALLC = 'Όλα';
public $A_CMP_INST_STMDL = 'Module Ιστοσελίδας';
public $A_CMP_INST_ADMDL = 'Module Διαχείρισης';
public $A_CMP_INST_DDEX = 'Ο Κατάλογος δεν υπάρχει, η διαγραφή των αρχείων είναι αδύνατη';
public $A_CMP_INST_TIDE = 'Το Id του Template είναι κενό, η διαγραφή των αρχείων είναι αδύνατη';
public $A_CMP_INST_TINS = 'Εγκατάσταση νέου Template';
public $A_CMP_INST_BATP = 'Επιστροφή στα Template';
public $A_CMP_INST_INSBR = 'Εγκατάσταση νέας Γέφυρας';
public $A_CMP_INST_BABR = 'Επιστροφή στις γέφυρες';
public $A_CMP_INST_ΒIDE = 'Το id της Γέφυρας είναι κενό, η διαγραφή των αρχείων είναι αδύνατη';
public $A_INST_INCOM = 'Ανιχνεύθηκε πιθανή ασυμβατότητα μεταξύ της έκδοσης του Elxis που χρησιμοποιείτε και της εγκατεστημένης επέκτασης. 
Παρόλα αυτά, το λογισμικό πιθανόν να λειτουργεί σωστά και χωρίς σφάλματα. Αυτή είναι απλά μία προειδοποίηση.';
public $A_INST_INCOMJOO = 'Το πακέτο εγκατάστασης είναι για το Joomla CMS.';
public $A_INST_INCOMMAM = 'Το πακέτο εγκατάστασης είναι για το Mambo CMS.';
public $A_INST_OLDER = 'Το πακέτο εγκατάστασης είναι για μία προγενέστερη έκδοση του Elxis (%s) από αυτή που χρησιμοποιείτε (%s).';
public $A_INST_NEWER = 'Το πακέτο εγκατάστασης είναι για μία νεώτερη έκδοση του Elxis (%s) από αυτή που χρησιμοποιείτε (%s).';
//2009.0
public $A_INST_DOINEDC = 'Λήψη και εγκατάσταση από το Κέντρο Λήψεων του Elxis';
public $A_INST_FETCHAVEXTS = 'Λήψη λίστας διαθέσιμων επεκτάσεων';
public $A_INST_MORE = 'Περισσότερα';
public $A_INST_LESS = 'Λιγότερα';
public $A_INST_SIZE = 'Μέγεθος';
public $A_INST_DOWNLOAD = 'Λήψη';
public $A_INST_DOWNLOADS = 'Λήψεις';
public $A_INST_DOWNINST = 'Λήψη και εγκατάσταση';
public $A_INST_LICENSE = 'Άδεια χρήσης';
public $A_INST_COMPAT = 'Συμβατότητα';
public $A_INST_DATESUB = 'Ημερομηνία υποβολής';
public $A_INST_SUREINST = 'Είστε βέβαιος πως θέλετε να εγκαταστήσετε το %s ;';
//2009.2
public $A_INST_UPTODATE = 'Ενημερωμένο';
public $A_INST_OUTDATED = 'Παρωχυμένο';
public $A_INST_INSTVERS = 'Εγκατεστ. έκδοση';
public $A_INST_UNLOAD = 'Εκφόρτωση';
public $A_INST_EDCUPDESC = 'Κατάλογος των εγκατεστημένων επεκτάσεων τρίτων κατασκευαστών και η κατάσταση ενημέρωσής τους.<br />
	Οι πληροφορίες λαμβάνονται σε πραγματικό χρόνο από το <a href="http://www.elxis-downloads.com/el/" title="EDC" target="_blank">Κέντρο Λήψεων του Elxis</a>.<br />
	Προκειμένου ο έλεγχος έκδοσης να ολοκληρωθεί με επιτυχία θα πρέπει ο ιστότοπός σας να μπορεί να συνδεθεί στον απομεμακρυσμένο κόμβο <strong>EDC</strong>.';
public $A_INST_EDCUPNOR = "Ο έλεγχος έκδοσης δεν επέστρεψε αποτελέσματα.<br />
	Προφανώς δεν έχετε εγκατεστημένα %s τρίτων κατασκευαστών."; 

}

?>