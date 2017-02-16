<?php 

/* NewsLetter configuration - Created by Is Open Source (isopensource.com) */
/* Last saved on 2014-02-11 07:39:11 */

defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

class newsletterConfig {

protected $CAN_SUBSCRIBE = 2;
protected $VALIDATE_EMAIL = 1;
protected $LANGS = '';
protected $EXTLDS = '';
protected $EXDOMAINS = '';
protected $ONLYTLDS = '';
protected $ONLYDOMAINS = '';
protected $SHOWSTATS = 1;
protected $RECPERSTEP = 50;
protected $ONEPERREC = 0;
protected $SENDERNAME = 'My Company';
protected $SENDERMAIL = 'user@domain.com';
protected $SENDMETHOD = 'mail';
protected $READCONFIRM = 0;
protected $REPLYTO = 1;
protected $SENDMAILPATH = '/usr/sbin/sendmail';
protected $SMTPHOST = 'localhost';
protected $SMTPPORT = 25;
protected $SMTPSECURE = '';
protected $SMTPAUTH = 0;
protected $SMTPUSER = '';
protected $SMTPPASS = '';
protected $SHOWCOPYRIGHT = 1;

public function __construct() {
}

public function get($v='') {
	if ($v != '') {
		if (isset($this->$v)) { return $this->$v; }
	}
	return '';
}
}

?>