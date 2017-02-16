<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: PARACOM Software
* @link: http://www.elxis.cz
* @email: info@elxis.cz
* @description: Czech language for component database
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_DB_TABNM = 'Jméno tabulky';
public $A_CMP_DB_ACTIONS = 'Akce';
public $A_CMP_DB_TDESCR = 'Popis tabulky';
public $A_CMP_DB_BROWSE = 'Procházet';
public $A_CMP_DB_STRUCTURE = 'Struktura';
public $A_CMP_DB_INFO = 'Informace';
public $A_CMP_DB_DUMPDB = 'Záloha databáze';
public $A_CMP_DB_XDUMPDB = 'XML/SQL záloha databáze';
public $A_CMP_DB_BACTYPE = 'Typ zálohy';
public $A_CMP_DB_XML = 'XML';
public $A_CMP_DB_SQL = 'SQL';
public $A_CMP_DB_XCRBACK = 'Vytvořit XML zálohu';
public $A_CMP_DB_XFULL = 'Struktura &amp; data';
public $A_CMP_DB_XSTRUONL = 'Jen struktura';
public $A_CMP_DB_XSAVSERV = 'Uložit na server   ';
public $A_CMP_DB_DOWNLD = 'Stáhnout';
public $A_CMP_DB_XMLBACK = 'XML záloha';
public $A_CMP_DB_SCRBACK = 'Vytvořit SQL zálohu';
public $A_CMP_DB_SFULL = 'Struktura &amp; data';
public $A_CMP_DB_SDATAONL = 'Jen data';
public $A_CMP_DB_SLOCTBL = 'Zámek tabulky';
public $A_CMP_DB_SFSYNTX = 'Celá Syntaxe';
public $A_CMP_DB_SDRTBL = 'Výpis tabulky';
public $A_CMP_DB_STBLS = 'Tabulky';
public $A_CMP_DB_ATBLS = 'Vše';
public $A_CMP_DB_SELTBLS = 'Zvolené';
public $A_CMP_DB_SQLBACK = 'SQL Záloha';
public $A_CMP_DB_TDESC = 'Popis tabulky';
public $A_CMP_DB_CLNAME = 'Jméno sloupce';
public $A_CMP_DB_CLTYPE = 'Typ sloupce';
public $A_CMP_DB_ADOTYPE = 'ADOdb Typ';
public $A_CMP_DB_MAXLEN = 'Max. délka';
public $A_CMP_DB_BRTBL = 'Procházet tabulky';
public $A_CMP_DB_BCKDB = 'Zpět k databázi';
public $A_CMP_DB_DBTYPE = 'Typ databáze';
public $A_CMP_DB_DBDESCR = 'Popis databáze';
public $A_CMP_DB_DBVER = 'Verze databáze';
public $A_CMP_DB_DBHOST = 'Hostitel DB';
public $A_CMP_DB_DBNAME = 'Jméno DB';
public $A_CMP_DB_DBUSER = 'Uživatel DB';
public $A_CMP_DB_DBERRF = 'Raise Error FN';
public $A_CMP_DB_DBDBG = 'Odladit';
public $A_CMP_DB_TBLSTR = 'Struktura tabulky';
public $A_CMP_DB_DBBACK = 'Zálohy databáze';
public $A_CMP_DB_NOEXISTS = 'Žádná záloha';
public $A_CMP_DB_FOOTER= "<u>Nápověda</u>: Pro stažení klikněte pravým tlačítkem na jméno souboru a zvolte 'Uložit odkaz jako...'. <strong>Upozornění</strong>: Soubory jsou kódvány v UTF-8.";
public $A_CMP_DB_DBMONIT = 'Monitor databáze';
public $A_CMP_DB_TBLNOT = 'Tabulka neexistuje!';
public $A_CMP_DB_BACKSUCC = 'Záloha databáze úspěšně vytvořena';
public $A_CMP_DB_NOTSUPPO = 'SQL výpis není podporován pro';
public $A_CMP_DB_NOTBLSEL = 'Není zvolena tabulka!';
public $A_CMP_DB_NOTDWNL = 'Nelze vytvořit/stáhnout SQL výpis';
public $A_CMP_DB_NOTCRSV = 'Nelze vytvořit/uložit SQL výpis';
public $A_CMP_DB_DUMPSUCC = 'SQL výpis úspěšně vytvořen';
public $A_CMP_DB_DTUNKN = 'Neznámé'; // Translate as: Unknown Date
public $A_CMP_DB_TXMLSCHEM = 'XML Schéma';
public $A_CMP_DB_TSQL = 'SQL';
public $A_CMP_DB_TUNKN = 'Neznámý'; // Translate as: Unknown Type
public $A_CMP_DB_UNKOWN = 'Neznámá'; // Translate as: Unknown Size
public $A_CMP_DB_NOFSELDEL = 'Není zvolen soubor pro smazání!';
public $A_CMP_DB_FSDELETED = 'soubory úspěšně smazány';
public $A_CMP_DB_FDELETED = 'Soubor úspěšně smazán';
public $A_CMP_DB_TLMANBACK = 'Správa záloh';
public $A_CMP_DB_TLDELSLBCK = 'Smazat zvolené zálohy';
public $A_CMP_DB_TLNEWFXML = 'Nová XML záloha';
public $A_CMP_DB_TLNEWFSQL = 'Nová SQL záloha';
public $A_CMP_DB_MAINTEN = 'Údržba';
public $A_CMP_DB_MAINTEND = 'Údržba databáze';
public $A_CMP_DB_OPTIM = 'Optimalizace';
public $A_CMP_DB_REPAIR = 'Oprava';
public $A_CMP_DB_TBLOPTED = 'tabulek optimalizováno';
public $A_CMP_DB_FRUOPTINCP = 'Pravidelné použití <strong>optimalizace</strong>, zvýší výkon databáze.';
public $A_CMP_DB_RRERRDBTAB = '<strong>Oprava</strong> - vyřeší chyby v tabulkách databáze.';
public $A_CMP_DB_FAVMYSQL = 'Tato funkce je dostupná pouze pro MySQL databáze!';
public $A_CMP_DB_TBLREPED = 'tabulek opraveno';
public $A_CMP_DB_SIZE = 'Velikost';

}

?>