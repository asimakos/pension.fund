<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Language
* @author: Elxis Team
* @translator: Ivan Trebješanin
* @link: http://www.elxis-srbija.org
* @email: admin@elxis-srbija.org
* @description: Serbian user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_serbian {

	public $_ON_NEW_CONTENT = "[ %s ] je dodao novu stavku sadržaja pod naslovom [ %s ] u sekciju [ %s ] i kategoriju [ %s ]";
	public $_E_COMMENTS = 'Komentari';
	public $_DATE = 'Datum';
	public $_E_SUBCONWAIT = 'Članci koji čekaju odobrenje:';
	public $_E_CONTENTSUB = 'Dodavanje sadržaja';
	public $_MAIL_SUB = 'Prilozi korisnika';
	public $_E_HI = 'Zdravo';
	public $_E_NEWSUBBY = "Novi prilog je dodao %s";
	public $_E_TYPESUB = 'Tip priloga:';
	public $_E_TITLE = 'Naslov';
	public $_E_LOGINAPPR = 'Prijavite se u administratorski deo sajta da biste ga pregledali.';
	public $_E_DONTRESPOND = 'Molimo Vas da ne odgovarate na ovu poruku jer je automatski generisana, i služi samo za Vašu informaciju.';
	public $_E_NEWPASS_SUB = "Nova lozinka za %s";
	public $_E_RPASS_NADMIN = "Korisnik %s zatražio je novu lozinku. Nova lozinka je generisana i poslata. 
	Ukoliko ne želite da budete obaveštavani o sličnim akcijama, postavite prrametar USERS_RPASSMAIL u SoftDisk-u na Ne.";
	public $_E_SEND_SUB = "Detalji naloga %s na %s";
	public $_ASEND_MSG = "Pozdrav %s!

Novi korisnik je registrovan na %s.
Ova poruka sadrži detalje:

Ime - %s
E-pošta - %s
Korisničko ime - %s

Molimo vas da ne odgovarate na ovu poruku jer je ona automatski generisana i služi za Vašu informaciju.";
	public $_NEW_MESSAGE = 'Stigla Vam je nova privatna poruka';
	public $_NEW_PRMSGF = "Nova privatna poruka je stigla od %s";
	public $_LOG_READMSG = 'Prijavite se na administracionu konzolu da biste je pročitali.';
	public $_SUBCON_APPRNTF = 'Obaveštenje o dodatom sadržaju';
	public $_SUBCON_ATAPPR = 'Sadržaj koji ste dodali na %s je odobren.';
	public $_SECTION = 'Sekcija';
	public $_CATEGORY = 'Kategorija';
  
	//elxis 2008.1
	public $_MANAPPROVE = 'Da bi novi korisnik mogao da se prijavi, morate lično da aktivirate njegov nalog!';
	public $_ACCUNBLOCK = "Vaš nalog na %s je aktiviran od strane administratora. Sada se možete prijaviti kao %s";

		//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'Obaveštenje o novom komentaru';
	public $_E_NEWCOMBYTITLE = "%s je postavio novi komentar na Vaš članak pod nazivom %s";
    public $_E_COMSTAYUNPUB = 'Ovaj komentar će ostati neobjavljen sve dok ga Vi ili superadministrator ne objavite.';
    public $_E_ACCEXPDATE = 'Datum isteka naloga';
    
	public function __construct() {
	}

}

?>