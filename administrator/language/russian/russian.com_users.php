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
* @description: Russian language for component typedcontent
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Доступ запрещён.' );


class adminLanguage extends standardLanguage {

public $A_CMP_USS_LOGIN = 'Авторизирован';
public $A_CMP_USS_ALL = 'Все';
public $A_CMP_USS_ID = 'UserID';
public $A_CMP_USS_LSTV = 'Последний визит';
public $A_CMP_USS_ENBLD = 'Активен';
public $A_CMP_USS_BLCKD = 'Заблокирован';
public $A_CMP_USS_LVDATE = '%Y-%m-%d %H:%M:%S'; //Last visit Date
public $A_CMP_USS_PFISNOT = 'Пожалуйста Выберите другую группу, \'Public Frontend\' недоступна для выбора';
public $A_CMP_USS_PBISNOT = 'Пожалуйста Выберите другую группу, \'Public Backend\' недоступна для выбора';
public $A_CMP_USS_DETAILS = 'Настройки пользователя';
public $A_CMP_USS_EMAIL = 'Email';
public $A_CMP_USS_PASS = 'Новый пароль';
public $A_CMP_USS_VERIFY = 'Подтверждение пароля';
public $A_CMP_USS_BLOCK = 'Заблокировать';
public $A_CMP_USS_SUBMI = 'Получать Email';
public $A_CMP_USS_REGDATE = 'Дата регистрации';
public $A_CMP_USS_VISDTE = 'Дата последнего визита';
public $A_CMP_USS_CONTCT = 'Контактная информация';
public $A_CMP_USS_NDETL = 'Нет контактной информации, связанной с этим пользователем, используйте<br />используйте \'Компоненты -> Контакты -> Управление Контактами\'';
public $A_CMP_USS_SUCCH = 'Изменения успешно сохранены';
public $A_CMP_USS_SUCUSR = 'Пользователь успешно сохранён';
public $A_CMP_USS_CANNOT = 'Вы не можете удалить Супер Администратора';
public $A_CMP_USS_CANNYO = 'Вы не можете удалить себя!';
public $A_CMP_USS_CANNUS = 'У вас недостаточно прав для удаления этого пользователя';
public $A_CMP_USS_SLUSER = 'Выберите пользователя';
public $A_CMP_USS_FLGOUT = 'Завершить сеанс';
public $A_CMP_USS_UMUST = 'Необходимо выбрать логин для этого пользователя.';
public $A_CMP_USS_ULOGIN = 'Логин содержит недопустимые символы или имеет очень маленькую длину.';
public $A_CMP_USS_MSTEMAIL = 'Необходимо ввести email адрес.';
public $A_CMP_USS_ASSIGN = 'Необходимо установить группу для пользователя.';
public $A_CMP_USS_NOMATC = 'Пароли не совпадают.';
public $A_CMP_USS_FLOGD = 'Фильтр "Авторизирован"';
public $A_CMP_USS_FACST = 'Фильтр "Активен"';
public $A_CMP_USS_PHONE = 'Телефон';
public $A_CMP_USS_FAX = 'Факс';
public $A_CMP_USS_NOEXTRA = 'Дополнительные Поля не выбраны или не опубликованы';
public $A_CMP_USS_VERTICAL = 'Вертикально';
public $A_CMP_USS_HORIZONT = 'Горизонтально';
public $A_CMP_USS_CHECKED = '';
public $A_CMP_USS_1OPTVLEAST = 'По крайней мере один параметр должен быть выбран';
public $A_CMP_USS_1OPTLEAST = 'Необходимо выбрать хотя бы один вариант';
public $A_CMP_USS_EXTRASAVED = 'Дополнительные поля успешно сохранены';
public $A_CMP_USS_CHACONDET = 'изменить настройки контакта';
public $A_CMP_USS_REQUIRED = 'Обязательно';
public $A_CMP_USS_REGISTR = 'Регистрация';
public $A_CMP_USS_PROFILE = 'Профиль';
public $A_CMP_USS_RONLY = 'Только для чтения';
public $A_CMP_USS_HIDDEN = 'Скрыто';
public $A_CMP_USS_SHOWREG = 'Показывать в регистрации';
public $A_CMP_USS_SHOWPROF = 'Показывать в профиле';
public $A_CMP_USS_OPTALIGN = 'Настройки выравнивания';
public $A_CMP_USS_PREVNOTE = 'Примечание: Необходимо сохранить изменения для предпросмотра.';
public $A_CMP_USS_OPTIONS = 'Настройки';
public $A_CMP_USS_OPTIONSFOR = 'Настройки для';
public $A_CMP_USS_MUSTFNAME = 'Вы должны дать полю название';
public $A_CMP_USS_MAXLENINV = 'Неверная макс. длина поля';
public $A_CMP_USS_HIDMUSTVAL = 'У скрытых полей должно быть установлено значение!';
public $A_CMP_USS_DEFVAL = 'Значение';
public $A_CMP_USS_MAXLEN = 'Макс. длина';
public $A_CMP_USS_REQFLDSNO = 'Одно или несколько обязательных полей не заполнено!';
public $A_CMP_USS_HIDNOREQ = 'Скрытые поля не могут быть обязательны!';
public $A_CMP_USS_HIDNOPROF = 'Скрытые поля не могут быть отображены в профиле!';
public $A_CMP_USS_PREFLANG = 'Предпочтительный язык';
public $A_CMP_USS_AVATAR = 'Аватар';
public $A_CMP_USS_WEBSITE = 'Веб-сайт';
public $A_CMP_USS_AIM = 'AIM';
public $A_CMP_USS_YIM = 'YIM';
public $A_CMP_USS_MSN = 'MSN';
public $A_CMP_USS_ICQ = 'ICQ';
public $A_CMP_USS_MOBILE = 'Сотовый телефон';
public $A_CMP_USS_BIRTHDATE = 'Дата рождения';
public $A_CMP_USS_GENDER = 'Пол';
public $A_CMP_USS_LOCATION = 'Геогр. местоположение';
public $A_CMP_USS_OCCUPATION = 'Род занятий';
public $A_CMP_USS_SIGNATURE = 'Подпись';
public $A_CMP_USS_MALE = 'муж';
public $A_CMP_USS_FEMALE = 'жен';
public $A_CMP_USS_YEAR = 'Год';
public $A_CMP_USS_MONTH = 'Месяц';
public $A_CMP_USS_DAY = 'День';
public $A_CMP_USS_BOLDINDIC = 'Элементы, выделенные полужирным шрифтом, включены в пользовательских профилях.';
public $A_CMP_USS_ENDISSOFT = 'Вы можете включить/выключить элементы профиля, воспользовавшись SoftDisk.';

//2009.0
public $A_USERS_EXPDATE = 'Дата истечения срока действия';
public $A_USERS_ACCEXPIRED = 'Дата действия истекла';
public $A_USERS_ACCNACTIVE = 'Аккаунт активен';

}

?>