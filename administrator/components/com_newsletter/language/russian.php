<?php 
/**
* @version: 1.0
* @copyright: Copyright (C) 2008 Is Open Source. All rights reserved.
* @package: Elxis
* @subpackage: Component NewsLetter
* @author: Ioannis Sannos (Is Open Source)
* @translator: Coursar
* @link: http://www.elxis.ru
* @email: info@elxis.ru
* @description: Russian language for component NewsLetter
* @license: http://creativecommons.org/licenses/by-sa/3.0/ Creative Commons Attribution-Share Alike 3.0
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещён.' );


class newsletterLang {


	public $NEWSLETTER = 'Newsletter';
	public $NEWSLMAILLIST = 'Список рассылки Newsletter';
	public $SUBSCRIBE = 'Подписаться';
	public $UNSUBSCRIBE = 'Прекратить подписку';
	public $SUBLEWSL = 'Подписаться на рассылку новостей';
	public $UNSUBLEWSL = 'Прекратить подписку на новости';
	public $NAME = 'Имя';
	public $SURNAME = 'Фамилия';
	public $RECIEVEIN = "Язык новостей"; //translators help: filled in by language name (i.e. "English")
	public $ANYLANG = 'любой';
	public $SUBINFO = 'Заполните персональную информацию для подписки на нашу рассылку. Все поля обязательны для заполнения.
	Вы сможете в любое время прекратить подписку, если не захотите получать нашу рассылку.';
	public $SUBEMAILVAL = 'Ваш e-mail адрес будет проверен для подтверждения подписки.';
	public $SECCODE = 'Код подтверждения';
	public $UNSUBINFO = 'Введите ваш e-mail для того, чтобы прекратить подписку. На ваш e-mail 
	будет отправлена специальная ссылка. Перейдите по ней для прекращения подписки.';
	public $JSDISABLED = 'Необходимо включить поддержку JavaScript в вашем браузере!';
	public $NAMEEMPTY = 'Поле Имя не может быть пустым!';
	public $SURNAMEEMPTY = 'Поле Фамилия не может быть пустым!';
	public $PROVALIDEMAIL = 'Вам необходимо ввести существующий e-mail адрес!';
	public $SECCODEWRONG = 'Неверный код подтверждения!';
	public $EMAILEXISTS = 'Указанный e-mail адрес уже зарегистрирован в нашей рассылке!';
	public $NOTACCDOM = 'Извините, но подписка с вашего домена запрещена.';
	public $FLOODWAIT = 'Защита от флуда! Пожалуйста, подождите несколько секунд и попробуйте снова.';
	public $NEWSLSUBNTF = 'Уведомление о подписке на рассылку';
	public $DEAR = 'Уважаемый(ая)'; //translators help: followed by name surname
	public $THANKSUB = 'Спасибо за подписку на нашу рассылку.';
	public $SUBCOMPVISIT = 'Для завершения процедуры оформления подписки необходимо перейти по указанной ниже ссылке.
	Переходя по ней, вы подтверждаете, что являетесь владельцем данного e-mail адреса, после чего ваша подписка будет активирована.';
	public $NEVERSUBIGN = 'Если вы не регистрировались на нашу рассылку, пожалуйста, проигнорируйте это письмо.';
	public $GREETINGS = 'Приветствуем вас';
	public $SUBCONFIRM = 'Подтверждение подписки';
	public $CONFLINKSENT = 'На ваш e-mail адрес была отправлена специальная ссылка подтверждения.
	Проверьте ваш почтовый ящик и перейдите по ссылке подтверждения для завершения процедуры подписки.'; 
	public $SUBCOMPLETE = 'Вы подписаны на нашу рассылку';
	public $SUBCOMPLETED = 'Ваша подписка на нашу рассылку была успешна завершена. Если вы не желаете получать 
	рассылку, вы можете в любое время прекратить её, введя свой e-mail в соответствующую форму.';
	public $CONFFAILED = 'Ошибка подтверждения';
	public $CONFFAILEDD = 'Ошибка подтверждения! Ваша подписка уже подтверждена или неверен код подверждения.';
	public $SUBLOGIN = 'Для того, чтобы прекратить подписку, необходимо авторизироваться на сайте!';
	public $SUBNALLOWED = 'Приносим свои извинения, регистрация новых подписчиков запрещена.';
	public $MAILNFOUND = 'Ваш e-mail адрес не был найден в списке нашей рассылки или ваша подписка не подтверждена.';
	public $UNSUBCONFIRM = 'Подтверждение прекращения подписки';
	public $WISHUNSCLICK = 'Мы получили запрос на прекращение вашей подписки. Для подтверждения данного запроса 
	перейдите по ссылке, указанной ниже.';
	public $UNSUBINGORE = 'Если вы не направляли запрос на прекращение подписки, пожалуйста, проигнорируйте это письмо.';
	public $UNSUBCOMPLETE = 'Вы успешно сняты с подписки';
	public $UNSUBCOMPLETED = 'Вы были успешно сняты с подписки на рассылку нашего сайта.';
	public $RCONFLINKSENT = 'Ваш запрос зарегистрирован. На ваш e-mail адрес отправлено специальное письмо с ссылкой подтверждения. 
	Проверьте свой почтовый ящик и перейдите по указанной ссылки для завершения процедуры прекращения подписки.'; 
	public $RCONFFAILEDD = 'Ошибка запроса! Ваша подписка не подтверждена или неверен код подтверждения.';
	public $NOTHSPECIAL = 'There is nothing special to see here.';
	public $STATISTICS = 'Статистика';
	public $TOTALSENT = 'Всего разослано сообщений';
	public $LASTSUBSCRIBER = 'Последний подписчик';

	/* BACK-END */
	public $CONFIGURE = 'Конфигурация';
	public $SUBSCRIBERS = 'Подписчики';
	public $CONFIRMED = 'Подтверждено';
	public $UNCONFIRMED = 'Не подтверждено';
	public $GUEST = 'Гость';
	public $SUBSCRIPTIONS = 'Подписки';
	public $REGUSERS = 'Зарегистрированные пользователи';
	public $EVERYONE = 'Все';
	public $CANSUBSCRIBED = 'Выберите, кто может подписываться на рассылку сайта.';
	public $EMAILVALID = 'E-mail с подтверждением';
	public $EMAILVALIDD = 'Если включено, то после подписки на рассылку на указанный e-mail адрес будет отправлено письмо с ссылкой для подтверждения подписки. 
	Новая подписка активируется только после перехода по ссылке в письме. Таким образом, вы можете быть уверены в том, что пользователь при подписке указал именно свой e-mail адрес.';
	public $LANGSD = 'Если вы желаете рассылать письма на разных языках, выберите необходимый язык из данного списка. В процессе подписки на рассылку пользователи смогут выбрать один из языков, отмеченных вами.
	Если на вашем сайте представлен только один язык и рассылка будет осуществляться на нём - вам не нужно ничего выбирать.';
	public $EXCLUDEDTLDS = 'Исключения TLDs';
	public $EXCLUDEDTLDSD = 'Разделённый запятыми список Доменов Первого Уровня (com,net,org), с которых запрещена подписка.';
	public $EXCLUDEDDOMS = 'Исключаемые домены';
	public $EXCLUDEDDOMSD = 'Разделённый запятыми список доменов, с которых запрещена подписка (например, badsite.com,hackers.cn).';
	public $ALLOWEDTLDS = 'Разрешённые TLDs';
	public $ALLOWEDTLDSD = 'Разделённый запятыми список Доменов Первого Уровня (com,net,org) для которых разрешена подписка. Оставьте пустым, чтобы разрешить подписку для всех.';
	public $ALLOWEDDOMS = 'Разрешённые домены';
	public $ALLOWEDDOMSD = 'Разделённый запятыми список доменов, с которых разрешена подписка (например, mysite.com,friendlysite.gr). Оставьте пустым, чтобы разрешить подписку для всех.';
	public $SHOWSTATSD = 'Показывать статистику NewsLetter на сайте?';
	public $RECPERSTEP = 'Получателей за шаг';
	public $RECPERSTEPD = 'IOS Newsletter для ограничения нагрузки на сервер отправляет сообщения за несколько шагов. 
	Установите здесь количество сообщений, отправляемых за шаг.';
	public $ONEPERREC = 'Одно на получателя';
	public $ONEPERRECD = 'Отправлять одно сообщение на получателя. Работает только при выборе метода отправки PHP Mail!
	Если включено, IOS Newsletters будет отправлять по одному сообщению на получателя. Так, если вы отправляете 
	сообщение 50 пользователям, будет отправлено 50 сообщений. 
	Если используете эту функцию, увеличьте значение настройки Получателей за шаг. 
	Если функция отключена, будет отправляться по одному сообщению за каждый шаг для всег получателей.';
	public $CNOTSAVESETS = 'Невозможно сохранить настройки!';
	public $EXPORT = 'Экспорт';
	public $EXPORTSUB = 'Экспорт подписчиков';
	public $IMPORT = 'Импорт';
	public $IMPORTSUB = 'Импорт подписчиков';
	public $IMPORTUNIQUE = 'Импорт только незарегистрированных e-mail адресов (Требует дополнительных запросов к БД. 
	Не импортируйте сразу много подписчиков).';
	public $IMPORTD = 'Выберите бэкап файл NewsLetter для импорта.';
	public $IMPORTCUSTOM = 'Если вы используете сторонний файл импорта, убедитесь, что он сохранён в кодировке UTF-8 
	и список подписчиков в формате один подписчик на строку:';
	public $IMPORTGIDL = 'Для гостей userid = 0. Язык может быть пустым (group can also be empty).';
	public $IMPORTEDSUBS = "Найдено подписчиков: %s. Из них импортировано: %s."; //translators help: %s is being replaced by number
	public $CONFCODE = 'Код подтверждения';
	public $GETUSERDATA = 'Получить данные из бд';
	public $NEWSLETTERS = 'Рассылки';
	public $SUBJECT = 'Тема';
	public $RECIPIENTS = 'Получатели';
	public $PLAINTEXT = 'Текст';
	public $TEXTHTML = 'HTML текст';
	public $HTMLFILE = 'HTML файл';
	public $LASTSENT = 'Последняя рассылка'; //translators help: date newsletter last sent
	public $SELECTFILE = 'Выберите файл';
	public $HTMLFILED = 'Вы можете загрузить и использовать созданный заранее HTML файл вместо ввода HTML текста.';
	public $SUBJECTEMPTY = 'Укажите тему!';
	public $FIRSTSAVEPR = 'Необходимо сохранить сообщение перед предпросмотром!';
	public $NEWSLNEMPTY = 'Введите сообщение!';
	public $SENDNEWSLETTER = 'Отправить';
	public $MAILFORMAT = 'Формат письма';
	public $FORCESEND = 'Отправить это сообщение также пользователям, выбравшим другой язык.';
	public $SUBSTOTAL = 'Всего подписчиков';
	public $SUBSCRIBERSIN = "Подписчиков (%s)"; //translators help: filled in by language
	public $SENDNOW = 'Отправить!';
	public $SENDMSGSWAIT = "Отправляется сообщений - %s, пожалуйста, подождите..."; //translators help: filled in by messages number
	public $PLEASEWAIT = 'Пожалуйста, подождите...';
	public $MSGOFSENT = "Сообщений - %s из  %s успешно отправлено."; //translators help: filled in by number / total number
	public $DISPATCHCOM = 'Отправка завершена';
	public $SENDERNAME = 'Имя отправителя';
	public $SENDEREMAIL = 'E-mail отправителя';
	public $SENDMETHOD = 'Метод отправки';
	public $READCONFIRM = 'Уведомление о прочтении';
	public $SENDMAILPATH = 'Путь Sendmail';
	public $SENDMAILPATHD = 'Используется, если в качестве метода отправки выбран Sendmail (значение по умолчанию: /usr/sbin/sendmail).';
	public $SMTPHOST = 'Хост SMTP';
	public $SMTPPORT = 'Порт SMTP';
	public $SECURESMTP = 'Безопасный SMTP';
	public $SMTPAUTH = 'SMTP аутентификация';
	public $SMTPUSER = 'Пользователь SMTP';
	public $SMTPPASS = 'Пароль SMTP';
	public $ADDREPLYTO = 'Reply To';
	public $ADDREPLYTOD = 'Добавить поле Reply To в заголовок письма?';
	public $THECOPY = 'Копия'; //translators help: THE copy (material, a copied newsletter)
	public $SHOWCOPYRIGHT = 'Показывать копирайт';
	public $SHOWCOPYRIGHTD = 'Отображать или нет сообщение об авторских правах на странице компонента. Это будет вашей благодарностью автору за использование компонента!';
	public $UPHTMLTEMP = 'Загрузить html файл для использования в качестве шаблона NewsLetter';
	public $UPLOADHTMLTEMP = 'Загрузить HTML шаблон';
	public $SENDNEWSLET = 'Отправить сообщения';
	public $IMPORTELXUS = 'Импортировать пользователей Elxis';
	public $IMPORTELXUSD = 'Импортируйте в Newsletter существующих пользователей Elxis CMS. Будут добавлены только те пользователи,
	e-mail адреса которых ещё не зарегистрированы в листе рассылки Newsletter.';
	public $FOUNDELXUIMP = "Найдено %s пользователей Elxis. Из них %s импортировано в Newsletter."; //translators help: filled in by numbers

	//languages names
	public $ARMENIAN = 'Армянский';
	public $BOZNIAN = 'Боснийски';
	public $BRAZILIAN = 'Бразильский';
	public $BULGARIAN = 'Болгарский';
	public $CREOLE = 'Креольскийф';
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
	public $SRPSKI = 'Srpski';
	public $TURKISH = 'Турецкий';
	public $VIETNAMESE = 'Вьетнамский';

	/*********************/
	/* MAGIC CONSTRUCTOR */
	/*********************/
	public function __construct() {
	}

}

?>