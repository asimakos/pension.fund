<?php 
/**
* @version: $Id: module.class.php 2607 2010-03-28 10:54:06Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Modules Installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class mosInstallerModule extends mosInstaller {

	/*************************/
	/* CUSTOM INSTALL METHOD */
	/*************************/
	public function install($p_fromdir = null) {
		global $mainframe, $database, $adminLanguage, $fmanager;

		if (!$this->preInstallCheck($p_fromdir, 'module')) {
			return false;
		}

		$xml = $this->xmlDoc();
		$attrs =  $xml->attributes();
		if ($attrs && isset($attrs['client'])) {
		    $validClients = array('administrator');
			if (!in_array($attrs['client'], $validClients)) {
				$this->setError(1, $adminLanguage->A_CMP_INST_UCTP.' ['.$attrs['client'].']');
				return false;
			}
			$client = 'admin';
		}

		//Set some vars
		$this->elementName($xml->name);
		if ($client == 'admin') {
			$this->elementDir($fmanager->PathName($mainframe->getCfg('absolute_path').SEP.'administrator'.SEP.'modules'.SEP));
		} else {
			$this->elementDir($fmanager->PathName($mainframe->getCfg('absolute_path').SEP.'modules'.SEP));
		}

		if ($this->parseFiles('files', 'module', $adminLanguage->A_CMP_INST_NFMD) === false) {
		    return false;
		}

		$this->parseFiles('images');

		$client_id = intval($client == 'admin');
		$database->setQuery("SELECT id FROM #__modules WHERE module = '".$this->elementSpecial()."' AND client_id=".$client_id."");
		if (!$database->query()) {
			$this->setError(1, $adminLanguage->A_CMP_INST_SQLER.': '.$database->stderr(true));
			return false;
		}
		$id = $database->loadResult();

		if (!$id) {
			$row = new mosModule($database);
			$row->title = $this->elementName();
			$row->ordering = '99';
			$row->position = 'left';
			$row->showtitle = '1';
			$row->iscore = '0';
			$row->access = ($client == 'admin') ? '99' : '29';
			$row->client_id = $client_id;
			$row->module = $this->elementSpecial();
			$row->store();

			$database->setQuery("INSERT INTO #__modules_menu VALUES ('$row->id', '0')");
			if (!$database->query()) {
				$this->setError(1, $adminLanguage->A_CMP_INST_SQLER.': '.$database->stderr( true ));
				return false;
	        }
		} else {
			$this->setError(1, $adminLanguage->A_CMP_INST_MODULE.' "'.$this->elementName().'" '.$adminLanguage->A_CMP_INST_AXST);
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
	public function uninstall($id, $option, $client=0) {
		global $database, $mainframe, $adminLanguage, $fmanager;

		$id = (int)$id;
		$database->setQuery("SELECT module, iscore, client_id FROM #__modules WHERE id = ".$id."");
		$row = null;
		$database->loadObject($row);

		if ($row->iscore) {
			HTML_installer::showInstallMessage( $row->title . $adminLanguage->A_CMP_INST_ICMDL, $adminLanguage->A_CMP_INST_UNERR, $this->returnTo( $option, 'module', $row->client_id ? '' : 'admin' ) );
			exit();
		}

		$database->setQuery("SELECT id FROM #__modules WHERE module = '".$row->module."'");
		$modules = $database->loadResultArray();

		if (count( $modules )) {
			$query = "DELETE FROM #__modules_menu WHERE moduleid IN ('".implode("','", $modules) ."')";
			$database->setQuery( $query );
			if (!$database->query()) {
			    $msg = $database->stderr;
			    die( $msg );
			}
		}

		$database->setQuery("DELETE FROM #__modules WHERE module = '".$row->module."'");
		if (!$database->query()) {
		    $msg = $database->stderr;
		    die( $msg );
		}

		if ($row->client_id) {
			$basepath = $mainframe->getCfg('absolute_path').SEP.'administrator'.SEP.'modules'.SEP;
		} else {
			$basepath = $mainframe->getCfg('absolute_path').SEP.'modules'.SEP;
		}

  		$xmlfile = $basepath.$row->module.'.xml';

		// see if there is an xml install file, must be same name as element
		if (file_exists($xmlfile)) {
			if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
			$xmlDoc = simplexml_load_file($xmlfile, 'SimpleXMLElement');
			if ($xmlDoc) {
				$ok = true;
				if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
					if ($xmlDoc->getName() != 'mosinstall') { $ok = false; }
				}
				if ($ok) {
					if (isset($xmlDoc->files)) {
						if ($xmlDoc->files->children()) {
							foreach ($xmlDoc->files->children() as $filename) {
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
							return true;
						}
					}
				}
			}
		}
	}

}

?>