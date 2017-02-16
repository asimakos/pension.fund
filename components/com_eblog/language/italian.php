<?php 
/**
* @version: 2009.1
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component eBlog
* @author: Elxis Team
* @translator: Yiannis Kottaras
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Italian language for component eBlog
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Non è consentito, l\'accesso diretto a questa posizione.' );


class eBlogLang {


	public $ELXISBLOG = 'Elxis Blog';
	public $TAGS = 'Tags';
	public $UNKNOWNTAG = 'Sconosciuto tag';
	public $PERMLINK = 'Collegamento permanente';
	public $COMMENTS = 'Commenti';
	public $COMMENT = 'Commento'; //(noun, i.e. 1 comment)
	public $NOCOMMENTS = 'Non esistono commenti.';
	PUBLIC $MUSTLOGTOCOM = 'Devi prima fare login per inviare commenti.';
	public $POSTCOMMENT = 'Inviare un commento';
	public $YOURCOMMENT = 'Il tuo commento';
	public $NALLPOSTCOM = 'Non ti è consentito inviare commenti!';
	public $MUSTWRITEMSG = 'Devi scrivere un messagio!';
	public $COMADDSUC = 'Il tuo commento si è aggiunto con successo!';
	public $WAITRETRY = 'Si prega di riprovare dopo alcuni secondi!';
	public $NALLPERFACT = 'Non ti è consentito eseguire questa azione!';
	public $ARTNOFOUND = 'Non si puo trovare il post richiesto!';
	public $POSTSTAGASAT = "Posts contrassegnati come %s a %s"; //esempio: Posts contrassegnati come computer a ElectroBlog";
	public $ARCHIVES = 'Archivi';
	public $USERBLOGSAT = "Utente blogs a %s"; //s: nome sito
	public $USERBLOGS = 'Utente blogs';
	public $THEREAREBLOGS = "Ci sono %s blogs disponibili"; //s: numero di blogs disponibili
	public $POSTS = 'Posts';

	//control panel
	public $CPANEL = 'Pannello di controllo';
	public $MANBLOG = 'Gestire il tuo blog';
	public $ALLPOSTS = 'Tutti i posts';
	public $LATESTPOSTS = "Ultimi %s posts";
	public $SETTINGS = 'Impostazioni';
	public $CSSFILE = 'CSS file';
	public $RTLCSSFILE = 'RTL CSS file';
	public $COMMENTARY = 'Commento';
	public $NOTALLOWED = 'Non consentito'; //Commentary
	public $REGUSERS = 'Utenti registrati'; //Commentary
	public $ALLOWEDALL = 'Consentito a tutti'; //Commentary
	public $POSTSNUMBER = 'Numero Posts';
	public $POSTSNUMBERD = 'Numero di post più recenti da visualizzare nel blog di front-page.';
	public $SHOWTAGSD = 'Selezionare se si desidera visualizzare i tags al di sotto dei posts.';
	public $CSSFILED = 'Stile grafico da utilizzare per il tuo blog. Il CSS si prende cura di tutti i layout, i caratteri, colori e aspetto generale del tuo blog.';
	public $RTLCSSFILED = 'Stile grafico da utilizzare per il tuo blog per lingue Destra a Sinistra, come il persiano ed ebraico.';
	public $OPTION = 'Opzione';
	public $VALUE = 'Valore';
	public $HELP = 'Aiuto';
	public $NEWPOST = 'Nuovo post';
	public $EDITPOST = 'Modificare post';
	public $TITLENOEMPTY = 'Il titolo non puo essere vuoto!';
	public $FOLDERCNOTCR = 'Cartella %s potrebbe non essere creata!'; //%s: nome della cartella2
	public $DIMENSIONS = 'Dimensioni (W x H)';
	public $SIZEKB = 'Dimensione (KB)';
	public $LISTVIEW = 'Lista Elenco';
	public $THUMBSVIEW = 'Vista miniature';
	public $UPLOAD = 'Caricamento';
	public $UPLOADIMG = 'Caricamento Imagine';
	public $MEDIAMAN = 'Media manager';
	public $YOUTUBEVIDEO = 'YouTube video';
	public $GOOGLEVIDEO = 'Google video';
	public $YAHOOVIDEO = 'Yahoo video';
	public $COMSEPTAGS = 'Tags separati da virgola';
	public $SLOGAN = 'Slogan';
	public $SLOGAND = 'Slogan da visualizzare nel tuo blog header. È possibile scrivere in html.';
	public $SHOWOWNER = 'Visualizza proprietario';
	public $SHOWOWNERD = 'Visualizza il nome del proprietario in blog header?';
	public $SHOWARCHIVE = 'Visualizza archivio';
	public $SHOWARCHIVED = 'Visualizza i mesi in blog footer?';

	//SEO titles
	public $SEOTITLE = 'Titolo SEO';
	public $SEOTITLEEMPTY = 'Il titolo SEO non puo essere vuoto!';
	public $INVALID = 'Invalido';
	public $VALID = 'Valido';
	public $SEOTEXIST = 'Il titolo SEO esiste già!';
	public $SEOTLARGER = 'Provare un titolo più grande!';
	public $SEOTHELP = 'È possibile utilizzare solo caratteri latini minuscole, cifre, trattini e caratteri di sottolineatura. Il titolo SEO deve essere unico! Tenta di inserire titoli SEO unici e con sostanza.';
	public $SEOTSUG = 'Titolo SEO suggerito';
	public $SEOTVAL = 'Convalidare SEO titolo';

	//languages names
	public $ARMENIAN = 'Armeno';
	public $BOZNIAN = 'Boznian';
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
	public $LATVIAN = 'Lettone';
	public $LITHUANIAN = 'Lituano';
	public $PERSIAN = 'Persiano';
	public $POLISH = 'Polacco';
	public $RUSSIAN = 'Russo';
	public $SERBIAN = 'Serbo';
	public $SPANISH = 'Spagnolo';
	public $SRPSKI = 'Srpski';
	public $TURKISH = 'Turko';
	public $VIETNAMESE = 'Vietnamica';

	//backend
	public $BLOGINFO = 'Informazione Blog';
	public $CANCONFIGD = 'Selezionare se si desidera il proprietario del blog di essere in grado di modificare le impostazioni del blog da front-end.';
	public $CANUPLOADD = 'Selezionare se si desidera il proprietario del blog di essere in grado di caricare file multimediali.';
	public $BLOGOWNMDIR = 'Proprietario Blog media directory';
	public $EXISTING = 'Esistente';
	public $NONEXISTING = 'Non-esistente';
	public $SIZEKBD = 'Totale ammessi file caricati dimensioni per questo utente in KB. Valore di default è 2000 (2MB).';
	public $BLOGOWNER = 'Proprietario Blog';
	public $UPLOADDIR = 'Caricamento directory';
	public $UPLOADEDFILES = 'Files caricati';
	public $USEDSPACE = 'Spazio usato';
	public $LASTPOST = 'Ultimo post';
	public $LASTPOSTDATE = 'Ultima data post';
	public $NOTSETYET = 'Non ancora stabilito';
	public $UNOTALLUPLOADF = 'L\'utente non è autorizzato per caricare i file.';

	//elxis 2009.1
	public $INVDATE = 'La data selezionata non è valida.';
	public $METADESCDAY = "Posti per il %s su %s."; //Posts for DATE on EBLOG_TITLE
	public $NOPOSTSFDATE = 'Nessun post trovato per questa data.';
	public $SHAREPOST = 'Condividi questo articolo.';


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
	}

}

?>