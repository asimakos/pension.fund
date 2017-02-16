<?php 
/** 
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Weblinks
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


class mosWeblink extends mosDBTable {
	/** @var int Primary key */
	public $id=null;
	/** @var int */
	public $catid=null;
	/** @var int */
	public $sid=null;
	/** @var string */
	public $title=null;
	/** @var string */
	public $url=null;
	/** @var string */
	public $description=null;
	/** @var datetime */
	public $date=null;
	/** @var int */
	public $hits=null;
	/** @var int */
	public $published=null;
	/** @var boolean */
	public $checked_out=null;
	/** @var time */
	public $checked_out_time=null;
	/** @var int */
	public $ordering=null;
	/** @var int */
	public $archived=null;
	/** @var int */
	public $approved=null;
	/** @var string */
	public $params=null;
	/** @var string */
	public $screenshot=null;
	/** @var string */
	public $language=null;

	/**
	* @param database A database connector object
	*/
	function mosWeblink( &$db ) {
		$this->mosDBTable( '#__weblinks', 'id', $db );
	}

	/** overloaded check function */
	function check() {
		// filter malicious code
		$ignoreList = array( 'params' );
		$this->filter( $ignoreList );

		// specific filters		
		$iFilter = new InputFilter();
		
		if ($iFilter->badAttributeValue( array( 'href', $this->url ))) {
			$this->_error = 'Please provide a valid URL';
			return false;
		}
		/** check for valid name */
		if (trim( $this->title ) == '') {
			$this->_error = _GEM_WEBLINK_TITLE;
			return false;
		}

		if (!preg_match('/^http/i', $this->url)) { $this->url = 'http://'.$this->url; }

		/** check for existing name */
        $this->title = $this->_db->getEscaped($this->title); //patched 20.06.2006
        $this->catid = $this->_db->getEscaped($this->catid); //patched 20.06.2006
		$this->_db->setQuery( "SELECT id FROM #__weblinks WHERE title='$this->title' AND catid='$this->catid'");

		$xid = intval( $this->_db->loadResult() );
		if ($xid && $xid != intval( $this->id )) {
			$this->_error = _GEM_WEBLINK_EXIST;
			return false;
		}
		return true;
	}
}
?>