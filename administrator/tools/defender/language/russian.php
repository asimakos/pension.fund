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
* @ Description: Russian language for Defender tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещён.' );


DEFINE ('_DEFL_CONFIG', 'Конфигурация Elxis Defender');
DEFINE ('_DEFL_CONFPERMSUCC', 'рава доступа для конфигурационного файла Defender успешно изменены на');
DEFINE ('_DEFL_CONFPERMNO', 'Не удаётся сделать конфигурационный файл Defender доступным для записи');
DEFINE ('_DEFL_LOGSPERMSUCC', 'Права на каталог файлов отчётов Defender успешно изменены на');
DEFINE ('_DEFL_LOGSPERMNO', 'Не удаётся сделать каталог файлов отчётов Defender доступным для записи');
DEFINE ('_DEFL_ENABLEDESC', 'Включить Defender (предварительно сделайте каталог /administrator/tools/defender/logs доступным для записи)');
DEFINE ('_DEFL_PROTVARS', 'Защищённые переменные');
DEFINE ('_DEFL_PROTVARSD', 'Выберите тип защищённых переменных (по умолчанию: REQUEST)');
DEFINE ('_DEFL_LOGATTACKS', 'Фиксировать Атаки');
DEFINE ('_DEFL_LOGATTACKSD', 'Если включено, Defender будет создавать и записывать отчёты о каждой атаке');
DEFINE ('_DEFL_MAILALERT', 'E-mail Уведомления');
DEFINE ('_DEFL_MAILALERTD', 'Если включено, Defender будет отправлять E-mail с уведомлениями о каждой атаке');
DEFINE ('_DEFL_MAILADDR', 'E-mail адрес для уведомлений');
DEFINE ('_DEFL_SITEOFFFOR', 'Сайт выключен на');
DEFINE ('_DEFL_SECONDS', 'секунд');
DEFINE ('_DEFL_SITEOFFD', 'После атаки отключить сайт на X секунд. 0 - отменить данную функцию');
DEFINE ('_DEFL_BLOCKIP', 'Блокировать IP');
DEFINE ('_DEFL_BLOCKIPD', 'Блокировать IP адрес атакующего. Примечание: Defender будет блокировать любого, принятого за атакующего, включая вас!');
DEFINE ('_DEFL_FILTERS', 'Фильтры');
DEFINE ('_DEFL_FILTHELP', '<b>Elxis Defender более эффективен при применении фильтров.</b><br />
	Для добавления нового фильтра введите слово или фразу, которую вы хотите отфильтровать и нажмите <b>Add</b>.<br />
	Не беспокойтесь о регистре.<br />
	Нажмите <b>DEL</b> для удаления фильтра из списка.<br />
	Если вы хорошо знакомы с <b>mod_Security</b> Apache, имейте в виду, что Elxis Defender функционирует похожим способом при добавлении фильтров.<br />
	После окончания, нажмите <b>Сохранить</b> для сохранения конфигурационного файла и фильтров Defender.<br />');
DEFINE ('_DEFL_SLOWDOWNT', 'Время задержки');
DEFINE ('_DEFL_SLOWDOWN', 'Использование Defender замедляет работу Elxis. 
	Добавление большого числа фильтров может существенно замедлить время выполнения php-скриптов. Мы просим вас не добавлять более 15 фильтров, но мы также просим вас поэкспериментировать, т.к. всё зависит от сайта и сервера. 
	Обращайтесь на форумы поддержки, если вы сталкиваетесь с какими-либо трудностями. 
	Наши тестирования показывают задержку во времени от <b>0.1 до 27 msec</b> в зависимости от числа фильтров (от 10 до 30) 
	и введённых переменных, с которыми приходится работать Defender (от нормального просмотра до добавления больших статей методами POST или GET).');
DEFINE ('_DEFL_EXAMPLEFIL', 'Примеры Фильтров');
DEFINE ('_DEFL_DEFCONFIS', 'Конфигурационный файл Defender');
DEFINE ('_DEFL_DEFLOGSIS', 'Каталог отчётов Defender');
DEFINE ('_DEFL_MAKEWRITE', 'Сделать доступным для записи');
DEFINE ('_DEFL_CONFSAVESUCC', 'Конфигурация Defender успешно сохранена!');
DEFINE ('_DEFL_CONFSAVENO', 'Не удаётся сохранить конфигурацию Defender!');
DEFINE ('_DEFL_ERRONEFILT', 'Ошибка: Вы должны добавить по крайней мере один фильтр!');
DEFINE ('_DEFL_ENCKEY', 'Ключ Шифрования');
DEFINE ('_DEFL_ENCKEYD', 'Используется для шифрования информации отчётов. Длина ключа должна быть от 8 до 32 символов. Удалите все отчёты перед изменением ключа шифрования!');
DEFINE ('_DEFL_ERRENCKEY', 'Ошибка: Длина ключа шифрования должна быть от 8 до 32 символов');
DEFINE ('_DEFL_ENABLEDEF', 'Включить Defender');
DEFINE ('_DEFL_DISABLEDEF', 'Отключить Defender');
DEFINE ('_DEFL_VIEWLOGS', 'Просмотр отчётов');
DEFINE ('_DEFL_CLEARLOGS', 'Очистка отчётов');
DEFINE ('_DEFL_VIEWBLOCK', 'Просмотр блокированных IP');
DEFINE ('_DEFL_CLEARBLOCK', 'Очистка блокированных IP');
DEFINE ('_DEFL_DEFENDER', 'Elxis Defender');
DEFINE ('_DEFL_LOGSCLEARED', 'Отчёты очищены');
DEFINE ('_DEFL_CNOTCLLOGS', 'Не удаётся очистить файлы отчётов. Сделайте их доступными для записи.');
DEFINE ('_DEFL_BLOCKCLEARED', 'Все блокированные IP адреса успешно удалены');
DEFINE ('_DEFL_CNOTCLBLOCK', 'Не удаётся очистить блокированные IP Адреса. Сделайте файл доступным для записи.');
DEFINE ('_DEFL_SUBMITALERT', 'Добавление фильтров при включённом Defender будет расценено как атака! Пожалуйста, сначала отключите Defender, внесите необходимые изменения и только затем снова включите его');
DEFINE ('_DEFL_GEOLOCATE', 'Местонахождение');
DEFINE ('_DEFL_PERMSUCC', 'Права изменены на');
DEFINE ('_DEFL_PERMFAIL', 'Не удаётся изменить права');
DEFINE ('_DEFL_ADDIP', 'Добавить IP');
DEFINE ('_DEFL_DELETEIP', 'Удалить IP');
DEFINE ('_DEFL_BLOCKEDIPS', 'Блокированные IPs');
DEFINE ('_DEFL_IPRANGES', 'IP Диапазон');
DEFINE ('_DEFL_ADDRANGE', 'Добавить IP диапазон');
DEFINE ('_DEFL_DELRANGE', 'Удалить IP диапазон');
DEFINE ('_DEFL_RANGEHELP', 'TДля блокировки сети, интернет-провайдера или страны  Defender предоставляет вам опцию добавления диапазонов IP. Каждый диапазон состоит из 2 частей, разделённых подчёркиванием (_). Первая часть - начальный ip, вторая часть - конечный ip адрес. Defender будет блокировать любой ip между этими двумя значениями.');
DEFINE ('_DEFL_RANGEEXAMPLES', 'Примеры');
DEFINE ('_DEFL_BLOCKFROM', 'заблокирует IP от');
DEFINE ('_DEFL_BLOCKTO', 'до');
DEFINE ('_DEFL_ALLOWIPS', 'Разрешённые IP адреса');
DEFINE ('_DEFL_ALLOWIPSD', 'Если включено, то позволит вам установить IP адреса, которые имеют доступ только к внешнему и/или внутреннему интерфейсу сайта');
DEFINE ('_DEFL_FRONTBACK', 'Внешний и Внутренний Интерфейс.');
DEFINE ('_DEFL_ALLOWDIS', 'Разрешённые IP отключены');
DEFINE ('_DEFL_ONLACCADM', 'Только IP адреса, указанные ниже, имеют доступ к Админ.Панели');
DEFINE ('_DEFL_ONLACCSAD', 'Только IP, указанные ниже, имеют доступ к сайту и Панели Администратора.');

?>
