<?php 
/**
* @ Version: $Id: setsyn.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: SEO PRO
* @ Author: Ioannis Sannos (datahell)
* @ URL: http://www.elxis.org
* @ E-mail: info@goup.gr
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

if (isset($_GET['itemsyn'])) {
	$itemsyn = intval($_GET['itemsyn']);
	if ($itemsyn) { @session_start(); $_SESSION['itemsyn'] = $itemsyn; }
}

?>