<?php 
/**
* @version: 1.3
* @copyright: Copyright (C) 2008-2010 Is Open Source. All rights reserved.
* @package: Elxis
* @subpackage: Component NewsLetter
* @author: Ioannis Sannos (Is Open Source)
* @translator: Martin Beurskens
* @link: http://www.elxis.org
* @email: m.beurskens@orange.fr
* @description: German language for component NewsLetter
* @license: http://creativecommons.org/licenses/by-sa/3.0/ Creative Commons Attribution-Share Alike 3.0
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class newsletterLang {


	public $NEWSLETTER = 'Newsletter';
	public $NEWSLMAILLIST = 'Newsletter Mail Liste';
	public $SUBSCRIBE = 'Anmelden';
	public $UNSUBSCRIBE = 'Abmelden';
	public $SUBLEWSL = 'Für den Newsletter anmelden';
	public $UNSUBLEWSL = 'Für den Newsletter abmelden';
	public $NAME = 'Name';
	public $SURNAME = 'Richtiger Name';
	public $RECIEVEIN = "Nachrichten erhalten in"; //translators help: filled in by language name (i.e. "English")
	public $ANYLANG = 'Jeder Sprache';
	public $SUBINFO = 'Geben Sie Ihre Informationen ein, um unseren Newsletter zu erhalten. Alle Felder sind Pflichtfelder. 
	Sie können sich jederzeit wieder abmelden.';
	public $SUBEMAILVAL = 'Ihre E-mai Adresse wird zur Anmeldung automatisch überprüft.';
	public $SECCODE = 'Sicherheitscode';
	public $UNSUBINFO = 'Geben Sie zum abmelden bitte Ihre E-mail Adresse ein. Eine spezille URL wird dann 
	gesendet zur Abmeldung. Klicken Sie um sich abzumelden.';
	public $JSDISABLED = 'In Ihrem Browser muss Javascript eingeschaltet sein, damit diese Anwendung funktioniert!';
	public $NAMEEMPTY = 'Name darf nicht leer sein!';
	public $SURNAMEEMPTY = 'Der richtige Name darf nicht leer sein!';
	public $PROVALIDEMAIL = 'Geben Sie eine gültige E-mail Adresse ein!';
	public $SECCODEWRONG = 'Sicherheitscode ist falsch!';
	public $EMAILEXISTS = 'Die E-mail Adresse ist schon vorhanden!';
	public $NOTACCDOM = 'Entschuldigung, aber wir akzeptieren keine E-mails von dieser E-mail Domain.';
	public $FLOODWAIT = 'Spamschutz! Bitte warten Sie ein paar Sekunden um fortzufahren.';
	public $NEWSLSUBNTF = 'Newsletter Anmeldenotiz';
	public $DEAR = 'Sehr geehrte(r)'; //translators help: followed by name surname
	public $THANKSUB = 'Vielen Dank, das Sie unseren Newsletter aboniert haben.';
	public $SUBCOMPVISIT = 'Um die Anmeldung abzuschliessen, ist es nötig, das Sie den unten stehenden Link anklicken. 
	Damit wird verifiziert, das Sie der Besitzer der angegebenen E-mail Adresse sind und Ihre Anmeldung damit abgeschlossen werden kann.';
	public $NEVERSUBIGN = 'Sollten Sie sich nicht angemeldet haben, ignorieren oder löschen Sie diese E-mail.';
	public $GREETINGS = 'Grüsse';
	public $SUBCONFIRM = 'Anmeldungsbestätigung';
	public $CONFLINKSENT = 'Ein spezieller Bestätigungslink wurde an Ihre E-mail Adresse versendet. 
	Überprüfen Sie Ihre E-mails und klicken Sie auf den Link um Ihre Anmeldung zu bestätigen.'; 
	public $SUBCOMPLETE = 'Ihre Anmeldung ist komplett';
	public $SUBCOMPLETED = 'Ihre Anmeldung für unseren Newsletter war erfolgreich. Sie können sich jederzeit wieder 
	abmelden, wenn Sie unseren Newsletter nicht mehr erhalten wollen. Sie müssen nur Ihre E-mail Adresse in das 
	Abmeldeformular einfügen.';
	public $CONFFAILED = 'Anmeldung fehlgeschlagen';
	public $CONFFAILEDD = 'Anmeldebestätigung fehlgeschlagen! Ihre Anmeldung ist entweder bestätigt, oder die Bestätigung ist ungültig.';
	public $SUBLOGIN = 'Sie müssen sich erst einloggen für unsere Mailingliste!';
	public $SUBNALLOWED = 'Entschuldigung, aber eine weitere Anmeldung ist nicht möglich.';
	public $MAILNFOUND = 'Ihre E-mail Adresse wurde nicht gefunden, oder sie ist noch nicht bestätigt';
	public $UNSUBCONFIRM = 'Abmeldebestätigung';
	public $WISHUNSCLICK = 'Wir haben eine Abmeldeanfrage für unseren Newsletters von Ihrer E-mail Adresse erhalten. 
	Um das zu bestätigen, besuchen Sie unten stehenden Link.';
	public $UNSUBINGORE = 'Wenn Sie unseren Newsletter nicht abbestellt haben, ignorieren 
	oder löschen Sie diese E-mail.';
	public $UNSUBCOMPLETE = 'Ihre Abmeldung ist komplett';
	public $UNSUBCOMPLETED = 'Sie wurden aus unserer Liste entfernt.';
	public $RCONFLINKSENT = 'Ihr Abmeldewunsch wurde erfolgreich übermittelt. Ein spezieller Bestätigungslink wurde an Ihre E-mail Adresse
  	gesendet. Klicken Sie auf den Link, um aus unserer Liste entfernt zu werden.'; 
	public $RCONFFAILEDD = 'Newsletterabmeldung gescheitert! Ihre Anmeldung wurde nicht bestätigt, oder der Bestätigungscode ist nicht gültig.';
	public $NOTHSPECIAL = 'Hier gibt es nichts spezielles zu sehen.';
	public $STATISTICS = 'Statistiken';
	public $TOTALSENT = 'Alle gesendeten Nachrichten';
	public $LASTSUBSCRIBER = 'Letzer neuer Benutzer';

	/* BACK-END */
	public $CONFIGURE = 'Konfigurieren';
	public $SUBSCRIBERS = 'Abonenten';
	public $CONFIRMED = 'Bestätigt';
	public $UNCONFIRMED = 'Nicht bestätigt';
	public $GUEST = 'Gast';
	public $SUBSCRIPTIONS = 'Abonnements';
	public $REGUSERS = 'Registrierte Benutzer';
	public $EVERYONE = 'Jeder';
	public $CANSUBSCRIBED = 'Suchen Sie aus, wer sich im Frontend für den Newsletter anmelden kann.';
	public $EMAILVALID = 'E-mail Bestätigung';
	public $EMAILVALIDD = 'Wenn aktiv, wird nach der Anmeldung eine spezielle E-mail mit einem Bestätigungslink an den Abonnenten versendet. 
	Die neue Anmeldung wird nur aktiviert, wenn der Abonnent auf den Link klickt. Das stellt sicher das der Abonnent Inhaber der E-mail Adresse ist
	und die E-mail Adresse richtig ist.';
	public $LANGSD = 'Wenn SIe gerne Newsletter in verschiedenen Sprachen versenden wollen, dann wählen Sie hier die 
	Sprachen aus. Abonnenten können dann während der Anmeldung eine Sprache aus der Liste aussuchen. 
	Wenn Sie nur eine Sprache nutzen, geben Sie nichts in die Liste ein.';
	public $EXCLUDEDTLDS = 'Verbiete TLDs';
	public $EXCLUDEDTLDSD = 'Komma getrennte Liste von Top Level Domains (wie com,net,org) die von der Anmeldung 
	ausgeschlossen werden sollen.';
	public $EXCLUDEDDOMS = 'Ausgeschlossene Domains';
	public $EXCLUDEDDOMSD = 'Durch Komma getrennte schlechte Domains Liste (wie badsite.com,hackers.cn) die von 
	der Anmeldung ausgeschlossen werden sollen.';
	public $ALLOWEDTLDS = 'TLDs erlauben';
	public $ALLOWEDTLDSD = 'Durch Komma getrennte Liste von Top Level Domains (wie com,net,org) denen die Anmeldung 
	erlaubt sein soll. Lassen Sie die Liste leer, wenn Sie es allen erlauben wollen.';
	public $ALLOWEDDOMS = 'Domains erlauben';
	public $ALLOWEDDOMSD = 'Durch Komma getrennte Domainliste (wie mysite.com,friendlysite.gr) denen es ausschliesslich 
	erlaubt sein soll. sich anzumelden. Leer lassen für alle.';
	public $SHOWSTATSD = 'Zeige Newsletterstatistiken im Frontend der Anwendung?';
	public $RECPERSTEP = 'Empfänger pro Schritt';
	public $RECPERSTEPD = 'Um die Serverlast zu vermindern arbeitet IOS Newsletter in Schritten. Stellen Sie hier die Anzahl der E-mails 
	ein, die pro Schritt verschickt werden. Verringern Sie die Anzahl, wenn Sie merken, das es zu lange dauert.';
	public $ONEPERREC = 'Eine pro Empfänger';
	public $ONEPERRECD = 'Sende eine pro Empfänger. Das funktioniert nur mit PHP Mail! Wenn es eingeschaltet ist, 
	schickt IOS Newsletters eine E-mail pro Empfänger. Es werden zum Beispiel 50 E-mails an 50 Leute verschickt. 
	If you use this feature lower the Recipients Per Step number. If this feature is disabled, 1 e-mail will be sent 
	in each step for all recipients.';
	public $CNOTSAVESETS = 'Konnte die Einstellungen nicht speichern!';
	public $EXPORT = 'Export';
	public $EXPORTSUB = 'Exportiere Abonnenten';
	public $IMPORT = 'Import';
	public $IMPORTSUB = 'Importiere Abonnenten';
	public $IMPORTUNIQUE = 'Importiere nur E-mail Adressen, die noch nicht vorhanden sind (Erfordert einen Datenbankeintrag pro Abonnent. 
	Importieren Sie nicht zu viele auf einmal).';
	public $IMPORTD = 'Wählen Sie die Newsletter Backupdatei, die Sie importieren wollen.';
	public $IMPORTCUSTOM = 'Wenn Sie eine fremde Datei importieren wollen, achten Sie darauf, das diese in UTF-8 gespeichert 
	ist und alle Abonnenten in diesem Format vorliegen (ein Abonnent pro Linie):';
	public $IMPORTGIDL = 'Die Benutzer ID für Gäste ist 0. Sprache und Gruppe können leer sein.';
	public $IMPORTEDSUBS = "%s Abonnenten wurden gefunden. %s von ihnen wurden importiert."; //translators help: %s is being replaced by number
	public $CONFCODE = 'Bestätigungs Code';
	public $GETUSERDATA = 'Benutzerdaten holen';
	public $NEWSLETTERS = 'Newsletters';
	public $SUBJECT = 'Subject';
	public $RECIPIENTS = 'Abonnenten';
	public $PLAINTEXT = 'Nur Text';
	public $TEXTHTML = 'HTML Text';
	public $HTMLFILE = 'HTML Datei';
	public $LASTSENT = 'Zuletzt gesendet'; //translators help: date newsletter last sent
	public $SELECTFILE = 'Datei wählen';
	public $HTMLFILED = 'Sie können eine fertige HTML Datei hochladen, anstatt HTML zu schreiben.';
	public $SUBJECTEMPTY = 'Subject darf nicht leer sein!';
	public $FIRSTSAVEPR = 'Sie müssen den Newsletter erst speichern bevor Sie ihn sehen können!';
	public $NEWSLNEMPTY = 'Newsletter darf nicht leer sein!';
	public $SENDNEWSLETTER = 'Newsletter senden';
	public $MAILFORMAT = 'Mail Format';
	public $FORCESEND = 'Schicke den Newsletter auch an Abonnenten, die eine andere Sprache eingestellt haben.';
	public $SUBSTOTAL = 'Alle Abonnenten';
	public $SUBSCRIBERSIN = "Abonnenten in %s"; //translators help: filled in by language
	public $SENDNOW = 'Jetzt senden!';
	public $SENDMSGSWAIT = "Versende %s Newsletter, bitte warten..."; //translators help: filled in by messages number
	public $PLEASEWAIT = 'Bitte warten...';
	public $MSGOFSENT = "%s von %s Newslettern erfolgreich verschickt."; //translators help: filled in by number / total number
	public $DISPATCHCOM = 'Versand vollständig';
	public $SENDERNAME = 'Name des Versenders';
	public $SENDEREMAIL = 'E-mail des Versenders';
	public $SENDMETHOD = 'Senden Methode';
	public $READCONFIRM = 'Lese Bestätigung';
	public $SENDMAILPATH = 'Sendmail Pfad';
	public $SENDMAILPATHD = 'Benutze Sendmail wenn das die eingestellte E-mail Versandmethode ist (Standardeinstellung: /usr/sbin/sendmail).';
	public $SMTPHOST = 'SMTP Host';
	public $SMTPPORT = 'SMTP Port';
	public $SECURESMTP = 'Sicheres SMTP';
	public $SMTPAUTH = 'SMTP Identifizierung';
	public $SMTPUSER = 'SMTP Benutzername';
	public $SMTPPASS = 'SMTP Passwort';
	public $ADDREPLYTO = 'Antwort an';
	public $ADDREPLYTOD = 'Antwort an E-mail Adressen im Kopf der E-mail?';
	public $THECOPY = 'Kopie'; //translators help: THE copy (material, a copied newsletter)
	public $SHOWCOPYRIGHT = 'Copyright zeigen';
	public $SHOWCOPYRIGHTD = 'Wollen Sie einen Copyright Hinweis im Frontend anzeigen lassen? Das ist meine Bitte an Sie denn Sie erhalten diese Anwendung kostenlos!';
	public $UPHTMLTEMP = 'Laden Sie eine HTML Datei hoch, um sie als Newslettertemplate zu verwenden ';
	public $UPLOADHTMLTEMP = 'HTML Template hochladen';
	public $SENDNEWSLET = 'Newsletter senden';
	public $IMPORTELXUS = 'Importiere Elxis Benutzer';
	public $IMPORTELXUSD = 'Importiere vorhandene Elxis Benutzer in Newsletter. Nur Benutzer, deren E-mail 
	Adresse in Newsletters nicht vorhanden ist, werden importiert.';
	public $FOUNDELXUIMP = "%s Elxis Benutzer wurden gefunden. %s von ihnen wurden in Newsletter importiert."; //translators help: filled in by numbers

	//languages names
	public $ARMENIAN = 'Armenisch';
	public $BOZNIAN = 'Bosnisch';
	public $BRAZILIAN = 'Brasilianisch';
	public $BULGARIAN = 'Bulgarisch';
	public $CREOLE = 'Creolisch';
	public $CROATIAN = 'Croatisch';
	public $DANISH = 'Dänisch';
	public $ENGLISH = 'Englisch';
	public $FRENCH = 'Französisch';
	public $GERMAN = 'Deutsch';
	public $GREEK = 'Grichisch';
	public $INDONESIAN = 'Indonesisch';
	public $ITALIAN = 'Italiänisch';
	public $JAPANESE = 'Japanisch';
	public $LATVIAN = 'Lettisch';
	public $LITHUANIAN = 'Litauisch';
	public $PERSIAN = 'Persisch';
	public $POLISH = 'Polnisch';
	public $RUSSIAN = 'Russisch';
	public $SERBIAN = 'Serbisch';
	public $SPANISH = 'Spanisch';
	public $SRPSKI = 'Srpski';
	public $TURKISH = 'Türkisch';
	public $VIETNAMESE = 'Vietnamesisch';

	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
	}

}

?>