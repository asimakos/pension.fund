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
* @description: Serbian language for component content
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_CNT_ITEMSMNG = 'Menadžer sadržaja';
public $A_CMP_CNT_DATEFORMAT = 'Y-m-d h:i:s';
public $A_CMP_CNT_ALTEDITCONT = 'Uređivanje sadržaja';
public $A_CMP_CNT_TRASH = 'Izaberite stavku koju želite da pošaljete u kantu za otpatke';
public $A_CMP_CNT_TRASHMESS = 'Da li ste sigurni da želite da bacite izabranu stavku(e) sadržaja? \nOvim nećete trajno obrisati stavku(e) sadržaja.';
public $A_CMP_CNT_ARCHMANAGER = 'Menadžer arhiva';
public $A_CMP_CNT_DATECREATED = '%d. %m. %Y. %H:%M';
public $A_CMP_CNT_DATEMODIFIED = '%d. %m. %Y. %H:%M';
public $A_CMP_CNT_MUSTTITLE = 'Stavka sadržaja mora imati naslov.';
public $A_CMP_CNT_MUSTSECTN = 'Morate izabrati sekciju.';
public $A_CMP_CNT_MUSTCATEG = 'Morate izabrati kategoriju.';
public $A_CMP_CNT_CONTITEM = 'Stavka sadržaja';
public $A_CMP_CNT_ITEMDETLS = 'Podaci o stavci';
public $A_CMP_CNT_INTRO = 'Uvod: (obavezno)';
public $A_CMP_CNT_MAIN = 'Glavni tekst: (izborno)';
public $A_CMP_CNT_FRONTPAGE = 'Prikaz na Naslovnoj';
public $A_CMP_CNT_AUTHOR = 'Pseudonim autora';
public $A_CMP_CNT_CREATOR = 'Izmena autora';
public $A_CMP_CNT_OVERRIDE = 'Izmena datuma nastanka';
public $A_CMP_CNT_STRTPUB = 'Početak objavljivanja';
public $A_CMP_CNT_FNSHPUB = 'Kraj objavljivanja';
public $A_CMP_CNT_DRFTUNPUB = 'Neobjavljeni nacrt';
public $A_CMP_CNT_RESETHIT = 'Poništavanje broja pregleda';
public $A_CMP_CNT_REVISED = 'Revidirano';
public $A_CMP_CNT_TIMES = 'puta';
public $A_CMP_CNT_BY = 'od strane';
public $A_CMP_CNT_NEWDOC = 'Novi dokument';
public $A_CMP_CNT_LASTMOD = 'Zadnja izmena';
public $A_CMP_CNT_NOTMOD = 'Neizmenjeno';
public $A_CMP_CNT_ADDETC = 'Dodavanje Sekc./Kat./Naslov';
public $A_CMP_CNT_LINKCI = 'Ovo će kreirati \'Link - stavka sadržaja\' u izabranom meniju';
public $A_CMP_CNT_SOMTHING = 'Izaberite nešto';
public $A_CMP_CNT_MVEITEMS = 'Premeštaj stavki';
public $A_CMP_CNT_MVESECCAT = 'Premeštaj u sekciju/kategoriju';
public $A_CMP_CNT_ITMSMVED = 'Stavke za premeštaj';
public $A_CMP_CNT_SECCAT = 'Izaberite sekciju/kategoriju u koju će stavke biti kopirane';
public $A_CMP_CNT_CPYITEMS = 'Kopiranje stavki';
public $A_CMP_CNT_CPYSECCAT = 'Kopiranje u sekciju/kategoriju';
public $A_CMP_CNT_ITMSCPED = 'Stavke koje se kopiraju';
public $A_CMP_CNT_CCHECL = 'Keš je očišćen';
public $A_CMP_CNT_CANNOT = 'Ne možete uređivati arhiviranu stavku';
public $A_CMP_CNT_THMODULIS = 'Modul';
public $A_CMP_CNT_DROWCRED = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_DROWMOD = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_DROWPUB = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_PBLINEV = 'Nikada';
public $A_CMP_CNT_DPUBLISHUP = 'Y-m-d';
public $A_CMP_CNT_SLSECTN = 'Izbor sekcije';
public $A_CMP_CNT_SELCAT = 'Izbor kategorije';
public $A_CMP_CNT_ARCHVED = 'Stavka je uspešno arhivirana';
public $A_CMP_CNT_PUBLSHED = 'Stavka je uspešno objavljena';
public $A_CMP_CNT_ITSUUNP = 'Stavka je uspešno odjavljena';
public $A_CMP_CNT_ITSUUNA = 'Stavka je uspešno dearhivirana';
public $A_CMP_CNT_SELITOG = 'Izaberite stavku za izmenu';
public $A_CMP_CNT_SELIDEL = 'Izaberite stavku za brisanje';
public $A_CMP_CNT_ERROCCRD = 'Došlo je do greške';
public $A_CMP_CNT_MOVD = 'Stavka je uspešno premeštena u sekciju';
public $A_CMP_CNT_COPED = 'Stavka je uspešno kopirana u sekciju';
public $A_CMP_CNT_RSTHTCNT = 'Uspešno je poništen broj pregleda za';
public $A_CMP_CNT_INMENU = '(Link - nezavisna strana) u meniju';
public $A_CMP_CNT_SUCCSS = 'uspešno kreirana';
public $A_CMP_CNT_RSZERO = 'Da li ste sigurni da želite da poništite broj pregleda na nulu? \nSve izmene ove stavke će biti izgubljene.';
public $A_CMP_CNT_MUST_CIMNA = 'Stavka sadržaja mora imati ime';
public $A_CMP_CNT_SITMAPFOR = 'Mapa sajta za';
public $A_CMP_CNT_ALLLANGS = 'Svi jezici';
public $A_CMP_CNT_LANG = 'jezik';
public $A_CMP_CNT_PHRENAME = 'Držite pritisnuto da biste preimenovali';
public $A_CMP_CNT_EDITITEM = 'Uređivanje stavke';
public $A_CMP_CNT_NOTES = 'Beleške';
public $A_CMP_CNT_PRSHREN = 'Držite pritisnuto da biste preimenovali stavku';
public $A_CMP_CNT_EMPCATSEC = 'Stablo ne prikazuje prazne sekcije i kategorije.';
public $A_CMP_CNT_TREEUNPUBL = 'Stavke označene sivom bojom i kurzivom su odjavljene';
public $A_CMP_CNT_NULLVAL = 'Prosleđena je nulta vrednost!';
public $A_CMP_CNT_INCCTP = 'Neispravan tip sadržaja';
public $A_CMP_CNT_CLDNFETCH = 'Ne mogu da prosledim podatke';
public $A_CMP_CNT_TRSELPAIR = 'Izaberite jezički par';
public $A_CMP_CNT_TRSOUDEST = 'Izaberite izvorni i odredišni jezik';
public $A_CMP_CNT_TRITEMS = 'Prevod stavke je u toku';
public $A_CMP_CNT_TRNOTE = '<strong>Beleška:</strong> Pažljivo izaberite izvorni i odredišni jezik. Ova procedura može potrajati 
        u zavisnosti od količine teksta koji treba prevesti.<br />
        Prevod je baziran na besplatnom Altavista servisu za prevode.
        Elxis nije odgovoran za kvalitet prevoda.';
public $A_CMP_CNT_TRSELITEM = 'Izaberite stavku za prevod';
public $A_CMP_CNT_TROKSAVED = 'Stavka je uspešno prevedena i kopirana';
public $A_CMP_CNT_TRITMNOTF = 'Izabrana stavka nije pronađena u bazi!';
public $A_CMP_CNT_MFS = 'Poruka od servera';
public $A_CMP_CNT_WID = 'sa id-jem';
public $A_CMP_CNT_RNMTO = 'preimenovana u';
public $A_CMP_CNT_FL= 'Filter jezika';
public $A_CMP_CNT_CONFL = 'Jezički konflikt';
public $A_CMP_CNT_CONFI = 'Stavka je smeštema u kategoriju čija jezička podešavanja ne dozvoljavaju njen prikaz!';
public $A_CMP_CNT_STARTALW = 'Početak: uvek';
public $A_CMP_CNT_FINNOEXP = 'Kraj: bez isteka';
public $A_CMP_CNT_FINISH = 'Kraj';
public $A_CMP_CNT_FROM = 'od';
public $A_CMP_CNT_SHOWHIDE = 'Prikazano/Skriveno';
public $A_SIMPLEVIEW = 'Jednostavni prikaz';
public $A_EXTENDVIEW = 'Napredni prikaz';
public $A_CMP_CNT_COMMENTS = 'Komentari';
public $A_CMP_CNT_SAVTRANS = 'Stavke su prebačene i sačuvane kao sadržaj sajta';
public $A_CMP_CNT_RELLINKS = 'Srodni linkovi';
public $A_CMP_CNT_RELLINKSD = 'Linkovi bliski ovom članku. Ukoliko želite da dodate eksterne linkove, dodajte http:// na početak URL-a.';

}

?>
