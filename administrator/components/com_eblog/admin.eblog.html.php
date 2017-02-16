<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component eBlog
* @author: Ioannis Sannos (Elxis Team)
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Component eBlog back-end
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class eBlogBHTML {


    /*******************/
    /* HTML LIST BLOGS */
    /*******************/
	static public function listBlogs($rows, $pageNav) {
		global $adminLanguage, $mainframe, $eblogb;
?>

		<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/components/com_eblog/eblogbackajax.js"></script>

		<form name="adminForm" action="index2.php" method="post">
		<table class="adminheading">
		<tr>
			<th><?php echo $eblogb->lng->ELXISBLOG; ?></th>
		</tr>
		</table>

		<table class="adminlist" summary="List of existing Elxis blogs">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20"></th>
			<th class="title"><?php echo $adminLanguage->A_TITLE; ?></th>
			<th><?php echo $adminLanguage->A_PUBLISHED; ?></th>
			<th class="title"><?php echo $eblogb->lng->BLOGOWNER; ?></th>
			<th><?php echo $eblogb->lng->POSTS; ?></th>
		</tr>
<?php 
		$k = 0;
		for ($i=0; $i<count($rows); $i++) {
			$row = $rows[$i];

			$link = 'index2.php?option=com_eblog&task=editA&hidemainmenu=1&blogid='.$row->blogid;
			$img = $row->published ? 'tick.png' : 'publish_x.png';
			$task = $row->published ? 'unpublish' : 'publish';
			$alt = $row->published ? $adminLanguage->A_PUBLISHED : $adminLanguage->A_UNPUBLISHED;
?>
			<tr class="row<?php echo $k; ?>">
				<td align="center"><?php echo $pageNav->rowNumber( $i ); ?></td>
				<td><input type="checkbox" id="cb<?php echo $i; ?>" name="cid[]" value="<?php echo $row->blogid; ?>" onclick="isChecked(this.checked);" /></td>
				<td>
                    <a href="<?php echo $link; ?>" title="<?php echo $adminLanguage->A_EDIT; ?>"><?php echo $row->title; ?></a>
				</td>
				<td align="center">
                    <div id="blogstatus<?php echo $i; ?>">
                        <a href="javascript: void(0);" onclick="changeBlogState('<?php echo $i; ?>', '<?php echo $row->blogid; ?>', '<?php echo ($row->published) ? 0 : 1; ?>');" title="<?php echo $alt; ?>">
                        <img src="images/<?php echo $img; ?>" border="0" alt="<?php echo $alt; ?>" /></a>
                    </div>
				</td>
				<td><?php echo $row->name.' ('.$row->username.')'; ?></td>
				<td align="center"><?php echo $row->posts; ?></td>
			</tr>
<?php 
			$k = 1 - $k;
		}
?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="com_eblog" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		</form>
<?php 
	}


    /**********************/
    /* HTML ADD/EDIT BLOG */
    /**********************/
	static public function editBlog($row, $lists) {
        global $adminLanguage, $mainframe, $eblogb;

        mosCommonHTML::loadOverlib();
?>
		<script type="text/javascript">
		/* <![CDATA[ */
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			if (form.title.value == '') {
				alert( "<?php echo $eblogb->lng->TITLENOEMPTY; ?>" );
			} else if (trim(form.seotitle.value) == ""){
                alert( "<?php echo $adminLanguage->A_SEOTEMPTY; ?>" );
			} else if (form.ownerid.value == 0) {
				alert( "Please select a blog owner" );
			} else if (form.cssfile.value == '') {
				alert("Please select a CSS file");
			} else if (form.rtlcssfile.value == '') {
				alert("Please select an RTL CSS file");
			} else {
				submitform( pressbutton );
			}
		}
		/* ]]> */
		</script>
		<script src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/components/com_eblog/eblogbackajax.js"></script>

		<form name="adminForm" action="index3.php" method="post">
		<table class="adminheading">
		<tr>
			<th><?php echo $eblogb->lng->ELXISBLOG; ?> 
                <span class="small">
                    <?php echo $row->blogid ? $adminLanguage->A_EDIT.' [ '.$row->title.' ]' : $adminLanguage->A_NEW; ?>
                </span>
			</th>
		</tr>
		</table>

		<table cellspacing="0" cellpadding="0" class="adminlist">
		<tr>
			<th width="60%" class="title"><?php echo $adminLanguage->A_DETAILS; ?></th>
			<th class="title"><?php echo $eblogb->lng->BLOGINFO; ?></th>
		</tr>
		<tr>
			<td>
		<table class="adminlist">
		<tr class="row0">
			<td><?php echo $adminLanguage->A_TITLE; ?></td>
			<td>
                <input class="inputbox" type="text" size="40" name="title" value="<?php echo $row->title; ?>" />
			</td>
		</tr>
		<tr class="row1">
			<td valign="top"><?php echo $adminLanguage->A_SEOTITLE; ?></td>
			<td>
				<input name="seotitle" id="seotitle" type="text" dir="ltr" class="inputbox" value="<?php echo $row->seotitle; ?>" size="30" maxlength="100" />
				<?php echo mosToolTip($adminLanguage->A_SEOTHELP); ?><br />
                <a href="javascript:void(0);" onclick="suggestebSEO()"><?php echo $adminLanguage->A_SEOTSUG; ?></a> &nbsp; | &nbsp; 
                <a href="javascript:void(0);" onclick="validateebSEO()"><?php echo $adminLanguage->A_SEOTVAL; ?></a><br />
                <div id="valseo" style="height: 20px;"></div>                              
            </td>
		</tr>
		<tr class="row0">
			<td valign="top"><?php echo $eblogb->lng->SLOGAN; ?></td>
			<td>
				<textarea name="slogan" cols="50" rows="4" class="text_area"><?php echo $row->slogan; ?></textarea> 
				<?php echo mosToolTip($eblogb->lng->SLOGAND); ?>
			</td>
		</tr>
		<tr class="row1">
			<td><?php echo $eblogb->lng->BLOGOWNER; ?></td>
			<td><?php echo $lists['ownerid']; ?></td>
		</tr>
		<tr class="row0">
			<td><?php echo $eblogb->lng->TAGS; ?></td>
			<td>
				<?php echo $lists['showtags']; ?> 
				<?php echo mosToolTip($eblogb->lng->SHOWTAGSD); ?>
			</td>
		</tr>
		<tr class="row1">
			<td><?php echo $eblogb->lng->CSSFILE; ?></td>
			<td>
				<?php echo $lists['cssfile']; ?> 
				<?php echo mosToolTip($eblogb->lng->CSSFILED); ?>
			</td>
		</tr>
		<tr class="row0">
			<td><?php echo $eblogb->lng->RTLCSSFILE; ?></td>
			<td>
				<?php echo $lists['rtlcssfile']; ?> 
				<?php echo mosToolTip($eblogb->lng->RTLCSSFILED); ?>
			</td>
		</tr>
		<tr class="row1">
			<td><?php echo $eblogb->lng->COMMENTARY; ?></td>
			<td>
				<?php echo $lists['allowcomments']; ?>
			</td>
		</tr>
		<tr class="row0">
			<td><?php echo $eblogb->lng->SETTINGS; ?></td>
			<td>
				<?php echo $lists['canconfig']; ?> 
				<?php echo mosToolTip($eblogb->lng->CANCONFIGD); ?>
			</td>
		</tr>
		<tr class="row1">
			<td><?php echo $eblogb->lng->UPLOAD; ?></td>
			<td>
				<?php echo $lists['canupload']; ?> 
				<?php echo mosToolTip($eblogb->lng->CANUPLOADD); ?><br />
				<?php echo $eblogb->lng->BLOGOWNMDIR; ?>: <span dir="ltr" style="color: blue;">images/userfiles/<?php echo $row->ownerid; ?>/</span>
				<?php 
				if (file_exists($mainframe->getCfg('absolute_path').'/images/userfiles/'.$row->ownerid.'/')) {
					echo ' ('.$eblogb->lng->EXISTING.')';
				} else {
					echo ' ('.$eblogb->lng->NONEXISTING.')';
				}
				?>
			</td>
		</tr>
		<tr class="row0">
			<td><?php echo $eblogb->lng->SIZEKB; ?></td>
			<td>
                <input class="inputbox" type="text" size="7" maxlength="7" dir="ltr" name="mediasize" value="<?php echo $row->mediasize; ?>" /> KB 
                <?php echo mosToolTip($eblogb->lng->SIZEKBD); ?>
			</td>
		</tr>
		<tr class="row1">
			<td><?php echo $eblogb->lng->POSTSNUMBER; ?></td>
			<td>
				<select name="numposts" dir="ltr" class="selectbox">
				<?php 
				for ($i=1; $i<51; $i++) {
					$sel = ($i == $row->numposts) ? ' selected="selected"' : '';
					echo '<option value="'.$i.'"'.$sel.'>&nbsp;'.$i.'&nbsp;</option>'._LEND;
				}
				?>
				</select> 
                <?php echo mosToolTip($eblogb->lng->POSTSNUMBERD); ?>
			</td>
		</tr>
		<tr class="row0">
			<td valign="top"><?php echo $adminLanguage->A_PUBLISHED; ?></td>
			<td>
                <?php echo $lists['published']; ?>
			</td>
		</tr>
		<tr class="row1">
			<td><?php echo $eblogb->lng->SHOWOWNER; ?></td>
			<td>
				<?php echo $lists['showownertop']; ?> 
				<?php echo mosToolTip($eblogb->lng->SHOWOWNERD); ?>
			</td>
		</tr>
		<tr class="row0">
			<td><?php echo $eblogb->lng->SHOWARCHIVE; ?></th>
			<td>
				<?php echo $lists['footerarchive']; ?> 
				<?php echo mosToolTip($eblogb->lng->SHOWARCHIVED); ?>
			</td>
		</tr>
		<tr class="row1">
			<td valign="top"><?php echo $eblogb->lng->SHAREPOST; ?></td>
			<td>
                <?php echo $lists['share']; ?>
			</td>
		</tr>
		<tr class="row0">
			<td>e-mailit <?php echo $adminLanguage->A_USERNAME; ?></td>
			<td>
                <input class="inputbox" type="text" dir="ltr" name="emailit" value="<?php echo $row->emailit; ?>" /> 
                <?php echo mosToolTip('Your e-mailit username - optional'); ?>
			</td>
		</tr>
		<tr class="row1">
			<td>AddThis <?php echo $adminLanguage->A_USERNAME; ?></td>
			<td>
                <input class="inputbox" type="text" dir="ltr" name="addthis" value="<?php echo $row->addthis; ?>" /> 
                <?php echo mosToolTip('Your AddThis username - optional'); ?>
			</td>
		</tr>
		</table>
		</td>
		<td valign="top">
			<table class="adminlist">
				<tr class="row0">
					<td><?php echo $eblogb->lng->POSTS; ?></td>
					<td><?php echo $row->posts; ?></td>
				</tr>
				<tr class="row1">
					<td><?php echo $eblogb->lng->COMMENTS; ?></td>
					<td><?php echo $row->comments; ?></td>
				</tr>
				<tr class="row0">
					<td><?php echo $eblogb->lng->UPLOADDIR; ?></td>
					<td><?php 
					if (!$row->blogid) {
						echo $eblogb->lng->NOTSETYET;
					} else {
						$basedir = $mainframe->getCfg('absolute_path').'/images/userfiles';
						if ($row->canupload && (file_exists($basedir.'/'.$row->ownerid.'/'))) {
							echo '/images/userfiles/'.$row->ownerid.'/';
						} else if ($row->canupload && (!file_exists($basedir.'/'.$row->ownerid.'/'))) {
							echo '/images/userfiles/'.$row->ownerid.'/<br />'._LEND;
							echo '<span style="color: #FF0000; font-weight: bold;">'.$eblogb->lng->NONEXISTING.'</span>'._LEND;
						} else if (!$row->canupload && (file_exists($basedir.'/'.$row->ownerid.'/'))) {
							echo '/images/userfiles/'.$row->ownerid.'/<br />'._LEND;
							echo '<span style="color: #FF0000;">'.$eblogb->lng->UNOTALLUPLOADF.'</span>'._LEND;
						} else {
							echo $eblogb->lng->NONEXISTING;
						}
					}
					?></td>
				</tr>
				<tr class="row1">
					<td><?php echo $eblogb->lng->UPLOADEDFILES; ?></td>
					<td><?php echo $row->totalfiles; ?></td>
				</tr>
				<tr class="row0">
					<td><?php echo $eblogb->lng->USEDSPACE; ?></td>
					<td><?php echo round(($row->totalsize/1000), 2).'/'.$row->mediasize; ?> KB</td>
				</tr>
				<tr class="row1">
					<td><?php echo $eblogb->lng->LASTPOST; ?></td>
					<td><?php echo $row->lastpost; ?></td>
				</tr>
				<tr class="row0">
					<td><?php echo $eblogb->lng->LASTPOSTDATE; ?></td>
					<td><?php echo $row->lastpostdate; ?></td>
				</tr>
			</table>
		</td>
		</tr>
		</table>

		<input type="hidden" name="blogid" value="<?php echo intval($row->blogid); ?>" />
		<input type="hidden" name="option" value="com_eblog" />
		<input type="hidden" name="task" value="" />
		</form>
<?php 
	}
}
?>