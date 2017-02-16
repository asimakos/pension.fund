<?php
/**
* @version: 1.7
* @package: Component AkForms
* @author: Andrew Campball
* @email: ACampball@yandex.ru
* @link:
* @license: GPL
* @copyright: (C) 2009 Andrew Campball. All rights reserved.
* @description: AkForms component for Elxis CMS.
*****************************************************************************/

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' ) ||
	$acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_akforms' ))) {
	mosRedirect('index2.php', $adminLanguage->A_NOT_AUTH);
}

global $mainframe;
require_once($mainframe->getCfg('absolute_path').'/administrator/components/com_akforms/admin.akforms.html.php');
require_once($mainframe->getCfg('absolute_path').'/administrator/components/com_akforms/includes/akforms.class.php');


$cid = mosGetParam( $_REQUEST, 'cid', array( 0 ) );
if (!is_array( $cid )) {
	$cid = array ( 0 );
}

//in order to work direct edit user link with register_globals off
$id = mosGetParam( $_GET, 'id', '0' );
$fid = mosGetParam( $_GET, 'fid', '0' );

$akforms = new AkFormClass();

class akFormsBack {

	private $task = '';

	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
		$this->task = htmlspecialchars(trim(mosGetParam($_REQUEST, 'task', '')));
	}


	/********************/
	/* RUN FOREST, RUN! */
	/********************/
	public function run() {
	    global $cid, $id, $fid, $mainframe, $akforms;

		echo '<link href="'.$akforms->aurl.'/css/aakforms.css" rel="stylesheet" type="text/css" media="all" />';
		echo '<script type="text/javascript" src="'.$akforms->aurl.'/js/jquery.js"></script>';
		echo '<script type="text/javascript">jQuery.noConflict();</script>';
		echo '<script type="text/javascript" src="'.$akforms->aurl.'/js/jquery-ui-sort.min.js"></script>';
		echo '<script type="text/javascript" src="'.$akforms->aurl.'/js/jquery.fixer.js"></script>';

		switch ($this->task) {
			case 'config':
				$this->configure();
			break;
			case 'saveconfig':
				$this->saveConfig();
			break;
			case 'cancelconfig':
				mosRedirect('index2.php?option=com_akforms');
			break;

			/**************/
            /* Формы      */
			/**************/
			case 'forms':
				$this->listForms();
			break;
			case 'copyform':
				$this->copyForm( $cid );
			break;
			case 'newform':
				$this->editForm(0);
			break;
			case 'editform':
				$this->editForm($id);
			break;
			case 'cancelform':
				mosRedirect('index2.php?option=com_akforms&task=forms');
			break;
			case "publishform":
				$this->publishForm( $cid, 1);
			break;
			case "unpublishform":
				$this->publishForm( $cid, 0);
			break;
			case 'applform':
			case 'saveform':
				$this->saveForm($this->task);
			break;
			case 'removeform':
				$this->deleteForm($cid);
			break;

			case 'import':
				$step = mosGetParam( $_POST, 'step', '0' );
				switch ($step) {
					case 1: $this->importForm(); break;
					default: akFormsHTML::importForm();	break;
				}
			break;

			case 'export':
				$this->exportForm($cid);
			break;

			/**************/
            /* Поля       */
			/**************/
			case 'fields':
				$this->listFields();
			break;
			case 'copyfield':
				$this->copyField( $cid );
			break;
			case 'newfield':
				$fid = $mainframe->getUserStateFromRequest( "filter{com_akforms}{fields}", 'filter_form', 0 );
				$this->editField(0, $fid);
			break;
			case 'editfield':
				$this->editField($id, $fid);
			break;
			case 'applfield':
			case 'savefield':
				$this->saveField($this->task);
			break;
			case 'removefield':
				$this->deleteField($cid);
			break;
			case 'cancelfield':
				mosRedirect('index2.php?option=com_akforms&task=fields');
			break;
			case "publishfield":
				$this->publishField( $cid, 1);
			break;
			case "unpublishfield":
				$this->publishField( $cid, 0);
			break;
			case 'orderupfield':
				$this->orderField( $cid[0], -1 );
			break;
			case 'orderdownfield':
				$this->orderField( $cid[0], 1 );
			break;

			case 'setaccessfield':
		        $access = mosGetParam( $_REQUEST, 'access', 29 );
        		$sid = mosGetParam( $_REQUEST, 'id', $cid[0] );
				$this->setAccessField( $sid, $access );
			break;
			case 'setwhereinc':
		        $whereinc = mosGetParam( $_REQUEST, 'where', 0 );
        		$sid = mosGetParam( $_REQUEST, 'id', $cid[0] );
				$this->setWhereIncField( $sid, $whereinc );
			break;
			case 'saveorder':
				$this->saveOrderFields( $cid );
			break;

			/**************/
            /* Данные       */
			/**************/
			case 'data':
				$this->listValues();
			break;
			case 'viewdata':
				$unic = mosGetParam( $_REQUEST, 'unic', '' );
				$this->showValues($unic);
			break;
			case 'removedata':
				$this->deleteValues( $cid );
			break;
			case 'unread':
				$this->markUnreadValues( $cid );
			break;

			case 'download':
				$this->downloadFile();
			break;
			/* ============== */
			case 'cpanel':
			default:
				akFormsHTML::controlpanel();
			break;
		}
	}


	/********************************/
	/* GET FRONT-END FORMS          */
	/********************************/
	private function getforms() {
		global $database;

		$query = "SELECT id, name FROM #__akforms ORDER BY name";
		$database->setQuery($query);
		$rows = $database->loadObjectList();

		$forms = array();
		foreach ($rows as $row) {
			$forms[] = mosHTML::makeOption($row->id, $row->name);
		}
		return $forms;
	}

	/********************************/
	/* GET FRONT-END FORMS          */
	/********************************/
	private function getftypes() {
		global $database, $akforms;

		$ftypes = array();
		foreach ($akforms->ftypes as $row) {
			$ftypes[] = mosHTML::makeOption($row, $row);
		}
		return $ftypes;
	}

	private function getformgroups($form_id) {
		global $database;

		$query = "SELECT id, title FROM #__akforms_groups WHERE form_id=".intval($form_id)." ORDER BY title";
		$database->setQuery($query);
		$rows = $database->loadObjectList();

		$gforms = array();
		$gforms[] = mosHTML::makeOption('', '');
		foreach ($rows as $row) {
			$gforms[] = mosHTML::makeOption($row->id, $row->title);
		}
		return $gforms;
	}

	/****************************************/
	/* PREPARE TO SHOW CONFIGURATION SCREEN */
	/****************************************/
	private function configure() {
		global $akforms;

		$lists = array();

		$days = array();
		for ($x=1;$x<31;$x++) {
			$days[] = mosHTML::makeOption($x, $x);
		}
		$lists['expire_day'] = mosHTML::selectList( $days, 'CFG_EXPIRE_DAY', 'class="selectbox" size="1"', 'value', 'text', $akforms->cfg->get('EXPIRE_DAY', 0) );
		unset($days);

		akFormsHTML::showconfig($lists);
	}

	/**********************/
	/* SAVE CONFIGURATION */
	/**********************/
	private function saveConfig() {
		global $akforms, $mainframe, $fmanager;

		$folder_files = mosGetParam($_POST, 'CFG_FOLDER_FILES', '/components/com_akforms/files');

		$config = "<?php \n\n";
		$config .= "/* AkForms by Andrew Campball (ACampball@yandex.ru) for Elxis CMS */\n";
		$config .= "/* Last saved on ".date('Y-m-d H:i:s')." */\n\n";
		$config .= "defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');\n\n";
		$config .= "class akFormsConfig {\n\n";
		$config .= 'private $COPYRIGHT = '.intval(mosGetParam($_POST, 'CFG_COPYRIGHT', 1)).";\n";
		$config .= 'private $GFMAXFILESIZE = '.intval(mosGetParam($_POST, 'CFG_MAXFILESIZE', 300)).";\n";
		$config .= 'private $GFFOLDER_FILES = \''.$folder_files."';\n";
		$config .= 'private $EXPIRE_DAY = '.intval(mosGetParam($_POST, 'CFG_EXPIRE_DAY', 1)).";\n";
		$config .= 'private $SSL = '.intval(mosGetParam($_POST, 'CFG_SSL', 0)).";\n";
		$config .= "public function __construct() {\n";
		$config .= "}\n\n";
		$config .= 'public function get($var=\'\') {'._LEND;
		$config .= 'if (($var != \'\') && isset($this->$var)) { return $this->$var; }'._LEND;
		$config .= 'return \'\';'._LEND;
		$config .= "}\n\n";
		$config .= "}\n\n";
		$config .= '?>';

		$ok = $fmanager->writeFile($akforms->apath.'/config.akforms.php', $config);

		$create_folder = intval(mosGetParam($_POST, 'create_folder', 0));

		$folder = $mainframe->getCfg('absolute_path').$folder_files;

		if ( $create_folder && !file_exists($folder) ) {
			$fmanager->createFolder( $folder );
		}

		mosRedirect('index2.php?option=com_akforms');
	}

	/**********************/
	/* FORMS              */
	/**********************/
	private function listForms() {
		global $database, $mainframe, $mosConfig_absolute_path;

		require_once( $mosConfig_absolute_path.'/administrator/includes/pageNavigation.php' );

		$limit = $mainframe->getUserStateFromRequest("view{com_akforms}{forms}", 'limit', 0);
		$limitstart = $mainframe->getUserStateFromRequest("view{com_akforms}{forms}", 'limitstart', 0);

		$limit = ($limit ? $limit : $mainframe->getCfg('list_limit'));

        $lists = array();

		$query = "SELECT count(*) FROM #__akforms";
		$database->setQuery( $query );
		$total = $database->loadResult();

		$pageNav = new mosPageNav( $total, $limitstart, $limit );

		$database->setQuery('SELECT * FROM #__akforms ORDER BY name', '#__', $pageNav->limit, $pageNav->limitstart );
		$rows = $database->loadObjectList();

		akFormsHTML::listForms( $rows, $lists, $pageNav );

		unset($lists, $rows, $pageNav);
	}

	private function copyForm($cid) {
		global $database, $mainframe, $akforms;

		$cids = implode( ',', $cid );

		$row = new formdb($database);
		foreach( $cid as $id ) {
			$row->load( $id );
			$row->id = NULL;
			$row->name = $akforms->lng->COPY_SUFFIX.' '.$row->name;
			if ( !$row->store() ) {
				echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
				exit();
			}
			$database->setQuery('SELECT id FROM #__akform_items WHERE form_id = '.$id);
			$items = $database->loadObjectList();
			foreach ($items as $item) {
				$itm = new formitemdb($database);
				$itm->load($item->id);
				$itm->id      = null;
				$itm->form_id = $row->id;
				$itm->store();
				unset($itm);
			}
		}

		mosRedirect( 'index2.php?option=com_akforms&task=forms');
	}

	private function editForm($cid) {
		global $database, $mainframe, $akforms;

		$row = new formdb($database);
		$row->load($cid);

		$lists = array();

		$lists['btsend'] = $akforms->getTranslation($row->id, 'BTSEND');
		$lists['onsuccess'] = $akforms->getTranslation($row->id, 'ONSUCCESS');
		$lists['subject'] = $akforms->getTranslation($row->id, 'SUBJECT');
		$lists['precopy'] = $akforms->getTranslation($row->id, 'PRECOPY');
		$lists['title'] = $akforms->getTranslation($row->id, 'TITLE');

		$database->setQuery('SELECT * FROM #__akforms_groups WHERE form_id = '.$row->id.' ORDER BY title');
		$lists['groups'] = $database->loadObjectList();

		akFormsHTML::editForm( $row, $lists);
	}

	private function saveForm($task) {
		global $database, $akforms, $mainframe;

		$row = new formdb($database);
		if (!$row->bind( $_POST )) {
    		$mainframe->checkSendHeaders();
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}

    	$row->name = trim($row->name);

		if ($row->name == '') {
    		$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$akforms->lng->EMSG_EMPTY_NAME."'); window.history.go(-1);</script>\n";
			exit();
		}

		if (!$row->store()) {
    		$mainframe->checkSendHeaders();
			echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
			exit();
		}

		$pub_lang = explode(',', $mainframe->getCfg('pub_langs'));

		$btsend = mosGetParam($_POST, 'btsend', array());
		$onsuccess = mosGetParam($_POST, 'aonsuccess', array());
		$subject = mosGetParam($_POST, 'subject', array());
		$precopy = mosGetParam($_POST, 'precopy', array());
		$langname = mosGetParam($_POST, 'langname', array());

		$ins = array();
		foreach ($pub_lang as $plang) {
			if ( $btsend[$plang] ) {
				$ins[] = '('.$row->id.', "BTSEND", "'.$plang.'","'.$btsend[$plang].'","")';
			}
			if ( $onsuccess[$plang] ) {
				$ins[] = '('.$row->id.', "ONSUCCESS", "'.$plang.'","", "'.$onsuccess[$plang].'")';
			}
			if ( $subject[$plang] ) {
				$ins[] = '('.$row->id.', "SUBJECT", "'.$plang.'", "'.$subject[$plang].'","")';
			}
			if ( $precopy[$plang] ) {
				$ins[] = '('.$row->id.', "PRECOPY", "'.$plang.'", "'.$precopy[$plang].'","")';
			}
			if ( $langname[$plang] ) {
				$ins[] = '('.$row->id.', "TITLE", "'.$plang.'", "'.$langname[$plang].'","")';
			}
		}

		/* language description  */
		$database->setQuery('DELETE FROM #__akforms_langs WHERE ref_id='.$row->id.' AND ref_type IN ("BTSEND", "ONSUCCESS", "SUBJECT", "PRECOPY", "TITLE")');
		$database->query();

		if ( count($ins) ) {
			$database->setQuery('INSERT INTO #__akforms_langs (ref_id, ref_type, language, label, description) VALUES '.implode(',', $ins));
			$database->query();
		}

		$groups = mosGetParam($_POST, 'groups', array());

		foreach ($groups as $key => $group) {
			if ( intval($group['del']) == 1 && intval($key) > 0 ) {
				$database->setQuery('DELETE FROM #__akforms_groups WHERE id='.$key);
				$database->query();
			} else if ( intval($key) < 0 ) {
				$database->setQuery('INSERT INTO #__akforms_groups (form_id, title, title_in_value, filter_in_value) VALUES ('.$row->id.',"'.$group['title'].'",'.intval($group['title_in_value']).','.intval($group['filter_in_value']).')');
				$database->query();
			} else {
				$database->setQuery('UPDATE #__akforms_groups SET title="'.$group['title'].'", title_in_value='.intval($group['title_in_value']).', filter_in_value='.intval($group['filter_in_value']).' WHERE id ='.intval($key));
				$database->query();
			}
		}

		if ($task == 'applform') {
			mosRedirect( 'index2.php?option=com_akforms&task=editform&id='.$row->id.'&hidemainmenu=1');
		} else {
			mosRedirect( 'index2.php?option=com_akforms&task=forms');
		}
	}

	private function deleteForm($cid) {
		global $database, $aCatalog, $mainframe;

		$cids = implode( ',', $cid );

		$query = 'DELETE FROM #__akforms_langs WHERE ref_id IN ('.$cids.') AND ref_type IN ("BTSEND", "ONSUCCESS", "SUBJECT", "PRECOPY", "TITLE")';
		$database->setQuery( $query );
		if (!$database->query()) {
    		$mainframe->checkSendHeaders();
			echo "<script> alert('".$database->stderr()."');</script>\n";
			exit();
		}

		$query = "SELECT id FROM #__akform_items WHERE form_id IN ($cids)";
		$database->setQuery( $query );
		$fields = $database->loadResultArray();

		if ( count($fields) > 0 ) {
			$query = "DELETE FROM #__akform_values WHERE field_id IN (".implode(',',$fields).")";
			$database->setQuery( $query );
			if (!$database->query()) {
	    		$mainframe->checkSendHeaders();
				echo "<script> alert('".$database->stderr()."');</script>\n";
				exit();
			}
    	}
    	unset($fields);

		$query = "DELETE FROM #__akform_items WHERE form_id IN ($cids)";
		$database->setQuery( $query );
		if (!$database->query()) {
    		$mainframe->checkSendHeaders();
			echo "<script> alert('".$database->stderr()."');</script>\n";
			exit();
		}

		$query = "DELETE FROM #__akforms_groups WHERE form_id IN ($cids)";
		$database->setQuery( $query );
		if (!$database->query()) {
    		$mainframe->checkSendHeaders();
			echo "<script> alert('".$database->stderr()."');</script>\n";
			exit();
		}

		$query = "DELETE FROM #__akforms WHERE id IN ($cids)";
		$database->setQuery( $query );
		if (!$database->query()) {
    		$mainframe->checkSendHeaders();
			echo "<script> alert('".$database->stderr()."');</script>\n";
			exit();
		}

		mosRedirect( 'index2.php?option=com_akforms&task=forms');
	}

	private function importForm() {
		global $database, $mainframe, $akforms, $fmanager, $mainframe;

		$file_name = mosGetParam( $_FILES, 'impfile', null );

		if (isset($file_name) && ($file_name['name'] != '') ) {
		    $dest = $fmanager->PathName($mainframe->getCfg('absolute_path').SEP.'tmpr').$file_name['name'];
		    $resultdir = $fmanager->upload( $file_name['tmp_name'], $dest );

			if ($resultdir != false) {
				$xmlDoc = simplexml_load_file($dest, 'SimpleXMLElement');
				if ($xmlDoc) {
					if ($xmlDoc->getName() != 'akforms') {
						mosRedirect( 'index2.php?option=com_akforms&task=forms&msg="Unknow format file!"');
					}

					$cforms = count($xmlDoc->akform);

					for ($x=0; $x<$cforms; $x++) {
						$akform = $xmlDoc->akform[$x];

						$form = new formdb($database);
						$akforms->bindObject($akform, $form);

						$form->id = null;


						if ($form->store()) {
							$_groups = $akform->groups->children();
							$grps = array();
							foreach ($_groups as $_group) {
								$attr = $_group->attributes();

								$fgroup = new formgroupdb($database);
								$fgroup->form_id = $form->id;
								$fgroup->title = (string)$attr->title;
								$fgroup->title_in_value = (string)$attr->title_in_value;
								$fgroup->filter_in_value = (string)$attr->filter_in_value;

								$fgroup->store();

								$grps[(string)$attr->id] = $fgroup->id;

								unset($fgroup);
							}
							unset($_groups);

							$_fields = $akform->fields->children();
							foreach ($_fields as $_field) {
								$fld = new formitemdb($database);
								$akforms->bindObject($_field->attributes(), $fld);

								$fld->id      = null;
								$fld->form_id = $form->id;
								$fld->field_group = $grps[$fld->field_group];
								$fld->store();

								unset($fld);
							}
							unset($_fields, $grps);

							$_languages = $akform->languages->children();
							$tlng = array();
							foreach ($_languages as $_language) {
								$attr = $_language->attributes();
								$tlng[] = '('.(string)$attr->ref_id .', "'.(string)$attr->ref_type.'","'.(string)$attr->language.'", "'.(string)$attr->field_label.'", "'.(string)$_language[0].'")';
							}
							unset($_languages);

							if ( count($tlng) > 0 ) {
								$database->setQuery('INSERT INTO #__akforms_langs (ref_id, ref_type, language, label, description) VALUES '.implode(', ', $tlng));
								$database->query();
							}
							unset($tlng);

						}

						unset($form);
					}
				}
			}
		}

		mosRedirect( 'index2.php?option=com_akforms&task=forms');
	}

	private function exportForm($_id) {
		global $database, $mainframe, $akforms;

		$tid = mosGetParam( $_POST, 'tid', '' );
		$cid = explode(',', $tid);

		$schema = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
		$schema .= "<akforms>\n";

		$row = new formdb($database);
		foreach( $cid as $id ) {
			$row->load( $id );
			if ($row->id) {
				$schema .= "<akform id=\"".$row->id."\">\n";

				foreach( $row as $key => $val ) {
					$row_val = '';
					if ((substr($key, 0, 1) != '_') && ($key != 'id')) {
						$row_val = $val;
						$schema .= '<'.$key.'>'.$row_val."</".$key.">\n";
					}
				}
				$database->setQuery('SELECT * FROM #__akform_items WHERE form_id = '.$id);
				$items = $database->loadObjectList();
				$schema .= "<fields>\n";

				foreach ($items as $item) {
					$schema .= "<field";
					foreach ($item as $key => $val) {
						$row_val = '';
						if (substr($key, 0, 1) != '_') {
							$row_val = $val;
							$schema .= ' '.$key.'="'.htmlspecialchars($row_val).'"';
						}
					}
					$schema .= ">\n";
					$schema .= "</field>\n";
					unset($flangs);
				}
				$schema .= "</fields>\n";

				/* Languages */
				$database->setQuery('SELECT ref_id, ref_type, language, label, description
										FROM #__akforms_langs
										WHERE ref_id='.$row->id.' AND ref_type IN ("BTSEND", "ONSUCCESS", "SUBJECT", "PRECOPY", "TITLE")');
				$flangs = $database->loadObjectList();
				$schema .= "<languages>\n";
				foreach ($flangs as $flang) {
					$schema .= "<language ref_id=\"".$flang->ref_id."\" ref_type=\"".$flang->ref_type."\" language=\"".$flang->language."\" field_label=\"".htmlspecialchars($flang->label)."\">".$flang->description."</language>\n";
				}
				$schema .= "</languages>\n";

				/* Groups */
				$database->setQuery('SELECT * FROM #__akforms_groups WHERE form_id='.$row->id);
				$groups = $database->loadObjectList();
				$schema .= "<groups>\n";
				foreach ($groups as $group) {
					$schema .= "<group";
					foreach ($group as $key => $val) {
						$row_val = '';
						if (substr($key, 0, 1) != '_') {
							$row_val = $val;
							$schema .= ' '.$key.'="'.htmlspecialchars($row_val).'"';
						}
					}
					$schema .= ">\n";
					$schema .= "</group>\n";
				}
				$schema .= "</groups>\n";

				$schema .= "</akform>\n";
			}
		}
		$schema .= "</akforms>\n";

	    $filename = date('YmdHis');

        @ob_end_clean();
        $xmlfile = $filename.'.xml';
        @header("Cache-Control: "); //leave blank to avoid IE errors
        @header("Pragma: "); //leave blank to avoid IE errors
        @header("Content-type: application/force-download");
        @header("Content-Disposition: attachment; filename=".$xmlfile);
        echo $schema;
        exit();

		mosRedirect( 'index2.php?option=com_akforms&task=forms');
	}

	private function publishForm( $cid, $publish=1 ) {
		global $database, $my, $adminLanguage, $mainframe;

		if (!is_array( $cid ) || count( $cid ) < 1) {
			$action = $publish ? $adminLanguage->A_PUBLISH : $adminLanguage->A_UNPUBLISH;
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_SELITEMTO." ".$action."'); window.history.go(-1);</script>\n";
			exit();
		}

		$cids = implode( ',', $cid );

		$database->setQuery( "UPDATE #__akforms SET published='".$publish."' WHERE id IN (".$cids.")" );
		if (!$database->query()) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
			exit();
		}

		if (count( $cid ) == 1) {
			$row = new formitemdb( $database );
			$row->checkin($cid[0]);
		}
		mosRedirect( 'index2.php?option=com_akforms&task=forms' );
	}

	/**********************/
	/* FIELDS             */
	/**********************/
	private function listFields() {
		global $database, $mainframe, $mosConfig_absolute_path, $adminLanguage;

		$fid = mosGetParam( $_GET, 'fid', '0' );

		require_once( $mosConfig_absolute_path.'/administrator/includes/pageNavigation.php' );

		$limit = $mainframe->getUserStateFromRequest("view{com_akforms}{fields}", 'limit', 0);
		$limitstart = $mainframe->getUserStateFromRequest("view{com_akforms}{fields}", 'limitstart', 0);
		$filter_form = $mainframe->getUserStateFromRequest( "filter{com_akforms}{form}", 'filter_form', 0 );
		$filter_lang = $mainframe->getUserStateFromRequest( "filter{com_akforms}{lang}", 'filter_lang', '' );

	    $formfilters = array(
        	'filter_lang' => $filter_lang
    	);

		$limit = ($limit ? $limit : $mainframe->getCfg('list_limit'));

		if (!$fid) { $fid = $filter_form; }

		$frms = $this->getforms();

		if (!$fid) { $fid = $frms[0]->value; }

        $lists = array();
        $where = array();

		$lists['filter_form'] = mosHTML::selectList( $frms, 'filter_form', ' class="inputbox" size="1" onChange="document.adminForm.submit();"', 'value', 'text', $fid );

		$form = new formdb($database);
		$form->load($fid);

		$lists['form_name'] = $form->name;
		$lists['form_id']   = $form->id;

		if ( $filter_lang != '' ) {
			$where[] = "((a.language LIKE '%$filter_lang%') OR (a.language IS NULL))";
		}


		$query = "SELECT count(*) FROM #__akform_items a WHERE a.form_id = ".intval($fid).(count( $where ) ? " AND " . implode( ' AND ', $where ) : "");
		$database->setQuery( $query );
		$total = $database->loadResult();

		$pageNav = new mosPageNav( $total, $limitstart, $limit );

		$database->setQuery('SELECT a.*, g.name AS groupname FROM #__akform_items a LEFT JOIN #__core_acl_aro_groups g ON g.group_id = a.access
		WHERE a.form_id = '.intval($fid).(count( $where ) ? " AND " . implode( ' AND ', $where ) : "").' ORDER BY a.ordering', '#__', $pageNav->limit, $pageNav->limitstart );
		$rows = $database->loadObjectList();

	    $plangs[] = mosHTML::makeOption( '',$adminLanguage->A_ALL_LANGS );
    	$publs = explode(',', $mainframe->getCfg('pub_langs'));
	    foreach ($publs as $publ) {
    	    $plangs[] = mosHTML::makeOption( $publ, $publ );
	    }

		$lists['flangs'] = mosHTML::selectList( $plangs, 'filter_lang', 'class="selectbox" style="width:100%" size="10" dir="ltr" onchange="document.adminForm.submit( );"', 'value', 'text', $filter_lang );
		unset($plangs);

		akFormsHTML::listFields( $rows, $lists, $pageNav, $formfilters );

		$mainframe->setUserState( "filter{com_akforms}{form}", $fid );

		unset($lists, $rows, $pageNav, $formfilters);
	}

	private function copyField($cid) {
		global $database, $mainframe, $akforms;

		$cids = implode( ',', $cid );
		$fid = 0;

		$row = new formitemdb($database);
		foreach( $cid as $id ) {
			$row->load( $id );
			$row->id = NULL;
			$row->field_label = $akforms->lng->COPY_SUFFIX.' '.$row->field_label;
			$fid = $row->form_id;
			if ( !$row->store() ) {
				echo "<script type=\"text/javascript\">alert('".$row->getError()."'); window.history.go(-1);</script>\n";
				exit();
			}
		}

		mosRedirect( 'index2.php?option=com_akforms&task=fields&fid='.$fid);
	}

	private function editField($id, $fid) {
		global $database, $mainframe, $akforms, $adminLanguage;

		$row = new formitemdb($database);
		$row->load($id);

		if (!$row->id) {
			$row->form_id = $fid;
		}

		$form = new formdb($database);
		$form->load($fid);

		if (!$row->field_type) {
			$row->field_type = $akforms->ftypes[0];
		}

		$lists = array();

		$lists['languages']	= mosAdminMenus::SelectLanguages( 'languages', $row->language, $adminLanguage->A_ALL_LANGS );

		$lists['form_name'] = $form->name;

		$lists['field_group'] = mosHTML::selectList( $this->getformgroups($row->form_id), 'field_group', ' class="inputbox" size="1" onchange="switchoptions();"', 'value', 'text', $row->field_group );
		$lists['field_type'] = mosHTML::selectList( $this->getftypes(), 'field_type', ' class="inputbox" size="1" onchange="switchoptions();"', 'value', 'text', $row->field_type );
        $lists['isnotnull'] = mosHTML::yesnoRadioList( 'isnotnull', 'class="inputbox"', $row->isnotnull );
        $lists['ishide'] = mosHTML::yesnoRadioList( 'ishide', 'class="inputbox"', $row->ishide );
        $lists['readonly'] = mosHTML::yesnoRadioList( 'readonly', 'class="inputbox"', $row->readonly );
        $lists['hidelabel'] = mosHTML::yesnoRadioList( 'hidelabel', 'class="inputbox"', $row->hidelabel );

        $eoptions = explode('|', $row->field_list);
        $dvalues = explode('|', $row->field_value);

        $lists['soptions'] = '';
        $lists['svoptions'] = '';
        $lists['roptions'] = '';
        $lists['coptions'] = '';

        $cnt_list = (count($eoptions) > 5 ? count($eoptions) : 5);

		$arr = array('radio', 'select', 'checkbox');

        for ($i=0; $i<$cnt_list; $i++) {
        	$val = '';
        	$val2 = '';
            $chk = '';
            //if ($row->etype != 'text') {
            if (in_array($row->field_type, $arr)) {
                if ($eoptions[$i]) {
                    $val = $eoptions[$i];
                    if (in_array($eoptions[$i], $dvalues)) {
                        $chk = 'checked';
                    } else {
                        $chk = '';
                    }
                }
            } else if ($row->field_type == 'valselect') {
                if ($eoptions[$i]) {
                	$vals = explode('=', $eoptions[$i]);
                    $val = $vals[0];
                    $val2 = $vals[1];
                    if (in_array($val, $dvalues)) {
                        $chk = 'checked';
                    } else {
                        $chk = '';
                    }
                }
            } else {
                if ($i == '0') {
                    $val = $dvalues[0];
                    $chk = 'checked';
                }
            }
            $lists['soptions'] .= '<span class="sort"><input type="text" name="soption[]" value="'.$val.'" /> '.$akforms->lng->_SELECTED.':
            <input type="radio" name="sdefault" value="'.$i.'" '.$chk.' />&nbsp;<img src="/images/M_images/delete.png" class="delete" /></span>';

            $lists['svoptions'] .= '<span class="sort"><input type="text" name="svoption1[]" value="'.$val.'" />&nbsp;<input type="text" name="svoption2[]" value="'.$val2.'" /> '.$akforms->lng->_SELECTED.':
            <input type="radio" name="svdefault" value="'.$i.'" '.$chk.' />&nbsp;<img src="/images/M_images/delete.png" class="delete" /></span>';

            $lists['roptions'] .= '<span class="sort"><input type="text" name="roption[]" value="'.$val.'" /> '.$akforms->lng->_SELECTED.':
            <input type="radio" name="rdefault" value="'.$i.'" '.$chk.' />&nbsp;<img src="/images/M_images/delete.png" class="delete" /></span>';

            $lists['coptions'] .= '<span class="sort"><input type="text" name="coption[]" value="'.$val.'" /> '.$akforms->lng->_CHECKED.':
            <input type="checkbox" name="cdefault[]" value="'.$i.'" '.$chk.' />&nbsp;<img src="/images/M_images/delete.png" class="delete" /></span>';
        }

		$lists['access'] = mosAdminMenus::Access( $row );

		$incl = array();
		foreach ($akforms->lng->WHERE_INCLUDE_ARR as $key => $value) {
			$incl[] = mosHTML::makeOption($key, $value);
		}

		$lists['where_include'] = mosHTML::selectList( $incl, 'where_include', ' class="inputbox" size="1"', 'value', 'text', $row->where_include );

		$query = "SELECT ordering AS value, field_label AS text FROM #__akform_items WHERE published >= 0 AND form_id=".intval($row->form_id)." ORDER BY ordering";
		$lists['ordering'] = mosAdminMenus::SpecificOrdering( $row, $id, $query, 1 );

		akFormsHTML::editField( $row, $lists);
	}

	private function saveField( $task ) {
		global $database, $adminLanguage, $akforms, $mainframe;

		$dlang = $mainframe->getCfg('lang');

    	$row = new formitemdb( $database );

	    $eopts = '';
	    $elngopts = array();
    	$dvalue = '';

		foreach ($_POST['languages'] as $xlang) {
    		if (trim($xlang) == '') { $newlangs = ''; }
	    }
    	if (!isset($newlangs)) {
	    	$newlangs = implode(',', $_POST['languages']);
    	}
	    $_POST['language'] = $newlangs;

	    //case select
    	if ($_POST['field_type'] == 'select') {
        	foreach ( $_POST['soption'] as $sopt ) {
	            if (trim($sopt) <> '') {
    	            //remove invalid characters
        	        $sopt = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\[\]\\\|\"\']+/", "", $sopt);
            	    $eopts .= $sopt.'|';
	            }
    	    }
        	//strip out any trailing vertical slashes
	        $eopts = preg_replace("/[\|]$/", "", $eopts);

    	    $dx = $_POST['sdefault'];
        	$dvalue = $_POST['soption'][$dx];
	        $dvalue = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\[\]\\\|\"\']+/", "", $dvalue);
    	}
	    //case val select
    	else if ($_POST['field_type'] == 'valselect') {
    		$svoption1 = mosGetParam( $_POST, 'svoption1', array() );
    		$svoption2 = mosGetParam( $_POST, 'svoption2', array() );

			$opts = array();
        	foreach ( $svoption1 as $key => $sopt ) {
	            if (trim($sopt) <> '') {
    	            //remove invalid characters
        	        $sopt1 = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\[\]\\\|\"\']+/", "", $sopt);
        	        $sopt2 = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\[\]\\\|\"\']+/", "", $svoption2[$key]);
            	    $opts[] = $sopt1.'='.$sopt2;
	            }
    	    }
    	    $eopts = implode('|', $opts);

        	//strip out any trailing vertical slashes
	        $eopts = preg_replace("/[\|]$/", "", $eopts);

    	    $dx = $_POST['svdefault'];
        	$dvalue = $svoption1[$dx];
	        $dvalue = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\[\]\\\|\"\']+/", "", $dvalue);
    	}
	    //case radio
    	else if ($_POST['field_type'] == 'radio') {
	        foreach ( $_POST['roption'] as $ropt ) {
   	    	    $ropt = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\[\]\\\|\"\']+/", "", $ropt);
	            if (trim($ropt) <> '') {
       		        $eopts .= $ropt.'|';
	    	    }
        	}

	        //strip out any trailing vertical slashes
    	    $eopts = preg_replace("/[\|]$/", "", $eopts);

	        $dx = $_POST['rdefault'];
    	    $dvalue = $_POST['roption'][$dx];
        	$dvalue = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\[\]\\\|\"\']+/", "", $dvalue);

	        if ((trim($eopts) == '') || (trim($dvalue) == '')) {
    	        echo "<script type=\"text/javascript\">alert(\"".$akforms->lng->EMSG_1OPTVLEAST."\"); window.history.go(-1);</script>\n";
        	    exit();
	        }
    	}
	    //case checkbox
    	else if ($_POST['field_type'] == 'checkbox') {
	        foreach ( $_POST['coption'] as $copt ) {
    	        if (trim($copt) <> '') {
        	        //remove invalid characters
            	    $copt = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\[\]\\\|\"\']+/", "", $copt);
	                $eopts .= $copt.'|';
    	        }
        	}
	        //strip out any trailing vertical slashes
    	    $eopts = preg_replace("/[\|]$/", "", $eopts);

        	//cdefault is an array
	        $cdefs = $_POST['cdefault'];

    	    if (count($cdefs) > 0) {
        	    foreach ($cdefs as $cdef) {
            	    $ddd = $_POST['coption'][$cdef];
                	$ddd = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\[\]\\\|\"\']+/", "", $ddd);
	                $dvalue .= $ddd.'|';
    	        }
        	    //strip out any trailing vertical slashes
            	$dvalue = preg_replace("/[\|]$/", "", $dvalue);
	        }
    	    if (trim($eopts) == '') {
        	    echo "<script type=\"text/javascript\">alert(\"".$akforms->lng->EMSG_1OPTLEAST."\"); window.history.go(-1);</script>\n";
            	exit();
	        }

	    }
    	//case time
	    else if ($_POST['field_type'] == 'time') {
    	    $dvalue = $_POST['timevalue'];
        	$dvalue = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\{\}\[\]\\\|\/\"\']+/", "", $dvalue);
	    }
    	//case hidden
	    else if ($_POST['field_type'] == 'hidden') {
    	    $dvalue = $_POST['hidvalue'];
        	$dvalue = preg_replace("/[\`\~\#\$\^\&\*\<\>\{\}\[\]\\\|\/\"\']+/", "", $dvalue);
	    }
    	//case file
	    else if ($_POST['field_type'] == 'file') {
    	    $dvalue = $_POST['filevalue'];
        	$dvalue = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\{\}\[\]\\\|\/\"\']+/", "", $dvalue);
	    }
	    //case query
    	else if ($_POST['field_type'] == 'sql') {
    		$eopts = $_POST['sqlvalue'];
    		$dvalue = $_POST['defvalue_sql'];
    	}
	    //case input
    	else if ($_POST['field_type'] == 'input') {
    	    $dvalue = $_POST['defvalue_inp'];
        	$dvalue = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\{\}\[\]\\\|\/\"\']+/", "", $dvalue);
        }
	    //case table
    	else if ($_POST['field_type'] == 'table') {
    	    $table = $_POST['table'];
    	    $_eopts = array();
    	    if ( is_array($table) ) {
    	    foreach ($table as $_row => $_cols) {
    	    	$ac = array();
    	    	foreach($_cols as $_col => $_cell) {
			        $_cell = preg_replace("/[\~\\|]+/", "", $_cell);
    	    		$ac[] = $_cell;
    	    	}
    	    	$_eopts[] = implode('~', $ac);
    	    	unset($ac);
    	    }
    	    }
    	    $eopts = implode('|', $_eopts);
        	$dvalue = '';
        }
	    //case table
    	else if ($_POST['field_type'] == 'textarea') {
    	    $dvalue = $_POST['defvalue_textarea'];
        	$dvalue = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\{\}\[\]\\\|\/\"\']+/", "", $dvalue);
    	}
    	//case text
	    else {
    	    $dvalue = $_POST['defvalue_text'];
        	$dvalue = preg_replace("/[\`\~\#\$\%\^\&\*\<\>\{\}\[\]\\\|\/\"\']+/", "", $dvalue);
	    }

    	$_POST['field_list'] = $eopts;
	    $_POST['field_value'] = $dvalue;

		if (!$row->bind( $_POST )) {
    		$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
			exit();
		}

		$isNew = ($row->id ? 0 : 1);

    	$row->field_label = trim($row->field_label);

		if ($row->field_label == '') {
    		$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$akforms->lng->EMSG_EMPTY_LABEL."'); window.history.go(-1);</script>\n";
			exit();
		}

		if (!$row->store()) {
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-2);</script>\n";
			exit();
		}
		$row->updateOrder('form_id='.$row->form_id);

		if ($task == 'applfield') {
			mosRedirect( 'index2.php?option=com_akforms&task=editfield&id='.$row->id.'&fid='.$row->form_id.'&hidemainmenu=1');
		} else {
			mosRedirect( 'index2.php?option=com_akforms&task=fields&fid='.$row->form_id);
		}
	}

	private function deleteField($cid) {
		global $database, $aCatalog, $mainframe;

		$cids = implode( ',', $cid );

	   	$row = new formitemdb( $database );
	   	$row->load(intval($cid[0]));

		$query = "DELETE FROM #__akform_values WHERE field_id IN ($cids)";
		$database->setQuery( $query );
		if (!$database->query()) {
    		$mainframe->checkSendHeaders();
			echo "<script> alert('".$database->stderr()."');</script>\n";
			exit();
		}

		$query = "DELETE FROM #__akform_items WHERE id IN ($cids)";
		$database->setQuery( $query );
		if (!$database->query()) {
    		$mainframe->checkSendHeaders();
			echo "<script> alert('".$database->stderr()."');</script>\n";
			exit();
		}

		mosRedirect( 'index2.php?option=com_akforms&task=fields&fid='.$row->form_id);
	}

	private function setAccessField( $uid, $access ) {
		global $database;

		$row = new formitemdb( $database );
		$row->load( $uid );
		$row->access = $access;

		if ( !$row->store() ) {
			return $row->getError();
		}

		mosRedirect( 'index2.php?option=com_akforms&task=fields&fid='.$row->form_id);
	}

	private function setWhereIncField( $uid, $whereinc ) {
		global $database;

		$row = new formitemdb( $database );
		$row->load( $uid );
		$row->where_include = $whereinc;

		if ( !$row->store() ) {
			return $row->getError();
		}

		mosRedirect( 'index2.php?option=com_akforms&task=fields&fid='.$row->form_id);
	}

	private function saveOrderFields( &$cid ) {
		global $database, $adminLanguage;

		$total		= count( $cid );
		$order 		= mosGetParam( $_GET, 'order', array() );
		$redirect 	= mosGetParam( $_GET, 'filter_form', 0 );
		$conditions = array();

    	//update ordering values
		for($i=0; $i < $total; $i++) {
			$database->setQuery("SELECT id, ordering, form_id FROM #__akform_items WHERE id='".$cid[$i]."'", '#__', 1, 0);
			$row = $database->loadRow();
			if ($row && ($row['ordering'] != $order[$i])) {
				$database->setQuery("UPDATE #__akform_items SET ordering='".intval($order[$i])."' WHERE id=".$row['id']);
				$database->query();
		        //remember to updateOrder this group
		        $condition = "form_id='".$row['form_id']."'";
	    	    $found = false;
	        	if ($conditions) {
		        	foreach ($conditions as $cond) {
		            	if ($cond[1] == $condition) { $found = true; break; }
	    	    	}
	        	}
		        if (!$found) { $conditions[] = array($row['id'], $condition); }
			}
			unset($row);
		}

		//execute updateOrder for each group
		if ($conditions) {
			foreach ($conditions as $cond) {
				$row = new formitemdb($database);
				$row->load( $cond[0] );
				$row->updateOrder( $cond[1] );
				unset($row);
			}
		}

		$msg = $adminLanguage->A_NEWORDERSAVED;
		mosRedirect( 'index2.php?option=com_akforms&task=fields&fid='. $redirect, $msg );
	}


	/***************************/
	/* (UN)PUBLISH FIELD       */
	/***************************/
	private function publishField( $cid, $publish=1 ) {
		global $database, $my, $adminLanguage, $mainframe;

		if (!is_array( $cid ) || count( $cid ) < 1) {
			$action = $publish ? $adminLanguage->A_PUBLISH : $adminLanguage->A_UNPUBLISH;
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$adminLanguage->A_SELITEMTO." ".$action."'); window.history.go(-1);</script>\n";
			exit();
		}

		$cids = implode( ',', $cid );

		$database->setQuery( "UPDATE #__akform_items SET published='".$publish."' WHERE id IN (".$cids.")" );
		if (!$database->query()) {
			$mainframe->checkSendHeaders();
			echo "<script type=\"text/javascript\">alert('".$database->getErrorMsg()."'); window.history.go(-1);</script>\n";
			exit();
		}

		if (count( $cid ) == 1) {
			$row = new formitemdb( $database );
			$row->checkin($cid[0]);

			$this->listFields($row->form_id);
		}
		mosRedirect( 'index2.php?option=com_akforms&task=fields' );
	}


	/************************/
	/* RE-ORDER FIELD       */
	/************************/
	private function orderField( $id, $inc ) {
		global $database;

		$limit = mosGetParam( $_REQUEST, 'limit', 0 );
		$limitstart = mosGetParam( $_REQUEST, 'limitstart', 0 );

		$row = new formitemdb( $database );
		$row->load( $id );
		$row->move( $inc );

		mosRedirect( 'index2.php?option=com_akforms&task=fields' );
	}

	private function listValues() {
		global $database, $mainframe, $mosConfig_absolute_path;

		$fid = mosGetParam( $_GET, 'fid', '0' );

		require_once( $mosConfig_absolute_path.'/administrator/includes/pageNavigation.php' );

		$limit = $mainframe->getUserStateFromRequest("view{com_akforms}{data}", 'limit', 0);
		$limitstart = $mainframe->getUserStateFromRequest("view{com_akforms}{data}", 'limitstart', 0);
		$filter_form = $mainframe->getUserStateFromRequest( "filter{com_akforms}{data}", 'filter_form', 0 );

		$valfilter = mosGetParam( $_GET, 'valfilter', array() );

		$orderfield = strtolower( mosGetParam( $_REQUEST, 'field', '' ));
		$order = strtolower( mosGetParam( $_REQUEST, 'order', 'none' ) );

		$order_by = '';
		if ($order == 'none') {
			$orderfield = 'post_date';
			$order = 'desc';
		}
		switch ($orderfield) {
			case 'post_date':
			case 'user_id':
				$order_by = 'a.'.$orderfield.' '.$order;
			break;
		}

		$limit = ($limit ? $limit : $mainframe->getCfg('list_limit'));

		if (!$fid) { $fid = $filter_form; }

		$frms = $this->getforms(true);

		if (!$fid) { $fid = $frms[0]->value; }

        $lists = array();

		$lists['filter_form'] = mosHTML::selectList( $frms, 'filter_form', ' class="inputbox" size="1" onChange="document.adminForm.submit();"', 'value', 'text', $fid );

		$form = new formdb($database);
		$form->load($fid);

		$lists['form_name'] = $form->name;
		$lists['form_id']   = $form->id;

		$where = array();

		if (is_array($valfilter) && (count($valfilter) > 0)) {
			foreach ($valfilter as $key => $value) {
				if ($value) {
					$where[] = 'b.field_group = '.$key.' AND UPPER(a.value) LIKE UPPER("%'.$value.'%")';
				}
			}
		}

		$query = "SELECT COUNT(DISTINCT a.unic) FROM elx_akform_values a, elx_akform_items b, elx_akforms f
					WHERE a.field_id = b.id AND b.form_id = ".intval($fid)." AND b.form_id = f.id".(count( $where ) ? " AND " . implode( ' AND ', $where ) : "");
		$database->setQuery( $query );
		$total = $database->loadResult();

		$pageNav = new mosPageNav( $total, $limitstart, $limit );

		$database->setQuery('SELECT id, title FROM #__akforms_groups WHERE form_id = '.intval($fid).' AND title_in_value = 1 ORDER BY title');
		$lists['field_title'] = $database->loadObjectList();

		$database->setQuery('SELECT id, title FROM #__akforms_groups WHERE form_id = '.intval($fid).' AND filter_in_value = 1 ORDER BY title');
		$lists['field_filter'] = $database->loadObjectList();

		$database->setQuery('SELECT a.post_date, a.user_id, a.unic, CONCAT(u.name, "(", u.username, ")") as user_name, a.isread, a.istemp
								FROM #__akform_values a LEFT JOIN #__users u ON u.id = a.user_id, #__akform_items b, #__akforms f
								WHERE a.field_id = b.id AND
										b.form_id = '.intval($fid).' AND
										b.form_id = f.id'.(count( $where ) ? " AND " . implode( ' AND ', $where ) : "").'
								GROUP BY a.unic
								ORDER BY '.$order_by, '#__', $pageNav->limit, $pageNav->limitstart );
		$rows = $database->loadObjectList();

		akFormsHTML::listValues( $rows, $lists, $pageNav, $valfilter );

		$mainframe->setUserState( "filter{com_akforms}{data}", $fid );

		unset($lists, $rows, $pageNav);
	}

	private function showValues($unic) {
		global $database, $mainframe, $akforms, $adminLanguage;

		$database->setQuery('SELECT i.*, v.value as post_value
								FROM #__akform_values v, #__akform_items i
								WHERE v.unic = "'.$unic.'" and v.field_id = i.id
								ORDER BY i.ordering');
		$rows = $database->loadObjectList();

		$lists = array();

		$database->setQuery('SELECT a.istemp, a.post_date, CONCAT(u.name, "(", u.username, ")") as user_name, f.name as form_name
								FROM #__akform_values a LEFT JOIN #__users u ON u.id = a.user_id,
									#__akform_items i, #__akforms f
								WHERE a.unic = "'.$unic.'" AND
									a.field_id = i.id and
									i.form_id = f.id
								LIMIT 0,1');
		$database->loadObject($tmp);

		$lists['post_date'] = $tmp->post_date;
		$lists['user_name'] = $tmp->user_name;
		$lists['form_name'] = $tmp->form_name;
		$lists['istemp']    = $tmp->istemp;

		akFormsHTML::showValues( $rows, $lists);

		$database->setQuery('UPDATE #__akform_values SET isread = 1 WHERE unic = "'.$unic.'"');
		$database->query();
	}

	private function deleteValues($cid) {
		global $database, $mainframe, $akforms, $adminLanguage;

		$cids = '"'.implode( '","', $cid ).'"';

		$database->setQuery("SELECT a.*, b.field_type
								FROM #__akform_values a, #__akform_items b
								WHERE a.unic IN ($cids) AND a.field_id = b.id");
		$rows = $database->loadObjectList();

		$fld = $akforms->cfg->get('GFFOLDER_FILES');

		if ( !empty($fld) && is_dir($mainframe->getCfg('absolute_path').$fld) && file_exists($mainframe->getCfg('absolute_path').$fld) ) {
			foreach ($rows as $row) {
				if ($row->field_type == 'file') {
       				$files = explode('|', $row->value);
       				$fname = $mainframe->getCfg('absolute_path').$fld.'/'.$files[0];
					if ( is_file($fname) && file_exists($fname) ) {
						unlink($fname);
					}
				}
			}
		}

		$query = "DELETE FROM #__akform_values WHERE unic IN ($cids)";
		$database->setQuery( $query );
		if (!$database->query()) {
    		$mainframe->checkSendHeaders();
			echo "<script> alert('".$database->stderr()."');</script>\n";
			exit();
		}

		mosRedirect( 'index2.php?option=com_akforms&task=data');

	}

	private function markUnreadValues($cid) {
		global $database, $mainframe, $akforms, $adminLanguage;

		$cids = '"'.implode( '","', $cid ).'"';

		$query = "UPDATE #__akform_values SET isread = 0 WHERE unic IN ($cids)";
		$database->setQuery( $query );
		if (!$database->query()) {
    		$mainframe->checkSendHeaders();
			echo "<script> alert('".$database->stderr()."');</script>\n";
			exit();
		}

		mosRedirect( 'index2.php?option=com_akforms&task=data');

	}


	private function downloadFile() {
		global $database, $akforms, $fmanager, $mainframe;

		$file = mosGetParam( $_REQUEST, 'file', '' );
		$name = mosGetParam( $_REQUEST, 'name', '' );

		$fld = $akforms->cfg->get('GFFOLDER_FILES');
		$ext = $fmanager->FileExt($file);

		if ( !empty($file) && is_dir($mainframe->getCfg('absolute_path').$fld) && file_exists($mainframe->getCfg('absolute_path').$fld.'/'.$file) ) {
			@ob_end_clean();
			@header('Content-type: application/'.$ext);
			@header('Content-Disposition: attachment; filename="'.$name.'"');

			readfile($mainframe->getCfg('absolute_path').$fld.'/'.$file);
		}

		exit;
	}
}

$formsback = new akFormsBack();
$formsback->run();
unset($formsback, $akforms);

?>