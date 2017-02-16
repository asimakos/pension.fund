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
* @description: Italian language for component softdisk
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CORE = 'Core';
public $A_ASTATS = 'Statistiche della gestione';
public $A_VALUE = 'Valore';
public $A_LASTMOD = 'Ultima Modifica';
public $A_OS = 'Systema Operativo';
public $A_ELXIS_VERSION = 'Elxis version';
public $A_SELECT = 'Prescelto';
public $NOEDITSYS = 'Non sei autorizzato a amodificare questi valori';
public $A_RESTORE = 'Ripristino';
public $SOFTDISK_HELP = 'Softdisk e un\'area virtuale di immagazzinamento per ogni tipo di variabili e parametri.<br />
  	Puoi aggiungere, modificare o cancellare valori esistenti in SoftDisk eccetto quelle marcate come proprietarie del sistema.
	Anche i valori marcati come "Non Cancellabili" possono essere solo modificati. Per nominare le sexioni e i nomi dei valori di SoftDisk sei obbligato ad usare <strong>lettere latine in maiuscolo, capital latin letters, cifre e underscore (_)</strong>.';
public $YCNOTEDITP = 'Non puoi modificare i parametri';
public $UNDELETABLE = 'Non cancellabile';
public $SOFTENTRYEXIST = 'C\'e gia una valore SoftDisk con quel nome!';
public $INVSECTNAME = 'Nome sezione non valido!';
public $INVNAME = 'Nome non valido!';
public $INVEMAIL = 'Il valore fornito non e un indirizzo email valido!';
public $INVURL = 'Il valore fornito non e un URL Valido!';
public $INVDEC = 'Il valore fornito non e un numero decimale!';
public $INVTSTAMP = 'Il valore fornito non e un valido timestamp di UNIXS!';
public $UPSYSTEM = 'Sistema dell aggiornamento';
public $A_USERPROFILE = 'Profilo di utente';
public $UPROF_WEBSITE = 'Sito Web';
public $UPROF_AIM = 'AIM';
public $UPROF_YIM = 'YIM';
public $UPROF_MSN = 'MSN';
public $UPROF_ICQ = 'ICQ';
public $UPROF_EMAIL = 'E-mail';
public $UPROF_PHONE = 'Telefono';
public $UPROF_MOBILE = 'Telefono delle cellule';
public $UPROF_BIRTHDATE = 'Data di nascita';
public $UPROF_GENDER = 'Genere';
public $UPROF_LOCATION = 'Posizione';
public $UPROF_OCCUPATION = 'Occupazione';
public $UPROF_SIGNATURE = 'Firma';
public $UPROF_ARTICLES = 'Numero degli articoli';
public $UPROF_USERGROUP = 'Gruppo Utenti';
public $UPROF_RANDUSERS = 'Visualizza utenti casuali nella pagina profilo';
public $USERS_RPASSMAIL = 'Notifica amministratori sul ricordo password inserimento';
public $SUBMIT_CATEGORIES = 'Categorie che e permesso l\'inserimento di contenuti (suggerite). Se vuoto tutto e permesso. (ID\'s categorie, separate da virgola)';
public $SUBMIT_SECTIONS = 'Sections che e permesso l\'inserimento di contenuti (suggerite). Se vuoto tutto e permesso. (ID\'s sezioni, separate da virgola)';
public $REG_AGREE = 'Regolamento registrazione ID pagina autonoma (statica). Zero (O) per disabilitare. Per lingue specifiche inserire nella sezione USERS (UTENTI) una variabile di tipo numero intero (integer) chiamata <strong>REG_AGREE_LANGUAGE-HERE</strong>';
public $A_WEBLINKS = 'Link Siti Web';
public $TOP_WEBLINK = 'Controlla la visualizzazione o no, del modulo Top Weblinks all\'interno del componente weblinks';
public $A_USERSLIST = 'Lista Utenti';
public $ULIST_ONLINE = 'Stato Online';
public $ULIST_USERNAME = 'Username';
public $ULIST_NAME = 'Nome';
public $ULIST_REGDATE = 'Data Registrazione';
public $ULIST_PREFLANG = 'Lingua preferita';
//2009.0
public $STATICCACHE = 'Cache Statica';

}

?>