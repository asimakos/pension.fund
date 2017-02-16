<?php 
/**
* @ Version: $Id: mod_alanguage.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Module Admin Language
* @ Author: Ioannis Sannos
* @ URL: http://www.elxis.org
* @ Email: datahell@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $adminLanguage, $elxis_language, $alang, $mosConfig_absolute_path, $option, $task;

$Lurl = 'index2.php?option='.$option;
if (isset($task) && ($task != '')) { $Lurl .= '&task='.$task; }
if (isset($_REQUEST['scope']) && ($_REQUEST['scope'] != '')) { $Lurl .= '&scope='.$_REQUEST['scope']; }
if (isset($_REQUEST['section']) && ($_REQUEST['section'] != '')) { $Lurl .= '&section='.$_REQUEST['section']; }
if (isset($_REQUEST['element']) && ($_REQUEST['element'] != '')) { $Lurl .= '&element='.$_REQUEST['element']; }

$adLangs = $elxis_language->displayLangs();
?>
<script language="javascript" type="text/javascript">
<!--
function changeaLang(lang) {
    if (lang == '') { return false; }
    var url = '<?php echo $Lurl; ?>';
    document.location.href=url+'&mylang='+lang;
}
//-->
</script>

<strong><?php echo $adminLanguage->A_LANGUAGE; ?></strong> 
<a href="javascript:void(0);" onclick="javascript:showLayer('modaLanguage')" title="<?php echo $adminLanguage->A_LANGUAGE; ?>">
<img src="images/downarrow2.png" alt="<?php echo $adminLanguage->A_LANGUAGE; ?>" border="0" /></a>
<div id="modaLanguage" class="langbox" style="display:none;">
    <div class="langboxtop"><?php echo $adminLanguage->A_LANGUAGE; ?></div>
<?php 
foreach ($adLangs as $langx) {
    $Lclass = ($langx == $alang) ? 'langrowX' : 'langrow';
    echo '<div class="'.$Lclass.'" onclick="javascript: changeaLang(\''.$langx.'\');" >';
    if (file_exists($mosConfig_absolute_path.'/administrator/language/'.$langx.'/'.$langx.'.gif')) {
        echo '<img src="language/'.$langx.'/'.$langx.'.gif" border="0" align="top" alt="'.$langx.'" />'._LEND;
    }
    echo ($langx == $alang) ? '<strong>'.$langx.'</strong>' : $langx;
    echo '</div>'._LEND;
}
unset($Lurl);
unset($Lclass);
?>
    <div class="filterbottom">
        <a href="javascript:void(0);" onclick="javascript:hideLayer('modaLanguage');"><?php echo $adminLanguage->A_CLOSE; ?></a>
    </div>
</div>
