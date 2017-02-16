<?php 
/**
* @version: $Id: mambot.class.php 2607 2010-03-28 10:54:06Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Bots Installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class mosInstallerMambot extends mosInstaller {

	/*************************/
	/* CUSTOM INSTALL METHOD */
	/*************************/
	public function install($p_fromdir = null) {
		global $mainframe, $database, $adminLanguage, $fmanager;

		if (!$this->preInstallCheck( $p_fromdir, 'mambot' )) {
			return false;
		}

		$xml = $this->xmlDoc();
		$this->elementName($xml->name);
		$attrs = $xml->attributes();
		$folder = $attrs['group'];
		$this->elementDir($fmanager->PathName($mainframe->getCfg('absolute_path').SEP.'mambots'.SEP.$folder));
		if(!file_exists($this->elementDir()) && !$fmanager->createFolder($this->elementDir())) {
			$this->setError(1, $adminLanguage->A_CMP_INST_ERCDR.' "'.$this->elementDir().'"');
			return false;
		}		

		if ($this->parseFiles('files', 'mambot', $adminLanguage->A_CMP_INST_NFMM) === false) {
			return false;
		}

		$database->setQuery("SELECT id FROM #__mambots WHERE element = '".$this->elementName()."'");
		if (!$database->query()) {
			$this->setError(1, $adminLanguage->A_CMP_INST_SQLER.': '.$database->stderr( true ));
			return false;
		}

		$id = $database->loadResult();

		if (!$id) {
			$row = new mosMambot($database);
			$row->name = $this->elementName();
			$row->ordering = '0';
			$row->folder = (string)$folder;
			$row->iscore = '0';
			$row->access = '29';
			$row->client_id = '0';
			$row->element = $this->elementSpecial();

			if (!$row->store()) {
				$this->setError(1, $adminLanguage->A_CMP_INST_SQLER . ': ' . $row->getError());
				return false;
			}
		} else {
			$this->setError( 1, $adminLanguage->A_CMP_INST_MAMB . ' "' . $this->elementName() . '" ' . $adminLanguage->A_CMP_INST_AXST );
			return false;
		}
		
		if (isset($xml->description)) {
			$this->setError(0, $this->elementName().'<p>'.$xml->description.'</p>');
		}
		return $this->copySetupFile('front');
	}


	/***************************/
	/* CUSTOM UNINSTALL METHOD */
	/***************************/
	public function uninstall( $id, $option, $client=0 ) {
		global $database, $mainframe, $adminLanguage, $fmanager;

		$id = intval($id);
		$database->setQuery("SELECT name, folder, element, iscore FROM #__mambots WHERE id = '$id'");

		$row = null;
		$database->loadObject($row);
		if ($database->getErrorNum()) {
			HTML_installer::showInstallMessage( $database->stderr(), $adminLanguage->A_CMP_INST_UNERR,
			$this->returnTo( $option, 'mambot', $client ) );
			exit();
		}
		if ($row == null) {
			HTML_installer::showInstallMessage( $adminLanguage->A_CMP_INST_IOID, $adminLanguage->A_CMP_INST_UNERR,
			$this->returnTo( $option, 'mambot', $client ) );
			exit();
		}

		if (trim($row->folder) == '') {
			HTML_installer::showInstallMessage( $adminLanguage->A_CMP_INST_FFEM, $adminLanguage->A_CMP_INST_UNERR,
			$this->returnTo( $option, 'mambot', $client ) );
			exit();
		}

		$basepath = $fmanager->PathName($mainframe->getCfg('absolute_path') . SEP .'mambots' . SEP. $row->folder );
		$xmlfile = $basepath . $row->element . '.xml';

		//see if there is an xml install file, must be same name as element
		if (file_exists($xmlfile)) {
			if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
			$this->i_xmldoc = simplexml_load_file($xmlfile, 'SimpleXMLElement');
			if ($this->i_xmldoc) {
				$ok = true;
				if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
					if ($this->i_xmldoc->getName() != 'mosinstall') { $ok = false; }
				}
				if ($ok) {
					if (isset($this->i_xmldoc->files)) {
						if ($this->i_xmldoc->files->children()) {
							foreach ($this->i_xmldoc->files->children() as $filename) {
								if (file_exists($basepath.$filename)) {
									$parts = pathinfo($filename);
									$subpath = $parts['dirname'];
									if (($subpath != '') && ($subpath != '.') && ($subpath != '..')) {
										$fmanager->deleteFolder($fmanager->PathName($basepath.$subpath));
									} else {
										$fmanager->deleteFile($fmanager->PathName($basepath.$filename, false));
									}
								}
							}
							//remove XML file
							$fmanager->deleteFile($fmanager->PathName($xmlfile, false));

							//define folders that should not be removed
							$sysFolders = array('content', 'search');
							if (!in_array($row->folder, $sysFolders)) {
								//delete the non-system folders if empty
								if (count($fmanager->listFiles($basepath)) < 1) {
									$fmanager->deleteFolder( $basepath );
								}
							}

						}
					}
				}
			}
		}

		if ($row->iscore) {
			HTML_installer::showInstallMessage($row->name.' '.$adminLanguage->A_CMP_INST_ICMO,
			$adminLanguage->A_CMP_INST_UNERR, $this->returnTo( $option, 'mambot', $client));
			exit();
		}

		$database->setQuery("DELETE FROM #__mambots WHERE id = '$id'");
		if (!$database->query()) {
			$msg = $database->stderr;
			die( $msg );
		}
		return true;
	}
}

?>