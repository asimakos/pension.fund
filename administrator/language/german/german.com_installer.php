<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Siegmund Langsch, Simon Zöllner (SimonZ)
* @link: http://www.langschnet.de
* @email: s.langsch@langhscnet.de
* @description: German language for component installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direkter Zugriff auf diesen Ort ist nicht erlaubt.' );


class adminLanguage extends standardLanguage {

public $A_CMP_INS_SDIR = 'Wählen sie ein Verzeichnis';
public $A_CMP_INS_UPF = 'Paketdatei hochladen';
public $A_CMP_INS_PF = 'Paketdatei';
public $A_CMP_INS_UFI = "Datei hochladen &amp; installieren";
public $A_CMP_INS_FDIR = 'Installier aus Verzeichnis';
public $A_CMP_INS_IDIR = 'Installationsverzeichnis';
public $A_CMP_INS_DOIN = 'Installieren';
public $A_CMP_INS_CONT = 'Fortsetzen...';
public $A_CMP_INS_NF = 'Installer für dieses Element nicht gefunden ';
public $A_CMP_INS_NA = 'Installer für dieses Element nicht verfügbar';
public $A_CMP_INS_EFU = 'Der Installer kann nicht fortgesetzt werden, so lange bis die Hochladefunktion für Dateien aktiviert wurde. Bitte nutzen sie die Methode Installtion aus einem Verzeichnis.';
public $A_CMP_INS_ERTL = 'Installer - Fehler';
public $A_CMP_INS_ERZL = 'Der Installer kann nicht fortgesetzt werden. Zuerst muss "zlib" installiert sein';
public $A_CMP_INS_ERNF = 'Keine Datei ausgewählt';
public $A_CMP_INS_ERUM = 'Hochladen eines neuen Moduls - Fehler';
public $A_CMP_INS_UPTL = 'Hochladen ';
public $A_CMP_INS_UPE1 = ' - Hochladen fehlgeschlagen';
public $A_CMP_INS_UPE2 = ' -  Fehler beim Hochladen';
public $A_CMP_INS_SUCC = 'Erfolgreich';
public $A_CMP_INS_ER = 'Fehler';
public $A_CMP_INS_ERFL = 'Fehlgeschlagen';
public $A_CMP_INS_UPNW = 'Neu hochladen ';
public $A_CMP_INS_FP = 'Die rechte der hochgeladenen Datei konnten nicht geändert werden.';
public $A_CMP_INS_FM = 'Hochgeladene Datei konnte nicht in den Ordner <code>/media</code> verschoben werden.';
public $A_CMP_INS_FW = 'Hochladen fehlgeschlagen. Der Ordner <code>/media</code> ist nicht beschreibbar.';
public $A_CMP_INS_FE = 'Hochladen fehlgeschlagen. Der Ordner <code>/media</code> existiert nicht.';
public $A_CMP_INST_ERUNR = 'Unkorrigierbarer Fehler';
public $A_CMP_INST_EREXT = 'Fehler beim Entpacken';
public $A_CMP_INST_ERMXM = '<strong>FEHLER:</strong> Konnte keine Elxis XML Setup Datei im Paket finden';
public $A_CMP_INST_ERXML = '<strong>FEHLER:</strong> Konnte keine XML Setup Datei im Paket finden';
public $A_CMP_INST_ERNFN = 'Kein Dateiname spezifiziert';
public $A_CMP_INST_ERVLD = 'ist keine gültige Elxis Installationsdatei';
public $A_CMP_INST_ERINC = 'Die Methode installieren kann nicht aus einer Klasse aufgrufen werden';
public $A_CMP_INST_ERUIC = 'Die Methode deinstallieren kann nicht aus einer Klasse aufgrufen werden';
public $A_CMP_INST_ERIFN = 'Installationsdatei nicht gefunden';
public $A_CMP_INST_ERSXM = 'XML Setup Date ist nicht für ein/eine';
public $A_CMP_INST_ERCDR = 'Verzeichniserstellung fehlgeschlagen';
public $A_CMP_INST_FNOTE = 'existiert nicht!';
public $A_CMP_INST_TAFC = 'Es gibt schon eine Datei mit dem Namen';
public $A_CMP_INST_AYIT = '- Versuchen sie die gleiche CMT zwei mal zu installieren?';
public $A_CMP_INST_FCPF = 'Datei kopieren fehlgeschlagen';
public $A_CMP_INST_CPTO = 'zu';
public $A_CMP_INST_UNINSTALL = 'Deinstallieren';
public $A_CMP_INST_CUDIR = 'Eine andere Komponente benutzt dieses Verzeichnis';
public $A_CMP_INST_SQLER = 'SQL Fehler';
public $A_CMP_INST_CCPHP = 'Kann die PHP Installationsdatei nicht kopieren.';
public $A_CMP_INST_CCUNPHP = 'Kann die PHP Deinstallationsdatei nicht kopieren.';
public $A_CMP_INST_UNERR = 'Deinstallationsfehler';
public $A_CMP_INST_THCOM = 'Komponente';
public $A_CMP_INST_ISCOR = 'ist eine Core Komponente, und kann nicht deinstalliert werden.<br />Sie müssen sie auf unveröffentlicht setzen, wenn sie sie nicht benutzen wollen';
public $A_CMP_INST_XMLINV = 'XML Datei ungültig';
public $A_CMP_INST_OFEMP = 'Optionsfeld ist leer, Dateien können nicht entfernt werden';
public $A_CMP_INST_INCOM = 'Installierte Komponenten';
public $A_CMP_INST_CURRE = 'Aktuell installiert';
public $A_CMP_INST_MENL = 'Komponenten Menü Link';
public $A_CMP_INST_AUURL = 'Autor URL';
public $A_CMP_INST_NCOMP = 'Es sind keine änderbaren Komponenten installiert';
public $A_CMP_INST_INSCO = 'Installiere neue Komponente';
public $A_CMP_INST_DELE = 'Lösche';
public $A_CMP_INST_LIDE = 'Sprach ID ist leer, kann Dateien nicht entfernen';
public $A_CMP_INST_ALL = 'alle';
public $A_CMP_INST_BKLM = 'Zurück zur Sprachverwaltung';
public $A_CMP_INST_NWLA = 'Installiere neue Sprache';
public $A_CMP_INST_NFMM = 'Keine Datei ist als Bot Datei markiert';
public $A_CMP_INST_MAMB = 'bot';
public $A_CMP_INST_AXST = 'existiert schon!';
public $A_CMP_INST_IOID = 'Ungültige Objekt ID';
public $A_CMP_INST_FFEM = 'Ordnerfeld ist leer, kann die Dateien nicht entfernen';
public $A_CMP_INST_DXML = 'Lösche XML Datei';
public $A_CMP_INST_ICMO = 'ist ein Core Element, und kann nicht deinstalliert werden.<br />Sie müssen es auf unveröffentlicht setzen, wenn sie es nicht verwenden wollen';
public $A_CMP_INST_IMBT = 'Installierte Bots';
public $A_CMP_INST_OMBT = 'Es werden nur die Bots angezeigt, die deinstallierbar sind - einige Core Bots können nicht deinstalliert werden.';
public $A_CMP_INST_MBT = 'Bot';
public $A_CMP_INST_MTYP = 'Typ';
public $A_CMP_INST_NMBT = 'Es sind keine nicht-Core Bots / veränderbare Bots installiert.';
public $A_CMP_INST_INMT = 'Installiere neuen Bot';
public $A_CMP_INST_UCTP = 'Unbekannter Kliententyp';
public $A_CMP_INST_NFMD = 'Keine Datei ist als Moduldatei markiert';
public $A_CMP_INST_MODULE = 'Modul';
public $A_CMP_INST_ICMDL = 'ist ein Core Modul und kann nicht deinstalliert werden.<br />Sie müssen es auf unveröffentlicht setzen, wenn sie es nicht verwenden wollen';
public $A_CMP_INST_IMDL = 'Installierte Module';
public $A_CMP_INST_OMDL = 'Es werden nur die Module angezeigt, die deinstallierbar sind - einige Core Module können nicht deinstalliert werden.';
public $A_CMP_INST_MDLF = 'Moduldatei';
public $A_CMP_INST_NMDL = 'Keine veränderbaren Module installiert';
public $A_CMP_INST_NWMDL = 'Installiere neue Module';
public $A_CMP_INST_ALLC = 'Alle';
public $A_CMP_INST_STMDL = 'Seitenmodule';
public $A_CMP_INST_ADMDL = 'Adminmodule';
public $A_CMP_INST_DDEX = 'Verzeicnis existiert nicht, kann Dateien nicht entfernen';
public $A_CMP_INST_TIDE = 'Template ID ist leer, kann Dateien nicht entfernen';
public $A_CMP_INST_TINS = 'Installiere neues Template';
public $A_CMP_INST_BATP = 'Zurück zu Templates';
public $A_CMP_INST_INSBR = 'Installiere neue Bridge';
public $A_CMP_INST_BABR = 'Zurück zu Bridges';
public $A_CMP_INST_ΒIDE = 'Bridge ID ist leer, kann Dateien nicht entfernen';
public $A_INST_INCOM = 'Mögliche Inkompatibilität zwischen der installierten Elxis Version un der installierten Erweiterung entdeckt. 
Unabhängig davon kann es sein, das diese Software funktioniert. Dies ist nur ein Hinweis.';
public $A_INST_INCOMJOO = 'Installationspaket ist für Joomla CMS!';
public $A_INST_INCOMMAM = 'Installationspaket ist für Mambo CMS!';
public $A_INST_OLDER = 'Installationspaket ist für eine ältere Elxis Version (%s) als ihre (%s)';
public $A_INST_NEWER = 'Installationspaket ist für eine neuere Elxis Version (%s) als ihre (%s)';
//2009.0
public $A_INST_DOINEDC = 'Lade es Elxis Downloads Center und installiere es';
public $A_INST_FETCHAVEXTS = 'Übertrage Liste der verfügbaren Erweiterungen';
public $A_INST_MORE = 'mehr';
public $A_INST_LESS = 'weniger';
public $A_INST_SIZE = 'Größe';
public $A_INST_DOWNLOAD = 'Download';
public $A_INST_DOWNLOADS = 'Downloads';
public $A_INST_DOWNINST = 'Download und installieren';
public $A_INST_LICENSE = 'Lizenz';
public $A_INST_COMPAT = 'Kompatibilität';
public $A_INST_DATESUB = 'Veröffentlichungsdatum';
public $A_INST_SUREINST = 'Sind Sie sicher dass sie %s installieren wollen?'; //translators help: filled in be extension title
//2009.2
public $A_INST_UPTODATE = 'Auf dem neusten Stand';
public $A_INST_OUTDATED = 'Veraltet';
public $A_INST_INSTVERS = 'Installierte Version';
public $A_INST_UNLOAD = 'Ausladen';
public $A_INST_EDCUPDESC = 'List of the installed third party extensions and their update status.<br />
	The information is taken live from the <a href="http://www.elxis-downloads.com/" title="EDC" target="_blank">Elxis Downloads Center</a>.<br />
	In order for the versioning check to be successuful your web site must be able to connect to the <strong>EDC</strong> remote center.';
public $A_INST_EDCUPNOR = "Version check returned nothing.<br />
	Most probably you do not have any third party %s installed.";

}

?>