<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Poll
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class mosPoll extends mosDBTable {

	public $id=null;
	public $title=null;
	public $checked_out=null;
	public $checked_out_time=null;
	public $published=1;
	public $access=29;
	public $lag=null;
	public $language=null;
	public $locked = 0;
	public $seotitle = null;

	/**
	* @param database A database connector object
	*/
	function mosPoll( &$db ) {
		$this->mosDBTable( '#__polls', 'id', $db );
	}

	// overloaded check function
	function check() {
		global $adminLanguage;

        // check for valid title
		if (trim( $this->title ) == '') {
			$this->_error = $adminLanguage->A_CMP_POL_MHTIT;
			return false;
		}
        // check for empty seotitle (has already passed seo validator)
		if (trim( $this->seotitle ) == '') {
			$this->_error = $adminLanguage->A_SEOTEMPTY;
			return false;
		}
		// check for valid lag
		$this->lag = intval( $this->lag );
		if ($this->lag == 0) {
			$this->_error = $adminLanguage->A_CMP_POL_NZERO;
			return false;
		}
		// check for existing title
		$this->_db->setQuery( "SELECT id FROM #__polls WHERE title='$this->title'");

		$xid = intval( $this->_db->loadResult());
		if ($xid && $xid != intval( $this->id )) {
			$this->_error = $adminLanguage->A_CMP_POL_TRAGN;
			return false;
		}

		// sanitise some data
		if (!get_magic_quotes_gpc()) {
			$row->title = addslashes( $row->title );
		}

		return true;
	}

	// overloaded delete function
	function delete( $oid=null ) {
		$k = $this->_tbl_key;
		if ($oid) {
			$this->$k = intval( $oid );
		}

		if (mosDBTable::delete( $oid )) {
			$this->_db->setQuery( "DELETE FROM #__poll_data WHERE pollid='".$this->$k."'" );
			if (!$this->_db->query()) {
				$this->_error .= $this->_db->getErrorMsg()."\n";
			}

			$this->_db->setQuery( "DELETE FROM #__poll_date WHERE pollid='".$this->$k."'" );
			if (!$this->_db->query()) {
				$this->_error .= $this->_db->getErrorMsg()."\n";
			}

			$this->_db->setQuery( "DELETE FROM #__poll_menu WHERE pollid='".$this->$k."'" );
			if (!$this->_db->query()) {
				$this->_error .= $this->_db->getErrorMsg()."\n";
			}
			return true;
		} else {
			return false;
		}
	}
}
?>