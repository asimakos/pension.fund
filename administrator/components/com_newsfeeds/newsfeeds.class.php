<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Newsfeeds
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class mosNewsFeed extends mosDBTable {

	public $id=null;
	public $catid=null;
	public $name=null;
	public $link=null;
	public $filename=null;
	public $published=null;
	public $numarticles=null;
	public $cache_time=null;
	public $checked_out=null;
	public $checked_out_time=null;
	public $ordering=null;
	public $seotitle=null;
	

/**
* @param database A database connector object
*/
	function mosNewsFeed( &$db ) {
		$this->mosDBTable( '#__newsfeeds', 'id', $db );
	}

}

?>