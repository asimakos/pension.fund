<?php 
/**
* @ Version: $Id: mod_search.php 1878 2008-01-25 21:26:29Z datahell $
* @ Copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @ Package: Elxis
* @ Subpackage: Module Search
* @ URL: http://www.elxis.org
* @ E-mail: info@elxis.org
* @ License: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


$button			= $params->get( 'button', '' );
$button_pos		= $params->get( 'button_pos', 'left' );
$button_text	= $params->get( 'button_text', _E_SEARCH );
$width 			= intval( $params->get( 'width', 20 ) );
$text 			= $params->get( 'text', eUTF::utf8_strtolower( _E_SEARCH ).'...' );
$moduleclass_sfx 	= $params->get( 'moduleclass_sfx' );

$output = '<input type="text" name="searchword" title="'._E_SEARCH_KEYWORD.'" class="inputbox'.$moduleclass_sfx.'" ';
$output .= 'size="'.$width.'" value="'.$text.'" onblur="if(this.value==\'\') this.value=\''. $text .'\';" ';
$output .= 'onfocus="if(this.value==\''. $text .'\') this.value=\'\';" /> ';

if ( $button ) {
	$button = '<input type="submit" name="searchbutton" title="'._E_SEARCH.'" value="'.$button_text.'" class="button'.$moduleclass_sfx.'" />';
}

switch ( $button_pos ) {
	case 'top':
		$button = $button.'<br />';
		$output = $button.$output;
	break;
	case 'bottom':
		$button =  '<br />'.$button;
		$output = $output.$button;
	break;
	case 'right':
		$output = $output.$button;
	break;
	case 'left':
	default:
		$output = $button.$output;
	break;
}
?>

<form name="searchmodule" action="<?php echo sefRelToAbs('index.php', 'search.html'); ?>" method="post">
<div class="search<?php echo $moduleclass_sfx; ?>">	
    <?php echo $output; ?>
</div>
<input type="hidden" name="option" value="search" />
<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
</form>