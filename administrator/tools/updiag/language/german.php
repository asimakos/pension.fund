<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Elxis Team
* @translator: Siegmund Langsch
* @translator URL: http://www.langschnet.de
* @translator E-mail: s.langsch@langschnet.de
* @description: German language for Updiag tool
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direkter Zugriff auf diesen Ort ist nicht erlaubt.' );


class updiagLang {

	public $UPDATE = 'Aktualisiere';
	public $CHVERS = 'Prüfe Version';
	public $CNOTGETELXD = 'Empfange keine Daten von elxis.org';
	public $INVXML = 'Ungültige XML Datei erhalten. Kann angeforderte Information nicht darstellen.';
	public $SIZE = 'Größe';
	public $MORE = 'Mehr';
	public $DOWNLOAD = 'Herunterladen';
	public $INSELXVER = 'Installierte Elxis Version';
	public $CURRENT = 'Aktuell';
	public $OUTDATED = 'Veraltet!';
	public $NEWVERAV = 'Es ist eine neuere version von Elxis verfügbar. Bitte aktualisieren sie ihre Version sobald wie möglich.';
	public $CHPATCHES = 'Prüfe auf Patches';
	public $NOPATCHES = 'Es sind keine Patches für ihre Version verfügbar';
	public $PROSUPPORT = 'Professioneller Support';
	public $NEWS = 'News';
	public $MAINTENANCE = 'Wartung';
	public $REMOTEERR1 = 'Ungültige Anfrage';
	public $REMOTEERR2 = 'Kann keine Liste der Scripte erhalten';
	public $REMOTEERR3 = 'Keine Scripte gefunden';
	public $REMOTEERR4 = 'Angeforderte Datei ist leer';
	public $REMOTEERR5 = 'Kann keine Liste der Hash-Dateien erhalten';
	public $REMOTEERR6 = 'Keine Hash Dateien gefunden';
	public $REMOTEERR7 = 'Kann angeforderte Datei nicht herunterladen!';
	public $UNERROR = 'Unbekannter Fehler';
	public $PROVCODE = 'Setzt Code zur Aktualisierung von Elxis von Version';
	public $TOVERSION = 'zu Version vorraus';
	public $INSTALLED = 'Installiert';
	public $REQFEXISTS = 'Angeforderte Datei existiert schon!';
	public $FILDOWNSUC = 'Datei erfolgreich heruntergeladen!';
	public $DFORRUNSCR = 'Vergessen sie nicht das Script zu starten, falls sie ihre Elxis Version aktualisieren wollen.';
	public $CNOTCPDFIL = 'Kann heruntergeladene Datei nicht ins Zielverzeichnis kopieren.';
	public $PLCHSCRPERM = 'Bitte Verzeichnisrechte von /administrator/tools/updiag/data/scripts prüfen';
	public $PLCHSCRPERM2 = 'Bitte Verzeichnisrechte von /administrator/tools/updiag/data/hashes prüfen';
	public $EXECUTE = 'Ausführen';
	public $SCRNOTEX = 'Angefordertes Script existiert nicht!';
	public $FSCHECK = 'Prüfe Dateisystem';
	public $HIDEHELP = 'Verstecke Hilfe';
	public $NORMAL = 'Normal';
	public $EXTENDED = 'Erweitert';
	public $FULL = 'Voll';
	public $NOHASHFOUND = 'Keine Hash-Datei gefunden';
	public $INVHFILE = 'Ungültige Hash-Datei!';
	public $SHFELXVER = 'Gewählte Hash-Datei ist für eine ältere Elxis Version!';
	public $FNOTEXIST = 'Datei existiert nicht';
	public $WARNING = 'Warnung';
	public $FNEEDUP = 'Datei braucht Aktualisierung';
	public $SITUP2D = 'Site ist aktuell!';
	public $FOUND = 'Gefunden';
	public $OUTFUP = 'veraltete Dateien. Bitte aktualisieren!';
	public $CHFINUS = 'Prüfe Aktualisierungs-Status der Site anhand der Quelle <b>%s</b>';
	public $NEWRELEASES = 'Neues Release';
	public $NONEWREL = 'Es gibt kein neues Release';
	public $PRICE = 'Preis';
	public $LICENSE = 'Lizenz';
	public $SECURITY = 'Sicherheit';
	public $INSTPATH = 'Installationspfad';
	public $CREDITS = 'Credits';
	public $ALERT = 'Alarm';
	public $FSECALWA = 'Gefunden wurden <b>%d</b> Sicherheitsalarme und Warnungen';
	public $ELXINPAS = 'Sicherheitscheck war erfolgreich';
	public $HOME = 'Home';
	public $UPDSPAG = 'Updiag Zentrale';
	public $UPDWELC = 'Willkommen zu <b>Updiag</b>, dem Elxis Update und Diagnose Wekzeug.';
	public $STARTMORE = 'Die meisten der enthaltenen Funktionen benötigen eine Verbindung zu elxis.org. 
	Sie müssen also eine offene verbindung von ihrer Seite zu elxis.org haben, damit dieses Werkzeug funktioniert. 
	Wählen sie ein Item aus dem Topmenü zum Navigieren.';
	public $BASCHECKS = 'Basisprüfung <small>(Anklicken zum Ausführen)</small>';
	public $FILEREMSUC = 'Datei erfolgreich entfernt!';
	public $CNREMSFILE = 'Kann gewählte Datei nicht entfernen! Bitte rechte prüfen.';
	public $HASHNOTEX = 'Angeforderte Hash-Datei existiert nicht!';
	public $DNHASHFLS = 'Lade Hash-Dateien herunter';
	public $BUY = 'Kaufe';
	public $DOWNLTIME = 'Download Zeit';
	public $DOWNLSPEED = 'Download Geschwindigkeit';


	public function __construct() {
	}

}

define('CX_LUPDIAGD', 'Hilft ihnen, ihre Seite aktuell zu halten und informiert sie über neue Elxis Versionen und Sicherheitsupdates.');

?>