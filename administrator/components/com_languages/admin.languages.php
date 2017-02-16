<?php 
/**
* @version: $Id: admin.languages.php 2598 2010-03-25 08:58:19Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Languages
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if ((!$acl->acl_check( 'administration', 'config', 'users', $my->usertype )) && (!$acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_languages' ))) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );

$task = trim( strtolower( mosGetParam( $_REQUEST, "task", "" ) ) );
$cid = mosGetParam( $_REQUEST, "cid", array(0) );

if (!is_array( $cid )) {
	$cid = array(0);
}

switch ($task) {
	case "new":
	   mosRedirect( "index2.php?option=com_installer&element=language" );
	break;
	case "anew":
	   mosRedirect( "index2.php?option=com_installer&element=language&client=admin" );
	break;
	case "edit_source":
	   editLanguageSource( $cid[0], $option );
	break;
	case "save_source":
	   saveLanguageSource( $option );
	break;
	case "remove":
	   removeLanguage( $cid[0], $option );
	break;
	case "aremove":
	   removeLanguage( $cid[0], $option, 'admin' );
	break;
	case "publish":
	   publishLanguage( $cid[0], $option );
	break;
	case "unpublish":
	   unpublishLanguage( $cid[0], $option );
	break;
	case "default":
	   defaultLanguage( $cid[0], $option );
	break;
	case "adefault":
	   defaultaLanguage( $cid[0], $option );
	break;
	case "viewalangs":
	   viewaLanguages( $option );
	break;
	case "cancel":
	   mosRedirect( "index2.php?option=$option" );
	break;
	default:
	   viewLanguages( $option );
	break;
}


/*****************************************/
/* PREPARE TO DISPLAY FRONTEND LANGUAGES */
/*****************************************/
function viewLanguages($option) {
    global $adminLanguage, $fmanager, $mainframe, $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

    //get published languages
	$pub_languages = preg_split('/[\,]/', $mainframe->getCfg('pub_langs'), -1, PREG_SPLIT_NO_EMPTY);    

	$rows = array();
	//Read the template dir to find templates
	$languageBaseDir = $fmanager->PathName($mainframe->getCfg('absolute_path').SEP."language");
    
	$rowid = 0;
    $dirs = $fmanager->listFolders($languageBaseDir);

	if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
	foreach ($dirs as $dir) {
		$files = $fmanager->listFiles($languageBaseDir . $dir, '^([_A-Za-z]*)\.xml$');
		if ($files) {
			foreach ($files as $file) {
				$xmlDoc = simplexml_load_file($languageBaseDir.$dir.'/'.$file, 'SimpleXMLElement');
				if (!$xmlDoc) { continue; }
				if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
					if ($xmlDoc->getName() != 'mosinstall') { continue; }
				}
				$ok = false;
				$attrs =  $xmlDoc->attributes();
				if ($attrs) {
					if (isset($attrs['type']) && ($attrs['type'] == 'language')) { $ok = true; }
				}
				if (!$ok) { continue; }

				$row = new stdClass();
				$row->id = $rowid;
				$row->language = substr($file,0,-4);
				$row->name = $xmlDoc->name;
				$row->version = isset($xmlDoc->version) ? $xmlDoc->version : '';
				$row->creationdate = isset($xmlDoc->creationDate) ? $xmlDoc->creationDate : $adminLanguage->A_UNKNOWN;
				$row->author = isset($xmlDoc->author) ? $xmlDoc->author : $adminLanguage->A_UNKNOWN;
				$row->copyright = isset($xmlDoc->copyright) ? $xmlDoc->copyright : '';
				$row->authorEmail = isset($xmlDoc->authorEmail) ? $xmlDoc->authorEmail : '';
				$row->authorUrl = isset($xmlDoc->authorUrl) ? $xmlDoc->authorUrl : '';
				$row->defaultlang = ($mainframe->getCfg('lang') == $row->language) ? 1 : 0;
				$row->published = (in_array($row->language, $pub_languages)) ? 1 : 0;
				$row->checked_out = 0;
				$row->mosname = strtolower(str_replace(" ", "_", $row->name));
				$rows[] = $row;
				$rowid++;
				unset($xmlDoc);
			}
		}
	}

	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( count( $rows ), $limitstart, $limit );

	$rows = array_slice( $rows, $pageNav->limitstart, $pageNav->limit );

	HTML_languages::showLanguages( $rows, $pageNav, $option, $pub_languages );
}


/****************************************/
/* PREPARE TO DISPLAY BACKEND LANGUAGES */
/****************************************/
function viewaLanguages( $option ) {
    global $adminLanguage, $fmanager, $mainframe, $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );  

	$rows = array();
	$rowid = 0;

	//Read the template dir to find templates
	$alangBaseDir = $fmanager->PathName($fmanager->PathName($mainframe->getCfg('absolute_path'))."administrator".SEP."language");
    $dirs = $fmanager->listFolders($alangBaseDir);

	if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
	foreach ($dirs as $dir) {
		$files = $fmanager->listFiles($alangBaseDir.$dir, '^([_A-Za-z]*)\.xml$');
		if ($files) {
			foreach ($files as $file) {
				$xmlDoc = simplexml_load_file($alangBaseDir.$dir.SEP.$file, 'SimpleXMLElement');
				if (!$xmlDoc) { continue; }
				if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
					if ($xmlDoc->getName() != 'mosinstall') { continue; }
				}
				$ok = false;
				$attrs =  $xmlDoc->attributes();
				if ($attrs) {
					if (isset($attrs['type']) && isset($attrs['client']) && ($attrs['type'] == 'language') && ($attrs['client'] == 'administrator')) {
						$ok = true;
					}
				}
				if (!$ok) { continue; }
				$row = new stdClass();
				$row->id = $rowid;
				$row->language = substr($file,0,-4);
				$row->name = $xmlDoc->name;
				$row->version = isset($xmlDoc->version) ? $xmlDoc->version : '';
				$row->creationdate = isset($xmlDoc->creationDate) ? $xmlDoc->creationDate : $adminLanguage->A_UNKNOWN;
				$row->author = isset($xmlDoc->author) ? $xmlDoc->author : $adminLanguage->A_UNKNOWN;
				$row->copyright = isset($xmlDoc->copyright) ? $xmlDoc->copyright : '';
				$row->authorEmail = isset($xmlDoc->authorEmail) ? $xmlDoc->authorEmail : '';
				$row->authorUrl = isset($xmlDoc->authorUrl) ? $xmlDoc->authorUrl : '';
				$row->defaultlang = ($mainframe->getCfg('alang') == $row->language) ? 1 : 0;
				$row->checked_out = 0;
				$row->mosname = strtolower(str_replace(" ", "_", $row->name));
				$rows[] = $row;
				$rowid++;
				unset($xmlDoc);
			}
		}
	}


	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( count($rows), $limitstart, $limit );

	$rows = array_slice($rows, $pageNav->limitstart, $pageNav->limit);

	HTML_languages::showaLanguages( $rows, $pageNav, $option );
}


/**************************************/
/* MAKE A LANGUAGE DEFAULT (FRONTEND) */
/**************************************/
function defaultLanguage( $d_lname, $option ) {
	global $mainframe, $adminLanguage, $fmanager;

    if ($d_lname == $mainframe->getCfg('lang')) {
		mosRedirect("index2.php?option=com_languages", $adminLanguage->A_CMP_LNG_MADF );
    }

	$publangs = explode(',', $mainframe->getCfg('pub_langs'));
    if (!in_array($d_lname, $publangs)) {
        mosRedirect("index2.php?option=com_languages", $adminLanguage->A_CMP_LNG_NMADF );
    }

    $config = '';
	$fp = @fopen($mainframe->getCfg('absolute_path').'/configuration.php',"r");
	while(!feof($fp)){
		$buffer = fgets($fp,4096);
		if (strstr($buffer,"\$mosConfig_lang")){
			$config .= "\$mosConfig_lang = \"$d_lname\";"._LEND;
		} else {
			$config .= $buffer;
		}
	}
	@fclose($fp);

    if ($fmanager->writeFile($mainframe->getCfg('absolute_path').SEP.'configuration.php', $config)) {
		mosRedirect("index2.php?option=com_languages", $adminLanguage->A_CMP_LNG_UPDATED );
	} else {
		mosRedirect("index2.php?option=com_languages", $adminLanguage->A_CMP_LNG_MSURE );
	}
}


/*************************************/
/* MAKE A LANGUAGE DEFAULT (BACKEND) */
/*************************************/
function defaultaLanguage( $d_lname, $option ) {
	global $adminLanguage, $mainframe, $fmanager;

    if ( $d_lname == $mainframe->getCfg('alang')) {
		mosRedirect("index2.php?option=com_languages&task=viewalangs", $adminLanguage->A_CMP_LNG_MADF );
    }

    $config = '';
	$fp = @fopen($mainframe->getCfg('absolute_path').'/configuration.php',"r");
	while(!feof($fp)){
		$buffer = fgets($fp,4096);
		if (strstr($buffer,"\$mosConfig_alang")){
			$config .= "\$mosConfig_alang = \"$d_lname\";"._LEND;
		} else {
			$config .= $buffer;
		}
	}
	@fclose($fp);

    if ($fmanager->writeFile($mainframe->getCfg('absolute_path').SEP.'configuration.php', $config)) {
		mosRedirect("index2.php?option=com_languages&task=viewalangs", $adminLanguage->A_CMP_LNG_UPDATED );
	} else {
		mosRedirect("index2.php?option=com_languages&task=viewalangs", $adminLanguage->A_CMP_LNG_MSURE );
	}
}


/********************/
/* PUBLISH LANGUAGE */
/********************/
function publishLanguage( $p_lname, $option ) {
	global $adminLanguage, $fmanager, $mainframe;

    $oldlangs = explode(',', $mainframe->getCfg('pub_langs'));
    if (in_array($p_lname, $oldlangs)) {
		mosRedirect("index2.php?option=com_languages", $adminLanguage->A_CMP_LNG_LAPUB );    
    }

	array_push( $oldlangs, $p_lname );
    $newpub_langs = implode(",", $oldlangs);
	$config = "";

	$fp = fopen($mainframe->getCfg('absolute_path').'/configuration.php',"r");
	while(!feof($fp)){
		$buffer = fgets($fp,4096);
		if (strstr($buffer,"\$mosConfig_pub_langs")){
			$config .= "\$mosConfig_pub_langs = \"$newpub_langs\";"._LEND;

		} else {
			$config .= $buffer;
		}
	}
	fclose($fp);

    if ($fmanager->writeFile($mainframe->getCfg('absolute_path').SEP.'configuration.php', $config)) {
		mosRedirect("index2.php?option=com_languages", $adminLanguage->A_CMP_LNG_UPDATED );
	} else {
		mosRedirect("index2.php?option=com_languages", $adminLanguage->A_CMP_LNG_MSURE );
	}
}


/**********************/
/* UNPUBLISH LANGUAGE */
/**********************/
function unpublishLanguage( $u_lname, $option ) {
	global $mainframe, $adminLanguage, $fmanager;

    if ($u_lname == $mainframe->getCfg('lang')) {
		mosRedirect("index2.php?option=com_languages", $adminLanguage->A_CMP_LNG_UNPDEF );    
    }
    
    $oldlangs = explode(',', $mainframe->getCfg('pub_langs'));
    
    if ( !in_array( $u_lname, $oldlangs )) {
		mosRedirect("index2.php?option=com_languages", $adminLanguage->A_CMP_LNG_ANPDEF );    
    }

    $newlangs = array();
    foreach ($oldlangs as $xlang) {
    	if ($xlang != $u_lname) {
    		array_push($newlangs, $xlang);
    	}
    }

	$newpub_langs = implode( ',', $newlangs );
	$config = '';

	$fp = @fopen($mainframe->getCfg('absolute_path').'/configuration.php',"r");
	while(!feof($fp)){
		$buffer = @fgets($fp,4096);
		if (strstr($buffer,"\$mosConfig_pub_langs")){
			$config .= "\$mosConfig_pub_langs = \"$newpub_langs\";"._LEND;
		} else {
			$config .= $buffer;
		}
	}
	@fclose($fp);

    if ($fmanager->writeFile($mainframe->getCfg('absolute_path').SEP.'configuration.php', $config)) {
		mosRedirect("index2.php?option=com_languages", $adminLanguage->A_CMP_LNG_UPDATED );
	} else {
		mosRedirect("index2.php?option=com_languages", $adminLanguage->A_CMP_LNG_MSURE );
	}
}


/*******************/
/* DELETE LANGUAGE */
/*******************/
function removeLanguage( $cid, $option, $client='' ) {
	global $mainframe, $adminLanguage;

	$client_id = $client=='admin' ? 1 : 0;

    if ( $client == 'admin' ) {
	   $cur_language = $mainframe->getCfg('alang');
	} else {
		$cur_language = $mainframe->getCfg('lang');
	}

	if ( $cur_language == $cid ) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_CMP_LNG_CANNOT ."\"); window.history.go(-1);</script>\n";
		exit();
	}
	if ( $cid == 'english' ) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert(\"".$adminLanguage->A_CMP_LNG_REMENG."\"); window.history.go(-1);</script>\n";
		exit();
	}

	mosRedirect( 'index2.php?option=com_installer&element=language&client='.$client.'&task=remove&cid[]='.$cid );
}


/***********************************/
/* PREPARE TO EDIT LANGUAGE SOURCE */
/***********************************/
function editLanguageSource( $p_lname, $option) {
    global $adminLanguage, $mainframe;

	$file = stripslashes($mainframe->getCfg('absolute_path').'/language/'.$p_lname.'/'.$p_lname.'.php' );

	if ($fp = @fopen( $file, "r" )) {
		$content = fread( $fp, filesize( $file ) );
		$content = htmlspecialchars( $content );
        @fclose($fp);
		HTML_languages::editLanguageSource( $p_lname, $content, $option );
	} else {
		mosRedirect( 'index2.php?option='.$option, $adminLanguage->A_CMP_LNG_NTOPEN.' '. $file );
	}
}


/************************/
/* SAVE LANGUAGE SOURCE */
/************************/
function saveLanguageSource( $option ) {
    global $adminLanguage, $fmanager, $mainframe;

    $language = trim( mosGetParam( $_POST, 'language', '' ) );
	$filecontent = mosGetParam( $_POST, 'filecontent', '', _MOS_ALLOWHTML );

	if (!$language) {
		mosRedirect( 'index2.php?option='.$option, $adminLanguage->A_CMP_LNG_OPFLED );
	}
	if (!$filecontent) {
		mosRedirect( 'index2.php?option='.$option, $adminLanguage->A_CMP_LNG_FLDEMP );
	}

	$file = $mainframe->getCfg('absolute_path').'/language/'.$language.'/'.$language.'.php';
    $enable_write = mosGetParam($_POST,'enable_write',0);
	$oldperms = fileperms($file);

    if ($enable_write) {
        $fmanager->spChmod($file, '0666');
    }

	clearstatcache();
	if (is_writable( $file ) == false) {
		mosRedirect( "index2.php?option=$option", $adminLanguage->A_CMP_LNG_FLDNOT );
	}

    if ($fmanager->writeFile($file, stripslashes($filecontent))) {
		if ($enable_write) {
			$fmanager->spChmod($file, '0666');
		} else {
			if (mosGetParam($_POST,'disable_write',0)) {
				$fmanager->spChmod($file, '0644');
			}
		} 
		mosRedirect( 'index2.php?option='.$option, $adminLanguage->A_CMP_LNG_UPDATED );
	} else {
		if ($enable_write) {
            $mod = decoct($oldperms);
            $mod = substr($mod, -4);
            $fmanager->spChmod($file, $mod);
        }
		mosRedirect( 'index2.php?option='.$option, $adminLanguage->A_CMP_LNG_FLDWRT );
	}
}

?>