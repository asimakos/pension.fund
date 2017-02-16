<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Frank Gijsels
* @link: http://elxis.onsnet.be
* @email: elxis@onsnet.be
* @description: Dutch language for component config
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

	public $A_COMP_CONF_OFFLINE = 'Website Offline';
	public $A_COMP_CONF_OFFMESSAGE = 'Offline Bericht';
	public $A_COMP_CONF_TIP_OFFMESSAGE = 'Een bericht dat getoond wordt wanneer de website Offline is';
	public $A_COMP_CONF_ERR_MESSAGE = 'Systeem Fout Bericht';
	public $A_COMP_CONF_TIP_ERR_MESSAGE = 'Bericht dat getoond wordt als Elxis geen verbinding kan leggen met de database';
	public $A_COMP_CONF_SITE_NAME = 'Website Naam';
	public $A_COMP_CONF_UN_LINKS = 'Toon niet geautoriseerde weblinks';
	public $A_COMP_CONF_UN_TIP = 'Wanneer ja is ingesteld, zullen weblinks naar geregistreerde artikelen getoond worden, zelfs wanneer je niet bent ingelogd. Gebruikers moeten inloggen om het volledig artikel te kunnen zien.';
	public $A_COMP_CONF_USER_REG = 'Gebruikersregistratie toestaan';
	public $A_COMP_CONF_TIP_USER_REG = 'Wanneer ja is ingesteld, kunnen gebruikers zich registreren';
	public $A_COMP_CONF_REQ_EMAIL = 'Uniek Email Vereist';
	public $A_COMP_CONF_REQTIP = 'Wanneer ja is ingesteld, kunnen gebruikers hetzelfde email adres niet gebruiken';
	public $A_COMP_CONF_DEBUG = 'Debug Website';
	public $A_COMP_CONF_DEBTIP = 'Wanneer ja is ingesteld, toont diagnostische informatie en SQL fouten (indien aanwezig)';
	public $A_COMP_CONF_EDITOR = 'WYSIWYG Tekstverwerker';
	public $A_COMP_CONF_LENGTH = 'Lengte Lijst';
	public $A_COMP_CONF_LENTIP = 'Stelt de standaard lijstlengte in op het controlepaneel voor alle gebruikers';
	public $A_COMP_CONF_FAV_ICON = 'Favorieten Website Icoon';
	public $A_COMP_CONF_FAVTIP = 'Indien leeg gelaten of wanneer het bestand niet gevonden kan worden, wordt het standaard favicon.ico gebruikt';
	public $A_COMP_CONF_CLINKACC = 'Componenten die gelinkt worden met het Toegangs Controle Systeem';
	public $A_COMP_CONF_CLACCDESC = 'Selecteer het type componenten waarvan je wil dat ze gelinkt worden aan het Toegangs Controle Systeem in het frontend (ACO waarde = Bekijken). Lees help als je niet zeker bent.';
	public $A_COMP_CONF_CORECOMPS = 'Core Componenten';
	public $A_COMP_CONF_3RDCOMPS = 'Third Party Componenten';
	public $A_COMP_CONF_ALLCOMPS = 'Alle Componenten';
	public $A_COMP_CONF_CAPTCHA = 'Gebruik Veiligheids Afbeeldingen';
	public $A_COMP_CONF_CAPTCHATIP = 'Stel in op Ja als je wil dat er veiligheids afbeeldingen (Captcha) moeten getoond worden in website formulieren. Om mensen met zichtproblemen te helpen is er ook de mogelijkheid voorzien om woorden te spellen.';
	public $A_COMP_CONF_LOCALE = 'Lokaal';
	public $A_COMP_CONF_LANG = 'Standaard Front-End Taal';
	public $A_COMP_CONF_ALANG = 'Standaard Back-End Taal';
	public $A_COMP_CONF_TIME_SET = 'Tijd Offset';
	public $A_COMP_CONF_DATE = 'Huidige datum/tijd configuratie';
	public $A_COMP_CONF_LOCAL = 'Landinstelling';
	public $A_COMP_CONF_LOCRECOM = 'Wij bevelen aan om deze te laten staan op Automatisch Selecteren. Elxis zal de meest geschikte landinstellingen laden voor uw systeem en taal. Windows ondersteund geen UTF-8 landinstellingen.';
	public $A_COMP_CONF_LOCCHECK = 'Controle Landinstellingen';
	public $A_COMP_CONF_LOCCHECK2 = 'Wanneer je ziet dat datum goed wordt weergegeven, dan zijn de landinstellingen goed voor uw systeem en taal.<br /><strong>Opgelet!</strong> Onder Windows worden de landinstellingen automatisch op Engels gezet.';
	public $A_COMP_CONF_AUTOSEL = 'Automatisch Selecteren';
	public $A_COMP_CONF_CONTROL = '* Deze parameters stellen de weer te geven elementen in *';
	public $A_COMP_CONF_LINK_TITLES = 'Gelinkte Titels';
	public $A_COMP_CONF_LTITLES_TIP = 'Wanneer ingesteld op ja dan gedraagt de titel van het artikel zich als een hyperlink naar het artikel';
	public $A_COMP_CONF_MORE_LINK = 'Lees Meer Link';
	public $A_COMP_CONF_MLINK_TIP = 'Wanneer ingesteld op toon, zal de lees-meer-link getoond worden als er hoofd-tekst is voorzien in het artikel';
	public $A_COMP_CONF_RATE_VOTE = 'Artikel Waardering/Stemmen';
	public $A_COMP_CONF_RVOTE_TIP = 'Wanneer ingesteld op toon dan wordt een stemsysteem ingeschakeld voor artikelen';
	public $A_COMP_CONF_AUTHOR = 'Naam Auteur';
	public $A_COMP_CONF_AUTHORTIP = 'Wanneer ingesteld op toon dan zal de naam van de auteur getoond worden. Dit is een globale instelling en kan veranderd worden op menu en artikel niveau';
	public $A_COMP_CONF_CREATED = 'Aanmaak Datum en Tijd';
	public $A_COMP_CONF_CREATEDTIP = 'Wanneer ingesteld op toon dan zal de tijd en datum dat het artikel is aangemaakt getoond worden. Dit is een globale instelling en kan veranderd worden op menu en artikel niveau';
	public $A_COMP_CONF_MOD_DATE = 'Aanpassings Datum en Tijd';
	public $A_COMP_CONF_MDATETIP = 'Wanneer ingesteld op toon dan zal de datum en tijd dat het artikel voor het laatst is aangepast worden getoond. Dit is een globale instelling en kan veranderd worden op menu en artikel niveau';
	public $A_COMP_CONF_HITS = 'Hits';
	public $A_COMP_CONF_HITSTIP = 'Wanneer ingesteld op toon dan zal het aantal hits op een bepaald artikel worden getoond. Dit is een globale instelling en kan veranderd worden op menu en artikel niveau';
	public $A_COMP_CONF_PDF = 'PDF Icoon';
	public $A_COMP_CONF_OPT_MEDIA = 'Deze optie is niet beschikbaar als de /tmpr map niet schrijfbaar is';
	public $A_COMP_CONF_PRINT_ICON = 'Print Icoon';
	public $A_COMP_CONF_EMAIL_ICON = 'Email Icoon';
	public $A_COMP_CONF_ICONS = 'Iconen';
	public $A_COMP_CONF_USE_OR_TEXT = 'Print, RTF, PDF & Email zullen iconen of tekst gebruiken';
	public $A_COMP_CONF_TBL_CONTENTS = 'Toon een inhoudsopgave bij artikelen met meerdere paginas';
	public $A_COMP_CONF_BACK_BUTTON = 'Terugknop';
	public $A_COMP_CONF_CONTENT_NAV = 'Artikelen Navigatie';
	public $A_COMP_CONF_HYPER = 'Gebruik Titels met een Hyperlink';
	public $A_COMP_CONF_DBTYPE = 'Database Type';
	public $A_COMP_CONF_DBWARN = 'Enkel wijzigen als je systeem deze database ondersteund en een kopie van Elxis gegevens is geïnstalleerd op deze database!';
	public $A_COMP_CONF_HOSTNAME = 'Hostnaam';
	public $A_COMP_CONF_DB_PW = 'Paswoord';
	public $A_COMP_CONF_DB_NAME = 'Database';
	public $A_COMP_CONF_DB_PREFIX = 'Database Voorvoegsel';
	public $A_COMP_CONF_NOT_CH = '!! ENKEL WIJZIGEN ALS JE EEN DATABASE HEBT MET TABELLEN DIE EEN VOORVOEGSEL HEBBEN ZOALS JIJ OPGEEFT !!';
	public $A_COMP_CONF_ABS_PATH = 'Absoluut Pad';
	public $A_COMP_CONF_LIVE = 'URL Website';
	public $A_COMP_CONF_SECRET = 'Geheim Woord';
	public $A_COMP_CONF_GZIP = 'GZIP Pagina Compressie';
	public $A_COMP_CONF_CP_BUFFER = 'Comprimeer buffered output indien ondersteund';
	public $A_COMP_CONF_SESSION_TIME = 'Sessie Levensduur';
	public $A_COMP_CONF_SEC = 'seconden';
	public $A_COMP_CONF_AUTO_LOGOUT = 'Na deze tijd van inactiviteit automatisch uitloggen';
	public $A_COMP_CONF_ERR_REPORT = 'Fouten Rapportage';
	public $A_COMP_CONF_HELP_SERVER = 'Help Server';
	public $A_COMP_CONF_META_PAGE = 'metadata-pagina';
	public $A_COMP_CONF_META_DESC = 'Globale Website Meta Omschrijving';
	public $A_COMP_CONF_META_KEY = 'Globale Website Meta trefwoorden';
	public $A_COMP_CONF_HPS1 = 'Lokale Help Bestanden';
	public $A_COMP_CONF_HPS2 = 'Elxis Remote Help Server';
	public $A_COMP_CONF_HPS3 = 'Officiële Elxis Help Server';
	public $A_COMP_CONF_PERMFLES = 'Selecteer deze optie om rechten te definiëren voor nieuwe bestanden';
	public $A_COMP_CONF_PERMDIRS = 'Selecteer deze optie om rechten te definiëren voor nieuwe mappen';
	public $A_COMP_CONF_NCHMODDIRS = 'Doe geen CHMOD op nieuwe mappen (gebruik server standaard)';
	public $A_COMP_CONF_CHAPFLAGS = 'Deze optie gebruiken zal de rechten wijzigen van <em>alle bestaande bestanden</em> van deze website.<br/><strong>FOUTIEF GEBRUIK VAN DEZE OPTIE KAN UW WEBSITE BUITEN WERKING STELLEN!</strong>';
	public $A_COMP_CONF_CHAPDLAGS = 'Deze optie gebruiken zal de rechten wijzigen van <em>alle bestaande mappen</em> van deze website.<br/><strong>FOUTIEF GEBRUIK VAN DEZE OPTIE KAN UW WEBSITE BUITEN WERKING STELLEN!</strong>';
	public $A_COMP_CONF_APPEXDIRS = 'Toepassen op alle bestaande Mappen';
	public $A_COMP_CONF_APPEXFILES = 'Toepassen op alle bestaande Bestanden';
	public $A_COMP_CONF_WORLD = 'Wereld';
	public $A_COMP_CONF_CHMODNDIRS = 'CHMOD nieuwe mappen';
	public $A_COMP_CONF_MAIL = 'Mailer';
	public $A_COMP_CONF_MAIL_FROM = 'Mail Van';
	public $A_COMP_CONF_MAIL_FROM_NAME = 'Van Naam';
	public $A_COMP_CONF_MAIL_SMTP_AUTH = 'SMTP Authenticatie';
	public $A_COMP_CONF_MAIL_SMTP_USER = 'SMTP Gebruiker';
	public $A_COMP_CONF_MAIL_SMTP_PASS = 'SMTP Wachtwoord';
	public $A_COMP_CONF_MAIL_SMTP_HOST = 'SMTP Host';
	public $A_COMP_CONF_CACHE = 'Caching';
	public $A_COMP_CONF_CACHE_FOLDER = 'Cache Map';
	public $A_COMP_CONF_CACHE_DIR = 'Huidige cache map is';
	public $A_COMP_CONF_CACHE_DIR_UNWRT = 'De cache map is ONSCHRIJFBAAR - maak deze map schrijfbaar vooraleer je de cache inschakelt';
	public $A_COMP_CONF_CACHE_TIME = 'Cache Tijd';
	public $A_COMP_CONF_STATS = 'Statistieken';
	public $A_COMP_CONF_STATS_ENABLE = 'Inschakelen/Uitschakelen van de website statistieken';
	public $A_COMP_CONF_STATS_LOG_HITS = 'Log Artikelen Hits op datum';
	public $A_COMP_CONF_STATS_WARN_DATA = 'WAARSCHUWING : Grote hoeveelheden data zullen verzameld worden';
	public $A_COMP_CONF_STATS_LOG_SEARCH = 'Log Zoekwoorden';
	public $A_COMP_CONF_SEO_LBL = 'SEO';
	public $A_COMP_CONF_SEO = 'Zoekmachine Optimalisatie';
	public $A_COMP_CONF_SEO_SEFU = 'Zoekmachine Vriendelijke URLs';
	public $A_COMP_CONF_SEOBASIC = 'SEO Basic';
	public $A_COMP_CONF_SEOPRO = 'SEO Pro';
	public $A_COMP_CONF_SEOHELP = 'Apache, Lighttpd en IIS. Apache, Lighttpd: hernoem htaccess.txt naar .htaccess vooraleer te activeren (mod_rewrite ingeschakeld). IIS: gebruik Ionic Isapi Rewriter filter. Vooraleer SEO PRO in te schakelen kan je het beste je artikelen voorbereiden. Selecteer SEO Basic als je een third party SEF component wil gebruiken.';
	public $A_COMP_CONF_SERVER = 'Server';
	public $A_COMP_CONF_METADATA = 'Metadata';
	public $A_COMP_CONF_CACHE_TAB = 'Cache';
	public $A_COMP_CONF_FTP_LBL = 'FTP';
	public $A_COMP_CONF_FTP = 'FTP Instellingen';
	public $A_COMP_CONF_FTP_ENB = 'FTP inschakelen';
	public $A_COMP_CONF_FTP_HST = 'FTP Host';
	public $A_COMP_CONF_FTP_HSTTP = 'Meest waarschijnlijk';
	public $A_COMP_CONF_FTP_USR = 'FTP Gebruikersnaam';
	public $A_COMP_CONF_FTP_USRTP = 'Meest waarschijnlijk';
	public $A_COMP_CONF_FTP_PAS = 'FTP Paswoord';
	public $A_COMP_CONF_FTP_PRT = 'FTP Poort';
	public $A_COMP_CONF_FTP_PRTTP = 'Standaard waarde is: 21';
	public $A_COMP_CONF_FTP_PTH = 'FTP Root Pad';
	public $A_COMP_CONF_FTP_PTHTP = 'Pad van FTP root tot uw Elxis installatie. (bijv: /public_html/elxis)';
	public $A_COMP_CONF_HIDE = 'Verberg';
	public $A_COMP_CONF_SHOW = 'Toon';
	public $A_COMP_CONF_DEFAULT = 'Systeem Standaard';
	public $A_COMP_CONF_NONE = 'Geen';
	public $A_COMP_CONF_SIMPLE = 'Eenvoudig';
	public $A_COMP_CONF_MAX = 'Maximum';
	public $A_COMP_CONF_MAIL_FC = 'PHP mail functie';
	public $A_COMP_CONF_SEND = 'Sendmail';
	public $A_COMP_CONF_SENDP = 'Sendmail pad';
	public $A_COMP_CONF_SMTP = 'SMTP Server';
	public $A_COMP_CONF_UPDATED = 'De configuratie instellingen zijn <strong>opgeslagen!</strong>';
	public $A_COMP_CONF_ERR_OCC = '<strong>Er is een fout opgetreden!</strong> Kan het configuratie bestand niet openen om te schrijven!';
	public $A_COMP_CONF_READ = 'lezen';
	public $A_COMP_CONF_WRITE = 'schrijven';
	public $A_COMP_CONF_EXEC = 'uitvoeren';
	public $A_COMP_CONF_FCRE = 'Bestanden Aanmaken';
	public $A_COMP_CONF_FPERM = 'Bestandsrechten';
	public $A_COMP_CONF_DCRE = 'Mappen Aanmaken';
	public $A_COMP_CONF_DPERM = 'Map Rechten';
	public $A_COMP_CONF_OFFEX = 'Ja (enkel voor Administrators)';
	public $A_COMP_CONF_RTF = 'RTF Icoon';

	//2008.1
	public $A_C_CONF_AC_ACT = 'Account Activatie';
	public $A_C_CONF_NOACT = 'Geen activatie';
	public $A_C_CONF_EMACT = 'Activatie via e-mail';
	public $A_C_CONF_MANACT = 'Handmatige activatie';
	public $A_C_CONF_AC_ACTD = 'Selecteer hoe je wil dat nieuwe gebruiker accounts geactiveerd worden. Onmiddellijk, via een activatie link in een e-mail of handmatig door de website administrator.';

	//2009.0
	public $A_C_CONF_COMMENTS = 'Commentaar';
	public $A_C_CONF_COMMENTSTIP = 'Wanneer ingesteld op toon, zal er getoond worden hoeveel maal er commentaar is geschreven voor een bepaald artikel. Dit is een globale instelling en kan veranderd worden op menu en artikel niveau';
	public $A_C_CONF_CHKFTP = 'Controleer FTP instellingen';
	public $A_C_CONF_STDCACHE = 'Standaard cache';
	public $A_C_CONF_STATCACHE = 'Statische cache';
	public $A_C_CONF_CACHED = 'Standaard Cache caches gedeeltelijke paginas terwijl Statische Cache de gehele pagina. Static Cache is aanbevolen voor veel bezochte Websites. Om statische cache te gebruiken moet je SEO PRO hebben ingeschakeld.';
	public $A_C_CONF_SEODIS = 'SEO PRO is uitgeschakeld!';

	public function __construct() {	
	}

}

?>