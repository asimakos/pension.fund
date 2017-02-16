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
* @description: Dutch language for component menus
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_MU_MANAGER = 'Menu Beheerder';
public $A_CMP_MU_MXLVLS = 'Max niveau\'s';
public $A_CMP_MU_CANTDEL ='* Je kan dit menu niet \'verwijderen\' omdat het noodzakelijk is voor de goede werking van Elxis *';
public $A_CMP_MU_MANHOME = '* Het eerste gepubliceerde item in dit menu [mainmenu] is de standaard \'Homepage\' voor de website *';
public $A_CMP_MU_MITEM = 'Menu Item';
public $A_CMP_MU_NSMTG = '* Noteer dat sommige menu types in meer dan één groep verschijnen, ze blijven echter hetzelfde menu type.';
public $A_CMP_MU_MITYP = 'Menu Item Type';
public $A_CMP_MU_WBLV = 'Wat is een \'Blog\' weergave';
public $A_CMP_MU_WTLV = 'Wat is een \'Tabel\' weergave';
public $A_CMP_MU_WLIV = 'Wat is een \'Lijst\' weergave';
public $A_CMP_MU_SMTAP = '* Sommige \'Menu Types\' verschijnen in meer dan één groep *';
public $A_CMP_MU_MOVEITS = 'Verplaats Menu Items';
public $A_CMP_MU_MOVEMEN = 'Verplaats naar Menu';
public $A_CMP_MU_BEINMOV = 'Menu Items worden verplaatst';
public $A_CMP_MU_COPYITS = 'Kopieer Menu Items';
public $A_CMP_MU_COPYMEN = 'Kopieer naar Menu';
public $A_CMP_MU_BCOPIED = 'Menu Items worden gekopieerd';
public $A_CMP_MU_EDNEWSF = 'Bewerk deze Nieuwsfeed';
public $A_CMP_MU_EDCONTA = 'Bewerk dit Contact';
public $A_CMP_MU_EDCONTE = 'Bewerk dit artikel';
public $A_CMP_MU_EDSTCONTE = 'Bewerk deze alleenstaande pagina';
public $A_CMP_MU_MSGITSAV = 'Menu item Opgeslagen';
public $A_CMP_MU_MOVEDTO = ' Menu Items verplaatst naar ';
public $A_CMP_MU_COPITO = ' Menu Items gekopieerd naar ';
public $A_CMP_MU_THMOD = 'De module';
public $A_CMP_MU_SCITLKT = 'Je moet een component selecteren om naar te linken';
public $A_CMP_MU_COMPLLTO = 'Component om naar te linken';
public $A_CMP_MU_ITEMNAME = 'Item moet een naam hebben';
public $A_CMP_MU_PLSELCMP = 'Selecteer een Component';
public $A_CMP_MU_PARAVAI = 'Parameter lijst zal beschikbaar komen nadat je dit nieuwe menu item hebt opgeslagen';
public $A_CMP_MU_YSELCAT = 'Je moet een categorie selecteren';
public $A_CMP_MU_TMHTITL = 'Dit menu item moet een titel hebben';
public $A_CMP_MU_TABLE = 'Tabel';
public $A_CMP_MU_CCTBLANK = 'Als je dit leeg laat zal de categorienaam automatisch gebruikt worden';
public $A_CMP_MU_LNKHNAME = 'Link moet een naam hebben';
public $A_CMP_MU_SELCONT = 'Je moet een Contact selecteren om naar te linken';
public $A_CMP_MU_CONLINK = 'Contact om naar te linken:';
public $A_CMP_MU_ONCLOPI = 'Bij klikken, Open in';
public $A_CMP_MU_THETITL = 'Titel:';
public $A_CMP_MU_YMSSECT = 'Je moet een sectie selecteren';
public $A_CMP_MU_ILBLSEC = 'Als je dit leeg laat zal de sectienaam automatisch gebruikt worden';
public $A_CMP_MU_YCSMC = 'Je kan meerdere categorieën selecteren';
public $A_CMP_MU_YCSMS = 'Je kan meerdere secties selecteren';
public $A_CMP_MU_EDCOI = 'Bewerk Artikel';
public $A_CMP_MU_YMSLT = 'Je moet een Artikel selecteren om naar te linken';
public $A_CMP_MU_STACONT = 'Alleenstaande pagina';
public $A_CMP_MU_ONCLOP = 'Bij klikken, open';
public $A_CMP_MU_YSNWLT = 'Je moet een Nieuwsfeed selecteren om naar te linken';
public $A_CMP_MU_NEWTL = 'Nieuwsfeed om naar te linken';
public $A_CMP_MU_SEPER = '- - - - - - -'; //Change this, if you want to change the symbols for seperator line
public $A_CMP_MU_PATNAM = 'Patroon/Naam';
public $A_CMP_MU_WRURL = 'Je moet een url geven.';
public $A_CMP_MU_WRLINK = 'Wrapper Link';
public $A_CMP_MU_MIBGCC = 'Blog - Artikel Categorie';
public $A_CMP_MU_MITCG = 'Tabel - Contact Categorie'; 
public $A_CMP_MU_MICOMP = 'Component';
public $A_CMP_MU_MIBGCS = 'Blog - Artikel Sectie';
public $A_CMP_MU_MILCMPI = 'Link - Component Item';
public $A_CMP_MU_MILCI = 'Link - Contact Item';
public $A_CMP_MU_MITBCC = 'Tabel - Artikel Categorie';
public $A_CMP_MU_MILCEI = 'Link - Artikel Item';
public $A_CMP_MU_COTLINK = 'Artikel om naar te linken';
public $A_CMP_MU_MITBCS = 'Tabel - Artikel Sectie';
public $A_CMP_MU_MILSTC = 'Link - Alleenstaande pagina';
public $A_CMP_MU_MITBNFC = 'Tabel - Nieuwsfeed Categorie';
public $A_CMP_MU_MILNEW = 'Link - Nieuwsfeed';
public $A_CMP_MU_MISEP = 'Scheidingsruimte / Scheidingsteken';
public $A_CMP_MU_MILIURL = 'Link - URL';
public $A_CMP_MU_MITBWC = 'Tabel - Weblink Categorie';
public $A_CMP_MU_MIWRAP = 'Wrapper';
public $A_CMP_MU_ITEM = 'Item';
public $A_CMP_MU_UMSBRI = 'Je moet een brug selecteren';
public $A_CMP_MU_BRINOINS = 'Component Brug is niet geïnstalleerd!';
public $A_CMP_MU_NOPUBBRI = 'Er zijn geen gepubliceerde bruggen!';
public $A_CMP_MU_CLVSEO = 'Klik op een alleenstaande pagina om zijn SEO titel te bekijken';
public $A_CMP_MU_SYSLINK = 'Systeem link';
public $A_CMP_MU_SYSLINKD = 'Een Systeem Link zou normaal moeten toebehoren aan een gepubliceerde menuset op een module positie die niet bestaat in de template!';
public $A_CMP_MU_PASSR = 'Paswoord herinnering';
public $A_CMP_MU_UREG = 'Gebruikers registratie';
public $A_CMP_MU_REGCOMP = 'Registratie volledig';
public $A_CMP_MU_ACCACT = 'Account activatie';
public $A_CMP_MU_MSLINK = 'Je moet een systeem link selecteren.';
public $A_CMP_MU_SELLINK = '- Selecteer link -';
public $A_CMP_MU_DONTDEL ='* Verwijder dit menu niet omdat het de werking van Elxis verbetert. Wees zeker dat je het publiceert op een modulepositie die niet bestaat in de template! *';
public $A_CMP_MU_EDPROF = 'Bewerk profiel';
public $A_CMP_MU_SUBWEBL = 'Weblink inzenden';
public $A_CMP_MU_CHECKIN = 'Check-in';
public $A_CMP_MU_USERLIST = 'Gebruikers lijst';
public $A_CMP_MU_POLLS = 'Enquêtes';
public $A_CMP_MU_SELBLOG = 'Je moet een blog selecteren om naar te linken';
public $A_CMP_MU_BLOGLINK = 'Blog om naar te linken';

}

?>