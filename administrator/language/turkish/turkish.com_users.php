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
* @description: Turkish language for component users
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Bu alana doğrudan erişim engellenmiştir.' );


class adminLanguage extends standardLanguage {

public $A_CMP_USS_LOGIN = 'Bağlı';
public $A_CMP_USS_ALL = 'Tümü';
public $A_CMP_USS_ID = 'Kullanıcı ID';
public $A_CMP_USS_LSTV = 'Son Ziyaret';
public $A_CMP_USS_ENBLD = 'Aktif';
public $A_CMP_USS_BLCKD = 'Engellendi';
public $A_CMP_USS_LVDATE = '%Y-%m-%d %H:%M:%S'; //Last visit Date
public $A_CMP_USS_PFISNOT = 'Lütfen başka grup seçin, \'Public Frontend\' seçilebilir bir seçenek değil';
public $A_CMP_USS_PBISNOT = 'Lütfen başka grup seçin, \'Public Backend\' seçilebilir bir seçenek değil';
public $A_CMP_USS_DETAILS = 'Kullanıcı Detayları';
public $A_CMP_USS_EMAIL = 'E-Posta';
public $A_CMP_USS_PASS = 'Yeni Parola';
public $A_CMP_USS_VERIFY = 'Parola Tekrarı';
public $A_CMP_USS_BLOCK = 'Kullanıcı Engelle';
public $A_CMP_USS_SUBMI = 'Receive Submission Emails';
public $A_CMP_USS_REGDATE = 'Kayıt Tarihi';
public $A_CMP_USS_VISDTE = 'Son Ziyareti';
public $A_CMP_USS_CONTCT = 'Bağlantı Bilgileri';
public $A_CMP_USS_NDETL = 'Bu kullanıcının bağlantı bilgileri linki yok:<br />Detaylar için, Bakın \'Bileşenler -> İletişim -> İletişim Yönetimi\'.';
public $A_CMP_USS_SUCCH = 'Kullanıcıdaki değişiklikler başarıyla kaydedildi';
public $A_CMP_USS_SUCUSR = 'Kullanıcı başarıyla kaydedildi';
public $A_CMP_USS_CANNOT = 'Bir Super Administrator silinemez';
public $A_CMP_USS_CANNYO = 'Kendinizi silemezsiniz!';
public $A_CMP_USS_CANNUS = 'Bu kullanıcıyı silme izniniz yok';
public $A_CMP_USS_SLUSER = 'Lütfen bir kullanıcı seçin';
public $A_CMP_USS_FLGOUT = 'Mecburi Çıkış';
public $A_CMP_USS_UMUST = 'Giriş için bir kullanıcı adı olmalı.';
public $A_CMP_USS_ULOGIN = 'Kullanıcı adınız geçersiz karakterler içeriyor ya da çok kısa.';
public $A_CMP_USS_MSTEMAIL = 'Bir eposta adresi olmalı.';
public $A_CMP_USS_ASSIGN = 'Bir grup atanmalı.';
public $A_CMP_USS_NOMATC = 'Şifreler eşleşmiyor.';
public $A_CMP_USS_FLOGD = 'Filter Logged';
public $A_CMP_USS_FACST = 'Filter Active';
public $A_CMP_USS_PHONE = 'Telefon';
public $A_CMP_USS_FAX = 'Fax';
public $A_CMP_USS_NOEXTRA = 'Ayarlanmış ya da yayınlanmış Extra kullanıcı alanları yok';
public $A_CMP_USS_VERTICAL = 'Dikey';
public $A_CMP_USS_HORIZONT = 'Yatay';
public $A_CMP_USS_CHECKED = 'Denetlendi';
public $A_CMP_USS_1OPTVLEAST = 'At least one option and a valid selected option must be given';
public $A_CMP_USS_1OPTLEAST = 'At least one option must be given';
public $A_CMP_USS_EXTRASAVED = 'Extra alan başarıyla kaydedildi';
public $A_CMP_USS_CHACONDET = 'change Contact Details';
public $A_CMP_USS_REQUIRED = 'Gerekli';
public $A_CMP_USS_REGISTR = 'Kayıt';
public $A_CMP_USS_PROFILE = 'Profil';
public $A_CMP_USS_RONLY = 'Sadece Oku';
public $A_CMP_USS_HIDDEN = 'Gizli';
public $A_CMP_USS_SHOWREG = 'Kayıtta Göster';
public $A_CMP_USS_SHOWPROF = 'Profilde Göster';
public $A_CMP_USS_OPTALIGN = 'Özellik Sıralaması';
public $A_CMP_USS_PREVNOTE = 'Not: Değişiklikleri görmek için kaydetmelisiniz.';
public $A_CMP_USS_OPTIONS = 'Özellikler';
public $A_CMP_USS_OPTIONSFOR = 'için Özellikler';
public $A_CMP_USS_MUSTFNAME = 'Bir isim vermelisiniz';
public $A_CMP_USS_MAXLENINV = 'Alanın azami uzunluk değeri geçersiz';
public $A_CMP_USS_HIDMUSTVAL = 'Gizli alana değer atanmalı!';
public $A_CMP_USS_DEFVAL = 'VArsayılan Değer';
public $A_CMP_USS_MAXLEN = 'Azami uzunluk';
public $A_CMP_USS_REQFLDSNO = 'One or more required fields have not been filled in!';
public $A_CMP_USS_HIDNOREQ = 'A hidden field can not be required!';
public $A_CMP_USS_HIDNOPROF = 'Gizli bir alan profilde görünmez!';
public $A_CMP_USS_PREFLANG = 'Seçilen dil';
public $A_CMP_USS_AVATAR = 'Avatar';
public $A_CMP_USS_WEBSITE = 'Web sitesi';
public $A_CMP_USS_AIM = 'AIM';
public $A_CMP_USS_YIM = 'YIM';
public $A_CMP_USS_MSN = 'MSN';
public $A_CMP_USS_ICQ = 'ICQ';
public $A_CMP_USS_MOBILE = 'Cep Telefonu';
public $A_CMP_USS_BIRTHDATE = 'Doğum Tarihi';
public $A_CMP_USS_GENDER = 'Cinsiyet';
public $A_CMP_USS_LOCATION = 'Konum';
public $A_CMP_USS_OCCUPATION = 'Meslek';
public $A_CMP_USS_SIGNATURE = 'İmza';
public $A_CMP_USS_MALE = 'Erkek';
public $A_CMP_USS_FEMALE = 'Bayan';
public $A_CMP_USS_YEAR = 'Yıl';
public $A_CMP_USS_MONTH = 'Ay';
public $A_CMP_USS_DAY = 'Gün';
public $A_CMP_USS_BOLDINDIC = 'Kullanıcı profillerindeki koyu elementler açık.';
public $A_CMP_USS_ENDISSOFT = 'Profil elementlerini SoftDisk den açma/kapama yapabilirsiniz.';
//2009.0
public $A_USERS_EXPDATE = 'Son kullanma tarihi';
public $A_USERS_ACCEXPIRED = 'Hesap süresi doldu';
public $A_USERS_ACCNACTIVE = 'Hesap Etkin';

}

?>