<?php 
/** 
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component eBlog
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


/* DB ABSTRACTION CLASSES */

class eBlogSettings extends mosDBTable {

	public $blogid = null; //blog id
	public $title = ''; //blog title
	public $seotitle = ''; //blog seo title
	public $slogan = ''; //blog slogan
	public $ownerid = '0'; //blog owner id (user id)
	public $showtags = '1'; //show tags or not?
	public $cssfile = 'eblog.css'; //css file to use
	public $rtlcssfile = 'eblog-rtl.css'; //RTL version of the css file
	public $allowcomments = '0'; //0: comments are not allowed, 1: allowed to registered, 2: allowed to all
	public $canconfig = '0'; //0:owner can not change eBlog settings, 1: can change eBlog settings
	public $canupload = '0'; //0 or 1 if user can upload images
	public $numposts = '10'; //number of latest posts to display in first page
	public $mediasize = '2000'; //KB
	public $footerarchive = 1;
	public $showownertop = 1;
	public $published = 1;
	public $share = 1;
	public $params = null;


	public function __construct(&$_db) {
		$this->mosDBTable( '#__eblog_settings', 'blogid', $_db );
	}

}


class eBlogdb extends mosDBTable {

	public $id = null; //article id
	public $title = null; //article title
	public $seotitle = null; //article seo title
	public $blogid = null; //blog where the article belongs to
	public $blogtext = null; //article content
	public $dateadded = '1979-12-19 00:00:00'; //date article was written
	public $language = null;
	public $hits = null; //hits number
	public $tags = null; //tags (comma seperated list)
	public $published = '0';


	public function __construct( &$_db ) {
		global $mainframe;

		$this->mosDBTable('#__eblog', 'id', $_db);
		if (!$this->id) {
			$at = time() + ($mainframe->getCfg('offset') * 3600);
			$this->dateadded = date('Y-m-d H:i:s', $at);
		}
	}


	public function check() {
		if (trim($this->title) == '') {
			$this->_error = (defined(_ELXIS_ADMIN)) ? 'You should write a title!' : _E_WARNTITLE;
			return false;
		} else if (trim($this->seotitle) == '') {
			$this->_error = 'You should write a SEO title!';
			return false;
		} else if (intval($this->blogid) == 0) {
			$this->_error = 'Invalid blog!';
			return false;
		} else {
			return true;
		}
	}

}

?>