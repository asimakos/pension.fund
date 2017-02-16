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
* @description: Serbian Language for XML files
* @note: All values used in admin XML files start with 'AX_'
* @note 2008: values for custom language strings defined as php contants start with 'CX_' (not in this file!)
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* 
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
* 
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


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

protected $AX_MENUIMGL = 'Slika menija';
protected $AX_MENUIMGD = 'Mala slika koja će biti smeštena na levoj ili desnoj strani Vašeg menija. Slike se moraju nalaziti u images/stories/ direktorijumu.';
protected $AX_MENUIMGONLYL = 'Upotreba samo slike menija';
protected $AX_MENUIMGONLYD = 'Ako izaberate  <strong>Da</strong> tada će stavka menija biti predstavljena SAMO određenom slikom.<br /><br />Ako izaberete <strong>Ne</strong> stavka menija će biti predstavljena i slikom i tekstom.';
protected $AX_MENUIMG2D = 'Mala slika koja će biti smeštena na levoj ili desnoj strani Vašeg menija. Slike se moraju nalaziti u /images direktorijumu.';
protected $AX_PAGCLASUFL = 'Sufiks stranice';
protected $AX_PAGCLASUFD = 'Sufiks će biti dodat u css klase stranice, što omogućava pojedinačno stilizovanje stranice.';
protected $AX_TEXTPAGECL = 'Sufiks članka';
protected $AX_TEXTPAGECLD = 'Sufiks će biti dodat u css klase članka, što omogućava pojedinačno stilizovanje stavki sadržaja.';
protected $AX_BACKBUTL = 'Dugme nazad';
protected $AX_BACKBUTD = 'Prikaz/Skrivanje dugmeta nazad, koje korisnika vraća na prethodnu stranicu.';
protected $AX_USEGLB = 'Opšte podešavanje';
protected $AX_HIDE = 'Skrivanje';
protected $AX_SHOW = 'Prikaz';
protected $AX_AUTO = 'Automatski';
protected $AX_PAGTITLSL = 'Prikaz naslova';
protected $AX_PAGTITLSD = 'Prikaz/Skrivanje naslova stranice.';
protected $AX_PAGTITLL = 'Naslov stranice';
protected $AX_PAGTITLD = 'Tekst prikazan na vrhu stranice. Ukoliko je prazno, biće upotrebljen tekst stavke menija.';
protected $AX_PAGTITL2D = 'Tekst prikazan na vrhu stranice.';
protected $AX_LEFT = 'Levo';
protected $AX_RIGHT = 'desno';
protected $AX_PRNTICOL = 'Ikona štampe';
protected $AX_PRNTICOD = 'Prikaz/Skrivanje ikone štampe - samo za ovu stranicu.';
protected $AX_YES = 'Da';
protected $AX_NO = 'Ne';
protected $AX_SECNML = 'Ime sekcije';
protected $AX_SECNMD = 'Prikaz/Skrivanje sekcije kojoj sadržaj pripada.';
protected $AX_SECNMLL = 'Linkovano ime sekcije';
protected $AX_SECNMLD = 'Ime sekcije će predstavljati link ka sekciji.';
protected $AX_CATNML = 'Ime kategorije';
protected $AX_CATNMD = 'Prikaz/Skrivanje kategorije kojoj sadržaj pripada.';
protected $AX_CATNMLL = 'Linkovano ime kategorije';
protected $AX_CATNMLD = 'Ime kategorije će predstavljati link ka kategoriji.';
protected $AX_LNKTTLL = 'Linkovani naslovi';
protected $AX_LNKTTLD = 'Naslovi stavki će predstavljati linkove.';
protected $AX_ITMRATL = 'Ocenjivanje sadržaja';
protected $AX_ITMRATD = 'Prikaz/Skrivanje ocene sadržaja - samo za ovu stranicu.';
protected $AX_AUTNML = 'Imena autora';
protected $AX_AUTNMD = 'Prikaz/Skrivanje imena autora - samo za ovu stranicu.';
protected $AX_CTDL = 'Datum nastanka';
protected $AX_CTDD = 'Prikaz/Skrivanje datuma nastanka - samo za ovu stranicu.';
protected $AX_MTDL = 'Datum i vreme zadnje izmene';
protected $AX_MTDD = 'Prikaz/Skrivanje datum zadnje izmene - samo za ovu stranicu.';
protected $AX_PDFICL = 'PDF ikona';
protected $AX_PDFICD = 'Prikaz/Skrivanje PDF ikone - samo za ovu stranicu.';
protected $AX_PRICL = 'Ikona štampe';
protected $AX_PRICD = 'Prikaz/Skrivanje dugmeta štampe - samo za ovu stranicu.';
protected $AX_EMICL = 'Ikona e-pošte';
protected $AX_EMICD = 'Prikaz/Skrivanje ikone e-pošte - samo za ovu stranicu.';
protected $AX_FTITLE = 'Naslov';
protected $AX_FAUTH = 'Autor';
protected $AX_FHITS = 'Pregledi';
protected $AX_DESCRL = 'Opis';
protected $AX_DESCRD = 'Prikaz/Skrivanje opisa.';
protected $AX_DESCRTXL = 'Opisni tekst';
protected $AX_DESCRTXD = 'Opis stranice. Ukoliko je prazno, biće korišćen _WEBLINKS_DESC iz jezičkog fajla';
protected $AX_IMAGEL = 'Slika';
protected $AX_IMGFRPD = 'Slika za stranicu, mora se nalaziti u /images/stories direktorijumu. Predefinsano je da se učita slika web_links.jpg. -Bez slike- znači da slika neće biti učitana.';
protected $AX_IMGALL = 'Ravnanje slike';
protected $AX_IMGALD = 'Ravnanje slike.';
protected $AX_TBHEADL = 'Zaglavlja tabela';
protected $AX_TBHEADD = 'Prikaz/Skrivanje zaglavlja tabela.';
protected $AX_POSCOLL = 'Kolona pozicije';
protected $AX_POSCOLD = 'Prikaz/Skrivanje kolone pozicije.';
protected $AX_EMAILCOLL = 'Kolona e-pošte';
protected $AX_EMAILCOLD = 'Prikaz/Skrivanje kolone e-pošte.';
protected $AX_TELCOLL = 'Kolona telefona';
protected $AX_TELCOLD = 'Prikaz/Skrivanje kolone telefona.';
protected $AX_FAXCOLL = 'Kolona faksa';
protected $AX_FAXCOLD = 'Prikaz/Skrivanje kolone faksa.';
protected $AX_LEADINGL = '# nosećih članaka';
protected $AX_LEADINGD = 'Broj stavki koje će biti prikazane kao noseće (punom širinom). 0 znači da nijeadan članak neće biti označen kao noseći.';
protected $AX_INTROL = '# uvoda';
protected $AX_INTROD = 'Broj stavki čiji će uvodni teskt biti prikazan.';
protected $AX_COLSL = 'Kolone';
protected $AX_COLSD = 'Broj kolona koje će biti korišćene za prikaz uvodnih tekstova.';
protected $AX_LNKSL = '# linkova';
protected $AX_LNKSD = 'Broj stavki koje će biti prikazane kao linkovi.';
protected $AX_CATORL = 'Poredak kategorije';
protected $AX_CATORD = 'Poredak stavki prema kategoriji.';
protected $AX_OCAT01 = 'Ne, samo primarni poredak';
protected $AX_OCAT02 = 'Uzlazno po naslovu';
protected $AX_OCAT03 = 'Silazno po naslovu';
protected $AX_OCAT04 = 'Poredak';
protected $AX_PRMORL = 'Primarni poredak';
protected $AX_PRMORD = 'Poredak prikazanih stavki.';
protected $AX_OPRM01 = 'Predefinisano';
protected $AX_OPRM02 = 'Poredak na Naslovnoj';
protected $AX_OPRM03 = 'Prvo najstarije';
protected $AX_OPRM04 = 'Prvo najnovije';
protected $AX_OPRM07 = 'Po autoru uzl.';
protected $AX_OPRM08 = 'Po autoru sil.';
protected $AX_OPRM09 = 'Najviše čitanja';
protected $AX_OPRM10 = 'Najmanje čitanja';
protected $AX_PAGL = 'Paginacija';
protected $AX_PAGD = 'Prikaz/Skrivanje paginacije.';
protected $AX_PAGRL = 'Rezultati paginacije';
protected $AX_PAGRD = 'Prikaz/Skrivanje rezultata paginacije ( npr. 1-4 od 4 ).';
protected $AX_MOSIL = 'MOSImages';
protected $AX_MOSID = 'Prikaz {mosimages}.';
protected $AX_ITMTL = 'Naslovi stavki';
protected $AX_ITMTD = 'Prikaz/Skrivanje naslova stavki.';
protected $AX_REMRL = 'Opširnije...';
protected $AX_REMRD = 'Prikaz/Skrivanje opširnije linka.';
protected $AX_OTHCATL = 'Ostale kategorije';
protected $AX_OTHCATD = 'Prikaz/Skrivanje liste ostalih kategorija prilikom pregleda kategorije.';
protected $AX_TDISTPD = 'Tekst prikazan na vrhu stranice.';
protected $AX_ORDBYL = 'Poredak';
protected $AX_ORDBYD = 'Ovim ćete izmeniti poredak stavki.';
protected $AX_MCS_DESCL = 'Opis';
protected $AX_SHCDESD = 'Prikaz/Skrivanje opisa kategorije.';
protected $AX_DESCIL = 'Opisna slika';
protected $AX_MUDATFL = 'Format datuma';
protected $AX_MUDATFD = "Format prikazanog datuma putem PHP strftime Command Format - ukoliko je prazno, koristiće format iz vašeg jezičkog fajla.";
protected $AX_MUDATCL = 'KOlona datuma';
protected $AX_MUDATCD = 'Prikaz/Skrivanje kolone datuma.';
protected $AX_MUAUTCL = 'Kolona autora';
protected $AX_MUAUTCD = 'Prikaz/Skrivanje kolone autora.';
protected $AX_MUHITCL = 'Kolona broja pregleda';
protected $AX_MUHITCD = 'Prikaz/Skrivanje kolone pregleda.';
protected $AX_MUNAVBL = 'Navigaciona traka';
protected $AX_MUNAVBD = 'Prikaz/Skrivanje navigacione trake.';
protected $AX_MUORDSL = 'Izbor poretka';
protected $AX_MUORDSD = 'Prikaz/Skrivanje izbora poretka.';
protected $AX_MUDSPSL = 'Izbor prikaza';
protected $AX_MUDSPSD = 'Prikaz/Skrivanje izbora poretka.';
protected $AX_MUDSPNL = 'Broj prikazanog';
protected $AX_MUDSPND = 'Broj stavki koje će predefinisano biti prikazane.';
protected $AX_MUFLTL = 'Filter';
protected $AX_MUFLTD = 'Prikaz/Skrivanje mogućnosti filtriranja.';
protected $AX_MUFLTFL = 'Filtrirano polje';
protected $AX_MUFLTFD = 'Polje na koje će filter biti primenjen.';
protected $AX_MUOCATL = 'Ostale kategorije';
protected $AX_MUOCATD = 'Prikaz/Skrivanje liste ostalih kategorija.';
protected $AX_MUECATL = 'Prazne kategorije';
protected $AX_MUECATD = 'Prikaz/Skrivanje praznih (bez stavki) kategorija.';
protected $AX_CATDSCL = 'Opis kategorije';
protected $AX_CATDSBLND = 'Prikaz/Skrivanje opisa kategorije, prikazanog ispod imena kategorije.';
protected $AX_NAMCOLL = 'Kolona imena';
protected $AX_LINKDSCL = 'Opis linkova';
protected $AX_LINKDSCD = 'Prikaz/Skrivanje opisnog teksta za linkove.';
//com_contact/contact.xml
protected $AX_CCT_CDESC = 'Ova komponenta izlistava informacije o kontaktima.';
protected $AX_CCT_CATLISTSL = 'Lista kategorija – sekcija';
protected $AX_CCT_CATLISTSD = 'Prikaz/Skrivanje liste kategorija pri pregledu u vidu liste.';
protected $AX_CCT_CATLISTCL = 'Lista kategorija – kategorija';
protected $AX_CCT_CATLISTCD = 'Prikaz/Skrivanje liste kategorija pri pregledu u vidu tabele.';
protected $AX_CCT_CATDSCD = 'Prikaz/Skrivanje opisa za listu ostalih kategorija.';
protected $AX_CCT_NOCATITL = '# stavki kategorije';
protected $AX_CCT_NOCATITD = 'Prikaz/Skrivanje broja stavki u svakoj kategoriji.';
//com_contact/contact_items.xml
protected $AX_CIT_CDESC = 'Parametri za pojedinačne stavke kontakata.';
protected $AX_CIT_NAMEL = 'Ime';
protected $AX_CIT_NAMED = 'Prikaz/Skrivanje informacija.';
protected $AX_CIT_POSITL = 'Pozicija';
protected $AX_CIT_POSITD = 'Prikaz/Skrivanje pozicije.';
protected $AX_CIT_EMAILL = 'e-pošta';
protected $AX_CIT_EMAILD = 'Prikaz/Skrivanje informacija o e-pošti. Ukoliko postavite da se prikazuje, adresa će biti zaštićena od spambota putem javascript-a.';
protected $AX_CIT_SADDREL = 'Adresa';
protected $AX_CIT_SADDRED = 'Prikaz/Skrivanje adrese.';
protected $AX_CIT_TOWNL = 'Grad/Naselje';
protected $AX_CIT_TOWND = 'Prikaz/Skrivanje podataka o gradu/naselju.';
protected $AX_CIT_STATEL = 'Država';
protected $AX_CIT_STATED = 'Prikaz/Skrivanje države.';
protected $AX_CIT_COUNTRL = 'Zemlja';
protected $AX_CIT_COUNTRD = 'Prikaz/Skrivanje podataka o zemlji.';
protected $AX_CIT_ZIPL = 'Poštanski broj';
protected $AX_CIT_ZIPD = 'Prikaz/Skrivanje poštanskog broja.';
protected $AX_CIT_TELL = 'Telefon';
protected $AX_CIT_TELD = 'Prikaz/Skrivanje broja telefona.';
protected $AX_CIT_FAXL = 'Faks';
protected $AX_CIT_FAXD = 'Prikaz/Skrivanje broja faksa.';
protected $AX_CIT_MISCL = 'Dodatne informacije';
protected $AX_CIT_MISCD = 'Prikaz/Skrivanje dodatnih informacija.';
protected $AX_CIT_VCARDL = 'V-kartica';
protected $AX_CIT_VCARDD = 'Prikaz/Skrivanje V-kartice.';
protected $AX_CIT_CIMGL = 'Slika';
protected $AX_CIT_CIMGD = 'Prikaz/Skrivanje slike.';
protected $AX_CIT_DEMAILL = 'Opis e-pošte';
protected $AX_CIT_DEMAILD = 'Prikaz/Skrivanje donjeg opisa.';
protected $AX_CIT_DTXTL = 'Opisni tekst';
protected $AX_CIT_DTXTD = 'Opisni tekst forme e-pošte. Ukoliko je prazno, biće upotrebljen _EMAIL_DESCRIPTION definicija iz Vašeg jezičkog fajla.';
protected $AX_CIT_EMFRML = 'Formular e-pošte';
protected $AX_CIT_EMFRMD = 'Prikaz/Skrivanje forme e-pošte.';
protected $AX_CIT_EMCPYL = 'Kopija e-poruke';
protected $AX_CIT_EMCPYD = 'Prikaz/Skrivanje opcije slanja kopije poruke na sopstvenu e-adresu.';
protected $AX_CIT_DDL = 'Padajući meni';
protected $AX_CIT_DDD = 'Prikaz/Skrivanje padajućeg menija pri pregledu kontakta.';
protected $AX_CIT_ICONTXL = 'Ikone/Tekst';
protected $AX_CIT_ICONTXD = 'Upotreba ikona, teksta ili ničega pri prikazu informacija o kontaktu.';
protected $AX_CIT_ICONS = 'Ikone';
protected $AX_CIT_TEXT = 'Tekst';
protected $AX_CIT_NONE = 'Ništa';
protected $AX_CIT_ADICONL = 'Ikona adrese';
protected $AX_CIT_ADICOND = 'Ikona za informacije o adresi.';
protected $AX_CIT_EMICONL = 'Ikona e-pošte';
protected $AX_CIT_EMICOND = 'Ikona za informacije o e-pošti.';
protected $AX_CIT_TLICONL = 'Ikona telefona';
protected $AX_CIT_TLICOND = 'Ikona za broj telefona.';
protected $AX_CIT_FXICONL = 'Faks ikona';
protected $AX_CIT_FXICOND = 'Ikona za broj faksa.';
protected $AX_CIT_MCICONL = 'Ikona dodatno';
protected $AX_CIT_MCICOND = 'Ikona za dodatne informacije.';
protected $AX_CCT_NAMEL = 'Ime';
protected $AX_CCT_NAMED = 'Prikaz/Skrivanje imena.';
protected $AX_CCT_POSITL = 'Pozicija';
protected $AX_CCT_POSITD = 'Prikaz/Skrivanje pozicije.';
protected $AX_CCT_EMAILL = 'e-pošta';
protected $AX_CCT_EMAILD = 'Prikaz/Skrivanje adrese e-pošte. Ukoliko postavite da se prikazuje, adresa će biti zaštićena od spambota putem javascript-a.';
protected $AX_CCT_SADDREL = 'Adresa';
protected $AX_CCT_SADDRED = 'Prikaz/Skrivanje adrese.';
protected $AX_CCT_TOWNL = 'Grad/Naselje';
protected $AX_CCT_TOWND = 'Prikaz/Skrivanje podataka o gradu/naselju.';
protected $AX_CCT_STATEL = 'Država';
protected $AX_CCT_STATED = 'Prikaz/Skrivanje države.';
protected $AX_CCT_COUNTRL = 'Zemlja';
protected $AX_CCT_COUNTRD = 'Prikaz/Skrivanje podataka o zemlji.';
protected $AX_CCT_ZIPL = 'Poštanski broj';
protected $AX_CCT_ZIPD = 'Prikaz/Skrivanje poštanskog broja.';
protected $AX_CCT_TELL = 'Telefon';
protected $AX_CCT_TELD = 'Prikaz/Skrivanje broja telefona.';
protected $AX_CCT_FAXL = 'Faks';
protected $AX_CCT_FAXD = 'Prikaz/Skrivanje broja faksa.';
protected $AX_CCT_MISCL = 'Dodatne informacije';
protected $AX_CCT_MISCD = 'Prikaz/Skrivanje dodatnih informacija.';
protected $AX_CCT_VCARDL = 'V-kartica';
protected $AX_CCT_VCARDD = 'Prikaz/Skrivanje V-kartice.';
protected $AX_CCT_CIMGL = 'Slika';
protected $AX_CCT_CIMGD = 'Prikaz/Skrivanje slike.';
protected $AX_CCT_DEMAILL = 'Opis e-pošte';
protected $AX_CCT_DEMAILD = 'Prikaz/Skrivanje donjeg opisa.';
protected $AX_CCT_DTXTL = 'Opisni tekst';
protected $AX_CCT_DTXTD = 'Opisni tekst forme e-pošte. Ukoliko je prazno, biće upotrebljen _EMAIL_DESCRIPTION definicija iz Vašeg jezičkog fajla.';
protected $AX_CCT_EMFRML = 'Forma e-pošte';
protected $AX_CCT_EMFRMD = 'Prikaz/Skrivanje primaoca.';
protected $AX_CCT_EMCPYL = 'Koija e-poruke';
protected $AX_CCT_EMCPYD = 'Prikaz/Skrivanje opcije slanja kopije poruke pošiljaocu.';
protected $AX_CCT_DDL = 'Padajući meni';
protected $AX_CCT_DDD = 'Prikaz/Skrivanje padajućeg menija pri pregledu kontakta.';
protected $AX_CCT_ICONTXL = 'Ikone/Tekst';
protected $AX_CCT_ICONTXD = 'Upotreba ikona, teksta ili ničega pri prikazu informacija o kontaktu.';
protected $AX_CCT_ICONS = 'Ikone';
protected $AX_CCT_TEXT = 'Tekst';
protected $AX_CCT_NONE = 'Ništa';
protected $AX_CCT_ADICONL = 'Ikona adrese';
protected $AX_CCT_ADICOND = 'Ikona za informacije o adresi.';
protected $AX_CCT_EMICONL = 'Ikona e-pošte';
protected $AX_CCT_EMICOND = 'Ikona za informacije o e-pošti.';
protected $AX_CCT_TLICONL = 'Ikona telefona';
protected $AX_CCT_TLICOND = 'Ikona za broj telefona.';
protected $AX_CCT_FXICONL = 'Faks ikona';
protected $AX_CCT_FXICOND = 'Ikona za broj faksa.';
protected $AX_CCT_MCICONL = 'Ikona dodatno';
protected $AX_CCT_MCICOND = 'Ikona za dodatne informacije.';
//com_content/content.xml
protected $AX_CNT_CDESC = 'Prikazuje jednu stranicu sadržaja.';
protected $AX_CNT_INTEXTL = 'Uvodni tekst';
protected $AX_CNT_INTEXTD = 'Prikaz/Skrivanje uvodnog teksta.';
protected $AX_CNT_KEYRL = 'Ključna referenca';
protected $AX_CNT_KEYRD = 'Ključna reč koja se može povezati sa tekstom (kao indeks).';
//com_frontpage/frontpage.xml
protected $AX_FP_CDESC = 'Ova komponenta prikazuje sve stavke sadržaja označene za prikaz na naslovnoj strani.';
//com_login/login.xml
protected $AX_LG_CDESC = 'Individualna podešavanja stavki kontakta.';
protected $AX_LG_LPTL = 'Naslov prijavne stranice';
protected $AX_LG_LPTD = 'Tekst prikazan na vrhu strane. Ukoliko je prazno, biće upotrebljeno ime sa menija.';
protected $AX_LG_LRURLL = 'URL redirekcije prijave';
protected $AX_LG_LRURLD = 'Stranica na koju ćete biti upućeni nakon prijave. Ukoliko je prazno, biće učitana Naslovna.';
protected $AX_LG_LJSML = 'Prijavna JS poruka';
protected $AX_LG_LJSMD = 'Prikaz/Skrivanje javascript poruke, kao indikatora uspešne prijave.';
protected $AX_LG_LDESCL = 'Opis prijave';
protected $AX_LG_LDESCD = 'Prikaz/Skrivanje donjeg opisa prijave.';
protected $AX_LG_LDESTL = 'Opisni tekst prijave';
protected $AX_LG_LDESTD = 'Tekst prikazan na prijavnoj stranici. Ukoliko je prazno, _LOGIN_DESCRIPTION će biti upotrebljen.';
protected $AX_LG_LIMGL = 'Slika prijave';
protected $AX_LG_LIMGD = 'Slika za prijavnu stranicu.';
protected $AX_LG_LIMGAL = 'Ravnanje slike';
protected $AX_LG_LIMGAD = 'Ravnanje prijavne slike.';
protected $AX_LG_LOPTL = 'Nslov odjavne stranice';
protected $AX_LG_LOPTD = 'Tekst prikazan na vrhu strane. Ukoliko je prazno, biće upotrebljeno ime sa menija.';
protected $AX_LG_LORURLL = 'URL redirekcije odjave';
protected $AX_LG_LORURLD = 'Stranica na koju ćete biti upućeni nakon odjave. Ukoliko je prazno, biće učitana Naslovna.';
protected $AX_LG_LOJSML = 'Odjavna JS poruka';
protected $AX_LG_LOJSMD = 'Prikaz/Skrivanje javascript poruke, kao indikatora uspešne odjave.';
protected $AX_LG_LODSCL = 'Opis odjave';
protected $AX_LG_LODSCD = 'Prikaz/Skrivanje donjeg opisa odjave.';
protected $AX_LG_LODSTL = 'Opisni tekst odjave';
protected $AX_LG_LODSTD = 'Tekst prikazan na odjavnoj stranici. Ukoliko je prazno, _LOGOUT_DESCRIPTION će biti upotrebljen.';
protected $AX_LG_LOGOIL = 'Odjavna slika';
protected $AX_LG_LOGOID = 'Slika za odjavnu stranicu.';
protected $AX_LG_LOGOIAL = 'Ravnanje slike';
protected $AX_LG_LOGOIAD = 'Ravnanje odjavne slike.';
//com_massmail/massmail.xml
protected $AX_MM_CDESC = 'Ova komponenta omogućava slanje masovne pošte određenim korisničkim grupamma.';
//com_media/media.xml
protected $AX_ME_CDESC = 'Komponenta za uređivanje medijskih fajlova sajta.';
//com_menumanager/menumanager.xml
protected $AX_MNU_CDESC = 'Komponenta za uređivanje menija.';
//com_menus/component_item_link/component_item_link.xml
protected $AX_MUCIL_CNAME = 'Link - stavka komponente';
protected $AX_MUCIL_CDESC = 'Pravi link do postojeće Elxis komponente.';
//com_menus/components/components.xml
protected $AX_MUCOMP_CNAME = 'Komponenta';
protected $AX_MUCOMP_CDESC = 'Prikazuje javni interfejs komponente.';
//com_menus/contact_category_table/contact_category_table.xml
protected $AX_MUCCT_CNAME = 'Tabela - kategorija kontakata';
protected $AX_MUCCT_CDESC = 'Prikazuje tabelu stavki kontakata u određenoj kategoriji.';
protected $AX_MUCCT_CATDL = 'Opis kategorije';
protected $AX_MUCCT_CATDD = 'Prikaz/Skrivanje opisa liste ostalih kategorija.';
//com_menus/contact_item_link/contact_item_link.xml
protected $AX_MUCTIL_CNAME = 'Link - Stavka kontakata';
protected $AX_MUCTIL_CDESC = 'Pravi link do objavljene stavke kontakata';
//com_menus/content_archive_category/content_archive_category.xml
protected $AX_MUCAC_CNAME = 'Blog - sadržaj arhiva kategorije';
protected $AX_MUCAC_CDESC = 'Prikazu arhiviranih stavki određene kategorije.';
//com_menus/content_archive_section/content_archive_section.xml
protected $AX_MUCAS_CNAME = 'Blog - sadržaj arhiva sekcije';
protected $AX_MUCAS_CDESC = 'Prikaz arhiviranih stavki određene sekcije.';
//com_menus/content_blog_category/content_blog_category.xml
protected $AX_MUCBC_CNAME = 'Blog - sadržaj kategorija';
protected $AX_MUCBC_CDESC = 'Prikaz sadržaja kategorija u formi bloga.';
//com_menus/content_blog_section/content_blog_section.xml
protected $AX_MUCBS_CNAME = 'Blog - sadržaj sekcija';
protected $AX_MUCBS_CDESC = 'Prikaz sadržaja sekcija u formi bloga.';
protected $AX_MUCBS_SHSD = 'Prikaz/Skrivanje opisa sekcije.';
//com_menus/content_category/content_category.xml
protected $AX_MUCC_CNAME = 'Tabela - sadržaj kategorije';
protected $AX_MUCC_CDESC = 'Prikazuje tsbelu stavki sadržaja u određenoj kategoriji.';
protected $AX_MUCC_SHLOCD = 'Prikaz/Skrivanje liste ostalih kategorija.';
//com_menus/content_item_link/content_item_link.xml
protected $AX_MCIL_CNAME = 'Link - stavka sadržaja';
protected $AX_MCIL_CDESC = 'Pravi link do punog prikaza objavljene stavke sadržaja.';
//com_menus/content_section/content_section.xml
protected $AX_MCS_CNAME = 'Tabela - sadržaj sekcije';
protected $AX_MCS_CDESC = 'Pravi listu kategorija sadržaja u izabranoj sekciji.';
protected $AX_MCS_STL = 'Naslov sekcije';
protected $AX_MCS_STD = 'Prikaz/Skrivanje naslova sekcije.';
protected $AX_MCS_SHCTID = 'Prikaz/Skrivanje opisne slike sekcije.';
//com_menus/content_typed/content_typed.xml
protected $AX_MLSC_CNAME = 'Link - nezavisna stranica';
protected $AX_MLSC_CDESC = 'Pravi link do nezavisne stranice.';
//com_menus/newsfeed_category_table/newsfeed_category_table.xml
protected $AX_MNSFC_CNAME = 'Tabela - kategorija tekućih vesti';
protected $AX_MNSFC_CDESC = 'Prikazuje stavke tekućih vesti u izabranoj kategoriji.';
protected $AX_MNSFC_SHNCD = 'Prikaz/Skrivanje imena kolone.';
protected $AX_MNSFC_ACL = 'Kolona članaka';
protected $AX_MNSFC_ACD = 'Prikaz/Skrivanje kolone članaka.';
protected $AX_MNSFC_LCL = 'Kolona linka';
protected $AX_MNSFC_LCD = 'Prikaz/Skrivanje kolone linka.';
//com_menus/newsfeed_link/newsfeed_link.xml
protected $AX_MNSFL_CNAME = 'Link - tekuće vesti';
protected $AX_MNSFL_CDESC = 'Pravi link do izvora tekućih vesti.';
protected $AX_MNSFL_FDIML = 'Slika tekućih vesti';
protected $AX_MNSFL_FDIMD = 'Prikaz/Skrivanje slike tekućih vesti.';
protected $AX_MNSFL_FDDSL = 'Opis izvora';
protected $AX_MNSFL_FDDSD = 'Prikaz/Skrivanje opisa izvora tekućih vesti.';
protected $AX_MNSFL_WDCL = 'Broj reči';
protected $AX_MNSFL_WDCD = 'Ograničava broj reči u opisnom tekstu vesti. 0 će prikazati ceo tekst.';
//com_menus/separator/separator.xml
protected $AX_MSEP_CNAME = 'Separator';
protected $AX_MSEP_CDESC = 'Previ separator menija.';
//com_menus/url/url.xml
protected $AX_MURL_CNAME = 'Link - Url';
protected $AX_MURL_CDESC = 'Pravi link do URL-a.';
//com_menus/weblink_category_table/weblink_category_table.xml
protected $AX_MWLC_CNAME = 'Tabela - Web link kategorija';
protected $AX_MWLC_CDESC = 'Prikaz tabele linkova u određenoj Web link kategoriji.';
//com_menus/wrapper/wrapper.xml
protected $AX_MWRP_CNAME = 'Omotač';
protected $AX_MWRP_CDESC = 'Pravi IFrame koji će prikazati eksternu stranicu/sajt u Elxis-u.';
protected $AX_MWRP_SCRBL = 'Klizači';
protected $AX_MWRP_SCRBD = 'Prikaz/Skrivanje horizontalnih i vertikalnih klizača.';
protected $AX_MWRP_WDTL = 'Širina';
protected $AX_MWRP_WDTD = 'Širina IFrame prozora, možete uneti apsolutnu vredost u pikselima, ili relativnu u %.';
protected $AX_MWRP_HEIL = 'Visina';
protected $AX_MWRP_HEID = 'Visina IFrame prozora.';
protected $AX_MWRP_AHL = 'Automatski';
protected $AX_MWRP_AHD = 'Visina će automatski biti podešena na visinu eksterne stranice. Ovo funkcioniše samo za stranice sa Vačeg domena.';
protected $AX_MWRP_AADL = 'Automatska dopuna';
protected $AX_MWRP_AADD = 'Po definiciji, prefiks http:// će biti dodat ukoliko je http:// ili https:// detektovan u url-u unetog linka. Ovde možete ovu mogućnost uključiti ili isključiti.';
//com_menus/system/system.xml
protected $AX_MSYS_CNAME = 'Sistemski link';
protected $AX_MSYS_CDESC = 'Pravi link do sistemskih opcija';
//com_newsfeeds/newsfeeds.xml
protected $AX_NFE_CDESC = 'Ova komponenta uređuje RSS/RDF tekuće vesti.';
protected $AX_NFE_DPD = 'Opis stranice';
protected $AX_NFE_SHFNCD = 'Prikaz/Skrivanje kolone izvora tekućih vesti.';
protected $AX_NFE_NOACL = 'Kolona # članaka';
protected $AX_NFE_NOACD = 'Prikaz/Skrivanje # članaka u izvoru.';
protected $AX_NFE_LCL = 'KOlona linkova';
protected $AX_NFE_LCD = 'Prikaz/Skrivanje kolone linka izvora tekućih vesti.';
protected $AX_NFE_IDL = 'Opis stavke';
protected $AX_NFE_IDD = 'Prikaz/Skrivanje opisa ili uvodnog teksta stavke.';
//com_search/search.xml
protected $AX_SEAR_CDESC = 'Ova komponenta uređuje mogućnosti pretrage.';
//com_syndicate/syndicate.xml
protected $AX_SYN_CDESC = 'Ova komponeta kontroliše podešavanja sindikacije.';
protected $AX_SYN_CACHL = 'Keš';
protected $AX_SYN_CACHD = 'Keširanje fajlova tekućih vesti.';
protected $AX_SYN_CACHTL = 'Vreme keširanja';
protected $AX_SYN_CACHTD = 'Keš će biti osvežen svakih x sekundi.';
protected $AX_SYN_ITMSL = '# stavki';
protected $AX_SYN_ITMSD = 'Broj stavki za sindikaciju.';
protected $AX_SYN_ITMSDFLT = 'Elxis sindikacija';
protected $AX_SYN_TITLE = 'Naslov sindikacije';
protected $AX_SYN_DESCD = 'Opis sindikacije.';
protected $AX_SYN_DESCDFLT = 'Elxis sindikacija sajta';
protected $AX_SYN_IMGD = 'Slika koja će biti uključena u izvor sindikacije.';
protected $AX_SYN_IMGAL = 'Alt slike';
protected $AX_SYN_IMGAD = 'Alt tekst slike.';
protected $AX_SYN_IMGADFLT = 'Powered by Elxis';
protected $AX_SYN_LMTL = 'Ograničenje teksta';
protected $AX_SYN_LMTD = 'Ograničava tekst članka na donju vrednost.';
protected $AX_SYN_TLENL = 'Dužina teksta';
protected $AX_SYN_TLEND = 'Dužina reči teksta članka - 0 znači da tekst neće biti prikatan.';
protected $AX_SYN_LBL = 'Live Bookmarks';
protected $AX_SYN_LBD = 'Aktivacija podrške za Firefox Live Bookmarks funkcionalnost.';
protected $AX_SYN_BFL = 'Bookmark fajl';
protected $AX_SYN_BFD = 'Posebno ime fajla. Ukoliko je prazno, predefisani sani fajl će biti upotrebnjen.';
protected $AX_SYN_ORDL = 'Poredak';
protected $AX_SYN_ORDD = 'Poredak po kome će stavke biti prikazane.';
protected $AX_SYN_MULTIL = 'Višejezičke vesti';
protected $AX_SYN_MULTILD = 'Ukoliko je uključeno, Elxis će kreirati jezički određene vesti.';
//com_trash/trash.xml
protected $AX_TRSH_CDESC = 'Ova komponenta uređuje funkcionalnosti korpe za otpatke.';
//com_typedcontent/typedcontent.xml
protected $AX_TDC_CDESC = 'Ovo prikazuje pojedinačnu stavku sadržaja.';
//com_weblinks/weblinks.xml
protected $AX_WBL_CDESC = 'Ova komponenta prikazuje listu Web linkova.';
protected $AX_WBL_LDL = 'Opisi linkova';
protected $AX_WBL_LDD = 'Prikaz/Skrivanje opisnog teksta linkova.';
protected $AX_WBL_ICL = 'Ikona';
protected $AX_WBL_ICD = 'Ikona koja će biti korišćena sa leve strane url-a linkova u tabelarnom prikazu.';
protected $AX_WBL_SCSL = 'Slike';
protected $AX_WBL_SCSD = 'Prikaz linkovane slike sajta. Ukoliko je uključeno, ikona Web linkova neće biti prikazana.';
//com_weblinks/weblinks_item.xml
protected $AX_WBLI_TD = 'Odredišni prozor u kome će link biti otvoren.';
protected $AX_WBLI_OT01 = 'Isti prozor sa navigacijom';
protected $AX_WBLI_OT02 = 'Novi prozor sa navigacijom';
protected $AX_WBLI_OT03 = 'Novi prozor bez navigacije';
//ADMINISTRATOR MODULES
//administrator/modules/mod_latest.xml
protected $AX_AM_LN_DESC = 'Ovaj modul prikazuje najnovije objavljene stavke sadržaja koje su još aktuelne (neke su možda istekle, iako su najnovije). Stavke prikazane kroz komponentu Naslovne ne nalaze se na listi.'; 
//administrator/modules/mod_logged.xml
protected $AX_AM_LG_DESC = 'Ovaj modul prikazuje listu trenutno prijavljenih korisnika.'; 
//administrator/modules/mod_popular.xml
protected $AX_AM_PI_DESC = 'Ovaj modul prikazuje listu popularnih objavljenih stavki, koje su još uvek aktuelne (neke su možda istekle, iako su popularne). Stavke prikazane kroz komponentu Naslovne ne nalaze se na listi.'; 
//administrator/modules/mod_stats.xml
protected $AX_AM_ST_DESC = 'Ovaj modul prikazuje statistike aktuelnih stavki (neke su možda istekle, iako su najnovije). Stavke prikazane kroz komponentu Naslovne ne nalaze se na listi.'; 
//SITE MODULES
//General
protected $AX_SM_MCSL = 'Sufiks klase modula'; 
protected $AX_SM_MCSD = 'Sufiks koji će biti dodat CSS klasi modula (.moduletable), što omogućuje individualno stilizovanje modula.'; 
protected $AX_SM_MUCSL = 'Sufiks klase menija'; 
protected $AX_SM_MUCSD = 'Sufiks koji će biti dodat CSS klasi stavki menija.'; 
protected $AX_SM_ECL = 'Uključivanje keša'; 
protected $AX_SM_ECD = 'Uključivanje, odnosno, isključivanje keša.'; 
protected $AX_SM_SMIL = 'Prikaz ikona menija'; 
protected $AX_SM_SMID = 'Prikaz ikone menija za izabrane stavke.'; 
protected $AX_SM_MIAL = 'Ravnanje ikone'; 
protected $AX_SM_MIAD = 'Ravnanje ikona menija'; 
protected $AX_SM_MODL = 'Prikaz modula'; 
protected $AX_SM_MODD = 'Omogućava kontrolu tipa sadržaja prikazanog kroz modul.'; 
protected $AX_SM_OP01 = 'Samo stavke sadržaja'; 
protected $AX_SM_OP02 = 'Samo nezavisne stranice'; 
protected $AX_SM_OP03 = 'Oba'; 
//modules/custom.xml
protected $AX_SM_CU_DESC = 'Korisnički modul.'; 
protected $AX_SM_CU_RSURL = 'RSS URL'; 
protected $AX_SM_CU_RSURD = 'Unesite URL RSS/RDF izvora.'; 
protected $AX_SM_CU_FEDL = 'Opis izvora tekućih vesti'; 
protected $AX_SM_CU_FEDD = 'Prikaz opisa izvora tekućih vesti.'; 
protected $AX_SM_CU_FEIL = 'Slika izvora'; 
protected $AX_SM_CU_FEDID = 'Prikazuje sliku vezanu za ceo izvor.'; 
protected $AX_SM_CU_ITL = 'Stavki'; 
protected $AX_SM_CU_ITD = 'Unesite broj RSS stavki za prikaz.'; 
protected $AX_SM_CU_ITDL = 'Opis stavke'; 
protected $AX_SM_CU_ITDD = 'Prikaz opisnog ili uvodnog teksta pojedinačnih stavki.'; 
protected $AX_SM_CU_WCL = 'Broj reči'; 
protected $AX_SM_CU_WCD = 'Omogućava ograničavanje količine opisnog teksta stavki. 0 će prikazati ceo tekst.'; 
//modules/mod_archive.xml
protected $AX_SM_AR_DESC = 'Modul prikazuje listu kalendarskih meseci koje sadrže arhivirane stavke. Nakon što izmenite status stavke na \'arhivirano\' ova lista će biti automatski generisana.'; 
protected $AX_SM_AR_CNTL = 'Broj'; 
protected $AX_SM_AR_CNTD = 'Broj stavki za prikaz (predefinisano je 10).'; 
//modules/mod_banners.xml
protected $AX_SM_BN_DESC = 'Modul banera omogućava prikaz banera na sajtu kroz istoimenu komponentu.'; 
protected $AX_SM_BN_CNTL = 'Klijent'; 
protected $AX_SM_BN_CNTD = "Odnosi se na id klijenta banera. Unesite odvojeno ','!"; 
protected $AX_SM_BN_NBSL = 'Broj prikazanih banera';
protected $AX_SM_BN_NBPRL = 'Broj banera u nizu';
protected $AX_SM_BN_NBPRD = 'Broj banera u nizu. Da biste isključili, stavite na 0. Za vertikalni prikaz, postavite na 1';
protected $AX_SM_BN_UNQBL = 'Jedinstveni baner';
protected $AX_SM_BN_UNQBD = 'Nijedan baner neće biti prikazan više od jednog puta (po sesiji). Kada se svi baneri prikažu, istorija će biti očišćena i resetovana.';
//modules/mod_latestnews.xml
protected $AX_SM_LN_DESC = 'Ovaj modul prikazuje listu najnovijih objavljenih stavki, koje su još uvek aktuelne (neke su možda istekle, iako su najnovije). Stavke prikazane kroz komponentu Naslovne ne nalaze se na listi.'; 
protected $AX_SM_LN_FPIL = 'Stavke Naslovne strane'; 
protected $AX_SM_LN_FPID = 'Prikaz/Skrivanje stavki Naslovne strane - samo pri pregledu stavki sadržaja.'; 
protected $AX_SM_AR_CNT5D = 'Broj stavki za prikaz (predefinisano je 5).'; 
protected $AX_SM_LN_CATIL = 'ID kategorije'; 
protected $AX_SM_LN_CATID = 'Izbor stavki iz jedne ili više kategorija (da biste izabrali više od jedne kategorije, razdvojte ih zarezom , ).'; 
protected $AX_SM_LN_SECIL = 'ID sekcije'; 
protected $AX_SM_LN_SECID = 'Izbor stavki iz jedne ili više sekcija (da biste izabrali više od jedne sekcije, razdvojte ih zarezom , ).'; 
//modules/mod_login.xml
protected $AX_SM_LF_DESC = 'Ovaj modul prikazuje formu prijave. Takođe, prikazuje link za slučaj zaboravljene lozinke. Ako je registracija korisnik uključena, (pogledajte podešavanja), biće prikazan i link za registraciju.'; 
protected $AX_SM_LF_PTL = 'Predtekst'; 
protected $AX_SM_LF_PTD = 'Ovo je tekst ili HTML koji se pojavljuje iznad prijavne forme.'; 
protected $AX_SM_LF_PSTL = 'Posttekst'; 
protected $AX_SM_LF_PSTD = 'Ovo je tekst ili HTML koji se pojavljuje ispod prijavne forme.'; 
protected $AX_SM_LF_LRUL = 'URL prijavne redirekcije'; 
protected $AX_SM_LF_LRUD = 'Stranica na koju će korisnik biti upućen nakon odjave. Ukoliko je prazno, biće prikazana Naslovna strana.'; 
protected $AX_SM_LF_LORUL = 'URL prijavne redirekcije'; 
protected $AX_SM_LF_LORUD = 'Stranica na koju će korisnik biti upućen nakon prijave. Ukoliko je prazno, biće prikazana Naslovna strana.'; 
protected $AX_SM_LF_LML = 'Prijavna poruka'; 
protected $AX_SM_LF_LMD = 'Prikaz/Skrivanje javascript poruke o uspešnoj prijavi.'; 
protected $AX_SM_LF_LOML = 'Odjavna poruka'; 
protected $AX_SM_LF_LOMD = 'Prikaz/Skrivanje javascript poruke o uspešnoj odjavi.'; 
protected $AX_SM_LF_GML = 'Pozdrav'; 
protected $AX_SM_LF_GMD = 'Prikaz/Skrivanje jednostavne pozdravne poruke.'; 
protected $AX_SM_LF_NUNL = 'Ime/Korisničko ime'; 
protected $AX_SM_LF_OP01 = 'Korisničko ime'; 
protected $AX_SM_LF_OP02 = 'Ime'; 
//modules/mod_mainmenu.xml
protected $AX_SM_MNM_DESC = 'Prikaz menija.'; 
protected $AX_SM_MNM_MNL = 'Ime menija'; 
protected $AX_SM_MNM_MND = 'Ime menija (predefinisano je \'mainmenu\').'; 
protected $AX_SM_MNM_MSL = 'Stil menija'; 
protected $AX_SM_MNM_MSD = 'Stil menija'; 
protected $AX_SM_MNM_OP1 = 'Vertikalno'; 
protected $AX_SM_MNM_OP2 = 'Horizontalno'; 
protected $AX_SM_MNM_OP3 = 'Lista'; 
protected $AX_SM_MNM_EML = 'Prošireni meni'; 
protected $AX_SM_MNM_EMD = 'Prošireni meni, kome su sve stavke podmenija vidljive.'; 
protected $AX_SM_MNM_IIL = 'Graničnik'; 
protected $AX_SM_MNM_IID = 'Izbor slike koji će sistem koristiti kao graničnik.'; 
protected $AX_SM_MNM_OP4 = 'Šablon'; 
protected $AX_SM_MNM_OP5 = 'Predefinisane Elxis slike'; 
protected $AX_SM_MNM_OP6 = 'Upotreba donjih parametara'; 
protected $AX_SM_MNM_OP7 = 'Ništa'; 
protected $AX_SM_MNM_II1L = 'Indikator 1'; 
protected $AX_SM_MNM_II1D = 'Slika za prvi podnivo.'; 
protected $AX_SM_MNM_II2L = 'Indikator 2'; 
protected $AX_SM_MNM_II2D = 'Slika za drugi podnivo.'; 
protected $AX_SM_MNM_II3L = 'Indikator 3'; 
protected $AX_SM_MNM_II3D = 'Slika za treći podnivo.'; 
protected $AX_SM_MNM_II4L = 'Indikator 4'; 
protected $AX_SM_MNM_II4D = 'Slika za četvrti podnivo.'; 
protected $AX_SM_MNM_II5L = 'Indikator 5'; 
protected $AX_SM_MNM_II5D = 'Slika za peti podnivo.'; 
protected $AX_SM_MNM_II6L = 'Indikator 6'; 
protected $AX_SM_MNM_II6D = 'Slika za šesti podnivo.'; 
protected $AX_SM_MNM_SPL = 'Separator'; 
protected $AX_SM_MNM_SPD = 'Separator za horizontalni meni.'; 
protected $AX_SM_MNM_ESL = 'Završni separator'; 
protected $AX_SM_MNM_ESD = 'Završni separator za horizontalni meni.';
protected $AX_SM_MNM_IDPR = 'SEO PRO Itemid predučitavanje';
protected $AX_SM_MNM_IDPRD = 'Uključivanjem AJAX predučitavanja Itemid-ja rešava problem sa više stavki menija koje usmeravaju na istu stranicu.';
//modules/mod_mostread.xml
protected $AX_SM_MRC_DESC = 'Ovaj modul prikazuje listu najčitanijih trenutno objavljenih stavki - prema broju čitanja.'; 
protected $AX_SM_MRC_MNL = 'Ime menija'; 
protected $AX_SM_MRC_MND = 'Ime menija (predefinisano je mainmenu).'; 
protected $AX_SM_MRC_FPIL = 'Stavke Naslovne'; 
protected $AX_SM_MRC_FPID = 'Prikaz/Skrivanje stavki Naslovne - samo pri pregledu stavki sadržaja.'; 
protected $AX_SM_MRC_CL = 'Broj'; 
protected $AX_SM_MRC_CD = 'Broj stavki za prikaz (predefinisano je 5).'; 
protected $AX_SM_MRC_CIDL = 'ID kategorije'; 
protected $AX_SM_MRC_CIDD = 'Izbor stavki iz jedne ili više kategorija (da biste izabrali više od jedne kategorije, razdvojte ih zarezom , ).'; 
protected $AX_SM_MRC_SIDL = 'ID sekcije'; 
protected $AX_SM_MRC_SIDD = 'Izbor stavki iz jedne ili više kategorija (da biste izabrali više od jedne sekcije, razdvojte ih zarezom , ).'; 
//modules/mod_newsflash.xml
protected $AX_SM_NWF_DESC = 'Modul vesti nasumično bira objavljene stavke iz odabrane kategorije pri svakom osvežavanju stranice. Može biti prikazan horizontalno ili vertikalno.'; 
protected $AX_SM_NWF_CATL = 'Kategorija'; 
protected $AX_SM_NWF_CATD = 'Kategorija sadržaja.'; 
protected $AX_SM_NWF_STL = 'Stil'; 
protected $AX_SM_NWF_STD = 'Stil prikaza kategorije.'; 
protected $AX_SM_NWF_OP1 = 'Nasumični izbor jedne vesti'; 
protected $AX_SM_NWF_OP2 = 'Horizontalno'; 
protected $AX_SM_NWF_OP3 = 'Vertikalno'; 
protected $AX_SM_NWF_SIL = 'Prikaz slika'; 
protected $AX_SM_NWF_SID = 'Prikaz slika u stavkama.'; 
protected $AX_SM_NWF_LTL = 'Linkovani naslovi'; 
protected $AX_SM_NWF_LTD = 'Linkovanje naslova stavki.'; 
protected $AX_SM_NWF_RML = 'Opširnije...'; 
protected $AX_SM_NWF_RMD = 'Prikaz/Skrivanje ikone opširnije.'; 
protected $AX_SM_NWF_ITL = 'Naslov stavke'; 
protected $AX_SM_NWF_ITD = 'Prikaz naslova stavke.'; 
protected $AX_SM_NWF_NOIL = 'Br. stavki'; 
protected $AX_SM_NWF_NOID = 'Broj stavki za prikaz.'; 
//modules/mod_poll.xml
protected $AX_SM_POL_DESC = 'Ovaj modul dopunjava komponentu glasanje. Koristi se za prikaz konfigurisanih anketa. Ovaj modul se razlikuje od ostalih po tome što je moguće linkovanje sa stavkama menija. Ovo znači da se anketa prikazuje samo na onom stavkama menija koje konfigurisane da je prikazuju.'; 
protected $AX_SM_POL_CATL = 'Kategorija'; 
protected $AX_SM_POL_CATD = 'Kategorija sadržaja.'; 
//modules/mod_random_image.xml
protected $AX_SM_RNI_DESC = 'Ovaj modul nasumično prikazuje slike iz izabranog direktorijuma.'; 
protected $AX_SM_RNI_ITL = 'Tip slike'; 
protected $AX_SM_RNI_ITD = 'Tip slike PNG/GIF/JPG itd. (predefinisano je JPG).'; 
protected $AX_SM_RNI_IFL = 'Direktorijum slika'; 
protected $AX_SM_RNI_IFD = 'Relativna putanja u odnosu na URL sajta, npr: images/stories.'; 
protected $AX_SM_RNI_LNL = 'Link'; 
protected $AX_SM_RNI_LND = 'URL na koji će slika uputiti, npr: http://www.goup.gr'; 
protected $AX_SM_RNI_WL = 'Širina (px)'; 
protected $AX_SM_RNI_WD = 'Širina slike (prikazaće sve slike u ovoj širini).'; 
protected $AX_SM_RNI_HL = 'Visina (px)'; 
protected $AX_SM_RNI_HD = 'Visina slike (prikazaće sve slike u ovoj visini).'; 
//modules/mod_related_items.xml
protected $AX_SM_RLI_DESC = "Ovaj modul prikazuje stavke srodne trenutno prikazanoj. Ovo je bazirano na ključnim rečima. Sve ključne reči prikazane stavke će biti uzete u obzir. Na primer, možete imati stavki koja sadrži reč 'Grčka', i drugu, koja sadrži reč 'Partenon'. Ukoliko uključite reč 'Grčka' u obe stavke, tada će modul izlistati stavku 'Grčka' dok čitate 'Partenon' i obratno."; 
//modules/mod_rssfeed.xml
protected $AX_SM_RSS_DESC = 'Modul sindikacije će prikazati link putm kogaće ljudi moći da redistribuiraju najnovije vesti sa Vašeg sajta. Kada kliknete na RSS ikonu, bićete preusmereni na novu stranicu koja će izlistati najnovije stavke u XML formatu. Da biste koristili izvor tekućih vesti na drugom Elxis sajtu ili čitaču vesti, treba samo da kopirate URL.'; 
protected $AX_SM_RSS_TXL = 'Tekst'; 
protected $AX_SM_RSS_TXD = 'Unesite tekst koji će biti prikazan sa RSS linkovima.'; 
protected $AX_SM_RSS_091D = 'Prikaz/Skrivanje RSS 0.91 linka.'; 
protected $AX_SM_RSS_10D = 'Prikaz/Skrivanje RSS 1.0 linka.'; 
protected $AX_SM_RSS_20D = 'Prikaz/Skrivanje RSS 2.0 linka.'; 
protected $AX_SM_RSS_03D = 'Prikaz/Skrivanje Atom 0.3 linka.'; 
protected $AX_SM_RSS_OPD = 'Prikaz/Skrivanje OPML linka.'; 
protected $AX_SM_RSS_I091L = 'RSS 0.91 slika'; 
protected $AX_SM_RSS_I10L = 'RSS 1.0 slika'; 
protected $AX_SM_RSS_I20L = 'RSS 2.0 slika'; 
protected $AX_SM_RSS_I03L = 'Atom slika'; 
protected $AX_SM_RSS_IOPL = 'OPML slika'; 
protected $AX_SM_RSS_CHID = 'Izbor slike koja će biti upotrebljena.'; 
//modules/mod_search.xml
protected $AX_SM_SEM_DESC = 'Ovaj modul prikazuje polje pretrage.';
protected $AX_SM_SEM_TOP = 'Vrh';
protected $AX_SM_SEM_BTM = 'Dno';
protected $AX_SM_SEM_BWL = 'Širina polja';
protected $AX_SM_SEM_BWD = 'Veličiina polja pretrage.';
protected $AX_SM_SEM_TXL = 'Tekst';
protected $AX_SM_SEM_TXD = 'Tekst koji se pojavljuje u polju pretrage, ukoliko je prazno, učitaće _SEARCH_BOX iz Vašeg jezičkog fajla.';
protected $AX_SM_SEM_BPL = 'Pozicija dugmeta';
protected $AX_SM_SEM_BPD = 'Pozicija dugmeta u odnosu na polje pretrage.';
protected $AX_SM_SEM_BTXL = 'Tekst dugmeta';
protected $AX_SM_SEM_BTXD = 'Tekst koji se pojavljuje na dugmetu pretrage, ukoliko je prazno, učitaće _SEARCH_TITLE iz Vašeg jezičkog fajla.'; 
//modules/mod_sections.xml
protected $AX_SM_SEC_DESC = 'Modul sekcija prikzuje sve sekcije sadržaja iz Vaše baze. Reč sekcija se ovde odnosi na sâme sekcije. Ukoliko u konfiguraciji nije uključen \'Prikaz neautorizovanih linkova\', biće izlistane samo sekcije čiji je pregled korisniku dozvoljen.'; 
protected $AX_SM_SEC_CL = 'Broj';
protected $AX_SM_SEC_CD = 'Broj stavki za prikaz (predefinisano je 5).';
//modules/mod_stats.xml
protected $AX_SM_STA_DESC = 'Modul statistike prikazuje podatke o Vašem serveu, broju stavki u bazi i broju linkova.';
protected $AX_SM_STA_SVIL = 'Informacije o serveru'; 
protected $AX_SM_STA_SVID = 'Prikaz informacija o serveru.'; 
protected $AX_SM_STA_SIL = 'Informacije o sajtu'; 
protected $AX_SM_STA_SID = 'Prikaz informacija o sajtu.'; 
protected $AX_SM_STA_HCL = 'Brojač pregleda'; 
protected $AX_SM_STA_HCD = 'Prikaz brojača pregleda.'; 
protected $AX_SM_STA_ICL = 'Uvećanje broja pregleda'; 
protected $AX_SM_STA_ICD = 'Unesite broj za koji želite da uvećate broj pregleda.'; 
//modules/mod_templatechooser.xml
protected $AX_SM_TMC_DESC = 'Modul izbora šablona omogućava posetiocima sajta izmene šablon putem izbora šablona sa padajućeg menija.'; 
protected $AX_SM_TMC_MNLL = 'Maks. dužina imena'; 
protected $AX_SM_TMC_MNLD = 'Maksimalna dužina imena šablona za prikaz (predefinisano je 20).'; 
protected $AX_SM_TMC_SPL = 'Prikaz slike'; 
protected $AX_SM_TMC_SPD = 'Biće prikazana slika šablona.'; 
protected $AX_SM_TMC_WL = 'Širina'; 
protected $AX_SM_TMC_WD = 'Širina slike šablona (predefinisano je 140 px).'; 
protected $AX_SM_TMC_HL = 'Visina'; 
protected $AX_SM_TMC_HD = 'Visina slike šablona (predefinisano je 90 px).'; 
//modules/mod_whosonline.xml
protected $AX_SM_WSO_DESC = 'Modul Ko je na sajtz prikazuje broj nepoznatih (gosti) i registrovanih korisnika koji trenutno pregledaju sajt.'; 
protected $AX_SM_WSO_DL = 'Prikaz'; 
protected $AX_SM_WSO_DD = 'Izbor onoga što će biti prikazano.'; 
protected $AX_SM_WSO_OP1 = '# gostiju/članova<br />'; 
protected $AX_SM_WSO_OP2 = 'Imena članova<br />'; 
protected $AX_SM_WSO_OP3 = 'Oba'; 
//modules/mod_wrapper.xml
protected $AX_SM_WRM_DESC = 'Ovaj modul prikazuje određeni URL u IFrame prozoru.'; 
protected $AX_SM_WRM_URLL = 'URL'; 
protected $AX_SM_WRM_URLD = 'URL sajta/fajl koji želite da prikažete u IFrame prozoru'; 
protected $AX_SM_WRM_SCBL = 'Klizači'; 
protected $AX_SM_WRM_SCBD = 'Prikaz/Skrivanje horizontalnih i vertikalnih klizača.'; 
protected $AX_SM_WRM_WL = 'Širina'; 
protected $AX_SM_WRM_WD = 'Širina IFrame prozora. Možete uneti apsolutnu širinu u pikselima, ili relativnu u %.'; 
protected $AX_SM_WRM_HL = 'Visina'; 
protected $AX_SM_WRM_HD = 'Visina IFrame prozora'; 
protected $AX_SM_WRM_AHL = 'Automatski'; 
protected $AX_SM_WRM_AHD = 'Visina će biti automatski podešena prema visini prikazane stranice. Ovo važi samo za stranice sa istog domena.'; 
protected $AX_SM_WRM_ADL = 'Automatsko dodavanje'; 
protected $AX_SM_WRM_ADD = 'Prefiks http:// će biti dodat, ukoliko ne postoji http:// ili https:// u URL-u unetog linka, možete ovu mogućnost uključiti ili isključiti.'; 
/* mambots/editors/tinymce */
protected $AX_ED_FUNCTL = 'Funkcionalnost'; 
protected $AX_ED_FUNCTD = 'Izbor funkcionalnosti'; 
protected $AX_ED_FUNSIMPLE = 'Jednostavno'; 
protected $AX_ED_FUNADV = 'Napredno';
protected $AX_ED_EDITORWIDTHL = 'Širina prozora';
protected $AX_ED_EDITORWIDTHD = 'Širina prozora sa tekstom';
protected $AX_ED_EDITORHEIGHTL = 'Visina prozora';
protected $AX_ED_EDITORHEIGHTD = 'Visina prozora sa tekstom';
protected $AX_ED_COMPRESSEDVL = 'Kompresovana verzija';
protected $AX_ED_COMPRESSEDVD = 'TinyMCE može raditi u kompresovanoj varijanti, što dovodi do neznatnog ubrzanja. Ipak, ovo ne radi uvek, naročito u IE, i zato je isključeno po definiciji. Proverite da li će ova opcija za Vas biti korisna';
protected $AX_ED_OFF = 'Isključeno';
protected $AX_ED_ON = 'Uključeno';
protected $AX_ED_COMPRESSL = 'Kompresija';
protected $AX_ED_COMPRESSD = 'Kompresija TinyMCE putem gzip (učitava se 75% brže)';
protected $AX_ED_CONVERTURLL = 'Konverzija URL-ova';
protected $AX_ED_CONVERTURLD = 'Konverzija apsolutnih URL-ova u relativne.';
protected $AX_ED_ENTENCODL = 'Kodiranje karaktera';
protected $AX_ED_ENTENCODD = 'Ova opcija kontroliše način na koji će TinyMCE procesuirati karaktere. Vrednost može biti numerički prikaz, imenovani entitet ili sirovi format, bez kodiranja. Predefinisana opcija je imenovani entitet.';
protected $AX_ED_TXTDIRL = 'Smer teksta';
protected $AX_ED_TXTDIRD = 'Mogućnost promene smera teksta';
protected $AX_ED_CNVFONTSPANL = 'Konverzija fontova u spanove';
protected $AX_ED_CNVFONTSPAND = 'Konverzija font elemenata u spanove. Predefinisano je Da, jer font elementi nisu poželjni.';
protected $AX_ED_FONTSIZETYPEL = 'Tip veličine fonta';
protected $AX_ED_FONTSIZETYPED = 'Izbor korišćene veličine fonta, može biti npr: 10pt, ili npr: x-small.';
protected $AX_ED_INLTABLEDITL = 'Linearno uređivanje tabela';
protected $AX_ED_INLTABLEDITD = 'Omogućava linearno uređivanje tabela.';
protected $AX_ED_PROHELEMENTSL = 'Nedozvoljeni elementi';
protected $AX_ED_PROHELEMENTSD = 'Elementi koji će biti uklonjeni iz teksta';
protected $AX_ED_EXTELEMENTSL = 'Pročireni elementi';
protected $AX_ED_EXTELEMENTSD = 'Prširite funkcionalnost TinyMCE putem dodavanja novih elemenata. Format: elm[tag1|tag2]';
protected $AX_ED_EVELEMENTSL = 'Elementi događaja';
protected $AX_ED_EVELEMENTSD = 'Ova opcija treba da sadrži listu zarezom odvojenih elemenata koji mogu imati atribute događaja, kao npr. onclick i slično. Ova opcija je potrebna jer neki pretraživači izvršavaju događaje prilikom uređivanja teksta.';
protected $AX_ED_TCSSCLASSESL = 'CSS klase šablona';
protected $AX_ED_TCSSCLASSESD = 'Učitavanje CSS klasa iz template_css.css';
protected $AX_ED_CCSSCLASSESL = 'Korisničke CSS klase';
protected $AX_ED_CCSSCLASSESD = 'Ukoliko definišete učitavanje zasebnog CSS fajla - jednostavno unesite ime tog CSS fajla. Ovaj fajl se MORA nalaziti u istom direktorijumu kao i CSS fajl šablona.';
protected $AX_ED_NEWLINESL = 'Novi red';
protected $AX_ED_NEWLINESD = 'Način na koji će novi red biti dodat';
protected $AX_ED_TOOLBARL = 'Alatna traka';
protected $AX_ED_TOOLBARD = 'Pozicija alatne trake';
protected $AX_ED_HTMLHEIGHTL = 'Visina HTML-a';
protected $AX_ED_HTMLHEIGHTD = 'Visina HTML-a prozora.';
protected $AX_ED_HTMLWIDTHL = 'Širina HTML-a';
protected $AX_ED_HTMLWIDTHD = 'Širina HTML-a prozora.';
protected $AX_ED_PREVIEWHEIGHTL = 'Širina pregleda';
protected $AX_ED_PREVIEWHEIGHTD = 'Širina prozora pregleda.';
protected $AX_ED_PREVIEWWIDTHL = 'Visina pregleda';
protected $AX_ED_PREVIEWWIDTHD = 'Širina prozora pregleda.';
protected $AX_ED_IBROWSERL = 'iBrowser dodatak';
protected $AX_ED_IBROWSERD = 'iBrowser je napredni menadžer slika';
protected $AX_ED_PLTABLESL = 'Dodatak tabela';
protected $AX_ED_PLTABLESD = 'Omogućava uređivanje tabela u WYSIWYG modu.';
protected $AX_ED_PLPASTEL = 'Paste dodatak';
protected $AX_ED_PLPASTED = 'Omogućava Paste iz Word-a, Paste običnog teksta i Select All.';
protected $AX_ED_PLIMGPLUGINL = 'Napr. dodatak za slike';
protected $AX_ED_PLIMGPLUGIND = 'Omogućava upotrebu naprednog menadžera slika. Presefinisano se koristi jednostavni menadžer slika.';
protected $AX_ED_PLSEARCHL = 'Pretraga/Zamena';
protected $AX_ED_PLSEARCHD = 'Uključuje Search and Replace dodatak.';
protected $AX_ED_PLLINKSL = 'Napr. linkovi';
protected $AX_ED_PLLINKSD = 'Uključuje napredni menadžer linkova. Predefinisano se koristi jednostavna verzija.';
protected $AX_ED_PLEMOTL = 'Emocije';
protected $AX_ED_PLEMOTD = 'Uključuje dodatak emocija. Omogućava jednostavno dodavanje emocija.';
protected $AX_ED_PLFLASHL = 'Flash dodatak';
protected $AX_ED_PLFLASHD = 'Uključuje Flash dodatak. Omogućava dodavanje Flash-a u sadržaje.';
protected $AX_ED_PLDTL = 'Datum/Vreme';
protected $AX_ED_PLDTD = 'Momogućava dodavanje trenutnog datma/vremena.';
protected $AX_ED_PLPREVL = 'Pregled';
protected $AX_ED_PLPREVD = 'Ovaj dodatak omogućuje dugme pregleda u TinyMCE, klik na ovo dugme otvara prozor u kome se prikazuje izgled članka koji uređujete.';
protected $AX_ED_PLZOOML = 'Zum dodatak';
protected $AX_ED_PLZOOMD = 'Dodaje zum padajući meni u MSIE5.5+.';
protected $AX_ED_PLFSCRL = 'Pun ekran';
protected $AX_ED_PLFSCRD = 'Ovaj dodatak omogućuje da TinyMCE bude prikazan preko selog ekrana.';
protected $AX_ED_PLPRINTL = 'Dodatak štampe';
protected $AX_ED_PLPRINTD = 'Ovaj dodatak dodaje dugme štampe u TinyMCE.';
protected $AX_ED_PLDIRL = 'Dodatak za smer';
protected $AX_ED_PLDIRD = 'Ovaj dodatak dodaje ikone smera u TinyMCE, čime se omogućava bolja manipulacija tekstovima na jeѕicima koji se pišu sdesna nalevo.';
protected $AX_ED_PLFONTSL = 'Lista izbora fonta';
protected $AX_ED_PLFONTSD = 'Omogućava izbor fonta sa liste.';
protected $AX_ED_PLFONTSZL = 'Lista veličine fonta';
protected $AX_ED_PLFONTSZD = 'Omogućava izbor veličine fonta sa liste.';
protected $AX_ED_PLFORMLSL = 'Lista formata';
protected $AX_ED_PLFORMLSD = 'Omogućava padajući meni sa formatima teksta, npr. H1, H2, itd.';
protected $AX_ED_PLSSLL = 'Lista izbora stila';
protected $AX_ED_PLSSLD = 'Dodaje list za izbor stila, baziranu na stilovima Vašeg šablona ili CSS fajla po vašen izboru.';
protected $AX_ED_NAMED = 'Inovani';
protected $AX_ED_NUMERIC = 'Numerički';
protected $AX_ED_RAW = 'Sirovi';
protected $AX_ED_LTR = 'Sleva nadesno';
protected $AX_ED_RTL = 'Sdesna nalevo';
protected $AX_ED_LENGTH = 'Dužina';
protected $AX_ED_ABSSIZE = 'Apsolutna veličina';
protected $AX_ED_BRELEMENTS = 'BR elementi';
protected $AX_ED_PELEMENTS = 'P elementi';
//TOOLS
//Calculator: /administrator/tools/calculator/calculator.xml
protected $AX_TCAL_L = 'Kalkulator';
protected $AX_TCAL_D = 'Napredni javascript kalkulator';
//Empty Temporary: /administrator/tools/empty_temporary/empty_temporary.xml
protected $AX_TEMTEMP_L = 'Brisanje privremenog';
protected $AX_TEMTEMP_D = 'Isprazniće Elxis-ov privremeni direktorijum (/tmpr).';
//FixLanguage: /administrator/tools/fix_language/fix_language.xml
protected $AX_TFIXLANG_L = 'Popravka jezika';
protected $AX_TFIXLANG_D = 'Vrši proveru višejezičkiih tabela i otklanja potencijalne probleme.';
//Organizer: /administrator/tools/organizer/organizer.xml
protected $AX_TORGANIZ_L = 'Organizator';
protected $AX_TORGANIZ_D = 'Elxis organizator čuva Vaše kontakte, beleške, i sastanke.';
//Clean Cache: /administrator/tools/clean_cache/clean_cache.xml
protected $AX_TCLEANCACHE_L = 'Čišćenje keša';
protected $AX_TCLEANCACHE_D = 'Čisti keš direktorijum od keširanih stavki sadržaja i slika';
//Chmod: /administrator/tools/chmod/chmod.xml
protected $AX_TCHMOD_L = 'Izmena dozvola';
protected $AX_TCHMOD_D = 'Izmena dozvola datog direktorijum ili fajla';
//FixPgSequences: /administrator/tools/fix_pg_sequences/fix_pg_sequences.xml
protected $AX_TFPGSEQ_L = 'Popravka Postgres-a';
protected $AX_TFPGSEQ_D = 'Popravka Postgres sekvenci, ukoliko su potrebne.';
//Elxis Registration: /administrator/tools/registration/registration.xml
protected $AX_TELXREG_L = 'Elxis registracija';
protected $AX_TELXREG_D = 'Registruje Vašu Elxis instalaciju na elxis.org';
//com_menus/bridge/bridge.xml
protected $AX_BRIDGE_CNAME = 'Most';
protected $AX_BRIDGE_CDESC = 'Pravi link do mosta.';
//modules/mod_language.xml
protected $AX_NEW_LINE = 'Novi red';
protected $AX_SAME_LINE = 'Isti red';
protected $AX_INDICATOR = 'Indikator';
protected $AX_INDICATOR_D = 'Prikazuje reč Jezik kao indikator';
protected $AX_FLAG = 'Zastava';
//modules/mod_language.xml
protected $AX_MODLANGD = 'Prikazuje izbor jezika kao padajući meni, listu linkova, ili niz zastava.';
protected $AX_FLAGS = 'Zastave';
protected $AX_SMARTSW = 'Pametni prekidač';
protected $AX_SMARTSW_D = 'Omogućava promenu jezika bez promene stranice na kojoj se korisnik nalazi';
//modules/mod_random_profile.xml
protected $AX_RP_DESC = 'Prikaz nasumično izabranih profila korisnika';
protected $AX_DISPSTYLE = 'Stil prikaza';
protected $AX_COMPACT = 'Kompaktno';
protected $AX_EXTENDED = 'Prošireno';
protected $AX_GENDER = 'Pol';
protected $AX_GENDERDESC = 'Prikaz pola korisnika?';
protected $AX_AGE = 'Godine';
protected $AX_AGEDESC = 'Prikaz godina korisnika?';
protected $AX_REALUNAME = 'Prikaz stvarnog ili korisničkog imena?';
//weblinks item
protected $AX_WBLI_TL = 'Odredište';
//content
protected $AX_RTFICL = 'RTF ikona';
protected $AX_RTFICD = 'Prikaz/Skrivanje RTF dugmeta - samo za ovu stranu.';
//modules/mod_whosonline.xml
protected $AX_MODWHO_FILGR = 'Filter grupa';
protected $AX_MODWHO_FILGRD = 'Ukoliko je Da, korisnici sa nižim pristupnim novoom (npr. posetioci) neće moći da vide status korisnika sa višim pristupnim nivoom.';
//search bots
protected $AX_SEARCH_LIMIT = 'Ograničenje pretrage';
protected $AX_MAXNUM_SRES = 'Maksimalni broj rezultata pretrage';
//modules/mod_frontpage
protected $AX_MODFRONTPAGE = 'Prikazuje presek najnovijih doprinosa članova. Idealno za Naslovnu stranu.'; 
protected $AX_SECTIONS = 'Sekcije';
protected $AX_SECTIONSD = 'ID-jevi sekcija odvojeni zarezom (,)';
protected $AX_CATEGORIES = 'Kategorije';
protected $AX_CATEGORIESD = 'ID-jevi kategorija odvojeni zarezom (,)';
protected $AX_NUMDAYS = 'Broj dana';
protected $AX_NUMDAYSD = 'Prikaz stavki nastalih u poslednjih X dana (predefinisano je 900)';
protected $AX_SHOWTHUMBS = 'Prikaz slika';
protected $AX_SHOWTHUMBSD = 'Prikaz/Skrivanje slika u uvodnom tekstu';
protected $AX_THUMBWIDTHD = 'Širina slike u pikselima';
protected $AX_THUMBHEIGHTD = 'Visina slike u pikselima';
protected $AX_KEEPRATIO = 'Očuvanje odnosa';
protected $AX_KEEPRATIOD = 'Očuvanje odnosa slike. Ukoliko je uključeno, parametar visine nije bitan.';
//com_menus/eblog_item_link/eblog_item_link.xml
protected $AX_EBLOGITEM = 'Stavka eBlog';
protected $AX_EBLOGITEMD = 'Napraviće link do objavljenog eBlog bloga';
protected $AX_COMMENTARY = 'Komentari';
protected $AX_COMMENTARYD = 'Izaberite ko može da postavlja komentare.';
protected $AX_NOONE = 'Niko';
protected $AX_REGUSERS = 'Registrovani';
protected $AX_ALL = 'Svi';

protected $AX_COMMENTS = 'Komentari';
protected $AX_COMMENTSD = 'Prikaz broja komentara?';

}

?>