<?php
/*********************************************

*
**** ATTENTION: THIS FILE IS UTF-8 ENCODED! *****
*
*********************************************/

defined( '_VALID_MOS' ) or die( 'Доступ запрещён.' );


//MODULE XML PARAMS
if (defined('_ELXIS_ADMIN')) {
    define('CX_01a', 'Тип меню');  
    define('CX_01', 'Список меню для отображения (разделённый запятыми)');
    define('CX_02', '[Выберите]');
    define('CX_03', 'Список меню (не используется, только для справки!)');
    define('CX_04', 'Основа');
    define('CX_05', 'Что должно использоваться в качестве основы каждого меню? Опции: первый, меню, модуль, сайт, текст');
    define('CX_06', 'первый');
    define('CX_07', 'меню');
    define('CX_08', 'модуль');
    define('CX_09', 'сайт');
    define('CX_10', 'текст');
    define('CX_11', 'Текстовая основа');
    define('CX_12', 'Если основа - текст, установите текст для использования');
    define('CX_13', 'Разделитель');
    define('CX_14', 'По умолчанию заголовок модуля отображается (если установлена соответствующая настройка в параметрах модуля)');
    define('CX_15', 'Раскрыть полностью');
    define('CX_16', 'По умолчанию в меню все подменю кроме активного свёрнуты. Используя этот параметр, вы можете сделать все подменю видимыми. Перекрывает настройку Свернуть Уровень');
    define('CX_true', 'Да');
    define('CX_false', 'Нет');
    define('CX_17', 'Использовать Выделение');
    define('CX_18', 'Пункты могут быть выделены (подсвечены).');
    define('CX_19', 'Использовать Линии');
    define('CX_20', 'Меню будет отображаться с разделительными линиями.');
    define('CX_21', 'Использовать Иконки');
    define('CX_22', 'В меню будут использоваться иконки.');
    define('CX_23', 'Текст в Statusbar');
    define('CX_24', 'Отображать название пункта в statusbar браузера вместо url.');
    define('CX_25', 'Свернуть Уровень');
    define('CX_26', 'Только один пункт в родительском может быть развернут в текущий момент.');

}
?>