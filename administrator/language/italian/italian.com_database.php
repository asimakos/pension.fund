<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Roberto D Alessio (theprincy)
* @link: http://www.elxis.it
* @email: info@elxis.it
* @description: Italian language for component database
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_DB_TABNM = 'Nome Tabella';
public $A_CMP_DB_ACTIONS = 'Azione';
public $A_CMP_DB_TDESCR = 'Descrizione Tabella';
public $A_CMP_DB_BROWSE = 'Visualizza';
public $A_CMP_DB_STRUCTURE = 'Struttura';
public $A_CMP_DB_INFO = 'Informazioni';
public $A_CMP_DB_DUMPDB = 'Dump Database';
public $A_CMP_DB_XDUMPDB = 'Dump Database XML/SQL  ';
public $A_CMP_DB_BACTYPE = 'Tipo Backup';
public $A_CMP_DB_XML = 'XML';
public $A_CMP_DB_SQL = 'SQL';
public $A_CMP_DB_XCRBACK = 'Crea un file XML di Backup';
public $A_CMP_DB_XFULL = 'Struttura & Data';
public $A_CMP_DB_XSTRUONL = 'Struttura solo';
public $A_CMP_DB_XSAVSERV = 'Salva sul  Server';
public $A_CMP_DB_DOWNLD = 'Download';
public $A_CMP_DB_XMLBACK = 'XML Backup';
public $A_CMP_DB_SCRBACK = 'Crea un file SQL di Backup';
public $A_CMP_DB_SFULL = 'Struttura & Data';
public $A_CMP_DB_SDATAONL = 'Solo Dati';
public $A_CMP_DB_SLOCTBL = 'Lock Tabelle';
public $A_CMP_DB_SFSYNTX = 'Inserimenti estesi';
public $A_CMP_DB_SDRTBL = 'Elimina Tabelle';
public $A_CMP_DB_STBLS = 'Tabelle';
public $A_CMP_DB_ATBLS = 'Tutte';
public $A_CMP_DB_SELTBLS = 'Seleziona';
public $A_CMP_DB_SQLBACK = 'SQL Backup';
public $A_CMP_DB_TDESC = 'Descrizione Tabella';
public $A_CMP_DB_CLNAME = 'Nome Colonna';
public $A_CMP_DB_CLTYPE = 'Tipo Colonna';
public $A_CMP_DB_ADOTYPE = 'Tipo ADOdb';
public $A_CMP_DB_MAXLEN = 'Lunghezza massima di una query creata';
public $A_CMP_DB_BRTBL = 'Torna alla Visualizzazione Tabelle';
public $A_CMP_DB_BCKDB = 'Ritorna al DataBase';
public $A_CMP_DB_DBTYPE = 'Tipo DataBase';
public $A_CMP_DB_DBDESCR = 'Descrizione Database';
public $A_CMP_DB_DBVER = 'Versione Database';
public $A_CMP_DB_DBHOST = 'Host Database';
public $A_CMP_DB_DBNAME = 'Nome Database';
public $A_CMP_DB_DBUSER = 'User';
public $A_CMP_DB_DBERRF = 'Alza errore FN';
public $A_CMP_DB_DBDBG = 'Debug';
public $A_CMP_DB_TBLSTR = 'Struttura Tabella';
public $A_CMP_DB_DBBACK = 'Backup Database';
public $A_CMP_DB_NOEXISTS = 'Nessun database esistente';
public $A_CMP_DB_FOOTER= "<u>Nota</u>: Clicca con il tasto destro un nome file e seleziona 'Salva target come' per il downbload. <u>Attenzione</u>: File sono con codifica UTF-8.";
public $A_CMP_DB_DBMONIT = 'Monitor database';
public $A_CMP_DB_TBLNOT = 'La tabella non esiste!';
public $A_CMP_DB_BACKSUCC = 'Backup database creato con successo';
public $A_CMP_DB_NOTSUPPO = 'SQL Dump non è supportato per';
public $A_CMP_DB_NOTBLSEL = 'Nessuna tabella selezionata!';
public $A_CMP_DB_NOTDWNL = 'Non è possibile creare/download il Dump SQL';
public $A_CMP_DB_NOTCRSV = 'Non è possibile creare/salvare il Dump SQL';
public $A_CMP_DB_DUMPSUCC = 'SQL dump creato con successo';
public $A_CMP_DB_DTUNKN = 'Data Sconosciuta'; // Translate as: Unknown Date
public $A_CMP_DB_TXMLSCHEM = 'XML Schema';
public $A_CMP_DB_TSQL = 'SQL';
public $A_CMP_DB_TUNKN = 'Tipo Sconosciuto'; // Translate as: Unknown Type
public $A_CMP_DB_UNKOWN = 'Dimensione Sconosciuta'; // Translate as: Unknown Size
public $A_CMP_DB_NOFSELDEL = 'Nessun file selezionato per la cancellazione!';
public $A_CMP_DB_FSDELETED = 'File cancellati con successo';
public $A_CMP_DB_FDELETED = 'File cancellato con successo';
public $A_CMP_DB_TLMANBACK = 'Gestione Backups';
public $A_CMP_DB_TLDELSLBCK = 'Elimina Backup selezionato';
public $A_CMP_DB_TLNEWFXML = 'Nuovo Backup XML';
public $A_CMP_DB_TLNEWFSQL = 'Nuovo Backup SQL';
public $A_CMP_DB_MAINTEN = 'Gestione';
public $A_CMP_DB_MAINTEND = 'Gestione Database';
public $A_CMP_DB_OPTIM = 'Ottimizza';
public $A_CMP_DB_REPAIR = 'Ripara';
public $A_CMP_DB_TBLOPTED = 'ottimizza tabelle';
public $A_CMP_DB_FRUOPTINCP = 'L\'uso frequente della <strong>Ottimizzazione </strong>, incrementa la performance del database.';
public $A_CMP_DB_RRERRDBTAB = '<strong>Ripara</strong>, server per riparare errori esistenti nelle tabelle del database.';
public $A_CMP_DB_FAVMYSQL = 'Questa caratteristica è disponibile per MySQL!';
public $A_CMP_DB_TBLREPED = 'ripara tabelle';
public $A_CMP_DB_SIZE = 'Dimensione';

}

?>
