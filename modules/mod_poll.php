<?php 
/** 
* @version: $Id$
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Module Poll
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (!defined('_MOS_POLL_MODULE')) {
	define('_MOS_POLL_MODULE', 1);

    /*********************/
    /* DISPLAY VOTE FORM */
    /*********************/
    function show_poll_vote_form() {
    	global $database, $lang, $Itemid, $my;

		$query1 = "SELECT p.id, p.title, p.seotitle, p.locked, p.voters"
		."\n FROM #__polls p, #__poll_menu pm"
		."\n WHERE p.id=pm.pollid AND (pm.menuid='$Itemid' OR pm.menuid='0')"
		."\n AND p.published=1"
		."\n AND ((p.language IS NULL) OR (p.language LIKE '%$lang%'))"
		."\n AND p.access IN (".$my->allowed.")"
		."\n ORDER BY p.locked ASC";
		$database->setQuery($query1);
		$polls = $database->loadObjectList();

		if (!$polls) {
			echo _POLL_NOPOLLS.'<br />'._LEND;
			return;
		}

		$k = 0;
		foreach ($polls as $poll) {
			if ($poll->id && $poll->title) {
				if ($poll->locked) {
					poll_locked_html( $poll, $k );
					$k++;
				} else {
					if (in_array($database->_resource->databaseType, array('oci8', 'oci8po', 'oci805', 'oracle'))) {
						$query = "SELECT id, text, hits FROM #__poll_data WHERE pollid='$poll->id' AND TRIM(text) IS NOT NULL ORDER BY id ASC";
					} else {
						$query = "SELECT id, text, hits FROM #__poll_data WHERE pollid='$poll->id' AND text <> '' ORDER BY id ASC";
					}
					$database->setQuery($query);
					$options = $database->loadObjectList();
				
					if ($options) {
						poll_vote_form_html($poll, $options);
					}
				}
			}
		}
	}


	/***********************/
	/* DISPLAY LOCKED POLL */
	/***********************/
	function poll_locked_html( &$poll, $k=0 ) {
		$direction = (_GEM_RTL) ? ' dir="rtl"' : '';
		if ($k == 0) { echo '<span class="polltitle">'._POLL_PAST.'</span><br />'._LEND; }
		echo '<a href="'.sefRelToAbs('index.php?option=com_poll&task=results&id='.$poll->id, 'polls/'.$poll->seotitle.'.html').'" ';
		echo ' title="'._BUTTON_RESULTS.'">'.$poll->title.'</a> <span'.$direction.'>('.$poll->voters.' '._POLL_VOTES.')</span><br />'._LEND;
	}


	/*************/
	/* VOTE FORM */
	/*************/
	function poll_vote_form_html( &$poll, &$options ) {
		global $Itemid;

		$cookiename = 'voted'.$poll->id;
		$voted = intval(mosGetParam($_COOKIE, $cookiename, '0'));
		$seolink = ($poll->seotitle != '') ? 'polls/'.$poll->seotitle.'.html' : '';
		if (!$voted) {
		?>
		<form name="pollform<?php echo $poll->id; ?>" method="post" action="<?php echo sefRelToAbs('index.php?option=com_poll&Itemid='.$Itemid, 'polls/vote.html?Itemid='.$Itemid); ?>">
			<span class="polltitle"><?php echo $poll->title; ?></span><br />
			<ul class="polltable">
			<?php 
			$w = 0;
			for ($i=0; $i < count( $options ); $i++) {
				echo '<li class="row'.$w.'">'._LEND;
				echo '<input type="radio" name="voteid" id="voteid'.$options[$i]->id.'" value="'.$options[$i]->id.'" title="'.$options[$i]->text.'" />'._LEND;
				echo '<label for="voteid'.$options[$i]->id.'">'.$options[$i]->text.'</label>'._LEND;
				echo '</li>'._LEND;
				$w = 1 - $w;
			}
			?>
			</ul>

			<input type="hidden" name="option" value="com_poll" />
			<input type="hidden" name="task" value="vote" />
			<input type="hidden" name="id" value="<?php echo $poll->id; ?>" />
			<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
			<input type="submit" name="task_button" class="button" value="<?php echo _BUTTON_VOTE; ?>" title="<?php echo _BUTTON_VOTE; ?>" /><br />
			<a href="<?php echo sefRelToAbs('index.php?option=com_poll&task=results&id='.$poll->id, $seolink); ?>" title="<?php echo _BUTTON_RESULTS; ?>"><?php echo _BUTTON_RESULTS; ?></a>
		</form>
<?php 
		} else {
			$results = array();
			for ($i=0; $i < count($options); $i++) {
				$txt = $options[$i]->text;
				$results[$txt] = $options[$i]->hits;
			}
			uasort($results, 'resultssorter');
			$rtldir = _GEM_RTL ? ' dir="rtl"' : '';
?>
			<span class="polltitle"><?php echo $poll->title; ?></span><br />
			<ul class="polltable">
			<?php 
			$w = 0;
			foreach ($results as $pq => $ph) {
				echo '<li class="row'.$w.'">'.$pq.' <span'.$rtldir.'>('.$ph.')</span></li>'._LEND;
				$w = 1 - $w;
			}
			?>
			</ul>

			<?php echo _ALREADY_VOTE; ?><br />
			<a href="<?php echo sefRelToAbs('index.php?option=com_poll&task=results&id='.$poll->id, $seolink); ?>" title="<?php echo _BUTTON_RESULTS; ?>">
                <?php echo _BUTTON_RESULTS; ?>
            </a><br />
	<?php 
		}	
	}


	/*****************************************/
	/* CUSTOM SORT FUNCTION FOR POLL RESULTS */
	/*****************************************/
	function resultssorter($a, $b) {
    	if ($a == $b) { return 0; }
    	return ($a < $b) ? 1 : -1;
	}
}

show_poll_vote_form();

?>