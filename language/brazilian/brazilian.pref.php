<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Language
* @author: Elxis Team
* @translator:Renê William Schneider
* @link: http://www.nabiblioteca.com/linux/
* @email: renews@gmail.com
* @description: Brazilian Gemini Language File
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'O Acesso direto a esse local não é permitido' );


class prefLang_brazilian {

	public $_ON_NEW_CONTENT = "A new content item has been submitted by [ %s ] titled [ %s ] for section [ %s ] and category [ %s ]";
	public $_E_COMMENTS = 'Comments';
	public $_DATE = 'Date';
	public $_E_SUBCONWAIT = 'Submitted articles waiting for approval:';
	public $_E_CONTENTSUB = 'Content submission';
	public $_MAIL_SUB = 'User Submitted';
	public $_E_HI = 'Hi';
	public $_E_NEWSUBBY = "A new submission made by user %s";
	public $_E_TYPESUB = 'Type of submission:';
	public $_E_TITLE = 'Title';
	public $_E_LOGINAPPR = 'Login to your site administration to view and approve this submission.';
	public $_E_DONTRESPOND = 'Please do not respond to this message as it is automatically generated and is for information purposes only.';
	public $_E_NEWPASS_SUB = "New password for %s";
	public $_E_RPASS_NADMIN = "User %s submited the password reminder form. A new password was generated and send to him. 
	If you don\'t wish to get notified for such actions change the USERS_RPASSMAIL parameter on SoftDisk to No.";
	public $_E_SEND_SUB = "Account details for %s at %s";
	public $_ASEND_MSG = "Hello %s, 
A new user has registered at %s.
This email contains their details:

Name - %s
e-mail - %s
Username - %s

Please do not respond to this message as it is automatically generated and is for information purposes only.";
	public $_NEW_MESSAGE = 'A new private message has arrived';
	public $_NEW_PRMSGF = "A new private message has arrived from %s";
	public $_LOG_READMSG = 'Please login to the administration console to read the message.';
	public $_SUBCON_APPRNTF = 'Submitted content approval notification';
	public $_SUBCON_ATAPPR = 'Your submitted content at %s was approved.';
	public $_SECTION = 'Section';
	public $_CATEGORY = 'Category';

	//elxis 2008.1
	public $_MANAPPROVE = 'In order for the new user to be able to login you must manually approve his registration!';
	public $_ACCUNBLOCK = "Your account at %s has been activated by a site administrator. You may now login as %s";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'New comment notification';
	public $_E_NEWCOMBYTITLE = "A new comment has been posted by %s on an article of yours titled %s";
	public $_E_COMSTAYUNPUB = 'This comment will stay unpublished until you or a super administrator publish it.';
	public $_E_ACCEXPDATE = 'Account expiration date';

	public function __construct() {
	}

}

?>