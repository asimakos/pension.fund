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
* @description: Russian Language for XML files
* @note: All values used in admin XML files start with 'AX_'
* @note 2008/2009: values for custom language strings defined as php contants start with 'CX_' (not in this file!)
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* 
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
* 
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещён.' );


class xmlLanguage extends standardLanguage {

public function get($a) {
	if ( is_numeric($a) ) { return $a; }
	$pref = strtoupper(substr($a,0,3));
    if ($pref == 'AX_') {
        return $this->$a;
    } elseif (($pref == 'CX_') && defined($a)) {
        return constant($a);
	} else { return $a; }
}

protected $AX_MENUIMGL = 'Значок меню';
protected $AX_MENUIMGD = 'Небольшое изображение, которое будет отображаться рядом с пунктом меню. Изображение должно находиться в каталоге images/stories/.';
protected $AX_MENUIMGONLYL = 'Использовать только значок меню';
protected $AX_MENUIMGONLYD = 'Если вы выберите <strong>Да</strong>, то пункт меню, выбранный вами, будет представлен только указанным изображением.<br /><br />Если вы выберите <strong>Нет</strong>, то этот пункт меню будет представлен выбранным изображением И текстом';
protected $AX_MENUIMG2D = 'Небольшое изображение, расположенное слева или справа от вашего пункта меню. Изображение должно находиться в каталоге /images.';
protected $AX_PAGCLASUFL = 'Суффикс Класса Страницы';
protected $AX_PAGCLASUFD = 'Суффикс будет добавлен в css классы страниц, это позволит задавать для страницы индивидуальный стиль.';
protected $AX_TEXTPAGECL = 'Суффикс Статьи';
protected $AX_TEXTPAGECLD = 'Суффикс будет добавлен в css класс, это позволит задать идивидуальный стиль Статьи/Объекта Содержимого.';
protected $AX_BACKBUTL = 'Кнопка Назад';
protected $AX_BACKBUTD = 'Показать/Скрыть кнопку Назад, позволяющую вам вернуться к предыдущей странице.';
protected $AX_USEGLB = 'Глобальные Настройки';
protected $AX_HIDE = 'Скрыть';
protected $AX_SHOW = 'Показать';
protected $AX_AUTO = 'Авто';
protected $AX_PAGTITLSL = 'Показывать название страницы';
protected $AX_PAGTITLSD = 'Показать/Скрыть название страницы';
protected $AX_PAGTITLL = 'Название Страницы';
protected $AX_PAGTITLD = 'Текст, отображаемый вверху страницы. Если пропущено, то будет использоваться название пункта меню.';
protected $AX_PAGTITL2D = 'Текст, отображаемый вверху страницы.';
protected $AX_LEFT = 'Слева';
protected $AX_RIGHT = 'Справа';
protected $AX_PRNTICOL = 'Значок Печати';
protected $AX_PRNTICOD = 'Показать/Скрыть значок печати - только для этой страницы.';
protected $AX_YES = 'Да';
protected $AX_NO = 'Нет';
protected $AX_SECNML = 'Название Раздела';
protected $AX_SECNMD = 'Показать/Скрыть название Раздела, к которому принадлежит данный объект.';
protected $AX_SECNMLL = 'Сделать Название Раздела Ссылкой';
protected $AX_SECNMLD = 'Сделайть текст Раздела ссылкой на фактическую страницу раздела.';
protected $AX_CATNML = 'Название Категории';
protected $AX_CATNMD = 'Показать/Скрыть Категории, к которой принадлежит данный объект.';
protected $AX_CATNMLL = 'Сделать Название Категории Ссылкой';
protected $AX_CATNMLD = 'Сделайть текст Категории ссылкой на фактическую страницу категории.';
protected $AX_LNKTTLL = 'Названия - Ссылки';
protected $AX_LNKTTLD = 'Сделает Названия Ваших Объектов Ссылками.';
protected $AX_ITMRATL = 'Рэйтинг Объекта';
protected $AX_ITMRATD = 'Показать/Скрыть рейтинг объекта - действует только для этой страницы.';
protected $AX_AUTNML = 'Имя Автора';
protected $AX_AUTNMD = 'Показать/Скрыть автора - действует только для данной страницы.';
protected $AX_CTDL = 'Дата и Время создания';
protected $AX_CTDD = 'Показать/Скрыть дату создания - действует только для данной страницы.';
protected $AX_MTDL = 'Дата и Время Изменения';
protected $AX_MTDD = 'Показать/Скрыть дату последнего изменения - действует только для данной страницы.';
protected $AX_PDFICL = 'Значок PDF';
protected $AX_PDFICD = 'Показать/Скрыть значок PDF - действует только для данной страницы.';
protected $AX_PRICL = 'Значок Печати';
protected $AX_PRICD = 'Показать/Скрыть значок печати - действует только для данной страницы.';
protected $AX_EMICL = 'Значок Email';
protected $AX_EMICD = 'Показать/Скрыть значок email - действует только для данной страницы.';
protected $AX_FTITLE = 'Название';
protected $AX_FAUTH = 'Автор';
protected $AX_FHITS = 'Хитов';
protected $AX_DESCRL = 'Описание';
protected $AX_DESCRD = 'Показать/Скрыть Описание.';
protected $AX_DESCRTXL = 'Текст Описания';
protected $AX_DESCRTXD = 'Описание Страницы, если пропущено, то будет загружено _WEBLINKS_DESC из вашего языкового файла';
protected $AX_IMAGEL = 'Изображение';
protected $AX_IMGFRPD = 'Изображение для страницы, должно быть расположено в каталоге /images/stories . По умолчанию - загрузит _links.jpg. -Без Изображения- означает, что изображения не будет.';
protected $AX_IMGALL = 'Выравнивание Изображения';
protected $AX_IMGALD = 'Выравнивание Изображения относительно текста.';
protected $AX_TBHEADL = 'Табличные Заголовки';
protected $AX_TBHEADD = 'Показать/Скрыть Табличные Заголовки.';
protected $AX_POSCOLL = 'Колонка Должность';
protected $AX_POSCOLD = 'Показать/Скрыть колонку Должность.';
protected $AX_EMAILCOLL = 'Колонка Email';
protected $AX_EMAILCOLD = 'Показать/Скрыть колонку Email.';
protected $AX_TELCOLL = 'Колонка Телефон';
protected $AX_TELCOLD = 'Показать/Скрыть колонку Телефон.';
protected $AX_FAXCOLL = 'Колонка Факс';
protected $AX_FAXCOLD = 'Показать/Скрыть колонку Факс.';
protected $AX_LEADINGL = '# главных';
protected $AX_LEADINGD = 'Количество отображённых объектов являющихся главными. 0 означает, что не будет объектов отображённых как главные.';
protected $AX_INTROL = '# с введением';
protected $AX_INTROD = 'Количество объектов отображаемых с вводным текстом.';
protected $AX_COLSL = 'Колонок';
protected $AX_COLSD = 'Когда отображается вводный текст, сколько колонок для использования на строку.';
protected $AX_LNKSL = '# ссылок';
protected $AX_LNKSD = 'Количество Объектов для отображение в качестве ссылок.';
protected $AX_CATORL = 'Порядок Категории';
protected $AX_CATORD = 'Порядок объектов в категории.';
protected $AX_OCAT01 = 'Порядок расположения';
protected $AX_OCAT02 = 'По названию (алфавитный)';
protected $AX_OCAT03 = 'По названию (обратный алфавитный)';
protected $AX_OCAT04 = 'Порядок';
protected $AX_PRMORL = 'Первичный Порядок';
protected $AX_PRMORD = 'OПорядок, в котором будут отображаться объекты.';
protected $AX_OPRM01 = 'По умолчанию';
protected $AX_OPRM02 = 'Порядок для Главной Страницы';
protected $AX_OPRM03 = 'Старейшие сверху';
protected $AX_OPRM04 = 'Новейшие сверху';
protected $AX_OPRM07 = 'Авторы - Алфавитный';
protected $AX_OPRM08 = 'Авторы - Обратный Алфавитный';
protected $AX_OPRM09 = 'Наибольшее количество хитов';
protected $AX_OPRM10 = 'Наименьшее количество хитов';
protected $AX_PAGL = 'Разбивка на страницы';
protected $AX_PAGD = 'Показать/Скрыть Разбивку на страницы.';
protected $AX_PAGRL = 'Результаты Разбивки на страницы';
protected $AX_PAGRD = 'Показать/Скрыть Результаты Разбивки на страницы (например, 1-4 из 4).';
protected $AX_MOSIL = 'MOSImages';
protected $AX_MOSID = 'Отображать {mosimages}.';
protected $AX_ITMTL = 'Название Объекта';
protected $AX_ITMTD = 'Показать/Скрыть название объекта.';
protected $AX_REMRL = 'Подробнее';
protected $AX_REMRD = 'Показать/Скрыть ссылку Подробнее.';
protected $AX_OTHCATL = 'Другие Категории';
protected $AX_OTHCATD = 'При просмотре категории, Показать/Скрыть список других Категорий.';
protected $AX_TDISTPD = 'Текст, отображаемый вверху страницы.';
protected $AX_ORDBYL = 'Упорядочивать по';
protected $AX_ORDBYD = 'Изменение порядка объектов.';
protected $AX_MCS_DESCL = 'Описание';
protected $AX_SHCDESD = 'Показать/Скрыть Описание Категории.';
protected $AX_DESCIL = 'Изображение Описания';
protected $AX_MUDATFL = 'Формат Даты';
protected $AX_MUDATFD = "Формат отображение даты, используйте формат PHP команды strftime - если не заполнено, будут использоваться настройки из языкового файла.";
protected $AX_MUDATCL = 'Колонка Даты';
protected $AX_MUDATCD = 'Показать/Скрыть колонку Даты.';
protected $AX_MUAUTCL = 'Колонка Автора';
protected $AX_MUAUTCD = 'Показать/Скрыть Колонку Автора.';
protected $AX_MUHITCL = 'Колонка Хитов';
protected $AX_MUHITCD = 'Показать/Скрыть Колонку счётчика.';
protected $AX_MUNAVBL = 'Панель Навигации';
protected $AX_MUNAVBD = 'Показать/Скрыть панель Навигации.';
protected $AX_MUORDSL = 'Выбор Порядка';
protected $AX_MUORDSD = 'Показать/Скрыть выпадающий список выбора порядка.';
protected $AX_MUDSPSL = 'Список Выбора';
protected $AX_MUDSPSD = 'Показать/Скрыть выпадающий список Выбора';
protected $AX_MUDSPNL = 'Количество объектов';
protected $AX_MUDSPND = 'Количество объектов отображаемых по умолчанию.';
protected $AX_MUFLTL = 'Фильтр';
protected $AX_MUFLTD = 'Показать/Скрыть Фильтр.';
protected $AX_MUFLTFL = 'Поле Фильтра';
protected $AX_MUFLTFD = 'Область применения Фильтра.';
protected $AX_MUOCATL = 'Другие Категории';
protected $AX_MUOCATD = 'Показать/Скрыть список других Категорий.';
protected $AX_MUECATL = 'Пустые Категории';
protected $AX_MUECATD = 'Показать/Скрыть пустые (не содержащие объектов) категории.';
protected $AX_CATDSCL = 'Описание Категории';
protected $AX_CATDSBLND = 'Показать/Скрыть Описание Категории (появится ниже названия категории).';
protected $AX_NAMCOLL = 'Колонка Названия';
protected $AX_LINKDSCL = 'Описание Ссылки';
protected $AX_LINKDSCD = 'Показать/Скрыть Текст Описания Ссылки.';
//com_contact/contact.xml
protected $AX_CCT_CDESC = 'Этот компонент отображает Контактную Информацию.';
protected $AX_CCT_CATLISTSL = 'Раздел - Список Категории';
protected $AX_CCT_CATLISTSD = 'Показать/Скрыть Список Категорий на странице просмотра Списка.';
protected $AX_CCT_CATLISTCL = 'Категория - Список Категории';
protected $AX_CCT_CATLISTCD = 'Показать/Скрыть Список Категорий на странице просмотра Таблицы.';
protected $AX_CCT_CATDSCD = 'Показать/Скрыть Описание для списка других категорий.';
protected $AX_CCT_NOCATITL = '# Объектов Категории';
protected $AX_CCT_NOCATITD = 'Показать/Скрыть количество объектов в каждой категории.';
//com_contact/contact_items.xml
protected $AX_CIT_CDESC = 'Параметры для индивидуального объекта Контакта.';
protected $AX_CIT_NAMEL = 'Имя';
protected $AX_CIT_NAMED = 'Показать/Скрыть Имя.';
protected $AX_CIT_POSITL = 'Должность';
protected $AX_CIT_POSITD = 'Показать/Скрыть должность.';
protected $AX_CIT_EMAILL = 'Email';
protected $AX_CIT_EMAILD = 'Показать/Скрыть email. Если вы выберите Показать, email будет защищён от спам-ботов с помощью javascript.';
protected $AX_CIT_SADDREL = 'Адрес';
protected $AX_CIT_SADDRED = 'Показать/Скрыть адрес.';
protected $AX_CIT_TOWNL = 'Город/населённый пункт';
protected $AX_CIT_TOWND = 'Показать/Скрыть город.';
protected $AX_CIT_STATEL = 'Регион';
protected $AX_CIT_STATED = 'Показать/Скрыть регион.';
protected $AX_CIT_COUNTRL = 'Страна';
protected $AX_CIT_COUNTRD = 'Показать/Скрыть страну.';
protected $AX_CIT_ZIPL = 'Почтовый Индекс';
protected $AX_CIT_ZIPD = 'Показать/Скрыть почтовый индекс.';
protected $AX_CIT_TELL = 'Телефон';
protected $AX_CIT_TELD = 'Показать/Скрыть телефон.';
protected $AX_CIT_FAXL = 'Факс';
protected $AX_CIT_FAXD = 'Показать/Скрыть факс.';
protected $AX_CIT_MISCL = 'Доп. Информация';
protected $AX_CIT_MISCD = 'Показать/Скрыть доп. информацию.';
protected $AX_CIT_VCARDL = 'Vcard';
protected $AX_CIT_VCARDD = 'Показать/Скрыть Vcard.';
protected $AX_CIT_CIMGL = 'Изображение';
protected $AX_CIT_CIMGD = 'Показать/Скрыть изображение.';
protected $AX_CIT_DEMAILL = 'Описание Email';
protected $AX_CIT_DEMAILD = 'Показать/Скрыть описание.';
protected $AX_CIT_DTXTL = 'Текст описания';
protected $AX_CIT_DTXTD = 'Описание текста Email формы, если не заполнено, то будет использовано _EMAIL_DESCRIPTION из языкового файла.';
protected $AX_CIT_EMFRML = 'Email форма';
protected $AX_CIT_EMFRMD = 'Показать/Скрыть email форму.';
protected $AX_CIT_EMCPYL = 'Копия Email';
protected $AX_CIT_EMCPYD = 'Показать/Скрыть опцию отправки копии email на адрес отправителя.';
protected $AX_CIT_DDL = 'Выпадающий список';
protected $AX_CIT_DDD = 'Показать/Скрыть Выпадающий список Контактов..';
protected $AX_CIT_ICONTXL = 'Значок/текст';
protected $AX_CIT_ICONTXD = 'Использовать значки, текст или ничего не использовать для отображаемой контактной информации.';
protected $AX_CIT_ICONS = 'Значки';
protected $AX_CIT_TEXT = 'Текст';
protected $AX_CIT_NONE = 'Ничего';
protected $AX_CIT_ADICONL = 'Значок Адреса';
protected $AX_CIT_ADICOND = 'Значок для информации об Адресе.';
protected $AX_CIT_EMICONL = 'Значок Email';
protected $AX_CIT_EMICOND = 'Значок для информации о Email.';
protected $AX_CIT_TLICONL = 'Значок Телефона';
protected $AX_CIT_TLICOND = 'Значок для информации о Телефоне.';
protected $AX_CIT_FXICONL = 'Значок Факса';
protected $AX_CIT_FXICOND = 'Значок для информации о Факсе.';
protected $AX_CIT_MCICONL = 'Значок Доп.Инфо';
protected $AX_CIT_MCICOND = 'Значок для дополнительной информации.';
protected $AX_CCT_NAMEL = 'Имя';
protected $AX_CCT_NAMED = 'Показать/Скрыть информацию об имени.';
protected $AX_CCT_POSITL = 'Должность';
protected $AX_CCT_POSITD = 'Показать/Скрыть информацию о должности.';
protected $AX_CCT_EMAILL = 'Email';
protected $AX_CCT_EMAILD = 'Показать/Скрыть информацию о email, если вы установите показывать - адрес будет зашищён от спам-ботов.';
protected $AX_CCT_SADDREL = 'Адрес';
protected $AX_CCT_SADDRED = 'Показать/Скрыть информацию о адресе.';
protected $AX_CCT_TOWNL = 'Город/населённый пункт';
protected $AX_CCT_TOWND = 'Показать/Скрыть информацию о населённом пункте.';
protected $AX_CCT_STATEL = 'Регион';
protected $AX_CCT_STATED = 'Показать/Скрыть информацию о регионе.';
protected $AX_CCT_COUNTRL = 'Страна';
protected $AX_CCT_COUNTRD = 'Показать/Скрыть информацию о стране.';
protected $AX_CCT_ZIPL = 'Индекс';
protected $AX_CCT_ZIPD = 'Показать/Скрыть информацию о индексе.';
protected $AX_CCT_TELL = 'Телефон';
protected $AX_CCT_TELD = 'Показать/Скрыть информацию о телефоне.';
protected $AX_CCT_FAXL = 'Факс';
protected $AX_CCT_FAXD = 'Показать/Скрыть информацию о факсе.';
protected $AX_CCT_MISCL = 'Доп. Информация';
protected $AX_CCT_MISCD = 'Показать/Скрыть доп.информацию';
protected $AX_CCT_VCARDL = 'Vcard';
protected $AX_CCT_VCARDD = 'Показать/Скрыть Vcard.';
protected $AX_CCT_CIMGL = 'Изображение';
protected $AX_CCT_CIMGD = 'Показать/Скрыть изображение.';
protected $AX_CCT_DEMAILL = 'Описание Email';
protected $AX_CCT_DEMAILD = 'Показать/Скрыть Текст Описания, указанный ниже.';
protected $AX_CCT_DTXTL = 'Текст Описания';
protected $AX_CCT_DTXTD = 'Текст Описания для формы Email, если пропущено, будет использовано _EMAIL_DESCRIPTION из языкового файла.';
protected $AX_CCT_EMFRML = 'Форма Email';
protected $AX_CCT_EMFRMD = 'Показать/Скрыть email форму.';
protected $AX_CCT_EMCPYL = 'Копия Email';
protected $AX_CCT_EMCPYD = 'Показать/Скрыть переключатель для отправки копии письма на адрес отправителя.';
protected $AX_CCT_DDL = 'Выпадающий Список';
protected $AX_CCT_DDD = 'Показать/Скрыть Выпадающий Список Контактов.';
protected $AX_CCT_ICONTXL = 'Значки/текст';
protected $AX_CCT_ICONTXD = 'Использовать значки, текст или ничего не использовать для отображаемой контактной информации.';
protected $AX_CCT_ICONS = 'Значки';
protected $AX_CCT_TEXT = 'Текст';
protected $AX_CCT_NONE = 'Ничего';
protected $AX_CCT_ADICONL = 'Значок Адреса';
protected $AX_CCT_ADICOND = 'Значок информации об Адресе.';
protected $AX_CCT_EMICONL = 'Значок Email';
protected $AX_CCT_EMICOND = 'Значок информации о Email.';
protected $AX_CCT_TLICONL = 'Значок Телефона';
protected $AX_CCT_TLICOND = 'Значок информации о Телефоне.';
protected $AX_CCT_FXICONL = 'Значок Факса';
protected $AX_CCT_FXICOND = 'Значок информации о Факсе.';
protected $AX_CCT_MCICONL = 'Значок доп.информация';
protected $AX_CCT_MCICOND = 'Значок доп.информации.';
//com_content/content.xml
protected $AX_CNT_CDESC = 'Отображение содержимого отдельной страницы.';
protected $AX_CNT_INTEXTL = 'Вводный текст';
protected $AX_CNT_INTEXTD = 'Показать/Скрыть вводный текст.';
protected $AX_CNT_KEYRL = 'Ключевая ссылка';
protected $AX_CNT_KEYRD = 'Текстовый ключ, на который может ссылаться объект (подобно ссылке помощи).';
//com_frontpage/frontpage.xml
protected $AX_FP_CDESC = 'Этот компонент отображает все материалы вашего сайта, помеченные Отображать на Главной Странице.';
//com_login/login.xml
protected $AX_LG_CDESC = 'Параметры для индивидуального контакта.';
protected $AX_LG_LPTL = 'Название страницы Входа';
protected $AX_LG_LPTD = 'Текст, отображаемый вверху страницы. Если пропущено, будет использоваться название Текущего Меню.';
protected $AX_LG_LRURLL = 'URL редиректа При Входе';
protected $AX_LG_LRURLD = 'На какую страницу будет осуществлён переход после входа, если не заполнено, будет загружена главная страница.';
protected $AX_LG_LJSML = 'JS Сообщение При Входе';
protected $AX_LG_LJSMD = 'Показать/Скрыть javascript Pop-up(всплывающий) индикатор успешного Входа.';
protected $AX_LG_LDESCL = 'Описание Входа';
protected $AX_LG_LDESCD = 'Показать/Скрыть Описание Входа, указанное ниже.';
protected $AX_LG_LDESTL = 'Текст Описания Входа';
protected $AX_LG_LDESTD = 'Текст для отображения на Странице Входа, если не заполнено будет использоваться _LOGIN_DESCRIPTION из языкового файла.';
protected $AX_LG_LIMGL = 'Изображение Входа';
protected $AX_LG_LIMGD = 'Изображение для Страницы Входа.';
protected $AX_LG_LIMGAL = 'Выравнивание Изображения Входа';
protected $AX_LG_LIMGAD = 'Выравнивание Изображения Входа относительно текста.';
protected $AX_LG_LOPTL = 'Название Страницы Выхода';
protected $AX_LG_LOPTD = 'Текст отображаемый вверху страницы. Если не заполнено, то будет отображаться название текущего Меню.';
protected $AX_LG_LORURLL = 'URL редиректа при Выходе';
protected $AX_LG_LORURLD = 'На какую страницу будет осуществлён переход после выхода, если не заполнено, будет загружена главная страница.';
protected $AX_LG_LOJSML = 'JS Сообщение При Выходе';
protected $AX_LG_LOJSMD = 'Показать/Скрыть javascript Pop-up(всплывающий) индикатор успешного Выхода.';
protected $AX_LG_LODSCL = 'Описание Выхода';
protected $AX_LG_LODSCD = 'Показать/Скрыть Описание Выхода, указанное ниже.';
protected $AX_LG_LODSTL = 'Текст Описания Выхода';
protected $AX_LG_LODSTD = 'Текст для отображения на Странице Выхода, если не заполнено будет использоваться _LOGOUT_DESCRIPTION из языкового файла.';
protected $AX_LG_LOGOIL = 'Изображение Выхода';
protected $AX_LG_LOGOID = 'Изображение для Страницы Выхода.';
protected $AX_LG_LOGOIAL = 'Выравнивание Изображения Выхода';
protected $AX_LG_LOGOIAD = 'Выравнивание Изображения Выхода относительно текста.';
//com_massmail/massmail.xml
protected $AX_MM_CDESC = 'Этот компонент позволяет вам создавать почтовые рассылки для отправки определённым группам пользователей.';
//com_media/media.xml
protected $AX_ME_CDESC = 'Это компонент управляет медиа-содержимым сайта.';
//com_menumanager/menumanager.xml
protected $AX_MNU_CDESC = 'Этот компонент управляет вашим меню.';
//com_menus/component_item_link/component_item_link.xml
protected $AX_MUCIL_CNAME = 'Ссылка - Объект Компонента';
protected $AX_MUCIL_CDESC = 'Создаёт ссылку на существующий Компонент Elxis.';
//com_menus/components/components.xml
protected $AX_MUCOMP_CNAME = 'Компонент';
protected $AX_MUCOMP_CDESC = 'Отображение внешнего интерфейса для Компонента.';
//com_menus/contact_category_table/contact_category_table.xml
protected $AX_MUCCT_CNAME = 'Таблица - Контакты Категории';
protected $AX_MUCCT_CDESC = 'Отображает Таблицу Контактов определённой категории.';
protected $AX_MUCCT_CATDL = 'Описание Категории';
protected $AX_MUCCT_CATDD = 'Показать/Скрыть Описание других Категорий.';
//com_menus/contact_item_link/contact_item_link.xml
protected $AX_MUCTIL_CNAME = 'Ссылка - Контакт';
protected $AX_MUCTIL_CDESC = 'Создаёт ссылку на Опубликованный Контакт';
//com_menus/content_archive_category/content_archive_category.xml
protected $AX_MUCAC_CNAME = 'Блог - Содержимое Архива Категории';
protected $AX_MUCAC_CDESC = 'Отображает список заархивированного содержимого категории.';
//com_menus/content_archive_section/content_archive_section.xml
protected $AX_MUCAS_CNAME = 'Блог - Содержимое Архива Раздела';
protected $AX_MUCAS_CDESC = 'Отображает список заархивированного содержимого раздела.';
//com_menus/content_blog_category/content_blog_category.xml
protected $AX_MUCBC_CNAME = 'Блог - Содержимое Категории';
protected $AX_MUCBC_CDESC = 'Отображает страницу содержимого категории в виде блога.';
//com_menus/content_blog_section/content_blog_section.xml
protected $AX_MUCBS_CNAME = 'Блог - Содержимое Раздела';
protected $AX_MUCBS_CDESC = 'Отображение страницы содержимого раздела в виде блога.';
protected $AX_MUCBS_SHSD = 'Показать/Скрыть Описание Раздела.';
//com_menus/content_category/content_category.xml
protected $AX_MUCC_CNAME = 'Таблица - Содержимое Категории';
protected $AX_MUCC_CDESC = 'Отображение Таблицы Содержимого категории.';
protected $AX_MUCC_SHLOCD = 'Показать/Скрыть список других Категорий.';
//com_menus/content_item_link/content_item_link.xml
protected $AX_MCIL_CNAME = 'Ссылка - Объект Содержимого';
protected $AX_MCIL_CDESC = 'Создание ссылки на опубликованный Объект Содержимого.';
//com_menus/content_section/content_section.xml
protected $AX_MCS_CNAME = 'Таблица - Содержимое Раздела';
protected $AX_MCS_CDESC = 'Создаёт таблицу Содержимого категорий для этого раздела.';
protected $AX_MCS_STL = 'Название Раздела';
protected $AX_MCS_STD = 'Показать/Скрыть название раздела.';
protected $AX_MCS_SHCTID = 'Показать/Скрыть Изображения, описывающие Категории.';
//com_menus/content_typed/content_typed.xml
protected $AX_MLSC_CNAME = 'Ссылка - Автономная страница';
protected $AX_MLSC_CDESC = 'Создание ссылки на Автономную страницу.';
//com_menus/newsfeed_category_table/newsfeed_category_table.xml
protected $AX_MNSFC_CNAME = 'Таблица - Лента Новостей Категории';
protected $AX_MNSFC_CDESC = 'В виде Таблицы показываются Ленты Новостей определённой Категории.';
protected $AX_MNSFC_SHNCD = 'Показать/Скрыть Колонку Названия.';
protected $AX_MNSFC_ACL = 'Колонка Статьи';
protected $AX_MNSFC_ACD = 'Показать/Скрыть Колонку Статьи.';
protected $AX_MNSFC_LCL = 'Колонка Ссылки';
protected $AX_MNSFC_LCD = 'Показать/Скрыть Колонку Ссылки.';
//com_menus/newsfeed_link/newsfeed_link.xml
protected $AX_MNSFL_CNAME = 'Ссылка - Лента Новостей';
protected $AX_MNSFL_CDESC = 'Создание ссылки на отдельно опубликованную Ленту Новостей.';
protected $AX_MNSFL_FDIML = 'Изображение Ленты';
protected $AX_MNSFL_FDIMD = 'Показать/Скрыть изображение ленты.';
protected $AX_MNSFL_FDDSL = 'Описание ленты';
protected $AX_MNSFL_FDDSD = 'Показать/Скрыть текст описания ленты.';
protected $AX_MNSFL_WDCL = 'Ограничение текста';
protected $AX_MNSFL_WDCD = 'Разрешить ограничивать текст описания объектов. При 0 показывается весь текст.';
//com_menus/separator/separator.xml
protected $AX_MSEP_CNAME = 'Разделитель / Заполнитель';
protected $AX_MSEP_CDESC = 'Создаёт разделитель пунктов мею.';
//com_menus/url/url.xml
protected $AX_MURL_CNAME = 'Ссылка - Url';
protected $AX_MURL_CDESC = 'Создание URL ссылки.';
//com_menus/weblink_category_table/weblink_category_table.xml
protected $AX_MWLC_CNAME = 'Таблица - Категория Веб-Ссылок';
protected $AX_MWLC_CDESC = 'Отображение таблицы Веб-ссылок определённой категории веб-ссылок';
//com_menus/wrapper/wrapper.xml
protected $AX_MWRP_CNAME = 'Оболочка';
protected $AX_MWRP_CDESC = 'Создание плавающего фрейма (IFrame), в котором отображается удалённая страница/сайт.';
protected $AX_MWRP_SCRBL = 'Полоса Прокрутки';
protected $AX_MWRP_SCRBD = 'Показать/Скрыть Горизонтальную & Вертикальную полосу полосу прокрутки.';
protected $AX_MWRP_WDTL = 'Ширина';
protected $AX_MWRP_WDTD = 'Ширина Окна IFrame, вы можете установить абсолютное значение в пикселах или значение в %.';
protected $AX_MWRP_HEIL = 'Высота';
protected $AX_MWRP_HEID = 'Высота Окна IFrame.';
protected $AX_MWRP_AHL = 'Высота - Авто';
protected $AX_MWRP_AHD = 'Автоматическая установка высоты. Работает только для страниц на вашем домене.';
protected $AX_MWRP_AADL = 'Авто Добавление';
protected $AX_MWRP_AADD = 'По умолчанию будет добавлятся http:// если уже не добавлено http:// или https:// к введённой ссылке.';
//com_menus/system/system.xml
protected $AX_MSYS_CNAME = 'Системная ссылка';
protected $AX_MSYS_CDESC = 'Создание ссылки на системную функцию';
//com_newsfeeds/newsfeeds.xml
protected $AX_NFE_CDESC = 'Этот компонет управляет лентами RSS/RDF.';
protected $AX_NFE_DPD = 'Описание страницы';
protected $AX_NFE_SHFNCD = 'Показать/Скрыть колонку Названия Ленты.';
protected $AX_NFE_NOACL = 'Колонка # Статей';
protected $AX_NFE_NOACD = 'Показать/Скрыть количество статей в ленте.';
protected $AX_NFE_LCL = 'Колонка Ссылки';
protected $AX_NFE_LCD = 'Показать/Скрыть Колонку Ссылки Ленты.';
protected $AX_NFE_IDL = 'Описание Объекта';
protected $AX_NFE_IDD = 'Показать/Скрыть описание или вступительный текст для объекта.';
//com_search/search.xml
protected $AX_SEAR_CDESC = 'Этот компонент управляет функцией Поиска.';
//com_syndicate/syndicate.xml
protected $AX_SYN_CDESC = 'Этот компонент контролирует настройки Экспорта Новостей.';
protected $AX_SYN_CACHL = 'Кэширование';
protected $AX_SYN_CACHD = 'Включить кэширование.';
protected $AX_SYN_CACHTL = 'Время жизни Кэш';
protected $AX_SYN_CACHTD = 'Кэш файл будет обновляться каждые x секунд.';
protected $AX_SYN_ITMSL = '# Объектов';
protected $AX_SYN_ITMSD = 'Количество Объектов для экспорта.';
protected $AX_SYN_ITMSDFLT = 'Экспорт новостей Elxis';
protected $AX_SYN_TITLE = 'Название';
protected $AX_SYN_DESCD = 'Описание.';
protected $AX_SYN_DESCDFLT = 'Экспорт новостей сайта Elxis';
protected $AX_SYN_IMGD = 'Изображение в ленте.';
protected $AX_SYN_IMGAL = 'Альтернативный текст для изображения';
protected $AX_SYN_IMGAD = 'Альтернативный текст для изображения.';
protected $AX_SYN_IMGADFLT = 'Elxis';
protected $AX_SYN_LMTL = 'Ограничение текста';
protected $AX_SYN_LMTD = 'Ограничить объём текста статей значением, указанным ниже.';
protected $AX_SYN_TLENL = 'Длина текста';
protected $AX_SYN_TLEND = 'Ограничение длины текста - при 0 показывается весь текст.';
protected $AX_SYN_LBL = 'Живые Закладки';
protected $AX_SYN_LBD = 'Активация поддержки живых закладок браузером Firefox.';
protected $AX_SYN_BFL = 'Файл Закладки';
protected $AX_SYN_BFD = 'Специальное имя файла, если пусто, будет использовано значение по умолчанию.';
protected $AX_SYN_ORDL = 'Порядок';
protected $AX_SYN_ORDD = 'Порядок в котором будут отображаться объекты.';
protected $AX_SYN_MULTIL = 'Мультиязычные ленты';
protected $AX_SYN_MULTILD = 'Если да, Elxis будет генерировать ленты, основанные на используемых языках.';
//com_trash/trash.xml
protected $AX_TRSH_CDESC = 'Этот компонент управляет Корзиной.';
//com_typedcontent/typedcontent.xml
protected $AX_TDC_CDESC = 'Отображение содержимого страницы.';
//com_weblinks/weblinks.xml
protected $AX_WBL_CDESC = 'Этот компонент отображает Веб-ссылки со скриншотами сайтов.';
protected $AX_WBL_LDL = 'Описания Ссылок';
protected $AX_WBL_LDD = 'Показать/Скрыть описания ссылок.';
protected $AX_WBL_ICL = 'Значок';
protected $AX_WBL_ICD = 'Значок, используемый слева от url ссылке в Табличном виде.';
protected $AX_WBL_SCSL = 'Скриншоты';
protected $AX_WBL_SCSD = 'Показывает скриншот сайта, указанного в ссылке. Если использовано, то указанный выше значок отображаться не будет.';
//com_weblinks/weblinks_item.xml
protected $AX_WBLI_TD = 'Окно, открываемое при нажатии ссылки.';
protected $AX_WBLI_OT01 = 'Родительское Окно с Навигацией';
protected $AX_WBLI_OT02 = 'Новое Окно с Навигацией';
protected $AX_WBLI_OT03 = 'Новое окно Без Навигации';
//ADMINISTRATOR MODULES
//administrator/modules/mod_latest.xml
protected $AX_AM_LN_DESC = 'Этот модуль показывает список недавно опубликованных объектов. Объекты, отображаемые на Главной Станице, не включаются в список.'; 
//administrator/modules/mod_logged.xml
protected $AX_AM_LG_DESC = 'Этот модуль показывает список успешно авторизировавшихся пользователей.'; 
//administrator/modules/mod_popular.xml
protected $AX_AM_PI_DESC = 'Этот модуль показывает список наиболее популярных опубликованных объектов. Объекты, отображаемые на Главной Странице, не включаются в список.'; 
//administrator/modules/mod_stats.xml
protected $AX_AM_ST_DESC = 'Этот модуль отображает статистику Объектов. Объекты, отображаемые на Главной Странице, не включаются в список.'; 
//SITE MODULES
//General
protected $AX_SM_MCSL = 'Суффикс Класса Модуля'; 
protected $AX_SM_MCSD = 'Суффикс, который будет использован в описании класса таблицы стилей css модуля, это позволяет использовать индивидуальный стиль модуля.'; 
protected $AX_SM_MUCSL = 'Суффикс Класса Меню'; 
protected $AX_SM_MUCSD = 'Суффикс, который будет использован в описании класса пункта меню в таблице стилей.'; 
protected $AX_SM_ECL = 'Включить Кэш'; 
protected $AX_SM_ECD = 'Кэширование содержимого этого модуля.'; 
protected $AX_SM_SMIL = 'Показывать Значки Меню'; 
protected $AX_SM_SMID = 'Отображает Значки Меню, выбранные вами для ваших объектов меню.'; 
protected $AX_SM_MIAL = 'Выравнивание Значка Меню'; 
protected $AX_SM_MIAD = 'Выравнивание Значка Меню'; 
protected $AX_SM_MODL = 'Режим Модуля'; 
protected $AX_SM_MODD = 'Позволяет конктролировать тип содержимого, отображаемого этим модулем.'; 
protected $AX_SM_OP01 = 'Только Объекты Содержимого'; 
protected $AX_SM_OP02 = 'Только Автономные Страницы'; 
protected $AX_SM_OP03 = 'Оба типа'; 
//modules/custom.xml
protected $AX_SM_CU_DESC = 'Заказной Модуль.'; 
protected $AX_SM_CU_RSURL = 'URL RSS'; 
protected $AX_SM_CU_RSURD = 'Введите URL RSS/RDF ленты.'; 
protected $AX_SM_CU_FEDL = 'Описание Ленты'; 
protected $AX_SM_CU_FEDD = 'Текст описания для этой Ленты.'; 
protected $AX_SM_CU_FEIL = 'Изображения Ленты'; 
protected $AX_SM_CU_FEDID = 'Показывать изображение, ассоциирующееся с этой Лентой.'; 
protected $AX_SM_CU_ITL = 'Объектов'; 
protected $AX_SM_CU_ITD = 'Введите количество RSS объектов для отображения.'; 
protected $AX_SM_CU_ITDL = 'Описание Объекта'; 
protected $AX_SM_CU_ITDD = 'Показывать вводный текст для каждого новостного объекта.'; 
protected $AX_SM_CU_WCL = 'Ограничение Размера'; 
protected $AX_SM_CU_WCD = 'Устанавливает ограничение размера выводимого текста описания. При 0 отображается весь текст.'; 
//modules/mod_archive.xml
protected $AX_SM_AR_DESC = 'Этот модуль показывает список календарных месяцев, которые содержат архивные объекты. Cписок архивных объектов будет создан автоматически после изменения статуса объекта содержимого на "Архивный".'; 
protected $AX_SM_AR_CNTL = 'Количество'; 
protected $AX_SM_AR_CNTD = 'Количество объектов для отображения (по умолчанию 10).'; 
//modules/mod_banners.xml
protected $AX_SM_BN_DESC = 'Модуль баннера позволяет показывать активные баннеры из компонента внутри Вашего сайта.'; 
protected $AX_SM_BN_CNTL = 'Клиент баннера'; 
protected $AX_SM_BN_CNTD = "Ссылка на идентификатор покупателя баннера. Введите разделяя ','!"; 
protected $AX_SM_BN_NBSL = 'Количество показов';
protected $AX_SM_BN_NBPRL = 'Количество баннеров на строку';
protected $AX_SM_BN_NBPRD = 'Количество баннеров на строку, для отключения установите 0. Для отображения баннера в вертикальном положении установите 1';
protected $AX_SM_BN_UNQBL = 'Уникальные баннеры';
protected $AX_SM_BN_UNQBD = 'Баннер показывается только один раз (за сессию), если все баннеры были показаны, история очищается и показ начинается заново.';
//modules/mod_latestnews.xml
protected $AX_SM_LN_DESC = 'Этот модуль отображает список последних опубликованных объектов. Объекты, отображаемые на главной странице, в список не включаются.'; 
protected $AX_SM_LN_FPIL = 'Объекты Главной Страницы'; 
protected $AX_SM_LN_FPID = 'Показать/Скрыть объекты, опубликованные на главной странице.'; 
protected $AX_SM_AR_CNT5D = 'Количество объектов для отображения (по умолчанию 5).'; 
protected $AX_SM_LN_CATIL = 'ID Категории'; 
protected $AX_SM_LN_CATID = 'Выбор объектов из определённой Категории или Категорий (для более одной категории разделите запятой , ).'; 
protected $AX_SM_LN_SECIL = 'ID Раздела'; 
protected $AX_SM_LN_SECID = 'Выбор объектов из определённого Раздела или Разделов (для более одного раздела разделите запятыми , ).'; 
//modules/mod_login.xml
protected $AX_SM_LF_DESC = 'Этот модуль отображает Форму для авторизации пользователя. Также он отображает ссылку для восстановления забытого пароля. Если регистрация пользователей разрешена, то показывается также ссылка для регистрации.'; 
protected $AX_SM_LF_PTL = 'Pre-Текст'; 
protected $AX_SM_LF_PTD = 'Это Текст или HTML-код, который будет располагаться над Формой Авторизации.'; 
protected $AX_SM_LF_PSTL = 'Post-Текст'; 
protected $AX_SM_LF_PSTD = 'Текст или HTML-код, который отображен ниже Формы авторизации.'; 
protected $AX_SM_LF_LRUL = 'URL Редиректа при Входе'; 
protected $AX_SM_LF_LRUD = 'На какую страницу будет перенаправлен пользователь после успешной авторизации, если не заполнено, то будет перенаправлен на главную страницу.'; 
protected $AX_SM_LF_LORUL = 'URL Редиректа при Выходе'; 
protected $AX_SM_LF_LORUD = 'На какую страницу будет перенаправлен пользователь после успешного Выход, если не заполнено, то будет перенаправлен на главную страницу.'; 
protected $AX_SM_LF_LML = 'Сообщение при входе'; 
protected $AX_SM_LF_LMD = 'Показать/Скрыть всплывающее окошко javascript об успешном Входе.'; 
protected $AX_SM_LF_LOML = 'Сообщение при выходе'; 
protected $AX_SM_LF_LOMD = 'Показать/Скрыть всплывающее окошко javascript об успешном Выходе.'; 
protected $AX_SM_LF_GML = 'Приветствие'; 
protected $AX_SM_LF_GMD = 'Показать/Скрыть текст приветствия.'; 
protected $AX_SM_LF_NUNL = 'Имя/Логин'; 
protected $AX_SM_LF_OP01 = 'Логин'; 
protected $AX_SM_LF_OP02 = 'Имя'; 
//modules/mod_mainmenu.xml
protected $AX_SM_MNM_DESC = 'Отображать меню.'; 
protected $AX_SM_MNM_MNL = 'Название Меню'; 
protected $AX_SM_MNM_MND = 'Название Меню (по умолчанию \'mainmenu\').'; 
protected $AX_SM_MNM_MSL = 'Стиль Меню'; 
protected $AX_SM_MNM_MSD = 'Стиль Меню'; 
protected $AX_SM_MNM_OP1 = 'Вертикально'; 
protected $AX_SM_MNM_OP2 = 'Горизонтально'; 
protected $AX_SM_MNM_OP3 = 'Плоский список'; 
protected $AX_SM_MNM_EML = 'Расширенное Меню'; 
protected $AX_SM_MNM_EMD = 'Расширьте меню и сделайте его подменю всегда видимыми.'; 
protected $AX_SM_MNM_IIL = 'Изображение'; 
protected $AX_SM_MNM_IID = 'Выберите изображение для пунктов подменю.'; 
protected $AX_SM_MNM_OP4 = 'Из Шаблона'; 
protected $AX_SM_MNM_OP5 = 'Изображение Elxis по умолчанию'; 
protected $AX_SM_MNM_OP6 = 'Использовать следующие параментры'; 
protected $AX_SM_MNM_OP7 = 'Нет'; 
protected $AX_SM_MNM_II1L = '1-ый уровень'; 
protected $AX_SM_MNM_II1D = 'Изображение для первого уровня подменю.'; 
protected $AX_SM_MNM_II2L = '2-ой уровень'; 
protected $AX_SM_MNM_II2D = 'Изображение для второго уровня подменю.'; 
protected $AX_SM_MNM_II3L = '3-ий уровень'; 
protected $AX_SM_MNM_II3D = 'Изображение для третьего уровня подменю.'; 
protected $AX_SM_MNM_II4L = '4-ый уровень'; 
protected $AX_SM_MNM_II4D = 'Изображение для четвёртого уровня подменю.'; 
protected $AX_SM_MNM_II5L = '5-ый уровень'; 
protected $AX_SM_MNM_II5D = 'Изображение для пятого уровня подменю.'; 
protected $AX_SM_MNM_II6L = '6-ый уровень'; 
protected $AX_SM_MNM_II6D = 'Изображение для шестого уровня подменю.'; 
protected $AX_SM_MNM_SPL = 'Разделитель'; 
protected $AX_SM_MNM_SPD = 'Разделитель для горизонтального меню.'; 
protected $AX_SM_MNM_ESL = 'Разделитель по концам'; 
protected $AX_SM_MNM_ESD = 'Разделитель по концам горизонтального меню.';
protected $AX_SM_MNM_IDPR = 'SEO PRO Itemid';
protected $AX_SM_MNM_IDPRD = 'Включите AJAX подгрузку Itemid, для решения проблемы с настройкой нескольких пунктов меню, ссылающихся на одну и ту же страницу.';
//modules/mod_mostread.xml
protected $AX_SM_MRC_DESC = 'Этот модуль показывает список наиболее часто просматриваемых Объектов, опубликованных в настоящее время.'; 
protected $AX_SM_MRC_MNL = 'Название Меню'; 
protected $AX_SM_MRC_MND = 'Название меню (по умолчанию mainmenu).'; 
protected $AX_SM_MRC_FPIL = 'Объекты Главной страницы'; 
protected $AX_SM_MRC_FPID = 'Показать/Скрыть объекты, назначенные главной странице, работает только в режиме только объекты содержимого.'; 
protected $AX_SM_MRC_CL = 'Количество'; 
protected $AX_SM_MRC_CD = 'Количество объектов для отображения (по умолчанию 5).'; 
protected $AX_SM_MRC_CIDL = 'ID Категории'; 
protected $AX_SM_MRC_CIDD = 'Используйте объекты из отдельной Категории или установите Категории (для более одной категории разделите запятыми , ).'; 
protected $AX_SM_MRC_SIDL = 'ID Раздела'; 
protected $AX_SM_MRC_SIDD = 'Используйте объекты из отдельного Раздела или установите Разделы (для более одного раздела разделите запятыми , ).'; 
//modules/mod_newsflash.xml
protected $AX_SM_NWF_DESC = 'Этот модуль случайно выбирает один из опубликованных объектов из определенной категории при каждом обновлении страницы. В зависимости от конфигурации можно показывать несколько новостей горизонтально или вертикально.'; 
protected $AX_SM_NWF_CATL = 'Категория'; 
protected $AX_SM_NWF_CATD = 'Содержимое категории.'; 
protected $AX_SM_NWF_STL = 'Стиль'; 
protected $AX_SM_NWF_STD = 'Стиль отображения категории.'; 
protected $AX_SM_NWF_OP1 = 'Случайный выбор по-одному'; 
protected $AX_SM_NWF_OP2 = 'Горизонтально'; 
protected $AX_SM_NWF_OP3 = 'Вертикально'; 
protected $AX_SM_NWF_SIL = 'Показывать изображения'; 
protected $AX_SM_NWF_SID = 'Отображает изображения объектов содержимого.'; 
protected $AX_SM_NWF_LTL = 'Названия в виде Ссылок'; 
protected $AX_SM_NWF_LTD = 'Сделать Названия Объектов ссылками.'; 
protected $AX_SM_NWF_RML = 'Подробнее'; 
protected $AX_SM_NWF_RMD = 'Показать/Скрыть кнопку Подробнее.'; 
protected $AX_SM_NWF_ITL = 'Название Объекта'; 
protected $AX_SM_NWF_ITD = 'Показывать название объекта.'; 
protected $AX_SM_NWF_NOIL = '№ Объектов'; 
protected $AX_SM_NWF_NOID = '№ Оъектов для отображения.'; 
//modules/mod_poll.xml
protected $AX_SM_POL_DESC = 'Это модуль компонента Опросы. Он используется для отображения сконфигурированных опросов. Модуль отличается от других модулей тем, что он обеспечивает связь компонента между пунктами меню и опросами. Модуль показывает опросы, настроенные для определенного пункта меню.'; 
protected $AX_SM_POL_CATL = 'Категория'; 
protected $AX_SM_POL_CATD = 'Содержимое категории.'; 
//modules/mod_random_image.xml
protected $AX_SM_RNI_DESC = 'Этот модуль отображает случайное изображение из выбранного вами каталога.'; 
protected $AX_SM_RNI_ITL = 'Тип Изображения'; 
protected $AX_SM_RNI_ITD = 'Тип изображения PNG/GIF/JPG. (по умолчанию JPG).'; 
protected $AX_SM_RNI_IFL = 'Каталог Изображений'; 
protected $AX_SM_RNI_IFD = 'Путь к каталогу с изображениями, без указания url сайта, например: images/stories.'; 
protected $AX_SM_RNI_LNL = 'Ссылка'; 
protected $AX_SM_RNI_LND = 'URL для редиректа по клику на изображении, например: http://www.goup.gr'; 
protected $AX_SM_RNI_WL = 'Ширина (px)'; 
protected $AX_SM_RNI_WD = 'Ширина изображения (все изображения будут отображаться с этой шириной).'; 
protected $AX_SM_RNI_HL = 'Высота (px)'; 
protected $AX_SM_RNI_HD = 'Высота изображения (все изображения будут отображаться с этой высотой).'; 
//modules/mod_related_items.xml
protected $AX_SM_RLI_DESC = "Этот модуль показывает объекты содержимого, тематически связанные с текущим объектом. Работа модуля основана на совпадении ключевых слов метаданных. Все ключевые слова текущего объекта содержимого сравниваются со всеми ключевыми словами других опубликованных объектов. Например, просматривая статью 'Греция' будет показана ссылка на статью 'Олимп', если в обоих статьях ключевым словом будет слово \"греция\"."; 
//modules/mod_rssfeed.xml
protected $AX_SM_RSS_DESC = 'Модуль экспорта новостей (Syndication), отображает ссылку, с помощью которой люди могут получать последние новости вашего сайта на свой сайт. Если Вы нажмете на значок RSS, то Вы будете перенаправлены на новую страницу со списком всех последних новостей в формате XML. Для того чтобы использовать Ленту новостей на другом сайте Elxis! или в программе для чтения лент новостей, Вы должны скопировать и вставить в них URL ссылки ленты новостей.'; 
protected $AX_SM_RSS_TXL = 'Текст'; 
protected $AX_SM_RSS_TXD = 'Введите текст, который будет отображён с RSS ссылкой.'; 
protected $AX_SM_RSS_091D = 'Показать/Скрыть RSS 0.91.'; 
protected $AX_SM_RSS_10D = 'Показать/Скрыть RSS 1.0.'; 
protected $AX_SM_RSS_20D = 'Показать/Скрыть RSS 2.0.'; 
protected $AX_SM_RSS_03D = 'Показать/Скрыть Atom 0.3.'; 
protected $AX_SM_RSS_OPD = 'Показать/Скрыть OPML.'; 
protected $AX_SM_RSS_I091L = 'Значок RSS 0.91'; 
protected $AX_SM_RSS_I10L = 'Значок RSS 1.0'; 
protected $AX_SM_RSS_I20L = 'Значок RSS 2.0'; 
protected $AX_SM_RSS_I03L = 'Значок Atom'; 
protected $AX_SM_RSS_IOPL = 'Значок OPML'; 
protected $AX_SM_RSS_CHID = 'Выберите Используемый Значок.'; 
//modules/mod_search.xml
protected $AX_SM_SEM_DESC = 'Этот модуль отображает форму поиска';
protected $AX_SM_SEM_TOP = 'Сверху';
protected $AX_SM_SEM_BTM = 'Снизу';
protected $AX_SM_SEM_BWL = 'Ширина Формы';
protected $AX_SM_SEM_BWD = 'Размер формы поиска.';
protected $AX_SM_SEM_TXL = 'Текст';
protected $AX_SM_SEM_TXD = 'Текст, отображаемый в форме поиска, если пусто, то будет использовано _SEARCH_BOX из вашего языкового файла.';
protected $AX_SM_SEM_BPL = 'Расположение кнопки';
protected $AX_SM_SEM_BPD = 'Позиция кнопки относительно формы поиска.';
protected $AX_SM_SEM_BTXL = 'Текст на кнопке';
protected $AX_SM_SEM_BTXD = 'Текст на кнопке поиска, если не заполнено, будет использоваться _SEARCH_TITLE из вашего языкового файла.'; 
//modules/mod_sections.xml
protected $AX_SM_SEC_DESC = 'Модуль Разделы отображает список всех разделов из базы данных. Разделы связаны только с объектами Разделов. Если выбрано "Показывать ссылки неавторизованным", то пользователям будет виден только список разрешенных для просмотра разделов.'; 
protected $AX_SM_SEC_CL = 'Количество';
protected $AX_SM_SEC_CD = 'Количество отображаемых объектов (по умолчанию 5).';
//modules/mod_stats.xml
protected $AX_SM_STA_DESC = 'Модуль статистики показывает информацию о вашем сайте(количество посетителей, статей и т.д.)';
protected $AX_SM_STA_SVIL = 'Информация о сервере'; 
protected $AX_SM_STA_SVID = 'Отображать информацию о сервере.'; 
protected $AX_SM_STA_SIL = 'Информация о сайте'; 
protected $AX_SM_STA_SID = 'Отображать информацию о сайте.'; 
protected $AX_SM_STA_HCL = 'Счётчик хитов'; 
protected $AX_SM_STA_HCD = 'Отображать счётчик хитов.'; 
protected $AX_SM_STA_ICL = 'Увеличение счётчика'; 
protected $AX_SM_STA_ICD = 'Введите количество хитов, для увеличения счётчика.'; 
//modules/mod_templatechooser.xml
protected $AX_SM_TMC_DESC = 'Модуль Выбора Шаблона позволяет пользователю (посетителю) выбирать шаблон сайта из выпадающего списка.'; 
protected $AX_SM_TMC_MNLL = 'Макс. Длина Названия'; 
protected $AX_SM_TMC_MNLD = 'Это максимальная длина названия шаблона для отображения (по умолчанию 20).'; 
protected $AX_SM_TMC_SPL = 'Показывать Эскиз'; 
protected $AX_SM_TMC_SPD = 'Показывает Эскиз Шаблона (уменьшенную копию).'; 
protected $AX_SM_TMC_WL = 'Ширина'; 
protected $AX_SM_TMC_WD = 'Ширина эскиза (по умолчанию 140 px).'; 
protected $AX_SM_TMC_HL = 'Высота'; 
protected $AX_SM_TMC_HD = 'Высота эскиза (по умолчанию 90 px).'; 
//modules/mod_whosonline.xml
protected $AX_SM_WSO_DESC = 'Модуль Кто Online отображает количество посетителей, находящихся в данный момент на сайте.'; 
protected $AX_SM_WSO_DL = 'Отображать'; 
protected $AX_SM_WSO_DD = 'Выберите, что должно быть показано.'; 
protected $AX_SM_WSO_OP1 = '# Гостей/Пользователей<br />'; 
protected $AX_SM_WSO_OP2 = 'Имена Пользователей<br />'; 
protected $AX_SM_WSO_OP3 = 'Оба'; 
//modules/mod_wrapper.xml
protected $AX_SM_WRM_DESC = 'Этот модуль отображает окно IFrame (показывает удалённый сайт на вашем).'; 
protected $AX_SM_WRM_URLL = 'URL'; 
protected $AX_SM_WRM_URLD = 'URL сайт/файла, который вы хотите отобразить с помощью IFrame'; 
protected $AX_SM_WRM_SCBL = 'Прокрутка'; 
protected $AX_SM_WRM_SCBD = 'Показать/Скрыть Горизонтальную и Вертикальную Прокрутку.'; 
protected $AX_SM_WRM_WL = 'Ширина'; 
protected $AX_SM_WRM_WD = 'Ширина окна IFrame , вы можете ввести абсолютное значение в px или указать значение в %.'; 
protected $AX_SM_WRM_HL = 'Высота'; 
protected $AX_SM_WRM_HD = 'Высота окна IFrame'; 
protected $AX_SM_WRM_AHL = 'Авто Высота'; 
protected $AX_SM_WRM_AHD = 'Высота автоматически будет установлена по величине с внешней страницей. Это будет работать только для страниц вашего домена.'; 
protected $AX_SM_WRM_ADL = 'Авто Добавление'; 
protected $AX_SM_WRM_ADD = 'По умолчанию http:// будет добавлено если уже не обнаружено http:// или https:// на url Введённый Вами.'; 
/* mambots/editors/tinymce */
protected $AX_ED_FUNCTL = 'Функциональность'; 
protected $AX_ED_FUNCTD = 'Выберите Функциональность'; 
protected $AX_ED_FUNSIMPLE = 'Обычная'; 
protected $AX_ED_FUNADV = 'Расширенная';
protected $AX_ED_EDITORWIDTHL = 'Ширина Редактора';
protected $AX_ED_EDITORWIDTHD = 'Ширина Окна Редактора';
protected $AX_ED_EDITORHEIGHTL = 'Высота Редактора';
protected $AX_ED_EDITORHEIGHTD = 'Высота Окна Редактора';
protected $AX_ED_COMPRESSEDVL = 'Сжатие';
protected $AX_ED_COMPRESSEDVD = 'TinyMCE может работать в сжатом режиме для увеличения быстродействия.  Однако, этот режим не всегда работает, особенно в IE, поэтому выключен по умолчанию. Будьте осторожны устанавливая этот режим для вашей системы';
protected $AX_ED_OFF = 'Выкл';
protected $AX_ED_ON = 'Вкл';
protected $AX_ED_COMPRESSL = 'Сжатие';
protected $AX_ED_COMPRESSD = 'Сжать Редактор TinyMCE используя gzip (увеличение скорости на 75%)';
protected $AX_ED_CONVERTURLL = 'Преобразовывать URL';
protected $AX_ED_CONVERTURLD = 'Преобразовывать абсолютные URL в относительные.';
protected $AX_ED_ENTENCODL = 'Кодировка';
protected $AX_ED_ENTENCODD = 'Эта настройка контролирует преобразование символов TinyMCE. Возможно числовое представление, именованное и не обработанное, при котором не происходит преобразования. Значение по умолчанию - именованное.';
protected $AX_ED_TXTDIRL = 'Направление Текста';
protected $AX_ED_TXTDIRD = 'Изменение Направление текста';
protected $AX_ED_CNVFONTSPANL = 'Преобразовать теги Font в Span';
protected $AX_ED_CNVFONTSPAND = 'Преобразовывает элементы Font в элементы Span.';
protected $AX_ED_FONTSIZETYPEL = 'Размер шрифта';
protected $AX_ED_FONTSIZETYPED = 'Выберите размер используемого шрифта в относительных или абсолютных единицах (например, 10pt или x-small).';
protected $AX_ED_INLTABLEDITL = 'Встроенный Редактор Таблиц';
protected $AX_ED_INLTABLEDITD = 'Использовать встроенный редактор таблиц.';
protected $AX_ED_PROHELEMENTSL = 'Запрещённые элементы';
protected $AX_ED_PROHELEMENTSD = 'Элементы, которые будут удаляться из текста';
protected $AX_ED_EXTELEMENTSL = 'Расширенные Элементы';
protected $AX_ED_EXTELEMENTSD = 'Расширение функциональности путем добавления здесь дополнительных элементов. Формат: elm[tag1|tag2]';
protected $AX_ED_EVELEMENTSL = 'Элементы событий';
protected $AX_ED_EVELEMENTSD = 'Этот параметр должен содержать через запятую список элементов, которые могут иметь атрибуты события, как onclick и аналогичные. Этот параметр необходим, поскольку некоторые браузеры исполняют эти события при редактировании содержания.';
protected $AX_ED_TCSSCLASSESL = 'СSS-классы из шаблона';
protected $AX_ED_TCSSCLASSESD = 'Загрузка CSS-классов из template_css.css';
protected $AX_ED_CCSSCLASSESL = 'Пользовательские классы CSS';
protected $AX_ED_CCSSCLASSESD = 'В случае если вы хотите загрузить свой CSS-файл, то введите ПОЛНЫЙ путь до этого файла. Этот файл ДОЛЖЕН находиться в том же каталоге, чтои и CSS-файл вашего шаблона.';
protected $AX_ED_NEWLINESL = 'Теги Новой строки';
protected $AX_ED_NEWLINESD = 'Теги Новой строки';
protected $AX_ED_TOOLBARL = 'Панель Инструментов';
protected $AX_ED_TOOLBARD = 'Расположение Панели Инстурментов';
protected $AX_ED_HTMLHEIGHTL = 'Высота HTML';
protected $AX_ED_HTMLHEIGHTD = 'Высота всплывающего окна в режиме HTML.';
protected $AX_ED_HTMLWIDTHL = 'Ширина HTML';
protected $AX_ED_HTMLWIDTHD = 'Ширина всплывающего окна в режиме HTML';
protected $AX_ED_PREVIEWHEIGHTL = 'Высота Окна предпросмотра';
protected $AX_ED_PREVIEWHEIGHTD = 'Высота всплывающего Окна Предпросмотра.';
protected $AX_ED_PREVIEWWIDTHL = 'Ширина окна Предпросмотра';
protected $AX_ED_PREVIEWWIDTHD = 'Ширина всплывающего Окна Предпросмотра.';
protected $AX_ED_IBROWSERL = 'iBrowser Plugin';
protected $AX_ED_IBROWSERD = 'iBrowser - расширенный менеджер изображений';
protected $AX_ED_PLTABLESL = 'Plugin Таблиц';
protected $AX_ED_PLTABLESD = 'Включение Табличного Редактора в режиме WYSIWYG.';
protected $AX_ED_PLPASTEL = 'Plugin Вставки';
protected $AX_ED_PLPASTED = 'Включает Вставку из Word, Простого Текста и функцию Выбрать Всё.';
protected $AX_ED_PLIMGPLUGINL = 'Расш. Plugin Изображений';
protected $AX_ED_PLIMGPLUGIND = 'Включает Расширенный Менеджер Изображений. По умолчанию включен простой Редактор Изображений.';
protected $AX_ED_PLSEARCHL = 'Plugin Поиска/Замены';
protected $AX_ED_PLSEARCHD = 'Включает функцию поиска/замены.';
protected $AX_ED_PLLINKSL = 'Расш. Plugin Ссылок';
protected $AX_ED_PLLINKSD = 'Включает Расширенный Менеджер Ссылок. По умолчанию влючен простой Редактор Ссылок.';
protected $AX_ED_PLEMOTL = 'Plugin Смайлов';
protected $AX_ED_PLEMOTD = 'Включает Plugin Смайлов. Вы легко можете добавить Смайлики.';
protected $AX_ED_PLFLASHL = 'Flash Plugin';
protected $AX_ED_PLFLASHD = 'Включение Flash Plugin. Вы сможете добавлять Flash в содержимое.';
protected $AX_ED_PLDTL = 'Plugin Даты/Времени';
protected $AX_ED_PLDTD = 'Включение Дата/Время Plugin. Вы сможете добавлять текущее время и дату в содержимое.';
protected $AX_ED_PLPREVL = 'Plugin Предпросмотра';
protected $AX_ED_PLPREVD = 'Этот plugin добавляет кнопку предпросмотра в TinyMCE, нажав которую появится всплывающие окошко, отображающее текущее содержимое.';
protected $AX_ED_PLZOOML = 'Zoom Plugin';
protected $AX_ED_PLZOOMD = 'Добавляет функцию изменения масштаба в MSIE5.5+';
protected $AX_ED_PLFSCRL = 'Полноэкранный Режим';
protected $AX_ED_PLFSCRD = 'Этот plugin добавляет функцию полноэкранного режима TinyMCE.';
protected $AX_ED_PLPRINTL = 'Plugin Печати';
protected $AX_ED_PLPRINTD = 'Этот plugin добавляет кнопку печати в TinyMCE.';
protected $AX_ED_PLDIRL = 'Plugin Направления';
protected $AX_ED_PLDIRD = 'Этот plugin добавляет значок изменения направления письма в TinyMCE для лучшего управления языками с написанием слева направо.';
protected $AX_ED_PLFONTSL = 'Шрифт';
protected $AX_ED_PLFONTSD = 'Этот plugin добавляет функцию выбора шрифта из выпадающего списка.';
protected $AX_ED_PLFONTSZL = 'Размер Шрифта';
protected $AX_ED_PLFONTSZD = 'Этот plugin добавляет функцию выбора размера шрифта из выпадающего списка.';
protected $AX_ED_PLFORMLSL = 'Форматирование';
protected $AX_ED_PLFORMLSD = 'Этот plugin добавляет функцию выбора форматирования из выпадающего списка, например, H1, H2, и т.д.';
protected $AX_ED_PLSSLL = 'CSS стили';
protected $AX_ED_PLSSLD = 'Этот plugin добавляет css-стили из CSS файла шаблона, установленного по умолчанию.';
protected $AX_ED_NAMED = 'Именованная';
protected $AX_ED_NUMERIC = 'Числовая';
protected $AX_ED_RAW = 'Не обработанная';
protected $AX_ED_LTR = 'Слево Направо';
protected $AX_ED_RTL = 'Справа Налево';
protected $AX_ED_LENGTH = 'Длина';
protected $AX_ED_ABSSIZE = 'Абсолютное значение';
protected $AX_ED_BRELEMENTS = 'BR Элементы';
protected $AX_ED_PELEMENTS = 'P Элементы';
//TOOLS
//Calculator: /administrator/tools/calculator/calculator.xml
protected $AX_TCAL_L = 'Калькулятор';
protected $AX_TCAL_D = 'Javascript калькулятор';
//Empty Temporary: /administrator/tools/empty_temporary/empty_temporary.xml
protected $AX_TEMTEMP_L = 'Очистить tmpr';
protected $AX_TEMTEMP_D = 'Очистка каталога Elxis для временного хранения данных (/tmpr).';
//FixLanguage: /administrator/tools/fix_language/fix_language.xml
protected $AX_TFIXLANG_L = 'Исправить Язык';
protected $AX_TFIXLANG_D = 'Выполняет проверку в многоязычной базе данных и совершает исправления по необходимости.';
//Organizer: /administrator/tools/organizer/organizer.xml
protected $AX_TORGANIZ_L = 'Органайзер';
protected $AX_TORGANIZ_D = 'Органайзер Elxis управляет вашими контактами, заметками, закладками и т.д.';
//Clean Cache: /administrator/tools/clean_cache/clean_cache.xml
protected $AX_TCLEANCACHE_L = 'Очистка Кэш';
protected $AX_TCLEANCACHE_D = 'Очистка содержимого кэш каталога';
//Chmod: /administrator/tools/chmod/chmod.xml
protected $AX_TCHMOD_L = 'Изменение прав';
protected $AX_TCHMOD_D = 'Изменение прав на каталоги и файлы';
//FixPgSequences: /administrator/tools/fix_pg_sequences/fix_pg_sequences.xml
protected $AX_TFPGSEQ_L = 'Postgres sequences';
protected $AX_TFPGSEQ_D = 'Исправление Postgres sequences (при необходимости).';
//Elxis Registration: /administrator/tools/registration/registration.xml
protected $AX_TELXREG_L = 'Регистрация Elxis';
protected $AX_TELXREG_D = 'Зарегистрируйте вашу установку Elxis в GO UP Inc';
//com_menus/bridge/bridge.xml
protected $AX_BRIDGE_CNAME = 'Мост';
protected $AX_BRIDGE_CDESC = 'Создать ссылку на Мост.';
//modules/mod_language.xml
protected $AX_NEW_LINE = 'Новая линия';
protected $AX_SAME_LINE = 'Та же линия';
protected $AX_INDICATOR = 'Индикатор';
protected $AX_INDICATOR_D = 'Отображать Язык как Индикатор';
protected $AX_FLAG = 'Флаг';
//modules/mod_language.xml
protected $AX_MODLANGD = 'Отображение опции выбора языка на сайте в виде выпадающего списка, списка ссылок или флагов.';
protected $AX_FLAGS = 'Флаги';
protected $AX_SMARTSW = 'Интеллектуальный выбор';
protected $AX_SMARTSW_D = 'Возможность интеллектуального изменения языка - при этом вы видите ту же страницу содержимого, но на другом языке.';
//modules/mod_random_profile.xml
protected $AX_RP_DESC = 'Отображение случайных профилей пользователей';
protected $AX_DISPSTYLE = 'Стиль отображения';
protected $AX_COMPACT = 'Компактный';
protected $AX_EXTENDED = 'Расширенный';
protected $AX_GENDER = 'Пол';
protected $AX_GENDERDESC = 'Отображать пол пользователя?';
protected $AX_AGE = 'Возрас';
protected $AX_AGEDESC = 'Отображать возраст пользователя?';
protected $AX_REALUNAME = 'Показывать реальное имя или логин?';
//weblinks item
protected $AX_WBLI_TL = 'Target';
//content
protected $AX_RTFICL = 'Значок RTF';
protected $AX_RTFICD = 'Показать/Скрыть значок RTF - только для данной страницы.';
//modules/mod_whosonline.xml
protected $AX_MODWHO_FILGR = 'Фильтр Групп';
protected $AX_MODWHO_FILGRD = 'Если да, то пользователи с более низким уровнем доступа не будут видеть статус пользователей с более высоким уровнем доступа.';
//search bots
protected $AX_SEARCH_LIMIT = 'Лимит поиска';
protected $AX_MAXNUM_SRES = 'Максимальное число результатов поиска';
//modules/mod_frontpage
protected $AX_MODFRONTPAGE = 'Отображение последних добавлений на сайте. Идеально для главной страницы.'; 
protected $AX_SECTIONS = 'ID Разделов';
protected $AX_SECTIONSD = 'ID Разделов, разделённых запятыми (,)';
protected $AX_CATEGORIES = 'ID Категорий';
protected $AX_CATEGORIESD = 'ID Категорий, разделённых запятыми (,)';
protected $AX_NUMDAYS = 'Количество дней';
protected $AX_NUMDAYSD = 'Отображать объекты, созданные за последние X дней (по умолчанию 900)';
protected $AX_SHOWTHUMBS = 'Показывать миниатюры';
protected $AX_SHOWTHUMBSD = 'Показать/Скрыть миниатюры изображений в вводном тексте.';
protected $AX_THUMBWIDTHD = 'Ширина миниатюр в пикселах';
protected $AX_THUMBHEIGHTD = 'Высота миниатюр в пикселах';
protected $AX_KEEPRATIO = 'Сохранить пропорции';
protected $AX_KEEPRATIOD = 'Сохранение пропорций изображения. Если Да, то настройка Высота миниатюры не учитывается.';
//com_menus/eblog_item_link/eblog_item_link.xml
protected $AX_EBLOGITEM = 'Объект eBlog';
protected $AX_EBLOGITEMD = 'Создаёт ссылку на опубликованный блог компонента eBlog';
//2009.0
protected $AX_COMMENTARY = 'Комментарии';
protected $AX_COMMENTARYD = 'Выберите, кто может комментировать эту статью.';
protected $AX_NOONE = 'Никто';
protected $AX_REGUSERS = 'Зарегистрированные пользователи';
protected $AX_ALL = 'Все';
protected $AX_COMMENTS = 'Комментарии';
protected $AX_COMMENTSD = 'Показать количество комментариев?';

}

?>