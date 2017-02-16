<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin/XML Language
* @author: Elxis Team
* @translator: Ioannis Sannos
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Greek Language for XML files
* @note: All values used in admin XML files start with 'AX_'
* @note 2008: values for custom language strings defined as php contants start with 'CX_' (not in this file!)
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* 
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
* 
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class xmlLanguage extends standardLanguage {

public function get($a) {
	if ( is_numeric($a) ) { return $a; }
	$pref = strtoupper(substr($a,0,3));
    if ($pref == 'AX_') {
        return $this->$a;
    } elseif (($pref == 'CX_') && defined($a)) {
        return constant($a);
	} else { return $a; }
}

protected $AX_MENUIMGL = 'Εικόνα Μενού';
protected $AX_MENUIMGD = 'Μία μικρή εικόνα η οποία θα παρουσιάζεται στα δεξιά ή αριστερά από το αντικείμενο του μενού. Η εικόνα, θα πρέπει να βρίσκεται στον κατάλογο images/stories/.';
protected $AX_MENUIMGONLYL = 'Χρήση Μόνο της Εικόνας του Μενού';
protected $AX_MENUIMGONLYD = 'Εάν επιλέξετε <strong>Ναι</strong>, τότε το αντικείμενο μενού θα αναπαριστάται ΜΟΝΟ από την εικόνα που θα επιλέξετε.<br /><br />Εάν επιλέξετε <strong>Όχι</strong>, τότε το αντικείμενο μενού θα αναπαριστάται από την εικόνα που έχετε επιλέξει ΜΑΖΙ με το σχετικό κείμενο.';
protected $AX_MENUIMG2D = 'Μία μικρή εικόνα η οποία θα παρουσιάζεται στα δεξιά ή αριστερά από το αντικείμενο του μενού. Η εικόνα, θα πρέπει να βρίσκεται στον κατάλογο /images.';
protected $AX_PAGCLASUFL = 'Επίθεμα της CSS Κλάσης της Σελίδας';
protected $AX_PAGCLASUFD = 'Επίθεμα που θα προστεθεί στη CSS κλάση της σελίδας. Με αυτό τον τρόπο, μπορούμε να επιτύχουμε διαφοροποίηση της εμφάνισης της σελίδας.';
protected $AX_TEXTPAGECL = 'Επίθεμα Άρθρου';
protected $AX_TEXTPAGECLD = 'Επίθεμα που θα προστεθεί στη CSS κλάση του άρθρου. Με αυτό τον τρόπο, μπορούμε να επιτύχουμε διαφοροποίηση στην εμφάνιση του άρθρου.';
protected $AX_BACKBUTL = 'Κουμπί Επιστροφής';
protected $AX_BACKBUTD = 'Εμφάνιση ή όχι του Κουμπιού Επιστροφής που σας επιστρέφει στη προηγούμενη σελίδα.';
protected $AX_USEGLB = 'Γενική Ρύθμιση';
protected $AX_HIDE = 'Απόκρυψη';
protected $AX_SHOW = 'Εμφάνιση';
protected $AX_AUTO = 'Αυτόματα';
protected $AX_PAGTITLSL = 'Εμφάνιση Τίτλου Σελίδας';
protected $AX_PAGTITLSD = 'Εμφανίζει ή όχι τον Τίτλο της Σελίδας';
protected $AX_PAGTITLL = 'Τίτλος Σελίδας';
protected $AX_PAGTITLD = 'Εισάγετε το κείμενο που θέλετε να εμφανίζεται στην κορυφή της σελίδας. Εάν το αφήσετε κενό, θα χρησιμοποιηθεί αυτόματα το όνομα του Μενού.';
protected $AX_PAGTITL2D = 'Εισάγετε το κείμενο που θέλετε να εμφανίζεται στην κορυφή της σελίδας.';
protected $AX_LEFT = 'Αριστερά';
protected $AX_RIGHT = 'Δεξιά';
protected $AX_PRNTICOL = 'Εικονίδιο Εκτύπωσης';
protected $AX_PRNTICOD = 'Εμφανίζει ή όχι, το εικονίδιο εκτύπωσης - Επηρεάζει μόνο αυτή τη σελίδα.';
protected $AX_YES = 'Ναι';
protected $AX_NO = 'Όχι';
protected $AX_SECNML = 'Όνομα Ενότητας';
protected $AX_SECNMD = 'Εμφανίζει ή όχι, την Ενότητα στην οποία ανήκει το αντικείμενο.';
protected $AX_SECNMLL = 'Συνδεδεμένο Όνομα Ενότητας';
protected $AX_SECNMLD = 'Κάνει το κείμενο της Ενότητας να λειτουργεί σα σύνδεσμος προς τη σελίδα της Ενότητας.';
protected $AX_CATNML = 'Όνομα Κατηγορίας';
protected $AX_CATNMD = 'Εμφανίζει ή όχι, την Κατηγορία στην οποία ανήκει το αντικείμενο';
protected $AX_CATNMLL = 'Συνδεδεμένο Όνομα Κατηγορίας';
protected $AX_CATNMLD = 'Κάνει το κείμενο της Κατηγορίας να λειτουργεί σα σύνδεσμος προς τη σελίδα της Κατηγορίας.';
protected $AX_LNKTTLL = 'Συνδεδεμένοι Τίτλοι';
protected $AX_LNKTTLD = 'Να λειτουργεί ο τίτλος του αντικειμένου ως σύνδεσμος;';
protected $AX_ITMRATL = 'Αξιολόγηση Αντικειμένου';
protected $AX_ITMRATD = 'Εμφανίζει ή όχι, την αξιολόγηση του αντικειμένου - επηρεάζει μόνο αυτή τη σελίδα.';
protected $AX_AUTNML = 'Ονόματα Συγγραφέων';
protected $AX_AUTNMD = 'Εμφανίζει ή όχι, το συγγραφέα του αντικειμένου - επηρεάζει μόνο αυτή τη σελίδα.';
protected $AX_CTDL = 'Ημερομηνία και Ώρα Δημιουργίας';
protected $AX_CTDD = 'Εμφανίζει ή όχι, την ημερομηνία δημιουργίας του αντικειμένου - επηρεάζει μόνο αυτή τη σελίδα.';
protected $AX_MTDL = 'Ημερομηνία και Ώρα Τροποποίησης';
protected $AX_MTDD = 'Εμφανίζει ή όχι, την ημερομηνία μεταβολής του αντικειμένου - επηρεάζει μόνο αυτή τη σελίδα.';
protected $AX_PDFICL = 'Εικονίδιο PDF';
protected $AX_PDFICD = 'Εμφανίζει ή όχι, το κουμπί για τη δημιουργία PDF - επηρεάζει μόνο αυτή τη σελίδα.';
protected $AX_PRICL = 'Εικονίδιο Εκτύπωσης';
protected $AX_PRICD = 'Εμφανίζει ή όχι, το κουμπί για την εκτύπωση της σελίδας - επηρεάζει μόνο αυτή τη σελίδα.';
protected $AX_EMICL = 'Εικονίδιο Email';
protected $AX_EMICD = 'Εμφανίζει ή όχι, το κουμπί για την αποστολή της σελίδας με email - επηρεάζει μόνο αυτή τη σελίδα.';
protected $AX_FTITLE = 'Τίτλος';
protected $AX_FAUTH = 'Συγγραφέας';
protected $AX_FHITS = 'Εμφανίσεις';
protected $AX_DESCRL = 'Περιγραφή';
protected $AX_DESCRD = 'Εμφανίζει ή όχι, την παρακάτω περιγραφή.';
protected $AX_DESCRTXL = 'Κείμενο Περιγραφής';
protected $AX_DESCRTXD = 'Περιγραφή της σελίδας. Εάν το αφήσετε κενό, θα φορτώσει το _WEBLINKS_DESC από το αρχείο γλώσσας.';
protected $AX_IMAGEL = 'Εικόνα';
protected $AX_IMGFRPD = 'Η εικόνα για τη σελίδα. Το αρχείο της εικόνας θα πρέπει να βρίσκεται στον κατάλογο /images/stories. Εξ ορισμού, θα φορτώσει την εικόνα web_links.jpg, \'Καμία\' εικόνα, σημαίνει ότι δεν θα φορτωθεί εικόνα.';
protected $AX_IMGALL = 'Στοίχιση Εικόνας';
protected $AX_IMGALD = 'Η στοίχιση της εικόνας.';
protected $AX_TBHEADL = 'Επικεφαλίδες Πίνακα';
protected $AX_TBHEADD = 'Εμφανίζει ή όχι, τις επικεφαλίδες του πίνακα.';
protected $AX_POSCOLL = 'Στήλη Θέσης';
protected $AX_POSCOLD = 'Εμφανίζει ή όχι, τη στήλη της Θέσης.';
protected $AX_EMAILCOLL = 'Στήλη Email';
protected $AX_EMAILCOLD = 'Εμφανίζει ή όχι, τη στήλη του Email.';
protected $AX_TELCOLL = 'Στήλη Τηλεφώνου';
protected $AX_TELCOLD = 'Εμφανίζει ή όχι, τη στήλη του Τηλεφώνου.';
protected $AX_FAXCOLL = 'Στήλη Fax';
protected $AX_FAXCOLD = 'Εμφανίζει ή όχι, τη στήλη του Fax.';
protected $AX_LEADINGL = '# Προβεβλημένα';
protected $AX_LEADINGD = 'Πλήθος Αντικειμένων Περιεχομένου που θα παρουσιάζονται σαν προβεβλημένα (πλήρους πλάτους) αντικείμενα. Η τιμή 0 σημαίνει ότι κανένα αντικείμενο δεν θα παρουσιάζεται σαν προβεβλένο.';
protected $AX_INTROL = '# Εισαγωγικά';
protected $AX_INTROD = 'Πλήθος Αντικειμένων Περιεχομένου που θα εμφανίζονται με ορατό το εισαγωγικό κείμενο.';
protected $AX_COLSL = 'Στήλες';
protected $AX_COLSD = 'Πόσες στήλες θα χρησιμοποιούνται ανά γραμμή όταν θα εμφανίζεται το εισαγωγικό κείμενο.';
protected $AX_LNKSL = '# Σύνδεσμοι';
protected $AX_LNKSD = 'Πλήθος Αντικειμένων Περιεχομένου που θα εμφανίζονται σα σύνδεσμοι.';
protected $AX_CATORL = 'Ταξινόμηση Κατηγορίας';
protected $AX_CATORD = 'Ταξινόμηση αντικειμένων ανά Κατηγορία';
protected $AX_OCAT01 = 'Όχι, ταξινόμηση μόνο βάση της Κύριας Ταξινόμησης';
protected $AX_OCAT02 = 'Αλφαβητικά βάσει Τίτλου';
protected $AX_OCAT03 = 'Αντίστροφα αλφαβητικά βάσει Τίτλου';
protected $AX_OCAT04 = 'Βάσει της σειράς εισαγωγής';
protected $AX_PRMORL = 'Κύρια Ταξινόμηση';
protected $AX_PRMORD = 'Σειρά με την οποία θα εμφανίζονται τα αντικείμενα.';
protected $AX_OPRM01 = 'Προκαθορισμένη';
protected $AX_OPRM02 = 'Ταξινόμηση βάσει της Πρώτης Σελίδας';
protected $AX_OPRM03 = 'Πρώτα τα Παλαιότερα';
protected $AX_OPRM04 = 'Πρώτα τα Νεώτερα';
protected $AX_OPRM07 = 'Αλφαβητικά, βάσει του Συγγραφέα';
protected $AX_OPRM08 = 'Αντίστροφα αλφαβητικά, βάσει του Συγγραφέα';
protected $AX_OPRM09 = 'Περισσότερες Εμφανίσεις';
protected $AX_OPRM10 = 'Λιγότερες Εμφανίσεις';
protected $AX_PAGL = 'Σελιδοποίηση';
protected $AX_PAGD = 'Εμφάνιση ή όχι, της σελιδοποίησης.';
protected $AX_PAGRL = 'Αποτελέσματα Σελιδοποίησης';
protected $AX_PAGRD = 'Εμφάνιση ή όχι, των Πληροφοριών Σελιδοποίησης ( π.χ. 1-4 από 4 ).';
protected $AX_MOSIL = 'Εικόνες MOS';
protected $AX_MOSID = 'Εμφάνιση εικόνων {mosimages}.';
protected $AX_ITMTL = 'Τίτλοι Αντικειμένων';
protected $AX_ITMTD = 'Εμφάνιση ή όχι, των τίτλων των αντικειμένων.';
protected $AX_REMRL = 'Διαβάστε Περισσότερα';
protected $AX_REMRD = 'Εμφάνιση ή όχι, του συνδέσμου Διαβάστε Περισσότερα.';
protected $AX_OTHCATL = 'Άλλες Κατηγορίες';
protected $AX_OTHCATD = 'Εμφανίζει ή όχι, τη λίστα των άλλων κατηγοριών, όταν βλέπουμε κάποια κατηγορία.';
protected $AX_TDISTPD = 'Το κείμενο που θα εμφανίζεται στη κορυφή της σελίδας.';
protected $AX_ORDBYL = 'Βάση Ταξινόμησης';
protected $AX_ORDBYD = 'Αυτή η επιλογή παρακάμπτει τη ταξινόμηση των αντικειμένων.';
protected $AX_MCS_DESCL = 'Περιγραφή';
protected $AX_SHCDESD = 'Εμφανίζει ή όχι, την περιγραφή της κατηγορίας.';
protected $AX_DESCIL = 'Εικόνα περιγραφής';
protected $AX_MUDATFL = 'Μορφή ημερομηνίας';
protected $AX_MUDATFD = 'Η μορφή της εμφανιζόμενης ημερομηνίας. Χρησιμοποιεί τη κωδικοποίηση της εντολής strftime της PHP. Αν το αφήσετε κενό, θα χρησιμοποιήσει τη μορφοποίηση από το αρχείο γλώσσας.';
protected $AX_MUDATCL = 'Στήλη Ημερομηνίας';
protected $AX_MUDATCD = 'Εμφάνιση ή όχι, της στήλης της ημερομηνίας.';
protected $AX_MUAUTCL = 'Στήλη Συγγραφέα';
protected $AX_MUAUTCD = 'Εμφάνιση ή όχι, της στήλης του συγγραφέα.';
protected $AX_MUHITCL = 'Στήλη Εμφανίσεων';
protected $AX_MUHITCD = 'Εμφάνιση ή όχι, της στήλης των εμφανίσεων.';
protected $AX_MUNAVBL = 'Μπάρα Πλοήγησης';
protected $AX_MUNAVBD = 'Εμφάνιση ή όχι, της μπάρας πλοήγησης.';
protected $AX_MUORDSL = 'Επιλογή Ταξινόμησης';
protected $AX_MUORDSD = 'Εμφάνιση ή όχι, της λίστας επιλογής ταξινόμησης.';
protected $AX_MUDSPSL = 'Εμφάνιση Επιλογής';
protected $AX_MUDSPSD = 'Εμφάνιση ή όχι, της λίστας επιλογής εμφάνισης.';
protected $AX_MUDSPNL = 'Εμφάνιση Πλήθους Αντικειμένων';
protected $AX_MUDSPND = 'Το προκαθορισμένο πλήθος των αντικειμένων που θα εμφανίζονται.';
protected $AX_MUFLTL = 'Φίλτρο';
protected $AX_MUFLTD = 'Εμφάνιση ή όχι, της δυνατότητας φιλτραρίσματος.';
protected $AX_MUFLTFL = 'Πεδίο Φίλτρου';
protected $AX_MUFLTFD = 'Σε ποιο πεδίο θα εφαρμόζεται το φίλτρο.';
protected $AX_MUOCATL = 'Άλλες Κατηγορίες';
protected $AX_MUOCATD = 'Εμφάνιση ή όχι, της λίστας των άλλων κατηγοριών.';
protected $AX_MUECATL = 'Κενές Κατηγορίες';
protected $AX_MUECATD = 'Εμφάνιση ή όχι, των κενών κατηγοριών (αυτές που δεν έχουν αντικείμενα).';
protected $AX_CATDSCL = 'Περιγραφή Κατηγορίας';
protected $AX_CATDSBLND = 'Εμφάνιση ή όχι, της περιγραφής της κατηγορίας. Η περιγραφή εμφανίζεται κάτω από το όνομα της κατηγορίας.';
protected $AX_NAMCOLL = 'Στήλη Ονόματος';
protected $AX_LINKDSCL = 'Περιγραφή Συνδέσμων';
protected $AX_LINKDSCD = 'Εμφάνιση ή όχι, του κειμένου περιγραφής των συνδέσμων.';

//com_contact/contact.xml
protected $AX_CCT_CDESC = 'Αυτό το component εμφανίζει μία λίστα των διαθέσιμων Επαφών.';
protected $AX_CCT_CATLISTSL = 'Λίστα Κατηγορίας - Ενότητας';
protected $AX_CCT_CATLISTSD = 'Εμφανίζει ή όχι, τη Λίστα των Κατηγοριών στην εμφάνιση μορφής Λίστας.';
protected $AX_CCT_CATLISTCL = 'Λίστα Κατηγορίας - Κατηγορία';
protected $AX_CCT_CATLISTCD = 'Εμφανίζει ή όχι, τη Λίστα των Κατηγοριών στην εμφάνιση μορφής Πίνακα.';
protected $AX_CCT_CATDSCD = 'Εμφανίζει ή όχι, την περιγραφή της λίστας των κατηγοριών.';
protected $AX_CCT_NOCATITL = '# Αντικείμενα Κατηγοριών';
protected $AX_CCT_NOCATITD = 'Εμφανίζει ή όχι, τον αριθμό των ατόμων σε κάθε κατηγορία.';
//com_contact/contact_items.xml
protected $AX_CIT_CDESC = 'Παράμετροι για μεμονωμένα Αντικείμενα Επαφών.';
protected $AX_CIT_NAMEL = 'Όνομα';
protected $AX_CIT_NAMED = 'Εμφανίζει ή όχι, την πληροφορία του Ονόματος.';
protected $AX_CIT_POSITL = 'Θέση';
protected $AX_CIT_POSITD = 'Εμφανίζει ή όχι, την πληροφορία της Θέσης.';
protected $AX_CIT_EMAILL = 'Email';
protected $AX_CIT_EMAILD = 'Εμφανίζει ή όχι, την πληροφορία του Email. Εάν επιλέξετε να εμφανίζεται, τότε θα προστατεύεται από τα spambots με τη χρήση απόκρυψης μέσω javascript.';
protected $AX_CIT_SADDREL = 'Διεύθυνση Αλληλογραφίας';
protected $AX_CIT_SADDRED = 'Εμφανίζει ή όχι, την πληροφορία της Διεύθυνσης Αλληλογραφίας.';
protected $AX_CIT_TOWNL = 'Πόλη/Προάστειο';
protected $AX_CIT_TOWND = 'Εμφανίζει ή όχι, την πληροφορία της Πόλης.';
protected $AX_CIT_STATEL = 'Περιοχή';
protected $AX_CIT_STATED = 'Εμφανίζει ή όχι, την πληροφορία της Περιοχής.';
protected $AX_CIT_COUNTRL = 'Χώρα';
protected $AX_CIT_COUNTRD = 'Εμφανίζει ή όχι, την πληροφορία της Χώρας.';
protected $AX_CIT_ZIPL = 'Ταχ. Κώδικας';
protected $AX_CIT_ZIPD = 'Εμφανίζει ή όχι, την πληροφορία του Τ.Κ.';
protected $AX_CIT_TELL = 'Τηλέφωνο';
protected $AX_CIT_TELD = 'Εμφανίζει ή όχι, την πληροφορία του Τηλεφώνου.';
protected $AX_CIT_FAXL = 'Fax';
protected $AX_CIT_FAXD = 'Εμφανίζει ή όχι, την πληροφορία του Fax';
protected $AX_CIT_MISCL = 'Διάφορες Πληροφορίες';
protected $AX_CIT_MISCD = 'Εμφανίζει ή όχι, τις Διάφορες Πληροφορίες.';
protected $AX_CIT_VCARDL = 'Vcard';
protected $AX_CIT_VCARDD = 'Εμφανίζει ή όχι, τη δυνατότητα Vcard.';
protected $AX_CIT_CIMGL = 'Εικόνα';
protected $AX_CIT_CIMGD = 'Εμφανίζει ή όχι, την εικόνα.';
protected $AX_CIT_DEMAILL = 'Περιγραφή Email';
protected $AX_CIT_DEMAILD = 'Εμφανίζει ή όχι, το παρακάτω κείμενο.';
protected $AX_CIT_DTXTL = 'Κείμενο Περιγραφής';
protected $AX_CIT_DTXTD = 'Το κείμενο της Περιγραφής. Αν το αφήσετε κενό, θα χρησιμοποιηθεί ο ορισμός _EMAIL_DESCRIPTION από το αρχείο της γλώσσας.';
protected $AX_CIT_EMFRML = 'Email Από';
protected $AX_CIT_EMFRMD = 'Εμφανίζει ή όχι, το Email Από.';
protected $AX_CIT_EMCPYL = 'Αντίγραφο του Email';
protected $AX_CIT_EMCPYD = 'Εμφανίζει ή όχι, το πλαίσιο επιλογής για την αποστολή ενός αντιγράφου του μηνύματος, στη διεύθυνση του αποστολέα.';
protected $AX_CIT_DDL = 'Λίστα Επιλογής';
protected $AX_CIT_DDD = 'Εμφανίζει ή όχι, τη Λίστα Επιλογής Επαφών.';
protected $AX_CIT_ICONTXL = 'Εικονίδια/Κείμενο';
protected $AX_CIT_ICONTXD = 'Επιλέξτε αν θα εμφανίζονται Εικονίδια, Κείμενο ή Τίποτα, δίπλα στις πληροφορίες επαφών που παρουσιάζονται.';
protected $AX_CIT_ICONS = 'Εικονίδια';
protected $AX_CIT_TEXT = 'Κείμενο';
protected $AX_CIT_NONE = 'Τίποτα';
protected $AX_CIT_ADICONL = 'Εικονίδιο Διεύθυνσης';
protected $AX_CIT_ADICOND = 'Εικονίδιο για την πληροφορία της Διεύθυνσης.';
protected $AX_CIT_EMICONL = 'Εικονίδιο Email';
protected $AX_CIT_EMICOND = 'Εικονίδιο για την πληροφορία του Email.';
protected $AX_CIT_TLICONL = 'Εικονίδιο Τηλεφώνου';
protected $AX_CIT_TLICOND = 'Εικονίδιο για την πληροφορία του Τηλεφώνου.';
protected $AX_CIT_FXICONL = 'Εικονίδιο Fax';
protected $AX_CIT_FXICOND = 'Εικονίδιο για την πληροφορία του Fax.';
protected $AX_CIT_MCICONL = 'Εικονίδιο Διάφ. Πληροφ.';
protected $AX_CIT_MCICOND = 'Εικονίδιο για την πληροφορία των Διαφόρων. Πληροφοριών.';
protected $AX_CCT_NAMEL = 'Όνομα';
protected $AX_CCT_NAMED = 'Εμφανίζει ή όχι, την πληροφορία του Ονόματος.';
protected $AX_CCT_POSITL = 'Θέση';
protected $AX_CCT_POSITD = 'Εμφανίζει ή όχι, την πληροφορία της Θέσης.';
protected $AX_CCT_EMAILL = 'Email';
protected $AX_CCT_EMAILD = 'Εμφανίζει ή όχι, την πληροφορία του Email. Εάν επιλέξετε να εμφανίζεται, τότε θα προστατεύεται από τα spambots με τη χρήση απόκρυψης μέσω javascript.';
protected $AX_CCT_SADDREL = 'Διεύθυνση Αλληλογραφίας';
protected $AX_CCT_SADDRED = 'Εμφανίζει ή όχι, την πληροφορία της Διεύθυνσης Αλληλογραφίας.';
protected $AX_CCT_TOWNL = 'Πόλη/Περιοχή';
protected $AX_CCT_TOWND = 'Εμφανίζει ή όχι, την πληροφορία της Πόλης.';
protected $AX_CCT_STATEL = 'Νομός';
protected $AX_CCT_STATED = 'Εμφανίζει ή όχι, την πληροφορία του Νομού.';
protected $AX_CCT_COUNTRL = 'Χώρα';
protected $AX_CCT_COUNTRD = 'Εμφανίζει ή όχι, την πληροφορία της Χώρας.';
protected $AX_CCT_ZIPL = 'Ταχ. Κώδικας';
protected $AX_CCT_ZIPD = 'Εμφανίζει ή όχι, την πληροφορία του Τ.Κ.';
protected $AX_CCT_TELL = 'Τηλέφωνο';
protected $AX_CCT_TELD = 'Εμφανίζει ή όχι, την πληροφορία του αριθμού Τηλεφώνου.';
protected $AX_CCT_FAXL = 'Fax';
protected $AX_CCT_FAXD = 'Εμφανίζει ή όχι, την πληροφορία του αριθμού Fax.';
protected $AX_CCT_MISCL = 'Διάφορες Πληροφορίες';
protected $AX_CCT_MISCD = 'Εμφανίζει ή όχι, τις Διάφορες Πληροφορίες.';
protected $AX_CCT_VCARDL = 'Vcard';
protected $AX_CCT_VCARDD = 'Εμφανίζει ή όχι, τη δυνατότητα Vcard.';
protected $AX_CCT_CIMGL = 'Εικόνα';
protected $AX_CCT_CIMGD = 'Εμφανίζει ή όχι, την εικόνα.';
protected $AX_CCT_DEMAILL = 'Περιγραφή Email';
protected $AX_CCT_DEMAILD = 'Εμφανίζει ή όχι, το παρακάτω κείμενο.';
protected $AX_CCT_DTXTL = 'Κείμενο Περιγραφής';
protected $AX_CCT_DTXTD = 'Το κείμενο της Περιγραφής. Αν το αφήσετε κενό, θα χρησιμοποιηθεί ο ορισμός _EMAIL_DESCRIPTION από το αρχείο της γλώσσας.';
protected $AX_CCT_EMFRML = 'Email Από';
protected $AX_CCT_EMFRMD = 'Εμφανίζει ή όχι, το Email Από.';
protected $AX_CCT_EMCPYL = 'Αντίγραφο του Email';
protected $AX_CCT_EMCPYD = 'Εμφανίζει ή όχι, το πλαίσιο επιλογής για την αποστολή ενός αντιγράφου του μηνύματος, στη διεύθυνση του αποστολέα.';
protected $AX_CCT_DDL = 'Λίστα Επιλογής';
protected $AX_CCT_DDD = 'Εμφανίζει ή όχι, τη Λίστα Επιλογής Επαφών.';
protected $AX_CCT_ICONTXL = 'Εικονίδια/Κείμενο';
protected $AX_CCT_ICONTXD = 'Επιλέξτε αν θα εμφανίζονται Εικονίδια, Κείμενο ή Τίποτα, δίπλα στις πληροφορίες επαφών που παρουσιάζονται.';
protected $AX_CCT_ICONS = 'Εικονίδια';
protected $AX_CCT_TEXT = 'Κείμενο';
protected $AX_CCT_NONE = 'Τίποτα';
protected $AX_CCT_ADICONL = 'Εικονίδιο Διεύθυνσης';
protected $AX_CCT_ADICOND = 'Εικονίδιο για την πληροφορία της Διεύθυνσης.';
protected $AX_CCT_EMICONL = 'Εικονίδιο Email';
protected $AX_CCT_EMICOND = 'Εικονίδιο για την πληροφορία του Email.';
protected $AX_CCT_TLICONL = 'Εικονίδιο Τηλεφώνου';
protected $AX_CCT_TLICOND = 'Εικονίδιο για την πληροφορία του Τηλεφώνου.';
protected $AX_CCT_FXICONL = 'Εικονίδιο Fax';
protected $AX_CCT_FXICOND = 'Εικονίδιο για την πληροφορία του Fax.';
protected $AX_CCT_MCICONL = 'Εικονίδιο Διάφ. Πληροφ.';
protected $AX_CCT_MCICOND = 'Εικονίδιο για την πληροφορία των Διαφόρων Πληροφοριών.';
//com_content/content.xml
protected $AX_CNT_CDESC = 'Εμφανίζει μία σελίδα περιεχομένου.';
protected $AX_CNT_INTEXTL = 'Εισαγωγικό Κείμενο';
protected $AX_CNT_INTEXTD = 'Εμφανίζει ή όχι το εισαγωγικό κείμενο.';
protected $AX_CNT_KEYRL = 'Κωδικός Αναφοράς';
protected $AX_CNT_KEYRD = 'Ένας κωδικός (κείμενο) με το οποίο μπορούμε να αναφερθούμε στο αντικείμενο (χρησιμοποιείται για τη δημιουργία help server για το Elxis).';
//com_frontpage/frontpage.xml
protected $AX_FP_CDESC = 'Αυτό το component, εμφανίζει όλα τα δημοσιευμένα αντικείμενα περιεχομένου, τα οποία έχουν επιλεγεί για εμφάνιση στην αρχική σελίδα.';
//com_login/login.xml
protected $AX_LG_CDESC = 'Παράμετροι για μεμονωμένα Αντικείμενα Επαφών';
protected $AX_LG_LPTL = 'Τίτλος Σελίδας Σύνδεσης';
protected $AX_LG_LPTD = 'Το κείμενο που θα εμφανίζεται στη κορυφή της σελίδας. Αν το αφήσετε κενό, θα χρησιμοποιηθεί το Όνομα του Μενού.';
protected $AX_LG_LRURLL = 'URL Ανακατεύθυνσης μετά τη Σύνδεση';
protected $AX_LG_LRURLD = 'Επιλέξτε τη σελίδα που θα προβάλλεται στο μέλος αμέσως μετά τη σύνδεσή του με το σύστημα. Αν το αφήσετε κενό θα εμφανίζεται η αρχική σελίδα';
protected $AX_LG_LJSML = 'Μήνυμα Σύνδεσης JS';
protected $AX_LG_LJSMD = 'Εμφανίζει ή όχι με τη βοήθεια της JavaScript, ένα αναδυώμενο παράθυρο που επιβεβαιώνει την επιτυχή σύνδεση';
protected $AX_LG_LDESCL = 'Περιγραφή Σύνδεσης';
protected $AX_LG_LDESCD = 'Εμφανίζει ή όχι, το παρακάτω κείμενο σύνδεσης';
protected $AX_LG_LDESTL = 'Κείμενο Περιγραφής Σύνδεσης';
protected $AX_LG_LDESTD = 'Κείμενο που εμφανίζεται στη σελίδα σύνδεσης. Εάν το αφήσετε κενό, θα χρησιμοποιηθεί το _LOGIN_DESCRIPTION από το αρχείο γλώσσας';
protected $AX_LG_LIMGL = 'Εικόνα Σύνδεσης';
protected $AX_LG_LIMGD = 'Εικόνα για τη Σελίδα Σύνδεσης';
protected $AX_LG_LIMGAL = 'Στοίχιση Εικόνας Σύνδεσης';
protected $AX_LG_LIMGAD = 'Η στοίχιση της εικόνας σύνδεσης';
protected $AX_LG_LOPTL = 'Τίτλος Σελίδας Αποσύνδεσης';
protected $AX_LG_LOPTD = 'Κείμενο που εμφανίζεται στην κορυφή της σελίδας. Εάν το αφήσετε κενό θα χρησιμοποιηθεί το όνομα του μενού';
protected $AX_LG_LORURLL = 'URL Ανακατεύθυνσης μετά την Αποσύνδεση';
protected $AX_LG_LORURLD = 'Επιλέξτε τη σελίδα που θα προβάλλεται στο μέλος αμέσως μετά την αποσύνδεσή του από το σύστημα. Αν το αφήσετε κενό θα εμφανίζεται η αρχική σελίδα';
protected $AX_LG_LOJSML = 'Μήνυμα Αποσύνδεσης JS';
protected $AX_LG_LOJSMD = 'Εμφανίζει ή όχι με τη βοήθεια της JavaScript, ένα αναδυώμενο παράθυρο που επιβεβαιώνει την επιτυχή αποσύνδεση';
protected $AX_LG_LODSCL = 'Περιγραφή Αποσύνδεσης';
protected $AX_LG_LODSCD = 'Εμφανίζει ή όχι, το παρακάτω κείμενο αποσύνδεσης';
protected $AX_LG_LODSTL = 'Κείμενο Περιγραφής Αποσύνδεσης';
protected $AX_LG_LODSTD = 'Κείμενο που εμφανίζεται στη σελίδα αποσύνδεσης. Εάν το αφήσετε κενό, θα χρησιμοποιηθεί το _LOGOUT_DESCRIPTION από το αρχείο γλώσσας';
protected $AX_LG_LOGOIL = 'Εικόνα Αποσύνδεσης';
protected $AX_LG_LOGOID = 'Εικόνα για τη Σελίδα Αποσύνδεσης';
protected $AX_LG_LOGOIAL = 'Στοίχιση Εικόνας Αποσύνδεσης';
protected $AX_LG_LOGOIAD = 'Η στοίχιση της εικόνας αποσύνδεσης';
//com_massmail/massmail.xml
protected $AX_MM_CDESC = 'Αυτό το component σας επιτρέπει να στέλνετε μαζικά, μηνύματα σε συγκεκριμένες ομάδες.';
//com_media/media.xml
protected $AX_ME_CDESC = 'Αυτό το component διαχειρίζεται τα πολυμέσα του ιστότοπου.';
//com_menumanager/menumanager.xml
protected $AX_MNU_CDESC = 'Αυτό το component διαχειρίζεται τα Μενού σας.';
//com_menus/component_item_link/component_item_link.xml
protected $AX_MUCIL_CNAME = 'Σύνδεσμος προς Αντικείμενο Component';
protected $AX_MUCIL_CDESC = 'Δημιουργεί ένα σύνδεσμο προς ένα Component του Elxis.';
//com_menus/components/components.xml
protected $AX_MUCOMP_CNAME = 'Component';
protected $AX_MUCOMP_CDESC = 'Εμφανίζει το περιβάλλον διαχείρισης ενός Component.';
//com_menus/contact_category_table/contact_category_table.xml
protected $AX_MUCCT_CNAME = 'Κατηγορία Επαφών (εμφάνιση πίνακα)';
protected $AX_MUCCT_CDESC = 'Εμφανίζει με μορφή πίνακα, τα Αντικείμενα Επαφών μίας συγκεκριμένης κατηγορίας επαφών.';
protected $AX_MUCCT_CATDL = 'Περιγραφή Κατηγορίας';
protected $AX_MUCCT_CATDD = 'Εμφανίζει ή όχι, τη Περιγραφή για τη λίστα των άλλων κατηγοριών.';
//com_menus/contact_item_link/contact_item_link.xml
protected $AX_MUCTIL_CNAME = 'Σύνδεσμος προς Αντικείμενο Επαφής';
protected $AX_MUCTIL_CDESC = 'Δημιουργεί ένα σύνδεσμο προς ένα Δημοσιευμένο Αντικείμενο Επαφής';
//com_menus/content_archive_category/content_archive_category.xml
protected $AX_MUCAC_CNAME = 'Αρχείο Κατηγορίας Περιεχομένου (εμφάνιση blog)';
protected $AX_MUCAC_CDESC = 'Εμφανίζει σε μορφή blog, Αντικείμενα Περιεχομένου μίας συγκεκριμένης Κατηγορίας, που έχουν τοποθετηθεί στο αρχείο.';
//com_menus/content_archive_section/content_archive_section.xml
protected $AX_MUCAS_CNAME = 'Αρχείο Ενότητας Περιεχομένου (εμφάνιση blog)';
protected $AX_MUCAS_CDESC = 'Εμφανίζει σε μορφή blog, Αντικείμενα Περιεχομένου μίας συγκεκριμένης Ενότητας, που έχουν τοποθετηθεί στο αρχείο.';
//com_menus/content_blog_category/content_blog_category.xml
protected $AX_MUCBC_CNAME = 'Κατηγορία Περιεχομένου (εμφάνιση blog)';
protected $AX_MUCBC_CDESC = 'Εμφανίζει Αντικείμενα Περιεχομένου από μία Κατηγορία με μορφή Blog.';
//com_menus/content_blog_section/content_blog_section.xml
protected $AX_MUCBS_CNAME = 'Ενότητα Περιεχομένου (εμφάνιση blog)';
protected $AX_MUCBS_CDESC = 'Εμφανίζει Αντικείμενα Περιεχομένου από μία Ενότητα με μορφή Blog (εμφανίζει και τις κατηγορίες της ενότητας).';
protected $AX_MUCBS_SHSD = 'Εμφανίζει ή όχι τη Περιγραφή της Ενότητας.';
//com_menus/content_category/content_category.xml
protected $AX_MUCC_CNAME = 'Κατηγορία Περιεχομένου (εμφάνιση πίνακα)';
protected $AX_MUCC_CDESC = 'Εμφανίζει με μορφή πίνακα, τα Αντικείμενα Περιεχομένου μίας συγκεκριμένης Κατηγορίας.';
protected $AX_MUCC_SHLOCD = 'Εμφανίζει ή όχι τη λίστα των άλλων Κατηγοριών.';
//com_menus/content_item_link/content_item_link.xml
protected $AX_MCIL_CNAME = 'Σύνδεσμος προς Αντικείμενο Περιεχομένου';
protected $AX_MCIL_CDESC = 'Δημιουργεί ένα σύνδεσμο προς ένα δημοσιευμένο Αντικείμενο Περιεχομένου. Το αντικείμενο παρουσιάζεται πλήρες.';
//com_menus/content_section/content_section.xml
protected $AX_MCS_CNAME = 'Ενότητα Περιεχομένου (εμφάνιση πίνακα)';
protected $AX_MCS_CDESC = 'Δημιουργεί μία λίστα Κατηγοριών περιεχομένου που ανήκουν σε μία συγκεκριμένη Ενότητα.';
protected $AX_MCS_STL = 'Τίτλος Ενότητας';
protected $AX_MCS_STD = 'Εμφανίζει ή όχι, τον τίτλο της Ενότητας';
protected $AX_MCS_SHCTID = 'Εμφανίζει ή όχι, την εικόνα περιγραφής της Κατηγορίας.';
//com_menus/content_typed/content_typed.xml
protected $AX_MLSC_CNAME = 'Σύνδεσμος προς Αυτόνομη Σελίδα';
protected $AX_MLSC_CDESC = 'Δημιουργεί ένα σύνδεσμο, προς μία Αυτόνομη Σελίδα.';
//com_menus/newsfeed_category_table/newsfeed_category_table.xml
protected $AX_MNSFC_CNAME = 'Κατηγορία Δελτίων Τύπου (εμφάνιση πίνακα)';
protected $AX_MNSFC_CDESC = 'Εμφανίζει με τη μορφή πίνακα, τα Δελτία Τύπου μίας συγκεκριμένης Κατηγορίας.';
protected $AX_MNSFC_SHNCD = 'Εμφανίζει ή όχι, τη στήλη του Ονόματος.';
protected $AX_MNSFC_ACL = 'Στήλη Άρθρων';
protected $AX_MNSFC_ACD = 'Εμφανίζει ή όχι, τη στήλη των Άρθρων.';
protected $AX_MNSFC_LCL = 'Στήλη Συνδέσμου';
protected $AX_MNSFC_LCD = 'Εμφανίζει ή όχι, τη στήλη του Συνδέσμου.';
//com_menus/newsfeed_link/newsfeed_link.xml
protected $AX_MNSFL_CNAME = 'Σύνδεσμος προς Δελτίο Τύπου';
protected $AX_MNSFL_CDESC = 'Δημιουργεί ένα σύνδεσμο προς ένα συγκεκριμένο δημοσιευμένο Δελτίο Τύπου.';
protected $AX_MNSFL_FDIML = 'Εικόνα Δελτίου Τύπου';
protected $AX_MNSFL_FDIMD = 'Εμφανίζει ή όχι, την εικόνα του Δελτίου Τύπου.';
protected $AX_MNSFL_FDDSL = 'Περιγραφή του Δελτίου Τύπου';
protected $AX_MNSFL_FDDSD = 'Εμφανίζει ή όχι, το κείμενο περιγραφής του Δελτίου Τύπου.';
protected $AX_MNSFL_WDCL = 'Πλήθος Λέξεων';
protected $AX_MNSFL_WDCD = 'Σας δίνει τη δυνατότητα να περιορίσετε το μήκος της ορατής περιγραφής. Τιμή 0, σημαίνει: εμφάνισε όλο το κείμενο.';
//com_menus/separator/separator.xml
protected $AX_MSEP_CNAME = 'Διαχωριστής / Χωροθέτης';
protected $AX_MSEP_CDESC = 'Δημιουργεί ένα νέο χωροθέτη μενού ή νεό διαχωριστικό.';
//com_menus/url/url.xml
protected $AX_MURL_CNAME = 'Σύνδεσμος - URL';
protected $AX_MURL_CDESC = 'Δημιουργεί ένα Σύνδεσμο προς ένα URL.';
//com_menus/weblink_category_table/weblink_category_table.xml
protected $AX_MWLC_CNAME = 'Κατηγορία Συνδέσμων (εμφάνιση πίνακα)';
protected $AX_MWLC_CDESC = 'Εμφανίζει με τη μορφή πίνακα, αντικείμενα συνδέσμων που ανήκουν σε μία συγκεκριμένη Κατηγορία Συνδέσμων.';
//com_menus/wrapper/wrapper.xml
protected $AX_MWRP_CNAME = 'Περιτύλιγμα';
protected $AX_MWRP_CDESC = 'Με τη βοήθειά του, μπορείτε να παρουσιάσετε μία εξωτερική εφαρμογή ή ιστότοπο, μέσω του Elxis.';
protected $AX_MWRP_SCRBL = 'Γραμμές Κύλισης';
protected $AX_MWRP_SCRBD = 'Εμφάνιση ή όχι, των οριζόντων και κάθετων γραμμών κύλισης.';
protected $AX_MWRP_WDTL = 'Πλάτος';
protected $AX_MWRP_WDTD = 'Πλάτος του IFrame παραθύρου. Μπορείτε να εισάγετε ένα απόλυτο μέγεθος σε pixels, ή ένα σχετικό μέγεθος προσθέτοντας το σύμβολο %.';
protected $AX_MWRP_HEIL = 'Ύψος';
protected $AX_MWRP_HEID = 'Ύψος του IFrame παραθύρου.';
protected $AX_MWRP_AHL = 'Αυτόματο Ύψος';
protected $AX_MWRP_AHD = 'Το ύψος θα προσαρμόζεται αυτόματα στο ύψος της εξωτερικής σελίδας. Είναι αποτελεσματικό μόνο για σελίδες που βρίσκονται στο δικό σας domain.';
protected $AX_MWRP_AADL = 'Αυτόματη Προσθήκη http';
protected $AX_MWRP_AADD = 'Εξ ορισμού προστίθεται αυτόματα το http://, στην αρχή του URL, εκτός και αν το έχει ήδη προσθέσει ο χρήστης. Μπορείτε να απενεργοποιήσετε αυτή τη δυνατότητα.';
//com_menus/system/system.xml
protected $AX_MSYS_CNAME = 'Δεσμός συστήματος';
protected $AX_MSYS_CDESC = 'Δημιουργεί ένα σύνδεσμο προς μία λειτουργία του συστήματος';
//com_newsfeeds/newsfeeds.xml
protected $AX_NFE_CDESC = 'Αυτό το component διαχειρίζεται τα RSS/RDF δελτία τύπου.';
protected $AX_NFE_DPD = 'Περιγραφή για τη σελίδα';
protected $AX_NFE_SHFNCD = 'Εμφάνιση ή όχι, της στήλης του ονόματος του δελτίου τύπου.';
protected $AX_NFE_NOACL = '# Στήλη Άρθρων';
protected $AX_NFE_NOACD = 'Εμφάνιση ή όχι, του πλήθους των άρθρων στο δελτίο τύπου.';
protected $AX_NFE_LCL = 'Στήλη Συνδέσμου';
protected $AX_NFE_LCD = 'Εμφάνιση ή όχι, της στήλης του συνδέσμου του δελτίου τύπου.';
protected $AX_NFE_IDL = 'Περιγραφή Αντικειμένου';
protected $AX_NFE_IDD = 'Εμφάνιση ή όχι, της περιγραφής ή εισαγωγικού κειμένου ενός αντικειμένου.';
//com_search/search.xml
protected $AX_SEAR_CDESC = 'Αυτό το component διαχειρίζεται τη λειτουργικότητα της αναζήτησης.';
//com_syndicate/syndicate.xml
protected $AX_SYN_CDESC = 'Αυτό το component ελέγχει τις ρυθμίσεις του Συνδικάτου.';
protected $AX_SYN_CACHL = 'Προσωρινή Μνήμη';
protected $AX_SYN_CACHD = 'Αποθήκευση στη Πρ. Μνήμη των αρχείων δελτίων τύπου.';
protected $AX_SYN_CACHTL = 'Χρόνος Πρ. Μνήμης';
protected $AX_SYN_CACHTD = 'Το αρχείο Πρ. Μνήμης, θα ανανεώνεται κάθε Χ δευτερόλεπτα.';
protected $AX_SYN_ITMSL = 'Πλήθος Αντικειμένων';
protected $AX_SYN_ITMSD = 'Πλήθως Αντικειμένων που θα είναι διαθέσιμα ως Δελτία Τύπου.';
protected $AX_SYN_ITMSDFLT = 'Δελτίο τύπου Elxis';
protected $AX_SYN_DESCD = 'Περιγραφή Συνδικάτου';
protected $AX_SYN_DESCDFLT = 'Συνδικάτο ιστότοπου Elxis';
protected $AX_SYN_IMGD = 'Εικόνα για συμπερίληψη στην τροφοδοσία.';
protected $AX_SYN_TITLE = 'Τίτλος Συνδικάτου';
protected $AX_SYN_IMGAL = 'Εναλλακτικό κείμενο εικόνας';
protected $AX_SYN_IMGAD = 'Εναλλακτικό κείμενο εικόνας.';
protected $AX_SYN_IMGADFLT = 'Τροφοδοτήθηκε από το Elxis';
protected $AX_SYN_LMTL = 'Όριο Κειμένου';
protected $AX_SYN_LMTD = 'Περιορίζει το μήκος του κείμενο του άρθρου στην παρακάτω τιμή.';
protected $AX_SYN_TLENL = 'Μήκος Κειμένου';
protected $AX_SYN_TLEND = 'Το πλήθος των λέξεων του άρθρου. Η τιμή 0 σημαίνει καθόλου κείμενο.';
protected $AX_SYN_LBL = 'Ενεργοί Σελιδοδείκτες';
protected $AX_SYN_LBD = 'Ενεργοποίηση υποστήριξης λειτουργίας Live Bookmarks για Firefox.';
protected $AX_SYN_BFL = 'Αρχείο Σελιδοδεικτών';
protected $AX_SYN_BFD = 'Ειδικό όνομα αρχείου. Εάν είναι κενό, θα χρησιμοποιηθεί το προκαθορισμένο όνομα.';
protected $AX_SYN_ORDL = 'Κατάταξη';
protected $AX_SYN_ORDD = 'Η σειρά με την οποία θα εμφανίζονται τα αντικείμενα';
protected $AX_SYN_MULTIL = 'Πολυγλωσσικά feed';
protected $AX_SYN_MULTILD = 'Αν ναι, το Elxis θα δημιουργήσει ξεχωριστά feeds για κάθε γλώσσα.';
//com_trash/trash.xml
protected $AX_TRSH_CDESC = 'Αυτό το component διαχειρίζεται τη λειτουργικότητα του Κάδου Ανακύκλωσης.';
//com_typedcontent/typedcontent.xml
protected $AX_TDC_CDESC = 'Εμφανίζει τη σελίδα ενός μεμονωμένου αντικειμένου.';
//com_weblinks/weblinks.xml
protected $AX_WBL_CDESC = 'Αυτό το component εμφανίζει μία λίστα ιστότοπων με αποσπάσματα οθονών από αυτά.';
protected $AX_WBL_LDL = 'Περιγραφή Συνδέσμου';
protected $AX_WBL_LDD = 'Εμφάνιση ή όχι, του κειμένου περιγραφής των συνδέσμων.';
protected $AX_WBL_ICL = 'Εικονίδιο';
protected $AX_WBL_ICD = 'Το εικονίδιο που θα εμφανίζεται στα αριστερά των συνδέσμων στην εμφάνιση με μορφή πίνακα.';
protected $AX_WBL_SCSL = 'Απόσπασμα Οθόνης';
protected $AX_WBL_SCSD = 'Εμφανίζει απόσπασμα από την οθόνη του ιστότοπου. Εάν χρησιμοποιείται, δεν θα εμφανίζονται τα παραπάνω εικονίδια.';
//com_weblinks/weblinks_item.xml
protected $AX_WBLI_TD = 'Επιλέξτε σε ποιο παράθυρο θέλετε να ανοίγει.';
protected $AX_WBLI_OT01 = 'Γονικό Παράθυρο με Στοιχεία Πλοήγησης';
protected $AX_WBLI_OT02 = 'Νέο Παράθυρο με Στοιχεία Πλοήγησης';
protected $AX_WBLI_OT03 = 'Νέο Παράθυρο χωρίς Στοιχεία Πλοήγησης';
//ADMINISTRATOR MODULES
//administrator/modules/mod_latest.xml
protected $AX_AM_LN_DESC = 'Αυτό το module εμφανίζει μία λίστα των πιο πρόσφατα δημοσιευμένων Αντικειμένων τα οποία είναι ακόμη δημοσιευμένα (κάποια από αυτά, μπορεί να έχουν λήξει, ακόμη και αν είναι δημοσιευμένα). Αντικείμενα τα οποία εμφανίζονται στο Component της Πρώτης Σελίδας, δεν περιλαμβάνονται στη λίστα.'; 
//administrator/modules/mod_logged.xml
protected $AX_AM_LG_DESC = 'Αυτό το module εμφανίζει μία λίστα των πιο πρόσφατα συνδεδεμένων χρηστών.'; 
//administrator/modules/mod_popular.xml
protected $AX_AM_PI_DESC = 'Αυτό το module εμφανίζει μία λίστα των πιο δημοφιλών (περισσότερες εμφανίσεις) αντικειμένων.'; 
//administrator/modules/mod_stats.xml
protected $AX_AM_ST_DESC = 'Αυτό το module εμφανίζει στατιστικά για Αντικείμενα τα οποία είναι ακόμη δημοσιευμένα (κάποια από αυτά, μπορεί να έχουν λήξει, ακόμη και αν είναι δημοσιευμένα). Αντικείμενα τα οποία εμφανίζονται στο Component της Πρώτης Σελίδας, δεν περιλαμβάνονται στη λίστα.'; 
//SITE MODULES
//General
protected $AX_SM_MCSL = 'Επίθεμα Κλάσης Module'; 
protected $AX_SM_MCSD = 'Μπορείτε να προσθέσετε ένα επίθεμα στην προκαθορισμένη CSS κλάση του module (.moduletable). Έτσι μπορείτε να επιτύχετε τη τροποποίηση της εμφάνισής του.'; 
protected $AX_SM_MUCSL = 'Επίθεμα Κλάσης Μενού'; 
protected $AX_SM_MUCSD = 'Μπορείτε να προσθέσετε ένα επίθεμα στην προκαθορισμένη CSS κλάση των Αντικειμένων Μενού και να τροποποιήσετε την εμφάνισή τους.'; 
protected $AX_SM_ECL = 'Ενεργοποίηση Προσωρ. Μνήμης'; 
protected $AX_SM_ECD = 'Επιλέξτε αν θέλετε να αποθηκεύετε στη προσωρινή μνήμη τα περιεχόμενα αυτού του module.'; 
protected $AX_SM_SMIL = 'Εμφάνιση Εικονίδιων Μενού'; 
protected $AX_SM_SMID = 'Εμφανίζει τα Εικονίδια Μενού που έχετε επιλέξει για τα Αντικείμενα Μενού.'; 
protected $AX_SM_MIAL = 'Στοίχιση Εικονιδίου Μενού'; 
protected $AX_SM_MIAD = 'Επιλέγετε τη στοίχιση των Εικονιδίων Μενού.'; 
protected $AX_SM_MODL = 'Κατάσταση Module'; 
protected $AX_SM_MODD = 'Σας επιτρέπει να ελέγχετε το τύπο του περιεχομένου που θα εμφανίζεται στο module.'; 
protected $AX_SM_OP01 = 'Μόνο Αντικείμενα Περιεχομένου'; 
protected $AX_SM_OP02 = 'Μόνο Αυτόνομες Σελίδες'; 
protected $AX_SM_OP03 = 'Και τα Δύο'; 
//modules/custom.xml
protected $AX_SM_CU_DESC = 'Custom Module'; 
protected $AX_SM_CU_RSURL = 'URL του RSS'; 
protected $AX_SM_CU_RSURD = 'Εισάγετε τη διεύθυνση URL του δελτίου τύπου RSS/RDF.'; 
protected $AX_SM_CU_FEDL = 'Περιγραφή Δελτίου Τύπου'; 
protected $AX_SM_CU_FEDD = 'Εμφανίζει το κείμενο περιγραφής για όλο το δελτίο τύπου.'; 
protected $AX_SM_CU_FEIL = 'Εικόνα Δελτ. Τύπου'; 
protected $AX_SM_CU_FEDID = 'Εμφανίζει την εικόνα που είναι συσχετισμένη με όλο το Δελτίο Τύπου.'; 
protected $AX_SM_CU_ITL = 'Πλήθος Αντικειμένων'; 
protected $AX_SM_CU_ITD = 'Εισάγετε τον αριθμό των αντικειμένων RSS που θέλετε να εμφανίσετε.'; 
protected $AX_SM_CU_ITDL = 'Περιγραφή Αντικειμένου'; 
protected $AX_SM_CU_ITDD = 'Εμφανίζει τη περιγραφή ή το εισαγωγικό κείμενο μεμονομένων αντικειμένων ειδήσεων.'; 
protected $AX_SM_CU_WCL = 'Πλήθος Λέξεων'; 
protected $AX_SM_CU_WCD = 'Σας επιτρέπει να ελέγχετε τον όγκο το εμφανιζόμενου κειμένου περιγραφής. Η τιμή 0 σημαίνει δείξε όλο το κείμενο'; 
//modules/mod_archive.xml
protected $AX_SM_AR_DESC = 'Αυτό το module εμφανίζει μία λίστα των ημερολογιακών μηνών, που περιέχουν αρχειοθετημένα αντικείμενα. Αφού αλλάξετε τη κατάσταση ενός Αντικειμένου Περιεχομένου σε \'Αρχειοθετημένο\', θα δημιουργηθεί αυτόματα αυτή η λίστα.'; 
protected $AX_SM_AR_CNTL = 'Πλήθος'; 
protected $AX_SM_AR_CNTD = 'Το πλήθος των αντικειμένων που θα εμφανίζονται (η προκαθορισμένη τιμή είναι 10).'; 
//modules/mod_banners.xml
protected $AX_SM_BN_DESC = 'Το banner module σας επιτρέπει να εμφανίζετε στον ιστότοπο τις ενεργές διαφημίσεις του αντίστοιχου component.'; 
protected $AX_SM_BN_CNTL = 'Πελάτης Διαφήμισης'; 
protected $AX_SM_BN_CNTD = "Αναφορά στα ids των πελατών των διαφημίσεων. Μπορείτε να εισάγετε περισσότερα από ένα, διαχωρισμένα με \',\'!"; 
protected $AX_SM_BN_NBSL = "Πλήθος εμφανιζόμενων Διαφημίσεων";
protected $AX_SM_BN_NBPRL = "Διαφημίσεις ανά γραμμή";
protected $AX_SM_BN_NBPRD = "Αριθμός διαφημίσεων ανά γραμμή. Για απενεργοποίηση ορίστε την τιμή σε 0. Για κατακόρυφη εμφάνιση, ορίστε την τιμή σε 1";
protected $AX_SM_BN_UNQBL = "Μοναδικές Διαφημίσεις";
protected $AX_SM_BN_UNQBD = "Καμία διαφήμιση δεν εμφανίζεται περισσότερες από μία φορές (ανά session). Αν έχουν εμφανιστεί όλες οι διαφημίσεις, το ιστορικό εκκαθαρίζεται και επανεκκινείται.";
//modules/mod_latestnews.xml
protected $AX_SM_LN_DESC = 'Αυτό το module εμφανίζει μία λίστα των πιο πρόσφατα δημοσιευμένων και ενεργών Αντικειμένων (κάποια μπορεί να έχουν λήξει, παρόλο που ανήκουν στα πιο πρόσφατα). Δεν περιλαμβάνονται τα αντικείμενα τα οποία δημοσιεύονται μέσω του Component της Πρώτης Σελίδας.'; 
protected $AX_SM_LN_FPIL = 'Αντικείμενα Πρώτης Σελίδας'; 
protected $AX_SM_LN_FPID = 'Εμφανίζει ή όχι, τα αντικείμενα τα οποία έχουν ανατεθεί στη Πρώτη Σελίδα - Έχει αποτέλεσμα στη κατάσταση, Μόνο Αντικείμενα Περιεχομένου.'; 
protected $AX_SM_AR_CNT5D = 'Το πλήθος των αντικειμένων που θέλουμε να εμφανιστούν (προκαθορισμένη τιμή 5).'; 
protected $AX_SM_LN_CATIL = 'ID Κατηγορίας'; 
protected $AX_SM_LN_CATID = "Επιλέξτε αντικείμενα από μία ορισμένη Κατηγορία ή ομάδες Κατηγοριών (για να ορίσετε περισσότερες από μία Κατηγορίες, χρησιμοποιήστε ως διαχωριστικό το \',\' )."; 
protected $AX_SM_LN_SECIL = 'ID Ενότητας'; 
protected $AX_SM_LN_SECID = "Επιλέξτε αντικείμενα από μία ορισμένη Ενότητα ή ομάδα Ενοτήτων (για να ορίσετε περισσότερες από μία ενότητες, χρησιμοποιήστε ως διαχωριστικό το \',\' )."; 
//modules/mod_login.xml
protected $AX_SM_LF_DESC = 'Αυτό το module εμφανίζει μία φόρμα εγγραφής, όπου μπορεί ο χρήστης να εισάγει το Ψευδώνυμο και το Συνθηματικό του. Επίσης εμφανίζει ένα σύνδεσμο μέσω του οποίου μπορεί να ανακτήσει το Συνθηματικό του, αν το έχει ξεχάσει. Εάν έχετε ενεργοποιήσει την επιλογή -Να Επιτρέπεται η Εγγραφή Χρηστών- από τις -Γενικές Ρυθμίσεις-, τότε θα εμφανίζεται ένας ακόμη σύνδεσμος που θα προσκαλεί τους χρήστες να εγγραφούν.'; 
protected $AX_SM_LF_PTL = 'Κείμενο Πριν'; 
protected $AX_SM_LF_PTD = 'Αυτό είναι το Κείμενο ή ο κώδικας HTML, που θα εμφανίζεται πριν από τη φόρμα εγγραφής.'; 
protected $AX_SM_LF_PSTL = 'Κείμενο Μετά'; 
protected $AX_SM_LF_PSTD = 'Αυτό είναι το Κείμενο ή ο κώδικας HTML, που θα εμφανίζεται μετά από τη φόρμα εγγραφής.'; 
protected $AX_SM_LF_LRUL = 'URL Ανακατεύθυνσης Σύνδεσης'; 
protected $AX_SM_LF_LRUD = 'Επιλέγετε σε ποια σελίδα θα οδηγηθεί ο χρήστης μετά τη σύνδεση. Εάν το αφήσετε κενό, θα οδηγηθεί στην αρχική σελίδα.'; 
protected $AX_SM_LF_LORUL = 'URL Ανακατεύθυνσης Εξόδου'; 
protected $AX_SM_LF_LORUD = 'Επιλέγετε σε ποια σελίδα θα οδηγηθεί ο χρήστης μετά την αποσύνδεση. Εάν το αφήσετε κενό, θα οδηγηθεί στην αρχική σελίδα.'; 
protected $AX_SM_LF_LML = 'Μήνυμα Σύνδεσης'; 
protected $AX_SM_LF_LMD = 'Εμφανίζει ή όχι, το pop-up παράθυρο που ανακοινώνει την επιτυχημένη σύνδεση.'; 
protected $AX_SM_LF_LOML = 'Μήνυμα Αποσύνδεσης'; 
protected $AX_SM_LF_LOMD = 'Εμφανίζει ή όχι, το pop-up παράθυρο που ανακοινώνει την επιτυχημένη αποσύνδεση.'; 
protected $AX_SM_LF_GML = 'Καλωσόρισμα'; 
protected $AX_SM_LF_GMD = 'Εμφανίζει ή όχι, το σύντομο μήνυμα καλωσορίσματος.'; 
protected $AX_SM_LF_NUNL = 'Όνομα/Ψευδώνυμο'; 
protected $AX_SM_LF_OP01 = 'Ψευδώνυμο'; 
protected $AX_SM_LF_OP02 = 'Όνομα'; 
//modules/mod_mainmenu.xml
protected $AX_SM_MNM_DESC = 'Εμφανίζει ένα μενού.'; 
protected $AX_SM_MNM_MNL = 'Όνομα Μενού'; 
protected $AX_SM_MNM_MND = "Το όνομα του μενού (προκαθορισμένη τιμή είναι \'mainmenu\')."; 
protected $AX_SM_MNM_MSL = 'Στυλ'; 
protected $AX_SM_MNM_MSD = 'Το Στυλ του Μενού.'; 
protected $AX_SM_MNM_OP1 = 'Κάθετο'; 
protected $AX_SM_MNM_OP2 = 'Οριζόντιο'; 
protected $AX_SM_MNM_OP3 = 'Επίπεδη Λίστα'; 
protected $AX_SM_MNM_EML = 'Ανάπτυξη Μενού'; 
protected $AX_SM_MNM_EMD = 'Ανέπτυξε το μενού και κάνε τα αντικείμενα των υπομενού μόνιμα ορατά.'; 
protected $AX_SM_MNM_IIL = 'Εικόνα Διαστήματος'; 
protected $AX_SM_MNM_IID = 'Επιλέξτε ποιο σύστημα εικόνων θα χρησιμοποιήσετε για τα διαστήματα.'; 
protected $AX_SM_MNM_OP4 = 'Από το Template'; 
protected $AX_SM_MNM_OP5 = 'Τις προκαθορισμένες εικόνες του Elxis'; 
protected $AX_SM_MNM_OP6 = 'Τις παρακάτω παραμέτρους'; 
protected $AX_SM_MNM_OP7 = 'Καμία'; 
protected $AX_SM_MNM_II1L = 'Εικόνα 1ου Διαστήματος'; 
protected $AX_SM_MNM_II1D = 'Εκόνα για το 1ο υπο-επίπεδο.'; 
protected $AX_SM_MNM_II2L = 'Εικόνα 2ου Διαστήματος'; 
protected $AX_SM_MNM_II2D = 'Εκόνα για το 2ο υπο-επίπεδο.'; 
protected $AX_SM_MNM_II3L = 'Εικόνα 3ου Διαστήματος'; 
protected $AX_SM_MNM_II3D = 'Εκόνα για το 3ο υπο-επίπεδο.'; 
protected $AX_SM_MNM_II4L = 'Εικόνα 4ου Διαστήματος'; 
protected $AX_SM_MNM_II4D = 'Εκόνα για το 4ο υπο-επίπεδο.'; 
protected $AX_SM_MNM_II5L = 'Εικόνα 5ου Διαστήματος'; 
protected $AX_SM_MNM_II5D = 'Εκόνα για το 5ο υπο-επίπεδο.'; 
protected $AX_SM_MNM_II6L = 'Εικόνα 6ου Διαστήματος'; 
protected $AX_SM_MNM_II6D = 'Εκόνα για το 6ο υπο-επίπεδο.'; 
protected $AX_SM_MNM_SPL = 'Διαχωριστικό'; 
protected $AX_SM_MNM_SPD = 'Διαχωριστικό για το Οριζόντιο μενού.'; 
protected $AX_SM_MNM_ESL = 'Διαχωριστικό Τέλους'; 
protected $AX_SM_MNM_ESD = 'Διαχωριστικό Τέλους για το Οριζόντιο μενού.'; 
protected $AX_SM_MNM_IDPR = 'Προφόρτωση Itemid για το SEO PRO';
protected $AX_SM_MNM_IDPRD = 'Η ενεργοποίηση της προφόρτωσης μέσω AJAX του Itemid λύνει το πρόβλημα με τον σωστό ορισμό του αντικειμένου μενού όταν έχουμε περισσότερα του ενός αντικείμενα μενού που οδηγούν στην ίδια σελίδα.';
//modules/mod_mostread.xml
protected $AX_SM_MRC_DESC = 'Αυτό το module εμφανίζει μία λίστα των δημοσιευμένων Αντικειμένων που έχουν προβληθεί τις περισσότερες φορές. Ορίζεται από το πλήθος των εμφανίσεων των αντικειμένων.'; 
protected $AX_SM_MRC_MNL = 'Όνομα Μενού'; 
protected $AX_SM_MRC_MND = 'Το όνομα του μενού (προκαθορισμένη τιμή είναι mainmenu).'; 
protected $AX_SM_MRC_FPIL = 'Αντικείμενα Πρώτης Σελίδας'; 
protected $AX_SM_MRC_FPID = "Εμφανίζει ή όχι, τα Αντικείμενα που έχουν οριστεί για τη Πρώτη Σελίδα. Λειτουργεί μόνο σε κατάσταση λειτουργίας \'Μόνο Αντικείμενα Περιεχομένου\'."; 
protected $AX_SM_MRC_CL = 'Πλήθος'; 
protected $AX_SM_MRC_CD = 'Το πλήθος των Αντικειμένων που θα εμφανίζονται (προκαθορισμένη τιμή είναι 5).'; 
protected $AX_SM_MRC_CIDL = 'ID Κατηγορίας'; 
protected $AX_SM_MRC_CIDD = "Επιλέξτε αντικείμενα από μία ορισμένη Κατηγορία ή ομάδες Κατηγοριών (για να ορίσετε περισσότερες από μία Κατηγορίες, χρησιμοποιήστε ως διαχωριστικό το \',\' )."; 
protected $AX_SM_MRC_SIDL = 'ID Ενότητας'; 
protected $AX_SM_MRC_SIDD = "Επιλέξτε αντικείμενα από μία ορισμένη Ενότητα ή ομάδα Ενοτήτων (για να ορίσετε περισσότερες από μία Ενότητες, χρησιμοποιήστε ως διαχωριστικό το \',\' )."; 
//modules/mod_newsflash.xml
protected $AX_SM_NWF_DESC = 'Το module Σύντομη Είδηση, επιλέγει και εμφανίζει τυχαία, ένα από τα δημοσιευμένα αντικείμενα μίας Κατηγορίας, κατά την ανανέωση της σελίδας. Μπορεί επίσης να παρουσιάσει πολλαπλά Αντικείμενα σε οριζόντια ή κάθετη διάταξη.'; 
protected $AX_SM_NWF_CATL = 'Κατηγορία'; 
protected $AX_SM_NWF_CATD = 'Μία Κατηγορία Περιεχομένου'; 
protected $AX_SM_NWF_STL = 'Μορφή'; 
protected $AX_SM_NWF_STD = 'Η μορφή με την οποία θα εμφανιστεί η κατηγορία.'; 
protected $AX_SM_NWF_OP1 = 'Τυχαία Επιλογή'; 
protected $AX_SM_NWF_OP2 = 'Οριζόντια'; 
protected $AX_SM_NWF_OP3 = 'Κάθετα'; 
protected $AX_SM_NWF_SIL = 'Εμφάνιση Εικόνων'; 
protected $AX_SM_NWF_SID = 'Εμφανίζει και τις εικόνες από τα Αντικείμενα Περιεχομένου.'; 
protected $AX_SM_NWF_LTL = 'Συνδεδεμένοι Τίτλοι'; 
protected $AX_SM_NWF_LTD = 'Κάνει τους τίτλους των Αντικειμένων να συμπεριφέρονται σαν σύνδεσμοι.'; 
protected $AX_SM_NWF_RML = 'Διαβάστε Περισσότερα'; 
protected $AX_SM_NWF_RMD = 'Εμφανίζει ή όχι, το κουμπί Διαβάστε Περισσότερα.'; 
protected $AX_SM_NWF_ITL = 'Τίτλος Αντικειμένου'; 
protected $AX_SM_NWF_ITD = 'Εμφανίζει το τίτλο του Αντικειμένου.'; 
protected $AX_SM_NWF_NOIL = 'Πλήθος Αντικειμένων'; 
protected $AX_SM_NWF_NOID = 'Το πλήθος των αντικειμένων που θα εμφανίζονται.'; 
//modules/mod_poll.xml
protected $AX_SM_POL_DESC = 'Αυτό το module, συμπληρώνει το component των Δημοσκοπήσεων. Χρησιμοποιείται για να εμφανίζει τις δημοσκοπήσεις που έχετε ρυθμίσει. Το module διαφέρει από άλλα modules καθώς υποστηρίζει διασύνδεση μεταξύ Αντικειμένων Μενού και Δημοσκοπήσεων. Αυτό σημαίνει ότι το module εμφανίζει μόνο εκείνες τις Δημοσκοπήσεις, οι οποίες έχουν οριστεί σε κάποιο συγκεκριμένο Αντικείμενο Μενού.'; 
protected $AX_SM_POL_CATL = 'Κατηγορία'; 
protected $AX_SM_POL_CATD = 'Μία Κατηγορία Περιεχομένου.'; 
//modules/mod_random_image.xml
protected $AX_SM_RNI_DESC = 'Αυτό το module εμφανίζει μία τυχαία εικόνα από τον επιλεγμένο κατάλογο.'; 
protected $AX_SM_RNI_ITL = 'Τύπος Εικόνας'; 
protected $AX_SM_RNI_ITD = 'Τύπος εικόνας PNG/GIF/JPG κ.λπ. (η προκαθορισμένη τιμή είναι JPG).'; 
protected $AX_SM_RNI_IFL = 'Κατάλογος Εικόνων'; 
protected $AX_SM_RNI_IFD = 'Η σχετική διαδρομή προς το κατάλογο των εικόνων, π.χ.: images/stories'; 
protected $AX_SM_RNI_LNL = 'Σύνδεσμος'; 
protected $AX_SM_RNI_LND = 'Η διεύθυνση URL στην οποία θα οδηγηθεί ο χρήστης, αν κάνει κλικ επάνω στην εικόνα, π.χ.: http://www.elxis.org'; 
protected $AX_SM_RNI_WL = 'Πλάτος (px)'; 
protected $AX_SM_RNI_WD = 'Το πλάτος της εικόνας (εξαναγκάζει όλες τις εικόνες να εμφανιστούν με αυτό το πλάτος).'; 
protected $AX_SM_RNI_HL = 'Ύψος (px)'; 
protected $AX_SM_RNI_HD = 'Το ύψος της εικόνας (εξαναγκάζει όλες τις εικόνες να εμφανιστούν με αυτό το ύψος).'; 
//modules/mod_related_items.xml
protected $AX_SM_RLI_DESC = "Αυτό το module εμφανίζει άλλα Αντικείμενα Περιεχομένου, τα οποία σχετίζονται με το Αντικείμενο που παρουσιάζεται. Η επιλογή τους βασίζεται στις λέξεις κλειδιά των Metadata. Όλες οι λέξεις κλειδιά του τρέχοντος Αντικειμένου Περιεχομένου, αντιπαραβάλλονται με τις λέξεις κλειδιά των άλλων δημοσιευμένων αντικειμένων. Για παράδειγμα, μπορεί να έχετε ένα Αντικείμενο σχετικά με την 'Ελλάδα' και ένα άλλο σχετικά με τον 'Παρθενώνα'. Εάν συμπεριλάβετε τη λέξη κλειδί 'Ελλάδα' και στα δύο αντικείμενα, τότε το module των Σχετιζόμενων Αντικειμένων, θα εμφανίσει το Αντικείμενο 'Ελλάδα' όταν βλέπετε το Αντικείμενο 'Παρθενώνας' και αντίστροφα."; 
//modules/mod_rssfeed.xml
protected $AX_SM_RSS_DESC = 'Το module Συνεργασίας εμφανίζει ένα σύνδεσμο, μέσω του οποίου άλλοι άνθρωποι μπορούν να συνεργαστούν με τον ιστότοπό σας, παρουσιάζοντας τις τελευταίες ειδήσεις σας. Όταν κάνετε κλικ στο εικονίδιο του RSS, θα ανακατευθυνθείτε σε μία νέα σελίδα που θα εμφανίσει όλα τα τελευταία νέα σε μορφή XML. Προκειμένου να χρησιμοποιήσετε αυτό το δελτίο τύπου σε κάποιο άλλο ιστότοπο ή σε έναν αναγνώστη Newsfeed, θα πρέπει να αντιγράψετε και να επικολλήσετε τη διεύθυνση URL.'; 
protected $AX_SM_RSS_TXL = 'Κείμενο'; 
protected $AX_SM_RSS_TXD = 'Εισάγετε το κείμενο που θα εμφανίζεται μαζί με τους συνδέσμους RSS.'; 
protected $AX_SM_RSS_091D = 'Εμφάνιση/Απόκρυψη συνδέσμου RSS 0.91.';
protected $AX_SM_RSS_10D = 'Εμφάνιση/Απόκρυψη συνδέσμου RSS 1.0.';
protected $AX_SM_RSS_20D = 'Εμφάνιση/Απόκρυψη συνδέσμου RSS 2.0.';
protected $AX_SM_RSS_03D = 'Εμφάνιση/Απόκρυψη συνδέσμου Atom 0.3.';
protected $AX_SM_RSS_OPD = 'Εμφάνιση/Απόκρυψη συνδέσμου OPML.';
protected $AX_SM_RSS_I091L = 'Εικόνα RSS 0.91';
protected $AX_SM_RSS_I10L = 'Εικόνα RSS 1.0';
protected $AX_SM_RSS_I20L = 'Εικόνα RSS 2.0';
protected $AX_SM_RSS_I03L = 'Εικόνα Atom';
protected $AX_SM_RSS_IOPL = 'Εικόνα OPML';
protected $AX_SM_RSS_CHID = 'Επιλέξτε την εικόνα που θα χρησιμοποιηθεί.';
//modules/mod_search.xml
protected $AX_SM_SEM_DESC = 'Αυτό το module εμφανίζει ένα πλαίσιο αναζήτησης.';
protected $AX_SM_SEM_TOP = 'Επάνω';
protected $AX_SM_SEM_BTM = 'Κάτω';
protected $AX_SM_SEM_BWL = 'Πλάτος Πεδίου';
protected $AX_SM_SEM_BWD = 'Το μέγεθος του πεδίου αναζήτησης.';
protected $AX_SM_SEM_TXL = 'Κείμενο';
protected $AX_SM_SEM_TXD = 'Το κείμενο που εμφανίζεται στο πεδίο αναζήτησης. Εάν το αφήσετε κενό, θα χρησιμοποιήσει τη τιμή του _SEARCH_BOX από το αρχείο γλώσσας.';
protected $AX_SM_SEM_BPL = 'Θέση Κουμπιού'; 
protected $AX_SM_SEM_BPD = 'Η θέση του κουμπιού αναζήτησης σε σχέση με το πεδίο αναζήτησης.'; 
protected $AX_SM_SEM_BTXL = 'Κείμενο Κουμπιού'; 
protected $AX_SM_SEM_BTXD = 'Το κείμενο που θα εμφανίζεται στο κουμπί αναζήτησης. Εάν το αφήσετε κενό, θα φορτώσει τη τιμή του _SEARCH_TITLE από το αρχείο γλώσσας.'; 
//modules/mod_sections.xml
protected $AX_SM_SEC_DESC = 'Το module Ενοτήτων, εμφανίζει μία λίστα με όλες τις Ενότητες που έχετε ορίσει. Λέγοντας Ενότητα σε αυτό το σημείο, αναφερόμαστε μόνο στις Ενότητες Περιεχομένου. Εάν στις Γενικές Ρυθμίσεις δεν έχετε επιλέξει τη παράμετρο \'Εμφάνιση των Μη Εγκεκριμένων Συνδέσμων\', η λίστα θα περιορίζεται μόνο στις Ενότητες που επιτρέπεται να δει ο χρήστης.'; 
protected $AX_SM_SEC_CL = 'Πλήθος'; 
protected $AX_SM_SEC_CD = 'Το πλήθος των αντικειμένων που θα παρουσιάζονται. Η προκαθορισμένη τιμή είναι 5.'; 
//modules/mod_stats.xml
protected $AX_SM_STA_DESC = 'Το module των Στατιστικών, εμφανίζει πληροφορίες σχετικά με τον server σας, πληροφορίες σχετικά με τους επισκέπτες σας, το πλήθος των περιεχομένων στη βάση δεδομένων, και τον αριθμό των συνδέσμων που προσφέρετε.'; 
protected $AX_SM_STA_SVIL = 'Πληροφορίες για το Server'; 
protected $AX_SM_STA_SVID = 'Εμφάνιση πληροφοριών για το Server.'; 
protected $AX_SM_STA_SIL = 'Πληροφορίες Ιστότοπου'; 
protected $AX_SM_STA_SID = 'Εμφάνιση πληροφοριών για τον ιστότοπο.'; 
protected $AX_SM_STA_HCL = 'Μετρητής Επιτυχιών'; 
protected $AX_SM_STA_HCD = 'Εμφανίζει το μετρητή επιτυχιών.'; 
protected $AX_SM_STA_ICL = 'Αύξηση Μετρητή'; 
protected $AX_SM_STA_ICD = 'Εισάγετε τον αριθμό των επιτυχιών, με τον οποίο θέλετε να αυξήσετε τον μετρητή.'; 
//modules/mod_templatechooser.xml
protected $AX_SM_TMC_DESC = 'Το module επιλογής Template, επιτρέπει στο χρήστη (επισκέπτη) να αλλάζει από το δημόσιο τμήμα, το template βάσει του οποίου εμφανίζεται ο ιστότοπος, χρησιμοποιώντας μία λίστα επιλογών.'; 
protected $AX_SM_TMC_MNLL = 'Μέγιστο Μήκος Ονόματος'; 
protected $AX_SM_TMC_MNLD = 'Επιλέγετε το πλήθος των χαρακτήρων από το όνομα του template, που θα γίνονται ορατοί (προκαθορισμένη τιμή 20).'; 
protected $AX_SM_TMC_SPL = 'Εμφάνιση Προεπισκόπησης'; 
protected $AX_SM_TMC_SPD = 'Θα είναι ορατή η προεπισκόπηση του template.'; 
protected $AX_SM_TMC_WL = 'Πλάτος'; 
protected $AX_SM_TMC_WD = 'Ορίζει το πλάτος της εικόνας προεπισκόπησης (προκαθορισμένη τιμή 140 px).'; 
protected $AX_SM_TMC_HL = 'Ύψος'; 
protected $AX_SM_TMC_HD = 'Αυτό είναι το ύψος της εικόνας προεπισκόπησης (προκαθορισμένη τιμή 90 px).'; 
//modules/mod_whosonline.xml
protected $AX_SM_WSO_DESC = "Αυτό το module εμφανίζει τον αριθμό των Ανώνυμων χρηστών και των Εγγεγραμμένων χρηστών που έχουν αυτή τη στιγμή πρόσβαση στον ιστότοπο."; 
protected $AX_SM_WSO_DL = 'Εμφάνιση'; 
protected $AX_SM_WSO_DD = 'Επιλέξτε το τι θα εμφανίζεται.'; 
protected $AX_SM_WSO_OP1 = '# Επισκεπτών/Μελών<br />'; 
protected $AX_SM_WSO_OP2 = 'Ονόματα Μελών<br />'; 
protected $AX_SM_WSO_OP3 = 'Και τα δύο'; 
//modules/mod_wrapper.xml
protected $AX_SM_WRM_DESC = 'Αυτό το module εμφανίζει μέσα σε ένα παράθυρο IFrame μία συγκεκριμένη τοποθεσία, π.χ. κάποιον άλλο ιστότοπο.'; 
protected $AX_SM_WRM_URLL = 'URL'; 
protected $AX_SM_WRM_URLD = 'Η διεύθυνση URL του ιστότοπου/αρχείου που θέλετε να εμφανίσετε μέσα στο παράθυρο IFrame.'; 
protected $AX_SM_WRM_SCBL = 'Γραμμές Κύλισης'; 
protected $AX_SM_WRM_SCBD = 'Εμφανίζει ή όχι, τις Οριζόντιες και Κάθετες γραμμές κύλισης.'; 
protected $AX_SM_WRM_WL = 'Πλάτος'; 
protected $AX_SM_WRM_WD = 'Το πλάτος του IFrame παραθύρου. Μπορείτε να εισάγετε ένα απόλυτο μέγεθος σε pixels, ή ένα σχετικό μέγεθος, προσθέτοντας το % στο τέλος.'; 
protected $AX_SM_WRM_HL = 'Ύψος'; 
protected $AX_SM_WRM_HD = 'Το ύψος του παραθύρου IFrame.'; 
protected $AX_SM_WRM_AHL = 'Αυτόματο Ύψος'; 
protected $AX_SM_WRM_AHD = 'Το ύψος θα υπολογίζεται αυτόματα, σύμφωνα με το μέγεθος της εξωτερικής σελίδας. Είναι λειτουργικό μόνο για σελίδες που ανήκουν στο δικό σας domain.'; 
protected $AX_SM_WRM_ADL = 'Αυτόματη Προσθήκη'; 
protected $AX_SM_WRM_ADD = 'Εξ ορισμού, προστίθεται στη διεύθυνση το http://, εκτός και αν το έχετε ήδη συμπεριλάβει, συμπεριλαμβανομένου και του https://. Μπορείτε από εδώ, να απενεργοποιήσετε αυτή τη δυνατότητα.'; 
/* mambots/editors/tinymce */
protected $AX_ED_FUNCTL = 'Κατάσταση Λειτουργίας'; 
protected $AX_ED_FUNCTD = 'Επιλογή κατάστασης λειτουργίας. Σας συνιστούμε την Ανεπτυγμένη κατάσταση καθώς έχετε τις περισσότερες επιλογές.'; 
protected $AX_ED_FUNSIMPLE = 'Απλή'; 
protected $AX_ED_FUNADV = 'Ανεπτυγμένη';
protected $AX_ED_EDITORWIDTHL = 'Πλάτος Επεξεργαστή';
protected $AX_ED_EDITORWIDTHD = 'Ορίζει το πλάτος του παραθύρου του επεξεργαστή';
protected $AX_ED_EDITORHEIGHTL = 'Ύψος Επεξεργαστή';
protected $AX_ED_EDITORHEIGHTD = 'Ορίζει το ύψος του παραθύρου του επεξεργαστή';
protected $AX_ED_COMPRESSEDVL = 'Συμπιεσμένη Μορφή';
protected $AX_ED_COMPRESSEDVD = 'Ο TinyMCE μπορεί να εκτελεστεί σε συμπιεσμένη μορφή. Με αυτό το τρόπο επιτυγχάνονται ελαφρώς ταχύτεροι χρόνοι φόρτωσης.  Λάβετε υπόψη σας, ότι αυτός ο τρόπος λειτουργίας δεν λειτουργεί πάντα, ειδικά στον IE. Για αυτό η προκαθορισμένη τιμή είναι Ανενεργή.  Αφού ενεργοποιήσετε αυτή την επιλογή, βεβαιωθείτε ότι λειτουργεί σωστά στο σύστημά σας.';
protected $AX_ED_OFF = 'Ανενεργή';
protected $AX_ED_ON = 'Ενεργή';
protected $AX_ED_COMPRESSL = 'Συμπίεση';
protected $AX_ED_COMPRESSD = 'Συμπίεση του TinyMCE Editor με χρήση gzip (φορτώνει 75% ταχύτερα)';
protected $AX_ED_CONVERTURLL = 'Μετατροπή URLs';
protected $AX_ED_CONVERTURLD = 'Μετατροπή των Απόλυτων URLs σε σχετικά.';
protected $AX_ED_ENTENCODL = 'Κωδικοποίηση Οντοτήτων';
protected $AX_ED_ENTENCODD = 'Αυτή η επιλογή ελέγχει το πως επεξεργάζεται ο επεξεργαστής τις οντότητες/χαρακτήρες. Οι επιλογές είναι: Αριθμητική Παράσταση, Ονοματιζόμενες Οντότητες και Χωρίς Επεξεργασία, κατά την οποία δεν γίνεται καμία επεξεργασία. Η προκαθορισμένη επιλογή αυτής της παραμέτρου είναι Χωρίς Επεξεργασία.';
protected $AX_ED_TXTDIRL = 'Κατεύθυνση Κειμένου';
protected $AX_ED_TXTDIRD = 'Ικανότητα αλλαγής κατεύθυνσης';
protected $AX_ED_CNVFONTSPANL = 'Μετατροπή των tag Font σε Spans';
protected $AX_ED_CNVFONTSPAND = 'Η προκαθορισμένη επιλογή είναι να γίνεται μετατροπή των tag font σε tag span. Αυτό συμβαίνει γιατί τα tag font είναι απηρχαιωμένα.';
protected $AX_ED_FONTSIZETYPEL = 'Μέγεθος Γραμματοσειράς';
protected $AX_ED_FONTSIZETYPED = 'Επιλέξτε το τρόπο με τον οποίο θα ορίζεται το μέγεθος της γραμματοσειράς. Μπορείτε να επιλέξετε Μέγεθος π.χ. 10pt, ή Απόλυτο Μέγεθος π.χ. x-small.';
protected $AX_ED_INLTABLEDITL = 'Επιτόπου Επεξεργασία των Πινάκων';
protected $AX_ED_INLTABLEDITD = 'Επιτρέπει την επιτόπου επεξεργασία των Πινάκων.';
protected $AX_ED_PROHELEMENTSL = 'Απαγορευμένα Στοιχεία';
protected $AX_ED_PROHELEMENTSD = 'Στοιχεία τα οποία θα αφαιρούνται από το κείμενο';
protected $AX_ED_EXTELEMENTSL = 'Επεκτάσιμα Στοιχεία';
protected $AX_ED_EXTELEMENTSD = 'Μπορείτε να επεκτείνετε τη λειτουργικότητα του TinyMCE προσθέτοντας εδώ έξτρα στοιχεία. Μορφή: elm[tag1|tag2]';
protected $AX_ED_EVELEMENTSL = 'Στοιχεία Συμβάντων';
protected $AX_ED_EVELEMENTSD = 'Ορίστε (χρησιμοποιώντας το κόμμα σα διαχωριστικό), μία λίστα από τα στοιχεία τα οποία μπορούν να περιέχουν ιδιότητες συμβάντων, όπως onclick, και συναφείς. Αυτή η επιλογή χρειάζεται καθώς κάποιοι περιηγητές, εκτελούν αυτά τα συμβάντα, κατά την επεξεργασία του περιεχομένου.';
protected $AX_ED_TCSSCLASSESL = 'CSS Κλάσεις από το Template';
protected $AX_ED_TCSSCLASSESD = 'Να φορτώνονται οι CSS κλάσεις που χρησιμοποιούνται στο αρχείο template_css.css';
protected $AX_ED_CCSSCLASSESL = 'CSS Κλάσεις από άλλο αρχείο';
protected $AX_ED_CCSSCLASSESD = 'Μπορείτε να επιλέξετε τη χρήση κλάσεων CSS από άλλο αρχείο. Απλά εισάγετε το όνομα του αρχείου CSS. Το αρχείο ΘΑ ΠΡΕΠΕΙ να βρίσκεται στον ίδιο φάκελο με το αρχείο template_css.css.';
protected $AX_ED_NEWLINESL = 'Αλλαγές Γραμμών';
protected $AX_ED_NEWLINESD = 'Επιλέξτε το στοιχείο (tag) που θα χρησιμοποιείται για να περιγράψει τις αλλαγές γραμμών.';
protected $AX_ED_TOOLBARL = 'Γραμμή Εργαλείων';
protected $AX_ED_TOOLBARD = 'Επιλέξτε τη θέση της γραμμής εργαλείων';
protected $AX_ED_HTMLHEIGHTL = 'Ύψος παράθυρου HTML';
protected $AX_ED_HTMLHEIGHTD = 'Ορίζει το ύψος του αναδυώμενου παραθύρου εμφάνισης του κώδικα HTML.';
protected $AX_ED_HTMLWIDTHL = 'Πλάτος παράθυρου HTML';
protected $AX_ED_HTMLWIDTHD = 'Ορίζει το πλάτος του αναδυώμενου παραθύρου εμφάνισης του κώδικα HTML.';
protected $AX_ED_PREVIEWHEIGHTL = 'Ύψος παράθυρου Προεπισκόπησης';
protected $AX_ED_PREVIEWHEIGHTD = 'Ορίζει το ύψος του αναδυώμενου παραθύρου Προεπισκόπησης';
protected $AX_ED_PREVIEWWIDTHL = 'Πλάτος παράθυρου Προεπισκόπησης';
protected $AX_ED_PREVIEWWIDTHD = 'Ορίζει το πλάτος του αναδυώμενου παραθύρου Προεπισκόπησης';
protected $AX_ED_IBROWSERL = 'Πρόσθετο iBrowser';
protected $AX_ED_IBROWSERD = 'Ο iBrowser είναι ένας δυνατός και ευέλικτος διαχειριστής εικόνων';
protected $AX_ED_PLTABLESL = 'Πρόσθετο Πινάκων';
protected $AX_ED_PLTABLESD = 'Ενεργοποιεί το διαχειριστή πινάκων σε λειτουργία WYSIWYG.';
protected $AX_ED_PLPASTEL = 'Πρόσθετο Επικόλλησης';
protected $AX_ED_PLPASTED = 'Ενεργοποιεί τη δυνατότητα επικόλλησης από το Word, επικόλλησης σαν Απλό Κείμενο και τη δυνατότητα Επιλογής Όλου του Περιεχομένου.';
protected $AX_ED_PLIMGPLUGINL = 'Εξελιγμένη Διαχείριση Εικόνων';
protected $AX_ED_PLIMGPLUGIND = 'Ενεργοποιεί τον Εξελιγμένο Διαχειριστή Εικόνων. Εξ ορισμού είναι ενεργοποιημένη η απλή του έκδοση.';
protected $AX_ED_PLSEARCHL = 'Πρόσθετο Αναζήτησης/Αντικατάστασης';
protected $AX_ED_PLSEARCHD = 'Ενεργοποιεί το πρόσθετο Αναζήτησης και Αντικατάστασης.';
protected $AX_ED_PLLINKSL = 'Εξελιγμένη Διαχείριση Συνδέσμων';
protected $AX_ED_PLLINKSD = 'Ενεργοποιεί τον Εξελιγμένο Διαχειριστή Συνδέσμων. Εξ ορισμού είναι ενεργοποιημένη η απλή του έκδοση.';
protected $AX_ED_PLEMOTL = 'Πρόσθετο Emoticons';
protected $AX_ED_PLEMOTD = 'Ενεργοποιεί τη δυνατότητα προσθήκης Emoticons.';
protected $AX_ED_PLFLASHL = 'Πρόσθετο Flash';
protected $AX_ED_PLFLASHD = 'Ενεργοποιεί το πρόσθετο Flash. Θα μπορείτε να προσθέτετε αντικείμενα Flash στο περιεχόμενό σας.';
protected $AX_ED_PLDTL = 'Πρόσθετο Ημερομηνίας/Ώρας';
protected $AX_ED_PLDTD = 'Ενεργοποιεί το πρόσθετο Ημερομηνίας/Ώρας. Θα μπορείτε να προσθέτετε γρήγορα τη τρέχουσα ημερομηνία και ώρα.';
protected $AX_ED_PLPREVL = 'Πρόσθετο Προεπισκόπησης';
protected $AX_ED_PLPREVD = 'Αυτό το πρόσθετο εισάγει ένα κουμπί προεπισκόπησης στον TinyMCE. Πατώντας το, ανοίγει ένα αναδυώμενο παράθυρο με το τρέχον περιεχόμενο.';
protected $AX_ED_PLZOOML = 'Πρόσθετο Μεγέθυνσης';
protected $AX_ED_PLZOOMD = 'Προσθέτει μία λίστα με τις διαθέσιμες μεγεθύνσεις. Συμβατό μόνο με τον MSIE5.5+.';
protected $AX_ED_PLFSCRL = 'Πρόσθετο Πλήρους Οθόνης';
protected $AX_ED_PLFSCRD = 'Αυτό το πρόσθετο εισάγει τη δυνατότητα επεξεργασίας του περιεχομένου σε παράθυρο πλήρους οθόνης.';
protected $AX_ED_PLPRINTL = 'Πρόσθετο Εκτύπωσης';
protected $AX_ED_PLPRINTD = 'Αυτό το πρόσθετο εισάγει ένα κουμπί που σας δίνει τη δυνατότητα να εκτυπώσετε το περιεχόμενο.';
protected $AX_ED_PLDIRL = 'Πρόσθετο Κατεύθυνσης Γραφής';
protected $AX_ED_PLDIRD = 'Αυτό το πρόσθετο εισάγει δύο εικονίδια με τα οποία μπορείτε να επιλέξετε τη φορά της γραφής. Με αυτό τον τρόπο, μπορείτε να διαχειριστείτε ευκολότερα γλώσσες που γράφονται από δεξιά προς τα αριστερά.';
protected $AX_ED_PLFONTSL = 'Λίστα Επιλογής Γραμματοσειράς';
protected $AX_ED_PLFONTSD = 'Εμφανίζει μία λίστα από την οποία μπορείτε να επιλέξετε γραμματοσειρά και να αλλάξετε την εμφάνιση του επιλεγμένου κειμένου.';
protected $AX_ED_PLFONTSZL = 'Λίστα Επιλογής Μεγέθους Γραμ.';
protected $AX_ED_PLFONTSZD = 'Εμφανίζει μία λίστα από την οποία μπορείτε να επιλέξετε το μέγεθος εμφάνισης του επιλεγμένου κειμένου.';
protected $AX_ED_PLFORMLSL = 'Λίστα Μορφοποίησης';
protected $AX_ED_PLFORMLSD = 'Εμφανίζει μία λίστα με τις διαθέσιμες μορφοποιήσεις, π.χ. H1, H2, κ.λπ.';
protected $AX_ED_PLSSLL = 'Λίστα Επιλογής Στυλ';
protected $AX_ED_PLSSLD = 'Εμφανίζει μία λίστα με τα CSS στυλ που είναι διαθέσιμα στο τρέχον template. Εναλλακτικά, μπορείτε να αντλήσετε τη λίστα των στυλ από ένα αρχείο της επιλογής σας.';
protected $AX_ED_NAMED = 'Ονοματιζόμενες Οντότητες';
protected $AX_ED_NUMERIC = 'Αριθμητική Παράσταση';
protected $AX_ED_RAW = 'Χωρίς Επεξεργασία';
protected $AX_ED_LTR = 'Αριστερά προς Δεξιά';
protected $AX_ED_RTL = 'Δεξιά προς Αριστερά';
protected $AX_ED_LENGTH = 'Μήκος';
protected $AX_ED_ABSSIZE = 'Απόλυτο Μέγεθος';
protected $AX_ED_BRELEMENTS = 'Στοιχεία BR';
protected $AX_ED_PELEMENTS = 'Στοιχεία P';
//TOOLS
//Calculator: /administrator/tools/calculator/calculator.xml
protected $AX_TCAL_L = 'Υπολογιστής';
protected $AX_TCAL_D = 'Χρήσιμος υπολογιστής βασισμένος σε javascript';
//Empty Temporary: /administrator/tools/empty_temporary/empty_temporary.xml
protected $AX_TEMTEMP_L = 'Εκκαθάριση Προχείρου';
protected $AX_TEMTEMP_D = 'Αδειάζει το φάκελο προσωρινών αρχείων (/tmpr).';
//FixLanguage: /administrator/tools/fix_language/fix_language.xml
protected $AX_TFIXLANG_L = 'Διόρθωση Γλώσσας';
protected $AX_TFIXLANG_D = 'Πραγματοποιεί έναν έλεγχο στους πίνακες της βάσης δεδομένων που είναι υπεύθυνοι για την πολυγλωσσία, και πραγματοποιεί διορθώσεις αν απαιτείται.';
//Organizer: /administrator/tools/organizer/organizer.xml
protected $AX_TORGANIZ_L = 'Organizer';
protected $AX_TORGANIZ_D = 'Με το Organizer του Elxis, μπορείτε να διατηρείτε τις επαφές σας, τις σημειώσεις σας, χρήσιμους συνδέσμους και ραντεβού.';
//Clean Cache: /administrator/tools/clean_cache/clean_cache.xml
protected $AX_TCLEANCACHE_L = 'Εκκαθάριση Cache';
protected $AX_TCLEANCACHE_D = 'Καθαρίζει το κατάλογο της προσωρινής μνήμης (cache) από τα αντικείμενα και τις εικόνες που περιέχει.';
//Chmod: /administrator/tools/chmod/chmod.xml
protected $AX_TCHMOD_L = 'Αλλαγή αδειών χρήσης';
protected $AX_TCHMOD_D = 'Αλλάζει τις άδειες χρήσης σε ένα αρχείο ή κατάλογο';
//FixPgSequences: /administrator/tools/fix_pg_sequences/fix_pg_sequences.xml
protected $AX_TFPGSEQ_L = 'Διόρθωση ακολουθιών PG';
protected $AX_TFPGSEQ_D = 'Διορθώνει τις ακολουθίες (sequences) της Postgres αν απαιτείται.';
//Elxis Registration: /administrator/tools/registration/registration.xml
protected $AX_TELXREG_L = 'Δήλωση Elxis';
protected $AX_TELXREG_D = 'Δηλώνει την εγκατάσταση του Elxis σας στην GO UP O.E.';
//com_menus/bridge/bridge.xml
protected $AX_BRIDGE_CNAME = 'Γέφυρα';
protected $AX_BRIDGE_CDESC = 'Δημιουργεί ένα Σύνδεσμο προς μία γέφυρα.';
//modules/mod_language.xml
protected $AX_NEW_LINE = 'Νέα γραμμή';
protected $AX_SAME_LINE = 'Ίδια γραμμή';
protected $AX_INDICATOR = 'Δείκτης';
protected $AX_INDICATOR_D = 'Εμφανίζει τη λέξη Γλώσσα ως δείκτη';
protected $AX_FLAG = 'Σημαία';

//2008
//modules/mod_language.xml
protected $AX_MODLANGD = 'Εμφανίζει μία φόρμα ή συνδέσμους αλλαγής γλώσσας στο δημόσιο τμήμα.';
protected $AX_FLAGS = 'Σημαίες';
protected $AX_SMARTSW = 'Έξυπνος διακόπτης';
protected $AX_SMARTSW_D = 'Σας επιτρέπει, κάτω από ορισμένες προϋποθέσεις, να αλλάζετε γλώσσα και να παραμένετε στην ίδια σελίδα';
//modules/mod_random_profile.xml
protected $AX_RP_DESC = 'Εμφανίζει τυχαία προφίλ χρηστών';
protected $AX_DISPSTYLE = 'Στυλ εμφάνισης';
protected $AX_COMPACT = 'Συμπαγές';
protected $AX_EXTENDED = 'Εκτενής';
protected $AX_GENDER = 'Φύλο';
protected $AX_GENDERDESC = 'Εμφάνιση του φύλου του χρήστη;';
protected $AX_AGE = 'Ηλικία';
protected $AX_AGEDESC = 'Εμφάνιση ηλικίας χρήστη;';
protected $AX_REALUNAME = 'Εμφάνιση πραγματικού ονόματος ή ψευδωνύμου;';
//weblinks item
protected $AX_WBLI_TL = 'Στόχος';
//content
protected $AX_RTFICL = 'Εικονίδιο RTF';
protected $AX_RTFICD = 'Εμφανίζει ή όχι, το κουμπί για τη δημιουργία RTF - επηρεάζει μόνο αυτή τη σελίδα.';
//modules/mod_whosonline.xml
protected $AX_MODWHO_FILGR = 'Φιλτράρισμα ομάδων';
protected $AX_MODWHO_FILGRD = 'Αν ναι, τότε οι χρήστες με χαμηλότερο επίπεδο πρόσβασης (π.χ. επισκέπτες), δεν θα μπορούν να δουν την κατάσταση σύνδεσης χρηστών με υψηλότερο επίπεδο πρόσβασης.';
//search bots
protected $AX_SEARCH_LIMIT = 'Όριο αναζήτησης';
protected $AX_MAXNUM_SRES = 'Μέγιστος αριθμός αποτελεσμάτων αναζήτησης';
//modules/mod_frontpage
protected $AX_MODFRONTPAGE = 'Εμφανίζει μία σύνοψη των τελευταίων προσθηκών στην ιστοσελίδα. Ιδανικό για την αρχική σελίδα.'; 
protected $AX_SECTIONS = 'Ενότητες';
protected $AX_SECTIONSD = 'Κωδικοί Ενοτήτων χωρισμένοι με κόμμα (,)';
protected $AX_CATEGORIES = 'Κατηγορίες';
protected $AX_CATEGORIESD = 'Κωδικοί Κατηγοριών χωρισμένοι με κόμμα (,)';
protected $AX_NUMDAYS = 'Αριθμός ημερών';
protected $AX_NUMDAYSD = 'Εμφάνιση αντικειμένων που δημιουργήθηκαν τις τελευταίες Χ ημέρες (προκαθορισμένη τιμή 900)';
protected $AX_SHOWTHUMBS = 'Εμφάνιση μικρογραφιών';
protected $AX_SHOWTHUMBSD = 'Εμφάνιση/Απόκρυψη μικρογραφιών στο εισαγωγικό κείμενο';
protected $AX_THUMBWIDTHD = 'Πλάτος σε εικονοστοιχεία της μικρογραφίας';
protected $AX_THUMBHEIGHTD = 'Ύψος σε εικονοστοιχεία της μικρογραφίας';
protected $AX_KEEPRATIO = 'Διατήρηση αναλογιών';
protected $AX_KEEPRATIOD = 'Διατήρηση των αναλογιών της εικόνας. Αν Ναι τότε το παραπάνω ύψος δεν λαμβάνεται υπόψη.';
//com_menus/eblog_item_link/eblog_item_link.xml
protected $AX_EBLOGITEM = 'Ιστολόγιο Elxis';
protected $AX_EBLOGITEMD = 'Δημιουργεί έναν σύνδεσμο προς ένα δημοσιευμένο ιστολόγιο του eBlog';
protected $AX_COMMENTARY = 'Σχολιασμός';
protected $AX_COMMENTARYD = 'Επιλέξτε σε ποιον επιτρέπεται ο σχολιασμός αυτού του άρθρου.';
protected $AX_NOONE = 'Κανένας';
protected $AX_REGUSERS = 'Εγγεγραμμένοι χρήστες';
protected $AX_ALL = 'Όλοι';

protected $AX_COMMENTS = 'Σχόλια';
protected $AX_COMMENTSD = 'Εμφάνιση αριθμού σχολίων;';

}

?>