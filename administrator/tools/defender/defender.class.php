<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools/Defender
* @author: Ioannis Sannos
* @email: datahell@elxis.org
* @link: http://www.elxis.org
* @description: Defender protects your Elxis site against XSS and SQL injection attacks. It is also an IP blocker tool.
* @license: http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
* Elxis CMS is a Free Software
*/

define('_DEFENDER', 1);


class ElxisDefender {

	public $enabled = 0;
	public $init_error = 0;
	public $valid = 1;
	protected $protvars = '_REQUEST';
	protected $log = 0;
	protected $dmail = 0;
	protected $mailaddress = '';
	protected $siteoff = 0;
	protected $blockip = 0;
	protected $key = '';
	protected $filters = array();
	protected $defdir = '';
	protected $ip = '';
	protected $allowedip = 0;


	/***************/
	/* CONSTRUCTOR */
	/***************/
	public function __construct() {
        $elxis_root = str_replace( '/administrator/tools/defender', '', str_replace( DIRECTORY_SEPARATOR, '/', dirname(__FILE__) ) );
        $this->defdir = $elxis_root.'/administrator/tools/defender';
        if (!file_exists( $this->defdir.'/config.php' )) {
            $this->init_error = 1;
        }

        if ( !$this->init_error ) {
            include ( $this->defdir.'/config.php' );
            if (!is_dir ($this->defdir.'/logs/')) {
                $this->init_error = 1;
            }
			if (!file_exists($this->defdir.'/logs/ip.txt')) {
				$this->init_error = 1;
			}
			if (!file_exists($this->defdir.'/logs/log.txt')) {
				$this->init_error = 1;
			}
			if (!file_exists($this->defdir.'/logs/allowed.txt')) {
				$this->init_error = 1;
			}
            $this->enabled = intval($dconf_enabled);
            $this->protvars = $dconf_protvars;
            $this->log = intval($dconf_log);
            $this->dmail = intval($dconf_mail);
            $this->mailaddress = $dconf_mailaddress;
			$this->siteoff = intval($dconf_siteoff);
			$this->blockip = intval($dconf_blockip);
			$this->key = $dconf_key;
			$this->filters = $dconf_filters;
			$this->ip = $_SERVER['REMOTE_ADDR'];
			$this->allowedip = intval($dconf_allowedip);

            if ((!is_array($this->filters)) || (count($this->filters) == 0)) {
                if (!$this->allowedip) {
                    $this->init_error = 1;
                }
            }
            if ((strlen($this->key)<8) || (strlen($this->key) > 32)) {
                $this->init_error = 1;            
            }
        }

        if ((!$this->init_error) && ($this->enabled)) {
            $this->DefenderRun();
        }
	}


	/****************/
	/* RUN DEFENDER */
	/****************/
	protected function DefenderRun() {
        if ($this->allowedip) {
            if (!$this->checkAllowed()) {
                die('ELXIS DEFENDER. You are not allowed to access this site');
            }
        }
        if ((is_array($this->filters)) && (count($this->filters) > 0)) {
            if ($this->siteoff > 0) {
                $this->checkOffline();
            }
            if ($this->blockip) {
			    if(!$this->checkIP()) {
			  	    $this->valid = 0;
				    die('ELXIS DEFENDER. You are not allowed to access this site');
			    }
		    }
		    if (!$this->init_error) {
			    $this->checkVars();
		    }
		}
	}


	/*******************************/
	/* CHECK SITE's OFFLINE STATUS */
	/*******************************/
    protected function checkOffline() {
        $nowtime = time();
		clearstatcache();
		$oldtime = intval(@filemtime($this->defdir.'/logs/offline.txt'));
		if (!$oldtime) { return; }
		
		if ($oldtime > 1156000000) { //ok its a valid timestamp
            $diff = intval($nowtime - $oldtime);
            if ($this->siteoff > $diff) {
                die('ELXIS DEFENDER. Site is temporary Offline.');
            }
		}
    }


	/****************************/
	/* PERFORM CHECK ON COOKIES */
	/****************************/
	protected function checkCookie() {
		if (isset($_COOKIE)) {
			if (count($_COOKIE) > 0) {
                foreach ($_COOKIE as $cook) {
                    foreach ($this->filters as $filter) {
                        if (!is_array($cook)) {
                            $c = stristr($cook, $filter);
                        } else { $c = in_array($filter, $cook); }
                        if ($c != false) {
                	  	    $this->block();
                	  	    $this->logAttack($filter);
                	  	    $this->sendAlert();
                	  	    $this->turnOffline();
                            die('ELXIS DEFENDER. REQUEST DROPPED');
                	   }
            	   }
                }
			}
		}
	}


	/******************************/
	/* PERFORM CHECK ON VARIABLES */
	/******************************/
	protected function checkVars() {
		if (count($this->filters) == 0) { return; }
	  	$what = $this->protvars;
		if ($what == '') {	
			$this->checkCookie();
			$what = '_REQUEST';
		}

		global $$what;
		if (count($$what) > 0) {
        	foreach ($$what as $key => $val) {
            	foreach ($this->filters as $filter) {
                    if (!is_array($val)) {
                        $c = stristr($val, $filter);
                        if (!$c) { $c = stristr($key, $filter); }
                    } else {
						$c = in_array($filter, $val); 
						if (!$c) { $c = stristr($key, $filter); }
					}
                    if ($c) {
                	  	$this->block();
                	  	$this->logAttack($filter);
                	  	$this->sendAlert();
                	  	$this->turnOffline();
                    	die('ELXIS DEFENDER. REQUEST DROPPED');
                    }
            	}
        	}
    	}
	}


	/***********************/
	/* BLOCK AN IP ADDRESS */
	/***********************/
	protected function block() {
		if ($this->blockip) {
			if (!($fr = @fopen($this->defdir.'/logs/ip.txt', 'r'))) { return; }
			$data = @fread($fr, filesize($this->defdir.'/logs/ip.txt'));
			@fclose($fr);
			if (trim($data) != '') {
				$ips = unserialize($this->akrypto(trim($data), $this->key));
			} else { $ips = array(); }
			array_push($ips, $this->ip);
			$newdata = $this->krypto(serialize($ips), $this->key);
			if (!($fw = @fopen($this->defdir.'/logs/ip.txt', 'w'))) { return; }
			@fwrite($fw, $newdata);
			@fclose($fw);
		}
	}


	/*****************/
	/* LOG AN ATTACK */
	/*****************/
	protected function logAttack($filter) {
		if ($this->log) {
			if (!($f = @fopen($this->defdir.'/logs/log.txt', 'a'))) { return; }
			$ora = time();
			if ($this->ip == '') { $this->ip = $_SERVER['REMOTE_ADDR']; }
			$data = serialize(array($this->ip, $ora, $filter));
			$wdata = $this->krypto($data, $this->key)."\n";
			@fwrite($f, $wdata);
			@fclose($f);
		}
	}


	/*******************/
	/* SEND MAIL ALERT */
	/*******************/
	protected function sendAlert() {
		if (($this->dmail) && (trim($this->mailaddress) != '')) {
            @clearstatcache();
		    $oldtime = intval(@filemtime($this->defdir.'/logs/lastmail.txt'));
		    if (!$oldtime) { return; }

            $nowtime = time();
            $diff = intval($nowtime - $oldtime);

			if (isset($_SERVER['REQUEST_URI'])) {
				$uri = $_SERVER['REQUEST_URI'];
			} else {
				$uri = $_SERVER['SCRIPT_NAME'];
				$uri .= (isset($_SERVER['QUERY_STRING'])) ? '?'.$_SERVER['QUERY_STRING'] : '';
			}
			$uri = @addslashes(htmlspecialchars(urldecode($uri), ENT_NOQUOTES, 'UTF-8'));

            if ($diff > 300) { //dont send mail if have nt passed 5 minutes since last dispatch
                $subject = "Message from Elxis Defender";
                
                $from = 'defender@'.preg_replace('/^(www.)/', '', $_SERVER['HTTP_HOST']);
                
                $headers = "MIME-Version: 1.0\n";
                $headers .= "Content-type: text/plain; charset=UTF-8\n";
                $headers .= "From: ".$from."\n";
                $headers .= "Reply-To: ".$from."\n";
                $headers .= "X-Mailer: Elxis CMS\n";
                $headers .= "To: ".$this->mailaddress."\n";
                $headers .= "Date: ".date('r')."\n";
                $headers .= "Subject: ".$subject."\n";

                $message = "Do not reply to this e-mail\n";
                $message .= "This is a notification e-mail from Elxis Defender\n\n";
		  	    $message .= "Elxis Defender blocked an attack to your site\n";
                $message .= "ATTACKER IP ADDRESS: ".$this->ip;
                $message .= ($this->blockip) ? " (blocked)\n" : "\n";
                $message .= "Requested URI: ".$uri."\n";
                $message .= "DATE: ".date('d-m-Y H:i:s')."\n";
                $message .= ($this->log) ? "Attack was logged\n" : "Attack did not logged\n";
                $message .= ($this->siteoff) ? "Site turned offline for ".$this->siteoff." seconds\n" : "";
                $message .= "\nNote: Elxis Defender wont send you another notification for the next 5 minutes even if more attacks occured.\n";
                $message .= "\n---------------------------------------------------\n";
                $message .= "ELXIS DEFENDER by Elxis Team";
                $message .= "\n---------------------------------------------------\n";

                @mail($this->mailaddress, $subject, $message, $headers);
                @touch($this->defdir.'/logs/lastmail.txt');
            }
		}
	}


	/***********************************/
	/* MODIFY SITE's LAST OFFLINE TIME */
	/***********************************/
    protected function turnOffline() {
        if ($this->siteoff > 0) {
            @touch($this->defdir.'/logs/offline.txt');
        }
    }


	/************************************/
	/* CHECK AN IP ADDRESS BLOCK STATUS */
	/************************************/
	protected function checkIP() {
		if (strlen($this->ip) < 9) { return true; }
		$allowed = true;
		if (!($f = @fopen($this->defdir.'/logs/ip.txt', 'r'))) {
			$this->init_error = 1;
			return true;
		}
		$data = @fread($f, filesize($this->defdir.'/logs/ip.txt'));
		@fclose($f);
		if (strlen($data)>5) {
            $ips = unserialize($this->akrypto($data, $this->key));
            if (is_array($ips)) {
            	if (in_array($this->ip, $ips)) {
                	$allowed = false; //BLOCK USER!
            	}
            }
        }

        //now we will check ip ranges
		if ($allowed) {
			if (!($f2 = @fopen($this->defdir.'/logs/range.txt', 'r'))) {
				$this->init_error = 1;
				return $allowed;
			}
			$data2 = @fread($f2, filesize($this->defdir.'/logs/range.txt'));
			@fclose($f2);
			if (strlen($data2)>3) {
            	$ranges = unserialize($this->akrypto($data2, $this->key));
            	if ((!is_array($ranges)) || (count($ranges) < 1)) { return $allowed; }
				for ($i=0; $i<count($ranges); $i++) {
					$range = $ranges[$i];
					$rips = preg_split('/[\_]/', $range);
					$start = $this->analyzeIP($rips[0]);
					$end = $this->analyzeIP($rips[1], 0);
					if ($this->searchRanges($this->ip, $start, $end)) {
						$allowed = false; //BLOCK USER!
						break;
					}
				}
			}
		}
        return $allowed;
    }

	
	/*******************************************/
	/* SEARCH IF A GIVEN IP BELONGS TO A RANGE */
	/*******************************************/
	protected function searchRanges($ip, $start, $end) {
		$cip = explode('.', $ip);
		$out = true;
		for ($i= 0; $i<4; $i++) {
			if (!(($start[$i] <= $cip[$i]) && ($cip[$i] <= $end[$i]))) {
				$out = false;
				break;
			}
		}
		return $out;
	}


	/********************************************/
	/* CONVERT A RANGED IP TO A FULL IP ADDRESS */
	/********************************************/
	protected function analyzeIP($ip, $start=1) {
	  	$add = ($start == 1) ? '0': '255';
		$arr = explode('.', $ip);
		$c = count($arr);
		switch ($c) {
		  	case '4':
		  	break;
			case '3':
				array_push($arr, $add);
			break;
			case '2':
				array_push($arr, $add, $add);
			break;
			case '1':
				array_push($arr, $add, $add, $add);
			break;
			default:
				return false;
			break;
		}
		return $arr;
	}


    /*********************************************/
    /* CHECK IF IP IS ALLOWED TO ACCESS THE SITE */
    /*********************************************/
    protected function checkAllowed() {
		if (strlen($this->ip) < 9) { return true; }
		$allowed = true;
		if (!($f = @fopen($this->defdir.'/logs/allowed.txt', 'r'))) {
			$this->init_error = 1;
			return true;
		}
		$data = @fread($f, filesize($this->defdir.'/logs/allowed.txt'));
		@fclose($f);
		if (strlen($data)>5) {
            $ips = unserialize($this->akrypto($data, $this->key));
            if (is_array($ips)) {
                switch ($this->allowedip) {
                    case '1': 
                        if (defined('_ELXIS_ADMIN') && (!in_array($this->ip, $ips))) {
                            $allowed = false; //BLOCK USER!
                            $this->valid = 0;
                        }
                    break;
                    case '2':
                        if (!in_array($this->ip, $ips)) {
                            $allowed = false; //BLOCK USER!
                            $this->valid = 0;
                        }
                    break;
                }
            }
        }
        return $allowed;
    }


	/********************/
	/* ENCRYPT A STRING */
	/********************/
	protected function krypto($str, $ky='') {
		if ($ky == '') { return $str; }
		$ky = str_replace(chr(32), '', $ky);
		if (strlen($ky)<8) { $this->init_error = 1;  return false; }
		$kl = (strlen($ky)<32) ? strlen($ky) : 32;
		$k = array();
		for ($i=0; $i<$kl; $i++) {
			$k[$i] = ord($ky{$i})&0x1F;
		}
		$j=0;
		for ($i=0; $i<strlen($str); $i++) {
			$e = ord($str{$i});
			$str{$i} = ($e&0xE0) ? chr($e^$k[$j]) : chr($e);
			$j++;
			$j= ($j==$kl) ? 0 : $j;
		}
        return base64_encode($str);
	}


	/********************/
	/* DECRYPT A STRING */
	/********************/
	protected function akrypto($str, $ky='') {
  		$str= base64_decode($str);
		if ($ky == '') { return $str; }
		$ky = str_replace(chr(32), '', $ky);
		if (strlen($ky)<8) { $this->init_error = 1;  return false; }
		$kl = (strlen($ky)<32) ? strlen($ky) : 32;
		$k = array();
		for ($i=0; $i<$kl; $i++) {
			$k[$i] = ord($ky{$i})&0x1F;
		}
		$j=0;
		for ($i=0; $i<strlen($str); $i++) {
			$e = ord($str{$i});
			$str{$i} = ($e&0xE0) ? chr($e^$k[$j]) : chr($e);
			$j++;
			$j= ($j==$kl) ? 0 : $j;
		}
        return $str;
	}

}

?>