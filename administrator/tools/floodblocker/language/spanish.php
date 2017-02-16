<?php 
/**
* @ Version: 2008.0
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Elxis Team
* @ Translator: Ricard Lozano
* @ Translator URL: http://www.rlozano.com
* @ Description: Spanish language for FloodBlocker tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


DEFINE ('_FLOODL_CONFIG', 'Configuración de FloodBlocker');
DEFINE ('_FLOODL_CONFPERMSUCC', 'Los permisos del archivo de configuración de FloodBlocker se han establecido correctamente en');
DEFINE ('_FLOODL_CONFPERMNO', 'No se han podido establecer permisos de escritura en el archivo de configuración de FloodBlocker');
DEFINE ('_FLOODL_LOGSPERMSUCC', 'Los permisos de la carpeta de logs de FloodBlocker se han establecido correctamente en');
DEFINE ('_FLOODL_LOGSPERMNO', 'No se han podido establecer permisos de escritura en la carpeta de logs de FloodBlocker');
DEFINE ('_FLOODL_INVINTER', '¡Intervalo Cron no válido!');
DEFINE ('_FLOODL_INVTIME', '¡Tiempo de espera de logs no válido!');
DEFINE ('_FLOODL_ONEPAIR', 'Debe especificar al menos un par intervalo-límite que sea válido.');
DEFINE ('_FLOODL_CONFSAVESUCC', 'Configuración de FloodBlocker guardada correctamente.');
DEFINE ('_FLOODL_CONFSAVENO', 'No se ha podido guardar el archivo de configuración de FloodBlocker.');
DEFINE ('_FLOODL_ENABLEDESC', 'Activa o no el desbordamiento (antes de activarlo, asegúrese de que la carpeta /tools/floodblocker/logs tiene permisos de escritura)');
DEFINE ('_FLOODL_CRONINT', 'Intervalo Cron');
DEFINE ('_FLOODL_CRONINTDESC', 'Intervalo de ejecución Cron en segundos. Valor predeterminado: 1800 segundos (30 min)');
DEFINE ('_FLOODL_LOGSTIME', 'Tiempo de espera de logs');
DEFINE ('_FLOODL_LOGSTIMEDESC', 'Segundos que deben transcurrir para considerar antiguo un log. De manera predeterminada, los archivos se considerarán antiguos después de 7200 segundos (2 horas)');
DEFINE ('_FLOODL_FLOODRULES', 'Reglas de FloodBlocker');
DEFINE ('_FLOODL_INTSECS', 'Intervalo (segundos)');
DEFINE ('_FLOODL_LIMREQS', 'Límite (solicitudes)');
DEFINE ('_FLOODL_FLOODCONFIS', 'El archivo de configuración de FloodBlocker es');
DEFINE ('_FLOODL_FLOODLOGSIS', 'La carpeta de logs de FloodBlocker es');
DEFINE ('_FLOODL_MAKEWRITE', 'Establecer permisos de escritura');
DEFINE ('_FLOODL_PAIRSDESC', 'Serie asociativa de la forma {INTERVAL}=>{LIMIT}, 
donde {LIMIT} es el número de solicitudes posibles durante {INTERVAL} segundos. 
Puede usar tantos pares como desee. Ejemplos de reglas:<br />
&nbsp;&nbsp; - regla 1: 10=>10 (máx. 10 solicitudes en 10 segundos)<br />
&nbsp;&nbsp; - regla 2: 60=>30 (máx. 30 solicitudes en 60 segundos)<br />
&nbsp;&nbsp; - regla 3: 300=>50 (máx. 50 solicitudes en 300 segundos)<br />
&nbsp;&nbsp; - regla 4: 3600=>200 (máx. 200 solicitudes en 1 hora)<br /><br />
Se pueden definir 6 reglas como máximo.');
DEFINE ('CX_LFLOODBD', 'FloodBlocker evita los ataques por desbordamiento en su sitio web de Elxis.');

?>
