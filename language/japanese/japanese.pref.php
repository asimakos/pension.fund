<?php 
/**
* @version: 2009.0
* @copyright: Copyright (C) 2006-2009 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Frontend Language
* @author: Elxis Team
* @translator: momo-i
* @link: http://www.elxis.jp
* @email: webmaster@elxis.jp
* @description: Japanese user's preferable language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


class prefLang_japanese {

	public $_ON_NEW_CONTENT = "新しいコンテンツアイテムは「%s」さんによって「%s」というタイトルでセクション「%s」とカテゴリ「%s」から投稿しました";
	public $_E_COMMENTS = 'コメント';
	public $_DATE = '日付';
	public $_E_SUBCONWAIT = '送信された記事の承認待ち:';
	public $_E_CONTENTSUB = 'コンテンツ送信';
	public $_MAIL_SUB = 'ユーザ送信済み';
	public $_E_HI = 'ようこそ';
	public $_E_NEWSUBBY = "ユーザ%sによって作られた新しい送信。%s";
	public $_E_TYPESUB = '送信のタイプ:';
	public $_E_TITLE = 'タイトル';
	public $_E_LOGINAPPR = 'この送信を承認及び閲覧するためにサイト管理へログインします。';
	public $_E_DONTRESPOND = 'このメールは自動送信のため、返信しないでください。';
	public $_E_NEWPASS_SUB = "%s さんの新しいパスワード";
	public $_E_RPASS_NADMIN = "ユーザ%sがパスワードを思い出させるフォームを送信しました。新しいパスワードは生成され、ユーザへ送信されます。
	この通知を受け取りたくない場合、ソフトディスクのUSERS_RPASSMAILパラメータをいいえに変更します。";
	public $_E_SEND_SUB = "%sさんのアカウント詳細 %s";
	public $_ASEND_MSG = "こんにちわ %sさん。

新しいユーザが%sへ登録されました。
これはその詳細を含むメールです:

名前           - %s
メールアドレス - %s
ユーザ名       - %s

このメールは自動送信メールのため、返信しないでください。";
	public $_NEW_MESSAGE = '新着プライベートメッセージがあります';
	public $_NEW_PRMSGF = "%sさんからの新着プライベートメッセージがあります";
	public $_LOG_READMSG = '本文を読むには管理コンソールへログインしてください。';
	public $_SUBCON_APPRNTF = 'Submitted content approval notification';
	public $_SUBCON_ATAPPR = 'Your submitted content at %s was approved.';
	public $_SECTION = 'セクション';
	public $_CATEGORY = 'カテゴリ';

	//elxis 2008.1
	public $_MANAPPROVE = 'In order for the new user to be able to login you must manually approve his registration!';
	public $_ACCUNBLOCK = "Your account at %s has been activated by a site administrator. You may now login as %s";

	//elxis 2009.0
	public $_E_NEWCOMNOTIF = 'New comment notification';
	public $_E_NEWCOMBYTITLE = "A new comment has been posted by %s on an article of yours titled %s";
	public $_E_COMSTAYUNPUB = 'This comment will stay unpublished until you or a super administrator publish it.';
	public $_E_ACCEXPDATE = 'Account expiration date';

	public function __construct() {
	}

}

?>