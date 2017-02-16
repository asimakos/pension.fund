<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ricard Lozano
* @link: http://www.rlozano.com
* @description: Spanish language for component installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_INS_SDIR = 'Seleccione una carpeta';
public $A_CMP_INS_UPF = 'Subir paquete';
public $A_CMP_INS_PF = 'Archivo del paquete';
public $A_CMP_INS_UFI = "Subir archivo e instalar";
public $A_CMP_INS_FDIR = 'Instalar desde una carpeta';
public $A_CMP_INS_IDIR = 'Carpeta de instalación';
public $A_CMP_INS_DOIN = 'Instalar';
public $A_CMP_INS_CONT = 'Continuar...';
public $A_CMP_INS_NF = 'No se encuentra el instalador del elemento ';
public $A_CMP_INS_NA = 'Instalador no disponible para el elemento';
public $A_CMP_INS_EFU = 'El instalador no puede continuar si no se activa la carga de archivos Use el método \'Instalar desde una carpeta\'.';
public $A_CMP_INS_ERTL = 'Error del instalador';
public $A_CMP_INS_ERZL = 'El instalador no puede continuar hasta que se instale ZLIB.';
public $A_CMP_INS_ERNF = 'No se ha seleccionado ningún archivo';
public $A_CMP_INS_ERUM = 'Error al subir un nuevo módulo';
public $A_CMP_INS_UPTL = 'Subir ';
public $A_CMP_INS_UPE1 = ' - Error al subir';
public $A_CMP_INS_UPE2 = ' - Error al subir';
public $A_CMP_INS_SUCC = 'Correcto';
public $A_CMP_INS_ER = 'Error';
public $A_CMP_INS_ERFL = 'Error';
public $A_CMP_INS_UPNW = 'Subir nuevo ';
public $A_CMP_INS_FP = 'No se han podido cambiar los permisos del archivo subido.';
public $A_CMP_INS_FM = 'Error al mover el archivo subido a la carpeta  <code>/media</code> ';
public $A_CMP_INS_FW = 'Error al subir el archivo debido a que la carpeta <code>/media</code> no tiene permisos de escritura.';
public $A_CMP_INS_FE = 'Error al subir el archivo debido a que la carpeta <code>/media</code> no existe.';
public $A_CMP_INST_ERUNR = 'Error irrecuperable';
public $A_CMP_INST_EREXT = 'Error de extracción';
public $A_CMP_INST_ERMXM = '<strong>ERROR:</strong> No se encuentra el archivo de instalación XML de Elxis en el paquete';
public $A_CMP_INST_ERXML = '<strong>ERROR:</strong> No se encuentra el archivo de instalación XML en el paquete';
public $A_CMP_INST_ERNFN = 'No se ha especificado el nombre del archivo';
public $A_CMP_INST_ERVLD = 'no es un archivo de instalación válido de Elxis';
public $A_CMP_INST_ERINC = 'No se puede llamar al método de instalación por su clase';
public $A_CMP_INST_ERUIC = 'No se puede llamar al método de desinstalación por su clase';
public $A_CMP_INST_ERIFN = 'No se encuentra el archivo de instalación';
public $A_CMP_INST_ERSXM = 'El archivo de instalación XML no corresponde a un';
public $A_CMP_INST_ERCDR = 'Error al crear la carpeta';
public $A_CMP_INST_FNOTE = 'no existe';
public $A_CMP_INST_TAFC = 'Ya existe un archivo denominado';
public $A_CMP_INST_AYIT = '- ¿Está intentando instalar dos veces el mismo componente?';
public $A_CMP_INST_FCPF = 'Error al copiar el archivo';
public $A_CMP_INST_CPTO = 'en';
public $A_CMP_INST_UNINSTALL = 'Desinstalar';
public $A_CMP_INST_CUDIR = 'Ya existe otro componente que está utilizando la carpeta';
public $A_CMP_INST_SQLER = 'Error SQL';
public $A_CMP_INST_CCPHP = 'No se ha podido copiar el archivo PHP instalación.';
public $A_CMP_INST_CCUNPHP = 'No se ha podido copiar el archivo PHP de desinstalación.';
public $A_CMP_INST_UNERR = 'Error al desinstalar';
public $A_CMP_INST_THCOM = 'Componente';
public $A_CMP_INST_ISCOR = 'es un componente básico de la aplicación y no se puede desinstalar.<br />Si no desea utilizarlo, basta con que no lo publique.';
public $A_CMP_INST_XMLINV = 'Archivo XML no válido';
public $A_CMP_INST_OFEMP = 'Campo de opción vacío; no se pueden eliminar los archivos';
public $A_CMP_INST_INCOM = 'Componentes instalados';
public $A_CMP_INST_CURRE = 'Instalados actualmente';
public $A_CMP_INST_MENL = 'Enlace de menú del componente';
public $A_CMP_INST_AUURL = 'Web del autor';
public $A_CMP_INST_NCOMP = 'No hay componentes adicionales instalados';
public $A_CMP_INST_INSCO = 'Instalar nuevo componente';
public $A_CMP_INST_DELE = 'Eliminando';
public $A_CMP_INST_LIDE = 'ID de idioma vacío; no se pueden eliminar los archivos';
public $A_CMP_INST_ALL = 'todos';
public $A_CMP_INST_BKLM = 'Volver al administrador de idiomas';
public $A_CMP_INST_NWLA = 'Instalar nuevo idioma';
public $A_CMP_INST_NFMM = 'No existe ningún archivo marcado como archivo de bot';
public $A_CMP_INST_MAMB = 'bot';
public $A_CMP_INST_AXST = 'ya existe';
public $A_CMP_INST_IOID = 'ID de objeto no válido';
public $A_CMP_INST_FFEM = 'Campo de carpeta vacío; no se pueden eliminar los archivos';
public $A_CMP_INST_DXML = 'Eliminando archivo XML';
public $A_CMP_INST_ICMO = 'es un elemento básico de la aplicación y no se puede desinstalar.<br />Si no desea utilizarlo, basta con que no lo publique. ';
public $A_CMP_INST_IMBT = 'Bots instalados';
public $A_CMP_INST_OMBT = 'Sólo aparecen los bots que se pueden desinstalar. Algunos bots básicos de la aplicación no se pueden eliminar.';
public $A_CMP_INST_MBT = 'Bot';
public $A_CMP_INST_MTYP = 'Tipo';
public $A_CMP_INST_NMBT = 'No hay ningún bot adicional instalado aparte de los bots básicos de la aplicación.';
public $A_CMP_INST_INMT = 'Instalar nuevos bots';
public $A_CMP_INST_UCTP = 'Tipo de cliente desconocido';
public $A_CMP_INST_NFMD = 'No existe ningún archivo marcado como archivo de módulo';
public $A_CMP_INST_MODULE = 'El módulo';
public $A_CMP_INST_ICMDL = 'es un módulo básico de la aplicación y no se puede desinstalar.<br />Si no desea utilizarlo, basta con que no lo publique. ';
public $A_CMP_INST_IMDL = 'Módulos instalados';
public $A_CMP_INST_OMDL = 'Sólo aparecen los módulos que se pueden desinstalar. Algunos módulos básicos de la aplicación no se pueden eliminar';
public $A_CMP_INST_MDLF = 'Archivo de módulo';
public $A_CMP_INST_NMDL = 'No existen módulos adicionales instalados';
public $A_CMP_INST_NWMDL = 'Instalar nuevos módulos';
public $A_CMP_INST_ALLC = 'Todos';
public $A_CMP_INST_STMDL = 'Módulos del sitio';
public $A_CMP_INST_ADMDL = 'Módulos de la administración';
public $A_CMP_INST_DDEX = 'La carpeta no existe; no se pueden eliminar los archivos';
public $A_CMP_INST_TIDE = 'ID de plantilla vacío; no se pueden eliminar los archivos';
public $A_CMP_INST_TINS = 'Instalar nueva plantilla';
public $A_CMP_INST_BATP = 'Volver a Plantillas';
public $A_CMP_INST_INSBR = 'Instalar nuevo bridge';
public $A_CMP_INST_BABR = 'Volver a Bridges';
public $A_CMP_INST_BIDE = 'ID de bridge vacío; no se pueden eliminar los archivos';
public $A_INST_INCOM = 'Se ha detectado una posible incompatibilidad entre la versión de Elxis y la extensión utilizada. Aun así, es posible que el software funcione sin errores. Este mensaje es meramente informativo.';
public $A_INST_INCOMJOO = '¡El paquete de instalación es para Joomla CMS!';
public $A_INST_INCOMMAM = '¡El paquete de instalación es para Mambo CMS!';
public $A_INST_OLDER = 'El paquete de instalación es para una versión anterior de Elxis (%s). La suya es más actual (%s).';
public $A_INST_NEWER = 'El paquete de instalación es para una versión posterior de Elxis (%s). La suya es más antigua (%s).';
//2009.0
public $A_INST_DOINEDC = 'Transfiera e instale de centro de las transferencias directas de Elxis';
public $A_INST_FETCHAVEXTS = 'Lista del alcance de extensiones disponibles';
public $A_INST_MORE = 'Más';
public $A_INST_LESS = 'Menos';
public $A_INST_SIZE = 'Tamaño';
public $A_INST_DOWNLOAD = 'Transferencia directa';
public $A_INST_DOWNLOADS = 'Transferencias directas';
public $A_INST_DOWNINST = 'Transfiera e instale';
public $A_INST_LICENSE = 'Licencia';
public $A_INST_COMPAT = 'Compatibilidad';
public $A_INST_DATESUB = 'Fecha sometida';
public $A_INST_SUREINST = '¿Está usted seguro usted deseo para instalar %s ?'; //translators help: filled in be extension title
//2009.2
public $A_INST_UPTODATE = 'Estar al día';
public $A_INST_OUTDATED = 'Anticuado';
public $A_INST_INSTVERS = 'Versión instalada';
public $A_INST_UNLOAD = 'Descargar';
public $A_INST_EDCUPDESC = 'List of the installed third party extensions and their update status.<br />
	The information is taken live from the <a href="http://www.elxis-downloads.com/" title="EDC" target="_blank">Elxis Downloads Center</a>.<br />
	In order for the versioning check to be successuful your web site must be able to connect to the <strong>EDC</strong> remote center.';
public $A_INST_EDCUPNOR = "Comprobación de versión no devolvió nada.<br />
	Lo más probable es que no tienen ningún tercero %s instalado.";

}

?>