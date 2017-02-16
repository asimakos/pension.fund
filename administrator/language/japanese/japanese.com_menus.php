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
* @description: Japanese language for component menus
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'この場所への直接アクセスは許可されていません。' );


class adminLanguage extends standardLanguage {

public $A_CMP_MU_MANAGER = 'メニュー管理';
public $A_CMP_MU_MXLVLS = '最大レベル';
public $A_CMP_MU_CANTDEL ='* このメニューはElxisの適切な操作に必要とされるため削除することはできません *';
public $A_CMP_MU_MANHOME = '* このメニュー「mainmenu」の最初に掲載されたアイテムはサイトのデフォルトの「ホームページ」です *';
public $A_CMP_MU_MITEM = 'メニューアイテム';
public $A_CMP_MU_NSMTG = '* いくつかのメニューは1つ以上のグループのメニュータイプに表示されますが、中身は一緒であるということに注意してください。';
public $A_CMP_MU_MITYP = 'メニューアイテムタイプ';
public $A_CMP_MU_WBLV = '「Blog」の閲覧とは？';
public $A_CMP_MU_WTLV = '「テーブル」の閲覧とは？';
public $A_CMP_MU_WLIV = '「一覧」の閲覧とは？';
public $A_CMP_MU_SMTAP = '* いくつかの「メニュータイプ」は1つ以上のグループに表示されます *';
public $A_CMP_MU_MOVEITS = 'メニューアイテムの移動';
public $A_CMP_MU_MOVEMEN = '移動先'; //Move to Menu
public $A_CMP_MU_BEINMOV = '移動するメニューアイテム';
public $A_CMP_MU_COPYITS = 'メニューアイテムのコピー';
public $A_CMP_MU_COPYMEN = 'コピー先'; //Copy to Menu
public $A_CMP_MU_BCOPIED = 'コピーするメニューアイテム';
public $A_CMP_MU_EDNEWSF = 'このニュースフィードを編集';
public $A_CMP_MU_EDCONTA = 'この連絡先を編集';
public $A_CMP_MU_EDCONTE = 'このコンテンツを編集';
public $A_CMP_MU_EDSTCONTE = 'この独立ページを編集';
public $A_CMP_MU_MSGITSAV = 'メニューアイテムを保存しました';
public $A_CMP_MU_MOVEDTO = 'つのメニューアイテムを移動しました。移動先:'; //Menu Items moved to 
public $A_CMP_MU_COPITO = 'つのメニューアイテムをコピーしました。コピー先:'; //Menu Items copied to 
public $A_CMP_MU_THMOD = 'モジュール';
public $A_CMP_MU_SCITLKT = 'リンクするコンポーネントを選択してください'; //You must select a Component to link to
public $A_CMP_MU_COMPLLTO = 'リンクするコンポーネント'; //Component to Link
public $A_CMP_MU_ITEMNAME = 'アイテムには名前が必要です';
public $A_CMP_MU_PLSELCMP = 'コンポーネントを選択してください';
public $A_CMP_MU_PARAVAI = 'パラメータ一覧はこの新しいメニューアイテムを保存するたびに有効になります';
public $A_CMP_MU_YSELCAT = 'カテゴリを選択してください';
public $A_CMP_MU_TMHTITL = 'このメニューアイテムはタイトルが必要です';
public $A_CMP_MU_TABLE = 'テーブル';
public $A_CMP_MU_CCTBLANK = 'これを空白のままにしておくとカテゴリ名は自動的に使用されます'; //If you leave this blank, the Category name will be automatically used
public $A_CMP_MU_LNKHNAME = 'リンクは名前が必要です';
public $A_CMP_MU_SELCONT = 'リンクする連絡先を選択してください'; //You must select a Contact to link to
public $A_CMP_MU_CONLINK = 'リンクする連絡先:';
public $A_CMP_MU_ONCLOPI = 'クリックで開く方法'; //On Click, Open in
public $A_CMP_MU_THETITL = 'タイトル:';
public $A_CMP_MU_YMSSECT = 'セクションを選択してください';
public $A_CMP_MU_ILBLSEC = 'これを空白のままにしておくとセクション名は自動的に使用されます'; //If you leave this blank, the Section name will be automatically used
public $A_CMP_MU_YCSMC = '複数のカテゴリを選択できます';
public $A_CMP_MU_YCSMS = '複数のセクションを選択できます';
public $A_CMP_MU_EDCOI = 'コンテンツアイテムの編集';
public $A_CMP_MU_YMSLT = 'リンクするコンテンツを選択してください'; //You must select a Content to link to
public $A_CMP_MU_STACONT = '独立ページのコンテンツ';
public $A_CMP_MU_ONCLOP = 'クリックで開く方法';
public $A_CMP_MU_YSNWLT = 'リンクするニュースフィードを選択してください'; //You must select a Newsfeed to link to
public $A_CMP_MU_NEWTL = 'リンクするニュースフィード';
public $A_CMP_MU_SEPER = '- - - - - - -'; //Change this, if you want to change the symbols for seperator line
public $A_CMP_MU_PATNAM = 'パターン/名前';
public $A_CMP_MU_WRURL = 'URLが必要です。';
public $A_CMP_MU_WRLINK = 'ラッパーリンク';
public $A_CMP_MU_MIBGCC = 'Blog - コンテンツカテゴリ';
public $A_CMP_MU_MITCG = 'テーブル - 連絡先カテゴリ'; 
public $A_CMP_MU_MICOMP = 'コンポーネント';
public $A_CMP_MU_MIBGCS = 'Blog - コンテンツセクション';
public $A_CMP_MU_MILCMPI = 'リンク - コンポーネントアイテム';
public $A_CMP_MU_MILCI = 'リンク - 連絡先アイテム';
public $A_CMP_MU_MITBCC = 'テーブル - コンテンツカテゴリ';
public $A_CMP_MU_MILCEI = 'リンク - コンテンツアイテム';
public $A_CMP_MU_COTLINK = 'リンクするコンテンツ';
public $A_CMP_MU_MITBCS = 'テーブル - コンテンツセクション';
public $A_CMP_MU_MILSTC = 'リンク - 独立ページ';
public $A_CMP_MU_MITBNFC = 'テーブル - ニュースフィードカテゴリ';
public $A_CMP_MU_MILNEW = 'リンク - ニュースフィード';
public $A_CMP_MU_MISEP = 'セパレータ / プレースホルダ'; //Separator / Placeholder
public $A_CMP_MU_MILIURL = 'リンク - URL';
public $A_CMP_MU_MITBWC = 'テーブル - ウェブリンクカテゴリ';
public $A_CMP_MU_MIWRAP = 'ラッパー';
public $A_CMP_MU_ITEM = 'アイテム';
public $A_CMP_MU_UMSBRI = 'ブリッジを選択してください';
public $A_CMP_MU_BRINOINS = 'ブリッジコンポーネントはインストールされていません！'; //Component Bridge is not Installed!
public $A_CMP_MU_NOPUBBRI = '公開されたブリッジはありません！'; //There are no published Bridges!
public $A_CMP_MU_CLVSEO = 'それのSEOタイトルを見るには独立ページをクリックします';
public $A_CMP_MU_SYSLINK = 'システムリンク';
public $A_CMP_MU_SYSLINKD = 'システムリンクは通常、テンプレートに存在しないモジュールの位置の中に設定された公開済みのメニューに属しているべきです！';
public $A_CMP_MU_PASSR = 'パスワード再発行'; //Password remind
public $A_CMP_MU_UREG = 'ユーザ登録';
public $A_CMP_MU_REGCOMP = '登録完了'; //Registration complete
public $A_CMP_MU_ACCACT = 'アカウントアクティベーション';
public $A_CMP_MU_MSLINK = 'システムリンクを選択してください';
public $A_CMP_MU_SELLINK = '- リンクを選択 -';
public $A_CMP_MU_DONTDEL ='* Elxisが正常に動作できるようにするために、このメニューは削除しないでください。テンプレートに存在しないモジュールの位置の中に公開されていることを確認してください！';
public $A_CMP_MU_EDPROF = 'プロフィールの編集';
public $A_CMP_MU_SUBWEBL = 'ウェブリンク送信';
public $A_CMP_MU_CHECKIN = 'チェックイン';
public $A_CMP_MU_USERLIST = 'ユーザ一覧';
public $A_CMP_MU_POLLS = '投票';
//elxis 2008.1
public $A_CMP_MU_SELBLOG = 'You must select a blog to link to';
public $A_CMP_MU_BLOGLINK = 'Blog to Link';

}

?>