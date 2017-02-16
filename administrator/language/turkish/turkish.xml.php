<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin/XML Language
* @author: Elxis Team
* @translator: Mustafa Aydemir
* @link: http://www.elxisturkiye.org
* @email: ahdes@elxisturkiye.org
* @description: Turkish Language for XML files
* @note: All values used in admin XML files start with 'AX_'
* @note 2008: values for custom language strings defined as php contants start with 'CX_' (not in this file!)
* @license: http://www.gnu.org/copySol/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* 
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
* 
*/

defined( '_VALID_MOS' ) or die( 'Bu alana doğrudan erişim engellenmiştir.' );


class xmlLanguage extends standardLanguage {

public function get($a) {
	if ( is_numeric($a) ) { return $a; }
	$pref = strtoupper(substr($a,0,3));
    if ($pref == 'AX_') {
        return $this->$a;
    } elseif (($pref == 'CX_') && defined($a)) {
        return constant($a);
	} else { return $a; }
}

protected $AX_MENUIMGL = 'Menü Resmi';
protected $AX_MENUIMGD = 'A small resim to be placed to the Sol or Sağ of your menu item. resims must be in resims/stories/ directory.';
protected $AX_MENUIMGONLYL = 'Sadece Menü Resmi Kullan';
protected $AX_MENUIMGONLYD = 'If you select <strong>Yes</strong> then the menu item will be represented ONLY by the resim you have selected.<br /><br />If you select <strong>No</strong> then the menu item will be represented by the resim you have selected PLUS the text.';
protected $AX_MENUIMG2D = 'A small resim to be placed to the Sol or Sağ of your menu item. resims must be in /resims directory.';
protected $AX_PAGCLASUFL = 'Page Class Suffix';
protected $AX_PAGCLASUFD = 'A suffix to be applied to the css classes of the page, this allows individual page styling.';
protected $AX_TEXTPAGECL = 'Article Suffix';
protected $AX_TEXTPAGECLD = 'A suffix to be applied to the css class of the article, this allows individual Article/Content Item styling.';
protected $AX_BACKBUTL = 'Geri Butonu';
protected $AX_BACKBUTD = 'Göster/Gizle a Back Button, that returns you to the previously view page.';
protected $AX_USEGLB = 'Use Global';
protected $AX_Gizle = 'Gizle';
protected $AX_Göster = 'Göster';
protected $AX_AUTO = 'Auto';
protected $AX_PAGTITLSL = 'Sayfa başlığı göster';
protected $AX_PAGTITLSD = 'Sayfa başlığını Göster/Gizle.';
protected $AX_PAGTITLL = 'Sayfa Başlığı';
protected $AX_PAGTITLD = 'Text to display at the Üst of the page. If Sol blank, the Menu name will be used instead.';
protected $AX_PAGTITL2D = 'Text to display at the Üst of the page.';
protected $AX_Sol = 'Sol';
protected $AX_Sağ = 'Sağ';
protected $AX_PRNTICOL = 'Yazıcı Simgesi';
protected $AX_PRNTICOD = 'Göster/Gizle the item print button - only affects this page.';
protected $AX_YES = 'Evet';
protected $AX_NO = 'Hayır';
protected $AX_SECNML = 'Bölüm adı';
protected $AX_SECNMD = 'Göster/Gizle the Bölüm the item belongs to.';
protected $AX_SECNMLL = 'Bölüm Name Linkable';
protected $AX_SECNMLD = 'Make the Bölüm text a link to the actual Bölüm page.';
protected $AX_CATNML = 'Kategori adı';
protected $AX_CATNMD = 'Göster/Gizle the Category the item belongs to.';
protected $AX_CATNMLL = 'Category Name Linkable';
protected $AX_CATNMLD = 'Make the Category text a link to the actual Category page.';
protected $AX_LNKTTLL = 'Linked Titles';
protected $AX_LNKTTLD = 'Make your Item titles linkable.';
protected $AX_ITMRATL = 'Item Rating';
protected $AX_ITMRATD = 'Göster/Gizle the item rating - only affects this page.';
protected $AX_AUTNML = 'Yazar adları';
protected $AX_AUTNMD = 'Göster/Gizle the item author - only affects this page.';
protected $AX_CTDL = 'Created Date and Time';
protected $AX_CTDD = 'Göster/Gizle the item creation date - only affects this page.';
protected $AX_MTDL = 'Modified Date and Time';
protected $AX_MTDD = 'Göster/Gizle the item modification date - only affects this page.';
protected $AX_PDFICL = 'PDF Simgesi';
protected $AX_PDFICD = 'Göster/Gizle the item PDF button - only affects this page.';
protected $AX_PRICL = 'Yazıcı Simgesi';
protected $AX_PRICD = 'Göster/Gizle the item print button - only affects this page.';
protected $AX_EMICL = 'Eposta Simgesi';
protected $AX_EMICD = 'Göster/Gizle the item Eposta button - only affects this page.';
protected $AX_FTITLE = 'Başlık';
protected $AX_FAUTH = 'YAzar';
protected $AX_FHITS = 'Tıklamalar';
protected $AX_DESCRL = 'Açıklama';
protected $AX_DESCRD = 'Göster/Gizle the Description below.';
protected $AX_DESCRTXL = 'Açıklama Metni';
protected $AX_DESCRTXD = 'Description for page, if Sol blank it will load _WEBLINKS_DESC from your language file';
protected $AX_resimL = 'Resim';
protected $AX_IMGFRPD = 'resim for page, must be located in the /resims/stories directory. By default it will load web_links.jpg. -Do not use an resim- means that an resim is not loaded.';
protected $AX_IMGALL = 'resim Align';
protected $AX_IMGALD = 'Alignment of the resim.';
protected $AX_TBHEADL = 'Table Headings';
protected $AX_TBHEADD = 'Göster/Gizle the Table Headings.';
protected $AX_POSCOLL = 'Position Column';
protected $AX_POSCOLD = 'Göster/Gizle the Position column.';
protected $AX_EpostaCOLL = 'Eposta Column';
protected $AX_EpostaCOLD = 'Göster/Gizle the Eposta column.';
protected $AX_TELCOLL = 'Telephone Column';
protected $AX_TELCOLD = 'Göster/Gizle the Telephone column.';
protected $AX_FAXCOLL = 'Fax Column';
protected $AX_FAXCOLD = 'Göster/Gizle the Fax column.';
protected $AX_LEADINGL = '# Leading';
protected $AX_LEADINGD = 'Number of Items to be displayed as a leading (full width) items. 0 means that no items will be displayed as leading.';
protected $AX_INTROL = '# Intro';
protected $AX_INTROD = 'Number of Items to be displayed with the introduction text Göstern.';
protected $AX_COLSL = 'Columns';
protected $AX_COLSD = 'Select how many columns to use per row when displaying the intro text.';
protected $AX_LNKSL = '# Links';
protected $AX_LNKSD = 'Number of Items to display as Links.';
protected $AX_CATORL = 'Category Order';
protected $AX_CATORD = 'Order items by category.';
protected $AX_OCAT01 = 'No, order by Primary Order only';
protected $AX_OCAT02 = 'Title Alphabetical';
protected $AX_OCAT03 = 'Title Reverse-Alphabetical';
protected $AX_OCAT04 = 'Ordering';
protected $AX_PRMORL = 'Primary Order';
protected $AX_PRMORD = 'Order that the items will be displayed in.';
protected $AX_OPRM01 = 'Default';
protected $AX_OPRM02 = 'Frontpage Ordering';
protected $AX_OPRM03 = 'Oldest first';
protected $AX_OPRM04 = 'Most recent first';
protected $AX_OPRM07 = 'Author Alphabetical';
protected $AX_OPRM08 = 'Author Reverse-Alphabetical';
protected $AX_OPRM09 = 'Most Hits';
protected $AX_OPRM10 = 'Least Hits';
protected $AX_PAGL = 'Pagination';
protected $AX_PAGD = 'Göster/Gizle Pagination support.';
protected $AX_PAGRL = 'Pagination Results';
protected $AX_PAGRD = 'Göster/Gizle Pagination Results info ( e.g 1-4 of 4 ).';
protected $AX_MOSIL = 'MOSresims';
protected $AX_MOSID = 'Display {mosresims}.';
protected $AX_ITMTL = 'Item Titles';
protected $AX_ITMTD = 'Göster/Gizle the items title.';
protected $AX_REMRL = 'Read More';
protected $AX_REMRD = 'Göster/Gizle the Read More link.';
protected $AX_OTHCATL = 'Other Kategori';
protected $AX_OTHCATD = 'When viewing a Category, Göster/Gizle the list of other Kategori.';
protected $AX_TDISTPD = 'Text to display at the Üst of the page.';
protected $AX_ORDBYL = 'Order by';
protected $AX_ORDBYD = 'This overrides the ordering of the items.';
protected $AX_MCS_DESCL = 'Description';
protected $AX_SHCDESD = 'Göster/Gizle the Category Description.';
protected $AX_DESCIL = 'Description resim';
protected $AX_MUDATFL = 'Date Format';
protected $AX_MUDATFD = "The format of the date displayed, using PHP strftime Command Format - if Sol blank it will load the format from your language file.";
protected $AX_MUDATCL = 'Date Column';
protected $AX_MUDATCD = 'Göster or Gizle the Date column.';
protected $AX_MUAUTCL = 'Author Column';
protected $AX_MUAUTCD = 'Göster/Gizle the Author column.';
protected $AX_MUHITCL = 'Hits Column';
protected $AX_MUHITCD = 'Göster/Gizle the Hits column.';
protected $AX_MUNAVBL = 'Navigation Bar';
protected $AX_MUNAVBD = 'Göster/Gizle the Navigation bar.';
protected $AX_MUORDSL = 'Order Select';
protected $AX_MUORDSD = 'Göster/Gizle the Order Select dropdown.';
protected $AX_MUDSPSL = 'Display Select';
protected $AX_MUDSPSD = 'Göster/Gizle the Display Select dropdown.';
protected $AX_MUDSPNL = 'Display Number';
protected $AX_MUDSPND = 'Number of items to be displayed by default.';
protected $AX_MUFLTL = 'Filter';
protected $AX_MUFLTD = 'Göster/Gizle the Filter ability.';
protected $AX_MUFLTFL = 'Filter Field';
protected $AX_MUFLTFD = 'Which field shall the filter apply to.';
protected $AX_MUOCATL = 'Other Kategori';
protected $AX_MUOCATD = 'Göster/Gizle the listing of other Kategori.';
protected $AX_MUECATL = 'Empty Kategori';
protected $AX_MUECATD = 'Göster/Gizle empty (no items) Kategori.';
protected $AX_CATDSCL = 'Category Description';
protected $AX_CATDSBLND = 'Göster/Gizle the Category Description, it will appear below the Category Name.';
protected $AX_NAMCOLL = 'Name Column';
protected $AX_LINKDSCL = 'Link Descriptions';
protected $AX_LINKDSCD = 'Göster/Gizle the Description text of the Links.';
//com_contact/contact.xml
protected $AX_CCT_CDESC = 'This component Gösters a listing of Contact Information.';
protected $AX_CCT_CATLISTSL = 'Category List - Bölüm';
protected $AX_CCT_CATLISTSD = 'Göster/Gizle the List of Kategori in List view page.';
protected $AX_CCT_CATLISTCL = 'Category List - Category';
protected $AX_CCT_CATLISTCD = 'Göster/Gizle the List of Kategori in Table view page.';
protected $AX_CCT_CATDSCD = 'Göster/Gizle the Description for the list of other Kategori.';
protected $AX_CCT_NOCATITL = '# Category Items';
protected $AX_CCT_NOCATITD = 'Göster/Gizle the number of items in each category.';
//com_contact/contact_items.xml
protected $AX_CIT_CDESC = 'Parameters for individual Contact Items.';
protected $AX_CIT_NAMEL = 'Name';
protected $AX_CIT_NAMED = 'Göster/Gizle the name info.';
protected $AX_CIT_POSITL = 'Position';
protected $AX_CIT_POSITD = 'Göster/Gizle the position info.';
protected $AX_CIT_EpostaL = 'Eposta';
protected $AX_CIT_EpostaD = 'Göster/Gizle the Eposta info. If you set it to Göster, the address will be protected from spambots by javascript cloaking.';
protected $AX_CIT_SADDREL = 'Street Address';
protected $AX_CIT_SADDRED = 'Göster/Gizle the street address info.';
protected $AX_CIT_TOWNL = 'Town/Suburb';
protected $AX_CIT_TOWND = 'Göster/Gizle the town/suburb info.';
protected $AX_CIT_STATEL = 'State';
protected $AX_CIT_STATED = 'Göster/Gizle the state info.';
protected $AX_CIT_COUNTRL = 'Country';
protected $AX_CIT_COUNTRD = 'Göster/Gizle the country info.';
protected $AX_CIT_ZIPL = 'Post/Zip Code';
protected $AX_CIT_ZIPD = 'Göster/Gizle the post code info.';
protected $AX_CIT_TELL = 'Telephone';
protected $AX_CIT_TELD = 'Göster/Gizle the telephone info.';
protected $AX_CIT_FAXL = 'Fax';
protected $AX_CIT_FAXD = 'Göster/Gizle the fax info.';
protected $AX_CIT_MISCL = 'Misc Info';
protected $AX_CIT_MISCD = 'Göster/Gizle the misc info.';
protected $AX_CIT_VCARDL = 'Vcard';
protected $AX_CIT_VCARDD = 'Göster/Gizle the Vcard.';
protected $AX_CIT_CIMGL = 'resim';
protected $AX_CIT_CIMGD = 'Göster/Gizle the resim.';
protected $AX_CIT_DEpostaL = 'Eposta description';
protected $AX_CIT_DEpostaD = 'Göster/Gizle the Description Text below.';
protected $AX_CIT_DTXTL = 'Description text';
protected $AX_CIT_DTXTD = 'The Description text for the Eposta form. If Sol blank, it will use the _Eposta_DESCRIPTION language definition.';
protected $AX_CIT_EMFRML = 'Eposta Form';
protected $AX_CIT_EMFRMD = 'Göster/Gizle the Eposta to form.';
protected $AX_CIT_EMCPYL = 'Eposta Copy';
protected $AX_CIT_EMCPYD = 'Göster/Gizle the checkbox to Eposta a copy to senders address.';
protected $AX_CIT_DDL = 'Drop Down';
protected $AX_CIT_DDD = 'Göster/Gizle the Drop Down select list in Contact view.';
protected $AX_CIT_ICONTXL = 'Icons/text';
protected $AX_CIT_ICONTXD = 'Use Icons, text or nothing next to the contact information displayed.';
protected $AX_CIT_ICONS = 'Icons';
protected $AX_CIT_TEXT = 'Text';
protected $AX_CIT_NONE = 'None';
protected $AX_CIT_ADICONL = 'Address Icon';
protected $AX_CIT_ADICOND = 'Icon for the Address info.';
protected $AX_CIT_EMICONL = 'Eposta Icon';
protected $AX_CIT_EMICOND = 'Icon for the Eposta info.';
protected $AX_CIT_TLICONL = 'Telephone Icon';
protected $AX_CIT_TLICOND = 'Icon for the Telephone info.';
protected $AX_CIT_FXICONL = 'Fax Icon';
protected $AX_CIT_FXICOND = 'Icon for the Fax info.';
protected $AX_CIT_MCICONL = 'Misc Icon';
protected $AX_CIT_MCICOND = 'Icon for the Misc info.';
protected $AX_CCT_NAMEL = 'Name';
protected $AX_CCT_NAMED = 'Göster/Gizle the name info.';
protected $AX_CCT_POSITL = 'Position';
protected $AX_CCT_POSITD = 'Göster/Gizle the position info.';
protected $AX_CCT_EpostaL = 'Eposta';
protected $AX_CCT_EpostaD = 'Göster/Gizle the Eposta info. If you set to Göster, the address will be protected from spambots by javascript cloaking.';
protected $AX_CCT_SADDREL = 'Street Address';
protected $AX_CCT_SADDRED = 'Göster/Gizle the street address info.';
protected $AX_CCT_TOWNL = 'Town/Suburb';
protected $AX_CCT_TOWND = 'Göster/Gizle the suburb info.';
protected $AX_CCT_STATEL = 'State';
protected $AX_CCT_STATED = 'Göster/Gizle the state info.';
protected $AX_CCT_COUNTRL = 'Country';
protected $AX_CCT_COUNTRD = 'Göster/Gizle the country info.';
protected $AX_CCT_ZIPL = 'Post/Zip Code';
protected $AX_CCT_ZIPD = 'Göster/Gizle the post code info.';
protected $AX_CCT_TELL = 'Telephone';
protected $AX_CCT_TELD = 'Göster/Gizle the telephone info.';
protected $AX_CCT_FAXL = 'Fax';
protected $AX_CCT_FAXD = 'Göster/Gizle the fax info.';
protected $AX_CCT_MISCL = 'Misc Info';
protected $AX_CCT_MISCD = 'Göster/Gizle the misc info.';
protected $AX_CCT_VCARDL = 'Vcard';
protected $AX_CCT_VCARDD = 'Göster/Gizle the Vcard.';
protected $AX_CCT_CIMGL = 'resim';
protected $AX_CCT_CIMGD = 'Göster/Gizle the resim.';
protected $AX_CCT_DEpostaL = 'Eposta description';
protected $AX_CCT_DEpostaD = 'Göster/Gizle the Description Text below.';
protected $AX_CCT_DTXTL = 'Description text';
protected $AX_CCT_DTXTD = 'The Description text for the Eposta form. If Sol blank, it will use the _Eposta_DESCRIPTION language definition.';
protected $AX_CCT_EMFRML = 'Eposta Form';
protected $AX_CCT_EMFRMD = 'Göster/Gizle the Eposta to form.';
protected $AX_CCT_EMCPYL = 'Eposta Copy';
protected $AX_CCT_EMCPYD = 'Göster/Gizle the checkbox to Eposta a copy to senders address.';
protected $AX_CCT_DDL = 'Drop Down';
protected $AX_CCT_DDD = 'Göster/Gizle the Drop Down select list in Contact view.';
protected $AX_CCT_ICONTXL = 'Icons/text';
protected $AX_CCT_ICONTXD = 'Use Icons, text, or nothing next to the contact information displayed.';
protected $AX_CCT_ICONS = 'Icons';
protected $AX_CCT_TEXT = 'Text';
protected $AX_CCT_NONE = 'None';
protected $AX_CCT_ADICONL = 'Address Icon';
protected $AX_CCT_ADICOND = 'Icon for the Address info.';
protected $AX_CCT_EMICONL = 'Eposta Icon';
protected $AX_CCT_EMICOND = 'Icon for the Eposta info.';
protected $AX_CCT_TLICONL = 'Telephone Icon';
protected $AX_CCT_TLICOND = 'Icon for the Telephone info.';
protected $AX_CCT_FXICONL = 'Fax Icon';
protected $AX_CCT_FXICOND = 'Icon for the Fax info.';
protected $AX_CCT_MCICONL = 'Misc Icon';
protected $AX_CCT_MCICOND = 'Icon for the Misc info.';
//com_content/content.xml
protected $AX_CNT_CDESC = 'This Gösters a single content page.';
protected $AX_CNT_INTEXTL = 'Intro Text';
protected $AX_CNT_INTEXTD = 'Göster/Gizle the intro text.';
protected $AX_CNT_KEYRL = 'Key Reference';
protected $AX_CNT_KEYRD = 'A text key that an item may be referenced by (like a help reference).';
//com_frontpage/frontpage.xml
protected $AX_FP_CDESC = 'This component Gösters all the published content items from your site marked Göster on Frontpage.';
//com_login/login.xml
protected $AX_LG_CDESC = 'Parameters for individual Contact Items.';
protected $AX_LG_LPTL = 'Login Page Title';
protected $AX_LG_LPTD = 'Text to display at the Üst of the page. If Sol blank, the Menu name will be used instead.';
protected $AX_LG_LRURLL = 'Login Redirection URL';
protected $AX_LG_LRURLD = 'What page will the login redirect to after login. If Sol blank, will load front page.';
protected $AX_LG_LJSML = 'Login JS Message';
protected $AX_LG_LJSMD = 'Göster/Gizle the javascript pop-up, indicating Login Success.';
protected $AX_LG_LDESCL = 'Login Description';
protected $AX_LG_LDESCD = 'Göster/Gizle the Login Description below.';
protected $AX_LG_LDESTL = 'Login Description Text';
protected $AX_LG_LDESTD = 'Text to display on the login Page. If Sol blank, _LOGIN_DESCRIPTION will be used.';
protected $AX_LG_LIMGL = 'Login resim';
protected $AX_LG_LIMGD = 'resim for the Login Page.';
protected $AX_LG_LIMGAL = 'Login resim Align';
protected $AX_LG_LIMGAD = 'Alignment for Login resim.';
protected $AX_LG_LOPTL = 'Logout Page Title';
protected $AX_LG_LOPTD = 'Text to display at the Üst of the page. If Sol blank, the Menu name will be used instead.';
protected $AX_LG_LORURLL = 'Logout Redirection URL';
protected $AX_LG_LORURLD = 'What page will be redirected to after logout, if Sol blank, will load front page.';
protected $AX_LG_LOJSML = 'Logout JS Message';
protected $AX_LG_LOJSMD = 'Göster/Gizle the javascript pop-up indicating Logout Success.';
protected $AX_LG_LODSCL = 'Logout Description';
protected $AX_LG_LODSCD = 'Göster/Gizle the Logout Description below.';
protected $AX_LG_LODSTL = 'Logout Description Text';
protected $AX_LG_LODSTD = 'Text to display on the logout Page. If Sol blank, _LOGOUT_DESCRIPTION will be used.';
protected $AX_LG_LOGOIL = 'Logout resim';
protected $AX_LG_LOGOID = 'resim for the Logout Page.';
protected $AX_LG_LOGOIAL = 'Logout resim Align';
protected $AX_LG_LOGOIAD = 'Alignment for Logout resim.';
//com_massmail/massmail.xml
protected $AX_MM_CDESC = 'This component allows you to send a mass Eposta to certain user groups.';
//com_media/media.xml
protected $AX_ME_CDESC = 'This component manages site media.';
//com_menumanager/menumanager.xml
protected $AX_MNU_CDESC = 'This component manages your Menus.';
//com_menus/component_item_link/component_item_link.xml
protected $AX_MUCIL_CNAME = 'Link - Component Item';
protected $AX_MUCIL_CDESC = 'Creates a link to an existing Elxis Component.';
//com_menus/components/components.xml
protected $AX_MUCOMP_CNAME = 'Component';
protected $AX_MUCOMP_CDESC = 'Displays the frontend interface for a Component.';
//com_menus/contact_category_table/contact_category_table.xml
protected $AX_MUCCT_CNAME = 'Table - Contact Category';
protected $AX_MUCCT_CDESC = 'Gösters a Table view of Contact items for a particular Category.';
protected $AX_MUCCT_CATDL = 'Category Description';
protected $AX_MUCCT_CATDD = 'Göster/Gizle the Description for the list of other Kategori.';
//com_menus/contact_item_link/contact_item_link.xml
protected $AX_MUCTIL_CNAME = 'Link - Contact Item';
protected $AX_MUCTIL_CDESC = 'Creates a link to a Published Contact Item';
//com_menus/content_archive_category/content_archive_category.xml
protected $AX_MUCAC_CNAME = 'Blog - Content Category Archive';
protected $AX_MUCAC_CDESC = 'Gösters a listing of Content items archived for a particular category.';
//com_menus/content_archive_Bölüm/content_archive_Bölüm.xml
protected $AX_MUCAS_CNAME = 'Blog - Content Bölüm Archive';
protected $AX_MUCAS_CDESC = 'Gösters a listing of Content items archived for a particular Bölüm.';
//com_menus/content_blog_category/content_blog_category.xml
protected $AX_MUCBC_CNAME = 'Blog - Content Category';
protected $AX_MUCBC_CDESC = 'Displays a page of content items from multiple Kategori using a blog format.';
//com_menus/content_blog_Bölüm/content_blog_Bölüm.xml
protected $AX_MUCBS_CNAME = 'Blog - Content Bölüm';
protected $AX_MUCBS_CDESC = 'Displays a page of content items from multiple Bölüms using a blog format.';
protected $AX_MUCBS_SHSD = 'Göster/Gizle the Bölüm Description.';
//com_menus/content_category/content_category.xml
protected $AX_MUCC_CNAME = 'Table - Content Category';
protected $AX_MUCC_CDESC = 'Gösters a Table view of Content items for a particular Category.';
protected $AX_MUCC_SHLOCD = 'Göster/Gizle the listing of other Kategori.';
//com_menus/content_item_link/content_item_link.xml
protected $AX_MCIL_CNAME = 'Link - Content Item';
protected $AX_MCIL_CDESC = 'Creates a link to a published Content Item in full view.';
//com_menus/content_Bölüm/content_Bölüm.xml
protected $AX_MCS_CNAME = 'Table - Content Bölüm';
protected $AX_MCS_CDESC = 'Creates a listing of Content Kategori for a particular Bölüm.';
protected $AX_MCS_STL = 'Bölüm Title';
protected $AX_MCS_STD = 'Göster/Gizle the Bölüm title.';
protected $AX_MCS_SHCTID = 'Göster/Gizle the Category Description resim.';
//com_menus/content_typed/content_typed.xml
protected $AX_MLSC_CNAME = 'Link - Autonomous Page';
protected $AX_MLSC_CDESC = 'Creates a link to an Autonomous Page Item.';
//com_menus/newsfeed_category_table/newsfeed_category_table.xml
protected $AX_MNSFC_CNAME = 'Table - Newsfeed Category';
protected $AX_MNSFC_CDESC = 'Gösters a Table view of Newsfeed items for a particular Category.';
protected $AX_MNSFC_SHNCD = 'Göster/Gizle the Name column.';
protected $AX_MNSFC_ACL = 'Articles Column';
protected $AX_MNSFC_ACD = 'Göster/Gizle the Articles column.';
protected $AX_MNSFC_LCL = 'Link Column';
protected $AX_MNSFC_LCD = 'Göster/Gizle the Link column.';
//com_menus/newsfeed_link/newsfeed_link.xml
protected $AX_MNSFL_CNAME = 'Link - Newsfeed';
protected $AX_MNSFL_CDESC = 'Creates a link to a single published Newsfeed.';
protected $AX_MNSFL_FDIML = 'Feed resim';
protected $AX_MNSFL_FDIMD = 'Göster/Gizle the resim of the feed.';
protected $AX_MNSFL_FDDSL = 'Feed Description';
protected $AX_MNSFL_FDDSD = 'Göster/Gizle the description text of the feed.';
protected $AX_MNSFL_WDCL = 'Word Count';
protected $AX_MNSFL_WDCD = 'Allows you to limit the amount of visible item description text. 0 will Göster all the text.';
//com_menus/separator/separator.xml
protected $AX_MSEP_CNAME = 'Separator / Placeholder';
protected $AX_MSEP_CDESC = 'Creates a menu placeholder or separator.';
//com_menus/url/url.xml
protected $AX_MURL_CNAME = 'Link - Url';
protected $AX_MURL_CDESC = 'Creates a link to a URL.';
//com_menus/weblink_category_table/weblink_category_table.xml
protected $AX_MWLC_CNAME = 'Table - Weblink Category';
protected $AX_MWLC_CDESC = 'Gösters a Table view of Weblink items for a particular Weblink Category.';
//com_menus/wrapper/wrapper.xml
protected $AX_MWRP_CNAME = 'Wrapper';
protected $AX_MWRP_CDESC = 'Creates an IFrame that will wrap an external page/site into Elxis.';
protected $AX_MWRP_SCRBL = 'Scroll Bars';
protected $AX_MWRP_SCRBD = 'Göster/Gizle Horizontal & Vertical scroll bars.';
protected $AX_MWRP_WDTL = 'Width';
protected $AX_MWRP_WDTD = 'Width of the IFrame window, you can enter an absolute value in pixels, or a relative value by adding a %.';
protected $AX_MWRP_HEIL = 'Height';
protected $AX_MWRP_HEID = 'Height of the IFrame window.';
protected $AX_MWRP_AHL = 'Auto Height';
protected $AX_MWRP_AHD = 'The height will automatically be set to the size of the external page. This will only work for pages on your own domain.';
protected $AX_MWRP_AADL = 'Auto Add';
protected $AX_MWRP_AADD = 'By default http:// will be added unless it http:// or https:// is detected in the url link you provided. This option allow you to switch off this feature.';
//com_menus/system/system.xml
protected $AX_MSYS_CNAME = 'System link';
protected $AX_MSYS_CDESC = 'Creates a link to a system feature';
//com_newsfeeds/newsfeeds.xml
protected $AX_NFE_CDESC = 'This component manages RSS/RDF newsfeeds.';
protected $AX_NFE_DPD = 'Description for page';
protected $AX_NFE_SHFNCD = 'Göster/Gizle the Feed Name column.';
protected $AX_NFE_NOACL = '# Articles Column';
protected $AX_NFE_NOACD = 'Göster/Gizle the # of articles in the feed.';
protected $AX_NFE_LCL = 'Link Column';
protected $AX_NFE_LCD = 'Göster/Gizle the Feed Link column.';
protected $AX_NFE_IDL = 'Item Description';
protected $AX_NFE_IDD = 'Göster/Gizle the description or intro text of an item.';
//com_search/search.xml
protected $AX_SEAR_CDESC = 'This component manages the Search functionality.';
//com_syndicate/syndicate.xml
protected $AX_SYN_CDESC = 'This component controls the Syndication settings.';
protected $AX_SYN_CACHL = 'Cache';
protected $AX_SYN_CACHD = 'Cache the feed files.';
protected $AX_SYN_CACHTL = 'Cache Time';
protected $AX_SYN_CACHTD = 'Cache file will refresh every x seconds.';
protected $AX_SYN_ITMSL = '# Items';
protected $AX_SYN_ITMSD = 'Number of Items to syndicate.';
protected $AX_SYN_ITMSDFLT = 'Elxis Syndication';
protected $AX_SYN_TITLE = 'Syndication Title';
protected $AX_SYN_DESCD = 'Syndication Description.';
protected $AX_SYN_DESCDFLT = 'Elxis site syndication';
protected $AX_SYN_IMGD = 'resim to be included in feed.';
protected $AX_SYN_IMGAL = 'resim Alt';
protected $AX_SYN_IMGAD = 'Alt text for resim.';
protected $AX_SYN_IMGADFLT = 'Powered by Elxis';
protected $AX_SYN_LMTL = 'Limit Text';
protected $AX_SYN_LMTD = 'Limit the article text to the value indicated below.';
protected $AX_SYN_TLENL = 'Text Length';
protected $AX_SYN_TLEND = 'The word length of the article text - 0 will Göster no text.';
protected $AX_SYN_LBL = 'Live Bookmarks';
protected $AX_SYN_LBD = 'Activate support for Firefox Live Bookmarks functionality.';
protected $AX_SYN_BFL = 'Bookmark file';
protected $AX_SYN_BFD = 'Special file name. If empty, the default will be used.';
protected $AX_SYN_ORDL = 'Order';
protected $AX_SYN_ORDD = 'Order that the items will be displayed.';
protected $AX_SYN_MULTIL = 'Multi-lingual feeds';
protected $AX_SYN_MULTILD = 'If yes, Elxis will generate language specific feeds.';
//com_trash/trash.xml
protected $AX_TRSH_CDESC = 'This component manages the Trash functionality.';
//com_typedcontent/typedcontent.xml
protected $AX_TDC_CDESC = 'This Gösters a single content page.';
//com_weblinks/weblinks.xml
protected $AX_WBL_CDESC = 'This component Gösters a listing of Weblinks with site screenshots.';
protected $AX_WBL_LDL = 'Link Descriptions';
protected $AX_WBL_LDD = 'Göster/Gizle the Description text of the Links.';
protected $AX_WBL_ICL = 'Icon';
protected $AX_WBL_ICD = 'Icon to be used to the Sol of the url links in Table view.';
protected $AX_WBL_SCSL = 'Screenshots';
protected $AX_WBL_SCSD = 'Göster linked site screenshot. If used, then the above Weblinks Icon will not be displayed.';
//com_weblinks/weblinks_item.xml
protected $AX_WBLI_TD = 'Target window when the link is clicked.';
protected $AX_WBLI_OT01 = 'Parent Window With Browser Navigation';
protected $AX_WBLI_OT02 = 'New Window With Browser Navigation';
protected $AX_WBLI_OT03 = 'New Window Without Browser Navigation';
//ADMINISTRATOR MODULES
//administrator/modules/mod_latest.xml
protected $AX_AM_LN_DESC = 'This module Gösters a list of the most recently published Items that are still current (some may have expired even though they are the most recent). Items that are displayed on the Front Page component are not included in the list.'; 
//administrator/modules/mod_logged.xml
protected $AX_AM_LG_DESC = 'This module Gösters a list of the currently logged in users.'; 
//administrator/modules/mod_popular.xml
protected $AX_AM_PI_DESC = 'This module Gösters a list of the popular published Items that are still current (some may have expired even though they are the most recent). Items that are displayed on the Front Page component are not included in the list.'; 
//administrator/modules/mod_stats.xml
protected $AX_AM_ST_DESC = 'This module Gösters stats of Items that are still current (some may have expired even though they are the most popular). Items that are displayed on the Front Page component are not included in the list.'; 
//SITE MODULES
//General
protected $AX_SM_MCSL = 'Module Class Suffix'; 
protected $AX_SM_MCSD = 'A suffix to be applied to the CSS class of the module (table.moduletable), this allows individual module styling.'; 
protected $AX_SM_MUCSL = 'Menu Class Suffix'; 
protected $AX_SM_MUCSD = 'A suffix to be applied to the CSS class of the menu items.'; 
protected $AX_SM_ECL = 'Enable Cache'; 
protected $AX_SM_ECD = 'Select whether to cache the content of this module.'; 
protected $AX_SM_SMIL = 'Göster Menu Icons'; 
protected $AX_SM_SMID = 'Göster the Menu Icons you have selected for your menu items.'; 
protected $AX_SM_MIAL = 'Menu Icon Alignment'; 
protected $AX_SM_MIAD = 'Alignment of the Menu Icons'; 
protected $AX_SM_MODL = 'Module Mode'; 
protected $AX_SM_MODD = 'Allows you to control which type of Content to display in the module.'; 
protected $AX_SM_OP01 = 'Only Content Items'; 
protected $AX_SM_OP02 = 'Only Autonomous Pages'; 
protected $AX_SM_OP03 = 'Both'; 
//modules/custom.xml
protected $AX_SM_CU_DESC = 'Custom Module.'; 
protected $AX_SM_CU_RSURL = 'RSS URL'; 
protected $AX_SM_CU_RSURD = 'Enter the URL of the RSS/RDF feed.'; 
protected $AX_SM_CU_FEDL = 'Feed Description'; 
protected $AX_SM_CU_FEDD = 'Göster the description text for the whole Feed.'; 
protected $AX_SM_CU_FEIL = 'Feed resim'; 
protected $AX_SM_CU_FEDID = 'Göster the resim associated with the whole Feed.'; 
protected $AX_SM_CU_ITL = 'Items'; 
protected $AX_SM_CU_ITD = 'Enter number of RSS items to display.'; 
protected $AX_SM_CU_ITDL = 'Item Description'; 
protected $AX_SM_CU_ITDD = 'Göster the description or intro text of individual news items.'; 
protected $AX_SM_CU_WCL = 'Word Count'; 
protected $AX_SM_CU_WCD = 'Allows you to limit the amount of visible item description text. 0 will Göster all the text.'; 
//modules/mod_archive.xml
protected $AX_SM_AR_DESC = 'This module Gösters a list of the calendar months, which contain Archived items. After you have changed the status of a Content Item to \'Archived\' this list will be automatically generated.'; 
protected $AX_SM_AR_CNTL = 'Count'; 
protected $AX_SM_AR_CNTD = 'The number of items to display (default is 10).'; 
//modules/mod_banners.xml
protected $AX_SM_BN_DESC = 'The banner module allows to Göster the active banners out of the component within your site.'; 
protected $AX_SM_BN_CNTL = 'Banner client'; 
protected $AX_SM_BN_CNTD = "Reference to banner client id. Enter separated by ','!"; 
protected $AX_SM_BN_NBSL = 'Number of Banners Göstern';
protected $AX_SM_BN_NBPRL = 'Number of Banners Per Row';
protected $AX_SM_BN_NBPRD = 'Number of banners per row, to disable set to 0. To display banners vertically, set this to 1';
protected $AX_SM_BN_UNQBL = 'Unique Banners';
protected $AX_SM_BN_UNQBD = 'No banner is ever Göstern more than once (per session). If all banners have been Göstern, then history is cleared and restarted.';
//modules/mod_latestnews.xml
protected $AX_SM_LN_DESC = 'This module Gösters a list of the most recently published Items that are still current (some may have expired even though they are the most recent). Items that are displayed on the Front Page component are not included in the list.'; 
protected $AX_SM_LN_FPIL = 'Frontpage Items'; 
protected $AX_SM_LN_FPID = 'Göster/Gizle items designated for the Frontpage - only works when in Content Items only mode.'; 
protected $AX_SM_AR_CNT5D = 'The number of items to display (default is 5).'; 
protected $AX_SM_LN_CATIL = 'Category ID'; 
protected $AX_SM_LN_CATID = 'Selects items from a specific Category or set of Kategori (to specify more than one Category, separate with a comma , ).'; 
protected $AX_SM_LN_SECIL = 'Bölüm ID'; 
protected $AX_SM_LN_SECID = 'Selects items from a specific Bölüm or set of Bölüms (to specify more than one Bölüm, separate with a comma , ).'; 
//modules/mod_login.xml
protected $AX_SM_LF_DESC = 'This module displays a Username and Password login form. It also displays a link to retrieve a forgotten password. If user registration is enabled, (refer to the Configuration settings), then another link will be Göstern to invite users to self-register.'; 
protected $AX_SM_LF_PTL = 'Pre-text'; 
protected $AX_SM_LF_PTD = 'This is the Text or HTML that is displayed above the login form.'; 
protected $AX_SM_LF_PSTL = 'Post-text'; 
protected $AX_SM_LF_PSTD = 'This is the Text or HTML that is displayed below the login form.'; 
protected $AX_SM_LF_LRUL = 'Login Redirection URL'; 
protected $AX_SM_LF_LRUD = 'What page will the login redirect to after login. If Sol blank will load front page.'; 
protected $AX_SM_LF_LORUL = 'Logout Redirection URL'; 
protected $AX_SM_LF_LORUD = 'What page will the login redirect to after logout. If Sol blank will load front page.'; 
protected $AX_SM_LF_LML = 'Login Message'; 
protected $AX_SM_LF_LMD = 'Göster/Gizle the javascript pop-up indicating Login Success.'; 
protected $AX_SM_LF_LOML = 'Logout Message'; 
protected $AX_SM_LF_LOMD = 'Göster/Gizle the javascript pop-up indicating Logout Success.'; 
protected $AX_SM_LF_GML = 'Greeting'; 
protected $AX_SM_LF_GMD = 'Göster/Gizle the simple greeting text.'; 
protected $AX_SM_LF_NUNL = 'Name/Username'; 
protected $AX_SM_LF_OP01 = 'Username'; 
protected $AX_SM_LF_OP02 = 'Name'; 
//modules/mod_mainmenu.xml
protected $AX_SM_MNM_DESC = 'Displays a menu.'; 
protected $AX_SM_MNM_MNL = 'Menu Name'; 
protected $AX_SM_MNM_MND = 'The name of the menu (default is \'mainmenu\').'; 
protected $AX_SM_MNM_MSL = 'Menu Style'; 
protected $AX_SM_MNM_MSD = 'The menu style'; 
protected $AX_SM_MNM_OP1 = 'Vertical'; 
protected $AX_SM_MNM_OP2 = 'Horizontal'; 
protected $AX_SM_MNM_OP3 = 'Flat List'; 
protected $AX_SM_MNM_EML = 'Expand Menu'; 
protected $AX_SM_MNM_EMD = 'Expand the menu and make its sub-menus items always visible.'; 
protected $AX_SM_MNM_IIL = 'Indent resim'; 
protected $AX_SM_MNM_IID = 'Choose which indent resim system to utilize.'; 
protected $AX_SM_MNM_OP4 = 'Template'; 
protected $AX_SM_MNM_OP5 = 'Elxis default resims'; 
protected $AX_SM_MNM_OP6 = 'Use params below'; 
protected $AX_SM_MNM_OP7 = 'None'; 
protected $AX_SM_MNM_II1L = 'Indent resim 1'; 
protected $AX_SM_MNM_II1D = 'resim for the first sub-level.'; 
protected $AX_SM_MNM_II2L = 'Indent resim 2'; 
protected $AX_SM_MNM_II2D = 'resim for the second sub-level.'; 
protected $AX_SM_MNM_II3L = 'Indent resim 3'; 
protected $AX_SM_MNM_II3D = 'resim for the third sub-level.'; 
protected $AX_SM_MNM_II4L = 'Indent resim 4'; 
protected $AX_SM_MNM_II4D = 'resim for the fourth sub-level.'; 
protected $AX_SM_MNM_II5L = 'Indent resim 5'; 
protected $AX_SM_MNM_II5D = 'resim for the fifth sub-level.'; 
protected $AX_SM_MNM_II6L = 'Indent resim 6'; 
protected $AX_SM_MNM_II6D = 'resim for the sixth sub-level.'; 
protected $AX_SM_MNM_SPL = 'Spacer'; 
protected $AX_SM_MNM_SPD = 'Spacer for Horizontal menu.'; 
protected $AX_SM_MNM_ESL = 'End Spacer'; 
protected $AX_SM_MNM_ESD = 'End Spacer for Horizontal menu.';
protected $AX_SM_MNM_IDPR = 'SEO PRO Itemid preload';
protected $AX_SM_MNM_IDPRD = 'Enabling AJAX preload of Itemid solves the issue of proper menu item setting when having more than one menu links that point to the same page.';
//modules/mod_mostread.xml
protected $AX_SM_MRC_DESC = 'This module Gösters a list of the currently published Items that have been viewed the most - determined by the number of times the page has been viewed.'; 
protected $AX_SM_MRC_MNL = 'Menu Name'; 
protected $AX_SM_MRC_MND = 'The name of the menu (default is mainmenu).'; 
protected $AX_SM_MRC_FPIL = 'Frontpage Items'; 
protected $AX_SM_MRC_FPID = 'Göster/Gizle items designated for the Frontpage - only works when in Content Items only mode.'; 
protected $AX_SM_MRC_CL = 'Count'; 
protected $AX_SM_MRC_CD = 'The number of items to display (default is 5).'; 
protected $AX_SM_MRC_CIDL = 'Category ID'; 
protected $AX_SM_MRC_CIDD = 'Selects items from a specific Category or set of Kategori (to specify more than one Category, seperate with a comma , ).'; 
protected $AX_SM_MRC_SIDL = 'Bölüm ID'; 
protected $AX_SM_MRC_SIDD = 'Selects items from a specific Bölüm or set of Bölüms (to specify more than one Bölüm, seperate with a comma , ).'; 
//modules/mod_newsflash.xml
protected $AX_SM_NWF_DESC = 'The Newsflash module randomly selects one of the published items from a category upon each page refresh. It may also display multiple items in horizontal or vertical configurations.'; 
protected $AX_SM_NWF_CATL = 'Category'; 
protected $AX_SM_NWF_CATD = 'A content category.'; 
protected $AX_SM_NWF_STL = 'Style'; 
protected $AX_SM_NWF_STD = 'The style to display the category.'; 
protected $AX_SM_NWF_OP1 = 'Randomly choose one at a time'; 
protected $AX_SM_NWF_OP2 = 'Horizontal'; 
protected $AX_SM_NWF_OP3 = 'Vertical'; 
protected $AX_SM_NWF_SIL = 'Göster resims'; 
protected $AX_SM_NWF_SID = 'Display content item resims.'; 
protected $AX_SM_NWF_LTL = 'Linked Titles'; 
protected $AX_SM_NWF_LTD = 'Make the Item titles linkable.'; 
protected $AX_SM_NWF_RML = 'Read More'; 
protected $AX_SM_NWF_RMD = 'Göster/Gizle the Read More button.'; 
protected $AX_SM_NWF_ITL = 'Item Title'; 
protected $AX_SM_NWF_ITD = 'Göster item title.'; 
protected $AX_SM_NWF_NOIL = 'No. of Items'; 
protected $AX_SM_NWF_NOID = 'No of items to display.'; 
//modules/mod_poll.xml
protected $AX_SM_POL_DESC = 'This module compliments the Polls component. It is used to display the configured polls. The module differs from other modules in as much as the Component supports linking between Menu Items and Polls. This means that the module Gösters only those Polls, which are configured for a certain Menu Item.'; 
protected $AX_SM_POL_CATL = 'Category'; 
protected $AX_SM_POL_CATD = 'A content category.'; 
//modules/mod_random_resim.xml
protected $AX_SM_RNI_DESC = 'This module display a random resim from the chosen directory.'; 
protected $AX_SM_RNI_ITL = 'resim Type'; 
protected $AX_SM_RNI_ITD = 'Type of resim PNG/GIF/JPG etc. (default is JPG).'; 
protected $AX_SM_RNI_IFL = 'resim Folder'; 
protected $AX_SM_RNI_IFD = 'Path to the resim folder relative to the site URL, eg: resims/stories.'; 
protected $AX_SM_RNI_LNL = 'Link'; 
protected $AX_SM_RNI_LND = 'A URL to redirect to if resim is clicked, eg: http://www.goup.gr'; 
protected $AX_SM_RNI_WL = 'Width (px)'; 
protected $AX_SM_RNI_WD = 'resim width (forces all resims to be displayed with this width).'; 
protected $AX_SM_RNI_HL = 'Height (px)'; 
protected $AX_SM_RNI_HD = 'resim height (forces all resims to be displayed with this height).'; 
//modules/mod_related_items.xml
protected $AX_SM_RLI_DESC = "This module displays other Content Items that are related to the Item currently displayed. These are based on the keywords Metadata. All the keywords of the current Content Item are searched against all the keywords of all other published items. For example, you may have an Item on 'Greece' and you may have another on 'Parthenon'. If you include the keyword 'Greece' in both Items, then the Related Items module will list the 'Greece' Item when viewing 'Parthenon' and vice-versa."; 
//modules/mod_rssfeed.xml
protected $AX_SM_RSS_DESC = 'The Syndicate module will display a link whereby people can syndicate your site for all your latest news. When you click on the RSS icon, you will be redirected to a new page that will list all the latest news in XML format. In order to use the Newsfeed in another Elxis site or a Newsfeed reader, you need to cut and paste the URL.'; 
protected $AX_SM_RSS_TXL = 'Text'; 
protected $AX_SM_RSS_TXD = 'Enter the text to be displayed along with the RSS links.'; 
protected $AX_SM_RSS_091D = 'Göster/Gizle RSS 0.91 Link.'; 
protected $AX_SM_RSS_10D = 'Göster/Gizle RSS 1.0 Link.'; 
protected $AX_SM_RSS_20D = 'Göster/Gizle RSS 2.0 Link.'; 
protected $AX_SM_RSS_03D = 'Göster/Gizle Atom 0.3 Link.'; 
protected $AX_SM_RSS_OPD = 'Göster/Gizle OPML Link.'; 
protected $AX_SM_RSS_I091L = 'RSS 0.91 resim'; 
protected $AX_SM_RSS_I10L = 'RSS 1.0 resim'; 
protected $AX_SM_RSS_I20L = 'RSS 2.0 resim'; 
protected $AX_SM_RSS_I03L = 'Atom resim'; 
protected $AX_SM_RSS_IOPL = 'OPML resim'; 
protected $AX_SM_RSS_CHID = 'Choose the resim to be used.'; 
//modules/mod_search.xml
protected $AX_SM_SEM_DESC = 'This module will display a search box.';
protected $AX_SM_SEM_Üst = 'Üst';
protected $AX_SM_SEM_BTM = 'Alt';
protected $AX_SM_SEM_BWL = 'Box Width';
protected $AX_SM_SEM_BWD = 'Size of the search text box.';
protected $AX_SM_SEM_TXL = 'Text';
protected $AX_SM_SEM_TXD = 'The text that appears in the search text box, if Sol blank it will load _SEARCH_BOX from your language file.';
protected $AX_SM_SEM_BPL = 'Button Position';
protected $AX_SM_SEM_BPD = 'Position of the button relative to the search box.';
protected $AX_SM_SEM_BTXL = 'Button Text';
protected $AX_SM_SEM_BTXD = 'The text that appears in the search button, if Sol blank it will load _SEARCH_TITLE from your language file.'; 
//modules/mod_Bölüms.xml
protected $AX_SM_SEC_DESC = 'The Bölüm module Gösters a list of all Bölüms configured in your database. The Bölüms refer here to the Item Bölüms only. If the configuration \'Göster Unauthorized Links\' is not set, the list will be limited to the Bölüms the user is allowed to see.'; 
protected $AX_SM_SEC_CL = 'Count';
protected $AX_SM_SEC_CD = 'The number of items to display (default is 5).';
//modules/mod_stats.xml
protected $AX_SM_STA_DESC = 'The Statistics module Gösters information about your server installation and statistics, number of contents in your database, and number of web links you provide.';
protected $AX_SM_STA_SVIL = 'Server Info'; 
protected $AX_SM_STA_SVID = 'Display server information.'; 
protected $AX_SM_STA_SIL = 'Site Info'; 
protected $AX_SM_STA_SID = 'Display site information.'; 
protected $AX_SM_STA_HCL = 'Hit Counter'; 
protected $AX_SM_STA_HCD = 'Display hit counter.'; 
protected $AX_SM_STA_ICL = 'Increase counter'; 
protected $AX_SM_STA_ICD = 'Enter the amount of hits to increase counter by.'; 
//modules/mod_templatechooser.xml
protected $AX_SM_TMC_DESC = 'The Template Chooser module allows the user (visitor) to change web site template on the fly from the Front-End, via a drop down selection list.'; 
protected $AX_SM_TMC_MNLL = 'Max. Name Length'; 
protected $AX_SM_TMC_MNLD = 'This is the maximum length of the template name to display (default 20).'; 
protected $AX_SM_TMC_SPL = 'Göster Preview'; 
protected $AX_SM_TMC_SPD = 'Template preview is to be Göstern.'; 
protected $AX_SM_TMC_WL = 'Width'; 
protected $AX_SM_TMC_WD = 'This is the width of the preview resim (default 140 px).'; 
protected $AX_SM_TMC_HL = 'Height'; 
protected $AX_SM_TMC_HD = 'This is the height of the preview resim (default 90 px).'; 
//modules/mod_whosonline.xml
protected $AX_SM_WSO_DESC = 'The Who\'s Online module displays the number of anonymous (guests) users and registered users that are currently accessing the web site.'; 
protected $AX_SM_WSO_DL = 'Display'; 
protected $AX_SM_WSO_DD = 'Select what shall be Göstern.'; 
protected $AX_SM_WSO_OP1 = '# of Guests/Members<br />'; 
protected $AX_SM_WSO_OP2 = 'Member Names<br />'; 
protected $AX_SM_WSO_OP3 = 'Both'; 
//modules/mod_wrapper.xml
protected $AX_SM_WRM_DESC = 'This module Gösters an IFrame window to specified location.'; 
protected $AX_SM_WRM_URLL = 'URL'; 
protected $AX_SM_WRM_URLD = 'URL to site/file you wish to display within the IFrame'; 
protected $AX_SM_WRM_SCBL = 'Scroll Bars'; 
protected $AX_SM_WRM_SCBD = 'Göster/Gizle Horizontal & Vertical scroll bars.'; 
protected $AX_SM_WRM_WL = 'Width'; 
protected $AX_SM_WRM_WD = 'Width of the IFrame Window. You can enter an absolute value in pixels, or a relative value by adding a %.'; 
protected $AX_SM_WRM_HL = 'Height'; 
protected $AX_SM_WRM_HD = 'Height of the IFrame Window'; 
protected $AX_SM_WRM_AHL = 'Auto Height'; 
protected $AX_SM_WRM_AHD = 'The height will automatically be set to the size of the external page. This will only work for pages on your own domain.'; 
protected $AX_SM_WRM_ADL = 'Auto Add'; 
protected $AX_SM_WRM_ADD = 'By default http:// will be added unless it detects http:// or https:// in the URL link you provide, this allow you to switch this ability off.'; 
/* mambots/editors/tinymce */
protected $AX_ED_FUNCTL = 'Functionality'; 
protected $AX_ED_FUNCTD = 'Select functionality'; 
protected $AX_ED_FUNSIMPLE = 'Simple'; 
protected $AX_ED_FUNADV = 'Advanced';
protected $AX_ED_EDITORWIDTHL = 'Editor Width';
protected $AX_ED_EDITORWIDTHD = 'Width of the Editor Window';
protected $AX_ED_EDITORHEIGHTL = 'Editor Height';
protected $AX_ED_EDITORHEIGHTD = 'Height of the Editor Window';
protected $AX_ED_COMPRESSEDVL = 'Compressed Version';
protected $AX_ED_COMPRESSEDVD = 'TinyMCE can be run in compressed mode, leading to slightly faster load speeds. However, this mode does not always work, especially in IE, so by default this is off.  Be careful when enabling this to ensure it works on your system';
protected $AX_ED_OFF = 'Off';
protected $AX_ED_ON = 'On';
protected $AX_ED_COMPRESSL = 'Compression';
protected $AX_ED_COMPRESSD = 'Compress TinyMCE Editor using gzip (loads 75% faster)';
protected $AX_ED_CONVERTURLL = 'Convert URLs';
protected $AX_ED_CONVERTURLD = 'Convert Absolute URLs to relative.';
protected $AX_ED_ENTENCODL = 'Entity Encoding';
protected $AX_ED_ENTENCODD = 'This option controls how entities/characters gets processed by TinyMCE. The value can be set to numeric representation, named entities or raw, where no encoding is performed. The default value of this option is named.';
protected $AX_ED_TXTDIRL = 'Text Direction';
protected $AX_ED_TXTDIRD = 'Ability to change text direction';
protected $AX_ED_CNVFONTSPANL = 'Convert Fonts to Spans';
protected $AX_ED_CNVFONTSPAND = 'Convert Font elements to Span elements. Default is Yes as font elements are deprecated.';
protected $AX_ED_FONTSIZETYPEL = 'Font Size Type';
protected $AX_ED_FONTSIZETYPED = 'Choose the type of font size to use, either length eg: 10pt, or absolute-size eg: x-small.';
protected $AX_ED_INLTABLEDITL = 'Inline Table Editing';
protected $AX_ED_INLTABLEDITD = 'Allow inline editing of Tables.';
protected $AX_ED_PROHELEMENTSL = 'Prohibited Elements';
protected $AX_ED_PROHELEMENTSD = 'Elements that will be cleaned from the text';
protected $AX_ED_EXTELEMENTSL = 'Extended Elements';
protected $AX_ED_EXTELEMENTSD = 'Extend TinyMCE functionality by adding in extra elements here. Format: elm[tag1|tag2]';
protected $AX_ED_EVELEMENTSL = 'Event Elements';
protected $AX_ED_EVELEMENTSD = 'This option should contain a comma separated list of elements thay may have event attributes such as onclick and similar. This option is needed since some browsers execute these events while editing content.';
protected $AX_ED_TCSSCLASSESL = 'Template CSS classes';
protected $AX_ED_TCSSCLASSESD = 'Load CSS classes from template_css.css';
protected $AX_ED_CCSSCLASSESL = 'Custom CSS Classes';
protected $AX_ED_CCSSCLASSESD = 'You can specify the loading of a custom CSS file - simply enter the name of the replacement CSS file. This file MUST be located in the same folder as you template CSS file.';
protected $AX_ED_NEWLINESL = 'Newlines';
protected $AX_ED_NEWLINESD = 'Newlines will be made into the selected option';
protected $AX_ED_TOOLBARL = 'Toolbar';
protected $AX_ED_TOOLBARD = 'Position of the toolbar';
protected $AX_ED_HTMLHEIGHTL = 'HTML Height';
protected $AX_ED_HTMLHEIGHTD = 'Height of HTML mode pop-up window.';
protected $AX_ED_HTMLWIDTHL = 'HTML Width';
protected $AX_ED_HTMLWIDTHD = 'Width of HTML mode pop-up window.';
protected $AX_ED_PREVIEWHEIGHTL = 'Preview Height';
protected $AX_ED_PREVIEWHEIGHTD = 'Height of Preview mode pop-up window.';
protected $AX_ED_PREVIEWWIDTHL = 'Preview Width';
protected $AX_ED_PREVIEWWIDTHD = 'Width of Preview mode pop-up window.';
protected $AX_ED_IBROWSERL = 'iBrowser Plugin';
protected $AX_ED_IBROWSERD = 'iBrowser is an advanced resim manager';
protected $AX_ED_PLTABLESL = 'Tables Plugin';
protected $AX_ED_PLTABLESD = 'Enables the Tables Editor in WYSIWYG mode.';
protected $AX_ED_PLPASTEL = 'Paste Plugin';
protected $AX_ED_PLPASTED = 'Enables the Paste from Word, Paste Plain Text and Select All.';
protected $AX_ED_PLIMGPLUGINL = 'Adv. resim Plugin';
protected $AX_ED_PLIMGPLUGIND = 'Enables the Advanced resim Manager. By default the Simple resim Editor is enabled.';
protected $AX_ED_PLSEARCHL = 'Search/Replace Plugin';
protected $AX_ED_PLSEARCHD = 'Enables the Search and Replace plugin.';
protected $AX_ED_PLLINKSL = 'Adv. Links Plugin';
protected $AX_ED_PLLINKSD = 'Enables the Advanced Links Manager. By default the Simple Links Editor is enabled.';
protected $AX_ED_PLEMOTL = 'Emotions Plugin';
protected $AX_ED_PLEMOTD = 'Enables the Emotions Plugin. You can easily add Emoticons.';
protected $AX_ED_PLFLASHL = 'Flash Plugin';
protected $AX_ED_PLFLASHD = 'Enables the Flash Plugin. You will be able to add Flash multimedia in the content.';
protected $AX_ED_PLDTL = 'Date/Time Plugin';
protected $AX_ED_PLDTD = 'Enables the Date/Time Plugin. You will be able to add the current date and time.';
protected $AX_ED_PLPREVL = 'Preview Plugin';
protected $AX_ED_PLPREVD = 'This plugin adds a preview button to TinyMCE, pressing the button opens a popup Göstering the current content.';
protected $AX_ED_PLZOOML = 'Zoom Plugin';
protected $AX_ED_PLZOOMD = 'Adds a zoom drop list in MSIE5.5+, this plugin was mostly created to Göster how to add custom droplists as plugins.';
protected $AX_ED_PLFSCRL = 'FullScreen Plugin';
protected $AX_ED_PLFSCRD = 'This plugin adds fullscreen editing mode to TinyMCE.';
protected $AX_ED_PLPRINTL = 'Print Plugin';
protected $AX_ED_PLPRINTD = 'This plugin adds a print button to TinyMCE.';
protected $AX_ED_PLDIRL = 'Directionality Plugin';
protected $AX_ED_PLDIRD = 'This plugin adds directionality icons to TinyMCE that enables TinyMCE to better handle languages that is written from Sağ to Sol.';
protected $AX_ED_PLFONTSL = 'Font Selection List';
protected $AX_ED_PLFONTSD = 'This plugin adds a fonts selection drop-down list.';
protected $AX_ED_PLFONTSZL = 'Font Size List';
protected $AX_ED_PLFONTSZD = 'This plugin adds a font size selection drop-down list.';
protected $AX_ED_PLFORMLSL = 'Format List';
protected $AX_ED_PLFORMLSD = 'This plugin adds a format list drop-down list, e.g. H1, H2, etc.';
protected $AX_ED_PLSSLL = 'Style Select List';
protected $AX_ED_PLSSLD = 'This plugin adds a style selection list based on the current template or from a CSS file of your selection.';
protected $AX_ED_NAMED = 'Named';
protected $AX_ED_NUMERIC = 'Numeric';
protected $AX_ED_RAW = 'Raw';
protected $AX_ED_LTR = 'Sol to Sağ';
protected $AX_ED_RTL = 'Sağ to Sol';
protected $AX_ED_LENGTH = 'Length';
protected $AX_ED_ABSSIZE = 'Absolute-Size';
protected $AX_ED_BRELEMENTS = 'BR Elements';
protected $AX_ED_PELEMENTS = 'P Elements';
//TOOLS
//Calculator: /administrator/tools/calculator/calculator.xml
protected $AX_TCAL_L = 'Calculator';
protected $AX_TCAL_D = 'An advanced javascript calculator';
//Empty Temporary: /administrator/tools/empty_temporary/empty_temporary.xml
protected $AX_TEMTEMP_L = 'Empty Temporary';
protected $AX_TEMTEMP_D = 'Empties Elxis temporary folder (/tmpr).';
//FixLanguage: /administrator/tools/fix_language/fix_language.xml
protected $AX_TFIXLANG_L = 'Fix Language';
protected $AX_TFIXLANG_D = 'Performs a check in multilingual database tables and applies fixes where needed.';
//Organizer: /administrator/tools/organizer/organizer.xml
protected $AX_TORGANIZ_L = 'Organizer';
protected $AX_TORGANIZ_D = 'Elxis Organizer keeps your contacts, notes, bookmarks and appointments.';
//Clean Cache: /administrator/tools/clean_cache/clean_cache.xml
protected $AX_TCLEANCACHE_L = 'Clean Cache';
protected $AX_TCLEANCACHE_D = 'Cleans cache directory from cached content items and resims';
//Chmod: /administrator/tools/chmod/chmod.xml
protected $AX_TCHMOD_L = 'Change mode';
protected $AX_TCHMOD_D = 'Changes mode to a given file or folder';
//FixPgSequences: /administrator/tools/fix_pg_sequences/fix_pg_sequences.xml
protected $AX_TFPGSEQ_L = 'Fix Postgres Sequences';
protected $AX_TFPGSEQ_D = 'Fixes Postgres sequences if needed.';
//Elxis Registration: /administrator/tools/registration/registration.xml
protected $AX_TELXREG_L = 'Elxis registration';
protected $AX_TELXREG_D = 'Registers your Elxis installation to Elxis.org';
//com_menus/bridge/bridge.xml
protected $AX_BRIDGE_CNAME = 'Bridge';
protected $AX_BRIDGE_CDESC = 'Creates a link to a Bridge.';
//modules/mod_language.xml
protected $AX_NEW_LINE = 'New line';
protected $AX_SAME_LINE = 'Same line';
protected $AX_INDICATOR = 'Indicator';
protected $AX_INDICATOR_D = 'Displays the word Language as an Indicator';
protected $AX_FLAG = 'Flag';
//modules/mod_language.xml
protected $AX_MODLANGD = 'Displays Front-End language selector as a dropdown list, links list, or series of flags.';
protected $AX_FLAGS = 'Flags';
protected $AX_SMARTSW = 'Smart Switch';
protected $AX_SMARTSW_D = 'Allows you to switch language and stay in the same page under some conditions';
//modules/mod_random_profile.xml
protected $AX_RP_DESC = 'Displays users random profiles';
protected $AX_DISPSTYLE = 'Display Style';
protected $AX_COMPACT = 'Compact';
protected $AX_EXTENDED = 'Extended';
protected $AX_GENDER = 'Gender';
protected $AX_GENDERDESC = 'Display User Gender?';
protected $AX_AGE = 'Age';
protected $AX_AGEDESC = 'Display User Age?';
protected $AX_REALUNAME = 'Display Real Name or User Name?';
//weblinks item
protected $AX_WBLI_TL = 'Target';
//content
protected $AX_RTFICL = 'RTF Icon';
protected $AX_RTFICD = 'Göster/Gizle the RTF button - only affects this page.';
//modules/mod_whosonline.xml
protected $AX_MODWHO_FILGR = 'Filter Groups';
protected $AX_MODWHO_FILGRD = 'If yes, then users with lower access level (i.e. visitors) will not be able to see the login status of users with higher access.';
//search bots
protected $AX_SEARCH_LIMIT = 'Search limit';
protected $AX_MAXNUM_SRES = 'Maximum number of search results';
//modules/mod_frontpage
protected $AX_MODFRONTPAGE = 'Displays a summary of the latest site additions. Ideal for the frontpage.'; 
protected $AX_BölümS = 'Bölüms';
protected $AX_BölümSD = 'Bölüm IDs comma separated (,)';
protected $AX_Kategori = 'Kategori';
protected $AX_KategoriD = 'Kategori IDs comma separated (,)';
protected $AX_NUMDAYS = 'Number of days';
protected $AX_NUMDAYSD = 'Göster items created in the last X days (default value 900)';
protected $AX_GösterTHUMBS = 'Göster thumbnails';
protected $AX_GösterTHUMBSD = 'Göster/Gizle thumbnail resim in intro text';
protected $AX_THUMBWIDTHD = 'Width of the thumbnail resim in pixels';
protected $AX_THUMBHEIGHTD = 'Height of the thumbnail resim in pixels';
protected $AX_KEEPRATIO = 'Keep ratio';
protected $AX_KEEPRATIOD = 'Preserve resim aspect ratio. If Yes, then the height parameter above does n\'t matter.';
//com_menus/eblog_item_link/eblog_item_link.xml
protected $AX_EBLOGITEM = 'eBlog Item';
protected $AX_EBLOGITEMD = 'Creates a link to a published eBlog blog';
protected $AX_COMMENTARY = 'Yorum';
protected $AX_COMMENTARYD = 'Bu makaleye yorum izni verilenleri seç.';
protected $AX_NOONE = 'Hiçbiri';
protected $AX_REGUSERS = 'Kayırlı kullanıcılar';
protected $AX_ALL = 'Hepsi';
protected $AX_COMMENTS = 'Yorumlar';
protected $AX_COMMENTSD = 'Yorumların sayısını göster';

}

?>