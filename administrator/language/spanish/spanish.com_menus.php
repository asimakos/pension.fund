<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ricard Lozano
* @link: http://www.rlozano.com
* @description: Spanish language for component menus
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_MU_MANAGER = 'Administrador de menús';
public $A_CMP_MU_MXLVLS = 'Niveles máximos';
public $A_CMP_MU_CANTDEL ='* Este menú no se puede eliminar porque es necesario para el sistema *';
public $A_CMP_MU_MANHOME = '* El primer enlace publicado de este menú será la página de inicio predeterminada del sitio *';
public $A_CMP_MU_MITEM = 'Enlace de menú';
public $A_CMP_MU_NSMTG = '* Nótese que algunos tipos de menú aparecen en más de un grupo, pero aun así son del mismo tipo. ';
public $A_CMP_MU_MITYP = 'Tipo de elemento del menú';
public $A_CMP_MU_WBLV = 'Qué es la vista de \'Blog\'';
public $A_CMP_MU_WTLV = 'Qué es la vista de \'Tabla\'';
public $A_CMP_MU_WLIV = 'Qué es la vista de \'Lista\'';
public $A_CMP_MU_SMTAP = '* Algunos tipos de menús aparecen en más de un grupo * ';
public $A_CMP_MU_MOVEITS = 'Mover enlaces del menú';
public $A_CMP_MU_MOVEMEN = 'Mover al menú';
public $A_CMP_MU_BEINMOV = 'Enlaces de menú que se van a mover';
public $A_CMP_MU_COPYITS = 'Copiar enlaces de menú';
public $A_CMP_MU_COPYMEN = 'Copiar en el menú';
public $A_CMP_MU_BCOPIED = 'Enlaces de menú que se van a copiar';
public $A_CMP_MU_EDNEWSF = 'Editar este servicio de noticias';
public $A_CMP_MU_EDCONTA = 'Editar este contacto';
public $A_CMP_MU_EDCONTE = 'Editar este artículo';
public $A_CMP_MU_EDSTCONTE = 'Editar esta página estática';
public $A_CMP_MU_MSGITSAV = 'Enlace de menú guardado';
public $A_CMP_MU_MOVEDTO = ' Enlaces de menú movidos a ';
public $A_CMP_MU_COPITO = ' Enlaces de menú copiados en ';
public $A_CMP_MU_THMOD = 'El módulo';
public $A_CMP_MU_SCITLKT = 'Seleccione un componente para enlazarlo';
public $A_CMP_MU_COMPLLTO = 'Componente a enlazar';
public $A_CMP_MU_ITEMNAME = 'El elemento debe tener un nombre';
public $A_CMP_MU_PLSELCMP = 'Seleccione un componente';
public $A_CMP_MU_PARAVAI = 'Una vez que guarde este nuevo enlace del menú, aparecerá la lista de parámetros.';
public $A_CMP_MU_YSELCAT = 'Seleccione una categoría';
public $A_CMP_MU_TMHTITL = 'Este elemento del menú debe tener un título';
public $A_CMP_MU_TABLE = 'Tabla';
public $A_CMP_MU_CCTBLANK = 'Si lo deja en blanco, se usará automáticamente el nombre de la categoría ';
public $A_CMP_MU_LNKHNAME = 'El enlace debe tener un nombre';
public $A_CMP_MU_SELCONT = 'Seleccione un contacto para enlazarlo';
public $A_CMP_MU_CONLINK = 'Contacto a enlazar';
public $A_CMP_MU_ONCLOPI = 'Al hacer clic, abrir en';
public $A_CMP_MU_THETITL = 'Título:';
public $A_CMP_MU_YMSSECT = 'Seleccione una sección';
public $A_CMP_MU_ILBLSEC = 'Si lo deja en blanco, se usará automáticamente el nombre de la sección. ';
public $A_CMP_MU_YCSMC = 'Puede seleccionar varias categorías';
public $A_CMP_MU_YCSMS = 'Puede seleccionar varias secciones';
public $A_CMP_MU_EDCOI = 'Editar artículo';
public $A_CMP_MU_YMSLT = 'Seleccione un artículo para enlazarlo';
public $A_CMP_MU_STACONT = 'Contenido de página estática';
public $A_CMP_MU_ONCLOP = 'Al hacer clic, abrir';
public $A_CMP_MU_YSNWLT = 'Seleccione el servicio de noticias que desee enlazar';
public $A_CMP_MU_NEWTL = 'Servicio de noticias a enlazar';
public $A_CMP_MU_SEPER = '- - - - - - -'; //Change this, if you want to change the symbols for seperator line
public $A_CMP_MU_PATNAM = 'Patrón/Nombre';
public $A_CMP_MU_WRURL = 'Debe especificar una URL.';
public $A_CMP_MU_WRLINK = 'Enlace de Wrapper';
public $A_CMP_MU_MIBGCC = 'Blog - Categoría de artículos';
public $A_CMP_MU_MITCG = 'Tabla - Categoría de contactos'; 
public $A_CMP_MU_MICOMP = 'Componente';
public $A_CMP_MU_MIBGCS = 'Blog - Sección de artículos';
public $A_CMP_MU_MILCMPI = 'Enlace - Componente';
public $A_CMP_MU_MILCI = 'Enlace - Contacto';
public $A_CMP_MU_MITBCC = 'Tabla - Categoría de artículos';
public $A_CMP_MU_MILCEI = 'Enlace - Artículo';
public $A_CMP_MU_COTLINK = 'Artículo a enlazar';
public $A_CMP_MU_MITBCS = 'Tabla - Sección de artículos';
public $A_CMP_MU_MILSTC = 'Enlace - Página estática';
public $A_CMP_MU_MITBNFC = 'Tabla - Categoría de servicios de noticias';
public $A_CMP_MU_MILNEW = 'Enlace - Servicio de noticias';
public $A_CMP_MU_MISEP = 'Separador';
public $A_CMP_MU_MILIURL = 'Enlace - URL';
public $A_CMP_MU_MITBWC = 'Tabla - Categoría de enlaces web';
public $A_CMP_MU_MIWRAP = 'Wrapper';
public $A_CMP_MU_ITEM = 'Elemento';
public $A_CMP_MU_UMSBRI = 'Debe seleccionar un bridge';
public $A_CMP_MU_BRINOINS = '¡No está instalado el bridge del componente!';
public $A_CMP_MU_NOPUBBRI = '¡No hay ningún bridge publicado!';
public $A_CMP_MU_CLVSEO = 'Haga clic en una página estática para ver su título SEO';
public $A_CMP_MU_SYSLINK = 'Enlace del sistema';
public $A_CMP_MU_SYSLINKD = 'Normalmente, los enlaces del sistema pertenecen a una serie de menús publicados en una posición de módulo que NO existe en la plantilla.';
public $A_CMP_MU_PASSR = 'Recuperar contraseña';
public $A_CMP_MU_UREG = 'Registro de usuario';
public $A_CMP_MU_REGCOMP = 'El proceso de registro ha finalizado';
public $A_CMP_MU_ACCACT = 'Activación de la cuenta';
public $A_CMP_MU_MSLINK = 'Debe seleccionar un enlace del sistema.';
public $A_CMP_MU_SELLINK = '- Seleccionar enlace - ';
public $A_CMP_MU_DONTDEL ='Este menú no se puede eliminar porque es necesario para el sistema. ¡Asegúrese de que está publicado en una posición de módulo que NO exista en la plantilla! *';
public $A_CMP_MU_EDPROF = 'Editar perfil';
public $A_CMP_MU_SUBWEBL = 'Enviar enlace web';
public $A_CMP_MU_CHECKIN = 'Introducir en el sistema';
public $A_CMP_MU_USERLIST = 'Lista de usuarios';
public $A_CMP_MU_POLLS = 'Encuestas';
//elxis 2008.1
public $A_CMP_MU_SELBLOG = 'You must select a blog to link to';
public $A_CMP_MU_BLOGLINK = 'Blog to Link';

}

?>