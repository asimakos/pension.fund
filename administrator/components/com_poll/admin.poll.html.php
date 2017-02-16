<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Poll
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_poll {


    /***************************/
    /* HTML SHOW LIST OF POLLS */
    /***************************/
	static public function showPolls( &$rows, &$pageNav, &$lists, $formfilters=array() ) {
		global $my, $adminLanguage, $mosConfig_live_site;

		mosCommonHTML::loadOverlib();
		$align = (_GEM_RTL) ? 'right' : 'left';
?>
		<script type="text/javascript">
		function eAccess( cid, access ) {
            if (document.getElementById) {
                var acc = document.getElementById(access).value;
			} else if (document.all) {
				var acc = document.all[access].value;
            } else if (document.layers) {
                var acc = document.layers[access].value;
            }
            window.location = "index2.php?option=com_poll&task=setaccess&access="+acc+"&sid="+cid;
		}
		</script>
        <script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/includes/js/ajax_new.js"></script>
        <script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_poll/pollajax.js"></script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="poll"><?php echo $adminLanguage->A_POLL_MANAGER; ?></th>
		</tr>
		</table>

		<table class="adminlist">
        <tr>
			<th width="5"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
			</th>
			<th align="<?php echo $align; ?>"><?php echo $adminLanguage->A_CMP_POL_TITLE; ?></th>
			<th align="center" style="text-align:center;"><?php echo $adminLanguage->A_PUBLISHED; ?></th>
			<th align="center" style="text-align:center;"><?php echo $adminLanguage->A_CMP_POL_LOCK; ?></th>
			<th align="center" style="text-align:center;"><?php echo $adminLanguage->A_CMP_POL_OPTNS; ?></th>
			<th align="center" style="text-align:center;"><?php echo $adminLanguage->A_CMP_POL_LAG; ?></th>
			<th><?php echo $adminLanguage->A_ACCESS; ?></th>
            <th align="<?php echo $align; ?>"><?php echo $adminLanguage->A_MENU_LANGUAGES; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectlang')">
            <?php 
            echo '<img src=';
            echo ($formfilters['filter_lang'] != '') ? '"images/downarrow3.png" title="' . $adminLanguage->A_FILTERED . '"' : '"images/downarrow2.png" title="' . $adminLanguage->A_FILTER . '"';
            echo 'border="0" />';
            ?>
            </a>
            <div id="selectlang" style="display:none; position:absolute; <?php echo (_GEM_RTL) ? 'left' : 'right'; ?>:20px;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_FILTLANG; ?></div>
                <?php echo $lists['flangs']; ?>
                <div class="filterbottom">
                    <a href="javascript:void(null);" onclick="javascript:hideLayer('selectlang');" style="color: #888888;"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			 </div>
            </th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];

			$link = 'index2.php?option=com_poll&task=editA&hidemainmenu=1&id='. $row->id;
			$img = $row->published ? 'publish_g.png' : 'publish_x.png';
            $alt = $row->published ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;

			$imgl = $row->locked ? 'tick.png' : 'publish_x.png';
            $altl = $row->locked ? $adminLanguage->A_CMP_POL_LOCK : $adminLanguage->A_CMP_POL_UNLOCK;

			$access = mosCommonHTML::AccessProcessing( $row, $i );
            $accesswin_list = mosAdminMenus::Access($row);
			$checked = mosCommonHTML::CheckedOutProcessing( $row, $i );
			?>
			<tr class="row<?php echo $k; ?>">
				<td><?php echo $pageNav->rowNumber( $i ); ?></td>
				<td><?php echo $checked; ?></td>
				<td>
				<a href="<?php echo $link; ?>" title="<?php echo $adminLanguage->A_CMP_POL_EDIT; ?>">
				<?php echo $row->title; ?></a>
				</td>
				<td align="center" style="text-align:center;">
                    <div id="pollstatus<?php echo $i; ?>">
					   <a href="javascript:;" title="<?php echo $alt; ?>" 
                       onclick="changePollState('<?php echo $i; ?>', '<?php echo $row->id; ?>', '<?php echo ($row->published) ? 0 : 1; ?>');">
                       <img src="images/<?php echo $img; ?>" border="0" alt="<?php echo $alt; ?>" /></a>
                    </div>
				</td>
				<td align="center" style="text-align:center;">
                    <div id="polllock<?php echo $i; ?>">
                        <a href="javascript:;" title="<?php echo $altl; ?>" 
                        onclick="changePollLock('<?php echo $i; ?>', '<?php echo $row->id; ?>', '<?php echo ($row->locked) ? 0 : 1; ?>');">
                        <img src="images/<?php echo $imgl; ?>" border="0" alt="<?php echo $altl; ?>" /></a>
                    </div>
                </td>
				<td align="center" style="text-align:center;"><?php echo $row->numoptions; ?></td>
				<td align="center" style="text-align:center;"><?php echo $row->lag; ?></td>
				<td align="center" style="text-align:center;">
				<?php echo $access; ?>
				<div id="accesswin<?php echo $i; ?>" style="display:none; position:absolute;" class="filter">
                    <div class="filtertop"><b><?php echo $adminLanguage->A_ACCESS; ?></b></div>
                    <?php echo $accesswin_list; ?>
                    <div class="filterbottom">
                        <input type="button" class="button" onclick="javascript:eAccess('<?php echo $row->id; ?>', 'access<?php echo $row->id; ?>');" name="submit<?php echo $i; ?>" value="<?php echo $adminLanguage->A_SAVE; ?>"> &nbsp; 
                        <input type="button" class="button" onclick="javascript:hideLayer('accesswin<?php echo $i; ?>');" name="close<?php echo $i; ?>" value="<?php echo $adminLanguage->A_CLOSE; ?>">
                    </div>
                </div>
                </td>
                <td align="<?php echo $align; ?>">
				<?php 
                if (trim($row->language) != '') {
                    $clangs = explode(',',$row->language);
                    if (count($clangs) > 5) {
                        echo count($clangs).' '.$adminLanguage->A_MENU_LANGUAGES;
                    } else {
                        foreach ($clangs as $clang) {
                            if (trim($clang) != '') {
                                echo '<img src="'.$mosConfig_live_site.'/language/'.$clang.'/'.$clang.'.gif" alt="'.$clang.'" title="'.$clang.'" border="0" /> ';
                            }
                        }
                    }
 				} else {
 				   echo '<img src="images/flag_un.gif" alt="'.$adminLanguage->A_ALL.'" title="'.$adminLanguage->A_ALL.'" border="0" />';
                }
                ?>
                </td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="com_poll" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
		<?php
	}


    /******************/
    /* HTML EDIT POLL */
    /******************/
	static public function editPoll( &$row, &$options, &$lists ) {
		global $adminLanguage, $mosConfig_live_site;

        mosMakeHtmlSafe( $row, ENT_QUOTES );
?>
		<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
		<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/includes/js/overlib_mini.js"></script>
        <script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/includes/js/ajax_new.js"></script>
        <script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_poll/pollajax.js"></script>
		<script type="text/javascript">
		<!--
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			//do field validation
			if (form.title.value == "") {
				alert( "<?php echo $adminLanguage->A_CMP_POL_MHTIT; ?>" );
			} else if (trim(form.seotitle.value) == ""){
                alert( "<?php echo $adminLanguage->A_SEOTEMPTY; ?>" );
			} else if( isNaN( parseInt( form.lag.value ) ) ) {
				alert( "<?php echo $adminLanguage->A_CMP_POL_NZERO; ?>" );
			//} else if (form.menu.options.value == ""){
			//	alert( "Poll must have pages." );
			//} else if (form.adminForm.textfieldcheck.value == 0){
			//	alert( "Poll must have options." );
			} else {
				submitform( pressbutton );
			}
		}
		//-->
		</script>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="poll">
			<?php echo $adminLanguage->A_CMP_POL_POLL; ?> : 
                <small><?php echo $row->id ? $adminLanguage->A_EDIT : $adminLanguage->A_NEW; ?></small>
			</th>
		</tr>
		</table>

		<table class="adminform">
		<tr>
			<th colspan="3"><?php echo $adminLanguage->A_DETAILS; ?></th>
		</tr>
		<tr>
		    <td width="60%">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><?php echo $adminLanguage->A_TITLE; ?>:</td>
                    <td>
                        <input class="inputbox" type="text" name="title" size="50" value="<?php echo $row->title; ?>" />
                    </td>                    
                </tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_SEOTITLE; ?>:</td>
					<td>
                        <input type="text" dir="ltr" id="seotitle" name="seotitle" size="40" maxlength="100" class="inputbox" value="<?php echo $row->seotitle; ?>" /> 
                        <?php echo mosToolTip($adminLanguage->A_SEOTHELP); ?><br />
                        <a href="javascript:void(0);" onclick="suggestSEO()"><?php echo $adminLanguage->A_SEOTSUG; ?></a> &nbsp; | &nbsp; 
                        <a href="javascript:void(0);" onclick="validateSEO()"><?php echo $adminLanguage->A_SEOTVAL; ?></a><br />
                        <div id="valseo" style="height: 20px;"></div>                    
                    </td>
				</tr>
                <tr>
                    <td><?php echo $adminLanguage->A_PUBLISHED; ?>:</td>
                    <td><?php echo $lists['published']; ?></td>
                </tr>
                <tr>
                    <td><?php echo $adminLanguage->A_CMP_POL_LOCK; ?>:</td>
                    <td><?php echo $lists['locked']; ?></td>
                </tr>
                <tr>
                    <td valign="top"><?php echo $adminLanguage->A_ACCESS; ?>:</td>
                    <td><?php echo $lists['access']; ?></td>
                </tr>
                <tr>
                    <td><?php echo $adminLanguage->A_CMP_POL_LAG; ?>:</td>
                    <td>
                        <input class="inputbox" type="text" dir="ltr" name="lag" size="10" value="<?php echo $row->lag; ?>" /> 
                        <span dir="ltr"><?php echo $adminLanguage->A_CMP_POL_BTWN; ?></span>
                    </td>
                </tr>
                <tr>
                    <td valign="top"><?php echo $adminLanguage->A_LANGUAGE; ?>:</td>
                    <td><?php echo $lists['languages']; ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <fieldset id="polloptions">
                            <legend><?php echo $adminLanguage->A_CMP_POL_OPTNS; ?></legend>
                            <?php 
                            if ($row->id) {
                                for ($i=0; $i < count( $options ); $i++ ) {
                                    $x = sprintf("%02d", ($i + 1));
                                    echo $x.' &nbsp; <input class="inputbox" type="text" name="polloption['.$options[$i]->id.']" value="'.htmlspecialchars( $options[$i]->text, ENT_QUOTES ).'" size="60" /><br />'._LEND;
                                }
                            } else {
                                for ($i=0; $i < 12; $i++) {
                                $x = sprintf("%02d", ($i + 1));
                                echo $x.' &nbsp; <input class="inputbox" type="text" name="polloption[]" value="" size="60" /><br />'._LEND;
                                }
                            }
                            ?>
                        </fieldset>
                    </td>
                </tr>
                </table>
            </td>
		    <td valign="top">
                <?php echo $adminLanguage->A_CMP_POL_SHOW; ?>:<br />
                <?php echo $lists['select']; ?>
		    </td>
		</tr>
		</table>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="option" value="com_poll" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="textfieldcheck" value="<?php echo count( $options ); ?>" /> <?php /* was $n -----> TO CHECK/DO */ ?>
		</form>
<?php 
	}
}

?>