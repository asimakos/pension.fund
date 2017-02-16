<?php 
/**
* @version: $Id: mod_quickicon.php 1878 2008-01-25 21:26:29Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Module QuickIcon
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


global $adminLanguage, $acl, $my, $mainframe;

//check global user's access
$manageall = $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'all' );
$editall = $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' );
$addcontent = $acl->acl_check( 'action', 'add', 'users', $my->usertype, 'content', 'all' );
$editcontent = $acl->acl_check( 'action', 'edit', 'users', $my->usertype, 'content', 'all' );

/* SHORTCUTS */
$namelike = 'SC_PUBLIC_'.$my->id.'_';
$namelike2 = 'SC_PUBLIC_';
$query = "SELECT sdname FROM #__softdisk WHERE sdsection='SHORTCUTS' AND sdhidden='1'"
."\n AND ((sdname LIKE '".$namelike."%') OR ((sdname LIKE '".$namelike2."%') AND (sdvalue='1')))";
$database->setQuery($query);
$xrows = $database->loadResultArray();

$shortrows = array();
$w = 0;
if (count($xrows) > 0) {
    foreach ($xrows as $xrow) {
        $xid = str_replace('SC_PUBLIC_', '', $xrow);
        $xname = 'SC_NAME_'.$xid;
        $database->setQuery("SELECT sdvalue FROM #__softdisk WHERE sdsection='SHORTCUTS' AND sdname='$xname' AND sdhidden='1'", '#__', 1, 0);
        $shortrows[$w]['name'] = $database->loadResult();

        $xname = 'SC_LINK_'.$xid;
        $database->setQuery("SELECT sdvalue FROM #__softdisk WHERE sdsection='SHORTCUTS' AND sdname='$xname' AND sdhidden='1'", '#__', 1, 0);
        $shortrows[$w]['link'] = $database->loadResult();

        $xname = 'SC_IMAGE_'.$xid;
        $database->setQuery("SELECT sdvalue FROM #__softdisk WHERE sdsection='SHORTCUTS' AND sdname='$xname' AND sdhidden='1'", '#__', 1, 0);
        $shortrows[$w]['image'] = $database->loadResult();
        $w++;
    }
}

?>

<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
<td>
<div class="cpicons">
    <ul>
        <?php 
        if ( $editall || $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_frontpage' )) {
        ?>
        <li class="liglobal">
            <a href="index2.php?option=com_frontpage" onmouseover="this.T_BGCOLOR='#FFFFFF'; return escape('<?php echo $adminLanguage->A_FPAGEMANAGERDESC; ?>');">
                <img width="32" height="32" alt="" src="images/32X32/frontpage.png" border="0" />
                <?php echo $adminLanguage->A_FP_MANAGER; ?>
            </a>
        </li>
        <?php 
        }

        if ($addcontent || $editcontent) {
        ?>
        <li class="liglobal">
            <a href="index2.php?option=com_sections&amp;scope=content" onmouseover="this.T_BGCOLOR='#FFFFFF'; return escape('<?php echo $adminLanguage->A_SECTIONMANDESC; ?>');">
                <img width="32" height="32" alt="" src="images/32X32/sections.png" border="0" />
                <?php echo $adminLanguage->A_SECTIONMANAGER; ?>
            </a>
        </li>
        <li class="liglobal">
            <a href="index2.php?option=com_categories&amp;section=content" onmouseover="this.T_BGCOLOR='#FFFFFF'; return escape('<?php echo $adminLanguage->A_CATEGORYMANDESC; ?>');">
                <img width="32" height="32" alt="" src="images/32X32/categories.png" border="0" />
                <?php echo $adminLanguage->A_CATEGORYMANAGER; ?>
            </a>
        </li>
        <li class="liglobal">
            <a href="index2.php?option=com_content&amp;sectionid=0" onmouseover="this.T_BGCOLOR='#FFFFFF'; return escape('<?php echo $adminLanguage->A_DISPLALLCONTITEMS; ?>');">
                <img width="32" height="32" alt="" src="images/32X32/content.png" border="0" />
                <?php echo $adminLanguage->A_ALLCONTENTITEMS; ?>
            </a>
        </li>
        <li class="liglobal">
            <a href="index2.php?option=com_typedcontent" onmouseover="this.T_BGCOLOR='#FFFFFF'; return escape('<?php echo $adminLanguage->A_STATICMANDESC; ?>');">
                <img width="32" height="32" alt="" src="images/32X32/static.png" border="0" />
                <?php echo $adminLanguage->A_MENU_STATICMANAGER; ?>
            </a>
        </li>
        <?php 
        }

        if ($editall || $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_media')) {
        ?>
        <li class="liglobal">
            <a href="index2.php?option=com_media" onmouseover="this.T_BGCOLOR='#FFFFFF'; return escape('<?php echo $adminLanguage->A_MENUMEDIAMANDESC; ?>');">
                <img width="32" height="32" alt="" src="images/32X32/mediamanager.png" border="0" />
                <?php echo $adminLanguage->A_MENU_MEDIA_MANAGE; ?>
            </a>
        </li>
        <?php 
        }

        if ($manageall || $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_menumanager' )) {
		?>
        <li class="liglobal">
            <a href="index2.php?option=com_menumanager" onmouseover="this.T_BGCOLOR='#FFFFFF'; return escape('<?php echo $adminLanguage->A_MENUMANAGERDESC; ?>');">
                <img width="32" height="32" alt="" src="images/32X32/menu.png" border="0" />
                <?php echo $adminLanguage->A_MENU_MANAGER; ?>
            </a>
        </li>
		<?php 
        }

        if ($manageall || $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_users' )) {
		?>
        <li class="liglobal">
            <a href="index2.php?option=com_users" onmouseover="this.T_BGCOLOR='#FFFFFF'; return escape('<?php echo $adminLanguage->A_MENUUSERMANDESC; ?>');">
                <img width="32" height="32" alt="" src="images/32X32/user.png" border="0" />
                <?php echo $adminLanguage->A_MENU_USER_MANAGE; ?>
            </a>
        </li>
		<?php 
        }

        if ( $acl->acl_check( 'administration', 'config', 'users', $my->usertype ) ) {
        ?>
        <li class="liglobal">
            <a href="index2.php?option=com_config&amp;hidemainmenu=1" onmouseover="this.T_BGCOLOR='#FFFFFF'; return escape('<?php echo $adminLanguage->A_GLOBAL_CONFDESC; ?>');">
                <img width="32" height="32" alt="" src="images/32X32/config.png" border="0" />
                <?php echo $adminLanguage->A_MENU_GC; ?>
            </a>
        </li>
        <?php 
        }

        if ( $manageall || $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_access' ) ) {
        ?>
        <li class="liglobal">
            <a href="index2.php?option=com_access" onmouseover="this.T_BGCOLOR='#FFFFFF'; return escape('<?php echo $adminLanguage->A_ACCESSMANDESC; ?>');">
                <img width="32" height="32" alt="" src="images/32X32/lock.png" border="0" />
                <?php echo $adminLanguage->A_ACCESS; ?>
            </a>
        </li>
        <?php 
        }

        if ( $manageall || $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_database' ) ) {
        ?>
        <li class="liglobal">
            <a href="index2.php?option=com_database" onmouseover="this.T_BGCOLOR='#FFFFFF'; return escape('<?php echo $adminLanguage->A_DATABASEMANDESC; ?>');">
                <img width="32" height="32" alt="" src="images/32X32/database.png" border="0" />
                <?php echo $adminLanguage->A_DATABASEMANAGER; ?>
            </a>
        </li>
        <?php 
        }

        if ( $manageall || $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_languages' ) ) {
        ?>
        <li class="liglobal">
            <a href="index2.php?option=com_languages" onmouseover="this.T_BGCOLOR='#FFFFFF'; return escape('<?php echo $adminLanguage->A_LANGMANDESC; ?>');">
                <img width="32" height="32" alt="" src="images/32X32/langmanager.png" border="0" />
                <?php echo $adminLanguage->A_MENU_LANG_MANAGE; ?>
            </a>
        </li>
        <?php 
        }

        if ( $manageall || $acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_trash' ) ) {
        ?>
        <li class="liglobal">
            <a href="index2.php?option=com_trash" onmouseover="this.T_BGCOLOR='#FFFFFF'; return escape('<?php echo $adminLanguage->A_TRASH_MANDESC; ?>');">
                <img width="32" height="32" alt="" src="images/32X32/trash.png" border="0" />
                <?php echo $adminLanguage->A_MENU_TRASH_MANAGE; ?>
            </a>
        </li>
        <?php 
        }

        if ($editall || $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'tools', 'all' )) {
        ?>
        <li class="liglobal">
            <a href="index2.php?option=com_admin&task=tools" onmouseover="this.T_BGCOLOR='#FFFFFF'; return escape('<?php echo $adminLanguage->A_TOOLSDESC; ?>');">
                <img width="32" height="32" alt="" src="images/32X32/tools.png" border="0" />
                <?php echo $adminLanguage->A_TOOLS; ?>
            </a>
        </li>
        <?php 
        }
        ?>
        <li class="liglobal">
            <a href="index2.php?option=com_admin&amp;task=help" onmouseover="this.T_BGCOLOR='#FFFFFF'; return escape('<?php echo $adminLanguage->A_HELPDESC; ?>');">
                <img width="32" height="32" alt="" src="images/32X32/support.png" border="0" />
                <?php echo $adminLanguage->A_HELP; ?>
            </a>
        </li>
        <?php 
        if (count($shortrows) >0) {
            foreach ($shortrows as $shortrow) {
                $target = (preg_match('/^(http)/i', $shortrow['link'])) ? ' target="_blank"' : '';
                echo '<li class="lipersonal">'._LEND;
                echo '<img width="16" height="16" src="images/16X16/shortcut.png" class="shortcut" />'._LEND;
                echo '<a href="'.$shortrow['link'].'"'.$target.' title="'.$shortrow['name'].'">'._LEND;
                echo '<img width="32" height="32" alt="" src="images/32X32/'.$shortrow['image'].'" border="0" />'._LEND;
                echo $shortrow['name'].'</a>'._LEND;
                echo '</li>'._LEND;
            }
        }
        ?>
    </ul>
</div>
<div style="clear:both; padding: 10px 0px 10px 0px;">
    <img alt="" src="images/16X16/shortcut.png" border="0" align="bottom" />
    <?php if (count($shortrows) >0) { ?>
        <a href="index2.php?option=com_admin&task=tools&tname=shortcuts" title="<?php echo $adminLanguage->A_MANSOCUTS; ?>"><?php echo $adminLanguage->A_MANSOCUTS; ?></a>
    <?php } else { ?>
        <a href="index2.php?option=com_admin&task=tools&tname=shortcuts&act=add" title="<?php echo $adminLanguage->ADDSOCUT; ?>"><?php echo $adminLanguage->ADDSOCUT; ?></a>
    <?php } ?>
</div>
</td>
</tr>
</table>
<script type="text/javascript" src="<?php echo $mainframe->getCfg('live_site'); ?>/administrator/includes/js/wz_tooltip<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.js"></script>
