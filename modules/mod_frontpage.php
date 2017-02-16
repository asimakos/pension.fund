<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Module Frontpage
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Module ideal for been used in the site's frontpage. Displays a summary of the latest site additions.
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class moduleFrontpage {

	protected $wfactor = '2';


	/***************/
	/* CONSTRUCTOR */
	/***************/
	public function __construct($wfactor=2) {
		$this->wfactor = $wfactor;
	}


	/**************/
	/* LIMIT TEXT */
	/**************/
	public function limittext($txt, $textlimit) {
	    $len = eUTF::utf8_strlen($txt);
	    if ($len <= $textlimit) {
	        return $txt;
	    } else {
	        $txt = eUTF::utf8_substr($txt, 0, $textlimit);
	        $pos = eUTF::utf8_strrpos($txt,' ');
	        if ($pos >0) {
		        $txt = eUTF::utf8_substr($txt, 0, $pos);
		    	if ((($tpos = eUTF::utf8_strrpos($txt,'<')) >  eUTF::utf8_strrpos($txt,'>')) && ($tpos > 0)) {
			  		$txt = eUTF::utf8_substr($txt, 0, $tpos-1);
			  	}
			}
	        return $txt.'...';
	    }
	}


	/*********************/
	/* GENERIC BOX WIDTH */
	/*********************/
	protected function genBoxWidth($columns=2, $num_intro=0, $otherlinks=1) {
		$w = intval(100/$columns);
		$totalboxes = $num_intro + $otherlinks;
		return ($w - $this->wfactor);
	}


	/*********************/
	/* CURRENT BOX WIDTH */
	/*********************/
	public function boxWidth($r=0, $rcounter, $columns=2, $num_intro=0, $otherlinks=1) {
		$totalboxes = $num_intro + $otherlinks;
		$num = $r + 1;

		$currentbox = ($num <= $num_intro) ? $num : $num_intro + $otherlinks;
		$genWidth = $this->genBoxWidth($columns, $num_intro, $otherlinks);
		if ($currentbox < $totalboxes) {
			$w = $genWidth;
		} else {
			$k = (($columns + 1) - ($totalboxes % $columns));
			if ($k > $columns) { $k = $k - $columns; }
			$w = $genWidth * $k;
		}
		return $w;
	}

}

global $mosConfig_offset, $mainframe, $lang, $my, $Itemid;

$count = intval($params->get( 'count', 10 ));
$columns = intval($params->get( 'columns', 2 ));
if ($columns > 4) {$columns = 4; }
$readmore = intval($params->get( 'readmore', 0 ));
$show_thumbs = intval($params->get( 'show_thumbs', 0 ));
$thumb_width = intval($params->get('thumb_width', 64 ));
$thumb_height = intval($params->get('thumb_height', 64));
$keepratio = intval($params->get( 'keepratio', 0 ));
$textlimit = intval($params->get( 'textlimit', 0 ));
$num_intro = intval($params->get( 'num_intro', 1) );
$title_link = intval($params->get( 'title_link', 1 ));
$cat_title = intval($params->get( 'cat_title', 1 ));
$sections = $params->get( 'sections', '' ) ;
$categories = $params->get( 'categories', '' ) ;
$orderby = (intval($params->get( 'order', 1))) ? 'a.hits' : 'a.created';
$show_front	= intval($params->get( 'show_front', 0 ));
$period = intval($params->get( 'period', 900 ));
$show_author = intval($params->get( 'show_author', 0 ));
$show_date = intval($params->get( 'show_date', 0 ));
$wfactor = intval($params->get( 'wfactor', 2 ));

$modfpg = new moduleFrontpage($wfactor);

$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*3600 );
$access = !$mainframe->getCfg( 'shownoauth' );

$whereCatid = '';
if ($categories != '') {
	$catids = explode( ',', $categories );
	mosArrayToInts( $catids );
	if (count($catids) > 0) {
		$whereCatid = "\n AND a.catid IN (".implode(',', $catids).")";
	}
}

$whereSecid = '';
if ($sections != '') {
	$secids = explode( ',', $sections );
	mosArrayToInts( $secids );
	if (count($secids) > 0) {
		$whereSecid = "\n AND a.sectionid IN (".implode(',', $secids).")";
	}
}

$thentime = time() + ($mosConfig_offset * 3600) - ($period * 24 * 3600);
$thendate = date('Y-m-d H:i:s', $thentime);
$query = "SELECT a.*, u.name, cc.image AS catimage, cc.name AS catname, cc.seotitle AS seocat, s.seotitle AS seosec"
	."\n FROM #__content a"
	."\n LEFT JOIN #__content_frontpage f ON f.content_id = a.id"
	."\n LEFT JOIN #__users u ON u.id = a.created_by"
	."\n INNER JOIN #__categories cc ON cc.id = a.catid"
	."\n INNER JOIN #__sections s ON s.id = a.sectionid"
	."\n WHERE a.state = 1 AND a.sectionid > 0"
	."\n AND ( a.publish_up = '1979-12-19 00:00:00' OR a.publish_up <= '".$now."' )"
	."\n AND ( a.publish_down = '2060-01-01 00:00:00' OR a.publish_down >= '".$now."' )"
	.( $access ? "\n AND a.access IN (".$my->allowed.") AND cc.access IN (".$my->allowed.") AND s.access IN (".$my->allowed.")" : '' )
	.$whereCatid
	.$whereSecid
	."\n AND ((a.language IS NULL) OR (a.language LIKE '%$lang%'))"
	."\n AND ((cc.language IS NULL) OR (cc.language LIKE '%$lang%'))"
	."\n AND ((s.language IS NULL) OR (s.language LIKE '%$lang%'))"
	."\n AND a.created >= '".$thendate."'"
	.( $show_front == '0' ? "\n AND f.content_id IS NULL" : '' )
	."\n AND s.published = 1"
	."\n AND cc.published = 1"
	."\n ORDER BY ".$orderby." DESC";
$database->setQuery( $query, '#__', $count, 0 );
$rows = $database->loadObjectList();

$rcounter = count($rows);
$otherlinks = ($rcounter <= $num_intro) ? 0 : 1 ;
if ($num_intro > $rcounter) { $num_intro = $rcounter; }
if ($columns > $rcounter) { $columns = $rcounter; }

$counter = $num_intro;
for ( $r = 0; $r < $rcounter; $r++) {
	$row = &$rows[$r];

	if ($show_thumbs && $counter) {
		if (trim($row->images) != '') { //ok we have a mosimage, skip row
			$row->introtext = preg_replace("#<img\s*.*?>#i", '', $row->introtext);
			$row->introtext= preg_replace("#{[^}]*}#","",$row->introtext);
			$row->introtext = strip_tags($row->introtext,'');
			if ($textlimit > 0) { $row->introtext = $modfpg->limittext($row->introtext,$textlimit); }
			continue;
		}
		preg_match_all("#<img\s*.*?>#i", $row->introtext.$row->maintext, $txtimg);
		if (!empty($txtimg[0])) {
			foreach ($txtimg[0] as $imgtag) {
				$row->introtext = eUTF::utf8_str_replace($imgtag, '', $row->introtext);
				if (trim($row->images) != '') { continue; } //we only need one image
				preg_match_all("#src=\"([\-\/\_A-Za-z0-9\.\:]+)\"#",$imgtag,$result);
				$row->images = $result[1][0];
			}
		}
	}
	$row->introtext= preg_replace("#{[^}]*}#",'',$row->introtext);
	$row->introtext = strip_tags($row->introtext,'');
  	if ($textlimit > 0) { $row->introtext = $modfpg->limittext($row->introtext,$textlimit); }
	$counter--;
}

$openrow = 0;
$opencell = 0;

if ($rows) {
	echo '<div class="modfpg-container">'._LEND;
	for ( $r = 0; $r < $rcounter; $r++) {
		$row = &$rows[$r];

		$j = $r+1;
		$seolink = '';
		$_Itemid = $Itemid;
		if (($mainframe->getCfg('sef') == 2) && ($row->seocat != '') && ($row->seosec != '')) {
			$seolink = $row->seosec.'/'.$row->seocat.'/'.$row->seotitle.'.html';
		} else {
			$_Itemid = $mainframe->getItemid($row->id);
		}
		$itemlink = sefRelToAbs('index.php?option=com_content&task=view&id='.$row->id.'&Itemid='.$_Itemid, $seolink);

		//check if I must open row
		if (!$openrow) {
			echo '<div class="modfpg-row">'._LEND;
			$openrow = 1;
		}

		//check if I must open box
		if (!$opencell) {
			$w = $modfpg->boxWidth($r, $rcounter, $columns, $num_intro, $otherlinks);
			echo '<div class="modfpg-box" style="width: '.$w.'%;">'._LEND;
			$opencell = 1;
		}
		
		//Where am i? Am I inside an intro item?
		$inside_intro = ($r < $num_intro) ? 1 : 0;
		if ($inside_intro) {
			if ($cat_title) { echo '<span class="modfpg-ctitle">'.$row->catname.'</span>'._LEND; }
			if ($title_link == 1) {
				echo '<span class="modfpg-introtitle"><a href="'.$itemlink.'" title="'.$row->title.'">'.$row->title.'</a></span>'._LEND;
			} else {
				echo '<span class="modfpg-introtitle">'.$row->title.'</span>'._LEND;
			}
			echo '<br />'._LEND;

			if ($show_date || $show_author) {
				echo '<span class="modfpg-authordate">';
				if ($show_date) {
					echo mosFormatDate ($row->created, _GEM_DATE_FORMLC);
				}
				if ($show_date && $show_author) { echo ' | '; }
	    		if ($show_author) {
					echo ($row->created_by_alias != '') ?  $row->created_by_alias : $row->name;
	    		}
				echo '</span>'._LEND;
				echo '<br />'._LEND;
			}

			if ($show_thumbs == 1) {
				echo '<a href="'.$itemlink.'" title="'.$row->title.'">';
				if (!empty($row->images)) {
					if (preg_match('#^(http\:\/\/)#', $row->images)) { //url link from custom image
						if (strstr($row->images, $mainframe->getCfg('live_site').'/images/')) { //in this site --> gd resize
							$simg = str_replace($mainframe->getCfg('live_site').'/images/', '', $row->images);
							$iurl = $mainframe->getCfg('ssl_live_site').'/includes/thumb.php?fi=';
							$iurl .= base64_encode($thumb_width.','.$thumb_height.','.$keepratio.',images/'.$simg);
							$image = '<img src="'.$iurl.' " width="'.$thumb_width.'" height="'.$thumb_height.'" class="modfpg-img" alt="'.$row->title.'" />';
						} else { //in other site -> html resize
							$image = '<img src="'.$row->images.'" width="'.$thumb_width.'" height="'.$thumb_height.'" class="modfpg-img" alt="'.$row->title.'" />';
						}
					} else { //relative path
						$img = preg_split('/\|/', $row->images); //split mambot
						$simg = strip_tags($img[0]); //make safe
						if (file_exists($mainframe->getCfg('absolute_path').'/images/stories/'.$simg)) { //mambot
							$iurl = $mainframe->getCfg('ssl_live_site').'/includes/thumb.php?fi=';
							$iurl .= base64_encode($thumb_width.','.$thumb_height.','.$keepratio.',images/stories/'.$simg);
							$image = '<img src="'.$iurl.'" width="'.$thumb_width.'" height="'.$thumb_height.'" class="modfpg-img" alt="'.$simg.'" />';
						} else if (file_exists($mainframe->getCfg('absolute_path').'/images/'.$simg)) { //relative image
							$iurl = $mainframe->getCfg('ssl_live_site').'/includes/thumb.php?fi=';
							$iurl .= base64_encode($thumb_width.','.$thumb_height.','.$keepratio.',images/'.$simg);
							$image = '<img src="'.$iurl.'" width="'.$thumb_width.'" height="'.$thumb_height.'" class="modfpg-img" alt="'.$simg.'" />';
						} else {
							//display default image
							$image = '<img src="'.$mainframe->getCfg('ssl_live_site').'/images/M_images/story.png" width="'.$thumb_width.'" height="'.$thumb_height.'" class="modfpg-img" alt="'.$row->title.'" />';
						}
					}
					echo $image;
				} else if ($row->catimage != '') {
					$iurl = $mainframe->getCfg('ssl_live_site').'/includes/thumb.php?fi=';
					$iurl .= base64_encode($thumb_width.','.$thumb_height.','.$keepratio.',images/stories/'.$row->catimage);
					echo '<img src="'.$iurl.' " width="'.$thumb_width.'" height="'.$thumb_height.'" class="modfpg-img" alt="'.$row->seocat.'" />';
				} else {
					echo '<img src="'.$mainframe->getCfg('ssl_live_site').'/images/M_images/story.png" width="'.$thumb_width.'" height="'.$thumb_height.'" class="modfpg-img" alt="'.$row->title.'" />';
				}
				echo '</a>'._LEND;
			}	
			echo $row->introtext;
			echo '<br />'._LEND;
			if ($readmore) {
				echo '<a class="modfpg-more" href="'.$itemlink.'" title="'._READ_MORE.'">'._MORE.'</a>'._LEND;
			}
		} else { //I am inside the otheritems box
			if ($r == $num_intro) {
				echo '<span class="modfpg-ctitle">'._E_ALSOREAD.'</span>'._LEND;
				echo '<ul class="modfpg-ul">'._LEND;
			}
			echo '<li><a href="'.$itemlink.'" title="'.$row->title.'">'.$row->title.'</a></li>'._LEND;
			if ($j == $rcounter) {
				echo '</ul>'._LEND;
			}
		}

		//check if I must close box
		if ($opencell && (($r < $num_intro) || ($j == $rcounter))){
			echo '</div>'._LEND;
			$opencell = 0;
		}

		//check if I must close row
		if ($openrow && ((is_integer($j/$columns) && ($j <= $num_intro)) || ($j == $rcounter))) {
			echo '</div>'._LEND;
			$openrow = 0;
		}
	}
	echo '</div>'._LEND;
	echo '<div class="clear"></div>'._LEND;
}

?>