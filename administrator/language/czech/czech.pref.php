<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: PARACOM Software
* @link: http://www.elxis.cz
* @email: datahell@elxis.cz
* @description: Czech user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_czech {

	public $_ON_NEW_CONTENT = "Byl předložen nový článek od [ %s ] s titulem [ %s ] pro sekci [ %s ] a kategorii [ %s ]";
	public $_E_COMMENTS = 'Komentáře';
	public $_DATE = 'Datum';
	public $_E_SUBCONWAIT = 'Předložené položky čekající na schválení:';
	public $_E_CONTENTSUB = 'Předložený článek';
	public $_MAIL_SUB = 'Předložil uživatel';
	public $_E_HI = 'Ahoj';
	public $_E_NEWSUBBY = "Nové předložení od uživatele %s";
	public $_E_TYPESUB = 'Typ předložení:';
	public $_E_TITLE = 'Titul';
	public $_E_LOGINAPPR = 'Přihlašte se k Vaší administraci k posouzení předložené položky.';
	public $_E_DONTRESPOND = 'Prosím, neodpovídeje na tento email, byl vygenerován automaticky a má pouze informační charakter.';
	public $_E_NEWPASS_SUB = "Nové heslo pro %s";
	public $_E_RPASS_NADMIN = "Uživatel %s požádal o zaslání hesla. Nové heslo bylo vygenerováno a zasláno na jeho emailovou adresu. 
	Pokud si nepřejete nadále dostávat tyto informační emaily, změňte nastavení parametru USERS_RPASSMAIL v SoftDisk komponentě.";
	public $_E_SEND_SUB = "Detail účtu pro %s z %s";
	public $_ASEND_MSG = "Zdravíme %s, 
	Registrace nového uživatele na %s.
	Tento email obsahuje detaily:
	
	Jméno - %s 
	E-mail - %s 
	Uživatelské jméno - %s

	Prosím, neodpovídeje na tento email, byl vygenerován automaticky a má pouze informační charakter.";
	public $_NEW_MESSAGE = 'Doručena nová osobní zpráva';
	public $_NEW_PRMSGF = "Doručena nová osobní zpráva z %s";
	public $_LOG_READMSG = 'Prosím, pro přečtení se přihlašte do Vaší administrace webu.';
	public $_SUBCON_APPRNTF = 'Schválení předloženého článku';
	public $_SUBCON_ATAPPR = 'Váš předložený článek na %s byl schválen.';
	public $_SECTION = 'Sekce';
	public $_CATEGORY = 'Kategorie';

	//elxis 2008.1
	public $_MANAPPROVE = 'Aby se nový uživatel mohl přihlásit do systému, musíte ručně schválit jeho registraci!';
	public $_ACCUNBLOCK = "Váš účet na %s byl schválen administrátorem. Nyní se můžete přihlásit do systému jako %s";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'Oznámení nového komentáře';
	public $_E_NEWCOMBYTITLE = "Nový komentář přidal %s k Vašemu článku s titulem %s";
    public $_E_COMSTAYUNPUB = 'Tento komentář nebude publikován až do jeho schválení.';
    public $_E_ACCEXPDATE = 'Datum ukončení účtu';

	public function __construct() {
	}

}

?>