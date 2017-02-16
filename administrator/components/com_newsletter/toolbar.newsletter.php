<?php 
/** 
* @version: 1.1
* @copyright: Copyright (C) 2008-2009 Is Open Source. All rights reserved.
* @package: Elxis
* @subpackage: Component NewsLetter
* @author: Ioannis Sannos (Is Open Source)
* @email: info@isopensource.com
* @link: http://www.isopensource.com
* @license: http://creativecommons.org/licenses/by-nc-sa/3.0/ Creative Commons Attribution 3.0
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $mainframe, $alang;

$nllangdir = $mainframe->getCfg('absolute_path').'/administrator/components/com_newsletter/language';
if (file_exists($nllangdir.'/'.$alang.'.php')) {
	require_once($nllangdir.'/'.$alang.'.php');
} else if (file_exists($nllangdir.'/'.$mainframe->getCfg('alang').'.php')) {
	require_once($nllangdir.'/'.$mainframe->getCfg('alang').'.php');
} else {
	require_once($nllangdir.'/english.php');
}
$iosnllang = new newsletterLang();
$GLOBALS['iosnllang'] = $iosnllang;

class iosnltoolbar  {


	static public function _EMPTY() {
	}

	static public function _EDIT() {
		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::endTable();
	}

	static public function _EDITNL() {
		mosMenuBar::startTable();
		mosMenuBar::save('savenl');
		mosMenuBar::spacer();
		mosMenuBar::cancel('cancelnl');
		mosMenuBar::endTable();
	}

	static public function _SUBS() {
		mosMenuBar::startTable();
		mosMenuBar::publish();
		mosMenuBar::spacer();
		mosMenuBar::unpublish();
		mosMenuBar::spacer();
		mosMenuBar::addNewX();
		mosMenuBar::spacer();
		mosMenuBar::editListX();
		mosMenuBar::spacer();
		mosMenuBar::deleteList();
		mosMenuBar::endTable();
	}

	static private function uploadIcon() {
		global $adminLanguage, $mainframe, $iosnllang;

		$image = mosAdminMenus::ImageCheckAdmin( 'upload.png', '/administrator/images/', NULL, NULL, $adminLanguage->A_IMAGE_UPLOAD, 'uploadFile' );
		$image2 = mosAdminMenus::ImageCheckAdmin( 'upload_f2.png', '/administrator/images/', NULL, NULL, $adminLanguage->A_IMAGE_UPLOAD, 'uploadFile', 0 );
		$alt = $iosnllang->UPLOADHTMLTEMP;
		$upURL = 'index3.php?option=com_newsletter&task=upload';
?>
		<td align="center">
		<a class="toolbar" href="javascript:void(0);" title="<?php echo $alt; ?>" onclick="popupWindow('<?php echo $upURL; ?>','win1',300,200,'no');" onmouseout="MM_swapImgRestore();"  onmouseover="MM_swapImage('uploadFile','','<?php echo $image2; ?>',1);">
		<?php echo $image; ?><br />
		<div><?php echo $alt; ?></div>
		</a>
		</td>
		<?php 
	}

	static public function _NLBACK() {
		mosMenuBar::startTable();
		mosMenuBar::back('', 'index2.php?option=com_newsletter&task=newsletters');
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	static public function _NLETTERS() {
		global $adminLanguage, $iosnllang;

		mosMenuBar::startTable();
		mosMenuBar::customX('copy', 'copy.png', 'copy_f2.png', $adminLanguage->A_COPY, true);
		mosMenuBar::spacer();
		mosMenuBar::customX('send', 'publish.png', 'publish_f2.png', $iosnllang->SENDNEWSLET, true);
		mosMenuBar::spacer();
		self::uploadIcon();
		mosMenuBar::spacer();
		mosMenuBar::addNewX('newnl');
		mosMenuBar::spacer();
		mosMenuBar::editListX('editnl');
		mosMenuBar::spacer();
		mosMenuBar::deleteList('', 'deletenl');
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}

	static public function _CONFIG() {
		mosMenuBar::startTable();
		mosMenuBar::save('saveconfig');
		mosMenuBar::spacer();
		mosMenuBar::cancel('cancelconfig');
		mosMenuBar::endTable();
	}

}

switch ($task) {
	case 'new':
	case 'edit':
	case 'editA':
		iosnltoolbar::_EDIT();
	break;
	case 'send':	
		iosnltoolbar::_NLBACK();
	break;
	case 'newsletters':
		iosnltoolbar::_NLETTERS();
	break;
	case 'newnl':
	case 'editnl':
	case 'editnlA':
		iosnltoolbar::_EDITNL();
	break;
	case 'config':
		iosnltoolbar::_CONFIG();
	break;
	case 'subscribers':
		iosnltoolbar::_SUBS();
	break;
	case 'export':
	case 'import':
	case 'doimport':
	case 'save':
	case 'remove':
	case 'publish':
	case 'unpublish':
	case 'copy':
	case 'upload':
	default:
		iosnltoolbar::_EMPTY();
	break;
}

unset($iosnllang);

?>