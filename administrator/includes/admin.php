<?php 
/**
* @ Version: $Id: admin.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006- 2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Admin
* @ Author: Elxis Team
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


/********************************/
/* COUNT ADMINISTRATION MODULES */
/********************************/
function mosCountAdminModules($position='left') {
	global $database;

	$query = "SELECT COUNT(id) FROM #__modules"
	."\n WHERE published='1' AND position='".$position."' AND client_id='1'";
	$database->setQuery( $query );
	return $database->loadResult();
}


/**************************************************************************/
/* LOAD ADMIN MODULES ( Style: 0=no style, 1=tabbed, 2=Divs, 3=Ajax Tabs) */
/**************************************************************************/
function mosLoadAdminModules($position='left', $style=0) {
	global $database, $acl, $my;

	$cache =& mosCache::getCache( 'com_content' );

	$query = "SELECT id, title, module, position, content, showtitle, params FROM #__modules"
	."\n WHERE published = '1' AND position='".$position."' AND (client_id = 1)"
	."\n ORDER BY ordering";

	$database->setQuery( $query );
	$modules = $database->loadObjectList();
	if($database->getErrorNum()) {
		echo "MA ".$database->stderr(true);
		return;
	}

	switch ($style) {
	    case 0:
	    default:
			foreach ($modules as $module) {
				$params = new mosParameters( $module->params );
				if ( $module->module == '' ) {
					mosLoadCustomModule( $module, $params );
				} else {
					mosLoadAdminModule( substr( $module->module, 4 ), $params );
				}
			}
			break;

		case 1:
		    // Tabs
			$tabs = new mosTabs(1);
			$tabs->startPane( 'modules-' . $position );
			$editAllComponents 	= $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' );
			foreach ($modules as $module) {
				$params = new mosParameters( $module->params );
				// special handling for components module
				if ( $module->module != 'mod_components' || ( $module->module == 'mod_components' && $editAllComponents ) ) {
					$tabs->startTab( $module->title, 'module' . $module->id );
					if ( $module->module == '' ) {
						mosLoadCustomModule( $module, $params );
					} else {
						mosLoadAdminModule( substr( $module->module, 4 ), $params );
					}
					$tabs->endTab();
				}
			}
			$tabs->endPane();
			break;

		case 2:
		    // Divs
			foreach ($modules as $module) {
				$params = new mosParameters( $module->params );
				echo '<div>';
				if ( $module->module == '' ) {
					mosLoadCustomModule( $module, $params );
				} else {
					mosLoadAdminModule( substr( $module->module, 4 ), $params );
				}
				echo '</div>';
			}
			break;

		case 3:
		    // Ajax Tabs
			$tabs = new mosTabs(0);
			$tabs->startPane( 'modules-' . $position );
			$editAllComponents 	= $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' );
			$q = 0;
			foreach ($modules as $module) {
				if ( $module->module == 'mod_components' && !$editAllComponents ) { continue; }
                if ($q == 0) { //load first tab normally
				    $params = new mosParameters( $module->params );
				    $tabs->startTab( $module->title, 'module' . $module->id );
				    if ( $module->module == '' ) {
					   mosLoadCustomModule( $module, $params );
				    } else {
					   mosLoadAdminModule( substr( $module->module, 4 ), $params );
				    }
				    $tabs->endTab();
                } else {
				    $tabs->startAjaxTab( $module->title, 'module'.$module->id, 'loadTabModule(\'module'.$module->id.'\', \''.$module->id.'\')' );
				    echo 'Click Tab to load module'._LEND;
				    $tabs->endAjaxTab();
                }
				$q++;
			}
			$tabs->endPane();
			break;
	}
}
/**
* Loads an admin module
*/
function mosLoadAdminModule( $name, $params=NULL ) {
	global $mosConfig_absolute_path, $mosConfig_live_site;
	global $database, $acl, $my, $mainframe, $option;

	$task = mosGetParam( $_REQUEST, 'task', '' );
	// legacy support for $act
	$act = mosGetParam( $_REQUEST, 'act', '' );

	$name = str_replace( '/', '', $name );
	$name = str_replace( '\\', '', $name );
	$path = "$mosConfig_absolute_path/administrator/modules/mod_$name.php";
	if (file_exists( $path )) {
	    require $path;
	}
}

function mosLoadCustomModule( &$module, &$params ) {
	global $mosConfig_absolute_path;

	$rssurl = $params->get( 'rssurl', '' );
	$rssitems = $params->get( 'rssitems', '' );
	$rssdesc = $params->get( 'rssdesc', '' );
	$moduleclass_sfx = $params->get( 'moduleclass_sfx', '' );

	echo '<table cellpadding="0" cellspacing="0" class="moduletable' . $moduleclass_sfx . '">';

	if ($module->content) {
		echo '<tr>';
		echo '<td>' . $module->content . '</td>';
		echo '</tr>';
	}

	// feed output
	if ( $rssurl ) {
		$cacheDir = $mosConfig_absolute_path .'/cache/';
		if (!is_writable( $cacheDir )) {
			echo '<tr>';
			echo '<td>Please make cache directory writable.</td>';
			echo '</tr>';
		} else {
			$LitePath = $mosConfig_absolute_path .'/includes/Cache/Lite.php';
			require_once( $mosConfig_absolute_path .'/includes/domit/xml_domit_rss_lite.php');
			$rssDoc = new xml_domit_rss_document_lite();
			$rssDoc->useCacheLite(true, $LitePath, $cacheDir, 3600);
			$rssDoc->loadRSS( $rssurl );
			$totalChannels = $rssDoc->getChannelCount();

			for ($i = 0; $i < $totalChannels; $i++) {
				$currChannel =& $rssDoc->getChannel($i);
				echo '<tr>';
				echo '<td><strong><a href="'. $currChannel->getLink() .'" target="_child">';
				echo $currChannel->getTitle() .'</a></strong></td>';
				echo '</tr>';
				if ($rssdesc) {
					echo '<tr>';
					echo '<td>'. $currChannel->getDescription() .'</td>';
					echo '</tr>';
				}

				$actualItems = $currChannel->getItemCount();
				$setItems = $rssitems;

				if ($setItems > $actualItems) {
					$totalItems = $actualItems;
				} else {
					$totalItems = $setItems;
				}

				for ($j = 0; $j < $totalItems; $j++) {
					$currItem =& $currChannel->getItem($j);

					echo '<tr>';
					echo '<td><strong><a href="'. $currItem->getLink() .'" target="_child">';
					echo $currItem->getTitle() .'</a></strong> - '. $currItem->getDescription() .'</td>';
					echo '</tr>';
				}
			}
		}
	}
	echo '</table>';
}

function mosShowSource( $filename, $withLineNums=false ) {
	ini_set('highlight.html', '000000');
	ini_set('highlight.default', '#800000');
	ini_set('highlight.keyword','#0000ff');
	ini_set('highlight.string', '#ff00ff');
	ini_set('highlight.comment','#008000');

	if (!($source = @highlight_file( $filename, true ))) {
		return 'Operation Failed';
	}
	$source = explode("<br />", $source);

	$ln = 1;

	$txt = '';
	foreach( $source as $line ) {
		$txt .= "<code>";
		if ($withLineNums) {
			$txt .= "<font color=\"#aaaaaa\">";
			$txt .= str_replace( ' ', '&nbsp;', sprintf( "%4d:", $ln ) );
			$txt .= "</font>";
		}
		$txt .= "$line<br /><code>";
		$ln++;
	}
	return $txt;
}

function mosIsChmodable($file) {
    global $fmanager;

	$perms = fileperms($file);
	if ($perms !== false) {
        $perms2 = ($perms ^ 0001);

		if (@chmod($file, $perms ^ 0001)) { //writable by php
			@chmod($file, $perms);
			return TRUE;
		} // if

        if ( $fmanager->spChmod( $file, substr(decoct($perms2),-4) )) { //writable by fmanager (ftp/php)
            $fmanager->spChmod( $file, substr(decoct($perms),-4) );
			return true;
		}
	}
	return false;
}

?>