<?php 
/**
* @version: 2009.1
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component eBlog
* @author: Elxis Team
* @translator: Ivan Trebješanin
* @link: http://www.elxis-srbija.org
* @email: admin@elxis-srbija.org
* @description: Srpska ćirilica za komponentu eBlog
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class eBlogLang {


	public $ELXISBLOG = 'Elxis Блог';
	public $TAGS = 'Тагови';
	public $UNKNOWNTAG = 'Непознат таг';
	public $PERMLINK = 'Стални линк';
	public $COMMENTS = 'Коментари';
	public $COMMENT = 'Коментар'; //(noun, i.e. 1 comment)
	public $NOCOMMENTS = 'Нема коментара.';
	PUBLIC $MUSTLOGTOCOM = 'Морате се пријавити пре него што поставите коментар.';
	public $POSTCOMMENT = 'Поставите коментар';
	public $YOURCOMMENT = 'Ваш коментар';
	public $NALLPOSTCOM = 'Није Вам дозвољено кометарисање!';
	public $MUSTWRITEMSG = 'Морате унети поруку!';
	public $COMADDSUC = 'Ваш коментар је успешно додат!';
	public $WAITRETRY = 'Молимо Вас да пробате након пар секунди поново!';
	public $NALLPERFACT = 'Ово што покушавате да урадите није Вам дозвољено!';
	public $ARTNOFOUND = 'Не могу да пронађем захтевану поруку!';
	public $POSTSTAGASAT = "Постови са тагом %s на %s"; //example: Posts tagged as computer at ElectroBlog";
	public $ARCHIVES = 'Архив';
	public $USERBLOGSAT = "Блогови корисника на %s"; //s: site name
	public $USERBLOGS = 'Блогови корисника';
	public $THEREAREBLOGS = "Постоји %s блогова"; //s: number of available blogs
	public $POSTS = 'Поруке';

	//control panel
	public $CPANEL = 'Контролна табла';
	public $MANBLOG = 'Уређивање блога';
	public $ALLPOSTS = 'Сви постови';
	public $LATESTPOSTS = "Најновијих %s постова";
	public $SETTINGS = 'Подешавања';
	public $CSSFILE = 'CSS фајл';
	public $RTLCSSFILE = 'RTL CSS фајл';
	public $COMMENTARY = 'Коментарисање';
	public $NOTALLOWED = 'Недозвољено'; //Commentary
	public $REGUSERS = 'Регистровани корисници'; //Commentary
	public $ALLOWEDALL = 'Дозвољено свима'; //Commentary
	public $POSTSNUMBER = 'Број постова';
	public $POSTSNUMBERD = 'Број најновијих постова за приказ на насловној страни.';
	public $SHOWTAGSD = 'Укључите или искључите приказ тагова испод постова.';
	public $CSSFILED = 'Стил који ће Ваш блог користити. CSS садржи информације о изгледу, фонтовима, бојама, и општем изгледу блога.';
	public $RTLCSSFILED = 'Стил који ће Ваш блог користити за приказ на језицима који се читају сдесна налево, као што су персијски или хебрејски.';
	public $OPTION = 'Опција';
	public $VALUE = 'Вредност';
	public $HELP = 'Помоћ';
	public $NEWPOST = 'Нови пост';
	public $EDITPOST = 'Уредите пост';
	public $TITLENOEMPTY = 'Наслов не може остати празан!';
	public $FOLDERCNOTCR = "Директоријум %s не може бити креиран!"; //%s: folder name
	public $DIMENSIONS = 'Димензијњ (Ш x В)';
	public $SIZEKB = 'Величина (KB)';
	public $LISTVIEW = 'Листа';
	public $THUMBSVIEW = 'Сличице';
	public $UPLOAD = 'Додавање';
	public $UPLOADIMG = 'Додавање слике';
	public $MEDIAMAN = 'Менаџер медија';
	public $YOUTUBEVIDEO = 'YouTube видео';
	public $GOOGLEVIDEO = 'Google видео';
	public $YAHOOVIDEO = 'Yahoo видео';
	public $COMSEPTAGS = 'Зарезом одвојени тагови';
	public $SLOGAN = 'Слоган';
	public $SLOGAND = 'Слоган који ће бити приказан у заглављу Вашег блога. Можете користити html.';
	public $SHOWOWNER = 'Приказ власника';
	public $SHOWOWNERD = 'Приказ имена власника блога у заглављу?';
	public $SHOWARCHIVE = 'Приказ архива';
	public $SHOWARCHIVED = 'Приказ архива месеци у футеру блога?';

	//SEO titles
	public $SEOTITLE = 'SEO наслов';
	public $SEOTITLEEMPTY = 'SEO наслов не може бити празан!';
	public $INVALID = 'Неисправно';
	public $VALID = 'Исправно';
	public $SEOTEXIST = 'SEO наслов већ постоји!';
	public $SEOTLARGER = 'Пробајте са дужим насловом!';
	public $SEOTHELP = 'Морате користити мала латинична слова, бројеве, косе црте и подцрте. SEO наслов мора бити јединствен! Пробајте да унесете разумљив и јединствен SEO наслов.';
	public $SEOTSUG = 'Предложени SEO наслов';
	public $SEOTVAL = 'Провера SEO наслова';

	//languages names
	public $ARMENIAN = 'Јерменски';
	public $BOZNIAN = 'Босански';
	public $BRAZILIAN = 'Бразлски';
	public $BULGARIAN = 'Бугарски';
	public $CREOLE = 'Креолски';
	public $CROATIAN = 'Хрватски';
	public $DANISH = 'Дански';
	public $ENGLISH = 'Енглески';
	public $FRENCH = 'Француски';
	public $GERMAN = 'Немачки';
	public $GREEK = 'Грчки';
	public $INDONESIAN = 'Индонезијски';
	public $ITALIAN = 'Италијански';
	public $JAPANESE = 'Јапански';
	public $LATVIAN = 'Летонски';
	public $LITHUANIAN = 'Литвански';
	public $PERSIAN = 'Персијски';
	public $POLISH = 'Пољски';
	public $RUSSIAN = 'Руски';
	public $SERBIAN = 'Srpski';
	public $SPANISH = 'Шпански';
	public $SRPSKI = 'Српски';
	public $TURKISH = 'Турски';
	public $VIETNAMESE = 'Вијетнамски';

	//backend
	public $BLOGINFO = 'Информације о блогу';
	public $CANCONFIGD = 'Да ли ће власник блога имати могућност уређивања путем јавног дела сајта?';
	public $CANUPLOADD = 'Да ли желите да омогућите власнику блога да додаје мултимедијалне садржаје?';
	public $BLOGOWNMDIR = 'Директоријум медија власника блога';
	public $EXISTING = 'Постојећи';
	public $NONEXISTING = 'Непостојећи';
	public $SIZEKBD = 'Максимална величина фајлова које је могуће додати, дата у KB. Уобичајена вредност је 2000 (2MB).';
	public $BLOGOWNER = 'Власника блога';
	public $UPLOADDIR = 'Директоријум додавања';
	public $UPLOADEDFILES = 'Додати фајлови';
	public $USEDSPACE = 'Употребљени простор';
	public $LASTPOST = 'Последњи пост';
	public $LASTPOSTDATE = 'Датум последњег поста';
	public $NOTSETYET = 'Није подешено';
	public $UNOTALLUPLOADF = 'Кориснику није дозвољено додавање фајлова.';

	//elxis 2009.1
	public $INVDATE = 'Датум који сте изабрали није исправан.';
	public $METADESCDAY = "Поруке за %s на %s"; //Posts for DATE on EBLOG_TITLE
	public $NOPOSTSFDATE = 'Нема порука пронађених за овај датум.';
	public $SHAREPOST = 'Подели овај чланак';


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
	}

}

?>
