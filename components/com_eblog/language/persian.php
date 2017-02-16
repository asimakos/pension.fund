<?php 
/**
* @version: 2009.1
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component eBlog
* @author: Elxis Team
* @translator: Farhad Sakhaei
* @link: http://www.farsicms.com
* @email: farhad0@gmail.com
* @description: Persian language for component eBlog
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'دستیابی مستقیم به این مكان مجاز نمی باشد.' );


class eBlogLang {


	public $ELXISBLOG = 'وبلاگ Elxis';
	public $TAGS = 'تگ ها';
	public $UNKNOWNTAG = 'تگ نامشخص';
	public $PERMLINK = 'لینك همیشگی';
	public $COMMENTS = 'نظرات';
	public $COMMENT = 'نظر'; //(noun, i.e. 1 comment)
	public $NOCOMMENTS = 'هیچ نظری وجود ندارد.';
	PUBLIC $MUSTLOGTOCOM = 'شما جهت ارسال نظر بایستی در ابتدا وارد شوید.';
	public $POSTCOMMENT = 'ارسال یك نظر';
	public $YOURCOMMENT = 'نظر شما';
	public $NALLPOSTCOM = 'شما مجاز به ارسال نظرات نمی باشید!';
	public $MUSTWRITEMSG = 'شما باید یك پیغام وارد نمائید!';
	public $COMADDSUC = 'نظر شما با موفقیت افزوده شد!';
	public $WAITRETRY = 'لطفا بعد از چند ثانیه مجددا سعی نمائید!';
	public $NALLPERFACT = 'شما مجاز به انجام این عمل نمی باشید!';
	public $ARTNOFOUND = 'عدم توانایی جهت یافتن ارسال درخواست شده!';
	public $POSTSTAGASAT = "ارسال ها با عنوان %s در %s تگ شدند"; //example: Posts tagged as computer at ElectroBlog";
	public $ARCHIVES = 'بایگانی ها';
	public $USERBLOGSAT = "وبلاگ های كاربر در %s"; //s: site name
	public $USERBLOGS = 'وبلاگ های كاربر';
	public $THEREAREBLOGS = "%s وبلاگ قابل دسترسی می باشد"; //s: number of available blogs
	public $POSTS = 'ارسال ها';

	//control panel
	public $CPANEL = 'صفحه مدیریت';
	public $MANBLOG = 'مدیریت وبلاگ شما';
	public $ALLPOSTS = 'تمامی ارسال ها';
	public $LATESTPOSTS = "آخرین %s ارسال";
	public $SETTINGS = 'تنظیمات';
	public $CSSFILE = 'فایل CSS';
	public $RTLCSSFILE = 'فایل RTL CSS';
	public $COMMENTARY = 'یادداشت';
	public $NOTALLOWED = 'مجاز نمی باشد'; //Commentary
	public $REGUSERS = 'كاربران ثبت نام شده'; //Commentary
	public $ALLOWEDALL = 'مجاز برای همه'; //Commentary
	public $POSTSNUMBER = 'تعداد ارسال ها';
	public $POSTSNUMBERD = 'تعداد آخرین ارسال ها جهت نمایش در صفحه اصلی وبلاگ.';
	public $SHOWTAGSD = 'انتخاب در صورتی كه مایلید تا تگ ها در زیر ارسال ها نمایش داده شوند.';
	public $CSSFILED = 'ورقه استیل جهت استفاده در وبلاگ شما. CSS بر روی تمام طرح بندی ، فونت ها ، رنگ ها و نمای كل وبلاگ تان تأثیر می گذارد.';
	public $RTLCSSFILED = 'ورقه استیل جهت استفاده در وبلاگ تان برای زبان های راست به چپ مانند فارسی ، عربی و عبری.';
	public $OPTION = 'گزینه';
	public $VALUE = 'مقدار';
	public $HELP = 'راهنمایی';
	public $NEWPOST = 'ارسال جدید';
	public $EDITPOST = 'ویرایش ارسال';
	public $TITLENOEMPTY = 'عنوان نمی تواند خالی باشد!';
	public $FOLDERCNOTCR = "پوشه %s نمی تواند ایجاد شود!"; //%s: folder name
	public $DIMENSIONS = 'ابعاد (پهنا x ارتفاع)';
	public $SIZEKB = 'اندازه (كیلوبایت)';
	public $LISTVIEW = 'نمایش لیستی';
	public $THUMBSVIEW = 'نمایش تصاویر كوچك';
	public $UPLOAD = 'آپلود';
	public $UPLOADIMG = 'آپلود تصویر';
	public $MEDIAMAN = 'مدیریت رسانه';
	public $YOUTUBEVIDEO = 'فیلم YouTube';
	public $GOOGLEVIDEO = 'فیلم Google';
	public $YAHOOVIDEO = 'فیلم Yahoo';
	public $COMSEPTAGS = 'تگ های جدا شده توسط كاما';
	public $SLOGAN = 'آرم';
	public $SLOGAND = 'آرم جهت نمایش در سر صفحه وبلاگ تان. شما می توانید html بنویسید.';
	public $SHOWOWNER = 'نمایش مالك';
	public $SHOWOWNERD = 'نمایش نام مالك در سر صفحه وبلاگ؟';
	public $SHOWARCHIVE = 'نمایش بایگانی';
	public $SHOWARCHIVED = 'نمایش بایگانی ماه ها در انتهای صفحه وبلاگ؟';

	//SEO titles
	public $SEOTITLE = 'عنوان بهینه شده برای موتور جستجو';
	public $SEOTITLEEMPTY = 'عنوان بهینه شده برای موتور جستجو نمی تواند خالی باشد!';
	public $INVALID = 'نا معتبر';
	public $VALID = 'معتبر';
	public $SEOTEXIST = 'عنوان بهینه شده برای موتور جستجو در حال حاضر وجود دارد!';
	public $SEOTLARGER = 'عنوان بزرگتری را سعی نمائید!';
	public $SEOTHELP = 'شما می توانید فقط از حروف كوچك لاتین ، اعداد ، خط تیره ها و زیر خط ها استفاده نمائید. عنوان بهینه شده بایستی یكتا باشد! سعی كنید تا عنوان های یكتا و پر معنی را درج نمائید.';
	public $SEOTSUG = 'عنوان بهینه شده پیشنهادی';
	public $SEOTVAL = 'معتبر سازی عنوان بهینه شده';

	//languages names
	public $ARMENIAN = 'ارمنی';
	public $BOZNIAN = 'بوسنی';
	public $BRAZILIAN = 'برزیلی';
	public $BULGARIAN = 'بلغاری';
	public $CREOLE = 'Creole';
	public $CROATIAN = 'كرواسی';
	public $DANISH = 'دانماركی';
	public $ENGLISH = 'انگلیسی';
	public $FRENCH = 'فرانسوی';
	public $GERMAN = 'آلمانی';
	public $GREEK = 'یونانی';
	public $INDONESIAN = 'اندونزی';
	public $ITALIAN = 'ایتالیایی';
	public $JAPANESE = 'ژاپنی';
	public $LATVIAN = 'لتونی';
	public $LITHUANIAN = 'لیتوانی';
	public $PERSIAN = 'فارسی';
	public $POLISH = 'لهستانی';
	public $RUSSIAN = 'روسی';
	public $SERBIAN = 'صربستانی';
	public $SPANISH = 'اسپانیایی';
	public $SRPSKI = 'Srpski';
	public $TURKISH = 'تركی';
	public $VIETNAMESE = 'ویتنامی';

	//backend
	public $BLOGINFO = 'اطلاعات وبلاگ';
	public $CANCONFIGD = 'انتخاب در صورتی كه مایلید تا مالك وبلاگ قادر باشد تا تنظیمات وبلاگ را از بخش اصلی تغییر دهد.';
	public $CANUPLOADD = 'انتخاب در صورتی كه مایلید تا مالك وبلاگ قادر باشد تا فایل های رسانه را آپلود نماید.';
	public $BLOGOWNMDIR = 'فهرست رسانه مالك وبلاگ';
	public $EXISTING = 'موجود';
	public $NONEXISTING = 'نا موجود';
	public $SIZEKBD = 'مجموع اندازه فایل های آپلود شده مجاز برای این كاربر به كیلو بایت. مقدار پیشفرض 2000 می باشد (2 مگابایت).';
	public $BLOGOWNER = 'مالك وبلاگ';
	public $UPLOADDIR = 'فهرست آپلود';
	public $UPLOADEDFILES = 'فایل های آپلود شده';
	public $USEDSPACE = 'فضای استفاده شده';
	public $LASTPOST = 'آخرین ارسال';
	public $LASTPOSTDATE = 'تاریخ آخرین ارسال';
	public $NOTSETYET = 'هنوز تنظیم نشده است';
	public $UNOTALLUPLOADF = 'كاربر مجاز به آپلود فایل ها نمی باشد.';

	//elxis 2009.1
	public $INVDATE = 'تاریخ انتخاب شده توسط شما نامعتبر است.';
	public $METADESCDAY = "پست ها برای سال %s در %s."; //Posts for DATE on EBLOG_TITLE
	public $NOPOSTSFDATE = 'بدون پست نشد برای این تاریخ. ';
	public $SHAREPOST = 'تقسیم این مقاله است';


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
	}

}

?>