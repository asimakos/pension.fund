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
* @description: English language for component content
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_CNT_ITEMSMNG = 'Content Items Manager';
public $A_CMP_CNT_DATEFORMAT = 'Y-m-d h:i:s';
public $A_CMP_CNT_ALTEDITCONT = 'Edit Content';
public $A_CMP_CNT_TRASH = 'Please make a selection from the list to send to Trash';
public $A_CMP_CNT_TRASHMESS = 'Are you sure you want to Trash the selected item(s)? \nThis will not permanently delete the item(s).';
public $A_CMP_CNT_ARCHMANAGER = 'Archive Manager';
public $A_CMP_CNT_DATECREATED = '%A, %d %B %Y %H:%M';
public $A_CMP_CNT_DATEMODIFIED = '%A, %d %B %Y %H:%M';
public $A_CMP_CNT_MUSTTITLE = 'Content Item must have a title.';
public $A_CMP_CNT_MUSTSECTN = 'You must select a Section.';
public $A_CMP_CNT_MUSTCATEG = 'You must select a Category.';
public $A_CMP_CNT_CONTITEM = 'Content Item';
public $A_CMP_CNT_ITEMDETLS = 'Item Details';
public $A_CMP_CNT_INTRO = 'Intro Text: (required)';
public $A_CMP_CNT_MAIN = 'Main Text: (optional)';
public $A_CMP_CNT_FRONTPAGE = 'Show on Frontpage';
public $A_CMP_CNT_AUTHOR = 'Author Alias';
public $A_CMP_CNT_CREATOR = 'Change Creator';
public $A_CMP_CNT_OVERRIDE = 'Override Created Date';
public $A_CMP_CNT_STRTPUB = 'Start Publishing';
public $A_CMP_CNT_FNSHPUB = 'Finish Publishing';
public $A_CMP_CNT_DRFTUNPUB = 'Draft Unpublished';
public $A_CMP_CNT_RESETHIT = 'Reset Hit Count';
public $A_CMP_CNT_REVISED = 'Revised';
public $A_CMP_CNT_TIMES = 'times';
public $A_CMP_CNT_BY = 'By';
public $A_CMP_CNT_NEWDOC = 'New Document';
public $A_CMP_CNT_LASTMOD = 'Last Modified';
public $A_CMP_CNT_NOTMOD = 'Not Modified';
public $A_CMP_CNT_ADDETC = 'Add Sect/Cat/Title';
public $A_CMP_CNT_LINKCI = 'This will create a \'Link - Content Item\' in the menu you select';
public $A_CMP_CNT_SOMTHING = 'Please select something';
public $A_CMP_CNT_MVEITEMS = 'Move Items';
public $A_CMP_CNT_MVESECCAT = 'Move to Section/Category';
public $A_CMP_CNT_ITMSMVED = 'Items being Moved';
public $A_CMP_CNT_SECCAT = 'Please select a Section/Category to copy the Items to';
public $A_CMP_CNT_CPYITEMS = 'Copy Content Items';
public $A_CMP_CNT_CPYSECCAT = 'Copy to Section/Category';
public $A_CMP_CNT_ITMSCPED = 'Items being copied';
public $A_CMP_CNT_CCHECL = 'Cache Cleaned';
public $A_CMP_CNT_CANNOT = 'You cannot edit an archived item';
public $A_CMP_CNT_THMODULIS = 'The module';
public $A_CMP_CNT_DROWCRED = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_DROWMOD = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_DROWPUB = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_PBLINEV = 'Never';
public $A_CMP_CNT_DPUBLISHUP = 'Y-m-d';
public $A_CMP_CNT_SLSECTN = 'Select Section';
public $A_CMP_CNT_SELCAT = 'Select Category';
public $A_CMP_CNT_ARCHVED = 'Item(s) successfully Archived';
public $A_CMP_CNT_PUBLSHED = 'Item(s) successfully Published';
public $A_CMP_CNT_ITSUUNP = 'Item(s) successfully Unpublished';
public $A_CMP_CNT_ITSUUNA = 'Item(s) successfully Unarchived';
public $A_CMP_CNT_SELITOG = 'Select an item to toggle';
public $A_CMP_CNT_SELIDEL = 'Select an item to delete';
public $A_CMP_CNT_ERROCCRD = 'An error has occurred';
public $A_CMP_CNT_MOVD = 'Item(s) successfully moved to Section';
public $A_CMP_CNT_COPED = 'Item(s) successfully copied to Section';
public $A_CMP_CNT_RSTHTCNT = 'Successfully Reset Hit count for';
public $A_CMP_CNT_INMENU = '(Link - Autonomous Page) in menu';
public $A_CMP_CNT_SUCCSS = 'successfully created';
public $A_CMP_CNT_RSZERO = 'Are you sure you want to reset the Hits to Zero? \nAny unsaved changes to this content will be lost.';
public $A_CMP_CNT_MUST_CIMNA = 'Content Item must have a name';
public $A_CMP_CNT_SITMAPFOR = 'Site Map for';
public $A_CMP_CNT_ALLLANGS = 'All Languages';
public $A_CMP_CNT_LANG = 'language';
public $A_CMP_CNT_PHRENAME = 'Press and hold to rename';
public $A_CMP_CNT_EDITITEM = 'Edit Item';
public $A_CMP_CNT_NOTES = 'Notes';
public $A_CMP_CNT_PRSHREN = 'Press and hold Item to rename';
public $A_CMP_CNT_EMPCATSEC = 'Tree does not display empty sections and categories.';
public $A_CMP_CNT_TREEUNPUBL = 'Items marked with grey color and italic are unpublished';
public $A_CMP_CNT_NULLVAL = 'Null value supplied!';
public $A_CMP_CNT_INCCTP = 'Invalid content type';
public $A_CMP_CNT_CLDNFETCH = 'Could not fetch data';
public $A_CMP_CNT_TRSELPAIR = 'Please select a language pair';
public $A_CMP_CNT_TRSOUDEST = 'Select Source and Destination Languages';
public $A_CMP_CNT_TRITEMS = 'Item Being Translated';
public $A_CMP_CNT_TRNOTE = '<strong>Elxis Note:</strong> Select carefully source and destination languages. This procedure may take 
        a while depending on the size of the translation text.<br />
        Translation is based on Altavista free online machine translation services.
        Elxis is not responsible for the translation quality.';
public $A_CMP_CNT_TRSELITEM = 'Select an Item to translate';
public $A_CMP_CNT_TROKSAVED = 'Item successfully translated and copied';
public $A_CMP_CNT_TRITMNOTF = 'Selected Item not fount in database!';
public $A_CMP_CNT_MFS = 'Message from server';
public $A_CMP_CNT_WID = 'with id';
public $A_CMP_CNT_RNMTO = 'renamed to';
public $A_CMP_CNT_FL= 'Filter Language';
public $A_CMP_CNT_CONFL = 'Language Conflict';
public $A_CMP_CNT_CONFI = 'Item is in a category with language settings that does not allow it to be displayed!';
public $A_CMP_CNT_STARTALW = 'Start: Always';
public $A_CMP_CNT_FINNOEXP = 'Finish: No Expiry';
public $A_CMP_CNT_FINISH = 'Finish';
public $A_CMP_CNT_FROM = 'from';
public $A_CMP_CNT_SHOWHIDE = 'Show/Hide';
public $A_SIMPLEVIEW = 'Simple View';
public $A_EXTENDVIEW = 'Extended View';
public $A_CMP_CNT_COMMENTS = 'Comments';
public $A_CMP_CNT_SAVTRANS = 'Item transferred and saved as site\'s content';
public $A_CMP_CNT_RELLINKS = 'Related links';
public $A_CMP_CNT_RELLINKSD = 'Related to this article links. If you wish to add external links, please add the http:// prefix in the URL.';

}

?>
