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
* @ Description: Russian language for FloodBlocker tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещён.' );


DEFINE ('_FLOODL_CONFIG', 'Конфигурация FloodBlocker');
DEFINE ('_FLOODL_CONFPERMSUCC', 'Права конфигурационного файла FloodBlocker успешно изменены на');
DEFINE ('_FLOODL_CONFPERMNO', 'Не удаётся сделать конфигурационный файл FloodBlocker доступным для записи');
DEFINE ('_FLOODL_LOGSPERMSUCC', 'Права каталога отчётов FloodBlocker успешно изменены на');
DEFINE ('_FLOODL_LOGSPERMNO', 'Не удаётся сделать каталог отчётов FloodBlocker доступным для записи');
DEFINE ('_FLOODL_INVINTER', 'Неверный Интервал Cron!');
DEFINE ('_FLOODL_INVTIME', 'Неверный Интервал Отчётов!');
DEFINE ('_FLOODL_ONEPAIR', 'Вы должны предоставить хотя бы один допустимый интервал!');
DEFINE ('_FLOODL_CONFSAVESUCC', 'Конфигурационный файл FloodBlocker успешно сохранён!');
DEFINE ('_FLOODL_CONFSAVENO', 'Не удаётся сохранить конфигурационный файл FloodBlocker!');
DEFINE ('_FLOODL_ENABLEDESC', 'Включить защиту от флуда (предварительно сделайте каталог /tools/floodblocker/logs доступным для записи)');
DEFINE ('_FLOODL_CRONINT', 'Интервал Cron');
DEFINE ('_FLOODL_CRONINTDESC', 'Интервал выполнения Cron в секундах. 1800 секунд (30 минут) по умолчанию');
DEFINE ('_FLOODL_LOGSTIME', 'Интервал Отчётов');
DEFINE ('_FLOODL_LOGSTIMEDESC', 'После скольки секунд считать файл отчёта устаревшим? По умолчанию файлы считаются устаревшими после 7200 секунд (2 часа)');
DEFINE ('_FLOODL_FLOODRULES', 'Правила FloodBlocker');
DEFINE ('_FLOODL_INTSECS', 'Интервал (секунд)');
DEFINE ('_FLOODL_LIMREQS', 'Лимит (запросов)');
DEFINE ('_FLOODL_FLOODCONFIS', 'Конфигурационный файл FloodBlocker');
DEFINE ('_FLOODL_FLOODLOGSIS', 'Каталог отчётов FloodBlocker');
DEFINE ('_FLOODL_MAKEWRITE', 'Сделать доступным для записи');
DEFINE ('_FLOODL_PAIRSDESC', 'Ассоциативный массив в формате {INTERVAL} => {LIMIT}, 
	где {LIMIT} числов возможных запросов в течение {INTERVAL} секунд. 
	Используйте столько пар, сколько захотите. Начальные правила:<br>
	&nbsp; &nbsp; - правило 1: 10=>10 (максимум 10 запросов за 10 сек)<br>
	&nbsp; &nbsp; - правило 2: 60=>30 (максимум 30 запросов за 60 сек)<br>
	&nbsp; &nbsp; - правило 3: 300=>50 (максимум 50 запросов за 300 сек)<br>
	&nbsp; &nbsp; - правило 4: 3600=>200 (максимум 200 запросов в 1 час)<br><br>
	6 Правил Максимум');
DEFINE ('CX_LFLOODBD', 'FloodBlocker защищает ваш сайт от Флуд-атак.');

?>
