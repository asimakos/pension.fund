<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: Farhad Sakhaei
* @link: http://www.farsicms.com
* @email: farhad0@gmail.com
* @description: Persian user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'دستیابی مستقیم به این مكان مجاز نمی باشد.' );


class prefLang_persian {

	public $_ON_NEW_CONTENT = "یك آیتم محتوای جدید توسط [ %s ] با عنوان [ %s ] برای بخش [ %s ] و دسته [ %s ] ارسال شد";
	public $_E_COMMENTS = 'نظرات';
	public $_DATE = 'تاریخ';
	public $_E_SUBCONWAIT = 'مقالات ارسال شده منتظر برای تأیید:';
	public $_E_CONTENTSUB = 'ارسال محتوا';
	public $_MAIL_SUB = 'ارسال شده كاربر';
	public $_E_HI = 'سلام';
	public $_E_NEWSUBBY = "یك ارسال جدید توسط كاربر %s ایجاد شده است";
	public $_E_TYPESUB = 'نوع ارسال:';
	public $_E_TITLE = 'عنوان';
	public $_E_LOGINAPPR = 'جهت مشاهده و تأیید این ارسال به بخش مدیریت سایت تان وارد شوید.';
	public $_E_DONTRESPOND = 'لطفا به این پیغام كه به صورت اتوماتیك تولید شده و فقط برای اهداف اطلاع رسانی می باشد ، پاسخی ندهید.';
	public $_E_NEWPASS_SUB = "كلمه عبور جدید برای %s";
	public $_E_RPASS_NADMIN = "كاربر %s فرم یادآوری كلمه عبور را ارسال كرد. یك كلمه عبور جدید تولید شد و برای او ارسال گشت. 
  اگر شما مایل نیستید تا برای چنین اعمالی مطلع شوید ، پارامتر USERS_RPASSMAIL را در دیسك نرم به خیر تغییر دهید.";
	public $_E_SEND_SUB = "جزئیات حساب كاربری برای %s در %s";
	public $_ASEND_MSG = "سلام %s، 

یك كاربر جدید در %s ثبت نام شد.
این ایمیل حاوی جزئیات وی می باشد:

نام - %s
ایمیل - %s
نام كاربری - %s

لطفا به این پیغام كه به صورت اتوماتیك تولید شده و فقط برای اهداف اطلاع رسانی می باشد ، پاسخی ندهید.";
	public $_NEW_MESSAGE = 'یك پیغام خصوصی جدید رسیده است';
	public $_NEW_PRMSGF = "یك پیغام خصوصی جدید از سوی %s رسیده است";
	public $_LOG_READMSG = 'لطفا جهت خواندن پیغام به میز مدیریت وارد شوید.';
	public $_SUBCON_APPRNTF = 'آگاهی از تأیید محتوای ارسال شده';
	public $_SUBCON_ATAPPR = 'محتوای ارسال شده شما در %s تأیید شد.';
	public $_SECTION = 'بخش';
	public $_CATEGORY = 'دسته';
	//elxis 2008.1
	public $_MANAPPROVE = 'جهت ورود كاربر جدید شما باید ثبت نام وی را تأیید نمائید!';
	public $_ACCUNBLOCK = "جساب كاربری شما در %s توسط یك مدیر اصلی فعال شد. شما هم اكنون می توانید با عنوان %s وارد شوید";
	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'اطلاع رسانی از نظر جدید';
	public $_E_NEWCOMBYTITLE = "یك نظر جدید توسط %s در یك مقاله با عنوان %s شما ارسال شد";
	public $_E_COMSTAYUNPUB = 'این نظر غیر منتشر شده باقی خواهد ماند تا شما یا یك مدیر ارشد آن را منتشر نمائید.';
	public $_E_ACCEXPDATE = 'تاریخ انقضای حساب كاربری';

	public function __construct() {
	}

}

?>