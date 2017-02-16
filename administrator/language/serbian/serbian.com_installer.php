<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ivan Trebješanin
* @link: http://www.elxis-srbija.org
* @email: admin@elxis-srbija.org
* @description: Serbian language for component installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_INS_SDIR = 'Izabor direktorijuma';
public $A_CMP_INS_UPF = 'Dodavanje paketa';
public $A_CMP_INS_PF = 'Paket';
public $A_CMP_INS_UFI = "Dodavanje paketa i instalacija";
public $A_CMP_INS_FDIR = 'Instalacija iz direktorijuma';
public $A_CMP_INS_IDIR = 'Direktorijum instalacije';
public $A_CMP_INS_DOIN = 'Instalacija';
public $A_CMP_INS_CONT = 'Nastavak...';
public $A_CMP_INS_NF = 'Nije pronađen instalator za sledeći element ';
public $A_CMP_INS_NA = 'Nije dostupan instalator za sledeći element';
public $A_CMP_INS_EFU = 'Instalator ne može da nastavi jer je dodavanje onemogućeno. Upotrebite metod instalacije iz direktorijuma.';
public $A_CMP_INS_ERTL = 'Instalator – greška';
public $A_CMP_INS_ERZL = 'Instalator ne može da nastavi jer nije instaliran zlib';
public $A_CMP_INS_ERNF = 'Nije izabran fajl';
public $A_CMP_INS_ERUM = 'Dodavanje novog modula – greška';
public $A_CMP_INS_UPTL = 'Dodavanje ';
public $A_CMP_INS_UPE1 = ' - Dodavanje nije uspelo';
public $A_CMP_INS_UPE2 = ' - Greška pri dodavanju';
public $A_CMP_INS_SUCC = 'Uspešno';
public $A_CMP_INS_ER = 'Greška';
public $A_CMP_INS_ERFL = 'Neuspešno';
public $A_CMP_INS_UPNW = 'Dodavanje novog ';
public $A_CMP_INS_FP = 'Neuspela izmena dozvola za dodati fajl.';
public $A_CMP_INS_FM = 'Neuspešno kopiranje dodatog fajla u <code>/media</code> direktorijum.';
public $A_CMP_INS_FW = 'Dodavanje neuspešno, jer <code>/media</code> direktorijum nije otključan.';
public $A_CMP_INS_FE = 'Neuspešno dodavanje, jer <code>/media</code> direktorijum ne postoji.';
public $A_CMP_INST_ERUNR = 'Nepopravljiva greška';
public $A_CMP_INST_EREXT = 'Greška pri otpakivanju';
public $A_CMP_INST_ERMXM = '<strong>GREŠKA:</strong> Ne mogu da pronađem Elxis XML instalacioni fajl u paketu';
public $A_CMP_INST_ERXML = '<strong>GREŠKA:</strong> Ne mogu da pronađem XML instalacioni fajl u paketu';
public $A_CMP_INST_ERNFN = 'Nije definisano ime fajla';
public $A_CMP_INST_ERVLD = 'nije ispravan Elxis instalacioni fajl';
public $A_CMP_INST_ERINC = 'Klasa ne može da pozove metod instalacije';
public $A_CMP_INST_ERUIC = 'Klasa ne može da pozove metod deinstalacije';
public $A_CMP_INST_ERIFN = 'Instalacioni fajl nije pronađen';
public $A_CMP_INST_ERSXM = 'XML instalacioni fajl nije za';
public $A_CMP_INST_ERCDR = 'Ne mogu da kreiram direktorijum';
public $A_CMP_INST_FNOTE = 'ne postoji!';
public $A_CMP_INST_TAFC = 'Već postoji fajl pod imenom';
public $A_CMP_INST_AYIT = '- Da li pokušavate da instalirate isti CMT dva puta?';
public $A_CMP_INST_FCPF = 'Ne mogu da kopiram fajl';
public $A_CMP_INST_CPTO = 'u';
public $A_CMP_INST_UNINSTALL = 'Deinstalacija';
public $A_CMP_INST_CUDIR = 'Druga komponenta već koristi direktorijum';
public $A_CMP_INST_SQLER = 'SQL greška';
public $A_CMP_INST_CCPHP = 'Ne mogu da kopiram PHP instalacioni fajl.';
public $A_CMP_INST_CCUNPHP = 'Ne mogu da kopiram PHP deinstalacioni fajl.';
public $A_CMP_INST_UNERR = 'Deinstalacija - greška';
public $A_CMP_INST_THCOM = 'Komponenta';
public $A_CMP_INST_ISCOR = 'je osnovna komponenta, i ne može biti deinstalirana.<br />Možete je odjaviti ukoliko je ne koristite';
public $A_CMP_INST_XMLINV = 'XML fajl je neispravan';
public $A_CMP_INST_OFEMP = 'Polje opcije je prazno, ne mogu da uklonim fajlove';
public $A_CMP_INST_INCOM = 'Instalirane komponente';
public $A_CMP_INST_CURRE = 'Trenutno instalirano';
public $A_CMP_INST_MENL = 'Link komponente na meniju';
public $A_CMP_INST_AUURL = 'URL autora';
public $A_CMP_INST_NCOMP = 'Nisu instalirane dodatne komponente';
public $A_CMP_INST_INSCO = 'Instalacija nove komponente';
public $A_CMP_INST_DELE = 'Brisanje';
public $A_CMP_INST_LIDE = 'Jezički id je prazan, ne mogu da uklonim fajlove';
public $A_CMP_INST_ALL = 'Svi';
public $A_CMP_INST_BKLM = 'Nazad na menadžer jezika';
public $A_CMP_INST_NWLA = 'Instalacija novog jezika';
public $A_CMP_INST_NFMM = 'Nijedan fajl nije označen kao bot';
public $A_CMP_INST_MAMB = 'bot';
public $A_CMP_INST_AXST = 'već postoji!';
public $A_CMP_INST_IOID = 'Pogrešan id objekta';
public $A_CMP_INST_FFEM = 'Direktorijum je prazan, ne mogu da uklonim fajlove';
public $A_CMP_INST_DXML = 'Brisanje XML fajla';
public $A_CMP_INST_ICMO = 'je deo osnove sistema, i ne može biti deinstalirana.<br />Možete ga odjaviti ukoliko ga ne koristite';
public $A_CMP_INST_IMBT = 'Instalirani botovi';
public $A_CMP_INST_OMBT = 'Prikazani su samo botovi koji mogu biti deinstalirani - neki osnovni botovi ne mogu se deinstalirati.';
public $A_CMP_INST_MBT = 'Bot';
public $A_CMP_INST_MTYP = 'Tip';
public $A_CMP_INST_NMBT = 'Nisu instalirani posebni botovi.';
public $A_CMP_INST_INMT = 'Instalacija novog bota';
public $A_CMP_INST_UCTP = 'Nepoznat tip klijenta';
public $A_CMP_INST_NFMD = 'Nijedan fajl nije označen kao modul';
public $A_CMP_INST_MODULE = 'Modul';
public $A_CMP_INST_ICMDL = 'je osnovni modul, i ne može biti deinstaliran.<br />Možete ga odjaviti ukoliko ga ne koristite';
public $A_CMP_INST_IMDL = 'Instalirani moduli';
public $A_CMP_INST_OMDL = 'Prikazani su samo moduli koji mogu biti deinstalirani - neki osnovni moduli ne mogu se deinstalirati.';
public $A_CMP_INST_MDLF = 'Fajl modula';
public $A_CMP_INST_NMDL = 'Nisu instalirani dodatni moduli';
public $A_CMP_INST_NWMDL = 'Instalacija novog modula';
public $A_CMP_INST_ALLC = 'Svi';
public $A_CMP_INST_STMDL = 'Moduli sajta';
public $A_CMP_INST_ADMDL = 'Admin. moduli';
public $A_CMP_INST_DDEX = 'Direktorijum ne postoji, ne mogu da uklonim fajlove';
public $A_CMP_INST_TIDE = 'id šablona je prazan, ne mogu da uklonim fajlove';
public $A_CMP_INST_TINS = 'Instalacija novog šablona';
public $A_CMP_INST_BATP = 'Nazad na šablone';
public $A_CMP_INST_INSBR = 'Instalacija novog mosta';
public $A_CMP_INST_BABR = 'Nazad na mostove';
public $A_CMP_INST_ΒIDE = 'id mosta je prazan, ne mogu da uklonim fajlove';
public $A_INST_INCOM = 'Otkrivena je moguća nekompatibilnost između verzije Elxis-a koju koristite i instalirane ekstenzije. 
Bez obzira na ovo, softver će možda raditi kako treba. Ovo je samo obaveštenje.';
public $A_INST_INCOMJOO = 'Instalacioni paket je za Joomla CMS!';
public $A_INST_INCOMMAM = 'Instalacioni paket je za Mambo CMS!';
public $A_INST_OLDER = 'Instalacioni paket je za prethodnu Elxis verziju (%s), a ne za Vašu (%s)';
public $A_INST_NEWER = 'Instalacioni paket je za noviju Elxis verziju (%s), a ne za Vašu (%s)';

//2009.0
public $A_INST_DOINEDC = 'Preuzimanje i instalacija sa Elxis Downloads Center-a';
public $A_INST_FETCHAVEXTS = 'Lista najnovijih ekstenzija';
public $A_INST_MORE = 'Više';
public $A_INST_LESS = 'Manje';
public $A_INST_SIZE = 'Veličina';
public $A_INST_DOWNLOAD = 'Preuzimanje';
public $A_INST_DOWNLOADS = 'Preuzimanja';
public $A_INST_DOWNINST = 'Preuzimanje i instalacija';
public $A_INST_LICENSE = 'Licenca';
public $A_INST_COMPAT = 'Kompatibilnost';
public $A_INST_DATESUB = 'Datum postavljanja';
public $A_INST_SUREINST = 'Dali ste sigurni da želite da instalirate %s ?'; //translators help: filled in be extension title
//2009.2
public $A_INST_UPTODATE = 'Aktuelno';
public $A_INST_OUTDATED = 'Zastarelo';
public $A_INST_INSTVERS = 'Instalirana verzija';
public $A_INST_UNLOAD = 'Isključivanje';
public $A_INST_EDCUPDESC = 'Lista instaliranih ekstenzija i njihov status.<br />
	Informacija je dobijena uživo putem <a href="http://www.elxis-downloads.com/" title="EDC" target="_blank">Elxis Downloads Center</a>.<br />
	Kako bi provera verzije bila uspešna Vaš sajt mora da se poveže sa <strong>EDC</strong> udaljenim serverom.';
public $A_INST_EDCUPNOR = "Provera verzije nije dobila odgovor.<br />
	Najverovatnije ne postoji %s instalirano."; //translators help: filled in be extension type (i.e. module)
}

?>