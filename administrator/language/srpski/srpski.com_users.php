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
* @description: Srpski language for component users
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_USS_LOGIN = 'Пријављен';
public $A_CMP_USS_ALL = 'Сви';
public $A_CMP_USS_ID = 'Кориснички ID';
public $A_CMP_USS_LSTV = 'Последња посета';
public $A_CMP_USS_ENBLD = 'Омогућено';
public $A_CMP_USS_BLCKD = 'Блокирано';
public $A_CMP_USS_LVDATE = '%Y-%m-%d %H:%M:%S'; //Last visit Date
public $A_CMP_USS_PFISNOT = 'Изаберите другу групу, јер \'Јавни интерфејс\' није прихватљив избор';
public $A_CMP_USS_PBISNOT = 'Изаберите другу групу, јер \'Јавна администација\' није прихватљив избор';
public $A_CMP_USS_DETAILS = 'Подаци о кориснику';
public $A_CMP_USS_EMAIL = 'е-пошта';
public $A_CMP_USS_PASS = 'Нова лозинка';
public $A_CMP_USS_VERIFY = 'Потврда лозинке';
public $A_CMP_USS_BLOCK = 'Блокирање корисника';
public $A_CMP_USS_SUBMI = 'Пријем порука о додатим чланцима';
public $A_CMP_USS_REGDATE = 'Датум регистрације';
public $A_CMP_USS_VISDTE = 'Датум задње посете';
public $A_CMP_USS_CONTCT = 'Информације о контакту';
public $A_CMP_USS_NDETL = 'Нема информација о контакту повезаних са овим корисником:<br />Погледајте \'Компоненте -> Контакт -> Уређивање контаката за више информација.';
public $A_CMP_USS_SUCCH = 'Успешно су сачуване измене корисника';
public $A_CMP_USS_SUCUSR = 'Успешно је сачуван корисник';
public $A_CMP_USS_CANNOT = 'Не можете да обришете Суперадминистатора';
public $A_CMP_USS_CANNYO = 'Не можете да обришете себе!';
public $A_CMP_USS_CANNUS = 'Није Вам дозвољено да обришете овог корисника';
public $A_CMP_USS_SLUSER = 'Изаберите корисника';
public $A_CMP_USS_FLGOUT = 'Присилна одјава';
public $A_CMP_USS_UMUST = 'Морате унети корисничко име.';
public $A_CMP_USS_ULOGIN = 'Ваше корисничко име садржи специјалне карактере или је прекратко.';
public $A_CMP_USS_MSTEMAIL = 'Морате унети исправну адресу е-поште.';
public $A_CMP_USS_ASSIGN = 'Корисник мора да припада некој групи.';
public $A_CMP_USS_NOMATC = 'Лозинке се не подударају.';
public $A_CMP_USS_FLOGD = 'Филтер пријављених';
public $A_CMP_USS_FACST = 'Филтер активних';
public $A_CMP_USS_PHONE = 'Телефон';
public $A_CMP_USS_FAX = 'Факс';
public $A_CMP_USS_NOEXTRA = 'Додатна корисничка поља нису подешена или објављена';
public $A_CMP_USS_VERTICAL = 'Вертикалнo';
public $A_CMP_USS_HORIZONT = 'Хоризонтално';
public $A_CMP_USS_CHECKED = 'оверено';
public $A_CMP_USS_1OPTVLEAST = 'Барем једна опција и једна изабрана опција морају постојати';
public $A_CMP_USS_1OPTLEAST = 'Брем једнa опција мора бити дата';
public $A_CMP_USS_EXTRASAVED = 'Додатно поље успешно сачувано';
public $A_CMP_USS_CHACONDET = 'измена податаке о контакту';
public $A_CMP_USS_REQUIRED = 'Обавезно';
public $A_CMP_USS_REGISTR = 'Регистрација';
public $A_CMP_USS_PROFILE = 'Профил';
public $A_CMP_USS_RONLY = 'Само за читање';
public $A_CMP_USS_HIDDEN = 'Скривено';
public $A_CMP_USS_SHOWREG = 'Видљиво током регистрације';
public $A_CMP_USS_SHOWPROF = 'Приказ у профилу';
public $A_CMP_USS_OPTALIGN = 'Равнање опција';
public $A_CMP_USS_PREVNOTE = 'Примедба: Морате да сачувате измене како бисте могли да их прегледате.';
public $A_CMP_USS_OPTIONS = 'Опције';
public $A_CMP_USS_OPTIONSFOR = 'Опције за';
public $A_CMP_USS_MUSTFNAME = 'Пољу морате дати име';
public $A_CMP_USS_MAXLENINV = 'Максимална дужина поља није исправна';
public $A_CMP_USS_HIDMUSTVAL = 'Скривено поље мора садржати вредност!';
public $A_CMP_USS_DEFVAL = 'Уобичајена вредност';
public $A_CMP_USS_MAXLEN = 'Макс. дужина';
public $A_CMP_USS_REQFLDSNO = 'Једно или више обавезних поља није попуњено!';
public $A_CMP_USS_HIDNOREQ = 'Скривено поље не може бити обавезно!';
public $A_CMP_USS_HIDNOPROF = 'Скривено поље не може се приказати у профилу!';
public $A_CMP_USS_PREFLANG = 'Изабрани језик';
public $A_CMP_USS_AVATAR = 'Аватар';
public $A_CMP_USS_WEBSITE = 'Web сајт';
public $A_CMP_USS_AIM = 'AIM';
public $A_CMP_USS_YIM = 'YIM';
public $A_CMP_USS_MSN = 'MSN';
public $A_CMP_USS_ICQ = 'ICQ';
public $A_CMP_USS_MOBILE = 'Мобилни тел.';
public $A_CMP_USS_BIRTHDATE = 'Рођендан';
public $A_CMP_USS_GENDER = 'Пол';
public $A_CMP_USS_LOCATION = 'Локација';
public $A_CMP_USS_OCCUPATION = 'Занимање';
public $A_CMP_USS_SIGNATURE = 'Потпис';
public $A_CMP_USS_MALE = 'Мушко';
public $A_CMP_USS_FEMALE = 'Женско';
public $A_CMP_USS_YEAR = 'Година';
public $A_CMP_USS_MONTH = 'Месец';
public $A_CMP_USS_DAY = 'Дан';
public $A_CMP_USS_BOLDINDIC = 'Поља која су обележена подебљаним словима укључена су у корисничким профилима.';
public $A_CMP_USS_ENDISSOFT = 'Можете укључити/искључити елементе профила кроз SoftDisk.';

//2009.0
public $A_USERS_EXPDATE = 'Датум истека';
public $A_USERS_ACCEXPIRED = 'Налог је истекао';
public $A_USERS_ACCNACTIVE = 'Налог је активан';

}

?>