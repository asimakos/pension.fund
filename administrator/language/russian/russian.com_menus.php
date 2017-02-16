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
* @description: Russian language for component menus
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещён.' );


class adminLanguage extends standardLanguage {

public $A_CMP_MU_MANAGER = 'Меню';
public $A_CMP_MU_MXLVLS = 'Макс. Уровней';
public $A_CMP_MU_CANTDEL ='* Вы не можете \'удалить\' это меню - оно необходимо для правильного функционирования Elxis *';
public $A_CMP_MU_MANHOME = '* Первый опубликованный пункт в этом меню [mainmenu] будет по умолчанию \'Главной Страницей\' сайта *';
public $A_CMP_MU_MITEM = 'Пункт Меню';
public $A_CMP_MU_NSMTG = ' Примечание : Обратите внимание, что некоторые типы меню входят в несколько групп, однако они относятся к одному типу меню.';
public $A_CMP_MU_MITYP = 'Тип Пункта меню';
public $A_CMP_MU_WBLV = '\'Блог\'';
public $A_CMP_MU_WTLV = '\'Таблица\'';
public $A_CMP_MU_WLIV = '\'Список\'';
public $A_CMP_MU_SMTAP = '* Некоторые `Типы Меню` содержатся в нескольких группах *';
public $A_CMP_MU_MOVEITS = 'Переместить Пункты Меню';
public $A_CMP_MU_MOVEMEN = 'Переместить в Меню';
public $A_CMP_MU_BEINMOV = 'Перемещаемые Пункты Меню';
public $A_CMP_MU_COPYITS = 'Копировать Пункты Меню';
public $A_CMP_MU_COPYMEN = 'Копировать в Меню';
public $A_CMP_MU_BCOPIED = 'Копируемые Пункты Меню';
public $A_CMP_MU_EDNEWSF = 'Изменить эту Ленту Новостей';
public $A_CMP_MU_EDCONTA = 'Изменить этот Контакт';
public $A_CMP_MU_EDCONTE = 'Изменить это Содержимое';
public $A_CMP_MU_EDSTCONTE = 'Изменить эту Автономную Страницу';
public $A_CMP_MU_MSGITSAV = 'Пункт Меню Сохранён';
public $A_CMP_MU_MOVEDTO = ' Пункт Меню перемещён в ';
public $A_CMP_MU_COPITO = ' Пункт Меню копирован в ';
public $A_CMP_MU_THMOD = 'Модуль';
public $A_CMP_MU_SCITLKT = 'Необходимо выбрать Компонент для связи с';
public $A_CMP_MU_COMPLLTO = 'Ссылка Компонента';
public $A_CMP_MU_ITEMNAME = 'У пункта должно быть название';
public $A_CMP_MU_PLSELCMP = 'Пожалуйста, выберите Компонент';
public $A_CMP_MU_PARAVAI = 'Список параметров будет доступен после сохранения этого нового пункта меню';
public $A_CMP_MU_YSELCAT = 'Необходимо выбрать категорию';
public $A_CMP_MU_TMHTITL = 'У этого пункта меню должно быть название';
public $A_CMP_MU_TABLE = 'Таблица';
public $A_CMP_MU_CCTBLANK = 'Если вы не заполните это поле, автоматически будет использовано название категории';
public $A_CMP_MU_LNKHNAME = 'У ссылки должно быть название';
public $A_CMP_MU_SELCONT = 'Необходимо выбрать контакт для связи';
public $A_CMP_MU_CONLINK = 'Контакт';
public $A_CMP_MU_ONCLOPI = 'При нажатии открыть в';
public $A_CMP_MU_THETITL = 'Название:';
public $A_CMP_MU_YMSSECT = 'Необходимо выбрать Раздел';
public $A_CMP_MU_ILBLSEC = 'Если вы оставите это поле пустым, автоматически будет использовано название раздела';
public $A_CMP_MU_YCSMC = 'Вы можете выбрать несколько Категорий';
public $A_CMP_MU_YCSMS = 'Вы можете выбрать несколько Разделов';
public $A_CMP_MU_EDCOI = 'Изменить Объект содержимого';
public $A_CMP_MU_YMSLT = 'Необходимо выбрать Содержимое для связи с';
public $A_CMP_MU_STACONT = 'Содержимое Автономной Страницы';
public $A_CMP_MU_ONCLOP = 'При нажатии открыть';
public $A_CMP_MU_YSNWLT = 'Необходимо выбрать Ленту Новостей для связи с';
public $A_CMP_MU_NEWTL = 'Лента Новостей';
public $A_CMP_MU_SEPER = '- - - - - - -'; //Change this, if you want to change the symbols for seperator line
public $A_CMP_MU_PATNAM = 'Шаблон/Название';
public $A_CMP_MU_WRURL = 'Необходимо ввести url.';
public $A_CMP_MU_WRLINK = 'Ссылка Оболочки';
public $A_CMP_MU_MIBGCC = 'Блог - Содержимое Категории';
public $A_CMP_MU_MITCG = 'Таблица - Контакты Категории'; 
public $A_CMP_MU_MICOMP = 'Компонент';
public $A_CMP_MU_MIBGCS = 'Блог - Содержимое Раздела';
public $A_CMP_MU_MILCMPI = 'Ссылка - Объект Компонента';
public $A_CMP_MU_MILCI = 'Ссылка - Контакт';
public $A_CMP_MU_MITBCC = 'Таблица - Содержимое Категории';
public $A_CMP_MU_MILCEI = 'Ссылка - Объект Содержимого';
public $A_CMP_MU_COTLINK = 'Содержимое';
public $A_CMP_MU_MITBCS = 'Таблица - Содержимое Раздела';
public $A_CMP_MU_MILSTC = 'Ссылка - Автономная Страница';
public $A_CMP_MU_MITBNFC = 'Таблица - Ленты Новостей из Категории';
public $A_CMP_MU_MILNEW = 'Ссылка - Лента Новостей';
public $A_CMP_MU_MISEP = 'Разделитель / Заполнитель';
public $A_CMP_MU_MILIURL = 'Ссылка - URL';
public $A_CMP_MU_MITBWC = 'Таблица - Категория Ссылок';
public $A_CMP_MU_MIWRAP = 'Оболочка';
public $A_CMP_MU_ITEM = 'Объект';
public $A_CMP_MU_UMSBRI = 'Необходимо выбрать Мост';
public $A_CMP_MU_BRINOINS = 'Компонент мостов не установлен!';
public $A_CMP_MU_NOPUBBRI = 'Нет опубликованных мостов!';
public $A_CMP_MU_CLVSEO = 'Нажмите на автономной странице для просмотра её SEO заголовка';
public $A_CMP_MU_SYSLINK = 'Системная ссылка';
public $A_CMP_MU_SYSLINKD = 'Системная ссылка должна принадлежать опубликованному меню в позиции модуля, которой НЕТ в шаблоне!';
public $A_CMP_MU_PASSR = 'Напоминание пароля';
public $A_CMP_MU_UREG = 'Регистрация пользователя';
public $A_CMP_MU_REGCOMP = 'Завершение регистрации';
public $A_CMP_MU_ACCACT = 'Активация аккаунта';
public $A_CMP_MU_MSLINK = 'Необходимо выбрать системную ссылку.';
public $A_CMP_MU_SELLINK = '- Выберите ссылку -';
public $A_CMP_MU_DONTDEL ='* Не удаляйте это меню - оно улучшает функциональность Elxis. Убедитесь, что оно опубликовано в позиции, которая НЕ существует в шаблоне! *';
public $A_CMP_MU_EDPROF = 'Изменить профиль';
public $A_CMP_MU_SUBWEBL = 'Добавить ссылку';
public $A_CMP_MU_CHECKIN = 'Проверка';
public $A_CMP_MU_USERLIST = 'Список пользователей';
public $A_CMP_MU_POLLS = 'Опросы';

//elxis 2008.1
public $A_CMP_MU_SELBLOG = 'Необходимо выбрать блог';
public $A_CMP_MU_BLOGLINK = 'Блог';

}

?>