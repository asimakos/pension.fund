<?php 
/**
* @ Version: 2008.0
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Elxis Team
* @ Translator: Ricard Lozano
* @ Translator URL: http://www.rlozano.com
* @ Description: Spanish language for Defender tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


DEFINE ('_DEFL_CONFIG', 'Configuración de Elxis Defender');
DEFINE ('_DEFL_CONFPERMSUCC', 'Los permisos del archivo de configuración de Elxis Defender se han establecido correctamente en ');
DEFINE ('_DEFL_CONFPERMNO', 'No se han podido asignar permisos de escritura al archivo de configuración de Elxis Defender');
DEFINE ('_DEFL_LOGSPERMSUCC', 'Los permisos de la carpeta de logs de Elxis Defender se han establecido correctamente en ');
DEFINE ('_DEFL_LOGSPERMNO', 'No se han podido establecer permisos de escritura en la carpeta de logs de Elxis Defender');
DEFINE ('_DEFL_ENABLEDESC', 'Permite activar Elxis Defender (antes de activarlo, compruebe que la carpeta /administrator/tools/defender/logs tenga permisos de escritura).');
DEFINE ('_DEFL_PROTVARS', 'Variables protegidas');
DEFINE ('_DEFL_PROTVARSD', 'Seleccione los tipos de variables que desea proteger (valor predeterminado: REQUEST).');
DEFINE ('_DEFL_LOGATTACKS', 'Registrar ataques');
DEFINE ('_DEFL_LOGATTACKSD', 'Si está activada esta opción, Elxis Defender creará y registrará un informe de cada ataque.');
DEFINE ('_DEFL_MAILALERT', 'Alerta por email');
DEFINE ('_DEFL_MAILALERTD', 'Si está activada esta opción, Elxis Defender notificará los ataques por correo electrónico.');
DEFINE ('_DEFL_MAILADDR', 'Dirección de correo electrónico a la que se enviará la notificación');
DEFINE ('_DEFL_SITEOFFFOR', 'Sitio fuera de línea durante');
DEFINE ('_DEFL_SECONDS', 'segundos');
DEFINE ('_DEFL_SITEOFFD', 'Tras un ataque, desactiva el sitio durante X segundos. El valor 0 desactiva la opción.');
DEFINE ('_DEFL_BLOCKIP', 'Bloquear IP');
DEFINE ('_DEFL_BLOCKIPD', 'Bloquea la dirección IP del atacante. Tenga en cuenta que Elxis Defender bloqueará a cualquiera que considere un atacante, ¡incluido usted!');
DEFINE ('_DEFL_FILTERS', 'Filtros');
DEFINE ('_DEFL_FILTHELP', '<b>Elxis Defender carece de efectividad si no tiene filtros definidos.</b><br />
	Para agregar un nuevo filtro, escriba la palabra o frase que desee bloquear en el campo y haga clic en <b>Agregar</b>.<br />
	Los filtros no distinguen minúsculas de mayúsculas.<br />
	Para eliminar un filtro de la lista, presione <b>Del</b>.<br />
	Si ya conoce el <b>mod_Security</b> de Apache, sepa que Elxis Defender funciona más o menos de la misma manera cuando se agregan filtros.<br />
	Cuando haya acabado, haga clic en <b>Guardar</b> para guardar la configuración y los filtros de Elxis Defender.<br />');
DEFINE ('_DEFL_SLOWDOWNT', 'Lentitud del sistema');
DEFINE ('_DEFL_SLOWDOWN', 'Si utiliza Elxis Defender, es posible que el sitio vaya más lento de lo habitual. Agregar muchos filtros puede aumentar demasiado el tiempo de ejecución de PHP. Es recomendable no agregar más de 15 filtros, pero es mejor pruebe el sistema usted mismo, ya que todo depende del sitio web y del servidor en cuestión. Solicite ayuda a un experto si surgen problemas. Nuestras pruebas han revelado una ralentización de <b>entre 0,1 y 27 milisegundos</b>, según el número de filtros (entre 10 y 30) y de las variables de entrada que Elxis Defender tenía que interpretar (desde la navegación normal hasta el envío de extensos artículos vía POST o GET).');
DEFINE ('_DEFL_EXAMPLEFIL', 'Filtros de ejemplo');
DEFINE ('_DEFL_DEFCONFIS', 'El archivo de configuración de Elxis Defender es');
DEFINE ('_DEFL_DEFLOGSIS', 'La carpeta de logs de Elxis Defender es');
DEFINE ('_DEFL_MAKEWRITE', 'Establecer permisos de escritura');
DEFINE ('_DEFL_CONFSAVESUCC', 'La configuración de Elxis Defender se ha guardado correctamente.');
DEFINE ('_DEFL_CONFSAVENO', 'No se ha podido guardar la configuración de Elxis Defender.');
DEFINE ('_DEFL_ERRONEFILT', 'Error: Al menos debe especificar un filtro.');
DEFINE ('_DEFL_ENCKEY', 'Clave de cifrado');
DEFINE ('_DEFL_ENCKEYD', 'Se utiliza para cifrar la información de los archivos de registro (logs). La clave debe contener entre 8 y 32 caracteres. ¡Elimine toda la información de los registros antes de cambiar la clave de cifrado!');
DEFINE ('_DEFL_ERRENCKEY', 'Error: La clave de cifrado debe contener entre 8 y 32 caracteres ');
DEFINE ('_DEFL_ENABLEDEF', 'Activar Defender');
DEFINE ('_DEFL_DISABLEDEF', 'Desactivar Defender');
DEFINE ('_DEFL_VIEWLOGS', 'Ver logs');
DEFINE ('_DEFL_CLEARLOGS', 'Borrar logs');
DEFINE ('_DEFL_VIEWBLOCK', 'IP bloqueadas');
DEFINE ('_DEFL_CLEARBLOCK', 'Borrar IPs bloq.');
DEFINE ('_DEFL_DEFENDER', 'Elxis Defender');
DEFINE ('_DEFL_LOGSCLEARED', 'Logs borrados');
DEFINE ('_DEFL_CNOTCLLOGS', 'Error al borrar los logs. Asegúrese de que el archivo tiene asignados permisos de escritura.');
DEFINE ('_DEFL_BLOCKCLEARED', 'Se han eliminado correctamente todas las direcciones IP bloqueadas.');
DEFINE ('_DEFL_CNOTCLBLOCK', 'No se han podido eliminar las direcciones IP bloqueadas Asegúrese de que el archivo tiene asignados permisos de escritura.');
DEFINE ('_DEFL_SUBMITALERT', 'Si se envían filtros mientras Elxis Defender está activado, ¡se interpretará como un ataque! Así que primero desactive Elxis Defender, realice los cambios que necesite y luego vuelva a activarlo.');
DEFINE ('_DEFL_GEOLOCATE', 'Localización geográfica');
DEFINE ('_DEFL_PERMSUCC', 'Permisos cambiados por ');
DEFINE ('_DEFL_PERMFAIL', 'No se han podido cambiar los permisos de');
DEFINE ('_DEFL_ADDIP', 'Agregar IP');
DEFINE ('_DEFL_DELETEIP', 'Eliminar IP');
DEFINE ('_DEFL_BLOCKEDIPS', 'IP bloqueadas');
DEFINE ('_DEFL_IPRANGES', 'Rangos de IP');
DEFINE ('_DEFL_ADDRANGE', 'Agregar rango de IP');
DEFINE ('_DEFL_DELRANGE', 'Eliminar rango de IP');
DEFINE ('_DEFL_RANGEHELP', 'Para bloquear una red entera, un proveedor de Internet o incluso un país, Elxis Defender le ofrece la posibilidad de agregar rangos de IP. Cada rango consta de dos partes, separadas por un guión bajo (_). La primera parte corresponde a la IP inicial y la segunda, la IP final. Elxis Defender bloqueará todas las IP que estén contenidas entre estos dos valores.');
DEFINE ('_DEFL_RANGEEXAMPLES', 'Ejemplos prácticos');
DEFINE ('_DEFL_BLOCKFROM', 'bloquedará las IP desde');
DEFINE ('_DEFL_BLOCKTO', 'hasta');
DEFINE ('_DEFL_ALLOWIPS', 'IP permitidas');
DEFINE ('_DEFL_ALLOWIPSD', 'Esta opción permite definir las direcciones IP que pueden acceder a la administración o al sitio web.');
DEFINE ('_DEFL_FRONTBACK', 'Web y Administración');
DEFINE ('_DEFL_ALLOWDIS', 'La opción \'Direcciones IP permitidas\' está desactivada');
DEFINE ('_DEFL_ONLACCADM', 'Sólo las direcciones IP siguientes tienen acceso a la administración');
DEFINE ('_DEFL_ONLACCSAD', 'Sólo las direcciones IP siguientes tienen acceso tanto al sitio web como a la administración');

?>
