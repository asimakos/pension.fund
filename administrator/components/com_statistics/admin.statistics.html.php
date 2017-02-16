<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Statistics
* @author: Elxis Team
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_statistics {


    /***************************/
    /* HTML DISPLAY STATISTICS */
    /***************************/
	static public function show( &$browsers, &$platforms, $tldomains, $bstats, $pstats, $dstats, $sorts, $option ) {
	    global $mainframe, $adminLanguage;

		$tab = mosGetParam( $_REQUEST, 'tab', 'tab1' );
		$width = 400;	// width of 100%
		$tabs = new mosTabs(1);
		$align = (_GEM_RTL) ? 'right' : 'left';
?>
		<style type="text/css">
		.bar_1{ background-color: #8D1B1B; border: 2px ridge #B22222; }
		.bar_2{ background-color: #6740E1; border: 2px ridge #4169E1; }
		.bar_3{ background-color: #8D8D8D; border: 2px ridge #D2D2D2; }
		.bar_4{ background-color: #CC8500; border: 2px ridge #FFA500; }
		.bar_5{ background-color: #5B781E; border: 2px ridge #6B8E23; }
		</style>

		<table class="adminheading">
		<tr>
			<th class="browser"><?php echo $adminLanguage->A_CMP_STA_OS; ?></th>
		</tr>
		</table>

		<form action="index2.php" method="post" name="adminForm">
		<?php
		$tabs->startPane("statsPane");
        $tabs->startTab($adminLanguage->A_CMP_STA_BRPAGE, "browsers-page" );
		?>
		<table class="adminlist">
		<tr>
            <th align="<?php echo $align; ?>">
                <?php echo $adminLanguage->A_CMP_STA_BROWSER; ?> <?php echo $sorts['b_agent']; ?>
            </th>
			<th>&nbsp;</th>
			<th width="100" align="<?php echo $align; ?>">% <?php echo $sorts['b_hits']; ?></th>
			<th width="100" align="<?php echo $align; ?>"><?php echo $adminLanguage->A_NB; ?></th>
		</tr>
		<?php
		$c = 1;
		if (is_array($browsers) && count($browsers) > 0) {
			$k = 0;
			foreach ($browsers as $b) {
				$f = $bstats->totalhits > 0 ? $b->hits / $bstats->totalhits : 0;
				$w = $width * $f;
			?>
			<tr class="row<?php echo $k; ?>">
				<td><?php echo $b->agent; ?></td>
				<td width="<?php echo $width+10; ?>">
					<div align="<?php echo $align; ?>">
                        <img src="<?php echo $mainframe->getCfg('live_site'); ?>/components/com_poll/images/blank.png" class="bar_<?php echo $c; ?>" height="6" width="<?php echo $w; ?>" />
                    </div>
				</td>
				<td><?php printf( "%.2f%%", $f * 100 ); ?></td>
				<td><?php echo $b->hits; ?></td>
			</tr>
			<?php
			$c = $c % 5 + 1;
			$k = 1 - $k;
			}
		}
		?>
		</table>
		<?php
		$tabs->endTab();
        $tabs->startTab($adminLanguage->A_CMP_STA_OSPAGE, "os-page" );
        ?>
        <table class="adminlist">
            <tr>
                <th class="title">&nbsp;<?php echo $adminLanguage->A_CMP_STA_OPSYST; ?>&nbsp;<?php echo $sorts['o_agent']; ?></th>
                <th>&nbsp;</th>
                <th width="100" class="title">% <?php echo $sorts['o_hits']; ?></th>
                <th width="100" class="title"><?php echo $adminLanguage->A_NB; ?></th>
            </tr>
            <?php 
            $c = 1;
            if (is_array($platforms) && count($platforms) > 0) {
                $k = 0;
                foreach ($platforms as $p) {
                    $f = $pstats->totalhits > 0 ? $p->hits / $pstats->totalhits : 0;
                    $w = $width * $f;
            ?>
                    <tr class="row<?php echo $k; ?>">
                        <td><?php echo $p->agent; ?></td>
                        <td width="<?php echo $width+10; ?>">
                            <div align="<?php echo $align; ?>">
                                <img src="<?php echo $mainframe->getCfg('live_site'); ?>/components/com_poll/images/blank.png" class="bar_<?php echo $c; ?>" height="6" width="<?php echo $w; ?>" />
                            </div>
                        </td>
                        <td><?php printf( "%.2f%%", $f * 100 ); ?></td>
                        <td><?php echo $p->hits; ?></td>
                    </tr>
            <?php 
                    $c = $c % 5 + 1;
                    $k = 1 - $k;
                }
            }
            ?>
        </table>
		<?php 
        $tabs->endTab();
        $tabs->startTab($adminLanguage->A_CMP_STA_URLPAGE, "domain-page" );
        ?>
        <table class="adminlist">
            <tr>
                <th class="title"><?php echo $adminLanguage->A_CMP_STA_URL; ?> <?php echo $sorts['d_agent']; ?></th>
                <th>&nbsp;</th>
                <th width="100" class="title">% <?php echo $sorts['d_hits']; ?></th>
                <th width="100" class="title"><?php echo $adminLanguage->A_NB; ?></th>
            </tr>
            <?php 
            $c = 1;
            if (is_array($tldomains) && count($tldomains) > 0) {
                $k = 0;
                foreach ($tldomains as $b) {
                    $f = $dstats->totalhits > 0 ? $b->hits / $dstats->totalhits : 0;
                    $w = $width * $f;
            ?>
                    <tr class="row<?php echo $k; ?>">
                        <td width="200"><?php echo $b->agent; ?></td>
                        <td width="<?php echo $width+10; ?>">
                            <div align="<?php echo $align; ?>">
                                <img src="<?php echo $mainframe->getCfg('live_site'); ?>/components/com_poll/images/blank.png" class="bar_<?php echo $c; ?>" height="6" width="<?php echo $w; ?>" />
                            </div>
                        </td>
                        <td><?php printf( "%.2f%%", $f * 100 ); ?></td>
                        <td><?php echo $b->hits; ?></td>
                    </tr>
            <?php 
                    $c = $c % 5 + 1;
                    $k = 1 - $k;
                }
            }
            ?>
            </table>
<?php 
        $tabs->endTab();
        $tabs->endPane();
?>
        <input type="hidden" name="option" value="<?php echo $option; ?>" />
        <input type="hidden" name="tab" value="<?php echo $tab; ?>" />
	</form>
<?php 
	}


    /*********************************/
    /* HTML DISPLAY PAGE IMPRESSIONS */
    /*********************************/
	static public function pageImpressions( &$rows, $pageNav, $option, $task ) {
		global $adminLanguage;

?>
        <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminheading">
		<tr>
			<th class="impressions"><?php echo $adminLanguage->A_CMP_STA_IMPR; ?></th>
        </tr>
        </table>

        <form action="index2.php" method="post" name="adminForm">
            <table class="adminlist">
            <tr>
                <th width="20"><?php echo $adminLanguage->A_NB; ?></th>
                <th class="title"><?php echo $adminLanguage->A_TITLE; ?></th>
                <th class="title"><?php echo $adminLanguage->A_DATE; ?></th>
                <th align="center" nowrap="nowrap"><?php echo $adminLanguage->A_CMP_STA_PGIMPR; ?></th>
            </tr>
            <?php 
            $i = $pageNav->limitstart;
            $k = 0;
            if ($rows) {
                foreach ($rows as $row) {
            ?>
                    <tr class="row<?php echo $k; ?>">
                        <td align="center"><?php echo ++$i; ?></td>
                        <td><?php echo $row->title; ?></td>
                        <td><?php echo mosFormatDate($row->created); ?></td>
                        <td align="center"><?php echo $row->hits; ?></td>
                    </tr>
            <?php 
                $k = 1 - $k;
                }
            }
            ?>
            </table>

            <?php echo $pageNav->getListFooter(); ?>
            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="task" value="<?php echo $task; ?>" />
        </form>
<?php 
	}


    /*************************/
    /* HTML DISPLAY SEARCHES */
    /*************************/
	static public function showSearches( &$rows, $pageNav, $option, $task ) {
		global $mainframe, $adminLanguage;
?>
        <form action="index2.php" method="post" name="adminForm">
            <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminheading">
            <tr>
                <th width="100%" class="searchtext">
                    <?php echo $adminLanguage->A_CMP_STA_SCHENG; ?> :
                    <span class="componentheading">
                        <?php echo $adminLanguage->A_CMP_STA_LOGIS; ?> : 
                        <?php echo $mainframe->getCfg( 'enable_log_searches' ) ? '<span color: green; font-weight: bold;">'. $adminLanguage->A_ENABLED .'</span>' : '<span color: red; font-weight: bold;">'. $adminLanguage->A_DISABLED .'</span>'; ?>
                    </span>
                </th>
            </tr>
            </table>

            <table class="adminlist">
            <tr>
                <th><?php echo $adminLanguage->A_NB; ?></th>
                <th class="title"><?php echo $adminLanguage->A_CMP_STA_SEARCTXT; ?></th>
                <th nowrap="nowrap"><?php echo $adminLanguage->A_CMP_STA_TREQ; ?></th>
                <th nowrap="nowrap"><?php echo $adminLanguage->A_CMP_STA_RRET; ?></th>
            </tr>
            <?php 
            $k = 0;
            for ($i=0, $n = count($rows); $i < $n; $i++) {
                $row =& $rows[$i];
            ?>
                <tr class="row<?php echo $k; ?>">
                    <td><?php echo $i+1+$pageNav->limitstart; ?></td>
                    <td><?php echo $row->search_term; ?></td>
                    <td align="center"><?php echo $row->hits; ?></td>
                    <td align="center"><?php echo $row->returns; ?></td>
                </tr>
            <?php 
            $k = 1 - $k;
            }
            ?>
            </table>

            <?php echo $pageNav->getListFooter(); ?>
            <input type="hidden" name="option" value="<?php echo $option; ?>" />
            <input type="hidden" name="task" value="<?php echo $task; ?>" />
        </form>
<?php 
    }
}
?>