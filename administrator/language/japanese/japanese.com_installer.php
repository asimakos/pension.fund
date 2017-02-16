<?php 
/**
* @version: 2009.2
* @copyright: Copyright (C) 2006-2010 Elxis.org. All rights reserved.
* @package: Elxis
* @subpackage: Admin Language
* @author: Elxis Team
* @translator: momo-i
* @link: http://www.elxis.jp
* @email: webmaster@elxis.jp
* @description: Japanese language for component installer
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'この場所への直接アクセスは許可されていません。' );


class adminLanguage extends standardLanguage {

public $A_CMP_INS_SDIR = 'ディレクトリを選択してください';
public $A_CMP_INS_UPF = 'パッケージファイルのアップロード';
public $A_CMP_INS_PF = 'パッケージファイル';
public $A_CMP_INS_UFI = "ファイルのアップロードとインストール";
public $A_CMP_INS_FDIR = 'ディレクトリからインストール';
public $A_CMP_INS_IDIR = 'インストールディレクトリ';
public $A_CMP_INS_DOIN = 'インストール';
public $A_CMP_INS_CONT = '続ける...';
public $A_CMP_INS_NF = 'インストーラは次の要素を見つけられませんでした: '; //Installer not found for element
public $A_CMP_INS_NA = 'インストーラは次の要素を利用できません:'; //Installer not available for element
public $A_CMP_INS_EFU = 'ファイルのアップロードが有効になっていないとインストーラは続けることができません。ディレクトリからインストールする方法を使用してください。';
public $A_CMP_INS_ERTL = 'インストーラ - エラー';
public $A_CMP_INS_ERZL = 'インストーラはzlibがインストールされていないと続けることができません';
public $A_CMP_INS_ERNF = 'ファイルが選択されていません';
public $A_CMP_INS_ERUM = '新しいモジュールのアップロード - エラー';
public $A_CMP_INS_UPTL = 'アップロード ';
public $A_CMP_INS_UPE1 = ' - アップロード失敗';
public $A_CMP_INS_UPE2 = ' -  アップロードエラー';
public $A_CMP_INS_SUCC = '成功';
public $A_CMP_INS_ER = 'エラー';
public $A_CMP_INS_ERFL = '失敗';
public $A_CMP_INS_UPNW = '次の新しいものをアップロード: '; //Upload New
public $A_CMP_INS_FP = 'アップロードされたファイルの権限を変更できませんでした。';
public $A_CMP_INS_FM = '<code>/media</code>ディレクトリへアップロードされたファイルの移動ができませんでした。';
public $A_CMP_INS_FW = '<code>/media</code>ディレクトリは書き込み不可のためアップロードできません。';
public $A_CMP_INS_FE = '<code>/media</code>ディレクトリは存在しないためアップロードできません。';
public $A_CMP_INST_ERUNR = '回復不能なエラー';
public $A_CMP_INST_EREXT = '展開エラー';
public $A_CMP_INST_ERMXM = '<strong>エラー:</strong> パッケージ内にElxisのXMLセットアップファイルを見つけることができませんでした';
public $A_CMP_INST_ERXML = '<strong>エラー:</strong> パッケージ内にXMLセットアップファイルを見つけることができませんでした';
public $A_CMP_INST_ERNFN = 'ファイル名が指定されていません';
public $A_CMP_INST_ERVLD = 'は有効なElxisインストールファイルではありません';
public $A_CMP_INST_ERINC = 'インストールする方法がクラスで呼び出すことができません';
public $A_CMP_INST_ERUIC = 'アンインストールする方法がクラスで呼び出すことができません';
public $A_CMP_INST_ERIFN = 'インストールファイルが見つかりません';
public $A_CMP_INST_ERSXM = 'XMLセットアップファイルは次のもの用ではありません:'; //XML setup file is not for a
public $A_CMP_INST_ERCDR = 'ディレクトリの作成に失敗しました';
public $A_CMP_INST_FNOTE = 'は存在しません！';
public $A_CMP_INST_TAFC = 'ファイルは既に呼び出されています'; //There is already a file called
public $A_CMP_INST_AYIT = '- 同じCMTを2回インストールしようとしていますか？';
public $A_CMP_INST_FCPF = 'ファイルのコピーに失敗しました'; //Failed to copy file
public $A_CMP_INST_CPTO = 'to';
public $A_CMP_INST_UNINSTALL = 'アンインストール';
public $A_CMP_INST_CUDIR = '別のコンポーネントが既にディレクトリを使用しています';
public $A_CMP_INST_SQLER = 'SQLエラー';
public $A_CMP_INST_CCPHP = 'PHPインストールファイルをコピーできませんでした。';
public $A_CMP_INST_CCUNPHP = 'PHPアンインストールファイルをコピーできませんでした。';
public $A_CMP_INST_UNERR = 'アンインストール - エラー';
public $A_CMP_INST_THCOM = 'コンポーネント';
public $A_CMP_INST_ISCOR = 'はコアコンポーネントのためアンインストールできません。<br />使用しないなら非公開にしてください。';
public $A_CMP_INST_XMLINV = 'XMLファイルが不正です';
public $A_CMP_INST_OFEMP = 'オプション欄が空のためファイルを削除できません';
public $A_CMP_INST_INCOM = 'インストール済みコンポーネント';
public $A_CMP_INST_CURRE = 'インストール済み'; //Currently Installed
public $A_CMP_INST_MENL = 'コンポーネントメニューリンク'; //Component Menu Link
public $A_CMP_INST_AUURL = '作者URL';
public $A_CMP_INST_NCOMP = 'インストール済みのカスタムコンポーネントはありません';
public $A_CMP_INST_INSCO = '新しいコンポーネントのインストール';
public $A_CMP_INST_DELE = '削除中'; //Deleting
public $A_CMP_INST_LIDE = '言語IDが空のためファイルを削除できません';
public $A_CMP_INST_ALL = '全て';
public $A_CMP_INST_BKLM = '言語管理へ戻る';
public $A_CMP_INST_NWLA = '新しい言語のインストール';
public $A_CMP_INST_NFMM = 'ボットファイルとしてマークされたファイルはありません';
public $A_CMP_INST_MAMB = 'ボット';
public $A_CMP_INST_AXST = '既に存在します！';
public $A_CMP_INST_IOID = '不正なオブジェクトID';
public $A_CMP_INST_FFEM = 'フォルダ欄が空のためファイルを削除できません';
public $A_CMP_INST_DXML = 'XMLファイルの削除中';
public $A_CMP_INST_ICMO = 'はコア要素のためアンインストールできません。<br />使用しないなら非公開にしてください';
public $A_CMP_INST_IMBT = 'インストール済みボット';
public $A_CMP_INST_OMBT = 'アンインストールできるボットのみ表示しています - いくつかのコアボットは削除できません。';
public $A_CMP_INST_MBT = 'ボット';
public $A_CMP_INST_MTYP = 'タイプ';
public $A_CMP_INST_NMBT = 'コアでないものは無いので、カスタムボットはインストールされました。'; //There are no non-core, custom bots installed.
public $A_CMP_INST_INMT = '新しいボットのインストール';
public $A_CMP_INST_UCTP = '不明なクライアントタイプ';
public $A_CMP_INST_NFMD = 'モジュールファイルとしてマークされたファイルはありません';
public $A_CMP_INST_MODULE = 'モジュール';
public $A_CMP_INST_ICMDL = 'はコアモジュールのためアンインストールできません。<br />使用しないなら非公開にしてください';
public $A_CMP_INST_IMDL = 'インストール済みモジュール';
public $A_CMP_INST_OMDL = 'アンインストールできるモジュールのみ表示しています - いくつかのコアモジュールは削除できません。';
public $A_CMP_INST_MDLF = 'モジュールファイル';
public $A_CMP_INST_NMDL = 'インストール済みのカスタムモジュールはありません';
public $A_CMP_INST_NWMDL = '新しいモジュールのインストール';
public $A_CMP_INST_ALLC = '全て';
public $A_CMP_INST_STMDL = 'サイトモジュール';
public $A_CMP_INST_ADMDL = '管理モジュール';
public $A_CMP_INST_DDEX = 'ディレクトリが存在しないためファイルを削除できません';
public $A_CMP_INST_TIDE = 'テンプレートIDが空のためファイルを削除できません';
public $A_CMP_INST_TINS = '新しいテンプレートのインストール';
public $A_CMP_INST_BATP = 'テンプレートへ戻る';
public $A_CMP_INST_INSBR = '新しいブリッジのインストール';
public $A_CMP_INST_BABR = 'ブリッジへ戻る';
public $A_CMP_INST_BIDE = 'ブリッジIDが空のためファイルを削除できません';
public $A_INST_INCOM = 'あなたの使用するElxisのバージョンとインストールされた拡張の間で可能な非互換性を検出しました。
それとは別に、ソフトウェアはうまく動くかもしれませんしエラー無しで動作するかもしれません。これはただの通知です。';
public $A_INST_INCOMJOO = 'インストールパッケージはJoomla用です！';
public $A_INST_INCOMMAM = 'インストールパッケージはMambo用です！';
public $A_INST_OLDER = 'インストールパッケージはあなたの(%s)より前のElxisバージョン(%s)用です';
public $A_INST_NEWER = 'インストールパッケージはあなたの(%s)より新しいElxisバージョン(%s)用です';
//2009.0
public $A_INST_DOINEDC = 'Download and install from Elxis Downloads Center';
public $A_INST_FETCHAVEXTS = '利用可能な拡張の取得リスト';
public $A_INST_MORE = 'More';
public $A_INST_LESS = 'Less';
public $A_INST_SIZE = 'サイズ';
public $A_INST_DOWNLOAD = 'ダウンロード';
public $A_INST_DOWNLOADS = 'ダウンロード';
public $A_INST_DOWNINST = 'Download and install';
public $A_INST_LICENSE = 'ライセンス';
public $A_INST_COMPAT = '互換性';
public $A_INST_DATESUB = 'Date submitted';
public $A_INST_SUREINST = 'Are you sure you wish to install %s ?'; //translators help: filled in be extension title
//2009.2
public $A_INST_UPTODATE = '現在まで続いている';
public $A_INST_OUTDATED = '時代遅れの';
public $A_INST_INSTVERS = 'インストールバージョン';
public $A_INST_UNLOAD = 'アンロード';
public $A_INST_EDCUPDESC = 'List of the installed third party extensions and their update status.<br />
	The information is taken live from the <a href="http://www.elxis-downloads.com/" title="EDC" target="_blank">Elxis Downloads Center</a>.<br />
	In order for the versioning check to be successuful your web site must be able to connect to the <strong>EDC</strong> remote center.';
public $A_INST_EDCUPNOR = "Version check returned nothing.<br />
	Most probably you do not have any third party %s installed.";

}

?>