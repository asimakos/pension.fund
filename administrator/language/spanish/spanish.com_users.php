<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ricard Lozano
* @link: http://www.rlozano.com
* @description: Spanish language for component users
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_USS_LOGIN = 'Conectados';
public $A_CMP_USS_ALL = 'Todos';
public $A_CMP_USS_ID = 'UserID';
public $A_CMP_USS_LSTV = 'Última visita';
public $A_CMP_USS_ENBLD = 'Activados';
public $A_CMP_USS_BLCKD = 'Bloqueados';
public $A_CMP_USS_LVDATE = '%Y-%m-%d %H:%M:%S'; //Last visit Date
public $A_CMP_USS_PFISNOT = 'Seleccione otro grupo porque \'Public Frontend\' no es una opción seleccionable';
public $A_CMP_USS_PBISNOT = 'Seleccione otro grupo porque \'Public Backend\' no es una opción seleccionable';
public $A_CMP_USS_DETAILS = 'Detalles del usuario';
public $A_CMP_USS_EMAIL = 'Email';
public $A_CMP_USS_PASS = 'Nueva contraseña';
public $A_CMP_USS_VERIFY = 'Confirmar contraseña';
public $A_CMP_USS_BLOCK = 'Bloquear usuario';
public $A_CMP_USS_SUBMI = 'Recibir emails emitidos';
public $A_CMP_USS_REGDATE = 'Fecha de registro';
public $A_CMP_USS_VISDTE = 'Fecha de la última visita';
public $A_CMP_USS_CONTCT = 'Información de contacto';
public $A_CMP_USS_NDETL = 'No hay detalles de contacto enlazados con este usuario:<br />Vaya a Componentes -&gt; Contactos -&gt; Administrar contactos para obtener más información. ';
public $A_CMP_USS_SUCCH = 'Cambios del usuario guardados correctamente';
public $A_CMP_USS_SUCUSR = 'Usuario guardado correctamente';
public $A_CMP_USS_CANNOT = 'No puede eliminar un superadministrador';
public $A_CMP_USS_CANNYO = '¡No puede eliminarse a sí mismo!';
public $A_CMP_USS_CANNUS = 'No está autorizado a eliminar este usuario';
public $A_CMP_USS_SLUSER = 'Seleccione un usuario';
public $A_CMP_USS_FLGOUT = 'Forzar cierre de sesión';
public $A_CMP_USS_UMUST = 'Especifique un nombre de usuario.';
public $A_CMP_USS_ULOGIN = 'Su nombre de usuario contiene caracteres no válidos o es demasiado corto. ';
public $A_CMP_USS_MSTEMAIL = 'Especifique una dirección de email válida.';
public $A_CMP_USS_ASSIGN = 'Asigne el usuario a un grupo.';
public $A_CMP_USS_NOMATC = 'Las contraseñas no coinciden.';
public $A_CMP_USS_FLOGD = 'Filtrar conectados';
public $A_CMP_USS_FACST = 'Filtrar activos';
public $A_CMP_USS_PHONE = 'Teléfono';
public $A_CMP_USS_FAX = 'Fax';
public $A_CMP_USS_NOEXTRA = 'No se han configurado o publicado campos adicionales para el usuario';
public $A_CMP_USS_VERTICAL = 'Vertical';
public $A_CMP_USS_HORIZONT = 'Horizontal';
public $A_CMP_USS_CHECKED = 'comprobado';
public $A_CMP_USS_1OPTVLEAST = 'Debe especificar como mínimo una opción y seleccionar una opción que sea válida';
public $A_CMP_USS_1OPTLEAST = 'Debe especificar como mínimo una opción';
public $A_CMP_USS_EXTRASAVED = 'Campo adicional guardado correctamente';
public $A_CMP_USS_CHACONDET = 'Cambiar detalles de contacto';
public $A_CMP_USS_REQUIRED = 'Obligatorio';
public $A_CMP_USS_REGISTR = 'Registro';
public $A_CMP_USS_PROFILE = 'Perfil';
public $A_CMP_USS_RONLY = 'Sólo lectura';
public $A_CMP_USS_HIDDEN = 'Ocultos';
public $A_CMP_USS_SHOWREG = 'Mostrar en el registro';
public $A_CMP_USS_SHOWPROF = 'Mostrar en el perfil';
public $A_CMP_USS_OPTALIGN = 'Alineación';
public $A_CMP_USS_PREVNOTE = 'Nota: Guarde los cambios antes de visualizarlos.';
public $A_CMP_USS_OPTIONS = 'Opciones';
public $A_CMP_USS_OPTIONSFOR = 'Opciones para';
public $A_CMP_USS_MUSTFNAME = 'Especifique un nombre para el campo';
public $A_CMP_USS_MAXLENINV = 'El valor del campo Longitud máxima no es válido';
public $A_CMP_USS_HIDMUSTVAL = 'El campo oculto debe tener un valor';
public $A_CMP_USS_DEFVAL = 'Valor predeterminado';
public $A_CMP_USS_MAXLEN = 'Longitud máxima';
public $A_CMP_USS_REQFLDSNO = 'No se han rellenado uno o varios campos obligatorios ';
public $A_CMP_USS_HIDNOREQ = '¡Los campos ocultos no pueden ser obligatorios! ';
public $A_CMP_USS_HIDNOPROF = '¡Los campos ocultos no pueden mostrarse en el perfil!';
public $A_CMP_USS_PREFLANG = 'Idioma preferido';
public $A_CMP_USS_AVATAR = 'Avatar';
public $A_CMP_USS_WEBSITE = 'Web';
public $A_CMP_USS_AIM = 'AIM';
public $A_CMP_USS_YIM = 'YIM';
public $A_CMP_USS_MSN = 'MSN';
public $A_CMP_USS_ICQ = 'ICQ';
public $A_CMP_USS_MOBILE = 'Móvil';
public $A_CMP_USS_BIRTHDATE = 'Fecha de nacimiento';
public $A_CMP_USS_GENDER = 'Sexo';
public $A_CMP_USS_LOCATION = 'Ciudad';
public $A_CMP_USS_OCCUPATION = 'Ocupación';
public $A_CMP_USS_SIGNATURE = 'Firma';
public $A_CMP_USS_MALE = 'Hombre';
public $A_CMP_USS_FEMALE = 'Mujer';
public $A_CMP_USS_YEAR = 'Año';
public $A_CMP_USS_MONTH = 'Mes';
public $A_CMP_USS_DAY = 'Día';
public $A_CMP_USS_BOLDINDIC = 'Los elementos en negrita aparecen activados en el perfil de los usuarios.';
public $A_CMP_USS_ENDISSOFT = 'Puede activar o desactivar los elementos de los perfiles desde SoftDisk.';

//2009.0
public $A_USERS_EXPDATE = 'Fecha de vencimiento';
public $A_USERS_ACCEXPIRED = 'La cuenta expiró';
public $A_USERS_ACCNACTIVE = 'La cuenta es activa';

}

?>