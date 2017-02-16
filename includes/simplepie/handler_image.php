<?php 

define('_VALID_MOS', 1);


$elxis_root = str_replace('/includes/simplepie', '', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));

require_once($elxis_root.'/includes/simplepie/simplepie.php');
SimplePie_Misc::display_cached_file($_GET['i'], $elxis_root.'/cache/simplepie/', 'spi');

?>