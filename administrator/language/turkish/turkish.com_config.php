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
* @description: Turkish language for component config
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Bu alana doğrudan erişim engellenmiştir.' );


class adminLanguage extends standardLanguage {

	public $A_COMP_CONF_OFFLINE = 'Site Kapalı';
	public $A_COMP_CONF_OFFMESSAGE = 'Kapalı Mesajı';
	public $A_COMP_CONF_TIP_OFFMESSAGE = 'Site Kapalı Mesajı';
	public $A_COMP_CONF_ERR_MESSAGE = 'Sistem Hata Mesajı';
	public $A_COMP_CONF_TIP_ERR_MESSAGE = 'Elxis sistemi veritabanına bağlanamazsa görülecek olan mesajdır';
	public $A_COMP_CONF_SITE_NAME = 'Site Adı';
	public $A_COMP_CONF_UN_LINKS = 'Yetkilendirilmemiş Linkleri Göster';
	public $A_COMP_CONF_UN_TIP = 'Evet seçerseniz, kayıtlı kullanıcılara mahsus içeriklerin linkleri giriş yapmamış olanlara da gösterilecek. Öğelerin tamamını görmek için ise kullanıcıların giriş yapması gerekecek.';
	public $A_COMP_CONF_USER_REG = 'Üye Kaydına İzin Ver';
	public $A_COMP_CONF_TIP_USER_REG = 'Evet seçerseniz, kullanıcıların üye olmalarına izin verilir';
	public $A_COMP_CONF_REQ_EMAIL = 'Tekil E-Posta İste';
	public $A_COMP_CONF_REQTIP = 'Evet seçerseniz, kullanıcılar aynı e-posta adresi ile mükerreren üye olamaz';
	public $A_COMP_CONF_DEBUG = 'Site Hata Ayıklama';
	public $A_COMP_CONF_DEBTIP = 'Evet seçerseniz, mevcut SQL hataları ile ilgili bilgiler görüntülenir';
	public $A_COMP_CONF_EDITOR = 'Varsayılan WYSIWYG Editörü';
	public $A_COMP_CONF_LENGTH = 'Liste Uzunluğu';
	public $A_COMP_CONF_LENTIP = 'Tüm kullanıcılar için varsayılan liste uzunluğu ayarı';
	public $A_COMP_CONF_FAV_ICON = 'Favori Site Simgesi';
	public $A_COMP_CONF_FAVTIP = 'Boş olduğu ya da dosya bulunamadığı durumlarda varsayılan favicon.ico kollanılacak';
	public $A_COMP_CONF_CLINKACC = 'Giriş İzin Sistemine Göre Bileşen Linkleri';
	public $A_COMP_CONF_CLACCDESC = 'Erişim Kontrol Sistemi için ön yüzde uygulanmasını istediğidiz bileşenlerin türünü seç. (ACO value = view). Emin değilsen yardım dosyasını oku.';
	public $A_COMP_CONF_CORECOMPS = 'Ana Bileşenler';
	public $A_COMP_CONF_3RDCOMPS = 'Üçüncü Parti Bileşenleri';
	public $A_COMP_CONF_ALLCOMPS = 'Tüm Bileşenler';
	public $A_COMP_CONF_CAPTCHA = 'Güvenlik Kod Uygulaması';
	public $A_COMP_CONF_CAPTCHATIP = 'Evet, web sitenizlerdeki formlarda güvenlik resmi (Captcha) istediğinizde. Kelime heceleme özelliği ile görme problemi olanlar için de uygundur.';
	public $A_COMP_CONF_LOCALE = 'Yerel';
	public $A_COMP_CONF_LANG = 'Varsayılan site dili';
	public $A_COMP_CONF_ALANG = 'Varsayılan yönetim bölümü dili';
	public $A_COMP_CONF_TIME_SET = 'Zaman Gösterimi';
	public $A_COMP_CONF_DATE = 'Görüntülenmek için ayrlanan güncel tarih/zaman ';
	public $A_COMP_CONF_LOCAL = 'Ülke Yereli';
	public $A_COMP_CONF_LOCRECOM = 'Otomatik seçimi tavsiye ederiz. Elxis işletim sisteminizdeki yerel ayarları ve dili kullanacak. Windows UTF-8 ülke yerelini desteklemez.';
	public $A_COMP_CONF_LOCCHECK = 'Yerel Zaman';
	public $A_COMP_CONF_LOCCHECK2 = 'Bu tarihi uygun formatta görmek isterseniz, sistemin ve dilin için ülke yereli uygun olacaktır.<br /><strong>Dikkat!</strong> Windows da ülke yereli otomatil olarak İngilizcedir.';
	public $A_COMP_CONF_AUTOSEL = 'Otomatik Seçim';
	public $A_COMP_CONF_CONTROL = '* Bu parametreler çıktı öğelerini kontrol eder *';
	public $A_COMP_CONF_LINK_TITLES = 'Linklenmiş Başlıklar';
	public $A_COMP_CONF_LTITLES_TIP = 'Evet seçerseniz, içerik öğe başlıkları linklenmiş başlıklara dönüşecek';
	public $A_COMP_CONF_MORE_LINK = 'Devamını Oku Linki';
	public $A_COMP_CONF_MLINK_TIP = 'Göster olarak ayarlarsanız, Devamını Oku Linki gösterilecek';
	public $A_COMP_CONF_RATE_VOTE = 'Öğe Beğenilme/Oylama';
	public $A_COMP_CONF_RVOTE_TIP = 'Göster olarak ayarlarsanız, oylama sistemi içerik öğeleri için açık olacak';
	public $A_COMP_CONF_AUTHOR = 'Yazar Adı';
	public $A_COMP_CONF_AUTHORTIP = 'Göster olarak ayarlarsanız, yazar adı gösterilecek.Bu genel ayardır fakat değiştirilebilir';
	public $A_COMP_CONF_CREATED = 'Hazırlanma Tarih ve Saati';
	public $A_COMP_CONF_CREATEDTIP = 'Göster olarak ayarlarsanız, the date and time an item was created will be displayed. Bu genel ayardır fakat değiştirilebilir';
	public $A_COMP_CONF_MOD_DATE = 'Düzenlenme Tarih ve Saati';
	public $A_COMP_CONF_MDATETIP = 'Göster olarak ayarlarsanız, Düzenlenme Tarih ve Saati gösterilecek. Bu genel ayardır fakat değiştirilebilir';
	public $A_COMP_CONF_HITS = 'Tıklamalar';
	public $A_COMP_CONF_HITSTIP = 'Göster olarak ayarlarsanız, tıklamalar özel bir öğe için görünür olacak. Bu genel ayardır fakat değiştirilebilir';
	public $A_COMP_CONF_PDF = 'PDF Simgesi';
	public $A_COMP_CONF_OPT_MEDIA = 'Seçim /tmpr dizinin yazılabilir olmasına uygun değil';
	public $A_COMP_CONF_PRINT_ICON = 'Yazdırma Simgesi';
	public $A_COMP_CONF_EMAIL_ICON = 'E-Posta Simgesi';
	public $A_COMP_CONF_ICONS = 'Simgeler';
	public $A_COMP_CONF_USE_OR_TEXT = 'Yazdır, RTF, PDF & Eposta için simge yada metin';
	public $A_COMP_CONF_TBL_CONTENTS = 'Çok Sayfalı Öğelerde İçerik Tablosu';
	public $A_COMP_CONF_BACK_BUTTON = 'Geri Butonu';
	public $A_COMP_CONF_CONTENT_NAV = 'İçerik Öğesi Yönlendirmesi';
	public $A_COMP_CONF_HYPER = 'Linklenmiş Başlıklar';
	public $A_COMP_CONF_DBTYPE = 'Veritabanı Tipi';
	public $A_COMP_CONF_DBWARN = 'Bu veritabanına kurulan Elxis verilerini bir kopyasını almadan değiştirmeyin!';
	public $A_COMP_CONF_HOSTNAME = 'Sunucu Adı';
	public $A_COMP_CONF_DB_PW = 'Parola';
	public $A_COMP_CONF_DB_NAME = 'Veritabanı';
	public $A_COMP_CONF_DB_PREFIX = 'Veritabanı Öneki';
	public $A_COMP_CONF_NOT_CH = '!!VERİTABANINDA KULLANILAN TABLOLARDA AYARLADIĞINIZ TABLO ÖN EKİNİ DEĞİŞTİRMEYİN!!';
	public $A_COMP_CONF_ABS_PATH = 'Geçerli Yol';
	public $A_COMP_CONF_LIVE = 'Site Yolu';
	public $A_COMP_CONF_SECRET = 'Gizli Sözcük';
	public $A_COMP_CONF_GZIP = 'GZIP Sayfa Sıkıştırma';
	public $A_COMP_CONF_CP_BUFFER = 'Destekleniyorsa tampon bellek çıktısını sıkıştır';
	public $A_COMP_CONF_SESSION_TIME = 'Site Oturum Süresi';
	public $A_COMP_CONF_SEC = 'seconds';
	public $A_COMP_CONF_AUTO_LOGOUT = 'Süresi Dolmuş Yönetim Sayfasını Hatırla';
	public $A_COMP_CONF_ERR_REPORT = 'Hata Raporlama';
	public $A_COMP_CONF_HELP_SERVER = 'Yardım Sunucusu';
	public $A_COMP_CONF_META_PAGE = 'metadata-sayfası';
	public $A_COMP_CONF_META_DESC = 'Site Genel Meta Açıklaması';
	public $A_COMP_CONF_META_KEY = 'Site Genel Meta Anahtar Kelimeleri';
	public $A_COMP_CONF_META_TITLE = 'Meta Etiketi Başlığını Göster';
	public $A_COMP_CONF_META_ITEMS = 'Meta Etiketi içerik öğelerinde göster';
	public $A_COMP_CONF_META_AUTHOR = 'Yazar Meta Etiketini Göster';
	public $A_COMP_CONF_HPS1 = 'Yerel Yardım Dosyaları';
	public $A_COMP_CONF_HPS2 = 'Elxis Uzak Yardım Sunucusu';
	public $A_COMP_CONF_HPS3 = 'Official Elxis Yardım Sunucusu';
	public $A_COMP_CONF_PERMFLES = 'Yeni dosyalar için bu dosya izinlerini tanımlayan simgeyi seç';
	public $A_COMP_CONF_PERMDIRS = 'Yeni dizinler için bu dosya izinlerini tanımlayan simgeyi seç';
	public $A_COMP_CONF_NCHMODDIRS = 'Yeni dizinlerin CHMOD değerleri (sunucu varsayılanını kullan)';
	public $A_COMP_CONF_CHAPFLAGS = 'Kontrol ediliyor, izinler tüm bayraklara <em>tüm mevcut dosyalar</em> sitedeki.<br/><strong>BU ÖZELLİĞİN UYGUNSUZ KULLANIMINI SİTEYE UYARLAMALISINIZ!</strong>';
	public $A_COMP_CONF_CHAPDLAGS = 'Kontrol ediliyor, izinler tüm bayraklara <em>dizindeki</em> sitenin.<br/><strong>BU ÖZELLİĞİN UYGUNSUZ KULLANIMINI SİTEYE UYARLAMALISINIZ!</strong>';
	public $A_COMP_CONF_APPEXDIRS = 'Mevcut dizinlere uygula';
	public $A_COMP_CONF_APPEXFILES = 'Mevcut dosyalara uygula';
	public $A_COMP_CONF_WORLD = 'World';
	public $A_COMP_CONF_CHMODNDIRS = 'CHMOD yeni dizinler';
	public $A_COMP_CONF_MAIL = 'Posta';
	public $A_COMP_CONF_MAIL_FROM = 'Posta Gönderici';
	public $A_COMP_CONF_MAIL_FROM_NAME = 'Gönderen Posta';
	public $A_COMP_CONF_MAIL_SMTP_AUTH = 'SMTP Yetkili';
	public $A_COMP_CONF_MAIL_SMTP_USER = 'SMTP Kullanıcı';
	public $A_COMP_CONF_MAIL_SMTP_PASS = 'SMTP Şifre';
	public $A_COMP_CONF_MAIL_SMTP_HOST = 'SMTP Sunucu';
	public $A_COMP_CONF_CACHE = 'Önbellek';
	public $A_COMP_CONF_CACHE_FOLDER = 'Önbellek Klasörü';
	public $A_COMP_CONF_CACHE_DIR = 'Güncel ön bellek dizini';
	public $A_COMP_CONF_CACHE_DIR_UNWRT = 'Ön bellek dizini YAZILAMAZ - lütfen bu dizinin CHMOD değerini 777 olarak ayarla';
	public $A_COMP_CONF_CACHE_TIME = 'Önbellek Zamanı';
	public $A_COMP_CONF_STATS = 'İstatistikler';
	public $A_COMP_CONF_STATS_ENABLE = 'Site istatistikleri toplama Açık/Kapalı';
	public $A_COMP_CONF_STATS_LOG_HITS = 'Günlük Içerik Okunma Kaydı';
	public $A_COMP_CONF_STATS_WARN_DATA = 'Dikkat : Veritabanında büyük miktarda veri toplanacaktır';
	public $A_COMP_CONF_STATS_LOG_SEARCH = 'Arama Satırları Kaydı';
	public $A_COMP_CONF_SEO_LBL = 'AMU';
	public $A_COMP_CONF_SEO = 'Arama Motoru Uygunlaştırması';
	public $A_COMP_CONF_SEO_SEFU = 'Arama Motoru Dostu URLler';
	public $A_COMP_CONF_SEOBASIC = 'SEO Basic';
	public $A_COMP_CONF_SEOPRO = 'SEO Pro';
	public $A_COMP_CONF_SEOHELP = "Apache ve IIS. Apache: htaccess.txt dosyasını .htaccess olarak yeniden adlandır aktif etmeden önce(mod_rewrite enabled). IIS: Ionic Isapi Rewriter filtresi kullan. Azami performans için içeriklerini SEO PRO olarak ayarla. Üçüncü parti SEF bileşeni kullanmak istiyorsan SEO Basic seç.";
	public $A_COMP_CONF_SEO_DYN = 'Dinamik sayfa başlıkları';
	public $A_COMP_CONF_SEO_DYN_TITLE = 'Sayfa başlığındaki değişiklikleri dinamik olarak yansıtmak için geçerli içerik görüntülendi.';
	public $A_COMP_CONF_SERVER = 'Sunucu';
	public $A_COMP_CONF_METADATA = 'Meta Veri';
	public $A_COMP_CONF_CACHE_TAB = 'Önbellek';
	public $A_COMP_CONF_FTP_LBL = 'FTP';
	public $A_COMP_CONF_FTP = 'FTP Ayarları';
	public $A_COMP_CONF_FTP_ENB = 'FTP Açık';
	public $A_COMP_CONF_FTP_HST = 'FTP Sunucusu';
	public $A_COMP_CONF_FTP_HSTTP = 'Most probably';
	public $A_COMP_CONF_FTP_USR = 'FTP Kullanıcı Adı';
	public $A_COMP_CONF_FTP_USRTP = 'Most probably';
	public $A_COMP_CONF_FTP_PAS = 'FTP Parolası';
	public $A_COMP_CONF_FTP_PRT = 'FTP Portu';
	public $A_COMP_CONF_FTP_PRTTP = 'Varsayılan değer 21';
	public $A_COMP_CONF_FTP_PTH = 'FTP Ana Dizini';
	public $A_COMP_CONF_FTP_PTHTP = 'Elxis kurulumunuz için FTP yolu. I.e. /public_html/elxis';
	public $A_COMP_CONF_HIDE = 'Gizle';
	public $A_COMP_CONF_SHOW = 'Göster';
	public $A_COMP_CONF_DEFAULT = 'Sistem Varsayılanı';
	public $A_COMP_CONF_NONE = 'Yok';
	public $A_COMP_CONF_SIMPLE = 'Asgari';
	public $A_COMP_CONF_MAX = 'Azami';
	public $A_COMP_CONF_MAIL_FC = 'PHP mail yöntemi';
	public $A_COMP_CONF_SEND = 'Sendmail';
	public $A_COMP_CONF_SENDP = 'Sendmail yolu';
	public $A_COMP_CONF_SMTP = 'SMTP Sunucusu';
	public $A_COMP_CONF_UPDATED = 'Ayar detayları <strong>güncellendi!</strong>';
	public $A_COMP_CONF_ERR_OCC = '<strong>Bir hata meydana geldi!</strong> Ayara dosyası yazdırmaya kapalı!';
	public $A_COMP_CONF_READ = 'oku';
	public $A_COMP_CONF_WRITE = 'yaz';
	public $A_COMP_CONF_EXEC = 'çalıştır';
	public $A_COMP_CONF_FCRE = 'Dosya Oluşturma';
	public $A_COMP_CONF_FPERM = 'Dosya İzinleri';
	public $A_COMP_CONF_DCRE = 'Dizin Oluşturma';
	public $A_COMP_CONF_DPERM = 'Dizin İzinleri';
	public $A_COMP_CONF_OFFEX = 'Evet (Üst yönetici hariç)';
	public $A_COMP_CONF_RTF = 'RTF Simgesi';

	//elxis 2008.1
	public $A_C_CONF_AC_ACT = 'Hesap Aktivasyonu';
	public $A_C_CONF_NOACT = 'Aktivasyon yok';
	public $A_C_CONF_EMACT = 'Aktivasyon e-postası';
	public $A_C_CONF_MANACT = 'Elle aktivasyon';
	public $A_C_CONF_AC_ACTD = 'Yeni kullanıcı hesaplarının nasıl aktif edileceğini seç. Otomatik olarak, aktivasyon e-postası ile ya da site yöneticisi tarafından elle.';

	//2009.0
	public $A_C_CONF_COMMENTS = 'Yorumlar';
	public $A_C_CONF_COMMENTSTIP = 'İsterseniz, belirli bir içerik öğesi için yorum sayısını gösterecek şekilde ayarlayabilirsiniz. Bu genel ayar, menü ve öğe düzeyinde değiştirilebilir.';
	public $A_C_CONF_CHKFTP = 'FTP ayarlarını kontrol edin';
	public $A_C_CONF_STDCACHE = 'Standart önbellek';
	public $A_C_CONF_STATCACHE = 'Statik önbellek';
	public $A_C_CONF_CACHED = 'Statik önbellek,  büyük siteler için tavsiye edilir. Static Cache is recommended for heavy loaded sites. Statik önbellek kullanmak için SEO PRO açık olmalıdır.';
	public $A_C_CONF_SEODIS = 'SEO PRO kapatıldı!';

	public function __construct() {	
	}

}

?>