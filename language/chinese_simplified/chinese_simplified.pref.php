<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: 刘仲滨
* @link: http://j2eemx.com
* @email: bing@j2eemx.com
* @description: Simplified Chinese front-end language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( '直接存取此位置是不被允许.' );


class prefLang_chinese_simplified {

	public $_ON_NEW_CONTENT = "一个新的内容项目己被提交，由 [ %s ] 的头衔 [ %s ] 区块是 [ %s ] 及分类是 [ %s ]";
	public $_E_COMMENTS = '评论';
	public $_DATE = '日期';
	public $_E_SUBCONWAIT = '己提交文章正等待被允许:';
	public $_E_CONTENTSUB = '内容提交';
	public $_MAIL_SUB = '使用者己提交';
	public $_E_HI = '您好';
	public $_E_NEWSUBBY = "新的提交是由使用者 %s";
	public $_E_TYPESUB = '提交型式:';
	public $_E_TITLE = '标题';
	public $_E_LOGINAPPR = '登入您的网站管理来观阅并允许这提交内容.';
	public $_E_DONTRESPOND = '这是系统自动产生并且通知您，请不要回覆此讯息！.';
	public $_E_NEWPASS_SUB = "新的密码 %s";
	public $_E_RPASS_NADMIN = "使用者 %s 己提交新找回密码表单. 新的密码己产生并己寄去给该使用者. 
	如果您不想得到通知,像是改变动作 USERS_RPASSMAIL 参数,请在SoftDisk 设成No.";
	public $_E_SEND_SUB = "帐户明细是 %s 在 %s";
	public $_ASEND_MSG = "您好 %s, 
	一个新的使用者己注册在 %s.
	此邮件包含他的细项有:
	
	全名 - %s 
	邮件 - %s 
	登入帐号 - %s

	此封是系统自动产生并通知您，请勿直接回覆.";
	public $_NEW_MESSAGE = '一个新的私人讯息己传来';
	public $_NEW_PRMSGF = "一个新的私人讯息是从 %s 传来";
	public $_LOG_READMSG = '请登入管理控制台来设读此讯息.';
	public $_SUBCON_APPRNTF = '通知您提交内容己被允许';
	public $_SUBCON_ATAPPR = '您的内容提交在 %s 己被允许.';
	public $_SECTION = '区块';
	public $_CATEGORY = '分类';

	//elxis 2008.1
	public $_MANAPPROVE = '为了能让新的使用者能够登入,您必须手动的来批准这个注册!';
	public $_ACCUNBLOCK = "您的帐号在 %s 己由网站管理者启动. 您现在可以用 %s 登入";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = '新的评论通知';
	public $_E_NEWCOMBYTITLE = "新的评论己被 %s 贴出在您标题为 %s 的文章";
    public $_E_COMSTAYUNPUB = '此评论将还不会被发布,需直到您或管理者来发布它.';
    public $_E_ACCEXPDATE = '帐号过期日';

	public function __construct() {
	}

}

?>