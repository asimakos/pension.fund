<?php
/**
* @version: $Id: mod_language.php 2577 2010-01-11 21:05:13Z datahell $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Module Language
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!class_exists('modLanguage')) {
	class modLanguage {

		protected $sef = 0;
		protected $moduleclass_sfx = '';
		protected $lng_indicator = 2;
		protected $lng_style = 0;
		protected $smart_switch = 1;
		protected $rewriteURL = 'index.php?mylang=XYXYXYXY';
		protected $_Itemid = 0;
		protected $arlangs = array();


		/*********************/
		/* MAGIC CONSTRUCTOR */
		/*********************/
		public function __construct($params) {
			global $Itemid, $mainframe;

			$this->sef = intval($mainframe->getCfg('sef'));
			$this->moduleclass_sfx = $params->get('moduleclass_sfx');
			$this->lng_indicator = intval($params->get( 'indicator', 2 ));
			$this->lng_style = intval($params->get( 'lng_style', 0 ));
			$this->smart_switch = intval($params->get( 'smart_switch', 1));
			$this->_Itemid = intval($Itemid);
			$this->checkSmart();
		}


		/**************************************/
		/* CHECK IF SMART SWITCH WILL BE USED */
		/**************************************/
		protected function checkSmart() {
			global $mainframe, $database, $lang;

			if (!$this->smart_switch) { return; }
			if (!$this->_Itemid) { return; }
			if ($this->lng_style == 2) { return; }

			$database->setQuery("SELECT id, language FROM #__menu WHERE id='".$this->_Itemid."'", '#__', 1, 0);
			$srow = $database->loadRow();
			if (!$srow) { return; }

			if (trim($srow['language']) != '') {
				$this->arlangs = explode(',',$srow['language']);
			} else {
				$this->arlangs = explode(',',$mainframe->getCfg('pub_langs'));
			}

			$replURI = preg_replace('/^([\/])/', '', urldecode($_SERVER['REQUEST_URI']));
			$pat = "/([\"]|[\']|[\<]|[\>]|[\*]|[\~]|[\`]|[\^]|[\|]|[\\\]|[\$]|[\;])/";
			$replURI = preg_replace($pat, '', $replURI);
			$replURI = preg_replace('/(script)/i', '', $replURI);
			$replURI = preg_replace('/(mosconfig)/i', '', $replURI);

			$livesite = parse_url($mainframe->getCfg('live_site'));
			if (isset($livesite['path']) && ($livesite['path'] != '')) { //site is in sub-directory
				$livesite['path'] = preg_replace('/^([\/])/', '', $livesite['path']);
				$livesite['path'] = preg_replace('/([\/])$/', '', $livesite['path']).'/';
				$replURI = preg_replace('#^('.$livesite['path'].')#', '', $replURI);
			}

			if ($this->sef == 2) {
				$replURI = preg_replace('/mylang\=?[^&#]+/', '', $replURI, 1);
				$replURI = preg_replace('/(\&)$/', '', $replURI);
				$replURI = preg_replace('/(\?)$/', '', $replURI);
				$replURI = sefRelToAbs($replURI);

				$replURI = str_replace('&amp;', '&', $replURI);
/*
				if (preg_match('/option\,/', $replURI)) { //SEO PRO extension does not exist
					if (preg_match('/\?/', $replURI)) {
						$finalrepl = $replURI.'&mylang=XYXYXYXY';
					} else {
						$finalrepl = $replURI.'?mylang=XYXYXYXY';
					}
				} else {
*/
					$k = str_replace($mainframe->getCfg('live_site'), '', $replURI);
					$parts = preg_split('/(\/)/', $k, -1, PREG_SPLIT_NO_EMPTY);

					if (($parts) && (count($parts) > 0)) {
						$langG = eLOCALE::elxis_iso639($lang);
						if ($parts[0] == $langG) {
							$parts[0] = 'XYXYXYXY';
							$finalrepl = implode('/',$parts);
						} else {
							$finalrepl = 'XYXYXYXY/'.implode('/',$parts);
						}
						if (preg_match('/(\/)$/', $k)) { $finalrepl .= '/'; }
					} else {
						$finalrepl = 'XYXYXYXY/';
					}
				//}
				$this->rewriteURL = str_replace('&amp;', '&', $finalrepl);
				$this->rewriteURL = str_replace('&', '&amp;', $finalrepl);
			} else if ($this->sef == 1) {
				$replURI = preg_replace('/mylang\=?[^&#]+/', '', $replURI, 1);
				$replURI = preg_replace('/(\&)$/', '', $replURI);
				$replURI = sefRelToAbs($replURI);
				if (preg_match('/\?/', $replURI)) {
					$replURI .= '&mylang=XYXYXYXY';
				} else {
						$replURI .= '?mylang=XYXYXYXY';
				}
				$this->rewriteURL = $replURI;
			} else {
				$replURI = preg_replace('/mylang\=?[^&#]+/', 'mylang=XYXYXYXY', $replURI, 1);
				if (!preg_match('/mylang/', $replURI)) {
					if (preg_match('/\?/', $replURI)) {
						$replURI .= '&mylang=XYXYXYXY';
					} else {
						$replURI .= '?mylang=XYXYXYXY';
					}
				}
				$this->rewriteURL = str_replace('&amp;', '&', $replURI);
				$this->rewriteURL = str_replace('&', '&amp;', $replURI);
			}
		}

         /***************************************/
		/* Greek ως Ελληνικά, German ως Deutsh */
		/***************************************/
  private function nativelang($lng) {
	    switch ($lng) {
		case 'spanish': return 'Español'; break;
		case 'french': return 'Francais'; break;
		case 'italian': return 'Italiano'; break;
		case 'german': return 'Deutsch'; break;
		case 'greek': return 'Ελληνικά'; break;
		case 'english': return 'English'; break;
		default: return $lng; break;
	}
}

		/****************/
		/* SEF REPLACER */
		/****************/
		protected function sefReplacer($langx) {		    switch($this->sef) {
				case 2: return $this->sef2Replacer($langx); break;
				case 1: return $this->sef1Replacer($langx); break;
				case 0: default: return $this->sef0Replacer($langx); break;
			}
		}


		/*************************/
		/* SEF REPLACER (NO SEF) */
		/*************************/
		protected function sef0Replacer($langx) {
			global $mainframe;

			if ($this->smart_switch) {
				$link = (in_array($langx, $this->arlangs)) ? str_replace('XYXYXYXY', $langx, $this->rewriteURL) : $mainframe->getCfg('live_site').'/index.php?mylang='.$langx;
			} else {
				$link = $mainframe->getCfg('live_site').'/index.php?mylang='.$langx;
			}
			return $link;
		}


		/****************************/
		/* SEF REPLACER (BASIC SEF) */
		/****************************/
		protected function sef1Replacer($langx) {
			global $mainframe;

			if ($this->smart_switch) {
				$link = (in_array($langx, $this->arlangs)) ? str_replace('XYXYXYXY', $langx, $this->rewriteURL) : $mainframe->getCfg('live_site').'/index.php?mylang='.$langx;
			} else {
				$link = $mainframe->getCfg('live_site').'/index.php?mylang='.$langx;
			}
			return $link;
		}


		/**************************/
		/* SEF REPLACER (SEO PRO) */
		/**************************/
		protected function sef2Replacer($langx) {
			global $mainframe;

			if (preg_match('/option\,/', $this->rewriteURL)) { return $this->sef1Replacer($langx); }
			if ($this->smart_switch) {
				$langG = eLOCALE::elxis_iso639($langx);
				if (in_array($langx, $this->arlangs)) {
					$link = ($langx == $mainframe->getCfg('lang')) ? str_replace('XYXYXYXY/', '', $this->rewriteURL) : str_replace('XYXYXYXY', $langG, $this->rewriteURL);
				} else {
					$link = ($langx == $mainframe->getCfg('lang')) ? $mainframe->getCfg('live_site').'/' : $mainframe->getCfg('live_site').'/'.$langG.'/';
				}
			} else {
				if ($mainframe->getCfg('lang') == $langx) {
					$link = $mainframe->getCfg('live_site').'/';
				} else {
					$link = $mainframe->getCfg('live_site').'/'.eLOCALE::elxis_iso639($langx).'/';
				}
			}
			return $link;
		}

		/********************/
		/* RUN FOREST, RUN! */
		/********************/
		public function run() {
			global $mainframe, $lang, $mosConfig_sef, $mosConfig_lang;

			switch ($this->lng_indicator) {
				case '0': $indi = _E_LANGUAGE.': '; break;
				case '1': $indi = _E_LANGUAGE.':<br />'._LEND; break;
				case '2': default: $indi = ''; break;
			}


			$frLangs = explode(',', $mainframe->getCfg('pub_langs'));
			if (($this->lng_style == 0) || ($this->lng_style == 1)) {
				echo $indi;
				foreach ($frLangs as $langx) {
        			$link = $this->sefReplacer($langx);
        			$nativelang = $this->nativelang($langx);  //ελληνικά σε Greek
					//echo '<a href="'.$link.'" title="'.$langx.'">'; Greek σε ελληνικά
					echo '<a href="'.$link.'" title="'.$nativelang.'">';
					if (($this->lng_style == 0) && file_exists($mainframe->getCfg('absolute_path').'/language/'.$langx.'/'.$langx.'.gif')) {
						echo '<img src="'.$mainframe->getCfg('ssl_live_site').'/language/'.$langx.'/'.$langx.'.gif" border="0" alt="'.$langx.'" style="vertical-align:middle" />';
					} else {
						//echo ($lang == $langx) ? '<strong>'.$langx.'</strong>' : $langx;
						echo ($lang == $langx) ? '<strong>'.$nativelang.'</strong>' : $nativelang;
					}
					echo '</a> '._LEND;
				}
			} else {
?>
				<form method="get" name="frmLanguage" action="index.php">
				<?php echo $indi; ?>
				<select name="mylang" title="<?php echo _E_LANGUAGE; ?>" size="1" dir="ltr" onchange="frmLanguage.submit();" class="selectbox<?php echo $this->moduleclass_sfx; ?>">
				<?php
				foreach ($frLangs as $langx) {
					echo '<option value="'.$langx.'"';
					if ($langx == $lang) { echo ' selected="selected"'; }
					echo '>'.$langx.'</option>'._LEND;
				}
				?>
				</select>
				</form>
<?php
			}
		}

	}
}


$modlang = new modLanguage($params);
$modlang->run();
unset($modlang);

?>
