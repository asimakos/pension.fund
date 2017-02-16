<?php 
/**
* @version: $Id: mossef.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Bots/Content
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: SEF Mambot Converts internal relative links to SEF URLs
* @usage:
* <a href="...relative link...">
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onPrepareContent', 'botMosSef' );


/**************/
/* MOSSEF BOT */
/**************/
function botMosSef( $published, &$row, $params, $page=0 ) {
	global $mosConfig_absolute_path, $mosConfig_live_site, $mosConfig_sef;

	//check if we need to proceed further
	if ( !$published ) { return true; }
	if ( !$mosConfig_sef ) { return true; }
	if ( strpos( $row->text, 'href="' ) === false ) { return true; }

	//define the regular expression for the bot
	$regex = "#href=\"(.*?)\"#s";

	//perform the replacement
	$row->text = preg_replace_callback( $regex, 'botMosSef_replacer', $row->text );

	return true;
}


/*******************/
/* MOSSEF REPLACER */
/*******************/
function botMosSef_replacer( &$matches ) {
	if ( substr($matches[1],0,1)=="#" ) {
		//anchor
		$temp = preg_split("/index\.php/", $_SERVER['REQUEST_URI']);
		return "href=\"".sefRelToAbs("index.php".@$temp[1]).$matches[1]."\"";
	} else {
		return "href=\"".sefRelToAbs($matches[1])."\"";
	}
}
?>