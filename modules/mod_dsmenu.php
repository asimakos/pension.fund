<?php
//Some comment

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

if (!defined( 'DSMENU_MODULE' )) {
	//ensure that functions are declared only once
	define( 'DSMENU_MODULE', 1 );

  $menutype	= $params->get( 'menutype');
  $roll	= $params->get( 'roll');
  $type = $params->get('orientation');

function mosShowListMenu($menutype, $roll, $type) {
	global $database, $my, $cur_template, $Itemid, $lang;
	global $mosConfig_absolute_path, $mosConfig_live_site, $mosConfig_shownoauth, $mainframe;
  $class_sfx = null;
	$hilightid = null;

if ($mosConfig_shownoauth) {

     $database->setQuery("SELECT m.*, count(p.parent) as cnt"
	."\nFROM #__menu AS m"
	."\nLEFT JOIN #__menu AS p ON p.parent = m.id"
  ."\nWHERE m.menutype='$menutype' AND m.published='1'"
  ."\n AND ((m.language IS NULL) OR (m.language LIKE '%$lang%'))"
	."\nGROUP BY m.id ORDER BY m.parent, m.ordering ");

      } else {

     $database->setQuery("SELECT m.*, sum(case when p.published=1 then 1 else 0 end) as cnt"
     ."\nFROM #__menu AS m"
     ."\nLEFT JOIN #__menu AS p ON p.parent = m.id"
     ."\nWHERE m.menutype='$menutype' AND m.published='1' AND m.access IN (".$my->allowed.")"
     ."\nAND ((m.language IS NULL) OR (m.language LIKE '%$lang%'))"
	   ."\nGROUP BY m.id ORDER BY m.parent, m.ordering ");
   }

$rows = $database->loadObjectList( 'id' );
		//work out if this should be highlighted
		$sql = "SELECT m.* FROM #__menu AS m"
		. "\nWHERE menutype='". $menutype ."' AND m.published='1'";

		$database->setQuery( $sql );
		$subrows = $database->loadObjectList( 'id' );
		$maxrecurse = 5;
		$parentid = $Itemid;

		//this makes sure toplevel stays hilighted when submenu active
		while ($maxrecurse-- > 0) {
			$parentid = getTheParentRow($subrows, $parentid);
			if (isset($parentid) && $parentid >= 0 && $subrows[$parentid]) {
				$hilightid = $parentid;
			} else {
				break;
			}
		}

$indents = array(
	array( "<ul>", "<li>", "</li>", "</ul>" ),
	);
    // establish the hierarchy of the menu
$children = array();
    // first pass - collect children
    foreach ($rows as $v ) {
		$pt = $v->parent;
		$list = @$children[$pt] ? $children[$pt] : array();
		array_push( $list, $v );
    $children[$pt] = $list;
    }

// second pass - collect 'open' menus
$open = array( $Itemid );
$count = 20; // maximum levels - to prevent runaway loop
$id = $Itemid;
while (--$count) {

if (isset($rows[$id]) && $rows[$id]->parent > 0) {
			$id = $rows[$id]->parent;
			$open[] = $id;
		} else {
			break;
		}
	}

$class_sfx = null;

    mosRecurseListMenu( 0, 0, $children, $open, $indents, $class_sfx, $hilightid , $roll);
}

/**
* Utility function to recursively work through a vertically indented
* hierarchial menu
*/

function mosRecurseListMenu( $id, $level, &$children, $open, &$indents, $class_sfx, $highlight,$roll ) {
	global $Itemid, $mainframe;
	if (@$children[$id]) {
		$n = min( $level, count( $indents )-1 );
			if ($level==0) echo '<ul id="dsm">';
			else
        echo $indents[$n][0];

		foreach ($children[$id] as $row) {

		        switch ($row->type) {
          		case 'separator':
          		// do nothing
          		$row->link = "seperator";
          		break;

          		case 'url':
          		if ( eregi( 'index.php\?', $row->link ) ) {
        				if ( !eregi( 'Itemid=', $row->link ) ) {
        					$row->link .= '&Itemid='. $row->id;
        				}
        			}
          		break;
          		default:
          			$row->link .= "&Itemid=$row->id";
    		break;
          	}
            $li =  "\n".$indents[$n][1] ;
            $current_itemid = trim( mosGetParam( $_REQUEST, 'Itemid', 0 ) );
            if ($row->link != "seperator" &&
								$current_itemid == $row->id ||
            		$row->id == $highlight ||
                (sefRelToAbs($Itemid == $id))) {
							$li = "<li class=\"active\">";
						}
          echo $li;

            echo mosGetLink( $row, $roll, $level, $class_sfx );
						mosRecurseListMenu( $row->id, $level+1, $children, $open, $indents, $class_sfx, "", $roll  );
            echo $indents[$n][2];
        }

		echo "\n".$indents[$n][3];
	}
}



function getTheParentRow($rows, $id) {
		if (isset($rows[$id]) && $rows[$id]) {
			if($rows[$id]->parent > 0) {
				return $rows[$id]->parent;
			}
		}
		return -1;
	}

/**
* Utility function for writing a menu link
*/

function mosGetLink( $mitem, $roll, $level, $class_sfx='' ) {
	global $Itemid, $mainframe;
	$txt = '';
	$menuclass = '';
	$mitem->link = str_replace( '&', '&amp;', $mitem->link );

	if (strcasecmp(substr($mitem->link,0,4),"http")) {
		$mitem->link = sefRelToAbs($mitem->link);
	}

    switch ($mitem->browserNav) {
		// cases are slightly different
		case 1:
		// open in a new window
    if ($mitem->cnt > 0) {
		   if ($level == 0) {
                $txt = "<a href=\"$mitem->link\" class=\"top\" target=\"_window\">";
                $txt .= show_image($mitem, $roll);
                $txt .= "</a>";
		   } else {
                $txt = "<a href=\"$mitem->link\" class=\"sub\" target=\"_window\">";
                $txt .= show_image($mitem, $roll);
                $txt .= "</a>";
		   }
		} else {
		   	        $txt = "<a href=\"$mitem->link\" target=\"_window\" >";
                $txt .= show_image($mitem, $roll);
                $txt .= "</a>";
		}
		break;
		case 2:
		// open in a popup window
    if ($mitem->cnt > 0) {
				if ($level == 0) {
                $txt = "<a href=\"javascript:void(0);\" class=\"top\" onclick=\"javascript: window.open('$mitem->link', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550');\" class=\"$menuclass\">$mitem->name</a>\n";
		   } else {
                $txt = "<a href=\"javascript:void(0);\" class=\"daddy\" onclick=\"javascript: window.open('$mitem->link', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550');\" class=\"$menuclass\">$mitem->name</a>\n";
		   }
		} else {
		    $txt = "<a href=\"javascript:viod(0);\" onclick=\"javascript: window.open('$mitem->link', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550');\" class=\"$menuclass\">$mitem->name</a>\n";
		}

		break;
		case 3:
		// don't link it
    if ($mitem->cnt > 0) {
		   if ($level == 0) {
                $txt = "<a class=\"top\">";
                $txt .= show_image($mitem, $roll);
                $txt .= "</a>";
		   } else {
                $txt = "<a class=\"sub\">";
                $txt .= show_image($mitem, $roll);
                $txt .= "</a>";
		   }
		} else {
		   	$txt = "<a>";
                $txt .= show_image($mitem, $roll);
                $txt .= "</a>";
		}
		break;
		default:	// formerly case 2
		// open in parent window
		if (isset($mitem->cnt) && $mitem->cnt > 0) {
		    if ($level == 0) {
                $txt = "<a href=\"$mitem->link\" class=\"top\">";
                $txt .= show_image($mitem, $roll);
                $txt .= "</a>";
		   } else {
                $txt = "<a class=\"sub\" href=\"$mitem->link\">";
                $txt .= show_image($mitem, $roll);
                $txt .= "</a>";
		   }
		} else {
	//	if ( $params->get( 'menu_images' ) ) {
      $txt = "<a href=\"$mitem->link\">";
      $txt .= show_image($mitem, $roll);
		  $txt .= '</a>';
      }
        break;
	}
    return $txt;
}

function show_image($mitem, $roll){
global $Itemid,$mainframe;
			$menu_params = new stdClass();
			$menu_params = new mosParameters( $mitem->params );
			$menu_image = $menu_params->def( 'menu_image', -1 );

			if ( ( $menu_image != '-1' ) && $menu_image && (strlen($menu_image)>0)) {
				$ima = explode(".", $menu_image);
				$image = '<img src="'.$mainframe->getCfg('live_site').'/images/stories/'.(($_REQUEST['Itemid'] == ($mitem->id)) ? $ima[0] . $roll . "." . $ima[1] : $menu_image) . '" border="0" alt="'. $mitem->name . '" onmouseover="javascript:this.src=\'' .$mainframe->getCfg('live_site'). '/images/stories/' . $ima[0] . $roll . "." . $ima[1] . '\'" onmouseout="javascript:this.src=\'' .$mainframe->getCfg('live_site'). '/images/stories/' . (($_REQUEST['Itemid'] == ($mitem->id)) ? $ima[0] . $roll . "." . $ima[1]  : $menu_image) . '\'" />';
				$txt.=$image;
        }else{
		    $txt .= $mitem->name;
		   }
		   return $txt;
  }
  $javasyn = '';
  		if (($mosConfig_sef == 2) && ($params->get( 'idpreload' ) == 1)) {
			$javasyn = ' onclick="setsynitem(\''.$mitem->id.'\', this.href); return false;"';
		}
}


echo '<script type="text/javascript" src="'.$mainframe->getCfg('live_site').'/modules/dsmenu/menu.js"></script>';

mosShowListMenu($menutype, $roll, $type);

?>
