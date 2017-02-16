<?php 
/**
* @version 1.1
* @package: Elxis Forms bot
* @author: Ioannis Sannos (Is Open Source)
* @email: info@isopensource.com
* @link: http://www.isopensource.com
* @license: Creative Commons 3.0 Share Alike
* @copyright: (C) 2008-2011 Ioannis Sannos (Is Open Source). All rights reserved.
* @description: Displays html forms inside Elxis content items
*
*** USAGE ***
{eforms}sampleform{/eforms}
*/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


if (!class_exists('elxisformer')) {
	class elxisformer {

		private $articleid = 0;
		private $errormsg = '';
		private $labelwidth = 140;
		private $descpos = 0; //0: bellow element, 1: next to element
		private $liveurl = '';
		private $align = 'left';
		private $required_fields = array();
		private $email_fields = array();
		private $date_fields = array();
		private $number_fields = array();
		private $url_fields = array();
		private $submit_error = false;
		private $submit_errormsgs = array();
		private $ccmailto = array();


		/*********************/
		/* MAGIC CONSTRUCTOR */
		/*********************/
		public function __construct($articleid, $formparams=array()) {
			$this->articleid = (int)$articleid;
			$this->labelwidth = $formparams['labelwidth'];
			$this->descpos = $formparams['descpos'];
			$this->align = (_GEM_RTL == 1) ? 'right' : 'left';
			$this->setURL();
			$this->init();
		}


		/****************************/
		/* SET SECURE LIVE SITE URL */
		/****************************/
		private function setURL() {
			global $mainframe;

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
				$this->liveurl = $ssllive;
			} else {
				$this->liveurl = $mainframe->getCfg('live_site');
			}
		}


		/*********************/
		/* INITIALIZE EFORMS */
		/*********************/
		private function init() {
			global $mainframe, $lang;

			if (defined('EFORMS_LOADED')) { return; }
			$rtlsfx = (_GEM_RTL == 1) ? '-rtl' : '';
			$mainframe->addCustomHeadTag('<link href="'.$this->liveurl.'/mambots/content/eforms/eforms'.$rtlsfx.'.css" rel="stylesheet" type="text/css" media="all" />');
			$mainframe->addCustomHeadTag('<script type="text/javascript" src="'.$this->liveurl.'/mambots/content/eforms/eforms.js"></script>');
			if (file_exists($mainframe->getCfg('absolute_path').'/mambots/content/eforms/'.$lang.'.php')) {
				include($mainframe->getCfg('absolute_path').'/mambots/content/eforms/'.$lang.'.php');
			} else {
				include($mainframe->getCfg('absolute_path').'/mambots/content/eforms/english.php');
			}
			define('EFORMS_LOADED', 1);
		}


		/******************/
		/* FORM PROCESSOR */
		/******************/
		public function processor($formname) {
			if (isset($_POST['eformssubmit'])) {
				return $this->processform($formname);
			} else {
				return $this->makeform($formname);
			}
		}


		/********************************************/
		/* FORM PROCESSOR (FORM HAS BEEN SUBMITTED) */
		/********************************************/
		private function processform($formname) {
			global $mainframe;

			$form = $this->loadXMLform($formname);
			if (!$form) {
				$out = ($this->errormsg != '') ? $this->errormsg : 'Could not generate form '.$formname.'!';
				return $out;
			}

			$mail_text = '';
			if ($form->items && (count($form->items) > 0)) {
				foreach ($form->items as $field) {
					$mail_text .= $this->getField($form->name, $field);
				}
			}
			$mail_text .= "\r\n------------------------------------------------------------\r\n\r\n";
			$mail_text .= EFORMS_THANKYOU."\r\n";
			$mail_text .= $mainframe->getCfg('sitename')."\r\n";
			$mail_text .= $mainframe->getCfg('live_site');

			$out = '<!-- eForms by Ioannis Sannos (www.isopensource.com) -->'."\n";
			$url = $this->getAction(1);
			if ($form->title != '') { $out .= '<h3 class="eforms_h3">'.$form->title."</h3>\n"; }
			if ($this->submit_error == true) {
				$ttl = ($form->title != '') ? $form->title : EFORMS_RETRY;
				$out .= '<div class="eforms_warning">'."\n";
				$out .= '<span style="font-size: 120%; font-weight: bold;">'.EFORMS_FAILED."</span><br />\n";
				if (count($this->submit_errormsgs) > 0) {
					foreach ($this->submit_errormsgs as $errmsg) { $out .= $errmsg."<br />\n"; }
				} else {
					$out .= EFORMS_FAILEDD;
				}
				$out .= "</div>\n";
				$out .= '<div class="eforms_signature"><a href="'.$url.'" title="'.$ttl.'">'.EFORMS_RETRY."</a></div>\n";
			} else {
				$subject = sprintf(EFORMS_FORMSUBNOT, $formname);
				foreach ($form->email as $femail) {
					mosMail($mainframe->getCfg('mailfrom'), $mainframe->getCfg('fromname'), $femail, $subject, $mail_text);
				}

				if ($this->ccmailto && (count($this->ccmailto) > 0)) {
					$cc_mail_text = sprintf(EFORMS_COPYSUB, $mainframe->getCfg('sitename'))."\r\n\r\n";
					$cc_mail_text .= $mail_text;
					foreach ($this->ccmailto as $femail) {
						mosMail($mainframe->getCfg('mailfrom'), $mainframe->getCfg('fromname'), $femail, $subject, $cc_mail_text);
					}
				}

				$onsuccess_text = ($form->onsuccess != '') ? $form->onsuccess : EFORMS_SUCCESSD;
				$ttl = ($form->title != '') ? $form->title : EFORMS_RETRY;
				$out .= '<div class="eforms_success">'."\n";
				$out .= '<span style="font-size: 120%; font-weight: bold;">'.EFORMS_SUCCESS."</span><br />\n";
				$out .= $onsuccess_text;
				$out .= "</div>\n";
				$out .= '<div class="eforms_signature">'.EFORMS_THANKYOU."<br />\n";
				$out .= $mainframe->getCfg('sitename')."<br />\n";
				$out .= '<a href="'.$url.'" title="'.$ttl.'">'.EFORMS_NEWSUBM."</a></div>\n";			
			}
			return $out;
		}


		/**********************************/
		/* GET FORM ACTION OR ARTICLE URL */
		/**********************************/
		private function getAction($aurl=0) {
			global $Itemid, $mainframe;

			if ($aurl == 1) {
				return sefRelToAbs('index.php?option=com_content&task=view&id='.$this->articleid.'&Itemid='.$Itemid);
			} else {
				if ($mainframe->getCfg('sef') == 2) {
					return sefRelToAbs('index.php?option=com_content&task=view&id='.$this->articleid.'&Itemid='.$Itemid);
				} else {
					return 'index.php';
				}
			}
		}


		/*****************/
		/* GET FORM HTML */
		/*****************/
		private function makeform($formname) {
			global $lang, $Itemid;

			$out = '<!-- eForms by Ioannis Sannos (www.isopensource.com) -->'."\n";
			$form = $this->loadXMLform($formname);
			if (!$form) {
				$out = ($this->errormsg != '') ? $this->errormsg : 'Could not generate form '.$formname.'!';
				return $out;
			}
			if ($form->action == 'email') { $form->action = $this->getAction(); }

			if ($form->title != '') { $out .= '<h3 class="eforms_h3">'.$form->title."</h3>\n"; }
			if ($form->description != '') { $out .= '<p class="eforms_para">'.$form->description."</p>\n"; }
			$out .= '<form name="'.$form->name.'" action="'.$form->action.'" method="'.$form->method.'" onsubmit="return eformsval'.$formname.'()">'."\n";

			if ($form->items && (count($form->items) > 0)) {
				foreach ($form->items as $field) {
					$out .= $this->makeField($form->name, $field);
				}
			}

			$js = $this->makejavascript($formname);

			$out .= '<p class="eforms_note">'.EFORMS_FASTREQ."</p>\n";
			$out .= '<input type="submit" name="eformssubmit" value="'.$form->submit.'" class="eforms_button" />'."\n";
			$out .= '<input type="hidden" name="option" value="com_content" />'."\n";
			$out .= '<input type="hidden" name="task" value="view" />'."\n";
			$out .= '<input type="hidden" name="id" value="'.$this->articleid.'" />'."\n";
			$out .= '<input type="hidden" name="eform" value="'.$formname.'" />'."\n";
			$out .= '<input type="hidden" name="mylang" value="'.$lang.'" />'."\n";
			$out .= '<input type="hidden" name="Itemid" value="'.$Itemid.'" />'."\n";
			$out .= "</form>\n";
			$out .= '<div style="clear: both;"></div>'."\n";
			return $js.$out;
		}


		/**********************************/
		/* GENERATE VALIDATION JAVASCRIPT */
		/**********************************/
		private function makejavascript($formname) {
			$js = '<script type="text/javascript">'."\n";
			$js .= '/* <![CDATA[ */'."\n";
			$js .= 'function eformsval'.$formname."() {\n";
			$js .= 'if (1 == 2) { alert(\'What a strange world!\'); }'."\n";
			if ($this->required_fields && (count($this->required_fields) > 0)) {
				foreach ($this->required_fields as $fld) {
					$js .= 'else if (document.getElementById(\''.$fld.'\').value == \'\') {'."\n";
					$js .= "\t".'alert(\''.EFORMS_REQEMPTY.'\'); eformsFocus(\''.$fld.'\'); return false;'."\n";
					$js .= "}\n";
				}
			}
			if ($this->email_fields && (count($this->email_fields) > 0)) {
				foreach ($this->email_fields as $fld) {
					$js .= 'else if (!eformsCheckEmail(\''.$fld.'\')) {'."\n";
					$js .= "\t".'alert(\''.EFORMS_INVEMAIL.'\'); eformsFocus(\''.$fld.'\'); return false;'."\n";
					$js .= "}\n";
				}
			}
			if ($this->date_fields && (count($this->date_fields) > 0)) {
				foreach ($this->date_fields as $fld) {
					$js .= 'else if (!eformsCheckDate(\''.$fld.'\')) {'."\n";
					$js .= "\t".'alert(\''.EFORMS_INVDATE.'\'); eformsFocus(\''.$fld.'\'); return false;'."\n";
					$js .= "}\n";
				}
			}
			if ($this->number_fields && (count($this->number_fields) > 0)) {
				foreach ($this->number_fields as $fld) {
					$js .= 'else if (!eformsCheckNumeric(\''.$fld.'\')) {'."\n";
					$js .= "\t".'alert(\''.EFORMS_INVNUMBER.'\'); eformsFocus(\''.$fld.'\'); return false;'."\n";
					$js .= "}\n";
				}
			}
			if ($this->url_fields && (count($this->url_fields) > 0)) {
				foreach ($this->url_fields as $fld) {
					$js .= 'else if (!eformsCheckUrl(\''.$fld.'\')) {'."\n";
					$js .= "\t".'alert(\''.EFORMS_INVURL.'\'); eformsFocus(\''.$fld.'\'); return false;'."\n";
					$js .= "}\n";
				}
			}
			$js .= 'else { return true; }'."\n";
			$js .= "}\n".'/* ]]> */'."\n</script>\n";
			return $js;
		}


		/****************************/
		/* GENERATE FORM FIELD HTML */
		/****************************/
		private function makeField($formname, $field) {
			global $mainframe, $lang;

			$html = '';
			$fname = $formname.$field->num;

			if (($field->label != '') && ($field->type != 'h3') && ($field->type != 'p') && ($field->type != 'hidden')) {
				$html .= '<div class="eforms_row">';
				$html .= '<label for="'.$fname.'" class="eforms_label" style="width:'.$this->labelwidth.'px;">'.$field->label;
				if ($field->required == 1) { $html .= ' <span style="color: #ff0000;">*</span>'; }
				$html .= "</label>\n";
			} else {
				$html .= '<div style="margin: 5px 0;">';
			}
			$akey = ($field->accesskey != '') ? ' accesskey="'.$field->accesskey.'"': '';
			switch ($field->type) {
				case 'separator':
					$html .= '<hr style="border:none; margin: 10px 0; padding: 0; height: 1px; background-color: #ccc;"/>'."\n";
				break;
				case 'h3':
					$html .= '<h3 class="'.$field->class.'">'.$field->label."</h3>\n";
				break;
				case 'p':
					$html .= '<p class="'.$field->class.'">'.$field->description."</p>\n";
				break;
				case 'textarea':
					$html .= '<textarea name="'.$fname.'" id="'.$fname.'" cols="'.$field->cols.'" rows="'.$field->rows.'"'.$akey.' class="eforms_textarea">'.$field->default."</textarea>\n";
					if ($field->required == 1) { $this->required_fields[] = $fname; }
				break;
				case 'select':
					$html .= '<select name="'.$fname.'" id="'.$fname.'"'.$akey.' class="eforms_selectbox">'."\n";
					if ($field->options && (count($field->options) > 0)) {
						foreach ($field->options as $opt) {
							$sel = ($opt == $field->default) ? ' selected="selected"' : '';
							$html .= '<option value="'.$opt.'"'.$sel.'>'.$opt."</option>\n";
						}
					}
					$html .= "</select>\n";
				break;
				case 'radio':
					if ($field->options && (count($field->options) > 0)) {
						$first = 1;
						foreach ($field->options as $opt) {
							$sel = ($opt == $field->default) ? ' checked="checked"' : '';
							$idtxt = ($first == 1) ? ' id="'.$fname.'"' : '';
							$html .= '<input type="radio" name="'.$fname.'"'.$idtxt.' value="'.$opt.'"'.$sel.' /> '.$opt." &nbsp; \n";
							$first = 0;
						}
					}
				break;
				case 'checkbox':
					if ($field->options && (count($field->options) > 0)) {
						$first = 1;
						foreach ($field->options as $opt) {
							$sel = ($opt == $field->default) ? ' checked="checked"' : '';
							$idtxt = ($first == 1) ? ' id="'.$fname.'"' : '';
							$html .= '<input type="checkbox" name="'.$fname.'[]"'.$idtxt.' value="'.$opt.'"'.$sel.' /> '.$opt." &nbsp; \n";
							$first = 0;
						}
					}
				break;
				case 'range':
					$html .= '<select name="'.$fname.'" id="'.$fname.'"'.$akey.' class="eforms_selectbox">'."\n";
					if ($field->options && (count($field->options) > 0)) {
						foreach ($field->options as $opt) {
							$sel = ($opt == $field->default) ? ' selected="selected"' : '';
							$html .= '<option value="'.$opt.'"'.$sel.'>'.$opt."</option>\n";
						}
					}
					$html .= "</select>\n";
				break;
				case 'country':
					if (file_exists($mainframe->getCfg('absolute_path').'/mambots/content/eforms/countries.'.$lang.'.php')) {
						include($mainframe->getCfg('absolute_path').'/mambots/content/eforms/countries.'.$lang.'.php');
					} else {
						include($mainframe->getCfg('absolute_path').'/mambots/content/eforms/countries.english.php');
					}
					$html .= '<select name="'.$fname.'" id="'.$fname.'"'.$akey.' class="eforms_selectbox">'."\n";
					foreach ($countries as $k => $c) {
						$sel = ($k == $field->default) ? ' selected="selected"' : '';
						$html .= '<option value="'.$k.'"'.$sel.'>'.$c."</option>\n";
					}
					$html .= "</select>\n";
					unset($countries);
				break;
				case 'url':
					$html .= '<input type="text" name="'.$fname.'" id="'.$fname.'"'.$akey.' size="'.$field->size.'" dir="ltr" value="'.$field->default.'" class="eforms_textbox" />'."\n";
					if ($field->required == 1) { $this->required_fields[] = $fname; }
					$this->url_fields[] = $fname;
				break;
				case 'email':
					$html .= '<input type="text" name="'.$fname.'" id="'.$fname.'"'.$akey.' size="'.$field->size.'" dir="ltr" value="'.$field->default.'" class="eforms_textbox" />'."\n";
					if ($field->required == 1) { $this->required_fields[] = $fname; }
					$this->email_fields[] = $fname;
				break;
				case 'number':
					$html .= '<input type="text" name="'.$fname.'" id="'.$fname.'"'.$akey.' size="'.$field->size.'" dir="ltr" value="'.$field->default.'" class="eforms_textbox" />'."\n";
					if ($field->required == 1) { $this->required_fields[] = $fname; }
					$this->number_fields[] = $fname;
				break;
				case 'hidden':
					$html .= '<input type="hidden" name="'.$fname.'" id="'.$fname.'" value="'.$field->default.'" class="eforms_textbox" />'."\n";
				break;
				case 'price':
					$html .= '<input type="text" name="'.$fname.'" id="'.$fname.'"'.$akey.' size="'.$field->size.'" dir="ltr" value="'.$field->default.'" class="eforms_textbox" /> '.$field->currency."\n";
					if ($field->required == 1) { $this->required_fields[] = $fname; }
					$this->number_fields[] = $fname;
				break;
				case 'date':
					mosCommonHTML::loadCalendar();
					$html .= '<a href="javascript:void(null);" onclick="return showCalendar(\''.$fname.'\', \'y-mm-dd\');">';
					$html .= '<img src="'.$this->liveurl.'/mambots/content/eforms/calendar16.png" alt="calendar" align="top" /></a> '."\n";
					$html .= '<input type="text" name="'.$fname.'" id="'.$fname.'"'.$akey.' size="10" maxlength="10" dir="ltr" value="'.$field->default.'" class="eforms_textbox" />'."\n";
					if ($field->required == 1) { $this->required_fields[] = $fname; }
					$this->date_fields[] = $fname;
				break;
				case 'captcha':
					$this->required_fields[] = $fname;
					$this->number_fields[] = $fname;
					$x1 = $fname.'_n1';
					$x2 = $fname.'_n2';
					$html .= $_SESSION[$x1].' + '.$_SESSION[$x2].' = ';
					$html .= '<input type="text" name="'.$fname.'" id="'.$fname.'"'.$akey.' size="'.$field->size.'" value="" class="eforms_textbox" />'."\n";
				break;
				case 'text':
				default:
					$html .= '<input type="text" name="'.$fname.'" id="'.$fname.'"'.$akey.' size="'.$field->size.'" value="'.$field->default.'" class="eforms_textbox" />'."\n";
					if ($field->required == 1) { $this->required_fields[] = $fname; }
				break;
			}

			if (($field->description != '') && ($field->type != 'h3') && ($field->type != 'p') && ($field->type != 'hidden')) {
				if ($this->descpos == 0) {
					$html .= '<br /><div class="eforms_labeldesc" style="margin-'.$this->align.': '.$this->labelwidth.'px;">'.$field->description."</div>\n";
				} else {
					$html .= '<span class="eforms_labeldesc" style="margin-'.$this->align.':10px;">'.$field->description."</span>\n";
				}
			}

			$html .= '<div style="clear:both;"></div>'."\n";
			$html .= "</div>\n";
			return $html;
		}



		/***********************/
		/* GET SUBMITTED FIELD */
		/***********************/
		private function getField($formname, $field) {
			global $mainframe, $lang;

			$html = '';
			$fname = $formname.$field->num;

			if (($field->label != '') && ($field->type != 'p') && ($field->type != 'captcha')) { $html .= $field->label; }
			switch ($field->type) {
				case 'separator':
					$html .= "\r\n------------------------------------------------------------\r\n\r\n";
				break;
				case 'h3': $html .= "\r\n"; break;
				case 'p': break; //$html .= $field->description."\r\n"; break;
				case 'textarea':
					$v = htmlspecialchars(eUTF::utf8_trim(mosGetParam($_POST, $fname, '')));
					if (($field->required == 1) && ($v == '')) {
						$this->submit_error = true;
						$this->submit_errormsgs[] = ($field->label != '') ? sprintf(EFORMS_FIELDNEMPT, '<strong>'.$field->label.'</strong>') : EFORMS_REQEMPTY;
					}
					$html .= ":\t\t ".$v."\r\n";
				break;
				case 'select':
				case 'radio':
					$v = eUTF::utf8_trim(mosGetParam($_POST, $fname, ''));
					$found = false;
					if ($field->options && (count($field->options) > 0)) {
						foreach ($field->options as $opt) {
							if ($opt == $v) { $found = true; break; }
						}
					}
					if (!$found) {
						$this->submit_error = true;
						$this->submit_errormsgs[] = ($field->label != '') ? sprintf(EFORMS_INVVALUE, '<strong>'.$field->label.'</strong>') : EFORMS_DETIMPRUS;
					}
					$html .= ":\t\t ".$v."\r\n";
				break;
				case 'checkbox':
					$vs = mosGetParam($_POST, $fname, array());
					$html .= ":\t\t";
					if (is_array($vs) && (count($vs) > 0)) {
						foreach ($vs as $v) {
							if ($field->options && (count($field->options) > 0)) {
								foreach ($field->options as $opt) {
									if ($opt == $v) { $html .= ' '.$v.','; }
								}
							}
						}
					}
					$html = preg_replace('/(\,)$/', '', $html);
					$html .= "\r\n";
				break;
				case 'range':
					$v = (int)mosGetParam($_POST, $fname, 0);
					$vals = array();
					if ($field->options && (count($field->options) > 0)) {
						foreach ($field->options as $opt) { $vals[] = (int)$opt; }
					}
					if (!$vals) {
						$this->submit_error = true;
						$this->submit_errormsgs[] = 'Form error: A range element should be consisted by a min and max integer.'; 
					} else {
						$min = min($vals);
						$max = max($vals);
						if (($v < $min) || ($v > $max)) {
							$this->submit_error = true;
							$this->submit_errormsgs[] = ($field->label != '') ? sprintf(EFORMS_VOUTRANG, '<strong>'.$field->label.'</strong>', $min.'-'.$max) : EFORMS_DETIMPRUS;
						}
					}
					$html .= ":\t\t ".$v."\r\n";
				break;
				case 'country':
					$v = htmlspecialchars(eUTF::utf8_trim(mosGetParam($_POST, $fname, '')));
					$html .= ":\t\t ".$v."\r\n";
				break;
				case 'url':
					$v = eUTF::utf8_trim(mosGetParam($_POST, $fname, ''));
					if (($field->required == 1) && ($v == '')) {
						$this->submit_error = true;
						$this->submit_errormsgs[] = ($field->label != '') ? sprintf(EFORMS_FIELDNEMPT, '<strong>'.$field->label.'</strong>') : EFORMS_REQEMPTY;
					}
					if ($v != '') {
						if (!preg_match('/^(http)/i', $v)) {
							$this->submit_error = true;
							$this->submit_errormsgs[] = ($field->label != '') ? sprintf(EFORMS_VNOTURL, '<strong>'.$field->label.'</strong>') : EFORMS_INVURL;
						}
					}
					$html .= ":\t\t ".$v."\r\n";
				break;
				case 'email':
					$v = eUTF::utf8_trim(mosGetParam($_POST, $fname, ''));
					if (($field->required == 1) && ($v == '')) {
						$this->submit_error = true;
						$this->submit_errormsgs[] = ($field->label != '') ? sprintf(EFORMS_FIELDNEMPT, '<strong>'.$field->label.'</strong>') : EFORMS_REQEMPTY;
					}
					if ($v != '') {
						if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $v)) {
							$this->submit_error = true;
							$this->submit_errormsgs[] = ($field->label != '') ? sprintf(EFORMS_VNOTEMAIL, '<strong>'.$field->label.'</strong>') : EFORMS_INVEMAIL;
						}
						if ($field->sendcopy == 1) { $this->ccmailto[] = $v; }
					}
					$html .= ":\t\t ".$v."\r\n";
				break;
				case 'number':
					$v = trim(mosGetParam($_POST, $fname, ''));
					if (($field->required == 1) && ($v == '')) {
						$this->submit_error = true;
						$this->submit_errormsgs[] = ($field->label != '') ? sprintf(EFORMS_FIELDNEMPT, '<strong>'.$field->label.'</strong>') : EFORMS_REQEMPTY;
					}
					if ($v != '') {
						if (!is_numeric($v)) {
							$this->submit_error = true;
							$this->submit_errormsgs[] = ($field->label != '') ? sprintf(EFORMS_VNOTNUMBER, '<strong>'.$field->label.'</strong>') : EFORMS_INVNUMBER;
						}
					}
					$html .= ":\t\t ".$v."\r\n";
				break;
				case 'hidden':
					$v = trim(mosGetParam($_POST, $fname, ''));
					$html .= ":\t\t ".$v."\r\n";
				break;
				case 'price':
					$v = trim(mosGetParam($_POST, $fname, '0.00'));
					if (($field->required == 1) && ($v == '')) {
						$this->submit_error = true;
						$this->submit_errormsgs[] = ($field->label != '') ? sprintf(EFORMS_FIELDNEMPT, '<strong>'.$field->label.'</strong>') : EFORMS_REQEMPTY;
					}
					if ($v != '') {
						if (!is_numeric($v)) {
							$this->submit_error = true;
							$this->submit_errormsgs[] = ($field->label != '') ? sprintf(EFORMS_VNOTNUMBER, '<strong>'.$field->label.'</strong>') : EFORMS_INVNUMBER;
						} else {
							$v = number_format($v, 2, '.', '');
						}
					}
					$html .= ":\t\t ".$v.' '.$field->currency."\r\n";
				break;
				case 'date':
					$v = trim(mosGetParam($_POST, $fname, ''));
					if (($field->required == 1) && ($v == '')) {
						$this->submit_error = true;
						$this->submit_errormsgs[] = ($field->label != '') ? sprintf(EFORMS_FIELDNEMPT, '<strong>'.$field->label.'</strong>') : EFORMS_REQEMPTY;
					}
					if ($v != '') {
						$valid = false;
						if (strlen($v) == 10) {
							$parts = preg_split('/\-/', $v, -1, PREG_SPLIT_NO_EMPTY);
							if ($parts && (count($parts) == 3)) {
								$valid = checkdate(intval($parts[1]),intval($parts[2]),intval($parts[0]));
							}
						}
						if (!$valid) {
							$this->submit_error = true;
							$this->submit_errormsgs[] = ($field->label != '') ? sprintf(EFORMS_VNOTDATE, '<strong>'.$field->label.'</strong>') : EFORMS_INVDATE;
						}
					}
					$html .= ":\t\t ".$v."\r\n";
				break;
				case 'captcha': //just validation, dont pass to e-mail
					$v = (int)mosGetParam($_POST, $fname, 0);
					$ssum = $fname.'_sum';
					$sv = (isset($_SESSION[$ssum])) ? intval($_SESSION[$ssum]) : -1;
					if ($v == 0) {
						$this->submit_error = true;
						$this->submit_errormsgs[] = ($field->label != '') ? sprintf(EFORMS_FIELDNEMPT, '<strong>'.$field->label.'</strong>') : EFORMS_REQEMPTY;
					} elseif ($v <> $sv) {
						$this->submit_error = true;
						$this->submit_errormsgs[] = _E_INV_SECCODE;
					}
				break;
				case 'text':
				default:
					$v = eUTF::utf8_trim(mosGetParam($_POST, $fname, ''));
					if (($field->required == 1) && ($v == '')) {
						$this->submit_error = true;
						$this->submit_errormsgs[] = ($field->label != '') ? sprintf(EFORMS_FIELDNEMPT, '<strong>'.$field->label.'</strong>') : EFORMS_REQEMPTY;
					}
					$html .= ":\t\t ".$v."\r\n";
				break;
			}
			return $html;
		}


		/***********************************/
		/* PARSE XML AND GET FORM ELEMENTS */
		/***********************************/
		private function loadXMLform($formname='') {
			global $mainframe;

			$xmlfile = $mainframe->getCfg('absolute_path').'/mambots/content/eforms/data.xml';
			if (!file_exists($xmlfile)) { $this->errormsg = 'File data.xml not found!'; return false; }
			if (version_compare(PHP_VERSION, '5.1.0') >= 0) { libxml_use_internal_errors(true); }
			$xmldoc = simplexml_load_file($xmlfile, 'SimpleXMLElement');
			if (!$xmldoc) { return false; }
			if (version_compare(PHP_VERSION, '5.1.3') >= 0) {
				if ($xmldoc->getName() != 'eforms') { return false; }
			}
			if (!isset($xmldoc->form)) { return false; }
			$eform = null;
			foreach ($xmldoc->form as $xform) {
				$found = false;
				$attrs = $xform->attributes();
				if ($attrs) {
					if (isset($attrs['name']) && ((string)$attrs['name'] == $formname)) {
						$found = true;
						$eform = $xform;
					}
				}
				unset($attrs);
				if ($found === true) { break; }
			}
			if (!$found) { return false; }

			$attrs = $eform->attributes();
			$form = new stdClass();
			$form->name = (string)$attrs['name'];
			$form->method = (isset($attrs['method'])) ? (string)$attrs['method'] : 'POST';
			$form->action = (isset($attrs['action'])) ? (string)$attrs['action'] : 'email';
			unset($attrs);
			$form->title = (isset($eform->title)) ? (string)$eform->title : '';
			$form->description = (isset($eform->description)) ? (string)$eform->description : '';
			$form->onsuccess = (isset($eform->onsuccess)) ? (string)$eform->onsuccess : '';
			$form->email = array();
			if (isset($eform->email)) {
				$emailstr = trim((string)$eform->email);
				if ($emailstr != '') {
					$emails = preg_split('#\;#', $emailstr, -1, PREG_SPLIT_NO_EMPTY);
					if ($emails) {
						foreach ($emails as $email) {
							if (preg_match('#\@#', $email)) { $form->email[] = $email; }
						}
					}
				}
			}
			if (($form->action == 'email') && (!$form->email)) { $form->email[] = $mainframe->getCfg('mailfrom'); }
			$form->submit = (isset($eform->submit)) ? (string)$eform->submit : _SEND_BUTTON;
			$form->items = array();
			$items = $eform->items->children();
			if ($items && (count($items) > 0)) {
				$itemnum = 1;
				foreach ($items as $item) {
					$field = new stdClass();
					$field->num = $itemnum;
					$field->type = (string)$item['type'];
					$field->label = (isset($item['label'])) ? (string)$item['label'] : '';
					$field->default = (isset($item['default'])) ? (string)$item['default'] : '';
					if (($field->type == 'date') && ($field->default == '')) { $field->default = date('Y-m-d'); }
					if ($field->type == 'p') {
						$dsc = (string)$item;
						if (trim($dsc) != '') {
							$field->description = $dsc;
						} else {
							$field->description = (isset($item['description'])) ? (string)$item['description'] : '';
						}
					} else {
						$field->description = (isset($item['description'])) ? (string)$item['description'] : '';
					}
					$field->required = (isset($item['required'])) ? (int)$item['required'] : 0;
					$field->size = (isset($item['size'])) ? (int)$item['size'] : 20;
					if ($field->type == 'captcha') {
						$field->size = 5;
						$field->required = 1;
						if ($field->label == '') { $field->label = _E_SECCODE; }
						if (!isset($_POST['eformssubmit'])) {
							$x1 = $form->name.$field->num.'_n1';
							$x2 = $form->name.$field->num.'_n2';
							$xsum = $form->name.$field->num.'_sum';
							$nums = range(5,25);
							$xs = array_rand($nums, 2);
							$v1 = $xs[0];
							$v2 = $xs[1];
							$_SESSION[$x1] = $nums[$v1];
							$_SESSION[$x2] = $nums[$v2];
							$_SESSION[$xsum] = $nums[$v1] + $nums[$v2];
							unset($x1, $x2, $xsum, $nums, $xs, $v1, $v2);
						}
					}
					$field->accesskey = (isset($item['accesskey'])) ? (string)$item['accesskey'] : '';
					switch($field->type) {
						case 'textarea':
							$field->cols = (isset($item['cols'])) ? (int)$item['cols'] : 50;
							$field->rows = (isset($item['rows'])) ? (int)$item['rows'] : 10;
						break;
						case 'select':
						case 'radio':
						case 'checkbox':
							$field->options = array();
							$options = $item->children();
							if ($options && (count($options) > 0)) {
								foreach ($options as $opt) { $field->options[] = (string)$opt; }
							}
							unset($options);
						break;
						case 'range':
							$field->options = array();
							if (isset($item['options'])) {
								$limitstr = (string)$item['options'];
								$limits = preg_split('#\;#', $limitstr, -1, PREG_SPLIT_NO_EMPTY);
								if ($limits && (count($limits) == 2)) {
									$low = (int)$limits[0];
									$high = (int)$limits[1];
									$step = (isset($item['step'])) ? (int)$item['step'] : 1;
									$options = range($low, $high, $step);
									if ($options) {
										foreach ($options as $opt) { $field->options[] = $opt; }
									}
								}
							}
						break;
						case 'price': $field->currency = (isset($item['currency']) && ($item['currency'] != '')) ? (string)$item['currency'] : 'EUR'; break;
						case 'email': $field->sendcopy = (isset($item['sendcopy'])) ? (int)$item['sendcopy'] : 0; break;
						case 'p' : $field->class = (isset($item['class']) && ($item['class'] != '')) ? (string)$item['class'] : 'eforms_para'; break;
						case 'h3' : $field->class = (isset($item['class']) && ($item['class'] != '')) ? (string)$item['class'] : 'eforms_h3'; break;
						case 'text': case 'separator': case 'hidden': case 'country': 
						case 'number': case 'url': case 'date': default: break;
					}
					$form->items[] = $field;
					unset($field);
					$itemnum++;
				}
			}
			return $form;
		}

	}
}


/**********************/
/* CALL BACK REPLACER */
/**********************/
function botElxisForms($published, &$row, $params, $page=0) {
	global $database, $_MAMBOTS, $mainframe;

	$regex = "#{eforms}(.*?){/eforms}#s";
	if (!$published) {
       $row->text = preg_replace( $regex, '', $row->text );
	   return;
	}

	if (strpos($row->text, 'eforms') === false) { return true; }

	$matches = array();
	preg_match_all($regex, $row->text, $matches, PREG_PATTERN_ORDER);

	if ($matches) {
		if (!isset($_MAMBOTS->_content_bot_params['eforms'])) {
			$database->setQuery("SELECT params FROM #__mambots WHERE element = 'eforms' AND folder = 'content'", '#__', 1, 0);
			$database->loadObject($mambot);
			$botParams = new mosParameters($mambot->params);
			$_MAMBOTS->_content_bot_params['eforms']['labelwidth'] = (int)$botParams->get('labelwidth', 140);
			$_MAMBOTS->_content_bot_params['eforms']['descpos'] = (int)$botParams->get('descpos', 0);
			unset($mambot, $botParams);
		}

		foreach ($matches[0] as $match) {
			$formname = trim(preg_replace("#{.+?}#", '', $match));
			if ($formname == '') {
			    $row->text = preg_replace($regex, '', $row->text);
				continue;
			}

			$ef = new elxisformer($row->id, $_MAMBOTS->_content_bot_params['eforms']);
			$html = $ef->processor($formname);
			unset($ef);

			$row->text = preg_replace("#".$match."#", $html, $row->text);
		}
	}
	return true;
}

$_MAMBOTS->registerFunction('onPrepareContent', 'botElxisForms');

?>