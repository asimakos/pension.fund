<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: Patricia Camilien
* @link: http://www.perih.org
* @email: patricia@perih.org
* @description: Creole user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_creole {

	public $_ON_NEW_CONTENT = "[ %s ] soumèt yon nouvo atik ki gen pou tit[ %s ] nan seksyon [ %s ] e nan kategori [ %s ]";
	public $_E_COMMENTS = 'Komantè';
	public $_DATE = 'Dat';
	public $_E_SUBCONWAIT = 'Atik ki ap tann apwobasyon:';
	public $_E_CONTENTSUB = 'Pwopozisyon atik';
	public $_MAIL_SUB = 'Yon manm soumèt yon aplikasyon';
	public $_E_HI = 'Bonjou';
	public $_E_NEWSUBBY = "%s soumèt yon nouvo piblikasyon";
	public $_E_TYPESUB = 'Tip soumisyon:';
	public $_E_TITLE = 'Tit';
	public $_E_LOGINAPPR = 'Konekte w nan Administrasyon an pou w ka afiche epi apwouve soumisyon sa.';
	public $_E_DONTRESPOND = 'Pa reponn mesaj sa, li jenere otmatikman pou ka enfòme w.';
	public $_E_NEWPASS_SUB = "Nouvo modpas pou %s";
	public $_E_RPASS_NADMIN = "Itilizatè %s mande pou voye ba li yon nouvo modpas. Sistèm nan jenere epi voye ba li yon nouvo modpas. 
  Si w pa vle ke yo avèti w de aksyon sa yo, chanje paramèt USERS_RPASSMAIL nan SoftDisk, chwazi Non.";
	public $_E_SEND_SUB = "Pwofil %s enskri sou  %s";
	public $_ASEND_MSG = "Bonjou %s,
Yon nouvo itilizatè enskri l sou %s.
Imel sa genyen pwofil li:

Non - %s
Imel - %s
Idantifyan - %s

Pa reponn mesaj sa li jenere otmatikman pou ka enfòme w.";
	public $_NEW_MESSAGE = 'Yo fèk voye yon nouvo mesaj prive ba ou';
	public $_NEW_PRMSGF = "Ou resevwa yon nouvo mesaj prive de %s ";
	public $_LOG_READMSG = 'Silvouplè, konekte w nan Administrasyon an pou w ka li mesaj sa.';
	public $_SUBCON_APPRNTF = 'Avètisman soumisyon yon atik';
	public $_SUBCON_ATAPPR = 'Atik ou te soumèt sou %s la,apwouve.';
	public $_SECTION = 'Seksyon';
	public $_CATEGORY = 'Kategori';

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