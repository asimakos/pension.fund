<?php
/**
* ks-AddPHP Mambot 
* based on rdaddphp legacy bot 
* @version $Id: 2009
* @package AddPhp
* kostas stathopoulos
* @copyright Copyright (C) 2009 ks-net.gr
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Usage:
* {addphp file=realtive_path_to_file_in_elxisdir_include_file_name}
 **/

/**
* Example:
* Elxis installed in /var/www/elxis
* PHP-Files in /var/www/mambo/yourphpfiles/
* Filename  yourfile.php
* {addphp file=yourphpfiles/yourfile.php}
*
*/
 
/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$_MAMBOTS->registerFunction( 'onPrepareContent', 'botAddPhp' );


function botAddPhp( $published, &$row, $mask=0, $page=0  ) {
	global $mosConfig_absolute_path;

 	// expression to search for
 	$regex = '/{(addphp)\s*(.*?)}/i';

 	if (!$published ) {
		$row->text = preg_replace( $regex, '', $row->text );
		return;
	}

	// find all instances of mambot and put in $matches
	$matches = array();
	preg_match_all( $regex, $row->text, $matches, PREG_SET_ORDER );
	
	foreach ($matches as $elm) {
		
		parse_str( $elm[2], $args );
		$phpfile=@$args['file'];
		$output = "";
		if ( $phpfile ) {
			$phpfile = $mosConfig_absolute_path . '/' . $phpfile;
			if (file_exists($phpfile)) {
				ob_start();
				include($phpfile);
				$output .= ob_get_contents();
				ob_end_clean();
			} else {
				$output = "File: $phpfile does not exists"; 	
			}
		}
		$row->text = preg_replace($regex, $output, $row->text, 1);

	}
	return true;
}
/* EOF */
?>
