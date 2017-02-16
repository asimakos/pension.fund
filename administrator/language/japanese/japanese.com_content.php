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
* @description: Japanese language for component content
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'この場所への直接アクセスは許可されていません。' );


class adminLanguage extends standardLanguage {

public $A_CMP_CNT_ITEMSMNG = 'コンテンツアイテム管理';
public $A_CMP_CNT_DATEFORMAT = 'Y年m月d日 h:i:s'; //Y-m-d h:i:s
public $A_CMP_CNT_ALTEDITCONT = 'コンテンツの編集';
public $A_CMP_CNT_TRASH = 'ゴミ箱へ送るには一覧から選択してください';
public $A_CMP_CNT_TRASHMESS = '選択されたアイテムをゴミ箱へ送ってもよろしいですか？\nこれはアイテムを永久に削除するわけではありません。';
public $A_CMP_CNT_ARCHMANAGER = 'アーカイブ管理';
public $A_CMP_CNT_DATECREATED = '%Y年%B%d日 %A %H:%M'; //%A, %d %B %Y %H:%M
public $A_CMP_CNT_DATEMODIFIED = '%Y年%B%d日 %A %H:%M'; //%A, %d %B %Y %H:%M
public $A_CMP_CNT_MUSTTITLE = 'コンテンツアイテムはタイトルが必要です。';
public $A_CMP_CNT_MUSTSECTN = 'セクションを選択してください。';
public $A_CMP_CNT_MUSTCATEG = 'カテゴリを選択してください。';
public $A_CMP_CNT_CONTITEM = 'コンテンツアイテム';
public $A_CMP_CNT_ITEMDETLS = 'アイテム詳細';
public $A_CMP_CNT_INTRO = '紹介文: (必須)';
public $A_CMP_CNT_MAIN = '本文: (任意)';
public $A_CMP_CNT_FRONTPAGE = 'フロントページに表示';
public $A_CMP_CNT_AUTHOR = '作者別名';
public $A_CMP_CNT_CREATOR = '作者変更'; //Change Creator
public $A_CMP_CNT_OVERRIDE = '作成日を上書き'; //Override Created Date
public $A_CMP_CNT_STRTPUB = '掲載開始日'; //Start Publishing
public $A_CMP_CNT_FNSHPUB = '掲載終了日'; //Finish Publishing
public $A_CMP_CNT_DRFTUNPUB = '草稿未掲載'; //Draft Unpublished
public $A_CMP_CNT_RESETHIT = 'カウンターのリセット'; //Reset Hit Count
public $A_CMP_CNT_REVISED = 'バージョン'; //Revised
public $A_CMP_CNT_TIMES = '回';
public $A_CMP_CNT_BY = '担当'; // By
public $A_CMP_CNT_NEWDOC = '新しいドキュメント';
public $A_CMP_CNT_LASTMOD = '最終更新日';
public $A_CMP_CNT_NOTMOD = '更新無し'; //Not modified
public $A_CMP_CNT_ADDETC = 'セクション/カテゴリ/タイトルの追加';
public $A_CMP_CNT_LINKCI = '選択したメニューに「リンク - コンテンツアイテム」を作成します';
public $A_CMP_CNT_SOMTHING = '何か選択してください';
public $A_CMP_CNT_MVEITEMS = 'アイテムの移動';
public $A_CMP_CNT_MVESECCAT = 'セクション/カテゴリへ移動';
public $A_CMP_CNT_ITMSMVED = '移動するアイテム';
public $A_CMP_CNT_SECCAT = 'アイテムをコピーするセクション/カテゴリを選択してください'; //Please select a Section/Category to copy the Items to
public $A_CMP_CNT_CPYITEMS = 'コンテンツアイテムのコピー';
public $A_CMP_CNT_CPYSECCAT = 'セクション/カテゴリへコピー';
public $A_CMP_CNT_ITMSCPED = 'コピーするアイテム';
public $A_CMP_CNT_CCHECL = 'キャッシュをクリアしました';
public $A_CMP_CNT_CANNOT = 'アーカイブされたアイテムは編集できません';
public $A_CMP_CNT_THMODULIS = 'モジュール'; // The module
public $A_CMP_CNT_DROWCRED = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_DROWMOD = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_DROWPUB = '%Y-%m-%d %H:%M:%S';
public $A_CMP_CNT_PBLINEV = 'Never';
public $A_CMP_CNT_DPUBLISHUP = 'Y-m-d';
public $A_CMP_CNT_SLSECTN = 'セクションの選択';
public $A_CMP_CNT_SELCAT = 'カテゴリの選択';
public $A_CMP_CNT_ARCHVED = 'アイテムのアーカイブに成功しました';
public $A_CMP_CNT_PUBLSHED = 'アイテムの掲載に成功しました';
public $A_CMP_CNT_ITSUUNP = 'アイテムの未掲載に成功しました';
public $A_CMP_CNT_ITSUUNA = 'アイテムの非アーカイブに成功しました';
public $A_CMP_CNT_SELITOG = '切り替えるアイテムを選択';
public $A_CMP_CNT_SELIDEL = '削除するアイテムを選択';
public $A_CMP_CNT_ERROCCRD = 'エラーが発生しました';
public $A_CMP_CNT_MOVD = 'アイテムをセクションへ移動することに成功しました';
public $A_CMP_CNT_COPED = 'アイテムをセクションへコピーすることに成功しました';
public $A_CMP_CNT_RSTHTCNT = 'カウンターのリセットに成功しました'; //Successfully Reset Hit count for
public $A_CMP_CNT_INMENU = 'メニュー内(リンク - 独立ページ)';
public $A_CMP_CNT_SUCCSS = '作成に成功しました'; //successfully created
public $A_CMP_CNT_RSZERO = 'カウンターを0にリセットしてもよろしいですか？\nこのアイテムへのどんな保存されなかった変更も失われます';
public $A_CMP_CNT_MUST_CIMNA = 'コンテンツアイテムは名前が必要です';
public $A_CMP_CNT_SITMAPFOR = 'サイトマップ'; //Site Map for
public $A_CMP_CNT_ALLLANGS = '全ての言語';
public $A_CMP_CNT_LANG = '言語';
public $A_CMP_CNT_PHRENAME = 'リネームするには押したままにします';
public $A_CMP_CNT_EDITITEM = 'アイテムの編集';
public $A_CMP_CNT_NOTES = '注意';
public $A_CMP_CNT_PRSHREN = 'リネームするにはアイテムを押したままにします';
public $A_CMP_CNT_EMPCATSEC = 'ツリーは空のセクション/カテゴリを表示しません。';
public $A_CMP_CNT_TREEUNPUBL = '灰色と斜体にマークされたアイテムは未掲載です';
public $A_CMP_CNT_NULLVAL = 'Null値が与えられました！';
public $A_CMP_CNT_INCCTP = '不正なコンテンツタイプ';
public $A_CMP_CNT_CLDNFETCH = 'データを取得できませんでした';
public $A_CMP_CNT_TRSELPAIR = '言語のペアを選択してください';
public $A_CMP_CNT_TRSOUDEST = '翻訳元と翻訳先の言語を選択してください'; //Select Source and Destination Languages
public $A_CMP_CNT_TRITEMS = '翻訳するアイテム';
public $A_CMP_CNT_TRNOTE = '<strong>Elxis注:</strong> 翻訳元と翻訳先の言語を注意して選択してください。この手順は翻訳するテキストのサイズに依存して時間がかかるかもしれません。<br />
	翻訳はAltabistaの無料翻訳サービスをベースに行います。Elxisは翻訳結果に一切責任を持ちません。';
public $A_CMP_CNT_TRSELITEM = '翻訳するアイテムの選択';
public $A_CMP_CNT_TROKSAVED = 'アイテムの翻訳とコピーに成功しました';
public $A_CMP_CNT_TRITMNOTF = '選択されたアイテムはデータベースに見つかりませんでした！';
public $A_CMP_CNT_MFS = 'サーバからのメッセージ';
public $A_CMP_CNT_WID = '次のIDで:'; // with id
public $A_CMP_CNT_RNMTO = '次へリネームしました:'; // rename to
public $A_CMP_CNT_FL= '言語フィルタ';
public $A_CMP_CNT_CONFL = '言語の衝突';
public $A_CMP_CNT_CONFI = 'アイテムはこのアイテムを表示する許可のない言語設定のカテゴリにあります！';
public $A_CMP_CNT_STARTALW = '開始: 常に';
public $A_CMP_CNT_FINNOEXP = '終了: 無期限';
public $A_CMP_CNT_FINISH = '終了';
public $A_CMP_CNT_FROM = 'from'; // from
public $A_CMP_CNT_SHOWHIDE = '表示/非表示';
public $A_SIMPLEVIEW = 'シンプルビュー';
public $A_EXTENDVIEW = '拡張ビュー';
public $A_CMP_CNT_COMMENTS = 'コメント';
public $A_CMP_CNT_SAVTRANS = 'アイテムはサイトのコンテンツとして翻訳と保存されました';
public $A_CMP_CNT_RELLINKS = '関連リンク';
public $A_CMP_CNT_RELLINKSD = 'この記事に関連するリンクです。外部リンクを追加したいなら、URLにhttp://を追加してください。';

}

?>
