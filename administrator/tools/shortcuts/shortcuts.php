<?php 
/**
* @version: $Id: shortcuts.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Shortcuts tool
* @author: Ioannis Sannos
* @email: datahell@elxis.org
* @link: http://www.elxis.org
* @description: Manages personal shortcuts in control panel
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $mosConfig_absolute_path, $alang;
$shortbase = $mosConfig_absolute_path.'/administrator/tools/shortcuts/';
if (file_exists( $shortbase.'language/'.$alang.'.php')) {
    include_once( $shortbase.'language/'.$alang.'.php' );
} else {
    include_once( $shortbase.'language/english.php' );
}

$act = mosGetParam($_REQUEST, 'act', '');
$id = intval(mosGetParam($_REQUEST, 'id', 0));
switch ($act) {
    case 'delete':
        tshortcuts_delete($id);
    break;
    case 'add':
        tshortcuts_edit(0);
    break;
    case 'edit':
        tshortcuts_edit($id);
    break;
    case 'save':
        tshortcuts_save($id);
    break;
    default:
    case 'view':
        tshortcuts_view();
    break;
}


/******************/
/* VIEW SHORTCUTS */
/******************/
function tshortcuts_view() {
    global $my, $database, $adminLanguage;

    $rows = array();

    $likename = 'SC_NAME_'.$my->id.'_';
    $query = "SELECT sdname, sdvalue, lastmodified FROM #__softdisk WHERE sdsection='SHORTCUTS' AND sdhidden='1' AND sdname LIKE '".$likename."%'";
    $database->setQuery($query);
    $nlines = $database->loadRowList();

    $i = 0;
    if (count($nlines) > 0) {
        foreach ($nlines as $nline) {
            $rows[$i]['id'] = intval(str_replace($likename, '', $nline['sdname']));
            $rows[$i]['name'] = $nline['sdvalue'];
            $rows[$i]['lastmodified'] = $nline['lastmodified'];

            $pubname = 'SC_PUBLIC_'.$my->id.'_'.$rows[$i]['id'];
            $query = "SELECT sdvalue FROM #__softdisk WHERE sdsection='SHORTCUTS' AND sdhidden='1' AND sdname = '$pubname'";
            $database->setQuery($query, '#__', 1, 0);
            $rows[$i]['public'] = intval($database->loadResult());
            $i++;
        }
    }
?>
    <table class="adminlist">
        <tr>
            <th align="center" width="30"><?php echo $adminLanguage->A_NB; ?></th>
            <th class="title"><?php echo $adminLanguage->A_NAME; ?></th>
            <th align="center"><?php echo SDTL_PUBLIC; ?></th>
            <th><?php echo SDTL_LASTMOD; ?></th>
            <th align="center"><?php echo SDTL_ACTIONS; ?></th>
        </tr>
<?php 
        $k = 0;
        for ($i=0; $i<count($rows); $i++) {
            $row = $rows[$i];
            echo '<tr class="row'.$k.'">'._LEND;
            echo '<td align="center">'.($i+1).'</td>'._LEND;
            $href = '<a href="index2.php?option=com_admin&task=tools&tname=shortcuts&act=edit&id='.$row['id'].'"';
            $href .= ' title="'.$adminLanguage->A_EDIT.'">'.$row['name'].'</a>';
            echo '<td>'.$href.'</td>'._LEND;
            echo '<td align="center">';
            echo ($row['public']) ? _GEM_YES : _GEM_NO;
            echo '</td>'._LEND;
            echo '<td align="center">'.eLocale::strftime_os(_GEM_DATE_FORMLC2, $row['lastmodified']).'</td>'._LEND;
            $href = '<a href="index2.php?option=com_admin&task=tools&tname=shortcuts&act=delete&id='.$row['id'].'"';
            $href .= ' title="'.$adminLanguage->A_DELETE.'">'.$adminLanguage->A_DELETE.'</a>';
            echo '<td align="center">'.$href.'</td>'._LEND;
            echo '</tr>'._LEND;
            $k = 1 - $k;
        }
        
        if (count($rows) == 0) {
            echo '<tr><td colspan="5" align="center">'.SDTL_YHAVNOSHO.'</td></tr>'._LEND;
        
        }
        ?>
    </table>

    <div style="clear: both; padding: 10px 0px 10px 0px;">
        <img src="images/16X16/shortcut.png" border="0" align="bottom" alt="shortcut" />
        <a href="index2.php?option=com_admin&task=tools&tname=shortcuts&act=add" title="<?php echo $adminLanguage->ADDSOCUT; ?>"><?php echo $adminLanguage->ADDSOCUT; ?></a>
    </div>
<?php 
}


/***********************/
/* ADD/EDIT A SHORTCUT */
/***********************/
function tshortcuts_edit($id=0) {
    global $adminLanguage, $fmanager, $mosConfig_live_site;

    $row = new eShortcut();
    if ($id) {
        $row->loadShortCut($id);
    }

    $scimages = shortcutImages();
?>
    <script type="text/javascript">
    <!--
        function submitshort(pressbutton) {
            var form = document.fmaddshortcut;

            if (pressbutton == 'cancel') {
                form.act.value='';
                form.submit();
                return;
            }
            try {
                form.onsubmit();
            }
            catch (e) {
            }
            if (form.name.value == "") {
                alert("<?php echo $adminLanguage->A_ALERT_VALIDATE_NAME; ?>");
                form.name.focus();
            } else if (form.link.value == "") {
                alert("<?php echo SDTL_PROVLINK; ?>");
                form.link.focus();
            } else {
                form.act.value=pressbutton;
                form.submit();
            }
        }
    //-->
    </script>

    <form name="fmaddshortcut" id="fmaddshortcut" method="POST" action="index2.php">
        <div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
        <input type="hidden" name="option" value="com_admin" />
        <input type="hidden" name="task" value="tools" />
        <input type="hidden" name="tname" value="shortcuts" />
        <input type="hidden" name="act" value="" />
        <input type="hidden" name="id" value="<?php echo $id; ?>" />

        <table class="adminform">
            <tr>
                <th class="title" colspan="2"><?php 
                    echo CX_SHORTCUTS.' : ';
                    echo (intval($id)) ? $adminLanguage->A_EDIT : $adminLanguage->A_NEW;
                    ?>
                </th>
            </tr>
            <tr>
                <td><?php echo $adminLanguage->A_NAME; ?>:</td>
                <td><input type="text" name="name" size="50" class="inputbox" value="<?php echo $row->name; ?>" /></td>
            </tr>
            <tr>
                <td><?php echo $adminLanguage->A_LINK; ?>:</td>
                <td>
                    <input type="text" name="link" dir="ltr" size="70" class="inputbox" value="<?php echo $row->link; ?>" /> 
                    <?php echo mosToolTip( SDTL_LINKD ); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo SDTL_PUBLIC; ?>:</td>
                <td>
                    <?php echo mosHTML::yesnoRadioList( 'public', 'class="inputbox"', $row->public ); ?> &nbsp; &nbsp; 
                    <?php echo mosToolTip( SDTL_PUBLICD ); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $adminLanguage->A_IMAGE; ?>:</td>
                <td>
                    <table width="100%" border="0" cellpadding="4" cellspacing="2">
                        <?php 
                        $j = 1;
                        for ($i = 0; $i < count($scimages); $i++) {
                            if (trim($row->image) == '') {
                                $checked = ($i == 0 ) ? ' checked' : '';
                            } else {
                                $checked = ($scimages[$i] == $row->image) ? ' checked' : '';
                            }
                            
                            if ($j == 8) { $j = 1; }
                            if ($j == 1) { echo '<tr>'._LEND; }
                            echo '<td align="center" valign="top">'._LEND;
                            echo '<img src="'.$mosConfig_live_site.'/administrator/images/32X32/'.$scimages[$i].'">'._LEND;
                            echo '<input type="radio" name="image" value="'.$scimages[$i].'"'.$checked.' />'._LEND;
                            echo '</td>'._LEND;
                            if ($j == 7) { echo '</tr>'._LEND; }
                            $j++;
                        }
                        $r = 8 - $j;
                        if (($r >0) && ($j > 1)) {
                            echo str_repeat('<td>&nbsp;</td>'._LEND, $r);
                            echo '</tr>'._LEND;
                        }
                        ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="button" name="submitsc" value="<?php echo $adminLanguage->A_SAVE; ?>" class="button" onclick="submitshort('save');" /> &nbsp; 
                    <input type="button" name="cancel" value="<?php echo $adminLanguage->A_CANCEL; ?>" class="button" onclick="submitshort('cancel');" />
                </td>
            </tr>
        </table>
    </form>
    <script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/includes/js/overlib_mini.js"></script>
<?php 
}


/****************/
/* SAVE SHORCUT */
/****************/
function tshortcuts_save($id='0') {

    $id = intval($id);
    $name = eUTF::utf8_trim(mosGetParam($_POST, 'name', ''));
    $link = trim(mosGetParam($_POST, 'link', ''));
    $image = trim(mosGetParam($_POST, 'image', ''));
    $public = intval(mosGetParam($_POST, 'public', 0));

    if ($name == '') {
        echo '<script type="text/javascript">alert("'.$adminLanguage->A_ALERT_VALIDATE_NAME.'"); window.history.go(-1);</script>'._LEND;
        exit();
    }
    if ($link == '') {
        echo '<script type="text/javascript">alert("'.SDTL_PROVLINK.'"); window.history.go(-1);</script>'._LEND;
        exit();
    }

    $row = new eShortcut();
    if (!$id) {
        $row->id = time();
    } else {
        $row->id = $id;
    }
    $row->name = $name;
    $row->link = $link;
    $row->public = $public;
    $row->image = $image;
    if (!$id) {
        $row->insertShortCut();
    } else {
        $row->updateShortCut($id);
    }
    mosRedirect('index2.php?option=com_admin&task=tools&tname=shortcuts');
    exit();

}


/*********************/
/* DELETE A SHORTCUT */
/*********************/
function tshortcuts_delete($id) {
    if ($id) {
        $shortc = new eShortCut();
        $shortc->cleanShortcut($id);
    }
    mosRedirect('index2.php?option=com_admin&task=tools&tname=shortcuts');
    exit();
}


/************************/
/* GET AVAILABLE IMAGES */
/************************/
function shortcutImages() {
    global $mosConfig_absolute_path;

    $path = $mosConfig_absolute_path.'/administrator/images/32X32/';
    $dir = @opendir($path);
    $scimages = array();
    $i = 0;

    while ($file = @readdir($dir)) {
        if ($file != '.' && $file != '..' && is_file($path.'/'.$file) && !is_link($path.'/'.$file)) {
            if (preg_match('/(\.gif$|\.png$|\.jpg|\.jpeg)$/is', $file)) {
                $scimages[$i] = $file;
                $i++;
            }
        }
    }

    @closedir($dir);
    @ksort($scimages);
    @reset($scimages);
    return $scimages;
}


/** 
* THIS PLASMATIC CLASS RETRIEVES 
* MULTIPLE ROWS FROM SOFTDISK 
* AND TREATS THEM AS A UNIQUE 
* OBJECT (SHORTCUT)
*/
class eShortcut {

    public $id=0;
    public $name=null;
    public $link=null;
    public $image=null;
    public $uid=null;
    public $public=0;


    public function __construct() {
        global $my;
        $this->uid = $my->id;
    }


    /*******************/
    /* LOAD A SHORTCUT */
    /*******************/
    function loadShortCut($id=0) {
        global $database;

        if (!$id) { return false; }

        $sdname1 = 'SC_NAME_'.$this->uid.'_'.$id;
        $query = "SELECT sdvalue FROM #__softdisk WHERE sdname='$sdname1' AND sdsection='SHORTCUTS' AND sdhidden='1'";
        $database->setQuery($query, '#__', 1, 0);
        $this->name = $database->loadResult();
        if (!$this->name) { return false; }

        $sdname2 = 'SC_LINK_'.$this->uid.'_'.$id;
        $query = "SELECT sdvalue FROM #__softdisk WHERE sdname='$sdname2' AND sdsection='SHORTCUTS' AND sdhidden='1'";
        $database->setQuery($query, '#__', 1, 0);
        $this->link = $database->loadResult();
        if (!$this->link) { return false; }

        $sdname3 = 'SC_IMAGE_'.$this->uid.'_'.$id;
        $query = "SELECT sdvalue FROM #__softdisk WHERE sdname='$sdname3' AND sdsection='SHORTCUTS' AND sdhidden='1'";
        $database->setQuery($query, '#__', 1, 0);
        $this->image = $database->loadResult();

        $sdname4 = 'SC_PUBLIC_'.$this->uid.'_'.$id;
        $query = "SELECT sdvalue FROM #__softdisk WHERE sdname='$sdname4' AND sdsection='SHORTCUTS' AND sdhidden='1'";
        $database->setQuery($query, '#__', 1, 0);
        $this->public = intval($database->loadResult());
    }


    /***********************/
    /* INSERT NEW SHORTCUT */
    /***********************/
    function insertShortCut() {
        global $mosConfig_absolute_path, $database;

        require_once($mosConfig_absolute_path.'/administrator/includes/softdisk.class.php');

        $nrow = new softdiskdb($database);
        $nrow->sdsection = 'SHORTCUTS';
        $nrow->valuetype = 'STRING';
        $nrow->sdname = 'SC_NAME_'.$this->uid.'_'.$this->id;
        $nrow->sdvalue = $this->name;
        $nrow->lastmodified = time();
        $nrow->sdhidden = '1';
        if (!$nrow->store()) { return false; }
        unset($nrow);

        $lrow = new softdiskdb($database);
        $lrow->sdsection = 'SHORTCUTS';
        $lrow->valuetype = 'STRING';
        $lrow->sdname = 'SC_LINK_'.$this->uid.'_'.$this->id;
        $lrow->sdvalue = $this->link;
        $lrow->lastmodified = time();
        $lrow->sdhidden = '1';
        if (!$lrow->store()) { $this->cleanShortcut($this->id); return false; }
        unset($lrow);

        $irow = new softdiskdb($database);
        $irow->sdsection = 'SHORTCUTS';
        $irow->valuetype = 'STRING';
        $irow->sdname = 'SC_IMAGE_'.$this->uid.'_'.$this->id;
        $irow->sdvalue = $this->image;
        $irow->lastmodified = time();
        $irow->sdhidden = '1';
        if (!$irow->store()) { $this->cleanShortcut($this->id); return false; }
        unset($irow);
        
        $prow = new softdiskdb($database);
        $prow->sdsection = 'SHORTCUTS';
        $prow->valuetype = 'YESNO';
        $prow->sdname = 'SC_PUBLIC_'.$this->uid.'_'.$this->id;
        $prow->sdvalue = ''.$this->public.'';
        $prow->lastmodified = time();
        $prow->sdhidden = '1';
        if (!$prow->store()) { $this->cleanShortcut($this->id); return false; }
        unset($prow);
        
        return true;
    }


    /*******************/
    /* UPDATE SHORTCUT */
    /*******************/
    function updateShortCut($id) {
        global $mosConfig_absolute_path;

        require_once($mosConfig_absolute_path.'/administrator/includes/softdisk.class.php');
        $softdisk = new softDisk();

        $name1 = 'SC_NAME_'.$this->uid.'_'.$this->id;
        if (!$softdisk->update($name1, $this->name)) { return false; }
        $name2 = 'SC_LINK_'.$this->uid.'_'.$this->id;
        if (!$softdisk->update($name2, $this->link)) { return false; }
        $name3 = 'SC_IMAGE_'.$this->uid.'_'.$this->id;
        if (!$softdisk->update($name3, $this->image)) { return false; }
        $name4 = 'SC_PUBLIC_'.$this->uid.'_'.$this->id;
        if (!$softdisk->update($name4, $this->public)) { return false; }
        return true;
    }


    /******************************************/
    /* DELETE A SHORTCUT (for internal usage) */
    /******************************************/
    function cleanShortcut($id) {
        global $database;

        $n1 = 'SC_NAME_'.$this->uid.'_'.$id;
        $n2 = 'SC_LINK_'.$this->uid.'_'.$id;
        $n3 = 'SC_IMAGE_'.$this->uid.'_'.$id;
        $n4 = 'SC_PUBLIC_'.$this->uid.'_'.$id;

        $query = "DELETE FROM #__softdisk WHERE sdsection='SHORTCUTS'"
        ."\n AND nodelete='0' AND sdhidden='1'"
        ."\n AND ((sdname = '$n1') OR (sdname = '$n2') OR (sdname = '$n3') OR (sdname = '$n4'))";
        $database->setQuery($query);
        $database->query();
    }

}

?>