<?php 
/**
* @version: $Id: screenshot.class.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Screenshots Class
* @license: http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
* Elxis CMS is a Free Software
* @author: Ioannis Sannos (datahell)
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @example of use:
* $screen = new getscreenshot('http://www.in.gr','1', $snoopy);
* echo $screen->screenshot();
* providers=1,2,3,4,5,6 (open.thumbshots, nameintel, msn, artviper, thumbshot.de, webdesignbook)
* snoopy must have been be included and started ($snoopy = new Snoopy) with maxredirs=1 (for alexa)
* returns site screenshot or false
* @note: 2/11/2006: Removed Alexa. Added msn, artviper, thumbshot.de, webdesignbook.
* NameIntel must also be removed in the future.
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class getscreenshot {

    public $inurl = '';
    public $provider = '1';
    public $snoopy = null;
    public $site = '';
    public $domain = '';
    public $imgurl = '';
    public $proname = 'open.thumbshots';


    /*************************/
    /* CONSTRUCTION FUNCTION */
    /*************************/
    public function __construct($inurl, $provider, $snoopy ) {
        global $_VERSION;
        if (($_VERSION->PRODUCT != 'E'.'l'.'xi'.'s') || (!preg_match('/eLxiS/i', $_VERSION->COPYRIGHT))) { die(); } 
    	$this->inurl = $inurl;
     	$this->site = $this->getsite ($inurl);
    	$this->domain = $this->getdomain ($inurl);
    	$this->provider = $provider;
    	$this->snoopy = $snoopy;
        $this->getImgUrl($provider);
    }


    /*******************/
    /* GET SCREENSHOOT */
    /*******************/
    public function screenshot() {
    	if ($this->checkthumb( $this->provider ) == true) {
        	return '<img src="'.$this->imgurl.'" border="0" title="'.$this->domain.'" width="120" height="90" />';
        } else { 
        	return false;
        }
    }


    /***********************************/
    /* SET IMAGE URL AND PROVIDER NAME */
    /***********************************/
    private function getImgUrl ($provider) {
    	switch ($provider) {
            case 1:
        	$this->imgurl = "http://open.thumbshots.org/image.pxf?url=".$this->site;
        	$this->proname = 'open.thumbshots';
            break;
            case 2:    
        	$this->imgurl = "http://img.nameintel.com/Thumbnails/tn3.html?domain=".$this->domain;
        	$this->proname = 'nameintel';
            break;
            case 3:
        	$this->imgurl = "http://msnsearch.srv.girafa.com/srv/i?s=MSNSEARCH&r=".$this->site;
        	$this->proname = 'MSN';
            break;
            case 4:
            $this->imgurl = 'http://www.artviper.net/screenshots/screener.php?url='.$this->site.'&q=80&h=90&w=120';
            $this->proname = 'artviper.net';
            break;
            case 5:
            $this->imgurl = "http://www.thumbshot.de/cgi-bin/show.cgi?url=".$this->site;
            $this->proname = 'thumbshot.de';
            break;
            case 6:
            $this->imgurl = "http://webdesignbook.net/snapper.php?w=120&h=90&url=".$this->site;
            $this->proname = 'webdesignbook.net';
            break;
            default:
            $this->imgurl = "http://open.thumbshots.org/image.pxf?url=".$this->site;
            $this->proname = 'open.thumbshots';
            break;
        }
        return true;
    }


    /*****************************/
    /* CHECK IF THUMBSHOT EXISTS */
    /*****************************/
    private function checkthumb ( $provider='1' ) {
        if (@!$this->snoopy->fetch($this->imgurl)) {
            return false;
        }
        $ok = false;
    	switch ($provider) {
        	case 1: //open.thumbshots.org
				$mystr= $this->snoopy->results;
				$sn_err = trim($this->snoopy->error);
				if ( $sn_err != '' ) { return false; }
    			if (eUTF::utf8_strlen($mystr) > '300') { $ok = true; } else { return false; }
        	break;
        	case 2: //img.nameintel.com
        	    return false; //disable nameintel
				if (!$this->snoopy->headers) { return false; }
            	if (!preg_match('/text\/html/', $this->snoopy->headers[5])) { $ok = true; }
        	break;
            case 3: //msn
                if (!$this->snoopy->headers) { return false; }
        		if (preg_match('/ETag/i', $this->snoopy->headers[4])) { return false; } else { $ok = true; }
            break;
            case 4: //artviper.net
                if (!$this->snoopy->headers) { return false; }
                for ($t=0; $t < count($this->snoopy->headers); $t++) {
                	if (preg_match('/Content\-Length/i', $this->snoopy->headers[$t])) { $ok = true; }
                }
            break;
            case 5: //thumbshot.de
				$mystr= $this->snoopy->results;
				$sn_err = trim($this->snoopy->error);
				if ( $sn_err != '' ) { return false; }
    			if (eUTF::utf8_strlen($mystr) > '400') { $ok = true; } else { return false; }
            break;
            case 6: //webdesignbook.net
				$mystr= $this->snoopy->results;
				$sn_err = trim($this->snoopy->error);
				if ( $sn_err != '' ) { return false; }
    			if (eUTF::utf8_strlen($mystr) > '300') { $ok = true; } else { return false; }
            break;
        	default:
        	break;
    	}
        return $ok;
    }


    /*********************/
    /* GET SITE FROM URL */
    /*********************/
    private function getsite ( $inurl ) {
    	$insite = preg_split("/[\/]/", $inurl, -1, PREG_SPLIT_NO_EMPTY);
    	if ($insite[0] == 'http:') {
    		$site = 'http://'.$insite[1];
            return $site;
        } else { return false; }
    }


    /***********************/
    /* GET DOMAIN FROM URL */
    /***********************/
    private function getdomain ( $inurl ) {
    	$insite = preg_split("/[\/]/", $inurl, -1, PREG_SPLIT_NO_EMPTY);
    	if ($insite[0] == 'http:') {
     		$domain = preg_replace("/^[w]{3}[\.]/", "", $insite[1]);
            return $domain;
        } else { return false; }
    }

} //telos class

?>