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
* @description: German language for component softdisk
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direkter Zugriff auf diesen Ort ist nicht erlaubt.' );


class adminLanguage extends standardLanguage {

public $A_CORE = 'Core';
public $A_ASTATS = 'Administration Statistik';
public $A_VALUE = 'Wert';
public $A_LASTMOD = 'Zuletzt geändert';
public $A_OS = 'Betriebssystem';
public $A_ELXIS_VERSION = 'Elxis Version';
public $A_SELECT = 'Auswahl';
public $NOEDITSYS = 'Es ist ihnen nicht gestattet, Systemeinträge zu verändern';
public $A_RESTORE = 'Wiederherstellen';
public $SOFTDISK_HELP = 'SoftDisk ist ein virtueller Speicherbereich für Variablen und Parameter jeder Art.<br />
  	Sie können neue Einträge hinzufügen oder existierende bearbeiten/löschen - bis auf solche die zum System gehören. 
	Ebenfalls können Einträge die als unlöschbar markiert sind nur bearbeitet werden. Für die Namensgebung der SoftDisk Sektionen und Werte 
	können sie nur <strong>Großschreibung und alphabetischen Zeichen, Zahlen und Unterstriche (_) verwenden</strong>.';
public $YCNOTEDITP = 'Sie können diesen Parameter nicht bearbeiten';
public $UNDELETABLE = 'Unlöschbar';
public $SOFTENTRYEXIST = 'Es gibt schon einen SoftDisk Eintrag mit diesem Namen!';
public $INVSECTNAME = 'Ungültiger Sektionsname!';
public $INVNAME = 'Ungültiger Name!';
public $INVEMAIL = 'Übermittelter Wert ist keine gültige Email-Adresse!';
public $INVURL = 'Übermittelter Wert ist keine gültige URL!';
public $INVDEC = 'Übermittelter Wert ist keine Dezimalzahl!';
public $INVTSTAMP = 'Übermittelter Wert ist kein gültiger UNIX Zeitstempel!';
public $UPSYSTEM = 'Aktualisiere System';
public $A_USERPROFILE = 'Benutzer Profil';
public $UPROF_WEBSITE = 'Webseite';
public $UPROF_AIM = 'AIM';
public $UPROF_YIM = 'YIM';
public $UPROF_MSN = 'MSN';
public $UPROF_ICQ = 'ICQ';
public $UPROF_EMAIL = 'EMail';
public $UPROF_PHONE = 'Telefon';
public $UPROF_MOBILE = 'Mobil';
public $UPROF_BIRTHDATE = 'Geburtstag';
public $UPROF_GENDER = 'Geschlecht';
public $UPROF_LOCATION = 'Ort';
public $UPROF_OCCUPATION = 'Beruf';
public $UPROF_SIGNATURE = 'Signatur';
public $UPROF_ARTICLES = 'Anzahl von Artikeln';
public $UPROF_USERGROUP = 'Benutzergruppe';
public $UPROF_RANDUSERS = 'Zeige Zufallsbenutzer auf der Profilseite';
public $USERS_RPASSMAIL = 'Administrator benachrichtigen, wenn Passwort Erinnerung angefordert wird';
public $SUBMIT_CATEGORIES = 'Kategorien die als gültige Inhaltsvorlage erlaubt sind. Falls leer, sind alle erlaubt. (Kategorien IDs, Komma getrennt)';
public $SUBMIT_SECTIONS = 'Sektionen die als gültige Inhaltsvorlage erlaubt sind. Falls leer, sind alle erlaubt. (Sektionen IDs, Komma getrennt)';
public $REG_AGREE = 'ID der autonomen Seite für die Nutzungsbedingungen. Null (0) zum deaktivieren. Für sprachspezifische Bedingungen erstellen sie einen SoftDisk Eintrag in der Sektion BENUTZER. Für jede Sprache mit dem Namen REG_AGREE_LANGUAGE-HERE vom Typ Integer';
public $A_WEBLINKS = 'Weblinks';
public $TOP_WEBLINK = 'Kontrolliert die Anzeige des Moduls Top Weblinks innerhalb der Komponente Weblinks';
public $A_USERSLIST = 'Benutzerliste';
public $ULIST_ONLINE = 'Online Status';
public $ULIST_USERNAME = 'Benutzername';
public $ULIST_NAME = 'Name';
public $ULIST_REGDATE = 'Registrierungsdatum';
public $ULIST_PREFLANG = 'Bevorzugte Sprache';
//2009.0
public $STATICCACHE = 'Statischer Cache';

}

?>