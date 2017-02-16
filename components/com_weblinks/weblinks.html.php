<?php 
/** 
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Weblinks
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


require_once( $GLOBALS['mosConfig_absolute_path'].'/includes/HTML_toolbar.php' );


class HTML_weblinks {


	/*************************/
	/* HTML DISPLAY WEBLINKS */
	/*************************/
	static public function displaylist( &$categories, &$rows, $catid, $currentcat=NULL, &$params, $canAdd=0 ) {
		global $Itemid, $hide_js;

?>

		<h1 class="componentheading<?php echo $params->get( 'pageclass_sfx' ); ?>"><?php echo $currentcat->header; ?></h1>

		<div class="weblinks<?php echo $params->get( 'pageclass_sfx' ); ?>">
        <form action="index.php" method="post" name="adminForm" id="adminForm">
		<div id="weblinkspane" class="contentpane<?php echo $params->get( 'pageclass_sfx' ); ?>">
			<div id="weblinksdescription" class="contentdescription<?php echo $params->get( 'pageclass_sfx' ); ?>">
			<?php 
			if ( $currentcat->img ) {
			?>
				<img src="<?php echo $currentcat->img; ?>" align="<?php echo $currentcat->align; ?>" hspace="6" alt="<?php echo _WEBLINKS_TITLE; ?>" title="<?php echo _WEBLINKS_TITLE; ?>" />
			<?php 
			}
			echo $currentcat->descrip;
			?>
			</div>
			<div class="clear"></div>
			<?php
			if ( count( $rows ) ) {
				HTML_weblinks::showTable( $params, $rows, $catid, $currentcat );
			}
			?>
			<div class="clear"></div>
			<?php 
			//Displays listing of Categories
			if ( ( $params->get( 'type' ) == 'category' ) && $params->get( 'other_cat' ) ) {
				HTML_weblinks::showCategories( $params, $categories, $catid );
			} else if ( ( $params->get( 'type' ) == 'section' ) && $params->get( 'other_cat_section' ) ) {
				HTML_weblinks::showCategories( $params, $categories, $catid );
			}
			?>

		</div>
		<div class="clear"></div>
		</form>

		<?php 
		if ($canAdd) {
		    $sLink = sefRelToAbs('index.php?option=com_weblinks&task=new&Itemid='.$Itemid, 'links/add-link.html');
            echo '<br /><a href="'.$sLink.'" title="'._E_SUBMIT_LINK.'">'._E_SUBMIT_LINK.'</a><br /><br />'._LEND;
		}
        echo '</div>'._LEND;
		mosHTML::BackButton( $params, $hide_js );
	}


	/**************************/
	/* DISPLAY TABLE OF ITEMS */
	/**************************/
	static public function showTable( &$params, &$rows, $catid, $currentcat=NULL ) {

		//icon in table display
		if ( $params->get( 'weblink_icons' ) <> -1 ) {
			$img = mosAdminMenus::ImageCheck( 'weblink.png', '/images/M_images/', $params->get( 'weblink_icons' ), '/images/M_images/', _E_WEBLINK );
		} else {
			$img = NULL;
		}
        $sshots = $params->get( 'sshots' );

		if ($params->get( 'topweblink' ) == 1) {
			elxLoadModule('mod_topweblink', -1);
			define('_TOPWLINK_LOADED', 1);
		}
		?>

        <ul class="table">
        <?php 
		$k = 0;
		foreach ($rows as $row) {
			$iparams = new mosParameters( $row->params );
			$link = sefRelToAbs( 'index.php?option=com_weblinks&task=view&catid='.$catid.'&id='.$row->id, 'links/'.$currentcat->seotitle.'/'.$row->id.'.html');
			$menuclass = 'category'.$params->get( 'pageclass_sfx' );
			
			switch ($iparams->get( 'target' )) {
				case 1: //open in a new window
				$linkStart = '<a href="'.$link.'" target="_blank" class="'.$menuclass.'" title="'.$row->title.'">';
				break;
				case 2: //open in a popup window
				$linkStart = '<a href="javascript:void(0);" title="'.$row->title.'" onclick="javascript: window.open(\''.$link.'\', \'\', \'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550\'); return false" class="'.$menuclass.'">';
				break;
				default: //open in parent window
				$linkStart = '<a href="'.$link.'" class="'.$menuclass.'" title="'.$row->title.'">';
				break;
			}
			?>

			<li class="row<?php echo $k; ?>">
				<?php 
				if ( $sshots == '1' ) {
                    if (trim($row->screenshot) != '') {
                        echo $linkStart."<img src=\"images/screenshots/".$row->screenshot."\" class=\"screenshot\" width=\"120\" height=\"90\" alt=\"".$row->title."\" title=\"".$row->title."\" /></a>"._LEND;
                    } else {
                        echo $linkStart."<img src=\"images/screenshots/ss_not_available.jpg\" class=\"screenshot\" width=\"120\" height=\"90\" alt=\"".$row->title."\" title=\"".$row->title."\" /></a>"._LEND;
                    }
				} elseif ($img) {
				    echo $img.' '._LEND;
				}

                echo $linkStart.$row->title.'</a><br />'._LEND;
				if ( $params->get( 'item_description' ) ) { echo '<em>'.$row->description.'</em><br />'._LEND; }
				if ( $params->get( 'hits' ) ) { echo '<span class="small">'._E_HITS.': '.$row->hits.'</span><br />'._LEND; }
				if ($params->get('lastmodified')) { echo '<span class="small">'._LAST_UPDATED.': '.mosFormatDate($row->date).'</span>'._LEND; }
				?>
			</li>
			
			<?php
			$k = 1 - $k;
		}
		?>
		</ul>
<?php 
	}


	/*******************************/
	/* DISPLAY LINKS TO CATEGORIES */
	/*******************************/
	static public function showCategories( &$params, &$categories, $catid ) {
		global $Itemid, $mosConfig_sef;

		if (!defined('_TOPWLINK_LOADED') && ($params->get( 'topweblink' ) == 1)) {
			elxLoadModule('mod_topweblink', -1);
		}

		if ($categories) {
			echo '<ul>'._LEND;

			foreach ( $categories as $cat ) {
				if ( $catid == $cat->catid ) {
		?>
			<li>
				<strong><?php echo $cat->name; ?></strong>&nbsp;<span class="small"<?php echo (_GEM_RTL) ? ' dir="rtl"' : ''; ?>>(<?php echo $cat->numlinks; ?>)</span>
			</li>
		<?php 
				} else {
					$link = 'index.php?option=com_weblinks&catid='. $cat->catid .'&Itemid='. $Itemid;
					$seolink = ($cat->seotitle != '') ? 'links/'.$cat->seotitle.'/' : '';
		?>
			<li>
				<a href="<?php echo sefRelToAbs( $link, $seolink ); ?>" class="category<?php echo $params->get( 'pageclass_sfx' ); ?>" title="<?php echo $cat->name; ?>">
					<?php echo $cat->name; ?>
				</a>&nbsp;<span class="small"<?php echo (_GEM_RTL) ? ' dir="rtl"' : ''; ?>>(<?php echo $cat->numlinks; ?>)</span>
			</li>
		<?php 
				}
			}
			echo '</ul>'._LEND;
		} else { 
			echo '<p>'._NO_CATEGORIES.'</p>'._LEND; 
		}
	}


	/*************************/
	/* HTML ADD/EDIT WEBLINK */
	/*************************/
	static public function editWeblink( &$row, &$lists ) {
		$Returnid = intval( mosGetParam( $_REQUEST, 'Returnid', 0 ) );
		
		$float = (_GEM_RTL) ? 'right' : 'left';
		?>
		<script type="text/javascript">
		<!--
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			if (form.title.value == ""){
				alert( '<?php echo _GEM_WEBLINK_TITLE; ?>' );
			} else if (getSelectedValue('adminForm','catid') < 1) {
				alert( '<?php echo _E_WARNCAT; ?>' );
			} else if (form.url.value == ""){
				alert( '<?php echo _E_MUSTURL; ?>' );
			} else {
				submitform( pressbutton );
			}
		}
		//-->
		</script>

		<h1><?php echo _E_SUBMIT_LINK; ?></h1>
		<p><?php echo _E_WEBLINKADDH; ?></p>

		<form action="<?php echo sefRelToAbs("index.php"); ?>" method="post" name="adminForm" id="adminForm">
			<div align="<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>">
			<?php 
			mosToolBar::startTable();
			mosToolBar::spacer();
			mosToolBar::save();
			mosToolBar::cancel();
			mosToolBar::endtable();
			?>
			</div>
			<div class="clear"></div>
			<div id="weblinksform">
				<div style="width: 25%; float: <?php echo $float; ?>;"><?php echo _CMN_NAME; ?>:</div>
				<div style="position: relative;">
					<input type="text" name="title" class="inputbox" title="<?php echo _CMN_NAME; ?>" size="30" maxlength="250" value="<?php echo htmlspecialchars( $row->title, ENT_QUOTES ); ?>" />
				</div>
				<div class="clear"></div>
				<div style="width: 25%; float: <?php echo $float; ?>;"><?php echo _E_SECTION; ?>:</div>
				<div style="position: relative;"><?php echo $lists['catid']; ?></div>
				<div class="clear"></div>
				<div style="width: 25%; float: <?php echo $float; ?>;"><?php echo _E_LANGUAGES; ?>:</div>
				<div style="position: relative;"><?php echo $lists['languages']; ?></div>
				<div class="clear"></div>
				<div style="width: 25%; float: <?php echo $float; ?>;"><?php echo _E_URL; ?>:</div>
				<div style="position: relative;">
					<input type="text" name="url" dir="ltr" title="<?php echo _E_URL; ?>" class="inputbox" value="<?php echo $row->url; ?>" size="30" maxlength="250" />
				</div>
				<div class="clear"></div>
				<div style="width: 25%; float: <?php echo $float; ?>;"><?php echo _CMN_DESCRIPTION; ?>:</div>
				<div style="position: relative;">
					<textarea name="description" title="<?php echo _CMN_DESCRIPTION; ?>" class="text_area" cols="25" rows="5"><?php echo htmlspecialchars( $row->description, ENT_QUOTES ); ?></textarea>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			
			<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
			<input type="hidden" name="option" value="com_weblinks" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="ordering" value="<?php echo $row->ordering; ?>" />
			<input type="hidden" name="approved" value="<?php echo $row->approved; ?>" />
			<input type="hidden" name="Returnid" value="<?php echo $Returnid; ?>" />
		</form>
<?php 
	}
}

?>