<?php 
/******************************************************************************
@ Package: Module Cu3er
@ Version: 1.0
@ Author: WebGift Web Services
@ Author-email: info@webgift.gr
@ Author URL: http://www.webgift.gr
@ License: GNU / GPL
@ Copyright: (C) 2007-2010 WebGift Web Services (WebGift). All rights reserved.
@ Description: English language file for Cu3er Module
Elxis CMS is a Free Software
*
**** ATTENTION: THIS FILE IS UTF-8 ENCODED! *****
*
*******************************************************************************/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


//MODULE XML PARAMS
if (defined('_ELXIS_ADMIN')) {
    define('CX_COPYRIGHT','Copyright');
    define('CX_DESC_COPYRIGHT','Show/Hide Copyrights at Front End Area');
    define('CX_CONFIG_CUSTOM','Custom XML File Name');
    define('CX_PARAM_EITHER','=<strong >Auto Configuration - XML File</strong>=');
    define('CX_PARAM_OR','=<strong style="color:#dd0000;">OR</strong> <strong >Set Cu3er Manually below</strong>=');
    define('CX_DESC_CONFIG_CUSTOM','You can import one config XML file from the folder : modules/mod_cu3er/config/ or create a new XML file and save it to that folder.Leave it blank in order to create a custom one by filling the fields below. Write the filename on that field. Example : demo1');
    define('CX_PARAM_GENERAL','General Settings');
    define('CX_SLIDE_PANEL_WIDTH','Panel Width (px)');
    define('CX_DESC_SLIDE_PANEL_WIDTH','Width of slide panel (same as your images width). Default: 900');
    define('CX_SLIDE_PANEL_HEIGHT','Panel Height (px)');
    define('CX_DESC_SLIDE_PANEL_HEIGHT','Height of slide panel (same as your images height). Default: 380');
    define('CX_SLIDE_PANEL_HORIZONTAL_ALIGN','Panel Horizontal');
    define('CX_DESC_SLIDE_PANEL_HORIZONTAL_ALIGN','Horizontal panel align relative to CU3ER.swf. Available values: left, center, right. Default: left');
    define('CX_SLIDE_PANEL_VERTICAL_ALIGN','Panel Vertical');
    define('CX_DESC_SLIDE_PANEL_VERTICAL_ALIGN','Vertical panel align relative to CU3ER.swf. Available values: top, center, bottom. Default: top');
    define('CX_SLIDE_UI_VISIBILITY_TIME','Visible Time (seconds)');
    define('CX_DESC_SLIDE_UI_VISIBILITY_TIME','CU3ER detects user activity/inactivity (mouse move). If user is inactive for the specified period of time (in seconds), tweenOut is applied for all UI elements. Default: 3');
    define('CX_SLIDE_URL','URL(s) Image');
    define('CX_DESC_SLIDE_URL','Relative Path or Absolute Path to your image/slide. Eg: /images/slideshow/slide1.jpg. Warning: This parameter will be deactivated if you\'ve choose one directory which contained your images');
    define('CX_PARAM_NOTE_SLIDE','Custom Image Settings <br/> <span style="color:#dd0000;font-weight:bold;">Note : </span><span style="font-weight:normal;">Enter more than one item in these parameters below, seperating them by using \' | \' character. Example: value1 | value2 | | value4</span>');    
        define('CX_PARAM_DIRECTORY','Images Selection <br/> <span style="color:#dd0000;font-weight:bold;">Note : </span><span style="font-weight:normal;"> Select the images either from specific Directory OR write the image url seperating them using | character. Example: Image URL1 | Image URL2 | | Image URL4. Image URL must have the below syntax : http://www.yourdomainname.com/images/slide1.jpg | http://www.yourdomainname.com/images/slide2.jpg | | http://www.yourdomainname.com/images/slide4.jpg ... etc</span>'); 
    define('CX_SLIDE_LINK','Slide Link(s) to');
    define('CX_DESC_SLIDE_LINK','Link to the page or site when the user clicks the slide. Eg: http://www.webgift.gr/');
    define('CX_SLIDE_LINK_TARGET','Slide Link(s) Target');
    define('CX_SLIDE_DIRECTORY','Images Directory');
    define('CX_DESC_SLIDE_DIRECTORY','Select a sub folder of \'mod_cu3er/slides\' which has your images. Default: \'modules/mod_cu3er/slides/\'');
    define('CX_DESC_SLIDE_LINK_TARGET','Where the linked slide will be opened: \'_blank\', \'_self\', \'_parent\', \'_top\'');
    define('CX_SLIDE_DESCRIPTION_HEADING','Heading(s)');
    define('CX_DESC_SLIDE_DESCRIPTION_HEADING','Text to display as heading text');
    define('CX_SLIDE_DESCRIPTION_PARAGRAPH','Description(s)');
    define('CX_DESC_SLIDE_DESCRIPTION_PARAGRAPH','Text to display as paragraph text');
    define('CX_SLIDE_DESCRIPTION_LINK','Description Link(s) to');
    define('CX_DESC_SLIDE_DESCRIPTION_LINK','Link to the page or site when the user clicks the description area');
    define('CX_SLIDE_DESCRIPTION_LINK_TARGET','Description Link(s) target');
    define('CX_DESC_SLIDE_DESCRIPTION_LINK_TARGET','Where the linked discription will be opened: \'_blank\', \'_self\', \'_parent\', \'_top\'');
    define('CX_PARAM_GENERAL_TRANSITION','Transition Settings <br /> <span style="color:#dd0000;font-weight:bold;">Note: </span><span style="font-weight:normal;">In case of Transition Type : Auto Generated then Module will generate the Transition automatically. Other Transition Type cases : None (No Transition) and Custom (Set Parameters Below). To enter more than one value in these parameters below, separate each of them by a vertical bar \' | \'. Example: value1 | value2 | | value4.  </span>');
    define('CX_TRANSITION_TYPE','Transition Type');
    define('CX_DESC_TRANSITION_TYPE','Choose one type from the list. Choose \'Customize\' if you want to config by yourself. Choose \'Auto Generated\' if you don\'t want to waste time.');
    define('CX_TRANSITION_TYPE_NONE','- None -');
    define('CX_TRANSITION_TYPE_AUTO','Auto Generated');
    define('CX_TRANSITION_TYPE_CUSTOM','Customize');
    define('CX_TRANSITION_NUM','Number(s)');
    define('CX_DESC_TRANSITION_NUM','Number of slices each transition consists of. Default: 1');
    define('CX_TRANSITION_SLICING','Slicing(s)');
    define('CX_DESC_TRANSITION_SLICING','Direction of cube slicing.Choose betweeen: horizontal or vertical. Default: horizontal');
    define('CX_TRANSITION_DIRECTION','Direction(s)');
    define('CX_DESC_TRANSITION_DIRECTION','Transition direction / cubes rotation direction. Options: left, right, up, down. Default: left');
    define('CX_TRANSITION_DURATION','Duration(s) [Seconds]');
    define('CX_DESC_TRANSITION_DURATION','Time (needed) for each sliced cube transition (in seconds). Default: 0.5');
    define('CX_TRANSITION_DELAY','Delay(s) [Seconds]');
    define('CX_DESC_TRANSITION_DELAY','Time each cube will wait before starting transition (in seconds). Default: 0.1');
    define('CX_TRANSITION_SHADER','Shader(s)');
    define('CX_DESC_TRANSITION_SHADER','Transition shading type : none, flat, phong. Default: none');
    define('CX_TRANSITION_LIGHT_POSITION','Light Position(s)');
    define('CX_DESC_TRANSITION_LIGHT_POSITION','Use this attribute to define x, y & z light position for shading (works only if shader is not set to \'none\'). Default: 0,0,-100');
    define('CX_TRANSITION_CUBER_COLOR','Cuber Color(s)');
    define('CX_DESC_TRANSITION_CUBER_COLOR','Cube faces color. Default: 0x333333');
    define('CX_TRANSITION_Z_MULTIPLIER','Z multiplier(s)');
    define('CX_DESC_TRANSITION_Z_MULTIPLIER','Effect over \'z\' axis during transition. Default: 2');   
    define('CX_PARAM_DESCRIPTION_BOX','Description Box Settings');
    define('CX_ENABLE_DESCRIPTION_BOX','Enable Description Box');
    define('CX_DESC_ENABLE_DESCRIPTION_BOX','Enable/Disable Description Box');
    define('CX_SWFFONT','Embedded Font');
    define('CX_DESC_SWFFONT','The font for displaying slide heading and paragraph text. Default : Yes but not supported in Greek Language');
    define('CX_DESCRIPTION_ROUND_CORNERS','Description box - Round Corners');     
    define('CX_DESC_DESCRIPTION_ROUND_CORNERS','Range from 0 to max. Enter comma (,) separated values for topLeftRadius, topRightRadius, bottomLeftRadius and bottomRightRadius. Default: 0, 0, 0, 0');
    define('CX_DESCRIPTION_HEADING_FONT','Heading Font');
    define('CX_DESC_DESCRIPTION_HEADING_FONT','System font-face name for heading text. Default: Georgia');
    define('CX_DESCRIPTION_HEADING_TEXT_SIZE','Heading Text size');
    define('CX_DESC_DESCRIPTION_HEADING_TEXT_SIZE','Text size in pixels. Default: 18');
    define('CX_DESCRIPTION_HEADING_TEXT_COLOR','Heading Color');     
    define('CX_DESC_DESCRIPTION_HEADING_TEXT_COLOR','Hexdecimal number. Color of the text. Default: 0xFFFFFF which is the White Color');
    define('CX_DESCRIPTION_HEADING_TEXT_ALIGN','Heading Text Align');
    define('CX_DESC_DESCRIPTION_HEADING_TEXT_ALIGN','Range: \'left\', \'center\', \'right\' align of the text in text field. Default: left');
    define('CX_DESCRIPTION_HEADING_TEXT_MARGIN','Heading Text Margin');
    define('CX_DESC_DESCRIPTION_HEADING_TEXT_MARGIN','Text margin: top, right, bottom, left. Default: 10, 25, 0, 25');
    define('CX_DESCRIPTION_HEADING_TEXT_LEADING','Heading Text Leading');     
    define('CX_DESC_DESCRIPTION_HEADING_TEXT_LEADING','Text leading. Default: 0');
    define('CX_DESCRIPTION_HEADING_TEXT_LETTERSPACING','Heading Text Letter Spacing');
    define('CX_DESC_DESCRIPTION_HEADING_TEXT_LETTERSPACING','Letter spacing. Default: 0');
    define('CX_DESCRIPTION_PARAGRAPH_FONT','Description Font');
    define('CX_DESC_DESCRIPTION_PARAGRAPH_FONT','System font-face name for paragraph text. Default: Arial');
    define('CX_DESCRIPTION_PARAGRAPH_TEXT_SIZE','Description Text Size');
    define('CX_DESC_DESCRIPTION_PARAGRAPH_TEXT_SIZE','Text size in pixels. Default: 12');
    define('CX_DESCRIPTION_PARAGRAPH_TEXT_COLOR','Description Color');
    define('CX_DESC_DESCRIPTION_PARAGRAPH_TEXT_COLOR','Hexdecimal number. Color of the text. Default: 0xFFFFFF which is the White Color');
    define('CX_DESCRIPTION_PARAGRAPH_TEXT_ALIGN','Description Text Align');
    define('CX_DESC_DESCRIPTION_PARAGRAPH_TEXT_ALIGN','Range: \'left\', \'center\', \'right\' align of the text in text field. Default: left');
    define('CX_DESCRIPTION_PARAGRAPH_TEXT_MARGIN','Description Text Margin');     
    define('CX_DESC_DESCRIPTION_PARAGRAPH_TEXT_MARGIN','Text margin: top, right, bottom, left. Default: 5, 25, 0, 25');
    define('CX_DESCRIPTION_PARAGRAPH_TEXT_LEADING','Description Text Leading');
    define('CX_DESC_DESCRIPTION_PARAGRAPH_TEXT_LEADING','Text leading. Default: 0');
    define('CX_DESCRIPTION_PARAGRAPH_TEXT_LETTERSPACING','Description Text Letter Spacing');
    define('CX_DESC_DESCRIPTION_PARAGRAPH_TEXT_LETTERSPACING','Letter spacing. Default: 0');
    define('CX_PARAM_BUTTONS_N_SYMBOLS','Auto Play Settings');     
    define('CX_ENABLE_AUTO_PLAY','Auto Play');
    define('CX_DESC_ENABLE_AUTO_PLAY','Enable/Disable Auto Play');
    define('CX_AUTO_PLAY_SYMBOL','Auto Play Symbol');
    define('CX_DESC_AUTO_PLAY_SYMBOL','Graphical auto play indicator. Available values: \'circular\' or \'linear\'');
    define('CX_SYMBOL_LINEAR','Linear');
    define('CX_SYMBOL_CIRCULAR','Circular');     
    define('CX_AUTO_PLAY_TIME_DEFAULTS','Auto Play Time');
    define('CX_DESC_AUTO_PLAY_TIME_DEFAULTS','Auto play cycle automatically through the slides after the specified period of time (in seconds)');
    define('CX_ENABLE_PRELOADER','Preloader');
    define('CX_DESC_PRELOADER','Enable/Disable Preloader');
    define('CX_PRELOADER_SYMBOL','Preloader Symbol');
    define('CX_DESC_PRELOADER_SYMBOL','Graphical preloader indicator. Available values: \'circular\' or \'linear\'');
    define('CX_ENABLE_PREV_BUTTON','Previous Button');
    define('CX_DESC_ENABLE_PREV_BUTTON','Show/Hide Previous Button');
    define('CX_PARAM_PREV_BUTTON','Previous Button Parameters');
    define('CX_PREV_BUTTON_ROUND_CORNERS','Previous button - Round Corners');
    define('CX_DESC_PREV_BUTTON_ROUND_CORNERS','Range from 0 to max. Enter comma separated values for topLeftRadius, topRightRadius, bottomLeftRadius and bottomRightRadius. Default: 0, 0, 0, 0');
    define('CX_PARAM_HEADER_SET','Heading Parameters');
    define('CX_PREV_BUTTON_POSITION','Previous Button Position [x,y]');
    define('CX_DESC_PREV_BUTTON_POSITION','Set the position of Previous button giving the x and y position. Default: 65,300');  
    define('CX_ENABLE_PREV_SYMBOL','Previous Symbol');
    define('CX_DESC_ENABLE_PREV_SYMBOL','Show/Hide Previous Symbol');     
    define('CX_PREV_SYMBOL_TYPE','Previous Symbol Type');
    define('CX_DESC_PREV_SYMBOL_TYPE','Range from 1 to 10. Numeric representation of available symbols');
    define('CX_PARAM_NEXT_BUTTON','Next Button Parameters');
    define('CX_ENABLE_NEXT_BUTTON','Next Button');
    define('CX_DESC_ENABLE_NEXT_BUTTON','Show/Hide Next Button');
    define('CX_NEXT_BUTTON_ROUND_CORNERS','Next button - Round Corners');
    define('CX_NEXT_BUTTON_POSITION','Next Button Position [x,y]');
    define('CX_NEXT_PREV_BUTTON_POSITION','Set the positions of Next button giving the x and y position. Default: 95,300');    
    define('CX_DESC_NEXT_BUTTON_ROUND_CORNERS','Range from 0 to max. Enter comma separated values for topLeftRadius, topRightRadius, bottomLeftRadius and bottomRightRadius. Default: 0, 0, 0, 0');     
    define('CX_ENABLE_NEXT_SYMBOL','Next Symbol');
    define('CX_DESC_ENABLE_NEXT_SYMBOL','Show/Hide Next Symbol');
    define('CX_NEXT_SYMBOL_TYPE','Next Symbol Type');
    define('CX_DESC_NEXT_SYMBOL_TYPE','Range from 1 to 10. Numeric representation of available symbols');
    define('CX_PARAM_DEBUG','Debug Settings');
    define('CX_ENABLE_DEBUG','Debug');     
    define('CX_DESC_ENABLE_DEBUG','Enable/Disable Debug');
    define('CX_DEBUG_X','X Position');
    define('CX_DESC_DEBUG_X','x position of debug/stats panel');
    define('CX_DEBUG_Y','Y Position');
    define('CX_DESC_DEBUG_Y','y position of debug/stats panel');
    define('CX_PARAM_PERFORMANCE_SETTINGS','Module Performance');
    define('CX_SWFOBJECT','Performance Settings');
    define('CX_DESC_SWFOBJECT','Use SWFObject Library to detect Flash Player versions and embedding SWF files. You can use the file on your hosting (Local) or Google hosting.');
    define('CX_SWFOBJECT_NONE_SELECTED','- None Selected -');
    define('CX_SWFOBJECT_INTERNAL20','Local (v2.0)');
    define('CX_SWFOBJECT_INTERNAL21','Local (v2.1)');
    define('CX_SWFOBJECT_INTERNAL22','Local (v2.2)');     
    define('CX_SWFOBJECT_EXTERNAL21','Google code (v2.1)');
    define('CX_SWFOBJECT_EXTERNAL22','Google code (v2.2)');
}
?>