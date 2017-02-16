<?php 
/**
* @version: $Id: pageNavigation.php 55 2010-06-13 08:57:20Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Page Navigation
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Page navigation support class 
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class mosPageNav {
	/** @var int The record number to start dislpaying from */
	public $limitstart = null;
	/** @var int Number of rows to display per page */
	public $limit = null;
	/** @var int Total number of rows */
	public $total = null;
	/** @var string formfield suffix */
	public $sfx = '';


	/***************/
	/* CONSTRUCTOR */
	/***************/
	public function __construct( $total, $limitstart, $limit, $sfx='' ) {
		$this->total = intval( $total );
		$this->sfx = $sfx;
		$this->limitstart = max( $limitstart, 0 );
		$this->limit = max( $limit, 1 );
		if ($this->limit > $this->total) {
			$this->limitstart = 0;
		}
		if (($this->limit-1)*$this->limitstart > $this->total) {
			$this->limitstart -= $this->limitstart % $this->limit;
		}
	}


	/*****************************/
	/* GENERATE LIMIT SELECT BOX */
	/*****************************/
	public function getLimitBox () {
		$limits = array();
		for ($i=5; $i <= 30; $i+=5) {
			$limits[] = mosHTML::makeOption( "$i" );
		}
		$limits[] = mosHTML::makeOption( "50" );

		$html = mosHTML::selectList($limits, 'limit'.$this->sfx, 'class="selectbox" size="1" dir="ltr" onchange="document.adminForm.submit();"', 'value', 'text', $this->limit );
		$html .= _LEND;
		$html .= '<input type="hidden" name="limitstart'.$this->sfx.'" value="'.$this->limitstart.'" />'._LEND;
		return $html;
	}


	public function writeLimitBox () {
		echo $this->getLimitBox();
	}


	public function writePagesCounter() {
		echo $this->getPagesCounter();
	}


	/**************************/
	/* GENERATE PAGES COUNTER */
	/**************************/
	public function getPagesCounter() {
    	global $adminLanguage;

	    $html = '';
		$from_result = $this->limitstart+1;
		if ($this->limitstart + $this->limit < $this->total) {
			$to_result = $this->limitstart + $this->limit;
		} else {
			$to_result = $this->total;
		}
		if ($this->total > 0) {
			$html .= $adminLanguage->A_RESULTS.' '.$from_result.' - '.$to_result.' '.$adminLanguage->A_OF.' '.$this->total._LEND;
		} else {
			$html .= $adminLanguage->A_NORECORDSFOUND._LEND;
		}
		return $html;
	}


	public function writePagesLinks() {
	    echo $this->getPagesLinks();
	}


	/************************/
	/* GENERATE PAGES LINKS */
	/************************/
	public function getPagesLinks() {
    	global $adminLanguage;

	    $html = '';
		$displayed_pages = 10;
		$total_pages = ceil( $this->total / $this->limit );
		$this_page = ceil( ($this->limitstart+1) / $this->limit );
		$start_loop = (floor(($this_page-1)/$displayed_pages))*$displayed_pages+1;
		if ($start_loop + $displayed_pages - 1 < $total_pages) {
			$stop_loop = $start_loop + $displayed_pages - 1;
		} else {
			$stop_loop = $total_pages;
		}

		$textdir = (_GEM_RTL) ? ' dir="rtl"' : '';
		if ($this_page > 1) {
			$page = ($this_page - 2) * $this->limit;
			$html .= '<a href="#beg"'.$textdir.' class="pagenav" title="'.$adminLanguage->A_FIRSTPAGE.'" onclick="javascript: document.adminForm.limitstart'.$this->sfx.'.value=0; document.adminForm.submit();return false;">'.$adminLanguage->A_NAVSTART.'</a> '._LEND;
			$html .= '<a href="#prev"'.$textdir.' class="pagenav" title="'.$adminLanguage->A_PREVIOUSPAGE.'" onclick="javascript: document.adminForm.limitstart'.$this->sfx.'.value='.$page.'; document.adminForm.submit();return false;">'.$adminLanguage->A_NAVPREV.'</a> '._LEND;
		} else {
			$html .= '<span'.$textdir.' class="pagenav">&lt;&lt; '.$adminLanguage->A_START.'</span>'._LEND;
			$html .= '<span'.$textdir.' class="pagenav">&lt; '.$adminLanguage->A_PREVIOUS.'</span>'._LEND;
		}

		for ($i=$start_loop; $i <= $stop_loop; $i++) {
			$page = ($i - 1) * $this->limit;
			if ($i == $this_page) {
				$html .= '<span'.$textdir.' class="pagenav"> '.$i.' </span>'._LEND;
			} else {
				$html .= '<a href="#'.$i.'"'.$textdir.' class="pagenav" onclick="javascript: document.adminForm.limitstart'.$this->sfx.'.value='.$page.'; document.adminForm.submit();return false;"><strong>'.$i.'</strong></a> '._LEND;
			}
		}

		if ($this_page < $total_pages) {
			$page = $this_page * $this->limit;
			$end_page = ($total_pages-1) * $this->limit;
			$html .= '<a href="#next"'.$textdir.' class="pagenav" title="'.$adminLanguage->A_NEXTPAGE.'" onclick="javascript: document.adminForm.limitstart'.$this->sfx.'.value='.$page.'; document.adminForm.submit();return false;">'.$adminLanguage->A_NAVNEXT.'</a> '._LEND;
			$html .= '<a href="#end"'.$textdir.' class="pagenav" title="'.$adminLanguage->A_ENDPAGE.'" onclick="javascript: document.adminForm.limitstart'.$this->sfx.'.value='.$end_page.'; document.adminForm.submit();return false;">'.$adminLanguage->A_NAVEND.'</a> '._LEND;
		} else {
			$html .= '<span'.$textdir.' class="pagenav">'.$adminLanguage->A_NEXT.' &gt;</span>'._LEND;
			$html .= '<span'.$textdir.' class="pagenav">'.$adminLanguage->A_END.' &gt;&gt;</span>'._LEND;
		}
		return $html;
	}


	public function getListFooter() {
    	global $adminLanguage;
    	if (_GEM_RTL == 1) {
    		$a = 'left';
    		$b = 'right';
    	} else {
    		$a = 'right';
    		$b = 'left';
    	}
	    $html = '<table class="adminlist"><tr><th colspan="3">';
		$html .= $this->getPagesLinks();
		$html .= '</th></tr><tr>';
		$html .= '<td nowrap="true" width="48%" align="'.$a.'" style="text-align:'.$a.';">'.$adminLanguage->A_DISPLAY.' #</td>';
		$html .= '<td>' .$this->getLimitBox() . '</td>';
		$html .= '<td nowrap="true" width="48%" align="'.$b.'" style="text-align:'.$b.';">'.$this->getPagesCounter().'</td>';
		$html .= '</tr></table>'._LEND;
  		return $html;
	}


	public function rowNumber( $i ) {
		return $i + 1 + $this->limitstart;
	}


	/****************************/
	/* RETURN ORDERUP ICON LINK */
	/****************************/
	public function orderUpIcon( $i, $condition=true, $task='orderup', $alt='Move Up' ) {
        global $adminLanguage;
		if ( $alt=='Move Up' ){ $alt = $adminLanguage->A_MOVE_UP; }
		if (($i > 0 || ($i+$this->limitstart > 0)) && $condition) {
		    return '<a href="#reorder" onclick="return listItemTask(\'cb'.$i.'\',\''.$task.'\')" title="'.$alt.'">
				<img src="images/uparrow.png" width="12" height="12" border="0" alt="'.$alt.'" />
			</a>';
  		} else {
  		    return '&nbsp;';
		}
	}


	/******************************/
	/* RETURN ORDERDOWN ICON LINK */
	/******************************/
	public function orderDownIcon( $i, $n, $condition=true, $task='orderdown', $alt='Move Down' ) {
        global $adminLanguage;
        if ($alt=='Move Down'){ $alt = $adminLanguage->A_MOVE_DOWN; }
        if (($i < $n-1 || $i+$this->limitstart < $this->total-1) && $condition) {
            return '<a href="#reorder" onclick="return listItemTask(\'cb'.$i.'\',\''.$task.'\')" title="'.$alt.'">
                <img src="images/downarrow.png" width="12" height="12" border="0" alt="'.$alt.'" /></a>';
  		} else {
  		    return '&nbsp;';
		}
	}

}

?>