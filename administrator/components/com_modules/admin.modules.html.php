<?php 
/**
* @version: $Id: admin.modules.html.php 55 2010-06-13 08:57:20Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Modules
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_modules {

	/*********************/
	/* HTML LIST MODULES */
	/*********************/
	static public function showModules( &$rows, $myid, $client, &$pageNav, $option, &$lists, $search, $formfilters=array() ) {
		global $my, $adminLanguage, $mainframe;

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
            window.location = "index2.php?option=com_modules&client=<?php echo $client; ?>&task=setaccess&access="+acc+"&sid="+cid;
		}
		/* ]]> */
		</script>
		<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/components/com_modules/modulesajax.js"></script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="modules">
				<?php echo $adminLanguage->A_CMP_MDL_MANAG; ?> 
				<span class="small">[ <?php echo $client == 'admin' ? $adminLanguage->A_ADMINISTRATOR : $adminLanguage->A_SITE; ?> ]</span>
			</th>
			<td align="<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>" nowrap="nowrap"><?php echo $adminLanguage->A_FILTER; ?>:</td>
			<td>
				<input type="text" name="search" value="<?php echo $search; ?>" class="inputbox" onchange="document.adminForm.submit();" />
			</td>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows );?>);" />
			</th>
			<th class="title">
			<?php echo $adminLanguage->A_CMP_MDL_NAME; ?>
			</th>
			<th nowrap="nowrap">
			<?php echo $adminLanguage->A_PUBLISHED; ?>
			<a href="javascript:void(0);" onclick="javascript:showLayer('selectpublished')">
            <?php 
            echo '<img src=';
            echo (intval($formfilters['filter_published']) > 0 ) ? '"images/downarrow3.png" title="' . $adminLanguage->A_FILTERED . '"' : '"images/downarrow2.png" title="' . $adminLanguage->A_FILTER . '"';
            echo 'border="0" />';
            ?>
            </a>
            <div id="selectpublished" style="display:none; position:absolute;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_FILTER; ?></div>
                <?php echo $lists['published'];?>
                <div class="filterbottom">
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selectpublished');" style="color: #888888;"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			</div>
			</th>
			<th colspan="2" align="center" style="text-align:center;"><?php echo $adminLanguage->A_REORDER; ?></th>
			<th style="text-align:<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>;"><?php echo $adminLanguage->A_ORDER; ?></th>
			<th style="text-align:<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>;">
				<a href="javascript: saveorder( <?php echo count( $rows )-1; ?> )">
					<img src="images/filesave.png" border="0" width="16" height="16" alt="<?php echo $adminLanguage->A_SAVEORDER; ?>" />
				</a>
			</th>
			<?php
			if ( !$client ) {
				?>
				<th><?php echo $adminLanguage->A_ACCESS; ?></th>
				<?php
			}
			?>
			<th nowrap="nowrap">
			<?php echo $adminLanguage->A_POSITION; ?>
			<a href="javascript:void(0);" onclick="javascript:showLayer('selectposition')">
            <?php 
            echo '<img src=';
            echo (( $formfilters['filter_position'] != '' ) && ( $formfilters['filter_position'] != '0' )) ? '"images/downarrow3.png" title="' . $adminLanguage->A_FILTERED . '"' : '"images/downarrow2.png" title="' . $adminLanguage->A_FILTER . '"';
            echo 'border="0" />';
            ?>
            </a>
            <div id="selectposition" style="display:none; position:absolute;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_CMP_MDL_FPOS; ?></div>
                <?php echo $lists['position'];?>
                <div class="filterbottom">
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selectposition');" style="color: #888888"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			</div>
			</th>
			<th><?php echo $adminLanguage->A_CMP_MDL_PAGES; ?></th>
			<th><?php echo $adminLanguage->A_ID; ?></th>
			<th nowrap="nowrap" class="title">
			<?php echo $adminLanguage->A_TYPE; ?>
			<a href="javascript:void(0);" onclick="javascript:showLayer('selecttype')">
            <?php 
            echo '<img src=';
            echo (( $formfilters['filter_type'] != '' ) && ( $formfilters['filter_type'] != '0' )) ? '"images/downarrow3.png" title="' . $adminLanguage->A_FILTERED . '"' : '"images/downarrow2.png" title="' . $adminLanguage->A_FILTER . '"';
            echo 'border="0" />';
            ?>
            </a>
            <div id="selecttype" style="display:none; position:absolute;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_FILTERTYPE; ?></div>
                <?php echo $lists['type'];?>
                <div class="filterbottom">
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selecttype');" style="color: #888888"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			</div>
			</th>
			<?php 
			if ( !$client ) {
			?>
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
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selectlang');" style="color: #888888;"><?php echo $adminLanguage->A_CLOSE; ?></a>
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

			$link = 'index2.php?option=com_modules&client='. $client .'&task=editA&hidemainmenu=1&id='. $row->id;

			$access = mosCommonHTML::AccessProcessing( $row, $i );
            $accesswin_list = mosAdminMenus::Access($row);
			$checked = mosCommonHTML::CheckedOutProcessing( $row, $i );
			$img = ($row->published) ? 'publish_g.png' : 'publish_x.png';
			$alt = ($row->published) ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
			?>
			<tr class="row<?php echo $k; ?>">
				<td><?php echo $pageNav->rowNumber( $i ); ?></td>
				<td><?php echo $checked; ?></td>
				<td>
				<?php
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					echo $row->title;
				} else {
					?>
					<a href="<?php echo $link; ?>" title="<?php echo $adminLanguage->A_EDIT; ?>"><?php echo $row->title; ?></a>
					<?php
				}
				?>
				</td>
				<td align="center" style="text-align:center;">
					<div id="constatus<?php echo $i; ?>">
					<a href="javascript:void(0);" onclick="changeModuleState('<?php echo $i; ?>', '<?php echo $row->id; ?>', '<?php echo ($row->published) ? 0 : 1; ?>');" title="<?php echo $alt; ?>">
					<img src="images/<?php echo $img; ?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" /></a>
                    </div>
				</td>
				<td  style="text-align:<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>;">
					<?php echo $pageNav->orderUpIcon( $i, ($row->position == @$rows[$i-1]->position) ); ?>
				</td>
				<td  style="text-align:<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>;">
					<?php echo $pageNav->orderDownIcon( $i, $n, ($row->position == @$rows[$i+1]->position) ); ?>
				</td>
				<td align="center" colspan="2" style="text-align:center;">
					<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="inputbox" style="text-align: center;" />
				</td>
				<?php
				if ( !$client ) {
					?>
					<td align="center" style="text-align:center;">
					<?php echo $access; ?>
					<div id="accesswin<?php echo $i; ?>" style="display:none; position:absolute;" class="filter">
                        <div class="filtertop"><b><?php echo $adminLanguage->A_ACCESS; ?></b></div>
                        <?php echo $accesswin_list; ?>
                        <div class="filterbottom">
                            <input type="button" class="button" onclick="javascript:eAccess('<?php echo $row->id; ?>', 'access<?php echo $row->id; ?>');" name="submit<?php echo $i; ?>" value="<?php echo $adminLanguage->A_SAVE; ?>" /> &nbsp; 
                            <input type="button" class="button" onclick="javascript:hideLayer('accesswin<?php echo $i; ?>');" name="close<?php echo $i; ?>" value="<?php echo $adminLanguage->A_CLOSE; ?>" />
                        </div>
                    </div>
					</td>
					<?php
				}
				?>
				<td align="center" style="text-align:center;"><?php echo $row->position; ?></td>
				<td align="center" style="text-align:center;">
				<?php
				if (is_null( $row->pages )) {
					echo $adminLanguage->A_NONE;
				} else if ($row->pages > 0) {
					echo $adminLanguage->A_CMP_MDL_VARIES;
				} else {
					echo $adminLanguage->A_CMP_MDL_ALL;
				}
				?>
				</td>
				<td align="center" style="text-align:center;"><?php echo $row->id; ?></td>
				<td align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>">
					<?php echo $row->module ? $row->module : $adminLanguage->A_USER; ?>
				</td>
				<?php 
				if ( !$client ) {
				?>
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
    			<?php } ?>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>

		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="client" value="<?php echo $client; ?>" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
<?php 
	}


	/************************/
	/* HTML ADD/EDIT MODULE */
	/************************/
	static public function editModule( $row, $orders2, $lists, $params, $option ) {
		global $mainframe, $adminLanguage;

		$row->titleA = '';
		if ( $row->id ) {
			$row->titleA = '[ '.$row->title.' ]';
		}

		mosCommonHTML::loadOverlib();
		$tabs = new mosTabs(0);
?>
		<script type="text/javascript">
		/* <![CDATA[ */
		function submitbutton(pressbutton) {
			if ( ( pressbutton == 'save' ) && ( document.adminForm.title.value == "" ) ) {
				alert("<?php echo $adminLanguage->A_CMP_MDL_MUST_TITLE; ?>");
			} else {
				<?php if ($row->module == "") {
					getEditorContents( 'editor1', 'content' );
				}?>
				submitform(pressbutton);
			}
			submitform(pressbutton);
		}
		var originalOrder = '<?php echo $row->ordering; ?>';
		var originalPos = '<?php echo $row->position; ?>';
		var orders = new Array(); // array in the format [key,value,text]
		<?php	$i = 0;
		foreach ($orders2 as $k=>$items) {
			foreach ($items as $v) {
				echo "\n	orders[".$i++."] = new Array( \"$k\",\"$v->value\",\"$v->text\" );";
			}
		}
		?>
		/* ]]> */
		</script>

		<table class="adminheading">
		<tr>
			<th class="modules">
            <?php echo $lists['client_id'] ? $adminLanguage->A_ADMINISTRATOR : $adminLanguage->A_SITE; ?>
			<?php echo $adminLanguage->A_MODULE; ?>: 
			<?php echo $row->id ? $adminLanguage->A_EDIT : $adminLanguage->A_NEW; ?> <?php echo $row->titleA; ?>
			</th>
		</tr>
		</table>

		<form action="index2.php" method="post" name="adminForm">
<?php 
		$tabs->startPane('modPane');
		$tabs->startTab($adminLanguage->A_CMP_MDL_DETAILS,'moddetailspg');
?>
		<table class="adminform">
		<tr>
			<th colspan="2"><?php echo $adminLanguage->A_CMP_MDL_DETAILS; ?></th>
		</tr>
		<tr>
			<td width="200"><?php echo $adminLanguage->A_TITLE; ?>:</td>
			<td>
				<input class="inputbox" type="text" name="title" size="35" value="<?php echo $row->title; ?>" />
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_CMP_MDL_SHOWTITLE; ?>:</td>
			<td>
				<?php echo $lists['showtitle']; ?>
			</td>
		</tr>
		<tr>
			<td valign="top"><?php echo $adminLanguage->A_POSITION; ?>:</td>
			<td>
				<?php echo $lists['position']; ?>
			</td>
		</tr>
		<tr>
			<td valign="top" nowrap="nowrap"><?php echo $adminLanguage->A_CMP_MDL_ORDER; ?>:</td>
			<td>
				<script type="text/javascript">
				/* <![CDATA[ */
				writeDynaList( 'class="selectbox" name="ordering" size="1"', orders, originalPos, originalPos, originalOrder );
				/* ]]> */
				</script>
			</td>
		</tr>
<?php if ($lists['client_id'] != 1) { ?>
		<tr>
			<td><?php echo $adminLanguage->A_LANGUAGE; ?>:</td>
			<td>
				<?php echo $lists['languages']; ?>
			</td>
		</tr>
<?php } ?>
		<tr>
			<td valign="top"><?php echo $adminLanguage->A_ACCESSLEVEL; ?>:</td>
			<td>
				<?php echo $lists['access']; ?>
			</td>
		</tr>
		<tr>
			<td valign="top"><?php echo $adminLanguage->A_PUBLISHED; ?>:</td>
			<td>
				<?php echo $lists['published']; ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_ID; ?>:</td>
			<td><?php echo $row->id; ?></td>
		</tr>
		<tr>
			<td valign="top"><?php echo $adminLanguage->A_DESCRIPTION; ?>:</td>
			<td>
				<?php echo $row->description; ?>
			</td>
		</tr>
		</table>
<?php 

		if ($row->module == '') {
			$tabs->endTab();
			$tabs->startTab($adminLanguage->A_CMP_MDL_CUST_OUT,'modeditorpg');
?>
			<table width="100%" class="adminform">
			<tr>
				<th colspan="2">
					<?php echo $adminLanguage->A_CMP_MDL_CUST_OUT; ?>
				</th>
			</tr>
			<tr>
				<td width="200" valign="top">
					<?php echo $adminLanguage->A_MENU_CONTENT; ?>
				</td>
				<td>
<?php
				//parameters : areaname, content, hidden field, width, height, rows, cols
				editorArea('editor1',  $row->content , 'content', '600', '350', '95', '30');
?>
				</td>
			</tr>
			</table>
<?php 
		}

		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_PARAMETERS,'modparamspg');
?>
		<table class="adminform">
		<tr>
			<th><?php echo $adminLanguage->A_PARAMETERS; ?></th>
		</tr>
		<tr>
			<td>
				<?php 
				$style = array('width' => 200);
				echo $params->render('params', $style);
				?>
			</td>
		</tr>
		</table>
<?php 
		$tabs->endTab();
		$tabs->startTab($adminLanguage->A_CMP_MDL_PAGITMS,'modmenupg');
?>
		<table class="adminform">
		<tr>
			<th colspan="2"><?php echo $adminLanguage->A_CMP_MDL_PAGITMS; ?></th>
		<tr>
		<tr>
			<td width="200" valign="top"><?php echo $adminLanguage->A_CMP_MDL_ITEMLINK; ?></td>
			<td>
				<?php echo $lists['selections']; ?>
			</td>
		</tr>
		</table>
<?php 
		$tabs->endTab();
		$tabs->endPane();
?>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
		<input type="hidden" name="original" value="<?php echo $row->ordering; ?>" />
		<input type="hidden" name="module" value="<?php echo $row->module; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="client_id" value="<?php echo $lists['client_id']; ?>" />
<?php
		if ($row->client_id || $lists['client_id']) {
			echo '<input type="hidden" name="client" value="admin" />';
		}
?>
		</form>
		<div style="clear: both;"></div>
		<br /><br /><br />

<?php 
	}
}
?>