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
* @description: Turkish language for component softdisk
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Bu alana doğrudan erişim engellenmiştir.' );


class adminLanguage extends standardLanguage {

public $A_CORE = 'Çekirdek';
public $A_ASTATS = 'Yönetim İstatistikleri';
public $A_VALUE = 'Değer';
public $A_LASTMOD = 'Son Düzenleme';
public $A_OS = 'İşletim Sistemi';
public $A_ELXIS_VERSION = 'Elxis sürümü';
public $A_SELECT = 'Seçilen';
public $NOEDITSYS = 'You are not allowed to edit system entries';
public $A_RESTORE = 'Geri Yükle';
public $SOFTDISK_HELP = 'SoftDisk, herhangi bir türün değişkenler ve parametreleri için bir sanal bellek alanıdır.<br /> SoftDisk\'in sistem tarafından ilave edilen mevcut girişlerine yeni ilave ya da düzenleme/silme yapabilirsiniz. Silinemez olarak işaretlenenleri sadece düzenleyebilirsiniz. SoftDisk\'in bölümlerini ve değer isimlerini adlandırmak için sadece <strong>bellibaşlı latin harflerini, rakamları ve alt çizgisi (_)</strong> kullanabilirsiniz.';
public $YCNOTEDITP = 'Parametreler düzenlenemez';
public $UNDELETABLE = 'Silinemez';
public $SOFTENTRYEXIST = 'Bu isimde bir SoftDisk girişi zaten var!';
public $INVSECTNAME = 'Geçersiz Bölüm adı!';
public $INVNAME = 'Geçersiz isim!';
public $INVEMAIL = 'Sağlanan değer geçerli bir eposta adresi değil!';
public $INVURL = 'Sağlanan değer geçerli bir URL değil!';
public $INVDEC = 'Sağlanan değer geçerli bir ondalık sayı değil!';
public $INVTSTAMP = 'Sağlanan değer geçerli bir UNIX zaman bilgisi değil!';
public $UPSYSTEM = 'Güncelleme Sistemi';
public $A_USERPROFILE = 'Kullanıcı Profili';
public $UPROF_WEBSITE = 'Web sitesi';
public $UPROF_AIM = 'AIM';
public $UPROF_YIM = 'YIM';
public $UPROF_MSN = 'MSN';
public $UPROF_ICQ = 'ICQ';
public $UPROF_EMAIL = 'E-posta';
public $UPROF_PHONE = 'Telefon';
public $UPROF_MOBILE = 'Cep Telefonu';
public $UPROF_BIRTHDATE = 'Doğum Tarihi';
public $UPROF_GENDER = 'Gender';
public $UPROF_LOCATION = 'Konum';
public $UPROF_OCCUPATION = 'Meslek';
public $UPROF_SIGNATURE = 'İmza';
public $UPROF_ARTICLES = 'Makalenin numarası';
public $UPROF_USERGROUP = 'Kullanıcı Gurubu';
public $UPROF_RANDUSERS = 'Profil sayfasında rasgele kullanıcıları görüntüle';
public $USERS_RPASSMAIL = 'Şifre hatırlatmayı yöneticilere bildirin';
public $SUBMIT_CATEGORIES = 'Categories that is allowed content submission (suggested). If empty all are allowed. (Categories IDs, comma separated)';
public $SUBMIT_SECTIONS = 'Sections that is allowed content submission (suggested). If empty all are allowed. (Sections IDs, comma separated)';
public $REG_AGREE = 'Registration agreement autonomous page ID. Zero (0) to disable. For language specific agreement create a SoftDisk entry at section USERS for each language named REG_AGREE_LANGUAGE-HERE of type Integer';
public $A_WEBLINKS = 'Web linkleri';
public $TOP_WEBLINK = 'Controls the display or not, of the module Top Weblinks inside component weblinks';
public $A_USERSLIST = 'Kullanıcı Listesi';
public $ULIST_ONLINE = 'Online Durumu';
public $ULIST_USERNAME = 'Kullanıcı adı';
public $ULIST_NAME = 'İsim';
public $ULIST_REGDATE = 'Kayıt Tarihi';
public $ULIST_PREFLANG = 'Tercih edilen dil';
//2009.0
public $STATICCACHE = 'Statik önbellek';

}

?>