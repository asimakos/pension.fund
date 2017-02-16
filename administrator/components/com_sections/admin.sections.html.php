<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Sections
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class sections_html {

	/**********************/
	/* HTML LIST SECTIONS */
	/**********************/
	static public function show( &$rows, $scope, $myid, &$pageNav, $option ) {
		global $my, $adminLanguage, $mainframe;

		mosCommonHTML::loadOverlib();
?>
		<script type="text/javascript">
		<!--
		function eAccess( cid, access ) {
            if (document.getElementById) {
                var acc = document.getElementById(access).value;
			} else if (document.all) {
				var acc = document.all[access].value;
            } else if (document.layers) {
                var acc = document.layers[access].value;
            }
            window.location = "index2.php?option=com_sections&task=setaccess&access="+acc+"&sid="+cid;
		}
		//-->
		</script>
        <script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/includes/js/ajax_new.js"></script>
        <script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/components/com_sections/ajaxsections.js"></script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			 <th class="sections"><?php echo $adminLanguage->A_SECTIONMANAGER; ?></th>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
			</th>
			<th class="title"><?php echo $adminLanguage->A_CMP_SEC_NAME; ?></th>
			<th><?php echo $adminLanguage->A_PUBLISHED; ?></th>
			<th colspan="2"><?php echo $adminLanguage->A_REORDER; ?></th>
			<th align="<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>"><?php echo $adminLanguage->A_ORDER; ?></th>
			<th width="20">
			<a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="<?php echo $adminLanguage->A_SAVEORDER; ?>" /></a>
			</th>
			<th><?php echo $adminLanguage->A_ACCESS; ?></th>
			<th nowrap="nowrap"><?php echo $adminLanguage->A_CMP_SEC_ID; ?></th>
			<th nowrap="nowrap"><?php echo $adminLanguage->A_CMP_SEC_NBCTG; ?></th>
			<th nowrap="nowrap"><?php echo $adminLanguage->A_NBACTIVE; ?></th>
			<th nowrap="nowrap"><?php echo $adminLanguage->A_NBTRASH; ?></th>
			<th class="title"><?php echo $adminLanguage->A_LANGUAGE; ?></th>
		</tr>
		<?php
		$k = 0;
		for ( $i=0, $n=count( $rows ); $i < $n; $i++ ) {
			$row = &$rows[$i];

			$link = 'index2.php?option=com_sections&scope=content&task=editA&hidemainmenu=1&id='. $row->id;

			$access = mosCommonHTML::AccessProcessing( $row, $i );
            $accesswin_list = mosAdminMenus::Access($row);

			$checked = mosCommonHTML::CheckedOutProcessing( $row, $i );
			$img = $row->published ? 'publish_g.png' : 'publish_x.png';
            $alt = $row->published ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
			?>
			<tr class="row<?php echo $k; ?>">
				<td align="center" style="text-align:center;"><?php echo $pageNav->rowNumber( $i ); ?></td>
				<td>
					<?php echo $checked; ?>
				</td>
				<td>
				<?php
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					echo '<span title="'.$row->title.'">'.$row->name.'</span>';
				} else {
					echo '<a href="'.$link.'" title="'.$adminLanguage->A_EDIT.' '.$row->title.'">'.$row->name.'</a>';
				}
				?>
				</td>
				<td align="center" style="text-align:center;">
                    <div id="sectionstatus<?php echo $i; ?>">
					   <a href="javascript:void(0);" title="<?php echo $alt; ?>" 
                       onclick="changeSectionState('<?php echo $i; ?>', '<?php echo $row->id; ?>', '<?php echo ($row->published) ? 0 : 1; ?>');">
                       <img src="images/<?php echo $img; ?>" border="0" alt="<?php echo $alt; ?>" /></a>
                    </div>
				</td>
				<td align="<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>">
					<?php echo $pageNav->orderUpIcon( $i ); ?>
				</td>
				<td align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>">
					<?php echo $pageNav->orderDownIcon( $i, $n ); ?>
				</td>
				<td align="center" style="text-align:center;" colspan="2">
					<input type="text" name="order[]" dir="ltr" size="5" value="<?php echo $row->ordering; ?>" class="inputbox" style="text-align: center;" />
				</td>
				<td align="center" style="text-align:center;">
				<?php echo $access; ?>
                <div id="accesswin<?php echo $i; ?>" style="display:none; position:absolute;" class="filter">
                    <div class="filtertop"><strong><?php echo $adminLanguage->A_ACCESS; ?></strong></div>
                    <?php echo $accesswin_list; ?>
                    <div class="filterbottom">
                        <input type="button" class="button" onclick="javascript:eAccess('<?php echo $row->id; ?>', 'access<?php echo $row->id; ?>');" name="submit<?php echo $i; ?>" value="<?php echo $adminLanguage->A_SAVE; ?>"> &nbsp; 
                        <input type="button" class="button" onclick="javascript:hideLayer('accesswin<?php echo $i; ?>');" name="close<?php echo $i; ?>" value="<?php echo $adminLanguage->A_CLOSE; ?>">
                    </div>
                </div>
				</td>
				<td align="center" style="text-align:center;"><?php echo $row->id; ?></td>
				<td align="center" style="text-align:center;"><?php echo $row->categories; ?></td>
				<td align="center" style="text-align:center;"><?php echo $row->active; ?></td>
				<td align="center" style="text-align:center;"><?php echo $row->trash; ?></td>
                <td align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>">
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

				<?php
				$k = 1 - $k;
				?>
			</tr>
			<?php
		}
		?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="scope" value="<?php echo $scope; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="chosen" value="" />
		<input type="hidden" name="act" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
<?php 
	}


	/*************************/
	/* HTML ADD/EDIT SECTION */
	/*************************/
	static public function edit( &$row, $option, &$lists, &$menus ) {
		global $mainframe, $adminLanguage;

		if ( $row->name != '' ) {
			$name = $row->name;
		} else {
			$name = $adminLanguage->A_CMP_SEC_NEWS;
		}
		if ($row->image == '') {
			$row->image = 'blank.png';
		}
		mosCommonHTML::loadOverlib();
?>
		<script type="text/javascript">
		<!--
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			if ( pressbutton == 'menulink' ) {
				if ( form.menuselect.value == "" ) {
					alert( "<?php echo $adminLanguage->A_ALERT_SELECT_MENU; ?>" );
					return;
				} else if ( form.link_type.value == "" ) {
					alert( "<?php echo $adminLanguage->A_CMP_SEC_PSMT; ?>" );
					return;
				} else if ( form.link_name.value == "" ) {
					alert( "<?php echo $adminLanguage->A_ALERT_ENTER_NAME_MENUITEM; ?>" );
					return;
				}
			}

			if (form.name.value == ""){
				alert("<?php echo $adminLanguage->A_CMP_SEC_MSTN; ?>");
			} else if (form.title.value ==""){
				alert("<?php echo $adminLanguage->A_CMP_SEC_MSTT; ?>");
			} else if (trim(form.seotitle.value) == ""){
                alert( "<?php echo $adminLanguage->A_SEOTEMPTY; ?>" );
			} else {
				<?php getEditorContents( 'editor1', 'description' ); ?>
				submitform(pressbutton);
			}
		}
		//-->
		</script>
		<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/components/com_sections/ajaxsections.js"></script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="sections">
				<?php 
				echo $adminLanguage->A_SECTION.': '. $name;
				echo $row->id ? ': '.$adminLanguage->A_EDIT : '';
				?>
			</th>
		</tr>
		</table>
		<table width="100%">
		<tr>
			<td valign="top" width="60%">
				<table class="adminform">
				<tr>
					<th colspan="3"><?php echo $adminLanguage->A_CMP_SEC_DTLS; ?></th>
				<tr>
				<tr>
					<td width="150"><?php echo $adminLanguage->A_CMP_SEC_SCPE; ?>:</td>
					<td colspan="2"><strong><?php echo $row->scope; ?></strong></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_TITLE; ?>:</td>
					<td colspan="2">
                        <input type="text" name="title" class="inputbox" value="<?php echo $row->title; ?>" size="50" maxlength="50" title="<?php echo $adminLanguage->A_CMP_SEC_SRNAME; ?>" />
					</td>
				</tr>
				<tr>
					<td>
                        <?php echo (isset($row->section)) ? $adminLanguage->A_CATEGORY : $adminLanguage->A_SECTION; ?> 
                        <?php echo $adminLanguage->A_NAME; ?>:
					</td>
					<td colspan="2">
                        <input type="text" name="name" class="inputbox" value="<?php echo $row->name; ?>" size="50" maxlength="255" title="<?php echo $adminLanguage->A_CMP_SEC_LNAME; ?>" />
					</td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_SEOTITLE; ?>:</td>
					<td colspan="2">
						<input name="seotitle" id="seotitle" dir="ltr" type="text" class="inputbox" value="<?php echo $row->seotitle; ?>" size="30" maxlength="100" />
						<?php echo mosToolTip($adminLanguage->A_SEOTHELP); ?><br />
                        <a href="javascript:;" onclick="suggestSEO()"><?php echo $adminLanguage->A_SEOTSUG; ?></a> &nbsp; | &nbsp; 
                        <a href="javascript:;" onclick="validateSEO()"><?php echo $adminLanguage->A_SEOTVAL; ?></a><br />
                        <div id="valseo" style="height: 20px;"></div>                              
                    </td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_IMAGE; ?>:</td>
					<td><?php echo $lists['image']; ?></td>
					<td rowspan="4" width="50%">
					<?php
						$path = $mainframe->getCfg('live_site').'/images/';
						if ($row->image != 'blank.png') { $path .= 'stories/'; }
					?>
					<img src="<?php echo $path; ?><?php echo $row->image; ?>" name="imagelib" width="80" height="80" border="2" alt="<?php echo $adminLanguage->A_PREVIEW; ?>" />
					</td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_IMAGEPOSITION; ?>:</td>
					<td><?php echo $lists['image_position']; ?></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_ORDERING; ?>:</td>
					<td><?php echo $lists['ordering']; ?></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_ACCESSLEVEL; ?>:</td>
					<td><?php echo $lists['access']; ?></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_PUBLISHED; ?>:</td>
					<td><?php echo $lists['published']; ?></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_MENU_LANGUAGES; ?>:</td>
					<td><?php echo $lists['languages']; ?></td>
				</tr>
				<tr>
					<td colspan="3">
					<?php echo $adminLanguage->A_DESCRIPTION; ?>:<br />
					<?php
					// parameters : areaname, content, hidden field, width, height, rows, cols
					editorArea( 'editor1', $row->description , 'description', '480', '300', '60', '30' ) ; ?>
					</td>
				</tr>
				</table>
			</td>
			<td valign="top" align="<?php echo (_GEM_RTL) ? 'left': 'right'; ?>">
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tr>
					<td width="40%">
			<?php
			if ( $row->id > 0 ) {
    		?>
				<table class="adminform">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_LINKTOMENU; ?></th>
				<tr>
				<tr>
					<td colspan="2">
                        <?php echo $adminLanguage->A_CREATEMENUIT; ?><br /><br />
					</td>
				<tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_SELECTAMENU; ?></td>
					<td><?php echo $lists['menuselect']; ?></td>
				<tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_CMP_SEC_MTYPE; ?></td>
					<td><?php echo $lists['link_type']; ?></td>
				<tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_MENUITEMNAME; ?></td>
					<td><input type="text" name="link_name" class="inputbox" value="" size="25" /></td>
				<tr>
				<tr>
					<td></td>
					<td>
                        <input name="menu_link" type="button" class="button" value="<?php echo $adminLanguage->A_LINKTOMENU; ?>" onclick="submitbutton('menulink');" />
					</td>
				<tr>
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_EXMENULINKS; ?></th>
				</tr>
				<?php
				if ( $menus == NULL ) {
					?>
					<tr>
						<td colspan="2"><?php echo $adminLanguage->A_NONE; ?></td>
					</tr>
					<?php
				} else {
					mosCommonHTML::menuLinksSecCat( $menus );
				}
				?>
				</table>
			<?php
			} else {
			?>
			<table class="adminform" width="40%">
				<tr><th>&nbsp;</th></tr>
				<tr><td><?php echo $adminLanguage->A_MENULINKS_WHEN_SAVED; ?></td></tr>
			</table>
			<?php
			}
			?>
			</td>
		</tr>
		</table>
			</td>
					</tr>
					</table>
					</div>
					</td>
				</tr>
			</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="scope" value="<?php echo $row->scope; ?>" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="oldtitle" value="<?php echo $row->title; ?>" />
		</form>
		<?php
	}


	/**
	* Form to select Section to copy Category to
	*/
	static public function copySectionSelect( $option, $cid, $categories, $contents, $section ) {
		global $adminLanguage;
?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="sections">
				<?php echo $adminLanguage->A_CMP_SEC_COPY; ?>
			</th>
		</tr>
		</table>

		<table class="adminform">
		<tr>
			<td width="3%"></td>
			<td valign="top">
			<strong><?php echo $adminLanguage->A_CMP_SEC_COPT; ?>:</strong><br />
			<input class="inputbox" type="text" name="title" value="" size="35" maxlength="50" title="<?php echo $adminLanguage->A_CMP_SEC_NNAM; ?>" />
			<br /><br />
			</td>
			<td valign="top">
			<strong><?php echo $adminLanguage->A_CMP_SEC_BCOPD; ?>:</strong><br />
			<?php
			echo "<ol>";
			foreach ( $categories as $category ) {
				echo "<li>". $category->name ."</li>";
				echo _LEND."<input type=\"hidden\" name=\"category[]\" value=\"$category->id\" />";
			}
			echo "</ol>";
			?>
			</td>
			<td valign="top">
			<strong><?php echo $adminLanguage->A_CMP_SEC_ICOPD; ?>:</strong>
			<br />
			<?php
			echo "<ol>";
			foreach ( $contents as $content ) {
				echo "<li>". $content->title ."</li>";
				echo _LEND."<input type=\"hidden\" name=\"content[]\" value=\"$content->id\" />";
			}
			echo "</ol>";
			?>
			</td>
			<td valign="top">
				<?php echo $adminLanguage->A_CMP_SEC_WCPY; ?>
			</td>
		</tr>
		</table>
		<br /><br />

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="section" value="<?php echo $section; ?>" />
		<input type="hidden" name="boxchecked" value="1" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="scope" value="content" />
		<?php
		foreach ( $cid as $id ) {
			echo "\n <input type=\"hidden\" name=\"cid[]\" value=\"$id\" />";
		}
		?>
		</form>
<?php 
	}
}

?>