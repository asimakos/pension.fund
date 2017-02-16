<?php
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: ToolBar
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/


class mosToolBar {


	/***********************/
	/* BUTTONS TABLE START */
	/***********************/
	static public function startTable() {
?>
		<table cellpadding="0" cellspacing="0" border="0" width="99%">
		<tr>
<?php
	}

	/*******************************/
	/* WRITES CUSTOM OPTION BUTTON */
	/*******************************/
	static public function custom( $task='', $icon='', $iconOver='', $alt='', $listSelect=true ) {
		if (defined('_ELXIS_ADMIN')) {
			global $adminLanguage;
			$sellistto = $adminLanguage->A_ALERT_SELECT_TO;
		} else {
			$sellistto = 'Please make a selection from the list to';
		}
		if ($listSelect) {
			$href = "javascript:if (document.adminForm.boxchecked.value == 0){ alert('".$sellistto." ".$alt."');}else{submitbutton('$task')}";
		} else {
			$href = "javascript:submitbutton('$task')";
		}
?>
		<td width="25" align="center">
		<a href="<?php echo $href; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','images/<?php echo $iconOver; ?>',1);">
		<img name="<?php echo $task; ?>" src="images/<?php echo $icon; ?>" alt="<?php echo $alt; ?>" border="0" />
		</a>
		</td>
<?php 
	}


	/******************************/
	/* WRITES AN 'ADD NEW' BUTTON */
	/******************************/
	static public function addNew( $task='new', $alt=_CMN_NEW ) {
		$image = mosAdminMenus::ImageCheck( 'new.png', '/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheck( 'new_f2.png', '/images/', NULL, NULL, $alt, $task, 0 );
?>
		<td width="25" align="center">
		<a href="javascript:submitbutton('<?php echo $task; ?>');" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?>
		</a>
		</td>
<?php 
	}


	/*****************************/
	/* WRITES A 'PUBLISH' BUTTON */
	/*****************************/
	static public function publish( $task='publish', $alt=_CMN_PUBLISHED ) {
		$image = mosAdminMenus::ImageCheck( 'publish.png', '/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheck( 'publish_f2.png', '/images/', NULL, NULL, $alt, $task, 0);
?>
		<td width="25" align="center">
		<a href="javascript:submitbutton('<?php echo $task; ?>');" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?>
		</a>
		</td>
<?php 
	}


	/**********************************/
	/* WRITES A 'PUBLISH LIST' BUTTON */
	/**********************************/
	static public function publishList( $task='publish', $alt=_CMN_PUBLISHED ) {
		$image = mosAdminMenus::ImageCheck( 'publish.png', '/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheck( 'publish_f2.png', '/images/', NULL, NULL, $alt, $task, 0 );

		if (defined('_ELXIS_ADMIN')) {
			global $adminLanguage;
			$sellistto = $adminLanguage->A_ALERT_SELECT_PUB;
		} else {
			$sellistto = 'Please make a selection from the list to publish';
		}
?>
		<td width="25" align="center">
		<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $sellistto; ?>'); } else {submitbutton('<?php echo $task; ?>', '');}" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?>
		</a>
		</td>
<?php 
	}


	/********************************/
	/* WRITES AN 'UNPUBLISH' BUTTON */
	/********************************/
	static public function unpublish( $task='unpublish', $alt=_CMN_UNPUBLISHED ) {
		$image = mosAdminMenus::ImageCheck( 'unpublish.png', '/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheck( 'unpublish_f2.png', '/images/', NULL, NULL, $alt, $task, 0 );
?>
		<td width="25" align="center">
		<a href="javascript:submitbutton('<?php echo $task; ?>');" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);" >
		<?php echo $image; ?>
		</a>
		</td>
<?php 
	}

	/**
	* Writes a common 'unpublish' button for a list of records
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function unpublishList( $task='unpublish', $alt=_CMN_UNPUBLISHED ) {
	  global $adminLanguage;
		$image = mosAdminMenus::ImageCheck( 'unpublish.png', '/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheck( 'unpublish_f2.png', '/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td width="25" align="center">
		<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_UNPUBLISH; ?>'); } else {submitbutton('<?php echo $task;?>', '');}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task;?>','','<?php echo $image2; ?>',1);" >
		<?php echo $image; ?>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a common 'archive' button for a list of records
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function archiveList( $task='archive', $alt=_CMN_ARCHIVE ) {
	  global $adminLanguage;
		$image = mosAdminMenus::ImageCheck( 'archive.png', '/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheck( 'archive_f2.png', '/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td width="25" align="center">
		<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_ARCHIVE; ?>'); } else {submitbutton('<?php echo $task;?>', '');}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task;?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?>
		</a>
		</td>
		<?php
	}

	/**
	* Writes an unarchive button for a list of records
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function unarchiveList( $task='unarchive', $alt=_CMN_UNARCHIVE ) {
	  global $adminLabguage;
		$image = mosAdminMenus::ImageCheck( 'unarchive.png', '/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheck( 'unarchive_f2.png', '/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td width="25" align="center">
		<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_UNARCHIVE; ?>'); } else {submitbutton('<?php echo $task;?>', '');}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task;?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a common 'edit' button for a list of records
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function editList( $task='edit', $alt=_E_EDIT ) {
	  global $adminLanguage;
		$image = mosAdminMenus::ImageCheck( 'html.png', '/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheck( 'html_f2.png', '/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td width="25" align="center">
		<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_EDIT; ?>'); } else {submitbutton('<?php echo $task;?>', '');}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task;?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a common 'edit' button for a template html
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function editHtml( $task='edit_source', $alt=_CMN_EDIT_HTML ) {
	  global $adminLanguage;
		$image = mosAdminMenus::ImageCheck( 'html.png', '/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheck( 'html_f2.png', '/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td width="25" align="center">
		<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_EDIT; ?>'); } else {submitbutton('<?php echo $task;?>', '');}" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task;?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a common 'edit' button for a template css
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function editCss( $task='edit_css', $alt=_CMN_EDIT_CSS ) {
	  global $adminLanguage;
		$image = mosAdminMenus::ImageCheck( 'css.png', '/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheck( 'css_f2.png', '/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td width="25" align="center">
		<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_EDIT; ?>'); } else {submitbutton('<?php echo $task; ?>', '');}" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?>
		</a>
		</td>
<?php 
	}


	/************************************/
	/* WRITES A DELETE FROM LIST BUTTON */
	/************************************/
	static public function deleteList( $msg='', $task='remove', $alt=_CMN_DELETE ) {
		$image = mosAdminMenus::ImageCheck( 'delete.png', '/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheck( 'delete_f2.png', '/images/', NULL, NULL, $alt, $task, 0 );

		if (defined('_ELXIS_ADMIN')) {
			global $adminLanguage;
			$sellistto = $adminLanguage->A_ALERT_CONFIRM_DELETE;
		} else {
			$sellistto = 'Are you sure you want to delete selected item(s)?';
		}
?>
		<td width="25" align="center">
		<a href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $sellistto; ?>'); } else if (confirm('<?php echo $sellistto; ?> <?php echo $msg; ?>')){ submitbutton('<?php echo $task; ?>');}" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?>
		</a>
		</td>
<?php 
	}


	/************************************/
	/* WRITES A PREVIEW IN POPUP BUTTON */
	/************************************/
	static public function preview( $popup='' ) {
		global $database;

		$database->setQuery("SELECT template FROM #__templates_menu WHERE client_id='0' AND menuid='0'", '#__', 1, 0);
		$cur_template = $database->loadResult();
		$image = mosAdminMenus::ImageCheck( 'preview.png', 'images/', NULL, NULL, 'Preview', 'preview' );
		$image2 = mosAdminMenus::ImageCheck( 'preview_f2.png', 'images/', NULL, NULL, 'Preview', 'preview', 0 );
?>
		<td width="25" align="center">
		<a href="javascript:void(0);" onclick="window.open('popups/<?php echo $popup; ?>.php?t=<?php echo $cur_template; ?>', 'win1', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('preview','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?>
		</a>
		</td>
<?php 
	}


	/************************/
	/* WRITES A SAVE BUTTON */
	/************************/
	static public function save( $task='save', $alt=_CMN_SAVE ) {
		$image = mosAdminMenus::ImageCheck( 'save.png', '/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheck( 'save_f2.png', '/images/', NULL, NULL, $alt, $task, 0 );
?>
		<td width="25" align="center">
		<a href="javascript:submitbutton('<?php echo $task; ?>');" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?>
		</a>
		</td>
<?php 
	}


	/*****************************************/
	/* WRITES A SAVE NEW BUTTON (DEPRECATED) */
	/*****************************************/
	static public function savenew() {
		$image = mosAdminMenus::ImageCheck( 'save.png', '/images/', NULL, NULL, 'save', 'save' );
		$image2 = mosAdminMenus::ImageCheck( 'save_f2.png', '/images/', NULL, NULL, 'save', 'save', 0 );
?>
		<td width="25" align="center">
		<a href="javascript:submitbutton('savenew');" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('save','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?>
		</a>
		</td>
<?php 
	}


	/******************************************/
	/* WRITES A SAVE EDIT BUTTON (DEPRECATED) */
	/******************************************/
	static public function saveedit() {
		$image = mosAdminMenus::ImageCheck( 'save.png', '/images/', NULL, NULL, 'save', 'save' );
		$image2 = mosAdminMenus::ImageCheck( 'save_f2.png', '/images/', NULL, NULL, 'save', 'save', 0 );
?>
		<td width="25" align="center">
		<a href="javascript:submitbutton('saveedit');" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('save','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?>
		</a>
		</td>
<?php 
	}


	/**************************/
	/* WRITES A CANCEL BUTTON */
	/**************************/
	static public function cancel( $task='cancel', $alt=_GEM_CANCEL ) {
		$image = mosAdminMenus::ImageCheck( 'cancel.png', '/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheck( 'cancel_f2.png', '/images/', NULL, NULL, $alt, $task, 0 );
?>
		<td width="25" align="center">
		<a href="javascript:submitbutton('<?php echo $task; ?>');" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?>
		</a>
		</td>
<?php 
	}


	/*******************************/
	/* WRITES A CANCEL BACK BUTTON */
	/*******************************/
	static public function back() {
		$image = mosAdminMenus::ImageCheck( 'back.png', '/images/', NULL, NULL, 'back', 'cancel' );
		$image2 = mosAdminMenus::ImageCheck( 'back_f2.png', '/images/', NULL, NULL, 'back', 'cancel', 0 );
?>
		<td width="25" align="center">
		<a href="javascript:window.history.back();" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('cancel','','images/<?php echo $image2; ?>',1);">
		<?php echo $image; ?>
		</a>
		</td>
<?php 
	}


	/********************/
	/* WRITES A DIVIDER */
	/********************/
	static public function divider() {
		$image = mosAdminMenus::ImageCheck( 'menu_divider.png', '/images/' );
?>
		<td width="25" align="center">
			<?php echo $image; ?>
		</td>
<?php 
	}


	/**
	* Writes a media_manager button
	* @param string The sub-drectory to upload the media to
	*/
	static public function media_manager( $directory = '' ) {
	  global $adminLanguage;
		$image = mosAdminMenus::ImageCheck( 'upload.png', '/images/', NULL, NULL, $adminLanguage->A_UPLOADIMAGE, 'uploadPic' );
		$image2 = mosAdminMenus::ImageCheck( 'upload_f2.png', '/images/', NULL, NULL, $adminLanguage->A_UPLOADIMAGE, 'uploadPic', 0 );
		?>
		<td width="25" align="center">
		<a href="javascript:void(0);" onclick="popupWindow('popups/uploadimage.php?directory=<?php echo $directory; ?>','win1',250,100,'no');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('uploadPic','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?>
		</a>
		</td>
		<?php
	}


	/**********************/
	/* WRITES SPACER CELL */
	/**********************/
	static public function spacer( $width='' ) {
		echo ($width != '') ? '<td width="'.$width.'">&nbsp;</td>' : '<td>&nbsp;</td>';
	}


	/*********************/
	/* BUTTONS TABLE END */
	/*********************/
	static public function endTable() {
?>
		</tr>
		</table>
<?php 
	}
}

?>