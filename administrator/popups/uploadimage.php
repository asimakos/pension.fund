<?php 
/**
* @version: $Id: uploadimage.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: PopUps
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @description: Popup window for uploading images
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

/** Set flag that this is a parent file */
define( '_VALID_MOS', 1 );
/** Mostly used to tell loader to include adminLanguage */
define( '_ELXIS_ADMIN', 1 );

$elxis_root = str_replace('/administrator/popups', '', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));
require($elxis_root.'/administrator/includes/auth.php');

$directory = mosGetParam($_REQUEST, 'directory', '');

$userfile2=(isset($_FILES['userfile']['tmp_name']) ? $_FILES['userfile']['tmp_name'] : "");
$userfile_name=(isset($_FILES['userfile']['name']) ? $_FILES['userfile']['name'] : "");

if (isset($_FILES['userfile'])) {
    if ( $directory == "screenshots" ) {
        $base_Dir = $elxis_root.'/images/screenshots/';
    } elseif ($directory!="banners") {
		$base_Dir = $elxis_root.'/images/stories/';
	} else {
		$base_Dir = $elxis_root.'/images/banners/';
	}

	if (empty($userfile_name)) {
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_ALERT_IMAGE_UPLOAD."'); document.location.href='uploadimage.php';</script>";
		exit();
	}

	$filename = preg_split('/\./', $userfile_name);

	if (preg_match('/[^0-9a-zA-Z_]/i', $filename[0])) {
		echo '<script type="text/javascript">alert(\''.$adminLanguage->A_ALERT_ALPHA.'\'); window.history.go(-1);</script>'."\n";
		exit();
	}

	if (file_exists($base_Dir.$userfile_name)) {
		echo '<script type="text/javascript">alert(\''.$adminLanguage->A_ALERT_IMAGE_EXISTS.' '.$userfile_name.'\'); window.history.go(-1);</script>'."\n";
		exit();
	}

    //all types are 4letter length(dot included), so lets work this way:
    $xftype = eUTF::utf8_strtolower(eUTF::utf8_substr($userfile_name,-4));
    $validftypes = array ('.gif', '.jpg', '.png', '.bmp', '.doc', '.xls', '.ppt', '.swf', '.pdf');
    
    if (!in_array($xftype, $validftypes)) {
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_ALERT_IMAGE_FILENAME."'); window.history.go(-1);</script>\n";
		exit();
	}

    if (($xftype == '.pdf') || ($xftype == '.doc') || ($xftype == '.xls') || ($xftype == '.ppt')) {
		if (!move_uploaded_file ($_FILES['userfile']['tmp_name'],$media_path.$_FILES['userfile']['name']) || !$fmanager->eChmod($media_path.$_FILES['userfile']['name'])) {
			echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_ALERT_UPLOAD_FAILED." ".$userfile_name."'); window.history.go(-1);</script>\n";
			exit();
		}
		else {
			echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_ALERT_UPLOAD_SUC." ".$userfile_name." ".$adminLanguage->A_TO." ".$media_path."'); window.history.go(-1);</script>\n";
			exit();
		}
	} elseif (!move_uploaded_file ($_FILES['userfile']['tmp_name'],$base_Dir.$_FILES['userfile']['name']) || !$fmanager->eChmod($base_Dir.$_FILES['userfile']['name'])) {
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_ALERT_UPLOAD_FAILED." ".$userfile_name."'); window.history.go(-1);</script>\n";
		exit();
	}
	else {
		echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_ALERT_UPLOAD_SUC." ".$userfile_name." ".$adminLanguage->A_TO." ".$base_Dir."'); window.history.go(-1);</script>\n";
		exit();
	}
}

$iso = preg_split('/\=/', _ISO);
$rtl = (_GEM_RTL == 1) ? ' dir="rtl"' : '';
$tpl = mosGetParam($_REQUEST,'t','');
if ($tpl == '') { $tpl = $mainframe->getTemplate(); }

echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>'._LEND;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $adminLanguage->A_XML_LANGUAGE; ?>" xml:lang="<?php echo $adminLanguage->A_XML_LANGUAGE; ?>"<?php echo $rtl; ?>>
<head>
<title><?php echo $adminLanguage->A_UPLOADAFILE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="Generator" content="Elxis - (C) Copyright 2006-<?php echo date('Y'); ?> Elxis.org.  All rights reserved." />
<link rel="stylesheet" type="text/css" href="../templates/admin/<?php echo $tpl; ?>/css/template_css<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.css" />
</head>
<body>
<table class="adminform">
  <form method="post" action="uploadimage.php" enctype="multipart/form-data" name="filename">
    <tr>
      <th class="title"><?php echo $adminLanguage->A_FILEUPLOAD; ?> : <?php echo $directory; ?></th>
    </tr>
    <tr>
      <td align="center">
        <input class="inputbox" name="userfile" type="file" dir="ltr" />
      </td>
    </tr>
    <tr>
      <td>
        <input class="button" type="submit" value="<?php echo $adminLanguage->A_UPLOAD; ?>" name="fileupload" />
        Max size = <?php echo ini_get( 'post_max_size' ); ?>
      </td>
    <tr>
      <td>
        <input type="hidden" name="directory" value="<?php echo $directory; ?>" />
      </td>
    </tr>
  </form>
</table>
</body>
</html>