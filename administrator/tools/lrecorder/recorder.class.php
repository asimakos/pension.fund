<?php 
/**
* @version: $Id$
* @copyright: (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Logins Recorder tool
* @author: Ioannis Sannos
* @email: datahell [AT] elxis [DOT] org
* @link: http://www.elxis.org
* @description: Logs login attempts to Elxis administration (successful or not)
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if(!class_exists('elxisLRecorder')) {
class elxisLRecorder {

    protected $enabled = 0;
    protected $recBase = '';
    protected $key = '';


    /***************/
    /* CONSTRUCTOR */
    /***************/
    public function __construct() {
        global $mosConfig_absolute_path, $mosConfig_secret;

        $this->recBase = $mosConfig_absolute_path.'/administrator/tools/lrecorder/';
        require_once($this->recBase.'config.php');
        $this->enabled = $lrecorder_enabled;
        $this->key = $mosConfig_secret;
        if ($this->key == '') { $this->key = md5($mosConfig_absolute_path); }
        $this->loadLanguage();
    }


    /***************************/
    /* LOAD LRECORDER LANGUAGE */
    /***************************/
    protected function loadLanguage() {
        global $alang;
        if (file_exists( $this->recBase.'language'.SEP.$alang.'.php')) {
            include_once( $this->recBase.'language'.SEP.$alang.'.php' );
        } else {
            include_once( $this->recBase.'language'.SEP.'english.php' );
        }
    }


	/********************/
	/* ENCRYPT A STRING */
	/********************/
	protected function krypto($str) {
        $ky = $this->key;
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
	protected function akrypto($str) {
        $ky = $this->key;
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


    /****************************/
    /* ENABLE/DISABLE LRECORDER */
    /****************************/
    public function changeStatus() {
        global $fmanager;

        $en = ($this->enabled) ? 0 : 1;
        $data = '<?php '._LEND._LEND;
        $data .= 'defined( \'_VALID_MOS\' ) or die( \'Direct Access to this location is not allowed.\' );'._LEND._LEND;
        $data .= '$lrecorder_enabled = '.$en.';'._LEND._LEND;
        $data .= '?>'._LEND;

        $done = false;
        $fmanager->spChmod($this->recBase.'config.php', '0666');
        if ($fmanager->writeFile($this->recBase.'config.php', $data)) { $done = true; }
        echo '<a href="javascript: void();" onclick="javascript: recChangeStatus();" title="'._LREC_CHSTATUS.'">';
        echo '<img src="tools/lrecorder/images/cstatus.png" border="0" align="absmiddle" alt="status" /> ';
        echo _LREC_RECIS;
        if ($done) {
            echo ($en) ? ' <strong>'._LREC_ENABLED.'</strong>' : ' <strong>'._LREC_DISABLED.'</strong>';
        } else {
            echo ($en) ? ' <strong>'._LREC_DISABLED.'</strong>' : ' <strong>'._LREC_ENABLED.'</strong>';
        }
        echo '</a>';
        exit();
    }


    /*********************/
    /* IMPORT JAVASCRIPT */
    /*********************/
    protected function importJava() {
        echo '<script type="text/javascript" src="includes/js/ajax_new.js"></script>'._LEND;
        echo '<script type="text/javascript" src="tools/lrecorder/lrecorder.js"></script>'._LEND;
    }


    /*********************/
    /* GET EXISTING LOGS */
    /*********************/
    protected function getLogs() {
        global $fmanager;

        $file = $fmanager->PathName($this->recBase.'logs/').'logs.txt';
        $rows = array();
        $fp = @fopen($file, "r");
        while (!feof($fp)) {
            $line = trim(@fgets($fp, 4096));
            if ($line != '') {
                $row = explode('|', $this->akrypto($line));
	            if (is_array($row) && (count($row) == 6)) {
                    $rows[] = $row;
                }
	        }
        }
        @fclose($fp);
        return $rows;
    }


    /***************/
    /* DELETE LOGS */
    /***************/
    public function deleteLogs() {
        global $fmanager;
        $file = $fmanager->PathName($this->recBase.'logs/').'logs.txt';
        $fmanager->spChmod($file, '0666');
        if ($fmanager->writeFile($file, '')) {
        	return true;
        } else { return false; }
    }


    /*******************/
    /* LOGGER SETTINGS */
    /*******************/
    public function showRecords() {
        global $adminLanguage, $mosConfig_live_site;

        $rows = $this->getLogs();
        $n = count($rows);
        $recURL = $mosConfig_live_site.'/administrator/index2.php?option=com_admin&task=tools&tname=lrecorder';
        $this->importJava();
?>
        <table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr>
            <td><div id="recStatus"><a href="javascript: void();" onclick="javascript: recChangeStatus();" title="<?php echo _LREC_CHSTATUS; ?>"><img src="tools/lrecorder/images/cstatus.png" border="0" align="absmiddle" /> <?php 
            echo _LREC_RECIS;
            echo ($this->enabled) ? ' <strong>'._LREC_ENABLED.'</strong>' : ' <strong>'._LREC_DISABLED.'</strong>';
            ?></a></div></td>
        </tr> 
        <tr>
            <td><a href="<?php echo $recURL.'&act=del'; ?>" title="<?php echo $adminLanguage->A_DELETE; ?>">
            <img src="tools/lrecorder/images/trash.png" border="0" align="absmiddle" /> <?php echo _LREC_CLEARL; ?></a><br />
            <?php printf(_LREC_LOGEDATT, '<strong>'.$n.'</strong>'); ?></td>
        </tr>
        </table>
        <table class="adminlist">
        <tr>
            <th class="title"><?php echo $adminLanguage->A_DATE; ?></th>
            <th>IP</th>
            <th class="title"><?php echo $adminLanguage->A_USERNAME; ?></th>
            <th class="title"><?php echo _LREC_OS; ?></th>
            <th class="title"><?php echo _LREC_BROWSER; ?></th>
            <th><?php echo _LREC_SUCLOGIN; ?></th>
        </tr>
        <?php 
        $k = 0;
        for ($i=($n-1); $i>-1; $i--) {
            $row = $rows[$i];
?>
            <tr class="row<?php echo $k; ?>">
                <td><?php echo mosFormatDate(date('Y-m-d H:i:s', $row[0]), _GEM_DATE_FORMLC2); ?></td>
                <td align="center">
					<a href="http://ip2country.esymbian.info/?host=<?php echo $row[1]; ?>" target="_blank" title="GEO Locate"><?php echo $row[1]; ?></a>
				</td>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo $row[3]; ?></td>
                <td><?php echo $row[4]; ?></td>
                <td align="center"><?php 
                $img = ($row[5] == 's') ? 'ok.png' : 'nok.png';
                ?>
                <img src="tools/lrecorder/images/<?php echo $img; ?>" border="0" alt="<?php echo $img; ?>" />
                </td>
            </tr>
<?php 
            $k = 1-$k;
        }
        if ($n == 0) {
            echo '<tr><td colspan="6" align="center">'._LREC_NOLOGS.'</td></tr>'._LEND;
        }
        echo '</table>'._LEND;
    }


    /******************/
    /* ADD NEW RECORD */
    /******************/
    public function record($username='', $success='f') {
        global $fmanager;

        if (!$this->enabled) { return; }
        $data = time().'|';
        $data .= $_SERVER['REMOTE_ADDR'].'|';
        $data .= $username.'|';

        include($this->recBase.'browser.class.php');
        $brow = new browserClass();
        $data .= $brow->OS.' '.$brow->OS_Version.'|';
        $data .= $brow->Browser.' '.$brow->Browser_Version.'|';
        $data .= $success;
        $data = $this->krypto($data)._LEND;

        $file = $fmanager->PathName($this->recBase.'logs/').'logs.txt';
        if (!is_writable($file)) {
            $fmanager->spChmod($file, '0666');
        }
	    if ($fr = @fopen($file, 'r')) {
		    $buffer = @fread($fr, filesize($file));
            @fclose($fr);

            $buffer .= $data;
            if ($fmanager->writeFile($file, $buffer)) {
                return true;
            } else { return false; }
        }
        return false;
    }

}
}

?>