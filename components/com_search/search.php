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


$usertype = ($my->usertype == '') ? eUTF::utf8_strtolower($acl->get_group_name('29')) : eUTF::utf8_strtolower($my->usertype);
if (($mainframe->getCfg('access') == '1') | ($mainframe->getCfg('access') == '3')) {
	if (!($acl->acl_check('action', 'view', 'users', $usertype, 'components', 'all') ||  
	    $acl->acl_check('action', 'view', 'users', $usertype, 'components', 'com_search'))) {
	    	mosRedirect('index.php', _NOT_AUTH);
	}
}


require_once($mainframe->getCfg('absolute_path').'/components/com_search/search.html.php');


class elxissearch {

	private $params = null;
	private $searchword = '';
	private $searchphrase = 'any'; //any, all, exact
	private $ordering = 'newest'; //newest, oldest, popular, alpha, category
	private $limit = 10;
	private $limitstart = 0;
	private $totalrows = 0;
	private $totalpages = 0;
	private $page = 0;


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
		$this->getcomparams();
		$this->getuserinput();
	}


	/****************************/
	/* GET COMPONENT PARAMETERS */
	/****************************/
	private function getcomparams() {
		global $Itemid, $database, $mainframe;

		if ($Itemid && ($Itemid > 0)) {
			$menu = new mosMenu($database);
			$menu->load($Itemid);
			$this->params = new mosParameters($menu->params);
			$header_title = ($menu->name) ? $menu->name : _E_SEARCH;
			$this->params->def('header', $header_title);
		} else {
			$this->params = new mosParameters('');
			$this->params->def('header', _E_SEARCH);
		}
		$this->params->def('page_title', 1);
		$this->params->def('pageclass_sfx', '');
		$this->params->def('back_button', $mainframe->getCfg('back_button'));
		$this->params->def('pagination_limit', 10);
		$this->limit = (int)$this->params->get('pagination_limit', 10);
		if ($this->limit < 5) { $this->limit = 10; }
		$this->params->def('pagination_pos', 0);
		$this->params->def('footer', 1);
	}


	/**********************/
	/* GET SEARCH KEYWORD */
	/**********************/
	private function getuserinput() {
		global $database;

		$searchword = mosGetParam($_REQUEST, 'searchword', '');
		if ($searchword  != '') {
			$patterns = array('/\$/', '/\#/', '/\^/', '/\'/', '/\"/', '/\&/', '/\`/', '/\</', '/\>/', '/\*/', '/\|/', '/\%/');
			//$searchword = $database->getEscaped(preg_replace($patterns, '', $searchword));
			$searchword = eUTF::utf8_trim(stripslashes(preg_replace($patterns, '', $searchword)));
			$len = eUTF::utf8_strlen($searchword);
			if (($len < 4) || ($len > 40)) { $searchword = ''; }
		}
		$this->searchword = $searchword;
		$this->searchphrase = trim(mosGetParam($_REQUEST, 'searchphrase', 'exact'));
		if (($this->searchphrase == '') || !in_array($this->searchphrase, array('all', 'any', 'exact'))) { $this->searchphrase = 'exact'; }
		$this->ordering = trim(mosGetParam($_REQUEST, 'ordering', ''));
		if (($this->ordering == '') || !in_array($this->ordering, array('newest', 'oldest', 'popular', 'alpha', 'category'))) {
			$this->ordering = 'newest';
		}
	}


	/*****************/
	/* RUN COMPONENT */
	/*****************/
	public function run() {
		global $mainframe;

		$rows = $this->dosearch();

		$lists = array();
		$orders = array();
		$orders[] = mosHTML::makeOption('newest', _E_NEWEST_FIRST);
		$orders[] = mosHTML::makeOption('oldest', _E_OLDEST_FIRST);
		$orders[] = mosHTML::makeOption('popular', _E_MOST_POPULAR);
		$orders[] = mosHTML::makeOption('alpha', _E_ALPHABETICAL);
		$orders[] = mosHTML::makeOption('category', _E_SECTIONCATEG);		
		$lists['ordering'] = mosHTML::selectList($orders, 'ordering', 'class="selectbox" title="'._CMN_ORDERING.'"', 'value', 'text', $this->ordering);
		unset($orders);

		$searchphrases = array();
		$searchphrases[] = mosHTML::makeOption('any', _E_ANYWORDS);
		$searchphrases[] = mosHTML::makeOption('all', _E_ALLWORDS);
		$searchphrases[] = mosHTML::makeOption('exact', _E_PHRASE);
		$lists['searchphrase']= mosHTML::radioList($searchphrases, 'searchphrase', '', $this->searchphrase);
		unset($searchphrases);

		$mainframe->setPageTitle(_E_SEARCH.' - '.$mainframe->getCfg('sitename'));
		$mainframe->setMetaTag('description', _E_SEARCH.' '.$mainframe->getCfg('sitename'));
		$mainframe->setMetaTag('keywords', _E_SEARCH.', '._E_ANYWORDS.', '._E_PHRASE.', '._E_ALPHABETICAL.', '._E_MOST_POPULAR.', '._BUTTON_RESULTS);

		search_html::showhead(htmlspecialchars($this->searchword), $lists, $this->params);

		if (isset($_POST['searchword']) || (isset($_GET['searchword']))) {
			$nav = new stdClass();
			$nav->limit = $this->limit;
			$nav->limitstart = $this->limitstart;
			$nav->totalrows = $this->totalrows;
			$nav->totalpages = $this->totalpages;
			$nav->page = $this->page;
			$nav->searchphrase = $this->searchphrase;
			$nav->ordering = $this->ordering;

			search_html::showresults(htmlspecialchars($this->searchword), $this->params, $rows, $nav);
		}

		echo '<br/>'._LEND;
		mosHTML::BackButton($this->params, 0);
	}


	/*******************************************/
	/* PERFORM SEARCH AND RETURN RESULTS FOUND */
	/*******************************************/
	private function dosearch() {
		global $_MAMBOTS, $mainframe;

		if ($this->searchword == '') { return array(); }

		$_MAMBOTS->loadBotGroup('search');
		$results = $_MAMBOTS->trigger('onSearch', array($this->searchword, $this->searchphrase, $this->ordering));

		$rows = array();
		if ($results) {
			foreach($results as $result) {
				if ($result) { $rows = array_merge($rows, $result); }
			}

			if ($this->ordering == 'popular') { //compatibility
				if ($rows) {
					for ($i=0; $i < count($rows); $i++) {
						if (!isset($rows[$i]->hits)) { $rows[$i]->hits = 1; }
					}
				}
			}

			$this->totalrows = count($rows);
			$this->totalpages = ceil($this->totalrows / $this->limit);
			$this->page = intval(mosGetParam($_REQUEST, 'page', 0));
			if ($this->page > ($this->totalpages - 1)) { $this->page = ($this->totalpages - 1); }
			if ($this->page < 1) { $this->page = 0; }
			$this->limitstart = $this->page * $this->limit;
			if ($this->totalrows <= $this->limit) { $this->limitstart = 0; }

			$rows = $this->orderresults($rows);
			$rows = $this->limitresults($rows);
		}

		if ($this->page == 0) {
			$this->logsearch();
		}

		if ($rows) {
			return $this->prepareresults($rows);
		}
		return array();
	}


	/**********************/
	/* LOG SEARCH KEYWORD */
	/**********************/
	private function logsearch() {
		global $database, $mainframe;

		if (($this->searchword == '') || !$mainframe->getCfg('enable_log_searches')) { return; }
		if ($this->page > 0) { return; } //log only on first page of results
		$database->setQuery("SELECT hits FROM #__core_log_searches WHERE LOWER(search_term)='".$this->searchword."'", '#__', 1, 0);
		$hits = intval($database->loadResult());
		if ($hits) {
			$database->setQuery( "UPDATE #__core_log_searches SET hits='".($hits + 1)."' WHERE LOWER(search_term)='".$this->searchword."'");
			$database->query();
		} else {
			$database->setQuery("INSERT INTO #__core_log_searches VALUES ('".$this->searchword."','1')");
			$database->query();
		}
	}


	/************************/
	/* ORDER SEARCH RESULTS */
	/************************/
	private function orderresults($results) {
		if (!$results) { return $results; }
		switch ($this->ordering) {
			case 'oldest':
				usort($results, array("elxissearch", "cmpoldest"));
			break;
			case 'popular':
				usort($results, array("elxissearch", "cmppopular"));
			break;
			case 'alpha':
				usort($results, array("elxissearch", "cmpalpha"));
			break;
			case 'category':
				usort($results, array("elxissearch", "cmpcategory"));
			break;
			case 'newest':
			default:
				usort($results, array("elxissearch", "cmpnewest"));
			break;
		}
		return $results;
	}


	static private function cmpnewest($a, $b) {
		if ($a->created == $b->created) { return 0; }
		return ($a->created < $b->created) ? 1 : -1;
	}


	static private function cmpoldest($a, $b) {
		if ($a->created == $b->created) { return 0; }
		return ($a->created < $b->created) ? -1 : 1;
	}


	static private function cmpalpha($a, $b) {
		if ($a->title == $b->title) { return 0; }
		return ($a->title > $b->title) ? 1 : -1;
	}


	static private function cmpcategory($a, $b) {
		if ($a->section == $b->section) { return 0; }
		return ($a->section > $b->section) ? 1 : -1;
	}


	static private function cmppopular($a, $b) {
		if ($a->hits == $b->hits) { return 0; }
		return ($a->hits < $b->hits) ? 1 : -1;
	}


	/**************************/
	/* PREPARE SEARCH RESULTS */
	/**************************/
	private function prepareresults($rows) {
		global $mainframe;

		if (!$rows) { return $rows; }
		if ($this->searchphrase == 'exact') {
			$searchwords = array($this->searchword);
			$needle = $this->searchword;
		} else {
			$searchwords = preg_split("/[\s]+/", $this->searchword);
			$needle = $searchwords[0];
		}

		$c = count($rows);
		for ($i=0; $i < $c; $i++) {
			$text = $this->preparecontent($rows[$i]->text, 200, $needle);
			foreach ($searchwords as $hlword) {
				$text = preg_replace('/'.preg_quote($hlword, '/').'/i', "<span class=\"highlight\">\\0</span>", $text); 
			}

			$rows[$i]->text = $text;
			if (!$rows[$i]->seolink) { $rows[$i]->seolink = ''; }
			if (!preg_match('/^(http)/i', $rows[$i]->href)) {
				// determines Itemid for Content items
				if (strstr($rows[$i]->href, 'view')) {
					//tests to see if itemid has already been included - this occurs for typed content items
					if (!strstr($rows[$i]->href, 'Itemid')) {
						$temp = preg_split('/id\=/', $rows[$i]->href);
						$rows[$i]->href = $rows[$i]->href.'&amp;Itemid='.$mainframe->getItemid($temp[1]);
					}
				}
			}
		}
		return $rows;
	}


	/**********************/
	/* REMOVE JS AND BOTS */
	/**********************/
	private function preparecontent($text, $length=200, $searchword) {
		$text = preg_replace("'<script[^>]*>.*?</script>'si", '', $text);
		$text = preg_replace('/{.+?}/', '', $text);
		//$text = preg_replace( '/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is','\2', $text );
		return $this->smartsubstr(strip_tags($text), $length, $searchword);
	}


	/*******************/
	/* SMART SUBSTRING */
	/*******************/
	private function smartsubstr($text, $length=200, $searchword) {
		$wordpos = eUTF::utf8_strpos(eUTF::utf8_strtolower($text), eUTF::utf8_strtolower($searchword));
		$halfside = intval($wordpos - $length/2 - eUTF::utf8_strlen($searchword));
		if ($wordpos && $halfside > 0) {
			 return '...' . eUTF::utf8_substr($text, $halfside, $length);
		} else {
			return eUTF::utf8_substr( $text, 0, $length);
		}
	}


	/*************************/
	/* LIMIT DISPLAY RESULTS */
	/*************************/
	private function limitresults($results) {
		if (!$results) { return $results; }
		return array_slice($results, $this->limitstart, $this->limit);
	}

}


$esearch = new elxissearch();
$esearch->run();
unset($esearch);

?>