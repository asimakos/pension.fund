<?php 
/**
* @version: $Id: admin.database.php 2562 2009-10-09 20:48:48Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Database
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!($acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'all' ) || $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_database' ))) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}


require_once( $mainframe->getPath( 'admin_html' ) );

$tbl = mosGetParam( $_REQUEST, 'tbl', '' );
$tbl = trim( $database->getEscaped( $tbl ));

switch ($task) {
    case 'xmlbackup':
        XMLbackup ( $option );
    break;
    case 'sqlbackup':
        SQLbackup ( $option );
    break;
    case 'backup':
        viewbackups( $option );
    break;
    case 'delbackup':
        DELbackup( $option );
    break;
    case 'structure':
        tableStructure ( $tbl, $option );
    break;
    case 'browse':
        tableBrowse( $tbl, $option );
    break;
    case 'monitor':
        HTML_database::DBmonitor( $option );
    break;
    case 'monexec':
        MONexec( $option );
    break;
    case 'optimize':
        optimizeDatabase();
    break;
    case 'repair':
        repairDatabase();
    break;
	case 'dbpanel':
	default:
		dbpanel( $option );
	break;
}


/***********************/
/* DISPLAY MAIN SCREEN */
/***********************/
function dbpanel( $option ) {
	global $database;
		
    $elxtables = $database->_resource->MetaTables('TABLES');
    foreach ($elxtables as $elxtable ){
        $tbls[] = mosHTML::makeOption( $elxtable, $elxtable );
    }

    $lists['tables'] = mosHTML::selectList( $tbls, 'tables[]', 'class="inputbox" size="8" dir="ltr" multiple="multiple"', 'value', 'text', true );
	HTML_database::db_panel( $elxtables, $lists );
}


/*******************/
/* TABLE STRUCTURE */
/*******************/
function tableStructure( $tbl, $option ) {
	global $database, $adminLanguage;

	$tbl = trim($database->getEscaped($tbl));
	if ($cols = $database->_resource->MetaColumns( $tbl )) {
		HTML_database::table_Structure( $tbl, $cols );
	} else {
		echo "<script type=\"text/javascript\">alert(\"". $adminLanguage->A_CMP_DB_TBLNOT . "\"); window.history.go(-1);</script>\n";
		exit();
	}
}


/****************/
/* BROWSE TABLE */
/****************/
function tableBrowse ( $tbl, $option ) {
    HTML_database::table_Browse( $tbl, $option);
}


/******************************/
/* GENERATE XML DATABASE DUMP */
/******************************/
function XMLbackup ( $option ) {
	global $database, $fmanager, $mainframe, $mosConfig_db, $adminLanguage;

    //data: 1 (full backup), data: 0 (only structure)
    $data = mosGetParam( $_REQUEST, 'data', '1' );
    //save: 1 (save on server), save: 0 (download)
    $save = mosGetParam( $_REQUEST, 'save', '1' );

    //create filename. Dont add suffix.
    $filename = date('YmdHis').'_'.$mosConfig_db;
    if ($data == '1') { $filename .= '_full'; }
	$random = '';
	$charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";    
	for ($i=0; $i<'8'; $i++) {
		$random .= $charset[(mt_rand(0,(strlen($charset)-1)))];
	}
    $filename .= '.'.$random;

    @error_reporting(0);

    require_once($mainframe->getCfg('absolute_path').'/includes/adodb/adodb-xmlschema03.inc.php');
    $schema = new adoSchema( $database->_resource );
    switch ( $data ) {
    	case '0':
    	   $buffer = $schema->ExtractSchema( false );
    	break;
    	case '1':
    	default:
    	   $buffer = $schema->ExtractSchema( true );
    	break;
    }

    switch ( $save ) {
        case '0':
        	@ob_end_clean();
        	$xmlfile = $filename.'.xml';
        	@header("Cache-Control: "); //leave blank to avoid IE errors
        	@header("Pragma: "); //leave blank to avoid IE errors
        	@header("Content-type: application/force-download");
        	@header("Content-Disposition: attachment; filename=".$xmlfile);
        	echo $buffer;
        	exit();
        break;
        case '1':
        default:
            $path = $mainframe->getCfg('absolute_path').'/administrator/backups/database/'.$filename.'.xml';
            if (!$fmanager->createFile( $fmanager->PathName( $path, false ), $buffer )) {
                echo "<script type=\"text/javascript\">alert(\"".$fmanager->last_error()."\"); window.history.go(-1);</script>\n";
        		exit();
            }
            $msg = $adminLanguage->A_CMP_DB_BACKSUCC;
            mosRedirect( 'index2.php?option=com_database&task=backup', $msg );                
        break;
    }
}


/************************/
/* LOADS THE SQL DRIVER */
/************************/
function loadDriver() {
    global $mainframe;

    $path = $mainframe->getCfg('absolute_path').'/administrator/components/com_database/drivers/'.$mainframe->getCfg('dbtype').'.php';
    if ( file_exists( $path )) {
        require_once($mainframe->getCfg('absolute_path').'/administrator/components/com_database/drivers/'.$mainframe->getCfg('dbtype').'.php');
        return true;
    } else {
        return false;
    }
}


/**********************************/
/* GENERATES AN SQL DATABASE DUMP */
/**********************************/
function SQLbackup() {
    global $mainframe, $adminLanguage;

    if (!loadDriver()) {
		echo "<script type=\"text/javascript\">alert(\"" . $adminLanguage->A_CMP_DB_NOTSUPPO . " ".$mainframe->getCfg('dbtype')."\"); window.history.go(-1);</script>\n";
		exit();
    }

    //data: 1 (structure+data), data: 0 (only structure), data: 2 (only data)
    $options['data'] = mosGetParam( $_REQUEST, 'data', '1' );
    //lock_table: 1 (use), lock_table: 0 (dont use)
    $options['lock_table'] = mosGetParam( $_REQUEST, 'lock_table', '1' );
    //full_syntax: 1 (use), full_syntax: 0 (dont use)
    $options['full_syntax'] = mosGetParam( $_REQUEST, 'full_syntax', '1' );
    //drop_table: 1 (use), drop_table: 0 (dont use)
    $options['drop_table'] = mosGetParam( $_REQUEST, 'drop_table', '1' );

    //alltables: 1 all, 0 selected tables
    $alltables = mosGetParam( $_REQUEST, 'alltables', '1' ); 

    if ( $alltables == 0 ) {
        if ( count($_POST['tables']) < 1 ) {
    		echo "<script type=\"text/javascript\">alert(\"".$adminLanguage->A_CMP_DB_NOTBLSEL."\"); window.history.go(-1);</script>\n";
    		exit();
        }
        foreach ($_POST['tables'] as $table) {
            if (trim($table) == '') { $dtables = ''; }
        }
        if (!isset($dtables)) {
            $dtables = implode(',', $_POST['tables']);
        }
    } else {
        $dtables = '';
    }

    //save: 1 (save on server), save: 0 (download)
    $save = mosGetParam( $_REQUEST, 'save', '1' );

    $SQLdump = new dump( $options );
    $sql = $SQLdump->dumpDB( $dtables );

    if ( $save == 0 ) {
        if ( !$SQLdump->download_sql( $sql )) {
    		echo "<script type=\"text/javascript\">alert(\"".$adminLanguage->A_CMP_DB_NOTDWNL."\"); window.history.go(-1);</script>\n";
    		exit();
        }
    } else {
        $suffix = '';
        if (( $options['data'] == 1) && ( trim($dtables) == '' )) {
            $suffix = '_full';
        }
        if ( !$SQLdump->save_sql( $sql, $suffix)) {
    		echo "<script type=\"text/javascript\">alert(\"".$adminLanguage->A_CMP_DB_NOTCRSV."\"); window.history.go(-1);</script>\n";
    		exit();
        }
        $msg = $adminLanguage->A_CMP_DB_DUMPSUCC;
    }
    mosRedirect( 'index2.php?option=com_database&task=backup', $msg );
}


/*****************************/
/* VIEW XML/SQL BACKUP FILES */
/*****************************/
function viewbackups( $option ) {
    global $mainframe, $fmanager, $adminLanguage;
        
    $backdir = $fmanager->PathName($mainframe->getCfg('absolute_path').'/administrator/backups/database');

    $ret = array();        
    $bups = $fmanager->listFiles($backdir, $filter = '.xml|.sql');
    if (count($bups) > 0) {
        $dates = array();
        for ($i=0; $i<count($bups); $i++) {
            $bup = $bups[$i];
            $ret[$i]['filename'] = $bup;
            $year = substr($bup, 0, 4);
            $month = substr($bup, 4, 2);
            $day = substr($bup, 6, 2);
            //validate date
            if (@checkdate($month, $day, $year)) {
                $xdate = mktime(0,0,0,$month,$day,$year);
                $xdate = eLOCALE::strftime_os("%A, %d %b %Y", $xdate);
            } else {
                $xdate = $adminLanguage->A_CMP_DB_DTUNKN;
            }
            $ret[$i]['date'] = $xdate;
            if (preg_match('/\.xml/', $bup)) {
                $ret[$i]['type'] = $adminLanguage->A_CMP_DB_TXMLSCHEM;
            } else if (preg_match('/\.sql/', $bup)) {
                $ret[$i]['type'] = $adminLanguage->A_CMP_DB_TSQL;
            } else {
                $ret[$i]['type'] = $adminLanguage->A_CMP_DB_TUNKN;
            }
            //get file size
            if ($fsize = @filesize( $backdir.$bup )) {
                $fsize = ($fsize/1000).' kb';
            } else {
                $fsize = $adminLanguage->A_CMP_DB_UNKOWN;
            }
            $ret[$i]['size'] = $fsize;                
        }
    }
    HTML_database::view_backups( $ret, $option );
}


/*******************************/
/* DELETE XML/SQL BACKUP FILES */
/*******************************/
function DELbackup( $option ) {
    global $mainframe, $fmanager, $adminLanguage;

    $buf = mosGetParam( $_REQUEST, 'buf', array() );
    if (count ($buf) < 1 ) {
    	echo "<script type=\"text/javascript\">alert(\"" . $adminLanguage->A_CMP_DB_NOFSELDEL . "\"); window.history.go(-1);</script>\n";
    	exit();
    }

    $backdir = $fmanager->PathName($mainframe->getCfg('absolute_path').'/administrator/backups/database' );
    $delfiles = array();
    foreach ( $buf as $bfile ) {
    	array_push( $delfiles, $backdir.$bfile );
    }

    if (!$fmanager->deleteFile( $delfiles )) {
        $msg = $fmanager->last_error();
    } else {
    	$numf = count( $buf );
    	$msg = ( $numf >1 ) ? $numf.' '. $adminLanguage->A_CMP_DB_FSDELETED: $adminLanguage->A_CMP_DB_FDELETED;
    }
    mosRedirect( 'index2.php?option=com_database&task=backup', $msg );
}


/**************************************/
/* EXECUTE ADODB PERF MONITOR COMMAND */
/**************************************/
function MONexec( $option ) {
    global $database;

    @set_error_handler('my_error_handler');
    $do = mosGetParam( $_REQUEST, 'do', 'stats' );
    define('ADODB_PERF_NO_RUN_SQL',1);
    $database->_resource->debug=false;
    $perf = NewPerfMonitor($database->_resource);

    switch( $do ) {
        case 'stats':
        echo $perf->HealthCheck();
        break;
        case 'tables':
        default:
        echo $perf->Tables();
        break;
    }
}


/************************/
/* CUSTOM ERROR HANDLER */
/************************/
function my_error_handler() {
}


/******************************************/
/* OPTIMIZE/VACUUM DATABASE TABLES (ajax) */
/******************************************/
function optimizeDatabase() {
    global $database, $adminLanguage;

    @set_error_handler('my_error_handler');
    $num = 0;
    $error = 0;
    $pg = (preg_match('/postgre/', $database->_resource->databaseType)) ? 1 : 0;
    $ora = (in_array($database->_resource->databaseType, array('oci8', 'oci805', 'oci8po', 'oracle'))) ? 1 : 0;

	if ($pg) {
	    $tables = $database->_resource->MetaTables( 'TABLES');
        foreach( $tables as $table) {
            if (preg_match('/^('.$database->_table_prefix.')/i', $table)) {
            	if ($database->_resource->Execute('vacuum '.$table)) {
            		$num++;
            	} else { $error = 1; }
            }
		}
	} else if ($ora) {
		echo 'Oracle does not need optimization!';
		exit();
	} elseif ($perf = NewPerfMonitor($database->_resource)) {
        $tables = $database->_resource->MetaTables( 'TABLES');
        foreach( $tables as $table) {
            if (preg_match('/^('.$database->_table_prefix.')/i', $table)) {
                if ($perf->optimizeTable( $table, ADODB_OPT_HIGH)) {
                    $num++;
                } else { $error = 1; }
            }
        }
    }

    $msg = '';
    if ($error) { $msg = $adminLanguage->A_ERROR.' '; }
    $msg .= $num.' '.$adminLanguage->A_CMP_DB_TBLOPTED;
    echo $msg;
    exit();
}


/*********************************/
/* REPAIR DATABASE TABLES (ajax) */
/*********************************/
function repairDatabase() {
    global $database, $adminLanguage;

    @set_error_handler('my_error_handler');
    if (!preg_match('/mysql/i', $database->_resource->databaseType)) {
        echo $adminLanguage->A_CMP_DB_FAVMYSQL;
        exit();
    }
    $num = 0;
    $error = 0;
    $tables = $database->_resource->MetaTables( 'TABLES');
    foreach( $tables as $table) {
        if (preg_match('/^('.$database->_table_prefix.')/i', $table)) {
            $database->setQuery("REPAIR TABLE $table");
            if ($database->query()) {
                $num++;
            } else { $error = 1; }
        }
    }

    $msg = '';
    if ($error) { $msg = $adminLanguage->A_ERROR.' '; }
    $msg .= $num.' '.$adminLanguage->A_CMP_DB_TBLREPED;
    echo $msg;
    exit();
}

?>