<?php 
/**
* @version: $Id: admin.templates.html.php 56 2010-06-13 09:19:34Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Templates
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_templates {

	/**************************/
	/* HTML DISPLAY TEMPLATES */
	/**************************/
	static public function showTemplates( &$rows, &$pageNav, $option, $client ) {
		global $my, $mainframe, $adminLanguage;

		if ( isset( $row->authorUrl) && $row->authorUrl != '' ) {
			$row->authorUrl = str_replace( 'http://', '', $row->authorUrl );
		}

		mosCommonHTML::loadOverlib();

		switch ( $client ) {
			case 'admin':
			$srcpath = $mainframe->getCfg('live_site').'/administrator/templates/admin';
			$ititle = $adminLanguage->A_ADMINISTRATOR;
			break;
			case 'login':
			$srcpath = $mainframe->getCfg('live_site').'/administrator/templates/login';
			$ititle = $adminLanguage->A_MENU_LOGIN_SCREENS;
			break;
			default:
			$srcpath = $mainframe->getCfg('live_site').'/templates';
			$ititle = $adminLanguage->A_SITE;	
			break;
		}
?>
		<script type="text/javascript">
		/* <![CDATA[ */
		function showInfo(name) {
			var pattern = /\b \b/ig;
			name = name.replace(pattern,'_');
			name = name.toLowerCase();
			if (document.adminForm.doPreview.checked) {
				var src = '<?php echo $srcpath; ?>/'+name+'/template_thumbnail.png';
				var html=name;
				html = '<img border="1" src="'+src+'" name="imagelib" alt="<?php echo $adminLanguage->A_CMP_TMP_NOPREVIEW; ?>" width="206" height="145" />';
				return overlib(html, CAPTION, name, <?php echo (_GEM_RTL) ? 'LEFT' : 'RIGHT'; ?>)
			} else {
				return false;
			}
		}
		/* ]]> */
		</script>

		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="templates">
                <?php echo $adminLanguage->A_TEMPLATES; ?> <span class="small">[ <?php echo $ititle; ?> ]</span>
			</th>
			<td align="<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>" nowrap="nowrap">
                <?php echo $adminLanguage->A_CMP_TMP_PREVIEW; ?> 
                <input type="checkbox" name="doPreview" checked="checked" />
			</td>
		</tr>
		</table>
		<table class="adminlist">
		<tr>
			<th width="20"><?php echo $adminLanguage->A_NB; ?></th>
			<th width="20">&nbsp;</th>
			<th class="title"><?php echo $adminLanguage->A_NAME; ?></th>
			<?php
			if (( $client == 'admin' ) || ( $client == 'login' )) {
				?>
				<th><?php echo $adminLanguage->A_DEFAULT; ?></th>
				<?php
			} else {
				?>
				<th><?php echo $adminLanguage->A_DEFAULT; ?></th>
				<th><?php echo $adminLanguage->A_ASSIGNED; ?></th>
				<?php
			}
			?>
			<th class="title"><?php echo $adminLanguage->A_AUTHOR; ?></th>
			<th class="title"><?php echo $adminLanguage->A_VERSION; ?></th>
			<th class="title"><?php echo $adminLanguage->A_DATE; ?></th>
			<th class="title"><?php echo $adminLanguage->A_CMP_TMP_AUTHURL; ?></th>
		</tr>
		<?php
		$k = 0;
		for ( $i=0, $n = count( $rows ); $i < $n; $i++ ) {
			$row = &$rows[$i];
			?>
			<tr class="row<?php echo $k; ?>">
				<td><?php echo $pageNav->rowNumber( $i ); ?></td>
				<td>
				<?php
				if ( $row->checked_out && $row->checked_out != $my->id ) {
				?> 
					&nbsp;
				<?php 
				} else {
				?>
					<input type="radio" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->directory; ?>" onclick="isChecked(this.checked);" />
				<?php 
				}
				?>
				</td>
				<td>
                    <a href="index2.php?option=<?php echo $option; ?>&amp;task=edit_paramsa&amp;tpldir=<?php echo $row->directory; ?>&amp;client=<?php echo $client; ?>&amp;hidemainmenu=1" onmouseover="showInfo('<?php echo $row->name; ?>')" onmouseout="return nd();">
                        <?php echo $row->name; ?>
                    </a>
				</td>
				<?php
			    if (( $client == 'admin' ) || ( $client == 'login' )) {
					?>
					<td align="center" style="text-align:center;">
					<?php 
					if ( $row->published == 1 ) {
                        echo '<img src="images/tick.png" alt="'.$adminLanguage->A_PUBLISHED.'" />'._LEND;
                    }
					?>
					</td>
					<?php
				} else {
					?>
					<td align="center" style="text-align:center;">
					<?php
					if ( $row->published == 1 ) {
                        echo '<img src="images/tick.png" alt="'.$adminLanguage->A_DEFAULT.'" />'._LEND;
                    }
					?>
					</td>
					<td align="center" style="text-align:center;">
					<?php
					if ( $row->assigned == 1 ) {
                        echo '<img src="images/tick.png" alt="'.$adminLanguage->A_ASSIGNED.'" />'._LEND;
                    }
					?>
					</td>
					<?php
				}
				?>
				<td>
                    <?php echo $row->authorEmail ? '<a href="mailto:'.$row->authorEmail.'" title="'.$row->authorEmail.'">'.$row->author.'</a>' : $row->author; ?>
				</td>
				<td><?php echo $row->version; ?></td>
				<td><?php 
				if (checkDateTime($row->creationdate)) {
					echo mosFormatDate($row->creationdate, '%a, %d %b %Y');	
				} else {
					echo $row->creationdate; 
				}
				?></td>
				<td>
                    <a href="<?php echo substr( $row->authorUrl, 0, 7) == 'http://' ? $row->authorUrl : 'http://'.$row->authorUrl; ?>" target="_blank">
                        <?php echo $row->authorUrl; ?>
                    </a>
				</td>
			</tr>
			<?php
		}
		?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0" />
		<input type="hidden" name="client" value="<?php echo $client; ?>" />
		</form>
		<?php
	}


	/*****************************/
	/* HTML EDIT TEMPLATE SOURCE */
	/*****************************/
	static public function editTemplateSource( $template, &$content, $option, $client ) {
		global $mainframe, $adminLanguage;
		
		switch ( $client ) {
			case 'admin':
			$template_path = $mainframe->getCfg('absolute_path').'/administrator/templates/admin/'.$template.'/index.php';
			break;
			case 'login':
			$template_path = $mainframe->getCfg('absolute_path').'/administrator/templates/login/'.$template.'/index.php';
			break;
			default:
			$template_path = $mainframe->getCfg('absolute_path').'/templates/'.$template.'/index.php';
			break;
		}
?>
		<form action="index2.php" method="post" name="adminForm">
	    <table cellpadding="1" cellspacing="1" border="0" width="100%">
		<tr>
	        <td>
                <table class="adminheading">
                <tr>
                    <th class="templates"><?php echo $adminLanguage->A_CMP_TMP_EDITOR; ?></th>
                </tr>
                </table>
            </td>
	        <td width="220">
	            <span class="componentheading">index.php <?php echo $adminLanguage->A_CMP_TMP_IS; ?> : 
	            <?php echo is_writable($template_path) ? '<span style="font-weight: bold; color: green;">'.$adminLanguage->A_WRITABLE.'</span>' : '<span style="font-weight: bold; color: red;">'.$adminLanguage->A_UNWRITABLE.'</span>'; ?>
	            </span>
	        </td>
<?php
	        if (mosIsChmodable($template_path)) {
	            if (is_writable($template_path)) {
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
	        <tr><th><?php echo $template_path; ?></th></tr>
	        <tr><td><textarea style="width: 95%; height: 500px;" cols="110" rows="25" name="filecontent" dir="ltr" class="text_area"><?php echo $content; ?></textarea></td></tr>
		</table>
		<input type="hidden" name="template" value="<?php echo $template; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="client" value="<?php echo $client; ?>" />
		</form>
		<?php
	}


	/*****************************/
	/* HTML EDIT TEMPLATE SOURCE */
	/*****************************/
	static public function editCSSSource($template, $content, $option, $client, $cssfile='template_css.css', $cssfiles=array()) {
		global $mainframe, $adminLanguage;

		switch ($client) {
			case 'admin':
			$css_path = $mainframe->getCfg('absolute_path').'/administrator/templates/admin/'.$template.'/css/'.$cssfile;
			break;
			case 'login':
			$css_path = $mainframe->getCfg('absolute_path').'/administrator/templates/login/'.$template.'/css/'.$cssfile;
			break;
			default:
			$css_path = $mainframe->getCfg('absolute_path').'/templates/'.$template.'/css/'.$cssfile;
			break;
		}
?>
		<form action="index3.php" method="post" name="adminForm">
	    <table cellpadding="1" cellspacing="1" border="0" width="100%">
		<tr>
	        <td>
                <table class="adminheading">
                <tr>
                    <th class="templates"><?php echo $adminLanguage->A_CMP_TMP_CSSEDTR; ?></th>
                </tr>
                </table>
            </td>
	        <td width="260">
	            <span class="componentheading"><?php echo $cssfile; ?> <?php echo $adminLanguage->A_CMP_TMP_IS; ?> : 
	            <?php echo is_writable($css_path) ? '<span style="font-weight: bold; color: green;">'.$adminLanguage->A_WRITABLE.'</span>' : '<span style="font-weight: bold; color: red;">'.$adminLanguage->A_UNWRITABLE.'</span>'; ?>
	            </span>
	        </td>
<?php
			$colspan = 2;
	        if (mosIsChmodable($css_path)) {
	        	$colspan = 3;
	            if (is_writable($css_path)) {
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

<?php 
if ($cssfiles && (count($cssfiles) > 1)) { ?>
	    <tr>
			<td colspan="<?php echo $colspan; ?>" style="padding: 5px 0;">
			<?php 
			echo $adminLanguage->A_FILE.' ';
			foreach ($cssfiles as $cssf) {
				if ($cssf != $cssfile) {
					$link = 'index2.php?option=com_templates&amp;task=edit_css&amp;template='.$template.'&amp;hidemainmenu=1&amp;client='.$client.'&amp;cssfile='.base64_encode($cssf);
					echo '<a href="'.$link.'" title="'.$adminLanguage->A_EDIT.'" style="margin: 0 5px;">'.$cssf.'</a>'._LEND;
				}
			}
			?>
			</td>
		</tr>
<?php } ?>
	    </table>
		<table class="adminform">
	        <tr><th><?php echo $css_path; ?></th></tr>
	        <tr><td><textarea style="width: 95%; height: 500px;" cols="110" rows="25" name="filecontent" dir="ltr" class="text_area"><?php echo $content; ?></textarea></td></tr>
		</table>
		<input type="hidden" name="template" value="<?php echo $template; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="client" value="<?php echo $client; ?>" />
		<input type="hidden" name="cssfile" value="<?php echo $cssfile; ?>" />
		</form>
		<?php
	}


	/*********************************/
	/* HTML EDIT TEMPLATE PARAMETERS */
	/*********************************/
	static public function editParamsHTML($template, $option, $client, $row, $params) {
		global $mainframe, $adminLanguage;

		mosCommonHTML::loadOverlib();	
?>
		<form action="index3.php" method="post" name="adminForm">
        <table class="adminheading">
        <tr>
            <th class="templates"><?php echo $adminLanguage->A_TEMPLATES.' : '.$row->name; ?></th>
        </tr>
        </table>
		<table class="adminform">
			<tr>
				<th><?php echo $adminLanguage->A_DETAILS; ?></th>
				<th><?php echo $adminLanguage->A_PARAMETERS; ?></th>
			</tr>
			<tr>
				<td valign="top" width="50%">
				<table class="adminlist">
				<tr class="row0">
					<td width="150"><?php echo $adminLanguage->A_TITLE; ?>:</td>
					<td><strong><?php echo $row->name; ?></strong></td>
				</tr>
				<tr class="row1">
					<td width="150"><?php echo $adminLanguage->A_TYPE; ?>:</td>
					<td><?php 
					switch ($client) {
						case 'admin': echo $adminLanguage->A_MENU_ADMIN_TEMP; break;
						case 'login': echo $adminLanguage->A_MENU_LOGIN_SCREENS; break;
						default: echo $adminLanguage->A_MENU_SITE_TEMP; break;
					}
					?></td>
				</tr>
				<tr class="row0">
					<td width="150"><?php echo $adminLanguage->A_AUTHOR; ?>:</td>
					<td><?php echo $row->author; ?></td>
				</tr>
				<tr class="row1">
					<td><?php echo $adminLanguage->A_URL; ?>:</td>
					<td><?php 
					if ((trim($row->authorUrl) != '') && preg_match('/^(http)/i', $row->authorUrl)) {
						echo '<a href="'.$row->authorUrl.'" target="_blank">'.$row->authorUrl.'</a>';
					} else {
						echo $row->authorUrl; 
					}
					?></td>
				</tr>
				<tr class="row0">
					<td><?php echo $adminLanguage->A_EMAIL; ?>:</td>
					<td><?php echo $row->authorEmail; ?></td>
				</tr>
				<tr class="row1">
					<td><?php echo $adminLanguage->	A_VERSION; ?>:</td>
					<td><?php echo $row->version; ?></td>
				</tr>
				<tr class="row0">
					<td><?php echo $adminLanguage->A_DATE; ?>:</td>
					<td><?php 
					if (checkDateTime($row->creationDate)) {
						echo mosFormatDate($row->creationDate, '%a, %d %b %Y');	
					} else {
						echo $row->creationDate; 
					}
					?></td>
				</tr>
				<tr class="row1">
					<td>License:</td>
					<td><?php echo $row->license; ?></td>
				</tr>
				<tr class="row0">
					<td>Copyright:</td>
					<td><?php echo $row->copyright; ?></td>
				</tr>
				<tr class="row1">
					<td><?php echo $adminLanguage->A_DESCRIPTION; ?>:</td>
					<td><?php echo $row->description; ?></td>
				</tr>
				</table>
				</td>
				<td valign="top">
					<?php echo $params->render(); ?>
				</td>
			</tr>
		</table>
		<input type="hidden" name="template" value="<?php echo $template; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="client" value="<?php echo $client; ?>" />
		</form>
<?php 
	}


	/************************/
	/* HTML ASSIGN TEMPLATE */
	/************************/
	static public function assignTemplate( $template, &$menulist, $option ) {
		global $adminLanguage;
?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminform">
		<tr>
			<th class="title" colspan="2">
                <?php echo $adminLanguage->A_CMP_TMP_ASSTP.' '.$template.' '.$adminLanguage->A_CMP_TMP_TOMENU; ?>
			</th>
		</tr>
		<tr>
			<td valign="top" nowrap="nowrap">
                <?php echo $adminLanguage->A_CMP_TMP_PAGES; ?>:
			</td>
			<td>
                <?php echo $menulist; ?>
			</td>
		</tr>
		</table>
		<input type="hidden" name="template" value="<?php echo $template; ?>" />
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		</form>
		<?php
	}


	/********************************/
	/* HTML EDIT TEMPLATE POSITIONS */
	/********************************/
	static public function editPositions( &$positions ) {
		global $adminLanguage;

        $rows = 25;
		$cols = 2;
		$n = $rows * $cols;
?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th class="templates"><?php echo $adminLanguage->A_MENU_MODUL_POS; ?></th>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
		<?php
		for ( $c = 0; $c < $cols; $c++ ) {
		?>
			<th width="25"><?php echo $adminLanguage->A_NB; ?></th>
			<th class="title"><?php echo $adminLanguage->A_POSITION; ?></th>
			<th class="title"><?php echo $adminLanguage->A_DESCRIPTION; ?></th>
		<?php 
		}
		?>
		</tr>
		<?php
		$i = 1;
		for ( $r = 0; $r < $rows; $r++ ) {
		?>
			<tr>
			<?php 
			for ( $c = 0; $c < $cols; $c++ ) {
			?>
				<td>(<?php echo $i; ?>)</td>
				<td>
                    <input type="text" name="position[<?php echo $i; ?>]" value="<?php echo @$positions[$i-1]->position; ?>" dir="ltr" size="10" maxlength="10" />
				</td>
				<td>
                    <input type="text" name="description[<?php echo $i; ?>]" value="<?php echo htmlspecialchars( @$positions[$i-1]->description ); ?>" size="50" maxlength="255" />
				</td>
			<?php
				$i++;
			}
			?>
			</tr>
		<?php 
		}
		?>
		</table>
		<input type="hidden" name="option" value="com_templates" />
		<input type="hidden" name="task" value="" />
		</form>
		<?php
	}
}

?>