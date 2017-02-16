<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: Ivan Trebješanin
* @link: http://www.elxis-srbija.org
* @email: admin@elxis-srbija.org
* @description: Srpski Language for XML files
* @note: All values used in admin XML files start with 'AX_'
* @note 2008: values for custom language strings defined as php contants start with 'CX_' (not in this file!)
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* 
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
* 
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


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

protected $AX_MENUIMGL = 'Слика менија';
protected $AX_MENUIMGD = 'Мала слика која ће бити смештена на левој или десној страни Вашег менија. Слике се морају налазити у images/stories/ директоријуму.';
protected $AX_MENUIMGONLYL = 'Употреба само слике менија';
protected $AX_MENUIMGONLYD = 'Ако изаберате  <strong>Да</strong> тада ће ставка менија бити представљена САМО одређеном сликом.<br /><br />Ако изаберете <strong>Не</strong> ставка менија ће бити представљена и сликом и текстом.';
protected $AX_MENUIMG2D = 'Мала слика која ће бити смештена на левој или десној страни Вашег менија. Слике се морају налазити у /images директоријуму.';
protected $AX_PAGCLASUFL = 'Суфикс странице';
protected $AX_PAGCLASUFD = 'Суфикс ће бити додат у css класе странице, што омогућава појединачно стилизовање странице.';
protected $AX_TEXTPAGECL = 'Суфикс чланка';
protected $AX_TEXTPAGECLD = 'Суфикс ће бити додат у css класе чланка, што омогућава појединачно стилизовање ставки садржаја.';
protected $AX_BACKBUTL = 'Дугме назад';
protected $AX_BACKBUTD = 'Приказ/Скривање дугмета назад, које корисника враћа на претходну страницу.';
protected $AX_USEGLB = 'Опште подешавање';
protected $AX_HIDE = 'Скривање';
protected $AX_SHOW = 'Приказ';
protected $AX_AUTO = 'Аутоматски';
protected $AX_PAGTITLSL = 'Приказ наслова';
protected $AX_PAGTITLSD = 'Приказ/Скривање наслова странице.';
protected $AX_PAGTITLL = 'Наслов странице';
protected $AX_PAGTITLD = 'Текст приказан на врху странице. Уколико је празно, биће употребљен текст ставке менија.';
protected $AX_PAGTITL2D = 'Текст приказан на врху странице.';
protected $AX_LEFT = 'Лево';
protected $AX_RIGHT = 'десно';
protected $AX_PRNTICOL = 'Икона штампе';
protected $AX_PRNTICOD = 'Приказ/Скривање иконе штампе - само за ову страницу.';
protected $AX_YES = 'Да';
protected $AX_NO = 'Не';
protected $AX_SECNML = 'Име секције';
protected $AX_SECNMD = 'Приказ/Скривање секције којој садржај припада.';
protected $AX_SECNMLL = 'Линковано име секције';
protected $AX_SECNMLD = 'Име секције ће представљати линк ка секцији.';
protected $AX_CATNML = 'Име категорије';
protected $AX_CATNMD = 'Приказ/Скривање категорије којој садржај припада.';
protected $AX_CATNMLL = 'Линковано име категорије';
protected $AX_CATNMLD = 'Име категорије ће представљати линк ка категорији.';
protected $AX_LNKTTLL = 'Линковани наслови';
protected $AX_LNKTTLD = 'Наслови ставки ће представљати линкове.';
protected $AX_ITMRATL = 'Оцењивање садржаја';
protected $AX_ITMRATD = 'Приказ/Скривање оцене садржаја - само за ову страницу.';
protected $AX_AUTNML = 'Имена аутора';
protected $AX_AUTNMD = 'Приказ/Скривање имена аутора - само за ову страницу.';
protected $AX_CTDL = 'Датум настанка';
protected $AX_CTDD = 'Приказ/Скривање датума настанка - само за ову страницу.';
protected $AX_MTDL = 'Датум и време задње измене';
protected $AX_MTDD = 'Приказ/Скривање датум задње измене - само за ову страницу.';
protected $AX_PDFICL = 'PDF икона';
protected $AX_PDFICD = 'Приказ/Скривање PDF иконе - само за ову страницу.';
protected $AX_PRICL = 'Икона штампе';
protected $AX_PRICD = 'Приказ/Скривање дугмета штампе - само за ову страницу.';
protected $AX_EMICL = 'Икона е-поште';
protected $AX_EMICD = 'Приказ/Скривање иконе е-поште - само за ову страницу.';
protected $AX_FTITLE = 'Наслов';
protected $AX_FAUTH = 'Аутор';
protected $AX_FHITS = 'Прегледи';
protected $AX_DESCRL = 'Опис';
protected $AX_DESCRD = 'Приказ/Скривање описа.';
protected $AX_DESCRTXL = 'Описни текст';
protected $AX_DESCRTXD = 'Опис странице. Уколико је празно, биће коришћен _WEBLINKS_DESC из језичког фајла';
protected $AX_IMAGEL = 'Слика';
protected $AX_IMGFRPD = 'Слика за страницу, мора се налазити у /images/stories директоријуму. Предефинсано је да се учита слика web_links.jpg. -Без слике- значи да слика неће бити учитана.';
protected $AX_IMGALL = 'Равнање слике';
protected $AX_IMGALD = 'Равнање слике.';
protected $AX_TBHEADL = 'Заглавља табела';
protected $AX_TBHEADD = 'Приказ/Скривање заглавља табела.';
protected $AX_POSCOLL = 'Колона позиције';
protected $AX_POSCOLD = 'Приказ/Скривање колоне позиције.';
protected $AX_EMAILCOLL = 'Колона е-поште';
protected $AX_EMAILCOLD = 'Приказ/Скривање колоне е-поште.';
protected $AX_TELCOLL = 'Колона телефона';
protected $AX_TELCOLD = 'Приказ/Скривање колоне телефона.';
protected $AX_FAXCOLL = 'Колона факса';
protected $AX_FAXCOLD = 'Приказ/Скривање колоне факса.';
protected $AX_LEADINGL = '# носећих чланака';
protected $AX_LEADINGD = 'Број ставки које ће бити приказане као носеће (пуном ширином). 0 значи да нијеадан чланак неће бити означен као носећи.';
protected $AX_INTROL = '# увода';
protected $AX_INTROD = 'Број ставки чији ће уводни тескт бити приказан.';
protected $AX_COLSL = 'Колоне';
protected $AX_COLSD = 'Број колона које ће бити коришћене за приказ уводних текстова.';
protected $AX_LNKSL = '# линкова';
protected $AX_LNKSD = 'Број ставки које ће бити приказане као линкови.';
protected $AX_CATORL = 'Поредак категорије';
protected $AX_CATORD = 'Поредак ставки према категорији.';
protected $AX_OCAT01 = 'Не, само примарни поредак';
protected $AX_OCAT02 = 'Узлазно по наслову';
protected $AX_OCAT03 = 'Силазно по наслову';
protected $AX_OCAT04 = 'Поредак';
protected $AX_PRMORL = 'Примарни поредак';
protected $AX_PRMORD = 'Поредак приказаних ставки.';
protected $AX_OPRM01 = 'Предефинисано';
protected $AX_OPRM02 = 'Поредак на Насловној';
protected $AX_OPRM03 = 'Прво најстарије';
protected $AX_OPRM04 = 'Прво најновије';
protected $AX_OPRM07 = 'По аутору узл.';
protected $AX_OPRM08 = 'По аутору сил.';
protected $AX_OPRM09 = 'Највише читања';
protected $AX_OPRM10 = 'Најмање читања';
protected $AX_PAGL = 'Пагинација';
protected $AX_PAGD = 'Приказ/Скривање пагинације.';
protected $AX_PAGRL = 'Резултати пагинације';
protected $AX_PAGRD = 'Приказ/Скривање резултата пагинације ( нпр. 1-4 од 4 ).';
protected $AX_MOSIL = 'MOSImages';
protected $AX_MOSID = 'Приказ {mosimages}.';
protected $AX_ITMTL = 'Наслови ставки';
protected $AX_ITMTD = 'Приказ/Скривање наслова ставки.';
protected $AX_REMRL = 'Опширније...';
protected $AX_REMRD = 'Приказ/Скривање опширније линка.';
protected $AX_OTHCATL = 'Остале категорије';
protected $AX_OTHCATD = 'Приказ/Скривање листе осталих категорија приликом прегледа категорије.';
protected $AX_TDISTPD = 'Текст приказан на врху странице.';
protected $AX_ORDBYL = 'Поредак';
protected $AX_ORDBYD = 'Овим ћете изменити поредак ставки.';
protected $AX_MCS_DESCL = 'Опис';
protected $AX_SHCDESD = 'Приказ/Скривање описа категорије.';
protected $AX_DESCIL = 'Описна слика';
protected $AX_MUDATFL = 'Формат датума';
protected $AX_MUDATFD = "Формат приказаног датума путем PHP strftime Command Format - уколико је празно, користиће формат из вашег језичког фајла.";
protected $AX_MUDATCL = 'КОлона датума';
protected $AX_MUDATCD = 'Приказ/Скривање колоне датума.';
protected $AX_MUAUTCL = 'Колона аутора';
protected $AX_MUAUTCD = 'Приказ/Скривање колоне аутора.';
protected $AX_MUHITCL = 'Колона броја прегледа';
protected $AX_MUHITCD = 'Приказ/Скривање колоне прегледа.';
protected $AX_MUNAVBL = 'Навигациона трака';
protected $AX_MUNAVBD = 'Приказ/Скривање навигационе траке.';
protected $AX_MUORDSL = 'Избор поретка';
protected $AX_MUORDSD = 'Приказ/Скривање избора поретка.';
protected $AX_MUDSPSL = 'Избор приказа';
protected $AX_MUDSPSD = 'Приказ/Скривање избора поретка.';
protected $AX_MUDSPNL = 'Број приказаног';
protected $AX_MUDSPND = 'Број ставки које ће предефинисано бити приказане.';
protected $AX_MUFLTL = 'Филтер';
protected $AX_MUFLTD = 'Приказ/Скривање могућности филтрирања.';
protected $AX_MUFLTFL = 'Филтрирано поље';
protected $AX_MUFLTFD = 'Поље на које ће филтер бити примењен.';
protected $AX_MUOCATL = 'Остале категорије';
protected $AX_MUOCATD = 'Приказ/Скривање листе осталих категорија.';
protected $AX_MUECATL = 'Празне категорије';
protected $AX_MUECATD = 'Приказ/Скривање празних (без ставки) категорија.';
protected $AX_CATDSCL = 'Опис категорије';
protected $AX_CATDSBLND = 'Приказ/Скривање описа категорије, приказаног испод имена категорије.';
protected $AX_NAMCOLL = 'Колона имена';
protected $AX_LINKDSCL = 'Опис линкова';
protected $AX_LINKDSCD = 'Приказ/Скривање описног текста за линкове.';
//com_contact/contact.xml
protected $AX_CCT_CDESC = 'Ова компонента излистава информације о контактима.';
protected $AX_CCT_CATLISTSL = 'Листа категорија – секција';
protected $AX_CCT_CATLISTSD = 'Приказ/Скривање листе категорија при прегледу у виду листе.';
protected $AX_CCT_CATLISTCL = 'Листа категорија – категорија';
protected $AX_CCT_CATLISTCD = 'Приказ/Скривање листе категорија при прегледу у виду табеле.';
protected $AX_CCT_CATDSCD = 'Приказ/Скривање описа за листу осталих категорија.';
protected $AX_CCT_NOCATITL = '# ставки категорије';
protected $AX_CCT_NOCATITD = 'Приказ/Скривање броја ставки у свакој категорији.';
//com_contact/contact_items.xml
protected $AX_CIT_CDESC = 'Параметри за појединачне ставке контаката.';
protected $AX_CIT_NAMEL = 'Име';
protected $AX_CIT_NAMED = 'Приказ/Скривање информација.';
protected $AX_CIT_POSITL = 'Позиција';
protected $AX_CIT_POSITD = 'Приказ/Скривање позиције.';
protected $AX_CIT_EMAILL = 'е-пошта';
protected $AX_CIT_EMAILD = 'Приказ/Скривање информација о е-пошти. Уколико поставите да се приказује, адреса ће бити заштићена од спамбота путем javascript-а.';
protected $AX_CIT_SADDREL = 'Адреса';
protected $AX_CIT_SADDRED = 'Приказ/Скривање адресе.';
protected $AX_CIT_TOWNL = 'Град/Насеље';
protected $AX_CIT_TOWND = 'Приказ/Скривање података о граду/насељу.';
protected $AX_CIT_STATEL = 'Држава';
protected $AX_CIT_STATED = 'Приказ/Скривање државе.';
protected $AX_CIT_COUNTRL = 'Земља';
protected $AX_CIT_COUNTRD = 'Приказ/Скривање података о земљи.';
protected $AX_CIT_ZIPL = 'Поштански број';
protected $AX_CIT_ZIPD = 'Приказ/Скривање поштанског броја.';
protected $AX_CIT_TELL = 'Телефон';
protected $AX_CIT_TELD = 'Приказ/Скривање броја телефона.';
protected $AX_CIT_FAXL = 'Факс';
protected $AX_CIT_FAXD = 'Приказ/Скривање броја факса.';
protected $AX_CIT_MISCL = 'Додатне информације';
protected $AX_CIT_MISCD = 'Приказ/Скривање додатних информација.';
protected $AX_CIT_VCARDL = 'В-картице';
protected $AX_CIT_VCARDD = 'Приказ/Скривање В-картице.';
protected $AX_CIT_CIMGL = 'Слика';
protected $AX_CIT_CIMGD = 'Приказ/Скривање слике.';
protected $AX_CIT_DEMAILL = 'Опис е-поште';
protected $AX_CIT_DEMAILD = 'Приказ/Скривање доњег описа.';
protected $AX_CIT_DTXTL = 'Описни текст';
protected $AX_CIT_DTXTD = 'Описни текст форме е-поште. Уколико је празно, биће употребљен _EMAIL_DESCRIPTION дефиниција из Вашег језичког фајла.';
protected $AX_CIT_EMFRML = 'Формулар е-поште';
protected $AX_CIT_EMFRMD = 'Приказ/Скривање форме е-поште.';
protected $AX_CIT_EMCPYL = 'Копија е-поруке';
protected $AX_CIT_EMCPYD = 'Приказ/Скривање опције слања копије поруке на сопствену е-адресу.';
protected $AX_CIT_DDL = 'Падајући мени';
protected $AX_CIT_DDD = 'Приказ/Скривање падајућег менија при прегледу контакта.';
protected $AX_CIT_ICONTXL = 'Иконе/Текст';
protected $AX_CIT_ICONTXD = 'Употреба икона, текста или ничега при приказу информација о контакту.';
protected $AX_CIT_ICONS = 'Иконе';
protected $AX_CIT_TEXT = 'Текст';
protected $AX_CIT_NONE = 'Ништа';
protected $AX_CIT_ADICONL = 'Икона адресе';
protected $AX_CIT_ADICOND = 'Икона за информације о адреси.';
protected $AX_CIT_EMICONL = 'Икона е-поште';
protected $AX_CIT_EMICOND = 'Икона за информације о е-пошти.';
protected $AX_CIT_TLICONL = 'Икона телефона';
protected $AX_CIT_TLICOND = 'Икона за број телефона.';
protected $AX_CIT_FXICONL = 'Факс икона';
protected $AX_CIT_FXICOND = 'Икона за број факса.';
protected $AX_CIT_MCICONL = 'Икона додатно';
protected $AX_CIT_MCICOND = 'Икона за додатне информације.';
protected $AX_CCT_NAMEL = 'Име';
protected $AX_CCT_NAMED = 'Приказ/Скривање имена.';
protected $AX_CCT_POSITL = 'Позиција';
protected $AX_CCT_POSITD = 'Приказ/Скривање позиције.';
protected $AX_CCT_EMAILL = 'е-пошта';
protected $AX_CCT_EMAILD = 'Приказ/Скривање адресе е-поште. Уколико поставите да се приказује, адреса ће бити заштићена од спамбота путем javascript-а.';
protected $AX_CCT_SADDREL = 'Адреса';
protected $AX_CCT_SADDRED = 'Приказ/Скривање адресе.';
protected $AX_CCT_TOWNL = 'Град/Насеље';
protected $AX_CCT_TOWND = 'Приказ/Скривање података о граду/насељу.';
protected $AX_CCT_STATEL = 'Држава';
protected $AX_CCT_STATED = 'Приказ/Скривање државе.';
protected $AX_CCT_COUNTRL = 'Земља';
protected $AX_CCT_COUNTRD = 'Приказ/Скривање података о земљи.';
protected $AX_CCT_ZIPL = 'Поштански број';
protected $AX_CCT_ZIPD = 'Приказ/Скривање поштанског броја.';
protected $AX_CCT_TELL = 'Телефон';
protected $AX_CCT_TELD = 'Приказ/Скривање броја телефона.';
protected $AX_CCT_FAXL = 'Факс';
protected $AX_CCT_FAXD = 'Приказ/Скривање броја факса.';
protected $AX_CCT_MISCL = 'Додатне информације';
protected $AX_CCT_MISCD = 'Приказ/Скривање додатних информација.';
protected $AX_CCT_VCARDL = 'В-картица';
protected $AX_CCT_VCARDD = 'Приказ/Скривање В-картице.';
protected $AX_CCT_CIMGL = 'Слика';
protected $AX_CCT_CIMGD = 'Приказ/Скривање слике.';
protected $AX_CCT_DEMAILL = 'Опис е-поште';
protected $AX_CCT_DEMAILD = 'Приказ/Скривање доњег описа.';
protected $AX_CCT_DTXTL = 'Описни текст';
protected $AX_CCT_DTXTD = 'Описни текст форме е-поште. Уколико је празно, биће употребљена _EMAIL_DESCRIPTION дефиниција из Вашег језичког фајла.';
protected $AX_CCT_EMFRML = 'Форма е-поште';
protected $AX_CCT_EMFRMD = 'Приказ/Скривање примаоца.';
protected $AX_CCT_EMCPYL = 'Коија е-поруке';
protected $AX_CCT_EMCPYD = 'Приказ/Скривање опције слања копије поруке пошиљаоцу.';
protected $AX_CCT_DDL = 'Падајући мени';
protected $AX_CCT_DDD = 'Приказ/Скривање падајућег менија при прегледу контакта.';
protected $AX_CCT_ICONTXL = 'Иконе/Текст';
protected $AX_CCT_ICONTXD = 'Употреба икона, текста или ничега при приказу информација о контакту.';
protected $AX_CCT_ICONS = 'Иконе';
protected $AX_CCT_TEXT = 'Текст';
protected $AX_CCT_NONE = 'Ништа';
protected $AX_CCT_ADICONL = 'Икона адресе';
protected $AX_CCT_ADICOND = 'Икона за информације о адреси.';
protected $AX_CCT_EMICONL = 'Икона е-поште';
protected $AX_CCT_EMICOND = 'Икона за информације о е-пошти.';
protected $AX_CCT_TLICONL = 'Икона телефона';
protected $AX_CCT_TLICOND = 'Икона за број телефона.';
protected $AX_CCT_FXICONL = 'Факс икона';
protected $AX_CCT_FXICOND = 'Икона за број факса.';
protected $AX_CCT_MCICONL = 'Икона додатно';
protected $AX_CCT_MCICOND = 'Икона за додатне информације.';
//com_content/content.xml
protected $AX_CNT_CDESC = 'Приказује једну страницу садржаја.';
protected $AX_CNT_INTEXTL = 'Уводни текст';
protected $AX_CNT_INTEXTD = 'Приказ/Скривање уводног текста.';
protected $AX_CNT_KEYRL = 'Кључна референца';
protected $AX_CNT_KEYRD = 'Кључна реч која се може повезати са текстом (као индекс).';
//com_frontpage/frontpage.xml
protected $AX_FP_CDESC = 'Ова компонента приказује све ставке садржаја означене за приказ на насловној страни.';
//com_login/login.xml
protected $AX_LG_CDESC = 'Индивидуална подешавања ставки контакта.';
protected $AX_LG_LPTL = 'Наслов пријавне странице';
protected $AX_LG_LPTD = 'Текст приказан на врху стране. Уколико је празно, биће употребљено име са менија.';
protected $AX_LG_LRURLL = 'URL редирекције пријаве';
protected $AX_LG_LRURLD = 'Страница на коју ћете бити упућени након пријаве. Уколико је празно, биће учитана Насловна.';
protected $AX_LG_LJSML = 'Пријавна JS порука';
protected $AX_LG_LJSMD = 'Приказ/Скривање javascript поруке, као индикатора успешне пријаве.';
protected $AX_LG_LDESCL = 'Опис пријаве';
protected $AX_LG_LDESCD = 'Приказ/Скривање доњег описа пријаве.';
protected $AX_LG_LDESTL = 'Описни текст пријаве';
protected $AX_LG_LDESTD = 'Текст приказан на пријавној страници. Уколико је празно, _LOGIN_DESCRIPTION ће бити употребљен.';
protected $AX_LG_LIMGL = 'Слика пријаве';
protected $AX_LG_LIMGD = 'Слика за пријавну страницу.';
protected $AX_LG_LIMGAL = 'Равнање слике';
protected $AX_LG_LIMGAD = 'Равнање пријавне слике.';
protected $AX_LG_LOPTL = 'Нслов одјавне странице';
protected $AX_LG_LOPTD = 'Текст приказан на врху стране. Уколико је празно, биће употребљено име са менија.';
protected $AX_LG_LORURLL = 'URL редирекције одјаве';
protected $AX_LG_LORURLD = 'Страница на коју ћете бити упућени након одјаве. Уколико је празно, биће учитана Насловна.';
protected $AX_LG_LOJSML = 'Одјавна JS порука';
protected $AX_LG_LOJSMD = 'Приказ/Скривање javascript поруке, као индикатора успешне одјаве.';
protected $AX_LG_LODSCL = 'Опис одјаве';
protected $AX_LG_LODSCD = 'Приказ/Скривање доњег описа одјаве.';
protected $AX_LG_LODSTL = 'Описни текст одјаве';
protected $AX_LG_LODSTD = 'Текст приказан на одјавној страници. Уколико је празно, _LOGOUT_DESCRIPTION ће бити употребљен.';
protected $AX_LG_LOGOIL = 'Одјавна слика';
protected $AX_LG_LOGOID = 'Слика за одјавну страницу.';
protected $AX_LG_LOGOIAL = 'Равнање слике';
protected $AX_LG_LOGOIAD = 'Равнање одјавне слике.';
//com_massmail/massmail.xml
protected $AX_MM_CDESC = 'Ова компонента омогућава слање масовне поште одређеним корисничким групамма.';
//com_media/media.xml
protected $AX_ME_CDESC = 'Компонента за уређивање медијских фајлова сајта.';
//com_menumanager/menumanager.xml
protected $AX_MNU_CDESC = 'Компонента за уређивање менија.';
//com_menus/component_item_link/component_item_link.xml
protected $AX_MUCIL_CNAME = 'Линк - ставка компоненте';
protected $AX_MUCIL_CDESC = 'Прави линк до постојеће Elxis компоненте.';
//com_menus/components/components.xml
protected $AX_MUCOMP_CNAME = 'Компонента';
protected $AX_MUCOMP_CDESC = 'Приказује јавни интерфејс компоненте.';
//com_menus/contact_category_table/contact_category_table.xml
protected $AX_MUCCT_CNAME = 'Табела - категорија контаката';
protected $AX_MUCCT_CDESC = 'Приказује табелу ставки контаката у одређеној категорији.';
protected $AX_MUCCT_CATDL = 'Опис категорије';
protected $AX_MUCCT_CATDD = 'Приказ/Скривање описа листе осталих категорија.';
//com_menus/contact_item_link/contact_item_link.xml
protected $AX_MUCTIL_CNAME = 'Линк - Ставка контаката';
protected $AX_MUCTIL_CDESC = 'Прави линк до објављене ставке контаката';
//com_menus/content_archive_category/content_archive_category.xml
protected $AX_MUCAC_CNAME = 'Блог - садржај архива категорије';
protected $AX_MUCAC_CDESC = 'Приказу архивираних ставки одређене категорије.';
//com_menus/content_archive_section/content_archive_section.xml
protected $AX_MUCAS_CNAME = 'Блог - садржај архива секције';
protected $AX_MUCAS_CDESC = 'Приказ архивираних ставки одређене секције.';
//com_menus/content_blog_category/content_blog_category.xml
protected $AX_MUCBC_CNAME = 'Блог - садржај категорија';
protected $AX_MUCBC_CDESC = 'Приказ садржаја категорија у форми блога.';
//com_menus/content_blog_section/content_blog_section.xml
protected $AX_MUCBS_CNAME = 'Блог - садржај секција';
protected $AX_MUCBS_CDESC = 'Приказ садржаја секција у форми блога.';
protected $AX_MUCBS_SHSD = 'Приказ/Скривање описа секције.';
//com_menus/content_category/content_category.xml
protected $AX_MUCC_CNAME = 'Табела - садржај категорије';
protected $AX_MUCC_CDESC = 'Приказује тсбелу ставки садржаја у одређеној категорији.';
protected $AX_MUCC_SHLOCD = 'Приказ/Скривање листе осталих категорија.';
//com_menus/content_item_link/content_item_link.xml
protected $AX_MCIL_CNAME = 'Линк - ставка садржаја';
protected $AX_MCIL_CDESC = 'Прави линк до пуног приказа објављене ставке садржаја.';
//com_menus/content_section/content_section.xml
protected $AX_MCS_CNAME = 'Табела - садржај секције';
protected $AX_MCS_CDESC = 'Прави листу категорија садржаја у изабраној секцији.';
protected $AX_MCS_STL = 'Наслов секције';
protected $AX_MCS_STD = 'Приказ/Скривање наслова секције.';
protected $AX_MCS_SHCTID = 'Приказ/Скривање описне слике секције.';
//com_menus/content_typed/content_typed.xml
protected $AX_MLSC_CNAME = 'Линк - независна страница';
protected $AX_MLSC_CDESC = 'Прави линк до независне странице.';
//com_menus/newsfeed_category_table/newsfeed_category_table.xml
protected $AX_MNSFC_CNAME = 'Табела - категорија текућих вести';
protected $AX_MNSFC_CDESC = 'Приказује ставке текућих вести у изабраној категорији.';
protected $AX_MNSFC_SHNCD = 'Приказ/Скривање имена колоне.';
protected $AX_MNSFC_ACL = 'Колона чланака';
protected $AX_MNSFC_ACD = 'Приказ/Скривање колоне чланака.';
protected $AX_MNSFC_LCL = 'Колона линка';
protected $AX_MNSFC_LCD = 'Приказ/Скривање колоне линка.';
//com_menus/newsfeed_link/newsfeed_link.xml
protected $AX_MNSFL_CNAME = 'Линк - текуће вести';
protected $AX_MNSFL_CDESC = 'Прави линк до извора текућих вести.';
protected $AX_MNSFL_FDIML = 'Слика текућих вести';
protected $AX_MNSFL_FDIMD = 'Приказ/Скривање слике текућих вести.';
protected $AX_MNSFL_FDDSL = 'Опис извора';
protected $AX_MNSFL_FDDSD = 'Приказ/Скривање описа извора текућих вести.';
protected $AX_MNSFL_WDCL = 'Број речи';
protected $AX_MNSFL_WDCD = 'Ограничава број речи у описном тексту вести. 0 ће приказати цео текст.';
//com_menus/separator/separator.xml
protected $AX_MSEP_CNAME = 'Сепаратор';
protected $AX_MSEP_CDESC = 'Преви сепаратор менија.';
//com_menus/url/url.xml
protected $AX_MURL_CNAME = 'Линк - Url';
protected $AX_MURL_CDESC = 'Прави линк до URL-а.';
//com_menus/weblink_category_table/weblink_category_table.xml
protected $AX_MWLC_CNAME = 'Табела - Web линк категорија';
protected $AX_MWLC_CDESC = 'Приказ табеле линкова у одређеној Web линк категорији.';
//com_menus/wrapper/wrapper.xml
protected $AX_MWRP_CNAME = 'Омотач';
protected $AX_MWRP_CDESC = 'Прави IFrame који ће приказати екстерну страницу/сајт у Elxis-у.';
protected $AX_MWRP_SCRBL = 'Клизачи';
protected $AX_MWRP_SCRBD = 'Приказ/Скривање хоризонталних и вертикалних клизача.';
protected $AX_MWRP_WDTL = 'Ширина';
protected $AX_MWRP_WDTD = 'Ширина IFrame прозора, можете унети апсолутну вредост у пикселима, или релативну у %.';
protected $AX_MWRP_HEIL = 'Висина';
protected $AX_MWRP_HEID = 'Висина IFrame прозора.';
protected $AX_MWRP_AHL = 'Аутоматски';
protected $AX_MWRP_AHD = 'Висина ће аутоматски бити подешена на висину екстерне странице. Ово функционише само за странице са Вачег домена.';
protected $AX_MWRP_AADL = 'Аутоматска допуна';
protected $AX_MWRP_AADD = 'По дефиницији, префикс http:// ће бити додат уколико је http:// или https:// детектован у url-у унетог линка. Овде можете ову могућност укључити или искључити.';
//com_menus/system/system.xml
protected $AX_MSYS_CNAME = 'Системски линк';
protected $AX_MSYS_CDESC = 'Прави линк до системских опција';
//com_newsfeeds/newsfeeds.xml
protected $AX_NFE_CDESC = 'Ова компонента уређује RSS/RDF текуће вести.';
protected $AX_NFE_DPD = 'Опис странице';
protected $AX_NFE_SHFNCD = 'Приказ/Скривање колоне извора текућих вести.';
protected $AX_NFE_NOACL = 'Колона # чланака';
protected $AX_NFE_NOACD = 'Приказ/Скривање # чланака у извору.';
protected $AX_NFE_LCL = 'Колона линкова';
protected $AX_NFE_LCD = 'Приказ/Скривање колоне линка извора текућих вести.';
protected $AX_NFE_IDL = 'Опис ставке';
protected $AX_NFE_IDD = 'Приказ/Скривање описа или уводног текста ставке.';
//com_search/search.xml
protected $AX_SEAR_CDESC = 'Ова компонента уређује могућности претраге.';
//com_syndicate/syndicate.xml
protected $AX_SYN_CDESC = 'Ова компонета контролише подешавања синдикације.';
protected $AX_SYN_CACHL = 'Кеш';
protected $AX_SYN_CACHD = 'Кеширање фајлова текућих вести.';
protected $AX_SYN_CACHTL = 'Време кеширања';
protected $AX_SYN_CACHTD = 'Кеш ће бити освежен сваких x секунди.';
protected $AX_SYN_ITMSL = '# ставки';
protected $AX_SYN_ITMSD = 'Број ставки за синдикацију.';
protected $AX_SYN_ITMSDFLT = 'Elxis синдикација';
protected $AX_SYN_TITLE = 'Наслов синдикације';
protected $AX_SYN_DESCD = 'Опис синдикације.';
protected $AX_SYN_DESCDFLT = 'Elxis синдикација сајта';
protected $AX_SYN_IMGD = 'Слика која ће бити укључена у извор синдикације.';
protected $AX_SYN_IMGAL = 'Alt слике';
protected $AX_SYN_IMGAD = 'Alt текст слике.';
protected $AX_SYN_IMGADFLT = 'Powered by Elxis';
protected $AX_SYN_LMTL = 'Ограничење текста';
protected $AX_SYN_LMTD = 'Ограничава текст чланка на доњу вредност.';
protected $AX_SYN_TLENL = 'Дужина текста';
protected $AX_SYN_TLEND = 'Дужина речи текста чланка - 0 значи да текст неће бити прикатан.';
protected $AX_SYN_LBL = 'Live Bookmarks';
protected $AX_SYN_LBD = 'Активација подршке за Firefox Live Bookmarks функционалност.';
protected $AX_SYN_BFL = 'Bookmark фајл';
protected $AX_SYN_BFD = 'Посебно име фајла. Уколико је празно, предефисани сани фајл ће бити употребњен.';
protected $AX_SYN_ORDL = 'Поредак';
protected $AX_SYN_ORDD = 'Поредак по коме ће ставке бити приказане.';
protected $AX_SYN_MULTIL = 'Вишејезичке вести';
protected $AX_SYN_MULTILD = 'Уколико је укључено, Elxis ће креирати језички одређене вести.';
//com_trash/trash.xml
protected $AX_TRSH_CDESC = 'Ова компонента уређује функционалности корпе за отпатке.';
//com_typedcontent/typedcontent.xml
protected $AX_TDC_CDESC = 'Ово приказује појединачну ставку садржаја.';
//com_weblinks/weblinks.xml
protected $AX_WBL_CDESC = 'Ова компонента приказује листу Web линкова.';
protected $AX_WBL_LDL = 'Описи линкова';
protected $AX_WBL_LDD = 'Приказ/Скривање описног текста линкова.';
protected $AX_WBL_ICL = 'Икона';
protected $AX_WBL_ICD = 'Икона која ће бити коришћена са леве стране url-а линкова у табеларном приказу.';
protected $AX_WBL_SCSL = 'Слике';
protected $AX_WBL_SCSD = 'Приказ линковане слике сајта. Уколико је укључено, икона Web линкова неће бити приказана.';
//com_weblinks/weblinks_item.xml
protected $AX_WBLI_TD = 'Одредишни прозор у коме ће линк бити отворен.';
protected $AX_WBLI_OT01 = 'Исти прозор са навигацијом';
protected $AX_WBLI_OT02 = 'Нови прозор са навигацијом';
protected $AX_WBLI_OT03 = 'Нови прозор без навигације';
//ADMINISTRATOR MODULES
//administrator/modules/mod_latest.xml
protected $AX_AM_LN_DESC = 'Овај модул приказује најновије објављене ставке садржаја које су још актуелне (неке су можда истекле, иако су најновије). Ставке приказане кроз компоненту Насловне не налазе се на листи.'; 
//administrator/modules/mod_logged.xml
protected $AX_AM_LG_DESC = 'Овај модул приказује листу тренутно пријављених корисника.'; 
//administrator/modules/mod_popular.xml
protected $AX_AM_PI_DESC = 'Овај модул приказује листу популарних објављених ставки, које су још увек актуелне (неке су можда истекле, иако су популарне). Ставке приказане кроз компоненту Насловне не налазе се на листи.'; 
//administrator/modules/mod_stats.xml
protected $AX_AM_ST_DESC = 'Овај модул приказује статистике актуелних ставки (неке су можда истекле, иако су најновије). Ставке приказане кроз компоненту Насловне не налазе се на листи.'; 
//SITE MODULES
//General
protected $AX_SM_MCSL = 'Суфикс класе модула'; 
protected $AX_SM_MCSD = 'Суфикс који ће бити додат CSS класи модула (.moduletable), што омогућује индивидуално стилизовање модула.'; 
protected $AX_SM_MUCSL = 'Суфикс класе менија'; 
protected $AX_SM_MUCSD = 'Суфикс који ће бити додат CSS класи ставки менија.'; 
protected $AX_SM_ECL = 'Укључивање кеша'; 
protected $AX_SM_ECD = 'Укључивање, односно, искључивање кеша.'; 
protected $AX_SM_SMIL = 'Приказ икона менија'; 
protected $AX_SM_SMID = 'Приказ иконе менија за изабране ставке.'; 
protected $AX_SM_MIAL = 'Равнање иконе'; 
protected $AX_SM_MIAD = 'Равнање икона менија'; 
protected $AX_SM_MODL = 'Приказ модула'; 
protected $AX_SM_MODD = 'Омогућава контролу типа садржаја приказаног кроз модул.'; 
protected $AX_SM_OP01 = 'Само ставке садржаја'; 
protected $AX_SM_OP02 = 'Само независне странице'; 
protected $AX_SM_OP03 = 'Оба'; 
//modules/custom.xml
protected $AX_SM_CU_DESC = 'Кориснички модул.'; 
protected $AX_SM_CU_RSURL = 'RSS URL'; 
protected $AX_SM_CU_RSURD = 'Унесите URL RSS/RDF извора.'; 
protected $AX_SM_CU_FEDL = 'Опис извора текућих вести'; 
protected $AX_SM_CU_FEDD = 'Приказ описа извора текућих вести.'; 
protected $AX_SM_CU_FEIL = 'Слика извора'; 
protected $AX_SM_CU_FEDID = 'Приказује слику везану за цео извор.'; 
protected $AX_SM_CU_ITL = 'Ставки'; 
protected $AX_SM_CU_ITD = 'Унесите број RSS ставки за приказ.'; 
protected $AX_SM_CU_ITDL = 'Опис ставке'; 
protected $AX_SM_CU_ITDD = 'Приказ описног или уводног текста појединачних ставки.'; 
protected $AX_SM_CU_WCL = 'Број речи'; 
protected $AX_SM_CU_WCD = 'Омогућава ограничавање количине описног текста ставки. 0 ће приказати цео текст.'; 
//modules/mod_archive.xml
protected $AX_SM_AR_DESC = 'Модул приказује листу календарских месеци које садрже архивиране ставке. Након што измените статус ставке на \'архивирано\' ова листа ће бити аутоматски генерисана.'; 
protected $AX_SM_AR_CNTL = 'Број'; 
protected $AX_SM_AR_CNTD = 'Број ставки за приказ (предефинисано је 10).'; 
//modules/mod_banners.xml
protected $AX_SM_BN_DESC = 'Модул банера омогућава приказ банера на сајту кроз истоимену компоненту.'; 
protected $AX_SM_BN_CNTL = 'Клијент'; 
protected $AX_SM_BN_CNTD = "Односи се на id клијента банера. Унесите одвојено ','!"; 
protected $AX_SM_BN_NBSL = 'Број приказаних банера';
protected $AX_SM_BN_NBPRL = 'Број банера у низу';
protected $AX_SM_BN_NBPRD = 'Број банера у низу. Да бисте искључили, ставите на 0. За вертикални приказ, поставите на 1';
protected $AX_SM_BN_UNQBL = 'Јединствени банер';
protected $AX_SM_BN_UNQBD = 'Ниједан банер неће бити приказан више од једног пута (по сесији). Када се сви банери прикажу, историја ће бити очишћена и ресетована.';
//modules/mod_latestnews.xml
protected $AX_SM_LN_DESC = 'Овај модул приказује листу најновијих објављених ставки, које су још увек актуелне (неке су можда истекле, иако су најновије). Ставке приказане кроз компоненту Насловне не налазе се на листи.'; 
protected $AX_SM_LN_FPIL = 'Ставке Насловне стране'; 
protected $AX_SM_LN_FPID = 'Приказ/Скривање ставки Насловне стране - само при прегледу ставки садржаја.'; 
protected $AX_SM_AR_CNT5D = 'Број ставки за приказ (предефинисано је 5).'; 
protected $AX_SM_LN_CATIL = 'ID категорије'; 
protected $AX_SM_LN_CATID = 'Избор ставки из једне или више категорија (да бисте изабрали више од једне категорије, раздвојте их зарезом , ).'; 
protected $AX_SM_LN_SECIL = 'ID секције'; 
protected $AX_SM_LN_SECID = 'Избор ставки из једне или више секција (да бисте изабрали више од једне секције, раздвојте их зарезом , ).'; 
//modules/mod_login.xml
protected $AX_SM_LF_DESC = 'Овај модул приказује форму пријаве. Такође, приказује линк за случај заборављене лозинке. Ако је регистрација корисник укључена, (погледајте подешавања), биће приказан и линк за регистрацију.'; 
protected $AX_SM_LF_PTL = 'Предтекст'; 
protected $AX_SM_LF_PTD = 'Ово је текст или HTML који се појављује изнад пријавне форме.'; 
protected $AX_SM_LF_PSTL = 'Посттекст'; 
protected $AX_SM_LF_PSTD = 'Ово је текст или HTML који се појављује испод пријавне форме.'; 
protected $AX_SM_LF_LRUL = 'URL пријавне редирекције'; 
protected $AX_SM_LF_LRUD = 'Страница на коју ће корисник бити упућен након одјаве. Уколико је празно, биће приказана Насловна страна.'; 
protected $AX_SM_LF_LORUL = 'URL пријавне редирекције'; 
protected $AX_SM_LF_LORUD = 'Страница на коју ће корисник бити упућен након пријаве. Уколико је празно, биће приказана Насловна страна.'; 
protected $AX_SM_LF_LML = 'Пријавна порука'; 
protected $AX_SM_LF_LMD = 'Приказ/Скривање javascript поруке о успешној пријави.'; 
protected $AX_SM_LF_LOML = 'Одјавна порука'; 
protected $AX_SM_LF_LOMD = 'Приказ/Скривање javascript поруке о успешној одјави.'; 
protected $AX_SM_LF_GML = 'Поздрав'; 
protected $AX_SM_LF_GMD = 'Приказ/Скривање једноставне поздравне поруке.'; 
protected $AX_SM_LF_NUNL = 'Име/Корисничко име'; 
protected $AX_SM_LF_OP01 = 'Корисничко име'; 
protected $AX_SM_LF_OP02 = 'Име'; 
//modules/mod_mainmenu.xml
protected $AX_SM_MNM_DESC = 'Приказ менија.'; 
protected $AX_SM_MNM_MNL = 'Име менија'; 
protected $AX_SM_MNM_MND = 'Име менија (предефинисано је \'mainmenu\').'; 
protected $AX_SM_MNM_MSL = 'Стил менија'; 
protected $AX_SM_MNM_MSD = 'Стил менија'; 
protected $AX_SM_MNM_OP1 = 'Вертикално'; 
protected $AX_SM_MNM_OP2 = 'Хоризонтално'; 
protected $AX_SM_MNM_OP3 = 'Листа'; 
protected $AX_SM_MNM_EML = 'Проширени мени'; 
protected $AX_SM_MNM_EMD = 'Проширени мени, коме су све ставке подменија видљиве.'; 
protected $AX_SM_MNM_IIL = 'Граничник'; 
protected $AX_SM_MNM_IID = 'Избор слике који ће систем користити као граничник.'; 
protected $AX_SM_MNM_OP4 = 'Шаблон'; 
protected $AX_SM_MNM_OP5 = 'Предефинисане Elxis слике'; 
protected $AX_SM_MNM_OP6 = 'Употреба доњих параметара'; 
protected $AX_SM_MNM_OP7 = 'Ништа'; 
protected $AX_SM_MNM_II1L = 'Индикатор 1'; 
protected $AX_SM_MNM_II1D = 'Слика за први подниво.'; 
protected $AX_SM_MNM_II2L = 'Индикатор 2'; 
protected $AX_SM_MNM_II2D = 'Слика за други подниво.'; 
protected $AX_SM_MNM_II3L = 'Индикатор 3'; 
protected $AX_SM_MNM_II3D = 'Слика за трећи подниво.'; 
protected $AX_SM_MNM_II4L = 'Индикатор 4'; 
protected $AX_SM_MNM_II4D = 'Слика за четврти подниво.'; 
protected $AX_SM_MNM_II5L = 'Индикатор 5'; 
protected $AX_SM_MNM_II5D = 'Слика за пети подниво.'; 
protected $AX_SM_MNM_II6L = 'Индикатор 6'; 
protected $AX_SM_MNM_II6D = 'Слика за шести подниво.'; 
protected $AX_SM_MNM_SPL = 'Сепаратор'; 
protected $AX_SM_MNM_SPD = 'Сепаратор за хоризонтални мени.'; 
protected $AX_SM_MNM_ESL = 'Завршни сепаратор'; 
protected $AX_SM_MNM_ESD = 'Завршни сепаратор за хоризонтални мени.';
protected $AX_SM_MNM_IDPR = 'SEO PRO Itemid предучитавање';
protected $AX_SM_MNM_IDPRD = 'Укључивањем AJAX предучитавања Itemid-ја решава проблем са више ставки менија које усмеравају на исту страницу.';
//modules/mod_mostread.xml
protected $AX_SM_MRC_DESC = 'Овај модул приказује листу најчитанијих тренутно објављених ставки - према броју читања.'; 
protected $AX_SM_MRC_MNL = 'Име менија'; 
protected $AX_SM_MRC_MND = 'Име менија (предефинисано је mainmenu).'; 
protected $AX_SM_MRC_FPIL = 'Ставке Насловне'; 
protected $AX_SM_MRC_FPID = 'Приказ/Скривање ставки Насловне - само при прегледу ставки садржаја.'; 
protected $AX_SM_MRC_CL = 'Број'; 
protected $AX_SM_MRC_CD = 'Број ставки за приказ (предефинисано је 5).'; 
protected $AX_SM_MRC_CIDL = 'ID категорије'; 
protected $AX_SM_MRC_CIDD = 'Избор ставки из једне или више категорија (да бисте изабрали више од једне категорије, раздвојте их зарезом , ).'; 
protected $AX_SM_MRC_SIDL = 'ID секције'; 
protected $AX_SM_MRC_SIDD = 'Избор ставки из једне или више категорија (да бисте изабрали више од једне секције, раздвојте их зарезом , ).'; 
//modules/mod_newsflash.xml
protected $AX_SM_NWF_DESC = 'Модул вести насумично бира објављене ставке из одабране категорије при сваком освежавању странице. Може бити приказан хоризонтално или вертикално.'; 
protected $AX_SM_NWF_CATL = 'Категорија'; 
protected $AX_SM_NWF_CATD = 'Категорија садржаја.'; 
protected $AX_SM_NWF_STL = 'Стил'; 
protected $AX_SM_NWF_STD = 'Стил приказа категорије.'; 
protected $AX_SM_NWF_OP1 = 'Насумични избор једне вести'; 
protected $AX_SM_NWF_OP2 = 'Хоризонтално'; 
protected $AX_SM_NWF_OP3 = 'Вертикално'; 
protected $AX_SM_NWF_SIL = 'Приказ слика'; 
protected $AX_SM_NWF_SID = 'Приказ слика у ставкама.'; 
protected $AX_SM_NWF_LTL = 'Линковани наслови'; 
protected $AX_SM_NWF_LTD = 'Линковање наслова ставки.'; 
protected $AX_SM_NWF_RML = 'Опширније...'; 
protected $AX_SM_NWF_RMD = 'Приказ/Скривање иконе опширније.'; 
protected $AX_SM_NWF_ITL = 'Наслов ставке'; 
protected $AX_SM_NWF_ITD = 'Приказ наслова ставке.'; 
protected $AX_SM_NWF_NOIL = 'Бр. ставки'; 
protected $AX_SM_NWF_NOID = 'Број ставки за приказ.'; 
//modules/mod_poll.xml
protected $AX_SM_POL_DESC = 'Овај модул допуњава компоненту гласање. Користи се за приказ конфигурисаних анкета. Овај модул се разликује од осталих по томе што је могуће линковање са ставкама менија. Ово значи да се анкета приказује само на оном ставкама менија које конфигурисане да је приказују.'; 
protected $AX_SM_POL_CATL = 'Категорија'; 
protected $AX_SM_POL_CATD = 'Категорија садржаја.'; 
//modules/mod_random_image.xml
protected $AX_SM_RNI_DESC = 'Овај модул насумично приказује слике из изабраног директоријума.'; 
protected $AX_SM_RNI_ITL = 'Тип слике'; 
protected $AX_SM_RNI_ITD = 'Тип слике PNG/GIF/JPG итд. (предефинисано је JPG).'; 
protected $AX_SM_RNI_IFL = 'Директоријум слика'; 
protected $AX_SM_RNI_IFD = 'Релативна путања у односу на URL сајта, нпр: images/stories.'; 
protected $AX_SM_RNI_LNL = 'Линк'; 
protected $AX_SM_RNI_LND = 'URL на који ће слика упутити, нпр: http://www.goup.gr'; 
protected $AX_SM_RNI_WL = 'Ширина (px)'; 
protected $AX_SM_RNI_WD = 'Ширина слике (приказаће све слике у овој ширини).'; 
protected $AX_SM_RNI_HL = 'Висина (px)'; 
protected $AX_SM_RNI_HD = 'Висина слике (приказаће све слике у овој висини).'; 
//modules/mod_related_items.xml
protected $AX_SM_RLI_DESC = "Овај модул приказује ставке сродне тренутно приказаној. Ово је базирано на кључним речима. Све кључне речи приказане ставке ће бити узете у обзир. На пример, можете имати ставки која садржи реч 'Грчка', и другу, која садржи реч 'Партенон'. Уколико укључите реч 'Грчка' у обе ставке, тада ће модул излистати ставку 'Грчка' док читате 'Партенон' и обратно."; 
//modules/mod_rssfeed.xml
protected $AX_SM_RSS_DESC = 'Модул синдикације ће приказати линк путм когаће људи моћи да редистрибуирају најновије вести са Вашег сајта. Када кликнете на RSS икону, бићете преусмерени на нову страницу која ће излистати најновије ставке у XML формату. Да бисте користили извор текућих вести на другом Elxis сајту или читачу вести, треба само да копирате URL.'; 
protected $AX_SM_RSS_TXL = 'Текст'; 
protected $AX_SM_RSS_TXD = 'Унесите текст који ће бити приказан са RSS линковима.'; 
protected $AX_SM_RSS_091D = 'Приказ/Скривање RSS 0.91 линка.'; 
protected $AX_SM_RSS_10D = 'Приказ/Скривање RSS 1.0 линка.'; 
protected $AX_SM_RSS_20D = 'Приказ/Скривање RSS 2.0 линка.'; 
protected $AX_SM_RSS_03D = 'Приказ/Скривање Atom 0.3 линка.'; 
protected $AX_SM_RSS_OPD = 'Приказ/Скривање OPML линка.'; 
protected $AX_SM_RSS_I091L = 'RSS 0.91 слика'; 
protected $AX_SM_RSS_I10L = 'RSS 1.0 слика'; 
protected $AX_SM_RSS_I20L = 'RSS 2.0 слика'; 
protected $AX_SM_RSS_I03L = 'Atom слика'; 
protected $AX_SM_RSS_IOPL = 'OPML слика'; 
protected $AX_SM_RSS_CHID = 'Избор слике која ће бити употребљена.'; 
//modules/mod_search.xml
protected $AX_SM_SEM_DESC = 'Овај модул приказује поље претраге.';
protected $AX_SM_SEM_TOP = 'Врх';
protected $AX_SM_SEM_BTM = 'Дно';
protected $AX_SM_SEM_BWL = 'Ширина поља';
protected $AX_SM_SEM_BWD = 'Величиина поља претраге.';
protected $AX_SM_SEM_TXL = 'Текст';
protected $AX_SM_SEM_TXD = 'Текст који се појављује у пољу претраге, уколико је празно, учитаће _SEARCH_BOX из Вашег језичког фајла.';
protected $AX_SM_SEM_BPL = 'Позиција дугмета';
protected $AX_SM_SEM_BPD = 'Позиција дугмета у односу на поље претраге.';
protected $AX_SM_SEM_BTXL = 'Текст дугмета';
protected $AX_SM_SEM_BTXD = 'Текст који се појављује на дугмету претраге, уколико је празно, учитаће _SEARCH_TITLE из Вашег језичког фајла.'; 
//modules/mod_sections.xml
protected $AX_SM_SEC_DESC = 'Модул секција прикзује све секције садржаја из Ваше базе. Реч секција се овде односи на сâме секције. Уколико у конфигурацији није укључен \'Приказ неауторизованих линкова\', биће излистане само секције чији је преглед кориснику дозвољен.'; 
protected $AX_SM_SEC_CL = 'Број';
protected $AX_SM_SEC_CD = 'Број ставки за приказ (предефинисано је 5).';
//modules/mod_stats.xml
protected $AX_SM_STA_DESC = 'Модул статистике приказује податке о Вашем сервеу, броју ставки у бази и броју линкова.';
protected $AX_SM_STA_SVIL = 'Информације о серверу'; 
protected $AX_SM_STA_SVID = 'Приказ информација о серверу.'; 
protected $AX_SM_STA_SIL = 'Информације о сајту'; 
protected $AX_SM_STA_SID = 'Приказ информација о сајту.'; 
protected $AX_SM_STA_HCL = 'Бројач прегледа'; 
protected $AX_SM_STA_HCD = 'Приказ бројача прегледа.'; 
protected $AX_SM_STA_ICL = 'Увећање броја прегледа'; 
protected $AX_SM_STA_ICD = 'Унесите број за који желите да увећате број прегледа.'; 
//modules/mod_templatechooser.xml
protected $AX_SM_TMC_DESC = 'Модул избора шаблона омогућава посетиоцима сајта измене шаблон путем избора шаблона са падајућег менија.'; 
protected $AX_SM_TMC_MNLL = 'Макс. дужина имена'; 
protected $AX_SM_TMC_MNLD = 'Максимална дужина имена шаблона за приказ (предефинисано је 20).'; 
protected $AX_SM_TMC_SPL = 'Приказ слике'; 
protected $AX_SM_TMC_SPD = 'Биће приказана слика шаблона.'; 
protected $AX_SM_TMC_WL = 'Ширина'; 
protected $AX_SM_TMC_WD = 'Ширина слике шаблона (предефинисано је 140 px).'; 
protected $AX_SM_TMC_HL = 'Висина'; 
protected $AX_SM_TMC_HD = 'Висина слике шаблона (предефинисано је 90 px).'; 
//modules/mod_whosonline.xml
protected $AX_SM_WSO_DESC = 'Модул Ко је на сајту приказује број непознатих (гости) и регистрованих корисника (чланови) који тренутно прегледају сајт.'; 
protected $AX_SM_WSO_DL = 'Приказ'; 
protected $AX_SM_WSO_DD = 'Избор онога што ће бити приказано.'; 
protected $AX_SM_WSO_OP1 = '# гостију/чланова<br />'; 
protected $AX_SM_WSO_OP2 = 'Имена чланова<br />'; 
protected $AX_SM_WSO_OP3 = 'Оба'; 
//modules/mod_wrapper.xml
protected $AX_SM_WRM_DESC = 'Овај модул приказује одређени URL у IFrame прозору.'; 
protected $AX_SM_WRM_URLL = 'URL'; 
protected $AX_SM_WRM_URLD = 'URL сајта/фајл који желите да прикажете у IFrame прозору'; 
protected $AX_SM_WRM_SCBL = 'Клизачи'; 
protected $AX_SM_WRM_SCBD = 'Приказ/Скривање хоризонталних и вертикалних клизача.'; 
protected $AX_SM_WRM_WL = 'Ширина'; 
protected $AX_SM_WRM_WD = 'Ширина IFrame прозора. Можете унети апсолутну ширину у пикселима, или релативну у %.'; 
protected $AX_SM_WRM_HL = 'Висина'; 
protected $AX_SM_WRM_HD = 'Висина IFrame прозора'; 
protected $AX_SM_WRM_AHL = 'Аутоматски'; 
protected $AX_SM_WRM_AHD = 'Висина ће бити аутоматски подешена према висини приказане странице. Ово важи само за странице са истог домена.'; 
protected $AX_SM_WRM_ADL = 'Аутоматско додавање'; 
protected $AX_SM_WRM_ADD = 'Префикс http:// ће бити додат, уколико не постоји http:// или https:// у URL-у унетог линка, можете ову могућност укључити или искључити.'; 
/* mambots/editors/tinymce */
protected $AX_ED_FUNCTL = 'Функционалност'; 
protected $AX_ED_FUNCTD = 'Избор функционалности'; 
protected $AX_ED_FUNSIMPLE = 'Једноставно'; 
protected $AX_ED_FUNADV = 'Напредно';
protected $AX_ED_EDITORWIDTHL = 'Ширина прозора';
protected $AX_ED_EDITORWIDTHD = 'Ширина прозора са текстом';
protected $AX_ED_EDITORHEIGHTL = 'Висина прозора';
protected $AX_ED_EDITORHEIGHTD = 'Висина прозора са текстом';
protected $AX_ED_COMPRESSEDVL = 'Компресована верзија';
protected $AX_ED_COMPRESSEDVD = 'TinyMCE може радити у компресованој варијанти, што доводи до незнатног убрзања. Ипак, ово не ради увек, нарочито у IE, и зато је искључено по дефиницији. Проверите да ли ће ова опција за Вас бити корисна';
protected $AX_ED_OFF = 'Искључено';
protected $AX_ED_ON = 'Укључено';
protected $AX_ED_COMPRESSL = 'Компресија';
protected $AX_ED_COMPRESSD = 'Компресија TinyMCE путем gzip (учитава се 75% брже)';
protected $AX_ED_CONVERTURLL = 'Конверзија URL-ова';
protected $AX_ED_CONVERTURLD = 'Конверзија апсолутних URL-ова у релативне.';
protected $AX_ED_ENTENCODL = 'Кодирање карактера';
protected $AX_ED_ENTENCODD = 'Ова опција контролише начин на који ће TinyMCE процесуирати карактере. Вредност може бити нумерички приказ, именовани ентитет или сирови формат, без кодирања. Предефинисана опција је именовани ентитет.';
protected $AX_ED_TXTDIRL = 'Смер текста';
protected $AX_ED_TXTDIRD = 'Могућност промене смера текста';
protected $AX_ED_CNVFONTSPANL = 'Конверзија фонтова у спанове';
protected $AX_ED_CNVFONTSPAND = 'Конверзија фонт елемената у спанове. Предефинисано је Да, јер фонт елементи нису пожељни.';
protected $AX_ED_FONTSIZETYPEL = 'Тип величине фонта';
protected $AX_ED_FONTSIZETYPED = 'Избор коришћене величине фонта, може бити нпр: 10pt, или нпр: x-small.';
protected $AX_ED_INLTABLEDITL = 'Линеарно уређивање табела';
protected $AX_ED_INLTABLEDITD = 'Омогућава линеарно уређивање табела.';
protected $AX_ED_PROHELEMENTSL = 'Недозвољени елементи';
protected $AX_ED_PROHELEMENTSD = 'Елементи који ће бити уклоњени из текста';
protected $AX_ED_EXTELEMENTSL = 'Прочирени елементи';
protected $AX_ED_EXTELEMENTSD = 'Прширите функционалност TinyMCE путем додавања нових елемената. Формат: elm[tag1|tag2]';
protected $AX_ED_EVELEMENTSL = 'Елементи догађаја';
protected $AX_ED_EVELEMENTSD = 'Ова опција треба да садржи листу зарезом одвојених елемената који могу имати атрибуте догађаја, као нпр. onclick и слично. Ова опција је потребна јер неки претраживачи извршавају догађаје приликом уређивања текста.';
protected $AX_ED_TCSSCLASSESL = 'CSS класе шаблона';
protected $AX_ED_TCSSCLASSESD = 'Учитавање CSS класа из template_css.css';
protected $AX_ED_CCSSCLASSESL = 'Корисничке CSS класе';
protected $AX_ED_CCSSCLASSESD = 'Уколико дефинишете учитавање засебног CSS фајла - једноставно унесите име тог CSS фајла. Овај фајл се МОРА налазити у истом директоријуму као и CSS фајл шаблона.';
protected $AX_ED_NEWLINESL = 'Нови ред';
protected $AX_ED_NEWLINESD = 'Начин на који ће нови ред бити додат';
protected $AX_ED_TOOLBARL = 'Алатна трака';
protected $AX_ED_TOOLBARD = 'Позиција алатне траке';
protected $AX_ED_HTMLHEIGHTL = 'Висина HTML-а';
protected $AX_ED_HTMLHEIGHTD = 'Висина HTML-а прозора.';
protected $AX_ED_HTMLWIDTHL = 'Ширина HTML-а';
protected $AX_ED_HTMLWIDTHD = 'Ширина HTML-а прозора.';
protected $AX_ED_PREVIEWHEIGHTL = 'Ширина прегледа';
protected $AX_ED_PREVIEWHEIGHTD = 'Ширина прозора прегледа.';
protected $AX_ED_PREVIEWWIDTHL = 'Висина прегледа';
protected $AX_ED_PREVIEWWIDTHD = 'Ширина прозора прегледа.';
protected $AX_ED_IBROWSERL = 'iBrowser додатак';
protected $AX_ED_IBROWSERD = 'iBrowser је напредни менаџер слика';
protected $AX_ED_PLTABLESL = 'Додатак табела';
protected $AX_ED_PLTABLESD = 'Омогућава уређивање табела у WYSIWYG моду.';
protected $AX_ED_PLPASTEL = 'Paste додатак';
protected $AX_ED_PLPASTED = 'Омогућава Paste из Word-а, Paste обичног текста и Select All.';
protected $AX_ED_PLIMGPLUGINL = 'Напр. додатак за слике';
protected $AX_ED_PLIMGPLUGIND = 'Омогућава употребу напредног менаџера слика. Пресефинисано се користи једноставни менаџер слика.';
protected $AX_ED_PLSEARCHL = 'Претрага/Замена';
protected $AX_ED_PLSEARCHD = 'Укључује Search and Replace додатак.';
protected $AX_ED_PLLINKSL = 'Напр. линкови';
protected $AX_ED_PLLINKSD = 'Укључује напредни менаџер линкова. Предефинисано се користи једноставна верзија.';
protected $AX_ED_PLEMOTL = 'Емоције';
protected $AX_ED_PLEMOTD = 'Укључује додатак емоција. Омогућава једноставно додавање емоција.';
protected $AX_ED_PLFLASHL = 'Flash додатак';
protected $AX_ED_PLFLASHD = 'Укључује Flash додатак. Омогућава додавање Flash-а у садржаје.';
protected $AX_ED_PLDTL = 'Датум/Време';
protected $AX_ED_PLDTD = 'Момогућава додавање тренутног датма/времена.';
protected $AX_ED_PLPREVL = 'Преглед';
protected $AX_ED_PLPREVD = 'Овај додатак омогућује дугме прегледа у TinyMCE, клик на ово дугме отвара прозор у коме се приказује изглед чланка који уређујете.';
protected $AX_ED_PLZOOML = 'Зум додатак';
protected $AX_ED_PLZOOMD = 'Додаје зум падајући мени у MSIE5.5+.';
protected $AX_ED_PLFSCRL = 'Пун екран';
protected $AX_ED_PLFSCRD = 'Овај додатак омогућује да TinyMCE буде приказан преко селог екрана.';
protected $AX_ED_PLPRINTL = 'Додатак штампе';
protected $AX_ED_PLPRINTD = 'Овај додатак додаје дугме штампе у TinyMCE.';
protected $AX_ED_PLDIRL = 'Додатак за смер';
protected $AX_ED_PLDIRD = 'Овај додатак додаје иконе смера у TinyMCE, чиме се омогућава боља манипулација текстовима на јеѕицима који се пишу сдесна налево.';
protected $AX_ED_PLFONTSL = 'Листа избора фонта';
protected $AX_ED_PLFONTSD = 'Омогућава избор фонта са листе.';
protected $AX_ED_PLFONTSZL = 'Листа величине фонта';
protected $AX_ED_PLFONTSZD = 'Омогућава избор величине фонта са листе.';
protected $AX_ED_PLFORMLSL = 'Листа формата';
protected $AX_ED_PLFORMLSD = 'Омогућава падајући мени са форматима текста, нпр. H1, H2, итд.';
protected $AX_ED_PLSSLL = 'Листа избора стила';
protected $AX_ED_PLSSLD = 'Додаје лист за избор стила, базирану на стиловима Вашег шаблона или CSS фајла по вашен избору.';
protected $AX_ED_NAMED = 'Иновани';
protected $AX_ED_NUMERIC = 'Нумерички';
protected $AX_ED_RAW = 'Сирови';
protected $AX_ED_LTR = 'Слева надесно';
protected $AX_ED_RTL = 'Сдесна налево';
protected $AX_ED_LENGTH = 'Дужина';
protected $AX_ED_ABSSIZE = 'Апсолутна величина';
protected $AX_ED_BRELEMENTS = 'BR елементи';
protected $AX_ED_PELEMENTS = 'P елементи';
//TOOLS
//Calculator: /administrator/tools/calculator/calculator.xml
protected $AX_TCAL_L = 'Калкулатор';
protected $AX_TCAL_D = 'Напредни javascript калкулатор';
//Empty Temporary: /administrator/tools/empty_temporary/empty_temporary.xml
protected $AX_TEMTEMP_L = 'Брисање привременог';
protected $AX_TEMTEMP_D = 'Испразниће Elxis-ов привремени директоријум (/tmpr).';
//FixLanguage: /administrator/tools/fix_language/fix_language.xml
protected $AX_TFIXLANG_L = 'Поправка језика';
protected $AX_TFIXLANG_D = 'Врши проверу вишејезичкиих табела и отклања потенцијалне проблеме.';
//Organizer: /administrator/tools/organizer/organizer.xml
protected $AX_TORGANIZ_L = 'Организатор';
protected $AX_TORGANIZ_D = 'Elxis организатор чува Ваше контакте, белешке, и састанке.';
//Clean Cache: /administrator/tools/clean_cache/clean_cache.xml
protected $AX_TCLEANCACHE_L = 'Чишћење кеша';
protected $AX_TCLEANCACHE_D = 'Чисти кеш директоријум од кешираних ставки садржаја и слика';
//Chmod: /administrator/tools/chmod/chmod.xml
protected $AX_TCHMOD_L = 'Измена дозвола';
protected $AX_TCHMOD_D = 'Измена дозвола датог директоријум или фајла';
//FixPgSequences: /administrator/tools/fix_pg_sequences/fix_pg_sequences.xml
protected $AX_TFPGSEQ_L = 'Поправка Postgres-а';
protected $AX_TFPGSEQ_D = 'Поправка Postgres секвенци, уколико су потребне.';
//Elxis Registration: /administrator/tools/registration/registration.xml
protected $AX_TELXREG_L = 'Elxis регистрација';
protected $AX_TELXREG_D = 'Региструје Вашу Elxis инсталацију на elxis.org';
//com_menus/bridge/bridge.xml
protected $AX_BRIDGE_CNAME = 'Мост';
protected $AX_BRIDGE_CDESC = 'Прави линк до моста.';
//modules/mod_language.xml
protected $AX_NEW_LINE = 'Нови ред';
protected $AX_SAME_LINE = 'Исти ред';
protected $AX_INDICATOR = 'Индикатор';
protected $AX_INDICATOR_D = 'Приказује реч Језик као индикатор';
protected $AX_FLAG = 'Застава';
//modules/mod_language.xml
protected $AX_MODLANGD = 'Приказује избор језика као падајући мени, листу линкова, или низ застава.';
protected $AX_FLAGS = 'Заставе';
protected $AX_SMARTSW = 'Паметни прекидач';
protected $AX_SMARTSW_D = 'Омогућава промену језика без промене странице на којој се корисник налази';
//modules/mod_random_profile.xml
protected $AX_RP_DESC = 'Приказ насумично изабраних профила корисника';
protected $AX_DISPSTYLE = 'Стил приказа';
protected $AX_COMPACT = 'Компактно';
protected $AX_EXTENDED = 'Проширено';
protected $AX_GENDER = 'Пол';
protected $AX_GENDERDESC = 'Приказ пола корисника?';
protected $AX_AGE = 'Године';
protected $AX_AGEDESC = 'Приказ година корисника?';
protected $AX_REALUNAME = 'Приказ стварног или корисничког имена?';
//weblinks item
protected $AX_WBLI_TL = 'Одредиште';
//content
protected $AX_RTFICL = 'RTF икона';
protected $AX_RTFICD = 'Приказ/Скривање RTF дугмета - само за ову страну.';
//modules/mod_whosonline.xml
protected $AX_MODWHO_FILGR = 'Филтер група';
protected $AX_MODWHO_FILGRD = 'Уколико је Да, корисници са нижим приступним новоом (нпр. посетиоци) неће моћи да виде статус корисника са вишим приступним нивоом.';
//search bots
protected $AX_SEARCH_LIMIT = 'Ограничење претраге';
protected $AX_MAXNUM_SRES = 'Максимални број резултата претраге';
//modules/mod_frontpage
protected $AX_MODFRONTPAGE = 'Приказује пресек најновијих доприноса чланова. Идеално за Насловну страну.'; 
protected $AX_SECTIONS = 'Секције';
protected $AX_SECTIONSD = 'ID-јеви секција одвојени зарезом (,)';
protected $AX_CATEGORIES = 'Категорије';
protected $AX_CATEGORIESD = 'ID-јеви категорија одвојени зарезом (,)';
protected $AX_NUMDAYS = 'Број дана';
protected $AX_NUMDAYSD = 'Приказ ставки насталих у последњих X дана (предефинисано је 900)';
protected $AX_SHOWTHUMBS = 'Приказ слика';
protected $AX_SHOWTHUMBSD = 'Приказ/Скривање слика у уводном тексту';
protected $AX_THUMBWIDTHD = 'Ширина слике у пикселима';
protected $AX_THUMBHEIGHTD = 'Висина слике у пикселима';
protected $AX_KEEPRATIO = 'Очување односа';
protected $AX_KEEPRATIOD = 'Очување односа слике. Уколико је укључено, параметар висине није битан.';
//com_menus/eblog_item_link/eblog_item_link.xml
protected $AX_EBLOGITEM = 'Ставка eBlog';
protected $AX_EBLOGITEMD = 'Направиће линк до објављеног eBlog блога';
protected $AX_COMMENTARY = 'Коментари';
protected $AX_COMMENTARYD = 'Изаберите ко може да поставља коментаре.';
protected $AX_NOONE = 'Нико';
protected $AX_REGUSERS = 'Регистровани';
protected $AX_ALL = 'Сви';

protected $AX_COMMENTS = 'Коментари';
protected $AX_COMMENTSD = 'Приказ броја коментара?';

}

?>