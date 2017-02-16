<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Admin
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (($task == 'tools') || ($task == 'itools')) {
    if (!$acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'tools', 'all' )) {
	   mosRedirect( 'index2.php', $adminLanguage->A_NOT_AUTH );
	   exit();
    }
}

require_once( $mainframe->getPath( 'admin_html' ) );

switch ($task) {
	case 'redirect':
		$goto = trim( strtolower( mosGetParam( $_REQUEST, 'link')));
		if ($goto == 'null') {
			mosRedirect('index2.php?option=com_admin&task=listcomponents',$adminLanguage->A_COMP_ALERT_NO_LINK);
		}
		$goto = str_replace( "'", '', $goto );
		mosRedirect($goto);
	break;
	case 'listcomponents':
		HTML_admin_misc::ListComponents();
	break;
	case 'sysinfo':
		HTML_admin_misc::system_info( $version, $option );
	break;
	case 'help':
		HTML_admin_misc::help();
	break;
	case 'preview':
		HTML_admin_misc::preview();
	break;
	case 'preview2':
		HTML_admin_misc::preview( 1 );
	break;
	case 'tools':
		$tname = trim( strtolower( mosGetParam( $_REQUEST, 'tname', '' ) ) );
		elxisTools::runTool( $tname );
	break;
	case 'itools':
		$tname = trim( strtolower( mosGetParam( $_REQUEST, 'tname', '' ) ) );
		elxisTools::runiTool( $tname );
	break;
	case 'fixlang':
		HTML_admin_tools::fixLanguage();
	break;
	case 'cleartemp':
		HTML_admin_misc::clearTemporary();
	break;
	case 'promptlogout':
	   HTML_admin_misc::promptLogout();
	break;
	case 'loadModule':
	   loadCPModule();
	break;
	case 'cpanel':
    default:
		HTML_admin_misc::controlPanel();
	break;
}


/*****************************/
/* LOAD CP MODULE USING AJAX */
/*****************************/
function loadCPModule() {
	global $database, $acl, $my, $adminLanguage;

    $mod = intval(mosGetParam($_POST, 'mod', ''));
    if (!$mod) { exit('No module set!'); } //just in case

	$cache = mosCache::getCache( 'com_content' );

	$query = "SELECT id, title, module, position, content, showtitle, params"
	. "\n FROM #__modules WHERE id='$mod' AND published = '1' AND (client_id = 1)";
	$database->setQuery( $query );
	if (!$database->loadObject($module)) {
	    exit('Requested module either does not exist or is unpublished!'); //just in case
	}

	if ( $module->module == 'mod_components') {
        $editAllComponents 	= $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' );
        if (!$editAllComponents ) { exit($adminLanguage->A_NOT_AUTH); }
    }

	$params = new mosParameters( $module->params );
	if ( $module->module == '' ) {
		mosLoadCustomModule( $module, $params );
	} else {
		mosLoadAdminModule( substr( $module->module, 4 ), $params );
	}
    exit();
}


class elxisTools {

	/************************/
	/* LIST INSTALLED TOOLS */
	/************************/
	private static function listTools() {
		global $mainframe, $fmanager, $xmlLanguage;

		//Read the tools dir to find installed tools
		$toolBaseDir = $fmanager->PathName($mainframe->getCfg('absolute_path').'/administrator/tools');
		$toolDirs = $fmanager->listFolders($toolBaseDir);
		
		$rows = array();
		$rowid = 0;

		//Check that the directory contains an xml file
		foreach($toolDirs as $toolDir) {
			$dirName = $fmanager->PathName($toolBaseDir . $toolDir);
			$xmlFilesInDir = $fmanager->listFiles($dirName,'.xml');
			if ($xmlFilesInDir) {
				foreach($xmlFilesInDir as $xmlfile) {

				$xmlDoc = simplexml_load_file($dirName.$xmlfile, 'SimpleXMLElement');
				if (!$xmlDoc) { continue; }
				if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
					if ($xmlDoc->getName() != 'mosinstall') { continue; }
				}
				$ok = false;
				$attrs =  $xmlDoc->attributes();
				if ($attrs) {
					if (isset($attrs['type']) && ($attrs['type'] == 'tool')) { $ok = true; }
				}
				if (!$ok) { continue; }
				
				if (isset($xmlDoc->cxlangdir)) {
					$_xmlLangDir = trim($xmlDoc->cxlangdir);
					if ($_xmlLangDir != '') {
						global $alang;
                		if (file_exists($mainframe->getCfg('absolute_path').$_xmlLangDir.'/'.$alang.'.php')) {
                    		require_once($mainframe->getCfg('absolute_path').$_xmlLangDir.'/'.$alang.'.php');
                		} else if (file_exists($mainframe->getCfg('absolute_path').$_xmlLangDir.'/english.php')) {
                    		require_once($mainframe->getCfg('absolute_path').$_xmlLangDir.'/english.php');
                		}
                	}
				}

				$row = new stdClass();
				$row->id = $rowid;
				$row->tname = $toolDir;
				$row->icon = isset($xmlDoc->icon) ? 'tools/'.$row->tname.'/'.$xmlDoc->icon : 'images/toolrun.png';
				$row->name = $xmlLanguage->get($xmlDoc->name);
				$row->description = isset($xmlDoc->description) ? $xmlLanguage->get($xmlDoc->description) : '';
				$rows[] = $row;
				$rowid++;
				unset($xmlDoc);
				}
			}
		}
		return $rows;
	}


    /*****************/
    /* GET TOOL INFO */
    /*****************/
	private static function toolInfo($tname='') {
		global $mainframe, $fmanager, $adminLanguage, $xmlLanguage;
	  	
	  	$info = array();
	  	if (trim($tname) == '') {
	  		$info['name'] = $adminLanguage->A_CMP_ADMIN_TTITLE;
	  	} else {
	  		$toolBaseDir = $fmanager->PathName($mainframe->getCfg('absolute_path').'/administrator/tools');
	  		$xmlfile = $toolBaseDir.$tname.SEP.$tname.'.xml';
	  		if (!file_exists($xmlfile)) {
	  			$info['name'] = $adminLanguage->A_CMP_ADMIN_TTITLE;
			} else {
				$info['name'] = $tname;
				if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
				$xmlDoc = simplexml_load_file($xmlfile, 'SimpleXMLElement');
				if (!$xmlDoc) { return $info; }
				if (isset($xmlDoc->name)) {
					$info['name'] = $xmlDoc->name;
					if ((preg_match('/^AX_/', $info['name'])) || (preg_match('/^CX_/', $info['name']))) {
						$info['name'] = $xmlLanguage->get($info['name']);
					}
				}
				unset($xmlDoc);
			}
		}
		return $info;
	}


    /************/
    /* RUN TOOL */
    /************/
	public static function runTool ( $tname='') {
		global $mosConfig_absolute_path, $adminLanguage;

		$basedir = $mosConfig_absolute_path . '/administrator/tools';
		if ((trim($tname) == '') || (!file_exists( $basedir.'/'.$tname.'/'.$tname.'.php' ))) {
            elxisTools::toolsCentral();
            return;
        }

		$rows = elxisTools::listTools();
		$info = elxisTools::toolInfo( $tname );
	?>
		<table class="adminheading">
        <tr>
            <th class="tools"><?php echo $adminLanguage->A_CMP_ADMIN_TTOOLS; ?>: <small><?php echo $info['name']; ?></small></th>
        </tr>
        </table>
		<table width="100%">
		<tr>
			<td valign="top" width="200">
				<table class="adminlist">
				<tr>
					<th><?php echo $adminLanguage->A_CMP_ADMIN_TINSTTOOLS; ?></th>
		        </tr>
		        <tr>
		        	<td><div id="tools">
					<?php 
						foreach ($rows as $row) {
					?>
						<div class="item">
		            		<div class="title">
    			        	<a href="index2.php?option=com_admin&task=tools&tname=<?php echo $row->tname; ?>" title="<?php echo $adminLanguage->A_CMP_ADMIN_RUNTOOL; ?>">
                        	<img src="<?php echo $row->icon; ?>" border="0" alt="<?php echo $adminLanguage->A_CMP_ADMIN_RUNTOOL; ?>" style="vertical-align:middle;" /> &nbsp; 
                        	<b><?php echo $row->name; ?></b></a>
                        	</div>
							<div class="desc"><?php echo $row->description; ?></div>
            			</div>
					<?php 
						}
					?>
					</div></td>
		    	</tr>
		    	</table>
			</td>
			<td valign="top">
			<?php 
			if ((trim($tname) !== '') && (file_exists( $basedir.'/'.$tname.'/'.$tname.'.php' ))) {
				include_once($basedir . '/'.$tname.'/'.$tname.'.php' );
			} else { 
			?>
            <table class="adminlist">
            <tr>
	            <td><?php echo $adminLanguage->A_CMP_ADMIN_DESCR; ?></td>
            </tr>
            </table>	
			<?php
            }
			?>
			</td>
		</tr>
		</table>
	<?php 
	}


    /**********************/
    /* TOOLS CENTRAL PAGE */
    /**********************/
    static private function toolsCentral() {
        global $mainframe, $adminLanguage;

		$rows = elxisTools::listTools();
		$info = elxisTools::toolInfo();
		$basedir = $mainframe->getCfg('absolute_path').'/administrator/tools'
?>

		<table class="adminheading">
        <tr>
            <th class="tools"><?php echo $adminLanguage->A_CMP_ADMIN_TTOOLS; ?></th>
        </tr>
        </table>
		<div id="tools">
		<?php 
			foreach ($rows as $row) {
		?>
				<div class="itemmain">
		            <div class="titlemain">
    			    <a href="index2.php?option=com_admin&task=tools&amp;tname=<?php echo $row->tname; ?>" title="<?php echo $adminLanguage->A_CMP_ADMIN_RUNTOOL; ?>">
                    <img src="<?php echo $row->icon; ?>" border="0" alt="<?php echo $adminLanguage->A_CMP_ADMIN_RUNTOOL; ?>" style="vertical-align:middle;" /> &nbsp; 
                    <strong><?php echo $row->name; ?></strong></a></div>
					<div class="desc"><?php echo $row->description; ?></div>
            	</div>
			<?php 
				}
			?>
		</div>
<?php 
    }


    /******************************/
    /* RUN TOOL IN INVISIBLE MODE */
    /******************************/
	public static function runiTool ( $tname = '') {
		global $mainframe, $adminLanguage;

		$basedir = $mainframe->getCfg('absolute_path').'/administrator/tools';
		if ((trim($tname) !== '') && (file_exists( $basedir.'/'.$tname.'/'.$tname.'.php' ))) {
			include_once($basedir.'/'.$tname.'/'.$tname.'.php' );
		}
	}
}

?>