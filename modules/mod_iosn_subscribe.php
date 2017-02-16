<?php 
/**
* $Id: mod_iosn_subscribe.php 110 2011-05-06 12:08:01Z stratakisS $
* @package: IOS Newsletter Subscribe Module
* @author: Stavros Stratakis ( WebGift Web Services )
* @email: info@webgift.gr
* @link: http://www.webgift.gr
* @license: GNU / GPL
* @copyright: (C) 2007-2010 Stavros Stratakis (WebGift Web Services). All rights reserved.
* @description: IOSN Subscribe Module give the opportunity to your website's visitors  to 
* subscribe - interactive quickly and easily with IOS Newsletter component.!
*********************************************************************************************************/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


if (!class_exists('iosn_subscribe')) {
	class iosn_subscribe {
	   
       private $_Itemid = 0;
       private $moddir = '';
       private $ssl_live_site = '';
       private $sslmoddir = '';
       private $newsletter = null;
       private $errormsg ='';
       private $border_color = '';
       private $hscredits = 1;

       
		/***************/
		/* CONSTRUCTOR */
		/***************/
		public function __construct($params, $newsletter) {
		  global $mainframe ;
            $this->moddir = $mainframe->getCfg('live_site').'/modules/mod_iosn_subscribe';
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
				$this->sslmoddir = $this->ssl_live_site.'/modules/mod_iosn_subscribe';
			} else {
				$this->sslmoddir = $this->moddir;
			}		  
			$this->newsletter = $newsletter;	
			$this->getConfig($params);
		}
       
		/********************************/
		/* GET CONFIGURATION PARAMETERS */
		/********************************/
		private function getConfig($params) {
			global $mainframe;
            
            $this->border_color = (intval($params->get('border_color', 1))) ? 'rounded-white' : 'rounded-black';
            $this->hscredits = (intval($params->get('hscredits', 1))) ? 'true' : 'false';            
            $iosn_dir =  $mainframe->getCfg('absolute_path').'/administrator/components/com_newsletter';
            if (!file_exists($iosn_dir.'/config.newsletter.php')) {
                $this->errormsg = 'IOS Newsletter Component not found!';
                return;
                }else{
                    require_once($iosn_dir.'/config.newsletter.php');
                    $cfg = new newsletterConfig();
                    if ($cfg->get('CAN_SUBSCRIBE') == 1) {
                        $message = $this->newsletter->lng->SUBLOGIN;
                        }elseif($cfg->get('CAN_SUBSCRIBE') == 0){
                            $message = $this->newsletter->lng->SUBNALLOWED;
                            }
                            $this->errormsg = $message;
                }
                
        }
        
		/******************************/
		/* LOAD HIGHSLIDE JAVASCRIPT */
		/*****************************/        
        private function loadJS(){
            ?>
            <script type="text/javascript" src="<?php echo $this->sslmoddir; ?>/javascript/highslide-full.min.js"></script>
            <script type="text/javascript">
            /* <![CDATA[ */
            hs.graphicsDir = '<?php echo $this->sslmoddir; ?>/images/';
            hs.outlineType = '<?php echo $this->border_color; ?>';
           	hs.showCredits = <?php echo $this->hscredits; ?>;

               
            function nlsubscribe() {
                var form = document.nlsubscribeform;
                var email = document.getElementById('email').value;
                var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                
                if (!filter.test(email)) {
                    alert('<?php echo $this->newsletter->lng->PROVALIDEMAIL; ?>');
                    }else if(filter.test(email)){
                        form.nlemail.value = email;
                    }
                
                if (form.nlname.value == '') {
				    alert('<?php echo $this->newsletter->lng->NAMEEMPTY; ?>');
				    form.nlname.focus();
                    } else if (form.nlsurname.value == '') {
				        alert('<?php echo $this->newsletter->lng->SURNAMEEMPTY; ?>');
				        form.nlsurname.focus();
                    } else if (form.nlsum.value == '') {
				        alert('<?php echo $this->newsletter->lng->SECCODEWRONG; ?>');
				        form.nlsum.focus();
                    } else {
				        try {
					       form.onsubmit();
				    }
                    catch(e){}
				    form.submit();
			         }
            }            
            /* ]]> */
            </script>
            <?php
        }

		/***********************/
		/* LOAD HIGHSLIDE CSS */
		/**********************/         
        private function loadCSS(){
            global $mainframe;
            $css = $mainframe->getCfg('absolute_path').'/components/com_newsletter/css';
            if(file_exists($css.'/newsletter.css') && file_exists($css.'/newsletter-rtl.css')){
                $cssfile = (_GEM_RTL) ? $mainframe->getCfg('live_site').'/components/com_newsletter/css/newsletter-rtl.css' : $mainframe->getCfg('live_site').'/components/com_newsletter/css/newsletter.css';    
            }elseif(!file_exists($css.'/newsletter.css') || !file_exists($css.'/newsletter-rtl.css')){
                $cssfile = (_GEM_RTL) ? $this->sslmoddir.'/css/iosn_subscribe-rtl.css' : $this->sslmoddir.'/css/iosn_subscribe.css';
            }
            
            ?>      
            <script language="javascript">
			/* <![CDATA[ */
			var header = document.getElementsByTagName("head")[0];
			var csslink = document.createElement('link');
			csslink.setAttribute('type', 'text/css');
			csslink.setAttribute('rel', 'stylesheet');
			csslink.setAttribute('href', '<?php echo $this->sslmoddir; ?>/css/highslide.css');
			csslink.setAttribute('media', 'all');
			header.appendChild(csslink);
            
			var header1 = document.getElementsByTagName("head")[0];
			var csslink1 = document.createElement('link');
			csslink1.setAttribute('type', 'text/css');
			csslink1.setAttribute('rel', 'stylesheet');
			csslink1.setAttribute('href', '<?php echo $cssfile; ?>');
			csslink1.setAttribute('media', 'all');
			header1.appendChild(csslink1); 
			/* ]]> */
			</script>
            <?php
        }

		/************************/
		/* MARK MODULE HTML END */
		/************************/
		private function htmlend() {
			echo "<!-- End of IOSN Subscribe Module by Stavros Stratakis -->\n";
		}  
  
        /*****************/
		/* ERROR MESSAGE */
		/*****************/
		private function errorscreen() {
			echo '<div style="margin: 2px; padding: 3px; border: 1px solid #cc0000; color: #000000; background-color: #FFF;">'."\n";
			echo '<span style="font-weight:bold; color: #CC0000;">'._ELX_ERROR."</span><br />\n";
			echo ($this->errormsg != '') ? $this->errormsg : 'Unknown error';
			echo "</div>\n";
		}
        
		/*************************/
		/* INJECT HTML COPYRIGHT */
		/*************************/
		private function injectCopyright() {
			echo "<!--\n";
			echo "IOSN Subscribe Module developed by Stratakis Stavros for Elxis CMS via WebGift Web Services\n";
			echo 'Copyright (C) 2007 - '.date('Y')." WebGift Web Services ( http://www.webgift.gr ). All rights reserved.\n";
			echo "-->\n";
		}
        
		/**************************/
		/* RUN MY SWEETHEART! RUN */
		/**************************/               
        private function runhtml(){
            global $lang,$mainframe,$Itemid,$option;
            if ($option != 'com_newsletter'){
            $f = rand(1, 20);
            $s = rand(10, 40);
            $sum = ($f + $s);
            $this->loadJS();
            $this->loadCSS();
            
            ?>
            <table border="0" style="margin: 0; padding:0;">
            <tr><?php echo '<span style="font:10px tahoma;text-align:justify;">'._EMAIL_YOUR_MAIL.'</span>'; ?>  </tr> 
            <tr>
                <td>
                <input type="text" id="email" name="email" class="iosnl_textbox"  value="" title="<?php echo _CMN_EMAIL; ?>" maxlength="80"  dir="ltr" /> 
                </td>
            </tr>
            <tr>          
                <td >
            <?php echo '<span style="font:10px tahoma;text-align:justify;">'._E_SEND_REG.' : </span>'; ?>
            <a title="<?php echo $this->newsletter->lng->SUBLEWSL; ?>" href="#" onclick="return hs.htmlExpand(this, {contentId:  'highslide-html<?php echo $f; ?>' } )" class="highslide"> <img alt="<?php echo $this->newsletter->lng->SUBSCRIBE; ?>" src="<?php echo $this->sslmoddir.'/images/subnewsletter.png'; ?>" width="24" border="0" height="24"/> </a> 
                </td>
            </tr>
            </table>           
            <div class="highslide-html-content" id="highslide-html<?php echo $f; ?>">
            <div class="highslide-header"><br />
            <ul>
            <li class="highslide-move">
            <a href="#" onclick="return false">Move</a>
            </li>
            <li class="highslide-close">
            <a href="#" onclick="return hs.close(this)">Close</a>
            </li>
            </ul>
            </div>
            <div style="overflow:hidden;" class="highslide-body">
            <?php echo '<noscript class="iosnl_noscript">'.$this->newsletter->lng->JSDISABLED.'</noscript>'."\n"; ?>
            <form name="nlsubscribeform" method="post" action="<?php echo $mainframe->getCfg('live_site'); ?>/index2.php" style="margin: 0; padding: 0;">
            <fieldset class="iosnl_fset">
            <legend class="iosnl_leg"><?php echo $this->newsletter->lng->SUBLEWSL; ?></legend> 
            <div class="iosnl_subinfo">
				<?php 
				echo $this->newsletter->lng->SUBINFO;
				if ($this->newsletter->cfg->get('VALIDATE_EMAIL')) {
					echo ' '.$this->newsletter->lng->SUBEMAILVAL;
				}
				?>
			</div>
            <ul>
                <li>
			     <label class="iosnl_lbl" for="nlname" ><?php echo $this->newsletter->lng->NAME; ?></label>
			     <input class="iosnl_textbox" type="text" name="nlname" id="nlname" value=""title="<?php echo $this->newsletter->lng->NAME; ?>" maxlength="60" />
                </li>
			    <li>
			     <label class="iosnl_lbl" for="nlsurname" ><?php echo $this->newsletter->lng->SURNAME; ?></label>
			     <input class="iosnl_textbox" type="text" name="nlsurname" id="nlsurname" value=""  title="<?php echo $this->newsletter->lng->SURNAME; ?>" maxlength="60" />
                </li>
                <li>
			     <input type="hidden" name="nlemail" id="nlemail" value=""  title="<?php echo _CMN_EMAIL; ?>" maxlength="80" dir="ltr" />
                </li>
                <?php 
                if (trim($this->newsletter->cfg->get('LANGS')) == '') {
                    echo '<input type="hidden" name="nllang" id="nllang" value="" />'._LEND;
                    } else {
                        $nlangs = explode(',', trim($this->newsletter->cfg->get('LANGS')));
                        if (count($nlangs) == 1) {
                            echo '<input type="hidden" name="nllang" id="nllang" value="'.$nlangs[0].'" />'._LEND;
                            } else {
                ?>
			     <li>
                    <label class="iosnl_lbl" for="nllang"><?php echo $this->newsletter->lng->RECIEVEIN; ?></label>
                    <select name="nllang" id="nllang"  title="<?php echo _E_LANGUAGE; ?>">
                    <option value="" selected="selected"><?php echo $this->newsletter->lng->ANYLANG; ?></option>
				<?php 
                    foreach ($nlangs as $nlang) {
					   echo '<option value="'.$nlang.'">'.$this->newsletter->translatedLang($nlang).'</option>'._LEND;
				}
				?>
                    </select>
                </li>
                <?php }
                unset($nlangs);
                }
                ?>
                <li>
			     <label class="iosnl_lbl" for="nlsum" ><?php echo $this->newsletter->lng->SECCODE; ?></label>
			     <span ><?php echo $f.' + '.$s; ?> =</span> 
			     <input class="iosnl_security" type="text" name="nlsum" id="nlsum" value="" title="<?php echo $this->newsletter->lng->SECCODE; ?>" maxlength="4" size="4" dir="ltr" />
                </li>
			 </ul>
			    <input type="hidden" name="option" value="com_newsletter" />
                <input type="hidden" name="task" value="subscribe" />
                <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
                <input type="hidden" name="mylang" value="<?php echo $lang; ?>" />
                <input type="hidden" name="nlencsum" value="<?php echo md5($mainframe->getCfg('secret').$sum); ?>" />
            <ul>
               <li> 
				<input  type="button" name="subscribe" class="iosnl_button" value="<?php echo $this->newsletter->lng->SUBSCRIBE; ?>"  onclick="nlsubscribe();" />
               </li>
			</ul>
            </fieldset>
            </form>
            </div>
              <div class="highslide-footer">
               <div><span class="highslide-resize" title="Resize"><span></span></span></div></div></div>
               <?php
               }else{
                return;
               }                
        }
        
		/******************/
		/* EXECUTE MODULE */
		/******************/        
        public function run(){
            $this->injectCopyright();
            if ($this->errormsg != '') {
                $this->errorscreen();
                return;
			}
			$this->runhtml();
			$this->htmlend();              
        }
   }
}

global $mainframe;
if (file_exists($mainframe->getCfg('absolute_path').'/administrator/components/com_newsletter/includes/newsletter.class.php')) {
    if (!class_exists('iosNewsLetter') || !isset($GLOBALS['newsletter'])) {
        require_once($mainframe->getCfg('absolute_path').'/administrator/components/com_newsletter/includes/newsletter.class.php');
        $newsletter = new iosNewsLetter();
        $GLOBALS['newsletter'] = $newsletter;
        } elseif (!isset($newsletter)) {
            $newsletter = $GLOBALS['newsletter'];
        }
        $iosn_subscribe = new iosn_subscribe($params, $newsletter);
        $iosn_subscribe->run();
        unset($iosn_subscribe);
        }else{
        $iosn_subscribe = new iosn_subscribe($params, null);
        $iosn_subscribe->run();
         unset($iosn_subscribe);  
}     
?>