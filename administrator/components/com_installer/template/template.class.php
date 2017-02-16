<?php 
/**
* @version: $Id: template.class.php 2607 2010-03-28 10:54:06Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Templates Installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//ensure user has access to this function
if (!$acl->acl_check( 'administration', 'manage', 'users', $GLOBALS['my']->usertype, 'components', 'com_templates' )) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}


class mosInstallerTemplate extends mosInstaller {


	/********************/
	/* INSTALL TEMPLATE */
	/********************/
	public function install( $p_fromdir = null ) {
		global $mainframe, $database, $adminLanguage, $fmanager;

		if (!$this->preInstallCheck( $p_fromdir, 'template' )) {
			return false;
		}

		$xml = $this->xmlDoc();
		$attrs =  $xml->attributes();
		$client = '';
		if ($attrs && isset($attrs['client'])) {
			$validClients = array( 'administrator', 'login');
			if (!in_array($attrs['client'], $validClients)) {
				$this->setError(1, $adminLanguage->A_CMP_INST_UCTP .' ['.$attrs['client'].']');
				return false;
			}
			switch ($attrs['client']) {
                case 'login': $client= 'login'; break;
                default: $client = 'admin'; break;
			}
		}

		//Set some vars
		$this->elementName($xml->name);
		if ($client == 'admin') {
			$ipath = $mainframe->getCfg('absolute_path').SEP.'administrator'.SEP.'templates'.SEP.'admin'.SEP;
		} else if ($client == 'login') {
			$ipath = $mainframe->getCfg('absolute_path').SEP.'administrator'.SEP.'templates'.SEP.'login'.SEP;
		} else {
			$ipath = $mainframe->getCfg('absolute_path').SEP.'templates'.SEP;
		}

		$this->elementDir($fmanager->PathName($ipath.strtolower(str_replace(" ","_",$this->elementName()))));

		if (!file_exists( $this->elementDir() ) && !$fmanager->createFolder( $this->elementDir() )) {
			$this->setError(1, $adminLanguage->A_CMP_INST_ERIFN .' "'.$this->elementDir().'"' );
			return false;
		}

		if ($this->parseFiles('files') === false) {
			return false;
		}
		if ($this->parseFiles('images') === false) {
			return false;
		}
		if ($this->parseFiles('css') === false) {
			return false;
		}
		if ($this->parseFiles('media') === false) {
			return false;
		}

		if (isset($xml->description)) {
			$this->setError(0, $this->elementName().'<p>'.$xml->description.'</p>');
		}

		return $this->copySetupFile('front');
	}


	/**********************/
	/* UNINSTALL TEMPLATE */
	/**********************/
	public function uninstall( $id, $option, $client=0 ) {
		global $database, $mainframe, $adminLanguage, $fmanager;

		//Delete directories
		switch ($client) {
            case 'admin':
            $path = $mainframe->getCfg('absolute_path'). SEP .'administrator'. SEP .'templates'. SEP .'admin'. SEP .$id;
            break;
            case 'login':
            $path = $mainframe->getCfg('absolute_path'). SEP .'administrator'. SEP .'templates'. SEP .'login'. SEP .$id;
            break;
            default:
            $path = $mainframe->getCfg('absolute_path'). SEP .'templates'. SEP .$id;
            break;
		}

		$id = str_replace( '..', '', $id );
		if (trim( $id )) {
			if (is_dir( $path )) {
				return $fmanager->deleteFolder( $fmanager->PathName( $path ) );
			} else {
				HTML_installer::showInstallMessage( $adminLanguage->A_CMP_INST_DDEX, $adminLanguage->A_CMP_INST_UNERR,
					$this->returnTo( $option, 'template', $client ) );
			}
		} else {
			HTML_installer::showInstallMessage( $adminLanguage->A_CMP_INST_TIDE, $adminLanguage->A_CMP_INST_UNERR,
				$this->returnTo( $option, 'template', $client ) );
			exit();
		}
	}

    //return to method
	public function returnTo( $option, $element, $client ) {
		return "index2.php?option=com_templates&client=$client";
	}

}

?>