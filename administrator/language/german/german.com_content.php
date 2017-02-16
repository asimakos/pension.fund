<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Siegmund Langsch
* @link: http://www.langschnet.de
* @email: s.langsch@langhscnet.de
* @description: German language for component content
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direkter Zugriff auf diesen Ort ist nicht erlaubt.' );


class adminLanguage extends standardLanguage {

public $A_CMP_CNT_ITEMSMNG = 'Verwaltung der Inhalte';
public $A_CMP_CNT_DATEFORMAT = 'Y-m-d H:i:s';
public $A_CMP_CNT_ALTEDITCONT = 'Inhalt bearbeiten';
public $A_CMP_CNT_TRASH = 'Treffen sie eine Auswahl aus der Liste, um die gewählten Elemente in den Mülleimer zu verschieben';
public $A_CMP_CNT_TRASHMESS = 'Sind sie sicher, das sie die gewählten Elemente in den Mülleimer verschieben wollen? Dadurch werden diese Elemente nicht permanent gelöscht.';
public $A_CMP_CNT_ARCHMANAGER = 'Verwaltung Archive';
public $A_CMP_CNT_DATECREATED = '%A, %d %B %Y %H:%M';
public $A_CMP_CNT_DATEMODIFIED = '%A, %d %B %Y %H:%M';
public $A_CMP_CNT_MUSTTITLE = 'Inhalt Items müssen einen Titel haben.';
public $A_CMP_CNT_MUSTSECTN = 'Sie müssen eine Sektion auswählen.';
public $A_CMP_CNT_MUSTCATEG = 'Sie müssen eine Kategorie auswählen.';
public $A_CMP_CNT_CONTITEM = 'Inhalts Item';
public $A_CMP_CNT_ITEMDETLS = 'Item Details';
public $A_CMP_CNT_INTRO = 'Intro Text: (erforderlich)';
public $A_CMP_CNT_MAIN = 'Haupttext: (optional)';
public $A_CMP_CNT_FRONTPAGE = 'Zeige auf der Startseite';
public $A_CMP_CNT_AUTHOR = 'Autor Alias';
public $A_CMP_CNT_CREATOR = 'Ersteller ändern';
public $A_CMP_CNT_OVERRIDE = 'Überschreibe Erstellungsdatum';
public $A_CMP_CNT_STRTPUB = 'Starte Veröffentlichung';
public $A_CMP_CNT_FNSHPUB = 'Beende Veröffentlichung';
public $A_CMP_CNT_DRFTUNPUB = 'Entwurf nicht veröffentlicht';
public $A_CMP_CNT_RESETHIT = 'Zugriffszähler zurücksetzen';
public $A_CMP_CNT_REVISED = 'Revidiert';
public $A_CMP_CNT_TIMES = 'mal';
public $A_CMP_CNT_BY = 'Von';
public $A_CMP_CNT_NEWDOC = 'Neues Dokument';
public $A_CMP_CNT_LASTMOD = 'Zuletzt geändert';
public $A_CMP_CNT_NOTMOD = 'Nicht geändert';
public $A_CMP_CNT_ADDETC = 'Sekt/Kat/Titel hinzufügen';
public $A_CMP_CNT_LINKCI = 'Dies wird einen Link - Inhalt Item im gewählten Menü erzeugen';
public $A_CMP_CNT_SOMTHING = 'Treffen sie eine Auswahl';
public $A_CMP_CNT_MVEITEMS = 'Verschiebe Items';
public $A_CMP_CNT_MVESECCAT = 'Verschiebe nach Sektion/Kategorie';
public $A_CMP_CNT_ITMSMVED = 'Items werden verschoben';
public $A_CMP_CNT_SECCAT = 'Wählen sie eine Sektion/Kategorie, in die das Item kopiert werden soll';
public $A_CMP_CNT_CPYITEMS = 'Kopiere Inhalt Items';
public $A_CMP_CNT_CPYSECCAT = 'Kopiere nach Sektion/Kategorie';
public $A_CMP_CNT_ITMSCPED = 'Items werden kopiert';
public $A_CMP_CNT_CCHECL = 'Cache geleert';
public $A_CMP_CNT_CANNOT = 'Sie können kein archiviertes Item bearbeiten';
public $A_CMP_CNT_THMODULIS = 'Das Modul';
public $A_CMP_CNT_DROWCRED = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_DROWMOD = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_DROWPUB = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_PBLINEV = 'Niemals';
public $A_CMP_CNT_DPUBLISHUP = 'Y-m-d';
public $A_CMP_CNT_SLSECTN = 'Wähle Sektion';
public $A_CMP_CNT_SELCAT = 'Wähle Kategorie';
public $A_CMP_CNT_ARCHVED = 'Item(s) erfolgreich archiviert';
public $A_CMP_CNT_PUBLSHED = 'Item(s) erfolgreich veröffentlicht';
public $A_CMP_CNT_ITSUUNP = 'Item(s) erfolgreich gesperrt';
public $A_CMP_CNT_ITSUUNA = 'Item(s) erlogreich aus dem Archiv geholt';
public $A_CMP_CNT_SELITOG = 'Wählen sie ein Item zum Umschalten';
public $A_CMP_CNT_SELIDEL = 'Wählen sie ein Item zum Löschen';
public $A_CMP_CNT_ERROCCRD = 'Ein Fehler ist aufgetreten';
public $A_CMP_CNT_MOVD = 'Item(s) erfolgreich verschoben in Sektion';
public $A_CMP_CNT_COPED = 'Item(s) erfolgreich kopiert in Sektion';
public $A_CMP_CNT_RSTHTCNT = 'Zugriffszähler erfolgrech zurückgesetzt für';
public $A_CMP_CNT_INMENU = '(Link - Autonome Seite) im Menü';
public $A_CMP_CNT_SUCCSS = 'erfolgreich erstellt';
public $A_CMP_CNT_RSZERO = 'Sind sie sicher, das sie den Zugriffszähler auf 0 setzen wollen? \nAlle ungesicherten Änderungen gehen dadurch verloren.';
public $A_CMP_CNT_MUST_CIMNA = 'Inhalts Item muss einen Namen haben';
public $A_CMP_CNT_SITMAPFOR = 'Site Map für';
public $A_CMP_CNT_ALLLANGS = 'Alle Sprachen';
public $A_CMP_CNT_LANG = 'Sprache';
public $A_CMP_CNT_PHRENAME = 'Drücken und halten um umzubenennen';
public $A_CMP_CNT_EDITITEM = 'Item bearbeiten';
public $A_CMP_CNT_NOTES = 'Notizen';
public $A_CMP_CNT_PRSHREN = 'Drücken und halten um Item umzubenennen';
public $A_CMP_CNT_EMPCATSEC = 'Baumansicht zeigt keine leeren Sektionen und Kategorien.';
public $A_CMP_CNT_TREEUNPUBL = 'Items die grau und kursiv markiert sind, haben den Status unveröffentlicht';
public $A_CMP_CNT_NULLVAL = 'Nullwert übermittelt!';
public $A_CMP_CNT_INCCTP = 'Ungültiger Inhalts Typ';
public $A_CMP_CNT_CLDNFETCH = 'Konnte Daten nicht holen';
public $A_CMP_CNT_TRSELPAIR = 'Wählen sie ein Sprachpaar';
public $A_CMP_CNT_TRSOUDEST = 'Wählen sie Quell- und Zielsprache';
public $A_CMP_CNT_TRITEMS = 'Item wird übersetzt';
public $A_CMP_CNT_TRNOTE = '<strong>Elxis Notiz:</strong> Wählen sie das Sprachpaar sorgfältig. Diese Prozedur wird 
        eine Weile dauern, abhängig von der Größe des zu übersetzenden Textes.<br />
        Die Übersetzung basiert auf der freien Online-Routine von Altavista.
        Elxis ist nicht verantwortlich für die Qualität der Übersetzung.';
public $A_CMP_CNT_TRSELITEM = 'Wählen sie ein Item das übersetzt werden soll';
public $A_CMP_CNT_TROKSAVED = 'Item erfolgriech übersetzt und kopiert';
public $A_CMP_CNT_TRITMNOTF = 'Gewähltes Item wurde in der Datenbank nicht gefunden!';
public $A_CMP_CNT_MFS = 'Servernachricht';
public $A_CMP_CNT_WID = 'mit der ID';
public $A_CMP_CNT_RNMTO = 'umbenennen zu';
public $A_CMP_CNT_FL= 'Sprachfilter';
public $A_CMP_CNT_CONFL = 'Sprachkonflikt';
public $A_CMP_CNT_CONFI = 'Item befindet sich in einer Kategorie mit Spracheinstellungen, die eine Übersetzung nicht möglich machen!';
public $A_CMP_CNT_STARTALW = 'Start: Immer';
public $A_CMP_CNT_FINNOEXP = 'Ende: Kein Ablauf';
public $A_CMP_CNT_FINISH = 'Ende';
public $A_CMP_CNT_FROM = 'von';
public $A_CMP_CNT_SHOWHIDE = 'Zeige/Verstecke';
public $A_SIMPLEVIEW = 'Einfache Ansicht';
public $A_EXTENDVIEW = 'Erweiterte Ansicht';
public $A_CMP_CNT_COMMENTS = 'Kommentare';
public $A_CMP_CNT_SAVTRANS = 'Item übertragen und als Seiteninhalt gespeichert';
public $A_CMP_CNT_RELLINKS = 'Zugeordnete Links';
public $A_CMP_CNT_RELLINKSD = 'Zugeordnete Links zu diesem Artikel. Wenn sie wünschen externe Links hinzuzufügen, dann ergänzen sie bitte das http:// Präfix in der URL.';

}

?>
