<?php 
/** 
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component eBlog
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class eBlogFHTML {


	/******************/
	/* SHOW BLOG HTML */
	/******************/
	static public function showBlog($rows, $pageNav=null) {
		global $eblog;

		self::blogStart();
		self::blogHeader($pageNav);
		if ($rows) {
			for ($i=0; $i<count($rows); $i++) {
				$row = $rows[$i];
				self::processArticle($row, 0);
			}
		} else {
			if (($eblog->task == 'archive') || ($eblog->task == 'dayposts')) {
				echo '<p>'.$eblog->lng->NOPOSTSFDATE."</p>\n";
			}
		}
		self::blogFooter($pageNav);
		self::blogEnd();
	}


	/*********************/
	/* SHOW ARTICLE HTML */
	/*********************/
	static public function showArticle($row, $comments, $previous, $next) {
		self::blogStart();
		self::blogHeader();
		if ($row) {
			self::processArticle($row, 1);
			self::prevnextArticles($previous, $next);
			self::processComments($comments, $row->id);
		}
		self::blogFooter();
		self::blogEnd();
	}


	/****************************/
	/* SHOW TAGS SEARCH RESULTS */
	/****************************/
	static public function tagResults($tag, $rows) {
		self::blogStart();
		self::blogHeader();
		self::processTagResults($tag, $rows);
		self::blogFooter();
		self::blogEnd();
	}


	/**********************/
	/* SHOW CONTROL PANEL */
	/**********************/
	static public function showCPanel($rows, $showall) {
		self::blogStart();
		self::blogHeader();
		self::cpanelHeader();
		self::ownPosts($rows, $showall);
		self::blogEnd();
	}


	/**********************/
	/* SHOW BLOG SETTINGS */
	/**********************/
	static public function blogConfig($lists) {
		self::blogStart();
		self::blogHeader();
		self::cpanelHeader();
		self::configForm($lists);
		self::blogEnd();
	}


	/**********************/
	/* SHOW ADD/EDIT POST */
	/**********************/
	static public function editPost($row) {
		self::blogStart();
		self::blogHeader();
		self::cpanelHeader();
		self::showEditor($row);
		self::blogEnd();
	}


	/******************************/
	/* DISPLAY BLOG ERROR MESSAGE */
	/******************************/
	static public function blogError($msg='') {
		global $eblog, $mainframe;

		self::blogStart();
		self::blogHeader();
		$mainframe->setPageTitle(_ELX_ERROR.' - '.$eblog->getCV('title'));
		$mainframe->setMetaTag('description', $eblog->getCV('title').' - '._ELX_ERROR);
		$mainframe->setMetaTag('keywords', 'blog, '._ELX_ERROR.', elxis blog');
		$mainframe->setMetaTag('author', $eblog->getCV('ownername'));
		elxError($msg);

		self::blogEnd();
	}


	/************************/
	/* SHOW BLOGS LIST HTML */
	/************************/
	static public function listBlogs($blogs) {
		global $eblog, $mainframe, $Itemid, $access;

		self::blogStart();
?>

		<h1 class="eblog-blogtitle"><?php echo $eblog->lng->USERBLOGS; ?></h1>
		<p><?php echo sprintf($eblog->lng->THEREAREBLOGS, '<span style="font-weight: bold;">'.count($blogs).'</span>'); ?></p>

<?php 
		for ($i=0; $i < count($blogs); $i++) {
			$blog = $blogs[$i];

			$nosef = 'index.php?option=com_eblog&task=browse&blogid='.$blog->blogid.'&Itemid='.$Itemid;
			$sef = 'eblog/'.$blog->seotitle.'/';
			$link = sefRelToAbs($nosef, $sef);

			$plink = 'index.php?option=com_user&amp;task=profile&amp;Itemid='.$eblog->uListItemid().'&amp;uid='.$blog->ownerid;
			$phref = ($access->canViewProf) ? sefRelToAbs($plink, 'members/'.$blog->username.'.html') : 'javascript:void(null);';

			echo '<div style="margin: 20px 0;">'._LEND;
			echo '<a href="'.$link.'" title="'.$blog->title.'" style="font-weight: bold; text-decoration: none;">'.$blog->title.'</a><br />'._LEND;
			echo '<span style="color: #555555; font-size: 0.94em;">'._WRITTEN_BY.' ';
			echo '<a href="'.$phref.'" title="'.$blog->username.'">'.$blog->name.'</a> | ';
			echo $eblog->lng->POSTS.': '.$blog->posts.'</span>';
			echo "</div>\n";
		}
		self::blogEnd();
	}


	/************************/
	/* PROCESS ARTICLE HTML */
	/************************/
	static private function processArticle($row=null, $full=0) {
		global $Itemid, $eblog, $access, $mainframe;

		if (!$row) { return; }
		$stdlink = 'index.php?option=com_eblog&amp;task=show&amp;blogid='.$eblog->getCV('blogid').'&amp;id='.$row->id.'&amp;Itemid='.$Itemid;
		$seolink = 'eblog/'.$eblog->getCV('seotitle').'/'.$row->seotitle.'.html';
		$link = sefRelToAbs($stdlink, $seolink);
		if (!preg_match('/^(http)/i', $link)) { $link = $mainframe->getCfg('live_site').'/'.$link; }
		$plink = 'index.php?option=com_user&amp;task=profile&amp;Itemid='.$eblog->uListItemid().'&amp;uid='.$eblog->getCV('ownerid');
		$phref = ($access->canViewProf) ? sefRelToAbs($plink, 'members/'.$eblog->getCV('owneruname').'.html') : 'javascript:void(null);';

		$tagLink = sefRelToAbs('index.php?option=com_eblog&task=tags&blogid='.$eblog->getCV('blogid').'&Itemid='.$Itemid.'&tag=zzzzz', 'eblog/'.$eblog->getCV('seotitle').'/tags/zzzzz.html');
?>

		<div class="eblog-post">
    		<h3 class="eblog-posttitle"><a href="<?php echo $link; ?>" title="<?php echo $row->title; ?>"><?php echo $row->title; ?></a></h3>
			<div class="eblog-postdate"><?php echo mosFormatDate($row->dateadded, _GEM_DATE_FORMLC2); ?></div>
			<div class="eblog-postbody">
<?php 
				if ($eblog->getCV('share') == 1) { //e-mailit
					$extra = ($eblog->getCV('emailit') != '') ? '-'.$eblog->getCV('emailit') : '';
					echo '<div style="margin: 0 0 10px 0;">'."\n";
					echo '<a id="e-mailit.com'.$extra.'" href="javascript:void(null);" onclick="javascript:AlertMsg(\'url[]\');return false;" onmouseover="link_hover(\'e-mailit.com'.$extra.'\',\'url[]\')" onmouseout="link_hout(\'e-mailit.com'.$extra.'\')">';
					echo '<img src="'.$mainframe->secureURL('http://www.e-mailit.com/button/images/button01.gif').'" style="border:0" alt="Share via email, networking sites and bookmark using any service!" /></a>'."\n";
					echo "</div>\n";
				} elseif ($eblog->getCV('share') == 2) { //AddThis
					echo '<div style="margin: 0 0 10px 0;">'."\n";
					echo '<a class="addthis_button" href="'.$mainframe->secureURL('http://addthis.com/').'bookmark.php?v=250&amp;username='.$eblog->getCV('addthis').'">';
					echo '<img src="'.$mainframe->secureURL('http://s7.addthis.com/').'static/btn/sm-share-en.gif" width="83" height="16" alt="Bookmark and Share" style="border:0"/></a>'."\n";
					echo "</div>\n";
				}

				echo self::processMedia($row->blogtext, $full, $link);
?>
			</div>
			<?php if ($eblog->getCV('showtags') && (trim($row->tags) != '')) { ?>
			<div class="eblog-posttags">
				<?php echo $eblog->lng->TAGS; ?>: 
				<?php 
				$tgarr = preg_split('/\,/', $row->tags, -1, PREG_SPLIT_NO_EMPTY);
				if ($tgarr && is_array($tgarr)) {
					for ($i=0; $i<count($tgarr); $i++) {
						$tg = eUTF::utf8_trim($tgarr[$i]);
						echo '<a href="'.eUTF::utf8_str_replace('zzzzz', eUTF::utf8_strtolower($tg), $tagLink).'" title="'.$tg.'">'.$tg.'</a>';
						if (($i +1 ) < count($tgarr)) { echo ', '; }
						echo "\n";
					}
				}
				?>
			</div>
			<?php } ?>
			<div class="eblog-postfooter">
				<a href="<?php echo $phref; ?>" title="<?php echo _WRITTEN_BY.' '.$eblog->getCV('owneruname'); ?>" class="eblog-postauthor">
					<?php echo $eblog->getCV('ownername'); ?>
				</a> | 
				<span class="eblog-posthits"><?php echo _E_HITS.': '.$row->hits; ?></span>
				<?php if (!$full) { ?>
				 | <a href="<?php echo $link; ?>" title="<?php echo $eblog->lng->PERMLINK; ?>" class="eblog-postlink"><?php echo $eblog->lng->PERMLINK; ?></a> 
				<?php } ?>
				<?php 
				if ($eblog->getCV('allowcomments') > 0) {
					if ($full == 0) {
						echo '| <a href="'.$link.'" title="'.$eblog->lng->COMMENTS.'" class="eblog-postcomments">'.$row->numcomments.' ';
						echo ($row->numcomments == 1) ? $eblog->lng->COMMENT : $eblog->lng->COMMENTS;
						echo "</a>\n";
					} else {
						echo '| <span class="eblog-postcomments">'.$row->numcomments.' ';
						echo ($row->numcomments == 1) ? $eblog->lng->COMMENT : $eblog->lng->COMMENTS;
						echo "</span>\n";
					}
				}
				?>
			</div>
		</div>
		<div style="clear: both;"></div>
<?php 
	}


	/*******************************************/
	/* DISPLAY LINKS TO PREVIOUS/NEXT ARTICLES */
	/*******************************************/
	static private function prevnextArticles($previous, $next) {
		global $eblog, $Itemid;

		if (!$previous && !$next) { return; }
		if (_GEM_RTL == 1) {
			$dir1 = 'right'; $dir2 = 'left'; $tdir1 = _CMN_PREV; $tdir2 = _CMN_NEXT;
		} else {
			$dir1 = 'left'; $dir2 = 'right'; $tdir1 = '&laquo; '._CMN_PREV; $tdir2 = _CMN_NEXT.' &raquo;';
		}
		echo '<div style="margin: 0 0 5px 0; padding: 0;">'."\n";
		echo '<div style="margin: 0; padding: 0; float: '.$dir1.'; width: 45%; text-align: '.$dir1.';">'."\n";
		if ($previous) {
			$stdlink = 'index.php?option=com_eblog&amp;task=show&amp;blogid='.$eblog->getCV('blogid').'&amp;id='.$previous['id'].'&amp;Itemid='.$Itemid;
			$seolink = 'eblog/'.$eblog->getCV('seotitle').'/'.$previous['seotitle'].'.html';
			$link = sefRelToAbs($stdlink, $seolink);
			echo '<span class="eblog-prevnexttitle">'.$tdir1."</span><br />\n";
			echo '<a href="'.$link.'" title="'._CMN_PREV.'" class="eblog-prevnextpost">'.$previous['title']."</a>\n";
		}
		echo "</div>\n";
		echo '<div style="margin: 0; padding: 0; float: '.$dir2.'; width: 45%; text-align: '.$dir2.';">'."\n";
		if ($next) {
			$stdlink = 'index.php?option=com_eblog&amp;task=show&amp;blogid='.$eblog->getCV('blogid').'&amp;id='.$next['id'].'&amp;Itemid='.$Itemid;
			$seolink = 'eblog/'.$eblog->getCV('seotitle').'/'.$next['seotitle'].'.html';
			$link = sefRelToAbs($stdlink, $seolink);
			echo '<span class="eblog-prevnexttitle">'.$tdir2."</span><br />\n";
			echo '<a href="'.$link.'" title="'._CMN_NEXT.'" class="eblog-prevnextpost">'.$next['title']."</a>\n";
		}
		echo "</div>\n";
		echo '<div style="clear: both;"></div>'."\n";
		echo "</div>\n";
	}


	/********************/
	/* YOUTUBE REPLACER */
	/********************/
	static private function youTube_replacer($matches ) {
    	$videoid = $matches[1];

		$out = "<div>\n";
    	$out .= '<object type="application/x-shockwave-flash" style="width:480px; height:360px;" data="http://www.youtube.com/v/'.$videoid.'&hl=en&fs=1&rel=0">'."\n";
		$out .= '<param name="movie" value="http://www.youtube.com/v/'.$videoid.'&hl=en&fs=1&rel=0" />'."\n";
		$out .= '<param name="wmode" value="transparent" />'."\n";
		$out .= '<param name="allowscriptaccess" value="always" />'."\n";
		$out .= '<param name="allowFullScreen" value="true" />'."\n";
		$out .= '<embed src="http://www.youtube.com/v/'.$videoid.'&hl=en&fs=1&" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="360"></embed>'."\n";
		$out .= "</object>\n</div>\n";
    	return $out;
	}


	/*************************/
	/* GOOGLE VIDEO REPLACER */
	/*************************/
	static private function googleVideo_replacer($matches ) {
    	$videoid = preg_replace('/^\-/', '', $matches[1]);

		$out = '<div>'._LEND;
		$out .= '<embed id="VideoPlayback" style="width:425px;height:350px" allowFullScreen="true" src="http://video.google.com/googleplayer.swf?docid=-'.$videoid.'&hl=en&fs=true" type="application/x-shockwave-flash"></embed>'._LEND;
		$out .= '</div>'._LEND;
	}


	/************************/
	/* YAHOO VIDEO REPLACER */
	/************************/
	static private function yahooVideo_replacer($matches ) {
    	$videoid = $matches[1];

		$out = '<div>'._LEND;
		$out .= '<object width="425" height="350">'._LEND;
		$out .= '<param name="movie" value="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.17" />'._LEND;
		$out .= '<param name="allowFullScreen" value="true" />'._LEND;
		$out .= '<param name="bgcolor" value="#000000" />'._LEND;
		$out .= '<param name="flashVars" value="id=9051441&vid='.$videoid.'&lang=en-us&intl=us&thumbUrl=&embed=1" />'._LEND;
		$out .= '<embed src="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.17" type="application/x-shockwave-flash" width="425" height="350" ';
		$out .= 'allowFullScreen="true" bgcolor="#000000" flashVars="id=9051441&vid='.$videoid.'&lang=en-us&intl=us&thumbUrl=&embed=1"></embed>'._LEND;
		$out .= '</object>'._LEND;
		$out .= '</div>'._LEND;
		return $out;
    }


	/*********************************/
	/* PROCESS POST'S EMBEDED MEDIA */
	/*********************************/
	static private function processMedia($text='', $full=0, $link) {
		$regex = "#{blogmore}#s";
		if ($full == 1) {
			$text = preg_replace($regex, '', $text);
		} else {
			if (preg_match($regex, $text)) {
				$parts = preg_split($regex, $text, 2);
				$text = self::closetags($parts[0]);
				$text .= '<div style="margin: 10px 0;"><a href="'.$link.'" title="'._READ_MORE.'" class="eblog-postlink">'._READ_MORE.'</a></div>';
			}
		}

		$regex = "#{youtube}(.*?){/youtube}#s";
		$text = preg_replace_callback($regex, array('self', 'youTube_replacer'), $text, 2);

		$regex = "#{googlevideo}(.*?){/googlevideo}#s";
		$text = preg_replace_callback($regex, array('self', 'googleVideo_replacer'), $text);

		$regex = "#{yahoovideo}(.*?){/yahoovideo}#s";
		$text = preg_replace_callback($regex, array('self', 'yahooVideo_replacer'), $text);
		return $text;
	}


	/*******************/
	/* FIX BROKEN HTML */
	/*******************/
	static private function closetags($html) {
		preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
		$openedtags = isset($result[1]) ? $result[1] : array();
		if (!$openedtags) { return $html; }
		preg_match_all('#</([a-z]+)>#iU', $html, $result);
		$closedtags = isset($result[1]) ? $result[1] : array();
		$len_opened = count($openedtags);
		if (count($closedtags) == $len_opened) { return $html; }
		$openedtags = array_reverse($openedtags);
		$arr_single_tags = array('hr','img','br');
		for ($i=0; $i < $len_opened; $i++) {
			if (!in_array($openedtags[$i],$arr_single_tags)) {
				if (!in_array($openedtags[$i], $closedtags)){
					$html .= '</'.$openedtags[$i].'>';
				} else {
					unset($closedtags[array_search($openedtags[$i], $closedtags)]);
				}
			}
		}
		return $html;
	}


	/*************************/
	/* PROCESS COMMENTS HTML */
	/*************************/
	static private function processComments($comments=null, $articleid=0) {
		global $eblog, $mainframe, $my, $Itemid;

		if (!$eblog->getCV('allowcomments')) { return; } //comments are not allowed for this blog

		$fullAccess = 0;
		$postComment = 0;

		if ($eblog->getCV('allowcomments') == 2) { //all users
			$postComment = 1;
		} else if ($eblog->getCV('allowcomments') == 1) { //registered
			$postComment = (intval($my->id) > 0) ? 1 : 0;
		}

		//check if user can delete comments and/or see additional info
		if ($my->id && (($my->id == $eblog->getCV('ownerid')) || ($my->gid == 25))) { $fullAccess = 1; }
?>

		<script type="text/javascript">
		/* <![CDATA[ */
		function ebpostccheck() {
			if (( document.eblogcomform.commessage.value == "" )
			<?php 
			if (!$my->id) {
			?>
				|| ( document.eblogcomform.comauthor.value == "" ) 
				|| ( document.eblogcomform.comemail.value.search("@") == -1 ) 
				|| ( document.eblogcomform.comemail.value.search("[.*]" ) == -1 ) 
			<?php 
			}
			if ($mainframe->getCfg('captcha')) {
			?>
				|| ( document.eblogcomform.code.value == "" )
			<?php } ?> 
			) {
				alert( "<?php echo _CONTACT_FORM_NC; ?>" );
			} else {
				document.eblogcomform.submit();
			}
		}

        function captchaPlayer() {
            window.open('<?php echo $mainframe->getCfg('live_site'); ?>/includes/captcha/listen.php','','width=200,height=100,top=250,left=450,toolbar=no,location=no,resizable=no,menubar=no');
        }
		/* ]]> */
		</script>

		<div class="eblog-comments">
		<h3 class="eblog-commentstitle"><?php echo $eblog->lng->COMMENTS; ?> (<?php echo count($comments); ?>)</h3>

<?php 
		if ($comments) {
			$dirl = _GEM_RTL ? 'right' : 'left';
			$dirr = _GEM_RTL ? 'left' : 'right';
			$avdir = $mainframe->getCfg('absolute_path').'/images/avatars/';
			
			$k = 0;
			echo "<ul id=\"eblog-commentsul\">\n";
			for ($i=0; $i<count($comments); $i++) {
				$com = $comments[$i];

				$avatar = ((trim($com->avatar) != '') && file_exists($avdir.$com->avatar)) ? $com->avatar : 'noavatar.png';
				$usern = (trim($com->username) != '') ? $com->username : _E_VISITOR;

				echo '<li class="eblog-line'.$k.'">'._LEND;
				echo '<div style="width: 75px; text-align: center; float: '.$dirl.';">'."\n";
				echo '<img src="'.$mainframe->getCfg('ssl_live_site').'/images/avatars/'.$avatar.'" width="50" height="50" alt="'.$usern.'" title="'.$usern.'" border="0" />'."\n";
				if ($fullAccess) {
					$deleteLink = $mainframe->getCfg('live_site').'/index2.php?option=com_eblog&amp;task=delcomment&amp;blogid='.$eblog->getCV('blogid').'&amp;id='.$articleid.'&amp;cid='.$com->cid.'&amp;Itemid='.$Itemid;
					echo '<div style="margin: 5px 0;">'._LEND;
					echo '<a href="mailto:'.$com->email.'" title="'.$com->email.'"><img src="'.$mainframe->secureURL($eblog->url).'/images/icon_email.png" alt="e-mail" /></a>';
					echo ' <img src="'.$mainframe->secureURL($eblog->url).'/images/icon_ip.png" alt="IP: '.$com->ipaddress.'" title="IP: '.$com->ipaddress.'" style="cursor: pointer;" />';
					echo ' <a href="'.$deleteLink.'" title="'._CMN_DELETE.'"><img src="'.$mainframe->secureURL($eblog->url).'/images/icon_delete.png" alt="'._CMN_DELETE.'" /></a>';
					echo "</div>\n";
				}
				echo "</div>\n";
				echo '<div style="margin-'.$dirl.': 75px;">'."\n";
				echo "<div>\n";
				echo '<div class="eblog-commentauthor" style="float: '.$dirl.'; width:60%;">'.$com->author."</div>\n";
				echo '<div class="eblog-commentdate" style="float: '.$dirr.'">'.eLocale::strftime_os("%d %B %Y, %H:%M", $com->ctimestamp)."</div>\n";
				echo "</div>\n";
				echo '<div style="clear: '.$dirr.';"></div>'."\n";
				echo '<div style="text-align: justify; padding: 10px 2px 4px 2px;">'."\n";
				echo nl2br($com->cmessage);
				echo "</div>\n";
				echo "</div>\n";
				echo '</li>'._LEND;
				$k = 1 - $k;
			}
			echo "</ul>\n";
		} else {
			echo '<p>'.$eblog->lng->NOCOMMENTS."</p>\n";
		}

		if (!$postComment) {
			echo '<p>'.$eblog->lng->MUSTLOGTOCOM."</p>\n";
		} else {
			echo '<h3 class="eblog-commentstitle">'.$eblog->lng->POSTCOMMENT."</h3>\n";

			$random = rand(104, 996);
			$rtl = (_GEM_RTL) ? ' dir="rtl"' : '';
?>

			<form name="eblogcomform" method="post" action="index2.php" id="eblogcomfm">
				<?php if (!$my->id) { ?>
				<label for="comauthor"<?php echo $rtl; ?>><?php echo _CMN_NAME; ?></label>
				<input type="text" id="comauthor" name="comauthor" value="" class="inputbox" title="<?php echo _CMN_NAME; ?>" />
				<label for="comemail"<?php echo $rtl; ?>><?php echo _CMN_EMAIL; ?></label>
				<input type="text" id="comemail" name="comemail" value="" class="inputbox" title="<?php echo _CMN_EMAIL; ?>" /> 
				<span style="font-size: 0.92em; color: #777;"><?php echo defined('_E_WONTPUBLISHED') ? _E_WONTPUBLISHED : 'It will not be published'; ?></span>
				<?php } ?>
				<label for="commessage"<?php echo $rtl; ?>><?php echo $eblog->lng->YOURCOMMENT; ?></label>
				<textarea id="commessage" name="commessage" class="text_area" rows="8" cols="70"></textarea><br /><br />
				<input type="checkbox" name="comnotify" value="1" /> <?php echo defined('_E_NOTIFYREPLY') ? _E_NOTIFYREPLY : 'Notify me via e-mail on reply'; ?>
				<?php if ($mainframe->getCfg('captcha')) { ?>
					<br /><br />
					<span<?php echo $rtl; ?>>
					<?php echo _E_SECCODE; ?>: <img src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/includes/captcha/captcha.img.php" alt="<?php echo _E_SPELL; ?>" border="0" />
                    <a href="javascript:captchaPlayer('<?php echo $_SESSION['captchasnd']; ?>');" title="<?php echo _E_SPELL; ?>"><img src="<?php echo $mainframe->getCfg('live_site'); ?>/includes/captcha/speaker.gif" alt="<?php echo _E_SPELL; ?>" /></a>
                    </span>
					<br />
					<label for="code<?php echo $random; ?>"<?php echo $rtl; ?>><?php echo _E_TYPE_SECCODE; ?>:</label> 
					<input type="text" name="code" id="code<?php echo $random; ?>" dir="ltr" value="" size="10" maxlength="10" title="<?php echo _E_SECCODE; ?>" />
				<?php } ?>
				<br /><br />
				<input type="hidden" name="blogid" value="<?php echo $eblog->getCV('blogid'); ?>" />
				<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
				<input type="hidden" name="articleid" value="<?php echo $articleid; ?>" />
				<input type="hidden" name="option" value="com_eblog" />
				<input type="hidden" name="task" value="addcomment" />
				<input type="button" name="postbutton" class="button" value="<?php echo _E_ADD; ?>" onclick="ebpostccheck()" />
			</form>
<?php 
			if ($comments) {
?>
			<form name="eblogstopnotform" method="post" action="index2.php" id="eblogstopnotfm" style="margin-top: 20px;">
				<p><?php echo defined('_E_STOPRECNOTIF') ? _E_STOPRECNOTIF : 'I dont want to recieve notifications any more on new comments to this article'; ?></p>
				<?php if (!$my->id) { ?>
				<label for="notifemail"<?php echo $rtl; ?>><?php echo _CMN_EMAIL; ?></label>
				<input type="text" id="notifemail" name="notifemail" value="" class="inputbox" title="<?php echo _CMN_EMAIL; ?>" />
				<?php } ?>
				<input type="hidden" name="blogid" value="<?php echo $eblog->getCV('blogid'); ?>" />
				<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
				<input type="hidden" name="articleid" value="<?php echo $articleid; ?>" />
				<input type="hidden" name="option" value="com_eblog" />
				<input type="hidden" name="task" value="removenotif" />
				<input type="submit" name="notifbutton" class="button" value="<?php echo _SEND_BUTTON; ?>" />
			</form>
<?php 
			}
		}
		echo "</div>\n";
	}


	/********************/
	/* LIST TAG RESULTS */
	/********************/
	static private function processTagResults($tag, $rows) {
		global $Itemid, $eblog;
		
		$tagtitle = ($tag != '') ? $tag : $eblog->lng->UNKNOWNTAG;
?>

		<div class="eblog-comments">
		<h3 class="eblog-commentstitle"><?php echo $tagtitle; ?></h3>
		<p><?php 
		echo sprintf($eblog->lng->POSTSTAGASAT, '<strong>'.$tagtitle.'</strong>', $eblog->getCV('title'))."<br />\n";
		echo sprintf(_E_SEARCH_TOTALF, count($rows));
		?></p>
<?php 
		if ($rows) {
			$k = 0;
			echo "<ul id=\"eblog-commentsul\">\n";
			for ($i=0; $i<count($rows); $i++) {
				$row = $rows[$i];

				$noseflink = 'index.php?option=com_eblog&task=show&blogid='.$eblog->getCV('blogid').'&id='.$row->id.'&Itemid='.$Itemid;
				$seflink = 'eblog/'.$eblog->getCV('seotitle').'/'.$row->seotitle.'.html';
				$link = sefRelToAbs($noseflink, $seflink);

				echo '<li class="eblog-line'.$k.'">'._LEND;
				echo '<div class="eblog-tagarticle"><a href="'.$link.'" title="'.$row->title.'">'.$row->title.'</a></div>'._LEND;
				echo '<div class="eblog-commentdate">'.mosFormatDate($row->dateadded, _GEM_DATE_FORMLC2).'</div>'._LEND;
				echo '</li>'._LEND;
				$k = 1 - $k;
			}
			echo "</ul>\n";
		} else {
			echo '<p>'._E_NORESULTS."</p>\n";
		}
?>
		</div>
		<div style="clear: both;"></div>
		
<?php 
	}


	/***************************/
	/* LIST OWN POSTS (CPANEL) */
	/***************************/
	static private function ownPosts($rows, $showall) {
		global $eblog, $Itemid, $mainframe;
		
		$title = ($showall == 1) ? $eblog->lng->ALLPOSTS : sprintf($eblog->lng->LATESTPOSTS, 30);
?>

		<div class="eblog-comments">
		<h3 class="eblog-commentstitle"><?php echo $title; ?></h3>
		<p><?php 
		if ($showall == 1) {
			$noseflink = 'index.php?option=com_eblog&task=cpanel&blogid='.$eblog->getCV('blogid').'&Itemid='.$Itemid;
			$seflink = 'eblog/'.$eblog->getCV('seotitle').'/cpanel.html';
			$link = sefRelToAbs($noseflink, $seflink);
			$linktitle = sprintf($eblog->lng->LATESTPOSTS, 30);
		} else {
			$noseflink = 'index.php?option=com_eblog&task=cpanel&blogid='.$eblog->getCV('blogid').'&showall=1&Itemid='.$Itemid;
			$seflink = 'eblog/'.$eblog->getCV('seotitle').'/cpanel.html?showall=1';
			$link = sefRelToAbs($noseflink, $seflink);
			$linktitle = $eblog->lng->ALLPOSTS;
		}
		echo '<a href="'.$link.'" title="'.$linktitle.'" style="color: #CC0000; font-weight: bold;">'.$linktitle.'</a><br />'._LEND;
		echo sprintf(_E_SEARCH_TOTALF, count($rows));
		unset($title, $noseflink, $seflink, $link, $linktitle);
		?></p>
<?php 
		if ($rows) {
			$k = 0;
			echo "<ul id=\"eblog-commentsul\">\n";
			for ($i=0; $i<count($rows); $i++) {
				$row = $rows[$i];

				$link = sefRelToAbs('index.php?option=com_eblog&task=show&blogid='.$eblog->getCV('blogid').'&id='.$row->id.'&Itemid='.$Itemid, 'eblog/'.$eblog->getCV('seotitle').'/'.$row->seotitle.'.html');
				$editLink = sefRelToAbs('index.php?option=com_eblog&task=edit&blogid='.$eblog->getCV('blogid').'&id='.$row->id.'&Itemid='.$Itemid, 'eblog/'.$eblog->getCV('seotitle').'/edit.html?id='.$row->id);
				$deleteLink = $mainframe->getCfg('live_site').'/index2.php?option=com_eblog&task=delete&blogid='.$eblog->getCV('blogid').'&id='.$row->id.'&Itemid='.$Itemid;

				if (trim($row->language) == '') {
					$postlanguages = _E_ALL_LANGUAGES;
				} else {
					$larr = explode(',',$row->language);
					$parr = array();
					if (count($larr) > 0) {
						foreach ($larr as $l) {
							array_push($parr, $eblog->translatedLang(trim($l)));
						}
					}
					$postlanguages = implode(', ', $parr);
					if ($postlanguages == '') { $postlanguages = _E_ALL_LANGUAGES; }
				}

				echo '<li class="eblog-line'.$k.'">'._LEND;
				if ($row->published) {
					echo '<div class="eblog-tagarticle"><a href="'.$link.'" title="'.$row->title.'">'.$row->title.'</a></div>'._LEND;
				} else {
					echo '<div class="eblog-tagarticle"><em>'.$row->title.'</em></div>'._LEND;
				}
				echo '<div class="eblog-commentdate">'.mosFormatDate($row->dateadded, _GEM_DATE_FORMLC2).'</div>'._LEND;
				echo '<div class="eblog-postmore">';
				echo '<a href="'.$editLink.'" title="'._E_EDIT.'">'._E_EDIT.'</a> | ';
				echo '<a href="'.$deleteLink.'" title="'._CMN_DELETE.'">'._CMN_DELETE.'</a> | ';
				echo _E_HITS.': '.$row->hits.' | ';
				echo _E_LANGUAGE.': '.$postlanguages;
				echo "</div>\n";
				echo '</li>'._LEND;
				$k = 1 - $k;
			}
			echo "</ul>\n";
		} else {
			echo '<p>'._E_NORESULTS."</p>\n";
		}
?>
		</div>
		<div style="clear: both;"></div>

<?php 
	}


	/********************/
	/* SHOW BLOG HEADER */
	/********************/
	static private function blogHeader($pageNav=null) {
		global $eblog, $access, $mainframe, $Itemid, $my;

		$link = 'index.php?option=com_user&amp;task=profile&amp;Itemid='.$eblog->uListItemid().'&amp;uid='.$eblog->getCV('ownerid');
		$href = ($access->canViewProf) ? sefRelToAbs($link, 'members/'.$eblog->getCV('owneruname').'.html') : 'javascript:void(null);';
		$t = '<img src=\\\''.$mainframe->getCfg('ssl_live_site').'/images/avatars/'.$eblog->getCV('owneravatar').'\\\' />';

		$bnoseo = 'index.php?option=com_eblog&task=browse&blogid='.$eblog->getCV('blogid').'&Itemid='.$Itemid;
		$bseo = 'eblog/'.$eblog->getCV('seotitle').'/';
		$blogLink = sefRelToAbs($bnoseo, $seo);
?>
		<div class="eblog-blogtop">
			<h1 class="eblog-blogtitle">
				<a href="<?php echo $blogLink; ?>" title="<?php echo $eblog->getCV('title'); ?>"><?php echo $eblog->getCV('title'); ?></a>
			</h1>

<?php 
			if (trim($eblog->getCV('slogan')) != '') {
				echo "<div class=\"eblog-slogan\">\n";
				echo $eblog->getCV('slogan')."\n";
				echo "</div>\n";
				echo '<div style="clear:both;"></div>'."\n";
			}

			if ($eblog->getCV('showownertop')) {
?>

			<div class="eblog-ownername">
				<a href="<?php echo $href; ?>" title="<?php echo _E_VIEW_PROFILE; ?>" onmouseover="this.T_TITLE='<?php echo $eblog->getCV('owneruname'); ?>';this.T_WIDTH=104;this.T_TEXTALIGN='center';return escape('<?php echo $t; ?>')">
					<?php echo $eblog->getCV('ownername'); ?>
				</a>
			</div>
<?php 
			}

			if ($eblog->task == 'archive') {
				echo '<div class="arcivedate"><div class="archiveyear">'.$eblog->year.'</div><div class="archivemonth">'.$eblog->translatedMonth($eblog->month).'</div></div>';
				echo '<div style="clear:both;"></div>'."\n";
			} else if ($eblog->task == 'dayposts') {
				echo '<div class="arcivedate"><div class="archiveyear">'.$eblog->year.'</div><div class="archivemonth">'.$eblog->day.' '.$eblog->translatedMonth($eblog->month).'</div></div>';
				echo '<div style="clear:both;"></div>'."\n";
			}

			$sk = in_array($eblog->task, array('browse', 'show', 'tags', 'archive', 'dayposts'));
			if (($my->id && ($my->id == $eblog->getCV('ownerid'))) && $sk) {
				$cpnoseo = 'index.php?option=com_eblog&task=cpanel&blogid='.$eblog->getCV('blogid').'&Itemid='.$Itemid;
				$cpseo = 'eblog/'.$eblog->getCV('seotitle').'/cpanel.html';
				$cpLink = sefRelToAbs($cpnoseo, $cpseo);
?>
			<div class="eblog-gocpanel">
				<a href="<?php echo $cpLink; ?>" title="<?php echo $eblog->lng->MANBLOG; ?>"><?php echo $eblog->lng->CPANEL; ?></a>
			</div>
<?php 
			}

			if ($pageNav) {
				$total_pages = ceil($pageNav->total / $pageNav->limit);
				if ($total_pages > 1) {
					$this_page = ceil(($pageNav->limitstart+1) / $pageNav->limit);
					if ($this_page > $total_pages) { $this_page = $total_pages; }
					echo '<div style=" margin: 10px 0; font-size: 11px; color: #666;">'._PN_PAGE.' '.$this_page.' '._PN_OF.' '.$total_pages."</div>\n";
					unset($this_page);
				}
				unset($total_pages);
			}
?>
		</div>

<?php 
	}


	/********************/
	/* SHOW BLOG FOOTER */
	/********************/
	static private function blogFooter($pageNav=null) {
		global $eblog, $Itemid, $lang, $mainframe;

		if ($pageNav && ($eblog->task == 'archive')) {
			if (ceil($pageNav->total / $pageNav->limit) > 1) {
				$isoslashed = eLOCALE::elxis_iso639($lang).'/';
				$uprefix = ($lang != $mainframe->getCfg('lang')) ? $isoslashed : '';
				$noseflink = 'index.php?option=com_eblog&task=archive&month='.$eblog->year.$eblog->month.'&blogid='.$eblog->getCV('blogid').'&Itemid='.$Itemid;
				$seolink = $uprefix.'eblog/'.$eblog->getCV('seotitle').'/'.$eblog->year.$eblog->month.'/';
				echo '<div style="text-align: center; margin: 15px 0;">'.$pageNav->writePagesLinks($noseflink, $seolink).'</div>'."\n";
			}
		}

		if (!$eblog->getCV('footerarchive')) { return; }

		$months = $eblog->archiveMonths();
		if ((!$months) || (count($months) == 0)) { return; }
?>
		<div class="eblog-blogfooter">
		<h3 class="eblog-commentstitle"><?php echo $eblog->lng->ARCHIVES; ?></h3>
		<?php 
			$c = count($months);
			foreach ($months as $key => $val) {
				$transmonth = $eblog->translatedMonth($val['month']);
				$noseo = 'index.php?option=com_eblog&task=archive&month='.$key.'&blogid='.$eblog->getCV('blogid').'&Itemid='.$Itemid;
				$seo = 'eblog/'.$eblog->getCV('seotitle').'/'.$key.'/';
				$link = sefRelToAbs($noseo, $seo);
				echo '<a href="'.$link.'" title="'.$transmonth.' '.$val['year'].'" class="eblog-arclink">'.$transmonth.' '.$val['year']."</a>\n";
			}
		?>
		</div>

<?php 		
	}


	/***************************/
	/* BLOG CONFIGURATION FORM */
	/***************************/
	private static function configForm($lists) {
		global $mainframe, $eblog, $Itemid;
?>
		<form name="eblogform" action="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/index2.php" method="post">
		<table id="ebcfgtable" cellspacing="0" summary="<?php echo $eblog->lng->MANBLOG; ?>">
		<caption><?php echo $eblog->lng->MANBLOG.' - '.$eblog->lng->SETTINGS; ?></caption>
		<tr>
			<th scope="col" abbr="option"><?php echo $eblog->lng->OPTION; ?></th>
			<th scope="col" abbr="value"><?php echo $eblog->lng->VALUE; ?></th>
			<th scope="col" abbr="help"><?php echo $eblog->lng->HELP; ?></th>
		</tr>
		<tr>
			<th scope="row" abbr="<?php echo _E_TITLE; ?>" class="spec" nowrap="nowrap"><?php echo _E_TITLE; ?></th>
			<td><input type="text" name="cfg_title" class="eblog-inputbox" value="<?php echo $eblog->getCV('title'); ?>" /></td>
			<td></td>
		</tr>
		<tr>
			<th scope="row" abbr="<?php echo $eblog->lng->SLOGAN; ?>" class="specalt" nowrap="nowrap"><?php echo $eblog->lng->SLOGAN; ?></th>
			<td class="alt" colspan="2">
				<textarea name="cfg_slogan" cols="60" rows="3" class="eblog-inputbox"><?php echo $eblog->getCV('slogan'); ?></textarea><br />
				<?php echo $eblog->lng->SLOGAND; ?>
			</td>
		</tr>
		<tr>
			<th scope="row" abbr="<?php echo $eblog->lng->SHOWOWNER; ?>" class="spec" nowrap="nowrap"><?php echo $eblog->lng->SHOWOWNER; ?></th>
			<td><?php echo $lists['showownertop']; ?></td>
			<td><?php echo $eblog->lng->SHOWOWNERD; ?></td>
		</tr>
		<tr>
			<th scope="row" abbr="<?php echo $eblog->lng->TAGS; ?>" class="specalt" nowrap="nowrap"><?php echo $eblog->lng->TAGS; ?></th>
			<td class="alt"><?php echo $lists['showtags']; ?></td>
			<td class="alt"><?php echo $eblog->lng->SHOWTAGSD; ?></td>
		</tr>
		<tr>
			<th scope="row" abbr="<?php echo $eblog->lng->CSSFILE; ?>" class="spec" nowrap="nowrap"><?php echo $eblog->lng->CSSFILE; ?></th>
			<td><?php echo $lists['cssfile']; ?></td>
			<td><?php echo $eblog->lng->CSSFILED; ?></td>
		</tr>
		<tr>
			<th scope="row" abbr="<?php echo $eblog->lng->RTLCSSFILE; ?>" class="specalt" nowrap="nowrap"><?php echo $eblog->lng->RTLCSSFILE; ?></th>
			<td class="alt"><?php echo $lists['rtlcssfile']; ?></td>
			<td class="alt"><?php echo $eblog->lng->RTLCSSFILED; ?></td>
		</tr>
		<tr>
			<th scope="row" abbr="<?php echo $eblog->lng->COMMENTARY; ?>" class="spec" nowrap="nowrap"><?php echo $eblog->lng->COMMENTARY; ?></th>
			<td><?php echo $lists['allowcomments']; ?></td>
			<td></td>
		</tr>
		<tr>
			<th scope="row" abbr="<?php echo $eblog->lng->POSTSNUMBER; ?>" class="specalt" nowrap="nowrap"><?php echo $eblog->lng->POSTSNUMBER; ?></th>
			<td class="alt">
				<select name="cfg_numposts" class="eblog-inputbox" dir="ltr">
				<?php 
				for ($i=1; $i<51; $i++) {
					$sel = ($i == $eblog->getCV('numposts')) ? ' selected="selected"' : '';
					echo '<option value="'.$i.'"'.$sel.'>&nbsp;'.$i.'&nbsp;</option>'._LEND;
				}
				?>
				</select>
			</td>
			<td class="alt"><?php echo $eblog->lng->POSTSNUMBERD; ?></td>
		</tr>
		<tr>
			<th scope="row" abbr="<?php echo $eblog->lng->SHOWARCHIVE; ?>" class="spec" nowrap="nowrap"><?php echo $eblog->lng->SHOWARCHIVE; ?></th>
			<td><?php echo $lists['footerarchive']; ?></td>
			<td><?php echo $eblog->lng->SHOWARCHIVED; ?></td>
		</tr>
		<tr>
			<th scope="row" abbr="<?php echo $eblog->lng->SHAREPOST; ?>" class="specalt"><?php echo $eblog->lng->SHAREPOST; ?></th>
			<td class="alt"><?php echo $lists['share']; ?></td>
			<td class="alt">Powered by 
				<a href="http://www.e-mailit.com/" title="E-mail it" target="_blank">E-mail*It</a> &amp; 
				<a href="http://www.addthis.com/" title="AddThis" target="_blank">AddThis</a>
			</td>
		</tr>
		<tr>
			<th scope="row" abbr="e-mailit <?php echo _USERNAME; ?>" class="spec" nowrap="nowrap">e-mailit <?php echo _USERNAME; ?></th>
			<td><input type="text" name="cfg_params_emailit" class="eblog-inputbox" dir="ltr" value="<?php echo $eblog->getCV('emailit'); ?>" /></td>
			<td></td>
		</tr>
		<tr>
			<th scope="row" abbr="AddThis <?php echo _USERNAME; ?>" class="specalt" nowrap="nowrap">AddThis <?php echo _USERNAME; ?></th>
			<td class="alt"><input type="text" name="cfg_params_addthis" class="eblog-inputbox" dir="ltr" value="<?php echo $eblog->getCV('addthis'); ?>" /></td>
			<td class="alt"></td>
		</tr>
		</table>

		<input type="hidden" name="option" value="com_eblog" />
		<input type="hidden" name="task" value="saveconfig" />
		<input type="hidden" name="blogid" value="<?php echo $eblog->getCV('blogid'); ?>" />
		<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
		<div align="center">
			<input type="submit" name="ebcfgbutton" class="eblog-button" value="<?php echo _E_SAVE; ?>" />
		</div>
		</form>

<?php 		
	}


	/******************************/
	/* EBLOG CONTROL PANEL HEADER */
	/******************************/
	static private function cpanelHeader() {
		global $eblog, $Itemid;

		$nosefl = 'index.php?option=com_eblog&task=cpanel&blogid='.$eblog->getCV('blogid').'&Itemid='.$Itemid;
		$sefl = 'eblog/'.$eblog->getCV('seotitle').'/cpanel.html';
		$link = sefRelToAbs($nosefl, $sefl);

		$nosefl = 'index.php?option=com_eblog&task=new&blogid='.$eblog->getCV('blogid').'&Itemid='.$Itemid;
		$sefl = 'eblog/'.$eblog->getCV('seotitle').'/new.html';
		$newlink = sefRelToAbs($nosefl, $sefl);

		$active = ($eblog->task == 'cpanel') ? ' id="eblog-tbarsel"': '';
		echo '<ul class="eblog-toolbar">'._LEND;
		echo '<li'.$active.'><a href="'.$link.'" title="'.$eblog->lng->CPANEL.'">'.$eblog->lng->CPANEL.'</a></li>'._LEND;

		if ($eblog->getCV('canconfig')) {
			//add post link, edit config link, manage images/video link (if has access)
			$nosefl = 'index.php?option=com_eblog&task=config&blogid='.$eblog->getCV('blogid').'&Itemid='.$Itemid;
			$sefl = 'eblog/'.$eblog->getCV('seotitle').'/config.html';
			$link = sefRelToAbs($nosefl, $sefl);
			$active = ($eblog->task == 'config') ? ' id="eblog-tbarsel"': '';
			
			echo '<li'.$active.'><a href="'.$link.'" title="'.$eblog->lng->SETTINGS.'">'.$eblog->lng->SETTINGS.'</a></li>'._LEND;
		}

		$active = ($eblog->task == 'new') ? ' id="eblog-tbarsel"': '';
		echo '<li'.$active.'><a href="'.$newlink.'" title="'.$eblog->lng->NEWPOST.'">'.$eblog->lng->NEWPOST.'</a></li>'._LEND;
		
		echo '</ul>'._LEND;
		echo '<div style="clear: both;"></div>'._LEND;
	}


	/**********************/
	/* HTML ADD/EDIT POST */
	/**********************/
	private static function showEditor($row) {
		global $eblog, $Itemid, $mainframe;

		mosMakeHtmlSafe( $row );
		$youtube = $mainframe->getCfg('live_site').'/index2.php?option=com_eblog&task=addextra&type=youtube&blogid='.$eblog->getCV('blogid').'&Itemid='.$Itemid;
		$yahoo = $mainframe->getCfg('live_site').'/index2.php?option=com_eblog&task=addextra&type=yahoo&blogid='.$eblog->getCV('blogid').'&Itemid='.$Itemid;
		$google = $mainframe->getCfg('live_site').'/index2.php?option=com_eblog&task=addextra&type=google&blogid='.$eblog->getCV('blogid').'&Itemid='.$Itemid;

		$pgtitle = ($row->id) ? $eblog->lng->EDITPOST: $eblog->lng->NEWPOST;
		$dir = (_GEM_RTL) ? 'right' : 'left';

		$postlangs = explode(',',trim($row->language));
		$sitelangs = explode(',', $mainframe->getCfg('pub_langs'));
?>

		<script type="text/javascript">
		/* <![CDATA[ */
		function ebchangelang(si) {
			if (si == 0) {
				for (var i=1; i < <?php echo (count($sitelangs) + 1); ?>; i++) {
					document.getElementById('postlang'+i).disabled = false;
					document.getElementById('postlang'+i).checked = true;
					document.getElementById('spanlang'+i).style.color = "#4f6b72";
				}
				document.getElementById('alllangs').disabled = true;
				document.getElementById('spanlang0').style.color = "#CCCCCC";
			} else {
				var lchecked = false;
				for (var i=1; i < <?php echo (count($sitelangs) + 1); ?>; i++) {
					if (document.getElementById('postlang'+i).checked) { lchecked = true; }
				}
				if (lchecked == false) {
					for (var i=1; i < <?php echo (count($sitelangs) + 1); ?>; i++) {
						document.getElementById('spanlang'+i).style.color = "#CCCCCC";
						document.getElementById('postlang'+i).disabled = true;
					}
					document.getElementById('alllangs').disabled = false;
					document.getElementById('alllangs').checked = true;
					document.getElementById('spanlang0').style.color = "#4f6b72";
				}
			}
		}

		function subeblogpost() {
			var form = document.eblogform;
			try { form.onsubmit(); }
			catch(e){}

			if (form.title.value == "") {
				alert ("<?php echo _E_WARNTITLE; ?>");
			} else if (form.seotitle.value == "") {
				alert ("<?php echo $eblog->lng->SEOTITLEEMPTY; ?>");
			} else {
				<?php getEditorContents('editor1', 'blogtext'); ?>
				form.submit();
			}
		}

		function addEblogMore() {
			var mdata = "\n{blogmore}\n";
			window.tinyMCE.execCommand('mceInsertContent',false,mdata);
		}
		/* ]]> */
		</script>

		<form name="eblogform" action="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/index2.php" method="post">

		<table id="ebcfgtable" cellspacing="0" summary="<?php echo $pgtitle; ?>">
		<caption><?php echo $eblog->lng->MANBLOG.' - '.$pgtitle; ?></caption>
		<tr>
			<th scope="col" abbr="post" colspan="2"><?php echo $pgtitle; ?></th>
		</tr>
		<tr>
			<th scope="row" abbr="<?php echo _E_TITLE; ?>" class="specalt" nowrap="nowrap"><?php echo _E_TITLE; ?></th>
			<td class="alt"><input type="text" name="title" class="eblog-inputbox" value="<?php echo $row->title; ?>" /></td>
		</tr>
		<tr>
			<th scope="row" abbr="<?php echo $eblog->lng->SEOTITLE; ?>" class="spec" nowrap="nowrap"><?php echo $eblog->lng->SEOTITLE; ?></th>
			<td>
				<input type="text" name="seotitle" id="seotitlex" class="eblog-inputbox" value="<?php echo $row->seotitle; ?>" /> 
                <a href="javascript:void(null);" onclick="suggesteBlogSEO()"><?php echo $eblog->lng->SEOTSUG; ?></a> &nbsp; | &nbsp; 
                <a href="javascript:void(null);" onclick="validateeBlogSEO()"><?php echo $eblog->lng->SEOTVAL; ?></a><br />
				<div id="valiseo" style="height: 20px;"></div>			
				<?php echo $eblog->lng->SEOTHELP; ?><br />
			</td>
		</tr>
		<tr>
			<th scope="row" abbr="<?php echo _E_LANGUAGES; ?>" class="specalt" nowrap="nowrap"><?php echo _E_LANGUAGES; ?></th>
			<td class="alt">
<?php 
			if (trim($row->language) == '') {
				$dis0 = '';
				$dis1 = ' disabled="disabled"';
				$checked = ' checked="checked"';
				$style0 = '';
				$style1 = ' style="color: #CCCCCC;"';
			} else {
				$dis0 = ' disabled="disabled"';
				$dis1 = '';
				$checked = '';
				$style0 = ' style="color: #CCCCCC;"';
				$style1 = '';
			}
			echo '<input type="checkbox" name="alllangs" id="alllangs"'.$checked.$dis0.' value="" onclick="ebchangelang(0);" /> <span id="spanlang0"'.$style0.'>'._E_ALL_LANGUAGES.'</span><br />'._LEND;

			$w = 1;			
			foreach ($sitelangs as $slang) {
				$checked = (in_array($slang, $postlangs)) ? ' checked="checked"': '';
				echo '<input type="checkbox" name="postlang[]" id="postlang'.$w.'"'.$checked.$dis1.' value="'.$slang.'" onclick="ebchangelang('.$w.');" /> <span id="spanlang'.$w.'"'.$style1.'>'.$eblog->translatedLang($slang).'</span><br />'._LEND;
				$w++;
			}
?>

			</td>
		</tr>
		<tr>
			<th scope="row" abbr="<?php echo _CMN_PUBLISHED; ?>" class="spec" nowrap="nowrap"><?php echo _CMN_PUBLISHED; ?></th>
			<td><?php echo mosHTML::yesnoRadioList('published', '', $row->published); ?></td>
		</tr>
		<tr>
			<th scope="row" abbr="<?php echo _DATE; ?>" class="specalt" nowrap="nowrap"><?php echo _DATE; ?></th>
			<td class="alt"><?php echo mosFormatDate($row->dateadded, _GEM_DATE_FORMLC2); ?></td>
		</tr>
		<tr>
			<th scope="row" abbr="<?php echo _E_HITS; ?>" class="spec" nowrap="nowrap"><?php echo _E_HITS; ?></th>
			<td><?php echo intval($row->hits); ?></td>
		</tr>
		<tr>
			<th scope="row" abbr="<?php echo $eblog->lng->TAGS; ?>" class="specalt" nowrap="nowrap"><?php echo $eblog->lng->TAGS; ?></th>
			<td class="alt"><input type="text" name="tags" class="eblog-inputbox" value="<?php echo $row->tags; ?>" size="50" title="<?php echo $eblog->lng->COMSEPTAGS; ?>" /></td>
		</tr>
		</table>
		
		<div style="margin: 10px 0; text-align: <?php echo $dir; ?>">
<?php 
		if ($eblog->getCV('canupload')) {
			$popurl = $mainframe->getCfg('live_site').'/index2.php?option=com_eblog&task=media&blogid='.$eblog->getCV('blogid').'&Itemid='.$Itemid;
?>

			<a href="javascript: void(null);" onclick="popupWindow('<?php echo $popurl; ?>', 'Media', '600', '450', '1');" title="<?php echo $eblog->lng->MEDIAMAN; ?>">
			<img src="<?php echo $mainframe->secureURL($eblog->url); ?>/images/mediamanager.png" alt="<?php echo $eblog->lng->MEDIAMAN; ?>" />
			</a> &nbsp; 

<?php } ?>

		<a href="javascript: void(null);" onclick="popupWindow('<?php echo $youtube; ?>', 'YOUTUBE', '450', '350', '1');" title="<?php echo $eblog->lng->YOUTUBEVIDEO; ?>">
		<img src="<?php echo $mainframe->secureURL($eblog->url); ?>/images/youtube.gif" alt="<?php echo $eblog->lng->YOUTUBEVIDEO; ?>" />
		</a> &nbsp; 
		<a href="javascript: void(null);" onclick="popupWindow('<?php echo $yahoo; ?>', 'YAHOO', '450', '350', '1');" title="<?php echo $eblog->lng->YAHOOVIDEO; ?>">
		<img src="<?php echo $mainframe->secureURL($eblog->url); ?>/images/yahoovideo.gif" alt="<?php echo $eblog->lng->YAHOOVIDEO; ?>" />
		</a> &nbsp; 
		<a href="javascript: void(null);" onclick="popupWindow('<?php echo $google; ?>', 'GOOGLE', '450', '350', '1');" title="<?php echo $eblog->lng->GOOGLEVIDEO; ?>">
		<img src="<?php echo $mainframe->secureURL($eblog->url); ?>/images/googlevideo.gif" alt="<?php echo $eblog->lng->GOOGLEVIDEO; ?>" />
		</a> &nbsp; 
		<a href="javascript: void(null);" onclick="addEblogMore();" title="<?php echo _READ_MORE; ?>">
		<img src="<?php echo $mainframe->secureURL($eblog->url); ?>/images/more.png" alt="<?php echo _READ_MORE; ?>" />
		</a>
		</div>
		<div style="margin: 10px 0; text-align: <?php echo $dir; ?>">
		<?php editorArea('editor1', $row->blogtext, 'blogtext', '450', '300', '45', '15'); ?>
		</div>

		<input type="hidden" name="id" value="<?php echo intval($row->id); ?>" />
		<input type="hidden" name="option" value="com_eblog" />
		<input type="hidden" name="task" value="save" />
		<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
		<input type="hidden" name="blogid" value="<?php echo $eblog->getCV('blogid'); ?>" />
		<input type="hidden" name="hits" value="<?php echo intval($row->hits); ?>" />
		<input type="hidden" name="dateadded" value="<?php echo $row->dateadded; ?>" />
		<input type="button" name="subpost" class="eblog-button" value="<?php echo _E_SAVE; ?>" onclick="subeblogpost();" />
		</form>

<?php 
	}


	/*****************************/
	/* SHOW IMAGE MANAGER WINDOW */
	/*****************************/
	public static function browseMedia($images, $t=0, $totalsize=0) {
		global $eblog, $mainframe, $my, $Itemid;

		$viewLink = $mainframe->getCfg('live_site').'/index2.php?option=com_eblog&task=media&blogid='.$eblog->getCV('blogid').'&Itemid='.$Itemid.'&t=';

		$pc = (100 * $totalsize)/$eblog->getCV('mediasize');
		if ($pc > 80) {
			$spants = '<span style="color: #FF0000; font-weight: bold;">'.$totalsize.'</span>';
		} else if ($pc > 60) {
			$spants = '<span style="color: #FF0000;">'.$totalsize.'</span>';
		} else {
			$spants = $totalsize;
		}
		$dir = (_GEM_RTL) ? ' dir="rtl"': '';
?>
		<table cellspacing="0" cellpadding="0" border="0" summary="upload image" class="ebloguptop"<?php echo $dir; ?>>
			<tr>
				<td><?php echo $spants; ?>/<?php echo $eblog->getCV('mediasize'); ?> KB</td>
				<td style="text-align: right; font-weight: bold;"><?php echo $eblog->lng->UPLOADIMG; ?></td>
			</tr>
			<tr>
				<td>
				<a href="<?php echo $viewLink.'0'; ?>" title="<?php echo $eblog->lng->LISTVIEW; ?>"><img src="<?php echo $mainframe->secureURL($eblog->url); ?>/images/listview.png" alt="<?php echo $eblog->lng->LISTVIEW; ?>" /></a> &nbsp; 
				<a href="<?php echo $viewLink.'1'; ?>" title="<?php echo $eblog->lng->THUMBSVIEW; ?>"><img src="<?php echo $mainframe->secureURL($eblog->url); ?>/images/thumbsview.png" alt="<?php echo $eblog->lng->THUMBSVIEW; ?>" /></a>
				</td>
				<td nowrap="nowrap" align="right">
				<form id="mediaupload" name="mediaupload" enctype="multipart/form-data" method="post" action="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/index2.php">
					<input type="file" name="upfile" id="upfile" class="eblog-inputbox" /> 
            		<input type="hidden" name="option" value="com_eblog" />
            		<input type="hidden" name="blogid" value="<?php echo $eblog->getCV('blogid'); ?>" />
            		<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
            		<input type="hidden" name="t" value="<?php echo $t; ?>" />
            		<input type="hidden" name="task" value="uploadmedia" /> 
            		<input type="submit" name="submitme" value="<?php echo $eblog->lng->UPLOAD; ?>" class="eblog-button2" />				
				</form>
				</td>
			</tr>
		</table>

		<table id="ebcfgtable" cellspacing="0" summary="<?php echo $eblog->lng->MANBLOG.' - '._E_IMAGES; ?>">

<?php if (!$t) { ?>

		<tr>
			<th scope="col" abbr="option"><?php echo _E_IMAGES; ?></th>
			<th scope="col" abbr="value"><?php echo $eblog->lng->DIMENSIONS; ?></th>
			<th scope="col" abbr="help"><?php echo $eblog->lng->SIZEKB; ?></th>
			<th scope="col" abbr="delete">&nbsp;</th>
		</tr>

<?php } else { ?>

		<tr><th scope="col" abbr="images" colspan="4"><?php echo _E_IMAGES; ?></th></tr>

<?php 
}
		if (count($images) > 0) {
			$k = 0;
			$i = 1;
			foreach ($images as $image) {
				$class = ($k) ? ' class="alt"' : '';
				
				$alta = preg_split('/\./', $image['file'], 2);
				$alt = preg_replace('/\_/', ' ', $alta['0']);
				$img = htmlspecialchars('<img src="'.$mainframe->getCfg('ssl_live_site').'/images/userfiles/'.$my->id.'/'.$image['file'].'" alt="'.$alt.'" />');

				$appendLink = 'window.opener.tinyMCE.execCommand(\'mceInsertContent\',false,\''.$img.'\');';
				
				if ($t) {
					$rimg = 'images/userfiles/'.$my->id.'/'.$image['file'];
					$fi = base64_encode('64,64,0,'.$rimg);
					$w = ($i == 4) ? '' : ' width="25%"';
					echo ($i == 1) ? "<tr>\n" : '';
					echo "<td class=\"alt\" align=\"center\"".$w.">";
					echo '<a href="javascript:void(null);" title="'._E_INSERT.'" onclick="'.$appendLink.'">';
					echo '<img src="'.$mainframe->getCfg('ssl_live_site').'/includes/thumb.php?fi='.$fi.'" alt="'.$alt.'" /></a><br />';
					echo substr($image['file'], 0, 22)."</td>\n";
					echo ($i == 4) ? "</tr>\n" : '';
					$i ++;
					if ($i == 5) { $i = 1; }
				} else {
					$dLink = $mainframe->getCfg('live_site').'/index2.php?option=com_eblog&amp;task=deletemedia&amp;blogid='.$eblog->getCV('blogid').'&amp;Itemid='.$Itemid.'&amp;f='.base64_encode($image['file']);
					echo "<tr>\n";
					echo "<td scope=\"row\" nowrap=\"nowrap\"".$class.">";
					echo '<a href="javascript:void(null);" title="'._E_INSERT.'" onclick="'.$appendLink.'">'.$image['file'].'</a>';
					echo "</td>\n";
					echo "<td".$class." align=\"center\">".$image['dim']."</td>\n";
					echo "<td".$class." align=\"center\">".$image['size']." kb</td>\n";
					echo "<td".$class." align=\"center\">\n";
					echo '<a href="'.$dLink.'" title="'._CMN_DELETE.'"><img src="'.$mainframe->secureURL($eblog->url).'/images/deleteimg.png" alt="'._CMN_DELETE.'" /></a>';
					echo "</td>\n";
					echo "</tr>\n";
					$k = 1 - $k;
				}
			}
			if (($t) && ($i > 1)) {
				$rep = 5 - $i;
				echo str_repeat('<td class="alt">&nbsp;</td>', $rep);
				echo "</tr>\n";
			}
		} else {
			echo "<tr>\n";
			echo "<td scope=\"row\" colspan=\"4\" align=\"center\">"._E_NOIMAGES."</td>\n";
			echo "</tr>\n";
		}
?>
		</table>
		<div style="margin: 30px 0; text-align: center; color: #777; font-size: 11px;">eBlog by Elxis Team &copy;2006-<?php echo date('Y'); ?>. All rights reserved.</div>

<?php 
	}


	/*******************************************/
	/* POPUP WINDOW TO ADD EXTRA MEDIA TO POST */
	/*******************************************/
	static public function addExtra() {
		global $eblog, $Itemid;

		$type = mosGetParam($_GET, 'type', 'youtube');
		$dir = (_GEM_RTL) ? ' dir="rtl"' : '';

		switch($type) {
			case 'youtube':
				$title = $eblog->lng->YOUTUBEVIDEO;
			break;
			case 'google':
				$title = $eblog->lng->GOOGLEVIDEO;
			break;
			case 'yahoo':
				$title = $eblog->lng->YAHOOVIDEO;
			break;
			default:
				$title = 'Video';
			break;
		}
?>

		<script type="text/javascript">
		/* <![CDATA[ */
		function appendToBlog() {
			var mtype = '<?php echo $type; ?>';
			var im = document.getElementById('imedia');
			if (im.value == '') {
				alert('Please insert a valid Video ID!');
				im.focus();
				return false;
			}
			if (mtype == 'youtube') {
				var idata = '{youtube}'+im.value+'{/youtube}';
			} else if (mtype == 'google') {
				var idata = '{googlevideo}'+im.value+'{/googlevideo}';
			} else if (mtype == 'yahoo') {
				var idata = '{yahoovideo}'+im.value+'{/yahoovideo}';
			} else {
				alert('Invalid video type!');
				return false;
			}
			window.opener.tinyMCE.execCommand('mceInsertContent',false,idata);
			window.close();
		}
		/* ]]> */
		</script>

		<table id="ebcfgtable" cellspacing="0" summary="append media to post">
		<tr>
			<th scope="col" abbr="media" colspan="2"><?php echo $title; ?></th>
		</tr>
		<tr>
			<td scope="row" class="alt">Video ID</td>
			<td class="alt" nowrap="nowrap">
				<form id="appendmedia" name="appendmedia" method="post" action="index2.php">
				<input type="text" name="imedia" id="imedia" class="eblog-inputbox" value="" /> 
				<input type="hidden" name="option" value="com_eblog" />
        		<input type="hidden" name="blogid" value="<?php echo $eblog->getCV('blogid'); ?>" />
        		<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
        		<input type="hidden" name="task" value="" />  
        		<input type="button" name="submitme" value="<?php echo _E_INSERT; ?>" class="eblog-button2" onclick="appendToBlog();" />
        		</form>
			</td>
		</tr>
		</table>

<?php 
	}


	/********************/
	/* EBLOG HTML START */
	/********************/
	private static function blogStart() {
		echo '<!-- eBlog by Elxis Team start -->'._LEND;
		echo '<div id="elxisblog">'._LEND;
	}


	/******************/
	/* EBLOG HTML END */
	/******************/
	private static function blogEnd() {
		global $mainframe, $eblog;

		echo '</div>'._LEND;
		echo '<div style="clear: both;"></div>'._LEND;
		if ($eblog->getCV('showownertop')) {
			echo '<script type="text/javascript" src="'.$mainframe->getCfg('ssl_live_site').'/administrator/includes/js/wz_tooltip.js"></script>'._LEND;
		}
		if (($eblog->getCV('share') == 2) && in_array($eblog->task, array('archive', 'dayposts', 'show', 'browse'))) {
			echo '<script type="text/javascript" src="'.$mainframe->secureURL('http://s7.addthis.com/').'js/250/addthis_widget.js#username='.$eblog->getCV('addthis').'"></script>'."\n";
		}
		echo '<!-- eBlog by Elxis Team end -->'._LEND;
	}
	
}

?>