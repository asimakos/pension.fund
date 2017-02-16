<?php 
/** 
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Pathway
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


function pathwayMakeLink( $id, $name, $link, $parent ) {
	$mitem = new stdClass();
	$mitem->id 		= $id;
	$mitem->name 	= $mitem->name = html_entity_decode( $name ); 
	$mitem->link 	= $link;
	$mitem->parent 	= $parent;
	$mitem->type 	= '';

	return $mitem;
}


/***************************/
/* CREATE AND SHOW PATHWAY */
/***************************/
function showPathway($Itemid) {
	global $database, $option, $task, $mainframe, $lang;

	//get the home page
	$query = "SELECT * FROM #__menu WHERE menutype='mainmenu' AND published='1'"
	."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
	."\n ORDER BY parent, ordering";
	$database->setQuery( $query, '#__', 1, 0);

	$home_menu = new mosMenu( $database );
	$database->loadObject($home_menu);

	//the whole menu array and index the array by the id
	$database->setQuery( "SELECT id, name, link, parent, type FROM #__menu"
	."\n WHERE published='1' AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
	."\n ORDER BY parent, ordering");
	$mitems = $database->loadObjectList('id');

	$isWin = (substr(PHP_OS, 0, 3) == 'WIN');
	$optionstring = $isWin ? $_SERVER['QUERY_STRING'] : $_SERVER['REQUEST_URI'];

	// are we at the home page or not
	$homekeys = array_keys($mitems);
	$thome = isset($mitems[$home_menu->id]->name) ? $mitems[$home_menu->id]->name : '';
	$path = '';

	// this is a patch job for the frontpage items! aje
	if ($Itemid == $home_menu->id) {
		switch ($option) {
			case 'content':
			case 'com_content':
			$id = intval(mosGetParam( $_REQUEST, 'id', 0 ));
			if ($task=='blogsection') {
				$database->setQuery( "SELECT title FROM #__sections WHERE id=$id" );
			} else if ( $task=='blogcategory' ) {
				$database->setQuery( "SELECT title FROM #__categories WHERE id=$id" );
			} else {
				$database->setQuery( "SELECT title, catid FROM #__content WHERE id=$id" );
			}

			$row = null;
			$database->loadObject( $row );

			$id = max( array_keys( $mitems ) ) + 1;

			// add the content item
			$mitem2 = pathwayMakeLink($Itemid, $row->title, '', 1);
			$mitems[$id] = $mitem2;
			$Itemid = $id;

			$home = '<a href="'.sefRelToAbs('index.php').'" class="pathway" title="'.$thome.'">'.$thome.'</a>';
			break;
		}
	}

	$mit = isset($mitems[$Itemid]->type) ? $mitems[$Itemid]->type : '';
	switch($mit) {
		case 'content_section':
		$id = intval( mosGetParam( $_REQUEST, 'id', 0 ) );

		switch ($task) {
			case 'category':
			if ($id) {
				$database->setQuery( "SELECT title FROM #__categories WHERE id=$id", '#__', 1, 0);
				$title = $database->loadResult();

				$id = max( array_keys( $mitems ) ) + 1;
				$mitem = pathwayMakeLink($id, $title, 'index.php?option='.$option.'&task='.$task.'&id='.$id.'&Itemid='.$Itemid, $Itemid);
				$mitems[$id] = $mitem;
				$Itemid = $id;
			}
			break;

			case 'view':
			if ($id) {
				// load the content item name and category
				$database->setQuery( "SELECT title, catid, id FROM #__content WHERE id=$id" );
				$row = null;
				$database->loadObject( $row );

				// load and add the category
				$database->setQuery( "SELECT c.title AS title, s.id AS sectionid FROM #__categories c"
				." LEFT JOIN #__sections s ON c.section=s.id WHERE c.id='$row->catid'" );
				$result = $database->loadObjectList();

				$title = $result[0]->title;
				$sectionid = $result[0]->sectionid;

				$id = max( array_keys( $mitems ) ) + 1;
				$mitem1 = pathwayMakeLink($Itemid, $title, 'index.php?option='.$option.'&task=category&sectionid='.$sectionid.'&id='.$row->catid, $Itemid);
				$mitems[$id] = $mitem1;

				// add the final content item
				$id++;
				$mitem2 = pathwayMakeLink($Itemid, $row->title, '', $id-1);
				$mitems[$id] = $mitem2;
				$Itemid = $id;
			}
			break;
		}
		break;

		case 'content_category':
		$id = intval( mosGetParam( $_REQUEST, 'id', 0 ) );

		switch ($task) {
			case 'view':
			if ($id) {
				// load the content item name and category
				$database->setQuery( "SELECT title, catid FROM #__content WHERE id=$id" );
				$row = null;
				$database->loadObject( $row );

				$id = max( array_keys( $mitems ) ) + 1;
				// add the final content item
				$mitem2 = pathwayMakeLink($Itemid, $row->title, '', $Itemid);
				$mitems[$id] = $mitem2;
				$Itemid = $id;
			}
			break;
		}
		break;

		case 'content_blog_category':
		case 'content_blog_section':
		switch ($task) {
			case 'view':
			$id = intval( mosGetParam( $_REQUEST, 'id', 0 ) );

			if ($id) {
				// load the content item name and category
				$database->setQuery( "SELECT title, catid FROM #__content WHERE id=$id" );
				$row = null;
				$database->loadObject( $row );

				$id = max( array_keys( $mitems ) ) + 1;
				$mitem2 = pathwayMakeLink($Itemid, $row->title, '', $Itemid);
				$mitems[$id] = $mitem2;
				$Itemid = $id;
			}
			break;
		}
		break;
	}

	$i = count( $mitems );
	$mid = $Itemid;

	$isrtl = (_GEM_RTL) ? '-rtl' : '';
	$imgPath =  'templates/'.$mainframe->getTemplate().'/images/arrow'.$isrtl.'.png';
	if (file_exists($mainframe->getCfg('absolute_path').'/'.$imgPath )){
		$img = '<img src="'.$mainframe->getCfg('ssl_live_site').'/'.$imgPath.'" border="0" alt="arrow" />';
	} else {
		$imgPath = '/images/M_images/arrow'.$isrtl.'.png';
		if (file_exists($mainframe->getCfg('absolute_path').$imgPath )){
			$img = '<img src="'.$mainframe->getCfg('ssl_live_site').'/images/M_images/arrow'.$isrtl.'.png" border="0" alt="arrow" />';
		} else {
		    $img = (_GEM_RTL) ? '&lt;' : '&gt;';
		}
	}

	while ($i--) {
		if (!$mid || empty( $mitems[$mid] ) || ($mid == $home_menu->id) || !preg_match('/option/i', $optionstring)) {
			break;
		}
		$item = $mitems[$mid];

		// converts & to &amp; for xtml compliance
		$itemname = ampReplace( $item->name );
		
		// if it is the current page, then display a non hyperlink
		if ($item->id == $Itemid || empty( $mid ) || empty($item->link)) {
			if ($item->type == 'system') {
				$itemname_trans = translateSysLink($item->link);
				if ($itemname_trans != '') {
					$itemname = $itemname_trans;
				}
			}
			$newlink = "  $itemname";
		} else if (isset($item->type) && $item->type == 'url') {
			$correctLink = preg_match('/http\:\/\//', $item->link);
			if ($correctLink==1) {
				$newlink = '<a href="'.$item->link.'" target="_window" class="pathway" title="'.$itemname.'">'.$itemname.'</a>';
			} else {
				$newlink = $itemname;
			}
		} else {
			$newlink = '<a href="'.sefRelToAbs($item->link.'&Itemid='.$item->id ).'" class="pathway" title="'.$itemname.'">'.$itemname.'</a>';
		}

		$newlink = ampReplace( $newlink );
		
		if (trim($newlink)!="") {
			$path = $img.' '.$newlink.' '.$path;
		} else {
			$path = '';
		}
		$mid = $item->parent;
	}

	if ( preg_match( '/option/i', $optionstring ) && trim( $path  ) ) {
		$home = '<a href="'.sefRelToAbs( 'index.php' ).'" class="pathway" title="'.$thome.'">'.$thome.'</a>';
	}

	if ($mainframe->getCustomPathWay()){
		$path .= $img . ' ';
		$path .= implode ($img.' ', $mainframe->getCustomPathWay());
	}

	echo ( "<span class=\"pathway\">". $home ." ". $path ."</span>\n" );
}


/*************************/
/* TRANSLATE SYSTEM LINK */
/*************************/
function translateSysLink($syslink='') {
	global $my;
	switch ($syslink) {
		case 'index.php?option=com_registration&task=register':
			return _CREATE_ACCOUNT;
		break;
		case 'index.php?option=com_registration&task=lostPassword':
			return _LOST_PASSWORD;
		break;
		case 'index.php?option=com_registration&task=saveRegistration':
			return _REG_COMPLETE;
		break;
		case 'index.php?option=com_registration&task=activate':
			return _REG_ACTIVATE_COMPLETE;
		break;
		case 'index.php?option=com_login':
			return ($my->id) ? _BUTTON_LOGOUT : _BUTTON_LOGIN;
		break;
		case 'index.php?option=com_user&task=UserDetails':
			return _E_EDIT_PROFILE;
		break;
		case 'index.php?option=com_content&task=subcontent':
			return _E_CONTENTSUB;
		break;
		case 'index.php?option=com_weblinks&task=new':
			return _E_SUBMIT_LINK;
		break;
		case 'index.php?option=com_user&task=CheckIn':
			return _E_CHECKIN;
		break;
		case 'index.php?option=com_user&task=list':
			return _E_MEMBERS_LIST;
		break;
		case 'index.php?option=com_poll':
			return _POLL_POLLS;
		break;
		case 'index.php?option=com_contact':
			return _CONTACT_TITLE;
		break;
		case 'index.php?option=com_content&task=vote':
			return _USER_RATING;
		break;
		default:
			return '';
		break;
	}
}

//code placed in a function to prevent messing up global variables
showPathway( $Itemid );

?>