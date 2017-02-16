<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: Mustafa Aydemir
* @link: http://www.elxisturkiye.org
* @email: ahdes@elxisturkiye.org
* @description: Turkish user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Bu alana doğrudan erişim engellenmiştir.' );


class prefLang_turkish {

	public $_ON_NEW_CONTENT = "Yeni içerik ögesi [ %s ] başlığı ile [ %s ] bölümünde [ %s ] kategorisine gönderildi";
	public $_E_COMMENTS = 'Yorumlar';
	public $_DATE = 'Tarih';
	public $_E_SUBCONWAIT = 'Gönderilen içerikler onay için bekliyor:';
	public $_E_CONTENTSUB = 'İçerik gönderme';
	public $_MAIL_SUB = 'Kullanıcı gönderisi';
	public $_E_HI = 'Merhaba';
	public $_E_NEWSUBBY = "%s kullanıcısı tarafından yeni bir gönderim yapıldı";
	public $_E_TYPESUB = 'Gönderi tipi:';
	public $_E_TITLE = 'Başlık';
	public $_E_LOGINAPPR = 'Gönderiyi incelemek ve onaylamak için yönetici olarak giriş yapın';
	public $_E_DONTRESPOND = 'Lütfen bu mesaja yanıt vermeyiniz. Mesaj otomatik olarak oluşturulmuştur ve sadece bilgi amaçlıdır ';
	public $_E_NEWPASS_SUB = "%s için yeni şifre";
	public $_E_RPASS_NADMIN = "%s kullanıcısı, şifre hatırlama formu gönderdi. Yeni şifre oluşturulup gönderildi
	Eğer değişiklikler hakkında bilgilendirilmek istemiyorsanız,  SoftDisk üzerindeki USERS_RPASSMAIL parametresini No yapın.";
	public $_E_SEND_SUB = "Hesap detayları %s için %s de";
	public $_ASEND_MSG = "Merhaba %s, 
	%s yeni kullanıcı kaydoldu.
	Bu eposta yeni kullanıcının bilgilerini içermektedir:
	
	İsim - %s
	e-posta - %s
	Kullanıcı adı - %s

	Bu mesaj bilgi amaçlıdır. Lütfen yanıt göndermeyiniz.";
	public $_NEW_MESSAGE = 'Yeni bir özel mesaj var';
	public $_NEW_PRMSGF = "%s den Yeni bir özel mesaj var";
	public $_LOG_READMSG = 'Mesajı okumak için lütfen giriş yapın.';
	public $_SUBCON_APPRNTF = 'İçerik gönderi onayı';
	public $_SUBCON_ATAPPR = '%s gönderdiğiniz içerik onaylandı.';
	public $_SECTION = 'Bölüm';
	public $_CATEGORY = 'Kategori';

	//elxis 2008.1
	public $_MANAPPROVE = 'Yeni kullanıcının giriş yapabilmesi için kaydı onaylamalısınız.!';
	public $_ACCUNBLOCK = "%s hesabınız, site yöneticisi tarafından aktif edildi. %s olarak giriş yapabilirsiniz.";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'Yeni yorum bildirimi';
	public $_E_NEWCOMBYTITLE = "%s tarafından, %s başlıklı yeni bir yorum gönderildi. ";
	public $_E_COMSTAYUNPUB = 'Bu yorum, siz ya da başka bir süper admin tarafından onaylanana kadar yayınlanmayacak.';
	public $_E_ACCEXPDATE = 'Hesap son kullanma tarihi';

	public function __construct() {
	}

}

?>