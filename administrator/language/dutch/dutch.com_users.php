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
* @description: Dutch language for component users
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_USS_LOGIN = 'Ingelogd';
public $A_CMP_USS_ALL = 'Alle';
public $A_CMP_USS_ID = 'Gebruikers ID';
public $A_CMP_USS_LSTV = 'Laatste Bezoek';
public $A_CMP_USS_ENBLD = 'Ingeschakeld';
public $A_CMP_USS_BLCKD = 'Geblokkeerd';
public $A_CMP_USS_LVDATE = '%Y-%m-%d %H:%M:%S'; //Last visit Date
public $A_CMP_USS_PFISNOT = 'Selecteer een andere groep, \'Publiek Frontend\' is geen selecteerbare optie';
public $A_CMP_USS_PBISNOT = 'Selecteer een andere groep, \'Publiek Backend\' is geen selecteerbare optie';
public $A_CMP_USS_DETAILS = 'Gebruikers gegevens';
public $A_CMP_USS_EMAIL = 'Email';
public $A_CMP_USS_PASS = 'Nieuw Paswoord';
public $A_CMP_USS_VERIFY = 'Verifieer Paswoord';
public $A_CMP_USS_BLOCK = 'Blokkeer Gebruiker';
public $A_CMP_USS_SUBMI = 'Ontvang Email over Inzendingen';
public $A_CMP_USS_REGDATE = 'Registratie Datum';
public $A_CMP_USS_VISDTE = 'Datum Laatste Bezoek';
public $A_CMP_USS_CONTCT = 'Contact Informatie';
public $A_CMP_USS_NDETL = 'Er zijn geen Contact gegevens gelinkt met deze gebruiker:<br />Zie \'Components -> Contact -> Beheer Contacts\' voor details.';
public $A_CMP_USS_SUCCH = 'Wijzigingen gebruiker succesvol opgeslagen';
public $A_CMP_USS_SUCUSR = 'Gebruiker succesvol opgeslagen';
public $A_CMP_USS_CANNOT = 'Je kan de Super Administrator niet verwijderen';
public $A_CMP_USS_CANNYO = 'Je kan jezelf niet verwijderen!';
public $A_CMP_USS_CANNUS = 'Je hebt geen rechten om deze gebruiker te verwijderen';
public $A_CMP_USS_SLUSER = 'Selecteer een gebruiker';
public $A_CMP_USS_FLGOUT = 'Forceer Log-out';
public $A_CMP_USS_UMUST = 'Je moet een gebruikers login-naam geven.';
public $A_CMP_USS_ULOGIN = 'Uw login-naam bevat ongeldige karakters of is te kort.';
public $A_CMP_USS_MSTEMAIL = 'Je moet een email adres geven.';
public $A_CMP_USS_ASSIGN = 'Je moet de gebruiker aan een groep toewijzen.';
public $A_CMP_USS_NOMATC = 'Paswoorden komen niet overeen.';
public $A_CMP_USS_FLOGD = 'Filter Gelogd';
public $A_CMP_USS_FACST = 'Filter Actief';
public $A_CMP_USS_PHONE = 'Telefoon';
public $A_CMP_USS_FAX = 'Fax';
public $A_CMP_USS_NOEXTRA = 'Er zijn geen extra gebruikersvelden gedefinieerd of gepubliceerd';
public $A_CMP_USS_VERTICAL = 'Verticaal';
public $A_CMP_USS_HORIZONT = 'Horizontaal';
public $A_CMP_USS_CHECKED = 'gecheckt';
public $A_CMP_USS_1OPTVLEAST = 'Minstens één optie en een geldig geselecteerde optie moet opgegeven worden';
public $A_CMP_USS_1OPTLEAST = 'Minstens één optie moet opgegeven worden';
public $A_CMP_USS_EXTRASAVED = 'Extra velden succesvol opgeslagen';
public $A_CMP_USS_CHACONDET = 'wijzig Contact gegevens';
public $A_CMP_USS_REQUIRED = 'Verplicht';
public $A_CMP_USS_REGISTR = 'Registratie';
public $A_CMP_USS_PROFILE = 'Profiel';
public $A_CMP_USS_RONLY = 'Enkel leesbaar';
public $A_CMP_USS_HIDDEN = 'Verborgen';
public $A_CMP_USS_SHOWREG = 'Toon in Registratie';
public $A_CMP_USS_SHOWPROF = 'Toon in Profiel';
public $A_CMP_USS_OPTALIGN = 'Opties uitlijning';
public $A_CMP_USS_PREVNOTE = 'Nota: Je moet de wijzigingen opslaan om het voorbeeld te bekijken.';
public $A_CMP_USS_OPTIONS = 'Opties';
public $A_CMP_USS_OPTIONSFOR = 'Opties voor';
public $A_CMP_USS_MUSTFNAME = 'Je moet het veld een naam geven';
public $A_CMP_USS_MAXLENINV = 'De waarde van \'Max veldlengte\' is ongeldig';
public $A_CMP_USS_HIDMUSTVAL = 'Een verborgen veld moet een waarde hebben!';
public $A_CMP_USS_DEFVAL = 'Standaard waarde';
public $A_CMP_USS_MAXLEN = 'Max lengte';
public $A_CMP_USS_REQFLDSNO = 'Eén of meerdere verplichte velden zijn niet ingevuld!';
public $A_CMP_USS_HIDNOREQ = 'Een verborgen veld kan niet verplicht worden!';
public $A_CMP_USS_HIDNOPROF = 'Een verborgen veld kan niet getoond worden op de profiel pagina!';
//2008
public $A_CMP_USS_PREFLANG = 'Voorkeur taal';
public $A_CMP_USS_AVATAR = 'Avatar';
public $A_CMP_USS_WEBSITE = 'Website';
public $A_CMP_USS_AIM = 'AIM';
public $A_CMP_USS_YIM = 'YIM';
public $A_CMP_USS_MSN = 'MSN';
public $A_CMP_USS_ICQ = 'ICQ';
public $A_CMP_USS_MOBILE = 'GSM';
public $A_CMP_USS_BIRTHDATE = 'Geboortedatum';
public $A_CMP_USS_GENDER = 'Geslacht';
public $A_CMP_USS_LOCATION = 'Locatie';
public $A_CMP_USS_OCCUPATION = 'Beroep';
public $A_CMP_USS_SIGNATURE = 'Handtekening';
public $A_CMP_USS_MALE = 'Man';
public $A_CMP_USS_FEMALE = 'Vrouw';
public $A_CMP_USS_YEAR = 'Jaar';
public $A_CMP_USS_MONTH = 'Maand';
public $A_CMP_USS_DAY = 'Dag';
public $A_CMP_USS_BOLDINDIC = 'De vette Elementen zijn ingeschakeld in het gebruikers profiel.';
public $A_CMP_USS_ENDISSOFT = 'Je kan profiel elementen in/uitschakelen vanuit SoftDisk.';
//2009
public $A_USERS_EXPDATE = 'Verloop datum';
public $A_USERS_ACCEXPIRED = 'Account verlopen';
public $A_USERS_ACCNACTIVE = 'Account is actief';

}

?>