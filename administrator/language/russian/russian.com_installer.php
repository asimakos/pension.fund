<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ilnaz Giliazov (Coursar)
* @link: http://www.elxis.ru
* @email: info@elxis.ru
* @description: Russian language for component installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_INS_SDIR = 'Пожалуйста, выберите каталог';
public $A_CMP_INS_UPF = 'Загрузить Файл';
public $A_CMP_INS_PF = 'Файл';
public $A_CMP_INS_UFI = "Загрузить Файл и Установить";
public $A_CMP_INS_FDIR = 'Установить из каталога';
public $A_CMP_INS_IDIR = 'Каталог установки';
public $A_CMP_INS_DOIN = 'Установить';
public $A_CMP_INS_CONT = 'Продолжить...';
public $A_CMP_INS_NF = 'Не найден установщик для элемента ';
public $A_CMP_INS_NA = 'Не доступен установщик для элемента';
public $A_CMP_INS_EFU = 'Установка не может быть произведена, т.к. не поддерживается загрузка файлов. Пожалуйста воспользуйтесь установкой из каталога (каталог должен располагаться на сервере)..';
public $A_CMP_INS_ERTL = 'Ошибка';
public $A_CMP_INS_ERZL = 'Установка не может быть произведена, т.к. отключена поддержка zlib';
public $A_CMP_INS_ERNF = 'Не выбран файл';
public $A_CMP_INS_ERUM = 'Ошибка загрузки нового модуля';
public $A_CMP_INS_UPTL = 'Загрузить ';
public $A_CMP_INS_UPE1 = ' - Неудачная Загрузка';
public $A_CMP_INS_UPE2 = ' -  Ошибка при Загрузке';
public $A_CMP_INS_SUCC = 'Успешно';
public $A_CMP_INS_ER = 'Ошибка';
public $A_CMP_INS_ERFL = 'Неудача';
public $A_CMP_INS_UPNW = 'Загрузить новый ';
public $A_CMP_INS_FP = 'Ошибка изменения прав загружаемого файла.';
public $A_CMP_INS_FM = 'Ошибка при попытке переместить загружаемый файл в каталог <code>/media</code>.';
public $A_CMP_INS_FW = 'Загрузка неудачна, т.к. каталог <code>/media</code> не доступен для записи.';
public $A_CMP_INS_FE = 'Загрузка неудачна, т.к. каталог <code>/media</code> не найден.';
public $A_CMP_INST_ERUNR = 'Неисправимая ошибка';
public $A_CMP_INST_EREXT = 'Ошибка распаковки';
public $A_CMP_INST_ERMXM = '<strong>ОШИБКА:</strong> не обнаружен установчный Elxis XML файл в пакете';
public $A_CMP_INST_ERXML = '<strong>ОШИБКА:</strong> не обнаружен установчный XML файл в пакете';
public $A_CMP_INST_ERNFN = 'Не определено имя файла';
public $A_CMP_INST_ERVLD = 'неверный установочный Elxis файл';
public $A_CMP_INST_ERINC = 'Метод установки не может быть вызван из класса';
public $A_CMP_INST_ERUIC = 'Метод удаления не может быть вызван из класса';
public $A_CMP_INST_ERIFN = 'Не найден установочный файл';
public $A_CMP_INST_ERSXM = 'установочный XML файл не для';
public $A_CMP_INST_ERCDR = 'Ошибка при попытке создать каталог';
public $A_CMP_INST_FNOTE = 'не существует!';
public $A_CMP_INST_TAFC = 'Уже существует файл с таким именем';
public $A_CMP_INST_AYIT = '- Вы пытаетесь установить одно и то же расширение дважды?';
public $A_CMP_INST_FCPF = 'Ошибка при копировании файла';
public $A_CMP_INST_CPTO = 'в';
public $A_CMP_INST_UNINSTALL = 'Удаление';
public $A_CMP_INST_CUDIR = 'Другой компонент уже использует каталог';
public $A_CMP_INST_SQLER = 'Ошибка SQL';
public $A_CMP_INST_CCPHP = 'Не удаётся скопировать установочный PHP файл.';
public $A_CMP_INST_CCUNPHP = 'Не удаётся скопировать PHP файл удаления.';
public $A_CMP_INST_UNERR = 'Удаление -  ошибка';
public $A_CMP_INST_THCOM = 'Компонент';
public $A_CMP_INST_ISCOR = 'основной компонент и не может быть удалён.<br />Вам необходимо снять его с публикации, если вы не хотите использовать его';
public $A_CMP_INST_XMLINV = 'Неправильный XML файл';
public $A_CMP_INST_OFEMP = 'Область выбора пуста, не удаётся удалить файлы';
public $A_CMP_INST_INCOM = 'Установленные компоненты';
public $A_CMP_INST_CURRE = 'Установленные';
public $A_CMP_INST_MENL = 'Ссылка Меню Компонента';
public $A_CMP_INST_AUURL = 'URL Автора';
public $A_CMP_INST_NCOMP = 'Нет установленных пользовательских компонентов';
public $A_CMP_INST_INSCO = 'Установить новый компонент';
public $A_CMP_INST_DELE = 'Удаление';
public $A_CMP_INST_LIDE = 'Пуст языковой id, не удаётся удалить файлы';
public $A_CMP_INST_ALL = 'все';
public $A_CMP_INST_BKLM = 'Вернуться к Языкам';
public $A_CMP_INST_NWLA = 'Установить Новый язык';
public $A_CMP_INST_NFMM = 'Не обнаружено файлов, маркированных как файлы бота';
public $A_CMP_INST_MAMB = 'бот';
public $A_CMP_INST_AXST = 'уже существует!';
public $A_CMP_INST_IOID = 'Неправильный id объекта';
public $A_CMP_INST_FFEM = 'Поле Каталога пусто, не удаётся удалить файлы';
public $A_CMP_INST_DXML = 'Удаление XML Файла';
public $A_CMP_INST_ICMO = 'основной элемент и не может быть удалён.<br />Вам необходимо снять его с публикации, если вы не хотите использовать его';
public $A_CMP_INST_IMBT = 'Установленные боты';
public $A_CMP_INST_OMBT = 'Только эти отображённые Мамботы могут быть удалены - Основные Мамботы не могут быть удалены.';
public $A_CMP_INST_MBT = 'Бот';
public $A_CMP_INST_MTYP = 'Тип';
public $A_CMP_INST_NMBT = 'Это не основной, установлен дополнительный бот.';
public $A_CMP_INST_INMT = 'Установить новый Бот';
public $A_CMP_INST_UCTP = 'Неизвестный тип клиента';
public $A_CMP_INST_NFMD = 'Нет файлов, маркированных как файлы модулей';
public $A_CMP_INST_MODULE = 'Модуль';
public $A_CMP_INST_ICMDL = 'основной модуль, и не может быть удалён.<br />Вам необходимо снять его с публикации, если вы не хотите использовать его';
public $A_CMP_INST_IMDL = 'Установленные Модули';
public $A_CMP_INST_OMDL = 'Только эти отображённые Модули могут быть удалены - Основные модули удалены быть не могут.';
public $A_CMP_INST_MDLF = 'Файл Модуля';
public $A_CMP_INST_NMDL = 'Нет доп. установленных модулей';
public $A_CMP_INST_NWMDL = 'Установить Новый Модуль';
public $A_CMP_INST_ALLC = 'Все';
public $A_CMP_INST_STMDL = 'Модули сайта';
public $A_CMP_INST_ADMDL = 'Админ Модули';
public $A_CMP_INST_DDEX = 'Каталог не найден, не удаётся удалить файлы';
public $A_CMP_INST_TIDE = 'Id шаблона пусто, не удаётся удалить файлы';
public $A_CMP_INST_TINS = 'Установить новый шаблон';
public $A_CMP_INST_BATP = 'Вернуться к шаблонам';
public $A_CMP_INST_INSBR = 'Установить новый Мост';
public $A_CMP_INST_BABR = 'Вернуться к Мостам';
public $A_CMP_INST_BIDE = 'Id Моста пусто, не удаётся удалить файл';
public $A_INST_INCOM = 'Обнаружена возможная несовместимость вашей версии Elxis и установленного расширения. 
Несмотря на это, приложение может работать без ошибок. Это всего лишь уведомление.';
public $A_INST_INCOMJOO = 'Установленный пакет предназначен для Joomla CMS!';
public $A_INST_INCOMMAM = 'Установленный пакет предназначен для Mambo CMS!';
public $A_INST_OLDER = 'Установочный пакет предназначен для более ранней версии Elxis (%s) чем ваша (%s)';
public $A_INST_NEWER = 'Установочный пакет предназначен для более новой версии (%s) чем ваша (%s)';
//2009.0
public $A_INST_DOINEDC = 'Загрузить и установить расширения Elxis Downloads Center';
public $A_INST_FETCHAVEXTS = 'Показать список доступных расширений';
public $A_INST_MORE = 'Подробнее';
public $A_INST_LESS = 'Скрыть';
public $A_INST_SIZE = 'Размер';
public $A_INST_DOWNLOAD = 'Загрузить';
public $A_INST_DOWNLOADS = 'Загрузок';
public $A_INST_DOWNINST = 'Загрузить и установить';
public $A_INST_LICENSE = 'Лицензия';
public $A_INST_COMPAT = 'Совместимость';
public $A_INST_DATESUB = 'Дата публикации';
public $A_INST_SUREINST = 'Вы уверены, что хотите установить %s ?'; //translators help: filled in be extension title
//2009.2
public $A_INST_UPTODATE = 'Современный';
public $A_INST_OUTDATED = 'Устаревший';
public $A_INST_INSTVERS = 'Установленная версия';
public $A_INST_UNLOAD = 'Разгружать';
public $A_INST_EDCUPDESC = 'List of the installed third party extensions and their update status.<br />
	The information is taken live from the <a href="http://www.elxis-downloads.com/" title="EDC" target="_blank">Elxis Downloads Center</a>.<br />
	In order for the versioning check to be successuful your web site must be able to connect to the <strong>EDC</strong> remote center.';
public $A_INST_EDCUPNOR = "Version check returned nothing.<br />
	Most probably you do not have any third party %s installed.";

}

?>