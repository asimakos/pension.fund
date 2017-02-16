<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component SoftDisk
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class softdisk_html {

    /******************************/
    /* HTML VIEW SOFTDISK ENTRIES */
    /******************************/
    static public function view($lists, $rows, $section, &$pageNav) {
        global $softdisk, $adminLanguage, $mainframe;

?>
        <script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/components/com_softdisk/softjava.js"></script>

		<form action="index2.php" method="post" name="adminForm">
		    <div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="50%">
                        <table class="adminheading">
                        <tr>
				            <th class="softhead">
                                <?php echo $adminLanguage->SOFTDISK; ?> 
                                <span style="font-size: small;" dir="ltr">[ <?php 
                                echo $adminLanguage->A_SECTION.': ';
                                echo ($section != '')  ? $softdisk->translate($section) : $adminLanguage->A_ALL;
                                ?> ]</span>
                            </th>
                        </tr>
                        </table>
                    </td>
                    <td width="50%" align="<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>"><?php echo $adminLanguage->A_SECTION.': '.$lists['sections']; ?> &nbsp; &nbsp; </td>
                </tr>
            </table>

		    <table class="adminlist">
                <tr>
                    <th width="26"><?php echo $adminLanguage->A_NB; ?></th>
                    <th width="30"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
                    <th width="26"></th>
                    <?php 
                    if ($section == '') {
                        echo '<th>'.$adminLanguage->A_SECTION.'</th>'._LEND;
                    }
                    ?>
                    <th class="title" width="250"><?php echo $adminLanguage->A_NAME; ?></th>
                    <th align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>"><?php echo $adminLanguage->A_VALUE; ?></th>
                    <th width="60"><?php echo $adminLanguage->A_MENU_SYSTEM; ?></th>
                    <th width="60"><?php echo $adminLanguage->UNDELETABLE; ?></th>
                    <th width="220"><?php echo $adminLanguage->A_LASTMOD; ?></th>
                </tr>
                <?php 
                $k = 0;
                for ($i=0; $i < count( $rows ); $i++) {
                    $row = &$rows[$i];
                ?>
                	<tr class="row<?php echo $k; ?>">
                        <td align="center"><?php echo ($i+1); ?></td>
                        <td align="center"><?php 
                            if (!$row->sdsystem) {
                                echo '<input type="checkbox" id="cb'.$i.'" name="cid[]" value="'.$row->id.'" onclick="isChecked(this.checked);" />'._LEND;
                            } else {
                                echo '<img src="images/checked_out.png" border="0" title="'.$adminLanguage->A_MENU_SYSTEM.'" />'._LEND;
                            }
                        ?>
                        </td>
                        <td align="center"><?php 
                        echo '<img src="components/com_softdisk/images/'.$row->valuetype.'.png" border="0" align="absmiddle" title="'.$row->valuetype.'" />';
                        ?>
                        </td>
                        <?php 
                        if ($section == '') {
                        echo '<td align="center">'.$softdisk->translate($row->sdsection).'</td>'._LEND;
                        }
                        ?>
                        <td><?php 
                        $tr = $softdisk->translate($row->sdname);
                        if (!$row->sdsystem) {
                            echo '<a href="javascript: void(0);" onclick="hideMainMenu(); return listItemTask(\'cb'.$i.'\',\'edit\')" title="'.$adminLanguage->A_EDIT.'">'.$row->sdname.'</a>'._LEND;
                        } else { echo $row->sdname; }
                        if ($tr != $row->sdname) { echo ' '.mosToolTip( $tr ); }
                        ?>
                        </td>
                        <td><?php 
                        if ($row->valuetype == 'TEXT') {
                            echo (eUTF::utf8_strlen($row->sdvalue) > 60) ? eUTF::utf8_substr($row->sdvalue, 0, 57).'...' : $row->sdvalue;
                        } else {
                            echo $softdisk->getFormatedValue($row->sdvalue, $row->valuetype);
                        }
                        ?></td>
                        <td align="center"><img src="images/<?php echo ($row->sdsystem) ? 'tick.png' : 'publish_x.png'; ?>" border="0" /></td>
                        <td align="center"><img src="images/<?php echo ($row->nodelete) ? 'tick.png' : 'publish_x.png'; ?>" border="0" /></td>
                        <td align="center"><?php echo eLocale::strftime_os(_GEM_DATE_FORMLC2, $row->lastmodified); ?></td>
                    </tr>
				<?php 
				    $k = 1 - $k;
                }
                ?>
            </table>
            <?php echo $pageNav->getListFooter(); ?>

            <input type="hidden" name="option" value="com_softdisk" />
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="hidemainmenu" value="0" />
            <input type="hidden" name="boxchecked" value="0" />
        </form>
        <script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/includes/js/overlib_mini.js"></script>
<?php 
    }


    /*************************/
    /* DISPLAY SOFTDISK HELP */
    /*************************/
    static public function showhelp() {
        global $adminLanguage;
?>

        <table class="adminheading">
            <tr>
				<th class="softhead"><?php echo $adminLanguage->SOFTDISK; ?></th>
            </tr>
        </table>
		<p align="justify">
		    <?php echo $adminLanguage->SOFTDISK_HELP; ?>
        </p>
        <br />
        <p align="center">
            <a href="javascript:window.close();"><strong><?php echo $adminLanguage->A_CLOSE; ?></strong></a>
        </p>
<?php 
    }


    /********************************/
    /* HTML ADD/EDIT SOFTDISK ENTRY */
    /********************************/
    static public function edit($row, $lists) {
        global $adminLanguage, $softdisk, $mainframe;

        $stext = ($row->valuetype == 'TEXT') ? '' : 'display: none; ';
        $sstring = ($row->valuetype == 'STRING') ? '' : 'display: none; ';
        $sinteger = ($row->valuetype == 'INTEGER') ? '' : 'display: none; ';
        $simage = ($row->valuetype == 'IMAGE') ? '' : 'display: none; ';
        $semail = ($row->valuetype == 'EMAIL') ? '' : 'display: none; ';
        $surl = ($row->valuetype == 'URL') ? '' : 'display: none; ';
        $sdecimal = ($row->valuetype == 'DECIMAL') ? '' : 'display: none; ';
        $stime = ($row->valuetype == 'TIME') ? '' : 'display: none; ';
        $syesno = ($row->valuetype == 'YESNO') ? '' : 'display: none; ';

        $translated = $row->sdname;
        if ($row->id > 0) {
            $translated = $softdisk->translate($row->sdname);
        }
?>

        <script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/components/com_softdisk/softjava.js"></script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="softhead">
			<?php echo $adminLanguage->SOFTDISK; ?>: 
            <small><?php echo ($row->id) ? $adminLanguage->A_EDIT.' [ '.$row->sdname.' ]' : $adminLanguage->A_NEW; ?></small>
			</th>
		</tr>
		</table>

		<table width="100%" class="adminform">
        <tr>
        	<th colspan="2"><?php echo $adminLanguage->A_DETAILS; ?></th>
        </tr>
        <?php 
        if ($translated != $row->sdname) {
            echo '<tr><td colspan="2"><em>'.$translated.'</em><br /><br /></td></tr>'._LEND;
        }
        ?>
        <tr>
        	<td width="200"><?php echo $adminLanguage->A_SECTION; ?>:</td>
        	<td>
        	    <?php 
        	    if (!$row->nodelete) {
        	    	$laq = (_GEM_RTL) ? '&raquo;' : '&laquo;';
        	    	$raq = (_GEM_RTL) ? '&laquo;' : '&raquo;';
                ?>
                <div id="oldsectiondiv" style="position:relative;">
                <?php echo $lists['sections']; ?> &nbsp; &nbsp; 
                <a href="javascript:void(0);" onclick="showLayer('newsectiondiv'); hideLayer('oldsectiondiv');"><?php echo $adminLanguage->A_NEW; ?></a> <strong><?php echo $raq; ?></strong>
                </div>
                <div id="newsectiondiv" style="display:none; position:relative;">
                <input type="text" id="newsection" name="newsection" dir="ltr" class="inputbox" size="50" maxlength="50" /> &nbsp; &nbsp; <strong><?php echo $laq; ?></strong> 
                <a href="javascript:void(0);" onclick="showLayer('oldsectiondiv'); hideLayer('newsectiondiv'); resetNewSection();"><?php echo $adminLanguage->A_RESTORE; ?></a>
                </div>
                <?php 
                } else {
                ?>
                    <div id="oldsectiondiv" style="position:relative;">
                    <?php echo $row->sdsection.' &nbsp; ('.$adminLanguage->YCNOTEDITP.')'; ?>
                    <input type="hidden" name="section" dir="ltr" value="<?php echo $row->sdsection; ?>" />
                    </div>
                <?php 
                }
                ?>
            </td>
        </tr>
        <tr>
        	<td><?php echo $adminLanguage->A_NAME; ?>:</td>
        	<td><?php 
        	if (!$row->nodelete) {
                echo '<input class="inputbox" type="text" dir="ltr" size="50" name="name" value="'.$row->sdname.'" maxlength="50" />'._LEND;
            } else {
                echo $row->sdname.' &nbsp; ('.$adminLanguage->YCNOTEDITP.')'._LEND;
                echo '<input type="hidden" name="name" value="'.$row->sdname.'" />'._LEND;
            }
            ?>
            </td>
        </tr>
        <tr>
        	<td><?php echo $adminLanguage->A_TYPE; ?>:</td>
        	<td><?php 
        	if (!$row->nodelete) {
                echo $lists['valuetypes'];
            } else {
                echo $row->valuetype.' &nbsp; ('.$adminLanguage->YCNOTEDITP.')'._LEND;
                echo '<input type="hidden" name="valuetype" value="'.$row->valuetype.'" />'._LEND;
            }
            ?>
            </td>
        </tr>
        <tr>
        	<td valign="top"><?php echo $adminLanguage->A_VALUE; ?>:</td>
        	<td>
            <div id="vTEXT" style="<?php echo $stext; ?>position: relative;">
                <textarea class="text_area" cols="50" rows="3" name="valuetext"><?php echo $row->sdvalue; ?></textarea>
            </div>
            <div id="vSTRING" style="<?php echo $sstring; ?>position: relative;">
                <input type="text" class="inputbox" dir="ltr" size="50" name="valuestring" value="<?php echo $row->sdvalue; ?>" />
            </div>
            <div id="vINTEGER" style="<?php echo $sinteger; ?>position: relative;">
                <input type="text" class="inputbox" dir="ltr" size="15" maxlength="32" name="valueinteger" value="<?php echo intval($row->sdvalue); ?>" />
            </div>
            <?php 
            $vtime = intval($row->sdvalue);
            $vtime = ($vtime > 0) ? $vtime : time();
            ?>            
            <div id="vTIME" style="<?php echo $stime; ?>position: relative;">
                <input type="text" class="inputbox" dir="ltr" size="15" maxlength="12" name="valuetime" value="<?php echo $vtime; ?>" />
            </div>
            <?php $val = (preg_match('/^(http\:\/\/)/i', $row->sdvalue)) ? $row->sdvalue : 'http://'; ?>
            <div id="vURL" style="<?php echo $surl; ?>position: relative;">
               <input type="text" class="inputbox" dir="ltr" size="50" maxlength="120" name="valueurl" value="<?php echo $val; ?>" />
            </div>
            <?php $val = (preg_match('/\@/', $row->sdvalue)) ? $row->sdvalue : 'user@domain.com'; ?>
            <div id="vEMAIL" style="<?php echo $semail; ?>position: relative;">
                <input type="text" class="inputbox" dir="ltr" size="50" maxlength="80" name="valueemail" value="<?php echo $val; ?>" />
            </div>
            <?php 
            $c1 = (intval($row->sdvalue) == 1) ? ' checked' : '';
            $c2 = ($c1 != '') ? '' : ' checked';
            ?>
            <div id="vYESNO" style="<?php echo $syesno; ?>position: relative;">
                <input type="radio" name="valueyesno" value="0"<?php echo $c2; ?> /> <?php echo _GEM_NO; ?>
                <input type="radio" name="valueyesno" value="1"<?php echo $c1; ?> /> <?php echo _GEM_YES; ?>
            </div>
            <div id="vIMAGE" style="<?php echo $simage; ?>position: relative;">
                <input type="text" class="inputbox" dir="ltr" size="50" maxlength="120" name="valueimage" value="<?php echo $row->sdvalue; ?>" />
            </div>
            <?php 
            if (is_numeric($row->sdvalue)) {
                if (is_int($row->sdvalue)) {
                    $val = number_format($row->sdvalue, 2);
                } else {
                    $val = $row->sdvalue;
                }
            } else {
                $val = '0.00';
            }
            ?>
            <div id="vDECIMAL" style="<?php echo $sdecimal; ?>position: relative;">
                <input type="text" class="inputbox" dir="ltr" size="30" maxlength="32" name="valuedecimal" value="<?php echo $val; ?>" />
            </div>
            </td>
        </tr>
        <tr>
        	<td><?php echo $adminLanguage->A_LASTMOD; ?>:</td>
        	<td><?php echo eLocale::strftime_os(_GEM_DATE_FORMLC2, $row->lastmodified); ?></td>
        </tr>
        </table>
        <input type="hidden" name="option" value="com_softdisk" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		</form>
<?php 
    }
}

?>