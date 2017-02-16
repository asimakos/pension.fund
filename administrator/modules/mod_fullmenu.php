<?php 
/**
* @version: $Id: mod_fullmenu.php 27 2010-06-02 17:20:10Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Module Fullmenu
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info [AT] elxis [DOT] org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class mosFullAdminMenu {

	/******************/
	/* SHOW FULL MENU */
	/******************/
	static public function show( $usertype='', $alang='english' ) {
		global $acl, $database, $adminLanguage;
		global $mosConfig_live_site, $mosConfig_enable_stats, $mosConfig_caching, $mosConfig_pub_langs;

		//cache some acl checks
		$canConfig 			= $acl->acl_check( 'administration', 'config', 'users', $usertype );
		$manageTemplates 	= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_templates' );
		$manageTrash 		= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_trash' );
		$manageMenuMan 		= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_menumanager' );
		$manageLanguages 	= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_languages' );
		$installModules 	= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'modules', 'all' );
		$editAllModules 	= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'modules', 'all' );
		$installMambots 	= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'mambots', 'all' );
		$editAllMambots 	= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'mambots', 'all' );
		$editAllTools 		= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'tools', 'all' );
		$installComponents 	= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'components', 'all' );
		$editAllComponents 	= $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'components', 'all' );
		$installBridges 	= $acl->acl_check( 'administration', 'install', 'users', $usertype, 'bridges', 'all' );
		$canMassMail 		= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_massmail' );
		$canManageUsers 	= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_users' );
		$manageAccess 		= $acl->acl_check( 'administration', 'manage', 'users', $usertype, 'components', 'com_access' );
		$editContent 		= $acl->acl_check( 'action', 'edit', 'users', $usertype, 'content', 'all' );
		if (!$editContent) {
            $editContent    = $acl->acl_check( 'action', 'add', 'users', $usertype, 'content', 'all' );
        }

		$oradrivers = array('oci8', 'oci805', 'oci8po', 'oracle');
		$dbt = $database->_resource->databaseType;
		
		if (!in_array($dbt, $oradrivers)) {
			$pg = (preg_match('/postgre/i', $dbt)) ? '::VARCHAR' : '';

			$query = "SELECT a.id, a.title, a.name,"
        	."\n COUNT(DISTINCT c.id) AS numcat, COUNT(DISTINCT b.id) AS numarc"
        	."\n FROM #__sections a"
        	."\n LEFT JOIN #__categories c ON c.section=a.id".$pg
        	."\n LEFT JOIN #__content b ON b.sectionid=a.id AND b.state=-1"
        	."\n WHERE a.scope='content'"
        	."\n GROUP BY a.id, a.title, a.name, a.ordering"
        	."\n ORDER BY a.ordering";
			$database->setQuery( $query );
        	$sections = $database->loadObjectList();
        } else { //sorry not found better working solution for oracle
        	$database->setQuery("SELECT id, title, name FROM #__sections WHERE scope='content' ORDER BY ordering");
        	$sections = $database->loadObjectList();
        	if ($sections) {
        		foreach ($sections as $section) {
        			$database->setQuery("SELECT COUNT(id) FROM #__categories WHERE section='".$section->id."'");
        			$section->numcat = intval($database->loadResult());
        			$database->setQuery("SELECT COUNT(id) FROM #__content WHERE sectionid='".$section->id."' AND state=-1");
        			$section->numarc = intval($database->loadResult());
        		}
        	}
        }

		$nonemptySections = 0;
		if ($sections) {
			foreach ($sections as $section) {
				if ($section->numcat > 0) { $nonemptySections++; }
			}
		}
		$menuTypes = mosAdminMenus::menutypes();
?>
		<div id="myMenuID"></div>
		<script type="text/javascript">
		var myMenu =
		[
<?php
	//Home Sub-Menu
?>			[null,'<?php echo $adminLanguage->A_MENU_HOME; ?>','index2.php',null,'Control Panel'],
			_cmSplit,
<?php
	//Site Sub-Menu
?>			[null,'<?php echo $adminLanguage->A_SITE; ?>',null,null,'<?php echo $adminLanguage->A_MENU_SITE_MENU; ?>',
<?php
			if ($canConfig) {
?>				['<img src="../includes/js/ThemeOffice/config.png" alt="" />','<?php echo $adminLanguage->A_MENU_GC; ?>','index2.php?option=com_config&hidemainmenu=1',null,'<?php echo $adminLanguage->A_MENU_CONFIGURATION; ?>'],
<?php
			}
			if ($manageLanguages) {
?>				['<img src="../includes/js/ThemeOffice/language.png" alt="" />','<?php echo $adminLanguage->A_MENU_LANG_MANAGE; ?>',null,null,'<?php echo $adminLanguage->A_MENU_MANAGE_LANG; ?>',
  					['<img src="../includes/js/ThemeOffice/language.png" alt="" />','<?php echo $adminLanguage->A_MENU_SITELANS; ?>','index2.php?option=com_languages',null,'<?php echo $adminLanguage->A_MENU_MANAGE_LANG; ?>'],
  					['<img src="../includes/js/ThemeOffice/language.png" alt="" />','<?php echo $adminLanguage->A_MENU_ADMINLANGS; ?>','index2.php?option=com_languages&task=viewalangs',null,'<?php echo $adminLanguage->A_MENU_MANAGE_LANG; ?>'],
  				],
<?php
			}
?>				['<img src="../includes/js/ThemeOffice/media.png" alt="" />','<?php echo $adminLanguage->A_MENU_MEDIA_MANAGE; ?>','index2.php?option=com_media',null,'<?php echo $adminLanguage->A_MENU_MANAGE_MEDIA; ?>'],
					['<img src="../includes/js/ThemeOffice/preview.png" alt="" />', '<?php echo $adminLanguage->A_PREVIEW; ?>', null, null, '<?php echo $adminLanguage->A_PREVIEW; ?>',
					['<img src="../includes/js/ThemeOffice/preview.png" alt="" />','<?php echo $adminLanguage->A_MENU_NEW_WINDOW; ?>','<?php echo $mosConfig_live_site; ?>/index.php','_blank','<?php echo $mosConfig_live_site; ?>'],
					['<img src="../includes/js/ThemeOffice/preview.png" alt="" />','<?php echo $adminLanguage->A_MENU_INLINE; ?>','index2.php?option=com_admin&task=preview',null,'<?php echo $mosConfig_live_site; ?>'],
					['<img src="../includes/js/ThemeOffice/preview.png" alt="" />','<?php echo $adminLanguage->A_MENU_INLINE_POS; ?>','index2.php?option=com_admin&task=preview2',null,'<?php echo $mosConfig_live_site; ?>'],
				],
				['<img src="../includes/js/ThemeOffice/globe1.png" alt="" />', '<?php echo $adminLanguage->A_MENU_STATISTICS; ?>', null, null, '<?php echo $adminLanguage->A_MENU_STATISTICS_SITE; ?>',
<?php
			if ($mosConfig_enable_stats == 1) {
?>					['<img src="../includes/js/ThemeOffice/globe4.png" alt="" />', '<?php echo $adminLanguage->A_MENU_BROWSER; ?>', 'index2.php?option=com_statistics', null, '<?php echo $adminLanguage->A_MENU_BROWSER; ?>'],
  					['<img src="../includes/js/ThemeOffice/globe3.png" alt="" />', '<?php echo $adminLanguage->A_MENU_PAGE_IMP; ?>', 'index2.php?option=com_statistics&task=pageimp', null, '<?php echo $adminLanguage->A_MENU_PAGE_IMP; ?>'],
<?php
			}
?>					['<img src="../includes/js/ThemeOffice/search_text.png" alt="" />', '<?php echo $adminLanguage->A_MENU_SEARCH_TEXT; ?>', 'index2.php?option=com_statistics&task=searches', null, '<?php echo $adminLanguage->A_MENU_SEARCH_TEXT; ?>']
				],
<?php
			if ($manageTemplates) {
?>				['<img src="../includes/js/ThemeOffice/template.png" alt="" />','<?php echo $adminLanguage->A_MENU_TEMP_MANAGE; ?>',null,null,'<?php echo $adminLanguage->A_MENU_TEMP_CHANGE; ?>',
  					['<img src="../includes/js/ThemeOffice/template.png" alt="" />','<?php echo $adminLanguage->A_MENU_SITE_TEMP; ?>','index2.php?option=com_templates',null,'<?php echo $adminLanguage->A_MENU_TEMP_CHANGE; ?>'],
  					['<img src="../includes/js/ThemeOffice/install.png" alt="" />','<?php echo $adminLanguage->A_MENU_INSTALL; ?>','index2.php?option=com_installer&element=template&client=',null,'<?php echo $adminLanguage->A_MENU_INSTALL.' '.$adminLanguage->A_MENU_SITE_TEMP; ?>'],
  					_cmSplit,
  					['<img src="../includes/js/ThemeOffice/template.png" alt="" />','<?php echo $adminLanguage->A_MENU_ADMIN_TEMP; ?>','index2.php?option=com_templates&client=admin',null,'<?php echo $adminLanguage->A_MENU_ADMIN_CHANGE_TEMP; ?>'],
  					['<img src="../includes/js/ThemeOffice/install.png" alt="" />','<?php echo $adminLanguage->A_MENU_INSTALL; ?>','index2.php?option=com_installer&element=template&client=admin',null,'<?php echo $adminLanguage->A_MENU_INSTALL.' '.$adminLanguage->A_MENU_ADMIN_TEMP; ?>'],
  					_cmSplit,
  					['<img src="../includes/js/ThemeOffice/template.png" alt="" />','<?php echo $adminLanguage->A_MENU_LOGIN_SCREENS; ?>','index2.php?option=com_templates&client=login',null,'<?php echo $adminLanguage->A_MENU_ADMIN_CHANGE_TEMP; ?>'],
  					['<img src="../includes/js/ThemeOffice/install.png" alt="" />','<?php echo $adminLanguage->A_MENU_INSTALL; ?>','index2.php?option=com_installer&element=template&client=login',null,'<?php echo $adminLanguage->A_MENU_INSTALL.' '.$adminLanguage->A_MENU_ADMIN_TEMP; ?>'],
  					_cmSplit,
  					['<img src="../includes/js/ThemeOffice/template.png" alt="" />','<?php echo $adminLanguage->A_MENU_MODUL_POS; ?>','index2.php?option=com_templates&task=positions',null,'<?php echo $adminLanguage->A_MENU_TEMP_POS; ?>']
  				],
<?php
			}
			if ($manageTrash) {
?>				['<img src="../includes/js/ThemeOffice/trash.png" alt="" />','<?php echo $adminLanguage->A_MENU_TRASH_MANAGE; ?>','index2.php?option=com_trash',null,'<?php echo $adminLanguage->A_MENU_MANAGE_TRASH; ?>'],
<?php
			}
			if ($canManageUsers || $canMassMail) {
?>				['<img src="../includes/js/ThemeOffice/users.png" alt="" />','<?php echo $adminLanguage->A_MENU_USER_MANAGE; ?>',null,null,'<?php echo $adminLanguage->A_MENU_MANAGE_USER; ?>',
    				['<img src="../includes/js/ThemeOffice/users.png" alt="" />','<?php echo $adminLanguage->A_USERS; ?>','index2.php?option=com_users&task=view',null,'<?php echo $adminLanguage->A_USERS; ?>'],
                    ['<img src="../includes/js/ThemeOffice/users.png" alt="" />','<?php echo $adminLanguage->A_EXTRAFIELDS; ?>','index2.php?option=com_users&task=extra',null,'<?php echo $adminLanguage->A_EXTRAFIELDS; ?>'],
                ],
<?php
				}
			if ($manageAccess) {
?>				['<img src="../includes/js/ThemeOffice/access.png" alt="" />','<?php echo $adminLanguage->A_MENU_ACCSMANG; ?>','index2.php?option=com_access',null,'Access Manager'],
<?php
				}
?>			],
<?php
	//Menu Sub-Menu
?>			_cmSplit,
			[null,'<?php echo $adminLanguage->A_MENU; ?>',null,null,'<?php echo $adminLanguage->A_MENU_MENU_MANAGMENT; ?>',
<?php
			if ($manageMenuMan) {
?>				['<img src="../includes/js/ThemeOffice/menus.png" alt="" />','<?php echo $adminLanguage->A_MENU_MANAGER; ?>','index2.php?option=com_menumanager',null,'<?php echo $adminLanguage->A_MENU_MANAGER; ?>'],
				_cmSplit,
<?php
			}
			foreach ( $menuTypes as $menuType ) {
?>				['<img src="../includes/js/ThemeOffice/menus.png" alt="" />','<?php echo $menuType;?>','index2.php?option=com_menus&menutype=<?php echo $menuType;?>',null,''],
<?php
			}
?>			],
			_cmSplit,
<?php
	//Content Sub-Menu
    if ($editContent) {
?>			[null,'<?php echo $adminLanguage->A_MENU_CONTENT; ?>',null,null,'<?php echo $adminLanguage->A_MENU_CONTENT_MANAGE; ?>',
<?php
			if (count($sections) > 0) {
?>				['<img src="../includes/js/ThemeOffice/edit.png" alt="" />','<?php echo $adminLanguage->A_MENU_CONTENT_BYSEC; ?>',null,null,'<?php echo $adminLanguage->A_MENU_CONTENT_MANAGERS; ?>',
<?php
				foreach ($sections as $section) {
					$txt = addslashes( $section->title ? $section->title : $section->name );
?>					['<img src="../includes/js/ThemeOffice/document.png" alt="" />','<?php echo $txt;?>', null, null,'<?php echo $txt;?>',
<?php
					if ($section->numcat) {
?>						['<img src="../includes/js/ThemeOffice/edit.png" alt="" />', '<?php echo $txt.' '.$adminLanguage->A_MENU_ITEMS?>', 'index2.php?option=com_content&sectionid=<?php echo $section->id;?>',null,null],
<?php
					}
?>						['<img src="../includes/js/ThemeOffice/add_section.png" alt="" />', '<?php echo $adminLanguage->A_MENU_ADDNEDIT.' '.$txt.' '.$adminLanguage->A_CATEGORS; ?>', 'index2.php?option=com_categories&section=<?php echo $section->id;?>',null, null],
<?php
					if ($section->numarc) {
?>						['<img src="../includes/js/ThemeOffice/backup.png" alt="" />', '<?php echo $txt.' '.$adminLanguage->A_MENU_ARCHIVE; ?>', 'index2.php?option=com_content&task=showarchive&sectionid=<?php echo $section->id;?>',null,null],
<?php
					}
?>					],
<?php
				} //foreach
?>				],
				_cmSplit,
<?php
			}
			if ($manageLanguages) {
            //content by Language
            $publs = explode(',', $mosConfig_pub_langs);
?>
            ['<img src="../includes/js/ThemeOffice/language.png" alt="" />','<?php echo $adminLanguage->A_MENU_CBL; ?>',null,null,'<?php echo $adminLanguage->A_MENU_CBL; ?>',
                ['<img src="../includes/js/ThemeOffice/language.png" alt="" />', '<?php echo $adminLanguage->A_MENU_AL; ?>', 'index2.php?option=com_content&task=tree',null,null],
<?php
    			foreach ($publs as $publ) {
?>
                ['<img src="../includes/js/ThemeOffice/language.png" alt="" />', '<?php echo $publ; ?>', 'index2.php?option=com_content&task=tree&filter_lang=<?php echo $publ; ?>',null,null],
<?php
    			}
?>
            ],
<?php
			}
?>
                _cmSplit,
				['<img src="../includes/js/ThemeOffice/document.png" alt="" />','<?php echo $adminLanguage->A_SUB_CONTENT; ?>','index2.php?option=com_content&task=subcontent',null,'<?php echo $adminLanguage->A_SUB_CONTENT; ?>'],
				['<img src="../includes/js/ThemeOffice/edit.png" alt="" />','<?php echo $adminLanguage->A_ALLCONTENTITEMS; ?>','index2.php?option=com_content&sectionid=0',null,'<?php echo $adminLanguage->A_MENU_MANAGE_CONTENT; ?>'],
  				['<img src="../includes/js/ThemeOffice/edit.png" alt="" />','<?php echo $adminLanguage->A_MENU_STATICMANAGER; ?>','index2.php?option=com_typedcontent',null,'<?php echo $adminLanguage->A_MENU_ITEMS_CONTENT; ?>'],
  				_cmSplit,
  				['<img src="../includes/js/ThemeOffice/add_section.png" alt="" />','<?php echo $adminLanguage->A_SECTIONMANAGER; ?>','index2.php?option=com_sections&scope=content',null,'<?php echo $adminLanguage->A_MENU_CONTENT_SEC; ?>'],
<?php
			if (count($sections) > 0) {
?>				['<img src="../includes/js/ThemeOffice/add_section.png" alt="" />','<?php echo $adminLanguage->A_CATEGORYMANAGER; ?>','index2.php?option=com_categories&section=content',null,'<?php echo $adminLanguage->A_MENU_CONTENT_CAT; ?>'],
<?php
			}
?>				_cmSplit,
  				['<img src="../includes/js/ThemeOffice/home.png" alt="" />','<?php echo $adminLanguage->A_FP_MANAGER; ?>','index2.php?option=com_frontpage',null,'<?php echo $adminLanguage->A_MENU_ITEMS_FRONT; ?>'],
  				['<img src="../includes/js/ThemeOffice/edit.png" alt="" />','<?php echo $adminLanguage->A_MENU_ARCHIVE_MANAGE; ?>','index2.php?option=com_content&task=showarchive&sectionid=0',null,'<?php echo $adminLanguage->A_MENU_ITEMS_ARCHIVE; ?>'],
			],
<?php 
    } //content end

	//Components Sub-Menu
	if ($installComponents) {
?>			_cmSplit,
			[null,'<?php echo $adminLanguage->A_MENU_COMPONENTS; ?>',null,null,'<?php echo $adminLanguage->A_MENU_COMPONENT_MANAGMENT; ?>',
				['<img src="../includes/js/ThemeOffice/install.png" alt="" />','<?php echo $adminLanguage->A_MENU_INST_UNST; ?>','index2.php?option=com_installer&element=component',null,'<?php echo $adminLanguage->A_MENU_INST_UNST.' '.$adminLanguage->A_MENU_COMPONENTS; ?>'],
				['<img src="../includes/js/ThemeOffice/query.png" alt="" />','<?php echo $adminLanguage->A_CHK_UPDATES; ?>','index2.php?option=com_installer&element=component&task=updates',null,'<?php echo $adminLanguage->A_CHK_UPDATES.' '.$adminLanguage->A_MENU_COMPONENTS; ?>'],
  				_cmSplit,
<?php
        $query = "SELECT * FROM #__components WHERE name <> 'frontpage' AND name <> 'media manager' ORDER BY ordering, name";
        $database->setQuery( $query );
        $comps = $database->loadObjectList();
        $subs = array();
        //first pass to collect sub-menu items
        foreach ($comps as $row) {
            if ($row->parent) {
                if (!array_key_exists( $row->parent, $subs )) {
                    $subs[$row->parent] = array();
                }
                $subs[$row->parent][] = $row;
            }
        }
        $topLevelLimit = 25; //You can get 19 top levels on a 800x600 Resolution
        $topLevelCount = 0;
        foreach ($comps as $row) {
            if ($editAllComponents | $acl->acl_check( 'administration', 'edit', 'users', $usertype, 'components', $row->option )) {
                if ($row->parent == 0 && (trim( $row->admin_menu_link ) || array_key_exists( $row->id, $subs ))) {
                    $topLevelCount++;
                    if ($topLevelCount > $topLevelLimit) {
                        continue;
                    }
                    $name = addslashes(mosFullAdminMenu::transComponent($row->name));
                    $alt = addslashes( $row->admin_menu_alt );
                    $link = $row->admin_menu_link ? "'index2.php?$row->admin_menu_link'" : "null";
                    echo "\t\t\t\t['<img src=\"../includes/$row->admin_menu_img\" alt=\"\" />','$name',$link,null,'$alt'";
                    if (array_key_exists( $row->id, $subs )) {
                        foreach ($subs[$row->id] as $sub) {
	                        echo ",\n";
                            $name = addslashes(mosFullAdminMenu::transComponent($sub->name));
                            $alt = addslashes( $sub->admin_menu_alt );
                            $link = $sub->admin_menu_link ? "'index2.php?$sub->admin_menu_link'" : "null";
                            echo "\t\t\t\t\t['<img src=\"../includes/$sub->admin_menu_img\" alt=\"\" />','$name',$link,null,'$alt']";
                        }
                    }
                    echo "\n\t\t\t\t],\n";
                }
            }
        }
        if ($topLevelLimit < $topLevelCount) {
            echo "\t\t\t\t['<img src=\"../includes/js/ThemeOffice/sections.png\" alt=\"\" />','<?php echo $adminLanguage->A_MENU_MORE_COMP; ?>...','index2.php?option=com_admin&task=listcomponents',null,'<?php echo $adminLanguage->A_MENU_MORE_COMP; ?>'],\n";
        }
?>
			],
<?php
	// Modules Sub-Menu
		if ($installModules | $editAllModules) {
?>			_cmSplit,
			[null,'<?php echo $adminLanguage->A_MENU_MODULES; ?>',null,null,'<?php echo $adminLanguage->A_MENU_MODULE_MANAGMENT; ?>',
<?php
			if ($installModules) {
?>				['<img src="../includes/js/ThemeOffice/install.png" alt="" />', '<?php echo $adminLanguage->A_MENU_INST_UNST; ?>', 'index2.php?option=com_installer&element=module', null, '<?php echo $adminLanguage->A_MENU_INSTALL_CUST; ?>'],
				['<img src="../includes/js/ThemeOffice/query.png" alt="" />','<?php echo $adminLanguage->A_CHK_UPDATES; ?>','index2.php?option=com_installer&element=module&task=updates',null,'<?php echo $adminLanguage->A_CHK_UPDATES.' '.$adminLanguage->A_MENU_MODULES; ?>'],
				_cmSplit,
<?php
			}
			if ($editAllModules) {
?>				['<img src="../includes/js/ThemeOffice/module.png" alt="" />', '<?php echo $adminLanguage->A_MENU_SITE_MOD; ?>', "index2.php?option=com_modules", null, '<?php echo $adminLanguage->A_MENU_SITE_MOD_MANAGE; ?>'],
				['<img src="../includes/js/ThemeOffice/module.png" alt="" />', '<?php echo $adminLanguage->A_MENU_ADMIN_MOD; ?>', "index2.php?option=com_modules&client=admin", null, '<?php echo $adminLanguage->A_MENU_ADMIN_MOD_MANAGE; ?>'],
<?php
			}
?>			],
<?php
		} //if ($installModules | $editAllModules)
	} //if $installComponents
	//Bots Sub-Menu
	if ($installMambots | $editAllMambots) {
?>			_cmSplit,
			[null,'<?php echo $adminLanguage->A_MENU_MAMBOTS; ?>',null,null,'<?php echo $adminLanguage->A_MENU_MAMBOT_MANAGMENT; ?>',
<?php
		if ($installMambots) {
?>				['<img src="../includes/js/ThemeOffice/install.png" alt="" />', '<?php echo $adminLanguage->A_MENU_INST_UNST; ?>', 'index2.php?option=com_installer&element=mambot', null, '<?php echo $adminLanguage->A_MENU_CUSTOM_MAMBOT; ?>'],
				['<img src="../includes/js/ThemeOffice/query.png" alt="" />','<?php echo $adminLanguage->A_CHK_UPDATES; ?>','index2.php?option=com_installer&element=mambot&task=updates',null,'<?php echo $adminLanguage->A_CHK_UPDATES.' '.$adminLanguage->A_MENU_MAMBOTS; ?>'],
				_cmSplit,
<?php
		}
		if ($editAllMambots) {
?>				['<img src="../includes/js/ThemeOffice/module.png" alt="" />', '<?php echo $adminLanguage->A_MENU_SITE_MAMBOTS; ?>', 'index2.php?option=com_mambots', null, '<?php echo $adminLanguage->A_MENU_MAMBOT_MANAGE; ?>'],
<?php
		}
?>			],
<?php
	}
?>
<?php
	//Installer Sub-Menu
	if ($installModules) {
?>			_cmSplit,
			[null,'<?php echo $adminLanguage->A_MENU_INSTALLERS; ?>',null,null,'<?php echo $adminLanguage->A_MENU_INSTALLER_LIST; ?>',
<?php
		if ($manageTemplates) {
?>				['<img src="../includes/js/ThemeOffice/install.png" alt="" />','<?php echo $adminLanguage->A_TEMPLATES.' - '.$adminLanguage->A_SITE; ?>','index2.php?option=com_installer&element=template&client=',null,'<?php echo $adminLanguage->A_MENU_INSTALL.' '.$adminLanguage->A_MENU_SITE_TEMP; ?>'],
				['<img src="../includes/js/ThemeOffice/install.png" alt="" />','<?php echo $adminLanguage->A_TEMPLATES.' - '.$adminLanguage->A_ADMINISTRATOR; ?>','index2.php?option=com_installer&element=template&client=admin',null,'<?php echo $adminLanguage->A_MENU_INSTALL.' '.$adminLanguage->A_MENU_ADMIN_TEMP; ?>'],
				['<img src="../includes/js/ThemeOffice/install.png" alt="" />','<?php echo $adminLanguage->A_MENU_LOGIN_SCREENS; ?>','index2.php?option=com_installer&element=template&client=login',null,'<?php echo $adminLanguage->A_MENU_INSTALL.' '.$adminLanguage->A_MENU_ADMIN_TEMP; ?>'],
				_cmSplit,
<?php
		}
		if ($manageLanguages) {
?>				['<img src="../includes/js/ThemeOffice/install.png" alt="" />','<?php echo $adminLanguage->A_MENU_SITELANS; ?>','index2.php?option=com_installer&element=language',null,'<?php echo $adminLanguage->A_MENU_INSTALL_LANG; ?>'],
  				['<img src="../includes/js/ThemeOffice/install.png" alt="" />','<?php echo $adminLanguage->A_MENU_ADMINLANGS; ?>','index2.php?option=com_installer&element=language&client=admin',null,'<?php echo $adminLanguage->A_MENU_INSTALL_LANG; ?>'],

				_cmSplit,
<?php
		}
?>				['<img src="../includes/js/ThemeOffice/install.png" alt="" />', '<?php echo $adminLanguage->A_MENU_COMPONENTS; ?>','index2.php?option=com_installer&element=component',null,'<?php echo $adminLanguage->A_MENU_INST_UNST; ?> Components'],
				['<img src="../includes/js/ThemeOffice/install.png" alt="" />', '<?php echo $adminLanguage->A_MENU_MODULES; ?>', 'index2.php?option=com_installer&element=module', null, '<?php echo $adminLanguage->A_MENU_INST_UNST; ?> Modules'],
				['<img src="../includes/js/ThemeOffice/install.png" alt="" />', '<?php echo $adminLanguage->A_MENU_MAMBOTS; ?>', 'index2.php?option=com_installer&element=mambot', null, '<?php echo $adminLanguage->A_MENU_INST_UNST; ?> Mambots'],
<?php 
	   if ($installBridges) {
?>
				['<img src="../includes/js/ThemeOffice/install.png" alt="" />', '<?php echo $adminLanguage->A_BRIDGES; ?>', 'index2.php?option=com_installer&element=bridge', null, '<?php echo $adminLanguage->A_MENU_INST_UNST; ?> <?php echo $adminLanguage->A_BRIDGES; ?>'],
<?php 
        }
?>
			],
<?php
	} //if ($installModules)
	//Messages Sub-Menu
	if ($canConfig) {
?>			_cmSplit,
  			[null,'<?php echo $adminLanguage->A_MENU_MESSAGES; ?>',null,null,'<?php echo $adminLanguage->A_MENU_MESSAGING_MANAGMENT; ?>',
  				['<img src="../includes/js/ThemeOffice/messaging_inbox.png" alt="" />','<?php echo $adminLanguage->A_MENU_INBOX; ?>','index2.php?option=com_messages',null,'<?php echo $adminLanguage->A_MENU_PRIV_MSG; ?>'],
  				['<img src="../includes/js/ThemeOffice/messaging_config.png" alt="" />','<?php echo $adminLanguage->A_MENU_CONFIGURATION; ?>','index2.php?option=com_messages&task=config&hidemainmenu=1',null,'<?php echo $adminLanguage->A_MENU_CONFIGURATION; ?>']
  			],
<?php
	//System Sub-Menu
?>			_cmSplit,
  			[null,'<?php echo $adminLanguage->A_MENU_SYSTEM; ?>',null,null,'<?php echo $adminLanguage->A_MENU_SYSTEM_MANAGMENT; ?>',
<?php
  		if ($canConfig) {
?>				['<img src="../includes/js/ThemeOffice/checkin.png" alt="" />', '<?php echo $adminLanguage->A_MENU_GLOBAL_CHECK; ?>', 'index2.php?option=com_checkin', null,'<?php echo $adminLanguage->A_MENU_CHECK_INOUT; ?>'],
				['<img src="../includes/js/ThemeOffice/sysinfo.png" alt="" />', '<?php echo $adminLanguage->A_MENU_SYSTEMINFO; ?>', 'index2.php?option=com_admin&task=sysinfo', null, '<?php echo $adminLanguage->A_MENU_SYSTEMINFO; ?>'],
<?php
			if ($mosConfig_caching) {
?>				['<img src="../includes/js/ThemeOffice/config.png" alt="" />','<?php echo $adminLanguage->A_MENU_CLEAN_CACHE; ?>','index2.php?option=com_content&task=clean_cache',null,'<?php echo $adminLanguage->A_MENU_CLEAN_CACHE_ITEMS; ?>'],
<?php
			}
		}
?>			],
<?php
			}
?>			_cmSplit,
<?php 
        if ($editAllTools) {
    //Tools Sub-Menu
?>          [null,'<?php echo $adminLanguage->A_TOOLS; ?>','index2.php?option=com_admin&task=tools',null,null],
			_cmSplit,
<?php
        }
?>
		];
		cmDraw ('myMenuID', myMenu, '<?php echo (_GEM_RTL) ? 'hbl' : 'hbr'; ?>', cmThemeOffice, 'ThemeOffice');
		</script>
<?php
	}


	/****************************/
	/* TRANSLATE COMPONENT NAME */
	/****************************/
	static private function transComponent($name='') {
		global $adminLanguage;

		$check = strtolower($name);
		switch ($check) {
			case 'banners':
				$name = $adminLanguage->A_BANNERS;
			break;
			case 'manage banners':
				$name = $adminLanguage->A_MAN_BANNERS;
			break;
			case 'manage clients':
				$name = $adminLanguage->A_MAN_CLIENTS;
			break;
			case 'web links';
				$name = $adminLanguage->A_LINKS;
			break;
			case 'weblink items':
				$name = $adminLanguage->A_WEBL_ITEMS;
			break;
			case 'weblink categories':
				$name = $adminLanguage->A_WEBL_CATEGORS;
			break;
			case 'contacts':
				$name = $adminLanguage->A_CONTACTS;
			break;
			case 'manage contacts':
				$name = $adminLanguage->A_MENU_MANAGE_CONTACTS;
			break;
			case 'contact categories':
				$name = $adminLanguage->A_CONT_CATEGORS;
			break;
			case 'frontpage':
				$name = $adminLanguage->A_FRONTPAGE;
			break;
			case 'polls':
				$name = $adminLanguage->A_POLL_MANAGER;
			break;
			case 'news feeds':
				$name = $adminLanguage->A_NEWSFEEDS;
			break;
			case 'manage news feeds':
				$name = $adminLanguage->A_MAN_NEWSFEEDS;
			break;
			case 'manage categories':
				$name = $adminLanguage->A_NEWSFEED_CATS;
			break;
			case 'login':
				$name = $adminLanguage->A_LOGIN;
			break;
			case 'search':
				$name = $adminLanguage->A_SEARCH;
			break;
			case 'syndicate':
				$name = $adminLanguage->A_SYNDICATE;
			break;
			case 'mass mail':
				$name = $adminLanguage->A_MENU_MASS_MAIL;
			break;
			case 'database manager':
				$name = $adminLanguage->A_DATABASEMANAGER;
			break;
			case 'manage database':
				$name = $adminLanguage->A_MAN_DB;
			break;
			case 'view backups':
				$name = $adminLanguage->A_VIEW_BACKUPSB;
			break;
			case 'monitor stats':
				$name = $adminLanguage->A_MON_STATS;
			break;
			case 'monitor tables':
				$name = $adminLanguage->A_MON_TABLES;
			break;
			case 'softdisk':
				$name = $adminLanguage->SOFTDISK;
			break;
			case 'eblog':
				$name = $adminLanguage->A_ELXISBLOG;
			break;
			case 'eforum':
				$name = 'Elxis Forum';
			break;
		}
		return $name;
	}

}
global $alang;
$cache = mosCache::getCache( 'mos_fullmenu' );
$cache->call( 'mosFullAdminMenu::show', $my->usertype, $alang ); //great speed improvement! - Ioannis Sannos

?>