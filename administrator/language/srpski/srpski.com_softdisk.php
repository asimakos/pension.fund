<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ivan Trebješanin
* @translator URL: http://www.elxis-srbija.org
* @email: admin@elxis-srbija.org
* @description: Srpski language for component softdisk
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CORE = 'Систем';
public $A_ASTATS = 'Статистике администрације';
public $A_VALUE = 'Вредност';
public $A_LASTMOD = 'Последња измена';
public $A_OS = 'Оперативни систем';
public $A_ELXIS_VERSION = 'Elxis верзија';
public $A_SELECT = 'Избор';
public $NOEDITSYS = 'Није Вам дозвољено да мењате системске вредности';
public $A_RESTORE = 'Враћање';
public $SOFTDISK_HELP = 'SoftDisk је виртуелна остава за променљиве и параметре свих врста.<br />
  	Можете да додајете нове или уређујете/бришете постојеће SoftDisk уносе, осим оних које припадају систему. 
	Такође, уносе са ознаком "неизбрисиво" могуће је само уређивати. За именовање SoftDisk секција и назива вредности 
	можете да користите само <strong>велика латинична слова, бројеве и доњу црту(_)</strong>.';
public $YCNOTEDITP = 'Не можете да уређујете овај параметар';
public $UNDELETABLE = 'Неизбрисиво';
public $SOFTENTRYEXIST = 'Већ постоји SoftDisk унос под тим именом!';
public $INVSECTNAME = 'Неисправно име секције!';
public $INVNAME = 'Неправилно име!'; 
public $INVEMAIL = 'Унета вредност није исправна адреса е-поште!';
public $INVURL = 'Унета вредност није исправан URL!';
public $INVDEC = 'Унета вредност није децимални број!';
public $INVTSTAMP = 'Унета вредност није исправан UNIX временски печат!';
public $UPSYSTEM = 'Ажурирање система';
public $A_USERPROFILE = 'Кориснички профил';
public $UPROF_WEBSITE = 'Web сајт';
public $UPROF_AIM = 'AIM';
public $UPROF_YIM = 'YIM';
public $UPROF_MSN = 'MSN';
public $UPROF_ICQ = 'ICQ';
public $UPROF_EMAIL = 'Адреса е-поште';
public $UPROF_PHONE = 'Телефон';
public $UPROF_MOBILE = 'Мобилни тел.';
public $UPROF_BIRTHDATE = 'Рођендан';
public $UPROF_GENDER = 'Пол';
public $UPROF_LOCATION = 'Локација';
public $UPROF_OCCUPATION = 'Занимање';
public $UPROF_SIGNATURE = 'Потпис';
public $UPROF_ARTICLES = 'Број чланака';
public $UPROF_USERGROUP = 'Корисничка група';
public $UPROF_RANDUSERS = 'Приказ неких корисника на страници профила';
public $USERS_RPASSMAIL = 'Обавештење администраторима о слању изгубљене лозинке';
public $SUBMIT_CATEGORIES = 'Категорије у које је дозвољено додавати садржаје (предложене). Уколико је празно, све су дозвољене. (ID-јеви категорија, одвојени зарезом)';
public $SUBMIT_SECTIONS = 'Секције у које је дозвољено додавати садржаје (предложене). Уколико је празно, све су дозвољене. (ID-јеви секција, одвојени зарезом)';
public $REG_AGREE = 'ID независне странице уговора о регистрацији. Нула (0) значи да је искључено. За уговор на одређеном језику, направите SoftDisk запис типа број у секцији КОРИСНИЦИ за сваки језик REG_AGREE_LANGUAGE-HERE';
public $A_WEBLINKS = 'Web линкови';
public $TOP_WEBLINK = 'Коктролише приказ модула Најпопуларнији Web линкови унутар компоненте Web линкови';
public $A_USERSLIST = 'Листа корисника';
public $ULIST_ONLINE = 'Тренутни статус';
public $ULIST_USERNAME = 'Корисничко име';
public $ULIST_NAME = 'Име';
public $ULIST_REGDATE = 'Датум регистрације';
public $ULIST_PREFLANG = 'Изабрани језик';
public $STATICCACHE = 'Static cache';

}

?>