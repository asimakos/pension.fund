<?php 
/**
* @version: $Id: moscode.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Bots/Content
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Code Highlighting Mambot
* @usage: <code>{moscode}...some code...{/moscode}</code>
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onPrepareContent', 'botMosCode' );

/***************/
/* BOT MOSCODE */
/***************/
function botMosCode( $published, &$row, $params, $page=0 ) {
    //check if it is needed to process more
	if ( strpos( $row->text, 'moscode' ) === false ) { return true; }

	//define the regular expression for the bot
	$regex = "#{moscode}(.*?){/moscode}#s";

	if (!$published) {
		$row->text = preg_replace( $regex, '', $row->text );
		return;
	}
	//perform the replacement
	$row->text = preg_replace_callback( $regex, 'botMosCode_replacer', $row->text );

	return true;
}


/********************/
/* MOSCODE REPLACER */
/********************/
function botMosCode_replacer( &$matches ) {
	$html_entities_match = array("#<#", "#>#");
	$html_entities_replace = array("&lt;", "&gt;");

	$text = $matches[1];

	$text = preg_replace($html_entities_match, $html_entities_replace, $text );

	//Replace 2 spaces with "&nbsp; " so non-tabbed code indents without making huge long lines.
	$text = str_replace("  ", "&nbsp; ", $text);
	//now Replace 2 spaces with " &nbsp;" to catch odd #s of spaces.
	$text = str_replace("  ", " &nbsp;", $text);

	//Replace tabs with "&nbsp; &nbsp;" so tabbed code indents sorta right without making huge long lines.
	$text = str_replace("\t", "&nbsp; &nbsp;", $text);

	$text = str_replace('&lt;', '<', $text);
	$text = str_replace('&gt;', '>', $text);

	$text = highlight_string( $text, 1 );

	$text = str_replace('&amp;nbsp;', '&nbsp;', $text);
	$text = str_replace('&lt;br/&gt;', '<br />', $text);
	$text = str_replace('<font color="#007700">&lt;</font><font color="#0000BB">br</font><font color="#007700">/&gt;','<br />', $text);
	$text = str_replace('&amp;</font><font color="#0000CC">nbsp</font><font color="#006600">;', '&nbsp;', $text);
	$text = str_replace('&amp;</font><font color="#0000BB">nbsp</font><font color="#007700">;', '&nbsp;', $text);
	$text = str_replace('<font color="#007700">;&lt;</font><font color="#0000BB">br</font><font color="#007700">/&gt;','<br />', $text);

	return $text;
}
?>