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
* @description: Russian language for component bridge
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещён.' );


class adminLanguage extends standardLanguage {

public $A_CMP_BRI_SYSDISABLED = 'Система Мостов не включена!';
public $A_CMP_BRI_INVBRIDGE = 'Неверный Мост';
public $A_CMP_BRI_BRISUCPUB = 'Мост успешно опубликован';
public $A_CMP_BRI_BRISUCUNPUB = 'Мост успешно снят с публикации';
public $A_CMP_BRI_CNOTPUBBRI = 'Не удаётся опубликовать Мост';
public $A_CMP_BRI_CNOTUNPUBRI = 'Не удаётся снять Мост с публикации';
public $A_CMP_BRI_CNOTSAVESETS = 'Не удаётся сохранить настройки!';
public $A_CMP_BRI_UNPUBBRIFIRST = 'Сначала снимите Мост с публикации!';
public $A_CMP_BRI_BRIUNISTSUC = 'Мост успешно удалён';
public $A_CMP_BRI_CNOTUNISTBRI = 'Не удаётся удалить Мост. Пожалуйста, проверьте права на каталог /bridges.';
public $A_CMP_BRI_CNOTDETREGV = 'Не удаётся определить текущую версию реестра!';
public $A_CMP_BRI_CNOTUPDREG = 'Не удаётся обновить реестр!';
public $A_CMP_BRI_REGSUCUPTO = 'Реестр успешно обновлён до версии';
public $A_CMP_BRI_REGINIUNWR = 'registry.ini не доступен для записи!';
public $A_CMP_BRI_REGUPTODATE = 'Уже установлен новейший реестр!';
public $A_CMP_BRI_BRIUNPUB = 'Мост не опубликован!';
public $A_CMP_BRI_CNOTLOCXML = 'Не удаётся обнаружить XML файл Моста!';
public $A_CMP_BRI_BNOTHAVECFI = 'У Моста %s отсутствует конфигурационный файл';
public $A_CMP_BRI_BNOTHAVECPA = 'У Моста %s отстутствуют конфигурационные параметры!';
public $A_CMP_BRI_DETINVPARAMS = 'Обнаружены неверные параметры!';
public $A_CMP_BRI_INSTBRI = 'Установленные Мосты';
public $A_CMP_BRI_SYSENABLED = 'Система Мостов включена';
public $A_CMP_BRI_REGVERSION = 'Версия реестра';
public $A_CMP_BRI_DETREGERRUP = 'Обнаружена ошибка реестра. Пожалуйста, обновите реестр Моста!';
public $A_CMP_BRI_UPDATE = 'Обновить';
public $A_CMP_BRI_REGERR = 'Ошибка Реестра';
public $A_CMP_BRI_LICENSE = 'Лицензия';
public $A_CMP_BRI_UNIST = 'Удалить';
public $A_CMP_BRI_DISBRISYS = 'Отключить';
public $A_CMP_BRI_ENBRISYS = 'Включить';
public $A_CMP_BRI_REGMOD = 'Модуль Регистрации';
public $A_CMP_BRI_REGMODHELP = 'Выберите, какое приложение вы хотите использовать как систему Входа/Регистрации пользователей.';
public $A_CMP_BRI_REGMODHELP2 = 'Вы можете выбрать между Elxis и опубликованными Мостами.';
public $A_CMP_BRI_REGMODHELP3 = 'Некоторые Мосты НЕ ИМЕЮТ системы Входа/Регистрации пользователей.';
public $A_CMP_BRI_REGMODHELP4 = 'Не забывайте использовать Соединенный мостом модуль Входа вместо обычного.';
public $A_CMP_BRI_NOTE = 'Примечание';

}

?>
