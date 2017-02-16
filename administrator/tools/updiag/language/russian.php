<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Elxis Team
* @translator: Coursar
* @translator URL: http://www.elxis.ru
* @translator E-mail: info@elxis.ru
* @description: Russian language for Updiag tool
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещён.' );


class updiagLang {

	public $UPDATE = 'Обновить';
	public $CHVERS = 'Проверить версию';
	public $CNOTGETELXD = 'Не удаётся загрузить данные с elxis.org';
	public $INVXML = 'Неправильный XML. Не удаётся отобразить требуемую информацию.';
	public $SIZE = 'Размер';
	public $MORE = 'Подробнее';
	public $DOWNLOAD = 'Скачать';
	public $INSELXVER = 'Установленная версия Elxis';
	public $CURRENT = 'Новейшая';
	public $OUTDATED = 'Устаревшая!';
	public $NEWVERAV = 'Обнаружена новая версия Elxis. Пожалуйста, обновите вашу Elxis, если это возможно.';
	public $CHPATCHES = 'Проверка патчей';
	public $NOPATCHES = 'Не обнаружено доступных патчей для вашей версии Elxis';
	public $PROSUPPORT = 'Поддержка';
	public $NEWS = 'Новости';
	public $MAINTENANCE = 'Эксплуатация';
	public $REMOTEERR1 = 'Неверный запрос';
	public $REMOTEERR2 = 'Не удаётся отобразить список скриптов';
	public $REMOTEERR3 = 'Скриптов не найдено';
	public $REMOTEERR4 = 'Запрашиваемый файл пуст';
	public $REMOTEERR5 = 'Не удаётся отобразить список хэш файлов';
	public $REMOTEERR6 = 'Хэш файлов не найдено';
	public $REMOTEERR7 = 'Не удаётся загрузить запрашиваемый файл!';
	public $UNERROR = 'Неизвестная ошибка';
	public $PROVCODE = 'Код обновления Elxis с версии';
	public $TOVERSION = 'до версии';
	public $INSTALLED = 'Установлено';
	public $REQFEXISTS = 'Файл уже существует!';
	public $FILDOWNSUC = 'Файл успешно загружен!';
	public $DFORRUNSCR = 'Не забудьте запустить это скрипт, если вы захотите обновить вашу Elxis.';
	public $CNOTCPDFIL = 'Не удаётся скопировать загруженный файл в удалённый каталог.';
	public $PLCHSCRPERM = 'Пожалуйста, проверьте права на каталог /administrator/tools/updiag/data/scripts';
	public $PLCHSCRPERM2 = 'Пожалуйста, проверьте права на каталог /administrator/tools/updiag/data/hashes';
	public $EXECUTE = 'Выполнить';
	public $SCRNOTEX = 'Запрашиваемый скрипт не существует!';
	public $FSCHECK = 'Проверка файловой системы';
	public $HIDEHELP = 'Скрыть справку';
	public $NORMAL = 'Обычная';
	public $EXTENDED = 'Расширенная';
	public $FULL = 'Полная';
	public $NOHASHFOUND = 'Хэш файлов не найдено';
	public $INVHFILE = 'Неправильный хэш файл!';
	public $SHFELXVER = 'Выбранный хэш файл - для более старой версии Elxis чем ваша!';
	public $FNOTEXIST = 'Файл не существует';
	public $WARNING = 'Предупреждение';
	public $FNEEDUP = 'Файл нуждается в обновлении';
	public $SITUP2D = 'Сайт обновлён!';
	public $FOUND = 'Найдено';
	public $OUTFUP = 'устаревших файлов. Пожалуйста, обновите!';
	public $CHFINUS = 'Проверка статуса обновления сайта, используя <b>%s</b> в качестве источника';
	public $NEWRELEASES = 'Новые релизы';
	public $NONEWREL = 'Нет новых релизов';
	public $PRICE = 'Цена';
	public $LICENSE = 'Лицензия';
	public $SECURITY = 'Безопасность';
	public $INSTPATH = 'Путь установки';
	public $CREDITS = 'Список Разработчиков';
	public $ALERT = 'Предупреждени';
	public $FSECALWA = 'Найдено <b>%d</b> предупреждений безопасности';
	public $ELXINPAS = 'Ваша установка Elxis успешно прошла основную проверку безопасности';
	public $HOME = 'Главная';
	public $UPDSPAG = 'Центр Updiag';
	public $UPDWELC = 'Добро пожаловать в <b>Updiag</b>, инструмент обновления и диагностики Elxis.';
	public $STARTMORE = 'Большинство функций Updiag требуют соединения с сайтом elxis.org.
	Поэтому вам необходимо иметь открытый доступ к интернету, для работы этих функций.
	Воспользуйтесь меню, расположенным выше.';
	public $BASCHECKS = 'Базовая проверка <small>(нажмите на значке для начала проверки)</small>';
	public $FILEREMSUC = 'Файл успешно удалён!';
	public $CNREMSFILE = 'Не удаётся удалить выбранный файл! Проверьте права доступа к файлу.';
	public $HASHNOTEX = 'Запрашиваемый хэш файл не существует!';
	public $DNHASHFLS = 'Скачать хэш файлы';
	public $BUY = 'Купить';
	public $DOWNLTIME = 'Время закачки';
	public $DOWNLSPEED = 'Скорость закачки';


	public function __construct() {
	}

}

define('CX_LUPDIAGD', 'Помогает вам обновлять ваш сайт, сообщает о новых релизах Elxis, версиях и патчах. Кроме того, позволяет выполнять мероприятия по защите и диагностике вашего сайта.');

?>