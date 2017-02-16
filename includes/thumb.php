<?php
/**
* @ Version: $Id: thumb.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Module Frontpage
* @ Author: Ioannis Sannos (datahell)
* @ URL: http://www.elxis.org
* @ E-mail: info@goup.gr
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @ Description: Generates a thumbnail for module Frontpage
* @ fi params (base64_encoded):
w = thumbnail width in pixels
h = thumbnail height in pixels
keepration = 1/0, whether to keep aspect ratio or not
img = path to image relative to site root dir
Example:
$_GET['fi'] = base64_encode('64,64,0,images/logo.png');
*/

//elxis root dir absolute path
$elxis_root = str_replace('/includes', '', str_replace( DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));

function defImage($elxis_root) {
	@ob_end_clean();
	@header("Content-type: image/png");
    @print file_get_contents($elxis_root.'/images/M_images/story.png');
    die();
}

/****************** extra security start *******************
if (!isset($_GET['sk')) { echo defImage($elxis_root); }
require_once($elxis_root.'/configuration.php');
if (md5($mosConfig_secret) != $_GET['sk') { defImage($elxis_root); }
//hmmm... Theoretically someone could get the md5 value of the secret key and crack it using an md5 crack machine
//Better leave it. I think script is secure enough
******************* extra security end *******************/

if (!isset($_GET['fi'])) { defImage($elxis_root); }
$fi = base64_decode(urldecode($_GET['fi']));
$fi = str_replace( '\\', '/', $fi );
$fi = preg_replace('/(\.\.)/', '', $fi);
$fi = preg_replace("#[^a-zA-Z\.\/0-9-\,_]#", '', $fi);
if ($fi == '') { defImage($elxis_root); }

$arr = preg_split('/\,/',$fi);
if (count($arr) != 4) { defImage($elxis_root); }

$width = intval($arr[0]);
$height = intval($arr[1]);
$keepratio = intval($arr[2]);
$img = $arr[3];

if (($width < 10) || ($width > 250)) { $width = 64; }
if (($height < 10) || ($height > 250)) { $height = 64; }

//validate image extension
$vexts = array('gif', 'jpeg', 'jpg', 'png', 'wbmp', 'bmp');
$ext = substr(strrchr($img, '.'), 1);
if (preg_match('/\//', $ext)) { $ext = ''; }
$ext = strtolower($ext);
if (($ext == '') || !in_array($ext, $vexts)) { defImage($elxis_root); }

//full path to image
$src_file = $elxis_root.'/'.$img;

if (!file_exists($src_file)) { defImage($elxis_root); }

//load GD if possible...
$OS = strtoupper(substr(PHP_OS, 0, 3));
if (!extension_loaded('gd')) {
    if ($OS === 'WIN') {
        @dl('php_gd2.dll');
    } else {
        @dl('gd2.so');
    }
}

if (!@extension_loaded('gd')) { defImage($elxis_root); }

$imginfo = @getimagesize($src_file);
if (!$imginfo) { defImage($elxis_root); }

$srcX = $imginfo[0];
$srcY = $imginfo[1];
$type = $imginfo[2];

if ($keepratio) {
	$height = intval(($width * $srcY)/$srcX);	
}

switch($type) {
    case 1:
        if (function_exists('imagecreatefromgif')) { $srcImage = imagecreatefromgif($src_file); }
    break;
    case 2:
        if( function_exists('imagecreatefromjpeg')) { $srcImage = imagecreatefromjpeg($src_file); }
    break;
    case 3:
        if (function_exists('imagecreatefrompng')) { $srcImage = imagecreatefrompng($src_file); }
       break;
    case 15:
        if (function_exists('imagecreatefromwbmp')) { $srcImage = imagecreatefromwbmp($src_file); }
    break;
    default:
        defImage($elxis_root);
    break;
}

if (!isset($srcImage)) { defImage($elxis_root); }

$destImage = imagecreatetruecolor($width, $height);
$white= imagecolorallocate($destImage, 255, 255, 255);
imagefill( $destImage, 0, 0, $white);
imagecopyresampled($destImage, $srcImage, 0, 0, 0, 0,  $width, $height, $srcX, $srcY);

switch($type) {
    case 1:
    	if (function_exists("imagegif")) {
    		@ob_end_clean();
			@header("Content-type: image/gif");
			@imagegif($destImage);
        } else {
        	defImage($elxis_root);
        }
    break;
    case 2:
    	if (function_exists("imagejpeg")) {
    		@ob_end_clean();
			@header("Content-type: image/jpeg");
			@imagejpeg($destImage, '', 60);
        } else {
    		defImage($elxis_root);
        }
    break;
    case 3:
    	if (function_exists("imagepng")) {
    		@ob_end_clean();
			@header("Content-type: image/png");
			@imagepng($destImage);
        } else {
    		defImage($elxis_root);
        }
       break;
    case 15:
		if (function_exists("imagewbmp")) {
			@ob_end_clean();
			@header("Content-type: image/vnd.wap.wbmp");
			@imagewbmp($destImage);
		} else {
			defImage($elxis_root);
		}
    break;
    default:
		defImage($elxis_root);
    break;
}

@imagedestroy($srcImage);
@imagedestroy($destImage);
@imagedestroy($image);

?>
