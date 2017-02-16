<?php 
/**
* @version: 2009.1
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Component eBlog
* @author: Elxis Team
* @translator: Coursar
* @link: http://www.elxis.ru
* @email: info@elxis.ru
* @description: Russian language for component eBlog
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещён.' );


class eBlogLang {


	public $ELXISBLOG = 'Elxis Blog';
	public $TAGS = 'Теги';
	public $UNKNOWNTAG = 'Неизвестный тег';
	public $PERMLINK = 'Прямая ссылка';
	public $COMMENTS = 'Комментарии';
	public $COMMENT = 'Комментарий'; //(noun, i.e. 1 comment)
	public $NOCOMMENTS = 'Нет комментариев.';
	PUBLIC $MUSTLOGTOCOM = 'Вам необходимо авторизироваться.';
	public $POSTCOMMENT = 'Оставить комментарий';
	public $YOURCOMMENT = 'Ваш комментарий';
	public $NALLPOSTCOM = 'Вы не можете оставлять комментарии!';
	public $MUSTWRITEMSG = 'Вы должны ввести сообщение!';
	public $COMADDSUC = 'Ваш комментарий успешно добавлен!';
	public $WAITRETRY = 'Пожалуйста, попробуйте повторить через несколько секунд!';
	public $NALLPERFACT = 'Вы не можете совершать данную операцию!';
	public $ARTNOFOUND = 'Не удаётся найти запрашиваемую запись!';
	public $POSTSTAGASAT = "Запись помечена как %s в %s"; //example: Posts tagged as computer at ElectroBlog";
	public $ARCHIVES = 'Архив';
	public $USERBLOGSAT = "Блоги пользователей на %s"; //s: site name
	public $USERBLOGS = 'Блоги пользователей';
	public $THEREAREBLOGS = "Доступно блогов: %s"; //s: number of available blogs
	public $POSTS = 'Сообщения';

	//control panel
	public $CPANEL = 'Панель управления';
	public $MANBLOG = 'Управление блогом';
	public $ALLPOSTS = 'Все сообщения';
	public $LATESTPOSTS = "Последние %s";
	public $SETTINGS = 'Настройки';
	public $CSSFILE = 'CSS файл';
	public $RTLCSSFILE = 'RTL CSS файл';
	public $COMMENTARY = 'Комментарии';
	public $NOTALLOWED = 'Не разрешены'; //Commentary
	public $REGUSERS = 'Зарегистрированные пользователи'; //Commentary
	public $ALLOWEDALL = 'Все'; //Commentary
	public $POSTSNUMBER = 'Количество сообщений';
	public $POSTSNUMBERD = 'Количество последних записей, отображаемых на главной странице блога.';
	public $SHOWTAGSD = 'Выберите для отображения тегов под записями.';
	public $CSSFILED = 'Таблица стилей, используемая в вашем блоге. В CSS определяются настройки внешнего вида вашего блога.';
	public $RTLCSSFILED = 'Таблица стилей для использования при просмотре сайта на языках с написанием справа-налево (например, Персидский).';
	public $OPTION = 'Настройка';
	public $VALUE = 'Значение';
	public $HELP = 'Помощь';
	public $NEWPOST = 'Новая запись';
	public $EDITPOST = 'Изменить запись';
	public $TITLENOEMPTY = 'Заголовок не может быть пустым!';
	public $FOLDERCNOTCR = "Невозможно создать каталог %s!"; //%s: folder name
	public $DIMENSIONS = 'Размеры (В x Ш)';
	public $SIZEKB = 'Размер (KB)';
	public $LISTVIEW = 'В виде списка';
	public $THUMBSVIEW = 'В виде значков';
	public $UPLOAD = 'Загрузка';
	public $UPLOADIMG = 'Загрузить изображение';
	public $MEDIAMAN = 'Media-менеджер';
	public $YOUTUBEVIDEO = 'YouTube видео';
	public $GOOGLEVIDEO = 'Google видео';
	public $YAHOOVIDEO = 'Yahoo видео';
	public $COMSEPTAGS = 'Теги, разделённые запятыми';
	public $SLOGAN = 'Слоган';
	public $SLOGAND = 'Слоган для отображения в заголовке вашего блога. Вы можете использовать html.';
	public $SHOWOWNER = 'Показать автора';
	public $SHOWOWNERD = 'Показать автора в заголовке вашего блога?';
	public $SHOWARCHIVE = 'Показать архив';
	public $SHOWARCHIVED = 'Показать архив записей по месяцам внизу блога?';

	//SEO titles
	public $SEOTITLE = 'SEO заголовок';
	public $SEOTITLEEMPTY = 'SEO заголовок не может быть пустым!';
	public $INVALID = 'Неверный';
	public $VALID = 'Верный';
	public $SEOTEXIST = 'SEO заголовок уже существует!';
	public $SEOTLARGER = 'Попробуйте более длинный заголовок!';
	public $SEOTHELP = 'Вы можете использовать только латинские буквы в нижнем регистре, цифры, дефисы и подчёркивания. SEO заголовок должен быть уникальным!';
	public $SEOTSUG = 'Рекомендуемый SEO заголовок';
	public $SEOTVAL = 'Проверить SEO заголовок';

	//languages names
	public $ARMENIAN = 'Армянский';
	public $BOZNIAN = 'Боснийский';
	public $BRAZILIAN = 'Бразильский';
	public $BULGARIAN = 'Болгарский';
	public $CREOLE = 'Креольский';
	public $CROATIAN = 'Хорватский';
	public $DANISH = 'Датский';
	public $ENGLISH = 'Английский';
	public $FRENCH = 'Французский';
	public $GERMAN = 'Немецкий';
	public $GREEK = 'Греческий';
	public $INDONESIAN = 'Индонезийский';
	public $ITALIAN = 'Итальянский';
	public $JAPANESE = 'Японский';
	public $LATVIAN = 'Латвийский';
	public $LITHUANIAN = 'Литовский';
	public $PERSIAN = 'Персидский';
	public $POLISH = 'Польский';
	public $RUSSIAN = 'Русский';
	public $SERBIAN = 'Сербский';
	public $SPANISH = 'Испанский';
	public $SRPSKI = 'Сербский';
	public $TURKISH = 'Турецкий';
	public $VIETNAMESE = 'Вьетнамский';

	//backend
	public $BLOGINFO = 'Информация о блоге';
	public $CANCONFIGD = 'Выберите, хотите ли вы, чтобы автор блога мог изменять настройки блога через внешний интерфейс.';
	public $CANUPLOADD = 'Выберите, хотите ли вы, чтобы автор блога имел возможность загружать media-файлы.';
	public $BLOGOWNMDIR = 'Media каталог автора блога';
	public $EXISTING = 'Существует';
	public $NONEXISTING = 'Не существует';
	public $SIZEKBD = 'Общий допустимый размер загруженных файлов в KB. Значение по умолчанию 2000 (2MB).';
	public $BLOGOWNER = 'Автор блога';
	public $UPLOADDIR = 'Каталог загрузки';
	public $UPLOADEDFILES = 'Загруженные файлы';
	public $USEDSPACE = 'Использовано';
	public $LASTPOST = 'Последняя запись';
	public $LASTPOSTDATE = 'Дата последней записи';
	public $NOTSETYET = 'Не установлено';
	public $UNOTALLUPLOADF = 'Пользователю не разрешено загружать файлы.';

	//elxis 2009.1
	public $INVDATE = 'Дата выбрана неверно.';
	public $METADESCDAY = "Сообщения на %s год на %s."; //Posts for DATE on EBLOG_TITLE
	public $NOPOSTSFDATE = 'Не найдены на эту дату.';
	public $SHAREPOST = 'Доля этой статьи';


	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
	}

}

?>