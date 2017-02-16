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
* @ Description: Srpski language for Defender tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


DEFINE ('_DEFL_CONFIG', 'Конфигурација Elxis заштитника');
DEFINE ('_DEFL_CONFPERMSUCC', 'Дозволе конфигурационог фајла Заштитника су успешно измењене на');
DEFINE ('_DEFL_CONFPERMNO', 'Не могу да откључам Заштитников конфигуравиони фајл');
DEFINE ('_DEFL_LOGSPERMSUCC', 'Дозволе Заштитникове евиденције су успешно измењене на');
DEFINE ('_DEFL_LOGSPERMNO', 'Не могу да откључам директоријум евиденције');
DEFINE ('_DEFL_ENABLEDESC', 'Укључивање/Искључивање Заштитника (проверите да ли је /administrator/tools/defender/logs откључан)');
DEFINE ('_DEFL_PROTVARS', 'Заштићене варијабле');
DEFINE ('_DEFL_PROTVARSD', 'Избор заштићених варијабли (предефинисано је: REQUEST)');
DEFINE ('_DEFL_LOGATTACKS', 'Евидентирање напада');
DEFINE ('_DEFL_LOGATTACKSD', 'Уколико је укључено, Заштитник ће водити евиденцију, и обавестити Вас о сваком нападу');
DEFINE ('_DEFL_MAILALERT', 'Порука упозорења');
DEFINE ('_DEFL_MAILALERTD', 'Уколико је укључено, Заштитник ће Вам послати поруку о сваком нападу');
DEFINE ('_DEFL_MAILADDR', 'Адреса е-поште (за обавештења)');
DEFINE ('_DEFL_SITEOFFFOR', 'Сајт ван функције на');
DEFINE ('_DEFL_SECONDS', 'секунди');
DEFINE ('_DEFL_SITEOFFD', 'Након напада, сајт ће бити стављен ван функције на X секунди. 0 уколико нежелите да користите ову могућност');
DEFINE ('_DEFL_BLOCKIP', 'Блокирање IP-ја');
DEFINE ('_DEFL_BLOCKIPD', 'Блокирање IP адресе нападача. Обратите пажњу на чињеницу да ће Заштитник блокирати притуп сваком потенцијалном нападачу, чак и Вама!');
DEFINE ('_DEFL_FILTERS', 'Филтери');
DEFINE ('_DEFL_FILTHELP', '<b>Elxis Заштитник је неупотребљив без филтера.</b><br />
	Да бисте додали нови филтер, унесите реч или фрзу коју желите да филтрирате и кликните <b>Додавање</b>.<br />
	Не морате водити рачуна о великим или малим словима.<br />
	Притисните <b>Брисање</b> како бисте филтер уклонили са листе.<br />
	Уколико познајете начин рада <b>mod_Security</b> Apache срвера, имајте у виду да Elxis Заштитник функционише на сличан начин, 
	при додавању филтера.<br />
	Када завршите, кликните <b>Чување</b> да бисте сачували конфигурацију Заштитника.<br />');
DEFINE ('_DEFL_SLOWDOWNT', 'Успоравање');
DEFINE ('_DEFL_SLOWDOWN', 'Употреба Elxis Заштитника успорава сајт. 
	Додавање превише филтера може превише увећати време извршавања php захтева. Савет је да не додајете више од 15 филтера, 
	подстичемо Вас да експериментишете, јер много тога зависи од сајта и сервера. 
	Изузмите одређене фитере, уколико имате потешкоћа. 
	Наши лабораторијски тестови су показали успорење од <b>0.1 до 27 msec</b> у зависности од броја филтера (од 10 до 30) 
	и улазних варијабли са којима је Заштитник суочен (од обичног прегледа, до слања огромних чланака путем POST или GET метода).');
DEFINE ('_DEFL_EXAMPLEFIL', 'Примери филтера');
DEFINE ('_DEFL_DEFCONFIS', 'Фајл конфигурације Заштитника је');
DEFINE ('_DEFL_DEFLOGSIS', 'Директоријум евиденције Заштитника је');
DEFINE ('_DEFL_MAKEWRITE', 'Откључавање');
DEFINE ('_DEFL_CONFSAVESUCC', 'Конфигурација заштитника је успешно сачувана!');
DEFINE ('_DEFL_CONFSAVENO', 'Не могу да сачувам конфигурацију Заштитника!');
DEFINE ('_DEFL_ERRONEFILT', 'Грешка: Морате додати бар један филтер!');
DEFINE ('_DEFL_ENCKEY', 'Шифровани кључ');
DEFINE ('_DEFL_ENCKEYD', 'Употребљава се за шифровање информација. Дужина кључа мора бити између 8 и 32 карактера. Обришите све евиденционе записе пре промене кључа!');
DEFINE ('_DEFL_ERRENCKEY', 'Грешка: Дужина кључа мора бити између 8 и 32 карактера');
DEFINE ('_DEFL_ENABLEDEF', 'Укључивање Заштитника');
DEFINE ('_DEFL_DISABLEDEF', 'Искључивање Заштитника');
DEFINE ('_DEFL_VIEWLOGS', 'Преглед евиденције');
DEFINE ('_DEFL_CLEARLOGS', 'Чишћење записа');
DEFINE ('_DEFL_VIEWBLOCK', 'Преглед блокираних IP-јева');
DEFINE ('_DEFL_CLEARBLOCK', 'Чишћење блокираних IP-јева');
DEFINE ('_DEFL_DEFENDER', 'Elxis Заштитник');
DEFINE ('_DEFL_LOGSCLEARED', 'Записи су очишћени');
DEFINE ('_DEFL_CNOTCLLOGS', 'Не могу да очистим записе. Проверите да ли је фајл откључан.');
DEFINE ('_DEFL_BLOCKCLEARED', 'Све блокиране IP адресе су обрисане');
DEFINE ('_DEFL_CNOTCLBLOCK', 'Не могу да очистим блокиране IP адресе. Проверите да ли је фајл откључан.');
DEFINE ('_DEFL_SUBMITALERT', 'Измена филтера док је Заштитник укључен, биће сматрана нападом! Најпре искључите Заштитника, направите измене, а затим га укључите');
DEFINE ('_DEFL_GEOLOCATE', 'Лоцирање');
DEFINE ('_DEFL_PERMSUCC', 'Дозволе успешно измењене на');
DEFINE ('_DEFL_PERMFAIL', 'Не могу да изменим дозволе за');
DEFINE ('_DEFL_ADDIP', 'Додавање IP-ја');
DEFINE ('_DEFL_DELETEIP', 'Брисање IP-ја');
DEFINE ('_DEFL_BLOCKEDIPS', 'Блокирани IP-јеви');
DEFINE ('_DEFL_IPRANGES', 'IP опсег');
DEFINE ('_DEFL_ADDRANGE', 'Додавање IP опсега');
DEFINE ('_DEFL_DELRANGE', 'Брисање IP опсега');
DEFINE ('_DEFL_RANGEHELP', 'Да бисте блокирали одређену мрежу, провајдера, или чак целу земљу, Заштитник Вам даје могућност 
додавања IP опсега. Сваки опсег се састоји из 2 дела, одвојена доњом цртом (_). Први део 
је почетак ip адресе, а други је крај ip адресе. Заштитник ће блокирати сваки ip између ове две вредности.');
DEFINE ('_DEFL_RANGEEXAMPLES', 'Примери употребе');
DEFINE ('_DEFL_BLOCKFROM', 'ће блокирати IP-јеве од');
DEFINE ('_DEFL_BLOCKTO', 'до');
DEFINE ('_DEFL_ALLOWIPS', 'Дозвољене IP адресе');
DEFINE ('_DEFL_ALLOWIPSD', 'Уколико је укључено, моћи ћете да одредите IP којима ће бити омогућен приступ администрацији или јавном интерфејсу');
DEFINE ('_DEFL_FRONTBACK', 'Јавни и администраторски интерфејс.');
DEFINE ('_DEFL_ALLOWDIS', 'Дозвољени IP-јеви су искључени');
DEFINE ('_DEFL_ONLACCADM', 'Само доње IP адресе имају приступ администрацији');
DEFINE ('_DEFL_ONLACCSAD', 'Само доње IP адресе имају приступ јавном интерфејсу и администрацији');

?>
