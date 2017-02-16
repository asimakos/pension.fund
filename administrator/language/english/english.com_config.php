<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ioannis Sannos
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: English language for component config
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

	public $A_COMP_CONF_OFFLINE = 'Site Offline';
	public $A_COMP_CONF_OFFMESSAGE = 'Offline Message';
	public $A_COMP_CONF_TIP_OFFMESSAGE = 'A message that is displayed if your site is offline';
	public $A_COMP_CONF_ERR_MESSAGE = 'System Error Message';
	public $A_COMP_CONF_TIP_ERR_MESSAGE = 'A message that is displayed if Elxis could not connect to the database';
	public $A_COMP_CONF_SITE_NAME = 'Site Name';
	public $A_COMP_CONF_UN_LINKS = 'Show Unauthorized Links';
	public $A_COMP_CONF_UN_TIP = 'If yes, will show links to registered content even if you are not logged in. Users will need to login to see the item in full.';
	public $A_COMP_CONF_USER_REG = 'Allow User Registration';
	public $A_COMP_CONF_TIP_USER_REG = 'If yes, allows users to self-register';
	public $A_COMP_CONF_REQ_EMAIL = 'Require Unique Email';
	public $A_COMP_CONF_REQTIP = 'If yes, users cannot share the same email address';
	public $A_COMP_CONF_DEBUG = 'Debug Site';
	public $A_COMP_CONF_DEBTIP = 'If yes, displays diagnostic information and SQL errors if present';
	public $A_COMP_CONF_EDITOR = 'WYSIWYG Editor';
	public $A_COMP_CONF_LENGTH = 'List Length';
	public $A_COMP_CONF_LENTIP = 'Sets the default length of lists in administration for all users';
	public $A_COMP_CONF_FAV_ICON = 'Favorites Site Icon';
	public $A_COMP_CONF_FAVTIP = 'If left blank or the file cannot be found, the default favicon.ico will be used';
	public $A_COMP_CONF_CLINKACC = 'Components Linked with Access System';
	public $A_COMP_CONF_CLACCDESC = 'Select the type of components you want to be applied for the Access Control System in frontend (ACO value = view). Read help if you are unsure.';
	public $A_COMP_CONF_CORECOMPS = 'Core Components';
	public $A_COMP_CONF_3RDCOMPS = 'Third Party Components';
	public $A_COMP_CONF_ALLCOMPS = 'All Components';
	public $A_COMP_CONF_CAPTCHA = 'Use Security Images';
	public $A_COMP_CONF_CAPTCHATIP = 'Yes, if you want security images (Captcha) to be displayed inside web site forms. A word spelling feature is also available to help people with vision problems.';
	public $A_COMP_CONF_LOCALE = 'Locale';
	public $A_COMP_CONF_LANG = 'Default Front-End Language';
	public $A_COMP_CONF_ALANG = 'Default Back-End Language';
	public $A_COMP_CONF_TIME_SET = 'Time Offset';
	public $A_COMP_CONF_DATE = 'Current date/time configured to display';
	public $A_COMP_CONF_LOCAL = 'Country Locale';
	public $A_COMP_CONF_LOCRECOM = 'We recommend you to leave it to Auto Select. Elxis will load the most suitable locale for your system O.S. and selected language. Windows does not support UTF-8 locales.';
	public $A_COMP_CONF_LOCCHECK = 'Locale Check';
	public $A_COMP_CONF_LOCCHECK2 = 'If you see this date well formatted, then Locale is fine for your system and language.<br /><strong>Attention!</strong> Under Windows the Locale is set automatically to English.';
	public $A_COMP_CONF_AUTOSEL = 'Auto Select';
	public $A_COMP_CONF_CONTROL = '* These Parameters control Output elements *';
	public $A_COMP_CONF_LINK_TITLES = 'Linked Titles';
	public $A_COMP_CONF_LTITLES_TIP = 'If yes, the title of content item will act as hyperlink to the item';
	public $A_COMP_CONF_MORE_LINK = 'Read More Link';
	public $A_COMP_CONF_MLINK_TIP = 'If set to show, the read-more link will show if main-text has been provided for the item';
	public $A_COMP_CONF_RATE_VOTE = 'Item Rating/Voting';
	public $A_COMP_CONF_RVOTE_TIP = 'If set to show, a voting system will be enabled for content items';
	public $A_COMP_CONF_AUTHOR = 'Author Names';
	public $A_COMP_CONF_AUTHORTIP = 'If set to show, the name of the author will be displayed. This is a global setting but can be changed at menu and item levels';
	public $A_COMP_CONF_CREATED = 'Created Date and Time';
	public $A_COMP_CONF_CREATEDTIP = 'If set to show, the date and time an item was created will be displayed. This is a global setting but can be changed at menu and item levels';
	public $A_COMP_CONF_MOD_DATE = 'Modified Date and Time';
	public $A_COMP_CONF_MDATETIP = 'If set to show, the date and time an item was last modified will be displayed. This is a global setting but can be changed at menu and item levels';
	public $A_COMP_CONF_HITS = 'Hits';
	public $A_COMP_CONF_HITSTIP = 'If set to show, the hits for a particular item will be displayed. This is a global setting but can be changed at menu and item levels';
	public $A_COMP_CONF_PDF = 'PDF Icon';
	public $A_COMP_CONF_OPT_MEDIA = 'Option not available as /tmpr directory not writable';
	public $A_COMP_CONF_PRINT_ICON = 'Print Icon';
	public $A_COMP_CONF_EMAIL_ICON = 'Email Icon';
	public $A_COMP_CONF_ICONS = 'Icons';
	public $A_COMP_CONF_USE_OR_TEXT = 'Print, RTF, PDF & Email will utilize Icons or Text';
	public $A_COMP_CONF_TBL_CONTENTS = 'Table of Contents on multi-page items';
	public $A_COMP_CONF_BACK_BUTTON = 'Back Button';
	public $A_COMP_CONF_CONTENT_NAV = 'Content Item Navigation';
	public $A_COMP_CONF_HYPER = 'Use Hyperlinked Titles';
	public $A_COMP_CONF_DBTYPE = 'Database Type';
	public $A_COMP_CONF_DBWARN = 'Do not change unless your system support this database and a copy of Elxis data is installed on this Database!';
	public $A_COMP_CONF_HOSTNAME = 'Hostname';
	public $A_COMP_CONF_DB_PW = 'Password';
	public $A_COMP_CONF_DB_NAME = 'Database';
	public $A_COMP_CONF_DB_PREFIX = 'Database Prefix';
	public $A_COMP_CONF_NOT_CH = '!! DO NOT CHANGE UNLESS YOU HAVE A DATABASE BUILT USING TABLES WITH THE PREFIX YOU ARE SETTING !!';
	public $A_COMP_CONF_ABS_PATH = 'Absolute Path';
	public $A_COMP_CONF_LIVE = 'Live Site';
	public $A_COMP_CONF_SECRET = 'Secret Word';
	public $A_COMP_CONF_GZIP = 'GZIP Page Compression';
	public $A_COMP_CONF_CP_BUFFER = 'Compress buffered output if supported';
	public $A_COMP_CONF_SESSION_TIME = 'Login Session Lifetime';
	public $A_COMP_CONF_SEC = 'seconds';
	public $A_COMP_CONF_AUTO_LOGOUT = 'Auto logout after this time period of inactivity';
	public $A_COMP_CONF_ERR_REPORT = 'Error Reporting';
	public $A_COMP_CONF_HELP_SERVER = 'Help Server';
	public $A_COMP_CONF_META_PAGE = 'metadata-page';
	public $A_COMP_CONF_META_DESC = 'Global Site Meta Description';
	public $A_COMP_CONF_META_KEY = 'Global Site Meta Keywords';
	public $A_COMP_CONF_HPS1 = 'Local Help Files';
	public $A_COMP_CONF_HPS2 = 'Elxis Remote Help Server';
	public $A_COMP_CONF_HPS3 = 'Official Elxis Help Server';
	public $A_COMP_CONF_PERMFLES = 'Select this option to define permission flags for new files';
	public $A_COMP_CONF_PERMDIRS = 'Select this option to define permission flags for new directories';
	public $A_COMP_CONF_NCHMODDIRS = 'Dont CHMOD new directories (use server defaults)';
	public $A_COMP_CONF_CHAPFLAGS = 'Checking here, will apply the permission flags to <em>all existing files</em> of the site.<br/><strong>INAPPROPRIATE USAGE OF THIS OPTION MAY RENDER THE SITE INOPERATIVE!</strong>';
	public $A_COMP_CONF_CHAPDLAGS = 'Checking here, will apply the permission flags to <em>all existing directories</em> of the site.<br/><strong>INAPPROPRIATE USAGE OF THIS OPTION MAY RENDER THE SITE INOPERATIVE!</strong>';
	public $A_COMP_CONF_APPEXDIRS = 'Apply to Existing Directories';
	public $A_COMP_CONF_APPEXFILES = 'Apply to Existing Files';
	public $A_COMP_CONF_WORLD = 'World';
	public $A_COMP_CONF_CHMODNDIRS = 'CHMOD new directories';
	public $A_COMP_CONF_MAIL = 'Mailer';
	public $A_COMP_CONF_MAIL_FROM = 'Mail From';
	public $A_COMP_CONF_MAIL_FROM_NAME = 'From Name';
	public $A_COMP_CONF_MAIL_SMTP_AUTH = 'SMTP Auth';
	public $A_COMP_CONF_MAIL_SMTP_USER = 'SMTP User';
	public $A_COMP_CONF_MAIL_SMTP_PASS = 'SMTP Pass';
	public $A_COMP_CONF_MAIL_SMTP_HOST = 'SMTP Host';
	public $A_COMP_CONF_CACHE = 'Caching';
	public $A_COMP_CONF_CACHE_FOLDER = 'Cache Folder';
	public $A_COMP_CONF_CACHE_DIR = 'Current cache directory is';
	public $A_COMP_CONF_CACHE_DIR_UNWRT = 'The cache directory is UNWRITEABLE - please set this directory to CHMOD 777 before turning on the cache';
	public $A_COMP_CONF_CACHE_TIME = 'Cache Time';
	public $A_COMP_CONF_STATS = 'Statistics';
	public $A_COMP_CONF_STATS_ENABLE = 'Enable/disable collection of site statistics';
	public $A_COMP_CONF_STATS_LOG_HITS = 'Log Content Hits by Date';
	public $A_COMP_CONF_STATS_WARN_DATA = 'WARNING : Large amounts of data will be collected';
	public $A_COMP_CONF_STATS_LOG_SEARCH = 'Log Search Strings';
	public $A_COMP_CONF_SEO_LBL = 'SEO';
	public $A_COMP_CONF_SEO = 'Search Engine Optimization';
	public $A_COMP_CONF_SEO_SEFU = 'Search Engine Friendly URLs';
	public $A_COMP_CONF_SEOBASIC = 'SEO Basic';
	public $A_COMP_CONF_SEOPRO = 'SEO Pro';
	public $A_COMP_CONF_SEOHELP = "Apache, Lighttpd and IIS. Apache, Lighttpd: rename htaccess.txt to .htaccess before activating (mod_rewrite enabled). IIS: use Ionic Isapi Rewriter filter. For maximum performance prepare your content before switching to SEO PRO. Select SEO Basic if you want to use a third party SEF component.";
	public $A_COMP_CONF_SERVER = 'Server';
	public $A_COMP_CONF_METADATA = 'Metadata';
	public $A_COMP_CONF_CACHE_TAB = 'Cache';
	public $A_COMP_CONF_FTP_LBL = 'FTP';
	public $A_COMP_CONF_FTP = 'FTP Settings';
	public $A_COMP_CONF_FTP_ENB = 'Enable FTP';
	public $A_COMP_CONF_FTP_HST = 'FTP Host';
	public $A_COMP_CONF_FTP_HSTTP = 'Most probably';
	public $A_COMP_CONF_FTP_USR = 'FTP Username';
	public $A_COMP_CONF_FTP_USRTP = 'Most probably';
	public $A_COMP_CONF_FTP_PAS = 'FTP Password';
	public $A_COMP_CONF_FTP_PRT = 'FTP Port';
	public $A_COMP_CONF_FTP_PRTTP = 'Default value is: 21';
	public $A_COMP_CONF_FTP_PTH = 'FTP Root Path';
	public $A_COMP_CONF_FTP_PTHTP = 'Path from FTP root to your Elxis installation. I.e. /public_html/elxis';
	public $A_COMP_CONF_HIDE = 'Hide';
	public $A_COMP_CONF_SHOW = 'Show';
	public $A_COMP_CONF_DEFAULT = 'System Default';
	public $A_COMP_CONF_NONE = 'None';
	public $A_COMP_CONF_SIMPLE = 'Simple';
	public $A_COMP_CONF_MAX = 'Maximum';
	public $A_COMP_CONF_MAIL_FC = 'PHP mail function';
	public $A_COMP_CONF_SEND = 'Sendmail';
	public $A_COMP_CONF_SENDP = 'Sendmail path';
	public $A_COMP_CONF_SMTP = 'SMTP Server';
	public $A_COMP_CONF_UPDATED = 'The configuration details have been <strong>updated!</strong>';
	public $A_COMP_CONF_ERR_OCC = '<strong>An Error Has Occurred!</strong> Unable to open config file to write!';
	public $A_COMP_CONF_READ = 'read';
	public $A_COMP_CONF_WRITE = 'write';
	public $A_COMP_CONF_EXEC = 'execute';
	public $A_COMP_CONF_FCRE = 'File Creation';
	public $A_COMP_CONF_FPERM = 'File Permissions';
	public $A_COMP_CONF_DCRE = 'Directory Creation';
	public $A_COMP_CONF_DPERM = 'Directory Permissions';
	public $A_COMP_CONF_OFFEX = 'Yes (except for Super Administrators)';
	public $A_COMP_CONF_RTF = 'RTF Icon';

	//2008.1
	public $A_C_CONF_AC_ACT = 'Account Activation';
	public $A_C_CONF_NOACT = 'No activation';
	public $A_C_CONF_EMACT = 'Activation via e-mail';
	public $A_C_CONF_MANACT = 'Manual activation';
	public $A_C_CONF_AC_ACTD = 'Select how you wish new user accounts to be activated. Directly, via activation link in e-mail or manually by the site administrator.';

	//2009.0
	public $A_C_CONF_COMMENTS = 'Comments';
	public $A_C_CONF_COMMENTSTIP = 'If set to show, the number of comments for a particular content item will be displayed. This is a global setting but can be changed at menu and item levels';
	public $A_C_CONF_CHKFTP = 'Check FTP settings';
	public $A_C_CONF_STDCACHE = 'Standard cache';
	public $A_C_CONF_STATCACHE = 'Static cache';
	public $A_C_CONF_CACHED = 'Standard Cache caches partial page blocks while Static Cache the whole page. Static Cache is recommended for heavy loaded sites. To use static cache you must have SEO PRO enabled.';
	public $A_C_CONF_SEODIS = 'SEO PRO is disabled!';

	public function __construct() {	
	}

}

?>