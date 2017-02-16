<?php 

/* Easy Slider module v.1.2 for Elxis CMS
*  Copyright (C) 2010 www.osw.gr - All rights reserved.
*  Licence GNU/GPL
*  
*  Based on jQuery plugin written by Alen Grakalic (http://cssglobe.com/post/5780/easy-slider-17-numeric-navigation-jquery-slider)
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

define('CX_MODEASY_DESC','
  <p align="justify"><strong>Easy Slider</strong> is a jQuery plugin written by Alen Grakalic	<a href="http://cssglobe.com/post/5780/easy-slider-17-numeric-navigation-jquery-slider" target="_blank">
  (http://cssglobe.com/post/5780/easy-slider-17-numeric-navigation-jquery-slider)</a>.<strong><br /><br />Here is presented a free module version for Elxis CMS</strong> by which you can slide horizontaly 
  or verticaly up to 12 content items which can have title, image, alternate text for the image, main text and an internal or external link of type "Read more...".<br /><br />
  At the latest version 1.2 have been added new functions which are described below, as well the possibility of display double slider with different parameters each one. Example: One horizontal slider 
  and one vertical.<br /><br /> Depended from module position where you will set slider to be displayed, the width of images (if exist and have been set), the text size (in lines) and the sliding orientation 
  (horizontal or vertical), you have to set the proportion width and height of the slider. For setting images you have to create into images folder of Elxis installation, a folder called easyslider, where you 
  have to load all images. At the parameter "container image width" is proposed to set an absolute value increased by 10, in relation with every image width, so to create a distance of 10px between image and 
  main text. If you do not want to display an image into a content item of the slider, select - Do not use an image - and will be displayed only the text, with full slider width. You can also display only image, 
  if you do not insert text at all. If you insert only image and link, then the link is applied on image. If you insert title, image and link, then the link is applied on both of them. If you insert title, image, 
  text and link, then the link is applied on title and on phrase of type "Read more...". In case for link on image, you can display (on mouse over) as alternate text whatever you insert into corresponding field, 
  which if you let empty, then instead of this, will be displayed the phrase "Read more...". All fields (title, image, text, link) of sliding items, are independent as settings and you can display each one 
  autonomicly, without any one to demand existence of the rest.<br /><br /> Easy Slider is compatible with Elxis 2008.x and 2009.x as well with PHP 5.x and is displayed the same well to all modern Browsers. It is also 
  compatible with RTL languages, only for vertical sliding. Even Easy Slider uses jQuery, can be used at the same time and at the same page, without to cause javascript conflict, with other applications which also 
  use similar javascript, such as IOS Gallery, IOS Downloads, IOS eshop e.t.c.<br /><br />
  <strong>Easy Slider Control Settings</strong><br /><br />
  1.  Width - Height<br />
  2.  Background Color<br />
  3.  Sliding orientation (horizontal or vertical)<br />
  4.  Sliding speed in miliseconds<br />
  5.  Time of sliding pause in miliseconds<br />
  6.  Automatic sliding<br />
  7.  Continuous sliding<br />
  8.  Partial and selective display ammong 12 content items<br />
  9.  Control display of fields (title, image, alternate text image, text, link) for any sliding item<br />
  10. Navigation with arrows or numbers<br />
  11. Show or hide navigation<br /><br />
  <strong>Manual</strong>: <a href="http://wiki.elxis.org/wiki/Easy_Slider" target="_blank">http://wiki.elxis.org/wiki/Easy_Slider</a><br /><br />
  Easy Slider module v. 1.2 for Elxis CMS: Copyright (C) 2011 <a href="http://www.osw.gr" target="_blank">http://www.osw.gr</a> - All rights reserved - Licence GNU/GPL</p>');
define('CX_MODEASY_CTRL','Easy Slider Control');
define('CX_MODEASY_ORIENT','Sliding orientation');
define('CX_MODEASY_ORIENT_DESC','Select sliding orientation (Horizontal or Vertical) (Default value: Horizontal).');
define('CX_MODEASY_HOR','Horizontal');
define('CX_MODEASY_VER','Vertical');
define('CX_MODEASY_SPEED','Sliding speed in miliseconds');
define('CX_MODEASY_SPEED_DESC','Select a value for sliding speed. As much is increased absolute value, the sliding speed is decreased (Default value: 800).');
define('CX_MODEASY_AUTO','Automatic sliding');
define('CX_MODEASY_AUTO_DESC','Select if you want automatic or manual sliding (Default value: Yes - Automatic).');
define('CX_MODEASY_PAUSE','Sliding pause in miliseconds');
define('CX_MODEASY_PAUSE_DESC','Select a value for sliding pause. This parameter is set in milliseconds and it represents the duration of each slide when plugin is set to auto sliding (Default value: 2000).');
define('CX_MODEASY_CONT','Continuous sliding');
define('CX_MODEASY_CONT_DESC','Select if you want continuous sliding (Default value: Yes - Continuous).');
define('CX_MODEASY_NUM','Navigation with numbers or arrows');
define('CX_MODEASY_NUM_DESC','Select if you want to be diplayed numbers or arrows for navigation (Default value: Numbers).');
define('CX_MODEASY_NUMBERS','Numbers');
define('CX_MODEASY_ARROWS','Arrows');
define('CX_MODEASY_NUMSLIDES','Number of sliding content items');
define('CX_MODEASY_NUMSLIDES_DESC','Select the number of sliding content items (Default value: 3).');
define('CX_MODEASY_CTRLSHOW','Display navigation');
define('CX_MODEASY_CTRLSHOW_DESC','Select if you want to display or hide navigation arrows or numbers (Default value: Yes).');
define('CX_MODEASY_SLW','Slider width in pixels');
define('CX_MODEASY_SLW_DESC','Set absolute value of slider width (Default value: 190).');
define('CX_MODEASY_SLH','Slider height in pixels');
define('CX_MODEASY_SLH_DESC','Set absolute value of slider height (Default value: 260).');
define('CX_MODEASY_BGCLR','Background color');
define('CX_MODEASY_BGCLR_DESC','Set a background color for the slider (Default value: transparent).');
define('CX_MODEASY_CONTITS','Content Items');
define('CX_MODEASY_LIST','Display content item');
define('CX_MODEASY_LIST_DESC','Select if will be displayed content item (Default value: No).');
define('CX_MODEASY_IMG','Image');
define('CX_MODEASY_IMG_DESC','Select image (Default value: Do not use an image).');
define('CX_MODEASY_CIMGW','Container image width in pixels');
define('CX_MODEASY_CIMGW_DESC','Set absolute value of container image width. Is proposed to set an absolute value increased by 10, so to create a distance of 10px between image and main text.(Default value: 130).');
define('CX_MODEASY_TITLE','Title');
define('CX_MODEASY_TITLE_DESC','Type the title of content item');
define('CX_MODEASY_ALT','Alternate text for the image');
define('CX_MODEASY_ALT_DESC','Type an alternate text for the image');
define('CX_MODEASY_TEXT','Text');
define('CX_MODEASY_TEXT_DESC','Type the text of content item');
define('CX_MODEASY_LINK','Link (Read more...)');
define('CX_MODEASY_LINK_DESC','Type the link for Read more...');
define('CX_MODEASY_TARGET','Target link');
define('CX_MODEASY_TARGET_DESC','Select target link (Default value: Internal).');
define('CX_MODEASY_SELF','Internal (Self)');
define('CX_MODEASY_BLANK','External (New window)');
?>