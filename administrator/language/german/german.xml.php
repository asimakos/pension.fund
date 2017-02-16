<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Siegmund Langsch, Simon Zöllner (SimonZ)
* @link: http://www.langschnet.de
* @email: s.langsch@langhscnet.de
* @description: German Language for XML files
* @note: All values used in admin XML files start with 'AX_'
* @note 2008: values for custom language strings defined as php contants start with 'CX_' (not in this file!)
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* 
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
* 
*/

defined( '_VALID_MOS' ) or die( 'Direkter Zugriff auf diesen Ort ist nicht erlaubt.' );


class xmlLanguage extends standardLanguage {

public function get($a) {
	if ( is_numeric($a) ) { return $a; }
	$pref = strtoupper(substr($a,0,3));
    if ($pref == 'AX_') {
        return $this->$a;
    } elseif (($pref == 'CX_') && defined($a)) {
        return constant($a);
	} else { return $a; }
}

protected $AX_MENUIMGL = 'Menübild';
protected $AX_MENUIMGD = 'Ein kleines Bild das links oder rechts von dem Menüitem angezeigt wird. Bilder müssen im Verzeichnis images/stories/ liegen.';
protected $AX_MENUIMGONLYL = 'Nur das Menübild benutzen';
protected $AX_MENUIMGONLYD = 'Wenn sie <strong>Ja</strong> wählen, dann wird nur das Menübild das sie ausgewählt haben angezeigt.<br /><br />Wählen sie <strong>Nein</strong> dann wird das Bild ZUSÄTZLICH zum Text angezeigt.';
protected $AX_MENUIMG2D = 'Ein kleines Bild das links oder rechts von dem Menüitem angezeigt wird. Bilder müssen im Verzeichnis images/stories/ liegen.';
protected $AX_PAGCLASUFL = 'Seiten Klassen Suffix';
protected $AX_PAGCLASUFD = 'Ein Suffix das der CSS-Klasse der Seite zugeordnet wird. Dies erlaubt ihnen individuelle Seitengestaltung.';
protected $AX_TEXTPAGECL = 'Artikel Suffix';
protected $AX_TEXTPAGECLD = 'Ein Suffix das der CSS-Klasse des Artikels zugeordnet wird. Dies erlaubt ihnen individuelle Artikel/Inhalt Itemgestaltung.';
protected $AX_BACKBUTL = 'Zurück Button';
protected $AX_BACKBUTD = 'Zeige /Verstecke einen Zurück Button, der sie auf die vorherige Seite führt.';
protected $AX_USEGLB = 'Verwende Globaleinstellung';
protected $AX_HIDE = 'Verstecke';
protected $AX_SHOW = 'Zeige';
protected $AX_AUTO = 'Auto';
protected $AX_PAGTITLSL = 'Zeige Seitentitel';
protected $AX_PAGTITLSD = 'Zeige/Verstecke den Seitentitel.';
protected $AX_PAGTITLL = 'Seitentitel';
protected $AX_PAGTITLD = 'Text der oben auf der Seite angezeigt wird. Falls leer, wird der Menüname benutzt.';
protected $AX_PAGTITL2D = 'Text der oben auf der Seite angezeigt wird.';
protected $AX_LEFT = 'Links';
protected $AX_RIGHT = 'Rechts';
protected $AX_PRNTICOL = 'Druck Icon';
protected $AX_PRNTICOD = 'Zeige/Verstecke den Druck Button - gilt nur auf dieser Seite.';
protected $AX_YES = 'Ja';
protected $AX_NO = 'Nein';
protected $AX_SECNML = 'SeKtionsname';
protected $AX_SECNMD = 'Zeige/Verstecke die Sektion zu der dieses Item gehört.';
protected $AX_SECNMLL = 'SeKtionsname verlinkbar';
protected $AX_SECNMLD = 'Macht den Sektionstext zu einem Link auf die aktuelle Sektionsseite.';
protected $AX_CATNML = 'Kategoriename';
protected $AX_CATNMD = 'Zeige/verstecke die Kategorie zu der dieses Item gehört.';
protected $AX_CATNMLL = 'Kategoriename verlinkbar';
protected $AX_CATNMLD = 'Macht den Kategorietext zu einem Link auf die aktuelle Kategorieseite.';
protected $AX_LNKTTLL = 'Verlinkte Titel';
protected $AX_LNKTTLD = 'Macht ihre Item-Titel verlinkbar.';
protected $AX_ITMRATL = 'Item Bewertung';
protected $AX_ITMRATD = 'Zeige/Verstecke die Item Bewertung - gilt nur für diese Seite.';
protected $AX_AUTNML = 'Autor Namen';
protected $AX_AUTNMD = 'Zeige/Verstecke den Item Autor - gilt nur für diese Seite.';
protected $AX_CTDL = 'Erstellungsdatum und Zeit';
protected $AX_CTDD = 'Zeige/Verstecke Erstellungsdatum und Zeit des Items - gilt nur für diese Seite.';
protected $AX_MTDL = 'Änderungsdatum und Zeit';
protected $AX_MTDD = 'Zeige/Verstecke Änderungsdatum und Zeit des Items - gilt nur für diese Seite.';
protected $AX_PDFICL = 'PDF Icon';
protected $AX_PDFICD = 'Zeige/Verstecke den PDF Button - gilt nur für diese Seite.';
protected $AX_PRICL = 'Druck Icon';
protected $AX_PRICD = 'Zeige/Verstecke den Druck Button - gilt nur für diese Seite.';
protected $AX_EMICL = 'EMail Icon';
protected $AX_EMICD = 'Zeige/Verstecke den EMail Button - gilt nur für diese Seite.';
protected $AX_FTITLE = 'Titel';
protected $AX_FAUTH = 'Autor';
protected $AX_FHITS = 'Zugriffe';
protected $AX_DESCRL = 'Bechreibung';
protected $AX_DESCRD = 'Zeige/Verstecke die unten angezeigte Beschreibung.';
protected $AX_DESCRTXL = 'Beschreibungstext';
protected $AX_DESCRTXD = 'Beschreibung für diese Seite, falls leer wird _WEBLINKS_DESC aus ihrem Sprachfile angezeigt';
protected $AX_IMAGEL = 'Bild';
protected $AX_IMGFRPD = 'Bild für die Seite - muss in /images/stories gespeichert sein. Per Voreinstellung wird web_links.jpg angezeigt. -Kein Bild anzeigen- bedeutet das kein Bild geladen wird.';
protected $AX_IMGALL = 'Bildausrichtung';
protected $AX_IMGALD = 'Ausrichtung des Bildes.';
protected $AX_TBHEADL = 'Tabellenüberschriften';
protected $AX_TBHEADD = 'Zeige/Verstecke Tabellenüberschriften.';
protected $AX_POSCOLL = 'Position der Spalte';
protected $AX_POSCOLD = 'Zeige/Verstecke die Position der Spalte.';
protected $AX_EMAILCOLL = 'EMail Spalte';
protected $AX_EMAILCOLD = 'Zeige/Verstecke die EMail-Spalte.';
protected $AX_TELCOLL = 'Telefon Spalte';
protected $AX_TELCOLD = 'Zeige/Verstecke die Telefon-Spalte.';
protected $AX_FAXCOLL = 'Fax Spalte';
protected $AX_FAXCOLD = 'Zeige/Verstecke die Fax-Spalte.';
protected $AX_LEADINGL = '# Überschrift';
protected $AX_LEADINGD = 'Anzahl der Items die als Überschrift angezeigt werden sollen. 0 bedeutet, das keine Items als Überschrift angezeigt werden.';
protected $AX_INTROL = '# Intro';
protected $AX_INTROD = 'Anzahl von Items, die mit dem Einleitungstext angezeigt werden sollen.';
protected $AX_COLSL = 'Spalten';
protected $AX_COLSD = 'Bestimmt wie viele Spalten pro Zeile benutzt werden sollen um die Einleitungstexte anzuzeigen.';
protected $AX_LNKSL = '# Links';
protected $AX_LNKSD = 'Anzahl der Items die als Link angezeigt werden sollen.';
protected $AX_CATORL = 'Kategoriereihenfolge';
protected $AX_CATORD = 'Ordnet Items nach Kategorie.';
protected $AX_OCAT01 = 'Nein, ordne nur nach Hauptreihenfolge';
protected $AX_OCAT02 = 'Titel Alphabetisch';
protected $AX_OCAT03 = 'Titel Alphabetisch-Rückwärts';
protected $AX_OCAT04 = 'Reihenfolge';
protected $AX_PRMORL = 'Hauptreihenfolge';
protected $AX_PRMORD = 'Reihenfolge in der die Items angezeigt werden.';
protected $AX_OPRM01 = 'Voreinstellung';
protected $AX_OPRM02 = 'Frontpage Reihenfolge';
protected $AX_OPRM03 = 'Älteste zuerst';
protected $AX_OPRM04 = 'Neueste zuerst';
protected $AX_OPRM07 = 'Autor Alphabetisch';
protected $AX_OPRM08 = 'Autor Alphabetisch-Rückwärts';
protected $AX_OPRM09 = 'Meiste Zugriffe';
protected $AX_OPRM10 = 'Wenigste Zugriffe';
protected $AX_PAGL = 'Paginierung';
protected $AX_PAGD = 'Zeige/Verstecke Paginierungs-Unterstützung.';
protected $AX_PAGRL = 'Paginierungsergebnisse';
protected $AX_PAGRD = 'Zeige/Verstecke Paginierungsergebnisse ( z.B. 1-4 von 4 ).';
protected $AX_MOSIL = 'MOSImages';
protected $AX_MOSID = 'Zeige {mosimages} an.';
protected $AX_ITMTL = 'Item Titel';
protected $AX_ITMTD = 'Zeige/Verstecke die Item Titel.';
protected $AX_REMRL = 'Lesen sie mehr...';
protected $AX_REMRD = 'Zeige/Verstecke den Lesen sie mehr... Link.';
protected $AX_OTHCATL = 'Andere Kategorien';
protected $AX_OTHCATD = 'Bei Ansicht einer Kategorie - Zeige/Verstecke die Liste der anderen Kategorien.';
protected $AX_TDISTPD = 'Text der oben auf der Seite angezeigt werden soll.';
protected $AX_ORDBYL = 'Sortiert nach';
protected $AX_ORDBYD = 'Dies übersteuert die Reihenfolge der Items.';
protected $AX_MCS_DESCL = 'Beschreibung';
protected $AX_SHCDESD = 'Zeige/Verstecke die Kategoriebeschreibung.';
protected $AX_DESCIL = 'Beschreibung Bild';
protected $AX_MUDATFL = 'Datumsformat';
protected $AX_MUDATFD = "Das Format in dem das Datumangezeigt wird - PHP strftime Format - falls leer wird das Format aus ihrer Sprachdatei geladen.";
protected $AX_MUDATCL = 'Datumsspalte';
protected $AX_MUDATCD = 'Zeige oder verstecke die Datumsspalte.';
protected $AX_MUAUTCL = 'Autor Spalte';
protected $AX_MUAUTCD = 'Zeige/Verstecke die Autoren Spalte.';
protected $AX_MUHITCL = 'Zugriffs Spalte';
protected $AX_MUHITCD = 'Zeige/Verstecke die Zugriffsspalte.';
protected $AX_MUNAVBL = 'Navigationsleiste';
protected $AX_MUNAVBD = 'Zeige/Verstecke die Navigationsleiste.';
protected $AX_MUORDSL = 'Sortierungsauswahl';
protected $AX_MUORDSD = 'Zeige/Verstecke die DropdownBox für die Sortierungsauswahl.';
protected $AX_MUDSPSL = 'Anzeige Auswahl';
protected $AX_MUDSPSD = 'Zeige/Verstecke die DropdownBox für die Anzeigeauswahl.';
protected $AX_MUDSPNL = 'Anzeige Anzahl';
protected $AX_MUDSPND = 'Anzahl der Items die per Voreinstellung angezeigt werden.';
protected $AX_MUFLTL = 'Filter';
protected $AX_MUFLTD = 'Zeige/Verstecke die Filtermöglichkeit.';
protected $AX_MUFLTFL = 'Filterfeld';
protected $AX_MUFLTFD = 'Welchem Feld soll der Filter zugeordnet werden.';
protected $AX_MUOCATL = 'Andere Kategorien';
protected $AX_MUOCATD = 'Zeige/Verstecke die Liste von anderen Kategorien.';
protected $AX_MUECATL = 'Leere Kategorien';
protected $AX_MUECATD = 'Zeige/Verstecke leere (keine Items) Kategorien.';
protected $AX_CATDSCL = 'Kategoriebeschreibung';
protected $AX_CATDSBLND = 'Zeige/Verstecke die Kategoriebeschreibung - erscheint unter dem Kategorienamen.';
protected $AX_NAMCOLL = 'Namenspalte';
protected $AX_LINKDSCL = 'Link Beschreibung';
protected $AX_LINKDSCD = 'Zeige/Verstecke die Beschreibung von Links.';
//com_contact/contact.xml
protected $AX_CCT_CDESC = 'Diese Komponente zeigt eine Liste von Kontaktinformationen.';
protected $AX_CCT_CATLISTSL = 'Kategorieliste - Sektion';
protected $AX_CCT_CATLISTSD = 'Zeige/Verstecke die Liste von Kategorien auf der Listenansicht-Seite.';
protected $AX_CCT_CATLISTCL = 'Kategorieliste - Kategorie';
protected $AX_CCT_CATLISTCD = 'Zeige/Verstecke die Liste von Kategorien auf der Tabellanansicht-Seite.';
protected $AX_CCT_CATDSCD = 'Zeige/Verstecke die Beschreibung für die Liste von anderen Kategorien.';
protected $AX_CCT_NOCATITL = '# Kategorie Items';
protected $AX_CCT_NOCATITD = 'Zeige/Verstecke die Anzahl von Items in jeder Kategorie.';
//com_contact/contact_items.xml
protected $AX_CIT_CDESC = 'Parameter für individuelle Kontakt Items.';
protected $AX_CIT_NAMEL = 'Name';
protected $AX_CIT_NAMED = 'Zeige/Verstecke die Namensinfo.';
protected $AX_CIT_POSITL = 'Position';
protected $AX_CIT_POSITD = 'Zeige/Verstecke die Positionsinfo.';
protected $AX_CIT_EMAILL = 'EMail';
protected $AX_CIT_EMAILD = 'Zeige/Verstecke die EMail Info. Wenn sie die Info anzeigen lassen, wird die Adresse per Javascript-Cloaking vor Spambots geschützt.';
protected $AX_CIT_SADDREL = 'Straße';
protected $AX_CIT_SADDRED = 'Zeige/Verstecke die Straßen Info.';
protected $AX_CIT_TOWNL = 'Stadt/Stadtteil';
protected $AX_CIT_TOWND = 'Zeige/Verstecke die Stadt/Stadtteil Info.';
protected $AX_CIT_STATEL = 'Staat';
protected $AX_CIT_STATED = 'Zeige/Verstecke die Staat Info.';
protected $AX_CIT_COUNTRL = 'Land';
protected $AX_CIT_COUNTRD = 'Zeige/Verstecke die Land Info.';
protected $AX_CIT_ZIPL = 'PLZ';
protected $AX_CIT_ZIPD = 'Zeige/Verstecke die PLZ Info.';
protected $AX_CIT_TELL = 'Telefon';
protected $AX_CIT_TELD = 'Zeige/Verstecke die Telefon Info.';
protected $AX_CIT_FAXL = 'Fax';
protected $AX_CIT_FAXD = 'Zeige/Verstecke die Fax Info.';
protected $AX_CIT_MISCL = 'Allgemeine Info';
protected $AX_CIT_MISCD = 'Zeige/Verstecke die Allgemeine Info.';
protected $AX_CIT_VCARDL = 'Vcard';
protected $AX_CIT_VCARDD = 'Zeige/Verstecke die Vcard.';
protected $AX_CIT_CIMGL = 'Bild';
protected $AX_CIT_CIMGD = 'Zeige/Verstecke das Bild.';
protected $AX_CIT_DEMAILL = 'EMail Beschreibung';
protected $AX_CIT_DEMAILD = 'Zeige/Verstecke die Beschreibung aus dem nächsten Feld.';
protected $AX_CIT_DTXTL = 'Beschreibungstext';
protected $AX_CIT_DTXTD = 'Der Beschreibungstext für das EMail Formular. Falls leer, wird der Text _EMAIL_DESCRIPTION aus der Sprachdefinitions-Datei verwendet.';
protected $AX_CIT_EMFRML = 'EMail Formular';
protected $AX_CIT_EMFRMD = 'Zeige/Verstecke das EMail Formular.';
protected $AX_CIT_EMCPYL = 'EMail Kopie';
protected $AX_CIT_EMCPYD = 'Zeige/Verstecke die Checkbox für die EMail-Kopie an die Adresse des Senders.';
protected $AX_CIT_DDL = 'Drop Down';
protected $AX_CIT_DDD = 'Zeige/Verstecke die DropDown Auswahlliste in der Kontaktansicht.';
protected $AX_CIT_ICONTXL = 'Icons/Text';
protected $AX_CIT_ICONTXD = 'Benutze Icons, Text oder keines von beiden als Anzeige neben den Kontaktinformationen.';
protected $AX_CIT_ICONS = 'Icons';
protected $AX_CIT_TEXT = 'Text';
protected $AX_CIT_NONE = 'Nichts';
protected $AX_CIT_ADICONL = 'Addressen Icon';
protected $AX_CIT_ADICOND = 'Icon für die Adressen Info.';
protected $AX_CIT_EMICONL = 'EMail Icon';
protected $AX_CIT_EMICOND = 'Icon für die EMail Info.';
protected $AX_CIT_TLICONL = 'Telefon Icon';
protected $AX_CIT_TLICOND = 'Icon für die Telefon Info.';
protected $AX_CIT_FXICONL = 'Fax Icon';
protected $AX_CIT_FXICOND = 'Icon für die Fax Info.';
protected $AX_CIT_MCICONL = 'Allgemeines Icon';
protected $AX_CIT_MCICOND = 'Icon für die Allgemeine Info.';
protected $AX_CCT_NAMEL = 'Name';
protected $AX_CCT_NAMED = 'Zeige/Verstecke die Namen Info.';
protected $AX_CCT_POSITL = 'Position';
protected $AX_CCT_POSITD = 'Zeige/Verstecke die Positions Info.';
protected $AX_CCT_EMAILL = 'EMail';
protected $AX_CCT_EMAILD = 'Zeige/Verstecke die EMail Info. Falls angezeigt, wird die Adresse per Javascript Cloaking vor Spambots geschützt.';
protected $AX_CCT_SADDREL = 'Straße';
protected $AX_CCT_SADDRED = 'Zeige/Verstecke die Straßen Info.';
protected $AX_CCT_TOWNL = 'Stadt/Stadtteil';
protected $AX_CCT_TOWND = 'Zeige/Verstecke die Stadtteil Info.';
protected $AX_CCT_STATEL = 'Staat';
protected $AX_CCT_STATED = 'Zeige/Verstecke die Staat Info.';
protected $AX_CCT_COUNTRL = 'Land';
protected $AX_CCT_COUNTRD = 'Zeige/Verstecke die Land Info.';
protected $AX_CCT_ZIPL = 'PLZ';
protected $AX_CCT_ZIPD = 'Zeige/Verstecke die PLZ Info.';
protected $AX_CCT_TELL = 'Telefon';
protected $AX_CCT_TELD = 'Zeige/Verstecke die Telefon Info.';
protected $AX_CCT_FAXL = 'Fax';
protected $AX_CCT_FAXD = 'Zeige/Verstecke die Fax Info.';
protected $AX_CCT_MISCL = 'Allgemeine Info';
protected $AX_CCT_MISCD = 'Zeige/Verstecke die Allgemeine Info.';
protected $AX_CCT_VCARDL = 'Vcard';
protected $AX_CCT_VCARDD = 'Zeige/Verstecke die Vcard.';
protected $AX_CCT_CIMGL = 'Bild';
protected $AX_CCT_CIMGD = 'Zeige/Verstecke das Bild.';
protected $AX_CCT_DEMAILL = 'EMail Beschreibung';
protected $AX_CCT_DEMAILD = 'Zeige/Verstecke die Beschreibung aus dem nächsten Feld.';
protected $AX_CCT_DTXTL = 'Beschreibungstext';
protected $AX_CCT_DTXTD = 'Die Beschreibung für das EMail Formular. Falls leer wird _EMAIL_DESCRIPTION aus der Sprachdefinitions-Datei.';
protected $AX_CCT_EMFRML = 'EMail Formular';
protected $AX_CCT_EMFRMD = 'Zeige/Verstecke das EMail Formular.';
protected $AX_CCT_EMCPYL = 'EMail Kopie';
protected $AX_CCT_EMCPYD = 'Zeige/Verstecke die Checkbox für die EMail Kopie an die Adresse des Senders.';
protected $AX_CCT_DDL = 'Drop Down';
protected $AX_CCT_DDD = 'Zeige/Verstecke die DropdownBox für die Auswahlliste in der Kontaktansicht.';
protected $AX_CCT_ICONTXL = 'Icons/Text';
protected $AX_CCT_ICONTXD = 'Benutze Icons, Text oder keines von beiden zur Anzeige neben den Kontaktinformationen.';
protected $AX_CCT_ICONS = 'Icons';
protected $AX_CCT_TEXT = 'Text';
protected $AX_CCT_NONE = 'Nichts';
protected $AX_CCT_ADICONL = 'Addressen Icon';
protected $AX_CCT_ADICOND = 'Icon für the Addressen Info.';
protected $AX_CCT_EMICONL = 'EMail Icon';
protected $AX_CCT_EMICOND = 'Icon für die EMail Info.';
protected $AX_CCT_TLICONL = 'Telefon Icon';
protected $AX_CCT_TLICOND = 'Icon für die Telefon Info.';
protected $AX_CCT_FXICONL = 'Fax Icon';
protected $AX_CCT_FXICOND = 'Icon für die Fax Info.';
protected $AX_CCT_MCICONL = 'Allgemeines Icon';
protected $AX_CCT_MCICOND = 'Icon für die Allgemeine Info.';
//com_content/content.xml
protected $AX_CNT_CDESC = 'Dies zeigt eine einzelne Inhaltsseite.';
protected $AX_CNT_INTEXTL = 'Einleitungstext';
protected $AX_CNT_INTEXTD = 'Zeige/Verstecke den Einleitungstext.';
protected $AX_CNT_KEYRL = 'Schlüsselreferenz';
protected $AX_CNT_KEYRD = 'Ein Textschlüssel, mit dem ein Item referenziert wird (wie eine Hilfe-Referenz).';
//com_frontpage/frontpage.xml
protected $AX_FP_CDESC = 'Diese Komponenten zeigt alle veröffentlichten Inhalte von ihrer Seite die mit -Zeige auf Frontpage- markiert sind.';
//com_login/login.xml
protected $AX_LG_CDESC = 'Parameter für individuelle Kontak Items.';
protected $AX_LG_LPTL = 'Titel der Anmeldeseite';
protected $AX_LG_LPTD = 'Text der oben auf der Seite angezeigt wird. Falls leeer wird der Menüname benutzt.';
protected $AX_LG_LRURLL = 'Anmeldung Umleitungs URL';
protected $AX_LG_LRURLD = 'Welche Seite wird nach der Anmeldung angezeigt. Falls leer wird die Frontpage angezeigt.';
protected $AX_LG_LJSML = 'Anmelde JS Nachricht';
protected $AX_LG_LJSMD = 'Zeige/Verstecke das Javascript Pop-Up, das die erfolgreiche Anmeldung anzeigt.';
protected $AX_LG_LDESCL = 'Anmelde Beschreibung';
protected $AX_LG_LDESCD = 'Zeige/Verstecke die Anmeldebeschreibung im nächsten Feld.';
protected $AX_LG_LDESTL = 'Anmelde Beschreibungstext';
protected $AX_LG_LDESTD = 'Text der auf der Anmeldeseite angezeigt wird. Falls leer wird, _LOGIN_DESCRIPTION verwendet.';
protected $AX_LG_LIMGL = 'Anmeldebild';
protected $AX_LG_LIMGD = 'Bild für die Anmeldeseite.';
protected $AX_LG_LIMGAL = 'Ausrichtugn Anmeldebild';
protected $AX_LG_LIMGAD = 'Ausrichtung des Anmeldebildes.';
protected $AX_LG_LOPTL = 'Titel der Abmeldeseite';
protected $AX_LG_LOPTD = 'Text der oben auf der Seite angezeigt wird. Falls leer wird der Menüname benutzt.';
protected $AX_LG_LORURLL = 'Abmelde Umleitungs URL';
protected $AX_LG_LORURLD = 'Welche Seite wird nach erfolgreicher Abeldung angezeigt. Falls leer wird die Frontpage angezeigt.';
protected $AX_LG_LOJSML = 'Abmelde JS Nachricht';
protected $AX_LG_LOJSMD = 'Zeige/Verstecke das Javascript Pop-Up mit der Nachricht über die erfolgreiche Abmeldung.';
protected $AX_LG_LODSCL = 'Abmelde Beschreibung';
protected $AX_LG_LODSCD = 'Zeige/Verstecke die Abmeldebeschreibung im nächsten Feld.';
protected $AX_LG_LODSTL = 'Abmelde Beschreibungstext';
protected $AX_LG_LODSTD = 'Text der auf der Abmeldeseite angezeigt wird. Falls leer wird _LOGOUT_DESCRIPTION benutzt.';
protected $AX_LG_LOGOIL = 'Abmeldebild';
protected $AX_LG_LOGOID = 'Bild für die Abmeldeseite.';
protected $AX_LG_LOGOIAL = 'Bildausrichtung Abmeldeseite';
protected $AX_LG_LOGOIAD = 'Ausrichtung des Bildes auf der Abmeldeseite.';
//com_massmail/massmail.xml
protected $AX_MM_CDESC = 'Diese Komponenten erlaubt es ihnen, eine Massenmail an eine Benutzergruppe su senden.';
//com_media/media.xml
protected $AX_ME_CDESC = 'Diese Komponente verwaltet die Medien dieser Site.';
//com_menumanager/menumanager.xml
protected $AX_MNU_CDESC = 'Diese Komponente verwaltet ihre Menüs.';
//com_menus/component_item_link/component_item_link.xml
protected $AX_MUCIL_CNAME = 'Link - Komponenten Item';
protected $AX_MUCIL_CDESC = 'Erstellt einen Link auf eine existierende Elxis Komponente.';
//com_menus/components/components.xml
protected $AX_MUCOMP_CNAME = 'Komponente';
protected $AX_MUCOMP_CDESC = 'Zeigt das Frontend Interface einer Komponente an.';
//com_menus/contact_category_table/contact_category_table.xml
protected $AX_MUCCT_CNAME = 'Tabelle - Kontakt Kategorie';
protected $AX_MUCCT_CDESC = 'Zeigt eine Tabellenansicht von Kontakt Items einer Kategorie.';
protected $AX_MUCCT_CATDL = 'Kategorie Beschreibung';
protected $AX_MUCCT_CATDD = 'Zeige/Verstecke die Beschreibung für die Liste von anderen Kategorien.';
//com_menus/contact_item_link/contact_item_link.xml
protected $AX_MUCTIL_CNAME = 'Link - Kontakt Item';
protected $AX_MUCTIL_CDESC = 'Erstellt einen Link zu einem veröffentlichten Kontakt Item';
//com_menus/content_archive_category/content_archive_category.xml
protected $AX_MUCAC_CNAME = 'Blog - Inhalt Kategorie Archiv';
protected $AX_MUCAC_CDESC = 'Zeigt eine Liste von archivierten Inhalten einer Kategorie.';
//com_menus/content_archive_section/content_archive_section.xml
protected $AX_MUCAS_CNAME = 'Blog - Inhalt Sektion Archiv';
protected $AX_MUCAS_CDESC = 'Zeigt eine Liste von archivierten Inhalten einer Sektion.';
//com_menus/content_blog_category/content_blog_category.xml
protected $AX_MUCBC_CNAME = 'Blog - Inhalt Kategorie';
protected $AX_MUCBC_CDESC = 'Zeigt eine Seite von Inhalts Items von multiplen Kategorien im Blog-Format.';
//com_menus/content_blog_section/content_blog_section.xml
protected $AX_MUCBS_CNAME = 'Blog - Inhalt Sektion';
protected $AX_MUCBS_CDESC = 'Zeigt eine Seite von Inhalt Items aus multiplen Sektionen im Blog Format.';
protected $AX_MUCBS_SHSD = 'Zeige/Verstecke die Sektionen Beschriftung.';
//com_menus/content_category/content_category.xml
protected $AX_MUCC_CNAME = 'Tabelle - Inhalt Kategorie';
protected $AX_MUCC_CDESC = 'Zeigt eine Tabellenansicht von Inhalts Items einer Kategorie.';
protected $AX_MUCC_SHLOCD = 'Zeige/Verstecke das Listing von anderen Kategorien.';
//com_menus/content_item_link/content_item_link.xml
protected $AX_MCIL_CNAME = 'Link - Inhalt Item';
protected $AX_MCIL_CDESC = 'Erzeugt einen Link zu einem veröffentlichten Inhalt Item in Vollansicht.';
//com_menus/content_section/content_section.xml
protected $AX_MCS_CNAME = 'Tabelle - Inhalt Sektion';
protected $AX_MCS_CDESC = 'Erstellt ein Listing von Inhalts Kategorien einer Sektion.';
protected $AX_MCS_STL = 'Sektion Titel';
protected $AX_MCS_STD = 'Zeige/Verstecke den Sektionstitel.';
protected $AX_MCS_SHCTID = 'Zeige/Verstecke das Kategorie Beschreibungsbild.';
//com_menus/content_typed/content_typed.xml
protected $AX_MLSC_CNAME = 'Link - Autonome Seite';
protected $AX_MLSC_CDESC = 'Erstellt einen Link zu einer autonomen Seite.';
//com_menus/newsfeed_category_table/newsfeed_category_table.xml
protected $AX_MNSFC_CNAME = 'Tabelle - Newsfeed Kategorie';
protected $AX_MNSFC_CDESC = 'Zeigt eine Tabellenansicht von Newsfeed Items einer Kategorie.';
protected $AX_MNSFC_SHNCD = 'Zeige/Verstecke die Namenspalte.';
protected $AX_MNSFC_ACL = 'Artikelspalte';
protected $AX_MNSFC_ACD = 'Zeige/Verstecke die Artikespalten.';
protected $AX_MNSFC_LCL = 'Link Spalte';
protected $AX_MNSFC_LCD = 'Zeige/Verstecke die Link Spalte.';
//com_menus/newsfeed_link/newsfeed_link.xml
protected $AX_MNSFL_CNAME = 'Link - Newsfeed';
protected $AX_MNSFL_CDESC = 'Erstellt einen Link zu einem einzelnen veröffentlichten Newsfeed.';
protected $AX_MNSFL_FDIML = 'Feed Bild';
protected $AX_MNSFL_FDIMD = 'Zeige/Verstecke das Bild für den Feed.';
protected $AX_MNSFL_FDDSL = 'Feed Beschreibung';
protected $AX_MNSFL_FDDSD = 'Zeige/Verstecke die Beschreibung des Feeds.';
protected $AX_MNSFL_WDCL = 'Wortzählung';
protected $AX_MNSFL_WDCD = 'Erlaubt ihnen die Anzahl der Zeichen des anzuzeigenden Beschreibungstextes zu limitieren. 0 zeigt den kompletten Text.';
//com_menus/separator/separator.xml
protected $AX_MSEP_CNAME = 'Separatoren / Platzhalter';
protected $AX_MSEP_CDESC = 'Erstellt einen Menüseperator oder Platzhalter.';
//com_menus/url/url.xml
protected $AX_MURL_CNAME = 'Link - Url';
protected $AX_MURL_CDESC = 'Erstellt einen Link zu einer URL.';
//com_menus/weblink_category_table/weblink_category_table.xml
protected $AX_MWLC_CNAME = 'Tabelle - Weblink Kategorie';
protected $AX_MWLC_CDESC = 'Zeigt eine Tabellenansicht von Weblink Items einer Weblink Kategorie.';
//com_menus/wrapper/wrapper.xml
protected $AX_MWRP_CNAME = 'Wrapper';
protected $AX_MWRP_CDESC = 'Erstellt einen IFrame der eine externe Seite innerhalb von Elxis anzeigt.';
protected $AX_MWRP_SCRBL = 'Scrollbalken';
protected $AX_MWRP_SCRBD = 'Zeige/Verstecke Horizontale & Vertikale Scrollbalken.';
protected $AX_MWRP_WDTL = 'Breite';
protected $AX_MWRP_WDTD = 'Breite des IFrame Fensters - sie können einen absoluten Wert inPixeln oder einen relativen Wert in % angeben.';
protected $AX_MWRP_HEIL = 'Höhe';
protected $AX_MWRP_HEID = 'Höhe des IFrame Fensters.';
protected $AX_MWRP_AHL = 'Automatische Höhe';
protected $AX_MWRP_AHD = 'Die Höhe wird automatisch auf die Höhe der externen Seite angepasst. Dies funktioniert nur bei Seiten ihrer eigenen Domain.';
protected $AX_MWRP_AADL = 'Auto Hinzufügen';
protected $AX_MWRP_AADD = 'Per Voreinstellung wird http:// hinzugefügt, es sei denn, es wurde http:// oder https:// in dem URL Link entdeckt den sie angeben haben. Diese Option erlaubt ihnen das Feature abzuschalten.';
//com_menus/system/system.xml
protected $AX_MSYS_CNAME = 'System Link';
protected $AX_MSYS_CDESC = 'Erstellt einen Link zu einem System Feature';
//com_newsfeeds/newsfeeds.xml
protected $AX_NFE_CDESC = 'Diese Komponente verwaltet RSS/RDF Newsfeeds.';
protected $AX_NFE_DPD = 'Beschreibung für die Seite';
protected $AX_NFE_SHFNCD = 'Zeige/Verstecke die Namenspalte des Feeds.';
protected $AX_NFE_NOACL = '# Artikel Spalten';
protected $AX_NFE_NOACD = 'Zeige/Verstecke die # von Artikeln in dem Feed.';
protected $AX_NFE_LCL = 'Link Spalte';
protected $AX_NFE_LCD = 'Zeige/Verstecke Linkspalte des Feeds.';
protected $AX_NFE_IDL = 'Item Beschreibung';
protected $AX_NFE_IDD = 'Zeige/Verstecke die Beschreibung oder den Einleitungstext eines Items.';
//com_search/search.xml
protected $AX_SEAR_CDESC = 'Diese Komponente verwaltet die Suchfunktion.';
//com_syndicate/syndicate.xml
protected $AX_SYN_CDESC = 'Diese Komponente kontrolliert die Syndication Einstellungen.';
protected $AX_SYN_CACHL = 'Cache';
protected $AX_SYN_CACHD = 'Cache die Feed Dateien.';
protected $AX_SYN_CACHTL = 'Cache Zeit';
protected $AX_SYN_CACHTD = 'Cache Datei wird alle x Sekunden erneuert.';
protected $AX_SYN_ITMSL = '# Items';
protected $AX_SYN_ITMSD = 'Anzahl der Items für Syndication.';
protected $AX_SYN_ITMSDFLT = 'Elxis Syndication';
protected $AX_SYN_TITLE = 'Syndication Titel';
protected $AX_SYN_DESCD = 'Syndication Beschreibung.';
protected $AX_SYN_DESCDFLT = 'Elxis Site syndication';
protected $AX_SYN_IMGD = 'Bild das in den Feed eingefügt werden soll.';
protected $AX_SYN_IMGAL = 'Bild Alternativtext';
protected $AX_SYN_IMGAD = 'Alternativer Text für Bild.';
protected $AX_SYN_IMGADFLT = 'Powered by Elxis';
protected $AX_SYN_LMTL = 'Limit Text';
protected $AX_SYN_LMTD = 'Limitiert den Artikeltext auf den untent angegeben Wert.';
protected $AX_SYN_TLENL = 'Text Länge';
protected $AX_SYN_TLEND = 'Die Wortlänge des Artikeltextes - 0 zeigt keinen Text.';
protected $AX_SYN_LBL = 'Live Lesezeichen';
protected $AX_SYN_LBD = 'Aktiviert die Unterstützung für die Live-Bookmark Funktion von Firefox.';
protected $AX_SYN_BFL = 'Lesezeichen Datei';
protected $AX_SYN_BFD = 'Spezial Dateiname. Falls leer, wird die Voreinstellung benutzt.';
protected $AX_SYN_ORDL = 'Sortierung';
protected $AX_SYN_ORDD = 'Reihenfolge in der die Items angezeigt werden.';
protected $AX_SYN_MULTIL = 'Multilinguale Feeds';
protected $AX_SYN_MULTILD = 'Falls ja, generiert Elxis spezifische Feeds.';
//com_trash/trash.xml
protected $AX_TRSH_CDESC = 'Diese Komponente verwaltet die Mülleimer Funktion.';
//com_typedcontent/typedcontent.xml
protected $AX_TDC_CDESC = 'Dies zeigt eine einzelne Inhaltseite.';
//com_weblinks/weblinks.xml
protected $AX_WBL_CDESC = 'Diese Komponente zeigt eine Liste von Weblinks mit Bildschirmfoto der Sites.';
protected $AX_WBL_LDL = 'Link Beschreibung';
protected $AX_WBL_LDD = 'Zeige/Verstecke die Beschreibung des Links.';
protected $AX_WBL_ICL = 'Icon';
protected $AX_WBL_ICD = 'Icon das links von den URL Links in der Tabellenansicht angezeigt wird.';
protected $AX_WBL_SCSL = 'Bildschirmfotos';
protected $AX_WBL_SCSD = 'Zeigt Bildschirmfotos von verlinkten Sites. Falls aktiv, wird die Funktion des Icons zuvor nicht verwendet.';
//com_weblinks/weblinks_item.xml
protected $AX_WBLI_TD = 'Zielfenster wenn der Link angeklickt wird.';
protected $AX_WBLI_OT01 = 'Elternfenster mit Browser Navigation';
protected $AX_WBLI_OT02 = 'Neues Fenster mit Browser Navigation';
protected $AX_WBLI_OT03 = 'Neues Fenster ohne Browser Navigation';
//ADMINISTRATOR MODULES
//administrator/modules/mod_latest.xml
protected $AX_AM_LN_DESC = 'Diese Modul zeigt eine Liste mit zuletzt veröffentlichten Artikeln die noch aktuell und nicht abgelaufen sind. Items der Frontpage sind in dieser Liste nicht enthalten.'; 
//administrator/modules/mod_logged.xml
protected $AX_AM_LG_DESC = 'Dieses Modul zeigt eine Liste der aktuell angemeldeten Benutzer.'; 
//administrator/modules/mod_popular.xml
protected $AX_AM_PI_DESC = 'Dieses Modul zeigt eine Liste der populärsten Artikel die noch aktuell sind. Items der Frontpage sind in dieser Liste nicht enthalten.'; 
//administrator/modules/mod_stats.xml
protected $AX_AM_ST_DESC = 'Dieses Modul zeigt Statistiken von Artikeln die noch aktuell sind. Items der Frontpage sind in dieser Liste nicht enthalten.'; 
//SITE MODULES
//General
protected $AX_SM_MCSL = 'Modul Klassen Suffix'; 
protected $AX_SM_MCSD = 'Ein Suffix das einer CSS-Klasse des Moduls (table.moduletable) zugeordnet wird, das erlaubt ihnen ein individuelles Modulstyling.'; 
protected $AX_SM_MUCSL = 'Menü Klassen Suffix'; 
protected $AX_SM_MUCSD = 'Ein Suffix das der CSS-Klasse von Menüitems zugeordnet wird.'; 
protected $AX_SM_ECL = 'Cache aktivieren'; 
protected $AX_SM_ECD = 'Gibt an, ob der Cache für den Inhalt dieses Moduls aktiviert wird oder nicht.'; 
protected $AX_SM_SMIL = 'Zeige Menü Icons'; 
protected $AX_SM_SMID = 'Zeige die Menüicons die sie für ihre Menüitems ausgewählt haben.'; 
protected $AX_SM_MIAL = 'Menü Icon Ausrichtung'; 
protected $AX_SM_MIAD = 'Ausrichtung der Icons der Menüitems'; 
protected $AX_SM_MODL = 'Modul Modus'; 
protected $AX_SM_MODD = 'Erlaubt ihnen zu kontrollieren welcher Typ von Inhalt in dem Modul angezeigt werden soll.'; 
protected $AX_SM_OP01 = 'Nur Inhalts Items'; 
protected $AX_SM_OP02 = 'Nur autonome Seiten'; 
protected $AX_SM_OP03 = 'Beides'; 
//modules/custom.xml
protected $AX_SM_CU_DESC = 'Eigenes Modul.'; 
protected $AX_SM_CU_RSURL = 'RSS URL'; 
protected $AX_SM_CU_RSURD = 'Geben Sie die URL des RSS/RDF Feeds an.'; 
protected $AX_SM_CU_FEDL = 'Feed Beschreibung'; 
protected $AX_SM_CU_FEDD = 'Zeige den Beschreibungstext für den gesamten Feed.'; 
protected $AX_SM_CU_FEIL = 'Feed Bild'; 
protected $AX_SM_CU_FEDID = 'Zeige das dem Feed zugeordnete Bild.'; 
protected $AX_SM_CU_ITL = 'Items'; 
protected $AX_SM_CU_ITD = 'Geben Sie die Anzahl der anzuzeigenden RSS Items an.'; 
protected $AX_SM_CU_ITDL = 'Item Beschreibung'; 
protected $AX_SM_CU_ITDD = 'Zeige die Beschreibung oder den Einleitungstext von individuellen News Items.'; 
protected $AX_SM_CU_WCL = 'Wortzählung'; 
protected $AX_SM_CU_WCD = 'Erlaubt ihnen die Menge des anzuzeigenden Item Beschreibungstextes einzustellen. 0 zeigt den kompletten Text.'; 
//modules/mod_archive.xml
protected $AX_SM_AR_DESC = 'Dieses Modul zeigt eine Liste von Kalendermonaten die archivierte Items enthalten. Diese Liste wird automatisch generiert, sobald sie den Status eine Items auf archiviert ändern.'; 
protected $AX_SM_AR_CNTL = 'Anzahl'; 
protected $AX_SM_AR_CNTD = 'Die Anzahl der Items die angezeigt werden sollen (Voreinstellung ist 10).'; 
//modules/mod_banners.xml
protected $AX_SM_BN_DESC = 'Das Bannermodul erlaubt die Anzeige von aktiven Bannern aus der Komponente innerhalb der Site.'; 
protected $AX_SM_BN_CNTL = 'Banner Klient'; 
protected $AX_SM_BN_CNTD = "Referenz zur Banner Klient ID. Eingabe getrennt durch ','!"; 
protected $AX_SM_BN_NBSL = 'Anzahl der angezeigten Banner';
protected $AX_SM_BN_NBPRL = 'Anzahl der Banner pro Reihew';
protected $AX_SM_BN_NBPRD = 'Anzahl der Banner pro Reihe - zum Abschalten auf 0 setzen. Um Banner vertikal anzuzeigen auf 1 setzen';
protected $AX_SM_BN_UNQBL = 'Einzigartige Banner';
protected $AX_SM_BN_UNQBD = 'Kein Banner wird während einer Sitzung mehr als einmal gezeigt. Wenn alle Banner gezeigt wurden, wird die History auf 0 gesetzt und neu gestartet.';
//modules/mod_latestnews.xml
protected $AX_SM_LN_DESC = 'Dieses Modul zeigt eine Liste der zuletzt veröffentlichen Items, die noch aktuell sind. Items der Frontpage werden in dieser Liste nicht angezeigt.'; 
protected $AX_SM_LN_FPIL = 'Frontpage Items'; 
protected $AX_SM_LN_FPID = 'Zeige/Verstecke Items die der Frontpage zugeordnet sind - funktioniert nur im  "Nur Inhalte Modus".'; 
protected $AX_SM_AR_CNT5D = 'Die Anzahlder Items die angezeigt werden sollen (Voreinstellung ist 5).'; 
protected $AX_SM_LN_CATIL = 'Kategorie ID'; 
protected $AX_SM_LN_CATID = 'Wählt Items aus einer spezifischen Kategorie oder einer Sammlung von Kategorien (Mehrere Kategorien werden durch (,) getrennt).'; 
protected $AX_SM_LN_SECIL = 'Sektion ID'; 
protected $AX_SM_LN_SECID = 'Wählt Items aus einer spezifischen Sektion oder einer Sammlung von Sektionen (Mehrere Sektionen werden durch (,) getrennt).'; 
//modules/mod_login.xml
protected $AX_SM_LF_DESC = 'Dieses Modul zeigt ein Anmeldeformular mit Benutzernamen und Passwort an. Ebenfalls wird ein Link zum Anfordern eines vergessenen Passworts angezeigt. Falls die Benutzerregistrierung aktiv ist, wird ein Link für die Selbstregistrierung eines neuen Benutzers angezeigt.'; 
protected $AX_SM_LF_PTL = 'Einleitungstext'; 
protected $AX_SM_LF_PTD = 'Dies ist der Text der über dem Anmeldeformular angezeigt wird.'; 
protected $AX_SM_LF_PSTL = 'Einleitungstext-2'; 
protected $AX_SM_LF_PSTD = 'Dies ist der Text der unter dem Anmeldeformular angezeigt wird.'; 
protected $AX_SM_LF_LRUL = 'Anmelde Umleitungs URL'; 
protected $AX_SM_LF_LRUD = 'Welche Seite soll nach der Anmeldung angezeigt werden. Falls leer, wird die Frontpage angezeigt.'; 
protected $AX_SM_LF_LORUL = 'Abmelde Umleitungs URL'; 
protected $AX_SM_LF_LORUD = 'Welche Seite soll nach der Abmeldung angezeigt werden. Falls leer, wird die Frontpage angezeigt.'; 
protected $AX_SM_LF_LML = 'Anmeldenachricht'; 
protected $AX_SM_LF_LMD = 'Zeige/Verstecke die Javascript Pop-Up Meldung bei erfolgreicher Anmeldung.'; 
protected $AX_SM_LF_LOML = 'Abmeldenachricht'; 
protected $AX_SM_LF_LOMD = 'Zeige/Verstecke die Javascript Pop-Up Meldung bei erfolgreicher Abmeldung.'; 
protected $AX_SM_LF_GML = 'Begrüßung'; 
protected $AX_SM_LF_GMD = 'Zeige/Verstecke den einfachen Begrüßungstext.'; 
protected $AX_SM_LF_NUNL = 'Name/Benutzername'; 
protected $AX_SM_LF_OP01 = 'Benutzername'; 
protected $AX_SM_LF_OP02 = 'Name'; 
//modules/mod_mainmenu.xml
protected $AX_SM_MNM_DESC = 'Zeigt ein Menü an.'; 
protected $AX_SM_MNM_MNL = 'Menüname'; 
protected $AX_SM_MNM_MND = 'Der Name des Menüs (Voreinstellung ist \'Hauptmenü\').'; 
protected $AX_SM_MNM_MSL = 'Menustil'; 
protected $AX_SM_MNM_MSD = 'Der Menustil'; 
protected $AX_SM_MNM_OP1 = 'Vertikal'; 
protected $AX_SM_MNM_OP2 = 'Horizontal'; 
protected $AX_SM_MNM_OP3 = 'Flache Liste'; 
protected $AX_SM_MNM_EML = 'Expandiere Menü'; 
protected $AX_SM_MNM_EMD = 'Expandiert das Menü und macht alle Submenüs sichtbar.'; 
protected $AX_SM_MNM_IIL = 'Indent Bild'; 
protected $AX_SM_MNM_IID = 'Wählen sie welches indent Bild verwendet wird.'; 
protected $AX_SM_MNM_OP4 = 'Template'; 
protected $AX_SM_MNM_OP5 = 'Voreingestellte Elxis Bilder'; 
protected $AX_SM_MNM_OP6 = 'Benutze Bilder unten'; 
protected $AX_SM_MNM_OP7 = 'Keins'; 
protected $AX_SM_MNM_II1L = 'Indent Bild 1'; 
protected $AX_SM_MNM_II1D = 'Bild für das erste sub-level.'; 
protected $AX_SM_MNM_II2L = 'Indent Bild 2'; 
protected $AX_SM_MNM_II2D = 'Bild für das zweite sub-level.'; 
protected $AX_SM_MNM_II3L = 'Indent Bild 3'; 
protected $AX_SM_MNM_II3D = 'Bild für das dritte sub-level.'; 
protected $AX_SM_MNM_II4L = 'Indent Bild 4'; 
protected $AX_SM_MNM_II4D = 'Bild für das vierte sub-level.'; 
protected $AX_SM_MNM_II5L = 'Indent Bild 5'; 
protected $AX_SM_MNM_II5D = 'Bild für das fünfte sub-level.'; 
protected $AX_SM_MNM_II6L = 'Indent Bild 6'; 
protected $AX_SM_MNM_II6D = 'Bild für das sechste sub-level.'; 
protected $AX_SM_MNM_SPL = 'Abstandhalter'; 
protected $AX_SM_MNM_SPD = 'Abstandhalter für Horizontal Menü.'; 
protected $AX_SM_MNM_ESL = 'Ende Abstandhalter'; 
protected $AX_SM_MNM_ESD = 'Ende Abstandhalter für Horizontal Menü.';
protected $AX_SM_MNM_IDPR = 'SEO PRO ItemID vorladen';
protected $AX_SM_MNM_IDPRD = 'Aktivierung von AJAX-Vorladen von ItemIDs löst das Problem der korrekten Menü Item Einstellungen wenn mehr als ein Menülink auf die selbe Seite zeigt.';
//modules/mod_mostread.xml
protected $AX_SM_MRC_DESC = 'Dieses Modul zeigt eine Liste der meistgesehenen aktuellen Items - gemessen an der Anzahl der Seitenaufrufe.'; 
protected $AX_SM_MRC_MNL = 'Menü Name'; 
protected $AX_SM_MRC_MND = 'Der Name des Menüs (Voreinstellung ist Hauptmenü).'; 
protected $AX_SM_MRC_FPIL = 'Frontpage Items'; 
protected $AX_SM_MRC_FPID = 'Zeige/Verstecke Items die der Frontpage zugeordnet sind - funktioniert nur im "Nur Inhalte Modus".'; 
protected $AX_SM_MRC_CL = 'Anzahl'; 
protected $AX_SM_MRC_CD = 'Die Anzahl der anzuzeigenden Items (Voreinstellung ist 5).'; 
protected $AX_SM_MRC_CIDL = 'Kategorie ID'; 
protected $AX_SM_MRC_CIDD = 'Wählt Items einer bestimmten Kategorie oder einer Auswahl von Kategorien, getrennt mit (,) ).'; 
protected $AX_SM_MRC_SIDL = 'Sektion ID'; 
protected $AX_SM_MRC_SIDD = 'Wählt Items einer bestimmten Sektion oder einer Auswahl von Sektionen, getrennt mit (,) ).'; 
//modules/mod_newsflash.xml
protected $AX_SM_NWF_DESC = 'Das Newsflash Modul wählt per Zufall ein veröffentlichtes Item einer Kategorie bei jeder Aktualisierung der angezeigten Seite. Es kann auch multiple Items in horizontaler oder vertikaler Konfiguration anzeigen.'; 
protected $AX_SM_NWF_CATL = 'Kategorie'; 
protected $AX_SM_NWF_CATD = 'Eine Inhalts Kategorie.'; 
protected $AX_SM_NWF_STL = 'Stil'; 
protected $AX_SM_NWF_STD = 'Der stil um die Kategorie anzuzeigen.'; 
protected $AX_SM_NWF_OP1 = 'Eine per Zufall ausgewählt'; 
protected $AX_SM_NWF_OP2 = 'Horizontal'; 
protected $AX_SM_NWF_OP3 = 'Vertikal'; 
protected $AX_SM_NWF_SIL = 'Zeige Bilder'; 
protected $AX_SM_NWF_SID = 'Zeige Inhalts Item Bilder.'; 
protected $AX_SM_NWF_LTL = 'Verlinkte Titel'; 
protected $AX_SM_NWF_LTD = 'Macht die Item Titel verlinkbar.'; 
protected $AX_SM_NWF_RML = 'Lesen sie mehr...'; 
protected $AX_SM_NWF_RMD = 'Zeige/Verstecke den Lesen sie mehr... Button.'; 
protected $AX_SM_NWF_ITL = 'Item Titel'; 
protected $AX_SM_NWF_ITD = 'Zeige Item Titel.'; 
protected $AX_SM_NWF_NOIL = 'Anzahl der Items'; 
protected $AX_SM_NWF_NOID = 'Anzahl der Items zum Anzeigen.'; 
//modules/mod_poll.xml
protected $AX_SM_POL_DESC = 'Dieses Modul komplettiert die Abstimmungskomponente. Es wird verwendet, um die konfigurierten Abstimmungen anzuzeigen. Das Modul erlaubt das Verlinken von Menüitems und Abstimmungen. Es werden nur Abstimmungen angezeigt, die mit einem Menüitem verbunden sind.'; 
protected $AX_SM_POL_CATL = 'Kategorie'; 
protected $AX_SM_POL_CATD = 'Eine Inhalts Kategorie.'; 
//modules/mod_random_image.xml
protected $AX_SM_RNI_DESC = 'Dieses Modul zeigt ein Zufallsbild aus dem gewählten Verzeichnis an.'; 
protected $AX_SM_RNI_ITL = 'Bild Typen'; 
protected $AX_SM_RNI_ITD = 'Typ des Bildes PNG/GIF/JPG etc. (voreingestellt JPG).'; 
protected $AX_SM_RNI_IFL = 'Bilderordner'; 
protected $AX_SM_RNI_IFD = 'Pfad zu den Bildern relativ zur Site URL, z.B.: images/stories.'; 
protected $AX_SM_RNI_LNL = 'Link'; 
protected $AX_SM_RNI_LND = 'Eine URL zu der gsprungen wird wenn auf man das Bild anklickt, z.B: http://www.goup.gr'; 
protected $AX_SM_RNI_WL = 'Breite (px)'; 
protected $AX_SM_RNI_WD = 'Bildbreite (wirkt sich auf alle anzuzeigenden Bilder aus).'; 
protected $AX_SM_RNI_HL = 'Höhe (px)'; 
protected $AX_SM_RNI_HD = 'Bildhöhe (wirkt sich auf alle anzuzeigenden Bilder aus).'; 
//modules/mod_related_items.xml
protected $AX_SM_RLI_DESC = "Dieses Modul zeigt anderen Inhalt, der mit dem aktuell angezeigten Inhalt in Relation steht. Basierend auf den Schlüsselwort-Metadaten. Alle Schlüsselwörter des aktuellen Inhalt werden gegen alle Schlüsselwörter aller anderen Inhalte durchsucht. Beispiel: Ihr aktueller Inhalt enthält als Schlüsselwort -Elxis- und bei der Durchsuchung werden andere Inhalte gefunden die dieses Schlüsselwort ebenfalls enthalten, dann zeigt ihnen diese Modul diese Inhalte ebenfalls an."; 
//modules/mod_rssfeed.xml
protected $AX_SM_RSS_DESC = 'Das Syndicate Modul zeigt einen Link mit dessen Hilfe andere Personen die News ihre Seite per RSS (u.a.) als Feed abonnieren können. Wenn eines der Symole angeklickt wird, dann wird der Besucher auf eine neue Seite geleitet, auf der alle zu Abonnierenden Items angezeigt werden. Wenn sie die Newsfeeds auf einer anderen Seite oder in ihrem Newsreader angezeigt bekommen möchten, müssen sie deren URL kopieren.'; 
protected $AX_SM_RSS_TXL = 'Text'; 
protected $AX_SM_RSS_TXD = 'Geben sie den Text ein, der zusammen mt den RSS-Links angezeigt werden soll.'; 
protected $AX_SM_RSS_091D = 'Zeige/Verstecke RSS 0.91 Link.'; 
protected $AX_SM_RSS_10D = 'Zeige/Verstecke RSS 1.0 Link.'; 
protected $AX_SM_RSS_20D = 'Zeige/Verstecke RSS 2.0 Link.'; 
protected $AX_SM_RSS_03D = 'Zeige/Verstecke Atom 0.3 Link.'; 
protected $AX_SM_RSS_OPD = 'Zeige/Verstecke OPML Link.'; 
protected $AX_SM_RSS_I091L = 'RSS 0.91 Bild'; 
protected $AX_SM_RSS_I10L = 'RSS 1.0 Bild'; 
protected $AX_SM_RSS_I20L = 'RSS 2.0 Bild'; 
protected $AX_SM_RSS_I03L = 'Atom Bild'; 
protected $AX_SM_RSS_IOPL = 'OPML Bild'; 
protected $AX_SM_RSS_CHID = 'Wählen sie das zu benutzende Bild.'; 
//modules/mod_search.xml
protected $AX_SM_SEM_DESC = 'Dieses Modul zeigt eine Suchbox an.';
protected $AX_SM_SEM_TOP = 'Oben';
protected $AX_SM_SEM_BTM = 'Unten';
protected $AX_SM_SEM_BWL = 'Box Breite';
protected $AX_SM_SEM_BWD = 'Größe der Suchtext Box.';
protected $AX_SM_SEM_TXL = 'Text';
protected $AX_SM_SEM_TXD = 'Der Text der in der Suchbox erscheint. Falls leer, wird _SEARCH_BOX aus ihrer Sprachdatei verwendet.';
protected $AX_SM_SEM_BPL = 'Button Position';
protected $AX_SM_SEM_BPD = 'Position des Buttons relativ zur Suchbox.';
protected $AX_SM_SEM_BTXL = 'Button Text';
protected $AX_SM_SEM_BTXD = 'Der Text der im Suchbutton erscheint. Falls leer, wird _SEARCH_TITLE aus ihrer Sprachdatei verwendet.'; 
//modules/mod_sections.xml
protected $AX_SM_SEC_DESC = 'Das Sektions Modul zeigt eine Liste aller konfigurierten Sektionen in ihrer Datenbank an. Die Sektionen verweisen hier nur auf Item-Sektionen. Falls \'Zeige unautorisierte Links\' gesetzt ist, wird die Liste auf Sektionen limitiert, die der jeweilige Benutzer sehen darf.'; 
protected $AX_SM_SEC_CL = 'Anzahl';
protected $AX_SM_SEC_CD = 'Die Anzahl von Items die angezeigt werden sollen (voreingestellt ist 5).';
//modules/mod_stats.xml
protected $AX_SM_STA_DESC = 'Das Statisktik Modul zeigt Informationen über ihre Server Installation und Statistik, Anzahl der Inhalte in ihrer Datenbank und die Anzahl der Weblinks die sie anbieten.';
protected $AX_SM_STA_SVIL = 'Server Info'; 
protected $AX_SM_STA_SVID = 'Zeigt Server Informationen.'; 
protected $AX_SM_STA_SIL = 'Site Info'; 
protected $AX_SM_STA_SID = 'Zeigt Site Informationen.'; 
protected $AX_SM_STA_HCL = 'Zugriffszähler'; 
protected $AX_SM_STA_HCD = 'Zeigt einen Zugriffszähler.'; 
protected $AX_SM_STA_ICL = 'Erhöhe Zähler'; 
protected $AX_SM_STA_ICD = 'Geben sie an um welchen Wert der Zähler bei Zugriff erhöht werden soll.'; 
//modules/mod_templatechooser.xml
protected $AX_SM_TMC_DESC = 'Der Template Wähler erlaubt dem Benutzer (Besucher) das Wechseln das Templates in Echtzeit aus dem Frontend heraus, mit Hilfe einer DropDown Liste.'; 
protected $AX_SM_TMC_MNLL = 'Maximale Namenslänge'; 
protected $AX_SM_TMC_MNLD = 'Maximale Länge des Templatenamens die angezeigt wird (voreingestellt 20).'; 
protected $AX_SM_TMC_SPL = 'Zeige Vorschau'; 
protected $AX_SM_TMC_SPD = 'Template Vorschau wird angezeigt.'; 
protected $AX_SM_TMC_WL = 'Breite'; 
protected $AX_SM_TMC_WD = 'Die Breite der Templatevorschau (voreingestellt 140 px).'; 
protected $AX_SM_TMC_HL = 'Höhe'; 
protected $AX_SM_TMC_HD = 'Die Höhe der Templatevorschau (voreingestellt 90 px).'; 
//modules/mod_whosonline.xml
protected $AX_SM_WSO_DESC = 'Das "Wer ist online" Module zeigt die Anzahl der aktuellen Benutzer und Gäste auf der Seite.'; 
protected $AX_SM_WSO_DL = 'Anzeige'; 
protected $AX_SM_WSO_DD = 'Wählt aus, was angezeigt werden soll.'; 
protected $AX_SM_WSO_OP1 = '# von Gästen/Mitgliedern<br />'; 
protected $AX_SM_WSO_OP2 = 'Mitglieder Namen<br />'; 
protected $AX_SM_WSO_OP3 = 'Beides'; 
//modules/mod_wrapper.xml
protected $AX_SM_WRM_DESC = 'Dieses Modul zeigt ein IFrame Fenster auf der angegebenen Position.'; 
protected $AX_SM_WRM_URLL = 'URL'; 
protected $AX_SM_WRM_URLD = 'URL zur Site/Datei die innerhalb des IFrames gezeigt werden soll'; 
protected $AX_SM_WRM_SCBL = 'Scrollbalken'; 
protected $AX_SM_WRM_SCBD = 'Zeige/Verstecke Horizontale & Vertikale Scrollbalken.'; 
protected $AX_SM_WRM_WL = 'Breite'; 
protected $AX_SM_WRM_WD = 'Breite des IFRame Fensters. Sie können einen absolten Wert in Pixeln oder einen relativen Wert in % angeben.'; 
protected $AX_SM_WRM_HL = 'Höhe'; 
protected $AX_SM_WRM_HD = 'Höhe des IFrame Fensters'; 
protected $AX_SM_WRM_AHL = 'Automatische Höhe'; 
protected $AX_SM_WRM_AHD = 'Die Höhe wird automatisch auf die Höhe der externen Seite gesetzt. Funktioniert nur für Seiten auf ihrer eigenen Domain.'; 
protected $AX_SM_WRM_ADL = 'Automatisches Hinzufügen'; 
protected $AX_SM_WRM_ADD = 'Per Voreinstellung wird http:// hinzugefügt, falls nicht http:// oder https:// in der angegebenen URL gefunden wird. Hier können sie diese Funktion abschalten.'; 
/* mambots/editors/tinymce */
protected $AX_ED_FUNCTL = 'Funktionalität'; 
protected $AX_ED_FUNCTD = 'Wählen sie die Funktionalität'; 
protected $AX_ED_FUNSIMPLE = 'Einfach'; 
protected $AX_ED_FUNADV = 'Fortgeschritten';
protected $AX_ED_EDITORWIDTHL = 'Editor Breite';
protected $AX_ED_EDITORWIDTHD = 'Breite des Editor Fensters';
protected $AX_ED_EDITORHEIGHTL = 'Editor Höhe';
protected $AX_ED_EDITORHEIGHTD = 'Höhe des Editor Fensters';
protected $AX_ED_COMPRESSEDVL = 'Komprimierte Version';
protected $AX_ED_COMPRESSEDVD = 'TinyMCE kann im komprimierten Modus laufen, was zu schnelleren Ladezeiten führt. Dieser Modus funktioniert nicht immer, speziell im IE. Deshalb ist er per Voreinstellung abgeschaltet. Seien sie vorsichtig, wenn sie den Modus aktivieren';
protected $AX_ED_OFF = 'Aus';
protected $AX_ED_ON = 'An';
protected $AX_ED_COMPRESSL = 'Kompression';
protected $AX_ED_COMPRESSD = 'Komprimiere TinyMCE Editor unter Verwendung von gzip (lädt 75% schneller)';
protected $AX_ED_CONVERTURLL = 'Konvertier URLs';
protected $AX_ED_CONVERTURLD = 'Konvertiert absolute in realative URLS.';
protected $AX_ED_ENTENCODL = 'Zeichencodierung';
protected $AX_ED_ENTENCODD = 'Diese Option kontrolliert wie Zeichen verarbeitet werden. Der Wert kann numerisch, benannt oder roh sein. Die Voreinstellung ist benannt.';
protected $AX_ED_TXTDIRL = 'Textrichtung';
protected $AX_ED_TXTDIRD = 'Möglichkeit zur Änderung der Textrichtung';
protected $AX_ED_CNVFONTSPANL = 'Konvertiere Fonts zu Spans';
protected $AX_ED_CNVFONTSPAND = 'Konvertiert Font Elemente zu Span Elementen. Voreingestellt ist Ja, da Fontelemente nicht empfohlen werden.';
protected $AX_ED_FONTSIZETYPEL = 'Font Größe Typ';
protected $AX_ED_FONTSIZETYPED = 'Wählt den Typ der Fontgröße z.B.: 10pt, oder absolute Größe z.B: x-small.';
protected $AX_ED_INLTABLEDITL = 'Inline Tabellenbearbeitung';
protected $AX_ED_INLTABLEDITD = 'Erlaubt Inlinebearbeitung von Tabellen.';
protected $AX_ED_PROHELEMENTSL = 'Verbotene Elemente';
protected $AX_ED_PROHELEMENTSD = 'Elemente die aus dem Text entfernt werden';
protected $AX_ED_EXTELEMENTSL = 'Erweiterte Elemente';
protected $AX_ED_EXTELEMENTSD = 'Erweitert TinyMCE Funktionen durch hinzufügen von extra Elementen. Format: elm[tag1|tag2]';
protected $AX_ED_EVELEMENTSL = 'Ereignis Elemente';
protected $AX_ED_EVELEMENTSD = 'Diese Option sollte eine Komma-Separierte Liste von Elementen enthalten die keine Attrubute haben. Z.B. onclick und ähnliche. Diese Option wird benötigt, weil sonst manche Browser diese Elemente während der Inhaltsbearbeitung ausführen.';
protected $AX_ED_TCSSCLASSESL = 'Template CSS Klassen';
protected $AX_ED_TCSSCLASSESD = 'Lädt CSS Klassen aus der template_css.css';
protected $AX_ED_CCSSCLASSESL = 'Eigene CSS Klassen';
protected $AX_ED_CCSSCLASSESD = 'Hier kann das Laden einer eigenen CSS Datei angefordert werden - geben sie einfach den Namen der CSS Datei an. Diese Datei MUSS am selben Ort liegen wie ihre Template CSS Datei.';
protected $AX_ED_NEWLINESL = 'Neue Zeilen';
protected $AX_ED_NEWLINESD = 'Neue zeilen werden in der gewählten Weise erstellt';
protected $AX_ED_TOOLBARL = 'Werkzeugleiste';
protected $AX_ED_TOOLBARD = 'Position der Werkzeugleiste';
protected $AX_ED_HTMLHEIGHTL = 'HTML Höhe';
protected $AX_ED_HTMLHEIGHTD = 'Höhe des HTML Modus Pop-Up Fensters.';
protected $AX_ED_HTMLWIDTHL = 'HTML Breite';
protected $AX_ED_HTMLWIDTHD = 'Breite des HTML Modus Pop-Up Fensters.';
protected $AX_ED_PREVIEWHEIGHTL = 'Vorschauhöhe';
protected $AX_ED_PREVIEWHEIGHTD = 'Höhe des Vorschau Pop-Up Fensters.';
protected $AX_ED_PREVIEWWIDTHL = 'Vorschau Breite';
protected $AX_ED_PREVIEWWIDTHD = 'Breite des Vorschau Pop-Up Fensters.';
protected $AX_ED_IBROWSERL = 'iBrowser Plugin';
protected $AX_ED_IBROWSERD = 'iBrowser ist eine erweiterte Bilderverwaltung';
protected $AX_ED_PLTABLESL = 'Tabellen Plugin';
protected $AX_ED_PLTABLESD = 'Aktiviert den Tabellen Editor im WYSIWYG Modus.';
protected $AX_ED_PLPASTEL = 'Einfüge Plugin';
protected $AX_ED_PLPASTED = 'Aktiviert das Einfügen aus Word, Einfachen Text einfügen und Alles auswählen.';
protected $AX_ED_PLIMGPLUGINL = 'Fortgeschrittenes Bilder Plugin';
protected $AX_ED_PLIMGPLUGIND = 'Aktiviert die Fortgeschrittene Bilderverwaltung. Per Voreinstellung ist die einfache Verwaltung aktiv.';
protected $AX_ED_PLSEARCHL = 'Suche/Ersetze Plugin';
protected $AX_ED_PLSEARCHD = 'Aktiviert das Suchen und Ersetzen Plugin.';
protected $AX_ED_PLLINKSL = 'Fortgeschritten Links';
protected $AX_ED_PLLINKSD = 'Aktviert das Plugin für fortgeschritten Links. Per Voreinstellung sind einfache Links aktiv.';
protected $AX_ED_PLEMOTL = 'Emoticons Plugin';
protected $AX_ED_PLEMOTD = 'Aktiviert das Emoticons Plugin. Sie können leicht Emoticons hinzufügen.';
protected $AX_ED_PLFLASHL = 'Flash Plugin';
protected $AX_ED_PLFLASHD = 'Aktiviert das Flash Plugin. Damit können sie Flash Multimedia innerhalb des Inhaltes hinzufügen.';
protected $AX_ED_PLDTL = 'Datum/Zeit Plugin';
protected $AX_ED_PLDTD = 'Aktiviert das Datum/Zeit Plugin. Sie können damit aktuelle Zeit und Datum einfügen.';
protected $AX_ED_PLPREVL = 'Vorschau Plugin';
protected $AX_ED_PLPREVD = 'Dieses Plugin fügt einen Vorschau-Button hinzu, der bei Benutzung ein Pop-Up Fenster mit dem aktuellen Inhalt öffnet.';
protected $AX_ED_PLZOOML = 'Zoom Plugin';
protected $AX_ED_PLZOOMD = 'Fügt eine Zoom Drop-Liste hinzu.';
protected $AX_ED_PLFSCRL = 'Vollbild Plugin';
protected $AX_ED_PLFSCRD = 'Dieses Plugin fügt den Vollbild-Modus für TinyMCE hinzu.';
protected $AX_ED_PLPRINTL = 'Drucken Plugin';
protected $AX_ED_PLPRINTD = 'Dieses Plugin fügt einen Druck-Button hinzu.';
protected $AX_ED_PLDIRL = 'Schreibrichtung Plugin';
protected $AX_ED_PLDIRD = 'Mit diesem Modul kann die Schreibrichtung geändert werden. Nützlich für Sprachen, die von rechts nach links geschrieben werden.';
protected $AX_ED_PLFONTSL = 'Font Auswahl Liste';
protected $AX_ED_PLFONTSD = 'Fügte eine DropDown Liste mit der Font Auswahl hinzu.';
protected $AX_ED_PLFONTSZL = 'Font Größe Liste';
protected $AX_ED_PLFONTSZD = 'Fügte eine DropDown Liste mit der Font-Größe Auswahl hinzu.';
protected $AX_ED_PLFORMLSL = 'Format Liste';
protected $AX_ED_PLFORMLSD = 'Fügte eine DropDown Liste mit der Format Auswahl hinzu. z.B: H1, H2, etc.';
protected $AX_ED_PLSSLL = 'Stil Auswahl Liste';
protected $AX_ED_PLSSLD = 'Fügt eine Stilauswahl basierend auf dem aktuellen Template hinzu, oder aus einer zu nennenden CSS Datei ihrer Wahl.';
protected $AX_ED_NAMED = 'Benannt';
protected $AX_ED_NUMERIC = 'Numerisch';
protected $AX_ED_RAW = 'Roh';
protected $AX_ED_LTR = 'Links nach Rechts';
protected $AX_ED_RTL = 'Rechts nach Links';
protected $AX_ED_LENGTH = 'Länge';
protected $AX_ED_ABSSIZE = 'Absolute Größe';
protected $AX_ED_BRELEMENTS = 'BR Elemente';
protected $AX_ED_PELEMENTS = 'P Elemente';
//TOOLS
//Calculator: /administrator/tools/calculator/calculator.xml
protected $AX_TCAL_L = 'Rechner';
protected $AX_TCAL_D = 'Ein fortgeschrittener Javascript Rechner';
//Empty Temporary: /administrator/tools/empty_temporary/empty_temporary.xml
protected $AX_TEMTEMP_L = 'Leere Temporären Ordner';
protected $AX_TEMTEMP_D = 'Leert Elxis (/tmpr) Ordner.';
//FixLanguage: /administrator/tools/fix_language/fix_language.xml
protected $AX_TFIXLANG_L = 'Repariere Sprache';
protected $AX_TFIXLANG_D = 'Prüft multilinguale Datenbanktabellen und repariert sie, falls nötig.';
//Organizer: /administrator/tools/organizer/organizer.xml
protected $AX_TORGANIZ_L = 'Organizer';
protected $AX_TORGANIZ_D = 'Elxis Organizer verwaltet ihre Kontakte, Notizen, Lesezeichen und Termine.';
//Clean Cache: /administrator/tools/clean_cache/clean_cache.xml
protected $AX_TCLEANCACHE_L = 'Leere Cache';
protected $AX_TCLEANCACHE_D = 'Raümt das Cacheverzeichnis auf';
//Chmod: /administrator/tools/chmod/chmod.xml
protected $AX_TCHMOD_L = 'Rechteänderung';
protected $AX_TCHMOD_D = 'Ändert die Rechte des benannten Ordners oder der Datei';
//FixPgSequences: /administrator/tools/fix_pg_sequences/fix_pg_sequences.xml
protected $AX_TFPGSEQ_L = 'Repariere Postgres Sequenzen';
protected $AX_TFPGSEQ_D = 'Repariert Postgres Sequenzen falls nötig.';
//Elxis Registration: /administrator/tools/registration/registration.xml
protected $AX_TELXREG_L = 'Elxis Registrierung';
protected $AX_TELXREG_D = 'Registriert ihre Elxis Installation bei GO UP Inc';
//com_menus/bridge/bridge.xml
protected $AX_BRIDGE_CNAME = 'Bridge';
protected $AX_BRIDGE_CDESC = 'Erstellt einen Link zu einer Bridge.';
//modules/mod_language.xml
protected $AX_NEW_LINE = 'Neue Zeile';
protected $AX_SAME_LINE = 'Selbe Zeile';
protected $AX_INDICATOR = 'Indikator';
protected $AX_INDICATOR_D = 'Zeigt das Wort Sprache als Indikator an';
protected $AX_FLAG = 'Flag';
//modules/mod_language.xml
protected $AX_MODLANGD = 'Zeigt die Frontend Sprachauswahl als Dropdown-Liste, Linkliste, oder Serie von Flags an.';
protected $AX_FLAGS = 'Flags';
protected $AX_SMARTSW = 'Schnellschalter';
protected $AX_SMARTSW_D = 'Erlaubt ihnen die Sprache zu wechseln und auf der selben Seite zu bleiben. Unter bestimmten Bedingungen....';
//modules/mod_random_profile.xml
protected $AX_RP_DESC = 'Zeigt ein Zufalls-Benutzer Profil';
protected $AX_DISPSTYLE = 'Anzeige Stil';
protected $AX_COMPACT = 'Kompakt';
protected $AX_EXTENDED = 'Erweitert';
protected $AX_GENDER = 'Geschlecht';
protected $AX_GENDERDESC = 'Zeige Benutzergeschlecht?';
protected $AX_AGE = 'Alter';
protected $AX_AGEDESC = 'Zeige Benutzeralter?';
protected $AX_REALUNAME = 'Zeige Benutzernamen oder Realname?';
//weblinks item
protected $AX_WBLI_TL = 'Ziel';
//content
protected $AX_RTFICL = 'RTF Icon';
protected $AX_RTFICD = 'Zeige/Verstecke den RTF button - betrifft nur diese Seite.';
//modules/mod_whosonline.xml
protected $AX_MODWHO_FILGR = 'Filtere Gruppen';
protected $AX_MODWHO_FILGRD = 'Falls ja, dann können Benutzer mit niedrigem Level nicht den Anmeldestatus von Benutzern mit höherem Level sehen.';
//search bots
protected $AX_SEARCH_LIMIT = 'Suchlimit';
protected $AX_MAXNUM_SRES = 'Maximale Anzahl an Scuhergebnissen';
//modules/mod_frontpage
protected $AX_MODFRONTPAGE = 'Zeigt eine Zusammnfassung der zuletzt hinzugefügten Dinge auf der Site an. Ideal für die Frontpage.'; 
protected $AX_SECTIONS = 'Sektionen';
protected $AX_SECTIONSD = 'SeKtionen IDs Komma getrennt (,)';
protected $AX_CATEGORIES = 'Kategorien';
protected $AX_CATEGORIESD = 'kategorien IDs Komma getrennt (,)';
protected $AX_NUMDAYS = 'Anzahl von Tagen';
protected $AX_NUMDAYSD = 'Zeige Items die in den letzten X tagen erstellt wurden (voreingestellt ist 900)';
protected $AX_SHOWTHUMBS = 'Zeige Thumbnails';
protected $AX_SHOWTHUMBSD = 'Zeige/Verstecke Thumbnail Bilder im Einleitungstext';
protected $AX_THUMBWIDTHD = 'Breite der Thumbnail Bilder in Pixeln';
protected $AX_THUMBHEIGHTD = 'Höhe der Thumbnail Bilder in Pixeln';
protected $AX_KEEPRATIO = 'Seitenverhältnis beibehalten';
protected $AX_KEEPRATIOD = 'Falls ja, dann ist der Parameter Höhe ohne Bedeutung.';
//com_menus/eblog_item_link/eblog_item_link.xml
protected $AX_EBLOGITEM = 'eBlog Eintrag';
protected $AX_EBLOGITEMD = 'Erstellt einen link zu einem veröffentlichten eBlog-Blog';
//2009.0
protected $AX_COMMENTARY = 'Kommentare';
protected $AX_COMMENTARYD = 'Wählen Sie aus, wer Artikel Kommentieren darf.';
protected $AX_NOONE = 'Niemand';
protected $AX_REGUSERS = 'Angemeldete Benutzer';
protected $AX_ALL = 'Alle';
protected $AX_COMMENTS = 'Kommentare';
protected $AX_COMMENTSD = 'Zeige Anzahl der Kommentare?';

}

?>