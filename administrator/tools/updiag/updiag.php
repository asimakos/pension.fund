<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools / Updiag
* @author: Ioannis Sannos
* @email: datahell@elxis.org
* @link: http://www.elxis.org
* @description: Updiag is an Elxis CMS diagnostic and update tool
* @license: http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
* Elxis CMS and Updiag are Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $alang, $mainframe;

$updiagbase = $mainframe->getCfg('absolute_path').'/administrator/tools/updiag/';

if (file_exists( $updiagbase.'language'.SEP.$alang.'.php')) {
    include_once( $updiagbase.'language'.SEP.$alang.'.php' );
} else {
    include_once( $updiagbase.'language'.SEP.'english.php' );
}
$upLang = new updiagLang();
$GLOBALS['upLang'] = $upLang;

require_once($updiagbase.'updiag.class.php');
require_once($updiagbase.'updiag.html.php');

$updiag = new updateDiagnosis();
$GLOBALS['updiag'] = $updiag;

$act = mosGetParam( $_REQUEST, 'act', '' );

$ajaxacts =array('iscr', 'runscr', 'remscr', 'hashhelp', 'remhash', 'elxver', 
'phpver', 'dbver', 'sysver', 'credits', 'security', 'downhash');
if (!in_array($act, $ajaxacts)) {
    HTML_updiag::header();
}

switch ($act) {
  	case 'elxver':
  	elxisVersion();
  	break;
  	case 'phpver':
  	phpVers();
  	break;
  	case 'dbver':
  	dbVers();
  	break;
  	case 'sysver':
  	sysVers();
  	break;
  	case 'security':
  	chSecurity();
  	break;
  	case 'credits':
  	Credits();
  	break;
    case 'chkversion':
    checkVersion();
    break;
    case 'patches':
    patches();
    break;
    case 'upscripts':
    upScripts();
    break;
    case 'iscr':
    $scr = base64_decode(mosGetParam($_REQUEST, 'scr', ''));
    $q = intval(mosGetParam($_REQUEST, 'q', 0));
    importScript($scr, $q);
    break;
    case 'runscr':
    $scr = base64_decode(mosGetParam($_REQUEST, 'scr', ''));
    $q = intval(mosGetParam($_REQUEST, 'q', 0));
    runScript($scr, $q);
    break;
    case 'remscr':
    $scr = base64_decode(mosGetParam($_REQUEST, 'scr', ''));
    $q = intval(mosGetParam($_REQUEST, 'q', 0));
    removeScript($scr, $q);
    break;
    case 'filecheck':
    checkFS();
    break;
    case 'remhash':
    $hash = base64_decode(mosGetParam($_REQUEST, 'hash', ''));
    $q = intval(mosGetParam($_REQUEST, 'q', 0));
    removeHash($hash, $q);
    break;
    case 'hashhelp':
    showHashHelp();
    break;
    case 'runhash':
    $hash = base64_decode(mosGetParam($_REQUEST, 'hash', ''));
    runHash($hash);
    break;
    case 'downhashes':
    downloadHashes();
    break;
    case 'downhash':
    $hash = base64_decode(mosGetParam($_REQUEST, 'hash', ''));
    $q = intval(mosGetParam($_REQUEST, 'q', 0));
    downloadHash($hash, $q);
    break;
    case 'newrel':
    newReleases();
    break;
	default:
	case 'home':
	upCentral();
	break;
}


/*********************************************************/
/* CHECK INSTALLED VERSION AGAINST LATEST FROM ELXIS.ORG */
/*********************************************************/
function checkVersion() {
    global $updiag;
    $row = $updiag->currentVersion();
    HTML_updiag::h_checkVersion($row, $updiag->errormsg);
}


/********************************/
/* SEARCH ELXIS.ORG FOR PATCHES */
/********************************/
function patches() {
    global $updiag;
    $rows = $updiag->patches();
    HTML_updiag::h_patches($rows, $updiag->errormsg);
}


/**********************************/
/* UPDATE UPDIAG INTERNAL SCRIPTS */
/**********************************/
function upScripts() {
    global $updiag;
    $rows = $updiag->upscripts();
    HTML_updiag::h_scripts($rows, $updiag->errormsg);
}


/******************************/
/* IMPORT A SCRIPT USING AJAX */
/******************************/
function importScript($scr, $q=0) {
    global $updiag;
    $updiag->downloadScript($scr, $q);
    exit();
}


/***************************/
/* RUN A SCRIPT USING AJAX */
/***************************/
function runScript($scr, $q=0) {
    global $updiag;
    $updiag->executeScript($scr, $q);
    exit();
}


/******************************/
/* DELETE A SCRIPT USING AJAX */
/******************************/
function removeScript($scr, $q=0) {
    global $updiag;
    $updiag->removeScript($scr, $q);
    exit();
}


/*********************************/
/* DELETE A HASH FILE USING AJAX */
/*********************************/
function removeHash($hash, $q=0) {
    global $updiag;
    $updiag->removeHash($hash, $q);
    exit();
}


/********************/
/* CHECK FILESYSTEM */
/********************/
function checkFS() {
    global $updiag;
    $rows = $updiag->hashes();
    HTML_updiag::h_checkfs($rows);
}


/*******************************/
/* SHOW HASHES HELP USING AJAX */
/*******************************/
function showHashHelp() {
    global $alang, $mainframe;

    $helpdir = $mainframe->getCfg('absolute_path').'/administrator/tools/updiag/language/';
    if (file_exists($helpdir.'hashes.'.$alang.'.php')) {
        include($helpdir.'hashes.'.$alang.'.php');
    } else {
        include($helpdir.'hashes.english.php');
    }
    exit();
}


/**********************/
/* EXECUTE HASH CHECK */
/**********************/
function runHash($hash='') {
    global $updiag;
    $updiag->hashCheck($hash);
}


/*******************/
/* DOWNLOAD HASHES */
/*******************/
function downloadHashes() {
    global $updiag;
    $rows = $updiag->getRemoteHashes();
    HTML_updiag::h_downloadHashes($rows, $updiag->errormsg);
}


/*************************************/
/* DOWNLOAD HASH FILE FROM ELXIS.ORG */
/*************************************/
function downloadHash($hash, $q=0) {
    global $updiag;
    $updiag->downloadHash($hash, $q);
    exit();
}


/***********************************/
/* GET NEW RELEASES FROM ELXIS.ORG */
/***********************************/
function newReleases() {
    global $updiag;
    $rows = $updiag->releases();
    HTML_updiag::h_releases($rows, $updiag->errormsg);
}


/******************/
/* UPDIAG CENTRAL */
/******************/
function upCentral() {
	HTML_updiag::h_updiagCentral();
}


/********************************/
/* GET ELXIS VERSION USING AJAX */
/********************************/
function elxisVersion() {
	global $updiag;
	$updiag->elxisInfo();
	exit();
}


/******************************/
/* GET PHP VERSION USING AJAX */
/******************************/
function phpVers() {
	global $updiag;
	$updiag->phpInfo();
	exit();
}


/*****************************/
/* GET DB VERSION USING AJAX */
/*****************************/
function dbVers() {
	global $updiag;
	$updiag->dbInfo();
	exit();
}


/*********************************/
/* GET SYSTEM VERSION USING AJAX */
/*********************************/
function sysVers() {
	global $updiag;
	$updiag->sysInfo();
	exit();
}


/**********************************/
/* VIEW UPDIAG CREDITS USING AJAX */
/**********************************/
function Credits() {
	global $updiag;
	$updiag->viewCredits();
	exit();
}


/***********************************/
/* CHECK BASIC SECURITY USING AJAX */
/***********************************/
function chSecurity() {
	global $updiag;
	$updiag->checkSecurity();
	exit();
}


HTML_updiag::copyright();

?>