<?php 
/** 
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Search
* @author: Ioannis Sannos (Elxis Team)
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class search_html {

	/******************/
	/* DISPLAY HEADER */
	/******************/
	public static function showhead($searchword, $lists, $params) {
		global $Itemid;

		$r = rand(100,999);
		$dir = _GEM_RTL ? ' dir="rtl"' : '';

		if ($params->get('page_title')) {
			echo '<h1 class="componentheading'.$params->get('pageclass_sfx').'">'.$params->get('header').'</h1>'._LEND;
		}
?>

		<form action="<?php echo sefRelToAbs('index.php', 'search.html'); ?>" method="post" name="searchform">
		<fieldset class="contentpaneopen<?php echo $params->get('pageclass_sfx'); ?>" style="padding: 2px;">
			<legend><?php echo _E_SEARCH; ?></legend>
			<label for="searchword<?php echo $r; ?>"<?php echo $dir; ?>><?php echo _E_SEARCH_KEYWORD; ?>:</label> 
			<input type="text" name="searchword" id="searchword<?php echo $r; ?>" size="20" value="<?php echo stripslashes($searchword); ?>" class="inputbox" title="<?php echo _E_SEARCH_KEYWORD; ?>" /> 
			<input type="submit" name="submitsearch" value="<?php echo _E_SEARCH; ?>" class="button" title="<?php echo _E_SEARCH; ?>" /><br /><br />
			<?php echo $lists['searchphrase']; ?><br /><br />
			<label for="ordering"<?php echo $dir; ?>><?php echo _CMN_ORDERING; ?>:</label> 
			<?php echo $lists['ordering']; ?><br /><br />
			<input type="hidden" name="option" value="com_search" />
			<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
		</fieldset>
		</form>

<?php 
	}


	/**************************/
	/* DISPLAY SEARCH RESULTS */
	/**************************/
	public static function showresults($searchword='', $params, $rows, $nav) {
		if ($searchword != '') {
			echo '<p class="searchintro'.$params->get('pageclass_sfx').'">'._LEND;
			echo _E_SEARCH_KEYWORD.' <strong>'.stripslashes($searchword).'</strong>'._LEND;
			echo '<br />'._LEND;
			if ($rows) {
				$from_result = $nav->limitstart + 1;
				if ($nav->limitstart + $nav->limit < $nav->totalrows) {
					$to_result = $nav->limitstart + $nav->limit;
				} else {
					$to_result = $nav->totalrows;
				}
				echo _PN_RESULTS.' <strong>'.$from_result.' - '.$to_result.'</strong> '._PN_OF.' <strong>'.$nav->totalrows.'</strong>'._LEND;
			} else {
				echo _E_NORESULTS._LEND;
			}
			echo '</p>'._LEND;
		}

		if ($rows) {
			$pagination_pos = (int)$params->get('pagination_pos', 0);
			if (!in_array($pagination_pos, array(0, 1, 2))) { $pagination_pos = 0; }
			if (($pagination_pos === 1) || ($pagination_pos === 2)) {
				search_html::pagination($nav, $searchword);
			}
			search_html::populateresults($rows, $params, $nav);
			if (($pagination_pos === 0) || ($pagination_pos === 2)) {
				search_html::pagination($nav, $searchword);
			}
		}

		search_html::conclusion($nav->totalrows, htmlspecialchars($searchword), $params);
	}


	/***************************/
	/* POPULATE SEARCH RESULTS */
	/***************************/
	private static function populateresults($rows, $params, $nav) {
		if (!$rows) { return; }
		echo '<div class="searchresults'.$params->get( 'pageclass_sfx' ).'">'._LEND;
		$k = 0;
		echo '<ul class="table'.$params->get('pageclass_sfx').'">'._LEND;
		foreach ($rows as $row) {
			$targ = ($row->browsernav == 1) ? ' target="_blank"' : '';
			echo '<li class="row'.$k.$params->get('pageclass_sfx').'">'._LEND;
			echo '<a href="'.sefRelToAbs($row->href, $row->seolink).'"'.$targ.' title="'.$row->title.'">';
			echo $row->title.'</a> '._LEND;
			echo '<span class="small'.$params->get('pageclass_sfx').'">('.$row->section.')</span><br />'._LEND;
			echo $row->text.'&#133;<br />'._LEND;
			if ($row->created) {
				$created = mosFormatDate($row->created, '%d %B, %Y');
				echo '<div class="item_createdate'.$params->get('pageclass_sfx').'">'.$created.'</div>'._LEND;
			}
            if (($nav->ordering == 'popular') && $row->hits && ($row->hits > 1)) {
                echo '<div class="item_hits">'.intval($row->hits).' '._E_HITS.'</div>'._LEND;
            }
			echo '</li>'._LEND;
			$k = 1 - $k;
		}
		echo '</ul>'._LEND;
		echo '</div>'._LEND;
		echo '<div style="clear: both;"></div>'._LEND;
	}


	/*************************/
	/* SHOW PAGINATION LINKS */
	/*************************/
	private static function pagination($nav, $searchword) {
		global $lang, $mainframe, $Itemid;

		if ($nav->totalpages < 2) { return; }

		if ($mainframe->getCfg('sef') == 2) {
			if ($lang != $mainframe->getCfg('lang')) {
				$isoslashed = eLOCALE::elxis_iso639($lang).'/';
				$baselink = $mainframe->getCfg('live_site').'/'.$isoslashed.'search.html?';
			} else {
				$baselink = $mainframe->getCfg('live_site').'/search.html?';
			}
		} else {
			$baselink = 'index.php?option=com_search&amp;Itemid='.$Itemid.'&amp;';
		}
		$baselink .= 'searchword='.$searchword;
		if ($nav->searchphrase != 'exact') { $baselink .= '&amp;searchphrase='.$nav->searchphrase; }
		if ($nav->ordering != 'relevant') { $baselink .= '&amp;ordering='.$nav->ordering; }	

		$textdir = (_GEM_RTL) ? ' dir="rtl"' : '';
		$displayed_pages = 10;
		$this_page = $nav->page + 1;

		$start_loop = (floor(($this_page-1)/$displayed_pages))*$displayed_pages+1;
		if ($start_loop + $displayed_pages - 1 < $nav->totalpages) {
			$stop_loop = $start_loop + $displayed_pages - 1;
		} else {
			$stop_loop = $nav->totalpages;
		}

		echo '<div style="text-align: center; margin: 15px 0; clear: both;">'._LEND;
		if ($this_page > 1) {
			$page = ($this_page - 2);
			echo '<a href="'.$baselink.'"'.$textdir.' class="pagenav" title="'._PN_START.'">&lt;&lt; '._PN_START.'</a> '._LEND;
			echo '<a href="'.$baselink.'&amp;page='.$page.'"'.$textdir.' class="pagenav" title="'._CMN_PREV.'">&lt; '._CMN_PREV.'</a> '._LEND;
        } else {
            echo '<span'.$textdir.' class="pagenav">&lt;&lt; '._PN_START.'</span> ';
            echo '<span'.$textdir.' class="pagenav">&lt; '._CMN_PREV.'</span> ';
        }

		for ($i=$start_loop; $i <= $stop_loop; $i++) {
            $page = ($i - 1);
            if ($i == $this_page) {
                echo '<span'.$textdir.' class="pagenav">'.$i.'</span> '._LEND;
            } else {
                echo '<a href="'.$baselink.'&amp;page='.$page.'"'.$textdir.' title="'._PN_PAGE.' '.$i.'" class="pagenav"><strong>'.$i.'</strong></a> '._LEND;
            }
        }

        if ($this_page < $nav->totalpages) {
			$page = $this_page;
            $end_page = ($nav->totalpages-1);
            echo '<a href="'.$baselink.'&amp;page='.$page.'"'.$textdir.' class="pagenav" title="'._CMN_NEXT.'">'._CMN_NEXT.' &gt;</a> '._LEND;
            echo '<a href="'.$baselink.'&amp;page='.$end_page.'"'.$textdir.' class="pagenav" title="'._PN_END.'">'._PN_END.' &gt;&gt;</a>'._LEND;
        } else {
            echo '<span'.$textdir.' class="pagenav">'._CMN_NEXT.' &gt;</span> '._LEND;
            echo '<span'.$textdir.' class="pagenav">'._PN_END.' &gt;&gt;</span>'._LEND;
        }
		echo '</div>'._LEND;
	}


	/*****************************/
	/* DISPLAY SEARCH CONCLUSION */
	/*****************************/
	public static function conclusion($totalRows, $searchword , $params) {
		global $mainframe;

		$show = (int)$params->get('footer', 1);
		if (!$show) { return; }
		echo '<p>'.sprintf(_E_SEARCH_TOTALF, $totalRows)._LEND;
		if ($searchword != '') {
			echo '<br />'._LEND;
			printf(_E_SEARCH_AT, $searchword); 
?>
			&nbsp; <a href="http://www.google.com/search?q=<?php echo stripslashes($searchword); ?>" target="_blank" title="Google">
			<img src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/images/M_images/google.png" border="0" align="top" alt="Google" /></a> &nbsp; 
			<a href="http://search.yahoo.com/search?ei=UTF-8&amp;p=<?php echo stripslashes($searchword); ?>" target="_blank" title="Yahoo">
			<img src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/images/M_images/yahoo.png" border="0" align="top" alt="Yahoo" /></a> &nbsp; 
			<a href="http://en.wikipedia.org/wiki/Special:Search?search=<?php echo stripslashes($searchword); ?>" target="_blank" title="WikiPedia">
			<img src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/images/M_images/wikipedia.png" border="0" align="top" alt="WikiPedia" /></a>
<?php 
		}
		echo '</p>'._LEND;
	}

}
?>