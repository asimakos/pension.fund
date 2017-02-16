<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Elxis Team
* @translator: Ioannis Sannos
* @translator URL: http://www.elxis.org
* @translator E-mail: info@elxis.org
* @description: Srpski language for Updiag tool
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class updiagLang {

	public $UPDATE = 'Ажурирање';
	public $CHVERS = 'Провера верзије';
	public $CNOTGETELXD = 'Не могу да добијем податке са elxis.org';
	public $INVXML = 'Добио сам неисправан XML фајл. Не могу да прикажем захтевану информацију.';
	public $SIZE = 'Величина';
	public $MORE = 'Даље';
	public $DOWNLOAD = 'Преузимање';
	public $INSELXVER = 'Инсталирана Elxis верзија';
	public $CURRENT = 'Актуелна';
	public $OUTDATED = 'Застарела!';
	public $NEWVERAV = 'Доступна је новија верзија Elxis-а. Ажурирајте своју инсталацију Elxis-а што је пре могуће.';
	public $CHPATCHES = 'Преглед закрпа';
	public $NOPATCHES = 'Тренутно нема доступних закрпа за Вашу верзију Elxis-а';
	public $PROSUPPORT = 'Професионална подршка';
	public $NEWS = 'Вести';
	public $MAINTENANCE = 'Одржавање';
	public $REMOTEERR1 = 'Неисправан захтев';
	public $REMOTEERR2 = 'Не могу да добијем листу скрипти';
	public $REMOTEERR3 = 'Нема скрипти';
	public $REMOTEERR4 = 'Захтевани фајл је празан';
	public $REMOTEERR5 = 'Не могу да добијем листу hash фајлова';
	public $REMOTEERR6 = 'Нема hash фајлова';
	public $REMOTEERR7 = 'Не могу да преузмем захтевани фајл!';
	public $UNERROR = 'Непозната грешка';
	public $PROVCODE = 'Садржи скрипт за ажурирање Elxis-а из верзије';
	public $TOVERSION = 'у верзију';
	public $INSTALLED = 'Инсталирано';
	public $REQFEXISTS = 'Захтевани фајл већ постоји!';
	public $FILDOWNSUC = 'Фајл је успешно преузет!';
	public $DFORRUNSCR = 'Не заборавите да овај скрипт покренете како бисте ажурирали своју инсталацију Elxis-а.';
	public $CNOTCPDFIL = 'Не могу преузети фајл да копирам на жељено одредиште.';
	public $PLCHSCRPERM = 'Проверите дозволе за /administrator/tools/updiag/data/scripts';
	public $PLCHSCRPERM2 = 'Проверите дозволе за /administrator/tools/updiag/data/hashes';
	public $EXECUTE = 'Извршавање';
	public $SCRNOTEX = 'Захтевани скрипт не постоји!';
	public $FSCHECK = 'Системска провера';
	public $HIDEHELP = 'Скривање помоћи';
	public $NORMAL = 'Уобичајено';
	public $EXTENDED = 'Проширено';
	public $FULL = 'Пун приказ';
	public $NOHASHFOUND = 'Нема hash фајлова';
	public $INVHFILE = 'Неисправан hash фајл!';
	public $SHFELXVER = 'Изабрани hash фајл је за Elxis верзију старију од Ваше тренутне!';
	public $FNOTEXIST = 'Фајл не постоји';
	public $WARNING = 'Упозорење';
	public $FNEEDUP = 'Фајл је портебно ажурирати';
	public $SITUP2D = 'Сајт је ажуран!';
	public $FOUND = 'Пронађено је';
	public $OUTFUP = 'застарелих фајлова. Молимо Вас, обновите их!';
	public $CHFINUS = 'Провера ажурности сајта путем <b>%s</b> као извора';
	public $NEWRELEASES = 'Нова издања';
	public $NONEWREL = 'Тренутно нема нових издања';
	public $PRICE = 'Цена';
	public $LICENSE = 'Лиценца';
	public $SECURITY = 'Сигурност';
	public $INSTPATH = 'Путања инсталације';
	public $CREDITS = 'Захвалност';
	public $ALERT = 'Узбуна';
	public $FSECALWA = 'Откривено је <b>%d</b> сигурносних узбуна и упозорења';
	public $ELXINPAS = 'Ваша Elxis инсталација је успешно прошла основне сигурносне тестове';
	public $HOME = 'Насловна';
	public $UPDSPAG = 'Updiag централа';
	public $UPDWELC = 'Добродошли у <b>Updiag</b>, Elxis дијагностички алат.';
	public $STARTMORE = 'Највећи број Updiag функција захтева везу са elxis.org сајтом. 
	Стога морате имати отворену конекцију од Вашег сајта ка интернету. 
	Изаберите ставку са горњег менија за навигацију.';
	public $BASCHECKS = 'Основна провера <small>(кликните на икону да бисте извршили)</small>';
	public $FILEREMSUC = 'Фајл је успешно уклоњен!';
	public $CNREMSFILE = 'Не могу да уклоним изабрани фајл! Проверите дозволе.';
	public $HASHNOTEX = 'Захтевани hash фајл не постоји!';
	public $DNHASHFLS = 'Преузимање hash фајлова';
	public $BUY = 'Куповина';
	public $DOWNLTIME = 'Време преузимања';
	public $DOWNLSPEED = 'Брзина преузимања';


	public function __construct() {
	}

}

define('CX_LUPDIAGD', 'Помаже Вам да ажурирате свој сајт, обавештава Вас о новим издањима Elxis-а, његовим верзијама, закрпама, и проверава сигурносна подешавања.');

?>