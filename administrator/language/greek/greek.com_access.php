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
* @description: Greek language for component access
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_ACC_GROUP = 'Ομάδες';
public $A_CMP_ACC_GRUSR = 'Πλήθος Χρηστών';
public $A_CMP_ACC_BCKASS = 'Πρόσβαση στη Διαχείριση';
public $A_CMP_ACC_PHREN = 'Κρατήστε πατημένο για μετονομασία';
public $A_CMP_ACC_GRHIE = 'Ιεραρχία Ομάδων';
public $A_CMP_ACC_GGRNM = 'Θα πρέπει να δώσετε στην Ομάδα ένα όνομα';
public $A_CMP_ACC_GGNSO = 'Η Γονική Ομάδα που επιλέξατε δεν είναι επιλέξιμη';
public $A_CMP_ACC_MANG = 'Διαχείριση Ομάδων';
public $A_CMP_ACC_GDTL = 'Λεπτομέρειες Ομάδας';
public $A_CMP_ACC_GNAME = 'Όνομα Ομάδας';
public $A_CMP_ACC_PRGR = 'Γονική Ομάδα';
public $A_CMP_ACC_EXUG = 'Υπάρχουσες Ομάδες Χρηστών';
public $A_CMP_ACC_PRMFOR = 'Δικαιώματα για';
public $A_CMP_ACC_ACO = 'ACO';
public $A_CMP_ACC_ACOV = 'Τιμή ACO';
public $A_CMP_ACC_AXO = 'AXO';
public $A_CMP_ACC_AXOV = 'Τιμή AXO';
public $A_CMP_ACC_ADNP = 'Πρόσθεσε νέο δικαίωμα';
public $A_CMP_ACC_ARO = 'ARO';
public $A_CMP_ACC_AROV = 'Τιμή ARO';
public $A_CMP_ACC_SEL = '-ΕΠΙΛΕΞΤΕ-';
public $A_CMP_ACC_ACT = 'Ενέργεια';
public $A_CMP_ACC_ADM = 'Διαχείριση';
public $A_CMP_ACC_WKF = 'Ροή εργασίας';
public $A_CMP_ACC_YMSGR = 'Θα πρέπει να ορίσετε μία Ομάδα για να τη μετονομάσετε';
public $A_CMP_ACC_TSAGN = 'Υπάρχει ήδη μία Ομάδα που ονομάζεται';
public $A_CMP_ACC_YANARG = 'Δεν επιτρέπεται να μετονομάσετε αυτή την Ομάδα!';
public $A_CMP_ACC_CNUTACL = 'Δεν μπορώ να ενημερώσω το πίνακα _core_acl_aro_groups';
public $A_CMP_ACC_CNUTUS = 'Δεν μπορώ να ενημερώσω το πίνακα _users';
public $A_CMP_ACC_CNUTCAL = 'Δεν μπορώ να ενημερώσω το πίνακα _core_acl_access_lists';
public $A_CMP_ACC_YHTLA = 'ΘΑ ΠΡΕΠΕΙ ΝΑ ΣΥΝΔΕΘΕΙΤΕ ΞΑΝΑ!';
public $A_CMP_ACC_MFS = 'Μήνυμα από τον εξυπηρετητή (server)';
public $A_CMP_ACC_WID = 'με id';
public $A_CMP_ACC_UGWID = 'Η Ομάδα Χρηστών με id';
public $A_CMP_ACC_RNMTO = 'μετονομάστηκε σε';
public $A_CMP_ACC_YCNEDGR = 'Δεν σας επιτρέπεται να επεξεργαστείτε αυτή την Ομάδα!';
public $A_CMP_ACC_YMSPNGR = 'Θα πρέπει να ορίσετε ένα όνομα για την Ομάδα';
public $A_CMP_ACC_IPGR = 'Μη έγκυρη γονική ομάδα';
public $A_CMP_ACC_YCCGPY = 'Δεν μπορείτε να δημιουργήσετε μία Ομάδα που να είναι γονική της δικής σας Ομάδας!';
public $A_CMP_ACC_YCNUSGR = 'Δεν σας επιτρέπεται να χρησιμοποιήσετε αυτή την Ομάδα ως γονική!';
public $A_CMP_ACC_TIAGTN = 'Υπάρχει κάποια άλλη Ομάδα με αυτό το όνομα!';
public $A_CMP_ACC_GADDSUC = 'Η Ομάδα προστέθηκε με επιτυχία και απέκτησε το id';
public $A_CMP_ACC_CNADDNG = 'Δεν μπορώ να προσθέσω νέα Ομάδα.';
public $A_CMP_ACC_THGRP = 'Ομάδα';
public $A_CMP_ACC_UPSUCC = 'ενημερώθηκε με επιτυχία';
public $A_CMP_ACC_CNUPGR = 'Δεν μπορώ να ενημερώσω την Ομάδα';
public $A_CMP_ACC_GESLAG = 'Η Ομάδα ενημερώθηκε με επιτυχία, αλλά θα πρέπει να συνδεθείτε ξανά!';
public $A_CMP_ACC_NGSDEL = 'Δεν επιλέξατε Ομάδα για διαγραφή';
public $A_CMP_ACC_YCNDELG = 'Δεν μπορείτε να διαγράψετε αυτή την Ομάδα!';
public $A_CMP_ACC_YANALDG = 'Δεν σας επιτρέπεται να διαγράψετε αυτή την Ομάδα!';
public $A_CMP_ACC_CNDLGR = 'Δεν μπορώ να διαγράψω την Ομάδα';
public $A_CMP_ACC_GRSDEL = 'Η Ομάδα διαγράφηκε με επιτυχία';
public $A_CMP_ACC_BCNDGP = 'αλλά δεν μπορώ να διαγράψω τα δικαιώματα της Ομάδας!';
public $A_CMP_ACC_BCNDUS = 'αλλά δεν μπορώ να διαγράψω τους χρήστες!';
public $A_CMP_ACC_NOGRSEL = 'Δεν επιλέχθηκε Ομάδα!';
public $A_CMP_ACC_PERMADD = 'Προστέθηκε με Επιτυχία το Δικαίωμα για';
public $A_CMP_ACC_PERDSUC = 'Διαγράφηκε με Επιτυχία το Δικαίωμα';
public $A_CMP_ACC_CNDELPER = 'Δεν μπορώ να διαγράψω το δικαίωμα!';
public $A_CMP_ACC_PERMEXIST = 'Το Δικαίωμα υπάρχει ήδη!';
public $A_CMP_ACC_TEDITGR = 'Επεξεργασία Ομάδας';
public $A_CMP_ACC_TGUPALD = 'Θα διαγραφούν επίσης οι Χρήστες της Ομάδας και τα Δικαιώματά τους!';
public $A_CMP_ACC_TEDITPR = 'Επεξεργασία Δικαιωμάτων';
public $A_CMP_ACC_VIEW = 'Θέαση';
public $A_CMP_ACC_UPLOAD = 'Αποστολή';
public $A_CMP_ACC_CONTENT = 'Περιεχόμενο';
public $A_CMP_ACC_OWN = 'Δικά του';
public $A_CMP_ACC_PROF = 'Προφίλ';
public $A_CMP_ACC_FILES = 'Αρχεία';
public $A_CMP_ACC_AVATARS = 'Εικόνες Άβαταρ';
public $A_CMP_ACC_MANAGE = 'Διαμόρφωση';
public $A_CMP_ACC_USERP = 'Στοιχεία χρήστη';

}

?>
