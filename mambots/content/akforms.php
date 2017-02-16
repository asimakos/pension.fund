<?php
/**
* @version: 1.7
* @copyright: Copyright (C) 2010 Andrew Campball. All rights reserved.
* @package: Elxis
* @subpackage: Bots/Content
* @author: Andrew Campball
* @email: ACampball@yandex.ru
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Displays forms in content
* @usage:
* Default values: {akforms}CID form{/akforms}
* @examples:
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onPrepareContent', 'botAkForms' );

global $mainframe;

/**************/
/* AkShowReg BOT */
/**************/
function botAkForms( $published, &$row, $params, $page=0 ) {
	global $database, $_MAMBOTS, $mainframe;

	//check if we need to proceed further
	if ( strpos( $row->text, 'akforms' ) === false ) { return true; }

    $regex = "#{akforms\s*.*?}(.*?){/akforms}#s";

    if (!$published || !file_exists($mainframe->getCfg('absolute_path').'/administrator/components/com_akforms/config.akforms.php') ) {
    	$row->text = preg_replace( $regex, '', $row->text );
    	return;
    }

	require_once($mainframe->getCfg('absolute_path').'/administrator/components/com_akforms/config.akforms.php');
	$form_cfg = new akFormsConfig();

	$matches = array();
	preg_match_all( $regex, $row->text, $matches, PREG_SET_ORDER );

/*
	//check if param query has previously been processed
	if ( !isset($_MAMBOTS->_content_bot_params['akforms']) ) {
		//load bot params info
		$query = "SELECT params FROM #__mambots WHERE element = 'akforms' AND folder = 'content'";
		$database->setQuery( $query, '#__', 1, 0);
		$database->loadObject($mambot);

		$_MAMBOTS->_content_bot_params['akforms'] = $mambot;
	}

	$mambot = $_MAMBOTS->_content_bot_params['akforms'];

	$params = new mosParameters( $mambot->params );
*/

	$maxfsize = $form_cfg->get('GFMAXFILESIZE');

//	if (!$maxfsize) $maxfsize = $params->get('maxfilesize', 0);

    $GLOBALS["botAkFormsMaxFileSize"] = $maxfsize;
    $GLOBALS["botAkFormsParams"] = $params;

    $row->text = preg_replace_callback( $regex, 'botAkForm_replacer', $row->text );

    unset( $GLOBALS['botAkFormsMaxFileSize'], $GLOBALS["botAkFormsParams"] );

	return true;
}

function parseIntVarables($value) {
	/* INTERNAL VERABLES */
	$ret = $value;
	switch ( eUTF::utf8_strtoupper($value) ) {
		case '%CURRENT_URL%': $ret = sefRelToAbs($_SERVER['REQUEST_URI']); break;
	}
	return $ret;
}


/*************************************************************/
/* RETURN EXTRA FIELD AS ARRAY FOR USE IN FORMS (new method) */
/*************************************************************/
function xfieldFormArray( $id, $name, $options=array(), $value=array(), $type='text', $ronly='0', $halign='1', $maxlength='50', $java='', $req='0', $style='', $class='' ) {
	global $database;

	if ( $ronly == 1 ) { $ronly = ' readonly="readonly"'; } else { $ronly = ''; }
	if ( trim($java) != '' ) { $java = ' '.$java; }
	if ( $halign == 0 ) { $hal = '<br />'; } else { $hal = ''; }
	if (!is_array($value)) { $value = array($value); }
	if ($style) { $st = ' style="'.$style.'"'; } else { $st = ''; }
	if ($class) { $cl = ' '.$class; } else { $cl = ''; }

	$notnull = '<span class="notnull">*</span>';

    $out = array();
	switch ($type) {
        case 'select':
            $out['title'] = ($req) ? $name.$notnull : $name;
            $html = '<select name="submitted['.$id.']" title="'.$name.'" class="selectbox'.$cl.'"'.$ronly.$java.$st.'>'._LEND;
            for ($i=0; $i<count($options); $i++) {
                if ($options[$i]) {
                	$val = $options[$i];
                    if ($val == $value[0]) { $chk = ' selected="selected"'; } else { $chk = ''; }
                    $html .= '<option value="'.$val.'"'.$chk.'>'.$val.'</option>'._LEND;
                }
            }
            $html .= '</select>'._LEND;
            $out['html'] = $html;
        break;
        case 'valselect':
            $out['title'] = ($req) ? $name.$notnull : $name;
            $html = '<select name="submitted['.$id.']" title="'.$name.'" class="selectbox'.$cl.'"'.$ronly.$java.$st.'>'._LEND;
            for ($i=0; $i<count($options); $i++) {
                if ($options[$i]) {
                	$val = 	$options[$i];
                	$vals = explode('=', $val);
                    if ($vals[0] == $value[0]) { $chk = ' selected="selected"'; } else { $chk = ''; }
                    $html .= '<option value="'.$vals[0].'"'.$chk.'>'.$vals[1].'</option>'._LEND;
                }
            }
            $html .= '</select>'._LEND;
            $out['html'] = $html;
        break;
        case 'radio':
            $out['title'] = ($req) ? $name.$notnull : $name;
            $html = '';
            for ($i=0; $i<count($options); $i++) {
                if ($options[$i]) {
                	$val = 	$options[$i];
                    if ($val == $value[0]) { $chk = ' checked="checked"'; } else { $chk = ''; }
                    $html .= '<input type="radio" name="submitted['.$id.']" title="'.$val.'" class="inputbox'.$cl.'" value="'.$val.'"'.$chk.$ronly.$java.$st.' />'.$val.' '.$hal._LEND;
                }
            }
            $out['html'] = $html;
        break;
        case 'checkbox':
            $out['title'] = ($req) ? $name.$notnull : $name;
            $html = '';

			$html .= '<ul class="">';
            for ($i=0; $i<count($options); $i++) {
                if ($options[$i]) {
                	$val = $options[$i];
                    if (in_array(trim($val), $value)) { $chk = ' checked="checked"'; } else { $chk = ''; }
                    $html .= '<li><input type="checkbox" name="submitted['.$id.'][]" title="'.$val.'" class="inputbox'.$cl.'" value="'.$val.'"'.$chk.$ronly.$java.$st.' /> '.$val.' '.$hal.'</li>'._LEND;
                }
            }
			$html .= '</ul>';
            //the following is required to grab checkbox extraid if user has deselect all boxes
            //$html .= '<input type="hidden" name="submitted['.$id.'][]" value="'.$id.'" />'._LEND;
            $out['html'] = $html;
        break;
        case 'hidden':
            $out['title'] = '';
            $v = parseIntVarables($value[0]);
            $out['html'] = '<input type="hidden" name="submitted['.$id.']" value="'.$v.'" />'._LEND;
        break;
        case 'input':
            $out['title'] = ($req) ? $name.$notnull : $name;
            $out['html'] = '<input size="50" type="text" name="submitted['.$id.']" title="'.$name.'" class="inputbox'.$cl.'" value="'.implode(',',$value).'" maxlength="'.$maxlength.'"'.$ronly.$java.$st.' id="req'.$id.'" />'._LEND;
        break;
        case 'email':
            $out['title'] = ($req) ? $name.$notnull : $name;
            $out['html'] = '<input size="50" type="text" name="submitted['.$id.']" title="'.$name.'" class="inputbox'.$cl.'" value="'.implode(',',$value).'" maxlength="'.$maxlength.'"'.$ronly.$java.$st.' id="req'.$id.'" />'._LEND;
        break;
        case 'date':
            $out['title'] = ($req) ? $name.$notnull : $name;
            $out['html'] = '<input size="10" type="text" name="submitted['.$id.']" title="'.$name.'" class="inputbox'.$cl.'" value="'.$value[0].'" maxlength="10"'.$ronly.$java.$st.' id="req'.$id.'" />'._LEND;
            $out['html'] .= '<input name="reset'.$id.'" type="reset" class="button" onclick="return showCalendar(\'req'.$id.'\');" value="...">'._LEND;
        break;
        case 'time':
            $out['title'] = ($req) ? $name.$notnull : $name;
            $out['html'] = '<input size="5" type="text" name="submitted['.$id.']" title="'.$name.'" class="inputbox'.$cl.'" value="'.$value[0].'" maxlength="5"'.$ronly.$java.$st.' id="req'.$id.'" />'._LEND;
            $out['html'] .= '<script type="text/javascript">jQuery(function() { jQuery(\'#req'.$id.'\').timeEntry({spinnerImage: \'\', show24Hours: true}); });</script>'._LEND;
        break;
        case 'file':
            $out['title'] = ($req) ? $name.$notnull : $name;
   	        $fadd = '';
            if ( trim($value[0]) ) {
	        	$fn = explode('|', $value[0]);
        	    if ( count($fn) > 1 && $fn[0] ) {
					$link = 'index2.php?option=com_akforms&task=download&file='.$fn[0].'&name='.$fn[1];
            		$fadd = '<label><input type="checkbox" name="delfile['.$id.']" value="1" /> '._CMN_DELETE.' '.$fn[1].'</label><br/><a href="'.$link.'" title="'._E_SAVE.' '.$fn[1].'">'._E_SAVE.' '.$fn[1].'</a><br/>';
	            }
	        }
            $out['html'] = $fadd.'<input type="hidden" name="submitted['.$id.']" value="'.$value[0].'" /><input size="50" type="file" name="submitted['.$id.']" title="'.$name.'" class="inputbox'.$cl.'" value=""'.$ronly.$java.$st.' id="req'.$id.'" />'._LEND;
        break;
        case 'textarea':
            $out['title'] = ($req) ? $name.$notnull : $name;
            $out['html'] = '<textarea name="submitted['.$id.']" title="'.$name.'" class="text_area'.$cl.'" cols="45" rows="15"'.$ronly.$java.$st.' id="req'.$id.'">'.implode(',',$value).'</textarea>'._LEND;
        break;
        case 'label':
            $out['title'] = '';
            $out['html'] = '<p class="form_label'.$cl.'"'.$st.'>'.$name.'</p>';
        break;
        case 'text':
            $out['title'] = '';
            $out['html'] = '<p class="form_label'.$cl.'"'.$st.'>'.nl2br($value[0]).'</p>';
        break;
        case 'sql':
            $out['title'] = ($req) ? $name.$notnull : $name;
			$database->setQuery(strtolower($options[0]), '#__');
			$rows = $database->loadObjectList();

            $html = '<select name="submitted['.$id.']" title="'.$name.'" class="selectbox'.$cl.'"'.$ronly.$java.$st.'>'._LEND;
            foreach ($rows as $row) {
                if ($row->value === $value[0]) { $chk = ' selected="selected"'; } else { $chk = ''; }
                    $html .= '<option value="'.$row->value.'"'.$chk.'>'.$row->text.'</option>'._LEND;
            }
            $out['html'] =  $html;
        break;
        case 'table':
            $out['title'] = ($req) ? $name.$notnull : $name;
            $html = '<script type="text/javascript">'."\n";
			$html .= 'jQuery(document).ready(function($) {'."\n";
			$html .= '	akformsfront.initParser('.$id.'); akformsfront.updateCells('.$id.');'."\n";
			$html .= '});'."\n";
            $html .= '</script>'."\n";
            $html .= '<div class="field_table">';
            $html .= '<table id="field_table'.$id.'" class="field_table">';

            $_tval = array();
            if ( is_array($value[0])  ) {
            	$_tval = $value;
            } else {
	            $vRows = explode('|', $value[0]);
	            if ( is_array($vRows) ) {
	    	        foreach ( $vRows as $_r => $vRow ) {
    	    	    	$_tval[] = explode('~', $vRow);
        	    	}
        	    }
            }

            foreach ($options as $_r => $_row) {
            	if ( empty($_row)) { continue; }
            	$_cols = explode('~', $_row);
				$myTr = '<tr>';
            	foreach ($_cols as $_c => $_sell) {
					$myTr .= '<td class="value">';
					if ( empty($_sell) ) {
						$myTr .= '<input type="text" id="'.Chr(65+$_c).($_r+1).'" name="submitted['.$id.']['.$_r.']['.$_c.']" value="'.$_tval[$_r][$_c].'" />';
					} else if ( substr($_sell, 0, 1) == '=' ) {
						$myTr .= '<input id="'.Chr(65+$_c).($_r+1).'" disabled="disabled" type="text" name="submitted['.$id.']['.$_r.']['.$_c.']" formula="'.$_sell.'" value="" />';
					} else {
						if (  substr($_sell, 0, 1) == '\'' ) {
							$_sell = substr($_sell, 1);
						}

						$myTr .= '<input id="'.Chr(65+$_c).($_r+1).'" disabled="disabled" type="text" name="submitted['.$id.']['.$_r.']['.$_c.']" value="'.$_sell.'" />';
					}
					$myTr .= "</td>";
				}
				$myTr .= "</tr>";
				$html .= $myTr;
            }
            $html .= '</table></div>';

            $out['html'] =  $html;
        break;
    }
    return $out;
}

/*******************/
/* MOSFLV REPLACER */
/*******************/
function botAkForm_replacer( &$matches ) {
	global $SESSION, $database, $mainframe, $lang, $my;


	$ssl = false;
	if (isset($_SERVER['HTTPS'])) {
		if (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == 1)) {
			$ssl = true;
		}
	} else if (isset($_SERVER['SERVER_PORT']) && ($_SERVER['SERVER_PORT'] == 443)) {
		$ssl = true;
	}

	if ($ssl === true) {
		$ssllive = preg_replace('/^(http\:)/i', 'https:', $mainframe->getCfg('live_site'));
	} else {
		$ssllive = $mainframe->getCfg('live_site');
	}

	$html = '';

	$params = $GLOBALS["botAkFormsParams"];

	//$file can be any path or url
    $fid = intval(trim($matches[1]));

    if (!$fid) return '';

    $database->setQuery('DELETE FROM #__akform_values WHERE istemp=1 AND expire < "'.date('Y-m-d H:i:s').'"');
    $database->query();

	$submitted = $_SESSION["botAkFormSubmitted"];
	$active_page = intval($_SESSION["botAkFormPage"]);

	$database->setQuery('SELECT *
						   FROM #__akforms
						   WHERE id = '.$fid.' and published = 1');
	$database->loadObject($form);

    if (!$form->id) { return ''; };

    $apath = $mainframe->getCfg('absolute_path').'/mambots/content/akforms/';
	$slang = $GLOBALS['lang'];
	$dlang = $mainframe->getCfg('lang');
	if (file_exists($apath.$slang.'.php')) {
		require_once($apath.$slang.'.php');
	} else if (file_exists($apath.$dlang.'.php')) {
		require_once($apath.$dlang.'.php');
	} else {
		require_once($apath.'english.php');
	}

	if ( !$form->allow_submit_repeatly ) {
	    $database->setQuery('SELECT COUNT(*) FROM #__akform_values v, #__akform_items i WHERE v.user_id='.$my->id.' AND v.field_id=i.id AND i.form_id='.$form->id.' AND istemp IS NULL');
	    $cnt = $database->loadResult();

	    if ( $cnt > 0 ) {
	    	if ( $_SESSION["botAkFormMSG"] ) {
		    	$msg = $_SESSION["botAkFormMSG"];
		    	 $_SESSION["botAkFormMSG"] = '';
		    } else {
		    	$msg = _AKFORM_ALREADY_SUMBIT;
		    }

	    	return '<div class="message">'.$msg.'</div>';
	    }
	}

    $database->setQuery('SELECT label FROM #__akforms_langs WHERE ref_id='.$form->id.' AND ref_type IN ("BTSEND") AND language="'.$lang.'"');
    $btn_send = trim($database->loadResult());

    if ( !empty($btn_send) ) {
    	$form->text_button = $btn_send;
    }


	$database->setQuery('SELECT COUNT(*) FROM #__akform_items
							WHERE form_id = '.$fid.' AND
								  published = 1 AND
								  access IN ('.$my->allowed.') AND
								  ((language LIKE "%'.$lang.'%") OR (language IS NULL)) AND
								  field_type="page_break"');
	$totalpages = intval($database->loadResult()) + 1;

	$database->setQuery('SELECT * FROM #__akform_items
							WHERE form_id = '.$fid.' AND
								  published = 1 AND
								  access IN ('.$my->allowed.') AND
								  ((language LIKE "%'.$lang.'%") OR (language IS NULL))
							ORDER BY ordering');
	$rows = $database->loadObjectList();

	$sid = mosGetParam( $_COOKIE, 'akFormCID', array() );

	$save_values = array();
	if ( isset($sid[$fid]) ) {
		$database->setQuery('SELECT field_id, value FROM #__akform_values WHERE unic="'.$sid[$fid].'" AND istemp=1 AND expire >= "'.date('Y-m-d H:i:s').'"');
		$save_values = $database->loadRowList('field_id');
	}

	$calendarurl = $mainframe->getCfg('ssl_live_site').'/includes/js/calendar';

	if (!defined('elxcalincl')) {
		define('elxcalincl', 1);

		$html .= '<link rel="stylesheet" type="text/css" media="all" href="'.$calendarurl.'/calendar-mos.css" />';
		$html .= '<script type="text/javascript" src="'.$calendarurl.'/calendar.js"></script>';
		$html .= '<script type="text/javascript" src="'.$calendarurl.'/lang/calendar-'.$GLOBALS['lang'].'.js"></script>';
		$html .= '<script type="text/javascript">if (typeof jQuery == \'undefined\') {document.write(\'<scr\' + \'ipt type="text/javascript" src="'.$ssllive.'/components/com_akforms/js/jquery.js"></scr\' + \'ipt>\'); }</script>';
		$html .= '<script type="text/javascript">jQuery.noConflict();</script>';
		$html .= '<script type="text/javascript" src="'.$ssllive.'/components/com_akforms/js/parser.js"></script>';
		$html .= '<script type="text/javascript" src="'.$ssllive.'/components/com_akforms/js/akformsfront.js"></script>';
		$html .= '<script type="text/javascript">if (typeof jQuery.timeEntry == \'undefined\') {document.write(\'<scr\' + \'ipt type="text/javascript" src="'.$ssllive.'/components/com_akforms/js/jquery.timeentry.pack.js"></scr\' + \'ipt>\'); }</script>';
		$html .= '<script type="text/javascript">if (typeof jQuery.scrollTo == \'undefined\') {document.write(\'<scr\' + \'ipt type="text/javascript" src="'.$ssllive.'/components/com_akforms/js/jquery.scrollTo-min.js"></scr\' + \'ipt>\'); }</script>';
	}

	$html .= '<link href="'.$ssllive.'/mambots/content/akforms/akforms.css" rel="stylesheet" type="text/css" media="all" />'._LEND;

	if ( file_exists($mainframe->getCfg('absolute_path').'/components/com_akforms/akforms.css') ) {
		$html .= '<link href="'.$ssllive.'/components/com_akforms/akforms.css" rel="stylesheet" type="text/css" media="all" />'._LEND;
	}
	if ($form->css_text) {
		$html .= '<style type="text/css">'.$form->css_text.'</style>'._LEND;
	}

    $html .= '<script type="text/javascript">'."\n";
	$html .= 'jQuery(document).ready(function($) {'."\n";
	if ( $_SESSION["botAkFormAnchor"] ) {
		$html .= 'jQuery.scrollTo( jQuery(\'#'.$_SESSION["botAkFormAnchor"].'\'));';
		$_SESSION["botAkFormAnchor"] = '';
	}
	$html .= '	jQuery(\'#submit_button'.$form->id.'\').bind(\'click\', function(e) {'."\n";
	$html .= '		jQuery(\'table#form_'.$form->id.' input[disabled]\').removeAttr(\'disabled\');'."\n";
	$html .= '		e.preventDefault();'."\n";
	$html .= '		jQuery(this).attr("disabled","disabled");'."\n";
	$html .= '		var form = document.getElementById(\'akForm'.$form->id.'\');'."\n";
	$html .= '		form.submit();'."\n";
	$html .= '	});'."\n";
	$html .= '	jQuery(\'#akFormPages_'.$form->id.' div.akFormFooter a.pagenav\').bind(\'click\', function(e) {'."\n";
	$html .= '		jQuery(\'#akFormPages_'.$form->id.' div.akFormFooter a.active\').removeClass(\'active\');'."\n";
	$html .= '		var _page = jQuery(this).attr(\'rel\');'."\n";
	$html .= '		jQuery(\'#akFormPages_'.$form->id.' > div.akFormPage\').hide();'."\n";
	$html .= '		jQuery(\'#akFormPages_'.$form->id.' #akFormPage_'.$form->id.'-page\' + _page).show();'."\n";
	$html .= '		jQuery(this).addClass(\'active\');'."\n";
	$html .= '		jQuery.scrollTo( jQuery(\'div#akFormPages_'.$form->id.'\'), 800 );';
	$html .= '		if ( _page == '.($totalpages-1).' ) { jQuery(\'#submit_button'.$form->id.'\').show(); } else { jQuery(\'#submit_button'.$form->id.'\').hide(); } ';
	$html .= '	});'."\n";

	$html .= '	jQuery(\'#save_button'.$form->id.'\').bind(\'click\', function(e) {'."\n";
	$html .= '		jQuery(\'form#akForm'.$form->id.' input#task\').val(\'save\');'."\n";
	$html .= '		jQuery(\'table#form_'.$form->id.' input[disabled]\').removeAttr(\'disabled\');'."\n";
	$html .= '		e.preventDefault();'."\n";
	$html .= '		jQuery(this).attr("disabled","disabled");'."\n";
	$html .= '		var form = document.getElementById(\'akForm'.$form->id.'\');'."\n";
	$html .= '		form.submit();'."\n";
	$html .= '	});'."\n";

	$html .= '	jQuery(\'#reset_button'.$form->id.'\').bind(\'click\', function(e) {'."\n";
	$html .= '		if ( !confirm(\''._AKFORM_RESET_CONFIRM.'\') ) return;';
	$html .= '		jQuery(\'form#akForm'.$form->id.' input#task\').val(\'reset\');'."\n";
	$html .= '		var form = document.getElementById(\'akForm'.$form->id.'\');'."\n";
	$html .= '		form.submit();'."\n";
	$html .= '	});'."\n";

	$html .= '});'."\n";
    $html .= '</script>'."\n";

	$html .= '<form method="post" action="'.$ssllive.'/index.php/?mylang='.$lang.'" name="akForm'.$form->id.'" id="akForm'.$form->id.'" enctype="multipart/form-data">'._LEND;
	if ( $_SESSION["botAkFormMSG"] ) {
		$html .= '<div class="message">'.$_SESSION["botAkFormMSG"].'</div>';
		$_SESSION["botAkFormMSG"] = '';
	}
	if ( $_SESSION["botAkFormERR"] ) {
		$html .= '<div class="elxwarning">'.$_SESSION["botAkFormERR"].'</div>';
		$_SESSION["botAkFormERR"] = '';
	}
	$hasEmail = false;

	$page = 0;
	$html .= '<div id="akFormPages_'.$form->id.'">';
	$html .= '<div class="akFormPage" id="akFormPage_'.$form->id.'-page'.$page.'" style="display:'.($active_page == $page ? 'block' : 'none').';">';
	$html .= '<table class="akForms" id="form_'.$form->id.'" border="0">'._LEND;

	foreach ($rows as $field) {
		if ( $field->field_type == 'page_break' ) {
			$page++;
			$html .= '</table></div>'._LEND;
			$html .= '<div class="akFormPage" id="akFormPage_'.$form->id.'-page'.$page.'" style="display:'.($active_page == $page ? 'block' : 'none').';">';
			$html .= '<table class="akForms" id="form_'.$form->id.'" border="0">'._LEND;
		}
		if ($field->field_type == 'email') {
			$hasEmail = true;
		}
	    $fvals = explode("|", $field->field_value);

		if ( isset($save_values[$field->id]) ) {
	    	$fvals = explode(',', $save_values[$field->id]['value']);
	    } else if ( isset($submitted[$field->id]) ) {
	    	if ( is_array($submitted[$field->id]) ) {
		    	$fvals = $submitted[$field->id];
		    } else {
		    	$fvals[0] = $submitted[$field->id];
		    }
	    }

	    $options = explode("|", $field->field_list);
		$lh = ($field->line_height ? ' height="'.$field->line_height.'px"' : '');

		$fl = ($field->hidelabel ? '' : $field->field_label);

		$out = xfieldFormArray( $field->id, $fl, $options, $fvals, $field->field_type, $field->readonly, 1, $field->maxlength, '', $field->isnotnull, $field->field_style, $field->field_class);
		if (isset($out)) {
			if ( $field->field_type == 'file' ) {
				$fhtml = '';
				if ( $GLOBALS["botAkFormsMaxFileSize"] ) {
					$fhtml .= '<span style="color: #ff0000; font-weight: bold;">'.sprintf(_AKFORM_MAXFILESIZE, $GLOBALS["botAkFormsMaxFileSize"]).'</span>';
				}
				if ( $field->field_value ) {
					$fhtml .= ($fhtml ? '<br/>' : '')._AKFORM_SUPPORT_EXT.':<span style="font-size: 11px; color: #777;">('.$field->field_value.')</span>';
				}
				if ($fhtml) {
					$html .= '<tr><td colspan="2">'.$fhtml.'</td></tr>';
				}
			}

			if ( trim($field->description) ) {
				$out['html'] .= '<span class="akFieldDesc">'.nl2br($field->description).'</span>';
			}

			if ($out['title']) {
				$html .= '<tr><td'.$lh.' class="akFormLabel">'.$out['title'].'</td><td'.$lh.'>'.$out['html'].'</td></tr>'._LEND;
			} else {
				$html .= '<tr><td colspan="2"'.$lh.'>'.$out['html'].'</td></tr>'._LEND;
			}
		}
	}

	if ( $form->send_copy ) {
		$html .= '<tr><td colspan="3">';
		$html .= '<br /><input type="checkbox" name="email_copy" id="email_copy" value="1" title="email copy" '.($_SESSION["botAkFormECopy"] ? 'checked="checked"' : '').'/> <label for="email_copy">'._EMAIL_A_COPY.'</label>';
		if (!$hasEmail) {
			$html .= '&nbsp;&nbsp;<input type="text" name="copy_email" id="copy_email" dir="ltr" value="" size="20" title="" />';
		}
		$html .= '</td></tr>';
        $_SESSION["botAkFormECopy"] = 0;
	}

	if ($form->captcha) {
		$random = rand(104, 996);
		$rtl = (_GEM_RTL) ? ' dir="rtl"' : '';
		$html .= '<tr><td class="akFormLabel" style="width: 30%;"><span'.$rtl.'>';
		$html .= _E_SECCODE.'</span></td><td><img src="includes/captcha/captcha.img.php" alt="'._E_SPELL.'" border="0" />';
		$html .= '</td></tr><tr><td class="akFormLabel"><label for="code'.$random.'"'.$rtl.'>'._E_TYPE_SECCODE.':</label></td><td colspan="2">';
		$html .= '<input type="text" name="code" id="code'.$random.'" dir="ltr" value="" size="10" maxlength="10" title="'._E_SECCODE.'" />';
		$html .= '</td></tr>';
	}

	$html .= '</table>'._LEND;
	$html .= '</div>'._LEND;
	$html .= '<div class="akFormFooter">';
	if ( $page > 0 ) {
		for ( $x=0; $x<=$page; $x++ ) {
			$html .= '<a class="pagenav'.($active_page == $x ? ' active' : '').'" href="javascript:void(0);" rel="'.$x.'"><strong>'.($x+1).'</strong></a>';
		}
	}
	$html .= '</div>';

	$html .= '<table border="0" class="akForms" width="100%">'._LEND;


	$html .= '<tr><td colspan="2" style="text-align: center;"><br/>';
	if ( $form->allow_save_form ) {
		$html .= '<input type="button" class="button" value="'._E_SAVE.'" name="dosave" id="save_button'.$form->id.'">&nbsp;&nbsp;';
		$html .= '<input type="button" class="button" value="'._AKFORM_RESET_FORM.'" name="doreset" id="reset_button'.$form->id.'">&nbsp;&nbsp;';
	}
	$html .= '<input '.($active_page == ($totalpages-1) ? '' : 'style="display:none;"').' type="submit" class="button" value="'.($form->text_button ? $form->text_button : _AKFORM_SUBMIT).'" name="op" id="submit_button'.$form->id.'">';
	$html .= '</td></tr>'._LEND;
	$html .= '</table>';
	$html .= '</div>';

	if ( $params->redirect ) {
		$redirect = $params->redirect;
	} else {
		$redirect = sefRelToAbs($_SERVER['REQUEST_URI']);
	}

	$html .= '<input type="hidden" name="option" value="com_akforms" />'._LEND;
	$html .= '<input type="hidden" name="task" id="task" value="submit" />'._LEND;
	if ( $params->editmode ) {
		$html .= '<input type="hidden" name="editmode" value="'.$params->editmode.'" />'._LEND;
	}
	$html .= '<input type="hidden" name="redirect" value="'.$redirect.'" />'._LEND;
	$html .= '<input type="hidden" value="'.$form->id.'" name="fid">'._LEND;
	$html .= '</form>'._LEND;

   return $html;
}

function akf_removebots($text) {
	$text = preg_replace("#{addphp\s*(.*?)}#i", '', $text); //this bot needs special care
	$text = preg_replace("#{.+?}(.*?){/.+?}#s", '', $text);
	$text = preg_replace("#{.+?}#", '', $text);
	return $text;
}

?>