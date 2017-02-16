<?php 
/** 
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component eBlog / SEO PRO
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @description: SEO Title suggestion and validation class
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class eblogseovs {

	private $type = 'post'; //blog or post
    private $title = '';
    private $seotitle = '';
    public $sugtitle = '';
    private $ascii = '';
    public $blogid = 0;
    public $id = 0;
    public $message = '';
    private $code = 0;


    /********************/
    /* INITIALIZE CLASS */
    /********************/
    public function __construct($type='post', $title='', $seotitle='') {
    	$this->type = $type;
		if ($title != '') {
            $title = eUTF::utf8_trim($title);
            $this->title = preg_replace("/[!@#$%^&*(){}\[\]]/", '', $title);
        }
        $this->seotitle = $seotitle;
    }


    /********************/
    /* GENERATE MESSAGE */
    /********************/
    private function writeMsg($code='0') {
    	if (defined('_ELXIS_ADMIN')) {
    		global $eblogb;
			$eblog = $eblogb;	
    	} else {
    		global $eblog;
    	}

        $this->code = intval($code);
        switch ($this->code) {
            case 1: $this->message = $eblog->lng->SEOTLARGER; break;
            case 2: $this->message = $eblog->lng->INVALID; break;
            case 3: $this->message = $eblog->lng->INVALID.', '.$eblog->lng->SEOTEXIST; break;
            case 4: $this->message = $eblog->lng->VALID; break;
            case 5: $this->message = $eblog->lng->INVALID.', '.$eblog->lng->SEOTITLEEMPTY; break;
            default:
                $this->message = _GEM_UNKN_ERR;
            break;
        }
    }


    /*********************/
    /* SUGGEST SEO TITLE */
    /*********************/
    public function suggest() {
        if ($this->title == '') {
            $this->writeMsg('1');
            return false;
        }
        $ascii = strtolower(eUTF::utf8_to_ascii($this->title, ''));
        $this->ascii = preg_replace("/[^a-zA-Z0-9-_\s]/", '', $ascii);
        if ($this->ascii == '') {
            $this->writeMsg('1');
            return false;
        }

        $parts = preg_split('/[\s]/', $this->ascii);
        $nparts = array();
        foreach ($parts as $part) {
            if (strlen($part) > 1) { array_push($nparts, $part); }
        }
        
        if (count($nparts) == 0) {
            $this->writeMsg('1');
            return false;
        }
        $newtitle = implode('-', $nparts);

        $out = '';
        switch ($this->type) {
            case 'post':
            	$invalidNames = array('cpanel', 'new', 'edit', 'config', 'tags');
            	if (in_array($newtitle, $invalidNames) || (is_numeric($newtitle))) {
            		$newtitle = 'elxis-'.$newtitle;
            	}
                $out = $this->suggest_post($newtitle);
            break;
            case 'blog':
            	$invalidNames = array('eblog', 'blog');
            	if (in_array($newtitle, $invalidNames)) { $newtitle = 'elxis-'.$newtitle; }
                $out = $this->suggest_blog($newtitle);
            break;
            default:
            break;
        }
        return $out;
    }


    /*******************************/
    /* SUGGEST SEO TITLE FOR POSTS */
    /*******************************/
    private function suggest_post($newtitle) {
        global $database;

		//Note: Better all posts have unique SEO titles even if they are in different blogs
        $extra = ($this->id) ? " AND id <> '".$this->id."'" : '';
        $database->setQuery("SELECT COUNT(*) FROM #__eblog WHERE seotitle='".$newtitle."'".$extra);
        $c = intval($database->loadResult());
        if ($c) {
            for ($i=2; $i<21; $i++) {
                $database->setQuery("SELECT COUNT(*) FROM #__eblog WHERE seotitle='".$newtitle."-".$i."'".$extra);
                $c2 = intval($database->loadResult());
                if (!$c2) {
                    $newtitle .= '-'.$i;
                    break;
                }
            }
            if ($c2) { $newtitle .= '-'.rand(1000,9999); }
        }

        $this->sugtitle = $newtitle;
        return $newtitle;
    }


    /*******************************/
    /* SUGGEST SEO TITLE FOR BLOGS */
    /*******************************/
    private function suggest_blog($newtitle) {
        global $database;

        $extra = ($this->blogid) ? " AND blogid <> '".$this->blogid."'" : '';
        $database->setQuery("SELECT COUNT(*) FROM #__eblog_settings WHERE seotitle='".$newtitle."'".$extra);
        $c = intval($database->loadResult());
        if ($c) {
            for ($i=2; $i<21; $i++) {
                $database->setQuery("SELECT COUNT(*) FROM #__eblog_settings WHERE seotitle='".$newtitle."-".$i."'".$extra);
                $c2 = intval($database->loadResult());
                if (!$c2) {
                    $newtitle .= '-'.$i;
                    break;
                }
            }
            if ($c2) { $newtitle .= '-'.rand(1000,9999); }
        }

        $this->sugtitle = $newtitle;
        return $newtitle;
    }


    /**********************/
    /* VALIDATE SEO TITLE */
    /**********************/
    public function validate() {
    	global $database;

        if ($this->seotitle == '') {
            $this->writeMsg('5');
            return false;
        }
        if (!eUTF::utf8_isASCII($this->seotitle)) {
            $this->writeMsg('2');
            return false;
        }
        $seotitle2 = preg_replace("/[^a-z0-9-_]/", '', $this->seotitle);
        if ($seotitle2 != $this->seotitle) { 
            $this->writeMsg('2');
            return false;
        }

        $out = false;
        switch ($this->type) {
            case 'post':
                $out = $this->validate_post();
            break;
            case 'blog':
                $out = $this->validate_blog();
            break;
        }
        return $out;
	}


    /*******************************/
    /* VALIDATE SEO TITLE FOR BLOG */
    /*******************************/
    private function validate_blog() {
        global $database;

        $invalidNames = array('eblog', 'blog');
        if (in_array($this->seotitle, $invalidNames)) {
		    $this->writeMsg('2');
            return false;
        }

        $extra = ($this->blogid) ? " AND blogid <> '".$this->blogid."'" : '';
        $database->setQuery("SELECT COUNT(*) FROM #__eblog_settings WHERE seotitle='".$this->seotitle."'".$extra);
        $c = intval($database->loadResult());
	    if ($c) {
		    $this->writeMsg('3');
            return false;
        }
        $this->writeMsg('4');
        return true;
    }


    /*******************************/
    /* VALIDATE SEO TITLE FOR POST */
    /*******************************/
    private function validate_post() {
        global $database;

        $invalidNames = array('cpanel', 'new', 'edit', 'config', 'tags');
        if (in_array($this->seotitle, $invalidNames) || (is_numeric($this->seotitle))) {
		    $this->writeMsg('2');
            return false;
        }

		//Note: Better all posts have unique SEO titles even if they are in different blogs
        $extra = ($this->id) ? " AND id <> '".$this->id."'" : '';
        $database->setQuery("SELECT COUNT(*) FROM #__eblog WHERE seotitle='".$this->seotitle."'".$extra);
        $c = intval($database->loadResult());
	    if ($c) {
		    $this->writeMsg('3');
            return false;
        }
        $this->writeMsg('4');
        return true;
    }

}

?>