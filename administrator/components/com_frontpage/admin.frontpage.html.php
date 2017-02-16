<?php 
/**
* @version: $Id: admin.frontpage.html.php 62 2010-06-13 15:11:23Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Frontpage
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_content {

	/********************************/
	/* HTML DISPLAY FRONTPAGE ITEMS */
    /********************************/
	static public function showList( &$rows, $search, $pageNav, $option, $lists, $formfilters=array(), $simpleview=0 ) {
		global $my, $acl, $adminLanguage, $mosConfig_live_site;

		mosCommonHTML::loadOverlib();
?>
		<script type="text/javascript">
		/* <![CDATA[ */
		function eAccess( cid, access ) {
            if (document.getElementById) {
                var acc = document.getElementById(access).value;
			} else if (document.all) {
				var acc = document.all[access].value;
            } else if (document.layers) {
                var acc = document.layers[access].value;
            }
            window.location = "index2.php?option=com_frontpage&task=setaccess&access="+acc+"&sid="+cid;
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
        /* ]]> */
		</script>
        <script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_frontpage/frontpageajax.js"></script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="frontpage"><?php echo $adminLanguage->A_FP_MANAGER; ?></th>
			<td align="<?php echo (_GEM_RTL) ? 'left': 'right'; ?>" nowrap="nowrap">
                <?php echo $adminLanguage->A_FILTER; ?>: 
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
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20">
                <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
			</th>
			<th class="title"><?php echo $adminLanguage->A_TITLE; ?></th>
			<th><?php echo $adminLanguage->A_PUBLISHED; ?></th>
            <?php 
            if (!$simpleview) {
            ?>
            <th colspan="2"><?php echo $adminLanguage->A_REORDER; ?></th>
            <?php 
            }
            ?>
			<th style="text-align:<?php echo (_GEM_RTL) ? 'left': 'right'; ?>;"><?php echo $adminLanguage->A_ORDER; ?></th>
			<th style="text-align:<?php echo (_GEM_RTL) ? 'right': 'left'; ?>;">
                <a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )" title="<?php echo $adminLanguage->A_SAVEORDER; ?>">
                <img src="images/filesave.png" border="0" width="16" height="16" alt="<?php echo $adminLanguage->A_SAVEORDER; ?>" />
                </a>
			</th>
			<th><?php echo $adminLanguage->A_ACCESS; ?></th>
			<th class="title">
			<?php echo $adminLanguage->A_SECTION; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectsection')">
                <?php 
                echo '<img src=';
                echo ($formfilters['filter_sectionid'] > 0) ? '"images/downarrow3.png" title="'.$adminLanguage->A_FILTERED.'"' : '"images/downarrow2.png" title="'.$adminLanguage->A_FILTER.'"';
                echo ' alt="filter" border="0" />';
                ?>
                </a>
                <div id="selectsection" style="display:none; position:absolute;" class="filter">
                    <div class="filtertop"><?php echo $adminLanguage->A_FILTERSECTION; ?></div>
                    <?php echo $lists['sectionid']; ?>
                    <div class="filterbottom">
                        <a href="javascript:void(0);" onclick="javascript:hideLayer('selectsection');" style="color: #888888"><?php echo $adminLanguage->A_CLOSE; ?></a>
                    </div>
			     </div>
			</th>
			<th class="title">
			<?php echo $adminLanguage->A_CATEGORY; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectcategory')">
            <?php 
            echo '<img src=';
            echo ($formfilters['catid'] > 0) ? '"images/downarrow3.png" title="'.$adminLanguage->A_FILTERED.'"' : '"images/downarrow2.png" title="'.$adminLanguage->A_FILTER.'"';
            echo 'border="0" />';
            ?>
            </a>
            <div id="selectcategory" style="display:none; position:absolute;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_FILTERCATEGORY; ?></div>
                <?php echo $lists['catid']; ?>
                <div class="filterbottom">
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selectcategory');" style="color: #888888"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			 </div>
			</th>
            <?php 
            if (!$simpleview) {
            ?>
			<th class="title">
			<?php echo $adminLanguage->A_AUTHOR; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectauthor')">
            <?php 
            echo '<img src=';
            echo ($formfilters['filter_authorid'] > 0) ? '"images/downarrow3.png" title="' . $adminLanguage->A_FILTERED . '"' : '"images/downarrow2.png" title="' . $adminLanguage->A_FILTER . '"';
            echo ' alt="filter" border="0" />';
            ?>
            </a>
            <div id="selectauthor" style="display:none; position:absolute;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_FILTERAUTHOR; ?></div>
                <?php echo $lists['authorid']; ?>
                <div class="filterbottom">
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selectauthor');" style="color: #888888"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			 </div>
			</th>
			<th align="center" style="text-align:center;"><?php echo $adminLanguage->A_LANGUAGE; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectlang')">
            <?php 
            echo '<img src=';
            echo ($formfilters['filter_lang'] != '') ? '"images/downarrow3.png" title="' . $adminLanguage->A_FILTERED . '"' : '"images/downarrow2.png" title="' . $adminLanguage->A_FILTER . '"';
            echo ' alt="filter" border="0" />';
            ?>
            </a>
            <div id="selectlang" style="display:none; position:absolute; <?php echo (_GEM_RTL) ? 'left' : 'right'; ?>:20px;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_FILTLANG; ?></div>
                <?php echo $lists['flangs']; ?>
                <div class="filterbottom">
                    <a href="javascript:void(null);" onclick="javascript:hideLayer('selectlang');" style="color: #888888"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			 </div>
			</th>
            <?php 
            }
            ?>
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

			$link = 'index2.php?option=com_content&sectionid=0&task=edit&hidemainmenu=1&id='. $row->id;
			$row->sect_link = 'index2.php?option=com_sections&task=editA&hidemainmenu=1&id='. $row->sectionid;
			$row->cat_link 	= 'index2.php?option=com_categories&task=editA&hidemainmenu=1&id='. $row->catid;

				$now = date('Y-m-d H:i:s');
				if ( $now <= $row->publish_up && $row->state == "1" ) {
					$img = 'publish_y.png';
					$alt = $adminLanguage->A_PUBLISHED;
				} else if ( ( $now <= $row->publish_down || $row->publish_down == "2060-01-01 00:00:00" ) && $row->state == "1" ) {
					$img = 'publish_g.png';
					$alt = $adminLanguage->A_PUBLISHED;
				} else if ( $now > $row->publish_down && $row->state == "1" ) {
					$img = 'publish_r.png';
					$alt = $adminLanguage->A_EXPIRED;
				} elseif ( $row->state == "0" ) {
					$img = "publish_x.png";
					$alt = $adminLanguage->A_UNPUBLISHED;
				}

				$times = '';
				    if ( isset( $row->publish_up ) ) {
						  if ( $row->publish_up == '1979-12-19 00:00:00' ) {
								$times .= "<tr><td>". $adminLanguage->A_CMP_FP_STARTALW ."</td></tr>";
						  } else {
								$times .= "<tr><td>". $adminLanguage->A_CMP_FP_START .": ". $row->publish_up ."</td></tr>";
						  }
				    }
				    if ( isset( $row->publish_down ) ) {
						  if ( $row->publish_down == '2060-01-01 00:00:00' ) {
								$times .= "<tr><td>". $adminLanguage->A_CMP_FP_FINNOEXP ."</td></tr>";
						  } else {
						  $times .= "<tr><td>". $adminLanguage->A_CMP_FP_FINISH .": ". $row->publish_down ."</td></tr>";
						  }
				    }

			$access = mosCommonHTML::AccessProcessing( $row, $i );
            $accesswin_list = mosAdminMenus::Access($row);
			$checked = mosCommonHTML::CheckedOutProcessing( $row, $i );

			if ( $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_users' ) ) {
				if ( $row->created_by_alias ) {
					$author = $row->created_by_alias;
				} else {
					$linkA 	= 'index2.php?option=com_users&task=editA&hidemainmenu=1&id='. $row->created_by;
					$author = '<a href="'.$linkA.'" title="'.$adminLanguage->A_EDITUSER.'">'. $row->author .'</a>';
				}
			} else {
				if ( $row->created_by_alias ) {
					$author = $row->created_by_alias;
				} else {
					$author = $row->author;
				}
			}
			?>
			<tr class="row<?php echo $ff; ?>">
				<td>
                    <?php echo ($langok == 0) ? mosWarning($adminLanguage->A_CMP_FP_CONFI, $adminLanguage->A_CMP_FP_CONFL) : $pageNav->rowNumber( $i ); ?>
				</td>
				<td>
                    <?php echo $checked; ?>
				</td>
				<td>
				<?php
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					echo $row->title;
				} else {
				?>
					<a href="<?php echo $link; ?>" title="<?php echo $adminLanguage->A_EDIT.' '.$adminLanguage->A_MENU_CONTENT; ?>">
                        <?php echo $row->title; ?>
					</a>
					<?php
				}
				?>
				</td>
				<?php
				if ( $times ) {
				?>
					<td align="center" style="text-align:center;">
                        <div id="frostatus<?php echo $i; ?>">
                        <a href="javascript: void(0);" onmouseover="return overlib('<table><?php echo $times; ?></table>', CAPTION, '<?php echo $adminLanguage->A_CPUBLISHINFO; ?>', BELOW, <?php echo (_GEM_RTL) ? 'LEFT' : 'RIGHT'; ?>);" onmouseout="return nd();" 
                        onclick="changeFrontState('<?php echo $i; ?>', '<?php echo $row->id; ?>', '<?php echo ($row->state) ? 0 : 1; ?>'); return nd();">
                        <img src="images/<?php echo $img; ?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" /></a>
                        </div>
                    </td>
					<?php
				}

				if (!$simpleview) {
				?>
				    <td  style="text-align:<?php echo (_GEM_RTL) ? 'left': 'right'; ?>;"><?php echo $pageNav->orderUpIcon( $i ); ?></td>
				    <td  style="text-align:<?php echo (_GEM_RTL) ? 'right': 'left'; ?>;"><?php echo $pageNav->orderDownIcon( $i, $n ); ?></td>
				<?php 
				}
				?>
				<td align="center" style="text-align:center;" colspan="2">
                    <input type="text" name="order[]" size="5" value="<?php echo $row->fpordering; ?>" class="inputbox" style="text-align: center" />
				</td>
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
				<td>
                    <a href="<?php echo $row->sect_link; ?>" title="<?php echo $adminLanguage->A_EDITSECTION; ?>">
                        <?php echo $row->sect_name; ?>
                    </a>
				</td>
				<td>
                    <?php echo mosToolTip( $catlangs, $adminLanguage->A_CATLANGES, '', 'language.png' ); ?>
                    <a href="<?php echo $row->cat_link; ?>" title="<?php echo $adminLanguage->A_EDITCATEGORY; ?>">
                        <?php echo $row->name; ?>
                    </a>
				</td>
				<?php 
				if (!$simpleview) {
				?>
				    <td><?php echo $author; ?></td>
                    <td align="<?php echo (_GEM_RTL) ? 'right': 'left'; ?>">
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

		<?php
		echo $pageNav->getListFooter();
		mosCommonHTML::ContentLegend();
		?>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="simpleview" value="<?php echo intval($simpleview); ?>" />
		</form>
		<?php
	}
}
?>