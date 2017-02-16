<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: Arsen Khachatryan
* @link: http://www.drakha.com
* @email: khachatryan.arsen@gmail.com
* @description: Armenian front-end language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_armenian {

	public $_ON_NEW_CONTENT = "Նոր նյութ է ներկայացվել [ %s ] կողմից վերնագրված [ %s ] հետևյալ սեկցիայում [ %s ] և հետևյալ կատեգորիայում [ %s ]";
	public $_E_COMMENTS = 'Մեկնաբանություններ';
	public $_DATE = 'Ամսաթիվ';
	public $_E_SUBCONWAIT = 'Հաստատմանը սպասող հոդվածների ցուցակ`';
	public $_E_CONTENTSUB = 'Նյութի ներկայացում';
	public $_MAIL_SUB = 'Օգտվողի ներկայացրած';
	public $_E_HI = 'Ողջույն';
	public $_E_NEWSUBBY = "Նոր նյութ ներկայացված %s կողմից";
	public $_E_TYPESUB = 'Ներկայացման տիպ';
	public $_E_TITLE = 'Վերնագիր';
	public $_E_LOGINAPPR = 'Մուտքագրվեք համակարգ նոր նյութերի դիտման և հաստատման համար:';
	public $_E_DONTRESPOND = 'Մի պատասխանեք այս նամակին, քանի որ այն ստեղծված է ավտոմատ կերպով և կրում է զուտ տեղեկատվական բնույթ';
	public $_E_NEWPASS_SUB = "Նոր անցաբառ %s օգտվողի համար";
	public $_E_RPASS_NADMIN = "Օգտվող %s ներկայացրել է անցաբառի փոփոխման հայտ: Նոր անցաբառ է ստեղծվել և ուղարկվել իրեն: Եթե չեք ցանկանում հետագայում
ստանալ նմանատիպ հաղորդագրություններ փոխեք USERS_RPASSMAIL հայտանիշը SoftDisk-ում No արժեքի:";
	public $_E_SEND_SUB = "Հաշվի մանրամասներ %s համար %s-ում";
	public $_ASEND_MSG = "Ողջույն %s, 

Նոր օգտվող է գրանցվել %s -ում հետևյալ տվյալներով`

Անուն - %s
Էլ.փոստ - %s
Մուտքանուն - %s

Մի պատասխանեք այս նամակին, քանի որ այն ստեղծված է ավտոմատ կերպով և կրում է զուտ տեղեկատվական բնույթ:";
	public $_NEW_MESSAGE = 'Նոր անձնական հաղորդագրություն է եկել';
	public $_NEW_PRMSGF = "Նոր անձնական հաղորդագրություն է եկել %s -ի կողմից";
	public $_LOG_READMSG = 'Մուտքագրվեք ղեկավարման ենթահամակարգ հաղորդագրությունը կարդալու համար:';
	public $_SUBCON_APPRNTF = 'Ներկայացված նյութի հաստատման հայտ';
	public $_SUBCON_ATAPPR = '%s-ում Ձեր ներկայացված նյութը հաստատվել է:';
	public $_SECTION = 'Սեկցիա';
	public $_CATEGORY = 'Կատեգորիա';

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