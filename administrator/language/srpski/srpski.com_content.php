<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ivan Trebješanin
* @translator URL: http://www.elxis-srbija.org
* @email: admin@elxis-srbija.org
* @description: Srpski language for component content
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_CNT_ITEMSMNG = 'Менаџер садржаја';
public $A_CMP_CNT_DATEFORMAT = 'Y-m-d h:i:s';
public $A_CMP_CNT_ALTEDITCONT = 'Уређивање садржаја';
public $A_CMP_CNT_TRASH = 'Изаберите ставку коју желите да пошаљете у канту за отпатке';
public $A_CMP_CNT_TRASHMESS = 'Да ли сте сигурни да желите да баците изабрану ставку(е) садржаја? \nОвим нећете трајно обрисати ставку(е) садржаја.';
public $A_CMP_CNT_ARCHMANAGER = 'Менаџер архива';
public $A_CMP_CNT_DATECREATED = '%A, %d %B %Y %H:%M';
public $A_CMP_CNT_DATEMODIFIED = '%A, %d %B %Y %H:%M';
public $A_CMP_CNT_MUSTTITLE = 'Ставка садржаја мора имати наслов.';
public $A_CMP_CNT_MUSTSECTN = 'Морате изабрати секцију.';
public $A_CMP_CNT_MUSTCATEG = 'Морате изабрати категорију.';
public $A_CMP_CNT_CONTITEM = 'Ставка садржаја';
public $A_CMP_CNT_ITEMDETLS = 'Подаци о ставци';
public $A_CMP_CNT_INTRO = 'Увод: (обавезно)';
public $A_CMP_CNT_MAIN = 'Главни текст: (изборно)';
public $A_CMP_CNT_FRONTPAGE = 'Приказ на Насловној';
public $A_CMP_CNT_AUTHOR = 'Псеудоним аутора';
public $A_CMP_CNT_CREATOR = 'Измена аутора';
public $A_CMP_CNT_OVERRIDE = 'Измена датума настанка';
public $A_CMP_CNT_STRTPUB = 'Почетак објављивања';
public $A_CMP_CNT_FNSHPUB = 'Крај објављивања';
public $A_CMP_CNT_DRFTUNPUB = 'Необјављени нацрт';
public $A_CMP_CNT_RESETHIT = 'Поништавање броја прегледа';
public $A_CMP_CNT_REVISED = 'Ревидирано';
public $A_CMP_CNT_TIMES = 'пута';
public $A_CMP_CNT_BY = 'од стране';
public $A_CMP_CNT_NEWDOC = 'Нови документ';
public $A_CMP_CNT_LASTMOD = 'Задња измена';
public $A_CMP_CNT_NOTMOD = 'Неизмењено';
public $A_CMP_CNT_ADDETC = 'Додавање Секц./Кат./Наслов';
public $A_CMP_CNT_LINKCI = 'Ово ће креирати \'Линк - ставка садржаја\' у изабраном менију';
public $A_CMP_CNT_SOMTHING = 'Изаберите нешто';
public $A_CMP_CNT_MVEITEMS = 'Премештај ставки';
public $A_CMP_CNT_MVESECCAT = 'Премештај у секцију/категорију';
public $A_CMP_CNT_ITMSMVED = 'Ставке за премештај';
public $A_CMP_CNT_SECCAT = 'Изаберите секцију/категорију у коју ће ставке бити копиране';
public $A_CMP_CNT_CPYITEMS = 'Копирање ставки';
public $A_CMP_CNT_CPYSECCAT = 'Копирање у секцију/категорију';
public $A_CMP_CNT_ITMSCPED = 'Ставке које се копирају';
public $A_CMP_CNT_CCHECL = 'Кеш је очишћен';
public $A_CMP_CNT_CANNOT = 'Не можете уређивати архивирану ставку';
public $A_CMP_CNT_THMODULIS = 'Модул';
public $A_CMP_CNT_DROWCRED = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_DROWMOD = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_DROWPUB = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_PBLINEV = 'Никада';
public $A_CMP_CNT_DPUBLISHUP = 'Y-m-d';
public $A_CMP_CNT_SLSECTN = 'Избор секције';
public $A_CMP_CNT_SELCAT = 'Избор категорије';
public $A_CMP_CNT_ARCHVED = 'Ставка је успешно архивирана';
public $A_CMP_CNT_PUBLSHED = 'Ставка је успешно објављена';
public $A_CMP_CNT_ITSUUNP = 'Ставка је успешно одјављена';
public $A_CMP_CNT_ITSUUNA = 'Ставка је успешно деархивирана';
public $A_CMP_CNT_SELITOG = 'Изаберите ставку за измену';
public $A_CMP_CNT_SELIDEL = 'Изаберите ставку за брисање';
public $A_CMP_CNT_ERROCCRD = 'Дошло је до грешке';
public $A_CMP_CNT_MOVD = 'Ставка је успешно премештена у секцију';
public $A_CMP_CNT_COPED = 'Ставка је успешно копирана у секцију';
public $A_CMP_CNT_RSTHTCNT = 'Успешно је поништен број прегледа за';
public $A_CMP_CNT_INMENU = '(Линк - независна страна) у менију';
public $A_CMP_CNT_SUCCSS = 'успешно креирана';
public $A_CMP_CNT_RSZERO = 'Да ли сте сигурни да желите да поништите број прегледа на нулу? \nСве измене ове ставке ће бити изгубљене.';
public $A_CMP_CNT_MUST_CIMNA = 'Ставка садржаја мора имати име';
public $A_CMP_CNT_SITMAPFOR = 'Мапа сајта за';
public $A_CMP_CNT_ALLLANGS = 'Сви језици';
public $A_CMP_CNT_LANG = 'језик';
public $A_CMP_CNT_PHRENAME = 'Држите притиснуто да бисте преименовали';
public $A_CMP_CNT_EDITITEM = 'Уређивање ставке';
public $A_CMP_CNT_NOTES = 'Белешке';
public $A_CMP_CNT_PRSHREN = 'Држите притиснуто да бисте преименовали ставку';
public $A_CMP_CNT_EMPCATSEC = 'Стабло не приказује празне секције и категорије.';
public $A_CMP_CNT_TREEUNPUBL = 'Ставке означене сивом бојом и курзивом су одјављене';
public $A_CMP_CNT_NULLVAL = 'Прослеђена је нулта вредност!';
public $A_CMP_CNT_INCCTP = 'Неисправан тип садржаја';
public $A_CMP_CNT_CLDNFETCH = 'Не могу да проследим податке';
public $A_CMP_CNT_TRSELPAIR = 'Изаберите језички пар';
public $A_CMP_CNT_TRSOUDEST = 'Изаберите изворни и одредишни језик';
public $A_CMP_CNT_TRITEMS = 'Превод ставке је у току';
public $A_CMP_CNT_TRNOTE = '<strong>Белешка:</strong> Пажљиво изаберите изворни и одредишни језик. Ова процедура може потрајати 
        у зависности од количине текста који треба превести.<br />
        Превод је базиран на бесплатном Altavista сервису за преводе.
        Elxis није одговоран за квалитет превода.';
public $A_CMP_CNT_TRSELITEM = 'Изаберите ставку за превод';
public $A_CMP_CNT_TROKSAVED = 'Ставка је успешно преведена и копирана';
public $A_CMP_CNT_TRITMNOTF = 'Изабрана ставка није пронађена у бази!';
public $A_CMP_CNT_MFS = 'Порука од сервера';
public $A_CMP_CNT_WID = 'са id-јем';
public $A_CMP_CNT_RNMTO = 'преименована у';
public $A_CMP_CNT_FL= 'Филтер језика';
public $A_CMP_CNT_CONFL = 'Језички конфликт';
public $A_CMP_CNT_CONFI = 'Ставка је смештема у категорију чија језичка подешавања не дозвољавају њен приказ!';
public $A_CMP_CNT_STARTALW = 'Почетак: увек';
public $A_CMP_CNT_FINNOEXP = 'Крај: без истека';
public $A_CMP_CNT_FINISH = 'Крај';
public $A_CMP_CNT_FROM = 'од';
public $A_CMP_CNT_SHOWHIDE = 'Приказано/Скривено';
public $A_SIMPLEVIEW = 'Једноставни приказ';
public $A_EXTENDVIEW = 'Напредни приказ';
public $A_CMP_CNT_COMMENTS = 'Коментари';
public $A_CMP_CNT_SAVTRANS = 'Ставке су пребачене и сачуване као садржај сајта';
public $A_CMP_CNT_RELLINKS = 'Сродни линкови';
public $A_CMP_CNT_RELLINKSD = 'Линкови блиски овом чланку. Уколико желите да додате екстерне линкове, додајте http:// на почетак URL-а.';

}

?>
