<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Types Content
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_typedcontent {


	/*********************************/
	/* HTML LIST OF AUTONOMOUS PAGES */
	/*********************************/
	static public function showContent( &$rows, &$pageNav, $option, $search, &$lists, $formfilters=array(), $simpleview=0 ) {
		global $my, $acl, $adminLanguage, $mainframe;

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
            window.location = "index2.php?option=com_typedcontent&task=setaccess&access="+acc+"&sid="+cid;
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
        <script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/components/com_typedcontent/typedajax.js"></script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="static"><?php echo $adminLanguage->A_STATICONTMANAGER; ?></th>
			<td nowrap="nowrap"><?php echo $adminLanguage->A_FILTER; ?>: 
				<input type="text" name="search" value="<?php echo $search; ?>" class="inputbox" onchange="document.adminForm.submit();" /> 
				<?php echo $adminLanguage->A_ORDER; ?>: <?php echo $lists['order']; ?><br />
				 &raquo; 
				<?php 
				if ($simpleview) {
                	echo '<a href="javascript:void(null);" onclick="switchview(\'0\');">'.$adminLanguage->A_CMP_TDC_EXTVIEW.'</a>';
            	} else {
                	echo '<a href="javascript:void(null);" onclick="switchview(\'1\');">'.$adminLanguage->A_CMP_TDC_SIMVIEW.'</a>';
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
			<?php if (!$simpleview) { ?>
			<th class="title"><?php echo $adminLanguage->A_SEOTITLE; ?></th>
			<?php } ?>
			<th><?php echo $adminLanguage->A_PUBLISHED; ?></th>
			<th align="<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>"><?php echo $adminLanguage->A_ORDER; ?></th>
			<th align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>">
			<a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" title="<?php echo $adminLanguage->A_SAVEORDER; ?>" /></a>
			</th>
			<th><?php echo $adminLanguage->A_ACCESS; ?></th>
			<?php if (!$simpleview) { ?>
			<th><?php echo $adminLanguage->A_ID; ?></th>
			<th><?php echo $adminLanguage->A_LINKS; ?></th>
			<?php } ?>
			<th align="center" style="text-align:center;">
            <?php echo $adminLanguage->A_AUTHOR; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectauthor')">
            <?php 
            echo '<img src=';
            echo ($formfilters['filter_authorid'] > 0) ? '"images/downarrow3.png" title="' . $adminLanguage->A_FILTERED .'"' : '"images/downarrow2.png" title="' . $adminLanguage->A_FILTER . '"';
            echo 'alt="arrow" border="0" />';
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
			<?php if (!$simpleview) { ?>
			<th align="center" style="text-align:center;"><?php echo $adminLanguage->A_DATE; ?></th>
			<?php } ?>
			<th class="title"><?php echo $adminLanguage->A_LANGUAGE; ?>
            <a href="javascript:void(0);" onclick="javascript:showLayer('selectlang')">
            <?php 
            echo '<img src=';
            echo ($formfilters['filter_lang'] != '') ? '"images/downarrow3.png\" title="' . $adminLanguage->A_FILTERED . '"' : '"images/downarrow2.png" title="' . $adminLanguage->A_FILTER . '"';
            echo 'alt="arrow" border="0" />';
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

			$now = date( "Y-m-d H:i:s" );
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
				if (isset($row->publish_up)) {
					if ($row->publish_up == '1979-12-19 00:00:00') {
						$times .= "<tr><td>". $adminLanguage->A_CMP_TDC_STARTALW ."</td></tr>";
					} else {
						$times .= "<tr><td>". $adminLanguage->A_START .": ". $row->publish_up ."</td></tr>";
					}
				}
				if (isset($row->publish_down)) {
					if ($row->publish_down == '2060-01-01 00:00:00') {
						$times .= "<tr><td>". $adminLanguage->A_CMP_TDC_FINNOEXP ."</td></tr>";
					} else {
						$times .= "<tr><td>". $adminLanguage->A_CMP_TDC_FINISH .": ". $row->publish_down ."</td></tr>";
					}
				}

			$link = 'index2.php?option=com_typedcontent&task=edit&hidemainmenu=1&id='. $row->id;

			$access = mosCommonHTML::AccessProcessing( $row, $i );
            $accesswin_list = mosAdminMenus::Access($row);

			if ( $row->checked_out ) {
				$checked = mosCommonHTML::checkedOut( $row );
			} else {
				$checked = mosHTML::idBox( $i, $row->id, ($row->checked_out && $row->checked_out != $my->id ) );
			}

			if ( $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_users' ) ) {
				if ( $row->created_by_alias ) {
					$author = $row->created_by_alias;
				} else {
					$linkA 	= 'index2.php?option=com_users&task=editA&hidemainmenu=1&id='. $row->created_by;
					$author = '<a href="'. $linkA .'" title="'. $adminLanguage->A_EDITUSER . '">'. $row->creator .'</a>';
				}
			} else {
				if ( $row->created_by_alias ) {
					$author = $row->created_by_alias;
				} else {
					$author = $row->creator;
				}
			}

			$date = mosFormatDate( $row->created, "%d %B %Y" );
			?>
			<tr class="row<?php echo $k; ?>">
				<td><?php echo $pageNav->rowNumber( $i ); ?></td>
				<td><?php echo $checked; ?></td>
				<td><?php 
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					echo $row->title;
				} else {
				?>
					<a href="<?php echo $link; ?>" title="<?php echo $adminLanguage->A_CMP_TDC_EDSTCNI; ?>">
					<?php echo $row->title; ?></a>
				<?php 
				}
				?></td>
				<?php if (!$simpleview) { ?>
				<td><?php echo $row->seotitle; ?></td>
				<?php } ?>
				<?php
				if ( $times ) {
					?>
					<td align="center" style="text-align:center;"><div id="typstatus<?php echo $i; ?>">
					<a href="javascript: void(0);" onmouseover="return overlib('<table><?php echo $times; ?></table>', CAPTION, '<?php echo $adminLanguage->A_CPUBLISHINFO; ?>', BELOW, <?php echo (_GEM_RTL) ? 'LEFT' : 'RIGHT'; ?>);" onmouseout="return nd();" 
                    onclick="changeTypedState('<?php echo $i; ?>', '<?php echo $row->id; ?>', '<?php echo ($row->state) ? 0 : 1; ?>'); return nd();">
					<img src="images/<?php echo $img; ?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" /></a>
                    </div></td>
					<?php
				}
				?>
				<td align="center" style="text-align:center;" colspan="2">
				<input type="text" name="order[]" size="5" dir="ltr" value="<?php echo $row->ordering; ?>" class="inputbox" style="text-align: center" />
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
				<?php if (!$simpleview) { ?>
				<td align="center" style="text-align:center;"><?php echo $row->id; ?></td>
				<td align="center" style="text-align:center;"><?php echo $row->links; ?></td>
				<?php } ?>
				<td align="center" style="text-align:center;"><?php echo $author; ?></td>
				<?php if (!$simpleview) { ?>
				<td align="center" style="text-align:center;"><?php echo $date; ?></td>
				<?php } ?>
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
		<?php mosCommonHTML::ContentLegend(); ?>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="simpleview" value="<?php echo intval($simpleview); ?>" />
		</form>
		<?php
	}


    /*****************************/
    /* HTML EDIT AUTONOMOUS PAGE */
    /*****************************/
	static public function edit( &$row, &$images, &$lists, &$params, $option, &$menus ) {
		global $mainframe, $adminLanguage;

		//mosMakeHtmlSafe( $row );
		$tabs = new mosTabs( 0 );
		// used to hide "Reset Hits" when hits = 0
		if ( !$row->hits ) {
			$visibility = "style='display: none; visbility: hidden;'";
		} else {
			$visibility = "";
		}

		mosCommonHTML::loadOverlib();
		mosCommonHTML::loadCalendar();
?>

		<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/includes/js/ajax_new.js"></script>
        <script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/components/com_typedcontent/typedajax.js"></script>
		<script type="text/javascript">
		<!--
		var folderimages = new Array;
		<?php
		$i = 0;
		foreach ($images as $k=>$items) {
			foreach ($items as $v) {
				echo "\n folderimages[".$i++."] = new Array( '$k','".addslashes( $v->value )."','".addslashes( $v->text )."' );";
			}
		}
		?>
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			if ( pressbutton == 'resethits' ) {
				if (confirm('<?php echo $adminLanguage->A_CMP_TDC_RSZERO; ?>')){
					submitform( pressbutton );
					return;
				} else {
					return;
				}
			}

			if ( pressbutton == 'menulink' ) {
				if ( form.menuselect.value == "" ) {
					alert( "<?php echo $adminLanguage->A_ALERT_SELECT_MENU; ?>" );
					return;
				} else if ( form.link_name.value == "" ) {
					alert( "<?php echo $adminLanguage->A_ALERT_ENTER_NAME_MENUITEM; ?>" );
					return;
				}
			}

			var temp = new Array;
			for (var i=0, n=form.imagelist.options.length; i < n; i++) {
				temp[i] = form.imagelist.options[i].value;
			}
			form.images.value = temp.join( '\n' );

			try {
				document.adminForm.onsubmit();
			}
			catch(e){}
			if (trim(form.title.value) == ""){
				alert( "<?php echo $adminLanguage->A_CMP_TDC_MUSTTITLE; ?>" );
			} else if (trim(form.seotitle.value) == ""){
				alert( "<?php echo $adminLanguage->A_SEOTEMPTY; ?>" );
			} else if (trim(form.name.value) == ""){
				alert( "<?php echo $adminLanguage->A_CMP_TDC_MUST_CIMNA; ?>" );
			} else {
				if ( form.reset_hits.checked ) {
					form.hits.value = 0;
				} else {
				}
				<?php getEditorContents( 'editor1', 'introtext' ) ; ?>
				submitform( pressbutton );
			}
		}
		//-->
		</script>
		<table class="adminheading">
		<tr>
			<th class="static"><?php echo $adminLanguage->A_CMP_TYPED_CONTENT; ?>: 
			<span style="font-size: small;"><?php echo $row->id ? $adminLanguage->A_EDIT : $adminLanguage->A_NEW; ?></span></th>
		</tr>
		</table>
		<form action="index2.php" method="post" name="adminForm">

		<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td valign="top">
				<table class="adminform" width="500">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_CMP_TDC_ITEMDETLS; ?></th>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_TITLE; ?>:</td>
					<td>
						<input class="inputbox" type="text" name="title" size="30" maxlength="100" value="<?php echo $row->title; ?>" />
					</td>
				</tr>
				<tr>
					<td align="left" valign="top"><?php echo $adminLanguage->A_SEOTITLE; ?>:</td>
					<td>
					<input class="inputbox" type="text" id="seotitle" name="seotitle" dir="ltr" size="30" maxlength="100" value="<?php echo $row->seotitle; ?>" />
					<?php echo mosToolTip($adminLanguage->A_SEOTHELP); ?><br />
                    <a href="javascript:void(0);" onclick="suggestSEO()"><?php echo $adminLanguage->A_SEOTSUG; ?></a> &nbsp; | &nbsp; 
                    <a href="javascript:void(0);" onclick="validateSEO()"><?php echo $adminLanguage->A_SEOTVAL; ?></a><br />
                    <div id="valseo" style="height: 20px;"></div>
					</td>
				</tr>
				<tr>
					<td valign="top" colspan="2">
					<?php echo $adminLanguage->A_CMP_TDC_TEXT; ?><br /><?php
					// parameters : areaname, content, hidden field, width, height, rows, cols
					editorArea( 'editor1',  $row->introtext, 'introtext', '100%', '400', '65', '50' );
					?></td>
				</tr>
				</table>
			</td>
			<td valign="top" align="<?php echo (_GEM_RTL) ? 'left': 'right'; ?>">
			<div>
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
				<tr>
					<td>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td>
				<?php
				$tabs->startPane("content-pane");
				$tabs->startTab($adminLanguage->A_PUBLISHING, "publish-page" );
				?>
				<table class="adminform">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_PUBLISHINGINFO; ?></th>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_STATE; ?>:</td>
					<td>
					<?php echo ($row->state > 0) ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_CMP_TDC_DRFTUNPUB; ?>
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
					<td valign="top"><?php echo $adminLanguage->A_CMP_TDC_AUTHOR; ?>:</td>
					<td>
					<input type="text" name="created_by_alias" size="30" maxlength="100" value="<?php echo $row->created_by_alias; ?>" class="inputbox" />
					</td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_TDC_CREATOR; ?>:</td>
					<td><?php echo $lists['created_by']; ?></td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_TDC_OVERRIDE; ?></td>
					<td>
					<input type="text" name="created" id="created" dir="ltr" class="inputbox" size="25" maxlength="19" value="<?php echo $row->created; ?>" />
					<input name="reset" type="reset" class="button" onclick="return showCalendar('created', 'y-mm-dd');" value="...">
					</td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_TDC_STRTPUB; ?>:</td>
					<td>
					<input type="text" name="publish_up" id="publish_up" dir="ltr" class="inputbox" size="25" maxlength="19" value="<?php echo $row->publish_up; ?>" />
					<input type="reset" class="button" value="..." onclick="return showCalendar('publish_up', 'y-mm-dd');">
					</td>
				</tr>
				<tr>
					<td><?php echo $adminLanguage->A_CMP_TDC_FNSHPUB; ?>:</td>
					<td>
					<input type="text" name="publish_down" id="publish_down" dir="ltr" class="inputbox" size="25" maxlength="19" value="<?php echo $row->publish_down; ?>" />
					<input type="reset" class="button" value="..." onclick="return showCalendar('publish_down', 'y-mm-dd');" />
					</td>
				</tr>
				</table>
				<br />
				<table class="adminlist">
				<?php
				if ( $row->id ) {
					?>
					<tr class="row0">
						<td>
							<strong><?php echo $adminLanguage->A_MENU_CONTENT.' '.$adminLanguage->A_ID; ?>:</strong>
						</td>
						<td><?php echo $row->id; ?></td>
					</tr>
					<?php
				}
				?>
				<tr class="row1">
					<td><strong><?php echo $adminLanguage->A_STATE; ?></strong></td>
					<td>
					<?php echo ($row->state > 0) ? $adminLanguage->A_PUBLISHED : ($row->state < 0 ? $adminLanguage->A_ARCHIVED : $adminLanguage->A_CMP_TDC_DRFTUNPUB );?>
					</td>
				</tr>
				<tr class="row0">
					<td><strong><?php echo $adminLanguage->A_HITS; ?></strong></td>
					<td><?php echo $row->hits;?>
					<div <?php echo $visibility; ?>>
					<input name="reset_hits" type="button" class="button" value="<?php echo $adminLanguage->A_CMP_TDC_RESETHIT; ?>" onclick="submitbutton('resethits');" />
					</div></td>
				</tr>
				<tr class="row1">
					<td><strong><?php echo $adminLanguage->A_VERSION; ?></strong></td>
					<td><?php echo $row->version; ?></td>
				</tr>
				<tr class="row0">
					<td><strong><?php echo $adminLanguage->A_CREATED; ?></strong></td>
					<td>
					<?php echo $row->created ? $row->created .'</td></tr><tr class="row0"><td><strong>'.$adminLanguage->A_CMP_TDC_BY.'</strong></td><td>'.$row->creator : $adminLanguage->A_CMP_TDC_NEWDOC; ?>
					</td>
				</tr>
				<tr class="row1">
					<td><strong><?php echo $adminLanguage->A_CMP_TDC_LASTMOD; ?></strong></td>
					<td>
					<?php echo $row->modified ? $row->modified .'</td></tr><tr class="row1"><td><b>'. $adminLanguage->A_CMP_TDC_BY ."</b></td><td>". $row->modifier : $adminLanguage->A_CMP_TDC_NOTMOD; ?>
					</td>
				</tr>
				<tr class="row0">
					<td><strong><?php echo $adminLanguage->A_CMP_TDC_EXPIRES; ?></strong></td>
					<td><?php echo $row->publish_down; ?></td>
				</tr>
				</table>
				<?php
				$tabs->endTab();
				$tabs->startTab($adminLanguage->A_IMAGES, "images-page" );
				?>
				<table class="adminform">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_MOSIMAGE; ?></th>
				</tr>
				<tr>
					<td colspan="2">
                        <?php echo $adminLanguage->A_SUBFOLDER; ?>: <?php echo $lists['folders'];?>
					</td>
				</tr>
				<tr>
					<td>
                        <?php echo $adminLanguage->A_GALLERY; ?><br />
                        <?php echo $lists['imagefiles'];?><br />
					    <input class="button" type="button" value="<?php echo $adminLanguage->A_ADD; ?>" onclick="addSelectedToList('adminForm','imagefiles','imagelist')" />
					</td>
					<td valign="top">
					    <img name="view_imagefiles" src="../images/M_images/blank.png" width="100" />
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_CONTENTIMAGES; ?>:<br />
					<?php echo $lists['imagelist'];?><br />
					<input class="button" type="button" value="<?php echo $adminLanguage->A_UP; ?>" onclick="moveInList('adminForm','imagelist',adminForm.imagelist.selectedIndex,-1)" />
					<input class="button" type="button" value="<?php echo $adminLanguage->A_DOWN; ?>" onclick="moveInList('adminForm','imagelist',adminForm.imagelist.selectedIndex,+1)" />
					<input class="button" type="button" value="<?php echo $adminLanguage->A_REMOVE; ?>" onclick="delSelectedFromList('adminForm','imagelist')" />
					</td>
					<td valign="top">
					<img name="view_imagelist" src="../images/M_images/blank.png" width="100" />
					</td>
				</tr>
				<tr>
					<td colspan="2">
					<?php echo $adminLanguage->A_EDITIMAGE; ?>:
						<table>
						<tr>
							<td><?php echo $adminLanguage->A_SOURCE; ?></td>
							<td><input type="text" name= "_source" dir="ltr" value="" /></td>
						</tr>
						<tr>
							<td><?php echo $adminLanguage->A_ALIGN; ?></td>
							<td><?php echo $lists['_align']; ?></td>
						</tr>
						<tr>
							<td><?php echo $adminLanguage->A_ALTTEXT; ?></td>
							<td><input type="text" name="_alt" value="" /></td>
						</tr>
						<tr>
							<td><?php echo $adminLanguage->A_IMAGEBORDER; ?></td>
							<td><input type="text" name="_border" dir="ltr" value="" size="3" maxlength="1" /></td>
						</tr>
						<tr>
							<td><?php echo $adminLanguage->A_IMAGECAPTION; ?>:</td>
							<td>
							<input class="inputbox" type="text" name="_caption" value="" size="30" />
							</td>
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
							<td>
								<input class="inputbox" type="text" name="_width" dir="ltr" value="" size="5" maxlength="5" />
							</td>
						</tr>
						<tr>
							<td colspan="2">
							<input type="button" class="button" value="<?php echo $adminLanguage->A_APPLY; ?>" onclick="applyImageProps()" />
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
				</tr>
				<tr>
					<td>
						<?php echo $params->render(); ?>
					</td>
				</tr>
				</table>
				<?php
				$tabs->endTab();
				$tabs->startTab($adminLanguage->A_METAINFO, "meta-page" );
				?>
				<table class="adminform">
				<tr>
					<th colspan="2"><?php echo $adminLanguage->A_METADATA; ?></th>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_DESCRIPTION; ?>:<br />
					<textarea class="text_area" cols="40" rows="5" name="metadesc" style="width: 300px;"><?php echo eUTF::utf8_str_replace('&', '&amp;', $row->metadesc); ?></textarea>
					</td>
				</tr>
				<tr>
					<td>
					<?php echo $adminLanguage->A_KEYWORDS; ?>:<br />
					<textarea class="text_area" cols="40" rows="5" name="metakey" style="width: 300px;"><?php echo eUTF::utf8_str_replace('&', '&amp;', $row->metakey); ?></textarea>
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
					<td colspan="2">
					<?php echo $adminLanguage->A_CMP_TDC_WILL; ?><br /><br />
					</td>
				</tr>
				<tr>
					<td valign="top" nowrap="nowrap"><?php echo $adminLanguage->A_SELECTAMENU; ?></td>
					<td><?php echo $lists['menuselect']; ?></td>
				</tr>
				<tr>
					<td valign="top"><?php echo $adminLanguage->A_MENUITEMNAME; ?></td>
					<td>
						<input type="text" name="link_name" class="inputbox" value="" size="30" />
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="button" name="menu_link" class="button" value="<?php echo $adminLanguage->A_LINKTOMENU; ?>" onclick="submitbutton('menulink');" />
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
		<input type="hidden" name="images" value="" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="hits" value="<?php echo $row->hits; ?>" />
		<input type="hidden" name="task" value="" />
		</form>
		<?php
	}


	/****************************/
	/* HTML PREPARE TRANSLATION */
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
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="edit"><?php echo $adminLanguage->A_TRANSLATE; ?></th>
		</tr>
		</table>

		<table class="adminform">
		<tr>
            <th width="40%"><?php echo $adminLanguage->A_CMP_TDC_TRSOUDEST; ?></th>
            <th><?php echo $adminLanguage->A_CMP_TDC_TRITEMS; ?></th>
        </tr>
        <tr>
			<td valign="top">
<?php 
			echo $adminLanguage->A_CMP_TDC_FROM." \n";
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

		<?php echo $adminLanguage->A_CMP_TDC_TRNOTE; ?>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
		</form>
<?php 
	}
}

?>