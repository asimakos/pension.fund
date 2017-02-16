<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Database
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: PostgreSQL dump database driver
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


/****************  EXPERIMENTAL  (tested successfully on standalone enviroment) ***********************/

class dump {

    public $host= 'localhost';
    public $port= '5432';
    public $dbname= 'postgres';
    public $user= 'postgres';
    public $password= '';
    //public $lock_table = 1;
    //public $full_syntax = 1;
    //public $drop_table = 0; //dont use drop table in postgres
    //public $data = '1'; //0: Only Structure, 1: Structure+Data, 2: Only Data
	//public $tables = null;
	//public $conn = null;
	//public $result = null;
	public $error = '';


	//function dump, for postreSQL we dont use options, always we do a FULL backup
	public function __construct( $options=array() ) {
	    //global $database;

	    //$this->conn = $database->_resource;
	    $this->host = $GLOBALS['mosConfig_host'];
	    $this->port = '5432';
        $this->dbname = $GLOBALS['mosConfig_db'];
        $this->user = $GLOBALS['mosConfig_user'];
        $this->password = $GLOBALS['mosConfig_password'];
	}


	//Return last error
	function error() {
		return $this->error;
	}


    //for postreSQL we dont use tbls, always we do a FULL backup
	function dumpDB( $tbls = '' ) {
        //global $database;

        //$dbconn = $this->conn;
        //do we really need new connection?
        $dbconn = pg_pconnect("host=$this->host port=$this->port dbname=$this->dbname user=$this->user password=$this->password");

        if (!$dbconn) {
            $this->error = "Error: Can\'t connect to database";
        return false;
        }

		$returnSql = '-- ELXIS PostgreSQL Dump'._LEND;
		$returnSql .= '-- Host: '.$this->host._LEND;
		$returnSql .= '-- Database: '.$this->dbname._LEND;
		$returnSql .= '-- Attention: This file is UTF-8 encoded'._LEND;
		$returnSql .= '-- -------------------------------------------------'._LEND;

		$sql = "SELECT VERSION()";
		$result = pg_query ($dbconn, $sql );
		$row = pg_fetch_array($result, 0, PGSQL_NUM);
		pg_free_result($result);
		$returnSql .= '-- Server version: '.$row[0]._LEND._LEND;

        $res = pg_query(" select relname as tablename from pg_class where relkind in ('r') 
        and relname not like 'pg_%' and relname not like 'sql_%' order by tablename");

        while($row = pg_fetch_row($res)) {
        $table = $row[0];
        $returnSql .= _LEND.'--'._LEND;
        $returnSql .= "-- Table structure for table '$table'";
        $returnSql .= _LEND.'--'._LEND;
        $returnSql .= _LEND."DROP TABLE $table CASCADE;";
        $returnSql .= _LEND."CREATE TABLE $table (";
        $res2 = pg_query("
            SELECT attnum,attname , typname , atttypmod-4 , attnotnull ,atthasdef ,adsrc AS def FROM pg_attribute, pg_class, pg_type, pg_attrdef WHERE pg_class.oid=attrelid AND pg_type.oid=atttypid AND attnum>0 AND pg_class.oid=adrelid AND adnum=attnum 
            AND atthasdef='t' AND lower(relname)='$table' UNION 
            SELECT attnum,attname , typname , atttypmod-4 , attnotnull , atthasdef ,'' AS def 
            FROM pg_attribute, pg_class, pg_type WHERE pg_class.oid=attrelid 
            AND pg_type.oid=atttypid AND attnum>0 AND atthasdef='f' AND lower(relname)='$table' 
        ");

        while($r = pg_fetch_row($res2)) {
            $returnSql .= _LEND.$r[1].' '.$r[2];
            if( $r[2] == 'varchar' ) {
                $returnSql .= '('.$r[3] .')';
            }
            if( $r[4] == 't' ) {
                $returnSql .= ' NOT NULL';
            }
            if ($r[5] == 't') {
                $returnSql .= ' DEFAULT '.$r[6];
            }
            $returnSql .= ',';
        }
        $returnSql = rtrim( $returnSql, ',' );
        $returnSql .= _LEND.');'._LEND;
        $returnSql .= _LEND.'--'._LEND;
        $returnSql .= "-- Creating data for '$table'";
        $returnSql .= _LEND.'--'._LEND._LEND;

        $res3 = pg_query("SELECT * FROM $table");

        while( $r = pg_fetch_row( $res3 )) {
            $sql = "INSERT INTO $table VALUES ('";
            //$sql .= utf8_decode(implode("','",$r));
            $sql .= implode("','",$r);
            $sql .= "');";
            $returnSql = str_replace("''","NULL",$returnSql);
            $returnSql .= $sql;
            $returnSql .= _LEND;
        }

        $res1 = pg_query("SELECT pg_index.indisprimary, pg_catalog.pg_get_indexdef(pg_index.indexrelid) 
            FROM pg_catalog.pg_class c, pg_catalog.pg_class c2, pg_catalog.pg_index AS pg_index 
            WHERE c.relname = '$table' 
            AND c.oid = pg_index.indrelid 
            AND pg_index.indexrelid = c2.oid 
            AND pg_index.indisprimary");

        while($r = pg_fetch_row($res1)) {
            $returnSql .= _LEND._LEND.'--'._LEND;
            $returnSql .= "-- Creating index for '$table'";
            $returnSql .= _LEND.'--'._LEND._LEND;

            $t = str_replace("CREATE UNIQUE INDEX", "", $r[1]);
            $t = str_replace("USING btree", "|", $t);
            // Next Line Can be improved!!!
            $t = str_replace("ON", "|", $t);
            $Temparray = explode("|", $t);

            $returnSql .= "ALTER TABLE ONLY ". $Temparray[1] . " ADD CONSTRAINT " . $Temparray[0] . " PRIMARY KEY " . $Temparray[2] .";"._LEND; 
        }
        }

        $res = pg_query(" SELECT cl.relname AS tabela,ct.conname, pg_get_constraintdef(ct.oid) 
            FROM pg_catalog.pg_attribute a 
            JOIN pg_catalog.pg_class cl ON (a.attrelid = cl.oid AND cl.relkind = 'r') 
            JOIN pg_catalog.pg_namespace n ON (n.oid = cl.relnamespace) 
            JOIN pg_catalog.pg_constraint ct ON (a.attrelid = ct.conrelid AND 
            ct.confrelid != 0 AND ct.conkey[1] = a.attnum) 
            JOIN pg_catalog.pg_class clf ON (ct.confrelid = clf.oid AND clf.relkind = 'r') 
            JOIN pg_catalog.pg_namespace nf ON (nf.oid = clf.relnamespace) 
            JOIN pg_catalog.pg_attribute af ON (af.attrelid = ct.confrelid AND 
            af.attnum = ct.confkey[1]) order by cl.relname ");

        while($row = pg_fetch_row($res)) { 
            $returnSql .= _LEND._LEND.'--'._LEND;
            $returnSql .= "-- Creating relacionships for '".$row[0]."'";
            $returnSql .= _LEND.'--'._LEND._LEND;
            $returnSql .= "ALTER TABLE ONLY ".$row[0] . " ADD CONSTRAINT " . $row[1] . " " . $row[2] . ";";
        }
		return $returnSql;
	}


	//Save the sql file on server
	function save_sql($sql, $suffix='') {
        global $fmanager;

        $suffix = '_pgfull';
	    $random = '';
	    $charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";    
	    for ($i=0; $i<'8'; $i++) {
			$random .= $charset[(mt_rand(0,(strlen($charset)-1)))];
		}

        $filename = date('YmdHis').'_'.$GLOBALS['mosConfig_db'].$suffix.'.'.$random;

        //path to file
        $path = $GLOBALS['mosConfig_absolute_path'].'/administrator/backups/database/'.$filename.'.sql';
        if (!$fmanager->createFile( $fmanager->PathName( $path, false ), $sql )) {
            echo "<script> alert(\"".$fmanager->last_error()."\"); window.history.go(-1); </script>\n";
			exit();
        }
		return true;
	}


    //download sql file	
	function download_sql( $sql ) {

		//clean the output buffer
		@ob_end_clean();

		$sqlfile = '_'.$GLOBALS['mosConfig_db'].'.sql';
		@header("Cache-Control: "); // leave blank to avoid IE errors
		@header("Pragma: "); // leave blank to avoid IE errors
  		@header("Content-Type: application/force-download");
		@header("Content-Disposition: attachment; filename=".$sqlfile);
		echo $sql;
		exit();
	}
}
?>