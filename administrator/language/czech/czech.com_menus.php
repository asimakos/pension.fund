<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: PARACOM Software
* @link: http://www.elxis.cz
* @email: info@elxis.cz
* @description: Czech language for component menus
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_MU_MANAGER = 'Správce menu';
public $A_CMP_MU_MXLVLS = 'Maximální úrovně';
public $A_CMP_MU_CANTDEL ='* Vaše volba \'delete\' je menu, které potřebuje Elxis ke své činnosti *';
public $A_CMP_MU_MANHOME = '* První položka v tomto menu [mainmenu] je výchozí \'Homepage\' pro tyto stránky *';
public $A_CMP_MU_MITEM = 'Položka menu';
public $A_CMP_MU_NSMTG = '* Všimněte si, že některý typ menu se vyskytuje vícekrát v některých skupinách, ale vždy se jedná o stejný typ menu.';
public $A_CMP_MU_MITYP = 'Typ položky menu';
public $A_CMP_MU_WBLV = 'Co je \'Blog\' zobrazení';
public $A_CMP_MU_WTLV = 'Co je \'Table\' zobrazení';
public $A_CMP_MU_WLIV = 'Co je \'List\' zobrazení';
public $A_CMP_MU_SMTAP = '* Některé \'Menu Types\' se objeví více než jednou ve skupině *';
public $A_CMP_MU_MOVEITS = 'Přesunout položku menu';
public $A_CMP_MU_MOVEMEN = 'Přesunout do menu';
public $A_CMP_MU_BEINMOV = 'Položky menu k přesunutí';
public $A_CMP_MU_COPYITS = 'Kopírovat položky menu';
public $A_CMP_MU_COPYMEN = 'Kopírovat do menu';
public $A_CMP_MU_BCOPIED = 'Položky pro zkopírování';
public $A_CMP_MU_EDNEWSF = 'Upravit tento Newsfeed';
public $A_CMP_MU_EDCONTA = 'Upravit tento kontakt';
public $A_CMP_MU_EDCONTE = 'Upravit tento článek';
public $A_CMP_MU_EDSTCONTE = 'Upravit tuto autonomní stránku';
public $A_CMP_MU_MSGITSAV = 'Položka menu uložena';
public $A_CMP_MU_MOVEDTO = ' Položka menu přesunuta do ';
public $A_CMP_MU_COPITO = ' Položka menu zkopírována do ';
public $A_CMP_MU_THMOD = 'Modul';
public $A_CMP_MU_SCITLKT = 'Musíte zvolit komponent pro odkaz do';
public $A_CMP_MU_COMPLLTO = 'Komponenta pro odkaz';
public $A_CMP_MU_ITEMNAME = 'Položka musí mít jméno';
public $A_CMP_MU_PLSELCMP = 'Prosím zvolte komponent';
public $A_CMP_MU_PARAVAI = 'Seznam parametrů bude k dispozici až po uložení položky';
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
public $A_CMP_MU_MIBGCC = 'Blog - Content Category';
public $A_CMP_MU_MITCG = 'Table - Contact Category'; 
public $A_CMP_MU_MICOMP = 'Component';
public $A_CMP_MU_MIBGCS = 'Blog - Content Section';
public $A_CMP_MU_MILCMPI = 'Link - Component Item';
public $A_CMP_MU_MILCI = 'Link - Contact Item';
public $A_CMP_MU_MITBCC = 'Table - Content Category';
public $A_CMP_MU_MILCEI = 'Link - Content Item';
public $A_CMP_MU_COTLINK = 'Content to Link';
public $A_CMP_MU_MITBCS = 'Table - Content Section';
public $A_CMP_MU_MILSTC = 'Link - Autonomous Page';
public $A_CMP_MU_MITBNFC = 'Table - Newsfeed Category';
public $A_CMP_MU_MILNEW = 'Link - Newsfeed';
public $A_CMP_MU_MISEP = 'Separator / Placeholder';
public $A_CMP_MU_MILIURL = 'Link - URL';
public $A_CMP_MU_MITBWC = 'Table - Weblink Category';
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