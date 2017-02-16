<?php 
/**
* @version: $Id: module.html.php 2268 2009-02-12 19:59:28Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Installer
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: Modules Installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_module {

	static public function showInstalledModules( &$rows, $option, &$xmlfile, &$lists ) {
        global $adminLanguage;

        mosCommonHTML::loadOverlib();
?>
			<form action="index2.php" method="post" name="adminForm">
			<table class="adminheading">
			<tr>
				<th class="install"><?php echo $adminLanguage->A_CMP_INST_IMDL; ?></th>
				<td nowrap="nowrap"><?php echo $adminLanguage->A_FILTER; ?>:</td>
				<td align="<?php echo (_GEM_RTL) ? 'left': 'right'; ?>"><?php echo $lists['filter']; ?></td>
			</tr>
			<tr>
				<td colspan="3">
				    <?php echo $adminLanguage->A_CMP_INST_OMDL; ?><br /><br />
				</td>
			</tr>
			</table>

			<table class="adminlist">
			<tr>
				<th class="title"><?php echo $adminLanguage->A_CMP_INST_MDLF; ?></th>
				<th class="title"><?php echo $adminLanguage->A_CLIENT; ?></th>
				<th class="title"><?php echo $adminLanguage->A_AUTHOR; ?></th>
				<th class="title"><?php echo $adminLanguage->A_VERSION; ?></th>
				<th class="title"><?php echo $adminLanguage->A_DATE; ?></th>
				<th class="title"><?php echo $adminLanguage->A_AUTHMAIL; ?></th>
				<th class="title"><?php echo $adminLanguage->A_CMP_INST_AUURL; ?></th>
			</tr>
		<?php 
		if (count($rows)) {
			$rc = 0;
			for ($i = 0, $n = count( $rows ); $i < $n; $i++) {
				$row = $rows[$i];

                ?>
				<tr class="row<?php echo $rc; ?>">
					<td>
                        <input type="radio" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onclick="isChecked(this.checked);" />
                        <?php echo HTML_module::checkPackVersion($row->module, $row->elxisversion); ?>
                    </td>
					<td>
                        <?php echo $row->client_id == "0" ? $adminLanguage->A_SITE : $adminLanguage->A_ADMINISTRATOR; ?>
					</td>
					<td><?php echo @$row->author != "" ? $row->author : "&nbsp;"; ?></td>
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
		} else {
?>
			<tr class="row0"><td colspan="7" align="center"><?php echo $adminLanguage->A_CMP_INST_NMDL; ?></td></tr>
<?php
		}
?>
		</table>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="option" value="com_installer" />
		<input type="hidden" name="element" value="module" />
		</form>
<?php
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