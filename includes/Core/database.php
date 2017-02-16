<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Database
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Elxis database
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!isset($mosConfig_absolute_path)) { // why is this not always defined?
	$mosConfig_absolute_path = str_replace( '/includes/Core', '', str_replace( DIRECTORY_SEPARATOR, '/', dirname(__FILE__) ) );
}

/* for debugging purposes */
include_once($mosConfig_absolute_path.'/includes/version.php');
require($mosConfig_absolute_path.'/includes/adodb/adodb.inc.php');

/****************************************/
/* RETURNS HTML FORMATTED ERROR MESSAGE */
/****************************************/
function html_error_handler($title, $details) {
	global $err_count;

	$err_count++;
	$style = 'background-color: #F00; padding: 1px; color: #FFF; font-weight: bold; cursor: pointer;';
	$js = 'document.getElementById(\'errdetails_'.$err_count.'\').style.display = \'block\';';
	$js2 = 'document.getElementById(\'errhead_'.$err_count.'\').style.backgroundColor = \'#333\';';	
	@ob_end_flush();
	echo "<div style=\"font-size: 11px; border: 1px solid #FFF; text-align: left;\">\n";
	echo "<div id=\"errhead_".$err_count."\" style=\"".$style."\" onclick=\"".$js." ".$js2."\">".$title."</div>\n";
	echo "<div id=\"errdetails_".$err_count."\" style=\"padding: 2px; display:none; background-color: #DDD;\">".$details."</div>\n";
	echo "</div>\n";
}


/**********************/
/* RETURN ERROR LEVEL */
/**********************/
function errorLevel($errno) {
	switch ($errno) {
		case E_ERROR: $errlevel = 'Error'; break;
		case E_USER_ERROR: $errlevel = 'User Error'; break;
		case E_WARNING: $errlevel = 'Warning'; break;
		case E_USER_WARNING: $errlevel = 'User Warning'; break;
		case E_PARSE: $errlevel = 'Parse'; break;
		case E_CORE_ERROR: $errlevel = 'Core Error'; break;
		case E_COMPILE_ERROR: $errlevel = 'Compile Error'; break;
		case E_USER_NOTICE: $errlevel = 'User Notice'; break;
		case E_NOTICE: $errlevel = 'Notice'; break;
		case E_CORE_WARNING: $errlevel = 'Core Warning'; break;
		case E_COMPILE_WARNING: $errlevel = 'Compile Warning'; break;
		case E_STRICT: $errlevel = 'Strict'; break;
		case 4096: $errlevel = 'Recoverable Error'; break; //E_RECOVERABLE_ERROR (PHP >= 5.2)
		default: $errlevel= ''; break;
	}
	return $errlevel;
}


/********************/
/* DB ERROR HANDLER */
/********************/
function elxisdbHandler($dbtype, $fn, $errno, $errmsg, $p1=false, $p2=false) {
	if (defined('_ELX_ERROR')) {
		$errt = _ELX_ERROR;
	} else if (defined('_ELXIS_ADMIN') && isset($GLOBALS['adminLanguage'])) {
		global $adminLanguage;
		$errt = $adminLanguage->A_ERROR;
	} else {
		$errt = 'error';	
	}
	$title = ($errno != '') ? $dbtype.' '.$errt.' ['.$errno.']' : $dbtype.' '.$errt;
	$title .= ' : '.$fn;
    $URISTR = $_SERVER['SCRIPT_NAME'];
	if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] !='')) {
		$URISTR .= '?'.$_SERVER['QUERY_STRING'];
	}

	$details = "<strong>URI:</strong> ".basename($URISTR)."<br />\n";
	$details .= "<strong>Message:</strong> ".$errmsg."<br />\n";
	if ($p1) { $details .= $p1."<br />\n"; }
	if ($p2 && !is_array($p2)) { $details .= $p2; }
	html_error_handler($title, $details);
}


/*****************/
/* ERROR HANDLER */
/*****************/
function elxisHandler($errno, $errstr, $errfile='?', $errline = '?', $errcontext='') {
	global $mosConfig_absolute_path;

	if (error_reporting() == 0) { return; }
	switch ($errno) {
		case E_ERROR: //1
		case E_WARNING: //2
		case E_PARSE: //4
		case E_CORE_ERROR: //16
		case E_COMPILE_ERROR: //64		
		case E_USER_ERROR: //256
		case E_USER_WARNING: //512
		case E_ALL: //6143
			$errlevel = errorLevel($errno);
			if (defined('_ELX_ERROR')) {
				$errt = _ELX_ERROR;
			} else if (defined('_ELXIS_ADMIN') && isset($GLOBALS['adminLanguage'])) {
				global $adminLanguage;
				$errt = $adminLanguage->A_ERROR;
			} else {
				$errt = 'error';	
			}
			$title = ($errlevel != '') ? 'PHP '.$errt.' ['.$errlevel.']' : 'PHP '.$errt;
    		$URISTR = $_SERVER['SCRIPT_NAME'];
			if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] !='')) {
				$URISTR .= '?'.$_SERVER['QUERY_STRING'];
			}
			$details = "<strong>URI:</strong> ".basename($URISTR)."<br />\n"
			. "<strong>Path:</strong> ".substr($errfile, strlen($mosConfig_absolute_path))."<br />\n"
			. "<strong>Line:</strong> ".$errline."<br />\n"
			.$errstr."\n";
			html_error_handler($title, $details);
		break;
		case E_STRICT: //2048
		case E_USER_NOTICE: //1024
		case E_NOTICE: //8
		case E_CORE_WARNING: //32
		case E_COMPILE_WARNING: //128
		case 4096: //E_RECOVERABLE_ERROR (PHP >= 5.2)
		default:
			return;
		break;
	}
}

set_error_handler('elxisHandler');


/**
* Database connector class
* @subpackage Database
*/
class database {
	/** @var string Internal variable to hold the query sql */
	public $_sql='';
	/** @var int Internal variable to hold the database error number */
	public $_errorNum=0;
	/** @var string Internal variable to hold the database error message */
	public $_errorMsg='';
	/** @var string Internal variable to hold the prefix used on all database tables */
	public $_table_prefix='';
	/** @var Internal variable to hold the connector resource */
	public $_resource='';
	/** @var Internal variable to hold the last query cursor */
	public $_cursor=null;
	/** @var boolean Debug option */
	public $_debug=0;
	/** @var int A counter for the number of queries performed by the object instance */
	public $_ticker=0;
	/** @var array A log of queries */
	public $_log=null;
	/** @var Internal variable to hold the current sql limit */
	public $limit;
	/** @var Internal variable to hold the current sql offset */
	public $offset;
	//compatibility prefix for some db fields (oci8)
	public $compatPrefix = 'qq';
	//database is oracle
	public $isoracle = 0;


	/*******************************/
	/* DATABASE OBJECT CONSTRUCTOR */
	/*******************************/
	public function __construct( $host='localhost', $user, $pass, $db, $table_prefix, $driver='mysql' ) {
		global $configArray, $mosConfig_dbtype;

		if (!defined('_ADODB_LAYER')) {
 			$mosSystemError = 1;
 			$elxis_root = str_replace('/includes/Core', '', str_replace( DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));
			if (!defined('_ELXIS_SYSALERT_MSG')) { define('_ELXIS_SYSALERT_MSG', 'Could not find ADOdb!'); }
			define('_ELXIS_SYSALERT', 4);
			include($elxis_root.'/configuration.php');
			include($elxis_root.'/includes/systemplates/router.php');
			exit();
		}

		$this->_resource = NewADOConnection( $driver );
		$this->_resource->raiseErrorFn = 'elxisdbHandler';
		$csdrivers = array('postgres', 'postgres64', 'postgres7', 'postgres8', 'oci8', 'oci805', 'oci8po', 'ibase');
		if (in_array($driver, $csdrivers)) { $this->_resource->charSet = 'utf8'; }

		$this->isoracle = in_array($driver, array('oci8', 'oci805', 'oci8po', 'oracle')) ? 1 : 0;
		if ($this->isoracle) {
			$this->_resource->NLS_DATE_FORMAT = 'RRRR-MM-DD HH24:MI:SS';
			$this->_resource->charSet = 'AL32UTF8';
			$con = @$this->_resource->Connect($host, $user, $pass);
			if ($con) {
				$this->_resource->Execute("ALTER SESSION SET NLS_DATE_FORMAT='RRRR-MM-DD HH24:MI:SS'");
				//$this->_resource->Execute("ALTER SESSION SET NLS_LANGUAGE=GREEK");
				//$this->_resource->Execute("ALTER SESSION SET NLS_TERRITORY=GREECE");
			}
		} else {
			$con = @$this->_resource->Connect($host, $user, $pass, $db);
		}

		if (!$con) {
			$mosSystemError = 2;
 			$elxis_root = str_replace('/includes/Core', '', str_replace( DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));
			if (!defined('_ELXIS_SYSALERT_MSG')) { define('_ELXIS_SYSALERT_MSG', 'Could not connect to the database!'); }
			define('_ELXIS_SYSALERT', 4);
			include($elxis_root.'/configuration.php');
			include($elxis_root.'/includes/systemplates/router.php');
			exit();
		}
		$this->_resource->debug = false;
        if (preg_match('/mysql/i', $driver)) { $this->_resource->Execute('SET NAMES utf8'); }
		$this->_table_prefix = $table_prefix;
		$this->_ticker = 0;
		$this->_log = array();
	}


	//@param int
	public function debug( $level ) {
	    $this->_debug = intval( $level );
	}

	//return int The error number for the most recent query
	public function getErrorNum() {
		return $this->_errorNum;
	}

	//return string The error message for the most recent query
	public function getErrorMsg() {
		return str_replace( array( "\n", "'" ), array( '\n', "\'" ), $this->_errorMsg );
	}

	//Get a database escaped string
	public function getEscaped( $text ) {
		return $this->_resource->addq($text);
	}

	//Get a quoted database escaped string
	public function Quote( $text ) {
		return '\'' . $this->getEscaped( $text ) . '\'';
	}
	

	/*****************/
	/* SETS DB QUERY */
	/*****************/
	public function setQuery( $sql, $prefix='#__', $limit = null, $offset = null ) {
		$sql = $this->_replaceCompat($sql);
		$this->_sql = $this->replacePrefix($sql, $prefix);
		$this->limit = $limit;
		$this->offset = $offset;
	}


	/*****************************************/
	/* COMPATIBILITY REPLACER FOR DB QUERIES */
	/*****************************************/
	protected function _replaceCompat($sql) { //NEEDS MORE WORK --> TO DO
		if ($this->isoracle) {
			$pat = array('/access/', '/\_qqaccess/', '/date/', '/\_qqdate/', '/qqdate\_/', '/qqdateadded/', '/lastvisitqqdate/', '/option/', '/\?qqoption/', '/qqoptions/', '/birthqqdate/', '/registerqqdate/', '/utqqaccess/');
			$rep = array('qqaccess', '_access', 'qqdate', '_date', 'date_', 'dateadded', 'lastvisitdate', 'qqoption', '?option', 'options', 'birthdate', 'registerdate', 'qqaccess');
			$sql = preg_replace($pat, $rep, $sql);
		}
		return $sql;
	}


	/****************************************/
	/* COMPATIBILITY REPLACER FOR DB CURSOR */
	/****************************************/
	protected function _cursorReplacer() {
		if ($this->isoracle) {
			$newfields = array();
			if (isset($this->_cursor->fields) && is_array($this->_cursor->fields) && (count($this->_cursor->fields) > 0)) {
				foreach ($this->_cursor->fields as $key => $val) {
					$low = preg_replace('/^('.$this->compatPrefix.')/', '', strtolower($key));
					$newfields[$low] = $val;
				}
				$this->_cursor->fields = $newfields;
			}

			if (isset($this->_cursor->_array) && is_array($this->_cursor->_array) && (count($this->_cursor->_array) > 0)) {
				$newarray = array();
				foreach ($this->_cursor->_array as $k => $a) {
					if (is_array($a) && (count($a) > 0)) {
						foreach ($a as $key => $val) {
							$low = preg_replace('/^('.$this->compatPrefix.')/', '', strtolower($key));
							$newarray[$k][$low] = $val;
						}
					}
				}
				$this->_cursor->_array = $newarray;
			}
		}
	}


	/****************************************/
	/* COMPATIBILITY REPLACER FOR DB OBJECT */
	/****************************************/
	protected function _objectReplacer($object) {
		if ($this->isoracle) {
			if (is_object($object) && count($object) > 0) {
   				foreach (get_object_vars($object) as $prop => $val) {
					$low = preg_replace('/^('.$this->compatPrefix.')/', '', strtolower($prop));
					$object->$low = $val;
					unset($object->$prop);
				}
			}
		}
		return $object;
	}


	/***************************/
	/* REPLACE DB TABLE PREFIX */
	/***************************/
	protected function replacePrefix( $sql, $prefix='#__' ) {
		$sql = trim( $sql );
		$escaped = false;
		$quoteChar = '';
		$n = strlen($sql);
		$startPos = 0;
		$literal = '';

		while ($startPos < $n) {
			$ip = strpos($sql, $prefix, $startPos);
			if ($ip === false) { break; }
			$j = strpos( $sql, "'", $startPos );
			$k = strpos( $sql, '"', $startPos );
			if (($k !== FALSE) && (($k < $j) || ($j === FALSE))) {
				$quoteChar = '"';
				$j = $k;
			} else {
				$quoteChar = "'";
			}

			if ($j === false) { $j = $n; }

			$literal .= str_replace( $prefix, $this->_table_prefix, substr( $sql, $startPos, $j - $startPos ) );
			$startPos = $j;

			$j = $startPos + 1;
			if ($j >= $n) { break; }

			// quote comes first, find end of quote
			while (TRUE) {
				$k = strpos( $sql, $quoteChar, $j );
				$escaped = false;
				if ($k === false) { break; }
				$l = $k - 1;
				while ($l >= 0 && $sql{$l} == '\\') { $l--; $escaped = !$escaped; }
				if ($escaped) { $j = $k+1; continue; }
				break;
			}
			if ($k === FALSE) { //error in the query - no end quote; ignore it
				break;
			}
			$literal .= substr( $sql, $startPos, $k - $startPos + 1 );
			$startPos = $k+1;
		}
		if ($startPos < $n) {
			$literal .= substr( $sql, $startPos, $n - $startPos );
		}
		return $literal;
	}


	/************************/
	/* RETURN CURRENT QUERY */
	/************************/
	public function getQuery() {
		return "<pre>".htmlspecialchars( $this->_sql )."</pre>\n";
	}


	/*****************/
	/* EXECUTE QUERY */
	/*****************/
	public function query($params = array()) {
		if ($this->_debug) {
			$this->_ticker++;
	  		$this->_log[] = $this->_sql;
		}
		$this->_errorNum = 0;
		$this->_errorMsg = '';

        if (( $this->limit != null) || ( $this->offset != null )) {
            $this->_cursor = $this->_resource->SelectLimit( $this->_sql, $this->limit, $this->offset );
        } else {
            $this->_cursor = $this->_resource->Execute( $this->_sql, $params );
        }

		if (!$this->_cursor) {
			$this->_errorNum = $this->_resource->ErrorNo();
			$this->_errorMsg = $this->_resource->ErrorMsg();
			if ($this->_debug) {
				trigger_error( $this->_resource->ErrorMsg(), E_USER_NOTICE );
				if (function_exists( 'debug_backtrace' )) {
					foreach( debug_backtrace() as $back) {
					    if (@$back['file']) { echo "\n<br />".$back['file'].':'.$back['line']; }
					}
				}
			}
			return false;
		}

		$this->_cursorReplacer();
		return $this->_cursor;
	}


	public function query_batch( $abort_on_error=true, $p_transaction_safe = false) {
		$this->_errorNum = 0;
		$this->_errorMsg = '';
		if ($p_transaction_safe) {
			//$si = mysql_get_server_info();
			preg_match_all( "/(\d+)\.(\d+)\.(\d+)/i", $si, $m );
			if ($m[1] >= 4) {
				$this->_sql = 'START TRANSACTION;' . $this->_sql . '; COMMIT;';
			} else if ($m[2] >= 23 && $m[3] >= 19) {
				$this->_sql = 'BEGIN WORK;' . $this->_sql . '; COMMIT;';
			} else if ($m[2] >= 23 && $m[3] >= 17) {
				$this->_sql = 'BEGIN;' . $this->_sql . '; COMMIT;';
			}
		}
		$query_split = preg_split ("/[;]+/", $this->_sql);
		$error = 0;
		foreach ($query_split as $command_line) {
			$command_line = trim( $command_line );
			if ($command_line != '') {
				//$this->_cursor = mysql_query( $command_line, $this->_resource );
				if (!$this->_cursor) {
					$error = 1;
					//$this->_errorNum .= mysql_errno( $this->_resource ) . ' ';
					//$this->_errorMsg .= mysql_error( $this->_resource )." SQL=$command_line <br />";
					if ($abort_on_error) {
						return $this->_cursor;
					}
				}
			}
		}
		return $error ? false : true;
	}

	/**
	* Diagnostic function
	*/
	public function explain() {
		$temp = $this->_sql;
		$this->_sql = "EXPLAIN $this->_sql";
		$this->query();

		if (!($cur = $this->query())) {
			return null;
		}
		$first = true;

		$buf = "<table cellspacing=\"1\" cellpadding=\"2\" border=\"0\" bgcolor=\"#000000\" align=\"center\">";
		$buf .= $this->getQuery();
		while ($row = $cur->FetchNextObject(false)) {
			if ($first) {
				$buf .= "<tr>";
				foreach ($row as $k=>$v) {
					$buf .= "<th bgcolor=\"#ffffff\">$k</th>";
				}
				$buf .= "</tr>";
				$first = false;
			}
			$buf .= "<tr>";
			foreach ($row as $k=>$v) {
				$buf .= "<td bgcolor=\"#ffffff\">$v</td>";
			}
			$buf .= "</tr>";
		}
		$buf .= "</table><br />&nbsp;";
        $cur->Close();

		$this->_sql = $temp;

		return "<div style=\"background-color:#FFFFCC\" align=\"left\">$buf</div>";
	}


	/******************************************/
	/* GET LAST QUERY NUMBER OF ROWS RETURNED */
	/******************************************/
	public function getNumRows( $cur=null ) {
		$out = $cur ? $cur->NumRows() : $this->_cursor->NumRows();
		$this->_cursor->Close();
		return ( $out );
	}


	/********************************/
	/* GET FIRST FIELD OF FIRST ROW */
	/********************************/
	public function loadResult() {
		if (!($cur = $this->query())) { return null; }
		$ret = null;
        if ($row = $cur->FetchRow()) { $ret = $row[0]; }
 		$cur->Close();
		return $ret;
	}


	/*************************************/
	/* GET ARRAY OF SINGLE FIELD RESULTS */
	/*************************************/
	public function loadResultArray($numinarray = 0) {
		if (!($cur = $this->query())) { return null; }
		$array = array();
		while ($row = $cur->FetchRow( false )) { $array[] = $row[$numinarray]; }
		$cur->Close();
		return $array;
	}


	/******************************/
	/* LOAD ASSOC LIST OF DB ROWS */
	/******************************/
	public function loadAssocList( $key='' ) {
		if (!($cur = $this->query())) { return null; }
		$array = array();
		while ($row = $cur->FetchRow(false)) {
			if ($key) {
				$array[$row->$key] = $row;
			} else {
				$array[] = $row;
			}
		}
		$cur->Close();
		return $array;
	}


	/*********************************/
	/* LOAD FIRST ROW INTO AN OBJECT */
	/*********************************/
	public function loadObject( &$object ) {
		if ($object != null) {
			if (!($cur = $this->query())) { return false; }
			if ($array = $cur->FetchRow()) {
                $cur->Close();
				mosBindArrayToObject($array, $object, null, null, false);
				return true;
			} else {
				return false;
			}
		} else {
			if ($cur = $this->query()) {
				if ($object = $cur->FetchNextObject(false) ) {
					$object = $this->_objectReplacer($object);
                    $cur->Close();
					return true;
				} else {
					$object = null;
                    $cur->Close();
					return false;
				}
			} else {
				return false;
			}
		}
	}


	/***************************/
	/* LOAD LIST OF DB OBJECTS */
	/***************************/
	public function loadObjectList( $key='' ) {
		if (!($cur = $this->query())) { return null; }
		$array = array();
		while ($row = $cur->FetchNextObject(false)) {
			$row = $this->_objectReplacer($row);
			if (strlen($key)) {
				$array[$row->$key] = $row;
			} else {
				$array[] = $row;
			}
		}
		$cur->Close();
		return $array;
	}


	/**********************************/
	/* GET THE FIRST ROW OF THE QUERY */
	/**********************************/
	public function loadRow() {
		if (!($cur = $this->query())) { return null; }
		$ret = null;
		if ($row = $cur->FetchRow()) { $ret = $row; }
		$cur->Close();
		return $ret;
	}


	/**************************************************/
	/* LOAD LIST OF DB ROWS (numeric column indexing) */
	/**************************************************/
	public function loadRowList( $key='' ) {
		if (!($cur = $this->query())) { return null; }
		$array = array();
        while ($row = $cur->FetchRow()) {
			if ($key) {
				$array[$row[$key]] = $row;
			} else {
				$array[] = $row;
			}
		}
		$cur->Close();
		return $array;
	}


	/***********************/
	/* INSERT OBJECT TO DB */
	/***********************/
	public function insertObject( $table, &$object, $keyName=NULL, $verbose=false ) {

		$fmtsql = "INSERT INTO $table ( %s ) VALUES ( %s ) ";
		$fields = array();

        $dbt = strtolower($this->_resource->databaseType);

		foreach (get_object_vars( $object ) as $k => $v) {
			if (is_array($v) or is_object($v) or $v === NULL) {
				continue;
			}

    		if ($k[0] == '_' || $k == 'id') { // internal field
    			continue;
    		}

			if (($keyName) && ($keyName == $k) && ( $v == 0)) { //for postgres not to insert 0 as id of new rows
            } else {
                if (preg_match('/postgre/', $dbt)) { //compatibility for postgres
                    $fields[] = "\"".$k."\"";
                } else if ((preg_match('/mysql/', $dbt)) && (!preg_match('/\`/', $k))) { //compatibility for mysql
                    $fields[] = "`$k`";
                } else {
                    $fields[] = "$k";
                }
                if( trim($v) == '' ) {
				    $values[] = 'NULL';
			     } else {
                    $values[] = "'".$this->getEscaped( $v )."'";
                }
			}
		}

		$this->setQuery( sprintf( $fmtsql, implode( ",", $fields ) ,  implode( ",", $values ) ) );
		($verbose) && print "$this->_sql<br />\n";

        if (!$this->query()) {
        	return false;
		}

		$id = $this->insertid($table, $keyName);
		($verbose) && print "id=[$id]<br />\n";
		if ($keyName && $id) {
			$object->$keyName = $id;
		}

		return true;
	}


	/********************/
	/* UPDATE DB OBJECT */
	/********************/
	public function updateObject( $table, &$object, $keyName, $updateNulls=true ) {
		$fmtsql = "UPDATE $table SET %s WHERE %s";
		$tmp = array();
		foreach (get_object_vars( $object ) as $k => $v) {
			if( is_array($v) or is_object($v) or $k[0] == '_' ) { // internal or NA field
				continue;
			}
			if( $k == $keyName ) { // PK not to be updated
				$where = "$keyName='" . $this->getEscaped( $v ) . "'";
				continue;
			}
			if ($v === NULL && !$updateNulls) {
				continue;
			}
			if( $v == '' ) {
				$val = "NULL";
			} else {
				$val = "'".$this->getEscaped( $v )."'"; //ELXIS note: added single quotes for escaping reserved words
			}

			//backticks for escaping reserved words for MySQL, quotes for postgres for lower/uppercase fields
            $dbt = strtolower($this->_resource->databaseType);
            if ( preg_match('/mysql/', $dbt )) {
                $tmp[] = "`$k`=$val";
            } else if ( preg_match('/postgre/', $dbt )) {
                $tmp[] = "\"$k\"=$val";
            } else {
                $tmp[] = "$k=$val"; 
            }
		}
        $this->setQuery( sprintf( $fmtsql, implode( ",", $tmp ) , $where ) );
        return $this->query();
	}

	/**
	* @param boolean If TRUE, displays the last SQL statement sent to the database
	* @return string A standised error message
	*/
	public function stderr( $showSQL = false ) {
		return "DB function failed with error number $this->_errorNum"
		."<br /><font color=\"red\">$this->_errorMsg</font>"
		.($showSQL ? "<br />SQL = <pre>$this->_sql</pre>" : '');
	}


	/*******************/
	/* GET INSERTED ID */
	/*******************/
    public function insertid($table=null, $keyName=null) {
        $pg = preg_match('/postgre/i', $this->_resource->databaseType) ? 1 : 0;

		if ($pg) {
            if ($table == null || $keyName==null) {
                return $this->_resource->Insert_ID();
            } else {
                $table = preg_replace('/(\#__)/', $this->_table_prefix, $table);
                $query = "SELECT currval( '".$table."_".$keyName."_seq' )";
                $this->setQuery( $query );
                $this->query();
                return $this->loadResult();
            }
        } else if ($this->isoracle && $table && $keyName) {
        	$table = preg_replace('/(\#__)/', $this->_table_prefix, $table);
        	return $this->_resource->PO_Insert_ID($table, $keyName);
		} else {
            return $this->_resource->Insert_ID(); //mysql, mssql odbc
		}
	}


	/************************/
	/* GET DATABASE VERSION */
	/************************/
	public function getVersion() {
        $v = $this->_resource->ServerInfo();
		return $v['description'];
	}


	/**
	* Fudge method for ADOdb compatibility
	*/
	public function GenID( $table=null, $keyName=null ) {
        $pg = preg_match('/postgre/i', $this->_resource->databaseType) ? 1 : 0;
		if ($pg || $this->isoracle) {
            $seq = preg_replace('/(\#__)/', $this->_table_prefix, $table);
            $seq .= '_'.$keyName.'_seq';
            return $this->_resource->GenID($seq);
		} else {
            return '0';
		}
	}


	/************************/
	/* RETURN ALL DB TABLES */
	/************************/
	public function getTableList() {
		return $this->_resource->MetaTables();
	}


	/************************************/
	/* RETURN SQL FOR TABLE(S) CREATION */
	/************************************/
	public function getTableCreate($tables) {
		$result = array();
		if (is_array($tables) && (count($tables) > 0)) {
			foreach ($tables as $tblval) {
				$this->setQuery( 'SHOW CREATE table '.$tblval );
				$this->query();
				$result[$tblval] = $this->loadResultArray( 1 );
			}
		}
		return $result;
	}


	/***************************************/
	/* GET TABLE(S) COLUMNS AND THEIR TYPE */
	/***************************************/
	public function getTableFields($tables) {
		$result = array();
		if (is_array($tables) && (count($tables) > 0)) {
			foreach ($tables as $tblval) {
				$fields = $this->_resource->MetaColumns($tblval);
				if ($fields && (count($fields) > 0)) {
					foreach ($fields as $field) {
						$result[$tblval][$field->name] = $field->type;
					}
				}
			}
		}
		return $result;
	}

}


/*
* mosDBTable Abstract Class.
* Parent classes to all database derived objects.  Customisation will generally
* not involve tampering with this object.
*/
abstract class mosDBTable {

	public $_tbl = '';
	public $_tbl_key = '';
	public $_error = '';
	public $_db = null;

	/**
	*	Object constructor to set table and key field
	*
	*	Can be overloaded/supplemented by the child class
	*	@param string $table name of the table in the db schema relating to child class
	*	@param string $key name of the primary key field in the table
	*/
	public function mosDBTable( $table, $key, &$db ) {
		$this->_tbl = $table;
		$this->_tbl_key = $key;
		$this->_db =& $db;
	}
	/**
	 * Filters public properties
	 * @access protected
	 * @param array List of fields to ignore
	 */
	function filter( $ignoreList=null ) {
		$ignore = is_array( $ignoreList );

		$iFilter = new InputFilter();
		foreach ($this->getPublicProperties() as $k) {
			if ($ignore && in_array( $k, $ignoreList ) ) {
				continue;
			}
			$this->$k = $iFilter->process( $this->$k );
		}
	}
	/**
	 *	@return string Returns the error message
	 */
	function getError() {
		return $this->_error;
	}
	/**
	* Gets the value of the class variable
	* @param string The name of the class variable
	* @return mixed The value of the class var (or null if no var of that name exists)
	*/
	function get( $_property ) {
		if(isset( $this->$_property )) {
			return $this->$_property;
		} else {
			return null;
		}
	}
	/**
	 * Returns an array of public properties
	 * @return array
	 */
	function getPublicProperties() {
		$cache = null;
		if (is_null( $cache )) {
			$cache = array();
			foreach (get_class_vars( get_class( $this ) ) as $key=>$val) {
				if (substr( $key, 0, 1 ) != '_') {
					$cache[] = $key;
				}
			}
		}
		return $cache;
	}
	/**
	* Set the value of the class variable
	* @param string The name of the class variable
	* @param mixed The value to assign to the variable
	*/
	function set( $_property, $_value ) {
		$this->$_property = $_value;
	}
	/**
	*	binds a named array/hash to this object
	*
	*	can be overloaded/supplemented by the child class
	*	@param array $hash named array
	*	@return null|string	null is operation was satisfactory, otherwise returns an error
	*/
	function bind( $array, $ignore="" ) {
		if (!is_array( $array )) {
			$this->_error = strtolower(get_class( $this ))."::bind failed.";
			return false;
		} else {
			return mosBindArrayToObject( $array, $this, $ignore );
		}
	}

	/**
	*	binds an array/hash to this object
	*	@param int $oid optional argument, if not specifed then the value of current key is used
	*	@return any result from the database operation
	*/
	function load( $oid=null ) {
		$k = $this->_tbl_key;
		if ($oid !== null) {
			$this->$k = $oid;
		}
		$oid = $this->$k;
		if ($oid === null) {
			return false;
		}
		$this->_db->setQuery( "SELECT * FROM $this->_tbl WHERE $this->_tbl_key='$oid'" );
		return $this->_db->loadObject( $this );
	}

	/**
	*	generic check method
	*
	*	can be overloaded/supplemented by the child class
	*	@return boolean True if the object is ok
	*/
	function check() {
		return true;
	}

	/**
	* Inserts a new row if id is zero or updates an existing row in the database table
	*
	* Can be overloaded/supplemented by the child class
	* @param boolean If false, null object variables are not updated
	* @return null|string null if successful otherwise returns and error message
	*/
	function store( $updateNulls=false ) {
		$k = $this->_tbl_key;
		global $migrate;
		if( $this->$k && !$migrate) {
			$ret = $this->_db->updateObject( $this->_tbl, $this, $this->_tbl_key, $updateNulls );
		} else {	
			$ret = $this->_db->insertObject( $this->_tbl, $this, $this->_tbl_key );
		}
		if( !$ret ) {
			$this->_error = strtolower(get_class( $this ))."::store failed <br />" . $this->_db->getErrorMsg();
			return false;
		} else {
			return true;
		}
	}
	/**
	*/
	function move( $dirn, $where='' ) {
		$k = $this->_tbl_key;
        
		$sql = "SELECT $this->_tbl_key, ordering FROM $this->_tbl";

		if ($dirn < 0) {
			$sql .= "\nWHERE ordering < $this->ordering";
			$sql .= ($where ? "\n AND $where" : '');
			$sql .= "\nORDER BY ordering DESC\n";
		} else if ($dirn > 0) {
			$sql .= "\nWHERE ordering > $this->ordering";
			$sql .= ($where ? "\n AND $where" : '');
			$sql .= "\nORDER BY ordering\n";
		} else {
			$sql .= "\nWHERE ordering = $this->ordering";
			$sql .= ($where ? "\n AND $where" : '');
			$sql .= "\nORDER BY ordering\n";
		}

		$this->_db->setQuery( $sql, '#__', 1, 0 );

		$row = null;
		if ($this->_db->loadObject( $row )) {
			$this->_db->setQuery( "UPDATE $this->_tbl SET ordering='$row->ordering'"
			. "\nWHERE $this->_tbl_key='".$this->$k."'"
			);

			if (!$this->_db->query()) {
			    $err = $this->_db->getErrorMsg();
			    die( $err );
			}

			$this->_db->setQuery( "UPDATE $this->_tbl SET ordering='$this->ordering'"
			. "\nWHERE $this->_tbl_key='".$row->$k."'"
			);

			if (!$this->_db->query()) {
			    $err = $this->_db->getErrorMsg();
			    die( $err );
			}

			$this->ordering = $row->ordering;
		} else {
			$this->_db->setQuery( "UPDATE $this->_tbl SET ordering='$this->ordering'"
			. "\nWHERE $this->_tbl_key='".$this->$k."'"
			);

			if (!$this->_db->query()) {
			    $err = $this->_db->getErrorMsg();
			    die( $err );
			}
		}
	}
	/**
	* Compacts the ordering sequence of the selected records
	* @param string Additional where query to limit ordering to a particular subset of records
	*/
	function updateOrder( $where='' ) {
		$k = $this->_tbl_key;

		if (!array_key_exists( 'ordering', get_class_vars( strtolower(get_class( $this )) ) )) {
			$this->_error = "WARNING: ".strtolower(get_class( $this ))." does not support ordering.";
			return false;
		}

		if ($this->_tbl == "#__content_frontpage") {
			$order2 = ", content_id DESC";
		} else {
			$order2 = "";
		}

		$this->_db->setQuery( "SELECT $this->_tbl_key, ordering FROM $this->_tbl"
		. ($where ? "\nWHERE $where" : '')
		. "\nORDER BY ordering".$order2
		);
		if (!($orders = $this->_db->loadObjectList())) {
			$this->_error = $this->_db->getErrorMsg();
			return false;
		}
		// first pass, compact the ordering numbers
		for ($i=0, $n=count( $orders ); $i < $n; $i++) {
			if ($orders[$i]->ordering >= 0) {
				$orders[$i]->ordering = $i+1;
			}
		}

		$shift = 0;
		$n=count( $orders );
		for ($i=0; $i < $n; $i++) {
			if ($orders[$i]->$k == $this->$k) {
				// place 'this' record in the desired location
				$orders[$i]->ordering = min( $this->ordering, $n );
				$shift = 1;
			} else if ($orders[$i]->ordering >= $this->ordering && $this->ordering > 0) {
				$orders[$i]->ordering++;
			}
		}

		// compact once more until I can find a better algorithm
		for ($i=0, $n=count( $orders ); $i < $n; $i++) {
			if ($orders[$i]->ordering >= 0) {
				$orders[$i]->ordering = $i+1;
				$this->_db->setQuery( "UPDATE $this->_tbl"
				. "\nSET ordering='".$orders[$i]->ordering."' WHERE $k='".$orders[$i]->$k."'"
				);
				$this->_db->query();
			}
		}

		// if we didn't reorder the current record, make it last
		if ($shift == 0) {
			$order = $n+1;
			$this->_db->setQuery( "UPDATE $this->_tbl"
			. "\nSET ordering='$order' WHERE $k='".$this->$k."'"
			);
			$this->_db->query();
		}
		return true;
	}
	/**
	*	Generic check for whether dependancies exist for this object in the db schema
	*
	*	can be overloaded/supplemented by the child class
	*	@param string $msg Error message returned
	*	@param int Optional key index
	*	@param array Optional array to compiles standard joins: format [label=>'Label',name=>'table name',idfield=>'field',joinfield=>'field']
	*	@return true|false
	*/
	function canDelete( $oid=null, $joins=null ) {
		$k = $this->_tbl_key;
		if ($oid) {
			$this->$k = intval( $oid );
		}
		if (is_array( $joins )) {
			$select = "$k";
			$join = "";
			foreach( $joins as $table ) {
				$select .= ",\nCOUNT(DISTINCT {$table['idfield']}) AS {$table['idfield']}";
				$join .= "\nLEFT JOIN {$table['name']} ON {$table['joinfield']} = $k";
			}
			$this->_db->setQuery( "SELECT $select\nFROM $this->_tbl\n$join\nWHERE $k = ".$this->$k." GROUP BY $k" );

			if ($obj = $this->_db->loadObject()) {
				$this->_error = $this->_db->getErrorMsg();
				return false;
			}
			$msg = array();
			foreach( $joins as $table ) {
				$k = $table['idfield'];
				if ($obj->$k) {
					$msg[] = $AppUI->_( $table['label'] );
				}
			}

			if (count( $msg )) {
				$this->_error = "noDeleteRecord" . ": " . implode( ', ', $msg );
				return false;
			} else {
				return true;
			}
		}

		return true;
	}

	/**
	*	Default delete method
	*
	*	can be overloaded/supplemented by the child class
	*	@return true if successful otherwise returns and error message
	*/
	function delete( $oid=null ) {
		$k = $this->_tbl_key;
		if ($oid) {
			$this->$k = intval( $oid );
		}

		$this->_db->setQuery( "DELETE FROM $this->_tbl WHERE $this->_tbl_key = '".$this->$k."'" );

		if ($this->_db->query()) {
			return true;
		} else {
			$this->_error = $this->_db->getErrorMsg();
			return false;
		}
	}

	function checkout( $who, $oid=null ) {
		if (!array_key_exists( 'checked_out', get_class_vars( strtolower(get_class( $this )) ) )) {
			$this->_error = "WARNING: ".strtolower(get_class( $this ))." does not support checkouts.";
			return false;
		}
		$k = $this->_tbl_key;
		if ($oid !== null) {
			$this->$k = $oid;
		}
		$time = date( "Y-m-d H:i:s" );
		if (intval( $who )) {
			// new way of storing editor, by id
			$this->_db->setQuery( "UPDATE $this->_tbl"
			. "\nSET checked_out='$who', checked_out_time='$time'"
			. "\nWHERE $this->_tbl_key='".$this->$k."'"
			);
		} else {
			// old way of storing editor, by name
			$this->_db->setQuery( "UPDATE $this->_tbl"
			. "\nSET checked_out='1', checked_out_time='$time', editor='".$who."' "
			. "\nWHERE $this->_tbl_key='".$this->$k."'"
			);
		}
		return $this->_db->query();
	}

	function checkin( $oid=null ) {
		if (!array_key_exists( 'checked_out', get_class_vars( strtolower(get_class( $this )) ) )) {
			$this->_error = "WARNING: ".strtolower(get_class( $this ))." does not support checkin.";
			return false;
		}
		$k = $this->_tbl_key;
		if ($oid !== null) {
			$this->$k = $oid;
		}
		$time = date("H:i:s");
		$this->_db->setQuery( "UPDATE $this->_tbl"
		. "\nSET checked_out='0', checked_out_time='1979-12-19 00:00:00'"
		. "\nWHERE $this->_tbl_key='".$this->$k."'"
		);
		return $this->_db->query();
	}

	function hit( $oid=null ) {
		global $mosConfig_enable_log_items;

		$k = $this->_tbl_key;
		if ($oid !== null) {
			$this->$k = intval( $oid );
		}
		$this->_db->setQuery( "UPDATE $this->_tbl SET hits=(hits+1) WHERE $this->_tbl_key='$this->id'" );
		$this->_db->query();

		if (@$mosConfig_enable_log_items) {
			$now = date( "Y-m-d" );
			$this->_db->setQuery( "SELECT hits"
			. "\nFROM #__core_log_items"
			. "\nWHERE time_stamp='$now' AND item_table='$this->_tbl' AND item_id='".$this->$k."'"
			);
			$hits = intval( $this->_db->loadResult() );
			if ($hits) {
				$this->_db->setQuery( "UPDATE #__core_log_items SET hits=(hits+1)"
				. "\nWHERE time_stamp='$now' AND item_table='$this->_tbl' AND item_id='".$this->$k."'"
				);
				$this->_db->query();
			} else {
				$this->_db->setQuery( "INSERT INTO #__core_log_items VALUES"
				. "\n('$now','$this->_tbl','".$this->$k."','1')"
				);
				$this->_db->query();
			}
		}
	}

	/**
	* Generic save function
	* @param array Source array for binding to class vars
	* @param string Filter for the order updating
	* @returns TRUE if completely successful, FALSE if partially or not succesful.
	*/
	function save( $source, $order_filter ) {
		if (!$this->bind( $_POST )) {
			return false;
		}
		if (!$this->check()) {
			return false;
		}
		if (!$this->store()) {
			return false;
		}
		if (!$this->checkin()) {
			return false;
		}
		$filter_value = $this->$order_filter;
		$this->updateOrder( $order_filter ? "$order_filter='$filter_value'" : "" );
		$this->_error = '';
		return true;
	}

	/**
	* Generic Publish/Unpublish function
	* @param array An array of id numbers
	* @param integer 0 if unpublishing, 1 if publishing
	* @param integer The id of the user performnig the operation
	*/
	function publish_array( $cid=null, $publish=1, $myid=0 ) {
		if (!is_array( $cid ) || count( $cid ) < 1) {
			$this->_error = "No items selected.";
			return false;
		}

		$cids = implode( ',', $cid );

		$this->_db->setQuery( "UPDATE $this->_tbl SET published='$publish'"
		. "\nWHERE $this->_tbl_key IN ($cids) AND (checked_out=0 OR (checked_out='$myid'))"
		);
		if (!$this->_db->query()) {
			$this->_error = $this->_db->getErrorMsg();
			return false;
		}

		if (count( $cid ) == 1) {
			$this->checkin( $cid[0] );
		}
		$this->_error = '';
		return true;
	}

	/**
	* Export item list to xml
	* @param boolean Map foreign keys to text values
	*/
	function toXML( $mapKeysToText=false ) {
		$xml = '<record table="' . $this->_tbl . '"';
		if ($mapKeysToText) {
			$xml .= ' mapkeystotext="true"';
		}
		$xml .= '>';
		foreach (get_object_vars( $this ) as $k => $v) {
			if (is_array($v) or is_object($v) or $v === NULL) {
				continue;
			}
			if ($k[0] == '_') { // internal field
				continue;
			}
			$xml .= '<' . $k . '><![CDATA[' . $v . ']]></' . $k . '>';
		}
		$xml .= '</record>';

		return $xml;
	}
}

?>