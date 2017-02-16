<?php 
/**
* @version: $Id: seovs.class.php 2589 2010-02-27 07:51:02Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: SEO
* @author: Ioannis Sannos (datahell)
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
* Elxis CMS is a Free Software
* @description: Validates or suggests a SEO title
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class seovs {

    public $option = '';
    public $title = '';
    public $seotitle = '';
    public $ascii = '';
    public $id = 0;
    public $catid = 0;
    public $Itemid = 0;
    public $message = '';
    public $code = 0;
    public $section = '';


    /*********************/
    /* MAGIC CONSTRUCTOR */
    /*********************/
    public function __construct($option, $title='', $seotitle='') {
        global $_VERSION;
        if (($_VERSION->PRODUCT != 'E'.'l'.'x'.'i'.'s') || (!preg_match('/elXiS/i', $_VERSION->COPYRIGHT))) { die(); } 
        $this->option = $option;
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
        global $adminLanguage;

        $this->code = intval($code);
        switch ($this->code) {
            case 1: $this->message = $adminLanguage->A_SEOTLARGER; break;
            case 2: $this->message = $adminLanguage->A_INVALID; break;
            case 3: $this->message = $adminLanguage->A_INVALID.', '.$adminLanguage->A_SEOTEXIST; break;
            case 4: $this->message = $adminLanguage->A_VALID; break;
            case 5: $this->message = $adminLanguage->A_INVALID.', '.$adminLanguage->A_SEOTEMPTY; break;
            case 6: $this->message = $adminLanguage->A_INVALID.', '.$adminLanguage->A_PLSSELECTCAT; break;
            case 7: $this->message = $adminLanguage->A_INVALID.' '.$adminLanguage->A_SECTION; break;
            default:
                $this->message = _GEM_UNKN_ERR;
            break;
        }
    }


    /*********************/
    /* SUGGEST SEO TITLE */
    /*********************/
    public function suggest() {
    	global $mosConfig_absolute_path;

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
        switch ($this->option) {
            case 'com_content':
                $out = $this->suggest_content($newtitle);
            break;
            case 'com_sections':
                //exclude already registered names and real directories
                $invalidNames = array('members', 'links', 'contact', 'feeds', 'registration', 'rss', 'polls', 'banners', 
                'ext', 'blog', 'eblog', 'archive', 'submitted-content', 'search', 'login', 'logout', 'content', 'forum', 'component',
                'modules', 'mambots', 'components', 'cache', 'tmpr', 'images', 'administrator', 'includes', 'help', 'editor', 
                'language', 'media', 'bridges', 'installation', 'sitemap', 'directory', 'gallery', 'eshop', 'reservations', 'newsletter', 
				'downloads', 'events', 'arthrology', 'qpassport', 'eforum', 'webtv');

				$invalidNames2 = array('aa', 'ab', 'af', 'ar', 'sq', 'hy', 'az', 'eu', 'be', 'bn', 'bs', 'bg', 'ca', 'zh', 'ht', 'hr', 'cs',
		 		'da', 'dv', 'nl', 'en', 'en-US', 'et', 'fo', 'fi','fr', 'mk', 'gl', 'de', 'el', 'gu', 'he', 'hi', 'hu', 'is', 'id', 'it', 
				'ja','kn', 'kk', 'kok', 'ko', 'ky', 'lv', 'lt', 'ms', 'ml', 'mt', 'mi', 'mr', 'mn', 'nb', 'nn','pa', 'fa', 'pl', 'pt', 'pa', 
				'ro', 'ru', 'se', 'sr', 'rs', 'sk', 'sl', 'es', 'sw', 'sv', 'sv-FI', 'syr', 'ta', 'tt', 'te', 'tr', 'uk', 'ur', 'uz', 
				'vi', 'wa', 'cy', 'xh', 'zu');

				if (in_array($newtitle, $invalidNames) || preg_match('/^(com_)/', $newtitle)) {
                    $newtitle = 'elxis-'.$newtitle;
                } else if (in_array($newtitle, $invalidNames2)) {
                	$newtitle = 'elxis-'.$newtitle;
                } else if (file_exists($mosConfig_absolute_path.'/'.$newtitle.'/')) {
                	$newtitle = 'elxis-'.$newtitle;
                }
                $out = $this->suggest_section($newtitle);
            break;
            case 'com_categories':
                $out = $this->suggest_category($newtitle);
            break;
            case 'com_wrapper':
                $out = $this->suggest_wrapper($newtitle);
            break;
            case 'com_newsfeeds':
                $out = $this->suggest_newsfeed($newtitle);
            break;
            case 'com_contact':
                $out = $this->suggest_contact($newtitle);
            break;
            case 'com_poll':
            	if ($newtitle == 'vote') { $newtitle = 'elxis-vote'; }
                $out = $this->suggest_poll($newtitle);
            break;
            case 'com_typedcontent':
                //exclude already registered names and real files
                $invalidNames = array('search', 'login', 'logout', 'vote', 'index');
                if (in_array($newtitle, $invalidNames)) {
                    $newtitle = 'elxis-'.$newtitle;
                }
                $out = $this->suggest_typed($newtitle);
            break;
        }
        return $out;
    }


    /***********************************/
    /* SUGGEST SEO TITLE FOR NEWSFEEDS */
    /***********************************/
    private function suggest_newsfeed($ntitle) { //feed manually id and catid before suggest
        global $database;

        if (intval($this->catid) < 1) {
            $this->writeMsg('6');
            return false;
        }

        $extra = ($this->id) ? " AND id <> '".$this->id."'" : '';
        $database->setQuery("SELECT COUNT(*) FROM #__newsfeeds WHERE catid='$this->catid' AND seotitle='$ntitle'".$extra);
        $c = intval($database->loadResult());
        if ($c) {
            for ($i=2; $i<21; $i++) {
                $database->setQuery("SELECT COUNT(*) FROM #__newsfeeds WHERE catid='$this->catid' AND seotitle='".$ntitle."-".$i."'".$extra);
                $c2 = intval($database->loadResult());
                if (!$c2) {
                    $ntitle .= '-'.$i;
                    break;
                }
            }
            if ($c2) { $ntitle .= '-'.rand(1000,9999); }
        }

        $this->sugtitle = $ntitle;
        return $ntitle;
    }


    /***********************************/
    /* SUGGEST SEO TITLE FOR CONTACTS */
    /***********************************/
    private function suggest_contact($ntitle) { //feed manually id and catid before suggest
        global $database;

        if (intval($this->catid) < 1) {
            $this->writeMsg('6');
            return false;
        }

        $extra = ($this->id) ? " AND id <> '".$this->id."'" : '';
        $database->setQuery("SELECT COUNT(*) FROM #__contact_details WHERE catid='$this->catid' AND seotitle='$ntitle'".$extra);
        $c = intval($database->loadResult());
        if ($c) {
            for ($i=2; $i<21; $i++) {
                $database->setQuery("SELECT COUNT(*) FROM #__contact_details WHERE catid='$this->catid' AND seotitle='".$ntitle."-".$i."'".$extra);
                $c2 = intval($database->loadResult());
                if (!$c2) {
                    $ntitle .= '-'.$i;
                    break;
                }
            }
            if ($c2) { $ntitle .= '-'.rand(1000,9999); }
        }

        $this->sugtitle = $ntitle;
        return $ntitle;
    }


    /**********************************/
    /* SUGGEST SEO TITLE FOR SECTIONS */
    /**********************************/
    private function suggest_section($ntitle) { //feed manually id before suggest
        global $database;

        $extra = ($this->id) ? " AND id <> '".$this->id."'" : '';
        $database->setQuery("SELECT COUNT(*) FROM #__sections WHERE scope='content' AND seotitle='$ntitle'".$extra);
        $c = intval($database->loadResult());
        if ($c) {
            for ($i=2; $i<21; $i++) {
                $database->setQuery("SELECT COUNT(*) FROM #__sections WHERE scope='content' AND seotitle='".$ntitle."-".$i."'".$extra);
                $c2 = intval($database->loadResult());
                if (!$c2) {
                    $ntitle .= '-'.$i;
                    break;
                }
            }
            if ($c2) { $ntitle .= '-'.rand(1000,9999); }
        }

        $this->sugtitle = $ntitle;
        return $ntitle;
    }


    /************************************/
    /* SUGGEST SEO TITLE FOR CATEGORIES */
    /************************************/
    private function suggest_category($ntitle) { //feed manually id and section before suggest
        global $database;

        $extra = ($this->id) ? " AND id <> '".$this->id."'" : '';
        $database->setQuery("SELECT COUNT(*) FROM #__categories WHERE section='".$this->section."' AND seotitle='$ntitle'".$extra);
        $c = intval($database->loadResult());
        if ($c) {
            for ($i=2; $i<21; $i++) {
                $database->setQuery("SELECT COUNT(*) FROM #__categories WHERE section='".$this->section."' AND seotitle='".$ntitle."-".$i."'".$extra);
                $c2 = intval($database->loadResult());
                if (!$c2) {
                    $ntitle .= '-'.$i;
                    break;
                }
            }
            if ($c2) { $ntitle .= '-'.rand(1000,9999); }
        }

        $this->sugtitle = $ntitle;
        return $ntitle;
    }


    /*********************************/
    /* SUGGEST SEO TITLE FOR WRAPPER */
    /*********************************/
    private function suggest_wrapper($ntitle) { //feed manually Itemid before suggest
        global $database;
        
        $extra = ($this->Itemid) ? " AND id <> '".$this->Itemid."'" : "";
        $database->setQuery("SELECT COUNT(*) FROM #__menu WHERE type='wrapper' AND seotitle='$ntitle'".$extra);
        $c = intval($database->loadResult());
        if ($c) {
            for ($i=2; $i<21; $i++) {
                $database->setQuery("SELECT COUNT(*) FROM #__menu WHERE type='wrapper' AND seotitle='".$ntitle."-".$i."'".$extra);
                $c2 = intval($database->loadResult());
                if (!$c2) {
                    $ntitle .= '-'.$i;
                    break;
                }
            }
            if ($c2) { $ntitle .= '-'.rand(1000,9999); }
        }

        $this->sugtitle = $ntitle;
        return $ntitle;
    }


    /******************************/
    /* SUGGEST SEO TITLE FOR POLL */
    /******************************/
    private function suggest_poll($ntitle) { //feed manually id before suggest
        global $database;
        
        $extra = ($this->id) ? " AND id <> '".$this->id."'" : "";
        $database->setQuery("SELECT COUNT(*) FROM #__polls WHERE seotitle='$ntitle'".$extra);
        $c = intval($database->loadResult());
        if ($c) {
            for ($i=2; $i<21; $i++) {
                $database->setQuery("SELECT COUNT(*) FROM #__polls WHERE seotitle='".$ntitle."-".$i."'".$extra);
                $c2 = intval($database->loadResult());
                if (!$c2) {
                    $ntitle .= '-'.$i;
                    break;
                }
            }
            if ($c2) { $ntitle .= '-'.rand(1000,9999); }
        }

        $this->sugtitle = $ntitle;
        return $ntitle;
    }


    /***************************************/
    /* SUGGEST SEO TITLE FOR CONTENT ITEMS */
    /***************************************/
    private function suggest_content($ntitle) { //feed manually id and catid before suggest
        global $database;

        if (intval($this->catid) < 1) {
            $this->writeMsg('6');
            return false;
        }

        $extra = ($this->id) ? " AND id <> '".$this->id."'" : '';
        $database->setQuery("SELECT COUNT(*) FROM #__content WHERE catid='".$this->catid."' AND seotitle='$ntitle'".$extra);
        $c = intval($database->loadResult());
        if ($c) {
            for ($i=2; $i<21; $i++) {
                $database->setQuery("SELECT COUNT(*) FROM #__content WHERE catid='".$this->catid."' AND seotitle='".$ntitle."-".$i."'".$extra);
                $c2 = intval($database->loadResult());
                if (!$c2) {
                    $ntitle .= '-'.$i;
                    break;
                }
            }
            if ($c2) { $ntitle .= '-'.rand(1000,9999); }
        }

        $this->sugtitle = $ntitle;
        return $ntitle;
    }


    /***************************************/
    /* SUGGEST SEO TITLE FOR TYPED CONTENT */
    /***************************************/
    private function suggest_typed($ntitle) { //feed manually id before suggest
        global $database;

        $extra = ($this->id) ? " AND id <> '".$this->id."'" : '';
        $database->setQuery("SELECT COUNT(*) FROM #__content WHERE sectionid='0' AND catid='0' AND seotitle='$ntitle'".$extra);
        $c = intval($database->loadResult());
        if ($c) {
            for ($i=2; $i<21; $i++) {
                $database->setQuery("SELECT COUNT(*) FROM #__content WHERE sectionid='0' AND catid='0' AND seotitle='".$ntitle."-".$i."'".$extra);
                $c2 = intval($database->loadResult());
                if (!$c2) {
                    $ntitle .= '-'.$i;
                    break;
                }
            }
            if ($c2) { $ntitle .= '-'.rand(1000,9999); }
        }
        $this->sugtitle = $ntitle;
        return $ntitle;
    }

/*------------------------------- VALIDATORS -------------------------- */

    /**********************/
    /* VALIDATE SEO TITLE */
    /**********************/
    public function validate() {
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
        switch ($this->option) {
            case 'com_content':
                $out = $this->validate_content();
            break;
            case 'com_newsfeeds':
                $out = $this->validate_newsfeed();
            break;
            case 'com_contact':
                $out = $this->validate_contact();
            break;
            case 'com_sections':
                $out = $this->validate_section();
            break;
            case 'com_categories':
                $out = $this->validate_category();
            break;
            case 'com_wrapper':
                $out = $this->validate_wrapper();
            break;
            case 'com_poll':
                $out = $this->validate_poll();
            break;
            case 'com_typedcontent':
                $out = $this->validate_typed();
            break;
        }
        return $out;
    }


    /************************************/
    /* VALIDATE SEO TITLE FOR NEWSFEEDS */
    /************************************/
    private function validate_newsfeed() { //feed manually id, catid before validation
        global $database;

        if (intval($this->catid) < 1) {
            $this->writeMsg('6');
            return false;
        }

        $extra = ($this->id) ? " AND id <> '".$this->id."'" : '';
        $database->setQuery("SELECT COUNT(*) FROM #__newsfeeds WHERE catid='".$this->catid."' AND seotitle='".$this->seotitle."'".$extra);
        $c = intval($database->loadResult());
	    if ($c) {
		    $this->writeMsg('3');
            return false;
        }
        $this->writeMsg('4');
        return true;
    }


    /***********************************/
    /* VALIDATE SEO TITLE FOR CONTACTS */
    /***********************************/
    private function validate_contact() { //feed manually id, catid before validation
        global $database;

        if (intval($this->catid) < 1) {
            $this->writeMsg('6');
            return false;
        }

        $extra = ($this->id) ? " AND id <> '".$this->id."'" : '';
        $database->setQuery("SELECT COUNT(*) FROM #__contact_details WHERE catid='$this->catid' AND seotitle='".$this->seotitle."'".$extra);
        $c = intval($database->loadResult());
	    if ($c) {
		    $this->writeMsg('3');
            return false;
        }
        $this->writeMsg('4');
        return true;
    }


    /****************************************/
    /* VALIDATE SEO TITLE FOR TYPED CONTENT */
    /****************************************/
    private function validate_typed() { //feed manually id before validation
        global $database;

        //exclude already registered names and real files
        $invalidNames = array('search', 'login', 'logout', 'vote', 'index');
        if (in_array($this->seotitle, $invalidNames)) {
		    $this->writeMsg('2');
            return false;
        }

        $extra = ($this->id) ? " AND id <> '".$this->id."'" : '';
        $database->setQuery("SELECT COUNT(*) FROM #__content WHERE sectionid='0' AND catid='0' AND seotitle='".$this->seotitle."'".$extra);
        $c = intval($database->loadResult());
	    if ($c) {
		    $this->writeMsg('3');
            return false;
        }
        $this->writeMsg('4');
        return true;
    }


    /*******************************************/
    /* VALIDATE SEO TITLE FOR CONTENT SECTIONS */
    /*******************************************/
    private function validate_section() { //feed manually id before validation
        global $database, $mosConfig_absolute_path;

        //exclude already registered names and real directories
        $invalidNames = array('members', 'links', 'contact', 'feeds', 'registration', 'rss', 'polls', 'banners', 
        'ext', 'blog', 'eblog', 'archive', 'submitted-content', 'search', 'login', 'logout', 'content', 'forum', 'component',
        'modules', 'mambots', 'components', 'cache', 'tmpr', 'images', 'administrator', 'includes', 'help', 'editor', 
        'language', 'media', 'bridges', 'installation', 'sitemap', 'directory', 'gallery', 'eshop', 'reservations', 'newsletter', 
		'downloads', 'events', 'arthrology', 'qpassport', 'eforum', 'webtv');
        if (in_array($this->seotitle, $invalidNames) || preg_match('/^(com_)/', $this->seotitle)) {
		    $this->writeMsg('2');
            return false;
        }

		$invalidNames2 = array('aa', 'ab', 'af', 'ar', 'sq', 'hy', 'az', 'eu', 'be', 'bn', 'bs', 'bg', 'ca', 'zh', 'ht', 'hr', 'cs',
		 'da', 'dv', 'nl', 'en', 'en-US', 'et', 'fo', 'fi','fr', 'mk', 'gl', 'de', 'el', 'gu', 'he', 'hi', 'hu', 'is', 'id', 'it', 
		'ja','kn', 'kk', 'kok', 'ko', 'ky', 'lv', 'lt', 'ms', 'ml', 'mt', 'mi', 'mr', 'mn', 'nb', 'nn','pa', 'fa', 'pl', 'pt', 'pa', 
		'ro', 'ru', 'se', 'sr', 'rs', 'sk', 'sl', 'es', 'sw', 'sv', 'sv-FI', 'syr', 'ta', 'tt', 'te', 'tr', 'uk', 'ur', 'uz', 
		'vi', 'wa', 'cy', 'xh', 'zu');
        if (in_array($this->seotitle, $invalidNames2)) {
		    $this->writeMsg('2');
            return false;
        }

		if (file_exists($mosConfig_absolute_path.'/'.$this->seotitle.'/')) {
		    $this->writeMsg('2');
            return false;
        }

        $extra = ($this->id) ? " AND id <> '".$this->id."'" : '';
        $database->setQuery("SELECT COUNT(*) FROM #__sections WHERE scope='content' AND seotitle='".$this->seotitle."'".$extra);
        $c = intval($database->loadResult());
	    if ($c) {
		    $this->writeMsg(3);
            return false;
        }
        $this->writeMsg(4);
        return true;
    }


    /*************************************/
    /* VALIDATE SEO TITLE FOR CATEGORIES */
    /*************************************/
    private function validate_category() { //feed manually id and section before validation
        global $database;

        if ($this->section == '') { //integer (content) or section name (ie com_weblinks)
		    $this->writeMsg(7);
            return false;
        }

        $extra = ($this->id) ? " AND id <> '".$this->id."'" : '';
        $database->setQuery("SELECT COUNT(*) FROM #__categories WHERE section='".$this->section."' AND seotitle='".$this->seotitle."'".$extra);
        $c = intval($database->loadResult());
	    if ($c) {
		    $this->writeMsg(3);
            return false;
        }
        $this->writeMsg(4);
        return true;
    }


    /**********************************/
    /* VALIDATE SEO TITLE FOR WRAPPER */
    /**********************************/
    private function validate_wrapper() { //feed manually Itemid before validation
        global $database;

        $extra = ($this->Itemid) ? " AND id <> '".$this->Itemid."'" : '';
        $database->setQuery("SELECT COUNT(*) FROM #__menu WHERE type='wrapper' AND seotitle='".$this->seotitle."'".$extra);
        $c = intval($database->loadResult());
	    if ($c) {
		    $this->writeMsg('3');
            return false;
        }
        $this->writeMsg('4');
        return true;
    }


    /*******************************/
    /* VALIDATE SEO TITLE FOR POLL */
    /*******************************/
    private function validate_poll() { //feed manually id before validation
        global $database;

        //exclude already registered names
        if ($this->seotitle == 'vote') {
		    $this->writeMsg('2');
            return false;
        }

        $extra = ($this->id) ? " AND id <> '".$this->id."'" : '';
        $database->setQuery("SELECT COUNT(*) FROM #__polls WHERE seotitle='".$this->seotitle."'".$extra);
        $c = intval($database->loadResult());
	    if ($c) {
		    $this->writeMsg('3');
            return false;
        }
        $this->writeMsg('4');
        return true;
    }


    /****************************************/
    /* VALIDATE SEO TITLE FOR CONTENT ITEMS */
    /****************************************/
    private function validate_content() { //feed manually id, catid before validation
        global $database;

        if (intval($this->catid) < 1) {
            $this->writeMsg('6');
            return false;
        }

        $extra = ($this->id) ? " AND id <> '".$this->id."'" : '';
        $database->setQuery("SELECT COUNT(*) FROM #__content WHERE catid='".$this->catid."' AND seotitle='".$this->seotitle."'".$extra);
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