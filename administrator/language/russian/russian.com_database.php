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
* @description: Russian language for component database
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещён.' );


class adminLanguage extends standardLanguage {

public $A_CMP_DB_TABNM = 'Имя Таблицы';
public $A_CMP_DB_ACTIONS = 'Действия';
public $A_CMP_DB_TDESCR = 'Описание Таблицы';
public $A_CMP_DB_BROWSE = 'Просмотр';
public $A_CMP_DB_STRUCTURE = 'Структура';
public $A_CMP_DB_INFO = 'Информация';
public $A_CMP_DB_DUMPDB = 'Дамп Базы Данных';
public $A_CMP_DB_XDUMPDB = 'XML/SQL Дамп Базы Данных';
public $A_CMP_DB_BACTYPE = 'Тип Бэкапа';
public $A_CMP_DB_XML = 'XML';
public $A_CMP_DB_SQL = 'SQL';
public $A_CMP_DB_XCRBACK = 'Сделать XML Бэкап';
public $A_CMP_DB_XFULL = 'Структура &amp; Данные';
public $A_CMP_DB_XSTRUONL = 'Только Структура';
public $A_CMP_DB_XSAVSERV = 'Сохранить на Сервере';
public $A_CMP_DB_DOWNLD = 'Скачать';
public $A_CMP_DB_XMLBACK = 'XML Бэкап';
public $A_CMP_DB_SCRBACK = 'Сделать SQL Бэкап';
public $A_CMP_DB_SFULL = 'Структура &amp; Данные';
public $A_CMP_DB_SDATAONL = 'Только Данные';
public $A_CMP_DB_SLOCTBL = 'Заблокировать Таблицу';
public $A_CMP_DB_SFSYNTX = 'Полный Синтаксис';
public $A_CMP_DB_SDRTBL = 'Уничтожить Таблицу';
public $A_CMP_DB_STBLS = 'Таблицы';
public $A_CMP_DB_ATBLS = 'Все';
public $A_CMP_DB_SELTBLS = 'Выбранные';
public $A_CMP_DB_SQLBACK = 'SQL Бэкап';
public $A_CMP_DB_TDESC = 'Описание Таблицы';
public $A_CMP_DB_CLNAME = 'Имя Столбца';
public $A_CMP_DB_CLTYPE = 'Тип Столбца';
public $A_CMP_DB_ADOTYPE = 'Тип ADOdb';
public $A_CMP_DB_MAXLEN = 'Макс. Длина';
public $A_CMP_DB_BRTBL = 'Просмотр Таблицы';
public $A_CMP_DB_BCKDB = 'Вернуться в Базу Данных';
public $A_CMP_DB_DBTYPE = 'Тип Базы Данных';
public $A_CMP_DB_DBDESCR = 'Описание Базы Данных';
public $A_CMP_DB_DBVER = 'Версия Базы Данных';
public $A_CMP_DB_DBHOST = 'Хост Базы Данных';
public $A_CMP_DB_DBNAME = 'Имя Базы Данных';
public $A_CMP_DB_DBUSER = 'Пользователь';
public $A_CMP_DB_DBERRF = 'Raise Error FN';
public $A_CMP_DB_DBDBG = 'Отладка';
public $A_CMP_DB_TBLSTR = 'Структура таблицы';
public $A_CMP_DB_DBBACK = 'Бэкап БД';
public $A_CMP_DB_NOEXISTS = 'Бэкапов не обнаружено';
public $A_CMP_DB_FOOTER= "<u>Примечание</u>: Кликните правой кнопкой мыши на имени файла и выберите 'Сохранить как' для скачивания. <u>Внимание</u>: Кодировка файлов UTF-8.";
public $A_CMP_DB_DBMONIT = 'Монитор Базы Данных';
public $A_CMP_DB_TBLNOT = 'Таблица не существует!';
public $A_CMP_DB_BACKSUCC = 'Бэкап Базы Данных Успешно создан';
public $A_CMP_DB_NOTSUPPO = 'SQL дамп не поддерживается для';
public $A_CMP_DB_NOTBLSEL = 'Не выбрана таблица!';
public $A_CMP_DB_NOTDWNL = 'Не удаётся создать/загрузить SQL Дамп';
public $A_CMP_DB_NOTCRSV = 'Не удаётся создать/сохранить SQL Дамп';
public $A_CMP_DB_DUMPSUCC = 'SQL Дамп успешно создан';
public $A_CMP_DB_DTUNKN = 'Неизвестная'; // Translate as: Unknown Date
public $A_CMP_DB_TXMLSCHEM = 'XML схема';
public $A_CMP_DB_TSQL = 'SQL';
public $A_CMP_DB_TUNKN = 'Неизвестный'; // Translate as: Unknown Type
public $A_CMP_DB_UNKOWN = 'Неизвестный'; // Translate as: Unknown Size
public $A_CMP_DB_NOFSELDEL = 'Не выбраны файлы для удаления!';
public $A_CMP_DB_FSDELETED = 'успешно удалено';
public $A_CMP_DB_FDELETED = 'Файл успешно удалён';
public $A_CMP_DB_TLMANBACK = 'Бэкапы';
public $A_CMP_DB_TLDELSLBCK = 'Удалить';
public $A_CMP_DB_TLNEWFXML = 'XML Бэкап';
public $A_CMP_DB_TLNEWFSQL = 'SQL Бэкап';
public $A_CMP_DB_MAINTEN = 'Тех. обслуживание';
public $A_CMP_DB_MAINTEND = 'Тех. обслуживание БД';
public $A_CMP_DB_OPTIM = 'Оптимизация';
public $A_CMP_DB_REPAIR = 'Ремонт';
public $A_CMP_DB_TBLOPTED = 'таблиц оптимизировано';
public $A_CMP_DB_FRUOPTINCP = 'Частое использование <strong>оптимизации</strong> увеличивает быстродействие базы данных.';
public $A_CMP_DB_RRERRDBTAB = '<strong>Ремонт</strong> - исправление всех найденных ошибок в таблицах базы данных.';
public $A_CMP_DB_FAVMYSQL = 'Эта функция доступа только в БД MySQL!';
public $A_CMP_DB_TBLREPED = 'таблиц отремонтировано';
public $A_CMP_DB_SIZE = 'Размер';

}

?>
