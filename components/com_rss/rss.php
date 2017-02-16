<?php 
/**
* @version: $Id: rss.php 2542 2009-10-01 11:23:34Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component RSS
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @note (Ioannis Sannos): No access control and language filtering for this component
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


require_once($mainframe->getCfg('absolute_path').'/includes/feedcreator.class.php' );

$info = null;
$rss = null;

switch ( $task ) {
	case 'live_bookmark':
		feedFrontpage( false );
	break;
	default:
		feedFrontpage( true );
	break;
}


/**********************************/
/* CREATE FEED FROM CONTENT ITEMS */
/**********************************/
function feedFrontpage($showFeed) {
	global $database, $mainframe, $lang, $Itemid, $mosConfig_offset;
	
	//pull id of syndication component
	$database->setQuery("SELECT id FROM #__components WHERE name = 'Syndicate'", '#__', 1, 0);
	$id = intval($database->loadResult());
	
	//load syndication parameters
	$component = new mosComponent( $database );
	$component->load( $id );
	$params = new mosParameters( $component->params );

	//get feed type from url
    $feed = strtoupper(mosGetParam( $_GET, 'feed', 'RSS2.0'));
    $vfeeds = array( 'RSS0.91', 'RSS1.0', 'RSS2.0', 'OPML', 'ATOM0.3' ); //PIE0.1, MBOX, HTML, JS removed
    if (!in_array($feed, $vfeeds)) { $feed = 'RSS2.0'; }

	$now = date('Y-m-d H:i:s', time() + $mosConfig_offset * 3600);
	$iso = preg_split('/\=/', _ISO );

	//parameter intilization
	$info['date'] 		= date( 'r' );
	$info['year'] 		= date( 'Y' );
	$info['encoding'] 	= $iso[1];
	$info['link'] 		= htmlspecialchars($mainframe->getCfg('live_site'));
	$info['cache'] 		= $params->def( 'cache', 1 );
	$info['cache_time'] 	= $params->def( 'cache_time', 3600 );
	$info['count']		= $params->def( 'count', 5 );
	$info['multilingual']	= intval($params->def( 'multilingual', 0 ));
	$info['orderby'] 		= $params->def( 'orderby', 'rdate' );
	$info['title'] 		= $params->def( 'title', $mainframe->getCfg('sitename').' '.$feed );
	$info['description'] 	= $params->def( 'description', $mainframe->getCfg('MetaDesc'));
	$info['image_file']	= $params->def( 'image_file', 'elxis_rss.png' );
	if ( $info['image_file'] == -1 ) {
		$info['image']	= NULL;
	} else{
		$info['image']	= $mainframe->getCfg('live_site').'/images/M_images/'.$info['image_file'];
	}
	$info['image_alt'] 	= $params->def( 'image_alt', $mainframe->getCfg('sitename') );
	$info['limit_text'] 	= $params->def( 'limit_text', 1 );
	$info['text_length'] 	= $params->def( 'text_length', 20 );
    $info['feed'] 		=  $feed;
	//live bookmarks
	$info['live_bookmark'] = $params->def( 'live_bookmark', '' );
	$info['bookmark_file'] = $params->def( 'bookmark_file', '' );
	$info['eblog'] = intval($params->def('eblog', 5));

	//set filename for live bookmarks feed
	if ( !$showFeed & $info[ 'live_bookmark' ] ) {
		if ( $info[ 'bookmark_file' ] ) {
		//custom bookmark filename
			$info[ 'file' ] = $mainframe->getCfg('absolute_path').'/cache/'.$info['bookmark_file'];
		} else {
		//standard bookmark filename
			$info[ 'file' ] = $mainframe->getCfg('absolute_path').'/cache/'.$info['live_bookmark'];
		}		
	} else {
		//set filename for rss feeds
		$info[ 'file' ] = eUTF::utf8_strtolower( eUTF::utf8_str_replace( '.', '', $info['feed'] ) );
		$info[ 'file' ] = $mainframe->getCfg('absolute_path').'/cache/'.$info[ 'file' ].'.xml';
	}

	if ($info['multilingual']) { //multilingual feeds
		$info[ 'live_bookmark' ] = str_replace('.xml', '-'.$lang.'.xml', $info[ 'live_bookmark' ]);
		$info[ 'bookmark_file' ] = str_replace('.xml', '-'.$lang.'.xml', $info[ 'bookmark_file' ]);
		$info[ 'file' ] = str_replace('.xml', '-'.$lang.'.xml', $info[ 'file' ]);
	}
	$info[ 'onlyfrontpage' ] = intval($params->def( 'onlyfrontpage', 0 ));

	//load feed creator class
	$rss = new UniversalFeedCreator();
	//load image creator class
	$image = new FeedImage();
	
	//loads cache file
	if ( $showFeed && $info[ 'cache' ] ) {
		$rss->useCached( $info[ 'feed' ], $info[ 'file' ], $info[ 'cache_time' ] );
	}

	$rss->title 			= $info[ 'title' ];
	$rss->description 		= $info[ 'description' ];
	$rss->link 				= $info[ 'link' ];
	$rss->syndicationURL 	= $info[ 'link' ];
	$rss->cssStyleSheet 	= NULL;
	$rss->encoding 			= $info[ 'encoding' ];

	if ( $info[ 'image' ] ) {
		$image->url 		= $info[ 'image' ];
		$image->link 		= $info[ 'link' ];
		$image->title 		= $info[ 'image_alt' ];
		$image->description	= $info[ 'description' ];
		//loads image info into rss array
		$rss->image 		= $image;
	}

	//Determine ordering for sql
	switch ( strtolower( $info[ 'orderby' ] ) ) {
		case 'date':
			$orderby = 'a.created';
		break;
		case 'alpha':
			$orderby = 'a.title';
		break;
		case 'ralpha':
			$orderby = 'a.title DESC';
		break;
		case 'hits':
			$orderby = 'a.hits DESC';
		break;
		case 'rhits':
			$orderby = 'a.hits ASC';
		break;
		case 'front':
			$orderby = ($info[ 'onlyfrontpage' ]) ? 'f.ordering' : 'a.created DESC';
		break;
		case 'rdate':
		default:
			$orderby = 'a.created DESC';
		break;
	}

	// query of frontpage content items
	$query = "SELECT a.*, u.name AS author, u.usertype"
	."\n FROM #__content a";
	if ($info[ 'onlyfrontpage' ]) {
		$query .= "\n INNER JOIN #__content_frontpage f ON f.content_id = a.id";
	}
	$query .= "\n LEFT JOIN #__users u ON u.id = a.created_by"
	."\n WHERE a.state = '1' AND a.access = '29'"
	."\n AND ( a.publish_up = '1979-12-19 00:00:00' OR a.publish_up <= '". $now ."' )"
	."\n AND ( a.publish_down = '2060-01-01 00:00:00' OR a.publish_down >= '". $now ."' )";
	$query .= ($info['multilingual']) ? "\n AND ((a.language IS NULL) OR (a.language LIKE '%$lang%'))" : '';
	$query .= "\n ORDER BY ".$orderby;

    if ( $info['count'] ) {
        $database->setQuery( $query, '#__', $info[ 'count' ], 0 );
    } else {
        $database->setQuery( $query );
    }
	$rows = $database->loadObjectList();
	
	if ($rows) {
		foreach ( $rows as $row ) {
			//title for particular item
			$item_title = htmlspecialchars( $row->title );
			$item_title = html_entity_decode( $item_title );
	
			//url link to article
			//& used instead of &amp; as this is converted by feed creator
			$_Itemid = ($mainframe->getCfg('sef') != '2') ? $mainframe->getItemid( $row->id ) : $Itemid;
			$item_link = $mainframe->getCfg('live_site').'/index.php?option=com_content&task=view&id='.$row->id.'&Itemid='.$_Itemid;
  			$item_link = sefRelToAbs( $item_link );
  			$item_link = str_replace('&amp;', '&', $item_link);

			// removes all formating from the intro text for the description text
			$item_description = $row->introtext;
			$item_description = mosHTML::cleanText( $item_description );
			$item_description = html_entity_decode( $item_description );
			if ($info['limit_text']) {
				if ($info[ 'text_length']) {
					//limits description text to x words
					$item_description_array = preg_split('/[\s]/', $item_description);
					$count = count( $item_description_array );
					if ( $count > $info['text_length']) {
						$item_description = '';
						for ( $a = 0; $a < $info['text_length']; $a++ ) {
							$item_description .= $item_description_array[$a]. ' ';
						}
						$item_description = eUTF::utf8_trim( $item_description );
						$item_description .= '...';
					}
				} else  {
					//do not include description when text_length = 0
					$item_description = NULL;
				}
			}

			//load individual item creator class
			$item = new FeedItem();
			//item info
			$item->title 		= $item_title;
			$item->link 		= $item_link;
			$item->description 	= $item_description;
			$item->source 		= $info[ 'link' ];

			//loads item info into rss array
			$rss->addItem( $item );
		}
	}

	//generate RSS feeds for eBlog posts
	if ($info['eblog'] > 0) {
		$query = "SELECT b.id, b.title, b.seotitle, b.blogid, b.blogtext, s.seotitle AS seoblog FROM #__eblog b"
		."\n LEFT JOIN #__eblog_settings s ON s.blogid = b.blogid"
		."\n WHERE s.published = '1'"
		."\n AND ((b.language IS NULL) OR (b.language LIKE '%".$lang."%'))"
		."\n ORDER BY b.dateadded DESC";
		$database->setQuery($query, '#__', $info['eblog'], 0);
		$brows = $database->loadObjectList();

		if ($brows) {
			$itemids = array();
			foreach ($brows as $brow) {
				//find Itemid (if needed)
				if ($mainframe->getCfg('sef') != '2') {
					$bid = $brow->blogid;
					if (!isset($itemids[$bid])) {
						$query = "SELECT id FROM #__menu WHERE link = 'index.php?option=com_eblog&task=browse&blogid=".$bid."'"
						."\n AND published = '1' AND access = '29' AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
						$database->setQuery($query, '#__', 1, 0);
						$itemids[$bid] = intval($database->loadResult());
					}
					if (($itemids[$bid] === 0) && (!isset($itemids[0]))) {
						$query = "SELECT id FROM #__menu WHERE link = 'index.php?option=com_eblog'"
						."\n AND published = '1' AND access = '29' AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
						$database->setQuery($query, '#__', 1, 0);
						$itemids[0] = intval($database->loadResult());
					}
					$_Itemid = ($itemids[$bid]) ? $itemids[$bid] : $itemids[0];
					if (!$_Itemid) { $_Itemid = $Itemid; }
				} else {
					$_Itemid = $Itemid;
				}

				//title for particular item
				$item_title = html_entity_decode(htmlspecialchars($brow->title));

				$stdlink = 'index.php?option=com_eblog&task=show&blogid='.$brow->blogid.'&id='.$brow->id.'&Itemid='.$_Itemid;
				$seolink = 'eblog/'.$brow->seoblog.'/'.$brow->seotitle.'.html';
				$item_link = sefRelToAbs($stdlink, $seolink);
				if (!preg_match('/^(http)/i', $item_link)) {
					$item_link = preg_replace('/^(\/)/', '', $item_link);
					$item_link = $mainframe->getCfg('live_site').'/'.$item_link;
				}
				$item_link = str_replace('&amp;', '&', $item_link);

				//removes all formating from the intro text for the description text
				$item_description = mosHTML::cleanText($brow->blogtext);
				$item_description = html_entity_decode($item_description);
				if ($info['limit_text']) {
					if ($info['text_length']) {
						//limits description text to x words
						$item_description_array = preg_split('/[\s]/', $item_description);
						$count = count($item_description_array);
						if ($count > $info['text_length']) {
							$item_description = '';
							for ($a = 0; $a < $info['text_length']; $a++) {
								$item_description .= $item_description_array[$a].' ';
							}
							$item_description = eUTF::utf8_trim( $item_description ).'...';
						}
					} else  {
						//do not include description when text_length = 0
						$item_description = NULL;
					}
				}

				//load individual item creator class
				$item = new FeedItem();
				$item->title 		= $item_title;
				$item->link 		= $item_link;
				$item->description 	= $item_description;
				$item->source 		= $info['link'];

				$rss->addItem($item);
			}
		}
	}

	//save feed file
	$rss->saveFeed( $info[ 'feed' ], $info[ 'file' ], $showFeed );		
}

?>