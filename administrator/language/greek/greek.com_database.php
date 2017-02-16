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
* @description: Greek language for component database
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_DB_TABNM = 'Όνομα Πίνακα';
public $A_CMP_DB_ACTIONS = 'Ενέργειες';
public $A_CMP_DB_TDESCR = 'Περιγραφή Πίνακα';
public $A_CMP_DB_BROWSE = 'Περιήγηση';
public $A_CMP_DB_STRUCTURE = 'Δομή';
public $A_CMP_DB_INFO = 'Πληροφορίες';
public $A_CMP_DB_DUMPDB = 'Αντίγραφο Βάσης';
public $A_CMP_DB_XDUMPDB = 'Αντίγραφο Βάσης τύπου XML/SQL';
public $A_CMP_DB_BACTYPE = 'Τύπος Αντίγραφου';
public $A_CMP_DB_XML = 'XML';
public $A_CMP_DB_SQL = 'SQL';
public $A_CMP_DB_XCRBACK = 'Δημιουργία Αντιγράφου XML';
public $A_CMP_DB_XFULL = 'Δομή &amp; Δεδομένα';
public $A_CMP_DB_XSTRUONL = 'Μόνo Δομή';
public $A_CMP_DB_XSAVSERV = 'Αποθήκευση στο διακομιστή';
public $A_CMP_DB_DOWNLD = 'Λήψη Αρχείων';
public $A_CMP_DB_XMLBACK = 'Αντίγραφο XML';
public $A_CMP_DB_SCRBACK = 'Δημιουργία Αντιγράφου SQL';
public $A_CMP_DB_SFULL = 'Δομή &amp; Δεδομένα';
public $A_CMP_DB_SDATAONL = 'Μόνο Δεδομένα';
public $A_CMP_DB_SLOCTBL = 'Κλείδωμα Πίνακα';
public $A_CMP_DB_SFSYNTX = 'Πλήρης Σύνταξη';
public $A_CMP_DB_SDRTBL = 'Διαγραφή Πινάκων (αν υπάρχουν)';
public $A_CMP_DB_STBLS = 'Πίνακες';
public $A_CMP_DB_ATBLS = 'Όλοι';
public $A_CMP_DB_SELTBLS = 'Επιλεγμένοι';
public $A_CMP_DB_SQLBACK = 'Αντίγραφο SQL';
public $A_CMP_DB_TDESC = 'Περιγραφή Πίνακα';
public $A_CMP_DB_CLNAME = 'Όνομα Στήλης';
public $A_CMP_DB_CLTYPE = 'Τύπος Στήλης';
public $A_CMP_DB_ADOTYPE = 'Τύπος ADOdb';
public $A_CMP_DB_MAXLEN = 'Μέγιστο Μήκος';
public $A_CMP_DB_BRTBL = 'Περιήγηση Πίνακα';
public $A_CMP_DB_BCKDB = 'Πίσω στη Βάση Δεδομένων';
public $A_CMP_DB_DBTYPE = 'Τύπος Βάσης Δεδομένων';
public $A_CMP_DB_DBDESCR = 'Περιγραφή Βάσης Δεδομένων';
public $A_CMP_DB_DBVER = 'Έκδοση Βάσης Δεδομένων';
public $A_CMP_DB_DBHOST = 'Εξυπηρετητής Βάσης Δεδομένων';
public $A_CMP_DB_DBNAME = 'Όνομα της Βάσης Δεδομένων';
public $A_CMP_DB_DBUSER = 'Χρήστης';
public $A_CMP_DB_DBERRF = 'Συνάρτηση Σφαλμάτων';
public $A_CMP_DB_DBDBG = 'Αποσφαλμάτωση';
public $A_CMP_DB_TBLSTR = 'Δομή Πίνακα';
public $A_CMP_DB_DBBACK = 'Αντίγραφο Βάσης';
public $A_CMP_DB_NOEXISTS = 'Δεν υπάρχει Αντίγραφο';
public $A_CMP_DB_FOOTER= "<u>Σημείωση</u>: Κάντε δεξί κλικ στο όνομα ενός αρχείου και επιλέξτε 'Αποθήκευση ως' για να το κατεβάσετε. <strong>Προσοχή</strong>: Τα αρχεία χρησιμοποιούν κωδικοποίηση UTF-8.";
public $A_CMP_DB_DBMONIT = 'Παρατηρητήριο Βάσης Δεδομένων';
public $A_CMP_DB_TBLNOT = 'Ο Πίνακας δεν υπάρχει!';
public $A_CMP_DB_BACKSUCC = 'Δημιουργήθηκε με επιτυχία το αντίγραφο της βάσης δεδομένων';
public $A_CMP_DB_NOTSUPPO = 'Δεν υποστηρίζεται η λήψη SQL αντίγραφου ασφαλείας για ';
public $A_CMP_DB_NOTBLSEL = 'Δεν έχει επιλεγεί κάποιος πίνακας!';
public $A_CMP_DB_NOTDWNL = 'Δεν μπορώ να δημιουργήσω/αποστείλω αντίγραφο SQL';
public $A_CMP_DB_NOTCRSV = 'Δεν μπορώ να δημιουργήσω/αποθηκεύσω αντίγραφο SQL';
public $A_CMP_DB_DUMPSUCC = 'Το αντίγραφο SQL δημιουργήθηκε επιτυχώς';
public $A_CMP_DB_DTUNKN = 'Άγνωστη';
public $A_CMP_DB_TXMLSCHEM = 'Σχήμα XML';
public $A_CMP_DB_TSQL = 'SQL';
public $A_CMP_DB_TUNKN = 'Άγνωστος';
public $A_CMP_DB_UNKOWN = 'Άγνωστο';
public $A_CMP_DB_NOFSELDEL = 'Δεν επιλέχθηκε αρχείο για διαγραφή!';
public $A_CMP_DB_FSDELETED = 'αρχεία διεγράφησαν επιτυχώς';
public $A_CMP_DB_FDELETED = 'Το Αρχείο διαγράφηκε επιτυχώς';
public $A_CMP_DB_TLMANBACK = 'Διαχείριση Αντιγράφων';
public $A_CMP_DB_TLDELSLBCK = 'Διαγραφή Επιλεγμένων Αντιγράφων';
public $A_CMP_DB_TLNEWFXML = 'Νέο Πλήρες Αντίγραφο XML';
public $A_CMP_DB_TLNEWFSQL = 'Νέο Πλήρες Αντίγραφο SQL';
public $A_CMP_DB_MAINTEN = 'Συντήρηση';
public $A_CMP_DB_MAINTEND = 'Συντήρηση Βάσης Δεδομένων';
public $A_CMP_DB_OPTIM = 'Βελτιστοποίηση';
public $A_CMP_DB_REPAIR = 'Επισκευή';
public $A_CMP_DB_TBLOPTED = 'πίνακες βελτιστοποιήθηκαν';
public $A_CMP_DB_FRUOPTINCP = 'Η συχνή χρήση της βελτιστοποίησης αυξάνει την απόδοση της βάσης δεδομένων.';
public $A_CMP_DB_RRERRDBTAB = 'Η Επισκευή διορθώνει τυχόν σφάλματα σε πίνακες της βάσης.';
public $A_CMP_DB_FAVMYSQL = 'Αυτή η λειτουργία είναι διαθέσιμη μόνο για βάσεις δεδομένων MySQL!';
public $A_CMP_DB_TBLREPED = 'πίνακες επισκευάστηκαν';
public $A_CMP_DB_SIZE = 'Μέγεθος';

}

?>
