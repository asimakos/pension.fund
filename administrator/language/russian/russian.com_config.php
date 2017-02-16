<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ilnaz Giliazov (Coursar)
* @link: http://www.elxis.ru
* @email: info@elxis.ru
* @description: Russian language for component config
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещён.' );


class adminLanguage extends standardLanguage {

	public $A_COMP_CONF_OFFLINE = 'Выключить Сайт';
	public $A_COMP_CONF_OFFMESSAGE = 'Сообщение при выключенном сайте';
	public $A_COMP_CONF_TIP_OFFMESSAGE = 'Сообщение, которое выводится пользователям, если сайт выключен';
	public $A_COMP_CONF_ERR_MESSAGE = 'Сообщение о системной ошибке';
	public $A_COMP_CONF_TIP_ERR_MESSAGE = 'Сообщение, которое выводится пользователям, если произошла системная ошибка Elxis';
	public $A_COMP_CONF_SITE_NAME = 'Название сайта';
	public $A_COMP_CONF_UN_LINKS = 'Показывать ссылки не авторизированным';
	public $A_COMP_CONF_UN_TIP = 'Если ДА, то неавторизованным пользователям будут показываться ссылки на содержимое с уровнем доступа - Для зарегистрированных -. Пользователю необходимо будет войти, чтобы посмотреть материал полностью.';
	public $A_COMP_CONF_USER_REG = 'Разрешить регистрацию';
	public $A_COMP_CONF_TIP_USER_REG = 'Если Да, то пользователи получат возможность регистрироваться самостоятельно';
	public $A_COMP_CONF_REQ_EMAIL = 'Требовать уникальный email-адрес';
	public $A_COMP_CONF_REQTIP = 'Если да, пользователи не смогут использовать один email для нескольких аккуантов';
	public $A_COMP_CONF_DEBUG = 'Отладка сайта';
	public $A_COMP_CONF_DEBTIP = 'Если да, то будет показываться диагностическая информация, запросы и ошибки SQL';
	public $A_COMP_CONF_EDITOR = 'Редактор WYSIWYG';
	public $A_COMP_CONF_LENGTH = 'Количество строк в списке';
	public $A_COMP_CONF_LENTIP = 'Установка количества строк в списке по умолчанию для всех пользователей';
	public $A_COMP_CONF_FAV_ICON = 'Иконка сайта';
	public $A_COMP_CONF_FAVTIP = 'Если не указано, или не удаётся найти файл Иконки то по умолчанию будет использоваться favicon.ico';
	public $A_COMP_CONF_CLINKACC = 'Компоненты, связанные с системой доступа';
	public $A_COMP_CONF_CLACCDESC = 'Выберите тип компонентов, которые должны быть связаны с системой контроля доступа во внешнем интерфейсе (значение ACO = просмотр). За подробной информацией обратитесь к справке.';
	public $A_COMP_CONF_CORECOMPS = 'Компоненты ядра';
	public $A_COMP_CONF_3RDCOMPS = 'Компоненты третьих разработчиков';
	public $A_COMP_CONF_ALLCOMPS = 'Все компоненты';
	public $A_COMP_CONF_CAPTCHA = 'Использовать код подтверждения';
	public $A_COMP_CONF_CAPTCHATIP = 'Да, если Вы хотите, чтобы код подверждения (Captcha) был отображенн в формах вашего сайта. Доступно озвучивание кода для людей, имеющих проблемы со зрением.';
	public $A_COMP_CONF_LOCALE = 'Локаль';
	public $A_COMP_CONF_LANG = 'Основной язык для содержимого сайта (frontend)';
	public $A_COMP_CONF_ALANG = 'Основной язык админ.части сайта (backend)';
	public $A_COMP_CONF_TIME_SET = 'Разница во времени';
	public $A_COMP_CONF_DATE = 'Установленная дата/время для отображения';
	public $A_COMP_CONF_LOCAL = 'Локаль страны';
	public $A_COMP_CONF_LOCRECOM = 'Мы рекомендуем использовать значение, установленное автоматически. Elxis использовала наиболее распространнёную локаль для вашей ОС и выбранного языка. Windows не поддерживает UTF-8 локаль.';
	public $A_COMP_CONF_LOCCHECK = 'Проверка локали';
	public $A_COMP_CONF_LOCCHECK2 = 'Если вы видите верную дату, то Локаль правильно настроена для вашей системы и языка.<br><strong>Внимание!</strong> В Windows Локаль автоматически устанавливает English.';
	public $A_COMP_CONF_AUTOSEL = 'Автовыбор';
	public $A_COMP_CONF_CONTROL = '* Эти параметры контролируют вывод элементов *';
	public $A_COMP_CONF_LINK_TITLES = 'Заголовки в виде ссылок';
	public $A_COMP_CONF_LTITLES_TIP = 'Если да, то заголовки объектов содержимого будут ссылками на эти объекты';
	public $A_COMP_CONF_MORE_LINK = 'Ссылка "Подробнее..."';
	public $A_COMP_CONF_MLINK_TIP = 'Если установлено Показать, то будет отображаться ссылка "Подробнее..." для просмотра полного содержимого';
	public $A_COMP_CONF_RATE_VOTE = 'Рейтинг/Голосование';
	public $A_COMP_CONF_RVOTE_TIP = 'Если установлено Показать, то будет включена система оценки содержимого сайта пользователями';
	public $A_COMP_CONF_AUTHOR = 'Имя Автора';
	public $A_COMP_CONF_AUTHORTIP = 'Если установлено Показать, то будет отображаться имя автора. Эта глобальная настройка может быть изменена при создании пункта меню и содержимого';
	public $A_COMP_CONF_CREATED = 'Время и Дата создания';
	public $A_COMP_CONF_CREATEDTIP = 'Если установлено Показать, то будет отображаться дата и время создания. Эта глобальная настройка может быть изменена при создании пункта меню и содержимого';
	public $A_COMP_CONF_MOD_DATE = 'Дата и Время изменения';
	public $A_COMP_CONF_MDATETIP = 'Если установлено Показать, то будет отображаться дата и время последнего изменения.  Эта глобальная настройка может быть изменена при создании пункта меню и содержимого';
	public $A_COMP_CONF_HITS = 'Хиты';
	public $A_COMP_CONF_HITSTIP = 'Если установлено Показать, то будет отображаться количество кликов для данного объекта.  Эта глобальная настройка может быть изменена при создании пункта меню и содержимого';
	public $A_COMP_CONF_PDF = 'Значок PDF';
	public $A_COMP_CONF_OPT_MEDIA = 'Опция недоступна, если каталог /tmpr не доступен для записи';
	public $A_COMP_CONF_PRINT_ICON = 'Значок Печати';
	public $A_COMP_CONF_EMAIL_ICON = 'Значок Email';
	public $A_COMP_CONF_ICONS = 'Значки';
	public $A_COMP_CONF_USE_OR_TEXT = 'Печать, RTF, PDF & Email используют значки или текст';
	public $A_COMP_CONF_TBL_CONTENTS = 'Оглавление для многостраничных объектов';
	public $A_COMP_CONF_BACK_BUTTON = 'Кнопка "Назад"';
	public $A_COMP_CONF_CONTENT_NAV = 'Навигация по содержимому';
	public $A_COMP_CONF_HYPER = 'Использовать Названия в виде гиперссылок';
	public $A_COMP_CONF_DBTYPE = 'Тип Базы Данных';
	public $A_COMP_CONF_DBWARN = 'Не изменяйте, если ваша система не поддерживает эту базу данных и копия данных Elxis не установлена в этой Базе данных!';
	public $A_COMP_CONF_HOSTNAME = 'Хост';
	public $A_COMP_CONF_DB_PW = 'Пароль';
	public $A_COMP_CONF_DB_NAME = 'База Данных';
	public $A_COMP_CONF_DB_PREFIX = 'Префикс Базы Данных';
	public $A_COMP_CONF_NOT_CH = '!! НЕ ИЗМЕНЯЙТЕ, ЕСЛИ У ВАС ЕСТЬ РАБОЧАЯ БАЗА ДАННЫХ С УЖЕ ОПРЕДЕЛЁННЫМ ПРЕФИКСОМ !!';
	public $A_COMP_CONF_ABS_PATH = 'Абсолютный путь';
	public $A_COMP_CONF_LIVE = 'URL сайта';
	public $A_COMP_CONF_SECRET = 'Секретное слово';
	public $A_COMP_CONF_GZIP = 'GZIP сжатие страниц';
	public $A_COMP_CONF_CP_BUFFER = 'Поддержка сжатия страниц перед отправкой для уменьшения трафика (если доступно)';
	public $A_COMP_CONF_SESSION_TIME = 'Время жизни Сессий';
	public $A_COMP_CONF_SEC = 'секунд';
	public $A_COMP_CONF_AUTO_LOGOUT = 'Автоматически выходить по завершении этого времени';
	public $A_COMP_CONF_ERR_REPORT = 'Контроль Ошибок';
	public $A_COMP_CONF_HELP_SERVER = 'Сервер Справки';
	public $A_COMP_CONF_META_PAGE = 'Мета-Данные';
	public $A_COMP_CONF_META_DESC = 'Описание сайта';
	public $A_COMP_CONF_META_KEY = 'Ключевые слова';
	public $A_COMP_CONF_HPS1 = 'Локальная справка';
	public $A_COMP_CONF_HPS2 = 'Удалённый Сервер';
	public $A_COMP_CONF_HPS3 = 'Официальный Сервер';
	public $A_COMP_CONF_PERMFLES = 'Выберите эту опцию для установки прав доступа на вновь создаваемые файлы';
	public $A_COMP_CONF_PERMDIRS = 'Выберите эту опцию для установки прав доступа на вновь создаваемые каталоги';
	public $A_COMP_CONF_NCHMODDIRS = 'Не изменять права на новые каталоги (использовать настройки сервера)';
	public $A_COMP_CONF_CHAPFLAGS = 'Установите этот флажок для установки прав доступа для <em>всех существующих файлов</em>.<br/><b>НЕПРАВИЛЬНОЕ ИСПОЛЬЗОВАНИЕ ЭТОЙ ОПЦИИ МОЖЕТ ПРИВЕСТИ К НЕРАБОТОСПОСОБНОСТИ САЙТА!</b>';
	public $A_COMP_CONF_CHAPDLAGS = 'Установите этот флажок для установки прав доступа для <em>всех существующих каталогов</em>.<br/><b>НЕПРАВИЛЬНОЕ ИСПОЛЬЗОВАНИЕ ЭТОЙ ОПЦИИ МОЖЕТ ПРИВЕСТИ К НЕРАБОТОСПОСОБНОСТИ САЙТА!</b>';
	public $A_COMP_CONF_APPEXDIRS = 'Установить для существующих каталогов';
	public $A_COMP_CONF_APPEXFILES = 'Установить для существующих файлов';
	public $A_COMP_CONF_WORLD = 'Все';
	public $A_COMP_CONF_CHMODNDIRS = 'Установить CHMOD для новых каталогов';
	public $A_COMP_CONF_MAIL = 'Использовать для отправки почты';
	public $A_COMP_CONF_MAIL_FROM = 'Письма от';
	public $A_COMP_CONF_MAIL_FROM_NAME = 'Отправитель';
	public $A_COMP_CONF_MAIL_SMTP_AUTH = 'SMTP-аутентификация';
	public $A_COMP_CONF_MAIL_SMTP_USER = 'Пользователь SMTP';
	public $A_COMP_CONF_MAIL_SMTP_PASS = 'Пароль SMTP';
	public $A_COMP_CONF_MAIL_SMTP_HOST = 'SMTP Хост';
	public $A_COMP_CONF_CACHE = 'Кэшировать';
	public $A_COMP_CONF_CACHE_FOLDER = 'Каталог Кэш';
	public $A_COMP_CONF_CACHE_DIR = 'Текущий Каталог Кэш';
	public $A_COMP_CONF_CACHE_DIR_UNWRT = 'Кэш каталог НЕ ДОСТУПЕН ДЛЯ ЗАПИСИ - пожалуйста установите для каталога права 777 перед использованием Кэш';
	public $A_COMP_CONF_CACHE_TIME = 'Время жизни Кэша';
	public $A_COMP_CONF_STATS = 'Статистика';
	public $A_COMP_CONF_STATS_ENABLE = 'Включить/выключить сбор статистики для сайта';
	public $A_COMP_CONF_STATS_LOG_HITS = 'Вести статистику просмотра содержимого по дате';
	public $A_COMP_CONF_STATS_WARN_DATA = 'ВНИМАНИЕ : в этом режиме записываются большие объёмы данных';
	public $A_COMP_CONF_STATS_LOG_SEARCH = 'Статистика поисковых запросов';
	public $A_COMP_CONF_SEO_LBL = 'SEO';
	public $A_COMP_CONF_SEO = 'Поисковая оптимизация';
	public $A_COMP_CONF_SEO_SEFU = 'Дружественные URL';
	public $A_COMP_CONF_SEOBASIC = 'SEO Basic';
	public $A_COMP_CONF_SEOPRO = 'SEO Pro';
	public $A_COMP_CONF_SEOHELP = "Apache и IIS. Apache: переименуйте htaccess.txt в .htaccess перед включением  (mod_rewrite включен). IIS: используйте фильтр Ionic Isapi Rewriter. Для максимально производительности подготовьте содержимое ваше сайта перед переходом на SEO PRO. Выберите SEO Basic, если хотите использовать SEF компоненты сторонних разработчиков.";
	public $A_COMP_CONF_SERVER = 'Сервер';
	public $A_COMP_CONF_METADATA = 'Мета-Данные';
	public $A_COMP_CONF_CACHE_TAB = 'Кэш';
	public $A_COMP_CONF_FTP_LBL = 'FTP';
	public $A_COMP_CONF_FTP = 'Настройки FTP';
	public $A_COMP_CONF_FTP_ENB = 'Включить FTP';
	public $A_COMP_CONF_FTP_HST = 'Хост FTP';
	public $A_COMP_CONF_FTP_HSTTP = 'Наиболее Вероятно';
	public $A_COMP_CONF_FTP_USR = 'Пользователь FTP';
	public $A_COMP_CONF_FTP_USRTP = 'Наиболее Вероятно';
	public $A_COMP_CONF_FTP_PAS = 'Пароль FTP';
	public $A_COMP_CONF_FTP_PRT = 'Порт FTP';
	public $A_COMP_CONF_FTP_PRTTP = 'Значение по умолчанию : 21';
	public $A_COMP_CONF_FTP_PTH = 'Путь FTP';
	public $A_COMP_CONF_FTP_PTHTP = 'Путь от корневой папки FTP до каталога Elxis. Например, /public_html/elxis';
	public $A_COMP_CONF_HIDE = 'Скрыть';
	public $A_COMP_CONF_SHOW = 'Показать';
	public $A_COMP_CONF_DEFAULT = 'Настройки Системы';
	public $A_COMP_CONF_NONE = 'Нет';
	public $A_COMP_CONF_SIMPLE = 'Простой';
	public $A_COMP_CONF_MAX = 'Максимум';
	public $A_COMP_CONF_MAIL_FC = 'Функция PHP-mail';
	public $A_COMP_CONF_SEND = 'Sendmail';
	public $A_COMP_CONF_SENDP = 'Путь Sendmail';
	public $A_COMP_CONF_SMTP = 'SMTP Сервер';
	public $A_COMP_CONF_UPDATED = 'Конфигурация <strong>обновлена</strong>!';
	public $A_COMP_CONF_ERR_OCC = '<strong>Ошибка!</strong> Не удаётся открыть конфигурационный файл для записи!';
	public $A_COMP_CONF_READ = 'чтение';
	public $A_COMP_CONF_WRITE = 'запись';
	public $A_COMP_CONF_EXEC = 'выполнение';
	public $A_COMP_CONF_FCRE = 'Создание Файлов';
	public $A_COMP_CONF_FPERM = 'Права Файлов';
	public $A_COMP_CONF_DCRE = 'Создание Каталогов';
	public $A_COMP_CONF_DPERM = 'Права Каталогов';
	public $A_COMP_CONF_OFFEX = 'Да (кроме Супер Администраторов)';
	public $A_COMP_CONF_RTF = 'Значок RTF';

	//2008.1
	public $A_C_CONF_AC_ACT = 'Активация аккаунта';
	public $A_C_CONF_NOACT = 'Нет';
	public $A_C_CONF_EMACT = 'Через e-mail';
	public $A_C_CONF_MANACT = 'Вручную';
	public $A_C_CONF_AC_ACTD = 'Выберите, каким образом будут активироваться аккаунты новых пользователей. Сразу же после регистрации, через ссылку по e-mail или вручную администратором сайта.';

	//2009.0
	public $A_C_CONF_COMMENTS = 'Комментарии';
	public $A_C_CONF_COMMENTSTIP = 'Если да, то будет показано количество комментарии к статье. Это глобальная настройка и может быть изменена на уровне статьи или пункта меню.';
	public $A_C_CONF_CHKFTP = 'Проверить настройки FTP';
	public $A_C_CONF_STDCACHE = 'Стандартный кэш';
	public $A_C_CONF_STATCACHE = 'Static cache';
	public $A_C_CONF_CACHED = 'Static Cache обеспечивает кэширование целых страниц, в отличие от стандартного кэша, при котором кэшируются лишь блоки страниц. Static Cache рекомендуется для высоконагруженных сайтов. Для его использования необходимо включить SEO PRO.';
	public $A_C_CONF_SEODIS = 'SEO PRO отключен!';

	public function __construct() {	
	}

}

?>