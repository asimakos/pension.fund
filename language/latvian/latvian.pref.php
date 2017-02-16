<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: Yoyo-Moyo
* @link: http://www.videoreklama.lv
* @email: yoyoman@pisem.net
* @description: Latvian user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_latvian {

	public $_ON_NEW_CONTENT = "Lietotājs [ %s ] pievienoja jaunu objektu [ %s ]. Nodaļa: [ %s ]. Kategorija: [ %s ]";
	public $_E_COMMENTS = 'Komentāri';
	public $_DATE = 'Datums';
	public $_E_SUBCONWAIT = 'Pievienotie raksti, kuri gaida apstiprināšanu:';
	public $_E_CONTENTSUB = 'Materiālu pievienošana';
	public $_MAIL_SUB = 'Jauns materiāls';
	public $_E_HI = 'Sveicināti';
	public $_E_NEWSUBBY = "Jauns materiāls no lietotāja %s";
	public $_E_TYPESUB = 'Tips:';
	public $_E_TITLE = 'Nosaukums';
	public $_E_LOGINAPPR = 'Autorizējieties administratora panelī, lai apskatītu un apstiprinātu šo materiālu.';
	public $_E_DONTRESPOND = 'Uz šo vēstuli nav jāatbild, jo tā ir ģenerēta automātiski un domāta tikai informēšanai.'; 
	public $_E_NEWPASS_SUB = "Jauna parole priekš %s";
	public $_E_RPASS_NADMIN = "Lietotājs %s izmantoja paroles atjaunošanas funkciju. Jauna parole tika ģenerēta un nosūtīta lietotājam. 
	Ja jūs nevēlaties saņemt ziņojumus par dotām darbībām, uzstādiet  USERS_RPASSMAIL  SoftDisk'ā kā Nē.";
    public $_E_SEND_SUB = "Dati par jaunu lietotāju %s ar %s";
    public $_ASEND_MSG = "Sveicināti! Šis ir sistēmas ziņojums no mājaslapas %s.
Uz %s ir reģistrējies jauns lietotājs.

Lietotāja dati:
Īsts vārds - %s
e-mail adrese - %s
Lietotāja vārds - %s

Uz šo vēstuli nav jāatbild, jo tā ir ģenerēta automātiski un domāta tikai informēšanai.";
    public $_NEW_MESSAGE = 'Jums atnākusi jauna personīgā vēstule';
    public $_NEW_PRMSGF = "Saņemta jauna personīgā vēstule no %s";
    public $_LOG_READMSG = 'Lūdzu, autorizējieties vadības panelī personīgās vēstules lasīšanai.';
    public $_SUBCON_APPRNTF = 'Paziņojums par pievienotā materiāla apstiprināsanu';
    public $_SUBCON_ATAPPR = 'Pievienotais materiāls ir apstiprināts ar %s  .';
    public $_SECTION = 'Nodaļa';
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