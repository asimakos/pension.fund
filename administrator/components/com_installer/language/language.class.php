<?php 
/**
* @version: $Id: language.class.php 2607 2010-03-28 10:54:06Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Languages Installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


class mosInstallerLanguage extends mosInstaller {

	/********************/
	/* INSTALL LANGUAGE */
	/********************/
	public function install( $p_fromdir = null ) {
		global $mainframe, $database, $fmanager;

		if (!$this->preInstallCheck( $p_fromdir, 'language' )) { return false; }

		$xml = $this->xmlDoc();
		$attrs =  $xml->attributes();
		$client = '';
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
			$this->elementDir($fmanager->PathName($mainframe->getCfg('absolute_path').SEP.'administrator'.SEP.'language'.SEP.strtolower(str_replace(" ","_",$this->elementName()))));
		} else {
			$this->elementDir($fmanager->PathName($mainframe->getCfg('absolute_path').SEP.'language'.SEP.strtolower(str_replace(" ","_",$this->elementName()))));
		}

		if (!file_exists($this->elementDir()) && !$fmanager->createFolder($this->elementDir())) {
			$this->setError(1, $adminLanguage->A_CMP_INST_ERIFN.' "'.$this->elementDir().'"');
			return false;
		}

		//Find files to copy
		if ($this->parseFiles('files', 'language') === false) {
			return false;
		}

		if (isset($xml->description)) {
			$this->setError(0, $this->elementName().'<p>'.$xml->description.'</p>');
		}

		return $this->copySetupFile('front');
	}


	/**********************/
	/* UNINSTALL LANGUAGE */
	/**********************/
	public function uninstall($id, $option, $client=0) {
		global $mainframe, $adminLanguage, $fmanager;

		$id = str_replace( array( '\\', '/' ), '', $id );

		if ($client == 'admin') {
			$path = $mainframe->getCfg('absolute_path').SEP.'administrator'.SEP.'language'.SEP.$id;
		} else {
			$path = $mainframe->getCfg('absolute_path').SEP.'language'.SEP.$id;
		}

		$id = str_replace('..', '', $id);
		if (trim($id)) {
			if (is_dir($path)) {
                return $fmanager->deleteFolder( $fmanager->PathName( $path ) );
			} else {
				HTML_installer::showInstallMessage( $adminLanguage->A_CMP_INST_DDEX, $adminLanguage->A_CMP_INST_UNERR,
					$this->returnTo( $option, 'language', $client ) );
			}
		} else {
			HTML_installer::showInstallMessage( $adminLanguage->A_CMP_INST_LIDE, $adminLanguage->A_CMP_INST_UNERR,
				$this->returnTo( $option, 'language', $client ) );
			exit();
		}
		return true;
	}


    public function returnTo( $option, $element, $client='' ) {
        if ($client == 'admin') {
            return "index2.php?option=com_languages&task=viewalangs";
        } else {
            return "index2.php?option=com_languages";       
       }
    }

}

?>