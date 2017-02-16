<?php 
/**
* @version: $Id: mospaging.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Bots/Content
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Page break Bot
* @examples of Usage:
* {mospagebreak}
* {mospagebreak title=The page title}
* {mospagebreak heading=The first page}
* {mospagebreak title=The page title&heading=The first page}
* {mospagebreak heading=The first page&title=The page title}
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onPrepareContent', 'botMosPaging' );


/*****************/
/* MOSPAGING BOT */
/*****************/
function botMosPaging( $published, &$row, $params, $page=0 ) {
	global $mainframe, $Itemid, $database, $_MAMBOTS;

	//check if we need to proceed further
	if ( strpos( $row->text, 'mospagebreak' ) === false ) { return true; }

 	//expression to search for
 	$regex = '/{(mospagebreak)\s*(.*?)}/i';

	//check if we need to proceed further (2)
 	if (!$published || $params->get( 'intro_only' )|| $params->get( 'popup' )) {
		$row->text = preg_replace( $regex, '', $row->text );
		return;
	}

	//find all instances of bot and put in $matches
	$matches = array();
	preg_match_all( $regex, $row->text, $matches, PREG_SET_ORDER );

	//split the text around the bot
	$text = preg_split( $regex, $row->text );

	//count the number of pages
	$n = count( $text );

	//we have found at least one bot, therefore at least 2 pages
	if ($n > 1) {
		//check if param query has previously been processed
		if ( !isset($_MAMBOTS->_content_bot_params['mospaging']) ) {
			//load bot params info
			$query = "SELECT params FROM #__mambots WHERE element = 'mospaging' AND folder = 'content'";
			$database->setQuery( $query, '#__', 1, 0 );
			$database->loadObject($mambot);		

			$_MAMBOTS->_content_bot_params['mospaging'] = $mambot;
		}

		$mambot = $_MAMBOTS->_content_bot_params['mospaging'];

	 	$params = new mosParameters( $mambot->params );
	 	$title = $params->def( 'title', 1 );

	 	//adds heading or title to <site> Title
	 	if ( $title ) {
			$page_text = $page + 1;
			$row->page_title = _PN_PAGE .' '.$page_text;
			if ( !$page ) {
				//processing for first page
				parse_str( $matches[0][2], $args );
				if ( @$args['heading'] ) {
					$row->page_title = $args['heading'];
				} else {
					$row->page_title = '';
				}
			} else if ( $matches[$page-1][2] ) {
			    parse_str( html_entity_decode( $matches[$page-1][2] ), $args );
				if ( @$args['title'] ) {
					$row->page_title = $args['title'];
				}
			}
	 	}

		//reset the text, we already hold it in the $text array
		$row->text = '';

		$hasToc = $mainframe->getCfg( 'multipage_toc' );
		if ( $hasToc ) {
			//display TOC
			createTOC( $row, $matches, $page );
		} else {
			$row->toc = '';
		}

		//traditional mos page navigation
		require_once( $GLOBALS['mosConfig_absolute_path'].'/includes/pageNavigation.php' );
		$pageNav = new mosPageNav( $n, $page, 1 );

		//page counter
		$row->text .= '<div class="pagenavcounter">';
		$row->text .= $pageNav->writeLeafsCounter();
		$row->text .= '</div>';

		//page text
		$row->text .= $text[$page];

		$row->text .= '<br />';
		$row->text .= '<div class="pagenavbar">';

		//adds navigation between pages to bottom of text
		if ( $hasToc ) {
			createNavigation( $row, $page, $n );
		}

		//page links shown at bottom of page if TOC disabled
		if (!$hasToc) {
			$seolink = '';
			if (($row->seotitle != '') && ($row->catseotitle != '') && ($row->secseotitle != '')) {
				$seolink = $row->secseotitle.'/'.$row->catseotitle.'/'.$row->seotitle.'.html';
			} else if (($row->sectionid == '0') && ($row->seotitle != '')) {
				$seolink = $row->seotitle.'.html';
			}
			$row->text .= $pageNav->writePagesLinks( 'index.php?option=com_content&task=view&id='.$row->id.'&Itemid='.$Itemid, $seolink );
		}

		$row->text .= '</div><br />';
	}
	return true;
}


/****************************/
/* CREATE TABLE OF CONTENTS */
/****************************/
function createTOC( &$row, &$matches, &$page ) {
	global $Itemid;

	$align = (_GEM_RTL) ? 'left' : 'right';
	$seolink = '';
	if (($row->seotitle != '') && ($row->catseotitle != '') && ($row->secseotitle != '')) {
		$seolink = $row->secseotitle.'/'.$row->catseotitle.'/'.$row->seotitle.'.html';
	} else if (($row->sectionid == '0') && ($row->seotitle != '')) {
		$seolink = $row->seotitle.'.html';
	}

	$nonseflink = 'index.php?option=com_content&amp;task=view&amp;id='.$row->id.'&amp;Itemid='. $Itemid;
	$link = 'index.php?option=com_content&task=view&id='.$row->id.'&Itemid='.$Itemid;
	$link = sefRelToAbs( $link, $seolink );

	$heading = _PN_START;
	//allows customization of first page title by checking for `heading` attribute in first bot
	if ( @$matches[0][2] ) {
	    parse_str( html_entity_decode( $matches[0][2] ), $args );
		if ( @$args['heading'] ) { $heading = $args['heading']; }
	}

	$toc = '<div align="'.$align.'" style="float: '.$align.';">'._LEND;
	$toc .= '<ul class="contenttoc">'._LEND;
	$toc .= '<li class="headtoc">'._TOC_JUMPTO.'</li>'._LEND;
	$toc .= '<li><a href="'.$link.'" title="'.$row->title.'" class="toclink">'.$heading.'</a></li>'._LEND;

	$i = 2;
	$args2 = array();
	foreach ( $matches as $bot ) {
		$link = $nonseflink.'&amp;limit=1&amp;limitstart='.($i-1);
		$seolink2 = '';
		if ($seolink != '') {
			$seolink2 = ($i > 1) ? $seolink.'?page='.($i - 1 ) : $seolink;	
		}
		$link = sefRelToAbs( $link, $seolink2 );

		if ( @$bot[2] ) {
			parse_str( str_replace( '&amp;', '&', $bot[2] ), $args2 );

			if ( @$args2['title'] ) {
				$toc .= '<li><a href="'.$link.'" title="'.$args2['title'].'" class="toclink">'.$args2['title'].'</a></li>'._LEND;
			} else {
				$toc .= '<li><a href="'.$link.'" title="'._PN_PAGE.' '.$i.'" class="toclink">'._PN_PAGE.' '.$i.'</a></li>'._LEND;
			}
		} else {
			$toc .= '<li><a href="'.$link.'" title="'._PN_PAGE.' '.$i.'" class="toclink">'._PN_PAGE.' '.$i.'</a></li>'._LEND;
		}
		$i++;
	}
	$toc .= '</ul>'._LEND;
	$toc .= '</div>'._LEND;
	$row->toc = $toc;
}


/*********************/
/* CREATE NAVIGATION */
/*********************/
function createNavigation( &$row, $page, $n ) {
	global $Itemid;

	$link = 'index.php?option=com_content&task=view&id='.$row->id.'&Itemid='.$Itemid;
	$seolink = '';
	if (($row->seotitle != '') && ($row->catseotitle != '') && ($row->secseotitle != '')) {
		$seolink = $row->secseotitle.'/'.$row->catseotitle.'/'.$row->seotitle.'.html';
	} else if (($row->sectionid == '0') && ($row->seotitle != '')) {
		$seolink = $row->seotitle.'.html';
	}

	if ( $page < $n-1 ) {
		$link_next = $link .'&limit=1&limitstart='.( $page + 1 );
		$seonext = ($seolink != '') ? $seolink.'?page='.( $page + 1 ) : '';
		$link_next = sefRelToAbs( $link_next, $seonext );
		$next = '<a href="'.$link_next.'" title="'._CMN_NEXT.'">'._CMN_NEXT.' '._CMN_NEXT_ARROW.'</a>';
	} else {
		$next = _CMN_NEXT;
	}

	if ( $page > 0 ) {
		$link_prev = $link .'&limit=1&limitstart='.( $page - 1 );
		$seoextra = ($page > 1) ? '?page='.($page - 1) : '';
		$seoprev = ($seolink != '') ? $seolink.$seoextra : '';
		$link_prev = sefRelToAbs( $link_prev, $seoprev );
		$prev = '<a href="'.$link_prev.'" title="'._CMN_PREV.'">'._CMN_PREV_ARROW.' '._CMN_PREV.'</a>';
	} else {
		$prev = _CMN_PREV;
	}

	$row->text .= '<div align="center">'.$prev.' - '.$next.'</div>'._LEND;
} 
?>