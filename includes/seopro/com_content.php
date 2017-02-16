<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Elxis SEO PRO
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: SEO map for component content.
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//index.php?option=com_content&task=$task&sectionid=$sectionid&id=$id&Itemid=$Itemid&limit=$limit&limitstart=$limitstart

/*********************/
/* GENERATE SEO LINK */
/*********************/
function seogen_com_content($link) { //string is a sorted URL
	global $database, $mosConfig_live_site;

	if (trim($link) == '') { return ''; }
	$vars = array();
	$vars['option'] = 'com_content';
	$vars['task'] = '';

	$half = preg_split('/[\?]/', $link);
	if (isset($half[1])) {
		$half2 = preg_split('/[\#]/', $half[1]);
		$parts = preg_split('/[\&]/', $half2[0], -1, PREG_SPLIT_NO_EMPTY);
		if (count($parts) >0) {
			foreach ($parts as $part) {
				list($x, $y) = preg_split('/[\=]/', $part, 2);
				$x = strtolower($x);
				$vars[$x] = $y;
			}
		}
	}

	$pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;

	//SECTION (TABLE)
	//index.php?option=com_content&task=section&id=3&Itemid=52 --> section/
    if ($vars['task'] == 'section') {
		if (isset($vars['id'])) {
			$query = "SELECT seotitle  FROM  #__sections"
			."\n WHERE id = '".intval($vars['id'])."' AND published='1'";
			$database->setQuery($query, '#__', 1, 0);
			$seotitle = $database->loadResult();
			if ($seotitle && ($seotitle != '')) {
				return $mosConfig_live_site.'/'.$seotitle.'/';
			}
		}
        return sefstdRelToAbs($link);
    }

	//SECTION (BLOG)
	//index.php?option=com_content&task=blogsection&id=3&Itemid=53 --> blog/section/ or blog/Itemid/ (multiple sections)
    if ($vars['task'] == 'blogsection') {
		if (isset($vars['id'])) {
		    if (!intval($vars['id'])) { //multiple sections
		        if (isset($vars['itemid'])) {
		            return $mosConfig_live_site.'/blog/'.intval($vars['itemid']).'/';
		        }
		    }
			$query = "SELECT seotitle  FROM  #__sections"
			."\n WHERE id = '".intval($vars['id'])."' AND published='1'";
			$database->setQuery($query, '#__', 1, 0);
			$seotitle = $database->loadResult();
			if ($seotitle && ($seotitle != '')) {
				return $mosConfig_live_site.'/blog/'.$seotitle.'/';
			}
		}
        return sefstdRelToAbs($link);
    }

	//SECTION (ARCHIVE)
	//index.php?option=com_content&task=archivesection&id=xx&Itemid=yy&year=zz&month=qq --> archive/section/yearmonth/
    if ($vars['task'] == 'archivesection') {
        $tempURL = '';
		if (isset($vars['id'])) {
            $query = "SELECT seotitle FROM  #__sections WHERE id = '".intval($vars['id'])."' AND published='1'";
			$database->setQuery($query, '#__', 1, 0);
			$seotitle = $database->loadResult();
			if ($seotitle && ($seotitle != '')) { $tempURL .= $seotitle.'/'; }
        }

        if (isset($vars['year']) && isset($vars['month'])) {
            $tempURL .= $vars['year'].$vars['month'].'/';
        }
        if ($tempURL != '') {
            return $mosConfig_live_site.'/archive/'.$tempURL;
        }
        return sefstdRelToAbs($link);
    }

	//CATEGORY (ARCHIVE)
	//index.php?option=com_content&task=archivecategory&id=18&Itemid=56&year=xx&month=yy&module=1 --> archive/section/category/yearmonth/
    if ($vars['task'] == 'archivecategory') {
		$tempURL = '';
        if (isset($vars['id'])) {
			$idjoin = $pg ? 's.id::VARCHAR=c.section' : 's.id=c.section';
			$query = "SELECT c.seotitle AS seocat, s.seotitle AS seosec FROM #__categories c"
			."\n LEFT JOIN #__sections s ON ".$idjoin
			."\n WHERE c.id = '".intval($vars['id'])."' AND c.published='1' AND s.published='1'";
			$database->setQuery($query, '#__', 1, 0);
			$row = $database->loadRow();
			if ($row && ($row['seocat'] != '') && ($row['seosec'] != '')) {
			    $tempURL .= $row['seosec'].'/'.$row['seocat'].'/';
			}
		}
        if (isset($vars['year']) && isset($vars['month'])) {
            $tempURL .= $vars['year'].$vars['month'].'/';
        }
        if ($tempURL != '') {
            return $mosConfig_live_site.'/archive/'.$tempURL;
        }
        return sefstdRelToAbs($link);
    }

	//CATEGORY (TABLE)
	//index.php?option=com_content&task=category&sectionid=zz&id=yy&Itemid=xx ---> section/category/
    if ($vars['task'] == 'category') {
		if (isset($vars['sectionid']) && isset($vars['id'])) {
			$idjoin = $pg ? 's.id::VARCHAR=c.section' : 's.id=c.section';
			$query = "SELECT c.seotitle AS seocat, s.seotitle AS seosec FROM #__categories c"
			."\n LEFT JOIN #__sections s ON ".$idjoin
			."\n WHERE c.section = '".intval($vars['sectionid'])."' AND c.published='1'"
			."\n AND c.id = '".intval($vars['id'])."' AND s.published='1'";
			$database->setQuery($query, '#__', 1, 0);
			$row = $database->loadRow();
			if ($row && ($row['seocat'] != '') && ($row['seosec'] != '')) {
				return $mosConfig_live_site.'/'.$row['seosec'].'/'.$row['seocat'].'/';
			}
		}
        return sefstdRelToAbs($link);
    }

	//CATEGORY (BLOG)
	//index.php?option=com_content&task=blogcategory&id=18&Itemid=54 ---> blog/section/category/
    if (($vars['task'] == 'blogcategory') || ($vars['task'] == 'blogcategorymulti')) {
		if (isset($vars['id'])) {
			$idjoin = $pg ? 's.id::VARCHAR=c.section' : 's.id=c.section';
			$query = "SELECT c.seotitle AS seocat, s.seotitle AS seosec FROM #__categories c"
			."\n LEFT JOIN #__sections s ON ".$idjoin
			."\n WHERE c.id = '".intval($vars['id'])."' AND c.published='1' AND s.published='1'";
			$database->setQuery($query, '#__', 1, 0);
			$row = $database->loadRow();
			if ($row && ($row['seocat'] != '') && ($row['seosec'] != '')) {
				return $mosConfig_live_site.'/blog/'.$row['seosec'].'/'.$row['seocat'].'/';
			}
		}
        return sefstdRelToAbs($link);
    }

	//CONTENT ITEM
	//index.php?option=com_content&task=view&id=22&Itemid=57 ----> section/category/item.html or item.html (autononmous)
    if ($vars['task'] == 'view') {
		if (isset($vars['id'])) {
			$query = "SELECT c.seotitle AS seoitem, cc.seotitle AS seocat, s.seotitle AS seosec FROM #__content c"
			."\n LEFT JOIN #__categories cc ON cc.id=c.catid"
			."\n LEFT JOIN #__sections s ON s.id=c.sectionid"
			."\n WHERE c.id='".intval($vars['id'])."'";
			$database->setQuery($query, '#__', 1, 0);
			$row = $database->loadRow();

            if ($row) {
                $seoextra = '';
                if (isset($vars['limit']) && isset($vars['limitstart'])) { //multiple pages item (TOC/navigation)
                    $seoextra = '?page='.intval($vars['limitstart']);
                }
                if (($row['seosec'] != '') && ($row['seocat'] != '') && ($row['seoitem'] != '')) {
                    return $mosConfig_live_site.'/'.$row['seosec'].'/'.$row['seocat'].'/'.$row['seoitem'].'.html'.$seoextra;
                } else if ($row['seoitem'] != '') { //autonomous page
                    return $mosConfig_live_site.'/'.$row['seoitem'].'.html'.$seoextra;
                }
			}
		}
        return sefstdRelToAbs($link);
    }

	//VOTE CONTENT ITEM (form submittion)
	if ($vars['task'] == 'vote') {
		return $mosConfig_live_site.'/vote.html';
	}

    //----------------CONTENT SUBMITTION START
	if ($vars['task'] == 'subcontent') { //list of submitted content
        return $mosConfig_live_site.'/submitted-content/';
	}

	if ($vars['task'] == 'new') { //submit new content item
        return $mosConfig_live_site.'/submitted-content/new.html';
	}

	if ($vars['task'] == 'edit') { //edit submitted content
        $extra =  (isset($vars['id'])) ? '?id='.intval($vars['id']) : '';
        return $mosConfig_live_site.'/submitted-content/edit.html'.$extra;
	}

	if ($vars['task'] == 'save') { //save submitted content (form submittion)
        return $mosConfig_live_site.'/submitted-content/save.html';
	}
	//-------------------CONTENT SUBMITTION END

	return sefstdRelToAbs($link);
}


/********************/
/* RESTORE SEO LINK */
/********************/
function seores_com_content($seolink='') {
	global $database, $lang;

	$seolink = urldecode($seolink);
    $seolink = trim(preg_replace('/(&amp;)/', '&', $seolink));
	$link = preg_split('/[\?]/', $seolink);
	$itemsyn = intval(mosGetParam( $_SESSION, 'itemsyn', 0 ));

	$QUERY_STRING = array();

	$_GET['option'] = 'com_content';
	$_REQUEST['option'] = 'com_content';
	$QUERY_STRING[] = 'option=com_content';

	$parts = preg_split('/[\/]/', $link[0], -1, PREG_SPLIT_NO_EMPTY);
	$pg = (preg_match('/postgre/i', $database->_resource->databaseType)) ? 1 : 0;
	$ok = 0;


	/* vote form submission */
	if ($parts[0] == 'vote.html') {
		$_GET['task'] = 'vote';
		$_REQUEST['task'] = 'vote';
		$QUERY_STRING[] = 'task=vote';
		$_Itemid = intval(mosGetParam( $_POST, 'Itemid', 0 ));
		if (!$_Itemid) { //check for a system link
			$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_content&task=vote'"
			."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%$lang%'))";
			$database->setQuery($query, '#__', 1, 0);
			$_Itemid = intval($database->loadResult());
		}
		$_GET['Itemid'] = $_Itemid;
		$_REQUEST['Itemid'] = $_Itemid;
		$QUERY_STRING[] = 'Itemid='.$_Itemid;
		$ok = 1;
	}


	/* content item */
    if (!$ok && (isset($parts[2]) && preg_match('/(.html)$/', $parts[2] ))) {
        $_GET['task'] = 'view';
        $_REQUEST['task'] = 'view';
        $QUERY_STRING[] = 'task=view';

        $seosec = htmlspecialchars($parts[0]);
        $seocat = htmlspecialchars($parts[1]);
        $seotitle = htmlspecialchars(preg_replace('/(\.html)$/', '', $parts[2]), ENT_QUOTES);

        $query = "SELECT c.id, c.sectionid, c.catid FROM #__content c"
        ."\n LEFT JOIN #__categories cc ON cc.id=c.catid"
        ."\n LEFT JOIN #__sections s ON s.id=c.sectionid"
        ."\n WHERE c.seotitle='".$seotitle."' AND cc.seotitle='".$seocat."' AND s.seotitle='".$seosec."'"
		. "\n AND c.state <> '0' AND cc.published = '1' AND s.scope='content' AND s.published = '1'";
        $database->setQuery($query, '#__', 1, 0);
        $row = $database->loadRow();

        if ($row) {
            $_GET['id'] = $row['id'];
            $_REQUEST['id'] = $row['id'];
            $QUERY_STRING[] = 'id='.$row['id'];

			if (!$itemsyn) {
            	//check direct link
            	$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_content&task=view&id=".$row['id']."'"
				."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
				$database->setQuery($query, '#__', 1, 0);
				$_Itemid = intval($database->loadResult());
            	if (!$_Itemid) { //check link to category
                	$query = "SELECT id FROM #__menu WHERE componentid = '".$row['catid']."' AND published='1'"
                	."\n AND ((type = 'content_category') OR (type = 'content_blog_category') OR (type = 'content_archive_category'))"
                	."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
                	$database->setQuery($query, '#__', 1, 0);
                	$_Itemid = intval($database->loadResult());
                	if (!$_Itemid) { //check link to section
                    	$query = "SELECT id FROM #__menu WHERE componentid = '".$row['sectionid']."' AND published='1'"
                    	."\n AND ((type = 'content_section') OR (type = 'content_blog_section') OR (type = 'content_archive_section'))"
                    	."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
                    	$database->setQuery($query, '#__', 1, 0);
                    	$_Itemid = intval($database->loadResult());
                	}
            	}
            } else {
            	$_Itemid = $itemsyn;
            }

            $_GET['Itemid'] = $_Itemid;
            $_REQUEST['Itemid'] = $_Itemid;
            $QUERY_STRING[] = 'Itemid='.$_Itemid;
            $ok = 1;
        } else {
        	pageNotFound();
        }
    }


	/* autonomous page */
    if (!$ok && preg_match('/(.html)$/', $parts[0])) {
        $_GET['task'] = 'view';
        $_REQUEST['task'] = 'view';
        $QUERY_STRING[] = 'task=view';

        $seotitle = htmlspecialchars(preg_replace('/(\.html)$/', '', $parts[0]), ENT_QUOTES);
        $database->setQuery("SELECT id FROM #__content WHERE seotitle='$seotitle' AND sectionid='0' AND catid='0' AND state <> '0'", '#__', 1, 0);
        $id = intval($database->loadResult());

        if ($id) {
            $_GET['id'] = $id;
            $_REQUEST['id'] = $id;
            $QUERY_STRING[] = 'id='.$id;
			if (!$itemsyn) {
            	$query = "SELECT id FROM #__menu WHERE componentid = '$id' AND type = 'content_typed' AND published='1'"
            	."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))";
				$database->setQuery($query, '#__', 1, 0);
            	$_Itemid = intval($database->loadResult());
            } else {
            	$_Itemid = $itemsyn;
            }

            $_GET['Itemid'] = $_Itemid;
            $_REQUEST['Itemid'] = $_Itemid;
            $QUERY_STRING[] = 'Itemid='.$_Itemid;
            $ok = 1;
        } else {
        	pageNotFound();
        }
    }

    /* submitted content */
    if (!$ok && ($parts[0] == 'submitted-content')) {
        $_task = 'subcontent';
        if (isset($parts[1])) {
            $_task2 = htmlspecialchars(preg_replace('/(\.html)$/', '', $parts[1]), ENT_QUOTES);
            $validtasks = array('new', 'edit', 'save');
            if (in_array($_task2, $validtasks)) { $_task = $_task2; }
        }
		$_GET['task'] = $_task;
		$_REQUEST['task'] = $_task;
		$QUERY_STRING[] = 'task='.$_task;

		if (!$itemsyn) {
        	$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_content&task=subcontent'"
        	."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%$lang%'))";
        	$database->setQuery($query, '#__', 1, 0);
        	$_Itemid = intval($database->loadResult());
        } else {
        	$_Itemid = $itemsyn;	
        }

        $_GET['Itemid'] = $_Itemid;
        $_REQUEST['Itemid'] = $_Itemid;
        $QUERY_STRING[] = 'Itemid='.$_Itemid;
        $ok = 1;
    }

	/* archive */
    if (!$ok && ($parts[0] == 'archive')) {
        $x1 = isset($parts[1]) ? $parts[1] : '';
        $x2 = isset($parts[2]) ? $parts[2] : '';
        $x3 = isset($parts[3]) ? $parts[3] : '';
        $s1 = (($x1 == '') || is_numeric($x1)) ? 0 : 1;
        $s2 = (($x2 == '') || is_numeric($x2)) ? 0 : 1;

        $id = 0;
        $_Itemid = 0;
        $_task = 'archivecategory';
        if ($s1 && $s2) {
        	$idjoin = $pg ? 's.id::VARCHAR = c.section' : 's.id = c.section';
            $query = "SELECT c.id FROM #__categories c"
            ."\n LEFT JOIN #__sections s ON ".$idjoin
            ."\n WHERE c.published='1' AND c.seotitle='".htmlspecialchars($x2)."' AND s.published='1' AND s.scope='content'";
			$database->setQuery($query);
            $id = intval($database->loadResult());
            if ($id) {
            	if (!$itemsyn) {
                	$query = "SELECT id FROM #__menu WHERE published='1'"
					."\n AND link='index.php?option=com_content&task=archivecategory&id=".$id."'"
					."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
                	$database->setQuery($query, '#__', 1, 0);
                	$_Itemid = intval($database->loadResult());
				} else {
                	$_Itemid = $itemsyn;
                }
            } else {
            	pageNotFound();
            }
        } else if ($s1) {
            $_task = 'archivesection';
            $query = "SELECT id FROM #__sections WHERE published='1' AND scope='content' AND seotitle='".htmlspecialchars($x1)."'";
			$database->setQuery($query);
            $id = intval($database->loadResult());
            if ($id) {
            	if (!$itemsyn) {
                	$query = "SELECT id FROM #__menu WHERE link='index.php?option=com_content&task=archivesection&id=".$id."' AND published='1'";
                	$database->setQuery($query, '#__', 1, 0);
                	$_Itemid = intval($database->loadResult());
            	} else {
            		$_Itemid = $itemsyn;
            	}
            } else {
            	pageNotFound();
            }
        }

		if (!$_Itemid) { //fix for the archive module
            $query = "SELECT id FROM #__menu WHERE published='1' AND type='content_archive_category'"
			."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))";
            $database->setQuery($query, '#__', 1, 0);
            $_Itemid = intval($database->loadResult());
		}

        $_GET['task'] = $_task;
        $_REQUEST['task'] = $_task;
        $QUERY_STRING[] = 'task='.$_task;

        if ($id) {
            $_GET['id'] = $id;
            $_REQUEST['id'] = $id;
            $QUERY_STRING[] = 'id='.$id;
        }

        if ($_Itemid) {
            $_GET['Itemid'] = $_Itemid;
            $_REQUEST['Itemid'] = $_Itemid;
            $QUERY_STRING[] = 'Itemid='.$_Itemid;
        }

        $yearmonth = 0;
        if (intval($x3)) {
            $yearmonth = intval($x3);
        } else if (intval($x2)) {
            $yearmonth = intval($x2);
        } else if (intval($x1)) {
            $yearmonth = intval($x1);
        }

        if ($yearmonth && (strlen($yearmonth) == 6)) {
            $year = intval(substr($yearmonth, 0, 4));
            if ($year > 1999) {
                $month = substr($yearmonth, 4, 2);
                $km = intval($month);
                if (($km > 0) && ($km < 13)) {
                    $_GET['year'] = $year;
                    $_REQUEST['year'] = $year;
                    $QUERY_STRING[] = 'year='.$year;

                    $_GET['month'] = $month;
                    $_REQUEST['month'] = $month;
                    $QUERY_STRING[] = 'month='.$month;
                }
            }
        }
        $ok = 1;
    }


	$blog = 0;
	$idx = 0;
	if ($parts[0] == 'blog') { $blog = 1; $idx = 1; }

	/* section table or section blog or multi-section blog */
	if (!$ok && (!isset($parts[1]) || (!isset($parts[2]) && $blog))) {
		$is_multiple = 0;
		if ($blog) {
			$task = 'blogsection';
			$is_multiple = (is_numeric($parts[1]) && intval($parts[1])) ? 1 : 0;
		} else {
			$task = 'section';
		}

		$_GET['task'] = $task;
        $_REQUEST['task'] = $task;
        $QUERY_STRING[] = 'task='.$task;

        if (!$is_multiple) {
		    $database->setQuery("SELECT id FROM #__sections WHERE seotitle='".htmlspecialchars($parts[$idx], ENT_QUOTES)."' AND scope='content' AND published='1'", '#__', 1, 0);
            $id = intval($database->loadResult());
            if (!$id) { pageNotFound(); }

            $_GET['id'] = $id;
            $_REQUEST['id'] = $id;
            $QUERY_STRING[] = 'id='.$id;

			if (!$itemsyn) {
            	$query = "SELECT id FROM #__menu WHERE published='1'"
				."\n AND link='index.php?option=com_content&task=".$task."&id=".$id."'"
				."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))";
            	$database->setQuery($query, '#__', 1, 0);
            	$_Itemid = intval($database->loadResult());
            } else {
            	$_Itemid = $itemsyn;
            }
            $_GET['Itemid'] = $_Itemid;
            $_REQUEST['Itemid'] = $_Itemid;
            $QUERY_STRING[] = 'Itemid='.$_Itemid;
        } else {
            $_GET['id'] = 0;
            $_REQUEST['id'] = 0;
            $QUERY_STRING[] = 'id=0';

            $_GET['Itemid'] = intval($parts[$idx]);
            $_REQUEST['Itemid'] = intval($parts[$idx]);
            $QUERY_STRING[] = 'Itemid='.intval($parts[$idx]);
        }
        $ok = 1;
	}

	/* category table or category blog */
	if (!$ok && (!isset($parts[2]) || (!isset($parts[3]) && $blog))) {
		if ($blog) {
			$task = 'blogcategory';
			$task2 = 'blogsection';
		} else {
			$task = 'category';
			$task2 = 'section';
		}

		$_GET['task'] = $task;
        $_REQUEST['task'] = $task;
        $QUERY_STRING[] = 'task='.$task;

        $idx2 = ($idx + 1);
        $seosec = htmlspecialchars($parts[$idx], ENT_QUOTES);
        $seocat = htmlspecialchars($parts[$idx2], ENT_QUOTES);

		if (intval($seosec) && intval($seocat)) {
            $_GET['year'] = intval($seosec);
            $_REQUEST['year'] = intval($seosec);
            $QUERY_STRING[] = 'year='.intval($seosec);
            $_GET['month'] = intval($seocat);
            $_REQUEST['month'] = intval($seocat);
            $QUERY_STRING[] = 'month='.intval($seocat);
            $ok = 1;
		}

		if (!$ok) {
			$idjoin = $pg ? 's.id::VARCHAR = c.section' : 's.id = c.section';
        	$query = "SELECT c.id, c.section AS sectionid FROM #__categories c"
        	."\n LEFT JOIN #__sections s ON ".$idjoin
        	."\n WHERE c.seotitle='".$seocat."' AND c.published='1'"
        	."\n AND s.seotitle='".$seosec."' AND s.published='1'"
        	."\n AND s.scope='content'";
        	$database->setQuery($query, '#__', 1, 0);
        	$row = $database->loadRow();

        	if ($row && intval($row['id']) && intval($row['sectionid'])) {
            	$_GET['sectionid'] = intval($row['sectionid']);
            	$_REQUEST['sectionid'] = intval($row['sectionid']);
            	$QUERY_STRING[] = 'sectionid='.intval($row['sectionid']);

            	$_GET['id'] = intval($row['id']);
            	$_REQUEST['id'] = intval($row['id']);
            	$QUERY_STRING[] = 'id='.intval($row['id']);

				if (!$itemsyn) {
            		$query = "SELECT id FROM #__menu WHERE published='1'"
					."\n AND link='index.php?option=com_content&task=".$task."&sectionid=".intval($row['sectionid'])."&id=".intval($row['id'])."'"
					."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))";
            		$database->setQuery($query, '#__', 1, 0);
            		$_Itemid = intval($database->loadResult());
            	} else {
            		$_Itemid = $itemsyn;
            	}

            	if ($_Itemid) {
                	$_GET['Itemid'] = $_Itemid;
                	$_REQUEST['Itemid'] = $_Itemid;
                	$QUERY_STRING[] = 'Itemid='.$_Itemid;
                	$ok = 1;
            	}

				if (!$ok) {
            		$query = "SELECT id FROM #__menu"
					."\n WHERE link='index.php?option=com_content&task=".$task."&id=".intval($row['id'])."'"
					."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%$lang%'))";
            		$database->setQuery($query, '#__', 1, 0);
            		$_Itemid = intval($database->loadResult());
            		if ($_Itemid) {
                		$_GET['Itemid'] = $_Itemid;
                		$_REQUEST['Itemid'] = $_Itemid;
                		$QUERY_STRING[] = 'Itemid='.$_Itemid;
                		$ok = 1;
                	}
            	}

				if (!$ok) {
            		$query = "SELECT id FROM #__menu"
					."\n WHERE link='index.php?option=com_content&task=".$task2."&id=".intval($row['sectionid'])."'"
					."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%$lang%'))";
            		$database->setQuery($query, '#__', 1, 0);
            		$_Itemid = intval($database->loadResult());
            		if ($_Itemid) {
                		$_GET['Itemid'] = $_Itemid;
                		$_REQUEST['Itemid'] = $_Itemid;
                		$QUERY_STRING[] = 'Itemid='.$_Itemid;
                		$ok = 1;
                	}
            	}

				if (!$ok) {
                	$query = "SELECT id FROM #__menu WHERE published='1'"
					."\n AND link='index.php?option=com_content&task=".$task2."&sectionid=".intval($row['sectionid'])."'"
					."\n AND published='1' AND ((language IS NULL) OR (language LIKE '%$lang%'))";
                	$database->setQuery($query, '#__', 1, 0);
                	$_Itemid = intval($database->loadResult());

                	$_GET['Itemid'] = $_Itemid;
                	$_REQUEST['Itemid'] = $_Itemid;
                	$QUERY_STRING[] = 'Itemid='.$_Itemid;
                	$ok = 1;
            	}
        	} else {
        		pageNotFound();
        	}
        	$ok = 1;
        }
	}

	if (!$ok) { pageNotFound(); }

    $qs = '';
    if (count($QUERY_STRING) > 0) { $qs = implode('&',$QUERY_STRING); }
	if (trim($link[1]) != '') { $qs .= ($qs == '') ? $link[1] : '&'.$link[1]; }

    $_SERVER['QUERY_STRING'] = $qs;
	$_SERVER['REQUEST_URI'] = ($qs != '') ? '/index.php?'.$qs : '/index.php';
}

?>