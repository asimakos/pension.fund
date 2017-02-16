<?php 
/**
* @version: $Id: bridge.class.php 2608 2010-03-28 11:02:05Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @description: Bridges Installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class mosInstallerBridge extends mosInstaller {


	/******************/
	/* INSTALL BRIDGE */
	/******************/
	public function install( $p_fromdir = null ) {
		global $mainframe, $database, $adminLanguage, $fmanager;

		if (!$this->preInstallCheck( $p_fromdir, 'bridge' )) {
			return false;
		}

		$xml = $this->xmlDoc();
		$this->elementName($xml->name);

		$this->elementDir( $fmanager->PathName( $mainframe->getCfg('absolute_path').'/bridges/'
        . eUTF::utf8_strtolower(eUTF::utf8_str_replace(" ","_",$this->elementName())))
		);

		if (!file_exists( $this->elementDir() ) && !$fmanager->createFolder( $this->elementDir() )) {
			$this->setError(1, $adminLanguage->A_CMP_INST_ERIFN .' "' . $this->elementDir() . '"' );
			return false;
		}

		if ($this->parseFiles( 'files' ) === false) {
			return false;
		}
		if ($this->parseFiles( 'images' ) === false) {
			return false;
		}
		if ($this->parseFiles( 'css' ) === false) {
			return false;
		}

		if (isset($xml->description)) {
			$this->setError(0, $this->elementName().'<p>'.$xml->description.'</p>');
		}

		return $this->copySetupFile('front');
	}


	/********************/
	/* UNINSTALL BRIDGE */
	/********************/
	function uninstall( $id, $option, $client=0 ) {
		global $mainframe, $adminLanguage, $fmanager;

		$id = str_replace( array( '\\', '/' ), '', $id );
        
        $path = $mainframe->getCfg('absolute_path').SEP.'bridges'.SEP.$id;
        
		$id = str_replace( '..', '', $id );
		if (trim( $id )) {
			if (is_dir( $path )) {
                return $fmanager->deleteFolder( $fmanager->PathName( $path ) );
			} else {
				HTML_installer::showInstallMessage( $adminLanguage->A_CMP_INST_DDEX, $adminLanguage->A_CMP_INST_UNERR,
					$this->returnTo( $option, 'bridge', $client ) );
			}
		} else {
			HTML_installer::showInstallMessage( $adminLanguage->A_CMP_INST_ÂIDE, $adminLanguage->A_CMP_INST_UNERR,
				$this->returnTo( $option, 'bridge', $client ) );
			exit();
		}
		return true;
	}


    public function returnTo( $option, $element, $client='' ) {
        return "index2.php?option=com_bridge&task=view";
    }

}

?>