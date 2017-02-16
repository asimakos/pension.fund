<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ivan Trebješanin
* @link: http://www.elxis-srbija.org
* @email: admin@elxis-srbija.org
* @description: Serbian language for component config
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

	public $A_COMP_CONF_OFFLINE = 'Sajt je nedostupan';
	public $A_COMP_CONF_OFFMESSAGE = 'Poruka o nedostupnosti';
	public $A_COMP_CONF_TIP_OFFMESSAGE = 'Poruka koja će biti prikazana kada je sajt nedostupan';
	public $A_COMP_CONF_ERR_MESSAGE = 'Poruka o sistemskoj grešci';
	public $A_COMP_CONF_TIP_ERR_MESSAGE = 'Poruka koja će biti prikazana ukoliko Elxis ne može da se poveže sa bazom';
	public $A_COMP_CONF_SITE_NAME = 'Ime sajta';
	public $A_COMP_CONF_UN_LINKS = 'Prikaz neautorizovanih linkova';
	public $A_COMP_CONF_UN_TIP = 'Postavljeno na Da, prikazaće linkove namenjene registrovanim korisnicima. Korisnici moraju da se prijave kako bi sadržaj videli u potpunosti.';
	public $A_COMP_CONF_USER_REG = 'Samostalna registracija';
	public $A_COMP_CONF_TIP_USER_REG = 'Postavljeno na Da, dozvoliće korisnicima da se samostalno registruju';
	public $A_COMP_CONF_REQ_EMAIL = 'Jedinstvena adresa e-pošte';
	public $A_COMP_CONF_REQTIP = 'Postavljeno na Da, onemogućiće da korisnici dele istu adresu e-pošte';
	public $A_COMP_CONF_DEBUG = 'Debagovanje';
	public $A_COMP_CONF_DEBTIP = 'Postavljeno na Da, prikazaće dijagnostičke informacije i SQL greške';
	public $A_COMP_CONF_EDITOR = 'WYSIWYG Editor';
	public $A_COMP_CONF_LENGTH = 'Dužina liste';
	public $A_COMP_CONF_LENTIP = 'Predefiniše dužinu liste za administratora i korisnike';
	public $A_COMP_CONF_FAV_ICON = 'Ikona favorizovanih sajtova';
	public $A_COMP_CONF_FAVTIP = 'Ukoliko je ovo prazno, ili fajl ne postoji, predefinisana favicon.ico će biti korišćena';
	public $A_COMP_CONF_CLINKACC = 'Komponente povezane sa pristupnim sistemom';
	public $A_COMP_CONF_CLACCDESC = 'Izaberite komponente na koje će biti primenjen sistem kontrole pristupa kroz javni interfejs (ACO vrednost = pregled). Pročitajte Pomoć ukoliko niste sigurni.';
	public $A_COMP_CONF_CORECOMPS = 'Osnovne komponente';
	public $A_COMP_CONF_3RDCOMPS = 'Dodatne komponente';
	public $A_COMP_CONF_ALLCOMPS = 'Sve komponente';
	public $A_COMP_CONF_CAPTCHA = 'Upotreba sigurnosnih slika';
	public $A_COMP_CONF_CAPTCHATIP = 'Da, ukoliko želite da slike (Captcha) budu prikazane na formama. Izgovor zaštitnog kôda će biti omogućen za ljude koji imaju poteškoća sa vidom.';
	public $A_COMP_CONF_LOCALE = 'Lokalizacija';
	public $A_COMP_CONF_LANG = 'Predefinisani jezik interfejsa';
	public $A_COMP_CONF_ALANG = 'Predefinisani jezik administracije';
	public $A_COMP_CONF_TIME_SET = 'Vremensko odstupanje';
	public $A_COMP_CONF_DATE = 'Trenutna konfiguracija datuma/vremena za prikaz';
	public $A_COMP_CONF_LOCAL = 'Lokalizacija zemlje';
	public $A_COMP_CONF_LOCRECOM = 'Preporučljivo je ostaviti na automatskom izboru. Elxis će učitati odgovarajuću lokalizaciju na osnovu izabranog jezika i operativnog sistema. Windows ne podržava UTF-8 lokalizacije.';
	public $A_COMP_CONF_LOCCHECK = 'Provera lokalizacije';
	public $A_COMP_CONF_LOCCHECK2 = 'Ukoliko je datum koji vidite dobro formatiran, znači da lokalizacija odgovara Vašem operativnom sistemu i izabranom jeziku.<br /><strong>Pažnja!</strong> Pod Windows-om, lokalizacija će automatski biti podešena na English.';
	public $A_COMP_CONF_AUTOSEL = 'Automatski izbor';
	public $A_COMP_CONF_CONTROL = '* Ovi parametri kontrolišu izlazne elemente *';
	public $A_COMP_CONF_LINK_TITLES = 'Linkovani naslovi';
	public $A_COMP_CONF_LTITLES_TIP = 'Postavljeno na Da, povezaće naslov sa odgovarajućom stavkom sadržaja';
	public $A_COMP_CONF_MORE_LINK = 'Link opširnije';
	public $A_COMP_CONF_MLINK_TIP = 'Ukoliko je uključeno, link opširnije će biti prikazan za stavke koje imaju glavni tekst';
	public $A_COMP_CONF_RATE_VOTE = 'Vrednovanje/Glasanje';
	public $A_COMP_CONF_RVOTE_TIP = 'Ukoliko je uključeno, sistem glasanja će biti omogućen za datu stavku sadržaja';
	public $A_COMP_CONF_AUTHOR = 'Imena autora';
	public $A_COMP_CONF_AUTHORTIP = 'Ukoliko je uključeno, ime autora će biti prikazano. Ovo je opšte podešavanje koje može biti izmenjeno na nivou stavke sadržaja ili menija';
	public $A_COMP_CONF_CREATED = 'Datum i vreme nastanka';
	public $A_COMP_CONF_CREATEDTIP = 'Ukoliko je uključeno, biće prikazani datum i vreme nastanka stavke. Ovo je opšte podešavanje koje može biti izmenjeno na nivou stavke sadržaja ili menija';
	public $A_COMP_CONF_MOD_DATE = 'Datum i vreme zadnje izmene';
	public $A_COMP_CONF_MDATETIP = 'Ukoliko je uključeno, biće prikazani datum i vreme zadnje izmene stavke sadržaja. Ovo je opšte podešavanje koje može biti izmenjeno na nivou stavke sadržaja ili menija';
	public $A_COMP_CONF_HITS = 'Pregleda';
	public $A_COMP_CONF_HITSTIP = 'Ukoliko je uključeno, biće prikazan broj čitanja za datu stavku sadržaja. Ovo je opšte podešavanje koje može biti izmenjeno na nivou stavke sadržaja ili menija';
	public $A_COMP_CONF_PDF = 'PDF ikona';
	public $A_COMP_CONF_OPT_MEDIA = 'Opcija nije dostupna jer /tmpr direktorijum nije otključan';
	public $A_COMP_CONF_PRINT_ICON = 'Ikona štampe';
	public $A_COMP_CONF_EMAIL_ICON = 'Ikona e-pošte';
	public $A_COMP_CONF_ICONS = 'Ikone';
	public $A_COMP_CONF_USE_OR_TEXT = 'Štampa, RTF, PDF i e-pošta će koristiti ikone ili tekst';
	public $A_COMP_CONF_TBL_CONTENTS = 'Sadržaj za višestrane tekstove';
	public $A_COMP_CONF_BACK_BUTTON = 'Dugme nazad';
	public $A_COMP_CONF_CONTENT_NAV = 'Navigacija stavke sadržaja';
	public $A_COMP_CONF_HYPER = 'Upotreba linkovanih naslova';
	public $A_COMP_CONF_DBTYPE = 'Tip baze';
	public $A_COMP_CONF_DBWARN = 'Ne menjajte ovo ukoliko Vaš sistem ne podržava ovu bazu i nemate Elxis podatke već instalirane na ovoj bazi!';
	public $A_COMP_CONF_HOSTNAME = 'Domaćin';
	public $A_COMP_CONF_DB_PW = 'Lozinka';
	public $A_COMP_CONF_DB_NAME = 'Baza';
	public $A_COMP_CONF_DB_PREFIX = 'Prefiks baze';
	public $A_COMP_CONF_NOT_CH = '!! NE MENJAJTE OVO UKOLIKO NEMATE BAZU SA PREFIKSOM KOJI POKUŠAVATE DA PRIMENITE !!';
	public $A_COMP_CONF_ABS_PATH = 'Apsolutna putanja';
	public $A_COMP_CONF_LIVE = '"Živi" sajt';
	public $A_COMP_CONF_SECRET = 'Tajna reč';
	public $A_COMP_CONF_GZIP = 'GZIP kompresija';
	public $A_COMP_CONF_CP_BUFFER = 'Kompresija bafera je moguća';
	public $A_COMP_CONF_SESSION_TIME = 'Dužina sesije';
	public $A_COMP_CONF_SEC = 'sekundi';
	public $A_COMP_CONF_AUTO_LOGOUT = 'Automatska odjava nakon ovoliko sekundi';
	public $A_COMP_CONF_ERR_REPORT = 'Prijava grešaka';
	public $A_COMP_CONF_HELP_SERVER = 'Server pomoći';
	public $A_COMP_CONF_META_PAGE = 'metapodaci-stranica';
	public $A_COMP_CONF_META_DESC = 'Opšta meta-podešavanja za sajt';
	public $A_COMP_CONF_META_KEY = 'Opšte ključne reči za sajt';
	public $A_COMP_CONF_HPS1 = 'Lokalni fajlovi pomoći';
	public $A_COMP_CONF_HPS2 = 'Elxis-ov udaljeni server pomoći';
	public $A_COMP_CONF_HPS3 = 'Zvanični Elxis server pomoći';
	public $A_COMP_CONF_PERMFLES = 'Izaberite ovu opciju ukoliko želite da primenite dozvole na nove fajlove';
	public $A_COMP_CONF_PERMDIRS = 'Izaberite ovu opciju ukoliko želite da primenite dozvole na nove direktorijume';
	public $A_COMP_CONF_NCHMODDIRS = 'Bez CHMOD-ovanja novih direktorijuma (koristi predefinicije severa)';
	public $A_COMP_CONF_CHAPFLAGS = 'Ukoliko je štiklirano, primeniće dozvole na <em>sve postojeće fajlove</em> sajta.<br/><strong>NEPRAVILNA UPOTREBA OVE OPCIJE MOŽE SAJT UČINITI NEUPOTREBLjIVIM!</strong>';
	public $A_COMP_CONF_CHAPDLAGS = 'Ukoliko je štiklirano, primeniće dozvole na <em>sve postojeće direktorijume</em> sajta.<br/><strong>NEPRAVILNA UPOTREBA OVE OPCIJE MOŽE SAJT UČINITI NEUPOTREBLjIVIM!</strong>';
	public $A_COMP_CONF_APPEXDIRS = 'Primena na postojeće direktorijume';
	public $A_COMP_CONF_APPEXFILES = 'Primena na postojeće fajlove';
	public $A_COMP_CONF_WORLD = 'Svi';
	public $A_COMP_CONF_CHMODNDIRS = 'CHMOD novih direktorijuma';
	public $A_COMP_CONF_MAIL = 'Poštar';
	public $A_COMP_CONF_MAIL_FROM = 'Pošta od';
	public $A_COMP_CONF_MAIL_FROM_NAME = 'Od';
	public $A_COMP_CONF_MAIL_SMTP_AUTH = 'SMTP autorizacija';
	public $A_COMP_CONF_MAIL_SMTP_USER = 'SMTP korisnik';
	public $A_COMP_CONF_MAIL_SMTP_PASS = 'SMTP lozinka';
	public $A_COMP_CONF_MAIL_SMTP_HOST = 'SMTP domaćin';
	public $A_COMP_CONF_CACHE = 'Keširanje';
	public $A_COMP_CONF_CACHE_FOLDER = 'Direktorijum keša';
	public $A_COMP_CONF_CACHE_DIR = 'Trenutni direktorijum keša je';
	public $A_COMP_CONF_CACHE_DIR_UNWRT = 'Direktorijum keša je ZAKLjUČAN - postavite CHMOD na 777 pre nego što uključite keš';
	public $A_COMP_CONF_CACHE_TIME = 'Vreme keširanja';
	public $A_COMP_CONF_STATS = 'Statistike';
	public $A_COMP_CONF_STATS_ENABLE = 'Uknjučeno/isključeno prikupljanje statistika';
	public $A_COMP_CONF_STATS_LOG_HITS = 'Broj pregleda po datumu';
	public $A_COMP_CONF_STATS_WARN_DATA = 'UPOZORENjE : Biće prikupljena velika količina podataka';
	public $A_COMP_CONF_STATS_LOG_SEARCH = 'Evidencija kriterijuma pretrage';
	public $A_COMP_CONF_SEO_LBL = 'SEO';
	public $A_COMP_CONF_SEO = 'Search Engine Optimization';
	public $A_COMP_CONF_SEO_SEFU = 'Search Engine Friendly URLs';
	public $A_COMP_CONF_SEOBASIC = 'SEO Basic';
	public $A_COMP_CONF_SEOPRO = 'SEO Pro';
	public $A_COMP_CONF_SEOHELP = "Apache i IIS. Apache: preimenujte htaccess.txt u .htaccess pre aktivacije (mod_rewrite uključen). IIS: koristite Ionic Isapi Rewriter filter. Za najbolje performanse, pripremite sadžaj za SEO PRO. Izaberite SEO Basic ukoliko koristite nezavisnu SEF komponentu.";
	public $A_COMP_CONF_SERVER = 'Server';
	public $A_COMP_CONF_METADATA = 'Metapodaci';
	public $A_COMP_CONF_CACHE_TAB = 'Keš';
	public $A_COMP_CONF_FTP_LBL = 'FTP';
	public $A_COMP_CONF_FTP = 'FTP podešavanja';
	public $A_COMP_CONF_FTP_ENB = 'Uključen FTP';
	public $A_COMP_CONF_FTP_HST = 'FTP domaćin';
	public $A_COMP_CONF_FTP_HSTTP = 'Najverovatnije';
	public $A_COMP_CONF_FTP_USR = 'FTP korisničko ime';
	public $A_COMP_CONF_FTP_USRTP = 'Najverovatnije';
	public $A_COMP_CONF_FTP_PAS = 'FTP lozinka';
	public $A_COMP_CONF_FTP_PRT = 'FTP port';
	public $A_COMP_CONF_FTP_PRTTP = 'Uobičajena vrednost je: 21';
	public $A_COMP_CONF_FTP_PTH = 'FTP koren';
	public $A_COMP_CONF_FTP_PTHTP = 'Putanja od FTP korena do Elxis instalacije. Npr. /public_html/elxis';
	public $A_COMP_CONF_HIDE = 'Skriveno';
	public $A_COMP_CONF_SHOW = 'Prikazano';
	public $A_COMP_CONF_DEFAULT = 'Predefinisano';
	public $A_COMP_CONF_NONE = 'Ništa';
	public $A_COMP_CONF_SIMPLE = 'Jednostavno';
	public $A_COMP_CONF_MAX = 'Maksimum';
	public $A_COMP_CONF_MAIL_FC = 'PHP funkcija pošte';
	public $A_COMP_CONF_SEND = 'Sendmail';
	public $A_COMP_CONF_SENDP = 'Sendmail putanja';
	public $A_COMP_CONF_SMTP = 'SMTP server';
	public $A_COMP_CONF_UPDATED = 'Podešavanja su uspešno <strong>sačuvana!</strong>';
	public $A_COMP_CONF_ERR_OCC = '<strong>Došlo je do greške!</strong> Ne mogu da otvorim konfiguracioni fajl za pisanje!';
	public $A_COMP_CONF_READ = 'čitanje';
	public $A_COMP_CONF_WRITE = 'pisanje';
	public $A_COMP_CONF_EXEC = 'izvršavanje';
	public $A_COMP_CONF_FCRE = 'Kreiranje fajlova';
	public $A_COMP_CONF_FPERM = 'Dozvole fajlova';
	public $A_COMP_CONF_DCRE = 'Kreiranje direktorijuma';
	public $A_COMP_CONF_DPERM = 'Dozvole direktorijuma';
	public $A_COMP_CONF_OFFEX = 'Da (osim za Superadministratore)';
	public $A_COMP_CONF_RTF = 'RTF Ikona';
	public $A_C_CONF_AC_ACT = 'Aktivacija naloga';
	public $A_C_CONF_NOACT = 'Bez aktivacija';
	public $A_C_CONF_EMACT = 'Aktivacija putem e-pošte';
	public $A_C_CONF_MANACT = 'Ručna aktivacija';
	public $A_C_CONF_AC_ACTD = 'Izaberite način aktivacije naloga novih korisnika. Direktno, putem aktivacionog linka, poslatog e-poštom ili ručnom aktivacijom od strane administratora.';

	//2009.0
	public $A_C_CONF_COMMENTS = 'Komentari';
	public $A_C_CONF_COMMENTSTIP = 'Ukoliko postavite na Prikazano, broj komentara za izabrani sadržaj biće prikazan. Ovo opšte podešavanje može biti izmenjeno na nivou stavki menija ili sadržaja';
	public $A_C_CONF_CHKFTP = 'Provera FTP podešavanja';
	public $A_C_CONF_STDCACHE = 'Standardni keš';
	public $A_C_CONF_STATCACHE = 'Statički keš';
	public $A_C_CONF_CACHED = 'Standardni keš kešira delove stranica, dok Statički keš kešira cele stranice. Statički keš je preporučljiv za veoma posećene sajtove. Da biste koristili Statički keš, morate da uključite SEO PRO.';
	public $A_C_CONF_SEODIS = 'SEO PRO je isključen!';

	public function __construct() {	
	}

}

?>