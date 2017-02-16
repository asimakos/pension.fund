<?php
/**
* @version: $Id: footer.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Footer
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $_VERSION;
if (($_VERSION->PRODUCT != 'E'.'l'.'x'.'i'.'s') || (!preg_match('/ElxIs/i', $_VERSION->COPYRIGHT))) { die(); }
?>
<div id="elxiscopyright" align="center">
 <?php
 global $lang;
 if ($lang=='greek'){
 echo '<b> Μ.Τ.Π.Υ </b>';
 echo '<br> Μετοχικό Ταμείο Πολιτικών Υπαλλήλων';
 echo '<br> Λυκούργου 12';
 echo '<br> 105 52 Αθήνα';
 }
?>
	<?php //echo $_VERSION->URL; ?><br />
	<?php //echo $_VERSION->COPYURL; ?>
</div>
