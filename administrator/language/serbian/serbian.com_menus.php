<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ivan Trebješanin
* @link: http://www.elxis-srbija.org
* @email: admin@elxis-srbija.org
* @description: Serbian language for component menus
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_MU_MANAGER = 'Menadžer menija';
public $A_CMP_MU_MXLVLS = 'Maks. nivoa';
public $A_CMP_MU_CANTDEL ='* Ne možete da \'obrišete\' ovaj meni, jer je on neophodan za funkcionisanje Elxis-a *';
public $A_CMP_MU_MANHOME = '* Prva objavljena stavka u ovom meniju [mainmenu] predstavlja \'Naslovnu\' stranu sajta *';
public $A_CMP_MU_MITEM = 'Stavka menija';
public $A_CMP_MU_NSMTG = '* Primetićete da se neki meniji pojavljuju u više od jedne grupe, ali oni su ipak istog tipa.';
public $A_CMP_MU_MITYP = 'Tip menija';
public $A_CMP_MU_WBLV = 'Šta je \'Blog\' prikaz';
public $A_CMP_MU_WTLV = 'Šta je \'Tabelarni\' prikaz';
public $A_CMP_MU_WLIV = 'Šta je \'Lista\' prikaz';
public $A_CMP_MU_SMTAP = '* Neki \'tipovi menija\' pojavljuju se u više od jedne grupe *';
public $A_CMP_MU_MOVEITS = 'Premeštaj stavki menija';
public $A_CMP_MU_MOVEMEN = 'Premeštaj u meni';
public $A_CMP_MU_BEINMOV = 'Stavke menija koje se premeštaju';
public $A_CMP_MU_COPYITS = 'Kopija stavki menija';
public $A_CMP_MU_COPYMEN = 'Kopiranje u meni';
public $A_CMP_MU_BCOPIED = 'Stavke menija za kopiranje';
public $A_CMP_MU_EDNEWSF = 'Uređivanje ove tekuće vesti';
public $A_CMP_MU_EDCONTA = 'Uređivanje ovog kontakta';
public $A_CMP_MU_EDCONTE = 'Uređivanje ovog sadržaja';
public $A_CMP_MU_EDSTCONTE = 'Uređivanje ove nezavisne stranice';
public $A_CMP_MU_MSGITSAV = 'Stavka menija sačuvana';
public $A_CMP_MU_MOVEDTO = ' stavki menija premešteno u ';
public $A_CMP_MU_COPITO = ' stavki menija kopirano u ';
public $A_CMP_MU_THMOD = 'Modul';
public $A_CMP_MU_SCITLKT = 'Morate da izaberete komponentu za linkovanje';
public $A_CMP_MU_COMPLLTO = 'Komponenta za linkovanje';
public $A_CMP_MU_ITEMNAME = 'Stavka mora imati ime';
public $A_CMP_MU_PLSELCMP = 'Izaberite komponentu';
public $A_CMP_MU_PARAVAI = 'Parametri će postati dostupni nakon čuvanja ove stavke';
public $A_CMP_MU_YSELCAT = 'Morate izabrati kategoriju';
public $A_CMP_MU_TMHTITL = 'Ova stavka menija mora imati naslov';
public $A_CMP_MU_TABLE = 'Tabela';
public $A_CMP_MU_CCTBLANK = 'Ukoliko je prazno, ime kategorije će biti automatski upotrebljeno';
public $A_CMP_MU_LNKHNAME = 'Link mora imati ime';
public $A_CMP_MU_SELCONT = 'Morate izabrati kontakt za linkovanje';
public $A_CMP_MU_CONLINK = 'Kontakt za linkovanje:';
public $A_CMP_MU_ONCLOPI = 'Otvaranje u';
public $A_CMP_MU_THETITL = 'Naslov:';
public $A_CMP_MU_YMSSECT = 'Morate izabrati sekciju';
public $A_CMP_MU_ILBLSEC = 'Ukoliko je prazno, ime sekcije će automatski biti upotrebljeno';
public $A_CMP_MU_YCSMC = 'Možete izabrati više kategorija';
public $A_CMP_MU_YCSMS = 'Možete izabrati više sekcija';
public $A_CMP_MU_EDCOI = 'Uređivanje stavke sadržaja';
public $A_CMP_MU_YMSLT = 'Morate izabrati sadržaj za linkovanje';
public $A_CMP_MU_STACONT = 'Sadržaj nezavisne stranice';
public $A_CMP_MU_ONCLOP = 'Otvaranje u';
public $A_CMP_MU_YSNWLT = 'Morate izabrati izvor tekućih vesti';
public $A_CMP_MU_NEWTL = 'Tekuće vesti za linkovanje';
public $A_CMP_MU_SEPER = '- - - - - - -'; //Change this, if you want to change the symbols for seperator line
public $A_CMP_MU_PATNAM = 'Patern/Ime';
public $A_CMP_MU_WRURL = 'Morate uneti url.';
public $A_CMP_MU_WRLINK = 'Link \'omotača\'';
public $A_CMP_MU_MIBGCC = 'Blog - sadržaj kategorije';
public $A_CMP_MU_MITCG = 'Tabela - sadržaj kategorije'; 
public $A_CMP_MU_MICOMP = 'Komponenta';
public $A_CMP_MU_MIBGCS = 'Blog - sadržaj sekcije';
public $A_CMP_MU_MILCMPI = 'Link - stavka komponente';
public $A_CMP_MU_MILCI = 'Link - stavka kontakata';
public $A_CMP_MU_MITBCC = 'Tabela - sadržaj kategorije';
public $A_CMP_MU_MILCEI = 'Link - stavka sadržaja';
public $A_CMP_MU_COTLINK = 'Sadržaj za linkovanje';
public $A_CMP_MU_MITBCS = 'Tabela - sadržaj sekcije';
public $A_CMP_MU_MILSTC = 'Link - nezavisna stranica';
public $A_CMP_MU_MITBNFC = 'Tabela - kategorija tekućih vesti';
public $A_CMP_MU_MILNEW = 'Link - izvor tekućih vesti';
public $A_CMP_MU_MISEP = 'Separator/Placeholder';
public $A_CMP_MU_MILIURL = 'Link - URL';
public $A_CMP_MU_MITBWC = 'Tabela - kategorija Web linkova';
public $A_CMP_MU_MIWRAP = 'Omotač';
public $A_CMP_MU_ITEM = 'Stavka';
public $A_CMP_MU_UMSBRI = 'Morate izabrati most';
public $A_CMP_MU_BRINOINS = 'Most komponenta nije instalirana!';
public $A_CMP_MU_NOPUBBRI = 'Nema objavljenih mostova!';
public $A_CMP_MU_CLVSEO = 'Kliknite na nezavisnu stranicu da biste videli njen SEO naslov';
public $A_CMP_MU_SYSLINK = 'Sistemski link';
public $A_CMP_MU_SYSLINKD = 'Sistemski link bi trebao da se nalazi u objavljenom meniju, na poziciji modula koja NE POSTOJI u šablonu!';
public $A_CMP_MU_PASSR = 'Podsetnik za lozinku';
public $A_CMP_MU_UREG = 'Registracija korisnika';
public $A_CMP_MU_REGCOMP = 'Registracija je završena';
public $A_CMP_MU_ACCACT = 'Aktivacija naloga';
public $A_CMP_MU_MSLINK = 'Morate izabrati sistemski link.';
public $A_CMP_MU_SELLINK = '- Izbor linka -';
public $A_CMP_MU_DONTDEL ='* Nemojte brisati ovaj meni, jer on poboljšava funkcionalnosti Elxis-a. Uverite se da je on objavljen na poziciji koja NE POSTOJI u šablonu! *';
public $A_CMP_MU_EDPROF = 'Uređivanje profila';
public $A_CMP_MU_SUBWEBL = 'Dodavanje web linka';
public $A_CMP_MU_CHECKIN = 'Overa';
public $A_CMP_MU_USERLIST = 'Lista korisnika';
public $A_CMP_MU_POLLS = 'Ankete';
//2008.1
public $A_CMP_MU_SELBLOG = 'Izaberite blog za linkovanje';
public $A_CMP_MU_BLOGLINK = 'Blog za linkovanje';

}

?>
