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
* @description: Japanese front-end language for Elxis CMS
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'この場所への直接アクセスは許可されていません。' );


define('_LANGUAGE','ja'); //Two-letter language code
define('_ISO','charset=UTF-8'); //leave it as is!
define('_ENQUIRY','お問合せ');
define('_ENQUIRY_TEXT','これは%sさんからのお問合せです:');
define('_COPY_TEXT','以下は%sさんへ%s経由で送信されたメッセージのコピーです ');
define('_COPY_SUBJECT','コピー: '); // Copy of
define('_THANK_MESSAGE','メールありがとうございます');
define('_CLOAKING','このメールアドレスはスパムボットから保護ざれています。閲覧するにはJavascriptを有効にする必要があります。');
define('_CONTACTS_DESC','このウェブサイトの連絡先一覧です。');
define('_CONTACT_TITLE','連絡先');
define('_EMAIL_DESCRIPTION','この連絡先へメールを送信する:');
define('_NAME_PROMPT',' 名前を入力');
define('_EMAIL_PROMPT',' メールアドレス');
define('_MESSAGE_PROMPT',' 本文を入力');
define('_SEND_BUTTON','送信');
define('_CONTACT_FORM_NC','フォームが完全で有効なことを確かめてください。');
define('_CONTACT_TELEPHONE','電話番号');
define('_CONTACT_MOBILE','携帯電話');
define('_CONTACT_FAX','Fax');
define('_CONTACT_POSITION','所在地');
define('_CONTACT_ADDRESS','住所');
define('_CONTACT_MISC','情報');
define('_CONTACT_SEL','連絡先を選択');
define('_CONTACT_NONE','連絡先詳細の一覧がありません。');
define('_EMAIL_A_COPY','メッセージのコピーを自分宛に送信する');
define('_CONTACT_DOWNLOAD_AS','次のアイテムとして情報をダウンロード:');
define('_VCARD','VCard');
define('_AUTHOR_BY', '寄稿者:');
define('_WRITTEN_BY', '作者:');
define('_LAST_UPDATED', '最終更新日');
define('_BACK','戻る');
define('_LEGEND','説明文');
define('_DATE','日付');
define('_ORDER_DROPDOWN','並び順');
define('_HEADER_TITLE','アイテムタイトル');
define('_HEADER_AUTHOR','作者');
define('_HEADER_SUBMITTED','送信済み');
define('_E_EDIT','編集');
define('_E_ADD','追加');
define('_E_WARNUSER','現在の変更は保存かキャンセルのどちらかにしてください');
define('_E_WARNTITLE','コンテンツアイテムはタイトルが必要です。');
define('_E_WARNCAT','カテゴリを選択してください');
define('_E_CONTENT','コンテンツ');
define('_E_TITLE','タイトル');
define('_E_CATEGORY','カテゴリ');
define('_E_INTRO','紹介文');
define('_E_MAIN','本文');
define('_E_MOSIMAGE','{mosimage}の挿入');
define('_E_IMAGES','画像');
define('_E_GALLERY_IMAGES','ギャラリー画像');
define('_E_CONTENT_IMAGES','コンテンツ画像');
define('_E_EDIT_IMAGE','画像編集');
define('_E_INSERT','挿入');
define('_E_UP','上へ');
define('_E_DOWN','下へ');
define('_E_REMOVE','削除');
define('_E_SOURCE','ソース'); //Source
define('_E_ALIGN','位置'); // Align
define('_E_ALT','Altテキスト');
define('_E_BORDER','ボーダー'); // Border
define('_E_CAPTION','見出し');
define('_E_APPLY','適用');
define('_E_PUBLISHING','掲載');
define('_E_STATE','状態');
define('_E_AUTHOR_ALIAS','作者別名');
define('_E_ACCESS_LEVEL','アクセスレベル');
define('_E_START_PUB','掲載開始日:');
define('_E_FINISH_PUB','掲載終了日:');
define('_E_SHOW_FP','フロントページに表示:');
define('_E_HIDE_TITLE','アイテムのタイトルを非表示:');
define('_E_METADATA','メタデータ');
define('_E_KEYWORDS','キーワード');
define('_E_SUBJECT','件名:');
define('_E_EXPIRES','期限:');
define('_E_VERSION','バージョン:');
define('_E_ABOUT','About');
define('_E_CREATED','作成日:');
define('_E_LAST_MOD','更新日:');
define('_E_HITS','閲覧数');
define('_E_SAVE','保存');
define('_E_REGISTERED','登録済みユーザのみ');
define('_E_ITEM_INFO','アイテム情報');
define('_E_ITEM_SAVED','アイテムの保存に成功しました。');
define('_SECTION_ARCHIVE_EMPTY','現在このセクションにアーカイブされたエントリはありません');
define('_CATEGORY_ARCHIVE_EMPTY','現在このカテゴリにアーカイブされたエントリはありません');
define('_HEADER_SECTION_ARCHIVE','セクションアーカイブ');
define('_HEADER_CATEGORY_ARCHIVE','カテゴリアーカイブ');
define('_ARCHIVE_SEARCH_FAILURE','%s %sにアーカイブされたエントリはありません'); //Note:  values are month then year
define('_ARCHIVE_SEARCH_SUCCESS','%s %sにアーカイブされたエントリがあります');// Note: values are month then year
define('_FILTER','フィルタ');
define('_READ_MORE','続きを読む...');
define('_READ_MORE_REGISTER','続きを読むには登録が必要です...');
define('_MORE','続き...');
define('_ON_NEW_CONTENT', "新しいコンテンツアイテムは「%s」さんによって「%s」というタイトルでセクション「%s」とカテゴリ「%s」から投稿しました" );
define('_SEL_CATEGORY','- 全カテゴリ -');
define('_SEL_SECTION','- 全セクション -');
define('_SEL_AUTHOR','- 全作者 -');
define('_SEL_POSITION','- 全位置 -');
define('_SEL_TYPE','- 全タイプ -');
define('_EMPTY_CATEGORY','このカテゴリは現在空です');
define('_EMPTY_BLOG','表示するアイテムがありません');
define('_NOT_EXIST','あなたがアクセスしようとしているページは存在しません。<br />メインメニューからページを選択してください。');
define('_NO_CATEGORIES','表示するカテゴリがありません！');
define('_ALREADY_LOGIN','あなたは既にログインしています！');
define('_LOGOUT','ログアウトするにはここをクリックします');
define('_LOGIN_TEXT','完全にアクセスをするには向こう側のログインとパスワード欄を使用します');
define('_LOGIN_SUCCESS','ログインに成功しました');
define('_LOGOUT_SUCCESS','ログアウトに成功しました');
define('_LOGIN_DESCRIPTION','このサイトのプライベートエリアへアクセスするにはログインをしてください');
define('_LOGOUT_DESCRIPTION','このサイトのプライベートエリアへ現在ログインしています');
define('_NEW_MESSAGE','新着プライベートメッセージがあります');
define('_MESSAGE_FAILED','ユーザのメールボックスはロックされているためメッセージが送れませんでした。');
define('_ELANG_ASC','昇順');
define('_ELANG_DESC','降順');
define('_ELANG_THEMODULE', 'モジュール');
define('_ELANG_EDITANOTHER', 'は現在別の方によって編集されています。');
define('_ELANG_NEVER', 'Never');
define('_ELANG_NOIMG', '画像なし');
define('_E_NOIMAGES', '画像なし');
define('_E_DBTYPE', 'DBタイプ');
define('_E_DBVERSION', 'DBバージョン');
define('_E_ENABLED', '有効');
define('_E_DISABLED', '無効');
define('_E_LANGUAGES', '言語');
define('_E_POWEREDBY', 'Powered by Elxis 2009');
define('_E_FEED_NAME','フィード名');
define('_E_NUM_ARTICLES','# 記事');
define('_E_FEED_LINK','フィードリンク');
define('_E_SEARCH','検索');
define('_E_SEARCH_KEYWORD','検索キーワード');
define('_E_SEARCH_TOTALF','合計<strong>%d</strong>件ヒットしました。');
define('_E_SEARCH_AT','次で<strong>%s</strong>を検索する:'); //Search for <strong>%s</strong> at
define('_E_NORESULTS','一致するページは見つかりませんでした'); //No results were found
define('_E_IGNORED_KEY','1つ以上の一般的な語句が検索で無視されました');
define('_E_ANYWORDS','いずれかの語句を含む');
define('_E_ALLWORDS','全ての語句を含む');
define('_E_PHRASE','含めない');
define('_E_NEWEST_FIRST','新しいものを最初に');
define('_E_OLDEST_FIRST','古いものを最初に');
define('_E_MOST_POPULAR','一番人気のもの');
define('_E_ALPHABETICAL','アルファベット順');
define('_E_SECTIONCATEG','セクション/カテゴリ');
define('_WEBLINKS_TITLE','ウェブリンク');
define('_E_WEBLINKS_DESC','以下の一覧からウェブリンクのカテゴリの一つを選択して、次にURLを選択してサイトを訪れてください。');
define('_E_WEBLINK','ウェブリンク');
define('_E_SECTION','セクション');
define('_E_SUBMIT_LINK','ウェブリンクを送信');
define('_E_URL','URL');
define('_E_THEWEBLINK', 'ウェブリンク');
define('_E_MUSTURL', 'URLが必要です');
define('_E_ALL_LANGUAGES', '全言語');
define('_E_SCREENSHOT', 'スクリーンショット');
define('_E_TIME','時間');
define('_E_MEMBERS','メンバー');
define('_E_NEWS','ニュース');
define('_E_LINKS','ウェブリンク');
define('_E_VISITORS','訪問者');
define('_E_WE_HAVE', '現在');
define('_E_AND', 'と');
define('_E_GUEST_COUNT','1人のゲスト');
define('_E_GUESTS_COUNT','%s人のゲスト');
define('_E_MEMBER_COUNT','1人のメンバー');
define('_E_MEMBERS_COUNT','%s人のメンバー');
define('_E_ONLINE','がオンラインです。');
define('_E_NO_ONLINE','オンラインのユーザはいません');
define('_NOT_AUTH','このリソースを閲覧する権限がありません。');
define('_DO_LOGIN','ログインする必要があります。');
define('_HIGHER_ACCESS', 'このリソースはあなたより高いアクセスレベルを必要とします。');
define('_VALID_AZ09',"有効な%sを入力してください。スペースを含めない%d文字以上の英数字のみ含めることができます。");  //USE GEMINI, REMOVE IN 2007
define('_CMN_SHOW','表示');
define('_CMN_HIDE','非表示');
define('_CMN_NAME','名前');
define('_CMN_DESCRIPTION','説明');
define('_CMN_SAVE','保存');
define('_CMN_PRINT','印刷');
define('_CMN_PDF','PDF');
define('_CMN_EMAIL','メールアドレス');
define('_ICON_SEP','|');
define('_CMN_PARENT','親');
define('_CMN_ORDERING','並び順');
define('_CMN_ACCESS','アクセスレベル');
define('_CMN_SELECT','選択');
define('_CMN_NEXT','次へ');
define('_CMN_NEXT_ARROW'," &gt;&gt;");
define('_CMN_PREV','前へ');
define('_CMN_PREV_ARROW',"&lt;&lt; ");
define('_CMN_SORT_NONE','ソートなし');
define('_CMN_SORT_ASC','昇順でソート');
define('_CMN_SORT_DESC','降順でソート');
define('_CMN_NEW','新規');
define('_CMN_ARCHIVE','アーカイブ');
define('_CMN_UNARCHIVE','非アーカイブ'); //Unarchive
define('_CMN_TOP','トップ');
define('_CMN_BOTTOM','ボトム');
define('_CMN_PUBLISHED','掲載');
define('_CMN_UNPUBLISHED','未掲載');
define('_CMN_EDIT_HTML','HTML編集');
define('_CMN_EDIT_CSS','CSS編集');
define('_CMN_DELETE','削除');
define('_CMN_FOLDER','フォルダ');
define('_CMN_SUBFOLDER','サブフォルダ');
define('_CMN_OPTIONAL','任意');
define('_CMN_REQUIRED','必須');
define('_CMN_CONTINUE','続ける');
define('_CMN_NEW_ITEM_LAST','新しいアイテムはデフォルトで最後の場所になります。このアイテムが保存された後に並び準を変更することができます。');
define('_CMN_NEW_ITEM_FIRST','新しいアイテムはデフォルトで最初の場所になります。このアイテムが保存された後に並び準を変更することができます。');
define('_LOGIN_INCOMPLETE','ユーザ名とパスワードを入力してください。');
define('_LOGIN_BLOCKED','あなたのログインはブロックされています。管理者に問い合わせてください。');
define('_LOGIN_INCORRECT','ユーザ名かパスワードが不正です。再試行してください。');
define('_LOGIN_NOADMINS','ログインできません。管理者が設定されていません。');
define('_CMN_JAVASCRIPT','！警告！Javascriptは適切な操作のために有効にしなければなりません。');
define('_CMN_IFRAMES', 'このオプションは現在動作していません。残念ながら、あなたのブラウザはインラインフレームをサポートしていません');
define('_INSTALL_WARN','セキュリティのために全てのファイルとサブフォルダを含むインストールディレクトリを削除してください。それからこのページを更新してください。');
define('_TEMPLATE_WARN','<span style="color:#F00; font-weight:bold;">テンプレートファイルが見つかりませんでした！テンプレートを探した場所:</span>');
define('_HANDLER','ハンドラはタイプに定義されていません');
define('_E_SELIMAGE','画像の選択');
define('_TOC_JUMPTO','記事インデックス');
define('_E_SECTION_LIST','セクション一覧');
define('_E_SECTION_BLOG','セクションBlog');
define('_E_CATEGORY_LIST','カテゴリ一覧');
define('_E_CATEGORY_BLOG','カテゴリBlog');
define('_BUTTON_VOTE','投票');
define('_BUTTON_RESULTS','結果');
define('_USERNAME','ユーザ名');
define('_LOST_PASSWORD','パスワードを忘れましたか？');
define('_PASSWORD','パスワード');
define('_BUTTON_LOGIN','ログイン');
define('_BUTTON_LOGOUT','ログアウト');
define('_NO_ACCOUNT','アカウントがありません？');
define('_CREATE_ACCOUNT','アカウントの作成');
define('_VOTE_POOR','最低');
define('_VOTE_BEST','最高');
define('_USER_RATING','ユーザ評価');
define('_RATE_BUTTON','評価');
define('_REMEMBER_ME','IDとパスワードを保存する');
define('_PN_PAGE','ページ');
define('_PN_OF',' / ');
define('_PN_START','最初');
define('_PN_END','終わり');
define('_PN_DISPLAY_NR','表示数');
define('_PN_RESULTS','結果');
define('_EMAIL_TITLE','友達にメールする');
define('_EMAIL_FRIEND','友達にこれをメールします。');
define('_EMAIL_FRIEND_ADDR','友達のメールアドレス');
define('_EMAIL_YOUR_NAME','あなたの名前');
define('_EMAIL_YOUR_MAIL','あなたのメールアドレス');
define('_SUBJECT_PROMPT',' 件名');
define('_BUTTON_SUBMIT_MAIL','送信');
define('_EMAIL_ERR_NOINFO','受取人とあなた自身の有効なメールアドレスを入力してください。');
define('_EMAIL_MSG','以下のページはウェブサイト「%s」から%s(%s)さんによって送信されました。
以下のURLから開く背することができます:
%s');
define('_EMAIL_INFO','アイテム送信者:');
define('_EMAIL_SENT','このアイテムは次の方へ送信されました:');
define('_PROMPT_CLOSE','ウィンドウを閉じる');
define('_E_ALERT_ENABLED','クッキーを有効にしてください！');
define('_ALREADY_VOTE','本日分の投票を既に行っています！');
define('_E_NO_SELECTION','何も選択されていません。再試行してください。');
define('_THANKS','投票ありがとうございます！');
define('_E_SELECT_POLL','一覧から投票を選択');
define('_JAN','1月');
define('_FEB','2月');
define('_MAR','3月');
define('_APR','4月');
define('_MAY','5月');
define('_JUN','6月');
define('_JUL','7月');
define('_AUG','8月');
define('_SEP','9月');
define('_OCT','10月');
define('_NOV','11月');
define('_DEC','12月');
define('_POLL_TITLE','投票 - 結果');
define('_SURVEY_TITLE','投票タイトル:');
define('_E_NUM_VOTERS','投票者数');
define('_E_FIRST_VOTE','最初の投票');
define('_E_LAST_VOTE','最後の投票');
define('_E_SEL_POLL','投票を選択:');
define('_E_NOPOLL_RESULTS','この投票には結果がありません');
define('_E_ERROR_PASS','すみませんが、一致するユーザは見つかりませんでした');
define('_E_NEWPASS_MSG','これはユーザアカウント$checkusernameに関連したメールです。\n'
.'$mosConfig_live_siteからウェブユーザが新しいパスワードを発行したところです。\n\n'
.' 新しいパスワード: $newpass\n\nこれについて尋ねなくても心配しないでください。'
.' それらではなくこのメッセージを見てください。これがエラーなら新しいパスワードですぐにログインをして、'
.'パスワードの変更をしてください。');
define('_E_NEWPASS_SUB','%s さんの新しいパスワード');
define('_E_NEWPASS_SENT','新しいパスワードを生成して送信しました！');
define('_E_REGWARN_NAME','名前を入力してください。'); //USE GEMINI, should be removed
define('_E_REGWARN_UNAME','ユーザ名を入力してください。'); //USE GEMINI, should be removed
define('_E_REGWARN_MAIL','有効なメールアドレスを入力してください。'); //USE GEMINI, should be removed
define('_REGWARN_PASS','有効なパスワードを入力してください - 6文字以上で空白を除く英数字のみ含めることができます。');
define('_E_REGWARN_VPASS1','パスワードを確認してください。');
define('_E_REGWARN_VPASS2','パスワードが一致しません。再試行してください。');
define('_E_REGWARN_INUSE','このユーザ名/パスワードは既に使用されています。別のものを試してください。'); //USE GEMINI, should be removed
define('_E_REGWARN_EMAIL_INUSE', 'このメールアドレスは既に登録済みです。パスワードを忘れたのなら「パスワードリマインダー」をクリックして新しいパスワードを送信してもらうことができます。'); //USE GEMINI, should be removed
define('_E_SEND_SUB','%sさんのアカウント詳細 %s');
define('_USEND_MSG_ACTIVATE', 'こんにちわ%sさん。

%sへの登録ありがとうございます。
あなたのアカウントは作成されましたが、以下のURLをコピーアンドペーストで
ブラウザに貼り付けてページを表示させ、アカウントを有効にする必要があります。
%s

有効にした後に以下のユーザ名とパスワードを使用して
%s
にログインすることができるようになります:

ユーザ名 - %s
パスワード - %s');
define('_USEND_MSG', "こんにちわ%sさん。

%sへのご登録ありがとうございます。

登録したユーザ名とパスワードを使用して%sへ今すぐログインできます。");
define('_USEND_MSG_NOPASS','こんにちわ$nameさん。

あなたは$mosConfig_live_siteへユーザとして追加されました。
登録したユーザ名とパスワードで%mosConfig_live_siteへログインすることができます。

このメールは自動送信メールのため、返信しないでください。');
define('_ASEND_MSG','こんにちわ %sさん。

新しいユーザが%sへ登録されました。
これはその詳細を含むメールです:

名前           - %s
メールアドレス - %s
ユーザ名       - %s

このメールは自動送信メールのため、返信しないでください。');
define('_REG_COMPLETE', '登録完了');
define('_REG_NOWLOGIN', 'すぐにログインできます。');
define('_REG_COMPLETE_ACTIVATE', 'あなたのアカウントは作成され、入力されたメールアドレスへアカウントを有効にするためのリンクを送信しました。'
.'ログインできるようにするにはそのメールに記載されたリンクを訪れてアカウントを有効にしなければならないことに注意してください。');
define('_REG_ACTIVATE_COMPLETE', '有効化完了！');
define('_REG_ACACTNOWLOGIN', 'アカウントの有効化に成功しました。すぐに登録をしたユーザ名とパスワードでログインすることができます。');
define('_REG_COMPLETE_NOPASS','登録完了<br />今すぐログインできます。'); //Is this used?
define('_REG_ACTIVATE_NOT_FOUND', '不正な有効化リンクです！データベースにそのようなアカウントは無いか、アカウントは既に有効化されています。');
define('_REG_TRYAGAIN_SECS', 'しばらくしてから再試行してください！');
define('_E_LOSTPASS','パスワードをお忘れですか？');
define('_NEW_PASS_DESC','ユーザ名とメールアドレスを入力してからパスワード送信ボタンをクリックしてください。'
.'すぐに新しいパスワードを送信します。サイトへアクセスをして新しいパスワードでログインしなおしてください。');
define('_BUTTON_SEND_PASS','パスワード送信');
define('_E_REGISTRATION','登録');
define('_E_FIELDS_REQUIRED','アスタリスク(*)でマークされたフィールドは必須項目です。');
define('_E_SEND_REG','登録を送信');
define('_SENDING_PASSWORD','パスワードは上のメールアドレスへ送信されました。<br />一旦新しいパスワードを受け取ってログインすることや'
.'パスワードの変更を行うことができます。');
define('_NEWSFLASH_BOX','ニュース速報！');
define('_MAINMENU_BOX','メインメニュー');
define('_UMENU_TITLE','ユーザメニュー');
define('_E_HI','ようこそ');
define('_SAVE_ERR','全てのフィールドを埋めてください。');
define('_THANK_SUB','送信ありがとうございます。サイトへ投稿される前にレビューされます。');
define('_E_UPSIZE','15KBより大きいサイズのファイルをアップロードすることはできません。');
define('_E_UPEXISTS','画像$userfile_nameは既に存在します。ファイル名を変えて再試行して下さい。');
define('_E_UPCOPY_FAIL','コピーに失敗しました。');
define('_E_UPTYPE_WARN','アップロードできる画像はgif/jpg/png/jpegのみです。');
define('_MAIL_SUB','ユーザ送信済み'); //User Submitted
define('_E_NEWSUBBY', 'ユーザ%sによって作られた新しい送信。'); //A new submission made by user %s
define('_E_TYPESUB', '送信のタイプ:');
define('_E_LOGINAPPR', 'この送信を承認及び閲覧するためにサイト管理へログインします。');
define('_E_DONTRESPOND', 'このメールは自動送信のため、返信しないでください。');
define('_PASS_VERR1','パスワードを変更する場合、確認のために再度パスワードを入力してください。');
define('_PASS_VERR2','パスワードを変更する場合、パスワードと確認が一致していることを確認してください。');
define('_UNAME_INUSE','このユーザ名は既に使用されています。');
define('_E_UPDATE','更新');
define('_E_USRDET_SAVED','設定を保存しました。');
define('_USER_LOGIN','ユーザログイン');
define('_E_ALL','全て');
define('_E_LOGGEDIN','ログイン');
define('_E_PROF_NOTEXIST','要求されたプロフィールは存在しません！');
define('_E_REQFIELDS_EMPTY','1つ以上の必須項目が空です');
define('_E_EDIT_YDETAILS','詳細を編集');
define('_E_VERIFY_PASS','パスワードの確認');
define('_E_SUBMIT_SUC','送信に成功しました！');
define('_E_SUBMIT_SUCDESC','アイテムはサイト管理者へ送信されました。サイト上に掲載される前にレビューされます。');
define('_E_WELCOME','ようこそ！');
define('_E_WELCOME_DESC','私たちのサイトのユーザセクションへようこそ');
define('_E_ALL_CHECKED_IN','全てのチェックアウトされたアイテムはチェックインしました');
define('_E_CHECK_TABLE','テーブルをチェック');
define('_E_CHECKED_IN','チェックイン ');
define('_CHECKED_IN_ITEMS',' 個のアイテム');
define('_E_PASS_MATCH','パスワードが一致しません');
define('_E_VIEW_PROFILE','プロフィールの閲覧');
define('_E_MEMBERS_LIST','メンバー一覧');
define('_E_USER_PROFILE','ユーザプロフィール');
define('_E_REGDATE','登録日');
define('_E_EDIT_PROFILE','プロフィールの編集');
define('_MAINMENU_HOME','※ このメニュー【mainmenu】で最初に掲載されたアイテムはサイトのデフォルトの「ホームページ」になります。'); //Is this needed in front-end?
define('_MAINMENU_DEL','※ このメニューはElxisの適切な操作のために必須のため削除することはできません。'); //Is this needed in front-end?
define('_MENU_GROUP','※ いくつかの「メニュータイプ」は一つ以上のグループで表示されています。'); //Is this needed in front-end?
define('_E_SECCODE', 'セキュリティコード');
define('_E_TYPE_SECCODE', 'セキュリティコードを入力');
define('_E_INV_SECCODE', '不正なセキュリティコードです！');
define('_E_LANGUAGE', '言語');
define('_REG_VISITPROF', 'ログインするときに個人情報を編集するためにプロフィールページを訪れてください');
define('_E_PREFLANG', '望ましい言語');
define('_E_STATUS', 'ステータス');
define('_E_AVATAR', 'アバター');
define('_E_UPLOADNEW', '新しくアップロード');
define('_E_WEBSITE', 'ウェブサイト');
define('_E_BIRTHDATE', '誕生日');
define('_E_GENDER', '性別');
define('_E_MALE', '男性');
define('_E_FEMALE', '女性');
define('_E_LOCATION', '所在地');
define('_E_OCCUPATION', '職業');
define('_E_SIGNATURE', '署名');
define('_ELX_ERROR', 'エラー');
define('_ELX_WARNING', '警告');
define('_REG_INVACTLINK', '不正な有効化リンクです！');
define('_E_BASICINFO', '基本情報');
define('_E_ADDINFO', '追加情報');
define('_E_USERGROUP', 'ユーザグループ');
define('_E_AGE', '年齢');
define('_E_WEHAVEREG', '合計<b>%s</b>人の登録済みユーザがいます。');
define('_E_CLTOGGLORD', '並び順を変更するには欄ヘッダをクリックします。昇順と降順を切り替えるには再度クリックします。');
define('_E_RANDOMUSERS', 'ランダムユーザ');
define('_E_USERSAREA', 'ユーザエリア');
define('_E_WEBLINKNA','ウェブリンクを送信する許可がありません！');
define('_E_WEBLINKADDH','新しいウェブリンクを送信するために以下のフォームを使用します。');
define('_E_REGDISABLED', 'ユーザ登録は無効です！');
define('_E_NOREMPASS', 'プロフィール編集ページからパスワードを変更することを忘れないでください。');
define('_E_RPASS_NADMIN', 'ユーザ%sがパスワードを思い出させるフォームを送信しました。新しいパスワードは生成され、ユーザへ送信されます。'
.'この通知を受け取りたくない場合、ソフトディスクのUSERS_RPASSMAILパラメータをいいえに変更します。');
define('_E_NOCPASSADM', '安全のため、パスワードリマインダーを使用してパスワードのリセットすることを最高管理者に許可していません。'
.'phpMyAdminやphpPgAdminのようなデータベースマネージャを使用して行ってください。');
define('_E_ACCACTIV', 'アカウント有効化');
define('_CONTACT_NOFOUND', '要求された連絡先は見つからなかったかアクセスする許可がありませんでした。');
define('_PAGE_NOFOUND', '要求されたページは見つからなかったかアクセスする許可がありませんでした。');
define('_POLL_NOPOLLS', '投票はありません');
define('_POLL_VOTES', '投票');
define('_POLL_PAST', '過去の投票');
define('_POLL_LOCKALERT', '過去の投票はこの投票で許可されていません。');
define('_POLL_POLLS', '投票');
define('_E_PAGE_NOTFOUND', '申し訳ありませんが要求されたページは見つかりませんでした。');
define('_E_RETURNHOME', 'ホームページへ戻る');
define('_E_VISITURLS', '以下のページのどれかを訪れる');
define('_E_RELLINKS', '関連するリンク');
define('_E_RATING_NOALLOW','記事の評価は許可されていません！');
define('_E_VOTE_OUTRATE','あなたの投票は有効な投票の中にありません！');
define('_E_VOTE_INVALID','アクセスする許可が無い又は存在しない記事へ投票しようとしました。');
define('_E_CONTENTSUB','コンテンツ送信');
define('_E_CONTENTSUBD1','ウェブサイトのこのエリアでは新しい記事の追加又は既存の記事の編集を行うことができます。');
define('_E_CONTENTSUBD2','一旦記事がサイト管理者によって掲載されると、編集はできません！');
define('_E_SUBCON_NOALL','コンテンツを送信する許可がありません！');
define('_E_CURARTICLYOU','現在私たちのウェブサイトであなたによって書かれた記事が<strong>%d</strong>件あります。');
define('_E_SUBCONWAIT','送信された記事の承認待ち:');
define('_E_LASTPUBART','最近の5件の掲載された記事:');
define('_E_ADDCONTENT','コンテンツの追加');
define('_E_EDITCONTENT','コンテンツの編集');
define('_E_SUGSECTION','提案されたセクション');
define('_E_SUGCATEGORY','提案されたカテゴリ');
define('_E_COMMENTS','コメント');
define('_E_REGAGREE','登録規約');
define('_E_AGREE_REGTERM','登録規約に同意します。');
define('_E_MUSTC_RAGREE','登録規約に同意しなければなりません！');
define('_E_AUTONOMOUSPG','独立ページ');
define('_E_ARCHIVED','アーカイブ済み');
define('_E_CHECKIN','チェックイン');
define('_E_ALSOREAD','さらに読む'); //Also read
define('_E_SPELL','スペル');

//elxis 2008.1
define('_E_SYNDICATE','Syndicate');
define('_E_LATESTNEWS','Latest News');
define('_E_STATISTICS','Statistics');
define('_E_WHOSONLINE','Who\'s online');
define('_E_CHOOSETEMP','Choose template');
define('_E_SECTIONS','Sections');
define('_E_RANDOMIMG','Random image');
define('_E_BANNERS','Banners');
define('_REG_COMPLETE_MANACT', 'Your account has been created. Before you login a site administrator must manually 
approve your registration. You will be notified via e-mail when this happens.');

//elxis 2009.0
define('_E_COMMENT', 'Comment'); //(noun, i.e. 1 comment)
define('_E_VISITOR', 'Visitor');
define('_E_NOCOMMENTS', 'There are no comments.');
define('_E_FIRSTCOMMENT', 'Be the first to comment this article!');
define('_E_MUSTLOGTOCOM', 'You must first login to post comments.');
define('_E_POSTCOMMENT', 'Post a comment');
define('_E_COMCNOTEMPTY', 'Your comment can not be empty!');
define('_E_COMPUBREV', 'Your comment will be published after review');
define('_E_ACCOUNT_EXPIRED', 'Your account has been expired!');
define('_E_ACCOUNT_EXPDATE', 'Account expiration date');

?>