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
* @description: Serbian language for component users
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_USS_LOGIN = 'Prijavljen';
public $A_CMP_USS_ALL = 'Svi';
public $A_CMP_USS_ID = 'Korisnički ID';
public $A_CMP_USS_LSTV = 'Poslednja poseta';
public $A_CMP_USS_ENBLD = 'Omogućeno';
public $A_CMP_USS_BLCKD = 'Blokirano';
public $A_CMP_USS_LVDATE = "%Y-%m-%d %H:%M:%S"; //Last visit Date
public $A_CMP_USS_PFISNOT = 'Izaberite drugu grupu, jer \'Javni interfejs\' nije prihvatljiv izbor';
public $A_CMP_USS_PBISNOT = 'Izaberite drugu grupu, jer \'Javna administacija\' nije prihvatljiv izbor';
public $A_CMP_USS_DETAILS = 'Podaci o korisniku';
public $A_CMP_USS_EMAIL = 'e-pošta';
public $A_CMP_USS_PASS = 'Nova lozinka';
public $A_CMP_USS_VERIFY = 'Potvrda lozinke';
public $A_CMP_USS_BLOCK = 'Blokiranje korisnika';
public $A_CMP_USS_SUBMI = 'Prijem poruka o dodatim člancima';
public $A_CMP_USS_REGDATE = 'Datum registracije';
public $A_CMP_USS_VISDTE = 'Datum zadnje posete';
public $A_CMP_USS_CONTCT = 'Informacije o kontaktu';
public $A_CMP_USS_NDETL = 'Nema informacija o kontaktu povezanih sa ovim korisnikom:<br />Pogledajte \'Komponente -> Kontakt -> Uređivanje kontakata za više informacija.';
public $A_CMP_USS_SUCCH = 'Uspešno su sačuvane izmene korisnika';
public $A_CMP_USS_SUCUSR = 'Uspešno je sačuvan korisnik';
public $A_CMP_USS_CANNOT = 'Ne možete da obrišete Superadministatora';
public $A_CMP_USS_CANNYO = 'Ne možete da obrišete sebe!';
public $A_CMP_USS_CANNUS = 'Nije Vam dozvoljeno da obrišete ovog korisnika';
public $A_CMP_USS_SLUSER = 'Izaberite korisnika';
public $A_CMP_USS_FLGOUT = 'Prisilna odjava';
public $A_CMP_USS_UMUST = 'Morate uneti korisničko ime.';
public $A_CMP_USS_ULOGIN = 'Vaše korisničko ime sadrži specijalne karaktere ili je prekratko.';
public $A_CMP_USS_MSTEMAIL = 'Morate uneti ispravnu adresu e-pošte.';
public $A_CMP_USS_ASSIGN = 'Korisnik mora da pripada nekoj grupi.';
public $A_CMP_USS_NOMATC = 'Lozinke se ne podudaraju.';
public $A_CMP_USS_FLOGD = 'Filter prijavljenih';
public $A_CMP_USS_FACST = 'Filter aktivnih';
public $A_CMP_USS_PHONE = 'Telefon';
public $A_CMP_USS_FAX = 'Faks';
public $A_CMP_USS_NOEXTRA = 'Dodatna korisnička polja nisu podešena ili objavljena';
public $A_CMP_USS_VERTICAL = 'Vertikalno';
public $A_CMP_USS_HORIZONT = 'Horizontalno';
public $A_CMP_USS_CHECKED = 'overeno';
public $A_CMP_USS_1OPTVLEAST = 'Barem jedna opcija i jedna izabrana opcija moraju postojati';
public $A_CMP_USS_1OPTLEAST = 'Brem jedna opcija mora biti data';
public $A_CMP_USS_EXTRASAVED = 'Dodatno polje uspešno sačuvano';
public $A_CMP_USS_CHACONDET = 'izmena podatake o kontaktu';
public $A_CMP_USS_REQUIRED = 'Obavezno';
public $A_CMP_USS_REGISTR = 'Registracija';
public $A_CMP_USS_PROFILE = 'Profil';
public $A_CMP_USS_RONLY = 'Samo za čitanje';
public $A_CMP_USS_HIDDEN = 'Skriveno';
public $A_CMP_USS_SHOWREG = 'Vidljivo tokom registracije';
public $A_CMP_USS_SHOWPROF = 'Prikaz u profilu';
public $A_CMP_USS_OPTALIGN = 'Ravnanje opcija';
public $A_CMP_USS_PREVNOTE = 'Primedba: Morate da sačuvate izmene kako biste mogli da ih pregledate.';
public $A_CMP_USS_OPTIONS = 'Opcije';
public $A_CMP_USS_OPTIONSFOR = 'Opcije za';
public $A_CMP_USS_MUSTFNAME = 'Polju morate dati ime';
public $A_CMP_USS_MAXLENINV = 'Maksimalna dužina polja nije ispravna';
public $A_CMP_USS_HIDMUSTVAL = 'Skriveno polje mora sadržati vrednost!';
public $A_CMP_USS_DEFVAL = 'Uobičajena vrednost';
public $A_CMP_USS_MAXLEN = 'Maks. dužina';
public $A_CMP_USS_REQFLDSNO = 'Jedno ili više obaveznih polja nije popunjeno!';
public $A_CMP_USS_HIDNOREQ = 'Skriveno polje ne može biti obavezno!';
public $A_CMP_USS_HIDNOPROF = 'Skriveno polje ne može se prikazati u profilu!';
//2008
public $A_CMP_USS_PREFLANG = 'Izabrani jezik';
public $A_CMP_USS_AVATAR = 'Avatar';
public $A_CMP_USS_WEBSITE = 'Web sajt';
public $A_CMP_USS_AIM = 'AIM';
public $A_CMP_USS_YIM = 'YIM';
public $A_CMP_USS_MSN = 'MSN';
public $A_CMP_USS_ICQ = 'ICQ';
public $A_CMP_USS_MOBILE = 'Mobilni tel.';
public $A_CMP_USS_BIRTHDATE = 'Rođendan';
public $A_CMP_USS_GENDER = 'Pol';
public $A_CMP_USS_LOCATION = 'Lokacija';
public $A_CMP_USS_OCCUPATION = 'Zanimanje';
public $A_CMP_USS_SIGNATURE = 'Potpis';
public $A_CMP_USS_MALE = 'Muško';
public $A_CMP_USS_FEMALE = 'Žensko';
public $A_CMP_USS_YEAR = 'Godina';
public $A_CMP_USS_MONTH = 'Mesec';
public $A_CMP_USS_DAY = 'Dan';
public $A_CMP_USS_BOLDINDIC = 'Polja koja su obeležena podebljanim slovima uključena su u korisničkim profilima.';
public $A_CMP_USS_ENDISSOFT = 'Možete uključiti/isključiti elemente profila kroz SoftDisk.';
//2009.0
public $A_USERS_EXPDATE = 'Datum isteka';
public $A_USERS_ACCEXPIRED = 'Nalog je istekao';
public $A_USERS_ACCNACTIVE = 'Nalog je aktivan';

}

?>