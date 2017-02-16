<?php 
/**
* @version: $Id: filemanager.class.php 2614 2010-04-17 16:03:38Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: FileManager
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @author: Ioannis Sannos (datahell@elxis.org)
* @description: FileManager Class is a collection of file managment related functions. 
* It also provides FTP access over files (if enabled).
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


/**
@	APPENDIX
@ FileManager Functions
@ ======================
@ __construct: sets enviroment variables, triggers setOS
@ setOS: sets operating system flags and directory seperator, triggered by the constructor
@ FileManager: calls the constructor ( __construct )
@ trigger_error: sets an error
@ last_error: returns last error -- Use of Elxis Gemini
@ callFTP: Initialize KFTP and triggers connectFTP
@ connectFTP: triggered by callFTP, connects to FTP server
@ closeFTP: closes an FTP connection
@ FTPpath: returns the FTP path from the absolute path
@ PathName: translates a path depending on the Operating System
@ FileExt: returns file extension
@ listFiles: lists files inside a folder (also replaces: mosReadDirectory )
@ listFolders: lists existing folders inside a container folder
@ spChmod: Chmods ONE file or ONE directory to given permissions
@ eChmod: triggers eChmodRecursive
@ eChmodRecursive: Chmods files and directories recursively to global permissions
@ readFile: reads a file
@ writeFile: Alias of createFile
@ createFile: creates a file and/or writes data in it
@ createFolder : creates a folder and all nessessary parent folders (replaces: mosMakePath)
@ deleteFile : deletes given file or array of files
@ deleteFolder : deletes a folder and all containing folders and files
@ deldir : deletes a folder and all containing folders and files using only PHP
@ copyFile: copies a file from source to destination (absolute paths)
@ upload: uploads a file 
@ fwSlashes: transforms backslashes to forward slashes
@ isElxisPath: returns true if given path is a valid Elxis path or false if it is not
@ getFileOwner: returns a file's owner
@ useFTPfowner: For internal use only. Determines FTP usage based of file's owner ID. Returns true or false
@ safemoded: Check if safe mode is ON, returns true (safe mode) or false (no safe mode)
*/

class FileManager {

    public $absolute_path;
    public $fileperms = '';
    public $dirperms = '';
    public $useftp = false;
    public $ftp_host= '127.0.0.1';
    public $ftp_user;
    public $ftp_pass;
    public $ftp_port = '21';
    public $ftp_root;
    public $_last_error = false;
    public $iswin = false;
    public $ismac = false;
    public $isuni = false;
    private $safemode = -2; //-2: not checked, -1: can not determine, 0: safe mode off, 1: safe mode on


    /***************/
    /* CONSTRUCTOR */
    /***************/
    public function __construct(){
        global $mosConfig_ftp, $mosConfig_ftp_host, $mosConfig_ftp_user, $mosConfig_ftp_pass, $mosConfig_ftp_port;
        global $mosConfig_ftp_root, $mosConfig_absolute_path, $mosConfig_fileperms, $mosConfig_dirperms;

		$this->absolute_path = $mosConfig_absolute_path;
		$this->fileperms = $mosConfig_fileperms;
		$this->dirperms = $mosConfig_dirperms;
        $this->useftp = $mosConfig_ftp == 1 ? true : false;
        $this->ftp_host= $mosConfig_ftp_host;
		$this->ftp_user = $mosConfig_ftp_user;
		$this->ftp_pass = $mosConfig_ftp_pass;
		$this->ftp_port = $mosConfig_ftp_port;
		$this->ftp_root = $mosConfig_ftp_root;
		$this->setOS();
    }


    /********************/
    /* OPERATING SYSTEM */
    /********************/
	protected function setOS() {
		$OS = strtoupper(substr(PHP_OS, 0, 3));
	  	switch ( $OS ) {
	  		case 'WIN':
			$this->iswin = true;
			DEFINE("SEP", "\\");
			DEFINE("_LEND", "\r\n");
	  		break;
	  		case 'MAC':
			$this->ismac = true;
			DEFINE("SEP", "/");
			DEFINE("_LEND", "\r");
	  		break;
	  		default:
			$this->isuni = true;
			DEFINE("SEP", "/");
			DEFINE("_LEND", "\n");
	  		break;
	  	}
	}

    //initialize FileManager by calling the constructor
    function FileManager(){
        $this->__construct();
    }

    /*
    Function trigger_error generates an error
    example of use: $this->trigger_error(@$php_errormsg,__FILE__,__LINE__);
    */
    public function trigger_error($msg, $file='', $line=''){
        $msg = trim(preg_replace('`^[a-zA-Z_]+\\(\\):? *`','',$msg));
        if( !$msg ) { $msg = _GEM_UNKN_ERR; }
        if ((trim($file) !== '') && (trim($line) !== '')) {
            $msg.=' in '.basename($file).' line '.$line;
        }
        $this->_last_error = $msg;
    }

    // Function last_error returns the last triggered error
    function last_error(){
        return $this->_last_error;
    }


    /************/
    /* CALL FTP */
    /************/
    function callFTP() {
        if (!isset($GLOBALS['ftp'])) {
            require_once ( $this->absolute_path.'/includes/KFTP/KFTP.php' );
            $ftp = new KFTP ($this->ftp_host, $this->ftp_port, $this->ftp_user, $this->ftp_pass);
        } else { 
            $ftp = $GLOBALS['ftp']; 
        }
        if ( $this->connectFTP( $ftp )) {
            return $ftp;
        } else {
            $this->trigger_error( _GEM_CNOT_CONFTP );
            return false; 
        }
    }

    //check if connected else connect to ftp server
    function connectFTP( &$ftp ) {
        $ret = false;
        if ( !$ftp->connected ) {
            if ($ftp->connect()) {
                $ret = true;
            }
        } else {
            $ret = true;
        }
        return $ret;
    }


    /************************/
    /* CLOSE FTP CONNECTION */
    /************************/
    function closeFTP() {
        $ret = false;    
        if (isset($GLOBALS['ftp'])) {
            $ftp = $GLOBALS['ftp'];
            if ( $ftp->connected() ) {
                if ($ftp->close()) {
                    $ret = true;
                }
            } else {
                $ret = true;
            }
        } else { $ret = true; }
        return $ret;
    }


    /*************************/
    /* RETURNS FULL FTP PATH */
    /*************************/
    function FTPpath( $path ) {
    	$diff = str_replace(str_replace( DIRECTORY_SEPARATOR, '/', $this->absolute_path), '', str_replace( DIRECTORY_SEPARATOR, '/', $path));
		return $this->ftp_root.$diff; 
    }


/**
* Function to strip additional / or \ in a path name
* @param string The path
* @param boolean Add trailing slash
OLD INFO: mosTemplate::mosPathName (FILE: includes/elxis.php)
*/
	function PathName($path, $addtrailingslash = true) {
		$retval = '';

		if ($addtrailingslash == true) {
			if (file_exists($path)) {
				if (is_file($path)) { $addtrailingslash = false; }
			} else {
				if ($this->FileExt($path) != '') { $addtrailingslash = false; }
			}
		}

		if ($this->iswin)	{
			$retval = str_replace( '/', '\\', $path );
			if ($addtrailingslash) {
				if (substr( $retval, -1 ) != '\\') {
					$retval .= '\\';
				}
			}
			// Remove double \\
			$retval = str_replace( '\\\\', '\\', $retval );
		} else {
			$retval = str_replace( '\\', '/', $path );
			if ($addtrailingslash) {
				if (substr( $retval, -1 ) != '/') {
					$retval .= '/';
				}
			}
			// Remove double //
			$retval = str_replace('//','/',$retval);
		}
		return $retval;
	}


    /*
    Function FileExt returns a file extension (lowercase)
    Can get any input, filename, absolute path, url and returns the extension
    There is only one issue with string like this: http://site.com/folder
    which we will handle seperatly
    Returns null if file has no extension (like README files)
    */
    function FileExt( $file ) {
    //alternative method: (returns $file if not found)
    //$ext = preg_replace("^.+\\.([^.]+)$", "\\1", $file);

        $ext = substr(strrchr($file, '.'), 1);
        if (preg_match('/\//', $ext)) { $ext = ''; }
        $ext = strtolower($ext);
        return $ext;
    }


	/*
    Function lists files inside a folder
    $path The path of the folder to list
    $filter A filter for file names
    $recurse True to recursively search into sub-folders
    $fullpath True to return the full path to the file
    Note: ftp mode is slow, so we prefer to use php for listing files
    */
	public function listFiles($path, $filter = '.', $recurse = false, $fullpath = false) {

		$use_FTP = false;
		$arr = array ();

		//Make sure that the given path is a folder
		if (!is_dir($path)) { return false; }

		if ($this->useftp) {
			if (!is_readable($path) || $this->safemoded()) { $use_FTP = true; }
		}

		if ($use_FTP == true) {
			if ($ftp = $this->callFTP()) {
			
			$fpath = $this->FTPpath( $path ); //get the ftp path
            $list = $ftp->readdir ( $fpath );

            foreach($list['files'] as $file => $info){
                if($file!=='.' && $file!=='..') {
                    if($info['is_dir']){
						if ( $recurse ) {	
							$arr2 = $this->listFiles($this->PathName( $path ).$file, $filter, $recurse, $fullpath);
							$arr = array_merge($arr, $arr2);
						}
                    } else {
                        if (preg_match("/$filter/", $file)) {
                            if ($fullpath) { //we display the absolute full path, not the ftp!
                                $arr[] = $this->PathName( $path ).$file;
						    } else {
							    $arr[] = $file;
                            }
						}
                    }
                }
            }
			} else { return false; }
		} else {
			$path = $this->PathName($path);
			// read the source directory
			$handle = opendir($path);
			while ($file = readdir($handle)) {
				$dir = $path.$file;
				$isDir = is_dir($dir);
				if ($file != '.' && $file != '..') {
					if ($isDir) {
						if ($recurse) {
							$arr2 = $this->listFiles($this->PathName($dir), $filter, $recurse, $fullpath);
							$arr = array_merge($arr, $arr2);
						}
					} else {
						if (preg_match("/$filter/", $file)) {
							if ($fullpath) {
								$arr[] = $path.$file;
							} else {
								$arr[] = $file;
							}
						}
					}
				}
			}
			closedir($handle);
		}
		asort($arr);
		return $arr;
	}

	/*
    Function lists existing folders inside a folder
    $path The path of the folder to read
    $filter A filter for folder names
    $recurse True to recursively search into sub-folders
    $fullpath True to return the full path to the folders
    Note: ftp mode is slow, so we prefer to use php for listing folders
    */
	public function listFolders($path, $filter = '.', $recurse=false, $fullpath=false) {

		$use_FTP = false;
		$arr = array ();

		//Make sure that the given path is a folder
		if (!is_dir($path)) { return false; }

		if ($this->useftp) {
			if (!is_readable($path) || $this->safemoded()) { $use_FTP = true; }
		}

		//Do we use FTP?
		if ($use_FTP == true) {
			if ($ftp = $this->callFTP()) {
                $fpath = $this->FTPpath( $path ); //get the ftp path
                $list = $ftp->readdir ( $fpath );

                foreach($list['files'] as $file => $info) {
				    if (($file != '.') && ($file != '..') && ($info['is_dir'])) {
                        if (preg_match("/$filter/", $file)) {
                            if ($fullpath) {
                                $arr[] = $this->PathName( $path ).$file;
                            } else {
                                $arr[] = $file;
                            }
                        }
    					if ( $recurse ) {
    						$arr2 = $this->listFolders($this->PathName( $path ).$file, $filter, $recurse, $fullpath);
    						$arr = array_merge($arr, $arr2);
    					}
                    }
                }
			} else { return false; }
		} else {
			// read the source directory
			$handle = opendir($path);
			while ($file = readdir($handle)) {
				$dir = $path.$file;
				if (($file != '.') && ($file != '..') && is_dir($dir)) {
					if (preg_match("/$filter/", $file)) {
						if ($fullpath) {
							$arr[] = $dir;
						} else {
							$arr[] = $file;
						}
					}
					if ($recurse) {
						$arr2 = $this->listFolders($this->PathName($dir), $filter, $recurse, $fullpath);
						$arr = array_merge($arr, $arr2);
					}
				}
			}
			closedir($handle);
		}
		asort($arr);
		return $arr;
	}


    /*
    Function chmods files and directories to given permissions
    path The starting file or directory (no trailing slash)
    mode the mode to change to (octal: 0777, 0644 etc)
    fclose Whether to close or not the FTP connection after Chmod (true = close)
    returns true or false
    */
    public function spChmod( $path, $mode, $fclose=false ) {
		$use_FTP = false;

        if ($this->useftp) {
			if (!is_readable($path) || $this->safemoded()) { $use_FTP = true; }
            if (!is_writable($path)) { $use_FTP = true; }
            if ($use_FTP == false) {
                if ($this->useFTPfowner($path) == true) { $use_FTP = true; }
            }
		}

        $ret = true;
		//Do we use FTP?
		if ($use_FTP == true) {
			if ($ftp = $this->callFTP()) {
                $fpath = $this->FTPpath( $path ); //get the ftp path
                if (!$ftp->chmod($fpath, $mode)) {
                    $ret = false;
                    $this->trigger_error( 'Could not change mode on '.$path );
                }
            } else {
                $ret= false;
                $this->trigger_error( _GEM_CNOT_CONFTP );
            }
        } else {
        	$ret = (is_string($mode)) ? @chmod( $path,octdec($mode)) : @chmod( $path,$mode);
        	if (!$ret) {
                $ret = false;
                $this->trigger_error( 'Could not change mode on '.$path );
            }
        }
        return $ret;
    }


    /*
    * Chmods files and directories recursively to mos global permissions. Available from 4.5.2 up.
    * @param path The starting file or directory (no trailing slash)
    * @param filemode Integer value to chmod files. NULL = dont chmod files.
    * @param dirmode Integer value to chmod directories. NULL = dont chmod directories.
    * @return TRUE=all succeeded FALSE=one or more chmods failed
    * @param fclose Whether to close or not the FTP connection after Chmod (true = close)
    */
    function eChmod( $path, $fclose=false ) {
        $filemode = NULL;
        if ($this->fileperms != '') {
            $filemode = $this->fileperms;
            //$filemode = octdec( $this->fileperms );
        }
        $dirmode = NULL;
    	if ($this->dirperms != '') {
            $dirmode = $this->dirperms;
            //$dirmode = octdec( $this->dirperms );
    	}
    	if (isset($filemode) || isset($dirmode)) {
    		return $this->eChmodRecursive($path, $filemode, $dirmode, $fclose);
    	}
    	return true;
    }


    /**
    * Chmods files and directories recursively to given permissions. Available from 4.5.2 up.
    * @param path The starting file or directory (no trailing slash)
    * @param filemode Integer value to chmod files. NULL = dont chmod files.
    * @param dirmode Integer value to chmod directories. NULL = dont chmod directories.
    * @return TRUE=all succeeded FALSE=one or more chmods failed
    */
	public function eChmodRecursive($path, $filemode=NULL, $dirmode=NULL, $fclose=false) {
		$use_FTP = false;

        if ($this->useftp) {
			if (!is_readable($path) || $this->safemoded()) { $use_FTP = true; }
            if (!is_writable($path)) { $use_FTP = true; }
            if ($use_FTP == false) {
                if ($this->useFTPfowner($path) == true) { $use_FTP = true; }
            }
		}

		//Do we use FTP?
		if ($use_FTP == true) {
		$ret = true;
			if ($ftp = $this->callFTP()) {
                $fpath = $this->FTPpath( $path ); //get the ftp path
                if ($ftp->is_dir( $fpath )) {
					$list = $ftp->readdir ( $fpath );
                	foreach($list['files'] as $file => $info) {
						if (($file != '.') && ($file != '..')) {
							$fullpath = $this->PathName( $path ).$file;
							if ($info['is_dir']) {
								if (!$this->eChmodRecursive($fullpath, $filemode, $dirmode)) {
                            		$ret = false;
                            	}
                            } else {
								if (isset($filemode)) {
    	                    		if (!@$ftp->chmod($fpath.$file, $filemode)) {
    	                    			$ret = false;
    	                    		}
    	                    	}
    	                    }
    	                }
    	            } // foreach
    	    		if (isset($dirmode)) {
    	        		if (!@$ftp->chmod($fpath, $dirmode)) {
    	            		$ret = false;
    	            	}
    	            }
    	        } else {
    				if (isset($filemode)) {
    					$ret = @$ftp->chmod($fpath, $filemode);
        			}
				}
			} else {
			    $this->trigger_error('Could not connect to FTP host: '.$this->ftp_host);
            	$ret = false;
            }
        } else { //if we dont use ftp
    	$ret = true;
    		if (is_dir($path)) {
	    	    $dh = opendir($path);
	    	    while ($file = @readdir($dh)) {
	    	        if ($file != '.' && $file != '..') {
	    	            $fullpath = $this->PathName( $path ).$file;
	    	            if (is_dir($fullpath)) {
	                        if (!$this->eChmodRecursive($fullpath, $filemode, $dirmode)) {
	                            $ret = false;
	                        }
	    	            } else {
	    	                if (isset($filemode)) {
	    	                	$ret = (is_string($mode)) ? @chmod( $fullpath,octdec($filemode)) : @chmod( $fullpath,$filemode);
	    	                }
	    	            }
	    	        }
	    	    }
	    	    closedir($dh);
	    	    if (isset($dirmode)) {
	    	    	$ret = (is_string($mode)) ? @chmod( $path,octdec($dirmode)) : @chmod( $path,$dirmode);
	    	    }
	    	} else {
	    		if (isset($filemode)) {
	    			$ret = (is_string($mode)) ? @chmod( $path,octdec($filemode)) : @chmod( $path,$filemode);
	    		}
	        } 
	    }
	    return $ret;	    
	}


	/*
    Function reads the contents of a file
    $filename: The full file path
    Returns file contents or false
    ELXIS NOTE:
    KFTP does not have a built-in function for reading files.
    So we will download it to tmpr folder, read it and then delete it.
    use htmlspecialchars() to display resulted file contents
    
    FUNCTION SHOULD BE CHECKED FOR FTP, IF PROBLEMS, DELETE FTP PART!
	*/
	public function readFile($filename) {

		$use_FTP = false;
        $contents = null; //(data)

		if ($this->useftp) {
			if (!is_readable($filename) || $this->safemoded()) { $use_FTP = true; }
			//If it is a remote file then don't use FTP
			if (substr($filename, 0, 7) == 'http://') { $use_FTP = false; }			
        	//If tmpr folder is not writable don't use FTP
			if (!is_writable($this->absolute_path.SEP.'tmpr')) { $use_FTP = false; }			
		}

		//Do we use FTP?
		if ($use_FTP == true) {
		$ret = true;
			if ($ftp = $this->callFTP()) {
                $fpath = $this->FTPpath( $filename ); //get the ftp path ($file)

                //download file to tmpr folder
                $localfile = $this->absolute_path.SEP.'tmpr'.SEP.'_'.date('dmYHis');
                if ($ftp->get($localfile, $fpath)) {
                    $handle = @fopen($localfile, "r");
                    $contents = @fread($handle, filesize($localfile));
                    @fclose($handle);
                    @unlink ($localfile);
            		if ($ftp->mode == FTP_ASCII) {
                        $lineEndings = array ('UNIX' => "\n", 'MAC' => "\r", 'WIN' => "\r\n");
                        $contents = preg_replace("/\r\n/", $lineEndings[strtoupper(substr(0,3,$PHP_OS))], $contents);
                    }
                } else {
                    $this->trigger_error('Unable to read file '.$filename);
				    return false;
				}
			} else {
			    $this->trigger_error('Could not connect to FTP host: '.$this->ftp_host);
            	return false;
            }
		} else {
			if (false === $handler = @fopen($filename, 'rb')) {
				$this->trigger_error('Unable to open file '.$filename);
				return false;
			}
			clearstatcache();
			if ($fsize = @filesize($filename)) {
				$contents = fread($handler, $fsize);
			} else {
				$contents = '';
				while (!feof($handler)) {
					$contents .= fread($handler, 8192);
				}
			}
			@fclose($handler);
		}
		return $contents;
	}

	/*
    Function writes data in a file
    $file: The full file path
    $data: The data to be written
    $fclose: leave open or close the FTP connection
    Alias for createFile
	*/
	function writeFile($file, $data=null, $fclose=false) {
	   if ($this->createFile($file, $data, $fclose)) {
	       return true;
	    } else {
	       return false;
	    }
	}


	/*
    Function creates a file and writes data in it.
    $file: The full file path
    $data: The data to be written
    $fclose: leave open or close the FTP connection
	If data is null then just creates the file
    Returns true or false
    Folder /tmpr must be writable
	*/
	public function createFile($file, $data=null, $fclose=false) {
		$use_FTP = false;

		//If it is a remote file then exit with error, you can not create a remote file!
		if (substr($file, 0, 7) == 'http://') {
            $this->trigger_error( 'You can not create a remote file!' );
			return false;
		}

		if ($this->useftp) {
			if (!is_writable(dirname($file)) || $this->safemoded()) { $use_FTP = true; }
        	if ((file_exists($file)) && (!is_writable($file))) { $use_FTP = true; }
        }

        $ret = false;
		//Do we use FTP?
		if ($use_FTP == true) {
			if ($ftp = $this->callFTP()) {
                $fpath = $this->FTPpath( $file ); //get the ftp path ($file)
                
                //get only the filename (win and unix)
                $keys = preg_split("/[\\\]+/", $file);
                $c = count($keys)-1;
                $keys2 = preg_split("/[\/]+/", $keys[$c]);
                $j = count($keys2)-1;

                $localFile = $this->absolute_path.'/tmpr/'.$keys2[$j];

                //write data to temporary file (PHP5 but in compatibility file)
                if (!file_put_contents($localFile, $data)) {
                    $this->trigger_error('Folder /tmpr must be writable!');
				    return false;
				}
                if (!$ftp->put($fpath, $localFile)) {
                    @unlink( $localFile );
                    $this->trigger_error( 'Could not create/write to file '.$file );
				    return false;
				}
                @unlink( $localFile );
				$ret = true;
            } else {
			    $this->trigger_error('Could not connect to FTP host: '.$this->ftp_host);
            	$ret = false;
            }
        } else {
            if ( $handle = @fopen( $file, "w" )) {
                if ( $data ) {
                    @fwrite( $handle, $data );      
                }
                @fclose( $handle );
                $ret = true;
            } else {
                $this->trigger_error( 'Could not open for writing file '.$file );
                $ret = false;
            }
        }
        return $ret;
	}


	/*
    Function Creates a folder -- and all necessary parent folders
    $path A path to create from the base path
    $mode Directory permissions to set for folders created
    */
	public function createFolder($path = '', $mode = 0777) {
		$use_FTP = false;

		// Check if dir already exists
		if (is_dir($path)) { return true; }
		if ($this->useftp) {
			if (!is_writable(dirname($path)) || $this->safemoded()) { $use_FTP = true; }
		}

		//Do we use FTP?
		if ($use_FTP == true) {
		$ret = true;
			if ($ftp = $this->callFTP()) {
                //Create all needed parent folders (Recursive)
                $xdirs = array();
                $condir = dirname($path);
                $deep = false;

                while ($deep == false) {
                    if(!file_exists($condir)) {
                        $xdirs[] = $condir;
                        $condir = dirname($condir);
                    } else {
                        $deep = true;
                    }
                } 

                $x = count($xdirs);
                if ( $x> 0) {
                	for ($i=$x-1; $i>=0; $i--) {
                	    $xdirpath = $this->FTPpath( $xdirs[$i] );
                        $ftp->mkdir( $xdirpath );
                    }
                }

                $fpath = $this->FTPpath( $path ); //get the ftp path
                if ( !$ftp->mkdir( $fpath )) {
                    $ret= false;
                    $this->trigger_error( _GEM_FCREATE_DIR );
                }
                $mode = intval(substr($mode, -3));
                if ( !$ftp->chmod( $fpath, $mode )) {
                    $ret = false;
                    $this->trigger_error( _GEM_FCPERM_DIR );
                }
			} else {
    			$this->trigger_error('Could not connect to FTP host: '.$this->ftp_host);
                $ret = false;
			}
		} else {
			// First set umask
			$origmask = @umask(0);
	
			// We need to get and explode the open_basedir paths
			$obd = ini_get('open_basedir');

			// If open_basedir is et we need to get the open_basedir that the path is in
			if ($obd != null) {
                if ($this->iswin) {
					$obdSeparator = ";";
				} else {
					$obdSeparator = ":";
				}
				// Create the array of open_basedir paths
				$obdArray = explode($obdSeparator, $obd);
				$inOBD = false;
				// Iterate through open_basedir paths looking for a match
				foreach ($obdArray as $test) {
					if (!(strpos($path, $test) === false)) {
						$obdpath = $test;
						$inOBD = true;
						break;
					}
				}
				if ($inOBD == false) {
					// Return false for because the path to be created is not in open_basedir
                    $this->trigger_error( _GEM_FCREATE_DIR );
					return false;
				}
			}
			// Just to make sure
			$inOBD = true;
			do {
				$dir = $path;
				while (!@mkdir($dir, $mode)) {
					$dir = dirname($dir);
					if ($obd != null) {
						if (strpos($dir, $obdpath) === false) {
							$inOBD = false;
							break 2;
						}
					}
					if ($dir == '/' || is_dir($dir)) {
						break;
					}
				}
			} while ($dir != $path);
			// Reset umask
			@umask($origmask);
			// If there is no open_basedir restriction this should always be true
			if ($inOBD == false) {
				// Return false because could not create path without violating open_basedir restrictions
                $this->trigger_error( _GEM_FCREATE_DIR );
				$ret = false;
			} else {
				$ret = true;
			}
		}
		return $ret;
	}


	/*
    Function deletes a file or an array of files
    $file the file(s) to be deleted
    */
	public function deleteFile( $file, $fclose=false ) {
		$use_FTP = false;
		
		if (is_array($file)) {
			$files = $file;
		} else {
			$files[] = $file;
		}

		if ($this->useftp && $this->safemoded()) { $use_FTP = true; }

		$ret = true;
		//Do we use FTP?
		if ($use_FTP == true) {
			if ($ftp = $this->callFTP()) {
				foreach ($files as $file) {
                	$ffile = $this->FTPpath( $file ); //get the ftp path
                	if ( !$ftp->delete( $ffile )) {
                		$ret = false;
                		$this->trigger_error( ' Could not delete file '.$file );
                	}
                }
            }
        } else {
			foreach ($files as $file) {
                if ( !@unlink( $file )) {
                	$ret = false;
                	$this->trigger_error( ' Could not delete file '.$file );
				}
			}
		}				 			
		return $ret;
	}


	/*
    Function deletes a folder and all included files and folders
    $path The path of the folder we want to delete
    We could use the $ftp->deltree , $ftp->deltree_local functions of KFTP
    */
	public function deleteFolder($path, $fclose=false) {
		$path = $this->PathName($path);

        $ret = true;
		$use_FTP = false;

		//Check if path is not a folder
		if (!is_dir($path)) {
		  	$this->trigger_error = 'Path is not a folder: '.$path; 
			return false;
		}

		if ($this->useftp) {
			if (!is_writable($path) || $this->safemoded()) { $use_FTP = true; }
		}

		//Do we use FTP?
		if ($use_FTP == true) {
			if ($ftp = $this->callFTP()) {
                $fpath = $this->FTPpath( $path ); //get the ftp path
                if ( !$ftp->deltree( $fpath )) {
                    $ret= false;
                    $this->trigger_error( 'Could not delete directory '.$path );
                }
            }
		} else {
			$ret = $this->deldir($path);		
		/*
		    $files = $this->listFiles($path, '.', true, true);
            if (count($files) > 0) {
    		    foreach ( $files as $file ) {
    		        @unlink( $file );
    		    }
    		}
		    $folders = $this->listFolders($path, '.', true, true);    		
            if (count($folders) > 0) {
    		    foreach ( $folders as $folder ) {
    		        @rmdir( $folder );
    		    }
    		}
			$ret = @rmdir($path);
		*/
		}
		return $ret;
	}
    
    //recurse php delete directory
    function deldir( $dir ) {
    	$current_dir = opendir( $dir );
    	while ($entryname = readdir( $current_dir )) {
    		if ($entryname != '.' and $entryname != '..') {
    			if (is_dir( $dir . $entryname )) {
    				$this->deldir( $this->PathName( $dir . $entryname ) );
    			} else {
    				@unlink( $dir . $entryname );
    			}
    		}
    	}
    	closedir( $current_dir );
    	return rmdir( $dir );
    }

	/*
	Function copies a file from src to dest (absolute paths)
	ATTENTION: by default connection remains OPEN, use closeFTP to close it from outside this function!
	*/
	public function copyFile($src, $dest, $fclose=false) {

        $use_FTP = false;
		$src = $this->PathName ($src, false);
		$dest = $this->PathName ($dest, false);

		//Check source path
		if (!is_readable($src)) {
			$this->trigger_error( 'Cannot find or read file: '.$src );
			return false;
		}

		if ($this->useftp) {
			if ((file_exists($dest) && !is_writable($dest)) || (!file_exists($dest) && !is_writable(dirname($dest)))) {
				$use_FTP = true;
			} elseif ($this->safemoded()) {
				$use_FTP = true;
			}
		}

		if ($use_FTP == true) {
			if ($ftp = $this->callFTP()) {
                $fdest = $this->FTPpath( $dest ); //get the dest ftp path

                // If the parent folder doesn't exist we must create it
			    if (!file_exists(dirname($dest))) {
				    $this->createFolder(dirname($dest));
			    }
	
                if ( !$ftp->put( $fdest, $src )) {
				    return false;
			     }
			     $ret = true;
			} else {
			    $this->trigger_error( _GEM_CNOT_CONFTP );
			    return false;
			}
			
		} else {
			if (!@copy($src, $dest)) {
			    $this->trigger_error( _GEM_CNOT_COPYF );
				return false;
			}
			$ret = true;
		}
		return $ret;
	}


    /*
    Function to upload files on server
    @$src The name of the php (temporary) uploaded file ( usually: $userfile['tmp_name'] )
    @$desc param string $dest The path (including filename) to move the uploaded
    */
	public function upload( $src, $dest ) {
		$use_FTP = false;
		$ret = false;

		$baseDir = dirname($dest);
		if (!file_exists($baseDir)) { $this->createFolder($baseDir); }

		if ($this->useftp) {
			/*
        	If the destination file exists but isn't writable OR if the file
        	doesn't exist and the parent directory is not writable we need to use FTP
        	*/
			if ((file_exists($dest) && !is_writable($dest)) || (!file_exists($dest) && !is_writable(dirname($dest)))) {
				$use_FTP = true;
			} elseif ($this->safemoded()) {
				$use_FTP = true;
			}
		}

		//Do we use FTP?
        if ($use_FTP) {
			if ($ftp = $this->callFTP()) {
                $fdest = $this->FTPpath( $dest ); //get the ftp path
                if ($ftp->put($fdest,$src)) {
                    $ret = true;
                } else {
                    $this->trigger_error( _GEM_CNOT_UPFTP );
                }
            } else {
                $this->trigger_error( _GEM_CNOT_CONFTP );
            }
        } else {
            if (move_uploaded_file($src, $dest)) {
                if ($this->eChmod( $dest )) {
					$ret = true;
				} else {
				    $this->trigger_error( _GEM_FCPERM_UPFILE );
				}
			} else {
                $this->trigger_error( _GEM_FMOVE_UPFILE );
			}        
        }
        return $ret;
    }


    function fwSlashes( $path ) {
        $out = str_replace( '\\', '/', $path );
        return $out;
    }


    function isElxisPath( $path ) {
        global $mosConfig_absolute_path;

        $base = $this->fwSlashes($this->absolute_path);
        $base = preg_replace('/(\/\/)/', '/', $base); //replace double win slashes with single slashes
        $base = preg_replace('/\/$/', '', $base); //strip out any traing slash
        $path = $this->fwSlashes($path);
        $path = preg_replace('/(\/\/)/', '/', $path); //replace double win slashes with single slashes
        $path = preg_replace('/\/$/', '', $path); //strip out any traing slash

        $dfs = array(
            'administrator',
            'bridges',
            'cache',
            'components',
            'editor',
            'help',
            'images',
            'includes',
            'installation',
            'language',
            'mambots',
            'media',
            'modules',
            'templates',
            'tmpr',
            'index.php',
            'index2.php',
            'offline.php',
            'configuration.php'
        );
    
        $isvalid = false;
        if ($base == $path ) { 
            $isvalid = true;
        } else {
            foreach ($dfs as $df) {
                if (preg_match('#'.$base.'\/'.$df.'#', $path)) {
                    $isvalid = true;
                    break;
                }
            }
        }
        return $isvalid;
    }


    /******************/
    /* GET FILE OWNER */
    /******************/
    function getFileOwner($path='') {
        global $mosConfig_ftp, $mosConfig_absolute_path;

        if ($path == '') { return 'Unknown'; }
        if (!preg_match("/^(WIN)/", strtoupper(php_uname('s')))) {
            $fown = fileowner($path);
            if (function_exists('posix_getpwuid')) {
                $pos = posix_getpwuid($fown);
                return $pos['name'];
            }

            //consider index.php as owned by local user
            $ifile = $this->PathName($mosConfig_absolute_path.'/index.php');
            $iown = fileowner($ifile);
			if ($iown == $fown) {
			    if ($mosConfig_ftp && ($this->ftp_user != '')) {
			        return $this->ftp_user;
			    } else {
			        return 'Local User';
			    }
			} else {
			    //try to determine file owner by creating a temporary file
			    $tfile = $this->PathName($mosConfig_absolute_path.'/tmpr/temp.txt');
			    if (@touch($tfile)) {
			        $town = fileowner($tfile);
                    unlink($tfile);
                    if ($town == $fown) {
                        return 'nobody';
                    } else if ($mosConfig_ftp && ($this->ftp_user != '')) {
                        return $this->ftp_user;
                    } else {
                        return 'Local User';
                    }
                }
			}
        }
        return 'Unknown';
    }


    /*******************************************/
    /* DETERMINE FTP USAGE BASED ON FILE OWNER */
    /*******************************************/
    function useFTPfowner($path='') {
        global $mosConfig_absolute_path;

        if ($path == '') { return false; }
        if (!preg_match("/^(WIN)/", strtoupper(php_uname('s')))) {
            $fown = fileowner($path);
            //consider index.php as owned by local user
            $ifile = $this->PathName($mosConfig_absolute_path.'/index.php');
            $iown = fileowner($ifile);
			if ($iown == $fown) {
                return true;
			} else {
                return false;
			}
        }
        return false;
    }


	/*************************************/
	/* CHECK/GET IF SAFE MODE IS ENABLED */
	/*************************************/
	private function safemoded() {
		if ($this->safemode == -2) {
			if (function_exists('ini_get') && is_callable('ini_get')) {
				$this->safemode = (int)ini_get('safe_mode') ? 1 : 0;
			} else {
				$this->safemode = -1;
			}
		}
		return ($this->safemode === 1) ? true : false;
	}

} //end of class

?>