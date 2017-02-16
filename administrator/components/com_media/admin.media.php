<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Media
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//ensure user has access to this function
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
		|| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_media' ))) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

$reldir = trim(mosGetParam( $_REQUEST, 'reldir', '' ));

require_once($mosConfig_absolute_path.'/administrator/components/com_media/media.class.php');
$mmanager = new mediaManager($reldir);

switch($task) {
    case 'delete':
        media_delete();
    break;
    case 'rename':
        media_rename();
    break;
    case 'copy':
        media_copy();
    break;
    case 'newfolder':
        media_newfolder();
    break;
    case 'cmode':
        media_chmod();
    break;
    case 'uploadfile':
        media_upload();
    break;
    case 'preresize':
        prepare_resize();
    break;
    case 'doresize':
        media_resize();
    break;
    case 'prewatermark':
        prepare_watermark();
    break;
    case 'wmsave':
        save_watermark(0);
    break;
    case 'wmsaveas':
        save_watermark(1);
    break;
    case 'wmpreview':
        save_watermark(2);
    break;
    case 'extract':
        extractZIP();
    break;
    case 'up':
        moveup($reldir);
    break;
    case 'download':
        download_file();
        exit();
    break;
    case 'previewimage':
        previewImage();
    break;
    case 'previewflv':
        previewFLV();
    break;
    case 'listenmp3':
        listenMP3();
    break;
	default:
		showMedia();
	break;
}


/*****************/
/* DISPLAY MEDIA */
/*****************/
function showMedia() {
    global $mmanager, $adminLanguage, $mosConfig_live_site;

    $mmanager->checkThumbView();
    $mmanager->importCSS();
    $mmanager->importJS();
    $mmanager->importJSmessages();
?>
    <table class="adminheading">
		<tr>
	       <th class="mediamanager"><?php echo $adminLanguage->A_CMP_ME_MEMANG; ?></th>
	       <td align="<?php echo (_GEM_RTL) ? 'left': 'right'; ?>" nowrap="nowrap">
	       <?php echo $adminLanguage->A_CMP_ME_VALFTYPES; ?> <a href="javascript:;" onclick="javascript:showLayer('validfiletypes')">
           <img src="images/downarrow2.png" border="0" /></a>
           <div id="validfiletypes" style="display:none; position:absolute; <?php echo (_GEM_RTL) ? 'left': 'right'; ?>:20px; z-index: 2500; width:370px;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_CMP_ME_VALFTYPES; ?></div>
                <div style="text-align: <?php echo (_GEM_RTL) ? 'right': 'left'; ?>; font-weight: normal;">
                <?php echo $adminLanguage->A_IMAGES; ?>: <font color="green">gif, jpg, png, bmp, jpeg</font><br />
                <?php echo $adminLanguage->A_CMP_ME_VIDEO; ?>: <font color="green">mpg, avi, wmv, mov, flv, mpeg, asf, rm, nsv, xvid</font><br />
                <?php echo $adminLanguage->A_CMP_ME_AUDIO; ?>: <font color="green">mp3, wav, mid, ram, wma, ogg, aac</font><br />
                <?php echo $adminLanguage->A_CMP_ME_OTHER; ?>: <font color="green">doc, xls, csv, ppt, swf, pdf, txt, zip, tar, rar, gz, tgz</font>
                </div>
                <div class="filterbottom">
                    <a href="javascript:;" onclick="javascript:hideLayer('validfiletypes');" style="color: #888888;"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			</div>
            </td>
	    </tr>
	</table>

    <form action="index2.php" method="POST" name="adminForm">
        <input type="hidden" name="option" value="com_media" />
        <input type="hidden" name="listdir" id="listdir" value="<?php echo $mmanager->listdir; ?>" />
        <input type="hidden" name="reldir" id="reldir" value="<?php echo $mmanager->reldir; ?>" />
        <table width="100%" class="window">
            <tr>
                <td><?php $mmanager->printbuttons(); ?></td>
            </tr>
            <tr>
                <td>
                    <?php echo $adminLanguage->A_CMP_ME_RELPATH; ?>: 
                    <input type="text" name="go" dir="ltr" size="60" value="<?php echo $mmanager->reldir; ?>" class="inputbox" />
                    <a href="javascript:;" title="<?php echo $adminLanguage->A_GO; ?>">
                        <img src="<?php echo $mmanager->urlbase; ?>/images/go.gif" alt="<?php echo $adminLanguage->A_GO; ?>" class="mm_button" onclick="mm_gotodir()" align="absmiddle" />
                    </a>
                </td>
            </tr>
        </table>

    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center">
                <div id="fullurl" style="height:20px;"></div>
				<div id="thestatus" class="mm_status">
                    <?php 
                        if (count($mmanager->msg) > 0) {
                            foreach($mmanager->msg as $m) {
                                echo $m.'<br />'._LEND;
                            }
                        }

                        $mmanager->useFirefox();
                        echo $adminLanguage->A_CMP_ME_PMOUSEVD;
                    ?>
                </div>
                <?php $mmanager->explore(); ?>
            </td>
        </tr>
    </table>
    <input type="hidden" name="sli" id="sli" value="0" />
    <input type="hidden" name="sliold" id="sliold" value="0" />
    <input type="hidden" name="sfname" id="sfname" value="" />
    <input type="hidden" name="sftype" id="sftype" value="" />
    <input type="hidden" name="sfspec" id="sfspec" value="" />
    <input type="hidden" name="scrwidth" id="scrwidth" value="0" />
    <input type="hidden" name="scrheight" id="scrheight" value="0" />
    </form><br />

    <fieldset id="mm_upload" style="width:600px; text-align:center; padding:10px; margin: 10px 0 10px 0; background-color: #EEEEEE;">
        <legend><b><?php echo $adminLanguage->A_CMP_ME_UPLOAD; ?></b></legend>
        <form id="mm_upload_fm" name="mm_upload_fm" enctype="multipart/form-data" method="POST" action="index2.php" onsubmit="return mm_upload();">
            <input type="file" name="upfile[]" id="upfile" /> 
            <input type="file" name="upfile[]" id="upfile" /><br />
            <input type="file" name="upfile[]" id="upfile" /> 
            <input type="file" name="upfile[]" id="upfile" /><br />
            <input type="file" name="upfile[]" id="upfile" /> 
            <input type="file" name="upfile[]" id="upfile" /><br />
            <input type="hidden" name="option" value="com_media" />
            <input type="hidden" name="reldir" value="<?php echo $mmanager->reldir; ?>" />
            <input type="hidden" name="task" value="uploadfile" /><br />
            <input type="submit" name="submitme" value="<?php echo $adminLanguage->A_CMP_ME_UPLOAD; ?>" class="button" />
        </form>
    </fieldset>
    <br />

    <table id="context" class="mm_context" border="0" cellpadding="0" cellspacing="0" style="top:100px;">
        <tr>
            <td class="mm_contbar"><img src="<?php echo $mmanager->urlbase; ?>/images/dir.png" height="16" width="16" /></td>
            <td><a href="javascript:mm_opendir('<?php echo $mmanager->relativeDir($mmanager->listdir); ?>', '1')" class="mm_contitem"><b><?php echo $adminLanguage->A_CMP_ME_OPEN; ?></b></a></td>
        </tr>
        <tr>
            <td class="mm_contbar"></td>
            <td><hr /></td>
        </tr>
        <tr>
            <td class="mm_contbar"><img src="<?php echo $mmanager->urlbase; ?>/images/rename.gif" height="16" width="16" /></td>
            <td><a href="javascript:mm_rename()" class="mm_contitem"><?php echo $adminLanguage->A_CMP_ME_RENAME; ?></a></td>
        </tr>
        <tr>
            <td class="mm_contbar"><img src="<?php echo $mmanager->urlbase; ?>/images/delete.gif" height="16" width="16" /></td>
            <td><a href="javascript:mm_delete()" class="mm_contitem"><?php echo $adminLanguage->A_DELETE; ?></a></td>
        </tr>
        <tr>
            <td class="mm_contbar"><img src="<?php echo $mmanager->urlbase; ?>/images/copy.gif" height="16" width="16" /></td>
            <td><a href="javascript:mm_copy()" class="mm_contitem"><?php echo $adminLanguage->A_CMP_ME_COPYTO; ?></a></td>
        </tr>
        <tr id="resizerow">
            <td class="mm_contbar"><img src="<?php echo $mmanager->urlbase; ?>/images/resize.gif" height="16" width="16" /></td>
            <td><a href="javascript:mm_prepare_resize()" class="mm_contitem"><?php echo $adminLanguage->A_CMP_ME_RESIZE; ?></a></td>
        </tr>
        <tr id="watermarkrow">
            <td class="mm_contbar"><img src="<?php echo $mmanager->urlbase; ?>/images/watermark.gif" height="16" width="16" /></td>
            <td><a href="javascript:mm_prepare_watermark()" class="mm_contitem"><?php echo $adminLanguage->A_CMP_ME_WATERMARK; ?></a></td>
        </tr>
        <tr>
            <td class="mm_contbar"></td>
            <td><hr/></td>
        </tr>
        <tr>
            <td class="mm_contbar"><img src="<?php echo $mmanager->urlbase; ?>/images/newfolder.gif" height="16" width="16" /></td>
            <td><a href="javascript:mm_newfolder()" class="mm_contitem"><?php echo $adminLanguage->A_CMP_ME_NEWFOL; ?></a></td>
        </tr>
    </table>
    <script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/includes/js/wz_tooltip<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.js"></script>
<?php 
}


/**************************************/
/* DOWNLOAD A FILE OR A ZIPPED FOLDER */
/**************************************/
function download_file() {
    global $mmanager, $mosConfig_absolute_path;

    $file = $mmanager->file;
    if(!is_dir($mmanager->listdir.'/'.$file)) {
        @ob_end_clean();
        @header('Content-Disposition: attachment; filename='.$file);
        @header("Content-Type: file/x-msdownload");
        @header("Content-Length: ".filesize($mmanager->listdir.'/'.$file));
        echo file_get_contents($mmanager->listdir.'/'.$file);
    } else {
        @ob_end_clean();
        require_once($mosConfig_absolute_path.'/administrator/includes/pcl/zip.lib.php');
        $newzip = new zipfile();
        @chdir($mmanager->listdir);
        $name = $file;
        $mmanager->add_dir($name, $newzip);
        @header("Content-Disposition: attachment; filename=".$name."_elxismedia.zip");
        @header("Content-Type: file/x-msdownload");
        $data = $newzip->file();
        @header("Content-Length: ".strlen($data));
        echo $data;
    }
    exit();
}


/********************/
/* MOVE UP A FOLDER */
/********************/
function moveup($rdir) {
    global $fmanager, $mmanager;

    $dir = $fmanager->fwSlashes($rdir);
    $dir = preg_replace('/\/$/', '', $dir); //strip out any traing slash
    $dir = preg_replace('/(\.\.)/', '', $dir);
    $pos = strrpos($dir, '/');
    if ($pos != 0) {
        $up = substr($dir,0,-(strlen($dir)-$pos));
        if (!file_exists($mmanager->homedir.$up) || !is_dir($mmanager->homedir.$up)) { $up = ''; }
    } else { $up = ''; }

    mosRedirect('index2.php?option=com_media&reldir='.$up);
    exit();
}


/**********************************/
/* DELETE A FILE OR FOLDER (AJAX) */
/**********************************/
function media_delete() {
    global $fmanager, $mmanager, $adminLanguage;

    clearstatcache();
    $isdir = (mosGetParam($_POST, 'filetype', '') == 'folder') ? 1 : 0;
    $lic = intval(mosGetParam($_POST, 'lic', 0));
    $file = $mmanager->file;
    $listdir = $mmanager->listdir;
    $path = $mmanager->listdir.'/'.$file;

    $reply = 0;
    if ($file == '') {
        $msg = $adminLanguage->A_CMP_ME_FSELFCL;
    } else if (!file_exists($path)) {
        $msg = ($isdir) ? sprintf($adminLanguage->A_CMP_ME_DIRNEX, $file) : sprintf($adminLanguage->A_CMP_ME_FILNEX, $file);
    } else if ($isdir && $fmanager->deleteFolder($listdir.'/'.$file)) {
        $msg = $adminLanguage->A_CMP_ME_FODELSUC;
        $reply = 1;
    } else if (!$isdir && $fmanager->deleteFile($listdir.'/'.$file)) {
        $msg = $adminLanguage->A_CMP_ME_FIDELSUC;
        $reply = 1;
    } else {
        $msg = '<strong>'.$adminLanguage->A_CMP_ME_DELFAIL.'</strong>';
    }

    //@ob_end_clean();
    $mmanager->expired();
    echo '|'.$reply.'|'.$lic.'|'.$msg.'|';
    exit();
}


/**********************************/
/* RENAME A FILE OR FOLDER (AJAX) */
/**********************************/
function media_rename() {
    global $fmanager, $mmanager, $adminLanguage;

    clearstatcache();
    $lic = intval(mosGetParam($_POST, 'lic', 0));
    $newname = trim(mosGetParam($_POST, 'newname', ''));

    $file = $mmanager->file;
    $old = $mmanager->listdir.'/'.$file;
    $new = $mmanager->listdir.'/'.$newname;

    $isdir = (is_dir($old)) ? 1 : 0;
    $perms = ($isdir) ? '0777' : '0666';

    $reply = 0;
    if (!file_exists($old)) {
        $msg = ($isdir) ? sprintf($adminLanguage->A_CMP_ME_DIRNEX, $file) : sprintf($adminLanguage->A_CMP_ME_FILNEX, $file);
    } else if (file_exists($new)) {
        $msg = ($isdir) ? sprintf($adminLanguage->A_CMP_ME_EXFONAME, $newname) : sprintf($adminLanguage->A_CMP_ME_EXFINAME, $newname);
    } else if (@rename($old, $new)) {
        $msg = ($isdir) ? sprintf($adminLanguage->A_CMP_ME_FORENTO, $file, $newname) : sprintf($adminLanguage->A_CMP_ME_FIRENTO, $file, $newname);
        $reply = 1;
    } else if ($fmanager->spChmod($old, $perms) && @rename($old, $new)) {
        $msg = ($isdir) ? sprintf($adminLanguage->A_CMP_ME_FORENTO, $file, $newname) : sprintf($adminLanguage->A_CMP_ME_FIRENTO, $file, $newname);
        $reply = 1;
    } else {
        $msg = '<strong>'.$adminLanguage->A_CMP_ME_RENFAIL.'</strong>';
    }

    //@ob_end_clean();
    $mmanager->expired();
    echo '|'.$reply.'|'.$lic.'|'.$msg.'|';
    if ($reply) {
        if ($isdir) {
            $mmanager->dirstatus($newname, $lic).'|';
        } else {
            $mmanager->filestatus($newname, $lic).'|';
        }
    }
    exit();
}


/***********************/
/* COPY FILE OR FOLDER */
/***********************/
function media_copy() {
    global $fmanager, $mmanager, $adminLanguage;

    clearstatcache();
    $file = $mmanager->file;
    $source = $mmanager->listdir.'/'.$file;

    $destdir = trim(mosGetParam($_POST, 'destdir', ''));
    $destdir = $fmanager->fwSlashes($destdir);
    $destdir = preg_replace('/^(\/)/', '', $destdir);
    $destdir = preg_replace('/(\/)$/', '', $destdir);
    $destdir = preg_replace('/(\.\.)/', '', $destdir);

    if ($destdir == '') { //root folder
        $adestdir = $mmanager->homedir.'/';
    } else {
        $adestdir = $mmanager->homedir.'/'.$destdir.'/';
    }

    if (($file == '') || !file_exists($source)) {
        echo '<strong>'.$adminLanguage->A_CMP_ME_SRCNEX.'</strong>';
        exit();
    }

    if (is_dir($source)) {
        echo '<strong>'.$adminLanguage->A_CMP_ME_SRCISDIR.'</strong>';
        exit();
    }

    if (!file_exists($adestdir) || !is_dir($adestdir)) {
        printf($adminLanguage->A_CMP_ME_DIRNEX, $adestdir);
        exit();
    }

    $ok = 0;
    $final = $adestdir.$file;
    $file2 = $file;
    if (file_exists($final)) {
        for ($i=1; $i<31; $i++) {
            $file2 = 'copy'.$i.'_'.$file;
            $final = $adestdir.$file2;
            if (!file_exists($final)) { $ok = 1; break; }
        }
    } else {
        $ok = 1;
    }

    if (!$ok) {
        printf($adminLanguage->A_CMP_ME_EXFIINDIR, $file, $adestdir);
        exit();
    }

    $ret = $fmanager->copyFile($source, $final);
    if ($ret) {
        if ($file != $file2) {
            printf($adminLanguage->A_CMP_ME_FICOPYSUC2, $file, $adestdir, $file2);
        } else {
            printf($adminLanguage->A_CMP_ME_FICOPYSUC, $file, $adestdir);
        }
    } else {
        printf($adminLanguage->A_CMP_ME_FICOPYFAIL, $file, $adtesdir);
    }
    exit();
}


/*********************/
/* CREATE NEW FOLDER */
/*********************/
function media_newfolder() {
    global $mmanager, $fmanager, $adminLanguage;

    $lastlic = intval(mosGetParam($_POST, 'lastlic', 0));
    $foldername = trim(mosGetParam($_POST, 'foldername', ''));
    $foldername = $fmanager->fwSlashes($foldername);
    $foldername = preg_replace('/^(\/)/', '', $foldername);
    $foldername = preg_replace('/(\/)$/', '', $foldername);
    $foldername = preg_replace('/(\.\.)/', '', $foldername);

    $path = $mmanager->listdir.'/'.$foldername.'/';

    $reply = 0;
    if ($foldername == '') {
        $msg = $adminLanguage->A_CMP_ME_NAMENEWFO;
    } else if (file_exists($path)) {
        $msg = sprintf($adminLanguage->A_CMP_ME_EXFONAME, '<strong>'.$foldername.'</strong>');
    } else if ($fmanager->createFolder($path)) {
        $msg = sprintf($adminLanguage->A_CMP_ME_FOCRESUC, $foldername);
        $lastlic++;
        $reply = 1;
    } else {
        $msg = '<strong>'.$adminLanguage->A_CMP_ME_CNCRNEWFO.'</strong>';
    }

    //@ob_end_clean();
    $mmanager->expired();
    echo '|'.$reply.'|'.$lastlic.'|'.$msg.'|';
    if ($reply) {
        $mmanager->dirstatus($foldername, $lastlic).'|';
    }
    exit();
}


/********************************/
/* CHANGE MODE A FILE OR FOLDER */
/********************************/
function media_chmod() {
    global $mmanager, $fmanager, $adminLanguage;

    $lic = intval(mosGetParam($_POST, 'lic', 0));
    $mode = trim(mosGetParam($_POST, 'mode', ''));

    $modeok = 1;
    if (strlen($mode) < 4) { $modeok = 0; }
    if (intval($mode) < 400) { $modeok = 0; }
    if (intval($mode) > 777) { $modeok = 0; }

    clearstatcache();
    $path = $mmanager->listdir.'/'.$mmanager->file;

    $reply = 0;
    if (($mmanager->file == '') || (!file_exists($path))) {
        $msg = sprintf($adminLanguage->A_CMP_ME_FILNEX, $path);
    } else if (!$modeok) {
        $msg = $adminLanguage->A_CMP_ME_INVPERMS;
    } else if ($fmanager->spChmod($path, $mode)) {
        $msg = sprintf($adminLanguage->A_CMP_ME_PERMCHSUC, $mode);
        $reply=1;
    } else {
        $msg = $adminLanguage->A_CMP_ME_CHMODFAIL;
    }

    //@ob_end_clean();
    $mmanager->expired();
    echo '|'.$reply.'|'.$lic.'|'.$msg.'|';
    if ($reply) {
        if (is_dir($path)) {
            $mmanager->dirstatus($mmanager->file, $lic).'|';
        } else {
            $mmanager->filestatus($mmanager->file, $lic).'|';
        }
    }
    exit();
}


/******************/
/* UPLOAD FILE(S) */
/******************/
function media_upload() {
    global $mmanager, $fmanager;

    $size_str = @ini_get('upload_max_filesize');
    if ($size_str) {
        $i=0;
        while(ctype_digit($size_str[$i])) {
            $size .= $size_str[$i];
            $i++;
        }
        if ($size_str[$i]=="M"||$size_str[$i]=="m") {
            $size = $size*1024*1024;
        } else if ($size_str[$i]=="K"||$size_str[$i]=="k") {
            $size = $size*1024;
        } else {
            $size = 1024*1024*1024;
        }
    } else {
        $size = 2048*1024*1024;
    }

    $validFileTypes = array('gif', 'jpg', 'png', 'bmp', 'jpeg', 'mpg', 'avi', 'wmv', 'mov', 'flv', 
    'mpeg', 'asf', 'rm', 'nsv', 'xvid', 'mp3', 'wav', 'mid', 'ram', 'wma', 'ogg', 'aac', 'doc', 
    'xls', 'csv', 'ppt', 'swf', 'pdf', 'txt', 'zip', 'tar', 'rar', 'gz', 'tgz');
    $upfiles = $_FILES['upfile'];
    for ($i=0; $i<count($upfiles['name']); $i++) {
        if (($upfiles['name'][$i] == '') || ($upfiles['size'][$i] > $size)) { continue; }
        $source = $upfiles['tmp_name'][$i];
        if (!in_array($fmanager->fileExt($upfiles['name'][$i]), $validFileTypes)) { continue; }
        $dest = $mmanager->listdir.'/'.$upfiles['name'][$i];
        $fmanager->upload($source, $dest); //error: $fmanager->_last_error (ignore file exists)
    }

    mosRedirect('index2.php?option=com_media&reldir='.$mmanager->reldir);
    exit();
}


/**********************/
/* EXTRACT A ZIP FILE */
/**********************/
function extractZIP() {
    global $mmanager, $mosConfig_absolute_path, $adminLanguage;

    require_once($mosConfig_absolute_path.'/administrator/includes/pcl/pclzip.lib.php');
    $zipfile = $mmanager->listdir.'/'.$mmanager->file;

    @chdir($mmanager->listdir);
    if (is_file($zipfile)) {
        $path_parts = pathinfo($zipfile);
        if (strtolower($path_parts['extension']) == 'zip') {
            $zip = new PclZip($zipfile);
            $list = $zip->extract(".");
            if ($list > 0) {
                echo '<strong>'.count($list).'</strong> '.$adminLanguage->A_CMP_ME_FIEXTRD;
                echo ' <a href="index2.php?option=com_media&reldir='.$mmanager->reldir.'">'.$adminLanguage->A_CMP_ME_REFVIEW.'</a>';
            } else {
                echo '<strong>'.$adminLanguage->A_CMP_ME_UNERREXT.'</strong>';
            }
        } else {
            printf($adminLanguage->A_CMP_ME_FINOZIP, $mmanager->file);
        }
    } else {
        printf($adminLanguage->A_CMP_ME_FILNEX , $mmanager->file);
    }
    exit();
}


/*************************************/
/* VIEW AN IMAGE IN FULL SIZE (AJAX) */
/*************************************/
function previewImage() {
    global $fmanager, $mmanager, $mosConfig_live_site, $adminLanguage;

    if ($mmanager->file == '') {
        echo '<strong>'.$adminLanguage->A_CMP_ME_FSELFCL.'</strong>';
        exit();
    }
    if (!file_exists($mmanager->listdir.'/'.$mmanager->file)) {
        printf($adminLanguage->A_CMP_ME_FILNEX, $mmanager->file);
        exit();
    }

    $vexts = array('png', 'gif', 'jpeg', 'jpg', 'bmp');
    $ext = $fmanager->fileExt($mmanager->file);
    if (!in_array($ext, $vexts)) {
        echo '<strong>'.$adminLanguage->A_CMP_ME_SELFNIMG.'</strong> ('.$mmanager->file.')';
        exit();
    }

    $scrwidth = intval(mosGetParam($_POST, 'scrwidth', '1024')); //inner width
    $scrheight = intval(mosGetParam($_POST, 'scrheight', '768')); // inner height
    if (!$scrwidth) { $scrwidth = '1024'; }
    if (!$scrheight) { $scrheight = '768'; }
    $info = getimagesize($mmanager->listdir.'/'.$mmanager->file);

    $left = intval(($scrwidth - $info[0])/2) - 20;
    $top = intval(($scrheight - $info[1])/2) - 20;

    echo $adminLanguage->A_PREVIEW.': <strong>'.$mmanager->file.'</strong>'._LEND;
    echo '<div id="imgpreview" class="imgpreview" style="left: '.$left.'px; top: '.$top.'px;" />'._LEND;
    echo '<img src="'.$mosConfig_live_site.'/images'.$mmanager->reldir.'/'.$mmanager->file.'" width="'.$info[0].'" height="'.$info[1].'" border="0" alt="'.$mmanager->file.'" title="'.$mmanager->file.'" />'._LEND;
    echo '<br /><a href="javascript:void(0);" onclick="hideLayer(\'imgpreview\');" /><b>'.$adminLanguage->A_CLOSE.'</b></a>'._LEND;
    echo '</div>'._LEND;
    exit();
}


/*******************************/
/* PREVIEW A FLASH VIDEO (FLV) */
/*******************************/
function previewFLV() {
    global $fmanager, $mmanager, $mosConfig_live_site, $adminLanguage;

    if ($mmanager->file == '') {
        echo '<strong>'.$adminLanguage->A_CMP_ME_FSELFCL.'</strong>';
        exit();
    }
    if (!file_exists($mmanager->listdir.'/'.$mmanager->file)) {
        printf($adminLanguage->A_CMP_ME_FILNEX, $mmanager->file);
        exit();
    }

    $ext = $fmanager->fileExt($mmanager->file);
    if ($ext != 'flv') {
        echo '<strong>'.$adminLanguage->A_CMP_ME_SELFNFLV.'</strong> ('.$mmanager->file.')';
        exit();
    }

    $scrwidth = intval(mosGetParam($_POST, 'scrwidth', '1024')); //inner width
    $scrheight = intval(mosGetParam($_POST, 'scrheight', '768')); // inner height
    if (!$scrwidth) { $scrwidth = '1024'; }
    if (!$scrheight) { $scrheight = '768'; }

    $left = intval(($scrwidth - 460)/2) - 20;
    $top = intval(($scrheight - 380)/2) - 20;

    $vfile = $mosConfig_live_site.'/images'.$mmanager->reldir.'/'.$mmanager->file;
    $video = $mosConfig_live_site.'/mambots/content/flv/flvplayer.swf?file='.$vfile.'&autoStart=true';

	$code .= "<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\""
    ." codebase=\"http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0\""
    ." type=\"application/x-shockwave-flash\" width=\"400\" height=\"300\""
	." wmode=\"transparent\" data=\"".$video."\">"._LEND
    ."<param name=\"quality\" value=\"high\" />"._LEND
	."<param name=\"movie\" value=\"".$video."\">"._LEND
	."<param name=\"wmode\" value=\"transparent\">"._LEND
	."<embed src=\"".$video."\" quality=\"high\" width=\"400\" height=\"300\""
    ." name=\"flvplayer\" align=\"middle\" type=\"application/x-shockwave-flash\""
    ." pluginspage=\"http://www.macromedia.com/go/getflashplayer\" />"._LEND
	."</object>"._LEND;

    echo $adminLanguage->A_PREVIEW.': <b>'.$mmanager->file.'</b>'._LEND;
    echo '<div id="flvpreview" class="imgpreview" style="left: '.$left.'px; top: '.$top.'px;" />'._LEND;
	echo $code;
    echo '<br /><br /><a href="javascript:void(0);" onclick="hideLayer(\'flvpreview\');" /><b>'.$adminLanguage->A_CLOSE.'</b></a>'._LEND;
    echo '</div>'._LEND;
    exit();
}


/******************************************/
/******** LISTEN AN MP3 AUDIO FILE ********/
/* MP3 player by http://www.1pixelout.net */
/******************************************/
function listenMP3() {
    global $fmanager, $mmanager, $mosConfig_live_site, $adminLanguage;

    if ($mmanager->file == '') {
        echo '<strong>'.$adminLanguage->A_CMP_ME_FSELFCL.'</strong>';
        exit();
    }
    if (!file_exists($mmanager->listdir.'/'.$mmanager->file)) {
        printf($adminLanguage->A_CMP_ME_FILNEX, $mmanager->file);
        exit();
    }

    $ext = $fmanager->fileExt($mmanager->file);
    if ($ext != 'mp3') {
        echo '<strong>'.$adminLanguage->A_CMP_ME_SELFNMP3.'</strong> ('.$mmanager->file.')';
        exit();
    }

    $scrwidth = intval(mosGetParam($_POST, 'scrwidth', '1024')); //inner width
    $scrheight = intval(mosGetParam($_POST, 'scrheight', '768')); // inner height
    if (!$scrwidth) { $scrwidth = '1024'; }
    if (!$scrheight) { $scrheight = '768'; }

    $left = intval(($scrwidth - 360)/2) - 20;
    $top = intval(($scrheight - 200)/2) - 20;

    $mp3file = $mosConfig_live_site.'/images'.$mmanager->reldir.'/'.$mmanager->file;

    echo '<script type="text/javascript" src="'.$mmanager->urlbase.'/js/mp3player.js" /></script>'._LEND;
    echo $adminLanguage->A_CMP_ME_PLAY.': <b>'.$mmanager->file.'</b>'._LEND;
    echo '<div id="listenmp3" class="imgpreview" style="left: '.$left.'px; top: '.$top.'px;" />'._LEND;
    echo $adminLanguage->A_CMP_ME_PLAY.': <strong>'.$mmanager->file.'</strong><br /><br />'._LEND;
?>
    <object type="application/x-shockwave-flash" data="<?php echo $mmanager->urlbase; ?>/inc/mp3player.swf" width="290" height="24" id="audioplayer1">
    <param name="movie" value="<?php echo $mmanager->urlbase; ?>/inc/mp3player.swf" />
    <param name="FlashVars" value="playerID=1&amp;bg=0xCDDFF3&amp;leftbg=0x357DCE&amp;lefticon=0xF2F2F2&amp;rightbg=0xF06A51&amp;rightbghover=0xAF2910&amp;righticon=0xF2F2F2&amp;righticonhover=0xFFFFFF&amp;text=0x357DCE&amp;slider=0x357DCE&amp;track=0xFFFFFF&amp;border=0xFFFFFF&amp;loader=0xAF2910&amp;soundFile=<?php echo $mp3file; ?>" />
    <param name="quality" value="high" />
    <param name="menu" value="false" />
    <param name="bgcolor" value="#FFFFFF" /></object>
<?php 
    echo '<br /><br /><a href="javascript:void(0);" onclick="hideLayer(\'listenmp3\');" /><b>'.$adminLanguage->A_CLOSE.'</b></a>'._LEND;
    echo '</div>'._LEND;
    exit();
}


/******************************/
/* PREPARE TO RESIZE AN IMAGE */
/******************************/
function prepare_resize() {
    global $fmanager, $mmanager, $mosConfig_live_site, $adminLanguage;

    if ($mmanager->file == '') {
        echo '<strong>'.$adminLanguage->A_CMP_ME_FSELFCL.'</strong>';
        exit();
    }
    $path = $mmanager->listdir.'/'.$mmanager->file;
    if (!file_exists($path)) {
        printf($adminLanguage->A_CMP_ME_FILNEX, $mmanager->file);
        exit();
    }

    $ext = $fmanager->fileExt($mmanager->file);
    if (!in_array($ext, $mmanager->gdi)) {
        echo '<strong>'.$adminLanguage->A_CMP_ME_FINORES.'</strong>';
        exit();
    }

    $info = @getimagesize($path);
    $scrwidth = intval(mosGetParam($_POST, 'scrwidth', '1024')); //inner width
    $scrheight = intval(mosGetParam($_POST, 'scrheight', '768')); // inner height
    if (!$scrwidth) { $scrwidth = '1024'; }
    if (!$scrheight) { $scrheight = '768'; }
    $info = getimagesize($mmanager->listdir.'/'.$mmanager->file);

    $left = intval(($scrwidth - $info[0])/2) - 20;
    $top = intval(($scrheight - $info[1])/2) - 20;

    echo $adminLanguage->A_CMP_ME_RESIZE.': <strong>'.$mmanager->file.'</strong>'._LEND;
    echo '<div id="imgresize" class="imgpreview" style="left: '.$left.'px; top: '.$top.'px; text-align:center;" />'._LEND;
    //echo '<form name="fmresizeimg" id="fmresizeimg" action="index3.php" method="POST">'._LEND; //stupid IE
    echo '<img src="'.$mosConfig_live_site.'/images'.$mmanager->reldir.'/'.$mmanager->file.'" width="'.$info[0].'" height="'.$info[1].'" border="0" alt="'.$mmanager->file.'" title="'.$mmanager->file.'" /><br /><br />'._LEND;
    echo $adminLanguage->A_CMP_ME_RESTO.': '._LEND;
    echo '<input type="text" size="5" maxlength="4" id="reswidth" name="reswidth" value="'.$info[0].'" class="inputbox" /> px <b>X</b> '._LEND;
    echo '<input type="text" size="5" maxlength="4" id="resheight" name="resheight" value="'.$info[1].'" class="inputbox" /> px '._LEND;
    echo '<input type="button" id="goresize" name="goresize" value="'.$adminLanguage->A_GO.'" class="button" onclick="return mm_doresize();" /><br />'._LEND;
    echo $adminLanguage->A_CMP_ME_KEEPRAT.': ';
    echo '<input type="checkbox" id="keepratio" name="keepratio" value="1" checked /> <small>('.$adminLanguage->A_CMP_ME_BASEWID.')</small><br /><br />'._LEND;
    echo '<a href="javascript:void(0);" onclick="hideLayer(\'imgresize\');" /><b>'.$adminLanguage->A_CLOSE.'</b></a>'._LEND;
    //echo '</form>'._LEND; //stupid IE
    echo '</div>'._LEND;
    exit();
}


/************************/
/* PERFORM IMAGE RESIZE */
/************************/
function media_resize() {
    global $fmanager, $mmanager, $mosConfig_live_site, $adminLanguage;

    if ($mmanager->file == '') {
        echo '<strong>'.$adminLanguage->A_CMP_ME_FSELFCL.'</strong>';
        exit();
    }
    $path = $mmanager->listdir.'/'.$mmanager->file;
    if (!file_exists($path)) {
        printf($adminLanguage->A_CMP_ME_FILNEX, $mmanager->file);
        exit();
    }

    $ext = $fmanager->fileExt($mmanager->file);
    if (!in_array($ext, $mmanager->gdi)) {
        echo '<strong>'.$adminLanguage->A_CMP_ME_FINORES.'</strong>';
        exit();
    }

    $reswidth = intval(mosGetParam($_POST, 'reswidth', 0));
    $resheight = intval(mosGetParam($_POST, 'resheight', 0));
    $keepratio = intval(mosGetParam($_POST, 'keepratio', 0));

    if ($reswidth < 1) {
        echo '<strong>'.$adminLanguage->A_CMP_ME_INVWNIMG.'</strong>';
        exit();
    }

    $fmanager->spChmod($path, '0666');
    $info = @getimagesize( $path );
    if ($keepratio) { $resheight = intval(($reswidth * $info[1])/$info[0]); } 
    if ($resheight < 1) {
        echo '<strong>'.$adminLanguage->A_CMP_ME_INVHNIMG.'</strong>';
        exit();
    }

    if ($ext == 'jpg' || $ext == 'jpeg')  {
        $img = @imagecreatefromjpeg($path);
    } else if ($ext == 'png') {
        $img = @imagecreatefrompng($path);
    } else if ($ext == 'gif') {
        $img = @imagecreatefromgif($path);
    }

    if (!$img){
        echo '<strong>'.$adminLanguage->A_CMP_ME_CNOTRESIMG.'</strong>';
        exit();
    }

    $dst_img = @imagecreatetruecolor($reswidth, $resheight);
    @imagecopyresampled($dst_img, $img, 0, 0, 0, 0, $reswidth, $resheight, $info[0], $info[1]);
    @imagedestroy($img);

    $ok = 0;
    if ($ext == 'jpg' || $ext == 'jpeg')  {
      $ok = @imagejpeg($dst_img, $path, 80);
    } else if ($ext == 'png')  {
      $ok = @imagepng($dst_img, $path);
    } else if ($ext == 'gif') {
      $ok = @imagegif($dst_img, $path);
    }
    @imagedestroy($dst_img);

    if ($ok) {
        $fmanager->spChmod($path, '0666');
        $mmanager->expired();        
        echo $adminLanguage->A_CMP_ME_IMGRESSUC;
    } else {
        echo '<strong>'.$adminLanguage->A_CMP_ME_CNOTRESIMG.'</strong>';
    }
    exit();
}


/*********************/
/* PREPARE WATERMARK */
/*********************/
function prepare_watermark() {
    global $fmanager, $mmanager, $mosConfig_live_site, $adminLanguage;

    $errstart = '<p align="center"><strong>'.$adminLanguage->A_CMP_ME_WATERMARK.'</strong><br /><br />'._LEND;
    $errend = _LEND.'<br /><br /><a href="javascript:window.close();">'.$adminLanguage->A_CLOSE.'</a></p>';

    if ($mmanager->file == '') {
        echo $errstart.'<strong>'.$adminLanguage->A_CMP_ME_FSELFCL.'</strong>'.$errend;
        exit();
    }

    $path = $mmanager->listdir.'/'.$mmanager->file;
    if (!file_exists($path)) {
        echo $errstart;
        printf($adminLanguage->A_CMP_ME_FILNEX, $mmanager->file);
        echo $errend;
        exit();
    }

    $ext = $fmanager->fileExt($mmanager->file);
    if (!in_array($ext, $mmanager->gdi)) {
        echo $errstart.'<strong>'.$adminLanguage->A_CMP_ME_CNOTWATERF.'</strong>'.$errend;
        exit();
    }

    $info = @getimagesize($path);
    $width = $info[0];
    $height = $info[1];

    $mmanager->importCSS();
    $mmanager->watermarkJS();
?>

    <form name="adminForm" action="index3.php" method="POST" target="_self">
        <input type="hidden" name="option" value="com_media" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="reldir" value="<?php echo $mmanager->reldir; ?>" />
        <input type="hidden" name="file" value="<?php echo $mmanager->file; ?>" />
        <input type="hidden" name="fileas" value="<?php echo $mmanager->file; ?>" />
        <input type="hidden" name="dirurl" id="dirurl" value="<?php echo $mosConfig_live_site.'/images'; ?>" />
        <input type="hidden" name="dirabs" id="dirabs" value="<?php echo $mmanager->homedir; ?>" />
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td align="left">
                    <?php echo '<img src="'.$mosConfig_live_site.'/images'.$mmanager->reldir.'/'.$mmanager->file.'" width="'.$width.'" height="'.$height.'" border="0" alt="'.$mmanager->file.'" title="'.$mmanager->file.'" />'; ?>
                    <div id="wmdiv" style="position: absolute; top: 10px; left: 10px; z-index: 10; font-family: Verdana, Tahoma, Arial; font-size: 12px; color: #000000;"><?php echo $adminLanguage->A_CMP_ME_TEXT; ?>...</div>
                    <div id="wmidiv" style="position: absolute; top: 10px; left: 10px; z-index: 20;"></div>
                </td>
            </tr>
        </table>
        <br />

        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="wmtable">
            <tr>
                <th colspan="2"><?php echo $adminLanguage->A_CMP_ME_WATERMARK; ?>: <?php echo $mmanager->file; ?></th>
            </tr>
            <tr class="rowa">
                <td width="140"><b><?php echo $adminLanguage->A_TYPE; ?>:</b></td>
                <td><?php echo $adminLanguage->A_CMP_ME_TEXT; ?> <input type="radio" name="textimg" value="text" checked="checked" onclick="mm_wmswitchtype(0)" /> &nbsp; 
                     <?php echo $adminLanguage->A_IMAGE; ?> <input type="radio" name="textimg" value="image" onclick="mm_wmswitchtype(1)" />
                </td>
            </tr>
            <tr class="rowa">
                <td width="140"><b><?php echo $adminLanguage->A_CMP_ME_WATERPOS; ?>:</b></td>
                <td><?php echo $adminLanguage->A_CMP_ME_XAXIS; ?> <input type="text" name="xaxis" id="xaxis" value="10" size="4" maxlength="5" class="inputbox" onchange="mm_moveWatermark()" /> 
                    <?php echo $adminLanguage->A_CMP_ME_YAXIS; ?> <input type="text" name="yaxis" id="yaxis"value="10" size="4" maxlength="5" class="inputbox" onchange="mm_moveWatermark()" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="istextdiv" style="padding: 0; margin: 0;">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="wmtable">
                            <tr class="rowb">
                                <td width="140"><b><?php echo $adminLanguage->A_CMP_ME_TEXT; ?>:</b></td>
                                <td><input type="text" name="wmtext" id="wmtext" size="50" value="<?php echo $adminLanguage->A_CMP_ME_TEXT; ?>..." class="inputbox" onchange="mm_changeWatermark()" /></td>
                            </tr>
                            <tr class="rowb">
                                <td width="140"><b><?php echo $adminLanguage->A_CMP_ME_FONT; ?>:</b></td>
                                <td><?php echo $adminLanguage->A_CMP_ME_SIZE; ?> 
                                    <select name="wmfontsize" id="wmfontsize" class="inputbox" onchange="mm_sizeWatermark()">
                                        <option value="8">8 px</option>
                                        <option value="9">9 px</option>
                                        <option value="10">10 px</option>
                                        <option value="11">11 px</option>
                                        <option value="12" selected="selected">12 px</option>
                                        <option value="13">13 px</option>
                                        <option value="14">14 px</option>
                                        <option value="15">15 px</option>
                                        <option value="16">16 px</option>
                                        <option value="18">18 px</option>
                                        <option value="20">20 px</option>
                                        <option value="24">24 px</option>
                                        <option value="30">30 px</option>
                                        <option value="36">36 px</option>
                                        <option value="42">42 px</option>
                                        <option value="50">50 px</option>
                                        <option value="60">60 px</option>
                                        <option value="70">70 px</option>
                                    </select> 
                                    <?php echo $adminLanguage->A_CMP_ME_COLOR; ?> 
                                    <select name="wmfontcolor" id="wmfontcolor" class="inputbox" onchange="mm_colorWatermark()">
                                        <option value="0,0,0" selected="selected"><?php echo $adminLanguage->A_CMP_ME_BLACK; ?></option>
                                        <option value="255,255,255"><?php echo $adminLanguage->A_CMP_ME_WHITE; ?></option>
                                        <option value="255,0,0"><?php echo $adminLanguage->A_CMP_ME_RED; ?></option>
                                        <option value="46,55,237"><?php echo $adminLanguage->A_CMP_ME_BLUE; ?></option>
                                        <option value="255,153,0"><?php echo $adminLanguage->A_CMP_ME_ORANGE; ?></option>
                                        <option value="251,238,91"><?php echo $adminLanguage->A_CMP_ME_YELLOW; ?></option>
                                        <option value="41,195,29"><?php echo $adminLanguage->A_CMP_ME_GREEN; ?></option>
                                        <option value="170,170,170"><?php echo $adminLanguage->A_CMP_ME_GRAY; ?></option>
                                        <option value="221,221,221"><?php echo $adminLanguage->A_CMP_ME_LGRAY; ?></option>
                                    </select> 
                                    <?php echo $adminLanguage->A_CMP_ME_SHADOW; ?> 
                                    <select name="wmshadow" id="wmshadow" class="inputbox">
                                        <option value="" selected="selected"><?php echo $adminLanguage->A_CMP_ME_NOSHADOW; ?></option>                                    
                                        <option value="black"><?php echo $adminLanguage->A_CMP_ME_BLACK; ?></option>
                                        <option value="white"><?php echo $adminLanguage->A_CMP_ME_WHITE; ?></option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="isimagediv" style="display: none; padding: 0; margin: 0;">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="wmtable">
                            <tr class="rowb">
                                <td width="140"><b><?php echo $adminLanguage->A_IMAGE; ?>:</b></td>
                                <td><input type="text" name="wmimage" id="wmimage" dir="ltr" size="50" value="" class="inputbox" onchange="mm_changeiWatermark()" /></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr class="rowa">
                <td width="140"><b><?php echo $adminLanguage->A_CMP_ME_OPACITY; ?>:</b></td>
                <td>
                    <select name="wmopacity" id="wmopacity" class="inputbox" onchange="mm_changeOpacity()">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="60">60</option>
                        <option value="70">70</option>
                        <option value="80">80</option>
                        <option value="90">90</option>
                        <option value="100" selected="selected">100</option>
                    </select>
                </td>
            </tr>
            <tr class="rowa">
                <td width="140"><b><?php echo $adminLanguage->A_CMP_ME_IMGQUAL; ?>:</b></td>
                <td><select name="quality" id="quality" class="inputbox">
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="60">60</option>
                        <option value="70">70</option>
                        <option value="80" selected="selected">80</option>
                        <option value="90">90</option>
                        <option value="100">100</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><br />
                    <input type="button" name="preview" value="<?php echo $adminLanguage->A_PREVIEW; ?>" class="button" onclick="submitwmform('wmpreview');" /> 
                    <input type="button" name="save" value="<?php echo $adminLanguage->A_SAVE; ?>" class="button" onclick="submitwmform('wmsave');" /> 
                    <input type="button" name="savenew" value="<?php echo $adminLanguage->A_CMP_ME_SAVEAS; ?>" class="button" onclick="submitwmform('wmsaveas');" /><br /><br />
                    <a href="javascript:window.close();" /><b><?php echo $adminLanguage->A_CLOSE; ?></b></a>
                </td>
            </tr>
        </table>
    </form>
<?php 
}


/******************/
/* SAVE WATERMARK */
/******************/
function save_watermark($act=0) {
    global $mmanager, $fmanager, $mosConfig_absolute_path, $adminLanguage;

    $errstart = '<p align="center"><b>'.$adminLanguage->A_CMP_ME_WATERMARK.'</b><br /><br />'._LEND;
    $errend = _LEND.'<br /><br /><a href="javascript:window.close();">'.$adminLanguage->A_CLOSE.'</a></p>';

    if ($mmanager->file == '') {
        echo $errstart.'<strong>'.$adminLanguage->A_CMP_ME_FSELFCL.'</strong>'.$errend;
        exit();
    }

    if (!file_exists($mmanager->listdir.'/'.$mmanager->file)) {
        echo $errstart;
        printf($adminLanguage->A_CMP_ME_FILNEX, $mmanager->file);
        echo $errend;
        exit();
    }

    if (!in_array($fmanager->fileExt($mmanager->file), $mmanager->gdi)) {
        echo $errstart.'<strong>'.$adminLanguage->A_CMP_ME_CNOTWATERF.'</strong>'.$errend;
        exit();
    }

    $savedir = $mmanager->listdir.'/';
    if ($act == 2) {
        @ob_end_clean();
        $savedir = $fmanager->fwslashes($mosConfig_absolute_path.'/tmpr/');
    }

    $watertype = mosGetParam($_POST, 'textimg', 'text');
    $xaxis = intval(mosGetParam($_POST, 'xaxis', 10));
    $yaxis = intval(mosGetParam($_POST, 'yaxis', 10));
    $fileas = eUTF::utf8_trim(mosGetParam($_POST, 'fileas', ''));
    $wmopacity = intval(mosGetParam($_POST, 'wmopacity', 100));
    $quality = intval(mosGetParam($_POST, 'quality', 80));

    require_once($mmanager->absbase.'/inc/watermark.class.php');
    $file = $mmanager->listdir.'/'.$mmanager->file;
    $foto = new watermark($file, $watertype, $xaxis, $yaxis);
    $foto->savedir = $savedir;

    $foto->filename = $mmanager->file;
    if (($fileas != '') && ($fileas != $mmanager->file)) {
        $ext1 = $fmanager->fileExt($mmanager->file);
        $ext2 = $fmanager->fileExt($fileas);
        if ($ext1 != $ext2) {
            echo $errstart.'<strong>'.$adminLanguage->A_CMP_ME_NEWFDIFOLD.'</strong>'.$errend;
            exit();
        }
        if (($act == 1) && (file_exists($mmanager->listdir.'/'.$fileas))) {
            echo $errstart;
            printf($adminLanguage->A_CMP_ME_EXFINAME, $fileas);
            echo $errend;
            exit();
        }
        $foto->filename = $fileas;
    }

    if ($watertype == 'text') {
        //$foto->font = $mmanager->absbase.'/inc/verdana.ttf'; //you may change font if you like
        $wmtext = eUTF::utf8_trim(mosGetParam($_POST, 'wmtext', ''));
        $wmfontsize = intval(mosGetParam($_POST, 'wmfontsize', 12));
        $wmfontcolor = trim(mosGetParam($_POST, 'wmfontcolor','0,0,0'));
        $foto->fontcolor = explode(',', $wmfontcolor);
        $foto->quality = $quality;
        $wmshadow = mosGetParam($_POST, 'wmshadow','');

        $prev = ($act == 2) ? true : false;
        $foto->textmark($wmtext, $wmfontsize, true, $prev, $wmshadow, $wmopacity);
    } else {
        $wmimage = trim(mosGetParam($_POST, 'wmimage', ''));
        $wmimage = preg_replace('/^([\/])/', '', $wmimage);
        
        if (($wmimage == '') || (!file_exists($mmanager->homedir.'/'.$wmimage))) {
            echo $errstart.'<strong>'.$adminLanguage->A_CMP_ME_OVERIMGNEX.'</strong>'.$errend;
            exit();
        }
        $wmimage = $mmanager->homedir.'/'.$wmimage;
        $foto->quality = $quality;
        $prev = ($act == 2) ? true : false;
        $foto->imagemark($wmimage, true, $prev, $wmopacity);
    }

    if ($act == 2) {
        if ($foto->_error) { die('error creating picture'); }
        echo '<img src="'.$foto->outfile.'" border="0" />';
        exit();
    } else {
        if ($foto->_error) {
            echo $errstart.$adminLanguage->A_CMP_ME_CNOTGENWAT.$errend;
        } else {
            echo $errstart.$adminLanguage->A_CMP_ME_WATERGENSUC.$errend;
        }
    }
}

?>
