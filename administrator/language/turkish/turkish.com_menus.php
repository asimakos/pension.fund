<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Mustafa Aydemir
* @link: http://www.elxisturkiye.org
* @email: ahdes@elxisturkiye.org
* @description: Turkish language for component menus
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Bu alana doğrudan erişim engellenmiştir.' );


class adminLanguage extends standardLanguage {

public $A_CMP_MU_MANAGER = 'Menu Yönetimi';
public $A_CMP_MU_MXLVLS = 'Azami Seviye';
public $A_CMP_MU_CANTDEL ='* Bu menüyü `silemezsiniz` Bu menü Elxis in düzgün şekilde çalışması için gerekmektedir *';
public $A_CMP_MU_MANHOME = '* [mainmenu] menüsünde ilk sırada yayınlanan öğe site için varsayılan `Anasayfa` olmaktadır *';
public $A_CMP_MU_MITEM = 'Menü Öğesi';
public $A_CMP_MU_NSMTG = '* Bazı menü tipleri birden fazla grubu gösterir, fakat onlar hala aynı menü tipindedir.';
public $A_CMP_MU_MITYP = 'Menü Öğesi Çeşidi';
public $A_CMP_MU_WBLV = 'Bu \'Blog\' görünümü';
public $A_CMP_MU_WTLV = 'Bu \'Tablo\' görünümü';
public $A_CMP_MU_WLIV = 'Bu \'Liste\' görünümü';
public $A_CMP_MU_SMTAP = '* Bazı \'Menü Tipleri\' birden fazla grupta görünebilir *';
public $A_CMP_MU_MOVEITS = 'Menü Öğelerini Taşı';
public $A_CMP_MU_MOVEMEN = 'Menüyü Taşı';
public $A_CMP_MU_BEINMOV = 'Menü öğeleri taşındı';
public $A_CMP_MU_COPYITS = 'Menü Öğelerini Kopyala';
public $A_CMP_MU_COPYMEN = 'Menüyü Kopyala';
public $A_CMP_MU_BCOPIED = 'Menü öğeleri kopyalandı';
public $A_CMP_MU_EDNEWSF = 'Bu haber Başlığını Düzenle';
public $A_CMP_MU_EDCONTA = 'Bu bağlantıyı Düzenle';
public $A_CMP_MU_EDCONTE = 'Bu İçeriği Düzenle';
public $A_CMP_MU_EDSTCONTE = 'Edit this Autonomous Page';
public $A_CMP_MU_MSGITSAV = 'Menü Öğesi Kaydedildi';
public $A_CMP_MU_MOVEDTO = ' Menü öğesi şuraya taşındı ';
public $A_CMP_MU_COPITO = ' Menü öğeleri şuraya kopyalandı ';
public $A_CMP_MU_THMOD = 'Modül';
public $A_CMP_MU_SCITLKT = 'Link için bir bileşen seçmelisiniz';
public $A_CMP_MU_COMPLLTO = 'Bileşen Link';
public $A_CMP_MU_ITEMNAME = 'Öğenin bir ismi olmalı';
public $A_CMP_MU_PLSELCMP = 'Lütfen bir bileşen seçin';
public $A_CMP_MU_PARAVAI = 'Parametreler bu yeni menü öğesini kaydettikten sonra listelenecek';
public $A_CMP_MU_YSELCAT = 'Bir kategori seçmelisiniz';
public $A_CMP_MU_TMHTITL = 'Bu menü öğesinin bir başlığı olmalı';
public $A_CMP_MU_TABLE = 'Tablo';
public $A_CMP_MU_CCTBLANK = 'If you leave this blank, the Category name will be automatically used';
public $A_CMP_MU_LNKHNAME = 'Linkin bir adı olmalı';
public $A_CMP_MU_SELCONT = 'You must select a Contact to link to';
public $A_CMP_MU_CONLINK = 'İletişim to Link:';
public $A_CMP_MU_ONCLOPI = 'Tıkla, Aç';
public $A_CMP_MU_THETITL = 'Başlık:';
public $A_CMP_MU_YMSSECT = 'Bir bölüm seçmelisiniz';
public $A_CMP_MU_ILBLSEC = 'If you leave this blank, the Section name will be automatically used';
public $A_CMP_MU_YCSMC = 'Çoklu kategori seçebilirsiniz';
public $A_CMP_MU_YCSMS = 'Çoklu bölüm seçebilirsiniz';
public $A_CMP_MU_EDCOI = 'İçerik öğesini düzenle';
public $A_CMP_MU_YMSLT = 'You must select a Content to link to';
public $A_CMP_MU_STACONT = 'Özerk içerik sayfası';
public $A_CMP_MU_ONCLOP = 'On Click, open';
public $A_CMP_MU_YSNWLT = 'You must select a Newsfeed to link to';
public $A_CMP_MU_NEWTL = 'Newsfeed to Link';
public $A_CMP_MU_SEPER = '- - - - - - -'; //Change this, if you want to change the symbols for seperator line
public $A_CMP_MU_PATNAM = 'Pattern/Name';
public $A_CMP_MU_WRURL = 'You must provide a url.';
public $A_CMP_MU_WRLINK = 'Wrapper Link';
public $A_CMP_MU_MIBGCC = 'Blog - İçerik Kategorisi';
public $A_CMP_MU_MITCG = 'Tablo - İletişim Kategorisi'; 
public $A_CMP_MU_MICOMP = 'Bileşen';
public $A_CMP_MU_MIBGCS = 'Blog - İçerik Bölümü';
public $A_CMP_MU_MILCMPI = 'Link - Bileşen Öğesi';
public $A_CMP_MU_MILCI = 'Link - İletişim Öğesi';
public $A_CMP_MU_MITBCC = 'Tablo - İçerik Kategorisi';
public $A_CMP_MU_MILCEI = 'Link - İçerik Öğesi';
public $A_CMP_MU_COTLINK = 'Link İçerik';
public $A_CMP_MU_MITBCS = 'Tablo - İçerik Bölümü';
public $A_CMP_MU_MILSTC = 'Link - Autonomous Page';
public $A_CMP_MU_MITBNFC = 'Table - Haber Başlığı Kategorisi';
public $A_CMP_MU_MILNEW = 'Link - Haber Başlığı';
public $A_CMP_MU_MISEP = 'Ayraç / Yer Kaplayıcı';
public $A_CMP_MU_MILIURL = 'Link - URL';
public $A_CMP_MU_MITBWC = 'Tablo - Web Bağlantı Kategorisi';
public $A_CMP_MU_MIWRAP = 'Wrapper';
public $A_CMP_MU_ITEM = 'Öğe';
public $A_CMP_MU_UMSBRI = 'Bir köprü seçmelisiniz';
public $A_CMP_MU_BRINOINS = 'Köprü bileşeni kurulamadı!';
public $A_CMP_MU_NOPUBBRI = 'YAyınlanan köprü yok!';
public $A_CMP_MU_CLVSEO = 'SEO başlığını görmek için bir özerk sayfa tıkla';
public $A_CMP_MU_SYSLINK = 'Sistem linki';
public $A_CMP_MU_SYSLINKD = 'Bir sistem linki normalde temada var olmayan bir modül pozisyonunda yayınlanmış olan bir menüye ait olmalı!';
public $A_CMP_MU_PASSR = 'Şifre Hatırlatma';
public $A_CMP_MU_UREG = 'Kullanıcı Kaydı';
public $A_CMP_MU_REGCOMP = 'Kayıt Tamamlandı';
public $A_CMP_MU_ACCACT = 'Hesap Aktivasyonu';
public $A_CMP_MU_MSLINK = 'Bir sistem linki seçmelisiniz.';
public $A_CMP_MU_SELLINK = '- Link Seç -';
public $A_CMP_MU_DONTDEL ='* Bu menüyü silmemeniz Elxisin düzgün çalışması için daya iyidir. Temada var olmayan bir modül pozisyonunda yayınlanmış olduğundan emin olun! *';
public $A_CMP_MU_EDPROF = 'Profili Düzenle';
public $A_CMP_MU_SUBWEBL = 'Weblinki Gönder';
public $A_CMP_MU_CHECKIN = 'Kontrol';
public $A_CMP_MU_USERLIST = 'Kullanıcı Listesi';
public $A_CMP_MU_POLLS = 'Anketler';
public $A_CMP_MU_SELBLOG = 'You must select a blog to link to';
public $A_CMP_MU_BLOGLINK = 'Blog to Link';

}

?>