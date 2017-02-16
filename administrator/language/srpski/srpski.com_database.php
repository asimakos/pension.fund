<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ivan Trebješanin
* @translator URL: http://www.elxis-srbija.org
* @email: admin@elxis-srbija.org
* @description: Srpski language for component database
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_DB_TABNM = 'Име табеле';
public $A_CMP_DB_ACTIONS = 'Акције';
public $A_CMP_DB_TDESCR = 'Опис табеле';
public $A_CMP_DB_BROWSE = 'Преглед';
public $A_CMP_DB_STRUCTURE = 'Структура';
public $A_CMP_DB_INFO = 'Информације';
public $A_CMP_DB_DUMPDB = 'Копија базе';
public $A_CMP_DB_XDUMPDB = 'XML/SQL копија';
public $A_CMP_DB_BACTYPE = 'Тип бекапа';
public $A_CMP_DB_XML = 'XML';
public $A_CMP_DB_SQL = 'SQL';
public $A_CMP_DB_XCRBACK = 'Прављење XML бекапа';
public $A_CMP_DB_XFULL = 'Структура и подаци';
public $A_CMP_DB_XSTRUONL = 'Само структура';
public $A_CMP_DB_XSAVSERV = 'Чување на серверу';
public $A_CMP_DB_DOWNLD = 'Преузимање';
public $A_CMP_DB_XMLBACK = 'XML бекап';
public $A_CMP_DB_SCRBACK = 'Прављење SQL бекапа';
public $A_CMP_DB_SFULL = 'Структура и подаци';
public $A_CMP_DB_SDATAONL = 'Само подаци';
public $A_CMP_DB_SLOCTBL = 'Закључавање табела';
public $A_CMP_DB_SFSYNTX = 'Пуна синтакса';
public $A_CMP_DB_SDRTBL = 'Брисање табеле';
public $A_CMP_DB_STBLS = 'Табеле';
public $A_CMP_DB_ATBLS = 'Све';
public $A_CMP_DB_SELTBLS = 'Изабране';
public $A_CMP_DB_SQLBACK = 'SQL Бекап';
public $A_CMP_DB_TDESC = 'Опис табеле';
public $A_CMP_DB_CLNAME = 'Име колоне';
public $A_CMP_DB_CLTYPE = 'Тип колоне';
public $A_CMP_DB_ADOTYPE = 'ADOdb тип';
public $A_CMP_DB_MAXLEN = 'Макс. дужина';
public $A_CMP_DB_BRTBL = 'Преглед табеле';
public $A_CMP_DB_BCKDB = 'Назад на Базу';
public $A_CMP_DB_DBTYPE = 'Тип базе';
public $A_CMP_DB_DBDESCR = 'Опис базе';
public $A_CMP_DB_DBVER = 'Верзија базе';
public $A_CMP_DB_DBHOST = 'Домаћин базе';
public $A_CMP_DB_DBNAME = 'Име базе';
public $A_CMP_DB_DBUSER = 'Корисник';
public $A_CMP_DB_DBERRF = 'Пријава грешке FN';
public $A_CMP_DB_DBDBG = 'Дебаговање';
public $A_CMP_DB_TBLSTR = 'Структура табеле';
public $A_CMP_DB_DBBACK = 'Бекап базе';
public $A_CMP_DB_NOEXISTS = 'Не постоји бекап';
public $A_CMP_DB_FOOTER= "<u>Белешка</u>: Клинките десним тастером на име фајла, а затим 'Save Target as' да бисте га преузели. <strong>Упозорење</strong>: Фајлови су у UTF-8 формату.";
public $A_CMP_DB_DBMONIT = 'Надзор базе';
public $A_CMP_DB_TBLNOT = 'Табела не постоји!';
public $A_CMP_DB_BACKSUCC = 'Успешно је креиран бекап базе';
public $A_CMP_DB_NOTSUPPO = 'SQL копија није подржана за';
public $A_CMP_DB_NOTBLSEL = 'Није изабрана табела!';
public $A_CMP_DB_NOTDWNL = 'Није могуће креирати/преузети SQL копију';
public $A_CMP_DB_NOTCRSV = 'Није могуће креирати/сачувати SQL копију';
public $A_CMP_DB_DUMPSUCC = 'SQL копија ја успешно направљена';
public $A_CMP_DB_DTUNKN = 'Непознат'; // Translate as: Unknown Date
public $A_CMP_DB_TXMLSCHEM = 'XML Schema';
public $A_CMP_DB_TSQL = 'SQL';
public $A_CMP_DB_TUNKN = 'Непознат'; // Translate as: Unknown Type
public $A_CMP_DB_UNKOWN = 'Непозната'; // Translate as: Unknown Size
public $A_CMP_DB_NOFSELDEL = 'Ниј изабран фајл за брисање!';
public $A_CMP_DB_FSDELETED = 'фајлова је успешно обрисано';
public $A_CMP_DB_FDELETED = 'Фајл је успешно обрисан';
public $A_CMP_DB_TLMANBACK = 'Руковање бекапима';
public $A_CMP_DB_TLDELSLBCK = 'Брисање изабраног бекапа';
public $A_CMP_DB_TLNEWFXML = 'Нови пуни XML бекап';
public $A_CMP_DB_TLNEWFSQL = 'Нови пуни SQL бекап';
public $A_CMP_DB_MAINTEN = 'Одржавање';
public $A_CMP_DB_MAINTEND = 'Одржавање базе';
public $A_CMP_DB_OPTIM = 'Оптимизација';
public $A_CMP_DB_REPAIR = 'Поправка';
public $A_CMP_DB_TBLOPTED = 'табела је оптимизовано';
public $A_CMP_DB_FRUOPTINCP = 'Честа употреба <strong>оптимизације</strong>, побољшава перформансе базе.';
public $A_CMP_DB_RRERRDBTAB = '<strong>Поправка</strong>, отклања постојеће грешке у табелама базе.';
public $A_CMP_DB_FAVMYSQL = 'Ове могућности су доступне само за MySQL базе!';
public $A_CMP_DB_TBLREPED = 'табела је поправљено';
public $A_CMP_DB_SIZE = 'Величина';

}

?>
