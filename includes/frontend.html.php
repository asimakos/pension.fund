<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


class modules_html {

    /**********************/
    /* CUSTOM MODULE HTML */
    /**********************/
	static function module( $module, $params, $Itemid, $style=0 ) {
		global $mosConfig_live_site, $mosConfig_sitename, $lang, $mosConfig_absolute_path;

		//custom module params
		$rssurl 			= $params->get('rssurl' );
		$rssitems 			= $params->get('rssitems', 5 );
		$rssdesc 			= $params->get('rssdesc', 1 );
		$rssimage 			= $params->get('rssimage', 1 );
		$rssitemdesc		= $params->get('rssitemdesc', 1 );
		$moduleclass_sfx 	= $params->get('moduleclass_sfx' );
		$words 				= $params->def('word_count', 0 );

		if ($style == -3 && !$rssurl) {
		?>
			<div class="module<?php echo $moduleclass_sfx; ?>">
				<div>
					<div>
						<div>
						<?php 
						if ($module->showtitle != 0) {
							echo '<h3>'.$module->title.'</h3>'._LEND;
						}
						if ( $module->content ) {
							echo $module->content;
						}
						?>
						</div>
					</div>
				</div>
			</div>
		<?php 
		} else if ($style == -2 && !$rssurl) {
            echo '<div class="moduletable'.$moduleclass_sfx.'">'._LEND;
			if ($module->showtitle != 0) {
			    echo '<h3>'.$module->title.'</h3>'._LEND;
			}
			if ( $module->content ) { echo $module->content; }
            echo '</div>'._LEND;
		} else if ($style == -1 && !$rssurl) {
			echo $module->content;
			return;
		} else {
			$tableopen = 1;
		?>
			<table cellpadding="0" cellspacing="0" class="moduletable<?php echo $moduleclass_sfx; ?>">
			<?php
			if ( $module->showtitle != 0 ) {
				?>
				<tr>
					<th valign="top"><?php echo $module->title; ?></th>
				</tr>
				<?php
			}

			if ( $module->content ) {
			?>
				<tr>
					<td><?php echo $module->content; ?></td>
				</tr>
				<?php
			}
		}
		//feed output
		if ( $rssurl ) {
			$cacheDir = $mosConfig_absolute_path .'/cache/';
			$LitePath = $mosConfig_absolute_path .'/includes/Cache/Lite.php';
			require_once( $mosConfig_absolute_path .'/includes/domit/xml_domit_rss.php' );
			$rssDoc = new xml_domit_rss_document();
			$rssDoc->useCacheLite(true, $LitePath, $cacheDir, 3600);
			$rssDoc->loadRSS( $rssurl );
			$totalChannels 	= $rssDoc->getChannelCount();

			for ( $i = 0; $i < $totalChannels; $i++ ) {
				$currChannel = $rssDoc->getChannel($i);
				$elements 	= $currChannel->getElementList();
				$iUrl		= 0;
				foreach ( $elements as $element ) {
					//image handling
					if ( $element == 'image' ) {
						$image = $currChannel->getElement( DOMIT_RSS_ELEMENT_IMAGE );
						$iUrl	= $image->getUrl();
						$iTitle	= $image->getTitle();
					}
				}

				//feed title
				$ftitle = $currChannel->getTitle();
				
				//XML compatibility
				$clink = str_replace('&amp;', '&', $currChannel->getLink());
				$clink = str_replace('&', '&amp;', $clink);
				?>
				<tr>
					<td><strong>
					<a href="<?php echo $clink; ?>" title="<?php echo $ftitle; ?>" target="_blank"><?php echo $ftitle; ?></a>
					</strong></td>
				</tr>
				<?php
				//feed description
				if ( $rssdesc ) {
				?>
					<tr>
						<td><?php echo $currChannel->getDescription(); ?></td>
					</tr>
					<?php
				}
				//feed image
				if ( $rssimage ) {
				?>
					<tr>
						<td align="center"><img src="<?php echo $iUrl; ?>" alt="<?php echo $iTitle; ?>" border="0" /></td>
					</tr>
					<?php
				}

				$actualItems = $currChannel->getItemCount();
				$setItems = $rssitems;

				if ($setItems > $actualItems) {
					$totalItems = $actualItems;
				} else {
					$totalItems = $setItems;
				}

				?>
				<tr>
					<td>
					<ul class="newsfeed<?php echo $moduleclass_sfx; ?>">
					<?php
					for ($j = 0; $j < $totalItems; $j++) {
						$currItem = $currChannel->getItem($j);
						//item title
						$ctitle = $currItem->getTitle();
						//XML compatibility
						$cilink = str_replace('\&amp\;', '\&', $currItem->getLink());
						$cilink = str_replace('\&', '\&amp\;', $cilink);
						?>
						<li class="newsfeed<?php echo $moduleclass_sfx; ?>">
						<strong>
						<a href="<?php echo $cilink; ?>" title="<?php echo $ctitle; ?>" target="_blank"><?php echo $ctitle; ?></a>
						</strong>
						<?php
						// item description
						if ( $rssitemdesc ) {
							// item description
							$text = html_entity_decode( $currItem->getDescription() );
							//word limit check
							if ( $words ) {
								$texts = explode( ' ', $text );
								$count = count( $texts );
								if ( $count > $words ) {
									$text = '';
									for( $i=0; $i < $words; $i++ ) {
										$text .= ' '. $texts[$i];
									}
									$text .= '...';
								}
							}
							?>
							<div><?php echo $text; ?></div>
							<?php
						}
						?>
						</li>
						<?php
					}
					?>
					</ul>
					</td>
				</tr>
				<?php
			}
		}

		if (isset($tableopen)) {
			echo "</table>\n";
			unset($tableopen);
		}
	}


	/************************/
	/* STANDARD MODULE HTML */
	/************************/
	static function module2( $module, $params, $Itemid, $style=0, $count=0 ) {
		global $mosConfig_live_site, $mosConfig_sitename, $mosConfig_absolute_path;
		global $mainframe, $database, $my;

		$moduleclass_sfx = $params->get( 'moduleclass_sfx' );
		if (!file_exists($mosConfig_absolute_path.'/modules/'.$module->module.'.php')) { return; }

        if ($style == -3) { //rounded corners
        ?>
			<div class="module<?php echo $moduleclass_sfx; ?>">
				<div>
					<div>
						<div>
						<?php 
						if ($module->showtitle != 0) {
							echo '<h3>'.$module->title.'</h3>'._LEND;
						}
						include( $mosConfig_absolute_path.'/modules/'.$module->module.'.php' );
						if (isset( $content)) { echo $content; }
						?>
						</div>
					</div>
				</div>
			</div>
        <?php 
        } else if ($style == -2) {
            //divs and font header tags
            echo '<div class="moduletable'.$moduleclass_sfx.'">'._LEND;
			if ($module->showtitle != 0) {
			    echo '<h3>'.$module->title.'</h3>'._LEND;
			}
			include($mosConfig_absolute_path.'/modules/'.$module->module.'.php');
			if (isset($content)) { echo $content; }
            echo '</div>'._LEND;
		} else if ($style == -1) {
			//show a naked module - no wrapper and no title
			include($mosConfig_absolute_path.'/modules/'.$module->module.'.php');
			if (isset( $content)) { echo $content; }
			echo _LEND;
		} else {
            echo '<table cellpadding="0" cellspacing="0" class="moduletable'.$moduleclass_sfx.'">'._LEND;
			if ( $module->showtitle != 0 ) {
				echo '<tr><th valign="top">'.$module->title.'</th></tr>'._LEND;
			}
            echo '<tr><td>'._LEND;
			include($mosConfig_absolute_path.'/modules/'.$module->module.'.php');
			if (isset( $content)) { echo $content; }
			echo _LEND.'</td></tr>'._LEND;
			echo '</table>'._LEND;
		}
	}
}

?>