<?php 
/**
* @version: $Id: thumb.php 2555 2009-10-07 05:16:20Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Media
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

define('_VALID_MOS', 1);


$elxis_root = str_replace('/administrator/components/com_media/inc', '', str_replace( DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));

if (!isset($_GET['img'])) { die(); }
$src_file = urldecode($_GET['img']);
$src_file = str_replace( '\\', '/', $src_file );
$src_file = preg_replace('/(\.\.)/', '', $src_file);
if (preg_match('/http/i', $src_file)) { exit(); }
if (preg_match('/mosConfig/i', $src_file)) { exit(); }

if (!file_exists($src_file)) { die(); }
if (!preg_match('#^'.$elxis_root.'\/images\/#', $src_file)) { die(); }

$vexts = array('gif', 'jpeg', 'jpg', 'png', 'wbmp', 'bmp');
$ext = substr(strrchr($src_file, '.'), 1);
if (preg_match('/\//', $ext)) { $ext = ''; }
$ext = strtolower($ext);
if (($ext == '') || !in_array($ext, $vexts)) { die(); }

$OS = strtoupper(substr(PHP_OS, 0, 3));
if (!extension_loaded('gd')) {
    if ($OS === 'WIN') {
        @dl('php_gd2.dll');
        //@dl('php_gd.dll');
    } else {
        @dl('gd2.so');
        //@dl('gd.so');
    }
}

$ibase = $elxis_root.'/administrator/components/com_media/images';

if (!extension_loaded('gd')) {
	@header("Content-type: image/png");
    print file_get_contents($ibase.'/nogd.png');
    die();
}

$imginfo = @getimagesize($src_file);
if (!$imginfo) { die(); }

$srcX = $imginfo[0];
$srcY = $imginfo[1];
$type = $imginfo[2];

if ($srcX < '48') { $destX = $srcX; } else { $destX = '48'; }
if ($srcY < '48') { $destY = $srcY; } else { $destY = '48'; }

if (filesize($src_file) > 1000000) {
    @header("Content-type: image/png");
	print file_get_contents($ibase.'/exceeds.png');
	die();
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
        die();
        break;
}

$destImage = imagecreatetruecolor(48, 48);
$white= imagecolorallocate($destImage, 255, 255, 255);
imagefill( $destImage, 0, 0, $white);

imagecopyresampled($destImage, $srcImage, (48-$destX)/2, (48-$destY)/2, 0, 0,  $destX, $destY, $srcX, $srcY);
$grey = imagecolorallocate($destImage, 175, 175, 175);
imagerectangle($destImage, 0, 0, 47, 47, $grey);

if (function_exists("imagegif")) {
    @header("Content-type: image/gif");
    @imagegif($destImage);
}elseif (function_exists("imagejpeg")) {
    @header("Content-type: image/jpeg");
    @imagejpeg($destImage, "", 30);
} elseif (function_exists("imagepng")) {
    @header("Content-type: image/png");
    @imagepng($destImage);
} elseif (function_exists("imagewbmp")) {
    @header("Content-type: image/vnd.wap.wbmp");
    @imagewbmp($destImage);
} else {
    @header("Content-type: image/png");
    print file_get_contents($ibase.'/nogd.png');
}

@imagedestroy($srcImage);
@imagedestroy($destImage);
@imagedestroy($image);

?>