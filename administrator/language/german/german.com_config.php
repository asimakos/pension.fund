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
* @description: German language for component config
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direkter Zugriff auf diesen Ort ist nicht erlaubt.' );


class adminLanguage extends standardLanguage {

	public $A_COMP_CONF_OFFLINE = 'Seite Offline';
	public $A_COMP_CONF_OFFMESSAGE = 'Offline Nachricht';
	public $A_COMP_CONF_TIP_OFFMESSAGE = 'Diese Nachricht wird angezeigt, wenn ihre Seite offline ist';
	public $A_COMP_CONF_ERR_MESSAGE = 'Systemfehler-Nachricht';
	public $A_COMP_CONF_TIP_ERR_MESSAGE = 'Diese Nachricht wird angezeigt, wenn Elxis keine Verbindung zur Datenbank aufbauen kann';
	public $A_COMP_CONF_SITE_NAME = 'Name der Seite';
	public $A_COMP_CONF_UN_LINKS = 'Unautorisierte Links anzeigen';
	public $A_COMP_CONF_UN_TIP = 'Wenn ja, werden Links zu Inhalten im Benutzerbereich angezeigt, auch wenn man nicht angemeldet ist. Benutzer müssen sich anmelden, um den kompletten Inhalt zu sehen.';
	public $A_COMP_CONF_USER_REG = 'Erlaube Benutzeranmeldungen';
	public $A_COMP_CONF_TIP_USER_REG = 'Wenn ja, können neue Benutzer sich auf der Seite registrieren';
	public $A_COMP_CONF_REQ_EMAIL = 'Eindeutige Email-Adresse erforderlich';
	public $A_COMP_CONF_REQTIP = 'Wenn ja, kann jede Email-Adresse nur ein mal verwendet werden. Mehrere Benutzer können sich nicht mit der selben Mailadresse anmelden';
	public $A_COMP_CONF_DEBUG = 'Seite Debuggen zur Fehlersuche';
	public $A_COMP_CONF_DEBTIP = 'Wenn ja, dann werden Diagnoseinformationen und SQL-Server Fehler angezeigt, falls vorhanden';
	public $A_COMP_CONF_EDITOR = 'WYSIWYG Editor';
	public $A_COMP_CONF_LENGTH = 'Listenlänge';
	public $A_COMP_CONF_LENTIP = 'Setzt den Voreingestellten Wert für die Listenlängen aller User im Admin-Bereich';
	public $A_COMP_CONF_FAV_ICON = 'Favoriten Icon';
	public $A_COMP_CONF_FAVTIP = 'Wenn leer oder Datei kann nicht gefunden werden, wird das Standard favicon.ico benutzt';
	public $A_COMP_CONF_CLINKACC = 'Komponenten, die mit dem Rechtesystem verbunden sind';
	public $A_COMP_CONF_CLACCDESC = 'Wählen sie den Typ der Komponenten die dem Rechtesystem zugeordnet werden sollen (ACO Wert = Ansicht). Lesen sie die Hilfe, wenn sie unsicher sind.';
	public $A_COMP_CONF_CORECOMPS = 'Core Komponenten';
	public $A_COMP_CONF_3RDCOMPS = 'Drittanbieter Komponenten';
	public $A_COMP_CONF_ALLCOMPS = 'Alle Komponenten';
	public $A_COMP_CONF_CAPTCHA = 'Verwende Sicherheitsgrafik (Captcha)';
	public $A_COMP_CONF_CAPTCHATIP = 'Ja, wenn eine Sicherheitsgrafik (Captcha) in Webformularen eingeblendet werden soll. Ein Sprachausgabewerkzeug steht für Besucher zur Verfügung, deren Sehfähigkeit eingeschränkt ist.';
	public $A_COMP_CONF_LOCALE = 'Lokale';
	public $A_COMP_CONF_LANG = 'Voreingestellte Front-End Sprache';
	public $A_COMP_CONF_ALANG = 'Voreingestellte Back-End Sprache';
	public $A_COMP_CONF_TIME_SET = 'Zeitverschiebung';
	public $A_COMP_CONF_DATE = 'Aktuelles Datum und Zeit zur Anzeige konfigurieren';
	public $A_COMP_CONF_LOCAL = 'Länder Lokale';
	public $A_COMP_CONF_LOCRECOM = 'Wir empfehlen, diesen Wert auf automatisch zu belassen. Elxis wird die am besten passenden Lokaleinstellungen für ihr System automatisch versuchen zu laden. Windows unterstützt keine UTF-8 Lokaleinstellungen.';
	public $A_COMP_CONF_LOCCHECK = 'Prüfe Lokaleinstellungen';
	public $A_COMP_CONF_LOCCHECK2 = 'Wenn sie dieses Datum korrekt formatiert sehen, dann ist der Wert für Lokale auf ihrem System richtig eingestellt.<br /><strong>Attention!</strong> Unter Windows werden die Lokaleinstellungen automatisch auf englisch gesetzt.';
	public $A_COMP_CONF_AUTOSEL = 'Automatisch';
	public $A_COMP_CONF_CONTROL = '* Diese Parameter kontrollieren die Ausgabe-Elemente *';
	public $A_COMP_CONF_LINK_TITLES = 'Verlinkte Titel';
	public $A_COMP_CONF_LTITLES_TIP = 'Wenn ja, funktioniert der Titel eines Inhaltes als Hyperlink zum Item';
	public $A_COMP_CONF_MORE_LINK = 'Lesen sie mehr...Link';
	public $A_COMP_CONF_MLINK_TIP = 'Wenn Anzeige aktiviert, wird der Lesen Sie mehr... Link angezeigt, falls Haupttext für den Inhalt hinterlegt wurde';
	public $A_COMP_CONF_RATE_VOTE = 'Item Bewertung/Abstimmung';
	public $A_COMP_CONF_RVOTE_TIP = 'Falls aktiviert, wird das Abstimmungssystem für Inhalte verwendet';
	public $A_COMP_CONF_AUTHOR = 'Name des Autors';
	public $A_COMP_CONF_AUTHORTIP = 'Falls aktiviert, wird der Name des Verfassers des Inhalts eingeblendet. Diese globale Einstellung kann auf Menü- und Itemebene verändert werden';
	public $A_COMP_CONF_CREATED = 'Erstellungsdatum und Zeit';
	public $A_COMP_CONF_CREATEDTIP = 'Wenn aktiviert, Werden Erstellungsdatum und Zeit des Artikels angezeigt. Diese globale Einstellung kann auf Menü- und Itemebene verändert werden';
	public $A_COMP_CONF_MOD_DATE = 'Zuletzt geändert';
	public $A_COMP_CONF_MDATETIP = 'Wenn aktiviert, Werden Datum und Zeit der letzten Änderung im Artikel angezeigt. Diese globale Einstellung kann auf Menü- und Itemebene verändert werden';
	public $A_COMP_CONF_HITS = 'Zugriffe';
	public $A_COMP_CONF_HITSTIP = 'Wenn aktiviert, werden die Zugriffe auf ein Item angezeigt. Diese globale Einstellung kann auf Menü- und Itemebene verändert werden';
	public $A_COMP_CONF_PDF = 'PDF Icon';
	public $A_COMP_CONF_OPT_MEDIA = 'Option nicht verfügbar, so lange /tmp Verzeichnis nicht beschreibbar ist';
	public $A_COMP_CONF_PRINT_ICON = 'Druck Icon';
	public $A_COMP_CONF_EMAIL_ICON = 'Email Icon';
	public $A_COMP_CONF_ICONS = 'Icons';
	public $A_COMP_CONF_USE_OR_TEXT = 'Drucken, RTF, PDF & Email benutzt Icons oder Text';
	public $A_COMP_CONF_TBL_CONTENTS = 'Tabelle der Seiten bei mehrseitigen Inhalten anzeigen';
	public $A_COMP_CONF_BACK_BUTTON = 'Zurück Button';
	public $A_COMP_CONF_CONTENT_NAV = 'Inhalts Item Navigation';
	public $A_COMP_CONF_HYPER = 'Benutzte verlinkte Titel';
	public $A_COMP_CONF_DBTYPE = 'Datenbank Typ';
	public $A_COMP_CONF_DBWARN = 'Nicht ändern, es sei denn, sie sind sicher, das ihr System diesen Typ unterstützt und eine Elxis Datenbank in diesem Datenbanktyp existiert!';
	public $A_COMP_CONF_HOSTNAME = 'Hostname';
	public $A_COMP_CONF_DB_PW = 'Passwort';
	public $A_COMP_CONF_DB_NAME = 'Datenbank';
	public $A_COMP_CONF_DB_PREFIX = 'Datenbank Präfix';
	public $A_COMP_CONF_NOT_CH = '!! NICHT ÄNDERN, ES SEI DENN SIE SIND SICHER DAS IHRE DATENBANK EIN ANDERES PRÄFIX VERWENDET !!';
	public $A_COMP_CONF_ABS_PATH = 'Absoluter Pfad';
	public $A_COMP_CONF_LIVE = 'Live Seite';
	public $A_COMP_CONF_SECRET = 'Geheimes Wort';
	public $A_COMP_CONF_GZIP = 'GZIP Seitenkompressionn';
	public $A_COMP_CONF_CP_BUFFER = 'Kompressionsgepufferte Ausgabe, falls unterstützt';
	public $A_COMP_CONF_SESSION_TIME = 'Sitzungsdauer';
	public $A_COMP_CONF_SEC = 'Sekunden';
	public $A_COMP_CONF_AUTO_LOGOUT = 'Automatische Abmeldung nach der voreingestellten Zeit';
	public $A_COMP_CONF_ERR_REPORT = 'Fehlerberichte';
	public $A_COMP_CONF_HELP_SERVER = 'Hilfe Server';
	public $A_COMP_CONF_META_PAGE = 'Metadata-Seite';
	public $A_COMP_CONF_META_DESC = 'Globale Metabeschreibung der Seite';
	public $A_COMP_CONF_META_KEY = 'Globale Meta-Schlüsselwörter der Seite';
	public $A_COMP_CONF_HPS1 = 'Lokale Hilfedateien';
	public $A_COMP_CONF_HPS2 = 'Entfernter Elxis Hilfe Server';
	public $A_COMP_CONF_HPS3 = 'Offizieller Elxis Hilfe Server';
	public $A_COMP_CONF_PERMFLES = 'Wählen sie diese Option, um Zugriffsrechte für neu erstellte Dateien zu definieren';
	public $A_COMP_CONF_PERMDIRS = 'Wählen sie diese Option, um Zugriffsrechte für neu erstellte Verzeichnisse zu definieren';
	public $A_COMP_CONF_NCHMODDIRS = 'Kein CHMOD auf neue Verzeichnisse anwenden (Voreinstellungen benutzen)';
	public $A_COMP_CONF_CHAPFLAGS = 'Falls aktiviert, werden die Zugriffsrechte auf <em>alle existierenden Dateien</em> dieser Seite angewendet.<br/><strong>FEHLEHRHAFTE ANWENDUNG DIESER OPTION KANN DIE WEBSEITE UNBENUTZBAR MACHEN!</strong>';
	public $A_COMP_CONF_CHAPDLAGS = 'Falls aktiviert, werden die Zugriffsrechte auf <em>alle existierenden Verzeichnisse</em> dieser Seite angewendet.<br/><strong>FEHLEHRHAFTE ANWENDUNG DIESER OPTION KANN DIE WEBSEITE UNBENUTZBAR MACHEN!</strong>';
	public $A_COMP_CONF_APPEXDIRS = 'Auf existierende Verzeichnisse anwenden';
	public $A_COMP_CONF_APPEXFILES = 'Auf existierende Dateien anwenden';
	public $A_COMP_CONF_WORLD = 'Welt';
	public $A_COMP_CONF_CHMODNDIRS = 'CHMOD auf neue Verzeichnisse anwenden';
	public $A_COMP_CONF_MAIL = 'Mailer';
	public $A_COMP_CONF_MAIL_FROM = 'Mail von';
	public $A_COMP_CONF_MAIL_FROM_NAME = 'Von Name';
	public $A_COMP_CONF_MAIL_SMTP_AUTH = 'SMTP Auth';
	public $A_COMP_CONF_MAIL_SMTP_USER = 'SMTP User';
	public $A_COMP_CONF_MAIL_SMTP_PASS = 'SMTP Pass';
	public $A_COMP_CONF_MAIL_SMTP_HOST = 'SMTP Host';
	public $A_COMP_CONF_CACHE = 'Caching';
	public $A_COMP_CONF_CACHE_FOLDER = 'Cache Verzeichnis';
	public $A_COMP_CONF_CACHE_DIR = 'Aktuelles Cache Verzeichnis ist';
	public $A_COMP_CONF_CACHE_DIR_UNWRT = 'Das Cache Verzeichnis ist UNBESCHREIBBAR - Bitte setzen sie die Rechte für dieses Verzeichnis auf 777 bevor sie das Caching aktivieren';
	public $A_COMP_CONF_CACHE_TIME = 'Cache Zeit';
	public $A_COMP_CONF_STATS = 'Statistik';
	public $A_COMP_CONF_STATS_ENABLE = 'Aktivieren/Deaktivieren der Sammlung von statistischen Daten';
	public $A_COMP_CONF_STATS_LOG_HITS = 'Inhaltszugriffe mit Datum aufzeichnen';
	public $A_COMP_CONF_STATS_WARN_DATA = 'WARNUNG : Es werden große Datenmengen gesammelt';
	public $A_COMP_CONF_STATS_LOG_SEARCH = 'Aufzeichnen von Suchanfragen';
	public $A_COMP_CONF_SEO_LBL = 'SEO';
	public $A_COMP_CONF_SEO = 'Suchmaschinen Optimierung';
	public $A_COMP_CONF_SEO_SEFU = 'Suchmaschinenfreundliche URLs';
	public $A_COMP_CONF_SEOBASIC = 'SEO Basis';
	public $A_COMP_CONF_SEOPRO = 'SEO Pro';
	public $A_COMP_CONF_SEOHELP = "Apache und IIS. Apache: Benennen sie die Datei htaccess.txt in .htaccess um, bevor sie diese Option aktivieren (mod_rewrite muss aktiviert sein). IIS: Benutzen sie Ionic Isapi Rewriter filter. Bereiten sie ihre Inhalte für ein Maximum an Performance vor, bevor sie SEO PRO aktivieren. Wählen sie SEO Basis falls sie den Einsatz einer Drittanbieter SEF Komponente planen.";
	public $A_COMP_CONF_SERVER = 'Server';
	public $A_COMP_CONF_METADATA = 'Metadata';
	public $A_COMP_CONF_CACHE_TAB = 'Cache';
	public $A_COMP_CONF_FTP_LBL = 'FTP';
	public $A_COMP_CONF_FTP = 'FTP Einstellungen';
	public $A_COMP_CONF_FTP_ENB = 'FTP aktivieren';
	public $A_COMP_CONF_FTP_HST = 'FTP Host';
	public $A_COMP_CONF_FTP_HSTTP = 'Meist wahrscheinlich';
	public $A_COMP_CONF_FTP_USR = 'FTP Username';
	public $A_COMP_CONF_FTP_USRTP = 'Meist wahrscheinlich';
	public $A_COMP_CONF_FTP_PAS = 'FTP Passwort';
	public $A_COMP_CONF_FTP_PRT = 'FTP Port';
	public $A_COMP_CONF_FTP_PRTTP = 'Voreinstellung ist: 21';
	public $A_COMP_CONF_FTP_PTH = 'FTP Wurzelverzeichnis';
	public $A_COMP_CONF_FTP_PTHTP = 'Pfad vom FTP Wurzelverzeichnis zu ihrer Elxis Installation. z. B. /public_html/elxis';
	public $A_COMP_CONF_HIDE = 'Verstecken';
	public $A_COMP_CONF_SHOW = 'Zeigen';
	public $A_COMP_CONF_DEFAULT = 'System Voreinstellungen';
	public $A_COMP_CONF_NONE = 'Keine';
	public $A_COMP_CONF_SIMPLE = 'Einfach';
	public $A_COMP_CONF_MAX = 'Maximum';
	public $A_COMP_CONF_MAIL_FC = 'PHP Mail Funktion';
	public $A_COMP_CONF_SEND = 'Sendmail';
	public $A_COMP_CONF_SENDP = 'Sendmail Pfad';
	public $A_COMP_CONF_SMTP = 'SMTP Server';
	public $A_COMP_CONF_UPDATED = 'Die Konfigurationseinstellungen wurden <strong>aktualisiert!</strong>';
	public $A_COMP_CONF_ERR_OCC = '<strong>Ein Fehler ist aufgetreten!</strong> Konfigurationsdatei konnte nicht zum Schreiben geöffnet werden!';
	public $A_COMP_CONF_READ = 'lesen';
	public $A_COMP_CONF_WRITE = 'schreiben';
	public $A_COMP_CONF_EXEC = 'ausführen';
	public $A_COMP_CONF_FCRE = 'Dateierstellung';
	public $A_COMP_CONF_FPERM = 'Dateirechte';
	public $A_COMP_CONF_DCRE = 'Verzeichniserstellung';
	public $A_COMP_CONF_DPERM = 'Verzeichnisrechte';
	public $A_COMP_CONF_OFFEX = 'Ja (Außer für Superadmins)';
	public $A_COMP_CONF_RTF = 'RTF Icon';

	//elxis 2008.1
	public $A_C_CONF_AC_ACT = 'Kontenaktivierung';
	public $A_C_CONF_NOACT = 'Keine Aktivierung';
	public $A_C_CONF_EMACT = 'Aktivierung via E-Mail';
	public $A_C_CONF_MANACT = 'Manuelle Aktivierung';
	public $A_C_CONF_AC_ACTD = 'Wählen Sie aus, wie sie neue Benutzerkonten aktivieren möchten: direkt, via Aktivierungslink, welcher via E-Mail versendet wird, oder durch Freischaltung durch einen Seiten-Administrator';

	//2009.0
	public $A_C_CONF_COMMENTS = 'Kommentare';
	public $A_C_CONF_COMMENTSTIP = 'Wenn der Wert auf aziegen gestellt ist, wird die Anzahl der Kommentare für einen bestimmten Artikel angezeigt. Das ist eine globale Einstellung die aber auf Menü oder Itemebene geändert werden kann';
	public $A_C_CONF_CHKFTP = 'Überprüfe FTP Einstellungen';
	public $A_C_CONF_STDCACHE = 'Standard Cache';
	public $A_C_CONF_STATCACHE = 'Statischer Cache';
	public $A_C_CONF_CACHED = 'Standard Cache speichert eine Seitenblöcke während der statische Cache die gesamte Seite speichert. Der statische Cache wird für Seiten mit hohem Besucheraufkommen empfohlen. Um den statischen Cache zu benutzen muss SEO PRO aktiviert sein.';
	public $A_C_CONF_SEODIS = 'SEO PRO ist deaktiviert!';

	public function __construct() {	
	}

}

?>