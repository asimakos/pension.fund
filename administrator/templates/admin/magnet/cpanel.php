<?php 
/**
* @version: $Id$
* @copyright: (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Administration Templates / Magnet
* @author: Ioannis Sannos (datahell)
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @description: Magnet is an administration template for Elxis 2008.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


?>

<script type="text/javascript">
<!--
var cpajax = new sack();
function whenLoadingCPM(){
	var e = document.getElementById(cpajax.element);
	e.innerHTML = "<img src=\"images/loading.gif\" />";
}

function whenLoadedCPM(){
	var e = document.getElementById(cpajax.element);
	e.innerHTML = "<img src=\"images/loading.gif\" />";
}

function whenInteractiveCPM(){
	var e = document.getElementById(cpajax.element);
	e.innerHTML = "<img src=\"images/loading.gif\" />";
}

function loadTabModule(q, mod) {
	var e = document.getElementById('ajaxTab'+q);
	e.style.display = "";

    cpajax.setVar("option", 'com_admin');
    cpajax.setVar("task", 'loadModule');
    cpajax.setVar("mod", mod);

    cpajax.requestFile = "index3.php";

	cpajax.method = 'POST';
	cpajax.element = 'ajaxTab'+q;
	cpajax.onLoading = whenLoadingCPM;
	cpajax.onLoaded = whenLoadedCPM;
	cpajax.onInteractive = whenInteractiveCPM;
	cpajax.runAJAX();
}
//-->
</script>

<table class="adminform" width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
	<td width="50%" valign="top">
		<?php mosLoadAdminModules( 'icon', 0 ); ?>
	</td>
	<td width="50%" valign="top">
		<div style="width:100%;">
			<form action="index2.php" method="post" name="adminForm">
				<?php mosLoadAdminModules( 'cpanel', 3 ); ?>
			</form>
		</div>
	</td>
</tr>
</table>