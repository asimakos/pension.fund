<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: Jozef van Spelde
* @link: http://www.intereuro.net
* @email: jos@spelde.com
* @description: Dutch user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_dutch {

	public $_ON_NEW_CONTENT = "Een nieuw bericht is ingestuurd door [ %s ] getiteld [ %s ] foor sectie [ %s ] en categorie [ %s ]";
	public $_E_COMMENTS = 'Kommentaar';
	public $_DATE = 'Datum';
	public $_E_SUBCONWAIT = 'Ingestuurde berichten die wachten op goedkeuring:';
	public $_E_CONTENTSUB = 'Inhoud ingestuurde';
	public $_MAIL_SUB = 'Door gebruiker ingezonden';
	public $_E_HI = 'Hallo';
	public $_E_NEWSUBBY = "Een nieuwe inzending gedaan door gebruiker %s";
	public $_E_TYPESUB = 'Type van inzending:';
	public $_E_TITLE = 'Titlel';
	public $_E_LOGINAPPR = 'Login op uw site administratie om deze inzending te bekijken en goed te keuren.';
	public $_E_DONTRESPOND = 'Reageer niet op dit bericht omdat het automatisch aangemaakt is en alleen ter informatie diend.';
	public $_E_NEWPASS_SUB = "Nieuw wachtwoord voor %s";
	public $_E_RPASS_NADMIN = "Gebruiker %s stuurde het wachtwoord herinnerings formulier in. Een nieuw wachtwoord is verzonden aan hem. 
	Asl u deze informatie niet meer wilt ontvangen, verander dan de USERS_RPASSMAIL parameter in SoftDisk naar Nee/No.";
	public $_E_SEND_SUB = "Account details voor %s op %s";
	public $_ASEND_MSG = "Hallo %s, 
	Een nieuwe gebruiker heeft zich geregisreerd op %s.
	Deze e-mail bevat hun details:
	
	Naam - %s 
	e-mail - %s 
	Gebruikersnaam - %s

	Reageer niet op dit bericht omdat het automatisch aangemaakt is en alleen ter informatie diend.";
	public $_NEW_MESSAGE = 'Een nieuw prive bericht is aangekomen';
	public $_NEW_PRMSGF = "Een nieuw prive bericht is aangekomen van %s";
	public $_LOG_READMSG = 'Log in op uw administratie console om het bericht te lezen.';
	public $_SUBCON_APPRNTF = 'Ingezonden bericht acceptatie notificatie';
	public $_SUBCON_ATAPPR = 'Uw ingezonden inhoud op %s is goedgekeurd.';
	public $_SECTION = 'Sectie';
	public $_CATEGORY = 'Categorie';

	//elxis 2008.1
	public $_MANAPPROVE = 'Om het voor de nieuwe gebruiker mogelijk te maken dat deze inlogd, moet u handmatig de registratie goedkeuren!';
	public $_ACCUNBLOCK = "Uw account op %s is geactiveerd door de site administratie. U kunt nu inloggen als %s";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'Aankondiging nieuwe opmerking';
	public $_E_NEWCOMBYTITLE = "Een nieuwe opmerking is geplaatst door %s op een artikel van u met de titel %s";
	public $_E_COMSTAYUNPUB = 'Deze opmerking zal niet gepubliceerd worden voordat u of een super administrator dit doet.';
	public $_E_ACCEXPDATE = 'Account verval datum';

	public function __construct() {
	}

}

?>