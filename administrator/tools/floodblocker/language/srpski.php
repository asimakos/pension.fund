<?php 
/**
* @ Version: 2008.0
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Elxis Team
* @ Translator: Ivan Trebješanin
* @ Translator URL: http://www.elxis-srbija.org
* # Translator E-mail: admin@elxis-srbija.org
* @ Description: Srpski language for FloodBlocker tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


DEFINE ('_FLOODL_CONFIG', 'Конфигурација Бране');
DEFINE ('_FLOODL_CONFPERMSUCC', 'Дозволе конфигурационог фајла Бране успешно постављене на');
DEFINE ('_FLOODL_CONFPERMNO', 'Не могу да откључам конфигурацију Бране');
DEFINE ('_FLOODL_LOGSPERMSUCC', 'Директоријум евиденције Бране успешно су постављене на');
DEFINE ('_FLOODL_LOGSPERMNO', 'Не могу да откључам директоријум евиденције Бране');
DEFINE ('_FLOODL_INVINTER', 'Неисправан интервал!');
DEFINE ('_FLOODL_INVTIME', 'Неисправно време истека евиденције!');
DEFINE ('_FLOODL_ONEPAIR', 'Морате унети бар један исправан временски пар!');
DEFINE ('_FLOODL_CONFSAVESUCC', 'Конфигурација Бране је успешно сачувана!');
DEFINE ('_FLOODL_CONFSAVENO', 'Не могу да сачувам конфигурацију Бране!');
DEFINE ('_FLOODL_ENABLEDESC', 'Укључивање/Искључивање Бране (проверите да ли је /tools/floodblocker/logs директоријум откључан пре укључивања)');
DEFINE ('_FLOODL_CRONINT', 'Интервал крона');
DEFINE ('_FLOODL_CRONINTDESC', 'Извршење крона у секундама. 1800 секунди (30 минута) је предефинисано');
DEFINE ('_FLOODL_LOGSTIME', 'Истек записа');
DEFINE ('_FLOODL_LOGSTIMEDESC', 'Након колико секунди ће записи бити саматрани застарелима? Предефинисано је 7200 секунди (2 сата)');
DEFINE ('_FLOODL_FLOODRULES', 'Поставке Бране');
DEFINE ('_FLOODL_INTSECS', 'Интервал (секунде)');
DEFINE ('_FLOODL_LIMREQS', 'Ограничење (захтеви)');
DEFINE ('_FLOODL_FLOODCONFIS', 'Конфигурациони фајл Бране је');
DEFINE ('_FLOODL_FLOODLOGSIS', 'Диекторијум записа Бране је');
DEFINE ('_FLOODL_MAKEWRITE', 'Откључавање');
DEFINE ('_FLOODL_PAIRSDESC', 'Асоцијативни низ у {ИНТЕРВАЛ} => {ОГРАНИЧЕЊЕ} формату, 
	при чему {ОГРАНИЧЕЊЕ} представља број могућих захтева током одређеног броја {ИНТЕРВАЛ} секунди. 
	Можете користити више парова. Неки парови:<br>
	&nbsp; &nbsp; - начело 1: 10=>10 (максимално 10 захтева током 10 секунди)<br>
	&nbsp; &nbsp; - начело 2: 60=>30 (максимално 30 захтева током 60 секунди)<br>
	&nbsp; &nbsp; - начело 3: 300=>50 (максимално 50 захтева током 300 секунди)<br>
	&nbsp; &nbsp; - начело 4: 3600=>200 (максимално 200 захтева током 1 сата)<br><br>
	Највише 6 начела');
DEFINE ('CX_LFLOODBD', 'Брана спречава нападе путем изазивања преоптерећења Вашег Elxis сајта.');

?>
