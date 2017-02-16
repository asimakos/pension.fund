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
* @description: MySQL dump database driver
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class dump {

    public $lock_table = 1;
    public $full_syntax = 1;
    public $drop_table = 1;
    public $data = '1'; //0: Only Structure, 1: Structure+Data, 2: Only Data
	public $tables = null;
	public $conn = null;
	public $result = null;
	public $error = '';

	//function dump
	public function __construct( $options=array() ) {
	    global $database;

	    $this->conn = $database->_resource;
	    
	    if ( count($options)> 0) {
    	    $this->lock_table = $options['lock_table'];
    	    $this->full_syntax = $options['full_syntax'];
    	    $this->drop_table = $options['drop_table'];
    	    $this->data = $options['data'];
    	}
	}

	//Return last error
	function error() {
		return $this->error;
	}
		
	/**
	 * Take backup of the database
	 * @param string $tables (It can be string seperated by coma (,) or single table name on an array of table names)
	 * @param Int $options
	 * @return String SQL Commands
	 */
	function dumpDB( $tbls = '' ) {

		$dbname = $GLOBALS['mosConfig_db'];

		$returnSql = '# ELXIS MySql Dump'._LEND;
		$returnSql .= '# Host: '.$GLOBALS['mosConfig_host']._LEND;
		$returnSql .= '# Database: '.$dbname._LEND;
		$returnSql .= '# Attention: This file is UTF-8 encoded'._LEND;
		$returnSql .= '# -------------------------------------------------'._LEND;

		$sql = "SELECT VERSION()";
		$this->result = mysql_query($sql);
		$row = mysql_fetch_array($this->result, MYSQL_NUM);
		mysql_free_result( $this->result );
		$returnSql .= '# Server version '.$row[0]._LEND._LEND;

		$returnSql.= "USE ".$dbname.";"._LEND._LEND;
		$this->result = @mysql_query("USE ".$dbname);

		if(mysql_error() !== '') {
			$this->error="Error : ".mysql_error();
			return false;
		}
				
		$this->tables = array();

		if($tbls == '') {
			$sql = "SHOW Tables";
			$this->result = @mysql_query($sql);
			if(mysql_error()!=="") {
				$this->error="Error : ".mysql_error();
				return false;
			}

			while ( $row = mysql_fetch_array( $this->result, MYSQL_NUM )) {
				$this->tables[]=$row[0];
			}
			mysql_free_result( $this->result );		
			
		} else if( is_string( $tbls )) {
			$this->tables = @explode( ',', $tbls );
		}

			for($j=0 ; $j < count($this->tables) ; $j++) {
				if (( $this->data == 0 ) || ( $this->data == 1 )) {
				
					$sql = "SHOW CREATE TABLE ".$this->tables[$j];
					$this->result = @mysql_query( $sql );
					if( mysql_error() !== '' ) {
						$this->error = 'Error: '.mysql_error();
						return false;
					}

					$row = mysql_fetch_array($this->result, MYSQL_NUM);
					mysql_free_result( $this->result );
					
					$returnSql .= ' #'._LEND;
					$returnSql .= ' # Table structure for table \''.$this->tables[$j].'\''._LEND;
					$returnSql .= ' #'._LEND._LEND;

					if ( $this->drop_table == 1 ) {
						$returnSql .= "DROP TABLE IF EXISTS ".$this->tables[$j].";"._LEND;
					}
					$returnSql .= $row[1].";"._LEND._LEND._LEND;
				}

				if (( $this->data == 1 ) || ( $this->data == 2 )) {
					$returnSql .= ' #'._LEND;
					$returnSql .= ' # Dumping data for table \''.$this->tables[$j].'\''._LEND;
					$returnSql .= ' #'._LEND._LEND;
					
					if ( $this->lock_table == 1 ) {
						$returnSql .= "LOCK TABLES ".$this->tables[$j]." WRITE;"._LEND;
                    }
					$temp_sql = "INSERT INTO ".$this->tables[$j];
					
					if ( $this->full_syntax == 1 ) {
						$sql = "SHOW COLUMNS FROM ".$this->tables[$j];
						$this->result = @mysql_query($sql);
						if( mysql_error() !== '' ) {
							$this->error= 'Error: '.mysql_error();
							return false;
						}
						$fields = array();
						while($row = mysql_fetch_array($this->result,MYSQL_NUM)) {
							$fields[]=$row[0];
						}
						mysql_free_result( $this->result );
						$temp_sql.=' (`'.@implode('`,`',$fields).'`)';
					}

					$sql="SELECT * FROM ".$this->tables[$j];
					$this->result = @mysql_query($sql);
					if(mysql_error()!=='') {
						$this->error= 'Error : '.mysql_error();
						return false;
					}
					while($row = mysql_fetch_array($this->result,MYSQL_NUM)) {
						foreach($row as $key => $value) {
							$row[$key] = mysql_real_escape_string($value);
						}

						$returnSql .=$temp_sql.' VALUES ("'.@implode('","',$row).'");'._LEND;
					}
					mysql_free_result( $this->result );
					
					if ( $this->lock_table == 1 ) {
						$returnSql .= "UNLOCK TABLES;"._LEND;
					}
				}
				$returnSql .=_LEND._LEND;
			}
		return $returnSql;
	}

	//Save the sql file on server
	function save_sql($sql, $suffix='') {
        global $fmanager;

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
			exit;
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
		//@header("Content-type: application/octet-stream");
  		@header("Content-Type: application/force-download");
		@header("Content-Disposition: attachment; filename=".$sqlfile);

		echo $sql;
		exit();
	}

    /************************************************
    //NOT IN USE, LEAVE IT FOR FUTURE UPDATES
	//Restore a backup file
	function restoreDB($sqlfile) {
		$this->error = '';
			
		if(!is_file($sqlfile)) {
			$this->error="Error : Not a valid file.";
			return false;
		}
			
		$lines=@file($sqlfile);
		if(!is_array($lines)) {
			$uploadMsg = "Sql File is empty.";
		} else {
			foreach($lines as $line) {
				$sql.=trim($line);
				if(empty($sql)) {
					$sql = '';
					continue;
				} elseif(preg_match("/^[#-].*+\r?\n?/i",trim($line))) {
					$sql = '';
					continue;
				} elseif(!preg_match("/;[\r\n]+/",$line)) {
					continue;
				}

				@mysql_query($sql);
				if(mysql_error() != '') {
					$this->error.='<br>'.mysql_error();
				}
				$sql = '';
			}
			if(!empty($this->error)) {
				return false;
			}
			return true;
		}
	}
	****************************************************/
}
?>