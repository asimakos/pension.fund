<?php 
/**
* @version: $Id: menubar.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Menubar
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Utility class for the button bar
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class mosMenuBar {

	/***************************/
	/* START BUTTONS BAR TABLE */
	/***************************/
	static public function startTable() {
?>
		<script type="text/javascript">
		<!--
		function MM_swapImgRestore() {
		var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
		}
		//-->
		</script>
		<table cellpadding="0" cellspacing="1" border="0">
		<tr>
		<?php 
	}


	/**
	* Writes a custom option and task button for the button bar
	* @param string The task to perform (picked up by the switch($task) blocks
	* @param string The image to display
	* @param string The image to display when moused over
	* @param string The alt text for the icon image
	* @param boolean True if required to check that a standard list item is checked
	*/
	static public function custom( $task='', $icon='', $iconOver='', $alt='', $listSelect=true ) {
    	global $adminLanguage;
        
		if ($listSelect) {
			$href = "javascript:if (document.adminForm.boxchecked.value == 0){ alert('".$adminLanguage->A_ALERT_SELECT_TO." ".$alt."');}else{submitbutton('$task')}";
		} else {
			$href = "javascript:submitbutton('$task')";
		}
		if ($icon && $iconOver) {
		?>
		<td align="center">
		<a class="toolbar" href="<?php echo $href; ?>" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('<?php echo $task; ?>','','images/<?php echo $iconOver; ?>',1);">
		<img name="<?php echo $task; ?>" src="images/<?php echo $icon; ?>" border="0" align="middle" /><br />
		<div><?php echo $alt; ?></div>
        </a>
		</td>
		<?php
		} else {
		?>
		<td align="center">
		<a class="toolbar" href="<?php echo $href; ?>" title="<?php echo $alt; ?>">
		<?php echo $alt; ?><br />
        <div><?php echo $alt; ?></div>
        </a>
		</td>
		<?php
		}
	}

	/**
	* Writes a custom option and task button for the button bar.
	* Extended version of custom() calling hideMainMenu() before submitbutton().
	* @param string The task to perform (picked up by the switch($task) blocks
	* @param string The image to display
	* @param string The image to display when moused over
	* @param string The alt text for the icon image
	* @param boolean True if required to check that a standard list item is checked
	*/
	static public function customX( $task='', $icon='', $iconOver='', $alt='', $listSelect=true ) {
    	global $adminLanguage;
        
		if ($listSelect) {
			$href = "javascript:if (document.adminForm.boxchecked.value == 0){ alert('".$adminLanguage->A_ALERT_SELECT_TO." ".$alt."');}else{hideMainMenu();submitbutton('$task')}";
		} else {
			$href = "javascript:hideMainMenu();submitbutton('$task')";
		}
		if ($icon && $iconOver) {
		?>
		<td align="center">
		<a class="toolbar" href="<?php echo $href; ?>" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','images/<?php echo $iconOver; ?>',1);">
		<img name="<?php echo $task; ?>" src="images/<?php echo $icon; ?>" border="0" align="middle" /><br />
        <div><?php echo $alt; ?></div>
        </a>
		</td>
		<?php
		} else {
		?>
		<td align="center">
		<a class="toolbar" href="<?php echo $href; ?>" title="<?php echo $alt; ?>">
        <div><?php echo $alt; ?></div>
        </a>
		</td>
		<?php 
		}
	}


	/**
	* Writes the common 'new' icon for the button bar
	* @param string An override for the task
	* @param string An override for the alt text
	* Ioannis Sannos: added icon and iconOver to pass specific icons for new item, category, user, group etc
	*/
	static public function addNew( $task='new', $alt='', $icon='', $iconOver='' ) {
    	global $adminLanguage;

    	if ($alt == '') { $alt = $adminLanguage->A_NEW; }
    	if (!($icon && $iconOver)) {
    	   $icon = 'new.png';
           $iconOver = 'new_f2.png';
    	}
		$image = mosAdminMenus::ImageCheckAdmin( $icon, '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( $iconOver, '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:submitbutton('<?php echo $task; ?>');" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}


	/**
	* Writes the common 'new' icon for the button bar.
	* Extended version of addNew() calling hideMainMenu() before submitbutton().
	* @param string An override for the task
	* @param string An override for the alt text
	* Ioannis Sannos: added icon and iconOver to pass specific icons for new item, category, user, group etc
	*/
	static public function addNewX( $task='new', $alt='', $icon='', $iconOver='' ) {
    	global $adminLanguage;

    	if ($alt == '') { $alt = $adminLanguage->A_NEW; }
    	if (!($icon && $iconOver)) {
    	   $icon = 'new.png';
           $iconOver = 'new_f2.png';
    	}
		$image = mosAdminMenus::ImageCheckAdmin( $icon, '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( $iconOver, '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:hideMainMenu();submitbutton('<?php echo $task; ?>');" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
        <div><?php echo $alt; ?></div>
        </a>
		</td>
		<?php
	}

	/**
	* Writes a common 'publish' button
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function publish( $task='publish', $alt='' ) {
    	global $adminLanguage;

    	if ($alt == '') { $alt = $adminLanguage->A_PUBLISH; }
		$image = mosAdminMenus::ImageCheckAdmin( 'publish.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'publish_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:submitbutton('<?php echo $task; ?>');" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a common 'publish' button for a list of records
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function publishList( $task='publish', $alt='' ) {
    	global $adminLanguage;

    	if ($alt == '') { $alt = $adminLanguage->A_PUBLISH; }
		$image = mosAdminMenus::ImageCheckAdmin( 'publish.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'publish_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
     	<td align="center">
		<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_PUB; ?>'); } else {submitbutton('<?php echo $task; ?>', '');}" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
     	<?php
	}

	/**
	* Writes a common 'default' button for a record
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function makeDefault( $task='default', $alt='' ) {
    	global $adminLanguage;

    	if ($alt == '') { $alt = $adminLanguage->A_DEFAULT; }
		$image = mosAdminMenus::ImageCheckAdmin( 'default.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'default_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_PUB_LIST; ?>'); } else {submitbutton('<?php echo $task; ?>', '');}" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}


	/*****************/
	/* ASSIGN BUTTON */
	/*****************/
	static public function assign( $task='assign', $alt='' ) {
    	global $adminLanguage;

    	if ($alt == '') { $alt = $adminLanguage->A_ASSIGN; }
		$image = mosAdminMenus::ImageCheckAdmin( 'assign.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'assign_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_ITEM_ASSIGN; ?>'); } else {submitbutton('<?php echo $task; ?>', '');}" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php 
	}


	/**
	* Writes a common 'unpublish' button
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function unpublish( $task='unpublish', $alt='' ) {
    	global $adminLanguage;
        
    	if ($alt == '') { $alt = $adminLanguage->A_UNPUBLISH; }
		$image = mosAdminMenus::ImageCheckAdmin( 'unpublish.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'unpublish_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:submitbutton('<?php echo $task; ?>');" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);" >
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a common 'unpublish' button for a list of records
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function unpublishList( $task='unpublish', $alt='' ) {
    	global $adminLanguage;

    	if ($alt == '') { $alt = $adminLanguage->A_UNPUBLISH; }
		$image = mosAdminMenus::ImageCheckAdmin( 'unpublish.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'unpublish_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_UNPUBLISH; ?>'); } else {submitbutton('<?php echo $task; ?>', '');}" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);" >
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a common 'archive' button for a list of records
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function archiveList( $task='archive', $alt='' ) {
    	global $adminLanguage;

    	if ($alt == '') { $alt = $adminLanguage->A_MENU_ARCHIVE; }
		$image = mosAdminMenus::ImageCheckAdmin( 'archive.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'archive_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_ARCHIVE; ?>'); } else {submitbutton('<?php echo $task; ?>', '');}" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes an unarchive button for a list of records
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function unarchiveList( $task='unarchive', $alt='' ) {
    	global $adminLanguage;

    	if ($alt == '') { $alt = $adminLanguage->A_UNARCHIVE; }
		$image = mosAdminMenus::ImageCheckAdmin( 'unarchive.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'unarchive_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_UNARCHIVE; ?>'); } else {submitbutton('<?php echo $task; ?>', '');}" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a common 'edit' button for a list of records
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function editList( $task='edit', $alt='' ) {
    	global $adminLanguage;

    	if ($alt == '') { $alt = $adminLanguage->A_EDIT; }        
		$image = mosAdminMenus::ImageCheckAdmin( 'edit.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'edit_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_EDIT; ?>'); } else {submitbutton('<?php echo $task; ?>', '');}" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a common 'edit' button for a list of records.
	* Extended version of editList() calling hideMainMenu() before submitbutton().
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function editListX( $task='edit', $alt='' ) {
    	global $adminLanguage;
        
    	if ($alt == '') { $alt = $adminLanguage->A_EDIT; }
		$image = mosAdminMenus::ImageCheckAdmin( 'edit.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'edit_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_EDIT; ?>'); } else {hideMainMenu();submitbutton('<?php echo $task; ?>', '');}" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a common 'edit' button for a template html
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function editHtml( $task='edit_source', $alt='' ) {
    	global $adminLanguage;

    	if ($alt == '') { $alt = $adminLanguage->A_EDIT.' HTML'; }
		$image = mosAdminMenus::ImageCheckAdmin( 'html.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'html_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_EDIT; ?>'); } else {submitbutton('<?php echo $task; ?>', '');}" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a common 'edit' button for a template html.
	* Extended version of editHtml() calling hideMainMenu() before submitbutton().
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function editHtmlX( $task='edit_source', $alt='' ) {
    	global $adminLanguage;

    	if ($alt == '') { $alt = $adminLanguage->A_EDIT.' HTML'; }
		$image = mosAdminMenus::ImageCheckAdmin( 'html.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'html_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_EDIT; ?>'); } else {hideMainMenu();submitbutton('<?php echo $task; ?>', '');}" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a common 'edit' button for a template css
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function editCss( $task='edit_css', $alt='' ) {
	    global $adminLanguage;
        
    	if ($alt == '') { $alt = $adminLanguage->A_EDIT.' CSS'; }
		$image = mosAdminMenus::ImageCheckAdmin( 'css.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'css_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_EDIT; ?>'); } else {submitbutton('<?php echo $task; ?>', '');}" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a common 'edit' button for a template css.
	* Extended version of editCss() calling hideMainMenu() before submitbutton().
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function editCssX( $task='edit_css', $alt='' ) {
    	global $adminLanguage;
    
    	if ($alt == '') { $alt = $adminLanguage->A_EDIT.' CSS'; }
		$image = mosAdminMenus::ImageCheckAdmin( 'css.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'css_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_EDIT; ?>'); } else {hideMainMenu();submitbutton('<?php echo $task; ?>', '');}" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a common 'delete' button for a list of records
	* @param string  Postscript for the 'are you sure' message
	* @param string An override for the task
	* @param string An override for the alt text
	* Ioannis Sannos: added icon and iconOver to pass specific icons for delete item, category, user, group etc
	*/
	static public function deleteList( $msg='', $task='remove', $alt='', $icon='', $iconOver='' ) {
    	global $adminLanguage;

        if ($alt == '') { $alt = $adminLanguage->A_DELETE; }
    	if (!($icon && $iconOver)) {
    	   $icon = 'delete.png';
           $iconOver = 'delete_f2.png';
    	}
		$image = mosAdminMenus::ImageCheckAdmin( $icon, '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( $iconOver, '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_DELETE; ?>'); } else if (confirm('<?php echo $adminLanguage->A_ALERT_CONFIRM_DELETE; ?>\n<?php echo $msg; ?>')){ submitbutton('<?php echo $task; ?>');}" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a common 'delete' button for a list of records.
	* Extended version of deleteList() calling hideMainMenu() before submitbutton().
	* @param string  Postscript for the 'are you sure' message
	* @param string An override for the task
	* @param string An override for the alt text
	* Ioannis Sannos: added icon and iconOver to pass specific icons for delete item, category, user, group etc
	*/
	static public function deleteListX( $msg='', $task='remove', $alt='', $icon='', $iconOver='' ) {
    	global $adminLanguage;

        if ($alt == '') { $alt = $adminLanguage->A_DELETE; }
    	if (!($icon && $iconOver)) {
    	   $icon = 'delete.png';
           $iconOver = 'delete_f2.png';
    	}
		$image = mosAdminMenus::ImageCheckAdmin( $icon, '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( $iconOver, '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_ALERT_SELECT_DELETE; ?>'); } else if (confirm('<?php echo $adminLanguage->A_ALERT_CONFIRM_DELETE; ?> <?php echo $msg; ?>')){ hideMainMenu();submitbutton('<?php echo $task; ?>');}" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Write a trash button that will move items to Trash Manager
	*/
	static public function trash( $task='remove', $alt='' ) {
    	global $adminLanguage;
        
        if ($alt == '') { $alt = $adminLanguage->A_TRASH; }
		$image = mosAdminMenus::ImageCheckAdmin( 'delete.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'delete_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		 <td align="center">
		<a class="toolbar" href="javascript:submitbutton('<?php echo $task; ?>');" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a preview button for a given option (opens a popup window)
	* @param string The name of the popup file (excluding the file extension)
	*/
	static public function preview( $popup='', $updateEditors=false ) {
		global $database, $adminLanguage;

		$image = mosAdminMenus::ImageCheckAdmin( 'preview.png', '/administrator/images/', NULL, NULL, $adminLanguage->A_PREVIEW, 'preview' );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'preview_f2.png', '/administrator/images/', NULL, NULL, $adminLanguage->A_PREVIEW, 'preview', 0 );

		$sql = "SELECT template FROM #__templates_menu WHERE client_id='0' AND menuid='0'";
		$database->setQuery( $sql );
		$cur_template = $database->loadResult();
		?>
		<td align="center">
		<script language="javascript">
		function popup() {
			<?php
			if ($updateEditors) {
				getEditorContents( 'editor1', 'introtext' );
				getEditorContents( 'editor2', 'maintext' );
			}
			?>
			window.open('popups/<?php echo $popup; ?>.php?t=<?php echo $cur_template; ?>', 'win1', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');
		}
		</script>
	 	<a class="toolbar" href="javascript:void(0);" title="<?php echo $adminLanguage->A_PREVIEW; ?>" onclick="popup();" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('preview','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $adminLanguage->A_PREVIEW; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a preview button for a given option (opens a popup window)
	* @param string The name of the popup file (excluding the file extension for an xml file)
	* @param boolean Use the help file in the component directory
	*/
	static public function help( $ref, $com=false ) {
		global $mosConfig_live_site, $adminLanguage, $alang, $mosConfig_absolute_path;

		$image = mosAdminMenus::ImageCheckAdmin( 'help.png', '/administrator/images/', NULL, NULL, $adminLanguage->A_HELP, 'help' );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'help_f2.png', '/administrator/images/', NULL, NULL, $adminLanguage->A_HELP, 'help', 0 );
		$helpUrl = mosGetParam( $GLOBALS, 'mosConfig_helpurl', '' );
		if ($helpUrl) {
			$url = $helpUrl . '/index2.php?option=com_content&amp;task=findkey&pop=1&keyref=' . urlencode( $ref );
		} else {
			$url = mosMenuBar::gethelppath();
			if ($com) {
				$url = $mosConfig_live_site . '/administrator/components/' . $GLOBALS['option'] . '/help/';
			}
			if (!preg_match('/(\.html)$/i', $ref)) {
				$ref = $ref . '.html';
			}
			$url .= $ref;
		}
		?>
		<td align="center">
		<a class="toolbar" href="javascript:void(0);" title="<?php echo $adminLanguage->A_HELP; ?>" onclick="window.open('<?php echo $url; ?>', 'Elxis_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=770,height=480,directories=no,location=no');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('help','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $adminLanguage->A_HELP; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a save button for a given option
	* Apply operation leads to a save action only (does not leave edit mode)
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function apply( $task='apply', $alt='' ) {
    	global $adminLanguage;

        if ($alt == '') { $alt = $adminLanguage->A_APPLY; }
		$image 	= mosAdminMenus::ImageCheckAdmin( 'apply.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'apply_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:submitbutton('<?php echo $task; ?>');" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a save button for a given option
	* Save operation leads to a save and then close action
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function save( $task='save', $alt='' ) {
    	global $adminLanguage;
        
        if ($alt == '') { $alt = $adminLanguage->A_SAVE; }
		$image = mosAdminMenus::ImageCheckAdmin( 'save.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'save_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:submitbutton('<?php echo $task; ?>');" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a save button for a given option (NOTE this is being deprecated)
	*/
	static public function savenew() {
    	global $adminLanguage;
        
		$image = mosAdminMenus::ImageCheckAdmin( 'save.png', '/administrator/images/', NULL, NULL, $adminLanguage->A_SAVE, 'save' );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'save_f2.png', '/administrator/images/', NULL, NULL, $adminLanguage->A_SAVE, 'save', 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:submitbutton('savenew');" title="<?php echo $adminLanguage->A_SAVE; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('save','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $adminLanguage->A_SAVE; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a save button for a given option (NOTE this is being deprecated)
	*/
	static public function saveedit() {
    	global $adminLanguage;
        
		$image = mosAdminMenus::ImageCheckAdmin( 'save.png', '/administrator/images/', NULL, NULL, $adminLanguage->A_SAVE, 'save' );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'save_f2.png', '/administrator/images/', NULL, NULL, $adminLanguage->A_SAVE, 'save', 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:submitbutton('saveedit');" title="<?php echo $adminLanguage->A_SAVE; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('save','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $adminLanguage->A_SAVE; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a cancel button and invokes a cancel operation (eg a checkin)
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function cancel( $task='cancel', $alt='' ) {
    	global $adminLanguage;
        
        if ($alt == '') { $alt = $adminLanguage->A_CANCEL; }
		$image = mosAdminMenus::ImageCheckAdmin( 'cancel.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'cancel_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:submitbutton('<?php echo $task; ?>');" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a cancel button that will go back to the previous page without doing
	* any other operation
	*/
	static public function back( $alt='', $href='' ) {
    	global $adminLanguage;
        
    	if ($alt== '') { $alt= $adminLanguage->A_BACK; }
		$image = mosAdminMenus::ImageCheckAdmin( 'back.png', '/administrator/images/', NULL, NULL, $adminLanguage->A_BACK, 'cancel' );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'back_f2.png', '/administrator/images/', NULL, NULL, $adminLanguage->A_BACK, 'cancel', 0 );
		if ( $href ) {
			$link = $href;
		} else {
			$link = 'javascript:window.history.back();';
		}
		?>
		<td align="center">
		<a class="toolbar" href="<?php echo $link; ?>" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('cancel','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Write a divider between menu buttons
	*/
	static public function divider() {
		$image = mosAdminMenus::ImageCheckAdmin( 'menu_divider.png', '/administrator/images/' );
		?>
		<td align="center"><?php echo $image; ?></td>
		<?php
	}

	/**
	* Writes a media_manager button
	* @param string The sub-drectory to upload the media to
	*/
	static public function media_manager( $directory = '', $alt = '' ) {
		global $database, $adminLanguage;
        
        if ($alt == '') { $alt = $adminLanguage->A_UPLOAD; }
		$sql = "SELECT template FROM #__templates_menu WHERE client_id='1' AND menuid='0'";
		$database->setQuery( $sql );
		$cur_template = $database->loadResult();
		$image = mosAdminMenus::ImageCheckAdmin( 'upload.png', '/administrator/images/', NULL, NULL, $adminLanguage->A_IMAGE_UPLOAD, 'uploadPic' );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'upload_f2.png', '/administrator/images/', NULL, NULL, $adminLanguage->A_IMAGE_UPLOAD, 'uploadPic', 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:void(0);" title="<?php echo $alt; ?>" onclick="popupWindow('popups/uploadimage.php?directory=<?php echo $directory; ?>&t=<?php echo $cur_template; ?>','win1',250,100,'no');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('uploadPic','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}

	/**
	* Writes a spacer cell
	* @param string The width for the cell
	*/
	static public function spacer( $width='' ) {
		if ($width != '') {
?>
		<td width="<?php echo $width; ?>">&nbsp;</td>
<?php
		} else {
?>
		<td>&nbsp;</td>
<?php
		}
	}

	/**
	* Writes the end of the menu bar table
	*/
	static public function endTable() {
		?>
		</tr>
		</table>
		<?php
	}

	/**
	* Writes a translate button for a given option
	* Translate operation leads to copy and translate selected item
	* @param string An override for the task
	* @param string An override for the alt text
	*/
	static public function translate( $task='translate', $alt='' ) {
        global $adminLanguage;
        
        if ($alt == '') { $alt = $adminLanguage->A_TRANSLATE; } //==> adminLanguage here //======> TO DO
        
		$image = mosAdminMenus::ImageCheckAdmin( 'translate.png', '/administrator/images/', NULL, NULL, $alt, $task );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'translate_f2.png', '/administrator/images/', NULL, NULL, $alt, $task, 0 );
		?>
		<td align="center">
		<a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('<?php echo $adminLanguage->A_TRMKSELECT; ?>'); } else { hideMainMenu(); submitbutton('<?php echo $task; ?>');}" title="<?php echo $alt; ?>" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('<?php echo $task; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php
	}


	/**
	* Writes a custom button that performs a javascript action on mouse click
	* @param string The javascript code to execute on mouse click
	* @param string The image to display
	* @param string The image to display when moused over
	* @param string The alt text for the icon image
	*/
	static public function onclick( $onclick='', $icon='', $iconOver='', $alt='') {
		if ($icon && $iconOver) {
		?>
            <td align="center">
                <a class="toolbar" href="javascript:void(0);" title="<?php echo $alt; ?>" onclick="<?php echo $onclick; ?>" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('<?php echo $alt; ?>','','images/<?php echo $iconOver; ?>',1);">
                    <img src="images/<?php echo $icon; ?>" border="0" align="middle" /><br />
                    <div><?php echo $alt; ?></div>
                </a>
            </td>
		<?php 
		} else {
		?>
            <td align="center">
                <a class="toolbar" href="javascript:void(0);" title="<?php echo $alt; ?>" onclick="<?php echo $onclick; ?>">
                    <br />
                    <div><?php echo $alt; ?></div>
                </a>
            </td>
		<?php 
		}
	}


	/*********************/
	/* ELXIS WIKI BUTTON */
	/*********************/
	static public function wiki($page='', $alt='') {
		$page = preg_replace('/^(\/)/', '', $page);
		if ($alt == '') {
			$alt = 'Elxis Wiki';
			if ($page != '') { $alt .= ' - '.str_replace('_', ' ', $page); }
		}

		$image = mosAdminMenus::ImageCheckAdmin('wiki.png', '/administrator/images/', NULL, NULL, $alt, $alt);
		$image2 = mosAdminMenus::ImageCheckAdmin('wiki_f2.png', '/administrator/images/', NULL, NULL, $alt, $alt, 0);
		?>

		<td align="center">
		<a class="toolbar" href="http://wiki.elxis.org/wiki/<?php echo $page; ?>" title="<?php echo $alt; ?>" target="_blank" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('<?php echo $alt; ?>','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div>Elxis Wiki</div>
		</a>
		</td>
<?php 
	}


	/***********************************/
	/* RETURNS THE HELP DIRECTORY PATH */
	/***********************************/
	static public function gethelppath() {
    	global $mosConfig_live_site, $alang, $mosConfig_absolute_path;

		if (file_exists($mosConfig_absolute_path.'/help/'.$alang. '/')) {
			$helpurl = $mosConfig_live_site.'/help/'.$alang.'/';
		} else {
			$helpurl = $mosConfig_live_site.'/help/english/';
		}
		return $helpurl;
	}

}

?>