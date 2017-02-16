<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Newsfeeds
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_newsfeeds {

    /***********************/
    /* HTML SHOW NEWSFEEDS */
    /***********************/
	static public function showNewsFeeds( &$rows, &$lists, $pageNav, $option, $formfilters=array() ) {
		global $my, $adminLanguage, $mosConfig_live_site;

		mosCommonHTML::loadOverlib();
?>
        <script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_newsfeeds/newsfeedsajax.js"></script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="syndicate"><?php echo $adminLanguage->A_CMP_NFE_MANAGE; ?></th>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20">
                <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
            </th>
			<th class="title"><?php echo $adminLanguage->A_CMP_NFE_NEWS; ?></th>
			<th><?php echo $adminLanguage->A_PUBLISHED; ?></th>
			<th colspan="2"><?php echo $adminLanguage->A_REORDER; ?></th>
			<th class="title">
            <?php echo $adminLanguage->A_CATEGORY; ?>
            <a href="javascript:;" onclick="javascript:showLayer('selectsection')">
            <?php 
            echo '<img src=';
            echo ($formfilters['catid'] > 0) ? '"images/downarrow3.png" title="' . $adminLanguage->A_FILTERED . '"' : '"images/downarrow2.png" title="' . $adminLanguage->A_FILTER . '"';
            echo 'border="0" />';
            ?>
            </a>
            <div id="selectsection" style="display:none; position:absolute;" class="filter">
                <div class="filtertop"><?php echo $adminLanguage->A_FILTERCATEGORY; ?></div>
                <?php echo $lists['category']; ?>
                <div class="filterbottom">
                    <a href="javascript:void(0);" onclick="javascript:hideLayer('selectsection');" style="color: #888888;"><?php echo $adminLanguage->A_CLOSE; ?></a>
                </div>
			</div>
			</th>
			<th><?php echo $adminLanguage->A_CMP_NFE_ARTICS; ?></th>
			<th nowrap="nowrap"><?php echo $adminLanguage->A_CMP_NFE_CACHE; ?></th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];

			$link = 'index2.php?option=com_newsfeeds&task=editA&hidemainmenu=1&id='.$row->id;
			$img = $row->published ? 'tick.png' : 'publish_x.png';
			$task = $row->published ? 'unpublish' : 'publish';
			$alt = $row->published ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
			$checked = mosCommonHTML::CheckedOutProcessing( $row, $i );

			$row->cat_link 	= 'index2.php?option=com_categories&section=com_newsfeeds&task=editA&hidemainmenu=1&id='. $row->catid;
			?>
			<tr class="row<?php echo $k; ?>">
				<td align="center" style="text-align:center;"><?php echo $pageNav->rowNumber( $i ); ?></td>
				<td><?php echo $checked; ?></td>
				<td>
				<?php
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					?>
					<?php echo $row->name; ?>
					&nbsp;[ <em><?php echo $adminLanguage->A_CHECKEDOUT; ?></em> ]
					<?php
				} else {
					?>
					<a href="<?php echo $link; ?>" title="<?php echo $adminLanguage->A_CMP_NFE_EDIT; ?>"><?php echo $row->name; ?></a>
					<?php
				}
				?>
				</td>
				<td align="center" style="text-align:center;">
                    <div id="feedstatus<?php echo $i; ?>">
                        <a href="javascript: void(0);" onclick="changeFeedState('<?php echo $i; ?>', '<?php echo $row->id; ?>', '<?php echo ($row->published) ? 0 : 1; ?>');" title="<?php echo $alt; ?>">
                        <img src="images/<?php echo $img; ?>" border="0" alt="<?php echo $alt; ?>" /></a>
                    </div>
				</td>
				<td style="text-align:<?php echo (_GEM_RTL) ? 'left' : ' right'; ?>;">
                    <?php echo $pageNav->orderUpIcon( $i ); ?>
				</td>
				<td style="text-align:<?php echo (_GEM_RTL) ? 'right' : ' left'; ?>;">
                    <?php echo $pageNav->orderDownIcon( $i, $n ); ?>
				</td>
				<td>
                    <a href="<?php echo $row->cat_link; ?>" title="<?php echo $adminLanguage->A_EDITCATEGORY; ?>">
                        <?php echo $row->catname; ?>
                    </a>
				</td>
				<td align="center" style="text-align:center;"><?php echo $row->numarticles; ?></td>
				<td align="center" style="text-align:center;"><?php echo $row->cache_time; ?></td>
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


    /**************************/
    /* HTML ADD/EDIT NEWSFEED */
    /**************************/
	static public function editNewsFeed( &$row, &$lists, $option ) {
        global $adminLanguage, $mosConfig_live_site;

        mosMakeHtmlSafe( $row, ENT_QUOTES );
        mosCommonHTML::loadOverlib();
?>
		<script type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			//do field validation
			if (form.name.value == '') {
				alert( "<?php echo $adminLanguage->A_CMP_NFE_FILNM; ?>" );
			} else if (trim(form.seotitle.value) == ""){
                alert( "<?php echo $adminLanguage->A_SEOTEMPTY; ?>" );
			} else if (form.catid.value == 0) {
				alert( "<?php echo $adminLanguage->A_PLSSELECTCAT; ?>" );
			} else if (form.link.value == '') {
				alert( "<?php echo $adminLanguage->A_CMP_NFE_FILINK; ?>" );
			} else if (getSelectedValue('adminForm','catid') < 0) {
				alert( "<?php echo $adminLanguage->A_PLSSELECTCAT; ?>" );
			} else if (form.numarticles.value == "" || form.numarticles.value == 0) {
				alert( "<?php echo $adminLanguage->A_CMP_NFE_FILNB; ?>" );
			} else if (form.cache_time.value == "" || form.cache_time.value == 0) {
				alert( "<?php echo $adminLanguage->A_CMP_NFE_FILLREF; ?>" );
			} else {
				submitform( pressbutton );
			}
		}
		</script>
		<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/administrator/components/com_newsfeeds/newsfeedsajax.js"></script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="syndicate">
                <?php echo $adminLanguage->A_CMP_NFE_NEWS; ?>: 
                <span class="small">
                    <?php echo $row->id ? $adminLanguage->A_EDIT.' [ '.$row->name.' ]' : $adminLanguage->A_NEW; ?>
                </span>
			</th>
		</tr>
		</table>

		<table class="adminform">
		<tr>
			<th colspan="2"><?php echo $adminLanguage->A_DETAILS; ?></th>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_CATEGORY; ?></td>
			<td>
                <?php echo $lists['category']; ?>
			</td>
		</tr>
		<tr>
			<td width="250"><?php echo $adminLanguage->A_NAME; ?></td>
			<td>
                <input class="inputbox" type="text" size="40" name="name" value="<?php echo $row->name; ?>" />
			</td>
		</tr>
		<tr>
			<td valign="top"><?php echo $adminLanguage->A_SEOTITLE; ?>:</td>
			<td>
				<input name="seotitle" id="seotitle" type="text" dir="ltr" class="inputbox" value="<?php echo $row->seotitle; ?>" size="30" maxlength="100" />
				<?php echo mosToolTip($adminLanguage->A_SEOTHELP); ?><br />
                <a href="javascript:void(0);" onclick="suggestSEO()"><?php echo $adminLanguage->A_SEOTSUG; ?></a> &nbsp; | &nbsp; 
                <a href="javascript:void(0);" onclick="validateSEO()"><?php echo $adminLanguage->A_SEOTVAL; ?></a><br />
                <div id="valseo" style="height: 20px;"></div>                              
            </td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_LINK; ?></td>
			<td>
                <input type="text" name="link" dir="ltr" class="inputbox" size="60" value="<?php echo $row->link; ?>" />
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_CMP_NFE_NMBART; ?></td>
			<td>
                <input class="inputbox" type="text" size="2" name="numarticles" value="<?php echo $row->numarticles; ?>" />
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_CMP_NFE_CACHTM; ?></td>
			<td>
                <input class="inputbox" type="text" size="4" name="cache_time" value="<?php echo $row->cache_time; ?>" />
			</td>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_ORDERING; ?></td>
			<td>
                <?php echo $lists['ordering']; ?>
			</td>
		</tr>
		<tr>
			<td valign="top" align="right"><?php echo $adminLanguage->A_PUBLISHED; ?>:</td>
			<td>
                <?php echo $lists['published']; ?>
			</td>
		</tr>
		</table>

		<input type="hidden" name="id" value="<?php echo intval($row->id); ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		</form>
<?php 
	}
}
?>