<?php 
/**
* @ Version: $Id: mod_mosmsg.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Module MosMsg
* @ Author: Elxis Team
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$mosmsg = trim( strip_tags( mosGetParam( $_REQUEST, 'mosmsg', '' ) ) );

if ($mosmsg) {
	if (!get_magic_quotes_gpc()) { $mosmsg = addslashes( $mosmsg ); }
	echo '<div align="center">'._LEND;
	echo '<div class="message">'.$mosmsg.'</div>'._LEND;
	echo '</div>'._LEND;
}
?>