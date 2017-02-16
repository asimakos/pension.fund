<?php 
/**
* @version: $Id: admin.content.html.php 62 2010-06-13 15:11:23Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Content
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_content {

	/***********************************/
	/* HTML SHOW LIST OF CONTENT ITEMS */
	/***********************************/
	static public function showContent( &$rows, $section, &$lists, $search, $pageNav, $all=NULL, $redirect, $formfilters=array(), $simpleview=0 ) {
		global $my, $acl, $adminLanguage, $mosConfig_live_site;

		mosCommonHTML::loadOverlib();
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
            window.location = "index2.php?option=com_content&sectionid=<?php echo $section->id; ?>&task=setaccess&access="+acc+"&sid="+cid;
		}

        function switchview(view) {
            var form = document.adminForm;
            try {
                form.onsubmit();
            }
            catch (e) {
            }
            form.simpleview.value = view;
            form.submit();
        }
		</script>
        <script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_content/contentajax.js"></script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="edit" nowrap="nowrap" dir="ltr">
			<?php
			if ( $all ) {
                echo $adminLanguage->A_CMP_CNT_ITEMSMNG.' <span style="font-size:small;">[ '.$adminLanguage->A_SECTION.': '.$adminLanguage->A_ALL.' ]</span>'._LEND;
			} else {
                echo $adminLanguage->A_CMP_CNT_ITEMSMNG.' <span style="font-size:small;">[ '.$adminLanguage->A_SECTION.': '.$section->title.' ]</span>'._LEND;
			}
			?>
			</th>
			<td align="<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>" nowrap="nowrap" valign="top"><?php echo $adminLanguage->A_FILTER; ?>: &nbsp;</td>
			<td valign="top">
			<input type="text" name="search" value="<?php echo $search; ?>" class="inputbox" onchange="document.adminForm.submit();" /><br />
            &raquo; 
            <?php 
            if ($simpleview) {
                echo '<a href="javascript:void(0);" onclick="switchview(\'0\');">'.$adminLanguage->A_EXTENDVIEW.'</a>';
            } else {
                echo '<a href="javascript:void(0);" onclick="switchview(\'1\');">'.$adminLanguage->A_SIMPLEVIEW.'</a>';
            }
            ?>
			</td>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="5"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="5"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
			<th width="20">&nbsp;</th>
			<th class="title"><?php echo $adminLanguage->A_TITLE; ?></th>
			<th>
            <?php echo $adminLanguage->A_PUBLISHED; ?>
                <a href="javascript:void(0);" onclick="javascript:showLayer('selectpubl')">
                <?php 
                echo '<img src=';
                echo ($formfilters['filter_pub'] > -3) ? '"images/downarrow3.png" title="' . $adminLanguage->A_FILTERED . '"' : '"images/downarrow2.png" title="' . $adminLanguage->A_FILTER .'"';
                echo ' alt="filter" border="0" />';
                ?>
                </a>
                <div id="selectpubl" style="display:none; position:absolute;" class="filter">
                    <div class="filtertop"><?php echo $adminLanguage->A_FILTER; ?></div>
                    <?php echo $lists['pubstatus']; ?>
                    <div class="filterbottom">
                        <a href="javascript:void(0);" onclick="javascript:hideLayer('selectpubl');" style="color: #888888;"><?php echo $adminLanguage->A_CLOSE; ?></a>
                    </div>
			     </div>
            </th>
			<th nowrap="nowrap" width="5%"><?php echo $adminLanguage->A_FRONTPAGE; ?></th>
			<th colspan="2" align="center" style="text-align:center;" width="5%"><?php echo $adminLanguage->A_REORDER; ?></th>
			<th width="2%"><?php echo $adminLanguage->A_ORDER; ?></th>
			<th width="1%">
			<a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )" title="<?php echo $adminLanguage->A_SAVEORDER; ?>"><img src="images/filesave.png" border="0" width="16" height="16" /></a>
			</th>
			<th ><?php echo $adminLanguage->A_ACCESS; ?></th>
			<?php if (!$simpleview) { ?>
                <th width="2%"><?php echo $adminLanguage->A_ID; ?></th>
			<?php } ?>
			<?php
			if ( $all ) {
				?>
				<th>
				<?php echo $adminLanguage->A_SECTION; ?>
                <a href="javascript:void(0);" onclick="javascript:showLayer('selectsection')" title="<?php echo ($formfilters['filter_sectionid'] > 0) ? $adminLanguage->A_FILTERED : $adminLanguage->A_FILTER; ?>">
                <?php 
                echo '<img src=';
                echo ($formfilters['filter_sectionid'] > 0) ? '"images/downarrow3.png" title="'.$adminLanguage->A_FILTERED.'"' : '"images/downarrow2.png" title="'.$adminLanguage->A_FILTER.'"';
                echo ' alt="filtered" border="0" />';
                ?>
                </a>
                <div id="selectsection" style="display:none; position:absolute;" class="filter">
                    <div class="filtertop"><?php echo $adminLanguage->A_FILTERSECTION; ?></div>
                    <?php echo $lists['sectionid']; ?>
                    <div class="filterbottom">
                        <a href="javascript:void(0);" onclick="javascript:hideLayer('selectsection');" style="color: #888888;"><?php echo $adminLanguage->A_CLOSE; ?></a>
                    </div>
			     </div>
				</th>
				<?php
			}
			?>
			<th class="title">
			<?php echo $adminLanguage->A_CATEGORY; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectcategory')" title="<?php echo ($formfilters['catid'] > 0) ? $adminLanguage->A_FILTERED : $adminLanguage->A_FILTER; ?>">
            <?php 
            echo '<img src=';
            echo ($formfilters['catid'] > 0) ? '"images/downarrow3.png" alt="'.$adminLanguage->A_FILTERED.'"' : '"images/downarrow2.png" alt="'.$adminLanguage->A_FILTER.'"';
            echo ' border="0" />';
            ?>
            </a>
            <div id="selectcategory" style="display:none; position:absolute;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_FILTERCATEGORY; ?></div>
                <?php echo $lists['catid']; ?>
                <div class="filterbottom">
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selectcategory');" style="color: #888888;"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			 </div>
			</th>
			<?php if (!$simpleview) { ?>
			<th class="title">
			<?php echo $adminLanguage->A_AUTHOR; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectauthor')">
            <?php 
            echo '<img src=';
            echo ($formfilters['filter_authorid'] > 0) ? '"images/downarrow3.png" alt="'.$adminLanguage->A_FILTERED.'" title="'.$adminLanguage->A_FILTERED.'"' : '"images/downarrow2.png" alt="'.$adminLanguage->A_FILTER.'" title="'.$adminLanguage->A_FILTER.'"';
            echo ' border="0" />';
            ?>
            </a>
            <div id="selectauthor" style="display:none; position:absolute;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_FILTERAUTHOR; ?></div>
                <?php echo $lists['authorid']; ?>
                <div class="filterbottom">
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selectauthor');" style="color: #888888;"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			 </div>
			</th>
			<th class="title"><?php echo $adminLanguage->A_LANGUAGE; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectlang');">
            <?php 
            echo '<img src=';
            echo ($formfilters['filter_lang'] != '') ? '"images/downarrow3.png" alt="'.$adminLanguage->A_FILTERED.'" title="'.$adminLanguage->A_FILTERED.'"' : '"images/downarrow2.png" alt="'.$adminLanguage->A_FILTER.'" title="'.$adminLanguage->A_FILTER.'"';
            echo ' border="0" />';
            ?>
            </a>
            <div id="selectlang" style="display:none; position:absolute; <?php echo (_GEM_RTL) ? 'left' : 'right'; ?>:20px;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_FILTLANG; ?></div>
                <?php echo $lists['flangs']; ?>
                <div class="filterbottom">
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selectlang');" style="color: #888888;"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			 </div>
			</th>
			<?php } ?>
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

			$link 	= 'index2.php?option=com_content&sectionid='. $redirect .'&task=edit&hidemainmenu=1&id='. $row->id;

			$row->sect_link = 'index2.php?option=com_sections&task=editA&hidemainmenu=1&id='. $row->sectionid;
			$row->cat_link 	= 'index2.php?option=com_categories&task=editA&hidemainmenu=1&id='. $row->catid;

				//$now = date( $adminLanguage->A_CMP_CNT_DATEFORMAT );
				$now = date("Y-m-d H:i:s");
				if ( $now <= $row->publish_up && $row->state == "1" ) { //se anamoni
					$img = 'publish_y.png';
					$alt = $adminLanguage->A_PUBLISHED;
				} else if ( ( $now <= $row->publish_down || $row->publish_down == "1979-12-19 00:00:00" ) && $row->state == "1" ) { //published
					$img = 'publish_g.png';
					$alt = $adminLanguage->A_PUBLISHED;
				} else if ( $now > $row->publish_down && $row->state == "1" ) { //elixe
					$img = 'publish_r.png';
					$alt = $adminLanguage->A_EXPIRED;
				} elseif ( $row->state == "0" ) { //unpublished
					$img = "publish_x.png";
					$alt = $adminLanguage->A_UNPUBLISHED;
				}
				$times = '';
				if (isset($row->publish_up)) {
					if ($row->publish_up == '1979-12-19 00:00:00') {
						$times .= '<tr><td>'.$adminLanguage->A_CMP_CNT_STARTALW.'</td></tr>';
					} else {
						$times .= '<tr><td>'.$adminLanguage->A_START.': '.$row->publish_up.'</td></tr>';
					}
				}
				if (isset($row->publish_down)) {
					if ($row->publish_down == '2060-01-01 00:00:00') {
						$times .= '<tr><td>'.$adminLanguage->A_CMP_CNT_FINNOEXP.'</td></tr>';
					} else {
						$times .= '<tr><td>'.$adminLanguage->A_CMP_CNT_FINISH.': '.$row->publish_down.'</td></tr>';
					}
				}

			if ( $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_users' ) ) {
				if ( $row->created_by_alias ) {
					$author = $row->created_by_alias;
				} else {
					$linkA 	= 'index2.php?option=com_users&task=editA&hidemainmenu=1&id='.$row->created_by;
					$author = '<a href="'. $linkA .'" title="'.$adminLanguage->A_EDITUSER.'">'.$row->author.'</a>';
				}
			} else {
				if ( $row->created_by_alias ) {
					$author = $row->created_by_alias;
				} else {
					$author = $row->author;
				}
			}

			$date = mosFormatDate( $row->created, _GEM_DATE_FORMLC2 );

			$access = mosCommonHTML::AccessProcessing( $row, $i );
            $accesswin_list = mosAdminMenus::Access($row);
			$checked = mosCommonHTML::CheckedOutProcessing( $row, $i );
			?>
			<tr class="row<?php echo $ff; ?>">
				<td>
                <?php echo ($langok == 0) ? mosWarning($adminLanguage->A_CMP_CNT_CONFI, $adminLanguage->A_CMP_CNT_CONFL) : $pageNav->rowNumber( $i ); ?>
				</td>
				<td align="center" style="text-align:center;"><?php echo $checked; ?></td>
                <td align="center" style="text-align:center;"><?php echo mosToolTip( $date, $adminLanguage->A_DATE, '', 'calendar.png' ); ?></td>
            	<td>
				<?php
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					echo $row->title;
				} else {
					?>
					<a href="<?php echo $link; ?>" title="<?php echo $adminLanguage->A_CMP_CNT_ALTEDITCONT; ?>">
					<?php echo htmlspecialchars($row->title, ENT_QUOTES); ?></a>
					<?php
				}
				?>
				</td>
				<?php
				if ( $times ) {
					?>
					<td align="center" style="text-align:center;"><div id="constatus<?php echo $i; ?>">
					<a href="javascript: void(0);" 
                    onmouseover="return overlib('<table><?php echo $times; ?></table>', CAPTION, '<?php echo $adminLanguage->A_CPUBLISHINFO; ?>', BELOW, <?php echo (_GEM_RTL) ? 'LEFT' : 'RIGHT'; ?>);" onmouseout="return nd();" 
                    onclick="changeContentState('<?php echo $i; ?>', '<?php echo $row->id; ?>', '<?php echo ($row->state) ? 0 : 1; ?>'); return nd();">
					<img src="images/<?php echo $img; ?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" /></a>
                    </div></td>
					<?php
				}
				?>
				<td align="center" style="text-align:center;"><div id="frontpage<?php echo $i; ?>">
				<a href="javascript: void(0);" onclick="changeFrontState('<?php echo $i; ?>', '<?php echo $row->id; ?>', '<?php echo ($row->frontpage) ? 0 : 1; ?>');">
				<img src="images/<?php echo ( $row->frontpage ) ? 'tick.png' : 'publish_x.png';?>" width="12" height="12" border="0" title="<?php echo ( $row->frontpage ) ? $adminLanguage->A_YES : $adminLanguage->A_NO; ?>" /></a>
                </div></td>
				<td style="text-align:<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>;"><?php echo $pageNav->orderUpIcon( $i, ($row->catid == @$rows[$i-1]->catid) ); ?></td>
				<td style="text-align:<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>;"><?php echo $pageNav->orderDownIcon( $i, $n, ($row->catid == @$rows[$i+1]->catid) ); ?></td>
				<td align="center" style="text-align:center;" colspan="2">
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
				</td>
				<td align="center" style="text-align:center;">
                <?php echo $access; ?>
				<div id="accesswin<?php echo $i; ?>" style="display:none; position:absolute;" class="filter">
                    <div class="filtertop"><strong><?php echo $adminLanguage->A_ACCESS; ?></strong></div>
                    <?php echo $accesswin_list; ?>
                    <div class="filterbottom">
                        <input type="button" class="button" onclick="javascript:eAccess('<?php echo $row->id; ?>', 'access<?php echo $row->id; ?>');" name="submit<?php echo $i; ?>" value="<?php echo $adminLanguage->A_SAVE; ?>" /> &nbsp; 
                        <input type="button" class="button" onclick="javascript:hideLayer('accesswin<?php echo $i; ?>');" name="close<?php echo $i; ?>" value="<?php echo $adminLanguage->A_CLOSE; ?>" />
                    </div>
                </div>
                </td>
                <?php 
                if (!$simpleview) {
                ?>
                    <td><?php echo $row->id; ?></td>
				<?php 
                }

				if ( $all ) {
					?>
					<td>
					<a href="<?php echo $row->sect_link; ?>" title="<?php echo $adminLanguage->A_EDITSECTION; ?>">
					<?php echo $row->section_name; ?></a>
					</td>
					<?php
				}
				?>
				<td>
				<?php echo mosToolTip( $catlangs, $adminLanguage->A_CATLANGES, '', 'language.png' ); ?>
				<a href="<?php echo $row->cat_link; ?>" title="<?php echo $adminLanguage->A_EDITCATEGORY; ?>">
				<?php echo $row->name; ?></a>
				</td>
				<?php 
				if (!$simpleview) {
                ?>
                    <td><?php echo $author; ?></td>
                    <td>
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
                <?php 
                }
                ?>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>

		<?php echo $pageNav->getListFooter(); ?>
		<?php mosCommonHTML::ContentLegend(); ?>

		<input type="hidden" name="option" value="com_content" />
		<input type="hidden" name="sectionid" value="<?php echo $section->id; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
		<input type="hidden" name="simpleview" value="<?php echo intval($simpleview); ?>" />
		</form>
		<?php
	}


	/***************************************/
	/* HTML SHOW CONTENT TREE PER LANGUAGE */
	/***************************************/
	static public function showTree( &$rows, $lang, &$lists ) {
	   global $my, $acl, $adminLanguage, $mainframe;
?>
        <script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/includes/js/ajax.js"></script>
        <script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/includes/js/edit_tree.js"></script>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="edit" nowrap="nowrap">
				<?php echo $adminLanguage->A_CMP_CNT_SITMAPFOR; ?> <?php echo ($lang == '') ? $adminLanguage->A_CMP_CNT_ALLLANGS : $adminLanguage->A_CMP_CNT_LANG.': '.$lang; ?>
			</th>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_LANGUAGE; ?>:</td>
			<td><?php echo $lists['flangs']; ?></td>
		</tr>
		</table>
		<div id="ajaxMessage"></div>
        <div align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>">
        <ul id="elxis_tree">
		<?php
		$k = 0;
		$cur_section = 0;
		$cur_category = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];
		?>
        <?php
            //if new section
        if ($row->sec_id != $cur_section) {
            $cur_section = $row->sec_id;
            if ($i != 0 ) { echo "</span>"; }
            
            $aclass = ($row->sec_pub != 1) ? ' class="treeunp"' : '';
        ?>
            <li class="sec">
            <span style="cursor: pointer;" onclick="javascript:hideLayer('sec<?php echo $cur_section; ?>');" title="<?php echo $adminLanguage->A_CMP_CNT_SHOWHIDE; ?>">
            <img src="images/downarrow-1.png" border="0" alt="" /></span> &nbsp; 
            <img src="images/folder_blue.png" border="0" alt="<?php echo $adminLanguage->A_SECTION; ?>" title="<?php echo $adminLanguage->A_SECTION; ?>" />
            <a href="javascript:void(0);" id="section<?php echo $row->sec_id; ?>" title="<?php echo $adminLanguage->A_CMP_CNT_PHRENAME; ?>"<?php echo $aclass; ?>><?php echo $row->sec_title; ?></a>
            <a href="index2.php?option=com_sections&scope=content&task=editA&hidemainmenu=1&id=<?php echo $row->sec_id; ?>" title="<?php echo $adminLanguage->A_EDITSECTION; ?>">
            <img src="<?php echo $mainframe->getCfg('live_site'); ?>/includes/js/ThemeOffice/edit.png" border="0" alt="<?php echo $adminLanguage->A_EDIT; ?>" /></a>
            <span<?php echo (_GEM_RTL) ? ' dir="rtl"' : ''; ?>>( <?php echo ($row->sec_lang != '') ? $row->sec_lang : $adminLanguage->A_ALL; ?> )</span>
            </li>
        <?php
            echo "<span id=\"sec".$cur_section."\">";
            }
            //if new category
            if ($row->cat_id != $cur_category) {
            $cur_category = $row->cat_id;
            
            $aclass = ($row->cat_pub != 1) ? ' class="treeunp"' : '';
        ?>
                <ul><li class="cat"><img src="images/folder_grey.png" border="0" alt="<?php echo $adminLanguage->A_CATEGORY; ?>" title="<?php echo $adminLanguage->A_CATEGORY; ?>" />
                <a href="javascript:void(0);" id="category<?php echo $row->cat_id; ?>" title="<?php echo $adminLanguage->A_CMP_CNT_PHRENAME; ?>"<?php echo $aclass; ?>><?php echo $row->cat_title; ?></a>
                <a href="index2.php?option=com_categories&section=content&task=editA&hidemainmenu=1&id=<?php echo $row->cat_id; ?>" title="<?php echo $adminLanguage->A_EDITCATEGORY; ?>">
                <img src="<?php echo $mainframe->getCfg('live_site'); ?>/includes/js/ThemeOffice/edit.png" border="0" alt="<?php echo $adminLanguage->A_EDIT; ?>" /></a>
                <span<?php echo (_GEM_RTL) ? ' dir="rtl"' : ''; ?>>( <?php echo ($row->cat_lang != '') ? $row->cat_lang : $adminLanguage->A_ALL; ?> )</span>
                </li></ul>

        <?php
            }
            $aclass = ($row->state < 0) ? ' class="treeunp"' : '';
        ?>
                <ul><li class="item">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <img src="images/document.png" border="0" alt="<?php echo $adminLanguage->A_CMP_CNT_CONTITEM; ?>" title="<?php echo $adminLanguage->A_CMP_CNT_CONTITEM; ?>" />
                <a href="javascript:void(0);" id="item<?php echo $row->id; ?>" title="<?php echo $adminLanguage->A_CMP_CNT_PHRENAME; ?>"<?php echo $aclass; ?>><?php echo htmlspecialchars($row->title, ENT_QUOTES); ?></a>
                <a href="index2.php?option=com_content&sectionid=0&task=edit&hidemainmenu=1&id=<?php echo $row->id; ?>" title="<?php echo $adminLanguage->A_CMP_CNT_EDITITEM; ?>">
                <img src="<?php echo $mainframe->getCfg('live_site'); ?>/includes/js/ThemeOffice/edit.png" border="0" alt="<?php echo $adminLanguage->A_EDIT; ?>" /></a>
				<span<?php echo (_GEM_RTL) ? ' dir="rtl"' : ''; ?>>( <?php echo ($row->language != '') ? $row->language : $adminLanguage->A_ALL; ?> )</span>
                </li></ul>

			<?php
			$k = 1 - $k;
		}
		if ( $i>0 ) { echo '</span>'._LEND; }
		?>
		</ul>
        </div>
        <div><br />
		<?php 
        echo '<u>'.$adminLanguage->A_CMP_CNT_NOTES.'</u>:<br />';
        echo '&#149; '.$adminLanguage->A_CMP_CNT_PRSHREN.'<br />';
        echo '&#149; '.$adminLanguage->A_CMP_CNT_EMPCATSEC.'<br />';
        echo '&#149; '.$adminLanguage->A_CMP_CNT_TREEUNPUBL;
        ?>
        </div>
		<input type="hidden" name="option" value="com_content" />
		<input type="hidden" name="task" value="tree" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
		<?php
	}


	/*********************************/
	/* HTML SHOW ARCHIVED ITEMS LIST */
	/*********************************/
	static public function showArchive( &$rows, $section, &$lists, $search, $pageNav, $option, $all=NULL, $redirect, $formfilters=array() ) {
		global $my, $acl, $adminLanguage;

		mosCommonHTML::loadOverlib();
?>
		<script type="text/javascript">
		function submitbutton(pressbutton) {
			if (pressbutton == 'remove') {
				if (document.adminForm.boxchecked.value == 0) {
					alert("<?php echo $adminLanguage->A_CMP_CNT_TRASH; ?>");
				} else if ( confirm("<?php echo $adminLanguage->A_CMP_CNT_TRASHMESS; ?>")) {
					submitform('remove');
				}
			} else {
				submitform(pressbutton);
			}
		}
		</script>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="edit">
			<?php 
			if ( $all ) {
			?>
				<?php echo $adminLanguage->A_CMP_CNT_ARCHMANAGER; ?> <span style="font-size:small;"><?php echo $adminLanguage->A_SECTION; ?>: <?php echo $adminLanguage->A_ALL; ?></span>
			<?php
			} else {
			?>
				<?php echo $adminLanguage->A_CMP_CNT_ARCHMANAGER; ?> <span style="font-size:small;"><?php echo $adminLanguage->A_SECTION; ?>: <?php echo $section->title; ?></span>
			<?php
			}
			?>
			</th>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_FILTER; ?>:</td>
			<td>
				<input type="text" name="search" value="<?php echo $search;?>" class="text_area" onchange="document.adminForm.submit();" />
			</td>
			<td><?php echo $lists['sectionid']; ?></td>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="5"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
			<th class="title"><?php echo $adminLanguage->A_TITLE; ?></th>
			<th width="2%"><?php echo $adminLanguage->A_ORDER; ?></th>
			<th width="1%">
			<a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )" title="<?php echo $adminLanguage->A_SAVEORDER; ?>"><img src="images/filesave.png" border="0" width="16" height="16" alt="<?php echo $adminLanguage->A_SAVEORDER; ?>" /></a>
			</th>
			<th class="title">
			<?php echo $adminLanguage->A_CATEGORY; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectcategory')">
            <?php 
            echo '<img src=';
            echo ($formfilters['catid'] > 0) ? '"images/downarrow3.png" title="'.$adminLanguage->A_FILTERED.'"' : '"images/downarrow2.png" title="'.$adminLanguage->A_FILTER.'"';
            echo ' alt="" border="0" />';
            ?>
            </a>
            <div id="selectcategory" style="display:none; position:absolute;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_FILTERCATEGORY; ?></div>
                <?php echo $lists['catid']; ?>
                <div class="filterbottom">
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selectcategory');" style="color: #888888;"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			 </div>
			</th>
			<th class="title">
			<?php echo $adminLanguage->A_AUTHOR; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectauthor')">
            <?php 
            echo '<img src=';
            echo ($formfilters['filter_authorid'] > 0) ? '"images/downarrow3.png" title="'.$adminLanguage->A_FILTERED.'"' : '"images/downarrow2.png" title="'.$adminLanguage->A_FILTER.'"';
            echo ' alt="filter" border="0" />';
            ?>
            </a>
            <div id="selectauthor" style="display:none; position:absolute;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_FILTERAUTHOR; ?></div>
                <?php echo $lists['authorid']; ?>
                <div class="filterbottom">
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selectauthor');" style="color: #888888;"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			 </div>
			</th>
			<th align="center" style="text-align:center;"><?php echo $adminLanguage->A_DATE; ?></th>
			<th class="title"><?php echo $adminLanguage->A_LANGUAGE; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectlang')">
            <?php 
            echo '<img src=';
            echo ($formfilters['filter_lang'] != '') ? '"images/downarrow3.png" title="'.$adminLanguage->A_FILTERED.'"' : '"images/downarrow2.png" title="'.$adminLanguage->A_FILTER.'"';
            echo ' alt="filter" border="0" />';
            ?>
            </a>
            <div id="selectlang" style="display:none; position:absolute; <?php echo (_GEM_RTL) ? 'left' : 'right'; ?>:20px;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_CMP_CNT_FL; ?></div>
                <?php echo $lists['flangs']; ?>
                <div class="filterbottom">
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selectlang');" style="color: #888888;"><?php echo $adminLanguage->A_CLOSE; ?></a>
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

			$row->cat_link 	= 'index2.php?option=com_categories&task=editA&hidemainmenu=1&id='. $row->catid;

			if ( $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_users' ) ) {
				if ( $row->created_by_alias ) {
					$author = $row->created_by_alias;
				} else {
					$linkA 	= 'index2.php?option=com_users&task=editA&hidemainmenu=1&id='.$row->created_by;
					$author = '<a href="'.$linkA.'" title="'.$adminLanguage->A_EDITUSER.'">'.$row->author.'</a>';
				}
			} else {
				if ( $row->created_by_alias ) {
					$author = $row->created_by_alias;
				} else {
					$author = $row->author;
				}
			}

			$date = mosFormatDate( $row->created, '%x' );
			?>
			<tr class="row<?php echo $ff; ?>">
				<td>
                <?php echo ($langok == 0) ? mosWarning($adminLanguage->A_CMP_LNG_CONFI, $adminLanguage->A_CMP_LNG_CONFL) : $pageNav->rowNumber( $i ); ?>
				</td>
				<td><?php echo mosHTML::idBox( $i, $row->id ); ?></td>
				<td><?php echo $row->title; ?></td>
				<td align="center" style="text-align:center;" colspan="2">
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="inputbox" style="text-align: center;" />
				</td>
				<td>
				<?php echo mosToolTip( $catlangs, $adminLanguage->A_CATLANGES, '', 'language.png' ); ?>
				<a href="<?php echo $row->cat_link; ?>" title="<?php echo $adminLanguage->A_EDITCATEGORY; ?>">
				<?php echo $row->name; ?></a>
				</td>
				<td><?php echo $author; ?></td>
				<td><?php echo $date; ?></td>
                <td>
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

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="sectionid" value="<?php echo $section->id; ?>" />
		<input type="hidden" name="task" value="showarchive" />
		<input type="hidden" name="returntask" value="showarchive" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
		</form>
		<?php
	}


	/*************************/
	/* HTML ADD/EDIT CONTENT */
	/*************************/
	static public function editContent( &$row, $section, &$lists, &$sectioncategories, &$images, &$params, $option, $redirect, &$menus, $sub=0 ) {
		global $mosConfig_live_site, $adminLanguage, $mosConfig_lifetime, $my;

        //CSRF prevention
        $tokname = 'token'.$my->id;
		$mytoken = md5(uniqid(rand(), TRUE));
        $_SESSION[$tokname] = $mytoken;

		mosMakeHtmlSafe( $row );

		$create_date = null;
		if (intval( $row->created ) <> 0) {
			$create_date = mosFormatDate( $row->created, $adminLanguage->A_CMP_CNT_DATECREATED, '0' );
		}
		$mod_date = null;
		if (intval( $row->modified ) <> 0) {
			$mod_date = mosFormatDate( $row->modified, $adminLanguage->A_CMP_CNT_DATEMODIFIED, '0' );
		}

		$tabs = new mosTabs(0);

		//used to hide "Reset Hits" when hits = 0
		if ( !$row->hits ) {
			$visibility = "style='display: none; visibility: hidden;'";
		} else {
			$visibility = "";
		}

		mosCommonHTML::loadOverlib();
		mosCommonHTML::loadCalendar();
		?>
		<script type="text/javascript">
		var sectioncategories = new Array;
		<?php
		$i = 0;
		foreach ($sectioncategories as $k=>$items) {
			foreach ($items as $v) {
				echo "sectioncategories[".$i++."] = new Array( '$k','".addslashes( $v->value )."','".addslashes( $v->text )."' );\n\t\t";
			}
		}
		?>

		var folderimages = new Array;
		<?php
		$i = 0;
		foreach ($images as $k=>$items) {
			foreach ($items as $v) {
				echo "folderimages[".$i++."] = new Array( '$k','".addslashes( $v->value )."','".addslashes( $v->text )."' );\n\t\t";
			}
		}
        
		?>

		function submitbutton(pressbutton) {
			var form = document.adminForm;

			if ( pressbutton == 'menulink' ) {
				if ( form.menuselect.value == "" ) {
					alert( "<?php echo $adminLanguage->A_ALERT_SELECT_MENU; ?>" );
					return;
				} else if ( form.link_name.value == "" ) {
					alert( "<?php echo $adminLanguage->A_ALERT_ENTER_NAME_MENUITEM; ?>" );
					return;
				}
			}

			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			//assemble the images back into one field
			var temp = new Array;
			for (var i=0, n=form.imagelist.options.length; i < n; i++) {
				temp[i] = form.imagelist.options[i].value;
			}
			form.images.value = temp.join( '\n' );

			//do field validation
			if (form.title.value == ""){
				alert( "<?php echo $adminLanguage->A_CMP_CNT_MUSTTITLE; ?>" );
			} else if (trim(form.seotitle.value) == ""){
                alert( "<?php echo $adminLanguage->A_SEOTEMPTY; ?>" );
			} else if (form.sectionid.value == "-1"){
				alert( "<?php echo $adminLanguage->A_CMP_CNT_MUSTSECTN; ?>" );
			} else if (form.catid.value == "-1"){
				alert( "<?php echo $adminLanguage->A_CMP_CNT_MUSTCATEG; ?>" );
 			} else if (form.catid.value == ""){
 				alert( "<?php echo $adminLanguage->A_CMP_CNT_MUSTCATEG; ?>" );
			} else {
				<?php getEditorContents( 'editor1', 'introtext' ) ; ?>
				<?php getEditorContents( 'editor2', 'maintext' ) ; ?>
				submitform( pressbutton );
			}
		}
		</script>
		<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_content/contentajax.js"></script>

		<div class="countdown">
			<?php echo $adminLanguage->A_TIMESESSEXP; ?>: <span id="countdown"></span>
		</div>
		
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading" border="1">
		<tr>
			<th class="edit">
			<?php echo $adminLanguage->A_CMP_CNT_CONTITEM; ?>: 
			<?php echo $row->id ? $adminLanguage->A_EDIT : $adminLanguage->A_NEW; ?> 
			<?php
			if ( $row->id ) {
			?>
				<span style="font-size: small;" dir="ltr">[ <?php echo $adminLanguage->A_SECTION; ?>: <?php echo $section; ?> ]</span>
			<?php 
			}
			?>
			</th>
		</tr>
		</table>
		<table cellspacing="0" cellpadding="0" width="100%">
		<tr>
			<td valign="top" width="50%">
				<table width="100%" class="adminform">
				<tr>
					<td>
						<table cellspacing="0" cellpadding="0" border="0" width="100%">
						<tr>
							<th colspan="4"><?php echo $adminLanguage->A_CMP_CNT_ITEMDETLS; ?></th>
						<tr>
						<tr>
                        	<td><?php echo $adminLanguage->A_SECTION; ?>:</td>
							<td><?php echo $lists['sectionid']; ?></td>
							<td><?php echo $adminLanguage->A_CATEGORY; ?>:</td>
							<td><?php echo $lists['catid']; ?></td>
						</tr>
                        <tr>
							<td><?php echo $adminLanguage->A_TITLE; ?>:</td>
							<td colspan="3">
							<input type="text" name="title" class="inputbox" size="30" maxlength="100" value="<?php echo $row->title; ?>" />
							</td>
						</tr>
						<tr>
							<td valign="top"><?php echo $adminLanguage->A_SEOTITLE; ?>:</td>
							<td colspan="3">
							<input type="text" name="seotitle" id="seotitle" dir="ltr" class="inputbox" value="<?php echo $row->seotitle; ?>" size="30" maxlength="100" />
							<?php echo mosToolTip($adminLanguage->A_SEOTHELP); ?><br />
                            <a href="javascript:void(null);" onclick="suggestSEO()"><?php echo $adminLanguage->A_SEOTSUG; ?></a> &nbsp; | &nbsp; 
                            <a href="javascript:void(null);" onclick="validateSEO()"><?php echo $adminLanguage->A_SEOTVAL; ?></a><br />
                            <div id="valseo" style="height: 20px;"></div>                              
                            </td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_CMP_CNT_INTRO; ?><br />
					<?php
					//parameters : areaname, content, hidden field, width, height, rows, cols
					editorArea( 'editor1',  $row->introtext , 'introtext', '400', '200', '50', '20' ); 
					?>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_CMP_CNT_MAIN; ?><br />
					<?php
					//parameters : areaname, content, hidden field, width, height, rows, cols
					editorArea( 'editor2',  $row->maintext , 'maintext', '400', '350', '50', '20' );
					?>
					</td>
				</tr>
				</table>
			</td>
			<td valign="top">
			<div>
			<table width="100%">
				<tr>
					<td>
						<table width="100%">
						<tr>
							<td>
					<?php
					$tabs->startPane("content-pane");
					$tabs->startTab($adminLanguage->A_PUBLISHING, "publish-page");
					?>
					<table class="adminform">
					<tr>
						<th colspan="2"><?php echo $adminLanguage->A_PUBLISHINGINFO; ?></th>
					<tr>
					<tr>
						<td valign="top"><?php echo $adminLanguage->A_CMP_CNT_FRONTPAGE; ?>:</td>
						<td>
						<input type="checkbox" name="frontpage" value="1"<?php echo $row->frontpage ? ' checked="checked"' : ''; ?> />
						</td>
					</tr>
					<tr>
						<td valign="top"><?php echo $adminLanguage->A_PUBLISHED; ?>:</td>
						<td>
						<input type="checkbox" name="published" value="1"<?php echo $row->state ? ' checked="checked"' : ''; ?> />
						</td>
					</tr>
					<tr>
						<td valign="top"><?php echo $adminLanguage->A_LANGUAGE; ?>:</td>
						<td><?php echo $lists['languages']; ?></td>
					</tr>
					<tr>
						<td valign="top"><?php echo $adminLanguage->A_ACCESSLEVEL; ?>:</td>
						<td><?php echo $lists['access']; ?></td>
					</tr>
					<tr>
						<td valign="top"><?php echo $adminLanguage->A_CMP_CNT_AUTHOR; ?>:</td>
						<td>
						<input type="text" name="created_by_alias" size="30" maxlength="100" value="<?php echo $row->created_by_alias; ?>" class="text_area" />
						</td>
					</tr>
					<tr>
						<td valign="top"><?php echo $adminLanguage->A_CMP_CNT_CREATOR; ?>:</td>
						<td><?php echo $lists['created_by']; ?></td>
					</tr>
					<tr>
						<td valign="top"><?php echo $adminLanguage->A_ORDERING; ?>:</td>
						<td><?php echo $lists['ordering']; ?></td>
					</tr>
					<tr>
						<td valign="top"><?php echo $adminLanguage->A_CMP_CNT_OVERRIDE; ?></td>
						<td>
						<input type="text" name="created" id="created" dir="ltr" class="inputbox" size="25" maxlength="19" value="<?php echo $row->created; ?>" />
						<input name="reset" type="reset" class="button" onclick="return showCalendar('created', 'y-mm-dd');" value="...">
						</td>
					</tr>
					<tr>
						<td valign="top" align="right"><?php echo $adminLanguage->A_CMP_CNT_STRTPUB; ?>:</td>
						<td>
						<input type="text" name="publish_up" id="publish_up" dir="ltr" class="inputbox" size="25" maxlength="19" value="<?php echo $row->publish_up; ?>" />
						<input type="reset" class="button" value="..." onclick="return showCalendar('publish_up', 'y-mm-dd');" />
						</td>
					</tr>
					<tr>
						<td valign="top" align="right"><?php echo $adminLanguage->A_CMP_CNT_FNSHPUB; ?>:</td>
						<td>
						<input type="text" name="publish_down" id="publish_down" dir="ltr" class="inputbox" size="25" maxlength="19" value="<?php echo $row->publish_down; ?>" />
						<input type="reset" class="button" value="..." onclick="return showCalendar('publish_down', 'y-mm-dd');" />
						</td>
					</tr>
					</table>

					<table class="adminform">
					<?php
					if ( $row->id ) {
						?>
						<tr>
							<td><strong><?php echo $adminLanguage->A_MENU_CONTENT; ?>:</strong></td>
							<td><?php echo $row->id; ?></td>
						</tr>
						<?php
					}
					?>
					<tr>
						<td valign="top"><strong><?php echo $adminLanguage->A_STATE; ?>:</strong></td>
						<td>
						<?php echo $row->state > 0 ? $adminLanguage->A_PUBLISHED : ($row->state < 0 ? $adminLanguage->A_ARCHIVED : $adminLanguage->A_CMP_CNT_DRFTUNPUB );?>
						</td>
					</tr>
					<tr >
						<td valign="top"><strong><?php echo $adminLanguage->A_HITS; ?></strong>:</td>
						<td><?php echo $row->hits; ?>
						<div <?php echo $visibility; ?>>
						<input name="reset_hits" type="button" class="button" value="<?php echo $adminLanguage->A_CMP_CNT_RESETHIT;?>" onclick="submitbutton('resethits');">
						</div>
						</td>
					</tr>
					<tr>
						<td valign="top"><strong><?php echo $adminLanguage->A_CMP_CNT_REVISED; ?></strong>:</td>
						<td><?php echo $row->version.' '.$adminLanguage->A_CMP_CNT_TIMES; ?></td>
					</tr>
					<tr>
						<td valign="top"><strong><?php echo $adminLanguage->A_CREATED; ?></strong></td>
						<td>
						<?php echo $row->created ? $create_date.'</td></tr><tr><td valign="top" align="right"><strong>'.$adminLanguage->A_CMP_CNT_BY.'</strong></td><td>'.$row->creator : $adminLanguage->A_CMP_CNT_NEWDOC; ?>
						</td>
					</tr>
					<tr>
						<td valign="top"><strong><?php echo $adminLanguage->A_CMP_CNT_LASTMOD; ?></strong></td>
						<td>
						<?php echo $row->modified ? $mod_date.'</td></tr><tr><td valign="top" align="right"><strong>'.$adminLanguage->A_CMP_CNT_BY.'</strong></td><td>'.$row->modifier : $adminLanguage->A_CMP_CNT_NOTMOD; ?>
						</td>
					</tr>
                    <?php if ($sub) { ?>
					<tr>
						<td valign="top"><strong><?php echo $adminLanguage->A_CMP_CNT_COMMENTS; ?></strong></td>
						<td><?php echo $row->comments; ?></td>
					</tr>
					<?php } ?>
					</table>
					<?php
					$tabs->endTab();
					$tabs->startTab($adminLanguage->A_IMAGES, "images-page" );
					?>
					<table class="adminform" width="100%">
					<tr>
						<th colspan="2"><?php echo $adminLanguage->A_MOSIMAGE; ?></th>
					<tr>
					<tr>
						<td colspan="6"><?php echo $adminLanguage->A_SUBFOLDER; ?>: <?php echo $lists['folders']; ?></td>
					</tr>
					<tr>
						<td><?php echo $adminLanguage->A_GALLERY; ?>:<br />
						<?php echo $lists['imagefiles']; ?>
						</td>
						<td valign="top">
						<img name="view_imagefiles" src="../images/M_images/blank.png" width="100" alt="" />
						</td>
					</tr>
					<tr>
						<td>
						<input class="button" type="button" value="<?php echo $adminLanguage->A_ADD; ?>" onclick="addSelectedToList('adminForm','imagefiles','imagelist')" />
						</td>
					</tr>
					<tr>
						<td><?php echo $adminLanguage->A_CONTENTIMAGES; ?>:<br />
						<?php echo $lists['imagelist']; ?>
						</td>
						<td valign="top">
						<img name="view_imagelist" src="../images/M_images/blank.png" width="100" alt="" />
						</td>
					</tr>
					<tr>
						<td>
						<input class="button" type="button" value="<?php echo $adminLanguage->A_UP; ?>" onclick="moveInList('adminForm','imagelist',adminForm.imagelist.selectedIndex,-1)" />
						<input class="button" type="button" value="<?php echo $adminLanguage->A_DOWN; ?>" onclick="moveInList('adminForm','imagelist',adminForm.imagelist.selectedIndex,+1)" />
						<input class="button" type="button" value="<?php echo $adminLanguage->A_REMOVE; ?>" onclick="delSelectedFromList('adminForm','imagelist')" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<?php echo $adminLanguage->A_EDITIMAGE; ?>:
							<table>
							<tr>
								<td><?php echo $adminLanguage->A_SOURCE; ?>:</td>
								<td><input type="text" name="_source" dir="ltr" class="inputbox" value="" /></td>
							</tr>
							<tr>
								<td><?php echo $adminLanguage->A_IMAGEALIGN; ?>:</td>
								<td><?php echo $lists['_align']; ?></td>
							</tr>
							<tr>
								<td><?php echo $adminLanguage->A_ALTTEXT; ?>:</td>
								<td><input type="text" name="_alt" class="inputbox" value="" /></td>
							</tr>
							<tr>
								<td><?php echo $adminLanguage->A_IMAGEBORDER; ?>:</td>
								<td><input type="text" name="_border" class="inputbox" dir="ltr" value="" size="3" maxlength="1" /></td>
							</tr>
							<tr>
								<td><?php echo $adminLanguage->A_IMAGECAPTION; ?>:</td>
								<td><input type="text" class="inputbox" name="_caption" value="" size="30" /></td>
							</tr>
							<tr>
								<td><?php echo $adminLanguage->A_IMAGECAPTIONPOS; ?>:</td>
								<td><?php echo $lists['_caption_position']; ?></td>
							</tr>
							<tr>
								<td><?php echo $adminLanguage->A_IMAGECAPTIONALIGN; ?>:</td>
								<td><?php echo $lists['_caption_align']; ?></td>
							</tr>
							<tr>
								<td><?php echo $adminLanguage->A_WIDTH; ?>:</td>
								<td><input type="text" class="inputbox" name="_width" dir="ltr" value="" size="5" maxlength="5" /></td>
							</tr>
							<tr>
								<td colspan="2">
								<input type="button" value="<?php echo $adminLanguage->A_APPLY; ?>" class="button" onclick="applyImageProps()" />
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
					<?php
					$tabs->endTab();
					$tabs->startTab($adminLanguage->A_PARAMETERS, "params-page" );
					?>
					<table class="adminform">
					<tr>
						<th colspan="2"><?php echo $adminLanguage->A_PARAMCONTROL; ?></th>
					<tr>
					<tr>
						<td><?php echo $adminLanguage->A_PARCONTROLEXPL; ?><br /><br /></td>
					</tr>
					<tr>
						<td><?php echo $params->render();?></td>
					</tr>
					</table>
					<?php
					$tabs->endTab();
					$tabs->startTab($adminLanguage->A_METAINFO, "metadata-page" );
					?>
					<table class="adminform">
					<tr>
						<th colspan="2"><?php echo $adminLanguage->A_METADATA; ?></th>
					</tr>
					<tr>
						<td><?php echo $adminLanguage->A_DESCRIPTION; ?>:<br />
						<textarea name="metadesc" class="text_area" cols="30" rows="3" style="width:300px; height:50px;"><?php echo str_replace('&','&amp;',$row->metadesc); ?></textarea>
						</td>
					</tr>
					<tr>
						<td><?php echo $adminLanguage->A_KEYWORDS; ?>:<br />
						<textarea name="metakey" class="text_area" cols="30" rows="3" style="width:300px; height:50px;"><?php echo str_replace('&','&amp;',$row->metakey); ?></textarea>
						</td>
					</tr>
					<tr>
						<td>
						<input type="button" class="button" value="<?php echo $adminLanguage->A_CMP_CNT_ADDETC;?>" onclick="f=document.adminForm;f.metakey.value=document.adminForm.sectionid.options[document.adminForm.sectionid.selectedIndex].text+', '+getSelectedText('adminForm','catid')+', '+f.title.value+f.metakey.value;" />
						</td>
					</tr>
					</table>
					<?php
					$tabs->endTab();
					$tabs->startTab($adminLanguage->A_LINKTOMENU, "link-page" );
					?>
					<table class="adminform">
					<tr>
						<th colspan="2"><?php echo $adminLanguage->A_LINKTOMENU; ?></th>
					</tr>
					<tr>
						<td colspan="2"><?php echo $adminLanguage->A_CMP_CNT_LINKCI; ?><br /><br /></td>
					</tr>
					<tr>
						<td valign="top" nowrap="nowrap"><?php echo $adminLanguage->A_SELECTAMENU; ?></td>
						<td><?php echo $lists['menuselect']; ?></td>
					</tr>
					<tr>
						<td valign="top"><?php echo $adminLanguage->A_MENUITEMNAME; ?></td>
						<td><input type="text" name="link_name" class="inputbox" value="" size="30" /></td>
					</tr>
					<tr>
						<td></td>
						<td>
						<input name="menu_link" type="button" class="button" value="<?php echo $adminLanguage->A_LINKTOMENU; ?>" onclick="submitbutton('menulink');" />
						</td>
					</tr>
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
						mosCommonHTML::menuLinksContent( $menus );
					}
					?>
					</table>
					<?php 
						$tabs->endTab();
                        $tabs->startTab($adminLanguage->A_CMP_CNT_RELLINKS, "relatedlinks-page" );
					?>
					<table class="adminlist">
					<tr>
						<th colspan="2"><?php echo $adminLanguage->A_CMP_CNT_RELLINKS; ?></th>
					</tr>
					<tr>
					   <td colspan="2"><?php echo $adminLanguage->A_CMP_CNT_RELLINKSD; ?></td>
					</tr>
					<tr class="row0">
						<td><?php echo $adminLanguage->A_TITLE; ?> 1</td>
						<td><input type="text" name="title1" class="inputbox" value="<?php echo $lists['title1']; ?>" /></td>
					</tr>
					<tr class="row0">
						<td><?php echo $adminLanguage->A_LINK; ?> 1</td>
						<td><input type="text" name="link1" dir="ltr" class="inputbox" value="<?php echo $lists['link1']; ?>" size="40" /></td>
					</tr>
					<tr class="row1">
						<td><?php echo $adminLanguage->A_TITLE; ?> 2</td>
						<td><input type="text" name="title2" class="inputbox" value="<?php echo $lists['title2']; ?>" /></td>
					</tr>
					<tr class="row1">
						<td><?php echo $adminLanguage->A_LINK; ?> 2</td>
						<td><input type="text" name="link2" dir="ltr" class="inputbox" value="<?php echo $lists['link2']; ?>" size="40" /></td>
					</tr>
					<tr class="row0">
						<td><?php echo $adminLanguage->A_TITLE; ?> 3</td>
						<td><input type="text" name="title3" class="inputbox" value="<?php echo $lists['title3']; ?>" /></td>
					</tr>
					<tr class="row0">
						<td><?php echo $adminLanguage->A_LINK; ?> 3</td>
						<td><input type="text" name="link3" dir="ltr" class="inputbox" value="<?php echo $lists['link3']; ?>" size="40" /></td>
					</tr>
					<tr class="row1">
						<td><?php echo $adminLanguage->A_TITLE; ?> 4</td>
						<td><input type="text" name="title4" class="inputbox" value="<?php echo $lists['title4']; ?>" /></td>
					</tr>
					<tr class="row1">
						<td><?php echo $adminLanguage->A_LINK; ?> 4</td>
						<td><input type="text" name="link4" dir="ltr" class="inputbox" value="<?php echo $lists['link4']; ?>" size="40" /></td>
					</tr>
					<tr class="row0">
						<td><?php echo $adminLanguage->A_TITLE; ?> 5</td>
						<td><input type="text" name="title5" class="inputbox" value="<?php echo $lists['title5']; ?>" /></td>
					</tr>
					<tr class="row0">
						<td><?php echo $adminLanguage->A_LINK; ?> 5</td>
						<td><input type="text" name="link5" dir="ltr" class="inputbox" value="<?php echo $lists['link5']; ?>" size="40" /></td>
					</tr>
					</table>
							<?php 
							$tabs->endTab();
							$tabs->endPane();
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
		</td>
	</tr>
</table>

		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="version" value="<?php echo $row->version; ?>" />
		<input type="hidden" name="mask" value="0" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="images" value="" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="sub" value="<?php echo $sub; ?>" />
		<input type="hidden" name="<?php echo $tokname; ?>" value="<?php echo $mytoken; ?>" autocomplete="off" />
		</form>

		<script type="text/javascript">
		function sessioncountdown(secs) {
			var cel = document.getElementById('countdown');
			if (secs > 0) {
				var dmins = Math.ceil(secs/60);
				var text = '';
				if (dmins > 1) {
					text = '<strong>'+dmins+'</strong> <?php echo $adminLanguage->A_MINUTES; ?>';
				} else if (secs == 60) {
					text = '<strong>1</strong> <?php echo $adminLanguage->A_MINUTE; ?>';
				} else if (secs > 30) {
					text = '<strong>'+secs+'</strong> <?php echo $adminLanguage->A_SECONDS; ?>';
				} else if (secs > 1) {
					text = '<span style="color:red;"><strong>'+secs+'</strong> <?php echo $adminLanguage->A_SECONDS; ?></span>';
				} else if (secs == 1) {
					text = '<span style="color:red;"><strong>1</strong> <?php echo $adminLanguage->A_SECOND; ?></span>';
				}
				cel.innerHTML = text;
				secs = secs -1;
				setTimeout("sessioncountdown("+secs+")",1000);				
			} else {
				cel.innerHTML = '<span style="color: red; font-weight: bold;"><?php echo $adminLanguage->A_SESSEXPIRED; ?></span>';
			}
		}

		sessioncountdown('<?php echo $mosConfig_lifetime; ?>');
		</script>

	<?php 
	}


	/************************/
	/* HTML MOVE ITEMS FORM */
	/************************/
	static public function moveSection( $cid, $sectCatList, $option, $sectionid, $items ) {
       global $adminLanguage;
?>
		<script type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			//do field validation
			if (!getSelectedValue( 'adminForm', 'sectcat' )) {
				alert( "<?php echo $adminLanguage->A_CMP_CNT_SOMTHING; ?>" );
			} else {
				submitform( pressbutton );
			}
		}
		</script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="edit"><?php echo $adminLanguage->A_CMP_CNT_MVEITEMS; ?></th>
		</tr>
		</table>

		<table class="adminform">
		<tr>
		    <th width="40%"><?php echo $adminLanguage->A_CMP_CNT_MVESECCAT; ?></th>
		    <th><?php echo $adminLanguage->A_CMP_CNT_ITMSMVED; ?></th>
		</tr>
		<tr>
			<td valign="top">
                <?php echo $sectCatList; ?>
			</td>
			<td valign="top">
			<?php
			echo '<ol>'._LEND;
			foreach ( $items as $item ) {
				echo '<li>'.$item.'</li>'._LEND;
			}
			echo '</ol>'._LEND;
			?>
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="sectionid" value="<?php echo $sectionid; ?>" />
		<input type="hidden" name="task" value="" />
		<?php
		foreach ($cid as $id) {
			echo '<input type="hidden" name="cid[]" value="'.$id.'" />'._LEND;
		}
		?>
		</form>
<?php 
	}


	/***********************/
	/* HTML COPY ITEM FORM */
	/***********************/
	static public function copySection( $option, $cid, $sectCatList, $sectionid, $items  ) {
        global $adminLanguage;
?>
		<script type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			//do field validation
			if (!getSelectedValue( 'adminForm', 'sectcat' )) {
				alert( "<?php echo $adminLanguage->A_CMP_CNT_SECCAT; ?>" );
			} else {
				submitform( pressbutton );
			}
		}
		</script>
		
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="edit"><?php echo $adminLanguage->A_CMP_CNT_CPYITEMS; ?></th>
		</tr>
		</table>

		<table class="adminform">
		<tr>
            <th width="40%"><?php echo $adminLanguage->A_CMP_CNT_CPYSECCAT; ?></th>
            <th><?php echo $adminLanguage->A_CMP_CNT_ITMSCPED; ?></th>
        </tr>
        <tr>
			<td valign="top">
                <?php echo $sectCatList; ?>
			</td>
			<td valign="top">
                <?php 
                echo '<ol>'._LEND;
                foreach ( $items as $item ) {
                    echo '<li>'.$item.'</li>'._LEND;;
                }
                echo '</ol>'._LEND;
                ?>
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="sectionid" value="<?php echo $sectionid; ?>" />
		<input type="hidden" name="task" value="" />
		<?php 
		foreach ($cid as $id) {
			echo '<input type="hidden" name="cid[]" value="'.$id.'" />'._LEND;
		}
		?>
		</form>
<?php 
	}


	/****************************/
	/* HTML TRANSLATE ITEM FORM */
	/****************************/
	static public function tranlate_Item($option, $alllangs, $initLang, $row) {
		global $adminLanguage, $mainframe;
?>
		<script type="text/javascript">
		/* <![CDATA[ */
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			submitform( pressbutton );
		}
		/* ]]> */
		</script>

		<form action="index3.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="edit"><?php echo $adminLanguage->A_TRANSLATE; ?></th>
		</tr>
		</table>

		<table class="adminform">
		<tr>
            <th width="40%"><?php echo $adminLanguage->A_CMP_CNT_TRSOUDEST; ?></th>
            <th><?php echo $adminLanguage->A_CMP_CNT_TRITEMS; ?></th>
        </tr>
        <tr>
			<td valign="top">
<?php 
			echo $adminLanguage->A_CMP_CNT_FROM." \n";
			echo '<select name="langfrom" dir="ltr" class="selectbox">'."\n";
			foreach ($alllangs as $lkey => $lval) {
				$sel = ($lval[0] == $initLang) ? ' selected="selected"' : '';
				echo '<option value="'.$lkey.'"'.$sel.'>'.$lval[1]."</option>\n";
			}
			echo "</select>\n";
			echo ' '.$adminLanguage->A_TO." \n";
			echo '<select name="langto" dir="ltr" class="selectbox">'."\n";
			foreach ($alllangs as $lkey => $lval) {
				$sel = ($lkey == 'en') ? ' selected="selected"' : '';
				echo '<option value="'.$lkey.'"'.$sel.'>'.$lval[1]."</option>\n";
			}
			echo "</select>\n";
?>
			</td>
			<td valign="top">
                <?php 
                echo $row['title'].' &nbsp; <span style="color: green;">';
                echo (trim($row['language']) == '') ? $adminLanguage->A_ALL_LANGS : '- '.$row['language'].' - ';
                echo '</span>'._LEND;
                ?>
			</td>
		</tr>
		</table>
		<br /><br />
        <?php echo $adminLanguage->A_CMP_CNT_TRNOTE; ?>
        <br /><br />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
		</form>
<?php 
	}


    /*******************************/
    /* HTML VIEW SUBMITTED CONTENT */
    /*******************************/
	static public function viewSubContent( &$rows, $pageNav ) {
		global $my, $acl, $adminLanguage, $mosConfig_live_site;

		mosCommonHTML::loadOverlib();
?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="edit" nowrap="nowrap"><?php echo $adminLanguage->A_SUB_CONTENT; ?></th>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="5"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="5"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
			<th width="20">&nbsp;</th>
			<th class="title"><?php echo $adminLanguage->A_TITLE; ?></th>
			<th class="title"><?php echo $adminLanguage->A_SEOTITLE; ?></th>
			<th><?php echo $adminLanguage->A_SECTION; ?></th>
			<th><?php echo $adminLanguage->A_CATEGORY; ?></th>
			<th><?php echo $adminLanguage->A_AUTHOR; ?></th>
			<th class="title"><?php echo $adminLanguage->A_LANGUAGE; ?></th>
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

			$link = 'index2.php?option=com_content&task=editsub&hidemainmenu=1&id='.$row->id;

			$row->sect_link = 'index2.php?option=com_sections&task=editA&hidemainmenu=1&id='.$row->sectionid;
			$row->cat_link 	= 'index2.php?option=com_categories&task=editA&hidemainmenu=1&id='.$row->catid;

			if ( $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_users' ) ) {
				$linkA 	= 'index2.php?option=com_users&task=editA&hidemainmenu=1&id='.$row->created_by;
				$author = '<a href="'. $linkA .'" title="'.$adminLanguage->A_EDITUSER.'">'. $row->author.'</a>';
			} else {
				$author = $row->author;
			}

			$date = mosFormatDate( $row->created, _GEM_DATE_FORMLC2 );
			?>
			<tr class="row<?php echo $ff; ?>">
				<td>
                <?php echo ($langok == 0) ? mosWarning($adminLanguage->A_CMP_CNT_CONFI, $adminLanguage->A_CMP_CNT_CONFL) : $pageNav->rowNumber( $i ); ?>
				</td>
				<td align="center" style="text-align:center;">
                    <input type="checkbox" id="cb<?php echo $i; ?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" />
                </td>
                <td align="center" style="text-align:center;"><?php echo mosToolTip( $date, $adminLanguage->A_DATE, '', 'calendar.png' ); ?></td>
                <td>
                    <a href="javascript:void(null);" onclick="hideMainMenu();return listItemTask('cb<?php echo $i;?>','editsub')" title="<?php echo $adminLanguage->A_CMP_CNT_ALTEDITCONT; ?>">
                    <?php echo htmlspecialchars($row->title, ENT_QUOTES); ?></a></td>
				</td>
				<td><?php echo $row->seotitle; ?></td>
				<td align="center" style="text-align:center;">
					<a href="<?php echo $row->sect_link; ?>" title="<?php echo $adminLanguage->A_EDITSECTION; ?>"><?php echo $row->section; ?></a>
				</td>
				<td align="center" style="text-align:center;">
					<a href="<?php echo $row->cat_link; ?>" title="<?php echo $adminLanguage->A_EDITCATEGORY; ?>"><?php echo $row->category; ?></a>
				</td>
                <td align="center" style="text-align:center;"><?php echo $author; ?></td>
                <td>
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
		<input type="hidden" name="option" value="com_content" />
		<input type="hidden" name="task" value="subcontent" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
		<?php
	}

}

?>