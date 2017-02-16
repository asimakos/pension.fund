<?php 
/**
* @ Version: 2008.0
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Tools
* @ Author: Elxis Team
* @ Translator: Ricard Lozano
* @ Translator URL: http://www.rlozano.com
* @ Description: Spanish language for Updiag tool (hashes help)
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

?>

<p align="justify">Un hash es una huella inequívoca de un archivo. Esta huella cambia incluso al modificar el archivo agregando un espacio. De esta forma, podemos determinar si los archivos del sistema están intactos o si algunos no se han actualizado después de aplicar un parche o actualización. Los hashes también ayudan a restaurar un sitio web de Elxis tras ser atacado por un intruso o ante cualquier anomalía del sistema de archivos. En Elxis se utiliza una manera especial de calcular los hashes MD5. Así, por cada archivo de Elxis hay dos hashes distintos. Si falla la comprobación del primer hash, se comprueba el segundo. Si el segundo hash del archivo también falla, Elxis decide que ese archivo ha sido modificado.</p>

<p align="justify">En cada versión de Elxis hay tres tipos distintos de archivos hash: <b>normal</b> (para sitios que ya están en funcionamiento), <b>extendido</b> (para después de una instalación limpia de Elxis), y <b>}completo</b> (sólo para casos especiales). <u>Para los sitios que están online se debe utilizar el hash normal.</u> El <b>Equipo de Elxis</b> es el único personal autorizado a producir estos archivos hash. No utilice nunca archivos hash de fuentes no autorizadas. Tampoco debe modificar ni cambiar de nombre manualmente estos archivos. Los archivos hash para su versión de Elxis puede descargarlos del sitio web <a href="http://www.elxis.org" target="blank">elxis.org</a>.</p>

<p align="justify">Para instalar un archivo hash, simplemente súbalo a la carpeta hashes(/administrator/tool/updiag/data/hashes). Puede comprobar la integridad del sistema de archivos en cualquier momento usando un archivo hash que tenga instalado y que corresponda a su versión de Elxis. Para ello, haga clic en el botón Ejecutar.</p>
