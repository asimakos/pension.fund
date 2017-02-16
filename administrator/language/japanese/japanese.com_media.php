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
* @description: Japanese language for component media
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'この場所への直接アクセスは許可されていません。' );


class adminLanguage extends standardLanguage {

public $A_CMP_ME_RELPATH = '相対パス'; //Relative path
public $A_CMP_ME_PMOUSEVD = 'その詳細を見るにはファイルアイコン上にマウスを乗せます'; //Hover your mouse over a file icon to view its details
public $A_CMP_ME_RENAME = 'リネーム';
public $A_CMP_ME_COPYTO = 'コピー先:'; //Copy to
public $A_CMP_ME_NEWFOL = '新規フォルダ';
public $A_CMP_ME_NEWFIL = '新規ファイル';
public $A_CMP_ME_OPEN = '開く';
public $A_CMP_ME_VTHUMBS = 'サムネイルビュー';
public $A_CMP_ME_VICONS = 'アイコンビュー';
public $A_CMP_ME_DBCLOP = '開くにはダブルクリック:';
public $A_CMP_ME_DIRNEX = 'ディレクトリ<strong>%s</strong>は存在しません！';
public $A_CMP_ME_FILNEX = 'ファイル<strong>%s</strong>は存在しません！';
public $A_CMP_ME_PERMS = '権限';
public $A_CMP_ME_MODIF = '更新しました'; //Modified
public $A_CMP_ME_ACCESSED = 'アクセスしました'; //Accessed
public $A_CMP_ME_DOWNZIP = 'zipとしてダウンロード';
public $A_CMP_ME_DODOWN = '次のフォルダをzipファイルとしてダウンロードしますか？:'; //Do you want to download folder
public $A_CMP_ME_ASZIP = ''; //as zip?
public $A_CMP_ME_EXTHERE = 'ここへ展開';
public $A_CMP_ME_SELFNIMG = '選択されたファイルは画像ではありません！';
public $A_CMP_ME_FSELFCL = '最初にそれの上でクリックすることでファイルを選択します'; //First select a file by clicking on it
public $A_CMP_ME_RENEWFN = 'リネーム - 新しいファイル名を入力:';
public $A_CMP_ME_EXFINAME = '%sという名前のファイルは既に存在します！';
public $A_CMP_ME_EXFONAME = '%sという名前のフォルダは既に存在します！';
public $A_CMP_ME_FIRENTO = 'ファイル<strong>「%s」</strong>は<strong>「%s」</strong>へリネームされました';
public $A_CMP_ME_FORENTO = 'フォルダ<strong>「%s」</strong>は<strong>「%s」</strong>へリネームされました';
public $A_CMP_ME_RENFAIL = 'リネーム失敗！';
public $A_CMP_ME_ALLFIFODEL = 'このフォルダ内の全てのファイル/フォルダは削除されます！';
public $A_CMP_ME_DELQUEST = '「%s」を削除しますか？';
public $A_CMP_ME_FIDELSUC = 'ファイルの削除に成功しました';
public $A_CMP_ME_FODELSUC = 'フォルダの削除に成功しました';
public $A_CMP_ME_DELFAIL = '削除失敗！';
public $A_CMP_ME_COPYTOFO = 'フォルダへコピー:';
public $A_CMP_ME_SRCNEX = 'ソースファイルは存在しません！';
public $A_CMP_ME_SRCISDIR = 'ソースはディレクトリです！ディレクトリはコピーできません。';
public $A_CMP_ME_EXFIINDIR = '<strong>%s</strong>という名前のディレクトリ%s内にあるファイルは既に存在します';
public $A_CMP_ME_FICOPYSUC = 'ファイル<strong>%s</strong>をディレクトリ%sへコピーすることに成功しました';
public $A_CMP_ME_FICOPYSUC2 = 'ファイル<strong>%s</strong>はディレクトリ%sへ<strong>%s</strong>という名前でコピーすることに成功しました';
public $A_CMP_ME_FICOPYFAIL = '<strong>%s</strong>をディレクトリ%sへコピーできませんでした';
public $A_CMP_ME_NEWFONAME = '新しいフォルダ名を入力:';
public $A_CMP_ME_CHPERMS = '権限の変更';
public $A_CMP_ME_SIZE = 'サイズ';
public $A_CMP_ME_DIMS = '規模(Dimensions)';
public $A_CMP_ME_NAMENEWFO = '新しいフォルダには名前が必要です！';
public $A_CMP_ME_FOCRESUC = 'フォルダ<strong>%s</strong>の作成に成功しました';
public $A_CMP_ME_CNCRNEWFO = '新しいフォルダを作成できませんでした！';
public $A_CMP_ME_INVPERMS = '不正な権限です！';
public $A_CMP_ME_PERMCHSUC = 'ファイルの権限を<strong>%s</strong>へ変更することに成功しました';
public $A_CMP_ME_CHMODFAIL = 'モードの変更に失敗しました！';
public $A_CMP_ME_SELFIUP = 'アップロードするファイルを選択';
public $A_CMP_ME_SELFNFLV = '選択されたファイルはFlashビデオ(flv)ではありません！';
public $A_CMP_ME_PLAY = '再生';
public $A_CMP_ME_SELFNMP3 = '選択されたファイルはmp3ではありません！';
public $A_CMP_ME_EXTRZIP = 'Zipを展開';
public $A_CMP_ME_EXTRCUFO = '%sから現在のフォルダへ全てのファイルを展開しますか？';
public $A_CMP_ME_FINOZIP = 'ファイル<strong>%s</strong>はzipファイルではありません！';
public $A_CMP_ME_UNERREXT = '展開中の予期せぬエラー！';
public $A_CMP_ME_FIEXTRD = 'ファイルが展開されました。';
public $A_CMP_ME_REFVIEW = 'これらを見るには更新します';
public $A_CMP_ME_DOWNLOAD = 'ダウンロード';
public $A_CMP_ME_TODOWNCL = 'このファイルをダウンロードするにはアイコンのしたのファイル名をクリックします。';
public $A_CMP_ME_RESIZE = 'リサイズ';
public $A_CMP_ME_FINORES = '選択されたファイルはリサイズできません！';
public $A_CMP_ME_RESTO = '次へリサイズ:'; //Resize to
public $A_CMP_ME_KEEPRAT = 'アスペクト比を保持'; //Keep aspect ratio
public $A_CMP_ME_BASEWID = '画像の幅に基づく'; //Based on image width
public $A_CMP_ME_INVWNIMG = '新しい画像の幅が不正です！'; //Invalid width for the new image!
public $A_CMP_ME_INVHNIMG = '新しい画像の高さが不正です！'; //Invalid height for the new image!
public $A_CMP_ME_IMGRESSUC = '画像のリサイズに成功しました！';
public $A_CMP_ME_CNOTRESIMG = '画像をリサイズできませんでした！';
public $A_CMP_ME_IE6UPGRADE = '<strong>あなたはインターネットエクスプローラ6を使用しています！</strong> IE7へアップグレードをするか<a href="http://www.mozilla.com" target="_blank">Firefox</a>を使用してください。'; 
public $A_CMP_ME_USEFIREFOX = '最良のパフォーマンスのために<a href="http://www.mozilla.com" target="_blank">Firefox</a>を使用してください。';
public $A_CMP_ME_WATERMARK = '透かし';
public $A_CMP_ME_CNOTWATERF = 'このファイルに透かしを置けません！';
public $A_CMP_ME_TEXT = 'テキスト';
public $A_CMP_ME_FONT = 'フォント';
public $A_CMP_ME_OPACITY = '透明度';
public $A_CMP_ME_WATERPOS = '透かし位置';
public $A_CMP_ME_XAXIS = 'X-axis';
public $A_CMP_ME_YAXIS = 'Y-axis';
public $A_CMP_ME_COLOR = '色';
public $A_CMP_ME_IMGQUAL = '画像品質';
public $A_CMP_ME_SAVEAS = '次として保存...';
public $A_CMP_ME_BLACK = '黒色';
public $A_CMP_ME_WHITE = '白色';
public $A_CMP_ME_RED = '赤色';
public $A_CMP_ME_BLUE = '青色';
public $A_CMP_ME_ORANGE = 'オレンジ色';
public $A_CMP_ME_YELLOW = '黄色';
public $A_CMP_ME_GREEN = '緑色';
public $A_CMP_ME_GRAY = '灰色';
public $A_CMP_ME_LGRAY = '明るい灰色';
public $A_CMP_ME_SHADOW = '影';
public $A_CMP_ME_NOSHADOW = '影無し';
public $A_CMP_ME_NEWFDIFOLD = '新しいファイル名はオリジナルから異なった拡張子があります！'; //New filename has different extension from the original!
public $A_CMP_ME_OVERIMGNEX = 'オーバーレイ画像は存在しません！';
public $A_CMP_ME_WATERGENSUC = '透かし画像の生成に成功しました。<br />このウィンドウを閉じて新しい画像を見るにはメディア管理を更新します。';
public $A_CMP_ME_CNOTGENWAT = '<strong>透かし画像を生成できませんでした！</strong><br />この機能はGDとFreeTypeのPHPライブラリが必要です。';
public $A_CMP_ME_MEMANG = 'メディア管理';
public $A_CMP_ME_UPLOAD = 'アップロード';
public $A_CMP_ME_VALFTYPES = '有効なファイルタイプ';
public $A_CMP_ME_VIDEO = 'ビデオ';
public $A_CMP_ME_AUDIO = '音楽';
public $A_CMP_ME_OTHER = 'その他';

}

?>
