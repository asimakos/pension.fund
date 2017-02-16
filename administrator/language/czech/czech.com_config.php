<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: PARACOM Software
* @link: http://www.elxis.cz
* @email: info@elxis.cz
* @description: Czech language for component config
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

	public $A_COMP_CONF_OFFLINE = 'Stránky offline';
	public $A_COMP_CONF_OFFMESSAGE = 'Offline zpráva';
	public $A_COMP_CONF_TIP_OFFMESSAGE = 'Tato zpráva se zobrazí návštěvníkům Vašich stránek v režimu offline';
	public $A_COMP_CONF_ERR_MESSAGE = 'Systémová chybová zpráva';
	public $A_COMP_CONF_TIP_ERR_MESSAGE = 'Tato zpráva se zobrazí návštěvníkům Vašich stránek, pokud Elxis nebude mít spojení s databází';
	public $A_COMP_CONF_SITE_NAME = 'Jméno stránek';
	public $A_COMP_CONF_UN_LINKS = 'Zobrazit neautorizované odkazy';
	public $A_COMP_CONF_UN_TIP = 'Při volbě Ano se zobrazí odkaz pro registraci. Uživatelé se musí přihlásit do systému, aby mohly procházet obsah stránek v plném rozsahu.';
	public $A_COMP_CONF_USER_REG = 'Povolit registraci uživatelů';
	public $A_COMP_CONF_TIP_USER_REG = 'Volba ANO umožní uživatelům registraci do systému';
	public $A_COMP_CONF_REQ_EMAIL = 'Vyžadovat unikátní email';
	public $A_COMP_CONF_REQTIP = 'Při volbě Ano, musí uživatel Zadat unikátní email';
	public $A_COMP_CONF_DEBUG = 'Testovat stránky';
	public $A_COMP_CONF_DEBTIP = 'Při volbě Ano se na displeji zobrazí výpis přístupů do databáze MySQL';
	public $A_COMP_CONF_EDITOR = 'WYSIWYG Editor';
	public $A_COMP_CONF_LENGTH = 'Délka seznamu';
	public $A_COMP_CONF_LENTIP = 'Nastavení defaultního počtu zobrazených položek na stránku v administrační části';
	public $A_COMP_CONF_FAV_ICON = 'Ikona stránek';
	public $A_COMP_CONF_FAVTIP = 'Pokud políčko zůstane prázdné, nebo soubor ikony nebude nalezen, zobrazí se defaultní ikona Elxis';
	public $A_COMP_CONF_CLINKACC = 'Komponenty spojené s přístupovým systémem';
	public $A_COMP_CONF_CLACCDESC = 'Vyberte typ komponent, které chcete použít pro přístupový řídící systém na hlavních stránkách (ACO hodnota = zobrazení). Pokud si nejste jisti, čtěte nápovědu.';
	public $A_COMP_CONF_CORECOMPS = 'Místní komponenty';
	public $A_COMP_CONF_3RDCOMPS = 'Komponenty třetí strany';
	public $A_COMP_CONF_ALLCOMPS = 'Všechny komponenty';
	public $A_COMP_CONF_CAPTCHA = 'Použití bezpečnostního obrázku';
	public $A_COMP_CONF_CAPTCHATIP = 'Zvolte Ano, chcete-li použít bezpečnostní obrázky (Captcha) formulářů uvnitř stránky. Pro návštěvníky s poruchou zraku je k dispozici možnost nechat si text obrázku přečíst.';
	public $A_COMP_CONF_LOCALE = 'Lokalizace';
	public $A_COMP_CONF_LANG = 'Výchozí jazyk stránek';
	public $A_COMP_CONF_ALANG = 'Výchozí jazyk administrace';
	public $A_COMP_CONF_TIME_SET = 'Časový posun';
	public $A_COMP_CONF_DATE = 'Aktuálně zobrazovaný datum/čas';
	public $A_COMP_CONF_LOCAL = 'Lokalita Státu';
	public $A_COMP_CONF_LOCRECOM = 'Doporučujeme ponechat automatický výběr. Elxis načte nastavení operačního systému a nastaví vhodný jazyk automaticky.';
	public $A_COMP_CONF_LOCCHECK = 'Ověření lokality';
	public $A_COMP_CONF_LOCCHECK2 = 'Pokud je formát datumu zobrazen správně, tak systém strávně lokalizoval nastavení Vašeho systému a nastavil i jazyk stránek.';
	public $A_COMP_CONF_AUTOSEL = 'Automatický výběr';
	public $A_COMP_CONF_CONTROL = '* Tyto parametry určují konečné vlastnosti položek obsahu Vašich stránek *';
	public $A_COMP_CONF_LINK_TITLES = 'Klikatelný nadpis';
	public $A_COMP_CONF_LTITLES_TIP = 'Při volbě Ano se bude titulek chovat jako odkaz na položku';
	public $A_COMP_CONF_MORE_LINK = 'Odkaz Čtěte více';
	public $A_COMP_CONF_MLINK_TIP = 'Při volbě Ukázat se zobrazí odkaz pro přečtení celého článku';
	public $A_COMP_CONF_RATE_VOTE = 'Položka Hodnotit/Hlasovat';
	public $A_COMP_CONF_RVOTE_TIP = 'Při volbě Ukázat se aktivuje hodnocení článků';
	public $A_COMP_CONF_AUTHOR = 'Jméno autora';
	public $A_COMP_CONF_AUTHORTIP = 'Při volbě Ukázat, bude zobrazeno jméno autora položky. Toto je defaultní nastavení a lze operativně měnit v nastavení jednotlivých položek menu i jednotlivých položek';
	public $A_COMP_CONF_CREATED = 'Datum a čas vytvoření';
	public $A_COMP_CONF_CREATEDTIP = 'Při volbě Ukázat, bude zobrazen datum a čas vytvoření položky. Toto je defaultní nastavení a lze operativně měnit v nastavení menu i jednotlivých položek';
	public $A_COMP_CONF_MOD_DATE = 'Datum a čas úpravy';
	public $A_COMP_CONF_MDATETIP = 'Při volbě Ukázat, bude zobrazen datum a čas poslední úpravy položky. Toto je defaultní nastavení a lze operativně měnit v nastavení menu i jednotlivých položek';
	public $A_COMP_CONF_HITS = 'Hitů';
	public $A_COMP_CONF_HITSTIP = 'Při volbě Ukázat, bude zobrazen počet přečtení/otevření položky. Toto je defaultní nastavení a lze operativně měnit v nastavení nenu i jednotlivých položek';
	public $A_COMP_CONF_PDF = 'Ikona PDF';
	public $A_COMP_CONF_OPT_MEDIA = 'Volba není dostupná jelikož /tmpr adresář nemá právo zápisu';
	public $A_COMP_CONF_PRINT_ICON = 'Ikona tisk';
	public $A_COMP_CONF_EMAIL_ICON = 'Ikona email';
	public $A_COMP_CONF_ICONS = 'Ikony';
	public $A_COMP_CONF_USE_OR_TEXT = 'Pro tisk, RTF, PDF & email budou použity ikony nebo text';
	public $A_COMP_CONF_TBL_CONTENTS = 'Tabulka obsahu multi-stránkových položek';
	public $A_COMP_CONF_BACK_BUTTON = 'Tlačítko Zpět';
	public $A_COMP_CONF_CONTENT_NAV = 'Navigace položky článku';
	public $A_COMP_CONF_HYPER = 'Použít Hiperlinkových titulů';
	public $A_COMP_CONF_DBTYPE = 'Typ databáze';
	public $A_COMP_CONF_DBWARN = '!! NEMĚNIT !! Systém Elxis je připojen na zobrazenou databázi!';
	public $A_COMP_CONF_HOSTNAME = 'Jméno hostitele';
	public $A_COMP_CONF_DB_PW = 'Přístupové heslo';
	public $A_COMP_CONF_DB_NAME = 'Jméno  atabáze';
	public $A_COMP_CONF_DB_PREFIX = 'Předpona tabulek';
	public $A_COMP_CONF_NOT_CH = '!! NEMĚNIT! POKUD NEMÁTE VYTVOŘENOU DATABÁZI S PŘEDPONOU, KTEROU HODLÁTE ZADAT !!';
	public $A_COMP_CONF_ABS_PATH = 'Absolutní cesta';
	public $A_COMP_CONF_LIVE = 'Adresa stránek';
	public $A_COMP_CONF_SECRET = 'Kryté heslo';
	public $A_COMP_CONF_GZIP = 'GZIP komprese stránek';
	public $A_COMP_CONF_CP_BUFFER = 'Komprimuje vyrovnávací paměť výstupu (pokud je podporováno)';
	public $A_COMP_CONF_SESSION_TIME = 'Doba přihlášení do systému';
	public $A_COMP_CONF_SEC = 'sekund';
	public $A_COMP_CONF_AUTO_LOGOUT = 'Autoodhlášení ze systému při nečinnosti po nastavený čas';
	public $A_COMP_CONF_ERR_REPORT = 'Zprávy o chybách';
	public $A_COMP_CONF_HELP_SERVER = 'Server nápovědy';
	public $A_COMP_CONF_META_PAGE = 'metadata-page';
	public $A_COMP_CONF_META_DESC = 'Hlavní popis webu';
	public $A_COMP_CONF_META_KEY = 'Hlavní klíčová slova';
	public $A_COMP_CONF_HPS1 = 'Místní soubory nápovědy';
	public $A_COMP_CONF_HPS2 = 'Vzdálený Elxis server nápovědy';
	public $A_COMP_CONF_HPS3 = 'Oficiální Elxis server nápovědy';
	public $A_COMP_CONF_PERMFLES = 'Zvolte práva přístupu pro nové soubory';
	public $A_COMP_CONF_PERMDIRS = 'Zvolte práva přístupu pro nové složky';
	public $A_COMP_CONF_NCHMODDIRS = 'Výchozí nastavení CHMOD pro nové adresáře podle nastavení serveru';
	public $A_COMP_CONF_CHAPFLAGS = 'Nastavení změní práva <em>všem souborům</em> stránek.<br/><strong>NEVHODNÁ VOLBA MŮŽE ZPŮSOBIT NEFUNKČNOST STRÁNEK!</strong>';
	public $A_COMP_CONF_CHAPDLAGS = 'Nastavení změní práva <em>všem adresářům</em> stránek.<br/><strong>NEVHODNÁ VOLBA MŮŽE ZPŮSOBIT NEFUNKČNOST STRÁNEK!</strong>';
	public $A_COMP_CONF_APPEXDIRS = 'Aplikovat na existující adresáře';
	public $A_COMP_CONF_APPEXFILES = 'Aplikovat na existující soubory';
	public $A_COMP_CONF_WORLD = 'Svět';
	public $A_COMP_CONF_CHMODNDIRS = 'CHMOD pro nové adresáře';
	public $A_COMP_CONF_MAIL = 'Poštovní klient';
	public $A_COMP_CONF_MAIL_FROM = 'Poslat z';
	public $A_COMP_CONF_MAIL_FROM_NAME = 'Od (jméno)';
	public $A_COMP_CONF_MAIL_SMTP_AUTH = 'SMTP';
	public $A_COMP_CONF_MAIL_SMTP_USER = 'SMTP Uživatel';
	public $A_COMP_CONF_MAIL_SMTP_PASS = 'SMTP Heslo';
	public $A_COMP_CONF_MAIL_SMTP_HOST = 'SMTP Hostitel';
	public $A_COMP_CONF_CACHE = 'Caching';
	public $A_COMP_CONF_CACHE_FOLDER = 'Cache složka';
	public $A_COMP_CONF_CACHE_DIR = 'Aktuální cache adresář je';
	public $A_COMP_CONF_CACHE_DIR_UNWRT = 'Do cache složky NELZE ZAPISOVAT - prosím nastavte práva CHMOD na 777 před nastavením cache';
	public $A_COMP_CONF_CACHE_TIME = 'Cache čas';
	public $A_COMP_CONF_STATS = 'Statistiky';
	public $A_COMP_CONF_STATS_ENABLE = 'Povolí/zakáže uchovávat statistiky stránek';
	public $A_COMP_CONF_STATS_LOG_HITS = 'Zaznamenat Hity článků podle data';
	public $A_COMP_CONF_STATS_WARN_DATA = 'VAROVÁNÍ : Bude shromážděno velké množství dat!';
	public $A_COMP_CONF_STATS_LOG_SEARCH = 'Zaznamenat hledávané výrazy';
	public $A_COMP_CONF_SEO_LBL = 'SEO';
	public $A_COMP_CONF_SEO = 'Optimalizace pro vyhledávače';
	public $A_COMP_CONF_SEO_SEFU = 'URL přátelské k vyhledávačům';
	public $A_COMP_CONF_SEOBASIC = 'SEO Basic';
	public $A_COMP_CONF_SEOPRO = 'SEO Pro';
	public $A_COMP_CONF_SEOHELP = "Apache, Lighttpd a IIS. Apache: přejmenujte htaccess.txt na .htaccess před aktivací (mod_rewrite enabled). IIS: použít Ionic Isapi přepisovací filtr. Pro maximální výkon přejmenujte SEO tituly Vašich článků před aktivací SEO PRO. SEO Basic zvolte pro použití jiných SEF component.";
	public $A_COMP_CONF_SERVER = 'Server';
	public $A_COMP_CONF_METADATA = 'Metadata';
	public $A_COMP_CONF_CACHE_TAB = 'Cache';
	public $A_COMP_CONF_FTP_LBL = 'FTP';
	public $A_COMP_CONF_FTP = 'Nastavení FTP';
	public $A_COMP_CONF_FTP_ENB = 'Povolit FTP';
	public $A_COMP_CONF_FTP_HST = 'FTP Hostitel';
	public $A_COMP_CONF_FTP_HSTTP = 'Nejčastěji';
	public $A_COMP_CONF_FTP_USR = 'FTP Uživatel';
	public $A_COMP_CONF_FTP_USRTP = 'Nejčastěji';
	public $A_COMP_CONF_FTP_PAS = 'FTP Heslo';
	public $A_COMP_CONF_FTP_PRT = 'FTP Port';
	public $A_COMP_CONF_FTP_PRTTP = 'Defaultně hodnota: 21';
	public $A_COMP_CONF_FTP_PTH = 'FTP Root cesta';
	public $A_COMP_CONF_FTP_PTHTP = 'Cesta pro FTP root pro Vaší Elxis instalaci. Např. /public_html/elxis';
	public $A_COMP_CONF_HIDE = 'Skrýt';
	public $A_COMP_CONF_SHOW = 'Ukázat';
	public $A_COMP_CONF_DEFAULT = 'Výchozí systémový';
	public $A_COMP_CONF_NONE = 'Žádný';
	public $A_COMP_CONF_SIMPLE = 'Jednoduchý';
	public $A_COMP_CONF_MAX = 'Maximum';
	public $A_COMP_CONF_MAIL_FC = 'PHP poštovní funkce';
	public $A_COMP_CONF_SEND = 'Sendmail';
	public $A_COMP_CONF_SENDP = 'Sendmail cesta';
	public $A_COMP_CONF_SMTP = 'SMTP Server';
	public $A_COMP_CONF_UPDATED = 'Konfigurace byla <strong>aktualizována!</strong>';
	public $A_COMP_CONF_ERR_OCC = '<strong>Nastala chyba!</strong> Nelze zapisovat do konfiguračního souboru!';
	public $A_COMP_CONF_READ = 'čtení';
	public $A_COMP_CONF_WRITE = 'zápis';
	public $A_COMP_CONF_EXEC = 'vykonávání';
	public $A_COMP_CONF_FCRE = 'Vytvoření souboru';
	public $A_COMP_CONF_FPERM = 'Práva souboru';
	public $A_COMP_CONF_DCRE = 'Vytvoření adresáře';
	public $A_COMP_CONF_DPERM = 'Práva adresáře';
	public $A_COMP_CONF_OFFEX = 'Ano (s vyjímkou superadministrátora)';
	public $A_COMP_CONF_RTF = 'Ikona RTF';
	public $A_C_CONF_AC_ACT = 'Aktivace účtu';
	public $A_C_CONF_NOACT = 'Bez aktivace';
	public $A_C_CONF_EMACT = 'Aktivace přes e-mail';
	public $A_C_CONF_MANACT = 'Manuální aktivace';
	public $A_C_CONF_AC_ACTD = 'Zvolte, jak mají být aktivovány nové uživatelské účty. Aktivačním odkazem přes email nebo manuálně administrátorem na stránkách.';

	//2009.0
	public $A_C_CONF_COMMENTS = 'Komentáře';
	public $A_C_CONF_COMMENTSTIP = 'Zobrazení početu komentářů pro specifickou obsahovou položku. Toto je globální nastavení, které může být změněno v nabídkových a položkových úrovních.';
	public $A_C_CONF_CHKFTP = 'Kontrola FTP nastavení';
	public $A_C_CONF_STDCACHE = 'Standardní cache';
	public $A_C_CONF_STATCACHE = 'Statická cache';
	public $A_C_CONF_CACHED = 'Standardní vyrovnávací paměť ukládá neúplné bloky stránky kdežto Statická cache celou stránku. Statická Cache je doporučena pro složité stránky a při její použití musí být povolen mód SEO PRO.';
	public $A_C_CONF_SEODIS = 'SEO PRO je zakázán!';
	public $A_COMP_CONF_SEO_DYN = 'Dynamický titul stránky';
	public $A_COMP_CONF_SEO_DYN_TITLE = 'Dynamický titul stránky podle aktuálně zobrazeného obsahu';

	public function __construct() {	
	}

}

?>