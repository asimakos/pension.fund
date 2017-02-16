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
* @description: English language for component menus
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_MU_MANAGER = 'Menus Manager';
public $A_CMP_MU_MXLVLS = 'Max Levels';
public $A_CMP_MU_CANTDEL ='* You cannot \'delete\' this menu as it is required for the proper operation of Elxis *';
public $A_CMP_MU_MANHOME = '* The 1st Published item in this menu [mainmenu] is the default \'Homepage\' for the site *';
public $A_CMP_MU_MITEM = 'Menu Item';
public $A_CMP_MU_NSMTG = '* Note that some menu types appear in more than one groups, but they are still the same menu type.';
public $A_CMP_MU_MITYP = 'Menu Item Type';
public $A_CMP_MU_WBLV = 'What is a \'Blog\' view';
public $A_CMP_MU_WTLV = 'What is a \'Table\' view';
public $A_CMP_MU_WLIV = 'What is a \'List\' view';
public $A_CMP_MU_SMTAP = '* Some \'Menu Types\' appear in more than one group *';
public $A_CMP_MU_MOVEITS = 'Move Menu Items';
public $A_CMP_MU_MOVEMEN = 'Move to Menu';
public $A_CMP_MU_BEINMOV = 'Menu Items being moved';
public $A_CMP_MU_COPYITS = 'Copy Menu Items';
public $A_CMP_MU_COPYMEN = 'Copy to Menu';
public $A_CMP_MU_BCOPIED = 'Menu Items being copied';
public $A_CMP_MU_EDNEWSF = 'Edit this Newsfeed';
public $A_CMP_MU_EDCONTA = 'Edit this Contact';
public $A_CMP_MU_EDCONTE = 'Edit this Content';
public $A_CMP_MU_EDSTCONTE = 'Edit this Autonomous Page';
public $A_CMP_MU_MSGITSAV = 'Menu item Saved';
public $A_CMP_MU_MOVEDTO = ' Menu Items moved to ';
public $A_CMP_MU_COPITO = ' Menu Items copied to ';
public $A_CMP_MU_THMOD = 'The module';
public $A_CMP_MU_SCITLKT = 'You must select a Component to link to';
public $A_CMP_MU_COMPLLTO = 'Component to Link';
public $A_CMP_MU_ITEMNAME = 'Item must have a name';
public $A_CMP_MU_PLSELCMP = 'Please select a Component';
public $A_CMP_MU_PARAVAI = 'Parameters list will be available after you save this New menu item';
public $A_CMP_MU_YSELCAT = 'You must select a category';
public $A_CMP_MU_TMHTITL = 'This Menu item must have a title';
public $A_CMP_MU_TABLE = 'Table';
public $A_CMP_MU_CCTBLANK = 'If you leave this blank, the Category name will be automatically used';
public $A_CMP_MU_LNKHNAME = 'Link must have a name';
public $A_CMP_MU_SELCONT = 'You must select a Contact to link to';
public $A_CMP_MU_CONLINK = 'Contact to Link:';
public $A_CMP_MU_ONCLOPI = 'On Click, Open in';
public $A_CMP_MU_THETITL = 'Title:';
public $A_CMP_MU_YMSSECT = 'You must select a Section';
public $A_CMP_MU_ILBLSEC = 'If you leave this blank, the Section name will be automatically used';
public $A_CMP_MU_YCSMC = 'You can select multiple Categories';
public $A_CMP_MU_YCSMS = 'You can select multiple Sections';
public $A_CMP_MU_EDCOI = 'Edit Content Item';
public $A_CMP_MU_YMSLT = 'You must select a Content to link to';
public $A_CMP_MU_STACONT = 'Autonomous Page Content';
public $A_CMP_MU_ONCLOP = 'On Click, open';
public $A_CMP_MU_YSNWLT = 'You must select a Newsfeed to link to';
public $A_CMP_MU_NEWTL = 'Newsfeed to Link';
public $A_CMP_MU_SEPER = '- - - - - - -'; //Change this, if you want to change the symbols for seperator line
public $A_CMP_MU_PATNAM = 'Pattern/Name';
public $A_CMP_MU_WRURL = 'You must provide a url.';
public $A_CMP_MU_WRLINK = 'Wrapper Link';
public $A_CMP_MU_MIBGCC = 'Content Category (blog view)';
public $A_CMP_MU_MITCG = 'Contact Category (table view)'; 
public $A_CMP_MU_MICOMP = 'Component';
public $A_CMP_MU_MIBGCS = 'Content Section (blog view)';
public $A_CMP_MU_MILCMPI = 'Link to Component Item';
public $A_CMP_MU_MILCI = 'Link to Contact Item';
public $A_CMP_MU_MITBCC = 'Content Category (table view)';
public $A_CMP_MU_MILCEI = 'Link to Content Item';
public $A_CMP_MU_COTLINK = 'Content to Link';
public $A_CMP_MU_MITBCS = 'Content Section (table view)';
public $A_CMP_MU_MILSTC = 'Link to Autonomous Page';
public $A_CMP_MU_MITBNFC = 'Newsfeed Category (table view)';
public $A_CMP_MU_MILNEW = 'Link to Newsfeed';
public $A_CMP_MU_MISEP = 'Separator / Placeholder';
public $A_CMP_MU_MILIURL = 'Link - URL';
public $A_CMP_MU_MITBWC = 'Weblink Category (table view)';
public $A_CMP_MU_MIWRAP = 'Wrapper';
public $A_CMP_MU_ITEM = 'Item';
public $A_CMP_MU_UMSBRI = 'You must select a Bridge';
public $A_CMP_MU_BRINOINS = 'Component Bridge is not Installed!';
public $A_CMP_MU_NOPUBBRI = 'There are no published Bridges!';
public $A_CMP_MU_CLVSEO = 'Click an autonomous page to view it\'s SEO title';
public $A_CMP_MU_SYSLINK = 'System link';
public $A_CMP_MU_SYSLINKD = 'A System Link should normally belong to a published menu set in a module position that does NOT exist in the template!';
public $A_CMP_MU_PASSR = 'Password remind';
public $A_CMP_MU_UREG = 'User registration';
public $A_CMP_MU_REGCOMP = 'Registration complete';
public $A_CMP_MU_ACCACT = 'Account activation';
public $A_CMP_MU_MSLINK = 'You must select a system link.';
public $A_CMP_MU_SELLINK = '- Select link -';
public $A_CMP_MU_DONTDEL ='* Don\'t delete this menu as it makes better Elxis operation. Make sure to be published in a module position that does NOT exist in the template! *';
public $A_CMP_MU_EDPROF = 'Edit profile';
public $A_CMP_MU_SUBWEBL = 'Submit weblink';
public $A_CMP_MU_CHECKIN = 'Checkin';
public $A_CMP_MU_USERLIST = 'Users list';
public $A_CMP_MU_POLLS = 'Polls';
public $A_CMP_MU_SELBLOG = 'You must select a blog to link to';
public $A_CMP_MU_BLOGLINK = 'Blog to Link';

}

?>