<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: momo-i
* @link: http://www.elxis.jp
* @email: webmaster@elxis.jp
* @description: Japanese language for component softdisk
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'この場所への直接アクセスは許可されていません。' );


class adminLanguage extends standardLanguage {

public $A_CORE = 'コア'; //Core
public $A_ASTATS = '管理統計'; //Administration Statistics
public $A_VALUE = '値';
public $A_LASTMOD = '最終更新日'; //Last modified
public $A_OS = 'オペレーションシステム';
public $A_ELXIS_VERSION = 'Elxisのバージョン';
public $A_SELECT = '選択';
public $NOEDITSYS = 'システムエントリを編集するための許可がありません';
public $A_RESTORE = '復元';
public $SOFTDISK_HELP = 'SoftDiskは様々な種類のパラメータと変数のための仮想ストレージ領域です。<br />
システムによって所有されているようにラベルされたものを除いて既存のSoftDiskを新しく追加、編集又は削除することができます。
また、「削除不可」として示されるエントリは編集することだけできます。命名についてはSoftDiskのセクション及び値の名前には
<strong>頭文字にラテン文字、数字及びアンダースコア「_」</strong>を使用することのみ許可されています。';
public $YCNOTEDITP = 'パラメータを編集することはできません';
public $UNDELETABLE = '削除不可';
public $SOFTENTRYEXIST = 'その名前でSoftDiskのエントリは既にあります！';
public $INVSECTNAME = '不正なセクション名です！';
public $INVNAME = '不正な名前です！';
public $INVEMAIL = '入力された値は有効なメールアドレスではありません！';
public $INVURL = '入力された値は有効なURLではありません！';
public $INVDEC = '入力された値は10進数ではありません！';
public $INVTSTAMP = '入力された値は有効なUNIX日付スタンプではありません！';
public $UPSYSTEM = 'システムの更新';
public $A_USERPROFILE = 'ユーザプロフィール';
public $UPROF_WEBSITE = 'ウェブサイト';
public $UPROF_AIM = 'AIM';
public $UPROF_YIM = 'YIM';
public $UPROF_MSN = 'MSN';
public $UPROF_ICQ = 'ICQ';
public $UPROF_EMAIL = 'メールアドレス';
public $UPROF_PHONE = '電話番号';
public $UPROF_MOBILE = '携帯電話';
public $UPROF_BIRTHDATE = '誕生日';
public $UPROF_GENDER = '性別';
public $UPROF_LOCATION = '所在地'; //Location
public $UPROF_OCCUPATION = '職業';
public $UPROF_SIGNATURE = '署名';
public $UPROF_ARTICLES = '記事数';
public $UPROF_USERGROUP = 'ユーザグループ';
public $UPROF_RANDUSERS = 'プロフィールページ内にランダムにユーザを表示します'; //Display random users in profile page
public $USERS_RPASSMAIL = 'パスワードの再発行時に管理者へ通知します'; //Notify administrators on password remind submition
public $SUBMIT_CATEGORIES = 'コンテンツの送信(提案)が許可されたカテゴリです。空の場合、全てが許可されています。(カテゴリIDはカンマで区切られます)';
public $SUBMIT_SECTIONS = 'コンテンツの送信(提案)が許可されたセクションです。空の場合、全てが許可されています。(セクションIDはカンマで区切られます)';
public $REG_AGREE = '登録同意の独立ページIDです。ゼロ(0)は無効です。整数タイプのREG_AGREE_LANGUAGE-HEREと名づけられた各言語のセクションのユーザでSoftDiskエントリを特定の言語のために同意を作成します'; //Registration agreement automonous page ID. Zero (0) to disable. For language specific agreement create a SoftDisk entry at section USERS for each language named REG_AGREE_LANGUAGE-HERE of type Integer
public $A_WEBLINKS = 'ウェブリンク';
public $TOP_WEBLINK = 'ウェブリンクコンポーネントに含まれるトップウェブリンクモジュールの表示をするかどうかをコントロールします'; //Controls the display or not, of the module Top Weblinks inside component weblinks
public $A_USERSLIST = 'ユーザ一覧';
public $ULIST_ONLINE = 'オンライン状態';
public $ULIST_USERNAME = 'ユーザ名';
public $ULIST_NAME = '名前';
public $ULIST_REGDATE = '登録日';
public $ULIST_PREFLANG = 'お望みの言語'; //Preferable language
//2009.0
public $STATICCACHE = 'Static cache';

}

?>