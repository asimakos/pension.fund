<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: Ahmad Said
* @link: http://www.itce.alquds.edu
* @email: itce@alquds.edu
* @description: Arabic user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_arabic {

	public $_ON_NEW_CONTENT = "محتوى جديد تم ارسالة من قبل [ %s ] بعنوان [ %s ] في قسم [ %s ] و تصنيف [ %s ]";
	public $_E_COMMENTS = 'تعليقات';
	public $_DATE = 'تاريخ';
	public $_E_SUBCONWAIT = 'المقالة المرسلة تنتظر الموافقة:';
	public $_E_CONTENTSUB = 'ارسال المحتوى';
	public $_MAIL_SUB = 'ارسالات المستخدم';
	public $_E_HI = 'مرحبا';
	public $_E_NEWSUBBY = "ارسال جديد بواسطة  %s";
	public $_E_TYPESUB = 'نوع الارسال:';
	public $_E_TITLE = 'عنوان';
	public $_E_LOGINAPPR = 'ادخل الى موقعك الاداري لمشاهدة والموافقة على هذا الطلب.';
	public $_E_DONTRESPOND = 'الرجاء عدم الرد على هذه الرسالة, تم انشا الرسالة تلقائيا وهي للعلم فقط.';
	public $_E_NEWPASS_SUB = "كلمة سر جديدة لـ %s";
	public $_E_RPASS_NADMIN = "المستخدم s٪ ارسل طلب تذكير كلمة السر. كلمة مرور جديدة أنشئت من أجله وأرسلت له. <BR>إذا كنت لا ترغب يرغبون في الحصول على إخطار عن هذه الأعمال يجب تغيير المتغير USERS_RPASSMAIL  في SoftDisk الى لا";
	public $_E_SEND_SUB = "تفاصيل الحساب الخاص بـ %s في %s";
	public $_ASEND_MSG = "مرحبا %s, 
	مستخدم جديد سجل في %s.
	هذا البريد الالكتروني يحتوي التفاصيل:
	
	الاسم - %s 
	البريد الالكتروني - %s 
	اسم المستخدم - %s

	الرجاء عدم الرد على هذه الرسالة, تم انشا الرسالة تلقائيا وهي للعلم فقط.";
	public $_NEW_MESSAGE = 'رسالة خاصة جديدة وصلت';
	public $_NEW_PRMSGF = "رسالة خاصة جديدة وصلت من %s";
	public $_LOG_READMSG = 'الرجاء الدخول الى لوحة التحكم لقراءة الرسالة';
	public $_SUBCON_APPRNTF = 'إشعار بالموافقة على المحتوى المرسل';
	public $_SUBCON_ATAPPR = 'تمت الموافقة على المحتوى المرسل الخاص بك في s٪.';
	public $_SECTION = 'قسم';
	public $_CATEGORY = 'تصنيف';

	//elxis 2008.1
	public $_MANAPPROVE = 'حتى يتسنى للمستخدم جديد القادرة على الدخول ، يجب الموافقه على التسجيل يدويا !';
	public $_ACCUNBLOCK = "حسابك في %s تم تفعيلة من قبل المسؤول العام. يمكنك الدخول بـ %s";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'إشعار بتعليق جديد';
	public $_E_NEWCOMBYTITLE = "تعليق جديد بواسطة %s على مقالتك بعنوان %s";
    public $_E_COMSTAYUNPUB = 'هذا التعليق لن ينشر حتى تقوم انت او مشؤول النظام الرئيسي بنشره.';
    public $_E_ACCEXPDATE = 'تاريخ انتهاء صلاحية الحساب';

	public function __construct() {
	}

}

?>