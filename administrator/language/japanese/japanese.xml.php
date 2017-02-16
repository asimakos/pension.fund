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
* @description: Japanese Language for XML files
* @note: All values used in admin XML files start with 'AX_'
* @note 2008: values for custom language strings defined as php contants start with 'CX_' (not in this file!)
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
* 
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
* 
*/

defined( '_VALID_MOS' ) or die( 'この場所への直接アクセスは許可されていません。' );


class xmlLanguage extends standardLanguage {

public function get($a) {
	if ( is_numeric($a) ) { return $a; }
	$pref = strtoupper(substr($a,0,3));
    if ($pref == 'AX_') {
        return $this->$a;
    } elseif (($pref == 'CX_') && defined($a)) {
        return constant($a);
	} else { return $a; }
}

protected $AX_MENUIMGL = 'メニュー画像';
protected $AX_MENUIMGD = 'メニューアイテムの左か右に置かれる小さな画像でimages/stories/ディレクトリになければなりません。';
protected $AX_MENUIMGONLYL = 'メニュー画像のみ使用';
protected $AX_MENUIMGONLYD = '<strong>はい</strong>を選択する場合、メニューアイテムは選択された画像でのみ提供されます。<br /><br /><strong>いいえ</strong>を選択する場合、メニューアイテムは選択された画像に加えてテキストで提供されます。';
protected $AX_MENUIMG2D = 'メニューアイテムの左か右へ置かれる小さな画像で/imagesディレクトリになければなりません。';
protected $AX_PAGCLASUFL = 'ページクラスの接尾語'; //Page Class Suffix
protected $AX_PAGCLASUFD = 'ページのcssクラスへ適用される接尾語で、ページを固有のスタイルにすることを可能にします。';
protected $AX_TEXTPAGECL = '記事の接尾語'; //Article Suffix
protected $AX_TEXTPAGECLD = '記事のcssクラスへ適用される接尾語で、記事/コンテンツアイテムをを固有のスタイルにすることを可能にします。';
protected $AX_BACKBUTL = '戻るボタン';
protected $AX_BACKBUTD = '前のページへ戻るボタンを表示/非表示にします。';
protected $AX_USEGLB = '全体設定を使用';
protected $AX_HIDE = '非表示';
protected $AX_SHOW = '表示';
protected $AX_AUTO = '自動';
protected $AX_PAGTITLSL = 'ページタイトルの表示';
protected $AX_PAGTITLSD = 'ページタイトルを表示/非表示にします。';
protected $AX_PAGTITLL = 'ページタイトル';
protected $AX_PAGTITLD = 'ページのトップで表示するテキストです。空白ならメニュー名が代わりに使用されます。';
protected $AX_PAGTITL2D = 'ページのトップで表示するテキストです。';
protected $AX_LEFT = '左';
protected $AX_RIGHT = '右';
protected $AX_PRNTICOL = '印刷アイコン';
protected $AX_PRNTICOD = 'アイテムの印刷用ボタンを表示/非表示にします - このページにのみ影響します。';
protected $AX_YES = 'はい';
protected $AX_NO = 'いいえ';
protected $AX_SECNML = 'セクション名';
protected $AX_SECNMD = 'アイテムが属するセクションを表示/非表示にします。';
protected $AX_SECNMLL = 'リンク可能なセクション名';
protected $AX_SECNMLD = '実際のセクション名へリンクするセクションのテキストを作成します。';
protected $AX_CATNML = 'カテゴリ名';
protected $AX_CATNMD = 'アイテムが属するカテゴリを表示/非表示にします。';
protected $AX_CATNMLL = 'リンク可能なカテゴリ名';
protected $AX_CATNMLD = '実際のカテゴリ名へリンクするカテゴリのテキストを作成します。';
protected $AX_LNKTTLL = 'タイトルのリンク';
protected $AX_LNKTTLD = 'リンク可能なアイテムのタイトルを作成します';
protected $AX_ITMRATL = 'アイテム評価';
protected $AX_ITMRATD = 'アイテムの評価を表示/非表示にします - このページにのみ影響します。';
protected $AX_AUTNML = '作者名';
protected $AX_AUTNMD = 'アイテムの作者を表示/非表示にします - このページにのみ影響します。';
protected $AX_CTDL = '作成日'; //Created Date and Time
protected $AX_CTDD = 'アイテムの作成日を表示/非表示にします - このページにのみ影響します';
protected $AX_MTDL = '更新日'; //Modified Date and Time
protected $AX_MTDD = 'アイテムの更新日を表示/非表示にします - このページにのみ影響します。';
protected $AX_PDFICL = 'PDFアイコン';
protected $AX_PDFICD = 'アイテムのPDFボタンを表示/非表示にします - このページのみ影響します。';
protected $AX_PRICL = '印刷アイコン';
protected $AX_PRICD = 'アイテムの印刷ボタンを表示/非表示にします - このページにのみ影響します。';
protected $AX_EMICL = 'メールアイコン';
protected $AX_EMICD = 'アイテムのメールボタンを表示/非表示にします - このページにのみ影響します。';
protected $AX_FTITLE = 'タイトル';
protected $AX_FAUTH = '作者';
protected $AX_FHITS = 'ヒット数';
protected $AX_DESCRL = '説明';
protected $AX_DESCRD = '以下の説明を表示/非表示にします。';
protected $AX_DESCRTXL = '説明文';
protected $AX_DESCRTXD = 'ページの説明で、空白にすると言語ファイルから_WEBLINKS_DESCを読み込みます。';
protected $AX_IMAGEL = '画像';
protected $AX_IMGFRPD = 'ページの画像は/images/storiesフォルダに置かれなければなりません。デフォルトはweb_link.jpgを読み込みます。「画像を使用しない」にすると画像は読み込まれません。';
protected $AX_IMGALL = '画像位置';
protected $AX_IMGALD = '画像の位置です。'; //Alignment of the image.
protected $AX_TBHEADL = 'テーブルヘッダ'; //Table Headings
protected $AX_TBHEADD = 'テーブルヘッダを表示/非表示にします。';
protected $AX_POSCOLL = '位置欄'; //Position Column
protected $AX_POSCOLD = '位置欄を表示/非表示にします。';
protected $AX_EMAILCOLL = 'メール欄';
protected $AX_EMAILCOLD = 'メール欄を表示/非表示にします。';
protected $AX_TELCOLL = '電話番号欄';
protected $AX_TELCOLD = '電話番号欄を表示/非表示にします。';
protected $AX_FAXCOLL = 'Fax欄';
protected $AX_FAXCOLD = 'Fax欄を表示/非表示にします。';
protected $AX_LEADINGL = '# 主要アイテム数'; //Leading
protected $AX_LEADINGD = '主要な(全幅)アイテムとして表示するアイテム数です。0はアイテムを主要なものとして表示しません。'; //Number of Items to be displayed as a leading (full width) items. 0 means that no items will be displayed as leading.
protected $AX_INTROL = '# 紹介文の数'; //Intro
protected $AX_INTROD = '紹介文の表示で表示するアイテム数です。';
protected $AX_COLSL = '欄';
protected $AX_COLSD = '紹介文を表示するときに1列あたりにどれだけの欄を使用するかです。';
protected $AX_LNKSL = '# リンク数';
protected $AX_LNKSD = 'リンクとして表示するアイテム数です。';
protected $AX_CATORL = 'カテゴリ並び順';
protected $AX_CATORD = 'カテゴリでアイテムを順番にします。';
protected $AX_OCAT01 = '初期の並び順のみ順番にしません。';
protected $AX_OCAT02 = 'タイトルのアルファベットで昇順に';
protected $AX_OCAT03 = 'タイトルのアルファベットで降順に';
protected $AX_OCAT04 = '並び順';
protected $AX_PRMORL = '初期の並び順';
protected $AX_PRMORD = 'アイテムが表示される並び順です。';
protected $AX_OPRM01 = 'デフォルト';
protected $AX_OPRM02 = 'フロントページ並び順';
protected $AX_OPRM03 = '古いものを最初に';
protected $AX_OPRM04 = '新しいものを最初に';
protected $AX_OPRM07 = '作者をアルファベットで昇順に';
protected $AX_OPRM08 = '作者のアルファベットで降順に';
protected $AX_OPRM09 = 'ヒット数を昇順で';
protected $AX_OPRM10 = 'ヒット数を降順で';
protected $AX_PAGL = 'ページ付け(Pagination)';
protected $AX_PAGD = 'ページ数の表示/非表示をします。';
protected $AX_PAGRL = 'ページ付け結果';
protected $AX_PAGRD = 'ページ付けの結果情報を表示/非表示にします。(例 1-4 of 4 )';
protected $AX_MOSIL = 'MOSImages';
protected $AX_MOSID = '{mosimages}を表示します。';
protected $AX_ITMTL = 'アイテムのタイトル';
protected $AX_ITMTD = 'アイテムのタイトルを表示/非表示にします。';
protected $AX_REMRL = '続きを読む';
protected $AX_REMRD = '「続きを読む」リンクを表示/非表示にします。';
protected $AX_OTHCATL = 'その他カテゴリ';
protected $AX_OTHCATD = 'カテゴリを閲覧するとき、その他のカテゴリの一覧を表示/非表示にします。';
protected $AX_TDISTPD = 'ページのトップに表示されるテキストです。';
protected $AX_ORDBYL = '並び順: '; //Order by
protected $AX_ORDBYD = 'これはアイテムの並び順を上書きします。';
protected $AX_MCS_DESCL = '説明';
protected $AX_SHCDESD = 'カテゴリの説明を表示/非表示にします。';
protected $AX_DESCIL = '説明画像';
protected $AX_MUDATFL = '日付形式';
protected $AX_MUDATFD = '日付が表示される形式でPHPのstrftime関数を使用します。空白にすると言語ファイルから形式を読み込みます。';
protected $AX_MUDATCL = '日付欄';
protected $AX_MUDATCD = '日付欄を表示/非表示にします。';
protected $AX_MUAUTCL = '作者欄';
protected $AX_MUAUTCD = '作者欄を表示/非表示にします。';
protected $AX_MUHITCL = 'ヒット数欄';
protected $AX_MUHITCD = 'ヒット数を表示/非表示にします';
protected $AX_MUNAVBL = 'ナビゲーションバー';
protected $AX_MUNAVBD = 'ナビゲーションバーを表示/非表示にします。';
protected $AX_MUORDSL = '並び順の選択';
protected $AX_MUORDSD = '並び順を選択するドロップダウンを表示/非表示にします。';
protected $AX_MUDSPSL = '表示の選択';
protected $AX_MUDSPSD = '表示を選択するドロップダウンを表示/非表示にします。';
protected $AX_MUDSPNL = '表示数';
protected $AX_MUDSPND = 'デフォルトで表示されるアイテム数です。';
protected $AX_MUFLTL = 'フィルタ';
protected $AX_MUFLTD = 'フィルタ機能を表示するかどうかです。';
protected $AX_MUFLTFL = 'フィルタフィールド';
protected $AX_MUFLTFD = 'どのフィールドにフィルタが適用できるかです。';
protected $AX_MUOCATL = 'その他カテゴリ';
protected $AX_MUOCATD = 'その他カテゴリの一覧を表示/非表示にします。';
protected $AX_MUECATL = '空のカテゴリ';
protected $AX_MUECATD = '空の(アイテムのない)カテゴリを表示/非表示にします。';
protected $AX_CATDSCL = 'カテゴリの説明';
protected $AX_CATDSBLND = 'カテゴリの説明を表示/非表示にします。それはカテゴリ名の下に表示されます。';
protected $AX_NAMCOLL = '名前欄';
protected $AX_LINKDSCL = 'リンクの説明';
protected $AX_LINKDSCD = 'リンクの説明を表示/非表示にします。';
//com_contact/contact.xml
protected $AX_CCT_CDESC = 'このコンポーネントは連絡先情報の一覧を表示します。';
protected $AX_CCT_CATLISTSL = 'カテゴリ一覧 - セクション';
protected $AX_CCT_CATLISTSD = '閲覧するページの一覧にカテゴリの一覧を表示/非表示にします。';
protected $AX_CCT_CATLISTCL = 'カテゴリ一覧 - カテゴリ';
protected $AX_CCT_CATLISTCD = '閲覧するページのテーブルにカテゴリの一覧を表示/非表示にします。';
protected $AX_CCT_CATDSCD = 'その他のカテゴリの一覧の説明を表示/非表示にします。';
protected $AX_CCT_NOCATITL = '# カテゴリアイテム数';
protected $AX_CCT_NOCATITD = '各カテゴリのアイテム数を表示/非表示にします。';
//com_contact/contact_items.xml
protected $AX_CIT_CDESC = '個人連絡先アイテムのパラメータです。';
protected $AX_CIT_NAMEL = '名前';
protected $AX_CIT_NAMED = '名前を表示/非表示にします。';
protected $AX_CIT_POSITL = '所在地(Position)';
protected $AX_CIT_POSITD = '所在地を表示/非表示にします。';
protected $AX_CIT_EMAILL = 'メールアドレス';
protected $AX_CIT_EMAILD = 'メールアドレスを表示/非表示にします。表示するに設定した場合、アドレスはJavascriptの隠匿によってスパムボットから保護されます。';
protected $AX_CIT_SADDREL = '住所';
protected $AX_CIT_SADDRED = '住所を表示/非表示にします。';
protected $AX_CIT_TOWNL = '市区/町村';
protected $AX_CIT_TOWND = '市区町村を表示/非表示にします。';
protected $AX_CIT_STATEL = '県';
protected $AX_CIT_STATED = '県を表示/非表示にします。';
protected $AX_CIT_COUNTRL = '国';
protected $AX_CIT_COUNTRD = '国を表示/非表示にします。';
protected $AX_CIT_ZIPL = '郵便番号';
protected $AX_CIT_ZIPD = '郵便番号を表示/非表示にします。';
protected $AX_CIT_TELL = '電話番号';
protected $AX_CIT_TELD = '電話番号を表示/非表示にします。';
protected $AX_CIT_FAXL = 'Fax番号';
protected $AX_CIT_FAXD = 'Fax番号を表示/非表示にします。';
protected $AX_CIT_MISCL = 'その他情報';
protected $AX_CIT_MISCD = 'その他情報を表示/非表示にします。';
protected $AX_CIT_VCARDL = 'Vcard';
protected $AX_CIT_VCARDD = 'Vcardを表示/非表示にします。';
protected $AX_CIT_CIMGL = '画像';
protected $AX_CIT_CIMGD = '画像を表示/非表示にします。';
protected $AX_CIT_DEMAILL = 'メール説明';
protected $AX_CIT_DEMAILD = '以下の説明文を表示/非表示にします。';
protected $AX_CIT_DTXTL = '説明文';
protected $AX_CIT_DTXTD = 'メールフォームの説明文で、空白にすると言語で定義した_EMAIL_DESCRIPTIONを使用します。';
protected $AX_CIT_EMFRML = 'メールフォーム';
protected $AX_CIT_EMFRMD = 'メールフォームを表示/非表示にします。';
protected $AX_CIT_EMCPYL = 'メールコピー';
protected $AX_CIT_EMCPYD = '送信者のアドレスにメールをコピーするチェックボックスを表示/非表示にします。';
protected $AX_CIT_DDL = 'ドロップダウン';
protected $AX_CIT_DDD = '連絡先の閲覧にドロップダウンの選択一覧を表示/非表示にします。';
protected $AX_CIT_ICONTXL = 'アイコン/テキスト';
protected $AX_CIT_ICONTXD = '連絡先情報の表示の隣にアイコン、テキストを使用するか何も使用しません。';
protected $AX_CIT_ICONS = 'アイコン';
protected $AX_CIT_TEXT = 'テキスト';
protected $AX_CIT_NONE = 'なし';
protected $AX_CIT_ADICONL = '住所アイコン';
protected $AX_CIT_ADICOND = '住所用のアイコンです。';
protected $AX_CIT_EMICONL = 'メールアイコン';
protected $AX_CIT_EMICOND = 'メール用のアイコンです。';
protected $AX_CIT_TLICONL = '電話番号アイコン';
protected $AX_CIT_TLICOND = '電話番号用のアイコンです。';
protected $AX_CIT_FXICONL = 'Fax番号アイコン';
protected $AX_CIT_FXICOND = 'Fax番号用のアイコンです。';
protected $AX_CIT_MCICONL = 'その他アイコン';
protected $AX_CIT_MCICOND = 'その他情報用のアイコンです。';
protected $AX_CCT_NAMEL = '名前';
protected $AX_CCT_NAMED = '名前を表示/非表示にします。';
protected $AX_CCT_POSITL = '所在地';
protected $AX_CCT_POSITD = '所在地を表示/非表示にします。';
protected $AX_CCT_EMAILL = 'メール';
protected $AX_CCT_EMAILD = 'メールアイテムを表示/非表示にします。表示する設定の場合メールアドレスはJavascriptの隠匿機能でスパムボットから保護ざれます。';
protected $AX_CCT_SADDREL = '住所';
protected $AX_CCT_SADDRED = '住所情報を表示/非表示にします。';
protected $AX_CCT_TOWNL = '市区/町村';
protected $AX_CCT_TOWND = '市区町村の情報を表示/非表示にします。';
protected $AX_CCT_STATEL = '県';
protected $AX_CCT_STATED = '県の情報を表示/非表示にします。';
protected $AX_CCT_COUNTRL = '国';
protected $AX_CCT_COUNTRD = '国情報を表示/非表示にします。';
protected $AX_CCT_ZIPL = '郵便番号';
protected $AX_CCT_ZIPD = '郵便番号情報を表示/非表示にします。';
protected $AX_CCT_TELL = '電話番号';
protected $AX_CCT_TELD = '電話番号情報を表示/非表示にします。';
protected $AX_CCT_FAXL = 'Fax番号';
protected $AX_CCT_FAXD = 'Fax番号情報を表示/非表示にします。';
protected $AX_CCT_MISCL = 'その他情報';
protected $AX_CCT_MISCD = 'その他情報を表示/非表示にします。';
protected $AX_CCT_VCARDL = 'Vcard';
protected $AX_CCT_VCARDD = 'Vcardを表示/非表示にします。';
protected $AX_CCT_CIMGL = '画像';
protected $AX_CCT_CIMGD = '画像を表示/非表示にします。';
protected $AX_CCT_DEMAILL = 'メール説明';
protected $AX_CCT_DEMAILD = '以下の説明文を表示/非表示にします。';
protected $AX_CCT_DTXTL = '説明文';
protected $AX_CCT_DTXTD = 'メールフォームの説明文で、空白にすると言語で定義した_EMAIL_DESCRIPTIONを使用します。';
protected $AX_CCT_EMFRML = 'メールフォーム';
protected $AX_CCT_EMFRMD = 'メールフォームを表示/非表示にします。';
protected $AX_CCT_EMCPYL = 'メールコピー';
protected $AX_CCT_EMCPYD = '送信者のアドレスにメールをコピーするチェックボックスを表示/非表示にします。';
protected $AX_CCT_DDL = 'ドロップダウン';
protected $AX_CCT_DDD = '連絡先の閲覧にドロップダウンの選択一覧を表示/非表示にします。';
protected $AX_CCT_ICONTXL = 'アイコン/テキスト';
protected $AX_CCT_ICONTXD = '連絡先情報の表示の隣にアイコン、テキストを使用するか何も使用しません。';
protected $AX_CCT_ICONS = 'アイコン';
protected $AX_CCT_TEXT = 'テキスト';
protected $AX_CCT_NONE = 'なし';
protected $AX_CCT_ADICONL = '住所アイコン';
protected $AX_CCT_ADICOND = '住所用のアイコンです。';
protected $AX_CCT_EMICONL = 'メールアイコン';
protected $AX_CCT_EMICOND = 'メール用のアイコンです。';
protected $AX_CCT_TLICONL = '電話番号アイコン';
protected $AX_CCT_TLICOND = '電話番号用のアイコンです。';
protected $AX_CCT_FXICONL = 'Fax番号アイコン';
protected $AX_CCT_FXICOND = 'Fax番号用のアイコンです。';
protected $AX_CCT_MCICONL = 'その他アイコン';
protected $AX_CCT_MCICOND = 'その他情報用のアイコンです。';
//com_content/content.xml
protected $AX_CNT_CDESC = 'これは単一のコンテンツページを表示します。';
protected $AX_CNT_INTEXTL = '紹介文';
protected $AX_CNT_INTEXTD = '紹介文を表示/非表示にします。';
protected $AX_CNT_KEYRL = 'キー参照'; //Key Reference
protected $AX_CNT_KEYRD = 'アイテムが(ヘルプの参照のように)参照されるかもしれないテキストのキーです。';
//com_frontpage/frontpage.xml
protected $AX_FP_CDESC = 'このコンポーネントはフロントページ上で表示とマークされたサイトから公開されたコンテンツアイテムを全て表示します。'; //This component shows all the published content items from your site marked Show on Frontpage.
//com_login/login.xml
protected $AX_LG_CDESC = '個人の連絡先アイテムのパラメータです。';
protected $AX_LG_LPTL = 'ログインページタイトル';
protected $AX_LG_LPTD = 'ページのトップに表示するテキストです。空白ならメニュー名が代わりに利用されます。';
protected $AX_LG_LRURLL = 'ログイン転送URL';
protected $AX_LG_LRURLD = 'どんなページがログイン後に表示されるかで、空白ならフロントページが読み込まれます。';
protected $AX_LG_LJSML = 'ログインJavascript文';
protected $AX_LG_LJSMD = 'ログインの成功を示すJavascriptのポップアップを表示するかどうかです。';
protected $AX_LG_LDESCL = 'ログイン説明';
protected $AX_LG_LDESCD = '以下のログイン説明を表示するかどうかです。';
protected $AX_LG_LDESTL = 'ログイン説明文';
protected $AX_LG_LDESTD = 'ログインページに表示するテキストで、空白なら_LOGIN_DESCRIPTIONが使用されます。';
protected $AX_LG_LIMGL = 'ログイン画像';
protected $AX_LG_LIMGD = 'ログインページの画像です。';
protected $AX_LG_LIMGAL = 'ログイン画像位置';
protected $AX_LG_LIMGAD = 'ログイン画像の位置です。';
protected $AX_LG_LOPTL = 'ログアウトページのタイトル';
protected $AX_LG_LOPTD = 'ページのトップに表示するテキストです。空白ならメニュー名が代わりに利用されます。';
protected $AX_LG_LORURLL = 'ログアウト転送URL';
protected $AX_LG_LORURLD = 'どんなページがログアウト後に表示されるかで、空白ならフロントページが読み込まれます。';
protected $AX_LG_LOJSML = 'ログアウトJavascript文';
protected $AX_LG_LOJSMD = 'ログアウトの成功を示すJavascriptのポップアップを表示するかどうかです。';
protected $AX_LG_LODSCL = 'ログアウト説明';
protected $AX_LG_LODSCD = '以下のログアウト説明を表示するかどうかです。';
protected $AX_LG_LODSTL = 'ログアウト説明文';
protected $AX_LG_LODSTD = 'ログアウトページに表示するテキストで、空白なら_LOGOUT_DESCRIPTIONが使用されます。';
protected $AX_LG_LOGOIL = 'ログアウト画像';
protected $AX_LG_LOGOID = 'ログアウトページの画像です。';
protected $AX_LG_LOGOIAL = 'ログアウト画像位置';
protected $AX_LG_LOGOIAD = 'ログアウト画像の位置です。';
//com_massmail/massmail.xml
protected $AX_MM_CDESC = 'このコンポーネントはあるユーザグループの元へ大量のメールを送信することを許可します。';
//com_media/media.xml
protected $AX_ME_CDESC = 'このコンポーネントはサイトのメディアを管理します。';
//com_menumanager/menumanager.xml
protected $AX_MNU_CDESC = 'このコンポーネントはメニューを管理します。';
//com_menus/component_item_link/component_item_link.xml
protected $AX_MUCIL_CNAME = 'リンク - コンポーネントアイテム';
protected $AX_MUCIL_CDESC = '既存のElxisコンポーネントへのリンクを作成します。';
//com_menus/components/components.xml
protected $AX_MUCOMP_CNAME = 'コンポーネント';
protected $AX_MUCOMP_CDESC = 'コンポーネントのフロントエンドインタフェースを表示します。';
//com_menus/contact_category_table/contact_category_table.xml
protected $AX_MUCCT_CNAME = 'テーブル - 連絡先カテゴリ';
protected $AX_MUCCT_CDESC = '特別なカテゴリ用の連絡先アイテムについてのテーブルビューを表示します。';
protected $AX_MUCCT_CATDL = 'カテゴリ説明';
protected $AX_MUCCT_CATDD = 'その他のカテゴリの一覧の説明を表示/非表示にします。';
//com_menus/contact_item_link/contact_item_link.xml
protected $AX_MUCTIL_CNAME = 'リンク - 連絡先アイテム';
protected $AX_MUCTIL_CDESC = '公開された連絡先アイテムへのリンクを作成します。';
//com_menus/content_archive_category/content_archive_category.xml
protected $AX_MUCAC_CNAME = 'Blog - コンテンツカテゴリのアーカイブ';
protected $AX_MUCAC_CDESC = '特別なカテゴリ用のアーカイブされたコンテンツアイテムの一覧を表示します。';
//com_menus/content_archive_section/content_archive_section.xml
protected $AX_MUCAS_CNAME = 'Blog - コンテンツセクションのアーカイブ';
protected $AX_MUCAS_CDESC = '特別なセクション用のアーカイブされたコンテンツアイテムの一覧を表示します。';
//com_menus/content_blog_category/content_blog_category.xml
protected $AX_MUCBC_CNAME = 'Blog - コンテンツカテゴリ';
protected $AX_MUCBC_CDESC = 'Blog形式の複数のカテゴリからコンテンツアイテムのページを表示します。';
//com_menus/content_blog_section/content_blog_section.xml
protected $AX_MUCBS_CNAME = 'Blog - コンテンツセクション';
protected $AX_MUCBS_CDESC = 'Blog形式の複数のセクションからコンテンツアイテムのページを表示します。';
protected $AX_MUCBS_SHSD = 'セクションの説明を表示/非表示にします。';
//com_menus/content_category/content_category.xml
protected $AX_MUCC_CNAME = 'テーブル - コンテンツカテゴリ';
protected $AX_MUCC_CDESC = '特別なカテゴリ用のコンテンツアイテムのテーブルビューを表示します。';
protected $AX_MUCC_SHLOCD = 'その他カテゴリの一覧を表示/非表示にします。';
//com_menus/content_item_link/content_item_link.xml
protected $AX_MCIL_CNAME = 'リンク - コンテンツアイテム';
protected $AX_MCIL_CDESC = 'フルビューに公開されたコンテンツアイテムへのリンクを作成します。';
//com_menus/content_section/content_section.xml
protected $AX_MCS_CNAME = 'テーブル - コンテンツセクション';
protected $AX_MCS_CDESC = '特別なセクション用のコンテンツカテゴリの一覧を作成します。';
protected $AX_MCS_STL = 'セクションタイトル';
protected $AX_MCS_STD = 'セクションのタイトルを表示/非表示にします。';
protected $AX_MCS_SHCTID = 'カテゴリの説明画像を表示/非表示にします。';
//com_menus/content_typed/content_typed.xml
protected $AX_MLSC_CNAME = 'リンク - 独立ページ';
protected $AX_MLSC_CDESC = '独立ページアイテムへのリンクを作成します。';
//com_menus/newsfeed_category_table/newsfeed_category_table.xml
protected $AX_MNSFC_CNAME = 'テーブル - ニュースフィードカテゴリ';
protected $AX_MNSFC_CDESC = '特別なカテゴリ用のニュースフィードアイテムのテーブルビューを表示します。';
protected $AX_MNSFC_SHNCD = '名前欄を表示/非表示にします。';
protected $AX_MNSFC_ACL = '記事欄';
protected $AX_MNSFC_ACD = '記事欄を表示/非表示にします。';
protected $AX_MNSFC_LCL = 'リンク欄';
protected $AX_MNSFC_LCD = 'リンク欄を表示/非表示にします。';
//com_menus/newsfeed_link/newsfeed_link.xml
protected $AX_MNSFL_CNAME = 'リンク - ニュースフィード';
protected $AX_MNSFL_CDESC = '個々の公開されたニュースフィードへのリンクを作成します。';
protected $AX_MNSFL_FDIML = 'フィード画像';
protected $AX_MNSFL_FDIMD = 'フィードの画像を表示/非表示にします。';
protected $AX_MNSFL_FDDSL = 'フィード説明';
protected $AX_MNSFL_FDDSD = 'フィードの説明文を表示/非表示にします。';
protected $AX_MNSFL_WDCL = '単語数';
protected $AX_MNSFL_WDCD = '閲覧可能なアイテムの説明文の量を制限できます。0は全ての文を表示します。';
//com_menus/separator/separator.xml
protected $AX_MSEP_CNAME = 'セパレータ / プレースホルダ';
protected $AX_MSEP_CDESC = 'メニューのプレースホルダかセパレータを作成します。';
//com_menus/url/url.xml
protected $AX_MURL_CNAME = 'リンク - URL';
protected $AX_MURL_CDESC = 'URLへのリンクを作成します。';
//com_menus/weblink_category_table/weblink_category_table.xml
protected $AX_MWLC_CNAME = 'テーブル - ウェブリンクカテゴリ';
protected $AX_MWLC_CDESC = '特別なウェブリンクカテゴリ用のウェブリンクアイテムの一覧を表示します。';
//com_menus/wrapper/wrapper.xml
protected $AX_MWRP_CNAME = 'ラッパー';
protected $AX_MWRP_CDESC = 'Elxis内に外部のページ/サイトを表示する為のIFrameを作成します。';
protected $AX_MWRP_SCRBL = 'スクロールバー';
protected $AX_MWRP_SCRBD = '水平と垂直のスクロールバーを表示するかどうかです。';
protected $AX_MWRP_WDTL = '幅';
protected $AX_MWRP_WDTD = 'IFrameウィンドウの幅で、ピクセルの絶対値又は%を加えることによる相対値を入力できます。';
protected $AX_MWRP_HEIL = '高さ';
protected $AX_MWRP_HEID = 'IFrameウィンドウの高さです。';
protected $AX_MWRP_AHL = '自動的に高さ調整';
protected $AX_MWRP_AHD = '高さは外部ページのサイズに自動的に設定されます。これは自身のドメイン上のページでのみ動作します。';
protected $AX_MWRP_AADL = '自動的に追加';
protected $AX_MWRP_AADD = 'デフォルトで提供するURLにhttp://かhttps://を検出しない場合自動的にそれを追加します。この機能をオフにすることもできます。';
//com_menus/system/system.xml
protected $AX_MSYS_CNAME = 'システムリンク';
protected $AX_MSYS_CDESC = 'システム機能へのリンクを作成します。';
//com_newsfeeds/newsfeeds.xml
protected $AX_NFE_CDESC = 'このコンポーネントはRSS/RDFニュースフィードを管理します。';
protected $AX_NFE_DPD = 'ページの説明';
protected $AX_NFE_SHFNCD = 'フィードの名前欄を表示/非表示にします。';
protected $AX_NFE_NOACL = '# 記事数欄';
protected $AX_NFE_NOACD = 'フィードに記事数の#を表示/非表示にします。';
protected $AX_NFE_LCL = 'リンク欄';
protected $AX_NFE_LCD = 'フィードのリンク欄を表示/非表示にします。';
protected $AX_NFE_IDL = 'アイテム説明';
protected $AX_NFE_IDD = 'アイテムの紹介文又は説明を表示/非表示にします。';
//com_search/search.xml
protected $AX_SEAR_CDESC = 'このコンポーネントは検索機能を管理します。';
//com_syndicate/syndicate.xml
protected $AX_SYN_CDESC = 'このコンポーネントは記事配信(Syndication)の設定をコントロールします。'; //This component controls the Syndication settings.
protected $AX_SYN_CACHL = 'キャッシュ';
protected $AX_SYN_CACHD = 'フィードファイルのキャッシュです。';
protected $AX_SYN_CACHTL = 'キャッシュ時間';
protected $AX_SYN_CACHTD = 'キャッシュファイルはx秒毎に更新されます。';
protected $AX_SYN_ITMSL = '# アイテム数';
protected $AX_SYN_ITMSD = '配信するアイテムの数';
protected $AX_SYN_ITMSDFLT = 'Elxis配信(Syndication)';
protected $AX_SYN_TITLE = '配信タイトル';
protected $AX_SYN_DESCD = '配信の説明です。';
protected $AX_SYN_DESCDFLT = 'Elxisサイト配信(syndication)';
protected $AX_SYN_IMGD = '画像はフィードに含められます。';
protected $AX_SYN_IMGAL = '画像Alt';
protected $AX_SYN_IMGAD = '画像のAltテキストです。';
protected $AX_SYN_IMGADFLT = 'Powered by Elxis';
protected $AX_SYN_LMTL = 'テキストの制限';
protected $AX_SYN_LMTD = '以下に示された値へ記事のテキストを制限します。';
protected $AX_SYN_TLENL = 'テキストの長さ';
protected $AX_SYN_TLEND = '記事のテキストの単語の長さです - 0はテキストを表示しません。';
protected $AX_SYN_LBL = 'ライブブックマーク';
protected $AX_SYN_LBD = 'Firefoxのライブブックマーク機能のサポートを有効にします。';
protected $AX_SYN_BFL = 'ブックマークファイル';
protected $AX_SYN_BFD = '特別なファイル名で、殻にするとデフォルトが使用されます。';
protected $AX_SYN_ORDL = '並び順';
protected $AX_SYN_ORDD = 'アイテムが表示される並び順です。';
protected $AX_SYN_MULTIL = '多言語のフィード'; //Multi-lingual feeds
protected $AX_SYN_MULTILD = '「はい」の場合、Elxisはフィードを指定した言語で生成します。'; //If yes, Elxis will generate language specific feeds.
//com_trash/trash.xml
protected $AX_TRSH_CDESC = 'このコンポーネントはゴミ箱機能を管理します。';
//com_typedcontent/typedcontent.xml
protected $AX_TDC_CDESC = 'これは単一のコンテンツページを表示します。';
//com_weblinks/weblinks.xml
protected $AX_WBL_CDESC = 'このコンポーネントはサイトのスクリーンショット付きウェブリンクの一覧を表示します。';
protected $AX_WBL_LDL = 'リンク説明';
protected $AX_WBL_LDD = 'リンクの説明文を表示/非表示にします。';
protected $AX_WBL_ICL = 'アイコン';
protected $AX_WBL_ICD = 'テーブルビューのURLリンクの左に使用されるアイコンです。';
protected $AX_WBL_SCSL = 'スクリーンショット';
protected $AX_WBL_SCSD = 'リンクされたサイトのスクリーンショットを表示します。そのときに使用されれば上記のウェブリンクアイコンが表示されます。';
//com_weblinks/weblinks_item.xml
protected $AX_WBLI_TD = 'リンクがクリックされたときのウィンドウの開き方です。';
protected $AX_WBLI_OT01 = 'ブラウザナビゲーションつきの親ウィンドウ';
protected $AX_WBLI_OT02 = 'ブラウザナビゲーションつきの新しいウィンドウ';
protected $AX_WBLI_OT03 = 'ブラウザナビゲーション無しの新しいウィンドウ';
//ADMINISTRATOR MODULES
//administrator/modules/mod_latest.xml
protected $AX_AM_LN_DESC = 'このモジュールは、現在まだ良く見られている最近掲載されたアイテム(たとえそれらが最近のものでもいくつかは終了しているかもしれません)の一覧を表示します。フロントページコンポーネントに表示されるアイテムは一覧に含まれません。';
//administrator/modules/mod_logged.xml
protected $AX_AM_LG_DESC = 'このモジュールは現在ログインしているユーザの一覧を表示します。';
//administrator/modules/mod_popular.xml
protected $AX_AM_PI_DESC = 'このモジュールは、現在まだ良く見られている人気の掲載されたアイテム(たとえそれが最近のものでもいくつかは終了しているかもしれません)の一覧を表示します。フロントページコンポーネントに表示されるアイテムは一覧に含まれません。';
//administrator/modules/mod_stats.xml
protected $AX_AM_ST_DESC = 'このモジュールは、現在まだ良く見られているアイテム(たとえそれが最近のものでもいくつかは終了しているかもしれません)の状態を表示します。フロントページコンポーネントに表示されるアイテムは一覧に含まれません。';
//SITE MODULES
//General
protected $AX_SM_MCSL = 'モジュールクラス接尾語';
protected $AX_SM_MCSD = 'モジュール(table.moduletable)のcssクラスに適用されるべき接尾語であり、これは個別のモジュールスタイルを許可します。';
protected $AX_SM_MUCSL = 'メニュークラス接尾語';
protected $AX_SM_MUCSD = 'メニューアイテムのcssクラスへ適用される接尾語です。';
protected $AX_SM_ECL = 'キャッシュの有効化';
protected $AX_SM_ECD = 'このモジュールのコンテンツをキャッシュするかどうかを選択します。';
protected $AX_SM_SMIL = 'メニューアイコンの表示';
protected $AX_SM_SMID = 'メニューアイテムに選択したメニューアイコンを表示します。';
protected $AX_SM_MIAL = 'メニューアイコンの位置(Alignment)';
protected $AX_SM_MIAD = 'メニューアイコンの位置です。';
protected $AX_SM_MODL = 'モジュールモード';
protected $AX_SM_MODD = 'モジュールでコンテンツのどのタイプを表示したらよいかをコントロールすることができます。';
protected $AX_SM_OP01 = 'コンテンツアイテムのみ';
protected $AX_SM_OP02 = '独立ページのみ';
protected $AX_SM_OP03 = '両方';
//modules/custom.xml
protected $AX_SM_CU_DESC = 'カスタムモジュールです。';
protected $AX_SM_CU_RSURL = 'RSS URL';
protected $AX_SM_CU_RSURD = 'RSS/RDFフィードのURLを入力します。';
protected $AX_SM_CU_FEDL = 'フィード説明';
protected $AX_SM_CU_FEDD = '全体のフィードの説明文を表示します。';
protected $AX_SM_CU_FEIL = 'フィード画像';
protected $AX_SM_CU_FEDID = '全体のフィードで割り当てられた画像を表示します。';
protected $AX_SM_CU_ITL = 'アイテム';
protected $AX_SM_CU_ITD = '表示するRSSアイテム数を入力します。';
protected $AX_SM_CU_ITDL = 'アイテム説明';
protected $AX_SM_CU_ITDD = '個別のニュースアイテムの紹介文又は説明を表示します。';
protected $AX_SM_CU_WCL = '単語数';
protected $AX_SM_CU_WCD = 'アイテムの説明文を見ることができる量の制限ができます。0は全てのテキストを表示します。';
//modules/mod_archive.xml
protected $AX_SM_AR_DESC = 'このモジュールはアーカイブされたアイテムを含む月間カレンダーの一覧を表示します。コンテンツアイテムの状態を「アーカイブ済み」に変更した後に、この一覧は自動的に生成されます。';
protected $AX_SM_AR_CNTL = 'カウント';
protected $AX_SM_AR_CNTD = '表示するアイテム数(デフォルトは10)です。';
//modules/mod_banners.xml
protected $AX_SM_BN_DESC = 'バナーモジュールはサイトの中にあるコンポーネントからのアクティブなバナーを表示することができます。';
protected $AX_SM_BN_CNTL = 'バナークライアント';
protected $AX_SM_BN_CNTD = 'バナークライアントIDの参照です。(Reference)「,」で区切って入力します。';
protected $AX_SM_BN_NBSL = '表示されるバナー数';
protected $AX_SM_BN_NBPRL = '列ごとのバナー数';
protected $AX_SM_BN_NBPRD = '列ごとのバナー数で、無効にするには0に設定します。垂直にバナーを表示するには1を設定します。';
protected $AX_SM_BN_UNQBL = 'ユニークバナー'; //Unique Banners
protected $AX_SM_BN_UNQBD = 'バナーが全て表示されている場合、バナーは常に2回以上(1セッション当たり)表示されず、次に履歴はクリアされて再開されます。';
//modules/mod_latestnews.xml
protected $AX_SM_LN_DESC = 'このモジュールは、現在まだ良く見られている最近掲載されたアイテム(たとえそれらが最近のものでもいくつかは終了しているかもしれません)の一覧を表示します。フロントページコンポーネントに表示されるアイテムは一覧に含まれません。';
protected $AX_SM_LN_FPIL = 'フロントページアイテム';
protected $AX_SM_LN_FPID = 'フロントページにデザインされたアイテムを表示するかどうかです - コンテンツアイテムのモードのみの場合動作のみします。';
protected $AX_SM_AR_CNT5D = '表示するアイテム数(デフォルトは5)です。';
protected $AX_SM_LN_CATIL = 'カテゴリID';
protected $AX_SM_LN_CATID = 'カテゴリの設定又は特定のカテゴリからアイテムを選択します。(1つ以上のカテゴリを指定するにはカンマ「,」で区切ります)';
protected $AX_SM_LN_SECIL = 'セクションID';
protected $AX_SM_LN_SECID = 'セクションの設定又は特定のセクションからアイテムを選択します。(1つ以上のセクションを指定するにはカンマ「,」で区切ります)';
//modules/mod_login.xml
protected $AX_SM_LF_DESC = 'このモジュールはユーザ名とパスワードのログインフォームを表示します。また、パスワード忘れの相対リンクも表示します。ユーザ登録が有効の場合(設定を参照)、ユーザ自身が登録できるページへの別のリンクが表示されます。';
protected $AX_SM_LF_PTL = 'Pre-text';
protected $AX_SM_LF_PTD = 'これはログインフォームの上に表示されるテキスト又はHTMLです。';
protected $AX_SM_LF_PSTL = 'Post-text';
protected $AX_SM_LF_PSTD = 'これはログインフォームの下に表示されるテキスト又はHTMLです。';
protected $AX_SM_LF_LRUL = 'ログイン転送URL';
protected $AX_SM_LF_LRUD = 'どのページがログイン後に転送されるかで、空白ならフロントページを読み込みます。';
protected $AX_SM_LF_LORUL = 'ログアウト転送URL';
protected $AX_SM_LF_LORUD = 'どのページがログアウト後に表示されるかで、空白ならフロントページを読み込みます。';
protected $AX_SM_LF_LML = 'ログインメッセージ';
protected $AX_SM_LF_LMD = 'ログインの成功にJavascriptのポップアップを表示/非表示にします。';
protected $AX_SM_LF_LOML = 'ログアウトメッセージ';
protected $AX_SM_LF_LOMD = 'ログアウトの成功にJavascriptのポップアップを表示/非表示にします。';
protected $AX_SM_LF_GML = 'あいさつ文';
protected $AX_SM_LF_GMD = '簡単なあいさつ文を表示/非表示にします。';
protected $AX_SM_LF_NUNL = '名前/ユーザ名';
protected $AX_SM_LF_OP01 = 'ユーザ名';
protected $AX_SM_LF_OP02 = '名前';
//modules/mod_mainmenu.xml
protected $AX_SM_MNM_DESC = 'メニューを表示します。';
protected $AX_SM_MNM_MNL = 'メニュー名';
protected $AX_SM_MNM_MND = 'メニューの名前(デフォルトは「mainmenu」)です。';
protected $AX_SM_MNM_MSL = 'メニュースタイル';
protected $AX_SM_MNM_MSD = 'メニューのスタイルです';
protected $AX_SM_MNM_OP1 = '垂直';
protected $AX_SM_MNM_OP2 = '水平';
protected $AX_SM_MNM_OP3 = '平坦な一覧';
protected $AX_SM_MNM_EML = 'メニューの拡張';
protected $AX_SM_MNM_EMD = 'メニューを広げて常に閲覧可能なサブメニューアイテムを作成します。';
protected $AX_SM_MNM_IIL = 'インデント画像';
protected $AX_SM_MNM_IID = 'どのインデント画像システムを利用するかを選択します。';
protected $AX_SM_MNM_OP4 = 'テンプレート';
protected $AX_SM_MNM_OP5 = 'Elxisのデフォルト画像';
protected $AX_SM_MNM_OP6 = '以下のパラメータを使用';
protected $AX_SM_MNM_OP7 = 'なし';
protected $AX_SM_MNM_II1L = 'インデント画像 1';
protected $AX_SM_MNM_II1D = '1番目のサブレベルの画像です。';
protected $AX_SM_MNM_II2L = 'インデント画像 2';
protected $AX_SM_MNM_II2D = '2番目のサブレベルの画像です。';
protected $AX_SM_MNM_II3L = 'インデント画像 3';
protected $AX_SM_MNM_II3D = '3番目のサブレベルの画像です。';
protected $AX_SM_MNM_II4L = 'インデント画像 4';
protected $AX_SM_MNM_II4D = '4番目のサブレベルの画像です。';
protected $AX_SM_MNM_II5L = 'インデント画像 5';
protected $AX_SM_MNM_II5D = '5番目のサブレベルの画像です。';
protected $AX_SM_MNM_II6L = 'インデント画像 6';
protected $AX_SM_MNM_II6D = '6番目のサブレベルの画像です。';
protected $AX_SM_MNM_SPL = 'スペーサー';
protected $AX_SM_MNM_SPD = '水平メニューのスペーサーです。';
protected $AX_SM_MNM_ESL = 'スペーサーの終わり';
protected $AX_SM_MNM_ESD = '水平メニューのスペーサーの終わりです。';
protected $AX_SM_MNM_IDPR = 'SEOプロのアイテムIDの事前読込'; //SEO PRO Itemid preload
protected $AX_SM_MNM_IDPRD = '同一ページを示す1つ以上のメニューリンクを持っているとき、アイテムIDのAJAXの事前読込が有効にすると、適切なメニューアイテムの設定の問題が解決されます。'; //Enabling AJAX preload of Itemid solves the issue of proper menu item setting when having more than one menu links that point to the same page.
//modules/mod_mostread.xml
protected $AX_SM_MRC_DESC = 'このモジュールは最も多く閲覧された現在掲載済みのアイテムの一覧を表示します - 閲覧されたページの回数で決定されます。';
protected $AX_SM_MRC_MNL = 'メニュー名';
protected $AX_SM_MRC_MND = 'メニュー名(デフォルトはmainmenu)です。';
protected $AX_SM_MRC_FPIL = 'フロントページアイテム';
protected $AX_SM_MRC_FPID = 'フロントページのためにデザインされたアイテムを表示するかどうかです - コンテンツアイテムのみのモードのとき動作のみします。';
protected $AX_SM_MRC_CL = 'カウント';
protected $AX_SM_MRC_CD = '表示するアイテム数(デフォルトは5)です。';
protected $AX_SM_MRC_CIDL = 'カテゴリID';
protected $AX_SM_MRC_CIDD = 'カテゴリの設定又は特定のカテゴリからアイテムを選択します。(1つ以上のカテゴリを指定するにはカンマ「,」で区切ります)';
protected $AX_SM_MRC_SIDL = 'セクションID';
protected $AX_SM_MRC_SIDD = 'セクションの設定又は特定のセクションからアイテムを選択します。(1つ以上のセクションを指定するにはカンマ「,」で区切ります)';
//modules/mod_newsflash.xml
protected $AX_SM_NWF_DESC = 'ニュース速報モジュールはランダムに各ページの更新上のカテゴリから掲載済みアイテムの一つを選択します。更に、それは水平又は垂直設定の中に複数のアイテムを表示するかもしれません。';
protected $AX_SM_NWF_CATL = 'カテゴリ';
protected $AX_SM_NWF_CATD = 'コンテンツカテゴリです。';
protected $AX_SM_NWF_STL = 'スタイル';
protected $AX_SM_NWF_STD = 'カテゴリを表示するスタイルです。';
protected $AX_SM_NWF_OP1 = 'ランダムに1度に1つ選択します';
protected $AX_SM_NWF_OP2 = '水平';
protected $AX_SM_NWF_OP3 = '垂直';
protected $AX_SM_NWF_SIL = '画像の表示Show images';
protected $AX_SM_NWF_SID = 'コンテンツアイテムの画像を表示します。';
protected $AX_SM_NWF_LTL = 'リンクされたタイトル';
protected $AX_SM_NWF_LTD = 'リンク可能なアイテムのタイトルを作成します。';
protected $AX_SM_NWF_RML = '続きを読む';
protected $AX_SM_NWF_RMD = '「続きを読む」ボタンを表示するかどうかです。';
protected $AX_SM_NWF_ITL = 'アイテムのタイトル';
protected $AX_SM_NWF_ITD = 'アイテムのタイトルを表示します。';
protected $AX_SM_NWF_NOIL = 'アイテム数';
protected $AX_SM_NWF_NOID = '表示するアイテム数です。';
//modules/mod_poll.xml
protected $AX_SM_POL_DESC = 'このモジュールは投票コンポーネントを提供します。それは設定された投票を表示するために使用されます。モジュールはメニューアイテムと投票の間にリンクするコンポーネントのサポートするので他のモジュールとは異なっています。これはモジュールがそれらの投票だけ(それらはあるメニューアイテムのために設定される)を示すことを意味します。';
protected $AX_SM_POL_CATL = 'カテゴリ';
protected $AX_SM_POL_CATD = 'コンテンツカテゴリです。';
//modules/mod_random_image.xml
protected $AX_SM_RNI_DESC = 'このモジュールは選択されたディレクトリからランダム画像を表示します。';
protected $AX_SM_RNI_ITL = '画像タイプ';
protected $AX_SM_RNI_ITD = 'PNG/GIF/JPG等の画像タイプ(デフォルトはJPG)です。';
protected $AX_SM_RNI_IFL = '画像フォルダ';
protected $AX_SM_RNI_IFD = '画像フォルダの相対パスです。(例: images/stories)';
protected $AX_SM_RNI_LNL = 'リンク';
protected $AX_SM_RNI_LND = '画像をクリックすると転送するURLです。(例: http://www.example.com)';
protected $AX_SM_RNI_WL = '幅(px)';
protected $AX_SM_RNI_WD = '画像の幅です。(全ての画像は強制的にこの幅で表示されます)';
protected $AX_SM_RNI_HL = '高さ(px)';
protected $AX_SM_RNI_HD = '画像の高さです。(全ての画像は強制的にこの高さで表示されます)';
//modules/mod_related_items.xml
protected $AX_SM_RLI_DESC = 'このモジュールは現在表示されたアイテムと関係のあるほかのコンテンツアイテムを表示します。これらはキーワード・メタデータに基づきます。現在のコンテンツアイテムのキーワードは他の全ての掲載されたアイテムの全てのキーワードに対して検索されます。例えば、「大理石彫刻品」上にアイテムを持ってるかもしれません。また、「パルテノン」上に別のものを持ってるかもしれません。両方のアイテムにキーワード「大理石」を含めば「パルテノン」を見るとき、関連するアイテムモジュールは「大理石彫刻品」アイテムをリストし、その逆もありえます。';
//modules/mod_rssfeed.xml
protected $AX_SM_RSS_DESC = '配信(Syndicate)モジュールはそれによって人々があなたの最新ニュースのためのあなたのサイトを配信することができるリンクを表示します。RSSアイコンをクリックするとき、XML形式で最新のニュースを一覧する新しいページに転送されます。別のElxisのサイトあるいはRSSリーダーの中でニュースフィードを使用するためにカット＆ペーストにURLを必要とします。';
protected $AX_SM_RSS_TXL = 'テキスト';
protected $AX_SM_RSS_TXD = 'RSSリンクと共に表示されるテキストを入力します。';
protected $AX_SM_RSS_091D = 'RSS 0.91のリンクを表示するかどうかです。';
protected $AX_SM_RSS_10D = 'RSS 1.0のリンクを表示するかどうかです。';
protected $AX_SM_RSS_20D = 'RSS 2.0のリンクを表示するかどうかです。';
protected $AX_SM_RSS_03D = 'Atom 0.3リンクを表示するかどうかです。';
protected $AX_SM_RSS_OPD = 'OPMLリンクを表示するかどうかです。';
protected $AX_SM_RSS_I091L = 'RSS 0.91画像';
protected $AX_SM_RSS_I10L = 'RSS 1.0画像';
protected $AX_SM_RSS_I20L = 'RSS 2.0画像';
protected $AX_SM_RSS_I03L = 'Atom画像';
protected $AX_SM_RSS_IOPL = 'OPML画像';
protected $AX_SM_RSS_CHID = '使用される画像を選択します。';
//modules/mod_search.xml
protected $AX_SM_SEM_DESC = 'このモジュールは検索ボックスを表示します。';
protected $AX_SM_SEM_TOP = '上';
protected $AX_SM_SEM_BTM = '下';
protected $AX_SM_SEM_BWL = 'ボックス幅';
protected $AX_SM_SEM_BWD = '検索テキストボックスのサイズです。';
protected $AX_SM_SEM_TXL = 'テキスト';
protected $AX_SM_SEM_TXD = '検索テキストボックスに表示されるテキストで、空白なら言語ファイルから_SEARCH_BOXを読み込みます。';
protected $AX_SM_SEM_BPL = 'ボタン位置';
protected $AX_SM_SEM_BPD = '検索ボックスのボタンの相対位置です。';
protected $AX_SM_SEM_BTXL = 'ボタンのテキスト';
protected $AX_SM_SEM_BTXD = '検索ボタンに表示されるテキストで空白なら言語ファイルから_SEARCH_TITLEを読み込みます。';
//modules/mod_sections.xml
protected $AX_SM_SEC_DESC = 'セクションモジュールはデータベースに設定された全てのセクションの一覧を表示します。ここではセクションはアイテムのセクションのみを指します。設定で「未承認リンクを表示」に設定してある場合、一覧はユーザが見ることを許可されたセクションへ制限されます。';
protected $AX_SM_SEC_CL = 'カウント';
protected $AX_SM_SEC_CD = '表示するアイテム数(デフォルトは5)です。';
//modules/mod_stats.xml
protected $AX_SM_STA_DESC = '統計モジュールはサーバのインストール情報の表示と、ウェブサイトのユーザ、データベース内のコンテンツ数、そして提供するウェブリンク数の統計を表示します。';
protected $AX_SM_STA_SVIL = 'サーバ情報';
protected $AX_SM_STA_SVID = 'サーバ情報を表示します。';
protected $AX_SM_STA_SIL = 'サイト情報';
protected $AX_SM_STA_SID = 'サイト情報を表示します。';
protected $AX_SM_STA_HCL = 'ヒットカウンター';
protected $AX_SM_STA_HCD = 'ヒットカウンターを表示します。';
protected $AX_SM_STA_ICL = 'カウンターの増加';
protected $AX_SM_STA_ICD = 'カウンターを増加させるヒット量を入力します。';
//modules/mod_templatechooser.xml
protected $AX_SM_TMC_DESC = 'テンプレート選択モジュールでユーザ(訪問者)はフロントエンドからドロップダウンの選択一覧でテンプレートをすぐに変更することができます。';
protected $AX_SM_TMC_MNLL = '最大の名前の長さ';
protected $AX_SM_TMC_MNLD = 'これは表示するテンプレート名の最大の長さ(デフォルトは20)です。';
protected $AX_SM_TMC_SPL = 'プレビューを表示';
protected $AX_SM_TMC_SPD = 'テンプレートのプレビューが表示されます。';
protected $AX_SM_TMC_WL = '幅';
protected $AX_SM_TMC_WD = 'これはプレビュー画像の幅(デフォルトは140px)です。';
protected $AX_SM_TMC_HL = '高さ';
protected $AX_SM_TMC_HD = 'これはプレビュー画像の高さ(デフォルトは90px)です。';
//modules/mod_whosonline.xml
protected $AX_SM_WSO_DESC = 'オンラインユーザモジュールは現在ウェブサイトにアクセスをしている匿名ユーザ(ゲスト)及び登録済みユーザの数を表示します。';
protected $AX_SM_WSO_DL = '表示';
protected $AX_SM_WSO_DD = '何が表示されるかを選択します。';
protected $AX_SM_WSO_OP1 = '# ゲスト/メンバー数<br />';
protected $AX_SM_WSO_OP2 = 'メンバー名<br />';
protected $AX_SM_WSO_OP3 = '両方';
//modules/mod_wrapper.xml
protected $AX_SM_WRM_DESC = 'このモジュールは指定された位置にIFrameウィンドウを表示します。';
protected $AX_SM_WRM_URLL = 'URL';
protected $AX_SM_WRM_URLD = 'IFrameの中に表示したいサイト/ファイルのURL';
protected $AX_SM_WRM_SCBL = 'スクロールバー';
protected $AX_SM_WRM_SCBD = '水平/垂直のスクロールバーを表示するかどうかです。';
protected $AX_SM_WRM_WL = '幅';
protected $AX_SM_WRM_WD = 'IFrameウィンドウの幅で、ピクセルで物理値又は%を追加して相対値を入力することができます。';
protected $AX_SM_WRM_HL = '高さ';
protected $AX_SM_WRM_HD = 'IFrameウィンドウの高さです。';
protected $AX_SM_WRM_AHL = '自動的に高さ調整';
protected $AX_SM_WRM_AHD = '高さは外部のページサイズに自動的に設定されます。これは自身のドメイン上でのみ動作します。';
protected $AX_SM_WRM_ADL = '自動的に追加';
protected $AX_SM_WRM_ADD = 'デフォルトで提供するURLのリンクにhttp://又はhttps://が含まれない場合http://が追加されます。この機能をオフに切り替えることができます。';
/* mambots/editors/tinymce */
protected $AX_ED_FUNCTL = '機能';
protected $AX_ED_FUNCTD = '機能を選択します';
protected $AX_ED_FUNSIMPLE = '簡単';
protected $AX_ED_FUNADV = '高度';
protected $AX_ED_EDITORWIDTHL = 'エディタ幅';
protected $AX_ED_EDITORWIDTHD = 'エディタの幅を指定します。';
protected $AX_ED_EDITORHEIGHTL = 'エディタ高さ';
protected $AX_ED_EDITORHEIGHTD = 'エディタの高さを指定します。';
protected $AX_ED_COMPRESSEDVL = '圧縮バージョン';
protected $AX_ED_COMPRESSEDVD = 'TinyMCEはわずかに速い読込速度の圧縮モードで実行することができます。しかしながらこのモードは必ずしも動作するとは限りません(特にIEはデフォルトでこれがオフのなので)。これがシステム上で動作を保証するのを可能にするとき、注意してください。';
protected $AX_ED_OFF = 'オフ';
protected $AX_ED_ON = 'オン';
protected $AX_ED_COMPRESSL = '圧縮';
protected $AX_ED_COMPRESSD = '圧縮TinyMCEエディタはzgipを使用します(読込が75%速くなります)';
protected $AX_ED_CONVERTURLL = 'URL変換';
protected $AX_ED_CONVERTURLD = '物理URLから相対へ変換します。'; //Convert Absolute URLs to relative.
protected $AX_ED_ENTENCODL = 'エンティティエンコーディング';
protected $AX_ED_ENTENCODD = 'このオプションはエンティティ/文字がTinyMCEでどうやって処理されるかをコントロールします。コード化が行われない場合、値はエンティティと命名されて、数値表現に設定するかあるいは生のままになります。このオプションのデフォルト値が指定されます。';
protected $AX_ED_TXTDIRL = 'テキストの向き';
protected $AX_ED_TXTDIRD = 'テキストの方向を変更する機能です';
protected $AX_ED_CNVFONTSPANL = 'FontからSpanへ変換';
protected $AX_ED_CNVFONTSPAND = 'Font要素からSpan要素へ変換します。デフォルトはFont要素が重複しているとき「はい」になります。';
protected $AX_ED_FONTSIZETYPEL = 'フォントサイズのタイプ';
protected $AX_ED_FONTSIZETYPED = '使用するフォントサイズのタイプを選択、又は長さ(例:10pt)、又は実寸(例: x-small)を選択します。';
protected $AX_ED_INLTABLEDITL = 'インラインテーブル編集';
protected $AX_ED_INLTABLEDITD = 'テーブルのインライン編集を許可します。';
protected $AX_ED_PROHELEMENTSL = '禁止要素(Prohibited Elements)';
protected $AX_ED_PROHELEMENTSD = 'テキストから削除される要素';
protected $AX_ED_EXTELEMENTSL = '拡張要素';
protected $AX_ED_EXTELEMENTSD = 'ここへ外部要素を追加することでJCE機能を拡張します。例： elm[tag1][tag2]';
protected $AX_ED_EVELEMENTSL = 'イベント要素';
protected $AX_ED_EVELEMENTSD = 'このオプションはカンマ「,」で区切られたようその一覧を含むべきで、それらはonclickとそれに類似したイベント属性を持っているかもしれません。いくつかのブラウザがコンテンツを編集する間にこれらのイベントを実行するため、このオプションは必要です。';
protected $AX_ED_TCSSCLASSESL = 'テンプレートCSSクラス';
protected $AX_ED_TCSSCLASSESD = 'template_css.cssからCSSクラスを読み込みます';
protected $AX_ED_CCSSCLASSESL = 'カスタムCSSクラス';
protected $AX_ED_CCSSCLASSESD = 'カスタムCSSファイルの読込を指定できます - 単に代わりのcssファイル名を入力するだけです。このファイルはテンプレートCSSファイルと同じフォルダに配置されていなければなりません。';
protected $AX_ED_NEWLINESL = '改行';
protected $AX_ED_NEWLINESD = '改行は選択されたオプションの中に作成されます。';
protected $AX_ED_TOOLBARL = 'ツールバー';
protected $AX_ED_TOOLBARD = 'ツールバーの位置です。';
protected $AX_ED_HTMLHEIGHTL = 'HTMLの高さ';
protected $AX_ED_HTMLHEIGHTD = 'HTMLモードのポップアップウィンドウの高さです。';
protected $AX_ED_HTMLWIDTHL = 'HTMLの幅';
protected $AX_ED_HTMLWIDTHD = 'HTMLモードのポップアップウィンドウの幅です。';
protected $AX_ED_PREVIEWHEIGHTL = 'プレビューの高さ';
protected $AX_ED_PREVIEWHEIGHTD = 'プレビューモードのポップアップウィンドウの高さです。';
protected $AX_ED_PREVIEWWIDTHL = 'プレビューの幅';
protected $AX_ED_PREVIEWWIDTHD = 'プレビューモードのポップアップウィンドウの幅です。';
protected $AX_ED_IBROWSERL = 'iBrowserプラグイン';
protected $AX_ED_IBROWSERD = 'iBrowserは高度な画像マネージャです。';
protected $AX_ED_PLTABLESL = 'テーブルプラグイン';
protected $AX_ED_PLTABLESD = 'WYSIWYGモードでテーブルの編集を有効にします。';
protected $AX_ED_PLPASTEL = '貼り付けプラグイン';
protected $AX_ED_PLPASTED = '単語から貼り付け、プレーンテキストの貼り付けそして全て選択を有効にします。';
protected $AX_ED_PLIMGPLUGINL = '高度な画像プラグイン';
protected $AX_ED_PLIMGPLUGIND = '高度な画像マネージャを有効にします。デフォルトで簡単な画像エディタは有効になっています。';
protected $AX_ED_PLSEARCHL = '検索/置き換えプラグイン';
protected $AX_ED_PLSEARCHD = '検索と置き換えプラグインを有効にします。';
protected $AX_ED_PLLINKSL = '高度なリンクプラグイン';
protected $AX_ED_PLLINKSD = '高度なリンクマネージャを有効にします。デフォルトで簡単なリンクエディタは有効になっています。';
protected $AX_ED_PLEMOTL = '絵文字プラグイン';
protected $AX_ED_PLEMOTD = '絵文字プラグインを有効にします。簡単に絵文字を追加することができます。';
protected $AX_ED_PLFLASHL = 'Flashプラグイン';
protected $AX_ED_PLFLASHD = 'Flashプラグインを有効にします。コンテンツにFlashを追加することができます。';
protected $AX_ED_PLDTL = '日付/時刻プラグイン';
protected $AX_ED_PLDTD = '日付/時刻プラグインを有効にします。現在の日付と時刻を追加することができます。';
protected $AX_ED_PLPREVL = 'プレビュープラグイン';
protected $AX_ED_PLPREVD = 'このプラグインはTinyMCEへプレビューボタンを追加し、ボタンを押すことで現在のコンテンツを表示するポップアップを開きます。';
protected $AX_ED_PLZOOML = 'ズームプラグイン';
protected $AX_ED_PLZOOMD = 'IE5.5以上でズームドロップリストを追加します。このプラグインはプラグインとしてカスタムドロップリストを追加する方法を表示するために作成されました。';
protected $AX_ED_PLFSCRL = 'フルスクリーンプラグイン';
protected $AX_ED_PLFSCRD = 'このプラグインはTinyMCEへフルスクリーン編集モードを追加します。';
protected $AX_ED_PLPRINTL = '印刷プラグイン';
protected $AX_ED_PLPRINTD = 'このプラグインはTinyMCEへ印刷ボタンを追加します。';
protected $AX_ED_PLDIRL = '方向のプラグイン(Directionality Plugin)';
protected $AX_ED_PLDIRD = 'このプラグインは右から左へ書かれる言語をうまく扱うことをTinyMCEへ有効にする方向のアイコンを追加します。';
protected $AX_ED_PLFONTSL = 'フォント選択一覧';
protected $AX_ED_PLFONTSD = 'このプラグインはフォントを選択するためのドロップダウンリストを追加します。';
protected $AX_ED_PLFONTSZL = 'フォントサイズ一覧';
protected $AX_ED_PLFONTSZD = 'このプラグインはフォントサイズを選択するためのドロップダウンリストを追加します。';
protected $AX_ED_PLFORMLSL = '形式一覧';
protected $AX_ED_PLFORMLSD = 'このプラグインは形式一覧のためのドロップダウンリストを追加します。(例：H1, H2 等)';
protected $AX_ED_PLSSLL = 'スタイル選択一覧';
protected $AX_ED_PLSSLD = 'このプラグインは現在のテンプレート又は選択したCSSファイルを元にスタイル選択の一覧を追加します。';
protected $AX_ED_NAMED = '命名'; //Named';
protected $AX_ED_NUMERIC = '数字'; //Numeric';
protected $AX_ED_RAW = 'Raw';
protected $AX_ED_LTR = '左から右へ'; //Left to Right
protected $AX_ED_RTL = '右から左へ'; //Right to Left
protected $AX_ED_LENGTH = '長さ'; //Length
protected $AX_ED_ABSSIZE = '物理サイズ'; //Absolute-Size
protected $AX_ED_BRELEMENTS = 'BR要素';
protected $AX_ED_PELEMENTS = 'P要素';
//TOOLS
//Calculator: /administrator/tools/calculator/calculator.xml
protected $AX_TCAL_L = '電卓';
protected $AX_TCAL_D = '高度なJavascript電卓です';
//Empty Temporary: /administrator/tools/empty_temporary/empty_temporary.xml
protected $AX_TEMTEMP_L = 'テンポラリを空にする';
protected $AX_TEMTEMP_D = 'Elxisの一時フォルダ(/tmpr)を空にします。';
//FixLanguage: /administrator/tools/fix_language/fix_language.xml
protected $AX_TFIXLANG_L = '言語修正';
protected $AX_TFIXLANG_D = '多言語データベーステーブルのチェックを実行し、必要な修正を適用します。';
//Organizer: /administrator/tools/organizer/organizer.xml
protected $AX_TORGANIZ_L = 'オーガナイザー(Organizer)';
protected $AX_TORGANIZ_D = 'Elxis Organizerは連絡先、ノート、ブックマーク、予約を保持します。';
//Clean Cache: /administrator/tools/clean_cache/clean_cache.xml
protected $AX_TCLEANCACHE_L = 'キャッシュのクリア';
protected $AX_TCLEANCACHE_D = 'キャッシュディレクトリにあるキャッシュされたコンテンツアイテムと画像をクリアします。';
//Chmod: /administrator/tools/chmod/chmod.xml
protected $AX_TCHMOD_L = 'モードの変更';
protected $AX_TCHMOD_D = '与えられたファイル又はフォルダへのモードを変更します。';
//FixPgSequences: /administrator/tools/fix_pg_sequences/fix_pg_sequences.xml
protected $AX_TFPGSEQ_L = 'Postgresシーケンスの修正';
protected $AX_TFPGSEQ_D = '必要ならPostgresのシーケンスを修正します。';
//Elxis Registration: /administrator/tools/registration/registration.xml
protected $AX_TELXREG_L = 'Elxisの登録';
protected $AX_TELXREG_D = 'GO UP社へあなたのElxisを登録します。';
//com_menus/bridge/bridge.xml
protected $AX_BRIDGE_CNAME = 'ブリッジ';
protected $AX_BRIDGE_CDESC = 'ブリッジへのリンクを作成します。';
//modules/mod_language.xml
protected $AX_NEW_LINE = '新しい行'; //New line
protected $AX_SAME_LINE = '同じ行'; //Same line
protected $AX_INDICATOR = '指標(Indicator)';
protected $AX_INDICATOR_D = '指標として単語言語を表示する'; //Displays the word Language as an Indicator
protected $AX_FLAG = '国旗';
//modules/mod_language.xml
protected $AX_MODLANGD = 'ドロップダウン一覧、リンク一覧又は一連の国旗としてフロントエンドの言語指標を表示します。'; //Displays Front-End language selector as a dropdown list, links list, or series of flags.
protected $AX_FLAGS = '国旗';
protected $AX_SMARTSW = 'スマートスイッチ'; //Smart Switch
protected $AX_SMARTSW_D = 'いくつかの条件下の同じページ内で言語の切り替えと滞在を許可します。';
//modules/mod_random_profile.xml
protected $AX_RP_DESC = 'ユーザのランダムプロフィールを表示します。'; //Displays users random profiles
protected $AX_DISPSTYLE = '表示スタイル';
protected $AX_COMPACT = 'コンパクト';
protected $AX_EXTENDED = '拡張';
protected $AX_GENDER = '性別';
protected $AX_GENDERDESC = 'ユーザの性別を表示しますか？';
protected $AX_AGE = '年齢';
protected $AX_AGEDESC = 'ユーザの年齢を表示しますか？';
protected $AX_REALUNAME = '実名又はユーザ名を表示しますか？';
//weblinks item
protected $AX_WBLI_TL = 'ターゲット'; //Target
//content
protected $AX_RTFICL = 'RTFアイコン';
protected $AX_RTFICD = 'RTFボタンを表示/非表示にします - このページにのみ影響します。';
//modules/mod_whosonline.xml
protected $AX_MODWHO_FILGR = 'グループのフィルタ';
protected $AX_MODWHO_FILGRD = '「はい」の場合、より低いアクセスレベル(つまり訪問者)を持ったユーザはより高いアクセスを持ったユーザのログインステータスを見ることはできません';
//search bots
protected $AX_SEARCH_LIMIT = '検索制限';
protected $AX_MAXNUM_SRES = '検索結果の最大数';
//modules/mod_frontpage
protected $AX_MODFRONTPAGE = 'サイトの新着情報の概要を表示します。フロントページにとって理想的です。';
protected $AX_SECTIONS = 'セクション'; //Sections
protected $AX_SECTIONSD = 'セクションIDはカンマ「,」で区切られます';
protected $AX_CATEGORIES = 'カテゴリ';
protected $AX_CATEGORIESD = 'カテゴリIDはカンマ「,」で区切られます';
protected $AX_NUMDAYS = '日数'; //Number of days
protected $AX_NUMDAYSD = '最後のX日に作成されたアイテムを表示します。(デフォルト値:900)';
protected $AX_SHOWTHUMBS = 'サムネイルの表示';
protected $AX_SHOWTHUMBSD = '紹介文にサムネイル画像を表示/非表示にします。';
protected $AX_THUMBWIDTHD = 'サムネイル画像の幅(ピクセル)です';
protected $AX_THUMBHEIGHTD = 'サムネイル画像の高さ(ピクセル)です';
protected $AX_KEEPRATIO = '比率を保持';
protected $AX_KEEPRATIOD = '画像のアスペクト比を保存します。「はい」の場合、上の高さのパラメータはよろしくありません。'; //Preserve image aspect ratio. If Yes, then the height parameter above does n\'t matter.
//com_menus/eblog_item_link/eblog_item_link.xml
protected $AX_EBLOGITEM = 'eBlog Item';
protected $AX_EBLOGITEMD = 'Creates a link to a published eBlog blog';
//2009.0
protected $AX_COMMENTARY = 'Commentary';
protected $AX_COMMENTARYD = 'Select who is allowed to comment this article.';
protected $AX_NOONE = 'No-one';
protected $AX_REGUSERS = 'Registered users';
protected $AX_ALL = 'All';
protected $AX_COMMENTS = 'Comments';
protected $AX_COMMENTSD = 'Show number of comments?';

}

?>