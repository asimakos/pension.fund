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
* @description: Srpski language for component config
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

	public $A_COMP_CONF_OFFLINE = 'Сајт је недоступан';
	public $A_COMP_CONF_OFFMESSAGE = 'Порука о недоступности';
	public $A_COMP_CONF_TIP_OFFMESSAGE = 'Порука која ће бити приказана када је сајт недоступан';
	public $A_COMP_CONF_ERR_MESSAGE = 'Порука о системској грешци';
	public $A_COMP_CONF_TIP_ERR_MESSAGE = 'Порука која ће бити приказана уколико Elxis не може да се повеже са базом';
	public $A_COMP_CONF_SITE_NAME = 'Име сајта';
	public $A_COMP_CONF_UN_LINKS = 'Приказ неауторизованих линкова';
	public $A_COMP_CONF_UN_TIP = 'Постављено на Да, приказаће линкове намењене регистрованим корисницима. Корисници морају да се пријаве како би садржај видели у потпуности.';
	public $A_COMP_CONF_USER_REG = 'Самостална регистрација';
	public $A_COMP_CONF_TIP_USER_REG = 'Постављено на Да, дозволиће корисницима да се самостално региструју';
	public $A_COMP_CONF_REQ_EMAIL = 'Јединствена адреса е-поште';
	public $A_COMP_CONF_REQTIP = 'Постављено на Да, онемогућиће да корисници деле исту адресу е-поште';
	public $A_COMP_CONF_DEBUG = 'Дебаговање';
	public $A_COMP_CONF_DEBTIP = 'Постављено на Да, приказаће дијагностичке информације и SQL грешке';
	public $A_COMP_CONF_EDITOR = 'WYSIWYG Editor';
	public $A_COMP_CONF_LENGTH = 'Дужина листе';
	public $A_COMP_CONF_LENTIP = 'Предефинише дужину листе за администратора и кориснике';
	public $A_COMP_CONF_FAV_ICON = 'Икона фаворизованих сајтова';
	public $A_COMP_CONF_FAVTIP = 'Уколико је ово празно, или фајл не постоји, предефинисана favicon.ico ће бити коришћена';
	public $A_COMP_CONF_CLINKACC = 'Компоненте повезане са приступним системом';
	public $A_COMP_CONF_CLACCDESC = 'Изаберите компоненте на које ће бити примењен систем контроле приступа кроз јавни интерфејс (ACO вредност = преглед). Прочитајте Помоћ уколико нисте сигурни.';
	public $A_COMP_CONF_CORECOMPS = 'Основне компоненте';
	public $A_COMP_CONF_3RDCOMPS = 'Додатне компоненте';
	public $A_COMP_CONF_ALLCOMPS = 'Све компоненте';
	public $A_COMP_CONF_CAPTCHA = 'Употреба сигурносних слика';
	public $A_COMP_CONF_CAPTCHATIP = 'Да, уколико желите да слике (Captcha) буду приказане на формама. Изговор заштитног кôда ће бити омогућен за људе који имају потешкоћа са видом.';
	public $A_COMP_CONF_LOCALE = 'Локализација';
	public $A_COMP_CONF_LANG = 'Предефинисани језик интерфејса';
	public $A_COMP_CONF_ALANG = 'Предефинисани језик администрације';
	public $A_COMP_CONF_TIME_SET = 'Временско одступање';
	public $A_COMP_CONF_DATE = 'Тренутна конфигурација датума/времена за приказ';
	public $A_COMP_CONF_LOCAL = 'Локализација земље';
	public $A_COMP_CONF_LOCRECOM = 'Препоручљиво је оставити на аутоматском избору. Elxis ће учитати одговарајућу локализацију на основу изабраног језика и оперативног система. Windows не подржава UTF-8 локализације.';
	public $A_COMP_CONF_LOCCHECK = 'Провера локализације';
	public $A_COMP_CONF_LOCCHECK2 = 'Уколико је датум који видите добро форматиран, значи да локализација одговара Вашем оперативном систему и изабраном језику.<br /><strong>Пажња!</strong> Под Windows-ом, локализација ће аутоматски бити подешена на English.';
	public $A_COMP_CONF_AUTOSEL = 'Аутоматски избор';
	public $A_COMP_CONF_CONTROL = '* Ови параметри контролишу излазне елементе *';
	public $A_COMP_CONF_LINK_TITLES = 'Линковани наслови';
	public $A_COMP_CONF_LTITLES_TIP = 'Постављено на Да, повезаће наслов са одговарајућом ставком садржаја';
	public $A_COMP_CONF_MORE_LINK = 'Линк опширније';
	public $A_COMP_CONF_MLINK_TIP = 'Уколико је укључено, линк опширније ће бити приказан за ставке које имају главни текст';
	public $A_COMP_CONF_RATE_VOTE = 'Вредновање/Гласање';
	public $A_COMP_CONF_RVOTE_TIP = 'Уколико је укључено, систем гласања ће бити омогућен за дату ставку садржаја';
	public $A_COMP_CONF_AUTHOR = 'Имена аутора';
	public $A_COMP_CONF_AUTHORTIP = 'Уколико је укључено, име аутора ће бити приказано. Ово је опште подешавање које може бити измењено на нивоу ставке садржаја или менија';
	public $A_COMP_CONF_CREATED = 'Датум и време настанка';
	public $A_COMP_CONF_CREATEDTIP = 'Уколико је укључено, биће приказани датум и време настанка ставке. Ово је опште подешавање које може бити измењено на нивоу ставке садржаја или менија';
	public $A_COMP_CONF_MOD_DATE = 'Датум и време задње измене';
	public $A_COMP_CONF_MDATETIP = 'Уколико је укључено, биће приказани датум и време задње измене ставке садржаја. Ово је опште подешавање које може бити измењено на нивоу ставке садржаја или менија';
	public $A_COMP_CONF_HITS = 'Прегледа';
	public $A_COMP_CONF_HITSTIP = 'Уколико је укључено, биће приказан број читања за дату ставку садржаја. Ово је опште подешавање које може бити измењено на нивоу ставке садржаја или менија';
	public $A_COMP_CONF_PDF = 'PDF икона';
	public $A_COMP_CONF_OPT_MEDIA = 'Опција није доступна јер /tmpr директоријум није откључан';
	public $A_COMP_CONF_PRINT_ICON = 'Икона штампе';
	public $A_COMP_CONF_EMAIL_ICON = 'Икона е-поште';
	public $A_COMP_CONF_ICONS = 'Иконе';
	public $A_COMP_CONF_USE_OR_TEXT = 'Штампа, RTF, PDF и е-пошта ће користити иконе или текст';
	public $A_COMP_CONF_TBL_CONTENTS = 'Садржај за вишестране текстове';
	public $A_COMP_CONF_BACK_BUTTON = 'Дугме назад';
	public $A_COMP_CONF_CONTENT_NAV = 'Навигација ставке садржаја';
	public $A_COMP_CONF_HYPER = 'Употреба линкованих наслова';
	public $A_COMP_CONF_DBTYPE = 'Тип базе';
	public $A_COMP_CONF_DBWARN = 'Не мењајте ово уколико Ваш систем не подржава ову базу и немате Elxis податке већ инсталиране на овој бази!';
	public $A_COMP_CONF_HOSTNAME = 'Домаћин';
	public $A_COMP_CONF_DB_PW = 'Лозинка';
	public $A_COMP_CONF_DB_NAME = 'База';
	public $A_COMP_CONF_DB_PREFIX = 'Префикс базе';
	public $A_COMP_CONF_NOT_CH = '!! НЕ МЕЊАЈТЕ ОВО УКОЛИКО НЕМАТЕ БАЗУ СА ПРЕФИКСОМ КОЈИ ПОКУШАВАТЕ ДА ПРИМЕНИТЕ !!';
	public $A_COMP_CONF_ABS_PATH = 'Aпсолутна путања';
	public $A_COMP_CONF_LIVE = '"Живи" сајт';
	public $A_COMP_CONF_SECRET = 'Тајна реч';
	public $A_COMP_CONF_GZIP = 'GZIP компресија';
	public $A_COMP_CONF_CP_BUFFER = 'Компресија бафера је могућа';
	public $A_COMP_CONF_SESSION_TIME = 'Дужина сесије';
	public $A_COMP_CONF_SEC = 'секунди';
	public $A_COMP_CONF_AUTO_LOGOUT = 'Аутоматска одјава након оволико секунди';
	public $A_COMP_CONF_ERR_REPORT = 'Пријава грешака';
	public $A_COMP_CONF_HELP_SERVER = 'Сервер помоћи';
	public $A_COMP_CONF_META_PAGE = 'метаподаци-страница';
	public $A_COMP_CONF_META_DESC = 'Општа мета-подешавања за сајт';
	public $A_COMP_CONF_META_KEY = 'Опште кључне речи за сајт';
	public $A_COMP_CONF_HPS1 = 'Локални фајлови помоћи';
	public $A_COMP_CONF_HPS2 = 'Elxis-ов удаљени сервер помоћи';
	public $A_COMP_CONF_HPS3 = 'Званични Elxis сервер помоћи';
	public $A_COMP_CONF_PERMFLES = 'Изаберите ову опцију уколико желите да примените дозволе на нове фајлове';
	public $A_COMP_CONF_PERMDIRS = 'Изаберите ову опцију уколико желите да примените дозволе на нове директоријуме';
	public $A_COMP_CONF_NCHMODDIRS = 'Без CHMOD-овања нових директоријума (користи предефиниције севера)';
	public $A_COMP_CONF_CHAPFLAGS = 'Уколико је штиклирано, примениће дозволе на <em>све постојеће фајлове</em> сајта.<br/><strong>НЕПРАВИЛНА УПОТРЕБА ОВЕ ОПЦИЈЕ МОЖЕ САЈТ УЧИНИТИ НЕУПОТРЕБЉИВИМ!</strong>';
	public $A_COMP_CONF_CHAPDLAGS = 'Уколико је штиклирано, примениће дозволе на <em>све постојеће директоријуме</em> сајта.<br/><strong>НЕПРАВИЛНА УПОТРЕБА ОВЕ ОПЦИЈЕ МОЖЕ САЈТ УЧИНИТИ НЕУПОТРЕБЉИВИМ!</strong>';
	public $A_COMP_CONF_APPEXDIRS = 'Примена на постојеће директоријуме';
	public $A_COMP_CONF_APPEXFILES = 'Примена на постојеће фајлове';
	public $A_COMP_CONF_WORLD = 'Сви';
	public $A_COMP_CONF_CHMODNDIRS = 'CHMOD нових директоријума';
	public $A_COMP_CONF_MAIL = 'Поштар';
	public $A_COMP_CONF_MAIL_FROM = 'Пошта од';
	public $A_COMP_CONF_MAIL_FROM_NAME = 'Од';
	public $A_COMP_CONF_MAIL_SMTP_AUTH = 'SMTP ауторизација';
	public $A_COMP_CONF_MAIL_SMTP_USER = 'SMTP корисник';
	public $A_COMP_CONF_MAIL_SMTP_PASS = 'SMTP лозинка';
	public $A_COMP_CONF_MAIL_SMTP_HOST = 'SMTP домаћин';
	public $A_COMP_CONF_CACHE = 'Кеширање';
	public $A_COMP_CONF_CACHE_FOLDER = 'Директоријум кеша';
	public $A_COMP_CONF_CACHE_DIR = 'Тренутни директоријум кеша је';
	public $A_COMP_CONF_CACHE_DIR_UNWRT = 'Директоријум кеша је ЗАКЉУЧАН - поставите CHMOD на 777 пре него што укључите кеш';
	public $A_COMP_CONF_CACHE_TIME = 'Време кеширања';
	public $A_COMP_CONF_STATS = 'Статистике';
	public $A_COMP_CONF_STATS_ENABLE = 'Укључено/Искључено прикупљање статистика';
	public $A_COMP_CONF_STATS_LOG_HITS = 'Број прегледа по датуму';
	public $A_COMP_CONF_STATS_WARN_DATA = 'УПОЗОРЕЊЕ : Биће прикупљена велика количина података';
	public $A_COMP_CONF_STATS_LOG_SEARCH = 'Евиденција критеријума претраге';
	public $A_COMP_CONF_SEO_LBL = 'SEO';
	public $A_COMP_CONF_SEO = 'Search Engine Optimization';
	public $A_COMP_CONF_SEO_SEFU = 'Search Engine Friendly URLs';
	public $A_COMP_CONF_SEOBASIC = 'SEO Basic';
	public $A_COMP_CONF_SEOPRO = 'SEO Pro';
	public $A_COMP_CONF_SEOHELP = "Apache и IIS. Apache: преименујте htaccess.txt у .htaccess пре активације (mod_rewrite укључен). IIS: користите Ionic Isapi Rewriter filter. За најбоље перформансе, припремите саджај за SEO PRO. Изаберите SEO Basic уколико користите независну SEF компоненту.";
	public $A_COMP_CONF_SERVER = 'Сервер';
	public $A_COMP_CONF_METADATA = 'Метаподаци';
	public $A_COMP_CONF_CACHE_TAB = 'Кеш';
	public $A_COMP_CONF_FTP_LBL = 'FTP';
	public $A_COMP_CONF_FTP = 'FTP подешавања';
	public $A_COMP_CONF_FTP_ENB = 'Укључен FTP';
	public $A_COMP_CONF_FTP_HST = 'FTP домаћин';
	public $A_COMP_CONF_FTP_HSTTP = 'Највероватније';
	public $A_COMP_CONF_FTP_USR = 'FTP корисничко име';
	public $A_COMP_CONF_FTP_USRTP = 'Највероватније';
	public $A_COMP_CONF_FTP_PAS = 'FTP лозинка';
	public $A_COMP_CONF_FTP_PRT = 'FTP порт';
	public $A_COMP_CONF_FTP_PRTTP = 'Уобичајена вредност је: 21';
	public $A_COMP_CONF_FTP_PTH = 'FTP корен';
	public $A_COMP_CONF_FTP_PTHTP = 'Путања од FTP корена до Elxis инсталације. Нпр. /public_html/elxis';
	public $A_COMP_CONF_HIDE = 'Скривено';
	public $A_COMP_CONF_SHOW = 'Приказано';
	public $A_COMP_CONF_DEFAULT = 'Предефинисано';
	public $A_COMP_CONF_NONE = 'Ништа';
	public $A_COMP_CONF_SIMPLE = 'Једноставно';
	public $A_COMP_CONF_MAX = 'Максимум';
	public $A_COMP_CONF_MAIL_FC = 'PHP функција поште';
	public $A_COMP_CONF_SEND = 'Sendmail';
	public $A_COMP_CONF_SENDP = 'Sendmail путања';
	public $A_COMP_CONF_SMTP = 'SMTP сервер';
	public $A_COMP_CONF_UPDATED = 'Подешавања су успешно <strong>сачувана!</strong>';
	public $A_COMP_CONF_ERR_OCC = '<strong>Дошло је до грешке!</strong> Не могу да отворим конфигурациони фајл за писање!';
	public $A_COMP_CONF_READ = 'читање';
	public $A_COMP_CONF_WRITE = 'писање';
	public $A_COMP_CONF_EXEC = 'извршавање';
	public $A_COMP_CONF_FCRE = 'Креирање фајлова';
	public $A_COMP_CONF_FPERM = 'Дозволе фајлова';
	public $A_COMP_CONF_DCRE = 'Креирање директоријума';
	public $A_COMP_CONF_DPERM = 'Дозволе директоријума';
	public $A_COMP_CONF_OFFEX = 'Да (осим за Суперадминистраторе)';
	public $A_COMP_CONF_RTF = 'RTF Икона';
	public $A_C_CONF_AC_ACT = 'Активација налога';
	public $A_C_CONF_NOACT = 'Без активација';
	public $A_C_CONF_EMACT = 'Активација путем e-поште';
	public $A_C_CONF_MANACT = 'Ручна активација';
	public $A_C_CONF_AC_ACTD = 'Изаберите начин активације налога нових корисника. Директно, путем активационог линка, послатог e-поштом или ручном активацијом од стране администратора.';

	//2009.0
	public $A_C_CONF_COMMENTS = 'Коментари';
	public $A_C_CONF_COMMENTSTIP = 'Уколико поставите на Приказано, број коментара за изабрани садржај биће приказан. Ово опште подешавање може бити измењено на нивоу ставки менија или садржаја';
	public $A_C_CONF_CHKFTP = 'Провера FTP подешавања';
	public $A_C_CONF_STDCACHE = 'Стандардни кеш';
	public $A_C_CONF_STATCACHE = 'Статички кеш';
	public $A_C_CONF_CACHED = 'Стандардни кеш кешира делове страница, док Статички кеш кешира целе странице. Статички кеш је препоручљив за веома посећене сајтове. Да бисте користили Статички кеш, морате да укључите SEO PRO.';
	public $A_C_CONF_SEODIS = 'SEO PRO је искључен!';
	
	public function __construct() {	
	}

}

?>