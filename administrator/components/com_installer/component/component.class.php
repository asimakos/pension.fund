<?php 
/**
* @version: $Id: component.class.php 2607 2010-03-28 10:54:06Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Components Installer
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class mosInstallerComponent extends mosInstaller {

	public $i_componentadmindir = "";
	public $i_hasinstallfile = false;
	public $i_installfile = "";

	function componentAdminDir($p_dirname = null) {
	    global $fmanager;

		if(!is_null($p_dirname)) {
			$this->i_componentadmindir = $fmanager->PathName($p_dirname);
		}
		return $this->i_componentadmindir;
	}


	/*************************/
	/* CUSTOM INSTALL METHOD */
	/*************************/
	public function install($p_fromdir = null) {
		global $mainframe, $database, $adminLanguage, $fmanager;

		if (!$this->preInstallCheck($p_fromdir, 'component')) {
			return false;
		}

		//aje moved down to here. ??  seemed to be some referencing problems
		$xml = $this->xmlDoc();

		//Set some vars
		$this->elementName($xml->name);
		$this->elementDir($fmanager->PathName($mainframe->getCfg('absolute_path').SEP."components"
			.SEP.strtolower("com_".str_replace(" ","",$this->elementName())).SEP )
		);
		$this->componentAdminDir( $fmanager->PathName($mainframe->getCfg('absolute_path'). SEP ."administrator". SEP ."components"
			. SEP . strtolower( "com_" . str_replace( " ","",$this->elementName() ) ) )
		);

        if (file_exists($this->elementDir())) {
            $this->setError( 1, $adminLanguage->A_CMP_INST_CUDIR . ': "' . $this->elementDir() . '"' );
			return false;
        }

		if(!file_exists($this->elementDir()) && !$fmanager->createFolder($this->elementDir())) {
			$this->setError( 1, $adminLanguage->A_CMP_INST_ERCDR . ' "' . $this->elementDir() . '"' );
			return false;
		}

		if(!file_exists($this->componentAdminDir()) && !$fmanager->createFolder($this->componentAdminDir())) {
			$this->setError( 1, $adminLanguage->A_CMP_INST_ERCDR . ' "' . $this->componentAdminDir() . '"' );
			return false;
		}

		//Find files to copy
		if ($this->parseFiles('files') === false) {
		    return false;
		}
		$this->parseFiles('images');
		$this->parseFiles('administration/files','','',1);
		$this->parseFiles('administration/images','','',1);

		//Are there any SQL queries??
		if (isset($xml->install->queries)) {
			$queries = $xml->install->queries->children();
			if ($queries) {
				foreach($queries as $query) {
					$query = (string)$query;
					$database->setQuery($query);
					if (!$database->query()) {
						$this->setError(1, $adminLanguage->A_CMP_INST_SQLER.' '.$database->stderr( true ) );
						return false;
					}
				}
			}
		}

		//Is there an installfile?
		if (isset($xml->installfile->filename)) {
			$install_file = (string)$xml->installfile->filename[0];
			if ($install_file != '') {
	        	// check if parse files has already copied the install.component.php file (error in 3rd party xml's!)
	        	if (!file_exists($this->componentAdminDir().$install_file)) {
	            	if(!$this->copyFiles($this->installDir(), $this->componentAdminDir(), array($install_file))) {
	                	$this->setError(1, $adminLanguage->A_CMP_INST_CCPHP);
	                	return false;
	            	}
	        	}
	        	$this->hasInstallfile(true);
	        	$this->installFile($install_file);
			}
		}
		
		//Is there an uninstallfile?
		if (isset($xml->uninstallfile->filename)) {
			$uninstall_file = (string)$xml->uninstallfile->filename[0];
			if ($uninstall_file != '') {
	        	if (!file_exists($this->componentAdminDir().$uninstall_file)) {
	            	if(!$this->copyFiles($this->installDir(), $this->componentAdminDir(), array($uninstall_file))) {
	                	$this->setError(1, $adminLanguage->A_CMP_INST_CCUNPHP);
	                	return false;
	            	}
	        	}
			}
		}

		//Are there any menus?
		if (isset($xml->administration->menu)) {
			$com_name = strtolower('com_'.str_replace(' ', '',$this->elementName()));
			$com_admin_menuname = (string)$xml->administration->menu;
			if (isset($xml->administration->submenu)) {
				$com_admin_menu_id	= $this->createParentMenu($com_admin_menuname,$com_name);
				if ($com_admin_menu_id === false) { return false; }
				$com_admin_submenus = $xml->administration->submenu->children();
				$submenuordering = 0;
				if ($com_admin_submenus) {
					foreach ($com_admin_submenus as $admin_submenu) {
						$com = new mosComponent($database);
						$com->name = (string)$admin_submenu;
						$com->link = '';
						$com->menuid = 0;
						$com->parent = $com_admin_menu_id;
						$com->iscore = 0;

						$com->admin_menu_link = 'option='.$com_name;
						$attrs =  $admin_submenu->attributes();
						if ($attrs) {
							if (isset($attrs['act'])) {
								$com->admin_menu_link = 'option='.$com_name.'&act='.$attrs['act'];
							} else if (isset($attrs['task'])) {
								$com->admin_menu_link = 'option='.$com_name.'&task='.$attrs['task'];
							} else if (isset($attrs['link'])) {
								$com->admin_menu_link = str_replace('&amp;', '&', $attrs['link']);
							}
						}

						$com->admin_menu_alt = (string)$admin_submenu;
						$com->option = $com_name;
						$com->ordering = $submenuordering++;
						$com->admin_menu_img = 'js/ThemeOffice/component.png';

						if (!$com->store()) {
							$this->setError(1, $database->stderr(true));
							return false;
						}
					}
				}
			} else {
				$this->createParentMenu($com_admin_menuname,$com_name);
			}
		}

		$desc = '';
		if (isset($xml->description)) {
			$desc = $this->elementName().'<p>'.$xml->description.'</p>';
		}

		$this->setError(0, $desc);

		if ($this->hasInstallfile()) {
			if (is_file($this->componentAdminDir().'/'.$this->installFile())) {
				require_once($this->componentAdminDir().'/'.$this->installFile());
				$ret = com_install();
				if ($ret != '') {
					$this->setError(0, $desc.$ret);
				}
			}
		}
		return $this->copySetupFile();
	}


	function createParentMenu($_menuname,$_comname, $_image = "js/ThemeOffice/component.png") {
		global $database;

		$parcom = new mosComponent($database);
		$parcom->name = $_menuname;
		$parcom->link = 'option='.$_comname;
		$parcom->menuid	= 0;
		$parcom->parent	= 0;
		$parcom->iscore	= 0;
		$parcom->admin_menu_link = 'option='.$_comname;
		$parcom->admin_menu_alt = $_menuname;
		$parcom->option = $_comname;
		$parcom->ordering = 0;
		$parcom->admin_menu_img = $_image;
		$parcom->params = NULL;

		if (!$parcom->store()) {
			$this->setError( 1, $database->stderr( true ) );
			return false;
		}

		//$menuid = $database->insertid(); //does nt work on postgreSQL!
		//$menuid = $database->insertid('#__components', 'id'); //works!
		$menuid = $parcom->id; //works!

		return $menuid;
	}


	/***************************/
	/* CUSTOM UNINSTALL METHOD */
	/***************************/
	public function uninstall($cid, $option, $client=0) {
		global $database, $mainframe, $fmanager;

		$uninstallret = "";
		$database->setQuery("SELECT * FROM #__components WHERE id='".$cid."'");

		$row = null;
		if (!$database->loadObject( $row )) {
			HTML_installer::showInstallMessage($database->stderr(true),$adminLanguage->A_CMP_INST_UNERR,
				$this->returnTo( $option, 'component', $client ) );
			exit();
		}

		if ($row->iscore) {
			HTML_installer::showInstallMessage($adminLanguage->A_CMP_INST_THCOM .  $row->name . ' ' . $adminLanguage->A_CMP_INST_ISCOR, $adminLanguage->A_CMP_INST_UNERR,
				$this->returnTo( $option, 'component', $client ) );
			exit();
		}

		//Delete entries in the DB
		$database->setQuery("DELETE FROM #__components WHERE parent='".$row->id."'");
		if (!$database->query()) {
			HTML_installer::showInstallMessage($database->stderr(true),$adminLanguage->A_CMP_INST_UNERR,
				$this->returnTo( $option, 'component', $client ) );
			exit();
		}

		$database->setQuery("DELETE FROM #__components WHERE id='".$row->id."'");
		if (!$database->query()) {
			HTML_installer::showInstallMessage($database->stderr(true),$adminLanguage->A_CMP_INST_UNERR,
				$this->returnTo( $option, 'component', $client ) );
			exit();
		}

		// Try to find the uninstall file
		$filesindir = $fmanager->listFiles($mainframe->getCfg('absolute_path').'/administrator/components/'.$row->option, 'uninstall' );
		if (count( $filesindir ) > 0) {
			$uninstall_file = $filesindir[0];
			if(file_exists($mainframe->getCfg('absolute_path').'/administrator/components/'.$row->option .'/'.$uninstall_file)) {
				require_once($mainframe->getCfg('absolute_path').'/administrator/components/'.$row->option .'/'.$uninstall_file );
				$uninstallret = com_uninstall();
			}
		}

		// Try to find the XML file
		$filesindir = $fmanager->listFiles($fmanager->PathName($mainframe->getCfg('absolute_path').'/administrator/components/'.$row->option ), '.xml$');
		if (count($filesindir) > 0) {
			$ismosinstall = false;
			if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
			foreach ($filesindir as $file) {
				$xmlDoc = simplexml_load_file($mainframe->getCfg('absolute_path').'/administrator/components/'.$row->option.'/'.$file, 'SimpleXMLElement');
				if (!$xmlDoc) {
					$notices = array();
					if (version_compare(PHP_VERSION, '5.1.0') >= 0) {
						foreach(libxml_get_errors() as $error) { $notices[] = $error->message; }
					}
					HTML_installer::showInstallMessage($adminLanguage->A_CMP_INST_XMLINV,
					$adminLanguage->A_CMP_INST_UNERR, $this->returnTo($option, 'component', $client), $notices);
					exit();
				}
				if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
					if ($xmlDoc->getName() != 'mosinstall') {
						HTML_installer::showInstallMessage($adminLanguage->A_CMP_INST_XMLINV,$adminLanguage->A_CMP_INST_UNERR, $this->returnTo( $option, 'component', $client ));
						exit();
					}
				}

				if (isset($xmlDoc->uninstall)) {
					if ($xmlDoc->uninstall->children()) {
						foreach ($xmlDoc->uninstall->children() as $childname => $uchild) {
							if ($childname == 'queries') {
								if ($uchild->children()) {
									foreach ($uchild->children() as $query) {
										$database->setQuery($query);
										if (!$database->query()) {
											HTML_installer::showInstallMessage($database->stderr(true),$adminLanguage->A_CMP_INST_UNERR,
											$this->returnTo($option, 'component', $client));
											exit();
										}
									}
								}
							}
						}
					}
				}
			}
		} else {
		    /*
			HTML_installer::showInstallMessage( 'Could not find XML Setup file in '.$mainframe->getCfg('absolute_path').'/administrator/components/'.$row->option,
				'Uninstall -  error', $option, 'component' );
			exit();
			*/
		}

		//Delete directories
		if (trim( $row->option )) {
		    $result = 0;
		    $path = $fmanager->PathName($mainframe->getCfg('absolute_path').SEP.'administrator'.SEP.'components'.SEP. $row->option );
		    if (is_dir( $path )) {
		        $result |= $fmanager->deleteFolder( $path );
			}
		    $path = $fmanager->PathName($mainframe->getCfg('absolute_path').SEP.'components'.SEP.$row->option );
		    if (is_dir( $path )) {
		        $result |= $fmanager->deleteFolder( $path );
			}
			return $result;
		} else {
			HTML_installer::showInstallMessage( $adminLanguage->A_CMP_INST_OFEMP, $adminLanguage->A_CMP_INST_UNERR, $option,'component');
			exit();
		}

		return $uninstallret;
	}
}
?>