<?php 
/**
* @version: $Id: mosloadposition.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 206-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Bots/Content
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: This Bot loads module positions within content
* @usage: {mosloadposition position_here}
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onPrepareContent', 'botMosLoadPosition' );

/**************************/
/* BOT MOS LOAD POSITIONS */
/**************************/
function botMosLoadPosition( $published, &$row, $params, $page=0 ) {
	global $database, $_MAMBOTS;

	//check if we need to preceed further
	if ( strpos( $row->text, 'mosloadposition' ) === false ) { return true; }

 	//expression to search for
 	$regex = '/{mosloadposition\s*.*?}/i';

 	//check if we need to preceed further (2)
	if ( !$published ) {
		$row->text = preg_replace( $regex, '', $row->text );
		return true;
	}

 	//find all instances of bot and put in $matches
	preg_match_all( $regex, $row->text, $matches );
	
	//Number of instances found
 	$count = count( $matches[0] );

 	//bot only processes if there are any instances of the mambot in the text
 	if ( $count ) {
		//check if param query has previously been processed
		if ( !isset($_MAMBOTS->_content_bot_params['mosloadposition']) ) {
			//load bot params info
			$query = "SELECT params FROM #__mambots WHERE element = 'mosloadposition' AND folder = 'content'";
			$database->setQuery( $query, '#__', 1, 0 );
			$database->loadObject($mambot);

			$_MAMBOTS->_content_bot_params['mosloadposition'] = $mambot;
		}

		$mambot = $_MAMBOTS->_content_bot_params['mosloadposition'];

	 	$params = new mosParameters( $mambot->params ); 
	 	$style	= $params->def( 'style', -2 );

 		processPositions( $row, $matches, $count, $regex, $style );
	} 	
}


/*********************/
/* PROCESS POSITIONS */
/*********************/
function processPositions ( &$row, &$matches, $count, $regex, $style ) {
	global $database;
	
	$query = "SELECT position FROM #__template_positions ORDER BY position";
	$database->setQuery( $query );
 	$positions 	= $database->loadResultArray();

 	for ( $i=0; $i < $count; $i++ ) {
 		$load = str_replace( 'mosloadposition', '', $matches[0][$i] );
 		$load = str_replace( '{', '', $load );
 		$load = str_replace( '}', '', $load );
 		$load = trim( $load );

		foreach ( $positions as $position ) {
	 		if ( $position == @$load ) {		 			
				$modules	= loadPosition( $load, $style );					
				$row->text 	= preg_replace( '{'. $matches[0][$i] .'}', $modules, $row->text );
				break;			
	 		}	 			
 		}
 	}

  	//removes tags without matching module positions
	$row->text = preg_replace( $regex, '', $row->text );
}


/*****************/
/* LOAD POSITION */
/*****************/
function loadPosition( $position, $style=-2 ) {
	$modules = '';
	if ( mosCountModules( $position ) ) {
		ob_start();
		mosLoadModules ( $position, $style );
		$modules = ob_get_contents();
		ob_end_clean();
	}

	return $modules;
} 
?>