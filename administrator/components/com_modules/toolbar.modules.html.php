<?php 
/**
* @version: $Id: toolbar.modules.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Modules
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_modules {
	/**
	* Draws the menu for a New module
	*/
	static public function _NEW()	{
		mosMenuBar::startTable();
		mosMenuBar::preview( 'modulewindow' );
		mosMenuBar::spacer();
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::apply();
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.modules.new' );
		mosMenuBar::endTable();
	}

	/**
	* Draws the menu for Editing an existing module
	*/
	static public function _EDIT( $cur_template, $publish ) {
		global $id, $adminLanguage;

		mosMenuBar::startTable();
		?>
			<td align="center"><a class="toolbar" href="javascript:void(0);" title="<?php echo $adminLanguage->A_PREVIEW; ?>" onclick="if (typeof document.adminForm.content == 'undefined') { alert('<?php echo $adminLanguage->A_CMP_MDL_PRTYPED; ?>.'); } else { var content = document.adminForm.content.value; content = content.replace('#', '');  var title = document.adminForm.title.value; title = title.replace('#', ''); window.open('popups/modulewindow.php?title=' + title + '&content=' + content + '&t=<?php echo $cur_template; ?>', 'win1', 'status=no,toolbar=no,scrollbars=auto,titlebar=no,menubar=no,resizable=yes,width=200,height=400,directories=no,location=no'); }" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('preview','','images/preview_f2.png',1);">
            <img src="images/preview.png" alt="<?php echo $adminLanguage->A_PREVIEW; ?>" border="0" name="preview" align="middle" /><br />
            <div><?php echo $adminLanguage->A_PREVIEW; ?></div>
            </a></td>
		<?php
		mosMenuBar::spacer();
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::apply();
		mosMenuBar::spacer();
		if ( $id ) {
			// for existing content items the button is renamed `close`
			mosMenuBar::cancel( 'cancel', $adminLanguage->A_CLOSE );
		} else {
			mosMenuBar::cancel();
		}
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.modules.edit' );
		mosMenuBar::endTable();
	}

	static public function _DEFAULT() {
	   global $adminLanguage;

		mosMenuBar::startTable();
		mosMenuBar::publishList();
		mosMenuBar::spacer();
		mosMenuBar::unpublishList();
		mosMenuBar::spacer();
		mosMenuBar::custom( 'copy', 'copy.png', 'copy_f2.png', $adminLanguage->A_COPY, true );
		mosMenuBar::spacer();
		mosMenuBar::addNewX();
		mosMenuBar::spacer();
		mosMenuBar::editListX();
		mosMenuBar::spacer();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.modules.main' );
		mosMenuBar::endTable();
	}
}
?>
