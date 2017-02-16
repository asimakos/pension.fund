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
* @description: Srpski language for component menus
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_MU_MANAGER = 'Менаџер менија';
public $A_CMP_MU_MXLVLS = 'Макс. нивоа';
public $A_CMP_MU_CANTDEL ='* Не можете да \'обришете\' овај мени, јер је он неопходан за функционисање Elxis-а *';
public $A_CMP_MU_MANHOME = '* Прва објављена ставка у овом менију [mainmenu] представља \'Насловну страну\' сајта *';
public $A_CMP_MU_MITEM = 'Ставка менија';
public $A_CMP_MU_NSMTG = '* Приметићете да се неки менији појављују у више од једне групе, али они су ипак истог типа.';
public $A_CMP_MU_MITYP = 'Тип менија';
public $A_CMP_MU_WBLV = 'Шта је \'Блог\' приказ';
public $A_CMP_MU_WTLV = 'Шта је \'Табеларни\' приказ';
public $A_CMP_MU_WLIV = 'Шта је \'Листа\' приказ';
public $A_CMP_MU_SMTAP = '* Неки \'типови менија\' појављују се у више од једне групе *';
public $A_CMP_MU_MOVEITS = 'Премештај ставки менија';
public $A_CMP_MU_MOVEMEN = 'Премештај у мени';
public $A_CMP_MU_BEINMOV = 'Ставке менија које се премештају';
public $A_CMP_MU_COPYITS = 'Копија ставки менија';
public $A_CMP_MU_COPYMEN = 'Копирање у мени';
public $A_CMP_MU_BCOPIED = 'Ставке менија за копирање';
public $A_CMP_MU_EDNEWSF = 'Уређивање ове текуће вести';
public $A_CMP_MU_EDCONTA = 'Уређивање овог контакта';
public $A_CMP_MU_EDCONTE = 'Уређивање овог садржаја';
public $A_CMP_MU_EDSTCONTE = 'Уређивање ове независне странице';
public $A_CMP_MU_MSGITSAV = 'Ставка менија сачувана';
public $A_CMP_MU_MOVEDTO = ' ставки менија премештено у ';
public $A_CMP_MU_COPITO = ' ставки менија копирано у ';
public $A_CMP_MU_THMOD = 'Модул';
public $A_CMP_MU_SCITLKT = 'Морате да изаберете компоненту за линковање';
public $A_CMP_MU_COMPLLTO = 'Компонента за линковање';
public $A_CMP_MU_ITEMNAME = 'Ставка мора имати име';
public $A_CMP_MU_PLSELCMP = 'Изаберите компоненту';
public $A_CMP_MU_PARAVAI = 'Параметри ће постати доступни након чувања ове ставке';
public $A_CMP_MU_YSELCAT = 'Морате изабрати категорију';
public $A_CMP_MU_TMHTITL = 'Ова ставка менија мора имати наслов';
public $A_CMP_MU_TABLE = 'Табела';
public $A_CMP_MU_CCTBLANK = 'Уколико је празно, име категорије ће бити аутоматски употребљено';
public $A_CMP_MU_LNKHNAME = 'Линк мора имати име';
public $A_CMP_MU_SELCONT = 'Морате изабрати контакт за линковање';
public $A_CMP_MU_CONLINK = 'Контакт за линковање:';
public $A_CMP_MU_ONCLOPI = 'Отварање у';
public $A_CMP_MU_THETITL = 'Наслов:';
public $A_CMP_MU_YMSSECT = 'Морате изабрати секцију';
public $A_CMP_MU_ILBLSEC = 'Уколико је празно, име секције ће аутоматски бити употребљено';
public $A_CMP_MU_YCSMC = 'Можете изабрати више категорија';
public $A_CMP_MU_YCSMS = 'Можете изабрати више секција';
public $A_CMP_MU_EDCOI = 'Уређивање ставке садржаја';
public $A_CMP_MU_YMSLT = 'Морате изабрати садржај за линковање';
public $A_CMP_MU_STACONT = 'Садржај независне странице';
public $A_CMP_MU_ONCLOP = 'Отварање у';
public $A_CMP_MU_YSNWLT = 'Морате изабрати извор текућих вести';
public $A_CMP_MU_NEWTL = 'Текуће вести за линковање';
public $A_CMP_MU_SEPER = '- - - - - - -'; //Change this, if you want to change the symbols for seperator line
public $A_CMP_MU_PATNAM = 'Патерн/Име';
public $A_CMP_MU_WRURL = 'Морате унети url.';
public $A_CMP_MU_WRLINK = 'Линк \'омотача\'';
public $A_CMP_MU_MIBGCC = 'Блог - садржај категорије';
public $A_CMP_MU_MITCG = 'Табела - садржај категорије'; 
public $A_CMP_MU_MICOMP = 'Компонента';
public $A_CMP_MU_MIBGCS = 'Блог - садржај секције';
public $A_CMP_MU_MILCMPI = 'Линк - ставка компоненте';
public $A_CMP_MU_MILCI = 'Линк - ставка контаката';
public $A_CMP_MU_MITBCC = 'Табела - садржај категорије';
public $A_CMP_MU_MILCEI = 'Линк - ставка садржаја';
public $A_CMP_MU_COTLINK = 'Садржај за линковање';
public $A_CMP_MU_MITBCS = 'Табела - садржај секције';
public $A_CMP_MU_MILSTC = 'Линк - независна страница';
public $A_CMP_MU_MITBNFC = 'Табела - категорија текућих вести';
public $A_CMP_MU_MILNEW = 'Линк - извор текућих вести';
public $A_CMP_MU_MISEP = 'Сепаратор/Placeholder';
public $A_CMP_MU_MILIURL = 'Линк - URL';
public $A_CMP_MU_MITBWC = 'Табела - категорија Web линкова';
public $A_CMP_MU_MIWRAP = 'Омотач';
public $A_CMP_MU_ITEM = 'Ставка';
public $A_CMP_MU_UMSBRI = 'Морате изабрати мост';
public $A_CMP_MU_BRINOINS = 'Мост компонента није инсталирана!';
public $A_CMP_MU_NOPUBBRI = 'Нема објављених мостова!';
public $A_CMP_MU_CLVSEO = 'Кликните на независну страницу да бисте видели њен SEO наслов';
public $A_CMP_MU_SYSLINK = 'Системски линк';
public $A_CMP_MU_SYSLINKD = 'Системски линк би требао да се налази у објављеном менију, на позицији модула која НЕ ПОСТОЈИ у шаблону!';
public $A_CMP_MU_PASSR = 'Подсетник за лозинку';
public $A_CMP_MU_UREG = 'Регистрација корисника';
public $A_CMP_MU_REGCOMP = 'Регистрација је завршена';
public $A_CMP_MU_ACCACT = 'Активација налога';
public $A_CMP_MU_MSLINK = 'Морате изабрати системски линк.';
public $A_CMP_MU_SELLINK = '- Избор линка -';
public $A_CMP_MU_DONTDEL ='* Немојте брисати овај мени, јер он побољшава функционалности Elxis-а. Уверите се да је он објављен на позицији која НЕ ПОСТОЈИ у шаблону! *';
public $A_CMP_MU_EDPROF = 'Уређивање профила';
public $A_CMP_MU_SUBWEBL = 'Додавање web линка';
public $A_CMP_MU_CHECKIN = 'Овера';
public $A_CMP_MU_USERLIST = 'Листа корисника';
public $A_CMP_MU_POLLS = 'Анкете';
//2008.1
public $A_CMP_MU_SELBLOG = 'Изаберите блог за линковање';
public $A_CMP_MU_BLOGLINK = 'Блог за линковање';

}

?>
