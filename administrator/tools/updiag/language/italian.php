<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Elxis Team
* @translator: Duilio Lupini (Speck)
* @link: http://www.elxisitalia.com
* @email: info@elxisitalia.com
* @description: Italian language for Updiag tool
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Accesso Limitato' );


class updiagLang {

	public $UPDATE = 'Aggiorna';
	public $CHVERS = 'Controllo Versione';
	public $CNOTGETELXD = 'Non puoi prelevare dati elxis.org';
	public $INVXML = 'Trovato un file XML non valido. Non posso visualizzare le informazioni richieste.';
	public $SIZE = 'Lunghezza';
	public $MORE = 'Più';
	public $DOWNLOAD = 'Scarica';
	public $INSELXVER = 'Versione di Elxis CMS installata';
	public $CURRENT = 'Corrente';
	public $OUTDATED = 'Scaduta!';
	public $NEWVERAV = 'C\'è una nuova versione di Elxis disponibule. Per favore eseguite l\'aggiornamento del vostro Elxis il prima possibile.';
	public $CHPATCHES = 'Controllo per le Patches';
	public $NOPATCHES = 'Non ci sono Patches disponibili per la vostra versione di Elxis';
	public $PROSUPPORT = 'Supporto Professionale';
	public $NEWS = 'News';
	public $MAINTENANCE = 'Manutenzione';
	public $REMOTEERR1 = 'Richiesta non valida';
	public $REMOTEERR2 = 'Non posso prendere l\'elenco degli script';
	public $REMOTEERR3 = 'Script non trovati';
	public $REMOTEERR4 = 'La richiesta file è vuota';
	public $REMOTEERR5 = 'Non posso prendere l\'elenco dei Files \'hash\'';
	public $REMOTEERR6 = 'Files \'hash\' non trovati';
	public $REMOTEERR7 = 'Non posso scaricare il file richiesto!';
	public $UNERROR = 'Errore sconosciuto';
	public $PROVCODE = 'Fornisci il codice per aggiornare Elxis dalla versione';
	public $TOVERSION = 'alla versione';
	public $INSTALLED = 'Installato';
	public $REQFEXISTS = 'File richiesto già presente!';
	public $FILDOWNSUC = 'File scaricato con successo!';
	public $DFORRUNSCR = 'Non dimenticate di lanciare questo script nel caso desiderate aggiornare l\'installazione del vostro Elxis.';
	public $CNOTCPDFIL = 'Non posso copiare il file scaricato nella cartella di destinazione.';
	public $PLCHSCRPERM = 'Per favore controllare i permessi della cartella /administrator/tools/updiag/data/scripts';
	public $PLCHSCRPERM2 = 'Per favore controllare i permessi della cartella /administrator/tools/updiag/data/hashes';
	public $EXECUTE = 'Esegui';
	public $SCRNOTEX = 'Lo script richiesto non esiste!';
	public $FSCHECK = 'Controllare filesystem';
	public $HIDEHELP = 'Nascondi help';
	public $NORMAL = 'Normale';
	public $EXTENDED = 'Esteso';
	public $FULL = 'Pieno';
	public $NOHASHFOUND = 'Nessun file \'hash\' trovato';
	public $INVHFILE = 'File \'hash\' non valido!';
	public $SHFELXVER = 'Il file \'hash\' selezionato è per una versione precedente alla vostra!';
	public $FNOTEXIST = 'File non esiste';
	public $WARNING = 'AVVERTIMENTO';
	public $FNEEDUP = 'Il file deve essere aggiornato';
	public $SITUP2D = 'Versione Sito scaduta!';
	public $FOUND = 'Trovati';
	public $OUTFUP = 'file scaduti. Per favore eseguite l\'aggiornamentooutdated files!';
	public $CHFINUS = 'Controllo stato dell\'aggiornamento del sito usando <b>%s</b> come sorgente';
	public $NEWRELEASES = 'Nuova Versione';
	public $NONEWREL = 'Non ci sono nuove versioni';
	public $PRICE = 'Prezzo';
	public $LICENSE = 'Licenza';
	public $SECURITY = 'Sicurezza';
	public $INSTPATH = 'Path di installazione';
	public $CREDITS = 'Crediti';
	public $ALERT = 'Allarme';
	public $FSECALWA = 'Trovati <b>%d</b> allarmi di sicurezza e avvertimenti';
	public $ELXINPAS = 'La vostra installazione di Elxis ha passato il controllo base di sicurezza';
	public $HOME = 'Home';
	public $UPDSPAG = 'Updiag Central';
	public $UPDWELC = 'Benvenuto in <b>Updiag</b>, il tool di aggiornamento e di diagnostica di Elxis CMS.';
	public $STARTMORE = 'La maggior parte di funzioni di Updiag richiede il collegamento remoto ad elxis.org website. 
	Dovete avere una connessione aperta dal vostro sito a internet per far lavorare queste funzioni. 
	Selezionate una voce dal top menù per navigare.';
	public $BASCHECKS = 'Controllo Base <small>(Cliccare su una icona per egeuirlo)</small>';
	public $FILEREMSUC = 'FIle rimosso con successo!';
	public $CNREMSFILE = 'Non posso rimuovere il file selezionato! Controlla i permessi del file.';
	public $HASHNOTEX = 'Il File \'hash\' richiesto non esiste!';
	public $DNHASHFLS = 'Scarica file \'hash\'';
	public $BUY = 'Acquista';
	public $DOWNLTIME = 'Tempo di download';
	public $DOWNLSPEED = 'Velocità di download';


	public function __construct() {
	}

}

define('CX_LUPDIAGD', 'Vi aiuta ad aggiornare il vostro sito, notificandovi nuove versioni di Elxis e patches, e fornisce tasks di sicuerzza e diagnostica.');

?>