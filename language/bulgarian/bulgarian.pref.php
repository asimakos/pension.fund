<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Language
* @author: Elxis Team
* @translator: DedoPorno
* @link: http://www.virtuaworx.net
* @email: dedoporno@yahoo.com
* @description: Bulgarian user's preferable language
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_bulgarian {

	public $_ON_NEW_CONTENT = "Нов материал беше изпратен от [ %s ] със заглавие [ %s ] за секция [ %s ] и категория [ %s ]";
	public $_E_COMMENTS = 'Коментари';
	public $_DATE = 'Дата';
	public $_E_SUBCONWAIT = 'Изпратени материали, чакачи одобрение:';
	public $_E_CONTENTSUB = 'Изпращане на съдържание';
	public $_MAIL_SUB = 'Изпратено от потребител';
	public $_E_HI = 'Здравей';
	public $_E_NEWSUBBY = "Беше изпратен материал от %s";
	public $_E_TYPESUB = 'Тип на материала:';
	public $_E_TITLE = 'Заглавие';
	public $_E_LOGINAPPR = 'Влезте в администраторската част, за да прегледате и одобрите материала.';
	public $_E_DONTRESPOND = 'Моля, не отговаряйте на това съобщение, то е генерирано автоматично и е с информативна цел.';
	public $_E_NEWPASS_SUB = "Нова парола за %s";
	public $_E_RPASS_NADMIN = "Потребителят %s е изпратил молба за нова парола. Нова праола беше генериара и изпратена. 
	Ако не желате да получавате съобщения за тези действия променете опцията USERS_RPASSMAIL в SoftDisk на \"Не\".";
	public $_E_SEND_SUB = "Детайли за %s в %s";
	public $_ASEND_MSG = "Здравей, %s, 
Нов потребител се регистрира %s.
Нговите детайли са:

Име - %s
Email - %s
Потребителско име - %s

Моля, не отговаряйте на това съобщение, то е генерирано автоматично и е с информативна цел.";
	public $_NEW_MESSAGE = 'Пристигна ново лично съобщение';
	public $_NEW_PRMSGF = "Пристигна ново лично съобщение от %s";
	public $_LOG_READMSG = 'Моля, влезте в администраторската част, за да прочетете съобщението.';
	public $_SUBCON_APPRNTF = 'Уведомление за изпратения материал';
	public $_SUBCON_ATAPPR = 'Материалът, който изпратихте в %s беше одобрен.';
	public $_SECTION = 'Секция';
	public $_CATEGORY = 'Категория';

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