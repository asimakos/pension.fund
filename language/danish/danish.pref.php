<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: Kenneth Kristiansen (blackmuddler)
* @link: http://www.lystfiskerfreak.dk
* @email: info@lystfiskerfreak.dk
* @description: Danish user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direkte adgang til denne lokation er ikke tilladt.' );


class prefLang_danish {

	public $_ON_NEW_CONTENT = "Et nyt indholdselement er blevet tilføjet af [ %s ] med titlen [ %s ] for sektion [ %s ] og kategori [ %s ]";
	public $_E_COMMENTS = 'Kommentarer';
	public $_DATE = 'Dato';
	public $_E_SUBCONWAIT = 'Tilføjet artikler venter for godkendelse:';
	public $_E_CONTENTSUB = 'Indholdsforslag';
	public $_MAIL_SUB = 'Bruger indlæg';
	public $_E_HI = 'Hej';
	public $_E_NEWSUBBY = "En nyt indlæg lavet af bruger %s";
	public $_E_TYPESUB = 'Type af indlæg:';
	public $_E_TITLE = 'Titel';
	public $_E_LOGINAPPR = 'Login til dit websteds administration for at se og godkende dette indlæg.';
	public $_E_DONTRESPOND = 'Besvar venligst ikke denne besked, da den er automatisk genereret med information til dig.';
	public $_E_NEWPASS_SUB = "Ny password for %s";
	public $_E_RPASS_NADMIN = "Bruger %s anvendte glemt password formularen. Et nyt password er oprettet og sendt til vedkommende. 
	Hvis du ikke ønsker informationer om sådanne ændringer og skift USERS_RPASSMAIL parameteren i SoftDisk til No.";
	public $_E_SEND_SUB = "Konto detajler for %s ved %s";
	public $_ASEND_MSG = "Hej %s, 

En ny bruger har registreret sig ved %s.
Denne email indeholder vedkommendenes detajler:

Navn - %s
e-mail - %s
Brugernavn - %s

Besvar venligst ikke denne mail, da den er automatisk generet med informationer til dig.";
	public $_NEW_MESSAGE = 'En ny privat besked er ankommet';
	public $_NEW_PRMSGF = "En ny privat besked er modtaget fra %s";
	public $_LOG_READMSG = 'Login til administration konsol for at læse beskeden.';
	public $_SUBCON_APPRNTF = 'Tilføjet indhold - godkendelse bekendtgørelse';
	public $_SUBCON_ATAPPR = 'Dit tilføjet indhold hos %s er godkendt og gjort tilgændeligt.';
	public $_SECTION = 'Sektion';
	public $_CATEGORY = 'Kategori';

	//elxis 2008.1
	public $_MANAPPROVE = 'In order for the new user to be able to login you must manually approve his registration!';
	public $_ACCUNBLOCK = "Your account at %s has been activated by a site administrator. You may now login as %s";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'Ny kommentar advisering';
	public $_E_NEWCOMBYTITLE = "En ny kommentar er blevet postet af %s på en af dine artikler med titlen %s";
	public $_E_COMSTAYUNPUB = 'Denne kommentar vil ikke blive offentliggjort førend du eller en super administrator offentliggøre den.';
	public $_E_ACCEXPDATE = 'Konto udløbsdato';

	public function __construct() {
	}

}

?>