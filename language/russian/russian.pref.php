<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Language
* @author: Elxis Team
* @translator: Coursar
* @link: http://www.elxis.ru
* @email: info@elxis.ru
* @description: Russian user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_russian {

	public $_ON_NEW_CONTENT = "Пользователь [ %s ] добавил новый объект [ %s ]. Раздел: [ %s ]. Категория: [ %s ]";
	public $_E_COMMENTS = 'Комментарии';
	public $_DATE = 'Дата';
	public $_E_SUBCONWAIT = 'Добавленные материалы, ждущие одобрения:';
	public $_E_CONTENTSUB = 'Добавление материалов';
	public $_MAIL_SUB = 'Новый материал';
	public $_E_HI = 'Здравствуйте';
	public $_E_NEWSUBBY = "Новый материал от пользователя %s";
	public $_E_TYPESUB = 'Тип:';
	public $_E_TITLE = 'Название';
	public $_E_LOGINAPPR = 'Авторизируйтесь в панели администратора для просмотра и одобрения этого материала.';
	public $_E_DONTRESPOND = 'На это письмо не надо отвечать, так как оно создано автоматически и предназначено только для уведомления.';
	public $_E_NEWPASS_SUB = "Новый пароль для %s";
	public $_E_RPASS_NADMIN = "Пользователь %s использовал функцию восстановления пароля. Новый пароль был сгенерирован и выслан пользователю. 
	Если вы не желаете получать уведомления о данных действиях, установите параметр USERS_RPASSMAIL в SoftDisk в значение Нет.";
	public $_E_SEND_SUB = "Данные о новом пользователе %s с %s";
	public $_ASEND_MSG = "Здравствуйте! Это системное сообщение с сайта %s.

На сайте %s зарегистрировался новый пользователь.

Данные пользователя:
Настоящее имя - %s
Адрес e-mail - %s
Имя пользователя - %s

На это письмо не надо отвечать, так как оно создано автоматически и предназначено только для уведомления.";
	public $_NEW_MESSAGE = 'Вам пришло новое личное сообщение';
	public $_NEW_PRMSGF = "Получено новое личное сообщение от %s";
	public $_LOG_READMSG = 'Пожалуйста, авторизируйтесь в панели управления для прочтения личного сообщения.';
	public $_SUBCON_APPRNTF = 'Уведомление об одобрении добавленного материала';
	public $_SUBCON_ATAPPR = 'Материал, добавленный вами на %s, одобрен.';
	public $_SECTION = 'Раздел';
	public $_CATEGORY = 'Категория';

	//elxis 2008.1
	public $_MANAPPROVE = 'Для того, чтобы пользователь мог войти на сайт, вам необходимо активировать его аккаунт!';
	public $_ACCUNBLOCK = "Ваш аккаунт на %s был активирован администратором сайта. Теперь вы можете войти на %s";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'Уведомление о новом комментарии';
	public $_E_NEWCOMBYTITLE = "Новый комментарий пользователя %s к статье под названием %s";
	public $_E_COMSTAYUNPUB = 'Этот комментарий не будет опубликован до тех пор, пока вы или супер администратор не опубликуете его.';
	public $_E_ACCEXPDATE = 'Дата истечения срока действия аккаунта';

	public function __construct() {
	}

}

?>