<?php 
/**
* @ Version: 2008.0
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Elxis Team
* @ Translator: Ioannis Sannos
* @ Translator URL: http://www.elxis.org
* # Translator E-mail: info@elxis.org
* @ Description: English language for Defender tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


DEFINE ('_DEFL_CONFIG', 'Ρυθμίσεις Υπερασπιστή Elxis (Elxis Defender)');
DEFINE ('_DEFL_CONFPERMSUCC', 'Η άδεια χρήσης του αρχείου καταγραφής του Υπερασπιστή άλλαξε επιτυχώς σε');
DEFINE ('_DEFL_CONFPERMNO', 'Δεν στάθηκε δυνατή η μετατροπή του αρχείου ρυθμίσεων του Υπερασπιστή σε εγγράψιμο');
DEFINE ('_DEFL_LOGSPERMSUCC', 'Η άδεια χρήσης του καταλόγου καταγραφής του Υπερασπιστή άλλαξε επιτυχώς σε');
DEFINE ('_DEFL_LOGSPERMNO', 'Δεν στάθηκε δυνατή η μετατροπή του καταλόγου καταγραφής του Υπερασπιστή σε εγγράψιμο');
DEFINE ('_DEFL_ENABLEDESC', 'Ενεργοποίηση ή όχι του Υπερασπιστή (Defender). Πριν την ενεργοποίηση σιγουρευτείτε ότι ο κατάλογος /administrator/tools/defender/logs είναι εγγράψιμος');
DEFINE ('_DEFL_PROTVARS', 'Προστατευμένες Μεταβλητές');
DEFINE ('_DEFL_PROTVARSD', 'Ποιες μεταβλητές να ενταχθούν υπό την προστασία του υπερασπιστή (προκαθορισμένο: REQUEST)');
DEFINE ('_DEFL_LOGATTACKS', 'Καταγραφή Επιθέσεων');
DEFINE ('_DEFL_LOGATTACKSD', 'Εάν ενεργοποιηθεί, ο Υπερασπιστής θα δημιουργήσει και θα καταγράψει μία αναφορά για κάθε επίθεση');
DEFINE ('_DEFL_MAILALERT', 'Ειδοποίηση E-mail');
DEFINE ('_DEFL_MAILALERTD', 'Εάν ενεργοποιηθεί, ο Υπερασπιστής θα στείλει ένα ενημερωτικό e-mail για κάθε επίθεση');
DEFINE ('_DEFL_MAILADDR', 'Διεύθυνση e-mail ειδοποίησης');
DEFINE ('_DEFL_SITEOFFFOR', 'Ιστοσελίδα εκτός για');
DEFINE ('_DEFL_SECONDS', 'δευτερόλεπτα');
DEFINE ('_DEFL_SITEOFFD', 'Μετά από μία επίθεση γύρνα την ιστοσελίδα σε μη-διαθέσιμη για Χ δευτερόλεπτα. 0 για απενεργοποίηση');
DEFINE ('_DEFL_BLOCKIP', 'Φραγή IP');
DEFINE ('_DEFL_BLOCKIPD', 'Φραγή διεύθυνσης IP επιτιθέμενου. Σημειώστε πως ο Υπερασπιστής θα φράξει οποιονδήποτε θεωρηθεί ως επιτιθέμενος, ακόμα και εσάς!');
DEFINE ('_DEFL_FILTERS', 'Φίλτρα');
DEFINE ('_DEFL_FILTHELP', '<b>Ο Υπερασπιστής είναι άχρηστος χωρίς φίλτρα.</b><br />
	Για να προσθέσετε ένα νέο φίλτρο, πληκτρολογήστε τη λέξη ή φράση που θέλεται να φιλτράρετε στο πεδίο προσθήκης και πατήστε <b>Add</b>.<br />
	Μην σας απασχολεί αν θα γράψετε κεφαλαίους ή μικρούς χαρακτήρες.<br />
	Πατήστε <b>DEL</b> για να αφαιρέσετε ένα φίλτρο από τη λίστα.<br />
	Αν έχετε εμπειρία από το <b>mod_Security</b> του <b>Apache</b> σκεφτείτε ότι ο Υπερασπιστής δουλεύει περίπου 
	με τον ίδιο τρόπο όταν προσθέτετε τα φίλτρα σας.<br />
	Όταν τελειώσετε, πατήστε <b>Αποθήκευση</b> για να αποθηκεύσετε τις ρυθμίσεις και τα φίλτρα σας.<br />');
DEFINE ('_DEFL_SLOWDOWNT', 'Χρόνος Καθυστέρησης');
DEFINE ('_DEFL_SLOWDOWN', 'Η χρήση του Υπερασπιστή κάνει το Elxis να τρέχει λίγο αργότερα από ότι συνήθως. 
	Η προσθήκη πολλών φίλτρων μπορεί να αυξήσει το χρόνο εκτέλεσης της php αρκετά. Σας συνιστούμε να μην προσθέσετε 
	πάνω από 15 φίλτρα αλλά ταυτόχρονα σας παρακινούμε να πειραματιστείτε καθώς αυτό εξαρτάται από την ιστοσελίδα 
	και το διακομιστή. Καλέστε κάποιον ειδικό για βοήθεια αν αντιμετωπίζετε δυσκολίες. 
	Οι εργαστηριακές μας μετρήσεις έδειξαν χρόνο καθυστέρησης από <b>0,1 ως 27 msec</b> ανάλογα με τον αριθμό των φίλτρων 
	(από 10 ως 30) και τις δηλωμένες μεταβλητές εισόδου τις οποίες είχε να αντιμετωπίσει ο Υπερασπιστής (από συνήθη περιήγηση, 
	ως υποβολή μεγάλων κειμένων μέσω της μεθόδου POST ή GET).');
DEFINE ('_DEFL_EXAMPLEFIL', 'Παραδείγματα Φιλτρων');
DEFINE ('_DEFL_DEFCONFIS', 'Το αρχείο ρυθμίσεων του Υπερασπιστή είναι');
DEFINE ('_DEFL_DEFLOGSIS', 'Ο κατάλογος καταγραφής του Υπερασπιστή είναι');
DEFINE ('_DEFL_MAKEWRITE', 'Κάντε το εγγράψιμο');
DEFINE ('_DEFL_CONFSAVESUCC', 'Οι ρυθμίσεις του Υπερασπιστή αποθηκεύτηκαν επιτυχώς!');
DEFINE ('_DEFL_CONFSAVENO', 'Δεν στάθηκε δυνατή η αποθήκευση των ρυθμίσεων του Υπερασπιστή!');
DEFINE ('_DEFL_ERRONEFILT', 'Σφάλμα: Θα πρέπει να προσθέσετε τουλάχιστον ένα φίλτρο!');
DEFINE ('_DEFL_ENCKEY', 'Κλειδί Κρυπτογράφισης');
DEFINE ('_DEFL_ENCKEYD', 'Χρησιμοποιείται για κρυπτογράφιση των στοιχείων καταγραφής. Το μήκος του κλειδιού πρέπει να είναι μεταξύ 8 και 32 χαρακτήρες. Διαγράψτε όλες τις καταγεγραμένες πληροφορίες πριν αλλάξετε κλειδί!');
DEFINE ('_DEFL_ERRENCKEY', 'Σφάλμα: Το μήκος του κλειδιού κρυπτογράφισης πρέπει να είναι μεταξύ 8 και 32 χαρακτήρες');
DEFINE ('_DEFL_ENABLEDEF', 'Ενεργοποίηση Υπερασπιστή');
DEFINE ('_DEFL_DISABLEDEF', 'Απενεργοποίηση Υπερασπιστή');
DEFINE ('_DEFL_VIEWLOGS', 'Θέαση Καταγραφών');
DEFINE ('_DEFL_CLEARLOGS', 'Εκκαθάριση Καταγραφών');
DEFINE ('_DEFL_VIEWBLOCK', 'Θέαση Φραγμένων IP');
DEFINE ('_DEFL_CLEARBLOCK', 'Εκκαθάριση Φραγμένων IP');
DEFINE ('_DEFL_DEFENDER', 'Υπερασπιστής Elxis');
DEFINE ('_DEFL_LOGSCLEARED', 'Το αρχείο καταγραφής μηδενίστηκε.');
DEFINE ('_DEFL_CNOTCLLOGS', 'Δεν στάθηκε δυνατή η εκκαθάριση των καταγραφών. Βεβαιωθείτε πως το αρχείο είναι εγγράψιμο');
DEFINE ('_DEFL_BLOCKCLEARED', 'Όλες οι φραγμένες διευθύνσεις IP διαγράφηκαν επιτυχώς.');
DEFINE ('_DEFL_CNOTCLBLOCK', 'Δεν στάθηκε δυνατή η εκκαθάριση των φραγμένων IP. Βεβαιωθείτε πως το αρχείο είναι εγγράψιμο.');
DEFINE ('_DEFL_SUBMITALERT', 'Η υποβολή φίλτρων ενώ ο Υπερασπιστής είναι ενεργός θα θεωρηθεί ως επίθεση! Παρακαλώ πρώτα απενεργοποιήστε τον Υπερασπιστή, κάντε τις αλλαγές σας και ξανά-ενεργοποιήστε τον');
DEFINE ('_DEFL_GEOLOCATE', 'Γεωγραφικός Προσδιορισμός');
DEFINE ('_DEFL_PERMSUCC', 'Η άδεια χρήσης άλλαξε σε');
DEFINE ('_DEFL_PERMFAIL', 'Δεν στάθηκε δυνατή η αλλαγή αδειών χρήσης του');
DEFINE ('_DEFL_ADDIP', 'Προσθήκη IP');
DEFINE ('_DEFL_DELETEIP', 'Διαγραφή IP');
DEFINE ('_DEFL_BLOCKEDIPS', 'Φραγμένες IP');
DEFINE ('_DEFL_IPRANGES', 'Περιοχές IP');
DEFINE ('_DEFL_ADDRANGE', 'Προσθήκη περιοχής IP');
DEFINE ('_DEFL_DELRANGE', 'Διαγραφή περιοχής IP');
DEFINE ('_DEFL_RANGEHELP', 'Για να φράξετε ένα ολόκληρο δίκτυο, παροχέα internet ή ακόμα και χώρα ο Υπερασπιστής σας δίνει 
την δυνατότητα να προσθέσετε περιοχές ip (IP ranges). Κάθε περιοχή αποτελείται από 2 τμήματα χωρισμένα με κάτω παύλα (_). Το πρώτο τμήμα 
είναι η IP εκκίνησης και το δεύτερο η ip τερματισμού. Ο Υπερασπιστής θα φράξει οποιαδήποτε ip μεταξύ αυτών των ορίων.');
DEFINE ('_DEFL_RANGEEXAMPLES', 'Παραδείγματα χρήσης');
DEFINE ('_DEFL_BLOCKFROM', 'θα φράξει τις IP από');
DEFINE ('_DEFL_BLOCKTO', 'ως');
DEFINE ('_DEFL_ALLOWIPS', 'Επιτρεπόμενες διευθύνσεις IP');
DEFINE ('_DEFL_ALLOWIPSD', 'Αν ενεργοποιηθεί θα μπορείτε να ορίσετε τις διευθύνσεις IP στις οποίες και μόνο θα επιτρέπεται η πρόσβαση στη διαχείριση ή/και στο δημόσιο τμήμα της ιστοσελίδας');
DEFINE ('_DEFL_FRONTBACK', 'Δημ.Τμήμα και Διαχείριση');
DEFINE ('_DEFL_ALLOWDIS', 'Η λειτουργία των Επιτρεπόμενων IP είναι απενεργοποιημένη');
DEFINE ('_DEFL_ONLACCADM', 'Μόνο οι παρακάτω διευθύνσεις IP έχουν πρόσβαση στη Διαχείριση');
DEFINE ('_DEFL_ONLACCSAD', 'Μόνο οι παρακάτω διευθύνσεις IP έχουν πρόσβαση στην Ιστοσελίδα και την Διαχείριση');

?>
