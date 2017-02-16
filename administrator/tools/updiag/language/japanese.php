<?php 
/**
* @version: 2008.1
* @copyright: Copyright (C) 2006-2008 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Tools
* @author: Elxis Team
* @translator: momo-i
* @translator URL: http://www.elxis.jp
* @translator E-mail: webmaster@elxis.jp
* @description: Japanese language for Updiag tool
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'この場所への直接アクセスは許可されていません。' );


class updiagLang {

	public $UPDATE = '更新';
	public $CHVERS = 'バージョンチェック';
	public $CNOTGETELXD = 'elxis.orgからデータを取得できませんでした';
	public $INVXML = '不正なXMLファイルを受け取りました要求された情報を表示できませんでした。';
	public $SIZE = 'サイズ';
	public $MORE = 'More';
	public $DOWNLOAD = 'ダウンロード';
	public $INSELXVER = 'インストール済みのElxisのバージョン';
	public $CURRENT = '現在';
	public $OUTDATED = '旧式です！'; //Outdated!
	public $NEWVERAV = 'Elxisの新しいバージョンが利用可能です。可能な限りすぐにElxisを更新してください。';
	public $CHPATCHES = 'パッチのチェック';
	public $NOPATCHES = 'このバージョンで利用可能なパッチはありません';
	public $PROSUPPORT = 'プロフェッショナルサポート';
	public $NEWS = 'ニュース';
	public $MAINTENANCE = 'メンテナンス';
	public $REMOTEERR1 = '不正なリクエスト';
	public $REMOTEERR2 = 'スクリプトの一覧を取得できませんでした'; //Could not get list of scripts
	public $REMOTEERR3 = 'スクリプトが見つかりませんでした';
	public $REMOTEERR4 = '要求されたファイルは空です';
	public $REMOTEERR5 = 'ハッシュファイルの一覧を取得できませんでした';
	public $REMOTEERR6 = 'ハッシュファイルが見つかりませんでした';
	public $REMOTEERR7 = '要求されたファイルをダウンロードできませんでした！';
	public $UNERROR = '不明なエラー';
	public $PROVCODE = 'Elxisを更新するためのコードを提供します: 次のバージョンから'; //Provides code for updating Elxis from version
	public $TOVERSION = '次のバージョンへ'; //to version
	public $INSTALLED = 'インストール済み';
	public $REQFEXISTS = '要求されたファイルは既に存在します！';
	public $FILDOWNSUC = 'ファイルのダウンロードに成功しました！';
	public $DFORRUNSCR = 'Elxisの更新をしたい場合、このスクリプトを実行することを忘れないでください。';
	public $CNOTCPDFIL = 'ダウンロードされたファイルを宛先ディレクトリへコピーできませんでした。';
	public $PLCHSCRPERM = '/administrator/tools/updiag/data/scriptsフォルダのパーミッションをチェックしてください';
	public $PLCHSCRPERM2 = '/administrator/tools/updiag/data/hashesフォルダのパーミッションをチェックしてください';
	public $EXECUTE = '実行';
	public $SCRNOTEX = '要求されたスクリプトは存在しません！';
	public $FSCHECK = 'ファイルシステムをチェック';
	public $HIDEHELP = 'ヘルプ非表示';
	public $NORMAL = '通常'; //Normal
	public $EXTENDED = '拡張'; //Extended
	public $FULL = '完全'; //Full
	public $NOHASHFOUND = 'ハッシュファイルが見つかりませんでした';
	public $INVHFILE = '不正なハッシュファイル！';
	public $SHFELXVER = '選択されたハッシュファイルは現在より古いElxisのバージョンのためのものです！';
	public $FNOTEXIST = 'ファイルが存在しません';
	public $WARNING = '警告';
	public $FNEEDUP = 'ファイルは更新が必要です';
	public $SITUP2D = 'サイトはアップデートされました！';
	public $FOUND = '見つかりました'; //Found
	public $OUTFUP = '旧ファイルです。更新してください！';
	public $CHFINUS = 'ソースとして<b>%s</b>を使用してサイトの更新状態をチェックします';
	public $NEWRELEASES = '新しいリリース'; //New releases
	public $NONEWREL = '新しいリリースはありません';
	public $PRICE = '価格';
	public $LICENSE = 'ライセンス';
	public $SECURITY = 'セキュリティ';
	public $INSTPATH = 'インストールパス';
	public $CREDITS = 'クレジット';
	public $ALERT = 'アラート';
	public $FSECALWA = '<b>%d</b>のセキュリティアラートと警告が見つかりました';
	public $ELXINPAS = '基本的なセキュリティチェックをパスしました'; //Your Elxis installation passed successfully basic security check
	public $HOME = 'ホーム';
	public $UPDSPAG = '更新診断センター'; //Updiag Central
	public $UPDWELC = '<b>更新診断</b>へようこそ、Elxisの更新と診断ツールです。';
	public $STARTMORE = '多くの更新診断機能はelxis.orgへのリモート接続を必要とします。 
	したがって、これらの機能が動作するためにはあなたのサイトからインターネットへ接続ができる必要があります。
	ナビゲーションのトップメニューからアイテムを選択します。';
	public $BASCHECKS = '基本チェック<small>(実行するにはアイコンをクリックします)</small>';
	public $FILEREMSUC = 'ファイルの削除に成功しました！';
	public $CNREMSFILE = '選択されたファイルを削除できません！ファイルのパーミッションをチェックしてください。';
	public $HASHNOTEX = 'リクエストされたファイルは存在しません！';
	public $DNHASHFLS = 'ハッシュファイルのダウンロード';
	public $BUY = '購入';
	public $DOWNLTIME = 'ダウンロード時間';
	public $DOWNLSPEED = 'ダウンロード速度';


	public function __construct() {
	}

}

define('CX_LUPDIAGD', 'Helps you update your site, notifies you about new Elxis releases, versions and patches and provides you security and diagnostic tasks.');

?>