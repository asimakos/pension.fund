<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: 劉仲濱
* @link: http://j2eemx.com
* @email: bing@j2eemx.com
* @description: Traditional Chinese front-end language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( '直接存取此位置是不被允許.' );


class prefLang_chinese_traditional {

	public $_ON_NEW_CONTENT = "一個新的內容項目己被提交，由 [ %s ] 的頭銜 [ %s ] 區塊是 [ %s ] 及分類是 [ %s ]";
	public $_E_COMMENTS = '評論';
	public $_DATE = '日期';
	public $_E_SUBCONWAIT = '己提交文章正等待被允許:';
	public $_E_CONTENTSUB = '內容提交';
	public $_MAIL_SUB = '使用者己提交';
	public $_E_HI = '您好';
	public $_E_NEWSUBBY = "新的提交是由使用者 %s";
	public $_E_TYPESUB = '提交型式:';
	public $_E_TITLE = '標題';
	public $_E_LOGINAPPR = '登入您的網站管理來觀閱並允許這提交內容.';
	public $_E_DONTRESPOND = '這是系統自動產生並且通知您，請不要回覆此訊息！.';
	public $_E_NEWPASS_SUB = "新的密碼 %s";
	public $_E_RPASS_NADMIN = "使用者 %s 己提交新找回密碼表單. 新的密碼己產生並己寄去給該使用者. 
	如果您不想得到通知,像是改變動作 USERS_RPASSMAIL 參數,請在SoftDisk 設成No.";
	public $_E_SEND_SUB = "帳戶明細是 %s 在 %s";
	public $_ASEND_MSG = "您好 %s, 
	一個新的使用者己註冊在 %s.
	此郵件包含他的細項有:
	
	全名 - %s 
	郵件 - %s 
	登入帳號 - %s

	此封是系統自動產生並通知您，請勿直接回覆.";
	public $_NEW_MESSAGE = '一個新的私人訊息己傳來';
	public $_NEW_PRMSGF = "一個新的私人訊息是從 %s 傳來";
	public $_LOG_READMSG = '請登入管理控制台來設讀此訊息.';
	public $_SUBCON_APPRNTF = '通知您提交內容己被允許';
	public $_SUBCON_ATAPPR = '您的內容提交在 %s 己被允許.';
	public $_SECTION = '區塊';
	public $_CATEGORY = '分類';

	//elxis 2008.1
	public $_MANAPPROVE = '為了能讓新的使用者能夠登入,您必須手動的來批准這個註冊!';
	public $_ACCUNBLOCK = "您的帳號在 %s 己由網站管理者啟動. 您現在可以用 %s 登入";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = '新的評論通知';
	public $_E_NEWCOMBYTITLE = "新的評論己被 %s 貼出在您標題為 %s 的文章";
    public $_E_COMSTAYUNPUB = '此評論將還不會被發佈,需直到您或管理者來發佈它.';
    public $_E_ACCEXPDATE = '帳號過期日';

	public function __construct() {
	}

}

?>