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
* @description: Japanese language for component contact
* @license: http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Elxis CMS is a Free Software
*
* ---- THIS FILE MUST BE ENCODED AS UTF-8! ----
*
*/

defined( '_VALID_MOS' ) or die( 'この場所への直接アクセスは許可されていません。' );


class adminLanguage extends standardLanguage {

public $A_CMP_CCT_MNGER = '連絡先管理';
public $A_CMP_CCT_EDITCT = '連絡先の編集';
public $A_CMP_CCT_EDITCAT = 'カテゴリの編集';
public $A_CMP_CCT_DETAILS = '連絡先詳細';
public $A_CMP_CCT_PSITION = '連絡者の所在地'; //Contact\'s Position
public $A_CMP_CCT_STRET = '住所';
public $A_CMP_CCT_TOWN = '市/区';
public $A_CMP_CCT_STATE = '州/県';
public $A_CMP_CCT_COUNTRY = '国';
public $A_CMP_CCT_ZIP = '郵便番号';
public $A_CMP_CCT_PHONE = '電話番号';
public $A_CMP_CCT_FAX = 'Fax';
public $A_CMP_CCT_MISINFO = 'その他情報';
public $A_CMP_CCT_SITDEFT = 'サイトのデフォルト';
public $A_CMP_CCT_PARAM = '* これらのパラメータは連絡先アイテムを見るためにクリックする場合に見せるものです * '; //These Parameters only control what you see when you click to view a Contact item
public $A_CMP_CCT_SELCREC = 'レコードを選択してください'; // Select a record to
public $A_CMP_CCT_NOUSER = '- ユーザ無し -';
public $A_CMP_CCT_CHEXTRA = '拡張フィールドの変更'; //change Extra Fields
public $A_CMP_CCT_NOEXTRA = '<strong>表示するものがありません。考えられる理由::</strong><br />- 連絡先がユーザにリンクされていない。<br />- 拡張ユーザフィールドがセットアップされていない。<br />- フィールド値が空。';

}

?>
