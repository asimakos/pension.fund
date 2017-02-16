<?php 
/** 
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Login
* @author: Elxis Team
* @email: info@elxis.org
* @link: http://www.elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class loginHTML {


    /*******************/
    /* HTML LOGIN PAGE */
    /*******************/
	static public function loginpage ( &$params, $image, $Itemidlp, $Itemidr ) {
		$return = intval($params->get( 'login' )) ? $params->get( 'login' ) : 'index.php';
		//$return = mosGetParam( $_SERVER, 'REQUEST_URI', null ); //---> TO  CHECK

		$random = rand(119, 995);
        if ( $params->get( 'page_title' ) ) {
            echo '<h1 class="componentheading'.$params->get('pageclass_sfx').'">'.$params->get( 'header_login' ).'</h1>'._LEND;
        }

        echo '<p>'.$image._LEND;
        if ( $params->get( 'description_login' ) ) {
            echo $params->get( 'description_login_text' )._LEND;
        }
        echo '</p><br />'._LEND;
?>

        <div class="clear"></div>
		<form action="<?php echo sefRelToAbs('index.php?option=login'); ?>" method="post" name="formlogin" id="formlogin">
        <div class="table<?php echo $params->get('pageclass_sfx'); ?>">
            <div class="tablerow">
                <div class="tablecell"><label for="username<?php echo $random; ?>"><?php echo _USERNAME; ?>:</label></div>
                <div class="tablecell">
                    <input type="text" name="username" id="username<?php echo $random; ?>" dir="ltr" title="<?php echo _USERNAME; ?>" value="" class="inputbox" size="20" maxlength="25" />
                </div>
            </div>
            <div class="tablerow">
                <div class="tablecell"><label for="passwd<?php echo $random; ?>"><?php echo _PASSWORD; ?>:</label></div>
                <div class="tablecell">
                    <input type="password" name="passwd" id="passwd<?php echo $random; ?>" dir="ltr" title="<?php echo _PASSWORD; ?>" value="" class="inputbox" size="20" maxlength="50" />
                </div>
            </div>
            <div class="tablerow">
                <div class="tablecell"><?php echo _REMEMBER_ME; ?>:</div>
                <div class="tablecell">
                    <input type="checkbox" name="remember" class="inputbox" title="<?php echo _REMEMBER_ME; ?>" value="yes" />
                </div>
            </div>
        </div>
        <div class="clear"></div>
		<div align="center">
			<input type="submit" name="submit" class="button<?php echo $params->get('pageclass_sfx'); ?>" value="<?php echo _BUTTON_LOGIN; ?>" title="<?php echo _BUTTON_LOGIN; ?>" />
		</div>
		<input type="hidden" name="op2" value="login" />
		<input type="hidden" name="return" value="<?php echo sefRelToAbs($return, 'logout.html'); ?>" />
		<input type="hidden" name="message" value="<?php echo $params->get( 'login_message' ); ?>" />
		</form>

        <br /><br />
		<a href="<?php echo sefRelToAbs( 'index.php?option=com_registration&task=lostPassword&Itemid='.$Itemidlp, 'registration/lost-password.html' ); ?>" title="<?php echo _LOST_PASSWORD; ?>">
            <?php echo _E_LOSTPASS; ?>
		</a><br />
		<?php 
		if ( $params->get( 'registration' ) ) {
		?>
		<br />
		<?php echo _NO_ACCOUNT; ?> 
		<a href="<?php echo sefRelToAbs( 'index.php?option=com_registration&task=register&Itemid='.$Itemidr, 'registration/register.html' ); ?>" title="<?php echo _E_REGISTRATION; ?>">
			<?php echo _CREATE_ACCOUNT; ?>
		</a><br />
		<?php 
		}

		mosHTML::BackButton( $params );
		?>
        <noscript><?php echo _CMN_JAVASCRIPT; ?></noscript>
		<?php 
  	}


    /********************/
    /* HTML LOGOUT PAGE */
    /********************/
	static public function logoutpage( &$params, $image ) {
		$return = intval($params->get( 'logout' )) ? $params->get( 'logout' ) : 'index.php';
        if ( $params->get( 'page_title' ) ) {
            echo '<h1 class="componentheading'.$params->get('pageclass_sfx').'">'.$params->get( 'header_logout' ).'</h1>'._LEND;
        }

        echo '<p>'.$image._LEND;
        if ( $params->get('description_logout') ) {
            echo $params->get('description_logout_text')._LEND;
        }
        echo '</p><br />'._LEND;
		?>

		<form action="<?php echo sefRelToAbs('index.php?option=logout'); ?>" method="post" name="formlogout" id="formlogout">
			<div align="center">
			    <input type="submit" name="Submit" class="button<?php echo $params->get('pageclass_sfx'); ?>" value="<?php echo _BUTTON_LOGOUT; ?>" title="<?php echo _BUTTON_LOGOUT; ?>" />
			</div>
            <input type="hidden" name="op2" value="logout" />
            <input type="hidden" name="return" value="<?php echo sefRelToAbs( $return, 'login.html' ); ?>" />
            <input type="hidden" name="message" value="<?php echo $params->get( 'logout_message' ); ?>" />
		</form><br />

<?php 
        mosHTML::BackButton( $params );
	}
}

?>