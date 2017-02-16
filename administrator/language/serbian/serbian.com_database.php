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
* @description: Serbian language for component database
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_DB_TABNM = 'Ime tabele';
public $A_CMP_DB_ACTIONS = 'Akcije';
public $A_CMP_DB_TDESCR = 'Opis tabele';
public $A_CMP_DB_BROWSE = 'Pregled';
public $A_CMP_DB_STRUCTURE = 'Struktura';
public $A_CMP_DB_INFO = 'Informacije';
public $A_CMP_DB_DUMPDB = 'Kopija baze';
public $A_CMP_DB_XDUMPDB = 'XML/SQL kopija';
public $A_CMP_DB_BACTYPE = 'Tip bekapa';
public $A_CMP_DB_XML = 'XML';
public $A_CMP_DB_SQL = 'SQL';
public $A_CMP_DB_XCRBACK = 'Pravljenje XML bekapa';
public $A_CMP_DB_XFULL = 'Struktura i podaci';
public $A_CMP_DB_XSTRUONL = 'Samo struktura';
public $A_CMP_DB_XSAVSERV = 'Čuvanje na serveru';
public $A_CMP_DB_DOWNLD = 'Preuzimanje';
public $A_CMP_DB_XMLBACK = 'XML bekap';
public $A_CMP_DB_SCRBACK = 'Pravljenje SQL bekapa';
public $A_CMP_DB_SFULL = 'Struktura i podaci';
public $A_CMP_DB_SDATAONL = 'Samo podaci';
public $A_CMP_DB_SLOCTBL = 'Zaključavanje tabela';
public $A_CMP_DB_SFSYNTX = 'Puna sintaksa';
public $A_CMP_DB_SDRTBL = 'Brisanje tabele';
public $A_CMP_DB_STBLS = 'Tabele';
public $A_CMP_DB_ATBLS = 'Sve';
public $A_CMP_DB_SELTBLS = 'Izabrane';
public $A_CMP_DB_SQLBACK = 'SQL Bekap';
public $A_CMP_DB_TDESC = 'Opis tabele';
public $A_CMP_DB_CLNAME = 'Ime kolone';
public $A_CMP_DB_CLTYPE = 'Tip kolone';
public $A_CMP_DB_ADOTYPE = 'ADOdb tip';
public $A_CMP_DB_MAXLEN = 'Maks. dužina';
public $A_CMP_DB_BRTBL = 'Pregled tabele';
public $A_CMP_DB_BCKDB = 'Nazad na Bazu';
public $A_CMP_DB_DBTYPE = 'Tip baze';
public $A_CMP_DB_DBDESCR = 'Opis baze';
public $A_CMP_DB_DBVER = 'Verzija baze';
public $A_CMP_DB_DBHOST = 'Domaćin baze';
public $A_CMP_DB_DBNAME = 'Ime baze';
public $A_CMP_DB_DBUSER = 'Korisnik';
public $A_CMP_DB_DBERRF = 'Prijava greške FN';
public $A_CMP_DB_DBDBG = 'Debagovanje';
public $A_CMP_DB_TBLSTR = 'Struktura tabele';
public $A_CMP_DB_DBBACK = 'Bekap baze';
public $A_CMP_DB_NOEXISTS = 'Ne postoji bekap';
public $A_CMP_DB_FOOTER= "<u>Beleška</u>: Klinkite desnim tasterom na ime fajla, a zatim 'Save Target as' da biste ga preuzeli. <strong>Upozorenje</strong>: Fajlovi su u UTF-8 formatu.";
public $A_CMP_DB_DBMONIT = 'Nadzor baze';
public $A_CMP_DB_TBLNOT = 'Tabela ne postoji!';
public $A_CMP_DB_BACKSUCC = 'Uspešno je kreiran bekap baze';
public $A_CMP_DB_NOTSUPPO = 'SQL kopija nije podržana za';
public $A_CMP_DB_NOTBLSEL = 'Nije izabrana tabela!';
public $A_CMP_DB_NOTDWNL = 'Nije moguće kreirati/preuzeti SQL kopiju';
public $A_CMP_DB_NOTCRSV = 'Nije moguće kreirati/sačuvati SQL kopiju';
public $A_CMP_DB_DUMPSUCC = 'SQL kopija ja uspešno napravljena';
public $A_CMP_DB_DTUNKN = 'Nepoznat'; // Translate as: Unknown Date
public $A_CMP_DB_TXMLSCHEM = 'XML Schema';
public $A_CMP_DB_TSQL = 'SQL';
public $A_CMP_DB_TUNKN = 'Nepoznat'; // Translate as: Unknown Type
public $A_CMP_DB_UNKOWN = 'Nepoznata'; // Translate as: Unknown Size
public $A_CMP_DB_NOFSELDEL = 'Nije izabran fajl za brisanje!';
public $A_CMP_DB_FSDELETED = 'fajlova je uspešno obrisano';
public $A_CMP_DB_FDELETED = 'Fajl je uspešno obrisan';
public $A_CMP_DB_TLMANBACK = 'Rukovanje bekapima';
public $A_CMP_DB_TLDELSLBCK = 'Brisanje izabranog bekapa';
public $A_CMP_DB_TLNEWFXML = 'Novi puni XML bekap';
public $A_CMP_DB_TLNEWFSQL = 'Novi puni SQL bekap';
public $A_CMP_DB_MAINTEN = 'Održavanje';
public $A_CMP_DB_MAINTEND = 'Održavanje baze';
public $A_CMP_DB_OPTIM = 'Optimizacija';
public $A_CMP_DB_REPAIR = 'Popravka';
public $A_CMP_DB_TBLOPTED = 'tabela je optimizovano';
public $A_CMP_DB_FRUOPTINCP = 'Česta upotreba <strong>optimizacije</strong>, poboljšava performanse baze.';
public $A_CMP_DB_RRERRDBTAB = '<strong>Popravka</strong>, otklanja postojeće greške u tabelama baze.';
public $A_CMP_DB_FAVMYSQL = 'Ove mogućnosti su dostupne samo za MySQL bazu!';
public $A_CMP_DB_TBLREPED = 'tabela je popravljeno';
public $A_CMP_DB_SIZE = 'Veličina';

}

?>
