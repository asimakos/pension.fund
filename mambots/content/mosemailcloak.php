<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Bots/Content
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Mambot that Cloaks all emails in content from spambots via javascript
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onPrepareContent', 'botMosEmailCloak' );

/********************/
/* BOT EMAIL CLOACK */
/********************/
function botMosEmailCloak( $published, &$row, $params, $page=0 ) {
	global $database, $_MAMBOTS;

	//check if we need to proceed further
	if ( !$published || ( strpos( $row->text, '@' ) === false )) {
		return true;
	}

	//check if param query has previously been processed
	if ( !isset($_MAMBOTS->_content_bot_params['mosemailcloak']) ) {
		//load bot params info
		$query = "SELECT params FROM #__mambots WHERE element = 'mosemailcloak' AND folder = 'content'";
		$database->setQuery( $query, '#__', 1, 0 );
		$database->loadObject($mambot);	

		$_MAMBOTS->_content_bot_params['mosemailcloak'] = $mambot;
	}

	$mambot = $_MAMBOTS->_content_bot_params['mosemailcloak'];

 	$params = new mosParameters( $mambot->params );
 	$mode = $params->def( 'mode', 1 );

 	$search 	= "([[:alnum:]_\.\-]+)(\@[[:alnum:]\.\-]+\.+)([[:alnum:]\.\-]+)";
 	$search_text = "([[:alnum:][:space:][:punct:]][^<>]+)";
 
	//search for derivativs of link code <a href="mailto:email@amail.com">email@amail.com</a>
	//extra handling for inclusion of title and target attributes either side of href attribute
	$searchlink	= "/(<a [[:alnum:] _\"\'=\@\.\-]*href=[\"\']mailto:". $search ."[\"\'][[:alnum:] _\"\'=\@\.\-]*>)". $search ."<\/a>/i";
	while( preg_match( $searchlink, $row->text, $regs ) ) {
		$mail 		= $regs[2] . $regs[3] . $regs[4];
		$mail_text 	= $regs[5] . $regs[6] . $regs[7];
		
		//check to see if mail text is different from mail addy
		if ( $mail_text ) {			
			$replacement = mosHTML::emailCloaking( $mail, $mode, $mail_text );
		} else {
			$replacement = mosHTML::emailCloaking( $mail, $mode );
		}		
		
		//replace the found address with the js cloacked email
		$row->text = eUTF::utf8_str_replace( $regs[0], $replacement, $row->text );		
	}
	
	//search for derivativs of link code <a href="mailto:email@amail.com">anytext</a>
	//extra handling for inclusion of title and target attributes either side of href attribute
	$searchlink	= "/(<a [[:alnum:] _\"\'=\@\.\-]*href=[\"\']mailto:". $search ."[\"\'][[:alnum:] _\"\'=\@\.\-]*)>". $search_text ."<\/a>/i";
	while(preg_match($searchlink, $row->text, $regs)) {
		$mail 		= $regs[2] . $regs[3] . $regs[4];
		$mail_text 	= $regs[5];
		
		$replacement = mosHTML::emailCloaking( $mail, $mode, $mail_text, 0 );
		
		//replace the found address with the js cloacked email
		$row->text = eUTF::utf8_str_replace( $regs[0], $replacement, $row->text );
	}

	//search for plain text email@amail.com
	while(preg_match("/([[:alnum:]_\.\-]+)(\@[[:alnum:]\.\-]+\.+)([[:alnum:]\.\-]+)/i", $row->text, $regs)) {
		$mail = $regs[0];

		$replacement = mosHTML::emailCloaking( $mail, $mode );

		//replace the found address with the js cloacked email
		$row->text = eUTF::utf8_str_replace( $regs[0], $replacement, $row->text );
	}

	//xhtml validation, noscript outside text
	$row->text .= '<noscript>'._CLOAKING.'</noscript>'._LEND;
}

?>