<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Language
* @author: Elxis Team
* @translator: Ricard Lozano
* @link: http://www.rlozano.com
* @email: ricard@rlozano.com
* @description: Spanish user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_spanish {

	public $_ON_NEW_CONTENT = "[ %s ] ha publicado un artículo nuevo titulado [ %s ], que corresponde a la sección [ %s ], categoría [ %s ].";
	public $_E_COMMENTS = 'Comentarios';
	public $_DATE = 'Fecha';
	public $_E_SUBCONWAIT = 'Artículos enviados a la espera de aprobación:';
	public $_E_CONTENTSUB = 'Envío de contenido';
	public $_MAIL_SUB = 'Nueva aportación de un usuario';
	public $_E_HI = 'Hola';
	public $_E_NEWSUBBY = "El usuario %s ha enviado una nueva aportación.";
	public $_E_TYPESUB = 'Tipo de aportación:';
	public $_E_TITLE = 'Título';
	public $_E_LOGINAPPR = 'Entre en el panel de administración para aprobar esta aportación.';
	public $_E_DONTRESPOND = 'Le rogamos que no responda a este mensaje, ya que se ha generado automáticamente y es meramente informativo.';
	public $_E_NEWPASS_SUB = "Nueva contraseña para %s";
	public $_E_RPASS_NADMIN = "El usuario % ha solicitado recuperar su contraseña y el sistema le ha enviado una nueva. 
	Si no desea recibir notificación para este tipo de acciones, vaya a SoftDisk  y configure el USERS_RPASSMAIL con el valor No.";
	public $_E_SEND_SUB = "Datos de la cuenta de %s en %s";
	public $_ASEND_MSG = "Hola, %s. \n\nSe ha registrado un nuevo usuario en %s. Este correo contiene sus datos:  Nombre: %s - Email: %s - Usuario: %s Le rogamos que no responda a este mensaje, ya que se ha generado automáticamente y es meramente informativo.";
	public $_NEW_MESSAGE = 'Tiene un mensaje nuevo.';
	public $_NEW_PRMSGF = "Tiene un mensaje nuevo de %s.";
	public $_LOG_READMSG = 'Entre en la consola de administración para leerlo.';
	public $_SUBCON_APPRNTF = 'Submitted content approval notification';
	public $_SUBCON_ATAPPR = 'Your submitted content at %s was approved.';
	public $_SECTION = 'Sección';
	public $_CATEGORY = 'Categoría';

	//elxis 2008.1
	public $_MANAPPROVE = '¡Para que el nuevo usuario pueda le abra una sesión debe aprobar manualmente su registro!';
	public $_ACCUNBLOCK = "Su cuenta en %s ha sido activada por un administrador del sitio. Usted puede ahora abrirse una sesión como %s";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'Nueva notificación del comentario';
	public $_E_NEWCOMBYTITLE = "Un nuevo comentario ha sido fijado por %s en un artículo el suyo %s titulado";
	public $_E_COMSTAYUNPUB = 'Este comentario permanecerá inédito hasta que usted o un administrador estupendo lo publique.';
	public $_E_ACCEXPDATE = 'Fecha de vencimiento de la cuenta';

	public function __construct() {
	}

}

?>