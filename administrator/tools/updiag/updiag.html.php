<?php 
/**
* @version: $Id: updiag.html.php 2540 2009-10-01 10:13:39Z datahell $
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools / Updiag
* @author: Ioannis Sannos
* @email: datahell@elxis.org
* @link: http://www.elxis.org
* @description: Updiag is an Elxis CMS diagnostic and update tool
* @license: http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
* Elxis CMS and Updiag are Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_updiag {


    /***************/
    /* SHOW HEADER */
    /***************/
    static public function header() {
        HTML_updiag::importCSS();
        HTML_updiag::importJS();
        HTML_updiag::menu();
    }


    /****************/
    /* DISPLAY MENU */
    /****************/
    static private function menu() {
        global $upLang, $adminLanguage;
        
        $mainurl = 'index2.php?option=com_admin&task=tools&tname=updiag';
    ?>
        <div id="mainMenu">
	        <a><img src="tools/updiag/images/update.png" border="0" alt="<?php echo $upLang->HOME; ?>" /> <?php echo $upLang->HOME; ?></a>
            <a><img src="tools/updiag/images/update.png" border="0" alt="<?php echo $upLang->UPDATE; ?>" /> <?php echo $upLang->UPDATE; ?></a>
            <a><img src="tools/updiag/images/run.png" border="0" alt="<?php echo $upLang->MAINTENANCE; ?>" /> <?php echo $upLang->MAINTENANCE; ?></a>            
            <a><img src="tools/updiag/images/news.png" border="0" alt="<?php echo $upLang->NEWS; ?>" /> <?php echo $upLang->NEWS; ?></a>
            <a><img src="tools/updiag/images/help.png" border="0" alt="<?php echo $adminLanguage->A_HELP; ?>" /> <?php echo $adminLanguage->A_HELP; ?></a>
        </div>
        <div id="submenu">
            <div id="submenu_1">
            <a href="<?php echo $mainurl; ?>" target="_self"><?php echo $upLang->UPDSPAG; ?></a>
            </div>
            <div id="submenu_2">
            <a href="<?php echo $mainurl.'&act=chkversion'; ?>" target="_self"><?php echo $upLang->CHVERS; ?></a> | 
		    <a href="<?php echo $mainurl.'&act=patches'; ?>" target="_self"><?php echo $upLang->CHPATCHES; ?></a> | 
            <a href="<?php echo $mainurl.'&act=upscripts'; ?>" target="_self">Updiag scripts</a>
            </div>
            <div id="submenu_3">
            <a href="<?php echo $mainurl.'&act=filecheck'; ?>" target="_self"><?php echo $upLang->FSCHECK; ?></a> | 
            <a href="<?php echo $mainurl.'&act=downhashes'; ?>" target="_self"><?php echo $upLang->DNHASHFLS; ?></a>
            </div>
            <div id="submenu_4">
            <a href="<?php echo $mainurl.'&act=newrel'; ?>" target="_self"><?php echo $upLang->NEWRELEASES; ?></a>
            </div>
            <div id="submenu_5">
            <a href="http://forum.elxis.org" target="_blank" title="Elxis official forum">Elxis Forum</a>
            </div>
        </div>
        <script type="text/javascript">initMenu();</script>
<?php 
    }


    /**************/
    /* IMPORT CSS */
    /**************/
    static private function importCSS() {
?>
    <style type="text/css">
        @import url('tools/updiag/css/tabmenu.css');
        @import url('tools/updiag/css/updiag<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.css');
    </style>
<?php 
    }


    /*********************/
    /* IMPORT JAVASCRIPT */
    /*********************/
    static private function importJS() {
?>
    <script type="text/javascript" src="tools/updiag/js/tabmenu<?php echo (_GEM_RTL) ? '-rtl' : ''; ?>.js"></script>
    <script type="text/javascript" src="includes/js/ajax_new.js"></script>
<?php 
    }


    /***************/
    /* IMPORT AJAX */
    /***************/
    static public function importAJAX() {
?>
    <script type="text/javascript" src="includes/js/ajax_new.js"></script>
    <script type="text/javascript" src="tools/updiag/js/upajax.js"></script>
<?php 
    }


    /*********************************************/
    /* SHOW VERSION CHECK AGAINST NEWEST VERSION */
    /*********************************************/
    static public function h_checkVersion(&$row, $errormsg='') {
        global $adminLanguage, $upLang, $updiag;

        if ($row) {
            if ($updiag->iversion < $row->version) {
                $cver = ' <font color="#FF0000"><b>('.$upLang->OUTDATED.')</b></font><br />'.$upLang->NEWVERAV;
            } else {
                $cver = ' <font color="green"><b>('.$upLang->CURRENT.')</b></font>';
            }
            if ($row->image == '') { $row->image = 'tools/updiag/images/elxislogo.png'; }    
        ?>
            <div id="upcontents">
                <?php echo $upLang->INSELXVER.': <b>'.$updiag->iversion.'</b>'.$cver; ?><hr />
                <img src="<?php echo $row->image; ?>" />
                <div id="hd" dir="ltr"><?php echo $row->title; ?></div>
                <div dir="ltr"><?php echo $row->description; ?></div><br /><br />

                <div class="upinfo"><?php 
                if ($row->date != '') {
                    if (!preg_match('/\:/', $row->date)) { $row->date .= ' 00:00:00'; }
                }            
                echo '<b>'.$adminLanguage->A_DATE.':</b> ';
                echo ($row->date != '') ? mosFormatDate($row->date, _GEM_DATE_FORMLC) : $adminLanguage->A_UNKNOWN;
                ?>
                </div>
                <div class="upinfo"><?php echo '<b>'.$adminLanguage->A_VERSION.':</b> '.$row->version; ?></div>
                <?php if ($row->size != '') { ?>
                <div class="upinfo"><?php echo '<b>'.$upLang->SIZE.':</b> '.$row->size; ?></div>
                <?php } ?>
                <?php 
                if (($row->more != '') || ($row->link != '')) {
                    echo '<div class="upinfo">';
                    if ($row->more != '') {
                        echo '<a href="'.$row->more.'" target="_blank" class="upinfol">'.$upLang->MORE.'...</a> &nbsp; ';
                    }
                    if ($row->link != '') {
                        echo '<a href="'.$row->link.'" target="_blank" class="upinfol">'.$upLang->DOWNLOAD.'</a>';
                    }
                    echo "</div>\n";
                }
                ?>
            </div>
        <?php 
        } else {
        ?>
            <div id="upcontents" style="height: 100px;">
                <?php echo $upLang->INSELXVER.': <b>'.$updiag->iversion.'</b>'; ?><hr />
                <img src="tools/updiag/images/error.png" border="0" alt="<?php echo $adminLanguage->A_ERROR; ?>" />
                <font color="#FF0000"><b><?php echo $adminLanguage->A_ERROR; ?></b></font><br />
                <?php echo $errormsg; ?>
            </div>
        <?php 
        }
    }


    /**************************/
    /* SHOW AVAILABLE PATCHES */
    /**************************/
    static public function h_patches($rows=array(), $errormsg='') {
        global $adminLanguage, $upLang, $updiag;

        $counter = count($rows);
        if (($rows) && ($counter>0)) {
            for($i=0; $i<$counter; $i++) {
                $row = $rows[$i];
        ?>
            <div id="upcontents">
                <?php echo ($i=='0') ? $upLang->INSELXVER.': <b>'.$updiag->iversion.'</b><hr />' : ''; ?>

                <div id="hd" dir="ltr"><?php echo $row['title']; ?></div>
                <div dir="ltr"><?php echo $row['description']; ?></div><br /><br />

                <div class="upinfo"><?php 
                if ($row['date'] != '') {
                    if (!preg_match('/\:/', $row['date'])) { $row['date'] .= ' 00:00:00'; }
                }            
                echo '<b>'.$adminLanguage->A_DATE.':</b> ';
                echo ($row['date'] != '') ? mosFormatDate($row['date'], _GEM_DATE_FORMLC) : $adminLanguage->A_UNKNOWN;
                ?>
                </div>
                <?php if ($row['size'] != '') { ?>
                <div class="upinfo"><?php echo '<b>'.$upLang->SIZE.':</b> '.$row['size']; ?></div>
                <?php } ?>
                <?php 
                if (($row['more'] != '') || ($row['link'] != '')) {
                    echo '<div class="upinfo">';
                    if ($row['more'] != '') {
                        echo '<a href="'.$row['more'].'" target="_blank" class="upinfol">'.$upLang->MORE.'...</a> &nbsp; ';
                    }
                    if ($row['link'] != '') {
                        echo '<a href="'.$row['link'].'" target="_blank" class="upinfol">'.$upLang->DOWNLOAD.'</a>';
                    }
                    echo "</div>\n";
                }
                ?>
            </div>
        <?php 
            }
        } else {
        ?>
            <div id="upcontents" style="height: 100px;">
                <?php echo $upLang->INSELXVER.': <b>'.$updiag->iversion.'</b>'; ?><hr />
                <?php if ($errormsg != '') { ?>
                    <img src="tools/updiag/images/error.png" border="0" alt="<?php echo $adminLanguage->A_ERROR; ?>" />
                    <font color="#FF0000"><b><?php echo $adminLanguage->A_ERROR; ?></b></font><br />
                    <?php echo $errormsg; ?>
                <?php 
                } else {
                    echo $upLang->NOPATCHES;
                }
                ?>
            </div>
        <?php 
        }
    }


    /**************************/
    /* SHOW AVAILABLE SCRIPTS */
    /**************************/
    static public function h_scripts($rows=array(), $errormsg='') {
        global $adminLanguage, $upLang, $updiag;

        HTML_updiag::importAjax();
        $counter = count($rows);
        if (($rows) && ($counter>0)) {
            for($i=0; $i<$counter; $i++) {
                $row = $rows[$i];
                $iColor = ($row['installed']) ? '<font color="green">'.$adminLanguage->A_YES.'</font>' : '<font color="#FF0000">'.$adminLanguage->A_NO.'</font>';
        ?>
            <div id="upcontents">
                <?php echo ($i=='0') ? $upLang->INSELXVER.': <b>'.$updiag->iversion.'</b><hr />' : ''; ?>
                <div id="hd"><?php echo $row['name']; ?></div>
                <?php echo $row['description']; ?><br />
                <div class="upinfo"><b><?php echo $upLang->INSTALLED.': '.$iColor; ?></b></div>
                <div class="upinfo">                
                <?php if (!$row['installed']) { ?>
                    <a href ="javascript: doup('<?php echo base64_encode($row[name]); ?>', '<?php echo $i; ?>');" class="upinfol"><?php echo $upLang->DOWNLOAD; ?></a>
                <?php } else { ?>
                    <a href ="javascript: runup('<?php echo base64_encode($row[name]); ?>', '<?php echo $i; ?>');" class="upinfol"><?php echo $upLang->EXECUTE; ?></a>                 
                    <a href ="javascript: removeup('<?php echo base64_encode($row[name]); ?>', '<?php echo $i; ?>');" class="upinfol"><?php echo $adminLanguage->A_DELETE; ?></a>                 
                <?php } ?>
                <div id="ajaxMessage<?php echo $i; ?>" style="display: none; background-color: #FFFFFF; border: 1px solid #AAAAAA; margin: 4px 0px 4px 0px; padding: 2px;"></div>
                </div>                
            </div>
        <?php 
            }
        } else {
        ?>
            <div id="upcontents" style="height: 100px;">
                <?php echo $upLang->INSELXVER.': <b>'.$updiag->iversion.'</b>'; ?><hr />
                <img src="tools/updiag/images/error.png" border="0" alt="<?php echo $adminLanguage->A_ERROR; ?>" />
                <font color="#FF0000"><b><?php echo $adminLanguage->A_ERROR; ?></b></font><br />
				<?php 
				if ($errormsg != '') {
					echo $errormsg;
				} else {
					echo $upLang->UNERROR;
                }
                ?>
            </div>
        <?php 
        }
    }


    /*************************/
    /* SHOW AVAILABLE HASHES */
    /*************************/
    static public function h_checkfs($rows=array()) {
        global $adminLanguage, $upLang, $updiag;

        HTML_updiag::importAjax();
?>
        <div id="ajaxMessage" style="display: none; background-color: #FFFFFF; border: 1px solid #AAAAAA; margin: 4px 0px 4px 0px; padding: 2px;"></div>
        &#149; <a href ="javascript: dohelp();"><b><?php echo $adminLanguage->A_HELP; ?></b></a> | 
        &#149; <a href="javascript:void(0);" onclick="javascript: document.getElementById('ajaxMessage').style.display='none';"><b><?php echo $upLang->HIDEHELP; ?></b></a>
<?php 
        $counter = count($rows);

        if (($rows) && ($counter>0)) {
            for($i=0; $i<$counter; $i++) {
                $row = $rows[$i];

                $link = '';
                $hashv = preg_split('/[\_]/', $row['name'], -1);
                if ($hashv[0] >= $updiag->iversion) {
                    $link = '<br /><a href="index2.php?option=com_admin&task=tools&tname=updiag&act=runhash&hash='.base64_encode($row['name']).'" ';
                    $link .= 'target="_self" class="upinfol">'.$upLang->EXECUTE.'</a>';
                }
        ?>
            <div id="upcontents">
                <?php echo ($i=='0') ? '<b>'.$upLang->FSCHECK.'</b><br />'.$upLang->INSELXVER.': <b>'.$updiag->iversion.'</b><hr />' : ''; ?>
                <div id="hd"><?php echo $row['name']; ?></div>
                <div class="upinfo"><?php echo $upLang->SIZE.': '.$row['size']; ?></div>
                <div class="upinfo">
                <?php 
                echo $adminLanguage->A_TYPE.': ';
                if (preg_match('/\_ext$/', $row['name'])) {
                    echo $upLang->EXTENDED;
                } elseif (preg_match('/\_full$/', $row['name'])) {
                    echo $upLang->FULL;
                } else {
                    echo $upLang->NORMAL;
                }
                ?>
                </div>
                <div class="upinfo"><?php echo $adminLanguage->A_DATE.': '.$row['date']; ?></div>
                <?php echo $link; ?>
                <a href ="javascript: removehash('<?php echo base64_encode($row[name]); ?>', '<?php echo $i; ?>');" class="upinfol"><?php echo $adminLanguage->A_DELETE; ?></a>                 
                <div id="ajaxMessage<?php echo $i; ?>" style="display: none; background-color: #FFFFFF; border: 1px solid #AAAAAA; margin: 4px 0px 4px 0px; padding: 2px;"></div>
            </div>
        <?php 
            }
        } else {
        ?>
            <div id="upcontents" style="height: 100px;">
                <?php echo '<b>'.$upLang->FSCHECK.'</b><br />'.$upLang->INSELXVER.': <b>'.$updiag->iversion.'</b>'; ?><hr />
                <img src="tools/updiag/images/error.png" border="0" alt="<?php echo $adminLanguage->A_ERROR; ?>" /> <br />
                <?php echo $upLang->NOHASHFOUND; ?>
            </div>
        <?php 
        }
    }


    static public function h_downloadHashes($rows=array(), $errormsg='') {
        global $adminLanguage, $upLang, $updiag;

        HTML_updiag::importAjax();
        $counter = count($rows);

        if (($rows) && ($counter>0)) {
            for($i=0; $i<$counter; $i++) {
                $row = $rows[$i];
                $instimg = ($row['installed']) ? 'tick.png' : 'publish_x.png';
        ?>
            <div id="upcontents">
                <?php echo ($i=='0') ? '<b>'.$upLang->DNHASHFLS.'</b><br />'.$upLang->INSELXVER.': <b>'.$updiag->iversion.'</b><hr />' : ''; ?>
                <div id="hd"><img src="images/<?php echo $instimg; ?>" border="0" /> <?php echo $row['name']; ?></div>
                <?php if (!$row['installed']) { ?>
                <div class="upinfo">                
                    <a href ="javascript: downhash('<?php echo base64_encode($row[name]); ?>', '<?php echo $i; ?>');" class="upinfol"><?php echo $upLang->DOWNLOAD; ?></a>
                    <div id="ajaxMessage<?php echo $i; ?>" style="display: none; background-color: #FFFFFF; border: 1px solid #AAAAAA; margin: 4px 0px 4px 0px; padding: 2px;"></div>
                </div>
                <?php } ?>
            </div>
        <?php 
            }
        } else {
        ?>
            <div id="upcontents" style="height: 100px;">
                <?php echo '<b>'.$upLang->DNHASHFLS.'</b><br />'.$upLang->INSELXVER.': <b>'.$updiag->iversion.'</b>'; ?><hr />
                <img src="tools/updiag/images/error.png" border="0" alt="<?php echo $adminLanguage->A_ERROR; ?>" />
                <font color="#FF0000"><b><?php echo $adminLanguage->A_ERROR; ?></b></font><br />
				<?php 
				if ($errormsg != '') {
					echo $errormsg;
				} else {
					echo $upLang->UNERROR;
                }
                ?>
            </div>
        <?php 
        }
    }


    /*********************/
    /* SHOW NEW RELEASES */
    /*********************/
    static public function h_releases($rows=array(), $errormsg='') {
        global $adminLanguage, $upLang, $updiag;

        $counter = count($rows);
        if (($rows) && ($counter>0)) {
            for($i=0; $i<$counter; $i++) {
                $row = $rows[$i];
        ?>
            <div id="upcontents">
                <div id="hd" dir="ltr"><?php echo $row['title']; ?>
				<?php 
				if ($row['type'] != '') {
					echo ' &nbsp; &nbsp; <small>['.$adminLanguage->A_TYPE.': '.$row['type'].']</small>';
				}
				?>
				</div>
				<div dir="ltr"><?php echo $row['description']; ?></div><br />
                <div class="upinfo"><?php 
                if ($row['date'] != '') {
                    if (!preg_match('/\:/', $row['date'])) { $row['date'] .= ' 00:00:00'; }
                }            
                echo '<b>'.$adminLanguage->A_DATE.':</b> ';
                echo ($row['date'] != '') ? mosFormatDate($row['date'], _GEM_DATE_FORMLC) : $adminLanguage->A_UNKNOWN;
                ?>
                </div>
                <?php if ($row['version'] != '') { ?>
                <div class="upinfo"><?php echo '<b>'.$adminLanguage->A_VERSION.':</b> '.$row['version']; ?></div>
                <?php } ?>
                <?php if ($row['license'] != '') { ?>
                <div class="upinfo"><?php echo '<b>'.$upLang->LICENSE.':</b> '.$row['license']; ?></div>
                <?php } ?>
                <?php if ($row['author'] != '') { ?>
                <div class="upinfo"><?php echo '<b>'.$adminLanguage->A_AUTHOR.':</b> '.$row['author']; ?></div>
                <?php } ?>
                <?php if ($row['price'] != '') { ?>
                <div class="upinfo"><?php echo '<b>'.$upLang->PRICE.':</b> '.$row['price']; ?></div>
                <?php } ?>
                <?php 
                if (($row['more'] != '') || ($row['link'] != '') || ($row['buy'] != '')) {
                    echo '<div class="upinfo">';
                    if ($row['more'] != '') {
                        echo '<a href="'.$row['more'].'" target="_blank" class="upinfol">'.$upLang->MORE.'...</a> &nbsp; ';
                    }
                    if ($row['link'] != '') {
                        echo '<a href="'.$row['link'].'" target="_blank" class="upinfol">'.$upLang->DOWNLOAD.'</a>';
                    }
                    if ($row['buy'] != '') {
                        echo '<a href="'.$row['buy'].'" target="_blank" class="upinfol">'.$upLang->BUY.'</a>';
                    }
                    echo "</div>\n";
                }
                ?>
            </div>
        <?php 
            }
        } else {
        ?>
            <div id="upcontents" style="height: 100px;">
                <?php echo $upLang->INSELXVER.': <b>'.$updiag->iversion.'</b>'; ?><hr />
                <img src="tools/updiag/images/error.png" border="0" alt="<?php echo $adminLanguage->A_ERROR; ?>" />
                <font color="#FF0000"><b><?php echo $adminLanguage->A_ERROR; ?></b></font><br />
                <?php 
				if ($errormsg != '') {
					echo $errormsg;
                } else {
                    echo $upLang->NONEWREL;
                }
                ?>
            </div>
        <?php 
        }
    }


	/***********************/
	/* SHOW UPDIAG CENTRAL */
	/***********************/
	static public function h_updiagCentral() {
		global $upLang, $fmanager;

        HTML_updiag::importAjax();
?>
        <div id="upcontents" style="height: 250px;">
            <div id="hd"><?php echo $upLang->UPDSPAG; ?></div>
            <?php echo $upLang->UPDWELC; ?><br /><br />
			<?php echo $upLang->STARTMORE; ?><br /><br />
			<div id="hd"><?php echo $upLang->BASCHECKS; ?></div>
			<div class="mini">
				<a href ="javascript: doelxisver();" title="Elxis"><img src="tools/updiag/images/elxis.jpg" alt="Elxis" /></a><br />Elxis CMS
			</div>
			<div class="mini">
				<a href ="javascript: dophp();" title="PHP"><img src="tools/updiag/images/php.jpg" alt="PHP" /></a><br />PHP
			</div>
			<div class="mini">
				<a href ="javascript: dodb();" title="ADOdb"><img src="tools/updiag/images/adodb.jpg" alt="ADOdb" /></a><br />ADOdb
			</div>
			<div class="mini">
			<?php if ($fmanager->iswin) { ?>
				<a href ="javascript: dosyst();" title="Windows"><img src="tools/updiag/images/windows.jpg" alt="Windows" /></a><br />Windows
			<?php } elseif ($fmanager->isuni) { ?>
				<a href ="javascript: dosyst();" title="Linux"><img src="tools/updiag/images/linux.jpg" alt="Linux" /></a><br />Linux
			<?php } elseif ($fmanager->ismac) { ?>
				<a href ="javascript: dosyst();" title="Macintosh"><img src="tools/updiag/images/mac.jpg" alt="mac" /></a><br />Macintosh
			<?php } ?>
			</div>
			<div class="mini">
				<a href ="javascript: dosec();" title="<?php echo $upLang->SECURITY; ?>"><img src="tools/updiag/images/security.jpg" alt="security" /></a><br /><?php echo $upLang->SECURITY; ?>
			</div>
			<div class="mini">
				<a href ="javascript: docredits();" title="<?php echo $upLang->CREDITS; ?>"><img src="tools/updiag/images/credits.jpg" alt="credits" /></a><br /><?php echo $upLang->CREDITS; ?>
			</div>
        </div>
		<div id="ajaxMessage" style="display: none; background-color: #FFFFFF; border: 1px solid #AAAAAA; margin: 4px 0px 4px 0px; padding: 2px;"></div>
<?php 
	}


    /*************/
    /* COPYRIGHT */
    /*************/
    static public function copyright() {
?>
        <br /><br /><div align="center">Created by <a href="mailto:datahell@elxis.org">Ioannis Sannos</a>.<br />
        Copyright &copy; 2006-2008 <a href="http://www.elxis.org" target="_blank" title="Elxis.org">Elxis.org</a>. All rights reserved.</div>
<?php 
    }

} //class end

?>