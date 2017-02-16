<?php 
/**
* @version: $Id: version.php 66 2010-06-15 19:46:11Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Version
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

class version {

	public $PRODUCT = 'Elxis';
	public $RELEASE = '2009';
	public $DEV_STATUS = 'Stable';
	public $DEV_LEVEL = '2';
	public $DEV_REVISION = '2631';
	public $CODENAME = 'Electra';
	public $RELDATE = '15-June-2010';
	public $RELTIME = '22:45';
	public $RELTZ = 'GMT+2';
	public $COPYRIGHT = 'Copyright (C) 2006-2010 Elxis.org. All rights reserved.';
	public $URL = 'Powered by <a href="http://www.elxis.org" title="Elxis CMS">Elxis</a> - Open Source CMS.';
	public $COPYURL = 'Copyright (C) 2006-2010 <a href="http://www.elxis.org" title="Elxis Team">Elxis.org</a>. All rights reserved.';


	/***************/
	/* CONSTRUCTOR */
	/***************/
	public function __construct() {
		$this->COPYRIGHT = 'Copyright (C) 2006-'.date('Y').' Elxis.org. All rights reserved.';
		$this->COPYURL = 'Copyright (C) 2006-'.date('Y').' <a href="http://www.elxis.org" title="Elxis CMS">Elxis.org</a>. All rights reserved.';
	}

}

$_VERSION = new version();

$version = $_VERSION->PRODUCT .' '. $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL .' '
. $_VERSION->DEV_STATUS.' rev'. $_VERSION->DEV_REVISION
.' [ '.$_VERSION->CODENAME .' ] '. $_VERSION->RELDATE .' '
. $_VERSION->RELTIME .' '. $_VERSION->RELTZ;

$version_short = $_VERSION->PRODUCT .' '. $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL .' [ '.$_VERSION->CODENAME .' ]';

?>