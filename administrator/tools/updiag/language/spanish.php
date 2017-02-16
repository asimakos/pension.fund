<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Elxis Team
* @translator: Ricard Lozano
* @translator URL: http://www.rlozano.com
* @description: Spanish language for Updiag tool
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class updiagLang {

	public $UPDATE = 'Actualizar';
	public $CHVERS = 'Comprobar versión';
	public $CNOTGETELXD = 'No se han podido obtener los datos de Elxis.org.';
	public $INVXML = 'El archivo XML recuperado no es válido. No se ha podido mostrar la información solicitada.';
	public $SIZE = 'Tamaño';
	public $MORE = 'Más';
	public $DOWNLOAD = 'Descargar';
	public $INSELXVER = 'Versión de Elxis instalada';
	public $CURRENT = 'Actual';
	public $OUTDATED = '¡Obsoleta!';
	public $NEWVERAV = 'Hay disponible una versión de Elxis más actual. Actualice su instalación de Elxis lo antes posible.';
	public $CHPATCHES = 'Comprobar parches';
	public $NOPATCHES = 'No hay parches disponibles para su versión de Elxis.';
	public $PROSUPPORT = 'Asistencia técnica profesional';
	public $NEWS = 'Noticias';
	public $MAINTENANCE = 'Mantenimiento';
	public $REMOTEERR1 = 'Solicitud no válida';
	public $REMOTEERR2 = 'Error al obtener la lista de scripts';
	public $REMOTEERR3 = 'No se ha encontrado ningún script';
	public $REMOTEERR4 = 'El archivo solicitado está vacío';
	public $REMOTEERR5 = 'Error al obtener la lista de archivos hash';
	public $REMOTEERR6 = 'No se ha encontrado ningún archivo hash';
	public $REMOTEERR7 = 'No se ha podido descargar el archivo solicitado.';
	public $UNERROR = 'Error desconocido';
	public $PROVCODE = 'Proporciona el código para actualizar Elxis de la versión';
	public $TOVERSION = 'a la versión';
	public $INSTALLED = 'Instalada';
	public $REQFEXISTS = 'El archivo solicitado ya existe.';
	public $FILDOWNSUC = 'Archivo descargado correctamente.';
	public $DFORRUNSCR = 'No olvide ejecutar este script si desea actualizar su instalación de Elxis.';
	public $CNOTCPDFIL = 'No se ha podido copiar en la carpeta de destino el archivo descargado. ';
	public $PLCHSCRPERM = 'Compruebe los permisos de la carpeta /administrator/tools/updiag/data/scripts.';
	public $PLCHSCRPERM2 = 'Compruebe los permisos de la carpeta /administrator/tools/updiag/data/hashes.';
	public $EXECUTE = 'Ejecutar';
	public $SCRNOTEX = 'El script solicitado no existe.';
	public $FSCHECK = 'Comprobar sistema de archivos';
	public $HIDEHELP = 'Ocultar ayuda';
	public $NORMAL = 'Normal';
	public $EXTENDED = 'Avanzado';
	public $FULL = 'Completo';
	public $NOHASHFOUND = 'No se ha encontrado ningún archivo hash';
	public $INVHFILE = 'Archivo hash no válido.';
	public $SHFELXVER = 'El archivo hash seleccionado es de una versión de Elxis más antigua que la suya.';
	public $FNOTEXIST = 'No existe el archivo';
	public $WARNING = 'Advertencia';
	public $FNEEDUP = 'Debe actualizar el archivo';
	public $SITUP2D = 'El sitio está actualizado.';
	public $FOUND = 'Se han encontrado';
	public $OUTFUP = 'archivos obsoletos. Debe actualizarlos.';
	public $CHFINUS = 'Comprobando el estado de actualización del sitio usando <b>%s</b> como fuente';
	public $NEWRELEASES = 'Nuevas versiones';
	public $NONEWREL = 'No hay nuevas versiones';
	public $PRICE = 'Precio';
	public $LICENSE = 'Licencia';
	public $SECURITY = 'Seguridad';
	public $INSTPATH = 'Ruta de instalación';
	public $CREDITS = 'Créditos';
	public $ALERT = 'Alerta';
	public $FSECALWA = 'Se han encontrado <b>%d</b> alertas y advertencias de seguridad';
	public $ELXINPAS = 'Esta instalación de Elxis ha superado correctamente las pruebas básicas de seguridad';
	public $HOME = 'Inicio';
	public $UPDSPAG = 'Centro de Updiag';
	public $UPDWELC = 'Bienvenido a <b>Updiag</b>, la herramienta de actualización y diagnósticos de Elxis.';
	public $STARTMORE = 'La mayoría de las funciones de Updiag requieren conectarse de forma remota con el sitio web elxis.org. Por tanto, para que funcionen hay que tener conexión a Internet. Seleccione una opción del menú superior para navegar.';
	public $BASCHECKS = 'Comprobaciones básicas<small>(haga clic en un icono para ejecutarlo)</small>';
	public $FILEREMSUC = 'Archivo eliminado correctamente.';
	public $CNREMSFILE = 'No se ha podido eliminar el archivo seleccionado. Compruebe los permisos del archivo.';
	public $HASHNOTEX = '¡No existe el archivo hash solicitado!';
	public $DNHASHFLS = 'Descargar archivos hash';
	public $BUY = 'Comprar';
	public $DOWNLTIME = 'Tiempo de descarga';
	public $DOWNLSPEED = 'Velocidad de descarga';


	public function __construct() {
	}

}

define('CX_LUPDIAGD', 'Ayuda a actualizar su sitio web, notifica las nuevas versiones o parches de Elxis y realiza tareas de seguridad y de diagnóstico.');

?>