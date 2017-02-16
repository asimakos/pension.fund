<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ricard Lozano
* @link: http://www.rlozano.com
* @description: Spanish language for component bridge
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_BRI_SYSDISABLED = 'El sistema de bridges está desactivado';
public $A_CMP_BRI_INVBRIDGE = 'Bridge no válido';
public $A_CMP_BRI_BRISUCPUB = 'Bridge publicado correctamente';
public $A_CMP_BRI_BRISUCUNPUB = 'Bridge despublicado correctamente';
public $A_CMP_BRI_CNOTPUBBRI = 'No se ha podido publicar el bridge';
public $A_CMP_BRI_CNOTUNPUBRI = 'No se ha podido despublicar el bridge';
public $A_CMP_BRI_CNOTSAVESETS = 'No se han podido guardar los parámetros';
public $A_CMP_BRI_UNPUBBRIFIRST = 'Despublique primero el bridge';
public $A_CMP_BRI_BRIUNISTSUC = 'Bridge desinstalado correctamente';
public $A_CMP_BRI_CNOTUNISTBRI = 'No se ha podido desinstalar el bridge.  Compruebe los permisos de la carpeta de bridges';
public $A_CMP_BRI_CNOTDETREGV = 'No se ha podido determinar la versión actual del registro';
public $A_CMP_BRI_CNOTUPDREG = 'No se ha podido actualizar el registro';
public $A_CMP_BRI_REGSUCUPTO = 'Registro actualizado correctamente con la versión';
public $A_CMP_BRI_REGINIUNWR = '¡El archivo registry.ini no tiene permisos de escritura!';
public $A_CMP_BRI_REGUPTODATE = '¡El registro ya está actualizado!';
public $A_CMP_BRI_BRIUNPUB = '¡El bridge no está publicado!';
public $A_CMP_BRI_CNOTLOCXML = 'No se encuentra el archivo XML del bridge';
public $A_CMP_BRI_BNOTHAVECFI = '¡El bridge %s no tiene archivo de configuración!';
public $A_CMP_BRI_BNOTHAVECPA = '¡El bridge %s no tiene parámetros de configuración!';
public $A_CMP_BRI_DETINVPARAMS = 'Se han detectado parámetros incorrectos';
public $A_CMP_BRI_INSTBRI = 'Bridges instalados';
public $A_CMP_BRI_SYSENABLED = 'El sistema de bridges está activado';
public $A_CMP_BRI_REGVERSION = 'Versión del registro';
public $A_CMP_BRI_DETREGERRUP = 'Se ha detectado un error del registro Actualice el registro de bridges';
public $A_CMP_BRI_UPDATE = 'Actualizar';
public $A_CMP_BRI_REGERR = 'Error del registro';
public $A_CMP_BRI_LICENSE = 'Licencia';
public $A_CMP_BRI_UNIST = 'Desinstalar';
public $A_CMP_BRI_DISBRISYS = 'Desactivar sistema de bridges';
public $A_CMP_BRI_ENBRISYS = 'Activar sistema de bridges';
public $A_CMP_BRI_REGMOD = 'Módulo de registro';
public $A_CMP_BRI_REGMODHELP = 'Seleccione la aplicación que desee utilizar como principal sistema de registro o de inicio de sesión de los usuarios.';
public $A_CMP_BRI_REGMODHELP2 = 'Puede elegir entre Elxis y los bridges publicados.';
public $A_CMP_BRI_REGMODHELP3 = 'Algunos bridges carecen de un procedimiento de registro o inicio de sesión de los usuarios.';
public $A_CMP_BRI_REGMODHELP4 = 'No olvide utilizar el módulo de inicio de sesión del bridge en lugar del módulo habitual de Elxis. ';
public $A_CMP_BRI_NOTE = 'Nota';

}

?>
