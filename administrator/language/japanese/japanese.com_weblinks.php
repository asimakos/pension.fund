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
* @description: Japanese language for component weblinks
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'この場所への直接アクセスは許可されていません。' );


class adminLanguage extends standardLanguage {

public $A_CMP_WBL_MANAGER = 'ウェブリンク管理';
public $A_CMP_WBL_APPROVED = '承認済み'; //Approved
public $A_CMP_WBL_MUSTTITLE = 'ウェブリンクアイテムはタイトルが必要です';
public $A_CMP_WBL_MUSTCATEG = 'カテゴリを選択してください。';
public $A_CMP_WBL_YMHURL = 'URLが必要です。';
public $A_CMP_WBL_WEBLNK = 'ウェブリンク';
public $A_CMP_WBL_MUSTURL = 'スクリーンショット';
public $A_CMP_WBL_SSHOTDESC = 'このリンク用のインターネット上に利用可能なスクリーンショットがない場合にのみ使用してください。';
public $A_CMP_WBL_EDITCAT = 'カテゴリの編集';
public $A_CMP_WBL_EDITWL = 'ウェブリンクの編集';
public $A_CMP_WBL_SCRNO = 'スクリーンショットを表示しない';
public $A_CMP_WBL_SCRLOC = 'ローカル画像を使用する';
public $A_CMP_WBL_SCRINT = 'インターネットから新しい画像を読み込む';
public $A_CMP_WBL_COPYDESC = "利用可能なウェブソースからウェブリンクのスクリーンショットを取得するために以下のいずれかのボタンを押してください。
このオプションが有効なら、保存後にウェブリンクのスクリーンショットがあなたのスクリーンショット用のディレクトリ「images/screenshots/」にコピーされるでしょう。";
public $A_CMP_WBL_SCRRECFROM = '次のサイトからスクリーンショットを受け取りました：';
public $A_CMP_WBL_INVSOURCE = '無効なソースを検出しました';
public $A_CMP_WBL_INVURL = '無効なウェブリンクのURLを検出しました';
public $A_CMP_WBL_DIRNOWRITE = 'images/screenshots/ディレクトリは書込み不可です。スクリーンショットを保存することができません。';
public $A_CMP_WBL_NOTCLICKED = '何もクリックされていません';

}

?>
