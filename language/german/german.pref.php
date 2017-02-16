<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Language
* @author: Elxis Team
* @translator: Siegmund Langsch, Manfred Schreiweis (manfred@mabitoka.de), Simon Zöllner (SimonZ)
* @link: http://www.langschnet.de
* @email: s.langsch@langschnet.de
* @description: German user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_german {

	public $_ON_NEW_CONTENT = "Ein neuer Inhalt wurde von [ %s ] übermittelt, genannt [ %s ] für Sektion [ %s ] und Kategorie [ %s ]";
	public $_E_COMMENTS = 'Kommentare';
	public $_DATE = 'Datum';
	public $_E_SUBCONWAIT = 'Übertragen Artikel warten auf Prüfung:';
	public $_E_CONTENTSUB = 'Inhaltsübertragung';
	public $_MAIL_SUB = 'Benutzer überträgt';
	public $_E_HI = 'Hallo';
	public $_E_NEWSUBBY = "Eine neue Übertragung wurde von Benutzer %s durchgeführt";
	public $_E_TYPESUB = 'Typ der Übertragung:';
	public $_E_TITLE = 'Titel';
	public $_E_LOGINAPPR = 'Melden sie sich im Administratorbereich an um die Übertragung zu prüfen.';
	public $_E_DONTRESPOND = 'Bitte antworten sie nicht auf diese Nachricht. Diese wurde automatisch generiert und dient nur zu ihrer Information.';
	public $_E_NEWPASS_SUB = "Neues Passwort für %s";
	public $_E_RPASS_NADMIN = "Benutzer %s hat das Passwort-Erinnerungs Formular übermittelt. Ein neues Passwort wurde generiert und zugesendet. 
	Wenn sie darüber nicht informiert werden wollen, ändern sie den USERS_RPASSMAIL Parameter im Bereich SoftDisk zu Nein.";
	public $_E_SEND_SUB = "Account Details für %s at %s";
	public $_ASEND_MSG = "Hallo %s,
	Ein neuer Benutzer hat sich auf %s registriert.
	Diese Email enthält die Details:

	Name - %s
	E-Mail - %s
	Benutzername - %s

	Bitt antworten sie nicht auf diese Nachricht. Diese wurde automatisch generiert und dient nur zu ihrer Information";
	public $_NEW_MESSAGE = 'Eine neue private Nachricht ist eingegangen';
	public $_NEW_PRMSGF = "Eine neue private Nachricht von %s ist eingetroffen";
	public $_LOG_READMSG = 'Bitte melden sie sich an der Administratorkonsole an, um die Nachricht zu lesen.';
	public $_SUBCON_APPRNTF = 'Submitted content approval notification';
	public $_SUBCON_ATAPPR = 'Your submitted content at %s was approved.';
	public $_SECTION = 'Sektion';
	public $_CATEGORY = 'Kategorie';

	//elxis 2008.1
	public $_MANAPPROVE = 'Um dem neuen Benutzer das Anmelden zu ermöglichen, müssen Sie seine Registrierung manuell freischalten!';
	public $_ACCUNBLOCK = "Ihr Benutzerkonto auf der Website %s wurde von einem Seiten-Administrator freigeschalten. Sie können sich nun anmelden als %s";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'Neuer-Kommentar-Benachrichtigung';
	public $_E_NEWCOMBYTITLE = "Ein neuer Kommentar wurde von %s in deinem Artikel %s verfasst";
	public $_E_COMSTAYUNPUB = 'Dieser Kommentar bleibt unveröffentlicht, bis ein Super-Administrator ihn veröffentlicht.';
	public $_E_ACCEXPDATE = 'Account Ablaufdatum';

	public function __construct() {
	}

}

?>