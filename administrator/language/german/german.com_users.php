<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Siegmund Langsch, Simon Zöllner (SimonZ)
* @link: http://www.langschnet.de
* @email: s.langsch@langhscnet.de
* @description: German language for component users
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direkter Zugriff auf diesen Ort ist nicht erlaubt.' );


class adminLanguage extends standardLanguage {

public $A_CMP_USS_LOGIN = 'Angemeldet';
public $A_CMP_USS_ALL = 'Alle';
public $A_CMP_USS_ID = 'BenutzerID';
public $A_CMP_USS_LSTV = 'Lezter Besuch';
public $A_CMP_USS_ENBLD = 'Aktiviert';
public $A_CMP_USS_BLCKD = 'Gesperrt';
public $A_CMP_USS_LVDATE = '%d-%m-%Y %H:%M:%S'; //Last visit Date
public $A_CMP_USS_PFISNOT = 'Bitte wählen sie eine andere Gruppe, weil \'Öffentliches Frontend\' keine wählbare Option ist';
public $A_CMP_USS_PBISNOT = 'Bitte wählen sie eine andere Gruppe, weil \'Öffentliches Backend\' keine wählbare Option ist';
public $A_CMP_USS_DETAILS = 'Benutzer Details';
public $A_CMP_USS_EMAIL = 'EMail';
public $A_CMP_USS_PASS = 'Neues Passwort';
public $A_CMP_USS_VERIFY = 'Vergleiche Passwort';
public $A_CMP_USS_BLOCK = 'Blockiere Benutzer';
public $A_CMP_USS_SUBMI = 'Erhalte Eintrags Emails';
public $A_CMP_USS_REGDATE = 'Registrierdatum';
public $A_CMP_USS_VISDTE = 'Datum letzter Besuch';
public $A_CMP_USS_CONTCT = 'Kontakt Informationen';
public $A_CMP_USS_NDETL = 'Keine Kontaktdetails mit diesem Benutzer verbunden />Schauen sie unter \'Komponenten -> Kontakt -> Kontaktverwaltung\' nach Details.';
public $A_CMP_USS_SUCCH = 'Änderungen für Benutzer erfolgreich gespeichert';
public $A_CMP_USS_SUCUSR = 'Benutzer erfolgreich gespeichert';
public $A_CMP_USS_CANNOT = 'Sie können einen Super Administrator nicht löschen';
public $A_CMP_USS_CANNYO = 'Sie können sich nicht selbst löschen!';
public $A_CMP_USS_CANNUS = 'Es ist ihnen nicht gestattet diesen Benutzer zu löschen';
public $A_CMP_USS_SLUSER = 'Bitte wählen sie einen Benutzer';
public $A_CMP_USS_FLGOUT = 'Sofort Abmelden';
public $A_CMP_USS_UMUST = 'Sie müssen einen Benutzernamen für die Anmeldung angeben.';
public $A_CMP_USS_ULOGIN = 'Ihr Benutzername ist zu kurz oder enthält illegale Zeichen.';
public $A_CMP_USS_MSTEMAIL = 'Sie müssen eine EMail-Adresse angeben.';
public $A_CMP_USS_ASSIGN = 'Sie müsen den Benutzer einer Gruppe zuordnen.';
public $A_CMP_USS_NOMATC = 'Passwörter stimmen nicht überein.';
public $A_CMP_USS_FLOGD = 'Filter Gesperrt';
public $A_CMP_USS_FACST = 'Filter Aktiv';
public $A_CMP_USS_PHONE = 'Telefon';
public $A_CMP_USS_FAX = 'Fax';
public $A_CMP_USS_NOEXTRA = 'Keine Extrafelder gesetzt oder veröffentlicht';
public $A_CMP_USS_VERTICAL = 'Vertikal';
public $A_CMP_USS_HORIZONT = 'Horizontal';
public $A_CMP_USS_CHECKED = 'geprüft';
public $A_CMP_USS_1OPTVLEAST = 'Wenigstens eine Option und eine gültige Option muss übergeben werden';
public $A_CMP_USS_1OPTLEAST = 'Wenigstens eine Option muss übergeben werden';
public $A_CMP_USS_EXTRASAVED = 'Extrafeld erfolgreich gespeichert';
public $A_CMP_USS_CHACONDET = 'Ändere Kontakt Details';
public $A_CMP_USS_REQUIRED = 'Erforderlich';
public $A_CMP_USS_REGISTR = 'Registrierung';
public $A_CMP_USS_PROFILE = 'Profil';
public $A_CMP_USS_RONLY = 'Nur lesen';
public $A_CMP_USS_HIDDEN = 'Versteckt';
public $A_CMP_USS_SHOWREG = 'In Registrierung anzeigen';
public $A_CMP_USS_SHOWPROF = 'In Profil anzeigen';
public $A_CMP_USS_OPTALIGN = 'Optionsausrichtung';
public $A_CMP_USS_PREVNOTE = 'Hinweis: Sie müssen ihre Änderungen speichern um sie in der Vorschau zu sehen.';
public $A_CMP_USS_OPTIONS = 'Optionen';
public $A_CMP_USS_OPTIONSFOR = 'Optionen für';
public $A_CMP_USS_MUSTFNAME = 'Sie müssen dem Feld einen Namen geben';
public $A_CMP_USS_MAXLENINV = 'Maximale Feldlänge ist ungültig';
public $A_CMP_USS_HIDMUSTVAL = 'Ein verstecktes Feld muss einen Wert haben!';
public $A_CMP_USS_DEFVAL = 'Voreingestellte Wert';
public $A_CMP_USS_MAXLEN = 'Maximale Länge';
public $A_CMP_USS_REQFLDSNO = 'Eines oder mehrere erforderliche Felder sind nicht ausgefüllt!';
public $A_CMP_USS_HIDNOREQ = 'Ein verstecktes Feld kann nicht den Status erforderlich haben!';
public $A_CMP_USS_HIDNOPROF = 'Ein verstecktes Feld kann nicht im Profil angezeigt werden!';
//2008
public $A_CMP_USS_PREFLANG = 'Bevorzugte Sprache';
public $A_CMP_USS_AVATAR = 'Avatar';
public $A_CMP_USS_WEBSITE = 'Webseite';
public $A_CMP_USS_AIM = 'AIM';
public $A_CMP_USS_YIM = 'YIM';
public $A_CMP_USS_MSN = 'MSN';
public $A_CMP_USS_ICQ = 'ICQ';
public $A_CMP_USS_MOBILE = 'Mobil';
public $A_CMP_USS_BIRTHDATE = 'Geburtstag';
public $A_CMP_USS_GENDER = 'Geschlecht';
public $A_CMP_USS_LOCATION = 'Ort';
public $A_CMP_USS_OCCUPATION = 'Beruf';
public $A_CMP_USS_SIGNATURE = 'Signatur';
public $A_CMP_USS_MALE = 'Männlich';
public $A_CMP_USS_FEMALE = 'Weiblich';
public $A_CMP_USS_YEAR = 'Jahr';
public $A_CMP_USS_MONTH = 'Monat';
public $A_CMP_USS_DAY = 'Tag';
public $A_CMP_USS_BOLDINDIC = 'Elemente in Fettschrift sind im Benutzerprofil aktiviert.';
public $A_CMP_USS_ENDISSOFT = 'Sie können Profilelemente innerhalb von SoftDisk ein- oder ausschalten.';
//2009.0
public $A_USERS_EXPDATE = 'Ablaufdatum';
public $A_USERS_ACCEXPIRED = 'Account abgelaufen';
public $A_USERS_ACCNACTIVE = 'Account aktiv';

}

?>