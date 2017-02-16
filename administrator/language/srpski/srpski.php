<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ivan Trebješanin
* @translator URL: http://www.elxis-srbija.org
* @email: admin@elxis-srbija.org
* @description: Srpski administration Language
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


define('_ISO','charset=UTF-8');

class standardLanguage {

public $A_XML_LANGUAGE = 'sr'; //2-letter language code
public $A_ALERT_SELECT_TO = 'Изаберите ставку за';
public $A_ALERT_SELECT_PUB = 'Изаберите са листе ставку за објављивање';
public $A_ALERT_SELECT_PUB_LIST = 'Изаберите ставку која ће бити предефинисана';
public $A_ALERT_ITEM_ASSIGN = 'Изаберите ставку коју желите да доделите';
public $A_ALERT_SELECT_UNPUBLISH = 'Изаберите ставку за одјављивање';
public $A_ALERT_SELECT_ARCHIVE = 'Изаберите ставку за архивирање';
public $A_ALERT_SELECT_UNARCHIVE = 'Изаберите ставку за деархивирање';
public $A_ALERT_SELECT_EDIT = 'Изаберите ставку за уређивање';
public $A_ALERT_SELECT_DELETE = 'Изаберите ставку за брисање';
public $A_ALERT_CONFIRM_DELETE = 'Да ли сте сигурни да желите да обришете ову ставку?';
public $A_ALERT_ENTER_PASSWORD = 'Унесите своју лозинку'; 
public $A_ALERT_INCORRECT = 'Неисправно корисничко име, лозинка или приступни ниво. Пробајте поново';
public $A_ALERT_INCORRECT_TRY = 'Неисправно корисничко име или лозинка, пробајте поново';
public $A_ALERT_ALPHA = 'Име фајла мора садржати само алфанумеричке карактере без размака.';
public $A_ALERT_IMAGE_UPLOAD = 'Изаберите слику за додавање';
public $A_ALERT_IMAGE_EXISTS = 'Већ постоји слика под именом';
public $A_ALERT_IMAGE_FILENAME = 'Фајл мора бити gif, png, jpg, bmp, swf, doc, xls или ppt';
public $A_ALERT_UPLOAD_FAILED = 'Није успело додавање';
public $A_ALERT_UPLOAD_SUC = 'Успешно је додат';
public $A_ALERT_VALIDATE_NAME = 'Морате унети име.';
public $A_PLSSELECTCAT = 'Изаберите категорију.';
public $A_ALERT_SELECT_MENU = 'Изаберите мени';
public $A_ALERT_ENTER_NAME_MENUITEM = 'Унесите име ставке менија';
public $A_GO = 'Крени';
public $A_HELP = 'Помоћ';
public $A_WARNING = 'Elxis упозорење';
public $A_NEWORDERSAVED = 'Нови поредак је сачуван';
public $A_SAVEORDER = 'Чување поретка';
public $A_MENULINKS_WHEN_SAVED = 'Ставке менија постају доступне након чувања';
public $A_NEW_ITEM_LAST = 'Нове ставке ће бити додате на крај листе. Поредак се може изменити након чувања.';
public $A_NEW_ITEM_FIRST = 'Нове ставке ће бити додате на почетак листе. Поредак се може изменити након чувања.';
public $A_SELECT_IMAGE = '- Избор слике -';
public $A_SELECTUSER = '- Избор корисника -';
public $A_ALL_SECTIONS = '- Све секције -';
public $A_ALL_SECTIONS2 = 'Све секција';
public $A_ALL_CATEGORIES = '- Све категорије -';
public $A_ALL_CATEGORIES2 = 'Све категорије';
public $A_ALL_AUTHORS = '- Сви аутори -';
public $A_ALL_POSITIONS = '- Све позиције -';
public $A_ALL_TYPES = '- Сви типови -';
public $A_ALL_LANGS = '- Сви језици -';
public $A_IS = 'је';
public $A_CREATE_CAT = 'Морате најпре направити категорију';
public $A_URL = 'URL';
public $A_FIRST = 'Прва';
public $A_LAST = 'Последња';
public $A_FP_MANAGER = 'Менаџер Насловне';
public $A_CLIENT = 'Клијент';
public $A_ADMINISTRATOR = 'Администратор';
public $A_SITE = 'Сајт';
public $A_WRITABLE = 'Откључан';
public $A_UNWRITABLE = 'Закључан';
public $A_MKUNWRAFSV = 'Закључавање након чувања';
public $A_MKOV_UNWRAFSV = 'Откључавање приликом чувања';
public $A_UNKNOWN = 'Непознато';
public $A_ORDER = 'Поредак';
public $A_ACCESS = 'Приступ';
public $A_TYPE = 'Тип';
public $A_FILE = 'Фајл';
public $A_NAME = 'Име';
public $A_ACCESSLEVEL = 'Приступни ниво';
public $A_PUBLISHED = 'Објављено';
public $A_UNPUBLISHED = 'Необјављено';
public $A_PARAMETERS = 'Параметри';
public $A_NO = 'Не';
public $A_YES = 'Да';
public $A_THEMODULE = 'Модул';
public $A_TITLE = 'Наслов';
public $A_MODULE = 'Модул';
public $A_LANGUAGE = 'Језик';
public $A_LINK = 'Линк';
public $A_PUBLISHING = 'Објављивање';
public $A_METAINFO = 'Метаподаци';
public $A_LINKTOMENU = 'Линк на менију';
public $A_IMAGES = 'Слике';
public $A_PUBLISHINGINFO = 'Информације о објављивању';
public $A_ORDERING = 'Поредак';
public $A_FILTERSECTION = 'Филтер секције';
public $A_FILTERCATEGORY = 'Филтер категорије';
public $A_FILTERAUTHOR = 'Филтер аутора';
public $A_FILTERGROUP = 'Филтер групе';
public $A_IMAGEINFO = 'Информације о слици';
public $A_IMAGE = 'Слика';
public $A_MOSIMAGE = 'MOSImage контрола';
public $A_SUBFOLDER = 'Поддиректоријум';
public $A_GALLERY = 'Слике галерије';
public $A_ADD = 'Додавање';
public $A_CONTENTIMAGES = 'Слике садржаја';
public $A_UP = 'горе';
public $A_DOWN = 'доле';
public $A_REMOVE = 'уклањање';
public $A_EDITIMAGE = 'Уређивање слике';
public $A_SOURCE = 'Извор';
public $A_IMAGEALIGN = 'Равнање слике';
public $A_ALTTEXT = 'Alt текст';
public $A_IMAGEBORDER = 'Оквир';
public $A_IMAGECAPTION = 'Потпис';
public $A_IMAGECAPTIONPOS = 'Позиција потписа';
public $A_IMAGECAPTIONALIGN = 'Равнање потписа';
public $A_WIDTH = 'Ширина';
public $A_PARAMCONTROL = 'Контрола параметара';
public $A_PARCONTROLEXPL = '* Ови параметри важе само када прегледате пуни приказ ставке садржаја *';
public $A_METADATA = 'Метаподаци';
public $A_KEYWORDS = 'Кључне речи';
public $A_DESCRIPTION = 'Опис';
public $A_SELECTAMENU = 'Избор менија';
public $A_MENUITEMNAME = 'Име ставке менија';
public $A_EXMENULINKS = 'Постојећи линкови менија';
public $A_NONE = 'Ништа';
public $A_NOT_AUTH = 'Немате дозволу за приступ овој страници.';
public $A_LOGIN_NOADMINS = 'Не можете да се пријавите. Није постављен Super Administrator.';
public $A_LOGIN_NOGROUPS = 'Не можете да се пријавите. Нису дефинисане администраторске групе.';
public $A_ADMINISTRATION = 'Администрација';
public $A_PREVIEW = 'Преглед';
public $A_EDITUSER = 'Уређивање корисника';
public $A_EDITCATEGORY = 'Уређивање категорије';
public $A_EDITSECTION = 'Уређивање секције';
public $A_MOVE = 'Премештање';
public $A_COPY = 'Копирање';
public $A_UNINSTALL = 'Деинсталација';
public $A_UPLOAD = 'Додавање';
public $A_CREATE = 'Креирање';
public $A_PUBLISH = 'Објава';
public $A_UNPUBLISH = 'Одјава';
public $A_DELETE = 'Брисање';
public $A_TRASH = 'Отпаци';
public $A_ITEMS = 'ставке';
public $A_SEARCH = 'Претрага';
public $A_SECTLANGES = 'Језици секције';
public $A_CATLANGES = 'Језици категорије';
public $A_FILTLANG = 'Филтер језика';
public $A_LANGCONFL = 'Језички конфликт';
public $A_LANGCONM1 = 'Категорија се налази у секцији чија језичка подешавања не дозвољавају њен приказ!';
public $A_TOP = 'Врх';
public $A_BOTTOM = 'Дно';
public $A_NO_USER = 'Нема корисника';
public $A_TOOLS = 'Алати';
public $A_USERNAME = 'Корисничко име';
public $A_PASSWORD = 'Лозинка';
public $A_WELCOME_ELXIS = 'Добродошли у Elxis!';
public $A_USE_VALIDUP = 'Употребите исправно корисничко име и лозинку да бисте приступили администрационој конзоли.';
public $A_SELECT_LANG = 'Изаберите језиик за ову сесију.';
public $A_WARNING_JAVASCRIPT = 'Упозорење! Javascript мора бити укључен за правило функционисање администрације';
public $A_LOGIN = 'Пријава';
public $A_GENERATE_TIME = 'Страница је генерисана за %f секунди';
public $A_LOGOUT = 'Одјава';
public $A_CONTENTPREVIEW = 'Преглед садржаја';
public $A_CLOSE = 'Затварање';
public $A_PRINT = 'Штампа';
public $A_MODULEPREVIEW = 'Преглед модула';
public $A_POLLPREVIEW = 'Преглед анкете';
public $A_RESULTS = 'Резултати';
public $A_VOTE = 'Гласање';
public $A_UPLOADAFILE = 'Додајте фајл';
public $A_FILEUPLOAD = 'Додавање фајла';
public $A_UPLOADIMAGE = 'Додајте слику';
public $A_SELITEMMOV = 'Изаберите ставку за премештање';
public $A_MENU_HOME = 'Насловна'; 
public $A_MENU_GC = 'Општа конфигурација';
public $A_MENU_SITE_MENU ='Уређивање сајта';
public $A_MENU_CONFIGURATION = 'Конфигурација';
public $A_MENU_SITELANS = 'Језици сајта';
public $A_MENU_LANGUAGES = 'Језици';
public $A_MENU_MANAGE_LANG = 'Уређивање језика';
public $A_MENU_LANG_MANAGE = 'Менаџер језика';
public $A_MENU_ADMINLANGS = 'Администраторски језици';
public $A_MENU_INSTALL = 'Инсталација';
public $A_MENU_INSTALL_LANG = 'Инсталација језика';
public $A_MENU_MEDIA_MANAGE = 'Менаџер медија';
public $A_MENU_MANAGE_MEDIA = 'Уређивање медија';
public $A_MENU_NEW_WINDOW = 'У новом прозору';
public $A_MENU_INLINE = 'У линији';
public $A_MENU_INLINE_POS = 'У линији са позицијама модула';
public $A_MENU_STATISTICS = 'Статистике';
public $A_MENU_STATISTICS_SITE = 'Статистике сајта';
public $A_MENU_BROWSER = 'Претраживач, ОС, домен';
public $A_MENU_PAGE_IMP = 'Прикази страница';
public $A_MENU_SEARCH_TEXT = 'Тражени текст';
public $A_MENU_TEMP_MANAGE = 'Менаџер шаблона';
public $A_MENU_TEMP_CHANGE = 'Измена шаблона сајта';
public $A_MENU_SITE_TEMP = 'Шаблони сајта';
public $A_MENU_ADMIN_TEMP = 'Администраторски шаблони';
public $A_MENU_LOGIN_SCREENS = 'Екрани пријаве';
public $A_MENU_ADMIN_CHANGE_TEMP = 'Измена администраторског шаблона';
public $A_MENU_MODUL_POS = 'Позиције модула';
public $A_MENU_TEMP_POS = 'Позиције шаблона';
public $A_MENU_TRASH_MANAGE = 'Менаџер отпадака';
public $A_MENU_MANAGE_TRASH = 'Уређивање отпадака';
public $A_MENU_USER_MANAGE = 'Менаџер корисника';
public $A_MENU_MANAGE_USER = 'Уређивање корисника';
public $A_MENU_ADD_EDIT = 'Додавање/Уређивање корисника';
public $A_MENU_MASS_MAIL = 'Масовна пошта';
public $A_MENU_MAIL_USERS = 'Слање e-поруке групи регистрованих корисника';
public $A_MENU_MANAGE_STR = 'Уреживање структуре сајта';
public $A_MENU_MANAGER = 'Менаџер менија';
public $A_MENU_CONTENT = 'Садржај';
public $A_MENU_CONTENT_MANAGE = 'Уређивање садржаја';
public $A_MENU_CONTENT_MANAGERS = 'Менаџери садржаја';
public $A_MENU_MANAGE_CONTENT = 'Уређивање ставки садржаја';
public $A_MENU_MANAGE_CONTACTS = 'Уређивање контаката';
public $A_MENU_ITEMS = 'Ставке';
public $A_MENU_ADDNEDIT = 'Додавање/Уређивање';
public $A_MENU_ARCHIVE = 'Архив';
public $A_MENU_OTHER_MANAGE = 'Остали менаџери';
public $A_MENU_ITEMS_FRONT = 'Уређивање ставки Насловне';
public $A_MENU_ITEMS_CONTENT = 'Уређивање независних страна';
public $A_MENU_STATICMANAGER = 'Менаџер независних страница';
public $A_MENU_ITEMS_ARCHIVE = 'Уређивање архивираних ставки';
public $A_MENU_ARCHIVE_MANAGE = 'Менаџер архива';
public $A_MENU_CONTENT_SEC = 'Уређивање секција садржаја';
public $A_MENU_CONTENT_CAT = 'Уреживање категорија садржаја';
public $A_MENU_COMPONENTS = 'Компоненте';
public $A_MENU_INST_UNST = 'Инсталација/Деинсталација';
public $A_MENU_MORE_COMP = 'Још компоненти';
public $A_MENU_MODULES = 'Модули';
public $A_MENU_INSTALL_CUST = 'Инсталација додатних модула';
public $A_MENU_SITE_MOD = 'Модули сајта';
public $A_MENU_SITE_MOD_MANAGE = 'Уређивање модула сајта';
public $A_MENU_ADMIN_MOD = 'Администраторски модули';
public $A_MENU_ADMIN_MOD_MANAGE = 'Уређивање администраторских модула';
public $A_MENU_MAMBOTS = 'Ботови';
public $A_MENU_CUSTOM_MAMBOT = 'Инсталација додатног бота';
public $A_MENU_SITE_MAMBOTS = 'Ботови сајта';
public $A_MENU_MAMBOT_MANAGE = 'Уређивање ботова сајта';
public $A_MENU_MESSAGES = 'Поруке';
public $A_MENU_INBOX = 'Сандуче';
public $A_MENU_PRIV_MSG = 'Приватне поруке';
public $A_MENU_GLOBAL_CHECK = 'Општа овера';
public $A_MENU_CHECK_INOUT = 'Овера свих неоверених ставки';
public $A_MENU_SYSTEM_INFO = 'Системске информације';
public $A_MENU_CLEAN_CACHE = 'Чишћење кеша';
public $A_MENU_CLEAN_CACHE_ITEMS = 'Чишћење кешираних савки садржаја';
public $A_MENU_BIG_THANKS = 'Велико хвала свима који су учествовали';
public $A_MENU_SUPPORT = 'Подршка';
public $A_MENU_SYSTEM = 'Систем';
public $A_MENU_GLOSSARY = 'Речник';
public $A_MENU_SYSTEM_MANAGMENT = 'Уређивање система';
public $A_MENU_MODULE_MANAGMENT = 'Уређивање модула';
public $A_MENU_MAMBOT_MANAGMENT = 'Уређивање ботова';
public $A_MENU_MESSAGING_MANAGMENT = 'Уређивање система порука';
public $A_MENU_COMPONENT_MANAGMENT = 'Уређивање компоненти';
public $A_MENU_MENU_MANAGMENT = 'Уређивање менија';
public $A_MENU_INSTALLERS = 'Инсталатори';
public $A_MENU_INSTALLER_LIST = 'Листа инсталатора';
public $A_MENU_CONTENT_BYSEC = 'Садржај по секцијама';
public $A_MENU_SYSTEMINFO = 'Преглед системских информација';
public $A_MENU_ACCSMANG = 'Менаџер приступа';
public $A_MENU_CBL = 'Садржај по језицима';
public $A_MENU_AL = 'Сви језици';
public $A_USERS = 'Корисници';
public $A_EXTRAFIELDS = 'Додатна поља';
public $A_LATESTADDED = 'Најновији садржаји';
public $A_USERSONLINE = 'Присутнх корисника';
public $A_MAIL = 'Пошта';
public $A_MOSTPOPULARITEMS = 'Најпопуларније ставке';
public $A_CREATED = 'Направљено';
public $A_HITS = 'Прегледа';
public $A_HELPDESC = 'Elxis Help Center. Кликните за преглед екрана помоћи.';
public $A_MENUMANAGERDESC = 'Преглед, додавање, измена или брисање ставки менија.';
public $A_FPAGEMANAGERDESC = 'Менаџер Насловне омогућава подешавање Насловне стране Вашег сајта.';
public $A_STATICONTMANAGER = 'Менаџер независних страна';
public $A_STATICMANDESC = 'Приказује све независне стране. Независне стране су садржаји који не припадају ни једној секцији нити категорији.';
public $A_SECTIONMANAGER = 'Менаџер секција';
public $A_SECTIONMANDESC = 'Преглед, додавање, измена или брисање секција.';
public $A_CATEGORYMANAGER = 'Менаџер категорија';
public $A_CATEGORYMANDESC = 'Преглед, уређивање, додавање или брисање категорија.';
public $A_ALLCONTENTITEMS = 'Све ставке садржаја';
public $A_DISPLALLCONTITEMS = 'Приказ свих садржаја, из свих секција и категорија.';
public $A_TRASH_MANDESC = 'Пражњење канте за отпаке или враћање ставки садржаја и менија.';
public $A_GLOBAL_CONFDESC = 'Омогућава измене општих подешавања.';
public $A_DATABASEMANAGER = 'Менаџер базе';
public $A_DATABASEMANDESC = 'Бекап, поправка или оптимизација базе';
public $A_ACCESSMANDESC = 'Уређивање корисничких група и њихових дозвола.';
public $A_MENUMEDIAMANDESC = 'Преглед, додавање или брисање слика и осталих мултимедијалних садржаја.';
public $A_MENUUSERMANDESC = 'Преглед, додавање, уређивање или брисање корисника. Измена група или лозинки.';
public $A_WELCOMEMSG = 'Добродошли у Elxis';
public $A_WELCOMEMSGDESC = 'Користите мени са леве стране за навигацију.';
public $A_LANGMANDESC = 'Уређивање језика сајта.';
public $A_TOOLSDESC = 'Алати су мале апликације повезане са Elxis-ом или потпуно независне.';
public $A_ELXIS_REGISTRATION = 'Elxis регистрација';
public $A_NEW = 'Ново';
public $A_DEFAULT = 'Предефинисано';
public $A_ASSIGN = 'Додела';
public $A_UNARCHIVE = 'Дерхивирање';
public $A_EDIT = 'Уређивање';
public $A_SAVE = 'Чување';
public $A_BACK = 'Назад';
public $A_CANCEL = 'Одустанак';
public $A_APPLY = 'Примена';
public $A_OF = 'од';
public $A_NORECORDSFOUND = 'Нема пронађених записа';
public $A_FIRSTPAGE = 'прва страна';
public $A_PREVIOUSPAGE = 'претходна страна';
public $A_NEXTPAGE = 'следећа страна';
public $A_ENDPAGE = 'последња страна';
public $A_PREVIOUS = 'Претходна';
public $A_NEXT = 'Следећа';
public $A_END = 'Крај';
public $A_DISPLAY = 'Преглед';
public $A_MOVE_UP = 'Померање навише';
public $A_MOVE_DOWN = 'Померање наниже';
public $A_START = 'Почетак';
public $A_NAVNEXT = ' Следећа &gt;';
public $A_NAVEND = ' Крај &gt;&gt;';
public $A_NAVPREV = '&lt; Претходна';
public $A_NAVSTART = '&lt;&lt; Почетак';
public $A_CHECKEDOUT = 'Оверено';
public $A_FRONTPAGE = 'Насловна';
public $A_IMAGEPOSITION = 'Позиција слике';
public $A_FILTER = 'Филтер';
public $A_FILTERTYPE = 'Тип филтера';
public $A_REORDER = 'Измена редоследа';
public $A_SECTION = 'Секција';
public $A_CATEGORY = 'Категорија';
public $A_AUTHOR = 'Аутор';
public $A_NB = '#';
public $A_NBACTIVE = '# активних';
public $A_NBTRASH = '# отпадака';
public $A_COMP_CREATE_MENU_LINK = 'Да ли сте сигурни да желите да направите линк на менију? \nСве несачуване измене ће бити изгубљене.';
public $A_CREATEMENUIT = 'Овим ћете направити нову ставку на изабраном менију';
public $A_COMP_MENU_TYPE_SELECT = 'Избор типа менија';
public $A_MENU = 'Мени';
public $A_ITEMNAME = 'Име ставке';
public $A_STATE = 'Стање';
public $A_TRASHED = 'Бачено';
public $A_LINKTOUSER = 'Повезано са корисником';
public $A_CONTACT = 'Контакт';
public $A_EMAIL = 'е-пошта';
public $A_ID = 'ID';
public $A_EXPIRED = 'Истекло';
public $A_ARCHIVED = 'Архивирано';
public $A_SELITEMTO = 'Изаберите ставку за';
public $A_DATE = 'Датум';
public $A_ISCEDITANADM = ' тренутно уређује други администратор';
public $A_USER = 'Корисник';
public $A_ARCHIVE = 'архив';
public $A_ITEMID = 'Itemid';
public $A_CID = 'CID';
public $A_MISCEL = 'Разно';
public $A_LINKS = 'Линк';
public $A_ITEMSTRASHED = 'Ставка је послата у отпатке';
public $A_COMPONENT = 'Компонента';
public $A_POSITION = 'Позиција';
public $A_ENABLED = 'Омогућено';
public $A_DISABLED = 'Онемогућено';
public $A_SETTSUCSAVED = 'Подешавања су успешно сачувана';
public $A_ASSIGNED = 'Додељено';
public $A_VERSION = 'Верзија';
public $A_TEMPLATES = 'Шаблони';
public $A_FILTERED = 'Филтрирано';
public $A_CPUBLISHINFO = 'Информације о објављивању';
public $A_NEVER = 'Никада';
public $A_GROUP = 'Група';
public $A_PARITEM = 'Ставка садржалац';
public $A_BLOG = 'Блог';
public $A_DETAILS = 'Подаци';
public $A_CATEGORS = 'Категорија';
public $A_ALIGN = 'Равнање';
public $A_LINKNAME = 'Име линка';
public $A_SSCHITEM = 'Успешно су сачуване измене ставке';
public $A_SSAVITEM = 'Успешно је сачувана ставка';
public $A_AUTHMAIL = 'е-пошта аутора';
public $A_MENUS_CNTSCARC = 'Архив секције садржаја';
public $A_MENUS_CCTCATBL = 'Табела категорије контаката';
public $A_MENUS_NFDCATBL = 'Табела категорије текућих вести';
public $A_MENUS_WBLCATBL = 'Табела категорије Web линкова';
public $A_MENUS_CNTCNTBL = 'Табела категорије саджаја';
public $A_MENUS_CNTCTBLG = 'Блог категорије саджаја';
public $A_MENUS_CNTCTARBLG = 'Блог архива садржаја категорије';
public $A_LOGGEDUSRS = 'Тренутно пријављени корисници';
public $A_FORCELOGOUT = 'Принудна одјава корисника';
public $A_SELECTED = 'изабрано';
public $A_ERROR = 'Грешка';
public $A_ALL = 'Све';
public $A_TRANSLATE = 'Превођење';
public $A_TRMKSELECT = 'Изаберите са листе ставку за превођење';
public $A_SELCOSECT = '- Избор секције садржаја -';
public $A_SELCOCAT = '- Избор категорије садржаја -';
public $A_SELMENU = '- Избор менија -';
public $A_NOTUSEIMAG = '- Без употребе слике -';
public $A_USEDEFIMAG = '- Употреба предефинисане слике -';
public $A_SHOW_ADVANCED = 'Напредни приказ детаља';
public $A_HIDE_ADVANCED = 'Једноставни приказ детаља';
public $A_DONTCHMODNFL = 'Без CHMOD-овања нових фајлова (биће употребљена подешавања сервера)';
public $A_CHMODNEWFLS = 'CHMOD нових фајлова';
public $A_TO = 'на';
public $A_COMP_CONTENT_MANAGER = 'Менаџер';
public $A_COMP_FRONT_PAGE_ITEMS = 'Ставке Насловне';
public $A_SUPER_ADMIN = 'Суперадминистратор';
public $A_COMP_FRONT_COUNT_NUM = 'Параметар броја мора бити број';
public $A_COMP_FRONT_INTRO_NUM = 'Параметар увода мора бити број';
public $A_COMP_FRONT_WELCOME = 'Добродошли на Насловну';
public $A_COMP_FRONT_IDONOT = 'Немам шта да прикажем';
public $A_COMP_LANG_INSTALL = 'Инсталирани језици';
public $A_COMP_LANG_FILE = 'Језик фајла';
public $A_INSTALL_COMP_UPL_NEW = 'Додавање нове компоненте';
public $A_BRIDGES = 'Мостови';
public $A_BRIDGE = 'Мост';
public $SOFTDISK = 'SoftDisk';
public $ADDSOCUT = 'Додавање пречице';
public $A_MANSOCUTS = 'Уређивање пречица';
public $A_SHORTCUTS = 'Пречице';
public $A_SEOTITLE = 'SEO наслов';
public $A_SEOTEMPTY = 'SEO наслов не може бити празан!';
public $A_SEOTHELP = 'Можете употребити само мала латинична слова, цифре, косе и доње црте. SEO мора бити јединствен у својој секцији/категорији! Пробајте да унесете једноставе и смислене SEO наслове.';
public $A_SEOTLARGER = 'Испробајте дужи наслов!';
public $A_SEOTSUG = 'Предложени SEO наслов';
public $A_SEOTVAL = 'Провера SEO наслова';
public $A_SEOTEXIST = 'SEO наслов већ постоји!';
public $A_VALID = 'Исправно';
public $A_INVALID = 'Неисправно';
public $A_POLL_MANAGER = 'Менаџер анкета';
public $A_SUB_CONTENT = 'Додати садржаји';
public $A_LOGIN_CLOAK = 'Скривање пријавне странице у акцији!';
public $A_LOGIN_CLOAKD = 'Унесите у свој претраживач тачан URL Ваше пријавне странице, како бисте приступили администрационој конзоли.';
public $A_NEWSFEEDS = 'Текуће вести';
public $A_BANNERS = 'Банери';
public $A_MAN_BANNERS = 'Уређивање банера';
public $A_MAN_CLIENTS = 'Уређивање клијената';
public $A_CONTACTS = 'Контакти';
public $A_CONT_CATEGORS = 'Категорије контаката';
public $A_WEBL_ITEMS = 'Ставке Web линкова';
public $A_WEBL_CATEGORS = 'Категорије Web линкова';
public $A_MAN_DB = 'Уређивање базе';
public $A_VIEW_BACKUPSB = 'Преглед бекапа';
public $A_MON_STATS = 'Статистике надзора';
public $A_MON_TABLES = 'Надзор табела';
public $A_SYNDICATE = 'Синдикација';
public $A_MAN_NEWSFEEDS = 'Уређивање текућих вести';
public $A_NEWSFEED_CATS = 'Категорије текућих вести';
public $A_TPASS_LASTACT = 'Време протекло од задње активности';
public $A_VISITORS = 'посетиоци';
public $A_HOURS = 'часова';
public $A_HOUR = 'час';
public $A_MINUTES = 'минута';
public $A_MINUTE = 'минут';
public $A_SECONDS = 'секунди';
public $A_SECOND = 'сакунда';
public $A_TIMESESSEXP = 'Време до истека сесије';
public $A_SESSEXPIRED = 'Сесија је истекла!';
public $A_ELXISBLOG = 'Elxis Блог';
public $A_C_NEWSLETTER = 'Newsletter';
public $A_C_SHOPPINGCART = 'Shopping cart';
public $A_C_DOWNLOADS = 'Downloads';
public $A_C_GALLERY = 'Gallery';
//2009.2
public $A_CHK_UPDATES = 'Ажурирање';
}

?>