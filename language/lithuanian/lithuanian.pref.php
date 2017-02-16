<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: Kestas a.k.a. LitElxis
* @link: http://www.elxis.lt
* @email: LitElxis@gmail.com
* @description: Lithuanian user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_lithuanian {

	public $_ON_NEW_CONTENT = "[ %s ] pateikė naują turinio elementą [ %s ], skirtą skyriui [ %s ] ir kategorijai [ %s ]";
	public $_E_COMMENTS = 'Komentarai';
	public $_DATE = 'Data';
	public $_E_SUBCONWAIT = 'Patvirtinimo laukia šie pateikti straipsniai:';
	public $_E_CONTENTSUB = 'Turinio pateikimas';
	public $_MAIL_SUB = 'Naudotojas pateiktas';
	public $_E_HI = 'Sveiki';
	public $_E_NEWSUBBY = "Pateikė %s";
	public $_E_TYPESUB = 'Pateikimo tipas:';
	public $_E_TITLE = 'Pavadinimas';
	public $_E_LOGINAPPR = 'Norėdami peržiūrėti ir patvirtinti pateiktą informaciją, prisijunkite prie tinklapio administravimo zonos.';
	public $_E_DONTRESPOND = 'Prašome neatsakinėti į šį automatiškai sugeneruotą pranešimą, kadangi jis yra tik informacinio pobūdžio.';
	public $_E_NEWPASS_SUB = "Naujas slaptažodis skirtas %s";
	public $_E_RPASS_NADMIN = "Naudotojas %s užpildė ir pateikė slaptažodžio priminimo formą. Naujas slaptažodis sugeneruotas ir išsiųstas naudotojui. 
	Jei nenorite gauti pranešimų apie šiuos veiksmus, pakeiskite USERS_RPASSMAIL parametrą SoftDisk tvarkyklėje į Ne.";
	public $_E_SEND_SUB = "Sąskaitos %s %s detalės";
	public $_ASEND_MSG = "Sveiki %s,
Prie %s prisiregistravo naujas naudotojas.
Šiame laiške yra jo duomenys:

Vardas - %s
El. pašto adresas - %s
Naudotojo vardas - %s

Prašome neatsakinėti į šį automatiškai sugeneruotą pranešimą, kadangi jis yra tik informacinio pobūdžio.";
	public $_NEW_MESSAGE = 'Atėjo nauja asmeninė žinutė';
	public $_NEW_PRMSGF = "A new private message has arrived from %s";
	public $_LOG_READMSG = 'Please login to the administration console to read the message.';
	public $_SUBCON_APPRNTF = 'Submitted content approval notification';
	public $_SUBCON_ATAPPR = 'Your submitted content at %s was approved.';
	public $_SECTION = 'Skyrius';
	public $_CATEGORY = 'Kategorija';

	//elxis 2008.1
	public $_MANAPPROVE = 'In order for the new user to be able to login you must manually approve his registration!';
	public $_ACCUNBLOCK = "Your account at %s has been activated by a site administrator. You may now login as %s";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'New comment notification';
	public $_E_NEWCOMBYTITLE = "A new comment has been posted by %s on an article of yours titled %s";
	public $_E_COMSTAYUNPUB = 'This comment will stay unpublished until you or a super administrator publish it.';
	public $_E_ACCEXPDATE = 'Account expiration date';

	public function __construct() {
	}

}

?>