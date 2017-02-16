<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: XML
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @description: Parameters handler
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class mosParameters {

	public $_params = null;
	public $_raw = null;
	public $_path = null;
	public $_type = null;
	public $_xmlElem = null;
	public $_xmlLangDir = '';


	/***************/
	/* CONSTRUCTOR */
	/***************/
	public function __construct($text, $path='', $type='component') {
	    $this->_params = $this->parse( $text );
	    $this->_raw = $text;
	    $this->_path = $path;
	    $this->_type = $type;
	}


	/**************************/
	/* SET VALUE TO PARAMETER */
	/**************************/
	public function set($key, $value='') {
		$this->_params->$key = $value;
		return $value;
	}


	/******************************************/
	/* SET DEFAULT VALUE IF NO VALUE ASSIGNED */
	/******************************************/
	public function def( $key, $value='' ) {
	    return $this->set($key, $this->get($key, $value));
	}


	/************************/
	/* GET PARAMETR'S VALUE */
	/************************/
	public function get($key, $default='') {
	    if (isset( $this->_params->$key )) {
	        return $this->_params->$key === '' ? (string)$default : (string)$this->_params->$key;
		} else {
		    return (string)$default;
		}
	}


	/******************************/
	/* PARSE .INI STRING OR ARRAY */
	/******************************/
	public function parse($txt, $process_sections = false ) {
	    if (is_string( $txt )) {
			$lines = explode("\n", $txt);
		} else if (is_array( $txt )) {
		    $lines = $txt;
		} else {
		    $lines = array();
		}
		$obj = new stdClass();

	    $sec_name = '';
	    $unparsed = 0;
	    if (!$lines) {
			return $obj;
		}
	    foreach ($lines as $line) {
	        //ignore comments
	        if ($line && $line[0] == ';') { continue; }
	        $line = eUTF::utf8_trim( $line );

	        if ($line == '') { continue; }
	        if ($line && $line[0] == '[' && $line[eUTF::utf8_strlen($line) - 1] == ']') {
	            $sec_name = eUTF::utf8_substr( $line, 1, eUTF::utf8_strlen($line) - 2 );
				if ($process_sections) {
					$obj->$sec_name = new stdClass();
	            }
	        } else {
	            if ($pos = strpos( $line, '=' )) {
	                $property = eUTF::utf8_trim( eUTF::utf8_substr( $line, 0, $pos ) );
	                if (eUTF::utf8_substr($property, 0, 1) == '"' && eUTF::utf8_substr($property, -1) == '"') {
	            		$property = stripcslashes(eUTF::utf8_substr($property,1,count($property) - 2));
	                }
	                $value = eUTF::utf8_trim( eUTF::utf8_substr( $line, $pos + 1 ) );
	                if ($value == 'false') { $value = false; }
	                if ($value == 'true') {	$value = true; }
	                if (eUTF::utf8_substr( $value, 0, 1 ) == '"' && eUTF::utf8_substr( $value, -1 ) == '"') {
	                    $value = stripcslashes( eUTF::utf8_substr( $value, 1, count( $value ) - 2 ) );
	                }

	                if ($process_sections) {
	                    if ($sec_name != '') {
      						$obj->$sec_name->$property = $value;
      					} else {
        					$obj->$property = $value;
        				}
	                } else {
						$obj->$property = $value;
	                }
	            } else {
	                if ($line && eUTF::utf8_trim($line[0]) == ';') {
						continue;
					}
	                if ($process_sections) {
	                    $property = '__invalid' . $unparsed++ . '__';
		                if ($process_sections) {
		                    if ($sec_name != '') {
	      						$obj->$sec_name->$property = eUTF::utf8_trim($line);
	      					} else {
	        					$obj->$property = eUTF::utf8_trim($line);
	        				}
		                } else {
							$obj->$property = eUTF::utf8_trim($line);
		                }
	                }
	            }
	        }
	    }
	    return $obj;
	}


	/**************************/
	/* RENDER PARAMETERS HTML */
	/**************************/
	public function render($name='params', $style=array()) {
		global $mainframe, $xmlLanguage, $_VERSION;

	    if ($this->_path) {
	        if (!is_object($this->_xmlElem)) {
	        	if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
	        	$xmlDoc = simplexml_load_file($this->_path, 'SimpleXMLElement');
	        	if ($xmlDoc) {
	        		$ok = true;
					if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
						if ($xmlDoc->getName() != 'mosinstall') { $ok = false; }
					}
					$attrs =  $xmlDoc->attributes();
					if ($attrs) {
						if (!isset($attrs['type']) || ((string)$attrs['type'] != $this->_type)) { $ok = false; }
					} else {
						$ok = false;
					}
					if ($ok) {
						if (isset($xmlDoc->params)) {
							$this->_xmlElem = $xmlDoc->params;
						}
						if (isset($xmlDoc->cxlangdir)) {
							$this->_xmlLangDir = trim((string)$xmlDoc->cxlangdir);
						}
					}
	        	}
	        	unset($xmlDoc);
			}
		}

		if ($_VERSION->PRODUCT != 'E'.'l'.'x'.'i'.'s') { die('E'.'l'.'x'.'i'.'s '.'C'.'o'.'p'.'y'.'r'.'i'.'g'.'h'.'t '.'V'.'i'.'o'.'l'.'a'.'t'.'i'.'o'.'n'); }
		if (!preg_match('/ElXiS/i', $_VERSION->COPYRIGHT)) { die('E'.'l'.'x'.'i'.'s '.'C'.'o'.'p'.'y'.'r'.'i'.'g'.'h'.'t '.'V'.'i'.'o'.'l'.'a'.'t'.'i'.'o'.'n'); }

	    if (is_object($this->_xmlElem)) {
            if ($this->_xmlLangDir != '') {
                global $alang;
                if (file_exists($mainframe->getCfg('absolute_path').$this->_xmlLangDir.'/'.$alang.'.php')) {
                    require_once($mainframe->getCfg('absolute_path').$this->_xmlLangDir.'/'.$alang.'.php');
                } else if (file_exists($mainframe->getCfg('absolute_path').$this->_xmlLangDir.'/english.php')) {
                    require_once($mainframe->getCfg('absolute_path').$this->_xmlLangDir.'/english.php');
                }
			}

			$colwidth = '';
			$tblclass = 'paramlist';
			if (is_array($style) && (count($style) > 0)) {
				if (isset($style['class']) && ($style['class'] != '')) { $tblclass = $style['class']; }
				if (isset($style['width']) && (intval($style['width']) > 0)) { $colwidth = ' width="'.intval($style['width']).'"'; }
			}

			$html = array();
			$html[] = '<table width="100%" class="'.$tblclass.'">'."\n";
			if (isset($this->_xmlElem->description)) {
				$description = (string)$this->_xmlElem->description;
				$description = $xmlLanguage->get($description);
				if ($description != '') {
			    	$html[] = '<tr><td colspan="3">'.$description.'</td></tr>';				
				}
			}

			$this->_methods = get_class_methods(get_class($this));

			if ($this->_xmlElem->param) {
				foreach ($this->_xmlElem->param as $param) {
					$result = $this->renderParam($param, $name);
					$html[] = "<tr>\n";
					$html[] = '<td valign="top"'.$colwidth.'>'.$result[0]."</td>\n";
					$html[] = '<td>'.$result[1]."</td>\n";
					$html[] = '<td width="10%" valign="top">'.$result[2]."</td>";
					$html[] = "</tr>\n";
				}
			} else {
				$html[] = '<tr><td colspan="3"><em>'._GEM_NO_PARAMS."</em></td></tr>\n";
			}
			$html[] = '</table>';
			return implode( "\n", $html );
		} else {
			return '<textarea name="'.$name.'" cols="40" dir="ltr" rows="10" class="text_area">'.$this->_raw.'</textarea>';
		}
	}


	/********************/
	/* RENDER PARAMETER */
	/********************/
	public function renderParam($param, $control_name='params') {
	    global $xmlLanguage;

	    $result = array();
		$attrs = $param->attributes();
		$name = isset($attrs['name']) ? (string)$attrs['name'] : '';
		$label = $xmlLanguage->get((string)$attrs['label']);
		$def_value = $xmlLanguage->get((string)$attrs['default']);
		$value = $this->get($name, $def_value);
		$description = isset($attrs['description']) ? $xmlLanguage->get((string)$attrs['description']) : '';
		$type = (string)$attrs['type'];

		$result[0] = ($label != '')  ? $label : $name;
		if ($result[0] == '@spacer') {
			$result[0] = '<hr />';
		} else if ($result[0]) {
			$result[0] .= ':';
		}

		if (in_array('_form_'.$type, $this->_methods)) {
			$result[1] = call_user_func(array($this, '_form_'.$type), $name, $value, $param, $control_name);
		} else {
		    //$result[1] = _HANDLER.' = '.$type;
		    $result[1] = call_user_func(array($this, '_form_text'), $name, $value, $param, $control_name);
		}

		if ($description != '') {
			$result[2] = mosToolTip($description, $name);
		} else {
			$result[2] = '';
		}
		return $result;
	}


	/*******************/
	/* MAKE TEXT FIELD */
	/*******************/
	private function _form_text($name, $value, $node, $control_name) {
		$attrs = $node->attributes();		
		$size = isset($attrs['size']) ? (int)$attrs['size'] : 20;
		$direction = '';
		if (defined('_GEM_RTL') && (_GEM_RTL == 1)) {
			if (isset($attrs['dir']) && (strtolower((string)$attrs['dir']) == 'rtl')) {
				$direction = ' dir="rtl"';
			} else {
				$direction = ' dir="ltr"';
			}
		}
		return '<input type="text"'.$direction.' name="'.$control_name.'['.$name.']" value="'.$value.'" class="inputbox" size="'.$size.'" />';
	}


	/**************************/
	/* MAKE SELECT LIST FIELD */
	/**************************/
	private function _form_list($name, $value, $node, $control_name) {
	    global $xmlLanguage;
		
		$attrs = $node->attributes();
		$size = isset($attrs['size']) ? (int)$attrs['size'] : 20;
		$direction = '';
		if (defined('_GEM_RTL') && (_GEM_RTL == 1)) {
			if (isset($attrs['dir']) && (strtolower((string)$attrs['dir']) == 'rtl')) {
				$direction = ' dir="rtl"';
			} else {
				$direction = ' dir="ltr"';
			}
		}

		$options = array();
		$children = $node->children();
		if ($children) {
			foreach ($children as $child) {
				$attr2 = $child->attributes();
				$val = isset($attr2['value']) ? (string)$attr2['value'] : '';
				$ctxt = (string)$child[0];
				$text = $xmlLanguage->get($ctxt);
				$options[] = mosHTML::makeOption($val, $text);
			}
		}

		return mosHTML::selectList($options, ''.$control_name.'['.$name.']', 'class="selectbox"'.$direction, 'value', 'text', $value);
	}


	/*************************/
	/* MAKE RADIO BOX FIELDS */
	/*************************/
	private function _form_radio($name, $value, $node, $control_name) {
	    global $xmlLanguage;

		$options = array();
		$children = $node->children();
		if ($children) {
			foreach ($children as $child) {
				$attr2 = $child->attributes();
				$val = isset($attr2['value']) ? (string)$attr2['value'] : '';
				$ctxt = (string)$child[0];
				$text = $xmlLanguage->get($ctxt);
				$options[] = mosHTML::makeOption($val, $text, true);
			}
		}

		return mosHTML::radioList( $options, ''. $control_name .'['. $name .']', '', $value );
	}


	/****************************/
	/* MAKE SECTION SELECT LIST */
	/****************************/
	private function _form_mos_section( $name, $value, $node, $control_name ) {
		global $database, $adminLanguage;

		$query = "SELECT id AS value, title AS text FROM #__sections"
		."\n WHERE published='1' AND scope='content' ORDER BY title";
		$database->setQuery( $query );
		$options = $database->loadObjectList();
		array_unshift($options, mosHTML::makeOption('0', $adminLanguage->A_SELCOSECT));

		$direction = '';
		if (defined('_GEM_RTL') && (_GEM_RTL == 1)) {
			$direction = ' dir="rtl"';
		}

		return mosHTML::selectList( $options, ''. $control_name .'['. $name .']', 'class="selectbox"'.$direction, 'value', 'text', $value );
	}


	/*****************************/
	/* MAKE CATEGORY SELECT LIST */
	/*****************************/
	private function _form_mos_category( $name, $value, $node, $control_name ) {
		global $database, $adminLanguage;

        $query 	= "SELECT c.id AS value, ".$database->_resource->Concat( 's.title', "' / '", 'c.title' )." AS text"
		. "\n FROM #__categories c"
		. "\n LEFT JOIN #__sections s ON s.id=c.section"
		. "\n WHERE c.published='1' AND s.scope='content'"
		. "\n ORDER BY c.title";
		$database->setQuery( $query );
		$options = $database->loadObjectList();
		array_unshift( $options, mosHTML::makeOption( '0', $adminLanguage->A_SELCOCAT ) );

		$direction = '';
		if (defined('_GEM_RTL') && (_GEM_RTL == 1)) {
			$direction = ' dir="rtl"';
		}

		return mosHTML::selectList( $options, ''. $control_name .'['. $name .']', 'class="selectbox"'.$direction, 'value', 'text', $value );
	}


	/*************************/
	/* MAKE MENU SELECT LIST */
	/*************************/
	private function _form_mos_menu( $name, $value, $node, $control_name ) {
		global $database, $adminLanguage;

		$menuTypes = mosAdminMenus::menutypes();
		
		foreach($menuTypes as $menutype ) {
			$options[] = mosHTML::makeOption( $menutype, $menutype );
		}
		array_unshift( $options, mosHTML::makeOption( '', $adminLanguage->A_SELMENU ) );

		$direction = '';
		if (defined('_GEM_RTL') && (_GEM_RTL == 1)) {
			$direction = ' dir="rtl"';
		}

		return mosHTML::selectList( $options, ''.$control_name.'['.$name.']', 'class="selectbox"'.$direction, 'value', 'text', $value );
	}


	/***************************/
	/* MAKE IMAGES SELECT LIST */
	/***************************/
	private function _form_imagelist($name, $value, $node, $control_name) {
		global $mainframe, $fmanager, $adminLanguage;

		$attrs = $node->attributes();
		$path = $mainframe->getCfg('absolute_path').$attrs['directory'];
		$files = $fmanager->listFiles($path, '\.png$|\.gif$|\.jpg$|\.jpeg$|\.bmp$|\.ico$');

		$options = array();
		if ($files && (count($files) > 0)) {
			foreach ($files as $file) {
				$options[] = mosHTML::makeOption( $file, $file );
			}
		}

		$hide_none = isset($attrs['hide_none']) ? (int)$attrs['hide_none'] : 0;
		$hide_default = isset($attrs['hide_default']) ? (int)$attrs['hide_default'] : 0;
		if (!$hide_none) {
			array_unshift( $options, mosHTML::makeOption('-1', $adminLanguage->A_NOTUSEIMAG));
		}
		if (!$hide_default) {
			array_unshift( $options, mosHTML::makeOption('', $adminLanguage->A_USEDEFIMAG));
		}
		return mosHTML::selectList( $options, ''.$control_name.'['.$name.']', 'class="selectbox" dir="ltr"', 'value', 'text', $value );
	}


	/***************************************************/
	/* GENERATE A SELECTION LIST FROM A DATABASE QUERY */
	/***************************************************/
	private function _form_database($name, $value, $node, $control_name) {
		global $database;

		$attrs = $node->attributes();
		if (!isset($attrs['query'])) {
			return '<input type="text" name="'.$control_name.'['.$name.']" value="'.$value.'" class="inputbox" />';
		}

		$parts = preg_split('/\:/', (string)$attrs['query']);
		/* [0]table:[1]col_value:[2]col_title:[3]where */
		if (!$parts || (count($parts) < 2)) {
			return '<input type="text" name="'.$control_name.'['.$name.']" value="'.$value.'" class="inputbox" />';
		}
		if ($parts[0] == '') {
			return '<input type="text" name="'.$control_name.'['.$name.']" value="'.$value.'" class="inputbox" />';
		}

		$table = $parts[0];
		$prfxtable = $database->_table_prefix.$table;
		$elxtables = $database->_resource->MetaTables('TABLES');
		if (!in_array($prfxtable, $elxtables)) {
			return '<input type="text" name="'.$control_name.'['.$name.']" value="'.$value.'" class="inputbox" />';
		}
		if ($parts[1] == '') {
			return '<input type="text" name="'.$control_name.'['.$name.']" value="'.$value.'" class="inputbox" />';
		}
		//$cols = $database->_resource->MetaColumns($prfxtable); //dont check columns existence...
		$column1 = $parts[1];
		if (isset($parts[2]) && (trim($parts[2]) != '')) {
			if (preg_match('#\,#', $parts[2])) { //concat (column,selerator,column)
				$cparts = preg_split('#\,#', trim($parts[2]), 3, PREG_SPLIT_NO_EMPTY);
				if ($cparts && (count($cparts) == 3)) {
					$column2 = $database->_resource->Concat(''.$cparts[0].'',"'".$cparts[1]."'", ''.$cparts[2].'');
				} else {
					return '<input type="text" name="'.$control_name.'['.$name.']" value="'.$value.'" class="inputbox" />';
				}
			} else {
				$column2 = trim($parts[2]);
			}
		} else {
			$column2 = $parts[1];
		}

		$query = "SELECT ".$column1." AS elxv, ".$column2." AS elxt FROM #__".$table;
		if (isset($parts[3]) && (trim($parts[3]) != '')) {
			$query .= ' WHERE '.trim($parts[3]);
		}
		if (isset($attrs['groupby']) && (trim($attrs['groupby']) != '')) {
			$query .= ' GROUP BY '.trim($attrs['groupby']);
		}
		if (isset($attrs['orderby']) && (trim($attrs['orderby']) != '')) {
			$query .= ' ORDER BY '.trim($attrs['orderby']);
		}
		if (isset($attrs['limit']) && (intval($attrs['limit']) > 0)) {
			$database->setQuery($query, '#__', intval($attrs['limit']), 0);
		} else {
			$database->setQuery($query);
		}
		$rows = $database->loadRowList();
		$options = array();
		if ($rows) {
			foreach ($rows as $row) {
				$options[] = mosHTML::makeOption($row['elxv'], $row['elxt']);
			}
		}
		return mosHTML::selectList($options, ''.$control_name.'['.$name.']', 'class="selectbox" dir="ltr"', 'value', 'text', $value);
	}


	/***************************/
	/* MAKE FOLDER SELECT LIST */
	/***************************/
	private function _form_folderlist($name, $value, $node, $control_name) {
		global $mainframe, $fmanager;

		$attrs = $node->attributes();
		$dir = str_replace(DIRECTORY_SEPARATOR, '/', (string)$attrs['directory']);
		$dir = preg_replace('/^(\/)/', '', $dir);
		$dir = preg_replace('/(\/)$/', '', $dir);
		$options = array();
		$options[] = mosHTML::makeOption('', '- Select -');
		if ($dir != '') {
			$path = $mainframe->getCfg('absolute_path').'/'.$dir.'/';
			if (file_exists($path) && is_dir($path)) {
				$folders = $fmanager->listFolders($path);
				if ($folders && (count($folders) > 0)) {
					foreach ($folders as $folder) {
						$options[] = mosHTML::makeOption($folder, $folder);
					}
				}			
			}
		}
		return mosHTML::selectList($options, ''.$control_name.'['.$name.']', 'class="selectbox" dir="ltr"', 'value', 'text', $value);
	}


	/***********************/
	/* MAKE TEXTAREA FIELD */
	/***********************/
	private function _form_textarea($name, $value, $node, $control_name) {
		$attrs = $node->attributes();
		$rows = isset($attrs['rows']) ? (int)$attrs['rows'] : 6;
		$cols = isset($attrs['cols']) ? (int)$attrs['cols'] : 40;
 		$value = eUTF::utf8_str_replace('<br />', "\n", $value);
		$direction = '';
		if (defined('_GEM_RTL') && (_GEM_RTL == 1)) {
			if (isset($attrs['dir']) && (strtolower((string)$attrs['dir']) == 'rtl')) {
				$direction = ' dir="rtl"';
			} else {
				$direction = ' dir="ltr"';
			}
		}

 		return '<textarea name="params['.$name.']"'.$direction.' cols="'.$cols.'" rows="'.$rows.'" class="text_area">'.$value.'</textarea>';
	}


	/***************/
	/* MAKE SPACER */
	/***************/
	private function _form_spacer( $name, $value, $node, $control_name ) {
		if ( $value ) {
			return '<strong>'.$value.'</strong>';
		} else {
			return '<hr />';
		}
	}


	/****************************/
	/* TEXTAREA SPECIAL HANDLER */
	/****************************/
	static public function textareaHandling($txt) {
		$total = count( $txt );
		for( $i=0; $i < $total; $i++ ) {
			if ( strstr( $txt[$i], "\n" ) ) {
				$txt[$i] = eUTF::utf8_str_replace( "\n", '<br />', $txt[$i] );
			}
		}
		$txt = implode( "\n", $txt );
		return $txt;
	}
}


/********************/
/* PARSE PARAMETERS */
/********************/
function mosParseParams($txt) {
	$mp = new mosParameters($txt);
	return $mp->_params;
	//return mosParameters::parse( $txt );
}


function walkNodesAndReturnMosNodeList(&$nodeList, &$contextNode) { //NOT USED!
	//STEP 1: DO SOME ERROR CHECKING (this can be omitted if you want to optimize, but isn't as safe)
	//ensure that node is not null
	if (!isset( $contextNode )) { return; }

	//ensure that node is a DOMIT element
	if (eUTF::utf8_strtolower( get_class( $contextNode ) ) != 'domit_element') {
		//if contextNode is a DOMIT Document, grab the documentElement
		if (eUTF::utf8_strtolower( get_class( $contextNode ) ) == 'domit_document') {
			$contextNode =& $contextNode->documentElement;
			if (!isset( $contextNode )) { return; }
		} else {
			return;
		}
	}

	//STEP 2: EVALUATE THE CONTEXT NODE BASED ON SOME CRITERIA
	//determine whether the context node should be added to the master nodeList
	if ((eUTF::utf8_strlen( $contextNode->nodeName ) > 3) && (eUTF::utf8_substr( $contextNode->nodeName, 0, 4 ) == "mos:")) {
		$nodeList->appendNode($contextNode);
	}

	//STEP 3: ITERATE THROUGH THE CONTEXT NODE CHILDREN AND
	//RECURSIVELY CALL THIS FUNCTION WITH THE CHILD AS THE CONTEXT NODE
	$total = $contextNode->childCount;

	for ($i = 0; $i < $total; $i++) {
		walkNodesAndReturnMosNodeList($nodeList, $contextNode->childNodes[$i]);
	}
}

/*
	You'd call the function like this:
	$myNodeList =& new DOMIT_NodeList();
	walkNodesAndReturnMosNodeList($myNodeList, $someXMLDoc);
*/

class mosEmpty {
	public function def( $key, $value='' ) { return 1; }
	public function get( $key, $default='' ) { return 1; }
}

?>
