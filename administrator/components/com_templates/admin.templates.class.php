<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Templates
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class mosTemplatePosition extends mosDBTable {

	public $id=null;
	public $position=null;
	public $description=null;

	function mosTemplatePosition() {
	    global $database;

		$this->mosDBTable( '#__template_positions', 'id', $database );
	}
}
?>