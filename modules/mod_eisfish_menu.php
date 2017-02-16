<?php
/**
* mod_eifish_menu
* vers. 1.2
* module superfish menu for elxis cms 2009 and over
* author: Duilio Lupini (speck)
* link: http://www.elxisitalia.com
* email: info@elxisitalia.com
* @http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* license GNU / GPL
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!class_exists('modeisfishmenu')) {

	class modeisfishmenu {

		private $menutype=null;
		private $delay=null;
		private $speed=null;
		private $arrow=null;
		private $dropshadow=null;
		private $rtl = null;
		private $aligncenter = null;
		private $menulayout = null;
		private $excss = null;
		private $cssclass = null;
		private $cssfile = null;
		private $cssdir = null;

		/*********************/
		/* MAGIC CONSTRUCTOR */
		/*********************/
  		public function __construct($params) {
  			global $mainframe;
			$this->setModJquerySecureLive();
  			$this->processParams($params);
			  		
		}


		/****************************************************/
		/* PROCESS MODULE PARAMETERS AND CHECK THEIR VALUES */
		/****************************************************/
		private function processParams($params) {

			$this->menutype = trim($params->get('menutype', ''));
			$this->delay = (int)$params->get('delay', 1200);
			$this->speed = (int)$params->get('speed', 150);
			$this->arrow = ($params->get('arrow')) ? true : false ;
			$this->dropshadow = ($params->get('dropshadow')) ? true : false ;
			$this->rtl = (_GEM_RTL) ? '-rtl' : '';
			$this->aligncenter = intval($params->get('aligncenter', 0));
			$this->menulayout = intval($params->get('menulayout', 0));
			$this->cssclass = trim($params->get('cssclass', ''));
			if ($this->cssclass != '') {
				$this->cssfile = $this->cssclass;
				$this->cssclass = 'sf-'.$this->cssclass; 
			} 
			
			if ($this->menulayout == 0){($this->cssclass) ? $this->excss = $this->cssclass : 'sf-menu'; }		
			
			if ($this->menulayout == 0){
				if ($this->cssclass) { 
					$this->excss = $this->cssclass;
					$this->cssdir = $this->cssfile;
				} else {
					$this->cssfile = 'superfish';
					$this->excss ='sf-menu';
					$this->cssdir ='standard_css';
					$this->cssclass ='sf-menu';
				}
			}
			if ($this->menulayout == 1){
				if ($this->cssclass) { 
					$this->extmenu = $this->cssfile.'-vertical'; 
					$this->excss = $this->cssclass.' '.$this->cssclass.'-vertical';
					$this->cssdir = $this->cssfile;
				} else {
					$this->cssfile = 'superfish';
					$this->extmenu = 'superfish-vertical'; 
					$this->excss ='sf-menu sf-vertical';
					$this->cssdir ='standard_css';
					$this->cssclass ='sf-menu';
				}
			}
			if ($this->menulayout == 4){
				if ($this->cssclass) { 
					$this->extmenu = $this->cssfile.'-verticalright'; 
					$this->excss = $this->cssclass.' '.$this->cssclass.'-verticalright';
					$this->cssdir = $this->cssfile;
				} else {
					$this->cssfile = 'superfish';
					$this->extmenu = 'superfish-verticalright'; 
					$this->excss ='sf-menu sf-verticalright';
					$this->cssdir ='standard_css';
					$this->cssclass ='sf-menu';
				}
			}
			if ($this->menulayout == 2){
				if ($this->cssclass) { 
					$this->extmenu = $this->cssfile.'-slider'; 
					$this->excss = $this->cssclass.' '.$this->cssclass.'-slider';
					$this->cssdir = $this->cssfile;
				} else {
					$this->cssfile = 'superfish';
					$this->extmenu = 'superfish-slider'; 
					$this->excss ='sf-menu sf-slider';
					$this->cssdir ='standard_css';
					$this->cssclass ='sf-menu';
				}
			}

			if ($this->menulayout == 3){
				if ($this->cssclass) { 
					$this->extmenu = $this->cssfile.'-navbar'; 
					$this->excss = $this->cssclass.'-navbar';
					$this->cssdir = $this->cssfile;
					$this->cssclass =$this->cssclass.'-navbar';
				} else {
					$this->extmenu = 'superfish-navbar'; 
					$this->excss ='sf-navbar';
					$this->cssdir ='standard_css';
					$this->cssclass ='sf-navbar';
				}
			}

			$javasyn = '';
			if (($mosConfig_sef == 2) && ($params->get( 'idpreload' ) == 1)) {
				$javasyn = ' onclick="setsynitem(\''.$mitem->id.'\', this.href); return false;"';
			}
		}

		/*******************************************/
		/* SET THE SECURE VERSION OF LIVE_SITE URL */
		/*******************************************/
		private function setModJquerySecureLive() {
			global $mainframe;

			$this->ssl = false;
			if (isset($_SERVER['HTTPS'])) {
				if (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == 1)) { $this->ssl = true; }
			} else if (isset($_SERVER['SERVER_PORT']) && ($_SERVER['SERVER_PORT'] == 443)) {
				$this->ssl = true;
			}

			if ($this->ssl === true) {
				$this->ssl_live_site = preg_replace('/^(http\:)/i', 'https:', $mainframe->getCfg('live_site'));
			} else {
				$this->ssl_live_site = $mainframe->getCfg('live_site');
			}
		}

		/****************************************************/
		/* PROCESS SHOW LIST MENU */
		/****************************************************/
		private function mosShowListMenu() {

			global $database, $my, $cur_template, $Itemid, $lang;
			global $mosConfig_absolute_path, $mosConfig_live_site, $mosConfig_shownoauth, $mainframe;
			$class_sfx = null;
			$hilightid = null;
		
			if ($mosConfig_shownoauth) {
				$query = "SELECT m.*, count(p.parent) as cnt"
				."\n FROM #__menu AS m"
				."\n LEFT JOIN #__menu AS p ON p.parent = m.id"
				."\n WHERE m.menutype='$this->menutype' AND m.published='1'"
				."\n AND ((m.language IS NULL) OR (m.language LIKE '%$lang%'))"
				."\n GROUP BY m.id ORDER BY m.parent, m.ordering ";
			} else {
				$query = "SELECT m.*, sum(case when p.published=1 then 1 else 0 end) as cnt"
				 ."\n FROM #__menu AS m"
				 ."\n LEFT JOIN #__menu AS p ON p.parent = m.id"
				 ."\n WHERE m.menutype='$this->menutype' AND m.published='1' AND m.access IN (".$my->allowed.")" 
				 ."\n AND ((m.language IS NULL) OR (m.language LIKE '%$lang%'))"
				 ."\n GROUP BY m.id ORDER BY m.parent, m.ordering ";
			}
		
			$database->setQuery( $query );
			$rows = $database->loadObjectList( 'id' );
			//work out if this should be highlighted
			$sql = "SELECT m.* FROM #__menu AS m"
			. "\n WHERE menutype='". $this->menutype ."' AND m.published='1'"; 
			
			$database->setQuery( $sql );
			$subrows = $database->loadObjectList( 'id' );
			$maxrecurse = 5;
			$parentid = $Itemid;
			
			//this makes sure toplevel stays hilighted when submenu active
			while ($maxrecurse-- > 0) {
				$parentid = $this->getTheParentRow($subrows, $parentid);
				if (isset($parentid) && $parentid >= 0 && $subrows[$parentid]) {
					$hilightid = $parentid;
				} else {
					break;	
				}
			}	
		
			$indents = array( array( '<ul>', '<li>', '</li>', '</ul>' ),);
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
			
			$this->mosRecurseListMenu( 0, 0, $children, $open, $indents, $class_sfx, $hilightid);
		}


		/****************************************************/
		/* PROCESS RECURSE LIST MENU */
		/****************************************************/

		private function mosRecurseListMenu( $id, $level, &$children, $open, &$indents, $class_sfx, $highlight ) {
			global $Itemid, $mainframe;
			if (@$children[$id]) {
				$n = min( $level, count( $indents )-1 );
				if ($level==0) {
					echo '<ul class="'.$this->excss.'">';
				} else {
					echo $indents[$n][0];
				}
				foreach ($children[$id] as $row) {
			
					switch ($row->type) {
						case 'separator':
						// do nothing
						$row->link = "seperator";
						break;
			
						case 'url':
						if ( eregi( 'index.php\?', $row->link ) ) {
							if ( !eregi( 'Itemid=', $row->link ) ) {
								$row->link .= '&Itemid='.$row->id;
							}
						}
						break;
						default:
						$row->link .= '&Itemid='.$row->id;
						break;
					}
					$li =  "\n".$indents[$n][1] ;
					$current_itemid = trim( mosGetParam( $_REQUEST, 'Itemid', 0 ) );
					if ($row->link != 'seperator' && $current_itemid == $row->id || $row->id == $highlight || (sefRelToAbs($Itemid == $id))) {
						$li = '<li class="current">';
					}
					echo $li;
					echo $this->mosGetLink( $row, $level, $class_sfx );
					$this->mosRecurseListMenu( $row->id, $level+1, $children, $open, $indents, $class_sfx, "" );
					echo $indents[$n][2];
				}
			
				echo "\n".$indents[$n][3];
			}
		
		}

		/****************************************************/
		/* PROCESS PARENT ROW*/
		/****************************************************/
		private function getTheParentRow($rows, $id) {
			if (isset($rows[$id]) && $rows[$id]) {
				if($rows[$id]->parent > 0) {
					return $rows[$id]->parent;
				}	
			}
			return -1;
		}

		/****************************************************/
		/* PROCESS GET LINK */
		/****************************************************/
		private function mosGetLink( $mitem, $level, $class_sfx='' ) {
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
				if ($mitem->browserNav > 0) {
						$txt = '<a href="'.$mitem->link.'" target="_blank">';
						$txt .= $this->show_image($mitem);
						$txt .= '</a>';
				}
				break;
				case 2:
				// open in a popup window
				if ($mitem->browserNav > 0) {
					$txt = "<a href=\"javascript:viod(0);\" onclick=\"javascript: window.open('".$mitem->link."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550');\" class=\"$menuclass\">$mitem->name</a>\n";
				}
			
				break;
				case 3:
				// don't link it
				if ($mitem->browserNav > 0) {
					   $txt = "<a>";
						$txt .= $this->show_image($mitem);
						$txt .= "</a>";
				}
				break;
				default:	
				// formerly case 2
				// open in parent window
				if (isset($mitem->browserNav) && $mitem->browserNav > 0) {
						$txt = '<a href="'.$mitem->link.'">';
						$txt .= $this->show_image($mitem);
						$txt .= '</a>';
				} else {
					//	if ( $params->get( 'menu_images' ) ) {		
					$txt = '<a href="'.$mitem->link.'">';
					$txt .= $this->show_image($mitem);
					$txt .= '</a>';
				}
				break;
			} 
			return $txt;
		}


		/****************************************************/
		/* PROCESS SHOW IMAGE MENU */
		/****************************************************/
		private function show_image($mitem){
			global $Itemid,$mainframe;

			$menu_params = new stdClass();
			$menu_params = new mosParameters( $mitem->params );
			$menu_image = $menu_params->def( 'menu_image', -1 );
			
			if ( ( $menu_image != '-1' ) && $menu_image && (strlen($menu_image)>0)) {
				$ima = explode(".", $menu_image);		
				$image = '<img src="'.$mainframe->getCfg('live_site').'/images/stories/'.(($_REQUEST['Itemid'] == ($mitem->id)) ? $ima[0] . "." . $ima[1] : $menu_image) . '" border="0" alt="'. $mitem->name . '" onmouseover="javascript:this.src=\'' .$mainframe->getCfg('live_site'). '/images/stories/' . $ima[0] . "." . $ima[1] . '\'" onmouseout="javascript:this.src=\'' .$mainframe->getCfg('live_site'). '/images/stories/' . (($_REQUEST['Itemid'] == ($mitem->id)) ? $ima[0] . "." . $ima[1]  : $menu_image) . '\'" />';
				$txt.=$image;
			} else {
				$txt .= $mitem->name;
			}
			return $txt;
		}
	

		/****************************************************/
		/* CALL CSS / JSCRIPT */
		/****************************************************/

		public function callmodeisfishscript($mitem){

			if ($this->menulayout == 0 || $this->menulayout == 1 || $this->menulayout == 2 || $this->menulayout == 4 ){
				echo '<script type="text/javascript">'."\n";
				echo '//<![CDATA['."\n";
				echo 'var embedCONTMENUSCSS1 = \'<\' + \'style type="text/css" media="screen">\''."\n";
				echo '+ \'@import "'.$this->ssl_live_site.'/modules/mod_eisfish_menu/'.$this->cssdir.'/'.$this->cssfile.$this->rtl.'.css";\''."\n";
				echo '+ \'</\' + \'style>\''."\n";
				echo '+ \'<\' + \'style type="text/css" media="print">\''."\n";
				echo '+ \'</\' + \'style>\';'."\n";
				echo 'document.write(embedCONTMENUSCSS1);'."\n";
				echo '//]]>'."\n";
				echo "</script>\n";
			}			
			
			if ($this->menulayout == 1 || $this->menulayout == 2 || $this->menulayout == 3 || $this->menulayout == 4){
				echo '<script type="text/javascript">'."\n";
				echo '//<![CDATA['."\n";
				echo 'var embedCONTMENUSCSS2 = \'<\' + \'style type="text/css" media="screen">\''."\n";
				echo '+ \'@import "'.$this->ssl_live_site.'/modules/mod_eisfish_menu/'.$this->cssdir.'/'.$this->extmenu.$this->rtl.'.css";\''."\n";
				echo '+ \'</\' + \'style>\''."\n";
				echo '+ \'<\' + \'style type="text/css" media="print">\''."\n";
				echo '+ \'</\' + \'style>\';'."\n";
				echo 'document.write(embedCONTMENUSCSS2);'."\n";
				echo '//]]>'."\n";
				echo "</script>\n";
			}

			if (!defined( 'EISFISH_MODULE' )) {
				echo '<script type="text/javascript" src="'.$this->ssl_live_site.'/modules/mod_eisfish_menu/js/jquery.js"></script>';
				echo '<script type="text/javascript" src="'.$this->ssl_live_site.'/modules/mod_eisfish_menu/js/hoverIntent.js"></script>';
				echo '<script type="text/javascript" src="'.$this->ssl_live_site.'/modules/mod_eisfish_menu/js/superfish.js"></script>';

				define( 'EISFISH_MODULE', 1 );
			}

			
			?>
			<script type="text/javascript">
			//<![CDATA[
				$eifishm(document).ready(function(){ 
					$eifishm("ul.<?php echo $this->cssclass; ?>").superfish({ 
						delay:<?php echo $this->delay; ?>,// the delay in milliseconds that the mouse can remain outside a submenu without it closing 
						speed:<?php echo $this->speed; ?>,// speed of the animation. Equivalent to second parameter of jQuery’s .animate() method 
						autoArrows:'<?php echo $this->arrow; ?>',// if true, arrow mark-up generated automatically = cleaner source code at expense of initialisation performance 
						dropShadows:'<?php echo $this->dropshadow; ?>'// completely disable drop shadows by setting this to false 
					}); 
				}); 
			//]]>
			</script>
			<?php
			echo ($this->aligncenter) ? '<table id="eisfish_menu" align="center" width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="center"><table border="0" cellspacing="0" cellpadding="0"><tr><td>' : '' ;
			$this->mosShowListMenu($this->menutype);
			echo ($this->aligncenter) ? "</td></tr></table></td></tr></table>\n" : '';
			echo '<div style="clear:both"></div>'."\n";
		}

	}
}

	
$mmodeisfishmenu = new modeisfishmenu($params);
$mmodeisfishmenu->callmodeisfishscript($mitem);
unset ($mmodeisfishmenu);

?>