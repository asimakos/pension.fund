<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


class mosInstaller {

	//name of the XML file with installation information
	public $i_installfilename	= "";
	public $i_installarchive	= "";
	public $i_installdir		= "";
	public $i_iswin			= false;
	public $i_errno			= 0;
	public $i_error			= "";
	public $i_installtype		= "";
	/* Package's Elxis main version */
    public $i_packelxisv	    = ""; 
	public $i_unpackdir		= "";
	public $i_docleanup		= true;
	/** @var string The directory where the element is to be installed */
	public $i_elementdir = '';
	/** @var string The name of the Elxis element */
	public $i_elementname = '';
	/** @var string The name of a special atttibute in a tag */
	public $i_elementspecial = '';
	/** @var object A SimpleXMLElement instance */
	public $i_xmldoc = null;
	public $i_hasinstallfile = null;
	public $i_installfile = null;
	/* Array of possible notices during installation (like wrong Elxis version) */
	public $i_elxnotices = array();
	/* Array of all errors during installation (i_error including) */
	private $i_elxerrors = array();


	/***************/
	/* CONSTRUCTOR */
	/***************/
	public function __construct() {
		$this->i_iswin = (substr(PHP_OS, 0, 3) == 'WIN');
	}


	/******************************/
	/* UPLOAD/UNPACK PACKAGE FILE */
	/******************************/
	public function upload($p_filename = null, $p_unpack = true) {
		$this->i_iswin = (substr(PHP_OS, 0, 3) == 'WIN');
		$this->installArchive($p_filename);

		if ($p_unpack) {
			if ($this->extractArchive()) {
				return $this->findInstallFile();
			} else {
				return false;
			}
		}
	}


	/***************************/
	/* EXTRACT ARCHIVE PACKAGE */
	/***************************/
	protected function extractArchive() { 
		global $mainframe, $adminLanguage, $fmanager;

		$base_Dir = $fmanager->PathName($mainframe->getCfg('absolute_path').SEP.'tmpr' );

		$archivename = $base_Dir.$this->installArchive();

		$tmpdir = uniqid('install_');

		$extractdir = $fmanager->PathName( $base_Dir . $tmpdir );
		$archivename = $fmanager->PathName( $archivename, false );

		$this->unpackDir($extractdir);

		if (preg_match('/(\.zip)$/i', $archivename)) {
			//Extract functions
			require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pcl/pclzip.lib.php');
			require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pcl/pclerror.lib.php');
			$zipfile = new PclZip($archivename);
			if ($this->isWindows()) {
				define('OS_WINDOWS',1);
			} else {
				define('OS_WINDOWS',0);
			}

			$ret = $zipfile->extract(PCLZIP_OPT_PATH, $extractdir);
			if($ret == 0) {
				$this->setError( 1, $adminLanguage->A_CMP_INST_ERUNR.' "'.$zipfile->errorName(true).'"' );
				return false;
			}
		} else {
			require_once($mainframe->getCfg('absolute_path').'/includes/Archive/Tar.php');
			$archive = new Archive_Tar( $archivename );
			$archive->setErrorHandling( PEAR_ERROR_PRINT );
	
			if (!$archive->extractModify($extractdir, '')) {
				$this->setError( 1, $adminLanguage->A_CMP_INST_EREXT );
				return false;
			}
		}
		$this->installDir($extractdir);

		//Try to find the correct install dir. in case that the package have subdirs
		//Save the install dir for later cleanup
		$filesindir = $fmanager->listFiles( $this->installDir(), '');

        //Package inside folder fix (datahell 2007-09-06)
        if (count($filesindir) == 0) {
            $dirsindir = $fmanager->listFolders( $this->installDir(), '');
            if (count( $dirsindir ) == 1) {
                $d = $fmanager->PathName($this->installDir().$dirsindir[0]);
                $filesindir2 = $fmanager->listFiles( $d, '');
                if (count($filesindir2) > 0) {
                    $filesindir[0] = $dirsindir[0];
                } else {
                    $dirsindir2 = $fmanager->listFolders( $d, '');
                    if (count( $dirsindir2 ) == 1) {
                        $filesindir[0] = $dirsindir[0].'/'.$dirsindir2[0];
                    }
                }
            }
        }

		if (count($filesindir) == 1) {
			if (is_dir( $extractdir . $filesindir[0] )) {
				$this->installDir( $fmanager->PathName( $extractdir.$filesindir[0] ) );
			}
		}
		return true;
	}


	/******************************/
	/* FIND XML INSTALLATION FILE */
	/******************************/
	private function findInstallFile() {
    	global $adminLanguage, $fmanager;

		$found = false;
		//Search the install dir for an xml file
		$files = $fmanager->listFiles( $this->installDir(), '.xml$', true, true );
		if (count( $files ) > 0) {
			foreach ($files as $file) {
				$packagefile = $this->isPackageFile($file);
				if (!is_null($packagefile) && !$found) {
					$this->xmlDoc($packagefile);
					return true;
				}
			}
			$this->setError(1, $adminLanguage->A_CMP_INST_ERMXM);
			return false;
		} else {
			$this->setError(1, $adminLanguage->A_CMP_INST_ERXML);
			return false;
		}
	}


	/*****************/
	/* LOAD XML FILE */
	/*****************/
	private function isPackageFile($p_file) {
        global $_VERSION, $adminLanguage;

		if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
		$xmlDoc = simplexml_load_file($p_file, 'SimpleXMLElement');
		if (!$xmlDoc) {
			if (version_compare(PHP_VERSION, '5.1.0') >= 0) {
				$errors = libxml_get_errors();
				if ($errors) {
					foreach ($errors as $error) {
						$msg = '<span style="font-weight: bold; color: #ff0000;">'.$adminLanguage->A_CMP_INS_ER.'</span> XML installation file: <strong>'.basename($p_file).'</strong>, Line: '.$error->line.', Column: '.$error->column."<br />\n";
						$msg .= $error->message;
						$this->setElxisError($msg);
					}
				}
				libxml_clear_errors();
			}
			return null;
		}
		if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
			if ($xmlDoc->getName() != 'mosinstall') {
				return null;
			}
		}
		$attrs =  $xmlDoc->attributes();
		if (!$attrs) { return null; }
		if (!isset($attrs['type']) || !isset($attrs['version'])) { return null; }
		//Set the type
		$this->installType($attrs['type']);
		//Set the package's Elxis version
        $this->packElxisVersion($attrs['version']);
		$this->installFilename($p_file);
		return $xmlDoc;
	}


	/******************************/
	/* READ XML INSTALLATION FILE */
	/******************************/
	protected function readInstallFile() {
		global $adminLanguage;

		if ($this->installFilename() == '') {
			$this->setError( 1, $adminLanguage->A_CMP_INST_ERNFN );
			return false;
		}

		if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
		$this->i_xmldoc = simplexml_load_file($this->installFilename(), 'SimpleXMLElement');
		if (!$this->i_xmldoc) { return false; }

		if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
			if ($this->i_xmldoc->getName() != 'mosinstall') {
				$this->setError(1, $adminLanguage->A_FILE.': "'.$this->installFilename().'" '.$adminLanguage->A_CMP_INST_ERVLD);
				return false;
			}
		}

		$attrs = $this->i_xmldoc->attributes();
		$this->installType($attrs['type']);
		$this->packElxisVersion($attrs['version']);
		return true;
	}


	//Abstract install method
	public function install() {
    	global $adminLanguage;
		die( $adminLanguage->A_CMP_INST_ERINC.' ' . strtolower(get_class( $this )) );
	}


	//Abstract uninstall method
	public function uninstall() {
    	global $adminLanguage;
		die( $adminLanguage->A_CMP_INST_ERUIC. ' ' . strtolower(get_class( $this )) );
	}


	//return to method
	public function returnTo( $option, $element ) {
		return "index2.php?option=$option&element=$element";
	}


	/**************************/
	/* PRE-INSTALLATION CHECK */
	/**************************/
	public function preInstallCheck( $p_fromdir, $type ) {
		global $adminLanguage;

		if (!is_null($p_fromdir)) {
			$this->installDir($p_fromdir);
		}

		if (!$this->installfile()) {
			$this->findInstallFile();
		}

		if (!$this->readInstallFile()) {
			$this->setError( 1, $adminLanguage->A_CMP_INST_ERIFN.':<br />' . $this->installDir() );
			return false;
		}

		if ($this->installType() != $type) {
			$this->setError( 1, $adminLanguage->A_CMP_INST_ERSXM.' "'.$type.'".' );
			return false;
		}

		//In case there where an error during reading or extracting the archive
		if ($this->errno()) {
			return false;
		}
		return true;
	}


	/********************************************/
	/* CREATE FILESYSTEM BY PARSING AN XML FILE */
	/********************************************/
	public function parseFiles($tagName='files', $special='', $specialError='', $adminFiles=0) {
		global $mainframe, $adminLanguage, $fmanager;

		//Find files to copy
		$xml = $this->xmlDoc();
		$tagName = preg_replace('#(^\/)#', '', $tagName);
		$tagName = preg_replace('#(\/)$#', '', $tagName);
		$parts = preg_split('#\/#', $tagName, -1, PREG_SPLIT_NO_EMPTY);
		$ok = false;
		if ($parts) {
			$x1 = $parts[0];
			if (isset($xml->$x1)) {
				if (isset($parts[1])) { //second level, i.e. administration/images
					$x2 = $parts[1];
					if (isset($xml->$x1->$x2)) {
						$ok = true;
						$element = $xml->$x1->$x2;
					}
				} else {
					$ok = true;
					$element = $xml->$x1;
				}
			}
		}
		
		if (!$ok) { return 0; }
		$files = $element->children();
		if (!$files || (count($files) == 0)) { return 0; }

		$attrs =  $element->attributes();
		if ($attrs && isset($attrs['folder'])) {
			$temp = $fmanager->PathName($this->unpackDir().$attrs['folder']);
			if ($temp == $this->installDir()) {
				//this must be only an admin component
				$installFrom = $this->installDir();
			} else {
				$installFrom = $fmanager->PathName($this->installDir().$attrs['folder']);
			}
		} else {
			$installFrom = $this->installDir();
		}

		$copyfiles = array();
		foreach ($files as $file) {
			$strfile = (string)$file;
			if (basename($strfile) != $strfile) {
				$newdir = dirname($strfile);
				if ($adminFiles){
					if (!$fmanager->createFolder($this->componentAdminDir().$newdir)) {
						$this->setError(1, $adminLanguage->A_CMP_INST_ERCDR.' "'.($this->componentAdminDir()).$newdir.'"');
						return false;
					}
				} else {
					if (!$fmanager->createFolder($this->elementDir().$newdir)) {
						$this->setError(1, $adminLanguage->A_CMP_INST_ERCDR.' "'.($this->elementDir()).$newdir.'"' );
						return false;
					}
				}
			}
			$copyfiles[] = $strfile;

			if ($special != '') {
				$attrs = $file->attributes();
				if ($attrs && isset($attrs[$special])) { $this->elementSpecial($attrs[$special]); }
			}
		}

		if ($specialError) {
			if ($this->elementSpecial() == '') {
				$this->setError(1, $specialError);
				return false;
			}
		}

		if ($tagName == 'media') {
			//media is a special tag
			$installTo = $fmanager->PathName($mainframe->getCfg('absolute_path').SEP.'images'.SEP.'stories');
		} else if ($adminFiles) {
			$installTo = $this->componentAdminDir();
		} else {
			$installTo = $this->elementDir();
		}
		$result = $this->copyFiles($installFrom, $installTo, $copyfiles);
		return $result;
	}


	/**
	* @param string Source directory
	* @param string Destination directory
	* @param array array with filenames
	* @param boolean True is existing files can be replaced
	* @return boolean True on success, False on error
	*/
	public function copyFiles( $p_sourcedir, $p_destdir, $p_files, $overwrite=false ) {
	  global $adminLanguage, $fmanager;

		if (is_array( $p_files ) && count( $p_files ) > 0) {
			foreach($p_files as $_file) {
				$filesource	= $fmanager->PathName( $fmanager->PathName( $p_sourcedir ) . $_file, false );
				$filedest = $fmanager->PathName( $fmanager->PathName( $p_destdir ) . $_file, false );

				if (!file_exists( $filesource )) {
					$this->setError( 1, $adminLanguage->A_FILE.' '.$filesource.' '.$adminLanguage->A_CMP_INST_FNOTE);
					return false;
				} else if (file_exists( $filedest ) && !$overwrite) {
					$this->setError( 1, $adminLanguage->A_CMP_INST_TAFC.' '.$filedest.' '.$adminLanguage->A_CMP_INST_AYIT );
					return false;
				} else {
					if( !( $fmanager->copyFile($filesource, $filedest) && $fmanager->eChmod($filedest))) {
						$this->setError( 1, $adminLanguage->A_CMP_INST_FCPF.' '.$filesource.' '.$adminLanguage->A_CMP_INST_CPTO.' '.$filedest );
						return false;
					}
				}
            }
		} else {
			return false;
		}
		return count( $p_files );
	}


	/**
	* Copies the XML setup file to the element Admin directory
	* Used by Components/Modules/Mambot/Bridges Installer Installer
	* @return boolean True on success, False on error
	*/
	public function copySetupFile( $where='admin' ) {
		if ($where == 'admin') {
			return $this->copyFiles( $this->installDir(), $this->componentAdminDir(), array( basename( $this->installFilename() ) ), true );
		} else if ($where == 'front') {
			return $this->copyFiles( $this->installDir(), $this->elementDir(), array( basename( $this->installFilename() ) ), true );
		}
	}

	/**
	* @param int The error number
	* @param string The error message
	*/
	public function setError( $p_errno, $p_error ) {
		$this->errno( $p_errno );
		$this->error( $p_error );
	}

	/**
	* @param boolean True to display both number and message
	* @param string The error message
	* @return string
	*/
	public function getError($p_full = false) {
		if ($p_full) {
			return $this->errno()." ".$this->error();
		} else {
			return $this->error();
		}
	}

	protected function setVar($name, $value=null) {
		if (!is_null($value)) { $this->$name = $value; }
		return $this->$name;
	}

	private function installFilename( $p_filename = null ) {
		if(!is_null($p_filename)) {
			if($this->isWindows()) {
				$this->i_installfilename = eUTF::utf8_str_replace('/','\\',$p_filename);
			} else {
				$this->i_installfilename = eUTF::utf8_str_replace('\\','/',$p_filename);
			}
		}
		return $this->i_installfilename;
	}


    /********************/
    /* SET INSTALL TYPE */
    /********************/
	private function installType( $p_installtype = null ) {
		return $this->setVar( 'i_installtype', $p_installtype );
	}


    /***********************/
    /* SET PACKAGE VERSION */
    /***********************/
	protected function packElxisVersion( $p_packelxisv = null ) {
	    if (!is_null($p_packelxisv)) {
	       $p_packelxisv = intval(substr($p_packelxisv, 0, strlen($p_packelxisv)-strlen(strstr($p_packelxisv, '.'))));
           $this->checkPackVersion($p_packelxisv);
        }
		return $this->setVar( 'i_packelxisv', $p_packelxisv );
	}


    /***********************************************/
    /* CHECK PACKAGE VERSION AGAINST ELXIS VERSION */
    /***********************************************/
    function checkPackVersion($packversion = 0) {
        global $_VERSION, $adminLanguage;

        if ($_VERSION->PRODUCT != 'E'.'l'.'x'.'i'.'s') { die(); }
        if ($packversion) {
            if ($packversion < 4) {
                $this->setNoticeOnPack($adminLanguage->A_INST_INCOMJOO);
            } else if ($packversion < 2006) {
                $this->setNoticeOnPack($adminLanguage->A_INST_INCOMMAM);
			} else if ($packversion < 2008) {
             	$msg = sprintf($adminLanguage->A_INST_OLDER, $packversion, $_VERSION->RELEASE.'.'.$_VERSION->DEV_LEVEL);
             	$this->setNoticeOnPack($msg);
			} else if (($_VERSION->RELEASE > 2009) && ($packversion < $_VERSION->RELEASE)) {
                $msg = sprintf($adminLanguage->A_INST_OLDER, $packversion, $_VERSION->RELEASE.'.'.$_VERSION->DEV_LEVEL);
                $this->setNoticeOnPack($msg);
            } else if ($packversion > $_VERSION->RELEASE) {
                $msg = sprintf($adminLanguage->A_INST_NEWER, $packversion, $_VERSION->RELEASE.'.'.$_VERSION->DEV_LEVEL);
                $this->setNoticeOnPack($msg);
            }
        }
    }


    /**************/
    /* SET NOTICE */
    /**************/
    public function setNoticeOnPack($notice='') {
        if ($notice != '') { $this->i_elxnotices[] = $notice; }
    }


    /***************/
    /* GET NOTICES */
    /***************/
	public function getNotices() {
	    $this->i_elxnotices = array_unique($this->i_elxnotices);
		return $this->i_elxnotices;
	}


    /*******************/
    /* SET ELXIS ERROR */
    /**************/
    public function setElxisError($errormsg='') {
        if ($errormsg != '') { $this->i_elxerrors[] = $errormsg; }
    }


    /******************/
    /* GET ALL ERRORS */
    /******************/
	public function getAllErrors() {
	    $allerrors = array();
		if ($this->i_error != '') { $allerrors[] = $this->i_error; }
		if ($this->i_elxerrors && (count($this->i_elxerrors) > 0)) {
			$this->i_elxerrors = array_unique($this->i_elxerrors);
			foreach ($this->i_elxerrors as $errmsg) {
				$allerrors[] = $errmsg;
			}
		}
		return $allerrors;
	}


    /*************/
    /* SET ERROR */
    /*************/
	public function error( $p_error = null ) {
		return $this->setVar( 'i_error', $p_error );
	}

	public function xmlDoc($p_xmldoc = null) {
		return $this->setVar('i_xmldoc', $p_xmldoc);
	}

	public function installArchive( $p_filename = null ) {
		return $this->setVar( 'i_installarchive', $p_filename );
	}

	function installDir( $p_dirname = null ) {
		return $this->setVar( 'i_installdir', $p_dirname );
	}

	function unpackDir( $p_dirname = null ) {
		return $this->setVar( 'i_unpackdir', $p_dirname );
	}

	function isWindows() {
		return $this->i_iswin;
	}

	function errno( $p_errno = null ) {
		return $this->setVar( 'i_errno', $p_errno );
	}

	function hasInstallfile( $p_hasinstallfile = null ) {
		return $this->setVar( 'i_hasinstallfile', $p_hasinstallfile );
	}

	function installfile( $p_installfile = null ) {
		return (string)$this->setVar( 'i_installfile', $p_installfile );
	}

	function elementDir($p_dirname = null)	{
		return (string)$this->setVar( 'i_elementdir', $p_dirname );
	}

	function elementName( $p_name = null )	{
		return (string)$this->setVar('i_elementname', $p_name);
	}
	function elementSpecial( $p_name = null )	{
		return (string)$this->setVar( 'i_elementspecial', $p_name );
	}
}

function cleanupInstall( $userfile_name, $resultdir) {
	global $mainframe, $fmanager;

	if (file_exists( $resultdir )) {
	  	$fmanager->deleteFolder( $resultdir );
		@$fmanager->deleteFile( $fmanager->PathName($mainframe->getCfg('absolute_path').SEP.'tmpr'.SEP.$userfile_name, false ) );
	}
}

?>