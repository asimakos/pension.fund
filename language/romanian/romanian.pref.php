<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Language
* @author: Elxis Team
* @translator: Marius Oprea
* @link: http://www.2live.ro
* @email: marius@2live.ro
* @description: Romanian user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_romanian {

	public $_ON_NEW_CONTENT = "Un nou element de conţinut a fost trimis de către [ %s ] intitulat [ %s ] pentru secţiunea [ %s ] şi categoria [ %s ]";
	public $_E_COMMENTS = 'Comentarii';
	public $_DATE = 'Data';
	public $_E_SUBCONWAIT = 'Articole trimise care aşteaptă aprobare:';
	public $_E_CONTENTSUB = 'Trimite conţinut';
	public $_MAIL_SUB = 'Trimis de utilizator';
	public $_E_HI = 'Salut';
	public $_E_NEWSUBBY = "Un articol nou trimis de %s";
	public $_E_TYPESUB = 'Forma de prezentare:';
	public $_E_TITLE = 'Titlu';
	public $_E_LOGINAPPR = 'Conectaţi-vă la site-ul dvs. de administrare pentru a vizualiza şi a aproba această prezentare.';
	public $_E_DONTRESPOND = 'Vă rugăm să nu raspundeţi la acest mesaj pentru că acesta este generat automat şi este numai în scop informativ.';
	public $_E_NEWPASS_SUB = "Parola nouă pentru %s";
	public $_E_RPASS_NADMIN = "Utilizatorul %s a trimis un formular memento pentru parolă. O parolă nouă a fost generată şi trimisă. 
	If you don\'t wish to get notified for such actions change the USERS_RPASSMAIL parameter on SoftDisk to No.";
	public $_E_SEND_SUB = "Detaliile contului pentru %s la %s";
	public $_ASEND_MSG = "Salut %s, 
	Un utilizator nou s-a înregistrat ca %s.
	Acest email conţine detaliile lui:
	
	Nume - %s 
	Email - %s 
	Nume utilizator - %s

	Vă rugăm să nu răspundeţi la acest mesaj pentru că acesta este generat automat şi este numai în scop informativ.";
	public $_NEW_MESSAGE = 'Un nou mesaj privat a sosit';
	public $_NEW_PRMSGF = "Un nou mesaj privat a sosit de la %s";
	public $_LOG_READMSG = 'Vă rugăm să vă logaţi la consola de administrare pentru a citi mesajul.';
	public $_SUBCON_APPRNTF = 'Notificare de aprobare pentru conţinutul trimis';
	public $_SUBCON_ATAPPR = 'Conţinutul trimis la %s a fost aprobat.';
	public $_SECTION = 'Secţiune';
	public $_CATEGORY = 'Categorie';

	//elxis 2008.1
	public $_MANAPPROVE = 'Pentru ca noul utilizator să se poata conecta trebuie aprobată manual înregistrarea sa!';
	public $_ACCUNBLOCK = "Contul tău la %s a fost aprobat de administrator. Vă puteţi autentifica ca %s";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'Notificare comentariu nou';
	public $_E_NEWCOMBYTITLE = "Un comentariu nou a fost postat de %s cu privire la un articol de-al tau, intitulat %s";
	public $_E_COMSTAYUNPUB = 'Acest comentariu va ramâne nepublicat pâna când tu sau un super administrator îl publica.';
	public $_E_ACCEXPDATE = 'Data expirarii contului';

	public function __construct() {
	}

}

?>