<?php 
/**
* @version: $Id: mosvote.php 34 2010-06-05 20:07:14Z sannosi $
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Bots/Content
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* @description: Vote Bot
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$_MAMBOTS->registerFunction( 'onBeforeDisplayContent', 'botVoting' );

function botVoting( &$row, $params, $page=0 ) {
	global $mosConfig_live_site, $mosConfig_absolute_path, $cur_template, $Itemid, $database;

	$id = $row->id;
	$option = 'com_content';
	$task = mosGetParam( $_REQUEST, 'task', '' );

	$html = '';
	if ($params->get( 'rating' ) && !$params->get( 'popup' )) {
		//look for images in template if available
		$starImageOn = mosAdminMenus::ImageCheck( 'rating_star.png', '/images/M_images/', NULL, '/images/M_images/', 'ON', 'staron', 1, 'bottom');
		$starImageOff = mosAdminMenus::ImageCheck( 'rating_star_blank.png', '/images/M_images/', NULL, '/images/M_images/', 'OFF', 'staroff', 1, 'bottom' );

		$img = '';
		for ($i=0; $i < $row->rating; $i++) {
			$img .= $starImageOn;
		}
		for ($i=$row->rating; $i < 5; $i++) {
			$img .= $starImageOff;
		}
		$html .= '<span class="content_rating">'._LEND;
		$html .= _USER_RATING.': '.$img.'&nbsp;/&nbsp;';
		$html .= intval( $row->rating_count )._LEND;
		$html .= '</span><br />'._LEND;

		if (!$params->get( 'intro_only' ) && ($task != 'blogsection')) {
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND $_SERVER['HTTP_X_FORWARDED_FOR']!="") {
				$currip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else if (isset($_SERVER['REMOTE_ADDR']) AND $_SERVER['REMOTE_ADDR']!="") {
				$currip = $_SERVER['REMOTE_ADDR'];
			} else {
				$currip = getenv( 'REMOTE_ADDR' );
			}

			$database->setQuery("SELECT COUNT(*) FROM #__content_rating WHERE content_id='".$id."' AND lastip='".$currip."'");
			$hasvote = intval($database->loadResult());
			if (!$hasvote) {
				$html .= '<form method="post" action="'.sefRelToAbs( 'index.php', 'vote.html' ).'" name="rateform">';
				$html .= '<span class="content_vote">'._LEND;
				$html .= _VOTE_POOR._LEND;
				$html .= '<input type="radio" title="1" name="user_rating" value="1" />'._LEND;
				$html .= '<input type="radio" title="2" name="user_rating" value="2" />'._LEND;
				$html .= '<input type="radio" title="3" name="user_rating" value="3" />'._LEND;
				$html .= '<input type="radio" title="4" name="user_rating" value="4" />'._LEND;
				$html .= '<input type="radio" title="5" name="user_rating" value="5" checked="checked" />'._LEND;
				$html .= _VOTE_BEST;
				$html .= '&nbsp;<input type="submit" name="submit_vote" class="button" title="'._RATE_BUTTON.'" value="'._RATE_BUTTON.'" />'._LEND;
				$html .= '<input type="hidden" name="task" value="vote" />'._LEND;
				$html .= '<input type="hidden" name="pop" value="0" />'._LEND;
				$html .= '<input type="hidden" name="option" value="com_content" />'._LEND;
				$html .= '<input type="hidden" name="Itemid" value="'.$Itemid.'" />'._LEND;
				$html .= '<input type="hidden" name="cid" value="'.$id.'" />'._LEND;
				$html .= '</span>';
				$html .= '</form>'._LEND;
			}
		}
	}
	return $html;
} 
?>