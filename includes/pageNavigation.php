<?php 
/** 
* @version: $Id: pageNavigation.php 2546 2009-10-05 12:16:18Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Page navigation
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class mosPageNav {

	/** @public int The record number to start dislpaying from */
	public $limitstart = null;
	/** @public int Number of rows to display per page */
	public $limit = null;
	/** @public int Total number of rows */
	public $total = null;
	/** @public string formfield suffix */
	public $sfx = '';
	/** @public int Elxis SEO enabled */
	public $seo = 0;
	/** @public string 2-letter iso code **/
	public $isoc = '';


	/***************/
	/* CONSTRUCTOR */
	/***************/
	public function __construct($total, $limitstart, $limit, $sfx='') {
        global $mainframe, $lang;

		$this->total = intval( $total );
		$this->sfx = $sfx;
		$this->limitstart = max( $limitstart, 0 );
		$this->limit = max( $limit, 0 );
		$this->seo = ($mainframe->getCfg('sef') == 2) ? 1 : 0;
		if (defined('_ELXIS_ADMIN')) { $this->seo = 0; }
		$this->isoc = eLOCALE::elxis_iso639($lang);

		$total_pages = ceil( $this->total / $this->limit );
		$this_page = ceil( ($this->limitstart+1) / $this->limit );
		if ($this_page > $total_pages) { $this->limitstart = (($total_pages - 1) * $this->limit); }
		if ($this->limitstart < 0) { $this->limitstart = 0; }
	}


	/*****************************/
	/* GENERATE SELECT LIMIT BOX */
	/*****************************/
	public function getLimitBox ( $link ) {
        if ($this->seo) { return; }
		$limits = array();
		for ($i=5; $i <= 30; $i+=5) {
			$limits[] = mosHTML::makeOption( "$i" );
		}
		$limits[] = mosHTML::makeOption( "50" );

		// build the html select list
		$link = sefRelToAbs($link.'&amp;limit'.$this->sfx.'=\' + this.options[selectedIndex].value + \'&amp;limitstart'.$this->sfx.'='.$this->limitstart);
		return mosHTML::selectList( $limits, 'limit'.$this->sfx,
		'class="selectbox" size="1" dir="ltr" onchange="document.location.href=\''.$link.'\';"',
		'value', 'text', $this->limit );
	}


	/************************/
	/* HTML WRITE LIMIT BOX */
	/************************/
	public function writeLimitBox ( $link ) {
	    if ($this->seo) { echo $this->limit; return; }
		echo mosPageNav::getLimitBox( $link );
	}


	/****************************/
	/* HTML WRITE PAGES COUNTER */
	/****************************/
	public function writePagesCounter() {
		$txt = '';
		$from_result = $this->limitstart+1;
		if ($this->limitstart + $this->limit < $this->total) {
			$to_result = $this->limitstart + $this->limit;
		} else {
			$to_result = $this->total;
		}
		if ($this->total > 0) {
			$txt .= _PN_RESULTS.' '.$from_result.' - '.$to_result.' '._PN_OF.' '.$this->total;
		}
		return $txt;
	}


	/****************************/
	/* HTML WRITE LEAFS COUNTER */
	/****************************/
	public function writeLeafsCounter() {
		$txt = '';
		$page = $this->limitstart+1;
		if ($this->total > 0) {
			$txt .= _PN_PAGE.' '.$page.' '._PN_OF.' '.$this->total;
		}
		return $txt;
	}


	/************************/
	/* GENERATE PAGES LINKS */
	/************************/
	public function writePagesLinks( $link, $seolink='' ) {
		global $lang, $mainframe;

		$txt = '';
		if (($seolink != '') && (!preg_match('/^(http)/i', $seolink))) {
			$pr = preg_replace('/^(\/)/', '', $seolink);
			$seolink = $mainframe->getCfg('live_site').'/'.$pr;
			unset($pr);
		}

		$displayed_pages = 10;
		$total_pages = ceil( $this->total / $this->limit );
		$this_page = ceil( ($this->limitstart+1) / $this->limit );

		if ($this_page > $total_pages) { $this_page = $total_pages; $this->limitstart = (($total_pages - 1) * $this->limit); }

		$start_loop = (floor(($this_page-1)/$displayed_pages))*$displayed_pages+1;
		if ($start_loop + $displayed_pages - 1 < $total_pages) {
			$stop_loop = $start_loop + $displayed_pages - 1;
		} else {
			$stop_loop = $total_pages;
		}

		$textdir = (_GEM_RTL) ? ' dir="rtl"' : '';
        if ($this->seo && ($seolink != '')) {
        	$seolink = ($lang != $mainframe->getCfg('lang')) ? str_replace($mainframe->getCfg('live_site'), $mainframe->getCfg('live_site').'/'.$this->isoc, $seolink) : $seolink;
			//fix double isoc
			$seolink = str_replace($mainframe->getCfg('live_site').'/'.$this->isoc.'/'.$this->isoc.'/', $mainframe->getCfg('live_site').'/'.$this->isoc.'/', $seolink);
            $symb = preg_match('/\?/', $seolink) ? '&amp;' : '?';
		    if ($this_page > 1) {
			    $page = ($this_page - 2);
			    $txt .= '<a href="'.$seolink.'"'.$textdir.' class="pagenav" title="'._PN_START.'">&lt;&lt; '._PN_START.'</a> ';
			    $txt .= '<a href="'.$seolink.$symb.'page'.$this->sfx.'='.$page.'"'.$textdir.' class="pagenav" title="'._CMN_PREV.'">&lt; '._CMN_PREV.'</a> ';
            } else {
                $txt .= '<span'.$textdir.' class="pagenav">&lt;&lt; '._PN_START.'</span> ';
                $txt .= '<span'.$textdir.' class="pagenav">&lt; '._CMN_PREV.'</span> ';
            }

            for ($i=$start_loop; $i <= $stop_loop; $i++) {
                $page = ($i - 1);					
                if ($i == $this_page) {
                    $txt .= '<span'.$textdir.' class="pagenav">'.$i.'</span> ';
                } else {
                    $txt .= '<a href="'.$seolink.$symb.'page'.$this->sfx.'='.$page.'"'.$textdir.' class="pagenav"><strong>'.$i.'</strong></a> ';
                }
            }

            if ($this_page < $total_pages) {
			    $page = $this_page;
                $end_page = ($total_pages-1);
                $txt .= '<a href="'.$seolink.$symb.'page'.$this->sfx.'='.$page.'"'.$textdir.' class="pagenav" title="'._CMN_NEXT.'">'._CMN_NEXT.' &gt;</a> ';
                $txt .= '<a href="'.$seolink.$symb.'page'.$this->sfx.'='.$end_page.'"'.$textdir.' class="pagenav" title="'._PN_END.'">'._PN_END.' &gt;&gt;</a>';
            } else {
                $txt .= '<span'.$textdir.' class="pagenav">'._CMN_NEXT.' &gt;</span> ';
                $txt .= '<span'.$textdir.' class="pagenav">'._PN_END.' &gt;&gt;</span>';
            }
        } else {
		    $link .= '&amp;limit'.$this->sfx.'='. $this->limit;
            if ($this_page > 1) {
				$page = ($this_page - 2) * $this->limit;
				$linkX = sefRelToAbs($link.'&amp;limitstart'.$this->sfx.'=0');
				$linkY = sefRelToAbs($link.'&amp;limitstart'.$this->sfx.'='.$page);
				if ($this->seo) {
					$linkX = ($lang != $mainframe->getCfg('lang')) ? str_replace($mainframe->getCfg('live_site'), $mainframe->getCfg('live_site').'/'.$this->isoc, $linkX) : $linkX;
					$linkY = ($lang != $mainframe->getCfg('lang')) ? str_replace($mainframe->getCfg('live_site'), $mainframe->getCfg('live_site').'/'.$this->isoc, $linkY) : $linkY;
 				}
 				$txt .= '<a href="'.$linkX.'"'.$textdir.' class="pagenav" title="'._PN_START.'">&lt;&lt; '._PN_START.'</a> ';
				$txt .= '<a href="'.$linkY.'"'.$textdir.' class="pagenav" title="'._CMN_PREV.'">&lt; '._CMN_PREV.'</a> ';
				unset($linkX, $linkY);
			} else {
				$txt .= '<span'.$textdir.' class="pagenav">&lt;&lt; '._PN_START.'</span> ';
				$txt .= '<span'.$textdir.' class="pagenav">&lt; '._CMN_PREV.'</span> ';
			}

			for ($i=$start_loop; $i <= $stop_loop; $i++) {
				$page = ($i - 1) * $this->limit;
				if ($i == $this_page) {
					$txt .= '<span'.$textdir.' class="pagenav">'. $i .'</span> ';
				} else {
					$linkX = sefRelToAbs($link .'&amp;limitstart'.$this->sfx.'='. $page);				
					if ($this->seo) {
						$linkX = ($lang != $mainframe->getCfg('lang')) ? str_replace($mainframe->getCfg('live_site'), $mainframe->getCfg('live_site').'/'.$this->isoc, $linkX) : $linkX;
					}
					$txt .= '<a href="'.$linkX.'"'.$textdir.' class="pagenav"><strong>'. $i .'</strong></a> ';
					unset($linkX);
				}
			}

			if ($this_page < $total_pages) {
				$page = $this_page * $this->limit;
				$end_page = ($total_pages-1) * $this->limit;

				$linkX = sefRelToAbs($link.'&amp;limitstart'.$this->sfx.'='. $page);
				$linkY = sefRelToAbs($link.'&amp;limitstart'.$this->sfx.'='. $end_page);
				if ($this->seo) {
					$linkX = ($lang != $mainframe->getCfg('lang')) ? str_replace($mainframe->getCfg('live_site'), $mainframe->getCfg('live_site').'/'.$this->isoc, $linkX) : $linkX;
					$linkY = ($lang != $mainframe->getCfg('lang')) ? str_replace($mainframe->getCfg('live_site'), $mainframe->getCfg('live_site').'/'.$this->isoc, $linkY) : $linkY;
				}
				$txt .= '<a href="'.$linkX.'"'.$textdir.' class="pagenav" title="'._CMN_NEXT.'">'._CMN_NEXT.' &gt;</a> ';
				$txt .= '<a href="'.$linkY.'"'.$textdir.' class="pagenav" title="'._PN_END.'">'._PN_END.' &gt;&gt;</a>';
				unset($linkX, $linkY);
			} else {
				$txt .= '<span'.$textdir.' class="pagenav">'._CMN_NEXT.' &gt;</span> ';
				$txt .= '<span'.$textdir.' class="pagenav">'._PN_END.' &gt;&gt;</span>';
			}
		}
		return $txt;
	}
}
?>