<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Elxis Team
* @translator: Duilio Lupini (Speck)
* @link: http://www.elxisitalia.com
* @email: info@elxisitalia.com
* @description: Italian language for FloodBlocker tool
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Accesso Limitato' );


define('_FLOODL_CONFIG', 'Configurazione FloodBlocker');
define('_FLOODL_CONFPERMSUCC', 'Permessi file della configurazione FoodBlocker settati con successo a:');
define('_FLOODL_CONFPERMNO', 'Non puoi rendere scrivibile il file di configurazione di FloodBlocker');
define('_FLOODL_LOGSPERMSUCC', 'Permessi della cartella dei rapporti di FloodBlocker settati con successo a');
define('_FLOODL_LOGSPERMNO', 'Non puoi rendere scrivibile la cartella dei rapporti di FloodBlocker');
define('_FLOODL_INVINTER', 'Intervallo Cron non valido!');
define('_FLOODL_INVTIME', 'Timeout Rapporti non valido!');
define('_FLOODL_ONEPAIR', 'Devi dare almeno una coppia di intervallo limite!');
define('_FLOODL_CONFSAVESUCC', 'File di configurazione FloodBlocker salvato con successo!');
define('_FLOODL_CONFSAVENO', 'Non posso salvare il file di configurazione di FloodBlocker!');
define('_FLOODL_ENABLEDESC', 'Abilita \'Protezione FloodBlocker\' o no (assicurati che la cartella /tools/floodblocker/logs sia scrivibile prima di abilitare la protezione');
define('_FLOODL_CRONINT', 'Intervallo Cron');
define('_FLOODL_CRONINTDESC', 'Esecuzione Cron in secondi. Di default 1800 secs (30 mins)');
define('_FLOODL_LOGSTIME', 'Timeout Rapporti');
define('_FLOODL_LOGSTIMEDESC', 'Dopo quanti secondi il file di rapporto è da considerare vecchio? Di default i file saranno considerati vecchi dopo 7200 secs (2 ore)');
define('_FLOODL_FLOODRULES', 'Ruoli FloodBlocker');
define('_FLOODL_INTSECS', 'Intervallo (secondi)');
define('_FLOODL_LIMREQS', 'Limite (richieste)');
define('_FLOODL_FLOODCONFIS', 'Il file di configurazione di FloodBlocker è');
define('_FLOODL_FLOODLOGSIS', 'La cartella dei rapporti di FloodBlocker è');
define('_FLOODL_MAKEWRITE', 'Rendi scrivibile');
define('_FLOODL_PAIRSDESC', 'Un array associativo di {INTERVAL} => {LIMIT} , 
	dove {LIMIT} è il numero di possibili richieste in un intervallo di tempo {INTERVAL} in secondi. 
	Usa più coppie come desideri. Ruoli indicativi:<br>
	&nbsp; &nbsp; - ruolo 1: 10=>10 (max 10 richieste in 10 secs)<br>
	&nbsp; &nbsp; - rule 2: 60=>30 (max 30 richieste in 60 secs)<br>
	&nbsp; &nbsp; - rule 3: 300=>50 (max 50 richieste in 300 secs)<br>
	&nbsp; &nbsp; - rule 4: 3600=>200 (max 200 richieste in 1 ora)<br><br>
	massimo 6 Ruoli');
define('CX_LFLOODBD', 'FloodBlocker previene attacchi flood nel vostro sito Elxis.');

?>