<?php 
/**
* @version: $Id$
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component Contact
* @link: http://www.elxis.org
* @email: info@elxis.org
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


if (($mainframe->getCfg('access') == '1') | ($mainframe->getCfg('access') == '3')) {
	//if is a guest find public frontend group name
	if ( $my->usertype == '' ) { 
		$usertype = eUTF::utf8_strtolower($acl->get_group_name('29'));
	} else {
		$usertype = eUTF::utf8_strtolower($my->usertype);
	}
	// ensure user is allowed to view this component
	if (!($acl->acl_check( 'action', 'view', 'users', $usertype, 'components', 'all' ) || 
		$acl->acl_check( 'action', 'view', 'users', $usertype, 'components', 'com_contact' ))) {
		mosRedirect( 'index.php', _NOT_AUTH );
		exit();
	}
}

// load the html drawing class
require_once($mainframe->getPath('front_html'));
require_once($mainframe->getPath('class'));

$mainframe->setPageTitle( _CONTACT_TITLE );

//Load Vars
$contact_id = intval( mosGetParam( $_REQUEST ,'contact_id', 0 ) );
$catid = intval( mosGetParam( $_REQUEST ,'catid', 0 ) );
$op = mosGetParam( $_POST, 'op', '' );

if ($op == 'sendmail') {
	sendmail();
} else {
	switch( $task ) {
		case 'view':
			contactpage( $contact_id );
		break;
		case 'vcard':
			vCard( $contact_id );
		break;
		default:
			listContacts( $catid );
		break;
	}
}


/**************************************/
/* PREPARE TO LIST CONTACT CATEGORIES */
/**************************************/
function listContacts( $catid ) {
	global $mainframe, $database, $my, $Itemid, $lang;

    //get all categories
	$query = "SELECT c.*, c.id AS catid FROM #__categories c WHERE c.published='1' AND c.section='com_contact_details'"
    ."\n AND ((c.language IS NULL) OR (c.language LIKE '%".$lang."%'))"
    ."\n AND c.access IN (".$my->allowed.")"
	."\n ORDER BY c.ordering";
	$database->setQuery( $query );
	$categories = $database->loadObjectList();

    //count contact details and validate catid (current category)
    $catid_i = -1;
    $count = count( $categories );
    for ($i=0; $i<$count; $i++) {
        $category = &$categories[$i];

        if ($category->id == $catid) { $catid_i = $i; }
        $database->setQuery("SELECT COUNT(id) FROM #__contact_details WHERE published='1' AND catid='$category->id' AND access IN (".$my->allowed.")");
        $category->numlinks = intval($database->loadResult());
    }

    if ($catid_i < 0) { $catid = 0; } //reset invalid category

	//try to fix wrong Itemid
	if ($catid) {
    	$query = "SELECT id FROM #__menu"
    	."\n WHERE link='index.php?option=com_contact&catid=".$catid."' AND published='1'"
		."\n AND ((language IS NULL) OR (language LIKE '%".$lang."%'))"
    	."\n AND access IN (".$my->allowed.")";
    	$database->setQuery($query, '#__', 1, 0);
    	$_Itemid = intval($database->loadResult());
    	if ($_Itemid && ($_Itemid != $Itemid)) { $Itemid = $_Itemid; $GLOBALS['Itemid'] = $_Itemid; }
	} else {
    	$query = "SELECT id FROM #__menu"
    	."\n WHERE link='index.php?option=com_contact' AND published='1'"
		."\n AND ((language IS NULL) OR (language LIKE '%$lang%'))"
    	."\n AND access IN (".$my->allowed.")";
    	$database->setQuery($query, '#__', 1, 0);
    	$_Itemid = intval($database->loadResult());
    	if ($_Itemid && ($_Itemid != $Itemid)) { $Itemid = $_Itemid; $GLOBALS['Itemid'] = $_Itemid; }
	}

	if ($catid) {
		//url links info for category
		$query = "SELECT * FROM #__contact_details"
		."\n WHERE catid = '". $catid."' AND published='1' AND access IN (".$my->allowed.")"
		."\n ORDER BY ordering";
		$database->setQuery( $query );
		$rows = $database->loadObjectList();

		$currentcat = $categories[$catid_i]; //current category info
	} else {
		$rows = array();
		$currentcat = new stdClass();
	}

	//Parameters
	$menu = new mosMenu( $database );
	$menu->load( $Itemid );
	$params = new mosParameters( $menu->params );

	$params->def( 'page_title', 1 );
	$params->def( 'header', $menu->name );
	$params->def( 'pageclass_sfx', '' );
	$params->def( 'headings', 1 );
	$params->def( 'back_button', $mainframe->getCfg( 'back_button' ) );
	$params->def( 'description_text', _CONTACTS_DESC );
	$params->def( 'image', -1 );
	$params->def( 'image_align', 'right' );
	$params->def( 'other_cat_section', 1 );
	//Category List Display control
	$params->def( 'other_cat', 1 );
	$params->def( 'cat_description', 1 );
	$params->def( 'cat_items', 1 );
	//Table Display control
	$params->def( 'headings', 1 );
	$params->def( 'position', '1' );
	$params->def( 'email', '0' );
	$params->def( 'phone', '1' );
	$params->def( 'fax', '1' );
	$params->def( 'telephone', '1' );

	if ( $catid ) {
		$params->set( 'type', 'category' );
	} else {
		$params->set( 'type', 'section' );
	}

	//page description
	$currentcat->descrip = '';
	if (isset($currentcat->description) && ($currentcat->description != '')) {
		$currentcat->descrip = $currentcat->description;
	} else if ( !$catid ) {
		//show description
		if ( $params->get( 'description' ) ) {
			$currentcat->descrip = $params->get( 'description_text' );
		}
	}

	//page image
	$currentcat->img = '';
	$path = $mainframe->getCfg('ssl_live_site').'/images/stories/';
	if (isset($currentcat->image) && ($currentcat->image != '')) {
		$currentcat->img = $path.$currentcat->image;
		$currentcat->align = $currentcat->image_position;
	} else if ( !$catid ) {
		if (($params->get( 'image' ) != -1 ) && is_file($path.$params->get('image'))) {
			$currentcat->img = $path.$params->get( 'image' );
			$currentcat->align = $params->get( 'image_align' );
		}
	}

	//page header
	$currentcat->header = '';
	if ( isset($currentcat->name) && ($currentcat->name != '') ) {
		$currentcat->header = $params->get( 'header' ) .' - '. $currentcat->name;
	} else {
		$currentcat->header = $params->get( 'header' );
	}

    $metaDesc = $currentcat->header;
    $metaKeys = array();
    $metaKeys[] = _CONTACT_TITLE;
    if ($lang != 'english') { $metaKeys[] = 'contact'; }

    if ($rows) {
    	foreach ($rows as $row) {
    		$metaDesc .= ', '.$row->name;
    		$metaKeys[] = $row->name;
    	}
    }
    $metaKeys[] = 'e-mail';
    $metaKeys[] = _CONTACT_TELEPHONE;
    $metaKeys[] = _CONTACT_FAX;
    $metaKeys[] = _CONTACT_POSITION;
    $metaKeys[] = _CONTACT_ADDRESS;

    $metaDesc .= ', '.$mainframe->getCfg('sitename');
    $mainframe->setPageTitle($currentcat->header);
    $mainframe->setMetaTag('description', $metaDesc);
    $mainframe->setMetaTag('keywords', implode(', ',$metaKeys));

	HTML_contact::displaylist( $categories, $rows, $catid, $currentcat, $params );
}


/***********************************/
/* PREPARE TO DISPLAY CONTACT PAGE */
/***********************************/
function contactpage( $contact_id ) {
	global $mainframe, $database, $my, $Itemid, $lang;

	$query = "SELECT a.id, a.name, a.con_position"
	. "\n FROM #__contact_details a"
	. "\n LEFT JOIN #__categories cc ON cc.id = a.catid"
	. "\n WHERE a.published = '1'"
	. "\n AND cc.published = '1'"
    . "\n AND a.access IN (".$my->allowed.")"
    . "\n AND cc.access IN (".$my->allowed.")"
	. "\n ORDER BY a.default_con DESC, a.ordering ASC";
	$database->setQuery( $query );
	$list = $database->loadObjectList();
	$count = count( $list );

	if ( $count ) {
		if ( !$contact_id) { $contact_id = $list[0]->id; }

		$query = "SELECT * FROM #__contact_details WHERE published = '1' AND id = '$contact_id' AND access IN (".$my->allowed.")";
		$database->setQuery($query, '#__', 1, 0);
		$database->loadObject($contact);

		if (!$contact){
            elxError(_CONTACT_NOFOUND, 1);
			return;
		}

		if ($list) {
			$clist = '';
			foreach ($list as $ls) {
				$text = ($ls->con_position != '') ? $ls->name.' - '.$ls->con_position : $ls->name;
				$clist .= '<a href="'.sefRelToAbs('index.php?option=com_contact&task=view&contact_id='.$ls->id.'&Itemid='.$Itemid).'" ';
				$clist .= 'title="'.$text.'">';
				$clist .= ($contact_id == $ls->id) ? '<strong>'.$text.'</strong>' : $text;
				$clist .= '</a><br />'._LEND;
			}
			$contact->select = $clist;
		}

		//Adds parameter handling
		$params = new mosParameters( $contact->params );

		$params->set( 'page_title', 0 );
		$params->def( 'pageclass_sfx', '' );
		$params->def( 'back_button', $mainframe->getCfg( 'back_button' ) );
		$params->def( 'print', !$mainframe->getCfg( 'hidePrint' ) );
		$params->def( 'name', '1' );
		$params->def( 'email', '0' );
		$params->def( 'street_address', '1' );
		$params->def( 'suburb', '1' );
		$params->def( 'state', '1' );
		$params->def( 'country', '1' );
		$params->def( 'postcode', '1' );
		$params->def( 'telephone', '1' );
		$params->def( 'fax', '1' );
		$params->def( 'misc', '1' );
		$params->def( 'image', '1' );
		$params->def( 'email_description', '1' );
		$params->def( 'email_description_text', _EMAIL_DESCRIPTION );
		$params->def( 'email_form', '1' );
		$params->def( 'email_copy', '1' );
		// global print|pdf|email
		$params->def( 'icons', $mainframe->getCfg( 'icons' ) );
		// contact only icons
		$params->def( 'contact_icons', 0 );
		$params->def( 'icon_address', '' );
		$params->def( 'icon_email', '' );
		$params->def( 'icon_telephone', '' );
		$params->def( 'icon_fax', '' );
		$params->def( 'icon_misc', '' );
		$params->def( 'drop_down', '0' );
		$params->def( 'vcard', '1' );

		if ( $contact->email_to && $params->get( 'email' )) {
			// email cloacking
			$contact->email = mosHTML::emailCloaking( $contact->email_to );
		}

		// loads current template for the pop-up window
		$pop = mosGetParam( $_REQUEST, 'pop', 0 );
		if ( $pop ) {
			$params->set( 'popup', 1 );
			$params->set( 'back_button', 0 );
		}

		if ( $params->get( 'email_description' ) ) {
			$params->set( 'email_description', $params->get( 'email_description_text' ) );
		} else {
			$params->set( 'email_description', '' );
		}

		// needed to control the display of the Address marker
		$temp = $params->get( 'street_address' )
		. $params->get( 'suburb' )
		. $params->get( 'state' )
		. $params->get( 'country' )
		. $params->get( 'postcode' )
		;
		$params->set( 'address_check', $temp );

		// determines whether to use Text, Images or nothing to highlight the different info groups
		switch ( $params->get( 'contact_icons' )) {
			case 1:
			// text
				$params->set( 'marker_address', _CONTACT_ADDRESS.': ' );
				$params->set( 'marker_email', _CMN_EMAIL.': ' );
				$params->set( 'marker_telephone', _CONTACT_TELEPHONE.': ' );
				$params->set( 'marker_fax', _CONTACT_FAX.': ' );
				$params->set( 'marker_misc', _CONTACT_MISC.': ' );
				$params->set( 'column_width', '100px' );
				break;
			case 2:
			// none
				$params->set( 'marker_address', '' );
				$params->set( 'marker_email', '' );
				$params->set( 'marker_telephone', '' );
				$params->set( 'marker_fax', '' );
				$params->set( 'marker_misc', '' );
				$params->set( 'column_width', '0px' );
				break;
			default:
			// icons
				$image1 = mosAdminMenus::ImageCheck( 'con_address.png', '/images/M_images/', $params->get( 'icon_address' ), '/images/M_images/', _CONTACT_ADDRESS );
				$image2 = mosAdminMenus::ImageCheck( 'emailButton.png', '/images/M_images/', $params->get( 'icon_email' ), '/images/M_images/', 'e-mail' );
				$image3 = mosAdminMenus::ImageCheck( 'con_tel.png', '/images/M_images/', $params->get( 'icon_telephone' ), '/images/M_images/', _CONTACT_TELEPHONE );
				$image4 = mosAdminMenus::ImageCheck( 'con_fax.png', '/images/M_images/', $params->get( 'icon_fax' ) , '/images/M_images/', _CONTACT_FAX);
				$image5 = mosAdminMenus::ImageCheck( 'con_info.png', '/images/M_images/', $params->get( 'icon_misc' ), '/images/M_images/', 'misc' );
				$params->set( 'marker_address', $image1 );
				$params->set( 'marker_email', $image2 );
				$params->set( 'marker_telephone', $image3 );
				$params->set( 'marker_fax', $image4 );
				$params->set( 'marker_misc', $image5 );
				$params->set( 'column_width', '40px' );
				break;
		}

		//params from menu item
		$menu = new mosMenu( $database );
		$menu->load( $Itemid );	
		$menu_params = new mosParameters( $menu->params );		

		$menu_params->def( 'page_title', 1 );
		$menu_params->def( 'header', $menu->name );
		$menu_params->def( 'pageclass_sfx', '' );

        $metaDesc = $contact->name.', '.$menu_params->get('header').', '.$mainframe->getCfg('sitename');
        $metaKeys = explode(' ',$contact->name);
        $metaKeys[] = _CONTACT_TITLE;
        if ($contact->con_position != '') {
            $metaKeys[] = $contact->con_position;
        }
        if ($lang != 'english') { $metaKeys[] = 'contact'; }

        $mainframe->setPageTitle($contact->name.' - '._CONTACT_TITLE);
        $mainframe->setMetaTag('description', $metaDesc);
        $mainframe->setMetaTag('keywords', implode(', ',$metaKeys));

		HTML_contact::viewcontact( $contact, $params, $count, $menu_params );
	} else {
	    $params = new mosParameters( $contact->params );
		$params->def( 'back_button', $mainframe->getCfg( 'back_button' ) );
		HTML_contact::nocontact( $params );
	}
}


function getEncString($string='') {
	global $mosConfig_secret;
	$enc = $string.date('Ymd').$mosConfig_secret;
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $enc .= $_SERVER['HTTP_USER_AGENT'];
    }
    if (isset($_SERVER['REMOTE_ADDR'])) {
        $enc .= $_SERVER['REMOTE_ADDR'];
    }
    return md5($enc);
}


/***************/
/* SEND E-MAIL */
/***************/
function sendmail() {
	global $database, $Itemid, $my, $mainframe;

	$con_id = intval( mosGetParam($_POST ,'con_id', 0 ));

	/* SECURITY CHECK */
	if ($mainframe->getCfg('captcha')) {
        $code = getEncString(trim( mosGetParam($_POST, 'code', '')));
        if ($code != $_SESSION['captcha']) {
			elxError(_E_INV_SECCODE, 1);
			return;
        }
    }

	$database->setQuery("SELECT * FROM #__contact_details WHERE id='$con_id' AND published='1' AND access IN (".$my->allowed.")", '#__', 1, 0 );
	$database->loadObject($contact);
	if (!$contact) {
		elxError(_CONTACT_NOFOUND, 1);
		return;
	}

    $mainframe->setPageTitle($contact->name.' - '._CONTACT_TITLE);
    $mainframe->setMetaTag('description', $contact->name.', '.$mainframe->getCfg('sitename'));
    $mainframe->setMetaTag('keywords', ''.$contact->name.', '._CONTACT_TITLE.', e-mail');

	$default 	= $mainframe->getCfg('sitename').' '. _ENQUIRY;
	$email 		= trim(mosGetParam($_POST, 'email', ''));
	$text 		= eUTF::utf8_trim(mosGetParam( $_POST, 'text', '' ));
	$name 		= eUTF::utf8_trim(mosGetParam( $_POST, 'name', '' ));
	$subject 	= eUTF::utf8_trim(mosGetParam( $_POST, 'subject', $default ));
	$email_copy = intval(mosGetParam($_POST, 'email_copy', 0));

	if (!$email || !$text || ( is_email( $email )==false )) {
		elxError(_CONTACT_FORM_NC, 0);
		return;
	}

	$prefix = sprintf(_ENQUIRY_TEXT, $mainframe->getCfg('live_site'));
	$text = $prefix . _LEND. $name. ' <'. $email .'>'._LEND._LEND.stripslashes( $text );

	mosMail( $email, $name , $contact->email_to, $mainframe->getCfg('fromname').': '. $subject, $text );

	if ($email_copy) {
		$copy_text = sprintf(_COPY_TEXT, $contact->name, $mainframe->getCfg('sitename'));
		$copy_text = $copy_text ._LEND._LEND. $text .'';
		$copy_subject = _COPY_SUBJECT . $subject;
		mosMail($mainframe->getCfg('mailfrom'), $mainframe->getCfg('fromname'), $email, $copy_subject, $copy_text);
	}
	?>
	<h1><?php echo _CONTACT_TITLE; ?></h1>
	<p><?php echo _THANK_MESSAGE; ?></p>
<?php 
}


/***************************/
/* VALIDATE E-MAIL ADDRESS */
/***************************/
function is_email($email){
	$rBool=false;

	if  ( preg_match( "/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/" , $email ) ){
		$rBool=true;
	}
	return $rBool;
}


/******************/
/* DOWNLOAD VCARD */
/******************/
function vCard($id) {
	global $database, $mainframe, $my;
	
	$contact = new mosContact( $database );
	$contact->load( $id );

	$myacc = explode(',', $my->allowed);
	if (!$contact || ($contact->published == '0') || (!in_array($contact->access, $myacc))) {
		exit('Invalid request!');
	}

	$name = explode( ' ', $contact->name );
	$count = count( $name );

	// handles conversion of name entry into firstname, surname, middlename distinction
	$surname	= '';
	$middlename	= '';
	
	switch( $count ) {
		case 1:
			$firstname = $name[0];
			break;
			
		case 2:
			$firstname = $name[0];
			$surname = $name[1];
			break;
			
		default:
			$firstname = $name[0];
			$surname = $name[$count-1];
			for ( $i = 1; $i < $count - 1 ; $i++ ) {
				$middlename	.= $name[$i] .' ';
			}		
			break;
	}
	$middlename	= eUTF::utf8_trim( $middlename );

	$v 	= new MambovCard();
	
	$v->setPhoneNumber( $contact->telephone, 'PREF;WORK;VOICE' );
	$v->setPhoneNumber( $contact->fax, 'WORK;FAX' );
	$v->setName( $surname, $firstname, $middlename, '' );
	$v->setAddress( '', '', $contact->address, $contact->suburb, $contact->state, $contact->postcode, $contact->country, 'WORK;POSTAL' );
	$v->setEmail( $contact->email_to );
	$v->setNote( $contact->misc );
	$v->setURL($mainframe->getCfg('live_site'), 'WORK');
	$v->setTitle( $contact->con_position );
	$v->setOrg($mainframe->getCfg('sitename'));

	$filename = eUTF::utf8_str_replace( ' ', '_', $contact->name );
	$v->setFilename( $filename );
	
	$output = $v->getVCard($mainframe->getCfg('sitename'));
	$filename = $v->getFileName();

	//header info for page
	@ob_end_clean();
	@header( 'Content-Disposition: attachment; filename='.$filename );
	@header( 'Content-Length: '.eUTF::utf8_strlen( $output ) );
	@header( 'Connection: close' );
	@header( 'Content-Type: text/x-vCard; charset:UTF-8; name='.$filename );

	print $output;
}

?>
