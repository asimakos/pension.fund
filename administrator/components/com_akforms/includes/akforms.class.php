<?php
/**
* @version: 1.5
* @package: Component AkForms
* @author: Andrew Campoball
* @email: ACampball@yandex.ru
* @link:
* @license: GPL
* @copyright: (C) 2009 Andrew Campball. All rights reserved.
* @description: AkForms component for Elxis CMS.
*****************************************************************************/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


global $_VERSION;
if (($_VERSION->RELEASE == '2008') && ($_VERSION->DEV_LEVEL == '0')) {
	global $mainframe, $mosConfig_offset;
	$mainframe->_config->offset = $mosConfig_offset;
}

class AkFormClass {

	public $version = '1.7';
	public $upath = '';
	public $path = '';
	public $apath = '';
	public $url = '';
	public $aurl = '';
	public $lng; //language object
	public $cfg; //config object
	public $ftypes = array();
	public $bot_installed = false;


	/********************/
	/* MAGIC CONTRUCTOR */
	/********************/
	public function __construct() {
		global $mainframe, $database, $my;

		$this->upath = '/components/com_akforms';
		$this->path = $mainframe->getCfg('absolute_path').'/components/com_akforms';
		$this->apath = $mainframe->getCfg('absolute_path').'/administrator/components/com_akforms';

        require_once($this->apath.'/config.akforms.php');
		$this->cfg = new akFormsConfig();

		$this->url = $this->secureURL($mainframe->getCfg('live_site').'/components/com_akforms');
		$this->aurl = $this->secureURL($mainframe->getCfg('live_site').'/administrator/components/com_akforms');

		$slang = defined('_ELXIS_ADMIN') ? $GLOBALS['alang'] : $GLOBALS['lang'];
		$dlang = defined('_ELXIS_ADMIN') ? $mainframe->getCfg('alang') : $mainframe->getCfg('lang');
		if (file_exists($this->apath.'/language/'.$slang.'.php')) {
			require_once($this->apath.'/language/'.$slang.'.php');
		} else if (file_exists($this->apath.'/language/'.$dlang.'.php')) {
			require_once($this->apath.'/language/'.$dlang.'.php');
		} else {
			require_once($this->apath.'/language/russian.php');
		}
		$this->lng = new akFormLanguage();

		$this->bot_installed = file_exists($mainframe->getCfg('absolute_path').'/mambots/content/akforms.php');

		/* Списки */
		$this->ftypes[] = 'label';
		$this->ftypes[] = 'input';
		$this->ftypes[] = 'radio';
		$this->ftypes[] = 'select';
		$this->ftypes[] = 'valselect';
		$this->ftypes[] = 'checkbox';
		$this->ftypes[] = 'text';
		$this->ftypes[] = 'file';
		$this->ftypes[] = 'hidden';
		$this->ftypes[] = 'textarea';
		$this->ftypes[] = 'sql';
		$this->ftypes[] = 'email';
		$this->ftypes[] = 'date';
		$this->ftypes[] = 'table';
		$this->ftypes[] = 'time';
		$this->ftypes[] = 'page_break';

	}

	/********************/
	/* MAKE STRING SAFE */
	/********************/
	public function makesafe($string='', $strict=1) {
		if ($string == '') { return $string; }
		if ($strict) {
			$pat = "([\']|[\!]|[\(]|[\)]|[\;]|[\"]|[\$]|[\#]|[\<]|[\>]|[\*]|[\%]|[\~]|[\`]|[\^]|[\|]|[\{]|[\}]|[\\\])";
		} else {
			$pat = "([\']|[\"]|[\$]|[\#]|[\<]|[\>]|[\*]|[\%]|[\~]|[\`]|[\^]|[\|]|[\{]|[\}]|[\\\])";
		}
		$s = eUTF::utf8_trim(preg_replace($pat, '', $string));
		return $s;
	}

	public function bindObject($sObj, &$dObj, $ignore='') {
		foreach (get_object_vars($dObj) as $k => $v) {
			if( substr( $k, 0, 1 ) != '_' ) {			// internal attributes of an object are ignored
				if (strpos( $ignore, $k) === false) {
					$ak = $k;
				}
				if (isset($sObj->$ak)) {
					$dObj->$k = (string)$sObj->$ak;
				}
			}
		}
	}

	public function sortIcon( $base_href, $field ) {
		global $mainframe;

		$alts = array('none' => _GEM_SORT_NONE, 'asc' => _GEM_SORT_ASC, 'desc' => _GEM_SORT_DESC);

		$state = 'asc';
		$html = '<a href="'.$base_href.'&amp;field='.$field.'&amp;order='.$state.'" title="'.$alts[$state].'">';
		$html .= '<img src="'.$this->aurl.'/images/sort_'.$state.'.png" border="0" alt="'.$alts[$state].'" />';
		$html .= '</a>';
		$state = 'desc';
		$html .= '<a href="'.$base_href.'&amp;field='.$field.'&amp;order='.$state.'" title="'.$alts[$state].'">';
		$html .= '<img src="'.$this->aurl.'/images/sort_'.$state.'.png" border="0" alt="'.$alts[$state].'" />';
		$html .= '</a>';
		return $html;
	}

	public function getNumList( $name, $start=0, $end=6, $selected=0 ) {
		$items = array();
		for ($x=$start; $x<$end; $x++) {
			$items[] = mosHTML::MakeOption($x, $x);
		}

		return mosHTML::selectList($items, $name, 'class="selectbox" size="1"', 'value', 'text', $selected);
	}

	public function columnLabel2Index($str) {
		$index = 0;
		for ($x=0; $x<strlen($str); $x++) {
			$digit = Ord($str[$x]) - 65;
			$index = ($index*26) + $digit;
		}
		return $index;
	}

	public function columnLabel2String($index) {
		$c = array();
		$b = strtoupper(base_convert($index, 10, 26));
		for ($i=0; $i<strlen($b); $i++) {
			$x = Ord($b[$i]);
			if ($i <= 0 && strlen($b) > 1) {
				$x--;
			}
			if ($x <= 57) {
				$c[] = Chr($x - 48 + 65);
			} else {
				$c[] =Chr($x + 10);
			}
		}

		return implode('', $c);
	}

	public function getTranslation($ref_id, $ref_type) {
		global $database;

		$database->setQuery('SELECT * FROM #__akforms_langs WHERE ref_id='.intval($ref_id).' AND ref_type="'.$ref_type.'"');
		return $database->loadObjectList('language');
	}

	/****************/
	/* SSL SWITCHER */
	/****************/
	public function secureURL($link='', $force=false) {
		if ($force === false) {
			if (!$this->cfg->get('SSL', 0)) { return $link; }
		}
		return preg_replace('/^(http\:)/i', 'https:', $link);
	}

	/*****************************************/
	/* CHECK IF A PAGE WAS REQUESTED VIA SSL */
	/*****************************************/
	public function detectSSL() {
		if (isset($_SERVER['HTTPS'])) {
			if (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == 1)) { return true; }
		}
		if (isset($_SERVER['SERVER_PORT']) && ($_SERVER['SERVER_PORT'] == 443)) { return true; }
		return false;
	}

}

/* FROM DATABASE CLASS */
class formdb extends mosDBTable {

	public $id = null;
	public $name = null;
	public $emails = null;
	public $description = null;
	public $params = null;
	public $css_text = null;
	public $captcha = 1;
	public $published = 1;
	public $mail_subject = null;
	public $send_copy = 0;
	public $onsuccess = null;
	public $text_button = null;
	public $pre_copy_text = null;
	public $save_post_data = 0;
	public $allow_save_form = 0;
	public $allow_see_savedata = 0;
	public $allow_see_senddata = 0;
	public $allow_submit_repeatly = 1;

	public function __construct(&$_db) {
		$this->mosDBTable('#__akforms', 'id', $_db);
	}
}

/* FORM ITEMS DATABASE CLASS */
class formitemdb extends mosDBTable {

	public $id = null;
	public $form_id = null;
	public $field_type = null;
	public $field_value = null;
	public $field_list = null;
	public $isnotnull = 0;
	public $field_class = null;
	public $field_style = null;
	public $line_height = null;
	public $field_label	= null;
	public $ordering = 9999;
	public $ishide = 0;
	public $published = 1;
	public $maxlength = null;
	public $readonly = 0;
	public $hidelabel = 0;
	public $description = null;
	public $access = 29;
	public $where_include = 0;
	public $field_group = null;
	public $language = null;

	public function __construct(&$_db) {
		$this->mosDBTable('#__akform_items', 'id', $_db);
	}
}

/* FORM VALUES DATABASE CLASS */
class formvaldb extends mosDBTable {

	public $id = null;
	public $field_id = null;
	public $value = null;
	public $post_date = null;
	public $user_id = null;
	public $unic = null;
	public $isread = 0;
	public $istemp = 0;
	public $expire = null;

	public function __construct(&$_db) {
		$this->mosDBTable('#__akform_values', 'id', $_db);
	}
}

/* FORM GROUPS DATABASE CLASS */
class formgroupdb extends mosDBTable {

	public $id = null;
	public $form_id = null;
	public $title = null;
	public $title_in_value = null;
	public $filter_in_value = null;

	public function __construct(&$_db) {
		$this->mosDBTable('#__akforms_groups', 'id', $_db);
	}
}

?>