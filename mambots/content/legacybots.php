<?php 
/**
* @version: $Id: legacybots.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Bots/Content
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Process any legacy bots in the /mambots directory
* THIS FILE CAN BE **SAFELY REMOVED** IF YOU HAVE NO LEGACY MAMBOTS
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onPrepareContent', 'botLegacyBots' );

/*
* @param object A content object
* @param int A bit-wise mask of options
* @param int The page number
*/
function botLegacyBots( $published, &$row, $params, $page=0 ) {
	global $mosConfig_absolute_path, $fmanager;

	//process any legacy bots
	$bots = $fmanager->listFiles($mosConfig_absolute_path."/mambots", "\.php$");
	sort($bots);
	foreach ($bots as $bot) {
		require_once ($mosConfig_absolute_path.'/mambots/'.$bot);
	}
}

?>