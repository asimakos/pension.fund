<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ricard Lozano
* @link: http://www.rlozano.com
* @description: Spanish language for component softdisk
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CORE = 'Núcleo';
public $A_ASTATS = 'Estadísticas de administración';
public $A_VALUE = 'Valor';
public $A_LASTMOD = 'Última modificación';
public $A_OS = 'Sistema operativo';
public $A_ELXIS_VERSION = 'Versión de Elxis';
public $A_SELECT = 'Seleccionar';
public $NOEDITSYS = 'No está autorizado a editar entradas del sistema.';
public $A_RESTORE = 'Restaurar';
public $SOFTDISK_HELP = 'SoftDisk es un área de almacenamiento virtual para variables y parámetros de todo tipo.<br />
  	Es posible agregar, editar o eliminar las entradas de SoftDisk, excepto aquellas de las que el sistema aparece como propietario. Las entradas marcadas como \"No eliminables\" sólo se pueden modificar. Los nombres de las secciones y los valores de SoftDisk sólo pueden estar formados por <strong>letras latinas en mayúscula, números y el guión bajo (_)</strong>.';
public $YCNOTEDITP = 'No puede editar el parámetro';
public $UNDELETABLE = 'No eliminable';
public $SOFTENTRYEXIST = 'Ya existe una entrada de SoftDisk con este nombre.';
public $INVSECTNAME = 'Nombre de sección no válido.';
public $INVNAME = 'Nombre no válido.';
public $INVEMAIL = '¡El valor especificado no es una dirección de correo electrónico válida!';
public $INVURL = '¡El valor especificado no es una URL válida!';
public $INVDEC = '¡El valor especificado no es un número decimal!';
public $INVTSTAMP = '¡El valor especificado no es una marca horaria válida de UNIX!';
public $UPSYSTEM = 'Actualizar sistema';
public $A_USERPROFILE = 'Perfil de usuario';
public $UPROF_WEBSITE = 'Web';
public $UPROF_AIM = 'AIM';
public $UPROF_YIM = 'YIM';
public $UPROF_MSN = 'MSN';
public $UPROF_ICQ = 'ICQ';
public $UPROF_EMAIL = 'Email ';
public $UPROF_PHONE = 'Teléfono';
public $UPROF_MOBILE = 'Móvil';
public $UPROF_BIRTHDATE = 'Fecha de nacimiento';
public $UPROF_GENDER = 'Sexo';
public $UPROF_LOCATION = 'Ciudad';
public $UPROF_OCCUPATION = 'Ocupación';
public $UPROF_SIGNATURE = 'Firma';
public $UPROF_ARTICLES = 'Número de artículos';
public $UPROF_USERGROUP = 'Grupo de usuarios';
public $UPROF_RANDUSERS = 'Mostrar usuarios al azar en la página del perfil';
public $USERS_RPASSMAIL = 'Notificar a los administradores cuando un usuario solicite recuperar la contraseña';
public $SUBMIT_CATEGORIES = 'Categorías a las que se permite enviar contenido (sugeridas). Si se deja en blanco, significa que se permite a todas. (Especifique los ID de las categorías separados por comas)';
public $SUBMIT_SECTIONS = 'Secciones a las que se permite enviar contenido (sugeridas).  Si de deja en blanco, significa que se permite a todas. (Especifique los ID de las secciones separados por comas) ';
public $REG_AGREE = 'ID de la página estática que contiene el acuerdo de registro. Especifique cero (0) para desactivarla. Si desea crear un acuerdo para un idioma específico, cree una entrada de SoftDisk en la sección USERS para cada idioma denominada REG_AGREE_LANGUAGE-HERE de tipo Integer';
public $A_WEBLINKS = 'Enlaces';
public $TOP_WEBLINK = 'Muestra o no el módulo Enlaces principales (Top Weblinks) dentro del componente Weblinks';
public $A_USERSLIST = 'Lista de usuarios';
public $ULIST_ONLINE = 'Estado online';
public $ULIST_USERNAME = 'Nombre de usuario';
public $ULIST_NAME = 'Nombre';
public $ULIST_REGDATE = 'Fecha de registro';
public $ULIST_PREFLANG = 'Idioma preferido';
//2009.0
public $STATICCACHE = 'Static cache';

}

?>