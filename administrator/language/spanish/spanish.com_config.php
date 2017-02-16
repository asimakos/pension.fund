<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ricard Lozano
* @link: http://www.rlozano.com
* @description: Spanish language for component config
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

	public $A_COMP_CONF_OFFLINE = 'Cerrado por mantenimiento ';
	public $A_COMP_CONF_OFFMESSAGE = 'Mensaje si el sitio está cerrado por mantenimiento ';
	public $A_COMP_CONF_TIP_OFFMESSAGE = 'Mensaje que aparece cuando el sitio web no está online';
	public $A_COMP_CONF_ERR_MESSAGE = 'Mensaje de error del sistema';
	public $A_COMP_CONF_TIP_ERR_MESSAGE = 'Mensaje que aparece si el sistema no puede establecer conexión con la base de datos ';
	public $A_COMP_CONF_SITE_NAME = 'Nombre del sitio';
	public $A_COMP_CONF_UN_LINKS = 'Mostrar enlaces no autorizados';
	public $A_COMP_CONF_UN_TIP = 'Muestra a los visitantes (no registrados) los enlaces que remiten a contenidos para usuarios registrados.  No obstante, para poder leer los artículos es necesario que inicien una sesión. ';
	public $A_COMP_CONF_USER_REG = 'Registro de nuevos usuarios';
	public $A_COMP_CONF_TIP_USER_REG = 'Permite que se registren nuevos usuarios';
	public $A_COMP_CONF_REQ_EMAIL = 'Direcciones de email únicas';
	public $A_COMP_CONF_REQTIP = 'Impide que puedan registrarse usuarios con la misma dirección de correo electrónico';
	public $A_COMP_CONF_DEBUG = 'Depurador del sitio';
	public $A_COMP_CONF_DEBTIP = 'Muestra la información de diagnóstico y los errores de SQL (en caso de haberlos) en el sitio web';
	public $A_COMP_CONF_EDITOR = 'Editor WYSIWYG';
	public $A_COMP_CONF_LENGTH = 'Extensión de los listados';
	public $A_COMP_CONF_LENTIP = 'Establece el número de filas que tendrán los listados del panel de administración ';
	public $A_COMP_CONF_FAV_ICON = 'Favicon del sitio';
	public $A_COMP_CONF_FAVTIP = 'Si se deja en blanco o si no se encuentra el archivo, se usará el icono predeterminado (favicon.ico).';
	public $A_COMP_CONF_CLINKACC = 'Componentes vinculados con el sistema de acceso';
	public $A_COMP_CONF_CLACCDESC = 'Seleccione el tipo de componentes a los que desea aplicar el sistema de control de acceso desde el sitio web (Valor ACO = view). Consulte la Ayuda si tiene alguna duda.';
	public $A_COMP_CONF_CORECOMPS = 'Componentes básicos';
	public $A_COMP_CONF_3RDCOMPS = 'Componentes de terceros';
	public $A_COMP_CONF_ALLCOMPS = 'Todos los componentes';
	public $A_COMP_CONF_CAPTCHA = 'Usar imágenes de seguridad';
	public $A_COMP_CONF_CAPTCHATIP = 'Muestra imágenes de seguridad (captcha) en los formularios del sitio. Para ayudar a las personas con discapacidad visual, se incluye una utilidad que lee en voz alta el contenido de las imágenes.';
	public $A_COMP_CONF_LOCALE = 'Idioma';
	public $A_COMP_CONF_LANG = 'Idioma predeterminado del sitio';
	public $A_COMP_CONF_ALANG = 'Idioma predeterminado de la administración';
	public $A_COMP_CONF_TIME_SET = 'Huso horario';
	public $A_COMP_CONF_DATE = 'Ahora está configurado para mostrar';
	public $A_COMP_CONF_LOCAL = 'Código de idioma/país';
	public $A_COMP_CONF_LOCRECOM = 'Se recomienda dejar la opción Seleccionar automáticamente. El sistema cargará el código más adecuado para el idioma seleccionado y el sistema operativo utilizado.  Windows no es compatible con la codificación UTF-8.';
	public $A_COMP_CONF_LOCCHECK = 'Comprobación del código de idioma';
	public $A_COMP_CONF_LOCCHECK2 = 'Si ve esta fecha correctamente, significa que el código de idioma está bien seleccionado. <br /><strong>¡Atención!</strong> En Windows, el código de idioma se establece automáticamente en inglés.';
	public $A_COMP_CONF_AUTOSEL = 'Seleccionar automáticamente';
	public $A_COMP_CONF_CONTROL = '* Estos parámetros controlan elementos que aparecen en el sitio web * ';
	public $A_COMP_CONF_LINK_TITLES = 'Enlaces en los títulos';
	public $A_COMP_CONF_LTITLES_TIP = 'Convierte los títulos de los artículos en enlaces que remiten a los contenidos.';
	public $A_COMP_CONF_MORE_LINK = 'Enlace Continúa...';
	public $A_COMP_CONF_MLINK_TIP = 'Muestra este enlace debajo de los textos introductorios para seguir leyendo.';
	public $A_COMP_CONF_RATE_VOTE = 'Votación de artículos';
	public $A_COMP_CONF_RVOTE_TIP = 'Activa el sistema de votación para los artículos.';
	public $A_COMP_CONF_AUTHOR = 'Nombre del autor';
	public $A_COMP_CONF_AUTHORTIP = 'Muestra el nombre del autor de los artículos. Este parámetro afecta a todo el sitio web, aunque luego puede modificarse individualmente para cada menú o artículo si es necesario. ';
	public $A_COMP_CONF_CREATED = 'Fecha y hora de creación';
	public $A_COMP_CONF_CREATEDTIP = 'Muestra la fecha y la hora a la que se crearon los artículos. Este parámetro afecta a todo el sitio web, aunque luego puede modificarse individualmente para cada menú o artículo si es necesario. ';
	public $A_COMP_CONF_MOD_DATE = 'Fecha y hora de modificación';
	public $A_COMP_CONF_MDATETIP = 'Muestra la fecha y la hora a la que se modificaron los artículos. Este parámetro afecta a todo el sitio web, aunque luego puede modificarse en cada menú o en cada artículo si es necesario. ';
	public $A_COMP_CONF_HITS = 'Visitas';
	public $A_COMP_CONF_HITSTIP = 'Muestra la cantidad de visitas de cada artículo. Este parámetro afecta a todo el sitio web, aunque luego puede modificarse individualmente para cada menú o artículo si es necesario. ';
	public $A_COMP_CONF_PDF = 'Icono PDF';
	public $A_COMP_CONF_OPT_MEDIA = 'Esta opción no está disponible, ya que la carpeta /tmpr no tiene permisos de escritura.';
	public $A_COMP_CONF_PRINT_ICON = 'Icono Imprimir';
	public $A_COMP_CONF_EMAIL_ICON = 'Icono Enviar a un amigo ';
	public $A_COMP_CONF_ICONS = 'Iconos';
	public $A_COMP_CONF_USE_OR_TEXT = 'Imprimir, PDF y Enviar a un amigo pueden aparecer como iconos o como texto';
	public $A_COMP_CONF_TBL_CONTENTS = 'Índice en artículos con varias páginas';
	public $A_COMP_CONF_BACK_BUTTON = 'Enlace Atrás';
	public $A_COMP_CONF_CONTENT_NAV = 'Navegación entre los artículos';
	public $A_COMP_CONF_HYPER = 'Usar enlaces en los títulos';
	public $A_COMP_CONF_DBTYPE = 'Tipo de base de datos';
	public $A_COMP_CONF_DBWARN = '¡No cambie este parámetro a menos que su sistema sea compatible con otra base de datos y tenga instalado Elxis en ella!';
	public $A_COMP_CONF_HOSTNAME = 'Nombre del host';
	public $A_COMP_CONF_DB_PW = 'Contraseña';
	public $A_COMP_CONF_DB_NAME = 'Base de datos';
	public $A_COMP_CONF_DB_PREFIX = 'Prefijo de la base de datos';
	public $A_COMP_CONF_NOT_CH = '!! ¡No cambie este parámetro a menos que las tablas de su base de datos utilicen otro prefijo!';
	public $A_COMP_CONF_ABS_PATH = 'Ruta absoluta';
	public $A_COMP_CONF_LIVE = 'URL del sitio';
	public $A_COMP_CONF_SECRET = 'Palabra secreta';
	public $A_COMP_CONF_GZIP = 'Compresión GZIP de las páginas';
	public $A_COMP_CONF_CP_BUFFER = 'Comprime la salida del buffer, si el sistema lo permite';
	public $A_COMP_CONF_SESSION_TIME = 'Duración de la sesión';
	public $A_COMP_CONF_SEC = 'segundos';
	public $A_COMP_CONF_AUTO_LOGOUT = 'Desconecta automáticamente al usuario después del tiempo establecido. ';
	public $A_COMP_CONF_ERR_REPORT = 'Informes de errores';
	public $A_COMP_CONF_HELP_SERVER = 'Servidor de ayuda';
	public $A_COMP_CONF_META_PAGE = 'Metaetiquetas';
	public $A_COMP_CONF_META_DESC = 'Descripción del sitio';
	public $A_COMP_CONF_META_KEY = 'Palabras clave';
	public $A_COMP_CONF_HPS1 = 'Archivos de ayuda locales';
	public $A_COMP_CONF_HPS2 = 'Servidor de ayuda remoto de Elxis';
	public $A_COMP_CONF_HPS3 = 'Servidor de ayuda oficial de Elxis';
	public $A_COMP_CONF_PERMFLES = 'Define los permisos para los nuevos archivos. ';
	public $A_COMP_CONF_PERMDIRS = 'Define los permisos para las nuevas carpetas. ';
	public $A_COMP_CONF_NCHMODDIRS = 'No aplicar CHMOD a las nuevas carpetas (usar valores del servidor)';
	public $A_COMP_CONF_CHAPFLAGS = 'Si marca esta opción, se aplicarán los permisos a <em>todos los archivos existentes</em> del sitio. <br/><strong>¡EL USO INADECUADO DE ESTOS PARÁMETROS PUEDE DEJAR EL SITIO INOPERATIVO!</strong>';
	public $A_COMP_CONF_CHAPDLAGS = 'Si marca esta opción, se aplicarán los permisos a <em>todas las carpetas existentes</em> del sitio. <br/><strong>¡EL USO INADECUADO DE ESTOS PARÁMETROS PUEDE DEJAR EL SITIO INOPERATIVO!</strong>';
	public $A_COMP_CONF_APPEXDIRS = 'Aplicar a todas las carpetas existentes';
	public $A_COMP_CONF_APPEXFILES = 'Aplicar a todos los archivos existentes';
	public $A_COMP_CONF_WORLD = 'Resto';
	public $A_COMP_CONF_CHMODNDIRS = 'Aplicar CHMOD a las nuevas carpetas';
	public $A_COMP_CONF_MAIL = 'Sistema de envío de correo';
	public $A_COMP_CONF_MAIL_FROM = 'Email del remitente';
	public $A_COMP_CONF_MAIL_FROM_NAME = 'Nombre del remitente';
	public $A_COMP_CONF_MAIL_SMTP_AUTH = 'Autenticacion SMTP';
	public $A_COMP_CONF_MAIL_SMTP_USER = 'Usuario SMTP';
	public $A_COMP_CONF_MAIL_SMTP_PASS = 'Contraseña SMTP';
	public $A_COMP_CONF_MAIL_SMTP_HOST = 'Host SMTP';
	public $A_COMP_CONF_CACHE = 'Activar caché';
	public $A_COMP_CONF_CACHE_FOLDER = 'Carpeta de caché';
	public $A_COMP_CONF_CACHE_DIR = 'Actualmente, la carpeta de la caché es';
	public $A_COMP_CONF_CACHE_DIR_UNWRT = 'La carpeta de la caché NO TIENE PERMISOS DE ESCRITURA. Aplique CHMOD 777 a esta carpeta antes de activar la caché. ';
	public $A_COMP_CONF_CACHE_TIME = 'Actualización de caché';
	public $A_COMP_CONF_STATS = 'Estadísticas';
	public $A_COMP_CONF_STATS_ENABLE = 'Activa o desactiva la elaboración de estadísticas del sitio';
	public $A_COMP_CONF_STATS_LOG_HITS = 'Registro de visitas por fechas';
	public $A_COMP_CONF_STATS_WARN_DATA = 'ADVERTENCIA: Esto genera una gran cantidad de datos.';
	public $A_COMP_CONF_STATS_LOG_SEARCH = 'Registro de cadenas de búsqueda';
	public $A_COMP_CONF_SEO_LBL = 'SEO';
	public $A_COMP_CONF_SEO = 'Optimización SEO para los buscadores';
	public $A_COMP_CONF_SEO_SEFU = 'URL legibles por buscadores';
	public $A_COMP_CONF_SEOBASIC = 'SEO Basic';
	public $A_COMP_CONF_SEOPRO = 'SEO Pro';
	public $A_COMP_CONF_SEOHELP = "Apache and IIS. Apache: renombre htaccess.txt a .htaccess antes de activar esta opción (mod_rewrite enabled). IIS: utilice Ionic Isapi Rewriter Filter. Para garantizar el máximo rendimiento, prepare los contenidos antes de seleccionar SEO Pro. Seleccione SEO Basic si desea usar un componente SEF de terceros.";
	public $A_COMP_CONF_SERVER = 'Servidor';
	public $A_COMP_CONF_METADATA = 'Metaetiquetas';
	public $A_COMP_CONF_CACHE_TAB = 'Caché';
	public $A_COMP_CONF_FTP_LBL = 'FTP';
	public $A_COMP_CONF_FTP = 'Parámetros de FTP';
	public $A_COMP_CONF_FTP_ENB = 'Activar FTP';
	public $A_COMP_CONF_FTP_HST = 'Host de FTP';
	public $A_COMP_CONF_FTP_HSTTP = 'Lo más probable';
	public $A_COMP_CONF_FTP_USR = 'Nombre del usuario de FTP';
	public $A_COMP_CONF_FTP_USRTP = 'Lo más probable';
	public $A_COMP_CONF_FTP_PAS = 'Contraseña de FTP';
	public $A_COMP_CONF_FTP_PRT = 'Puerto de FTP';
	public $A_COMP_CONF_FTP_PRTTP = 'Valor predeterminado: 21';
	public $A_COMP_CONF_FTP_PTH = 'Directorio raíz de FTP';
	public $A_COMP_CONF_FTP_PTHTP = 'La ruta del directorio raíz de su instalación de Elxis. Por ejemplo, /public_html/elxis.';
	public $A_COMP_CONF_HIDE = 'Ocultar';
	public $A_COMP_CONF_SHOW = 'Mostrar';
	public $A_COMP_CONF_DEFAULT = 'Predeterminado del sistema';
	public $A_COMP_CONF_NONE = 'Ninguno';
	public $A_COMP_CONF_SIMPLE = 'Simple';
	public $A_COMP_CONF_MAX = 'Máximo';
	public $A_COMP_CONF_MAIL_FC = 'PHP Mail';
	public $A_COMP_CONF_SEND = 'Sendmail';
	public $A_COMP_CONF_SENDP = 'Ruta de Sendmail';
	public $A_COMP_CONF_SMTP = 'Servidor SMTP';
	public $A_COMP_CONF_UPDATED = 'La configuración se ha <strong>actualizado</strong>. ';
	public $A_COMP_CONF_ERR_OCC = '<strong>Se ha producido un error</strong>. ¡No se puede abrir o modificar el archivo de configuración!';
	public $A_COMP_CONF_READ = 'Lectura';
	public $A_COMP_CONF_WRITE = 'Escritura';
	public $A_COMP_CONF_EXEC = 'Ejecución';
	public $A_COMP_CONF_FCRE = 'Creación de archivos';
	public $A_COMP_CONF_FPERM = 'Permisos de archivos';
	public $A_COMP_CONF_DCRE = 'Creación de carpetas';
	public $A_COMP_CONF_DPERM = 'Permisos de carpetas';
	public $A_COMP_CONF_OFFEX = 'Sí (excepto para superadministradores)';
	public $A_COMP_CONF_RTF = 'Icono RTF';

	//2008.1
	public $A_C_CONF_AC_ACT = 'Account Activation';
	public $A_C_CONF_NOACT = 'No activation';
	public $A_C_CONF_EMACT = 'Activation via e-mail';
	public $A_C_CONF_MANACT = 'Manual activation';
	public $A_C_CONF_AC_ACTD = 'Select how you wish new user accounts to be activated. Directly, via activation link in e-mail or manually by the site administrator.';

	//2009.0
	public $A_C_CONF_COMMENTS = 'Comentarios';
	public $A_C_CONF_COMMENTSTIP = 'Si el sistema para demostrar, el número de comentarios para un artículo contento particular es exhibido. Esto es un ajuste global pero se puede cambiar en los niveles del menú y del artículo';
	public $A_C_CONF_CHKFTP = 'Compruebe los ajustes del ftp';
	public $A_C_CONF_STDCACHE = 'Cache estándar';
	public $A_C_CONF_STATCACHE = 'Cache estático';
	public $A_C_CONF_CACHED = 'Los bloques estándar de la página parcial de los escondrijos del escondrijo mientras que son estáticos depositan la página entera. El escondrijo estático se recomienda para los sitios cargados pesados. Para utilizar el escondrijo estático usted debe tener SEO PRO permitido.';
	public $A_C_CONF_SEODIS = '¡SEO PRO es lisiado!';

	public function __construct() {	
	}

}

?>