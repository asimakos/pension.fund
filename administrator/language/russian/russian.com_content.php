<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Coursar
* @link: http://www.elxis.ru
* @email: info@elxis.ru
* @description: Russian language for component content
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещён.' );


class adminLanguage extends standardLanguage {

public $A_CMP_CNT_ITEMSMNG = 'Содержимое';
public $A_CMP_CNT_DATEFORMAT = 'Y-m-d h:i:s';
public $A_CMP_CNT_ALTEDITCONT = 'Изменить содержимое';
public $A_CMP_CNT_TRASH = 'Пожалуйста выберите элементы из списка для помещения в Корзину';
public $A_CMP_CNT_TRASHMESS = 'Вы уверены, что хотите переместить выбранное в Корзину? \nВы сможете их восстановить из корзины в любое время.';
public $A_CMP_CNT_ARCHMANAGER = 'Архив';
public $A_CMP_CNT_DATECREATED = '%A, %d %B %Y %H:%M';
public $A_CMP_CNT_DATEMODIFIED = '%A, %d %B %Y %H:%M';
public $A_CMP_CNT_MUSTTITLE = 'У объекта содержимого должно быть название';
public $A_CMP_CNT_MUSTSECTN = 'Выберите Раздел.';
public $A_CMP_CNT_MUSTCATEG = 'Выберите Категорию.';
public $A_CMP_CNT_CONTITEM = 'Содержимое';
public $A_CMP_CNT_ITEMDETLS = 'Настройки Объекта';
public $A_CMP_CNT_INTRO = 'Вводный текст: (обязательно)';
public $A_CMP_CNT_MAIN = 'Основной текст: (опционально)';
public $A_CMP_CNT_FRONTPAGE = 'Показывать на Главной';
public $A_CMP_CNT_AUTHOR = 'Псевдоним Автора';
public $A_CMP_CNT_CREATOR = 'Изменить Автора';
public $A_CMP_CNT_OVERRIDE = 'Изменить Дату Создания';
public $A_CMP_CNT_STRTPUB = 'Начать Публикацию';
public $A_CMP_CNT_FNSHPUB = 'Окончить Публикацию';
public $A_CMP_CNT_DRFTUNPUB = 'Неопубликованный черновик';
public $A_CMP_CNT_RESETHIT = 'Сбросить счётчик хитов';
public $A_CMP_CNT_REVISED = 'Исправлено';
public $A_CMP_CNT_TIMES = 'раз';
public $A_CMP_CNT_BY = 'Автор';
public $A_CMP_CNT_NEWDOC = 'Новый Документ';
public $A_CMP_CNT_LASTMOD = 'Последнее изменение';
public $A_CMP_CNT_NOTMOD = 'Не изменялся';
public $A_CMP_CNT_ADDETC = 'Добавить Раздел/Категорию/Название';
public $A_CMP_CNT_LINKCI = 'Будет создан пункт меню \'Ссылка - Объект Содержимого\'';
public $A_CMP_CNT_SOMTHING = 'Сделайте выбор';
public $A_CMP_CNT_MVEITEMS = 'Содержимое: Переместить';
public $A_CMP_CNT_MVESECCAT = 'Переместить в Раздел/Категорию';
public $A_CMP_CNT_ITMSMVED = 'Перемещаемые объекты';
public $A_CMP_CNT_SECCAT = 'Выберите Раздел/Категорию для копирования';
public $A_CMP_CNT_CPYITEMS = 'Содержимое: Копировать';
public $A_CMP_CNT_CPYSECCAT = 'Копировать в Раздел/Категорию';
public $A_CMP_CNT_ITMSCPED = 'Копируемые объекты';
public $A_CMP_CNT_CCHECL = 'Кэш Очищен';
public $A_CMP_CNT_CANNOT = 'Вы не можете изменить заархивированные объекты';
public $A_CMP_CNT_THMODULIS = 'Модуль';
public $A_CMP_CNT_DROWCRED = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_DROWMOD = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_DROWPUB = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_PBLINEV = 'Никогда';
public $A_CMP_CNT_DPUBLISHUP = 'Y-m-d';
public $A_CMP_CNT_SLSECTN = 'Выберите Раздел';
public $A_CMP_CNT_SELCAT = 'Выберите Категорию';
public $A_CMP_CNT_ARCHVED = 'Успешно добавлено в Архив';
public $A_CMP_CNT_PUBLSHED = 'Успешно Опубликовано';
public $A_CMP_CNT_ITSUUNP = 'Успешно снято с Публикации';
public $A_CMP_CNT_ITSUUNA = 'Успешно извлечено из Архива';
public $A_CMP_CNT_SELITOG = 'Выберите объект для переключения';
public $A_CMP_CNT_SELIDEL = 'Выберите объект для удаления';
public $A_CMP_CNT_ERROCCRD = 'Произошла ошибка';
public $A_CMP_CNT_MOVD = 'Успешно перенесено в Раздел';
public $A_CMP_CNT_COPED = 'Успешно скопировано в Раздел';
public $A_CMP_CNT_RSTHTCNT = 'Успешно сброшен счётчик хитов для';
public $A_CMP_CNT_INMENU = 'Пункт (Ссылка - Автономная Страница) в меню';
public $A_CMP_CNT_SUCCSS = 'успешно создан';
public $A_CMP_CNT_RSZERO = 'Вы уверены, что хотите обнулить счётчик хитов? \nВсе несохранённые изменения будут потеряны.';
public $A_CMP_CNT_MUST_CIMNA = 'У содержимого должно быть название';
public $A_CMP_CNT_SITMAPFOR = 'Содержимое по языкам:';
public $A_CMP_CNT_ALLLANGS = 'Все языки';
public $A_CMP_CNT_LANG = 'язык';
public $A_CMP_CNT_PHRENAME = 'Нажмите и удерживайте для переименования';
public $A_CMP_CNT_EDITITEM = 'Изменить';
public $A_CMP_CNT_NOTES = 'Примечания';
public $A_CMP_CNT_PRSHREN = 'Нажмите и удерживайте для переименования';
public $A_CMP_CNT_EMPCATSEC = 'Дерево не отображает пустые разделы и категории.';
public $A_CMP_CNT_TREEUNPUBL = 'Пункты, маркированные серым цветом и курсивом, не опубликованы';
public $A_CMP_CNT_NULLVAL = 'Установлена недействительная величина!';
public $A_CMP_CNT_INCCTP = 'Неверный тип содержимого';
public $A_CMP_CNT_CLDNFETCH = 'Не удаётся выбрать данные';
public $A_CMP_CNT_TRSELPAIR = 'Пожалуйста, выберите языковую пару';
public $A_CMP_CNT_TRSOUDEST = 'Выберите языковую пару для перевода';
public $A_CMP_CNT_TRITEMS = 'Переводимые объекты';
public $A_CMP_CNT_TRNOTE = '<strong>Примечание Elxis:</strong> Тщательно выберите исходный язык и язык, на который необходимо перевести. Эта процедура может занять 
        некоторое время в зависимости от объёма переводимого текста.<br>
        Перевод осуществляется бесплатным сервером Altavista.
        Elxis не несёт ответственности за результат перевода.';
public $A_CMP_CNT_TRSELITEM = 'Выберите объект для перевода';
public $A_CMP_CNT_TROKSAVED = 'Объект успешно переведён и копирован';
public $A_CMP_CNT_TRITMNOTF = 'Выбранный объект не обнаружен в базе данных!';
public $A_CMP_CNT_MFS = 'Сообщение с сервера';
public $A_CMP_CNT_WID = 'с id';
public $A_CMP_CNT_RNMTO = 'переименован в';
public $A_CMP_CNT_FL= 'Фильтр "Язык"';
public $A_CMP_CNT_CONFL = 'Языковой конфликт';
public $A_CMP_CNT_CONFI = 'Пункт находится в категории с языковыми настройками, не позволяющими отображать его!';
public $A_CMP_CNT_STARTALW = 'Начало: Всегда';
public $A_CMP_CNT_FINNOEXP = 'Окончание: Никогда';
public $A_CMP_CNT_FINISH = 'Окончить';
public $A_CMP_CNT_FROM = 'с';
public $A_CMP_CNT_SHOWHIDE = 'Показать/Скрыть';
public $A_SIMPLEVIEW = 'Простой вид';
public $A_EXTENDVIEW = 'Расширенный вид';
public $A_CMP_CNT_COMMENTS = 'Комментарии';
public $A_CMP_CNT_SAVTRANS = 'Объект перенесён и сохранён как содержимое сайта';
public $A_CMP_CNT_RELLINKS = 'Связанные ссылки';
public $A_CMP_CNT_RELLINKSD = 'Ссылки, связанные с этой статьёй. Если в желаете добавить внешние ссылки, пожалуйста указывайте префикс http:// в URL.';

}

?>
