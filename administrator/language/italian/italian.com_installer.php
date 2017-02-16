<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Roberto D Alessio (theprincy), Francesco Venuti (Amigamerlin)
* @link: http://www.pcbsd.it
* @email: amigamerlin@gmail.com
* @description: Italian language for component installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_INS_SDIR = 'Per favore seleziona una cartella';
public $A_CMP_INS_UPF = 'Carica file compresso';
public $A_CMP_INS_PF = 'File compresso';
public $A_CMP_INS_UFI = "Carica File e Installa";
public $A_CMP_INS_FDIR = 'Installa dalla cartella....';
public $A_CMP_INS_IDIR = 'Cartella di Installazione';
public $A_CMP_INS_DOIN = 'Installa';
public $A_CMP_INS_CONT = 'Continua ...';
public $A_CMP_INS_NF = "Installazione non trovato per l&#8217;elemento ";
public $A_CMP_INS_NA = "Installazione non disponibile per l&#8217;elemento";
public $A_CMP_INS_EFU = "L&#8217;installazione non può continuare prima che il caricamento file sia abilitato. Per favore usa il metodo di installazione da cartella.";
public $A_CMP_INS_ERTL = 'Errore dell&#8217;Installazione';
public $A_CMP_INS_ERZL = "L&#8217;installazione non può continuare prima che la zlib sia installata";
public $A_CMP_INS_ERNF = 'Nessun file selezionato';
public $A_CMP_INS_ERUM = 'Invio di un nuovo modulo - errore';
public $A_CMP_INS_UPTL = 'Carica';
public $A_CMP_INS_UPE1 = ' - Upload Fallito';
public $A_CMP_INS_UPE2 = ' -  Errore Upload';
public $A_CMP_INS_SUCC = 'Successo';
public $A_CMP_INS_ER = 'Errore';
public $A_CMP_INS_ERFL = 'Fallito';
public $A_CMP_INS_UPNW = 'Carica nuovo ';
public $A_CMP_INS_FP = 'Fallito il cambiamento dei permessi del file caricato.';
public $A_CMP_INS_FM = 'Fallito lo spostamento del file caricato nella cartella <code>/media</code>.';
public $A_CMP_INS_FW = 'Caricamento fallito poiché la cartella <code>/media</code> non è scrivibile.';
public $A_CMP_INS_FE = 'Caricamento fallito poiché la cartella <code>/media</code> non esiste.';
public $A_CMP_INST_ERUNR = 'Errore irreversibile';
public $A_CMP_INST_EREXT = 'Errore nella scompattazione de file';
public $A_CMP_INST_ERMXM = 'ERROR: Non è possibile trovare il file XML di Elxis nel pacchetto';
public $A_CMP_INST_ERXML = 'ERRORE: Non è possibile trovare il file di installazione nel pacchetto';
public $A_CMP_INST_ERNFN = 'No filename specified';
public $A_CMP_INST_ERVLD = 'non è un file di installazione valido per Elxis';
public $A_CMP_INST_ERINC = 'Il metodo di installazione non può essere chiamata tramite la classe';
public $A_CMP_INST_ERUIC = 'Il metodo disinstallazione non può essere chiamata tramite la classe';
public $A_CMP_INST_ERIFN = 'Installazione non trovata';
public $A_CMP_INST_ERSXM = 'Il file XML non è un ';
public $A_CMP_INST_ERCDR = 'Errore nella creazione della cartella';
public $A_CMP_INST_FNOTE = 'non esiste!';
public $A_CMP_INST_TAFC = 'Esiste già un file chiamato';
public $A_CMP_INST_AYIT = '- Stai installando due volte lo stesso CMT?';
public $A_CMP_INST_FCPF = 'Impossibile copiare file';
public $A_CMP_INST_CPTO = 'in';
public $A_CMP_INST_UNINSTALL = 'Disinstalla';
public $A_CMP_INST_CUDIR = 'Un altro componente sta usando al cartella';
public $A_CMP_INST_SQLER = 'Errore SQL ';
public $A_CMP_INST_CCPHP = 'Impossibile copiare il file PHP di installazione.';
public $A_CMP_INST_CCUNPHP = 'Impossibile copiare il file di PHP di disinstallazione.';
public $A_CMP_INST_UNERR = 'Disinstallazione -  errore';
public $A_CMP_INST_THCOM = 'Componente';
public $A_CMP_INST_ISCOR = 'è un componente del core, e non può essere disinstallato.<br />Tu puoi solo renderlo non pubblicato se non lo vuoi usare';
public $A_CMP_INST_XMLINV = 'File XML invalido';
public $A_CMP_INST_OFEMP = 'Campo opzione vuota, impossibile rimuovere i file';
public $A_CMP_INST_INCOM = 'Componente Installato';
public $A_CMP_INST_CURRE = 'Attualmente Installati';
public $A_CMP_INST_MENL = 'Percorso per il componente';
public $A_CMP_INST_AUURL = 'URL Autore';
public $A_CMP_INST_NCOMP = 'Non ci sono componenti personalizzati installati';
public $A_CMP_INST_INSCO = 'Installa nuovo componente';
public $A_CMP_INST_DELE = 'Cancellazione in corso';
public $A_CMP_INST_LIDE = 'L&#8217;id di Lingua è vuoto, impossibile rimuovere i file';
public $A_CMP_INST_ALL = 'tutti';
public $A_CMP_INST_BKLM = 'Ritorna alla gestioen Lingua';
public $A_CMP_INST_NWLA = 'Installa una nuova lingua';
public $A_CMP_INST_NFMM = 'Nessun file selezionato è un mambots';
public $A_CMP_INST_MAMB = 'Mambot';
public $A_CMP_INST_AXST = 'esiste già!';
public $A_CMP_INST_IOID = 'ID Oggetto non valido';
public $A_CMP_INST_FFEM = 'Campo cartella vuoto, impossibile rimuovere i file';
public $A_CMP_INST_DXML = 'Cancellazione File XML';
public $A_CMP_INST_ICMO = 'è un componente del core, e non può essere disinstallato.<br />Tu puoi solo renderlo non pubblicato se non lo vuoi usare';
public $A_CMP_INST_IMBT = 'Mambots installato';
public $A_CMP_INST_OMBT = 'Sono visualizzati solo quei Mambots che possono essere disinstallati - alcuni Mambots fondamentali non possono essere rimossi';
public $A_CMP_INST_MBT = 'Mambot';
public $A_CMP_INST_MTYP = 'Tipo';
public $A_CMP_INST_NMBT = 'Non ci sono altri mambots personalizzati installati.';
public $A_CMP_INST_INMT = 'Installa nuovi Mambots';
public $A_CMP_INST_UCTP = 'Tipo client sconosciuto';
public $A_CMP_INST_NFMD = 'Nessun file selezionato è un modulo';
public $A_CMP_INST_MODULE = 'Modulo';
public $A_CMP_INST_ICMDL = 'è un componente del core, e non può essere disinstallato.<br />Tu puoi solo renderlo non pubblicato se non lo vuoi usare';
public $A_CMP_INST_IMDL = 'Modulo Installato';
public $A_CMP_INST_OMDL = 'Alcuni di questi moduli ch evedi non posso essere disinstallati fanno parte del Core.';
public $A_CMP_INST_MDLF = 'Module File';
public $A_CMP_INST_NMDL =  'Non ci sono altri moduli personalizzati installati';
public $A_CMP_INST_NWMDL = 'Installa un nuovo Modulo';
public $A_CMP_INST_ALLC = 'Tutti';
public $A_CMP_INST_STMDL = 'Moduli sito';
public $A_CMP_INST_ADMDL = 'Moduli admin';
public $A_CMP_INST_DDEX = 'La cartella non esiste, impossibile rimuovere i file';
public $A_CMP_INST_TIDE = 'Id Template è vuoto, impossibile rimuovere i file';
public $A_CMP_INST_TINS = 'Installa un nuovo template';
public $A_CMP_INST_BATP = 'Ritorna ai template';
public $A_CMP_INST_INSBR = 'Installa un nuovo Bridge';
public $A_CMP_INST_BABR = 'Ritorna ai Bridges';
public $A_CMP_INST_ΒIDE = 'ID bridge è vuoto, impossibile rimuovere i file';
public $A_INST_INCOM = 'è stato trovato una possibile incompatibilità tra la versione in uso di Elxis e l\'estensione installata.
Oltre a questo, il software può lavorare bene e senza errori. Questa è solo una notifica.';
public $A_INST_INCOMJOO = 'Il pacchetto di installazione è per il CMS Joomla!';
public $A_INST_INCOMMAM = 'Il pacchetto di installazione è per il CMS Mambo!';
public $A_INST_OLDER = 'Il pacchetto di installazione è per la versione di Elxis (%s) mentre la vostra è  (%s)';
public $A_INST_NEWER = 'Il pacchetto di installazione è per la versione di Elxis  (%s) mentre la vostra è (%s)';
//2009.0
public $A_INST_DOINEDC = 'Scarica ed installa dal Downloads Center di Elxis';
public $A_INST_FETCHAVEXTS = 'Recupera la lista delle estensioni disponibili';
public $A_INST_MORE = 'Maggiore';
public $A_INST_LESS = 'Minore';
public $A_INST_SIZE = 'Dimensioni';
public $A_INST_DOWNLOAD = 'Download';
public $A_INST_DOWNLOADS = 'Downloads';
public $A_INST_DOWNINST = 'Scarica ed installa';
public $A_INST_LICENSE = 'Licenza';
public $A_INST_COMPAT = 'Compatibilità';
public $A_INST_DATESUB = 'Data inserimento';
public $A_INST_SUREINST = 'Sei sicuro di voler installare %s ?'; //translators help: filled in be extension title
//2009.2
public $A_INST_UPTODATE = 'Attuale';
public $A_INST_OUTDATED = 'Antiquato';
public $A_INST_INSTVERS = 'Versione installata';
public $A_INST_UNLOAD = 'Scaricare';
public $A_INST_EDCUPDESC = 'Lista  delle estesioni di terze parti installate e loro stato di aggiornamento.<br />
	Le informazioni sono presi direttamente da <a href="http://www.elxis-downloads.com/" title="EDC" target="_blank">Elxis Downloads Center</a>.<br />
	Per effetturare il  controllo delle versioni installate, il vostro sito web deve essere in grado di connettersi al centro remoto<strong>EDC</strong>.';
public $A_INST_EDCUPNOR = "Controllo versione restituito nulla.<br />
	Molto probabilmente non hai nessuna estensione di terze parti %s installate.";

}

?>