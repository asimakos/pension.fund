<?php 
/**
* @version: 1.0
* @copyright: Copyright (C) 2008 Is Open Source. All rights reserved.
* @package: Elxis
* @subpackage: Component NewsLetter
* @author: Ioannis Sannos (Is Open Source)
* @translator: Ioannis Sannos
* @link: http://www.isopensource.com
* @email: info@isopensource.com
* @description: Greek language for component NewsLetter
* @license: http://creativecommons.org/licenses/by-sa/3.0/ Creative Commons Attribution-Share Alike 3.0
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class newsletterLang {

	public $NEWSLETTER = 'Ενημερωτικό δελτίο';
	public $NEWSLMAILLIST = 'Λίστα ενημερωτικών δελτίων';
	public $SUBSCRIBE = 'Εγγραφή';
	public $UNSUBSCRIBE = 'Διαγραφή';
	public $SUBLEWSL = 'Εγγραφείτε στο ενημερωτικό μας δελτίο';
	public $UNSUBLEWSL = 'Διαγραφείτε από το ενημερωτικό μας δελτίο';
	public $NAME = 'Όνομα';
	public $SURNAME = 'Επίθετο';
	public $RECIEVEIN = "Λήψη μηνυμάτων σε"; //translators help: filled in by language name (i.e. "English")
	public $ANYLANG = 'οποιαδήποτε γλώσσα';
	public $SUBINFO = 'Συμπληρώστε τα προσωπικά σας στοιχεία για να εγγραφείτε στην λίστα ενημερωτικών δελτίων μας. Όλα τα πεδία είναι υποχρεωτικά. 
	Θα μπορείτε ανά πάσα στιγμή να διαγραφείτε από αυτή τη λίστα αν δεν θέλετε πλέον να λαμβάνετε ενημερωτικά e-mail.';
	public $SUBEMAILVAL = 'Η διεύθυνση e-mail σας θα ελεγχθεί προκειμένου να γίνει αποδεκτή η εγγραφή σας.';
	public $SECCODE = 'Κωδικός ασφαλείας';
	public $UNSUBINFO = 'Συμπληρώστε την διεύθυνση e-mail σας για να διαγραφείτε από το ενημερωτικό μας δελτίο. Μία ειδική διεύθυνση URL 
	θα σταλεί στο e-mail σας. Πατήστε την για να διαγραφείτε από τη λίστα αλληλογραφία μας.';
	public $JSDISABLED = 'Πρέπει να ενεργοποιήσετε την JavaScript στον περιηγητή σας για να χρησιμοποιήσετε αυτή τη λειτουργία!';
	public $NAMEEMPTY = 'Το όνομά σας δεν μπορεί να είναι κενό!';
	public $SURNAMEEMPTY = 'Το επίθετό σας δεν μπορεί να είναι κενό!';
	public $PROVALIDEMAIL = 'Πρέπει να δώσετε μία έγκυρη διεύθυνση e-mail!';
	public $SECCODEWRONG = 'Ο κωδικός ασφαλείας είναι λάθος!';
	public $EMAILEXISTS = 'Η υποβληθήσα διεύθυνση e-mail υπάρχει ήδη στη λίστα αλληλογραφίας μας!';
	public $NOTACCDOM = 'Λυπούμεθα, δεν δεχόμαστε διευθύνσεις e-mail από το domain του e-mail σας.';
	public $FLOODWAIT = 'Προστασία υπερχείλισης! Παρακαλούμε περιμένετε μερικά δευτερόλεπτα και ξανά-προσπαθήστε.';
	public $NEWSLSUBNTF = 'Ειδοποίησης εγγραφής στο newsletter';
	public $DEAR = 'Αγαπητέ(ή)';
	public $THANKSUB = 'Σας ευχαριστούμε για την εγγραφή σας στην λίστα αλληλογραφίας μας.';
	public $SUBCOMPVISIT = 'Προκειμένου η εγγραφή σας να ολοκληρωθεί απαιτείται να επισκευθείτε τον παρακάτω σύνδεσμο. 
	Επισκεπτόμενοι αυτόν τον σύνδεσμο πιστοποιείτε ότι είστε ο ιδιοκτήτης αυτού του λογαριασμού e-mail και η εγγραφή σας ολοκληρώνεται.';
	public $NEVERSUBIGN = 'Αν δεν εγγραφήκατε ποτέ στην λίστα αλληλογραφίας μας παρακαλούμε αγνοήστε αυτό το μήνυμα.';
	public $GREETINGS = 'Χαιρετισμούς';
	public $SUBCONFIRM = 'Επαλήθευση εγγραφής';
	public $CONFLINKSENT = 'Ένας ειδικός σύνδεσμος επαλήθευσης στάλθηκε στη διεύθυνση e-mail σας. 
	Ελέγξτε τα μηνύματά σας και πατήστε στο σύνδεσμο επαλήθευσης ώστε να ολοκληρωθεί η εγγραφή σας στη λίστα αλληλογραφίας μας.'; 
	public $SUBCOMPLETE = 'Η εγγραφή σας ολοκληρώθηκε';
	public $SUBCOMPLETED = 'Η εγγραφή σας στη λίστα αλληλογραφίας μας ολοκληρώθηκε επιτυχώς. Αν οποιαδήποτε στιγμή θελήσετε 
	να σταματήσετε να λαμβάνετε e-mail από εμάς, μπορείτε να διαγραφείτε από την λίστα αλληλογραφίας μας εισάγοντας την διεύθυνση του 
	e-mail σας στη φόρμα διαγραφής.';
	public $CONFFAILED = 'Αποτυχία επαλήθευσης';
	public $CONFFAILEDD = 'Η επαλήθευση της εγγραφής σας απέτυχε! Η εγγραφή σας είτε είναι ήδη επαληθευμένη, είτε ο κωδικός επαλήθευσης είναι άκυρος.';
	public $SUBLOGIN = 'Προκειμένου να εγγραφείτε στην λίστα αλληλογραφίας μας θα πρέπει πρώτα να συνδεθείτε!';
	public $SUBNALLOWED = 'Λυπούμεθα, νέες εγγραφές δεν επιτρέπονται.';
	public $MAILNFOUND = 'Το e-mail σας δεν βρέθηκε στη λίστα αλληλογραφίας μας ή η εγγραφή σας δεν επαληθεύτηκε ακόμα.';
	public $UNSUBCONFIRM = 'Επαλήθευση διαγραφής';
	public $WISHUNSCLICK = 'Λάβαμε από εσάς ένα αίτημα διαγραφής από την λίστα αλληλογραφίας μας. Για να επιβεβαιώσετε ότι επιθυμείτε 
	να διαγραφείτε από τη λίστα αλληλογραφίας μας επισκευθείτε τον παρακάτω σύνδεσμο.';
	public $UNSUBINGORE = 'Αν δεν ζητήσατε ποτέ να διαγραφείτε από την λίστα αλληλογραφίας μας ή δεν εγγραφήκατε ποτέ 
	σε αυτή, παρακαλούμε αγνοήστε αυτό το μήνυμα.';
	public $UNSUBCOMPLETE = 'Η διαγραφή σας ολοκληρώθηκε';
	public $UNSUBCOMPLETED = 'Αφαιρεθήκατε επιτυχώς από την λίστα αλληλογραφίας μας.';
	public $RCONFLINKSENT = 'Το αίτητμα διαγραφής σας υποβλήθηκε επιτυχώς. Ένας ειδικός σύνδεσμος επαλήθευσης στάλθηκε 
	στο e-mail σας. Ελέξτε τα μηνύματά σας και πατήστε τον σύνδεσμο επαλήθευσης ώστε να αφαιρεθείτε από τη λίστα αλληλογραφίας μας.'; 
	public $RCONFFAILEDD = 'Η επαλήθευση της διαγραφής σας απέτυχε! Η εγγραφή σας είτε δεν είναι επαληθευμένη, είτε ο κωδικός επιβεβαιώσης είναι λάθος.';
	public $NOTHSPECIAL = 'Δεν υπάρχει κάτι ιδιαίτερο να δείτε εδώ.';
	public $STATISTICS = 'Στατιστικά';
	public $TOTALSENT = 'Σύνολο σταλθέντων μηνυμάτων';
	public $LASTSUBSCRIBER = 'Τελευταίος συνδρομητής';

	/* BACK-END */
	public $CONFIGURE = 'Ρυθμίσεις';
	public $SUBSCRIBERS = 'Συνδρομητές';
	public $CONFIRMED = 'Επαληθευμένο';
	public $UNCONFIRMED = 'Μη-Επαληθευμένο';
	public $GUEST = 'Επισκέπτης';
	public $SUBSCRIPTIONS = 'Συνδρομές';
	public $REGUSERS = 'Εγγεγραμμένοι χρήστες';
	public $EVERYONE = 'Οποιοσδήποτε';
	public $CANSUBSCRIBED = 'Επιλέξτε ποιοι μπορούν να εγγράφονται στην λίστα αλληλογραφίας σας από το δημόσιο τμήμα.';
	public $EMAILVALID = 'Επαλήθευση e-mail';
	public $EMAILVALIDD = 'Αν ενεργοποιηθεί τότε μετά από μία νέα εγγραφή ένα ειδικό e-mail στέλνεται στον συνδρομητή με έναν σύνδεσμο 
	επαλήθευσης. Η νέα συνδρομή ενεργοποιείται μόνο αφότου ο χρήστη επισκεφθεί αυτόν τον σύνδεσμο. Με αυτόν τον τρόπο διασφαλίζετε ότι 
	ο χρήστης είναι ο ιδιοκτήτης αυτής της διεύθυνσης e-mail και ότι η διεύθυνση e-mail είναι έγκυρη.';
	public $LANGSD = 'Αν επιθυμείτε να στέλνετε διακεκριμένα μυνήματα e-mail ανάλογα με την γλώσσα, τότε επιλέξτε εδώ τις γλώσσες που 
	θέλετε να ενεργοποιήσετε. Οι χρήστες κατά την εγγραφή τους θα μπορούν επίσης να επιλέξουν την γλώσσα της αρεσκίας τους από αυτές 
	που θα ενεργοποιήσετε εδώ. Αν έχετε μόνο μία δημοσιευμένη γλώσσα τότε μην επιλέγετε καμία γλώσσα.';
	public $EXCLUDEDTLDS = 'Μη-αποδεκτά TLD';
	public $EXCLUDEDTLDSD = 'Λίστα Top Level Domains (όπως τα com,net,org) χωρισμένα μεταξύ τους με κόμμα που δεν είναι 
	αποδεκτά για εγγραφή στη λίστα αλληλογραφίας σας.';
	public $EXCLUDEDDOMS = 'Μη-αποδεκτά domain';
	public $EXCLUDEDDOMSD = 'Λίστα ονομάτων domain (όπως τα badsite.com,hackers.cn) χωρισμένα μεταξύ τους με κόμμα που 
	δεν είναι αποδεκτά για εγγραφή στη λίστα αλληλογραφίας σας.';
	public $ALLOWEDTLDS = 'Αποδεκτά TLDs';
	public $ALLOWEDTLDSD = 'Λίστα Top Level Domains (όπως τα com,net,org) χωρισμένα μεταξύ τους με κόμμα για τα οποία 
	και μόνο επιτρέπονται εγγραφές. Αφήστε αυτό το πεδίο κενό αν θέλετε να επιτρέπονται από όλα.';
	public $ALLOWEDDOMS = 'Αποδεκτά domain';
	public $ALLOWEDDOMSD = 'Λίστα ονομάτων domain (όπως τα mysite.com,friendlysite.gr) χωρισμένα μεταξύ τους με κόμμα 
	για τα οποία και μόνο επιτρέπονται εγγραφές. Αφήστε αυτό το πεδίο κενό αν θέλετε να επιτρέπονται από όλα.';
	public $SHOWSTATSD = 'Εμφάνιση στατιστικών του NewsLetter στην δημόσια σελίδα του component;';
	public $RECPERSTEP = 'Αποδέκτες ανά βήμα';
	public $RECPERSTEPD = 'Το IOS Newsletter προκειμένου να μετριάσει το φόρτο του διακομιστή στέλνει τα μηνύματα σε βήματα. Ορίστε εδώ 
	τον αριθμό των μηνυμάτων που θα στέλνονται σε κάθε βήμα. Χαμηλώστε αυτό το όριο αν δείτε ότι το κάθε βήμα αργεί υπερβολικά να εκτελεστεί.';
	public $ONEPERREC = 'Ένα ανά αποδέκτη';
	public $ONEPERRECD = 'Αποστολή ενός μηνύματος ανά αποδέκτη. Λειτουργεί μόνο αν η μέθοδος αποστολής είναι PHP Mail! 
	Αν ενεργοποιηθεί, το IOS Newsletters θα στέλνει ένα μήνυμα ανά αποδέκτη. Συνεπώς, αν στέλνετε μήνυμα σε 50 ανθρώπους, 
	θα σταλούν 50 e-mail. Αν χρησιμοποιείτε αυτή τη λειτουργία χαμηλώστε τον αριθμό Αποδεκτών Ανά Βήμα. Αν αυτή η 
	λειτουργία απενεργοποιηθεί, θα στέλνεται 1 e-mail σε κάθε βήμα για όλους του αποδέκτες.';
	public $CNOTSAVESETS = 'Δεν στάθηκε δυνατή η αποθήκευση των ρυθμίσεων!';
	public $EXPORT = 'Εξαγωγή';
	public $EXPORTSUB = 'Εξαγωγή συνδρομητών';
	public $IMPORT = 'Εισαγωγή';
	public $IMPORTSUB = 'Εισαγωγή συνδρομητών';
	public $IMPORTUNIQUE = 'Εισαγωγή μόνο διευθύνσεων e-mail που δεν υπάρχουν (Απαιτεί ένα πρόσθετο επερώτημα προς τη βάση 
	δεδομένων ανά συνδρομητή. Μην εισάγετε πάρα πολλούς συνδρομητές με τη μία).';
	public $IMPORTD = 'Επιλέξτε το αντίγραφο ασφαλείας του NewsLetter που επιθυμείτε να εισάγετε.';
	public $IMPORTCUSTOM = 'Αν χρησιμοποιείτε ένα δικό σας αρχείο εισαγωγής βεβαιωθείτε πως είναι κωδικοποιημένο ως UTF-8 
	και ότι οι συνδρομητές είναι γραμμένοι με τον ακόλουθο τρόπο (ένας συνδρομητής ανά γραμμή):';
	public $IMPORTGIDL = 'Για επισκέπτες το userid είναι 0. Η γλώσσα και το group μπορεί να είναι κενά.';
	public $IMPORTEDSUBS = "Βρέθηκαν %s συνδρομητές. Εισήχθησαν %s από αυτούς."; //translators help: %s is being replaced by number
	public $CONFCODE = 'Κωδικός επαλήθευσης';
	public $GETUSERDATA = 'Λήψη στοιχείων από χρήστη';
	public $NEWSLETTERS = 'Ενημερωτικά δελτία';
	public $SUBJECT = 'Θέμα';
	public $RECIPIENTS = 'Αποδέκτες';
	public $PLAINTEXT = 'Απλό κείμενο';
	public $TEXTHTML = 'Κείμενο HTML';
	public $HTMLFILE = 'Αρχείο HTML';
	public $LASTSENT = 'Τελευταία αποστολή';
	public $SELECTFILE = 'Επιλέξτε αρχείο';
	public $HTMLFILED = 'Μπορείτε να ανεβάσετε και να χρησιμοποιήσετε ένα έτοιμο αρχείο HTML αντί να γράψετε ένα κείμενο HTML.';
	public $SUBJECTEMPTY = 'Ο τίτλος δεν μπορεί να είναι κενός!';
	public $FIRSTSAVEPR = 'Πρέπει πρώτα να αποθηκεύσετε το ενημερωτικό δελτίο για να δείτε την προεπισκόπισή του!';
	public $NEWSLNEMPTY = 'Το ενημερωτικό Δελτίο δεν μπορεί να είναι κενό περιεχομένου!';
	public $SENDNEWSLETTER = 'Αποστολή ενημερωτικού δελτίου';
	public $MAILFORMAT = 'Μορφή e-mail';
	public $FORCESEND = 'Εξαναγκασμένη αποστολή αυτού του μηνύματος σε αποδέκτες που έχουν επιλέξει να λαμβάνουν μηνύματα σε άλλη γλώσσα.';
	public $SUBSTOTAL = 'Σύνολο συνδρομητών';
	public $SUBSCRIBERSIN = "Συνδρομητές στα %s"; //translators help: filled in by language
	public $SENDNOW = 'Αποστολή τώρα!';
	public $SENDMSGSWAIT = "Αποστολή %s μηνυμάτων, παρακαλώ περιμένετε...";
	public $PLEASEWAIT = 'Παρακαλώ περιμένετε...';
	public $MSGOFSENT = "%s από %s μηνύματα στάλθηκαν επιτυχώς.";
	public $DISPATCHCOM = 'Η αποστολή ολοκληρώθηκε';
	public $SENDERNAME = 'Όνομα αποστολέα';
	public $SENDEREMAIL = 'E-mail αποστολέα';
	public $SENDMETHOD = 'Μέθοδος αποστολής';
	public $READCONFIRM = 'Επιβεβαίωση ανάγνωσης';
	public $SENDMAILPATH = 'Διαδρομή Sendmail';
	public $SENDMAILPATHD = 'Χρησιμοποιείται μόνο αν η Sendmail είναι η επιλεγμένη μέθοδος αποστολής (προκαθορισμένη τιμή: /usr/sbin/sendmail).';
	public $SMTPHOST = 'Διακομιστής SMTP';
	public $SMTPPORT = 'Θύρα SMTP';
	public $SECURESMTP = 'Ασφαλής SMTP';
	public $SMTPAUTH = 'Πιστοποίηση SMTP';
	public $SMTPUSER = 'Όνομα χρήστη SMTP';
	public $SMTPPASS = 'Κωδικός SMTP';
	public $ADDREPLYTO = 'Απάντηση σε';
	public $ADDREPLYTOD = 'Προσθήκη διεύθυνσης e-mail Απάντηση Σε στις επικεφαλίδες των e-mail;';
	public $THECOPY = 'Αντίγραφο';
	public $SHOWCOPYRIGHT = 'Πνευματικά δικαιώματα';
	public $SHOWCOPYRIGHTD = 'Επιλέξτε αν επιθυμείτε να εμφανίζονται τα πνευματικά δικαιώματα στην αρχική σελίδα του component. Αυτή είναι η μόνη μου ανταμοιβή για την δωρεάν παροχή αυτού του component!';
	public $UPHTMLTEMP = 'Ανεβάστε ένα αρχείο html για χρήση ως template του Newsletter.';
	public $UPLOADHTMLTEMP = 'Αποστολή HTML template';
	public $SENDNEWSLET = 'Αποστολή Newsletter';
	public $IMPORTELXUS = 'Εισαγωγή χρηστών Elxis';
	public $IMPORTELXUSD = 'Εισαγωγή στο Newsletter υπαρχόντων χρηστών του Elxis CMS. Θα εισαχθούν μόνο χρήστες με 
	διευθύνσεις e-mail που δεν υπάρχουν στη λίστα συνδρομητών του Newsletter.';
	public $FOUNDELXUIMP = "Βρέθηκαν %s χρήστες του Elxis. %s από αυτούς εισήχθησαν στo Newsletter.";

	//languages names
	public $ARMENIAN = 'Αρμένικα';
	public $BOZNIAN = 'Βοσνιακά';
	public $BRAZILIAN = 'Βραζιλιάνικα';
	public $BULGARIAN = 'Βουλγάρικα';
	public $CREOLE = 'Κρεολέ (Αϊτή)';
	public $CROATIAN = 'Κροατικά';
	public $DANISH = 'Δανέζικα';
	public $ENGLISH = 'Αγγλικά';
	public $FRENCH = 'Γαλλικά';
	public $GERMAN = 'Γερμανικά';
	public $GREEK = 'Ελληνικά';
	public $INDONESIAN = 'Ινδονησιακά';
	public $ITALIAN = 'Ιταλικά';
	public $JAPANESE = 'Ιαπωνικά';
	public $LATVIAN = 'Λεττονικά';
	public $LITHUANIAN = 'Λιθουανικά';
	public $PERSIAN = 'Περσικά';
	public $POLISH = 'Πολωνικά';
	public $RUSSIAN = 'Ρωσσικά';
	public $SERBIAN = 'Σέρβικα';
	public $SPANISH = 'Ισπανικά';
	public $SRPSKI = 'Κυριλικά Σερβικά';
	public $TURKISH = 'Τουρκικά';
	public $VIETNAMESE = 'Βιετναμέζικα';


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
	}

}

?>