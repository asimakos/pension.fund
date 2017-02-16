<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ricard Lozano
* @link: http://www.rlozano.com
* @description: Spanish language for component database
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_DB_TABNM = 'Nombre de la tabla';
public $A_CMP_DB_ACTIONS = 'Acciones';
public $A_CMP_DB_TDESCR = 'Descripción de la tabla ';
public $A_CMP_DB_BROWSE = 'Examinar';
public $A_CMP_DB_STRUCTURE = 'Estructura';
public $A_CMP_DB_INFO = 'Información';
public $A_CMP_DB_DUMPDB = 'Volcar base de datos';
public $A_CMP_DB_XDUMPDB = 'Volcar base de datos XML/SQL';
public $A_CMP_DB_BACTYPE = 'Tipo de copia de seguridad';
public $A_CMP_DB_XML = 'XML';
public $A_CMP_DB_SQL = 'SQL';
public $A_CMP_DB_XCRBACK = 'Crear copia de seguridad XML';
public $A_CMP_DB_XFULL = 'Estructura y datos';
public $A_CMP_DB_XSTRUONL = 'Sólo la estructura';
public $A_CMP_DB_XSAVSERV = 'Guardar en el servidor';
public $A_CMP_DB_DOWNLD = 'Descargar';
public $A_CMP_DB_XMLBACK = 'Copia de seguridad XML';
public $A_CMP_DB_SCRBACK = 'Crear copia de seguridad SQL';
public $A_CMP_DB_SFULL = 'Estructura y datos';
public $A_CMP_DB_SDATAONL = 'Sólo datos';
public $A_CMP_DB_SLOCTBL = 'Bloquear tabla';
public $A_CMP_DB_SFSYNTX = 'Sintaxis completa';
public $A_CMP_DB_SDRTBL = 'Eliminar tabla';
public $A_CMP_DB_STBLS = 'Tablas';
public $A_CMP_DB_ATBLS = 'Todas ';
public $A_CMP_DB_SELTBLS = 'Seleccionadas';
public $A_CMP_DB_SQLBACK = 'Copia de seguridad SQL';
public $A_CMP_DB_TDESC = 'Descripción de tabla';
public $A_CMP_DB_CLNAME = 'Nombre de columna';
public $A_CMP_DB_CLTYPE = 'Tipo de columna';
public $A_CMP_DB_ADOTYPE = 'Tipo de ADOdb';
public $A_CMP_DB_MAXLEN = 'Longitud máxima';
public $A_CMP_DB_BRTBL = 'Examinar tabla';
public $A_CMP_DB_BCKDB = 'Volver a la base de datos';
public $A_CMP_DB_DBTYPE = 'Tipo de base de datos';
public $A_CMP_DB_DBDESCR = 'Descripción de la base de datos';
public $A_CMP_DB_DBVER = 'Versión de la base de datos';
public $A_CMP_DB_DBHOST = 'Host de la base de datos';
public $A_CMP_DB_DBNAME = 'Nombre de la base de datos';
public $A_CMP_DB_DBUSER = 'Usuario';
public $A_CMP_DB_DBERRF = 'Raise Error FN';
public $A_CMP_DB_DBDBG = 'Depurar (Debug)';
public $A_CMP_DB_TBLSTR = 'Estructura de tabla';
public $A_CMP_DB_DBBACK = 'Copia de seguridad de la base de datos';
public $A_CMP_DB_NOEXISTS = 'No existen copias de seguridad';
public $A_CMP_DB_FOOTER= "<u>Nota</u>: Right-click a filename and select 'Guardar destino como' to download. <strong>Atención</strong>: Los archivos tienen codificación UTF-8.";
public $A_CMP_DB_DBMONIT = 'Monitor de la base de datos';
public $A_CMP_DB_TBLNOT = '¡La tabla no existe!';
public $A_CMP_DB_BACKSUCC = 'La base de datos se ha creado correctamente';
public $A_CMP_DB_NOTSUPPO = 'No es posible el volcado de SQL para';
public $A_CMP_DB_NOTBLSEL = '¡No se ha seleccionado ninguna tabla!';
public $A_CMP_DB_NOTDWNL = 'No se ha podido crear/descargar el volcado de SQL';
public $A_CMP_DB_NOTCRSV = 'No se ha podido crear/guardar el volcado de SQL';
public $A_CMP_DB_DUMPSUCC = 'El volcado de SQL se ha creado correctamente';
public $A_CMP_DB_DTUNKN = 'Desconocido'; // Translate as: Unknown Date
public $A_CMP_DB_TXMLSCHEM = 'Esquema de XML';
public $A_CMP_DB_TSQL = 'SQL';
public $A_CMP_DB_TUNKN = 'Desconocido'; // Translate as: Unknown Type
public $A_CMP_DB_UNKOWN = 'Desconocido'; // Translate as: Unknown Size
public $A_CMP_DB_NOFSELDEL = '¡No ha seleccionado ningún archivo para eliminarlo!';
public $A_CMP_DB_FSDELETED = 'archivos eliminados correctamente';
public $A_CMP_DB_FDELETED = 'Archivos eliminados correctamente';
public $A_CMP_DB_TLMANBACK = 'Administrar copias de seguridad';
public $A_CMP_DB_TLDELSLBCK = 'Eliminar copias de seguridad seleccionadas';
public $A_CMP_DB_TLNEWFXML = 'Nueva copia de seguridad XML completa';
public $A_CMP_DB_TLNEWFSQL = 'Nueva copia de seguridad SQL completa';
public $A_CMP_DB_MAINTEN = 'Mantenimiento';
public $A_CMP_DB_MAINTEND = 'Mantenimiento de la base de datos';
public $A_CMP_DB_OPTIM = 'Optimizar';
public $A_CMP_DB_REPAIR = 'Reparar';
public $A_CMP_DB_TBLOPTED = 'tablas optimizadas';
public $A_CMP_DB_FRUOPTINCP = 'Si se usa la opción <strong>Optimizar</strong> con frecuencia, aumenta el rendimiento de la base de datos.';
public $A_CMP_DB_RRERRDBTAB = 'La opción <strong>Reparar</strong> repara todos los errores que tenga la base de datos.';
public $A_CMP_DB_FAVMYSQL = 'Esta función sólo está disponible para las bases de datos MySQL.';
public $A_CMP_DB_TBLREPED = 'tablas reparadas';
public $A_CMP_DB_SIZE = 'Tamaño';

}

?>
