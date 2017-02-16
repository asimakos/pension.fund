<?php 
/** 
* @version: $Id: newsfeeds.html.php 2578 2010-01-12 11:58:57Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component NewsFeeds
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_newsfeed {


    /******************/
    /* HTML NEWSFEEDS */
    /******************/
	static public function displaylist( &$categories, &$rows, $catid, $currentcat=NULL, &$params ) {
		global $Itemid, $hide_js;

		echo '<div class="newsfeeds' .$params->get( 'pageclass_sfx' ).'">'._LEND;
		if ( $params->get( 'page_title' ) ) {
			echo '<h1 class="componentheading'.$params->get( 'pageclass_sfx' ).'">'.$currentcat->header.'</h1>'._LEND;
		}
		echo '<p>';
		if ( $currentcat->img ) {
			echo '<img src="'.$currentcat->img.'" align="'.$currentcat->align.'" hspace="6" alt="'._WEBLINKS_TITLE.'" title="'._WEBLINKS_TITLE.'" border="0" />'._LEND;
		}
		echo $currentcat->descrip.'</p>'._LEND;
		if (count($rows)) {
			HTML_newsfeed::showTable( $params, $rows, $catid, $currentcat->seotitle );
			echo '<div style="clear: both;"></div>'._LEND;
		}
        echo '<br />'._LEND;

		//displays listing of Categories
		if (( $params->get( 'type' ) == 'category' ) && $params->get( 'other_cat' )) {
			HTML_newsfeed::showCategories( $params, $categories, $catid );
		} else if (( $params->get( 'type' ) == 'section' ) && $params->get( 'other_cat_section' )) {
			HTML_newsfeed::showCategories( $params, $categories, $catid );
		}
        echo '</div>'._LEND;
        echo '<div style="clear: both;"></div>'._LEND;
		mosHTML::BackButton ( $params, $hide_js );
	}


	/**********************/
	/* HTML LIST OF FEEDS */
	/**********************/
	static public function showTable( &$params, &$rows, $catid, $seocat ) {
		global $Itemid;

		$dir = _GEM_RTL ? ' dir="rtl"' : '';
        $k = 0;
        echo '<ul class="table'.$params->get('pageclass_sfx').'">'._LEND;
        foreach ($rows as $row) {
            $link = 'index.php?option=com_newsfeeds&task=view&feedid='.$row->id.'&Itemid='.$Itemid;
            $seolink = '';
            if (($seocat != '') && ($row->seotitle != '')) {
                $seolink = 'feeds/'.$seocat.'/'.$row->seotitle.'.html';
            }
            $spacer = '';

            echo '<li class="row'.$k.'">'._LEND;
            if ( $params->get( 'name' ) ) {
                echo '<a href="'.sefRelToAbs($link, $seolink).'" class="category'.$params->get('pageclass_sfx').'" title="'.$row->name.'">';
                echo $row->name.'</a>';
                $spacer = ' ';
            } 
            if ($params->get('articles')) {
                echo $spacer.'<span'.$dir.'>(';
                if ($params->get('headings')) { echo _E_NUM_ARTICLES.': '; }
                echo $row->numarticles.')</span>';
                $spacer = ' ';
            }
			if ($params->get('link')) {
                echo ($spacer == ' ') ? '<br />' : '';
                echo '<span'.$dir.'>';
                if ($params->get('headings')) { echo _E_FEED_LINK.': '; }
                echo $row->link;
                echo '</span>';
            }
            echo '</li>'._LEND;
            $k = 1 - $k;
        }
        echo '</ul>'._LEND;
	}


	/*******************************/
	/* DISPLAY LINKS TO CATEGORIES */
	/*******************************/
	static public function showCategories( &$params, &$categories, $catid ) {
		global $Itemid;
		
		$dir = _GEM_RTL ? ' dir="rtl"' : '';
        if ($categories) {
?>
		<ul>
<?php 
		foreach ( $categories as $cat ) {
			if ( $catid == $cat->catid ) {
?>	
			<li>
				<strong><?php echo $cat->title; ?></strong> 
				<span class="small"<?php echo $dir; ?>>(<?php echo $cat->numlinks; ?>)</span>
			</li>
<?php 
			} else {
				$link = 'index.php?option=com_newsfeeds&amp;catid='.$cat->catid.'&amp;Itemid='.$Itemid;
				$seolink = ($cat->seotitle != '') ? 'feeds/'.$cat->seotitle.'/' : '';
?>	
			<li>
				<a href="<?php echo sefRelToAbs( $link, $seolink ); ?>" class="category<?php echo $params->get( 'pageclass_sfx' ); ?>" title="<?php echo $cat->title; ?>">
					<?php echo $cat->title; ?> 
				</a>
<?php 
				if ( $params->get( 'cat_items' ) ) {
?>
					&nbsp;<span class="small"<?php echo $dir; ?>>(<?php echo $cat->numlinks; ?>)</span>
<?php 
				}
				if ( $params->get( 'cat_description' ) ) { echo '<br />'.$cat->description; }
?>
			</li>
<?php 
			}
		}
?>
		</ul>
<?php
		}
	}


    /*************/
    /* SHOW FEED */
    /*************/
	static public function showNewsfeeds(&$newsfeeds, &$params) {
		global $mainframe, $fmanager;

		$cacheDir = $mainframe->getCfg('absolute_path').'/cache/simplepie/';
		if (!file_exists($cacheDir)) {
			$ok = $fmanager->createFolder($cacheDir);
			if (!$ok) {
				echo '<div class="elxerror">Could not create required cache/simplepie/ folder!</div>'._LEND;
				return;
			}
		}

        if ($params->get('header')) {
			echo '<h1 class="componentheading'.$params->get('pageclass_sfx').'">'.$params->get('header').'</h1>'._LEND;
		}

		foreach ($newsfeeds as $newsfeed) {
			$feed = new SimplePie();
			$feed->set_feed_url($newsfeed->link);
			$feed->set_cache_location($cacheDir);

			$ct = (int)$newsfeed->cache_time;
			if ($ct < 10) { $ct = 3600; }
			$feed->set_cache_duration($ct);
			$feed->force_fsockopen(true);

			$feed->set_image_handler($mainframe->getCfg('live_site').'/includes/simplepie/handler_image.php');
			$feed->set_favicon_handler($mainframe->getCfg('live_site').'/includes/simplepie/handler_image.php');
			$success = $feed->init();
			$feed->handle_content_type();

			if ($feed->error()) {
				elxError(htmlspecialchars($feed->error()), 1);
			} else {
				$extraURL = $mainframe->getCfg('ssl_live_site').'/includes/simplepie/extra/';
?>
				<div id="sp_results">
					<div class="feeddscr">
					<h3 class="feedtitle<?php echo $params->get('pageclass_sfx'); ?>">
					<?php 
					if ($feed->get_link()) {
						echo '<a href="'.$feed->get_link().'" target="_child" title="'.$feed->get_title().'">'.$feed->get_title().'</a>'; 
					} else {
						echo $feed->get_title(); 
					}
					?></h3>
					<?php 
					if ($params->get('feed_descr') || $params->get('feed_image')) {
                    	if ($params->get('feed_image') && $feed->get_image_url()) {
                    		if ($feed->get_image_link()) {
                    			echo '<a href="' . $feed->get_image_link().'" title="'.$feed->get_image_title().'" target="_blank">';
                    			echo '<img src="'.$feed->get_image_url().'" alt="'.$feed->get_image_title().'" />';
                    			echo "</a><br />\n";
                    		} else {
                   				echo '<img src="'.$feed->get_image_url().'" alt="'.$feed->get_image_title().'" title="'.$feed->get_image_title().'" /><br />';
                    		}
                    	}         
						if ($params->get('feed_descr')) {
                        	echo $feed->get_description();
                    	}
					}
					?>
					</div>	
					<?php 
					if ($params->get('subscribe_links')) {
					?>
					<p class="feedsubscribe">
					<a href="<?php echo $feed->subscribe_bloglines(); ?>" title="subscribe to Bloglines">Bloglines</a>, 
					<a href="<?php echo $feed->subscribe_google(); ?>" title="subscribe to Google Reader">Google Reader</a>, 
					<a href="<?php echo $feed->subscribe_msn(); ?>" title="subscribe to MSN">My MSN</a>, 
					<a href="<?php echo $feed->subscribe_netvibes(); ?>" title="subscribe to Netvibes">Netvibes</a>, 
					<a href="<?php echo $feed->subscribe_newsburst(); ?>" title="subscribe to Newsburst">Newsburst</a><br />
					<a href="<?php echo $feed->subscribe_newsgator(); ?>" title="subscribe to Newsgator">Newsgator</a>, 
					<a href="<?php echo $feed->subscribe_odeo(); ?>" title="subscribe to Odeo">Odeo</a>, 
					<a href="<?php echo $feed->subscribe_podnova(); ?>" title="subscribe to Podnova">Podnova</a>, 
					<a href="<?php echo $feed->subscribe_rojo(); ?>" title="subscribe to Rojo">Rojo</a>, 
					<a href="<?php echo $feed->subscribe_yahoo(); ?>" title="subscribe to Yahoo">My Yahoo!</a>, 
					<a href="<?php echo $feed->subscribe_feed(); ?>" title="subscribe to Desktop Reader">Desktop Reader</a>
					</p>
					<?php 
					}
					?>
					<ul class="feeditems">
<?php 
					foreach($feed->get_items(0, $newsfeed->numarticles) as $item) {
						if (!$favicon = $feed->get_favicon()) {
							$favicon = $extraURL.'favicons/alternate.png';
						}

						echo '<li>'._LEND;
						echo '<h4><img src="'.$favicon.'" alt="favicon" />&nbsp;';
						if ($item->get_permalink()) {
							echo '<a href="'.$item->get_permalink().'" title="'.$item->get_title().'">'.$item->get_title().'</a>'; 
						} else {
							echo $item->get_title(); 
						}
						echo '&nbsp;<span>'.eLOCALE::strftime_os("%d %b %Y, %H:%M", $item->get_date('U')).'</span>'._LEND;
						echo '</h4>'._LEND;
						//if ($author = $item->get_author()) { echo '<div class="feedauthor">'.$author->get_name().'</div>'; }

						if ($params->get('item_descr')) {
							//$num = intval($params->get('word_count')); //deprecated
							echo '<div class="feedtext">'._LEND;
                            echo $item->get_content();
							echo '</div>'._LEND;

							if ($enclosure = $item->get_enclosure(0)) {
								echo '<div align="center">';
								echo '<p>'.$enclosure->embed(array(
									'audio' => $extraURL.'place_audio.png',
									'video' => $extraURL.'place_video.png',
									'mediaplayer' => $extraURL.'mediaplayer.swf',
									'alt' => '<img src="'.$extraURL.'mini_podcast.png" class="download" border="0" title="Download the Podcast ('.$enclosure->get_extension().'; '.$enclosure->get_size().' MB)" />',
									'altclass' => 'download'
								)) . '</p>'._LEND;
								echo '<p style="font-size:12px; color:#888;" align="center">('.$enclosure->get_type();
								if ($enclosure->get_size()){ echo '; '.$enclosure->get_size().' MB'; }
								echo ')</p>'._LEND;
								echo '</div>'._LEND;
							}

							if ($params->get('share_links')) {
?>
							<p align="center">
							<a href="<?php echo $item->add_to_blinklist(); ?>" title="Add post to Blinklist"><img src="<?php echo $extraURL; ?>favicons/blinklist.png" alt="Blinklist" /></a>
							<a href="<?php echo $item->add_to_blogmarks(); ?>" title="Add post to Blogmarks"><img src="<?php echo $extraURL; ?>favicons/blogmarks.png" alt="Blogmarks" /></a>
							<a href="<?php echo $item->add_to_delicious(); ?>" title="Add post to del.icio.us"><img src="<?php echo $extraURL; ?>favicons/delicious.png" alt="del.icio.us" /></a>
							<a href="<?php echo $item->add_to_digg(); ?>" title="Digg this!"><img src="<?php echo $extraURL; ?>favicons/digg.png" alt="Digg" /></a>
							<a href="<?php echo $item->add_to_magnolia(); ?>" title="Add post to Ma.gnolia"><img src="<?php echo $extraURL; ?>favicons/magnolia.png" alt="Ma.gnolia" /></a>
							<a href="<?php echo $item->add_to_myweb20(); ?>" title="Add post to My Web 2.0"><img src="<?php echo $extraURL; ?>favicons/myweb2.png" alt="My Web 2.0" /></a>
							<a href="<?php echo $item->add_to_newsvine(); ?>" title="Add post to Newsvine"><img src="<?php echo $extraURL; ?>favicons/newsvine.png" alt="Newsvine" /></a>
							<a href="<?php echo $item->add_to_reddit(); ?>" title="Add post to Reddit"><img src="<?php echo $extraURL; ?>favicons/reddit.png" alt="Reddit" /></a>
							<a href="<?php echo $item->add_to_segnalo(); ?>" title="Add post to Segnalo"><img src="<?php echo $extraURL; ?>favicons/segnalo.png" alt="Segnalo" /></a>
							<a href="<?php echo $item->add_to_simpy(); ?>" title="Add post to Simpy"><img src="<?php echo $extraURL; ?>favicons/simpy.png" alt="Simpy" /></a>
							<a href="<?php echo $item->add_to_spurl(); ?>" title="Add post to Spurl"><img src="<?php echo $extraURL; ?>favicons/spurl.png" alt="Spurl" /></a>
							<a href="<?php echo $item->add_to_wists(); ?>" title="Add post to Wists"><img src="<?php echo $extraURL; ?>favicons/wists.png" alt="Wists" /></a>
							<a href="<?php echo $item->search_technorati(); ?>" title="Who's linking to this post?"><img src="<?php echo $extraURL; ?>favicons/technorati.png" alt="Technorati" /></a>
							</p>
<?php 
							}
						}
						echo '</li>'._LEND;
					}
?>
					</ul>
				</div>
<?php 
			}
		}

		mosHTML::BackButton($params);
	}
}

?>