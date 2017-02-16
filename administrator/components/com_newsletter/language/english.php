<?php 
/**
* @version: 1.3
* @copyright: Copyright (C) 2008-2010 Is Open Source. All rights reserved.
* @package: Elxis
* @subpackage: Component NewsLetter
* @author: Ioannis Sannos (Is Open Source)
* @translator: Ioannis Sannos
* @link: http://www.isopensource.com
* @email: info@isopensource.com
* @description: English language for component NewsLetter
* @license: http://creativecommons.org/licenses/by-sa/3.0/ Creative Commons Attribution-Share Alike 3.0
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class newsletterLang {


	public $NEWSLETTER = 'Newsletter';
	public $NEWSLMAILLIST = 'Newsletter mailing list';
	public $SUBSCRIBE = 'Subscribe';
	public $UNSUBSCRIBE = 'Un-subscribe';
	public $SUBLEWSL = 'Subscribe to our newsletter';
	public $UNSUBLEWSL = 'Un-subscribe from our newsletter';
	public $NAME = 'Name';
	public $SURNAME = 'Surname';
	public $RECIEVEIN = "Recieve messages in"; //translators help: filled in by language name (i.e. "English")
	public $ANYLANG = 'any language';
	public $SUBINFO = 'Fill in your personal information to subscribe to our newsletter list. All fields are required. 
	You will be able to any time un-subscribe from our newsletter list if you wish to no longer recieve notification e-mails.';
	public $SUBEMAILVAL = 'Your e-mail address will be automatically verified in order for your subscription to be aproved.';
	public $SECCODE = 'Security code';
	public $UNSUBINFO = 'Fill-in your e-mail address to un-subscribe from our newsletter. A special removal URL 
	will be sent to your e-mail address. Click it to be removed from our mailing list.';
	public $JSDISABLED = 'You must enable JavaScript in your browser to use this feature!';
	public $NAMEEMPTY = 'Name can not be empty!';
	public $SURNAMEEMPTY = 'Surname can not be empty!';
	public $PROVALIDEMAIL = 'You must provide a valid e-mail address!';
	public $SECCODEWRONG = 'Security code is wrong!';
	public $EMAILEXISTS = 'Submitted e-mail address already exists in our mailing list!';
	public $NOTACCDOM = 'Sorry, we do not accept e-mails from your e-mail domain.';
	public $FLOODWAIT = 'Flood protection! Please wait some seconds and re-try.';
	public $NEWSLSUBNTF = 'Newsletter subscription notification';
	public $DEAR = 'Dear'; //translators help: followed by name surname
	public $THANKSUB = 'Thank you for your subscription to our mailing list.';
	public $SUBCOMPVISIT = 'In order for your subscription to be completed it is required to visit the link bellow. 
	By visiting this link you verify that you are the owner of this e-mail address and your subscription is activated.';
	public $NEVERSUBIGN = 'If you never subscribed to our mailing list please ingore this e-mail.';
	public $GREETINGS = 'Greetings';
	public $SUBCONFIRM = 'Subscription confirmation';
	public $CONFLINKSENT = 'A special confirmation link was sent to your e-mail address. 
	Check your messages and click on the confirmation link to complete your subscription to our mailing list.'; 
	public $SUBCOMPLETE = 'Your subscription was completed';
	public $SUBCOMPLETED = 'Your subscription to our mailing list was completed successfully. If you wish to no 
	longer recieve e-mail messages by us, you can any time un-subscribe from our mailing list by entering your e-mail 
	address to the un-subscribe form.';
	public $CONFFAILED = 'Confirmation failed';
	public $CONFFAILEDD = 'Subscription confirmation failed! Your subscription is either confirmed or the confirmation code is invalid.';
	public $SUBLOGIN = 'In order to subscribe to our mailing list you must first login!';
	public $SUBNALLOWED = 'We are sorry, new subscriptions are not allowed.';
	public $MAILNFOUND = 'Your e-mail address was not found in our mailing list or your subscription is still un-confirmed';
	public $UNSUBCONFIRM = 'Un-subscription confirmation';
	public $WISHUNSCLICK = 'We recieved an un-subscription request from our mailing list by you. To confirm that you wish to 
	unsubscribe from our mailing list visit the link bellow.';
	public $UNSUBINGORE = 'If you never requested to get un-subscribed from our mailing list or 
	you never subscribed to it, please ignore this message.';
	public $UNSUBCOMPLETE = 'Your un-subscription was completed';
	public $UNSUBCOMPLETED = 'You successfully get removed from our mailing list.';
	public $RCONFLINKSENT = 'Your removal requested was submitted successfully. A special confirmation link was 
	sent to your e-mail address. Check your messages and click on the confirmation link to get removed from our mailing list.'; 
	public $RCONFFAILEDD = 'Un-subscription confirmation failed! Your subscription is either not confirmed or the confirmation code is invalid.';
	public $NOTHSPECIAL = 'There is nothing special to see here.';
	public $STATISTICS = 'Statistics';
	public $TOTALSENT = 'Total sent messages';
	public $LASTSUBSCRIBER = 'Last subscriber';

	/* BACK-END */
	public $CONFIGURE = 'Configure';
	public $SUBSCRIBERS = 'Subscribers';
	public $CONFIRMED = 'Confirmed';
	public $UNCONFIRMED = 'Unconfirmed';
	public $GUEST = 'Guest';
	public $SUBSCRIPTIONS = 'Subscriptions';
	public $REGUSERS = 'Registered users';
	public $EVERYONE = 'Everyone';
	public $CANSUBSCRIBED = 'Select who is allowed to subscribe to your mailing list from front-end.';
	public $EMAILVALID = 'E-mail validation';
	public $EMAILVALIDD = 'If enabled then after a new subscription a special e-mail is sent to the subscriber with a confirmation link. 
	The new subscription is only activated once the user clicks this link. This way you make sure the user is the owner of the submitted e-mail 
	address and that the e-mail address is valid.';
	public $LANGSD = 'If you wish to send language specific e-mail messages then select here the languages you wish to enable. Users during 
	their subscription will also be able to select their desired language from the ones you enable here. If you have only one 
	language published then dont select any language.';
	public $EXCLUDEDTLDS = 'Excluded TLDs';
	public $EXCLUDEDTLDSD = 'Comma seperated list of Top Level Domains (like com,net,org) to deny from being 
	subscribed to your mailing list.';
	public $EXCLUDEDDOMS = 'Excluded domains';
	public $EXCLUDEDDOMSD = 'Comma seperated list of domain names (like badsite.com,hackers.cn) to deny from 
	being subscribed to your mailing list.';
	public $ALLOWEDTLDS = 'Allowed TLDs';
	public $ALLOWEDTLDSD = 'Comma seperated list of Top Level Domains (like com,net,org) for which subscriptions 
	are only allowed. Leave this field empty to allow from all.';
	public $ALLOWEDDOMS = 'Allowed domains';
	public $ALLOWEDDOMSD = 'Comma seperated list of domain names (like mysite.com,friendlysite.gr) for which 
	subscriptions are only allowed. Leave this field empty to allow from all.';
	public $SHOWSTATSD = 'Show NewsLetter statistics in components front-page?';
	public $RECPERSTEP = 'Recipients per step';
	public $RECPERSTEPD = 'IOS Newsletter to limit server load dispatches messages in steps. Set here the number of the e-mails 
	that will be sent in each step. Lower this limit if you see that each step takes too much time to be executed.';
	public $ONEPERREC = 'One per recipient';
	public $ONEPERRECD = 'Send one message per recipient. Works only if send method is PHP Mail! If this is enabled, 
	IOS Newsletters will sent one e-mail per recipient. So, if you send messages to 50 people, 50 e-mails will be sent. 
	If you use this feature lower the Recipients Per Step number. If this feature is disabled, 1 e-mail will be sent 
	in each step for all recipients.';
	public $CNOTSAVESETS = 'Could not save settings!';
	public $EXPORT = 'Export';
	public $EXPORTSUB = 'Export subscribers';
	public $IMPORT = 'Import';
	public $IMPORTSUB = 'Import subscribers';
	public $IMPORTUNIQUE = 'Import only e-mail addresses that dont exist (Requires an extra db query per subscriber. 
	Do not import too many subscribers at once).';
	public $IMPORTD = 'Select the NewsLetter backup file you wish to import.';
	public $IMPORTCUSTOM = 'If you are using a custom import file then make sure this file is UTF-8 encoded 
	and the subscribers are in this format (one subscriber per line):';
	public $IMPORTGIDL = 'For guests userid is 0. Language and group can be empty.';
	public $IMPORTEDSUBS = "%s subscribers were founded. %s of them were imported."; //translators help: %s is being replaced by number
	public $CONFCODE = 'Confirmation code';
	public $GETUSERDATA = 'Get data from user';
	public $NEWSLETTERS = 'Newsletters';
	public $SUBJECT = 'Subject';
	public $RECIPIENTS = 'Recipients';
	public $PLAINTEXT = 'Plain text';
	public $TEXTHTML = 'HTML text';
	public $HTMLFILE = 'HTML file';
	public $LASTSENT = 'Last sent'; //translators help: date newsletter last sent
	public $SELECTFILE = 'Select file';
	public $HTMLFILED = 'You can upload and use an pre-made HTML file instead of writing an HTML text.';
	public $SUBJECTEMPTY = 'Subject can not be empty!';
	public $FIRSTSAVEPR = 'You must first save newsletter to preview it!';
	public $NEWSLNEMPTY = 'Newsletter can not be empty!';
	public $SENDNEWSLETTER = 'Send Newsletter';
	public $MAILFORMAT = 'Mail format';
	public $FORCESEND = 'Force-send this message also to users that have selected to recieve e-mails in an other language.';
	public $SUBSTOTAL = 'Subscribers total';
	public $SUBSCRIBERSIN = "Subscribers in %s"; //translators help: filled in by language
	public $SENDNOW = 'Send now!';
	public $SENDMSGSWAIT = "Sending %s messages, please wait..."; //translators help: filled in by messages number
	public $PLEASEWAIT = 'Please wait...';
	public $MSGOFSENT = "%s of %s messages sent successfully."; //translators help: filled in by number / total number
	public $DISPATCHCOM = 'Dispatch completed';
	public $SENDERNAME = 'Sender name';
	public $SENDEREMAIL = 'Sender e-mail';
	public $SENDMETHOD = 'Send method';
	public $READCONFIRM = 'Reading confirmation';
	public $SENDMAILPATH = 'Sendmail path';
	public $SENDMAILPATHD = 'Used if Sendmail is the selected e-mail send method (default value: /usr/sbin/sendmail).';
	public $SMTPHOST = 'SMTP host';
	public $SMTPPORT = 'SMTP port';
	public $SECURESMTP = 'Secure SMTP';
	public $SMTPAUTH = 'SMTP authentication';
	public $SMTPUSER = 'SMTP username';
	public $SMTPPASS = 'SMTP password';
	public $ADDREPLYTO = 'Reply to';
	public $ADDREPLYTOD = 'Add Reply To e-mail address in mail headers?';
	public $THECOPY = 'Copy'; //translators help: THE copy (material, a copied newsletter)
	public $SHOWCOPYRIGHT = 'Show copyright';
	public $SHOWCOPYRIGHTD = 'Select if you wish a copyright message to be displayed in component\'s front-page. This is my only rewarn for giving you for free this component!';
	public $UPHTMLTEMP = 'Upload an html file to use it as a NewsLetter template';
	public $UPLOADHTMLTEMP = 'Upload HTML template';
	public $SENDNEWSLET = 'Send Newsletter';
	public $IMPORTELXUS = 'Import Elxis users';
	public $IMPORTELXUSD = 'Import in Newsletter existing Elxis CMS users. Only users with e-mail addresses 
	that do not exist in Newsletter subscribers list will be imported.';
	public $FOUNDELXUIMP = "%s Elxis users were found. %s of them were imported into Newsletter."; //translators help: filled in by numbers

	//languages names
	public $ARMENIAN = 'Armenian';
	public $BOZNIAN = 'Bosnian';
	public $BRAZILIAN = 'Brazilian';
	public $BULGARIAN = 'Bulgarian';
	public $CREOLE = 'Creole';
	public $CROATIAN = 'Croatian';
	public $DANISH = 'Danish';
	public $ENGLISH = 'English';
	public $FRENCH = 'French';
	public $GERMAN = 'German';
	public $GREEK = 'Greek';
	public $INDONESIAN = 'Indonesian';
	public $ITALIAN = 'Italian';
	public $JAPANESE = 'Japanese';
	public $LATVIAN = 'Latvian';
	public $LITHUANIAN = 'Lithuanian';
	public $PERSIAN = 'Persian';
	public $POLISH = 'Polish';
	public $RUSSIAN = 'Russian';
	public $SERBIAN = 'Serbian';
	public $SPANISH = 'Spanish';
	public $SRPSKI = 'Srpski';
	public $TURKISH = 'Turkish';
	public $VIETNAMESE = 'Vietnamese';

	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
	}

}

?>