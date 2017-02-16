<?php 
/**
* @version: $Id: edcbrowser.php 54 2010-06-12 21:05:09Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


class edcbrowser {

	public $element = '';
	public $client = '';
	private $task = 'init';
	private $xmlfile = '';
	private $edcxml = 'http://www.elxis-downloads.com/edc.xml';
	private $error = 0;
	private $erromsg = '';
	private $installimg = '';
	private $downloadimg = '';
	public $edctype = '';


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct($element='', $client='') {
		global $mainframe;

		$this->element = trim($element);
		$this->client = trim($client);
		if ($this->element == '') { $this->detectelement(); }
		if ($this->client == '') { $this->detectclient(); }
		$this->xmlfile = $mainframe->getCfg('absolute_path').'/cache/edc.xml';
		$this->installimg = $mainframe->getCfg('live_site').'/includes/js/ThemeOffice/install.png';
		$this->downloadimg = $mainframe->getCfg('live_site').'/includes/js/ThemeOffice/backup.png';
		$this->setedctype();
	}


	/**************************/
	/* SET EDC EXTENSION TYPE */
	/**************************/
	private function setedctype() {
		switch($this->element) {
			case 'module':
				$this->edctype = 'module';
			break;
			case 'component':
				$this->edctype = 'component';
			break;
			case 'mambot':
				$this->edctype = 'bot';
			break;
			case 'bridge':
				$this->edctype = 'bridge';
			break;
			case 'template':
				if ($this->client == 'admin') {
					$this->edctype = 'back-end template';
				} elseif ($this->client == 'login') {
					$this->edctype = 'login screen';
				} else {
					$this->edctype = 'front-end template';
				}
			break;
			case 'language':
				if ($this->client == 'admin') {
					$this->edctype = 'back-end language';
				} else {
					$this->edctype = 'front-end language';
				}
			break;
			default:
			break;
		}
	}


	/****************************************/
	/* AUTO DETECT EXTENSION TYPE (ELEMENT) */
	/****************************************/
	private function detectelement() {
		if (isset($_POST['element']) && ($_POST['element'] != '')) {
			$this->element = htmlspecialchars(trim($_POST['element']));
		} elseif (isset($_GET['element']) && ($_GET['element'] != '')) {
			$this->element = htmlspecialchars(trim($_GET['element']));
		}
	}


	/**********************/
	/* AUTO DETECT CLIENT */
	/**********************/
	private function detectclient() {
		if (isset($_POST['client']) && ($_POST['client'] != '')) {
			$this->client = htmlspecialchars(trim($_POST['client']));
		} elseif (isset($_GET['client']) && ($_GET['client'] != '')) {
			$this->client = htmlspecialchars(trim($_GET['client']));
		}
		if (($this->client != '') && (!in_array($this->client, array('administrator', 'admin', 'login')))) {
			$this->client = '';
		}
	}


	/*************************/
	/* EXECUTE EDC INSTALLER */
	/*************************/
	public function run($task='init') {
		global $option;

		$this->task = $task;
		if ($this->error) {
			if ($this->task != 'updates') { echo $this->errormsg; }
			return false;
		}
		switch ($this->task) {
			case 'listpackages':
				$this->listpackages();
			break;
			case 'installfromedc':
				$pack = $this->fetchpackage();
				if (!$pack) {
					mosRedirect('index2.php?option='.$option.'&element='.$this->element.'&client='.$this->client, 'Could not download requested package!');
				}
				$unzipped = $this->unzippackage($pack);
				if (!$unzipped) {
					mosRedirect('index2.php?option='.$option.'&element='.$this->element.'&client='.$this->client, 'Could not extract downloaded package!');
				}
				$pack = $this->fixdir($pack);
				mosRedirect('index2.php?option='.$option.'&task=installfromdir2&element='.$this->element.'&client='.$this->client.'&packdir='.base64_encode($pack));
			break;
			case 'updates':
				return $this->getUpdates();
			break;
			case 'init': 
			default:
				$this->showstart();
			break;
		}
	}


	/*******************************************/
	/* FIX PACK IF XML FILE IS IN A SUB-FOLDER */
	/*******************************************/
	private function fixdir($pack) {
		global $fmanager, $mainframe;

		$extractdir = $mainframe->getCfg('absolute_path').'/tmpr/'.$pack.'/';
		$filesindir = $fmanager->listFiles($extractdir);
        if (count($filesindir) == 0) {
            $dirsindir = $fmanager->listFolders($extractdir, '');
            if (count($dirsindir) == 1) {
                $filesindir2 = $fmanager->listFiles($extractdir.$dirsindir[0].'/', '.xml');
                if (count($filesindir2) > 0) {
                    $pack = $pack.'/'.$dirsindir[0];
                } else {
                    $dirsindir2 = $fmanager->listFolders($extractdir.$dirsindir[0].'/', '');
                    if (count( $dirsindir2 ) == 1) {
                        $pack = $pack.'/'.$dirsindir[0].'/'.$dirsindir2[0];
                    }
                }
            }
        }
        return $pack;
    }


	/*************************/
	/* EDC BROWSER INIT HTML */
	/*************************/
	private function showstart() {
		global $mainframe, $adminLanguage;
?>
		<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/components/com_installer/installer.js"></script>
		<table class="adminheading">
		<tr>
			<th class="install"><?php echo $adminLanguage->A_INST_DOINEDC; ?></th>
		</tr>
		<tr>
			<td>
			<a href="javascript:void(null);" onclick="loadpackages('<?php echo $this->element; ?>', '<?php echo $this->client; ?>');" style="font-size: 11px;">
				<?php echo $adminLanguage->A_INST_FETCHAVEXTS; ?>
			</a> &nbsp; | &nbsp; 
			<a href="javascript:void(null);" onclick="clearpackages();" style="font-size: 11px;">
				<?php echo $adminLanguage->A_INST_UNLOAD; ?>
			</a>
			</td>
		</tr>
		</table><br />
<?php 
	if ($this->element == 'component' || $this->element == 'module' || $this->element == 'mambot') {		
?>
		<script type="text/javascript">
		/* <![CDATA[ */
		function edcuninstall(extid, exttitle) {
			document.getElementById('edcuncid').value = parseInt(extid);
			if (document.getElementById('edcuncid').value == 0) {
				alert('<?php echo $adminLanguage->A_ALERT_SELECT_DELETE; ?>');
			} else if (confirm('<?php echo $adminLanguage->A_ALERT_CONFIRM_DELETE; ?>\n'+exttitle)){
				document.edcunform.task.value='remove';
				try {
					document.edcunform.onsubmit();
				}
				catch(e){}
				document.edcunform.submit();
			}
		}
		/* ]]> */
		</script>
		<form action="index2.php" method="post" name="edcunform" style="margin:0; padding: 0;">
        <input type="hidden" name="cid[]" id="edcuncid" value="0" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="option" value="com_installer" />
		<input type="hidden" name="element" value="<?php echo $this->element; ?>" />
		</form>
<?php 
		}
?>
		<div id="edclist" style="display: none;"></div>
		<br />
<?php 
	}


	/***************************/
	/* LIST PACKAGES PROCEDURE */
	/***************************/
	private function listpackages() {
		$reload = 0;
		if (file_exists($this->xmlfile)) {
			$t = filemtime($this->xmlfile);
			if ((time() - $t) > 14400) { $reload = 1; } //fetch extensions from EDC once every 4 hours
		} else {
			$reload = 1;
		}
		if ($reload) { $this->fetchxml(); }
		$rows = $this->loadpackages();
		$this->showpackages($rows);
	}


	/******************************************/
	/* CHECK INSTALLED PACKAGES UPDATE STATUS */
	/******************************************/
	private function getUpdates() {
		if (!in_array($this->element, array('module', 'component', 'mambot'))) {
			$this->error = 1;
			$this->errormsg = 'Updates check for extensions of type <strong>'.$this->element.'</strong> is not supported.';
			return false;
		}

		$reload = 0;
		if (file_exists($this->xmlfile)) {
			$t = filemtime($this->xmlfile);
			if ((time() - $t) > 14400) { $reload = 1; } //fetch extensions from EDC once every 4 hours
		} else {
			$reload = 1;
		}
		if ($reload) { $this->fetchxml(); }
		$rows = $this->loadupdates();
		return $rows;
	}


	/*****************************************/
	/* DOWNLOAD EXTENSIONS LIST XML FROM EDC */
	/*****************************************/
	private function fetchxml() {
		global $fmanager;

		if ($this->error) { return; }
		if (function_exists('curl_init') && is_callable('curl_init') && function_exists('curl_exec')  && is_callable('curl_exec')) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->edcxml);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
			$xmldata = curl_exec($ch);
			curl_close($ch);
		} else {
			$parsedurl = parse_url($this->edcxml);
			$fp = @fsockopen($parsedurl['host'], 80, $errno, $errstr, 20);
			if (!$fp) {
				$this->error = 1;
				$this->errormsg = 'Could not load XML file from EDC';
				return;
			}
			$out = 'GET '.$parsedurl['path']." HTTP/1.1\r\n";
    		$out .= 'Host: '.$parsedurl['host']."\r\n";
    		$out .= "Connection: Close\r\n\r\n";
    		fwrite($fp, $out);
    		$xmldata = '';
    		$iniget = 0;
    		while (!feof($fp)) {
    			$buffer = fgets($fp, 2048);
				if ($iniget == 0) {
    				if (preg_match('/(\<\?xml)/', $buffer)) { $iniget = 1; }
    			}
    			if ($iniget) { $xmldata .= $buffer; }
    		}
    		fclose($fp);
		}

		if (!$xmldata || $xmldata == '') {
			if (file_exists($this->xmlfile)) { return; } //use the old one
			$this->error = 1;
			$this->errormsg = 'Could not load XML file from EDC';
			return;
		}

		$ok = $fmanager->writeFile($this->xmlfile, $xmldata);
		if (!$ok) {
			if (file_exists($this->xmlfile)) { return; } //use the old one
			$this->error = 1;
			$this->errormsg = 'Could not save XML data in folder cache';
		}
		return $ok;
	}


	/*****************************************/
	/* LOAD LIST OF EXTENSIONS FROM XML FILE */
	/*****************************************/
	private function loadpackages() {
		global $adminLanguage;

		if ($this->error) { return false; }
		if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
		$xmlDoc = simplexml_load_file($this->xmlfile, 'SimpleXMLElement');
		if (!$xmlDoc) {
			$this->error = 1;
			$this->errormsg = 'Could not load cached XML file';
			return;
		}
		if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
			if ($xmlDoc->getName() != 'elxisdc') {
				$this->error = 1;
				$this->errormsg = 'Invalid xml file detected in cache folder';
				return;
			}
		}

        $rows = array();
        $q = 0;
        if ($xmlDoc->children()) {
        	foreach ($xmlDoc->children() as $package) {
        		if (!isset($package->type) || (strtolower(trim($package->type)) != $this->edctype)) { continue; }
				$rows[$q]['id'] = isset($package->id) ? (int)$package->id : 0;
				$rows[$q]['title'] = isset($package->title) ? (string)$package->title : $adminLanguage->A_UNKNOWN;
				$rows[$q]['category'] = isset($package->category) ? (string)$package->category : $adminLanguage->A_UNKNOWN;
				$rows[$q]['extension'] = isset($package->extension) ? (string)$package->extension : '';
				$rows[$q]['image'] = isset($package->image) ? (string)$package->image : '';
				$rows[$q]['version'] = isset($package->version) ? (string)$package->version : '0';
				$rows[$q]['license'] = isset($package->license) ? (string)$package->license : $adminLanguage->A_UNKNOWN;
				$rows[$q]['url'] = isset($package->url) ? (string)$package->url : '';
				$rows[$q]['downloadlink'] = isset($package->downloadlink) ? (string)$package->downloadlink : '';
				$rows[$q]['compatibility'] = isset($package->compatibility) ? (string)$package->compatibility :	$adminLanguage->A_UNKNOWN;
				$rows[$q]['size'] = isset($package->size) ? (string)$package->size : '0';
				$rows[$q]['hits'] = isset($package->hits) ? (int)$package->hits : 0;
				$rows[$q]['downloads'] = isset($package->downloads) ? (int)$package->downloads : 0;
				$rows[$q]['author'] = isset($package->author) ? (string)$package->author : $adminLanguage->A_UNKNOWN;
				$rows[$q]['timeadded'] = isset($package->timeadded) ? (string)$package->timeadded : '0';
				$rows[$q]['lastmod'] = isset($package->lastmod) ? (string)$package->lastmod : '0';
				$q++;
            }
        }
		return $rows;
	}


	/***********************************/
	/* CHECK IF EXTENSION IS INSTALLED */
	/***********************************/
	private function isInstalled($extension='') {
		global $mainframe;

		if ($extension == '') { return false; }
		switch($this->edctype) {
			case 'module':
				if (file_exists($mainframe->getCfg('absolute_path').'/modules/'.$extension.'.xml')) {
					return true;
				} else if (file_exists($mainframe->getCfg('absolute_path').'/administrator/modules/'.$extension.'.xml')) {
					return true;
				}
				return false;
			break;
			case 'component':
				$cname = preg_replace('/^(com\_)/', '', $extension);
				if (file_exists($mainframe->getCfg('absolute_path').'/administrator/components/'.$extension.'/'.$cname.'.xml')) {
					return true;
				}
				return false;
			break;
			case 'mambot':
				if (file_exists($mainframe->getCfg('absolute_path').'/mambots/content/'.$extension.'.xml')) {
					return true;
				} else if (file_exists($mainframe->getCfg('absolute_path').'/mambots/search/'.$extension.'.xml')) {
					return true;
				} else if (file_exists($mainframe->getCfg('absolute_path').'/mambots/editors/'.$extension.'.xml')) {
					return true;
				} else if (file_exists($mainframe->getCfg('absolute_path').'/mambots/editors-xtd/'.$extension.'.xml')) {
					return true;
				} else {
					return false;
				}
			break;
			case 'bridge':
				return false;
			break;
			case 'back-end template':
				if (file_exists($mainframe->getCfg('absolute_path').'/administrator/templates/admin/'.$extension.'/templateDetails.xml')) {
					return true;
				} else {
					return false;
				}
			break;
			case 'front-end template':
				if (file_exists($mainframe->getCfg('absolute_path').'/templates/'.$extension.'/templateDetails.xml')) {
					return true;
				} else {
					return false;
				}
			break;
			case 'login screen':
				if (file_exists($mainframe->getCfg('absolute_path').'/administrator/templates/login/'.$extension.'/templateDetails.xml')) {
					return true;
				} else {
					return false;
				}
			break;
			case 'front-end language':
				if (file_exists($mainframe->getCfg('absolute_path').'/language/'.$extension.'/'.$extension.'.xml')) {
					return true;
				} else {
					return false;
				}
			break;
			case 'back-end language':
				if (file_exists($mainframe->getCfg('absolute_path').'/administrator/language/'.$extension.'/'.$extension.'.xml')) {
					return true;
				} else {
					return false;
				}
			break;
		}
		return false;
	}


	/******************************/
	/* GET EXTENSION'S ID FROM DB */
	/******************************/
	private function extensionid($extension) {
		global $database;

		if ($this->element == 'module') {
			$database->setQuery("SELECT id FROM #__modules WHERE module = '".$extension."' AND iscore='0'", '#__', 1, 0);
			$id = (int)$database->loadResult();
			return $id;
		}
		if ($this->element == 'component') {
			$database->setQuery("SELECT id FROM #__components WHERE `option` = '".$extension."'", '#__', 1, 0);
			$id = (int)$database->loadResult();
			return $id;
		}
		if ($this->element == 'mambot') {
			$database->setQuery("SELECT id FROM #__mambots WHERE element='".$extension."'", '#__', 1, 0);
			$id = (int)$database->loadResult();
			return $id;
		}
		return 0;
	}


	/****************************************/
	/* DISPLAY LIST OF AVAILABLE EXTENSIONS */
	/****************************************/
	private function showpackages($rows) {
		global $adminLanguage, $fmanager, $mainframe;

		if (!$rows) { echo '<p>There are no available extensions of this type on Elxis Downloads Center.</p>'; return; }
		$align = _GEM_RTL ? 'right' : 'left';
		$txtdir = _GEM_RTL ? ' dir="rtl"' : '';
?>
		<table class="adminlist">
		<tr>
			<th width="60"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="60">&nbsp;</th>
			<th class="title"><?php echo $adminLanguage->A_TITLE; ?></th>
			<th class="title"><?php echo $adminLanguage->A_CATEGORY; ?></th>
			<th><?php echo $adminLanguage->A_VERSION; ?></th>
			<th class="title"><?php echo $adminLanguage->A_HITS; ?></th>
			<th class="title"><?php echo $adminLanguage->A_INST_DOWNLOADS; ?></th>
			<th class="title"><?php echo $adminLanguage->A_INST_SIZE; ?></th>
			<th class="title"><?php echo $adminLanguage->A_DATE; ?></th>
			<th class="title"><?php echo $adminLanguage->A_INST_DOWNLOAD.'/'.$adminLanguage->A_CMP_INS_DOIN; ?></th>
		</tr>
<?php 
		$k = 0;
		$n = 1;
		foreach ($rows as $key => $row) {
			$installed = ($row['extension'] != '') ? $this->isInstalled($row['extension']) : false;
			$extid = ($installed) ? $this->extensionid($row['extension']) : 0;
?>
		<tr class="row<?php echo $k; ?>">
			<td align="center">
<?php 
			if ($installed) {
				echo '<span style="font-size: 32px; color: green; font-weight: normal;">'.sprintf("%02d",$n)."</span><br />\n";
				echo '<span style="font-size:12px; color: #aaa;">installed</span>'."\n";
			} else {
				echo '<span style="font-size: 32px; color: #aaa; font-weight: normal;">'.sprintf("%02d",$n)."</span>\n";
			}
?>
			</td>
			<td width="60" align="center">
<?php 
			$img = trim($row['image']);
			if (preg_match('/^(http)/i', trim($row['url']))) {
				echo '<a href="'.trim($row['url']).'" title="'.$row['title'].' - EDC" target="_blank">';
			}
			if ($img != '') {
				if (in_array($fmanager->fileExt($img), array('jpg', 'jpeg', 'png', 'gif'))) {
					echo '<img src="'.$img.'" alt="image" width="50" height="50" style="padding: 2px; border: 1px solid #999;" />';
				} else {
					echo '<img src="'.$mainframe->getCfg('live_site').'/administrator/images/software.png" alt="image" width="50" height="50" style="padding: 2px; border: 1px solid #999;" />';
				}
			} else {
				echo '<img src="'.$mainframe->getCfg('live_site').'/administrator/images/software.png" alt="image" width="50" height="50" style="padding: 2px; border: 1px solid #999;" />';
			}
			if (preg_match('/^(http)/i', trim($row['url']))) { echo "</a>\n"; }
?>
			</td>
			<td valign="top">
<?php 
				if (preg_match('/^(http)/i', trim($row['url']))) {
					echo '<a href="'.trim($row['url']).'" title="'.$row['title'].' - EDC" target="_blank" style="font-weight: bold;">'.$row['title']."</a><br />\n";
				} else {
					echo '<strong>'.$row['title']."</strong><br />\n";
				}
				echo $adminLanguage->A_AUTHOR.': '.$row['author']."<br />\n";
				echo $adminLanguage->A_INST_LICENSE.': '.trim(htmlspecialchars($row['license']))."<br />\n";
				echo $adminLanguage->A_INST_COMPAT.': '.trim(htmlspecialchars($row['compatibility']))."\n";
?>
			</td>
			<td><?php echo $row['category']; ?></td>
			<td><?php echo $row['version']; ?></td>
			<td><?php echo intval($row['hits']); ?></td>
			<td><?php echo intval($row['downloads']); ?></td>
			<td><?php echo $row['size']; ?></td>
			<td>
			<?php 
			if (intval($row['lastmod']) > 10000) {
				echo eLOCALE::strftime_os('%a, %d %b %Y %H:%M', $row['lastmod'])."<br />\n";
			}
			 if (intval($row['timeadded']) > 10000) {
				echo '<span style="color: #777;">'.$adminLanguage->A_INST_DATESUB.':<br />';
				echo eLOCALE::strftime_os('%a, %d %b %Y %H:%M', $row['timeadded'])."</span>\n";
			}
			?>
			</td>
			<td align="center" style="text-align: center;">
<?php 
			if (preg_match('/^(http)/i', $row['downloadlink'])) {
				echo '<a href="'.$row['downloadlink'].'" title="'.$adminLanguage->A_INST_DOWNLOAD.'" target="_blank"><img src="'.$this->downloadimg.'" border="0" alt="'.$adminLanguage->A_INST_DOWNLOAD.'" /></a> &nbsp; '._LEND; 
				if (!$installed) {
					echo '<a href="javascript:void(null);" onclick="if (confirm(\''.sprintf($adminLanguage->A_INST_SUREINST, $row['title']).'\')){ document.location.href=\'index3.php?option=com_installer&task=installfromedc&element='.$this->element.'&client='.$this->client.'&id='.$row['id'].'\'; }" title="'.$adminLanguage->A_INST_DOWNINST.'"><img src="'.$this->installimg.'" border="0" alt="'.$adminLanguage->A_INST_DOWNINST.'" /></a> &nbsp; '._LEND;
				}
			}
			
			if ($installed) {
	    		if ($this->element == 'component' || $this->element == 'module' || $this->element == 'mambot') {
?>
					<a href="javascript:void(null);" onclick="edcuninstall(<?php echo $extid; ?>, '<?php echo $row['title']; ?>')" title="<?php echo $adminLanguage->A_CMP_INST_UNINSTALL; ?>">
						<img src="<?php echo $mainframe->getCfg('live_site'); ?>/includes/js/ThemeOffice/trash.png" border="0" alt="<?php echo $adminLanguage->A_CMP_INST_UNINSTALL; ?>" />
					</a>
<?php 
	    		}
	    	}
?>
			</td>
		</tr>
<?php 
			$k = 1 - $k;
			$n++;
		}
?>
		</table>
<?php 
	}


	/******************************/
	/* DOWNLOAD REQUESTED PACKAGE */
	/******************************/
	private function fetchpackage() {
        global $mainframe;

		$id = intval(mosGetParam($_REQUEST, 'id', 0));
		if ($id < 1) { return false; }
		$zipname = $id.'-'.time();

		$remotefile = 'http://www.elxis-downloads.com/downloads/download.html?id='.$id;
		$zippack = $mainframe->getCfg('absolute_path').'/tmpr/'.$zipname.'.zip';

		$parsed = parse_url($remotefile);
		$fp = @fsockopen($parsed['host'], 80, $errno, $errstr, 30);
       	if (!$fp) { return false; }
		$out = "GET /downloads/download.html?id=".$id." HTTP/1.1\r\n";
		$out .= "Host: ".$parsed['host']."\r\n";
		$out .= "Connection: Close\r\n\r\n";
        $response = '';
        fwrite($fp, $out);
        while (!feof($fp)) { $response .= fread($fp, 1024); }
        fclose($fp);
		$http_response_header = array();
		if (stripos($response, "\r\n\r\n") !== false) {
			$hc = explode("\r\n\r\n", $response);
			$headers = explode("\r\n", $hc[0]);
            if (!is_array($headers)) { $headers = array(); }
			if ($headers) {
				foreach($headers as $key => $header) {
					$a = "";
                    $b = "";
                    if (stripos($header, ":") !== false) {
                       	list($a, $b) = explode(":", $header);
                       	$http_response_header[trim($a)] = trim($b);
                    }
                }
            }
			$output = end($hc);
        } elseif (stripos($response, "\r\n") !== false) {
			$headers = explode("\r\n",  $response);
			if (!is_array($headers)) { $headers = array(); }
            if ($headers) {
				foreach($headers as $key => $header){
                    if($key < (count($headers) - 1)) {
                        $a = "";
                        $b = "";
                        if (stripos($header, ":") !== false) {
                            list($a, $b) = explode(":", $header);
                            $http_response_header[trim($a)] = trim($b);
                        }
                    }
                }
            }
			$output = end($headers);
        } else {
			$output = $response;
		}

		$fw = @fopen($zippack, 'wb');
		if (!$fw) { return false; }
		fwrite($fw, $output);
		fclose($fw);
		chmod($zippack, 0666);
		return $zipname;
	}


	/****************************/
	/* UNZIP DOWNLOADED PACKAGE */
	/****************************/
	private function unzippackage($pack) {
        global $mainframe, $fmanager;

		$extractdir = $fmanager->PathName($mainframe->getCfg('absolute_path').SEP.'tmpr'.SEP.$pack);
		$archivename = $fmanager->PathName($mainframe->getCfg('absolute_path').'/tmpr/'.$pack.'.zip', false);

		require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pcl/pclzip.lib.php');
		require_once($mainframe->getCfg('absolute_path').'/administrator/includes/pcl/pclerror.lib.php');
		$zipfile = new PclZip($archivename);
		if ($fmanager->iswin) {
			define('OS_WINDOWS',1);
		} else {
			define('OS_WINDOWS',0);
		}

		$ret = $zipfile->extract(PCLZIP_OPT_PATH, $extractdir);
		if (!$ret) { return false; }
		$fmanager->deleteFile($mainframe->getCfg('absolute_path').'/tmpr/'.$pack.'.zip');
		return true;
	}


	/*********************************************************/
	/* RETURN AN ARRAY OF INSTALLED EXTENSIONS UPDATE STATUS */
	/*********************************************************/
	private function loadupdates() {
		global $adminLanguage;

		if ($this->error) { return false; }
		$extensions = $this->getExtensions();
		if (!$extensions) { return false; }

		if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
		$xmlDoc = simplexml_load_file($this->xmlfile, 'SimpleXMLElement');
		if (!$xmlDoc) {
			$this->error = 1;
			$this->errormsg = 'Could not load cached XML file';
			return;
		}
		if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
			if ($xmlDoc->getName() != 'elxisdc') {
				$this->error = 1;
				$this->errormsg = 'Invalid edc.xml file detected in cache folder. Please delete it and try again.';
				return;
			}
		}

        $rows = array();
        $total = count($extensions);
        $found = 0;
        $q = 0;
        if ($xmlDoc->children()) {
        	foreach ($xmlDoc->children() as $package) {
        		if ($found >= $total) { break; } //dont bother to check more
				if (!isset($package->type) || (strtolower(trim($package->type)) != $this->edctype)) { continue; }
				$extension = isset($package->extension) ? (string)$package->extension : '';
				if ($extension == '') { continue; }
				if (!isset($extensions[$extension])) { continue; }
				$found++;
				$installed_version = $extensions[$extension];

				$rows[$q]['id'] = isset($package->id) ? (int)$package->id : 0;
				$rows[$q]['title'] = isset($package->title) ? (string)$package->title : $adminLanguage->A_UNKNOWN;
				$rows[$q]['category'] = isset($package->category) ? (string)$package->category : $adminLanguage->A_UNKNOWN;
				$rows[$q]['extension'] = $extension;
				$rows[$q]['image'] = isset($package->image) ? (string)$package->image : '';
				$rows[$q]['version'] = isset($package->version) ? (string)$package->version : '0';
				$rows[$q]['install_version'] = $installed_version;
				$rows[$q]['license'] = isset($package->license) ? (string)$package->license : $adminLanguage->A_UNKNOWN;
				$rows[$q]['url'] = isset($package->url) ? (string)$package->url : '';
				$rows[$q]['downloadlink'] = isset($package->downloadlink) ? (string)$package->downloadlink : '';
				$rows[$q]['compatibility'] = isset($package->compatibility) ? (string)$package->compatibility :	$adminLanguage->A_UNKNOWN;
				$rows[$q]['size'] = isset($package->size) ? (string)$package->size : '0';
				$rows[$q]['hits'] = isset($package->hits) ? (int)$package->hits : 0;
				$rows[$q]['downloads'] = isset($package->downloads) ? (int)$package->downloads : 0;
				$rows[$q]['author'] = isset($package->author) ? (string)$package->author : $adminLanguage->A_UNKNOWN;
				$rows[$q]['timeadded'] = isset($package->timeadded) ? (string)$package->timeadded : '0';
				$rows[$q]['lastmod'] = isset($package->lastmod) ? (string)$package->lastmod : '0';
				$q++;
            }
        }
		return $rows;
	}


	/***********************************************************/
	/* GET INSTALLED THIRD PARTY EXTENSIONS AND THEIR VERSIONS */
	/***********************************************************/
	private function getExtensions() {
		global $database, $mainframe;

		$extensions = array();
		switch ($this->element) {
			case 'mambot':
				$database->setQuery("SELECT element FROM #__mambots GROUP BY element ORDER BY element ASC");
				$all_extensions = $database->loadResultArray();
				$core_extensions = $this->elxisBots();
			break;
			case 'module':
				$database->setQuery("SELECT module FROM #__modules WHERE module IS NOT NULL AND module <> '' GROUP BY module ORDER BY module ASC");
				$all_extensions = $database->loadResultArray();
				$core_extensions = $this->elxisModules();
			break;
			case 'component':
				$database->setQuery("SELECT `option` FROM #__components WHERE parent='0'");
				$all_extensions = $database->loadResultArray();
				$core_extensions = $this->elxisComponents();
			break;
			default:
				$this->error = 1;
				$this->errormsg = 'Updates check for extensions of type <strong>'.$this->element.'</strong> is not supported.';
				return $extensions;
			break;
		}

		$third_extensions = array();
		if ($all_extensions) {
			foreach ($all_extensions as $ext) {
				if (!in_array($ext, $core_extensions)) { $third_extensions[] = $ext; }
			}
		}

		$extensions = array();
		if ($third_extensions) {
			if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
			foreach ($third_extensions as $ext) {
				if ($this->element == 'module') {
					if (file_exists($mainframe->getCfg('absolute_path').'/modules/'.$ext.'.xml')) {
						$xmlfile = $mainframe->getCfg('absolute_path').'/modules/'.$ext.'.xml';
					} else if (file_exists($mainframe->getCfg('absolute_path').'/administrator/modules/'.$ext.'.xml')) {
						$xmlfile = $mainframe->getCfg('absolute_path').'/administrator/modules/'.$ext.'.xml';
					} else {
						continue;
					}
				} else if ($this->element == 'mambot') {
					$database->setQuery("SELECT folder FROM #__mambots GROUP BY folder");
					$folders = $database->loadResultArray();
					if (!$folders) { $folders = array('content', 'editors', 'editors-xtd', 'search'); }
					$xmlfile = '';
					foreach ($folders as $folder) {
						if (file_exists($mainframe->getCfg('absolute_path').'/mambots/'.$folder.'/'.$ext.'.xml')) {
							$xmlfile = $mainframe->getCfg('absolute_path').'/mambots/'.$folder.'/'.$ext.'.xml';
							break;
						}
					}
					if ($xmlfile == '') { continue; }
				} else { //component
					$comname = preg_replace('#^(com\_)#i', '', $ext);
					if (file_exists($mainframe->getCfg('absolute_path').'/administrator/components/'.$ext.'/'.$comname.'.xml')) {
						$xmlfile = $mainframe->getCfg('absolute_path').'/administrator/components/'.$ext.'/'.$comname.'.xml';
					} else {
						continue;
					}
				}

				$xmlDoc = simplexml_load_file($xmlfile, 'SimpleXMLElement');
				if ($xmlDoc) {
					$ok = true;
					if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
						if ($xmlDoc->getName() != 'mosinstall') { $ok = false; }
					}
					if ($ok) {
						$attrs =  $xmlDoc->attributes();
						if ($attrs) {
							if (isset($attrs['type']) && ($attrs['type'] == $this->element)) {
								if (isset($xmlDoc->version)) {
									$extensions[$ext] = (string)$xmlDoc->version;
								}
							}
						}
					}
				}
				unset($xmlDoc);
			}
		}
		return $extensions;
	}


	/*****************************/
	/* ELXIS BUILT-IN COMPONENTS */
	/*****************************/
	private function elxisComponents() {
		$components = array('com_banners', 'com_contact', 'com_content', 'com_eblog', 'com_frontpage', 
		'com_login', 'com_messages', 'com_newsfeeds', 'com_poll', 'com_registration', 'com_rss', 
		'com_search', 'com_user', 'com_weblinks', 'com_wrapper', 'com_access', 'com_admin', 'com_categories', 
		'com_checkin', 'com_config', 'com_database', 'com_installer', 'com_languages', 'com_mambots', 
		'com_massmail', 'com_media', 'com_menumanager', 'com_menus', 'com_modules', 'com_sections', 
		'com_softdisk', 'com_statistics', 'com_syndicate', 'com_templates', 'com_trash', 'com_typedcontent', 
		'com_users');
		return $components;
	}


	/**************************/
	/* ELXIS BUILT-IN MODULES */
	/**************************/
	private function elxisModules() {
		$modules = array('mod_alanguage', 'mod_archive', 'mod_banners', 'mod_components', 'mod_frontpage','mod_fullmenu',
		'mod_language', 'mod_latest', 'mod_latestnews', 'mod_logged', 'mod_mainmenu', 'mod_mosmsg', 'mod_mostread',
		'mod_newsflash', 'mod_online', 'mod_pathway', 'mod_poll', 'mod_popular', 'mod_random_image', 'mod_random_profile', 
		'mod_related_items', 'mod_rssfeed', 'mod_search', 'mod_sections', 'mod_stats', 'mod_templatechooser', 'mod_toolbar', 
		'mod_topweblink', 'mod_unread', 'mod_whosonline', 'mod_wrapper');
		return $modules;
	}


	/***********************/
	/* ELXIS BUILT-IN BOTS */
	/***********************/
	private function elxisBots() {
		$bots = array('categories.searchbot', 'contacts.searchbot', 'content.searchbot', 'eblog.searchbot', 'geshi', 
		'legacybots', 'moscode', 'mosemailcloak', 'mosflv', 'mosflv.btn', 'mosimage', 'mosimage.btn', 'mosloadposition', 
		'mospage.btn', 'mospaging', 'mossef', 'mosvote', 'newsfeeds.searchbot', 'none', 'sections.searchbot', 'tinymce',
		'weblinks.searchbot');
		return $bots;
	}


	/******************************/
	/* GET ERROR MESSAGE (IF ANY) */
	/******************************/
	public function geterrormsg() {
		return $this->errormsg;
	}

}

?>