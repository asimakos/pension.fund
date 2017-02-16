<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ioannis Sannos
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: English language for component installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_INS_SDIR = 'Please Select a Directory';
public $A_CMP_INS_UPF = 'Upload Package File';
public $A_CMP_INS_PF = 'Package File';
public $A_CMP_INS_UFI = "Upload File &amp; Install";
public $A_CMP_INS_FDIR = 'Install From Directory';
public $A_CMP_INS_IDIR = 'Installation Directory';
public $A_CMP_INS_DOIN = 'Install';
public $A_CMP_INS_CONT = 'Continue...';
public $A_CMP_INS_NF = 'Installer not found for element ';
public $A_CMP_INS_NA = 'Installer not available for element';
public $A_CMP_INS_EFU = 'The installer can\'t continue before file uploads are enabled. Please use the install from directory method.';
public $A_CMP_INS_ERTL = 'Installer - Error';
public $A_CMP_INS_ERZL = 'The installer can\'t continue before zlib is installed';
public $A_CMP_INS_ERNF = 'No file selected';
public $A_CMP_INS_ERUM = 'Upload new module - error';
public $A_CMP_INS_UPTL = 'Upload ';
public $A_CMP_INS_UPE1 = ' - Upload Failed';
public $A_CMP_INS_UPE2 = ' -  Upload Error';
public $A_CMP_INS_SUCC = 'Success';
public $A_CMP_INS_ER = 'Error';
public $A_CMP_INS_ERFL = 'Failed';
public $A_CMP_INS_UPNW = 'Upload New ';
public $A_CMP_INS_FP = 'Failed to change the permissions of the uploaded file.';
public $A_CMP_INS_FM = 'Failed to move uploaded file to <code>/media</code> directory.';
public $A_CMP_INS_FW = 'Upload failed as <code>/media</code> directory is not writable.';
public $A_CMP_INS_FE = 'Upload failed as <code>/media</code> directory does not exist.';
public $A_CMP_INST_ERUNR = 'Unrecoverable Error';
public $A_CMP_INST_EREXT = 'Extract Error';
public $A_CMP_INST_ERMXM = '<strong>ERROR:</strong> Could not find an Elxis XML setup file in the package';
public $A_CMP_INST_ERXML = '<strong>ERROR:</strong> Could not find an XML setup file in the package';
public $A_CMP_INST_ERNFN = 'No filename specified';
public $A_CMP_INST_ERVLD = 'is not a valid Elxis installation file';
public $A_CMP_INST_ERINC = 'Method install cannot be called by class';
public $A_CMP_INST_ERUIC = 'Method uninstall cannot be called by class';
public $A_CMP_INST_ERIFN = 'Installation file not found';
public $A_CMP_INST_ERSXM = 'XML setup file is not for a';
public $A_CMP_INST_ERCDR = 'Failed to create directory';
public $A_CMP_INST_FNOTE = 'does not exist!';
public $A_CMP_INST_TAFC = 'There is already a file called';
public $A_CMP_INST_AYIT = '- Are you trying to install the same CMT twice?';
public $A_CMP_INST_FCPF = 'Failed to copy file';
public $A_CMP_INST_CPTO = 'to';
public $A_CMP_INST_UNINSTALL = 'Uninstall';
public $A_CMP_INST_CUDIR = 'Another component is already using directory';
public $A_CMP_INST_SQLER = 'SQL Error';
public $A_CMP_INST_CCPHP = 'Could not copy PHP install file.';
public $A_CMP_INST_CCUNPHP = 'Could not copy PHP uninstall file.';
public $A_CMP_INST_UNERR = 'Uninstall -  error';
public $A_CMP_INST_THCOM = 'Component';
public $A_CMP_INST_ISCOR = 'is a core component, and can not be uninstalled.<br />You need to unpublish it if you don\'t want to use it';
public $A_CMP_INST_XMLINV = 'XML File invalid';
public $A_CMP_INST_OFEMP = 'Option field empty, cannot remove files';
public $A_CMP_INST_INCOM = 'Installed Components';
public $A_CMP_INST_CURRE = 'Currently Installed';
public $A_CMP_INST_MENL = 'Component Menu Link';
public $A_CMP_INST_AUURL = 'Author URL';
public $A_CMP_INST_NCOMP = 'There are no custom components installed';
public $A_CMP_INST_INSCO = 'Install New Component';
public $A_CMP_INST_DELE = 'Deleting';
public $A_CMP_INST_LIDE = 'Language id empty, cannot remove files';
public $A_CMP_INST_ALL = 'all';
public $A_CMP_INST_BKLM = 'Back to Language Manager';
public $A_CMP_INST_NWLA = 'Install New Language';
public $A_CMP_INST_NFMM = 'No file is marked as bot file';
public $A_CMP_INST_MAMB = 'bot';
public $A_CMP_INST_AXST = 'already exists!';
public $A_CMP_INST_IOID = 'Invalid object id';
public $A_CMP_INST_FFEM = 'Folder field empty, cannot remove files';
public $A_CMP_INST_DXML = 'Deleting XML File';
public $A_CMP_INST_ICMO = 'is a core element, and cannot be uninstalled.<br />You need to unpublish it if you don\'t want to use it';
public $A_CMP_INST_IMBT = 'Installed Bots';
public $A_CMP_INST_OMBT = 'Only those Bots that can be uninstalled are displayed - some Core Bots cannot be removed.';
public $A_CMP_INST_MBT = 'Bot';
public $A_CMP_INST_MTYP = 'Type';
public $A_CMP_INST_NMBT = 'There are no non-core, custom bots installed.';
public $A_CMP_INST_INMT = 'Install new Bots';
public $A_CMP_INST_UCTP = 'Unknown client type';
public $A_CMP_INST_NFMD = 'No file is marked as module file';
public $A_CMP_INST_MODULE = 'Module';
public $A_CMP_INST_ICMDL = 'is a core module, and can not be uninstalled.<br />You need to unpublish it if you don\'t want to use it';
public $A_CMP_INST_IMDL = 'Installed Modules';
public $A_CMP_INST_OMDL = 'Only those Modules that can be uninstalled are displayed - some Core Modules cannot be removed.';
public $A_CMP_INST_MDLF = 'Module File';
public $A_CMP_INST_NMDL = 'No custom modules installed';
public $A_CMP_INST_NWMDL = 'Install new Modules';
public $A_CMP_INST_ALLC = 'All';
public $A_CMP_INST_STMDL = 'Site Modules';
public $A_CMP_INST_ADMDL = 'Admin Modules';
public $A_CMP_INST_DDEX = 'Directory does not exist, cannot remove files';
public $A_CMP_INST_TIDE = 'Template id is empty, cannot remove files';
public $A_CMP_INST_TINS = 'Install new Template';
public $A_CMP_INST_BATP = 'Back to Templates';
public $A_CMP_INST_INSBR = 'Install new Bridge';
public $A_CMP_INST_BABR = 'Back to Bridges';
public $A_CMP_INST_ΒIDE = 'Bridge id empty, cannot remove files';
public $A_INST_INCOM = 'Detected possible incompatibility between the Elxis version you use and the installed extension. 
Apart from that, the software may work good and without errors. This is just a notification.';
public $A_INST_INCOMJOO = 'Installation package is for Joomla CMS!';
public $A_INST_INCOMMAM = 'Installation package is for Mambo CMS!';
public $A_INST_OLDER = 'Installation package is for a prior Elxis version (%s) than yours (%s)';
public $A_INST_NEWER = 'Installation package is for a newer Elxis version (%s) than yours (%s)';
//2009.0
public $A_INST_DOINEDC = 'Download and install from Elxis Downloads Center';
public $A_INST_FETCHAVEXTS = 'Fetch list of available extensions';
public $A_INST_MORE = 'More';
public $A_INST_LESS = 'Less';
public $A_INST_SIZE = 'Size';
public $A_INST_DOWNLOAD = 'Download';
public $A_INST_DOWNLOADS = 'Downloads';
public $A_INST_DOWNINST = 'Download and install';
public $A_INST_LICENSE = 'License';
public $A_INST_COMPAT = 'Compatibility';
public $A_INST_DATESUB = 'Date submitted';
public $A_INST_SUREINST = 'Are you sure you wish to install %s ?'; //translators help: filled in be extension title
//2009.2
public $A_INST_UPTODATE = 'Up-to-date';
public $A_INST_OUTDATED = 'Outdated';
public $A_INST_INSTVERS = 'Installed version';
public $A_INST_UNLOAD = 'Unload';
public $A_INST_EDCUPDESC = 'List of the installed third party extensions and their update status.<br />
	The information is taken live from the <a href="http://www.elxis-downloads.com/" title="EDC" target="_blank">Elxis Downloads Center</a>.<br />
	In order for the versioning check to be successuful your web site must be able to connect to the <strong>EDC</strong> remote center.';
public $A_INST_EDCUPNOR = "Version check returned nothing.<br />
	Most probably you do not have any third party %s installed."; //translators help: filled in be extension type (i.e. module)

}

?>