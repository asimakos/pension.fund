<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Bots/Editors TinyMCE
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: TinyMCE Editor for Elxis, javascript initialisation
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!defined( '_ELXIS_ADMIN' )) {
    $ccomps = array(
        'com_bridge',
        'com_contact',
        'com_content',
        'com_frontpage',
        'com_login',
        'com_messages',
        'com_newsfeeds',
        'com_poll',
        'com_registration',
        'com_search',
        'com_user',
        'com_weblinks',
        'com_wrapper',
        'com_eblog'
    );
    global $option;
    if ($option == '') { $option = 'com_frontpage'; }
    if (!preg_match('/^(com\_)/', $option)) { $option = 'com_'.$option; }
    if (in_array($option, $ccomps)) { define('_SIMPLY_TINYMCE', 1); }
}

if (defined('_SIMPLY_TINYMCE')) {
    $_MAMBOTS->registerFunction('onInitEditor', 'botTinymceEditorInitF');
} else {
    $_MAMBOTS->registerFunction('onInitEditor', 'botTinymceEditorInit');
}
$_MAMBOTS->registerFunction('onGetEditorContents', 'botTinymceEditorGetContents');
$_MAMBOTS->registerFunction('onEditorArea', 'botTinymceEditorEditorArea');


/**************************/
/* LOAD EDITOR'S LANGUAGE */
/**************************/
function botTinymceEditorLang() {
    global $mainframe;

	$tlang = (defined( '_ELXIS_ADMIN' )) ? $GLOBALS['alang'] : $GLOBALS['lang'];
	switch($tlang) {
		case 'bulgarian': $tinylang = 'bg'; break;
		case 'czech': $tinylang = 'cs'; break;
		case 'danish': $tinylang = 'da'; break;
		case 'german': $tinylang = 'de'; break;
		case 'greek': $tinylang = 'el'; break;
		case 'english': $tinylang = 'en'; break;
		case 'spanish': $tinylang = 'es'; break;
		case 'farsi': $tinylang = 'fa'; break;
		case 'persian': $tinylang = 'fa'; break;
		case 'finnish': $tinylang = 'fi'; break;
		case 'french': $tinylang = 'fr'; break;
		case 'hebrew': $tinylang = 'he'; break;
		case 'croatian': $tinylang = 'hr'; break;
		case 'hungarian': $tinylang = 'hu'; break;
		case 'italian': $tinylang = 'it'; break;
		case 'japanese': $tinylang = 'ja'; break;
		case 'lithuanian': $tinylang = 'lt'; break;
		case 'latvian': $tinylang = 'lv'; break;
		case 'norwegian': $tinylang = 'nb'; break;
		case 'dutch': $tinylang = 'nl'; break;
		case 'polish': $tinylang = 'pl'; break;
		case 'portuguese': $tinylang = 'pt'; break;
		case 'russian': $tinylang = 'ru'; break;
		case 'slovenian': $tinylang = 'sl'; break;
		case 'srpski': $tinylang = 'sr'; break;
		case 'serbian': $tinylang = 'sr'; break;
		case 'swedish': $tinylang = 'sv'; break;
		case 'turkish': $tinylang = 'tr'; break;
		case 'vietnamese': $tinylang = 'vi'; break;
		case 'chinese': $tinylang = 'zh'; break;
		default: $tinylang = 'en'; break;
	}

    if (!file_exists($mainframe->getCfg('absolute_path').'/mambots/editors/tinymce/jscripts/tiny_mce/langs/'.$tinylang.'.js' )) {
        $tinylang = 'en';
    }

    return $tinylang;
}


/*********************************/
/* INITIALIZE EDITOR FOR BACKEND */
/*********************************/
function botTinymceEditorInit() {
	global $mainframe, $database;

    if (defined ('_SIMPLY_TINYMCE')) {
        return botTinymceEditorInitF();
    }

	//load tinymce info
	$database->setQuery( "SELECT id FROM #__mambots WHERE element = 'tinymce' AND folder = 'editors'", '#__', 1, 0 );
	$id = intval($database->loadResult());
	$mambot = new mosMambot( $database );
	$mambot->load( $id );
	$params = new mosParameters($mambot->params);

 	$editor_width = $params->get('editor_width', '500');
	$editor_height = $params->get('editor_height', '400');
	$theme = $params->get('theme', 'advanced');
	$skin = $params->get('skin', 'o2k7');
	$skin_variant = $params->get('skin_variant', 'silver');

	$table_inline = (intval($params->get('table_inline', 1))) ? 'true' : 'false';
 	$newlines = intval($params->get('newlines', 1));
  	if ($newlines) {
    	$newlines_br = "false";
    	$newlines_p = "true";   		
  	} else {
    	$newlines_br = "true";
    	$newlines_p = "false"; 		
  	}
	$text_direction	= (_GEM_RTL) ? 'rtl' : 'ltr';
	$event_elms	= $params->get( 'event_elements', 'a,img' );
	$convert_fonts = (intval($params->get( 'convert_fonts', 1 ))) ? 'true' : 'false';
	$entity_encoding = $params->get( 'entity_encoding', 'raw' );
	$font_size_type = $params->get( 'font_size_type', 'length' );
	$invalid_elements = $params->get( 'invalid_elements', 'script,object,applet,iframe' );
	$remove_linebreaks = (intval($params->get( 'remove_linebreaks', 1 ))) ? 'true' : 'false';
	$content_css = $params->get( 'content_css', 1 );
	$content_css_custom	= trim($params->get( 'content_css_custom', ''));
	$compression = intval($params->get( 'compression', 0 ));
	$convert_urls = (intval($params->get( 'convert_urls', 0 ))) ? 'true' : 'false';
 	$toolbar = $params->get( 'toolbar', 'top' );
 	$html_height = $params->get( 'html_height', '550' );
 	$html_width	= $params->get( 'html_width', '750' );

    //Plugins
    $plugin_table = intval($params->get( 'plugin_table', 1 ));
    $plugin_paste = intval($params->get( 'plugin_paste', 0 ));
    $plugin_preview = intval($params->get( 'plugin_preview', 1 ));
    $plugin_image = intval($params->get( 'plugin_image', 1 )); //advimage
    $plugin_links = intval($params->get( 'plugin_links', 1 )); //advlink
    $plugin_searchreplace = intval($params->get( 'plugin_searchreplace', 0 ));
    $plugin_emotions = intval($params->get( 'plugin_emotions', 0 ));
    $plugin_fullscreen = intval($params->get( 'plugin_fullscreen', 1 ));
	$plugin_insertdatetime = intval($params->get( 'plugin_insertdatetime', 0 ));
	$plugin_print = intval($params->get( 'plugin_print', 0 ));
	$plugin_directionality = intval($params->get( 'plugin_directionality', 0 ));
	$plugin_advhr = intval($params->get( 'plugin_advhr', 0 ));
	$plugin_contextmenu = intval($params->get( 'plugin_contextmenu', 1 ));
	$plugin_inlinepopups = intval($params->get( 'plugin_inlinepopups', 1 ));
	$plugin_media = intval($params->get( 'plugin_media', 1 ));
	$plugin_pagebreak = intval($params->get( 'plugin_pagebreak', 1 ));
    $plugin_fontselect = intval($params->get( 'plugin_fontselect', 1 ));
    $plugin_fontsizeselect = intval($params->get( 'plugin_fontsizeselect', 1 ));
    $plugin_formatselect = intval($params->get( 'plugin_formatselect', 1 ));
    $plugin_styleselect = intval($params->get( 'plugin_styleselect', 1 ));
    $plugin_ibrowser = intval($params->get('plugin_ibrowser', 1));

	//Extra Plugins
	$arrPlugins = array();
	if ($plugin_table) { array_push($arrPlugins, 'table'); }
	if ($plugin_emotions) { array_push($arrPlugins, 'emotions'); }
	if ($plugin_insertdatetime) { array_push($arrPlugins, 'insertdatetime'); }
	if ($plugin_paste) { array_push($arrPlugins, 'paste'); }
	if ($plugin_image) { array_push($arrPlugins, 'advimage'); }
	if ($plugin_links) { array_push($arrPlugins, 'advlink'); }
	if ($plugin_searchreplace) { array_push($arrPlugins, 'searchreplace'); }
	if ($plugin_preview) { array_push($arrPlugins, 'preview'); }
	if ($plugin_fullscreen) { array_push($arrPlugins, 'fullscreen'); }
	if ($plugin_print) { array_push($arrPlugins, 'print'); }
	if ($plugin_directionality) { array_push($arrPlugins, 'directionality'); }
	if ($plugin_advhr) { array_push($arrPlugins, 'advhr'); }
	if ($plugin_contextmenu) { array_push($arrPlugins, 'contextmenu'); }
	if ($plugin_inlinepopups) { array_push($arrPlugins, 'inlinepopups'); }
	if ($plugin_media) { array_push($arrPlugins, 'media'); }
	if ($plugin_pagebreak) { array_push($arrPlugins, 'pagebreak'); }
	if ($plugin_ibrowser) { array_push($arrPlugins, 'ibrowser'); }
	array_push($arrPlugins, 'safari');
	array_push($arrPlugins, 'xhtmlxtras');
	array_push($arrPlugins, 'style');

	//Sets the current language
	$tmce_curr_lang = botTinymceEditorLang();

	if ( $content_css ) {
		$database->setQuery("SELECT template FROM #__templates_menu WHERE client_id='0' AND menuid='0'", '#__', 1, 0 );
 		$template = $database->loadResult();
 		$tplfile = 'template_css.css';
		if ((_GEM_RTL) && (file_exists($mainframe->getCfg('absolute_path').'/templates/'.$template.'/css/template_css-rtl.css'))) {
 			$tplfile = 'template_css-rtl.css';
 		}
 		$content_css = 'content_css : "'.$mainframe->getCfg('live_site').'/templates/'.$template.'/css/'.$tplfile.'"';
 	} else if ( $content_css_custom != '' ) {
 		$content_css = 'content_css : "'.$content_css_custom.'"';
 	} else {
 		$content_css = '';
	}

	/* ROW 1 */
	$editorRow = array();
	if ($plugin_table) { array_push($editorRow, 'tablecontrols', 'seperator'); }
	if ($plugin_paste) { array_push($editorRow, 'pastetext', 'pasteword', 'selectall', 'separator'); }
	array_push($editorRow, 'forecolor', 'backcolor');
	if ($plugin_image) { array_push($editorRow, 'advimage'); }
	if ($plugin_searchreplace) { array_push($editorRow, 'search', 'replace'); }
	if ($plugin_links) { array_push($editorRow, 'advlink'); }
	array_push($editorRow, 'seperator', 'styleprops', 'help', 'code');
	$strRowOne = implode(',',$editorRow);
	unset($editorRow);

	/* ROW 2 */
	$editorRow = array();
	array_push($editorRow, 'bold', 'italic', 'underline', 'strikethrough', 'bullist', 'numlist', 'separator', 'outdent', 'indent', 'blockquote', 'separator', 'link', 'unlink', 'anchor', 'image', 'cleanup', 'seperator');
	if ($plugin_emotions) { array_push($editorRow, 'emotions'); }
	if ($plugin_insertdatetime) { array_push($editorRow, 'insertdate', 'inserttime'); }
	if ($plugin_preview) { array_push($editorRow, 'preview'); }
	if ($plugin_media) { array_push($editorRow, 'media'); }
	if ($plugin_fullscreen) { array_push($editorRow, 'fullscreen'); }
	if ($plugin_ibrowser) { array_push($editorRow, 'ibrowser'); }
	$strRowTwo = implode(',',$editorRow);
	unset($editorRow);

	/* ROW 3 */
	$editorRow = array();
	array_push($editorRow, 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull');
	if ($plugin_advhr) { array_push($editorRow, 'advhr'); } else { array_push($editorRow, 'hr'); }
	array_push($editorRow, 'removeformat', 'visualaid', 'seperator', 'sub', 'sup', 'undo', 'redo', 'seperator', 'charmap');
	if ($plugin_print) { array_push($editorRow, 'print'); }
	if ($plugin_directionality) { array_push($editorRow, 'ltr', 'rtl', 'seperator'); }
	array_push($editorRow, 'cite', 'abbr', 'acronym', 'del', 'ins', 'attribs');
	$strRowThree = implode(',',$editorRow);
	unset($editorRow);

	/* ROW 4 */
	$editorRow = array();
	if ($plugin_fontselect) { array_push($editorRow, 'fontselect'); }
	if ($plugin_fontsizeselect) { array_push($editorRow, 'fontsizeselect'); }
	if ($plugin_formatselect) { array_push($editorRow, 'formatselect'); }
	if ($plugin_styleselect) { array_push($editorRow, 'styleselect'); }
	if ($plugin_pagebreak) { array_push($editorRow, 'pagebreak'); }
	
	$strRowFour = implode(',',$editorRow);
	unset($editorRow);

	//Creates the Plugins string
	$plugins = implode(',',$arrPlugins);

	//if compression enabled
	if ( $compression ) {
		$editor_out = "<script type=\"text/javascript\" src=\"".$mainframe->getCfg('ssl_live_site')."/mambots/editors/tinymce/jscripts/tiny_mce/tiny_mce_gzip.js\"></script>\n";
		$editor_out .= "<script type=\"text/javascript\">\n";
		$editor_out .= "tinyMCE_GZ.init({\n";
		$editor_out .= "plugins : '".$plugins."',\n";
		$editor_out .= "themes : 'simple,advanced',\n";
		$editor_out .= "languages : 'en',\n";
		$editor_out .= "disk_cache : true,\n";
		$editor_out .= "debug : false\n";
		$editor_out .= "});\n";
		$editor_out .= "</script>\n";
	} else {
		$editor_out = "<script type=\"text/javascript\" src=\"".$mainframe->getCfg('ssl_live_site')."/mambots/editors/tinymce/jscripts/tiny_mce/tiny_mce.js\"></script>\n";
	}

	$out = $editor_out;
	$out .= '<script type="text/javascript">'._LEND;
	$out .= 'var convert_urls = '.$convert_urls.';'._LEND;
	$out .= "tinyMCE.init({\n";
	$out .= 'width : "'.$editor_width.'",'._LEND;
	$out .= 'height : "'.$editor_height.'",'._LEND;
	$out .= 'table_inline_editing : '.$table_inline.','._LEND;
	$out .= 'browsers : "msie,safari,gecko,opera",'._LEND;
	$out .= 'theme : "'.$theme.'",'._LEND;
	$out .= 'skin : "'.$skin.'",'._LEND;
	$out .= 'skin_variant : "'.$skin_variant.'",'._LEND;
	$out .= 'debug : false,'._LEND;
	$out .= 'directionality: "'.$text_direction.'",'._LEND;
	$out .= 'editor_selector : "mceEditor",'._LEND;
	$out .= 'mode : "textareas",'._LEND;
	$out .= 'event_elements : "'.$event_elms.'",'._LEND;
	$out .= 'language : "'.$tmce_curr_lang.'",'._LEND;
	$out .= 'convert_fonts_to_spans : '.$convert_fonts.','._LEND;
	$out .= 'entity_encoding : "'.$entity_encoding.'",'._LEND;
	$out .= 'font_size_style_values : "'.$font_size_type.'",'._LEND;
	$out .= 'force_br_newlines : "'.$newlines_br.'",'._LEND;
	$out .= 'force_p_newlines : "'.$newlines_p.'",'._LEND;
	$out .= 'invalid_elements : "'.$invalid_elements.'",'._LEND;
	$out .= 'remove_linebreaks : "'.$remove_linebreaks.'",'._LEND;
	$out .= 'relative_urls : true,'._LEND;
	$out .= 'remove_script_host : true,'._LEND;
	$out .= 'convert_urls : '.$convert_urls.','._LEND;
	$out .= 'document_base_url : "'.$mainframe->getCfg('live_site').'/mambots/editors/tinymce/",'._LEND;
	$out .= 'plugins : "'.$plugins.'",'._LEND;
	$out .= 'pagebreak_separator : "{mospagebreak}",'._LEND;
	$out .= 'theme_advanced_toolbar_location : "'.$toolbar.'",'._LEND;
 	$out .= 'theme_advanced_source_editor_height : "'.$html_height.'",'._LEND;
	$out .= 'theme_advanced_source_editor_width : "'.$html_width.'",'._LEND;
	$out .= 'theme_advanced_layout_manager : "SimpleLayout",'._LEND;
	$out .= 'theme_advanced_buttons1 : "'.$strRowOne.'",'._LEND;
	$out .= 'theme_advanced_buttons2 : "'.$strRowTwo.'",'._LEND;
	$out .= 'theme_advanced_buttons3 : "'.$strRowThree.'",'._LEND;
	$out .= 'theme_advanced_buttons4 : "'.$strRowFour.'",'._LEND;
 	$out .= $content_css;
	$out .= "});\n";
	$out .= "</script>\n";

	return $out;
}


/***********************************************************/
/* INITIALIZE EDITOR FOR FRONTEND (LIGHT AND FAST VERSION) */
/***********************************************************/
function botTinymceEditorInitF() {
	global $mainframe, $database;

	//load tinymce info
	$database->setQuery( "SELECT id FROM #__mambots WHERE element = 'tinymce' AND folder = 'editors'", '#__', 1, 0 );
	$id = intval($database->loadResult());
	$mambot = new mosMambot( $database );
	$mambot->load( $id );
	$params = new mosParameters( $mambot->params );

	$theme = $params->get( 'theme', 'advanced' );
	$skin = $params->get( 'skin', 'o2k7' );
	$skin_variant = $params->get( 'skin_variant', 'silver');
 	$editor_width       = $params->get('editor_width', '450');
  	$editor_height      = $params->get('editor_height', '400');
	$entity_encoding    = $params->get('entity_encoding', 'raw');
	$compression       = $params->get('compression', 0);
  	$convert_urls       = $params->get('convert_urls', 0);
  	$convert_urls       = ( $convert_urls ) ? 'true' : 'false';
  	$convert_fonts      = $params->get('convert_fonts', 1);
  	$convert_fonts      = ( $convert_fonts ) ? 'true' : 'false';
  	$font_size_type     = $params->get('font_size_type', 'length');
  	$table_inline       = $params->get('table_inline', 1);
  	$table_inline =     ( $table_inline ) ? 'true' : 'false';
	$event_elms	        = $params->get('event_elements', 'a,img');
 	$toolbar 			= $params->get('toolbar', 'top');
 	$html_height		= $params->get('html_height', '550');
 	$html_width			= $params->get('html_width', '750');
 	$text_direction = (_GEM_RTL) ? 'rtl' : 'ltr';
	$content_css		= $params->get('content_css', 1);
 	$content_css_custom	= trim($params->get( 'content_css_custom', ''));
 	$invalid_elements	= $params->get('invalid_elements', 'script,object,applet,iframe');
 	$newlines			= $params->get('newlines', '1');
	if ($newlines=='0') {
    	$newlines_br="true";
    	$newlines_p="false";
	} else {
    	$newlines_br="false";
    	$newlines_p="true";
	}

    //Sets the current language
    $tmce_curr_lang = botTinymceEditorLang();
	
	if ( $content_css ) {
		$query = "SELECT template FROM #__templates_menu WHERE client_id='0' AND menuid='0'";
 		$database->setQuery($query);
 		$template = $database->loadResult();
 		$tplfile = 'template_css.css';
 		if ((_GEM_RTL) && (file_exists($mainframe->getCfg('absolute_path').'/templates/'.$template.'/css/template_css-rtl.css'))) {
 			$tplfile = 'template_css-rtl.css';
 		}
 		$content_css = 'content_css : "'.$mainframe->getCfg('live_site').'/templates/'.$template.'/css/'.$tplfile.'"';
	} else if ( $content_css_custom != '') {
		$content_css = 'content_css : "'.$content_css_custom.'"';
	} else {
		$content_css = '';
	}

    //Row One of the Editor
    $strRowOne = 'bold,italic,underline,bullist,numlist,forecolor,seperator,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontsizeselect';

    //Row Two of the Editor
    $strRowTwo = 'link,unlink,seperator,image,seperator,undo,redo,seperator,cleanup,hr,seperator,ltr,rtl,seperator,pagebreak,media,abbr,acronym,cite,attribs,charmap,removeformat,help';

    //Extra Plugins
    $plugins = 'directionality,media,advimage,safari,xhtmlxtras,style';

    //if compression enabled
    if ( $compression ) {
		$editor_out = "<script type=\"text/javascript\" src=\"".$mainframe->getCfg('ssl_live_site')."/mambots/editors/tinymce/jscripts/tiny_mce/tiny_mce_gzip.js\"></script>";
		$editor_out .= "<script type=\"text/javascript\">\n";
		$editor_out .= "tinyMCE_GZ.init({\n";
		$editor_out .= "plugins : '".$plugins."',\n";
		$editor_out .= "themes : 'simple,advanced',\n";
		$editor_out .= "languages : 'en',\n";
		$editor_out .= "disk_cache : true,\n";
		$editor_out .= "debug : false\n";
		$editor_out .= "});\n";
		$editor_out .= "</script>\n";
	} else {
		$editor_out = "<script type=\"text/javascript\" src=\"".$mainframe->getCfg('ssl_live_site')."/mambots/editors/tinymce/jscripts/tiny_mce/tiny_mce.js\"></script>";
    }

	$live_site = $mainframe->getCfg('live_site');
	return <<<EOD
$editor_out
<script type="text/javascript">
    var convert_urls = $convert_urls;
    tinyMCE.init({
        width : "$editor_width",
        height : "$editor_height",
        entity_encoding : "$entity_encoding",
        convert_fonts_to_spans : $convert_fonts,
		font_size_style_values : "$font_size_type",
		table_inline_editing : $table_inline,
		event_elements : "$event_elms",
        theme_advanced_toolbar_location : "$toolbar",
 		theme_advanced_source_editor_height : "$html_height",
		theme_advanced_source_editor_width : "$html_width",
 		directionality: "$text_direction",
 		editor_selector : "mceEditor",
        browsers : "msie,safari,gecko,opera",
        language : "$tmce_curr_lang",
        plugins : "$plugins",
        pagebreak_separator : "{mospagebreak}",
        theme : "advanced",
        skin : "$skin",
        skin_variant : "$skin_variant",
		mode : "textareas",
		relative_urls : true,
		remove_script_host : true,
		convert_urls : $convert_urls,
		document_base_url : "$live_site/mambots/editors/tinymce/",
        invalid_elements : "$invalid_elements",
        force_br_newlines : "$newlines_br",
        force_p_newlines : "$newlines_p",
        theme_advanced_layout_manager : "SimpleLayout",
        theme_advanced_buttons1 : "$strRowOne",
        theme_advanced_buttons2 : "$strRowTwo",
        theme_advanced_buttons3 : "",
        theme_advanced_buttons4 : "",
        $content_css,
        debug : false
	});
</script>
EOD;
}


/**
* TinyMCE WYSIWYG Editor - copy editor contents to form field
* @param string The name of the editor area
* @param string The name of the form field
*/
function botTinymceEditorGetContents( $editorArea, $hiddenField ) {
	return <<<EOD

		tinyMCE.triggerSave();
EOD;
}


/**
* TinyMCE WYSIWYG Editor - display the editor
* @param string The name of the editor area
* @param string The content of the field
* @param string The name of the form field
* @param string The width of the editor area
* @param string The height of the editor area
* @param int The number of columns for the editor area
* @param int The number of rows for the editor area
*/
function botTinymceEditorEditorArea( $name, $content, $hiddenField, $width, $height, $col, $row ) {
	global $mainframe, $_MAMBOTS;

    $width = intval($width) ? $width : '500'; //no percentage values
    $height = intval($height) ? $height : '200'; //no percentage values

    $fbuttons = '';
    if (!defined('_SIMPLY_TINYMCE')) {
        $results = $_MAMBOTS->trigger( 'onCustomEditorButton' );
        $buttons = array();
        foreach ($results as $result) {
            if ((isset($result[2])) && ($result[2] != '')) {
            	$tip = preg_replace("#([\']|[\"]|[\$]|[\#]|[\*]|[\~]|[\`]|[\^]|[\|]|[\\\])#", '', $result[2]);
                $but = '<a href="javascript: void(null);" onmouseover="return overlib(\''.$tip.'\', BELOW, RIGHT);" onmouseout="return nd();" style="text-decoration: none;">';
                //$but = '<a href="javascript:void(null);" onmouseover="this.T_WIDTH=\'300\'; return escape(\''.$result[2].'\');" onmouseout="return nd();" style="text-decoration: none;">';
                $but .= '<img src="'.$mainframe->getCfg('ssl_live_site').'/mambots/editors-xtd/'.$result[0].'" onclick="tinyMCE.execCommand(\'mceInsertContent\',false,\''.$result[1].'\')" border="0" alt="insert bot" />';
                $but .= '</a> '._LEND;

                $buttons[] = $but;
            } else {
                $buttons[] = '<img src="'.$mainframe->getCfg('ssl_live_site').'/mambots/editors-xtd/'.$result[0].'" alt="'.$result[2].'" title="'.$result[2].'" onclick="tinyMCE.execCommand(\'mceInsertContent\',false,\''.$result[1].'\')" /> ';
            }
        }
        $fbuttons = implode( '', $buttons );
    }

	return <<<EOD

<textarea id="$hiddenField" name="$hiddenField" cols="$col" rows="$row" style="width:{$width}px; height:{$height}px;" class="mceEditor">$content</textarea>
<br />$fbuttons
EOD;
}
?>