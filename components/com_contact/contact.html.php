<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Contact
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class HTML_contact {


	/*******************************/
	/* HTML CONTACTS CATEGORY LIST */
	/*******************************/
	static public function displaylist( &$categories, &$rows, $catid, $currentcat=NULL, &$params ) {
		global $Itemid, $hide_js;

		if ( $params->get( 'page_title' ) ) {
			echo '<h1 class="componentheading'.$params->get( 'pageclass_sfx' ).'">'.$currentcat->header.'</h1>'._LEND;
		}

		echo '<div class="contactscats'.$params->get( 'pageclass_sfx' ).'">'._LEND;
        echo '<p>';
		if ( $currentcat->img != '') {
			echo '<img src="'.$currentcat->img.'" align="'.$currentcat->align.'" hspace="6" alt="'._WEBLINKS_TITLE.'" title="'._WEBLINKS_TITLE.'" />';
		}
		echo $currentcat->descrip;
		echo '</p>'._LEND;

		if (count( $rows )) {
			$seocat = $currentcat->seotitle;
			HTML_contact::showTable( $params, $rows, $catid, $seocat );
		}		

		//Displays listing of Categories
		if (( $params->get( 'type' ) == 'category' ) && $params->get( 'other_cat' )) {
			HTML_contact::showCategories( $params, $categories, $catid );
		} else if (( $params->get( 'type' ) == 'section' ) && $params->get( 'other_cat_section' )) {
			HTML_contact::showCategories( $params, $categories, $catid );
		}		

		echo '</div>'._LEND;

		mosHTML::BackButton( $params, $hide_js );
	}


	/****************************/
	/* DISPLAY LIST OF CONTACTS */
	/****************************/
	static private function showTable( &$params, &$rows, $catid, $seocat) {
		global $Itemid;

		$showhead = $params->get( 'headings');
		$span1 = (_GEM_RTL) ? '<span dir="rtl">': '';
		$span2 = (_GEM_RTL) ? '</span>' : '';
		foreach ($rows as $row) {
			$link = 'index.php?option=com_contact&task=view&contact_id='. $row->id .'&Itemid='. $Itemid;
			$seoLink = (($row->seotitle != '') && ($seocat != '')) ? 'contact/'.$seocat.'/'.$row->seotitle.'.html' : '';

			echo '<h3 class="contactitem'.$params->get( 'pageclass_sfx' ).'">'.$row->name.'</h3>'._LEND;
			echo '<ul class="table'.$params->get( 'pageclass_sfx' ).'">'._LEND;
			echo ($showhead) ? '<li><strong>'._CMN_NAME.':</strong> ' : '<li>';
			echo $span1.'<a href="'.sefRelToAbs( $link, $seoLink ).'" title="'._CONTACT_TITLE.' '.$row->name.'">'.$row->name.'</a>'.$span2.'</li> '._LEND;

			if ($params->get( 'position' ) && ($row->con_position != '')) {
                echo ($showhead) ? '<li><strong>'._CONTACT_POSITION.':</strong> ' : '<li>';
				echo $span1.$row->con_position.$span2.'</li>'._LEND;
			}
			if ( $params->get( 'email' ) ) {
				if ( $row->email_to ) {
					$row->email_to = mosHTML::emailCloaking( $row->email_to, 1 );
				}
				echo ($showhead) ? '<li><strong>'._CMN_EMAIL.':</strong> ' : '<li>';
				echo $span1.$row->email_to.$span2.'</li>'._LEND;
			}
			if ($params->get( 'telephone' ) && ($row->telephone != '')) {
				echo ($showhead) ? '<li><strong>'._CONTACT_TELEPHONE.':</strong> ' : '<li>';
				echo $span1.$row->telephone.$span2.'</li>'._LEND;
			}
			if ($params->get( 'fax' ) && ($row->fax != '')) {
				echo ($showhead) ? '<li><strong>'._CONTACT_FAX.':</strong> ' : '<li>';
				echo $span1.$row->fax.$span2.'</li>'._LEND;
			}
			echo '</ul>'._LEND;
			echo '<div class="clear"></div><br />'._LEND;
		}
	}


	/*******************************/
	/* DISPLAY LINKS TO CATEGORIES */
	/*******************************/
	static private function showCategories( &$params, &$categories, $catid ) {
		global $Itemid;

		$rtl = (_GEM_RTL) ? ' dir="rtl"' : '';
		if ($categories) {
			echo '<ul>'._LEND;
			foreach ( $categories as $cat ) {
				echo '<li>'._LEND;
				if ( $catid == $cat->catid ) {
					echo '<strong>'.$cat->title.'</strong> <span class="small"'.$rtl.'>('.$cat->numlinks.')</span>'._LEND;
				} else {
					$link = 'index.php?option=com_contact&catid='.$cat->catid.'&Itemid='.$Itemid;
					$seoLink = ($cat->seotitle != '') ? 'contact/'.$cat->seotitle.'/' : '';

					echo '<a href="'.sefRelToAbs($link, $seoLink).'" title="'.$cat->title.'">'.$cat->title.'</a>'._LEND;
					if ( $params->get( 'cat_items' ) ) {
						echo ' <span class="small'.$params->get( 'pageclass_sfx' ).'"'.$rtl.'>('.$cat->numlinks.')</span>'._LEND;
					}
					if ( $params->get( 'cat_description' ) ) {
						echo '<br />'.$cat->description._LEND;
					}
				}
				echo '</li>'._LEND;
			}
			echo '</ul>'._LEND;
		}
	}


    /*******************************/
    /* HTML DISPLAY SINGLE CONTACT */
    /*******************************/
	static public function viewcontact( &$contact, &$params, $count, &$menu_params ) {
		global $mainframe, $Itemid;

		$template = $mainframe->getTemplate();
		$sitename = $mainframe->getCfg( 'sitename' );
		$hide_js = intval(mosGetParam($_REQUEST,'hide_js', 0 ));
		?>
		<script type="text/javascript">
		<!--
		function validate(){
			if ( ( document.emailform.text.value == "" ) || ( document.emailform.email.value.search("@") == -1 ) || ( document.emailform.email.value.search("[.*]" ) == -1 ) <?php if ($mainframe->getCfg('captcha')) { ?>|| ( document.emailform.code.value == "" )<?php } ?> ) {
				alert( "<?php echo _CONTACT_FORM_NC; ?>" );
			} else {
			document.emailform.action = "<?php echo str_replace('&amp;', '&', sefRelToAbs('index.php?option=com_contact&Itemid='.$Itemid, 'contact/sendmail.html')); ?>";
			document.emailform.submit();
			}
		}

        function captchaPlayer() {
            window.open('<?php echo $mainframe->getCfg('live_site'); ?>/includes/captcha/listen.php','','width=200,height=100,top=250,left=450,toolbar=no,location=no,resizable=no,menubar=no');
        }
		//-->
		</script>
		<?php 
		//For the pop window opened for print preview
		if ( $params->get( 'popup' ) ) {
			$mainframe->setPageTitle( $contact->name );
		}
		if ( $menu_params->get( 'page_title' ) ) {
            echo '<h1 class="componentheading'.$params->get( 'pageclass_sfx' ).'">'.$menu_params->get( 'header' ).'</h1>'._LEND;
		}

		//displays Page Title
		HTML_contact::_writePageTitle( $params );
		//displays Contact Select list
		HTML_contact::_writeSelectContact( $contact, $params, $count );
        //displays business card
        HTML_contact::_writeBusinessCard( $contact, $params, $hide_js );
		//displays Email Form
		HTML_contact::_writeEmailForm( $contact, $params );
		//display Close button in pop-up window
		mosHTML::CloseButton( $params, $hide_js );
		//displays back button
		mosHTML::BackButton( $params, $hide_js );
	}


    /***********************/
    /* WRITE BUSINESS CARD */
    /***********************/
    static private function _writeBusinessCard(&$contact, &$params, $hide_js) {
        global $mainframe, $Itemid;

		$align = (_GEM_RTL) ? 'left': 'right';
?>      
        <div class="business-card" id="business-card">
            <?php 
            if ($contact->image && $params->get( 'image' )) {
                echo '<img src="'.$mainframe->getCfg('ssl_live_site').'/images/stories/'.$contact->image.'" align="'.$align.'" alt="'._CONTACT_TITLE.'" title="'._CONTACT_TITLE.'" class="card" />'._LEND;
            }
            ?>

            <dl class="card-info">
                <?php 
                if ( $contact->name && $params->get( 'name' ) ) {
                    echo '<dt>'.$contact->name.'</dt>'._LEND;
			    }
                if ( $contact->con_position && $params->get( 'position' ) ) {
                    echo '<dd style="font-weight: bold;">'.$contact->con_position.'</dd>'._LEND;
                }

                if (($params->get( 'address_check' ) > 0) || $contact->address || $contact->suburb) {
                    $x = '';
                    echo '<dd>';
                    if ($params->get( 'address_check' ) > 0) {
                        echo $params->get('marker_address').' ';
                    }
                    if ( $contact->address && $params->get( 'street_address' ) ) {
                        echo $contact->address;
                        $x = ', ';
                    }
                    if ( $contact->suburb && $params->get( 'suburb' ) ) {
                        echo $x.$contact->suburb;
                    }
                    echo '</dd>'._LEND;
                }

                if ($contact->state || $contact->country || $contact->postcode) {
                    $x = '';
                    echo '<dd>';
                    if ( $contact->state && $params->get( 'state' ) ) {
                        echo $contact->state;
                        $x = ', ';
                    }
                    if ( $contact->country && $params->get( 'country' ) ) {
                        echo $x.$contact->country;
                        $x = ', ';
                    }
                    if ( $contact->postcode && $params->get( 'postcode' ) ) {
                        echo $x.$contact->postcode;
                    }                
                    echo '</dd>'._LEND;
                }
                echo '<dd>&nbsp;</dd>'._LEND;
                if ( $contact->email_to && $params->get( 'email' ) ) {
				    echo '<dd>'.$params->get( 'marker_email' ).' '.$contact->email.'</dd>'._LEND;
                }
                if ( $contact->telephone && $params->get( 'telephone' ) ) {
                    echo '<dd>'.$params->get( 'marker_telephone' ).' '.$contact->telephone.'</dd>'._LEND;
                }
                if ( $contact->fax && $params->get( 'fax' ) ) {
                    echo '<dd>'.$params->get( 'marker_fax' ).' '.$contact->fax.'</dd>'._LEND;
                }

                if ( $contact->misc && $params->get( 'misc' ) ) {
                    echo '<dd>'.$params->get( 'marker_misc' ).' '.$contact->misc.'</dd>'._LEND;
                }

                if ( $params->get( 'vcard' ) ) {
                    echo '<dd><br />'._CONTACT_DOWNLOAD_AS.' ';
                    echo '<a href="'.$mainframe->getCfg('live_site').'/index2.php?option=com_contact&amp;task=vcard&amp;contact_id='.$contact->id.'&amp;no_html=1" title="'._VCARD.'" >';
                    echo _VCARD.'</a></dd>'._LEND;
                }
                ?>
		    </dl>

<?php 
		$print_link = $mainframe->getCfg('live_site').'/index2.php?option=com_contact&amp;task=view&amp;contact_id='.$contact->id.'&amp;Itemid='.$Itemid.'&amp;pop=1';
		echo '<div align="'.$align.'">';
		mosHTML::PrintIcon( $contact, $params, $hide_js, $print_link );
		echo '</div>'._LEND;
?>
        </div>
        <div class="clear"></div>
<?php 
    }


	/*********************/
	/* WRITES PAGE TITLE */
	/*********************/
	static private function _writePageTitle( &$params ) {
		if ( $params->get( 'page_title' )  && !$params->get( 'popup' ) ) {
			echo '<h2>'.$params->get( 'header' ).'</h2>'._LEND;
		}
	}


	/*****************************/
	/* SELECT OTHER CONTACT LIST */
	/*****************************/
	static private function _writeSelectContact( &$contact, &$params, $count ) {
		global $mainframe;

		if (($count > 1)  && !$params->get('popup') && $params->get('drop_down')) {
	?>
		<div align="<?php echo (_GEM_RTL) ? 'left' : 'right'; ?>">
		    <?php echo _CONTACT_SEL; ?> 
			<a href="javascript:void(0);" onclick="hideLayer('selectcontact');" title="<?php echo _CMN_SHOW.'/'._CMN_HIDE; ?>">
				<img src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/images/M_images/arrow_down.png" alt="<?php echo _CMN_SHOW.'/'._CMN_HIDE; ?>" title="<?php echo _CMN_SHOW.'/'._CMN_HIDE; ?>" border="0" align="bottom" />
			</a>
			<div id="selectcontact" style="text-align: <?php echo (_GEM_RTL) ? 'left' : 'right'; ?>; clear: both; display:none; padding: 5px;">
				<?php echo $contact->select; ?>
			</div>
		</div>
	<?php 
		}
	}


	/***************/
	/* E-MAIL FORM */
	/***************/
	static private function _writeEmailForm( &$contact, &$params ) {
        global $mainframe, $Itemid;

		if ( $contact->email_to && !$params->get( 'popup' ) && $params->get( 'email_form' ) ) {
			echo '<p>'.$params->get( 'email_description' ).'</p>'._LEND;
			$random = rand(104, 996);
			$rtl = (_GEM_RTL) ? ' dir="rtl"' : '';
?>
            <form action="index.php" method="post" name="emailform" target="_top" id="emailform">
				<div class="contact_email<?php echo $params->get( 'pageclass_sfx' ); ?>">
					<label for="name<?php echo $random; ?>"<?php echo $rtl; ?>><?php echo _NAME_PROMPT; ?>:</label><br />
					<input type="text" name="name" id="name<?php echo $random; ?>" size="30" maxlength="80" class="inputbox" value="" title="<?php echo _CMN_NAME; ?>" />
					<br />
					<label for="email<?php echo $random; ?>"<?php echo $rtl; ?>><?php echo _EMAIL_PROMPT; ?>:</label><br />
					<input type="text" name="email" id="email<?php echo $random; ?>" dir="ltr" size="30" maxlength="80" class="inputbox" value="" title="<?php echo _CMN_EMAIL; ?>" />
					<br />
					<label for="subject<?php echo $random; ?>"<?php echo $rtl; ?>><?php echo _SUBJECT_PROMPT; ?>:</label><br />
					<input type="text" name="subject" id="subject<?php echo $random; ?>" size="30" maxlength="120" class="inputbox" value="" title="<?php echo _E_SUBJECT; ?>" />
					<br /><br />
					<label for="text<?php echo $random; ?>"<?php echo $rtl; ?>><?php echo _MESSAGE_PROMPT; ?>:</label><br />
					<textarea cols="40" rows="6" name="text" id="text<?php echo $random; ?>" class="text_area" title="text"></textarea>
					<?php
					if ( $params->get( 'email_copy' ) ) {
					   echo '<br /><input type="checkbox" name="email_copy" id="email_copy'.$random.'" value="1" title="email copy" /> <label for="email_copy'.$random.'">'._EMAIL_A_COPY.'</label>'; 
					}
					?>
					<br /><br />
					<?php if ($mainframe->getCfg('captcha')) { ?>
					<span<?php echo (_GEM_RTL) ? ' dir="rtl"' : ''; ?>>
					<?php echo _E_SECCODE; ?>: <img src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/includes/captcha/captcha.img.php" alt="<?php echo _E_SPELL; ?>" border="0" />
                    <a href="javascript:captchaPlayer('<?php echo $_SESSION['captchasnd']; ?>');" title="<?php echo _E_SPELL; ?>"><img src="<?php echo $mainframe->getCfg('ssl_live_site'); ?>/includes/captcha/speaker.gif" alt="<?php echo _E_SPELL; ?>" border="0" /></a>
                    </span>
					<br />
					<label for="code<?php echo $random; ?>"<?php echo $rtl; ?>>
					<?php echo _E_TYPE_SECCODE; ?>:</label> 
					<input type="text" name="code" id="code<?php echo $random; ?>" dir="ltr" value="" size="10" maxlength="10" title="<?php echo _E_SECCODE; ?>" />
					
					<br /><br />
					<?php } ?>
					<input type="button" name="send" value="<?php echo _SEND_BUTTON; ?>" class="button" onclick="validate()" title="<?php echo _SEND_BUTTON; ?>" />
				</div>
				<input type="hidden" name="option" value="com_contact" />
				<input type="hidden" name="con_id" value="<?php echo $contact->id; ?>" />
				<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
				<input type="hidden" name="op" value="sendmail" />
			</form>
		<?php 
		}
	}


    /******************************/
    /* DISPLAY NO CONTACT MESSAGE */
    /******************************/
	static public function nocontact( &$params ) {
?>
		<h1 class="componentheading<?php echo $params->get( 'pageclass_sfx' ); ?>"><?php echo _CONTACT_TITLE; ?></h1>
		<p><?php echo _CONTACT_NONE; ?></p>
<?php 
		mosHTML::BackButton($params);
	}
}
?>