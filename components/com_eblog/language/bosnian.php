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
* @description: Bosanski jezik za komponentu eBlog
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
	public $UNKNOWNTAG = 'Nepoznati tag';
	public $PERMLINK = 'Stalni link';
	public $COMMENTS = 'Komentari';
	public $COMMENT = 'Komentar'; //(noun, i.e. 1 comment)
	public $NOCOMMENTS = 'Nema komentara.';
	PUBLIC $MUSTLOGTOCOM = 'Morate se prijaviti prije ostavljanja komentara.';
	public $POSTCOMMENT = 'Ostavite komentar';
	public $YOURCOMMENT = 'Vaš komentar';
	public $NALLPOSTCOM = 'Nije Vam dozvoljeno kometarisanje!';
	public $MUSTWRITEMSG = 'Morate unijeti poruku!';
	public $COMADDSUC = 'Vaš komentar je uspješno dodat!';
	public $WAITRETRY = 'Molimo Vas probajte nakon par sekundi ponovo!';
	public $NALLPERFACT = 'Ovo što pokušavate uraditi nije Vam dozvoljeno!';
	public $ARTNOFOUND = 'Ne mogu pronaći traženu poruku!';
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
	public $SETTINGS = 'Postavke';
	public $CSSFILE = 'CSS fajl';
	public $RTLCSSFILE = 'RTL CSS fajl';
	public $COMMENTARY = 'Komentarisanje';
	public $NOTALLOWED = 'Nedozvoljeno'; //Commentary
	public $REGUSERS = 'Registovani korisnici'; //Commentary
	public $ALLOWEDALL = 'Dozvoljeno svima'; //Commentary
	public $POSTSNUMBER = 'Broj postova';
	public $POSTSNUMBERD = 'Broj najnovijih postova za prikaz na naslovnoj strani.';
	public $SHOWTAGSD = 'Uključite ili isključite prikaz tagova ispod postova.';
	public $CSSFILED = 'Stil koji će Vaš blog koristiti. CSS sadrži informacije o izgledu, fontovima, bojama, i općem izgledu bloga.';
	public $RTLCSSFILED = 'Stil koji će Vaš blog koristiti za prikaz na jezicima koji se čitaju sdesna nalijevo, kao što su persijski ili hebrejski.';
	public $OPTION = 'Opcija';
	public $VALUE = 'Vrijednost';
	public $HELP = 'Pomoć';
	public $NEWPOST = 'Novi post';
	public $EDITPOST = 'Uredite post';
	public $TITLENOEMPTY = 'Naslov ne može ostati prazan!';
	public $FOLDERCNOTCR = "Direktorij %s ne može biti kreiran!"; //%s: folder name
	public $DIMENSIONS = 'Dimenzije (Š x V)';
	public $SIZEKB = 'Veličina (KB)';
	public $LISTVIEW = 'Lista';
	public $THUMBSVIEW = 'Sličice';
	public $UPLOAD = 'Dodavanje';
	public $UPLOADIMG = 'Dodavanje slike';
	public $MEDIAMAN = 'Upravljač medija';
	public $YOUTUBEVIDEO = 'YouTube video';
	public $GOOGLEVIDEO = 'Google video';
	public $YAHOOVIDEO = 'Yahoo video';
	public $COMSEPTAGS = 'Zarezom odvojeni tagovi';
	public $SLOGAN = 'Slogan';
	public $SLOGAND = 'Slogan koji će biti prikazan u zaglavlju Vašeg bloga. Možete koristiti html.';
	public $SHOWOWNER = 'Prikaz vlasnika';
	public $SHOWOWNERD = 'Prikaz imena vlasnika bloga u zaglavlju?';
	public $SHOWARCHIVE = 'Prikaz arhiva';
	public $SHOWARCHIVED = 'Prikaz arhiva mjeseci u footeru bloga?';

	//SEO titles
	public $SEOTITLE = 'SEO naslov';
	public $SEOTITLEEMPTY = 'SEO naslov ne može biti prazan!';
	public $INVALID = 'Neispravno';
	public $VALID = 'Ispravno';
	public $SEOTEXIST = 'SEO naslov već postoji!';
	public $SEOTLARGER = 'Probajte sa dužim naslovom!';
	public $SEOTHELP = 'Morate koristiti mala latinična slova, brojeve, kose crte i podcrte. SEO naslov mora biti jedinstven! Probajte unijeti razumljiv i jedinstven SEO naslov.';
	public $SEOTSUG = 'Predloženi SEO naslov';
	public $SEOTVAL = 'Provijera SEO naslova';

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
	public $CANCONFIGD = 'Hoće li vlasnik bloga imati mogućnost uređivanja putem javnog dijela site-a?';
	public $CANUPLOADD = 'Želite li omogućiti vlasniku bloga dodavanje multimedijalnih sadržaja?';
	public $BLOGOWNMDIR = 'Direktorij medija vlasnika bloga';
	public $EXISTING = 'Postojeći';
	public $NONEXISTING = 'Nepostojeći';
	public $SIZEKBD = 'Maksimalna veličina fajlova koje je moguće dodati, dana u KB. Uobičajena vrjednost je 2000 (2MB).';
	public $BLOGOWNER = 'Vlasnik bloga';
	public $UPLOADDIR = 'Direktorijum dodavanja';
	public $UPLOADEDFILES = 'Dodani fajlovi';
	public $USEDSPACE = 'Iskorišteni prostor';
	public $LASTPOST = 'Poslijednji post';
	public $LASTPOSTDATE = 'Datum poslijednjeg posta';
	public $NOTSETYET = 'Nije podešeno';
	public $UNOTALLUPLOADF = 'Korisniku nije dozvoljeno dodavanje fajlova.';

	//elxis 2009.1
	public $INVDATE = 'The date you selected is invalid.';
	public $METADESCDAY = "Posts for %s on %s"; //Posts for DATE on EBLOG_TITLE
	public $NOPOSTSFDATE = 'No posts found for this date.';
	public $SHAREPOST = 'Share this post';


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
	}

}

?>