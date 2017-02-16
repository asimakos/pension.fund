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
* @description: German language for component menus
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direkter Zugriff auf diesen Ort ist nicht erlaubt.' );


class adminLanguage extends standardLanguage {

  public $A_CMP_MU_MANAGER = 'Menüverwaltung';
  public $A_CMP_MU_MXLVLS = 'Maximum Level';
  public $A_CMP_MU_CANTDEL ='* Sie können dieses Menü nicht \'löschen\' es ist für die korrekte Funktionsweise von Elxis erforderlich *';
  public $A_CMP_MU_MANHOME = '* Das erste veröffentlichte Item in diesem Menü [Hauptmenü] ist die voreingestellte \'Startseite\' dieser Webseite *';
  public $A_CMP_MU_MITEM = 'Menü Item';
  public $A_CMP_MU_NSMTG = '* Einige Menüs erscheinen in mehr als einer Gruppe, haben aber trotzdem den gleichen Menütyp.';
  public $A_CMP_MU_MITYP = 'Menü Item Typ';
  public $A_CMP_MU_WBLV = 'Was ist eine \'Blog\' Ansicht';
  public $A_CMP_MU_WTLV = 'Was ist eine \'Tabellen\' Ansicht';
  public $A_CMP_MU_WLIV = 'Was ist eine \'Listen\' Ansicht';
  public $A_CMP_MU_SMTAP = '* Einige \'Menütypen\' erschienen in mehr als einer Gruppe *';
  public $A_CMP_MU_MOVEITS = 'Verschiebe Menü Items';
  public $A_CMP_MU_MOVEMEN = 'Verschiebe zu Menü';
  public $A_CMP_MU_BEINMOV = 'Menü Items werden verschoben';
  public $A_CMP_MU_COPYITS = 'Kopiere Menü Items';
  public $A_CMP_MU_COPYMEN = 'Kopiere zu Menü';
  public $A_CMP_MU_BCOPIED = 'Menü Items werden kopiert';
  public $A_CMP_MU_EDNEWSF = 'Diesen Newsfeed bearbeiten';
  public $A_CMP_MU_EDCONTA = 'Diesen Kontakt bearbeiten';
  public $A_CMP_MU_EDCONTE = 'Diesen Inhalt bearbeiten';
  public $A_CMP_MU_EDSTCONTE = 'Diese autonome Seite bearbeiten';
  public $A_CMP_MU_MSGITSAV = 'Menü Item gespeichert';
  public $A_CMP_MU_MOVEDTO = ' Menü Items verschoben nach ';
  public $A_CMP_MU_COPITO = ' Menü Items kopiert nach ';
  public $A_CMP_MU_THMOD = 'Das Modul';
  public $A_CMP_MU_SCITLKT = 'Sie müssen eine Komponente für diesen Verweis auswählen';
  public $A_CMP_MU_COMPLLTO = 'Komponente zu Link';
  public $A_CMP_MU_ITEMNAME = 'Item muss einen Namen haben';
  public $A_CMP_MU_PLSELCMP = 'Bitte wählen sie eine Komponente';
  public $A_CMP_MU_PARAVAI = 'Parameterliste wird verfügbar seine, sobald sie das neue Menü Item gespeichert haben';
  public $A_CMP_MU_YSELCAT = 'Sie müssen eine Kategorie auswählen';
  public $A_CMP_MU_TMHTITL = 'Dieses Menü Item muss einen Titel haben';
  public $A_CMP_MU_TABLE = 'Tabelle';
  public $A_CMP_MU_CCTBLANK = 'Wenn sie dies leer lassen, wird autoamtisch der Kategoriename verwendet';
  public $A_CMP_MU_LNKHNAME = 'Link muss einen Namen haben';
  public $A_CMP_MU_SELCONT = 'Sie müssen einen Kontakt auswählen, auf den sie verweisen wollen';
  public $A_CMP_MU_CONLINK = 'Kontakt zum Verweis:';
  public $A_CMP_MU_ONCLOPI = 'Bei Klick, Öffnen in';
  public $A_CMP_MU_THETITL = 'Titel:';
  public $A_CMP_MU_YMSSECT = 'Sie müssen eine Sektion auswählen';
  public $A_CMP_MU_ILBLSEC = 'Wenn sie dies leer lassen, wird autoamtisch der Sektionsname verwendet';
  public $A_CMP_MU_YCSMC = 'Sie können mehrere Kategoreien auswählen';
  public $A_CMP_MU_YCSMS = 'Sie können mehrere Sektionen asuwählen';
  public $A_CMP_MU_EDCOI = 'Inhalt Item bearbeiten';
  public $A_CMP_MU_YMSLT = 'Sie müssen einen Inhalt für den Verweis auswählen';
  public $A_CMP_MU_STACONT = 'Autonomer Seiteninhalt';
  public $A_CMP_MU_ONCLOP = 'Bei Klick, öffne';
  public $A_CMP_MU_YSNWLT = 'Sie müssen einen Newsfeed für den Verweis auswählen';
  public $A_CMP_MU_NEWTL = 'Newsfeed zum Verweis';
  public $A_CMP_MU_SEPER = '- - - - - - -'; //Ändern, um die Trennlinie anders zu gestalten
  public $A_CMP_MU_PATNAM = 'Muster/Name';
  public $A_CMP_MU_WRURL = 'Sie müssen eine URL angeben.';
  public $A_CMP_MU_WRLINK = 'Wrapper Link';
  public $A_CMP_MU_MIBGCC = 'Blog - Inhalt Kategorie';
  public $A_CMP_MU_MITCG = 'Tabelle - Kontakt Kategorie'; 
  public $A_CMP_MU_MICOMP = 'Komponente';
  public $A_CMP_MU_MIBGCS = 'Blog - Inhalt Sektion';
  public $A_CMP_MU_MILCMPI = 'Link - Komponente Item';
  public $A_CMP_MU_MILCI = 'Link - Kontakt Item';
  public $A_CMP_MU_MITBCC = 'Tabelle - Inhalt Kategorie';
  public $A_CMP_MU_MILCEI = 'Link - Inhalt Item';
  public $A_CMP_MU_COTLINK = 'Inhalt zum Verweis';
  public $A_CMP_MU_MITBCS = 'Tabelle - Inhalt Sektion';
  public $A_CMP_MU_MILSTC = 'Link - Autonome Seite';
  public $A_CMP_MU_MITBNFC = 'Tabelle - Newsfeed Kategorie';
  public $A_CMP_MU_MILNEW = 'Link - Newsfeed';
  public $A_CMP_MU_MISEP = 'Trenner / Platzhalter';
  public $A_CMP_MU_MILIURL = 'Link - URL';
  public $A_CMP_MU_MITBWC = 'Tabelle - Weblink Kategorie';
  public $A_CMP_MU_MIWRAP = 'Wrapper';
  public $A_CMP_MU_ITEM = 'Item';
  public $A_CMP_MU_UMSBRI = 'Sie müssen eine Bridge wählen';
  public $A_CMP_MU_BRINOINS = 'Komponenten Bridge ist nicht installiert!';
  public $A_CMP_MU_NOPUBBRI = 'Es gibt keine veröffentlichten Bridges!';
  public $A_CMP_MU_CLVSEO = 'Klicken sie auf eine autonome Seite um ihren SEO Titel zu sehen';
  public $A_CMP_MU_SYSLINK = 'System Link';
  public $A_CMP_MU_SYSLINKD = 'Ein Systemlink sollte normalerweise zu einem veröffentlichten Menüset an einer Modulposition gehören, die NICHT in ihrem Template existiert!';
  public $A_CMP_MU_PASSR = 'Passwort Erinnerung';
  public $A_CMP_MU_UREG = 'Benutzer Registrierung';
  public $A_CMP_MU_REGCOMP = 'Registrierung komplett';
  public $A_CMP_MU_ACCACT = 'Account Aktivierung';
  public $A_CMP_MU_MSLINK = 'Sie müssen einen System Link auswählen.';
  public $A_CMP_MU_SELLINK = '- Wähle Link -';
  public $A_CMP_MU_DONTDEL ='* Löschen sie dieses Menü nicht, da es zu einer besseren Funktion von Elxis beiträgt. Stellen sie sicher, das es an einer Modulposition veröffentlicht wird, die in ihrem Template NICHT existiert! *';
  public $A_CMP_MU_EDPROF = 'Profil bearbeiten';
  public $A_CMP_MU_SUBWEBL = 'Übermittle Weblink';
  public $A_CMP_MU_CHECKIN = 'Einchecken';
  public $A_CMP_MU_USERLIST = 'Benutzerliste';
  public $A_CMP_MU_POLLS = 'Abstimmungen';

  //elxis 2008.1
  public $A_CMP_MU_SELBLOG = 'Sie müssen ein Blog auswählen, auf das verwiesen werden soll';
  public $A_CMP_MU_BLOGLINK = 'Zu verlinkendes Blog';

  public function __construct() {	
  }

}

?>