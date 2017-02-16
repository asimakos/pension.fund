<?php 
/**
* @version: $Id: updiag.class.php 2609 2010-03-28 12:08:46Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools / Updiag
* @author: Ioannis Sannos
* @email: datahell@elxis.org
* @link: http://www.elxis.org
* @description: Updiag is an Elxis CMS diagnostic and update tool
* @license: http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
* Elxis CMS and Updiag are Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class updateDiagnosis {
  
	public $iversion = 0;
	public $msg = '';
	public $errormsg = '';


    /***************/
    /* CONSTRUCTOR */
    /***************/
    public function __construct() {
        global $_VERSION;
        $this->iversion = $_VERSION->RELEASE.'.'.$_VERSION->DEV_LEVEL;
    }


    /*******************************/
    /* FETCH ELXIS CURRENT VERSION */
    /*******************************/
    public function currentVersion() {
        global $mainframe, $alang, $upLang;

		if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
		$xmldata = $this->readremotefile($this->fetchURL('currentversion'), 1);
		if (!$xmldata || ($xmldata == '')) {
		    $this->errormsg = $upLang->CNOTGETELXD;
            return false;
		}
		
		$xmlDoc = simplexml_load_string($xmldata, 'SimpleXMLElement');
		if (!$xmlDoc) {
		    $this->errormsg = $upLang->CNOTGETELXD;
            return false;
		}
		unset($xmldata);
		if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
			if ($xmlDoc->getName() != 'elxiscms') {
		    	$this->errormsg = $upLang->INVXML;
            	return false;
			}
		}

		$row = new stdClass();
		$row->version = isset($xmlDoc->version) ? (string)$xmlDoc->version : '';
		$row->date = isset($xmlDoc->date) ? (string)$xmlDoc->date : '';
		$row->title = isset($xmlDoc->title) ? (string)$xmlDoc->title : '';
		$row->more = isset($xmlDoc->more) ? (string)$xmlDoc->more : '';
		$row->link = isset($xmlDoc->link) ? (string)$xmlDoc->link : '';
		$row->image = isset($xmlDoc->image) ? (string)$xmlDoc->image : '';
		$row->size = isset($xmlDoc->size) ? (string)$xmlDoc->size : '';

		if (isset($xmlDoc->description)) {
			$descs = $xmlDoc->description->children();
			if ($descs) {
                $mydesc = '';
                $engdesc = '';
                foreach($descs as $dlang => $desc) {
                    if ($dlang == $alang) {
                        $mydesc = (string)$desc;
                    } elseif ($dlang == 'english') {
                        $engdesc = (string)$desc;
                    }
                }
                $row->description = ($mydesc != '') ? $mydesc : $engdesc;
			} else {
				$row->description = (string)$xmlDoc->description;
			}
		} else {
			$row->description = '';
		}

        return $row;
    }


    /**********************/
    /* SEARCH FOR PATCHES */
    /**********************/
    public function patches() {
        global $mainframe, $alang, $upLang;

		if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
		$xmldata = $this->readremotefile($this->fetchURL('patches'), 1);
		if (!$xmldata || ($xmldata == '')) {
		    $this->errormsg = $upLang->CNOTGETELXD;
            return false;
		}
		
		$xmlDoc = simplexml_load_string($xmldata, 'SimpleXMLElement');
		if (!$xmlDoc) {
		    $this->errormsg = $upLang->CNOTGETELXD;
            return false;
		}
		unset($xmldata);
		if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
			if ($xmlDoc->getName() != 'elxiscms') {
		    	$this->errormsg = $upLang->INVXML;
            	return false;
			}
		}

        $rows = array();
        $q = 0;
        $items = $xmlDoc->children();
		if ($items) {
			foreach ($items as $item) {
				if (!isset($item->version)) { continue; }
				$vers = (string)$item->version;
                $x = preg_split('/[\_]/', $vers, -1);
                if ($x[0] < $this->iversion) { continue; }
                $rows[$q]['version'] = $vers;
                $rows[$q]['date'] = isset($item->date) ? (string)$item->date : '';
                $rows[$q]['title'] = isset($item->title) ? (string)$item->title : '';
                $rows[$q]['more'] = isset($item->more) ? (string)$item->more : '';
                $rows[$q]['link'] = isset($item->link) ? (string)$item->link : '';
                $rows[$q]['size'] = isset($item->size) ? (string)$item->size : '';

				if (isset($item->description)) {
					$descs = $item->description->children();
					if ($descs) {
                		$mydesc = '';
                		$engdesc = '';
                		foreach($descs as $dlang => $desc) {
                    		if ($dlang == $alang) {
                        		$mydesc = (string)$desc;
							} elseif ($dlang == 'english') {
                        		$engdesc = (string)$desc;
                    		}
                		}
                		$rows[$q]['description'] = ($mydesc != '') ? $mydesc : $engdesc;
					} else {
						$rows[$q]['description'] = (string)$item->description;
					}
				} else {
					$rows[$q]['description'] = '';
				}
                $q++;
			}
		}

        return $rows;
    }


    /**********************************/
    /* UPDATE UPDIAG INTERNAL SCRIPTS */
    /**********************************/
    public function upscripts() {
        global $fmanager, $mainframe, $upLang;

        $updir = $mainframe->getCfg('absolute_path').'/administrator/tools/updiag/data/scripts/';
        $files = $fmanager->listFiles($updir);
        $xscripts = array();
        $rscripts = array();
        if ($files) {
            foreach ($files as $file) {
                if ($fmanager->FileExt($file) == 'php') {
                    array_push($xscripts, preg_replace('/(\.php)$/', '', $file));
                }
            }
        }

        require_once($mainframe->getCfg('absolute_path').'/administrator/includes/snoopy.class.php');
        $snoopy = new Snoopy;
        $snoopy->maxlength = 100000;
        $snoopy->maxredirs = 0;
        $snoopy->read_timeout =	20;
        $snoopy->timed_out = true;
        $snoopy->_fp_timeout = 20;
        $submit_url = $this->fetchURL('scripts');
        
        $submit_vars['ELXISVERSION'] = $this->iversion;
        $submit_vars['LIST'] = 1;
        $snoopy->submit($submit_url, $submit_vars);
        $sn_res = $snoopy->results;
        $sn_err = trim($snoopy->error);
        if ( $sn_err != '' ) {
            $this->errormsg = $sn_err;
        } else {
            if (preg_match('/ERR\:/',$sn_res)) {
                $x = preg_split('/[\:]/', $sn_res, -1);
                $errCode = intval($x[1]);
                switch ($errCode) {
                    case 1: $this->errormsg = $upLang->REMOTEERR1; break;
                    case 2: $this->errormsg = $upLang->REMOTEERR2; break;
                    case 3: $this->errormsg = $upLang->REMOTEERR3; break;
                    case 4: $this->errormsg = $upLang->REMOTEERR4; break;
                    default: $this->errormsg = $upLang->UNERROR; break;
                }
            } else {
                $answer = base64_decode($sn_res);
                $nscripts = preg_split('/[\|]/', $answer, -1, PREG_SPLIT_NO_EMPTY);
                if ($nscripts) {
                    foreach ($nscripts as $nscript) {
                        if ($fmanager->FileExt($nscript) == 'php') {
                            array_push($rscripts, preg_replace('/(\.php)$/', '', $nscript));
                        }
                    }
                }
            }
        }

        $rows = array();
        $q = 0;
        if (count($rscripts) > 0) {
            foreach ($rscripts as $rscript) {
                $rows[$q]['name'] = $rscript;
                $w = preg_split('/[\_]/', $rscript, -1);                
                $rows[$q]['description'] = $upLang->PROVCODE.' <b>'.$w[0].'</b> '.$upLang->TOVERSION.' <b>'.$w[1].'</b>';
                $rows[$q]['installed'] = (in_array($rscript, $xscripts)) ? 1 : 0;
                $q++;
            }
        } elseif (count($xscripts) >0) {
            foreach ($xscripts as $xscript) {
                $rows[$q]['name'] = $xscript;
                $w = preg_split('/[\_]/', $xscript, -1);                
                $rows[$q]['description'] = $upLang->PROVCODE.' <b>'.$w[0].'</b> '.$upLang->TOVERSION.' <b>'.$w[1].'</b>';
                $rows[$q]['installed'] = 1;
                $q++;
            }
        }

        return $rows;
    }


    /********************************/
    /* DOWNLOAD A SCRIPT USING AJAX */
    /********************************/
    public function downloadScript($scr='', $q=0) {
        global $mainframe, $upLang, $fmanager;

        $sdir = $mainframe->getCfg('absolute_path').'/administrator/tools/updiag/data/scripts/';

        if (!preg_match('/^[0-9]{4}[\.][0-9]{1,2}[\_][0-9]{4}[\.][0-9]{1,2}$/', $scr)) {
            echo $upLang->REMOTEERR1;
            exit();
        }
        if (file_exists($sdir.$scr.'.php')) {
            echo $upLang->REQFEXISTS;
            exit();
        }

        $t1 =  $this->microtime_float();
        require_once('includes/snoopy.class.php');
        $snoopy = new Snoopy;
        $snoopy->maxlength = 100000;
        $snoopy->maxredirs = 0;
        $snoopy->read_timeout =	20;
        $snoopy->timed_out = true;
        $snoopy->_fp_timeout = 20;
        $submit_url = $this->fetchURL('scripts');

        $submit_vars['ELXISVERSION'] = $this->iversion;
        $submit_vars['GETSCRIPT'] = 1;
        $submit_vars['SCRNAME'] = base64_encode($scr);
        $snoopy->submit($submit_url, $submit_vars);
        $sn_res = $snoopy->results;
        $sn_err = trim($snoopy->error);
        if ( $sn_err != '' ) {
            echo $sn_err;
            exit();
        }

        if (preg_match('/^ERR\:/',$sn_res)) {
            $x = preg_split('/[\:]/', $sn_res, -1);
            $errCode = intval($x[1]);
            switch ($errCode) {
                case 1: echo $upLang->REMOTEERR1; exit();
                case 2: echo $upLang->REMOTEERR2; exit();
                case 3: echo $upLang->REMOTEERR3; exit();
                case 4: echo $upLang->REMOTEERR4; exit();
                default: echo $upLang->UNERROR; exit();
            }
        }

        $t2 =  $this->microtime_float();
        $dtime = $this->downloadTime($t1, $t2);

        $fmanager->spChmod($sdir, '0777');
        if ($fmanager->createFile($sdir.$scr.'.php', $sn_res)) {
            $fmanager->spChmod($sdir.$scr.'.php', '0666');

            $dsize = $this->calculateSize($sdir.$scr.'.php');
            $size= intval(filesize($sdir.$scr.'.php'));

            echo '<br /><b>'.$upLang->FILDOWNSUC.'</b><br />'.$upLang->DFORRUNSCR;
            echo '<br />'.$upLang->SIZE.': <b>'.$dsize.'</b>, '.$upLang->DOWNLTIME.': <b>'.$dtime.'</b>';
            if ($speed = $this->calculateSpead($size, $t1, $t2)) {
                echo ', '.$upLang->DOWNLSPEED.': <b>'.$speed.'</b>';
            }
            echo '<br /><br /><a href ="javascript: runup(\''.base64_encode($scr).'\', \''.$q.'\');" class="upinfol">';
            echo $upLang->EXECUTE.'</a>';
        } else {
            echo '<br /><b>'.$upLang->CNOTCPDFIL.'</b><br />'.$upLang->PLCHSCRPERM;
        }
        exit();
    }


    /*******************************/
    /* EXECUTE A SCRIPT USING AJAX */
    /*******************************/
    public function executeScript($scr='', $q=0) {
        global $mainframe, $upLang;

        $sdir = $mainframe->getCfg('absolute_path').'/administrator/tools/updiag/data/scripts/';

        if (!preg_match('/^[0-9]{4}[\.][0-9]{1,2}[\_][0-9]{4}[\.][0-9]{1,2}$/', $scr)) {
            echo $upLang->REMOTEERR1;
            exit();
        }
        if (!file_exists($sdir.$scr.'.php')) {
            echo $upLang->SCRNOTEX;
            exit();
        }

        include_once($sdir.$scr.'.php');
        $cname = preg_replace('/\./', '', $scr);
        $cname = 'up'.preg_replace('/\_/', '', $cname);

        $upext = new $cname();
        $upext->update();
        echo $upext->upmsg;
        exit();
    }


    /******************************/
    /* DELETE A SCRIPT USING AJAX */
    /******************************/
    public function removeScript($scr='', $q=0) {
        global $mainframe, $upLang, $fmanager;

        $sdir = $mainframe->getCfg('absolute_path').'/administrator/tools/updiag/data/scripts/';
        if (!preg_match('/^[0-9]{4}[\.][0-9]{1,2}[\_][0-9]{4}[\.][0-9]{1,2}$/', $scr)) {
            echo $upLang->REMOTEERR1;
            exit();
        }
        if (!file_exists($sdir.$scr.'.php')) {
            echo $upLang->SCRNOTEX;
            exit();
        }

        if ($fmanager->deleteFile($sdir.$scr.'.php')) {
            echo $upLang->FILEREMSUC;
        } else {
            echo $upLang->CNREMSFILE;
        }
        exit();
    }


    /*********************************/
    /* DELETE A HASH FILE USING AJAX */
    /*********************************/
    public function removeHash($hash='', $q=0) {
        global $mainframe, $upLang, $fmanager;

        $sdir = $mainframe->getCfg('absolute_path').'/administrator/tools/updiag/data/hashes/';
        if (!preg_match('/^[0-9]{4}[\.][0-9]{1,2}/', $hash)) {
            echo $upLang->REMOTEERR1;
            exit();
        }
        if (!file_exists($sdir.$hash.'.txt')) {
            echo $upLang->HASHNOTEX;
            exit();
        }

        if ($fmanager->deleteFile($sdir.$hash.'.txt')) {
            echo $upLang->FILEREMSUC;
        } else {
            echo $upLang->CNREMSFILE;
        }
        exit();
    }



    /***********************/
    /* GET EXISTING HASHES */
    /***********************/
    public function hashes() {
        global $mainframe, $fmanager;
        
        $hdir = $mainframe->getCfg('absolute_path').'/administrator/tools/updiag/data/hashes/';
        $files = $fmanager->listFiles($hdir);
        $xhashes = array();
        $q=0;
        if ($files) {
            foreach ($files as $file) {
                if ($fmanager->FileExt($file) == 'txt') {
                    $xhashes[$q]['name'] = preg_replace('/(\.txt)$/', '', $file);
                    $xhashes[$q]['size'] = round((filesize($hdir.$file)/1000), 1).' KB';
                    $xdate = date('Y-m-d H:i:s', filemtime($hdir.$file));
                    $xhashes[$q]['date'] = mosFormatDate($xdate, _GEM_DATE_FORMLC2);
                    $q++;
                }
            }
        }
        return $xhashes;
    }



    /*****************************/
    /* GET HASHES FROM ELXIS.ORG */
    /*****************************/
    public function getRemoteHashes() {
        global $mainframe, $upLang, $fmanager;

        $rhashes = array();
        $hdir = $mainframe->getCfg('absolute_path').'/administrator/tools/updiag/data/hashes/';

        require_once($mainframe->getCfg('absolute_path').'/administrator/includes/snoopy.class.php');
        $snoopy = new Snoopy;
        $snoopy->maxlength = 50000;
        $snoopy->maxredirs = 0;
        $snoopy->read_timeout =	15;
        $snoopy->timed_out = true;
        $snoopy->_fp_timeout = 15;

        $submit_url = $this->fetchURL('hashes');
        $submit_vars['ELXISVERSION'] = $this->iversion;

        $snoopy->submit($submit_url, $submit_vars);
        $sn_res = $snoopy->results;
        $sn_err = trim($snoopy->error);

        if ( $sn_err != '' ) {
            $this->errormsg = $sn_err;
        } else {
            if (preg_match('/ERR\:/',$sn_res)) {
                $x = preg_split('/[\:]/', $sn_res, -1);
                $errCode = intval($x[1]);
                switch ($errCode) {
                    case 1: $this->errormsg = $upLang->REMOTEERR1; break;
                    case 5: $this->errormsg = $upLang->REMOTEERR5; break;
                    case 6: $this->errormsg = $upLang->REMOTEERR6; break;
                    default: $this->errormsg = $upLang->UNERROR; break;
                }
            } else {
                $nhashes = explode(',', base64_decode($sn_res));
                if ($nhashes) {
                    foreach ($nhashes as $nhash) {
                        if ($fmanager->FileExt($nhash) == 'txt') {
                            array_push($rhashes, preg_replace('/(\.txt)$/', '', $nhash));
                        }
                    }
                }
            }
        }

        $rows = array();
        $q = 0;
        if (count($rhashes) > 0) {
            foreach ($rhashes as $rhash) {
                $rows[$q]['name'] = $rhash;                
                $rows[$q]['installed'] = (file_exists($hdir.$rhash.'.txt')) ? 1 : 0;
                $q++;
            }
        }
        return $rows;
    }


    /***************************************/
    /* DOWNLOAD A HASH FILE FROM ELXIS.ORG */
    /***************************************/
    public function downloadHash($hash='', $q=0) {
        global $mainframe, $upLang, $fmanager;

        $hdir = $mainframe->getCfg('absolute_path').'/administrator/tools/updiag/data/hashes/';

        if (!preg_match('/^[0-9]{4}[\.][0-9]{1,2}/', $hash)) {
            echo $upLang->REMOTEERR1;
            exit();
        }
        if (file_exists($hdir.$hash.'.txt')) {
            echo $upLang->REQFEXISTS;
            exit();
        }

        $t1 =  $this->microtime_float();
        require_once($mainframe->getCfg('absolute_path').'/administrator/includes/snoopy.class.php');
        $snoopy = new Snoopy;
        $snoopy->maxlength = 400000;
        $snoopy->maxredirs = 0;
        $snoopy->read_timeout =	20;
        $snoopy->timed_out = true;
        $snoopy->_fp_timeout = 20;
        $fetch_url = $this->fetchURL('hashdir').$hash.'.txt';

        $snoopy->fetch($fetch_url);
        $sn_res = $snoopy->results;
        $sn_err = trim($snoopy->error);
        if ( $sn_err != '' ) {
            echo $sn_err;
            exit();
        }
        if (strlen($sn_res) < 10000) {
            echo $upLang->REMOTEERR7;
            exit();
        }

        $t2 =  $this->microtime_float();
        $dtime = $this->downloadTime($t1, $t2);

        $fmanager->spChmod($hdir, '0777');
        if ($fmanager->createFile($hdir.$hash.'.txt', $sn_res)) {
            $fmanager->spChmod($hdir.$hash.'.txt', '0666');

            $dsize = $this->calculateSize($hdir.$hash.'.txt');
            $size= intval(filesize($hdir.$hash.'.txt'));
            echo "<b>".$upLang->FILDOWNSUC."</b><br />\n";
            echo $upLang->SIZE.': <b>'.$dsize.'</b>, '.$upLang->DOWNLTIME.': <b>'.$dtime.'</b>';
            if ($speed = $this->calculateSpead($size, $t1, $t2)) {
                echo ', '.$upLang->DOWNLSPEED.': <b>'.$speed.'</b>';
            }
        } else {
            echo '<b>'.$upLang->CNOTCPDFIL.'</b><br />'.$upLang->PLCHSCRPERM2;
        }
        exit();
    }


    /**********************/
    /* EXECUTE HASH CHECK */
    /**********************/
    public function hashCheck($hash) {
        global $upLang, $mainframe, $adminLanguage;

        $hdir = $mainframe->getCfg('absolute_path').'/administrator/tools/updiag/data/hashes/';

        if (!preg_match('/^[0-9]{4}[\.][0-9]{1,2}/', $hash)) {
            echo '<br /><b>'.$upLang->INVHFILE.'</b><br />';
            return;
            exit();
        }
        $hashv = preg_split('/[\_]/', $hash, -1);
        if ($hashv[0] < $this->iversion) {
            echo '<br /><b>'.$upLang->SHFELXVER.'</b><br />';
            return;
            exit();
        }
        if (!file_exists($hdir.$hash.'.txt')) {
            echo '<br /><b>'.$upLang->INVHFILE.'</b><br />';
            return;
            exit();
        }

        @clearstatcache();

        $orig = array();
        $orig_c = @file($hdir.$hash.'.txt');
        for($i=2,$n=count($orig_c);$i<$n;$i++){
            $line = explode("\t", $orig_c[$i]);
            $orig[] = array($line[0], trim($line[1]), trim($line[2]));
        }
        $found = 0;

        printf('<h2>'.$upLang->CHFINUS.'</h2>', $hash);

        $repl = array('/[\r\n]/','/[\n]/');
	    for($i=0,$n=count($orig);$i<$n;$i++){
            $file = $orig[$i];
            if(!file_exists($mainframe->getCfg('absolute_path').'/'.$file[0])) {
                $found++;
    	  	    if($found=='1') {
                    echo "<table class=\"adminlist\"><tr><th>".$adminLanguage->A_ERROR."</th>\n";
                    echo "<th>".$adminLanguage->A_FILE."</th>\n<th>".$adminLanguage->A_DETAILS."</th></tr>\n";
    	  	    }
                echo "<tr><td class=\"hasherror\" width=\"90\">".$adminLanguage->A_ERROR."</td>\n";
                echo "<td>".$file[0]."</td>\n<td>".$upLang->FNOTEXIST."</td></tr>\n";
            } else if(md5_file($mainframe->getCfg('absolute_path').'/'.$file[0]) != $file[1]) {
                $data = @file_get_contents($mainframe->getCfg('absolute_path').'/'.$file[0]);
                if (md5(preg_replace($repl, '', $data)) != $file[2]) {
                    $found++;
                    if($found=='1') {
                        echo "<table class=\"adminlist\"><tr><th>".$adminLanguage->A_ERROR."</th>\n";
                        echo "<th>".$adminLanguage->A_FILE."</th>\n<th>".$adminLanguage->A_DETAILS."</th></tr>\n";
                    }
                    echo "<tr><td class=\"hashwarning\" width=\"90\">".$upLang->WARNING."</td>\n";
                    echo "<td>".$file[0]."</td><td>".$upLang->FNEEDUP."</td></tr>\n";
                }
            }
        }

        if ($found == '0') {
            echo "<br><br><div align=\"center\"><font color=\"green\" size=\"4\"><b>".$upLang->SITUP2D."</b></font></div><br>\n";
        } else {
            echo "</table><br />\n";
            echo "<br><br><div align=\"center\" class=\"hasherror\">".$upLang->FOUND." <font size=\"4\">".$found."</font> ".$upLang->OUTFUP."</div><br>\n";
        }
    }


    /********************/
    /* GET NEW RELEASES */
    /********************/
    public function releases() {
        global $mainframe, $alang, $upLang;

		if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
		$xmldata = $this->readremotefile($this->fetchURL('releases'), 1);
		if (!$xmldata || ($xmldata == '')) {
		    $this->errormsg = $upLang->CNOTGETELXD;
            return false;
		}
		
		$xmlDoc = simplexml_load_string($xmldata, 'SimpleXMLElement');
		if (!$xmlDoc) {
		    $this->errormsg = $upLang->CNOTGETELXD;
            return false;
		}
		unset($xmldata);
		if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
			if ($xmlDoc->getName() != 'elxiscms') {
		    	$this->errormsg = $upLang->INVXML;
            	return false;
			}
		}


        $rows = array();
        $q = 0;
        $items = $xmlDoc->children();
		if ($items) {
			foreach ($items as $item) {
                $rows[$q]['type'] = isset($item->type) ? (string)$item->type : '';
                $rows[$q]['version'] = isset($item->version) ? (string)$item->version : '';
                $rows[$q]['date'] = isset($item->date) ? (string)$item->date : '';
                $rows[$q]['title'] = isset($item->title) ? (string)$item->title : '';
                $rows[$q]['more'] = isset($item->more) ? (string)$item->more : '';
                $rows[$q]['link'] = isset($item->link) ? (string)$item->link : '';
                $rows[$q]['buy'] = isset($item->buy) ? (string)$item->buy : '';
                $rows[$q]['license'] = isset($item->license) ? (string)$item->license : '';
                $rows[$q]['author'] = isset($item->author) ? (string)$item->author : '';
                $rows[$q]['price'] = isset($item->price) ? (string)$item->price : '';
                
				if (isset($item->description)) {
					$descs = $item->description->children();
					if ($descs) {
                		$mydesc = '';
                		$engdesc = '';
                		foreach($descs as $dlang => $desc) {
                    		if ($dlang == $alang) {
                        		$mydesc = (string)$desc;
							} elseif ($dlang == 'english') {
                        		$engdesc = (string)$desc;
                    		}
                		}
                		$rows[$q]['description'] = ($mydesc != '') ? $mydesc : $engdesc;
					} else {
						$rows[$q]['description'] = (string)$item->description;
					}
				} else {
					$rows[$q]['description'] = '';
				}
				$q++;
			}
		}
        return $rows;
    }


	/*********************************/
	/* DISPLAY ELXIS INFO USING AJAX */
	/*********************************/
	public function elxisInfo() {
		global $_VERSION, $adminLanguage, $mainframe, $upLang;
		
		$ver = $_VERSION->PRODUCT .' '. $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL .' '
		. $_VERSION->DEV_STATUS.' rev'. $_VERSION->DEV_REVISION
		.' [ '.$_VERSION->CODENAME .' ] '. $_VERSION->RELDATE .' '
		. $_VERSION->RELTIME .' '. $_VERSION->RELTZ;
		echo '<b>'.$adminLanguage->A_VERSION.':</b> '.$ver.'<br />';
		echo '<b>'.$upLang->INSTPATH.':</b> '.$mainframe->getCfg('absolute_path');
		exit();
	}


	/*******************************/
	/* DISPLAY PHP INFO USING AJAX */
	/*******************************/
	public function phpInfo() {
		global $adminLanguage;
		echo '<b>'.$adminLanguage->A_COMP_ADMIN_PHP_VERSION.'</b> '.phpversion().' ('.php_sapi_name().')';
		exit();
	}


	/************************************/
	/* DISPLAY DATABASE INFO USING AJAX */
	/************************************/
	public function dbInfo() {
		global $adminLanguage, $mosConfig_dbtype, $database;
		$dbi = $mosConfig_dbtype.' ';
		$v = $database->_resource->ServerInfo();
		$dbi .= $v['description'];
        $dbi .= ' ('.$adminLanguage->A_VERSION.': '.$v['version'].')';
		echo '<b>'.$adminLanguage->A_COMP_ADMIN_DB.'</b> '.$dbi;
		exit();
	}


	/**********************************/
	/* DISPLAY SYSTEM INFO USING AJAX */
	/**********************************/
	public function sysInfo() {
		global $adminLanguage;
		echo '<b>'.$adminLanguage->A_COMP_ADMIN_PHP_BUILT_ON.'</b> '.php_uname();
		exit();
	}


	/*************************************/
	/* DISPLAY UPDIAG CREDITS USING AJAX */
	/*************************************/
	public function viewCredits() {
		global $adminLanguage, $upLang, $alang;
		
		$fla = ($alang == 'greek') ? '_greek' : '';
		echo '<b>'.$adminLanguage->A_VERSION.':</b> UpDiag 2009.2<br />';
		echo '<b>'.$adminLanguage->A_DATE.':</b> '.mosFormatDate('2010-03-28 15:01:30', _GEM_DATE_FORMLC).'<br />';
		echo '<b>'.$adminLanguage->A_AUTHOR.':</b> Ioannis Sannos (aka DataHell)<br />';
		echo '<b>'.$adminLanguage->A_EMAIL.':</b> <a href="mailto:datahell@elxis.org" title="Mail Ioannis Sannos">datahell@elxis.org</a><br />';
		echo '<b>'.$upLang->LICENSE.':</b> GNU/LGPL (<a href="http://www.gnu.org/copyleft/lgpl.html" target="_blank">http://www.gnu.org/copyleft/lgpl.html</a>)<br />';
		echo '<b>Copyright:</b> &copy; 2006-'.date('Y').' <a href="http://www.elxis.org" target="_blank" title="Elxis.org">Elxis.org</a>. All rights reserved.<br />';
		exit();
	}


	/**************************************/
	/* DISPLAY SECURITY ALERTS USING AJAX */
	/**************************************/
	public function checkSecurity() {
		global $mainframe, $upLang;

        $num = 0;
		$warnings = array();
		$alerts = array();

		if ($mainframe->_config->user == 'root') {
		  	array_push($alerts, 'You are connecting to the database using the root account');
		  	$num++;
		}
		if ($mainframe->_config->error_reporting) {
			array_push($warnings, 'Elxis error reporting is set to ON');
			$num++;
		}
		if ($mainframe->_config->allowUserRegistration) {
            if (!$mainframe->_config->useractivation) {
                array_push($warnings, 'User activation is disabled');
                $num++;
		    }
            if (!$mainframe->_config->uniquemail) {
                array_push($warnings, 'Different users can have the same e-mail address');
                $num++;
            }
		}
		if (!$mainframe->_config->captcha) {
			array_push($alerts, 'Elxis security images (captcha) are disabled');
			$num++;
		}
        if (!$this->strongpass($mainframe->_config->password)) {
			array_push($warnings, 'Your database password is weak');
			$num++;
        }
        if ($mainframe->_config->ftp) {
            if (!$this->strongpass($mainframe->_config->ftp_pass)) {
                array_push($warnings, 'Your FTP password is weak');
                $num++;
            }
        }

        $fblock = $mainframe->getCfg('absolute_path').'/administrator/tools/floodblocker/config.php';
        if (!file_exists($fblock)) {
            array_push($warnings, 'Elxis FloodBlocker does not exist');
            $num++;
        } else {
            @include($fblock);
            if (!$fconf_enabled) {
                array_push($warnings, 'Elxis FloodBlocker is disabled');
                $num++;
            }
        }

        $defend = $mainframe->getCfg('absolute_path').'/administrator/tools/defender/config.php';
        if (!file_exists($defend)) {
            array_push($warnings, 'Elxis Defender does not exist');
            $num++;
        } else {
            @include($defend);
            if (!$dconf_enabled) {
                array_push($warnings, 'Elxis Defender is disabled');
                $num++;
            }
        }
		$df = ini_get('disable_functions');
		if ($df && ($df != '')) {
		    $diss = array('/system/', '/exec/', '/passthru/', '/shell_exec/');
		    foreach ($diss as $dis) {
                if (!preg_match($dis, $df)) {
                    array_push($alerts, 'PHP function '.$dis.' is enabled');
                    $num++;	                
                }
		    }
		} else {
            array_push($alerts, 'PHP functions system, exec, passthru, shell_exec are enabled');
            $num++;
		}

        if ($num > 0) {
            printf($upLang->FSECALWA, $num);
            echo "<br /><br />\n";
            if (count($alerts)>0) {
                foreach ($alerts as $alert) {
                    echo '<img src="tools/updiag/images/alert.gif" alt="'.$upLang->ALERT.'" title="'.$upLang->ALERT.'" border="0" /> '.$alert."<br />\n";
                }
            }
            if (count($warnings)>0) {
                foreach ($warnings as $warning) {
                    echo '<img src="tools/updiag/images/warning.gif" alt="'.$upLang->WARNING.'" title="'.$upLang->WARNING.'" border="0" /> '.$warning."<br />\n";
                }
            }
            echo "<br /><img src=\"tools/updiag/images/alert.gif\" alt=\"".$upLang->ALERT."\" /> ".$upLang->ALERT;
            echo " <img src=\"tools/updiag/images/warning.gif\" alt=\"".$upLang->WARNING."\" /> ".$upLang->WARNING."<br />\n";
        } else {
            echo '<img src="tools/updiag/images/passed.png" alt=\"pass\" border="0" /> '.$upLang->ELXINPAS."<br />\n";
        }
	}
	

    /**********************************/
    /* CHECKS IF A PASSWORD IS STRONG */
    /**********************************/
    function strongpass($password='') {
        $strlen = strlen($password);
        if($strlen <= 5) { return false; }
        $count_chars = @count_chars($password, 3);
        if (strlen($count_chars) < $strlen/2) { return false; }
        $uPass = strtoupper($password);
        if ($uPass == $password) { return false; }
        return true;
    }


    /*****************************/
    /* RETURNS A FLOAT MICROTIME */
    /*****************************/
    function microtime_float() {
        return array_sum(explode(' ',microtime()));
    }


    /****************************/
    /* DOWNLOAD TIME CALCULATOR */
    /*****************************/
    function downloadTime($start=0, $end=0) {
        $dt = $end-$start;
        if ($dt > 0.01) {
            $dt = round($dt, 2);
            $dt .= ' sec';
        } elseif ($dt > 0.0001) {
            $dt = ($dt*1000);
            $dt = round($dt, 2);
            $dt .= ' msec';
        } else {
            $dt = ($dt*1000000);
            $dt = round($dt, 2);
            $dt .= ' &micro;sec';
        }
        return $dt;
    }


    /***********************/    
    /* CALCULATE FILE SIZE */
    /***********************/
    function calculateSize($file='') {
        if (!file_exists($file)) { return ''; }
        $bsize = filesize($file);
        $out = '';
        if ($bsize < 100) {
            $bsize = round($bsize, 2);
            $out = $bsize.' bytes';
        } elseif ($bsize < 900000) {
            $bsize = ($bsize/1000);
            $bsize = round($bsize, 2);
            $out = $bsize.' KB';
        } else {
            $bsize = ($bsize/1000000);
            $bsize = round($bsize, 2);
            $out = $bsize.' MB';
        }
        return $out;
    }


    /****************************/
    /* CALCULATE DOWNLOAD SPEED */
    /****************************/
    function calculateSpead($size, $start=0, $end=0) {
        $dt = $end-$start;
        if (($dt <= 0) || ($size==0)) { return false; }
        $spead = $size/$dt;
        $spead = round(($spead/1000), 2).' KB/sec';
        return $spead;
    }


    /*********************/
    /* GET ELXIS.ORG URL */
    /*********************/
    function fetchURL($type='currentversion') {
        switch ($type) {
            case 'currentversion';
            return 'http://www.elxis.org/update/elxiscurrent.xml';
            break;
            case 'connection':
            return 'http://www.elxis.org';
            break;
            case 'patches':
            return 'http://www.elxis.org/update/elxispatches.xml';
            break;
            case 'releases':
            return 'http://www.elxis.org/update/newreleases.xml';
            break;
            case 'scripts':
            return 'http://www.elxis.org/update/scripts.php';
            break;
            case 'hashes':
            return 'http://www.elxis.org/update/hashes.php';
            break;
            case 'hashdir':
            return 'http://www.elxis.org/update/hashes/';
            break;
        }
    }


	/***************************************/
	/* FETCH THE CONTENTS OF A REMOTE FILE */
	/***************************************/
	private function readremotefile($url, $isxml=0) {
		global $fmanager;

		if ($this->error) { return; }
		if (function_exists('curl_init') && is_callable('curl_init') && function_exists('curl_exec')  && is_callable('curl_exec')) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
			$data = curl_exec($ch);
			curl_close($ch);
		} else {
			$parsedurl = parse_url($url);
			$fp = @fsockopen($parsedurl['host'], 80, $errno, $errstr, 20);
			if (!$fp) { return false; }
			$out = 'GET '.$parsedurl['path']." HTTP/1.1\r\n";
    		$out .= 'Host: '.$parsedurl['host']."\r\n";
    		$out .= "Connection: Close\r\n\r\n";
    		fwrite($fp, $out);
    		$data = '';
    		$iniget = ($isxml == 1) ? 0 : 1;
    		while (!feof($fp)) {
    			$buffer = fgets($fp, 2048);
				if ($iniget == 0) {
    				if (preg_match('/(\<\?xml)/', $buffer)) { $iniget = 1; }
    			}
    			if ($iniget) { $data .= $buffer; }
    		}
    		fclose($fp);
		}

		return $data;
	}

}

?>