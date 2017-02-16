<?php 
/**
* @ Version: 2008.0
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Elxis Team
* @ Translator: Coursar
* @ Translator URL: http://www.elxis.ru
* # Translator E-mail: info@elxis.ru
* @ Description: Russian language for Chmod tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещён.' );


define('_CMOD_CHMOD', 'Изменить права');
define('_CMOD_PATH', 'Путь');
define('_CMOD_MSGSERVER', 'Ответ Сервера');
define('_CMOD_PATHNOTEXIST', 'Путь не существует!');
define('_CMOD_PATHNOTELXIS', 'Заданный путь не относится к Elxis!');
define('_CMOD_NOTALLOWED1', 'У вас недостаточно прав для изменения прав на');
define('_CMOD_NOTALLOWED2FI', 'для файла.<br>Возможны проблемы с доступом к файлу.');
define('_CMOD_NOTALLOWED2FO', 'для каталога.<br>Возможны проблемы с доступом к каталогу.');
define('_CMOD_CHMODSUCC', 'Права успешно изменены на');
define('_CMOD_CHMODCNOT', 'Не удаётся изменить права на');
define('_CMOD_ONLYUNIX', 'Доступно только для UNIX');
define('_CMOD_LOAD', 'Загрузить');
define('_CMOD_CHMODTO', 'Изменить на');
define('_CMOD_OWNER', 'Владелец');
define('_CMOD_READ', 'Чтение');
define('_CMOD_WRITE', 'Запись');
define('_CMOD_EXECUTE', 'Выполнение');
define('_CMOD_USER', 'пользователь');
define('_CMOD_GROUP', 'группа');
define('_CMOD_WORLD', 'остальные');
define('_CMOD_SHOWHELP', 'Показать Справку');
define('_CMOD_HIDEHELP', 'Скрыть Справку');
define('_CMOD_HELPTEXT', 'Введите полный путь до существующего Elxis файла или каталога.
	Нажмите Загрузить для просмотра существующих прав и владельца для указанного пути.
	Измените права для указанного пути, нажав кнопку CHMOD. Функция доступна только на Unix системах.
	<br><br>Мы рекомендуем вам использовать следующие права:<br>
	перезаписываемые каталоги: 0777, не перезаписываемые каталоги: 0755, перезаписываемые файлы: 0666, не перезаписываемые файлы: 0644');

?>
