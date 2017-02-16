<?php 
/**
* @version: 2009.1
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component eBlog
* @author: Elxis Team
* @translator: Ivan Trebješanin
* @link: http://www.elxis-srbija.org
* @email: admin@elxis-srbija.org
* @description: Srpska latinica za komponentu eBlog
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class eBlogLang {


	public $ELXISBLOG = 'Elxis Blog';
	public $TAGS = 'Tagovi';
	public $UNKNOWNTAG = 'Nepoznat tag';
	public $PERMLINK = 'Stalni link';
	public $COMMENTS = 'Komentari';
	public $COMMENT = 'Komentar'; //(noun, i.e. 1 comment)
	public $NOCOMMENTS = 'Nema komentara.';
	PUBLIC $MUSTLOGTOCOM = 'Morate se prijaviti pre nego što postavite komentar.';
	public $POSTCOMMENT = 'Postavite komentar';
	public $YOURCOMMENT = 'Vaš komentar';
	public $NALLPOSTCOM = 'Nije Vam dozvoljeno kometarisanje!';
	public $MUSTWRITEMSG = 'Morate uneti poruku!';
	public $COMADDSUC = 'Vaš komentar je uspešno dodat!';
	public $WAITRETRY = 'Molimo Vas da probate nakon par sekundi ponovo!';
	public $NALLPERFACT = 'Ovo što pokušavate da uradite nije Vam dozvoljeno!';
	public $ARTNOFOUND = 'Ne mogu da pronađem zahtevanu poruku!';
	public $POSTSTAGASAT = "Postovi sa tagom %s na %s"; //example: Posts tagged as computer at ElectroBlog";
	public $ARCHIVES = 'Arhiv';
	public $USERBLOGSAT = "Blogovi korisnika na %s"; //s: site name
	public $USERBLOGS = 'Blogovi korisnika';
	public $THEREAREBLOGS = "Postoji %s blogova"; //s: number of available blogs
	public $POSTS = 'Poruke';

	//control panel
	public $CPANEL = 'Kontrolna tabla';
	public $MANBLOG = 'Uređivanje bloga';
	public $ALLPOSTS = 'Svi postovi';
	public $LATESTPOSTS = "Najnovijih %s postova";
	public $SETTINGS = 'Podešavanja';
	public $CSSFILE = 'CSS fajl';
	public $RTLCSSFILE = 'RTL CSS fajl';
	public $COMMENTARY = 'Komentator';
	public $NOTALLOWED = 'Nedozvoljeno'; //Commentary
	public $REGUSERS = 'Registrovani korisnici'; //Commentary
	public $ALLOWEDALL = 'Dozvoljeno svima'; //Commentary
	public $POSTSNUMBER = 'Broj postova';
	public $POSTSNUMBERD = 'Broj najnovijih postova za prikaz na naslovnoj strani.';
	public $SHOWTAGSD = 'Uključite ili isključite prikaz tagova ispod postova.';
	public $CSSFILED = 'Stil koji će Vaš blog koristiti. CSS sadrži informacije o izgledu, fontovima, bojama, i opštem izgledu bloga.';
	public $RTLCSSFILED = 'Stil koji će Vaš blog koristiti za prikaz na jezicima koji se čitaju sdesna nalevo, kao što su persijski ili hebrejski.';
	public $OPTION = 'Opcija';
	public $VALUE = 'Vrednost';
	public $HELP = 'Pomoć';
	public $NEWPOST = 'Novi post';
	public $EDITPOST = 'Uredite post';
	public $TITLENOEMPTY = 'Naslov ne može ostati prazan!';
	public $FOLDERCNOTCR = "Direktorijum %s ne može biti kreiran!"; //%s: folder name
	public $DIMENSIONS = 'Dimenzijnj (Š x V)';
	public $SIZEKB = 'Veličina (KB)';
	public $LISTVIEW = 'Lista';
	public $THUMBSVIEW = 'Sličice';
	public $UPLOAD = 'Dodavanje';
	public $UPLOADIMG = 'Dodavanje slike';
	public $MEDIAMAN = 'Menadžer medija';
	public $YOUTUBEVIDEO = 'YouTube video';
	public $GOOGLEVIDEO = 'Google video';
	public $YAHOOVIDEO = 'Yahoo video';
	public $COMSEPTAGS = 'Zarezom odvojeni tagovi';
	public $SLOGAN = 'Slogan';
	public $SLOGAND = 'Slogan koji će biti prikazan u zaglavlju Vašeg bloga. Možete koristiti html.';
	public $SHOWOWNER = 'Prikaz vlasnika';
	public $SHOWOWNERD = 'Prikaz imena vlasnika bloga u zaglavlju?';
	public $SHOWARCHIVE = 'Prikaz arhiva';
	public $SHOWARCHIVED = 'Prikaz arhiva meseci u futeru bloga?';

	//SEO titles
	public $SEOTITLE = 'SEO naslov';
	public $SEOTITLEEMPTY = 'SEO naslov ne može biti prazan!';
	public $INVALID = 'Neispravno';
	public $VALID = 'Ispravno';
	public $SEOTEXIST = 'SEO naslov već postoji!';
	public $SEOTLARGER = 'Probajte sa dužim naslovom!';
	public $SEOTHELP = 'Morate koristiti mala latinična slova, brojeve, kose crte i podcrte. SEO naslov mora biti jedinstven! Probajte da unesete razumljiv i jedinstven SEO naslov.';
	public $SEOTSUG = 'Predloženi SEO naslov';
	public $SEOTVAL = 'Provera SEO naslova';

	//languages names
	public $ARMENIAN = 'Jermenski';
	public $BOZNIAN = 'Bosanski';
	public $BRAZILIAN = 'Brazlski';
	public $BULGARIAN = 'Bugarski';
	public $CREOLE = 'Kreolski';
	public $CROATIAN = 'Hrvatski';
	public $DANISH = 'Danski';
	public $ENGLISH = 'Engleski';
	public $FRENCH = 'Francuski';
	public $GERMAN = 'Nemački';
	public $GREEK = 'Grčki';
	public $INDONESIAN = 'Indonezijski';
	public $ITALIAN = 'Italijanski';
	public $JAPANESE = 'Japanski';
	public $LATVIAN = 'Letonski';
	public $LITHUANIAN = 'Litvanski';
	public $PERSIAN = 'Persijski';
	public $POLISH = 'Poljski';
	public $RUSSIAN = 'Ruski';
	public $SERBIAN = 'Srpski';
	public $SPANISH = 'Španski';
	public $SRPSKI = 'Српски';
	public $TURKISH = 'Turski';
	public $VIETNAMESE = 'Vijetnamski';

	//backend
	public $BLOGINFO = 'Informacije o blogu';
	public $CANCONFIGD = 'Da li će vlasnik bloga imati mogućnost uređivanja putem javnog dela sajta?';
	public $CANUPLOADD = 'Da li želite da omogućite vlasniku bloga da dodaje multimedijalne sadržaje?';
	public $BLOGOWNMDIR = 'Direktorijum medija vlasnika bloga';
	public $EXISTING = 'Postojeći';
	public $NONEXISTING = 'Nepostojeći';
	public $SIZEKBD = 'Maksimalna veličina fajlova koje je moguće dodati, data u KB. Uobičajena vrednost je 2000 (2MB).';
	public $BLOGOWNER = 'Vlasnika bloga';
	public $UPLOADDIR = 'Direktorijum dodavanja';
	public $UPLOADEDFILES = 'Dodati fajlovi';
	public $USEDSPACE = 'Upotrebljeni prostor';
	public $LASTPOST = 'Poslednji post';
	public $LASTPOSTDATE = 'Datum poslednjeg posta';
	public $NOTSETYET = 'Nije podešeno';
	public $UNOTALLUPLOADF = 'Korisniku nije dozvoljeno dodavanje fajlova.';

  //elxis 2009.1
	public $INVDATE = 'Datum koji ste izabrali nije ispravan.';
	public $METADESCDAY = "Poruke za %s na %s"; //Posts for DATE on EBLOG_TITLE
	public $NOPOSTSFDATE = 'Nema poruka pronađenih za ovaj datum.';
	public $SHAREPOST = 'Podeli ovaj članak';



	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
	}

}

?>
