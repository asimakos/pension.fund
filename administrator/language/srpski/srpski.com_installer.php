<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ivan Trebješanin
* @translator URL: http://www.elxis-srbija.org
* @email: admin@elxis-srbija.org
* @description: Srpski language for component installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_INS_SDIR = 'Изабор директоријума';
public $A_CMP_INS_UPF = 'Додавање пакета';
public $A_CMP_INS_PF = 'Пакет';
public $A_CMP_INS_UFI = "Додавање пакета и инсталација";
public $A_CMP_INS_FDIR = 'Инсталација из директоријума';
public $A_CMP_INS_IDIR = 'Директоријум инсталације';
public $A_CMP_INS_DOIN = 'Инсталација';
public $A_CMP_INS_CONT = 'Наставак...';
public $A_CMP_INS_NF = 'Није пронађен инсталатор за следећи елемент ';
public $A_CMP_INS_NA = 'Није доступан инсталатор за следећи елемент';
public $A_CMP_INS_EFU = 'Инсталатор не може да настави јер је додавање онемогућено. Употребите метод инсталације из директоријума.';
public $A_CMP_INS_ERTL = 'Инсталатор – грешка';
public $A_CMP_INS_ERZL = 'Инсталатор не може да настави јер није инсталиран zlib';
public $A_CMP_INS_ERNF = 'Није изабран фајл';
public $A_CMP_INS_ERUM = 'Додавање новог модула – грешка';
public $A_CMP_INS_UPTL = 'Додавање ';
public $A_CMP_INS_UPE1 = ' - Додавање није успело';
public $A_CMP_INS_UPE2 = ' - Грешка при додавању';
public $A_CMP_INS_SUCC = 'Успешно';
public $A_CMP_INS_ER = 'Грешка';
public $A_CMP_INS_ERFL = 'Неуспешно';
public $A_CMP_INS_UPNW = 'Додавање новог ';
public $A_CMP_INS_FP = 'Неуспела измена дозвола за додати фајл.';
public $A_CMP_INS_FM = 'Неуспешно копирање додатог фајла у <code>/media</code> директоријум.';
public $A_CMP_INS_FW = 'Додавање неуспешно, јер <code>/media</code> директоријум није откључан.';
public $A_CMP_INS_FE = 'Неуспешно додавање, јер <code>/media</code> директоријум не постоји.';
public $A_CMP_INST_ERUNR = 'Непоправљива грешка';
public $A_CMP_INST_EREXT = 'Грешка при отпакивању';
public $A_CMP_INST_ERMXM = '<strong>ГРЕШКА:</strong> Не могу да пронађем Elxis XML инсталациони фајл у пакету';
public $A_CMP_INST_ERXML = '<strong>ГРЕШКА:</strong> Не могу да пронађем XML инсталациони фајл у пакету';
public $A_CMP_INST_ERNFN = 'Није дефинисано име фајла';
public $A_CMP_INST_ERVLD = 'није исправан Elxis инсталациони фајл';
public $A_CMP_INST_ERINC = 'Класа не може да позове метод инсталације';
public $A_CMP_INST_ERUIC = 'Класа не може да позове метод деинсталације';
public $A_CMP_INST_ERIFN = 'Инсталациони фајл није пронађен';
public $A_CMP_INST_ERSXM = 'XML инсталациони фајл није за';
public $A_CMP_INST_ERCDR = 'Не могу да креирам директоријум';
public $A_CMP_INST_FNOTE = 'не постоји!';
public $A_CMP_INST_TAFC = 'Већ постоји фајл под именом';
public $A_CMP_INST_AYIT = '- Да ли покушавате да инсталирате исти CMT два пута?';
public $A_CMP_INST_FCPF = 'Не могу да копирам фајл';
public $A_CMP_INST_CPTO = 'у';
public $A_CMP_INST_UNINSTALL = 'Деинсталација';
public $A_CMP_INST_CUDIR = 'Друга компонента већ користи директоријум';
public $A_CMP_INST_SQLER = 'SQL грешка';
public $A_CMP_INST_CCPHP = 'Не могу да копирам PHP инсталациони фајл.';
public $A_CMP_INST_CCUNPHP = 'Не могу да копирам PHP деинсталациони фајл.';
public $A_CMP_INST_UNERR = 'Деинсталација - грешка';
public $A_CMP_INST_THCOM = 'Компонента';
public $A_CMP_INST_ISCOR = 'је основна компонента, и не може бити деинсталирана.<br />Можете је одјавити уколико је не користите';
public $A_CMP_INST_XMLINV = 'XML фајл је неисправан';
public $A_CMP_INST_OFEMP = 'Поље опције је празно, не могу да уклоним фајлове';
public $A_CMP_INST_INCOM = 'Инсталиране компоненте';
public $A_CMP_INST_CURRE = 'Тренутно инсталирано';
public $A_CMP_INST_MENL = 'Линк компоненте на менију';
public $A_CMP_INST_AUURL = 'URL аутора';
public $A_CMP_INST_NCOMP = 'Нису инсталиране посебне компоненте';
public $A_CMP_INST_INSCO = 'Инсталација нове компоненте';
public $A_CMP_INST_DELE = 'Брисање';
public $A_CMP_INST_LIDE = 'Језички id је празан, не могу да уклоним фајлове';
public $A_CMP_INST_ALL = 'Сви';
public $A_CMP_INST_BKLM = 'Назад на менаџер језика';
public $A_CMP_INST_NWLA = 'Инсталација новог језика';
public $A_CMP_INST_NFMM = 'Ниједан фајл није означен као бот';
public $A_CMP_INST_MAMB = 'бот';
public $A_CMP_INST_AXST = 'већ постоји!';
public $A_CMP_INST_IOID = 'Погрешан id објекта';
public $A_CMP_INST_FFEM = 'Директоријум је празан, не могу да уклоним фајлове';
public $A_CMP_INST_DXML = 'Брисање XML фајла';
public $A_CMP_INST_ICMO = 'је део основе система, и не може бити деинсталирана.<br />Можете га одјавити уколико га не користите';
public $A_CMP_INST_IMBT = 'Инсталирани ботови';
public $A_CMP_INST_OMBT = 'Приказани су само ботови који могу бити деинсталирани - неки основни ботови не могу се деинсталирати.';
public $A_CMP_INST_MBT = 'Бот';
public $A_CMP_INST_MTYP = 'Тип';
public $A_CMP_INST_NMBT = 'Нису инсталирани посебни ботови.';
public $A_CMP_INST_INMT = 'Инсталација новог бота';
public $A_CMP_INST_UCTP = 'Непознат тип клијента';
public $A_CMP_INST_NFMD = 'Ниједан фајл није означен као модул';
public $A_CMP_INST_MODULE = 'Модул';
public $A_CMP_INST_ICMDL = 'је основни модул, и не може бити деинсталиран.<br />Можете га одјавити уколико га не користите';
public $A_CMP_INST_IMDL = 'Инсталирани модули';
public $A_CMP_INST_OMDL = 'Приказани су само модули који могу бити деинсталирани - неки основни модули не могу се деинсталирати.';
public $A_CMP_INST_MDLF = 'Фајл модула';
public $A_CMP_INST_NMDL = 'Нису инсталирани посебни модули';
public $A_CMP_INST_NWMDL = 'Инсталација новог модула';
public $A_CMP_INST_ALLC = 'Сви';
public $A_CMP_INST_STMDL = 'Модули сајта';
public $A_CMP_INST_ADMDL = 'Админ. модули';
public $A_CMP_INST_DDEX = 'Директоријум не постоји, не могу да уклоним фајлове';
public $A_CMP_INST_TIDE = 'id шаблона је празан, не могу да уклоним фајлове';
public $A_CMP_INST_TINS = 'Инсталација новог шаблона';
public $A_CMP_INST_BATP = 'Назад на шаблоне';
public $A_CMP_INST_INSBR = 'Инсталација новог моста';
public $A_CMP_INST_BABR = 'Назад на мостове';
public $A_CMP_INST_ΒIDE = 'id моста је празан, не могу да уклоним фајлове';
public $A_INST_INCOM = 'Откривена је могућа некомпатибилност између верзије Elxis-а коју користите и инсталиране екстензије. 
Без обзира на ово, софтвер ће можда радити како треба. Ово је само обавештење.';
public $A_INST_INCOMJOO = 'Инсталациони пакет је за Joomla CMS!';
public $A_INST_INCOMMAM = 'Инсталациони пакет је за Mambo CMS!';
public $A_INST_OLDER = 'Инсталациони пакет је за претходну Elxis верзију (%s), а не за Вашу (%s)';
public $A_INST_NEWER = 'Инсталациони пакет је за новију Elxis верзију (%s), а не за Вашу (%s)';

//2009.0
public $A_INST_DOINEDC = 'Преузимање и инсталација са Elxis Downloads Center-а';
public $A_INST_FETCHAVEXTS = 'Листа најновијих екстензија';
public $A_INST_MORE = 'Више';
public $A_INST_LESS = 'Мање';
public $A_INST_SIZE = 'Величина';
public $A_INST_DOWNLOAD = 'Преузимање';
public $A_INST_DOWNLOADS = 'Преузимања';
public $A_INST_DOWNINST = 'Преузимање и инсталација';
public $A_INST_LICENSE = 'Лиценца';
public $A_INST_COMPAT = 'Компатибилност';
public $A_INST_DATESUB = 'Датум постављања';
public $A_INST_SUREINST = 'Дали сте сигурни да желите да инсталирате %s ?'; //translators help: filled in be extension title
//2009.2
public $A_INST_UPTODATE = 'Актуелно';
public $A_INST_OUTDATED = 'Застарело';
public $A_INST_INSTVERS = 'Инсталирана верзија';
public $A_INST_UNLOAD = 'Искључивање';
public $A_INST_EDCUPDESC = 'Листа инсталираних екстензија и њихов статус.<br />
	Информација је добијена уживо путем <a href="http://www.elxis-downloads.com/" title="EDC" target="_blank">Elxis Downloads Center</a>.<br />
	Како би провера верзије била успешна Ваш сајт мора да се повеже са <strong>EDC</strong> удаљеним сервером.';
public $A_INST_EDCUPNOR = "Провера верзије није добила одговор.<br />
	Највероватније не постоји %s инсталирано."; //translators help: filled in be extension type (i.e. module)
}

?>