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
* @description: Russian language for component access manager
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещён.' );


class adminLanguage extends standardLanguage {

public $A_CMP_ACC_GROUP = 'Группы';
public $A_CMP_ACC_GRUSR = 'Число пользователей';
public $A_CMP_ACC_BCKASS = 'Внутренний доступ';
public $A_CMP_ACC_PHREN = 'Нажмите для переименования';
public $A_CMP_ACC_GRHIE = 'Иерархия групп';
public $A_CMP_ACC_GGRNM = 'Вы должны дать название группе';
public $A_CMP_ACC_GGNSO = 'Родительская группа, которую Вы выбрали, - не доступна для выбора';
public $A_CMP_ACC_MANG = 'Группы';
public $A_CMP_ACC_GDTL = 'Настройки Группы';
public $A_CMP_ACC_GNAME = 'Название Группы';
public $A_CMP_ACC_PRGR = 'Родительская Группа';
public $A_CMP_ACC_EXUG = 'Существующие Группы Пользователей';
public $A_CMP_ACC_PRMFOR = 'Права';
public $A_CMP_ACC_ACO = 'ACO';
public $A_CMP_ACC_ACOV = 'значение ACO';
public $A_CMP_ACC_AXO = 'AXO';
public $A_CMP_ACC_AXOV = 'значение AXO';
public $A_CMP_ACC_ADNP = 'Добавить новые права';
public $A_CMP_ACC_ARO = 'ARO';
public $A_CMP_ACC_AROV = 'значение ARO';
public $A_CMP_ACC_SEL = '-ВЫБРАТЬ-';
public $A_CMP_ACC_ACT = 'Действие';
public $A_CMP_ACC_ADM = 'Управление';
public $A_CMP_ACC_WKF = 'Workflow';
public $A_CMP_ACC_YMSGR = 'Вы должны выбрать группу для переименования';
public $A_CMP_ACC_TSAGN = 'Уже существует группа с таким именем';
public $A_CMP_ACC_YANARG = 'У вас недостаточно прав для переименования этой группы!';
public $A_CMP_ACC_CNUTACL = 'Не удаётся обновить таблицу _core_acl_aro_groups';
public $A_CMP_ACC_CNUTUS = 'Не удаётся обновить таблицу _users';
public $A_CMP_ACC_CNUTCAL = 'Не удаётся обновить таблицу _core_acl_access_lists';
public $A_CMP_ACC_YHTLA = 'ВЫ ДОЛЖНЫ ВОЙТИ ЗАНОВО!';
public $A_CMP_ACC_MFS = 'Сообщение с сервера';
public $A_CMP_ACC_WID = 'с id';
public $A_CMP_ACC_UGWID = 'Использовать группу с id';
public $A_CMP_ACC_RNMTO = 'переименовано в';
public $A_CMP_ACC_YCNEDGR = 'У вас недостаточно прав для изменения этой группы!';
public $A_CMP_ACC_YMSPNGR = 'Вы должны дать уникальное имя группе';
public $A_CMP_ACC_IPGR = 'Неверная родительская группа';
public $A_CMP_ACC_YCCGPY = 'Вы не можете создать группу-родитель для вашей группы!';
public $A_CMP_ACC_YCNUSGR = 'У вас недостаточно прав для использования этой группы как родителя!';
public $A_CMP_ACC_TIAGTN = 'Уже существует группа с таким именем!';
public $A_CMP_ACC_GADDSUC = 'Группа успешно добавлена с id';
public $A_CMP_ACC_CNADDNG = 'Невозможно добавить новую группу.';
public $A_CMP_ACC_THGRP = 'Группа';
public $A_CMP_ACC_UPSUCC = 'успешно обновлена';
public $A_CMP_ACC_CNUPGR = 'Не удаётся обновить группу';
public $A_CMP_ACC_GESLAG = 'Группа успешно изменена, но вам необходимо заново авторизироваться!';
public $A_CMP_ACC_NGSDEL = 'Не выбрана группа для удаления';
public $A_CMP_ACC_YCNDELG = 'Вы не можете удалить эту группу!';
public $A_CMP_ACC_YANALDG = 'У вас недостаточно прав для удаления этой группы!';
public $A_CMP_ACC_CNDLGR = 'Не удаётся удалить группу';
public $A_CMP_ACC_GRSDEL = 'Группа успешна удалена';
public $A_CMP_ACC_BCNDGP = 'но не удаётся удалить права группы!';
public $A_CMP_ACC_BCNDUS = 'но не удаётся удалить пользователей!';
public $A_CMP_ACC_NOGRSEL = 'Не выбранна Группа!';
public $A_CMP_ACC_PERMADD = 'Права успешно добавлены для';
public $A_CMP_ACC_PERDSUC = 'Права успешно удалены';
public $A_CMP_ACC_CNDELPER = 'Не удаётся удалить права доступа!';
public $A_CMP_ACC_PERMEXIST = 'Права Доступа уже существуют!';
public $A_CMP_ACC_TEDITGR = 'Изменить Группу';
public $A_CMP_ACC_TGUPALD = 'Группа Пользователей и Права Доступа будут удалены!';
public $A_CMP_ACC_TEDITPR = 'Изменить Права';
public $A_CMP_ACC_VIEW = 'Просмотр';
public $A_CMP_ACC_UPLOAD = 'Загрузка';
public $A_CMP_ACC_CONTENT = 'Содержимое';
public $A_CMP_ACC_OWN = 'Собственный';
public $A_CMP_ACC_PROF = 'Профиль';
public $A_CMP_ACC_FILES = 'Файлы';
public $A_CMP_ACC_AVATARS = 'Аватары';
public $A_CMP_ACC_MANAGE = 'Управление';
public $A_CMP_ACC_USERP = 'Свойства пользователя';

}

?>
