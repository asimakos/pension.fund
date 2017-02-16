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


require_once($mainframe->getCfg('absolute_path').'/includes/HTML_toolbar.php' );

class HTML_content {


	/*********************************************************/
	/* HTML DISPLAY CONTENT LIST FOR SECTIONS AND CATEGORIES */
	/*********************************************************/
	static function showContentList( $title, $items, $access, $id=0, $sectionid=NULL, $params, $pageNav=NULL, $other_categories, $lists ) {
		global $Itemid, $mainframe;

		if ($sectionid) { $id = $sectionid; }
		if (strtolower(get_class( $title )) == 'mossection') {
			$is_section = true;
			$catid = 0;
		} else {
			$is_section = false;
			$catid = $title->id;
		}

		if ($params->get('page_title')) {
		?>
			<h1 class="componentheading<?php echo $params->get( 'pageclass_sfx' ); ?>"><?php echo $title->name; ?></h1>
		<?php 
		}
		?>

        <div class="contentpane<?php echo $params->get( 'pageclass_sfx' ); ?>">

			<?php 
			if (( $title->image != '' ) || ($title->description != '')) {
			?>
			<div class="contentdescription<?php echo $params->get( 'pageclass_sfx' ); ?>">
			<?php 
			if ($is_section) {
				if ($params->get('description_image') && $title->image) {
					$link = $mainframe->getCfg('ssl_live_site').'/images/stories/'.$title->image;
					echo '<img src="'.$link.'" align="'.$title->image_position.'" hspace="6" alt="'.$title->image.'" />'."\n";
				}
				if ($params->get('description')) {
					echo $title->description;
				}
			} else {
				if ($title->image) {
					$link = $mainframe->getCfg('ssl_live_site').'/images/stories/'.$title->image;
					echo '<img src="'.$link.'" align="'.$title->image_position.'" hspace="6" alt="'.$title->image.'" />'."\n";
				}
				echo $title->description;
			}
?>
			</div>
			<div style="clear:both;"></div>

			<?php 
			}
			?>
			<div class="tcs">
			<?php 
			//Displays the Table of Items in Category View
			if ( $items ) {
				self::showTable( $params, $items, $catid, $id, $pageNav, $access, $sectionid, $lists );
            } else if ( $catid ) {
                echo '<br />'._LEND;
                echo _EMPTY_CATEGORY.'<br /><br />'._LEND;
			}

			//Displays listing of Categories
			if (((count( $other_categories ) > 1) || (count($other_categories) < 2 && count($items) < 1))) {
				if (( $params->get( 'type' ) == 'category' ) && $params->get( 'other_cat' )) {
					self::showCategories( $params, $items, $other_categories, $catid, $id, $Itemid );
				}
				if (( $params->get( 'type' ) == 'section' ) && $params->get( 'other_cat_section' )) {
					self::showCategories( $params, $items, $other_categories, $catid, $id, $Itemid );
				}
			}
			?>
        	</div>
        </div>

<?php 
		mosHTML::BackButton( $params );
	}


	/****************************/
	/* HTML LINKS TO CATEGORIES */
	/****************************/
	static function showCategories( &$params, &$items, &$other_categories, $catid, $id, $Itemid ) {
        global $my, $mainframe;

		$direction = (_GEM_RTL) ? ' dir="rtl"' : '';

        if ($other_categories && $params->get('other_cat')) {
            $permits = explode(',', $my->allowed);
            $seosec = $params->get('seosec', '');

            echo '<ul>'._LEND;
            foreach ( $other_categories as $row ) {
                if ( $catid != $row->id ) {
                    echo '<li>'._LEND;
			        if (in_array($row->access, $permits)) {
                        $seolink = '';
                        if (($seosec != '') && ($row->seotitle != '')) {
                            $seolink = $seosec.'/'.$row->seotitle.'/';
                        }
                        $link = sefRelToAbs( 'index.php?option=com_content&task=category&sectionid='.$id.'&id='.$row->id.'&Itemid='.$Itemid, $seolink );
                        echo '<a href="'.$link.'" class="category" title="'.$row->name.'">'.$row->name.'</a>';
                        if ( $params->get( 'cat_items' ) ) {
                            echo ' <span'.$direction.' style="font-style: italic;">( '.$row->numitems.' '._CHECKED_IN_ITEMS.')</span>';
                        }
                        echo _LEND;
                        if ( $params->get( 'cat_description' ) && $row->description ) {
                            echo '<br />'._LEND;
                            echo $row->description;
                        }
                    } else if (($my->gid == '29') && $mainframe->getCfg('allowUserRegistration')) {
                        $link = sefRelToAbs( 'index.php?option=com_registration&task=register', 'registration/register.html' );
                        echo $row->name.' ';
                        echo '<span class="small">(<a href="'.$link.'" title="'._E_REGISTRATION.'">'._E_REGISTERED.'</a>)</span>'._LEND;
                    } else {
                        echo $row->name.' <span class="small">('._HIGHER_ACCESS.')</span>'._LEND;
                    }
                    echo '</li>'._LEND;
                }
            }
            echo '</ul>'._LEND;
        }
    }


	/******************************/
	/* HTML DISPLAY LIST OF ITEMS */
	/******************************/
	static private function showTable(&$params, &$items, $catid, $id, &$pageNav, &$access, &$sectionid, &$lists) {
		global $mainframe, $Itemid, $my;

		$permits = explode(',', $my->allowed);
        $seosec = $params->get('seosec', '');
        $seocat = $params->get('seocat', '');

		$link = 'index.php?option=com_content&task=category&sectionid='.$sectionid.'&id='.$catid.'&Itemid='.$Itemid;
		$seolink = (($seosec != '') && ($seocat != '')) ? $seosec.'/'.$seocat.'/' : '';
        ?>

		<form action="<?php echo sefRelToAbs($link, $seolink); ?>" method="post" name="adminForm">
		<div class="table">
            <div class="tablerow">
                <?php 
                if ( $params->get( 'filter' ) ) {
					echo '<label for"filtercontent">'._FILTER.'</label> ';
				?>
					<input type="text" name="filter" id="filtercontent" value="<?php echo $lists['filter']; ?>" class="inputbox" onchange="document.adminForm.submit();" /> 
				<?php
				}

				if ( $params->get( 'order_select' ) ) {
					echo _ORDER_DROPDOWN.'&nbsp;';
					echo $lists['order'].' ';
				}

				if (($mainframe->getCfg('sef') != 2) && $params->get('display')) {
					echo _PN_DISPLAY_NR.'&nbsp;';
					$link = 'index.php?option=com_content&task=category&sectionid='.$sectionid.'&id='.$catid.'&Itemid='.$Itemid;
					echo $pageNav->getLimitBox( $link );
				}
				?>
		  </div>
		</div>
		<input type="hidden" name="id" value="<?php echo $catid; ?>" />
		<input type="hidden" name="sectionid" value="<?php echo $sectionid; ?>" />
		<input type="hidden" name="task" value="<?php echo $lists['task']; ?>" />
		<input type="hidden" name="option" value="com_content" />
		</form>

		<div class="clear"></div>

        <ul class="table<?php echo $params->get('pageclass_sfx'); ?>">
        <?php 
		$k = 0;
		$seobase = (($seosec != '') && ($seocat != '')) ? $seosec.'/'.$seocat.'/' : '';
		foreach ( $items as $row ) {
        ?>
			<li class="sectiontableentry<?php echo ($k+1).$params->get( 'pageclass_sfx' ); ?>" >
            <?php 
			if ( $params->get( 'title' ) ) {
                if (in_array($row->access, $permits)) {
                    $seolink = ($seobase != '') ? $seobase.$row->seotitle.'.html' : '';
					$link = sefRelToAbs( 'index.php?option=com_content&task=view&id='.$row->id.'&Itemid='.$Itemid, $seolink);
				    echo '<a href="'.$link.'" title="'.$row->title.'">'.$row->title.'</a><br />'._LEND;
                } else if (($my->gid == '29') && $mainframe->getCfg('allowUserRegistration')) {
                    $link = sefRelToAbs('index.php?option=com_registration&task=register', 'registration/register.html');
                    echo $row->title.' ';
                    echo '<span class="small">(<a href="'.$link.'" title="'._E_REGISTRATION.'">'._READ_MORE_REGISTER.'</a>)</span><br />'._LEND;
                } else {
					echo $row->title.' <span class="small">('._HIGHER_ACCESS.')</span><br />'._LEND;
				}
			}
			if ($params->get('date')) {
                $row->created = mosFormatDate ($row->created, $params->get( 'date_format' ));
                echo '<div class="item_createdate">'._DATE.': '.$row->created.'</div>'._LEND;
			}
			if ($params->get('author')) {
                echo '<div class="item_author">'._HEADER_AUTHOR.': '.($row->created_by_alias ? $row->created_by_alias : $row->author).'</div>'._LEND;
			}
            if ($params->get('hits')) {
                echo '<div class="item_hits">'.intval($row->hits).' '._E_HITS.'</div>'._LEND;
            }
            if ($params->get('comments')) {
            	$txt = intval($row->comments) === 1 ? '1 '._E_COMMENT : $row->comments.' '._E_COMMENTS;
                echo '<div class="item_comments">'.$txt.'</div>'._LEND;
                unset($txt);
            }
			?>
			</li>
		<?php 
		  $k = 1 - $k;
        }
		?>
        </ul>
        <div class="clear"></div>

        <?php if ( $params->get( 'navigation' ) ) {
			$total_pages = ceil( $pageNav->total / $pageNav->limit );
			if ($total_pages > 1) {
		?>
        <div class="sectiontablefooter<?php echo $params->get('pageclass_sfx'); ?>">
			<?php 
			$link = 'index.php?option=com_content&amp;task=category&amp;sectionid='.$sectionid.'&amp;id='.$catid.'&amp;Itemid='.$Itemid;
            $seolink = '';
            if (($seosec != '') && ($seocat != '')) { $seolink = $seosec.'/'.$seocat.'/'; }
            echo $pageNav->writePagesLinks($link, $seolink);
            echo '<br />'._LEND;
            echo $pageNav->writePagesCounter();
            ?>
        </div>
        <div style="clear: both;"></div>
        <?php 
        	}
		}
		?>

		<?php 
		if ($access->canAdd) {
			$link = sefRelToAbs('index.php?option=com_content&task=new&Itemid='.$Itemid, 'submitted-content/new.html');
        ?>
            <br />
            <img src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/images/M_images/new.png" align="bottom" border="0" alt="<?php echo _E_ADDCONTENT; ?>" />
			<a href="<?php echo $link; ?>" title="<?php echo _E_ADDCONTENT; ?>"><?php echo _CMN_NEW; ?></a><br />
		<?php 
		}
	}


	/***************************************/
	/* HTML DISPLAY LINKS TO CONTENT ITEMS */
	/***************************************/
	static function showLinks( &$rows, $links, $total, $i=0, $show=1, $ItemidCount ) {
		global $mainframe, $mosConfig_sef, $Itemid;

		if ( $show ) {
		?>
			<div class="moreLinks"><?php echo _MORE; ?></div>
			<ul>
		<?php 
		}
		for ( $z = 0; $z < $links; $z++ ) {
			if ( $i >= $total ) {
				// stops loop if total number of items is less than the number set to display as intro + leading
				break;
			}

            $seolink = '';
            if (($rows[$i]->secseotitle != '') && ($rows[$i]->catseotitle != '')  && ($rows[$i]->seotitle != '')) {
                $seolink = $rows[$i]->secseotitle.'/'.$rows[$i]->catseotitle.'/'.$rows[$i]->seotitle.'.html';
			} else if ($rows[$i]->seotitle != '') { //autonomous page, not really used
                $seolink = $rows[$i]->seotitle.'.html';
			}

            $_Itemid = $Itemid;
            if ($mosConfig_sef != '2') {
                //needed to reduce queries used by getItemid
                $_Itemid = $mainframe->getItemid( $rows[$i]->id, 0, 0, $ItemidCount['bs'], $ItemidCount['bc'], $ItemidCount['gbs'] );
            }
            $link = sefRelToAbs('index.php?option=com_content&task=view&id='.$rows[$i]->id.'&Itemid='.$_Itemid, $seolink )
			?>
			<li>
                <a href="<?php echo $link; ?>" class="blogsection" title="<?php echo $rows[$i]->title; ?>">
                    <?php echo $rows[$i]->title; ?>
                </a>
			</li>
			<?php
			$i++;
		}
		?>
		</ul>
		<?php
	}


	/*****************************/
	/* HTML DISPLAY CONTENT ITEM */
	/*****************************/
	static public function show($row, $params, $access, $page=0, $option, $ItemidCount=NULL, $procomments=0) {
		global $mainframe, $my, $hide_js, $database, $Itemid, $task, $_MAMBOTS;

        if ($mainframe->getCfg('caching') && !isset($row->hits)) { //cache trick for hits
            $database->setQuery("SELECT hits FROM #__content WHERE id='".$row->id."'", '#__', 1, 0);
            $row->hits = intval($database->loadResult());
        }

        $permits = explode(',', $my->allowed);

		$gid = $my->gid;
		$_Itemid = $Itemid;
		$link_on = '';
		$link_text = '';

		//process the new bots
		$_MAMBOTS->loadBotGroup('content');
		$results = $_MAMBOTS->trigger('onPrepareContent', array( &$row, $params, $page ), true );

		//adds mospagebreak heading or title to <site> Title
		if (isset($row->page_title)) {
			$mainframe->setPageTitle($row->title .': '. $row->page_title);
		}

		// determines the link and link text of the readmore button
		if ($params->get('intro_only')) {
			// checks if the item is an allowed group item
			if (in_array($row->access, $permits)) {
				if ($task != "view") {
					$_Itemid = $mainframe->getItemid( $row->id, 0, 0, $ItemidCount['bs'], $ItemidCount['bc'], $ItemidCount['gbs'] );
				}

                $seolink = '';
				if (($row->secseotitle != '') && ($row->catseotitle != '') && ($row->seotitle != '')) {
				    $seolink = $row->secseotitle.'/'.$row->catseotitle.'/'.$row->seotitle.'.html';
				} else if ($row->seotitle != '') { //autonomous page
				    $seolink = $row->seotitle.'.html';
				}
				$link_on = sefRelToAbs("index.php?option=com_content&task=view&id=".$row->id."&Itemid=".$_Itemid, $seolink);

                if ( strlen( trim( $row->maintext ) )) {
					$link_text = _READ_MORE;
				}
			} else {
				$link_on = sefRelToAbs('index.php?option=com_registration&task=register', 'registration/register.html');
				if (strlen( trim( $row->maintext ) )) {
					$link_text = _READ_MORE_REGISTER;
				}
			}
		}

		$no_html = mosGetParam( $_REQUEST, 'no_html', null);

		//for pop-up page
		if ( $params->get( 'popup' ) && $no_html == 0) {
?>
			<title><?php echo $row->title.' - '.$mainframe->getCfg('sitename'); ?></title>
			<?php
		}

		//determines links to next and prev content items within category
		if ($params->get('item_navigation')) {
			if ( $row->prev ) {
				$row->prev = sefRelToAbs( 'index.php?option=com_content&task=view&id='.$row->prev.'&Itemid='.$_Itemid );
			} else {
				$row->prev = 0;
			}
			if ( $row->next ) {
				$row->next = sefRelToAbs( 'index.php?option=com_content&task=view&id='.$row->next.'&Itemid='.$_Itemid );
			} else {
				$row->next = 0;
			}
		}

        if ( $params->get('item_title')) {
            HTML_content::Title( $row, $params, $link_on );
        }

		if ($procomments) {
			$iconbots = $_MAMBOTS->trigger('onContentIcons', array(&$row, $params, $page), true);
		} else {
			$iconbots = array();
		}
        if ($params->get('pdf') || $params->get('rtf') || $params->get('print') || $params->get('email') || $iconbots) {
        	$align = (_GEM_RTL) ? 'left' : 'right';
			$print_link = $mainframe->getCfg('live_site').'/index2.php?option=com_content&amp;task=view&amp;id='.$row->id.'&amp;Itemid='.$Itemid.'&amp;pop=1&amp;page='.@$page;
            echo '<div align="'.$align.'" class="buttonheading'.$params->get('pageclass_sfx').'">'._LEND;
			if (is_array($iconbots) && (count($iconbots) > 0)) { echo implode("\n", $iconbots); }
            self::RtfIcon($row, $params, $hide_js);
            self::PdfIcon($row, $params, $link_on, $hide_js);
            mosHTML::PrintIcon($row, $params, $hide_js, $print_link);
            self::EmailIcon($row, $params, $hide_js);
            echo '</div>'._LEND;
        }
		unset($iconbots);

		if (!$params->get('intro_only')) {
			$results = $_MAMBOTS->trigger( 'onAfterDisplayTitle', array(&$row, $params, $page));
			echo trim(implode( "\n", $results ));
		}

		$results = $_MAMBOTS->trigger( 'onBeforeDisplayContent', array(&$row, $params, $page));
		echo trim(implode("\n", $results));

		//displays Section & Category
		self::Section_Category($row, $params);
		//displays Author Name
		self::Author( $row, $params );
		//displays Created Date
		self::CreateDate($row, $params);

		//Get parameters for the specific object
        $itemparams = new mosParameters( $row->attribs );

		//displays Table of Contents
		self::TOC( $row );

        echo '<div id="elxisarticle'.$row->id.'" class="contentpaneopen_text'.$itemparams->get('textclass_sfx').'">'._LEND;
        echo $row->text._LEND;
        echo '</div>'._LEND;
        echo '<div style="clear:both;"></div>'._LEND;

		//displays comments number
		self::Comments($row, $params);

		//displays related Urls
		self::URL($row, $params);
		//displays Modified Date
		self::ModifiedDate($row, $params);
		//displays Readmore button
		self::ReadMore( $params, $link_on, $link_text );

		$results = $_MAMBOTS->trigger('onAfterDisplayContent', array( &$row, $params, $page));
		echo trim(implode( "\n", $results));

		//displays the next & previous buttons
		self::Navigation($row, $params);

		//display comments and comments form
		if ($procomments) {
			self::processComments($row, $params);
		}

		//displays close button in pop-up window
		mosHTML::CloseButton($params, $hide_js);
		//displays back button in pop-up window
		mosHTML::BackButton($params, $hide_js);
	}


	/**********************/
	/* DISPLAY ITEM TITLE */
	/**********************/
	static function Title( $row, $params, $link_on ) {
        $tag = preg_match('/blog/', $_SERVER['REQUEST_URI']) ? 'h2' : 'h1';
		if ($params->get('item_title')) {
			if ($params->get('link_titles') && ($link_on != '')) {
                echo '<'.$tag.' class="contentheading'.$params->get('pageclass_sfx').'">'._LEND;
                echo '<a href="'.$link_on.'" class="contentpagetitle'.$params->get( 'pageclass_sfx' ).'" title="'.$row->title.'">'.$row->title.'</a>'._LEND;
                echo '</'.$tag.'>'._LEND;
			} else {
                echo '<'.$tag.' class="contentheading'.$params->get('pageclass_sfx').'">'.$row->title.'</'.$tag.'>'._LEND;
			}
		}
	}


	/* Edit is not permitted in Elxis 2008 */
	static function EditIcon( $row, $params, $access ) {
	/*
		global $mosConfig_live_site, $Itemid, $my;

		if ( $params->get( 'popup' ) ) { return; }
		if ( $row->state < 0 ) { return; }
		if ( !$access->canEdit && !( $access->canEditOwn && $row->created_by == $my->id ) ) {
			return;
		}
		$link = 'index.php?option=com_content&amp;task=edit&amp;id='. $row->id .'&amp;Itemid='. $Itemid .'&amp;Returnid='. $Itemid;
		$image = mosAdminMenus::ImageCheck( 'edit.png', '/images/M_images/', NULL, NULL, _E_EDIT );
		?>
		<a href="<?php echo sefRelToAbs( $link ); ?>" title="<?php echo _E_EDIT; ?>">
		<?php echo $image; ?>
		</a>
		<?php
		if ( $row->state == 0 ) {
			echo ' <small>( '. _CMN_UNPUBLISHED .' )</small>';
		}
		echo '  <small>( '. $row->groups .' )</small>';
	*/
	}


	/*************************/
	/* DISPLAY PDF ICON LINK */
	/*************************/
	static private function PdfIcon($row, $params, $link_on, $hide_js) {
		global $mainframe;

		if ($params->get('pdf') && !$params->get('popup') && !$hide_js) {
			$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';
			$link = $mainframe->getCfg('live_site').'/index2.php?option=com_content&amp;do_pdf=1&amp;id='.$row->id;
			$image = ($params->get('icons')) ? mosAdminMenus::ImageCheck('pdf_button.png', '/images/M_images/', NULL, NULL, _CMN_PDF) : _CMN_PDF;
			echo '<a href="javascript:void window.open(\''.$link.'\', \'PDFwindow\', \''.$status.'\');" title="'._CMN_PDF.'">';
            echo $image.'</a> '._LEND;
		}
	}


	/*************************/
	/* DISPLAY RTF ICON LINK */
	/*************************/
	static private function RtfIcon($row, $params, $hide_js) {
		global $mainframe;

		if ($params->get('rtf') && !$params->get('popup') && !$hide_js) {
			$link = $mainframe->getCfg('live_site').'/index2.php?do_rtf=1&amp;id='.$row->id;
			$image =($params->get('icons')) ? mosAdminMenus::ImageCheck('rtf_button.png', '/images/M_images/', NULL, NULL, 'RTF') : 'RTF';
			echo '<a href="'.$link.'" title="RTF (MS word)" target="_blank">'.$image.'</a> '._LEND;
		}
	}


	/**********************/
	/* DISPLAY EMAIL ICON */
	/**********************/
	static private function EmailIcon($row, $params, $hide_js) {
		global $mainframe, $Itemid;

		if ($params->get('email') && !$params->get('popup') && !$hide_js) {
			$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=450,height=350,directories=no,location=no';
			$link = $mainframe->getCfg('live_site') .'/index2.php?option=com_content&amp;task=emailform&amp;id='.$row->id.'&amp;Itemid='.$Itemid;
			$image = ($params->get('icons')) ? mosAdminMenus::ImageCheck('emailButton.png', '/images/M_images/', NULL, NULL, _CMN_EMAIL) : _CMN_EMAIL;
			echo '<a href="javascript:void window.open(\''.$link.'\', \'EmailWindow\', \''.$status.'\');" title="'._CMN_EMAIL.'">';
			echo $image.'</a> '._LEND;
		}
	}


	/***************************************/
	/* DISPLAY ITEM'S SECTION AND CATEGORY */
	/***************************************/
	static function Section_Category( $row, $params ) {
		if ( $params->get( 'section' ) || $params->get( 'category' ) ) {
			echo '<div class="item_sectioncategory">'._LEND;
			if ( $params->get( 'section' ) && ($row->section != '')) {
				echo $row->section._LEND;
				if ( $params->get( 'category' ) ) { echo ' - '; }
            }
            if ( $params->get( 'category' ) ) {
                echo $row->category._LEND;
            }
            echo '</div>'._LEND;
		}
	}


	/*************************/
	/* DISPLAY ITEM'S AUTHOR */
	/*************************/
	static function Author( $row, $params ) {
		global $acl;

		if ( ( $params->get( 'author' ) ) && ( $row->author != "" ) ) {
			$grp = $acl->getAroGroup( $row->created_by );
			$gname_pubfront = $acl->get_group_name('29');
			$is_frontend_user = $acl->is_group_child_of( intval( $grp->group_id ), $gname_pubfront, 'ARO' );
			$by = $is_frontend_user ? _AUTHOR_BY : _WRITTEN_BY;

            echo '<div class="item_author">'.$by.' '.($row->created_by_alias ? $row->created_by_alias : $row->author).'</div>'._LEND;
		}
	}


	/********************************/
	/* DISPLAY ITEM'S CREATION DATE */
	/********************************/
	static function CreateDate( $row, $params ) {
		if ( $params->get( 'createdate' ) ) {
			if ((intval( $row->created ) > 0) && ($row->created != '1979-12-19 00:00:00')) {
                $create_date = mosFormatDate( $row->created );
                echo '<div class="item_createdate">'.$create_date.'</div>'._LEND;
            }
        }
	}


	/*************************************/
	/* DISPLAY ITEM'S NUMBER OF COMMENTS */
	/*************************************/
	static private function Comments($row, $params) {
        if ($params->get('comments') && isset($row->comments)) {
            $txt = intval($row->comments) === 1 ? '1 '._E_COMMENT : $row->comments.' '._E_COMMENTS;
            echo '<div class="item_comments">'.$txt.'</div>'._LEND;
        }
	}


	/*********************************/
	/* DISPLAY RELATED TO ITEM URL'S */
	/*********************************/
	static function URL( $row, $params ) {
        if ( !$params->get( 'intro_only' ) && $params->get( 'url' ) && $row->urls ) {
            if (trim($row->urls) != '') {
                $parts = preg_split('/[\n]/', $row->urls, -1, PREG_SPLIT_NO_EMPTY);
                if (count($parts) > 0) {
                    echo '<div class="item_related">'._LEND;
                    echo '<strong>'._E_RELLINKS.':</strong><br />'._LEND;
                    foreach ($parts as $part) {
                        $link = preg_split('/[\|]/', $part, 2);
                        if (($link[0] != '') && ($link[1] != '')) {
                            $target = (preg_match('/http/i', $link[1])) ? ' target="_blank"' : '';
                            echo '<a href="'.trim($link[1]).'" title="'.$link[0].'"'.$target.'>'.$link[0].'</a><br />'._LEND;
                        }
                    }
                    echo '</div>'._LEND;
                }
            }
        }
	}


	/*****************************/
	/* DISPLAY TABLE OF CONTENTS */
	/*****************************/
	static function TOC( $row ) {
		if (isset($row->toc)) { echo $row->toc; }
	}


	/*****************************************/
	/* DISPLAY ITEM'S LAST MODIFICATION DATE */
	/*****************************************/
	static function ModifiedDate( $row, $params ) {
		if ( $params->get( 'modifydate' ) ) {
            if ((intval( $row->modified ) > 0) && ($row->modified != '1979-12-19 00:00:00')) {
                $mod_date = mosFormatDate( $row->modified );
                echo '<div class="item_modifydate">'._LAST_UPDATED.' '.$mod_date.'</div>'._LEND;
            }
        }
	}


	/**************************/
	/* DISPLAY READ MORE LINK */
	/**************************/
	static function ReadMore( $params, $link_on, $link_text ) {
		if ( $params->get( 'readmore' ) ) {
			if ( $params->get( 'intro_only' ) && $link_text ) {
				?>
					<a href="<?php echo $link_on; ?>" class="readon<?php echo $params->get( 'pageclass_sfx' ); ?>" title="<?php echo _READ_MORE; ?>" >
                        <?php echo $link_text; ?>
					</a><br />

				<?php
			}
		}
	}


	/**********************************************/
	/* DISPLAY PREVIOUS AND NEXT NAVIGATION LINKS */
	/**********************************************/
	static function Navigation( $row, $params ) {
		$task = mosGetParam( $_REQUEST, 'task', '' );
		if ( $params->get( 'item_navigation' ) && ( $task == "view" ) && !$params->get( 'popup' ) ) {
			$direction = (_GEM_RTL) ? ' dir="rtl"' : '';
            echo '<div align="center">'._LEND;
			if ( $row->prev ) {
				echo '<span'.$direction.' class="pagenav_prev">'._LEND;
				echo "\t<a href=\"".$row->prev."\" title=\""._CMN_PREV."\">&lt; "._CMN_PREV."</a>"._LEND;
				echo '</span>'._LEND;
			}
			if ( $row->next ) {
				echo '<span'.$direction.' class="pagenav_next">'._LEND;
				echo "\t<a href=\"".$row->next."\" title=\""._CMN_NEXT."\">"._CMN_NEXT." &gt;</a>"._LEND;
				echo '</span>'._LEND;
			}
            echo '</div>'._LEND;
		}
	}


	/******************************/
	/* HTML ADD/EDIT CONTENT ITEM */
	/******************************/
	static function editContent($row, $lists, $sectioncategories) {
		global $Itemid, $mainframe, $my, $lang;

        //CSRF prevention
        $tokname = 'token'.$my->id;
		$mytoken = md5(uniqid(rand(), TRUE));
        $_SESSION[$tokname] = $mytoken;

		mosMakeHtmlSafe( $row );
		$settitle = ($row->id) ? _E_EDITCONTENT : _E_ADDCONTENT;
		$isoL = '';
		if (($mainframe->getCfg('sef') == 2) && ($lang != $mainframe->getCfg('lang'))) {
			$isoL = eLOCALE::elxis_iso639($lang);
			if ($isoL != '') { $isoL = '/'.$isoL; }	
		}
		$seoCancel = ($mainframe->getCfg('sef') == 2) ? $mainframe->getCfg('live_site').$isoL.'/submitted-content/' : 'index.php?option=com_content&task=subcontent&Itemid='.$Itemid;
		$seoAction = ($mainframe->getCfg('sef') == 2) ? $mainframe->getCfg('live_site').$isoL.'/submitted-content/save.html' : 'index.php';
		?>
		<script type="text/javascript">
		<!--
		var sectioncategories = new Array;
		<?php
		$i = 0;
		foreach ($sectioncategories as $k=>$items) {
			foreach ($items as $v) {
				echo "sectioncategories[".$i++."] = new Array( '$k','".addslashes( $v->value )."','".addslashes( $v->text )."' );\n\t\t";
			}
		}
		?>

		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
                document.location.href = '<?php echo $seoCancel; ?>';
				return;
			}
			try {
				form.onsubmit();
			}
			catch(e){}

			if (form.title.value == "") {
				alert ( "<?php echo _E_WARNTITLE; ?>" );
			} else if (getSelectedValue('adminForm','catid') < 1) {
				alert ( "<?php echo _E_WARNCAT; ?>" );
			//} else if (form.introtext.value == "") {
				//alert ( "<?php echo _E_REQFIELDS_EMPTY; ?>" );
			} else {
				<?php 
				getEditorContents( 'editor1', 'introtext' );
				getEditorContents( 'editor2', 'maintext' );
				?>
				submitform(pressbutton);
			}
		}
		//-->
		</script>

		<h1 class="contentheading"><?php echo _E_CONTENTSUB; ?>: <?php echo $row->id ? _E_EDIT : _E_ADD; ?></h1>

		<form action="<?php echo $seoAction; ?>" method="post" name="adminForm">
			<strong><?php echo $settitle; ?></strong>
			<table width="100%" border="0" cellspacing="2" cellpadding="0" summary="User submitted content item">
				<tr>
					<td><?php echo _E_TITLE; ?>:</td>
					<td colspan="3">
						<input class="inputbox" type="text" name="title" title="<?php echo _E_TITLE; ?>" size="50" maxlength="100" value="<?php echo $row->title; ?>" />
					</td>
				</tr>
				<tr>
					<td colspan="2"><?php echo _E_SUGSECTION; ?>:</td>
					<td colspan="2"><?php echo $lists['sectionid']; ?></td>
				</tr>
				<tr>
					<td colspan="2"><?php echo _E_SUGCATEGORY; ?>:</td>
					<td colspan="2"><?php echo $lists['catid']; ?></td>
				</tr>
				<tr>
					<td valign="top"><?php echo _E_LANGUAGE; ?>:</td>
					<td valign="top"><?php echo $lists['languages']; ?></td>
					<td valign="top"><?php echo _E_ACCESS_LEVEL; ?>:</td>
					<td valign="top"><?php echo $lists['access']; ?></td>
				</tr>
			</table>
			<?php 
			echo _E_INTRO.' ('._CMN_REQUIRED.'):<br />'._LEND;
			//parameters : areaname, content, hidden field, width, height, rows, cols
			editorArea( 'editor1', $row->introtext, 'introtext', '450', '300', '45', '15');
			echo _LEND;
			echo _E_MAIN.' ('._CMN_OPTIONAL.'):<br />'._LEND;
			//parameters : areaname, content, hidden field, width, height, rows, cols
			editorArea( 'editor2',  $row->maintext , 'maintext', '450', '300', '45', '15' );
            ?>
            <br />
            <?php echo _E_COMMENTS; ?>:<br />
            <textarea name="comments" class="text_area" cols="45" rows="3" title="<?php echo _E_COMMENTS; ?>"><?php echo $row->comments; ?></textarea><br />
			<?php 
			if ($lists['autopub']) {
				echo _E_PUBLISHING.': <input type="checkbox" name="autopub" value="1" /><br />';
			}
			?>
			<input type="hidden" name="option" value="com_content" />
			<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
			<input type="hidden" name="created" value="<?php echo $row->created; ?>" />
			<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="<?php echo $tokname; ?>" value="<?php echo $mytoken; ?>" autocomplete="off" />
			<p align="center">
				<input type="button" name="submitit" value="<?php echo _E_SAVE; ?>" title="<?php echo _E_SAVE; ?>" class="button" onclick="submitbutton('save');" /> &nbsp; 
				<input type="button" name="subcontent" value="<?php echo _GEM_CANCEL; ?>" title="<?php echo _GEM_CANCEL; ?>" class="button" onclick="submitbutton('cancel');" />
			</p>
		</form>
		<div style="clear:both;"></div>

<?php
	}


	/***************************/
	/* HTML DISPLAY EMAIL FORM */
	/***************************/
	static public function emailForm($uid, $title) {
		global $mainframe, $Itemid, $lang;

		$form_check = $_SESSION['_form_check_']['com_content'] = crypt(time());
		$random = rand(100, 999);
		$direct = (_GEM_RTL) ? ' dir="rtl"' : '';
?>
		<script type="text/javascript">
		/* <![CDATA[ */
		function submitbutton() {
			var form = document.mailfriendform;
			if (form.email.value == "" || form.youremail.value == "") {
				alert( '<?php echo addslashes( _EMAIL_ERR_NOINFO ); ?>' );
				return false;
			}
			return true;
		}
		/* ]]> */
		</script>

		<strong><?php echo $title; ?></strong>
		<form action="index2.php" name="mailfriendform" method="post" onsubmit="return submitbutton();" style="width: 95%;">
			<input type="hidden" name="form_check" value="<?php echo $form_check; ?>" />
			<input type="hidden" name="id" value="<?php echo $uid; ?>" />
			<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
			<input type="hidden" name="mylang" value="<?php echo $lang; ?>" />
			<input type="hidden" name="option" value="com_content" />
			<input type="hidden" name="task" value="emailsend" />
			<fieldset>
				<legend><?php echo _EMAIL_FRIEND; ?></legend>
				<label for="email<?php echo $random; ?>"<?php echo $direct; ?>><?php echo _EMAIL_FRIEND_ADDR; ?>:</label><br />
				<input type="text" name="email" id="email<?php echo $random; ?>" dir="ltr" class="inputbox" size="25" maxlength="60" title="<?php echo _EMAIL_FRIEND_ADDR; ?>" /><br />
				<label for="yourname<?php echo $random; ?>"<?php echo $direct; ?>><?php echo _EMAIL_YOUR_NAME; ?>:</label><br />
				<input type="text" name="yourname" id="yourname<?php echo $random; ?>" class="inputbox" size="25" maxlength="50" title="<?php echo _EMAIL_YOUR_NAME; ?>" /><br />
				<label for="youremail<?php echo $random; ?>"<?php echo $direct; ?>><?php echo _EMAIL_YOUR_MAIL; ?>:</label><br />
				<input type="text" name="youremail" id="youremail<?php echo $random; ?>" dir="ltr" class="inputbox" size="25" maxlength="60" title="<?php echo _EMAIL_YOUR_MAIL; ?>" /><br />
				<label for="subject<?php echo $random; ?>"<?php echo $direct; ?>><?php echo _SUBJECT_PROMPT; ?>:</label><br />
				<input type="text" name="subject" id="subject<?php echo $random; ?>" class="inputbox" maxlength="100" size="40" title="<?php echo _SUBJECT_PROMPT; ?>" /><br />
				<p align="center">
					<input type="submit" name="submit" class="button" value="<?php echo _BUTTON_SUBMIT_MAIL; ?>" title="<?php echo _BUTTON_SUBMIT_MAIL; ?>" /> &nbsp; &nbsp; 
					<input type="button" name="cancel" class="button" value="<?php echo _GEM_CANCEL; ?>" onclick="window.close();" title="<?php echo _GEM_CANCEL; ?>" />				
				</p>
			</fieldset>
		</form>
<?php 
	}


	/*****************************************/
	/* HTML DISPLAY SENT E-MAIL MSG IN POPUP */
	/*****************************************/
	static function emailSent( $to ) {
		global $mainframe;
?>
		<strong><?php echo $mainframe->getCfg('sitename'); ?></strong>
		<p><?php echo _EMAIL_SENT.' '.$to; ?></p><br /><br />
		<br />
		<a href="javascript:window.close();" title="<?php echo _PROMPT_CLOSE; ?>"><?php echo _PROMPT_CLOSE; ?></a>
	<?php 
	}


    /**********************************/
    /* HTML DISPLAY SUBMITTED CONTENT */
    /**********************************/
    static function submittedContent($rows, $currows, $articles=0, $access) {
        global $Itemid;
?>
        <h1 class="componentheading"><?php echo _E_CONTENTSUB; ?></h1>
        <p align="justify"><?php echo _E_CONTENTSUBD1.' '._E_CONTENTSUBD2; ?></p>
        <p><?php printf(_E_CURARTICLYOU, $articles); ?></p>

<?php 
		$rtl = (_GEM_RTL) ? ' dir="rtl"' : '';
        if ($access->canAdd) {
            $addlink = sefRelToAbs('index.php?option=com_content&task=new&Itemid='.$Itemid, 'submitted-content/new.html');
            echo '<a href="'.$addlink.'" title="'._E_ADD.'">'._E_ADD.'</a><br />'._LEND;
        }

        if ($rows) {
            echo '<h3>'._E_SUBCONWAIT.'</h3>'._LEND;
            echo '<ul class="table">'._LEND;
            $k = 0;
            for($i=0; $i<count($rows); $i++) {
                $row = $rows[$i];

                echo '<li class="row'.$k.'">'._LEND;
                if ($access->canEdit || $access->canEditOwn) {
                    $editlink = sefRelToAbs('index.php?option=com_content&task=edit&id='.$row->id.'&Itemid='.$Itemid, 'submitted-content/edit.html?id='.$row->id);
                    echo '<a href="'.$editlink.'" title="'._E_EDIT.'">'.$row->title.'</a><br />';
                } else {
                    echo $row->title.'<br />';
                }
                echo '<div class="item_createdate"'.$rtl.'>'._HEADER_SUBMITTED.' '.mosFormatDate($row->created).'</div>'._LEND;
                echo '</li>'._LEND;
                $k = 1 - $k;
            }
            echo '</ul><br />'._LEND;
        }

        if ($currows) {
            echo '<h3>'._E_LASTPUBART.'</h3>'._LEND;
            echo '<ul class="table">'._LEND;
            $k = 0;
            for($i=0; $i<count($currows); $i++) {
                $crow = $currows[$i];

                $viewlink = sefRelToAbs('index.php?option=com_content&task=view&id='.$crow->id);
                echo '<li class="row'.$k.'">'._LEND;
                echo '<a href="'.$viewlink.'" title="'.$crow->title.'">'.$crow->title.'</a><br />'._LEND;
                echo '<div class="item_hits"'.$rtl.'>'._E_HITS.': '.$crow->hits.'</div>'._LEND;
                echo '<div class="item_createdate"'.$rtl.'>'._HEADER_SUBMITTED.' '.mosFormatDate($crow->created).'</div>'._LEND;
                echo '</li>'._LEND;
                $k = 1 - $k;
            }
            echo '</ul><br />'._LEND;
        }
    }


	/*************************/
	/* PROCESS COMMENTS HTML */
	/*************************/
	static private function processComments($row, $params) {
		global $mainframe, $my, $Itemid, $lang;

		$postComment = (int)$params->get('post_comments', 0);
		if (!$postComment) { return; } //comments are disabled for this article

		//check if user can delete comments and/or see additional info
		$fullAccess = 0;
		if ($my->id && (($my->id == $row->created_by) || ($my->gid == 25))) { $fullAccess = 1; }

		if ($postComment === 1) { //registered
			$postComment = (intval($my->id) > 0) ? 1 : 0;
		} elseif ($postComment === 2) { //everybody can post comments
			$postComment = 1;
		} else { $postComment = 0; } //just in case...
		
		$form_check = $_SESSION['_form_check_']['com_content'] = crypt(time());
?>

		<div class="elxis-comments">
		<h3 class="elxis-commentstitle"><?php echo (count($row->comments) == 1) ? '1 '._E_COMMENT : count($row->comments).' '._E_COMMENTS; ?></h3>

<?php 
		if ($row->comments && (count($row->comments) > 0)) {
			$k = 0;

			$avdir = $mainframe->getCfg('absolute_path').'/images/avatars/';
			$dirl = _GEM_RTL ? 'right' : 'left';
			$dirr = _GEM_RTL ? 'left' : 'right';
			
			for ($i=0; $i<count($row->comments); $i++) {
				$com = $row->comments[$i];

				$avatar = ((trim($com->avatar) != '') && file_exists($avdir.$com->avatar)) ? $com->avatar : 'noavatar.png';
				$usern = (trim($com->username) != '') ? $com->username : _E_VISITOR;
				$unpubcol = ($com->published == 1) ? '' : ' color: #888;';
				$candelete = ($fullAccess == 1) ? 1 : ($my->id && ($com->userid == $my->id)) ? 1 : 0;
?>

				<div class="commentsrow">
					<div style="width: 70px; text-align: center; float: <?php echo $dirl; ?>;">
						<img src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/images/avatars/<?php echo $avatar; ?>" width="50" height="50" alt="<?php echo $usern; ?>" title="<?php echo $usern; ?>" border="0" />
<?php 
					if ($candelete) {
						$deleteLink = $mainframe->getCfg('live_site').'/index2.php?option=com_content&amp;task=delcomment&amp;id='.$row->id.'&amp;comid='.$com->cid.'&amp;Itemid='.$Itemid.'&amp;mylang='.$lang;
						echo '<div style="margin: 5px 0;">'._LEND;
						echo '<a href="mailto:'.$com->email.'" title="'.$com->email.'"><img src="'.$mainframe->getCfg('ssl_live_site').'/images/M_images/emailButton.png" alt="'._CMN_EMAIL.'" /></a>';
						echo ' <a href="'.$deleteLink.'" title="'._CMN_DELETE.'"><img src="'.$mainframe->secureURL($eblog->url).'/images/M_images/delete.png" alt="'._CMN_DELETE.'" /></a>';
						echo "</div>\n";
					}
?>
					</div>
					<div style="margin-<?php echo $dirl; ?>: 70px;">
						<div>
							<div class="item_author" style="float: <?php echo $dirl; ?>; width:60%;">
								<strong><?php echo $com->author; ?></strong> 
<?php if ($fullAccess) { ?>
								<span<?php echo _GEM_RTL ? ' dir="rtl"': ''; ?>>(<?php echo $com->ipaddress; ?>)</span>
<?php } ?>
							</div>
							<div class="item_createdate" style="float: <?php echo $dirr; ?>;"><?php echo eLocale::strftime_os("%d %B %Y, %H:%M", $com->ctimestamp); ?></div>
						</div>
						<div style="clear: <?php echo $dirr; ?>;"></div>
						<div style="font-size: 0.92em;<?php echo $unpubcol; ?>; text-align: justify; padding: 4px 0;">
							<?php echo $com->cmessage; ?>
<?php 
	if (($com->published == 0) && $fullAccess) {
		$pubLink = $mainframe->getCfg('live_site').'/index2.php?option=com_content&amp;task=pubcomment&amp;id='.$row->id.'&amp;comid='.$com->cid.'&amp;Itemid='.$Itemid.'&amp;mylang='.$lang;
		echo '<br /><span style="color: #CC0000;">'._CMN_UNPUBLISHED.'</span> | <a href="'.$pubLink.'" title="'._GEM_UNPUBL_ITEM.'">'._GEM_UNPUBL_ITEM.'</a>'._LEND;
	}
?>						
						</div>
					</div>
				</div>
				<div style="clear: both;"></div>
<?php 
			}
			unset($avdir, $dirl, $dirr, $avatar, $usern, $unpubcol, $candelete);
		} else {
			echo '<p>'._E_NOCOMMENTS;
			if ($postComment) { echo ' '._E_FIRSTCOMMENT; }
			echo "</p>\n";
		}

		if (!$postComment) {
			echo '<p>'._E_MUSTLOGTOCOM."</p>\n";
		} else {

			$random = rand(104, 996);
			$rtl = (_GEM_RTL) ? ' dir="rtl"' : '';
?>

			<script type="text/javascript">
			/* <![CDATA[ */
			function elxpostccheck() {
				var cform = document.elxiscomform;
				
				if (cform.commessage.value == '') {
					alert('<?php echo _E_COMCNOTEMPTY; ?>');
					cform.commessage.focus();
				}
<?php 
			if (!$my->id) {
?>
				else if (cform.comauthor.value == '') {
					alert('<?php echo _E_REGWARN_NAME; ?>');
					cform.comauthor.focus();
				} else if ((cform.comemail.value.search("@") == -1) || (cform.comemail.value.search("[.*]" ) == -1)) {
					alert('<?php echo _E_REGWARN_MAIL; ?>');
					cform.comemail.focus();
				}

<?php 
			}
			if ($mainframe->getCfg('captcha')) {
?> 
				else if (cform.code.value == '') {
					alert('<?php echo _E_INV_SECCODE; ?>');
					cform.code.focus();
				}
<?php 
			}
?>
				else {
					cform.submit();
				}
			}

        	function captchaPlayer() {
            	window.open('<?php echo $mainframe->getCfg('live_site'); ?>/includes/captcha/listen.php','','width=200,height=100,top=250,left=450,toolbar=no,location=no,resizable=no,menubar=no');
        	}
			/* ]]> */
			</script>

			<form name="elxiscomform" method="post" action="index2.php" id="elxiscomform">
			<fieldset class="elxisfieldset">
				<legend><?php echo _E_POSTCOMMENT; ?></legend>
				<?php if (!$my->id) { ?>
				<label for="comauthor"<?php echo $rtl; ?> class="elxislabel"><?php echo _CMN_NAME; ?></label> 
				<input type="text" id="comauthor" name="comauthor" class="inputbox" value="" title="<?php echo _CMN_NAME; ?>" />
				<br style="clear: both;" />
				<label for="comemail"<?php echo $rtl; ?> class="elxislabel"><?php echo _CMN_EMAIL; ?></label> 
				<input type="text" id="comemail" name="comemail" class="inputbox" dir="ltr" value="" title="<?php echo _CMN_EMAIL; ?>" /> 
				<span style="color: #777;"><?php echo defined('_E_WONTPUBLISHED') ? _E_WONTPUBLISHED : 'It will not be published'; ?></span>
				<br style="clear: both;" />
				<?php } ?>
				<label for="commessage"<?php echo $rtl; ?> class="elxislabel"><?php echo _E_COMMENT; ?></label>
				<textarea id="commessage" name="commessage"<?php echo $rtl; ?> class="text_area" rows="6" cols="50"></textarea>
				<br style="clear: both;" />
				<div style="margin: 5px 0; padding: <?php echo (_GEM_RTL == 1) ? '0 30% 0 0' : '0 0 0 30%'; ?>;">
				<input type="checkbox" name="comnotify" value="1" /> 
				<?php echo defined('_E_NOTIFYREPLY') ? _E_NOTIFYREPLY : 'Notify me via e-mail on replies'; ?>
				</div>
				<?php if ($mainframe->getCfg('captcha')) { ?>
					<label class="elxislabel"><?php echo _E_SECCODE; ?></label>
					<img src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/includes/captcha/captcha.img.php" alt="<?php echo _E_SPELL; ?>" border="0" />
                    <a href="javascript:captchaPlayer('<?php echo $_SESSION['captchasnd']; ?>');" title="<?php echo _E_SPELL; ?>"><img src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/includes/captcha/speaker.gif" alt="<?php echo _E_SPELL; ?>" /></a>
					<br style="clear: both;" />
					<label for="code<?php echo $random; ?>"<?php echo $rtl; ?> class="elxislabel"><?php echo _E_TYPE_SECCODE; ?></label> 
					<input type="text" name="code" id="code<?php echo $random; ?>" class="inputbox" dir="ltr" value="" size="10" maxlength="10" title="<?php echo _E_SECCODE; ?>" />
					<br style="clear: both;" />
				<?php } ?>
				<input type="hidden" name="form_check" value="<?php echo $form_check; ?>" />
				<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
				<input type="hidden" name="articleid" value="<?php echo $row->id; ?>" />
				<input type="hidden" name="option" value="com_content" />
				<input type="hidden" name="task" value="addcomment" />
				<div align="center">
					<input type="button" name="postbutton" class="button" value="<?php echo _E_ADD; ?>" onclick="elxpostccheck()" />
				</div>
			</fieldset>
			</form>

<?php 
			if ($row->comments && (count($row->comments) > 0)) {
?>
			<form name="eblogstopnotform" method="post" action="index2.php" id="eblogstopnotfm" style="margin-top: 20px;">
			<fieldset class="elxisfieldset">
				<legend><?php echo defined('_E_EMAILALERTS') ? _E_EMAILALERTS : 'E-mail alerts'; ?></legend>
				<p><?php echo defined('_E_STOPRECNOTIF') ? _E_STOPRECNOTIF : 'I dont want to recieve notifications any more on new comments to this article'; ?></p>
				<?php if (!$my->id) { ?>
				<label for="notifemail"<?php echo $rtl; ?>><?php echo _CMN_EMAIL; ?></label>
				<input type="text" id="notifemail" name="notifemail" value="" class="inputbox" title="<?php echo _CMN_EMAIL; ?>" />
				<?php } ?>
				<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
				<input type="hidden" name="articleid" value="<?php echo $row->id; ?>" />
				<input type="hidden" name="option" value="com_content" />
				<input type="hidden" name="task" value="removenotif" />
				<input type="submit" name="notifbutton" class="button" value="<?php echo _SEND_BUTTON; ?>" />
			</fieldset>
			</form>
<?php 
			}
		}
		echo "</div>\n";
	}

}

?>