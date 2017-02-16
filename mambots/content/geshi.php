<?php 
/**
* @version: $Id: geshi.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Bots/Content
* @Author URL: http://www.qbnz.com/highlighter
* @link: http://www.elxis.org - http://www.goup.gr
* @ email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Code Highlighting Mambot. Replaces <pre>...</pre> tags with highlighted text
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onPrepareContent', 'botGeshi' );


/************************/
/* CODE HIGHLIGHTER BOT */
/************************/
function botGeshi( $published, &$row, $params, $page=0 ) {
	require_once( $GLOBALS['mosConfig_absolute_path'].'/includes/domit/xml_saxy_shared.php' );

	//check if it is needed to proccess text
	if ( !$published || (strpos( $row->text, '<pre' ) === false )) { return true; }

	//define the regular expression for the bot
	$regex = "#<pre\s*(.*?)>(.*?)</pre>#s";

	$GLOBALS['_MAMBOT_GESHI_PARAMS'] =& $params;

	//perform the replacement
	$row->text = preg_replace_callback( $regex, 'botGeshi_replacer', $row->text );
	return true;
}


/**********************/
/* GESHI BOT REPLACER */
/**********************/
function botGeshi_replacer( &$matches ) {
	$params =& $GLOBALS['_MAMBOT_GESHI_PARAMS'];
	include_once( dirname( __FILE__ ) . '/geshi/geshi.php' );

	$args = SAXY_Parser_Base::parseAttributes( $matches[1] );
	$text = $matches[2];

	$lang = mosGetParam( $args, 'lang', 'php' );
	$lines = mosGetParam( $args, 'lines', 'false' );

	$html_entities_match = array( "|\<br \/\>|", "#<#", "#>#", "|&#39;|", '#&quot;#', '#&nbsp;#' );
	$html_entities_replace = array( "\n", '&lt;', '&gt;', "'", '"', ' ' );

	$text = preg_replace( $html_entities_match, $html_entities_replace, $text );

	$text = str_replace('&lt;', '<', $text);
	$text = str_replace('&gt;', '>', $text);

	//Replace tabs with "&nbsp; &nbsp;" so tabbed code indents sorta right without making huge long lines.
	//$text = str_replace("\t", "&nbsp; &nbsp;", $text);
	$text = str_replace( "\t", '  ', $text );

	$geshi = new GeSHi( $text, $lang, dirname( __FILE__ ).'/geshi/geshi' );
	$geshi->set_encoding('UTF-8');
	if ($lines == 'true') {
		$geshi->enable_line_numbers( GESHI_NORMAL_LINE_NUMBERS );
	}
	$text = $geshi->parse_code();

	return $text;
}

?>