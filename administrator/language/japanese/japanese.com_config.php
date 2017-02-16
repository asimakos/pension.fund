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
* @description: Japanese language for component config
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'この場所への直接アクセスは許可されていません。' );


class adminLanguage extends standardLanguage {

	public $A_COMP_CONF_OFFLINE = 'サイトをオフラインにする';
	public $A_COMP_CONF_OFFMESSAGE = 'オフラインメッセージ';
	public $A_COMP_CONF_TIP_OFFMESSAGE = 'サイトがオフラインのときに表示するメッセージです';
	public $A_COMP_CONF_ERR_MESSAGE = 'システムエラーメッセージ';
	public $A_COMP_CONF_TIP_ERR_MESSAGE = 'データベースへ接続できなかったときに表示するメッセージです';
	public $A_COMP_CONF_SITE_NAME = 'サイト名';
	public $A_COMP_CONF_UN_LINKS = '未承認リンクを表示';
	public $A_COMP_CONF_UN_TIP = '「はい」なら、ログインしていなくても登録されたコンテンツへのリンクを表示します。ユーザはアイテムを全て見るためにはログインする必要があります。';
	public $A_COMP_CONF_USER_REG = 'ユーザ登録を許可';
	public $A_COMP_CONF_TIP_USER_REG = '「はい」なら、ユーザが自身で登録できるようになります';
	public $A_COMP_CONF_REQ_EMAIL = '同一メールアドレスの禁止'; //Require Unique Email
	public $A_COMP_CONF_REQTIP = '「はい」なら、ユーザは同じメールアドレスを使用してアカウントを作成することはできません';
	public $A_COMP_CONF_DEBUG = 'デバッグ'; //Debug Site
	public $A_COMP_CONF_DEBTIP = '「はい」なら、存在する診断情報とSQLエラーを表示します';
	public $A_COMP_CONF_EDITOR = 'WYSIWYGエディタ';
	public $A_COMP_CONF_LENGTH = '一覧の長さ';
	public $A_COMP_CONF_LENTIP = '全てのユーザのために管理内で一覧の省略時の長さを設定します';
	public $A_COMP_CONF_FAV_ICON = 'お気に入りアイコン';
	public $A_COMP_CONF_FAVTIP = '空白にするかファイルが見つからない場合、デフォルトのfavicon.icoが使用されます';
	public $A_COMP_CONF_CLINKACC = 'アクセスシステムでリンクされるコンポーネント';
	public $A_COMP_CONF_CLACCDESC = 'フロントエンドのアクセス管理システムに適用したいコンポーネントのタイプを選択してください(ACO 値 = view) よくわからないならヘルプファイルを読んでください。';
	public $A_COMP_CONF_CORECOMPS = 'コアコンポーネント';
	public $A_COMP_CONF_3RDCOMPS = 'サードパーティ製コンポーネント';
	public $A_COMP_CONF_ALLCOMPS = '全てのコンポーネント';
	public $A_COMP_CONF_CAPTCHA = 'セキュリティ画像の使用';
	public $A_COMP_CONF_CAPTCHATIP = 'サイトのフォームにセキュリティ画像(Captcha)を表示したいならはいにしてください。更に、単語の綴り機能は利用する方に見えやすくするように設定することが可能です。';
	public $A_COMP_CONF_LOCALE = 'ロケール'; //Locale
	public $A_COMP_CONF_LANG = 'デフォルトのフロントエンド言語';
	public $A_COMP_CONF_ALANG = 'デフォルトのバックエンド言語';
	public $A_COMP_CONF_TIME_SET = '時刻同期'; //Time Offset
	public $A_COMP_CONF_DATE = '現在の日付を表示するための設定です';
	public $A_COMP_CONF_LOCAL = '国ロケール'; //Country Locale
	public $A_COMP_CONF_LOCRECOM = '自動選択にすることをお勧めします。ElxisはOSシステムと選択された言語の最も適切な言語を読み込みます。WindowsはUTF-8をサポートしません。';
	public $A_COMP_CONF_LOCCHECK = 'ロケールチェック'; //Locale Check
	public $A_COMP_CONF_LOCCHECK2 = 'この日付が正常なフォーマットであるならシステムと言語でロケールは大丈夫です。<br /><strong>注意！</strong>Windowsではロケールは自動的に英語に設定されます。';
	public $A_COMP_CONF_AUTOSEL = '自動選択';
	public $A_COMP_CONF_CONTROL = '* これらのパラメータは出力要素をコントロールします *';
	public $A_COMP_CONF_LINK_TITLES = 'タイトルのリンク'; //Linked Titles
	public $A_COMP_CONF_LTITLES_TIP = '「はい」なら、コンテンツアイテムのタイトルにトップページへのリンクが貼られます';
	public $A_COMP_CONF_MORE_LINK = '「続きを読む」のリンク';
	public $A_COMP_CONF_MLINK_TIP = '表示に設定する場合、本文にアイテムがある時に「続きを読む」のリンクを表示します';
	public $A_COMP_CONF_RATE_VOTE = 'アイテムの評価/投票';
	public $A_COMP_CONF_RVOTE_TIP = '表示に設定する場合、投票システムがコンテンツアイテムで有効になります';
	public $A_COMP_CONF_AUTHOR = '作者名';
	public $A_COMP_CONF_AUTHORTIP = '表示に設定する場合、作者の名前を表示します。これは全般設定ですが、アイテムレベルとメニューで変更することができます';
	public $A_COMP_CONF_CREATED = '作成日と時刻';
	public $A_COMP_CONF_CREATEDTIP = '表示に設定する場合、アイテムが作成された日付と時刻を表示します。これは全般設定ですが、アイテムレベルとメニューで変更することができます';
	public $A_COMP_CONF_MOD_DATE = '更新日と時刻';
	public $A_COMP_CONF_MDATETIP = '表示に設定する場合、アイテムが最後に更新された日付と時刻を表示します。これは全般設定ですが、アイテムレベルとメニューで変更することができます';
	public $A_COMP_CONF_HITS = 'ヒット数';
	public $A_COMP_CONF_HITSTIP = '表示に設定する場合、特定のアイテムへのヒット数をカウントします。これは全般設定ですが、アイテムレベルとメニューで変更することができます';
	public $A_COMP_CONF_PDF = 'PDFアイコン';
	public $A_COMP_CONF_OPT_MEDIA = 'オプションは/tmprディレクトリが書き込み不可のため利用できません';
	public $A_COMP_CONF_PRINT_ICON = '印刷アイコン';
	public $A_COMP_CONF_EMAIL_ICON = 'メールアイコン';
	public $A_COMP_CONF_ICONS = 'アイコン';
	public $A_COMP_CONF_USE_OR_TEXT = '印刷、RTF、PDF及びメールはアイコンかテキストを利用します。';
	public $A_COMP_CONF_TBL_CONTENTS = '複数ページのアイテム上の目次'; //Table of Contents on multi-page items
	public $A_COMP_CONF_BACK_BUTTON = '戻るボタン';
	public $A_COMP_CONF_CONTENT_NAV = 'コンテンツアイテムのナビゲーション'; //Content Item Navigation
	public $A_COMP_CONF_HYPER = 'リンクされたタイトルを使用'; //Use Hyperlinked Titles
	public $A_COMP_CONF_DBTYPE = 'データベースタイプ';
	public $A_COMP_CONF_DBWARN = 'システムがこのデータベースをサポートしていないなら変更したりElxisデータのコピーをこのデータベース上にインストールしないでください！';
	public $A_COMP_CONF_HOSTNAME = 'ホスト名';
	public $A_COMP_CONF_DB_PW = 'パスワード';
	public $A_COMP_CONF_DB_NAME = 'データベース';
	public $A_COMP_CONF_DB_PREFIX = 'データベースプレフィックス'; //Database Prefix
	public $A_COMP_CONF_NOT_CH = '!! 設定したプレフィックスと共にテーブルを使用してデータベースを構築していないなら変更しないでください !!';
	public $A_COMP_CONF_ABS_PATH = '物理パス';
	public $A_COMP_CONF_LIVE = 'サイトURL'; //Live Site
	public $A_COMP_CONF_SECRET = '秘密の合言葉'; //Secret Word
	public $A_COMP_CONF_GZIP = 'GZIPページ圧縮';
	public $A_COMP_CONF_CP_BUFFER = 'サポートしているならバッファされた出力を圧縮します';
	public $A_COMP_CONF_SESSION_TIME = 'ログインセッション有効時間';
	public $A_COMP_CONF_SEC = '秒';
	public $A_COMP_CONF_AUTO_LOGOUT = 'この期間アクティブでない場合自動的にログアウトします'; //Auto logout after this time period of inactivity
	public $A_COMP_CONF_ERR_REPORT = 'エラーレポート';
	public $A_COMP_CONF_HELP_SERVER = 'ヘルプサーバ';
	public $A_COMP_CONF_META_PAGE = 'メタデータページ';
	public $A_COMP_CONF_META_DESC = 'サイト全体のメタデータの説明';
	public $A_COMP_CONF_META_KEY = 'サイト全体のメタデータのキーワード';
	public $A_COMP_CONF_HPS1 = 'ローカルのヘルプファイル';
	public $A_COMP_CONF_HPS2 = 'Elxisリモートヘルプサーバ';
	public $A_COMP_CONF_HPS3 = 'Elxis公式ヘルプサーバ';
	public $A_COMP_CONF_PERMFLES = '新しいファイルに許可フラグを定義するにはこのオプションを選択します';
	public $A_COMP_CONF_PERMDIRS = '新しいディレクトリに許可フラグを定義するにはこのオプションを選択します';
	public $A_COMP_CONF_NCHMODDIRS = '新しいディレクトリをCHMODしない(サーバのデフォルトを使用する)';
	public $A_COMP_CONF_CHAPFLAGS = 'ここをチェックするとサイトの<em>全ての既存のファイル</em>に許可フラグを適用します。<br /><strong>このオプションを誤って使用するとサイトが利用できなくなるかもしれません！</strong>';
	public $A_COMP_CONF_CHAPDLAGS = 'ここをチェックするとサイトの<em>全ての既存のディレクトリ</em>に許可フラグを適用します。<br /><strong>このオプションを誤って使用するとサイトが利用できなくなるかもしれません！</strong>';
	public $A_COMP_CONF_APPEXDIRS = '既存のディレクトリに適用';
	public $A_COMP_CONF_APPEXFILES = '既存のファイルに適用';
	public $A_COMP_CONF_WORLD = 'その他';
	public $A_COMP_CONF_CHMODNDIRS = '新しいディレクトリをCHMOD';
	public $A_COMP_CONF_MAIL = 'メーラー';
	public $A_COMP_CONF_MAIL_FROM = '差出人メールアドレス'; //Mail From
	public $A_COMP_CONF_MAIL_FROM_NAME = '差出人名';
	public $A_COMP_CONF_MAIL_SMTP_AUTH = 'SMTP認証';
	public $A_COMP_CONF_MAIL_SMTP_USER = 'SMTPユーザ';
	public $A_COMP_CONF_MAIL_SMTP_PASS = 'SMTPパスワード';
	public $A_COMP_CONF_MAIL_SMTP_HOST = 'SMTPホスト';
	public $A_COMP_CONF_CACHE = 'キャッシュ'; //Caching
	public $A_COMP_CONF_CACHE_FOLDER = 'キャッシュフォルダ';
	public $A_COMP_CONF_CACHE_DIR = '現在のキャッシュディレクトリは';
	public $A_COMP_CONF_CACHE_DIR_UNWRT = 'キャッシュディレクトリは書き込み不可です - キャッシュをオンにする前にディレクトリの権限を777にしてください';
	public $A_COMP_CONF_CACHE_TIME = 'キャッシュ時間';
	public $A_COMP_CONF_STATS = '統計';
	public $A_COMP_CONF_STATS_ENABLE = 'サイト統計の収集を有効/無効';
	public $A_COMP_CONF_STATS_LOG_HITS = '日付でのコンテンツヒット数のログ'; //Log Content Hits by Date
	public $A_COMP_CONF_STATS_WARN_DATA = '警告 : 大量のデータが収集されます。'; //Large amounts of data will be collected
	public $A_COMP_CONF_STATS_LOG_SEARCH = 'ログ検索文字列'; //Log Search Strings
	public $A_COMP_CONF_SEO_LBL = 'SEO';
	public $A_COMP_CONF_SEO = '検索エンジン最適化';
	public $A_COMP_CONF_SEO_SEFU = '検索エンジンにやさしいURL';
	public $A_COMP_CONF_SEOBASIC = 'SEOベーシック';
	public $A_COMP_CONF_SEOPRO = 'SEOプロ';
	public $A_COMP_CONF_SEOHELP = 'ApacheとIISです。Apache: 有効にする(mod_rewriteを有効にする)前にhtaccess.txtを.htaccessへリネームします。IIS: Ionic Isapi Rewriterフィルタを使用します。パフォーマンスを最大にするために、SEOプロに切り替える前にコンテンツを準備します。サードパーティ製SEFコンポーネントを使用したいなら、SEOベーシックを選択します。';
	public $A_COMP_CONF_SERVER = 'サーバ';
	public $A_COMP_CONF_METADATA = 'メタデータ';
	public $A_COMP_CONF_CACHE_TAB = 'キャッシュ';
	public $A_COMP_CONF_FTP_LBL = 'FTP';
	public $A_COMP_CONF_FTP = 'FTP設定';
	public $A_COMP_CONF_FTP_ENB = 'FTPを有効にする';
	public $A_COMP_CONF_FTP_HST = 'FTPホスト';
	public $A_COMP_CONF_FTP_HSTTP = '恐らく'; //Most probably
	public $A_COMP_CONF_FTP_USR = 'FTPユーザ名';
	public $A_COMP_CONF_FTP_USRTP = '恐らく'; //Most probably
	public $A_COMP_CONF_FTP_PAS = 'FTPパスワード';
	public $A_COMP_CONF_FTP_PRT = 'FTPポート';
	public $A_COMP_CONF_FTP_PRTTP = 'デフォルト値は: 21';
	public $A_COMP_CONF_FTP_PTH = 'FTPルートパス';
	public $A_COMP_CONF_FTP_PTHTP = 'Elxisをインストールした場所へのFTPのルートパス。例：/public_html/elxis';
	public $A_COMP_CONF_HIDE = '非表示';
	public $A_COMP_CONF_SHOW = '表示';
	public $A_COMP_CONF_DEFAULT = 'システムのデフォルト';
	public $A_COMP_CONF_NONE = 'なし';
	public $A_COMP_CONF_SIMPLE = 'シンプル';
	public $A_COMP_CONF_MAX = '最大';
	public $A_COMP_CONF_MAIL_FC = 'PHPメール機能';
	public $A_COMP_CONF_SEND = 'Sendmail';
	public $A_COMP_CONF_SENDP = 'Sendmailパス';
	public $A_COMP_CONF_SMTP = 'SMTPサーバ';
	public $A_COMP_CONF_UPDATED = '設定の詳細を<strong>更新しました！</strong>';
	public $A_COMP_CONF_ERR_OCC = '<strong>エラーが発生しました！</strong> 設定ファイルを開けませんでした！';
	public $A_COMP_CONF_READ = '読込';
	public $A_COMP_CONF_WRITE = '書込';
	public $A_COMP_CONF_EXEC = '実行';
	public $A_COMP_CONF_FCRE = 'ファイルの作成';
	public $A_COMP_CONF_FPERM = 'ファイルの権限';
	public $A_COMP_CONF_DCRE = 'ディレクトリの作成';
	public $A_COMP_CONF_DPERM = 'ディレクトリの権限';
	public $A_COMP_CONF_OFFEX = 'はい(最高管理者を除く)';
	public $A_COMP_CONF_RTF = 'RTFアイコン';

	//elxis 2008.1
	public $A_C_CONF_AC_ACT = 'Account Activation';
	public $A_C_CONF_NOACT = 'No activation';
	public $A_C_CONF_EMACT = 'Activation via e-mail';
	public $A_C_CONF_MANACT = 'Manual activation';
	public $A_C_CONF_AC_ACTD = 'Select how you wish new user accounts to be activated. Directly, via activation link in e-mail or manually by the site administrator.';

	//2009.0
	public $A_C_CONF_COMMENTS = 'Comments';
	public $A_C_CONF_COMMENTSTIP = 'If set to show, the number of comments for a particular content item will be displayed. This is a global setting but can be changed at menu and item levels';
	public $A_C_CONF_CHKFTP = 'Check FTP settings';
	public $A_C_CONF_STDCACHE = 'Standard cache';
	public $A_C_CONF_STATCACHE = 'Static cache';
	public $A_C_CONF_CACHED = 'Standard Cache caches partial page blocks while Static Cache the whole page. Static Cache is recommended for heavy loaded sites. To use static cache you must have SEO PRO enabled.';
	public $A_C_CONF_SEODIS = 'SEO PRO is disabled!';

	public function __construct() {
	}

}

?>