<?php 
/**
* @version: $Id: banners.class.php 55 2010-06-13 08:57:20Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Banners
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


class mosBannerClient extends mosDBTable {

	public $cid = null;
	public $name = '';
	public $contact = '';
	public $email = '';
	public $extrainfo = null;
	public $checked_out = '0';
	public $checked_out_time = '0';
	public $editor	= null;


	public function __construct( &$_db ) {
		$this->mosDBTable( '#__bannerclient', 'cid', $_db );
	}


	public function check() {
		global $adminLanguage, $mainframe;

		$this->name = $mainframe->makesafe($this->name);
		// check for valid client name
		if (trim($this->name == '')) {
			$this->_error = $adminLanguage->A_CMP_BANN_FCLNA;
			return false;
		}
		// check for valid client contact
		if (trim($this->contact == '')) {
			$this->_error = $adminLanguage->A_CMP_BANN_FCONA;
			return false;
		}
		// check for valid client email
		if ((trim($this->email == '')) || (preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $this->email )==false)) {
			$this->_error = $adminLanguage->A_CMP_BANN_FCOEM;
			return false;
		}

        if (($this->checked_out_time == '0') || ($this->checked_out_time == '1979-12-19 00:00:00')) {
            $this->checked_out_time = date('Y-m-d H:i:s');
        }
		return true;
	}
}

class mosBanner extends mosDBTable {

	public $bid	= null;
	public $cid = null;
	public $type = null;
	public $name = null;
	public $imptotal = '0';
	public $impmade = '0';
	public $clicks = '0';
	public $imageurl = null;
	public $clickurl = null;
	public $dateadded = null;
	public $showbanner = '0';
	public $checked_out = '0';
	public $checked_out_time = '0';
	public $editor = null;
	public $custombannercode = null;
	public $targetbanner = 1;


	public function __construct( &$_db ) {
		$this->mosDBTable( '#__banner', 'bid', $_db );
		$this->set("dateadded",date("Y-m-d G:i:s"));
		$this->set("checked_out_time",date("Y-m-d H:i:s"));
	}


	public function clicks() {
		$this->_db->setQuery("UPDATE #__banner SET clicks=(clicks+1) WHERE bid='".$this->bid."'" );
		$this->_db->query();
	}


	public function check() {
		global $adminLanguage, $mainframe;

		$this->name = $mainframe->makesafe($this->name);
		// check for valid client id
		if (is_null($this->cid) || $this->cid == 0) {
			$this->_error = $adminLanguage->A_CMP_BANN_SELCL;
			return false;
		}
		if (trim($this->name) == '') {
			$this->_error = $adminLanguage->A_CMP_BANN_PROVIDE;
			return false;
		}
		if (trim($this->imageurl) == '') {
			$this->_error = $adminLanguage->A_CMP_BANN_SELECTIMAGE;
			return false;
		}
		if ((trim($this->clickurl) == '') && (trim($this->custombannercode) == '')) {
			$this->_error = $adminLanguage->A_CMP_BANN_FILLURL;
			return false;
		}
		return true;
	}
}

?>