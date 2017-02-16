<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Module MainMenu
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!class_exists('modMainmenu')) {
	class modMainmenu {

		private $menutype = 'mainmenu';
		private $class_sfx = '';
		private $menu_images = 0;
		private $menu_images_align = 0;
		private $expand_menu = 0;
		private $indent_image = 0;
		private $indent_image1 = 'indent1.png';
		private $indent_image2 = 'indent2.png';
		private $indent_image3 = 'indent3.png';
		private $indent_image4 = 'indent4.png';
		private $indent_image5 = 'indent5.png';
		private $indent_image6 = 'indent.png';
		private $spacer = '';
		private $end_spacer = '';
		private $idpreload = 0;
		private $menu_style = 'vert_indent';
		

		/*********************/
		/* MAGIC CONSTRUCTOR */
		/*********************/
		public function __construct($params=null) {
			$this->menutype = $params->def('menutype', 'mainmenu');
			$this->class_sfx = $params->def('class_sfx', '');
			$this->menu_images = intval($params->def('menu_images', 0));
			$this->menu_images_align = intval($params->def('menu_images_align', 0));
			$this->expand_menu = intval($params->def('expand_menu', 0));
			$this->indent_image = intval($params->def('indent_image', 0));
			$this->indent_image1 = $params->def('indent_image1', 'indent1.png');
			$this->indent_image2 = $params->def('indent_image2', 'indent2.png');
			$this->indent_image3 = $params->def('indent_image3', 'indent3.png');
			$this->indent_image4 = $params->def('indent_image4', 'indent4.png');
			$this->indent_image5 = $params->def('indent_image5', 'indent5.png');
			$this->indent_image6 = $params->def('indent_image6', 'indent.png');
			$this->spacer = $params->def('spacer', '');
			$this->end_spacer = $params->def('end_spacer', '');
			$this->idpreload = intval($params->def('idpreload', 0));
			$this->menu_style = $params->get('menu_style', 'vert_indent');
		}


		/********************/
		/* RUN FOREST, RUN! */
		/********************/
		public function run() {
			switch ($this->menu_style) {
				case 'list_flat':
					$this->showHFMenu(1);
				break;
				case 'horiz_flat':
					$this->showHFMenu(0);
				break;
				case 'vert_indent':
				default:
					$this->showVIMenu();
				break;
			}
		}


		/************************/
		/* HORIZONTAL FLAT MENU */
    	/************************/
		private function showHFMenu($style=0) {
			global $database, $my, $mainframe, $lang;

			if ($mainframe->getCfg('shownoauth')) {
				$sql = "SELECT * FROM #__menu"
				."\n WHERE menutype='".$this->menutype."' AND published='1' AND parent='0'"
				."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
				."\n ORDER BY ordering";
			} else {
				$sql = "SELECT * FROM #__menu"
				."\n WHERE menutype='".$this->menutype."' AND published='1' AND parent='0'"
				."\n AND access IN (".$my->allowed.")"
				."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
				."\n ORDER BY ordering";
			}
			$database->setQuery($sql);
			$rows = $database->loadObjectList('id');

			$links = array();
			if ($rows) {
				foreach ($rows as $row) {
					if (!isset($row->browserNav) && isset($row->browsernav)) { $row->browserNav = $row->browsernav; } //OCI8
					$links[] = $this->getMenuLink($row, 0);
				}
			}

			$menuclass = 'mainlevel'.$this->class_sfx;
        	if (count($links) > 0) {
				switch ($style) {
					case 1:
						$random = rand(100, 999);
						echo '<ul id="'.$menuclass.$random.'" class="'.$menuclass.'">'._LEND;
						foreach ($links as $link) {
							echo "<li>".$link."</li>\n";
						}
						echo "</ul>\n";
					break;
					case 0:
					default:
						$ends = $this->end_spacer;
						$mids = $this->spacer;
						if ($ends != '') { echo '<span class="'.$menuclass.'">'.$ends.'</span>'._LEND; }
						if ($mids != '') {
							echo implode( '<span class="'.$menuclass.'"> '.$mids.' </span>', $links );
						} else {
							foreach($links as $link) { echo $link."\n"; }
						}
						if ($ends != '') { echo '<span class="'.$menuclass.'">'.$ends.'</span>'._LEND; }
						unset($ends);
						unset($mids);
					break;
				}
			}
		}


		/****************************/
		/* VERTICALLY INDENTED MENU */
    	/****************************/
		private function showVIMenu() {
			global $database, $my, $cur_template, $Itemid, $mainframe, $lang;

			$extra = ($mainframe->getCfg('shownoauth')) ? '' : "\n AND access IN (".$my->allowed.")";
			$sql = "SELECT * FROM #__menu"
			."\n WHERE menutype='".$this->menutype."' AND published='1'"
			.$extra
        	."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
			."\n ORDER BY parent,ordering";
			$database->setQuery($sql);
			$rows = $database->loadObjectList('id');

			//indent icons
			$rtlindent = (_GEM_RTL) ? '-rtl' : '';
			switch ($this->indent_image) {
				case '1': //Default images
					$imgpath = $mainframe->getCfg('ssl_live_site').'/images/M_images';
					for ( $i = 1; $i < 7; $i++ ) {
						$img[$i] = '<img src="'.$imgpath.'/indent'.$i.$rtlindent.'.png" alt="indent'.$i.'" />';
					}
				break;
				case '2': //Use Params
					$imgpath = $mainframe->getCfg('live_site').'/images/M_images';
					for ( $i = 1; $i < 7; $i++ ) {
						$iim = 'indent_image'. $i;
						if ($this->$iim == '-1' ) {
							$img[$i] = NULL;
						} else {
							$img[$i] = '<img src="'.$imgpath.'/'.$this->$iim.'" alt="'.$iim.'" />';
						}
					}
				break;
				case '3': //None
					for ( $i = 1; $i < 7; $i++ ) { $img[$i] = NULL; }
				break;
				default: //Template
					$imgpath = $mainframe->getCfg('ssl_live_site').'/templates/'.$cur_template.'/images';
					for ( $i = 1; $i < 7; $i++ ) {
						$img[$i] = '<img src="'.$imgpath.'/indent'.$i.$rtlindent.'.png" alt="indent'.$i.'" />';
					}
				break;
			}

			$dir = (_GEM_RTL) ? 'right' : 'left';
			$indents = array(
            	array('', ''),
            	array('<div style="padding-'.$dir.': 4px" class="sublevel1">'.$img[1] , '</div>'),
            	array('<div style="padding-'.$dir.': 8px" class="sublevel2">'.$img[2] , '</div>'),
            	array('<div style="padding-'.$dir.': 12px" class="sublevel3">'.$img[3] , '</div>'),
            	array('<div style="padding-'.$dir.': 16px" class="sublevel4">'.$img[4] , '</div>'),
            	array('<div style="padding-'.$dir.': 20px" class="sublevel5">'.$img[5] , '</div>'),
            	array('<div style="padding-'.$dir.': 24px" class="sublevel6">'.$img[6] , '</div>'),
			);

			//establish the hierarchy of the menu
			$children = array();
			//first pass - collect children
			foreach ($rows as $v ) {
				if (!isset($v->browserNav) && isset($v->browsernav)) { $v->browserNav = $v->browsernav; } //OCI8
				$pt = $v->parent;
				$list = isset($children[$pt]) ? $children[$pt] : array();
				array_push( $list, $v );
				$children[$pt] = $list;
			}

			//second pass - collect 'open' menus
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
			$this->recurseVIMenu( 0, 0, $children, $open, $indents);
		}


		/******************************************/
		/* WORK RECURSIVELY THROUGH VERTICAL MENU */
		/******************************************/
		private function recurseVIMenu( $id, $level, &$children, $open, $indents) {
			global $Itemid;

			if (isset($children[$id])) {
				$n = min( $level, count( $indents )-1 );

				foreach ($children[$id] as $row) {
					echo _LEND.$indents[$n][0];
					echo $this->getMenuLink($row, $level);
					//show menu with menu expanded - submenus visible
					if (!$this->expand_menu) {
						if ( in_array( $row->id, $open )) {
                        	$this->recurseVIMenu( $row->id, $level+1, $children, $open, $indents);
						}
					} else {
						$this->recurseVIMenu( $row->id, $level+1, $children, $open, $indents);
					}
                	echo $indents[$n][1];
				}
				echo _LEND;
			}
		}


		/**********************/
		/* GET MENU ITEM LINK */
		/**********************/
		private function getMenuLink($mitem, $level=0) {
			global $Itemid, $mainframe;

			$mitem = $this->translateMenu($mitem);
			$txt = '';
			switch ($mitem->type) {
				case 'separator':
				case 'component_item_link':
				break;
				case 'url':
					if (preg_match('/index\.php\?/i', $mitem->link)) {
                		if (!preg_match('/Itemid\=/i', $mitem->link)) { $mitem->link .= '&Itemid='.$mitem->id; }
					}
				break;
				case 'content_item_link':
					$temp = preg_split('/\&task\=view\&id\=/', $mitem->link);
					$mitem->link .= '&Itemid='.$mainframe->getItemid($temp[1]);
				break;
				case 'content_typed':
				default:
					$mitem->link .= '&Itemid='.$mitem->id;
				break;
			}

			//Active Menu highlighting
			$id = '';
			if ($Itemid && ($Itemid == $mitem->id)) {
				$id = ' id="active_menu'.$this->class_sfx.'"';
			}

			$mitem->link = ampReplace( $mitem->link );
			if (strcasecmp(substr( $mitem->link,0,4), 'http')) {
				$mitem->link = sefRelToAbs( $mitem->link );
			}

			$menuclass = ($level > 0) ? 'sublevel'.$this->class_sfx : 'mainlevel'.$this->class_sfx;
			$mitem->name = stripslashes(ampReplace($mitem->name));

			if ($this->menu_images) {
				$menu_params = new stdClass();
				$menu_params = new mosParameters($mitem->params);
				$menu_image = $menu_params->def('menu_image', -1);
				$menu_image_only = $menu_params->def('menu_image_only', -1);
				if ( ( $menu_image != '-1' ) && $menu_image ) {
					$image = '<img src="'.$mainframe->getCfg('ssl_live_site').'/images/stories/'.$menu_image.'" border="0" alt="'.$mitem->name.'" />';
                	if ( $menu_image_only != '1' ) { //Show Images and Text
						$LinkTxt = ($this->menu_images_align) ? $mitem->name.' '.$image : $image.' '.$mitem->name;
                	} else {
                    	$LinkTxt = $image;
                	}
            	} else {
                	$LinkTxt = $mitem->name;
            	}
        	} else {
            	$LinkTxt = $mitem->name;
        	}

			$javasyn = '';
			if (($mainframe->getCfg('sef') == 2) && ($this->idpreload)) {
				$javasyn = ' onclick="setsynitem(\''.$mitem->id.'\', this.href); return false;"';
			}
			
			switch ($mitem->browserNav) {
				case 1: //open in a new window
					$txt = '<a href="'. $mitem->link .'" target="_blank" title="'.$mitem->name.'" class="'.$menuclass.'"'.$id.'>'.$LinkTxt.'</a>';
				break;
				case 2: //open in a popup window
					$txt = '<a href="javascript:void(null);" onclick="javascript: window.open(\''.$mitem->link.'\', \'\', \'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550\'); return false" title="'.$mitem->name.'" class="'.$menuclass.'"'.$id.'>'.$LinkTxt.'</a>';
				break;
				case 3: //don't link it
					$txt = '<span class="'.$menuclass.'"'.$id.'>'.$LinkTxt.'</span>';
				break;
				default: //open in parent window
					$txt = '<a href="'.$mitem->link.'" title="'.$mitem->name.'" class="'.$menuclass.'"'.$id.''.$javasyn.'>'.$LinkTxt.'</a>';
				break;
			}
			return $txt;
		}


		/************************/
		/* TRANSLATE MENU TITLE */
		/************************/
		private function translateMenu($mitem) {
			global $my;

			if (!isset($mitem->link)) { return $mitem; }
			if (trim($mitem->language) != '') { return $mitem; }

			switch($mitem->link) {
				case 'index.php?option=com_user&task=UserDetails':
					$mitem->name = _E_EDIT_PROFILE;
				break;
				case 'index.php?option=com_user&task=list':
					$mitem->name = _E_MEMBERS_LIST;
				break;
				case 'index.php?option=com_content&task=subcontent':
					$mitem->name = _E_ADDCONTENT;
				break;
				case 'index.php?option=com_weblinks&task=new':
					$mitem->name = _E_SUBMIT_LINK;
				break;
				case 'index.php?option=com_user&task=CheckIn':
					$mitem->name = _E_CHECKIN;
				break;
				case 'index.php?option=com_login':
					$mitem->name = ($my->id) ? _BUTTON_LOGOUT : _BUTTON_LOGIN;
				break;
				case 'index.php?option=com_poll':
					$mitem->name = _POLL_POLLS;
				break;
				case 'index.php?option=com_contact':
					$mitem->name = _CONTACT_TITLE;
				break;
				case 'index.php?option=com_weblinks':
					$mitem->name = _WEBLINKS_TITLE;
				break;
				case 'index.php?option=com_search':
					$mitem->name = _E_SEARCH;
				break;
				case 'index.php?option=com_registration&task=register':
					$mitem->name = _E_REGISTRATION;
				break;
				default:
				break;
			}
			return $mitem;
		}

	}
}


$elxMainmenu = new modMainmenu($params);
$elxMainmenu->run();
unset($elxMainmenu);

?>