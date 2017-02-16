<?php 
/**
* @version: $Id: admin.templates.php 56 2010-06-13 09:19:34Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Templates
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


// ensure user has access to this function
if (!$acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_templates' )) {
    mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

require_once($mainframe->getPath('admin_html'));
require_once($mainframe->getCfg('absolute_path').'/administrator/components/com_templates/admin.templates.class.php' );

$task = trim(strtolower(mosGetParam($_REQUEST, 'task', '')));
$cid = mosGetParam($_REQUEST, "cid", array(0));
$client = mosGetParam($_REQUEST, 'client', '');

if (!is_array( $cid )) {
	$cid = array(0);
}

switch ($task) {
	case 'new':
		mosRedirect( 'index2.php?option=com_installer&element=template&client='. $client );
	break;
	case 'edit_source':
		editTemplateSource($cid[0], $option, $client);
	break;
	case 'save_source':
		saveTemplateSource($option, $client);
	break;
	case 'edit_css':
		editTemplateCSS($cid[0], $option, $client);
	break;
	case 'save_css':
		saveTemplateCSS($option, $client);
	break;
	case 'edit_params':
		editTemplateParams($cid[0], $option, $client);
	break;
	case 'edit_paramsa':
		$tpldir = (string)mosGetParam($_GET, 'tpldir', '');
		editTemplateParams($tpldir, $option, $client);
	break;
	case 'apply_params':
		saveTemplateParams($option, $client, 1);
	break;
	case 'save_params':
		saveTemplateParams($option, $client, 0);
	break;
	case 'remove':
		removeTemplate($cid[0], $option, $client);
	break;
	case 'publish':
		defaultTemplate($cid[0], $option, $client);
	break;
	case 'default':
		defaultTemplate($cid[0], $option, $client);
	break;
	case 'assign':
		assignTemplate($cid[0], $option, $client);
	break;
	case 'save_assign':
		saveTemplateAssign( $option, $client );
	break;
	case 'cancel':
		mosRedirect( 'index2.php?option='. $option .'&client='. $client );
	break;
	case 'positions':
	    editPositions();
	break;
	case 'save_positions':
	    savePositions();
	break;
	default:
		viewTemplates( $option, $client );
	break;
}


/********************************/
/* PREPARE TO DISPLAY TEMPLATES */
/********************************/
function viewTemplates($option, $client) {
	global $database, $mainframe, $fmanager, $mosConfig_list_limit, $adminLanguage;

	$limit = $mainframe->getUserStateFromRequest( 'viewlistlimit', 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

	if ($client == 'admin') {
		$templateBaseDir = $fmanager->PathName($mainframe->getCfg('absolute_path').'/administrator/templates/admin' );
	} else if ($client == 'login') {
		$templateBaseDir = $fmanager->PathName($mainframe->getCfg('absolute_path').'/administrator/templates/login' );
	} else {
		$templateBaseDir = $fmanager->PathName($mainframe->getCfg('absolute_path').'/templates' );
	}

	$rows = array();
	//Read the template dir to find templates
	$templateDirs = $fmanager->listFolders($templateBaseDir);

	$id = intval($client == 'admin');

	if ($client=='admin') {
		$database->setQuery( "SELECT template FROM #__templates_menu WHERE client_id='1' AND menuid='0'" );
	} else if ($client == 'login') {
		$database->setQuery( "SELECT template FROM #__templates_menu WHERE client_id='2' AND menuid='0'" );	  
	} else {
		$database->setQuery( "SELECT template FROM #__templates_menu WHERE client_id='0' AND menuid='0'" );
	}
	$cur_template = $database->loadResult();

	$rowid = 0;
	//Check that the directory contains an xml file
	foreach($templateDirs as $templateDir) {
		$dirName = $fmanager->PathName($templateBaseDir . $templateDir);
		$xmlFilesInDir = $fmanager->listFiles($dirName,'.xml');

		if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
		foreach($xmlFilesInDir as $xmlfile) {
			$xmlDoc = simplexml_load_file($dirName.$xmlfile, 'SimpleXMLElement');
			if (!$xmlDoc) { continue; } //for Debug: use libxml_get_errors() to catch errors
			if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
				if ($xmlDoc->getName() != 'mosinstall') { continue; }
			}
			$attrs =  $xmlDoc->attributes();
			$ok = false;
			if ($attrs) {
				if (isset($attrs['type']) && ($attrs['type'] == 'template')) { $ok = true; }
			}
			if (!$ok) { continue; }

			$row = new stdClass();
			$row->id = $rowid;
			$row->directory = $templateDir;
			$row->name = (string)$xmlDoc->name;
			$row->creationdate = isset($xmlDoc->creationDate) ? (string)$xmlDoc->creationDate : $adminLanguage->A_UNKNOWN;
			$row->author = isset($xmlDoc->author) ? (string)$xmlDoc->author : $adminLanguage->A_UNKNOWN;
			$row->copyright = isset($xmlDoc->copyright) ? (string)$xmlDoc->copyright : '';
			$row->authorEmail = isset($xmlDoc->authorEmail) ? (string)$xmlDoc->authorEmail : '';
			$row->authorUrl = isset($xmlDoc->authorUrl) ? (string)$xmlDoc->authorUrl : '';
			$row->version = isset($xmlDoc->version) ? (string)$xmlDoc->version : '';
			$row->published	= ($cur_template == $templateDir) ? 1 : 0;
			$row->checked_out = 0;
			$row->mosname = strtolower(str_replace(' ', '_', $row->name));
			unset($xmlDoc);

			//check if template is assigned
			$database->setQuery("SELECT COUNT(*) FROM #__templates_menu WHERE client_id='0' AND template='".$row->directory."' AND menuid<>'0'" );
			$row->assigned = $database->loadResult() ? 1 : 0;

			$rows[] = $row;
			unset($row);
			$rowid++;
		}
	}

	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav(count($rows), $limitstart, $limit);

	$rows = array_slice($rows, $pageNav->limitstart, $pageNav->limit);

	HTML_templates::showTemplates( $rows, $pageNav, $option, $client );
}


/*********************************/
/* PUBLISH/MAKE DEFAULT TEMPLATE */
/*********************************/
function defaultTemplate($p_tname, $option, $client) {
	global $database;

	if ($client=='admin') {
		$database->setQuery("DELETE FROM #__templates_menu WHERE client_id='1' AND menuid='0'");
		$database->query();

		$database->setQuery("INSERT INTO #__templates_menu VALUES ('$p_tname','0','1', NULL)");
		$database->query();
	} else if ($client=='login') {
		$database->setQuery("DELETE FROM #__templates_menu WHERE client_id='2' AND menuid='0'");
		$database->query();
        
        $database->setQuery("INSERT INTO #__templates_menu VALUES ('$p_tname','0','2', NULL)");
		$database->query();
	} else {
		$database->setQuery("DELETE FROM #__templates_menu WHERE client_id='0' AND menuid='0'");
		$database->query();
        
        $database->setQuery("INSERT INTO #__templates_menu VALUES ('$p_tname','0','0', NULL)");
		$database->query();

		$_SESSION['cur_template'] = $p_tname;
	}

	mosRedirect('index2.php?option='.$option.'&client='.$client);
}


/*******************/
/* REMOVE TEMPLATE */
/*******************/
function removeTemplate( $cid, $option, $client ) {
	global $database, $adminLanguage, $mainframe;

	switch ( $client ) {
		case 'admin':
		$client_id = 1;
		break;
		case 'login':
		$client_id = 2;
		break;
		default:
		$client_id = 0;
		break;
	}
			
	$database->setQuery("SELECT template FROM #__templates_menu WHERE client_id='$client_id' AND menuid='0'");
	$cur_template = $database->loadResult();

	if ($cur_template == $cid) {
		$mainframe->checkSendHeaders();
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_CMP_TMP_CANNOT ."\"); window.history.go(-1);</script>\n";
		exit();
	}

	//Un-assign
	$database->setQuery( "DELETE FROM #__templates_menu WHERE template='$cid' AND client_id='$client_id' AND menuid<>'0'" );
	$database->query();

	mosRedirect( 'index2.php?option=com_installer&element=template&client='. $client .'&task=remove&cid[]='. $cid );
}


/***********************************/
/* PREPARE TO EDIT TEMPLATE SOURCE */
/***********************************/
function editTemplateSource( $p_tname, $option, $client ) {
	global $mainframe, $adminLanguage, $fmanager;

	if ( $client == 'admin' ) {
		$file = $mainframe->getCfg('absolute_path').'/administrator/templates/admin/'.$p_tname.'/index.php';
	} else if ( $client == 'login' ) {
		$file = $mainframe->getCfg('absolute_path').'/administrator/templates/login/'.$p_tname.'/index.php';
	} else {
		$file = $mainframe->getCfg('absolute_path').'/templates/'.$p_tname.'/index.php';
	}
    
    if ($content = $fmanager->readFile( $file )) {
		$content = htmlspecialchars( $content );

		HTML_templates::editTemplateSource( $p_tname, $content, $option, $client );
	} else {
		mosRedirect( 'index2.php?option='.$option.'&client='.$client, $adminLanguage->A_CMP_TMP_NTOPEN.' '.$file );
	}
}


/************************/
/* SAVE TEMPLATE SOURCE */
/************************/
function saveTemplateSource( $option, $client ) {
	global $mainframe, $adminLanguage, $fmanager;

	$template = mosGetParam( $_POST, 'template', '' );
	$filecontent = mosGetParam( $_POST, 'filecontent', '', _MOS_ALLOWHTML );

	if ( !$template ) {
		mosRedirect( 'index2.php?option='.$option.'&client='.$client, $adminLanguage->A_CMP_TMP_FLDSPEC );
	}
	if ( !$filecontent ) {
		mosRedirect( 'index2.php?option='.$option.'&client='.$client, $adminLanguage->A_CMP_TMP_FLDEMP );
	}

	if ( $client == 'admin' ) {
		$file = $mainframe->getCfg('absolute_path').'/administrator/templates/admin/'.$template.'/index.php';
	} else if ( $client == 'login' ) {
		$file = $mainframe->getCfg('absolute_path').'/administrator/templates/login/'.$template.'/index.php';
	} else {
		$file = $mainframe->getCfg('absolute_path').'/templates/'.$template.'/index.php';
	}

    $enable_write = mosGetParam($_POST,'enable_write',0);
	$oldperms = fileperms($file);

	if ($enable_write) { 
        $fmanager->spChmod( $file, '0666' );
    }

	clearstatcache();
	if ( is_writable( $file ) == false ) {
		mosRedirect( 'index2.php?option='. $option , $adminLanguage->A_CMP_TMP_FLDNOT.' ('. $file .')' );
	}
    
    if ($fmanager->writeFile( $file, stripslashes($filecontent), false )) {
		if ($enable_write) {
			$fmanager->spChmod( $file, '0666' );
		} else {
			if (mosGetParam($_POST,'disable_write',0)) {
				$fmanager->spChmod( $file, '0644' );
			}
		}
		mosRedirect( 'index2.php?option='. $option .'&client='. $client );
	} else {
		if ($enable_write) {
            $mod = decoct($oldperms);
            $mod = substr($mod, -4);
            $fmanager->spChmod($file, ''.$mod.'');
        }
		mosRedirect( 'index2.php?option='. $option .'&client='. $client, $adminLanguage->A_CMP_TMP_FLDWRT );
	}
}


/********************************/
/* PREPARE TO EDIT TEMPLATE CSS */
/********************************/
function editTemplateCSS($p_tname, $option, $client) {
	global $mainframe, $adminLanguage, $fmanager;

	if (isset($_GET['template'])) { $p_tname = trim(mosGetParam($_GET, 'template', '')); }
	$cssfile = trim(base64_decode(mosGetParam($_GET, 'cssfile', '')));
	$cssfile = (($cssfile != '') && preg_match('/(\.css)$/i', $cssfile)) ? $cssfile : 'template_css.css';

	if ($client == 'admin') {
		$cssdir = $mainframe->getCfg('absolute_path').'/administrator/templates/admin/'.$p_tname.'/css/';
	} elseif ($client == 'login') {
		$cssdir = $mainframe->getCfg('absolute_path').'/administrator/templates/login/'.$p_tname.'/css/';
	} else {
		$cssdir = $mainframe->getCfg('absolute_path').'/templates/'.$p_tname.'/css/';
	}

	$cssfiles = $fmanager->listFiles($cssdir, '.css');

    if ($content = $fmanager->readFile($cssdir.$cssfile)) {
		$content = htmlspecialchars($content);
		HTML_templates::editCSSSource($p_tname, $content, $option, $client, $cssfile, $cssfiles);
	} else {
		mosRedirect( 'index2.php?option='.$option.'&client='.$client, $adminLanguage->A_CMP_TMP_NTOPEN.' '.$cssdir.$cssfile);
	}
}


/*********************/
/* SAVE TEMPLATE CSS */
/*********************/
function saveTemplateCSS($option, $client) {
	global $mainframe, $adminLanguage, $fmanager;

	$template = trim(mosGetParam($_POST, 'template', ''));
	$cssfile = trim(mosGetParam($_POST, 'cssfile', ''));
	$filecontent = mosGetParam($_POST, 'filecontent', '', _MOS_ALLOWHTML);

	if (!$template) {
		mosRedirect('index2.php?option='.$option.'&client='.$client, $adminLanguage->A_CMP_TMP_FLDSPEC);
	}

	if (!$filecontent) {
		mosRedirect( 'index2.php?option='.$option.'&client='.$client, $adminLanguage->A_CMP_TMP_FLDEMP);
	}

	if ($client == 'admin') {
		$file = $mainframe->getCfg('absolute_path').'/administrator/templates/admin/'.$template.'/css/'.$cssfile;
	} elseif ($client == 'login') {
		$file = $mainframe->getCfg('absolute_path').'/administrator/templates/login/'.$template.'/css/'.$cssfile;
	} else {
		$file = $mainframe->getCfg('absolute_path').'/templates/'.$template.'/css/'.$cssfile;
	}

	if (($cssfile == '') || !file_exists($file)) {
		mosRedirect( 'index2.php?option='.$option.'&client='.$client, $adminLanguage->A_CMP_TMP_FLDWRT);
	}

    $enable_write = intval(mosGetParam($_POST,'enable_write',0));
	$oldperms = fileperms($file);

	if ($enable_write) { $fmanager->spChmod($file, '0666'); }

	clearstatcache();
	if (is_writable($file) == false) {
		mosRedirect('index2.php?option='.$option.'&client='.$client, $adminLanguage->A_CMP_TMP_FLDNOT);
	}

    if ($fmanager->writeFile( $file, stripslashes($filecontent), false )) {
		if ($enable_write) {
			$fmanager->spChmod($file, '0666');
		} elseif (intval(mosGetParam($_POST,'disable_write',0))) {
			$fmanager->spChmod($file, '0644');
		}
		mosRedirect('index2.php?option='.$option);
	} else {
		if ($enable_write) {
		    $mod = decoct($oldperms);
            $mod = substr($mod, -4);
            $fmanager->spChmod($file, ''.$mod.'');
        }
		mosRedirect('index2.php?option='.$option.'&client='.$client, $adminLanguage->A_CMP_TMP_FLDWRT);
	}
}


/****************************/
/* EDIT TEMPLATE PARAMETERS */
/****************************/
function editTemplateParams($p_tname, $option, $client) {
	global $mainframe, $database, $alang;

	if ($client == 'admin') {
		$xmlfile = $mainframe->getCfg('absolute_path').'/administrator/templates/admin/'.$p_tname.'/templateDetails.xml';
		$client_id = 1;
	} elseif ($client == 'login') {
		$xmlfile = $mainframe->getCfg('absolute_path').'/administrator/templates/login/'.$p_tname.'/templateDetails.xml';
		$client_id = 2;
	} else {
		$xmlfile = $mainframe->getCfg('absolute_path').'/templates/'.$p_tname.'/templateDetails.xml';
		$client_id = 0;
	}

	if (!file_exists($xmlfile)) {
		mosRedirect('index2.php?option='.$option.'&client='.$client, 'Template XML file not found!');
	}

	$row = new stdClass();
	$row->name = $p_tname;
	$row->creationDate = null;
	$row->author = null;
	$row->copyright = null;
	$row->license = null;
	$row->authorEmail = null;
	$row->authorUrl = null;
	$row->version = null;
	$row->description = null;

	if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
	$xmlDoc = simplexml_load_file($xmlfile, 'SimpleXMLElement');
	if (!$xmlDoc) {
		mosRedirect('index2.php?option='.$option.'&client='.$client, 'Could not load template XML file!');
	}
	if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
		if ($xmlDoc->getName() != 'mosinstall') {
			mosRedirect('index2.php?option='.$option.'&client='.$client, 'The template XML file has invalid syntax!');
		}
	}
	$attrs =  $xmlDoc->attributes();
	$ok = false;
	if ($attrs) {
		if (isset($attrs['type']) && ($attrs['type'] == 'template')) { $ok = true; }
	}
	if (!$ok) {
		mosRedirect('index2.php?option='.$option.'&client='.$client, 'The XML installation file is not for a template!');
	}
	
	if (isset($xmlDoc->cxlangdir)) {
		$_LangDir = trim($xmlDoc->cxlangdir);
		if ($_LangDir != '') {
        	if (file_exists($mainframe->getCfg('absolute_path').$_LangDir.'/'.$alang.'.php')) {
               	require_once($mainframe->getCfg('absolute_path').$_LangDir.'/'.$alang.'.php');
			} else if (file_exists($mainframe->getCfg('absolute_path').$_LangDir.'/english.php')) {
				require_once($mainframe->getCfg('absolute_path').$_LangDir.'/english.php');
			}
		}
	}
	
	$row->name = isset($xmlDoc->name) ? $xmlDoc->name : $p_tname;
	$row->creationDate = isset($xmlDoc->creationDate) ? $xmlDoc->creationDate : null;
	$row->author = isset($xmlDoc->author) ? $xmlDoc->author : null;
	$row->copyright = isset($xmlDoc->copyright) ? $xmlDoc->copyright : null;
	$row->license = isset($xmlDoc->license) ? $xmlDoc->license : 'GNU/GPL';
	$row->authorEmail = isset($xmlDoc->authorEmail) ? $xmlDoc->authorEmail : null;
	$row->authorUrl = isset($xmlDoc->authorUrl) ? $xmlDoc->authorUrl : null;
	$row->version = isset($xmlDoc->version) ? $xmlDoc->version : null;
	$row->description = isset($xmlDoc->description) ? $xmlDoc->description : null;
	unset($xmlDoc);

	$query = "SELECT params FROM #__templates_menu WHERE client_id = '".$client_id."' AND template ='".$p_tname."'";
	$database->setQuery($query, '#__', 1, 0);
	$tplparams = $database->loadResult();

	$params = new mosParameters($tplparams, $xmlfile, 'template');

	HTML_templates::editParamsHTML($p_tname, $option, $client, $row, $params);
}


/****************************/
/* SAVE TEMPLATE PARAMETERS */
/****************************/
function saveTemplateParams($option, $client, $apply=0) {
	global $database;

	if ($client == 'admin') {
		$client_id = 1;
	} elseif ($client == 'login') {
		$client_id = 2;
	} else {
		$client_id = 0;
	}

	$template = mosGetParam($_POST, 'template', '');
	$params = mosGetParam($_POST, 'params', '');
	if (is_array($params)) {
		$txt = array();
		foreach ($params as $k=>$v) {
			$txt[] = "$k=$v";
		}
		$paramstxt = mosParameters::textareaHandling($txt);
	} else {
		$paramstxt = '';
	}

	$database->setQuery("UPDATE #__templates_menu SET params='".$paramstxt."' WHERE client_id = '".$client_id."' AND template ='".$template."'");
	$database->query();

	if ($apply === 1) {
		mosRedirect('index2.php?option='.$option.'&task=edit_paramsa&client='.$client.'&tpldir='.$template.'&hidemainmenu=1');
	} else {
		mosRedirect('index2.php?option='.$option.'&client='.$client);
	}
}


/******************************/
/* PREPARE TO ASSIGN TEMPLATE */
/******************************/
function assignTemplate( $p_tname, $option, $client ) {
	global $database;

	//get selected pages for $menulist
	if ( $p_tname ) {
		$database->setQuery( "SELECT menuid AS value FROM #__templates_menu WHERE client_id='0' AND template='$p_tname'" );
		$lookup = $database->loadObjectList();
	}

	//build the html select list
	$menulist = mosAdminMenus::MenuLinks( $lookup, 0, 1 );
	HTML_templates::assignTemplate( $p_tname, $menulist, $option, $client );
}


/************************/
/* SAVE TEMPLATE ASSIGN */
/************************/
function saveTemplateAssign($option, $client) {
	global $database;

	$menus = mosGetParam($_POST, 'selections', array());
	$template = mosGetParam($_POST, 'template', '');

	$database->setQuery("SELECT params FROM #__templates_menu WHERE template='".$template."' AND client_id='0' AND params <> '' AND params IS NOT NULL", '#__', 1, 0);
	$params = $database->loadResult();
	$tplparams = $params ? $params : '';

	$database->setQuery("DELETE FROM #__templates_menu WHERE client_id='0' AND template='".$template."' AND menuid<>'0'");
	$database->query();

	if (!in_array('', $menus)) {
		foreach ($menus as $menuid) {
			//If 'None' is not in array
			if ($menuid <> -999) {
				//check if there is already a template assigned to this menu item
				$database->setQuery("DELETE FROM #__templates_menu WHERE client_id='0' AND menuid='$menuid'");
				$database->query();
				$database->setQuery("INSERT INTO #__templates_menu VALUES ('$template', '$menuid', '0', '".$tplparams."')");
				$database->query();
			}
		}
	}

	mosRedirect( 'index2.php?option='.$option.'&client='.$client );
}


/**************************************/
/* PREPARE TO EDIT TEMPLATE POSITIONS */
/**************************************/
function editPositions() {
	global $database;

	$database->setQuery( "SELECT * FROM #__template_positions" );
	$positions = $database->loadObjectList();

	HTML_templates::editPositions( $positions );
}


/***************************/
/* SAVE TEMPLATE POSITIONS */
/***************************/
function savePositions() {
	global $database, $adminLanguage;

	$positions = mosGetParam( $_POST, 'position', array() );
	$descriptions = mosGetParam( $_POST, 'description', array() );

	$database->setQuery("DELETE FROM #__template_positions");
	$database->query();

	foreach ($positions as $id=>$position) {
	    $position = trim( $database->getEscaped( $position ) );
	    $description = mosGetParam( $descriptions, $id, '' );
		if ($position != '') {
		    $id = intval( $id );
		    $query = "INSERT INTO #__template_positions VALUES ($id,'$position','$description')";
			$database->setQuery( $query );
			$database->query();
		}
	}
	mosRedirect( 'index2.php?option=com_templates&task=positions', $adminLanguage->A_CMP_TMP_PSAVED );
}

?>