<?php 
/**
* @ Version: 2008.0
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Elxis Team
* @ Translator: Ricard Lozano
* @ Translator URL: http://www.rlozano.com
* @ Description: Spanish language for Chmod tool
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


define('_CMOD_CHMOD', 'Change Mode');
define('_CMOD_PATH', 'Ruta');
define('_CMOD_MSGSERVER', 'Mensaje del servidor');
define('_CMOD_PATHNOTEXIST', '¡La ruta no existe!');
define('_CMOD_PATHNOTELXIS', 'La ruta especificada no pertenece a Elxis.');
define('_CMOD_NOTALLOWED1', 'No está autorizado a aplicar CHMOD a');
define('_CMOD_NOTALLOWED2FI', 'a un archivo.<br>Habrá problemas para acceder al archivo.');
define('_CMOD_NOTALLOWED2FO', 'a una carpeta.<br>Habrá problemas para acceder a la carpeta.');
define('_CMOD_CHMODSUCC', 'CHMOD aplicado correctamente a');
define('_CMOD_CHMODCNOT', 'No se ha podido aplicar CHMOD a');
define('_CMOD_ONLYUNIX', 'Sólo disponible para UNIX');
define('_CMOD_LOAD', 'Cargar');
define('_CMOD_CHMODTO', 'Aplicar CHMOD a');
define('_CMOD_OWNER', 'Propietario');
define('_CMOD_READ', 'Lectura');
define('_CMOD_WRITE', 'Escritura');
define('_CMOD_EXECUTE', 'Ejecución');
define('_CMOD_USER', 'Usuario');
define('_CMOD_GROUP', 'Grupo');
define('_CMOD_WORLD', 'Resto');
define('_CMOD_SHOWHELP', 'Mostrar ayuda');
define('_CMOD_HIDEHELP', 'Ocultar ayuda');
define('_CMOD_HELPTEXT', 'Especifique la ruta completa de un archivo o carpeta de Elxis. Haga clic en Cargar si desea ver los permisos y el propietario existentes de la ruta especificada. Haga clic en el botón CHMOD para cambiar los permisos de la ruta especificada. Función sólo disponible en los sistemas UNIX.
	<br><br>Se recomienda usar los siguientes permisos:<br>
	carpetas modificables: 0777, carpetas no modificables: 0755, archivos modificables: 0666, archivos no modificables: 0644');

?>
