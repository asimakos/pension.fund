<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Elxis Team
* @translator: PARACOM Software
* @link: http://elxis.cz
* @email: info@elxis.cz
* @description: Czech language for FloodBlocker tool
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Přístup do této lokace není povolen.' );


define('_FLOODL_CONFIG', 'FloodBlocker Konfigurace');
define('_FLOODL_CONFPERMSUCC', 'Konfigurační soubor FloodBlocker úspěšně nastaven na');
define('_FLOODL_CONFPERMNO', 'Není možné nastavit konfigurační soubor FloodBlockeru na zapisovatelný');
define('_FLOODL_LOGSPERMSUCC', 'Adresář logů FloodBlockeru úspěšně nastaven na');
define('_FLOODL_LOGSPERMNO', 'Není možné nastavit adresář logů FloodBlockeru na zapisovatelný');
define('_FLOODL_INVINTER', 'Neplatný Cron Interval!');
define('_FLOODL_INVTIME', 'Neplatné časování logů!');
define('_FLOODL_ONEPAIR', 'Musíš zadat alespoň jeden platný vztah interval-limit!');
define('_FLOODL_CONFSAVESUCC', 'Konfigurační soubor FloodBlockeru úspěšně uložen!');
define('_FLOODL_CONFSAVENO', 'Není možné uložit konfigurační složku FloodBlockeru!');
define('_FLOODL_ENABLEDESC', 'Povolit ochranu před zahlcením nebo ne (před povolením se ujistěte. zda adresář /tools/floodblocker/logs je zapisovatelný)');
define('_FLOODL_CRONINT', 'Cron interval');
define('_FLOODL_CRONINTDESC', 'Vykonávací Cron interval v sekundách. 1800 sec (30 min) standartně');
define('_FLOODL_LOGSTIME', 'Časování logů');
define('_FLOODL_LOGSTIMEDESC', 'Po kolika sekundách pokládat soubor logů za starý? Standartně budou soubory pokládané za staré po 7200 sec (2 hodiny)');
define('_FLOODL_FLOODRULES', 'FloodBlocker Pravidla');
define('_FLOODL_INTSECS', 'Interval (sekundy)');
define('_FLOODL_LIMREQS', 'Limit (žádostí)');
define('_FLOODL_FLOODCONFIS', 'Konfigurační soubor FloodBlockeru je');
define('_FLOODL_FLOODLOGSIS', 'Adresář logů FloodBlockeru je');
define('_FLOODL_MAKEWRITE', 'Nastavte na zápis');
define('_FLOODL_PAIRSDESC', 'Asociativní sada formátu {INTERVAL} => {LIMIT} , 
	kde {LIMIT} je číslo přijatelných žádostí během {INTERVAL} sekund. 
	Použijte několik párů, které si přejete. Svědčící pravidla:<br>
	&nbsp; &nbsp; - pravidlo 1: 10=>10 (maximum 10 žádostí za 10 sekund)<br>
	&nbsp; &nbsp; - pravidlo 2: 60=>30 (maximum 30 žádostí za 60 sekund)<br>
	&nbsp; &nbsp; - pravidlo 3: 300=>50 (maximum 50 žádostí za 300 sekund)<br>
	&nbsp; &nbsp; - pravidlo 4: 3600=>200 (maximum 200 žádostí za 1 sekund)<br><br>
	6 Pravidel maximálně');
define('CX_LFLOODBD', 'FloodBlocker chrání vaší Elxis síť před zahlcením útoky.');

?>