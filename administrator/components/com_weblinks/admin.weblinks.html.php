<?php 
/**
* @version: $Id: admin.weblinks.html.php 55 2010-06-13 08:57:20Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Weblinks
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_weblinks {


    /**********************/
    /* HTML LIST WEBLINKS */
    /**********************/
	static public function showWeblinks( $option, &$rows, &$lists, &$search, &$pageNav, $formfilters=array() ) {
		global $my, $adminLanguage, $mainframe;

		mosCommonHTML::loadOverlib();
?>
        <script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/components/com_weblinks/weblinks.js"></script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th><?php echo $adminLanguage->A_CMP_WBL_MANAGER; ?></th>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_FILTER; ?>:</td>
			<td>
                <input type="text" name="search" value="<?php echo $search; ?>" class="text_area" onchange="document.adminForm.submit();" />
			</td>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="5"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20">
                <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
			</th>
			<th class="title"><?php echo $adminLanguage->A_TITLE; ?></th>
			<th><?php echo $adminLanguage->A_PUBLISHED; ?></th>
			<th><?php echo $adminLanguage->A_CMP_WBL_APPROVED; ?></th>
			<th colspan="2"><?php echo $adminLanguage->A_REORDER; ?></th>
			<th class="title">
			<?php echo $adminLanguage->A_CATEGORY; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectsection')">
            <?php 
            echo '<img src=';
            echo ($formfilters['catid'] > 0) ? '"images/downarrow3.png" title="' . $adminLanguage->A_FILTERED . '"' : '"images/downarrow2.png" title="' . $adminLanguage->A_FILTER . '"';
            echo 'border="0" />';
            ?>
            </a>
            <div id="selectsection" style="display:none; position:absolute;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_FILTERCATEGORY; ?></div>
                <?php echo $lists['catid']; ?>
                <div class="filterbottom">
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selectsection');" style="color: #888888"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			</div>
			</th>
			<th><?php echo $adminLanguage->A_HITS; ?></th>
			<th class="title">
			<?php echo $adminLanguage->A_MENU_LANGUAGES; ?>
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
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selectlang');" style="color: #888888"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			 </div>
			</th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];

			//check for language settings errors (items/categories lang conflicts)
			$langok = 0;
			if ($row->category_lang != '') {
				if ($row->language != '') {
					$itemlangs = explode(',',$row->language);
						for ($t=0; $t < count($itemlangs); $t++) {
							if (preg_match('/'.$itemlangs[$t].'/i',$row->category_lang)) { $langok = 1; }
						}
				    unset ($itemlangs);
				} else { $langok = 1; }
                $catlangs = preg_replace('/\,/',', ',trim($row->category_lang));
			} else {
            	$langok = 1;
                $catlangs = $adminLanguage->A_ALL;
            }
			if ($langok == 0) { $ff = 'X'; }  else { $ff = $k; }

			$link = 'index2.php?option=com_weblinks&task=editA&hidemainmenu=1&id='.$row->id;
			$task = $row->published ? 'unpublish' : 'publish';
			$img = $row->published ? 'publish_g.png' : 'publish_x.png';
			$alt = $row->published ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;

			$checked = mosCommonHTML::CheckedOutProcessing( $row, $i );

			$row->cat_link = 'index2.php?option=com_categories&section=com_weblinks&task=editA&hidemainmenu=1&id='.$row->catid;
			?>
			<tr class="row<?php echo $ff; ?>">
				<td><?php echo $pageNav->rowNumber( $i ); ?></td>
				<td><?php echo $checked; ?></td>
				<td>
				<?php
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					echo $row->title;
				} else {
					?>
					<a href="<?php echo $link; ?>" onmouseover="showLinkInfo('<?php echo $row->screenshot; ?>', '<?php echo $row->title; ?>');" onmouseout="return nd();">
                    <?php echo $row->title; ?></a>
					<?php
				}
				?>
				</td>
				<td align="center" style="text-align:center;">
                    <div id="webstatus<?php echo $i; ?>">
					<a href="javascript: void(0);" onclick="changeWebState('<?php echo $i; ?>', '<?php echo $row->id; ?>', '<?php echo ($row->published) ? 0 : 1; ?>');"  title="<?php echo $alt; ?>">
					<img src="images/<?php echo $img; ?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" /></a>
                    </div>
                </td>
				<?php
				if ( $row->approved ) {
					?>
					<td align="center" style="text-align:center;"><img src="images/tick.png" border="0" /></td>
					<?php
				} else {
					?>
					<td align="center" style="text-align:center;"></td>
					<?php
				}
				?>
				<td style="text-align:<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>;">
				<?php echo $pageNav->orderUpIcon( $i, ($row->catid == @$rows[$i-1]->catid), 'orderup', $adminLanguage->A_MOVE_UP ); ?>
				</td>
      			<td style="text-align:<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>;">
				<?php echo $pageNav->orderDownIcon( $i, $n, ($row->catid == @$rows[$i+1]->catid), 'orderdown', $adminLanguage->A_MOVE_DOWN ); ?>
				</td>
				<td>
				<?php echo mosToolTip( $catlangs, $adminLanguage->A_CATLANGES, '', 'language.png' ); ?> 
				<a href="<?php echo $row->cat_link; ?>" title="<?php echo $adminLanguage->A_CMP_WBL_EDITCAT; ?>">
				<?php echo $row->category; ?></a>
				</td>
				<td align="center" style="text-align:center;"><?php echo $row->hits; ?></td>
                <td>
                <?php 
                if (trim($row->language) != '') {
                    $clangs = explode(',',$row->language);
                    if (count($clangs) > 5) {
                        echo count($clangs).' '.$adminLanguage->A_MENU_LANGUAGES;
                    } else {
                        foreach ($clangs as $clang) {
                            if (trim($clang) != '') {
                                echo '<img src="'.$mainframe->getCfg('live_site').'/language/'.$clang.'/'.$clang.'.gif" alt="'.$clang.'" title="'.$clang.'" border="0" /> ';
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
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
		<?php
	}


	/*************************/
	/* HTML ADD/EDIT WEBLINK */
	/*************************/
	static public function editWeblink( &$row, &$lists, &$params, $option, $webscreens ) {
    	global $adminLanguage, $mainframe;

        mosMakeHtmlSafe( $row, ENT_QUOTES, 'description' );
		mosCommonHTML::loadOverlib();
?>
        <script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/components/com_weblinks/weblinks.js"></script>
		<script type="text/javascript">
		<!--
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			//do field validation
			if (form.title.value == ""){
				alert( "<?php echo $adminLanguage->A_CMP_WBL_MUSTTITLE; ?>" );
			} else if (form.catid.value == "0"){
				alert( "<?php echo $adminLanguage->A_CMP_WBL_MUSTCATEG; ?>" );
			} else if (form.url.value == ""){
				alert( "<?php echo $adminLanguage->A_CMP_WBL_YMHURL; ?>" );
			} else {
				submitform( pressbutton );
			}
		}
		//-->
		</script>

		<form action="index2.php" method="post" name="adminForm" id="adminForm">
		<table class="adminheading">
		<tr>
			<th>
                <?php echo $adminLanguage->A_CMP_WBL_WEBLNK; ?>: 
                <small><?php echo $row->id ? $adminLanguage->A_EDIT : $adminLanguage->A_NEW; ?></small>
			</th>
		</tr>
		</table>

		<table width="100%">
		<tr>
			<td width="60%" valign="top">
				<table class="adminform">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_DETAILS; ?></th>
				</tr>
				<tr>
					<td width="20%"><?php echo $adminLanguage->A_NAME; ?>:</td>
					<td>
                        <input class="inputbox" type="text" name="title" size="50" maxlength="250" value="<?php echo $row->title; ?>" />
					</td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_CATEGORY; ?>:</td>
					<td>
                        <?php echo $lists['catid']; ?>
                    </td>
				</tr>
				<tr>
					<td valign="top" align="right"><?php echo $adminLanguage->A_URL; ?>:</td>
					<td>
                        <input type="text" name="url" dir="ltr" class="inputbox" value="<?php echo $row->url; ?>" size="50" maxlength="250" />
					</td>
				</tr>
				<tr>
					<td valign="top" align="right"><?php echo $adminLanguage->A_DESCRIPTION; ?>:</td>
					<td>
                        <textarea name="description" class="text_area" cols="50" rows="5" style="width: 400px;"><?php echo $row->description; ?></textarea>
					</td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_ORDERING; ?>:</td>
					<td>
                        <?php echo $lists['ordering']; ?>
                    </td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_LANGUAGE; ?>:</td>
					<td>
                        <?php echo $lists['languages']; ?>
                    </td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_CMP_WBL_APPROVED; ?>:</td>
					<td>
                        <?php echo $lists['approved']; ?>
                    </td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_PUBLISHED; ?>:</td>
					<td>
                        <?php echo $lists['published']; ?>
                    </td>
				</tr>
				<tr>
                	<td valign="top"><?php echo $adminLanguage->A_CMP_WBL_MUSTURL; ?>:</td>
					<td>
                    <?php if (trim($row->screenshot != '')) { $imgexist = 1; } ?>

					<input type="radio" name="imgsel" value="0"<?php echo $imgexist ? '' : ' checked="checked"'; ?> onclick="document.getElementById('scr_1').style.display = 'none'; document.getElementById('scr_2').style.display = 'none';" /> 
                    <?php echo $adminLanguage->A_CMP_WBL_SCRNO; ?><br />
                    <input type="radio" name="imgsel" value="1"<?php echo $imgexist ? ' checked="checked"' : ''; ?> onclick="document.getElementById('scr_1').style.display = 'block'; document.getElementById('scr_2').style.display = 'none';" /> 
                    <?php echo $adminLanguage->A_CMP_WBL_SCRLOC; ?><br />
                    <input type="radio" name="imgsel" value="2"	onclick="document.getElementById('scr_1').style.display = 'none'; document.getElementById('scr_2').style.display = 'block';" /> 
                    <?php echo $adminLanguage->A_CMP_WBL_SCRINT; ?><br /><br />

					<div id="scr_1" style="display: <?php echo $imgexist ? 'block' : 'none'; ?>">
					<?php echo $lists['image']; ?> <?php echo $adminLanguage->A_CMP_WBL_SSHOTDESC; ?><br />
					<script type="text/javascript">
					<!--
					if (document.forms[0].image.options.value!=''){
					  jsimg='../images/screenshots/' + getSelectedValue( 'adminForm', 'image' );
					} else {
					  jsimg='../images/M_images/blank.png';
					}
					document.write('<img src=' + jsimg + ' name="imagelib" width="120" height="90" border="0" alt="<?php echo $adminLanguage->A_PREVIEW; ?>" />');
					//-->
					</script>
                    </div>

					<div id="scr_2" style="display: none;">
                    <?php $wflag = is_writable("../images/screenshots"); ?>
                    <strong>/images/screenshots <?php echo $adminLanguage->A_IS; ?> 
                    <?php echo $wflag ? '<span style="color: #006600;">'.$adminLanguage->A_WRITABLE.'</span>' : '<span style="color: #ff0000;">'.$adminLanguage->A_UNWRITABLE.'</span>'; ?></strong><br />
                    <?php echo $adminLanguage->A_CMP_WBL_COPYDESC; ?>

                    <table width="400" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td width="150" valign="top">
                        <input type="button" class="button" name="elxscr3" value="MSN" onclick="doit(3); return false;" ondblclick="doit(3); return false;" style="width: 130px; margin: 3px;" /><br />
                        <input type="button" class="button" name="elxscr1" value="open.thumbshots" onclick="doit(1); return false;" ondblclick="doit(1); return false;" style="width: 130px; margin: 3px;" /><br />
                        <input type="button" class="button" name="elxscr4" value="artviper.net" onclick="doit(4); return false;" ondblclick="doit(4); return false;" style="width: 130px; margin: 3px;" /><br />
                        <input type="button" class="button" name="elxscr5" value="thumbshot.de" onclick="doit(5); return false;" ondblclick="doit(5); return false;" style="width: 130px; margin: 3px;" /><br />
                        <input type="button" class="button" name="elxscr6" value="webdesignbook.net" onclick="doit(6); return false;" ondblclick="doit(6); return false;" style="width: 130px; margin: 3px;" /><br />
                        <input type="button" class="button" name="elxscr2" value="nameintel" onclick="doit(2); return false;" ondblclick="doit(2); return false;" style="width: 130px; margin: 3px;" /><br />
                        </td>
                        <td align="center" style="text-align:center;"><div id="ajaxMessage"><br /><?php echo $adminLanguage->A_CMP_WBL_NOTCLICKED; ?></div></td>
                    </tr>
                    </table>
                    </div>                    
					</td>
				</tr>
				</table>
			</td>
			<td width="40%" valign="top">
				<table class="adminform">
				<tr>
					<th><?php echo $adminLanguage->A_PARAMETERS; ?></th>
				</tr>
				<tr>
					<td><?php echo $params->render(); ?></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>

		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		</form>
<?php 
	}
}

?>