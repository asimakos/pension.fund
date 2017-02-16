<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Elxis Team
* @translator: Ioannis Sannos
* @translator URL: http://www.elxis.org
* @translator E-mail: info@elxis.org
* @description: English language for Updiag tool
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class updiagLang {

	public $UPDATE = 'Update';
	public $CHVERS = 'Check Version';
	public $CNOTGETELXD = 'Could not get data from elxis.org';
	public $INVXML = 'Retrieved an invalid XML file. Could not display requested information.';
	public $SIZE = 'Size';
	public $MORE = 'More';
	public $DOWNLOAD = 'Download';
	public $INSELXVER = 'Installed Elxis version';
	public $CURRENT = 'Current';
	public $OUTDATED = 'Outdated!';
	public $NEWVERAV = 'There is a newer version of Elxis available. Please update your Elxis installation as soon as possible.';
	public $CHPATCHES = 'Check for patches';
	public $NOPATCHES = 'There are no available patches for your Elxis version';
	public $PROSUPPORT = 'Professional support';
	public $NEWS = 'News';
	public $MAINTENANCE = 'Maintenance';
	public $REMOTEERR1 = 'Invalid request';
	public $REMOTEERR2 = 'Could not get list of scripts';
	public $REMOTEERR3 = 'No scripts found';
	public $REMOTEERR4 = 'Requested file is empty';
	public $REMOTEERR5 = 'Could not get list of hash files';
	public $REMOTEERR6 = 'No hash files found';
	public $REMOTEERR7 = 'Could not download requested file!';
	public $UNERROR = 'Unknown error';
	public $PROVCODE = 'Provides code for updating Elxis from version';
	public $TOVERSION = 'to version';
	public $INSTALLED = 'Installed';
	public $REQFEXISTS = 'Requested file already exists!';
	public $FILDOWNSUC = 'File downloaded successfully!';
	public $DFORRUNSCR = 'Don\'t forget to run this script in case you wish to update your Elxis installation.';
	public $CNOTCPDFIL = 'Could not copy downloaded file to destination directory.';
	public $PLCHSCRPERM = 'Please check folder\'s /administrator/tools/updiag/data/scripts permissions';
	public $PLCHSCRPERM2 = 'Please check folder\'s /administrator/tools/updiag/data/hashes permissions';
	public $EXECUTE = 'Execute';
	public $SCRNOTEX = 'Requested script does not exist!';
	public $FSCHECK = 'Check filesystem';
	public $HIDEHELP = 'Hide help';
	public $NORMAL = 'Normal';
	public $EXTENDED = 'Extended';
	public $FULL = 'Full';
	public $NOHASHFOUND = 'No hash files found';
	public $INVHFILE = 'Invalid hash file!';
	public $SHFELXVER = 'Selected hash file is for an older Elxis version than yours!';
	public $FNOTEXIST = 'File does not exist';
	public $WARNING = 'Warning';
	public $FNEEDUP = 'File needs update';
	public $SITUP2D = 'Site is up-to-date!';
	public $FOUND = 'Found';
	public $OUTFUP = 'outdated files. Please update!';
	public $CHFINUS = 'Checking site update status using <b>%s</b> as source';
	public $NEWRELEASES = 'New releases';
	public $NONEWREL = 'There are no new releases';
	public $PRICE = 'Price';
	public $LICENSE = 'License';
	public $SECURITY = 'Security';
	public $INSTPATH = 'Installation path';
	public $CREDITS = 'Credits';
	public $ALERT = 'Alert';
	public $FSECALWA = 'Found <b>%d</b> security alerts and warnings';
	public $ELXINPAS = 'Your Elxis installation passed successfully basic security check';
	public $HOME = 'Home';
	public $UPDSPAG = 'Updiag Central';
	public $UPDWELC = 'Welcome to <b>Updiag</b>, the Elxis update and diagnose tool.';
	public $STARTMORE = 'Most Updiag functions requires remote connection to elxis.org website. 
	So, you must have an open connection from your site to the internet for these functions to work. 
	Select an item from the top menu to navigate.';
	public $BASCHECKS = 'Basic Checks <small>(click on an icon to execute)</small>';
	public $FILEREMSUC = 'File removed succesffuly!';
	public $CNREMSFILE = 'Could not remove selected file! Check file permissions.';
	public $HASHNOTEX = 'Requested hash file does not exist!';
	public $DNHASHFLS = 'Download hash files';
	public $BUY = 'Buy';
	public $DOWNLTIME = 'Download time';
	public $DOWNLSPEED = 'Download speed';


	public function __construct() {
	}

}

define('CX_LUPDIAGD', 'Helps you update your site, notifies you about new Elxis releases, versions and patches and provides you security and diagnostic tasks.');

?>