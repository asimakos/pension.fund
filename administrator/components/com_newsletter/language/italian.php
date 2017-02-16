<?php 
/**
* @version: 1.0
* @copyright: Copyright (C) 2008 Is Open Source. All rights reserved.
* @package: Elxis
* @subpackage: Component NewsLetter
* @author: Ioannis Sannos (Is Open Source)
* @translator: Francesco Venuti (Aka Amigamerlin)
* @link: http://www.isopensource.com
* @email: info@isopensource.com
* @description: English language for component NewsLetter
* @license: http://creativecommons.org/licenses/by-sa/3.0/ Creative Commons Attribution-Share Alike 3.0
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class newsletterLang {


	public $NEWSLETTER = 'Newsletter';
	public $NEWSLMAILLIST = 'Newsletter mailing list';
	public $SUBSCRIBE = 'Sottoscrivi';
	public $UNSUBSCRIBE = 'Rimuovi sottoscrizione';
	public $SUBLEWSL = 'Sottoscrivi la nostra newsletter';
	public $UNSUBLEWSL = 'Rimuovi sottoscrizione dalla nostra newsletter';
	public $NAME = 'Nome';
	public $SURNAME = 'Cognome';
	public $RECIEVEIN = "Ricevi messaggi in "; //translators help: filled in by language name (i.e. "English")
	public $ANYLANG = 'Qualsiasi lingua';
	public $SUBINFO = 'Compila i campi con i tuoi dati personali per effettuare la sottoscrizione alla nostra newsletter. Tutti i campi sono obbligatori. 
	Sarai in grado, in ogni momento, di rimuovere la tua sottoscrizione dalla nostra newsletter se non vorrai ricevere nessuna nostra e-mail di notifica.';
	public $SUBEMAILVAL = 'Il tuo indirizzo e-mail verrà automaticamente verificato al fine di approvare la tua sottoscrizione.';
	public $SECCODE = 'Codice di Sicurezza';
	public $UNSUBINFO = 'Inserisci il tuo indirizzo e-mail per rimuovere la sottoscrizione dalla nostra newsletter. Un indirizzo URL speciale  
	ti verrà inviato al tuo indirizzo e-mail. Clicca sull\'URL per essere rimosso definitivamente dalla mailing list.';
	public $JSDISABLED = 'Devi avere JavaScript abilitato nel tuo browser per poter utilizzare questa feature!';
	public $NAMEEMPTY = 'Il nome non può essere vuoto!';
	public $SURNAMEEMPTY = 'Il cognome non può essere vuoto!';
	public $PROVALIDEMAIL = 'Devi inserire un indirizzo e-mail valido!';
	public $SECCODEWRONG = 'Il codice di sicurezza è errato!';
	public $EMAILEXISTS = 'L\'indirizzo e-mail inserito è già presente nella nostra mailing list!';
	public $NOTACCDOM = 'Scusa, non è possibile acettare e-mail dal tuo dominio.';
	public $FLOODWAIT = 'Protezione Flood! Attendi alcuni secondi e riprova.';
	public $NEWSLSUBNTF = 'Notifica sottoscrizione Newsletter';
	public $DEAR = 'Caro'; //translators help: followed by name surname
	public $THANKSUB = 'Grazie per aver scelto di aderire alla nostra mailing list.';
	public $SUBCOMPVISIT = 'Al fine di completare la tua sottoscrizione è necessario che il link sottostante sia validato. 
	Visitando tale link certifichi di essere il legittimo possessore di questo indirizzo e-mail e la tua sottoscrizione sarà attivata.';
	public $NEVERSUBIGN = 'Se non hai mai richiesto l\'adesione alla nostra mailing list cortesemente ignora questa e-mail.';
	public $GREETINGS = 'Saluti';
	public $SUBCONFIRM = 'Conferma di sottoscrizione';
	public $CONFLINKSENT = 'Un link speciale di conferma è stato spedito al tuo indirizzo e-mail. 
	Controlla i tuoi messaggi e clicca sul link di conferma per completare la tua sottoscrizione alla nostra mailing list.'; 
	public $SUBCOMPLETE = 'La tua sottoscrizione è stata completata';
	public $SUBCOMPLETED = 'La tua sottoscrizione alla nostra mailing è stata completata con successo. Se non desideri più
	ricevere messaggi e-mail da noi puoi, in qualsiasi momento, rimuovere la sottoscrizione dalla nostra mailing list inserendo il tuo indirizzo e-mail 
	nel form Rimuovi Sottoscrizione.';
	public $CONFFAILED = 'Conferma fallita';
	public $CONFFAILEDD = 'Conferma sottoscrizione fallita! La tua sottoscrizione è già confermata o il codice di conferma non è valido.';
	public $SUBLOGIN = 'Devi prima effettuare il login per poter sottoscrivere la nostra mailing list!';
	public $SUBNALLOWED = 'Siamo spiacenti, non sono permesse ulteriori sottoscrizioni.';
	public $MAILNFOUND = 'Il tuo indirzzo e-mail non è stato trovato nella nostra mailing list o la tua sottoscrizione è ancora non confermata';
	public $UNSUBCONFIRM = 'Conferma rimozione sottoscrizione';
	public $WISHUNSCLICK = 'Abbiamo ricevuto una richiesta di rimuovere la tua sottoscrizione dalla nostra mailing. Per confermare che desideri
	rimuovere la tua sottoscrizione visita il link sottostante.';
	public $UNSUBINGORE = 'Se non hai mai richiesto di essere rimosso dall nostra mailing list o 
	non hai mai sottoscritto la stessa, ignora questo messaggio. Grazie.';
	public $UNSUBCOMPLETE = 'La tua richiesta di cancellazione è completa';
	public $UNSUBCOMPLETED = 'Sei stato rimosso con successo dalla nostra mailing list.';
	public $RCONFLINKSENT = 'La tua rishiesta di essere rimosso dalla mail list è stata inviata con successo. Un link speciale di conferma è stato 
	spedito al tuo indirizzo email. Controlla i tuoi messaggi e clicca sul link per completare la tua rimozione dalla nostra mailing list.'; 
	public $RCONFFAILEDD = 'Richiesta di cancellazione Fallita! La tua sottoscrizione non è confermata o il codice di conferma non è valido.';
	public $NOTHSPECIAL = 'Non c\'è niente di speciale da vedere qui.';
	public $STATISTICS = 'Statistiche';
	public $TOTALSENT = 'Messaggi Totali Spediti';
	public $LASTSUBSCRIBER = 'Ultimo sottoscrittore';

	/* BACK-END */
	public $CONFIGURE = 'Configura';
	public $SUBSCRIBERS = 'Sottoscrittori';
	public $CONFIRMED = 'Confermati';
	public $UNCONFIRMED = 'Non confermati';
	public $GUEST = 'Visitatori';
	public $SUBSCRIPTIONS = 'Sottoscrittori';
	public $REGUSERS = 'Utenti registrati';
	public $EVERYONE = 'Chiunque';
	public $CANSUBSCRIBED = 'Selezione a chi è permesso di sottoscrivere la tua mailing list dal front-end.';
	public $EMAILVALID = 'Validazione E-mail';
	public $EMAILVALIDD = 'Se abilitato ad ogni nuova sottoscrizione una e-mail speciale è inviata al sottoscrittore con un link per la conferma. 
	La nuova sottoscrizione è attivata solo se l\'utente clicca sul link trasmesso. In questo modo sei sicuro che l\'utente è il legittimo proprietario dell\'indirizzo e-mail trasmesso 
	e che l\'indirizzo e-mail è valido.';
	public $LANGSD = 'Se desideri spedire e-mail in una determinata lingua, seleziona la stessa. Gli utenti durante
	la loro sottoscrizione saranno in grado di selezionare una lingua differente da quella da te abilitata. Se hai soltanto una lingua 	
  pubblicata non selezionare nessuna lingua.';
	public $EXCLUDEDTLDS = 'TLDs Esclusi';
	public $EXCLUDEDTLDSD = 'Lista di Top Level Domains, separti da virgola, (es: com,net,org) dai quali impedire sottoscrizioni alla tua mailing list';
	public $EXCLUDEDDOMS = 'Domini Esclusi';
	public $EXCLUDEDDOMSD = 'Lista di nome di Domini separati da virgola (es: badsite.com,hackers.cn) dai quali impedire  
	sottoscrizioni alla tua mailing list.';
	public $ALLOWEDTLDS = 'TLDs Permessi';
	public $ALLOWEDTLDSD = 'Lista di Top Level Domains, separti da virgola, (es: com,net,org) dai quali è unicamente permessa la sottoscrizione alla tua mailing list;
	Lascia questo campo vuoto per permettere sottoscrizioni da tutti.';
	public $ALLOWEDDOMS = 'Domini Permessi';
	public $ALLOWEDDOMSD = 'Lista di nome di Domini separati da virgola (es: mysite.com,friendlysite.gr) dai quali è unicamente permessa la sottoscrizione alla tua mailing list.
  Lascia questo campo vuoto per permettere sottoscrizioni da tutti.';
	public $SHOWSTATSD = 'Mostro le statistiche della NewsLetter nella Pagina Principale ?';
	public $RECPERSTEP = 'Trasmetti e-mail in step';
	public $RECPERSTEPD = 'IOS Newsletter limita il carico generato nella spedizione delle e-mail utilizzando spedizioni in numero di steps. Inserisci qui il numero di e-mail da spedire in ogni step.
  Riduci questo numero se vedi che il ogni step richiede troppo tempo per essere eseguito.';
	public $ONEPERREC = 'Una per Destinatario';
	public $ONEPERRECD = 'Spedisci una e-mail per destinatario. Funziona solo se il metodo di spedizione è PHP Mail! Se questo è abilitato, 
	IOS Newsletters spedirà una e-mail per destinatario. Quindi, se tu spedisci un messaggio a 50 persone 50 e-mail verranno spedite. 
	Se utilizzi tale Feature utilizza un basso numero di destinatari per Step. Se questa feature è disabilitata , 1 e-mail unica verrà spedita
	in ogni step per tutti i destinatari.';
	public $CNOTSAVESETS = 'Non posso salvare i settaggi!';
	public $EXPORT = 'Esporta';
	public $EXPORTSUB = 'Esporta sottoscrittori';
	public $IMPORT = 'Importa';
	public $IMPORTSUB = 'Imposta Sottoscrittori';
	public $IMPORTUNIQUE = 'Importa solo indirizzi e-mail che non eistono (Richiede una query extra db per i sottoscrittori. 
	Non importare molti sottoscrittori in in una volta).';
	public $IMPORTD = 'Seleziona il backup delle NewsLetter che desideri importare.';
	public $IMPORTCUSTOM = 'Se stai utilizzando un file di importazione personalizzato assicurati che sia codificato in UTF-8 
	ed i sottoscrittori siano nel seguente formato ( un sottoscrittore per linea ):';
	public $IMPORTGIDL = 'Per gli userid Visitatori è 0. Il campo lingua ed groupo può essere vuoto.';
	public $IMPORTEDSUBS = "Sono stati trovati %s sottoscrittori. Di essi %s sono stati importati."; //translators help: %s is being replaced by number
	public $CONFCODE = 'Codice di conferma';
	public $GETUSERDATA = 'Prendi di dati dall\'utente';
	public $NEWSLETTERS = 'Newsletters';
	public $SUBJECT = 'Oggetto';
	public $RECIPIENTS = 'Destinatari';
	public $PLAINTEXT = 'Testo semplice';
	public $TEXTHTML = 'Testo in HTML';
	public $HTMLFILE = 'File HTML';
	public $LASTSENT = 'Ultimo invio'; //translators help: date newsletter last sent
	public $SELECTFILE = 'Selezione il file';
	public $HTMLFILED = 'Tu puoi effettuare l\'upload ed usare un file HTML preimpostato invece di scrivere un testo HTML.';
	public $SUBJECTEMPTY = 'L\'oggetto non può essere vuoto !';
	public $FIRSTSAVEPR = 'Devi prima effettuare il salvataggio della newsletter per poter visualizzare l\'anteprima!';
	public $NEWSLNEMPTY = 'La Newsletter non può essere vuota!';
	public $SENDNEWSLETTER = 'Spedisci Newsletter';
	public $MAILFORMAT = 'Formato Mail';
	public $FORCESEND = 'Forza la spedizione di questo messaggio anche agli utenti che hanno selezionato di ricevere selected di ricevere e-mail in altre lingue.';
	public $SUBSTOTAL = 'Sottoscrittori Totali';
	public $SUBSCRIBERSIN = "Sottoscrittori in %s"; //translators help: filled in by language
	public $SENDNOW = 'Spedisci Ora!';
	public $SENDMSGSWAIT = "Sto inviando %s messaggi, Attendi... grazie "; //translators help: filled in by messages number
	public $PLEASEWAIT = 'Attendi ... grazie';
	public $MSGOFSENT = "%s di %s messaggi sono stati inviati con successo."; //translators help: filled in by number / total number
	public $DISPATCHCOM = 'Spedizione completata';
	public $SENDERNAME = 'Nome di chi spedisce';
	public $SENDEREMAIL = 'E-mail di chi spedisce';
	public $SENDMETHOD = 'Metodo di spedizione';
	public $READCONFIRM = 'Conferme letture';
	public $SENDMAILPATH = 'Sendmail path';
	public $SENDMAILPATHD = 'Usato se è selezionato Sendmail come metodo per la spedizione delle e-mail (valore di default: /usr/sbin/sendmail).';
	public $SMTPHOST = 'SMTP host';
	public $SMTPPORT = 'SMTP port';
	public $SECURESMTP = 'Secure SMTP';
	public $SMTPAUTH = 'SMTP authentication';
	public $SMTPUSER = 'SMTP username';
	public $SMTPPASS = 'SMTP password';
	public $ADDREPLYTO = 'Rispondi a';
	public $ADDREPLYTOD = 'Inserisco un Rispondi a una e-mail nella testata dell\'e-mail?';
	public $THECOPY = 'Copia'; //translators help: THE copy (material, a copied newsletter)
	public $SHOWCOPYRIGHT = 'Mostra copyright';
	public $SHOWCOPYRIGHTD = 'Seleziona se vuoi che venga mostrato un messaggio di copyright nella pagina principale. Questo la mia sola ricompensa per aver concesso gratuitamente questo componente!';
	public $UPHTMLTEMP = 'Upload di un file HTML da utilizzarsi come template per le NewsLetter ';
	public $UPLOADHTMLTEMP = 'Upload del Template HTML ';
	public $SENDNEWSLET = 'Spedisci Newsletter';
	public $IMPORTELXUS = 'Importa utenti Elxis';
	public $IMPORTELXUSD = 'Importa nel componente Newsletter utenti Elxis esistenti. Verranno importati 
  solo gli utenti con indirizzi E-mail che non sono esistenti tra i sottoscrittori della Newsletter.';
	public $FOUNDELXUIMP = "%s utenti Elxis sono stati trovati. %s di essi sono stati importati nella Newsletter."; //translators help: filled in by numbers

	//languages names
	public $ARMENIAN = 'Armeno';
	public $BOZNIAN = 'Bosniaco';
	public $BRAZILIAN = 'Brasiliano';
	public $BULGARIAN = 'Bulgaro';
	public $CREOLE = 'Creolo';
	public $CROATIAN = 'Croato';
	public $DANISH = 'Danese';
	public $ENGLISH = 'Inglese';
	public $FRENCH = 'Francese';
	public $GERMAN = 'Tedesco';
	public $GREEK = 'Greco';
	public $INDONESIAN = 'Indonesiano';
	public $ITALIAN = 'Italiano';
	public $JAPANESE = 'Giapponese';
	public $LATVIAN = 'Latviano';
	public $LITHUANIAN = 'Lituano';
	public $PERSIAN = 'Persiano';
	public $POLISH = 'Polacco';
	public $RUSSIAN = 'Russo';
	public $SERBIAN = 'Serbo';
	public $SPANISH = 'Spagnolo';
	public $SRPSKI = 'Srpski';
	public $TURKISH = 'Turco';
	public $VIETNAMESE = 'Vietnamita';

	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
	}

}

?>