<?php 
/**
* @ Version: 2008.0
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Elxis Team
* @ Translator: Siegmund Langsch
* @ Translator URL: http://www.langschnet.de
* # Translator E-mail: s.langsch@langschnet.de
* @ Description: German language for FloodBlocker tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direkter Zugriff auf diesen Ort ist nicht erlaubt.' );


DEFINE ('_FLOODL_CONFIG', 'FloodBlocker Konfiguration');
DEFINE ('_FLOODL_CONFPERMSUCC', 'FloodBlocker Konfigurationsdatei Zugriffsrechte erfolgreich gesetzt auf');
DEFINE ('_FLOODL_CONFPERMNO', 'Konnte FloodBlocker Konfigurationsdatei nicht beschreibbar machen');
DEFINE ('_FLOODL_LOGSPERMSUCC', 'FloodBlocker Logs-Verzeichnis Zugriffsrechte erfolgreich gesetzt auf');
DEFINE ('_FLOODL_LOGSPERMNO', 'Konnte FloodBlocker Logs-Verzeichnis nicht beschreibbar machen');
DEFINE ('_FLOODL_INVINTER', 'Ungültiges Zeitintervall!');
DEFINE ('_FLOODL_INVTIME', 'Ungültiges Logs Timeout!');
DEFINE ('_FLOODL_ONEPAIR', 'Sie müssen mindestens ein gültiges Intervall-Limit-Paar angeben!');
DEFINE ('_FLOODL_CONFSAVESUCC', 'FloodBlocker Konfigurationsdatei erfolgreich gespeichert!');
DEFINE ('_FLOODL_CONFSAVENO', 'Konnte FloodBlocker Konfigurationsdatei nicht speichern!');
DEFINE ('_FLOODL_ENABLEDESC', 'Aktiviere FloodPotection oder nicht (stellen sie sicher. das /tools/floodblocker/logs beschreibbar ist, bevor sie aktivieren)');
DEFINE ('_FLOODL_CRONINT', 'Zeitintervalll');
DEFINE ('_FLOODL_CRONINTDESC', 'Cron Ausführungsintervall in Sekunden. 1800 sek. (30 min) per Voreinstellung');
DEFINE ('_FLOODL_LOGSTIME', 'Logs Timeout');
DEFINE ('_FLOODL_LOGSTIMEDESC', 'nach wie vieln Sekunden soll die Logdatei als alt erkannt werden? Per Voreinstellung wird sie nach 7200 sek. (2 Stunden) als alt erkannt');
DEFINE ('_FLOODL_FLOODRULES', 'FloodBlocker Regeln');
DEFINE ('_FLOODL_INTSECS', 'Intervall (Sekunden)');
DEFINE ('_FLOODL_LIMREQS', 'Limit (Anfragen)');
DEFINE ('_FLOODL_FLOODCONFIS', 'FloodBlocker Konfigurationsdatei ist');
DEFINE ('_FLOODL_FLOODLOGSIS', 'FloodBlocker Logs-Verzeichnis ist');
DEFINE ('_FLOODL_MAKEWRITE', 'Mache es beschreibbar');
DEFINE ('_FLOODL_PAIRSDESC', 'Ein zugeordnetes Array im {INTERVAL} => {LIMIT} Format, 
	wobei {LIMIT} die Zhal der möglichen Anfragen währen des Intervalls {INTERVAL} in Sekunden darstellt. 
	Nutzen sie so vile paare wie sie möchten. Regeln:<br>
	&nbsp; &nbsp; - rule 1: 10=>10 (maximum 10 Anfragen in 10 sek)<br>
	&nbsp; &nbsp; - rule 2: 60=>30 (maximum 30 Anfragen in 60 sek)<br>
	&nbsp; &nbsp; - rule 3: 300=>50 (maximum 50 Anfragen in 300 sek)<br>
	&nbsp; &nbsp; - rule 4: 3600=>200 (maximum 200 Anfragen in 1 Stunde)<br><br>
	6 Regeln maximal');
DEFINE ('CX_LFLOODBD', 'FloodBlocker schützt Elxis Sites vor Flood Attacken.');

?>
