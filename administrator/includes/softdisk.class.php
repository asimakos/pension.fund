<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: SoftDisk
* @author: Ioannis Sannos
* @link: http://www.elxis.org
* @email: datahell@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class softDisk {


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
    public function __construct() {
        global $_VERSION;
        if (($_VERSION->PRODUCT != 'E'.'l'.'x'.'i'.'s') || (!preg_match('/eLxIs/i', $_VERSION->COPYRIGHT))) { die(); } 
    }


    /*************************/
    /* GET EXISTING SECTIONS */
    /*************************/
    public function listSections() {
        global $database;
        $database->setQuery("SELECT sdsection FROM #__softdisk WHERE sdhidden='0' GROUP BY sdsection ORDER BY sdsection ASC");
        return $database->loadResultArray();
    }


    /**************************/
    /* GET VALID VALUES TYPES */
    /**************************/
    public function validTypes() {
        return array('TEXT', 'STRING', 'INTEGER', 'DECIMAL', 'YESNO', 'TIME', 'URL', 'EMAIL', 'IMAGE');
    }


    /********************************************/
    /* GET SECTION'S/VARIABLE'S TRANSLATED NAME */
    /********************************************/ 
    public function translate($v='') {
        global $adminLanguage;

        if (!defined('_ELXIS_ADMIN')) { return $v; }
        if ($v == '') { return ''; }
        $v2 = 'A_'.$v;

        if (isset($adminLanguage->$v)) {
            return $adminLanguage->$v;
        } else if (isset($adminLanguage->$v2)) {
            return $adminLanguage->$v2;
        } else {
        	$v3 = preg_replace('/^(ULIST\_)/', 'UPROF_', $v);
        	if (isset($adminLanguage->$v3)) {
            	return $adminLanguage->$v3;
            } else {
            	return $v;
            }
        }
    }


    /**************************/
    /* GET A VARIABLE'S VALUE */
    /**************************/
    public function getValue($name='') {
        global $database;
        if ($name == '') { return false; }
        $database->setQuery("SELECT sdvalue FROM #__softdisk WHERE sdname='$name'", '#__', 1, 0);
        return $database->loadResult();
    }


    /***********************/
    /* GET FORMATTED VALUE */
    /***********************/
    public function getFormatedValue($value, $type='TEXT') {
        if (($type == '') || !in_array($type, $this->validTypes())) { return $value; }
        switch($type) {
            case 'URL':
                return '<a href="'.$value.'">'.$value.'</a>';
            break;
            case 'EMAIL':
                return '<a href="mailto:'.$value.'">'.$value.'</a>';
            break;
            case 'IMAGE':
                return '<img src="'.$value.'" border="0" />';
            break;
            case 'TIME':
                return eLocale::strftime_os(_GEM_DATE_FORMLC2, $value);
            break;
            case 'YESNO':
                $r = (intval($value)) ? _GEM_YES : _GEM_NO;
                return $r;
            break;
            case 'INTEGER':
                return intval($value);
            break;
            default:
            case 'TEXT':            
            case 'STRING':
            case 'DECIMAL':   
                return $value;
            break;
        }
    }


    /**********************************************/
    /* LOAD A COMPLETE ROW WITH EITHER id OR name */
    /**********************************************/
    public function getRow($id='0', $name='') {
        global $database;

        if (intval($id) > 0) {
            $database->setQuery("SELECT * FROM #__softdisk WHERE id='$id'", '#__', 1, 0);
            return $database->loadObject($row);
        } else if ($name != '') {
            $database->setQuery("SELECT * FROM #__softdisk WHERE sdname='$name'", '#__', 1, 0);
            return $database->loadObject($row);
        } else {
            return false;
        }
    }


    /************************/
    /* FAST SOFTDISK UPDATE */
    /************************/
    public function update($name, $value) {
        global $database;
        if ($name == '') { return false; }
        $database->setQuery("UPDATE #__softdisk SET sdvalue='$value', lastmodified = '".time()."' WHERE sdname='$name'");
        $result = $database->query();
        return $result;
    }


    /*****************************/
    /* LOAD A SOFTDISK'S SECTION */
    /*****************************/
    public function loadSection($section='') {
        global $database;

        if ($section == '') { return false; }
        $database->setQuery("SELECT * FROM #__softdisk WHERE sdsection='$section' ORDER BY sdname ASC");
        return $database->loadObjectList();
    }


    /*****************************************************/
    /* VALIDATE URL (TAKEN FROM PEAR, SLIGHTLY MODIFIED) */
    /*****************************************************/
    public function validateURI($url) {
        $strict = ';/?:@$,';
        $allowed_schemes = array('http', 'https', 'ftp');
        if (preg_match(
             '&^(?:([a-z][-+.a-z0-9]*):)?                             # 1. scheme
              (?://                                                   # authority start
              (?:((?:%[0-9a-f]{2}|[-a-z0-9_.!~*\'();:\&=+$,])*)@)?    # 2. authority-userinfo
              (?:((?:[a-z0-9](?:[-a-z0-9]*[a-z0-9])?\.)*[a-z](?:[a-z0-9]+)?\.?)  # 3. authority-hostname OR
              |([0-9]{1,3}(?:\.[0-9]{1,3}){3}))                       # 4. authority-ipv4
              (?::([0-9]*))?)                                        # 5. authority-port
              ((?:/(?:%[0-9a-f]{2}|[-a-z0-9_.!~*\'():@\&=+$,;])*)*/?)? # 6. path
              (?:\?([^#]*))?                                          # 7. query
              (?:\#((?:%[0-9a-f]{2}|[-a-z0-9_.!~*\'();/?:@\&=+$,])*))? # 8. fragment
              $&xi', $url, $matches)) {
            $scheme = isset($matches[1]) ? $matches[1] : '';
            $authority = isset($matches[3]) ? $matches[3] : '' ;
            if (is_array($allowed_schemes) && !in_array($scheme,$allowed_schemes)) {
                return false;
            }
            if (!empty($matches[4])) {
                $parts = explode('.', $matches[4]);
                foreach ($parts as $part) {
                    if ($part > 255) { return false; }
                }
            }
            if ($strict) {
                $strict = '#[' . preg_quote($strict, '#') . ']#';
                if ((!empty($matches[7]) && preg_match($strict, $matches[7])) || (!empty($matches[8]) && preg_match($strict, $matches[8]))) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }


    /************************************/
    /* UPDATE SOFTDISK'S SYSTEM ENTRIES */
    /************************************/ 
    public function updateSystem() {
        global $database, $_VERSION, $mosConfig_live_site;

        /* 
        Non updatable system parameters:
        ELXIS_INSTALL, ELXIS_DBVERSION, ELXIS_LASTUP, ELXISORG_FORUM, ELXISORG_SITE
        */
        $curtime = time();
        $database->setQuery("UPDATE #__softdisk SET sdvalue='".time()."', lastmodified='".$curtime."' WHERE sdname='SOFTDISK_LASTUP' AND sdsystem='1'");
        $database->query();
        $val = strtoupper(substr(PHP_OS, 0, 3));
        $database->setQuery("UPDATE #__softdisk SET sdvalue='".$val."', lastmodified='".$curtime."' WHERE sdname='OS' AND sdsystem='1'");
        $database->query();
        $database->setQuery("UPDATE #__softdisk SET sdvalue='".php_uname()."', lastmodified='".$curtime."' WHERE sdname='OS_EXTENDED' AND sdsystem='1'");
        $database->query();
        $val = $_VERSION->RELEASE.'.'.$_VERSION->DEV_LEVEL;
        $database->setQuery("UPDATE #__softdisk SET sdvalue='".$val."', lastmodified='".$curtime."' WHERE sdname='ELXIS_VERSION' AND sdsystem='1'");
        $database->query();
	    $val = str_replace('/administrator/includes', '', str_replace( DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));
        $database->setQuery("UPDATE #__softdisk SET sdvalue='".$val."', lastmodified='".$curtime."' WHERE sdname='SITE_ABSPATH' AND sdsystem='1'");
        $database->query();
        $database->setQuery("UPDATE #__softdisk SET sdvalue='".$mosConfig_live_site."', lastmodified='".$curtime."' WHERE sdname='SITE_URL' AND sdsystem='1'");
        $database->query();
        $database->setQuery("UPDATE #__softdisk SET sdvalue='".phpversion()."', lastmodified='".$curtime."' WHERE sdname='PHP_VERSION' AND sdsystem='1'");
        $database->query();
        $database->setQuery("UPDATE #__softdisk SET sdvalue='".$database->_resource->databaseType."', lastmodified='".$curtime."' WHERE sdname='DB_TYPE' AND sdsystem='1'");
        $database->query();
        $srvinfo = $database->_resource->ServerInfo();
        $database->setQuery("UPDATE #__softdisk SET sdvalue='".$srvinfo['version']."', lastmodified='".$curtime."' WHERE sdname='DB_VERSION' AND sdsystem='1'");
        $database->query();
    }

}


/************************************/
/* PERSONAL MESSAGES DATABASE TABLE */
/************************************/
class softdiskdb extends mosDBTable {

    public $id = null;
    public $sdsection = null;
    public $valuetype = 'TEXT';
    public $sdname = null;
    public $sdvalue = null;
    public $sdsystem = '0';
    public $lastmodified = '0';
    public $nodelete = '0';
    public $sdhidden = '0';

    function __construct(&$database) {
        $this->mosDBTable('#__softdisk', 'id', $database);
        if (!$this->id) { $this->lastmodified = time(); }
    }
}

?>