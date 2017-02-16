<?php
/**
* @version: 1.
* @copyright: Copyright (C) 2009 Andrew Campball. All rights reserved.
* @package: Elxis
* @subpackage: Component AkForms
* @author: Andrej Kmabalov
* @author e-mail: ACampball@yandex.ru
* @description: Russian language for component AkForms
* @license: GPL
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещен.' );


class akFormLanguage {

	public $COPYRIGHT = "Компонент <strong>AkForms</strong>. Разработчик - Андрей Камбалов.";

	public $_CHECKED = 'выбрано';
	public $_SELECTED = 'выбрано';

	/************************************/
	/* Административная часть           */
	/************************************/
	public $GENERALSETS           = 'Основные настройки';
	public $CFG_MAXFILESIZE = 'Объем изображения';
	public $CFG_MAXFILESIZED = 'Максимальный объем загружаемого изображения';
	public $SHOWCOPYRIGHT = 'Показывать copyright';
	public $SHOWCOPYRIGHTD = 'Показывать сообщение об авторских правах в нижней части страницы?';

	public $A_FORMS               = 'Формы';
	public $A_NAME                = 'Название';
	public $A_EMAILS              = 'E-mail';
	public $A_EMAILSD             = 'Список E-mail (разделенные запятыми) на которые будет отсылаться содержимое формы.';
	public $A_DESCRIPTION         = 'Описание';
	public $A_CSS_TEXT            = 'CSS-стили';
	public $A_CAPTCHA             = 'Использовать код подтверждения';

	public $A_FIELDS              = 'Поля';
	public $A_FIELD_LABEL         = 'Заголовок';
	public $A_FIELD_TYPE          = 'Тип поля';
	public $A_FIELD_NOTNULL       = 'Обязательное';
	public $A_FIELD_HIDE          = 'Скрытое поле';
	public $A_FIELD_CLASS         = 'CSS-класс поля';
	public $A_FIELD_STYLE         = 'CSS-стиль поля';
	public $A_FIELD_HEIGHT        = 'Высота строки';
	public $A_FIELD_READONLY      = 'Только для чтения';
	public $A_FIELD_WOLABEL       = 'Без заголовка';
	public $A_FIELD_SUPPORT_EXT   = 'Разрешенные расширения файлов (через запятую)';

	public $A_FIELD_ADD_OPTION    = 'Добавить опцию';

	public $A_FIELD_DEFVALUE      = 'Значение по умолчанию';
	public $A_FIELD_MAXLENGTH     = 'Максимальная длина';
	public $A_FIELD_OPTIONSFOR    = 'Настройки для';

	/* Сообщения */
	public $EMSG_EMPTY_NAME      = 'Название не должно быть пустым';
	public $EMSG_1OPTVLEAST      = 'По крайней мере один параметр должен быть выбран';
	public $EMSG_1OPTLEAST       = 'Необходимо выбрать хотя бы один вариант';
	public $EMSG_EMPTY_LABEL     = 'Заголовок не должен быть пустым';
	public $EMSG_MAXFILESIZE     = 'Размер файла не должен превышать %s Кб';
	public $EMSG_UNSUPPORTIMAGE  = "Неразрешенный формат файла.";


	/************************************/
	/* Пользовательская часть           */
	/************************************/
	public $ERR_FIELD_EMPTY         = 'Поле %s не должно быть пустым';

	public $SEND_SUCCESS            = 'Спасибо! Ваши данные отправлены успешно.';

	public $ERR_NO_PARAMS           = 'Неопределены параметры';
	public $ERR_UPLOAD_FILE         = 'Произошла ошибка при загрузке файла на сервер';
	public $ERR_SEND_MAIL           = 'Извините! Во время отправки произошла ошибка.';
	public $ERR_MOVE_FILE           = 'Произошла ошибка при перемещении файла в папку';

	public $MSG_TITLE               = 'Сообщение с сайта';

	/************************************/
	/* v 1.2                            */
	/************************************/

	public $COPY_SUFFIX             = 'Копия';
	public $EXPORT_FORM             = 'Экспорт';
	public $IMPORT_FORM             = 'Импорт';
	public $SQL_FILED_TIP           = 'Для выбора данных из таблицы нужно указать два поля с именами: VALUE и TEXT.<br/>Например: SELECT id AS value, name AS text FROM #_tablename';

	/************************************/
	/* v 1.3                            */
	/************************************/
	public $MAIL_SUBJECT            = 'Тема письма';
	public $SEND_COPY               = 'Отправлять копию';
	public $ONSUCCESS               = 'Сообщение об успешной отправке';
	public $BOTTON_SEND_TEXT        = 'Текст кнопки "Отправить"';
	public $PRE_TEXT_MESSAGE        = 'Текст для копии сообщения';
	public $IMPORT_FROM_TEXT        = 'Импорт из текста';
	public $SAVE_POSTED_DATA        = 'Сохранять в базе отправленные данные';
	public $A_DATA                  = 'Данные';
	public $FOLDER_FILES            = 'Каталог хранения файлов';
	public $CREATE_FOLDER_FILES     = 'Создать, если не существует';

	/************************************/
	/* v 1.4                            */
	/************************************/
	public $SELECT_DESC             = 'Каждый параметр должен быть на отдельной строке.';
	public $VALSELECT_DESC          = 'Значение от текста отделяется знаком "=". Пример: 1=Один.';
	public $WHERE_INCLUDE           = 'Куда включать поле';
	public $WHERE_INCLUDE_ARR       = array(0 => 'Везде', 1 => 'Только в базу', 2 => 'Только в почту');
	public $TITLE_IN_VALUES         = 'Заголовок данных';
	public $TITLE_IN_VALUESD        = 'Использовать данное поле в качестве заголовка таблицы с отправленными данными';
	public $FILTER_IN_VALUES        = 'Фильтр данных';
	public $FILTER_IN_VALUESD       = 'Использовать данное поле в качестве фильтра таблицы с отправленными данными';
	public $VALUE_FILTER            = 'Фильтр';
	public $A_FORM                  = 'Форма';
	public $FORM_DATA_STATUS        = 'Статус данных';
	public $BOT_NOTIFY              = 'Бот akForms - не установлен';

	/************************************/
	/* v 1.6                            */
	/************************************/
	public $FORM_GROUPS             = 'Группы данных';
	public $FORM_GROUP              = 'Группа данных';
	public $FORM_GROUP_TITLE        = 'Заголовок группы';
	public $FORM_GROUP_DELETE       = 'Удалить группу';
	public $FORM_GROUP_ADD          = 'Добавить группу';

	public $INVALID_FORM_ID         = 'Неверный код формы';

	public $ALLOW_SAVE_FORM         = 'Разрешить сохранение формы';
	public $ALLOW_SEE_SAVEDATA      = 'Разрешить просмотр сохраненных данных';
	public $ALLOW_SEE_SENDDATA      = 'Разрешить просмотр отправленных данных';
	public $ALLOW_SEND_REPEATLY     = 'Разрешить повторную отправку данных';

	public $FORM_DATA_SAVED         = 'Данные формы сохранены';
	public $CFG_EXPIRE              = 'Время хранения сохраненных данных (дн.)';
	public $CFG_EXPIRE_D     		= 'Определяет сколько будет храниться сохраненных данные.';

	public $SUBMITTED_FORMS   		= 'Отправленные формы';
	public $SAVED_FORMS     		= 'Сохраненные формы';

	public $_VIEW                   = 'Просмотр';
	public $_EDIT                   = 'Изменить';
	public $_DELETE                 = 'Удалить';

	public $CONFIRM_DELETE          = 'Вы уверены, что хотите удалить?';

	/************************************/
	/* v 1.7                            */
	/************************************/
	public $DATA_SAVED              = 'Сохраненные данные';
	public $DATA_SUBMITTED          = 'Отправленные данные';

	public function __construct() {
	}

}

?>