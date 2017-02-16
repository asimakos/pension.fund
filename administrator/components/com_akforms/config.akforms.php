<?php 

/* AkForms by Andrew Campball (ACampball@yandex.ru) for Elxis CMS */
/* Last saved on 2014-02-06 10:55:29 */

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

class akFormsConfig {

private $COPYRIGHT = 0;
private $GFMAXFILESIZE = 500;
private $GFFOLDER_FILES = '/components/com_akforms/files';
private $EXPIRE_DAY = 30;
private $SSL = 0;
public function __construct() {
}

public function get($var='') {
if (($var != '') && isset($this->$var)) { return $this->$var; }
return '';
}

}

?>