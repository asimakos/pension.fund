<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Media
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class mediaManager {

    public $homedir = '';
    public $urldir = '';
    public $listdir = '';
    public $reldir = '';
    public $mode = 'ajax';
    public $file = '';
    public $urlbase = '';
    public $absbase = '';
    public $thumbs = 0;
    public $msg = array();
    public $gdi = array();


    /***************/
    /* CONSTRUCTOR */
    /***************/
    public function __construct($reldir='') {
        global $mosConfig_absolute_path, $mosConfig_live_site, $fmanager;

        $this->urlbase = $mosConfig_live_site.'/administrator/components/com_media';
        $this->absbase = $fmanager->fwSlashes($mosConfig_absolute_path.'/administrator/components/com_media');
        $this->homedir = $fmanager->fwSlashes($mosConfig_absolute_path.'/images');
        $this->urldir = $mosConfig_live_site.'/images';

        if ($reldir != '') {
            $reldir = $fmanager->fwSlashes($reldir);
            $reldir = preg_replace('/(\.\.)/', '', $reldir);
            $reldir = preg_replace('/\/$/', '', $reldir);
        }
        $listdir = $this->homedir.$reldir;
        if (file_exists($listdir) && is_dir($listdir)) {
            $this->reldir = $reldir;
            $this->listdir = $listdir;
            $this->urldir = $this->urldir.$reldir;
        } else {
            $this->reldir = '';
            $this->listdir = $this->homedir;
        }

        $this->mode = ($this->ajax_enabled()) ? 'ajax' : 'normal';
        $this->file = trim(mosGetParam( $_REQUEST, 'file', '' ));

        $gdi = array();
        if (function_exists('imagecreatefromjpeg')) {
            array_push($gdi, 'jpg', 'jpeg');
        }
        if (function_exists('imagecreatefrompng')) {
            array_push($gdi, 'png');
        }
        if (function_exists('imagecreatefromgif')) {
            array_push($gdi, 'gif');
        }
        $this->gdi = $gdi;
    }


    /********************************/
    /* CHECK BROWSER'S AJAX SUPPORT */
    /********************************/
    private function ajax_enabled() {
    	return 1; //always use AJAX
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $brwsr['ie6']     = (strpos($agent, 'msie 6.') !== false);
        $brwsr['ie7']     = (strpos($agent, 'msie 7.') !== false); 
        $brwsr['ie8']     = (strpos($agent, 'msie 8.') !== false);
        $brwsr['firefox'] = (strpos($agent, 'firefox') !== false);
        $brwsr['opera']   = (strpos($agent, 'opera') !== false);

        if (($brwsr['ie6']||$brwsr['ie7']||$brwsr['ie8']||$brwsr['firefox'])&&!$brwsr['opera'] ) {
            return 1;
        } else {
            return 0;
        }
    }


    /********************/
    /* IMPORT MEDIA CSS */
    /********************/
    function importCSS() {
        echo '<link type="text/css" rel="stylesheet" href="'.$this->urlbase.'/css/media.css" />'._LEND;
    }


    /*********************************/
    /* PROMPT TO USE FIREFOX BROWSER */
    /*********************************/
    function useFirefox() {
        global $adminLanguage;
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $ie6  = (strpos($agent, 'msie 6') !== false);
        $ie7  = (strpos($agent, 'msie 7') !== false);
        $ie8  = (strpos($agent, 'msie 8') !== false);
        $firefox = (strpos($agent, 'firefox') !== false);

        if ($firefox || $ie7 || $ie8) { return; }
        if ($ie6) {
            echo $adminLanguage->A_CMP_ME_IE6UPGRADE.'<br />'._LEND;
        } else {
            echo $adminLanguage->A_CMP_ME_USEFIREFOX.'<br />'._LEND;
        }
    }


    /***************************/
    /* IMPORT MEDIA JAVASCRIPT */
    /***************************/
    function importJS() {
        echo '<script language="javascript" type="text/javascript" src="'.$this->urlbase.'/js/media.js" /></script>'._LEND;
        echo '<script language="javascript" type="text/javascript" src="'.$this->urlbase.'/js/'.$this->mode.'.js" /></script>'._LEND;
    }


    /*******************************/
    /* IMPORT WATERMARK JAVASCRIPT */
    /*******************************/
    function watermarkJS() {
        echo '<script language="javascript" type="text/javascript" src="'.$this->urlbase.'/js/watermark.js" /></script>'._LEND;
    }


    /*******************/
    /* SYSTEM MESSAGES */
    /*******************/
    function importJSmessages() {
        global $adminLanguage;
?>
        <script language="javascript" type="text/javascript">
            function mShowMessage(mid, extra) {
                var msgarr = new Array();
                msgarr[0] = '<?php echo $adminLanguage->A_CMP_ME_DBCLOP; ?> <b>\'' + extra + '\'</b>';
                msgarr[1] = '<?php echo $adminLanguage->A_CMP_ME_DODOWN; ?> \''+extra +'\' <?php echo $adminLanguage->A_CMP_ME_ASZIP; ?>';
                msgarr[2] = '<?php echo $adminLanguage->A_CMP_ME_EXTHERE; ?>';
                msgarr[3] = '<?php echo $adminLanguage->A_PREVIEW; ?>';
                msgarr[4] = '<?php echo $adminLanguage->A_CMP_ME_SELFNIMG; ?>';
                msgarr[5] = '<?php echo $adminLanguage->A_CMP_ME_FSELFCL; ?>';
                msgarr[6] = '<?php echo $adminLanguage->A_CMP_ME_RENEWFN; ?>';
                msgarr[7] = '<?php echo $adminLanguage->A_CMP_ME_ALLFIFODEL; ?>';
                var tempo8 = '<?php printf($adminLanguage->A_CMP_ME_DELQUEST, "XXXXXXXX"); ?>';
                msgarr[8] = tempo8.replace(/XXXXXXXX/, extra);
                msgarr[9] = '<?php echo $adminLanguage->A_CMP_ME_COPYTOFO; ?>';
                msgarr[10] = '<?php echo $adminLanguage->A_CMP_ME_SRCISDIR; ?>';
                msgarr[11] = '<?php echo $adminLanguage->A_CMP_ME_NEWFONAME; ?>';
                msgarr[12] = '<?php echo $adminLanguage->A_CMP_ME_SELFIUP; ?>';
                msgarr[13] = '<?php echo $adminLanguage->A_CMP_ME_SELFNFLV; ?>';
                msgarr[14] = '<?php echo $adminLanguage->A_CMP_ME_PLAY; ?>';
                msgarr[15] = '<?php echo $adminLanguage->A_CMP_ME_SELFNMP3; ?>';
                var tempo16 = '<?php printf($adminLanguage->A_CMP_ME_EXTRCUFO, "YYYYYYYY"); ?>';
                msgarr[16] = tempo16.replace(/YYYYYYYY/, extra);
                msgarr[17] = '<?php echo $adminLanguage->A_CMP_ME_TODOWNCL; ?>';
                var tempo18 = '<?php printf($adminLanguage->A_CMP_ME_FINOZIP, "ZZZZZZZZ"); ?>';
                msgarr[18] = tempo18.replace(/ZZZZZZZZ/, extra);
                msgarr[19] = '<?php echo $adminLanguage->A_CMP_ME_FINORES; ?>';
                msgarr[20] = '<?php echo $adminLanguage->A_CMP_ME_INVWNIMG; ?>';
                msgarr[21] = '<?php echo $adminLanguage->A_CMP_ME_INVHNIMG; ?>';

                if (mid && msgarr[mid]) {
                    return msgarr[mid];
                }
            }
        </script>
<?php 
    }


    /*************************/
    /* PRINT TOOLBAR BUTTONS */
    /*************************/
    function printbuttons() {
        global $adminLanguage;
        
        $cview = $this->thumbs ? 0 : 1;
        $cviewtxt = $this->thumbs ? $adminLanguage->A_CMP_ME_VICONS : $adminLanguage->A_CMP_ME_VTHUMBS;
?>
        <a href="index2.php?option=com_media" title="<?php echo $adminLanguage->A_MENU_HOME; ?>">
        <img src="<?php echo $this->urlbase; ?>/images/home.gif" class="mm_button" /></a>
        <a href="index2.php?option=com_media&task=up&reldir=<?php echo $this->reldir; ?>" title="<?php echo $adminLanguage->A_UP; ?>">
        <img src="<?php echo $this->urlbase; ?>/images/up.gif" border="0" class="mm_button" /></a>
        <img src="<?php echo $this->urlbase; ?>/images/seperator.gif" class="mm_seperator" border="0" />
        <a href="javascript: void(0);" title="<?php echo $adminLanguage->A_COPY; ?>">
        <img src="<?php echo $this->urlbase; ?>/images/copy.gif" onclick="mm_copy()" class="mm_button" /></a>
        <a href="javascript: void(0);" title="<?php echo $adminLanguage->A_DELETE; ?>">
        <img src="<?php echo $this->urlbase; ?>/images/delete.gif" onclick="mm_delete()" class="mm_button" /></a>
        <a href="javascript:void(0);" title="<?php echo $adminLanguage->A_CMP_ME_RENAME; ?>">
        <img src="<?php echo $this->urlbase; ?>/images/rename.gif" onclick="mm_rename()" class="mm_button" /></a>
        <img src="<?php echo $this->urlbase; ?>/images/seperator.gif" class="mm_seperator" border="0" />
        <a href="javascript:void(0);" title="<?php echo $adminLanguage->A_CMP_ME_NEWFOL; ?>">
        <img src="<?php echo $this->urlbase; ?>/images/newfolder.gif" onclick="mm_newfolder()" class="mm_button" /></a>
        <img src="<?php echo $this->urlbase; ?>/images/seperator.gif" class="mm_seperator" border="0" />
        <select name="mode" class="selectbox" dir="ltr" style="vertical-align: top;">
            <option value="0777" selected="selected">777</option>
            <option value="0755">755</option>
            <option value="0750">750</option>
            <option value="0666">666</option>
            <option value="0644">644</option>
            <option value="0600">600</option>
            <option value="0555">555</option>
            <option value="0444">444</option>
        </select>
        <a href="javascript:void(0);" title="<?php echo $adminLanguage->A_CMP_ME_CHPERMS; ?>">
        <img src="<?php echo $this->urlbase; ?>/images/chmode.gif" onclick="mm_chmode()" class="mm_button" /></a>
        <img src="<?php echo $this->urlbase; ?>/images/seperator.gif" class="mm_seperator" border="0" />
        <a href="javascript:;" title="<?php echo $cviewtxt; ?>">
        <img src="<?php echo $this->urlbase; ?>/images/view.gif" onclick="mm_thumbnail(<?php echo $cview; ?>)" class="mm_button" alt="<?php echo $cviewtxt; ?>" /></a>
        <a href="javascript: void(0);"  title="<?php echo $adminLanguage->A_CMP_ME_EXTRZIP; ?>">
        <img src="<?php echo $this->urlbase; ?>/images/extract.gif" onclick="mm_extract()" class="mm_button" alt="<?php echo $adminLanguage->A_CMP_ME_EXTRZIP; ?>" />
        </a>
<?php 
    }


    /*****************************/
    /* DISPLAY FOLDERS AND FILES */
    /*****************************/
    function explore() {
        global $adminLanguage;

        $dir = $this->listdir;
        echo '<div class="mediaicons">'._LEND;
        echo '<ul id="medialist">'._LEND;
        if (is_dir($dir)) {
            if ($dh = @opendir($dir)) {
                while ($file = readdir($dh)) { $files[] = $file; }
                sort($files);
                $i=1;

                foreach($files as $file) {
                    if (($file!= ".") && ($file != "..") && is_dir($dir.'/'.$file)) {
                        echo '<li id="mediabox'.$i.'">'._LEND;
                        $this->dirstatus($file, $i);
                        echo '</li>'._LEND;
                        $i++;
                    }
                }

                foreach($files as $file) {
                    if (($file!= ".") && ($file != "..") && !is_dir($dir.'/'.$file)) {
                        echo '<li id="mediabox'.$i.'">'._LEND;
                        $this->filestatus($file, $i);
                        echo '</li>'._LEND;
                        $i++;
                    }
                }
                @closedir($dh);
            }
        } else {
            $this->msg[] = sprintf($adminLanguage->A_CMP_ME_DIRNEX, $dir);
        }
        echo '</ul>'._LEND;
        echo '</div>'._LEND;
        echo '<div style="clear: both;">&nbsp;</div>'._LEND;
        echo '<input type="hidden" name="lastlic" id="lastlic" value="'.($i-1).'" />'._LEND;
    }


    /****************************/
    /* DISPLAY DIRECTORY STATUS */
    /****************************/
    function dirstatus($dir, $i) {
        global $adminLanguage;

        $dirname_t = htmlentities($dir,ENT_QUOTES);
        $len = eUTF::utf8_strlen($dirname_t);
        $dirname = ($len > 16) ? eUTF::utf8_substr($dirname_t, 0, 13).'...' : $dirname_t;

        $stat = @stat($this->listdir.'/'.$dir);
        $lastmod = $stat[9];

        $spec = 'fd';
        $tooltip = '<b>'.$dirname_t.'</b><br />';
        $tooltip .= $adminLanguage->A_CMP_ME_PERMS.': '.decoct(fileperms($this->listdir.'/'.$dir)%01000).'<br />';
        $tooltip .= $adminLanguage->A_CMP_ME_MODIF.': '.eLocale::strftime_os(_GEM_DATE_FORMLC2, $lastmod);
    ?>
        <a class="icon" onmouseover="this.T_BGCOLOR='#FFFFFF'; return escape('<?php echo $tooltip; ?>');">
            <img src="<?php echo $this->urlbase; ?>/images/mime/dir.png" title="<?php echo $dirname_t; ?>" onmousedown="mm_loadfile(this, '<?php echo $dirname_t; ?>', '<?php echo $i; ?>', '<?php echo $spec; ?>', 'folder');  mm_fullurl('<?php echo $this->urldir.'/'.$dir.'/'; ?>')" 
            id="file" ondblclick="mm_opendir('<?php echo $this->relativeDir($this->listdir.'/'.$dir); ?>')" spec="<?php echo $spec; ?>" />
        </a><br />
        <span id="mediatitle<?php echo $i; ?>">
            <a class="mm_name" href="javascript:mm_download('<?php echo $dirname_t; ?>')" title="<?php echo $adminLanguage->A_CMP_ME_DOWNZIP; ?>"><?php echo $dirname; ?></a>
        </span>
<?php 
    }


    /***********************/
    /* DISPLAY FILE STATUS */
    /***********************/
    function filestatus($file, $i) {
        global $adminLanguage;

        $scale = array(" Bytes"," KB"," MB"," GB");
        $stat = stat($this->listdir.'/'.$file);

        $size = $stat[7];
        for ($s=0; $size>1024 && $s<4; $s++) { $size = $size/1024; } //Calculate in Bytes,KB,MB etc.

        if ($s>0) {
            $size= number_format($size,2).$scale[$s];
        } else {
            $size= number_format($size).$scale[$s];
        }

        $spec = $this->filespec($file);
        $filename_t = htmlentities($file,ENT_QUOTES);
        $len = eUTF::utf8_strlen($filename_t);
        $filename = ($len > 16) ? eUTF::utf8_substr($filename_t, 0, 13).'...' : $filename_t;

        $tooltip = '<b>'.$filename_t.'</b><br />';
        $tooltip .= $adminLanguage->A_CMP_ME_PERMS.': '.decoct(fileperms($this->listdir.'/'.$file)%01000).'<br />';
        $tooltip .= $adminLanguage->A_CMP_ME_SIZE.': '.$size.'<br />';
        if (preg_match('/t/i', $spec)) {
            $xinfo = getimagesize($this->listdir.'/'.$file);
            $tooltip .= $adminLanguage->A_CMP_ME_DIMS.': '.$xinfo[0].' X '.$xinfo[1].' pixels<br />';
        }
        $tooltip .= $adminLanguage->A_CMP_ME_MODIF.': '.eLocale::strftime_os(_GEM_DATE_FORMLC2, $stat[9]).'<br />';
        $tooltip .= $adminLanguage->A_CMP_ME_ACCESSED.': '.eLocale::strftime_os(_GEM_DATE_FORMLC2, $stat[8]);
?>

        <a class="icon" onmouseover="this.T_BGCOLOR='#FFFFFF'; return escape('<?php echo $tooltip; ?>');">
        <img src="<?php echo $this->fileicon($file); ?>" onmousedown="mm_loadfile(this, '<?php echo $filename_t; ?>', '<?php echo $i; ?>', '<?php echo $spec; ?>', 'file'); mm_fullurl('<?php echo $this->urldir.'/'.$file; ?>')" 
        id="file" ondblclick="mm_todownload()" title="<?php echo $filename_t; ?>" spec="<?php echo $spec; ?>" /></a><br />
        <span id="mediatitle<?php echo $i; ?>">
            <a class="mm_name" href="index3.php?option=com_media&task=download&file=<?php echo $filename_t; ?>&reldir=<?php echo $this->reldir; ?>" title="<?php echo $adminLanguage->A_CMP_ME_DOWNLOAD; ?>">
            <?php echo $filename; ?></a>
        </span>
<?php 
    }  


    /*************************************/
    /* RETURNS A FULL'S DIR RELATIVE DIR */
    /*************************************/
    function relativeDir($fulldir) {
        global $fmanager;
        $fulldir = $fmanager->fwSlashes($fulldir);
        $fulldir = preg_replace('/(\/)$/', '', $fulldir);
        $rel = substr($fulldir, strlen($this->homedir));
        if ((strlen($this->homedir.$rel)!=strlen($fulldir) )|| (!is_dir($fulldir))) { $rel = ''; }
        return $rel;
    }


    /******************************************************************/
    /* GET FILE'S/FOLDER'S ATTRIBUTES (z-zip, t-thumb, d-dir, h-html) */
    /******************************************************************/
    function filespec($file) {
        $spec = 'f';
        if (is_dir($this->listdir.'/'.$file)) { $spec .= 'd';  return $spec; }
        $data = pathinfo($file);
        $ext = strtolower($data["extension"]);
        if (($ext == 'png') || ($ext == 'gif') || ($ext == 'jpg') || ($ext == 'jpeg') || ($ext == 'bmp')) { $spec .= 't'; }
        if ($ext == 'zip') { $spec .= 'z'; }
        if ($ext == 'flv') { $spec .= 'v'; }
        if ($ext == 'mp3') { $spec .= '3'; }
        if (in_array($ext, $this->gdi)) { $spec .= 'e'; }
        $HTMLfiles = array('htm', 'html', 'phtml', 'shtml');
        if (in_array($ext, $HTMLfiles)) { $spec .= 'h'; }
        return $spec;
    }


    /*******************/
    /* GET FILE'S ICON */
    /*******************/
    function fileicon($file) {
        global $mosConfig_live_site, $fmanager;

        clearstatcache();
        $ext = $fmanager->fileExt($file);

        $htmlarr = array('html', 'htm', 'phtml', 'shtml', 'mht');
        $iarr = array('gif', 'jpg', 'jpeg', 'png', 'bmp', 'psd', 'svg');

        if (in_array($ext, $htmlarr)) {
            $img = 'html.png';
        } else if (($ext == 'php') || ($ext == 'php3')) {
            $img = 'php.png';
        } else if (in_array($ext, $iarr) && $this->thumbs) {
            $info = getimagesize($this->listdir.'/'.$file);
            if ($info) {
                if (($info[2]==1) || ($info[2]==2) || ($info[2]==3) || ($info[2]==15)) {
                    $img = $mosConfig_live_site.'/administrator/components/com_media/inc/thumb.php?img='.$this->listdir.'/'.$file;	//thumbnail path
                    return $img;
                }
            }
            $img = 'jpg.png';
        } else if (file_exists($this->absbase.'/images/mime/'.$ext.'.png')) {
            $img = $ext.'.png';
        } else {
            $img = 'unknown.png';
        }
        
        return $this->urlbase.'/images/mime/'.$img;
    }


    /********************************/
    /* ADD FILES TO ZIP RECURSIVELY */
    /********************************/
    function add_dir($dir, $newzip, $no=0) {
        $no++;
        if (($no>10) || (strlen($newzip->file())>5000000)) {
            die("Too many sub directories (>$no) or Total size > 5MB!<br>Try them by parts. [Some security measures!] ");
        }
        if ($dh = opendir($dir)) {
            $newzip->addFile('',$dir.'/',0);
            while ($file = readdir($dh))  { $files[] = $file; }
            
            foreach($files as $file) {
                if (($file != ".") && ($file != "..") && (!is_dir($dir.'/'.$file))) {
                    $data = file_get_contents($dir.'/'.$file);
                    $newzip->addFile($data, $dir.'/'.$file,0);
                }
            }

            foreach($files as $file) {
                if (($file != ".") && ($file != "..") && (is_dir($dir.'/'.$file))) {
                    $this->add_dir($dir.'/'.$file, $newzip, $no);
                }
            }
            closedir($dh);
        }
    }


    /***************************************/
    /* CHECK IF THUMBNAILS VIEW IS ENABLED */
    /***************************************/
    function checkThumbView() {
        if (isset($_GET['vthumbs'])) {
            $this->thumbs = intval($_GET['vthumbs']) ? 1 : 0;
            @setcookie('elx_media_thumbs', ''.$this->thumbs.'', time() + 2592000);
        } else {
            if (isset($_COOKIE['elx_media_thumbs'])) {
	           $this->thumbs = intval($_COOKIE['elx_media_thumbs']) ? 1 : 0;
            } else {
                $this->thumbs = 0;
                @setcookie('elx_media_thumbs', '0', time() + 2592000);
            }
        }
    }


    /*******************/
    /* EXPIRED HEADERS */
    /*******************/
    function expired() {
        @header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        @header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        @header("Cache-Control: no-cache, must-revalidate");
        @header("Pragma: no-cache");
    }

}

?>