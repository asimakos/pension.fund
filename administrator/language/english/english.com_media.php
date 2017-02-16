<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ioannis Sannos
* @link: http://www.elxis.org
* @email: info@elxis.org
* @description: English language for component media
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_ME_RELPATH = 'Relative path';
public $A_CMP_ME_PMOUSEVD = 'Hover your mouse over a file icon to view its details';
public $A_CMP_ME_RENAME = 'Rename';
public $A_CMP_ME_COPYTO = 'Copy to';
public $A_CMP_ME_NEWFOL = 'New Folder';
public $A_CMP_ME_NEWFIL = 'New File';
public $A_CMP_ME_OPEN = 'Open';
public $A_CMP_ME_VTHUMBS = 'Thumbnails View';
public $A_CMP_ME_VICONS = 'Icons View';
public $A_CMP_ME_DBCLOP = 'Double click to Open:';
public $A_CMP_ME_DIRNEX = 'Directory <strong>%s</strong> does not exist!';
public $A_CMP_ME_FILNEX = 'File <strong>%s</strong> does not exist!';
public $A_CMP_ME_PERMS = 'Permissions';
public $A_CMP_ME_MODIF = 'Modified';
public $A_CMP_ME_ACCESSED = 'Accessed';
public $A_CMP_ME_DOWNZIP = 'Download as zip';
public $A_CMP_ME_DODOWN = 'Do you want to download folder';
public $A_CMP_ME_ASZIP = 'as zip?';
public $A_CMP_ME_EXTHERE = 'Extract here';
public $A_CMP_ME_SELFNIMG = 'Selected file is not an image!';
public $A_CMP_ME_FSELFCL = 'First select a file by clicking on it';
public $A_CMP_ME_RENEWFN = 'Rename - Enter the new file name:';
public $A_CMP_ME_EXFINAME = 'There is already a file named %s !';
public $A_CMP_ME_EXFONAME = 'There is already a folder named %s !';
public $A_CMP_ME_FIRENTO = 'File <strong>"%s"</strong> renamed to <strong>"%s"</strong>';
public $A_CMP_ME_FORENTO = 'Folder <strong>"%s"</strong> renamed to <strong>"%s"</strong>';
public $A_CMP_ME_RENFAIL = 'Rename failed!';
public $A_CMP_ME_ALLFIFODEL = 'All files/folders in this folder will be deleted!';
public $A_CMP_ME_DELQUEST = 'Delete "%s"?';
public $A_CMP_ME_FIDELSUC = 'File deleted successfully';
public $A_CMP_ME_FODELSUC = 'Folder deleted successfully';
public $A_CMP_ME_DELFAIL = 'Delete Failed!';
public $A_CMP_ME_COPYTOFO = 'Copy to folder:';
public $A_CMP_ME_SRCNEX = 'Source file does not exist!';
public $A_CMP_ME_SRCISDIR = 'SOURCE IS A DIRECTORY! YOU CANNOT COPY DIRECTORIES.';
public $A_CMP_ME_EXFIINDIR = 'There is already a file named <strong>%s</strong> in directory %s';
public $A_CMP_ME_FICOPYSUC = 'File <strong>%s</strong> copied successfully to directory %s';
public $A_CMP_ME_FICOPYSUC2 = 'File <strong>%s</strong> copied successfully to directory %s as <strong>%s</strong>';
public $A_CMP_ME_FICOPYFAIL = 'Could not copy <strong>%s</strong> to directory %s';
public $A_CMP_ME_NEWFONAME = 'Enter the new folder name:';
public $A_CMP_ME_CHPERMS = 'Change permissions';
public $A_CMP_ME_SIZE = 'Size';
public $A_CMP_ME_DIMS = 'Dimensions';
public $A_CMP_ME_NAMENEWFO = 'You must give a name to the new folder!';
public $A_CMP_ME_FOCRESUC = 'Folder <strong>%s</strong> created successfully';
public $A_CMP_ME_CNCRNEWFO = 'Could not create new folder!';
public $A_CMP_ME_INVPERMS = 'Invalid permissions!';
public $A_CMP_ME_PERMCHSUC = 'File permission changed successfully to <strong>%s</strong>';
public $A_CMP_ME_CHMODFAIL = 'Change mode failed!';
public $A_CMP_ME_SELFIUP = 'Select the file to upload';
public $A_CMP_ME_SELFNFLV = 'Selected file is not a flash video (flv)!';
public $A_CMP_ME_PLAY = 'Play';
public $A_CMP_ME_SELFNMP3 = 'Selected file is not mp3!';
public $A_CMP_ME_EXTRZIP = 'Extract Zip';
public $A_CMP_ME_EXTRCUFO = 'Extract all files from %s to the current folder?';
public $A_CMP_ME_FINOZIP = 'File <strong>%s</strong> is not a zip file!';
public $A_CMP_ME_UNERREXT = 'Unexpected error during extraction!';
public $A_CMP_ME_FIEXTRD = 'files were extracted.';
public $A_CMP_ME_REFVIEW = 'Refresh to view them';
public $A_CMP_ME_DOWNLOAD = 'Download';
public $A_CMP_ME_TODOWNCL = 'To download this file click the filename below its icon.';
public $A_CMP_ME_RESIZE = 'Resize';
public $A_CMP_ME_FINORES = 'Selected file is not resizable!';
public $A_CMP_ME_RESTO = 'Resize to';
public $A_CMP_ME_KEEPRAT = 'Keep aspect ratio';
public $A_CMP_ME_BASEWID = 'Based on image width';
public $A_CMP_ME_INVWNIMG = 'Invalid width for the new image!';
public $A_CMP_ME_INVHNIMG = 'Invalid height for the new image!';
public $A_CMP_ME_IMGRESSUC = 'Image resized successfully!';
public $A_CMP_ME_CNOTRESIMG = 'Could not resize image!';
public $A_CMP_ME_IE6UPGRADE = '<strong>You are using Internet Explorer 6!</strong> Please upgrade to IE7 or use <a href="http://www.mozilla.com" target="_blank">Firefox</a>.'; 
public $A_CMP_ME_USEFIREFOX = 'For best performance please use <a href="http://www.mozilla.com" target="_blank">Firefox</a>.';
public $A_CMP_ME_WATERMARK = 'Watermark';
public $A_CMP_ME_CNOTWATERF = 'You can not place a watermark on this file!';
public $A_CMP_ME_TEXT = 'Text';
public $A_CMP_ME_FONT = 'Font';
public $A_CMP_ME_OPACITY = 'Opacity';
public $A_CMP_ME_WATERPOS = 'Watermark position';
public $A_CMP_ME_XAXIS = 'X-axis';
public $A_CMP_ME_YAXIS = 'Y-axis';
public $A_CMP_ME_COLOR = 'Color';
public $A_CMP_ME_IMGQUAL = 'Image quality';
public $A_CMP_ME_SAVEAS = 'Save as...';
public $A_CMP_ME_BLACK = 'Black';
public $A_CMP_ME_WHITE = 'White';
public $A_CMP_ME_RED = 'Red';
public $A_CMP_ME_BLUE = 'Blue';
public $A_CMP_ME_ORANGE = 'Orange';
public $A_CMP_ME_YELLOW = 'Yellow';
public $A_CMP_ME_GREEN = 'Green';
public $A_CMP_ME_GRAY = 'Gray';
public $A_CMP_ME_LGRAY = 'Light gray';
public $A_CMP_ME_SHADOW = 'Shadow';
public $A_CMP_ME_NOSHADOW = 'No shadow';
public $A_CMP_ME_NEWFDIFOLD = 'New filename has different extension from the original!';
public $A_CMP_ME_OVERIMGNEX = 'Overlay image does not exist!';
public $A_CMP_ME_WATERGENSUC = 'Watermark image generated successfully.<br />Close this window and refresh media manager to see the new image.';
public $A_CMP_ME_CNOTGENWAT = '<strong>Could not generate watermark image!</strong><br />This feature requires GD and FreeType PHP libraries.';
public $A_CMP_ME_MEMANG = 'Media Manager';
public $A_CMP_ME_UPLOAD = 'Upload';
public $A_CMP_ME_VALFTYPES = 'Valid Filetypes';
public $A_CMP_ME_VIDEO = 'Video';
public $A_CMP_ME_AUDIO = 'Audio';
public $A_CMP_ME_OTHER = 'Other';

}

?>
