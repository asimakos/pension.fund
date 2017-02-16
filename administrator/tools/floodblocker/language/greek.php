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
* @ Description: Greek language for FloodBlocker tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


DEFINE ('_FLOODL_CONFIG', 'Ρυθμίσεις προστασίας υπερχείλισης (FloodBlocker)');
DEFINE ('_FLOODL_CONFPERMSUCC', 'Η άδεια χρήσης του αρχείου καταγραφής του FloodBlocker άλλαξε επιτυχώς σε');
DEFINE ('_FLOODL_CONFPERMNO', 'Δεν στάθηκε δυνατή η μετατροπή του αρχείου ρυθμίσεων του FloodBlocker σε εγγράψιμο');
DEFINE ('_FLOODL_LOGSPERMSUCC', 'Η άδεια χρήσης του καταλόγου καταγραφής του FloodBlocker άλλαξε επιτυχώς σε');
DEFINE ('_FLOODL_LOGSPERMNO', 'Δεν στάθηκε δυνατή η μετατροπή του καταλόγου καταγραφής του FloodBlocker σε εγγράψιμο');
DEFINE ('_FLOODL_INVINTER', 'Άκυρο χρονικό διάκενο!');
DEFINE ('_FLOODL_INVTIME', 'Άκυρη χρονικό διάστημα λήξης αρχείου καταγραφής!');
DEFINE ('_FLOODL_ONEPAIR', 'Πρέπει να δώσετε τουλάχιστον ένα έγκυρο ζεύγος διακένου-ορίου!');
DEFINE ('_FLOODL_CONFSAVESUCC', 'Το αρχείο ρυθμίσεων του FloodBlocker αποθηκεύτηκε επιτυχώς!');
DEFINE ('_FLOODL_CONFSAVENO', 'Δεν στάθηκε δυνατή η αποθήκευση του αρχείου ρυθμίσεων του FloodBlocker!');
DEFINE ('_FLOODL_ENABLEDESC', 'Ενεργοποίηση ή όχι της προστασίας κατά της υπερχείλισης (flood). Πριν την ενεργοποίηση σιγουρευτείτε ότι ο κατάλογος /tools/floodblocker/logs είναι εγγράψιμος');
DEFINE ('_FLOODL_CRONINT', 'Χρονικό διάκενο');
DEFINE ('_FLOODL_CRONINTDESC', 'Χρονικό διάκενο εκτέλεσης σε δευτερόλεπτα. Προκαθορισμένη τιμή: 1800 δευτ. (30 λεπτά)');
DEFINE ('_FLOODL_LOGSTIME', 'Λήξη αρχείου καταγραφής');
DEFINE ('_FLOODL_LOGSTIMEDESC', 'Μετά από πόσα δευτερόλεπτα να θεωρείται το αρχείο καταγραφής ως παλαιό; Η προκαθορισμήνη τιμή είναι 7200 δευτ. (2 ώρες)');
DEFINE ('_FLOODL_FLOODRULES', 'Κανόνες υπερχείλισης');
DEFINE ('_FLOODL_INTSECS', 'Διάκενο (δευτερόλεπτα)');
DEFINE ('_FLOODL_LIMREQS', 'Όριο (αιτήσεις)');
DEFINE ('_FLOODL_FLOODCONFIS', 'Το αρχείο ρυθμίσεων του FloodBlocker είναι');
DEFINE ('_FLOODL_FLOODLOGSIS', 'Ο κατάλογος καταγραφής του FloodBlocker είναι');
DEFINE ('_FLOODL_MAKEWRITE', 'Κάντε το εγγράψιμο');
DEFINE ('_FLOODL_PAIRSDESC', 'Ένας συσχετιζόμενος πίνακας {ΔΙΑΚΕΝΟΥ} => {ΟΡΙΟΥ}, όπου {ΟΡΙΟ} είναι ο αριθμός 
	των επιτρεπόμενων αιτήσεων (κλικς) κατά την διάρκεια {ΔΙΑΚΕΝΟΥ} δευτερολέπων. 
	Χρησιμοποιήστε όσα ζεύγη κανόνων επιθυμείτε. Ενδεικτικοί κανόνες:<br>
	&nbsp; &nbsp; - κανόνας 1: 10=>10 (μέγιστο 10 αιτήσεις σε 10 δευτ.)<br>
	&nbsp; &nbsp; - κανόνας 2: 60=>30 (μέγιστο 30 αιτήσεις σε 60 δευτ.)<br>
	&nbsp; &nbsp; - κανόνας 3: 300=>50 (μέγιστο 50 αιτήσεις σε 300 δευτ.)<br>
	&nbsp; &nbsp; - κανόνας 4: 3600=>200 (μέγιστο 200 αιτήσεις σε 1 ώρα)<br><br>
	Μέγιστο 6 κανόνες');
DEFINE ('CX_LFLOODBD', 'Ο FloodBlocker αποτρέπει επιθέσεις flood (πλημμυρίδας) στην Elxis ιστοσελίδα σας.');

?>
