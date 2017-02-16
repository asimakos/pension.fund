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
* @description: Italian language for Defender tool
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Accesso Limitato' );


define('_DEFL_CONFIG', 'Configurazione Elxis Defender');
define('_DEFL_CONFPERMSUCC', 'I permessi dei file di configurazione di Defender sono settati a');
define('_DEFL_CONFPERMNO', 'Non puoi rendere scrivibile il file di configurazione di Defender');
define('_DEFL_LOGSPERMSUCC', 'I permessi delle cartelle dei Rapporti di Defender sono settate a ');
define('_DEFL_LOGSPERMNO', 'Non puoi rendere scrivibile la cartella dei Rapporti di Defender');
define('_DEFL_ENABLEDESC', 'Abilita Defender o no (devi essere sicuro di aver abilitato in scrittura la directory /administrator/tools/defender/logs)');
define('_DEFL_PROTVARS', 'Variabili Protette');
define('_DEFL_PROTVARSD', 'Seleziona il tipo di variabile che desideri proteggere (default: REQUEST)');
define('_DEFL_LOGATTACKS', 'Rapporto Attacchi');
define('_DEFL_LOGATTACKSD', 'Se abilitato, Defender creerà un report per ogni attacco');
define('_DEFL_MAILALERT', 'Invia una Email di Avviso');
define('_DEFL_MAILALERTD', 'Se abilitata, Defender vi invierà una e-mai per ogni attacco');
define('_DEFL_MAILADDR', 'Indirizzo e-mail per la notifica');
define('_DEFL_SITEOFFFOR', 'Sito Off-Line per');
define('_DEFL_SECONDS', 'secondi');
define('_DEFL_SITEOFFD', 'Dopo un attacco il sito sarà messo Off-Line per X secondi. Inserisci 0 per disabiltarlo');
define('_DEFL_BLOCKIP', 'Blocca IP');
define('_DEFL_BLOCKIPD', 'Abilitalo per bloccare gli IP dai quali provengono gli attacchi. Attenzione che Defender bloccherà tutto ciò che considera come attacco, anche voi!');
define('_DEFL_FILTERS', 'Filtri');
define('_DEFL_FILTHELP', '<b>Elxis defender è di solito impostato senza filtri.</b><br />
	Per aggiungere un nuovo filtro, inserisci la parola o la frase che desideri filtrare nel campo aggoingi filtro e clicca su  <b>Aggiungi</b>.<br />
	Non confonderti a scrivere in Maiuscolo o in Minuscolo.<br />
	Premi <b>CANCELLA</b> per rimuovere un filtro dalla Lista.<br />
	Se hai familiarità con il <b>mod_Security</b> di Apache, tieni presente che quando aggiungi i filtri, le funzioni di 
	Elxis Defender lavorano pressappoco nello stesso modo.<br /> 
	Quando finito, clicca su <b>Save</b> per salvare la configurazione di Defender e i filtri.<br />');
define('_DEFL_SLOWDOWNT', 'Tempo di rallentamento');
define('_DEFL_SLOWDOWN', 'L\'uso di Defender rallenta Elxis. L\'aggiunta di troppi filtri può incrementare di molto iil tempo di esecuzione di PHP. Vi avvisiamo di non aggiungere più di 15 filtri ma vi invitiamo anche a fare degli esperimenti per trovare la configurazione ottimale, perché dipende sempre dal Vostro Sito e dal Server.
	Interpella Elxis Team se hai delle difficoltà.
	I nostri test di laboratorio hanno mostrato un rallentamento da <b>0.1 a 27 msec</b> a seconda del numero di filtri utilizzati (da 10 e più a 30) 
	e con che tipo di variabili di input Elxis Defender ha avuto a che fare (da una normale lettura, a inserire pesanti articoli tramite il metodo POST o GET.');
define('_DEFL_EXAMPLEFIL', 'Esempi Filtri');
define('_DEFL_DEFCONFIS', 'Il file di configurazione di Defenbder è');
define('_DEFL_DEFLOGSIS', 'La cartella logs di Defender è');
define('_DEFL_MAKEWRITE', 'Rendilo scrivibile');
define('_DEFL_CONFSAVESUCC', 'Configurazione di defender salvata con successo!');
define('_DEFL_CONFSAVENO', 'Non puoi salvare la configurazione di Defender!');
define('_DEFL_ERRONEFILT', 'Errore: Devi aggiungere almeno un filtro!');
define('_DEFL_ENCKEY', 'Chiave di cifratura');
define('_DEFL_ENCKEYD', 'Codifica le informazioni registrate. La lunghezza della chiave deve essere tra 8 e 32 caratteri. Cancellare tutte le informazioni registrate prima di cambiare la chiave di cifratura!!');
define('_DEFL_ERRENCKEY', 'Errore: La chiave di cifratura deve essere lunga almeno tra 8 e 32 caratteri');
define('_DEFL_ENABLEDEF', 'Abilita Defender');
define('_DEFL_DISABLEDEF', 'Disabilita Defender');
define('_DEFL_VIEWLOGS', 'Vedi<br />Rapporti');
define('_DEFL_CLEARLOGS', 'Pulisci <br />Rapporti');
define('_DEFL_VIEWBLOCK', 'Vedi <br />IP bloccati');
define('_DEFL_CLEARBLOCK', 'Pulisci <br />IP bloccati');
define('_DEFL_DEFENDER', 'Elxis <br />Defender');
define('_DEFL_LOGSCLEARED', 'Rapporti Puliti');
define('_DEFL_CNOTCLLOGS', 'Non puoi pulire i rapporti. Devi essere sicuro che il file è scrivibile.');
define('_DEFL_BLOCKCLEARED', 'Tutti gli IP bloccato cancellati con successo');
define('_DEFL_CNOTCLBLOCK', 'Non puoi cancellare gli indirizzi IP bloccati. Devi essere sicuro che il file è scrivibile.');
define('_DEFL_SUBMITALERT', 'Inserendo filtri con il Defender abilitato sarà considerato come un Attacco! Prima di inserire i filtri disabilita ul Defender, fai le tue modifiche e poi riabilitalo');
define('_DEFL_GEOLOCATE', 'Locazione Geografica');
define('_DEFL_PERMSUCC', 'Permessi cambiati a');
define('_DEFL_PERMFAIL', 'Non puoi cambiare i permessi di');
define('_DEFL_ADDIP', 'Aggiungi IP');
define('_DEFL_DELETEIP', 'Cancella IP');
define('_DEFL_BLOCKEDIPS', 'Blocca IPs');
define('_DEFL_IPRANGES', 'Raggio d\'azione IP');
define('_DEFL_ADDRANGE', 'Aggiungi raggio d\'azione IP');
define('_DEFL_DELRANGE', 'Cancella raggio d\'azione IP');
define('_DEFL_RANGEHELP', 'Per bloccare un intero Network, Internet Providers o una intera nazione, Defender offre l\'opzione di aggiungere un raggio di azione di IP. Ogni raggio d\'azione consiste di due parti separate da un underscore (_). Il primo è l\'indirizzo di IP di partenza e il secondo è l\'indirizzo IP di chiusura.Elxis Defender bloccherà ogni IP tra questi due valori.');
define('_DEFL_RANGEEXAMPLES', 'Esempi d\'uso');
define('_DEFL_BLOCKFROM', 'Bloccherà gli IP da');
define('_DEFL_BLOCKTO', 'a');
define('_DEFL_ALLOWIPS', 'Indirizzi IP autorizzati');
define('_DEFL_ALLOWIPSD', 'Se abilitato sarete in grado di settare gli indirizzi IP che saranno autorizzati ad accedere sia in back-end (lato amministrativo) che in fron-end (lato pubblico) del vostro sito');
define('_DEFL_FRONTBACK', 'Front-end e Admin.');
define('_DEFL_ALLOWDIS', '"Indirizzi IP autorizzati" è disabilitato');
define('_DEFL_ONLACCADM', 'Solo gli IP riportati qui sotto hanno accesso all\'Area amministrativa');
define('_DEFL_ONLACCSAD', 'Solo gli IP riportati qui sotto hanno accesso all\'Area Pubblica a Amministrativa');

?>