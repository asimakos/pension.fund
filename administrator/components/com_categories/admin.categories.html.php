<?php 
/**
* @version: $Id: admin.categories.html.php 54 2010-06-12 21:05:09Z sannosi $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Categories
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class categories_html {

	/***************************************/
	/* HTML DISPLAY A SECTION'S CATEGORIES */
	/***************************************/
	static public function show( &$rows, $section, $section_name, &$pageNav, &$lists, $type, $formfilters=array(), $simpleview=0) {
		global $my, $mainframe, $adminLanguage;

		mosCommonHTML::loadOverlib();
		$textdir = (_GEM_RTL == 1) ? 'right' : 'left';
		$rtl = (_GEM_RTL == 1) ? ' dir="rtl"' : '';
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
            window.location = "index2.php?option=com_categories&section=<?php echo $section; ?>&task=setaccess&access="+acc+"&sid="+cid;
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
        <script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/components/com_categories/categoriesajax.js"></script>

		<form action="index2.php" method="post" name="adminForm">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <table class="adminheading">
                <tr>
                    <th class="categories">
                    <?php 
                    if ( $section == 'content') {
                        echo $adminLanguage->A_CATEGORYMANAGER.' ';
                    ?>
                        <span class="small">[ <?php echo $adminLanguage->A_MENU_CONTENT; ?>: <?php echo $adminLanguage->A_ALL ;?> ]</span>
                    <?php 
                    } else {
				        if ( is_numeric( $section ) ) {
                            $query = 'com_content&sectionid='.$section;
				        } else {
                            if ( $section == 'com_contact_details' ) {
                                $query = 'com_contact';
                            } else {
                                $query = $section;
                            }
                        }
                        echo $adminLanguage->A_CATEGORYMANAGER.' <span style="font-size: small;"'.$rtl.'>[ '.$section_name.' ]</span>'._LEND;
                    }
                    ?>
                    </th>
                </tr>
                </table>
            </td>
            <td align="<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>">&raquo;
            <?php 
            if ($simpleview) {
                echo '<a href="javascript:void(0);" onclick="switchview(\'0\');">'.$adminLanguage->A_EXTENDVIEW.'</a>';
            } else {
                echo '<a href="javascript:void(0);" onclick="switchview(\'1\');">'.$adminLanguage->A_SIMPLEVIEW.'</a>';
            }
            ?>&nbsp;
            </td>
        </tr>
        </table>

		<table class="adminlist">
		<tr>
			<th width="10" align="<?php echo $textdir; ?>"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20">
                <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
			</th>
			<th class="title"><?php echo $adminLanguage->A_CMP_CAT_NAME; ?></th>
			<th><?php echo $adminLanguage->A_PUBLISHED; ?></th>
			<?php
			if ( $section <> 'content') {
				?>
				<th colspan="2"><?php echo $adminLanguage->A_REORDER; ?></th>
				<?php
			}
			?>
			<th align="<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>"><?php echo $adminLanguage->A_ORDER; ?></th>
			<th align="<?php echo $textdir; ?>">
			<a href="javascript: saveorder( <?php echo count( $rows )-1; ?> );" title="<?php echo $adminLanguage->A_SAVEORDER; ?>">
            <img src="images/filesave.png" border="0" width="16" height="16" alt="<?php echo $adminLanguage->A_SAVEORDER; ?>" /></a>
			</th>
			<th><?php echo $adminLanguage->A_ACCESS; ?></th>
			<?php
				if ( $section == 'content') {
			?>
				<th align="<?php echo $textdir; ?>">
                <?php echo $adminLanguage->A_SECTION; ?>
                <a href="javascript:void(0);" onclick="javascript:showLayer('selectsection');">
                <?php 
                echo '<img src=';
                echo ($formfilters['sectionid'] > 0) ? '"images/downarrow3.png" title="'.$adminLanguage->A_FILTERED.'"' : '"images/downarrow2.png" title="'.$adminLanguage->A_FILTER.'"';
                echo 'border="0" />';
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

			if (!$simpleview) {
			    echo '<th nowrap>'.$adminLanguage->A_CMP_CAT_ID.'</th>'._LEND;
            	if ( $type == 'content') {
			?>
				<th><?php echo $adminLanguage->A_NBACTIVE; ?></th>
				<th><?php echo $adminLanguage->A_NBTRASH; ?></th>
			<?php 
			    } else {
			?>
				<th></th>
			<?php 
			    }
			}

			if (!$simpleview) {
			?>
            <th align="center"><?php echo $adminLanguage->A_MENU_LANGUAGES; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectlang')">
            <?php 
            echo '<img src=';
            echo ($formfilters['filter_lang'] != '') ? '"images/downarrow3.png" title="' . $adminLanguage->A_FILTERED . '"' : '"images/downarrow2.png" title="' . $adminLanguage->A_FILTER . '"';
            echo 'border=="0" />';
            ?>
            </a>
            <div id="selectlang" style="display:none; position:absolute; <?php echo (_GEM_RTL) ? 'left:20px;' : 'right:20px;'; ?>" class="filter">
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
			//check for language settings errors (sections/categories lang conflicts)
			$langok = 0;
			if ($row->section_lang != '') {
				if ($row->language != '') {
					$catlangs = explode(',',$row->language);
						for ($t=0; $t < count($catlangs); $t++) {
							if (preg_match('/'.$catlangs[$t].'/i',$row->section_lang)) { $langok = 1; }
						}
				    unset ($catlangs);
				} else { $langok = 1; }
                $seclangs = preg_replace('/\,/',', ',trim($row->section_lang));
			} else { 
            	$langok = 1;
                $seclangs = $adminLanguage->A_ALL;
            }
			if ($langok == 0) { $ff = 'X'; }  else { $ff = $k; }

			$row->sect_link = 'index2.php?option=com_sections&task=editA&hidemainmenu=1&id='. $row->section;
			$link = 'index2.php?option=com_categories&section='.$section.'&task=editA&hidemainmenu=1&id='.$row->id;

			$access = mosCommonHTML::AccessProcessing( $row, $i );
            $accesswin_list = mosAdminMenus::Access($row);
			$checked = mosCommonHTML::CheckedOutProcessing( $row, $i );
			//$published = mosCommonHTML::PublishedProcessing( $row, $i, $adminLanguage->A_PUBLISHED, $adminLanguage->A_UNPUBLISHED );

			$img = $row->published ? 'publish_g.png' : 'publish_x.png';
			$alt = $row->published ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
			?>
			<tr class="row<?php echo $ff; ?>">
				<td>
                <?php echo ($langok == 0) ? mosWarning($adminLanguage->A_LANGCONM1, $adminLanguage->A_LANGCONFL) : $pageNav->rowNumber( $i ); ?>
				</td>
				<td><?php echo $checked; ?></td>
				<td>
				<?php
				if ( $row->checked_out_contact_category && ( $row->checked_out_contact_category != $my->id ) ) {
					echo $row->name .' <span'.$rtl.'>( '. $row->title .' )</span>';
				} else {
					?>
					<a href="<?php echo $link; ?>"><?php echo $row->name .' <span'.$rtl.'>( '. $row->title .' )</span>'; ?></a>
					<?php
				}
				?>
				</td>
				<td align="center" style="text-align:center;">
                    <div id="catstatus<?php echo $i; ?>">
					   <a href="javascript:void(0);" title="<?php echo $alt; ?>" 
                       onclick="changeCategoryState('<?php echo $i; ?>', '<?php echo $row->id; ?>', '<?php echo ($row->published) ? 0 : 1; ?>');">
                       <img src="images/<?php echo $img; ?>" border="0" alt="<?php echo $alt; ?>" /></a>
                    </div>
                </td>
				<?php
				if ( $section != 'content' ) {
					?>
					<td align="<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>"><?php echo $pageNav->orderUpIcon( $i ); ?></td>
					<td align="<?php echo $textdir; ?>"><?php echo $pageNav->orderDownIcon( $i, $n ); ?></td>
					<?php
				}
				?>
				<td align="center" style="text-align:center;" colspan="2">
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="inputbox" style="text-align: center;" />
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
				<?php
				if ( $section == 'content' ) {
					?>
					<td align="<?php echo $textdir; ?>">
                    <?php echo mosToolTip( $seclangs, $adminLanguage->A_SECTLANGES, '', 'language.png' ); ?> 
					<a href="<?php echo $row->sect_link; ?>" title="<?php echo $adminLanguage->A_EDITSECTION; ?>">
					<?php echo $row->section_name; ?>
					</a>
					</td>
					<?php
				}

				if (!$simpleview) {
				    echo '<td align="center" style="text-align:center;">'.$row->id.'</td>'._LEND;
				    if ( $type == 'content') {
					   ?>
					   <td align="center" style="text-align:center;"><?php echo $row->active; ?></td>
					   <td align="center" style="text-align:center;"><?php echo $row->trash; ?></td>
				<?php
				    } else {
				?>
					   <td></td>
				<?php
				    }
                }
				if (!$simpleview) {
				?>
                <td align="<?php echo $textdir; ?>">
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
                <?php } ?>
			</tr>
			<?php
                $k = 1 - $k;            
		}
		?>
		</table>

		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="com_categories" />
		<input type="hidden" name="section" value="<?php echo $section;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="chosen" value="" />
		<input type="hidden" name="act" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="type" value="<?php echo $type; ?>" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="simpleview" value="<?php echo intval($simpleview); ?>" />
		</form>
<?php 
	}


	/**************************/
	/* HTML ADD/EDIT CATEGORY */
	/**************************/
	static public function edit( &$row, &$lists, $redirect, $menus ) {
		global $adminLanguage, $mainframe;

		$rtl = (_GEM_RTL == 1) ? ' dir="rtl"' : '';
		if ($row->image == '') {
			$row->image = 'blank.png';
		}

		if ( $redirect == 'content' ) {
			$component = $adminLanguage->A_MENU_CONTENT;
		} else {
			$component = ucfirst( substr( $redirect, 4 ) );
			if ( $redirect == 'com_contact_details' ) {
				$component = 'Contact';
			}
		}
		mosMakeHtmlSafe( $row, ENT_QUOTES, 'description' );
		mosCommonHTML::loadOverlib();
?>

		<script type="text/javascript">
		function submitbutton(pressbutton, section) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			if ( pressbutton == 'menulink' ) {
				if ( form.menuselect.value == "" ) {
					alert( "<?php echo $adminLanguage->A_SELECTAMENU; ?>" );
					return;
				} else if ( form.link_type.value == "" ) {
					alert( "<?php echo $adminLanguage->A_CMP_SEC_PSMT; ?>" );
					return;
				} else if ( form.link_name.value == "" ) {
					alert( "<?php echo $adminLanguage->A_ALERT_ENTER_NAME_MENUITEM; ?>" );
					return;
				}
			}

			if ( form.name.value == "" ) {
				alert("<?php echo $adminLanguage->A_CMP_CAT_MUSTNAM; ?>");
			} else if (trim(form.seotitle.value) == "") {
                alert( "<?php echo $adminLanguage->A_SEOTEMPTY; ?>" );
			} else {
				<?php getEditorContents( 'editor1', 'description' ); ?>
				submitform(pressbutton);
			}
		}
		</script>
		<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/components/com_categories/categoriesajax.js"></script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="categories">
			<?php echo $adminLanguage->A_CATEGORY; ?>:
			<small><?php echo $row->id ? $adminLanguage->A_EDIT : $adminLanguage->A_NEW; ?></small>
			<span<?php echo $rtl;?>>[ <?php echo $component; ?> ]</span>
			</th>
		</tr>
		</table>
		<table width="100%">
		<tr>
			<td valign="top" width="60%">
				<table class="adminForm">
				<tr>
					<th colspan="3"><?php echo $adminLanguage->A_CMP_CAT_DETAILS; ?></th>
				<tr>
				<tr>
					<td><?php echo $adminLanguage->A_SECTION; ?>:</td>
					<td colspan="2">
                        <?php echo $lists['section']; ?>
					</td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_CAT_TITLE; ?></td>
					<td colspan="2">
                        <input type="text" name="title" class="inputbox" value="<?php echo $row->title; ?>" size="50" maxlength="50" title="<?php echo $adminLanguage->A_CMP_SEC_SRNAME; ?>" />
					</td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_CAT_NAME; ?>:</td>
					<td colspan="2">
                        <input type="text" name="name" class="inputbox" value="<?php echo $row->name; ?>" size="50" maxlength="255" title="<?php echo $adminLanguage->A_CMP_SEC_LNAME; ?>" />
					</td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_SEOTITLE; ?>:</td>
					<td colspan="2">
						<input name="seotitle" id="seotitle" type="text" dir="ltr" class="inputbox" value="<?php echo $row->seotitle; ?>" size="30" maxlength="100" />
						<?php echo mosToolTip($adminLanguage->A_SEOTHELP); ?><br />
                        <a href="javascript:void(0);" onclick="suggestSEO()"><?php echo $adminLanguage->A_SEOTSUG; ?></a> &nbsp; | &nbsp; 
                        <a href="javascript:void(0);" onclick="validateSEO()"><?php echo $adminLanguage->A_SEOTVAL; ?></a><br />
                        <div id="valseo" style="height: 20px;"></div>                              
                    </td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_IMAGE; ?>:</td>
					<td>
                        <?php echo $lists['image']; ?>
					</td>
					<td rowspan="4" valign="top">
					<script type="text/javascript">
					if (document.forms[0].image.options.value!=''){
					  jsimg='../images/stories/' + getSelectedValue( 'adminForm', 'image' );
					} else {
					  jsimg='../images/M_images/blank.png';
					}
					document.write('<img src=' + jsimg + ' name="imagelib" width="80" height="80" border="2" alt="<?php echo $adminLanguage->A_PREVIEW; ?>" />');
					</script>
					</td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_IMAGEPOSITION; ?>:</td>
					<td>
                        <?php echo $lists['image_position']; ?>
					</td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_ORDERING; ?>:</td>
					<td>
					    <?php echo $lists['ordering']; ?>
					</td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_ACCESSLEVEL; ?>:</td>
					<td>
                        <?php echo $lists['access']; ?>
					</td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_PUBLISHED; ?>:</td>
					<td>
                        <?php echo $lists['published']; ?>
					</td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_LANGUAGE; ?>:</td>
					<td>
                        <?php echo $lists['languages']; ?>
					</td>
				</tr>
				<tr>
					<td colspan="3">
					<?php echo $adminLanguage->A_DESCRIPTION; ?>:<br />
					<?php
					//parameters : areaname, content, hidden field, width, height, rows, cols
					editorArea( 'editor1',  $row->description , 'description', '450', '300', '60', '20' );
					?>
					</td>
				</tr>
				</table>
			</td>
			<td valign="top" align="right">
			<div>
			<table cellspacing="0" cellpadding="0" border="0" width="100%" >
				<tr>
					<td width="40%">
			<?php
			if ( $row->id > 0 ) {
    		?>
				<table class="adminForm">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_LINKTOMENU; ?></th>
				<tr>
				<tr>
					<td colspan="2">
                        <?php echo $adminLanguage->A_CREATEMENUIT; ?><br /><br />
					</td>
				<tr>
				<tr>
					<td valign="top" width="100"><?php echo $adminLanguage->A_SELECTAMENU; ?></td>
					<td>
                        <?php echo $lists['menuselect']; ?>
					</td>
				<tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_COMP_MENU_TYPE_SELECT; ?></td>
					<td>
                        <?php echo $lists['link_type']; ?>
					</td>
				<tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_MENUITEMNAME; ?></td>
					<td>
					    <input type="text" name="link_name" class="inputbox" value="" size="25" />
					</td>
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
				<tr>
					<td colspan="2"></td>
				</tr>
				</table>
			<?php
			} else {
			?>
			<table class="adminForm" width="40%">
				<tr><th><?php echo $adminLanguage->A_LINKTOMENU; ?></th></tr>
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
		<input type="hidden" name="option" value="com_categories" />
		<input type="hidden" name="oldtitle" value="<?php echo $row->title ; ?>" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="sectionid" value="<?php echo $row->section; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
<?php 
	}


	/***************************/
	/* HTML MOVE CATEGORY FORM */
	/***************************/ 
	static public function moveCategorySelect( $option, $cid, $SectionList, $items, $sectionOld, $contents, $redirect ) {
        global $adminLanguage;
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="categories"><?php echo $adminLanguage->A_CMP_CAT_MOVE; ?></th>
		</tr>
		</table>

		<table class="adminForm">
		<tr>
			<td width="3%"></td>
			<td align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>" valign="top">
				<strong><?php echo $adminLanguage->A_CMP_CAT_MVTOSECTN; ?>:</strong><br />
				<?php echo $SectionList; ?>
				<br /><br />
			</td>
			<td align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>" valign="top">
			<strong><?php echo $adminLanguage->A_CMP_CAT_BEINGMVD; ?>:</strong>
			<br />
			<?php
			echo '<ol>'._LEND;
			foreach ( $items as $item ) {
				echo '<li>'.$item->name.'</li>'._LEND;
			}
			echo '</ol>'._LEND;
			?>
			</td>
			<td valign="top">
			<strong><?php echo $adminLanguage->A_CMP_CAT_CNTENT; ?>:</strong>
			<br />
			<?php
			echo '<ol>'._LEND;
			foreach ( $contents as $content ) {
				echo '<li>'.$content->title.'</li>'._LEND;
			}
			echo '</ol>'._LEND;
			?>
			</td>
			<td valign="top">
				<?php echo $adminLanguage->A_CMP_CAT_MOVECAT; ?><br />
				<?php echo $adminLanguage->A_CMP_CAT_ALLITEMS; ?><br />
				<?php echo $adminLanguage->A_CMP_CAT_TOSECTN; ?>
			</td>
		</tr>
		</table>
		<br /><br />

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="section" value="<?php echo $sectionOld;?>" />
		<input type="hidden" name="boxchecked" value="1" />
		<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
		<input type="hidden" name="task" value="" />
		<?php
		foreach ( $cid as $id ) {
			echo "\n <input type=\"hidden\" name=\"cid[]\" value=\"$id\" />";
		}
		?>
		</form>
		<?php
	}


	/***************************/
	/* HTML COPY CATEGORY FORM */
	/***************************/
	static public function copyCategorySelect( $option, $cid, $SectionList, $items, $sectionOld, $contents, $redirect ) {
        global $adminLanguage;
?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="categories"><?php echo $adminLanguage->A_CMP_CAT_COPY; ?></th>
		</tr>
		</table>

		<table class="adminForm">
		<tr>
			<td width="3%"></td>
			<td align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>" valign="top">
				<strong><?php echo $adminLanguage->A_CMP_CAT_COPTOSECTN; ?>:</strong><br />
				<?php echo $SectionList; ?>
				<br /><br />
			</td>
			<td align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>" valign="top">
			<strong><?php echo $adminLanguage->A_CMP_CAT_BCOPD; ?>:</strong>
			<br />
			<?php
			echo '<ol>'._LEND;
			foreach ( $items as $item ) {
				echo '<li>'.$item->name.'</li>'._LEND;
			}
			echo '</ol>'._LEND;
			?>
			</td>
			<td valign="top">
			<strong><?php echo $adminLanguage->A_CMP_CAT_ICOPD; ?>:</strong>
			<br />
			<?php
			echo '<ol>'._LEND;
			foreach ( $contents as $content ) {
				echo '<li>'.$content->title.'</li>'._LEND;
				echo '<input type="hidden" name="item[]" value="'.$content->id.'" />'._LEND;
			}
			echo '</ol>'._LEND;
			?>
			</td>
			<td valign="top">
				<?php echo $adminLanguage->A_CMP_CAT_COPYCATS; ?><br />
				<?php echo $adminLanguage->A_CMP_CAT_ALLITEMS; ?><br />
				<?php echo $adminLanguage->A_CMP_CAT_TOSECTN; ?>
			</td>
		</tr>
		</table>
		<br /><br />

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="section" value="<?php echo $sectionOld; ?>" />
		<input type="hidden" name="boxchecked" value="1" />
		<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
		<input type="hidden" name="task" value="" />
		<?php 
		foreach ( $cid as $id ) {
			echo '<input type="hidden" name="cid[]" value="'.$id.'" />'._LEND;
		}
		?>
		</form>
<?php 
	}
}

?>