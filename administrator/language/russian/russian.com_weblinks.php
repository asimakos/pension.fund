<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Coursar
* @link: http://www.elxis.ru
* @email: info@elxis.ru
* @description: Russian language for component typedcontent
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещён.' );


class adminLanguage extends standardLanguage {

public $A_CMP_WBL_MANAGER = 'Веб-ссылки';
public $A_CMP_WBL_APPROVED = 'Одобрено';
public $A_CMP_WBL_MUSTTITLE = 'У веб-ссылки должно быть название';
public $A_CMP_WBL_MUSTCATEG = 'Необходимо выбрать категорию.';
public $A_CMP_WBL_YMHURL = 'Необходимо указат URL.';
public $A_CMP_WBL_WEBLNK = 'Ссылка';
public $A_CMP_WBL_MUSTURL = 'Скриншот';
public $A_CMP_WBL_SSHOTDESC = 'Используйте, если только скриншот недоступен в интернете.';
public $A_CMP_WBL_EDITCAT = 'Изменить категорию.';
public $A_CMP_WBL_EDITWL = 'Изменить веб-ссылки';
public $A_CMP_WBL_SCRNO = 'Не показывать скриншот';
public $A_CMP_WBL_SCRLOC = 'Использовать локальное изображение';
public $A_CMP_WBL_SCRINT = 'Загрузить новое изображение из интернета';
public $A_CMP_WBL_COPYDESC = "Нажмите на кнопку, чтобы получить скриншоты веб-ссылок из доступных интернет-источников.
	Если эта функция включена, после сохранения скриншот веб-ссылки будет помещён в каталог images/screenshots/ вашего сайта.";
public $A_CMP_WBL_SCRRECFROM = 'Скриншот получен из';
public $A_CMP_WBL_INVSOURCE = 'Обнаружен неверный источник';
public $A_CMP_WBL_INVURL = 'Обнаружена неверный URL ссылки';
public $A_CMP_WBL_DIRNOWRITE = 'Каталог images/screenshots/ не доступен для записи. Скриншот не может быть сохранён!';
public $A_CMP_WBL_NOTCLICKED = 'Пока ничего не выбрано.';

}

?>
