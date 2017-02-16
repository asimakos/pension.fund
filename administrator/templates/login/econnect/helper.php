<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: eConnect login screen
* @author: Elxis Team
* @email: datahell [at] elxis [dot] org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
********* ATTENTION: THIS FILE MUST BE SAVED AS UTF-8 **********
*
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


function econnect_langname($lng) {
	$native_langs = array(
		'burgarian' => 'Български',
		'czech' => 'Český',
		'danish' => 'Dansk',
		'croatian' => 'Hrvatski',
		'english' => 'English',
		'french' => 'Français',
		'german' => 'Deutsch',
		'greek' => 'Ελληνικά',
		'indonesian' => 'Indonesia', 
		'italian' => 'Italiano', 
		'japanese' => '日本語', 
		'polish' => 'Polski', 
		'portuguese' => 'Português',
		'russian' => 'Русский',
		'serbian' => 'Serbian',
		'slovenian' => 'Slovenščina',
		'romanian' => 'Român',
		'spanish' => 'Español', 
		'srpski' => 'Српски', 
		'turkish' => 'Türk' 
	);

	return (isset($native_langs[$lng])) ? $native_langs[$lng] : ucfirst($lng);
}


function econnect_flag($lng) {
	global $mainframe;

	if (file_exists($mainframe->getCfg('absolute_path').'/administrator/templates/login/econnect/images/flags/'.$lng.'.png')) {
		return $mainframe->getCfg('ssl_live_site').'/administrator/templates/login/econnect/images/flags/'.$lng.'.png';
	} else {
		return $mainframe->getCfg('ssl_live_site').'/administrator/templates/login/econnect/images/flags/flag_un.png';
	}
}

?>