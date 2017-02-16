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
* @description: Dutch user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_english {

	public $_ON_NEW_CONTENT = 'Een nieuw artikel is ingezonden door [ %s ] met als titel [ %s ] voor sectie [ %s ] en categorie [ %s ]';
	public $_E_COMMENTS = 'Commentaar';
	public $_DATE = 'Datum';
	public $_E_SUBCONWAIT = 'Ingezonden artikelen wachtende op goedkeuring:';
	public $_E_CONTENTSUB = 'Artikel inzending';
	public $_MAIL_SUB = 'Gebruiker heeft ingezonden';
	public $_E_HI = 'Goedendag';
	public $_E_NEWSUBBY = 'Een nieuwe inzending gemaakt door gebruiker %s';
	public $_E_TYPESUB = 'Type inzending:';
	public $_E_TITLE = 'Titel';
	public $_E_LOGINAPPR = 'Login op het administratie gedeelte van uw website om deze inzending te bekijken en goed te keuren.';
	public $_E_DONTRESPOND = 'Gelieve niet te antwoorden op dit bericht, dit bericht is automatisch gegenereerd en is enkel voor informatieve doeleinden.';
	public $_E_NEWPASS_SUB = 'Nieuw paswoord voor %s';
	public $_E_RPASS_NADMIN = 'Gebruiker %s heeft het paswoord herinnering formulier verzonden. Een nieuw paswoord is gegenereerd en naar hem verzonden. 
	Als je niet op de hoogte wil gebracht worden van dergelijke acties, wijzig dan de USERS_RPASSMAIL parameter in SoftDisk in Nee.';
	public $_E_SEND_SUB = 'Account gegevens voor %s op %s';
	public $_ASEND_MSG = 'Hallo %s, 
	Een nieuwe gebruiker heeft zich geregistreerd op %s.
	Deze email bevat zijn/haar gegevens:
	
	Naam - %s 
	e-mail - %s 
	Gebruikersnaam - %s

	Gelieve niet te antwoorden op dit bericht, dit bericht is automatisch gegenereerd en is enkel voor informatieve doeleinden.';
	public $_NEW_MESSAGE = 'Een nieuw privaat bericht is aangekomen';
	public $_NEW_PRMSGF = 'Een nieuw privaat bericht van %s is aangekomen';
	public $_LOG_READMSG = 'Login op het administratie gedeelte van uw website om dit bericht te lezen.';
	public $_SUBCON_APPRNTF = 'Mededeling goedkeuring ingezonden artikel';
	public $_SUBCON_ATAPPR = 'Uw ingezonden artikel op %s is goedgekeurd.';
	public $_SECTION = 'Sectie';
	public $_CATEGORY = 'Categorie';

	//elxis 2008.1
	public $_MANAPPROVE = 'Om het voor de gebruiker mogelijk te maken om in te loggen moet je zijn registratie manueel goedkeuren!';
	public $_ACCUNBLOCK = 'Uw account op %s is geactiveerd door de site administrator. Je mag nu inloggen als %s';

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'Kennisgeving van nieuwe commentaar';
	public $_E_NEWCOMBYTITLE = 'Nieuwe commentaar is ingezonden door %s op een artikel van U met als titel %s';
	public $_E_COMSTAYUNPUB = 'Deze commentaar blijft ongepubliceerd totdat U of de super administrator deze commentaar publiceert.';
	public $_E_ACCEXPDATE = 'Account verloop datum';

	public function __construct() {
	}

}

?>