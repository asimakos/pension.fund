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


include_once($mosConfig_absolute_path .'/includes/vcard.class.php');

class mosContact extends mosDBTable {

	public $id=null;
	public $name=null;
	public $con_position=null;
	public $address=null;
	public $suburb=null;
	public $state=null;
	public $country=null;
	public $postcode=null;
	public $telephone=null;
	public $fax=null;
	public $misc=null;
	public $image=null;
	public $imagepos=null;
	public $email_to=null;
	public $default_con=0;
	public $published=null;
	public $checked_out=null;
	public $checked_out_time=null;
	public $ordering=null;
	public $params=null;
	public $user_id=null;
	public $catid=null;
	public $access=null;
	public $seotitle=null;


	public function __construct() {
	    global $database;
		$this->mosDBTable( '#__contact_details', 'id', $database );
	}


	public function check() {
		$this->default_con = ''.intval( $this->default_con ).'';
		return true;
	}
}


/**
* class needed to extend vcard class and to correct minor errors
*/
class MambovCard extends vCard {

	// needed to fix bug in vcard class
	public function setName( $family='', $first='', $additional='', $prefix='', $suffix='' ) {
		$this->properties["N"] 	= "$family;$first;$additional;$prefix;$suffix";
		$this->setFormattedName( trim( "$prefix $first $additional $family $suffix" ) );
	}

	// needed to fix bug in vcard class
	public function setAddress( $postoffice='', $extended='', $street='', $city='', $region='', $zip='', $country='', $type='HOME;POSTAL' ) {
		// $type may be DOM | INTL | POSTAL | PARCEL | HOME | WORK or any combination of these: e.g. "WORK;PARCEL;POSTAL"
		$key 	= 'ADR';
		if ( $type != '' ) {
			$key	.= ';'. $type;
		}
		$key.= ';ENCODING=QUOTED-PRINTABLE';
		$this->properties[$key] = encode( $extended ) .';'. encode( $street ) .';'. encode( $city ) .';'. encode( $region) .';'. encode( $zip ) .';'. encode( $country );
	}

	// added ability to set filename
	public function setFilename( $filename ) {
		$this->filename = $filename .'.vcf';
	}	

	// added ability to set position/title
	public function setTitle( $title ) {
		$title = eUTF::utf8_trim( $title );
		$this->properties['TITLE'] 	= $title;
	}

	// added ability to set organisation/company
	public function setOrg( $org ) {
		$org = eUTF::utf8_trim( $org );
		$this->properties['ORG'] 	= $org;
	}

	public function getVCard( $sitename ) {
		$text 	= "BEGIN:VCARD\r\n";
		$text 	.= "VERSION:2.1\r\n";
		foreach( $this->properties as $key => $value ) {
			$text	.= "$key:$value\r\n";
		}
		$text	.= "REV:" .date("Y-m-d") ."T". date("H:i:s"). "Z\r\n";
		$text	.= "MAILER: Elxis vCard for ". $sitename ."\r\n";
		$text	.= "END:VCARD\r\n";
		return $text;
	}
	
}
?>