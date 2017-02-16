<?php 
/**
* @version: $Id: toolbar.poll.html.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Poll
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class TOOLBAR_poll {
	/**
	* Draws the menu for a New category
	*/
	static public function _NEW() {
		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.polls.edit' );
		mosMenuBar::endTable();
	}
	/**
	* Draws the menu for Editing an existing category
	*/
	static public function _EDIT( $pollid, $cur_template ) {
		global $database, $adminLanguage;
		global $id;

		$sql = "SELECT template FROM #__templates_menu WHERE client_id='0' AND menuid='0'";
		$database->setQuery( $sql );
		$cur_template = $database->loadResult();
		mosMenuBar::startTable();
		$popup='pollwindow';
    	?>
		<td align="center">
        <a class="toolbar" href="javascript:;" onclick="window.open('popups/<?php echo $popup; ?>.php?pollid=<?php echo $pollid; ?>&t=<?php echo $cur_template; ?>', 'win1', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('preview','','images/preview_f2.png',1);">
        <img src="images/preview.png" alt="<?php echo $adminLanguage->A_PREVIEW; ?>" border="0" name="Preview" align="middle" /><br>
        <div><?php echo $adminLanguage->A_PREVIEW; ?></div>
        </a>
        </td>
	    <?php
		mosMenuBar::spacer();
	    mosMenuBar::save();
		mosMenuBar::spacer();
		if ( $id ) {
			// for existing content items the button is renamed `close`
			mosMenuBar::cancel( 'cancel', $adminLanguage->A_CLOSE );
		} else {
			mosMenuBar::cancel();
		}
		mosMenuBar::spacer();
	    mosMenuBar::help( 'elxis.polls.edit' );
	    mosMenuBar::endTable();
	}
	static public function _DEFAULT() {
		mosMenuBar::startTable();
		mosMenuBar::publishList();
		mosMenuBar::spacer();
		mosMenuBar::unpublishList();
		mosMenuBar::spacer();
		mosMenuBar::addNewX();
		mosMenuBar::spacer();
		mosMenuBar::editListX();
		mosMenuBar::spacer();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
		mosMenuBar::help( 'elxis.polls' );
                mosMenuBar::spacer();
                mosMenuBar::wiki( 'Poll_Manager_Component' );
		mosMenuBar::endTable();
	}
}
?>
