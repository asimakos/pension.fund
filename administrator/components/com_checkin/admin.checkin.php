<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Checkin
* @author: Elxis Team
* @link: http://www.elxis.org/
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!$acl->acl_check( 'administration', 'config', 'users', $my->usertype )) {
	mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
}

?>
<table class="adminheading">
	<tr>
		<th class="checkin"><?php echo $adminLanguage->A_COMP_CHECK_TITLE; ?></th>
	</tr>
</table>

<table class="adminform">
<tr>
	<th class="title"><?php echo $adminLanguage->A_COMP_CHECK_DB_T; ?></th>
	<th class="title"><?php echo $adminLanguage->A_COMP_CHECK_NB_ITEMS; ?></th>
	<th class="title"><?php echo $adminLanguage->A_COMP_CHECK_IN; ?></th>
</tr>
<?php
$k = 0;
foreach ($database->_resource->MetaTables() as $tn) {
	if (!preg_match( "/^".$mainframe->getCfg('dbprefix')."/i", $tn )) {
		continue;
	}
	$lf = $database->_resource->MetaColumnNames($tn);
	$nf = sizeof($lf);

	$foundCO = false;
	$foundCOT = false;
	$foundE = false;

	foreach ($lf as $fname) {
		if (strtolower($fname) == 'checked_out') {
			$foundCO = true;
		} else if (strtolower($fname) == 'checked_out_time') {
			$foundCOT = true;
		} else if (strtolower($fname) == 'editor') {
			$foundE = true;
		}
	}
    
	if ($foundCO && $foundCOT) {
		if ($foundE) {
			$database->setQuery( "SELECT checked_out, editor FROM ".$tn." WHERE checked_out > 0" );
		} else {
			$database->setQuery( "SELECT checked_out FROM ".$tn." WHERE checked_out > 0" );
		}
		$res = $database->query();
		$num = $database->getNumRows( $res );

		$chktime = date('Y-m-d H:i:s');		
		if ($foundE) {
			$database->setQuery( "UPDATE ".$tn." SET checked_out=0, checked_out_time='".$chktime."', editor=NULL WHERE checked_out > 0" );
		} else {
			$database->setQuery( "UPDATE ".$tn." SET checked_out=0, checked_out_time='".$chktime."' WHERE checked_out > 0" );
		}
		$res = $database->query();

		if ($res) {
			if ($num > 0) {
				echo '<tr class=row'.$k.'">'._LEND;
				echo '<td>'.$adminLanguage->A_COMP_CHECK_TABLE.' - '.$tn.'</td>'._LEND;
				echo '<td>'.$adminLanguage->A_COMP_CHECK_IN.' <strong>'.$num.'</strong> '.$adminLanguage->A_ITEMS.'</td>'._LEND;
				echo '<td align="center"><img src="images/tick.png" border="0" alt="tick" /></td>'._LEND;
				echo '</tr>'._LEND;
			} else {
				echo '<tr class="row'.$k.'">'._LEND;
				echo '<td>'.$adminLanguage->A_COMP_CHECK_TABLE.' - '.$tn.'</td>'._LEND;
				echo '<td>'.$adminLanguage->A_COMP_CHECK_IN.' <strong>'.$num.'</strong> '.$adminLanguage->A_ITEMS.'</td>'._LEND;
				echo '<td>&nbsp;</td>'._LEND;
				echo '</tr>'._LEND;
			}
			$k = 1 - $k;
		}
	}
}
?>
<tr>
	<td colspan="3" style="padding: 20px; text-align: center; font-weight: bold;"><?php echo $adminLanguage->A_COMP_CHECK_DONE; ?></td>
</tr>
</table>