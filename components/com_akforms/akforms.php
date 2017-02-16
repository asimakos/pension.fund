<?php
/**
* @version: 1.6
* @package: Component AkForms
* @author: Andrew Campoball
* @email: ACampball@yandex.ru
* @link:
* @license: GPL
* @copyright: (C) 2009 Andrew Campball. All rights reserved.
* @description: AkForms component for Elxis CMS.
*****************************************************************************/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once($mainframe->getCfg('absolute_path').'/administrator/components/com_akforms/includes/akforms.class.php');
require_once($mainframe->getCfg('absolute_path').'/components/com_akforms/akforms.html.php');

$formclass = new AkFormClass();

class akForms {

	private $task = null;
	private $redirect = null;
	private $params = null;
	private $lng = null;
	public $fcopy = 0;
	public $copy_email = null;

	public $err_msg = array();

	public $msg = null;

	private $submitted = null;
	private $fid = null;
	private $files = null;
	private $attachments = null;
	private $delfile = null;

	private $maxsize = 500;


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
		global $mainframe, $database, $formclass;

	    $this->maxsize = $formclass->cfg->get('GFMAXFILESIZE');

		$this->task = strtolower(trim(mosGetParam($_REQUEST, 'task', '')));
		$this->redirect = strtolower(trim(mosGetParam($_REQUEST, 'redirect', '')));
		$this->editmode = mosGetParam($_REQUEST, 'editmode', '');

		$this->fcopy = intval(mosGetParam($_POST, 'email_copy', 0));
		$this->copy_email = mosGetParam($_POST, 'copy_email', '');

		$_SESSION["botAkFormECopy"] = $this->fcopy;

		if ( in_array($this->task, array('submit', 'save', 'reset')) ) {
			$this->getuserinput();
		} else {
			if ( $formclass->cfg->get('SSL') && ($_SERVER['HTTPS'] != 'on') ) {
				header ( "Location: https://" . $_SERVER['SERVER_NAME'].'/forms/');
				exit;
			}
		}
	}


	/**********************/
	/* GET SEARCH KEYWORD */
	/**********************/
	private function getuserinput() {
		global $database, $formclass, $fmanager;

		$this->submitted = mosGetParam($_POST, 'submitted', array());
		$this->files = mosGetParam($_FILES, 'submitted', array());
		$this->fid = intval(mosGetParam($_REQUEST, 'fid', 0));
		$this->delfile = mosGetParam($_REQUEST, 'delfile', array());

		$this->err_msg = array();

		foreach ($this->files as $name => $values) {
			foreach ($values as $num => $value) {
				if ( !is_array($this->submitted[$num]) ) {
					$oldf = $this->submitted[$num];
					$this->submitted[$num] = array('old' => $oldf);
				}
				$this->submitted[$num][$name] = $value;
			}
		}

		$this->keys = array_keys($this->submitted);

		$database->setQuery('SELECT * FROM #__akforms WHERE id = '.$this->fid);
		$database->LoadObject($form);

		if (!$form->id) {
			$this->err_msg[] = $formclass->lng->ERR_NO_PARAMS;
			return;
		}

		$_SESSION["botAkFormSubmitted"] = $this->submitted;

		if ( in_array($this->task, array('save', 'reset')) ) { return; }

		$database->setQuery('SELECT * FROM #__akform_items WHERE form_id = '.$form->id.' AND id IN ('.implode(',',$this->keys).')');
		$rows = $database->loadObjectList();

		foreach ( $rows as $row ) {
			if ( $row->isnotnull && (!isset($this->submitted[$row->id]) || empty($this->submitted[$row->id])) ) {
				$this->err_msg[] = '* '.sprintf($formclass->lng->ERR_FIELD_EMPTY, $row->field_label).' *';
			}
			if ($row->field_type == 'file')  {
				if ($row->field_value) {
			        $validimages = explode(',', $row->field_value);
			    }

				if ( $row->isnotnull && empty($this->submitted[$row->id]['name']) ) {
					$this->err_msg[] = '* '.sprintf($formclass->lng->ERR_FIELD_EMPTY, $row->field_label).' *';
				}
				if ( $this->submitted[$row->id]['size'] > $this->maxsize * 1024 ) {
					$this->err_msg[] = '* '.$row->field_label.' - '.sprintf($formclass->lng->EMSG_MAXFILESIZE, $this->maxsize).' *';
				}
				if ( !empty($this->submitted[$row->id]['name']) && isset($validimages) && !in_array($fmanager->FileExt($this->submitted[$row->id]['name']), $validimages) ) {
					$this->err_msg[] = '* '.$row->field_label.' - '.$formclass->lng->EMSG_UNSUPPORTIMAGE.' *';
				}
			}
			if ( ($row->field_type == 'email') && trim($this->submitted[$row->id]) && (preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", trim($this->submitted[$row->id]) ) == false) ) {
				$this->err_msg[] = '* '._GEM_REGWARN_MAIL.' *';
			}

		}

		return;
	}


	/*****************/
	/* RUN COMPONENT */
	/*****************/
	public function run() {
		global $mainframe, $formclass;

/*
		$_SESSION["botAkFormMSG"] = null;
		$_SESSION["botAkFormERR"] = null;
*/

		if ( !count($this->err_msg) ) {
			switch($this->task) {
				case 'submit':
					$this->sendData();
				break;
				case 'save':
					$this->saveData();
				break;
				case 'reset':
					$this->resetData();
				break;
				case 'view':
					$this->showValue();
					return;
				break;
				case 'edit':
					$this->editValue();
					return;
				break;
				case 'delete':
					$this->deleteValue();
					return;
				break;
				case 'download':
					$this->downloadFile();
					return;
				break;
				default:
					$this->listForms();
					return;
				break;
			}
		}

		if ($this->redirect) {
			if ( !count($this->err_msg) ) {
				$msg = $this->msg;
				$_SESSION["botAkFormMSG"] = $msg;
				$_SESSION["botAkFormERR"] = '';
			} else {
				$msg = implode("<br/>", $this->err_msg);
				$_SESSION["botAkFormMSG"] = '';
				$_SESSION["botAkFormERR"] = $msg;

				if ( $this->editmode ) {
					$this->redirect = $formclass->secureURL(sefRelToAbs('index.php?option=com_akforms&Itemid='.$Itemid.'&task=edit&id='.$this->editmode));
				}
			}

			$_SESSION["botAkFormAnchor"] = 'akForm'.$this->fid;

			mosRedirect($this->redirect);
		} else {
			if ( count($this->err_msg) ) {
				elxError($this->err_msg);
				return;
			}

    		echo '<h1 class="contentheading">'.$formclass->lng->MSG_TITLE.'</h1>'._LEND;
 			echo '<p>'.$this->msg.'</p>'._LEND;
			echo '<div class="back_button"><a href="javascript:history.go(-1);" title="'._BACK.'">'._BACK.'</a></div>'._LEND;
		}
	}

	private function upload_file($file) {
		global $formclass, $mosConfig_absolute_path;

		if ( ($file['tmp_name'] !='') ) {
			if ( is_uploaded_file($file['tmp_name']) ) {
            	if ( move_uploaded_file($file['tmp_name'], $mosConfig_absolute_path.'/tmpr/'.$file['name'])) {
					$this->attachments[] = $mosConfig_absolute_path.'/tmpr/'.$file['name'];
					return $mosConfig_absolute_path.'/tmpr/'.$file['name'];
                } else {
                	$this->err_msg[] = $formclass->lng->$ERR_MOVE_FILE;
		        }
			} else {
				$this->err_msg[] = $formclass->lng->ERR_UPLOAD_FILE;
				return;
			}
		}
	}

	private function getEncString($string='') {
		global $mosConfig_secret;
		$enc = $string.date('Ymd').$mosConfig_secret;
	    if (isset($_SERVER['HTTP_USER_AGENT'])) {
    	    $enc .= $_SERVER['HTTP_USER_AGENT'];
	    }
    	if (isset($_SERVER['REMOTE_ADDR'])) {
	        $enc .= $_SERVER['REMOTE_ADDR'];
    	}
	    return md5($enc);
	}

	private function postFormValue($form_id, $value, $date, $unic, $fid=NULL, $tmp=NULL, $dexpire=0) {
		global $database, $my;

		$row = new formvaldb($database);
		$row->id = $fid;
		$row->field_id = $form_id;
		$row->value = $value;
		$row->post_date = $date;
		$row->user_id = $my->id;
		$row->unic = $unic;
		$row->istemp = $tmp;
		$row->isread = 0;
		if ( $tmp ) {
			$row->expire = date('Y-m-d H:i:s', time()+60*60*24*$dexpire);
		} else {
			$row->expire = NULL;
		}

		$row->store(true);

		unset($row);
	}

	/*******************************************/
	private function sendData() {
		global $mainframe, $_VERSION, $database, $formclass, $fmanager, $lang;

		$database->setQuery('SELECT * FROM #__akforms WHERE id = '.$this->fid);
		$database->LoadObject($form);

		if ( !$form->id ) {
			$mainframe->checkSendHeaders();
			echo "<script> alert('".$formclass->lng->INVALID_FORM_ID."'); window.history.go(-1); </script>\n";
			exit();
		}

		$database->setQuery('SELECT description FROM #__akforms_langs WHERE ref_id='.$form->id.' AND ref_type="ONSUCCESS" AND language="'.$lang.'"');
		$onsuccess = $database->LoadResult();
		if ( $onsuccess ) {
			$form->onsuccess = $onsuccess;
		}

		$database->setQuery('SELECT label FROM #__akforms_langs WHERE ref_id='.$form->id.' AND ref_type="SUBJECT" AND language="'.$lang.'"');
		$subject = $database->LoadResult();
		if ( $subject ) {
			$form->mail_subject = $subject;
		}

		$database->setQuery('SELECT label FROM #__akforms_langs WHERE ref_id='.$form->id.' AND ref_type="PRECOPY" AND language="'.$lang.'"');
		$precopy = $database->LoadResult();
		if ( $precopy ) {
			$form->pre_copy_text = $precopy;
		}


		/* SECURITY CHECK */
		if ($form->captcha) {
	        $code = $this->getEncString(trim( mosGetParam($_POST, 'code', '')));
    	    if ($code != $_SESSION['captcha']) {
				$this->err_msg[] = _E_INV_SECCODE;
				return;
	        }
    	}

		$msg  = $formclass->lng->MSG_TITLE." - <b>".$form->name."</b><br />";

		$database->setQuery('SELECT * FROM #__akform_items WHERE form_id = '.$this->fid.' AND id IN ('.implode(',',$this->keys).') ORDER BY ordering');
		$rows = $database->loadObjectList();

		$copy_emails = '';

		$post_date = date('Y-m-d H:i:s');

		$sid = mosGetParam( $_COOKIE, 'akFormCID', array() );

		if ( $sid[$form->id] ) {
			$unic = $sid[$form->id];
		} else {
			$unic = md5(uniqid(rand(), true).$post_date);
		}

		foreach ( $rows as $row ) {
			$database->setQuery('SELECT id FROM #__akform_values WHERE field_id='.$row->id.' AND istemp=1 AND unic="'.$unic.'"');
			$val_id = $database->loadResult();

			$value = '';
			if ( $row->field_type == 'file' ) {
				if ( $this->submitted[$row->id]['name'] ) {
					if ( $this->submitted[$row->id]['old'] && $this->submitted[$row->id]['name'] ) {
						$fn = explode('|',$this->submitted[$row->id]['old']);
        	            $this->deleteFile($fn[0]);
					}
					$fname = $this->upload_file($this->submitted[$row->id]);

					if ( count($this->err_msg) ) {
						return;
					}

					$bname = basename($fname);

					$fld = $formclass->cfg->get('GFFOLDER_FILES');
					if ( in_array($row->where_include, array(0, 1)) && $form->save_post_data && !empty($fld) && is_dir($mainframe->getCfg('absolute_path').$fld) && file_exists($mainframe->getCfg('absolute_path').$fld) ) {
						$lowfilenamex = md5(uniqid(rand(), true).$fname).'-'.time().'.'.$fmanager->FileExt($fname);
						$dest = $mainframe->getCfg('absolute_path').$fld.'/'.$lowfilenamex;
						if ( $fmanager->copyFile($fname, $dest) ) {
							$value = $lowfilenamex.'|'.$bname;
						}
					}
				} else {
					$value = $this->submitted[$row->id]['old'];
					if ( $this->delfile[$row->id] ) {
						$fn = explode('|',$value);
        	            $this->deleteFile($fn[0]);
						$value = '';
					}
				}
			} else if ( $row->field_type == 'table' ) {

				$table = $this->submitted[$row->id];
				$msgvalue = '';
				$value = '';
				if ( is_array($table) ) {
					$vtable = array();
    		        $msgvalue .= '<table border="1">';
                    foreach ($table as $_r => $_row) {
                    	if ( empty($_row)) { continue; }
						$tdrow = array();
						$myTr =	'<tr>';
                    	foreach ($_row as $_c => $_sell) {
							$myTr .= '<td>'.$_sell."</td>";
							$tdrow[] = $_sell;
						}
						$myTr .= "</tr>";
						$vtable[] = implode('~',$tdrow);
						unset($tdrow);
						$msgvalue .= $myTr;
                    }
                    $msgvalue .= '</table>';
					$value = implode('|', $vtable);
				}
				if ( in_array($row->where_include, array(0, 2)) ) {
					$msg .= '<b>'.$row->field_label.'</b>: '.(empty($msgvalue) ? '' : $msgvalue).'<br />';
				}
			} else {
				$value = $this->submitted[$row->id];
				if ( is_array($value) ) {
					$value = implode(',', $value);
				}
				if ( in_array($row->where_include, array(0, 2)) ) {
					$msg .= '<b>'.$row->field_label.'</b>: '.(empty($value) ? '' : nl2br($value)).'<br />';
				}
			}

			if ( $form->save_post_data && in_array($row->where_include, array(0, 1))) {
				$this->postFormValue($row->id, $value, $post_date, $unic, $val_id);
			}

			if ($row->field_type == 'email') {
				$value = $this->submitted[$row->id];
				if ( is_array($value) ) {
					$value = implode(',', $value);
				}
				if (!empty($value)) {
					if (!empty($copy_emails)) $copy_emails .= ',';
					$copy_emails .=  $value;
				}
			}

			/* ------- */
			if ( count($this->err_msg) ) {
				return;
			}
		}

		setcookie('akFormCID['.$form->id.']', NULL, time(), '/');

	    $msg .= _DATE.": ".mosFormatDate(date('Y-m-d H:i:s', time() + $mainframe->getCfg('offset') * 3600))."<br />";
		$msg .= "<br />";
		$msg .= '<a href="'.$mainframe->getCfg('live_site').'">'.$mainframe->getCfg('sitename').'</a>';
		$msg .= "<br />";

        $recipients = explode(',', $form->emails);

		if ($form->mail_subject) {
			$subject = $form->mail_subject;
		} else {
			$subject = $formclass->lng->MSG_TITLE.' - '.$form->name;
		}

		$is_copy = array();

		if ($this->fcopy) {
			if ( !empty($this->copy_email) ) {
				$recipients[] = $this->copy_email;
				$is_copy[] = $this->copy_email;
			} else {
				$recipients = array_merge($recipients, explode(',', $copy_emails));
				$is_copy = array_merge($is_copy, explode(',', $copy_emails));
			}
		}

		foreach ($recipients as $recipient) {
			$body_msg = $msg;
			if ( in_array($recipient, $is_copy) ) {
				$body_msg = $form->pre_copy_text."<br/>".$msg;
			}
			if ( mosMail($mainframe->getCfg('mailfrom'), $mainframe->getCfg('fromname'), $recipient, $subject, $body_msg, 1, NULL, NULL, $this->attachments) ) {
				if ($form->onsuccess) {
					$this->msg = $form->onsuccess;
				} else {
					$this->msg = $formclass->lng->SEND_SUCCESS;
				}
				$_SESSION["botAkFormSubmitted"] = null;
			} else {
				$this->err_msg[] = $formclass->lng->ERR_SEND_MAIL;
				return;
			}
		}
	}

	private function deleteFile($fname) {
		global $formclass, $mainframe;

		$fld = $formclass->cfg->get('GFFOLDER_FILES');

		if ( !empty($fld) && is_dir($mainframe->getCfg('absolute_path').$fld) && file_exists($mainframe->getCfg('absolute_path').$fld) ) {
			$fname = $mainframe->getCfg('absolute_path').$fld.'/'.$fname;
			if ( is_file($fname) && file_exists($fname) ) {
				unlink($fname);
			}
		}
	}

	/*******************************************/
	private function saveData() {
		global $mainframe, $_VERSION, $database, $formclass, $fmanager, $lang;

		$database->setQuery('SELECT * FROM #__akforms WHERE id = '.$this->fid);
		$database->LoadObject($form);

		if ( !$form->id ) {
			$mainframe->checkSendHeaders();
			echo "<script> alert('".$formclass->lng->INVALID_FORM_ID."'); window.history.go(-1); </script>\n";
			exit();
		}

		$msg  = $formclass->lng->MSG_TITLE." - <b>".$form->name."</b><br />";

		$database->setQuery('SELECT * FROM #__akform_items WHERE form_id = '.$this->fid.' AND id IN ('.implode(',',$this->keys).') ORDER BY ordering');
		$rows = $database->loadObjectList();

		$post_date = date('Y-m-d H:i:s');
		$sid = mosGetParam( $_COOKIE, 'akFormCID', array() );

		if ( $sid[$form->id] ) {
			$unic = $sid[$form->id];
		} else {
			$unic = md5(uniqid(rand(), true).$post_date);
		}

		$dexpire = $formclass->cfg->get('EXPIRE_DAY', 1);

		foreach ( $rows as $row ) {
			$database->setQuery('SELECT id FROM #__akform_values WHERE field_id='.$row->id.' AND istemp=1 AND unic="'.$unic.'"');
			$val_id = $database->loadResult();
            $value = '';

			if ( $row->field_type == 'file' ) {
				if ( $this->submitted[$row->id]['name'] ) {
					if ( $this->submitted[$row->id]['old'] && $this->submitted[$row->id]['name'] ) {
						$fn = explode('|',$this->submitted[$row->id]['old']);
        	            $this->deleteFile($fn[0]);
					}
					$fname = $this->upload_file($this->submitted[$row->id]);

					if ( count($this->err_msg) ) {
						return;
					}

					$bname = basename($fname);

					$fld = $formclass->cfg->get('GFFOLDER_FILES');
					if ( in_array($row->where_include, array(0, 1)) && $form->save_post_data && !empty($fld) && is_dir($mainframe->getCfg('absolute_path').$fld) && file_exists($mainframe->getCfg('absolute_path').$fld) ) {
						$lowfilenamex = md5(uniqid(rand(), true).$fname).'-'.time().'.'.$fmanager->FileExt($fname);
						$dest = $mainframe->getCfg('absolute_path').$fld.'/'.$lowfilenamex;
						if ( $fmanager->copyFile($fname, $dest) ) {
							$value = $lowfilenamex.'|'.$bname;
						}
					}
				} else {
					$value = $this->submitted[$row->id]['old'];
					if ( $this->delfile[$row->id] ) {
						$fn = explode('|',$value);
        	            $this->deleteFile($fn[0]);
						$value = '';
					}
				}
			} else if ( $row->field_type == 'table' ) {
				$rows = $this->submitted[$row->id];
				$table = array();
				foreach ($rows as $trow) {
					$tdrow = array();
					foreach ($trow as $td) {
						$tdrow[] = $td;
					}
					$table[] = implode('~',$tdrow);
					unset($tdrow);
				}
				$value = implode('|', $table);
			} else {
				$value = $this->submitted[$row->id];
				if ( is_array($value) ) {
					$value = implode(',', $value);
				}
			}
			$this->postFormValue($row->id, $value, $post_date, $unic, $val_id, 1, $dexpire);
		}

		$_SESSION["botAkFormSubmitted"] = null;

		setcookie('akFormCID['.$form->id.']', $unic, time()+60*60*24*$dexpire, '/');

		$this->msg = $formclass->lng->FORM_DATA_SAVED;
	}

	/*******************************************/
	private function resetData() {
		global $mainframe, $_VERSION, $database, $formclass, $fmanager, $lang;

		$database->setQuery('SELECT * FROM #__akforms WHERE id = '.$this->fid);
		$database->LoadObject($form);

		if ( !$form->id ) {
			$mainframe->checkSendHeaders();
			echo "<script> alert('".$formclass->lng->INVALID_FORM_ID."'); window.history.go(-1); </script>\n";
			exit();
		}

		$_SESSION["botAkFormSubmitted"] = NULL;

		$sid = mosGetParam( $_COOKIE, 'akFormCID', array() );
		$unic = $sid[$form->id];

		$database->setQuery('DELETE FROM #__akform_values WHERE istemp=1 AND unic="'.$unic.'"');
		$database->query();

		setcookie('akFormCID['.$form->id.']', null, time(), '/');
	}

	private function loadHeader() {
		global $mainframe, $formclass;

		$mainframe->addCustomHeadTag('<link href="'.$formclass->url.'/css/akforms.css" rel="stylesheet" type="text/css" media="all" />');
	}

	private function listForms() {
		global $database, $my, $lang, $formclass, $mainframe;

		if ( !$my->id ) {
			elxError(_NOT_AUTH, 1);
			return;
		}

		self::loadHeader();

		$database->setQuery('SELECT DISTINCT v.unic as id, IF(l.label IS NOT NULL, l.label, a.NAME) AS name, v.post_date
								FROM #__akforms a LEFT JOIN #__akforms_langs l ON l.ref_id=a.id AND l.ref_type="TITLE" AND l.LANGUAGE="'.$lang.'",
									 #__akform_items i,
									 #__akform_values v
								WHERE a.id = i.form_id AND
									  i.id = v.field_id AND
									  v.istemp IS NULL AND
									  v.user_id='.intval($my->id).' AND
									  a.allow_see_senddata = 1
								ORDER BY 3 DESC');
		$submitted = $database->loadObjectList();


		$database->setQuery('SELECT DISTINCT v.unic as id, IF(l.label IS NOT NULL, l.label, a.NAME) AS name, v.post_date
								FROM #__akforms a LEFT JOIN #__akforms_langs l ON l.ref_id=a.id AND l.ref_type="TITLE" AND l.LANGUAGE="'.$lang.'",
									 #__akform_items i,
									 #__akform_values v
								WHERE a.id = i.form_id AND
									  i.id = v.field_id AND
									  v.istemp=1 AND
									  v.user_id='.intval($my->id).' AND
									  a.allow_see_savedata = 1
								ORDER BY 3 DESC');
		$saved = $database->loadObjectList();

		akFormsHTML::listForms( $submitted, $saved );
	}

	private function showValue() {
		global $database, $mainframe, $formclass, $my;

		if ( !$my->id ) {
			elxError(_NOT_AUTH, 1);
			return;
		}

		self::loadHeader();

		$unic = mosGetParam($_REQUEST, 'id', '');

		$database->setQuery('SELECT i.*, v.value as post_value
								FROM #__akform_values v, #__akform_items i
								WHERE v.unic = "'.$unic.'" and v.field_id = i.id AND v.user_id='.$my->id.'
								ORDER BY i.ordering');
		$rows = $database->loadObjectList();

		$lists = array();

		akFormsHTML::showValue( $rows, $lists);
	}

	private function editValue() {
		global $_MAMBOTS, $my, $database, $formclass, $mainframe, $Itemid;

		if ( !$my->id ) {
			elxError(_NOT_AUTH, 1);
			return;
		}

/*
		$_SESSION["botAkFormMSG"] = null;
		$_SESSION["botAkFormERR"] = null;
*/

		$unic = mosGetParam($_REQUEST, 'id', '');

		$database->setQuery('SELECT i.form_id FROM #__akform_values v, #__akform_items i
								WHERE v.unic = "'.$unic.'" AND v.user_id='.$my->id.' AND v.field_id=i.id',
							'#__', 1, 0);
		$fid = $database->loadResult();

		if ( !$fid ) {
    		$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$formclass->lng->$INVALID_FORM_ID."'); window.history.go(-1);</script>\n";
			exit();
		}

		setcookie('akFormCID['.$fid.']', $unic, time()+60*60*24*1, '/');

		$row = new stdClass();
		$row->id = $fid;
		$row->text = '{akforms}'.$fid.'{/akforms}';
		$_MAMBOTS->loadBotGroup('content');

		$params = new mosParameters( '' );
		$params->redirect = $formclass->secureURL(sefRelToAbs('index.php?option=com_akforms&Itemid='.$Itemid));
		$params->editmode = $unic;

		$args = array(&$row, &$params, 0);
		$_MAMBOTS->trigger('onPrepareContent', $args, true);

		akFormsHTML::editValue( $row );

		unset($row, $params);

	}

	private function deleteValue() {
		global $database, $mainframe, $formclass, $my, $Itemid;

		if ( !$my->id ) {
			elxError(_NOT_AUTH, 1);
			return;
		}

		$unic = mosGetParam($_REQUEST, 'id', '');

		$database->setQuery("SELECT a.*
								FROM #__akform_values a, #__akform_items b
								WHERE a.unic = '".$unic."' AND a.field_id = b.id AND b.field_type='file'");
		$rows = $database->loadObjectList();

		$fld = $formclass->cfg->get('GFFOLDER_FILES');

		if ( !empty($fld) && is_dir($mainframe->getCfg('absolute_path').$fld) && file_exists($mainframe->getCfg('absolute_path').$fld) ) {
			foreach ($rows as $row) {
				$files = explode('|', $row->value);
       			$fname = $mainframe->getCfg('absolute_path').$fld.'/'.$files[0];
				if ( is_file($fname) && file_exists($fname) ) {
					unlink($fname);
				}
			}
		}

		$database->setQuery('DELETE FROM #__akform_values
								WHERE unic = "'.$unic.'" AND user_id='.$my->id);
		$database->query();

		$link = sefRelToAbs('index.php?option=com_akforms&Itemid='.$Itemid);

		mosRedirect( $link );
	}

	private function downloadFile() {
		global $database, $formclass, $fmanager, $mainframe;

		$file = mosGetParam( $_REQUEST, 'file', '' );
		$name = mosGetParam( $_REQUEST, 'name', '' );

		$fld = $formclass->cfg->get('GFFOLDER_FILES');
		$ext = $fmanager->FileExt($file);

		if ( !empty($file) && is_dir($mainframe->getCfg('absolute_path').$fld) && file_exists($mainframe->getCfg('absolute_path').$fld.'/'.$file) ) {
			header('Content-type: application/'.$ext);
			header('Content-Disposition: attachment; filename="'.$name.'"');

			readfile($mainframe->getCfg('absolute_path').$fld.'/'.$file);
		}

		exit;
	}

}

function akfc_removebots($text) {
	$text = preg_replace("#{addphp\s*(.*?)}#i", '', $text); //this bot needs special care
	$text = preg_replace("#{.+?}(.*?){/.+?}#s", '', $text);
	$text = preg_replace("#{.+?}#", '', $text);
	return $text;
}

$forms = new akForms();
$forms->run();
unset($forms, $formclass);

?>