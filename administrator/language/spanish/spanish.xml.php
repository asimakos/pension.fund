<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ricard Lozano
* @link: http://www.rlozano.com
* @description: Spanish Language for XML files
* @note: All values used in admin XML files start with 'AX_'
* @note 2008/2009: values for custom language strings defined as php contants start with 'CX_' (not in this file!)
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* 
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
* 
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class xmlLanguage extends standardLanguage {

public function get($a) {
	if ( is_numeric($a) ) { return $a; }
	$pref = strtoupper(substr($a,0,3));
    if ($pref == 'AX_') {
        return $this->$a;
    } elseif (($pref == 'CX_') && defined($a)) {
        return constant($a);
	} else { return $a; }
}


protected $AX_MENUIMGL = 'Imagen del menú';
protected $AX_MENUIMGD = 'Pequeña imagen que se puede insertar a la izquierda o a la derecha del enlace de menú. Debe encontrarse físicamente en la carpeta /images/stories.';
protected $AX_MENUIMGONLYL = 'Usar sólo imagen del menú';
protected $AX_MENUIMGONLYD = 'Si elige <strong>Sí</strong>, el enlace del menú estará representado solamente por la imagen seleccionada.<br /><br />Si elige <strong>No</strong>, el enlace del menú estará representado por la imagen seleccionada y también por el texto correspondiente.';
protected $AX_MENUIMG2D = 'Pequeña imagen que se puede insertar a la izquierda o a la derecha del enlace de menú. Las imágenes deben encontrarse físicamente en la carpeta /images.';
protected $AX_PAGCLASUFL = 'Sufijo de la página (CSS)';
protected $AX_PAGCLASUFD = 'Este sufijo se aplicará a los estilos CSS para poder personalizar los estilos de la página.';
protected $AX_TEXTPAGECL = 'Sufijo del artículo (CSS)';
protected $AX_TEXTPAGECLD = 'Este sufijo se aplicará a los estilos CSS para poder personalizar los estilos del artículo.';
protected $AX_BACKBUTL = 'Enlace Atrás';
protected $AX_BACKBUTD = 'Muestra u oculta el enlace Atrás, para volver a la página anterior.';
protected $AX_USEGLB = 'Usar configuración global';
protected $AX_HIDE = 'Ocultar';
protected $AX_SHOW = 'Mostrar';
protected $AX_AUTO = 'Automático';
protected $AX_PAGTITLSL = 'Mostrar título de la página';
protected $AX_PAGTITLSD = 'Muestra u oculta el título de la página.';
protected $AX_PAGTITLL = 'Título de la página';
protected $AX_PAGTITLD = 'Texto que aparece al principio de la página. Si se deja en blanco, en su lugar aparecerá el texto del enlace de menú.';
protected $AX_PAGTITL2D = 'Texto que aparece al principio de la página.';
protected $AX_LEFT = 'Izquierda';
protected $AX_RIGHT = 'Derecha';
protected $AX_PRNTICOL = 'Icono Imprimir';
protected $AX_PRNTICOD = 'Muestra u oculta el icono para imprimir el artículo (sólo afecta a esta página).';
protected $AX_YES = 'Sí';
protected $AX_NO = 'No';
protected $AX_SECNML = 'Nombre de la sección';
protected $AX_SECNMD = 'Muestra u oculta la sección a que pertenece el artículo.';
protected $AX_SECNMLL = 'Enlace en el nombre de sección';
protected $AX_SECNMLD = 'Convierte en hipervínculo el nombre de la sección, que enlaza con la página real de la sección.';
protected $AX_CATNML = 'Nombre de la categoría';
protected $AX_CATNMD = 'Muestra u oculta la categoría a la que pertenece el artículo.';
protected $AX_CATNMLL = 'Enlace en el nombre de categoría';
protected $AX_CATNMLD = 'Convierte en hipervínculo el nombre de la categoría, que enlaza con la página real de la categoría.';
protected $AX_LNKTTLL = 'Enlaces en los títulos';
protected $AX_LNKTTLD = 'Convierte los títulos en hipervínculos';
protected $AX_ITMRATL = 'Votación del artículo';
protected $AX_ITMRATD = 'Muestra u oculta las votaciones para artículo (sólo afecta a esta página).';
protected $AX_AUTNML = 'Nombre del autor';
protected $AX_AUTNMD = 'Muestra u oculta el autor de los artículos (sólo afecta a esta página).';
protected $AX_CTDL = 'Fecha y hora de creación';
protected $AX_CTDD = 'Muestra u oculta la fecha de creación de los artículos (sólo afecta a esta página).';
protected $AX_MTDL = 'Fecha y hora de modificación';
protected $AX_MTDD = 'Muestra u oculta la fecha de modificación de los artículos (sólo afecta a esta página).';
protected $AX_PDFICL = 'Icono PDF';
protected $AX_PDFICD = 'Muestra u oculta el icono para convertir el artículo en PDF (sólo afecta a esta página).';
protected $AX_PRICL = 'Icono Imprimir';
protected $AX_PRICD = 'Muestra u oculta el icono para imprimir el artículo (sólo afecta a esta página).';
protected $AX_EMICL = 'Icono Enviar a un amigo';
protected $AX_EMICD = 'Muestra u oculta el icono para enviar por correo electrónico un enlace del artículo a un amigo (sólo afecta a esta página).';
protected $AX_FTITLE = 'Título';
protected $AX_FAUTH = 'Autor';
protected $AX_FHITS = 'Visitas';
protected $AX_DESCRL = 'Descripción';
protected $AX_DESCRD = 'Muestra u oculta la descripción de abajo.';
protected $AX_DESCRTXL = 'Texto de la descripción';
protected $AX_DESCRTXD = 'Si se deja en blanco, se usará el texto de la variable WEBLINKS_DESC que se encuentra en el archivo de idioma.';
protected $AX_IMAGEL = 'Imagen';
protected $AX_IMGFRPD = 'Las imágenes de la página deben encontrarse físicamente en la carpeta /images/stories. De manera predeterminada se usará web_links.jpg. Si no se selecciona nada, no aparecerá ninguna imagen.';
protected $AX_IMGALL = 'Alinear imagen';
protected $AX_IMGALD = 'Alineación de la imagen.';
protected $AX_TBHEADL = 'Encabezados de tabla';
protected $AX_TBHEADD = 'Muestra u oculta los encabezados de la tabla.';
protected $AX_POSCOLL = 'Columna Posición';
protected $AX_POSCOLD = 'Muestra u oculta la columna Posición.';
protected $AX_EMAILCOLL = 'Columna Email';
protected $AX_EMAILCOLD = 'Muestra u oculta la columna Email.';
protected $AX_TELCOLL = 'Columna Teléfono';
protected $AX_TELCOLD = 'Muestra u oculta la columna Teléfono.';
protected $AX_FAXCOLL = 'Columna Fax';
protected $AX_FAXCOLD = 'Muestra u oculta la columna Fax.';
protected $AX_LEADINGL = 'Artículos principales';
protected $AX_LEADINGD = 'Número de artículos que aparecerán a una columna en la parte superior de la página, aunque los demás textos introductorios vayan a más de una columna. 0 significa que ningún artículo aparecerá como principal.';
protected $AX_INTROL = 'Textos introductorios';
protected $AX_INTROD = 'Número de artículos de los que se mostrarán los textos introductorios, a continuación de los artículos principales. Aparecerán a una o más columnas, en función del valor definido en el campo Columnas.';
protected $AX_COLSL = 'Columnas';
protected $AX_COLSD = 'Número de columnas para los textos introductorios.';
protected $AX_LNKSL = 'Enlaces';
protected $AX_LNKSD = 'Número de artículos que aparecerán como una lista de enlaces en la parte inferior de la página, a continuación de los textos introductorios.';
protected $AX_CATORL = 'Orden por categoría';
protected $AX_CATORD = 'Para ordenar los artículos por categoría.';
protected $AX_OCAT01 = 'No, sólo ordenación principal';
protected $AX_OCAT02 = 'Por título, A-Z';
protected $AX_OCAT03 = 'Por título, Z-A';
protected $AX_OCAT04 = 'Orden';
protected $AX_PRMORL = 'Orden principal';
protected $AX_PRMORD = 'Orden en que aparecen los artículos.';
protected $AX_OPRM01 = 'Predeterminado';
protected $AX_OPRM02 = 'Orden de página de inicio';
protected $AX_OPRM03 = 'Lo más antiguo primero';
protected $AX_OPRM04 = 'Lo más reciente primero';
protected $AX_OPRM07 = 'Por autor, A-Z';
protected $AX_OPRM08 = 'Por autor, Z-A';
protected $AX_OPRM09 = 'Con más visitas';
protected $AX_OPRM10 = 'Con menos visitas';
protected $AX_PAGL = 'Paginación';
protected $AX_PAGD = 'Muestra u oculta la función de paginación.';
protected $AX_PAGRL = 'Resultados de la paginación';
protected $AX_PAGRD = 'Muestra u oculta los resultados de la paginación (p. ej., 1-4 de 4).';
protected $AX_MOSIL = 'MOSImages';
protected $AX_MOSID = 'Mostrar {mosimages}.';
protected $AX_ITMTL = 'Título de los artículos';
protected $AX_ITMTD = 'Muestra u oculta los títulos de los artículos.';
protected $AX_REMRL = 'Enlace Continúa...';
protected $AX_REMRD = 'Muestra u oculta el enlace Continúa... debajo de los textos introductorios.';
protected $AX_OTHCATL = 'Otras categorías';
protected $AX_OTHCATD = 'Al mostrar una categoría, muestra u oculta la lista de las demás categorías.';
protected $AX_TDISTPD = 'Texto que aparece al principio de la página.';
protected $AX_ORDBYL = 'Ordenar por';
protected $AX_ORDBYD = 'Fuerza el orden de los artículos.';
protected $AX_MCS_DESCL = 'Descripción';
protected $AX_SHCDESD = 'Muestra u oculta la descripción de la categoría.';
protected $AX_DESCIL = 'Descripción de la imagen';
protected $AX_MUDATFL = 'Formato de fecha';
protected $AX_MUDATFD = "Formato de fecha según el comando strftime de PHP. Si se deja en blanco, se usará el formato especificado en el archivo de idioma.";
protected $AX_MUDATCL = 'Columna Fecha';
protected $AX_MUDATCD = 'Muestra u oculta la columna Fecha.';
protected $AX_MUAUTCL = 'Columna Autor';
protected $AX_MUAUTCD = 'Muestra u oculta la columna Autor.';
protected $AX_MUHITCL = 'Columna Visitas';
protected $AX_MUHITCD = 'Muestra u oculta la columna Visitas.';
protected $AX_MUNAVBL = 'Barra de navegación';
protected $AX_MUNAVBD = 'Muestra u oculta la barra de navegación.';
protected $AX_MUORDSL = 'Desplegable Orden';
protected $AX_MUORDSD = 'Muestra u oculta el menú desplegable para ordenar los artículos.';
protected $AX_MUDSPSL = 'Desplegable Artículos por página';
protected $AX_MUDSPSD = 'Muestra u oculta el menú desplegable para seleccionar el número de artículos que aparecen por página.';
protected $AX_MUDSPNL = 'Artículos por página';
protected $AX_MUDSPND = 'Valor predeterminado para el número de artículos que aparecen por página.';
protected $AX_MUFLTL = 'Filtrar';
protected $AX_MUFLTD = 'Muestra u oculta la función del filtro.';
protected $AX_MUFLTFL = 'Campo filtrable';
protected $AX_MUFLTFD = 'Campo al que se desea aplicar el filtro.';
protected $AX_MUOCATL = 'Otras categorías';
protected $AX_MUOCATD = 'Muestra u oculta la lista de las demás categorías.';
protected $AX_MUECATL = 'Categorías vacías';
protected $AX_MUECATD = 'Muestra u oculta las categorías que están vacías.';
protected $AX_CATDSCL = 'Descripción de la categoría';
protected $AX_CATDSBLND = 'Muestra u oculta la descripción de la categoría, que debajo del nombre de la categoría.';
protected $AX_NAMCOLL = 'Columna Nombre';
protected $AX_LINKDSCL = 'Descripción de los enlaces web';
protected $AX_LINKDSCD = 'Muestra u oculta la descripción de los enlaces web.';
//com_contact/contact.xml
protected $AX_CCT_CDESC = 'Este componente muestra una lista de la información de contacto.';
protected $AX_CCT_CATLISTSL = 'Lista de categorías - Sección';
protected $AX_CCT_CATLISTSD = 'Muestra u oculta la lista de categorías en una vista de Lista.';
protected $AX_CCT_CATLISTCL = 'Lista de categorías - Categoría';
protected $AX_CCT_CATLISTCD = 'Muestra u oculta la lista de categorías en una vista de Tabla.';
protected $AX_CCT_CATDSCD = 'Muestra u oculta la descripción de las demás categorías.';
protected $AX_CCT_NOCATITL = 'N.º de artículos en categorías';
protected $AX_CCT_NOCATITD = 'Muestra u oculta el número de artículos que contiene cada categoría.';
//com_contact/contact_items.xml
protected $AX_CIT_CDESC = 'Parámetros para los elementos individuales de los contactos.';
protected $AX_CIT_NAMEL = 'Nombre';
protected $AX_CIT_NAMED = 'Muestra u oculta el nombre.';
protected $AX_CIT_POSITL = 'Cargo';
protected $AX_CIT_POSITD = 'Muestra u oculta el cargo.';
protected $AX_CIT_EMAILL = 'Email';
protected $AX_CIT_EMAILD = 'Muestra u oculta el Email. Muestra u oculta la dirección de correo electrónico (si elige mostrarla, la dirección queda protegida mediante javascript contra los spammers).';
protected $AX_CIT_SADDREL = 'Domicilio';
protected $AX_CIT_SADDRED = 'Muestra u oculta el domicilio.';
protected $AX_CIT_TOWNL = 'Ciudad';
protected $AX_CIT_TOWND = 'Muestra u oculta la ciudad.';
protected $AX_CIT_STATEL = 'Provincia/Estado';
protected $AX_CIT_STATED = 'Muestra u oculta la provincia o el estado.';
protected $AX_CIT_COUNTRL = 'País';
protected $AX_CIT_COUNTRD = 'Muestra u oculta el país.';
protected $AX_CIT_ZIPL = 'Código postal';
protected $AX_CIT_ZIPD = 'Muestra u oculta el código postal.';
protected $AX_CIT_TELL = 'Teléfono';
protected $AX_CIT_TELD = 'Muestra u oculta el número de teléfono.';
protected $AX_CIT_FAXL = 'Fax';
protected $AX_CIT_FAXD = 'Muestra u oculta el número de fax.';
protected $AX_CIT_MISCL = 'Otros datos';
protected $AX_CIT_MISCD = 'Muestra u oculta el campo Otros datos';
protected $AX_CIT_VCARDL = 'vCard';
protected $AX_CIT_VCARDD = 'Muestra u oculta un enlace que permite descargar la información de contacto en formato vCard.';
protected $AX_CIT_CIMGL = 'Imagen';
protected $AX_CIT_CIMGD = 'Muestra u oculta la imagen.';
protected $AX_CIT_DEMAILL = 'Descripción del email';
protected $AX_CIT_DEMAILD = 'Muestra u oculta la descripción de abajo.';
protected $AX_CIT_DTXTL = 'Descripción';
protected $AX_CIT_DTXTD = 'Texto para la descripción del formulario de contacto. Si se deja en blanco, se usará el valor de la variable _EMAIL_DESCRIPTION del archivo de idioma.';
protected $AX_CIT_EMFRML = 'Formulario de contacto';
protected $AX_CIT_EMFRMD = 'Muestra u oculta el formulario de contacto.';
protected $AX_CIT_EMCPYL = 'Enviar copia por email';
protected $AX_CIT_EMCPYD = 'Muestra u oculta la casilla de selección que permite al usuario recibir por correo electrónico una copia de la información remitida a través del formulario.';
protected $AX_CIT_DDL = 'Desplegable';
protected $AX_CIT_DDD = 'Muestra u oculta la lista desplegable de la vista Contactos.';
protected $AX_CIT_ICONTXL = 'Iconos / Texto';
protected $AX_CIT_ICONTXD = 'Para mostrar iconos, texto o nada en los datos de contacto.';
protected $AX_CIT_ICONS = 'Iconos';
protected $AX_CIT_TEXT = 'Texto';
protected $AX_CIT_NONE = 'Ninguno ';
protected $AX_CIT_ADICONL = 'Icono Dirección';
protected $AX_CIT_ADICOND = 'Icono que aparece junto al campo Dirección.';
protected $AX_CIT_EMICONL = 'Icono Email';
protected $AX_CIT_EMICOND = 'Icono que aparece junto al campo Email.';
protected $AX_CIT_TLICONL = 'Icono Teléfono';
protected $AX_CIT_TLICOND = 'Icono que aparece junto al campo Teléfono.';
protected $AX_CIT_FXICONL = 'Icono Fax';
protected $AX_CIT_FXICOND = 'Icono que aparece junto al campo Fax.';
protected $AX_CIT_MCICONL = 'Icono Otros datos';
protected $AX_CIT_MCICOND = 'Icono que aparece junto al campo Otros datos.';
protected $AX_CCT_NAMEL = 'Nombre';
protected $AX_CCT_NAMED = 'Muestra u oculta el nombre.';
protected $AX_CCT_POSITL = 'Cargo';
protected $AX_CCT_POSITD = 'Muestra u oculta el cargo.';
protected $AX_CCT_EMAILL = 'Email';
protected $AX_CCT_EMAILD = 'Muestra u oculta la dirección de correo electrónico. Muestra u oculta la dirección de correo electrónico (si elige mostrarla, la dirección queda protegida mediante javascript contra los spammers).';
protected $AX_CCT_SADDREL = 'Domicilio';
protected $AX_CCT_SADDRED = 'Muestra u oculta el domicilio.';
protected $AX_CCT_TOWNL = 'Ciudad';
protected $AX_CCT_TOWND = 'Muestra u oculta la ciudad.';
protected $AX_CCT_STATEL = 'Provincia/Estado';
protected $AX_CCT_STATED = 'Muestra u oculta la provincia o el estado.';
protected $AX_CCT_COUNTRL = 'País';
protected $AX_CCT_COUNTRD = 'Muestra u oculta el país.';
protected $AX_CCT_ZIPL = 'Código postal';
protected $AX_CCT_ZIPD = 'Muestra u oculta el código postal.';
protected $AX_CCT_TELL = 'Teléfono';
protected $AX_CCT_TELD = 'Muestra u oculta el número de teléfono.';
protected $AX_CCT_FAXL = 'Fax';
protected $AX_CCT_FAXD = 'Muestra u oculta el número de fax.';
protected $AX_CCT_MISCL = 'Otros datos';
protected $AX_CCT_MISCD = 'Muestra u oculta el campo Otros datos';
protected $AX_CCT_VCARDL = 'vCard';
protected $AX_CCT_VCARDD = 'Muestra u oculta un enlace que permite descargar la información de contacto en formato vCard.';
protected $AX_CCT_CIMGL = 'Imagen';
protected $AX_CCT_CIMGD = 'Muestra u oculta la imagen.';
protected $AX_CCT_DEMAILL = 'Descripción del email';
protected $AX_CCT_DEMAILD = 'Muestra u oculta la descripción de abajo.';
protected $AX_CCT_DTXTL = 'Descripción';
protected $AX_CCT_DTXTD = 'Texto para la descripción del formulario de contacto. Si se deja en blanco, se usará el valor de la variable _EMAIL_DESCRIPTION del archivo de idioma.';
protected $AX_CCT_EMFRML = 'Formulario de contacto';
protected $AX_CCT_EMFRMD = 'Muestra u oculta el formulario de contacto.';
protected $AX_CCT_EMCPYL = 'Enviar copia por email';
protected $AX_CCT_EMCPYD = 'Muestra u oculta la casilla de selección que permite al usuario recibir por correo electrónico una copia de la información remitida a través del formulario.';
protected $AX_CCT_DDL = 'Desplegable';
protected $AX_CCT_DDD = 'Muestra u oculta la lista desplegable de la vista Contactos.';
protected $AX_CCT_ICONTXL = 'Iconos / Texto';
protected $AX_CCT_ICONTXD = 'Para mostrar iconos, texto o nada en los datos de contacto.';
protected $AX_CCT_ICONS = 'Iconos';
protected $AX_CCT_TEXT = 'Texto';
protected $AX_CCT_NONE = 'Ninguno';
protected $AX_CCT_ADICONL = 'Icono Dirección';
protected $AX_CCT_ADICOND = 'Icono que aparece junto al campo Dirección.';
protected $AX_CCT_EMICONL = 'Icono Email';
protected $AX_CCT_EMICOND = 'Icono que aparece junto al campo Email.';
protected $AX_CCT_TLICONL = 'Icono Teléfono';
protected $AX_CCT_TLICOND = 'Icono que aparece junto al campo Teléfono.';
protected $AX_CCT_FXICONL = 'Icono Fax';
protected $AX_CCT_FXICOND = 'Icono que aparece junto al campo Fax.';
protected $AX_CCT_MCICONL = 'Icono Otros datos';
protected $AX_CCT_MCICOND = 'Icono que aparece junto al campo Otros datos.';
//com_content/content.xml
protected $AX_CNT_CDESC = 'Esto muestra una sola página de contenido';
protected $AX_CNT_INTEXTL = 'Introducción';
protected $AX_CNT_INTEXTD = 'Muestra u oculta el texto introductorio';
protected $AX_CNT_KEYRL = 'Clave de referencia';
protected $AX_CNT_KEYRD = 'Texto clave con el que se puede hacer referencia a un artículo (p. ej., una referencia de ayuda)';
//com_frontpage/frontpage.xml
protected $AX_FP_CDESC = 'Este componente muestra todos los artículos publicados que están configurados como Mostrar en página de inicio.';
//com_login/login.xml
protected $AX_LG_CDESC = 'Parámetros para los elementos individuales de los contactos.';
protected $AX_LG_LPTL = 'Título de la página de inicio de sesión';
protected $AX_LG_LPTD = 'Texto que aparece al principio de la página. Si se deja en blanco, en su lugar aparecerá el texto del enlace de menú.';
protected $AX_LG_LRURLL = 'URL de redirección tras iniciar sesión';
protected $AX_LG_LRURLD = 'Página a la que será redirigido el usuario cuando inicie una sesión. Si se deja en blanco, será redirigido a la página de inicio.';
protected $AX_LG_LJSML = 'Mensaje JavaScript de inicio de sesión';
protected $AX_LG_LJSMD = 'Muestra u oculta el mensaje JavaScript para indicar que la sesión se ha iniciado correctamente.';
protected $AX_LG_LDESCL = 'Descripción del inicio de sesión';
protected $AX_LG_LDESCD = 'Muestra u oculta la descripción de inicio de sesión de abajo.';
protected $AX_LG_LDESTL = 'Descripción del inicio de sesión';
protected $AX_LG_LDESTD = 'Texto que aparece en la página de inicio de sesión. Si se deja en blanco se usará el valor de la variable _LOGIN_DESCRIPTION del archivo de idioma.';
protected $AX_LG_LIMGL = 'Imagen del inicio de sesión';
protected $AX_LG_LIMGD = 'Imagen que aparece en la página del inicio de sesión.';
protected $AX_LG_LIMGAL = 'Alinear imagen del inicio de sesión';
protected $AX_LG_LIMGAD = 'Alineación de la imagen que aparece en la página del inicio de sesión.';
protected $AX_LG_LOPTL = 'Titulo de la página del cierre de sesión';
protected $AX_LG_LOPTD = 'Texto que aparece al principio de la página. Si se deja en blanco, en su lugar aparecerá el texto del enlace de menú.';
protected $AX_LG_LORURLL = 'URL de redirección tras cerrar sesión';
protected $AX_LG_LORURLD = 'Página a la que será redirigido el usuario cuando cierre una sesión (si se deja en blanco, será redirigido a la página de inicio).';
protected $AX_LG_LOJSML = 'Mensaje JavaScript de cierre de sesión';
protected $AX_LG_LOJSMD = 'Muestra u oculta el mensaje JavaScript para indicar que la sesión se ha cerrado correctamente.';
protected $AX_LG_LODSCL = 'Descripción del cierre de sesión';
protected $AX_LG_LODSCD = 'Texto que aparece en la página de cierre de sesión.';
protected $AX_LG_LODSTL = 'Descripción del cierre de sesión';
protected $AX_LG_LODSTD = 'Texto que aparece en la página de cierre de sesión. Si se deja en blanco se usará el valor de la variable _LOGOUT_DESCRIPTION del archivo de idioma.';
protected $AX_LG_LOGOIL = 'Imagen del cierre de sesión';
protected $AX_LG_LOGOID = 'Imagen que aparece en la página del cierre de sesión.';
protected $AX_LG_LOGOIAL = 'Alinear imagen del cierre de sesión';
protected $AX_LG_LOGOIAD = 'Alineación de la imagen que aparece en la página del inicio de sesión.';
//com_massmail/massmail.xml
protected $AX_MM_CDESC = 'Este componente le permite enviar un email masivo a determinados grupos de usuarios.';
//com_media/media.xml
protected $AX_ME_CDESC = 'Este componente administra los archivos multimedia del sitio.';
//com_menumanager/menumanager.xml
protected $AX_MNU_CDESC = 'Este componente administra los menús.';
//com_menus/component_item_link/component_item_link.xml
protected $AX_MUCIL_CNAME = 'Enlace - Componente';
protected $AX_MUCIL_CDESC = 'Crea un enlace con un componente existente.';
//com_menus/components/components.xml
protected $AX_MUCOMP_CNAME = 'Componente';
protected $AX_MUCOMP_CDESC = 'Muestra la interfaz de un componente.';
//com_menus/contact_category_table/contact_category_table.xml
protected $AX_MUCCT_CNAME = 'Tabla - Categoría de contactos';
protected $AX_MUCCT_CDESC = 'Muestra una tabla con los contactos de una determinada categoría.';
protected $AX_MUCCT_CATDL = 'Descripción de la categoría';
protected $AX_MUCCT_CATDD = 'Muestra u oculta la descripción de las demás categorías.';
//com_menus/contact_item_link/contact_item_link.xml
protected $AX_MUCTIL_CNAME = 'Enlace - Contacto';
protected $AX_MUCTIL_CDESC = 'Crea un enlace con un contacto publicado';
//com_menus/content_archive_category/content_archive_category.xml
protected $AX_MUCAC_CNAME = 'Blog - Categoría de artículos archivados';
protected $AX_MUCAC_CDESC = 'Muestra una lista de los artículos archivados de una determinada categoría.';
//com_menus/content_archive_section/content_archive_section.xml
protected $AX_MUCAS_CNAME = 'Blog - Sección de artículos archivados';
protected $AX_MUCAS_CDESC = 'Muestra una lista de los artículos archivados de una determinada sección.';
//com_menus/content_blog_category/content_blog_category.xml
protected $AX_MUCBC_CNAME = 'Blog - Categoría de artículos';
protected $AX_MUCBC_CDESC = 'Muestra una página de artículos de varias categorías en formato Blog.';
//com_menus/content_blog_section/content_blog_section.xml
protected $AX_MUCBS_CNAME = 'Blog - Sección de artículos';
protected $AX_MUCBS_CDESC = 'Muestra una página de artículos de varias secciones en formato Blog.';
protected $AX_MUCBS_SHSD = 'Muestra u oculta la descripción de la sección.';
//com_menus/content_category/content_category.xml
protected $AX_MUCC_CNAME = 'Tabla - Categoría de artículos';
protected $AX_MUCC_CDESC = 'Muestra una página de artículos de una determinada categoría en formato Tabla.';
protected $AX_MUCC_SHLOCD = 'Muestra u oculta la lista de las demás categorías.';
//com_menus/content_item_link/content_item_link.xml
protected $AX_MCIL_CNAME = 'Enlace - Artículo';
protected $AX_MCIL_CDESC = 'Crea un enlace con la página de un artículo completo publicado.';
//com_menus/content_section/content_section.xml
protected $AX_MCS_CNAME = 'Tabla - Sección de artículos';
protected $AX_MCS_CDESC = 'Crea una lista categorías de artículos de una determinada sección.';
protected $AX_MCS_STL = 'Título de la sección';
protected $AX_MCS_STD = 'Muestra u oculta el título de la sección.';
protected $AX_MCS_SHCTID = 'Muestra u oculta la imagen en la descripción de la categoría.';
//com_menus/content_typed/content_typed.xml
protected $AX_MLSC_CNAME = 'Enlace - Página estática';
protected $AX_MLSC_CDESC = 'Crea un enlace con una página estática.';
//com_menus/newsfeed_category_table/newsfeed_category_table.xml
protected $AX_MNSFC_CNAME = 'Tabla - Categoría de servicios de noticias';
protected $AX_MNSFC_CDESC = 'Muestra una tabla de noticias (proporcionadas por servicios de noticias) de una determinada categoría.';
protected $AX_MNSFC_SHNCD = 'Muestra u oculta la columna Nombre.';
protected $AX_MNSFC_ACL = 'Columna Artículos';
protected $AX_MNSFC_ACD = 'Muestra u oculta la columna Artículos.';
protected $AX_MNSFC_LCL = 'Columna Enlace';
protected $AX_MNSFC_LCD = 'Muestra u oculta la columna Enlaces.';
//com_menus/newsfeed_link/newsfeed_link.xml
protected $AX_MNSFL_CNAME = 'Enlace - Servicio de noticias';
protected $AX_MNSFL_CDESC = 'Crea un enlace con un determinado servicio de noticias.';
protected $AX_MNSFL_FDIML = 'Imagen del servicio de noticias';
protected $AX_MNSFL_FDIMD = 'Muestra u oculta la imagen del servicio de noticias.';
protected $AX_MNSFL_FDDSL = 'Descripción del servicio de noticias';
protected $AX_MNSFL_FDDSD = 'Muestra u oculta la descripción del servicio de noticias.';
protected $AX_MNSFL_WDCL = 'Número de palabras';
protected $AX_MNSFL_WDCD = 'Permite limitar la longitud de la descripción de un servicio de noticias. Si el valor es 0, se muestra todo el texto.';
//com_menus/separator/separator.xml
protected $AX_MSEP_CNAME = 'Separador';
protected $AX_MSEP_CDESC = 'Crea un separador en el menú.';
//com_menus/url/url.xml
protected $AX_MURL_CNAME = 'Enlace - URL';
protected $AX_MURL_CDESC = 'Crea un enlace con una URL.';
//com_menus/weblink_category_table/weblink_category_table.xml
protected $AX_MWLC_CNAME = 'Tabla - Categoría de enlaces web';
protected $AX_MWLC_CDESC = 'Muestra una tabla de enlaces web de una determinada categoría de enlaces web.';
//com_menus/wrapper/wrapper.xml
protected $AX_MWRP_CNAME = 'Wrapper';
protected $AX_MWRP_CDESC = 'Crea un marco IFRAME para mostrar una página web externa.';
protected $AX_MWRP_SCRBL = 'Barras de desplazamiento';
protected $AX_MWRP_SCRBD = 'Muestra u oculta las barras de desplazamiento vertical y horizontal.';
protected $AX_MWRP_WDTL = 'Ancho';
protected $AX_MWRP_WDTD = 'Anchura del marco IFRAME. Se puede especificar un número absoluto expresado en píxeles o un número relativo añadiendo el símbolo %.';
protected $AX_MWRP_HEIL = 'Alto';
protected $AX_MWRP_HEID = 'Altura del marco IFRAME.';
protected $AX_MWRP_AHL = 'Alto automático';
protected $AX_MWRP_AHD = 'La altura se definirá automáticamente en función del tamaño de la página externa. Esto sólo funcionará con páginas de su propio dominio.';
protected $AX_MWRP_AADL = 'Agregar automáticamente';
protected $AX_MWRP_AADD = 'El sistema agrega http:// de forma predeterminada, a no ser que detecte que el usuario ya ha incluido http:// o https:// en la URL. Esta opción permite desactivar esta función.';
//com_menus/system/system.xml
protected $AX_MSYS_CNAME = 'Enlace del sistema';
protected $AX_MSYS_CDESC = 'Crea un enlace con una función del sistema';
//com_newsfeeds/newsfeeds.xml
protected $AX_NFE_CDESC = 'Este componente administra los servicios de noticias RSS/RDF.';
protected $AX_NFE_DPD = 'Descripción de la página';
protected $AX_NFE_SHFNCD = 'Muestra u oculta el nombre de la columna Nombre del servicio de noticias';
protected $AX_NFE_NOACL = 'Columna Artículos';
protected $AX_NFE_NOACD = 'Muestra u oculta el número de artículos del servicio de noticias.';
protected $AX_NFE_LCL = 'Columna Enlace';
protected $AX_NFE_LCD = 'Muestra u oculta la columna Enlace del servicio de noticias.';
protected $AX_NFE_IDL = 'Descripción del artículo';
protected $AX_NFE_IDD = 'Muestra u oculta la descripción o texto introductorio de un artículo.';
//com_search/search.xml
protected $AX_SEAR_CDESC = 'Este componente controla la función de búsqueda.';
//com_syndicate/syndicate.xml
protected $AX_SYN_CDESC = 'Este componente controla los parámetros de la sindicación.';
protected $AX_SYN_CACHL = 'Caché';
protected $AX_SYN_CACHD = 'Almacena en caché los archivos de los servicios de noticias.';
protected $AX_SYN_CACHTL = 'Actualización de la caché';
protected $AX_SYN_CACHTD = 'Intervalo de actualización de la caché, expresado en segundos.';
protected $AX_SYN_ITMSL = 'Artículos';
protected $AX_SYN_ITMSD = 'Número de artículos para sindicar.';
protected $AX_SYN_ITMSDFLT = 'Sindicación de Elxis';
protected $AX_SYN_TITLE = 'Título de la sindicación';
protected $AX_SYN_DESCD = 'Descripción de la sindicación';
protected $AX_SYN_DESCDFLT = 'Sindicación del sitio de Elxis';
protected $AX_SYN_IMGD = 'Imagen que incluir en la noticia sindicada.';
protected $AX_SYN_IMGAL = 'Texto Alt';
protected $AX_SYN_IMGAD = 'Texto Alt de la imagen.';
protected $AX_SYN_IMGADFLT = 'Powered by Elxis';
protected $AX_SYN_LMTL = 'Limitar texto';
protected $AX_SYN_LMTD = 'Limita el texto del artículo al valor especificado a continuación.';
protected $AX_SYN_TLENL = 'Longitud del texto';
protected $AX_SYN_TLEND = 'Número de palabras del texto del artículo. El valor 0 no mostrará ningún texto.';
protected $AX_SYN_LBL = 'Favoritos Firefox';
protected $AX_SYN_LBD = 'Activa la funcionalidad Live Bookmarks del navegador Firefox.';
protected $AX_SYN_BFL = 'Nombre del favorito';
protected $AX_SYN_BFD = 'Nombre de archivo especial. Si se deja en blanco, se utilizará el predeterminado.';
protected $AX_SYN_ORDL = 'Orden';
protected $AX_SYN_ORDD = 'Orden en que aparecen los elementos.';
protected $AX_SYN_MULTIL = 'Servicios de noticias multilingües.';
protected $AX_SYN_MULTILD = 'Si está activada esta opción, Elxis generará servicios de noticias específicos de un idioma.';
//com_trash/trash.xml
protected $AX_TRSH_CDESC = 'Este componente controla el funcionamiento de la papelera.';
//com_typedcontent/typedcontent.xml
protected $AX_TDC_CDESC = 'Esto muestra una sola página de contenido';
//com_weblinks/weblinks.xml
protected $AX_WBL_CDESC = 'Este componente muestra una lista de enlaces web con capturas de pantalla de los sitios.';
protected $AX_WBL_LDL = 'Descripción de los enlaces web';
protected $AX_WBL_LDD = 'Muestra u oculta la descripción de los enlaces web.';
protected $AX_WBL_ICL = 'Icono';
protected $AX_WBL_ICD = 'Icono que aparece a la izquierda de cada enlace web en la vista de Tabla.';
protected $AX_WBL_SCSL = 'Capturas de pantalla';
protected $AX_WBL_SCSD = 'Muestra la captura de pantalla de los sitios enlazados. Si se selecciona opción, no aparecerán los iconos.';
//com_weblinks/weblinks_item.xml
protected $AX_WBLI_TD = 'Ventana en la que se abrirá el enlace al seleccionarlo.';
protected $AX_WBLI_OT01 = 'Misma ventana con barra de navegación';
protected $AX_WBLI_OT02 = 'Ventana nueva con barra de navegación';
protected $AX_WBLI_OT03 = 'Ventana nueva sin barra de navegación';
//ADMINISTRATOR MODULES
//administrator/modules/mod_latest.xml
protected $AX_AM_LN_DESC = 'Este módulo muestra una lista de los últimos artículos publicados que aún estén vigentes (es posible que algunos hayan caducado aunque sean recientes). Los artículos que se muestran en el componente Página de inicio no aparecen en esta lista.'; 
//administrator/modules/mod_logged.xml
protected $AX_AM_LG_DESC = 'Este módulo muestra una lista de los usuarios actualmente conectados.'; 
//administrator/modules/mod_popular.xml
protected $AX_AM_PI_DESC = 'Este módulo muestra una lista de los artículos más visitados que aún están vigentes (es posible que algunos hayan caducado aunque sean los más visitados). Los artículos que se muestran en el componente Página de inicio no aparecen en esta lista.'; 
//administrator/modules/mod_stats.xml
protected $AX_AM_ST_DESC = 'Este módulo muestra las estadísticas de los artículos vigentes (es posible que algunos hayan caducado aunque sean recientes). Los artículos que se muestran en el componente Página de inicio no aparecen en esta lista.'; 
//SITE MODULES
//General
protected $AX_SM_MCSL = 'Sufijo del módulo (CSS)'; 
protected $AX_SM_MCSD = 'Este sufijo se aplicará a los estilos CSS para poder personalizar los estilos del módulo.'; 
protected $AX_SM_MUCSL = 'Sufijo del menú (CSS)'; 
protected $AX_SM_MUCSD = 'Este sufijo se aplicará a los estilos CSS para poder personalizar los estilos del menú.'; 
protected $AX_SM_ECL = 'Activar caché'; 
protected $AX_SM_ECD = 'Elija si desea almacenar en la caché el contenido de este módulo.'; 
protected $AX_SM_SMIL = 'Mostrar iconos de menú'; 
protected $AX_SM_SMID = 'Muestra los iconos que se hayan seleccionado para los enlaces del menú.'; 
protected $AX_SM_MIAL = 'Alinar icono de menú'; 
protected $AX_SM_MIAD = 'Alineación de los iconos del menú'; 
protected $AX_SM_MODL = 'Modo del módulo'; 
protected $AX_SM_MODD = 'Controla el tipo de contenido que desea mostrar en el módulo.'; 
protected $AX_SM_OP01 = 'Sólo artículos'; 
protected $AX_SM_OP02 = 'Sólo páginas estáticas'; 
protected $AX_SM_OP03 = 'Ambos'; 
//modules/custom.xml
protected $AX_SM_CU_DESC = 'Módulo adicional.'; 
protected $AX_SM_CU_RSURL = 'URL RSS'; 
protected $AX_SM_CU_RSURD = 'Especifique la URL del servicio RSS/RDF.'; 
protected $AX_SM_CU_FEDL = 'Descripción del servicio de noticias'; 
protected $AX_SM_CU_FEDD = 'Muestra la descripción de todo el servicio de noticias.'; 
protected $AX_SM_CU_FEIL = 'Imagen del servicio de noticias'; 
protected $AX_SM_CU_FEDID = 'Muestra la imagen asociada con los servicios de noticias.'; 
protected $AX_SM_CU_ITL = 'Artículos'; 
protected $AX_SM_CU_ITD = 'Especifique el número de artículos RSS que desee mostrar.'; 
protected $AX_SM_CU_ITDL = 'Descripción del artículo'; 
protected $AX_SM_CU_ITDD = 'Muestra la descripción o el texto introductorio de las noticias.'; 
protected $AX_SM_CU_WCL = 'Número de palabras'; 
protected $AX_SM_CU_WCD = 'Permite limitar la longitud de la descripción de un servicio de noticias. Si el valor es 0, se muestra todo el texto.'; 
//modules/mod_archive.xml
protected $AX_SM_AR_DESC = 'Este módulo muestra una lista de los meses del calendario, que contienen artículos archivados. Cuando cambie el estado de un artículo a \'archivado\', esta lista se generará automáticamente.'; 
protected $AX_SM_AR_CNTL = 'N.º de artículos'; 
protected $AX_SM_AR_CNTD = 'Número de artículos que aparecen (el valor predeterminado es 10).'; 
//modules/mod_banners.xml
protected $AX_SM_BN_DESC = 'El módulo Banners permite mostrar banners publicitarios en el sitio.'; 
protected $AX_SM_BN_CNTL = 'Cliente del banner'; 
protected $AX_SM_BN_CNTD = "Referencia al ID del cliente del banner. Deben ir separados por comas."; 
protected $AX_SM_BN_NBSL = 'Número de banners mostrados';
protected $AX_SM_BN_NBPRL = 'Número de banners por fila';
protected $AX_SM_BN_NBPRD = 'Número de banners por cada fila. Para desactivar esta opción, especifique 0. Para mostrar los banners verticalmente, especifique 1.';
protected $AX_SM_BN_UNQBL = 'Banners únicos';
protected $AX_SM_BN_UNQBD = 'Si se selecciona esta opción, ninguno de los banners aparece más de una vez en cada cada sesión. Cuando se han mostrado todos los banners, el historial se borra y se reinicia.';
//modules/mod_latestnews.xml
protected $AX_SM_LN_DESC = 'Este módulo muestra una lista de los últimos artículos publicados que aún estén vigentes (es posible que algunos hayan caducado aunque sean recientes). Los artículos que se muestran en el componente Página de inicio no aparecen en esta lista.'; 
protected $AX_SM_LN_FPIL = 'Artículos de la página de inicio'; 
protected $AX_SM_LN_FPID = 'Muestra u oculta los artículos asignados a la página de inicio (sólo funciona en modo Artículos).'; 
protected $AX_SM_AR_CNT5D = 'Número de artículos que aparecen (el valor predeterminado es 5).'; 
protected $AX_SM_LN_CATIL = 'ID de la categoría'; 
protected $AX_SM_LN_CATID = 'Selecciona artículos de una categoría específica o de un grupo de categorías (para especificar más de una categoría, sepárelas con comas).'; 
protected $AX_SM_LN_SECIL = 'ID de la sección'; 
protected $AX_SM_LN_SECID = 'Selecciona artículos de una sección específica o de un grupo de secciones (para especificar más de una sección, sepárelas con comas).'; 
//modules/mod_login.xml
protected $AX_SM_LF_DESC = 'Este módulo muestra un formulario para iniciar una sesión mediante nombre de usuario y contraseña. También muestra un enlace para recuperar una contraseña en caso de que el usuario la haya olvidado. Si está activado el registro de usuarios (consulte la Configuración global), aparecerá otro enlace para invitar a los usuarios a que se registren.'; 
protected $AX_SM_LF_PTL = 'Texto previo'; 
protected $AX_SM_LF_PTD = 'Texto (sin formato o en HTML) que aparece encima del formulario de inicio de sesión.'; 
protected $AX_SM_LF_PSTL = 'Texto posterior'; 
protected $AX_SM_LF_PSTD = 'Texto (sin formato o en HTML) que aparece debajo del formulario de inicio de sesión.'; 
protected $AX_SM_LF_LRUL = 'URL de redirección tras iniciar sesión'; 
protected $AX_SM_LF_LRUD = 'Página a la que será redirigido el usuario cuando cierre una sesión. Si se deja en blanco, será redirigido a la página de inicio.'; 
protected $AX_SM_LF_LORUL = 'URL de redirección tras cerrar sesión'; 
protected $AX_SM_LF_LORUD = 'Página a la que será redirigido el usuario cuando inicie una sesión. Si se deja en blanco, será redirigido a la página de inicio.'; 
protected $AX_SM_LF_LML = 'Mensaje de inicio de sesión'; 
protected $AX_SM_LF_LMD = 'Muestra u oculta el mensaje JavaScript para indicar que la sesión se ha iniciado correctamente.'; 
protected $AX_SM_LF_LOML = 'Mensaje de cierre de sesión'; 
protected $AX_SM_LF_LOMD = 'Muestra u oculta el mensaje JavaScript para indicar que la sesión se ha cerrado correctamente.'; 
protected $AX_SM_LF_GML = 'Saludo'; 
protected $AX_SM_LF_GMD = 'Muestra u oculta el texto del saludo.'; 
protected $AX_SM_LF_NUNL = 'Nombre/Nombre de usuario'; 
protected $AX_SM_LF_OP01 = 'Nombre de usuario'; 
protected $AX_SM_LF_OP02 = 'Nombre'; 
//modules/mod_mainmenu.xml
protected $AX_SM_MNM_DESC = 'Muestra un menú.'; 
protected $AX_SM_MNM_MNL = 'Nombre del menú'; 
protected $AX_SM_MNM_MND = 'El nombre del menú (el menú predeterminado es el \'mainmenu\').'; 
protected $AX_SM_MNM_MSL = 'Estilo de menú'; 
protected $AX_SM_MNM_MSD = 'El estilo del menú.'; 
protected $AX_SM_MNM_OP1 = 'Vertical'; 
protected $AX_SM_MNM_OP2 = 'Horizontal'; 
protected $AX_SM_MNM_OP3 = 'Lista'; 
protected $AX_SM_MNM_EML = 'Expandir menú'; 
protected $AX_SM_MNM_EMD = 'Expande el menú para que estén visibles los enlaces subordinados.'; 
protected $AX_SM_MNM_IIL = 'Imagen de sangrado'; 
protected $AX_SM_MNM_IID = 'Seleccione la imagen que utilizará para sangrar los enlaces subordinados del menú.'; 
protected $AX_SM_MNM_OP4 = 'Plantilla'; 
protected $AX_SM_MNM_OP5 = 'Imágenes predeterminadas del sistema'; 
protected $AX_SM_MNM_OP6 = 'Usar los parámetros de abajo'; 
protected $AX_SM_MNM_OP7 = 'Ninguno'; 
protected $AX_SM_MNM_II1L = 'Imagen de sangrado 1'; 
protected $AX_SM_MNM_II1D = 'Imagen para el primer subnivel.'; 
protected $AX_SM_MNM_II2L = 'Imagen de sangrado 2'; 
protected $AX_SM_MNM_II2D = 'Imagen para el segundo subnivel.'; 
protected $AX_SM_MNM_II3L = 'Imagen de sangrado 3'; 
protected $AX_SM_MNM_II3D = 'Imagen para el tercer subnivel.'; 
protected $AX_SM_MNM_II4L = 'Imagen de sangrado 4'; 
protected $AX_SM_MNM_II4D = 'Imagen para el cuarto subnivel.'; 
protected $AX_SM_MNM_II5L = 'Imagen de sangrado 5'; 
protected $AX_SM_MNM_II5D = 'Imagen para el quinto subnivel.'; 
protected $AX_SM_MNM_II6L = 'Imagen de sangrado 6'; 
protected $AX_SM_MNM_II6D = 'Imagen para el sexto subnivel.'; 
protected $AX_SM_MNM_SPL = 'Espaciador'; 
protected $AX_SM_MNM_SPD = 'Espaciador para el menú horizontal.'; 
protected $AX_SM_MNM_ESL = 'Espaciador final'; 
protected $AX_SM_MNM_ESD = 'Espaciador final para el menú horizontal.';
protected $AX_SM_MNM_IDPR = 'Precargar Itemid SEO Pro';
protected $AX_SM_MNM_IDPRD = 'Al activar la carga previa del Itemid con AJAX se soluciona el problema cuando hay más de un enlace de menú que apunta a la misma página.';
//modules/mod_mostread.xml
protected $AX_SM_MRC_DESC = 'Este módulo muestra una lista de los artículos publicados y vigentes con más visitas.'; 
protected $AX_SM_MRC_MNL = 'Nombre del menú'; 
protected $AX_SM_MRC_MND = 'El nombre del menú (el menú predeterminado es el \'mainmenu\').'; 
protected $AX_SM_MRC_FPIL = 'Artículos de la página de inicio'; 
protected $AX_SM_MRC_FPID = 'Muestra u oculta los artículos asignados a la página de inicio (sólo funciona en modo Artículos).'; 
protected $AX_SM_MRC_CL = 'N.º de artículos'; 
protected $AX_SM_MRC_CD = 'Número de artículos que aparecen (el valor predeterminado es 5).'; 
protected $AX_SM_MRC_CIDL = 'ID de la categoría'; 
protected $AX_SM_MRC_CIDD = 'Selecciona artículos de una categoría específica o de un grupo de categorías (para especificar más de una categoría, sepárelas con comas).'; 
protected $AX_SM_MRC_SIDL = 'ID de la sección'; 
protected $AX_SM_MRC_SIDD = 'Selecciona artículos de una sección específica o de un grupo de secciones (para especificar más de una sección, sepárelas con comas).'; 
//modules/mod_newsflash.xml
protected $AX_SM_NWF_DESC = 'El módulo Flash informativo (Newsflash) muestra aleatoriamente uno de los artículos publicados de una categoría cada vez que se carga la página. También puede mostrar varios artículos en horizontal o en vertical.'; 
protected $AX_SM_NWF_CATL = 'Categoría'; 
protected $AX_SM_NWF_CATD = 'Un categoría de contenidos.'; 
protected $AX_SM_NWF_STL = 'Estilo'; 
protected $AX_SM_NWF_STD = 'El estilo con el que se muestra la categoría.'; 
protected $AX_SM_NWF_OP1 = 'Elegir uno aleatoriamente cada vez'; 
protected $AX_SM_NWF_OP2 = 'Horizontal'; 
protected $AX_SM_NWF_OP3 = 'Vertical'; 
protected $AX_SM_NWF_SIL = 'Mostrar imágenes'; 
protected $AX_SM_NWF_SID = 'Muestra las imágenes en los artículos.'; 
protected $AX_SM_NWF_LTL = 'Enlaces en los títulos'; 
protected $AX_SM_NWF_LTD = 'Convierte los títulos en hipervínculos.'; 
protected $AX_SM_NWF_RML = 'Enlace Continúa... '; 
protected $AX_SM_NWF_RMD = 'Muestra u oculta el enlace Continúa... debajo de los textos introductorios. '; 
protected $AX_SM_NWF_ITL = 'Título del artículo'; 
protected $AX_SM_NWF_ITD = 'Muestra el título del artículo.'; 
protected $AX_SM_NWF_NOIL = 'N.º de artículos'; 
protected $AX_SM_NWF_NOID = 'Número de artículos que desea mostrar.'; 
//modules/mod_poll.xml
protected $AX_SM_POL_DESC = 'Este módulo controla el componente de las encuestas. Se usa para ver las encuestas configuradas. Se diferencia de otros módulos porque el componente permite crear enlaces de menú para las encuestas. Esto significa que el módulo sólo muestra las encuestas que se han configurado para un determinado enlace de menú.'; 
protected $AX_SM_POL_CATL = 'Categoría'; 
protected $AX_SM_POL_CATD = 'Un categoría de contenidos.'; 
//modules/mod_random_image.xml
protected $AX_SM_RNI_DESC = 'Este módulo muestra una imagen al azar    de la carpeta que se especifique.'; 
protected $AX_SM_RNI_ITL = 'Tipo de imagen'; 
protected $AX_SM_RNI_ITD = 'Puede ser png, gif, jpg, etc. (el valor predeterminado es .jpg).'; 
protected $AX_SM_RNI_IFL = 'Carpeta de imágenes'; 
protected $AX_SM_RNI_IFD = 'Ruta de la carpeta de imágenes, relativa a la URL del sitio. Por ejemplo, images/stories.'; 
protected $AX_SM_RNI_LNL = 'Enlace'; 
protected $AX_SM_RNI_LND = 'URL a la que redirique la imagen. Por ejemplo, http://www.elxis.org'; 
protected $AX_SM_RNI_WL = 'Ancho (px)'; 
protected $AX_SM_RNI_WD = 'Anchura de la imagen (esta opción fuerza que todas las imágenes tengan esta anchura).'; 
protected $AX_SM_RNI_HL = 'Alto (px)'; 
protected $AX_SM_RNI_HD = 'Altura de la imagen (esta opción fuerza que todas las imágenes tengan esta altura).'; 
//modules/mod_related_items.xml
protected $AX_SM_RLI_DESC = "Este módulo muestra otros artículos que guardan relación con el artículo mostrado. Se basan en las palabras clave meta que configure en cada artículo. Todas estas palabras clave se contrastan con las del resto de los artículos publicados Por ejemplo, imagine que tiene un artículo sobre \'Hoteles\' y otro sobre \'Vacaciones\'.  Si incluye la palabra clave \'playa\' en ambos artículos, el módulo de artículos relacionados listará el artículo sobre \'hoteles\' cuando el usuario lea el artículo sobre \'vacaciones\', y viceversa. "; 
//modules/mod_rssfeed.xml
protected $AX_SM_RSS_DESC = 'El módulo de sindicación mostrará un enlace para que los usuarios puedan sindicar el sitio y estar al tanto de todas las novedades. Al hacer clic en el icono RSS, aparecerá una página que muestra todos los artículos o noticias más recientes en formato XML. Para usar la sindicación de noticias en cualquier lector de servicios de noticias, es necesario cortar y pegar la URL.'; 
protected $AX_SM_RSS_TXL = 'Texto'; 
protected $AX_SM_RSS_TXD = 'Escriba el texto que desee que aparezca con los enlaces RSS.'; 
protected $AX_SM_RSS_091D = 'Muestra u oculta el enlace RSS 0.91.'; 
protected $AX_SM_RSS_10D = 'Muestra u oculta el enlace RSS 1.0.'; 
protected $AX_SM_RSS_20D = 'Muestra u oculta el enlace RSS 2.0.'; 
protected $AX_SM_RSS_03D = 'Muestra u oculta el enlace Atom 0.3.'; 
protected $AX_SM_RSS_OPD = 'Muestra u oculta el enlace OPML.'; 
protected $AX_SM_RSS_I091L = 'Imagen de RSS 0.91'; 
protected $AX_SM_RSS_I10L = 'Imagen de RSS 1.0'; 
protected $AX_SM_RSS_I20L = 'Imagen de RSS 2.0'; 
protected $AX_SM_RSS_I03L = 'Imagen de Atom'; 
protected $AX_SM_RSS_IOPL = 'Imagen de OPML'; 
protected $AX_SM_RSS_CHID = 'Seleccione la imagen que desee usar.'; 
//modules/mod_search.xml
protected $AX_SM_SEM_DESC = 'Este módulo mostrará un cuadro de búsqueda.';
protected $AX_SM_SEM_TOP = 'Arriba';
protected $AX_SM_SEM_BTM = 'Abajo';
protected $AX_SM_SEM_BWL = 'Ancho del cuadro';
protected $AX_SM_SEM_BWD = 'Tamaño del cuadro de texto del formulario de búsqueda.';
protected $AX_SM_SEM_TXL = 'Texto';
protected $AX_SM_SEM_TXD = 'Texto que aparece en el cuadro del formulario de búsqueda. Si se deja en blanco, se usará el valor de la variable _SEARCH_BOX definida en el archivo de idioma.';
protected $AX_SM_SEM_BPL = 'Posición del botón';
protected $AX_SM_SEM_BPD = 'Posición del botón relativa al cuadro de búsqueda.';
protected $AX_SM_SEM_BTXL = 'Texto del botón';
protected $AX_SM_SEM_BTXD = 'Texto que aparece en el botón de búsqueda. Si se deja en blanco, se usará el valor de la variable _SEARCH_TITLE definida en el archivo de idioma.'; 
//modules/mod_sections.xml
protected $AX_SM_SEC_DESC = 'El módulo Sección muestra una lista de todas las secciones que están configuradas en la base de datos Por secciones deben entenderse solamente las secciones de artículos. Si no se activa la opción \'Mostrar enlaces no autorizados\' en la Configuración global, la lista se limitará a las secciones que el usuario está autorizado a ver.'; 
protected $AX_SM_SEC_CL = 'N.º de artículos';
protected $AX_SM_SEC_CD = 'Número de artículos que aparecen (el valor predeterminado es 5).';
//modules/mod_stats.xml
protected $AX_SM_STA_DESC = 'El módulo de Estadísticas muestra información sobre la instalación del servidor, las estadísticas de los usuarios que visitan el sitio, el número de artículos de la base de datos y el número de enlaces web que ofrece el sitio. ';
protected $AX_SM_STA_SVIL = 'Información del servidor'; 
protected $AX_SM_STA_SVID = 'Muestra información sobre el servidor.'; 
protected $AX_SM_STA_SIL = 'Información del sitio'; 
protected $AX_SM_STA_SID = 'Muestra información sobre el sitio.'; 
protected $AX_SM_STA_HCL = 'Contador de visitas'; 
protected $AX_SM_STA_HCD = 'Muestra el contador de visitas.'; 
protected $AX_SM_STA_ICL = 'Aumentar contador'; 
protected $AX_SM_STA_ICD = 'Escriba el número de visitas con las que quiere incrementar el contador.'; 
//modules/mod_templatechooser.xml
protected $AX_SM_TMC_DESC = 'Este módulo permite al usuario o visitante cambiar la plantilla del sitio sobre la marcha mediante un menú desplegable. '; 
protected $AX_SM_TMC_MNLL = 'Longitud máxima del nombre '; 
protected $AX_SM_TMC_MNLD = 'Longitud máxima del nombre de la plantilla (el valor predeterminado es 20).'; 
protected $AX_SM_TMC_SPL = 'Mostrar miniatura'; 
protected $AX_SM_TMC_SPD = 'Muestra una captura de pantalla en miniatura de la plantilla.'; 
protected $AX_SM_TMC_WL = 'Ancho'; 
protected $AX_SM_TMC_WD = 'Anchura de la miniatura de la plantilla (el valor predeterminado es 140 px).'; 
protected $AX_SM_TMC_HL = 'Alto'; 
protected $AX_SM_TMC_HD = 'Altura de la miniatura de la plantilla (el valor predeterminado es 90 px).'; 
//modules/mod_whosonline.xml
protected $AX_SM_WSO_DESC = 'Este módulo muestra el número de usuarios anónimos y de usuarios registrados que actualmente están visitando el sitio web.'; 
protected $AX_SM_WSO_DL = 'Mostrar'; 
protected $AX_SM_WSO_DD = 'Seleccione lo que desee mostrar.'; 
protected $AX_SM_WSO_OP1 = 'N.º de invitados / registrados<br />'; 
protected $AX_SM_WSO_OP2 = 'Nombres de los usuarios registrados<br />'; 
protected $AX_SM_WSO_OP3 = 'Ambos'; 
//modules/mod_wrapper.xml
protected $AX_SM_WRM_DESC = 'Este módulo muestra un marco IFRAME para albergar una determinada página web externa.'; 
protected $AX_SM_WRM_URLL = 'URL'; 
protected $AX_SM_WRM_URLD = 'URL del sitio o archivo que desee que aparezca dentro del IFRAME.'; 
protected $AX_SM_WRM_SCBL = 'Barras de desplazamiento'; 
protected $AX_SM_WRM_SCBD = 'Muestra u oculta las barras de desplazamiento vertical y horizontal.'; 
protected $AX_SM_WRM_WL = 'Ancho'; 
protected $AX_SM_WRM_WD = 'Altura del marco IFRAME.  Se puede especificar un número absoluto expresado en píxeles o un número relativo añadiendo el símbolo %.'; 
protected $AX_SM_WRM_HL = 'Alto'; 
protected $AX_SM_WRM_HD = 'Altura del marco IFRAME'; 
protected $AX_SM_WRM_AHL = 'Alto automático'; 
protected $AX_SM_WRM_AHD = 'La altura se definirá automáticamente en función del tamaño de la página externa. Esto sólo funcionará con páginas de su propio dominio.'; 
protected $AX_SM_WRM_ADL = 'Agregar automáticamente'; 
protected $AX_SM_WRM_ADD = 'El sistema agrega http:// de forma predeterminada, a no ser que detecte que el usuario ya ha incluido http:// o https:// en la URL. Esta opción permite desactivar esta función.'; 
/* mambots/editors/tinymce */
protected $AX_ED_FUNCTL = 'Funcionalidad'; 
protected $AX_ED_FUNCTD = 'Seleccionar funcionalidad'; 
protected $AX_ED_FUNSIMPLE = 'Simple'; 
protected $AX_ED_FUNADV = 'Avanzada';
protected $AX_ED_EDITORWIDTHL = 'Ancho del editor';
protected $AX_ED_EDITORWIDTHD = 'Anchura de la ventana del editor';
protected $AX_ED_EDITORHEIGHTL = 'Alto del editor';
protected $AX_ED_EDITORHEIGHTD = 'Altura de la ventana del editor';
protected $AX_ED_COMPRESSEDVL = 'Versión comprimida';
protected $AX_ED_COMPRESSEDVD = 'TinyMCE puede funcionar en modo comprimido para agilizar la carga de las páginas. Sin embargo, este modo no siempre funciona, especialmente en Internet Explorer, por lo que está desactivado de manera predeterminada. Si lo activa, compruebe primero que funcione bien en su navegador.';
protected $AX_ED_OFF = 'Desactivado';
protected $AX_ED_ON = 'Activado';
protected $AX_ED_COMPRESSL = 'Compresión';
protected $AX_ED_COMPRESSD = 'Comprime el editor TinyMCE con GZip (se carga un 75% más rápido)';
protected $AX_ED_CONVERTURLL = 'Convertir URLs';
protected $AX_ED_CONVERTURLD = 'Convierte las URL absolutas en relativas.';
protected $AX_ED_ENTENCODL = 'Convertir entidades';
protected $AX_ED_ENTENCODD = 'Controla cómo se procesan las entidades y caracteres especiales dentro de TinyMCE. Puede convertir los caracteres en una representación numérica, en entidades con nombre o no convertirlos. El valor predeterminado es usar entidades con nombre.';
protected $AX_ED_TXTDIRL = 'Direccionalidad';
protected $AX_ED_TXTDIRD = 'Permite cambiar la direccionalidad del texto.';
protected $AX_ED_CNVFONTSPANL = 'Convertir Font en Span';
protected $AX_ED_CNVFONTSPAND = 'Convierte los códigos Font en códigos Span. Esta opción está activada de manera predeterminada, ya que no es aconsejable usar los códigos Font.';
protected $AX_ED_FONTSIZETYPEL = 'Tipo de tamaño de fuente';
protected $AX_ED_FONTSIZETYPED = 'Seleccione el tipo de tamaño de fuente que desee usar. Por ejemplo, de longitud (10pt) o tamaño absoluto (x-small).';
protected $AX_ED_INLTABLEDITL = 'Edición de tablas en línea';
protected $AX_ED_INLTABLEDITD = 'Permite editar las tablas en el mismo editor.';
protected $AX_ED_PROHELEMENTSL = 'Elementos prohibidos';
protected $AX_ED_PROHELEMENTSD = 'Elementos que se depurarán del texto.';
protected $AX_ED_EXTELEMENTSL = 'Elementos ampliados';
protected $AX_ED_EXTELEMENTSD = 'Amplíe la funcionalidad de TinyMCE añadiendo aquí elementos adicionales.  Formato: elemento[código1|código2]';
protected $AX_ED_EVELEMENTSL = 'Elementos de eventos';
protected $AX_ED_EVELEMENTSD = 'Esta opción debe contener una lista de elementos separados por comas, que pueden tener atributos de eventos como Onclick, etc. Esta opción es necesaria, ya que algunos navegadores ejecutan estos eventos mientras se edita el contenido.';
protected $AX_ED_TCSSCLASSESL = 'Clases CSS de plantilla';
protected $AX_ED_TCSSCLASSESD = 'Carga las clases CSS del archivo template_css.css';
protected $AX_ED_CCSSCLASSESL = 'Clases CSS personalizadas';
protected $AX_ED_CCSSCLASSESD = 'Permite cargar un archivo CSS distinto. Simplemente, escriba aquí el nombre del archivo personalizado. Importante: Este archivo debe estar en la misma carpeta que el archivo template_css.css.';
protected $AX_ED_NEWLINESL = 'Nueva línea';
protected $AX_ED_NEWLINESD = 'Código que se inserta al crear nueva línea.';
protected $AX_ED_TOOLBARL = 'Barra de herramientas';
protected $AX_ED_TOOLBARD = 'Posición de la barra de herramientas';
protected $AX_ED_HTMLHEIGHTL = 'Alto ventana HTML';
protected $AX_ED_HTMLHEIGHTD = 'Altura de la ventana emergente que muestra el código fuente HTML del contenido.';
protected $AX_ED_HTMLWIDTHL = 'Ancho ventana HTML';
protected $AX_ED_HTMLWIDTHD = 'Anchura de la ventana emergente que muestra el código fuente HTML del contenido.';
protected $AX_ED_PREVIEWHEIGHTL = 'Alto de vista previa';
protected $AX_ED_PREVIEWHEIGHTD = 'Altura de la ventana emergente de vista previa.';
protected $AX_ED_PREVIEWWIDTHL = 'Ancho de vista previa';
protected $AX_ED_PREVIEWWIDTHD = 'Anchura de la ventana emergente de vista previa.';
protected $AX_ED_IBROWSERL = 'iBrowser';
protected $AX_ED_IBROWSERD = 'iBrowser es un administrador de imágenes avanzado';
protected $AX_ED_PLTABLESL = 'Tablas';
protected $AX_ED_PLTABLESD = 'Permite usar el editor de tablas en modo WYSIWYG.';
protected $AX_ED_PLPASTEL = 'Pegar';
protected $AX_ED_PLPASTED = 'Este plugin activas las opciones Pegar texto desde Word, Pegar texto sin formato y Seleccionar todo.';
protected $AX_ED_PLIMGPLUGINL = 'Imágenes avanzadas ';
protected $AX_ED_PLIMGPLUGIND = 'Este plugin activa el administrador de imágenes avanzado. De manera predeterminada, está activado el Editor de imágenes sencillo.';
protected $AX_ED_PLSEARCHL = 'Buscar/Reemplazar';
protected $AX_ED_PLSEARCHD = 'Ese plugin permite buscar o reemplazar texto.';
protected $AX_ED_PLLINKSL = 'Enlaces avanzados ';
protected $AX_ED_PLLINKSD = 'Activa el administrador de enlaces avanzados. De manera predeterminada, está activado el Editor de enlaces sencillo.';
protected $AX_ED_PLEMOTL = 'Emoticones';
protected $AX_ED_PLEMOTD = 'Plugin para insertar cómodamente emoticones en el contenido.';
protected $AX_ED_PLFLASHL = 'Flash';
protected $AX_ED_PLFLASHD = 'Plugin para insertar archivos multimedia Flash en el contenido.';
protected $AX_ED_PLDTL = 'Fecha/Hora';
protected $AX_ED_PLDTD = 'Activa el plugin de fecha/hora. Permite insertar la fecha y la hora actual en el contenido.';
protected $AX_ED_PLPREVL = 'Vista previa';
protected $AX_ED_PLPREVD = 'Este plugin agrega un botón en TinyMCE. Al hacer clic, se abre una ventana emergente que muestra el contenido actual.';
protected $AX_ED_PLZOOML = 'Zoom';
protected $AX_ED_PLZOOMD = 'Este plugin agrega una lista desplegable de zoom en MS IE 5.5+. (Básicamente, este plugin se creó para enseñar cómo agregar listas desplegables.)';
protected $AX_ED_PLFSCRL = 'Pantalla completa';
protected $AX_ED_PLFSCRD = 'Activa el modo de edición en pantalla completa.';
protected $AX_ED_PLPRINTL = 'Imprimir';
protected $AX_ED_PLPRINTD = 'Agrega un botón para imprimir desde TinyMCE.';
protected $AX_ED_PLDIRL = 'Direccionalidad';
protected $AX_ED_PLDIRD = 'Este plugin agrega iconos de direccionalidad en TinyMCE para controlar mejor los idiomas que se escriben de derecha a izquierda.';
protected $AX_ED_PLFONTSL = 'Tipo de fuentes';
protected $AX_ED_PLFONTSD = 'Este plugin agrega una lista desplegable para seleccionar el tipo de letra.';
protected $AX_ED_PLFONTSZL = 'Tamaño de fuentes';
protected $AX_ED_PLFONTSZD = 'Este plugin agrega una lista desplegable para seleccionar el tamaño de la letra.';
protected $AX_ED_PLFORMLSL = 'Formato';
protected $AX_ED_PLFORMLSD = 'Este plugin agrega una lista desplegable con códigos de formato (H1, H2, etc.). ';
protected $AX_ED_PLSSLL = 'Estilos CSS';
protected $AX_ED_PLSSLD = 'Este plugin agrega una lista desplegable donde aparecen todas las clases del archivo CSS que se especifique.';
protected $AX_ED_NAMED = 'Con nombre';
protected $AX_ED_NUMERIC = 'Numéricas';
protected $AX_ED_RAW = 'No convertir';
protected $AX_ED_LTR = 'Izquierda a derecha';
protected $AX_ED_RTL = 'Derecha a izquierda';
protected $AX_ED_LENGTH = 'Longitud';
protected $AX_ED_ABSSIZE = 'Tamaño absoluto';
protected $AX_ED_BRELEMENTS = 'Elementos BR';
protected $AX_ED_PELEMENTS = 'Elementos P';
//TOOLS
//Calculator: /administrator/tools/calculator/calculator.xml
protected $AX_TCAL_L = 'Calculadora';
protected $AX_TCAL_D = 'Calculadora avanzada (Javascript).';
//Empty Temporary: /administrator/tools/empty_temporary/empty_temporary.xml
protected $AX_TEMTEMP_L = 'Empty Temporary';
protected $AX_TEMTEMP_D = 'Vacía la carpeta temporal del sistema (/tmpr). ';
//FixLanguage: /administrator/tools/fix_language/fix_language.xml
protected $AX_TFIXLANG_L = 'Fix Language';
protected $AX_TFIXLANG_D = 'Realiza una comprobación de las tablas multilingües de la base de datos y aplica las correcciones necesarias.';
//Organizer: /administrator/tools/organizer/organizer.xml
protected $AX_TORGANIZ_L = 'Organizer';
protected $AX_TORGANIZ_D = 'Mantiene un registro de contactos, notas, favoritos y citas.';
//Clean Cache: /administrator/tools/clean_cache/clean_cache.xml
protected $AX_TCLEANCACHE_L = 'Clean Cache ';
protected $AX_TCLEANCACHE_D = 'Vacía la carpeta de la caché y borra todos los artículos e imágenes que contiene.';
//Chmod: /administrator/tools/chmod/chmod.xml
protected $AX_TCHMOD_L = 'Change Mode';
protected $AX_TCHMOD_D = 'Cambia los permisos de un archivo o carpeta determinados.';
//FixPgSequences: /administrator/tools/fix_pg_sequences/fix_pg_sequences.xml
protected $AX_TFPGSEQ_L = 'Fix Postgres Sequences';
protected $AX_TFPGSEQ_D = 'Corrige las secuencias de Postgres si es necesario.';
//Elxis Registration: /administrator/tools/registration/registration.xml
protected $AX_TELXREG_L = 'Registro de Elxis';
protected $AX_TELXREG_D = 'Registra su instalación en Elxis.org en GO UP, Inc.';
//com_menus/bridge/bridge.xml
protected $AX_BRIDGE_CNAME = 'Bridge';
protected $AX_BRIDGE_CDESC = 'Crea un enlace con un Bridge.';
//modules/mod_language.xml
protected $AX_NEW_LINE = 'Nueva línea';
protected $AX_SAME_LINE = 'Misma línea';
protected $AX_INDICATOR = 'Indicador';
protected $AX_INDICATOR_D = 'Muestra la palabra \'Idioma\' como indicador.';
protected $AX_FLAG = 'Bandera';
//modules/mod_language.xml
protected $AX_MODLANGD = 'Muesra el selector de idioma del sitio como un menú desplegable, lista de enlaces o banderas.';
protected $AX_FLAGS = 'Banderas';
protected $AX_SMARTSW = 'Selector inteligente';
protected $AX_SMARTSW_D = 'Permite cambiar el idioma y permanecer en la misma página en determinados casos.';
//modules/mod_random_profile.xml
protected $AX_RP_DESC = 'Mostrar perfiles aleatorios de usuarios';
protected $AX_DISPSTYLE = 'Mostrar estilo';
protected $AX_COMPACT = 'Compacto';
protected $AX_EXTENDED = 'Avanzado';
protected $AX_GENDER = 'Sexo';
protected $AX_GENDERDESC = 'Muestra u oculta si el usuario es hombre o mujer.';
protected $AX_AGE = 'Edad';
protected $AX_AGEDESC = 'Muestra u oculta la edad del usuario.';
protected $AX_REALUNAME = 'Mostrar nombre real o nombre de usuario';
//weblinks item
protected $AX_WBLI_TL = 'Destino';
//content
protected $AX_RTFICL = 'Icono RTF';
protected $AX_RTFICD = 'Muestra u oculta el icono RTF (sólo afecta a esta página). ';
//modules/mod_whosonline.xml
protected $AX_MODWHO_FILGR = 'Filtrar grupos';
protected $AX_MODWHO_FILGRD = 'Si está activada esta opción, los usuarios con menores privilegios de acceso (visitantes) no podrán si están conectados los usuarios registrados.';
//search bots
protected $AX_SEARCH_LIMIT = 'Limitar búsqueda';
protected $AX_MAXNUM_SRES = 'Número máximo de resultados de búsqueda';
//modules/mod_frontpage
protected $AX_MODFRONTPAGE = 'Muestra un resumen de las últimas aportaciones al sitio. Ideal para la página de inicio.'; 
protected $AX_SECTIONS = 'Secciones';
protected $AX_SECTIONSD = 'Los ID de las secciones separados por comas.';
protected $AX_CATEGORIES = 'Categorías';
protected $AX_CATEGORIESD = 'Los ID de las categorías separados por comas.';
protected $AX_NUMDAYS = 'Número de días';
protected $AX_NUMDAYSD = 'Muestra los artículos creados durante los últimos X días (valor predeterminado: 900).';
protected $AX_SHOWTHUMBS = 'Mostrar miniaturas';
protected $AX_SHOWTHUMBSD = 'Muestra u oculta las miniaturas en los textos introductorios';
protected $AX_THUMBWIDTHD = 'Ancho de la miniatura en píxeles';
protected $AX_THUMBHEIGHTD = 'Alto de la miniatura en píxeles ';
protected $AX_KEEPRATIO = 'Mantener proporciones';
protected $AX_KEEPRATIOD = 'Mantiene las proporciones de la imagen. Si está activada esta opción, el parámetro anterior del Alto no tiene ningún efecto.';
//com_menus/eblog_item_link/eblog_item_link.xml
protected $AX_EBLOGITEM = 'eBlog Item';
protected $AX_EBLOGITEMD = 'Creates a link to a published eBlog blog';

//2009.0
protected $AX_COMMENTARY = 'Comentario';
protected $AX_COMMENTARYD = 'Seleccione quién se admite comentar este artículo.';
protected $AX_NOONE = 'Nadie';
protected $AX_REGUSERS = 'Usuarios registrados';
protected $AX_ALL = 'Todos';
protected $AX_COMMENTS = 'Comentarios';
protected $AX_COMMENTSD = '¿Demuestre el número de comentarios?';

}

?>