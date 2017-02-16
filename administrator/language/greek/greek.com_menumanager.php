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
* @description: Greek language for component menumanager
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_MMA_MANAG = 'Διαχειριστής Μενού';
public $A_CMP_MMA_NAME = 'Όνομα Μενού';
public $A_CMP_MMA_MITE = 'Αντικείμενα Μενού';
public $A_CMP_MMA_EDMN = 'Επεξεργασία Ονόματος Μενού';
public $A_CMP_MMA_EDMITS = 'Επεξεργασία Αντικειμένων Μενού';
public $A_CMP_MMA_ENTER = 'Παρακαλούμε εισάγετε ένα όνομα για το μενού';
public $A_CMP_MMA_ENTEMN = 'Παρακαλούμε εισάγετε ένα όνομα module για το μενού';
public $A_CMP_MMA_DETAIL = 'Λεπτομέρειες Μενού';
public $A_CMP_MMA_TIP01 = 'Αυτό είναι το όνομα που χρησιμοποιεί το Elxis για να αναγνωρίσει αυτό το μενού μέσα στον κώδικα. Θα πρέπει να είναι μοναδικό. Δεν θα πρέπει να έχει κενά ανάμεσα στους χαρακτήρες.';
public $A_CMP_MMA_TIP02 = 'Αυτό είναι το όνομα του module (τύπου mod_mainmenu), που θα χρησιμοποιηθεί για να εμφανιστεί αυτό το μενού. Μπορείτε να το αλλάξετε από το Διαχειριστή Modules.';
public $A_CMP_MMA_TXT01 = '* Όταν αποθηκεύσετε αυτό το μενού, θα δημιουργηθεί αυτόματα ένα νέο module (τύπου mod_mainmenu), το οποίο θα έχει τον Τίτλο που δώσατε παραπάνω. *<br /><br />Μπορείτε να επεξεργαστείτε τις παραμέτρους του module που θα δημιουργηθεί, από το Modules -> Modules Ιστότοπου';
public $A_CMP_MMA_DEL = 'Διαγραφή Μενού';
public $A_CMP_MMA_MODULE_DEL = 'Μενού/Module προς διαγραφή';
public $A_CMP_MMA_ITEMS_DEL = 'Αντικείμενα μενού προς διαγραφή';
public $A_CMP_MMA_WILL = '* Αυτή η ενέργεια θα <strong><font color=FF0000>διαγράψει</font></strong>';
public $A_CMP_MMA_WILL2 = 'αυτό το μενού, <br />όλα τα αντικείμενα μενού και το module που συσχετίζεται με αυτό *';
public $A_CMP_MMA_YOU_SURE = 'Είστε βέβαιοι ότι θέλετε να διαγράψετε αυτό το μενού; \nΑυτή η ενέργεια θα διαγράψει το Μενού, τα Αντικείμενά του και το αντίστοιχο Module.';
public $A_CMP_MMA_NAMEMENU = 'Παρακαλούμε εισάγετε ένα όνομα για το αντίγραφο του Μενού';
public $A_CMP_MMA_ENNMNEWM = 'Παρακαλούμε εισάγετε ένα όνομα για το νέο Module';
public $A_CMP_MMA_COPY = 'Αντιγραφή Μενού';
public $A_CMP_MMA_NEW = 'Νέο όνομα μενού';
public $A_CMP_MMA_MODNEW = 'Νέο όνομα Module';
public $A_CMP_MMA_COPIED = 'Το μενού που αντιγράφεται';
public $A_CMP_MMA_ITMSCOP = 'Αντικείμενα μενού που αντιγράφονται';
public $A_CMP_MMA_TYPE = 'Τύπος Μενού';
public $A_CMP_MMA_CANTREN = 'Δεν μπορείτε να μετονομάσετε το μενού \'mainmenu\', καθώς κάτι τέτοιο θα εμπόδιζε τη σωστή λειτουργία του Elxis';
public $A_CMP_MMA_UNIQUE = 'Υπάρχει ήδη ένα μενού με αυτό το όνομα - θα πρέπει να εισάγετε ένα μοναδικό όνομα μενού';
public $A_CMP_MMA_CREATED = 'Το νέο μενού δημιουργήθηκε';
public $A_CMP_MMA_ALCDEL = 'Δεν μπορείτε να διαγράψετε το μενού \'mainmenu\' καθώς είναι ένα μενού που χρησιμοποιείται από τον πυρήνα του Elxis';
public $A_CMP_MMA_DELETED = 'Το μενού διαγράφηκε';
public $A_CMP_MMA_NEWMENU = 'Νέο Μενού';
public $A_CMP_MMA_NEWMODU = 'Νέο Module';
public $A_CMP_MMA_COPYOF = 'Δημιουργήθηκε ένα αντίγραφο του μενού';
public $A_CMP_MMA_CONSIST = 'αποτελούμενο από';
public $A_CMP_MMA_UPDATED = 'Τα αντικείμενα μενού και τα modules ενημερώθηκαν.';

}

?>
