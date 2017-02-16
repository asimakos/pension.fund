<?php 
/**
* @version: 2009.1
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component eBlog
* @author: Elxis Team
* @translator: Sandra Dismar (owl)
* @link: http://www.wivw.de
* @email: dismar@wivw.de
* @description: German language for component eBlog
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class eBlogLang {


	public $ELXISBLOG = 'Elxis Blog';
	public $TAGS = 'Tags';
	public $UNKNOWNTAG = 'Unbekannter tag';
	public $PERMLINK = 'Permanenter Link';
	public $COMMENTS = 'Kommentare';
	public $COMMENT = 'Kommentar'; //(noun, i.e. 1 comment)
	public $NOCOMMENTS = 'Es sind keine Kommentare vorhanden.';
	PUBLIC $MUSTLOGTOCOM = 'Sie müssen sich erst einloggen um Kommentare hinterlassen zu können.';
	public $POSTCOMMENT = 'Kommentar hinterlassen';
	public $YOURCOMMENT = 'Ihr Kommentar';
	public $NALLPOSTCOM = 'Es ist Ihnen nicht gestattet Kommentare zu hinterlassen!';
	public $MUSTWRITEMSG = 'Sie müssen eine Nachricht eingeben!';
	public $COMADDSUC = 'Ihr Kommentar wurde erfolgreich hinzugefügt!';
	public $WAITRETRY = 'Bitte versuchen Sie es nach einigen Sekunden nochmals!';
	public $NALLPERFACT = 'Sie sind nicht berechtigt diese Aktion auszuführen!';
	public $ARTNOFOUND = 'Konnte den angeforderten Beitrag nicht finden!';
	public $POSTSTAGASAT = "Beitrag getaggt als %s am %s"; //example: Posts tagged as computer at ElectroBlog;
	public $ARCHIVES = 'Archive';
	public $USERBLOGSAT = "Benutzer bloggt auf der Seite %s"; //s: site name
	public $USERBLOGS = 'Benutzer bloggt';
	public $THEREAREBLOGS = "Es gibt %s Blogs"; //s: number of available blogs
	public $POSTS = 'Beiträge';

	//control panel
	public $CPANEL = 'Kontrollzentrum';
	public $MANBLOG = 'Verwalten Sie Ihr Blog';
	public $ALLPOSTS = 'Alle Beiträge';
	public $LATESTPOSTS = "Die letzten %s Beiträge";
	public $SETTINGS = 'Einstellungen';
	public $CSSFILE = 'CSS-Datei';
	public $RTLCSSFILE = 'RTL-CSS-Datei';
	public $COMMENTARY = 'Kommentar';
	public $NOTALLOWED = 'Nicht gestattet'; //Commentary
	public $REGUSERS = 'Registrierte Benutzer'; //Commentary
	public $ALLOWEDALL = 'Allen gestattet'; //Commentary
	public $POSTSNUMBER = 'Beitragszahl';
	public $POSTSNUMBERD = 'Anzahl aktueller Beiträge, die auf der Blogstartseite angezeigt werden sollen.';
	public $SHOWTAGSD = 'Bitte auswählen, falls Sie die Anzeige von Tags unterhalb des Beitrags wünschen.';
	public $CSSFILED = 'Im Blog zu verwendendes Stylesheet. CSS legt das Gesamtlayout, die Schriften, Farben Ihres Blogs fest.';
	public $RTLCSSFILED = 'Stylesheet, das bei Sprachen, die von rechts nach links (z.B. Persisch oder Hebräisch), verwendet werden soll.';
	public $OPTION = 'Option';
	public $VALUE = 'Wert';
	public $HELP = 'Hilfe';
	public $NEWPOST = 'Neuer Beitrag';
	public $EDITPOST = 'Beitrag editieren';
	public $TITLENOEMPTY = 'Titel kann nicht leer sein!';
	public $FOLDERCNOTCR = "Ordner %s konnte nicht angelegt werden!"; //%s: folder name
	public $DIMENSIONS = 'Abmessungen (W x H)';
	public $SIZEKB = 'Gröίe (KB)';
	public $LISTVIEW = 'Listenansicht';
	public $THUMBSVIEW = 'Thumbnailansicht';
	public $UPLOAD = 'Upload';
	public $UPLOADIMG = 'Bild hochladen';
	public $MEDIAMAN = 'Medienmanager';
	public $YOUTUBEVIDEO = 'YouTube-Video';
	public $GOOGLEVIDEO = 'Google-Video';
	public $YAHOOVIDEO = 'Yahoo-Video';
	public $COMSEPTAGS = 'Durch Komma getrennte Tags';
	public $SLOGAN = 'Slogan';
	public $SLOGAND = 'Slogan, der in Ihrem Blog-Header angezeigt werden soll. HTML kann verwendet werden.';
	public $SHOWOWNER = 'Besitzer anzeigen';
	public $SHOWOWNERD = 'Besitzer im Blog-Header anzeigen?';
	public $SHOWARCHIVE = 'Archiv anzeigen';
	public $SHOWARCHIVED = 'Monatsarchiv im Blog-Footer anzeigen?';

	//SEO titles
	public $SEOTITLE = 'SEO-Titel';
	public $SEOTITLEEMPTY = 'SEO-Titel kann nicht leer sein!';
	public $INVALID = 'Falsch';
	public $VALID = 'Richtig';
	public $SEOTEXIST = 'SEO-Titel existiert bereits!';
	public $SEOTLARGER = 'Versuchen Sie einen längeren Titel!';
	public $SEOTHELP = 'Sie können nur Kleinbuchstaben (keine Umlaute/Sonderzeichen), Ziffern, Binde- und Unterstriche verwenden. SEO-Titel muss eindeutig sein! Versuchen Sie eindeutige und aussagekräftige SEO-Titel zu verwenden.';
	public $SEOTSUG = 'Vorgeschlagener SEO-Titel';
	public $SEOTVAL = 'Prüfe SEO-Titel';

	//languages names
	public $ARMENIAN = 'Armenisch';
	public $BOZNIAN = 'Bosnisch';
	public $BRAZILIAN = 'Brasilianisch';
	public $BULGARIAN = 'Bulgarisch';
	public $CREOLE = 'Kreolisch';
	public $CROATIAN = 'Kroatisch';
	public $DANISH = 'Dänisch';
	public $ENGLISH = 'Englisch';
	public $FRENCH = 'Französisch';
	public $GERMAN = 'Deutsch';
	public $GREEK = 'Griechisch';
	public $INDONESIAN = 'Indonesisch';
	public $ITALIAN = 'Italienisch';
	public $JAPANESE = 'Japanisch';
	public $LATVIAN = 'Lettisch';
	public $LITHUANIAN = 'Litauisch';
	public $PERSIAN = 'Persisch';
	public $POLISH = 'Polnisch';
	public $RUSSIAN = 'Russisch';
	public $SERBIAN = 'Serbisch';
	public $SPANISH = 'Spanisch';
	public $SRPSKI = 'Srpski';
	public $TURKISH = 'Türkisch';
	public $VIETNAMESE = 'Vietnamesisch';

	//backend
	public $BLOGINFO = 'Blog-Informationen';
	public $CANCONFIGD = 'Auswählen, wenn Sie möchten, dass der Blogbesitzer vom Frontend aus Blog-Einstellungen ändern können soll.';
	public $CANUPLOADD = 'Auswählen, wenn Sie möchten, dass der Blogbesitzer Medien hochladen können soll.';
	public $BLOGOWNMDIR = 'Medienverzeichnis des Blogbesitzers';
	public $EXISTING = 'Vorhanden';
	public $NONEXISTING = 'Nicht vorhanden';
	public $SIZEKBD = 'Zulässige Gesamtgröίer aller hochgeladenen Bilder dieses Benutzers (in KB). Voreinstellung: 2000 (2MB).';
	public $BLOGOWNER = 'Blogbesitzer';
	public $UPLOADDIR = 'Upload-Verzeichnis';
	public $UPLOADEDFILES = 'Hochgeladene Dateien';
	public $USEDSPACE = 'Verwendeter Speicherplatz';
	public $LASTPOST = 'Letzter Beitrag';
	public $LASTPOSTDATE = 'Datum des letzten Beitrags';
	public $NOTSETYET = 'Noch nicht gesetzt';
	public $UNOTALLUPLOADF = 'Diesem Benutzer ist es nicht gestattet Dateien hochzuladen.';

	//elxis 2009.1
	public $INVDATE = 'Die von Ihnen ausgewählte Datum ist ungültig.';
	public $METADESCDAY = "Beiträge für %s %s."; //Posts for DATE on EBLOG_TITLE
	public $NOPOSTSFDATE = 'Keine Beiträge für dieses Datum.';
	public $SHAREPOST = 'Stellen Sie in diesem Artikel';


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
	}

}

?>