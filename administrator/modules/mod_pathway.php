<?php 
/**
* @version: $Id: mod_pathway.php 28 2010-06-02 20:39:33Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Module Pathway
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info [AT] elxis [DOT] org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminPathway {

    private $option = '';
    private $task = '';
    private $opt = '';
    private $tsk = '';


    /***************/
    /* CONSTRUCTOR */
    /***************/
    public function __construct() {
        global $option, $task;

        $this->option = $option;
        $this->task = $task;
        $this->tsk = $this->task;
        if (($option != '') && (!preg_match('/^(com\_)/', $option))) {
            $this->option = 'com_'.$option;
        }
    }


    /********************/
    /* GENERATE PATHWAY */
    /********************/
    public function genPathway() {
        global $adminLanguage;

        if ($this->option == '') {
            $this->echoPathway($adminLanguage->A_MENU_HOME);
            return;
        } 

        $this->comName();
        $this->taskName();
        $extra = '';

        $showLinks = 1;
        if ($this->task != '') {
        	$noLinkArr = array('add', 'edit', 'edita', 'config', 'editextra', 'new', 'addx', 'newx', 'editx', 'edit_source', 'edit_css');
        	$showLinks = in_array(strtolower($this->task), $noLinkArr) ? 0 : 1;
        }
        if ($this->option == 'com_config') {
			$showLinks = 0;
		}
        if ($this->task != '') {
            if (($this->option == 'com_admin') && ($this->task == 'tools')) {
                $extra .= '<a href="index2.php?option='.$this->option.'&task=tools">'.$this->opt.'</a>';
            } else if (($this->option == 'com_admin') && ($this->task == 'help')) {
                $extra .= '<a href="index2.php?option='.$this->option.'&task=help">'.$this->opt.'</a>';
            } else if (($this->option == 'com_admin') && ($this->task == 'sysinfo')) {
                $extra .= '<a href="index2.php?option='.$this->option.'&task=sysinfo">'.$this->opt.'</a>';
            } else if (($this->option == 'com_installer') && ($this->task == 'updates')) {
                $extra .= $this->opt.' &raquo; '.$adminLanguage->A_CHK_UPDATES;
			} else if ($showLinks) {
                $extra .= '<a href="index2.php?option='.$this->option.'">'.$this->opt.'</a>';
            } else {
                $extra .= $this->opt;
            }
		} else if ($this->option == 'com_config') {
            $extra .= $this->opt;
		} else {
            $extra .= '<a href="index2.php?option='.$this->option.'">'.$this->opt.'</a>';
        }

        if ($this->tsk != '') {
            $extra .= ' &raquo; '.$this->tsk;
        }

        $this->echoPathway($extra, $showLinks);
    }


    /****************/
    /* ECHO PATHWAY */
    /****************/
    private function echoPathway($extra='', $showLinks=1) {
        global $mosConfig_live_site, $adminLanguage;

        $html = '<div class="pathway">'._LEND;
        if ($showLinks) {
        	$html .= '<a href="'.$mosConfig_live_site .'/administrator/index2.php" title="Elxis '.$adminLanguage->A_ADMINISTRATION.'" target="_self">';
        }
		$html .= '<img src="images/elxis16.png" border="0" align="absmiddle" alt="Elxis CMS" />';
		$html .= ($showLinks) ? '</a> '._LEND : ' '._LEND;
        $html .= $extra;
        $html .= '</div>'._LEND;
        echo $html;
    }


    /**********************/
    /* GET COMPONENT NAME */
    /**********************/
    private function comName() {
        global $adminLanguage;

        $comps = array(
            'com_access' => $adminLanguage->A_MENU_ACCSMANG,
            'com_admin' => $adminLanguage->A_MENU_HOME,
            'com_bridge' => $adminLanguage->A_BRIDGES,
            'com_categories' => $adminLanguage->A_CATEGORYMANAGER,
            'com_checkin' => $adminLanguage->A_MENU_GLOBAL_CHECK,
            'com_config' => $adminLanguage->A_MENU_GC,
            'com_contact' => $adminLanguage->A_MENU_MANAGE_CONTACTS,
            'com_content' => $adminLanguage->A_MENU_CONTENT_MANAGE,
            'com_database' => $adminLanguage->A_DATABASEMANAGER,
            'com_edir' => 'Elxis Directory',
            'com_frontpage' => $adminLanguage->A_MENU_ITEMS_FRONT,
            'com_fserver' => 'File Server',
            'com_hotproperty' => 'Hot Property',
            'com_hp_avl' => 'HP Availability',
            'com_installer' => $adminLanguage->A_MENU_INSTALLERS,
            'com_languages' => $adminLanguage->A_MENU_LANG_MANAGE,
            'com_mambots' => $adminLanguage->A_MENU_MAMBOT_MANAGMENT,
            'com_massmail' => $adminLanguage->A_MENU_MASS_MAIL,
            'com_media' => $adminLanguage->A_MENU_MEDIA_MANAGE,
            'com_menumanager' => $adminLanguage->A_MENU_MANAGER,
            'com_menus' => $adminLanguage->A_MENU_MANAGER,
            'com_messages' => $adminLanguage->A_MENU_MESSAGES,
            'com_modules' => $adminLanguage->A_MENU_MODULE_MANAGMENT,
            'com_mtree' => 'Mosets Tree',
            'com_newsfeeds' => $adminLanguage->A_NEWSFEEDS,
            'com_poll' => $adminLanguage->A_POLL_MANAGER,
            'com_sections' => $adminLanguage->A_SECTIONMANAGER,
            'com_softdisk' => $adminLanguage->SOFTDISK,
            'com_stargallery' => 'Star Gallery',
            'com_statistics' => $adminLanguage->A_MENU_STATISTICS,
            'com_templates' => $adminLanguage->A_MENU_TEMP_MANAGE,
            'com_trash' => $adminLanguage->A_MENU_TRASH_MANAGE,
            'com_typedcontent' => $adminLanguage->A_STATICONTMANAGER,
            'com_users' => $adminLanguage->A_MENU_USER_MANAGE,
            'com_weblinks' => $adminLanguage->A_LINKS,
            'com_eblog' => $adminLanguage->A_ELXISBLOG,
            'com_eshop' => $adminLanguage->A_C_SHOPPINGCART,
            'com_newsletter' => $adminLanguage->A_C_NEWSLETTER,
            'com_downloads' => $adminLanguage->A_C_DOWNLOADS,
            'com_gallery' => $adminLanguage->A_C_GALLERY,
            'com_eforum' => 'Elxis forum',
            'com_reservations' => 'IOS Reservations'
        );

        if (isset($comps[$this->option])) {
            $this->opt = $comps[$this->option];
        } else {
            $this->opt = preg_replace('/^(com\_)/', '', $this->option);
            return;
        }

        $eComps = array('com_admin', 'com_content', 'com_installer', 'com_templates', 'com_modules');
        if (in_array($this->option, $eComps)) {
            $this->comExtra();
        }
    }


    /*******************************/
    /* SEARCH COMPONENT EXTRA INFO */
    /*******************************/
    private function comExtra() {
        global $adminLanguage;

        $element = mosGetParam($_REQUEST, 'element', '');
        $client = mosGetParam($_REQUEST, 'client', '');
        switch ($this->option) {
            case 'com_admin':
                switch ($this->task) {
                    case 'help':
                        $this->opt = $adminLanguage->A_HELP;
                        $this->tsk = '';
                    break;
                    case 'sysinfo':
                        $this->opt = $adminLanguage->A_MENU_SYSTEM_INFO;
                        $this->tsk = '';
                    break;
                    case 'tools':
                        $this->opt = $adminLanguage->A_TOOLS;
                        $this->tsk = mosGetParam($_REQUEST, 'tname', '');
                    break;
                }
            break;
            case 'com_content':
                switch ($this->task) {
                    case 'showarchive';
                        $this->opt = $adminLanguage->A_MENU_ARCHIVE_MANAGE;
                        $this->tsk = '';
                    break;
                }
            break;
            case 'com_installer':
                switch ($element) {
                    case 'language':
                        if ($client == 'admin') {
                            $this->tsk = $adminLanguage->A_MENU_ADMINLANGS;
                        } else {
                            $this->tsk = $adminLanguage->A_MENU_SITELANS;
                        }
                    break;
                    case 'module':
                        $this->tsk = $adminLanguage->A_MENU_MODULES;
                    break;
                    case 'mambot':
                        $this->tsk = $adminLanguage->A_MENU_MAMBOTS;
                    break;
                    case 'component':
                        $this->tsk = $adminLanguage->A_MENU_COMPONENTS;
                    break;
                    case 'bridge':
                        $this->tsk = $adminLanguage->A_BRIDGES;
                    break;
                    case 'template':
                        if ($client == 'admin') {
                            $this->tsk = $adminLanguage->A_MENU_ADMIN_TEMP;
                        } else if ($client == 'login') {
                            $this->tsk = $adminLanguage->A_MENU_LOGIN_SCREENS;
                        } else {
                            $this->tsk = $adminLanguage->A_MENU_SITE_TEMP;
                        }
                    break;
                }
            break;
            case 'com_templates':
                if ($client == 'admin') {
                    $this->tsk = $adminLanguage->A_ADMINISTRATION;
                } else {
                    $this->tsk = $adminLanguage->A_SITE;
                }
            break;
            case 'com_modules':
                if ($client == 'admin') {
                    $this->tsk = $adminLanguage->A_ADMINISTRATION;
                } else {
                    $this->tsk = $adminLanguage->A_SITE;
                }
            break;
        }
    }


    /*****************/
    /* GET TASK NAME */
    /*****************/
    private function taskName() {
        global $adminLanguage;

        switch ($this->task) {
            case 'add':
                $this->tsk = $adminLanguage->A_ADD;
            break;
            case 'new':
                $this->tsk = $adminLanguage->A_NEW;
            break;
            case 'config':
                $this->tsk = $adminLanguage->A_MENU_CONFIGURATION;
            break;
            case 'editA':
            case 'edit':
                $this->tsk = $adminLanguage->A_EDIT;
            break;
            case 'edit_css':
                $this->tsk = $adminLanguage->A_EDIT.' CSS';
            break;
            case 'edit_html':
            case 'edit_source':
                $this->tsk = $adminLanguage->A_EDIT.' HTML';
            break;
            case 'save':
                $this->tsk = $adminLanguage->A_SAVE;
            break;
            case 'apply':
                $this->tsk = $adminLanguage->A_APPLY;
            break;
            case 'delete':
            case 'remove':
                $this->tsk = $adminLanguage->A_DELETE;
            break;
            case 'translate':
                $this->tsk = $adminLanguage->A_TRANSLATE;
            break;
            case 'cancel':
                $this->tsk = $adminLanguage->A_CANCEL;
            break;
            case 'publish':
                $this->tsk = $adminLanguage->A_PUBLISH;
            break;
            case 'tools':
                $tname = mosGetParam($_REQUEST, 'tname', '');
                $k = strtoupper($tname);
                $k2 = 'A_'.$k;
                if (isset($adminLanguage->$k)) {
                    $this->tsk = $adminLanguage->$k;
                } else if (isset($adminLanguage->$k2)) {
                    $this->tsk = $adminLanguage->$k2;
                } else {
                    $this->tsk = $tname;
                }
            break;
            //default:
            //    $this->tsk = $this->task;
            //break;
        }
    }

}

$apath = new adminPathway();
$apath->genPathway();

unset($apath);

?>