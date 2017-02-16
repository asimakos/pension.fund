<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Frank Gijsels
* @link: http://elxis.onsnet.be
* @email: elxis@onsnet.be
* @description: Dutch language for component database
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_DB_TABNM = 'Tabel Naam';
public $A_CMP_DB_ACTIONS = 'Acties';
public $A_CMP_DB_TDESCR = 'Tabel Omschrijving';
public $A_CMP_DB_BROWSE = 'Bladeren';
public $A_CMP_DB_STRUCTURE = 'Structuur';
public $A_CMP_DB_INFO = 'Informatie';
public $A_CMP_DB_DUMPDB = 'Verwijder Database';
public $A_CMP_DB_XDUMPDB = 'XML/SQL Database Verwijderen';
public $A_CMP_DB_BACTYPE = 'Back-up Type';
public $A_CMP_DB_XML = 'XML';
public $A_CMP_DB_SQL = 'SQL';
public $A_CMP_DB_XCRBACK = 'Maak een XML Back-up';
public $A_CMP_DB_XFULL = 'Structuur &amp; Data';
public $A_CMP_DB_XSTRUONL = 'Enkel Structuur';
public $A_CMP_DB_XSAVSERV = 'Opslaan op de Server';
public $A_CMP_DB_DOWNLD = 'Download';
public $A_CMP_DB_XMLBACK = 'XML Back-up';
public $A_CMP_DB_SCRBACK = 'Maak een SQL Back-up';
public $A_CMP_DB_SFULL = 'Structuur en Data';
public $A_CMP_DB_SDATAONL = 'Enkel Data';
public $A_CMP_DB_SLOCTBL = 'Lock Tabel';
public $A_CMP_DB_SFSYNTX = 'Volledige Syntax';
public $A_CMP_DB_SDRTBL = 'Verwijder Tabel';
public $A_CMP_DB_STBLS = 'Tabellen';
public $A_CMP_DB_ATBLS = 'Alle';
public $A_CMP_DB_SELTBLS = 'Geselecteerde';
public $A_CMP_DB_SQLBACK = 'SQL Back-up';
public $A_CMP_DB_TDESC = 'Tabel Omschrijving';
public $A_CMP_DB_CLNAME = 'Kolom Naam';
public $A_CMP_DB_CLTYPE = 'Kolom Type';
public $A_CMP_DB_ADOTYPE = 'ADOdb Type';
public $A_CMP_DB_MAXLEN = 'Maximum Lengte';
public $A_CMP_DB_BRTBL = 'Bladeren in Tabel';
public $A_CMP_DB_BCKDB = 'Terug naar DataBase';
public $A_CMP_DB_DBTYPE = 'DataBase Type';
public $A_CMP_DB_DBDESCR = 'Database Omschrijving';
public $A_CMP_DB_DBVER = 'Database Versie';
public $A_CMP_DB_DBHOST = 'Database Host';
public $A_CMP_DB_DBNAME = 'Database Naam';
public $A_CMP_DB_DBUSER = 'Gebruiker';
public $A_CMP_DB_DBERRF = 'Raise Error FN';
public $A_CMP_DB_DBDBG = 'Debug';
public $A_CMP_DB_TBLSTR = 'Tabel Structuur';
public $A_CMP_DB_DBBACK = 'Database Back-up';
public $A_CMP_DB_NOEXISTS = 'Er bestaan geen Back-ups';
public $A_CMP_DB_FOOTER= '<u>Nota</u>: Rechts-klik een bestandsnaam en selecteer "Doel opslaan als" om te downloaden. <strong>Opgelet</strong>: Bestanden zijn UTF-8 gecodeerd.';
public $A_CMP_DB_DBMONIT = 'Database Monitor';
public $A_CMP_DB_TBLNOT = 'Tabel bestaat niet!';
public $A_CMP_DB_BACKSUCC = 'Database back-up succesvol gemaakt';
public $A_CMP_DB_NOTSUPPO = 'SQL Dump is niet ondersteund voor';
public $A_CMP_DB_NOTBLSEL = 'Geen tabel geselecteerd!';
public $A_CMP_DB_NOTDWNL = 'Kon geen SQL Dump maken/downloaden';
public $A_CMP_DB_NOTCRSV = 'Kon geen SQL Dump maken/opslaan';
public $A_CMP_DB_DUMPSUCC = 'SQL dump is succesvol gemaakt';
public $A_CMP_DB_DTUNKN = 'Onbekend'; // Translate as: Unknown Date
public $A_CMP_DB_TXMLSCHEM = 'XML Schema';
public $A_CMP_DB_TSQL = 'SQL';
public $A_CMP_DB_TUNKN = 'Onbekend'; // Translate as: Unknown Type
public $A_CMP_DB_UNKOWN = 'Onbekend'; // Translate as: Unknown Size
public $A_CMP_DB_NOFSELDEL = 'Geen bestand geselecteerd om te verwijderen!';
public $A_CMP_DB_FSDELETED = 'Bestanden succesvol verwijderd';
public $A_CMP_DB_FDELETED = 'Bestand succesvol verwijderd';
public $A_CMP_DB_TLMANBACK = 'Beheer Back-ups';
public $A_CMP_DB_TLDELSLBCK = 'Verwijder geselecteerde Back-ups';
public $A_CMP_DB_TLNEWFXML = 'Nieuwe Volledige XML Back-up';
public $A_CMP_DB_TLNEWFSQL = 'Nieuwe Volledige SQL Back-up';
public $A_CMP_DB_MAINTEN = 'Onderhoud';
public $A_CMP_DB_MAINTEND = 'Database Onderhoud';
public $A_CMP_DB_OPTIM = 'Optimaliseren';
public $A_CMP_DB_REPAIR = 'Herstellen';
public $A_CMP_DB_TBLOPTED = 'tabel geoptimaliseerd';
public $A_CMP_DB_FRUOPTINCP = 'Veelvuldig gebruik van <strong>optimaliseren</strong>, verbeterd de database snelheid.';
public $A_CMP_DB_RRERRDBTAB = '<strong>Herstellen</strong>, hersteld alle fouten in de tabellen.';
public $A_CMP_DB_FAVMYSQL = 'Dit onderdeel is enkel voor MySQL databases!';
public $A_CMP_DB_TBLREPED = 'tabellen hersteld';
public $A_CMP_DB_SIZE = 'Grootte';

}

?>