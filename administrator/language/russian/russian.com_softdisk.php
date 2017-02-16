<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ilnaz Giliazov (Coursar)
* @link: http://www.elxis.ru
* @email: info@elxis.ru
* @description: Russian language for component softdisk
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещён.' );


class adminLanguage extends standardLanguage {

public $A_CORE = 'Ядро';
public $A_ASTATS = 'Статистика Администратора';
public $A_VALUE = 'Значение';
public $A_LASTMOD = 'Последнее изменение';
public $A_OS = 'Операционная система';
public $A_ELXIS_VERSION = 'Версия Elxis';
public $A_SELECT = 'Выберите';
public $NOEDITSYS = 'Вы не можете изменять системные записи';
public $A_RESTORE = 'Восстановить';
public $SOFTDISK_HELP = 'SoftDisk - виртуальная область хранения переменных и параметров любого типа.<br />
  	Вы можете добавить новые или изменить/удалить существующие записи SoftDisk за исключением тех, которые принадлежат системе. 
	Записи, помеченные как "Не удаляемо", могут быть только изменены. Для именования разделов и записей SoftDisk 
	вы можете использовать только <strong>заглавные латинские буквы, цифры и символы подчёркивания (_)</strong>.';
public $YCNOTEDITP = 'Вы не можете изменить параметр';
public $UNDELETABLE = 'Не удаляемо';
public $SOFTENTRYEXIST = 'В SoftDisk уже существует запись с таким именем!';
public $INVSECTNAME = 'Неверное название раздела!';
public $INVNAME = 'Неверное имя!';
public $INVEMAIL = 'Предоставленное значение не является действительным email адресом!';
public $INVURL = 'Предоставленное значение не является действительным URL!';
public $INVDEC = 'Предоставленное значение не является десятичным числом!';
public $INVTSTAMP = 'Предоставленное значение не представлено в верном формате UNIX timestamp!';
public $UPSYSTEM = 'Обновить систему';
public $A_USERPROFILE = 'Профиль пользователя';
public $UPROF_WEBSITE = 'Веб-сайт';
public $UPROF_AIM = 'AIM';
public $UPROF_YIM = 'YIM';
public $UPROF_MSN = 'MSN';
public $UPROF_ICQ = 'ICQ';
public $UPROF_EMAIL = 'E-mail';
public $UPROF_PHONE = 'Телефон';
public $UPROF_MOBILE = 'Сотовый телефон';
public $UPROF_BIRTHDATE = 'Дата рождения';
public $UPROF_GENDER = 'Пол';
public $UPROF_LOCATION = 'Геогр. местонахождение';
public $UPROF_OCCUPATION = 'Профессия';
public $UPROF_SIGNATURE = 'Подпись';
public $UPROF_ARTICLES = 'Количество статей';
public $UPROF_USERGROUP = 'Группа пользователей';
public $UPROF_RANDUSERS = 'Отображать случайного пользователя на странице профиля';
public $USERS_RPASSMAIL = 'Уведомлять администраторов о запросе на смену пароля';
public $SUBMIT_CATEGORIES = 'Категории, разрешённые для пользовательского добавления содержимого. Если пусто - разрешены все категории. (ID Категорий, разделённые запятыми)';
public $SUBMIT_SECTIONS = 'Разделы, разрешённые для пользовательского добавления содержимого. Если пусто - разрешены все разделы. (ID Разделов, разделённые запятыми)';
public $REG_AGREE = 'ID автономной страницы с условиями регистрации. Ноль (0) - отключение данной функции. Для создания условий регистрации на определённом языке создайте запись SoftDisk в разделе USERS с названием REG_AGREE_LANGUAGE-HERE и типом Integer';
public $A_WEBLINKS = 'Веб-ссылки';
public $TOP_WEBLINK = 'Контроль отображения модуля Top Weblinks внутри компонента weblinks';
public $A_USERSLIST = 'Список пользователей';
public $ULIST_ONLINE = 'Online статус';
public $ULIST_USERNAME = 'Логин';
public $ULIST_NAME = 'Имя';
public $ULIST_REGDATE = 'Дата регистрации';
public $ULIST_PREFLANG = 'Предпочтительный язык';
//2009.0
public $STATICCACHE = 'Static cache';

}

?>