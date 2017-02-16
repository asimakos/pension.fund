<?php 
/** 
* @version: $Id: error.php 39 2010-06-07 18:36:03Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: System Templates
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info [at] elxis [dot] org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

global $mosConfig_live_site, $mosConfig_sitename, $mosConfig_error_message;
$imgdir = $mosConfig_live_site.'/includes/systemplates/templates/images/';
?>

<div class="maincontainer">
	<div style="margin: 0; padding: 0;">
		<img src="<?php echo $imgdir; ?>/box_top.png" alt="top" border="0" />
	</div>
    <div class="maininner">
		<h1 class="error"><?php echo _ELX_ERROR; ?></h1>
		<p class="subtitle"><?php echo (_ELXIS_SYSALERT == 4) ? ELX_SYSTPL_ERRDBD : ELX_SYSTPL_ERRD; ?></p>
    	<p class="messagebox">
<?php 
    	if (defined('_ELXIS_SYSALERT_MSG')) {
    		echo _ELXIS_SYSALERT_MSG;
		} else if (_ELXIS_SYSALERT == 4) {
    		echo ELX_SYSTPL_ERRDB;
    	} else {
    		echo $mosConfig_error_message;
    	}

    	if (_ELXIS_SYSALERT == 4) { echo "\n<br /><br />".ELX_SYSTPL_ERRDB; }
?>
		</p>
		<div style="clear: both;"></div>
		<div class="signature">
			<a href="<?php echo $mosConfig_live_site; ?>" title="<?php echo $mosConfig_sitename; ?>"><?php echo $mosConfig_sitename; ?></a>
		</div>
    </div>
	<div style="margin: 0; padding: 0;">
		<img src="<?php echo $imgdir; ?>/box_bottom.png" alt="bottom" border="0" />
	</div>
</div>