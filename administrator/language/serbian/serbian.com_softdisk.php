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
* @description: Serbian language for component softdisk
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CORE = 'Sistem';
public $A_ASTATS = 'Statistike administracije';
public $A_VALUE = 'Vrednost';
public $A_LASTMOD = 'Poslednja izmena';
public $A_OS = 'Operativni sistem';
public $A_ELXIS_VERSION = 'Elxis verzija';
public $A_SELECT = 'Izbor';
public $NOEDITSYS = 'Nije Vam dozvoljeno da menjate sistemske vrednosti';
public $A_RESTORE = 'Vraćanje';
public $SOFTDISK_HELP = 'SoftDisk je virtuelna ostava za promenljive i parametre svih vrsta.<br />
  	Možete da dodajete nove ili uređujete/brišete postojeće SoftDisk unose, osim onih koje pripadaju sistemu. 
	Takođe, unose sa oznakom "neizbrisivo" moguće je samo uređivati. Za imenovanje SoftDisk sekcija i naziva vrednosti 
	možete da koristite samo <strong>velika latinična slova, brojeve i donju crtu(_)</strong>.';
public $YCNOTEDITP = 'Ne možete da uređujete ovaj parametar';
public $UNDELETABLE = 'Neizbrisivo';
public $SOFTENTRYEXIST = 'Već postoji SoftDisk unos pod tim imenom!';
public $INVSECTNAME = 'Neispravno ime sekcije!';
public $INVNAME = 'Nepravilno ime!'; 
public $INVEMAIL = 'Uneta vrednost nije ispravna adresa e-pošte!';
public $INVURL = 'Uneta vrednost nije ispravan URL!';
public $INVDEC = 'Uneta vrednost nije decimalni broj!';
public $INVTSTAMP = 'Uneta vrednost nije ispravan UNIX vremenski pečat!';
public $UPSYSTEM = 'Ažuriranje sistema';
public $A_USERPROFILE = 'Korisnički profil';
public $UPROF_WEBSITE = 'Web sajt';
public $UPROF_AIM = 'AIM';
public $UPROF_YIM = 'YIM';
public $UPROF_MSN = 'MSN';
public $UPROF_ICQ = 'ICQ';
public $UPROF_EMAIL = 'Adresa e-pošte';
public $UPROF_PHONE = 'Telefon';
public $UPROF_MOBILE = 'Mobilni tel.';
public $UPROF_BIRTHDATE = 'Rođendan';
public $UPROF_GENDER = 'Pol';
public $UPROF_LOCATION = 'Lokacija';
public $UPROF_OCCUPATION = 'Zanimanje';
public $UPROF_SIGNATURE = 'Potpis';
public $UPROF_ARTICLES = 'Broj članaka';
public $UPROF_USERGROUP = 'Korisnička grupa';
public $UPROF_RANDUSERS = 'Prikaz nekih korisnika na stranici profila';
public $USERS_RPASSMAIL = 'Obaveštenje administratorima o slanju izgubljene lozinke';
public $SUBMIT_CATEGORIES = 'Kategorije u koje je dozvoljeno dodavati sadržaje (predložene). Ukoliko je prazno, sve su dozvoljene. (ID-jevi kategorija, odvojeni zarezom)';
public $SUBMIT_SECTIONS = 'Sekcije u koje je dozvoljeno dodavati sadržaje (predložene). Ukoliko je prazno, sve su dozvoljene. (ID-jevi sekcija, odvojeni zarezom)';
public $REG_AGREE = 'ID nezavisne stranice ugovora o registraciji. Nula (0) znači da je isključeno. Za ugovor na određenom jeziku, napravite SoftDisk zapis tipa broj u sekciji KORISNICI za svaki jezik REG_AGREE_LANGUAGE-HERE';
public $A_WEBLINKS = 'Web linkovi';
public $TOP_WEBLINK = 'Koktroliše prikaz modula Najpopularniji Web linkovi unutar komponente Web linkovi';
public $A_USERSLIST = 'Lista korisnika';
public $ULIST_ONLINE = 'Trenutni status';
public $ULIST_USERNAME = 'Korisničko ime';
public $ULIST_NAME = 'Ime';
public $ULIST_REGDATE = 'Datum registracije';
public $ULIST_PREFLANG = 'Izabrani jezik';
public $STATICCACHE = 'Static cache';

}

?>