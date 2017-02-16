<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: PARACOM Software
* @link: http://www.elxis.cz
* @email: info@elxis.cz
* @description: Czech user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_czech {

	public $_ON_NEW_CONTENT = "Nový článek od [ %s ] byl předán ke schválení s titulem [ %s ] pro sekci [ %s ] a kategorii [ %s ]";
	public $_E_COMMENTS = 'Komentáře';
	public $_DATE = 'Datum';
	public $_E_SUBCONWAIT = 'Články čekající na schválení:';
	public $_E_CONTENTSUB = 'Přidaní nové položky';
	public $_MAIL_SUB = 'Přidání nové položky uživatelem Vašeho webu';
	public $_E_HI = 'Ahoj';
	public $_E_NEWSUBBY = "Uživatel %s předložil ke schválení novou položku";
	public $_E_TYPESUB = 'Typ položky:';
	public $_E_TITLE = 'Titul:';
	public $_E_LOGINAPPR = 'Přihlaste se do administrační části webu pro kontrolu a schválení.';
	public $_E_DONTRESPOND = 'Prosím neodpovídejte na tento email, byl vygenerován automaticky a je pouze informační.';
	public $_E_NEWPASS_SUB = "Nové uživatelské heslo pro %s";
	public $_E_RPASS_NADMIN = "Uživatel %s požádal o zaslání nového hesla. Nové heslo bylo vygenerováno a odesláno. 
	Pokud si nepřejete dostávat toto oznámení, nastavte v administrační části parametr USERS_RPASSMAIL v SoftDisk na Ne.";
	public $_E_SEND_SUB = "Nová registrace uživatele %s na %s";
	public $_ASEND_MSG = "Ahoj %s, 
	Nová registrace uživatele na %s.
	Tento email obsahuje detaily:
	
	Jméno - %s 
	E-mail - %s 
	Uživatelské jméno - %s

	Prosím neodpovídejte na tento email, byl vygenerován automaticky a je pouze informační.";
	public $_NEW_MESSAGE = 'Nová osobní zpráva';
	public $_NEW_PRMSGF = "Nová osobní zpráva od %s";
	public $_LOG_READMSG = 'Prosím, přihlaste se do administrační části pro její přečtení.';
	public $_SUBCON_APPRNTF = 'Oznámení o schválení předloženého obsahu';
	public $_SUBCON_ATAPPR = 'Váš článek %s byl schválen.';
	public $_SECTION = 'Sekce';
	public $_CATEGORY = 'Kategorie';

	//elxis 2008.1
	public $_MANAPPROVE = 'Aby se nový uživatel mohl přihlásit do systému, musíte schválit jeho registraci!';
	public $_ACCUNBLOCK = "Váš nový účet na %s byl aktivován administrátorem stránek. Uživatelské jméno: %s";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'Oznámení o novém komentáři';
	public $_E_NEWCOMBYTITLE = "%s zaslal nový komentář k článku s titulem %s";
	public $_E_COMSTAYUNPUB = 'Tento komentář bude publikován po schválení administrátorem.';
	public $_E_ACCEXPDATE = 'Platnost účtu';

	public function __construct() {
	}

}

?>