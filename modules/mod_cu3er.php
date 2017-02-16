<?php 
/**
* $Id: mod_cu3er.php 342 2011-03-13 14:08:01Z stratakisS $
* @package: Module Cu3er
* @author: WebGift Web Services
* @email: info@webgift.gr
* @link: http://www.webgift.gr
* @license: GNU / GPL
* @copyright: (C) 2007 - 2011 WebGift Web Services. All rights reserved
* @description: CU3ER™ is the Flash® 3D image slider, EASY to set up, fully CUSTOMIZABLE, TAILORED to provide a UNIQUE look & feel, INSPIRING and FUN-to-USE. Play with CU3ER! Its 3D magic is awesome.
******************************************************************************************************************************************************************************************************/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

if (!class_exists('modCuber')) {
    class modCuber {
        private $errormsg = '';
        private $copyright = 1;
        private $concustom = '';
        private $pwidth = 960;
        private $pheight = 360;
        private $phoralign = 'left';
        private $pveralign = 'center';
        private $vistime = 3;
        private $moddir = '';
        private $ssl_live_site = '';
        private $sslmoddir = '';
        private $endebug = 0;
        private $debug_x = 5;
        private $debug_y = 5;
        private $enautoplay = 1;
        private $autoplaysymbol = 'circular';
        private $autoplaytimedefaults = 5;
        private $enpreloader = 1;
        private $preloader_symbol = 'circular';
        private $enprevbutton = 1;
        private $prevbuttonroundcorners = '0,0,0,0';
        private $enableprevsymbol = 1;
        private $prevposition = '65,300';
        private $px = 65;
        private $py = 300;
        private $prevsymboltype = 6;
        private $ennextbutton = 1;
        private $nextbuttonroundcorners = '0,0,0,0';
        private $enablenextsymbol = 1;
        private $nextposition = '95,300';
        private $nx = 95;
        private $ny = 300;
        private $nextsymboltype = 6;
        private $swfobject = '2.2';
        private $enable_description_box = 1;
        private $descroundcorners = '0,0,0,0';
        private $descparfont = 'Arial';
        private $descheadfont = 'Georgia';
        private $descheadtxtsize = 18;
        private $descpartxtsize = 12 ;
        private $descheadtxtcolor = '0xFFFFFF';
        private $descpartxtcolor = '0xFFFFFF';
        private $descheadtxtalign = 'left';
        private $descpartxtalign = 'left';
        private $descheadtxtmargin = '10,25,0,25';
        private $descpartxtmargin = '5,25,0,25';
        private $descheadtxtleading = 0;
        private $descpartxtleading = 0;
        private $descheadtxtlspace = 0;
        private $descpartxtlspace = 0;
        private $swffont = 1;
        private $slide_dir = '';
        private $slurl = '';
        private $images = array();
        private $sllink = '';
        private $limages = array();
        private $sllinktarget = '';
        private $sltarget = array();
        private $sldeshead = '';
        private $headings = array();
        private $sldespar = '';
        private $paragraphs = array();
        private $sldeslink = '';
        private $parlinks = array();
        private $sldeslinktar = '';
        private $parlinkstarget = array();
        private $trantype = 'auto';
        private $num = array();
        private $slicing = array();
        private $direction = array();
        private $duration = array();
        private $delay = array();
        private $shader = array();
        private $light_position = array();
        private $cube_color = array();
        private $z_multiplier = array();
        private $trannum = '';
        private $translicing = '';
        private $trandirection = '';
        private $tranduration = '';
        private $trandelay = '';
        private $transhader = '';
        private $tranligposition = '';
        private $transcubecolor = '';
        private $tranzmulti = '';
        
        
		/***************/
		/* CONSTRUCTOR */
		/***************/
		public function __construct($params) {  	
			$this->getConfig($params);
		}

                
		/********************************/
		/* GET CONFIGURATION PARAMETERS */
		/********************************/
		private function getConfig($params) {
		  global $mainframe;
          
          $this->getModDir();
          $configxml = $mainframe->getCfg('absolute_path').'/modules/mod_cu3er/config/config.xml';
          if(!file_exists($configxml)){$this->errormsg = 'File: config.xml doesn\'t exists at folder : /modules/mod_cu3er/config/';}
          $this->copyright = (int)$params->get('copyright', 1);
          $this->concustom = trim($params->get('concustom', ''));
          $pat = "#([\']|[\"]|[\$]|[\#]|[\<]|[\>]|[\*]|[\%]|[\~]|[\`]|[\^]|[\|]|[\{]|[\}]|[\\\])#";
		  $file = preg_replace($pat, '', $this->concustom);
		  $parts = preg_split('/\./', $this->concustom, 2, PREG_SPLIT_NO_EMPTY);
          if($parts && is_array($parts) && count($parts) > 1){$this->errormsg = 'Write the filename only at Custom XML Field.';}
          if(strlen($this->concustom) > 0){           
            $folderexist = $mainframe->getCfg('absolute_path').'/modules/mod_cu3er/config/'.$this->concustom.'.xml';
            if(!file_exists($folderexist)){$this->errormsg = 'The filename: '.$this->concustom.'.xml at folder: /modules/mod_cu3er/config/ doesn\'t exist';}
          }
          if($this->concustom == 'config'){$this->errormsg = 'Can\'t use the filename config at Config XML field';}
          $this->pwidth = (int) trim($params->get('pwidth', 960));
          if($this->pwidth < 0) {$this->errormsg = 'Panel Width must be a positive number';}
          if($this->pwidth < 100 ) {$this->pwidth = 100;}
          $this->pheight = (int) trim($params->get('pheight', 360));
          if($this->pheight < 0) {$this->errormsg = 'Panel Height must be a positive number';}
          if($this->pheight < 100 ) {$this->pheight = 100;}
          $this->phoralign = $params->get('phoralign', 'left');
          $this->pveralign = $params->get('pveralign', 'center');
          $this->vistime = (int) trim($params->get('vistime', 3));
          if($this->vistime < 0) {$this->errormsg = 'Visible Time must be a positive number';}
          if($this->vistime < 1 ) {$this->vistime = 3;}
          if($this->pwidth == '' || $this->pheight == '' ){$this->errormsg = 'Some General fields are empty or have negative values. Please fill out. For Example: Panel Width, Panel Height or Visible time';}
          $this->endebug = $params->get('endebug', 0);
          $this->debug_x = (int) trim($params->get('debug_x', 5));
          $this->debug_y = (int) trim($params->get('debug_x', 5));
          if($this->debug_x < 0 || $this->debug_y < 0) {$this->debug_x = 0; $this->debug_y = 0;}
          if($this->debug_x == '' || $this->debug_y == ''){$this->errormsg = 'Debug position X and Y must be set.';}
          $this->enautoplay = $params->get('enautoplay', 1);
          $this->autoplaysymbol = $params->get('autoplaysymbol', 'circular');
          $this->autoplaytimedefaults = $params->get('autoplaytimedefaults', 5);
          if($this->autoplaytimedefaults < 0) {$this->autoplaytimedefaults = 0;}
          $this->enpreloader = $params->get('enpreloader', 1);
          $this->preloader_symbol = $params->get('preloader_symbol', 'circular');
          $this->enprevbutton = $params->get('enprevbutton', 1);
          $this->prevbuttonroundcorners = trim($params->get('prevbuttonroundcorners', '0,0,0,0'));
          $this->checkParams(',', $this->prevbuttonroundcorners, 4);
          $this->enableprevsymbol = $params->get('enableprevsymbol', 1);
          $this->prevposition = trim($params->get('prevposition', '95,300'));
          $this->checkParams(',', $this->prevposition, 2); 
          if($this->checkParams(',', $this->prevposition, 2) == 1){
            $parts = preg_split('/,/', $this->prevposition);
            if ($parts && is_array($parts) && (count($parts) == 2)) {
              $this->px = $parts[0];
              $this->py = $parts[1];  
            }
          }
          $this->prevsymboltype = (int) $params->get('prevsymboltype', 6);
          $this->ennextbutton = $params->get('ennextbutton', 1);
          $this->nextbuttonroundcorners = trim($params->get('nextbuttonroundcorners', '0,0,0,0'));
          $this->checkParams(',', $this->nextbuttonroundcorners, 4);
          $this->enablenextsymbol = $params->get('enablenextsymbol', 1);
          $this->nextposition = trim($params->get('nextposition', '65,300'));
          $this->checkParams(',', $this->nextposition, 2); 
          if($this->checkParams(',', $this->nextposition, 2) == 1){
            $parts = preg_split('/,/', $this->nextposition);
            if ($parts && is_array($parts) && (count($parts) == 2)) {
              $this->nx = $parts[0];
              $this->ny = $parts[1];  
            }
          }
          $this->nextsymboltype = (int) $params->get('nextsymboltype', 6);
          $this->swfobject = $params->get('swfobject', '2.2');
          $this->enable_description_box = (int) $params->get('enable_description_box', 1);
          $this->descroundcorners = trim($params->get('descroundcorners', '0,0,0,0'));
          $this->checkParams(',', $this->descroundcorners, 4);
          $this->descparfont = trim($params->get('descparfont', 'Arial'));
          if($this->descparfont == ''){$this->descparfont = 'Arial';}
          $this->descheadfont = trim($params->get('descheadfont', 'Georgia'));
          if($this->descheadfont == ''){$this->descheadfont = 'Georgia';}
          $this->descheadtxtsize = (int) trim($params->get('descheadtxtsize', 18));
          if($this->descheadtxtsize < 10 || $this->descheadtxtsize == ''){$this->descheadtxtsize = 18;}
          $this->descpartxtsize = (int) trim($params->get('descpartxtsize', 12));
          if($this->descpartxtsize < 8 || $this->descpartxtsize == ''){$this->descpartxtsize = 10;}
          $this->descheadtxtcolor = (string) trim($params->get('descheadtxtcolor', '0xFFFFFF'));
          if($this->descheadtxtcolor == ''){$this->descheadtxtcolor = '0x000000';}
          $this->descpartxtcolor = (string) trim($params->get('descpartxtcolor', '0xFFFFFF'));
          if($this->descpartxtcolor == ''){$this->descpartxtcolor = '0x000000';}
          $this->descheadtxtalign = $params->get('descheadtxtalign', 'left');
          $this->descpartxtalign = $params->get('descpartxtalign', 'left');
          $this->descheadtxtmargin = trim($params->get('descheadtxtmargin', '10,25,0,25'));
          $this->checkParams(',', $this->descheadtxtmargin, 4);
          $this->descpartxtmargin = trim($params->get('descpartxtmargin', '5,25,0,25'));
          $this->checkParams(',', $this->descpartxtmargin , 4);
          $this->descheadtxtleading = (int) trim($params->get('descheadtxtleading', 0));
          if($this->descheadtxtleading == '' || $this->descheadtxtleading < 0){$this->descheadtxtleading = 0;}
          $this->descpartxtleading = (int) trim($params->get('descpartxtleading', 0));
          if($this->descpartxtleading < 0 || $this->descpartxtleading == ''){$this->descpartxtleading = 0;}
          $this->descheadtxtlspace = (int) trim($params->get('descheadtxtlspace', 0));
          if($this->descheadtxtlspace == '' || $this->descheadtxtlspace < 0){$this->descheadtxtlspace = 0;}
          $this->descpartxtlspace = (int) trim($params->get('descpartxtlspace', 0));
          if($this->descpartxtlspace == '' || $this->descpartxtlspace < 0){$this->descpartxtlspace = 0;}
          $this->swffont = $params->get('swffont', 1);          
          $this->slide_dir = trim($params->get('slide_dir', ''));
          if($this->slide_dir !=''){
            $this->slide_dir = preg_replace('/^(\/)/','',$this->slide_dir);
            $this->slide_dir = preg_replace('/(\/)$/','',$this->slide_dir);
          }
          $this->slurl = trim($params->get('slurl', ''));
          if(!preg_match('/^http/i', $this->slurl) && $this->slurl != ''){$this->slurl = 'http';}
          if(!preg_match('/^|/i', $this->slurl) && $this->slurl != ''){$this->errormsg = 'Use | character at Image Urls Field';};
          if($this->slide_dir == '' && $this->slurl == '' && $this->concustom == ''){
            $this->concustom = 'demo1';
          }
          if($this->slide_dir != ''){
            $this->getImagesDirectory();
          }elseif($this->slurl != ''){
            $this->getImagesText();
          }
          $this->sllink = trim($params->get('sllink', ''));
          if(!preg_match('/^http/i', $this->sllink) && !preg_match('/^|/i', $this->sllink) && $this->sllink !=''){
            $this->errormsg = 'Please use http:// at Linkable Images ';
          }else{
            $this->limages = explode('|', $this->sllink);
          }
          $this->sllinktarget = trim($params->get('sllinktarget', ''));
          if(!preg_match('/^_/i', $this->sllinktarget) && !preg_match('/^|/i', $this->sllinktarget) && $this->sllinktarget != ''){
             $this->errormsg = 'Please use _ before the target or | seperating the targets ';
          }else{
             $this->sltarget = explode('|', $this->sllinktarget);
          }
          $this->sldeshead = trim($params->get('sldeshead', ''));
          if(!preg_match('/^|/i', $this->sldeshead) && $this->sldeshead != ''){
            $this->errormsg = 'Seperate the headings of each slide using | character';
          }else{
            $this->headings = explode('|', $this->sldeshead);
          }
          $this->sldespar = trim($params->get('sldespar', ''));  
          if(!preg_match('/^|/i', $this->sldespar) && $this->sldespar != ''){
            $this->errormsg = 'Seperate the Paragraphs using | character';
          }else{
            $this->paragraphs = explode('|', $this->sldespar); 
          }
          $this->sldeslink = trim($params->get('sldeslink', ''));
          if(!preg_match('/^http/i', $this->sldeslink) && !preg_match('/^|/i', $this->sldeslink) && $this->sldeslink !=''){
            $this->errormsg = 'Please use http:// at Linkable Description Field';
          }else{
            $this->parlinks = explode('|', $this->sldeslink);
          }
          $this->sldeslinktar = trim($params->get('sldeslinktar', ''));
          if(!preg_match('/^_/i', $this->sldeslinktar) && !preg_match('/^|/i', $this->sldeslinktar) && $this->sldeslinktar != ''){
             $this->errormsg = 'Please use _ before the target or | seperating the targets ';
          }else{
             $this->parlinkstarget = explode('|', $this->sldeslinktar);
          }
          $this->trantype = $params->get('trantype', 'auto');
         if($this->trantype == 'custom'){
            $this->trannum = trim($params->get('trannum', ''));
            $this->translicing = trim($params->get('translicing', ''));
            $this->trandirection = trim($params->get('trandirection', ''));
            $this->tranduration = trim($params->get('tranduration', ''));
            $this->trandelay = trim($params->get('trandelay', ''));
            $this->transhader = trim($params->get('transhader', ''));
            $this->tranligposition = trim($params->get('tranligposition', ''));
            $this->transcubecolor = trim($params->get('transcubecolor', ''));
            $this->tranzmulti = trim($params->get('tranzmulti', ''));            
         }
         $this->getTransition(); 
        }
        
        
		/*****************************************************************/
		/* CHECK REGISTERED PARAMETERS REQUIRED SYMBOLS LIKE (,) AND (|) */
		/*****************************************************************/        
        private function checkParams($symbol=',',$string='',$must=4){
            
            $check = array();
            $check = explode($symbol,$string);
            mosArrayToInts($check);
            if(count($check) != $must){
                $this->errormsg = 'Define the lenth of registered parameter : '.$string.'. The length of that parameter must be  '.$must.' integers and seperated them by ( '.$symbol.' )';
            }else{
                return 1;
                unset($check);  
            }
        }
        

		/******************************/
		/* TRANSITION EFFECTS BY TYPE */
		/******************************/
        private function getTransition(){
            
            if(count($this->images) > 0){
                switch($this->trantype){
                    case 'auto':
                    default :
                    $num = '||3|4|6|6|4|4||3';
                    $slicing = '||horizontal||horizontal|vertical|horizontal||||';
                    $direction = 'left|down|left||right|down|down|up|right|up';
                    $duration = '|0.6|||0.8||||||';
                    $delay = '|0.2|0.05||0.05|0.05|0.1|0.03|||';
                    $shader = '|||||phong|||||';
                    $z_multiplier ='||||5||6|2.5|||';
                    $this->num = explode('|', $num);
                    $this->slicing = explode('|', $slicing);
                    $this->direction = explode('|', $direction);
                    $this->duration = explode('|', $duration);
                    $this->delay = explode('|', $delay);
                    $this->shader = explode('|', $shader);
                    $this->z_multiplier = explode('|', $z_multiplier);
                    break;
                    case 'custom':
                    $this->num = explode('|', $this->trannum);
                    $this->slicing = explode('|', $this->translicing);
                    $this->direction = explode('|', $this->trandirection);
                    $this->duration = explode('|', $this->tranduration);
                    $this->delay = explode('|', $this->trandelay);
                    $this->shader = explode('|', $this->transhader);
                    $this->light_position = explode('|', $this->tranligposition);
                    $this->cube_color = explode('|', $this->transcubecolor);
                    $this->z_multiplier = explode('|', $z_multiplier);
                    break;
                }
            }
        }   
        
        
		/**************************************/
		/* GET IMAGES FROM SPECIFIC DIRECTORY */
		/**************************************/         
        private function getImagesDirectory(){
            global $mainframe,$fmanager;
            
            if($this->slide_dir == ''){
                $this->errormsg = 'Image Directory can\'t be empty';
            }
            $cdir = $mainframe->getCfg('absolute_path').'/modules/mod_cu3er/slides/'.$this->slide_dir.'/';
            if(!file_exists($cdir) && !is_dir($cdir)){
                $this->errormsg = 'Images folder ( modules/mod_cu3er/slides/'.$this->slide_dir.'/ ) does not exist!';
            }
            $ifiles = $fmanager->listFiles($cdir, "((\.jpg)|(\.jpeg)|(\.png)|(\.gif)|(\.JPG)|(\.PNG)|(\.JPEG)|(\.GIF))$");
			if (!$ifiles || (count($ifiles) == 0)) {
                $this->errormsg = 'No images found in folder modules/mod_cu3er/slides/'.$this->slide_dir.'/';
				
			}
            $i = 1;
            $iurl = $this->ssl_live_site.'/modules/mod_cu3er/slides/'.$this->slide_dir.'/';
            foreach($ifiles as $ifile){
                $this->images[$i]['file'] = $iurl.$ifile;
                $i++;
            }
            
            if (count($this->images) == 0) { $this->errormsg = 'No images at folder modules/mod_cu3er/slides/'.$this->slide_dir.'/ to slide!'; }
            
        }


		/******************************/
		/* GET IMAGES FROM TEXT FIELD */
		/******************************/         
        private function getImagesText(){
            global $mainframe,$fmanager;
            
            if($this->slurl == ''){
                $this->errormsg = 'Image URL Field can\'t be empty';
            }
            if($this->slurl == 'http'){
                $this->errormsg = 'Please use http:// at Image URLs or Set a Specific Directory';
            }
            $iurls = explode('|', $this->slurl);
            
            $i = 1;
            foreach($iurls as $iurl){
                $this->images[$i]['file'] = $iurl;
                $i++;
            }
            if (count($this->images) == 0) { $this->errormsg = 'No images to slide!'; }
            
        }
                
        
		/************************/
		/* GET MODULE DIRECTORY */
		/************************/        
        private function getModDir(){
            global $mainframe;
            
            $this->moddir = $mainframe->getCfg('live_site').'/modules/mod_cu3er';
			$this->ssl_live_site = $mainframe->getCfg('live_site');
			$ssl = false;
			if (isset($_SERVER['HTTPS'])) {
				if (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == 1)) {
					$ssl = true;
				}
			} else if (isset($_SERVER['SERVER_PORT']) && ($_SERVER['SERVER_PORT'] == 443)) {
				$ssl = true;
			}
			if ($ssl === true) {
				$this->ssl_live_site = preg_replace('/^(http\:)/i', 'https:', $mainframe->getCfg('live_site'));
				$this->sslmoddir = $this->ssl_live_site.'/modules/mod_cu3er';
			} else {
				$this->sslmoddir = $this->moddir;
			}            
        }
         
          
        /*****************/
		/* ERROR MESSAGE */
		/*****************/
		private function errorScreen() {
			echo '<div style="margin: 2px; padding: 3px; border: 1px solid #dd0000; color: #000000; background-color: #FFF;">'."\n";
			echo '<span style="font-weight:bold; color: #DD0000;">'._ELX_ERROR." from CU3ER module :</span><br />\n";
			echo ($this->errormsg != '') ? $this->errormsg : 'Unknown error';
			echo "</div>\n";
		}
        

		/*************************/
		/* EXPORT XML CU3ER FILE */
		/*************************/ 
        private function exportXML(){
            global $mainframe;
            
            $xmlfile = $mainframe->getCfg('absolute_path').'/modules/mod_cu3er/config/config.xml';
            $data = $this->createXML();
            $fp = fopen($xmlfile,"w");
            fwrite($fp,$data);
            fclose($fp);
        }


		/***************************/
		/* CHECK IF PARAMS CHANGED */
		/***************************/         
        private function checkSum(){
            global $mainframe;
            
            $txtf = $mainframe->getCfg('absolute_path').'/modules/mod_cu3er/config/changed.txt';
            $genset = $this->pheight.$this->pwidth.$this->phoralign.$this->pveralign.$this->vistime;
            $debset = $this->endebug.$this->debug_x.$this->debug_y;
            $autoset = $this->enautoplay.$this->autoplaysymbol.$this->autoplaytimedefaults;
            $preloadset = $this->enpreloader.$this->preloader_symbol;
            $buttonsetprev = $this->enprevbutton.$this->prevbuttonroundcorners.$this->enableprevsymbol.$this->prevposition.$this->prevsymboltype;
            $buttonsetnext = $this->ennextbutton.$this->nextbuttonroundcorners.$this->enablenextsymbol.$this->nextposition.$this->nextsymboltype;
            $description1 = $this->enable_description_box.$this->descroundcorners.$this->descheadfont.$this->descheadtxtsize.$this->descheadtxtcolor.$this->descpartxtcolor.$this->descheadtxtalign;
            $description2 = $this->descpartxtalign.$this->descheadtxtmargin.$this->descpartxtmargin.$this->descheadtxtleading.$this->descpartxtleading.$this->descheadtxtlspace.$this->descpartxtlspace;
            $images = $this->slide_dir.$this->slurl.$this->sllink.$this->sllinktarget.$this->sldeshead.$this->sldespar.$this->sldeslink.$this->sldeslinktar;
            if($this->trantype == 'custom'){
                $customtransd = $this->trannum.$this->translicing.$this->trandirection.$this->tranduration.$this->trandelay.$this->transhader.$this->tranligposition.$this->transcubecolor.$this->tranzmulti;
            }else{
                $customtransd = '';
            }
            $transition = $this->trantype.$customtransd;
            $chechparams = $genset.$debset.$autoset.$preloadset.$buttonsetprev.$buttonsetnext.$description1.$description2.$images.$transition;
            $checksum = md5($chechparams);
            $handle = fopen($txtf, "r");
            $saved_checksum = fread($handle, filesize($txtf));
            fclose($handle);
            
            if($saved_checksum != $checksum){
                $this->exportXML();
                $updatetxtf = fopen($txtf, "w");
                fwrite($updatetxtf, $checksum);
                fclose($updatetxtf);
            }
        }


		/*************************/
		/* CREATE XML CU3ER FILE */
		/*************************/ 
        private function createXML() {
            
            $data = '<?xml version="1.0" encoding="UTF-8" ?>'."\n";
            $data .= '<cu3er>'."\n";
            $data .= "\t".'<settings>'."\n";
            $data .= "\t\t".'<general slide_panel_width="'.$this->pwidth.'" slide_panel_height="'.$this->pheight.'" slide_panel_horizontal_align="'.$this->phoralign.'" slide_panel_vertical_align="'.$this->pveralign.'" ui_visibility_time="'.$this->vistime.'"/>'."\n";
            if($this->endebug == 1){
                $data .= "\t\t".'<debug x="'.$this->debug_x.'" y="'.$this->debug_y.'" />'."\n";
                
            }
            if($this->enautoplay == 1){
                $data .= "\t\t".'<auto_play>'."\n";
                $data .= "\t\t\t".'<defaults symbol="'.$this->autoplaysymbol.'" time="'.$this->autoplaytimedefaults.'"/>'."\n";
                switch($this->autoplaysymbol){
                    case 'circular':
                    $data .= "\t\t\t".'<tweenIn x="45" y="45" width="30" height="30" tint="0xFFFFFF" alpha="0.5"/>'."\n";
                    $data .= "\t\t\t".'<tweenOut x="45" y="45" width="30" height="30" tint="0xFFFFFF" alpha="0.5"/>'."\n";
                    $data .= "\t\t\t".'<tweenOver />'."\n";   
                    break;
                    case 'linear':
                    $data .= "\t\t\t".'<tweenIn x="0" y="0" width="'.$this->pwidth.'" height="10" tint="0xFFFFFF" alpha="0.5"/>'."\n";
                    $data .= "\t\t\t".'<tweenOut x="0" y="0" width="'.$this->pwidth.'" height="10" tint="0xFFFFFF" alpha="0.5"/>'."\n";
                    $data .= "\t\t\t".'<tweenOver />'."\n";   
                    break;
                }  
                $data .= "\t\t".'</auto_play>'."\n";             
            }
            if($this->enprevbutton == 1){
                $data .= "\t\t".'<prev_button>'."\n";
                $data .= "\t\t\t".'<defaults round_corners="'.$this->prevbuttonroundcorners.'" />'."\n";
                $data .= "\t\t\t".'<tweenIn x="'.$this->px.'" y="'.$this->py.'" />'."\n";
                $data .= "\t\t\t".'<tweenOut />'."\n";
                $data .= "\t\t\t".'<tweenOver />'."\n";
                $data .= "\t\t".'</prev_button>'."\n";  
            }
            if($this->enableprevsymbol == 1){
                $data .= "\t\t".'<prev_symbol>'."\n";
                $data .= "\t\t\t".'<defaults type="'.$this->prevsymboltype.'"/>'."\n";
                $data .= "\t\t\t".'<tweenIn x="'.$this->px.'" y="'.$this->py.'" alpha="0.5"/>'."\n";
                $data .= "\t\t\t".'<tweenOut />'."\n";
                $data .= "\t\t\t".'<tweenOver time="0.15" x="'.$this->px.'" scaleX="1.1" scaleY="1.1"/>'."\n";
                $data .= "\t\t".'</prev_symbol>'."\n";
            }
                     
            if($this->ennextbutton == 1){
                $data .= "\t\t".'<next_button>'."\n";
                $data .= "\t\t\t".'<defaults round_corners="'.$this->nextbuttonroundcorners.'" />'."\n";
                $data .= "\t\t\t".'<tweenIn x="'.$this->nx.'" y="'.$this->ny.'"/>'."\n";
                $data .= "\t\t\t".'<tweenOut />'."\n";
                $data .= "\t\t\t".'<tweenOver />'."\n";
                $data .= "\t\t".'</next_button>'."\n";  
            }
            
            if($this->enablenextsymbol == 1){
                $data .= "\t\t".'<next_symbol>'."\n";
                $data .= "\t\t\t".'<defaults type="'.$this->nextsymboltype.'"/>'."\n";
                $data .= "\t\t\t".'<tweenIn x="'.$this->nx.'" y="'.$this->ny.'" alpha="0.5"/>'."\n";
                $data .= "\t\t\t".'<tweenOut />'."\n";
                $data .= "\t\t\t".'<tweenOver time="0.15" x="'.$this->nx.'" scaleX="1.1" scaleY="1.1"/>'."\n";
                $data .= "\t\t".'</next_symbol>'."\n";
            }

            if($this->enpreloader == 1){
                $data .= "\t\t".'<preloader>'."\n";
                $data .= "\t\t\t".'<defaults symbol="'.$this->preloader_symbol.'" />'."\n";
                $data .= "\t\t\t".' <tweenIn />'."\n";
                $data .= "\t\t\t".'<tweenOut />'."\n";
                $data .= "\t\t\t".'<tweenOver />'."\n";                
                $data .= "\t\t".'</preloader>'."\n";
            }
            if($this->enable_description_box == 1){
                $data .= "\t\t".'<description >'."\n";
                $data .= "\t\t\t".'<defaults round_corners="'.$this->descroundcorners.'" paragraph_font="'.$this->descparfont.'" heading_font="'.$this->descheadfont.'" heading_text_size="'.$this->descheadtxtsize.'" paragraph_text_size="'.$this->descpartxtsize.'" heading_text_color="'.$this->descheadtxtcolor.'" paragraph_text_color="'.$this->descpartxtcolor.'" paragraph_text_align="'.$this->descpartxtalign.'" heading_text_align="'.$this->descheadtxtalign.'" heading_text_margin="'.$this->descheadtxtmargin.'" paragraph_text_margin="'.$this->descpartxtmargin.'" heading_text_leading="'.$this->descheadtxtleading.'" paragraph_text_leading="'.$this->descpartxtleading.'" heading_text_letterSpacing="'.$this->descheadtxtlspace.'" paragraph_text_letterSpacing="'.$this->descpartxtlspace.'" />'."\n";
                $data .= "\t\t\t".'<tweenIn />'."\n";
                $data .= "\t\t\t".'<tweenOut />'."\n";
                $data .= "\t\t\t".'<tweenOver />'."\n";
                $data .= "\t\t".'</description>'."\n";
            }                                    
            $data .= "\t\t".'<transitions num="3" slicing="horizontal" direction="left" duration="0.6" delay="0.2" cube_color="0x611811"/>'."\n";
            $data .= "\t".'</settings>'."\n";
            $data .= "\t".'<slides>'."\n";
            $i = 0;
            foreach($this->images as $image){
                $sltarget = ($this->sltarget[$i] != '') ? $this->sltarget[$i] : '_parent';
                $partarget = ($this->parlinkstarget[$i] !='')? $this->parlinkstarget[$i] : '_parent';
                $data .= "\t\t".'<slide>'."\n";
                $data .= "\t\t\t".'<url>'.$image['file'].'</url>'."\n";
                if($this->limages[$i] != ''){$data .= "\t\t\t".'<link target="'.$sltarget.'">'.$this->limages[$i].'</link>'."\n";}
                if($this->paragraphs[$i] != '' && $this->enable_description_box == 1){
                    $data .= "\t\t\t".'<description>'."\n";
                    if($this->parlinks[$i] != ''){$data .= "\t\t\t\t".'<link target="'.$partarget.'">'.$this->parlinks[$i].'</link>'."\n";}
                    if($this->headings[$i] != ''){$data .= "\t\t\t\t".'<heading>'.$this->headings[$i].'</heading>'."\n";}
                    if($this->paragraphs[$i] != ''){$data .= "\t\t\t\t".'<paragraph>'.$this->paragraphs[$i].'</paragraph>'."\n";}
                    $data .= "\t\t\t".'</description>'."\n";
                }
                $data .= "\t\t".'</slide>'."\n";
                if($this->trantype == 'auto' || $this->trantype == 'custom'){
                    $num = ($this->num[$i] != '') ? 'num="'.$this->num[$i].'"' : '';
                    $slicing = ($this->slicing[$i] != '') ? 'slicing="'.$this->slicing[$i].'"' : '';
                    $direction = ($this->direction[$i] != '') ? 'direction="'.$this->direction[$i].'"' : '';
                    $duration = ($this->duration[$i] != '') ? 'duration="'.$this->duration[$i].'"' : '';
                    $delay = ($this->delay[$i] != '') ? 'delay="'.$this->delay[$i].'"' : '';
                    $shader = ($this->shader[$i] != '') ? 'shader="'.$this->shader[$i].'"' : '';
                    $light_position = ($this->light_position[$i] != '') ? 'light_position="'.$this->light_position[$i].'"' : '';
                    $cube_color = ($this->cube_color[$i] != '') ? 'cube_color="'.$this->cube_color[$i].'"' : '';
                    $z_multiplier = ($this->z_multiplier[$i] != '') ? 'z_multiplier="'.$this->z_multiplier[$i].'"' : '';
                }
                if($this->trantype !='none'){$data .= "\t\t".'<transition '.$num.' '.$slicing.' '.$direction.' '.$duration.' '.$delay.' '.$shader.' '.$light_position.' '.$cube_color.' '.$z_multiplier.'/>'."\n";}
                $i++;     
            }
            $data .= "\t".'</slides>'."\n";
            $data .= '</cu3er>'."\n";
                                   
            return $data;
        } 
        	
               
		/*************************/
		/* INJECT HTML COPYRIGHT */
		/*************************/
		private function injectCopyright($end=0) {
		  switch ($end){
		      case 0 :
              echo "<!--\n";
              echo "Cu3er Module developed by WebGift Web Services for Elxis CMS \n";
              echo 'Copyright (C) 2007 - '.date('Y')." WebGift Web Services ( http://www.webgift.gr ). All rights reserved.\n";
              echo "-->\n"; 
              break;
              case 1 :
              echo "\n"."<!-- End of Source Code - Cu3er Module by WebGift Web Services -->\n";
              break;
              case 2 :
              echo '<div style="width:100%;text-align:right;"><span style="font-size:9px;"> Cu3er Module developed by <a href="http://www.webgift.gr" target="_blank"  title="WebGift Web Services">WebGift Web Services</a> for <a href="http://www.elxis.org" target="_blank" title="Elxis CMS">Elxis CMS</a>.</span></div>';
              break;
		  }
		}
        

		/*******************************************/
		/* SELECT THE RIGHT XML FILE FOR EXECUTION */
        /*******************************************/
        private function executeXML($xmlfile = 'config'){
            $q = rand(0,100);
            $url = $this->selectLibrary();
            $swfont = ($this->swffont == 1) ? $this->sslmoddir.'/flash/miso_font.swf' : $this->sslmoddir.'/flash/new.swf';
?>
<script type="text/javascript" src="<?php echo $url ?>"></script>
  <style type="text/css">
	#webgift_cu3er<?php echo $q; ?> {<?php echo 'width:'.$this->pwidth.'px;'; ?> outline:0;}
  </style>
<script type="text/javascript">
	var flashvars = {};
	flashvars.xml = "<?php echo $this->sslmoddir; ?>/config/<?php echo $xmlfile; ?>.xml";
	flashvars.font = "<?php echo $swfont ?>";
	var attributes = {};
	attributes.wmode = "transparent";
	attributes.id = "<?php echo 'slider'.$q; ?>";
	swfobject.embedSWF("<?php echo $this->sslmoddir; ?>/flash/cu3er.swf", "webgift_cu3er<?php echo $q; ?>", "<?php echo $this->pwidth; ?>", "<?php echo $this->pheight; ?>", "9.0.28.0", "<?php echo $this->sslmoddir; ?>/flash/expressInstall.swf", flashvars,attributes);
</script>
<div id="webgift_cu3er<?php echo $q; ?>" >
<h2>Get Adobe Flash Player</h2>
<p>Module CU3ER needs Adobe Flash Player. Get it by clicking the image below!<br />
	<a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
</div>
<?php            
        }


		/*****************************/
		/* SELECT JAVASCRIPT LIBRARY */
        /*****************************/
        private function selectLibrary(){
        
            switch($this->swfobject){
                case '2.0':
                $url = $this->sslmoddir.'/js/swfobject2.0.js';
                break;
                case '2.1':
                $url = $this->sslmoddir.'/js/swfobject2.1.js';
                break;
                case '2.2':
                case '0':
                default:
                $url = $this->sslmoddir.'/js/swfobject2.2.js';
                break;
                case 'e2.1':
                $url = 'http://ajax.googleapis.com/ajax/libs/swfobject/2.1/swfobject.js';
                break;
                case 'e2.2':
                $url = 'http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js';
                break;
            }
            
            return $url;
        }


		/******************/
		/* EXECUTE MODULE */
        /******************/         
        public function executeModule(){
            $this->injectCopyright(0);
            if ($this->errormsg != '') {
                $this->errorScreen();
                return;
			}
            $this->prepareModule();
            $this->injectCopyright(1);            
        }  
        
        
		/***************************/
		/* PREPARE MODULE FOR RUN! */
        /***************************/      
        private function prepareModule(){
            if (strlen($this->concustom) > 0 ){
                $this->executeXML($this->concustom);
                }else{
                    $this->checkSum();
                    $this->executeXML();
                }
            if($this->copyright == 1){
                $this->injectCopyright(2);
            }
        }
    }       
$cuber = new modCuber($params);
$cuber->executeModule();    
unset($cuber);    
}
?>