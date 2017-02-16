<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Elxis Team
* @translator: Ioannis Sannos
* @translator URL: http://www.elxis.org
* @translator E-mail: info@elxis.org
* @description: English language for Updiag tool
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class updiagLang {

	public $UPDATE = 'Ažuriranje';
	public $CHVERS = 'Provera verzije';
	public $CNOTGETELXD = 'Ne mogu da dobijem podatke sa elxis.org';
	public $INVXML = 'Dobio sam neispravan XML fajl. Ne mogu da prikažem zahtevanu informaciju.';
	public $SIZE = 'Veličina';
	public $MORE = 'Dalje';
	public $DOWNLOAD = 'Preuzimanje';
	public $INSELXVER = 'Instalirana Elxis verzija';
	public $CURRENT = 'Aktuelna';
	public $OUTDATED = 'Zastarela!';
	public $NEWVERAV = 'Dostupna je novija verzija Elxis-a. Ažurirajte svoju instalaciju Elxis-a što je pre moguće.';
	public $CHPATCHES = 'Pregled zakrpa';
	public $NOPATCHES = 'Trenutno nema dostupnih zakrpa za Vašu verziju Elxis-a';
	public $PROSUPPORT = 'Profesionalna podrška';
	public $NEWS = 'Vesti';
	public $MAINTENANCE = 'Održavanje';
	public $REMOTEERR1 = 'Neispravan zahtev';
	public $REMOTEERR2 = 'Ne mogu da dobijem listu skripti';
	public $REMOTEERR3 = 'Nema skripti';
	public $REMOTEERR4 = 'Zahtevani fajl je prazan';
	public $REMOTEERR5 = 'Ne mogu da dobijem listu hash fajlova';
	public $REMOTEERR6 = 'Nema hash fajlova';
	public $REMOTEERR7 = 'Ne mogu da preuzmem zahtevani fajl!';
	public $UNERROR = 'Nepoznata greška';
	public $PROVCODE = 'Sadrži skript za ažuriranje Elxis-a iz verzije';
	public $TOVERSION = 'u verziju';
	public $INSTALLED = 'Instalirano';
	public $REQFEXISTS = 'Zahtevani fajl već postoji!';
	public $FILDOWNSUC = 'Fajl je uspešno preuzet!';
	public $DFORRUNSCR = 'Ne zaboravite da ovaj skript pokrenete kako biste ažurirali svoju instalaciju Elxis-a.';
	public $CNOTCPDFIL = 'Ne mogu preuzeti fajl da kopiram na željeno odredište.';
	public $PLCHSCRPERM = 'Proverite dozvole za /administrator/tools/updiag/data/scripts';
	public $PLCHSCRPERM2 = 'Proverite dozvole za /administrator/tools/updiag/data/hashes';
	public $EXECUTE = 'Izvršavanje';
	public $SCRNOTEX = 'Zahtevani skript ne postoji!';
	public $FSCHECK = 'Sistemska provera';
	public $HIDEHELP = 'Skrivanje pomoći';
	public $NORMAL = 'Uobičajeno';
	public $EXTENDED = 'Prošireno';
	public $FULL = 'Pun prikaz';
	public $NOHASHFOUND = 'Nema hash fajlova';
	public $INVHFILE = 'Neispravan hash fajl!';
	public $SHFELXVER = 'Izabrani hash fajl je za Elxis verziju stariju od Vaše trenutne!';
	public $FNOTEXIST = 'Fajl ne postoji';
	public $WARNING = 'Upozorenje';
	public $FNEEDUP = 'Fajl je portebno ažurirati';
	public $SITUP2D = 'Sajt je ažuran!';
	public $FOUND = 'Pronađeno je';
	public $OUTFUP = 'zastarelih fajlova. Molimo Vas, obnovite ih!';
	public $CHFINUS = 'Provera ažurnosti sajta putem <b>%s</b> kao izvora';
	public $NEWRELEASES = 'Nova izdanja';
	public $NONEWREL = 'Trenutno nema novih izdanja';
	public $PRICE = 'Cena';
	public $LICENSE = 'Licenca';
	public $SECURITY = 'Sigurnost';
	public $INSTPATH = 'Putanja instalacije';
	public $CREDITS = 'Zahvalnost';
	public $ALERT = 'Uzbuna';
	public $FSECALWA = 'Otkriveno je <b>%d</b> sigurnosnih uzbuna i upozorenja';
	public $ELXINPAS = 'Vaša Elxis instalacija je uspešno prošla osnovne sigurnosne testove';
	public $HOME = 'Naslovna';
	public $UPDSPAG = 'Updiag centrala';
	public $UPDWELC = 'Dobrodošli u <b>Updiag</b>, Elxis dijagnostički alat.';
	public $STARTMORE = 'Najveći broj Updiag funkcija zahteva vezu sa elxis.org sajtom. 
	Stoga morate imati otvorenu konekciju od Vašeg sajta ka internetu. 
	Izaberite stavku sa gornjeg menija za navigaciju.';
	public $BASCHECKS = 'Osnovna provera <small>(kliknite na ikonu da biste izvršili)</small>';
	public $FILEREMSUC = 'Fajl je uspešno uklonjen!';
	public $CNREMSFILE = 'Ne mogu da uklonim izabrani fajl! Proverite dozvole.';
	public $HASHNOTEX = 'Zahtevani hash fajl ne postoji!';
	public $DNHASHFLS = 'Preuzimanje hash fajlova';
	public $BUY = 'Kupovina';
	public $DOWNLTIME = 'Vreme preuzimanja';
	public $DOWNLSPEED = 'Brzina preuzimanja';


	public function __construct() {
	}

}

define('CX_LUPDIAGD', 'Pomaže Vam da ažurirate svoj sajt, obaveštava Vas o novim izdanjima Elxis-a, njegovim verzijama, zakrpama, i proverava sigurnosna podešavanja.');

?>