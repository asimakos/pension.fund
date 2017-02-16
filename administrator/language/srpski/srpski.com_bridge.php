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
* @description: Srpski language for component bridge
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class adminLanguage extends standardLanguage {

public $A_CMP_BRI_SYSDISABLED = 'Систем мостова је искључен!';
public $A_CMP_BRI_INVBRIDGE = 'Неисправан мост';
public $A_CMP_BRI_BRISUCPUB = 'Мост је успешно објављен';
public $A_CMP_BRI_BRISUCUNPUB = 'Мост је успешно одјављен';
public $A_CMP_BRI_CNOTPUBBRI = 'Не могу да објавим мост';
public $A_CMP_BRI_CNOTUNPUBRI = 'Не могу да одјавим мост';
public $A_CMP_BRI_CNOTSAVESETS = 'Не могу да сачувам подешавања!';
public $A_CMP_BRI_UNPUBBRIFIRST = 'Најпре одјавите мост!';
public $A_CMP_BRI_BRIUNISTSUC = 'Мост је успешно деинсталиран';
public $A_CMP_BRI_CNOTUNISTBRI = 'Не могу да деинсталирам мост. Проверите дозволе директоријума.';
public $A_CMP_BRI_CNOTDETREGV = 'Не могу да одредим тренутну верзију регистра!';
public $A_CMP_BRI_CNOTUPDREG = 'Не могу да ажурирам регистар!';
public $A_CMP_BRI_REGSUCUPTO = 'Регистар је успешно ажуриран на верзију';
public $A_CMP_BRI_REGINIUNWR = 'registry.ini је закључан!';
public $A_CMP_BRI_REGUPTODATE = 'Регистар је већ ажуриран!';
public $A_CMP_BRI_BRIUNPUB = 'Мост је одјављен!';
public $A_CMP_BRI_CNOTLOCXML = 'Не могу да лоцирам XML фајл моста!';
public $A_CMP_BRI_BNOTHAVECFI = 'Мост %s нема конфигурациони фајл';
public $A_CMP_BRI_BNOTHAVECPA = 'Мост %s нема конфигурисане параметре!';
public $A_CMP_BRI_DETINVPARAMS = 'Примећени су неправилни параметри!';
public $A_CMP_BRI_INSTBRI = 'Инсталирани мостови';
public $A_CMP_BRI_SYSENABLED = 'Систем мостова је укључен';
public $A_CMP_BRI_REGVERSION = 'Верзија регистра';
public $A_CMP_BRI_DETREGERRUP = 'Примећена је грешка у регистру. Молимо Вас, ажурирајте регистар!';
public $A_CMP_BRI_UPDATE = 'Ажурирање';
public $A_CMP_BRI_REGERR = 'Грешка у регистру';
public $A_CMP_BRI_LICENSE = 'Лиценца';
public $A_CMP_BRI_UNIST = 'Деинсталација';
public $A_CMP_BRI_DISBRISYS = 'Искључивање система мостова';
public $A_CMP_BRI_ENBRISYS = 'Укључивање система мостова';
public $A_CMP_BRI_REGMOD = 'Регистрациони модул';
public $A_CMP_BRI_REGMODHELP = 'Изаберите модул који ће бити коришћен као примарни систем за Пријаву/Регистрацију.';
public $A_CMP_BRI_REGMODHELP2 = 'Не можете бирати између Elxis-а и објављених мостова.';
public $A_CMP_BRI_REGMODHELP3 = 'Неки мостови НЕМАЈУ систем за Пријаву/Регистрацију корисника.';
public $A_CMP_BRI_REGMODHELP4 = 'Не заборавите да користите премошћени модул пријаве уместо стандардног.';
public $A_CMP_BRI_NOTE = 'Напомена';

}

?>
