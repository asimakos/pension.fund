<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Language
* @author: Elxis Team
* @translator: Ivan Trebješanin
* @link: http://www.elxis-srbija.org
* @email: admin@elxis-srbija.org
* @description: Srpski user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_srpski {

	public $_ON_NEW_CONTENT = "[ %s ] је додао нову ставку садржаја под насловом [ %s ] у секцију [ %s ] и категорију [ %s ]";
	public $_E_COMMENTS = 'Коментари';
	public $_DATE = 'Датум';
	public $_E_SUBCONWAIT = 'Чланци који чекају одобрење:';
	public $_E_CONTENTSUB = 'Додавање садржаја';
	public $_MAIL_SUB = 'Прилози корисника';
	public $_E_HI = 'Здраво';
	public $_E_NEWSUBBY = "Нови прилог је додао %s";
	public $_E_TYPESUB = 'Тип прилога:';
	public $_E_TITLE = 'Наслов';
	public $_E_LOGINAPPR = 'Пријавите се у администраторски део сајта да бисте га прегледали.';
	public $_E_DONTRESPOND = 'Молимо Вас да не одговарате на ову поруку јер је аутоматски генерисана, и служи само за Вашу информацију.';
	public $_E_NEWPASS_SUB = "Нова лозинка за %s";
	public $_E_RPASS_NADMIN = "Корисник %s затражио је нову лозинку. Нова лозинка је генерисана и послата. 
	Уколико не желите да будете обавештавани о сличним акцијама, поставите прраметар USERS_RPASSMAIL у SoftDisk-у на Не.";
	public $_E_SEND_SUB = "Детаљи налога %s на %s";
	public $_ASEND_MSG = "Поздрав %s!

Нови корисник је регистрован на %s.
Ова порука садржи детаље:

Име - %s
Е-пошта - %s
Корисничко име - %s

Молимо вас да не одговарате на ову поруку јер је она аутоматски генерисана и служи за Вашу информацију.";
	public $_NEW_MESSAGE = 'Стигла Вам је нова приватна порука';
	public $_NEW_PRMSGF = "Нова приватна порука је стигла од %s";
	public $_LOG_READMSG = 'Пријавите се на администрациону конзолу да бисте је прочитали.';
	public $_SUBCON_APPRNTF = 'Обавештење о додатом садржају';
	public $_SUBCON_ATAPPR = 'Садржај који сте додали на %s је одобрен.';
	public $_SECTION = 'Секција';
	public $_CATEGORY = 'Категорија';
  
	//elxis 2008.1
	public $_MANAPPROVE = 'Да би нови корисник могао да се пријави, морате лично да активирате његов налог!';
	public $_ACCUNBLOCK = "Ваш налог на %s је активиран од стране администратора. Сада се можете пријавити као %s";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'Обавештење о новом коментару';
	public $_E_NEWCOMBYTITLE = "%s је поставио нови коментар на Ваш чланак под називом %s";
    public $_E_COMSTAYUNPUB = 'Овај коментар ће остати необјављен све док га Ви или суперадминистратор не објавите.';
    public $_E_ACCEXPDATE = 'Датум истека налога';
    
	public function __construct() {
	}

}

?>