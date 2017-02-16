<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Roberto D Alessio (theprincy), Francesco Venuti (Amigamerlin)
* @link: http://www.pcbsd.it
* @email: amigamerlin@gmail.com
* @description: Italian language for component config
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

	
class adminLanguage extends standardLanguage {

	public $A_COMP_CONF_OFFLINE = 'Sito Offline';
	public $A_COMP_CONF_OFFMESSAGE = 'Messaggio Offline';
	public $A_COMP_CONF_TIP_OFFMESSAGE = 'Messaggio che viene visualizzato se il tuo sito non è in linea';
	public $A_COMP_CONF_ERR_MESSAGE = 'Messaggio di errore di sistemae';
	public $A_COMP_CONF_TIP_ERR_MESSAGE = 'Messaggio che viene visualizzato se Elxis non riesce a connettersi al database';
	public $A_COMP_CONF_SITE_NAME = 'Nome del sito';
	public $A_COMP_CONF_UN_LINKS = 'Mostra collegamenti non autorizzati';
	public $A_COMP_CONF_UN_TIP = 'Se SI, mostrerà i collegamenti ai contenuti riservati agli utenti registrati, anche senza essere identificati.  Gli utenti avranno bisogno  di identificarsi per vedere l&#8217;intero articolo.';
	public $A_COMP_CONF_USER_REG = 'Permetti Registrazione Utente';
	public $A_COMP_CONF_TIP_USER_REG = 'Se SI permette agli utenti di auto registrarsi';
	public $A_COMP_CONF_REQ_EMAIL = 'Richiedi e-mail univoca';
	public $A_COMP_CONF_REQTIP = 'Se SI, ad ogni indirizzo email potrà essere associato un solo utente';
	public $A_COMP_CONF_DEBUG = 'Debug Sito';
	public $A_COMP_CONF_DEBTIP = 'Se SI, mostra informazioni ed errori SQL, se presenti';
	public $A_COMP_CONF_EDITOR = 'Editor WYSIWYG';
	public $A_COMP_CONF_LENGTH = 'Lunghezza Elenco';
	public $A_COMP_CONF_LENTIP = 'Configura la lunghezza predefinita degli elenchi, per tutti gli utenti';
	public $A_COMP_CONF_FAV_ICON = 'Icona preferita del sito';
	public $A_COMP_CONF_FAVTIP = 'Se lasciata in bianco o il file non viene trovato, sarà usata l&#8217;icona favicon.ico.';
	public $A_COMP_CONF_CLINKACC = 'Componente lincato con il sistema di accesso';
	public $A_COMP_CONF_CLACCDESC = 'Selezioan il tipo di componente che vuoi far gestire dal sistema di controllo di accessi nel  frontend (ACO value = view). Se non sei sicuro di quello che fai leggi la guida.';
	public $A_COMP_CONF_CORECOMPS = 'Core';
	public $A_COMP_CONF_3RDCOMPS = 'Componenti terze parti';
	public $A_COMP_CONF_ALLCOMPS = 'Tutti i componenti';
	public $A_COMP_CONF_CAPTCHA = 'Usa immagine di sicurezza';
	public $A_COMP_CONF_CAPTCHATIP = 'Si, se vuoi che immagine di sicurezza (Captcha) venga visualizzata nei moduli del sito. E\' disponibile anche una voce per gli utenti con difficolta visive.';
	public $A_COMP_CONF_LOCALE = 'Locale';
	public $A_COMP_CONF_LANG = 'Lingua Sito Pubblico';
	public $A_COMP_CONF_ALANG = 'Lingua Amministrazione Sitoe';
	public $A_COMP_CONF_TIME_SET = 'Fuso orario';
	public $A_COMP_CONF_DATE = 'Data/ora attuali configurate per la visualizzazione';
	public $A_COMP_CONF_LOCAL = 'Codice ISO della Nazione';
	public $A_COMP_CONF_LOCRECOM = 'Raccomandiamo di impostarlo su Auto Select. Elxis caricherà il sistema adatto per il tuo sistema e linguaggio. Windows non supporta UTF-8.';
	public $A_COMP_CONF_LOCCHECK = 'Controllo locale';
	public $A_COMP_CONF_LOCCHECK2 = 'Se vedi la data corretta vuol dire che è stato settato correttamente.<br><strong>Attenzione!</strong> Sotto Windows viene settato automaticamente Inglese.';
	public $A_COMP_CONF_AUTOSEL = 'Selezione Automatica';
	public $A_COMP_CONF_CONTROL = '* Questi parametri controllano la visualizzazione degli elementi *';
	public $A_COMP_CONF_LINK_TITLES = 'Titoli collegati';
	public $A_COMP_CONF_LTITLES_TIP = 'Se selezionato, i titoli saranno mostrati come link';
	public $A_COMP_CONF_MORE_LINK = 'Link Leggi Tutto';
	public $A_COMP_CONF_MLINK_TIP = 'Se configurato per essere mostrato, il link Leggi tutto sarà visualizzato se l&#8217;articolo ha anche il testo esteso, oltre che l&#8217;introduzione';
	public $A_COMP_CONF_RATE_VOTE = 'Valutazione/Votazione elementi';
	public $A_COMP_CONF_RVOTE_TIP = 'Se configurato per essere mostrato, sarà abilitato un sistema di votazione dei contenuti';
	public $A_COMP_CONF_AUTHOR = 'Nome degli autori';
	public $A_COMP_CONF_AUTHORTIP = 'Se configurato per essere mostrato, sarà visualizzato  il nome dell&#8217;autore. Questa è una configurazione generale, ma può essere cambiata dai parametri di ogni singolo articolo.';
	public $A_COMP_CONF_CREATED = 'Data ed ora di creazione';
	public $A_COMP_CONF_CREATEDTIP = 'Se configurata per essere mostrata, saranno visualizzate data ed ora di creazione di ogni articolo. Questa è una configurazione generale, ma può essere cambiata dai parametri di ogni singolo articolo.';
	public $A_COMP_CONF_MOD_DATE = 'Data ed ora di Modifica';
	public $A_COMP_CONF_MDATETIP = 'Se configurata per essere mostrata, saranno visualizzate data ed ora di modifica di ogni articolo. Questa è una configurazione generale, ma può essere cambiata dai parametri di ogni singolo articolo.';
	public $A_COMP_CONF_HITS = 'Visite';
	public $A_COMP_CONF_HITSTIP = 'Se configurata per essere mostrata, saranno visualizzate le volte che è stato letto ogni articolo. Questa è una configurazione generale, ma può essere cambiata dai parametri di ogni singolo articolo.';
	public $A_COMP_CONF_PDF = 'Icona PDF';
	public $A_COMP_CONF_OPT_MEDIA = 'Opzione non disponibile, poichè la cartella /tmpr non è scrivibile';
	public $A_COMP_CONF_PRINT_ICON = 'Icona Stampa';
	public $A_COMP_CONF_EMAIL_ICON = 'Icona Email';
	public $A_COMP_CONF_ICONS = 'Icone';
	public $A_COMP_CONF_USE_OR_TEXT = 'Stampa, PDF ed E-Mail utilizzeranno Icone o Testo';
	public $A_COMP_CONF_TBL_CONTENTS = 'Indice dei Contenuti su Articoli multi-pagina';
	public $A_COMP_CONF_BACK_BUTTON = 'Pulsante Indietro';
	public $A_COMP_CONF_CONTENT_NAV = 'Navigazione Contenuti';
	public $A_COMP_CONF_HYPER = 'Usa titoli ipertestuali';
	public $A_COMP_CONF_DBTYPE = 'Tipo Database';
	public $A_COMP_CONF_DBWARN = 'Do not change unless your system support this database and a copy of Elxis data is installed on this Database!';
	public $A_COMP_CONF_HOSTNAME = 'Hostname';
	public $A_COMP_CONF_DB_PW = 'Password';
	public $A_COMP_CONF_DB_NAME = 'Database';
	public $A_COMP_CONF_DB_PREFIX = 'Prefisso Database';
	public $A_COMP_CONF_NOT_CH = '!! NON CAMBIARLO A MENO CHE TU NON ABBIA UN DATABASE COSTRUITO CON LE TABELLE CHE USANO IL PREFISSO CHE STAI IMPOSTANDO !!';
	public $A_COMP_CONF_ABS_PATH = 'Percorso assoluto (Path)';
	public $A_COMP_CONF_LIVE = 'URL del sito';
	public $A_COMP_CONF_SECRET = 'Parola Segreta';
	public $A_COMP_CONF_GZIP = 'Compressione GZIP delle pagine';
	public $A_COMP_CONF_CP_BUFFER = 'Comprime l&#8217;output nel buffer, se supportato';
	public $A_COMP_CONF_SESSION_TIME = 'Durata della sessione di autenticazione';
	public $A_COMP_CONF_SEC = 'secondi';
	public $A_COMP_CONF_AUTO_LOGOUT = 'Annulla l&#8217;autenticazione dopo questo periodo di inattività';
	public $A_COMP_CONF_ERR_REPORT = 'Rapporti errori';
	public $A_COMP_CONF_HELP_SERVER = 'Server per l&#8217;aiuto';
	public $A_COMP_CONF_META_PAGE = 'metadata-page';
	public $A_COMP_CONF_META_DESC = 'Meta Descrizione Globale per il sito';
	public $A_COMP_CONF_META_KEY = 'Meta Keywords Globali per il sito';
	public $A_COMP_CONF_META_TITLE = 'Visualizza il Meta Tag Titolo';
	public $A_COMP_CONF_META_ITEMS = 'Mostra il meta tag Titolo quando si visualizzano i contenuti';
	public $A_COMP_CONF_META_AUTHOR = 'Visualizza il Meta Tag Autore';
	public $A_COMP_CONF_HPS1 = 'File d&rsquo;aiuto locale';
	public $A_COMP_CONF_HPS2 = 'Elxis Remote Help Server';
	public $A_COMP_CONF_HPS3 = 'Official Elxis Help Server';
	public $A_COMP_CONF_PERMFLES = 'Seleziona questa opzione per definire i permessi dei nuovi files creati';
	public $A_COMP_CONF_PERMDIRS = 'Seleziona questa opzione per definire i permessi delle nuove cartelle create';
	public $A_COMP_CONF_NCHMODDIRS = 'Non cambiare i permessi (CHMOD) delle nuove cartelle (usa quelli predefiniti del server)';
	public $A_COMP_CONF_CHAPFLAGS = 'Scegliendo questo, saranno applicati i permessi indicati a <em>tutti i files esistenti</em> nel sito.<br/><b>UN USO IMPROPRIO DI QUESTA OPZIONE POTREBBE RENDERE IL SITO NON OPERATIVO!</b>';
	public $A_COMP_CONF_CHAPDLAGS = 'Scegliendo questo, saranno applicati i permessi indicati a <em>tutte le cartelle esistenti</em> nel sito.<br/><b>UN USO IMPROPRIO DI QUESTA OPZIONE POTREBBE RENDERE IL SITO NON OPERATIVO!</b>';
	public $A_COMP_CONF_APPEXDIRS = 'Applica alle cartelle esistenti';
	public $A_COMP_CONF_APPEXFILES = 'Applica ai files esistenti';
	public $A_COMP_CONF_WORLD = 'Altri';
	public $A_COMP_CONF_CHMODNDIRS = 'Permessi (CHMOD) alle nuove cartelle';
	public $A_COMP_CONF_MAIL = 'Gestione Mail';
	public $A_COMP_CONF_MAIL_FROM = 'Mittente E-Mail';
	public $A_COMP_CONF_MAIL_FROM_NAME = 'Nome Mittente';
	public $A_COMP_CONF_MAIL_SMTP_AUTH = 'Autenticazione SMTP';
	public $A_COMP_CONF_MAIL_SMTP_USER = 'Utente SMTP';
	public $A_COMP_CONF_MAIL_SMTP_PASS = 'Password SMTP';
	public $A_COMP_CONF_MAIL_SMTP_HOST = 'Host SMTP';
	public $A_COMP_CONF_CACHE = 'Uso della Cache';
	public $A_COMP_CONF_CACHE_FOLDER = 'Cartella Cache';
	public $A_COMP_CONF_CACHE_DIR = 'La cartella cache attuale è';
	public $A_COMP_CONF_CACHE_DIR_UNWRT = 'La cartella cache NON è SCRIVIBILE - Per favore imposta questa cartella a CHMOD 755 prima di attivare la cache';
	public $A_COMP_CONF_CACHE_TIME = 'Durata della Cache';
	public $A_COMP_CONF_STATS = 'Statistiche';
	public $A_COMP_CONF_STATS_ENABLE = 'Abilita/disabilita le statistiche sul sito';
	public $A_COMP_CONF_STATS_LOG_HITS = 'Registra le visite ai contenuti per Data';
	public $A_COMP_CONF_STATS_WARN_DATA = 'ATTENZIONE : Sarà registrata una grande quantità di dati';
	public $A_COMP_CONF_STATS_LOG_SEARCH = 'Memorizza le parole cercate con la funzione Cerca';
	public $A_COMP_CONF_SEO_LBL = 'SEO';
	public $A_COMP_CONF_SEO = 'Ottimizzazione per i motori di ricerca';
	public $A_COMP_CONF_SEO_SEFU = 'URL amichevoli per i motori di ricerca';
	public $A_COMP_CONF_SEOBASIC = 'SEO Basic';
	public $A_COMP_CONF_SEOPRO = 'SEO Pro';
	public $A_COMP_CONF_SEOHELP = "Apache and IIS. Apache : rinomina htaccess.txt in .htaccess prima di attivarlo(mod_rewrite abilitato). IIS: use Ionic Isapi Rewriter filter. For maximum performance prepare your content before switching to SEO PRO. Select SEO Basic if you want to use a third party SEF component.";
	public $A_COMP_CONF_SEO_DYN = 'Titoli pagine dinamiche';
	public $A_COMP_CONF_SEO_DYN_TITLE = 'Cambia dinamicamente il titolo della pagina riflettendo il contenuto corrente';
	public $A_COMP_CONF_SERVER = 'Server';
	public $A_COMP_CONF_METADATA = 'Metadata';
	public $A_COMP_CONF_CACHE_TAB = 'Cache';
	public $A_COMP_CONF_FTP_LBL = 'FTP';
	public $A_COMP_CONF_FTP = 'Settaggi FTP';
	public $A_COMP_CONF_FTP_ENB = 'Abilita FTP';
	public $A_COMP_CONF_FTP_HST = 'Host FTP';
	public $A_COMP_CONF_FTP_HSTTP = 'Molto probabilmente';
	public $A_COMP_CONF_FTP_USR = 'FTP Username';
	public $A_COMP_CONF_FTP_USRTP = 'Molto probabilmente';
	public $A_COMP_CONF_FTP_PAS = 'FTP Password';
	public $A_COMP_CONF_FTP_PRT = 'Porta FTP';
	public $A_COMP_CONF_FTP_PRTTP = 'Valore di default: 21';
	public $A_COMP_CONF_FTP_PTH = 'FTP Root Path';
	public $A_COMP_CONF_FTP_PTHTP = 'Path della root FTP della vostra installazione Elxis. Es.: /public_html/elxis';
	public $A_COMP_CONF_HIDE = 'Nascondi';
	public $A_COMP_CONF_SHOW = 'Mostra';
	public $A_COMP_CONF_DEFAULT = 'System Default';
	public $A_COMP_CONF_NONE = 'Niente';
	public $A_COMP_CONF_SIMPLE = 'Semplice';
	public $A_COMP_CONF_MAX = 'Massino';
	public $A_COMP_CONF_MAIL_FC = 'Funzione PHP mail';
	public $A_COMP_CONF_SEND = 'Sendmail';
	public $A_COMP_CONF_SENDP = 'Sendmail path';
	public $A_COMP_CONF_SMTP = 'SMTP Server';
	public $A_COMP_CONF_UPDATED = 'I dettagli della configurazione sono stati <strong>aggiornati!</strong>';
	public $A_COMP_CONF_ERR_OCC = '<strong>Si è verificato un errore!</strong> Non è possibile aprire in scrittura il file di configurazione!';
	public $A_COMP_CONF_READ = 'leggi';
	public $A_COMP_CONF_WRITE = 'scrivi';
	public $A_COMP_CONF_EXEC = 'esegui';
	public $A_COMP_CONF_FCRE = 'Creazione file';
	public $A_COMP_CONF_FPERM = 'Permessi files';
	public $A_COMP_CONF_DCRE = 'Creazione Cartella';
	public $A_COMP_CONF_DPERM = 'Permessi Cartella';
	public $A_COMP_CONF_OFFEX = 'Sì (eccetto per i Super Amministratori)';
	public $A_COMP_CONF_RTF = 'Icona RTF';

	//elxis 2008.1
	public $A_C_CONF_AC_ACT = 'Attivazione Conto';
	public $A_C_CONF_NOACT = 'No attivazione';
	public $A_C_CONF_EMACT = 'Attivazione via e-mail';
	public $A_C_CONF_MANACT = 'Attivazione manuale';
	public $A_C_CONF_AC_ACTD = 'Selezionare la modalità che si desidera attivare il conto di un nuovo utente. Direttamente, tramite link di attivazione con e-mail ο manualmente dall\'amministratore del sito.';

	//2009.0
	public $A_C_CONF_COMMENTS = 'Commenti';
	public $A_C_CONF_COMMENTSTIP = 'Se impostata la visualizzazione, il numero dei commenti per un particolare elemento di contenuto verru mostrato. Questa è una impostazione globale ma può essere cambiata a livello di menu e di elemento';
	public $A_C_CONF_CHKFTP = 'Controlla le impostazioni FTP';
	public $A_C_CONF_STDCACHE = 'Standard cache';
	public $A_C_CONF_STATCACHE = 'cache Statica';
	public $A_C_CONF_CACHED = 'Standard Cache effettua il caching parziale di parti di pagine mentre la Cache Statica effettua il caching dell\'intera pagina. Cache Statica è raccomandata per siti molto trafficati. Per usare la cache statica devi avere SEO PRO abilitato.';
	public $A_C_CONF_SEODIS = 'SEO PRO è disabilitato!';

	public function __construct() {
	}

}

?>