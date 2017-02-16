<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component SoftDisk
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $adminLanguage;
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' ) || 
    $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_softdisk' ))) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
	exit();
}

require_once( $mainframe->getPath( 'admin_html' ) );
require_once($mosConfig_absolute_path.'/administrator/includes/softdisk.class.php');
$softdisk = new softDisk();

$cid = mosGetParam( $_REQUEST, 'cid', array(0) );
if (!is_array( $cid )) { $cid = array(0); }

switch ( $task ) {
    case 'help':
        softdisk_html::showhelp();
    break;
	case 'new':
		editdisk(0);
	break;
	case 'edit':
		editdisk(intval($cid[0]));
	break;
	case 'save':
	   savedisk();
	break;
	case 'remove':
	   removedisk($cid);
	break;
	case 'updatesystem':
	   updateSystemDisk();
	break;
	default:
		viewSoftdisk();
	break;
}


/************************************/
/* PREPARE TO VIEW SOFTDISK ENTRIES */
/************************************/
function viewSoftdisk() {
    global $softdisk, $database, $mainframe, $mosConfig_list_limit, $option, $adminLanguage;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "viewban{$option}limitstart", 'limitstart', 0 );
    $section = mosGetParam($_REQUEST, 'section', '');

    $secs = $softdisk->listSections();
    if (($section != '') && (!in_array($section, $secs))) { $section = ''; }

    $where = ($section != '') ? " AND sdsection='$section'" : '';

	//get the total number of records
	$database->setQuery( "SELECT COUNT(*) FROM #__softdisk WHERE sdhidden='0'".$where );
	$total = $database->loadResult();

	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

    $sections = array();
    $sections[] = mosHTML::makeOption( '', $adminLanguage->A_ALL_SECTIONS );
    foreach ($secs as $sec) {
        $sections[] = mosHTML::makeOption( $sec, $softdisk->translate($sec) );
    }

    $lists = array();
	$javascript = 'onchange="document.adminForm.submit();"';
	$lists['sections'] = mosHTML::selectList( $sections, 'section', 'class="selectbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $section );

    $query = "SELECT * FROM #__softdisk WHERE sdhidden='0'".$where." ORDER BY sdname ASC";
    $database->setQuery( $query, '#__', $pageNav->limit, $pageNav->limitstart );
    $rows = $database->loadObjectList();

    softdisk_html::view($lists, $rows, $section, $pageNav);
}


/**************************************/
/* PREPARE TO ADD/EDIT SOFTDISK ENTRY */
/**************************************/
function editdisk($id='0') {
    global $database, $softdisk, $adminLanguage;

    $row = new softdiskdb($database);
    if ($id) { $row->load($id); }

    if (($row->sdsystem) || ($row->sdhidden)) {
        mosRedirect('index2.php?option=com_softdisk', $adminLanguage->NOEDITSYS);
        exit();
    }

    $secs = $softdisk->listSections();
    $sections[] = mosHTML::makeOption('', '- '.$adminLanguage->A_SELECT.' -');
    foreach ($secs as $sec) {
        $sections[] = mosHTML::makeOption($sec, $softdisk->translate($sec));
    }

    $lists = array();
	$lists['sections'] = mosHTML::selectList($sections, 'section', 'class="selectbox" size="1"', 'value', 'text', $row->sdsection);

    $typs = $softdisk->validTypes();
    foreach ($typs as $typ) {
        $types[] = mosHTML::makeOption($typ, $typ);
    }
    $lists['valuetypes'] = mosHTML::selectList($types, 'valuetype', 'id="valuetype" class="selectbox" size="1" dir="ltr" onChange="changevtype();"', 'value', 'text', $row->valuetype);

	softdisk_html::edit($row, $lists);
}


/***********************/
/* SAVE SOFTDISK ENTRY */
/***********************/
function saveDisk() {
    global $database, $softdisk, $adminLanguage, $mainframe;

    $id = intval(mosGetParam($_POST, 'id', 0));
    $newsection = trim(mosGetParam($_POST, 'newsection', ''));
    if ($newsection != '') {
        $section = $newsection;
    } else {
        $section = mosGetParam($_POST, 'section', '');
    }
    if (($section == '') || !preg_match('/^[A-Z0-9_]+$/', $section)) {
    	$mainframe->checkSendHeaders();
        echo "<script type=\"text/javascript\">alert('".$adminLanguage->INVSECTNAME."'); window.history.go(-1);</script>"._LEND;
        exit();
    }
    $name = strtoupper(trim(mosGetParam($_POST, 'name', '')));
    if (($name == '') || !preg_match('/^[A-Z0-9_]+$/', $name)) {
    	$mainframe->checkSendHeaders();
        echo "<script type=\"text/javascript\">alert('".$adminLanguage->INVNAME."'); window.history.go(-1);</script>"._LEND;
        exit();
    }
    $valuetype = mosGetParam($_POST, 'valuetype', '');

    switch($valuetype) {
        case 'TEXT':
            $value = eUTF::utf8_trim(mosGetParam($_POST, 'valuetext', ''));
        break;
        case 'STRING':
            $value = eUTF::utf8_trim(mosGetParam($_POST, 'valuestring', ''));
        break;
        case 'INTEGER':
            $value = intval(trim(mosGetParam($_POST, 'valueinteger', 0)));
        break;
        case 'DECIMAL':
            $value = eUTF::utf8_trim(mosGetParam($_POST, 'valuedecimal', ''));
            if (!is_numeric($value)) {
            	$mainframe->checkSendHeaders();
                echo "<script type=\"text/javascript\">alert('".$adminLanguage->INVDEC."'); window.history.go(-1);</script>"._LEND;
                exit();
            }
            if (is_int($value)) { $value = number_format($value, 1); }
        break;
        case 'EMAIL':
            $value = eUTF::utf8_trim(mosGetParam($_POST, 'valueemail', ''));
            $regex = '&^(?:
            ("\s*(?:[^"\f\n\r\t\v\b\s]+\s*)+")|
            ([-\w!\#\$%\&\'*+~/^`|{}]+(?:\.[-\w!\#\$%\&\'*+~/^`|{}]+)*))
            @(((\[)?
            (?:(?:(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:[0-1]?[0-9]?[0-9]))\.){3}
            (?:(?:25[0-5])|(?:2[0-4][0-9])|(?:[0-1]?[0-9]?[0-9]))))(?(5)\])|
            ((?:[a-z0-9](?:[-a-z0-9]*[a-z0-9])?\.)*[a-z0-9](?:[-a-z0-9]*[a-z0-9])?)
            \.((?:([^- ])[-a-z]*[-a-z])?))
            $&xi';
            if (!preg_match($regex, $value)) {
            	$mainframe->checkSendHeaders();
                echo "<script type=\"text/javascript\">alert('".$adminLanguage->INVEMAIL."'); window.history.go(-1);</script>"._LEND;
                exit();
            }
        break;
        case 'URL':
            $value = eUTF::utf8_trim(mosGetParam($_POST, 'valueurl', ''));
            if (!$softdisk->validateURI($value)) {
            	$mainframe->checkSendHeaders();
                echo "<script type=\"text/javascript\">alert('".$adminLanguage->INVURL."'); window.history.go(-1);</script>"._LEND;
                exit();
            }
        break;
        case 'IMAGE':
            $value = eUTF::utf8_trim(mosGetParam($_POST, 'valueimage', ''));
        break;
        case 'YESNO':
            $value = intval(mosGetParam($_POST, 'valueyesno', 0));
        break;
        case 'TIME':
            $value = intval(eUTF::utf8_trim(mosGetParam($_POST, 'valuetime', time())));
            if (($value < 0) || ($value > '2000000000')) {
            	$mainframe->checkSendHeaders();
                echo "<script type=\"text/javascript\">alert('".$adminLanguage->INVTSTAMP."'); window.history.go(-1);</script>"._LEND;
                exit();
            }
        break;
        default: //just in case...
        	$mainframe->checkSendHeaders();
            echo "<script type=\"text/javascript\">alert('Invalid value type!'); window.history.go(-1);</script>"._LEND;
            exit();
        break;
    }

    $row = new softdiskdb($database);
    if ($id) {
        $database->setQuery("SELECT COUNT(id) FROM #__softdisk WHERE sdname='$name'");
        if (intval($database->loadResult()) > 1) {
        	$mainframe->checkSendHeaders();
            echo "<script type=\"text/javascript\">alert('".$adminLanguage->SOFTENTRYEXIST."'); window.history.go(-1);</script>"._LEND;
            exit();
        }
        $row->load($id);
        if ($row->sdsystem == 1) { //just in case...
        	$mainframe->checkSendHeaders();
            echo "<scrip type=\"text/javascript\"t>alert('You are not allowed to edit system SoftDisk entries!'); window.history.go(-1);</script>"._LEND;
            exit();
        }
    } else {
        $database->setQuery("SELECT COUNT(id) FROM #__softdisk WHERE sdname='$name'");
        if (intval($database->loadResult()) > 0) {
        	$mainframe->checkSendHeaders();
            echo "<script type=\"text/javascript\">alert('".$adminLanguage->SOFTENTRYEXIST."'); window.history.go(-1);</script>"._LEND;
            exit();
        }
        $row->nodelete = '0';
    }

    $row->sdsection = $section;
    $row->valuetype = $valuetype;
    $row->sdname = $name;
    $row->sdvalue = $value;
    $row->sdsystem = '0';
    $row->lastmodified = time();
    $row->sdhidden = '0';
    $row->store();
    
    mosRedirect('index2.php?option=com_softdisk&section='.$section);
}


/*************************/
/* REMOVE SOFTDISK ENTRY */
/*************************/
function removedisk($cid) {
    global $database, $adminLanguage;

    if (!is_array($cid) || (count($cid)  < 1)) {
        mosRedirect('index2.php?option=com_softdisk', $adminLanguage->A_ALERT_SELECT_DELETE);
        exit();
    }
    $ids = implode(',',$cid);
    $database->setQuery("DELETE FROM #__softdisk WHERE id IN ($ids) AND sdsystem = '0' AND nodelete='0'");
    $database->query();

    mosRedirect('index2.php?option=com_softdisk');
}


/**********************************/
/* UPDATE SYSTEM SOFTDISK ENTRIES */
/**********************************/
function updateSystemDisk() {
    global $softdisk;
    
    $softdisk->updateSystem();
    mosRedirect('index2.php?option=com_softdisk');
}

?>