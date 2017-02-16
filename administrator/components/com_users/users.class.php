<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Users
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class mosUsersExtra extends mosDBTable {

	public $extraid=null;
	public $name=null;
	public $etype=null;
	public $maxlength=null;
	public $required=null;
	public $ordering=null;
	public $eoptions=null;
	public $defvalue=null;
	public $published=null;
	public $registration=null;
	public $profile=null;
	public $readonly=null;
	public $halign=null;
	

	/***************/
	/* CONSTRUCTOR */
	/***************/
	public function __construct( &$db ) {
		$this->mosDBTable( '#__users_extra', 'extraid', $db );
	}

}

?>