<?php 
/**
* @version: $Id: admin.installer.html.php 60 2010-06-13 09:46:43Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


function writableCell( $folder ) {
	global $adminLanguage, $mainframe;

	echo '<tr>'._LEND;
	echo '<td class="item">'.$folder.'/</td>'._LEND;
	echo '<td align="left">'._LEND;
	echo is_writable($mainframe->getCfg('absolute_path').SEP.$folder ) ? '<span style="font-weight: bold; color: green;">'.$adminLanguage->A_WRITABLE.'</span>' : '<span style="font-weight: bold; color: red;">'.$adminLanguage->A_UNWRITABLE.'</span>';
	echo '</td>'._LEND;
    echo '</tr>'._LEND;
}


class HTML_installer {

    /*******************************/
    /* HTML DISPLAY INSTALLER FORM */
    /*******************************/
	static public function showInstallForm( $title, $option, $element, $client='', $p_startdir='', $backLink='' ) {
		global $adminLanguage;
?>
        <script type="text/javascript">
        /* <![CDATA[ */
		function submitbutton3(pressbutton) {
			var form = document.adminForm_dir;
			if (form.userfile.value == ""){
				alert( "<?php echo $adminLanguage->A_CMP_INS_SDIR; ?>" );
			} else {
				form.submit();
			}
		}
		/* ]]> */
        </script>

		<form enctype="multipart/form-data" action="index2.php" method="post" name="filename">
		<table class="adminheading">
		<tr>
			<th class="install"><?php echo $title; ?></th>
			<td align="<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>" nowrap="nowrap"><?php echo $backLink; ?></td>
		</tr>
		</table>

		<table class="adminform">
		<tr>
			<th><?php echo $adminLanguage->A_CMP_INS_UPF; ?></th>
		</tr>
		<tr>
			<td align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>">
			<?php echo $adminLanguage->A_CMP_INS_PF; ?>:
			<input class="inputbox" name="userfile" type="file" size="70" /> 
			<input class="button" type="submit" value="<?php echo $adminLanguage->A_CMP_INS_UFI; ?>" />
			</td>
		</tr>
		</table>

		<input type="hidden" name="task" value="uploadfile" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="element" value="<?php echo $element; ?>" />
		<input type="hidden" name="client" value="<?php echo $client; ?>" />
		</form>
		<br /><br />

		<form enctype="multipart/form-data" action="index2.php" method="post" name="adminForm_dir">
		<table class="adminform">
		<tr>
			<th><?php echo $adminLanguage->A_CMP_INS_FDIR; ?></th>
		</tr>
		<tr>
			<td align="<?php echo (_GEM_RTL) ? 'right' : 'left'; ?>">
			<?php echo $adminLanguage->A_CMP_INS_IDIR; ?>:&nbsp;
			<input type="text" name="userfile" dir="ltr" class="inputbox" size="65" value="<?php echo $p_startdir; ?>" /> 
			<input type="button" class="button" value="<?php echo $adminLanguage->A_CMP_INS_DOIN; ?>" onclick="submitbutton3()" />
			</td>
		</tr>
		</table>

		<input type="hidden" name="task" value="installfromdir" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="element" value="<?php echo $element; ?>" />
		<input type="hidden" name="client" value="<?php echo $client; ?>" />
		</form>
<?php
	}


    /*****************************/
    /* DISPLAY INSTALLER MESSAGE */
    /*****************************/
	static public function showInstallMessage( $message, $title, $url, $notices=array() ) {
		global $adminLanguage, $_VERSION;

		$align = (_GEM_RTL) ? 'right' : 'left';
?>
		<table class="adminheading">
		<tr>
			<th class="install"><?php echo $title; ?></th>
		</tr>
		</table>

		<table class="adminform">
		<tr>
			<td align="left">
                <?php 
				if (is_array($message) && (count($message) > 0)) {
					foreach ($message as $msg) {
						echo $msg."<br />\n";
					}
				} else {
					echo $message;
				}
				?>
			</td>
		</tr>
        <?php 
            if (is_array($notices) && (count($notices) > 0)) {
                echo '<tr><td align="center">'._LEND;
                echo '<div style="width: 90%; background-color: #FEDFAF; margin: 10px; padding: 5px; border: 1px dashed #AAAAAA;">'._LEND;
                echo '<img src="images/32X32/important.png" border="0" alt="warning" align="'.$align.'" style="padding: 5px;" />'._LEND;
                echo '<span style="color: #B5140D; font-weight: bold; font-size: 1.2em;">';
                echo $_VERSION->PRODUCT.' '.$_VERSION->RELEASE.'.'.$_VERSION->DEV_LEVEL.' ['.$_VERSION->CODENAME.']</span><br />'._LEND;
                echo $adminLanguage->A_INST_INCOM.'<br />'._LEND;
                foreach ($notices as $notice) {
                    echo '<span style="padding-'.$align.': 45px; font-weight: bold;">&#149; '.$notice.'</span><br />'._LEND;
                }
                echo '</div>'._LEND;
                echo '</td></tr>'._LEND;
            }
        ?>
		<tr>
			<td align="center">
                <br />
                [ <a href="<?php echo $url; ?>" style="font-size: 1.3em; font-weight: bold;"><?php echo $adminLanguage->A_CMP_INS_CONT; ?></a> ]
			</td>
		</tr>
		</table>
<?php 
	}


    /*******************************************/
    /* HTML INSTALLED EXTENSIONS UPDATE STATUS */
    /*******************************************/
	static public function showUpdates($rows, $element, $client, $errormsg='') {
		global $adminLanguage, $fmanager, $mainframe;

		switch ($element) {
			case 'component': $title = $adminLanguage->A_CHK_UPDATES.' : '.$adminLanguage->A_MENU_COMPONENTS; break;
			case 'module': $title = $adminLanguage->A_CHK_UPDATES.' : '.$adminLanguage->A_MENU_MODULES; break;
			case 'mambot': $title = $adminLanguage->A_CHK_UPDATES.' : '.$adminLanguage->A_MENU_MAMBOTS; break;
			default: $title = $adminLanguage->A_CHK_UPDATES.' : '.$element; break;
		}
?>
		<table class="adminheading">
		<tr>
			<th class="install"><?php echo $title; ?></th>
		</tr>
		</table>
		<p style="background-color: #fbf9ca; border: 1px solid #eee96a; padding: 6px; margin: 10px 0; text-align: <?php echo (_GEM_RTL == 1) ? 'right' : 'left'; ?>; font-size: 13px;">
			<?php echo $adminLanguage->A_INST_EDCUPDESC; ?>
		</p>
		<table class="adminlist">
		<tr>
			<th width="60">&nbsp;</th>
			<th class="title"><?php echo $adminLanguage->A_TITLE; ?></th>
			<th class="title"><?php echo $adminLanguage->A_CATEGORY; ?></th>
			<th><?php echo $adminLanguage->A_VERSION; ?></th>
			<th><?php echo $adminLanguage->A_INST_INSTVERS; ?></th>
			<th><?php echo $adminLanguage->A_HITS; ?></th>
			<th><?php echo $adminLanguage->A_INST_DOWNLOADS; ?></th>
			<th class="title"><?php echo $adminLanguage->A_INST_SIZE; ?></th>
			<th class="title"><?php echo $adminLanguage->A_DATE; ?></th>
			<th><?php echo $adminLanguage->A_INST_DOWNLOAD; ?></th>
		</tr>

<?php 
		$k = 0;
		$downloadimg = $mainframe->getCfg('live_site').'/includes/js/ThemeOffice/backup.png';
		if ($rows && (count($rows) > 0)) {
			foreach ($rows as $row) {

			$version_check = false;
			$newer = false;
			if (($row['version'] != '') && ($row['install_version'] != '') && is_numeric($row['version']) && is_numeric($row['install_version'])) {
				$version_check = true;
				$newer = version_compare($row['version'], $row['install_version'], '>');
			}
?>
			<tr class="row<?php echo $k; ?>">
				<td width="60" align="center" style="text-align:center;">
<?php 
			$img = trim($row['image']);
			if (preg_match('/^(http)/i', trim($row['url']))) {
				echo '<a href="'.trim($row['url']).'" title="'.$row['title'].' - EDC" target="_blank">';
			}
			if ($img != '') {
				if (in_array($fmanager->fileExt($img), array('jpg', 'jpeg', 'png', 'gif'))) {
					echo '<img src="'.$img.'" alt="image" width="50" height="50" style="padding: 2px; border: 1px solid #999;" />';
				} else {
					echo '<img src="'.$mainframe->getCfg('live_site').'/administrator/images/software.png" alt="image" width="50" height="50" style="padding: 2px; border: 1px solid #999;" />';
				}
			} else {
				echo '<img src="'.$mainframe->getCfg('live_site').'/administrator/images/software.png" alt="image" width="50" height="50" style="padding: 2px; border: 1px solid #999;" />';
			}
			if (preg_match('/^(http)/i', trim($row['url']))) { echo "</a>\n"; }
?>
				</td>
				<td valign="top">
<?php 
				if (preg_match('/^(http)/i', trim($row['url']))) {
					echo '<a href="'.trim($row['url']).'" title="'.$row['title'].' - EDC" target="_blank" style="font-weight: bold;">'.$row['title']."</a><br />\n";
				} else {
					echo '<strong>'.$row['title']."</strong><br />\n";
				}
				echo $adminLanguage->A_AUTHOR.': '.$row['author']."<br />\n";
				echo $adminLanguage->A_INST_LICENSE.': '.trim(htmlspecialchars($row['license']))."<br />\n";
				echo $adminLanguage->A_INST_COMPAT.': '.trim(htmlspecialchars($row['compatibility']))."\n";
?>
				</td>
				<td><?php echo $row['category']; ?></td>
				<td align="center" style="text-align:center;">
					<?php echo ($row['version'] != '') ? '<strong>'.$row['version'].'</strong>' : $adminLanguage->A_UNKNOWN; ?>
				</td>
				<td align="center" style="text-align:center;"><?php 
				if ($version_check) {
					if ($newer) {
						echo '<span style="color: #FF0000; font-weight: bold;">'.$row['install_version'].'</span><br />';
						echo '<span style="color: #555;">'.$adminLanguage->A_INST_OUTDATED."</span>\n";
					} else {
						echo '<span style="color: green; font-weight: bold;">'.$row['install_version'].'</span><br />';
						echo '<span style="color: #555;">'.$adminLanguage->A_INST_UPTODATE."</span>\n";
					}
				} else {
					echo ($row['install_version'] != '') ? $row['install_version'] : $adminLanguage->A_UNKNOWN;
				}
				?>
				</td>
				<td style="text-align:center;"><?php echo intval($row['hits']); ?></td>
				<td style="text-align:center;"><?php echo intval($row['downloads']); ?></td>
				<td><?php echo $row['size']; ?></td>
				<td>
<?php 
			if (intval($row['lastmod']) > 10000) {
				echo eLOCALE::strftime_os('%a, %d %b %Y %H:%M', $row['lastmod'])."<br />\n";
			}
			 if (intval($row['timeadded']) > 10000) {
				echo '<span style="color: #777;">'.$adminLanguage->A_INST_DATESUB.':<br />';
				echo eLOCALE::strftime_os('%a, %d %b %Y %H:%M', $row['timeadded'])."</span>\n";
			}
?>
				</td>
				<td align="center" style="text-align:center;">
<?php 
			if (preg_match('/^(http)/i', $row['downloadlink'])) {
				echo '<a href="'.$row['downloadlink'].'" title="'.$adminLanguage->A_INST_DOWNLOAD.'" target="_blank"><img src="'.$downloadimg.'" border="0" alt="'.$adminLanguage->A_INST_DOWNLOAD.'" /></a>'."\n"; 
			}
?>
				</td>
			</tr>
<?php 
			$k = 1 - $k;
			}
		} else {
			echo '<tr class="rowX"><td colspan="10" style="font-size: 13px;"><br />'."\n";
			if ($errormsg != '') {
				echo '<span style="color: #FF0000; font-weight: bold;">'.$adminLanguage->A_ERROR."</span><br />\n";
				echo $errormsg;
			} else {
				if ($element == 'mambot') { $element = 'Bot'; }
				printf($adminLanguage->A_INST_EDCUPNOR, '<strong>'.$element.'</strong>');
			}
			echo "<br /><br /></td></tr>\n";
		}
?>
		</table><br /><br />
<?php 
	}

}

?>