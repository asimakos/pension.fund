<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Siegmund Langsch
* @link: http://www.langschnet.de
* @email: s.langsch@langhscnet.de
* @description: German language for component database
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direkter Zugriff auf diesen Ort ist nicht erlaubt' );


class adminLanguage extends standardLanguage {

public $A_CMP_DB_TABNM = 'Tabellen Name';
public $A_CMP_DB_ACTIONS = 'Aktionen';
public $A_CMP_DB_TDESCR = 'Tabellenbeschreibung';
public $A_CMP_DB_BROWSE = 'Browse';
public $A_CMP_DB_STRUCTURE = 'Struktur';
public $A_CMP_DB_INFO = 'Informationen';
public $A_CMP_DB_DUMPDB = 'Backup Datenbank';
public $A_CMP_DB_XDUMPDB = 'XML/SQL Datenbank Backup';
public $A_CMP_DB_BACTYPE = 'Backup Typ';
public $A_CMP_DB_XML = 'XML';
public $A_CMP_DB_SQL = 'SQL';
public $A_CMP_DB_XCRBACK = 'Erzeuge ein XML Backup';
public $A_CMP_DB_XFULL = 'Struktur &amp; Daten';
public $A_CMP_DB_XSTRUONL = 'Nur Struktur';
public $A_CMP_DB_XSAVSERV = 'Auf Server speichern';
public $A_CMP_DB_DOWNLD = 'Herunterladen';
public $A_CMP_DB_XMLBACK = 'XML Backup';
public $A_CMP_DB_SCRBACK = 'Erzeuge ein SQL Backup';
public $A_CMP_DB_SFULL = 'Struktur &amp; Daten';
public $A_CMP_DB_SDATAONL = 'Nur Daten';
public $A_CMP_DB_SLOCTBL = 'Sperre Tabelle';
public $A_CMP_DB_SFSYNTX = 'Volle Syntax';
public $A_CMP_DB_SDRTBL = 'Lösche Tabelle';
public $A_CMP_DB_STBLS = 'Tabellen';
public $A_CMP_DB_ATBLS = 'Alle';
public $A_CMP_DB_SELTBLS = 'Gewählte';
public $A_CMP_DB_SQLBACK = 'SQL Backup';
public $A_CMP_DB_TDESC = 'Tabellen Beschreibung';
public $A_CMP_DB_CLNAME = 'Spalten Name';
public $A_CMP_DB_CLTYPE = 'Spalten Typ';
public $A_CMP_DB_ADOTYPE = 'ADOdb Typ';
public $A_CMP_DB_MAXLEN = 'Maximale Länge';
public $A_CMP_DB_BRTBL = 'Browse Tabelle';
public $A_CMP_DB_BCKDB = 'Zurück zur Datenbank';
public $A_CMP_DB_DBTYPE = 'Datenbank Typ';
public $A_CMP_DB_DBDESCR = 'Datenbank Beschreibung';
public $A_CMP_DB_DBVER = 'Datenbank Version';
public $A_CMP_DB_DBHOST = 'Datenbank Host';
public $A_CMP_DB_DBNAME = 'Datenbank Name';
public $A_CMP_DB_DBUSER = 'Benutzer';
public $A_CMP_DB_DBERRF = 'Erhebe Fehler FN';
public $A_CMP_DB_DBDBG = 'Debug';
public $A_CMP_DB_TBLSTR = 'Tabellen Struktur';
public $A_CMP_DB_DBBACK = 'Datenbank Backup';
public $A_CMP_DB_NOEXISTS = 'Es existiert kein Backup';
public $A_CMP_DB_FOOTER= "<u>Hinweis</u>: Klicken sie mit der rechten Maustaste auf einen Dateinamen und wählen sie 'Ziel speichern unter'um eine Datei herunterzuladen. <strong>Achtung</strong>: Dateien sind UTF-8 kodiert.";
public $A_CMP_DB_DBMONIT = 'Datenbank Monitor';
public $A_CMP_DB_TBLNOT = 'Tabelle existiert nicht!';
public $A_CMP_DB_BACKSUCC = 'Datenbank Backup erfolgreich erstellt';
public $A_CMP_DB_NOTSUPPO = 'SQL Backup nicht unterstütz';
public $A_CMP_DB_NOTBLSEL = 'Keine Tabelle gewählt!';
public $A_CMP_DB_NOTDWNL = 'Kann SQL Backup nicht erstellen/herunterladen';
public $A_CMP_DB_NOTCRSV = 'Kann SQL Backup nicht erstellen/speichern';
public $A_CMP_DB_DUMPSUCC = 'SQL Backup erfolgreich erstellt';
public $A_CMP_DB_DTUNKN = 'Unbekanntes Datum'; // Translate as: Unknown Date
public $A_CMP_DB_TXMLSCHEM = 'XML Schema';
public $A_CMP_DB_TSQL = 'SQL';
public $A_CMP_DB_TUNKN = 'Unbekannter Typ'; // Translate as: Unknown Type
public $A_CMP_DB_UNKOWN = 'Unbekannte Größe'; // Translate as: Unknown Size
public $A_CMP_DB_NOFSELDEL = 'Keine Datei zum Löschen gewählt!';
public $A_CMP_DB_FSDELETED = 'Dateien erfolgreich gelöscht';
public $A_CMP_DB_FDELETED = 'Datei erfolgreich gelöscht';
public $A_CMP_DB_TLMANBACK = 'Verwalte Backups';
public $A_CMP_DB_TLDELSLBCK = 'Lösche gewählte Backups';
public $A_CMP_DB_TLNEWFXML = 'Neues volles XML Backup';
public $A_CMP_DB_TLNEWFSQL = 'Neues volles SQL Backup';
public $A_CMP_DB_MAINTEN = 'Wartung';
public $A_CMP_DB_MAINTEND = 'Datenbankwartung';
public $A_CMP_DB_OPTIM = 'Optimiere';
public $A_CMP_DB_REPAIR = 'Repariere';
public $A_CMP_DB_TBLOPTED = 'Tabellen optimiert';
public $A_CMP_DB_FRUOPTINCP = 'Regelmäßige Verwendung der Funktion<strong>optimieren</strong>, verbessert die Datenbankleistung.';
public $A_CMP_DB_RRERRDBTAB = '<strong>Reparieren</strong>, repariert alle existierenden Fehler in Datanbank-Tabellen.';
public $A_CMP_DB_FAVMYSQL = 'Diese Funktion ist nur für MySQL Datenbanken verfügbar!';
public $A_CMP_DB_TBLREPED = 'Tabellen repariert';
public $A_CMP_DB_SIZE = 'Größe';

}

?>
