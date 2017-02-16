<?php 
/**
* @version: $Id: admin.languages.html.php 58 2010-06-13 09:34:15Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Languages
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_languages {

    /***********************************/
    /* HTML DISPLAY FRONTEND LANGUAGES */
    /***********************************/
	static public function showLanguages( &$rows, &$pageNav, $option, $pub_langs ) {
		global $my, $adminLanguage, $mosConfig_absolute_path, $mosConfig_live_site;
?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="langmanager">
            <?php echo $adminLanguage->A_MENU_LANG_MANAGE; ?> <span class="small">[ <?php echo $adminLanguage->A_SITE; ?> ]</span>
			</th>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20">&nbsp;</th>
			<th class="title"><?php echo $adminLanguage->A_LANGUAGE; ?></th>
			<th><?php echo $adminLanguage->A_CMP_LNG_FLAG; ?></th>
			<th><?php echo $adminLanguage->A_PUBLISHED; ?></th>
            <th><?php echo $adminLanguage->A_DEFAULT; ?></th>
			<th class="title"><?php echo $adminLanguage->A_VERSION; ?></th>
			<th class="title"><?php echo $adminLanguage->A_DATE; ?></th>
			<th class="title"><?php echo $adminLanguage->A_AUTHOR; ?></th>
			<th class="title"><?php echo $adminLanguage->A_AUTHMAIL; ?></th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = $rows[$i];
			?>
			<tr class="row<?php echo $k; ?>">
				<td align="center" style="text-align:center;"><?php echo $pageNav->rowNumber( $i ); ?></td>
				<td>
                    <input type="radio" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->language; ?>" onclick="isChecked(this.checked);" />
				</td>
				<td>
                    <a href="javascript:void(0);" onclick="hideMainMenu(); return listItemTask('cb<?php echo $i;?>','edit_source')" title="<?php echo $adminLanguage->A_CMP_LNG_EDSR; ?>">
                        <?php echo str_replace('_', ' ', $row->name); ?>
                    </a>
                </td>
                <td align="center" style="text-align:center;">
                <?php 
                if (file_exists($mosConfig_absolute_path.'/language/'.strtolower($row->name).'/'.strtolower($row->name).'.gif')) {
                    echo "<img src=\"".$mosConfig_live_site."/language/".strtolower($row->name)."/".strtolower($row->name).".gif\" alt=\"flag\" border=\"0\" />";
                }
                ?>
                </td>                
                <td align="center" style="text-align:center;">
				<?php
				if ($row->published == 1) {	 ?>
					<img src="images/tick.png" title="<?php echo $adminLanguage->A_CMP_LNG_PLNG; ?>" border="0" />
				<?php 
				} else {
				?>
					<img src="images/publish_x.png" title="<?php echo $adminLanguage->A_CMP_LNG_UNPLNG; ?>" border="0" />
				<?php
				}
				?>
				</td>
                <td align="center" style="text-align:center;">
				<?php 
				if ($row->defaultlang == 1) {
                ?>
					<img src="images/tick.png" title="<?php echo $adminLanguage->A_CMP_LNG_DEFLNG; ?>" border="0" />
				<?php 
				}
				?>
				</td>
				<td><?php echo $row->version; ?></td>
				<td><?php 
				if (checkDateTime($row->creationdate)) {
					echo mosFormatDate($row->creationdate, '%a, %d %b %Y');	
				} else {
					echo $row->creationdate; 
				}
				?></td>
				<td><?php echo $row->author; ?></td>
				<td><?php echo $row->authorEmail; ?></td>
			</tr>
		<?php
		}
		?>
		</table>

		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}


    /**********************************/
    /* HTML DISPLAY BACKEND LANGUAGES */
    /**********************************/
	static public function showaLanguages( &$rows, &$pageNav, $option ) {
		global $my, $adminLanguage, $mosConfig_absolute_path, $mosConfig_live_site;
		?>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="langmanager">
                <?php echo $adminLanguage->A_MENU_LANG_MANAGE; ?> 
                <span class="small">[ <?php echo $adminLanguage->A_ADMINISTRATOR; ?> ]</span>
			</th>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20">&nbsp;</th>
			<th class="title"><?php echo $adminLanguage->A_LANGUAGE; ?></th>
			<th><?php echo $adminLanguage->A_CMP_LNG_FLAG; ?></th>
			<th><?php echo $adminLanguage->A_DEFAULT; ?></th>
			<th class="title"><?php echo $adminLanguage->A_VERSION; ?></th>
			<th class="title"><?php echo $adminLanguage->A_DATE; ?></th>
			<th class="title"><?php echo $adminLanguage->A_AUTHOR; ?></th>
			<th class="title"><?php echo $adminLanguage->A_AUTHMAIL; ?></th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = $rows[$i];
			?>
			<tr class="row<?php echo $k; ?>">
				<td><?php echo $pageNav->rowNumber( $i ); ?></td>
				<td>
                    <input type="radio" id="cb<?php echo $i; ?>" name="cid[]" value="<?php echo $row->language; ?>" onclick="isChecked(this.checked);" />
				</td>
				<td><?php echo $row->name; ?></td>
                <td align="center" style="text-align:center;">
                <?php 
                if (file_exists($mosConfig_absolute_path.'/administrator/language/'.strtolower($row->name).'/'.strtolower($row->name).'.gif')) {
                    echo "<img src=\"".$mosConfig_live_site."/administrator/language/".strtolower($row->name)."/".strtolower($row->name).".gif\" border=\"0\" />";
                }
                ?>
                </td>
                <td align="center" style="text-align:center;">
				<?php 
				if ( $row->defaultlang == 1 ) { ?>
					<img src="images/tick.png" title="<?php echo $adminLanguage->A_CMP_LNG_DEFLNG; ?>" border="0" />
				<?php
				}
				?>
				</td>
				<td><?php echo $row->version; ?></td>
				<td><?php 
				if (checkDateTime($row->creationdate)) {
					echo mosFormatDate($row->creationdate, '%a, %d %b %Y');	
				} else {
					echo $row->creationdate; 
				}
				?></td>
				<td><?php echo $row->author; ?></td>
				<td><?php echo $row->authorEmail; ?></td>
			</tr>
		<?php
		}
		?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}


    /*****************************/
    /* HTML EDIT LANGUAGE SOURCE */
    /*****************************/
	static public function editLanguageSource( $language, &$content, $option ) {
		global $mosConfig_absolute_path, $adminLanguage;

		$language_path = $mosConfig_absolute_path.'/language/'.$language.'/'.$language.'.php';
?>
		<form action="index2.php" method="post" name="adminForm">
	    <table cellpadding="1" cellspacing="1" border="0" width="100%">
		<tr>
	        <td>
                <table class="adminheading">
                <tr>
                    <th class="langmanager"><?php echo $adminLanguage->A_CMP_LNG_EDITOR; ?></th>
                </tr>
                </table>
            </td>
	        <td>
	            <span class="componentheading"><?php echo $adminLanguage->A_CMP_LNG_THE; ?><?php echo $language; ?>.php <?php echo $adminLanguage->A_IS; ?> :
	            <b><?php echo is_writable($language_path) ? '<span style="color: green;"> '. $adminLanguage->A_WRITABLE .'</span>' : '<span style="color: red;"> '.$adminLanguage->A_UNWRITABLE.'</span>' ?></b>
	            </span>
	        </td>
<?php 
	        if (mosIsChmodable($language_path)) {
	            if (is_writable($language_path)) {
?>
                    <td>
                        <input type="checkbox" id="disable_write" name="disable_write" value="1" />
                        <label for="disable_write"><?php echo $adminLanguage->A_MKUNWRAFSV; ?></label>
                    </td>
<?php 
	            } else {
?>
                <td>
                    <input type="checkbox" id="enable_write" name="enable_write" value="1" />
                    <label for="enable_write"><?php echo $adminLanguage->A_MKOV_UNWRAFSV; ?></label>
                </td>
<?php 
	            }
	        }
?>
	    </tr>
	    </table>

		<table class="adminform">
	        <tr>
                <th><?php echo $language_path; ?></th>
            </tr>
	        <tr>
                <td>
                    <textarea style="width:100%" dir="ltr" cols="110" rows="25" name="filecontent" class="text_area"><?php echo $content; ?></textarea>
                </td>
            </tr>
		</table>
		<input type="hidden" name="language" value="<?php echo $language; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		</form>
	<?php
	}

}
?>