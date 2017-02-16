<?php 
/** 
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Content
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (($mainframe->getCfg('access') == 1) || ($mainframe->getCfg('access') == 3)) {
	$usertype = ($my->usertype == '') ? eUTF::utf8_strtolower($acl->get_group_name('29')) : eUTF::utf8_strtolower($my->usertype);
	if (!($acl->acl_check('action', 'view', 'users', $usertype, 'components', 'all') || 
	    $acl->acl_check('action', 'view', 'users', $usertype, 'components', 'com_content') || 
	    $acl->acl_check('action', 'view', 'users', $usertype, 'components', 'com_frontpage'))) {
		echo "<html><head><title>".$mainframe->getCfg('sitename')."</title>"._LEND;
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" /></head>"._LEND;
		echo "<body><div style=\"text-align: center; margin-top: 100px;\ font-size: 0.92em; font-family: tahoma, verdana, arial;\">"._LEND;
		echo "<img src=\"images/logo.png\" border=\"0\" alt=\"logo\" /><br /><br />"._LEND;
		echo "<span style=\"font-size: 1.2em; font-weight: bold;\">".$mainframe->getCfg('sitename')."</span><br />"._LEND;
	    echo "<br /><br />"._NOT_AUTH."</div></body></html>";
	    exit();
	}
}

require_once($mainframe->getCfg('absolute_path').'/components/com_content/content.html.php');


class elxContent {

	private $id = 0;
	private $access = null;
	private $cache = null;
	private $task = '';
	private $pop = 0;
	private $now = '';


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
		global $mainframe;

		$this->id = (int)mosGetParam($_REQUEST, 'id', 0);
		$this->task = strtolower(trim(mosGetParam($_REQUEST, 'task', '')));
		$this->now = date('Y-m-d H:i:s', time() + $mainframe->getCfg('offset') * 3600);
		$this->pop = (int)mosGetParam($_REQUEST, 'pop', 0);
		if ($mainframe->getCfg('caching')) {
			$this->cache =& mosCache::getCache('com_content');
		}
	}


	/*********************/
	/* GET/CREATE ACCESS */
	/*********************/
	private function getAccess() {
		global $acl, $my;

		if (!$this->access) {
			$access = new stdClass();
			$access->canAdd = $acl->acl_check('action', 'add', 'users', $my->usertype, 'content', 'all');
			$access->canEdit = $acl->acl_check('action', 'edit', 'users', $my->usertype, 'content', 'all');
			$access->canEditOwn = $acl->acl_check('action', 'edit', 'users', $my->usertype, 'content', 'own');
			$access->canPublish = $acl->acl_check('action', 'publish', 'users', $my->usertype, 'content', 'all');
			$access->canPublishOwn = $acl->acl_check('action', 'publish', 'users', $my->usertype, 'content', 'own');
			$access->gid = $my->gid; //trick to fix cache
			$this->access = $access;	
		}
		return $this->access;
	}


	/********************/
	/* RUN FOREST, RUN! */
	/********************/
	public function run() {
		global $lang, $option, $my;

		if ($option == 'com_frontpage') {
			if ($this->cache) {
				$this->cache->call('elxcon->frontpage', $my->gid, $this->getAccess(), $this->pop, $lang);
			} else {
				$this->frontpage($my->gid, $this->getAccess(), $this->pop, $lang);
			}
			return;
		}

		switch ($this->task) {
			case 'findkey':
				$this->findKeyItem();
			break;
			case 'view':
        		$this->showItem($this->id, $this->getAccess(), $this->pop, $option);
			break;
			case 'section':
				if ($this->cache) {
					$this->cache->call('elxcon->showSection', $this->id, $this->getAccess(), $lang);
				} else {
					$this->showSection($this->id, $this->getAccess(), $lang);
				}
			break;
			case 'category':
				$sectionid 	= (int)(mosGetParam($_REQUEST, 'sectionid', 0));
				$limit = (int)mosGetParam($_REQUEST, 'limit', 0);
				$limitstart = (int)mosGetParam($_REQUEST, 'limitstart', 0);
				if ($this->cache) {
					$this->cache->call('elxcon->showCategory', $this->id, $this->getAccess(), $sectionid, $limit, $limitstart, $lang);
				} else {
					$this->showCategory($this->id, $this->getAccess(), $sectionid, $limit, $limitstart, $lang);
				}
			break;
			case 'blogsection':
				if ($this->cache) {
					$this->cache->call('elxcon->showBlogSection', $this->id, $this->getAccess(), $this->pop, $lang);
				} else {
					$this->showBlogSection($this->id, $this->getAccess(), $this->pop, $lang);
				}
			break;
			case 'blogcategorymulti':
			case 'blogcategory':
				if ($this->cache) {
					$this->cache->call('elxcon->showBlogCategory', $this->id, $this->getAccess(), $this->pop, $lang);
				} else {
					$this->showBlogCategory($this->id, $this->getAccess(), $this->pop, $lang);
				}
			break;
			case 'archivesection':
				$this->showArchiveSection($this->id, $this->getAccess(), $this->pop, $option);
			break;
			case 'archivecategory':
				$this->showArchiveCategory($this->id, $this->getAccess(), $this->pop, $option);
			break;
			case 'cancel': //not really used, but just in case...
			case 'subcontent':
	    		$this->submittedContent($this->getAccess());
	    	break;
			case 'new':
				$this->editItem(0, $this->getAccess());
			break;
			case 'edit':
				$this->editItem($this->id, $this->getAccess());
			break;
			case 'save':
				$this->saveContent($this->getAccess());
			break;
			case 'emailform':
				$this->emailContentForm();
			break;
			case 'emailsend':
				$this->emailContentSend();
        	break;
        	case 'vote':
				$this->recordVote();
			break;
			case 'pubcomment': //index2.php GET
				$this->publishComment();
			break;
			case 'delcomment': //index2.php GET
				$this->deleteComment();
			break;
			case 'addcomment':
				$this->addComment(); //index2.php POST
			break;
			case 'removenotif': //index2.php POST
				$this->stopnotifications();
			break;
			default:
				if ($this->cache) {
					$this->cache->call('elxcon->showBlogSection', 0, $this->getAccess(), $this->pop, $lang);
				} else {
					$this->showBlogSection(0, $this->getAccess(), $this->pop, $lang);
				}
			break;
		}
	}


	/**********************************************/
	/* SEARCH FOR A CONTENT ITEM BY KEY REFERENCE */
	/**********************************************/
	private function findKeyItem() {
		global $database, $lang, $option;

		$keyref = $database->getEscaped(mosGetParam($_REQUEST, 'keyref', ''));
		if ($keyref == '') {
        	echo '<h1 class="componentheading">Key Reference</h1>'._LEND;
        	elxError('You must define a search keyword!');
        	return;
    	}
		$database->setQuery("SELECT id FROM #__content WHERE attribs LIKE '%keyref=".$keyref."%' AND state = '1'", '#__', 1, 0);
		$id = (int)$database->loadResult();
		if ($id) {
			$this->showItem($id, $this->getAccess(), $this->pop, $option);
		} else {
        	echo '<h1 class="componentheading">Key Reference</h1>'._LEND;
        	elxError('Key <em>'.$keyref.'</em> not found.', 0, '', 'info48.png');
		}
	}


	/********************************/
	/* PREPARE TO DISPLAY FRONTPAGE */
	/********************************/
	public function frontpage($gid, $access, $pop, $lang='english') {
		global $database, $mainframe, $my, $Itemid;

		$noauth = !$mainframe->getCfg('shownoauth');

		$menu = new mosMenu($database);
		$menu->load($Itemid);
		$params = new mosParameters( $menu->params );

		$params->def('comments', $mainframe->getCfg('comments'));
		$order_sec = $this->orderby_sec($params->def('orderby_sec', ''));
		$order_pri = $this->orderby_pri($params->def('orderby_pri', ''));

		$query = "SELECT a.*, ROUND( v.rating_sum / v.rating_count ) AS rating, v.rating_count, u.name AS author, u.usertype,"
    	."\n cc.name AS category, cc.seotitle AS catseotitle, s.name AS section, s.seotitle AS secseotitle, g.name AS groups";
		if ($params->get('comments')) {
			$query .= ", (SELECT COUNT(z.cid) FROM #__comments z WHERE z.origin='1' AND z.articleid = a.id";
			if ($my->gid != 25) { $query .= " AND z.published='1'"; }
			$query .= ") AS comments";
		}
		$query .= "\n FROM #__content a"
		."\n INNER JOIN #__content_frontpage f ON f.content_id = a.id"
		."\n INNER JOIN #__categories cc ON cc.id = a.catid"
		."\n INNER JOIN #__sections s ON s.id = a.sectionid"
		."\n LEFT JOIN #__users u ON u.id = a.created_by"
		."\n LEFT JOIN #__content_rating v ON a.id = v.content_id"
		."\n LEFT JOIN #__core_acl_aro_groups g ON a.access = g.group_id"
		."\n WHERE a.state = '1'"
		."\n AND s.published = '1'"
		."\n AND cc.published = '1'"
		."\n AND ((a.language IS NULL) OR (a.language LIKE '%".$lang."%'))"
		."\n AND ((cc.language IS NULL) OR (cc.language LIKE '%".$lang."%'))"
		."\n AND ((s.language IS NULL) OR (s.language LIKE '%".$lang."%'))"
    	.( $noauth ? "\n AND a.access IN (".$my->allowed.")" : '' )
		."\n AND ( publish_up = '1979-12-19 00:00:00' OR publish_up <= '".$this->now."' )"
		."\n AND ( publish_down = '2060-01-01 00:00:00' OR publish_down >= '".$this->now."' )"
		."\n ORDER BY ".$order_pri.$order_sec;
		$database->setQuery($query);
		$rows = $database->loadObjectList();

		$mainframe->setPageTitle($mainframe->getCfg('sitename'));
		$this->BlogOutput($rows, $params, $access, $pop, $menu);
	}


	/****************************************/
	/* PREPARE(1) TO DISPLAY A CONTENT ITEM */
	/****************************************/
	private function showItem($uid, $access, $pop, $option) {
		global $database, $mainframe, $my, $lang;

		$pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;
		$ora = (in_array($database->_resource->databaseType, array ('oci8', 'oci805', 'oci8po', 'oracle'))) ? 1 : 0;

		$query = "SELECT a.*, ROUND(v.rating_sum/v.rating_count) AS rating, v.rating_count, u.name AS author, u.usertype,"
    	."\n cc.name AS category, cc.seotitle AS catseotitle, s.name AS section, s.seotitle AS secseotitle, g.name AS groups"
		."\n FROM #__content a"
		."\n LEFT JOIN #__categories cc ON cc.id = a.catid";
		if ($pg) {
			$query .= "\n LEFT JOIN #__sections s ON s.id::VARCHAR = cc.section AND s.scope='content'";
		} else if ($ora) {
			$query .= "\n LEFT JOIN #__sections s ON TO_CHAR(s.id) = cc.section AND s.scope='content'";
		} else {
			$query .= "\n LEFT JOIN #__sections s ON s.id = cc.section AND s.scope='content'";
		}
		$query .= "\n LEFT JOIN #__users u ON u.id = a.created_by"
		."\n LEFT JOIN #__content_rating v ON a.id = v.content_id"
		."\n LEFT JOIN #__core_acl_aro_groups g ON a.access = g.group_id"
		."\n WHERE a.id='".$uid."'"
		."\n AND (a.state = '1' OR a.state = '-1')"
		."\n AND (a.publish_up = '1979-12-19 00:00:00' OR a.publish_up <= '".$this->now."')"
		."\n AND (a.publish_down = '2060-01-01 00:00:00' OR a.publish_down >= '".$this->now."')"
    	."\n AND a.access IN (".$my->allowed.")"
		."\n AND ((a.language IS NULL) OR (a.language LIKE '%".$lang."%'))"
		."\n AND ((cc.language IS NULL) OR (cc.language LIKE '%".$lang."%'))"
		."\n AND ((s.language IS NULL) OR (s.language LIKE '%".$lang."%'))";
		$database->setQuery($query, '#__', 1, 0);
		$database->loadObject($row);
		unset($pg, $ora, $query);

		if ($row) {
			$params = new mosParameters($row->attribs);
			$params->set('intro_only', 0);
			$params->def('back_button', $mainframe->getCfg('back_button'));
			if ($row->sectionid == 0) {
				$params->set('item_navigation', 0);
			} else {
				$params->set('item_navigation', $mainframe->getCfg('item_navigation'));
			}
			$params->def('post_comments', 0);

        	//loads the links for Next & Previous Button
			if ($params->get('item_navigation')) {
				$query = "SELECT id FROM #__content WHERE catid = '".$row->catid."'"
				."\n AND state = '".$row->state."' AND ordering < ".$row->ordering." AND access IN (".$my->allowed.")"
            	."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
				."\n ORDER BY ordering DESC";
				$database->setQuery( $query, '#__', 1, 0 );
				$row->prev = $database->loadResult();

				$query = "SELECT id FROM #__content WHERE catid = '".$row->catid."'"
				."\n AND state = '".$row->state."' AND ordering > ".$row->ordering." AND access IN (".$my->allowed.")"
				."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
				."\n ORDER BY ordering ASC";
				$database->setQuery( $query, '#__', 1, 0 );
				$row->next = $database->loadResult();
			}
			$procomments = $pop ? 0 : 1;
			$this->show($row, $params, $access, $pop, $option, 1, 1, $procomments);
		} else {
        	pageNotFound();
			return;
		}
	}


	/*******************************************/
	/* PREPARE TO DISPLAY SECTION (TABLE VIEW) */
	/*******************************************/
	public function showSection($id, $access, $lang='english') {
		global $database, $mainframe, $Itemid, $my;

		$params = new stdClass();
		if ($Itemid) {
			$menu = new mosMenu($database);
			$menu->load($Itemid);
			$params = new mosParameters($menu->params);
		} else {
			$menu = '';
			$params = new mosEmpty();
		}

		$params->set('type', 'section');
		$params->def('page_title', 1);
		$params->def('pageclass_sfx', '');
		$params->def('textclass_sfx', '');
		$params->def('other_cat_section', 1);
		$params->def('other_cat', 1);
		$params->def('empty_cat', 0);
		$params->def('cat_items', 1);
		$params->def('cat_description', 1 );
		$params->def('back_button', $mainframe->getCfg('back_button'));
		$params->def('pageclass_sfx', '');

		$orderby = $this->orderby_sec($params->get('orderby', ''));

		$section = new mosSection($database);
		$section->load($id);

		$params->set('seosec', $section->seotitle);

		$pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;
		$ora = in_array($database->_resource->databaseType, array('oci8', 'oci805', 'oci8po', 'oracle')) ? 1 : 0;

		$query = "SELECT a.*, COUNT( b.id ) AS numitems FROM #__categories a"
		."\n LEFT JOIN #__content b ON b.catid = a.id";
		$query .= "\n AND a.published = '1' AND b.state = '1'"
		."\n AND ( b.publish_up = '1979-12-19 00:00:00' OR b.publish_up <= '".$this->now."' )"
		."\n AND ( b.publish_down = '2060-01-01 00:00:00' OR b.publish_down >= '".$this->now."' )"
		."\n AND ((a.language IS NULL) OR (a.language LIKE '%".$lang."%'))"
		."\n AND ((b.language IS NULL) OR (b.language LIKE '%".$lang."%'))";
		if (!$mainframe->getCfg('shownoauth')) {
        	$query .= "\n AND a.access IN (".$my->allowed.") AND b.access IN (".$my->allowed.")";
    	}

		if ($pg) {
    		$query .= "\n WHERE a.section = '".$section->id."::VARCHAR'";
    	} else if ($ora) {
    		$query .= "\n WHERE a.section = TO_CHAR(".$section->id.")";
		} else {
    		$query .= "\n WHERE a.section = '".$section->id."'";
    	}
		$query .= "\n GROUP BY a.id";
		if ($pg || ($ora)) {
			$query .= ", a.parent_id, a.title, a.name, a.image, a.section, a.image_position, a.description, a.published, 
			a.checked_out, a.checked_out_time, a.editor, a.ordering, a.access, a.count, a.params, a.language, a.seotitle";
		}

		if (!$params->get( 'empty_cat' )) { $query .= "\n HAVING COUNT( b.id ) > 0"; }
		$query .= "\n ORDER BY ".$orderby;
		$database->setQuery( $query );
		$other_categories = $database->loadObjectList();

		//Automatic Meta tags
		$metaKeys = array(_E_SECTION);
		if ($other_categories) {
			$w = 0;
			foreach ($other_categories as $cat) {
				if ($w < 5) { array_push($metaKeys, $cat->title); $w++; }
			}
		}

		$metaDesc = ($section->name != '') ? $section->name.', '.$mainframe->getCfg('sitename') : $section->title.', '.$mainframe->getCfg('sitename');
		$desc = eUTF::utf8_trim($section->description);
		if ($desc != '') {
			$desc = mosHTML::cleanText($desc);
			$desc = eUTF::utf8_str_replace(chr(10), ' ', $desc);
			$desc = eUTF::utf8_str_replace(chr(13), ' ', $desc);
			$desc = eUTF::utf8_str_replace(':', '', $desc);
			$parts = preg_split('/[\s]/', $desc);

			if (count($parts) > 0) {
				$metaDesc = '';
				$w = 0;
				$w2 = 0;
				foreach ($parts as $part) {
					if ($w < 20) {
						$metaDesc .= $part.' ';
						if (($w2 < 5) && (eUTF::utf8_strlen($part) > 4)) { $metaKeys[] = $part; $w2++; }
						$w++;
					}
				}
			}
			unset($parts);
		}

		$mainframe->setPageTitle($section->title.' - '.$mainframe->getCfg('sitename'));
		$mainframe->setMetaTag('description', $metaDesc);
		$mainframe->setMetaTag('keywords', implode(', ',$metaKeys));
		unset($desc, $metaDesc, $metaKeys);

		HTML_content::showContentList($section, NULL, $access, $id, NULL, $params, NULL, $other_categories, NULL);
	}


	/********************************************/
	/* PREPARE TO DISPLAY CATEGORY (TABLE VIEW) */
	/********************************************/
	public function showCategory($id, $access, $sectionid, $limit, $limitstart, $lang='english') {
		global $database, $mainframe, $Itemid, $my;

		$noauth = !$mainframe->getCfg('shownoauth');
		$selected = trim(mosGetParam($_POST, 'order', ''));
		if (($selected != '') && !in_array($selected, array('date','rdate','alpha','ralpha','hits','rhits','author','rauthor','order'))) {
			$selected = '';
		}

		$params = new stdClass();
		if ($Itemid) {
			$menu = new mosMenu($database);
			$menu->load($Itemid);
			$params = new mosParameters($menu->params);
		} else {
			$menu = '';
			$params = new mosParameters('');
		}

		$orderby = ($selected != '') ? $selected : $params->get('orderby', 'rdate');
		$orderby = $this->orderby_sec($orderby);
		$selected = $orderby;

		$params->set('type', 'category');
		$params->def('page_title', 1);
		$params->def('title', 1);
		$params->def('hits', $mainframe->getCfg('hits'));
		$params->def('author', !$mainframe->getCfg('hideAuthor'));
		$params->def('date', !$mainframe->getCfg('hideCreateDate'));
		$params->def('date_format', _GEM_DATE_FORMLC);
		$params->def('navigation', 2);
		$params->def('display', 1);
		$params->def('display_num', $mainframe->getCfg('list_limit'));
		$params->def('other_cat', 1);
		$params->def('empty_cat', 0);
		$params->def('cat_items', 1);
		$params->def('cat_description', 0);
		$params->def('back_button', $mainframe->getCfg('back_button'));
		$params->def('pageclass_sfx', '');
		$params->def('textclass_sfx', '');
		$params->def('headings', 1);
		$params->def('order_select', 1);
		$params->def('filter', 1);
		$params->def('filter_type', 'title');
		$params->def('comments', $mainframe->getCfg('comments'));

		$category = new mosCategory($database);
		$category->load($id);
		if (!$sectionid) { $sectionid = $category->section; }

    	$params->set('seocat', $category->seotitle);
    	$sectiontitle = '';
    	$database->setQuery("SELECT title, seotitle FROM #__sections WHERE id='".$sectionid."'", '#__', 1, 0);
    	$srow = $database->loadRow();
    	if ($srow) {
    		$params->set('seosec', $srow['seotitle']);
    		$sectiontitle = $srow['title'];
    	}
    	unset($srow);
		$pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;
		$ora = in_array($database->_resource->databaseType, array('oci8', 'oci805', 'oci8po', 'oracle')) ? 1 : 0;

		$query = "SELECT c.*, COUNT( b.id ) AS numitems FROM #__categories c"
		. "\n LEFT JOIN #__content b ON b.catid = c.id "
		. "\n WHERE c.section = '".$category->section."'"
		. "\n AND c.published='1' AND b.state='1'"
    	. "\n AND ( b.publish_up = '1979-12-19 00:00:00' OR b.publish_up <= '".$this->now."' )"
    	. "\n AND ( b.publish_down = '2060-01-01 00:00:00' OR b.publish_down >= '".$this->now."' )"
    	. ($noauth ? "\n AND c.access IN (".$my->allowed.")" : '')
    	. ($noauth ? "\n AND b.access IN (".$my->allowed.")" : '')
		. "\n AND ((c.language IS NULL) OR (c.language LIKE '%".$lang."%'))"
		. "\n AND ((b.language IS NULL) OR (b.language LIKE '%".$lang."%'))"
		. "\n GROUP BY c.id";
		if ($pg || $ora) {
			$query .= ', c.parent_id, c.title, c.name, c.image, c.section, c.image_position, c.description, c.published, 
			c.checked_out, c.checked_out_time, c.editor, c.ordering, c.access, c.count, c.params, c.language, c.seotitle';
		}
		if (!$params->get('empty_cat')) { $query .= "\n HAVING COUNT( b.id ) > 0"; }
    	$query .= "\n ORDER BY c.ordering";

		$database->setQuery($query);
		$other_categories = $database->loadObjectList();

    	$and = '';
    	$filter = eUTF::utf8_trim(mosGetParam($_POST, 'filter', ''));
    	if ($filter != '') {
			$filter = $database->getEscaped(eUTF::utf8_strtolower($filter));
			if ($params->get('filter')) {
				switch ($params->get('filter_type')) {
					case 'title':
					$and = "\n AND LOWER( a.title ) LIKE '%".$filter."%'";
					break;
					case 'author':
					$and = "\n AND ( ( LOWER( u.name ) LIKE '%".$filter."%' ) OR ( LOWER( a.created_by_alias ) LIKE '%".$filter."%' ) )";
					break;
					case 'hits':
					$and = "\n AND a.hits LIKE '%".$filter."%'";
					break;
				}
			}
		}
		unset($filter);

		$query = "SELECT COUNT(a.id) FROM #__content a"
		. "\n LEFT JOIN #__users u ON u.id = a.created_by"
		. "\n LEFT JOIN #__core_acl_aro_groups g ON a.access = g.group_id"
		. "\n WHERE a.catid='".$category->id."'"
		. "\n AND a.state='1'"
    	. "\n AND ( a.publish_up = '1979-12-19 00:00:00' OR a.publish_up <= '".$this->now."' )"
    	. "\n AND ( a.publish_down = '2060-01-01 00:00:00' OR a.publish_down >= '".$this->now."' )"
		. ( $noauth ? "\n AND a.access IN (".$my->allowed.")" : '' )
    	. "\n AND ".$category->access." IN (".$my->allowed.")"
		. $and
		. "\n AND ((a.language IS NULL) OR (a.language LIKE '%".$lang."%'))";
		if ($pg || $ora) {
			$gby = str_replace(' DESC', '', $orderby);
			$gby = str_replace(' ASC', '', $gby);
			$query .= "\n GROUP BY ".$gby;
		}
		$query .= "\n ORDER BY ".$orderby;
		$database->setQuery( $query );
		$total = intval($database->loadResult());

    	$limit = $limit ? $limit : $params->get('display_num');

    	if ($mainframe->getCfg('sef') == 2) {
        	$page = intval(mosGetParam($_REQUEST, 'page', 0));
        	if ($page < 1) { $page = 0; }
        	$limitstart = ($page * $limit);
    	}
		if ( $total <= $limit ) { $limitstart = 0; }

		require_once($mainframe->getCfg('absolute_path').'/includes/pageNavigation.php');
		$pageNav = new mosPageNav($total, $limitstart, $limit);

		//get the list of items for this category
		$query = "SELECT a.id, a.title, a.seotitle, a.hits, a.created_by, a.created_by_alias, a.created AS created, a.access, u.name AS author, a.state, g.name AS groups";
		if ($params->get('comments')) {
			$query .= ", (SELECT COUNT(z.cid) FROM #__comments z WHERE z.origin='1' AND z.articleid = a.id";
			if ($my->gid != 25) { $query .= " AND z.published='1'"; }
			$query .= ") AS comments";
		}
		$query .= "\n FROM #__content a"
		."\n LEFT JOIN #__users u ON u.id = a.created_by"
		."\n LEFT JOIN #__core_acl_aro_groups g ON a.access = g.group_id"
		."\n WHERE a.catid='".$category->id."'"
		."\n AND a.state='1'"
    	."\n AND ( a.publish_up = '1979-12-19 00:00:00' OR a.publish_up <= '".$this->now."' )"
    	."\n AND ( a.publish_down = '2060-01-01 00:00:00' OR a.publish_down >= '".$this->now."' )"
    	.( $noauth ? "\n AND a.access IN (".$my->allowed.")" : '' )
		."\n AND ".$category->access." IN (".$my->allowed.")"
		.$and
		."\n AND ((a.language LIKE '%".$lang."%') OR (a.language IS NULL))"
		."\n ORDER BY ".$orderby;
		$database->setQuery($query, '#__', $pageNav->limit, $pageNav->limitstart);
		$items = $database->loadObjectList();

		$check = 0;
		if ($params->get('date')) {
			$order[] = mosHTML::makeOption('date', _DATE.' '._ELANG_ASC);
			$order[] = mosHTML::makeOption('rdate',_DATE.' '._ELANG_DESC);
			$check = 1;
		}
		if ($params->get('title')) {
			$order[] = mosHTML::makeOption('alpha', _E_TITLE.' '._ELANG_ASC);
			$order[] = mosHTML::makeOption('ralpha', _E_TITLE.' '._ELANG_DESC);
			$check = 1;
		}
		if ($params->get('hits')) {
			$order[] = mosHTML::makeOption('hits', _E_HITS.' '._ELANG_ASC);
			$order[] = mosHTML::makeOption('rhits', _E_HITS.' '._ELANG_DESC);
			$check = 1;
		}
		if ($params->get('author')) {
			$order[] = mosHTML::makeOption('author', _HEADER_AUTHOR.' '._ELANG_ASC);
			$order[] = mosHTML::makeOption('rauthor', _HEADER_AUTHOR.' '._ELANG_DESC);
			$check = 1;
		}
		$order[] = mosHTML::makeOption('order', _CMN_ORDERING);
		$lists['order'] = mosHTML::selectList($order, 'order', 'class="selectbox" size="1"  onchange="document.adminForm.submit();"', 'value', 'text', $selected);
		if (!$check) {
			$lists['order'] = '';
			$params->set( 'order_select', 0 );
		}

		$lists['task'] = 'category';
		$lists['filter'] = $filter;
		unset($order, $check, $selected, $filter);

    	//Automatic Meta tags
		$metaKeys = array();
    	$keystring = $category->title;
    	if ($sectiontitle != '') { $keystring .= ' '.$sectiontitle; }
		if ($items) {
			$w = 0;
			foreach ($items as $item) {
				if ($w < 10) { $keystring .= ' '.$item->title; $w++; }
			}
		}

    	$keystring = eUTF::utf8_str_replace('?', '', $keystring);
    	$keystring = eUTF::utf8_str_replace(';', '', $keystring);
    	$keystring = eUTF::utf8_str_replace('!', '', $keystring);
    	$keystring = eUTF::utf8_str_replace(':', '', $keystring);
    	$keystring = eUTF::utf8_str_replace(',', '', $keystring);
    	$keystring = eUTF::utf8_str_replace('.', '', $keystring);
		$kparts = preg_split('/[\s]/', $keystring);
		$w = 0;
		foreach($kparts as $kpart) {
			if (($w < 20) && (eUTF::utf8_strlen($kpart) > 4)) {
	       		array_push($metaKeys, $kpart);
				$w++;
			}
		}
		$metaKeys = array_unique($metaKeys);

		$metaDesc = ($category->name != '') ? $category->name.'. ' : $category->title.'. ';
		$desc = eUTF::utf8_trim($category->description);
		if ($desc != '') {
			$desc = mosHTML::cleanText($desc);
			$desc = eUTF::utf8_str_replace(chr(10), ' ', $desc);
			$desc = eUTF::utf8_str_replace(chr(13), ' ', $desc);
			$desc = eUTF::utf8_str_replace(':', '', $desc);
			$parts = preg_split('/[\s]/', $desc);

			if (count($parts) > 0) {
				$w = 0;
				foreach ($parts as $part) {
					if ($w < 20) { $metaDesc .= $part.' '; $w++; }
				}
			}
		}

		$ttl = ($sectiontitle != '') ? $category->title.' - '.$sectiontitle : $category->title.' - '.$mainframe->getCfg('sitename');
		$mainframe->setPageTitle($ttl);
		$mainframe->setMetaTag('description', $metaDesc);
		$mainframe->setMetaTag('keywords', implode(', ', $metaKeys));
		unset($desc, $metaKeys, $metaDesc, $keystring, $kparts, $w);

		HTML_content::showContentList($category, $items, $access, $id, $sectionid, $params, $pageNav, $other_categories, $lists);
	}


	/******************************************/
	/* PREPARE TO DISPLAY SECTION (BLOG VIEW) */
	/******************************************/
	public function showBlogSection($id=0, $access, $pop, $lang='english') {
		global $database, $mainframe, $Itemid, $my;

		$noauth = !$mainframe->getCfg('shownoauth');
		$params = new stdClass();
		if ($Itemid) {
			$menu = new mosMenu($database);
			$menu->load($Itemid);
			$params = new mosParameters($menu->params);
		} else {
			$menu = "";
			$params = new mosParameters('');
		}
		$params->def('comments', $mainframe->getCfg('comments'));

		//new blog multiple section handling
		if (!$id) { $id = $params->def('sectionid', 0); }
		$where = $this->_where(1, $access, $noauth, $id);

		$order_sec = $this->orderby_sec($params->def('orderby_sec', 'rdate'));
		$order_pri = $this->orderby_pri($params->def('orderby_pri', ''));
		if ($order_sec == 'f.ordering') { $order_sec = 'a.ordering'; }
		if ($order_pri == 'f.ordering') { $order_pri = 'a.ordering'; }

		$query = "SELECT a.*, ROUND( v.rating_sum / v.rating_count ) AS rating, v.rating_count, u.name AS author, u.usertype,"
    	."\n cc.name AS category, cc.seotitle AS catseotitle, s.seotitle AS secseotitle, g.name AS groups";
		if ($params->get('comments')) {
			$query .= ", (SELECT COUNT(z.cid) FROM #__comments z WHERE z.origin='1' AND z.articleid = a.id";
			if ($my->gid != 25) { $query .= " AND z.published='1'"; }
			$query .= ") AS comments";
		}
		$query .= "\n FROM #__content a"
		."\n INNER JOIN #__categories cc ON cc.id = a.catid"
		."\n LEFT JOIN #__users u ON u.id = a.created_by"
		."\n LEFT JOIN #__content_rating v ON a.id = v.content_id"
		."\n LEFT JOIN #__sections s ON a.sectionid = s.id"
		."\n LEFT JOIN #__core_acl_aro_groups g ON a.access = g.group_id"
    	.( count( $where ) ? "\n WHERE ".implode( "\n AND ", $where ) : '' )
    	."\n AND s.access IN (".$my->allowed.")"
    	.( $noauth ? "\n AND a.access IN (".$my->allowed.")" : '' )
		."\n AND cc.published = '1'"
		."\n AND s.published = '1'"
    	."\n AND ((a.language IS NULL) OR (a.language LIKE '%".$lang."%'))"
		."\n AND ((cc.language IS NULL) OR (cc.language LIKE '%".$lang."%'))"
		."\n AND ((s.language IS NULL) OR (s.language LIKE '%".$lang."%'))"
		."\n ORDER BY ".$order_pri.$order_sec;
		$database->setQuery($query);
		$rows = $database->loadObjectList();

    	$phead = $params->def('header', '');
    	if ($phead != '') {
        	$mainframe->setPageTitle($phead);
		} else if ($menu) {
			$mainframe->setPageTitle($menu->name.' - '.$mainframe->getCfg('sitename'));
		} else {
			$mainframe->setPageTitle(_E_SECTION_BLOG.' - '.$mainframe->getCfg('sitename'));
		}
		unset($phead);

		$metaKeys = array(_E_SECTION_BLOG);
		$metaDesc = '';
		if ($rows) {
        	$c = count($rows);
        	$c = ($c > 5) ? 5 : $c;
        	for ($w=0; $w<$c; $w++) {
				$row = $rows[$w];
				if ($row->metakey != '') { $metaKeys = array_merge($metaKeys, explode(',', $row->metakey)); }
				$metaDesc .= ($row->metadesc != '') ? $row->metadesc.' ' : $row->title.' ';
			}
		}

		if ($metaDesc == '') {
			$metaDesc = ($menu) ? $menu->name.', '._E_SECTION_BLOG.', '.$mainframe->getCfg('sitename') : _E_SECTION_BLOG.' '.$mainframe->getCfg('sitename');
		}

		$metaKeys = array_unique($metaKeys);
		if (count($metaKeys) > 15) { $metaKeys = array_slice($metaKeys, 0, 15); }
		if (count($metaKeys) < 4) {
			$metaKeys[] = _E_SECTION;
			$metaKeys[] = 'blog';
		}

		$mainframe->setMetaTag('description', $metaDesc);
		$mainframe->setMetaTag('keywords', implode(', ', $metaKeys));
		unset($metaKeys, $metaDesc);

		$this->BlogOutput($rows, $params, $access, $pop, $menu);
	}


	/*******************************************/
	/* PREPARE TO DISPLAY CATEGORY (BLOG VIEW) */
	/*******************************************/
	public function showBlogCategory($id=0, $access, $pop, $lang='english') {
		global $database, $mainframe, $Itemid, $my;

		$noauth = !$mainframe->getCfg('shownoauth');

		$params = new stdClass();
		if ($Itemid) {
			$menu = new mosMenu($database);
			$menu->load($Itemid);
			$params = new mosParameters($menu->params);
		} else {
			$menu = "";
			$params = new mosParameters('');
		}

		$params->def('comments', $mainframe->getCfg('comments'));

		//new blog multiple section handling
		if (!$id) { $id = $params->def( 'categoryid', 0 ); }

		$where = $this->_where(2, $access, $noauth, $id, $this->now);

		$orderby_pri = $params->def('orderby_pri', '');
		$order_sec = $this->orderby_sec($params->def('orderby_sec', 'rdate'));
		$order_pri = $this->orderby_pri($params->def('orderby_pri', ''));
		if ($order_sec == 'f.ordering') { $order_sec = 'a.ordering'; }
		if ($order_pri == 'f.ordering') { $order_pri = 'a.ordering'; }

		$query = "SELECT a.*, ROUND( v.rating_sum / v.rating_count ) AS rating, v.rating_count, u.name AS author, u.usertype,"
    	."\n cc.name AS category, cc.seotitle AS catseotitle, s.name AS section, s.seotitle AS secseotitle, g.name AS groups";
		if ($params->get('comments')) {
			$query .= ", (SELECT COUNT(z.cid) FROM #__comments z WHERE z.origin='1' AND z.articleid = a.id";
			if ($my->gid != 25) { $query .= " AND z.published='1'"; }
			$query .= ") AS comments";
		}
		$query .= "\n FROM #__content a"
		."\n LEFT JOIN #__categories cc ON cc.id = a.catid"
		."\n LEFT JOIN #__users u ON u.id = a.created_by"
		."\n LEFT JOIN #__content_rating v ON a.id = v.content_id"
		."\n LEFT JOIN #__sections s ON a.sectionid = s.id"
		."\n LEFT JOIN #__core_acl_aro_groups g ON a.access = g.group_id"
		.( count( $where ) ? "\n WHERE ".implode( "\n AND ", $where ) : '' )
    	."\n AND s.access IN (".$my->allowed.")"
    	.( $noauth ? "\n AND a.access IN (".$my->allowed.")" : '' )
		."\n AND cc.published = '1'"
		."\n AND s.published = '1'"
		."\n AND ((a.language LIKE '%$lang%') OR (a.language IS NULL))"
		."\n AND ((cc.language LIKE '%$lang%') OR (cc.language IS NULL))"
		."\n AND ((s.language LIKE '%$lang%') OR (s.language IS NULL))"
		."\n ORDER BY ".$order_pri.$order_sec;
		$database->setQuery( $query );
		$rows = $database->loadObjectList();

		$metaKeys = array();
		$metaDesc = '';
		if ($rows) {
        	$c = count($rows);
        	$c = ($c > 5) ? 5 : $c;
        	for ($w=0; $w<$c; $w++) {
				$row = $rows[$w];
				if ($row->metakey != '') { $metaKeys = array_merge($metaKeys, explode(',', $row->metakey)); }
				$metaDesc .= ($row->metadesc != '') ? $row->metadesc.' ' : $row->title.' ';
			}
		}

		if ($metaDesc == '') {
			$metaDesc = ($menu) ? $menu->name.', '._E_CATEGORY_BLOG.', '.$mainframe->getCfg('sitename') : _E_CATEGORY_BLOG.' '.$mainframe->getCfg('sitename');
		}

		$metaKeys = array_unique($metaKeys);
		if (count($metaKeys) > 20) { $metaKeys = array_slice($metaKeys, 0, 20); }
		if (count($metaKeys) <4) { $metaKeys[] = 'blog'; $metaKeys[] = _E_CATEGORY; }

    	$mainframe->setPageTitle($menu->name);
		$mainframe->setMetaTag('description', $metaDesc);
		$mainframe->setMetaTag('keywords', implode(', ', $metaKeys));
		unset($metaKeys, $metaDesc);

		$this->BlogOutput($rows, $params, $access, $pop, $menu);
	}


	/**************************************/
	/* PREPARE TO DISPLAY ARCHIVE SECTION */
	/**************************************/
	private function showArchiveSection($id=NULL, $access, $pop, $option) {
		global $database, $mainframe, $Itemid, $lang, $my;

		$noauth = !$mainframe->getCfg('shownoauth');

		$year = intval(mosGetParam($_REQUEST, 'year', date('Y')));
		$month = mosGetParam($_REQUEST, 'month', date('m'));

		$params = new stdClass();
		if ($Itemid) {
			$menu = new mosMenu($database);
			$menu->load($Itemid);
			$params = new mosParameters( $menu->params );
		} else {
			$menu = "";
			$params = new mosParameters('');
		}

		$params->def('comments', $mainframe->getCfg('comments'));
		$params->set('intro_only', 1);
		$params->set('year', $year);
		$params->set('month', $month);

		//checks to see if 'All Sections' options used
		$check = ($id == 0) ? '' : " AND sectionid = '".$id."'";

		//query to determine if there are any archived entries for the section
		$database->setQuery("SELECT COUNT(id) FROM #__content WHERE state = '-1'".$check);
		$archives = intval($database->loadResult());

		$metaKeys = array();
		$metaDesc = '';

    	if ($archives) {
        	$order_sec = $this->orderby_sec($params->def('orderby_sec', 'rdate'));
        	$order_pri = $this->orderby_pri($params->def('orderby_pri', ''));
			if ($order_sec == 'f.ordering') { $order_sec = 'a.ordering'; }
			if ($order_pri == 'f.ordering') { $order_pri = 'a.ordering'; }

			$where = $this->_where(-1, $access, $noauth, $id, $year, $month);

        	$query = "SELECT a.*, ROUND(v.rating_sum/v.rating_count) AS rating, v.rating_count, u.name AS author, u.usertype,"
        	."\n cc.name AS category, cc.seotitle AS catseotitle, s.seotitle AS secseotitle, g.name AS groups";
			if ($params->get('comments')) {
				$query .= ", (SELECT COUNT(z.cid) FROM #__comments z WHERE z.origin='1' AND z.articleid = a.id";
				if ($my->gid != 25) { $query .= " AND z.published='1'"; }
				$query .= ") AS comments";
			}
        	$query .= "\n FROM #__content a"
        	."\n INNER JOIN #__categories cc ON cc.id = a.catid"
        	."\n LEFT JOIN #__users u ON u.id = a.created_by"
        	."\n LEFT JOIN #__content_rating v ON a.id = v.content_id"
        	."\n LEFT JOIN #__sections s ON a.sectionid = s.id"
        	."\n LEFT JOIN #__core_acl_aro_groups g ON a.access = g.group_id"
        	.( count( $where ) ? "\n WHERE ". implode( "\n AND ", $where ) : '')
        	."\n AND s.access IN (".$my->allowed.")"
        	.( $noauth ? "\n AND a.access IN (".$my->allowed.")" : '' )
        	."\n AND cc.published = '1'"
        	."\n AND s.published = '1'"
        	."\n AND ((a.language LIKE '%$lang%') OR (a.language IS NULL))"
        	."\n AND ((cc.language LIKE '%$lang%') OR (cc.language IS NULL))"
        	."\n AND ((s.language LIKE '%$lang%') OR (s.language IS NULL))"
        	."\n ORDER BY ".$order_pri.$order_sec;
        	$database->setQuery($query);
        	$rows = $database->loadObjectList();

        	if ($rows) {
            	$c = count($rows);
            	$c = ($c > 5) ? 5 : $c;
            	for ($w=0; $w<$c; $w++) {
                	$row = $rows[$w];
                	if ($row->metakey != '') {
				    	$metaKeys = array_merge($metaKeys, explode(',', $row->metakey));
                	}
                	if ($row->metadesc != '') {
                    	$metaDesc .= $row->metadesc.' ';
                	} else {
                    	$metaDesc .= $row->title.' ';
                	}
            	}
        	}
    	}

		if ($metaDesc == '') {
			$metaDesc = $menu->name.', '._HEADER_SECTION_ARCHIVE.', '.$mainframe->getCfg('sitename');
		} else if (strlen($metaDesc) < 40) {
        	$metaDesc .= _HEADER_SECTION_ARCHIVE;
    	}

		$metaKeys = array_unique($metaKeys);
		if (count($metaKeys) > 20) { $metaKeys = array_slice($metaKeys, 0, 20); }
		if (count($metaKeys) < 4) { $metaKeys[] = 'archive'; $metaKeys[] = _E_SECTION; }

		$mainframe->setPageTitle( $menu->name );
		$mainframe->setMetaTag('description', $metaDesc);
		$mainframe->setMetaTag('keywords', implode(', ', $metaKeys));
		unset($metaDesc, $metaKeys);

		$seopost = '';
		if ($mainframe->getCfg('sef') == 2) {
			if ($rows) {
				$seopost = 'archive/'.$rows[0]->secseotitle.'/';
			} else {
				$database->setQuery("SELECT seotitle FROM #__sections WHERE id='".$id."'", '#__', 1, 0);
				if ($res = $database->loadResult()) { $seopost = 'archive/'.$res.'/'; }
			}
		}


 		echo '<form name="fmarchivesection" action="'.sefRelToAbs('index.php', $seopost).'" method="post">'._LEND;
		if (!$archives) {
			elxError(_CATEGORY_ARCHIVE_EMPTY, 0, '', 'info48.png');
		} else {
			$this->BlogOutput($rows, $params, $access, $pop, $menu, 1);
		}

 		echo '<input type="hidden" name="id" value="'.$id.'" />'._LEND;
		echo '<input type="hidden" name="Itemid" value="'.$Itemid.'" />'._LEND;
 		echo '<input type="hidden" name="task" value="archivesection" />'._LEND;
 		echo '<input type="hidden" name="option" value="com_content" />'._LEND;
 		echo '</form>'._LEND;
	}


	/***************************************/
	/* PREPARE TO DISPLAY ARCHIVE CATEGORY */
	/***************************************/
	private function showArchiveCategory($id=0, $access, $pop, $option) {
		global $database, $mainframe, $Itemid, $lang, $my;

		$noauth = !$mainframe->getCfg('shownoauth');
		$year = intval(mosGetParam( $_REQUEST, 'year', date('Y')));
		$month 	= mosGetParam($_REQUEST, 'month', date('m'));
		$module = intval(mosGetParam($_REQUEST, 'module', 0));

		if ($module) { //used by archive module
			$check = '';
		} else if ($id) {
			$check = " AND catid = '".$id."'";
		} else {
			$check = '';
		}

		if ($Itemid) {
			$menu = new mosMenu($database);
			$menu->load($Itemid);
			$params = new mosParameters($menu->params);
		} else {
			$menu = "";
			$params = new mosParameters('');
		}

		$params->def('comments', $mainframe->getCfg('comments'));
		$params->set('year', $year);
		$params->set('month', $month);

		//query to determine if there are any archived entries for the category
		$database->setQuery( "SELECT COUNT(id) FROM #__content WHERE state = '-1'".$check );
		$archives = intval($database->loadResult());

		$metaKeys = array();
		$metaDesc = '';

    	if ($archives) {
        	$order_sec = $this->orderby_sec($params->def('orderby', 'rdate'));
			if ($order_sec == 'f.ordering') { $order_sec = 'a.ordering'; }

        	$where = $this->_where(-2, $access, $noauth, $id, $year, $month);

        	$query = "SELECT a.*, ROUND( v.rating_sum / v.rating_count ) AS rating, v.rating_count, u.name AS author, u.usertype,"
        	."\n cc.seotitle AS catseotitle, s.name AS section, s.seotitle AS secseotitle, g.name AS groups";
			if ($params->get('comments')) {
				$query .= ", (SELECT COUNT(z.cid) FROM #__comments z WHERE z.origin='1' AND z.articleid = a.id";
				if ($my->gid != 25) { $query .= " AND z.published='1'"; }
				$query .= ") AS comments";
			}
        	$query .= "\n FROM #__content a"
        	."\n INNER JOIN #__categories cc ON cc.id = a.catid"
        	."\n LEFT JOIN #__users u ON u.id = a.created_by"
        	."\n LEFT JOIN #__content_rating v ON a.id = v.content_id"
        	."\n LEFT JOIN #__sections s ON a.sectionid = s.id"
        	."\n LEFT JOIN #__core_acl_aro_groups g ON a.access = g.group_id"
        	.( count( $where ) ? "\n WHERE ". implode( "\n AND ", $where ) : '' )
        	."\n AND s.access IN (".$my->allowed.")"
	    	."\n AND s.published = '1'"
        	."\n AND cc.published = '1'"
        	."\n AND ((a.language LIKE '%".$lang."%') OR (a.language IS NULL))"
        	."\n AND ((s.language LIKE '%".$lang."%') OR (s.language IS NULL))"
        	."\n ORDER BY ".$order_sec;
        	$database->setQuery( $query );
        	$rows = $database->loadObjectList();

        	if ($rows) {
            	$c = count($rows);
            	$c = ($c > 5) ? 5 : $c;
            	for ($w=0; $w<$c; $w++) {
                	$row = $rows[$w];
                	if ($row->metakey != '') { $metaKeys = array_merge($metaKeys, explode(',', $row->metakey)); }
                	$metaDesc .= ($row->metadesc != '') ? $row->metadesc.' ' : $row->title.' ';
				}
        	}
		}

		if ($metaDesc == '') {
			$metaDesc = $menu->name.', '._HEADER_CATEGORY_ARCHIVE.', '.$mainframe->getCfg('sitename');
		} else if (strlen($metaDesc) < 40) {
        	$metaDesc .= _HEADER_CATEGORY_ARCHIVE;
    	}

		$metaKeys = array_unique($metaKeys);
		if (count($metaKeys) > 20) { $metaKeys = array_slice($metaKeys, 0, 20); }
		if (count($metaKeys) < 6) { $metaKeys[] = 'archive'; $metaKeys[] = _E_CATEGORY; }

		$mainframe->setPageTitle($menu->name);
		$mainframe->setMetaTag('description', $metaDesc);
		$mainframe->setMetaTag('keywords', implode(', ', $metaKeys));
		unset($metaKeys, $metaDesc);

		$seopost = '';
		if ($mainframe->getCfg('sef') == 2) {
			if ($rows) {
				$seopost = 'archive/'.$rows[0]->secseotitle.'/'.$rows[0]->catseotitle.'/';
			} else {
				$queryseo = "SELECT c.seotitle AS catseotitle, s.seotitle AS secseotitle FROM #__categories c"
				."\n LEFT JOIN #__sections s ON s.id=c.section WHERE c.id='".$id."'";
				$database->setQuery($queryseo, '#__', 1, 0);
				if ($res = $database->loadRow()) {
					$seopost = 'archive/'.$res['secseotitle'].'/'.$res['catseotitle'].'/';
				}
			}
		}

 		echo '<form name="fmarchivecategory" action="'.sefRelToAbs('index.php', $seopost).'" method="post">'._LEND;
		if (!$archives) {
			elxError(_CATEGORY_ARCHIVE_EMPTY, 0, '', 'info48.png');
		} else {
			$this->BlogOutput($rows, $params, $access, $pop, $menu, 1);
		}

 		echo '<input type="hidden" name="id" value="'.$id.'" />'._LEND;
		echo '<input type="hidden" name="Itemid" value="'.$Itemid.'" />'._LEND;
 		echo '<input type="hidden" name="task" value="archivecategory" />'._LEND;
 		echo '<input type="hidden" name="option" value="com_content" />'._LEND;
 		echo '</form>'._LEND;
	}


	/*********************************************/
	/* DISPLAY BLOG OUTPUT (SECTIONS/CATEGORIES) */
	/*********************************************/
	private function BlogOutput($rows, $params, $access, $pop, $menu, $archive=NULL) {
		global $mainframe, $Itemid, $option, $database;

		if ($params->get('page_title', 1) && $menu) {
			$header = $params->def('header', $menu->name);
		} else {
			$header = '';
		}
		$columns = $params->def('columns', 1);
		if ($columns == 0) {
        	$columns = 1;
    	} elseif ($columns > 2) {
        	$columns = 2;
    	}

		$intro = $params->def('intro', 4);
		$leading = $params->def('leading', 1);
		$links = $params->def('link', 4);
		$pagination = $params->def('pagination', 2);
		$pagination_results = $params->def('pagination_results', 1);
		$pagination_results = $params->def('pagination_results', 1);
		$descrip = $params->def('description', 1 );
		$descrip_image = $params->def('description_image', 1);
		//needed for back button for page
		$back = $params->get('back_button', $mainframe->getCfg('back_button'));
		//needed to disable back button for item
		$params->set('back_button', 0);
		$params->def('pageclass_sfx', '');
		$params->set('intro_only', 1);

		$total = count($rows);

		//pagination support
    	$limit = $intro + $leading + $links;
    	if ($mainframe->getCfg('sef') == 2) {
			$page = intval(mosGetParam($_REQUEST, 'page', 0));
        	if ($page < 1) { $page = 0; }
        	$limitstart = ($page * $limit);
    	} else {
        	$limitstart = intval(mosGetParam( $_REQUEST, 'limitstart', 0 ));
    	}
    	if ( $total <= $limit ) { $limitstart = 0; }
    	$i = $limitstart;

		//needed to reduce queries used by getItemid
		$ItemidCount['bs'] 	= $mainframe->getBlogSectionCount();
		$ItemidCount['bc'] 	= $mainframe->getBlogCategoryCount();
		$ItemidCount['gbs'] = $mainframe->getGlobalBlogSectionCount();

		//used to display section/catagory description text and images currently not supported in Archives
		if ($menu && $menu->componentid && ($descrip || $descrip_image)) {
			switch ($menu->type) {
				case 'content_blog_section':
					$description = new mosSection($database);
					$description->load($menu->componentid);
				break;
				case 'content_blog_category':
					$description = new mosCategory($database);
					$description->load($menu->componentid);
				break;
				default:
					$menu->componentid = 0;
				break;
			}
		}

		if ($header) {
			echo '<h1 class="componentheading'.$params->get('pageclass_sfx').'">'.$header.'</h1>'._LEND;
		}

		if ($archive) {
			echo mosHTML::monthSelectList('month', 'size="1" class="selectbox" title="Month" ', $params->get('month'));
			echo mosHTML::integerSelectList(2000, date('Y'), 1, 'year', 'size="1" class="selectbox" title="Year"', $params->get('year'), "%04d");
			echo '<input type="submit" name="submitarchive" class="button" />';
		}

		//checks to see if there are there any items to display
		if ($total) {
			if ($archive) {
				//Search Success message
				$m = intval($params->get('month'));
				$y = intval($params->get('year'));
				if ($m && $y) {
					$ts = mktime(1, 0, 0, $m, 1, $y);
					$msg = sprintf(_ARCHIVE_SEARCH_SUCCESS, eLocale::strftime_os("%B", $ts), $y);
				} else {
					$msg = sprintf(_ARCHIVE_SEARCH_SUCCESS, $m, $y);
				}
				echo '<br /><br /><div style="text-align: center;">'.$msg.'</div><br /><br />'._LEND;
			}

			//Section/Category Description & Image
			if ($menu && $menu->componentid && ($descrip || $descrip_image)) {
				$link = $mainframe->getCfg('ssl_live_site').'/images/stories/'.$description->image;
            	echo '<div class="blog'.$params->get('pageclass_sfx').'">'._LEND;
				if ($descrip_image && $description->image) {
					echo '<img src="'.$link.'" align="'.$description->image_position.'" hspace="6" alt="'.$description->title.'" />'._LEND;
				}
				if ($descrip && $description->description) { echo $description->description; }
				echo '</div>'._LEND;
				echo '<div style="clear: both;"></div>'._LEND;
        	}

			//Leading story output
			if ($leading) {
				for ($z = 0; $z < $leading; $z++) {
					if ($i >= $total ) { break; }
					echo '<div class="blogleading'.$params->get('pageclass_sfx').'">'._LEND;
					$this->show($rows[$i], $params, $access, $pop, $option, $ItemidCount, 0);
					echo '</div>'._LEND;
					echo '<div style="clear: both;"></div>'._LEND;
					$i++;
				}
			}

        	$blogcstart = ($columns == 2) ? '<div class="blogcell'.$params->get( 'pageclass_sfx' ).'">' : '';
        	$blogcend = ($columns == 2) ? '</div>' : '';

        	if ($intro && ( $i < $total)) {
            	echo '<div class="blog'.$params->get( 'pageclass_sfx' ).'">'._LEND;
            	for ($z = 0; $z < $intro; $z++) {
                	if ($i >= $total) { break; }
                	$obrow = 0;
                	if (!( $z % $columns ) || $columns == 1) {
				    	echo '<div class="blogrow'.$params->get( 'pageclass_sfx' ).'">'._LEND;
				    	$obrow = 1;
					}

                	//outputs either intro or only a link
                	echo $blogcstart._LEND;
                	if ( $z < $intro ) {
                    	$this->show($rows[$i], $params, $access, $pop, $option, $ItemidCount, 0, 0);
                	} else {
                    	echo '&nbsp;'.$blogcend._LEND;
                    	break;
                	}
                	echo $blogcend._LEND;

                	if ( !( ($z + 1) % $columns ) || $columns == 1 ) { echo '</div>'._LEND; $obrow = 0; }
                	$i++;
            	}
            	if ($obrow) { echo '</div>'._LEND; }
            	echo '</div>'._LEND;
            	echo '<div class="clear"></div>'._LEND;        
        	}

			//Links output
			if ($links && ($i < $total)) {
            	echo '<div class="blog_more'.$params->get( 'pageclass_sfx' ).'">'._LEND;
            	HTML_content::showLinks($rows, $links, $total, $i, 1, $ItemidCount);
            	echo '</div>'._LEND;
        	}

			//Pagination output
			if ($pagination) {
				if (($pagination == 2 ) && ($total <= $limit)) {
					//not visible when they is no 'other' pages to display
				} else {
					//get the total number of records
					$limitstart = $limitstart ? $limitstart : 0;
					require_once($mainframe->getCfg('absolute_path').'/includes/pageNavigation.php' );
					$pageNav = new mosPageNav( $total, $limitstart, $limit );

					if ($option == 'com_frontpage') {
						$link = 'index.php?option=com_frontpage&amp;Itemid='.$Itemid;
						$seolink = '/';
					} elseif ($archive) {
						$year = intval($params->get('year'));
						$month = $params->get('month');
                    	$link = 'index.php?option=com_content&task='.$this->task.'&id='.$this->id.'&Itemid='.$Itemid.'&year='.$year.'&month='.$month;
                    	$seolink = 'archive/'.$year.$month.'/';
					} else {
						$link = 'index.php?option=com_content&task='.$this->task.'&id='.$this->id.'&Itemid='.$Itemid;
                    	$seolink = sefRelToAbs($link);
					}

					echo '<div class="sectiontablefooter'.$params->get('pageclass_sfx').'">'._LEND;
					echo $pageNav->writePagesLinks($link, $seolink);
					if ($pagination_results) {
						echo '<br />'._LEND;
                    	echo $pageNav->writePagesCounter();
					}
					echo '</div>'._LEND;
				}
			}
			echo '<div style="clear: both;"></div>'._LEND;
		} else if ($archive && !$total) {
			$m = intval($params->get('month'));
			$y = intval($params->get('year'));
			if ($m && $y) {
				$ts = mktime(1, 0, 0, $m, 1, $y);
				$msg = sprintf(_ARCHIVE_SEARCH_FAILURE, eLocale::strftime_os("%B", $ts), $y);
			} else {
				$msg = sprintf(_ARCHIVE_SEARCH_FAILURE, $m, $y);
			}
        	elxError($msg, 0, '', 'info48.png');
        	$kback = 1;
		} else {
			//Generic blog empty display
			elxError(_EMPTY_BLOG, 0, '', 'info48.png');
			$kback = 1;
		}

    	if (!isset($kback)) {
			$params->set( 'back_button', $back );
			mosHTML::BackButton ( $params );
		}
	}


	/***************************************/
	/* PREPARE (2) TO DISPLAY CONTENT ITEM */
	/***************************************/
	private function show($row, $params, $access, $pop, $option, $ItemidCount=NULL, $makeMeta=1, $procomments=0) {
		global $database, $mainframe, $Itemid, $my, $lang, $cache;

		$noauth = !$mainframe->getCfg('shownoauth');

		if (!intval($row->id) || ($row->state == 0)) { pageNotFound(); return; }
		if (!in_array($row->access, explode(',', $my->allowed))) {
			if ($noauth) {
				mosNotAuth();
				return;
			} elseif (!$params->get('intro_only')) {
				mosNotAuth();
				return; 
			}
		}

		$params->def('link_titles', $mainframe->getCfg('link_titles'));
		$params->def('author', !$mainframe->getCfg('hideAuthor'));
		$params->def('createdate', !$mainframe->getCfg('hideCreateDate'));
		$params->def('modifydate', !$mainframe->getCfg('hideModifyDate'));
		$params->def('print', !$mainframe->getCfg('hidePrint'));
		$params->def('rtf', !$mainframe->getCfg('hideRtf'));
		$params->def('pdf', !$mainframe->getCfg('hidePdf'));
		$params->def('email', !$mainframe->getCfg('hideEmail'));
		$params->def('rating', $mainframe->getCfg('vote'));
		$params->def('icons', $mainframe->getCfg('icons'));
		$params->def('readmore', $mainframe->getCfg('readmore'));
		$params->def('comments', 0);
		$params->def('image', 1);
		$params->def('section', 0);
		$params->def('section_link', 0);
		$params->def('category', 0);
		$params->def('category_link', 0);
		$params->def('introtext', 1);
		$params->def('pageclass_sfx', '');
		$params->def('textclass_sfx', '');
		$params->def('item_title', 1);
		$params->def('url', 1);

		$row->categorytxt = $row->category;
		$row->sectiontxt = $row->section;

		if ($params->get('section_link')) {
        	$query = "SELECT id, type FROM #__menu WHERE componentid = '".$row->sectionid."' AND published='1'"
        	."\n AND ((type = 'content_section') OR (type = 'content_blog_section') OR (type = 'content_archive_section'))"
        	."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
			$database->setQuery($query, '#__', 1, 0);
			$menuinfo = $database->loadRow();

        	if ($menuinfo) {
            	$_Itemid = intval($menuinfo['id']);
            	switch($menuinfo['type']) {
                	case 'content_blog_section':
                	$link = 'index.php?option=com_content&task=blogsection&id='.$row->sectionid.'&Itemid='.$_Itemid;
                	if (($row->secseotitle == '') && ($row->sectionid == 0)) {
                    	$seolink = 'blog/'.$_Itemid.'/';
                	} else {
                    	$seolink = ($row->secseotitle != '') ? 'blog/'.$row->secseotitle.'/' : '';
                	}
                	break;
                	case 'content_archive_section':
                	$link = 'index.php?option=com_content&task=archivesection&id='.$row->sectionid.'&Itemid='.$_Itemid;
                	$seolink = ($row->secseotitle != '') ? 'archive/'.$row->secseotitle.'/' : '';
                	break;
                	case 'content_section':
                	default:
                	$link = 'index.php?option=com_content&task=section&id='.$row->sectionid.'&Itemid='.$_Itemid;
                	$seolink = ($row->secseotitle != '') ? $row->secseotitle.'/' : '';
                	break;
            	}
            	$row->section = '<a href="'.sefRelToAbs($link, $seolink).'" title="'._E_SECTION.': '.$row->section.'">'.$row->section.'</a>';
			}
		}

		if ($params->get('category_link')) {
	    	$_Itemid = 0;
	    	$mtype = 'content_category';

        	$query = "SELECT id, type FROM #__menu WHERE componentid = '".$row->catid."' AND published='1'"
        	."\n AND ((type = 'content_category') OR (type = 'content_blog_category') OR (type = 'content_archive_category'))"
        	."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
        	$database->setQuery($query, '#__', 1, 0);
        	$menu2info = $database->loadRow();

        	if ($menu2info) { 
            	$_Itemid = intval($menu2info['id']);
            	$mtype = $menu2info['type'];
        	} else { //link to category does not exist, find link to section
            	$query = "SELECT id, type FROM #__menu WHERE componentid = '".$row->sectionid."' AND published='1'"
            	."\n AND ((type = 'content_section') OR (type = 'content_blog_section') OR (type = 'content_archive_section'))"
            	."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
            	$database->setQuery($query, '#__', 1, 0);
            	$menu3info = $database->loadRow();
            	if ($menu3info) {
                	$_Itemid = intval($menu3info['id']);
                	$mtype = $menu3info['type'];
            	}
        	}

        	if (!$_Itemid) {
            	$database->setQuery("SELECT type FROM #__menu WHERE id='".$Itemid."' AND published='1'", '#__', 1, 0);
            	$m_type = $database->loadResult();
            	if ($m_type) { $mtype = $m_type; $_Itemid = $Itemid; }
        	}

        	if ($_Itemid) {
            	$seoend = '';
            	if (($row->secseotitle != '') && ($row->catseotitle != '')) {
                	$seoend = $row->secseotitle.'/'.$row->catseotitle.'/';
            	}
            	if (preg_match('/blog/', $mtype)) {
                	$link = 'index.php?option=com_content&task=blogcategory&id='.$row->catid.'&Itemid='.$_Itemid;
                	$seolink = ($seoend != '') ? 'blog/'.$seoend : '';
            	} else if (preg_match('/archive/', $mtype)) {
                	$link = 'index.php?option=com_content&task=archivecategory&id='.$row->catid.'&Itemid='.$_Itemid;
                	$seolink = ($seoend != '') ? 'archive/'.$seoend : '';
            	} else {
                	$link = 'index.php?option=com_content&task=category&sectionid='.$row->sectionid.'&id='.$row->catid.'&Itemid='.$_Itemid;
                	$seolink = ($seoend != '') ? $seoend : '';
            	}
				$row->category = '<a href="'.sefRelToAbs($link, $seolink).'" title="'._E_CATEGORY.': '.$row->category.'">'.$row->category.'</a>';
			}
		}

		//loads current template for the pop-up window
		$template = '';
		if ($pop) {
			$params->set('popup', 1);
			$database->setQuery("SELECT template FROM #__templates_menu WHERE client_id='0' AND menuid='0'", '#__', 1, 0);
			$template = $database->loadResult();
		}

		if ($params->get('introtext')) {
			$row->text = $row->introtext. ( $params->get('intro_only') ? '' : chr(13) . chr(13) . $row->maintext);
		} else {
			$row->text = $row->maintext;
		}

		//deal with the {mospagebreak} mambots
		//only permitted in the full text area
		if (($mainframe->getCfg('sef') == 2) && isset($_REQUEST['page'])) {
			$page = intval(mosGetParam($_REQUEST, 'page', 0));
		} else {
			$page = intval(mosGetParam($_REQUEST, 'limitstart', 0));
		}
		if ($page < 0) { $page = 0; }

		//record the hit (this spoils cache, disable this if cache is enabled...)
		if (!$params->get('intro_only')) {
        	$obj = new mosContent( $database );
        	$obj->hit($row->id);
			if ($mainframe->getCfg('caching')) { //cache trick for hits
            	unset($row->hits);
			}
		}

		if (!isset($row->comments)) { //if is set then it is the number of comments
			$row->comments = null;
			if ($procomments) {
				$query = "SELECT c.*, u.username, u.avatar FROM #__comments c"
				."\n LEFT JOIN #__users u ON u.id=c.userid"
				."\n WHERE c.origin='1' AND c.articleid='".$row->id."'";
				if (($my->id != $row->created_by) && ($my->gid != 25)) { $query .= " AND c.published='1'"; }
				$query .= "\n ORDER BY c.ctimestamp ASC";
				$database->setQuery($query);
				$row->comments = $database->loadObjectlist();
			}
		}

    	/********** START META DATA MANIPULATON *********/
    	if ($makeMeta) {
        	$metaDesc = eUTF::utf8_trim($row->metadesc);
        	if ($metaDesc == '') {
            	$metaDesc = $row->title;
            	if ($row->categorytxt != '') { $metaDesc .= ', '.$row->categorytxt; }
            	if ($row->sectiontxt != '') { $metaDesc .= ', '.$row->sectiontxt; }
            	if ($row->author != '' ) { $metaDesc .= ', '._WRITTEN_BY.' '.$row->author; }
            	if ($row->language != '') { $metaDesc .= ', '._E_LANGUAGE.' '.$row->language; }
        	}

        	$metaKeys = eUTF::utf8_trim($row->metakey);
        	if ($metaKeys == '') {
            	$keys = array();

            	$keytitle = $row->title;
            	if ($row->categorytxt) { $keytitle .= ' '.$row->categorytxt; }
            	if ($row->sectiontxt) { $keytitle .= ' '.$row->sectiontxt; }
            	if ($row->author) { $keytitle .= ' '.$row->author; }
            	if ($row->language != '') { $keytitle .= ' '.str_replace(',', ' ',$row->language); }
            	$keytitle = preg_replace('/(\!|\@|\$|\%|\&|\(|\)|\,|\;|\'|\"|\.|\#|\?|\[|\]|\`|\*)/', '', $keytitle);

            	$parts = preg_split('/[\s]/', $keytitle);
            	if (count($parts) > 0) {
			    	foreach ($parts as $part) {
				    	if (eUTF::utf8_strlen($part) > 3) { $keys[] = $part; }
					}
				}

            	$keys = array_unique($keys);
            	if (count($keys) > 20) {
                	$keys = array_slice($keys, 0, 20);
            	} else if (count($keys) < 5) {
                	$keys[] = _E_CATEGORY;
                	$keys[] = _E_CONTENT;
                	$keys[] = _E_SECTION;
            	}
            	asort($keys);
            	$metaKeys = implode(', ',$keys);
        	}

			$ttl = ($row->categorytxt) ? $row->title.' - '.$row->categorytxt : $row->title;
			$ttl = preg_replace('/(\@|\$|\%|\&|\'|\"|\#|\[|\]|\`|\*)/', '', $ttl);
        	$mainframe->setPageTitle($ttl);
        	$mainframe->addMetaTag('author' , $row->author);
        	$mainframe->setMetaTag('description', $metaDesc);
        	$mainframe->setMetaTag('keywords', $metaKeys);
    	}

    	/********** END META DATA MANIPULATON *********/

    	if ($this->cache) {
    		$this->cache->call('HTML_content::show', $row, $params, $access, $page, $option, $ItemidCount, $procomments);
    	} else {
    		HTML_content::show($row, $params, $access, $page, $option, $ItemidCount, $procomments);
    	}
	}


	/**********************************/
	/* PREPARE SUBMITTED CONTENT PAGE */
	/**********************************/
	private function submittedContent($access) {
    	global $mainframe, $my, $database;

    	$mainframe->setPageTitle(_E_CONTENTSUB);
    	if (!$my->id || (!$access->canAdd && !$$access->canEdit && !$access->canEditOwn)) {
        	elxError(_E_SUBCON_NOALL, 0);
        	return;
    	}

    	$database->setQuery("SELECT COUNT(*) FROM #__content WHERE created_by = '".$my->id."' AND state='1'");
    	$articles = intval($database->loadResult());

    	$query = "SELECT id, title, created, hits FROM #__content"
    	."\n WHERE created_by = '".$my->id."' AND state='1' AND access IN (".$my->allowed.")"
    	."\n ORDER BY created DESC";
    	$database->setQuery($query, '#__', 5, 0);
    	$currows = $database->loadObjectList();

    	$query = "SELECT id, title, created FROM #__submitted_content"
    	."\n WHERE created_by = '".$my->id."' AND scope='content' ORDER BY id DESC";
    	$database->setQuery($query);
    	$rows = $database->loadObjectList();

		HTML_content::submittedContent($rows, $currows, $articles, $access);
	}


	/*******************************/
	/* PREPARE TO ADD/EDIT CONTENT */
	/*******************************/
	private function editItem($id=0, $access) {
		global $database, $mainframe, $my;

		$htitle = (intval($id)) ? _E_EDITCONTENT : _E_ADDCONTENT;
		$mainframe->setPageTitle($htitle);
		if (!$my->id) { mosNotAuth(); return; }

		$row = new elxSubContent( $database );
		$row->load($id);
		if (!$row->id) {
			$row->sectionid = 0;
			$row->catid = 0;
		}

		if ($id) {
			if (!( $access->canEdit || ($access->canEditOwn && $row->created_by == $my->id))) { mosNotAuth(); return; }
		} else {
			if (!$access->canAdd) { elxError(_E_SUBCON_NOALL, 0); return; }
		}

		$database->setQuery("SELECT sdvalue FROM #__softdisk WHERE sdsection='CORE' AND sdname = 'SUBMIT_SECTIONS'", '#__', 1, 0);
		$subsections = $database->loadResult();

		$where = '';
		if ($subsections && (trim($subsections) != '')) {
			$warr = array();
			$subs = explode(',', $subsections);
			if (count($subs) > 0) {
				foreach ($subs as $sub) {
					if (intval(trim($sub))) { array_push($warr, trim($sub)); }
				}
			}
			if (count($warr)) {
				$newsubs = implode(',',$warr);
				$where = "\n AND id IN (".$newsubs.")";
			}
		}

		$database->setQuery("SELECT sdvalue FROM #__softdisk WHERE sdsection='CORE' AND sdname = 'SUBMIT_CATEGORIES'", '#__', 1, 0);
		$subcategories = $database->loadResult();

		$where2 = '';
		if ($subcategories && (trim($subcategories) != '')) {
			$warr2 = array();
			$subs2 = explode(',', $subcategories);
			if (count($subs2) > 0) {
				foreach ($subs2 as $sub2) {
					if (intval(trim($sub2))) { array_push($warr2, trim($sub2)); }
				}
			}
			if (count($warr2)) {
				$newsubs2 = implode(',',$warr2);
				$where2 = "\n AND id IN (".$newsubs2.")";
			}
		}

		$lists = array();

		$lists['autopub'] = ($access->canPublish) ? 1 : 0;
		if (!$lists['autopub']) {
			$lists['autopub'] = ($access->canPublishOwn) ? 1 : 0;
		}

		//Get list of sections
		$query = "SELECT id AS value, name AS text FROM #__sections"
		."\n WHERE scope='content' AND published = '1' AND access IN (".$my->allowed.")"
		.$where
		."\n ORDER BY ordering ASC";
		$database->setQuery($query);
		$sections = $database->loadObjectList();

		$javascript = "onchange=\"changeDynaList( 'catid', sectioncategories, document.adminForm.sectionid.options[document.adminForm.sectionid.selectedIndex].value, 0, 0);\"";

		if (!$row->id) {
			$sectionsx[] = mosHTML::makeOption( '0', _CMN_SELECT );
			$sectionslist = array_merge( $sectionsx, $sections);
		} else {
			$sectionslist = $sections;
		}

    	$lists['sectionid'] = mosHTML::selectList($sectionslist, 'sectionid', 'class="selectbox" size="1" title="'._E_SECTION.'" '. $javascript, 'value', 'text', intval($row->sectionid));

		//Get list of categories
		$sectioncategories = array();
		$sectioncategories[0] = array();
		$sectioncategories[0][] = mosHTML::makeOption( 0, _CMN_SELECT );
		foreach($sections as $section) {
			$sectioncategories[$section->value] = array();
			$query = "SELECT id AS value, name AS text FROM #__categories"
			."\n WHERE published = '1' AND access IN (".$my->allowed.") AND section='$section->value'"
			.$where2
			."\n ORDER BY ordering ASC";

			$database->setQuery( $query );
			$rows2 = $database->loadObjectList();
			if ($rows2) {
				foreach($rows2 as $row2) {
					$sectioncategories[$section->value][] = mosHTML::makeOption( $row2->value, $row2->text );
				}
			}
		}

 		//get list of categories
  		if ( !$row->id ) {
 			$categories[] 	= mosHTML::makeOption( '0', _CMN_SELECT );
 			$lists['catid'] = mosHTML::selectList( $categories, 'catid', 'class="selectbox" size="1" title="'._E_CATEGORY.'"', 'value', 'text' );
  		} else {
 			$query = "SELECT id AS value, name AS text FROM #__categories"
 			."\n WHERE published = '1' AND access IN (".$my->allowed.") AND section='".$row->sectionid."'"
 			.$where2
 			."\n ORDER BY ordering ASC";
 			$database->setQuery($query);
 			$categories[] = mosHTML::makeOption('0', _CMN_SELECT);
 			$categories = array_merge( $categories, $database->loadObjectList() );
 			$lists['catid'] = mosHTML::selectList( $categories, 'catid', 'class="selectbox" size="1" title="'._E_CATEGORY.'"', 'value', 'text', intval($row->catid));
  		}

		$lists['access'] = mosAdminMenus::Access($row);
    	$lists['languages']	= mosAdminMenus::SelectLanguages('languages', $row->language, _E_ALL_LANGUAGES);

		HTML_content::editContent($row, $lists, $sectioncategories);
	}



	/********************************/
	/* SAVE CONTENT ITEM SUBMISSION */
	/********************************/
	private function saveContent( $access ) {
		global $database, $mainframe, $my, $_VERSION, $Itemid;

		if (!$my->id) { mosNotAuth(); return; }

		//CSRF prevention
		$tokname = 'token'.$my->id;
		if (!isset($_POST[$tokname]) || !isset($_SESSION[$tokname]) || ($_POST[$tokname] != $_SESSION[$tokname])) {
			die('Detected CSRF attack! Someone is forging your requests.');
		}

    	foreach ($_POST['languages'] as $xlang) {
    		if (trim($xlang) == '') { $newlangs = ''; }
    	}
    	if (!isset($newlangs)) {
    		$newlangs = implode(',', $_POST['languages']);
    	}
    	$_POST['language'] = $newlangs;

		$row = new elxSubContent($database);
		if (!$row->bind($_POST)) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}

    	$isNew = intval($row->id) ? 0 : 1;
		$htitle = $isNew ? _E_ADDCONTENT : _E_EDITCONTENT;
		$mainframe->setPageTitle($htitle);
		if (!$isNew) {
			if (!( $access->canEdit || ($access->canEditOwn && ($row->created_by == $my->id)))) { mosNotAuth(); return; }
        	$row->created = $this->now;
    	} else {
			if (!$access->canAdd) { elxError(_E_SUBCON_NOALL, 0); return; }
		}

    	if (trim($row->introtext) == '') {
    		$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('"._E_REQFIELDS_EMPTY.": "._E_INTRO."'); window.history.go(-1);</script>\n";
			exit();
    	}

    	//flood protection
    	if ($isNew) {
        	$floodtime = date('Y-m-d H:i:s', time() + ($mainframe->getCfg('offset') * 3600) - 180); //1 new post every 3 minutes for each user
        	$query = "SELECT COUNT(id) FROM #__submitted_content WHERE created_by = '".$my->id."' AND created > '".$floodtime."'";
        	$database->setQuery($query);
        	if (intval($database->loadResult())) {
            	elxError(_REG_TRYAGAIN_SECS, 0, 'Flood Protection');
            	return;
        	}
    	}

    	$row->scope = 'content';
		$row->created_by = $my->id;
    	if ($row->language == '') { $row->language = NULL; }

    	$query = "SELECT title FROM #__sections WHERE id = '$row->sectionid' AND scope = 'content'"
    	."\n AND published = '1' AND access IN (".$my->allowed.")";
    	$database->setQuery($query, '#__', 1, 0);
		$section = $database->loadResult();
    	if (!$section) {
    		$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('You must select a section!'); window.history.go(-1);</script>\n";
			exit();
    	}

    	$query = "SELECT title FROM #__categories WHERE id = '".$row->catid."' AND published = '1' AND access IN (".$my->allowed.")";
    	$database->setQuery($query, '#__', 1, 0);
		$category = $database->loadResult();
    	if (!$category) {
    		$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('"._E_WARNCAT."'); window.history.go(-1);</script>\n";
			exit();
    	}

    	if ($_VERSION->PRODUCT != 'E'.'l'.'x'.'i'.'s') { die(); }
    	require_once($mainframe->getCfg('absolute_path').'/administrator/includes/seovs.class.php');
    	$seo = new seovs('com_content', $row->title);
    	$seo->id = 0;
    	$seo->catid = intval($row->catid);
    	$row->seotitle = $seo->suggest();
    	$row->comments = mosHTML::cleanText($row->comments);
    	$row->metadesc = $row->title.', '.$category.', '.$section;

    	$metaKeys = array();
    	$skeys = preg_replace('/[\,]/', '', $row->metadesc);
    	$akeys = explode(' ', $skeys);
    	foreach ($akeys as $akey) {
        	if (eUTF::utf8_strlen(eUTF::utf8_trim($akey)) > 4) {
            	$metaKeys[] = eUTF::utf8_trim($akey);
        	}
    	}
    	if (count($metaKeys) > 0) {
        	$row->metakey = implode(', ', $metaKeys);
    	}

    	if (!preg_match('/ElXiS/i', $_VERSION->COPYRIGHT)) { die(); }

		$autopub = intval(mosGetParam($_POST, 'autopub', 0));
		if ($autopub) {
			if (!$access->canPublish) { $autopub = ($access->canPublishOwn) ? 1 : 0; }
		}

		if ($autopub) {
			$prow = new mosContent($database);
			$prow->title = $row->title;
			$prow->seotitle = $row->seotitle;
			$prow->introtext = $row->introtext;
			$prow->maintext = $row->maintext;
			$prow->state = '1';
			$prow->sectionid = $row->sectionid;
			$prow->mask = '0';
			$prow->catid = $row->catid;
			$prow->created = $row->created;
			$prow->created_by = $row->created_by;
			//$created_by_alias=null;
			$prow->modified = '1979-12-19 00:00:00';
			$prow->modified_by = '0';
			$prow->checked_out = '0';
			$prow->checked_out_time = '1979-12-19 00:00:00';
			$prow->publish_up = '1979-12-19 00:00:00';
			$prow->publish_down = '2060-01-01 00:00:00';
			//$images=null;
			//$urls=null;
			//$attribs = null;
			$prow->version = 1;
			$prow->parentid = 1;
			$prow->ordering = 1;
			$prow->metakey = $row->metakey;
			$prow->metadesc = $row->metadesc;
			$prow->access = $row->access;
			$prow->hits = '0';
			$prow->language = $row->language;

			if (!$prow->check()) {
				$mainframe->checkSendHeaders();
				echo "<script type=\"text/javascript\">alert('".$prow->getError()."'); window.history.go(-1);</script>\n";
				exit();
			}
			if (!$prow->store()) {
				$mainframe->checkSendHeaders();
				echo "<script type=\"text/javascript\">alert('".$prow->getError()."'); window.history.go(-1);</script>\n";
				exit();
			}

			$prow->updateOrder();

			if (!$isNew) {
				$database->setQuery("DELETE FROM #__submitted_content WHERE id='".$row->id."' AND created_by = '".$my->id."'");
				$database->query();
			}
		} else {
			if (!$row->check()) {
				$mainframe->checkSendHeaders();
				echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
				exit();
			}
			if (!$row->store()) {
				$mainframe->checkSendHeaders();
				echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
				exit();
			}
		}

		if ($isNew) {
			$database->setQuery("SELECT email, preflang FROM #__users WHERE sendemail='1' AND block='0'");
			$recipients = $database->loadRowList();

			if ($recipients && (count($recipients) > 0)) {
				$prlang = new prefLang();
            	$database->setQuery("SELECT COUNT(id) FROM #__submitted_content");
            	$waiting = intval($database->loadResult());	

				foreach ($recipients as $recipient) {
					$prlang->load($recipient['preflang']);

					$msg = sprintf( $prlang->lng->_ON_NEW_CONTENT, $my->username, $row->title, $section, $category)."<br />\r\n";
					if (trim($row->comments) != '') {
                		$msg .= $prlang->lng->_E_COMMENTS.": ".$row->comments."<br />\r\n";
                	}
                	$msg .= $prlang->lng->_DATE.": ".mosFormatDate($row->created)."<br />\r\n";
					$msg .= "<br />\r\n";
					$msg .= $prlang->lng->_E_SUBCONWAIT." <b>".$waiting."</b><br /><br />\r\n";
					$msg .= '<a href="'.$mainframe->getCfg('live_site').'">'.$mainframe->getCfg('sitename').'</a>';
					$msg .= "<br /><br /><br /><br />\r\n";
					$msg .= '<small>Generated by '.$_VERSION->PRODUCT.' '.$_VERSION->RELEASE.'.'.$_VERSION->DEV_LEVEL.' ('.$_VERSION->CODENAME.')</small>';
					$msg .= "<br />\r\n";
					$msg .= '<small>'.$_VERSION->COPYRIGHT.'</small><br />';

					mosMail($mainframe->getCfg('mailfrom'), $mainframe->getCfg('fromname'), $recipient['email'], $prlang->lng->_E_CONTENTSUB, $msg, 1);
				}
			}
    	}

 		$tmsg = $isNew ? _THANK_SUB : _E_ITEM_SAVED;
 		$tmsg = $autopub ? _E_ITEM_SAVED : $tmsg;
 		$sLink = sefRelToAbs('index.php?option=com_content&task=subcontent&Itemid='.$Itemid, 'submitted-content/');
    	echo '<h1 class="contentheading">'._E_CONTENTSUB.'</h1>'._LEND;
 		echo '<p>'.$tmsg.'</p>'._LEND;
 		echo '<a href="'.$sLink.'" title="'._E_CONTENTSUB.'">'._E_CONTENTSUB.'</a><br /><br />'._LEND;
	}


	/*******************************************/
	/* PREPARE TO DISPLAY EMAIL TO FRIEND FORM */
	/*******************************************/
	private function emailContentForm() {
		global $database, $mainframe, $my;

		$row = new mosContent($database);
		$row->load($this->id);

		$permits = explode(',', $my->allowed);
		if (!intval($row->id) || ($row->state == '0') || !in_array($row->access, $permits)) {
			mosNotAuth();
			return;
		} else {
			$mainframe->setPageTitle(_EMAIL_FRIEND);
			HTML_content::emailForm($row->id, $row->title);		
		}
	}


	/************************/
	/* SEND EMAIL TO FRIEND */
	/************************/
	private function emailContentSend() {
		global $database, $mainframe, $Itemid, $my;

		$query = "SELECT COUNT(*) FROM #__content WHERE id='".intval($this->id)."' AND state='1' AND access IN (".$my->allowed.")";
		$database->setQuery($query);
		$c = intval($database->loadResult());
		if (!$c) { mosNotAuth(); return; }

		$_Itemid = intval($Itemid);
		if (!$_Itemid) { $_Itemid = $mainframe->getItemid($this->id, 0, 0 ); }

		$email = trim(mosGetParam($_POST, 'email', ''));
		$yourname = eUTF::utf8_trim(mosGetParam($_POST, 'yourname', ''));
		$youremail = trim(mosGetParam($_POST, 'youremail', ''));
		$subject_default = _EMAIL_INFO.' '.$yourname;
		$subject = eUTF::utf8_trim(mosGetParam($_POST, 'subject', ''));
		$subject = ($subject == '') ? $subject_default : $subject;

		$form_check = mosGetParam($_POST, 'form_check', '');    
    	if (empty($_SESSION['_form_check_']['com_content']) || $form_check != $_SESSION['_form_check_']['com_content']) {
      		// the form hasn't been generated by the server on this session
			exit();
		}  
		if (!$email || !$youremail || ($this->is_email( $email ) == false ) || ($this->is_email( $youremail ) == false )) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert(\""._EMAIL_ERR_NOINFO."\"); window.history.go(-1);</script>";
			exit();
		}

		//link sent in email
		$link = sefRelToAbs($mainframe->getCfg('live_site').'/index.php?option=com_content&task=view&id='.$this->id.'&Itemid='.$_Itemid);
		$link = str_replace('&amp;', '&', $link);
		//message text
		$msg = sprintf(_EMAIL_MSG, $mainframe->getCfg('sitename'), $yourname, $youremail, $link);

		mosMail($mainframe->getCfg('mailfrom'), $mainframe->getCfg('fromname'), $email, $subject, $msg);

		$mainframe->setPageTitle(_EMAIL_FRIEND);
		HTML_content::emailSent($email);
	}


	/*******************/
	/* VALIDATE E-MAIL */
	/*******************/
	private function is_email($email) {
		$rBool = false;
		if (preg_match( "/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $email)) { $rBool = true; }
		return $rBool;
	}


	/***************/
	/* RECORD VOTE */
	/***************/
	private function recordVote() {
		global $database, $mainframe, $my;

		$mainframe->setPageTitle(_USER_RATING.' - '.$mainframe->getCfg('sitename'));
		$mainframe->setMetaTag('description', _USER_RATING.' '.$mainframe->getCfg('sitename'));
		$mainframe->setMetaTag('keywords', ''._RATE_BUTTON.', '._BUTTON_VOTE.', '._VOTE_POOR.', '._VOTE_BEST.', '._BUTTON_RESULTS.'');

		$user_rating = intval(mosGetParam($_REQUEST, 'user_rating', 0));
		$cid = intval(mosGetParam($_REQUEST, 'cid', 0));

		echo '<h1 class="contentheading">'._USER_RATING.'</h1>'._LEND;
		if (!$mainframe->getCfg( 'vote' )) {
			elxError(_E_RATING_NOALLOW, 0);
			return;
		}

		if (($user_rating < 1) || ($user_rating > 5)) {
			elxError(_E_VOTE_OUTRATE, 0);
			return;
		}

		$database->setQuery("SELECT COUNT(*) FROM #__content WHERE id='$cid' AND state='1' AND access IN (".$my->allowed.")");
		if (!intval($database->loadResult())) {
			elxError(_E_VOTE_INVALID, 0);
			return;
		}

		if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && ($_SERVER['HTTP_X_FORWARDED_FOR']!='')) {
			$currip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else if (isset($_SERVER['REMOTE_ADDR']) && ($_SERVER['REMOTE_ADDR']!='')) {
			$currip = $_SERVER['REMOTE_ADDR'];
		} else {
			$currip = getenv('REMOTE_ADDR');
		}

		$nowt = time() + ($mainframe->getCfg('offset') * 3600);

		$database->setQuery("SELECT * FROM #__content_rating WHERE content_id = '".$cid."'", '#__', 1, 0 );
		$database->loadObject($row);

		if ($row) {
			if (($row->lastip != '') && ($row->lastip == $currip)) {
				elxError(_ALREADY_VOTE, 0);
				return;
			}
			if (intval($row->lasttime) && (($nowt - $row->lasttime) < 15)) {
				elxError(_REG_TRYAGAIN_SECS, 0);
				return;
			}

			$rcount = $row->rating_count + 1;
			$rsum = $row->rating_sum + $user_rating;
			$query = "UPDATE #__content_rating SET rating_count = '$rcount', rating_sum = '$rsum',"
			."\n lastip = '$currip', lasttime='$nowt' WHERE content_id = '$cid'";
			$database->setQuery($query);
			$database->query();
		} else {
			$query = "INSERT INTO #__content_rating VALUES ('$cid', '$user_rating', '1', '$currip',  '$nowt')";
			$database->setQuery( $query );
			$database->query();
		}

		echo '<p>'._THANKS.'</p><br />'._LEND;
		echo '<div class="back_button"><a href="javascript:history.go(-1)" title="'._BACK.'">'._BACK.'</a></div><br /><br />'._LEND;
	}


	/*********************/
	/* PUBLISH A COMMENT */
	/*********************/
	private function publishComment() {
		global $my, $mainframe, $database, $Itemid;

		$comid = intval(mosGetParam($_GET, 'comid', 0));
		if (!$my->id || ($this->id < 1) || ($comid < 1)) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert(\"You are not allowed to perform this task!\"); window.history.go(-1);</script>";
			exit();
		}

		$canpublish = 0;
		if ($my->gid == 25) { //super administrator
			$canpublish = 1;
		} else { //article author
			$query = "SELECT COUNT(id) FROM #__content"
			."\n WHERE id='".$this->id."' AND state='1' AND created_by='".$my->id."' AND access IN (".$my->allowed.")";
			$database->setQuery($query);
			$canpublish = intval($database->loadResult());
		}

		$redLink = sefRelToAbs('index.php?option=com_content&task=view&id='.$this->id.'&Itemid='.$Itemid);
		if ($canpublish) {
			$query = "UPDATE #__comments SET published='1'"
			."\n WHERE cid='".$comid."' AND origin='1' AND articleid='".$this->id."' AND published='0'";
			$database->setQuery($query);
			$database->query();		

    		$com = new mosComments($database);
    		$com->load($comid);
    		if ($com && (intval($com->cid) > 0)) {
    			$mainframe->newcommentnotify($com, $redLink);
    		}
		}
		mosRedirect($redLink);
	}


	/********************/
	/* DELETE A COMMENT */
	/********************/
	private function deleteComment() {
		global $my, $mainframe, $database, $Itemid;

		$comid = intval(mosGetParam($_GET, 'comid', 0));
		if (!$my->id || ($this->id < 1) || ($comid < 1)) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert(\"You are not allowed to perform this task!\"); window.history.go(-1);</script>";
			exit();
		}

		$candelete = 0;
		if ($my->gid == 25) { //super administrator
			$candelete = 1;
		} else { //article author
			$query = "SELECT created_by FROM #__content WHERE id='".$this->id."' AND state='1' AND access IN (".$my->allowed.")";
			$database->setQuery($query, '#__', 1, 0);
			$author = intval($database->loadResult());
			if ($author && ($author == $my->id)) {
				$candelete = 1;
			} else { //comment author
				$query = "SELECT userid FROM #__comments WHERE cid='".$comid."' AND origin='1' AND articleid='".$this->id."'";
				$database->setQuery($query, '#__', 1, 0);
				$cauthor = intval($database->loadResult());
				if ($cauthor && ($cauthor == $my->id)) { $candelete = 1; }
			}
		}
		
		if ($candelete) {
			$query = "DELETE FROM #__comments WHERE cid='".$comid."'";
			$database->setQuery("DELETE FROM #__comments WHERE cid='".$comid."' AND origin='1' AND articleid='".$this->id."'");
			$database->query();		
		}
		$redLink = sefRelToAbs('index.php?option=com_content&task=view&id='.$this->id.'&Itemid='.$Itemid);
		mosRedirect($redLink);
	}


	/*******************/
	/* ADD NEW COMMENT */
	/*******************/
	private function addComment() {
		global $database, $my, $Itemid, $mainframe, $_VERSION;

    	if ($mainframe->getCfg('captcha')) {
        	$code = $this->getEncString(trim(mosGetParam($_POST, 'code', '')));
        	if ($code != $_SESSION['captcha']) {
				$mainframe->checkSendHeaders();
				echo "<script type=\"text/javascript\">alert('"._E_INV_SECCODE."'); window.history.go(-1);</script>\n";
				exit();
	   		}
    	}

		$form_check = mosGetParam($_POST, 'form_check', '');
		if ($mainframe->getCfg('static_cache') == 0) {
    		if (empty($_SESSION['_form_check_']['com_content']) || ($form_check != $_SESSION['_form_check_']['com_content'])) {
      			//the form hasn't been generated by the server on this session
				die('What are you trying to do?');
			}
		}

		$articleid = intval(mosGetParam($_POST, 'articleid', 0));

		$query = "SELECT title, created_by, attribs FROM #__content WHERE id='".$articleid."' AND state='1' AND access IN (".$my->allowed.")";
		$database->setQuery($query, '#__', 1, 0);
		$row = $database->loadRow();
		if (!$row) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert(\"You are not allowed to perform this task!\"); window.history.go(-1);</script>";
			exit();
		}

		$params = new mosParameters($row['attribs']);
		$params->def('post_comments', 0);
		$post_comments = (int)$params->get('post_comments');
		unset($params);

		if (!$post_comments) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert(\"User commentary for this article is not allowed!\"); window.history.go(-1);</script>";
			exit();
		} elseif (($post_comments === 1) && !$my->id) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert(\""._E_MUSTLOGTOCOM."\"); window.history.go(-1);</script>";
			exit();
		}

		$auto_publish = ($my->id) ? 1 : 0;

    	$commessage = eUTF::utf8_trim(mosGetParam($_POST, 'commessage', ''));
		$commessage = strip_tags($commessage);
		$pat = "/([\']|[\"]|[\$]|[\#]|[\<]|[\>]|[\*]|[\%]|[\~]|[\`]|[\^]|[\|]|[\\\])/";
		$commessage = preg_replace($pat, '', $commessage);     
    	if ($commessage == '') {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert(\""._E_COMCNOTEMPTY."\"); window.history.go(-1);</script>";
			exit();
		}

		//convert URLs to links:
		$commessage = preg_replace("#[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]#","<a href=\"\\0\">\\0</a>", $commessage);

    	$com = new mosComments($database);
    	$com->load('0');
    	$com->origin = '1';
    	$com->articleid = $articleid;
    	$com->cmessage = $commessage; //htmlspecialchars($commessage, ENT_COMPAT, "UTF-8");
		$com->published = $auto_publish ? '1' : '0';
		$com->notify = (intval(mosGetParam($_POST, 'comnotify', 0)) == 1) ? '1' : '0';

		//flood protection
		$timelimit = time() + ($mainframe->getCfg('offset') * 3600) - 30;
		$where = ($my->id) ? " ((userid='".$my->id."') OR (ipaddress='".$com->ipaddress."'))" : " ipaddress='".$com->ipaddress."'";
		$database->setQuery("SELECT COUNT(cid) FROM #__comments WHERE".$where." AND ctimestamp > '".$timelimit."'");
		if (intval($database->loadResult())) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert(\"Flood protection. Please wait some seconds and retry.\"); window.history.go(-1);</script>";
			exit();
		}

		if ($my->id) {
			$database->setQuery("SELECT name, email FROM #__users WHERE id='".$my->id."'", '#__', 1, 0);
    		$usr = $database->loadRow();
    		$com->author = $usr['name'];
    		$com->email = $usr['email'];
    	} else {
    		$comauthor = eUTF::utf8_trim(mosGetParam($_POST, 'comauthor', ''));
    		$com->author = htmlspecialchars(strip_tags($comauthor), ENT_COMPAT, "UTF-8");
    		if ($com->author == '') {
				$mainframe->checkSendHeaders();
				echo "<script type=\"text/javascript\">alert(\""._GEM_REGWARN_NAME."\"); window.history.go(-1);</script>";
				exit();
			}
    		$comemail = trim(mosGetParam($_POST, 'comemail', ''));
			if ((trim($comemail == '')) || (preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $comemail )==false)) {
				$mainframe->checkSendHeaders();
				echo "<script type=\"text/javascript\">alert(\""._GEM_REGWARN_MAIL."\"); window.history.go(-1);</script>";
				exit();
			}
			$com->email = $comemail;
    	}

		if (!$com->check()) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$com->getError()."'); window.history.go(-1);</script>\n";
			exit();
		}
		$com->store();

		$redLink = sefRelToAbs('index.php?option=com_content&task=view&id='.$articleid.'&Itemid='.$Itemid);

		if (!$auto_publish) {
			$database->setQuery("SELECT name, email, preflang FROM #__users WHERE id='".$row['created_by']."' AND block='0'");
			$recipient = $database->loadRow();
			if ($recipient) {
				$prlang = new prefLang();
				$prlang->load($recipient['preflang']);

				$msg = $prlang->lng->_E_HI.' '.$recipient['name'].",<br />\r\n";
				$msg .= sprintf($prlang->lng->_E_NEWCOMBYTITLE, '<b>'.$com->author.'</b>', '<b>'.$row['title'].'</b>')."<br />\r\n";
                $msg .= $prlang->lng->_E_COMMENTS.": ".$com->cmessage."<br /><br />\r\n";
				$msg .= $prlang->lng->_E_COMSTAYUNPUB."<br />\r\n";
				$msg .= 'URL: <a href="'.$redLink.'">'.$redLink."</a><br />\r\n";
				$msg .= $prlang->lng->_DATE.": ".mosFormatDate($this->now)."<br /><br />\r\n";
				$msg .= '<a href="'.$mainframe->getCfg('live_site').'">'.$mainframe->getCfg('sitename').'</a>';
				$msg .= "<br /><br /><br /><br />\r\n";
				$msg .= '<small>Generated by '.$_VERSION->PRODUCT.' '.$_VERSION->RELEASE.'.'.$_VERSION->DEV_LEVEL.' ('.$_VERSION->CODENAME.')</small>';
				$msg .= "<br />\r\n";
				$msg .= '<small>'.$_VERSION->COPYRIGHT.'</small><br />';
				mosMail($mainframe->getCfg('mailfrom'), $mainframe->getCfg('fromname'), $recipient['email'], $prlang->lng->_E_NEWCOMNOTIF, $msg, 1);
			}
		}

		if ($auto_publish) {
			$mainframe->newcommentnotify($com, $redLink);
		}

		$rmsg = $auto_publish ? '' : _E_COMPUBREV;
		mosRedirect($redLink, $rmsg);
	}


	/********************************/
	/* STOP RECIEVING NOTIFICATIONS */
	/********************************/
	private function stopnotifications() {
		global $database, $my, $Itemid, $mainframe;

		$articleid = intval(mosGetParam($_POST, 'articleid', 0));

		$query = "SELECT title, created_by, attribs FROM #__content WHERE id='".$articleid."' AND state='1' AND access IN (".$my->allowed.")";
		$database->setQuery($query, '#__', 1, 0);
		$row = $database->loadRow();
		if (!$row) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert(\"You are not allowed to perform this task!\"); window.history.go(-1);</script>";
			exit();
		}

		$params = new mosParameters($row['attribs']);
		$params->def('post_comments', 0);
		$post_comments = (int)$params->get('post_comments');
		unset($params);

		if (!$post_comments) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert(\"User commentary for this article is not allowed!\"); window.history.go(-1);</script>";
			exit();
		} elseif (($post_comments === 1) && !$my->id) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert(\""._E_MUSTLOGTOCOM."\"); window.history.go(-1);</script>";
			exit();
		}

		$backlink = sefRelToAbs('index.php?option=com_content&task=view&id='.$articleid.'&Itemid='.$Itemid);

		if ($my->id) {
			$database->setQuery("SELECT email FROM #__users WHERE id='".$my->id."'", '#__', 1, 0);
    		$email = $database->loadResult();
			$query = "UPDATE #__comments SET notify=0"
			."\n WHERE origin=1 AND articleid=".$articleid." AND published=1"
			."\n AND notify=1 AND ((userid=".$my->id.") OR (email='".$email."'))";
			$database->setQuery($query);
			$database->query();
    	} else {
    		$email = trim(mosGetParam($_POST, 'notifemail', ''));
			if ((trim($email == '')) || (preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $email)==false)) {
				mosRedirect($backlink, _GEM_REGWARN_MAIL);
			}
			$query = "UPDATE #__comments SET notify=0"
			."\n WHERE origin=1 AND articleid=".$articleid." AND published=1"
			."\n AND notify=1 AND userid=0 AND email='".$email."'";
			$database->setQuery($query);
			$database->query();
    	}
    	
		$msg = defined('_E_EMAILNOTIFSTOP') ? _E_EMAILNOTIFSTOP : 'E-mail notifications stopped for this article';
    	mosRedirect($backlink, $msg);
	}


	/********************/
	/* PRIMARY ORDERING */
	/********************/
	private function orderby_pri($orderby) {
		switch ($orderby) {
			case 'alpha': return 'cc.title, '; break;
			case 'ralpha': return 'cc.title DESC, '; break;
			case 'order': return 'cc.ordering, '; break;
			default: return ''; break;
		}
		return $orderby;
	}


	/**********************/
	/* SECONDARY ORDERING */
	/**********************/
	private function orderby_sec($orderby) {
		switch ($orderby) {
			case 'date': return 'a.created'; break;
			case 'rdate': return 'a.created DESC'; break;
			case 'alpha': return 'a.title'; break;
			case 'ralpha': return 'a.title DESC'; break;
			case 'hits': return 'a.hits DESC'; break;
			case 'rhits': return 'a.hits ASC'; break;
			case 'order': return 'a.ordering'; break;
			case 'author': return 'a.created_by, u.name'; break;
			case 'rauthor': return 'a.created_by DESC, u.name DESC'; break;
			case 'front': return 'f.ordering'; break;
			default: return 'a.ordering'; break;
		}
	}


	/*********************************************************/
	/* WHERE (type: 0 = Archives, 1 = Section, 2 = Category) */
	/*********************************************************/
	private function _where($type=1, $access, $noauth, $id, $year=NULL, $month=NULL) {
    	global $my, $database;

		$where = array();
		if ($type > 0) { //normal
			$where[] = "a.state = '1'";
            $where[] = "( a.publish_up = '1979-12-19 00:00:00' OR a.publish_up <= '".$this->now."' )";
        	$where[] = "( a.publish_down = '2060-01-01 00:00:00' OR a.publish_down >= '".$this->now."' )";
			if ($noauth) { $where[] = "a.access IN (".$my->allowed.")"; }
			if ($id > 0) {
				if ($type == 1) {
					$where[] = "a.sectionid IN (".$id.")";
				} elseif ($type == 2) {
					$where[] = "a.catid IN (". $id .")";
				}
			}
		}

		if ($type < 0) { //archive
			$where[] = "a.state='-1'";
			if ($year) { $where[] = "YEAR( a.created ) = '".$year."'"; }
			if ($month) { $where[] = "MONTH( a.created ) = '".$month."'"; }
			if ($noauth) { $where[] = "a.access IN (".$my->allowed.")"; }
			if ($id > 0) {
				if ($type == -1) {
					$where[] = "a.sectionid = '".$id."'";
				} elseif ($type == -2) {
					$where[] = "a.catid = '".$id."'";
				}
			}
		}
		return $where;
	}


	/************************************/
	/* GET ENCRYPTED STRING FOR CAPTCHA */
	/************************************/
	private function getEncString($string='') {
		global $mainframe;

		$enc = $string.date('Ymd').$mainframe->getCfg('secret');
    	if (isset($_SERVER['HTTP_USER_AGENT'])) { $enc .= $_SERVER['HTTP_USER_AGENT']; }
    	if (isset($_SERVER['REMOTE_ADDR'])) { $enc .= $_SERVER['REMOTE_ADDR']; }
    	return md5($enc);
	}

}


$elxcon = new elxContent();
$elxcon->run();
unset($elxcon);

?>