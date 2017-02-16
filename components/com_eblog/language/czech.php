<?php 
/**
* @version: 2009.1
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Elxis Team
* @translator: PARACOM Software
* @link: http://elxis.cz
* @email: info@elxis.cz
* @description: Czech language for component eBlog
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Přístup do této lokace není povolen.' );


class eBlogLang {


	public $ELXISBLOG = 'Elxis Blog';
	public $TAGS = 'Tagy';
	public $UNKNOWNTAG = 'Neznámý tag';
	public $PERMLINK = 'Stálý odkaz';
	public $COMMENTS = 'Komentáře';
	public $COMMENT = 'Komentáře'; //(noun, i.e. 1 comment)
	public $NOCOMMENTS = 'Žádný komentář.';
	PUBLIC $MUSTLOGTOCOM = 'Pro odeslámí komentáře musíte být přihlášeni.';
	public $POSTCOMMENT = 'Vložte komentář';
	public $YOURCOMMENT = 'Váš komentář';
	public $NALLPOSTCOM = 'Nemáte oprávnění pro vkládání komentářů!';
	public $MUSTWRITEMSG = 'Musíte napsat zprávu!';
	public $COMADDSUC = 'Váš komentář byl úspěšně přidán!';
	public $WAITRETRY = 'Prosím, opakujte o několik sekund později!';
	public $NALLPERFACT = 'Nemáte přístup k vykonávání této akce!';
	public $ARTNOFOUND = 'Nemožné nalézt požadovanou zprávu!';
	public $POSTSTAGASAT = "Zprávy označeny jako %s v %s"; //example: Posts tagged as computer at ElectroBlog";
	public $ARCHIVES = 'Archivy';
	public $USERBLOGSAT = "Uživatelské blogy v %s"; //s: site name
	public $USERBLOGS = 'Uživatelské blogy';
	public $THEREAREBLOGS = "Zde je %s dostupných blogů"; //s: number of available blogs
	public $POSTS = 'Zprávy';

	//control panel
	public $CPANEL = 'Kontrolní panel';
	public $MANBLOG = 'Správa Vašeho blogu';
	public $ALLPOSTS = 'Všechny zprávy';
	public $LATESTPOSTS = "Poslední %s zprávy";
	public $SETTINGS = 'Nastavení';
	public $CSSFILE = 'CSS soubor';
	public $RTLCSSFILE = 'RTL CSS soubor';
	public $COMMENTARY = 'Komentář';
	public $NOTALLOWED = 'Nepřístupné'; //Commentary
	public $REGUSERS = 'Registrovaní uživatelé'; //Commentary
	public $ALLOWEDALL = 'Přístupné všem'; //Commentary
	public $POSTSNUMBER = 'Pošta číslo';
	public $POSTSNUMBERD = 'Číslo nejnovější zprávy k zobrazení na úvodní stránce blogu.';
	public $SHOWTAGSD = 'Zvolte, zda si přejete zobrazit tagy pod poštou.';
	public $CSSFILED = 'Styl Vašeho blogu. CSS převezme dohled nad všemi layouty, fonty, barvami a celkévým vzhledem blogu.';
	public $RTLCSSFILED = 'Pro styl na Vašem blogu použijte správný jazyk.';
	public $OPTION = 'Nastavení';
	public $VALUE = 'Hodnota';
	public $HELP = 'Help';
	public $NEWPOST = 'Nová pošta';
	public $EDITPOST = 'Editovat poštu';
	public $TITLENOEMPTY = 'Titulek nesmí být prázdný!';
	public $FOLDERCNOTCR = "Složka %s nemůže být vytvořena!"; //%s: folder name
	public $DIMENSIONS = 'Rozměry (W x H)';
	public $SIZEKB = 'Velikost (KB)';
	public $LISTVIEW = 'Pohled';
	public $THUMBSVIEW = 'Miniatury';
	public $UPLOAD = 'Nahrát';
	public $UPLOADIMG = 'Nahrát obrázek';
	public $MEDIAMAN = 'Manažer médií';
	public $YOUTUBEVIDEO = 'YouTube video';
	public $GOOGLEVIDEO = 'Google video';
	public $YAHOOVIDEO = 'Yahoo video';
	public $COMSEPTAGS = 'Uvozovkama oddělené tagy';
	public $SLOGAN = 'Slogan';
	public $SLOGAND = 'Slogan k zobrazení v hlavičce stránky. Můžete použít html.';
	public $SHOWOWNER = 'Ukázat vlastníka';
	public $SHOWOWNERD = 'Ukázat vlastníkovo jméno v headeru blogu?';
	public $SHOWARCHIVE = 'Ukazát archiv';
	public $SHOWARCHIVED = 'Ukázat měsíce archivování ve footeru blogu?';

	//SEO titles
	public $SEOTITLE = 'SEO titul';
	public $SEOTITLEEMPTY = 'SEO titul nesmí být prázdný!';
	public $INVALID = 'Neplatné';
	public $VALID = 'Platné';
	public $SEOTEXIST = 'SEO titul již existuje!';
	public $SEOTLARGER = 'Zkuste delší titul!';
	public $SEOTHELP = 'Můžete používat jen malá písmenka znakové sady latin, čísla, pomlčky a podtržítka. SEO titul musí být unikátní! Zkuste vložit unikátní a smysluplný SEO titul.';
	public $SEOTSUG = 'Navrhovaný SEO titul';
	public $SEOTVAL = 'Potvrdit SEO titul';

	//languages names
	public $ARMENIAN = 'Armenian';
	public $BOZNIAN = 'Bosnian';
	public $BRAZILIAN = 'Brazilian';
	public $BULGARIAN = 'Bulgarian';
	public $CREOLE = 'Creole';
	public $CROATIAN = 'Croatian';
	public $DANISH = 'Danish';
	public $ENGLISH = 'Angličtina';
	public $FRENCH = 'French';
	public $GERMAN = 'Němčina';
	public $GREEK = 'Greek';
	public $INDONESIAN = 'Indonesian';
	public $ITALIAN = 'Italian';
	public $JAPANESE = 'Japanese';
	public $LATVIAN = 'Latvian';
	public $LITHUANIAN = 'Lithuanian';
	public $PERSIAN = 'Persian';
	public $POLISH = 'Polština';
	public $RUSSIAN = 'Russian';
	public $SERBIAN = 'Serbian';
	public $SPANISH = 'Spanish';
	public $SRPSKI = 'Srpski';
	public $TURKISH = 'Turkish';
	public $VIETNAMESE = 'Vietnamese';

	//backend
	public $BLOGINFO = 'Informace blogu';
	public $CANCONFIGD = 'Zvolte, zda si přejete vlastníkovi blogu zpřístupnit nastavení blogu z front-end.';
	public $CANUPLOADD = 'Zvolte, zda si přejete vlastníkovi blogu zpřístupnit nahrávání souborů médií.';
	public $BLOGOWNMDIR = 'Adresář médií vlastníka blogu';
	public $EXISTING = 'Existující';
	public $NONEXISTING = 'Neexistující';
	public $SIZEKBD = 'Povolená velikost nahrávaných souborů pro tohoto uživatelev Kb. Základní hodnota je 2000 (2MB).';
	public $BLOGOWNER = 'Vlastník blogu';
	public $UPLOADDIR = 'Nahrávací adresář';
	public $UPLOADEDFILES = 'Nahrané soubory';
	public $USEDSPACE = 'Použitý prostor';
	public $LASTPOST = 'Poslední pošta';
	public $LASTPOSTDATE = 'Poslední pošta data';
	public $NOTSETYET = 'Ještě nenastaveno';
	public $UNOTALLUPLOADF = 'Uživatel nemá oprávnění k nahrávání souborů.';

	//elxis 2009.1
	public $INVDATE = 'Vámi zvolené datum je neplatné.';
	public $METADESCDAY = "Příspěvky na rok %s na %s."; //Posts for DATE on EBLOG_TITLE
	public $NOPOSTSFDATE = 'Nalezeny žádné příspěvky k tomuto datu.';
	public $SHAREPOST = 'Sdílet tento článek.';


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
	}

}

?>