<?php 
/**
* @version: $Id: mambot.html.php 2268 2009-02-12 19:59:28Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Bots Installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_mambot {

    /****************************/
    /* SHOW INSTALLED BOTS HTML */
    /****************************/
	static public function showInstalledMambots( &$rows, $option ) {
        global $adminLanguage;

        mosCommonHTML::loadOverlib();
?>
		<table class="adminheading">
		<tr>
			<th class="install"><?php echo $adminLanguage->A_CMP_INST_IMBT; ?></th>
		</tr>
		<tr>
			<td><?php echo $adminLanguage->A_CMP_INST_OMBT; ?><br /><br /></td>
		</tr>
		</table>

		<?php
		if ( count( $rows ) ) { ?>
			<form action="index2.php" method="post" name="adminForm">
			<table class="adminlist">
			<tr>
				<th class="title"><?php echo $adminLanguage->A_CMP_INST_MBT; ?></th>
				<th class="title"><?php echo $adminLanguage->A_CMP_INST_MTYP; ?></th>
				<th class="title"><?php echo $adminLanguage->A_AUTHOR; ?></th>
				<th class="title"><?php echo $adminLanguage->A_VERSION; ?></th>
				<th class="title"><?php echo $adminLanguage->A_DATE; ?></th>
				<th class="title"><?php echo $adminLanguage->A_AUTHMAIL; ?></th>
				<th class="title"><?php echo $adminLanguage->A_CMP_INST_AUURL; ?></th>
			</tr>
			<?php
			$rc = 0;
			$n = count( $rows );
			for ($i = 0; $i < $n; $i++) {
			    $row =& $rows[$i];
				?>
				<tr class="row<?php echo $rc; ?>">
					<td>
                        <input type="radio" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" />
                        <?php echo HTML_mambot::checkPackVersion($row->name, $row->elxisversion); ?>
					</td>
					<td><?php echo $row->folder; ?></td>
					<td><?php echo $row->author; ?></td>
					<td><?php echo $row->version; ?></td>
					<td><?php 
					if (checkDateTime($row->creationdate)) {
						echo mosFormatDate($row->creationdate, '%a, %d %b %Y');	
					} else {
						echo $row->creationdate; 
					}
					?></td>
					<td><?php echo $row->authorEmail; ?></td>
					<td>
                        <?php 
                        if (@$row->authorUrl != '') {
                            $link =  (preg_match('#^(http\:\/\/)#', $row->authorUrl)) ? $row->authorUrl : 'http://'.$row->authorUrl;
                            $link2 = (strlen($row->authorUrl) > 25) ? substr($row->authorUrl, 0, 22).'...' : $row->authorUrl;
                            echo '<a href="'.$link.'" target="_blank" title="'.$link.'">'.$link2.'</a>'._LEND;
                        }
                        ?>
					</td>
				</tr>
				<?php
				$rc = 1 - $rc;
			}
			?>
			</table>

			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
			<input type="hidden" name="option" value="com_installer" />
			<input type="hidden" name="element" value="mambot" />
			</form>
			<?php
		} else {
			echo $adminLanguage->A_CMP_INST_NMBT;
		}
	}


    /*******************/
    /* VERSION CHECKER */
    /*******************/
    static private function checkPackVersion($name, $packversion = 0) {
        global $_VERSION, $adminLanguage;

        $msg = '';
        if ($_VERSION->PRODUCT != 'E'.'l'.'x'.'i'.'s') { die(); }
        if ($packversion) {
            if ($packversion < 4) {
                $msg = $adminLanguage->A_INST_INCOMJOO;
            } else if ($packversion < 2006) {
                $msg = $adminLanguage->A_INST_INCOMMAM;
			} else if ($packversion < 2008) {
             	$msg = sprintf($adminLanguage->A_INST_OLDER, $packversion, $_VERSION->RELEASE.'.'.$_VERSION->DEV_LEVEL);
            } else if (($_VERSION->RELEASE > 2009) && ($packversion < $_VERSION->RELEASE)) {
                $msg = sprintf($adminLanguage->A_INST_OLDER, $packversion, $_VERSION->RELEASE.'.'.$_VERSION->DEV_LEVEL);
            } else if ($packversion > $_VERSION->RELEASE) {
                $msg = sprintf($adminLanguage->A_INST_NEWER, $packversion, $_VERSION->RELEASE.'.'.$_VERSION->DEV_LEVEL);
            }
        }
        if ($msg != '') {
            return mosWarning($msg).' <span style="font-weight: bold; color: #B5110A;">'.$name.'</span>';
        } else {
            return '<span style="font-weight: bold;">'.$name.'</span>';
        }
    }

}
?>