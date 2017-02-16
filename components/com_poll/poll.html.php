<?php 
/** 
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Poll
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class poll_html {


    /*****************************/
    /* HTML DISPLAY POLL RESULTS */
    /*****************************/
	public static function showResults( &$poll, &$votes, $first_vote, $last_vote, $pollist, $params ) {
		$align = (_GEM_RTL) ? 'left' : 'right';

		if ( $params->get( 'page_title' ) ) {
			echo '<h1 class="componentheading'.$params->get( 'pageclass_sfx' ).'">'.$params->get( 'header' ).'</h1>'._LEND;
		}
		?>

		<div align="<?php echo $align; ?>">
		    <?php echo _E_SEL_POLL; ?> 
			<a href="javascript:void(0);" onclick="hideLayer('selectpoll');" title="<?php echo _CMN_SHOW.'/'._CMN_HIDE; ?>">
				<img src="images/M_images/arrow_down.png" alt="<?php echo _CMN_SHOW.'/'._CMN_HIDE; ?>" title="<?php echo _CMN_SHOW.'/'._CMN_HIDE; ?>" border="0" align="bottom" />
			</a>
			<div id="selectpoll" style="text-align: <?php echo $align; ?>; clear: both; display:none; padding: 5px;">
				<?php echo $pollist; ?>
			</div>
		</div>

		<div class="contentpane<?php echo $params->get( 'pageclass_sfx' ); ?>" id="pollresultstable"> 
		<?php 
		if ($votes) {
			$j=0;
			$data_arr["text"]=null;
			$data_arr["hits"]=null;
			foreach ($votes as $vote) {
				$data_arr["text"][$j]=eUTF::utf8_trim($vote->text);
				$data_arr["hits"][$j]=$vote->hits;
				$j++;
			}
			poll_html::graphit( $data_arr, $poll->title, $first_vote, $last_vote, $poll->locked );
		} else {
            echo _E_NOPOLL_RESULTS.'<br />'._LEND;
		}
		?>
		</div>
		<?php 
		mosHTML::BackButton( $params );
	}


    /**********************/
    /* DISPLAY POLL GRAPH */
    /**********************/
	private static function graphit( $data_arr, $graphtitle, $first_vote, $last_vote, $locked=0 ) {
		global $mainframe, $polls_maxcolors, $polls_barheight, $polls_graphwidth, $polls_barcolor;

		$k = 0;
		$colorx = 0;
		$maxval = 0;
		array_multisort( $data_arr["hits"], SORT_NUMERIC,SORT_DESC, $data_arr["text"] );

		foreach($data_arr["hits"] as $hits) {
			if ($maxval < $hits) { $maxval = $hits; }
		}
		$sumval = array_sum( $data_arr["hits"] );
		?> 

		<h3 class="sectiontableheader"> 
			<img src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/components/com_poll/images/poll.png" align="bottom" border="0" alt="poll" /> 
			<?php echo $graphtitle; ?> 
		</h3>

        <ul class="polltable">
		<?php
		for ($i=0, $n=count($data_arr["text"]); $i < $n; $i++) {
			$text = &$data_arr["text"][$i];
			$hits = &$data_arr["hits"][$i];
			if ($maxval > 0 && $sumval > 0) {
				$width = ceil( $hits*$polls_graphwidth/$maxval );
				$percent = round( 100*$hits/$sumval, 1 );
			} else {
				$width = 0;
				$percent = 0;
			}
			?>
            <li class="row<?php echo $k; ?>">
                <?php echo $text; ?><br />
                <?php 
				$tdclass='';
				if ($polls_barcolor==0) {
					if ($colorx < $polls_maxcolors) {
						$colorx = ++$colorx;
					} else {
						$colorx = 1;
					}
					$tdclass = "polls_color_".$colorx;
				} else {
					$tdclass = "polls_color_".$polls_barcolor;
				}
				?>
				<img src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/components/com_poll/images/blank.png" class="<?php echo $tdclass; ?>" height="<?php echo $polls_barheight; ?>" width="<?php echo $width; ?>" alt="poll bar" /> 
                <span<?php echo (_GEM_RTL) ? ' dir="rtl"' : ''; ?>>(<strong><?php echo $hits; ?></strong> / <?php echo $percent; ?>%)</span>
            </li>
        <?php 
            $k = 1 - $k;
        }
        ?>
        </ul>
        <div class="clear"></div>
		<br />

		<?php 
		$span1 = (_GEM_RTL) ? '<span dir="rtl">' : '';
		$span2 = (_GEM_RTL) ? '</span>' : '';
        echo $span1._E_NUM_VOTERS.':'.$span2.' &nbsp; '. $sumval.'<br />'._LEND;
        if ($first_vote != '') {
			echo $span1._E_FIRST_VOTE.':'.$span2.' &nbsp; '.$first_vote.'<br />'._LEND;
		}
		if ($last_vote != '') {
			echo $span1._E_LAST_VOTE.':'.$span2.' &nbsp; '.$last_vote.'<br />'._LEND;
		}
		if ($locked) {
            echo '<br /><strong>'._POLL_LOCKALERT.'</strong><br />'._LEND;
		}
	}
}

?>